<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dboCorreo
 *
 * @author pcdahe
 */
class dboCorreo {
    function verUncorreo($dni)
    {
       $conexion=new cConexion();
        $sql="SELECT * FROM correos where dniApo='$dni';";
        $bd=$conexion->getBd();
        $aniodb=$bd->query($sql);
        $anio= mysqli_fetch_array($aniodb);
        return $anio; 
    }
}
