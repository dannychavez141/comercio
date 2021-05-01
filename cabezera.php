<!DOCTYPE html>
<html lang="es" data-textdirection="premiun" class="loading">
    <?php
//error_reporting(0);
    date_default_timezone_set('America/Lima');
    if (isset($_COOKIE['usuario'])) {

    } else {
        echo"<script language='javascript'>window.location='principal/'</script>;";
        //header("Location: /premium/");
        exit();
    }
    $usuario = $_COOKIE['usuario'];
    $idusuario = $_COOKIE['idUsuario'];
    $idtipo = $_COOKIE['idtipo'];
    $tipo = $_COOKIE['tipo'];
    if ($idtipo == 5 || $idtipo == 4) {

        echo"<script language='javascript'>window.location='login.php'</script>;";
        exit();
    }
    ?>
    <head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="PIXINVENT">
        <title>Premium College-Direccion</title>
        <link rel="apple-touch-icon" sizes="60x60" href="/librerias/app-assets/images/ico/apple-icon-60.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/librerias/app-assets/images/ico/apple-icon-76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/librerias/app-assets/images/ico/apple-icon-120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/librerias/app-assets/images/ico/apple-icon-152.png">
        <link rel="shortcut icon" type="image/x-icon" href="/librerias/app-assets/images/ico/favicon.ico">
        <link rel="shortcut icon" type="image/png" href="/librerias/app-assets/images/ico/favicon-32.png">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
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
        <link rel="stylesheet" type="text/css" href="/librerias/app-assets/css/core/colors/palette-gradient.css">
        <!-- END Page Level CSS-->
        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="/librerias/assets/css/style.css">

        <!-- END Custom CSS-->
        <script src="js/jquery.min.js"></script>
        <script src="js/vue.js"></script>
        <script src="js/axios.min.js"></script>
        <script src="js/md5.js" type="text/javascript"></script>
        <script src="js/bootbox.min.js" type="text/javascript"></script>
    </head>
    <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

        <!-- navbar-fixed-top-->
        <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
            <div class="navbar-wrapper">
                <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
                        <li class="nav-item"><a href="index.php" class="navbar-brand nav-link"><img alt="branding logo" src="/librerias/app-assets/images/logo/robust-logo-light.png" data-expand="/librerias/app-assets/images/logo/robust-logo-light.png" data-collapse="/librerias/app-assets/images/logo/robust-logo-small.png" class="brand-logo"></a></li>
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


                            <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="/librerias/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span><span class="user-name"><?php echo $usuario ?>-<?php echo $tipo ?></span></a>

                                <div class="dropdown-menu dropdown-menu-right"><a href="modUsuario.php?cod=<?php echo $idusuario ?>" class="dropdown-item"><i class="icon-head"></i> Editar Perfil</a><a href="#" class="dropdown-item"></a>
                                    <div class="dropdown-divider"></div><a onclick="cerrar()" class="dropdown-item"><i class="icon-power3"></i> Cerrar Sesion</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- ////////////////////////////////////////////////////////////////////////////-->
        <?php
        if ($idtipo == 1 || $idtipo == 6) {
            ?>

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
                        <li class=" nav-item"><a href="#"><i class="icon-android-contact"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Familiares</span></a>
                            <ul class="menu-content">

                                <li class="navigation-divider"></li>
                                <li><a href="verApoderado.php" data-i18n="nav.page_layouts.boxed_layout" class="menu-item">Ver Familiar</a>
                                </li>
                                <li><a href="regApoderado.php" data-i18n="nav.page_layouts.static_layout" class="menu-item">Registrar Familiar</a>
                                </li>


                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-happy"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Alumnos</span></a>
                            <ul class="menu-content">
                                <li><a href="verAlumno.php" data-i18n="nav.page_layouts.1_column" class="menu-item">Ver Alumnos</a>
                                </li>
                                <li><a href="regAlumno.php" data-i18n="nav.page_layouts.2_columns" class="menu-item">Registrar Alumno</a>
                                </li>
                                <li class="navigation-divider"></li>



                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-android-options"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Grados y Secciones</span></a>
                            <ul class="menu-content">

                                <li><a href="verGrado.php" data-i18n="nav.page_layouts.1_column" class="menu-item">Ver Grados</a>
                                </li>
                                <li><a href="regGrado.php" data-i18n="nav.page_layouts.2_columns" class="menu-item">Registrar Grados</a>
                                </li>
                                <li class="navigation-divider"></li>
                                <li><a href="verSeccion.php" data-i18n="nav.page_layouts.boxed_layout" class="menu-item">Ver Secciones</a>
                                </li>
                                <li><a href="regSeccion.php" data-i18n="nav.page_layouts.static_layout" class="menu-item">Registrar Secciones</a>
                                </li>

                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-briefcase4"></i><span data-i18n="nav.project.main" class="menu-title">Docentes y Trab.</span></a>
                            <ul class="menu-content">
                                <li><a href="verDocente.php" data-i18n="nav.invoice.invoice_template" class="menu-item">Ver Docentes</a>
                                </li>
                                <li><a href="regDocente.php" data-i18n="nav.gallery_pages.gallery_grid" class="menu-item">Registrar Docente</a>
                                </li>
                                <li><a href="verDocenteAsig.php" data-i18n="nav.gallery_pages.gallery_grid" class="menu-item">Asignar Cursos a Docentes</a>
                                </li>
                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-ios-albums-outline"></i><span data-i18n="nav.cards.main" class="menu-title">Cursos</span></a>
                            <ul class="menu-content">
                                <li><a href="verCurso.php" data-i18n="nav.cards.card_bootstrap" class="menu-item">Ver Cursos</a>
                                </li>
                                <li><a href="regCurso.php" data-i18n="nav.cards.card_actions" class="menu-item">Registrar Curso</a>
                                </li>


                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Competencias</a>
                                    <ul class="menu-content">
                                        <li><a href="verCursoPrim.php" data-i18n="nav.error_pages.error_400" class="menu-item">Cursos Inicial y Primaria</a>
                                        </li>
                                        <li><a href="verCursoSecu.php" data-i18n="nav.error_pages.error_401" class="menu-item">Cursos Secundaria</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-whatshot"></i><span data-i18n="nav.advance_cards.main" class="menu-title">Matriculas</span></a>
                            <ul class="menu-content">

                                <li><a href="verMatPrim.php" data-i18n="nav.cards.card_charts" class="menu-item">Ver Matriculas Inicial y Primaria</a>
                                </li>
                                <li><a href="verMatSecu.php" data-i18n="nav.cards.card_charts" class="menu-item">Ver Matricular Secundaria</a>
                                </li>
                                <li><a href="verTodasMatriculas.php" data-i18n="nav.cards.card_charts" class="menu-item">Ver Todas Las Matriculas</a>
                                </li>


                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Registrar Matricula</a>
                                    <ul class="menu-content">
                                        <li><a href="regMatPrim.php" data-i18n="nav.cards.card_charts" class="menu-item">Matricular Inicial y Primaria</a>
                                        </li>
                                        <li><a href="regMatSecu.php" data-i18n="nav.cards.card_charts" class="menu-item">Matricular Secundaria</a>
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-map22"></i><span data-i18n="nav.content.main" class="menu-title">Boleta de Notas</span></a>
                            <ul class="menu-content">
                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Ingresar Notas</a>
                                    <ul class="menu-content">
                                        <li><a href="selecCurPrim.php" data-i18n="nav.error_pages.error_400" class="menu-item">Inicial y Primaria</a>
                                        </li>
                                        <li><a href="selecCurSecu.php" data-i18n="nav.error_pages.error_401" class="menu-item">Secundaria</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Ver Boletas Notas</a>
                                    <ul class="menu-content">
                                        <li><a href="verNotPrim.php" data-i18n="nav.error_pages.error_400" class="menu-item">Inicial y Primaria</a>
                                        </li>
                                        <li><a href="verNotSecu.php" data-i18n="nav.error_pages.error_401" class="menu-item">Secundaria</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Exportar Resumen </a>
                                    <ul class="menu-content">
                                        <li><a href="reporteexcel.php" data-i18n="nav.error_pages.error_400" class="menu-item">Exportar</a>
                                        </li>


                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-alert"></i><span data-i18n="nav.google_charts.main" class="menu-title">Incidencias</span></a>
                            <ul class="menu-content">
                                <li><a href="selecAlumnoInsidencia.php" data-i18n="nav.google_charts.google_bar_charts" class="menu-item">Ver Incidencias</a>
                                </li>
                                <li><a href="regInsidencia.php" data-i18n="nav.google_charts.google_bar_charts" class="menu-item">Registrar Incidencia</a>
                                </li>


                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-table2"></i><span data-i18n="nav.google_charts.main" class="menu-title">Asistencias</span></a>
                            <ul class="menu-content">
                                <li><a href="verAsistencias.php" data-i18n="nav.google_charts.google_bar_charts" class="menu-item">Ver Asitencias Alumnos</a>
                                </li>
                                <li><a href="verDoncenteAsistencia.php" data-i18n="nav.google_charts.google_bar_charts" class="menu-item">Ver Asitencias Docentes</a>
                                </li>

                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-bar-graph-2"></i><span data-i18n="nav.google_charts.main" class="menu-title">Caja</span></a>
                            <ul class="menu-content">
                                <li><a href="verDeudas.php" data-i18n="nav.google_charts.google_bar_charts" class="menu-item">Ver Deudas Registradas</a>
                                </li>
                                <li><a href="regDeuda.php" data-i18n="nav.google_charts.google_line_charts" class="menu-item">Registrar Deudas</a>
                                </li>
                                <li><a href="verPagos.php" data-i18n="nav.google_charts.google_pie_charts" class="menu-item">Ver Pagos Recibidos</a>
                                </li>
                                <li><a href="compromisos.php" class="menu-item">Compromisos de Pagos</a>
                                </li>
                            </ul>
                        </li>

                        <li class=" nav-item"><a href="#"><i class="icon-layout"></i><span data-i18n="nav.components.main" class="menu-title">Periodico Mural</span></a>
                            <ul class="menu-content">

                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Calendario Civico</a>
                                    <ul class="menu-content">
                                        <li><a href="regFechas.php" data-i18n="nav.error_pages.error_400" class="menu-item">Agregar fecha</a>
                                        </li>
                                        <li><a href="verFechas.php" data-i18n="nav.error_pages.error_400" class="menu-item">Ver Fechas</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Alumnos de la semana</a>
                                    <ul class="menu-content">
                                        <li><a href="verElegidos.php" data-i18n="nav.error_pages.error_400" class="menu-item">Ver Actual</a>
                                        </li>
                                        <li><a href="regElegidos.php" data-i18n="nav.error_pages.error_400" class="menu-item">Cambiar</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Padres de la semana</a>
                                    <ul class="menu-content">
                                        <li><a href="verPadresElegidos.php" data-i18n="nav.error_pages.error_400" class="menu-item">Ver Actual</a>
                                        </li>
                                        <li><a href="regPadresElegidos.php" data-i18n="nav.error_pages.error_400" class="menu-item">Cambiar</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Videos</a>
                                    <ul class="menu-content">
                                        <li><a href="video.php" data-i18n="nav.error_pages.error_400" class="menu-item">Ver Actual</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-settings"></i><span data-i18n="nav.components.main" class="menu-title">Mantenimiento</span></a>
                            <ul class="menu-content">
                                <!--
                                              <li><a href="mantenimiento.php" data-i18n="nav.components.component_alerts" class="menu-item">Tipo de Apoderado</a>
                                              </li>
                                -->
                                <li><a href="verPeriodos.php" data-i18n="nav.components.component_alerts" class="menu-item">Periodos</a>
                                </li>
                                <li><a href="horarios.php" data-i18n="nav.components.component_alerts" class="menu-item">Horarios</a>
                                </li>
                                <li><a href="ClassRoom.php" data-i18n="nav.components.component_alerts" class="menu-item">ClassRoom</a>
                                </li>
                                <li><a href="Vsolicitudes.php" data-i18n="nav.components.component_alerts" class="menu-item">Solicitudes</a>
                                </li>
                                <!--
                                <li><a href="mantenimiento.php" data-i18n="nav.components.components_buttons.component_buttons_basic" class="menu-item">Tipo de Deuda</a>
                                </li> -->
                                <li><a href="niveleducativo.php" data-i18n="nav.components.component_carousel" class="menu-item">Tipo de Niveles Educativos</a>

                                <li><a href="mantenimiento.php" data-i18n="nav.components.component_collapse" class="menu-item">Tipo Usuario</a>
                                </li>

                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Año Escolar</a>
                                    <ul class="menu-content">
                                        <li><a href="regAnio.php" data-i18n="nav.error_pages.error_400" class="menu-item">Crear Año Escolar</a>
                                        </li>
                                        <li><a href="verAnio.php" data-i18n="nav.error_pages.error_400" class="menu-item">Ver Año Escolares</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Usuarios</a>
                                    <ul class="menu-content">
                                        <li><a href="verUsuarios.php" data-i18n="nav.error_pages.error_400" class="menu-item">Ver Usuarios</a>
                                        </li>
                                        <li><a href="regUsuario.php" data-i18n="nav.error_pages.error_400" class="menu-item">Registrar Usuario</a>
                                        </li>


                                    </ul>
                                </li>

                            </ul>
                        <li class=" nav-item"><a href="#"><i class="icon-newspaper"></i><span data-i18n="nav.icons.main" class="menu-title">Targetas RFID</span></a>
                            <ul class="menu-content">
                                <li><a href="verTarjeta.php" data-i18n="nav.icons.icons_feather" class="menu-item">VER targetas Asignadas</a>
                                </li>


                            </ul>
                        </li>

                     <!--  <li class=" nav-item"><a href="#"><i class="icon-eye6"></i><span data-i18n="nav.icons.main" class="menu-title">Historial</span></a>
                        <ul class="menu-content">
                          <li><a href="mantenimiento.php" data-i18n="nav.icons.icons_feather" class="menu-item">Cambios Por dia</a>
                          </li>
                          <li><a href="mantenimiento.php" data-i18n="nav.icons.icons_ionicons" class="menu-item">Cambios Por Mes</a>
                          </li>
                          <li><a href="mantenimiento.php" data-i18n="nav.icons.icons_fps_line" class="menu-item">Cambios Por Usuarios</a>
                          </li>
                          <li><a href="mantenimiento.php" data-i18n="nav.icons.icons_ico_moon" class="menu-item">Cambios en Notas</a>
                          </li>
                        </ul>
                          </li>-->




                </div>

                <!-- /main menu content-->
                <!-- main menu footer-->
                <!-- include includes/menu-footer-->
                <!-- main menu footer-->
            </div>
            <!-- / main menu-->
        <?php } else if ($idtipo == 3) {
            ?>

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
                        <li class=" nav-item"><a href="#"><i class="icon-android-contact"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Familiares</span></a>
                            <ul class="menu-content">

                                <li class="navigation-divider"></li>
                                <li><a href="verApoderado.php" data-i18n="nav.page_layouts.boxed_layout" class="menu-item">Ver Familiar</a>
                                </li>
                                <li><a href="regApoderado.php" data-i18n="nav.page_layouts.static_layout" class="menu-item">Registrar Familiar</a>
                                </li>


                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-happy"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Alumnos</span></a>
                            <ul class="menu-content">
                                <li><a href="verAlumno.php" data-i18n="nav.page_layouts.1_column" class="menu-item">Ver Alumnos</a>
                                </li>

                            </ul>
                        </li>

                        <li class=" nav-item"><a href="#"><i class="icon-whatshot"></i><span data-i18n="nav.advance_cards.main" class="menu-title">Matriculas</span></a>
                            <ul class="menu-content">

                                <li><a href="verMatPrim.php" data-i18n="nav.cards.card_charts" class="menu-item">Ver Matriculas Inicial y Primaria</a>
                                </li>
                                <li><a href="verMatSecu.php" data-i18n="nav.cards.card_charts" class="menu-item">Ver Matricular Secundaria</a>
                                </li>


                            </ul>
                        </li>
                        <li class=" nav-item"><a href="#"><i class="icon-map22"></i><span data-i18n="nav.content.main" class="menu-title">Boleta de Notas</span></a>
                            <ul class="menu-content">

                                <li><a href="#" data-i18n="nav.error_pages.main" class="menu-item">Ver Boletas Notas</a>
                                    <ul class="menu-content">
                                        <li><a href="verNotPrim.php" data-i18n="nav.error_pages.error_400" class="menu-item">Inicial y Primaria</a>
                                        </li>
                                        <li><a href="verNotSecu.php" data-i18n="nav.error_pages.error_401" class="menu-item">Secundaria</a>
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                        </li>

                        <li class=" nav-item"><a href="#"><i class="icon-bar-graph-2"></i><span data-i18n="nav.google_charts.main" class="menu-title">Caja</span></a>
                            <ul class="menu-content">
                                <li><a href="verDeudas.php" data-i18n="nav.google_charts.google_bar_charts" class="menu-item">Ver Deudas Registradas</a>
                                </li>
                                <li><a href="regDeuda.php" data-i18n="nav.google_charts.google_line_charts" class="menu-item">Registrar Deudas</a>
                                </li>
                                <li><a href="verPagos.php" data-i18n="nav.google_charts.google_pie_charts" class="menu-item">Ver Pagos Recibidos</a>
                                </li>
                                <li><a href="compromisos.php" class="menu-item">Compromisos de Pagos</a>
                                </li>
                            </ul>
                        </li>

                </div>

                <!-- /main menu content-->
                <!-- main menu footer-->
                <!-- include includes/menu-footer-->
                <!-- main menu footer-->
            </div>
            <!-- / main menu-->
        <?php } ?>

    </body>
</html>
