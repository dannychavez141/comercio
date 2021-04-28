<?php
include_once'../control/conexion.php'; 
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }
    $salida = "";
    $query = "SELECT * FROM cursos c join estados e on c.est=e.idestados 
join tipogrado t on c.idtipogrado=t.idTipo where concat(c.descr,t.descr) like '%%' limit 20;";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM cursos c join estados e on c.est=e.idestados 
join tipogrado t on c.idtipogrado=t.idTipo where concat(c.descr,t.descr) like '%$q%' limit 20;";
    }
    $resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>CODIGO</th>
                                <th>NOMBRE DEL CURSO</th>
                                <th>NIVEL</th>
                                <th>ESTADO</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
            $salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[1]."</td>
                        <td>".$fila[7]."</td>
                       <td>".$fila[5]."</td>
                        <td><a href='modCurso.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='40' height='40'></center></a></td></tr>";
        }
        $salida.="</tbody></table>";
    }else{
        $salida.="NO HAY DATOS :(";
    }
    echo $salida;
    $conn->close();



?>