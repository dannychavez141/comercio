<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mCompetencias
 *
 * @author DaHeLap
 */
class mCompetencias {

    function verCompetenciasCurso($idcurso) {
        $sql = "SELECT co.idComp,c.idCursos,c.descr as curso,CONVERT(CAST(CONVERT(co.descr USING latin1) AS BINARY) USING utf8)as competencia FROM competencias co 
join cursos c on co.idcurso=c.idCursos where co.est=1 and co.idcurso='$idcurso';";
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

}
