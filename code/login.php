<?php
$formtitle = "Medicine";
$formaction = "adddragpackage.php";
$systemname = "MMC";
include('connection.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $systemname; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          </ul>
        </div>
      </nav>
    </header>

    </head>

    <body class="hold-transition login-page">
      <div class="login-box">
        <div class="login-logo">
          <font color='white'><?php echo $systemname; ?></font>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <?php
          if (isset($_POST['btnlogin'])) {
            $username = $_POST['formusername'];
            $password = $_POST['formpassword'];
            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);

            // Fetch user by username
            $stmt = $conn->prepare("SELECT id, usertype, password FROM `users` WHERE `username` = ? LIMIT 1");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $res = $stmt->get_result();
            $row = $res ? $res->fetch_assoc() : null;

            $loginOk = false;
            if ($row) {
              $stored = $row['password'];
              // Backward compatibility: accept old plaintext, or verify hash
              if (password_get_info($stored)['algo']) {
                $loginOk = password_verify($password, $stored);
              } else {
                $loginOk = hash_equals($stored, $password);
                if ($loginOk) {
                  // Upgrade to hashed password
                  $newHash = password_hash($password, PASSWORD_DEFAULT);
                  $up = $conn->prepare("UPDATE `users` SET `password` = ? WHERE id = ?");
                  $up->bind_param("si", $newHash, $row['id']);
                  $up->execute();
                }
              }
            }

            if ($loginOk) {
              $_SESSION['suser_name'] = $username;
              $_SESSION['utype'] = $row['usertype'];
              // Update last login
              $up2 = $conn->prepare("UPDATE `users` SET `M_last_login`= NOW() WHERE id = ?");
              $up2->bind_param("i", $row['id']);
              $up2->execute();
              echo $_SESSION['utype'];
            } else {
              echo "<center><font size = '4' color='red'>Wrong Username or Password</font></center>";
            }
          }

          //print_r($_POST);
          ?>

          <form action="login.php" method="post">
            <div class="form-group has-feedback">
              <input name="formusername" type="text" class="form-control" placeholder="User Name">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input name="formpassword" type="password" class="form-control" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-4">

              </div>
              <div class="col-xs-4">
                <button type="submit" name="btnlogin" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </body>

</html>