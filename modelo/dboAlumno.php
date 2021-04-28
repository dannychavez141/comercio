<?php

class dboAlumno {

    function verTodosAlumnos($clave) {
       
            $conexion = new cConexion();
            $bd = $conexion->getBd();
            $sql = "SELECT idAlumnos,dni,concat(nomb,' ',apepa,' ',apema) as alu,targeta FROM alumnos where est=1;";
            $rs = $bd->query($sql);
            while ($row = $rs->fetch_array()) {

                $alumnos[] = array_map('utf8_encode', $row);
            }
            $rs->close();
        
        return json_encode($alumnos);
    }
    function alumnosAll($bus) {
       
            $conexion = new cConexion();
            $bd = $conexion->getBd();
            $sql = "SELECT idAlumnos,dni,concat(nomb,' ',apepa,' ',apema) as alu,targeta,saldo,fnac FROM alumnos where est=1 and concat(dni,' ',nomb,' ',apepa,' ',apema) like '%$bus%';";
            //echo $sql;
            $rs = $bd->query($sql);
            while ($row = $rs->fetch_array()) {

                $alumnos[] = array_map('utf8_encode', $row);
            }
            $rs->close();
        
        return json_encode($alumnos);
    }
    function Uno($id) {
       
            $conexion = new cConexion();
            $bd = $conexion->getBd();
            $sql = "SELECT idAlumnos,dni,concat(nomb,' ',apepa,' ',apema) as alu,targeta,saldo,fnac FROM alumnos where idAlumnos = '$id';";
          //echo $sql;
            $rs = $bd->query($sql);
            while ($row = $rs->fetch_array()) {

                $alumnos[] = array_map('utf8_encode', $row);
            }
            $rs->close();
        
        return json_encode($alumnos);
    }
    function buscarRfid($id) {
        
            $conexion = new cConexion();
            $bd = $conexion->getBd();
            $sql = "SELECT idAlumnos,dni,concat(nomb,' ',apepa,' ',apema) as alu,targeta,saldo,fnac FROM alumnos where est=1 and targeta = '$id';";
            $rs = $bd->query($sql);
            while ($row = $rs->fetch_array()) {

                $alumnos[] = array_map('utf8_encode', $row);
            }
            $rs->close();
        
        return json_encode($alumnos);
    }

    function cambiarRfid($key, $rfid, $id) {
        if ($key == "acm1ptbt") {
            $conexion = new cConexion();
            $bd = $conexion->getBd();
            $sql = "UPDATE `alumnos` SET `targeta` = '$rfid' WHERE (`idAlumnos` = '$id');";
            if ($bd->query($sql)) {
                echo "TARJETA N°" . $rfid . " ASIGNADA CORRECTAMENTE";
            } else {
                echo "ERROR EN REGISTRO DE TARJETA" . $sql;
            }
            $bd->close();
        }
    }

    function ultimaMatriculadeAlumno($dnialu, $idanio) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $sql = "SELECT m.idMatricula FROM matricula m 
join alumnos a on m.dnialu=a.dni
where a.dni='$dnialu' and  m.idAnioEscolar='$idanio' order by m.idMatricula desc limit 1;";
        $rs = $bd->query($sql);
        $idmat = $rs->fetch_array();
        return $idmat[0];
    }
    function EstadoMatricula($dnialu, $idanio) {
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $datos= array();
        $sql = "SELECT * FROM matricula m 
join alumnos a on m.dnialu=a.dni
where a.dni='$dnialu' and  m.idAnioEscolar='$idanio' and m.est='1' order by m.idMatricula desc limit 1;";
       // echo $sql;
        $respuesta = $bd->query($sql);
         $dato = mysqli_fetch_array($respuesta);
         $datos[] = array_map('utf8_encode', $dato);
        return json_encode($datos);
    }

}
