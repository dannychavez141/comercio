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

            <li class="breadcrumb-item"><a href="verFicha.php">Ver Fichas</a>
            </li>
             <li class="breadcrumb-item active"><a href="#">Modificar Fichas</a>
            </li>
        </ol>
    </div>
    
</div>

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-body"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Modificando Ficha de seguimiento de clases virtualess</h4>
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

                                    <form class="form" action="control/cIncidencia.php" method="post" id="registro">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="icon-head"></i>Informacion de Seguimiento</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Datos de Docente:</label>
                                                        <input type="text"  class="form-control" v-model="docente" placeholder="Dni Docente" name="dni" value="" readonly="">

                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Curso a Cargo:</label>
                                                        <input type="text"  class="form-control" v-model="ficha['curso']" placeholder="Nombre del Curso" name="ncurso" readonly="">
                                                       <!--<span>Seleccionado: {{ curso }}</span>-->
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Grado y Seccion</label>
                                                        <input type="text"  class="form-control" v-model="salon" placeholder="Grado del Curso" name="grad" readonly="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Año Escolar</label>
                                                        <input type="text"  class="form-control" v-model="ficha['anio']"  placeholder="Año Escolar" name="anio" readonly="">
                                                    </div>
                                                </div>

                                            </div>  
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Fecha de Clase:</label>
                                                        <input type="date" name="fec" class="form-control" v-model="ficha['fecha']">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">N° De Semana:
                                                        </label>
                                                        <input type="text"  class="form-control"  v-model="ficha['nsemana']" placeholder="N° De Semana" name="anio">

                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Tema de Sesion:</label>
                                                        <input type="text"  class="form-control" v-model="ficha['nsesion']" placeholder="Tema de Sesion" name="anio" >

                                                    </div>
                                                </div>

                                            </div> 
                                            <h4 class="form-section"><i class="icon-head"></i>Competencias Evaluadas en Clase</h4>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                        <div v-for="comp in competencias">
                                                           <i class="icon-cross2"></i> {{ comp['competencia']}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <h4 class="form-section"><i class="icon-head"></i>Alumnos Registrados en la Clase</h4>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                        <div class="table-responsive table-bordered ">
                                                            <table  class="table fixed-top">
                                                                <thead>
                                                                    <tr class="bg-warning"><th rowspan="2"><font size="1"> <p align="center">N°</p></font></th><th rowspan="1"><font size="1"> <p align="center">ESTUDIANTES</p></font></th><th colspan="4"><font size="1"><p align="center">PARTICIPO EN CLASE</p></font></th><th colspan="4"><font size="1"><p align="center">DESARROLLO DE LA SESION </p></font>							
                                                                        </th></tr>
                                                                    <tr class="bg-success"><th><font size="1"> <p align="center">Apellidos y Nombres</p></font></th>
                                                                        <th class="bg-primary"><font size="1"> <p align="center">PARTICIPÓ<br> DE LA <br>SESIÓN (SÍ/NO)</p></font></th>
                                                                        <th><font size="1"> <p align="center">Zoom</p></font></th>
                                                                        <th><font size="1"> <p align="center">ClassRoom</p></font></th>
                                                                        <th><font size="1"> <p align="center">Whatsapp</p></font></th>
                                                                        <th><font size="1"><p align="center">¿PRESENTO <br>ACTIVIDADES <br>A TRAVÉS DE<br> CLASSROM Y/O <br>ZOOM? (SÍ/NO)</p></font>


                                                                        </th ><th class="bg-danger"><font size="1"> <p align="center">EL DOCENTE SE COMUNICO CON LOS ESTUDIANTES (SI/NO) <br> SI ra respuesta es NO <br>¿Por qué?</p></font>


                                                                        </th><th class="bg-danger"><font size="1"> <p align="center">EL DOCENTE SE COMUNICO CON LOS padres(SI/NO) <br>¿Por qué?</p></font>


                                                                        </th><th class="bg-danger"><font size="1"> <p align="center">CELURAR <br>DEL PADRE<br> O ESTUDIANTE  <br>PARA <br>COMUNICARSE.</p></font>


                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr v-for="(alumno, index) in alumnos" align="center" >
                                                                    <td>{{ index+1}}</td>
                                                                    <td><font size="2"> <p align="center">{{alumno['alu']}}</p></font></td>
                                                                    <td><input type="checkbox" class="form-control"v-model="alumnos[index]['part']"></td>
                                                                    <td><input type="checkbox" class="form-control"v-model="alumnos[index]['zoom']"></td>
                                                                    <td><input type="checkbox" class="form-control"v-model="alumnos[index]['class']"></td>
                                                                    <td><input type="checkbox" class="form-control"v-model="alumnos[index]['whapp']"></td>
                                                                    <td><input type="checkbox" class="form-control"v-model="alumnos[index]['acti']"></td>
                                                                    <td><input type="checkbox" class="form-control"v-model="alumnos[index]['comAlu']"><textarea class="form-control" placeholder="SI la respuesta es NO ¿Por qué?"v-model="alumnos[index]['txtcomAlu']"></textarea></td>
                                                                    <td><input type="checkbox" class="form-control"v-model="alumnos[index]['comDoc']"><textarea class="form-control" placeholder="SI la respuesta es NO ¿Por qué?" v-model="alumnos[index]['txtcomDoc']"></textarea></td>
                                                                    <td><input type="text" class="form-control" placeholder="Nro de Celular" v-model="alumnos[index]['telf']"></td>
                                                                </tr>
                                                                </tbody>


                                                            </table>
                                                           <!--<span>Seleccionado: {{ alumnos }}</span>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="form-actions">
                                                <a href="regInsidencia.php"><button type="button" class="btn btn-warning mr-1">
                                                        <i class="icon-cross2"></i> Cancelar
                                                    </button></a>
                                                <button type="button" class="btn btn-primary" value="R" name="baccion" onclick="confirmar()">
                                                    <i class="icon-check2"></i> Guardar Cambios
                                                </button>
                                            </div>
                                        </div>  
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                
            </section>
            <script src="../js/funciones.js" type="text/javascript"></script>
            <script src="js/mficha.js" type="text/javascript"></script>

        </div> </div> 


    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php
    include_once'./pie.php';
    ?>