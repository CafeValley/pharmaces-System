<?php error_reporting(E_ALL); ?>

<?php
session_start();
if (session_id() == "") {
    echo "Nothing works!";
    exit();
}
ob_start();

date_default_timezone_set("Africa/Khartoum");
if (isset($_SESSION['suser_name']))
    $suser_name = $_SESSION['suser_name'];
if (isset($_SESSION['utype']))
    $stype = $_SESSION['utype'];

$servername = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USER') ?: "root";
//$password = "";
//$password = "oracle";
$password = getenv('DB_PASS') ?: "oracleoracle";
$dbname = getenv('DB_NAME') ?: "mmc";
$conn = new mysqli($servername, $username, $password, $dbname);

// Simple auth guard: allow public pages, protect others
$currentScript = basename($_SERVER['PHP_SELF'] ?? '');
$publicScripts = array('login.php');
if (!in_array($currentScript, $publicScripts)) {
    if (empty($_SESSION['suser_name'])) {
        header('Location: login.php');
        exit();
    }
}

$today = date("Y-m-d");
$todayClock = date("H:i:s");
list($Tyear, $Tmonth, $Tday) = explode("-", $today);
list($Thour, $Tmin, $Tsec) = explode(":", $todayClock);
//here to set the date , with the correct format
//$today = "2017-12-14";

$maindashboard = '';
$mainsells     = '';
$maindrags     = '';
$mainusers     = '';
$mainsuppliers = '';
$mainaccounts  = '';
$mainreports   = '';


$home          = '';

$sells       = '';
$sellsreturn = '';

$dragsnew      = '';
$dragsmdata    = '';
$dragsprices   = '';
$dragsquanties = '';
$dragspackage  = '';
$dragslimmit   = '';
$dragsbarcode  = '';

$usersnew      = '';
$usersmdata    = '';


$suppliersnew   = '';
$suppliersmdata = '';

$accountsnew    = '';
$accountsmdata  = '';


$report1  = '';
?>