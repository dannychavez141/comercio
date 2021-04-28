<?php
error_reporting(0);
require 'conexion.php';
$serial = $_POST['SERIAL'];
$id = $_POST['ID'];
     $sql="UPDATE `temp`
SET
`codigo` = '$id'
WHERE `idtemp` = '1'";
       // echo $sql;
       $rs=$mysqli->query($sql);

echo "leido";
?>