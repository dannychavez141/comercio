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
       

        $salida.="<table class='form-control table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>DNI</th>
                                <th>DATOS DE ALUMNO</th>
                                <th>ELEGIR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              

            $salida.="<tr>
                        <td>".$fila[1]."</td>
                        <td>".$fila[2]."</td>
                        <td>
                        <button type='button' onclick='buscarele(".$fila[0].",".$fila[5].")'  data-dismiss='modal'><center><img src='img/elegir.png' width='50' height='50'></center></button>
                        </td></tr>";

        }
        $salida.="</tbody></table>



        ";
    }else{
        $salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>