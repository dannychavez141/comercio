<?php

class dboDeuda {

    function verdeudasmat($idmat) {
        $mes = date('m');
        $an = date('Y');
        $sql = "SELECT YEAR(fecha),month(fecha) FROM deuda 
where idMatricula='$idmat' and YEAR(fecha)='$an' and month(fecha)='$mes'and idTipoDeuda='3';";
        $deudas = array();
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $deudasdb = $bd->query($sql);
        //echo $sql;
        while ($deuda = mysqli_fetch_array($deudasdb)) {
            $deudas[] = $deuda;
        }
        return $deudas;
    }

    function crearDeuda($idmat, $anio, $mes, $monto) {

        $vencimiento = $anio . "-" . $mes . "-15";
        $sql = "INSERT INTO `deuda` (`idMatricula`, `idTipoDeuda`, `fecha`, `hora`, `vencimiento`, `monto`, `interes`, `est`, `descr`)"
                . " VALUES ('$idmat','3',now(),now(),'$vencimiento',$monto,0,1,'Pencion " . $this->nombremes($mes) . " " . $anio . "');";
        $conexion = new cConexion();
        $bd = $conexion->getBd();
      //  echo $sql;
        return $bd->query($sql);
    }

    function nombremes($mes) {
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        return $meses[$mes - 1];
    }

    function fechahoy() {
        $mes = date('m');
        $an = date('Y');
        $dia = date('d');
        $hoy = $an . "-" . $mes . "-" . $dia;
        return $hoy;
    }

    function verDeudasActivas() {
        $sql = "SELECT * FROM deuda where est='1';";
        $deudas = array();
        $conexion = new cConexion();
        $bd = $conexion->getBd();
        $deudasdb = $bd->query($sql);
      //  echo $sql;
        while ($deuda = mysqli_fetch_array($deudasdb)) {
            $deudas[] = $deuda;
        }
        return $deudas;
    }

    function diferenciadias($dia1, $dia2) {
        $datetime1 = new DateTime($dia1);
        $datetime2 = new DateTime($dia2);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%R%a');
    }
    function generarinteres($iddeuda,$dias){
         $conexion = new cConexion();
        $bd = $conexion->getBd();
        $interes=20;
        if ($dias>=1) {
            $interes=$interes+(3*($dias-1));
        }
        
        $sql = "UPDATE `deuda` SET `interes` = '$interes' WHERE (`idDeuda` = '$iddeuda');";
       
      //  echo $sql."<br>";
        return $bd->query($sql);
    }

}
