<?php
include '../control/cConexion.php';
include '../modelo/dbousuarios.php';
$usuarios=new dbousuarios();
if(isset($_GET['key'])){
    $key=$_GET['key'];
echo $usuarios->verusuarios($key);

}