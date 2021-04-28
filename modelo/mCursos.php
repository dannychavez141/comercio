<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mCursos
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
class mCursos {
  function verCursosNivel($idNivel) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT * FROM cursos where idtipogrado='$idNivel' and est='1';";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }
    function verGradosNivel($idNivel) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT * FROM grado where  idTipo='$idNivel' and est='1';";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }
}
