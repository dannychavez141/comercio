<?php

include '../control/conexion.php';
include '../modelo/cConexion.php';
include '../modelo/dbTiposeguro.php';
include '../modelo/mseguroalumno.php';
$conn = $mysqli;
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$salida = "";
$query = "SELECT * FROM alumnos a 
join apoderado ap on a.dniapo=ap.dni 
join tipoapoderado t on ap.idtipoApoderado=t.idtipoApoderado
join sexo s on a.idsex=s.idsexo where concat(a.dni,a.nomb,a.apepa,a.apema,a.fnac,ap.dni,ap.apepa,ap.apema) like '%%' limit 20;";

if (isset($_POST['consulta'])) {
    $q = $conn->real_escape_string($_POST['consulta']);
    $query = "SELECT * FROM alumnos a 
join apoderado ap on a.dniapo=ap.dni 
join tipoapoderado t on ap.idtipoApoderado=t.idtipoApoderado 
join sexo s on a.idsex=s.idsexo
where concat(a.dni,a.nomb,a.apepa,a.apema,a.fnac,ap.dni,ap.apepa,ap.apema) like '%$q%' limit 20;";
}
$resultado = $conn->query($query);
if ($resultado->num_rows > 0) {
    $salida .= "<table class='table table-striped ' border='1'>
                        <thead class='bg-blue'>
                            <tr>
                                <th>DNI</th>
                                <th>DATOS ALUMNO</th>
                                <th>SEGURO/EMAIL/SEXO</th>
                                <th>DATOS APODERADO</th>
                                <th>FOTOGRAFIA</th>
                                <th>DETALLE</th>
                                 <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";
    while ($fila = $resultado->fetch_array()) {
         $bdtipo = new dbTiposeguro();
    $tipoactual = $bdtipo->buscarAlumnoSeguro($fila[1]);
        if ($fila[9] == '0') {
            $salida .= "<tr>
                        <td>" . $fila[1] . "</td>
                        <td>" . $fila[3] . " " . $fila[4] . " " . $fila[2] . "</td>
                       <td>" . $tipoactual->getTipo()."-".$tipoactual->getAdicional(). "/" . $fila[28] . "</td>
                        <td>" . $fila[17] . " " . $fila[18] . " " . $fila[16] . " (" . $fila[25] . ")</td>
                        <td>" . "<center><img src='img/noimage.png' width='100' height='100'></center>" . "</td>
                        <td><a href='pdfalumno.php?cod=" . $fila[0] . "' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='modAlumno.php?cod=" . $fila[0] . "' ><center><img src='img/edit.jpg' width='50' height='50'></center></a></td></tr>";
        } else {
            $salida .= "<tr>
                        <td>" . $fila[1] . "</td>
                        <td>" . $fila[3] . " " . $fila[4] . " " . $fila[2] . "</td>
                        <td>" . $fila[5] . "/" . $fila[27] . "</td>
                        <td>" . $fila[17] . " " . $fila[18] . " " . $fila[16] . " (" . $fila[24] . ")</td>
                        <td>" . "<center><img src='img/alumnos/" . $fila[1] . "." . $fila[9] . "' width='100' height='100'></center>" . "</td>
                        <td><a href='pdfalumno.php?cod=" . $fila[0] . "' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='modAlumno.php?cod=" . $fila[0] . "' ><center><img src='img/edit.jpg' width='50' height='50'></center></a></td></tr>";
        }
    }
    $salida .= "</tbody></table>
      ";
} else {
    $salida .= "NO HAY DATOS :(";
}
echo $salida;
$conn->close();
?>