
<?php

$mysqli = new mysqli('localhost','root','','premiumc_premiumcollege');  
  //$this->bd = new mysqli("179.61.12.105","premiumc_premium","Losloles54","premiumc_premiumcollege");
	if($mysqli->connect_errno){
        echo 'Conexion Fallida : ', $this->bd->connect_errno;}
