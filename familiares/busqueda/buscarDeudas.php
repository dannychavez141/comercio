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

    $query = "SELECT d.idDeuda,d.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,d.fecha,d.vencimiento,d.monto, d.interes, 
d.descr,g.descr,s.descr,tg.descr, es.descrEst
FROM deuda d
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados 
where a.dniapo=$dniapo and a.dni='$dni' and m.idAnioEscolar='$anio' and month(d.fecha)='$mes' and d.est='1' order by d.idDeuda desc"
;
if ($mes==0) {
 $query = "SELECT d.idDeuda,d.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,d.fecha,d.vencimiento,d.monto, d.interes, 
d.descr,g.descr,s.descr,tg.descr, es.descrEst
FROM deuda d
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados
where a.dniapo=$dniapo and a.dni='$dni' and m.idAnioEscolar='$anio' and d.est='1' order by d.idDeuda desc";
} 
if ($dni==0) {
 $query = "SELECT d.idDeuda,d.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,d.fecha,d.vencimiento,d.monto, d.interes, 
d.descr,g.descr,s.descr,tg.descr, es.descrEst
FROM deuda d
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados 
where a.dniapo=$dniapo and m.idAnioEscolar='$anio' and month(d.fecha)='$mes' and d.est='1' order by d.idDeuda desc";
} 
if ($dni==0 && $mes==0) {
 $query = "SELECT d.idDeuda,d.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,d.fecha,d.vencimiento,d.monto, d.interes, 
d.descr,g.descr,s.descr,tg.descr, es.descrEst
FROM deuda d
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados 
where a.dniapo=$dniapo and  m.idAnioEscolar='$anio' and d.est='1' order by d.idDeuda desc";
} 


$resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>N°</th>
                                 <th>DNI</th>
                                <th>ALUMNO(A)</th>
                                 <th>TIPO</th>
                                <th>FECHA VENCIMIENTO</th>
                                <th>MONTO S/.</th>
                                <th>DETALLES</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
if ($fila[5]==1) {
    $tipo="ENTRADA";
} else{$tipo="SALIDA";}
            $salida.="<tr>
                       <td>".$fila[0]."</td>
                        <td>".$fila[2]."</td>
                        <td>".$fila[3]."</td>
                       <td>". $fila[4]."</td>
                        <td>".$fila[5]."</td>
                         <td> S/.".number_format(($fila[7]+$fila[8]),2)."</td>
                       <td>
                       <button type='button' class='btn btn-outline-primary block btn-lg' data-toggle='modal' data-target='#iconModal'
onclick=detalles('".$fila[0]."','".$fila[2]."-".str_replace(" ", "_", $fila[3])."','".$fila[4]."',".$fila[7].",".$fila[8].",'".$fila[5]."','".$fila[6]."','".str_replace(" ", "_", $fila[9])."',".$fila[1].")>
                    <center><img src='../img/detalle.jpg' width='40' height='40'></center>
                  </button>
                       </td>
                       </tr>";
        }
        $salida.="</tbody></table>
        ";
    }else{
        $salida.="FELICITACIONES USTED NO TIENE DEUDAS PENDIENTES :) <3";
    }
    echo $salida;
    $conn->close();



?>