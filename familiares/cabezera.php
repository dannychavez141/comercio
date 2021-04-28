<!DOCTYPE html>
<html lang="en" data-textdirection="premiun" class="loading">
<?php
if (isset($_COOKIE['usuario'])) {
    echo "";
}else{
    header("Location: ../premium/index.php");
    exit();
}
$usuario=$_COOKIE['usuario'];
$idusuario=$_COOKIE['idUsuario'];
$idtipo=$_COOKIE['idtipo'];
$tipo=$_COOKIE['tipo'];
if ($idtipo!=5) {
    header("Location: ../premium/");
    exit();
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Premium College-Familiares</title>
    <link rel="apple-touch-icon" sizes="60x60" href="../librerias/app-assets/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../librerias/app-assets/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../librerias/app-assets/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../librerias/app-assets/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="/librerias/app-assets/images/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="../librerias/app-assets/images/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/css/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/vendors/css/extensions/pace.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/css/colors.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="../librerias/app-assets/css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../librerias/assets/css/style.css">

    <!-- END Custom CSS-->
    <script src="js/jquery.min.js"></script>
    <script src="js/vue.js"></script>
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <!-- navbar-fixed-top-->
    <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
            <li class="nav-item"><a href="index.php" class="navbar-brand nav-link"><img alt="branding logo" src="../librerias/app-assets/images/logo/robust-logo-light.png" data-expand="../librerias/app-assets/images/logo/robust-logo-light.png" data-collapse="../librerias/app-assets/images/logo/robust-logo-small.png" class="brand-logo" ></a></li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
              <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>
              
            </ul>
            <ul class="nav navbar-nav float-xs-right">
              
              
              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="../librerias/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span><span class="user-name"><?php echo $usuario ?>-<?php echo $tipo ?></span></a>
                
                <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item"></a>
                  <div class="dropdown-divider"></div><a onclick="cerrar()" class="dropdown-item"><i class="icon-power3"></i> Cerrar Sesion</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <!-- main menu-->
    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
      
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <li class=" nav-item"><a href="index.php"><i class="icon-home3"></i><span data-i18n="nav.dash.main" class="menu-title">Tableros</span></a>
            <ul class="menu-content">
              <li><a href="index.php" data-i18n="nav.dash.main" class="menu-item">Tablero de control</a>
              </li>
              
            </ul>
          </li>
          
          <li class=" nav-item"><a href="#"><i class="icon-happy"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Alumnos a su Cargo</span></a>
            <ul class="menu-content">
              <li><a href="verAlumno.php" data-i18n="nav.page_layouts.1_column" class="menu-item">Ver Alumnos</a>
              </li>
              <li><a href="verMatriculas.php" data-i18n="nav.page_layouts.1_column" class="menu-item">Ver Matriculas</a>
              </li>
              <li><a href="verNotas.php" data-i18n="nav.page_layouts.1_column" class="menu-item">Ver Notas</a>
              </li>
              <li><a href="verAsistencias.php" data-i18n="nav.page_layouts.1_column" class="menu-item">Ver Asistencias</a>
              </li>
              <li><a href="verIncidencias.php" data-i18n="nav.page_layouts.1_column" class="menu-item">Ver Insidencias</a>
              </li>
             
               <li class="navigation-divider"></li>
             
             
             
            </ul>
          </li>
       <!--    <li class=" nav-item"><a href="#"><i class="icon-android-options"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Deudas y pagos</span></a>
            <ul class="menu-content">
              
             <li><a href="verDeudas.php" data-i18n="nav.page_layouts.1_column" class="menu-item">Ver Deudas Pendietes</a>
              </li>
              <li><a href="verPagos.php" data-i18n="nav.page_layouts.2_columns" class="menu-item">Ver Pagos Realizados</a>
              </li>
            </ul>
          </li>-->
          
        </ul>
      </div>
      <!-- /main menu content-->
      <!-- main menu footer-->
      <!-- include includes/menu-footer-->
      <!-- main menu footer-->
    </div>
    <!-- / main menu-->


  </body>
</html>
