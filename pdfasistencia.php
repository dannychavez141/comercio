<?php

include 'plantillapdf/plantillaasistencia.php';
$usuario = $_COOKIE['usuario'];
$anio = $_GET['anio'];
$grado = $_GET['grado'];
$secc = $_GET['secc'];
$fecha = $_GET['fecha'];
$tipo = $_GET['tipo'];
$ngrado = '';
$nanio = '';
$nsecc = '';
if ($tipo == 1) {
    $ntipo = 'ENTRADA';
} else {
    $ntipo = 'SALIDA';
}

$pdf = new PDF();
$pdf->AliasNbPages();

$pdf->AddPage();
//busqueda de grado
require 'control/conexion.php';
$query = "SELECT * FROM grado g 
join tipogrado t on g.idTipo=t.idTipo where g.idGrado='$grado';";
$resultado = $mysqli->query($query);
while ($row = $resultado->fetch_array()) {
    $ngrado = utf8_decode($row[1]);
    $gtipo = utf8_decode($row[5]);
}
//busqueda de seccion
require 'control/conexion.php';
$query = "SELECT * FROM seccion where idSeccion='$secc';";
$resultado = $mysqli->query($query);
while ($row = $resultado->fetch_array()) {

    $nsecc = utf8_decode($row[1]);
}

//busqueda de NRO DE COMPETENCIAS
//busqueda de año escolar
require 'control/conexion.php';
$query = "SELECT * FROM anioescolar where idAnioEscolar='$anio';";
$resultado = $mysqli->query($query);
while ($row = $resultado->fetch_array()) {
    $nanio = utf8_decode($row[1]);
    $pdf->Ln(5);
    $pdf->SetX(50);
    $pdf->SetFont('Arial', 'BU', 11);
    $pdf->Cell(50, 5, 'DATOS DEL LISTA ', 1, 1, 'C');
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetX(50);
    $pdf->Cell(125, 6, 'PREMIUM COLLEGE', 1, 1, 'C', 1);

    $pdf->SetX(50);
    $pdf->Cell(50, 6, 'GRADO Y SECCION', 1, 0, 'C', 1);
    $pdf->Cell(75, 6, utf8_decode($ngrado . " " . $nsecc . " (" . $gtipo . ")"), 1, 1, 'C');
    $pdf->SetX(50);
    $pdf->Cell(50, 6, utf8_decode('AÑO ESCOLAR'), 1, 0, 'C', 1);
    $pdf->Cell(75, 6, utf8_decode($nanio), 1, 1, 'C');
    $pdf->SetX(50);
    $pdf->Cell(50, 6, 'FECHA ', 1, 0, 'C', 1);
    $pdf->Cell(75, 6, utf8_decode($fecha), 1, 1, 'C');
    $pdf->SetX(50);
    $pdf->Cell(50, 6, 'TIPO', 1, 0, 'C', 1);
    $pdf->Cell(75, 6, utf8_decode($ntipo), 1, 1, 'C');
}

require 'control/conexion.php';
$nlista = 1;
$query = "SELECT * FROM asistencia a
join matricula m on a.idmat=m.idMatricula
join alumnos al on m.dnialu=al.dni
where m.idGrado='$grado' and m.idSeccion='$secc' and a.tipo='$tipo' and m.idAnioEscolar='$anio' and a.fecha='$fecha' order by al.apepa ";
$resultado = $mysqli->query($query);
$pdf->Ln(5);
$pdf->SetX(50);
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Cell(70, 5, 'ALUMNOS REGISTRADOS', 1, 1, 'C');
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(5);
$pdf->SetX(25);
$pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'C', 1);

$pdf->Cell(80, 6, ' NOMBRES Y APELLIDOS ', 1, 0, 'C', 1);
$pdf->Cell(20, 6, ' HORA', 1, 0, 'C', 1);


$pdf->Cell(40, 6, 'OBSERVACIONES', 1, 1, 'C', 1);
while ($row = $resultado->fetch_array()) {
    $pdf->SetX(25);
    $pdf->Cell(10, 6, $nlista, 1, 0, 'C');
    $pdf->Cell(80, 6, utf8_decode($row[19] . " " . $row[20] . " " . $row[21]), 1, 0, 'C');
    $pdf->Cell(20, 6, $row[4], 1, 0, 'C');



    $pdf->Cell(40, 6, "", 1, 1, 'C');



    $pdf->SetTextColor(0, 0, 0);
    $nlista++;
}

$pdf->Ln(10);
$pdf->Cell(200, 6, '   __________________________________________________________', 0, 0, 'C', 0);
$pdf->Ln(6);
$pdf->Cell(198, 6, '               Firma Docente - ' . utf8_decode($usuario), 0, 0, 'C', 0);

$modo = "I";
$nombre_archivo = "Lista_" . $ntipo . "_" . $nanio . "_" . $ngrado . "_" . $nsecc . "_" . $fecha . ".pdf";
$pdf->Output($nombre_archivo, $modo);
?>