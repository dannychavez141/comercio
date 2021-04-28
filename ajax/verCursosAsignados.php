<?php

include '../control/cConexion.php';
include '../modelo/dbodocente.php';
$modelo = new dbodocente();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $modelo->verCursosAsignadosajax($id);
} else if (isset($_GET['iddoc']) && isset($_GET['idcurso']) && isset($_GET['idgrado']) && isset($_GET['idseccion']) && isset($_GET['idanio'])) {
    $consulta = Array();
    $consulta['iddoc'] = $_GET['iddoc'];
    $consulta['idcurso'] = $_GET['idcurso'];
    $consulta['idgrado'] = $_GET['idgrado'];
    $consulta['idseccion'] = $_GET['idseccion'];
    $consulta['idanio'] = $_GET['idanio'];
    $modelo = new dbodocente();
     echo $modelo->verUnCursoAsignado($consulta);
} else {
    echo "SIN IDENTIDICADOR";
}