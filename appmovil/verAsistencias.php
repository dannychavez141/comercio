<?php
include '../control/cConexion.php';
include '../modelo/mAsistencia.php';
include '../modelo/dboAlumno.php';
include '../modelo/dboanioescolar.php';
if(isset($_GET['dni']) && isset($_GET['mes']) && isset($_GET['tipo'])){
$dnialumno=$_GET['dni'];
$mes=$_GET['mes'];
$tipo=$_GET['tipo'];
$malumno=new dboAlumno();
$manioescolar=new dboanioescolar();
$anio=$manioescolar->ultimoanio();
$matricula=$malumno->ultimaMatriculadeAlumno($dnialumno, $anio[0]);
$masistencia= new mAsistencia();
$masistencia->verAsistencias($matricula,$mes,$tipo);
}
