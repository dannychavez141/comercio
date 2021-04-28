<?php

include '../control/cConexion.php';
include '../modelo/mTipoApoderado.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
        $modelo=new mTipoApoderado();
        $datos=$modelo->vertodos();
        echo $datos;
        break;
    case 'uno':
      
        break;
    case 'r':
        
        break;
    case 'm':
       
        break;
    case 'e':
       
        break;

    default:
        echo "no se recibio las vareables";
        break;
}