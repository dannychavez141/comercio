<?php
include '../control/cConexion.php';
include '../modelo/dbodocente.php';
if (isset($_POST['iddoc']) && isset($_POST['idcurso']) && isset($_POST['idgrado']) && isset($_POST['idsecc']) && isset($_POST['idanio'])) {
    $iddoc = $_POST['iddoc'];
    $idcurso = $_POST['idcurso'];
    $idgrado = $_POST['idgrado'];
    $idsecc = $_POST['idsecc'];
    $idanio = $_POST['idanio'];
    $mdocente= new dbodocente();
    echo $mdocente->quitar($iddoc, $idcurso, $idgrado, $idsecc, $idanio);
} else {
    echo "FALTA VARIABLES";
}

