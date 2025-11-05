<?php
include('dumper.php');
include('connection.php');

$today = date("Y-m-d");
$todayClock = date("H:i:s");
list($Tyear, $Tmonth, $Tday) = explode("-", $today);
list($Thour, $Tmin, $Tsec) = explode(":", $todayClock);

$SubName = $Tyear . "_" . $Tmonth . "_" . $Tday . "_" . $Thour . "_" . $Tmin;

try {
	$world_dumper = Shuttle_Dumper::create(array(
		'host' => $servername,
		'username' => $username,
		'password' => $password,
		'db_name' => $dbname,
	));

	// dump the database to gzipped file
	$world_dumper->dump('backupdb/' . $SubName . 'mmc.sql.gz');

	// dump the database to plain text file
	$world_dumper->dump('backupdb/' . $SubName . 'mmc.sql');
} catch (Shuttle_Exception $e) {
	echo "Couldn't dump database: " . $e->getMessage();
}
