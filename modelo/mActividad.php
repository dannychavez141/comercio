<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cActividad
 *
 * @author dahelap
 */
include '../modelo/cParticipante.php';
class cActividad {
    //put your code here
    private $idact;
    private $descr;
    private $idgenerado;
    private $generado;
    private $invercion;
    private $participantes;
    function __construct($idact, $descr, $idgenerado, $generado, $invercion, $participantes) {
        $this->idact = $idact;
        $this->descr = $descr;
        $this->idgenerado = $idgenerado;
        $this->generado = $generado;
        $this->invercion = $invercion;
        $this->participantes = $participantes;
    }
    function getIdact() {
        return $this->idact;
    }

    function getDescr() {
        return $this->descr;
    }

    function getIdgenerado() {
        return $this->idgenerado;
    }

    function getGenerado() {
        return $this->generado;
    }

    function getInvercion() {
        return $this->invercion;
    }

    function getParticipantes() {
        return $this->participantes;
    }

    function setIdact($idact) {
        $this->idact = $idact;
    }

    function setDescr($descr) {
        $this->descr = $descr;
    }

    function setIdgenerado($idgenerado) {
        $this->idgenerado = $idgenerado;
    }

    function setGenerado($generado) {
        $this->generado = $generado;
    }

    function setInvercion($invercion) {
        $this->invercion = $invercion;
    }

    function setParticipantes($participantes) {
        $this->participantes = $participantes;
    }


    
}
