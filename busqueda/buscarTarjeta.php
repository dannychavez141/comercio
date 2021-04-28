<?php
  include_once'../control/conexion.php'; 

    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT m.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alu, a.ext,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
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
where  m.idAnioEscolar=(select max(iae.idAnioEscolar) from anioescolar iae where iae.est=1) and concat(a.dni,a.nomb,a.apepa,a.apema) like '%%' limit 20;";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT m.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alu, a.ext,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
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
where m.idAnioEscolar=(select max(iae.idAnioEscolar) from anioescolar iae where iae.est=1) and concat(a.dni,a.nomb,a.apepa,a.apema) like '%$q%' limit 20;";
    }

    $resultado = $conn->query($query);


    if ($resultado->num_rows>0) {
       

        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>DNI</th>
                                <th>DATOS ALUMNO</th>
                                <th>GRADO Y SECCION</th>
                                <th>DATOS APODERADO</th>
                                <th>FOTOGRAFIA</th>
                                <th> IMPRIMIR TARJETA</th>
                                 <th>ASIGNAR O CAMBIAR TARJETA</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              if ($fila[3]=='0') {
               $salida.="<tr>
                        <td>".$fila[1]."</td>
                        <td>".$fila[2]."</td>
                       <td>".$fila[11]." ".$fila[13]." (".$fila[7]."-".$fila[9].")</td>
                    <td>".$fila[5]."</td>
                        <td>"."<center><img src='img/noimage.png' width='100' height='100'></center>"."</td>
                        <td><a href='pdftarjeta.php?cod=".$fila[0]."' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='regTarjeta.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='50' height='50'></center></a></td></tr>";
              }else{ $salida.="<tr>
                        <td>".$fila[1]."</td>
                        <td>".$fila[2]."</td>
                       <td>".$fila[11]." ".$fila[13]." (".$fila[7]."-".$fila[9].")</td>
                       <td>".$fila[5]."</td>
                        <td>"."<center><img src='img/alumnos/".$fila[1].".".$fila[3]."' width='100' height='100'></center>"."</td>
                        <td><a href='pdftarjeta.php?cod=".$fila[0]."' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='regTarjeta.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='50' height='50'></center></a></td></tr>";}

           

       
        }
        $salida.="</tbody></table>



        ";
    }else{
        $salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>