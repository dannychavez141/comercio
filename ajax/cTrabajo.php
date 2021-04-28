<?php

include '../control/cConexion.php';
include '../modelo/metodos.php';
include '../modelo/mtrabajos.php';
include '../modelo/mVerificacion.php';

//var_dump ($_POST);
//var_dump ($_FILES);

$mUsuario = new mVerificacion();
if ($mUsuario->validarInicio()) {
    $usuario = $mUsuario->getUsuario();
    //echo $usuario['datos'];
    $control = null;
    if (isset($_POST['control']) && $control == null) {
        $control = $_POST['control'];
    } else if (isset($_GET['control']) && $control == null) {
        $control = $_GET['control'];
    }

    switch ($control) {
        case 'all':
            $curso = json_decode($_POST['curso'], true);
            $curso ['descripcion'] = $_POST['descripcion'];
            $modelo = new trabajos();
            echo $modelo->buscarTrabajo($curso);
            break;
        case 'uno':
            $id = $_GET['idtrab'];
            $modelo = new trabajos();
            echo $modelo->buscarUnTrabajo($id);
            break;
        case 'r':
            $curso = json_decode($_POST['curso'], true);
            $curso ['varchivo'] = $_POST['varchivo'];
            $curso ['descripcion'] = $_POST['descripcion'];
            //  echo
            $curso ['fecha'] = $_POST['fecha'];
            if ($curso ['varchivo'] != false && isset($_FILES['archivo'])) {
                $curso ['archivo'] = $_FILES['archivo'];
            }
            //print_r($curso);
            $modelo = new trabajos();
            echo $modelo->crearTrabajo($curso);

            break;
        case 'm':
            $trabajo = json_decode($_POST['trabajo'], true);
            $trabajo ['varchivo'] = $_POST['varchivo'];
            if ($trabajo ['varchivo'] != null && isset($_FILES['archivo'])) {
                $trabajo ['archivo'] = $_FILES['archivo'];
            }
            print_r($trabajo);
            $modelo = new trabajos();
            echo $modelo->EditarTrabajo($trabajo);
            break;
        case 'e':

            break;
        case 'part':
            $idtrab = $_GET['idtrab'];
            $modelo = new trabajos();
            echo $modelo->buscarPart($idtrab);
            break;
        case 'addpart':
            $idtrab = $_POST['idtrab'];
            $idmat = $_POST['idmat'];
            //echo $idtrab.$idmat;
            $modelo = new trabajos();
            echo $modelo->crearParticipante($idtrab, $idmat);
            break;
        case 'delPart':
            $idtrab = $_POST['idtrab'];
            $idmat = $_POST['idmat'];
            //echo $idtrab.$idmat;
            $modelo = new trabajos();
            echo $modelo->quitarParticipante($idtrab, $idmat);
            break;
        case 'Enlace':
            $idtrab = $_GET['idtrab'];
            $modelo = new trabajos();
            echo $modelo->buscarEnlace($idtrab);
            break;
        case 'addEnlace':
            $idtrab = $_POST['idtrab'];
            $enlace = Array();
            $enlace['descrEnlace'] = $_POST['descrEnlace'];
            $enlace['Enlace'] = $_POST['enlace'];
            //echo $idtrab.$idmat;
            $modelo = new trabajos();
            echo $modelo->crearEnlaces($idtrab, $enlace);
            break;
        case 'delEnlace':
            $idtrab = $_POST['idtrab'];
            $idenlace = $_POST['idenlace'];
            $modelo = new trabajos();
            echo $modelo->quitarEnlaces($idtrab, $idenlace);
            break;
        case 'ver':
            $trabajo = Array();
            $trabajo['busq'] = $_GET['busq'];
            $trabajo['idgrado'] = $_GET['idgrado'];
            $trabajo['idseccion'] = $_GET['idseccion'];
            $trabajo['idanio'] = $_GET['idanio'];
            $modelo = new trabajos();
            echo $modelo->verTrabajos($trabajo);
            break;
        default:
            echo "no se recibio las vareables";
            break;
    }
} else {
   // echo "Usuario no Reconocido";
     $control = null;
    if (isset($_POST['control']) && $control == null) {
        $control = $_POST['control'];
    } else if (isset($_GET['control']) && $control == null) {
        $control = $_GET['control'];
    }

    switch ($control) {
        case 'all':
            $trabajo = Array();
            $trabajo['busq'] = $_GET['busq'];
            $trabajo['idgrado'] = $_GET['idgrado'];
            $trabajo['idseccion'] = $_GET['idseccion'];
            $trabajo['idanio'] = $_GET['idanio'];
            $modelo = new trabajos();
            echo $modelo->verTrabajo($trabajo);
            break;
        case 'Enlace':
            $idtrab = $_GET['idtrab'];
            $modelo = new trabajos();
            echo $modelo->buscarEnlace($idtrab);
            break;
        case 'part':
            $idtrab = $_GET['idtrab'];
            $modelo = new trabajos();
            echo $modelo->buscarPart($idtrab);
            break;
        default:
            echo "no se recibio las vareables 2";
            break;
    }
}
