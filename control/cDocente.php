<?php
//error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion."<br>";
    switch ($accion) {
     case 'R':
     $dni = $_POST['dni'];
         $nom = $_POST['nom'];
          $apepa = $_POST['apepa'];
          $apema = $_POST['apema'];
         $dir = $_POST['dir'];
         $telf = $_POST['telf'];
         $con = $_POST['con'];
          $sex = $_POST['sex'];
          $idtipo = $_POST['tipo'];
          $est = $_POST['est'];
           $fnac = $_POST['fnac'];
            $detcargo = $_POST['detcargo'];
         $ext='png';
          $url=$_SERVER['DOCUMENT_ROOT'].'/img/docentes/';
  if($_FILES['file']['name'] != null && $_FILES['file']['size'] > 0 )
{ $archivo=new SplFileInfo($_FILES['file']['name']);
$ext=$archivo->getExtension();
 $destino= $url.$dni.'.'.$ext;
move_uploaded_file($_FILES['file']['tmp_name'],$destino);
$sql="INSERT INTO `docente` (`dni`, `nomb`, `apepa`, `apema`, `fnac`, `telf`, `dir`, `pass`,`ext`, `idsex`, `est`, `idtipo`,`detalle`) VALUES ('$dni', '$nom', '$apepa', '$apema','$fnac', '$telf', '$dir ', '$con', '$ext', '$sex', ' $est','$idtipo','$detcargo');";
  echo $sql;
  $rs=$mysqli->query($sql);
 header("Location: ../regDocente.php?tconf=true");
}else{ $sql="INSERT INTO `docente` (`dni`, `nomb`, `apepa`, `apema`, `fnac`, `telf`, `dir`, `pass`, `idsex`, `est`, `idtipo`,`detalle`) VALUES ('$dni', '$nom', '$apepa', '$apema','$fnac', '$telf', '$dir ', '$con', '$sex', '$est','$idtipo','$detcargo');";
  echo $sql;
 $rs=$mysqli->query($sql);
 header("Location: ../regDocente.php?tconf=false");
} exit;
 break;
      case 'M':
      $id = $_POST['id'];
       $dni = $_POST['dni'];
         $nom = $_POST['nom'];
          $apepa = $_POST['apepa'];
          $apema = $_POST['apema'];
         $dir = $_POST['dir'];
         $telf = $_POST['telf'];
         $con = $_POST['con'];
         $idtipo = $_POST['tipo'];
          $sex = $_POST['sex'];
          $est = $_POST['est'];
           $fnac = $_POST['fnac'];
            $detcargo = $_POST['detcargo'];
          $ext='png';
          $url=$_SERVER['DOCUMENT_ROOT'].'/img/docentes/'; 
  if($_FILES['file']['name'] != null && $_FILES['file']['size'] > 0 )
{ $archivo=new SplFileInfo($_FILES['file']['name']);
$ext=$archivo->getExtension();
 $destino= $url.$dni.'.'.$ext;
move_uploaded_file($_FILES['file']['tmp_name'],$destino);
$sql="UPDATE `docente` SET `dni`='$dni', `nomb`='$nom', `apepa`='$apepa', `apema`='$apema', 
`fnac`='$fnac ', `telf`='$telf', `dir`='$dir ', `pass`='$con', `ext`='$ext', `idsex`='$sex', `est`='$est',`idtipo`='$idtipo' ,`detalle`='$detcargo'
WHERE `idDocente`='$id';";
  echo $sql;
  $rs=$mysqli->query($sql);
 header("Location: ../verDocente.php?tconf=true");
}else{
  $sql="UPDATE `docente` SET `dni`='$dni', `nomb`='$nom', `apepa`='$apepa', `apema`='$apema', 
`fnac`='$fnac ', `telf`='$telf', `dir`='$dir ', `pass`='$con', `idsex`='$sex', `est`='$est' ,`idtipo`='$idtipo',`detalle`='$detcargo'
WHERE `idDocente`='$id';";
  echo $sql;
  $rs=$mysqli->query($sql);
  header("Location: ../verDocente.php?tconf=false");
}exit;
break;
      default:
        # code...
        break;
    }


?>