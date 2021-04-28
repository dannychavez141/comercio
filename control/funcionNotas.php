<?php
function notaprim($nota, $tipo, $anio) {
    //  if ($tipo == 7 || $anio > 4) {
    if ($tipo == 7 || $tipo == 8 && $anio > 4) {
        $notaletras = 'NE';
        if ($nota == 0) {
            $notaletras = 'C';
        }
        if ($nota == 1) {
            $notaletras = 'B';
        }
        if ($nota == 2) {
            $notaletras = 'A';
        }
        if ($nota == 3) {
            $notaletras = 'AD';
        }
    } else {
        if ($nota == -1) {
            $notaletras = 'NE';
        } else {
            $notaletras = $nota;
        }
    }
    return $notaletras;
}
function notaprim2($nota, $modo) {

    if ($modo == 1) {
        $notaletras = 'NE';
        if ($nota == 0) {
            $notaletras = 'C';
        }
        if ($nota == 1) {
            $notaletras = 'B';
        }
        if ($nota == 2) {
            $notaletras = 'A';
        }
        if ($nota == 3) {
            $notaletras = 'AD';
        }
    } else {
        if ($nota == -1) {
            $notaletras = 'NE';
        } else {
            $notaletras = $nota;
        }
    }
    return $notaletras;
}