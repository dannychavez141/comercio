<?php
require 'conexion.php';
$accion = $_POST['baccion'];
$modo=$_GET['modo'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     
     $descr = $_POST['descr'];
         $est = $_POST['est'];
          
        $sql="INSERT INTO `tipogrado` (`descr`, `est`) VALUES ('$descr', '$est');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../niveleducativo.php");
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
     $descr = $_POST['descr'];
         $est = $_POST['est'];
     $sql="UPDATE `tipogrado` SET `descr` = '$descr', `est` = '$est' WHERE (`idTipo` = '$id');";
        echo $sql;
       $rs=$mysqli->query($sql);
   header("Location: ../niveleducativo.php");
       exit;
            break;
      default:
        # code...
        break;
    }


?>