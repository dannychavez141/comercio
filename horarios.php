<!DOCTYPE html>

<html>
    <?php
    include './cabezera.php';
    ?>

    <body>

        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active"><a href="#">Horarios</a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="app-content content container-fluid" id="registro">
            <div class="content-wrapper">
                <div class="content-body">
                    <!-- Basic form layout section start -->
                    <section id="basic-form-layouts">
                        <div class="row match-height">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title" id="basic-layout-form">Horarios de Salones</h4>
                                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                                            </ul>
                                        </div>
                                        <br>
                                        <input type="button" class="btn btn-success" value="VISUALIZAR HORARIOS" @click="vista='v'" onclick="cancelar()" />
                                        <input type="button" class="btn btn-primary" value="+ AGREGAR HORARIO" onclick="nuevo()" />

                                    </div>

                                    <div class="card-body collapse in">
                                        <div class="card-block">

                                            <form action="ajax/cHorarios.php" method="POST">
                                                <div class="form-body">
                                                    <h4 class="form-section" v-if="vista=='r'"><i class="icon-head"></i>REGISTRADO HORARIO NUEVO</h4>
                                                    <h4 class="form-section" v-if="vista=='m'"><i class="icon-head"></i>MODIFICAR HORARIO</h4>
                                                    <h4 class="form-section" v-if="vista=='v'"><i class="icon-head"></i>VISUALIZAR HORARIOS</h4>
                                                    <h4 class="form-section" v-if="vista=='e'"><i class="icon-head"></i>ELIMINAR HORARIO </h4>

                                                    <div class="row" v-if="vista=='v' ||  vista=='r'">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="projectinput1">NIVEL EDUCATIVO:</label>
                                                                <div id="cNiv">

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="projectinput1">GRADO:</label>
                                                                <div id="cGrado">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="projectinput1">SECCION:</label>
                                                                <div id="cSecc">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="projectinput2">AÑO ESCOLAR:</label>
                                                                <div id="cAnio">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row" v-if="vista=='v'">
                                                        <div id="listado">

                                                        </div>
                                                    </div>
                                                    <div v-if="vista=='m'||vista=='e'">
                                                        <div class="row" >
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="projectinput2">DATOS DE HORARIO:</label>
                                                                    <h3>     {{horario['grado']}} "{{horario['seccion']}}" {{horario['tipo']}} - {{horario['anio']}}
                                                              </h3>   </div>
                                                            </div>

                                                        </div>
                                                        
                                                    </div>
                                                    <div v-if="vista!='v'">
                                                        <div class="row" >
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="projectinput2">URL DEL HORARIO:</label>
                                                                    <input type="text" class="form-control" name="urlHorario" v-model="horario['urlHorario']" />
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row" >

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="button" class="btn btn-primary" value="GUARDAR" onclick="accion(1)" />
                                                                    <input type="button" class="btn btn-danger" value="CANCELAR" onclick="cancelar()" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                </div>
                </section>



            </div>
        </div>
    </div>

    <script src="js/funciones.js" type="text/javascript"></script>
    <script src="js/horarios.js" type="text/javascript"></script>

    <?php
    include './pie.php';
    ?>

</html>