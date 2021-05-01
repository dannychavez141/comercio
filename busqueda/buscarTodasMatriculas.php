<?php

include '../control/cConexion.php';
include '../modelo/dboMatricula.php';
include '../modelo/dboanioescolar.php';
$busqueda = $_POST['consulta'];
$dbomatricula = new dboMatricula();
$salida = "";
$dboanio=new dboanioescolar();
$anio=$dboanio->ultimoanio();
$matriculas = $dbomatricula->vertodasmatriculas($busqueda);
if (count($matriculas) > 0) {
    $salida .= "<table class='table table-striped ' border='1'>
        <thead class='bg-blue'>
                            <tr>
                               <th colspan='5'>IMPRIMIR LISTA DE ALUMNOS MATRICULADOS: <a href='./pdfreportes/reporteTotalMat.php' target='_blank' >
                                    <button type='button' align='center'>REPORTE MATRICULADOS PDF</button>
                                    </a>
                               </th>
                                
                                <th colspan='3'align='center'> 
                                <a href='./reporteexcel/repapoderados.php?anio=" . $anio[0] . "' target='_blank' >
                                    <button type='button' align='center'>REPORTE MATRICULADOS EXCEL</button>
                                    </a></th>
                            </tr>
                            <tr>
                                <th>MATRICULA NRO</th>
                                <th>ALUMNO</th>
                                 <th>NIVEL</th>
                                <th>GRADO Y SECCION</th>
                                <th>AÑO ESCOLAR</th>
                                <th>FECHA</th>
                                <th>IMPRIMIR</th>
                            </tr>
                        </thead>
                        <tbody>";

    foreach ($matriculas as $fila) {

        $salida .= "<tr>
                        <td>" . $fila[0] . "</td>
                        <td>" . $fila[2] . "</td>
                       <td>" . $fila[6] . "</td>
                       <td>" . $fila[10] . " '" . $fila[12] . "'</td>
                       <td>" . $fila[8] . "</td>
                        <td>" . $fila[13] . "</td>
                       <td><a href='pdfboletamatricula.php?cod=" . $fila[0] . "' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        </tr>";
    }
    $salida .= "</tbody></table>
        ";
} else {
    $salida .= "NO HAY DATOS :(";
}
echo $salida;

