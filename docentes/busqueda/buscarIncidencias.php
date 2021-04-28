<?php
include_once'../control/conexion.php'; 
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }
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
    $salida = "";

    $query = "SELECT * FROM insidencias i
join matricula m on i.IdMat=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipoinsidencia ti on i.idtipoIns=ti.idtipoInsidencia 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion 
join tipogrado tg on g.idTipo=tg.idTipo
where i.tabla='docente' and i.id='$idusuario' and concat(a.nomb,a.apepa,a.apema,i.fecha) like '%%' limit 20;";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM insidencias i
join matricula m on i.IdMat=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipoinsidencia ti on i.idtipoIns=ti.idtipoInsidencia 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion 
join tipogrado tg on g.idTipo=tg.idTipo
where i.tabla='docente' and i.id='$idusuario' and concat(a.nomb,a.apepa,a.apema,i.fecha) like '%$q%'order by i.fecha desc limit 20;";
    }

    $resultado = $conn->query($query);


    if ($resultado->num_rows>0) {
       

        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>INCIDENCIA N°</th>
                                <th>ALUMNO</th>
                                <th>GRADO Y SECCION</th>
                                <th>TIPO</th>
                                <th>DESCRIPCION</th>
                                <th>FECHA</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              

            $salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[20]." ".$fila[21]." ".$fila[22]."</td>
                        <td>".$fila[38]." ".$fila[42]." (".$fila[35].")"."</td>
                        <td>".$fila[33]."</td>
                        <td>".$fila[3]."</td>
                       <td>".$fila[6]."</td>
                        <td><a href='modincidencia.php?cod=".$fila[0]."' ><center><img src='../img/edit.jpg' width='40' height='40'></center></a></td></tr>";

        }
        $salida.="</tbody></table>



        ";
    }else{
        $salida.="DOCENTE NO REGISTRO INCIDENCIAS :(";
    }


    echo $salida;

    $conn->close();



?>