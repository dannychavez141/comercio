<!DOCTYPE html>
<?php
session_start();
if (isset($_COOKIE['usuario'])) {
    $usuario = $_COOKIE['usuario'];
    $idusuario = $_COOKIE['idUsuario'];
    $idtipo = $_COOKIE['idtipo'];
    $tipo = $_COOKIE['tipo'];
    if ($idtipo == 1 || $idtipo == 3) {
        header("Location: index.php");
        exit();
    }
    if ($idtipo == 2) {
        header("Location: cafetin/index.php");
        exit();
    }
    if ($idtipo == 4) {
        header("Location: docentes/index.php");
        exit();
    }
    if ($idtipo == 5) {
        header("Location: familiares/index.php");
        exit();
    }
}
if (isset($_GET['msj'])) {
    $ms = $_GET['msj'];
    if ($ms == true) {
        echo "<script>alert('EL DNI O LA CONTRASEÑA SON ERRONEOS');</script>";
    }
}
?>
<html lang="en" data-textdirection="ltr" class="loading">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="PIXINVENT">
        <title>Comercio N°64</title>
        <!-- BEGIN VENDOR CSS-->
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/css/bootstrap.css">
        <!-- font icons-->
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/fonts/icomoon.css">
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/vendors/css/extensions/pace.css">
        <!-- END VENDOR CSS-->
        <!-- BEGIN ROBUST CSS-->
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/css/bootstrap-extended.css">
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/css/app.css">
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/css/colors.css">
        <!-- END ROBUST CSS-->
        <!-- BEGIN Page Level CSS-->
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/css/pages/coming-soon.css">
        <!-- END Page Level CSS-->
        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="/librerias/assets/css/style.css">
        <!-- END Custom CSS-->
    </head>
    <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column comingsoonFlat blank-page blank-page">
        <!-- ////////////////////////////////////////////////////////////////////////////-->
        <div class="app-content content container-fluid">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body"><!-- coming soon flat design -->
                    <br>
                    <br><br>
                    <section id="basic-modals">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">INICIO DE SESION</h4>
                                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-body collapse in">
                                        <div class="card-block">
                                            <div class="row my-2">

                                                <div class="col-lg-4 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <h5>PADRES DE FAMILIA</h5>
                                                        <p> Este acceso permitirá a los padres ver el progreso actual de sus hijos en sus estudios, así mismo sus asistencias e incidencias.</p>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-outline-primary block btn-lg" data-toggle="modal" data-target="#iconModal1">
                                                            Inicio Padres 
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade text-xs-left" id="iconModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel2"><i class="icon-road2"></i>Inicio Sesión Padres</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card-header no-border">
                                                                            <div class="card-title text-xs-center">
                                                                                <div class="p-1"><img src="img/logo.png" alt="branding logo" width="100" height="100"></div>
                                                                            </div>
                                                                            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Ingrese datos para Inicio Sesión</span></h6>
                                                                        </div>
                                                                        <div class="card-body collapse in">
                                                                            <div class="card-block">
                                                                                <form class="form-horizontal form-simple" action="control/validar1.php" method="post">
                                                                                    <center>USUARIO:</center>
                                                                                    <fieldset class="form-group position-relative has-icon-left mb-0">

                                                                                        <input type="text" class="form-control form-control-lg input-lg" id="user-name" name="txtusuario" placeholder="Su DNI" required>
                                                                                        <div class="form-control-position">
                                                                                            <i class="icon-head"></i>
                                                                                        </div>
                                                                                    </fieldset> 
                                                                                    <center> CONTRASEÑA:</center>
                                                                                    <fieldset class="form-group position-relative has-icon-left">

                                                                                        <input type="password" class="form-control form-control-lg input-lg" id="user-password" name="txtpass" placeholder="Su Contraseña" required>
                                                                                        <div class="form-control-position">
                                                                                            <i class="icon-key3"></i>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                    <fieldset class="form-group row">
                                                                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                                                                            <fieldset>

                                                                                            </fieldset>
                                                                                        </div>

                                                                                    </fieldset>
                                                                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Ingresar</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                    <div class="modal-footer">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body collapse in">
                                        <div class="card-block">
                                            <div class="row my-2">

                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <h5>DOCENTES</h5>
                                                        <p> Este acceso permitirá a los docentes subir las notas e incidencias de alumnos.</p>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-outline-primary block btn-lg" data-toggle="modal" data-target="#iconModal2">
                                                            Inicio Docentes 
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade text-xs-left" id="iconModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel2"><i class="icon-road2"></i>Inicio Sesion Docentes</h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="card-header no-border">
                                                                            <div class="card-title text-xs-center">
                                                                                <div class="p-1"><img src="img/logo.png" alt="branding logo" width="100" height="100"></div>
                                                                            </div>
                                                                            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Ingrese datos para Iniciar Sesion</span></h6>
                                                                        </div>
                                                                        <div class="card-body collapse in">
                                                                            <div class="card-block">
                                                                                <form class="form-horizontal form-simple" action="control/validar2.php" method="post">
                                                                                    <center>USUARIO:</center>
                                                                                    <fieldset class="form-group position-relative has-icon-left mb-0">

                                                                                        <input type="text" class="form-control form-control-lg input-lg" id="user-name" name="txtusuario" placeholder="Su DNI" required>
                                                                                        <div class="form-control-position">
                                                                                            <i class="icon-head"></i>
                                                                                        </div>
                                                                                    </fieldset> 
                                                                                    <center> CONTRASEÑA:</center>
                                                                                    <fieldset class="form-group position-relative has-icon-left">

                                                                                        <input type="password" class="form-control form-control-lg input-lg" id="user-password" name="txtpass" placeholder="Su Contraseña" required>
                                                                                        <div class="form-control-position">
                                                                                            <i class="icon-key3"></i>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                    <fieldset class="form-group row">
                                                                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                                                                            <fieldset>

                                                                                            </fieldset>
                                                                                        </div>

                                                                                    </fieldset>
                                                                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Ingresar</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body collapse in">
                                        <div class="card-block">
                                            <div class="row my-2">

                                                <div class="col-lg-4 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <h5>DIRECCION</h5>
                                                        <p> Este acceso del director y áreas internas.</p>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-outline-primary block btn-lg" data-toggle="modal" data-target="#iconModal3">
                                                            Inicio Direccion 
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade text-xs-left" id="iconModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel2"><i class="icon-road2"></i>Inicio Sesion Direccion</h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <div class="card-header no-border">
                                                                            <div class="card-title text-xs-center">
                                                                                <div class="p-1"><img src="img/logo.png" alt="branding logo" width="100" height="100"></div>
                                                                            </div>
                                                                            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Ingrese datos para Iniciar Sesion</span></h6>
                                                                        </div>
                                                                        <div class="card-body collapse in">
                                                                            <div class="card-block">
                                                                                <form class="form-horizontal form-simple" action="control/validar3.php" method="post">
                                                                                    <center>USUARIO:</center>
                                                                                    <fieldset class="form-group position-relative has-icon-left mb-0">

                                                                                        <input type="text" class="form-control form-control-lg input-lg" id="user-name" name="txtusuario" placeholder="Su DNI" required>
                                                                                        <div class="form-control-position">
                                                                                            <i class="icon-head"></i>
                                                                                        </div>
                                                                                    </fieldset> 
                                                                                    <center> CONTRASEÑA:</center>
                                                                                    <fieldset class="form-group position-relative has-icon-left">

                                                                                        <input type="password" class="form-control form-control-lg input-lg" id="user-password" name="txtpass" placeholder="Su Contraseña" required>
                                                                                        <div class="form-control-position">
                                                                                            <i class="icon-key3"></i>
                                                                                        </div>
                                                                                    </fieldset>
                                                                                    <fieldset class="form-group row">
                                                                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                                                                            <fieldset>

                                                                                            </fieldset>
                                                                                        </div>

                                                                                    </fieldset>
                                                                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Ingresar</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div><div class="card-body collapse in">
                                            <div class="card-block">
                                                <div class="row my-2">

                                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                                        <div class="form-group">

                                                            <!-- Button trigger modal -->
                                                            <a href="index.php"> <button type="button" class="btn btn-danger block btn-lg" >
                                                                    VOLVER A INICIO
                                                                </button>
                                                            </a>
                                                            <!-- Modal -->

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Basic Modals end -->


                </div>
            </div>
        </div>

        <!-- ////////////////////////////////////////////////////////////////////////////-->

        <!-- BEGIN VENDOR JS-->
        <script src="/librerias/app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
        <script src="/librerias/app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
        <script src="/librerias/app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
        <script src="/librerias/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
        <script src="/librerias/app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
        <script src="/librerias/app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
        <script src="/librerias/app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
        <script src="/librerias/app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
        <script src="/librerias/app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
        <!-- BEGIN VENDOR JS-->
        <!-- BEGIN PAGE VENDOR JS-->
        <script src="/librerias/app-assets/vendors/js/coming-soon/jquery.countdown.min.js" type="text/javascript"></script>
        <!-- END PAGE VENDOR JS-->
        <!-- BEGIN ROBUST JS-->
        <script src="/librerias/app-assets/js/core/app-menu.js" type="text/javascript"></script>
        <script src="/librerias/app-assets/js/core/app.js" type="text/javascript"></script>
        <!-- END ROBUST JS-->
        <!-- BEGIN PAGE LEVEL JS-->
        <script src="/librerias/app-assets/js/scripts/coming-soon/coming-soon.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL JS-->
    </body>
</html>
