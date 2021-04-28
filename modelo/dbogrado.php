<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbogrado
 *
 * @author DaHeLap
 */
class dbogrado {
    function verGrados(){
         $sql = "SELECT * FROM grado g 
join tipogrado t on g.idTipo=t.idTipo   where g.est=1;";
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
    function verGradosNivel($idniv){
         $sql = "SELECT * FROM grado g 
join tipogrado t on g.idTipo=t.idTipo   where g.est=1 and g.idTipo='$idniv'";
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
     function verAlumnos($bus) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT * FROM alumno a 
join estado e on a.est=e.idestado  
join carrera c on a.idcarrera=c.idcarrera
where a.est!=4 and concat(CodAlumno,NombreAlum,ApepaAlum,ApemaAlum,token) like '%$bus%' limit 30;";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }
}
