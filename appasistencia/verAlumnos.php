
<?php
include '../control/cConexion.php';
include '../modelo/dboAlumno.php';

$alumnos=new dboAlumno();
if(isset($_GET['key'])){
    $key=$_GET['key'];
echo $alumnos->verTodosAlumnos($key);

} else {
    echo "aea manito";
}
