<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
$modo=$_GET['modo'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     $idcur = $_POST['idcur'];
     $descr = $_POST['descr'];
         $est = $_POST['est'];
          
   
        $sql="INSERT INTO `competencias` (`idcurso`, `descr`, `est`) VALUES ('$idcur','$descr', '$est');";
        echo $sql;
   $rs=$mysqli->query($sql);
   header("Location: ../capacidades.php?cod=".$idcur."&&modo=".$modo);
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
          $idcur = $_POST['idcur'];
     $descr = $_POST['descr'];
         $est = $_POST['est'];
     $sql="UPDATE `competencias` SET `idcurso`='$idcur', `descr`='$descr', `est`=' $est' WHERE `idComp`='$id';";
        echo $sql;
       $rs=$mysqli->query($sql);
   header("Location: ../capacidades.php?cod=".$idcur."&&modo=".$modo);
       exit;
            break;
      default:
        # code...
        break;
    }


?>