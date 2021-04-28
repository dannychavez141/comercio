<?php

include '../control/cConexion.php';
include '../modelo/mCompetencias.php';
include '../modelo/mficha.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
        $idcurso = $_GET['idcurso'];
        $datos = Array();
        $modelo = new mCompetencias();
        $datos = $modelo->verCompetenciasCurso($idcurso);
        echo $datos;
        break;
    case 'uno':
        $idficha = $_GET['idficha'];
        $datos = Array();
        $modelo = new mficha();
        $datos = $modelo->verFichaComp($idficha);
        echo $datos;
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