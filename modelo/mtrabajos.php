<?php

class trabajos {

    function crearTrabajo($modelo) {

        $metodos = new metodos();
        $ext = '0';
        $url = '../img/trabajos/';
        if (isset($modelo['archivo'])) {
            if ($modelo['archivo']['name'] != null && $modelo['archivo']['size'] > 0 && $modelo['varchivo'] != null) {
                $archivo = new SplFileInfo($modelo['archivo']['name']);
                $ext = $archivo->getExtension();
            }
        }
        $sql = "INSERT INTO `trabajos`
(`iddocente`,
`idcurso`,
`idgrado`,
`idseccion`,
`idanioescolar`,
`descrTrab`,
`fecha`,
`idActividad`,
`ext`,
`est`)
VALUES
('{$modelo['idDocente']}',
'{$modelo['idCursos']}',
'{$modelo['idGrado']}',
'{$modelo['idSeccion']}',
'{$modelo['idAnioEscolar']}',
'{$modelo['descripcion']}',
'{$modelo['fecha']}',
'{$modelo['idActividad']}',
'$ext',

'1');
";
        $respuesta = $metodos->ejecutar($sql, "TRABAJO CREADO CORRECTAMENTE");
        if (isset($modelo['archivo'])) {
            $destino = $url . $this->ultimoTrabajo()[0] . '.' . $ext;
            move_uploaded_file($modelo['archivo']['tmp_name'], $destino);
        }
        //  echo $sql;
        return $this->ultimoTrabajo()[0];
    }

    function EditarTrabajo($modelo) {

        $metodos = new metodos();
        $url = '../img/trabajos/';
        if (isset($modelo['archivo'])) {
            if ($modelo['archivo']['name'] != null && $modelo['archivo']['size'] > 0 && $modelo['varchivo'] != null) {
                $archivo = new SplFileInfo($modelo['archivo']['name']);
                $modelo['ext'] = $archivo->getExtension();
                $destino = $url . $modelo['idtrabajos'] . '.' . $modelo['ext'];
                move_uploaded_file($modelo['archivo']['tmp_name'], $destino);
            }
        }
        $sql = "UPDATE `trabajos` SET "
                . "`iddocente` = '{$modelo['iddocente']}', `idcurso` = '{$modelo['idcurso']}', "
                . "`idgrado` = '{$modelo['idGrado']}', `idseccion` = '{$modelo['idseccion']}', "
                . "`idanioescolar` = '{$modelo['idanioescolar']}', `descrTrab` = '{$modelo['descrTrab']}',"
                . " `fecha` = '{$modelo['fecha']}', `ext` = '{$modelo['ext']}' , `idActividad` = '{$modelo['idActividad']}'"
                . "WHERE (`idtrabajos` = '{$modelo['idtrabajos']}');";
        echo $sql;
        $respuesta = $metodos->ejecutar($sql, "TRABAJO CREADO CORRECTAMENTE");

        //  echo $sql;
        return $respuesta;
    }

    function crearParticipante($id, $alumno) {
        $metodos = new metodos();
        $sql = "INSERT INTO `trabajoalumno`
(`idtrabajo`,`idMat`) 
VALUES
('$id','$alumno');";
        $metodos->ejecutar($sql, "PARTICIPANTE CREADO CORRECTAMENTE");
    }

    function crearEnlaces($id, $enlace) {
        $metodos = new metodos();
        $sql = "INSERT INTO `trabajoenlace`
(`idtrabajo`,
`descrEnlace`,
`enlace`)
VALUES
('$id',
'{$enlace['descrEnlace']}',
'{$enlace['Enlace']}');
";
        echo $sql;
        $metodos->ejecutar($sql, "ENLACE CREADO CORRECTAMENTE");
    }

    function quitarParticipante($id, $idmat) {
        $metodos = new metodos();
        $sql = "DELETE FROM `trabajoalumno` WHERE (`idtrabajo` = '$id') and (`idMat` = '$idmat');";
        return $metodos->ejecutar($sql, "PARTICIPANTE QUITADO CORRECTAMENTE");
    }

    function quitarEnlaces($id, $idenlace) {
        $metodos = new metodos();
        $sql = "DELETE FROM `trabajoenlace` WHERE (`idenlace` = '$idenlace') and (`idtrabajo` = '$id');";
        return $metodos->ejecutar($sql, "ENLACE ELIMINADO CORRECTAMENTE");
    }

    function modificarTrabajo($modelo) {
        $metodos = new metodos();
        $sql = "";

        return $metodos->ejecutar($sql, "TRABAJO MODIFICADO CORRECTAMENTE");
    }

