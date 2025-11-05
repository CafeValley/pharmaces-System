<?php
$formtitle = "Report Test";
$formaction = "report1.php";
$systemname = "MMC";
include('connection.php');
include("front.php");
$mainreports = 'active';
$report1 = 'class="active"';

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
        <form action="<?php echo $formaction; ?>" method="POST" role="form">
          <div class="form-group">
            <label>From Date</label>
            <input type="date" name="From" class="form-control" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <label>To Date</label>
            <input type="date" name="To" class="form-control" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <button type="submit" name="seek" class="btn btn-primary">seek</button>
          </div>
        </form>
        <?php
        $where1 = "";
        $where2 = "";
        if (isset($_POST['From'])) {
          $from = $_POST['From'];
          $to   = $_POST['To'];
          $where1 = " where `orderdate` between ? and ? ";
          $where2 = " where `accountdate` between ? and ? ";
        }
        $totalin = 0;
        $totalout = 0;
        if (isset($_POST['From'])) {
          $sql = "SELECT sum(ordertotal) as ordertotal  FROM `orderdetails` $where1  order by`whenwasit`";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $from, $to);
          $stmt->execute();
          $result = $stmt->get_result();
        } else {
          $sql = "SELECT sum(ordertotal) as ordertotal  FROM `orderdetails` order by`whenwasit`";
          $result = $conn->query($sql);
        }
        $count = 0;
        if ($result->num_rows > 0) {
        ?>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Order Date</th>
                <th>Order Total </th>
              </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) {

              $var2 = $row['ordertotal'];
              $totalin += $var2;
              echo "<tbody>";
              echo "<tr>";
              $count++;
              echo "<td>$count</td>";
              echo "<td>";
              if (isset($_POST['From']))
                echo "sells from " . htmlspecialchars($from, ENT_QUOTES, 'UTF-8') . " - " . htmlspecialchars($to, ENT_QUOTES, 'UTF-8');

              else
                echo "sells from to $today";
              echo "</td>";
              echo "<td>$var2</td>";
              echo "</tr>";
            }
            ?>
            </tbody>
          </table>
        <?php
        }
        ?>
        <?php
        if (isset($_POST['From'])) {
          $sql = "SELECT `id`, `name`, `source`, `amount`, `paymenttype`, `note`, `movement`, `accountdate`, `whodidthis`, `whenwasit` FROM `account` $where2 order by`whenwasit`";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $from, $to);
          $stmt->execute();
          $result = $stmt->get_result();
        } else {
          $sql = "SELECT `id`, `name`, `source`, `amount`, `paymenttype`, `note`, `movement`, `accountdate`, `whodidthis`, `whenwasit` FROM `account` order by`whenwasit`";
          $result = $conn->query($sql);
        }
        $count = 0;
        if ($result->num_rows > 0) {
        ?>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name </th>
                <th>Date</th>
                <th>Amount </th>
              </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) {
              $var1 = $row['accountdate'];
              $var2 = $row['amount'];
              $var3 = $row['name'];


              $movement = $row['movement'];
              if ($movement == 'withdrawal')
                $totalout -= $var2;
              if ($movement == 'deposit')
                $totalin += $var2;

              echo "<tbody>";
              echo "<tr>";
              $count++;
              echo "<td>$count</td>";
              echo "<td>$var3</td>";
              echo "<td>$var1</td>";
              echo "<td>$var2</td>";
              echo "</tr>";
            }
            ?>
            </tbody>
          </table>

        <?php
        }
        ?>
      </div>
      <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Total Withdrawal </th>
            <th><?php echo $totalout; ?></th>
            <th>Total Deposit</th>
            <th><?php echo $totalin; ?></th>
            <th>Total </th>
            <th><?php echo $totalin + $totalout; ?></th>
          </tr>
        </thead>
      </table>
      <!-- /.box-body -->

      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include("footer.php"); ?>