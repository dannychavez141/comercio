<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     $cur = $_POST['cur'];
     $tipo = $_POST['tipo'];
         $est = $_POST['est'];
          
   
        $sql="INSERT INTO `cursos` (`descr`, `idtipogrado`, `est`) VALUES ('$cur','$tipo', '$est');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../regCurso.php?tconf=true");
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
          $cur = $_POST['cur'];
              $tipo = $_POST['tipo'];
          $est = $_POST['est'];
     $sql="UPDATE `cursos` SET `descr`='$cur', `idtipogrado`='$tipo', `est`='$est' WHERE `idCursos`='$id';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../verCurso.php?tconf=true");
       exit;
            break;
      default:
        # code...
        break;
    }


?>