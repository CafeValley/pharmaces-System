<?php
$formtitle = "Medicine";
$formaction = "itemedit_deleteprice.php";
$systemname = "MMC";
include('connection.php');
include("front.php");
$maindrags = 'active';
$dragsprices = 'class="active"';
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

      <div class="box-body">
        <?php
        if (isset($_POST['editin2'])) {
          $theid = $_POST['theid'];
          $theiditem = $_POST['theiditem'];

          //print_r($_POST);
          $up1 = $_POST['bought'];
          $up2 = $_POST['sold'];

          $sqlup = " UPDATE `item_price` SET `active` = 0 where `item_id` =' $theiditem' ";

          $sqlprice = "INSERT INTO `item_price`(`item_id`, `bought`, `sold`, `active`, `whenwasit`, `whodidit`) VALUES ('$theiditem','$up1','$up2','1',now(),'admin')";

          $conn->query($sqlup);
          $conn->query($sqlprice);
        }
        if (isset($_POST['butnew'])) {
          $theid = $_POST['theid'];
          $theid2 = $_POST['theid2'];
          $sqlgetsrow = "SELECT `id`, `itemname`, `itemcode`, `whenwasit`, `whodidit` FROM `items` where `id`= '$theid' ";
          $resultsrow = $conn->query($sqlgetsrow);
          $rowsrow = $resultsrow->fetch_assoc();
          $itemname     = $rowsrow['itemname'];
          $itemcode  = $rowsrow['itemcode'];

          $sqlprice2 = "SELECT `id`, `item_id`, `bought`, `sold`, `active`, `whenwasit`, `whodidit` FROM `item_price` WHERE `active` = '1' and `item_id` = '$theid'  ";
          $resultsrow2 = $conn->query($sqlprice2);
          $rowsrow2 = $resultsrow2->fetch_assoc();
          $bought = $rowsrow2['bought'];
          $sold   = $rowsrow2['sold'];

        ?>
          <form action="<?php echo $formaction; ?>" method="POST" role="form">
            for
            <?php
            echo $itemname;
            echo " - ";
            echo $itemcode;
            ?>
            <!-- text input -->
            <input name="theid" type="hidden" value="<?php echo $theid2; ?>">
            <input name="theiditem" type="hidden" value="<?php echo $theid; ?>">
            <div class="form-group">
              <label>Item bought</label>
              <input type="text" name="bought" class="form-control" value="" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label>Item sold</label>
              <input type="text" name="sold" class="form-control" value="" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <button type="submit" name="editin2" class="btn btn-warning">Save</button>
            </div>

          </form>
        <?php
        }
















        if (isset($_POST['editin'])) {
          $theid = $_POST['theid'];
          //print_r($_POST);
          $up1 = $_POST['bought'];
          $up2 = $_POST['sold'];

          $sqlup = " UPDATE `item_price` SET `bought`='$up1',`sold`='$up2' where `id` =' $theid' ";
          $conn->query($sqlup);
        }
        if (isset($_POST['butedit'])) {
          $theid = $_POST['theid'];
          $theid2 = $_POST['theid2'];
          $sqlgetsrow = "SELECT `id`, `itemname`, `itemcode`, `whenwasit`, `whodidit` FROM `items` where `id`= '$theid' ";
          $resultsrow = $conn->query($sqlgetsrow);
          $rowsrow = $resultsrow->fetch_assoc();
          $itemname     = $rowsrow['itemname'];
          $itemcode  = $rowsrow['itemcode'];

          $sqlprice2 = "SELECT `id`, `item_id`, `bought`, `sold`, `active`, `whenwasit`, `whodidit` FROM `item_price` WHERE `active` = '1' and `item_id` = '$theid'  ";
          $resultsrow2 = $conn->query($sqlprice2);
          $rowsrow2 = $resultsrow2->fetch_assoc();
          $bought = $rowsrow2['bought'];
          $sold   = $rowsrow2['sold'];

        ?>
          <form action="<?php echo $formaction; ?>" method="POST" role="form">
            for
            <?php
            echo $itemname;
            echo " - ";
            echo $itemcode;
            ?>
            <!-- text input -->
            <input name="theid" type="hidden" value="<?php echo $theid2; ?>">
            <div class="form-group">
              <label>Item bought</label>
              <input type="text" name="bought" class="form-control" value="<?php echo  $bought; ?>" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label>Item sold</label>
              <input type="text" name="sold" class="form-control" value="<?php echo  $sold; ?>" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <button type="submit" name="editin" class="btn btn-warning">Save</button>
            </div>

          </form>
        <?php
        }
        if (isset($_POST['butzero'])) {
          $theid = $_POST['theid2'];

          $sqlup = " UPDATE `item_price` SET `bought`='0',`sold`='0' where `id` =' $theid' ";
          $conn->query($sqlup);
        ?>
          <div class="alert alert-danger" role="alert">
            data zero
          </div>
        <?php
        }

        $sql = "SELECT `id`, `itemname`, `itemcode`, `whenwasit`, `whodidit` FROM `items`  ";
        $count = 0;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {


        ?>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Item name/code</th>
                <th>Item bought</th>
                <th>Item sold</th>

                <th></th>
              </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) {
              $var1 = $row['id'];

              $sqlprice = "SELECT `id`, `item_id`, `bought`, `sold`, `active`, `whenwasit`, `whodidit` FROM `item_price` WHERE `active` = '1' and `item_id` = '$var1'  ";
              $resultprice = $conn->query($sqlprice);
              $rowprice = $resultprice->fetch_assoc();
              $var4 = $rowprice['bought'];
              $var5 = $rowprice['sold'];
              $var6 = $rowprice['id'];

              $var2 = $row['itemname'];
              $var3 = $row['itemcode'];
              echo "<tbody>";
              echo "<tr>";
              $count++;
              echo "<td>$count</td>";
              echo "<td>$var2-$var3</td>";
              echo "<td>$var4</td>";
              echo "<td>$var5</td>";

              echo "<td>";
            ?>
              <form action="<?php echo $formaction; ?>" method="POST">
                <input name="theid" type="hidden" value="<?php echo $var1; ?>">
                <input name="theid2" type="hidden" value="<?php echo $var6; ?>">
                <button type="submit" name="butzero" class="btn btn-warning">set to zero</button>
                <button type="submit" name="butedit" class="btn btn-danger">edit</button>
                <button type="submit" name="butnew" class="btn btn-info">new price</button>
              </form>
            <?php
              echo "</td>";
              echo "</tr>";
            }
            ?>
            </tbody>

          </table>

        <?php
        } else {
          echo "no data";
        }



        ?>
      </div>
      <!-- /.box-body -->

      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include("footer.php"); ?>