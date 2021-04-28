<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     
         $idmad = $_POST['idmat'];
         $fecha = $_POST['fec'];
        $descr = $_POST['descr'];
         $tipo = $_POST['tipo'];
          $idusuario=$_COOKIE['idUsuario'];
          
   
        $sql="INSERT INTO `insidencias` 
        (`IdMat`, `idtipoIns`, `descr`, `tabla`, `id`, `fecha`, `est`) VALUES 
        ('$idmad', '$tipo', '$descr', 'docente', '$idusuario', '$fecha', '1');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../selecAlumno.php?tconf=true");
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
         $idmat = $_POST['idmat'];
         $fecha = $_POST['fec'];
        $descr = $_POST['descr'];
         $tipo = $_POST['tipo'];
          $idusuario=$_COOKIE['idUsuario'];
         $est = $_POST['est'];
         
     $sql="UPDATE `insidencias` 
     SET `IdMat`='$idmat', `idtipoIns`='$tipo', `descr`='$descr', 
     `tabla`='docente', `id`='$idusuario', `fecha`='$fecha', `est`='$est' WHERE `idinsidencias`='$id';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../verIncidencia.php");
       exit;
            break;
      default:
        # code...
        break;
    }


?>