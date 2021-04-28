<?php


class mficha {

    function vervarios($modelo) {
        
    }
    function verunaFicha($id){
     
        $sql="SELECT f.idfichacontrol,d.idDocente,d.nomb,d.apepa,d.apema,g.idGrado,g.descr as  grado,
tg.idTipo,tg.descr as nivel,s.idSeccion,s.descr as seccion,ae.idAnioEscolar,ae.descr as anio,
f.nsesion,f.nsemana,f.fecha ,c.idCursos,c.descr as curso
FROM fichacontrol f
join docente d on f.iddocente=d.idDocente
join grado g on f.idgrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on f.idseccion=s.idSeccion
join anioescolar ae on f.idanio=ae.idAnioEscolar
join cursos c on f.idCurso=c.idCursos  where 
f.idfichacontrol='$id' order by f.idfichacontrol desc;";
      
      //echo $sql;
        return $this->consultarrep($sql);  
    }
    function verFicha($modelo) {
      if($modelo['chek']=='true'){
        $sql="SELECT f.idfichacontrol,d.idDocente,d.nomb,d.apepa,d.apema,g.idGrado,g.descr as  grado,
tg.idTipo,tg.descr as nivel,s.idSeccion,s.descr as seccion,ae.idAnioEscolar,ae.descr as anio,
f.nsesion,f.nsemana,f.fecha ,c.idCursos,c.descr as curso
FROM fichacontrol f
join docente d on f.iddocente=d.idDocente
join grado g on f.idgrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on f.idseccion=s.idSeccion
join anioescolar ae on f.idanio=ae.idAnioEscolar
join cursos c on f.idCurso=c.idCursos  where 
d.idDocente='{$modelo['iddoc']}'";
      }else{
         $sql="SELECT f.idfichacontrol,d.idDocente,d.nomb,d.apepa,d.apema,g.idGrado,g.descr as  grado,
tg.idTipo,tg.descr as nivel,s.idSeccion,s.descr as seccion,ae.idAnioEscolar,ae.descr as anio,
f.nsesion,f.nsemana,f.fecha ,c.idCursos,c.descr as curso
FROM fichacontrol f
join docente d on f.iddocente=d.idDocente
join grado g on f.idgrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on f.idseccion=s.idSeccion
join anioescolar ae on f.idanio=ae.idAnioEscolar
join cursos c on f.idCurso=c.idCursos  where 
      d.idDocente='{$modelo['iddoc']}' and f.fecha='{$modelo['fec']}' "; 
      
      if($modelo['idcur']!='-1'){
        $sql .="and c.idCursos='{$modelo['idcur']}'";  
      }
      
      
      
      
      
      }
       $sql .=" order by f.idfichacontrol desc";
      //echo $sql;
        return $this->consultar($sql);
    }
    function verFichaComp($id) {
        $sql="SELECT f.idficha,c.idComp, CONVERT(CAST(CONVERT(c.descr USING latin1) AS BINARY) USING utf8)as competencia FROM fichacompetencia f
join competencias c on f.idcompetencia=c.idComp  where 
f.idficha='$id';";
      
      //echo $sql;
        return $this->consultar($sql);  
    }
    function verFichaAlum($id) {
        $sql="SELECT * FROM fichamatriculados f 
join matricula m on f.idmatricula=m.idmatricula
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni where 
f.idficha='$id' order by a.apepa;";
      
      //echo $sql;
        return $this->consultar($sql);  
    }
    function buscarAlumno($idFicha,$idMat) {
        $sql="SELECT * FROM fichamatriculados f 
join matricula m on f.idmatricula=m.idmatricula
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni where 
f.idficha='$idFicha' and f.idmatricula='$idMat';";
      
      //echo $sql;
        return $this->consultar($sql);  
    }
     function verificar($idFicha,$idMat) {
        $sql="SELECT count(f.idficha) FROM fichamatriculados f 
join matricula m on f.idmatricula=m.idmatricula
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni where 
f.idficha='$idFicha' and f.idmatricula='$idMat';";
      
      //echo $sql;
        return $this->consultarrep($sql);  
    }

    function nuevo($modelo, $sesion, $semana, $fecha) {
        $sql = "INSERT INTO `fichacontrol`
(`iddocente`,`idgrado`,`idseccion`,`idCurso`,`idanio`,`nsesion`,`nsemana`,`fecha`)VALUES
('{$modelo['idDocente']}','{$modelo['idGrado']}','{$modelo['idSeccion']}','{$modelo['idCursos']}','{$modelo['idAnioEscolar']}','$sesion','$semana','$fecha');";
        echo $sql;
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        if ($bd->query($sql)) {
            $resp = "AGREGADO CORRECTAMENTE";
        } else {
            $resp = mysqli_errno($bd);
        }

        echo $resp;
    }

    function ultimaFicha() {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        //$datos = array();
        $consulta = "SELECT max(idfichacontrol) FROM fichacontrol;";
        $respuesta = $bd->query($consulta);
        $dato = mysqli_fetch_array($respuesta);
        return $dato[0];
    }

