<?php

include 'plantillapdf/plantillamatriculados.php';

$anio = $_GET['anio'];
$grado = $_GET['grado'];
$secc = $_GET['secc'];

$ngrado = '';
$nanio = '';
$nsecc = '';
$ntipo = '';
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
require 'control/conexion.php';
$query = "SELECT * FROM grado g 
join tipogrado t on g.idTipo=t.idTipo where g.idGrado='$grado';";
$resultado = $mysqli->query($query);
while ($row = $resultado->fetch_array()) {
    $ngrado = utf8_decode($row[1]);
    $ntipo = utf8_decode($row[5]);
}
require 'control/conexion.php';
$query = "SELECT * FROM seccion where idSeccion='$secc';";
$resultado = $mysqli->query($query);
while ($row = $resultado->fetch_array()) {

    $nsecc = utf8_decode($row[1]);
}
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
    $pdf->Cell(75, 6, utf8_decode($ngrado . " " . $nsecc . " (" . $ntipo . ")"), 1, 1, 'C');
    $pdf->SetX(50);
    $pdf->Cell(50, 6, utf8_decode('AÑO ESCOLAR'), 1, 0, 'C', 1);
    $pdf->Cell(75, 6, utf8_decode($nanio), 1, 1, 'C');
}

require 'control/conexion.php';
$nlista = 1;
$query = "SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where m.idAnioEscolar='$anio' and m.idGrado='$grado' and m.idSeccion='$secc' and m.est='1' order by a.apepa ";
$resultado = $mysqli->query($query);
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
while ($row = $resultado->fetch_array()) {
    $pdf->SetX(25);
    $pdf->Cell(10, 6, $nlista, 1, 0, 'C');
    $pdf->Cell(80, 6, utf8_decode($row[2]), 1, 0, 'C');
    $pdf->Cell(70, 6, utf8_decode(''), 1, 1, 'C');

    $nlista++;
}

$pdf->Ln(20);
$pdf->Cell(200, 6, '                    	______________________', 0, 0, 'C', 0);
$pdf->Ln(6);
$pdf->Cell(198, 6, '                        Firma Director', 0, 0, 'C', 0);
$modo = "I";
$nombre_archivo = "Lista_Matriculados_" . $nanio . "_" . $ngrado . "_" . $nsecc . "_" . $ntipo . ".pdf";
$pdf->Output($nombre_archivo, $modo);
