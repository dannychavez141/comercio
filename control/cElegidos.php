<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     
         $dni1 = $_POST['id1'];
         $dni2 = $_POST['id2'];
         $descr1 = $_POST['descr1'];
         $descr2 = $_POST['descr2'];
      
        $sql="INSERT INTO `premiumc_premiumcollege`.`mural` (`idmat1`, `descr`, `idmat2`, `descr2`, `fecha`, `est`) VALUES ('$dni1', '$descr1', '$dni2', '$descr2', now(), '1');";
        echo $sql;
   $rs=$mysqli->query($sql);
  header("Location: ../verElegidos.php?tconf=true");
        exit;
            break;

      case 'M':
     /* $id = $_POST['id'];
          $anio = $_POST['anio'];
         $est = $_POST['est'];
     $sql="UPDATE `anioescolar` SET `descr`='$anio', `est`='$est' WHERE `idAnioEscolar`='$id';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../verAnio.php?tconf=true");
       exit;*/
            break;
      default:
        # code...
        break;
    }


?>