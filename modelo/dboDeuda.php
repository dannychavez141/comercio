<?php

class dboDeuda {

    function verdeudasmat($idmat) {
        $mes = date('m');
        $an = date('Y');
        $sql = "SELECT YEAR(fecha),month(fecha) FROM deuda 
where idMatricula='$idmat' and YEAR(fecha)='$an' and month(fecha)='$mes'and idTipoDeuda='3';";
        $deudas = array();
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $deudasdb = $bd->query($sql);
        //echo $sql;
        while ($deuda = mysqli_fetch_array($deudasdb)) {
            $deudas[] = $deuda;
        }
        return $deudas;
    }

    function crearDeuda($idmat, $anio, $mes, $monto) {

        $vencimiento = $anio . "-" . $mes . "-15";
        $sql = "INSERT INTO `deuda` (`idMatricula`, `idTipoDeuda`, `fecha`, `hora`, `vencimiento`, `monto`, `interes`, `est`, `descr`)"
                . " VALUES ('$idmat','3',now(),now(),'$vencimiento',$monto,0,1,'Pencion " . $this->nombremes($mes) . " " . $anio . "');";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
      //  echo $sql;
        return $bd->query($sql);
    }

    function nombremes($mes) {
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        return $meses[$mes - 1];
    }

    function fechahoy() {
        $mes = date('m');
        $an = date('Y');
        $dia = date('d');
        $hoy = $an . "-" . $mes . "-" . $dia;
        return $hoy;
    }

    function verDeudasActivas() {
        $sql = "SELECT * FROM deuda where est='1';";
        $deudas = array();
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $deudasdb = $bd->query($sql);
      //  echo $sql;
        while ($deuda = mysqli_fetch_array($deudasdb)) {
            $deudas[] = $deuda;
        }
        return $deudas;
    }

    function diferenciadias($dia1, $dia2) {
        $datetime1 = new DateTime($dia1);
        $datetime2 = new DateTime($dia2);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%R%a');
    }
    function generarinteres($iddeuda,$dias){
         $conexion = new cConexion();
        $bd = $conexion->getBd();
        $interes=20;
        if ($dias>=1) {
            $interes=$interes+(3*($dias-1));
        }
        
        $sql = "UPDATE `deuda` SET `interes` = '$interes' WHERE (`idDeuda` = '$iddeuda');";
       
      //  echo $sql."<br>";
        return $bd->query($sql);
    }
 function verDeudas($idmat,$mes,$tipo){
        $conexion= new cConexion();
        $bd= $conexion->getBd();
        $anio= date('Y')-1;
         $datos= array();
        $sql="SELECT d.idDeuda,d.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.idTipoDeuda,td.TipoDeudacol,d.fecha,d.vencimiento,d.monto,d.interes, 
d.descr,concat(g.descr,' ',s.descr,' ',tg.descr) as grado, es.descrEst,a.ext
FROM deuda d
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado 
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados
where d.est='1' and m.idMatricula='$idmat'";
        if($tipo!='0'){
        $sql=$sql." and d.idTipoDeuda='$tipo' ";
        }
        if($mes!='0'){
        $sql=$sql." and month(d.fecha)='$mes' ";
        }
        $sql=$sql." order by d.fecha desc;";
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
