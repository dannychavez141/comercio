<?php
require 'conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
	
$idmat = $_POST['idmat'];

$modo=0;
$query = "call verunamatricula($idmat);";
$resultado = $mysqli->query($query);
while($row = $resultado->fetch_array())
{   $modo=1;                                           
$alumno = array(
		0 => $row[1], 
		1 => $row[2], 
		2 => $row[0],
		3 => $row[4],
		4 => $modo
		
);}

echo json_encode($alumno);

?>

