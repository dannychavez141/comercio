<?php

include 'plantillapdf/plantillalistaalumnos.php';
include './control/funcionNotas.php';
$usuario = $_COOKIE['usuario'];
$anio = $_GET['anio'];
$grado = $_GET['grad'];
$secc = $_GET['secc'];
$cur = $_GET['cur'];
$peri = $_GET['peri'];
$ngrado = '';
$nanio = '';
$nsecc = '';
$ntipo = '';
$ncur = '';
$nperi = '';
$ncomp = 0;


$pdf = new PDF();
$pdf->AliasNbPages();

if ($peri < 6) {

    $pdf->AddPage();
    //busqueda de grado
    require 'control/conexion.php';
    $query = "SELECT * FROM grado g 
join tipogrado t on g.idTipo=t.idTipo where g.idGrado='$grado';";
    $resultado = $mysqli->query($query);
    while ($row = $resultado->fetch_array()) {
        $ngrado = utf8_decode($row[1]);
        $ntipo = utf8_decode($row[5]);
        $modo = utf8_decode($row[2]);
        //if($row[0]==7 || $anio>4){
        if ($row[0] == 7 || $row[0] == 8 && $anio > 4) {
            $modo = 1;
        }
    }
    //busqueda de seccion
    require 'control/conexion.php';
    $query = "SELECT * FROM seccion where idSeccion='$secc';";
    $resultado = $mysqli->query($query);
    while ($row = $resultado->fetch_array()) {

        $nsecc = utf8_decode($row[1]);
    }
    //busqueda de curso
    require 'control/conexion.php';
    $query = "SELECT * FROM cursos where idCursos='$cur';";
    $resultado = $mysqli->query($query);
    while ($row = $resultado->fetch_array()) {

        $ncur = utf8_decode($row[1]);
    }
    //busqueda de PERIODO
    require 'control/conexion.php';
    $query = "SELECT * FROM periodos where idPeriodos='$peri';";
    $resultado = $mysqli->query($query);
    while ($row = $resultado->fetch_array()) {

        $nperi = utf8_decode($row[1]);
    }
    //busqueda de seccion
    require 'control/conexion.php';
    $query = "SELECT * FROM seccion where idSeccion='$secc';";
    $resultado = $mysqli->query($query);
    while ($row = $resultado->fetch_array()) {

        $nsecc = utf8_decode($row[1]);
    }
    //busqueda de NRO DE COMPETENCIAS
    require 'control/conexion.php';
    $query = "SELECT count(idComp) FROM competencias where idcurso='$cur' and est='1';";
    $resultado = $mysqli->query($query);
    while ($row = $resultado->fetch_array()) {

        $ncomp = $row[0];
    }
    //busqueda de año escolar
    require 'control/conexion.php';
    $query = "SELECT * FROM anioescolar where idAnioEscolar='$anio';";
    $resultado = $mysqli->query($query);
    while ($row = $resultado->fetch_array()) {
        $nanio = utf8_decode($row[1]);
        $pdf->Ln(5);
        $pdf->SetX(50);
        $pdf->SetFont('Arial', 'BU', 11);
        $pdf->Cell(50, 5, 'DATOS DEL LISTA ', 1, 1, 'C');
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetX(50);
        $pdf->Cell(125, 6, 'PREMIUM COLLEGE', 1, 1, 'C', 1);

        $pdf->SetX(50);
        $pdf->Cell(50, 6, 'GRADO Y SECCION', 1, 0, 'C', 1);
        $pdf->Cell(75, 6, utf8_decode($ngrado . " " . $nsecc . " (" . $ntipo . ")"), 1, 1, 'C');
        $pdf->SetX(50);
        $pdf->Cell(50, 6, utf8_decode('AÑO ESCOLAR'), 1, 0, 'C', 1);
        $pdf->Cell(75, 6, utf8_decode($nanio), 1, 1, 'C');
        $pdf->SetX(50);
        $pdf->Cell(50, 6, 'CURSO', 1, 0, 'C', 1);
        $pdf->Cell(75, 6, utf8_decode($ncur), 1, 1, 'C');
        $pdf->SetX(50);
        $pdf->Cell(50, 6, 'PERIODO', 1, 0, 'C', 1);
        $pdf->Cell(75, 6, utf8_decode($nperi), 1, 1, 'C');
    }

    require 'control/conexion.php';
    $nlista = 1;
    $query = "SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where m.idAnioEscolar='$anio' and m.idGrado='$grado' and m.idSeccion='$secc' and m.est='1' order by a.apepa ";
    $resultado = $mysqli->query($query);
    $pdf->Ln(5);
    $pdf->SetX(50);
    $pdf->SetFont('Arial', 'BU', 11);
    $pdf->Cell(70, 5, 'ALUMNOS DEL CURSO', 1, 1, 'C');
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Ln(5);
    $pdf->SetX(25);
    $pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'C', 1);

    $pdf->Cell(80, 6, 'APELLIDOS Y NOMBRES', 1, 0, 'C', 1);
    for ($i = 1; $i <= $ncomp; $i++) {

        $pdf->Cell(11, 6, 'NOT ' . $i, 1, 0, 'C', 1);
    }


    $pdf->Cell(15, 6, 'PROM', 1, 1, 'C', 1);
    while ($row = $resultado->fetch_array()) {
        $pdf->SetX(25);
        $pdf->Cell(10, 6, $nlista, 1, 0, 'C');
        $pdf->Cell(80, 6, utf8_decode($row[2]), 1, 0, 'C');
        $sql = "SELECT cu.descr,c.descr,na.nota1,na.nota2,na.nota3,na.nota4,na.nota5 FROM notasalumno na join competencias c on na.idComp=c.idComp join matricula m on na.idMatricula=m.idMatricula 
join cursos cu on c.idcurso=cu.idCursos   where na.idMatricula=$row[0] and cu.idCursos=$cur and c.est=1;";
        $notas = $mysqli->query($sql);
        $promedio = 0;
        while ($nota = $notas->fetch_array()) {
            if ($nota[$peri + 1] <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota[$peri + 1] > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if ($nota[$peri + 1] <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($nota[$peri + 1] > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }

            $pdf->Cell(11, 6, utf8_decode(notaprim2($nota[$peri + 1], $modo)), 1, 0, 'C');


            $pdf->SetTextColor(0, 0, 0);




            if ($modo == 1) {
                $promedio = $nota[$peri + 1];
            } else {
                $promedio = $promedio + $nota[$peri + 1];
            }
        }
        if ($promedio <= 0 && $modo == 1) {
            $pdf->SetTextColor(255, 0, 0);
        } else if ($promedio > 0 && $modo == 1) {
            $pdf->SetTextColor(0, 0, 255);
        } else if (round($promedio / $ncomp) <= 10 && $modo == 2) {
            $pdf->SetTextColor(255, 0, 0);
        } else if (round($promedio / $ncomp) > 10 && $modo == 2) {
            $pdf->SetTextColor(0, 0, 255);
        }


        if ($modo == 1) {
            $pdf->Cell(15, 6, notaprim2($promedio, $modo), 1, 1, 'C');
        } else {
            $pdf->Cell(15, 6, notaprim2(round($promedio / $ncomp), $modo), 1, 1, 'C');
        }


        $pdf->SetTextColor(0, 0, 0);
        $nlista++;
    }

    $pdf->Ln(10);
    $pdf->Cell(200, 6, '   __________________________________________________________', 0, 0, 'C', 0);
    $pdf->Ln(6);
    $pdf->Cell(198, 6, '               Firma Docente - ' . utf8_decode($usuario), 0, 0, 'C', 0);
    $modo = "I";
    $nombre_archivo = "Lista_Alumnos_" . $ncur . "_" . $nperi . "_" . $nanio . "_" . $ngrado . "_" . $nsecc . "_" . $ntipo . ".pdf";
    $pdf->Output($nombre_archivo, $modo);
} else {
    for ($f = 1; $f <= 5; $f++) {


        $pdf->AddPage();
        //busqueda de grado
        require 'control/conexion.php';
        $query = "SELECT * FROM grado g 
join tipogrado t on g.idTipo=t.idTipo where g.idGrado='$grado';";
        $resultado = $mysqli->query($query);
        while ($row = $resultado->fetch_array()) {
            $ngrado = utf8_decode($row[1]);
            $ntipo = utf8_decode($row[5]);
            $modo = utf8_decode($row[2]);
            if ($row[0] == 7|| $row[0] == 8 && $anio > 4) {
                $modo = 1;
            }
        }
        //busqueda de seccion
        require 'control/conexion.php';
        $query = "SELECT * FROM seccion where idSeccion='$secc';";
        $resultado = $mysqli->query($query);
        while ($row = $resultado->fetch_array()) {

            $nsecc = utf8_decode($row[1]);
        }
        //busqueda de curso
        require 'control/conexion.php';
        $query = "SELECT * FROM cursos where idCursos='$cur';";
        $resultado = $mysqli->query($query);
        while ($row = $resultado->fetch_array()) {

            $ncur = utf8_decode($row[1]);
        }
        //busqueda de PERIODO
        require 'control/conexion.php';
        $query = "SELECT * FROM periodos where idPeriodos='$f';";
        $resultado = $mysqli->query($query);
        while ($row = $resultado->fetch_array()) {

            $nperi = utf8_decode($row[1]);
        }
        //busqueda de seccion
        require 'control/conexion.php';
        $query = "SELECT * FROM seccion where idSeccion='$secc';";
        $resultado = $mysqli->query($query);
        while ($row = $resultado->fetch_array()) {

            $nsecc = utf8_decode($row[1]);
        }
        //busqueda de NRO DE COMPETENCIAS
        require 'control/conexion.php';
        $query = "SELECT count(idComp) FROM competencias where idcurso='$cur' and est='1';";
        $resultado = $mysqli->query($query);
        while ($row = $resultado->fetch_array()) {

            $ncomp = $row[0];
        }
        //busqueda de año escolar
        require 'control/conexion.php';
        $query = "SELECT * FROM anioescolar where idAnioEscolar='$anio';";
        $resultado = $mysqli->query($query);
        while ($row = $resultado->fetch_array()) {
            $nanio = utf8_decode($row[1]);
            $pdf->Ln(5);
            $pdf->SetX(50);
            $pdf->SetFont('Arial', 'BU', 11);
            $pdf->Cell(50, 5, 'DATOS DEL LISTA ', 1, 1, 'C');
            $pdf->SetFillColor(232, 232, 232);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetX(50);
            $pdf->Cell(125, 6, 'PREMIUM COLLEGE', 1, 1, 'C', 1);

            $pdf->SetX(50);
            $pdf->Cell(50, 6, 'GRADO Y SECCION', 1, 0, 'C', 1);
            $pdf->Cell(75, 6, utf8_decode($ngrado . " " . $nsecc . " (" . $ntipo . ")"), 1, 1, 'C');
            $pdf->SetX(50);
            $pdf->Cell(50, 6, utf8_decode('AÑO ESCOLAR'), 1, 0, 'C', 1);
            $pdf->Cell(75, 6, utf8_decode($nanio), 1, 1, 'C');
            $pdf->SetX(50);
            $pdf->Cell(50, 6, 'CURSO', 1, 0, 'C', 1);
            $pdf->Cell(75, 6, utf8_decode($ncur), 1, 1, 'C');
            $pdf->SetX(50);
            $pdf->Cell(50, 6, 'PERIODO', 1, 0, 'C', 1);
            $pdf->Cell(75, 6, utf8_decode($nperi), 1, 1, 'C');
        }

        require 'control/conexion.php';
        $nlista = 1;
        $query = "SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where m.idAnioEscolar='$anio' and m.idGrado='$grado' and m.idSeccion='$secc' and m.est='1' order by a.apepa ";
        $resultado = $mysqli->query($query);
        $pdf->Ln(5);
        $pdf->SetX(50);
        $pdf->SetFont('Arial', 'BU', 11);
        $pdf->Cell(70, 5, 'ALUMNOS DEL CURSO', 1, 1, 'C');
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln(5);
        $pdf->SetX(25);
        $pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'C', 1);

        $pdf->Cell(80, 6, 'APELLIDOS Y NOMBRES', 1, 0, 'C', 1);
        for ($i = 1; $i <= $ncomp; $i++) {

            $pdf->Cell(11, 6, 'NOT ' . $i, 1, 0, 'C', 1);
        }


        $pdf->Cell(15, 6, 'PROM', 1, 1, 'C', 1);
        while ($row = $resultado->fetch_array()) {
            $pdf->SetX(25);
            $pdf->Cell(10, 6, $nlista, 1, 0, 'C');
            $pdf->Cell(80, 6, utf8_decode($row[2]), 1, 0, 'C');
            $sql = "SELECT cu.descr,c.descr,na.nota1,na.nota2,na.nota3,na.nota4,na.nota5 FROM notasalumno na join competencias c on na.idComp=c.idComp join matricula m on na.idMatricula=m.idMatricula 
join cursos cu on c.idcurso=cu.idCursos   where na.idMatricula=$row[0] and cu.idCursos=$cur and c.est=1;";
            $notas = $mysqli->query($sql);
            $promedio = 0;
            while ($nota = $notas->fetch_array()) {
                if ($nota[$f + 1] <= 0 && $modo == 1) {
                    $pdf->SetTextColor(255, 0, 0);
                } else if ($nota[$f + 1] > 0 && $modo == 1) {
                    $pdf->SetTextColor(0, 0, 255);
                } else if ($nota[$f + 1] <= 10 && $modo == 2) {
                    $pdf->SetTextColor(255, 0, 0);
                } else if ($nota[$f + 1] > 10 && $modo == 2) {
                    $pdf->SetTextColor(0, 0, 255);
                }

                $pdf->Cell(11, 6, utf8_decode(notaprim2($nota[$f + 1], $modo)), 1, 0, 'C');


                $pdf->SetTextColor(0, 0, 0);




                if ($modo == 1) {
                    $promedio = $nota[$f + 1];
                } else {
                    $promedio = $promedio + $nota[$f + 1];
                }
            }
            if ($promedio <= 0 && $modo == 1) {
                $pdf->SetTextColor(255, 0, 0);
            } else if ($promedio > 0 && $modo == 1) {
                $pdf->SetTextColor(0, 0, 255);
            } else if (round($promedio / $ncomp) <= 10 && $modo == 2) {
                $pdf->SetTextColor(255, 0, 0);
            } else if (round($promedio / $ncomp) > 10 && $modo == 2) {
                $pdf->SetTextColor(0, 0, 255);
            }


            if ($modo == 1) {
                $pdf->Cell(15, 6, notaprim2($promedio, $modo), 1, 1, 'C');
            } else {
                $pdf->Cell(15, 6, notaprim2(round($promedio / $ncomp), $modo), 1, 1, 'C');
            }


            $pdf->SetTextColor(0, 0, 0);
            $nlista++;
        }

        $pdf->Ln(10);
        $pdf->Cell(200, 6, '   __________________________________________________________', 0, 0, 'C', 0);
        $pdf->Ln(6);
        $pdf->Cell(198, 6, '               Firma Docente - ' . utf8_decode($usuario), 0, 0, 'C', 0);
    }
    $modo = "I";
    $nombre_archivo = "Lista_Alumnos_" . $ncur . "_ANUAL_" . $nanio . "_" . $ngrado . "_" . $nsecc . "_" . $ntipo . ".pdf";
    $pdf->Output($nombre_archivo, $modo);
}
?>