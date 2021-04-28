<?php
include '../control/cConexion.php';
include '../modelo/dboAsistenciaDocente.php';
$anio = $_POST['anio'];
$doc = $_POST['doc'];
$fecha = $_POST['fecha'];
$tipo = $_POST['tipo'];
 $salida ="";
$dboasistencia=new dboAsistenciaDocente();
$resultado = $dboasistencia->verAsistenciaDocente($doc,$fecha,$tipo,$anio);
if ($resultado->num_rows > 0) {
    $salida .= "<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                        <tr>
                               <th colspan='3'>IMPRIMIR LISTA DE ASISTENCIA:</th>
                                
                                <th colspan='2'align='center'> <a href='reporteexcel/repasistenciadoncente.php?doc=".$doc."&anio=" . $anio . "&fecha=" . $fecha . "&tipo=" . $tipo . "' target='_blank' ><button type='button' align='center'>IMPRIMIR ASISTENCIAS</button></a></th>
                            </tr>
                            <tr>
                                <th>DNI</th>
                                <th>DOCENTE O PERSONAL</th>
                                 <th>TIPO</th>
                                <th>FECHA</th>
                                <th>HORA</th>
                            </tr>
                        </thead>
                        <tbody>";

    while ($fila = $resultado->fetch_array()) {
        $salida .= "<tr>
                        <td>" . $fila[8] . "</td>
                        <td>" . $fila[9] . " " . $fila[10] . " " . $fila[11] . "</td>
                       <td>" . $fila[23] . "</td>
                        <td>" . $fila[4] . "</td>
                       <td>" . $fila[5] . "</td></tr>";
    }
    $salida .= "</tbody></table>";
} else {
    $salida .= "NO HAY ASISTENCIAS REGISTRADAS DE ESTE DOCENTE";
}
echo $salida;





