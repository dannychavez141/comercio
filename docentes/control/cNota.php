<?php  

error_reporting(0);

if (isset($_COOKIE['usuario'])) {
    echo "";
}else{
    header("Location: ../../login.php");
    exit();
}
$usuario=$_COOKIE['usuario'];
$idusuario=$_COOKIE['idUsuario'];
$idtipo=$_COOKIE['idtipo'];
$tipo=$_COOKIE['tipo'];
if ($idtipo!=4) {
    header("Location: ../../login.php");
    exit();
}
require 'conexion.php';
$idmat=$_GET['mat'];
$peri=$_GET['peri'];

$comp=$_REQUEST['comp'];
$notas=$_REQUEST['notas'];
for ($i=0; $i <count($comp)  ; $i++) { 
	 $sql="UPDATE `notasalumno` SET `nota$peri`='$notas[$i]' WHERE `idMatricula`='$idmat' and`idComp`='$comp[$i]';";
        echo $sql;
         $rs=$mysqli->query($sql);
}
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
?>