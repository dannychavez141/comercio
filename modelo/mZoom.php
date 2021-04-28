<?php

class mZoom {

    function vertodos() {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT z.idDocente, concat(d.apepa,' ',d.apema,' ',d.nomb) as prof,z.url,z.codigo,z.pass FROM zoomdocente z
join docente d on z.idDocente=d.idDocente";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function verUno($doc) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT z.idDocente, concat(d.apepa,' ',d.apema,' ',d.nomb) as prof,z.url,z.codigo,z.pass FROM zoomdocente z
join docente d on z.idDocente=d.idDocente
where z.idDocente='$doc';";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function verTododeSalon($salon) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT * FROM asigdocente ad
join docente d on ad.idDocente=d.idDocente
join cursos c on ad.idCursos=c.idCursos
join zoomdocente z on d.idDocente=z.idDocente
where ad.idGrado='{$salon['idgrado']}' and ad.idSeccion='{$salon['idsecc']}' and ad.idAnioEscolar='{$salon['idanio']}';";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function crear($zoom) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "INSERT INTO `zoomdocente`
(`iddocente`,
`url`,
`codigo`,
`pass`)
VALUES
('{$zoom['iddoc']}',
'{$zoom['url']}',
'{$zoom['codigo']}',
'{$zoom['pass']}');
";
        if ($bd->query($consulta)) {
            $resp = "AGREGADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

    function modificar($zoom) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "UPDATE `zoomdocente`
SET
`url` = '{$zoom['url']}',
`codigo` = '{$zoom['codigo']}',
`pass` = '{$zoom['pass']}'
WHERE `iddocente` = '{$zoom['iddoc']}';";
        if ($bd->query($consulta)) {
            $resp = "MODIFICADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

    function eliminar($zoom) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "DELETE FROM `zoomdocente`
WHERE `iddocente` = '{$zoom['iddoc']}';";
        if ($bd->query($consulta)) {
            $resp = "ELIMINADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

}
