<?php

include '../control/cConexion.php';
include '../modelo/dboMatricula.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
        $idgrado = $_GET['idgrado'];
        $idsecc = $_GET['idsecc'];
        $idanio = $_GET['idanio'];
        $datos = Array();
        $modelo = new dboMatricula();
        $datos = $modelo->listamatricula($idgrado, $idsecc, $idanio);
        echo json_encode($datos);
        break;
    case 'uno':
        $cod = $_GET['cod'];
        $datos = Array();
        $modelo = new dboMatricula();
        $datos = $modelo->verunamatriculas($cod);
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