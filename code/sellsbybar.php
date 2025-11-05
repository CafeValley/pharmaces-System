<?php
$formtitle = "Sell by Barcode";
$formaction = "sellsbybar.php";
$systemname = "MMC";
include('connection.php');
include('funitem.php');
include("front.php");
$mainsells = 'active';
$sells = 'class="active"';
include("menu.php");
?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $formtitle; ?>

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active"><?php echo $formtitle; ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <?php
      if (isset($_POST['ordercomplate'])) {
        $discount = $_POST['discount'];
        $ordertotal = $_POST['ordertotal'];
        $discountvalue = $_POST['discountvalue'];
        $Sql3     = "SELECT  `orderno` FROM `ordercount` order by orderno DESC limit 1";
        $check3   = mysqli_query($conn, $Sql3);
        $row3    = mysqli_fetch_array($check3);
        if (isset($row3['orderno']))
          $orderno = $row3['orderno'] + 1;
        else
          $orderno = 1;
        $Sql     = "SELECT * FROM `itemsellstemp` ";
        $check   = mysqli_query($conn, $Sql);
        if (!empty($check)) {
          while ($row     = mysqli_fetch_array($check)) {
            $tempitemid  = $row['itemid'];
            $temppriceid = $row['priceid'];
            $tempquntity = $row['quntity'];
            itemquantitykilling($tempitemid, $tempquntity);
            $stmtIns = $conn->prepare("INSERT INTO `itemsells`( `itemid`, `priceid`, `quntity`, `orderno`) VALUES (?,?,?,?)");
            $stmtIns->bind_param("iiii", $tempitemid, $temppriceid, $tempquntity, $orderno);
            $stmtIns->execute();
          }
          $stmtOrd = $conn->prepare("INSERT INTO `orderdetails`(`orderno`, `orderdate`, `discount`, `perorvalue`, `ordertotal`, `whenwasit`, `whodidit`) VALUES (?,?,?,?,?,now(),?)");
          $who = 'admin';
          $stmtOrd->bind_param("issdis", $orderno, $today, $discountvalue, $discount, $ordertotal, $who);
          $stmtOrd->execute();
          ordercountplus();
          $Sql     = "delete from itemsellstemp";
          mysqli_query($conn, $Sql);
          echo "Order Complate";
        }
      }

      if (isset($_POST['cancelorder'])) {
        $Sql     = "delete from itemsellstemp";
        mysqli_query($conn, $Sql);
      }

      if (isset($_POST['editsingle'])) {
        $theid = $_POST['idtemp'];
        $iddrug = $_POST['iddrug'];
        $temporderquantiy = $_POST['temporderquantiy'];
        $temppackage = $_POST['package'];
        if ($temppackage == "Package") {
          $Sql     = "SELECT `amount` FROM `mmc`.`item_package` where `item_id` = ?";
          $stmtPkg = $conn->prepare($Sql);
          $stmtPkg->bind_param("i", $iddrug);
          $stmtPkg->execute();
          $resPkg = $stmtPkg->get_result();
          $row     = $resPkg->fetch_assoc();
          $packagesize = $row ? (int)$row['amount'] : 1;
          $temporderquantiy *= $packagesize;
        }
        $fullamount = getitemquantity($iddrug);
        if ($fullamount >= $temporderquantiy) {
          $stmtUpd = $conn->prepare("update itemsellstemp set `quntity` = ? where id = ?");
          $stmtUpd->bind_param("ii", $temporderquantiy, $theid);
          $stmtUpd->execute();
        } else
          echo "Please check the Quantity for this Item";
      }
      if (isset($_POST['removesingle'])) {
        $theid = $_POST['idtemp'];
        $stmtDel = $conn->prepare("delete from itemsellstemp where id = ?");
        $stmtDel->bind_param("i", $theid);
        $stmtDel->execute();
      }

      // Barcode order path
      if (isset($_POST['OrderBar'])) {
        $barcode = $_POST['barcode'];
        $barcode = mysqli_real_escape_string($conn, $barcode);
        // Find item by barcode
        $stmtFind = $conn->prepare("SELECT item_id FROM item_barcode WHERE barcode = ? LIMIT 1");
        $stmtFind->bind_param("s", $barcode);
        $stmtFind->execute();
        $resFind = $stmtFind->get_result();
        if ($row = $resFind->fetch_assoc()) {
          $Drugid = (int)$row['item_id'];
          $fullamount = getitemquantity($Drugid);
          if ($fullamount > 0) {
            $idprice = getitempriceid($Drugid);
            $stmtTmp = $conn->prepare("INSERT INTO `itemsellstemp`(`itemid`, `priceid`, `quntity`) VALUES (?,?,1)");
            $stmtTmp->bind_param("ii", $Drugid, $idprice);
            $stmtTmp->execute();
          } else {
            echo "Please check the Quantity for this Item";
          }
        } else {
          echo "Barcode not found";
        }
      }
      ?>
      <div class="box-body">

        <form action="<?php echo $formaction; ?>" method="POST" role="form">
          <div class="form-group ">
            <label> Barcode</label>
            <input type="text" name="barcode" class="form-control" placeholder="Scan or enter barcode">
          </div>
          <div class="form-group">
            <button type="submit" name="OrderBar" class="btn btn-primary">Add</button>
          </div>
        </form>

        <?php
        $Sql     = "SELECT * FROM `itemsellstemp` ";
        $check   = mysqli_query($conn, $Sql);
        $exists = (mysqli_num_rows($check)) ? TRUE : FALSE;
        if ($exists) {
        ?>
          Order Date:<strong><?php echo $today; ?></strong>
          <table class="table table-bordered table-hover dataTable">
            <thead>
              <tr>
                <th>Drug name</th>
                <th>Package</th>
                <th>Price</th>
                <th width='4%'>Quantity</th>
                <th>Total</th>
                <th width='12%'></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $ordertotal = 0;
              while ($row     = mysqli_fetch_array($check)) {
                $id = $row['id'];
                $itemid = $row['itemid'];
                echo "<form action ='$formaction' method = 'POST'>";
                echo "<input type = 'hidden' value = '$id' name ='idtemp'>";
                echo "<input type = 'hidden' value = '$itemid' name ='iddrug'>";
                $priceid = $row['priceid'];
                $quntity = $row['quntity'];
                $drugprice = getitemprice($priceid);
              ?>
                <tr>
                  <td><?php echo getitemnamefromid($itemid); ?></td>
                  <td>
                    <select class="form-select" name="package" aria-label="Default select example">
                      <option value="Strip">Strip</option>
                      <option value="Package">Box</option>
                    </select>
                  </td>
                  <td><?php echo $drugprice; ?></td>
                  <td><input value="<?php echo $quntity; ?>" class="form-control" name="temporderquantiy" type="text"></td>
                  <td><?php echo $quntity * $drugprice; $ordertotal += $quntity * $drugprice; ?></td>
                  <td>
                    <input class="btn btn-warning" name="editsingle" type="submit" value="E">
                    <input class="btn btn-danger" name="removesingle" type="submit" value="X">
                  </td>
                </tr>
              <?php
                echo "</form>";
              }  ?>
            </tbody>
            <tfoot>
              <form action="<?php echo $formaction; ?>" method="POST" role="form">
                <tr>
                  <th>
                    <div class="row">
                      <div class="col-md-4">
                        <select class="form-control" name="discount">
                          <option value="non">Discount</option>
                          <option value="Percentage">Percentage</option>
                          <option value="Value">Value</option>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <input class="form-control" value='0' name="discountvalue">
                      </div>
                    </div>
                  </th>
                  <th></th>
                  <th> </th>
                  <th><?php echo $ordertotal; ?></th>
                  <input type='hidden' value='<?php echo $ordertotal; ?>' name='ordertotal'>
                  <th><button type="submit" name="ordercomplate" class="btn btn-info">Complete Order</button>
                    <button type="submit" name="cancelorder" class="btn btn-danger">X</button>
                  </th>
                </tr>
              </form>
            </tfoot>
          </table>
        <?php
        } else echo "Scan a barcode to add";
        ?>

      </div>
    </div>

  </section>
</div>
<?php include("footer.php"); ?>


