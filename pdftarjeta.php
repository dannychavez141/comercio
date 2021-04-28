<?php
	include 'plantillapdf/plantillatarjeta.php';
	require 'control/conexion.php';
	$id=$_GET['cod'];
	$query = "SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu, a.ext ,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
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
where m.idMatricula='$id';";
	$resultado = $mysqli->query($query);

	while($row = $resultado->fetch_array())
	{ $dni=$row[1];
	$pdf = new PDF('P','mm', array(54,84));
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetX(10);
	if ($row[3]=='0') {
	$pdf->Image('img/noimage.png', 17, 18, 20,20 );
}else{
	$pdf->Image('img/alumnos/'.$row[1].'.'.$row[3], 17, 18, 20,20,$row[3]);}
$pdf->SetY(38);
	$pdf->SetX(10);
	$pdf->SetFont('Arial','BU',8);
	$pdf->Cell(30,4, utf8_decode('Apellidos y Nombres'),0,1,'C');
	$pdf->SetFont('Arial','B',7.5);
	$pdf->SetX(10);
	$pdf->MultiCell(37,4,utf8_decode($row[2]),0,1);
	$pdf->SetX(10);
	$pdf->SetFont('Arial','BU',8);
	$pdf->Cell(30,4, 'Grado y Seccion',0,1,'C');
	$pdf->SetFont('Arial','B',8);
	$pdf->SetX(15);
	$pdf->Cell(20,4,utf8_decode($row[11].' '. $row[13]),0,1,'C');
	$pdf->SetX(15);
	$pdf->Cell(20,4,utf8_decode("(".$row[9].")"),0,1,'C');

	
	

}

	$modo="I";
    $nombre_archivo="Tarjeta_".$dni.".pdf";
    $pdf->Output($nombre_archivo,$modo); 
?>