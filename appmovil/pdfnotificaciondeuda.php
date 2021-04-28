<?php

include './plantillas/plantillanotas.php';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 30);
$pdf->Ln(50);
$pdf->SetX(30);
$pdf->MultiCell(150, 15, utf8_decode('Hola, la entrega de libretas será presencial por estos momentos, por favor acercarse a recogerlo a la institución en el horario planificado.'), 0, 'C');
$pdf->SetFont('Arial', '', 15);
$pdf->SetX(30);
$pdf->MultiCell(150, 15, utf8_decode('Disculpe las molestias. Estamos trabajando para usted.'), 0,'C');
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetX(30);
$pdf->MultiCell(150, 15, utf8_decode('Si usted desea informacion envíenos un correo: dannychavez@premiumcollege.edu.pe o llamar al 991268866'), 0,'C');
$modo = "I";
$nombre_archivo = "Ficha_Matricula.pdf";
$pdf->Output($nombre_archivo, $modo);



