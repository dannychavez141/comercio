
<?php
	require 'fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{  $this->Image('img/marca.png','0','0','200','300','PNG');
			$this->Image('img/escudo.jpg', 10, 10, 20 );
			$this->Image('img/logo.png', 175, 10, 20 );
			$this->SetFont('Arial','BU',15);
			
		


		}
		function vcell($c_width,$c_height,$x_axis,$text){
$w_w=$c_height/3;
$w_w_1=$w_w+2;
$w_w1=$w_w+$w_w+$w_w+3;
//$w_w2=$w_w+$w_w+$w_w+$w_w+3;//for 3 rows wrap
$len=strlen($text);//check the length of the cell and splits the text into 7 character each and saves in a array 
if($len>7){
$w_text=str_split($text,7);//splits the text into length of 7 and saves in a array since we need wrap cell of two cell we took $w_text[0], $w_text[1] alone.
//if we need wrap cell of 3 row then we can go for    $w_text[0],$w_text[1],$w_text[2]
$this->SetX($x_axis);
$this->Cell($c_width,$w_w_1,$w_text[0],'','','');
$this->SetX($x_axis);
$this->Cell($c_width,$w_w1,$w_text[1],'','','');
//$this->SetX($x_axis);
//$this->Cell($c_width,$w_w2,$w_text[2],'','','');//for 3 rows wrap but increase the $c_height it is very important.
$this->SetX($x_axis);
$this->Cell($c_width,$c_height,'','LTRB',0,'L',0);
}
else{
$this->SetX($x_axis);
$this->Cell($c_width,$c_height,$text,'LTRB',0,'L',0);}
} 
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>