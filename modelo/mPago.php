<?php

class mPago {
   function verPagos($idmat,$mes,$tipo){
        $conexion= new cConexion();
        $bd= $conexion->getBd();
        $anio= date('Y')-1;
         $datos= array();
        $sql="SELECT p.idpago,ap.dni as dniapo,concat(ap.nomb,' ',ap.apepa,' ',ap.apema) as apo,d.idDeuda,a.dni as dnialu,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,p.fecha,d.vencimiento,d.monto,d.interes,p.recibido,p.vuelto ,
d.descr as detalle,concat(g.descr,' ',s.descr,' ',tg.descr) as grado, es.descrEst,tp.descr as tipor,p.trecibo,if(p.trecibo=1,'BOLETA DE VENTA','FACTURA') AS tiporecibo,p.numero,'' as ndia,a.ext
FROM pago p
join deuda d on p.idDeuda=d.idDeuda
join apoderado ap on p.idApo=ap.idApoderado
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado 
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados
join tipopago tp on p.idtipopago=tp.idtipopago
where p.est='1' and m.idMatricula='$idmat'";
        if($tipo!='0'){
        $sql=$sql." and d.idTipoDeuda='$tipo' ";
        }
        if($mes!='0'){
        $sql=$sql." and month(p.fecha)='$mes' ";
        }
        $sql=$sql." order by p.fecha desc;";
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
