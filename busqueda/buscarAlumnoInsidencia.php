<?php
include_once'../control/conexion.php'; 
$anio = $_POST['anio'];
$grado = $_POST['grado'];
$secc = $_POST['secc'];

    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "call vermatricula('', $anio, $grado, $secc);";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
       
        $query = "call vermatricula( '$q',$anio, $grado, $secc);";

    }

    $resultado = $conn->query($query);


    if ($resultado->num_rows>0) {
       

        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>MATRICULA NRO</th>
                                <th>ALUMNO</th>
                                 <th>NIVEL</th>
                                <th>GRADO Y SECCION</th>
                                <th>AÑO ESCOLAR</th>
                                <th>FECHA</th>
                                <th>VER HISTORIAL</th>
                                <th>AGREGAR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              

            $salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[2]."</td>
                       <td>".$fila[6]."</td>
                       <td>".$fila[10]." '".$fila[12]."'</td>
                       <td>".$fila[8]."</td>
                        <td>".$fila[13]."</td>
                       <td><a href='pdfincidencias.php?cod=".$fila[0]."' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='agreinsidencia.php?cod=".$fila[0]."' ><center><img src='img/mas.png' width='50' height='50'></center></a></td></tr>";

        }
        $salida.="</tbody></table>



        ";
    }else{
        $salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>