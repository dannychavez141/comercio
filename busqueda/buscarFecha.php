<?php
include_once'../control/conexion.php'; 
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT * FROM calendario c 
join estados e on c.est=e.idestados
where c.descr like '%%' limit 20;";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM calendario c 
join estados e on c.est=e.idestados
where c.descr like '%$q%' limit 20;";
    }

    $resultado = $conn->query($query);


    if ($resultado->num_rows>0) {
       

        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>DIA</th>
                                <th>MES</th>
                                <th>CELEBRACION</th>
                                <th>ESTADO</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              
switch ($fila[3]) {
        case '1':
        $mes='ENERO';
        break;
        case '2':
        $mes='FEBRERO';
        break;
        case '3':
        $mes='MARZO';
        break;
        case '4':
        $mes='ABRIL';
        break;
        case '5':
        $mes='MAYO';
        break;
        case '6':
        $mes='JUNIO';
        break;
        case '7':
        $mes='JULIO';
        break;
        case '8':
        $mes='AGOSTO';
        break;
        case '9':
        $mes='SEPTIEMBRE';
        break;
        case '10':
        $mes='OCTUBRE';
        break;
        case '11':
        $mes='NOVIEMBRE';
        break;
        case '12':
        $mes='DICIEMBRE';
        break;

    
    default:
        # code...
        break;
}
            $salida.="<tr>
                        <td>".$fila[2]."</td>
                        <td>".$mes."</td>
                        <td>".$fila[1]."</td>
                       <td>".$fila[7]."</td>
                        <td><a href='modfecha.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='40' height='40'></center></a></td></tr>";

        }
        $salida.="</tbody></table>



        ";
    }else{
        $salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>