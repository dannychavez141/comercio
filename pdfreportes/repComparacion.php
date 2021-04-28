<?php

include '../control/cConexion.php';
include '../modelo/dboanioescolar.php';
include '../modelo/dboMatricula.php';
include '../plantillapdf/plantillaComparacion.php';

$idanio = $_GET['anio'];
$idgrado = $_GET['grado'];
$idsecc = $_GET['secc'];
$nretirados = 0;
$npendiente = 0;
$nnuevos = 0;
$nantiguos = 0;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$dboanio = new dboanioescolar();
$grado = $dboanio->verunGrado($idgrado);
$seccion = $dboanio->verunSeccion($idsecc);
$anio = $dboanio->verunAnio($idanio);
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
$pdf->Cell(75, 6, utf8_decode($grado[1] . " " . $seccion[1] . " (" . $grado[5] . ")"), 1, 1, 'C');
$pdf->SetX(50);
$pdf->Cell(50, 6, utf8_decode('AÑO ESCOLAR'), 1, 0, 'C', 1);
$pdf->Cell(75, 6, utf8_decode($anio[1]), 1, 1, 'C');
$nlista = 1;
$dbomatricula = new dboMatricula();
$matriculasanterior = null;
$matriculasnuevas = null;
$matriculasnuevas = $dbomatricula->listamatricula($idgrado, $idsecc, $idanio);
if ($idgrado <= 1) {
    $gradant = 15;
} else {
    $gradant = $idgrado;
}
$gradant = $gradant - 1;
$gradoant = $dboanio->verunGrado($gradant);
$anioant = $dboanio->verunAnio($idanio - 1);
$matriculasanterior = $dbomatricula->listamatricula($gradant, $idsecc, ($idanio - 1));

