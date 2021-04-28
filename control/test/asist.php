<?php 
error_reporting(0);
// $serial = $_POST['SERIE'];
$id = $_GET['id'];

function registro($id,$serial){
//servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
 //$mysqli = new mysqli("localhost","root","","premiumc_premiumcollege");  
 $mysqli = new mysqli("179.61.12.105","premiumc_premium","Losloles54","premiumc_pcoll");
  if(mysqli_connect_errno()){
    echo 'Conexion Fallida : ', mysqli_connect_error();
    exit();
  }
date_default_timezone_set('America/Lima');
  $dia=date("Y-m-d");
  $hora=date("H");
  //echo $hora."<br>";
$alumno="3";
$dni="";
$estado=0;
$estado2=0;
$ntipo=1;
//echo "e1:".$estado."<br>";
//echo "e2:".$estado2."<br>";
//echo "tp:".$ntipo."<br>";
if ($id!="") {
 $temp="";

 $query = "SELECT * FROM alumnos where targeta='$id'";
 //echo $query."<br>";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        { 
                                              $alumno= $row[2] ;
                                             $temp= $row[2] ;
                                              $dni=$row[1] ;
                                                } 

                                            
if ($alumno!="") {
  $query = "SELECT * FROM matricula where dnialu='$dni' order by fecha desc  limit 1;";
  // echo $query."<br>";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {
                                              $idmat= $row[0] ;
                                                } 


$query = "SELECT * from asistencia where idmat='$idmat' and fecha='$dia' and tipo='$ntipo'";
 //echo $query."<br>";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {
                                              $estado=1;
                                              $alumno="1";
                                              $ntipo=2;
 }  
  //echo "tp:".$ntipo."<br>";
   if($hora>=11){
  
  if ($ntipo==2 ) {
 $query = "SELECT * from asistencia where idmat='$idmat' and fecha='$dia' and tipo='$ntipo'";
//echo $query."<br>";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {
                                              $estado2=1;
                                              $alumno="2";
                                              $ntipo=3;
 } 
        
}
}else{$estado2=3;
   $alumno="1";
}

//echo "e1:".$estado."<br>";
//echo "e2:".$estado2."<br>";
if ($estado==0 && $estado2==3 ) {
  $sql="call regasistencia('$idmat','$serial','$ntipo');";
    //  echo $sql."<br>";
         $rs=$mysqli->query($sql);
         $alumno=$temp;
        
}
if ($estado==0 && $estado2==0) {
  $sql="call regasistencia('$idmat','$serial','$ntipo');";
      //echo $sql."<br>";
         $rs=$mysqli->query($sql);
         $alumno=$temp;
        
}
if ($estado==1 && $estado2==0) {
  $sql="call regasistencia('$idmat','$serial','$ntipo');";
    //echo $sql."<br>";
        $rs=$mysqli->query($sql);
         $alumno=$temp;
}
      
}

}
$mysqli->close();
return $alumno;
}
echo "#".registro($id,"Puerta1")."#";
?>
