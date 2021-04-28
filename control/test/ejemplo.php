<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>página de destino</title>
</head>
<body>
<h1>
<?php error_reporting(0);
 //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	//$mysqli = new mysqli("localhost","root","","premiumc_premiumcollege");  
  $mysqli = new mysqli("179.61.12.105","premiumc_premium","Losloles54","premiumc_premiumcollege");
	if(mysqli_connect_errno()){
    echo 'Conexion Fallida : ', mysqli_connect_error();
    exit();
  }
//$serial = $_GET['serie'];
$id = $_GET['id'];
$alumno="";
$estado=false;
 $query = "SELECT * FROM alumnos where targeta='$id'";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {
                                              $alumno= $row[2] ;
                                              $idalu=$row[0] ;
                                                } 

if ($alumno!="") {
$query = "SELECT * from asistencia where idAlumno='$idalu' and fecha='$dia'";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {
                                              $estado=true;
                                              $alumno="1";
                                                } 	

if ($estado==false) {
	$sql="INSERT INTO `asistencia` (`idAlumno`, `puerta`, `fecha`, `hora`, `est`) VALUES ('$idalu', '$serial', now(), now(), '1');";
      // echo $sql;
         $rs=$mysqli->query($sql);
        
}

}

   
        
         $mysqli->close();

echo '#'.$alumno.'#';

?>

?>
</body>
</html>