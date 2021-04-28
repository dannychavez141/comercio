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
                                <h4 class="card-title" id="basic-layout-form">ADMINISTRADOR DE TRABAJOS DEL REPOSITORIO</h4>
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
                                                            <option v-bind:value="curso"> {{ curso[7]+" ("+curso[27]+" "+curso[31]+" "+curso[34]+" "+curso[37]+")"}}</option>
                                                            <option v-for="curso in cursos" v-bind:value="curso">
                                                                {{ curso[7]+" ("+curso[27]+" "+curso[31]+" "+curso[34]+" "+curso[37]+")"}}
                                                            </option>
                                                        </select>
                                                     <!--  <span>Seleccionado: {{ curso }}</span>-->

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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Descripcion del trabajo:
                                                        </label>
                                                        <textarea class="form-control"  v-model="trabajo['descrTrab']" placeholder="Descripcion del trabajo" name="" required="" maxlength="200"></textarea>


                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Fecha de Clase:</label>
                                                        <input type="date" name="fec" class="form-control" v-model="trabajo['fecha']">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group" v-if="trabajo['ext']!=0">
                                                        <strong>Actualmete el trabajo tiene un archivo en formato: {{trabajo['ext']}}</strong>
                                                        <a v-bind:href="'../img/trabajos/'+trabajo['idtrabajos']+'.'+trabajo['ext']" target="_blank" class="btn btn-success">DESCARGAR ARCHIVO</a>
                                                    </div>
                                                    <div class="form-group" v-if="trabajo['ext']==0">
                                                        <strong>Actualmete el trabajo no tiene ningun archivo</strong>
                                                       
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
                                            <h4 class="form-section"><i class="icon-diagram"></i>ADMINISTRACION DE PARTICIPANTES Y ENLACES DEL TRABAJO</h4>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <h4 class="form-section"><i class="icon-head"></i> <strong>PARTICIPANTES</strong></h4>  




                                                    <div class="form-group">

                                                        <table class="table table-bordered">
                                                            <tr align="center"><td colspan="2"> <strong>ELEGIR UN ALUMNO PARA AGREGAR COMO PARTICIPANTE DEL TRABAJO</strong></td></tr>
                                                            <tr>
                                                                <td><input type="text"  class="form-control" v-model="alumno['alu']"  placeholder="Alumno Elegido" name="dni"  readonly=""></td>
                                                                <td style="width:10%;"> <button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#iconModal1">
                                                                        BUSCAR ALUMNOS 
                                                                    </button></td>

                                                            </tr>
                                                            <tr align='center'><td colspan="2"><button type="button" class="btn btn-primary" @click='addPart'>+ Agregar como Participante</button></td></tr>
                                                            <tr align='center' class="bg-warning text-center">
                                                                <th>ALUMNO</th>
                                                                <th>QUITAR</th>
                                                            </tr>
                                                            <tr align='center' v-for="participante in participantes">
                                                                <td>{{participante['alumno']}}</td>
                                                                <td><button type="button" class="btn btn-danger" @click="delPart(participante['idMat'])"> - Quitar</button></td>
                                                            </tr>
                                                            <tr align='center'>
                                                                <td colspan="2" v-if="participantes.length==0">AUN NO SE REGISTRAN PARTICIPANTES EN ESTE TRABAJO</td>
                                                            </tr>
                                                        </table>


                                                    </div>

                                                    <!-- Modal -->
                                                    <div class="modal fade text-xs-left" id="iconModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title" id="myModalLabel2"><i class="icon-road2"></i>Alumnos Matriculados</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card-header no-border">


                                                                    </div>
                                                                    <div class="card-body collapse in">
                                                                        <div class="card-block">
                                                                            <fieldset class="form-group position-relative has-icon-left mb-0">

                                                                                <center>
                                                                                    <section class="principal" >

                                                                                        <div class="formulario">
                                                                                            <label for="caja_busqueda">Buscar:</label>
                                                                                            <input type="text"  v-model="busqueda" placeholder="Buscar Alumno" class="form-control" onkeyup="alumnosMat()"></input>
                                                                                            <div class="form-group">
                                                                                                <label for="projectinput1">Curso a Cargo:</label>
                                                                                                <select class="form-control" v-model="cursoE" onclick="alumnosMat()" >
                                                                                                    <option v-for="curso in cursos" v-bind:value="curso">
                                                                                                        {{ curso[7]+" ("+curso[27]+" "+curso[31]+" "+curso[34]+" "+curso[37]+")"}}
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div> 
                                                                                            <table class="table table-bordered">
                                                                                                <tr class="bg-warning">
                                                                                                    <th>DATOS DE ALUMNO</th>
                                                                                                    <th>ELEGIR</th>
                                                                                                </tr>
                                                                                                <tr v-for="(alumno, index) in alumnos" align="center">
                                                                                                    <td>{{alumno['alu']}}</td> 
                                                                                                    <td style="width:20px;" > <button type="button" data-dismiss='modal' @click="elegir(index)">
                                                                                                            <img src="../img/elegir.PNG" alt="" width="50">
                                                                                                        </button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>

                                                                                    </section>
                                                                                </center>  

                                                                            </fieldset> 


                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <div class="modal-footer">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>   
                                                </div>

                                                <div class="col-md-6">
                                                    <h4 class="form-section"><i class="icon-home3"></i> <strong>ENLACES</strong></h4>  
                                                    <div class="form-group">

                                                        <table class="table table-bordered">
                                                            <tr align="center"><td colspan="2"> <strong>INGRESE LOS DATOS DEL ENLACE QUE DESEE CREAR</strong></td></tr>
                                                            <tr>
                                                                <td colspan="2">Descripcion: <textarea v-model="descrenlace" class="form-control" placeholder="Escriba la descripcion del enlace"></textarea></td>

                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">Enlace:<input type="text"  v-model="enlace" class="form-control"  placeholder="Ingrese el enlace" ></td>


                                                            </tr>
                                                            <tr align='center'><td colspan="2"><button type="button" class="btn btn-primary" @click='addEnl'>+ Agregar Enlace</button></td></tr>
                                                            <tr align='center' class="bg-warning text-center">
                                                                <th>DESCRIPCION</th>
                                                                <th>QUITAR</th>
                                                            </tr>
                                                            <tr align='center' v-for="enlace in enlaces">
                                                                <td>{{enlace['descrEnlace']}} <br><a v-bind:href="enlace['enlace']" target="_blank" class="btn btn-success">Ver Archivo</a></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger" @click="delEnl(enlace['idenlace'])"> - Quitar</button></td>
                                                            </tr>
                                                            <tr align='center'>
                                                                <td colspan="2" v-if="enlaces.length==0">AUN NO SE REGISTRAN PARTICIPANTES EN ESTE TRABAJO</td>
                                                            </tr>
                                                        </table>


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

            </section>

            <script src="../js/funciones.js" type="text/javascript"></script>
            <script src="js/adTrabajo.js" type="text/javascript"></script>

        </div> </div> 


    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php
    include_once'./pie.php';
    