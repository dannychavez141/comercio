<?php

include '../control/cConexion.php';
include '../modelo/mSolicitudes.php';
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

        break;
     case 'v':
     $modelo = new mSolicitudes();
        $dni=$_GET['dni'];
       echo $modelo->verUnoAlumno($dni);
        break;
    case 'r':
        $modelo = new mSolicitudes();
        $solicitud['dniAlum'] = $_POST['dniAlum'];
        $solicitud['nombAlum'] = $_POST['nombAlum'];
        $solicitud['apepaAlum'] = $_POST['apepaAlum'];
        $solicitud['apemaAlum'] = $_POST['apemaAlum'];
        $solicitud['dniApo'] = $_POST['dniApo'];
        $solicitud['nombApo'] = $_POST['nombApo'];
        $solicitud['apepaApo'] = $_POST['apepaApo'];
        $solicitud['apemaApo'] = $_POST['apemaApo'];
        $solicitud['idgrado'] = $_POST['idgrado'];
        $solicitud['idseccion'] = $_POST['idseccion'];
        $solicitud['idtipoApoderado'] = $_POST['parentesco'];
        $solicitud['motivo'] = $_POST['motivo'];
        $solicitud['celular'] = $_POST['celular'];
       // print_r($solicitud);
        $modelo->registro($solicitud);
        
        break;
    case 'm':

        break;
    case 'e':

        break;

    default:
        echo "no se recibio las vareables";
        break;
}