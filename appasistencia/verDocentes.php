<?php
include '../control/cConexion.php';
include '../modelo/dbodocente.php';

$docentes=new dbodocente();
if(isset($_GET['key'])){
    $key=$_GET['key'];
echo $docentes->verdocentes("",$key);

} else {
    echo "aea manito";
}