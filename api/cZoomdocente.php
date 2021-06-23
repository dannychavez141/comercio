<?php

include '../control/cConexion.php';
include '../modelo/mZoom.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
        $zoom = array();
        $zoom['idgrado'] = $_GET['idgrado'];
        $zoom['idsecc'] = $_GET['idsecc'];
        $zoom['idanio'] = $_GET['idanio'];
        $modelo = new mZoom();
        echo $modelo->verTododeSalon($zoom);
        break;
    case 'uno':
        $cod = $_GET['cod'];
        $modelo = new mZoom();
        $datos = $modelo->verUno($cod);
        echo $datos;
        break;
    case 'r':
        $zoom = array();
        $zoom['iddoc'] = $_POST['iddoc'];
        $zoom['url'] = $_POST['url'];
        $zoom['codigo'] = $_POST['codigo'];
        $zoom['pass'] = $_POST['pass'];
        $modelo = new mZoom();
        echo $modelo->crear($zoom);
        break;
    case 'm':
        $zoom = array();
        $zoom['iddoc'] = $_POST['iddoc'];
        $zoom['url'] = $_POST['url'];
        $zoom['codigo'] = $_POST['codigo'];
        $zoom['pass'] = $_POST['pass'];
        $modelo = new mZoom();
        echo $modelo->modificar($zoom);
        break;
    case 'e':

        break;

    default:
        echo "no se recibio las vareables";
        break;
}
