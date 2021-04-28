<?php
// Inicializar la sesión.
//setcookie('usuario','',time()-1,'/',"premiumcollege.edu.pe");
//setcookie('idUsuario','',time()-1,'/',"premiumcollege.edu.pe");
//setcookie('idtipo','',time()-1,'/',"premiumcollege.edu.pe");
//setcookie('tipo','',time()-1,'/',"premiumcollege.edu.pe");

setcookie('usuario','',time()-1,'/');
setcookie('idUsuario','',time()-1,'/');
setcookie('idtipo','',time()-1,'/');
setcookie('tipo','',time()-1,'/');

unset($_COOKIE["usuario"]);
unset($_COOKIE["idUsuario"]);
unset($_COOKIE["idtipo"]);
unset($_COOKIE["tipo"]);
header("Location: ../login.php");
?>