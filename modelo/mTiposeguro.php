<?php  
/**
 * summary
 */
class mTiposeguro 
{ 
    private $id;
    private $descr;
    private  $idest;
    private $estado;
    function __construct($id, $descr, $idest, $estado) {
        $this->id = $id;
        $this->descr = $descr;
        $this->idest = $idest;
        $this->estado = $estado;
    }
    function getId() {
        return $this->id;
    }

    function getDescr() {
        return $this->descr;
    }

    function getIdest() {
        return $this->idest;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescr($descr) {
        $this->descr = $descr;
    }

    function setIdest($idest) {
        $this->idest = $idest;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }


}