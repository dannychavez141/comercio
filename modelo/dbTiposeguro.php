<?php

class dbTiposeguro {

    function ver_tipos($bus) {
        $conexion = new cConexion();
        $sql = "SELECT * FROM tipo_seguro s
join estados e on s.est=e.idestados
where s.est=1 and s.descr like '%$bus%';";
        $con = $conexion->getBd();
        $tiposbd = $con->query($sql);
        while ($tipo = mysqli_fetch_array($tiposbd)) {
            $tipos[] = new mTiposeguro($tipo[0], $tipo[1], $tipo[2], $tipo[3]);
        }
        return $tipos;
    }

    function buscarAlumnoSeguro($dni) {
        $conexion = new cConexion();
        $sql = "SELECT * FROM alumnoseguro a 
join tipo_seguro t on a.idtiposeguro=t.idtipo_seguro 
where dniAlum='$dni';";
        $con = $conexion->getBd();
        $tiposbd = $con->query($sql);
        $tipos = new mseguroalumno("", "", "1", "AUN NO REGISTRADO", "");
        while ($tipo = mysqli_fetch_array($tiposbd)) {
            $tipos = new mseguroalumno($tipo[0],"", $tipo[1], $tipo[4], $tipo[2]);
        }
        return $tipos;
    }

}
