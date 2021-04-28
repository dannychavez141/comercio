<?php

include './plantillapdf/plantillaCompromiso.php';
include './control/numeroletras.php';
include_once './modelo/metodos.php';
include_once './control/cConexion.php';
include_once './modelo/dboCompromiso.php';

$id = $_GET['id'];
$dbo = new dboCompromiso();
$comp = $dbo->verUno($id);
//print_r($comp);
//echo $id;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$datos = $comp[0];

$bol = str_pad($datos[0], 5, "0", STR_PAD_LEFT);
$pdf->Ln(2);
$pdf->Ln(5);
$pdf->SetX(20);
$pdf->SetFillColor(252, 213, 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(20);
$pdf->Cell(40, 6, 'R.U.C. 20601760461', 1, 0, 'C');
$pdf->SetX(120);
$pdf->Cell(40, 6, utf8_decode("COMPROMISO DE PAGO N°"), 1, 1, 'C', 1);
$pdf->SetX(20);
$pdf->Cell(40, 6, utf8_decode("COMPROMISO DE PAGO"), 1, 0, 'C', 1);
$pdf->SetX(120);
$pdf->Cell(40, 6, utf8_decode("CP-001-" . $bol), 1, 1, 'C');
$pdf->Ln(5);
$pdf->SetX(30);
$pdf->Cell(40, 6, utf8_decode('DNI/RUC:'), 1, 0, 'C', 1);
$pdf->Cell(80, 6, utf8_decode($datos[15]), 1, 1, 'C');
$pdf->SetX(30);
$pdf->Cell(40, 6, utf8_decode('Señor(es):'), 1, 0, 'C', 1);
$pdf->Cell(80, 6, utf8_decode($datos[16] . " " . $datos[17] . " " . $datos[18]), 1, 1, 'C');
$pdf->SetX(30);
$pdf->Cell(40, 6, utf8_decode('Direccíon:'), 1, 0, 'C', 1);
$pdf->Cell(80, 6, utf8_decode($datos[19]), 1, 1, 'C');
$pdf->SetX(30);
$pdf->Cell(120, 6, utf8_decode('Concepto:'), 1, 1, 'C', 1);
$pdf->SetX(30);
$pdf->MultiCell(120, 6, utf8_decode($datos["descrComp"]), 1, 'C');
$pdf->SetX(30);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Ln(5);
$pdf->SetFillColor(252, 213, 0);
$pdf->SetX(15);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 6, 'CANTIDAD', 1, 0, 'C', 1);
$pdf->Cell(60, 6, 'DETALLE', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'F.VENCIM', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'PRECIO UNI. S/', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'SUB TOTAL S/', 1, 1, 'C', 1);
$cont = 1;
$total = 0;
foreach ($comp as $det) {
    $pdf->SetX(40);
    $pdf->SetFont('Arial', '', 8);

    $posy0 = $pdf->GetY();

    $posx = $pdf->GetX();
    $posy = $pdf->GetY();
    $pdf->MultiCell(60, 6, utf8_decode($det["descrComp"]), 1, 'C');
    $posy2 = $pdf->GetY();
    $pdf->SetY($posy);
    $pdf->SetX($posx + 60);
    $pdf->Cell(30, ($posy2 - $posy), $det["3"], 1, 0, 'C');
    $pdf->Cell(25, ($posy2 - $posy), "S/." . number_format($det["5"], 2), 1, 0, 'R');
    $pdf->Cell(25, ($posy2 - $posy), "S/." . number_format($det["6"] * $det["5"], 2), 1, 1, 'R');
    $pdf->SetY($posy0);
    $pdf->SetX(15);
    $pdf->Cell(25, ($posy2 - $posy), utf8_decode($det["canti"]), 1, 0, 'C');
    $cont++;

    $pdf->SetFont('Arial', 'B', 8);
    $total += $det["6"] * $det["5"];
    $pdf->SetY($posy2);
}
$nombre_archivo = "Compromiso_Nro_CP-001_" . $bol . ".pdf";

$pdf->SetX(15);
$pdf->Cell(140, 6, 'TOTAL:', 1, 0, 'C', 1);
$pdf->Cell(25, 6, "S/." . number_format($total, 2), 1, 1, 'R');
$pdf->SetX(80);

$pdf->SetX(15);
$pdf->Cell(165, 6, "" . numletras($total, 1), 1, 1, 'R');
$qrurl = 'qrimg/comp/' . $id . '.png';
if (file_exists($qrurl)) {
    $pdf->Image($qrurl, 20, 135, 40);
}

$modo = "I";
$pdf->Output($nombre_archivo, $modo);
