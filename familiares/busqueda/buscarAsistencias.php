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

    $query = "SELECT * FROM asistencia a
join matricula m on a.idmat=m.idMatricula
join alumnos al on m.dnialu=al.dni
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
 where al.dni='$dni' and m.idAnioEscolar='$anio' and month(a.fecha)='$mes' order by a.idasistencia desc;";
if ($mes==0) {
 $query = "SELECT * FROM asistencia a
join matricula m on a.idmat=m.idMatricula
join alumnos al on m.dnialu=al.dni
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
 where al.dni='$dni' and m.idAnioEscolar='$anio' order by a.idasistencia desc;";

}
   

    $resultado = $conn->query($query);


    if ($resultado->num_rows>0) {
       

        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>ASISTENCIA N°</th>
                                <th>ALUMNO</th>
                                 <th>TIPO</th>
                                 <th>FECHA</th>
                                <th>HORA</th>
                                <th>GRADO Y SECCION</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              
if ($fila[5]==1) {
    $tipo="ENTRADA";
} else{$tipo="SALIDA";}
            $salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[19]." ".$fila[20]." ".$fila[21]."</td>
                       <td>".$tipo." ( ".$fila[2]." )</td>
                       <td>".$fila[3]."</td>
                       <td>".$fila[4]."</td>
                       <td>".$fila[32]." ".$fila[36]." (".$fila[39].")</td>
                      
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