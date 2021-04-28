<?php
include_once'./cabezera.php';
$fcha = date("Y-m-d");
?>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<meta http-equiv=”Content-Type” content=”text/html; charset=ISO-8859-1″ />
<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a>
            </li>

            <li class="breadcrumb-item active"><a href="#">Creacion de Ficha</a>
            </li>
        </ol>
    </div>
    <!-- <link href="js/estilo.css" rel="stylesheet" type="text/css"/>-->
</div>
<script>
    usuario = '<?php echo $usuario; ?>';
    idusuario = '<?php echo $idusuario; ?>';
    fcha = '<?php echo $fcha; ?>';
</script>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-body"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">REGISTRO DE TRABAJOS PARA EL REPOSITORIO</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                                    </ul>
                                </div>
                            </div> 

                            <div class="card-body collapse in" id="registro">
                                <div class="card-block">

                                    <form class="form"  method="post" id="registro" enctype="multipart/form-data"v-on:submit.prevent="confirmar()">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="icon-head"></i>Informacion del Trabajo </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Datos de Docente:</label>
                                                        <input type="text"  class="form-control" v-model="docente"  placeholder="Dni Docente" name="dni" value="" readonly="">

                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Curso a Cargo:</label>
                                                        <select class="form-control" v-model="curso" >
                                                            <option v-for="curso in cursos" v-bind:value="curso">
                                                                {{ curso[7]+" ("+curso[27]+" "+curso[31]+" "+curso[34]+" "+curso[37]+")"}}
                                                            </option>
                                                        </select>
                                                       <!--<span>Seleccionado: {{ curso }}</span>-->

                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Grado y Seccion</label>
                                                        <input type="text"  class="form-control" v-model="curso[27]+' '+curso[31]+' '+curso[34]" placeholder="Grado del Curso" name="grad" readonly="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Año Escolar</label>
                                                        <input type="text"  class="form-control"  v-model="curso['descr']"placeholder="Año Escolar" readonly="">
                                                    </div>
                                                </div>

                                            </div> 
                                            <div class="row">

                                                <div class="col-md-12">
                                                <div class="form-group">
                                                        <label for="projectinput1">Actividad:</label>
                                                        <select class="form-control" v-model="actividad" >
                                                            <option v-for="actividad in actividades" v-bind:value="actividad">
                                                                {{ actividad[1] }}
                                                            </option>
                                                        </select>
                                                       <!--
                                                           <span>Seleccionado: {{ actividad[0] }}</span> -->
                                                       

                                                    </div> 
                                               

                                            </div>   </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Descripcion del trabajo:
                                                        </label>
                                                        <textarea class="form-control"  v-model="descripcion" placeholder="Descripcion del trabajo" name="descripcion" required="" maxlength="200"></textarea>


                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Fecha de Clase:</label>
                                                        <input type="date" name="fec" class="form-control" v-model='fecha'>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Subir Archivo de trabajo:</label>
                                                        <strong style="">Solo subir un archivo con un peso no superior a 10MB</strong>
                                                        <input type="file" v-on:change="onFileChange()"
                                                               class="form-control"   name="file" id="file" >

                                                    </div>
                                                </div>

                                            </div> 



                                            <div class="form-actions">
                                                <a href="regInsidencia.php"><button type="button" class="btn btn-warning mr-1">
                                                        <i class="icon-cross2"></i> Cancelar
                                                    </button></a>
                                                <button type="submit" class="btn btn-primary" value="R" name="baccion" >
                                                    <i class="icon-check2"></i> Guardar
                                                </button>
                                            </div>
                                        </div>  
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </section>
            <script src="../js/funciones.js" type="text/javascript"></script>
            <script src="js/rTrabajo.js" type="text/javascript"></script>

        </div> </div> 


    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php
    include_once'./pie.php';
    