<?php
require('db.conf.php');

$db = pg_connect("host='$hostname' port='$port' dbname='$database' user='$user' password='$password'") or die('Connection Failed!');

if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT id, name, lastname FROM users WHERE email = '$email' AND password = '$password'";
	$result = pg_query($db, $sql) or die('SQL ERROR: 1 '.pg_last_error());

	$row = pg_fetch_array($result);

	if( $row['id'] ) {
		session_start();
		$_SESSION['userVars'] = $row;
		header("Location: ../home.php");	
	}else {
		header("Location: ../index.php");
	}
	
}else {
	header("Location: ../index.php");	
}

?>