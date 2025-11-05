<?php
echo "hello test";

$servername = "localhost";
$username = "root";
//$password = "";
$password = "oracleoracle";
//$password = "oracleoracle";
$dbname = "mmc";
$conn = new mysqli($servername, $username, $password, $dbname);


//$qry = "SELECT * FROM items";
$qry = "COL_LENGTH('items','itemcode') IS NOT NULL";


#needed for fixing long distince database fixes
$result = $conn->query("SHOW COLUMNS FROM `items` LIKE 'itemcode'");
$exists = (mysqli_num_rows($result)) ? TRUE : FALSE;
if ($exists) {
    echo "there is here";
    echo " ";
    // do your stuff
} else {
    $conn->query("ALTER TABLE `items` ADD `itemcode` varchar(255) DEFAULT NULL AFTER `itemname`;");
    //$conn->query("ALTER TABLE `items` drop `itemcode` ;");

    //mysqli_query($link, "ALTER TABLE `accountp` ADD `orderno` BIGINT(100) NULL DEFAULT NULL AFTER `accountdate`;");
    //echo "there is not here ";
}
