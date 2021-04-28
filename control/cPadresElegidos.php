<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion."<br>";
    switch ($accion) {
     case 'R':
     $data = strtoupper($_POST['data']);
         $descr = $_POST['descr'];
  
          
          $ext='png';
          $url=$_SERVER['DOCUMENT_ROOT'].'/img/padres/';
  if($_FILES['file']['name'] != null && $_FILES['file']['size'] > 0 )
{ $archivo=new SplFileInfo($_FILES['file']['name']);
$ext=$archivo->getExtension();
 $destino= $url.'1.'.$ext;
move_uploaded_file($_FILES['file']['tmp_name'],$destino);
$sql="INSERT INTO `apoelegidos` (`padres`, `descr`, `ext`) VALUES ('$data', '$descr', '$ext');";
  echo $sql;
  $rs=$mysqli->query($sql);
 header("Location: ../regAlumno.php?tconf=true");
}
else
{
  $sql="INSERT INTO `apoelegidos` (`padres`, `descr`, `ext`) VALUES ('$data', '$descr', '0');";
  echo $sql;
  $rs=$mysqli->query($sql);
  header("Location: ../verPadresElegidos.php");
} exit;
 break;
 

      default:
        # code...
        break;
    }


?>