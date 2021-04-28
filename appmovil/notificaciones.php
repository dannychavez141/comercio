<?php
error_reporting(0);
 include_once'../control/conexion.php'; 
 $cod = $_GET['cod'];
$sql="SELECT * FROM historial where apo='$cod' and est=1 limit 1;";
        $rs=$mysqli->query($sql);         
   while ($row = $rs ->fetch_array()) {

                  $historial[]=array_map('utf8_encode',$row);

}  
$sql2="UPDATE `historial` SET `est` = '2' WHERE `apo` = '$cod' ";
$mysqli->query($sql2);

echo json_encode($historial);
        
        $rs -> close();
    
