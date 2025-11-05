<?php
$formtitle = "Suppliers List";
$formaction = "report_suppliers.php";
$systemname = "MMC";
include('connection.php');
include("front.php");
$mainreports = 'active';
include("menu.php");
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?php echo $formtitle; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?php echo $formtitle; ?></li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-body">
        <?php
        $result = $conn->query("SELECT id, name, phone, whenwasit, whodidit FROM suppliers ORDER BY name");
        if ($result && $result->num_rows > 0) {
        ?>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Created</th>
                <th>By</th>
              </tr>
            </thead>
            <?php $i=0; while ($row = $result->fetch_assoc()) { $i++; ?>
              <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo htmlspecialchars($row['whenwasit'], ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php echo htmlspecialchars($row['whodidit'], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
              </tbody>
            <?php } ?>
          </table>
        <?php } else { echo "No suppliers found"; } ?>
      </div>
    </div>
  </section>
</div>
<?php include("footer.php"); ?>


