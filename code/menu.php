<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">

      <center>
        <font color='white'>Weclome Admin</font>
      </center>

    </div>
    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Home</li>
      <li class="<?php echo $maindashboard; ?> treeview">
        <a href="#">
          <i class="fa fa-street-view"></i> <span>Dashboard(under)</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="index.php"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>

        </ul>
      </li>



      <li class="<?php echo $mainsells; ?> treeview">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Sells</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php echo $sells; ?>><a href="sells.php"><i class="fa fa-circle-o"></i> By Name</a></li>
          <li <?php echo $sells; ?>><a href="sellsbybar.php"><i class="fa fa-circle-o"></i> By Barcode</a></li>
          <li><a href="returns.php"><i class="fa fa-circle-o"></i> Returned</a></li>


        </ul>
      </li>


      <li class="header">Basic Data</li>
      <li class="<?php echo $maindrags; ?> treeview">
        <a href="#">
          <i class="fa fa-eyedropper"></i> <span>Manange Drags</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php echo $dragsnew; ?>><a href="adddrag.php"><i class="fa fa-circle-o"></i> New</a></li>
          <li <?php echo $dragsnew; ?>><a href="adddrag.php"><i class="fa fa-circle-o"></i> Extra (under)</a></li>
          <li <?php echo $dragsmdata; ?>><a href="itemedit_delete.php"><i class="fa fa-circle-o"></i> Manage Data</a></li>
          <li <?php echo $dragsprices; ?>><a href="itemedit_deleteprice.php"><i class="fa fa-circle-o"></i> Manage Prices</a></li>
          <li <?php echo $dragsquanties; ?>><a href="itemedit_deletequantity.php"><i class="fa fa-circle-o"></i> Manage Quanties</a></li>
          <li <?php echo $dragspackage; ?>><a href="adddragpackage.php"><i class="fa fa-circle-o"></i> Manage Package</a></li>
          <li <?php echo $dragslimmit; ?>><a href="adddraglimit.php"><i class="fa fa-circle-o"></i> Manage Limmit</a></li>
          <li <?php echo $dragsbarcode; ?>><a href="adddragbarcode.php"><i class="fa fa-circle-o"></i> Manage Barcode</a></li>

        </ul>
      </li>

      <li class="<?php echo $mainusers; ?> treeview">
        <a href="#">
          <i class="fa fa-eyedropper"></i> <span>Manange Users</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php echo $usersnew; ?>><a href="adduser.php"><i class="fa fa-circle-o"></i>New</a></li>
          <li <?php echo $usersmdata; ?>><a href="useredit_delete.php"><i class="fa fa-circle-o"></i> Manage Users</a></li>



        </ul>
      </li>
      <li class="<?php echo $mainsuppliers; ?> treeview">
        <a href="#">
          <i class="fa fa-eyedropper"></i> <span>Manange Suppliers</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php echo $suppliersnew; ?>><a href="addsupplier.php"><i class="fa fa-circle-o"></i>New</a></li>
          <li <?php echo $suppliersmdata; ?>><a href="supplieredit_delete.php"><i class="fa fa-circle-o"></i>Manage Data</a></li>
          <li <?php echo $suppliersmdata; ?>><a href="supplieredit_delete.php"><i class="fa fa-circle-o"></i>Shipping & Delivery Management (under) </a></li>
        </ul>
      </li>

      <li class="<?php echo $mainaccounts; ?>  treeview">
        <a href="#">
          <i class="fa fa-eyedropper"></i> <span>Manange Accounts</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php echo $accountsnew; ?>><a href="addaccount.php"><i class="fa fa-circle-o"></i> New</a></li>
          <li <?php echo $accountsmdata; ?>><a href="accountedit_delete.php"><i class="fa fa-circle-o"></i>Manage Accounts</a></li>
        </ul>
      </li>

      <!--Reports-->

      <li class="header">Reports</li>
      <li class="<?php echo $mainreports; ?> treeview">
        <a href="#">
          <i class="fa fa-table"></i> <span>Reports</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="report1.php"><i class="fa fa-circle-o"></i> Accounts Summary</a></li>
          <li><a href="report_sales_period.php"><i class="fa fa-circle-o"></i> Sales by Period</a></li>
          <li><a href="report_low_stock.php"><i class="fa fa-circle-o"></i> Low Stock</a></li>
          <li><a href="report_users.php"><i class="fa fa-circle-o"></i> Users List</a></li>
          <li><a href="report_suppliers.php"><i class="fa fa-circle-o"></i> Suppliers List</a></li>
          <li><a href="report_drugs.php"><i class="fa fa-circle-o"></i> Drugs Inventory</a></li>

        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>