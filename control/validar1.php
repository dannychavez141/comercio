<?php
require './conexion.php';
if (isset($_POST['txtusuario'])) {
	//VARIABLES DEL USUARIO
$usuario = $_POST['txtusuario'];
$pass = $_POST['txtpass'];
//VALIDAR CONTENIDO EN LAS VARIABLES O CAJAS DE TEXTO
if (empty($usuario) | empty($pass)) 
	{
	echo"<script language='javascript'>window.location='../index.php'</script>;";
	exit();
	}
//VALIDANDO EXISTENCIA DEL USUARIO
	$sqlQ="SELECT * FROM apoderado a
join tipoapoderado t on a.idtipoApoderado=t.idtipoApoderado
where a.dni='$usuario' and a.pass='$pass' and a.est='1';";
$sql = $mysqli->query($sqlQ);

if ($row = $sql->fetch_array()) 
		{
//		
//		setcookie('usuario',$row[3].' '.$row[4].' '.$row[2],time()+8000,'/',"premiumcollege.edu.pe");
//		setcookie('idUsuario',$row[0],time()+8000,'/',"premiumcollege.edu.pe");
//		setcookie('idtipo',5,time()+8000,'/',"premiumcollege.edu.pe");
//		setcookie('tipo',$row[11],time()+8000,'/',"premiumcollege.edu.pe");
		
		setcookie('usuario',$row[3].' '.$row[4].' '.$row[2],time()+8000,'/');
		setcookie('idUsuario',$row[0],time()+8000,'/');
		setcookie('idtipo',5,time()+8000,'/');
		setcookie('tipo',$row[11],time()+8000,'/');
		//creacion de historial
		$sql="INSERT INTO `historial` (`idUsuario`, `tabla`, `id`, `tablamod`, `descr`, `fecha`, `hora`, `est`, `apo`) 
VALUES ($row[0], 'apoderado', '$row[0]','apoderado', 'Inicio de Sesion ".$row[3].' '.$row[4].' '.$row[2]."-familiar', now(),now(),'1','$usuario');";



     // echo $sql;
      $rs=$mysqli->query($sql);

		echo"<script language='javascript'>window.location='../familiares/index.php'</script>;";
		}else
			{ 
			
			echo"<script language='javascript'>window.location='../login.php?msj=true'</script>;";
			exit();
		}
}
?>
