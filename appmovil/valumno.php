<?php
error_reporting(0);
 include_once'../control/conexion.php'; 
 $cod = $_GET['cod'];
 $bus = $_GET['bus'];
$sql="SELECT  a.dni, concat(a.nomb,' ',a.apepa,' ',a.apema ) as alum, a.fnac ,s.descrSex,a.ext  FROM alumnos a 
join apoderado ap on a.dniapo=ap.dni 
join tipoapoderado t on ap.idtipoApoderado=t.idtipoApoderado
join sexo s on a.idsex=s.idsexo where a.dniapo=(SELECT ap.dni FROM apoderado ap where ap.dni='$cod') and 
concat(a.dni,a.nomb,a.apepa,a.apema,a.fnac,ap.dni,ap.apepa,ap.apema) like  '%$bus%' limit 20;";
        $rs=$mysqli->query($sql);         
   while ($row = $rs ->fetch_array()) {

                  $alumnos[]=array_map('utf8_encode',$row);

}  echo json_encode($alumnos);
        
        $rs -> close();
    
