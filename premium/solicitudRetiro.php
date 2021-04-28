<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Premium College-Solicitud De Retiro</title>
        <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
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
    <body>
        <script src="../js/jquery.min.js" type="text/javascript"></script>
        <script src="../js/vue.js" type="text/javascript"></script>
        <script src="../js/funciones.js" type="text/javascript"></script>
        <script src="./styles/bootstrap4/bootstrap.min.js" type="text/javascript"></script>
    <body style="background-image:url('images/fondos/frontal.jpg')">



        <!-- Table head options with primary background start -->
        <div class="row" id="formulario"  style="margin: 3px;padding: 1%">
            <div class="col-xs-12">
                <div class="card">

                    <div class="card-header">

                        <h1 class="card-title" style="color: black" align="center"> <span>SOLICITUD DE RETIRO</span></h1>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                            </ul>
                        </div>

                    </div>
                    <form v-on:submit.prevent="onSubmit">

                        <div class="card-block" style="margin: 3px;padding: 1%; color: black"> 
                            <div class="row col-md-12">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <span align="center">Viendo las necesidades de la población premium College se une a las necesidades de las familias, si no cuentas con las posibilidades de continuar en la institución por favor llena el formulario de solicitud de retiro y le apoyaremos con el proceso, por favor poner información verídica para que el proceso sea rápido y eficiente. </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <h3>DATOS DE ALUMNO</h3>
                                        <hr>
                                        <div class="form-group">
                                            <label for="projectinput2">DNI ALUMNO:</label>
                                            <input type="text" v-model="dniAlu" class="form-control" onkeypress="return numerosv(event)" minlength="8" maxlength="8"placeholder="Ingrese el DNI del Alumno" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">NOMBRES:</label>
                                            <input type="text" v-model="nombAlu" class="form-control" onkeypress="return letras(event)"maxlength="50"placeholder="Ingrese los nombres del Alumno" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">APELLIDO PATERNO:</label>
                                            <input type="text" v-model="apepaAlu" class="form-control" onkeypress="return letras(event)"maxlength="50"placeholder="Ingrese el apellido Paterno del Alumno" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">APELLIDO MATERNO:</label>
                                            <input type="text" v-model="apemaAlu" class="form-control" onkeypress="return letras(event)"maxlength="50"placeholder="Ingrese el apellido Materno del Alumno" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">SELECCIONE EL GRADO EN EL QUE EL ALUMNO ESTA MATRICULADO:</label>
                                            <select class="form-control" v-model="grado"  id="cmbGrado">
                                                <option v-for="grado in grados" v-bind:value="grado">
                                                    {{ grado['1']+" ("+grado['5']+")"}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">SELECCIONE LA SECCION EN EL QUE EL ALUMNO ESTA MATRICULADO:</label>

                                            <select class="form-control" v-model="seccion"  id="cmbSeccion">
                                                <option v-for="seccion in secciones" v-bind:value="seccion">
                                                    {{ seccion['1']}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">INTITUCION DE DESTINO:</label>
                                            <input type="text" v-model="destino" class="form-control" value=""maxlength="50"placeholder="Ingrese el nombre de la intitucion Educativa a la que migrara" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <h3>DATOS DE SOLICITANTE</h3>
                                        <hr>
                                        <div class="form-group">
                                            <label for="projectinput2">DNI SOLICITANTE</label>
                                            <input type="text" v-model="dniApo" class="form-control" onkeypress="return numeros(event)" minlength="8" maxlength="8"placeholder="Ingrese el DNI del Solicitante" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">NOMBRES</label>
                                            <input type="text" v-model="nombApo" class="form-control" onkeypress="return letras(event)"maxlength="50"placeholder="Ingrese los nombres del Solicitante" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">APELLIDO PATERNO</label>
                                            <input type="text" v-model="apepaApo" class="form-control" onkeypress="return letras(event)"maxlength="50"placeholder="Ingrese el apellido Paterno del Solicitante" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">APELLIDO MATERNO</label>
                                            <input type="text" v-model="apemaApo" class="form-control" onkeypress="return letras(event)"maxlength="50"placeholder="Ingrese el apellido Materno del Solicitante" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">SELECCIONE EL PARENTESCO QUE TIENE CON EL ALUMNO</label>
                                            <select class="form-control" v-model="parentesco"  id="cmbApoderado">
                                                <option v-for="parentesco in parentescos" v-bind:value="parentesco">
                                                    {{ parentesco[1]}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">NRO DE CELULAR o TELEFONO:</label>
                                            <input type="text" v-model="celular" class="form-control"onkeypress="return numeros(event)" minlength="6" maxlength="12"placeholder="Ingrese el nro de celular o telefono del Solicitante" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="projectinput2">MOTIVO DEL RETIRO:</label>

                                            <textarea class="form-control"v-model="motivo" required="" placeholder="Explique el motivo del retiro" maxlength="200"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="card-footer">
                                        <center>
                                            <button class="btn btn-primary"  type="submit">ENVIAR SOLICITUD</button><br><br> <a href="solicitudRetiro.php"><button class="btn btn-warning" type="button"> LIMPIAR FORMULARIO</button></a> 
                                            <br><br> <a href="index.php"><button class="btn btn-success" type="button"> VOLVER A LA PAGINA PRINCIPAL</button></a> </center>
                                    </div> 
                                </div>


                            </div> 


                        </div>  
                    </form>
                </div>

            </div> 

        </div>



    </body>
    <script src="js/solicitud.js" type="text/javascript"></script>