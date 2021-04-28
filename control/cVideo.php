<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     /*
     $anio = $_POST['anio'];
         $est = $_POST['est'];
          
   
        $sql="INSERT INTO `anioescolar` (`descr`, `est`) VALUES ('$anio', '$est');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../regAnio.php?tconf=true");*/
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
          $url = $_POST['url'];
         $est = $_POST['est'];
     $sql="UPDATE `video` SET `url`='$url', `est`='$est' WHERE `idvideo`='$id ';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../video.php?tconf=true");
       exit;
            break;
      default:
        # code...
        break;
    }


?>