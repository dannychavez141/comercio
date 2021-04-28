<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbotipoasistencia
 *
 * @author pcdahe
 */
class dbotipoasistencia {
   
    function vertipos()
    { $sql = "SELECT * FROM tipo_asistencia;";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $rs = $bd->query($sql);
        while ($tipo = mysqli_fetch_array($rs)) {
            $tipos[]=$tipo;
        }
        return $tipos;
    }
}
