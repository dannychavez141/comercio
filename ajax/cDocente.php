<?php
include '../control/cConexion.php';
include '../modelo/dbodocente.php';
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
        $token = $_GET['token'];
       $modelo=new dbodocente();
       $datos= $modelo->verdocentes($bus,$token); 
       echo $datos;
        break;
    case 'un':
        $cod=$_GET['cod'];
        $token = $_GET['token'];
        $modelo=new dbodocente();
        $datos=$modelo->verdocentesTargeta($cod,$token);
        print_r($datos);
        break;
    case 'rfid':
      $cod=$_GET['cod'];
        $token = $_GET['token'];
        $modelo=new dbodocente();
        $datos=$modelo->verdocentesTargeta($cod,$token);
        print_r($datos);
        break;
   
    case 'updaterfid':
       $cod=$_GET['cod'];
        $token = $_GET['token'];
        $targeta = $_GET['targeta'];
        $modelo=new dbodocente();
        $alumno = $modelo->cambiarTarjeta($cod,$targeta,$token);
        echo $alumno;
        break;
    default:
        echo "no se recibio las vareables";
        break;
}
