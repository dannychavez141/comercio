<?php

include 'plantillapdf/plantillaalumno.php';
require 'control/conexion.php';
include './control/cConexion.php';
include './modelo/dbTiposeguro.php';
include './modelo/mTiposeguro.php';
include './modelo/mseguroalumno.php';
$id = $_GET['cod'];
$query = "call verunaalumno($id)";
$resultado = $mysqli->query($query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



while ($row = $resultado->fetch_array()) {

    if (isset($_COOKIE['usuario'])) {
        echo "";
    } else {
        header("Location: ./premium/index.php");
        exit();
    }
    $usuario = $_COOKIE['usuario'];
    $idusuario = $_COOKIE['idUsuario'];
    $idtipo = $_COOKIE['idtipo'];
    $tipo = $_COOKIE['tipo'];
    if ($idtipo == 5) {
        require 'control/conexion.php';
        $sql = "SELECT dni FROM apoderado where idApoderado='$idusuario';";
        $registro = $mysqli->query($sql);
        while ($datos = $registro->fetch_array()) {
            $apodni = $datos[0];
        }
        require 'control/conexion.php';
        $sql = "SELECT count(idAlumnos) FROM alumnos 
where dni='$row[1]' and dniapo='$apodni';";
        $pariente = 0;
        $registro = $mysqli->query($sql);
        while ($datos = $registro->fetch_array()) {
            $pariente = $datos[0];
        }
        if ($pariente == 0) {
            header("Location: ./familiares/nopariente.php");
            exit();
        }
    }
    $bdtipo = new dbTiposeguro();
    $tipoactual = $bdtipo->buscarAlumnoSeguro($row[1]);


    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(2);
    $pdf->SetX(40);
    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(10, 5, 'DATOS DE ALUMNO ', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DNI ALUMNO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[1]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, ' APELLIDOS Y NOMBRES :', 0, 1, 'C');
    if ($row[9] == '0') {
        $pdf->Image('img/noimage.png', 140, 50, 45, 45);
    } else {
        if (file_exists('img/alumnos/' . $row[1] . '.' . $row[9])) {
            $pdf->Image('img/alumnos/' . $row[1] . '.' . $row[9], 140, 50, 45, 45, $row[9]);
        } else {
            $pdf->Image('img/noimage.png', 140, 50, 45, 45);
        }
    }
    $dni = $row[1];
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->MultiCell(80, 5, utf8_decode($row[3] . " " . $row[4] . ". " . $row[2]), 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $dia = date("j");
    $mes = date("n");
    $ano = date("Y");

    $nacimiento = explode("-", $row[5]);
    $dianac = $nacimiento[2];
    $mesnac = $nacimiento[1];
    $anonac = $nacimiento[0];
//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual 
    if (($mesnac == $mes) && ($dianac > $dia)) {
        $ano = ($ano - 1);
    }
//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual 
    if ($mesnac > $mes) {
        $ano = ($ano - 1);
    }
//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad 
    $edad = ($ano - $anonac);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'FECHA DE NACIMIENTO / EDAD/ SEXO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(3);
    $pdf->SetX(30);
    $pdf->Cell(100, 5, utf8_decode($row[5] . " / " . $edad . " AÑOS/ " . $row[50]), 0, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'SEGURO / CORREO INSTITUCIONAL:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($tipoactual->getTipo() . "/ " . $tipoactual->getAdicional()), 0, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Ln(3);
    $pdf->SetX(45);
    -
            $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(10, 5, 'DATOS DE APODERADO', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DNI APODERADO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[15]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DATOS DE APODERADO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[17] . " " . $row[18] . " " . $row[16]), 0, 1, 'C');
    $pdf->Ln(3);
    $pdf->SetX(45);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DIRECCION:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[19]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'TELEFONO:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[20]), 0, 1, 'C');
    $pdf->Ln(3);
    $pdf->SetX(45);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 5, 'CLAVE DEL SISTEMA:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[23] . " (por favor no comparta su clave)"), 0, 1, 'C');
    $pdf->Ln(3);
    $pdf->SetX(45);
    $pdf->SetFont('Arial', 'BU', 12);
    $pdf->Cell(10, 5, 'DATOS DE FAMILIARES', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DNI PADRE:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[25]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DATOS DEL PADRE:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[27] . " " . $row[28] . " " . $row[26]), 0, 1, 'C');
    $pdf->Ln(3);
    $pdf->SetX(45);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DNI MADRE:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[35]), 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Ln(3);
    $pdf->SetX(40);
    $pdf->Cell(30, 5, 'DATOS DE LA MADRE:', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(1);
    $pdf->SetX(40);
    $pdf->Cell(100, 5, utf8_decode($row[37] . " " . $row[38] . " " . $row[36]), 0, 1, 'C');
    $pdf->Ln(3);
    $pdf->SetX(45);
    $pdf->Ln(7);
    /* $pdf->Cell(196, 6, '_______________________                     	______________________', 0, 0, 'C', 0);
      $pdf->Ln(10);
      $pdf->Cell(194, 6, 'Firma Apoderado                                        Firma Director', 0, 0, 'C', 0); */
}
$modo = "I";
$nombre_archivo = "Ficha_alumno_" . $dni . ".pdf";
$pdf->Output($nombre_archivo, $modo);
?>