    function modificar($ficha,$alumnos) {
     $sql="UPDATE `fichacontrol`
SET
`nsesion` ='{$ficha['nsesion']}',
`nsemana` ='{$ficha['nsemana']}',
`fecha` = '{$ficha['fecha']}'
WHERE `idfichacontrol` = '{$ficha['idfichacontrol']}';";   
//print_r ($sql);
//$this->ejecutar($sql, "MODIFICADO CORRECTANTE");
foreach ($alumnos as $alumno) {
    $buscar= $this->verificar($ficha['idfichacontrol'], $alumno['idMatricula']);
     echo $buscar[0];
      if ($alumno['part']=='') {
                $alumno['part'] = '0';
            }
            if ($alumno['zoom']=='') {
                $alumno['zoom'] = '0';
            }
            if ($alumno['class']=='') {
                $alumno['class'] = '0';
            }
            if ($alumno['whapp']=='') {
                $alumno['whapp'] = '0';
            }
            if ($alumno['acti']=='') {
                $alumno['acti'] = '0';
            }
            if ($alumno['comAlu']=='') {
                $alumno['comAlu'] = '0';
            }
            if ($alumno['txtcomAlu']=='') {
                $alumno['txtcomAlu'] = '';
            }
            if ($alumno['comDoc']=='') {
                $alumno['comDoc'] = '0';
            }
            if ($alumno['txtcomDoc']=='') {
                $alumno['txtcomDoc'] = '';
            }
     if($buscar[0]=='0'){
     //-----------------------------------------------------------
   
            $sql = "INSERT INTO `fichamatriculados`
(`idficha`,`idmatricula`,`participacion`,`zoom`,`classroom`,`celular`,`actividad`,`chcmAlu`,`cmAlum`,`chcmDoc`,`cmDoc`)VALUES
('{$ficha['idfichacontrol']}','{$alumno['idMatricula']}','{$alumno['part']}','{$alumno['zoom']}','{$alumno['class']}','{$alumno['whapp']}',"
. "'{$alumno['acti']}','{$alumno['comAlu']}','{$alumno['txtcomAlu']}','{$alumno['comDoc']}','{$alumno['txtcomDoc']}');";
}else{
    $sql="UPDATE`fichamatriculados`
SET
`participacion` ='{$alumno['part']}',
`zoom` = '{$alumno['zoom']}',
`classroom` = '{$alumno['class']}',
`celular` = '{$alumno['whapp']}',
`actividad` = '{$alumno['acti']}',
`chcmAlu` = '{$alumno['comAlu']}',
`cmAlum` = '{$alumno['txtcomAlu']}',
`chcmDoc` = '{$alumno['comDoc']}',
`cmDoc` = '{$alumno['txtcomDoc']}'
WHERE `idficha` = '{$ficha['idfichacontrol']}' AND `idmatricula` = '{$alumno['idMatricula']}';
";
}
echo $sql;
         $this->ejecutar($sql, "CREADO CORRECTAMENTE");
            $sql2 = "UPDATE `apoderado` SET `telf` = '{$alumno['telf']}' WHERE (`idApoderado` = '{$alumno['idApoderado']}');";
            echo $sql2;
         $this->ejecutar($sql2, "ACTUALIZADO CORRECTAMENTE");
        }

}
  
    function eliminar($modelo) {
        
    }

    function agregarCompetencia($modelo) {
        $idFicha = $this->ultimaFicha();
        foreach ($modelo as $model) {
            $sql = "INSERT INTO `fichacompetencia`
(`idficha`,
`idcompetencia`)
VALUES
('$idFicha',
'{$model['idComp']}');
";
            echo $sql;
            $conexion = new cConexion();
            $bd = $conexion->getBd();
            if ($bd->query($sql)) {
                $resp = "AGREGADO CORRECTAMENTE";
            } else {
                $resp = mysqli_errno($bd);
            }
        }
    }

    function quitarcompetencia($modelo) {
        
    }

    function agregarMatriculado($modelo) {
        $idFicha = $this->ultimaFicha();
        foreach ($modelo as $model) {
            if (empty($model['part'])) {
                $model['part'] = '0';
            }
            if (empty($model['zoom'])) {
                $model['zoom'] = '0';
            }
            if (empty($model['class'])) {
                $model['class'] = '0';
            }
            if (empty($model['whapp'])) {
                $model['whapp'] = '0';
            }
            if (empty($model['acti'])) {
                $model['acti'] = '0';
            }
            if (empty($model['comAlu'])) {
                $model['comAlu'] = '0';
            }
            if (empty($model['txtcomAlu'])) {
                $model['txtcomAlu'] = '';
            }
            if (empty($model['comDoc'])) {
                $model['comDoc'] = '0';
            }
            if (empty($model['txtcomDoc'])) {
                $model['txtcomDoc'] = '';
            }

            $sql = "INSERT INTO `fichamatriculados`
(`idficha`,`idmatricula`,`participacion`,`zoom`,`classroom`,`celular`,`actividad`,`chcmAlu`,`cmAlum`,`chcmDoc`,`cmDoc`)VALUES
('$idFicha','{$model['idMatricula']}','{$model['part']}','{$model['zoom']}','{$model['class']}','{$model['whapp']}','{$model['acti']}','{$model['comAlu']}','{$model['txtcomAlu']}','{$model['comDoc']}','{$model['txtcomDoc']}');";

            $this->ejecutar($sql, "CREADO CORRECTAMENTE");
            $sql2 = "UPDATE `apoderado` SET `telf` = '{$model['telf']}' WHERE (`idApoderado` = '{$model['idApoderado']}');";
            $this->ejecutar($sql2, "ACTUALIZADO CORRECTAMENTE");
        }
    }

    function modificarmatriculado($modelo) {
        
    }

    function ejecutar($sql, $msj) {
        echo $sql;
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        if ($bd->query($sql)) {
            $resp = $msj;
        } else {
            $resp = mysqli_errno($bd);
        }
        return $resp;
    }

    function consultar($sql) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $respuesta = $bd->query($sql);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }
function consultarrep($sql) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $respuesta = $bd->query($sql);
       $dato = mysqli_fetch_array($respuesta);
        return $dato;
    }
}
