<?php
	require 'fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{ //Put the watermark
    $this->Image('img/marca.png','0','0','300','200','PNG');
			$this->Image('img/escudo.jpg', 10, 10, 30 );
			$this->Image('img/logo.png', 250, 10, 35 );
			$this->SetFont('Arial','BU',15);
			$this->Ln(10);
			$this->SetX(100);
			$this->Cell(100,10, 'LISTA DE DEUDAS DE ALUMNOS MATRICULADOS',0,0,'C');
			$this->Ln(15);
		


		}

	

		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>