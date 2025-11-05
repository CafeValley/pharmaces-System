<?php
$formtitle = "Medicine";
$formaction = "adddrag.php";
$systemname = "MMC";
include('connection.php');
include('funitem.php');
include("front.php");

$maindrags = 'active';
$dragsnew = 'class="active"';
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
        $var1 = $_POST['drugname'];
        $var2 = $_POST['drugcode'];
        $var3 = $_POST['quantity'];
        $var4 = $_POST['expiredate'];
        $var5 = $_POST['pbought'];
        $var6 = $_POST['psold'];

        $sql = "INSERT INTO `items`(`itemname`, `itemcode`, `whenwasit`, `whodidit`)  VALUES ('$var1','$var2',now(),'admin')";

        if ($conn->query($sql) === TRUE) {
          $thelastid = getlastitemid();
          $sqlquan = "INSERT INTO `item_quantity`( `item_id`, `amount`, `expiredate`, `active`, `whenwasit`, `whodidit`) VALUES ('$thelastid','$var3','$var4','1',now(),'admin')";
          $sqlprice = "INSERT INTO `item_price`(`item_id`, `bought`, `sold`, `active`, `whenwasit`, `whodidit`) VALUES ('$thelastid','$var5','$var6','1',now(),'admin')";
          $conn->query($sqlquan);
          $conn->query($sqlprice);
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
          <small>here you can add the drug type to its name if there are many ex.(Tablet - Liquid - Capsules - Topical medicines - Suppositories - Drops - Inhalers - Injections - Implants or patches - buccal or sublingual tablets or liquids) ) </small>
          <div class="form-group">
            <label>Drug Name</label>
            <input type="text" name="drugname" class="form-control" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <label>Code</label>
            <input type="text" name="drugcode" class="form-control" placeholder="Enter ...">
          </div>


          <div class="form-group">
            <label>Quantity</label>
            <input type="text" name="quantity" class="form-control" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <label>Expire Date</label>
            <input type="date" name="expiredate" class="form-control" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <label>Price Bought</label>
            <input type="text" name="pbought" class="form-control" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <label>Price Sold</label>
            <input type="text" name="psold" class="form-control" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <label>Shelf No</label>
            <input type="text" name="shiefno" class="form-control" placeholder="Enter ...">
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