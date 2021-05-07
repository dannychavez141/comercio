<?php

include 'plantillapdf/plantillaboletanotas.php';
include './control/funcionNotas.php';
$modo = 1;
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
    $hoy = date('Y-m-d');
    if ($idusuario == "") {
        $idusuario = "******************";
    }
    require 'control/conexion.php';
    $sql = "SELECT dni FROM apoderado where idApoderado='$idusuario';";
    $registro = $mysqli->query($sql);
    while ($datos = $registro->fetch_array()) {
        $apodni = $datos[0];
    }
    require 'control/conexion.php';
    $sql = "SELECT count(idDeuda) FROM deuda d 
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
 where a.dniapo='$apodni' and d.est='1' and d.fecha<='$hoy';";

    $deudas = 0;
    $registro = $mysqli->query($sql);
    while ($datos = $registro->fetch_array()) {
        $deudas = $datos[0];
    }
    if ($deudas != 0) {
       header("Location: ./familiares/reportedeuda.php");
       // exit();
    }
}
include 'control/conexion.php';
$id = $_GET['cod'];
$query = "call verunamatricula($id)";
$resultado = $mysqli->query($query);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$modo = 1;
while ($row = $resultado->fetch_array()) {

    if ($idtipo == 5) {
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
    }$pdf->SetFillColor(12, 183, 242);
    $pdf->Ln(5);
    $pdf->SetX(45);
    $pdf->Cell(120, 10, 'BOLETA DE INFORMACION - ' . utf8_decode($row[9]), 0, 0, 'C');
    $pdf->Ln(20);
    $pdf->SetX(15);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 6, 'DREU', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 6, 'UCAYALI', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 6, 'UGEL', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 6, 'CORONEL PORTILLO', 1, 1, 'C');
    $pdf->SetX(15);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 6, 'NIVEL', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    //if ($row[6] == 2 && $row[10] != 7 && $row[8]<5) {
    if ($row[6] == 2) {
        $modo = 2;
    }
    
     if ($row[10] == 7 ||  $row[10] == 8 && $row['idAnioEscolar']>4) {
        $modo = 1;
    }
    $pdf->Cell(40, 6, utf8_decode($row[7]), 1, 0, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 6, 'GRADO Y SECCION', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 6, utf8_decode($row[11] . " " . $row[13]), 1, 1, 'C');
    $pdf->SetX(15);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 6, 'INSTITUCION EDUCATIVA', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(130, 6, 'PREMIUM COLLEGE', 1, 1, 'C');
    $pdf->SetX(15);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 6, 'APELLIDOS Y  NOMBRES', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', 'B', 14);
    $idgrado = $row[10];
    $dni = $row[1];
    $anioe = $row[9];
    $pdf->Cell(130, 6, utf8_decode($row[2]), 1, 1, 'C');
}
$pdf->Ln(5);
$pdf->SetX(15);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 15, 'AREA', 1, 0, 'C', 1);
$pdf->Cell(72, 15, utf8_decode('CRITERIOS DE EVALUACIÓN'), 1, 0, 'C', 1);
$pdf->Cell(42, 9, 'BIMESTRE/TRIMESTRE', 1, 0, 'C', 1);
$pdf->MultiCell(16, 5, utf8_decode('Calific. Final de Área'), 1, 'C');
$pdf->SetY(64);
$pdf->SetX(180);
$pdf->MultiCell(15, 5, utf8_decode('Eval. de Recuperación'), 1, 'C');
$pdf->SetY(73);
$pdf->SetX(122);
$pdf->Cell(11, 6, '1', 1, 0, 'C');
$pdf->Cell(10, 6, '2', 1, 0, 'C');
$pdf->Cell(10, 6, '3', 1, 0, 'C');
$pdf->Cell(11, 6, '4', 1, 1, 'C');
$y = $pdf->GetY();
$y1 = $pdf->GetY();
$y2 = $pdf->GetY();
$pos = 0;
$s = 0;
include 'control/conexion.php';
$url = "call vernotas($id)";
$lista = $mysqli->query($url);
$temp = "";
$salto = 0;
$datos = $lista->num_rows;
$suma1 = 0;
$suma2 = 0;
$suma3 = 0;
$suma4 = 0;
$nota1 = 0;
$nota2 = 0;
$nota3 = 0;
$nota4 = 0;
$prom1 = 0;
$prom2 = 0;
$prom3 = 0;
$prom4 = 0;
$recu = 0;
$cont = 0;
$promedio = 0;
$s = 0;
$prim = 1;
$segun = 0;
while ($comp = $lista->fetch_array()) {
    $curso = $comp[0];
    if ($curso == $temp) {

        $pdf->SetY($y);
        $pdf->SetX(50);
        $pdf->SetFont('Arial', '', 7);
        $tamaño = strlen($comp[1]);
        $pdf->MultiCell(72, 5, utf8_decode($comp[1]), 1, 'C');
        if ($tamaño > 125) {
            $pos = $pos + 15;
            $t = 15;
        } else if ($tamaño > 67 || $tamaño > 64) {
            $pos = $pos + 10;
            $t = 10;
        } else {
            $pos = $pos + 5;
            $t = 5;
        }
        $pdf->SetY($y);
        $pdf->SetX(122);
        $nota1 = $comp[2];
        $nota2 = $comp[3];
        $nota3 = $comp[4];
        $nota4 = $comp[5];
        if ($modo == 1) {
            $suma1 = $nota1;
            $suma2 = $nota2;
            $suma3 = $nota3;
            $suma4 = $nota4;
        } else {
            $suma1 = $suma1 + $nota1;
            $suma2 = $suma2 + $nota2;
            $suma3 = $suma3 + $nota3;
            $suma4 = $suma4 + $nota4;
        }
        $recu = $recu + $comp[6];
        $cont = $cont + 1;
        $pdf->SetFont('Arial', '', 10);
        if ($nota1 <= 0 && $modo == 1) {
            $pdf->SetTextColor(255, 0, 0);
        } else if ($nota1 > 0 && $modo == 1) {
            $pdf->SetTextColor(0, 0, 255);
        } else if ($nota1 <= 10 && $modo == 2) {
            $pdf->SetTextColor(255, 0, 0);
        } else if ($nota1 > 10 && $modo == 2) {
            $pdf->SetTextColor(0, 0, 255);
        }
        $pdf->Cell(11, $t, utf8_decode(notaprim2($nota1, $modo)), 1, 0, 'C');
        if ($nota2 <= 0 && $modo == 1) {
            $pdf->SetTextColor(255, 0, 0);
        } else if ($nota2 > 0 && $modo == 1) {
            $pdf->SetTextColor(0, 0, 255);
        } else if ($nota2 <= 10 && $modo == 2) {
            $pdf->SetTextColor(255, 0, 0);
        } else if ($nota2 > 10 && $modo == 2) {
            $pdf->SetTextColor(0, 0, 255);
        }
        $pdf->Cell(10, $t, utf8_decode(notaprim2($nota2, $modo)), 1, 0, 'C');
        if ($nota3 <= 0 && $modo == 1) {
            $pdf->SetTextColor(255, 0, 0);
        } else if ($nota3 > 0 && $modo == 1) {
            $pdf->SetTextColor(0, 0, 255);
        } else if ($nota3 <= 10 && $modo == 2) {
            $pdf->SetTextColor(255, 0, 0);
        } else if ($nota3 > 10 && $modo == 2) {
            $pdf->SetTextColor(0, 0, 255);
        }
        $pdf->Cell(10, $t, utf8_decode(notaprim2($nota3, $modo)), 1, 0, 'C');
        if ($nota4 <= 0 && $modo == 1) {
            $pdf->SetTextColor(255, 0, 0);
        } else if ($nota4 > 0 && $modo == 1) {
            $pdf->SetTextColor(0, 0, 255);
        } else if ($nota4 <= 10 && $modo == 2) {
            $pdf->SetTextColor(255, 0, 0);
        } else if ($nota4 > 10 && $modo == 2) {
            $pdf->SetTextColor(0, 0, 255);
        }
        $pdf->Cell(11, $t, utf8_decode(notaprim2($nota4, $modo)), 1, 1, 'C');

        $pdf->SetTextColor(0, 0, 0);
        $y = $pdf->GetY();


        $temp = $curso;
    } else {
        if ($temp != "") {
            $pdf->SetY($y);
            $pdf->SetX(50);
            $pdf->SetFont('Arial', 'B', 7);
            $pdf->MultiCell(72, 5, utf8_decode('CALIFICATIVO DEL ÁREA'), 1, 'C', 1);
            $pdf->SetY($y);
            $pdf->SetX(122);
            if ($modo == 1) {
                $prom1 = round($suma1);
                $prom2 = round($suma2);
                $prom3 = round($suma3);
                $prom4 = round($suma4);
                $recu = round($recu);
            } else {
                $prom1 = round($suma1 / $cont);
                $prom2 = round($suma2 / $cont);
                $prom3 = round($suma3 / $cont);
                $prom4 = round($suma4 / $cont);
                $recu = round($recu / $cont);
            }
            if ($prom1 > -1 && $prom2 > -1 && $prom3 > -1 && $prom4 > -1) {
                if ($modo == 1) {
                    $promedio = $prom4;
                } else {
                    $promedio = round(($prom1 + $prom2 + $prom3 + $prom4) / 4);
                }
            } else {
                $promedio = -1;
            }
            $pdf->SetFont('Arial', 'B', 10);
            if ($prom1 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($prom1 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($prom1 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($prom1 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(11, 5, notaprim2($prom1, $modo), 1, 0, 'C', 1);
            if ($prom2 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($prom2 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($prom2 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($prom2 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(10, 5, notaprim2($prom2, $modo), 1, 0, 'C', 1);
            if ($prom3 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($prom3 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($prom3 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($prom3 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(10, 5, notaprim2($prom3, $modo), 1, 0, 'C', 1);
            if ($prom4 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($prom4 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($prom4 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($prom4 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(11, 5, notaprim2($prom4, $modo), 1, 1, 'C', 1);
            $pdf->SetTextColor(0, 0, 0);
            $cont = 0;
            $suma1 = 0;
            $suma2 = 0;
            $suma3 = 0;
            $suma4 = 0;
            $y = $pdf->GetY();

            $pdf->SetFont('Arial', 'B', 7);

            if ($s == 1) {
                $pdf->SetY($y1);
            } else {
                $pdf->SetY($y1);
            }
            if ($prim == 1) {
                $pdf->SetY($y1);
            }
            if ($segun == 1) {
                $pdf->SetY($y2);
            }
            $pdf->SetX(15);
            $pos;
            $cur = strlen($temp);
            if ($cur > 20) {
                $pos = $pos / 2;
            }
            
            $tam = strlen($pos);
            $text = "";
            for ($i = 0; $i < $tam; $i++) {
                $text = $text . " ";
            }
             if($pos==7.5){
                   $text = $text . "  ";
             }
            $pdf->MultiCell(35, $pos, utf8_decode($temp . $text), 1, 'C');
            $salto = $salto + 1;

            if ($s == 1) {
                $s = 0;
                $pdf->SetY($y1);
            } else {
                $pdf->SetY($y1);
            }
            if ($prim == 1) {
                $pdf->SetY($y1);
                $prim = 0;
            }
            if ($segun == 1) {
                $pdf->SetY($y2);
                $segun = 0;
            }
            if ($cur > 20) {
                $pos = $pos * 2;
            }
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetX(164);
            if ($promedio <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($promedio > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($promedio <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($promedio > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(16, $pos, notaprim2($promedio, $modo), 1, 0, 'C');
            if ($recu <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($recu > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($recu <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($recu > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(15, $pos, notaprim2($recu, $modo), 1, 1, 'C');
            $pdf->SetTextColor(0, 0, 0);
            $pos = 0;
            $recu = 0;
            $y1 = $pdf->GetY();
        }$temp = $curso;
        if ($salto >= 6) {
            $salto = 0;
            $s = 1;
            $pdf->AddPage();
            $pdf->Ln(25);
            $pdf->SetX(15);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(35, 15, 'AREA', 1, 0, 'C', 1);
            $pdf->Cell(72, 15, utf8_decode('CRITERIOS DE EVALUACIÓN'), 1, 0, 'C', 1);
            $pdf->Cell(42, 9, 'BIMESTRE/TRIMESTRE', 1, 0, 'C', 1);
            $pdf->MultiCell(16, 5, utf8_decode('Calific. Final de Área'), 1, 'C', 1);
            $pdf->SetY(35);
            $pdf->SetX(180);
            $pdf->MultiCell(15, 5, utf8_decode('Eval. de Recuperación'), 1, 'C', 1);
            $segun = 1;
            $y2 = $pdf->GetY();
            $pdf->SetY(44);
            $pdf->SetX(122);
            $pdf->Cell(11, 6, '1', 1, 0, 'C', 1);
            $pdf->Cell(10, 6, '2', 1, 0, 'C', 1);
            $pdf->Cell(10, 6, '3', 1, 0, 'C', 1);
            $pdf->Cell(11, 6, '4', 1, 1, 'C', 1);
            $y = $pdf->GetY();
            $y1 = $pdf->GetY();
            $pdf->SetY($y);
            $pdf->SetX(50);
            $pdf->SetFont('Arial', '', 7);
            $tamaño = strlen($comp[1]);
            if ($tamaño > 125) {
                $pos = $pos + 15;
                $t = 15;
            } else if ($tamaño > 65) {
                $pos = $pos + 10;
                $t = 10;
            } else {
                $pos = $pos + 5;
                $t = 5;
            }
            $pdf->MultiCell(72, 5, utf8_decode($comp[1]), 1, 'C');
            $y = $pdf->GetY();
            $pdf->SetY($y - $t);
            $pdf->SetX(122);
            $nota1 = $comp[2];
            $nota2 = $comp[3];
            $nota3 = $comp[4];
            $nota4 = $comp[5];
            if ($modo == 1) {
                $suma1 = $nota1;
                $suma2 = $nota2;
                $suma3 = $nota3;
                $suma4 = $nota4;
            } else {
                $suma1 = $suma1 + $nota1;
                $suma2 = $suma2 + $nota2;
                $suma3 = $suma3 + $nota3;
                $suma4 = $suma4 + $nota4;
            }
            $recu = $recu + $comp[6];
            $cont = $cont + 1;
            $pdf->SetFont('Arial', '', 10);
            if ($nota1 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota1 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($nota1 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota1 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(11, $t, utf8_decode(notaprim2($nota1, $modo)), 1, 0, 'C');
            if ($nota2 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota2 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($nota2 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota2 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(10, $t, utf8_decode(notaprim2($nota2, $modo)), 1, 0, 'C');
            if ($nota3 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota3 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($nota3 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota3 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(10, $t, utf8_decode(notaprim2($nota3, $modo)), 1, 0, 'C');
            if ($nota4 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota4 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($nota4 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota4 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(11, $t, utf8_decode(notaprim2($nota4, $modo)), 1, 1, 'C');

            $pdf->SetTextColor(0, 0, 0);
            $y = $pdf->GetY();
            $pos = $pos + 5;
        } else if ($salto < 6) {
            $pdf->SetY($y);
            $pdf->SetX(50);
            $pdf->SetFont('Arial', '', 7);
            $tamaño = strlen($comp[1]);
            if ($tamaño > 125) {
                $pos = $pos + 15;
                $t = 15;
            } else if ($tamaño > 67 || $tamaño > 64) {
                $pos = $pos + 10;
                $t = 10;
            } else {
                $pos = $pos + 5;
                $t = 5;
            }

            $pdf->MultiCell(72, 5, utf8_decode($comp[1]), 1, 'C');
            $y = $pdf->GetY();
            $pdf->SetY($y - $t);
            $pdf->SetX(122);
            $nota1 = $comp[2];
            $nota2 = $comp[3];
            $nota3 = $comp[4];
            $nota4 = $comp[5];
            if ($modo == 1) {
                $suma1 = $nota1;
                $suma2 = $nota2;
                $suma3 = $nota3;
                $suma4 = $nota4;
            } else {
                $suma1 = $suma1 + $nota1;
                $suma2 = $suma2 + $nota2;
                $suma3 = $suma3 + $nota3;
                $suma4 = $suma4 + $nota4;
            }
            $recu = $recu + $comp[6];
            $cont = $cont + 1;
            $pdf->SetFont('Arial', '', 10);
            if ($nota1 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota1 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($nota1 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota1 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(11, $t, utf8_decode(notaprim2($nota1, $modo)), 1, 0, 'C');
            if ($nota2 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota2 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($nota2 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota2 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(10, $t, utf8_decode(notaprim2($nota2, $modo)), 1, 0, 'C');
            if ($nota3 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota3 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($nota3 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota3 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(10, $t, utf8_decode(notaprim2($nota3, $modo)), 1, 0, 'C');
            if ($nota4 <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota4 > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($nota4 <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota4 > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }
            $pdf->Cell(11, $t, utf8_decode(notaprim2($nota4, $modo)), 1, 1, 'C');

            $pdf->SetTextColor(0, 0, 0);
            $y = $pdf->GetY();
            $pos = $pos + 5;
        }

        $pdf->SetY($y);
    }
}
$pdf->SetY($y);
$pdf->SetX(50);
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(72, 5, utf8_decode('CALIFICATIVO DEL ÁREA'), 1, 'C', 1);
$pdf->SetY($y);
$pdf->SetX(122);
if ($modo == 1) {
    $prom1 = round($suma1);
    $prom2 = round($suma2);
    $prom3 = round($suma3);
    $prom4 = round($suma4);
    $recu = round($recu);
} else {
    $prom1 = round($suma1 / $cont);
    $prom2 = round($suma2 / $cont);
    $prom3 = round($suma3 / $cont);
    $prom4 = round($suma4 / $cont);
    $recu = round($recu / $cont);
}
if ($prom1 > -1 && $prom2 > -1 && $prom3 > -1 && $prom4 > -1) {
    if ($modo == 1) {
        $promedio = $prom4;
    } else {
        $promedio = round(($prom1 + $prom2 + $prom3 + $prom4) / 4);
    }
} else {
    $promedio = -1;
}
$pdf->SetFont('Arial', 'B', 10);
if ($prom1 <= 0 && $modo == 1) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($prom1 > 0 && $modo == 1) {
    $pdf->SetTextColor(0, 0, 255);
} else if ($prom1 <= 10 && $modo == 2) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($prom1 > 10 && $modo == 2) {
    $pdf->SetTextColor(0, 0, 255);
}
$pdf->Cell(11, 5, notaprim2($prom1, $modo), 1, 0, 'C', 1);
if ($prom2 <= 0 && $modo == 1) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($prom2 > 0 && $modo == 1) {
    $pdf->SetTextColor(0, 0, 255);
} else if ($prom2 <= 10 && $modo == 2) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($prom2 > 10 && $modo == 2) {
    $pdf->SetTextColor(0, 0, 255);
}
$pdf->Cell(10, 5, notaprim2($prom2, $modo), 1, 0, 'C', 1);
if ($prom3 <= 0 && $modo == 1) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($prom3 > 0 && $modo == 1) {
    $pdf->SetTextColor(0, 0, 255);
} else if ($prom3 <= 10 && $modo == 2) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($prom3 > 10 && $modo == 2) {
    $pdf->SetTextColor(0, 0, 255);
}
$pdf->Cell(10, 5, notaprim2($prom3, $modo), 1, 0, 'C', 1);
if ($prom4 <= 0 && $modo == 1) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($prom4 > 0 && $modo == 1) {
    $pdf->SetTextColor(0, 0, 255);
} else if ($prom4 <= 10 && $modo == 2) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($prom4 > 10 && $modo == 2) {
    $pdf->SetTextColor(0, 0, 255);
}
$pdf->Cell(11, 5, notaprim2($prom4, $modo), 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$cont = 0;
$suma1 = 0;
$suma2 = 0;
$suma3 = 0;
$suma4 = 0;
$y = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 7);
if ($s == 1) {
    $pdf->SetY($y1);
} else {
    $pdf->SetY($y1);
}
$pdf->SetX(15);
$pos;
$pos2=$pos;
$cur = strlen($temp);
            if ($cur > 17) {
                $pos = $pos / 2;
            }
            $tam = strlen($pos);
            $text = "";
            for ($i = 0; $i < $tam; $i++) {
                $text = $text . " ";
            }
            $pdf->MultiCell(35, $pos, utf8_decode($temp . $text), 1, 'C');
$salto = $salto + 1;

if ($s == 1) {
    $s = 0;
    $pdf->SetY($y1);
} else {
    $pdf->SetY($y1);
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(164);
if ($promedio <= 0 && $modo == 1) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($promedio > 0 && $modo == 1) {
    $pdf->SetTextColor(0, 0, 255);
} else if ($promedio <= 10 && $modo == 2) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($promedio > 10 && $modo == 2) {
    $pdf->SetTextColor(0, 0, 255);
}
$pdf->Cell(16, $pos2, notaprim2($promedio, $modo), 1, 0, 'C');
if ($recu <= 0 && $modo == 1) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($recu > 0 && $modo == 1) {
    $pdf->SetTextColor(0, 0, 255);
} else if ($recu <= 10 && $modo == 2) {
    $pdf->SetTextColor(255, 0, 0);
} else if ($recu > 10 && $modo == 2) {
    $pdf->SetTextColor(0, 0, 255);
}
$pdf->Cell(15, $pos2, notaprim2($recu, $modo), 1, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
if ($modo == 1) {
    $pdf->Ln(20);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(75, 6, 'LEYENDA', 1, 1, 'C', 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 255);
    $pdf->Cell(20, 6, 'AD', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("Logro destacado."), 1, 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 255);
    $pdf->Cell(20, 6, 'A', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("Logro previsto."), 1, 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 255);
    $pdf->Cell(20, 6, 'B', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("En proceso."), 1, 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(20, 6, 'C', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("En Inicio."), 1, 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(20, 6, 'NE', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("Competencia aun No Evaluada"), 1, 1);
} else if ($modo == 2) {
    $pdf->Ln(20);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(75, 6, 'LEYENDA', 1, 1, 'C', 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 255);
    $pdf->Cell(20, 6, '20 - 18', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("Logro destacado."), 1, 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 255);
    $pdf->Cell(20, 6, '17 - 14', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("Logro previsto."), 1, 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 255);
    $pdf->Cell(20, 6, '13 - 11', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("En proceso."), 1, 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(20, 6, '10 - 0', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("En Inicio."), 1, 1);
    $pdf->SetX(120);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(20, 6, 'NE', 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(55, 6, utf8_decode("Competencia aun No Evaluada"), 1, 1);
}
$pos = 0;
$recu = 0;
$modod = "I";
$nombre_archivo = "Boleta_de_Notas_" . $dni . "_" . $anioe . ".pdf";
$pdf->Output($nombre_archivo, $modod);
?>