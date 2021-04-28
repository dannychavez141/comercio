<?php

class dboCompromiso {

    function verUno($id) {
        $sql = "SELECT * from detallecomp dc
        left join compromisos c on dc.idcompromisos=c.idcompromisos
        left join apoderado ap on c.idApoderado=ap.idApoderado
        left join alumnos al on c.idAlumno=al.idAlumnos where md5(c.idcompromisos)='$id'";
        //echo $sql;
        $metodos = new metodos();
        $datos = $metodos->consultar($sql);
        return json_decode($datos, true);
    }

    function verDetalle($id) {
        $sql = "SELECT * FROM detallecomp where c.idcompromisos='$id'";
        $metodos = new metodos();
        $datos = $metodos->consultar($sql);
        return $datos;
    }

    function cambiarDet($id, $tip) {
        $sql = "UPDATE `detallecomp` SET `est` = '$tip' WHERE (`iddetalle` = '$id');";
        $metodos = new metodos();
        $datos = $metodos->ejecutar($sql, "MODIFICACION REALIZADA CORRECTAMENTE");
        return $datos;
    }

    function eliminarDetalle($id) {
        $sql = "DELETE FROM `detallecomp`
        WHERE  iddetalle='$id'";
        $metodos = new metodos();
        $datos = $metodos->ejecutar($sql, "DETALLE  ELIMINADO CORRECTAMENTE");
        return $datos;
    }

    function buscar($busq) {
        $sql = "SELECT c.idcompromisos,c.idAlumno, al.dni,concat(al.apepa,' ',al.apema,' ',al.nomb) as alu,c.idApoderado,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo
,c.descrComp,c.creacion,c.monto,c.est FROM compromisos c left join apoderado ap on c.idApoderado=ap.idApoderado
left join alumnos al on c.idAlumno=al.idAlumnos  where";

        switch ($busq['filtro']) {

            case '5':
                $sql .= " c.idcompromisos='{$busq['variable']}' ";

                break;
            case '1':
                $sql .= " concat(al.nomb,' ',al.apepa,' ',al.apema) like '%{$busq['variable']}%'";

                break;
            case '2':
                $sql .= " concat(ap.nomb,' ',ap.apepa,' ',ap.apema) like '%{$busq['variable']}%' ";
                break;
            case '4':
                $sql .= " c.creacion='{$busq['variable']}' ";

                break;
            case '3':
                $sql .= " c.descrComp like  '%{$busq['variable']}%' ";

                break;

            default:
                # code...
                break;
        }

        switch ($busq['estado']) {
            case '1':
                $sql .= " and c.est='1' ";

                break;
            case '2':
                $sql .= " and c.est='2' ";
                break;
            case '3':
                $sql .= " and c.est='3' ";
                break;
            //echo $sql;
            default:
                # code...
                break;
        }
        $sql .= " order By c.idcompromisos desc;";
        //echo $sql;
        $metodos = new metodos();
        $datos = $metodos->consultar($sql);
        return $datos;
    }

    function crear($modelo) {
        $sql = "INSERT INTO `compromisos` (`idAlumno`,`idApoderado`,`descrComp`,`creacion`,`monto`,`est`) VALUES
    ('{$modelo['idAlumno']}','{$modelo['idApoderado']}','{$modelo['descrComp']}','{$modelo['creacion']}','{$modelo['monto']}','{$modelo['est']}');
    ";
        $metodos = new metodos();
        $datos = $metodos->ejecutar($sql, "COMPROMISO DE PAGO CREADO CORRECTAMENTE");
        $cons = "SELECT max(idcompromisos) FROM compromisos;";
        $ultComp = $metodos->consultarrep($cons);
        foreach ($modelo['detalles'] as $detalle) {
            $sql = "INSERT INTO `detallecomp` (`idcompromisos`, `descrDet`, `fvenci`, `canti`, `monto`, `est`) "
                    . "VALUES ('{$ultComp[0]}', '{$detalle['descrDet']}', '{$detalle['fvenci']}', '{$detalle['canti']}', '{$detalle['monto']}', '1');";
            //  print_r($sql);
            $metodos->ejecutar($sql, "");
        }
        //Agregamos la libreria para genera códigos QR

        require "../phpqrcode/qrlib.php";

        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = '../qrimg/comp/';

        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);

        //Declaramos la ruta y nombre del archivo a generar
        $recibo = md5($ultComp[0]);
        $filename = $dir . $recibo . '.png';
//Parametros de Condiguración
        $tamaño = 10; //Tamaño de Pixel
        $level = 'H'; //Precisión Baja
        $framSize = 3; //Tamaño en blanco
        $contenido = "http://intranet.premiumcollege.edu.pe/pdfCompromiso.php?id=" . $recibo; //Texto
        //$contenido = "http://192.168.1.35/pdfpago.php?cod=".$recibo; //Texto
        //Enviamos los parametros a la Función para generar código QR
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize);

        return $datos;
    }

    function modificar($modelo) {
        $sql = "UPDATE `compromisos`
            SET
                 `descrComp` = '{$modelo['descr']}',
                 `est` = '{$modelo['est']}'
            WHERE `idcompromisos` = '{$modelo['id']}';";
        $metodos = new metodos();
        $datos = $metodos->ejecutar($sql, "COMPROMISO DE PAGO MODIFICADO CORRECTAMENTE");
        return $datos;
    }

    function crearDetalle($modelo) {
        $sql = "INSERT INTO `detallecomp`(`idcompromisos`,`descrDet`,`canti`,`monto`) VALUES
    ('{$modelo['idcompromisos']}','{$modelo['descrDet']}','{$modelo['canti']}','{$modelo['monto']})'";
        $metodos = new metodos();
        $datos = $metodos->ejecutar($sql, "DETALLE  REGISTRADO CORRECTAMENTE");
        return $datos;
    }

}
