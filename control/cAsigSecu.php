<?php
///error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     $anio = $_POST['anio'];
     $grado = $_POST['grado'];
     $secc = $_POST['secc'];
     $iddoc = $_POST['iddoc'];
          $idcur = $_POST['curso'];
 
     $sql="INSERT INTO `asigdocente` (`idDocente`, `idCursos`, `idGrado`, `idSeccion`, `idAnioEscolar`, `est`) VALUES ('$iddoc', '$idcur', '$grado', '$secc', '$anio', '1');";
       echo $sql;
      $rs=$mysqli->query($sql);
                                                
       
   header("Location: ../regAsigSecu.php?cod=".$iddoc);
        exit;
            break;

      case 'M':

      $anio = $_POST['anio'];
     $grado = $_POST['grado'];
      $secc = $_POST['secc'];
     $iddoc = $_POST['iddoc'];
          $idcur = $_POST['curso'];
     $sql="DELETE FROM `asigdocente` WHERE `idDocente`='$iddoc' and`idCursos`='$idcur' and`idGrado`='$grado' and`idSeccion`='$secc' and`idAnioEscolar`='$anio';";
        echo $sql;
         $rs=$mysqli->query($sql);
 header("Location: ../regAsigSecu.php?cod=".$iddoc);
       exit;
            break;
      default:
        # code...
        break;
    }


?>