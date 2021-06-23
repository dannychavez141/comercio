<?php


include '../control/cConexion.php';
include '../modelo/mSecciones.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
        $mhorario = new mSecciones();
        echo $mhorario->vertodos();
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