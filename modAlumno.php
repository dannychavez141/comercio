<?php
error_reporting(0);
include_once'./cabezera.php';
if ($idtipo==3) {
     include './nopermiso.php';
    exit();
}
require 'control/conexion.php';
include './control/cConexion.php';
include './modelo/dbTiposeguro.php';
include './modelo/mTiposeguro.php';
include './modelo/mseguroalumno.php';
$dia = (date('Y') - 18) . '-' . date('m') . '-' . date('d');
$max = (date('Y') - 2) . '-' . date('m') . '-' . date('d');
$id = $_GET['cod'];
?>

<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a>
            </li>
            <li class="breadcrumb-item"><a href="verAlumno.php">Ver Alumnos</a>
            </li>
            <li class="breadcrumb-item active"><a href="#">Modificar Alumno</a>
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
                                <h4 class="card-title" id="basic-layout-form">Modificando Alumno</h4>
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
                                        <p>Por favor ingrese los nuevos datos del Alumno </p>
                                    </div>
                                    <form class="form" action="control/cAlumno.php" method="post" id="registro" enctype="multipart/form-data">
                                        <?php
                                        $sql = "call verunaalumno($id);";
                                        $registro = $mysqli->query($sql);
                                        while ($datos = $registro->fetch_array()) {
                                            $id = $datos[0];
                                            $dni = $datos[1];
                                            $nom = $datos[2];
                                            $apepa = $datos[3];
                                            $apema = $datos[4];
                                            $fecha = $datos[5];
                                            $ext = $datos[9];
                                            $idsex = $datos[49];
                                            $sex = $datos[50];
                                            $dniapo = $datos[6];
                                            $datoapo = $datos[17] . " " . $datos[18] . " " . $datos[16];
                                            $dnipad = $datos[25];
                                            $datopad = $datos[27] . " " . $datos[28] . " " . $datos[26];
                                            $dnimad = $datos[35];
                                            $datomad = $datos[37] . " " . $datos[38] . " " . $datos[36];
                                            $idest = $datos[47];
                                            $est = $datos[48];
                                            ?>

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Alumno</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group"> 
                                                            <label for="projectinput1">DNI Alumno<font color="red">*</font></label>
                                                            <input type="text" v-model="dni" class="form-control" onkeypress="return numeros(event)" maxlength="8" placeholder="DNI Alumno" name="dni" >
                                                            <input type="hidden"  class="form-control"  value="<?php echo $dni;?>"name="dniold" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <br>
                                                            <button type="button" v-on:click="buscar"  class="btn btn-info">Validar</button>

                                                        </div>  
                                                    </div>
                                                    <?php if ($ext == '0') {
                                                        ?>
                                                        <img src='img/noimage.png' width='100' height='100'></center>                            
                                                    <?php } else { ?> <img src='img/alumnos/<?php echo $dni . '.' . $ext ?>' width='150' height='150'>
                                                    <?php } ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Nombres<font color="red">*</font></label>
                                                            <input type="text" v-model="nom" class="form-control" onkeypress="return letras(event)" maxlength="50"placeholder="Nombres" name="nom">
                                                            <input type="hidden" value="<?php echo $id ?>"  name="id" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Apellido Paterno<font color="red">*</font></label>
                                                            <input type="text" v-model="apepa" class="form-control" onkeypress="return letras(event)" maxlength="30"placeholder="Apellido Paterno" name="apepa">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Apellido Materno<font color="red">*</font></label>
                                                            <input type="text" v-model="apema" id="apema" class="form-control" onkeypress="return letras(event)" maxlength="30"placeholder="Apellido Materno" name="apema">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="issueinput3">Fecha de Nacimiento<font color="red">*</font></label>
                                                            <input type="date"  class="form-control" name="fnac" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="fnac" value="<?php echo $fecha ?>" max="<?php echo $max ?>" min="<?php echo $fecha ?>" >
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
                                                            <label for="projectinput6">Sexo:</label>
                                                            <select id="projectinput6" name="sex" class="form-control">
                                                                <option value="<?php echo $idsex ?>"><?php echo $sex ?></option>
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
                                                            <input type="text" v-model="dniapo" class="form-control" onkeypress="return numeros(event)" maxlength="8"placeholder="DNI Apoderado" name="dniapo">
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
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Datos de Apoderado<font color="red">*</font></label>
                                                            <input type="text" v-model="datosapo" class="form-control" onkeypress="return letras(event)" maxlength="100"placeholder="Nombres Apoderado" name="datosapo">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput12">Tipo de seguro<font color="red">*</font></label>
                                                            <?php $bdtipo = new dbTiposeguro();
                                                            $tipos = $bdtipo->ver_tipos("");
                                                            $tipoactual=$bdtipo->buscarAlumnoSeguro($dni);
                                                            
                                                            ?>
                                                            <select id="projectinput12" name="tiposeguro" class="form-control">
                                                                <option value="<?php echo $tipoactual->getIdtipo() ?>"><?php echo $tipoactual->getTipo()?></option>
                                                                <?php
                                                                foreach ($tipos as $tipo) {
                                                                    ?>
                                                                    <option value="<?php echo $tipo->getId(); ?>"><?php echo $tipo->getDescr(); ?></option>

                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Datos adicionales de Seguro ( EMAIL INSTITUCIONAL)<font color="red">*</font></label>
                                                            <input type="text" class="form-control" maxlength="150"placeholder="Escribir Datos Adicionales del seguro" 
                                                                   value="<?php echo $tipoactual->getAdicional(); ?>" name="adicional" >
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
                                                        <input type="text" v-model="datospad" class="form-control" onkeypress="return letras(event)" maxlength="150"placeholder="Nombres Padre" name="datospad"  readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">DNI Madre</label>
                                                        <input type="text" v-model="dnimad" class="form-control" onkeypress="return numeros(event)" maxlength="8"placeholder="DNI Apoderado" name="dnimad" >
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
                                                        <label for="projectinput9">Estado:</label>
                                                        <select id="projectinput9" name="est" class="form-control">
                                                            <option value="<?php echo $idest ?>"><?php echo $est ?></option>
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
                                                <button type="submit" class="btn btn-primary" value="M" name="baccion">
                                                    <i class="icon-check2"></i> Guardar
                                                </button>
                                            </div>
                                        <?php } ?>
                                    </form>
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
                dni: "<?php echo $dni ?>",
                nom: "<?php echo $nom ?>",
                apepa: "<?php echo $apepa ?>",
                apema: "<?php echo $apema ?>",
                dniapo: "<?php echo $dniapo ?>",
                datosapo: "<?php echo $datoapo ?>",
                dnipad: "<?php echo $dnipad ?>",
                datospad: "<?php echo $datopad ?>",
                dnimad: "<?php echo $dnimad ?>",
                datosmad: "<?php echo $datomad ?>",
                btalu: false,
                btapo: false
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
                            } else {
                                regalu.dni = datos[0];
                                regalu.apepa = datos[1];
                                regalu.apema = datos[2];
                                regalu.nom = datos[3];
                            }

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
                            } else {
                                regalu.datosapo = datos[1] + " " + datos[2] + " " + datos[3];
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