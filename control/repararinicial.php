<?php
include './cConexion.php';
include '../modelo/dboMatricula.php';
$dbomatricula=new dboMatricula();
$dbomatricula->crearnotas(3);