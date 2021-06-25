<?php

include 'plantillapdf/plantillaasignaciones.php';
require 'control/conexion.php';
$id = $_GET['cod'];
$query = "call verunadocente($id)";
$resultado = $mysqli->query($query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



while ($row = $resultado->fetch_array()) {
    $iddoc = $row[0];
    $dni = $row[1];
    $nom = $row[3] . ' ' . $row[4] . ' ' . $row[2];
    $grad = $row['descrCargo'];
    $nro = $row[1];
    $pdf->Ln(5);
    $pdf->SetX(30);
    $pdf->SetFont('Arial', 'BU', 11);
    $pdf->Cell(50, 5, 'DATOS DE DOCENTE ', 1, 1, 'C');
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetX(30);
    $pdf->Cell(50, 6, 'DNI DOCENTE', 1, 0, 'C', 1);
    $pdf->Cell(75, 6, utf8_decode($dni), 1, 1, 'C');
    $pdf->SetX(30);
    $pdf->Cell(50, 6, 'APELLIDOS Y NOMBRES', 1, 0, 'C', 1);
    $pdf->Cell(75, 6, utf8_decode($nom), 1, 1, 'C');
    $pdf->SetX(30);
    $pdf->Cell(50, 6, utf8_decode('NIVEL DE ENSEÑANSA'), 1, 0, 'C', 1);
    $pdf->Cell(75, 6, utf8_decode(" (" . $grad . ")"), 1, 1, 'C');
    $pdf->SetX(30);
    $pdf->Cell(50, 6, utf8_decode('ESTADO'), 1, 0, 'C', 1);
    $pdf->Cell(75, 6, utf8_decode($row['descrEst']), 1, 1, 'C');


    if ($row[9] == '0') {
        $pdf->Image('img/noimage.png', 160, 50, 30);
    } else {
        $pdf->Image('img/docentes/' . $row[1] . '.' . $row[9], 160, 50, 30, 30, $row[9]);
    }

    $anioe = utf8_decode($row[9]);
}
require 'control/conexion.php';
$query = "SELECT * FROM asigdocente ad
join cursos c on ad.idCursos=c.idCursos
join docente d on ad.idDocente=d.idDocente
join grado g on ad.idGrado=g.idGrado
join seccion s on ad.idSeccion=s.idSeccion
join tipogrado tg on c.idtipogrado=tg.idTipo
join anioescolar ae on ad.idAnioEscolar=ae.idAnioEscolar
join estados e on ad.est=e.idestados
where d.idDocente=$id";
$resultado = $mysqli->query($query);
$pdf->Ln(5);
$pdf->SetX(30);
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Cell(70, 5, 'CURSOS ASIGNADOS ', 1, 1, 'C');
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(5);
$pdf->SetX(15);
$pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'C', 1);
$pdf->Cell(80, 6, 'CURSO', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'GRADO', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'SECCION', 1, 0, 'C', 1);
$pdf->Cell(30, 6, utf8_decode('AÑO ESCOLAR'), 1, 1, 'C', 1);
$i = 1;
while ($row = $resultado->fetch_array()) {
    $pdf->SetX(15);
    $pdf->Cell(10, 6, $i, 1, 0, 'C');
    $pdf->Cell(80, 6, utf8_decode($row[7]), 1, 0, 'C');
    $pdf->Cell(40, 6, utf8_decode($row[27]." (".$row[34].")"), 1, 0, 'C');
    $pdf->Cell(20, 6, utf8_decode($row[31]), 1, 0, 'C');
    $pdf->Cell(30, 6, utf8_decode($row[37]), 1, 1, 'C');
    $i++;
}

$pdf->Ln(20);
$pdf->Cell(200, 6, '_______________________                     	______________________', 0, 0, 'C', 0);
$pdf->Ln(6);
$pdf->Cell(198, 6, 'Firma Docente                                        Firma Director', 0, 0, 'C', 0);
$modo = "I";
$nombre_archivo = "Lista_Incidencias_" . $nro . "_" . $anioe . ".pdf";
$pdf->Output($nombre_archivo, $modo);
?>