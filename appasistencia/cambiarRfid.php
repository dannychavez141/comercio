<?php

include '../control/cConexion.php';
include '../modelo/dboAlumno.php';

$alumnos = new dboAlumno();
if (isset($_GET['key'])) {
    $key = $_GET['key'];
    $id = $_GET['id'];
    $rfid = $_GET['rfid'];
    $alumnos->cambiarRfid($key, $rfid, $id);
} else {
    echo "aea manito";
}

