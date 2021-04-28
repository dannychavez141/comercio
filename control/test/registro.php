<?php 
	error_reporting(0);
 //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	//$mysqli = new mysqli("localhost","root","","premiumc_premiumcollege");  
 $mysqli = new mysqli("179.61.12.105","premiumc_premium","Losloles54","premiumc_premiumcollege");
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
//$serial = $_GET['SERIE'];
$id = $_GET['id'];
     $sql="UPDATE `temp` SET `codigo` = '$id' WHERE `idtemp` = '1'";
      // echo $sql;
         $rs=$mysqli->query($sql);
         $mysqli->close();
        // ob_end_clean();
echo "#".$id."#";
?>
