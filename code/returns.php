<?php
$formtitle = "Returns";
$formaction = "returns.php";
$systemname = "MMC";
include('connection.php');
include('funitem.php');
include("front.php");
$mainsells = 'active';
include("menu.php");
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?php echo $formtitle; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?php echo $formtitle; ?></li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-body">
        <?php
        $orderno = '';
        if (isset($_POST['findorder'])) {
          $orderno = trim($_POST['orderno']);
        }

        if (isset($_POST['processreturn'])) {
          $orderno = $_POST['orderno'];
          $totalRefund = 0;
          if (!empty($_POST['retqty']) && is_array($_POST['retqty'])) {
            foreach ($_POST['retqty'] as $itemid => $qty) {
              $retQty = (int)$qty;
              $itemid = (int)$itemid;
              if ($retQty <= 0) continue;
              // Max return = sold quantity for this order
              $stmtSold = $conn->prepare("SELECT SUM(quntity) AS sold FROM itemsells WHERE orderno = ? AND itemid = ?");
              $stmtSold->bind_param("ii", $orderno, $itemid);
              $stmtSold->execute();
              $resSold = $stmtSold->get_result();
              $soldRow = $resSold->fetch_assoc();
              $sold = (int)$soldRow['sold'];
              if ($retQty > $sold) $retQty = $sold;
              if ($retQty <= 0) continue;

              // Add back stock
              itemquantityadd($itemid, $retQty);

              // Refund computation using current active sold price
              $priceid = getitempriceid($itemid);
              $price = getitemprice($priceid);
              $totalRefund += ($retQty * (int)$price);
            }
          }

          if ($totalRefund > 0) {
            // Record refund in accounts as withdrawal (money out)
            $stmtAcc = $conn->prepare("INSERT INTO account (name, source, amount, paymenttype, note, movement, accountdate, whodidthis, whenwasit) VALUES (?,?,?,?,?,?,?,?,?)");
            $name = 'Return #'.$orderno; $source='Expenses'; $amount=$totalRefund; $paymenttype='cash'; $note='return'; $movement='withdrawal'; $accountdate=$today; $who='admin'; $when=$today;
            $stmtAcc->bind_param("ssissssss", $name, $source, $amount, $paymenttype, $note, $movement, $accountdate, $who, $when);
            $stmtAcc->execute();
            echo "<div class='alert alert-success'>Return processed. Refund: $totalRefund</div>";
          } else {
            echo "<div class='alert alert-warning'>Nothing to return</div>";
          }
        }
        ?>

        <form action="<?php echo $formaction; ?>" method="POST" role="form">
          <div class="form-group ">
            <label> Order No.</label>
            <input type="text" name="orderno" class="form-control" value="<?php echo htmlspecialchars($orderno, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Enter order number">
          </div>
          <div class="form-group">
            <button type="submit" name="findorder" class="btn btn-primary">Find</button>
          </div>
        </form>

        <?php if (!empty($orderno)) {
          $stmt = $conn->prepare("SELECT s.itemid, s.priceid, SUM(s.quntity) AS qty FROM itemsells s WHERE s.orderno = ? GROUP BY s.itemid, s.priceid");
          $stmt->bind_param("i", $orderno);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result && $result->num_rows > 0) { ?>
            <form action="<?php echo $formaction; ?>" method="POST" role="form">
              <input type="hidden" name="orderno" value="<?php echo (int)$orderno; ?>">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Drug</th>
                    <th>Sold Qty</th>
                    <th>Return Qty</th>
                  </tr>
                </thead>
                <?php $i=0; while ($row = $result->fetch_assoc()) { $i++; $itemid=(int)$row['itemid']; ?>
                  <tbody>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo htmlspecialchars(getitemnamefromid($itemid), ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo (int)$row['qty']; ?></td>
                      <td><input type="number" min="0" max="<?php echo (int)$row['qty']; ?>" name="retqty[<?php echo $itemid; ?>]" class="form-control" value="0"></td>
                    </tr>
                  </tbody>
                <?php } ?>
              </table>
              <div class="form-group">
                <button type="submit" name="processreturn" class="btn btn-danger">Process Return</button>
              </div>
            </form>
          <?php } else { echo "<div class='alert alert-info'>No items found for this order.</div>"; } } ?>

      </div>
    </div>
  </section>
</div>
<?php include("footer.php"); ?>


