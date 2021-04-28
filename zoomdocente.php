<!DOCTYPE html>

<?php
include './cabezera.php';
?>
<html>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item"><a href="verDocente.php">ver Docentes</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Zoom de Docente</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="app-content content container-fluid">
        <div class="content-wrapper">

            <div class="content-body"><!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12" id="formularo">
                            <div class="card" v-if="iddocente!=''">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">ZOOM DEL DOCENTE</h4>
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
                                        <div class="card-text">
                                            <p>Por favor ingrese o actualize los datos dela cuentazoom del Docente</p>
                                        </div>
                                        <form class="form" action="control/cAlumno.php" method="post" id="registro" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="icon-head"></i>Informacion del Docente</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">DNI docente<font color="red">*</font></label>
                                                            <input type="text"class="form-control" v-model="dnidocente"  placeholder="DNI docente">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Datos de Docente<font color="red">*</font></label>
                                                            <input type="text"  class="form-control" v-model="docente" maxlength="8" placeholder="Datos de Docente">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="form-section"><i class="icon-clipboard4"></i> Datos de Cuenta de Zoom </h4>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Enlace de Zoom<font color="red">*</font></label>
                                                            <input type="text" maxlength="250"v-model="zoomurl" class="form-control"  maxlength="250"placeholder="Enlace de Zoom" name="dniapo" >
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Codigo:<font color="red">*</font></label>
                                                            <input type="text" class="form-control" v-model="zoomcod" maxlength="150"placeholder="Escribir Datos Adicionales del seguro" name="adicional"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Contraseña:</label>
                                                            <input type="text" class="form-control"v-model="zoompass" maxlength="150"placeholder="Escribir Datos Adicionales del seguro" name="adicional"  >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <a href="verDocente.php"><button type="button" class="btn btn-warning mr-1">
                                                        <i class="icon-cross2"></i> Cancelar
                                                    </button></a>
                                                <button type="button" class="btn btn-primary"  name="control" onclick="accion()">
                                                    <i class="icon-check2"></i> Guardar
                                                </button>
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
<script src="js/funciones.js" type="text/javascript"></script>
<script src="js/zoomdocentes.js" type="text/javascript"></script>
<?php
include './pie.php';
?>