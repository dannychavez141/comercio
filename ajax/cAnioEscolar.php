<?php

include '../control/cConexion.php';
include '../modelo/dboanioescolar.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
        $mhorario = new dboanioescolar();
        echo $mhorario->vertodos();
        break;
    case 'uno':
        $mhorario = new dboanioescolar();
        echo json_encode($mhorario->ultimoanio());
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

