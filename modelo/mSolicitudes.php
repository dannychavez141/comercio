<?php

class mSolicitudes {

    function vertodos() {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT * FROM socilitudretiro  where idest=1 order by idsocilitudRetiro desc limit 20";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }

    function verUno($id) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT * FROM socilitudretiro  where idest=1 and idsocilitudRetiro='$id' order by idsocilitudRetiro desc limit 20";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }
  function verUnoAlumno($dniAlumno) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos = array();
        $consulta = "SELECT * FROM  socilitudretiro where dniAlum='$dniAlumno';";
        $respuesta = $bd->query($consulta);
        while ($dato = mysqli_fetch_array($respuesta)) {
            $datos[] = array_map('utf8_encode', $dato);
        }
        $datosAjax = json_encode($datos);
        return $datosAjax;
    }
    function registro($solicitud) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $sql = "INSERT INTO `socilitudretiro`"
                . " (`dniAlum`, `nombAlum`, `apepaAlum`, `apemaAlum`, `dniApo`, `nombApo`, `apepaApo`, `apemaApo`, `idgrado`, `idseccion`, `idtipoApoderado`, `celular`, `motivo`, `idest`) "
                . "VALUES "
                . "('{$solicitud['dniAlum']}', '{$solicitud['nombAlum']}', '{$solicitud['apepaAlum']}', '{$solicitud['apemaAlum']}', '{$solicitud['dniApo']}', '{$solicitud['nombApo']}', '{$solicitud['apepaApo']}', '{$solicitud['apemaApo']}', '{$solicitud['idgrado']}', '{$solicitud['idseccion']}', '{$solicitud['idtipoApoderado']}', '{$solicitud['celular']}', '{$solicitud['motivo']}', '1');";

      //  echo $sql;

        if ($bd->query($sql)) {
          $resp = "SOLICITUD REGISTRADA CORRECTAMENTE APENAS VEAMOS SU SOLICITUD NOS COMUNICAREMOS CON USTED";
          } else {
          $resp = mysqli_errno($bd);
          }
          echo $resp; 
    }

}
