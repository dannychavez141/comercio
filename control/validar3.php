<?php

require './conexion.php';
if (isset($_POST['txtusuario'])) {
    //VARIABLES DEL USUARIO
    $usuario = $_POST['txtusuario'];
    $pass = $_POST['txtpass'];
    echo $usuario . "/" . $pass;
//VALIDAR CONTENIDO EN LAS VARIABLES O CAJAS DE TEXTO
    if (empty($usuario) | empty($pass)) {
        header("Location: ../index.php");
        exit();
    }
    echo $usuario . "/" . $pass;
//VALIDANDO EXISTENCIA DEL USUARIO
    $sqlQ = "SELECT * FROM usuario u
join tipousuario t on u.idTipoUsuario=t.idTipoUsuario 
where u.dni='$usuario' and u.pass='$pass' and u.est='1';";

    $sql = $mysqli->query($sqlQ);
    echo $sqlQ;
    if ($row = $sql->fetch_array()) {
//		setcookie('usuario',$row[3].' '.$row[4].' '.$row[2],time()+80000,'/',"premiumcollege.edu.pe");
//		setcookie('idUsuario',$row[0],time()+80000,'/',"premiumcollege.edu.pe");
//		setcookie('idtipo',$row[13],time()+80000,'/',"premiumcollege.edu.pe");
//		setcookie('tipo',$row[14],time()+80000,'/',"premiumcollege.edu.pe");

        setcookie('usuario', $row[3] . ' ' . $row[4] . ' ' . $row[2], time() + 8000, '/');
        setcookie('idUsuario', $row[0], time() + 8000, '/');
        setcookie('idtipo', $row[13], time() + 8000, '/');
        setcookie('tipo', $row[14], time() + 8000, '/');

        if ($row[13] != 1) {
            header("Location: ../index.php");
            exit();
        } else {
            require 'generardeudas.php';
            $sql = "INSERT INTO `historial` (`idUsuario`, `tabla`, `id`, `tablamod`, `descr`, `fecha`, `hora`) 
VALUES ($row[0], 'usuario', '$row[0]','usuario', 'Inicio de Sesion " . $row[3] . ' ' . $row[4] . ' ' . $row[2] . "', now(),now());";
            // echo $sql;
            $rs = $mysqli->query($sql);
            header("Location: ../index.php");
            exit();
        }
    } else {

        header("Location: ../login.php?msj=true");
        exit();
    }
}
?>