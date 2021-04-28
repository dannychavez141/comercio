<?php
//error_reporting(0);
include_once'./cabezera.php';
include './control/cConexion.php';
include './modelo/dbTiposeguro.php';
include './modelo/mTiposeguro.php';
$dia = (date('Y') - 18) . '-' . date('m') . '-' . date('d');
$max = (date('Y') - 2) . '-' . date('m') . '-' . date('d');
?>

<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a>
            </li>
            <li class="breadcrumb-item active"><a href="#">Registrando Alumno</a>
            </li>
        </ol>
    </div>
</div>
<div class="app-content content container-fluid">
    <div class="content-wrapper">





        <div class="content-body"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Registrando Alumno</h4>
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
                                        <p>Por favor ingrese los datos del Alumno a Registrar</p>
                                    </div>
                                    <form class="form" action="control/cAlumno.php" method="post" id="registro" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="icon-head"></i>Informacion de Alumno</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">DNI Alumno<font color="red">*</font></label>
                                                        <input type="text" v-model="dni" class="form-control" onkeypress="return numeros(event)" maxlength="8" placeholder="DNI Alumno" name="dni" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <br>
                                                        <button type="button" v-on:click="buscar"  class="btn btn-info">Validar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Nombres<font color="red">*</font></label>
                                                        <input type="text" v-model="nom" class="form-control" onkeypress="return letras(event)" maxlength="50"placeholder="Nombres" name="nom" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Apellido Paterno<font color="red">*</font></label>
                                                        <input type="text" v-model="apepa" class="form-control" onkeypress="return letras(event)" maxlength="30"placeholder="Apellido Paterno" name="apepa" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Apellido Materno<font color="red">*</font></label>
                                                        <input type="text" v-model="apema" id="apema" class="form-control" onkeypress="return letras(event)" maxlength="30"placeholder="Apellido Materno" name="apema" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="issueinput3">Fecha de Nacimiento:<font color="red">*</font></label>
                                                        <input type="date"  class="form-control" name="fnac" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="fnac" value="<?php echo $dia ?>" max="<?php echo $max ?>" min="<?php echo $dia ?>" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Seleccione Fotografia</label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="file" name="file" accept=".jpg, .png">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput10">Sexo:<font color="red">*</font></label>
                                                        <select id="projectinput10" name="sex" class="form-control">
                                                            <option value="1">MASCULINO</option>
                                                            <option value="2">FEMENINO</option>


                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="form-section"><i class="icon-clipboard4"></i> Requerimientos </h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">DNI Apoderado<font color="red">*</font></label>
                                                        <input type="text" v-model="dniapo" class="form-control" onkeypress="return numeros(event)" maxlength="8"placeholder="DNI Apoderado" name="dniapo" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <br>
                                                        <button type="button" v-on:click="buscarapo" class="btn btn-info">Buscar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Datos de Apoderado<font color="red">*</font></label>
                                                        <input type="text" v-model="datosapo" class="form-control" onkeypress="return letras(event)" maxlength="150"placeholder="Nombres Apoderado" name="datosapo" required="" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput12">Tipo de seguro<font color="red">*</font></label>

                                                        <select id="projectinput12" name="tiposeguro" class="form-control">
                                                            <?php 
                                                            $bdtipo=new dbTiposeguro();
                                                            $tipos=$bdtipo->ver_tipos("");
                                                            foreach ($tipos as $tipo) {
                                                            ?>
                                                            <option value="<?php echo $tipo->getId();?>"><?php echo $tipo->getDescr();?></option>

                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Datos adicionales de Seguro(EMAIL INSTITUCIONAL)<font color="red">*</font></label>
                                                        <input type="text" class="form-control" maxlength="150"placeholder="Escribir Datos Adicionales del seguro" name="adicional"  >
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <h4 class="form-section"><i class="icon-clipboard4"></i> Datos Opcionales </h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">DNI Padre</label>
                                                    <input type="text" v-model="dnipad" class="form-control" onkeypress="return numeros(event)" maxlength="8"placeholder="DNI Padre" name="dnipad">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <br>
                                                    <button type="button" v-on:click="buscarpad" class="btn btn-info">Buscar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="projectinput1">Datos de Padre</label>
                                                    <input type="text" v-model="datospad" class="form-control" onkeypress="return letras(event)" maxlength="150"placeholder="Nombres Padre" name="datosapo"  readonly="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">DNI Madre</label>
                                                    <input type="text" v-model="dnimad" class="form-control" onkeypress="return numeros(event)" maxlength="8"placeholder="DNI Madre" name="dnimad" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <br>
                                                    <button type="button" v-on:click="buscarmad" class="btn btn-info">Buscar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="projectinput1">Datos de Madre</label>
                                                    <input type="text" v-model="datosmad" class="form-control" onkeypress="return letras(event)" maxlength="150"placeholder="Nombres Madre" name="datosmad" readonly="">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput6">Estado:</label>
                                                    <select id="projectinput6" name="est" class="form-control">
                                                        <option value="1">Activo</option>
                                                        <option value="2">Inactivo</option>
                                                        <option value="3">Retirado</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <a href="index.php"><button type="button" class="btn btn-warning mr-1">
                                                    <i class="icon-cross2"></i> Cancelar
                                                </button></a>
                                            <button type="submit" v-if="btapo==1" class="btn btn-primary" value="R" name="baccion">
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

    <script type="text/javascript">
        var rapepa = "", rapema = "", rnom = "";
        var f = new Date();
        var regalu = new Vue({
            el: '#registro',
            data: {
                dni: "",
                nom: "",
                apepa: '',
                apema: '',
                dniapo: '',
                datosapo: '',
                dnipad: '',
                datospad: '',
                dnimad: '',
                datosmad: '',
                btalu: 0,
                btapo: 0
            },
            methods: {
                buscar: function () {
                    var dni = this.dni;
                    var url = 'control/consulta_reniec.php';
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: 'dni=' + dni,
                        success: function (datos_dni) {

                            var datos = eval(datos_dni);
                            if (datos == null) {
                                console.log("vacio");
                                alert('EL DNI: ' + dni + " NO REGISTRADO EN RENIEC");
                                regalu.btalu = 0;
                            } else {
                                regalu.dni = datos[0];
                                regalu.apepa = datos[1];
                                regalu.apema = datos[2];
                                regalu.nom = datos[3];
                            }
                            regalu.btalu = 1;
                            console.log(regalu.btalu);
                        }
                    });
                    return false;
                },
                buscarapo: function () {
                    var dni = this.dniapo;
                    var url = 'control/consulta_apoderado.php';
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: 'dni=' + dni,
                        success: function (datos_dni) {

                            var datos = eval(datos_dni);

                            if (datos == null) {
                                console.log("vacio");
                                alert('APODERADO CON DNI: ' + dni + " NO REGISTRADO");
                                regalu.btapo = 0;
                            } else {
                                regalu.datosapo = datos[1] + " " + datos[2] + " " + datos[3];

                                regalu.btapo = 1;
                                console.log(regalu.btapo);
                            }
                        }
                    });
                    return false;
                },
                buscarpad: function () {
                    var dni = this.dnipad;
                    var url = 'control/consulta_apoderado.php';
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: 'dni=' + dni,
                        success: function (datos_dni) {
                            var datos = eval(datos_dni);
                            if (datos == null) {
                                console.log("vacio");
                                alert('FAMILIAR CON DNI: ' + dni + " NO REGISTRADO");
                            } else {
                                regalu.datospad = datos[1] + " " + datos[2] + " " + datos[3];
                                console.log(regalu.btpad);
                            }
                        }
                    });
                    return false;
                }
                ,
                buscarmad: function () {

                    var dni = this.dnimad;
                    var url = 'control/consulta_apoderado.php';

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: 'dni=' + dni,
                        success: function (datos_dni) {

                            var datos = eval(datos_dni);

                            if (datos == null) {
                                console.log("vacio");
                                alert('FAMILIAR CON DNI: ' + dni + " NO REGISTRADO");
                            } else {
                                regalu.datosmad = datos[1] + " " + datos[2] + " " + datos[3];
                                console.log(regalu.btmad);
                            }
                        }
                    });
                    return false;
                }
            }
        });

    </script>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php
    include_once'./pie.php';
    ?>