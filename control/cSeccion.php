<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     
     $sec = $_POST['sec'];
         $est = $_POST['est'];
          
   
        $sql="INSERT INTO `seccion` (`descr`, `est`) VALUES ('$sec', '$est');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../regSeccion.php?tconf=true");
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
          $sec = $_POST['sec'];
         $est = $_POST['est'];
     $sql="UPDATE `seccion` SET `descr`='$sec', `est`='$est' WHERE `idSeccion`='$id';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../verSeccion.php?tconf=true");
       exit;
            break;
      default:
        # code...
        break;
    }


?>