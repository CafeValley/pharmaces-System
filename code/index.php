<?php
$systemname = "MMC";
include("connection.php");
$maindashboard = 'active';
include("front.php");
include("menu.php");
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php
    // Dashboard counters
    // Appointments: number of orders today
    $appointments = 0;
    if (isset($today)) {
      $stmt1 = $conn->prepare("SELECT COUNT(*) AS c FROM orderdetails WHERE orderdate = ?");
      $stmt1->bind_param("s", $today);
      $stmt1->execute();
      $res1 = $stmt1->get_result();
      if ($row1 = $res1->fetch_assoc()) { $appointments = (int)$row1['c']; }
    }

    // Doctors: count of staff in pharmacist-related roles (adjust as needed)
    $doctors = 0;
    $roles = array('Pharmacist','Pharmacy technician');
    $in  = implode(',', array_fill(0, count($roles), '?'));
    $types = str_repeat('s', count($roles));
    $stmt2 = $conn->prepare("SELECT COUNT(*) AS c FROM users WHERE usertype IN ($in)");
    $stmt2->bind_param($types, ...$roles);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    if ($row2 = $res2->fetch_assoc()) { $doctors = (int)$row2['c']; }

    // Tests: placeholder heuristic (items with name like 'test') — adjust when schema exists
    $tests = 0;
    $like = '%test%';
    $stmt3 = $conn->prepare("SELECT COUNT(*) AS c FROM items WHERE itemname LIKE ?");
    $stmt3->bind_param("s", $like);
    $stmt3->execute();
    $res3 = $stmt3->get_result();
    if ($row3 = $res3->fetch_assoc()) { $tests = (int)$row3['c']; }

    // Medicines: total items
    $medicines = 0;
    $res4 = $conn->query("SELECT COUNT(*) AS c FROM items");
    if ($res4) { $row4 = $res4->fetch_assoc(); $medicines = (int)$row4['c']; }
    ?>
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $appointments; ?></h3>

            <p>Appoinments</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $doctors; ?><sup style="font-size: 20px"></sup></h3>

            <p>Doctors</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $tests; ?></h3>

            <p>Tests</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $medicines; ?></h3>

            <p>Medicines</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include("footer.php"); ?>