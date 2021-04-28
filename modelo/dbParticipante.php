<?php

include '../control/cConexion.php';
include '../modelo/mParticipante.php';

class dbparticipante {

    function ver_participantes($bus) {
        $bd = new cConexion();
        $sql = "call verparticipantes('$bus')";
        $sqlbd = $bd->getBd();
        $participantesbd = $sqlbd->query($sql);
        

        return $participantesbd;
    }

    function crearParticipantes(cParticipante $parti) {
        $bd = new cConexion();
        $sql = "call crearparticipante('{$parti->getIdpartici()}','{$parti->getDescr()}','{$parti->getIdest()}')";
        $sqlbd = $bd->getBd();
        return $sqlbd->query($sql);
        ;
    }

    function modParticipantes(cParticipante $parti) {
        $bd = new cConexion();
        $sql = "call modiparticipante('{$parti->getIdpartici()}','{$parti->getDescr()}','{$parti->getIdest()}')";
        $sqlbd = $bd->getBd();
        return $sqlbd->query($sql);
        ;
    }

}
