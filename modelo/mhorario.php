<?php

class mhorario {

    function vertodos($busqueda) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT g.idGrado,g.descr as grado,s.idSeccion,s.descr as seccion , a.idAnioEscolar,a.descr as anio,tg.idTipo, tg.descr as tipo,h.urlHorario FROM horario h
join grado g on h.idgrado= g.idGrado
join seccion s on h.idsecc= s.idSeccion
join anioescolar a on h.idanio= a.idAnioEscolar
join tipogrado tg on g.idTipo= tg.idTipo";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function verUno($horario) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT g.idGrado,g.descr as grado,s.idSeccion,s.descr as seccion , a.idAnioEscolar,a.descr as anio,tg.idTipo, tg.descr as tipo,h.urlHorario FROM horario h
join grado g on h.idgrado= g.idGrado
join seccion s on h.idsecc= s.idSeccion
join anioescolar a on h.idanio= a.idAnioEscolar
join tipogrado tg on g.idTipo= tg.idTipo
where  h.idanio='{$horario['idanio']}'";
        if ($horario['idgrado'] != '0') {
            $consulta .= "and h.idgrado='{$horario['idgrado']}' ";
        }
        if ($horario['idsecc'] != '0') {
            $consulta .= "and h.idsecc='{$horario['idsecc']}' ";
        }
        if ($horario['idniv'] != '0') {
            $consulta .= "and g.idTipo='{$horario['idniv']}' ";
        }
       // echo $consulta;
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function crear($horario) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "INSERT INTO `horario`
(`idgrado`,
`idsecc`,
`idanio`,
`urlHorario`)
VALUES
('{$horario['idgrado']}',
'{$horario['idsecc']}',
'{$horario['idanio']}',
'{$horario['urlHorario']}');
";
        if ($bd->query($consulta)) {
            $resp = "AGREGADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

    function modificar($horario) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "UPDATE `horario`
SET
`urlHorario` = '{$horario['urlHorario']}'
WHERE `idgrado` = '{$horario['idgrado']}' AND `idsecc` = '{$horario['idsecc']}' AND `idanio` = '{$horario['idanio']}';
";
        if ($bd->query($consulta)) {
            $resp = "MODIFICADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

    function eliminar($horario) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "DELETE FROM `horario`
WHERE `idgrado` = '{$horario['idgrado']}' AND `idsecc` = '{$horario['idsecc']}' AND `idanio` = '{$horario['idanio']}';
";
        if ($bd->query($consulta)) {
            $resp = "ELIMINADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

}
