<?php

include 'plantillapdf/plantilladocente.php';
require 'control/conexion.php';
$id = $_GET['cod'];
$query = "call verunadocente($id)";
$resultado = $mysqli->query($query);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
while ($row = $resultado->fetch_array()) {
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Ln(2);
    $pdf->SetX(40);
    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(10, 5, 'DATOS DE DOCENTE ', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DNI DOCENTE:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[1]), 0, 1, 'C');
    $dni = $row[1];
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'APELLIDOS Y NOMBRES:', 0, 1, 'C');
    if ($row[9] == '0') {
        $pdf->Image('img/noimage.png', 140, 50, 45, 45);
    } else {
        $pdf->Image('img/docentes/' . $row[1] . '.' . $row[9], 140, 50, 45, 45, $row[9]);
        if (file_exists('img/docentes/' . $row[1] . '.' . $row[9])) {
            $pdf->Image('img/docentes/' . $row[1] . '.' . $row[9], 140, 50, 45, 45, $row[9]);
        } else {
            $pdf->Image('img/noimage.png', 140, 50, 45, 45);
        }
    }
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[3] . " " . $row[4] . " " . $row[2]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $dia = date("j");
    $mes = date("n");
    $ano = date("Y");

    $nacimiento = explode("-", $row[5]);
    $dianac = $nacimiento[2];
    $mesnac = $nacimiento[1];
    $anonac = $nacimiento[0];
//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual 
    if (($mesnac == $mes) && ($dianac > $dia)) {
        $ano = ($ano - 1);
    }
//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual 
    if ($mesnac > $mes) {
        $ano = ($ano - 1);
    }
//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad 
    $edad = ($ano - $anonac);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'FECHA DE NACIMIENTO / EDAD:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[5] . " / " . $edad . " AÑOS"), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, utf8_decode('PUESTO EN LA INSTITUCION:'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->MultiCell(120, 5, utf8_decode($row['descrCargo']." (".$row['detalle'].")"), 0, '');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'SEXO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row['descrSex']), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Ln(3);
    $pdf->SetX(45);
    -
            $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(10, 5, 'DATOS DE ADICIONALES', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DIRECCION:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[7]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'TELEFONO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[6]), 0, 1, 'C');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, utf8_decode('CONTRASEÑA:'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[8] . ' - No compartir su contraseña por favor'), 0, 1, 'C');

    $pdf->Ln(70);
    $pdf->Cell(196, 6, '_______________________                     	______________________', 0, 0, 'C', 0);
    $pdf->Ln(10);
    $pdf->Cell(194, 6, 'Firma Docente                                        Firma Director', 0, 0, 'C', 0);
}
$modo = "I";
$nombre_archivo = "Ficha_Docente_" . $dni . ".pdf";
$pdf->Output($nombre_archivo, $modo);
?>