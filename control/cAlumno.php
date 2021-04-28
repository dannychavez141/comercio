<?php

//error_reporting(0);
include './cConexion.php';
include '../modelo/dboMatricula.php';
require 'conexion.php';
$accion = $_POST['baccion'];
echo "go?" . $accion . "<br>";
switch ($accion) {
    case 'R':
        $dni = $_POST['dni'];
        $nom = $_POST['nom'];
        $apepa = $_POST['apepa'];
        $apema = $_POST['apema'];
        $dniapo = $_POST['dniapo'];
        $dnimad = $_POST['dnimad'];
        $dnipad = $_POST['dnipad'];
        $sex = $_POST['sex'];
        $est = $_POST['est'];
        $fnac = $_POST['fnac'];
        $tiposeguro = $_POST['tiposeguro'];
        $adicional = $_POST['adicional'];
        $ext = 'png';
        $url = $_SERVER['DOCUMENT_ROOT'] . '/img/alumnos/';
        if ($_FILES['file']['name'] != null && $_FILES['file']['size'] > 0) {
            $archivo = new SplFileInfo($_FILES['file']['name']);
            $ext = $archivo->getExtension();
            $destino = $url . $dni . '.' . $ext;
            move_uploaded_file($_FILES['file']['tmp_name'], $destino);
            $sql = "INSERT INTO `alumnos` (`dni`, `nomb`, `apepa`, `apema`, `fnac`, `dniapo`,`dnipadre`, `dnimadre`, `ext`, `est`, `idsex`) VALUES ('$dni', '$nom', '$apepa', '$apema','$fnac', '$dniapo','$dnipad', '$dnimad', '$ext', '$est','$sex');";
            // echo $sql;
            $mysqli->query($sql);
            //  header("Location: ../regAlumno.php?tconf=true");
        } else {
            $sql = "INSERT INTO `alumnos` (`dni`, `nomb`, `apepa`, `apema`, `fnac`, `dniapo`, `dnipadre`, `dnimadre`, `est`, `idsex`) VALUES 
  ('$dni', '$nom', '$apepa', '$apema','$fnac','$dniapo','$dnipad', '$dnimad','$est','$sex');
";
            //echo $sql;

            $mysqli->query($sql);
        }
        $sqlseguro = "INSERT INTO `alumnoseguro` VALUES('$dni','$tiposeguro','$adicional');";
        $mysqli->query($sqlseguro);
        header("Location: ../regAlumno.php?tconf=false");
        exit;
        break;

    case 'M':
        $id = $_POST['id'];
        $dni = $_POST['dni'];
        $dniold = $_POST['dniold'];
        $nom = $_POST['nom'];
        $apepa = $_POST['apepa'];
        $apema = $_POST['apema'];
        $sex = $_POST['sex'];
        $dniapo = $_POST['dniapo'];
        $dnimad = $_POST['dnimad'];
        $dnipad = $_POST['dnipad'];
        $est = $_POST['est'];
        $fnac = $_POST['fnac'];
        $tiposeguro = $_POST['tiposeguro'];
        $adicional = $_POST['adicional'];
        $ext = 'png';
        $url = $_SERVER['DOCUMENT_ROOT'] . '/img/alumnos/';
        $sqlbuscar = "SELECT * FROM alumnoseguro where dniAlum='$dni';";
        $buscarseguro = $mysqli->query($sqlbuscar);
        $sqlsegurio ="";
        if ($buscarseguro->num_rows > 0) {
            $sqlsegurio = "UPDATE `alumnoseguro` SET `idtiposeguro` = '$tiposeguro',
`adicional` = '$adicional' WHERE `dniAlum` = '$dni' ;";
        } else {
            $sqlsegurio = "INSERT INTO `alumnoseguro` VALUES('$dni','$tiposeguro','$adicional');";
        }
        echo $sqlsegurio;

        $dbomatricula = new dboMatricula();
        $dbomatricula->repararMatriculas($dni, $dniold);

        if ($_FILES['file']['name'] != null && $_FILES['file']['size'] > 0) {
            $archivo = new SplFileInfo($_FILES['file']['name']);
            $ext = $archivo->getExtension();
            $destino = $url . $dni . '.' . $ext;
            echo $destino;
            move_uploaded_file($_FILES['file']['tmp_name'], $destino);
            $sql = "UPDATE `alumnos` SET `dni`='$dni', `nomb`='$nom', `apepa`='$apepa', `apema`='$apema', `fnac`='$fnac', `dniapo`='$dniapo',
  `dnipadre`='$dnipad', `dnimadre`='$dnimad', `ext`='$ext', `est`='$est',`idsex`='$sex' WHERE `idAlumnos`='$id';";
        } else {
            $sql = "UPDATE `alumnos` SET `dni`='$dni', `nomb`='$nom', `apepa`='$apepa', `apema`='$apema', `fnac`='$fnac', `dniapo`='$dniapo',
  `dnipadre`='$dnipad', `dnimadre`='$dnimad', `est`='$est',`idsex`='$sex' WHERE `idAlumnos`='$id';";
        }
        //  echo $sql."<br>";
        //  echo $sqlseguro."<br>";

        $mysqli->query($sql);
        $mysqli->query($sqlsegurio);
         header("Location: ../verAlumno.php?tconf=true");

        exit;
        break;
    default:
        # code...
        break;
}
?>