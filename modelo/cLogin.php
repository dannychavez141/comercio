<?php

class cLogin {

    function login($datos) {
        $conexion = new conexion();
        $bd = $conexion->getBd();
        $sql = "SELECT u.idusuario,u.nombres,u.apellidos,u.user,u.est FROM usuario u where u.user='{$datos['user']}' and pass='{$datos['pass']}';";
        $respuesta = $bd->query($sql);
        if (mysqli_num_rows($respuesta) > 0) {
            $dato = mysqli_fetch_array($respuesta);
            //print_r($dato);
        } else {
            $dato = array();
        }
        return $dato;
    }

    function crearToken($datos) {
        $jmt = new \Firebase\JWT\JWT();
        $tiempo = 1; // Horas
        $time = time();
        $encrypt = array('HS256');
        $token = array(
            'exp' => $time + (3600 * $tiempo),
            'aud' => array(
                'id' => "{$datos['idusuario']}"
            ),
            'data' => array(
                'nombres' => "{$datos['nombres']}",
                'apellidos' => "{$datos['apellidos']}",
                'usuario' => "{$datos['user']}"
            )
        );
        $t = $jmt->encode($token, "1234");
        return $t;
    }

    function validar($token) {
        $jmt = new \Firebase\JWT\JWT();
        $encrypt = array('HS256');
        $e = $jmt->decode($token, "1234", $encrypt);
        return $e;
    }

}