    function buscarTrabajo($modelo) {
        $metodos = new metodos();
        $sql = "SELECT t.idtrabajos,t.ext,t.iddocente,concat(d.nomb,' ',d.apepa,' ',d.apema) as docente,c.descr as curso,g.descr as grado,s.descr as seccion,ae.descr as anio,t.descrTrab,t.fecha,e.descrEst,ac.idActividad, ac.descr as actidad FROM trabajos t
join docente d on t.iddocente=d.idDocente
join cursos c on t.idcurso=c.idCursos
join anioescolar ae on t.idanioescolar=ae.idAnioEscolar
join estados e on t.est=e.idestados
join grado g on t.idgrado=g.idGrado
join seccion s on t.idseccion=s.idSeccion 
join actividad ac on t.idActividad=ac.idActividad
where concat(d.nomb,d.apepa,d.apema,t.fecha,t.descrTrab)like '%{$modelo['descripcion']}%' and  
t.iddocente='{$modelo['idDocente']}'and  t.idcurso='{$modelo['idCursos']}'and"
                . " t.idgrado='{$modelo['idGrado']}'
 and  t.idseccion='{$modelo['idSeccion']}'and  t.idanioescolar='{$modelo['idAnioEscolar'] }' 
order by t.idtrabajos desc ;";
        //echo $sql;
        return $metodos->consultar($sql);
    }

    function buscarUnTrabajo($idtrabajo) {
        $metodos = new metodos();
        $sql = "SELECT t.idtrabajos,t.ext,t.iddocente,concat(d.nomb,' ',d.apepa,' ',d.apema) as docente,c.descr as curso,g.descr as grado,s.descr as seccion,ae.descr as anio,t.descrTrab,t.fecha,e.descrEst,t.idcurso,t.idGrado,t.idseccion,t.idanioescolar,
        ac.idActividad, ac.descr as actidad FROM trabajos t
        join docente d on t.iddocente=d.idDocente
join cursos c on t.idcurso=c.idCursos
join anioescolar ae on t.idanioescolar=ae.idAnioEscolar
join estados e on t.est=e.idestados
join grado g on t.idgrado=g.idGrado
join tipogrado tg on g.idtipo=tg.idTipo
join seccion s on t.idseccion=s.idSeccion 
join actividad ac on t.idActividad=ac.idActividad
where t.idtrabajos='$idtrabajo' order by t.idtrabajos desc ;";
        //echo $sql;
        return $metodos->consultar($sql);
    }

    function ultimoTrabajo() {
        $sql = "SELECT max(idtrabajos) FROM trabajos ;";
        $metodos = new metodos();
        return $metodos->consultarrep($sql);
    }

    function buscarPart($id) {
        $metodos = new metodos();
        $sql = "SELECT t.idtrabajo,t.idMat,concat(a.apepa,' ',a.apema,' ',a.nomb) as alumno FROM trabajoalumno t 
join matricula m on t.idMat=m.idMatricula
join alumnos a on m.dnialu=a.dni where t.idtrabajo='$id';";
        //echo $sql;
        return $metodos->consultar($sql);
    }

    function buscarEnlace($id) {
        $metodos = new metodos();
        $sql = "SELECT * FROM trabajoenlace where idtrabajo='$id';";
        //echo $sql;
        return $metodos->consultar($sql);
    }

    function verTrabajo($modelo) {
        $metodos = new metodos();
        $sql = "SELECT t.idtrabajos,t.ext,t.iddocente,concat(d.nomb,' ',d.apepa,' ',d.apema) as docente,c.descr as curso,g.descr as grado,s.descr as seccion,ae.descr as anio,t.descrTrab,t.fecha,e.descrEst ,tg.descr as nivel,
        ac.idActividad, ac.descr as actidad FROM trabajos t
        join docente d on t.iddocente=d.idDocente
join cursos c on t.idcurso=c.idCursos
join anioescolar ae on t.idanioescolar=ae.idAnioEscolar
join estados e on t.est=e.idestados
join grado g on t.idgrado=g.idGrado
join tipogrado tg on g.idtipo=tg.idTipo
join seccion s on t.idseccion=s.idSeccion 
join actividad ac on t.idActividad=ac.idActividad
where concat(d.nomb,d.apepa,d.apema,t.fecha,t.descrTrab)like '%{$modelo['busq']}%' ";
     if($modelo['idgrado']!='0'){
       $sql .="and t.idgrado='{$modelo['idgrado']}'";   
     }
      if($modelo['idseccion']!='0'){
       $sql .="and  t.idseccion='{$modelo['idseccion']}'";   
     }
      if($modelo['idanio']!='0'){
       $sql .="and  t.idanioescolar='{$modelo['idanio']}'";   
     }
     if($modelo['idActividad']!='0'){
        $sql .="and  t.idActividad='{$modelo['idActividad']}'";   
      }
      $sql .="order by t.idtrabajos desc ;";

//echo $sql;
        return $metodos->consultar($sql);
    }

}
