<?php


include '../control/cConexion.php';
include '../modelo/dboApoderado.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
      $bus = $_GET['bus'];
        $dboapoderado=new dboApoderado();
        $datos = $dboapoderado->verApoderados($bus);
        echo $datos;
        break;
    case 'un':
      
        break;
    
    default:
        echo "no se recibio las vareables";
        break;
}