$pdf->Ln(5);
$pdf->SetX(40);
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Cell(130, 5, utf8_decode('ALUMNOS MATRICULADOS ' . $gradoant[1] . " " . $seccion[1] . " (" . $gradoant[5] . "-" . $anioant[1] . ")"), 1, 1, 'C');
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(5);
$pdf->SetX(25);
$pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'C', 1);
$pdf->Cell(80, 6, 'APELLIDOS Y NOMBRES', 1, 0, 'C', 1);
$pdf->Cell(50, 6, 'OBSERVACIONES', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'ESTADOS', 1, 1, 'C', 1);
if (count($matriculasanterior) != 0) {
    foreach ($matriculasanterior as $matricula) {
        $pdf->SetX(25);
        $pdf->Cell(10, 6, $nlista, 1, 0, 'C');
        $pdf->Cell(80, 6, utf8_decode($matricula['alu']), 1, 0, 'C');
        $confirma = false;
        foreach ($matriculasnuevas as $nuevo) {

            if ($nuevo[1] == $matricula[1]) {
                $confirma = true;
            }
        }
        if ($confirma == true) {
            $pdf->SetTextColor(0, 0, 255);
            $pdf->Cell(50, 6, utf8_decode('YA SE MATRICULO'), 1, 0, 'C');
        } else {
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell(50, 6, utf8_decode('NO SE MATRICULA'), 1, 0, 'C');
        }$pdf->SetTextColor(0, 0, 0);
        if ($matricula['estalu'] == 'RETIRADO') {
            $nretirados++;
            $pdf->SetTextColor(255, 0, 0);
        } else if ($confirma == false && $matricula['estalu'] == 'ACTIVO') {
            $npendiente++;
        }
        $pdf->Cell(20, 6, $matricula['estalu'], 1, 1, 'C');
        $pdf->SetTextColor(0, 0, 0);
        $nlista++;
    }
} else {
    $pdf->SetX(25);
    $pdf->Cell(160, 6, utf8_decode('NO HAY MATRICULAS ANTERIORES ' . $gradoant[1] . " " . $seccion[1] . " (" . $gradoant[5] . "-" . $anioant[1] . ")"), 1, 1, 'C');
}
$pdf->AddPage();
$nlista = 1;
$pdf->Ln(5);
$pdf->SetX(40);
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Cell(130, 5, utf8_decode('ALUMNOS MATRICULADOS NUEVOS ' . $grado[1] . " " . $seccion[1] . " (" . $grado[5] . "-" . $anio[1] . ")"), 1, 1, 'C');
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(5);
$pdf->SetX(25);
$pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'C', 1);
$pdf->Cell(80, 6, 'APELLIDOS Y NOMBRES', 1, 0, 'C', 1);
$pdf->Cell(70, 6, 'OBSERVACIONES', 1, 1, 'C', 1);
if (count($matriculasnuevas) != 0) {
    foreach ($matriculasnuevas as $matricula) {
        $pdf->SetX(25);
        $pdf->Cell(10, 6, $nlista, 1, 0, 'C');
        $pdf->Cell(80, 6, utf8_decode($matricula['alu']), 1, 0, 'C');
        $nuevo = false;
        foreach ($matriculasanterior as $anterior) {

            if ($anterior[1] == $matricula[1]) {
                $nuevo = true;
            }
        }
        if ($nuevo == true) {
            $pdf->SetTextColor(255, 0, 255);
            $pdf->Cell(70, 6, utf8_decode('ALUMNO ANTIGUO'), 1, 1, 'C');
            $nantiguos++;
            $pdf->SetTextColor(0, 0, 0);
        } else {
            $pdf->SetTextColor(0, 0, 255);
            $pdf->Cell(70, 6, utf8_decode('ALUMNO NUEVO'), 1, 1, 'C');
            $nnuevos++;
            $pdf->SetTextColor(0, 0, 0);
        }
        $nlista++;
    }
} else {
    $pdf->SetX(25);
    $pdf->Cell(160, 6, utf8_decode('NO HAY MATRICULAS NUEVOS ' . $grado[1] . " " . $seccion[1] . " (" . $grado[5] . "-" . $anio[1] . ")"), 1, 1, 'C');
}
$pdf->Ln(5);
$pdf->SetX(25);
$pdf->Cell(165, 6, 'RESUMEN DE INFORME', 1, 1, 'C', 1);
$pdf->SetX(25);
$pdf->Cell(40, 6, utf8_decode('N° MATRICULADOS'), 1, 0, 'C', 1);
$pdf->Cell(25, 6, utf8_decode('N° NUEVOS'), 1, 0, 'C', 1);
$pdf->Cell(25, 6, utf8_decode('N° ANTIGUOS'), 1, 0, 'C', 1);
$pdf->Cell(25, 6, utf8_decode('N° RETIRADOS'), 1, 0, 'C', 1);
$pdf->Cell(25, 6, utf8_decode('N° PENDIENTES'), 1, 0, 'C', 1);
$pdf->Cell(25, 6, utf8_decode('N° ESPERADOS'), 1, 1, 'C', 1);
$pdf->SetX(25);
$pdf->Cell(40, 6, utf8_decode($nnuevos+$nantiguos), 1, 0, 'C');
$pdf->Cell(25, 6, utf8_decode($nnuevos), 1, 0, 'C');
$pdf->Cell(25, 6, utf8_decode($nantiguos), 1, 0, 'C');
$pdf->Cell(25, 6, utf8_decode($nretirados), 1, 0, 'C');
$pdf->Cell(25, 6, utf8_decode($npendiente), 1, 0, 'C');
$pdf->Cell(25, 6, utf8_decode($nnuevos+$nantiguos+$npendiente), 1, 1, 'C');

$pdf->Ln(20);
$pdf->Cell(200, 6, '                    	______________________', 0, 0, 'C', 0);
$pdf->Ln(6);
$pdf->Cell(198, 6, '                        Firma Director', 0, 0, 'C', 0);
$modo = "I";
$nombre_archivo = "Comparacion_Matriculados_" . $anio[1] . "_" . $grado[1] . "_" . $seccion[1] . "_" . $grado[5] . ".pdf";
$pdf->Output($nombre_archivo, $modo);
