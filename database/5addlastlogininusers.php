<?php
echo "hello test";

$servername = "localhost";
$username = "root";
//$password = "";
$password = "oracleoracle";
//$password = "oracleoracle";
$dbname = "mmc";
$conn = new mysqli($servername, $username, $password, $dbname);




#needed for fixing long distince database fixes
$result = $conn->query("SHOW COLUMNS FROM `users` LIKE 'M_last_login'");
$exists = (mysqli_num_rows($result)) ? TRUE : FALSE;
if ($exists) {
    echo "there is here";
    echo " ";
    // do your stuff
} else {
    $conn->query("ALTER TABLE `users` ADD `M_last_login` DATETIME  DEFAULT NULL AFTER `usertype`;");
    //$conn->query("ALTER TABLE `items` drop `itemcode` ;");

    //mysqli_query($link, "ALTER TABLE `accountp` ADD `orderno` BIGINT(100) NULL DEFAULT NULL AFTER `accountdate`;");
    //echo "there is not here ";
}
