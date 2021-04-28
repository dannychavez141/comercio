<?php

class dboanioescolar {

    function ultimoanio() {
        $conexion = new cConexion();
        $sql = "SELECT idAnioEscolar,descr FROM anioescolar where est=1 order by idAnioEscolar desc limit 1 ;";
        $bd = $conexion->getBd();
        $aniodb = $bd->query($sql);
        $anio = mysqli_fetch_array($aniodb);
        return $anio;
    }

    function verunAnio($idanio) {
        $conexion = new cConexion();
        $sql = "SELECT * FROM anioescolar where idAnioEscolar='$idanio';";
        $bd = $conexion->getBd();
        $aniodb = $bd->query($sql);
        $anio = mysqli_fetch_array($aniodb);
        return $anio;
    }

    function verunGrado($idgrado) {
        $conexion = new cConexion();
        $sql = "SELECT * FROM grado g 
join tipogrado t on g.idTipo=t.idTipo where g.idGrado='$idgrado';";
        $bd = $conexion->getBd();
        $gradodb = $bd->query($sql);
        $grado = mysqli_fetch_array($gradodb);
        return $grado;
    }

    function verunSeccion($idsecc) {
        $conexion = new cConexion();
        $sql = "SELECT * FROM seccion where idSeccion='$idsecc';";
        $bd = $conexion->getBd();
        $seccdb = $bd->query($sql);
        $secc = mysqli_fetch_array($seccdb);
        return $secc;
    }
    function vertodos() {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT idAnioEscolar,descr FROM anioescolar where est=1 order by idAnioEscolar desc";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

}
