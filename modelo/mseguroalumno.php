<?php

class mseguroalumno {
    private $dni;
    private $alumno;
    private $idtipo;
    private $tipo;
    private $adicional;
    function __construct($dni, $alumno, $idtipo, $tipo, $adicional) {
        $this->dni = $dni;
        $this->alumno = $alumno;
        $this->idtipo = $idtipo;
        $this->tipo = $tipo;
        $this->adicional = $adicional;
    }

    function getDni() {
        return $this->dni;
    }

    function getAlumno() {
        return $this->alumno;
    }

    function getIdtipo() {
        return $this->idtipo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getAdicional() {
        return $this->adicional;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setAlumno($alumno) {
        $this->alumno = $alumno;
    }

    function setIdtipo($idtipo) {
        $this->idtipo = $idtipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setAdicional($adicional) {
        $this->adicional = $adicional;
    }


}
