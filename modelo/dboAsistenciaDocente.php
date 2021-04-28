<?php

class dboAsistenciaDocente {

    function verAsistenciaDocente($docente, $mes, $tipo, $anio) {
        if ($mes != 0) {
            $sql = "SELECT * FROM asistenciapersonal a
join docente d on a.iddocente=d.idDocente
join tipo_asistencia ta on a.idtipo = ta.idtipo_asistencia
join anioescolar ae on a.idanio=ae.idAnioEscolar
where d.iddocente='$docente' and month(a.fecha)='$mes' and a.idtipo='$tipo' and a.idanio='$anio' ;";
        } else {
            $sql = "SELECT * FROM asistenciapersonal a
join docente d on a.iddocente=d.idDocente
join tipo_asistencia ta on a.idtipo = ta.idtipo_asistencia
join anioescolar ae on a.idanio=ae.idAnioEscolar
where d.iddocente='$docente' and a.idtipo='$tipo' and a.idanio='$anio' ;";
        }
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $rs = $bd->query($sql);
        return $rs;
    }

    function verAsistenciaDocenteExcel($docente, $mes, $tipo, $anio) {
        if ($mes != 0) {
            $sql = "SELECT * FROM asistenciapersonal a
join docente d on a.iddocente=d.idDocente
join tipo_asistencia ta on a.idtipo = ta.idtipo_asistencia
join anioescolar ae on a.idanio=ae.idAnioEscolar
where d.iddocente='$docente' and month(a.fecha)='$mes' and a.idtipo='$tipo' and a.idanio='$anio' ;";
        } else {
            $sql = "SELECT * FROM asistenciapersonal a
join docente d on a.iddocente=d.idDocente
join tipo_asistencia ta on a.idtipo = ta.idtipo_asistencia
join anioescolar ae on a.idanio=ae.idAnioEscolar
where d.iddocente='$docente' and a.idtipo='$tipo' and a.idanio='$anio' ;";
        }
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $rs = $bd->query($sql);
        while ($asistencia = mysqli_fetch_array($rs)) {
            $asistencias[] = $asistencia;
        }
        return $asistencias;
    }

    function marcarAsistencia($id) {
       // echo $id;
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $historial = $this->buscarAsistencia($id);
        $dboanio = new dboanioescolar();
        $anio = $dboanio->ultimoanio();
        $dbodocente = new dbodocente();
        $docente = $dbodocente->verundocente($id);
        date_default_timezone_set('America/Lima');
        $fecha = date("Y-m-d");
        $hora = date("h:i:s");
        $msj = "BIENVENIDO";
        if ($historial == null) {
            $sql = "INSERT INTO `asistenciapersonal` (`iddocente`, `idtipo`, `idanio`, `fecha`, `hora`, `est`) "
                    . "VALUES ('$id', '1', '$anio[0]', '$fecha', '$hora', '1');";
        } else if ($historial[2] == 1) {
            $sql = "INSERT INTO `asistenciapersonal` (`iddocente`, `idtipo`, `idanio`, `fecha`, `hora`, `est`) "
                    . "VALUES ('$id', '2', '$anio[0]','$fecha', '$hora', '1');";
            $msj = "HASTA LUEGO";
        } else if ($historial[2] == 2) {
            $sql = "INSERT INTO `asistenciapersonal` (`iddocente`, `idtipo`, `idanio`, `fecha`, `hora`, `est`) "
                    . "VALUES ('$id', '1', '$anio[0]','$fecha', '$hora', '1');";
        }
        if ($bd->query($sql)) {
            //echo $msj . "-" . $docente[2];
            return $msj . "-" . $docente[2];
        } else {
            return mysqli_errno($bd);
        }
    }

    function buscarAsistencia($id) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $dia = date("Y-m-d");
        $sql = "SELECT * FROM asistenciapersonal a "
                . "join docente d on a.iddocente=d.idDocente "
                . "where a.iddocente='$id'and a.fecha='$dia' order by a.idasistenciaPersonal desc limit 1;";
        //echo $sql;
        $asistenciasbd = $bd->query($sql);
        if ($asistenciasbd->num_rows > 0) {
            $asistencia = mysqli_fetch_array($asistenciasbd);
        } else {
            $asistencia = null;
        }
        return $asistencia;
    }

}
