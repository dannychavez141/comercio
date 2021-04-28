<?php
include_once'../control/conexion.php'; 
$idmat = $_POST['idmat'];
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT * FROM insidencias i 
join tipoinsidencia t on i.idtipoIns=t.idtipoInsidencia
join estados e on i.est=e.idestados where 
i.IdMat='$idmat' and concat(i.fecha,t.descr) like '%%' limit 20;";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
       
        $query = "SELECT * FROM insidencias i 
join tipoinsidencia t on i.idtipoIns=t.idtipoInsidencia
join estados e on i.est=e.idestados where 
i.IdMat='$idmat' and concat(i.fecha,t.descr) like '%$q%' limit 20;";

    }

    $resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>INCIDENCIA NRO</th>
                                 <th>TIPO</th>
                                <th>DESCRIPCION</th>
                                <th>CREADO POR</th>
                                <th>FECHA</th>
                                <th>VER FICHA</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              if ($fila[4]=='usuario') {
                 $sql = "SELECT * FROM usuario 
where idUsuario='$fila[5]';";

$generado='';
                                 $lista = $conn->query($sql);
                                while($user = $lista->fetch_array())
                               {
                                        $generado=$user[2].' '.$user[3].' '.$user[4]."(DIRECTOR)";
                               } 
              }else{$sql = "SELECT * FROM docente 
where idDocente='$fila[5]';";

$generado='';
                                 $lista = $conn->query($sql);
                                while($user = $lista->fetch_array())
                               {
                                        $generado=$user[2].' '.$user[3].' '.$user[4]."(DOCENTE)";
                               } }
            $salida.="<tr>
                        <td>".$fila[0]."</td>
                       <td>".$fila[9]."</td>
                       <td>".$fila[3]."'</td>
                       <td>".$generado."</td>
                        <td>".$fila[6]."</td>
                       <td><a href='pdfincidencia.php?cod=".$fila[0]."' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='modincidencia.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='50' height='50'></center></a></td></tr>";

        }
        $salida.="</tbody></table>
        ";
    }else{
        $salida.="NO SE REGISTRARON INCIDENCIAS PARA ESTE ALUMNO :(";
    }
    echo $salida;

    $conn->close();
?>