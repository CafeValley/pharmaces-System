<?php
$formtitle = "Sales by Period";
$formaction = "report_sales_period.php";
$systemname = "MMC";
include('connection.php');
include("front.php");
$mainreports = 'active';
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
        $from = null; $to = null;
        if (isset($_POST['From'])) {
          $from = $_POST['From'];
          $to   = $_POST['To'];
        }

        // Group sales totals per date
        if ($from && $to) {
          $stmt = $conn->prepare("SELECT orderdate, SUM(ordertotal) AS total FROM orderdetails WHERE orderdate BETWEEN ? AND ? GROUP BY orderdate ORDER BY orderdate");
          $stmt->bind_param("ss", $from, $to);
          $stmt->execute();
          $result = $stmt->get_result();
        } else {
          $result = $conn->query("SELECT orderdate, SUM(ordertotal) AS total FROM orderdetails GROUP BY orderdate ORDER BY orderdate DESC LIMIT 30");
        }
        $grand = 0;
        if ($result && $result->num_rows > 0) {
        ?>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Total</th>
              </tr>
            </thead>
            <?php $i=0; while ($row = $result->fetch_assoc()) { $i++; $grand += (int)$row['total']; ?>
              <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo htmlspecialchars($row['orderdate'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo (int)$row['total']; ?></td>
                </tr>
              </tbody>
            <?php } ?>
          </table>
          <div class="alert alert-info" role="alert">
            Grand total: <?php echo $grand; ?>
          </div>
        <?php } else { echo "No data"; } ?>

      </div>
    </div>

  </section>
</div>
<?php include("footer.php"); ?>


