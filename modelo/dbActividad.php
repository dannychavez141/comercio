<?php

class dbActividad {
    function verActividades(){
         $sql = "SELECT * FROM `actividad`";
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
    function verActividad($id){
         $sql = "SELECT * FROM `actividad`  where idactividad='$id'";
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