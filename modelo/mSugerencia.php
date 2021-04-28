<?php

class mSugerencia {

    function registro($clase){
      $conexion = new cConexion();
        $bd = $conexion->getBd();
        $sql = "INSERT INTO `sugerencia`
(`dniUsuario`,`detalle`,`idtipoSug`,`fecha`,`hora`,`est`)VALUES
('{$clase['dni']}','{$clase['detalle']}','{$clase['idtipo']}','{$clase['fecha']}','{$clase['hora']}','1');";
      
//echo $sql;
     $bd->query($sql);
        
    }
}
