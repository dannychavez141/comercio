<?php

class cConexion {
    private $bd;
    function __construct() {
     $this->bd = new mysqli('localhost','root','','premiumc_premiumcollege');  
  //$this->bd = new mysqli("179.61.12.105","premiumc_premium","Losloles54","premiumc_premiumcollege");
	if($this->bd->connect_errno){
		echo 'Conexion Fallida : ', $this->bd->connect_errno;
		exit();
	};
    }
    function getBd() {
        return $this->bd;
    }

    function setBd($bd) {
        $this->bd = $bd;
    }


}
