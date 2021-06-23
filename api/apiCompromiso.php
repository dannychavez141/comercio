<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

include '../modelo/cConexion.php';
include '../modelo/metodos.php';
include '../modelo/dboCompromiso.php';
$control = null;
$metodo = "";
if (isset($_POST['ac']) && $control == null) {
    $control = $_POST['ac'];
} else if (isset($_GET['ac']) && $control == null) {
    $control = $_GET['ac'];
}
$compromiso = new dboCompromiso();
switch ($control) {
    case 'all':
        $modelo = array();
        $modelo['filtro'] = $_GET['filtro'];
        $modelo['variable'] = $_GET['variable'];
        $modelo['estado'] = $_GET['estado'];

        echo $compromiso->buscar($modelo);

        break;
    case 'uno':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo json_encode($compromiso->verUno($id));
        }
        break;
    case 'r':
        $modelo = array();
        $modelo['idAlumno'] = $_POST['idAlumno'];
        $modelo['idApoderado'] = $_POST['idApoderado'];
        $modelo['descrComp'] = $_POST['descrComp'];
        $modelo['creacion'] = $_POST['creacion'];
        $modelo['monto'] = $_POST['monto'];
        $modelo['est'] = $_POST['est'];
        $modelo['detalles'] = json_decode($_POST['detalles'], true);
        //print_r($modelo);
        echo $compromiso->crear($modelo);
        break;
    case 'm':
        $modelo = array();
        $modelo['idcompromisos'] = $_POST['idcompromisos'];
        $modelo['idAlumno'] = $_POST['idAlumno'];
        $modelo['idApoderado'] = $_POST['idApoderado'];
        $modelo['descrComp'] = $_POST['descrComp'];
        $modelo['creacion'] = $_POST['creacion'];
        $modelo['monto'] = $_POST['monto'];
        $modelo['est'] = $_POST['est'];
        echo $compromiso->modificar($modelo);
        break;
    //API DETALLES
    case 'rd':
        $modelo = array();
        $modelo['idcompromisos'] = $_POST['idcompromisos'];
        $modelo['descrDet'] = $_POST['descrDet'];
        $modelo['canti'] = $_POST['canti'];
        $modelo['monto'] = $_POST['monto'];
        echo $compromiso->crearDetalle($modelo);

        break;
    case 'verd':
        $id = $_GET['id'];
        echo $compromiso->verDetalle($id);
        break;
    case 'md':
        $id = $_POST['id'];
        $tip = $_POST['tip'];
        echo $compromiso->cambiarDet($id, $tip);
        break;
    case 'mc':
        $modelo['id'] = $_POST['id'];
        $modelo['descr'] = $_POST['descr'];
        $modelo['est'] = $_POST['est'];
        echo $compromiso->modificar($modelo);
        break;
    case 'ed':
        $modelo = array();
        $modelo['id'] = $_POST['id'];
        echo $compromiso->crear($modelo);
        break;

    default:
        echo "no se recibio las variables";
        break;
}
