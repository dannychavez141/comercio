<?php
require 'conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
	
$dni = $_POST['dni'];

//OBTENEMOS EL VALOR

$query = "SELECT * FROM apoderado where dni='$dni';";
$resultado = $mysqli->query($query);
while($row = $resultado->fetch_array())
{                                              
$apo = array(
		0 => $dni, 
		1 => $row[2], 
		2 => $row[3],
		3 => $row[4],
		4 => $row[0]
		
);}


echo json_encode($apo);

?>
