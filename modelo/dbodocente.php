<?php

class dbodocente {

    function verdocentes($bus, $clave) {
        if ($clave == "acm1ptbt") {
            $conexion = new cConexion();
            $bd = $conexion->getBd();
            $sql = "SELECT idDocente,dni,concat(nomb,' ',apepa,' ',apema) as datos,targeta,saldo FROM docente where concat(dni,nomb,apepa,apema) like '%$bus%';";
            $rs = $bd->query($sql);
            while ($row = $rs->fetch_array()) {

                $docentes[] = array_map('utf8_encode', $row);
            }
            $rs->close();
        }
        return json_encode($docentes);
    }

    function verdocentesTargeta($targeta, $clave) {
        if ($clave == "acm1ptbt") {
            $conexion = new cConexion();
            $bd = $conexion->getBd();
            $docentes = array();
            $sql = "SELECT idDocente,dni,concat(nomb,' ',apepa,' ',apema) as datos,targeta,saldo FROM docente where targeta='$targeta';";
            $rs = $bd->query($sql);
            while ($row = $rs->fetch_array()) {

                $docentes[] = array_map('utf8_encode', $row);
            }
            $rs->close();
        }
        return json_encode($docentes);
    }
    function cambiarTarjeta($cod,$tarjeta,$token) {
       if ($token == "acm1ptbt") {
            $conexion = new cConexion();
            $bd = $conexion->getBd();
            $sql = "UPDATE `docente` SET `targeta` = '$tarjeta' WHERE (`idDocente` = '$cod');";
            if ($bd->query($sql)) {
                echo "TARJETA N°" . $targeta . " ASIGNADA CORRECTAMENTE";
            } else {
                echo "ERROR EN REGISTRO DE TARJETA" . $sql;
            }
            $bd->close();
        } 
    }
    function verlistadocentes() {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $sql = "SELECT d.idDocente,d.dni,concat(d.nomb,' ',d.apepa,' ',d.apema) as datos,descrCargo,detalle FROM docente d join cargo c on d.idtipo=c.idcargo where d.est=1";
        $rs = $bd->query($sql);
        while ($row = $rs->fetch_array()) {

            $docentes[] = $row;
        }
        $bd->close();
        return $docentes;
    }

    function VerTodosDocentes($bus) {
        $sql = "SELECT * FROM docente d 
join sexo s on d.idsex=s.idsexo
join estados e on d.est=e.idestados
join cargo t on d.idtipo=t.idcargo
where d.est=1 and concat(d.dni,d.apepa,d.apema,d.nomb) like '%$bus%' and d.est=1 and d.idtipo<10 limit 20;";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $rs = $bd->query($sql);
        $bd->close();
        return $rs;
    }

    function verundocente($cod) {
        $sql = "SELECT * FROM docente d 
join sexo s on d.idsex=s.idsexo
join estados e on d.est=e.idestados
join cargo t on d.idtipo=t.idcargo
where idDocente ='$cod';";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $rs = $bd->query($sql);
        $docente = mysqli_fetch_array($rs);
        return $docente;
    }
    

    function VerCursosAsignados($id) {
        $sql = "SELECT * FROM asigdocente ad
join cursos c on ad.idCursos=c.idCursos
join docente d on ad.idDocente=d.idDocente
join grado g on ad.idGrado=g.idGrado
join seccion s on ad.idSeccion=s.idSeccion
join tipogrado tg on c.idtipogrado=tg.idTipo
join anioescolar ae on ad.idAnioEscolar=ae.idAnioEscolar
where d.idDocente=$id";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $rs = $bd->query($sql);
        $datos = array();
        while ($dato = mysqli_fetch_array($rs)) {
            $datos[] = $dato;
        }
        $bd->close();
        return $datos;
    }

    function verCursosAsignadosajax($idDoc) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT * FROM asigdocente ad
join cursos c on ad.idCursos=c.idCursos
join docente d on ad.idDocente=d.idDocente
join grado g on ad.idGrado=g.idGrado
join seccion s on ad.idSeccion=s.idSeccion
join tipogrado tg on c.idtipogrado=tg.idTipo
join anioescolar ae on ad.idAnioEscolar=ae.idAnioEscolar
where ad.idDocente='$idDoc';";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function verUnCursoAsignado($consulta) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $sql = "SELECT * FROM asigdocente ad
join cursos c on ad.idCursos=c.idCursos
join docente d on ad.idDocente=d.idDocente
join grado g on ad.idGrado=g.idGrado
join seccion s on ad.idSeccion=s.idSeccion
join tipogrado tg on c.idtipogrado=tg.idTipo
join anioescolar ae on ad.idAnioEscolar=ae.idAnioEscolar
where ad.idDocente='{$consulta['iddoc']}' and ad.idCursos='{$consulta['idcurso']}'and ad.idGrado='{$consulta['idgrado']}'and ad.idSeccion='{$consulta['idseccion']}'and ad.idAnioEscolar='{$consulta['idanio']}';";
        // echo $sql;   
        $respuesta = $bd->query($sql);
        $dato = mysqli_fetch_array($respuesta);
        $datos[] = array_map('utf8_encode', $dato);
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function asignarCurso($iddoc, $idcurso, $idgrado, $idsecc, $idanio) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "INSERT INTO `asigdocente`
(`idDocente`,
`idCursos`,
`idGrado`,
`idSeccion`,
`idAnioEscolar`,
`est`)
VALUES
($iddoc,$idcurso,$idgrado,$idsecc,$idanio,1);
";
        if ($bd->query($consulta)) {
            $resp = "CURSO ASIGNADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

    function quitar($iddoc, $idcurso, $idgrado, $idsecc, $idanio) {

        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "DELETE FROM `asigdocente` WHERE (`idDocente` = '$iddoc') and (`idCursos` = '$idcurso') and (`idGrado` = '$idgrado') and (`idSeccion` = '$idsecc') and (`idAnioEscolar` = '$idanio');;
";
        if ($bd->query($consulta)) {
            $resp = "CURSO QUITADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        return $resp;
    }

}
