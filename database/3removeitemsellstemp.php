<?php
echo "hello test";

$servername = "localhost";
$username = "root";
//$password = "";
//$password = "oracle";
$password = "oracleoracle";
$dbname = "mmc";
$conn = new mysqli($servername, $username, $password, $dbname);





#needed for fixing long distince database fixes
$result = $conn->query("SHOW COLUMNS FROM `itemsellstemp` LIKE 'orderno'");
$exists = (mysqli_num_rows($result)) ? TRUE : FALSE;
if ($exists) {
    $conn->query("ALTER TABLE `itemsellstemp` drop `orderno` ;");

    // do your stuff
} else {
    echo "there is here";
    //mysqli_query($link, "ALTER TABLE `accountp` ADD `orderno` BIGINT(100) NULL DEFAULT NULL AFTER `accountdate`;");
    //echo "there is not here ";
}
