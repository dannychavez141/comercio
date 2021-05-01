<?php
include_once'../control/conexion.php'; 
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }
    $salida = "";
    $query = "SELECT * FROM apoderado a  join tipoapoderado t on a.idtipoApoderado=t.idtipoApoderado
where concat(a.nomb,a.apepa,a.apema,a.dni) like '%%' limit 20;";
    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM apoderado a  join tipoapoderado t on a.idtipoApoderado=t.idtipoApoderado
where concat(a.nomb,a.apepa,a.apema,a.dni) like '%$q%' limit 20;";
    }
    $resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
               $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-blue'>
                            <tr>
                                <th>DNI</th>
                                <th>APELLIDOS Y NOMBRES</th>
                                <th>DIRECCION</th>
                                <th>TELEFONO</th>
                                <th>TIPO</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";
        while ($fila = $resultado->fetch_array()) {
                         $salida.="<tr>
                        <td>".$fila[1]."</td>
                        <td>".$fila[3]." ".$fila[4]." ".$fila[2]."</td>
                       <td>".$fila[5]."</td>
                       <td>".$fila[6]."</td>
                        <td>".$fila[11]."</td>
                        <td><a href='modApoderado.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='40' height='40'></center></a></td></tr>";
        }
        $salida.="</tbody></table>";
    }else{
        $salida.="NO HAY DATOS :(";
    }
    echo $salida;
    $conn->close();
?>