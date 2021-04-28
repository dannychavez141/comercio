<?php
error_reporting(0);
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
          $tipo = $_POST['tipo'];
          $est = $_POST['est'];
           $fnac = $_POST['fnac'];
         $ext='';
          $url=$_SERVER['DOCUMENT_ROOT'].'/img/usuarios/';
  if($_FILES['file']['name'] != null && $_FILES['file']['size'] > 0 )
{ $archivo=new SplFileInfo($_FILES['file']['name']);
$ext=$archivo->getExtension();
 $destino= $url.$dni.'.'.$ext;
move_uploaded_file($_FILES['file']['tmp_name'],$destino);
$sql="INSERT INTO `usuario` (`dni`, `nomb`, `apepa`, `apema`, `fnac`, `telf`, `dir`, `idTipoUsuario`, `pass`, `ext`, `idsex`, `est`) VALUES ('$dni', '$nom', '$apepa', '$apema','$fnac', '$telf', '$dir', '$tipo', '$con', '$ext', '$sex', '1');";
  echo $sql;
  $rs=$mysqli->query($sql);
 header("Location: ../regUsuario.php?tconf=true");
}
else
{  $sql="INSERT INTO `usuario` (`dni`, `nomb`, `apepa`, `apema`, `fnac`, `telf`, `dir`, `idTipoUsuario`, `pass`, `idsex`, `est`) VALUES ('$dni', '$nom', '$apepa', '$apema','$fnac', '$telf', '$dir', '$tipo', '$con', '$sex', '1');";
  echo $sql;
 $rs=$mysqli->query($sql);
 header("Location: ../regUsuario.php?tconf=false");
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
         $tipous = $_POST['tipous'];
          $sex = $_POST['sex'];
          $est = $_POST['est'];
           $fnac = $_POST['fnac'];
          $ext='png';
          $url=$_SERVER['DOCUMENT_ROOT'].'/img/usuarios/';
 
  if($_FILES['file']['name'] != null && $_FILES['file']['size'] > 0 )
{ $archivo=new SplFileInfo($_FILES['file']['name']);
$ext=$archivo->getExtension();
 $destino= $url.$dni.'.'.$ext;
move_uploaded_file($_FILES['file']['tmp_name'],$destino);
$sql="UPDATE `usuario` SET `dni`='$dni', `nomb`='$nom', `apepa`='$apepa', `apema`='$apema', 
`fnac`='$fnac ', `telf`='$telf', `dir`='$dir ', `pass`='$con', `ext`='$ext', `idsex`='$sex', `est`='$est',`idTipoUsuario`='$tipous' 
WHERE `idUsuario`='$id';";
  echo $sql;
  $rs=$mysqli->query($sql);
 header("Location: ../verUsuarios.php?tconf=true");
}
else{
  $sql="UPDATE `usuario` SET `dni`='$dni', `nomb`='$nom', `apepa`='$apepa', `apema`='$apema', 
`fnac`='$fnac ', `telf`='$telf', `dir`='$dir ', `pass`='$con', `idsex`='$sex', `est`='$est',`idTipoUsuario`='$tipous' 
WHERE `idUsuario`='$id';";
  echo $sql;
 $rs=$mysqli->query($sql);
 header("Location: ../verUsuarios.php?tconf=false");
}exit;
break;
      default:
        # code...
        break;
    }


?>