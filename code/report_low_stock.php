<?php
$formtitle = "Low Stock";
$formaction = "report_low_stock.php";
$systemname = "MMC";
include('connection.php');
include("front.php");
$mainreports = 'active';
include("menu.php");
?>

<!-- =============================================== -->

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
        // Sum current quantities per item
        $sqlQty = "SELECT i.id, i.itemname, COALESCE(SUM(q.amount),0) AS qty
                   FROM items i
                   LEFT JOIN item_quantity q ON q.item_id = i.id AND q.active = 1
                   GROUP BY i.id, i.itemname";
        $resQty = $conn->query($sqlQty);
        $itemIdToQty = array();
        while ($resQty && $row = $resQty->fetch_assoc()) {
          $itemIdToQty[(int)$row['id']] = (int)$row['qty'];
          $itemIdToName[(int)$row['id']] = $row['itemname'];
        }

        // Limits per item
        $limits = array();
        $resLim = $conn->query("SELECT item_id, amount FROM item_limmit");
        while ($resLim && $row = $resLim->fetch_assoc()) {
          $limits[(int)$row['item_id']] = (int)$row['amount'];
        }

        // Build low stock list
        $low = array();
        foreach ($itemIdToQty as $itemId => $qty) {
          $limit = isset($limits[$itemId]) ? $limits[$itemId] : 0;
          if ($limit > 0 && $qty <= $limit) {
            $low[] = array('id' => $itemId, 'name' => $itemIdToName[$itemId], 'qty' => $qty, 'limit' => $limit);
          }
        }

        if (!empty($low)) {
        ?>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Limit</th>
              </tr>
            </thead>
            <?php $i=0; foreach ($low as $row) { $i++; ?>
              <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo (int)$row['qty']; ?></td>
                  <td><?php echo (int)$row['limit']; ?></td>
                </tr>
              </tbody>
            <?php } ?>
          </table>
        <?php } else { echo "No low stock items"; } ?>
      </div>
    </div>
  </section>
</div>
<?php include("footer.php"); ?>


