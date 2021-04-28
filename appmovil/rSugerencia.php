<?php
include '../control/cConexion.php';
include '../modelo/mSugerencia.php';
if(isset($_POST['dni']) && isset($_POST['detalle']) && isset($_POST['idtipo']) && isset($_POST['fecha']) && isset($_POST['hora'])  ){
    $modelo= new mSugerencia();
    $clase= array();
    $clase['dni']=$_POST['dni'];
     $clase['detalle']=$_POST['detalle'];
      $clase['idtipo']=$_POST['idtipo'];
       $clase['fecha']=$_POST['fecha'];
        $clase['hora']=$_POST['hora'];
        $modelo->registro($clase);
}

