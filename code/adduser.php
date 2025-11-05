<?php
$formtitle = "Medicine";
$formaction = "adduser.php";
$systemname = "MMC";
include('connection.php');
include('funitem.php');
include("front.php");
$mainusers = 'active';
$usersnew = 'class="active"';
include("menu.php");
include("funselects.php");
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
        $var1 = $_POST['givenName'];
        $var2 = $_POST['address'];
        $var3 = $_POST['phone'];
        $var4 = $_POST['username'];
        $var5 = $_POST['password'];
        $var6 = $_POST['usertype'];

        $sql = "  INSERT INTO `users`( `name`, `address`, `phone`, `username`, `password`, `usertype`, `whenwasit`, `whodidit`)   VALUES ('$var1','$var2','$var3','$var4','$var5','$var6',now(),'admin')";

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
            <label>Given Name</label>
            <input type="text" name="givenName" class="form-control" placeholder="Enter ...">
          </div>

          <div class="form-group">
            <label> address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter ...">
          </div>

          <div class="form-group">
            <label> phone</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter ...">
          </div>

          <div class="form-group">
            <label> username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter ...">
          </div>

          <div class="form-group">
            <label> password</label>
            <input type="text" name="password" class="form-control" placeholder="Enter ...">
          </div>

          <div class="form-group">
            <label> usertype</label>
            <?php usertypeselect(); ?>

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