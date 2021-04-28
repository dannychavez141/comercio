<?php
include '../modelo/dbParticipante.php';
    $control=new dbparticipante();
    $salida = "";
    $q="";

    if (isset($_POST['consulta'])) {
        $q = $_POST['consulta'];
    }
    $resultado = $control->ver_participantes($q);
    if ($resultado->num_rows>0) {  
        $salida.="<table class='table table-striped ' border='1'>
                        <thead class='bg-warning'>
                            <tr>
                                <th>CODIGO</th>
                                <th>PARTICIPANTE</th>
                                <th>ESTADO</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>";
        while ($fila = $resultado->fetch_array()) {
              $salida.="<tr>
                        <td>".$fila[0]."</td>
                        <td>".$fila[1]."</td>
                        <td>".$fila[3]."</td>
                        <td><a href='modGrado.php?cod=".$fila[0]."' ><center><img src='img/edit.jpg' width='40' height='40'></center></a></td></tr>";

        }
        $salida.="</tbody></table> ";
    }else{
        $salida.="NO HAY SE REGISTRARON PARTICIPANTES";
    }
    echo $salida;


    
?>