<!DOCTYPE html>
<html lang="es">

<head>
    <title>Premium College-BIBLIOTECA DE TRABAJOS</title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name="description" content="Course Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="../premium/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../premium/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="../premium/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="../premium/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="../premium/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="../premium/styles/responsive.css">
</head>

<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/vue.js" type="text/javascript"></script>
<script src="../js/funciones.js" type="text/javascript"></script>
<script src="./styles/bootstrap4/bootstrap.min.js" type="text/javascript"></script>

<body style="background-image:url('images/fondos/frontal.jpg')">
    <!-- Table head options with primary background start -->
    <div class="row" id="formulario" style="margin: 3px;padding: 1%">
        <div class="col-xs-12">
            <div class="card">

                <div class="card-header">

                    <h1 class="card-title" style="color: black" align="center">

                        <img src="../img/logo.png" alt="" width="100">
                        <strong>BIBLIOTECA DE TRABAJOS PREMIUM COLLEGE</strong><img src="../img/logo.png" alt="" width="100"></h1>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                        </ul>
                    </div>

                </div>
                <div class="card-block" style="margin: 3px;padding: 1%; color: black">
                    <div class="row col-md-12">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <strong class="text-center">
                                        <h4>En este módulo los padres, alumnos y público en general pueden visualizar los trabajos más representativos que los alumnos realizan el transcurso del año escolar, tales como trabajos bimestrales, trabajos grupales y trabajos finales, mostrando las capacidades que poseen nuestros alumnos en estos días de crisis. </h4>
                                    </strong>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3 class="text-center">BUSQUEDA DE TRABAJOS</h3>
                                <hr>
                            </div>
                            <div class="col-md-4">


                                <div class="form-group">
                                    <label for="projectinput2">ESCRIBA LA BUSQUEDA:</label>
                                    <input type="text" v-model="busq" class="form-control" size="20%" placeholder="Busque por tema , nombre de alumno o palabra clave." onkeyup="buscar()">
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="projectinput2">SELECCIONE EL AÑO:</label>
                                    <select class="form-control" id="cmbAnio" onchange="buscar()">
                                        <option v-bind:value="idseccion">TODOS LOS AÑOS</option>
                                        <option v-for="anio in anios" v-bind:value="anio[0]">
                                            {{ anio['1']}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="projectinput2">SELECCIONE EL GRADO:</label>
                                    <select id='cmbgrado' class="form-control" onchange="buscar()">
                                        <option v-bind:value="idgrado">TODOS LOS GRADOS</option>
                                        <option v-for="grado in grados" v-bind:value="grado['0']">
                                            {{ grado['1']+" ("+grado['5']+")"}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="projectinput2">SELECCIONE EL SECCION:</label>
                                    <select class="form-control" id="cmbSeccion" onchange="buscar()">
                                        <option v-bind:value="idseccion">TODAS LAS SECCIONES</option>
                                        <option v-for="seccion in secciones" v-bind:value="seccion[0]">
                                            {{ seccion['1']}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="projectinput2">SELECCIONE EL ACTIVIDAD:</label>
                                    <select class="form-control" id="cmbActividad" onchange="buscar()">
                                        <option v-bind:value="idactividad">TODAS LAS ACTIVIDADES</option>
                                        <option v-for="actividad in actividades" v-bind:value="actividad[0]">
                                            {{ actividad['1']}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3 class="text-center">LISTA DE PRESENTACIONES</h3>
                                <hr>

                            </div>
                            <div class="col-md-3" v-for="trabajo in trabajos">
                                <div class="form-group">
                                    <div class="card text-white bg-primary">
                                        <div class="card-header">
                                            <h3>{{trabajo['grado']+' '+trabajo['seccion']+' '+trabajo['nivel']+' '+trabajo['anio']}}</h3>
                                            <h3>TEMA:</h3>
                                            <h2>{{trabajo['descrTrab']}}</h2>
                                            <h3>ACTIVIDAD:</h3>
                                            <h2>{{trabajo['actidad']}}</h2>
                                            <div v-if="trabajo['ext']!='0'">
                                                <span>El trabajo posee un archivo: {{trabajo['ext']}}
                                                    <a v-bind:href="'../img/trabajos/'+trabajo['idtrabajos']+'.'+trabajo['ext']" target="_blank"><button class="btn btn-warning">
                                                            VER ARCHIVO</button></a></span>

                                            </div>
                                            <div v-if="trabajo['ext']=='0'">
                                                <span>EL trabajo no posee ningun archivo adjunto</span>
                                            </div>
                                        </div>
                                        <div class="card-body bg-success"><br>
                                            <h3>PARTICIPANTES:</h3>
                                            <ol style="padding-left : 15px">
                                                <div v-for="(participante,index) in participantes">
                                                    <div v-for="parti in participante">
                                                        <li v-if="parti['idtrabajo']==trabajo['idtrabajos']"> {{parti['alumno'] }}</li>
                                                    </div>
                                                </div>
                                            </ol>
                                            <h3>ENLACES:</h3>
                                            <ol style="padding-left : 15px">
                                                <div v-for="(enlace,index) in enlaces">
                                                    <div v-for="enla in enlace">
                                                        <li style="padding-bottom:   10px" v-if="enla['idtrabajo']==trabajo['idtrabajos']"> {{enla['descrEnlace']}}
                                                            <a v-bind:href="enla['enlace']" target="_blank" class="btn btn-primary btn-sm">ABRIR ENLACE</a>
                                                        </li>
                                                    </div>
                                                </div>
                                            </ol>
                                        </div>
                                        <div class="card-footer">
                                            <h4>DOCENTE: {{trabajo['docente']}}</h4>
                                            <h4>CURSO: {{trabajo['curso']}}</h4>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3 class="text-center" v-if="trabajos.length==0">AUN NO SE SUBE NINGUN TRABAJO EN LA BUSQUEDA SELECCIONADA</h3>


                            </div>
                        </div>



                    </div>


                </div>

            </div>

        </div>

    </div>
    <script src="../js/funciones.js" type="text/javascript"></script>

    <script src="js/repositorio.js" type="text/javascript"></script>
</body>