<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
include_once '../jwt/JWT.php';
include_once '../control/conexion.php';
include_once '../control/cLogin.php';
$control = null;
if (isset($_POST['ac']) && $control == null) {
    $control = $_POST['ac'];
} else if (isset($_GET['ac']) && $control == null) {
    $control = $_GET['ac'];
}
switch ($control) {
    case 'login':
        if (isset($_POST["user"]) && isset($_POST["pass"])) {
            $datos["user"] = $_POST["user"];
            $datos["pass"] = $_POST["pass"];

            $modelo = new cLogin();
            $datosbd = $modelo->login($datos);
            if (count($datosbd) > 0) {
                $token = $modelo->crearToken($datosbd);
                $msj = array("error" => "IDENTIFICADO",
                    "token" => $token);
                print_r(json_encode($msj));
            } else {
                $msj = array("error" => "NO IDENTIFICADO");
                print_r(json_encode($msj));
            }
        } else {
            $msj = array("error" => "NO IDENTIFICADO");
            print_r(json_encode($msj));
        }
        break;
    case 'validar':
        $token = $_POST["token"];
        $modelo = new cLogin();
        $time = time();
        $resp = $modelo->validar($token);
        $resp = json_encode($resp);
        $resp = json_decode($resp, true);
        $resp ['ahora'] = $time;
        print_r(json_encode($resp));
        break;
    case 'ac':

        break;
    case 'm':

        break;
    default:
        echo "no se recibio las variables" . $control;
        break;
}

