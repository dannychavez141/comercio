<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
     case 'R':
     $anio = $_POST['anio'];
     $grado = $_POST['grado'];
     $secc = $_POST['secc'];
     $iddoc = $_POST['iddoc'];
          $sql = "SELECT idTipo FROM grado where idGrado='$grado';";
 $tgrado=0;
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $tgrado=$datos[0];
                                        } 


   $query = "SELECT * FROM cursos c join estados e on c.est=e.idestados 
join tipogrado t on c.idtipogrado=t.idTipo where c.idtipogrado='$tgrado'";
                                        $cursos = $mysqli->query($query);
                                        while($curso = $cursos->fetch_array())
                                        { $idcur=$curso[0];
                                                echo $curso[1].'<br>';
                                                $sql="INSERT INTO `asigdocente` (`idDocente`, `idCursos`, `idGrado`, `idSeccion`, `idAnioEscolar`, `est`) VALUES ('$iddoc', '$idcur', '$grado', '$secc', '$anio', '1');";
                                                echo $sql;
                                                  $rs=$mysqli->query($sql);
                                                } 
       
   header("Location: ../regAsigPrim.php?cod=".$iddoc);
        exit;
            break;

      case 'M':
      $iddoc = $_POST['iddoc'];
     $sql="DELETE FROM `asigdocente` WHERE `idDocente`='$iddoc' ;";
        echo $sql;
         $rs=$mysqli->query($sql);
   header("Location: ../regAsigPrim.php?cod=".$iddoc);
       exit;
            break;
      default:
        # code...
        break;
    }


?>