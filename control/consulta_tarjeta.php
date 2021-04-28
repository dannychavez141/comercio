<?php
require 'conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
//OBTENEMOS EL VALOR
$id=$_POST['id'];
$igual=false;
$alumno="";
if ($id!="") {
	# code...

$query1 = "SELECT * FROM alumnos where targeta='$id';";

$resultado = $mysqli->query($query1);
while($row = $resultado->fetch_array())
{      
$igual=true;
$alumno=$row[3]." ".$row[4]." ".$row[2];
}
}

$query = "SELECT * FROM temp limit 1;";
$resultado = $mysqli->query($query);
while($row = $resultado->fetch_array())
{      




$apo = array(
		0 => $id, 
		1 => $row[1], 
		2 =>$igual,
		3 =>$alumno,
		4 =>$query1
		
);}


echo json_encode($apo);

?>
