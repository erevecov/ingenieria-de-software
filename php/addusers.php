<?php
require('db.conf.php');

$db = pg_connect("host='$hostname' port='$port' dbname='$database' user='$user' password='$password'") or die('Connection Failed!');

if (isset($_POST['email_user']) && isset($_POST['name_user']) && isset($_POST['passwd_user']) && isset($_POST['perfil_user']) && isset($_POST['palette'])) {
	$email = $_POST['email_user'];
	$user = $_POST['name_user'];
	$passwd = $_POST['passwd_user'];
	$perfil = $_POST['perfil_user'];
	$palette = $_POST['palette'];

	$sql = "INSERT INTO usuarios(email, usuario, password, id_perfil, palette) VALUES ('$email', '$user', '$passwd', '$perfil', '$palette')";
	$result = pg_query($db, $sql) or die('SQL ERROR: 1 '.pg_last_error());
	
	echo $result;
}
?>
