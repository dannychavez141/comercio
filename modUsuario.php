<?php //error_reporting(0);
 include_once'./cabezera.php';  
 include_once 'control/conexion.php';
$dia=(date('Y')-65).'-'.date('m').'-'.date('d');
  $max=(date('Y')-18).'-'.date('m').'-'.date('d');
   $id=$_GET['cod'];
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item"><a href="verUsuarios.php">Ver Usuarios</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Modificar Usuario</a>
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
                    <h4 class="card-title" id="basic-layout-form">Modificando Usuario</h4>
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
                            <p>Por favor ingrese los nuevos datos del Usuario </p>
                        </div>
                        <form class="form" action="control/cUsuario.php" method="post" id="registro" enctype="multipart/form-data">
                            <?php  
                                    $sql = "SELECT * FROM usuario d 
join sexo s on d.idsex=s.idsexo
join estados e on d.est=e.idestados
join tipousuario t on d.idTipoUsuario=t.idTipoUsuario
where idUsuario='$id';";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $id=$datos[0];
                                            $dni=$datos[1];
                                            $nom=$datos[2];
                                            $apepa=$datos[3];
                                            $apema=$datos[4];
                                            $fecha=$datos[5];
                                            $ext=$datos[10];
                                            $idsex=$datos[13];
                                            $sex=$datos[14];
                                            $dir=$datos[7];
                                            $telf=$datos[6];
                                            $con=$datos[9];
                                            $idest=$datos[16];
                                            $est=$datos[17];
                                            $idtipo=$datos[18];
                                            $tipo=$datos[19];

                                            ?>

                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Usuario</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label for="projectinput1">DNI Usuario<font color="red">*</font></label>
                                            <input type="text" v-model="dni" class="form-control" onkeypress="return numeros(event)" maxlength="8" placeholder="DNI Usuario" name="dni"required >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <br>
                                            <button type="button" v-on:click="buscar"  class="btn btn-info">Validar</button>

                                        </div>  
                                    </div>
                                    <?php  if ($ext=='0') {
   
?>
                   <img src='img/noimage.png' width='100' height='100'></center>                            
<?php }else{ ?> <img src='img/usuarios/<?php echo $dni.'.'.$ext ?>' width='150' height='150'>
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
                                            <input type="date"  class="form-control" name="fnac" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="fnac" value="<?php echo $fecha ?>" max="<?php echo $max ?>" min="<?php echo $dia ?>" >
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Tipo de Usuario</label>
                <select id="projectinput6"  class="form-control" name="tipous" >
                                              <option value="<?php echo $idtipo ?>"><?php echo $tipo ?></option>
                                               <?php  
                                    $query = "SELECT * FROM tipousuario where idTipoUsuario !=3 and idTipoUsuario !=5 and idTipoUsuario !=4;";
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
                                            <input type="text" v-model="dir" class="form-control" maxlength="50"  placeholder="Direccion" name="dir" required="">
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
    var rapepa="",rapema="",rnom="";
    var f = new Date();
       var moduser = new Vue({
  el: '#registro',
  data: {
    dni: "<?php echo $dni ?>",
    nom: "<?php echo $nom ?>",
    apepa: "<?php echo $apepa ?>",
    apema: "<?php echo $apema ?>",
    telf: "<?php echo $telf ?>",
    dir: "<?php echo $dir ?>",
    con: "<?php echo $con ?>",
    btalu:false,
   
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
            }

                else{ 
                moduser.dni=datos[0];
               moduser.apepa=datos[1];
                moduser.apema=datos[2];
               moduser.nom=datos[3];}

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