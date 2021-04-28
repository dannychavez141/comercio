<?php

include '../plantillapdf/platillatotalmatriculados.php';
$dbomatricula = new dboMatricula();
$dbogrado = new dbogrado();
$dboseccion = new dboseccion();
$grados = $dbogrado->verGrados();
$secciones = $dboseccion->verSecciones();
$pdf = new PDF();
$pdf->AliasNbPages();
foreach ($grados as $grado) {
    foreach ($secciones as $seccion) {
        $pdf->AddPage();
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

$matriculados=$dbomatricula->listamatricula($grado[0], $seccion[0], $anio[0]);
        
        $nlista = 1;
        $pdf->Ln(5);
        $pdf->SetX(50);
        $pdf->SetFont('Arial', 'BU', 11);
        $pdf->Cell(70, 5, 'ALUMNOS MATRICULADOS', 1, 1, 'C');
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln(5);
        $pdf->SetX(25);
        $pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'C', 1);

        $pdf->Cell(80, 6, 'APELLIDOS Y NOMBRES', 1, 0, 'C', 1);

        $pdf->Cell(70, 6, 'OBSERVACIONES', 1, 1, 'C', 1);
        foreach ($matriculados as $matricula) {
            $pdf->SetX(25);
            $pdf->Cell(10, 6, $nlista, 1, 0, 'C');
            $pdf->Cell(80, 6, utf8_decode($matricula[2]), 1, 0, 'C');
            $pdf->Cell(70, 6, utf8_decode(''), 1, 1, 'C');

            $nlista++;
        }
    }
}
$pdf->Ln(20);
$pdf->Cell(200, 6, '                    	______________________', 0, 0, 'C', 0);
$pdf->Ln(6);
$pdf->Cell(198, 6, '                        Firma Director', 0, 0, 'C', 0);
$modo = "I";
$nombre_archivo = "Lista_Matriculados_" . $anio[1] . ".pdf";
$pdf->Output($nombre_archivo, $modo);

