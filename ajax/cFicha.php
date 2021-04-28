<?php

include '../control/cConexion.php';
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
        $datos = array();
        $datos['iddoc'] = $_GET['iddoc'];
        $datos['idcur'] = $_GET['idcur'];
        $datos['fec'] = $_GET['fec'];
        $datos['chek'] = $_GET['chek'];
        $modelo = new mficha();
        echo $modelo->verFicha($datos);
        break;
    case 'uno':
        $id = $_GET['id'];
        $modelo = new mficha();
        $datos = $modelo->verunaFicha($id);
        echo json_encode($datos);
        break;
    case 'r':
        $curso = json_decode($_POST['curso'], true);
        $competencias = json_decode($_POST['competencias'], true);
        $alumnos = json_decode($_POST['alumnos'], true);
        $sesion = $_POST['sesion'];
        $semana = $_POST['semana'];
        $fecha = $_POST['fecha'];
        $modelo = new mficha();
        $modelo->nuevo($curso, $sesion, $semana, $fecha);
        $modelo->agregarCompetencia($competencias);
        $modelo->agregarMatriculado($alumnos);

        //print_r($curso);
        //  print_r($competencias);
        // print_r($alumnos);
        break;
    case 'm':
 $ficha = json_decode($_POST['ficha'], true);
        $alumnos = json_decode($_POST['alumnos'], true);
        $modelo = new mficha();
       // print_r($ficha); 
       // print_r($alumnos);
       
       $modelo->modificar($ficha,$alumnos);
       
        break;
    case 'e':

        break;
     case 'b':
$datos = array();
        $idMat = $_GET['idmat'];
        $idFicha = $_GET['idficha'];
        $modelo = new mficha();
        echo $modelo->buscarAlumno($idMat, $idFicha);
        break;

    default:
        echo "no se recibio las vareables";
        break;
}
