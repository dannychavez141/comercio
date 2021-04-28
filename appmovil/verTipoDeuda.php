<?php
include '../control/cConexion.php';
include '../modelo/mTipoDeuda.php';

$mtipodeuda= new mTipoDeuda();
$mtipodeuda->verDeudas();
