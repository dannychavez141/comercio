<?php
 include_once'../control/conexion.php'; 
$anio = $_POST['anio'];
$dni = $_POST['dni'];
$mes = $_POST['mes'];
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT * FROM insidencias i
join matricula m on i.Idmat=m.idMatricula
join alumnos a on m.dnialu=a.dni
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
join tipoinsidencia ti on i.idtipoIns=ti.idtipoInsidencia
 where a.dni='$dni' and m.idAnioEscolar='$anio' and i.est='1' and month(i.fecha)='$mes' order by i.idinsidencias desc;";
if ($mes==0) {
 $query = "SELECT * FROM insidencias i
join matricula m on i.Idmat=m.idMatricula
join alumnos a on m.dnialu=a.dni
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
join tipoinsidencia ti on i.idtipoIns=ti.idtipoInsidencia
 where a.dni='$dni' and m.idAnioEscolar='$anio' and i.est='1'  order by  i.idinsidencias desc;";

} $resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>Incidencia N°</th>
                                <th>ALUMNO</th>
                                 <th>GRADO Y SECCION</th>
                                 <th>TIPO</th>
                                 <th>DESCRIPCION</th>
                                 <th>FECHA</th>
                                <th>DETALLES</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
if ($fila[5]==1) {
    $tipo="ENTRADA";
} else{$tipo="SALIDA";}
            $salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[20]." ".$fila[21]." ".$fila[22]."</td>
                       <td>".$fila[33]." ".$fila[37]." (".$fila[40].")</td>
                       <td>".$fila[43]."</td>
                       <td>".$fila[3]."</td>
                       <td>".$fila[6]."</td>
                       <td><a href='../pdfincidencia.php?cod=".$fila[0]."' target='_blank' ><center><img src='../img/print.jpg' width='50' height='50'></center></a></td>
                       </tr>";
        }
        $salida.="</tbody></table>
        ";
    }else{
        $salida.="NO HAY DATOS :(";
    }
    echo $salida;
    $conn->close();



?>