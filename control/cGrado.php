<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     $grado = $_POST['grado'];
     $tipo = $_POST['tipo'];
         $est = $_POST['est'];
          
   
        $sql="INSERT INTO `grado` (`descr`, `idTipo`, `est`) VALUES ('$grado', '$tipo', '$est');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../regGrado.php?tconf=true");
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
           $grado = $_POST['grado'];
     $tipo = $_POST['tipo'];
         $est = $_POST['est'];
     $sql="UPDATE `grado` SET `descr`='$grado', `idTipo`='$tipo', `est`='$est' WHERE `idGrado`='$id';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../verGrado.php?tconf=true");
       exit;
            break;
      default:
        # code...
        break;
    }


?>