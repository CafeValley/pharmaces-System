<?php
$formtitle = "Drugs Inventory";
$formaction = "report_drugs.php";
$systemname = "MMC";
include('connection.php');
include("front.php");
$mainreports = 'active';
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
        // Fetch base items
        $itemsRes = $conn->query("SELECT id, itemname, itemcode FROM items ORDER BY itemname");
        if ($itemsRes && $items = $itemsRes->fetch_all(MYSQLI_ASSOC)) {
          // Quantities (active=1 summed)
          $qtyMap = array();
          $resQty = $conn->query("SELECT item_id, SUM(amount) AS qty FROM item_quantity WHERE active = 1 GROUP BY item_id");
          while ($resQty && $r = $resQty->fetch_assoc()) { $qtyMap[(int)$r['item_id']] = (int)$r['qty']; }

          // Current prices (active=1, 'sold' as current price)
          $priceMap = array();
          $resPrice = $conn->query("SELECT item_id, sold FROM item_price WHERE active = 1");
          while ($resPrice && $r = $resPrice->fetch_assoc()) { $priceMap[(int)$r['item_id']] = (int)$r['sold']; }

          // Package amount if any
          $pkgMap = array();
          $resPkg = $conn->query("SELECT item_id, amount FROM item_package");
          while ($resPkg && $r = $resPkg->fetch_assoc()) { $pkgMap[(int)$r['item_id']] = (int)$r['amount']; }

          // Limits if any
          $limitMap = array();
          $resLimit = $conn->query("SELECT item_id, amount FROM item_limmit");
          while ($resLimit && $r = $resLimit->fetch_assoc()) { $limitMap[(int)$r['item_id']] = (int)$r['amount']; }

          // Barcode presence
          $barcodeMap = array();
          $resBarcode = $conn->query("SELECT item_id, COUNT(*) AS c FROM item_barcode GROUP BY item_id");
          while ($resBarcode && $r = $resBarcode->fetch_assoc()) { $barcodeMap[(int)$r['item_id']] = (int)$r['c']; }
        ?>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Code</th>
                <th>Current Quantity</th>
                <th>Current Price</th>
                <th>Package (units/box)</th>
                <th>Limit</th>
                <th>Barcode</th>
              </tr>
            </thead>
            <?php $i=0; foreach ($items as $it) { $i++; $id = (int)$it['id']; ?>
              <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo htmlspecialchars($it['itemname'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo htmlspecialchars((string)$it['itemcode'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo isset($qtyMap[$id]) ? (int)$qtyMap[$id] : 0; ?></td>
                  <td><?php echo isset($priceMap[$id]) ? (int)$priceMap[$id] : 0; ?></td>
                  <td><?php echo isset($pkgMap[$id]) ? (int)$pkgMap[$id] : 0; ?></td>
                  <td><?php echo isset($limitMap[$id]) ? (int)$limitMap[$id] : 0; ?></td>
                  <td><?php echo (isset($barcodeMap[$id]) && $barcodeMap[$id] > 0) ? 'Yes' : 'No'; ?></td>
                </tr>
              </tbody>
            <?php } ?>
          </table>
        <?php } else { echo "No items found"; } ?>
      </div>
    </div>
  </section>
</div>
<?php include("footer.php"); ?>


