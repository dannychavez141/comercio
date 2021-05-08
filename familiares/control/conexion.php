
<?php
     //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	$mysqli = new mysqli("localhost","root","","comercio");  
 //$mysqli = new mysqli("179.61.12.105","premiumc_premium","Losloles54","premiumc_pcoll");
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>