<?php

include "../control/cConexion.php";
include '../modelo/dbousuarios.php';
if(isset($_GET['clave']))

{ $clave=$_GET['clave'];
$usuarios= new dbousuarios();
echo $usuarios->verusuarios($clave);

}