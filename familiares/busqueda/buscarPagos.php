<?php
 include_once'../control/conexion.php'; 
$anio = $_POST['anio'];
$dni = $_POST['dni'];
$mes = $_POST['mes'];
$dniapo = $_POST['dniapo'];
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT p.idpago,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema) as apo,d.idDeuda,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,p.fecha,d.vencimiento,d.monto,d.interes,p.recibido,p.vuelto ,
d.descr,g.descr,s.descr,tg.descr, es.descrEst,tp.descr,p.trecibo,if(p.trecibo=1,'BOLETA DE VENTA','FACTURA') AS tiporecibo
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
where a.dniapo=$dniapo and a.dni='$dni' and m.idAnioEscolar='$anio' 
and month(p.fecha)='$mes' and p.est='1' order by p.idpago";
if ($mes==0) {
 $query = "SELECT p.idpago,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema) as apo,d.idDeuda,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,p.fecha,d.vencimiento,d.monto,d.interes,p.recibido,p.vuelto ,
d.descr,g.descr,s.descr,tg.descr, es.descrEst,tp.descr,p.trecibo,if(p.trecibo=1,'BOLETA DE VENTA','FACTURA') AS tiporecibo,p.numero
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
join tipopago tp on p.idtipopago=tp.idtipopago where a.dniapo=$dniapo and a.dni='$dni' and m.idAnioEscolar='$anio' and p.est='1' order by p.idpago";
} 
if ($dni==0) {
 $query = "SELECT p.idpago,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema) as apo,d.idDeuda,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,p.fecha,d.vencimiento,d.monto,d.interes,p.recibido,p.vuelto ,
d.descr,g.descr,s.descr,tg.descr, es.descrEst,tp.descr,p.trecibo,if(p.trecibo=1,'BOLETA DE VENTA','FACTURA') AS tiporecibo,p.numero
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
where a.dniapo=$dniapo and m.idAnioEscolar='$anio' 
and month(p.fecha)='$mes' and p.est='1' order by p.idpago";
} 
if ($dni==0 && $mes==0) {
 $query = "SELECT p.idpago,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema) as apo,d.idDeuda,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,p.fecha,d.vencimiento,d.monto,d.interes,p.recibido,p.vuelto ,
d.descr,g.descr,s.descr,tg.descr, es.descrEst,tp.descr,p.trecibo,if(p.trecibo=1,'BOLETA DE VENTA','FACTURA') AS tiporecibo,p.numero
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
where a.dniapo=$dniapo  and m.idAnioEscolar='$anio' and p.est='1' order by p.idpago";
} 


$resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                               <th>N°</th>
                                <th>REALIZADO POR</th>
                                 <th>DESCRIPCION</th>
                                 <th>METODO DE PAGO/TIPO DE COMPROBANTE</th>
                                <th>FECHA PAGADA</th>
                                <th>MONTO S/.</th>
                                <th>DETALLES</th>
                                <th>VER RECIBO</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
            $salida.="<tr>
                        <td>".$fila[21]."</td>
                        <td>".$fila[1]." / ".$fila[2]."</td>
                        <td>".$fila[13]." / ".$fila[4]." - ".$fila[5]."</td>
                       <td>". $fila[18]."/".$fila[20]."</td>
                        <td>".$fila[7]."</td>
                         <td> S/.".number_format(($fila[9]+$fila[10]),2)."</td>
                       <td>                     
<button type='button' class='btn btn-outline-primary block btn-lg' data-toggle='modal' data-target='#iconModal'
onclick=detalles('".$fila[0]."','".$fila[3]."','".$fila[4]."-".str_replace(" ", "_", $fila[5])."','".$fila[1]."-".str_replace(" ", "_", $fila[2])."','".str_replace(" ", "_", $fila[18])."',".$fila[9].",".$fila[10].",'".$fila[7]."','".str_replace(" ", "_", $fila[13])."','".$fila[11]."','".$fila[12]."','".$fila[0]."')>
                    <center><img src='../img/detalle.jpg' width='40' height='40'></center>
                  </button>
                       </td>
                       <td><a href='../pdfpago.php?cod=".sha1($fila[0])."' target='_blank' ><center><img src='../img/print.jpg' width='40' height='40'></center></a></td></tr>"; 
        }
        $salida.="</tbody></table>
        ";
    }else{
        $salida.="USTED NO POSEE PAGOS REALIZADOS :C";
    }
    echo $salida;
    $conn->close();



?>