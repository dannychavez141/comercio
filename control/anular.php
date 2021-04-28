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

$sql="UPDATE `deuda` SET `est`='5' WHERE `idDeuda`='$id';";
$mysqli->query($sql);
 $sql="INSERT INTO `historial` (`idUsuario`, `tabla`, `id`, `tablamod`, `descr`, `fecha`, `hora`) 
VALUES ($idusuario, 'usuario', '$id','deuda', 'Anulo deuda Nro ".$id."', now(),now());";
      echo $sql;
     $mysqli->query($sql);
     header("Location: ../verDeudas.php?tconf=true");

 ?>