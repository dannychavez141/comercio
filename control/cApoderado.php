<?php

require 'conexion.php';
$accion = $_POST['baccion'];
echo "go?" . $accion;
switch ($accion) {
    case 'R':
        $dni = $_POST['dni'];
        $nom = $_POST['nom'];
        $apepa = $_POST['apepa'];
        $apema = $_POST['apema'];
        $dir = $_POST['dir'];
        $telf = $_POST['telf'];
        $tipo = $_POST['tipo'];
        $correo = $_POST['correo'];
        $est = $_POST['est'];

        $sql = "INSERT INTO `apoderado` (`dni`, `nomb`, `apepa`, `apema`, `dir`, `telf`, `idtipoApoderado`, `est`, `pass`) VALUES ('$dni', '$nom', '$apepa', '$apema',
         '$dir', '$telf', '$tipo', '$est', '$dni');";
        echo $sql;
        $mysqli->query($sql);
        $sqlcorreo = "INSERT INTO `correos` VALUES ('$dni','$correo');";
        $mysqli->query($sqlcorreo);
        header("Location: ../regApoderado.php?tconf=true");
        exit;
        break;

    case 'M':
        $id = $_POST['id'];
        $dni = $_POST['dni'];
        $nom = $_POST['nom'];
        $apepa = $_POST['apepa'];
        $apema = $_POST['apema'];
        $dir = $_POST['dir'];
        $telf = $_POST['telf'];
        $tipo = $_POST['tipo'];
        $est = $_POST['est'];
        $pass = $_POST['con'];
        $correo = $_POST['correo'];
        $sql = "UPDATE `apoderado` SET `dni`='$dni', `nomb`='$nom', `apepa`='$apepa', `apema`='$apema', `dir`='$dir', `telf`='$telf', `idtipoApoderado`='$tipo', `est`='$est',`pass`='$pass' WHERE `idApoderado`='$id';";
        //echo $sql;
        $mysqli->query($sql);
        $sqlbuscar = "SELECT * FROM correos where dniApo='$dni';";
        $buscarcorreo = $mysqli->query($sqlbuscar);
        if ($buscarcorreo->num_rows > 0) {
            $sqlcorreo = "UPDATE `correos` SET `correo` = '$correo' WHERE `dniApo` = '$dni' ;";
        } else {
            $sqlcorreo = "INSERT INTO `correos` VALUES ('$dni','$correo');";
        }
        
        $mysqli->query($sqlcorreo);
        header("Location: ../verApoderado.php?tconf=true");
        exit;
        break;
    default:
        # code...
        break;
}
?>