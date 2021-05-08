<?php
  include_once'../control/conexion.php'; 

    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT * FROM seccion a 
join estados e on a.est=e.idestados where concat(a.descr,e.descrEst ) like '%%' limit 20;";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM seccion a 
join estados e on a.est=e.idestados where concat(a.descr,e.descrEst ) like '%$q%' limit 20;";
    }
    $resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-blue'>
                            <tr>
                                <th>CODIGO</th>
                                <th>NOMBRE DE SECCION</th>
                                <th>ESTADO</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {  
            $salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[1]."</td>
                       <td>".$fila[4]."</td>
                        <td><a href='modSeccion.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='40' height='40'></center></a></td></tr>";
        }
        $salida.="</tbody></table>
        ";
    }else{
        $salida.="NO HAY DATOS :(";
    }
    echo $salida;

    $conn->close();



?>