<?php

include './plantillas/plantillamatricula.php';
require '../control/cConexion.php';
include '../modelo/dboAlumno.php';
include '../modelo/dboanioescolar.php';
$idalu = $_GET['cod'];
$dboalumno= new dboAlumno();
$dboanio= new dboanioescolar();
$ultimoanio=$dboanio->ultimoanio();
$id=$dboalumno->ultimaMatriculadeAlumno($idalu,$ultimoanio[0]);
$query = "call verunamatricula($id)";
$conexion=new cConexion();
$mysqli=$conexion->getBd();
$resultado = $mysqli->query($query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
while ($row = $resultado->fetch_array()) {
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->SetX(140);
    $pdf->Cell(50, 6, utf8_decode('N° de Matricula'), 1, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->SetX(140);
    $pdf->Cell(50, 6, utf8_decode($row[0]), 1, 0, 'C');
    $nro = $row[0];
    $pdf->Ln(10);
    $pdf->SetX(40);
    $pdf->SetFont('Arial', 'BU', 15);
    $pdf->Cell(10, 5, 'DATOS DEL ALUMNO ', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DNI ALUMNO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[1]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'APELLIDOS Y NOMBRES:', 0, 1, 'C');
    if ($row[3] == '0') {
        $pdf->Image('../img/noimage.png', 140, 70, 45);
    } else {
        if (file_exists('../img/alumnos/' . $row[1] . '.' . $row[3])) {
            $pdf->Image('../img/alumnos/' . $row[1] . '.' . $row[3], 140, 70, 45, 45, $row[3]);
        } else {
            $pdf->Image('../img/noimage.png', 140, 50, 45, 45);
        }
    }
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->MultiCell(80, 5, utf8_decode($row[2]), 'C');
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DNI APODERADO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[4]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'APODERADO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[5]), 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->SetX(45);
    $pdf->SetFont('Arial', 'BU', 15);
    $pdf->Cell(10, 5, 'DATOS DE LA MATRICULA', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'NIVEL EDUCATIVO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[7]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'GRADO Y SECCION:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[11] . " " . $row[13]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, utf8_decode('AÑO ESCOLAR:'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[9]), 0, 1, 'C');
    $anioe = utf8_decode($row[9]);
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'MATRICULADO POR:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[16]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'FECHA DE MATRICULA:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[14]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Ln(5);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'ESTADO DE MATRICULA:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 15);
    $pdf->Ln(2);
    $pdf->SetX(40);
    if ($row[17] == '1') {
        $pdf->Cell(100, 5, utf8_decode("MATRICULA CORRECTA "), 0, 1, 'C');
    } else {
        $pdf->Cell(100, 5, utf8_decode("MATRICULA PENDIENTE O ANULADA"), 0, 1, 'C');
    }
    $pdf->Ln(10);
    $pdf->Cell(200, 6, '_______________________                     	______________________', 0, 0, 'C', 0);
    $pdf->Ln(6);
    $pdf->Cell(198, 6, 'Firma Apoderado                                        Firma Director', 0, 0, 'C', 0);
}
$modo = "I";
$nombre_archivo = "Ficha_Matricula_" . $nro . "_" . $anioe . ".pdf";
$pdf->Output($nombre_archivo, $modo);



