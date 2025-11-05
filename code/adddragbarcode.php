<?php
$formtitle = "Medicine";
$formaction = "adddragbarcode.php";
$systemname = "MMC";
include('connection.php');
include('funitem.php');
include("front.php");
$maindrags = 'active';
$dragsbarcode = 'class="active"';
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
      if (isset($_POST['save'])) {
        //print_r($_POST);
        $var1 = $_POST['drugid'];
        $var2 = $_POST['barcode'];


        $sql = " INSERT INTO `item_barcode`(`item_id`, `barcode`, `whenwasit`, `whodidthis`) VALUES ('$var1','$var2',now(),'admin')";

        if ($conn->query($sql) === TRUE) {

      ?>
          <div class="alert alert-success" role="alert">
            data in success
          </div>
        <?php
        } else {
        ?>
          <div class="alert alert-danger" role="alert">
            Sorry something went wrong
          </div>
      <?php
        }
      }
      ?>
      <div class="box-body">
        <form action="<?php echo $formaction; ?>" method="POST" role="form">
          <!-- text input -->


          <div class="form-group">
            <label>Drug Name</label>

            <select name="drugid" class="form-control">
              <option value="">Which Drug</option>
              <?php
              $Sql     = "SELECT `id` , `itemname` , `itemcode`  FROM `items` ORDER BY `items`.`id` DESC ";
              $check   = mysqli_query($conn, $Sql);
              while ($row     = mysqli_fetch_array($check)) {
                $rowid = $row['id'];
                $rowname = $row['itemname'];
                $rowcode = $row['itemcode'];
                echo "<option value ='$rowid'>$rowname-$rowcode</option>";
              }
              ?>

            </select>
          </div>

          <div class="form-group">
            <label>limit threshold</label>
            <input type="text" name="barcode" class="form-control" placeholder="Enter ...">
          </div>

          <div class="form-group">
            <button type="submit" name="save" class="btn btn-primary">Save</button>
          </div>

        </form>
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