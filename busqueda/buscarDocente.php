<?php
  include_once'../control/conexion.php'; 

    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }
    $salida = "";
    $query = "SELECT * FROM docente d 
join sexo s on d.idsex=s.idsexo
join estados e on d.est=e.idestados
join cargo t on d.idtipo=t.idcargo
where concat(d.dni,d.apepa,d.apema,d.nomb) like '%%' and d.est='1' limit 20;";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM docente d 
join sexo s on d.idsex=s.idsexo
join estados e on d.est=e.idestados
join cargo t on d.idtipo=t.idcargo
where concat(d.dni,d.apepa,d.apema,d.nomb) like '%$q%' and d.est='1' limit 20;";
    }
    $resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                        <tr>
                                <th colspan='6'>LISTA DE DOCENTES REGISTRADOS</th>
                                <th><a href='pdfreportes/replistadocentes.php' target='_blank' >
                                   <button type='button' align='center'>IMPRIMIR LISTA</button>
                                   </a></th>
                            </tr>
                            <tr>
                                <th>DNI</th>
                                <th>APELLIDOS Y NOMBRES</th>
                                <th>CARGO EN LA INSTITUCION</th>
                                <th>DIRECCION / TELEFONO</th>
                                <th>FOTOGRAFIA</th>
                                <th>DETALLE</th>
                                 <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";
        while ($fila = $resultado->fetch_array()) {
              if ($fila[9]=='0') {
               $salida.="<tr>
                        <td>".$fila['dni']."</td>
                        <td>".$fila['apepa']." ".$fila['apema']." ".$fila['nomb']."</td>
                       <td>".$fila['descrCargo']." (".$fila['detalle'].")</td>
                        <td>".$fila['dir']."/".$fila['telf']."</td>
                        <td>"."<center><img src='img/noimage.png' width='100' height='100'></center>"."</td>
                        <td><a href='pdfdocente.php?cod=".$fila[0]."' target='_blank' class='btn btn-success' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='modDocente.php?cod=".$fila[0]."'class='btn btn-danger'   ><center><img src='img/edit.jpg' width='50' height='50'></center></a>"
                       . "<a class='btn btn-warning' href='zoomdocente.php?cod=".$fila[0]."' ><center><img src='img/zoomlogo.png' width='50' height='50'></center></a></td></td></tr>";
              }else{ $salida.="<tr>
                        <td>".$fila['dni']."</td>
                        <td>".$fila['apepa']." ".$fila['apema']." ".$fila['nomb']."</td>
                        <td>".$fila['descrCargo']."(".$fila['detalle'].")</td>
                    <td>".$fila['dir']."/".$fila['telf']."</td>
                        <td>"."<center><img src='img/docentes/".$fila[1].".".$fila[9]."' width='100' height='100'></center>"."</td>
                        <td><a href='pdfdocente.php?cod=".$fila[0]."' target='_blank' class='btn btn-success' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='modDocente.php?cod=".$fila[0]."'class='btn btn-danger'   ><center><img src='img/edit.jpg' width='50' height='50'></center></a>"
                       . "<a class='btn btn-warning' href='zoomdocente.php?cod=".$fila[0]."' ><center><img src='img/zoomlogo.png' width='50' height='50'></center></a></td></td></tr>";}
        }
        $salida.="</tbody></table>
        ";
    }else{
        $salida.="NO HAY DATOS :(";
    }
    echo $salida;
    $conn->close();
?>