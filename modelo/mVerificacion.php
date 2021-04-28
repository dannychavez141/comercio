<?php

class mVerificacion {

    function validarInicio() {

        $validado = true;
        date_default_timezone_set('America/Lima');
        if (isset($_COOKIE['usuario'])) {
            $validado = true;
        } else {
            $validado = false;
        }
        return $validado;
    }

    function getUsuario() {
        $usuario = Array();
        $usuario['datos'] = $_COOKIE['usuario'];
        $usuario['id'] = $_COOKIE['idUsuario'];
        $usuario['idtipo'] = $_COOKIE['idtipo'];
        $usuario['tipo'] = $_COOKIE['tipo'];
        return $usuario;
    }

}
