<?php
	require 'fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{ //Put the watermark
    $this->Image('img/tarjeta.png','0','0','55','85','PNG');
			$this->Image('img/escudo.jpg', 2, 3, 10 );
			$this->Image('img/logo.png', 40, 3, 10 );
			$this->SetFont('Arial','BU',8);
			$this->Ln(1);
			$this->SetX(12);
			$this->Cell(28,10, 'TARJETA PREMIUN',0,0,'C');
			$this->SetY(18);
			
		


		}

	

		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 6);
			$this->Cell(0,10, 'Premium College',0,0,'C' );
		}		
	}
?>