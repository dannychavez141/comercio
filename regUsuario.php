<?php 
 include_once'./cabezera.php';
  require 'control/conexion.php';  
 $dia=(date('Y')-65).'-'.date('m').'-'.date('d');
  $max=(date('Y')-18).'-'.date('m').'-'.date('d');
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Registardo Docente</a>
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
                    <h4 class="card-title" id="basic-layout-form">Registardo Usuario</h4>
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
                            <p>Por favor ingrese los datos del Usuario a Registrar</p>
                        </div>
                        <form class="form" action="control/cUsuario.php" method="post" id="registro" enctype="multipart/form-data">
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Usuario</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">DNI Usuario<font color="red">*</font></label>
                                            <input type="text" v-model="dni" class="form-control" onkeypress="return numeros(event)" maxlength="8" placeholder="DNI Usuario" name="dni" required="">
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
                                    <div class="col-md-12">
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
                                            <label for="projectinput6">Sexo:<font color="red">*</font></label>
                                            <select id="projectinput6" name="sex" class="form-control">
                                                <option value="1">MASCULINO</option>
                                                <option value="2">FEMENINO</option>
                                       
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Tipo de Grado</label>
                <select id="projectinput6" name="tipo" class="form-control">
                                               <?php  
                                    $query = "SELECT * FROM tipousuario where idTipoUsuario<4;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>


                                        </div>
                                    </div>
                                </div>
 

                                <h4 class="form-section"><i class="icon-clipboard4"></i> Requerimientos </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Direccion<font color="red">*</font></label>
                                            <input type="text" v-model="dir" class="form-control" maxlength="50" placeholder="Direccion" name="dir" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Telefono<font color="red">*</font></label>
                                            <input type="text" v-model="telf"  class="form-control" maxlength="12" onkeypress="return numeros(event)"placeholder="Telefono" name="telf" required="">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Contranseña<font color="red">*</font></label>
                                            <input type="text" v-model="con" class="form-control" maxlength="50" placeholder="Contranseña" name="con" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Estado</label>
                                            <select id="projectinput6" name="est" class="form-control">
                                                <option value="1">ACTIVO</option>
                                                <option value="2">INACTIVO</option>
                                                <option value="3">RETIRADO</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>

                                  
                                
                                    
                                
                            </div>
                                    
                                <div class="form-actions">
                                <a href="index.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" v-if="btalu==1" class="btn btn-primary" value="R" name="baccion">
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
    var rapepa="",rapema="",rnom="";
    var f = new Date();
       var reguser = new Vue({
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
    btalu:0,
    btapo:0
  },
  methods: {
    buscar: function () {

        var dni = this.dni;
        var url = 'control/consulta_reniec.php';
  
   $.ajax({
        type:'POST',
        url:url,
        data:'dni='+dni,
        success: function(datos_dni){
            
            var datos = eval(datos_dni);
            if (datos==null) { console.log("vacio");
                alert('EL DNI: '+dni+" NO REGISTRADO EN RENIEC");
                reguser.btalu=0;
            }

                else{ 
                reguser.dni=datos[0];
               reguser.apepa=datos[1];
                reguser.apema=datos[2];
               reguser.nom=datos[3];}
reguser.btalu=1;
console.log(reguser.btalu);
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