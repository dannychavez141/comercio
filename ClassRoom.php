<!DOCTYPE html>

<?php
include './cabezera.php';
include './control/cConexion.php';
include './modelo/dbodocente.php';
?>
<html>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>

                <li class="breadcrumb-item active"><a href="#">Clases ClassRoom</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="app-content content container-fluid">
        <div class="content-wrapper">

            <div class="content-body"><!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12" id="formulario">
                            <div class="card" >
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">CLASES DE CLASSROOM</h4>
                                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                                        </ul>
                                    </div>
                                    <br>
                                    <input type="button" class="btn btn-success" value="VISUALIZAR CLASES" onclick="cambiarVista('v')"/>
                                    <input type="button" class="btn btn-primary" value="+ AGREGAR CLASE" onclick="cambiarVista('r')" />
                                </div>
                                <div class="card-body collapse in">
                                    <div class="card-block">

                                        <form class="form" action="control/cAlumno.php" method="post" id="registro" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <h4 class="form-section" v-if="estado=='r'" ><i class="icon-head"></i>Registrar Clase de ClassRoom</h4>
                                                <h4 class="form-section" v-if="estado=='m'"><i class="icon-head"></i>Modificar Clase de ClassRoom</h4>
                                                <h4 class="form-section" v-if="estado=='e'"><i class="icon-head"></i>Eliminar Clase de ClassRoom</h4>
                                                <h4 class="form-section" v-if="estado=='v'"><i class="icon-head"></i>Visualizar Clases de ClassRoom</h4>
                                                <div class="row" v-if="estado=='r' || estado=='v'">

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="projectinput1">NIVEL EDUCATIVO:</label>
                                                            <div id="cNiv">

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="projectinput1">CURSO:</label>
                                                            <div id="cCurso">

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
                                                <div class="row" v-if="estado=='m' || estado=='e'">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">DATOS DE CLASE DE CLASSRO0M:</label>
                                                            <h3>  {{clase['grado']}} "{{clase['secc']}}" ({{clase['tipo']}} - {{clase['anio']}})</h3>
                                                            <h3>  Curso: {{clase['curso']}}</h3>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="row" v-if="estado!='v'">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">CODIGO:</label>
                                                            <input type="text"  class="form-control" v-model="clase['codigo']" maxlength="50"placeholder="Codigo del Curso" >

                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="form-actions" v-if="estado!='v'">
                                                    <button type="button" class="btn btn-warning mr-1" onclick="cambiarVista('v')">
                                                        <i class="icon-cross2"></i> Cancelar
                                                    </button>
                                                    <button type="button" class="btn btn-primary"  name="control" onclick="accion(1)">
                                                        <i class="icon-check2"></i> Guardar
                                                    </button>
                                                </div>
                                                <div class="row" v-if="estado=='v' || estado=='r'">
                                                    <div id="listaClases">

                                                    </div>
                                                </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </section>

            </div> </div>

</html>
<script src="js/classRoom.js" type="text/javascript"></script>
<script src="js/funciones.js" type="text/javascript"></script>

<?php
include './pie.php';
?>