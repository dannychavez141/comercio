<?php
	include 'plantillapdf/plantillaincidencias.php';
	require 'control/conexion.php';
	$id=$_GET['cod'];
	$query = "call verunamatricula($id)";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	
	
	while($row = $resultado->fetch_array())
	{
	$nro=$row[1];
	$pdf->Ln(5);
	$pdf->SetX(30);
	$pdf->SetFont('Arial','BU',11);
	$pdf->Cell(50,5, 'DATOS DE ALUMNO ',1,1,'C');
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',9);
	$pdf->SetX(30);
	$pdf->Cell(50,6,'DNI ALUMNO',1,0,'C',1);
	$pdf->Cell(75,6,utf8_decode($row[1]),1,1,'C');
	$pdf->SetX(30);
	$pdf->Cell(50,6,'APELLIDOS Y NOMBRES',1,0,'C',1);
	$pdf->Cell(75,6,utf8_decode($row[2]),1,1,'C');
	$pdf->SetX(30);
	$pdf->Cell(50,6,'GRADO Y SECCION',1,0,'C',1);
	$pdf->Cell(75,6,utf8_decode($row[11]." ".$row[13]." (".$row[7].")"),1,1,'C');
	$pdf->SetX(30);
	$pdf->Cell(50,6,utf8_decode('AÑO ESCOLAR'),1,0,'C',1);
	$pdf->Cell(75,6,utf8_decode($row[9]),1,1,'C');
	
	
if ($row[3]=='0') {
	$pdf->Image('img/noimage.png', 160, 50, 30 );
}else{
	$pdf->Image('img/alumnos/'.$row[1].'.'.$row[3], 160, 50, 30,30,$row[3]);}
	
	$anioe=utf8_decode($row[9]);
	
	}
	require 'control/conexion.php';
$query = "SELECT * FROM premiumc_premiumcollege.insidencias i
join matricula m on i.IdMat=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipoinsidencia ti on i.idtipoIns=ti.idtipoInsidencia 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion 
join tipogrado tg on g.idTipo=tg.idTipo
where i.IdMat='$id' and i.est='1'";
	$resultado = $mysqli->query($query);
	$pdf->Ln(5);
	$pdf->SetX(30);
	$pdf->SetFont('Arial','BU',11);
	$pdf->Cell(70,5, 'INCIDENCIAS REGISTRADAS',1,1,'C');
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',9);
	$pdf->Ln(5);
	$pdf->SetX(15);
	$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',1);
	$pdf->Cell(20,6,'TIPO',1,0,'C',1);
	$pdf->Cell(80,6,'DESCRIPCION',1,0,'C',1);
	$pdf->Cell(20,6,'FECHA',1,0,'C',1);
	$pdf->Cell(50,6,'CREADO POR',1,1,'C',1);
while($row = $resultado->fetch_array())
	{
	$pdf->SetX(15);
		$pdf->Cell(10,6,$row[0],1,0,'C');
		$tipomer=explode( '-', $row[33]);
		$pdf->Cell(20,6,utf8_decode($tipomer[0] ),1,0,'C');
		$pdf->Cell(80,6,utf8_decode($row[3]),1,0,'C');
		$pdf->Cell(20,6,utf8_decode($row[6]),1,0,'C');
		if ($row[4]=='usuario') {
                 $sql = "SELECT * FROM usuario 
where idUsuario='$row[5]';";

$generado='';
                                 $lista = $mysqli->query($sql);
                                while($user = $lista->fetch_array())
                               {
                                        $generado=$user[2].' (DIRECTOR)';
                               } 
              }else{$sql = "SELECT * FROM docente 
where idDocente='$row[5]';";

$generado='';
                                 $lista = $mysqli->query($sql);
                                while($user = $lista->fetch_array())
                               {
                                        $generado=$user[2].' (DOCENTE)';
                               } }
		$pdf->Cell(50,6,utf8_decode($generado),1,1,'C');
	
	}

	$pdf->Ln(20);
	$pdf->Cell(200,6,'_______________________                     	______________________',0,0,'C',0);
$pdf->Ln(6);
	$pdf->Cell(198,6,'Firma Apoderado                                        Firma Director',0,0,'C',0);
	$modo="I";
    $nombre_archivo="Lista_Incidencias_".$nro."_".$anioe.".pdf";
    $pdf->Output($nombre_archivo,$modo); 
?>