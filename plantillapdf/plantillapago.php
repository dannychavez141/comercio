<?php
	require 'fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{ //Put the watermark
    $this->Image('img/marca.png','0','0','175','200','PNG');
			$this->Image('img/escudo.jpg', 10, 10, 20 );
			$this->Image('img/logo.png', 150, 10, 25 );
			$this->SetFont('Times','B',20);
			$this->Ln(5);
			$this->Cell(150,10, 'Premium College S.R.L',0,0,'C');
			$this->SetFont('Arial','B',8);
			$this->Ln(8);
			$this->Cell(150,10, utf8_decode('EDUCACÍON PRIMARIA-SECUNDARIA-PRE-UNIVERSITARIA'),0,0,'C');
			$this->SetFont('Arial','BU',10);
			$this->Ln(5);
			
		


		}

	

		function Footer()
		{
			$this->SetY(-20);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Servicios Prestados en la Amazonia',0,1,'C' );
			$this->SetY(-10);
			$this->Cell(0,10, 'Conserve Su Recibo',0,0,'C');
		}		
	}
?>