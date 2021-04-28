<?php
include '../control/cConexion.php';
include '../modelo/dbodocente.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
       
        break;
    case 'uno':
        $cod=$_GET['cod'];
        $modelo=new dbodocente();
        $datos=$modelo->verundocente($cod);
        echo json_encode($datos);
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
