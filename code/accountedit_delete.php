<?php
$formtitle = "Medicine";
$formaction = "accountedit_delete.php";
$systemname = "MMC";
include('connection.php');
include("front.php");
$mainaccounts = 'active';
$accountsmdata = 'class="active"';
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

      <div class="box-body">
        <?php
        if (isset($_POST['editin'])) {
          $theid = $_POST['theid'];
          //print_r($_POST);

          $up1 = $_POST['accountname'];
          $up2 = $_POST['accountsource'];
          $up3 = $_POST['amount'];
          $up4 = $_POST['paymenttype'];
          $up5 = $_POST['note'];
          $up6 = $_POST['movement'];
          $up7 = $_POST['accountdate'];

          $sqlup = "UPDATE `account` SET `name`='$up1',`source`='$up2',`amount`='$up3',`paymenttype`='$up4',`note`='$up5',`movement`='$up6',`accountdate`='$up7' where `id` =' $theid' ";
          $conn->query($sqlup);
        }
        if (isset($_POST['butedit'])) {
          $theid = $_POST['theid'];
          $sqlgetsrow = "SELECT `id`, `name`, `source`, `amount`, `paymenttype`, `note`, `movement`, `accountdate`, `whodidthis`, `whenwasit` FROM `account` where `id`= '$theid' ";
          $resultsrow = $conn->query($sqlgetsrow);
          $rowsrow     = $resultsrow->fetch_assoc();
          $name        = $rowsrow['name'];
          $source      = $rowsrow['source'];
          $amount      = $rowsrow['amount'];
          $paymenttype = $rowsrow['paymenttype'];
          $note        = $rowsrow['note'];
          $movement    = $rowsrow['movement'];
          $accountdate = $rowsrow['accountdate'];


        ?>
          <form action="<?php echo $formaction; ?>" method="POST" role="form">
            <!-- text input -->
            <input name="theid" type="hidden" value="<?php echo $theid; ?>">

            <div class="form-group">
              <label> Name</label>
              <input type="text" name="accountname" class="form-control" value="<?php echo  $name; ?>" placeholder="Enter ...">
            </div>
            <div class="form-group">
              <label>Source</label>
              <?php accountsourceselect($source); ?>
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input type="text" name="amount" class="form-control" value="<?php echo  $amount; ?>" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <label>Payment type</label>

              <?php paymenttypeselect($paymenttype); ?>
            </div>

            <div class="form-group">
              <label>Account Date</label>
              <input type="date" name="accountdate" class="form-control" value="<?php echo  $accountdate; ?>" placeholder="Enter ...">
            </div>



            <?php Movementradio($movement); ?>
            <div class="form-group">
              <label>Note</label>

              <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo  $note; ?></textarea>
            </div>

            <div class="form-group">
              <button type="submit" name="editin" class="btn btn-warning">Save</button>
            </div>


          </form>
        <?php
        }
        if (isset($_POST['butdelete'])) {
          $theid = $_POST['theid'];
          $sqldel = "DELETE FROM `account` WHERE `id` =' $theid' ";
          $conn->query($sqldel);
        ?>
          <div class="alert alert-danger" role="alert">
            data removed
          </div>
        <?php
        }

        $sql = "SELECT `id`, `name`, `source`, `amount`, `paymenttype`, `note`, `movement`, `accountdate`, `whodidthis`, `whenwasit` FROM `account` WHERE 1  ";
        $count = 0;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th> name</th>
                <th> source</th>
                <th>amount</th>
                <th>paymenttype</th>
                <th>note</th>
                <th>movement</th>
                <th>accountdate</th>

                <th></th>
              </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) {
              $var1 = $row['id'];
              $var2 = $row['name'];
              $var3 = $row['source'];
              $var4 = $row['amount'];
              $var5 = $row['paymenttype'];
              $var6 = $row['note'];
              $var7 = $row['movement'];
              $var8 = $row['accountdate'];


              echo "<tbody>";
              echo "<tr>";
              $count++;
              echo "<td>$count</td>";
              echo "<td>$var2</td>";
              echo "<td>$var3</td>";
              echo "<td>$var4</td>";
              echo "<td>$var5</td>";
              echo "<td>$var6</td>";
              echo "<td>$var7</td>";
              echo "<td>$var8</td>";

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