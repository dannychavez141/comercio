<?php
include_once'../control/conexion.php'; 
$anio = $_POST['anio'];
if (isset($_COOKIE['usuario']) && $_COOKIE['usuario']!="") {
    echo "";
}else{
    header("Location: ../principal/index.php");
    exit();
}
$usuario=$_COOKIE['usuario'];
$idusuario=$_COOKIE['idUsuario'];
$idtipo=$_COOKIE['idtipo'];
$tipo=$_COOKIE['tipo'];
if ($idtipo!=5) {
    header("Location: ../premium/");
    exit();
}
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }
    $salida = "";
    $query = "SELECT m.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where concat(a.dni,a.nomb,a.apepa,a.apema) like '%%' and ap.idApoderado='$idusuario' and m.idAnioEscolar='$anio' and m.est='1';";
    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
       
        $query = "SELECT m.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where concat(a.dni,a.nomb,a.apepa,a.apema) like '%$q%' and ap.idApoderado='$idusuario' and m.idAnioEscolar='$anio' and m.est='1';";
    }
    $resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-blue'>
                        <tr>
                               <th colspan='8'>IMPRIMIR LISTA DE ALUMNOS:</th>
                                
                                
                            </tr>
                            <tr>
                                <th>MATRICULA NRO</th>
                                <th>ALUMNO</th>
                                 <th>NIVEL</th>
                                <th>GRADO Y SECCION</th>
                                <th>AÑO ESCOLAR</th>
                                <th>IMPRIMIR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              

            $salida.="<tr align='center'>
                        <td>".$fila[0]."</td>
                        <td>".$fila[2]."</td>
                       <td>".$fila[6]."</td>
                       <td>".$fila[10]." '".$fila[12]."'</td>
                       <td>".$fila[8]."</td>
                        
                       <td><a href='../pdfboletamatricula.php?cod=".$fila[0]."' target='_blank' class='btn btn-warning'><center><img src='../img/print.jpg' width='70' height='70'></center></a></td></tr>";
        }
        $salida.="</tbody></table>
        ";
    }else{
        $salida.="NO HAY DATOS :(";
    }
   echo $salida;
    $conn->close();



