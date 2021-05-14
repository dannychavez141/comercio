<?php

class cConexion {
    private $bd;
    function __construct() {
     $this->bd = new mysqli('localhost','root','','comercio');  
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
