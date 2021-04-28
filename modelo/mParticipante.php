<?php

class cParticipante {
    private $idpartici;
    private   $descr;
    private  $idest;
    private  $estado;
   function __construct($idpartici, $descr, $idest, $estado) {
       $this->idpartici = $idpartici;
       $this->descr = $descr;
       $this->idest = $idest;
       $this->estado = $estado;
   }
   function getIdpartici() {
       return $this->idpartici;
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

   function setIdpartici($idpartici) {
       $this->idpartici = $idpartici;
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
