<?php
include_once'../control/conexion.php'; 
   
     $peri = $_POST['peri'];

if (isset($_COOKIE['usuario'])) {
    echo "";
}else{
    header("Location: ../login.php");
    exit();
}
$usuario=$_COOKIE['usuario'];
$idusuario=$_COOKIE['idUsuario'];
$idtipo=$_COOKIE['idtipo'];
$tipo=$_COOKIE['tipo'];
if ($idtipo!=4) {
    header("Location: ../login.php");
    exit();
}

    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }
 $id = $idusuario;
    $salida = "";

    $query = "SELECT * FROM asigdocente ad
join cursos c on ad.idCursos=c.idCursos
join docente d on ad.idDocente=d.idDocente
join grado g on ad.idGrado=g.idGrado
join seccion s on ad.idSeccion=s.idSeccion
join anioescolar ae on ad.idAnioEscolar=ae.idAnioEscolar
join estados e on ad.est=e.idestados
where d.idDocente='$idusuario' and concat(c.descr,g.descr,s.descr) like '%%' limit 20";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM asigdocente ad
join cursos c on ad.idCursos=c.idCursos
join docente d on ad.idDocente=d.idDocente
join grado g on ad.idGrado=g.idGrado
join seccion s on ad.idSeccion=s.idSeccion
join anioescolar ae on ad.idAnioEscolar=ae.idAnioEscolar
join estados e on ad.est=e.idestados
where d.idDocente='$idusuario' and concat(c.descr,g.descr,s.descr) like '%$q%' limit 20;";
    }
$periodo='';
if ($peri==1) {
    $periodo="PRIMER BIMESTRE";
   
}else if ($peri==2) {
    $periodo="SEGUNDO BIMESTRE";
    
}else if ($peri==3) {
    $periodo="TERCER BIMESTRE";
    
}else if ($peri==4) {
    $periodo="CUARTO BIMESTRE";
    
}else if ($peri==5) {
    $periodo="RECUPERACION";
    
}


    $resultado = $conn->query($query);


    if ($resultado->num_rows>0) {
       

        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                        <tr>
                               <th colspan='4'>PERIODO SELECCIONADO:</th>
                                
                                <th colspan='3'align='center'>".$periodo."</th>
                            </tr>
                            <tr>
                               <th>NOMBRE DEL CURSO</th>
                                <th>GRADO Y SECCION</th>
                                <th>AÑO ESCOLAR</th>
                                <th>TIPO</th>
                                <th>LISTA DE ALUMNOS</th>
                                <th>VER NOTAS</th>
                                <th>EDITAR NOTAS </th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
  //if ($fila[8]==2 && $fila[4]<5) {            
if ($fila[8]==2) {
   $salida.="<tr>
                        <td>".$fila[7]."</td>
                        <td>".$fila[27]." ".$fila[31]."</td>
                        <td>".$fila[34]."</td>
                        <td>".'SECUNDARIA'."</td>
                        <td><a href='../pdflistaalumnos.php?cur=".$fila[1]."&anio=".$fila[4]."&grad=".$fila[2]."&secc=".$fila[3]."&peri=".$peri."' target='_blank' ><center><img src='../../img/print.jpg' width='40' height='40'></center></a></td>
                        <td><a href='verNotasregSec.php?cur=".$fila[1]."&anio=".$fila[4]."&grad=".$fila[2]."&secc=".$fila[3]."&peri=".$peri."' ><center><img src='../../img/ver.jpg' width='40' height='40'></center></a></td>
                        <td><a href='regNotasSec.php?cur=".$fila[1]."&anio=".$fila[4]."&grad=".$fila[2]."&secc=".$fila[3]."&peri=".$peri."' ><center><img src='../../img/edit.jpg' width='40' height='40'></center></a></td></tr>"; 

}else{

            $salida.="<tr>
                        <td>".$fila[7]."</td>
                        <td>".$fila[27]." ".$fila[31]."</td>
                        <td>".$fila[34]."</td>
                        <td>".'PRIMARIA'."</td>
                        <td><a href='../pdflistaalumnos.php?cur=".$fila[1]."&anio=".$fila[4]."&grad=".$fila[2]."&secc=".$fila[3]."&peri=".$peri."'target='_blank' ><center><img src='../../img/print.jpg' width='40' height='40'></center></a></td>
                        <td><a href='verNotasregPrim.php?cur=".$fila[1]."&anio=".$fila[4]."&grad=".$fila[2]."&secc=".$fila[3]."&peri=".$peri."' ><center><img src='../../img/ver.jpg' width='40' height='40'></center></a></td>
                        <td><a href='regNotasPrim.php?cur=".$fila[1]."&anio=".$fila[4]."&grad=".$fila[2]."&secc=".$fila[3]."&peri=".$peri."' ><center><img src='../../img/edit.jpg' width='40' height='40'></center></a></td></tr>";
   }
        }
        $salida.="</tbody></table>



        ";
    }else{
        $salida.="DOCENTE NO TIENE CURSOS ASIGNADOS :(";
    }


    echo $salida;

    $conn->close();



?>
