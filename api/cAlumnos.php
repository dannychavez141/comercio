<?php

include '../control/cConexion.php';
include '../modelo/dboMatricula.php';
include '../modelo/dboAlumno.php';
include '../modelo/dboanioescolar.php';
$control = null;
$metodo = "";
if (isset($_POST['control']) && $control == null) {
    $control = $_POST['control'];
} else if (isset($_GET['control']) && $control == null) {
    $control = $_GET['control'];
}

switch ($control) {
    case 'all':
      $bus = $_GET['bus'];
        $dboalumno = new dboAlumno();
        $alumno = $dboalumno->alumnosAll($bus);
        echo $alumno;
        break;
    case 'un':
      $id = $_GET['id'];
        $dboalumno = new dboAlumno();
        $alumno = $dboalumno->Uno($id);
       echo $alumno;
        break;
    case 'rfid':
        $id = $_GET['id'];
        $dboalumno = new dboAlumno();
        $alumno = $dboalumno->buscarRfid($id);
        echo $alumno;
        break;
    case 'uno':
        $idalu = $_GET['cod'];
        $dboalumno = new dboAlumno();
        $dboanio = new dboanioescolar();
        $ultimoanio = $dboanio->ultimoanio();
        $matriculado = $dboalumno->EstadoMatricula($idalu, $ultimoanio[0]);
        echo $matriculado;
        break;
    case 'r':

        break;
    case 'm':

        break;
    case 'e':

        break;
    case 'lista':
        $modelo = new dboMatricula();
        $salon = array();
        $idgrado = $_GET['idgrado'];
        $idsecc = $_GET['idsecc'];
        $idanio = $_GET['idanio'];
        echo json_encode($modelo->listamatricula($idgrado, $idsecc, $idanio));
        break;
    case 'busq':
        $modelo = new dboMatricula();
        $salon = array();
        $busqueda = $_GET['busq'];
        $idgrado = $_GET['idgrado'];
        $idsecc = $_GET['idsecc'];
        $idanio = $_GET['idanio'];
        echo json_encode($modelo->buscarMatricula($busqueda, $idgrado, $idsecc, $idanio));
        break;
    case 'updaterfid':
      $id = $_GET['id'];
        $targeta = $_GET['targeta'];
        $dboalumno = new dboAlumno();
        $alumno = $dboalumno->cambiarRfid("acm1ptbt",$targeta,$id);
        echo $alumno;
        break;
    default:
        echo "no se recibio las vareables";
        break;
}
