<?php
$key=$_GET['id'];
function marcar($key){
    $evento="";
    if (isset($_GET['id'])) {
   
        $cod=$_GET['id'];
        include '../control/cConexion.php';
include '../modelo/dboanioescolar.php';
include '../modelo/dboAsistenciaDocente.php';
include '../modelo/dbodocente.php';
        $dbasistencia= new dboAsistenciaDocente();
        $evento=$dbasistencia->marcarAsistencia($cod);
        
    }else {
       $evento= "aea manito2";
    }
return "#".$evento."#";
}




echo marcar($key);
