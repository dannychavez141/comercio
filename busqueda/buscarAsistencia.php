<?php
include_once'../control/conexion.php'; 
$anio = $_POST['anio'];
$grado = $_POST['grado'];
$secc = $_POST['secc'];
$fecha = $_POST['fecha'];
$tipo = $_POST['tipo'];


    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

     $query = "SELECT * FROM asistencia a
join matricula m on a.idmat=m.idMatricula
join alumnos al on m.dnialu=al.dni
where m.idGrado='$grado' and m.idSeccion='$secc' and a.tipo='$tipo' and m.idAnioEscolar='$anio' and a.fecha='$fecha'
and concat(al.nomb,al.apepa,al.apema) like '%%' limit 20;";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM asistencia a
join matricula m on a.idmat=m.idMatricula
join alumnos al on m.dnialu=al.dni
where m.idGrado='$grado' and m.idSeccion='$secc' and a.tipo='$tipo' and m.idAnioEscolar='$anio' and a.fecha='$fecha'
and concat(al.nomb,al.apepa,al.apema)  like '%$q%' limit 20;";
    

    }

    $resultado = $conn->query($query);


    if ($resultado->num_rows>0) {
       

        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                        <tr>
                               <th colspan='4'>IMPRIMIR LISTA DE ASISTENCIA:</th>
                                
                                <th colspan='3'align='center'> <a href='pdfasistencia.php?anio=".$anio."&grado=".$grado."&secc=".$secc."&fecha=".$fecha."&tipo=".$tipo."' target='_blank' ><button type='button' align='center'>IMPRIMIR ASISTENCIAS</button></a></th>
                            </tr>
                            <tr>
                                <th>DNI</th>
                                <th>ALUMNO(A)</th>
                                 <th>TIPO</th>
                                <th>PUERTA</th>
                                <th>FECHA</th>
                                <th>HORA</th>
                                
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              if ($fila[5]==1) {
                  $ntipo='ENTRADA';
              }else{ $ntipo='SALIDA';}

            $salida.="<tr>
                        <td>".$fila[8]."</td>
                        <td>".$fila[19]." ".$fila[20]." ".$fila[21]."</td>
                       <td>". $ntipo."</td>
                        <td>".$fila[2]."</td>
                       <td>".$fila[3]."</td>
                        <td>".$fila[4]."</td></tr>";

        }
        $salida.="</tbody></table>



        ";
    }else{
        $salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>