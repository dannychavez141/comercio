<?php

class mAsistencia {
    function verAsistencias($idmat,$mes,$tipo){
        $conexion= new cConexion();
        $bd= $conexion->getBd();
        $anio= date('Y')-1;
         $datos= array();
        $sql="SELECT a.idasistencia,al.nomb,al.apepa,al.apema,a.fecha,a.hora,ta.descr,''as ndia,al.dni,al.ext FROM asistencia a
join matricula m on  a.idmat =m.idMatricula
join alumnos al on m.dnialu=al.dni
join tipo_asistencia ta on a.tipo=ta.idtipo_asistencia where a.idmat='$idmat' ";
        if($tipo!='0'){
        $sql=$sql."and a.tipo='$tipo' ";
        }
        if($mes!='0'){
        $sql=$sql."and month(a.fecha)='$mes' ";
        }
        $sql=$sql."order by concat(a.fecha,a.hora) desc;";
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
