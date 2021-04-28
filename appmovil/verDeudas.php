<?php
include '../control/cConexion.php';
include '../modelo/dboDeuda.php';
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
$modelo= new dboDeuda();
$modelo->verDeudas($matricula,$mes,$tipo);
}