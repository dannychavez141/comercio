<?php

if (isset($_COOKIE['usuario'])) {
    echo "";
} else {
    header("Location: ../login.php");
    exit();
}
$usuario = $_COOKIE['usuario'];
$idusuario = $_COOKIE['idUsuario'];
$idtipo = $_COOKIE['idtipo'];
$tipo = $_COOKIE['tipo'];
if ($idtipo == 4 || $idtipo == 5) {
    header("Location: ../nopermiso.php");
    exit();
}

function nombremes($mes) {
    $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    return $meses[$mes - 1];
}

require 'conexion.php';
$accion = $_POST['baccion'];
echo "go?" . $accion;
switch ($accion) {
    case 'R':
        $mes = date('m');
        $an = date('Y');
        $dia = date('d');
        $hoy = $an . "-" . $mes . "-" . $dia;
        if ($mes == 12) {
            $mvenci = 1;
            $van = $an + 1;
        } else {
            $mvenci = $mes + 1;
            $van = $an;
        }
        $vencimiento = $van . "-" . $mvenci . "-" . $dia;
        $tipodeuda = $_POST['tipodeuda'];
        $id = $_POST['id'];
        $descr = $_POST['descr1'];
        $monto = $_POST['monto'];
        $idusuario = $_COOKIE['idUsuario'];

        $sql = "INSERT INTO `deuda`
(`idMatricula`,`idTipoDeuda`,`fecha`,`hora`,`vencimiento`,`monto`,`interes`,`est`,`descr`)
VALUES($id,$tipodeuda,now(),now(),'$vencimiento',$monto,0,1,'$descr " . nombremes($mes) . " $an');";
        //echo $sql;
        $rs = $mysqli->query($sql);

        header("Location: ../verDeudas.php?tconf=true");
        exit;
        break;

    case 'M':
        $iddeuda = $_POST['iddeuda'];
        $idapo = $_POST['idapo'];
        $recibido = $_POST['recibido'];
        $vuelto = $_POST['vuelto'];
        $tipopago = $_POST['tipopago'];
        $tipocomp = $_POST['tipocomp'];
        $idusuario = $_COOKIE['idUsuario'];
        if (isset($_POST['parcial'])) {
            $parcial = $_POST['parcial'];
        } else {
            $parcial = 'off';
        }

        echo "<br>" . $parcial;
        if ($parcial == 'on') {
            $vuelto = $vuelto * (-1);

            $query = "SELECT (max(numero)+1) FROM pago where trecibo='$tipocomp';";
            $resultado = $mysqli->query($query);
            $recibo = 1;
            while ($row = $resultado->fetch_array()) {
                if ($row[0] != "") {
                    $recibo = $row[0];
                }
            }

            $sql = "INSERT INTO `pago` (`idApo`, `fecha`, `hora`, `idDeuda`, `idUsuario`, `recibido`, `vuelto`, `est`,`idtipopago`,`trecibo`,`numero`) VALUES ('$idapo', now(), now(), '$iddeuda', '$idusuario', '$recibido', '0', '1','$tipopago',$tipocomp,$recibo);";
            echo "<br>" . $sql;
            $rs = $mysqli->query($sql);

            $sql = "SELECT * FROM deuda where idDeuda='$iddeuda';";
            echo "<br>" . $sql;
            $registro = $mysqli->query($sql);
            while ($datos = $registro->fetch_array()) {
                $sql = "INSERT INTO `deuda`
(`idMatricula`,`idTipoDeuda`,`fecha`,`hora`,`vencimiento`,`monto`,`interes`,`est`,`descr`)
VALUES($datos[1],$datos[2],'$datos[3]','$datos[4]','$datos[5]',$vuelto,0,1,'Pago Parcial 2 $datos[10]');";
                $rs = $mysqli->query($sql);
                echo "<br>" . $sql;
            }
            $sql = "UPDATE `deuda` SET `monto` = '$recibido', `est` = '4', `descr` = concat('Pago parcial 1',' ',descr), `pagado`=now() WHERE (`idDeuda` = '$iddeuda');";
            echo "<br>" . $sql;
            $rs = $mysqli->query($sql);
        } else {
            $sql = "UPDATE `deuda` SET `est`='4', `pagado`=now() WHERE `idDeuda`='$iddeuda';";
            //  echo $sql;
            $rs = $mysqli->query($sql);
            $query = "SELECT (max(numero)+1) FROM pago where trecibo='$tipocomp';";
            $resultado = $mysqli->query($query);
            $recibo = 1;
            while ($row = $resultado->fetch_array()) {
                if ($row[0] != "") {
                    $recibo = $row[0];
                }
            }
            $sql = "INSERT INTO `pago` (`idApo`, `fecha`, `hora`, `idDeuda`, `idUsuario`, `recibido`, `vuelto`, `est`,`idtipopago`,`trecibo`,`numero`) VALUES ('$idapo', now(), now(), '$iddeuda', '$idusuario', '$recibido', '$vuelto', '1','$tipopago',$tipocomp,$recibo);";
            $rs = $mysqli->query($sql);
        }

        echo "<br>" . $sql;

        if ($tipocomp == 1) {
            $sql = "INSERT INTO `historial` (`idUsuario`, `tabla`, `id`, `tablamod`, `descr`, `fecha`, `hora`)
VALUES ($idusuario, 'usuario', '$iddeuda','deuda', 'Se pago la deuda Nro " . $iddeuda . " y se creo La boleta Nro " . $recibo . "', now(),now());";
            echo "<br>" . $sql;
        } else {
            $sql = "INSERT INTO `historial` (`idUsuario`, `tabla`, `id`, `tablamod`, `descr`, `fecha`, `hora`)
VALUES ($idusuario, 'usuario', '$iddeuda','deuda', 'Se pago la deuda Nro " . $iddeuda . " y se creo La Factura Nro " . $recibo . "', now(),now());";
            echo "<br>" . $sql;
        }
        //  echo $sql;
        $rs = $mysqli->query($sql);

        $query = "SELECT max(idpago) FROM pago";
        $resultado = $mysqli->query($query);
        while ($row = $resultado->fetch_array()) {
            $recibo = $row[0];
        }
//Agregamos la libreria para genera códigos QR

        require "../phpqrcode/qrlib.php";

        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = '../qrimg/';

        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);

        //Declaramos la ruta y nombre del archivo a generar
        $recibo = sha1($recibo);
        $filename = $dir . $recibo . '.png';
//Parametros de Condiguración
        $tamaño = 10; //Tamaño de Pixel
        $level = 'H'; //Precisión Baja
        $framSize = 3; //Tamaño en blanco
        $contenido = "http://intranet.premiumcollege.edu.pe/pdfpago.php?cod=" . $recibo; //Texto
        //$contenido = "http://192.168.1.35/pdfpago.php?cod=".$recibo; //Texto
        //Enviamos los parametros a la Función para generar código QR
        QRcode::png($contenido, $filename, $level, $tamaño, $framSize);

        //Mostramos la imagen generada
        //echo '<img src="'.$dir.basename($filename).'" /><hr/>';

        header("Location: ../verDeudas.php?recibo=" . $recibo);
        exit;
        break;
    default:
        # code...
        break;
}
?>