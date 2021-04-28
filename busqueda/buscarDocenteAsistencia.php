<?php
include '../control/cConexion.php';
include '../modelo/dbodocente.php';

    $control=new dbodocente();
    $salida = "";
    $q="";

    if (isset($_POST['consulta'])) {
        $q = $_POST['consulta'];
    }
    $resultado = $control->VerTodosDocentes($q);
    if ($resultado->num_rows>0) {  
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                        <tr><th colspan='2'></th><th colspan='1'>IMPRIMIR EXCEL</th><th colspan='1'><a href='reporteAsistenciadocente.php' ><center><button type='buttom'><img src='img/print.jpg' width='40' height='40'></buttom></center></a></th></tr>
                        
                            <tr>
                                <th>DNI</th>
                                <th>DOCENTE 0 TRABAJADOR</th>
                                <th>ESTADO</th>
                                <th>VER ASISTENCIAS</th>
                            </tr>
                        </thead>
                        <tbody>";
        while ($fila = $resultado->fetch_array()) {
              $salida.="<tr>
                        <td>".$fila[1]."</td>
                        <td>".$fila[2]." ".$fila[3]." ".$fila[4]."</td>
                        <td>".$fila[19]."</td>
                        <td><a href='verAsistenciaDocente.php?cod=".$fila[0]."' ><center><button type='buttom'><img src='img/ver.jpg' width='40' height='40'></buttom></center></a></td></tr>";

        }
        $salida.="</tbody></table> ";
    }else{
        $salida.="NO SE REGISTRARON DOCENTES";
    }
    echo $salida;




