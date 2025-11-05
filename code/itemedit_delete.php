<?php
$formtitle = "Medicine";
$formaction = "itemedit_delete.php";
$systemname = "MMC";
include('connection.php');
include("front.php");
$maindrags = 'active';
$dragsmdata = 'class="active"';
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
        if (isset($_POST['editin'])) {
          $theid = $_POST['theid'];
          //print_r($_POST);
          $up1 = $_POST['itemname'];
          $up2 = $_POST['itemcode'];


          $sqlup = " UPDATE `items` SET `itemname`='$up1',`itemcode`='$up2' where `id` =' $theid' ";
          $conn->query($sqlup);
        }
        if (isset($_POST['butedit'])) {
          $theid = $_POST['theid'];
          $sqlgetsrow = "SELECT `id`, `itemname`, `itemcode`, `whenwasit`, `whodidit` FROM `items` where `id`= '$theid' ";
          $resultsrow = $conn->query($sqlgetsrow);
          $rowsrow = $resultsrow->fetch_assoc();
          $itemname     = $rowsrow['itemname'];
          $itemcode  = $rowsrow['itemcode'];
        ?>
          <form action="<?php echo $formaction; ?>" method="POST" role="form">
            <!-- text input -->
            <input name="theid" type="hidden" value="<?php echo $theid; ?>">
            <div class="form-group">
              <label>item name</label>
              <input type="text" name="itemname" class="form-control" value="<?php echo  $itemname; ?>" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label>item code</label>
              <input type="text" name="itemcode" class="form-control" value="<?php echo  $itemcode; ?>" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <button type="submit" name="editin" class="btn btn-warning">Save</button>
            </div>

          </form>
        <?php
        }
        if (isset($_POST['butdelete'])) {
          $theid = $_POST['theid'];

          $conn->query("DELETE FROM `item_quantity` WHERE `item_id` =' $theid'");
          $conn->query("DELETE FROM `item_price` WHERE `item_id` =' $theid'");
          $conn->query("DELETE FROM `item_package` WHERE `item_id` =' $theid'");
          $conn->query("DELETE FROM `item_limmit` WHERE `item_id` =' $theid'");
          $conn->query("DELETE FROM `item_barcode` WHERE `item_id` =' $theid'");
          $conn->query("DELETE FROM `suppliers_items` WHERE `item_id` =' $theid'");

          $sqldel = "DELETE FROM `items` WHERE `id` =' $theid' ";
          $conn->query($sqldel);
        ?>
          <div class="alert alert-danger" role="alert">
            data removed
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
                <th>Item name</th>
                <th>Item code</th>

                <th></th>
              </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) {
              $var1 = $row['id'];
              $var2 = $row['itemname'];
              $var3 = $row['itemcode'];
              echo "<tbody>";
              echo "<tr>";
              $count++;
              echo "<td>$count</td>";
              echo "<td>$var2</td>";
              echo "<td>$var3</td>";
              echo "<td>";
            ?>
              <form action="<?php echo $formaction; ?>" method="POST">
                <input name="theid" type="hidden" value="<?php echo $var1; ?>">
                <button type="submit" name="butedit" class="btn btn-warning">Edit</button>
                <button type="submit" name="butdelete" class="btn btn-danger">Remove</button>
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