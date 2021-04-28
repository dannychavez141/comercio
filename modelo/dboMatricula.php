<?php

class dboMatricula {

    function vermatriculasactivas($anio) {
        $sql = "select m.idMatricula,tm.pencion from matricula m  
join tipomatricula tm on m.idtipomat=tm.idtipomatricula
where m.idAnioEscolar='" . $anio . "' and m.est=1;";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $matriculas = array();
        $matriculasdb = $bd->query($sql);
        while ($matricula = mysqli_fetch_array($matriculasdb)) {
            $matriculas[] = $matricula;
        }
        return $matriculas;
    }

    function repararMatriculas($dninuevo, $dni) {
        $sqlmatriculas = "UPDATE `matricula` SET `dnialu` = '$dninuevo' WHERE idMatricula!=0 and (`dnialu` = '$dni');";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $bd->query($sqlmatriculas);
        $sqlseguro="UPDATE `alumnoseguro` SET `dniAlum` = '$dninuevo' WHERE (`dniAlum` = '$dni');";
        $bd = $conexion->getBd();
        $bd->query($sqlseguro);
    }

    function crearnotas($tipo) {
        $sql = "SELECT * FROM matricula m
join grado g on m.idGrado=g.idGrado 
where g.idTipo='$tipo' ;";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $matriculas = array();
        $matriculasdb = $bd->query($sql);
        while ($matricula = mysqli_fetch_array($matriculasdb)) {
            $idmat = $matricula[0];
            $query = "SELECT * FROM cursos where idtipogrado=$tipo and est='1';";
            $resultado = $bd->query($query);
            while ($row = $resultado->fetch_array()) {
                $idcur = $row[0];
                echo "curso:" . $row[0] . "<br>";
                $query = "SELECT * FROM competencias where idcurso=$idcur";
                $resul = $bd->query($query);
                while ($row1 = $resul->fetch_array()) {
                    $idcom = $row1[0];

                    echo "competencia:" . $row1[0] . "<br>";
                    $sql = "INSERT INTO `notasalumno` (`idMatricula`, `idComp`, `nota1`, `nota2`, `nota3`, `nota4`) VALUES ('$idmat', '$idcom', '-1', '-1', '-1', '-1');";
                    echo $sql . "<br>";
                    $bd->query($sql);
                }
            }
        }
    }

    function listamatricula($idgrado, $idsecc, $idanio) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $matriculas = array();
        $sql = "SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst,
ea.descrEst as estalu,ap.telf,ap.idApoderado
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
join estados ea on a.est=ea.idestados
where m.idAnioEscolar='$idanio' and m.idGrado='$idgrado' and m.idSeccion='$idsecc' and m.est='1' order by a.apepa ";
        $matriculasbd = $bd->query($sql);
      //  echo $sql;
        while ($matricula = mysqli_fetch_array($matriculasbd)) {
             $matriculas[] = array_map('utf8_encode', $matricula);
            //$matriculas[] = $matricula;
        }
        return $matriculas;
    }
function buscarMatricula($busq,$idgrado, $idsecc, $idanio) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $matriculas = array();
        $sql = "SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst,
ea.descrEst as estalu,ap.telf,ap.idApoderado
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
join estados ea on a.est=ea.idestados
where m.idAnioEscolar='$idanio' and m.idGrado='$idgrado' and m.idSeccion='$idsecc'and concat(a.apepa,' ',a.apema,' ',a.nomb) like '%$busq%' and m.est='1' order by a.apepa ";
        $matriculasbd = $bd->query($sql);
        while ($matricula = mysqli_fetch_array($matriculasbd)) {
            $matriculas[] = $matricula;
        }
        return $matriculas;
    }
    function vertodasmatriculas($busqueda) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $matriculas = array();
        $sql = "SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where concat(a.apepa,a.apema,a.nomb,ap.nomb,ap.apepa,ap.apema) like '%$busqueda%' order by m.idMatricula desc";
        $matriculasbd = $bd->query($sql);
        while ($matricula = mysqli_fetch_array($matriculasbd)) {
            $matriculas[] = $matricula;
        }
        return $matriculas;
    }

    function verunamatriculas($id) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $matriculas = array();
        $sql = "SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,ap.dir,ap.telf,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr as anio,g.idGrado,g.descr as grado,s.idSeccion,s.descr as seccion,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where m.idMatricula='$id'";
        $matriculasbd = $bd->query($sql);
        $matricula = mysqli_fetch_array($matriculasbd);
        return $matricula;
    }

    

}
