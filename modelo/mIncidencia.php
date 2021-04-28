<?php

class mIncidencia {
   function verIncidencia($idmat,$mes,$tipo){
        $conexion= new cConexion();
        $bd= $conexion->getBd();
        $anio= date('Y')-1;
         $datos= array();
        $sql="SELECT i.idinsidencias,a.dni,a.nomb,a.apepa,a.apema,SUBSTRING_INDEX(ti.descr, '-', 1) as tipo,SUBSTRING_INDEX(ti.descr, '-', -1) as descrTipo,i.fecha,concat(g.descr,' ',s.descr,' (',tg.descr,')') as grado ,ae.descr as anio 
            ,''as ndia ,i.descr as detalle,a.ext,ae.descr as anio  FROM insidencias i 
join matricula m on i.IdMat=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipoinsidencia ti on i.idtipoIns=ti.idtipoInsidencia
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
where i.est='1' and i.IdMat='$idmat'";
        if($tipo!='AMBOS'){
        $sql=$sql." and SUBSTRING_INDEX(ti.descr, '-', 1)='$tipo' ";
        }
        if($mes!='0'){
        $sql=$sql." and month(i.fecha)='$mes' ";
        }
        $sql=$sql." order by i.fecha desc;";
        //echo $sql;
        $rs=$bd->query($sql);         
   while ($row = $rs ->fetch_array()) {
$row['ndia']=($this->get_nombre_dia($row['fecha']));
                  $datos[]=array_map('utf8_encode',$row);

}  echo json_encode($datos);
        
        $bd -> close();
        
    }
    function get_nombre_dia($fecha){
   $fechats = strtotime($fecha); //pasamos a timestamp

//el parametro w en la funcion date indica que queremos el dia de la semana
//lo devuelve en numero 0 domingo, 1 lunes,....
switch (date('w', $fechats)){
    case 0: return "Domingo"; break;
    case 1: return "Lunes"; break;
    case 2: return "Martes"; break;
    case 3: return "Miercoles"; break;
    case 4: return "Jueves"; break;
    case 5: return "Viernes"; break;
    case 6: return "Sabado"; break;
}
}
}
