<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     
     $anio = $_POST['anio'];
         $est = $_POST['est'];
          
   
        $sql="INSERT INTO `anioescolar` (`descr`, `est`) VALUES ('$anio', '$est');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../regAnio.php?tconf=true");
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
          $anio = $_POST['anio'];
         $est = $_POST['est'];
     $sql="UPDATE `anioescolar` SET `descr`='$anio', `est`='$est' WHERE `idAnioEscolar`='$id';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../verAnio.php?tconf=true");
       exit;
            break;
      default:
        # code...
        break;
    }


?>