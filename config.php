<?php
//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$con = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
?>
<?php

ini_set('display_error', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);

session_start();

date_default_timezone_set("Europe/Istanbul");

define('ROOT', '/auction-management-system');
define('PROJECT', dirname(__file__));


// $dbhost = "localhost";
// $dbuser = "root";
// $dbpass = "";
// $dbname = "auctiondb";

// $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno()) {
	die(mysqli_connect_error());
}

function checkError($sql) {
	global $con;

	if(mysqli_errno($con)) {
		die(mysqli_error($con) . "<br>" . $sql);
	}
}

if (strpos($_SERVER['SCRIPT_FILENAME'], '/dashboard') !== false) {
	if (!isset($_SESSION['id'])) {
		header('location: ' . ROOT . '/auth/login.php');
	}
}

if (isset($_SESSION['id'])) {
	$query = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";
	$result = mysqli_query($con, $query);

	checkError($query);

	if (mysqli_num_rows($result) === 1){
		$auth = mysqli_fetch_assoc($result);
	}
}