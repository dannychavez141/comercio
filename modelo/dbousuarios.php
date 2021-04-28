<?php
class dbousuarios {
    function verusuarios($clave) {
        if ($clave=="acm1ptbt") {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
    $sql="SELECT * FROM usuario;";
        $rs = $bd->query($sql);
        while ($row = $rs->fetch_array()) {

            $usuarios[] = array_map('utf8_encode', $row);
        } 
        $rs->close();
    }
        return json_encode($usuarios);
        
    }
} 