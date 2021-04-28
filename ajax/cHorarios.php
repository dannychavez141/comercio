<?php

include '../control/cConexion.php';
include '../modelo/mhorario.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
        $mhorario = new mhorario();
        echo $mhorario->vertodos("");
        break;
    case 'uno':
        $mhorario = new mhorario();
        $horario = array();
        $horario['idgrado'] = $_GET['idgrado'];
        $horario['idsecc'] = $_GET['idsecc'];
        $horario['idanio'] = $_GET['idanio'];
        $horario['idniv'] = $_GET['idniv'];
        echo $mhorario->verUno($horario);
        break;
    case 'r':
        $mhorario = new mhorario();
        $horario = array();
        $horario['idgrado'] = $_POST['idgrado'];
        $horario['idsecc'] = $_POST['idsecc'];
        $horario['idanio'] = $_POST['idanio'];
        $horario['urlHorario'] = $_POST['urlHorario'];
        echo $mhorario->crear($horario);
        break;
    case 'm':
        $mhorario = new mhorario();
        $horario = array();
        $horario['idgrado'] = $_POST['idgrado'];
        $horario['idsecc'] = $_POST['idsecc'];
        $horario['idanio'] = $_POST['idanio'];
        $horario['urlHorario'] = $_POST['urlHorario'];
        echo $mhorario->modificar($horario);
        break;
    case 'e':
        $mhorario = new mhorario();
        $horario = array();
        $horario['idgrado'] = $_POST['idgrado'];
        $horario['idsecc'] = $_POST['idsecc'];
        $horario['idanio'] = $_POST['idanio'];
        echo $mhorario->eliminar($horario);
        break;

    default:
        echo "no se recibio las vareables";
        break;
}