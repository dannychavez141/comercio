<?php

class dboApoderado {

    function datosApoderadosMatricula($anio) {
        $sql = "SELECT a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alumno,ap.dni,concat(ap.apema,' ',ap.apema,' ',ap.nomb) as apoderado ,ap.dir,ap.telf, concat(g.descr,' ',s.descr) as salon,tg.descr FROM matricula m
join alumnos a on m.dnialu=a.dni
join apoderado ap on a.dniapo=ap.dni
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
where m.idAnioEscolar=$anio and m.est=1";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $apoderadosbd = $bd->query($sql);
        $apoderados = array();
        while ($apoderado = mysqli_fetch_array($apoderadosbd)) {
            $apoderados[] = $apoderado;
        }
        return $apoderados;
    }

    function verApoderados($busq) {
        $sql = "SELECT idApoderado,dni, concat (nomb,' ',apepa,' ',apema) as datos,dir,telf FROM  apoderado where concat (nomb,' ',apepa,' ',apema) like '%$busq%';";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $rs = $bd->query($sql);
        while ($row = $rs->fetch_array()) {

            $datos[] = array_map('utf8_encode', $row);
        }
        $rs->close();

        return json_encode($datos);
    }

}
