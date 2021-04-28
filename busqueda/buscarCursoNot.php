<?php
include_once'../control/conexion.php'; 
    $anio = $_POST['anio'];
$grado = $_POST['grado'];
$secc = $_POST['secc'];
$peri = $_POST['peri'];
$tipo = $_POST['tipo'];
    $conn = $mysqli;
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

 $sql = "SELECT idTipo FROM grado where idGrado='$grado';";
 $tgrado=0;
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $tgrado=$datos[0];
                                        }


    $salida = "";

    $query = "SELECT * FROM cursos c join estados e on c.est=e.idestados 
join tipogrado t on c.idtipogrado=t.idTipo where c.idtipogrado='$tgrado' and concat(c.descr,t.descr) like '%%' limit 20;";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM cursos c join estados e on c.est=e.idestados 
join tipogrado t on c.idtipogrado=t.idTipo where c.idtipogrado='$tgrado' and concat(c.descr,t.descr) like '%$q%' limit 20;";
    }

    $resultado = $conn->query($query);

$periodo='';
if ($peri==1) {
    $periodo="PRIMER BIMESTRE";
   
}else if ($peri==2) {
    $periodo="SEGUNDO BIMESTRE";
    
}else if ($peri==3) {
    $periodo="TERCER BIMESTRE";
    
}else if ($peri==4) {
    $periodo="CUARTO BIMESTRE";
    
}else if ($peri==5) {
    $periodo="RECUPERACION";
    
}
    if ($resultado->num_rows>0) {
       

        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                        <tr>
                               <th colspan='4'>PERIODO SELECCIONADO:</th>
                                
                                <th colspan='3'align='center'>".$periodo."</th>
                            </tr>
                            <tr>
                                <th>CODIGO</th>
                                <th>NOMBRE DEL CURSO</th>
                                <th>NIVEL</th>
                                <th>VER NOTAS BIMESTRAL</th>
                                <th>VER NOTAS ANUAL</th>
                                <th>EDITAR NOTAS </th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($fila = $resultado->fetch_array()) {
              
if ($tipo==1) {
   

            $salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[1]."</td>
                        <td>".$fila[7]."</td>
                        <td><a href='./pdflistaalumnos.php?cur=".$fila[0]."&anio=".$anio."&grad=".$grado."&secc=".$secc."&peri=".$peri."' target='_blank' ><center><img src='../../img/print.jpg' width='40' height='40'></center></a></td>
                      <td><a href='./pdflistaalumnos.php?cur=".$fila[0]."&anio=".$anio."&grad=".$grado."&secc=".$secc."&peri=6' target='_blank' ><center><img src='../../img/print.jpg' width='40' height='40'></center></a></td>
                        <td><a href='regNotasPrim.php?cur=".$fila[0]."&&anio=".$anio."&&grad=".$grado."&&secc=".$secc."&&peri=".$peri."' ><center><img src='img/edit.jpg' width='40' height='40'></center></a></td></tr>";
}else{$salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[1]."</td>
                        <td>".$fila[7]."</td>
                        <td><a href='./pdflistaalumnos.php?cur=".$fila[0]."&anio=".$anio."&grad=".$grado."&secc=".$secc."&peri=".$peri."' target='_blank' ><center><img src='../../img/print.jpg' width='40' height='40'></center></a></td>
                        <td><a href='./pdflistaalumnos.php?cur=".$fila[0]."&anio=".$anio."&grad=".$grado."&secc=".$secc."&peri=6' target='_blank' ><center><img src='../../img/print.jpg' width='40' height='40'></center></a></td>
                        <td><a href='regNotasSec.php?cur=".$fila[0]."&&anio=".$anio."&&grad=".$grado."&&secc=".$secc."&&peri=".$peri."' ><center><img src='img/edit.jpg' width='40' height='40'></center></a></td></tr>";}
        }
        $salida.="</tbody></table>



        ";
    }else{
        $salida.="NO HAY CURSOS REGISTRADOS EN EL NIVEL EDUCATIVO :(";
    }


    echo $salida;

    $conn->close();



?>