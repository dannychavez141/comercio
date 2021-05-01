<?php

include '../control/cConexion.php';
include '../modelo/dbodocente.php';
$pagina1 = "pdfasignaciones.php";
$pagina2 = "regAsigSecu.php";
$salida = "";
$q="";
if (isset($_POST['consulta'])) {
    $q =$_POST['consulta'];
   
}
$dbodocente=new dbodocente();
$resultado = $dbodocente->VerTodosDocentes($q);


if ($resultado->num_rows > 0) {


    $salida .= "<table class='table table-striped ' border='1'>
                        <thead class='bg-blue'>
                            <tr>
                                <th>DNI</th>
                                <th>APELLIDOS Y NOMBRES/(CARGO)</th>
                                <th>FOTOGRAFIA</th>
                                 <th>VER ASIGNACIONES</th>
                                 <th>ASIGNAR</th>
                            </tr>
                        </thead>
                        <tbody>";

    while ($fila = $resultado->fetch_array()) {
        if ($fila[9] == '0') {
            $salida .= "<tr>
                        <td>" . $fila[1] . "</td>
                        <td>" . $fila[3] . " " . $fila[4] . " " . $fila[2] . " (" . $fila['descrCargo'] . " - " . $fila['detalle'] . ")</td>
                       
                        <td>" . "<center><img src='img/noimage.png' width='100' height='100'></center>" . "</td>
                         
                        <td><a href='" . $pagina1 . "?cod=" . $fila[0] . "' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='" . $pagina2 . "?cod=" . $fila[0] . "' ><center><img src='img/edit.jpg' width='50' height='50'></center></a></td></tr>";
        } else {
            $salida .= "<tr>
                        <td>" . $fila[1] . "</td>
                        <td>" . $fila[3] . " " . $fila[4] . " " . $fila[2]. " (" . $fila['descrCargo'] . " - " . $fila['detalle'] . ")</td>
                        
                        <td>" . "<center><img src='img/docentes/" . $fila[1] . "." . $fila[9] . "' width='100' height='100'></center>" . "</td>
                             
                        <td><a href='" . $pagina1 . "?cod=" . $fila[0] . "' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='" . $pagina2 . "?cod=" . $fila[0] . "' ><center><img src='img/edit.jpg' width='50' height='50'></center></a></td></tr>";
        }
    }
    $salida .= "</tbody></table>



        ";
} else {
    $salida .= "NO HAY DATOS :(";
}


echo $salida;
?>