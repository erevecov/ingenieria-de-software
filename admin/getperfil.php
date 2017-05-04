<?php
require('../php/db.conf.php');

$db = pg_connect("host='$hostname' port='$port' dbname='$database' user='$user' password='$password'") or die('Connection Failed!');

$sql = "SELECT * FROM perfiles";
$result = pg_query($db, $sql) or die('SQL ERROR: 1 '.pg_last_error());

while ($row = pg_fetch_array($result)) {
	$id=$row['id_perfil'];
	$des=$row['descripcion'];
	$opciones.= "<option value=". $id .">". $des ."</option>";
}
echo $opciones;

//Liberamos la memoria (no creo que sea necesario con consultas tan simples)
pg_free_result($result);
 
//Cerramos la conexión
pg_close($db);
?>