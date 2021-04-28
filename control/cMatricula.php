<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
$opc = $_POST['opc'];
if ($opc=='Prim') {
  $tipo=1;
}else{
$tipo=2;
}

  //  echo "go?".$accion."<br>";
    switch ($accion) {
     case 'R':
     $dni = $_POST['dni'];
     $grado = $_POST['grado'];
     $seccion = $_POST['seccion'];
     $usuario = $_COOKIE['idUsuario'];
       $anio = $_POST['anio'];
       $tmat = $_POST['tmat'];
       $vacante = $_POST['vacante'];
         $est = $_POST['est'];
 $sql = "SELECT idTipo FROM grado where idGrado='$grado';";
 $tgrado=0;
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $tgrado=$datos[0];
                                        }

        $sql="INSERT INTO `matricula` (`dnialu`, `idGrado`, `idSeccion`, `idAnioEscolar`, `idUsuario`, `fecha`, `hora`, `est`, `idtipomat`) VALUES ('$dni', '$grado', '$seccion', '$anio', '$usuario', now(), now(), '$est', '$tmat');";
       // echo $sql."<br>";
   $mysqli->query($sql);
   $idmat=1;
$query = "SELECT max(idMatricula) FROM matricula;";
        $resultado = $mysqli->query($query);
         while($row = $resultado->fetch_array())
          {if ($row[0]!=null) {
            $idmat=$row[0]; 
          } 
           } 
           $query = "SELECT * FROM tipomatricula where idtipomatricula='$tmat';";
        $resultado = $mysqli->query($query);
         while($row = $resultado->fetch_array())
          {
            $mes= date('m');
  $an= date('Y');
  $dia= date('d');
  $hoy=$an."-".$mes."-".$dia;
  if($mes==12){
  $mvenci=1;
  $van=$an+1;
}else
{$mvenci=$mes+1;
 $van=$an;
}
$vencimiento= $an."-".$mvenci."-15";       
      $sql="INSERT INTO `deuda` (`idMatricula`, `idTipoDeuda`, `fecha`, `hora`, `vencimiento`, `monto`, `interes`, `est`, `descr`) VALUES ('$idmat','1',now(),now(),'$vencimiento',$row[3],0,1,'Matricula ".$an."');";     
            $mysqli->query($sql);
           // echo $sql."<br>";
            if ($vacante=='1') {
        $sql="INSERT INTO `deuda` (`idMatricula`, `idTipoDeuda`, `fecha`, `hora`, `vencimiento`, `monto`, `interes`, `est`, `descr`)
        VALUES ('$idmat','2',now(),now(),'$vencimiento','50.00',0,1,'Vacante ".$an."');";     
       // echo $sql."<br>";
            $mysqli->query($sql);
            }
              
          }
       //    echo $idmat."<br>" ;

$query = "SELECT * FROM cursos where idtipogrado=$tgrado and est='1';";
        $resultado = $mysqli->query($query);
         while($row = $resultado->fetch_array())
          { $idcur=$row[0]; 
 //echo "curso:".$row[0]."<br>" ;
        $query = "SELECT * FROM competencias where idcurso=$idcur";
        $resul = $mysqli->query($query);
         while($row1 = $resul->fetch_array())
          { $idcom=$row1[0]; 

          echo "competencia:".$row1[0]."<br>" ;
  $sql="INSERT INTO `notasalumno` (`idMatricula`, `idComp`, `nota1`, `nota2`, `nota3`, `nota4`) VALUES ('$idmat', '$idcom', '-1', '-1', '-1', '-1');";
  // echo $sql."<br>";
   $mysqli->query($sql);

           } 

           } 
//echo $opc;
  header("Location: ../regMat".$opc.".php?tconf=true");
        exit;
            break;
      case 'M':
      $id = $_POST['id'];
     $grado = $_POST['grado'];
     $seccion = $_POST['seccion'];
     $usuario = $_COOKIE['idUsuario'];
       $anio = $_POST['anio'];
       $tipo = $_POST['tipo'];
        $tmat = $_POST['tmat'];
         $est = $_POST['est'];
     $sql="UPDATE `matricula` SET `idGrado` = '$grado', `idSeccion` = '$seccion',`idtipomat` = '$tmat' , `idUsuario` = '$usuario', `est` = '$est' WHERE (`idMatricula` = '$id');";
      //  echo $sql;
        $rs=$mysqli->query($sql);
        if ($tipo==2) {
          header("Location: ../verMatSecu.php?tconf=true");
        }else{ 
         header("Location: ../verMatPrim.php?tconf=true");}
 
       exit;
            break;
      default:
        # code...
        break;
    }


?>