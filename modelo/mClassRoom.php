<?php

class mClassRoom {

    function vertodos($salon) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT cr.idgrado,g.descr as grado,cr.idsecc,s.descr as secc,tg.idTipo,tg.descr as tipo,cr.idanio,ae.descr as anio,cr.idcurso,c.descr as curso,cr.codigo FROM classroom cr
join grado g on cr.idgrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on cr.idsecc=s.idSeccion
join anioescolar ae on cr.idanio=ae.idAnioEscolar
join cursos c on cr.idcurso=c.idCursos 
where cr.idgrado='{$salon['idgrado']}' and cr.idsecc='{$salon['idsecc']}' and cr.idanio='{$salon['idanio']}' limit 20;";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function verUno($salon) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT cr.idgrado,g.descr as grado,cr.idsecc,s.descr as secc,tg.idTipo,tg.descr as tipo,cr.idanio,ae.descr as anio,cr.idcurso,c.descr as curso,cr.codigo FROM classroom cr
join grado g on cr.idgrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on cr.idsecc=s.idSeccion
join anioescolar ae on cr.idanio=ae.idAnioEscolar
join cursos c on cr.idcurso=c.idCursos
where cr.idgrado='{$salon['idgrado']}' and cr.idsecc='{$salon['idsecc']}' and cr.idanio='{$salon['idanio']}' and cr.idcurso='{$salon['idcurso']}';";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function crear($salon) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "INSERT INTO `classroom`
(`idcurso`,
`idgrado`,
`idsecc`,
`idanio`,
`codigo`)
VALUES
('{$salon['idcurso']}',
'{$salon['idgrado']}',
'{$salon['idsecc']}',
'{$salon['idanio']}',
'{$salon['codigo']}');";
        if ($bd->query($consulta)) {
            $resp = "AGREGADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

    function modificar($salon) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "UPDATE `classroom`
SET
`codigo` = '{$salon['codigo']}'
WHERE `idcurso` = '{$salon['idcurso']}' AND `idgrado` = '{$salon['idgrado']}' AND `idsecc` = '{$salon['idsecc']}' AND `idanio` = '{$salon['idanio']}';
";
        if ($bd->query($consulta)) {
            $resp = "MODIFICADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

    function eliminar($salon) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "DELETE FROM `classroom`
WHERE `idcurso` = '{$salon['idcurso']}' AND `idgrado` = '{$salon['idgrado']}' AND `idsecc` = '{$salon['idsecc']}' AND `idanio` = '{$salon['idanio']}'
 AND `codigo` = '{$salon['codigo']}'";
        if ($bd->query($consulta)) {
            $resp = "ELIMINADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

}
