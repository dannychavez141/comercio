<?php

include './cConexion.php';
include '../modelo/dboanioescolar.php';
include '../modelo/dboDeuda.php';
include '../modelo/dboMatricula.php';
$dboanio = new dboanioescolar();
$dbodeudas = new dboDeuda();
$anio = $dboanio->ultimoanio();
//echo $anio[0] . $anio[1] . "<br>";
$an = date('Y');
$mes = date('m');
$dia = date('m');
//echo $an . '<br>';
if ($an == $anio[1]) {
    if ($mes >= 3) {
        $matriculasbd = new dboMatricula();
        $matriculados = $matriculasbd->vermatriculasactivas($anio[0]);
        if (count($matriculados) > 0) {

            foreach ($matriculados as $matricula) {
                echo $matricula[0] . "-" . $matricula[1] . "<br>";
                $Deudas = $dbodeudas->verdeudasmat($matricula[0]);

                if (count($Deudas) > 0) {
                 //   echo "pencion ya creada<br>";
                } else {
                    $dbodeudas->crearDeuda($matricula[0], $an, $mes, $matricula[1]);
                 //   echo "se creara pencion<br>";
                }
            }
        } else {
            //echo "No hay matriculas";
        }
    } else {
      //  echo "aun no comienzan las clases";
    }
} else {
   // echo "ya acabo el año academico";
}
/*$deudasactivas = $dbodeudas->verDeudasActivas();
$hoy = $dbodeudas->fechahoy();
foreach ($deudasactivas as $deuda) {
    $diaspasados = $dbodeudas->diferenciadias($deuda[5],$hoy );

    if ($diaspasados > 0) {
       // echo $diaspasados ."/".$deuda[5]. "VENCIO Y GENERANDO INTERESES<br>";
        $dbodeudas->generarinteres($deuda[0], $diaspasados);
    } else {
        //echo $diaspasados ."/".$deuda[5]. " FALTA PARA QUE VENZA<br>";
    }
}*/