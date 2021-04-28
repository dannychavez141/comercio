<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     
         $idmad = $_POST['idmat'];
         $fecha = $_POST['fec'];
        $descr = $_POST['descr'];
         $tipo = $_POST['tipo'];
          $idusuario=$_COOKIE['idUsuario'];
          
   
        $sql="INSERT INTO `insidencias` 
        (`IdMat`, `idtipoIns`, `descr`, `tabla`, `id`, `fecha`, `est`) VALUES 
        ('$idmad', '$tipo', '$descr', 'usuario', '$idusuario', '$fecha', '1');";
      //  echo $sql;
   $mysqli->query($sql);
$sqlbuscar="SELECT ap.dni,a.nomb,a.apepa,a.apema  FROM matricula m 
join alumnos a on m.dnialu=a.dni
join apoderado ap on a.dniapo=ap.dni 
where m.idMatricula='$idmad';";
$apoderadobd=$mysqli->query($sqlbuscar);
$apoderado=mysqli_fetch_array($apoderadobd);
$sqlnoti="INSERT INTO `historial` (`idUsuario`, `tabla`, `id`, `tablamod`, `descr`, `fecha`, `hora`, `est`, `apo`) 
VALUES ('$idusuario', 'usuario', (select max(idinsidencias) from insidencias),'incidencia', 'INCIDENCIA REGISTRADA ".$apoderado[1].' '.$apoderado[2].' '.$apoderado[3]."', now(),now(),'1','$apoderado[0]');";
//echo $sqlnoti;
$mysqli->query($sqlnoti);
  header("Location: ../regInsidencia.php?tconf=true");
        exit;
            break;

      case 'M':
      $id = $_POST['id'];
         $idmad = $_POST['idmat'];
         $fecha = $_POST['fec'];
        $descr = $_POST['descr'];
         $tipo = $_POST['tipo'];
          $idusuario=$_COOKIE['idUsuario'];
         $est = $_POST['est'];
         
     $sql="UPDATE `insidencias` 
     SET `IdMat`='$idmad', `idtipoIns`='$tipo', `descr`='$descr', 
     `tabla`='usuario', `id`='$idusuario', `fecha`='$fecha', `est`='$est' WHERE `idinsidencias`='$id';";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../selecInsidencia.php?cod=".$idmad);
       exit;
            break;
      default:
        # code...
        break;
    }


?>