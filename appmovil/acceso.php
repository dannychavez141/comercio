<?php
 include_once'../control/conexion.php'; 
 if (isset($_GET['apikey'])) {
    $cod = $_GET['apikey'];
    if ($cod=="apikeyxd") {
        
    
$sql="SELECT dni,nomb,apepa,apema,pass FROM apoderado where est=1;";
        $rs=$mysqli->query($sql);         
   while ($row = $rs ->fetch_array()) {

                  $apoderados[]=array_map('utf8_encode',$row);

}  echo json_encode($apoderados);
        
        $rs -> close();
    }else{ 
       // echo "habil te crees mongol";
        }
 }else{ 
     //   echo "habil te crees mongol"; 
        
 }

