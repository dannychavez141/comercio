<?php
include_once'../control/conexion.php'; 
$anio = $_POST['anio'];
$grado = $_POST['grado'];
$secc = $_POST['secc'];
$fecha = $_POST['fecha'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];

    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

     $query = "SELECT d.idDeuda,d.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,d.fecha,d.vencimiento,d.monto,d.interes, 
d.descr,g.descr,s.descr,tg.descr, es.descrEst
FROM deuda d
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado 
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados
where g.idGrado='$grado ' and s.idSeccion='$secc' and month(d.fecha)='$fecha' and td.idTipoDeuda='$tipo' and m.idAnioEscolar='$anio' and d.est=$estado
and concat(a.nomb,a.apepa,a.apema) like '%%' limit 20;";

if ($fecha==0) {
  $query = "SELECT d.idDeuda,d.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,d.fecha,d.vencimiento,d.monto,d.interes, 
d.descr,g.descr,s.descr,tg.descr, es.descrEst
FROM deuda d
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado 
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados
where g.idGrado='$grado ' and s.idSeccion='$secc' and td.idTipoDeuda='$tipo' and m.idAnioEscolar='$anio' and d.est=$estado
and concat(a.nomb,a.apepa,a.apema) like '%%' limit 20;";
}
    if (isset($_POST['consulta']) ) {
        $q = $conn->real_escape_string($_POST['consulta']);
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
where g.idGrado='$grado ' and s.idSeccion='$secc' and month(d.fecha)='$fecha' and td.idTipoDeuda='$tipo' and m.idAnioEscolar='$anio' and d.est=$estado
and concat(a.nomb,a.apepa,a.apema) like '%$q%' limit 20;";
    if ($fecha==0) {
        $q = $conn->real_escape_string($_POST['consulta']);
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
where g.idGrado='$grado ' and s.idSeccion='$secc' and td.idTipoDeuda='$tipo' and m.idAnioEscolar='$anio' and d.est=$estado
and concat(a.nomb,a.apepa,a.apema) like '%$q%' limit 20;";
    

    } 

    }
   

    $resultado = $conn->query($query);


    if ($resultado->num_rows>0) {
       

        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                        <tr align='center'>
                               <th colspan='6'>DEUDAS PENDIENTES REGISTRADAS</th>
                                
                                <th colspan='2'align='center'> ACCIONES  <a href='pdflistadeudas.php?anio=".$anio."&grado=".$grado."&secc=".$secc."' target='_blank' ><button type='button' align='center'>IMPRIMIR LISTA</button></a></th>
                            </tr>
                            <tr>
                                <th>N°</th>
                                 <th>DNI</th>
                                <th>ALUMNO(A)</th>
                                 <th>TIPO</th>
                                <th>FECHA VENCIMIENTO</th>
                                <th>MONTO S/.</th>
                                <th>DETALLES</th>
                                <th>PAGAR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              
if ($estado==1) {
 

            $salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[2]."</td>
                        <td>".$fila[3]."</td>
                       <td>". $fila[4]."</td>
                        <td>".$fila[5]."</td>
                         <td> S/.".number_format(($fila[7]+$fila[8]),2)."</td>
                       <td>
                     
<button type='button' class='btn btn-outline-primary block btn-lg' data-toggle='modal' data-target='#iconModal'
onclick=detalles('".$fila[0]."','".$fila[2]."-".str_replace(" ", "_", $fila[3])."','".$fila[4]."',".$fila[7].",".$fila[8].",'".$fila[5]."','".$fila[6]."','".str_replace(" ", "_", $fila[9])."',".$estado.")>
                    <center><img src='img/detalle.jpg' width='40' height='40'></center>
                  </button>



                       </td>
                       <td><a href='pagar.php?cod=".$fila[0]."' ><center><img src='img/pago.jpg' width='40' height='40'></center></a></td></tr>";


       
 }else{$salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[2]."</td>
                        <td>".$fila[3]."</td>
                       <td>". $fila[4]."</td>
                        <td>".$fila[5]."</td>
                         <td> S/.".number_format(($fila[7]+$fila[8]),2)."</td>
                       <td>
                     
<button type='button' class='btn btn-outline-primary block btn-lg' data-toggle='modal' data-target='#iconModal'
onclick=detalles('".$fila[0]."','".$fila[2]."-".str_replace(" ", "_", $fila[3])."','".$fila[4]."',".$fila[7].",".$fila[8].",'".$fila[5]."','".$fila[6]."','".str_replace(" ", "_", $fila[9])."',".$estado.")>
                    <center><img src='img/detalle.jpg' width='40' height='40'></center>
                  </button>



                       </td>
                       <td><center><img src='img/bloqueado.png' width='40' height='40'></center></td></tr>";}
        }
        $salida.="</tbody></table>";

    }else{
        $salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>