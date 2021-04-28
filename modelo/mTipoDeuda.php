<?php

class mTipoDeuda {
 function verDeudas(){
        $conexion= new cConexion();
        $bd= $conexion->getBd();
         $datos= array();
        $sql="SELECT * FROM tipodeuda;";
        $rs=$bd->query($sql);         
   while ($row = $rs ->fetch_array()) {
                  $datos[]=array_map('utf8_encode',$row);

}  echo json_encode($datos);
        
        $bd -> close();
        
    }
}
