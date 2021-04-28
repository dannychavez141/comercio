<?php

include '../control/cConexion.php';
include '../modelo/dboanioescolar.php';
include '../modelo/dboAsistenciaDocente.php';
include '../modelo/dbodocente.php';

function marcar($key) {
    $evento = "";
    if ($key == "acm1ptbt") {
        if (isset($_GET['cod'])) {
            $cod = $_GET['cod'];

            $dbodocente = new dbodocente();
            $docente = json_decode($dbodocente->verdocentesTargeta($cod, $key),true);
           
            if (isset($docente[0])) {
                $docente = $docente[0];
                $dbasistencia = new dboAsistenciaDocente();
                //print_r($docente[0]);
                $evento = $dbasistencia->marcarAsistencia($docente['idDocente']);
                //$evento = "Token-Registrado";
               // echo "evento".$evento;
            } else {
                $evento = "Token no-Registrado";
            }
        } else {
            $evento = "No se recibio-Identificador";
        }
    } else {
        $evento = "Sin Permiso para - la solicitud";
    }

    return $evento;
}

$token = $_GET['token'];
echo marcar($token);
