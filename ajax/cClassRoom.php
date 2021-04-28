<?php

include '../control/cConexion.php';
include '../modelo/mClassRoom.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
        $modelo = new mClassRoom();
        $salon = array();
        $salon['idgrado'] = $_GET['idgrado'];
        $salon['idsecc'] = $_GET['idsecc'];
        $salon['idanio'] = $_GET['idanio'];
        echo $modelo->vertodos($salon);
        break;
    case 'uno':
        $salon = array();
        $salon['idgrado'] = $_GET['idgrado'];
        $salon['idsecc'] = $_GET['idsecc'];
        $salon['idanio'] = $_GET['idanio'];
        $salon['idcurso'] = $_GET['idcurso'];
       // $salon['codigo'] = $_GET['codigo'];
        $modelo = new mClassRoom();
        echo $modelo->verUno($salon);
        break;
    case 'r':
        $salon = array();
        $salon['idgrado'] = $_POST['idgrado'];
        $salon['idsecc'] = $_POST['idsecc'];
        $salon['idanio'] = $_POST['idanio'];
        $salon['idcurso'] = $_POST['idcurso'];
        $salon['codigo'] = $_POST['codigo'];
        $modelo = new mClassRoom();
        echo $modelo->crear($salon);
        break;
    case 'm':
        $salon = array();
        $salon['idgrado'] = $_POST['idgrado'];
        $salon['idsecc'] = $_POST['idsecc'];
        $salon['idanio'] = $_POST['idanio'];
        $salon['idcurso'] = $_POST['idcurso'];
        $salon['codigo'] = $_POST['codigo'];
        $modelo = new mClassRoom();
        echo $modelo->modificar($salon);
        break;
        break;
    case 'e':
        $salon = array();
        $salon['idgrado'] = $_POST['idgrado'];
        $salon['idsecc'] = $_POST['idsecc'];
        $salon['idanio'] = $_POST['idanio'];
        $salon['idcurso'] = $_POST['idcurso'];
        $salon['codigo'] = $_POST['codigo'];
        $modelo = new mClassRoom();
        echo $modelo->eliminar($salon);
        break;
        break;

    default:
        echo "no se recibio las vareables";
        break;
}