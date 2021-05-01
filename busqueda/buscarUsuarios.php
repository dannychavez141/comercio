<?php
  include_once'../control/conexion.php'; 

    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }
    $salida = "";
    $query = "SELECT * FROM usuario d 
join sexo s on d.idsex=s.idsexo
join estados e on d.est=e.idestados
join tipousuario t on d.idTipoUsuario=t.idTipoUsuario
where concat(d.dni,d.apepa,d.apema,d.nomb) like '%%' limit 20;";
    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM usuario d 
join sexo s on d.idsex=s.idsexo
join estados e on d.est=e.idestados
join tipousuario t on d.idTipoUsuario=t.idTipoUsuario
where concat(d.dni,d.apepa,d.apema,d.nomb) like '%$q%' limit 20;";
    }
    $resultado = $conn->query($query);
    if ($resultado->num_rows>0) {
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-blue'>
                            <tr>
                                <th>DNI</th>
                                <th>APELLIDOS Y NOMBRES</th>
                                <th>TIPO USUARIO</th>
                                <th>DIRECCION / TELEFONO</th>
                                <th>FOTOGRAFIA</th>
                                <th>DETALLE</th>
                                 <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              if ($fila[10]=='0') {
               $salida.="<tr>
                        <td>".$fila[1]."</td>
                        <td>".$fila[3]." ".$fila[4]." ".$fila[2]."</td>
                       <td>".$fila[19]."</td>
                        <td>".$fila[7]."/".$fila[6]."</td>
                        <td>"."<center><img src='img/noimage.png' width='100' height='100'></center>"."</td>
                        <td><a href='pdfusuario.php?cod=".$fila[0]."' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='modUsuario.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='50' height='50'></center></a></td></tr>";
              }else{ $salida.="<tr>
                        <td>".$fila[1]."</td>
                        <td>".$fila[3]." ".$fila[4]." ".$fila[2]."</td>
                        <td>".$fila[19]."</td>
                    <td>".$fila[7]."/".$fila[6]."</td>
                        <td>"."<center><img src='img/usuarios/".$fila[1].".".$fila[10]."' width='100' height='100'></center>"."</td>
                        <td><a href='pdfusuario.php?cod=".$fila[0]."' target='_blank' ><center><img src='img/print.jpg' width='50' height='50'></center></a></td>
                        <td><a href='modUsuario.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='50' height='50'></center></a></td></tr>";}
        }
        $salida.="</tbody></table>
";
    }else{
        $salida.="NO HAY DATOS :(";
    }
    echo $salida;
    $conn->close();



?>