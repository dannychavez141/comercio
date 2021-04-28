<?php
include '../control/cConexion.php';
include '../plantillapdf/plantillalistadocente.php';
include '../modelo/dbodocente.php';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(5);
$pdf->SetX(50);
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Cell(70, 5, 'DOCENTES REGISTRADOS', 1, 1, 'C');
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(5);
$pdf->SetX(15);
$dbodocentes= new dbodocente();
$docentes=$dbodocentes->verlistadocentes();
$pdf->Cell(20, 6, utf8_decode('N°'), 1, 0, 'C', 1);
$pdf->Cell(80, 6, 'APELLIDOS Y NOMBRES', 1, 0, 'C', 1);
$pdf->Cell(80, 6, 'CARGO', 1, 1, 'C', 1);
foreach ($docentes as $docente) {
    $pdf->SetX(15);
    $pdf->Cell(20, 6, $docente[1], 1, 0, 'C');
    $pdf->Cell(80, 6, utf8_decode($docente[2]), 1, 0, 'C');
    $pdf->Cell(80, 6, utf8_decode($docente['descrCargo']." (".$docente['detalle'].")"), 1, 1, 'C');

}
for ($i = 0; $i < 8; $i++) {
   $pdf->SetX(15);
    $pdf->Cell(20, 6, "", 1, 0, 'C');
    $pdf->Cell(80, 6, utf8_decode(""), 1, 0, 'C');
    $pdf->Cell(80, 6, utf8_decode(''), 1, 1, 'C');  
}

$pdf->Ln(20);
$pdf->Cell(200, 6, '                    	______________________', 0, 0, 'C', 0);
$pdf->Ln(6);
$pdf->Cell(198, 6, '                        Firma Director', 0, 0, 'C', 0);
$modo = "I";
$nombre_archivo = "Lista_Docentes.pdf";
$pdf->Output($nombre_archivo, $modo);
