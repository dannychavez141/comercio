<?php
	include 'plantillapdf/plantillapago.php';
	include 'control/conexion.php';
	include 'control/numeroletras.php';
$rec = $_GET['cod'];

	$query = "SELECT p.numero,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema) as apo,ap.dir,d.idDeuda,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,p.fecha,d.vencimiento,d.monto,d.interes,p.recibido,p.vuelto ,
d.descr,g.descr,s.descr,tg.descr, es.descrEst,tp.descr,p.trecibo,if(p.trecibo=1,'BOLETA DE VENTA','FACTURA') AS tiporecibo
FROM pago p
join deuda d on p.idDeuda=d.idDeuda
join apoderado ap on p.idApo=ap.idApoderado
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado 
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados
join tipopago tp on p.idtipopago=tp.idtipopago
where  sha1(p.idpago)='$rec'";
     
	$resultado = $mysqli->query($query);
	$pdf = new PDF('L','mm', array(180,200));
	$pdf->AliasNbPages();
	$pdf->AddPage();
	while($row = $resultado->fetch_array())
	{
if ($row[20]==1) {
	
	if($row[0]<10){$bol='C-001-000';}
	if($row[0]<100 && $row[0]>=10){$bol='C-0001-00';}
	if($row[0]<1000 && $row[0]>=100){$bol='C-0001-0';}
	if($row[0]<10000 && $row[0]>=1000){$bol='C-0001-';}

}else
{
	if($row[0]<10){$bol='F-001-000';}
	if($row[0]<100 && $row[0]>=10){$bol='F-0001-00';}
	if($row[0]<1000 && $row[0]>=100){$bol='F-0001-0';}
	if($row[0]<10000 && $row[0]>=1000){$bol='F-0001-';}

}
	$pdf->Ln(2);
	$pdf->Ln(5);
	$pdf->SetX(20);
	
	$pdf->SetFillColor(252,213,0);
	$pdf->SetFont('Arial','B',8);
	
	$pdf->SetX(20);
	$pdf->Cell(40,6,'R.U.C. 20601760461',1,0,'C');
	$pdf->SetX(120);
	$pdf->Cell(40,6,utf8_decode("COMPROMISO DE PAGO N°"),1,1,'C',1);
	$pdf->SetX(20);
	$pdf->Cell(40,6,utf8_decode("COMPROMISO DE PAGO"),1,0,'C',1);
	$pdf->SetX(120);
	$pdf->Cell(40,6,utf8_decode($bol.$row[0]),1,1,'C');
	$pdf->Ln(5);
	$pdf->SetX(30);
	$pdf->Cell(40,6,utf8_decode('DNI/RUC:'),1,0,'C',1);
	$pdf->Cell(80,6,utf8_decode($row[1]),1,1,'C');
	$pdf->SetX(30);
	$pdf->Cell(40,6,utf8_decode('Señor(es):'),1,0,'C',1);
	$pdf->Cell(80,6,utf8_decode($row[2]),1,1,'C');	
	$pdf->SetX(30);
	$pdf->Cell(40,6,utf8_decode('Direccíon:'),1,0,'C',1);
	$pdf->Cell(80,6,utf8_decode($row[3]),1,1,'C');	
	$pdf->SetFont('Arial','B',8);	
	$cod=$row[0];	
	$pdf->Ln(5);
	$pdf->SetFillColor(252,213,0);
	$pdf->SetX(15);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(25,6,'CANTIDAD',1,0,'C',1);
	$pdf->Cell(80,6,'DETALLE',1,0,'C',1);
	$pdf->Cell(30,6,'PRECIO UNI. S/',1,0,'C',1);
	$pdf->Cell(30,6,'SUB TOTAL S/',1,1,'C',1);
	$pdf->SetFont('Arial','',8);	
     
     $posy0=$pdf->GetY();
	  $pdf->SetX(40);
		$posx=$pdf->GetX();
		$posy=$pdf->GetY();
		$pdf->MultiCell(80,6,utf8_decode($row[14]." - ".$row[6]." - ".$row[15]." ".$row[16]."-".$row[19]),1);
		$posy2=$pdf->GetY();
		$pdf->SetY($posy);
		$pdf->SetX($posx+80);
		$pdf->Cell(30,($posy2-$posy),"S/.".number_format($row[10],2),1,0,'C');
		$pdf->Cell(30,($posy2-$posy),"S/.".number_format($row[10],2),1,1,'C');
		$pdf->SetY($posy0);
  $pdf->SetX(15);
  $pdf->Cell(25,($posy2-$posy),utf8_decode(1),1,0,'C');
$impuesto=$row[11];
if ($impuesto>0) {
	
  $pdf->SetY($posy2);
  $posy0=$pdf->GetY();
	  $pdf->SetX(40);
		$posx=$pdf->GetX();
		$posy=$pdf->GetY();
		$pdf->MultiCell(80,6,utf8_decode("Impuesto por Vencimiento de Pago"),1);
		$posy2=$pdf->GetY();
		$pdf->SetY($posy);
		$pdf->SetX($posx+80);
		$pdf->Cell(30,($posy2-$posy),"S/.".number_format($row[11],2),1,0,'C');
		$pdf->Cell(30,($posy2-$posy),"S/.".number_format($row[11],2),1,1,'C');
		$pdf->SetY($posy0);
  $pdf->SetX(15);
  $pdf->Cell(25,($posy2-$posy),utf8_decode(1),1,0,'C');

}$pdf->SetFont('Arial','B',8);
$total=$row[11]+$row[10];
		$pdf->SetY($posy2);
		
if ($row[20]==2) {
	$pdf->SetX(80);
	$pdf->Cell(70,6,'I.G.V.:',1,0,'C',1);
	$pdf->Cell(30,6,"S/.".number_format(0,2),1,1,'C',1);
$nombre_archivo="Factura_Nro_".$bol.$row[0].".pdf";
}else{
	$nombre_archivo="Boleta_de_venta_Nro_".$bol.$row[0].".pdf";
}

	$pdf->SetX(80);
	$pdf->Cell(70,6,'TOTAL:',1,0,'C',1);
	$pdf->Cell(30,6,"S/.".number_format($total,2),1,1,'C');
		$pdf->SetX(80);

	//$pdf->Cell(70,6,'RECIBIDO:',1,0,'C',1);
	//$pdf->Cell(30,6,"S/.".number_format($row[12],2),1,1,'C');
	//$pdf->SetX(80);
	//$pdf->Cell(70,6,'VUELTO:',1,0,'C',1);
	//$pdf->Cell(30,6,"S/.".number_format($row[13],2),1,1,'C');
$pdf->SetX(80);
	$pdf->Cell(100,6,"".numletras(number_format($total,2),1),1,1,'C');
        $qrurl='qrimg/'.$rec.'.png';
if(file_exists($qrurl)){
$pdf->Image($qrurl, 10, 120, 50 );

}
	}
	$modo="I";
    $pdf->Output($nombre_archivo,$modo); 	

?>