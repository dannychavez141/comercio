<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dboseccion
 *
 * @author DaHeLap
 */
class dboseccion {
   function verSecciones(){
         $sql = "SELECT * FROM `seccion`  where est=1;";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $rs = $bd->query($sql);
        $datos= array();
        while ($dato= mysqli_fetch_array($rs)) {
              $datos[] = $dato;
        }
        $bd->close();
        return $datos;
        
    }
}
