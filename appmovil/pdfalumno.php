<?php
	include './plantillas/plantillaalumno.php';
	require '../control/conexion.php';
	$id=$_GET['cod'];
	$query = "SELECT * FROM alumnos a 
join apoderado ap on a.dniapo=ap.dni 
join apoderado a1 on a.dnipadre=a1.dni 
join apoderado a2 on a.dnimadre=a2.dni 
join tipoapoderado t on ap.idtipoApoderado=t.idtipoApoderado 
join estados e  on    a.est=e.idestados 
join sexo s on a.idsex=s.idsexo  where  a.dni=$id;";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	
	
	while($row = $resultado->fetch_array())
	{
 $pdf->SetFont('Arial','B',12);
	
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
	$pdf->Cell(100,5,utf8_decode($row[1]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, ' APELLIDOS Y NOMBRES :',0,1,'C');
if ($row[9]=='0') {
	$pdf->Image('../img/noimage.png', 140, 50, 45,45 );
}else{
	$pdf->Image('../img/alumnos/'.$row[1].'.'.$row[9], 140, 50, 45,45,$row[9]);}
$dni=$row[1];
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[3]." ".$row[4]." ".$row[2]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$dia=date("j"); 
$mes=date("n"); 
$ano=date("Y"); 

$nacimiento=explode("-",$row[5]); 
$dianac=$nacimiento[2]; 
$mesnac=$nacimiento[1]; 
$anonac=$nacimiento[0]; 
//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual 
if (($mesnac == $mes) && ($dianac > $dia)){ 
$ano=($ano-1);} 
//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual 
if ($mesnac > $mes){ 
$ano=($ano-1);} 
//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad 
$edad=($ano-$anonac); 
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'FECHA DE NACIMIENTO / EDAD:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[5]." / ".$edad." AÑOS"),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'SEXO:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[50]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Ln(3);
	$pdf->SetX(45);-
	$pdf->SetFont('Arial','BU',12);
	$pdf->Cell(10,5, 'DATOS DE APODERADO',0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'DNI APODERADO:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[15]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'DATOS DE APODERADO:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[17]." ".$row[18]." ".$row[16]),0,1,'C');
	$pdf->Ln(3);
	$pdf->SetX(45);
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'DIRECCION:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[19]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'TELEFONO:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[20]),0,1,'C');
	$pdf->Ln(3);
	$pdf->SetX(45);

	
	$pdf->SetFont('Arial','BU',12);
	$pdf->Cell(10,5, 'DATOS DE FAMILIARES',0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'DNI PADRE:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[25]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'DATOS DE PADRE:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[27]." ".$row[28]." ".$row[26]),0,1,'C');
	$pdf->Ln(3);
	$pdf->SetX(45);$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'DNI MADRE:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[35]),0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(3);
	$pdf->SetX(40);
	$pdf->Cell(30,5, 'DATOS DE MADRE:',0,1,'C');
	$pdf->SetFont('Arial','',12);
	$pdf->Ln(1);
	$pdf->SetX(40);
	$pdf->Cell(100,5,utf8_decode($row[37]." ".$row[38]." ".$row[36]),0,1,'C');
	$pdf->Ln(3);
	$pdf->SetX(45);
	$pdf->Ln(7);
	$pdf->Cell(196,6,'_______________________                     	______________________',0,0,'C',0);
$pdf->Ln(10);
	$pdf->Cell(194,6,'Firma Apoderado                                        Firma Director',0,0,'C',0);
	}
	$modo="I";
    $nombre_archivo="Ficha_alumno_".$dni.".pdf";
    $pdf->Output($nombre_archivo,$modo); 


