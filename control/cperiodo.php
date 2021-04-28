<?php

require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     
     $descr = $_POST['descr'];
         $est = $_POST['est'];
          
   
        $sql="INSERT INTO `periodos` (`descr`, `est`) VALUES ('s', 's');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../regAnio.php?tconf=true");
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
         $est = $_POST['est'];
     $sql="UPDATE `periodos` SET `est`='$est' WHERE `idPeriodos`='$id';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../verPeriodos.php?tconf=true");
       exit;
            break;
      default:
        # code...
        break;
    }


?>