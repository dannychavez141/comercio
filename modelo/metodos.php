<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of metodos
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
class metodos {
  function ejecutar($sql, $msj) {
       // echo $sql;
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        if ($bd->query($sql)) {
            $resp = $msj;
        } else {
            $resp = mysqli_errno($bd);
        }
        return $resp;
    }

    function consultar($sql) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $respuesta = $bd->query($sql);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }
function consultarrep($sql) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $respuesta = $bd->query($sql);
       $dato = mysqli_fetch_array($respuesta);
        return $dato;
    }
}
