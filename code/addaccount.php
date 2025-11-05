<?php
$formtitle = "Medicine";
$formaction = "addaccount.php";
$systemname = "MMC";
include('connection.php');
include('funitem.php');
include("front.php");
$mainaccounts = 'active';
$accountsnew = 'class="active"';
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
        $var1 = $_POST['accountname'];
        $var2 = $_POST['accountsource'];
        $var3 = $_POST['amount'];
        $var4 = $_POST['paymenttype'];
        $var5 = $_POST['note'];
        $var6 = $_POST['movement'];
        $var7 = $_POST['accountdate'];


        $sql = "INSERT INTO `account`( `accountdate`,`name`, `source`, `amount`, `paymenttype`, `note`, `movement`, `whenwasit`, `whodidthis`) VALUES ('$var7','$var1','$var2','$var3','$var4','$var5','$var6',now(),'admin')";

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
            <label> Name</label>
            <input type="text" name="accountname" class="form-control" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <label>Source</label>
            <select name="accountsource" class="form-control">

              <option value="Expenses">Expenses</option>
              <option value="Payroll">Payroll</option>
              <option value="Loans">Loans</option>
              <option value="Safe">Safe</option>
              <option value="Salary">Salary</option>
              <option value="Income">Income</option>
              <option value="Supplier">Supplier</option>
            </select>
          </div>
          <div class="form-group">
            <label>Amount</label>
            <input type="text" name="amount" class="form-control" placeholder="Enter ...">
          </div>

          <div class="form-group">
            <label>Payment type</label>

            <select name="paymenttype" class="form-control">
              <option>cash</option>
              <option>bank</option>
            </select>
          </div>

          <div class="form-group">
            <label>Account Date</label>
            <input type="date" name="accountdate" class="form-control" placeholder="Enter ...">
          </div>



          <div class="form-group">
            <label>Movement</label>
            <div class="radio">
              <label>
                <input name="movement" type="radio" value="withdrawal">
                Withdrawal
              </label>
            </div>
            <div class="radio">
              <label>
                <input name="movement" type="radio" value="deposit">
                deposit
              </label>
            </div>

          </div>
          <div class="form-group">
            <label>Note</label>

            <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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