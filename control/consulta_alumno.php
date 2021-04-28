<?php
require 'conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
	
$dni = $_POST['dni'];
$idanio = $_POST['idanio'];

$modo=0;
$query = "SELECT * FROM matricula m 
join alumnos a on m.dnialu=a.dni  where m.dnialu='$dni' and m.idAnioEscolar='$idanio' AND m.est='1';";
$resultado = $mysqli->query($query);
while($row = $resultado->fetch_array())
{   $modo=1;                                           
$apo = array(
		0 => $dni, 
		1 => $row[2], 
		2 => $row[3],
		3 => $row[4],
		4 => $modo
		
);}

if ($modo==0) {
$query = "SELECT * FROM alumnos where dni='$dni';";
$resultado = $mysqli->query($query);
while($row = $resultado->fetch_array())
{                                              
$apo = array(
		0 => $dni, 
		1 => $row[2], 
		2 => $row[3],
		3 => $row[4],
		4 => $modo
		
);}
}

echo json_encode($apo);


