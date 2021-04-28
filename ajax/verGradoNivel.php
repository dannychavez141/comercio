<?php

include '../control/cConexion.php';
include '../modelo/mCursos.php';
$modelo = new mCursos();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $modelo->verGradosNivel($id);
} else {
    echo "SIN IDENTIDICADOR";
}