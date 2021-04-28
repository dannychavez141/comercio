<?php 
session_start();
if (isset($_COOKIE['usuario'])) {
    echo "";
}else{
    header("Location: ../login.php");
    exit();
}
$usuario=$_COOKIE['usuario'];
$idusuario=$_COOKIE['idUsuario'];
$idtipo=$_COOKIE['idtipo'];
$tipo=$_COOKIE['tipo'];
if ($idtipo!=1) {
    header("Location: ../login.php");
    exit();
}
require 'conexion.php';
$id=$_GET['cod'];
$deuda=$_GET['deu'];
$sql="UPDATE `pago` SET `est` = '5' WHERE (`idpago` = '$id');";
$mysqli->query($sql);
 $sql="INSERT INTO `historial` (`idUsuario`, `tabla`, `id`, `tablamod`, `descr`, `fecha`, `hora`) 
VALUES ($idusuario, 'usuario', '$id','pago', 'Anulo Pago Nro ".$id."', now(),now());";
     // echo $sql;
     $mysqli->query($sql);
 $sql="UPDATE `deuda` SET `est`='1' WHERE `idDeuda`='$deuda';";
$mysqli->query($sql);
 $sql="INSERT INTO `historial` (`idUsuario`, `tabla`, `id`, `tablamod`, `descr`, `fecha`, `hora`) 
VALUES ($idusuario, 'usuario', '$id','deuda', 'Se Reactivo deuda Nro ".$deuda."', now(),now());";
      //echo $sql;
     $mysqli->query($sql);
     header("Location: ../verPagos.php?tconf=true");

 ?>