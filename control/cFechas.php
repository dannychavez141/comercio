<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     $descr = $_POST['descr'];
     $dia = $_POST['dia'];
      $mes = $_POST['mes'];
         $est = $_POST['est'];
          
   
        $sql="INSERT INTO `calendario` (`descr`, `dia`, `mes`, `ext`, `est`) VALUES ('$descr', '$dia', '$mes', '0', '$est');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../regFechas.php?tconf=true");
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
       $descr = $_POST['descr'];
     $dia = $_POST['dia'];
      $mes = $_POST['mes'];
         $est = $_POST['est'];
     $sql="UPDATE `calendario` SET `descr`='$descr', `dia`='$dia', `mes`='$mes', `est`='$est' WHERE `idcalendario`='$id';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../verFechas.php?tconf=true");
       exit;
            break;
      default:
        # code...
        break;
    }


?>