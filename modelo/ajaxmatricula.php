<?php

include '../control/cConexion.php';
include '../modelo/dboMatricula.php';
if (isset($_POST['idmat'])) {
    $id = $_POST['idmat'];
    $dboMatricula = new dboMatricula();
    $matricula = $dboMatricula->verunamatriculas($id);
    $jsonmatricula = array(
        0 => $id,
        1 => $matricula[1],
        2 => $matricula[2],
        3 => $matricula[3],
        4 => $matricula[4],
        5 => $matricula[12]." ".$matricula[14]." (".$matricula[8]."-".$matricula[10]." )",
        6 => $matricula[15],
        7 => $matricula[5],
        8 => $matricula[6],
        9 => $matricula[17],
        10 => $matricula[19]
    );
    echo json_encode($jsonmatricula);
}