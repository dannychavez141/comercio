<?php
	include './plantillas/plantillaincidencia.php';
	require '../control/conexion.php';
	$id=$_GET['cod'];
	$query = "SELECT * FROM premiumc_premiumcollege.insidencias i
join matricula m on i.IdMat=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipoinsidencia ti on i.idtipoIns=ti.idtipoInsidencia 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion 
join tipogrado tg on g.idTipo=tg.idTipo
where i.idinsidencias=$id";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	
	
	while($row = $resultado->fetch_array())
	{$pdf->SetFont('Arial','B',12);

	$pdf->Ln(2);
	$pdf->SetX(40);
	$pdf->SetFont('Arial','BU',12);
	$pdf->Cell(10,5, 'DATOS DE ALUMNO ',0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'DNI ALUMNO:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[19]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, ' APELLIDOS Y NOMBRES :',0,1,'C');
if ($row[27]=='0') {
	$pdf->Image('../img/noimage.png', 140, 50, 45,45 );
}else{
	$pdf->Image('../img/alumnos/'.$row[19].'.'.$row[27], 140, 50, 45,45,$row[27]);}
$dni=$row[19];
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[21]." ".$row[22]." ".$row[20]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'GRADO Y SECCION:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[38]." ".$row[42]." (".$row[45].")"),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, utf8_decode('AÑO ESCOLAR:'),0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[35]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Ln(3);
	$pdf->SetX(45);-
	$pdf->SetFont('Arial','BU',12);
	$pdf->Cell(10,5, 'DESCRIPCION DE INCIDENCIA',0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'TIPO DE INCIDENCIA:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[33]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'DESCRIPCION DE INCIDENCIA:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(5);
	$pdf->SetX(40);
	$pdf->MultiCell(100,5,utf8_decode($row[3]),0,1);
	
	$pdf->Ln(3);
	$pdf->SetX(45);

	if ($row[4]=='usuario') {
                 $sql = "SELECT * FROM usuario 
where idUsuario='$row[5]';";

$generado='';
                                 $lista = $mysqli->query($sql);
                                while($user = $lista->fetch_array())
                               {
                                        $generado=$user[2].' '.$user[3].' '.$user[4]."  (DIRECTOR)";
                               } 
              }else{$sql = "SELECT * FROM docente 
where idDocente='$row[5]';";

$generado='';
                                 $lista = $mysqli->query($sql);
                                while($user = $lista->fetch_array())
                               {
                                        $generado=$user[2].' '.$user[3].' '.$user[4]."  (DOCENTE)";
                               } }

	$pdf->SetFont('Arial','BU',12);
	$pdf->Cell(10,5, 'INCIDENCIA GENERADA POR:',0,1,'C');
	
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	
	$pdf->Cell(100,5,utf8_decode($generado),0,1,'C');
	$pdf->Ln(3);
	$pdf->SetX(45);$pdf->SetFont('Arial','B',12);
	
	$pdf->Ln(3);
	$pdf->SetX(45);
	$pdf->Ln(15);
	$pdf->Cell(196,6,'_______________________                     	______________________',0,0,'C',0);
$pdf->Ln(10);
	$pdf->Cell(194,6,'Firma Apoderado                                        Firma Director',0,0,'C',0);
	}
	$modo="I";
    $nombre_archivo="Boleta_Incidencia_alumno_".$dni.".pdf";
    $pdf->Output($nombre_archivo,$modo); 
?>