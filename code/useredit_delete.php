<?php
$formtitle = "Medicine";
$formaction = "useredit_delete.php";
$systemname = "MMC";
include('connection.php');
include("front.php");
$mainusers = 'active';
$usersmdata = 'class="active"';
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
          $up1 = $_POST['givenName'];
          $up2 = $_POST['address'];
          $up3 = $_POST['phone'];
          $up4 = $_POST['username'];
          $up5 = $_POST['password'];
          $up6 = $_POST['usertype'];

          // Build dynamic update, hash password only if provided
          $fields = array('name' => $up1, 'address' => $up2, 'phone' => $up3, 'username' => $up4, 'usertype' => $up6);
          $params = array();
          $types = '';
          $setParts = array();
          foreach ($fields as $col => $val) {
            $setParts[] = "`$col` = ?";
            $params[] = $val;
            $types .= 's';
          }
          if (!empty($up5)) {
            $hashed = password_hash($up5, PASSWORD_DEFAULT);
            $setParts[] = "`password` = ?";
            $params[] = $hashed;
            $types .= 's';
          }
          $sqlup = "UPDATE `users` SET " . implode(',', $setParts) . " WHERE `id` = ?";
          $stmt = $conn->prepare($sqlup);
          $types .= 'i';
          $params[] = (int)$theid;
          $stmt->bind_param($types, ...$params);
          $stmt->execute();
        }
        if (isset($_POST['butedit'])) {
          $theid = $_POST['theid'];
          $sqlgetsrow = "SELECT `id`, `name`, `address`, `phone`, `username`, `password`, `usertype`, `whenwasit`, `whodidit` FROM `users` where `id`= '$theid' ";
          $resultsrow = $conn->query($sqlgetsrow);
          $rowsrow = $resultsrow->fetch_assoc();
          $name     = $rowsrow['name'];
          $address  = $rowsrow['address'];
          $phone  = $rowsrow['phone'];
          $username  = $rowsrow['username'];
          $password  = $rowsrow['password'];
          $usertype  = $rowsrow['usertype'];

        ?>
          <form action="<?php echo $formaction; ?>" method="POST" role="form">
            <!-- text input -->
            <input name="theid" type="hidden" value="<?php echo $theid; ?>">

            <div class="form-group">
              <label>Given Name</label>
              <input type="text" name="givenName" class="form-control" value="<?php echo  $name; ?>" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <label> address</label>
              <input type="text" name="address" class="form-control" value="<?php echo  $address; ?>" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <label> phone</label>
              <input type="text" name="phone" class="form-control" value="<?php echo  $phone; ?>" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <label> username</label>
              <input type="text" name="username" class="form-control" value="<?php echo  $username; ?>" placeholder="Enter ...">
            </div>

            <div class="form-group">
              <label> password</label>
              <input type="password" name="password" class="form-control" value="" placeholder="Leave blank to keep current">
            </div>

            <div class="form-group">
              <label> usertype</label>
              <?php usertypeselect($usertype); ?>

            </div>

            <div class="form-group">
              <button type="submit" name="editin" class="btn btn-warning">Save</button>
            </div>



          </form>
        <?php
        }
        if (isset($_POST['butdelete'])) {
          $theid = $_POST['theid'];
          $sqldel = "DELETE FROM `users` WHERE `id` =' $theid' ";
          $conn->query($sqldel);
        ?>
          <div class="alert alert-danger" role="alert">
            data removed
          </div>
        <?php
        }

        $sql = "SELECT `id`, `name`, `address`, `phone`, `username`, `usertype`, `whenwasit`, `whodidit` FROM `users`  ";
        $count = 0;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th> name</th>
                <th> address</th>
                <th> phone</th>
                <th> username</th>
                <th> usertype</th>

                <th></th>
              </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) {
              $var1 = $row['id'];
              $var2 = $row['name'];
              $var3 = $row['address'];
              $var4 = $row['phone'];
              $var5 = $row['username'];
              $var7 = $row['usertype'];

              echo "<tbody>";
              echo "<tr>";
              $count++;
              echo "<td>$count</td>";
              echo "<td>$var2</td>";
              echo "<td>$var3</td>";
              echo "<td>$var4</td>";
              echo "<td>" . htmlspecialchars($var5, ENT_QUOTES, 'UTF-8') . "</td>";
              echo "<td>$var7</td>";

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