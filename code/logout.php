<?php
session_start();
include("dumperuser.php");
session_destroy();
header("location:index.php");
?>
