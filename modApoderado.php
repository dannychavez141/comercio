<?php 
include './control/cConexion.php';
include './modelo/dboCorreo.php';
 include_once'./cabezera.php';  
 if ($idtipo==3) {
     include './nopermiso.php';
    exit();
}
 require 'control/conexion.php';
 $id=$_GET['cod'];
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li> 
                <li class="breadcrumb-item"><a href="verApoderado.php">Ver Familiar</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Modificando Familiar</a>
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
                    <h4 class="card-title" id="basic-layout-form">Modificando Familiar</h4>
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
                            <p>Por favor ingrese los nuevos datos del Familiar</p>
                        </div>
                        <form class="form" action="control/cApoderado.php" method="post" id="registro">
                            <?php  
                                    $sql = "SELECT * FROM apoderado a  join tipoapoderado t on a.idtipoApoderado=t.idtipoApoderado join estados e on a.est=e.idestados
                                        where a.idApoderado=$id;";
                                        //echo $sql;
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $id=$datos[0];
                                            $dni=$datos[1];
                                            $nom=$datos[2];
                                            $apepa=$datos[3];
                                            $apema=$datos[4];
                                            $dir=$datos[5];
                                            $telf=$datos[6];
                                            $idtipo=$datos[10];
                                            $tipo=$datos[11];
                                            $idest=$datos[13];
                                            $est=$datos[14];
                                              $con=$datos[9];

                                            ?>
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Familiar</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">DNI Familiar <font color="red">*</font></label>
                                            <input type="text" v-model="dni" class="form-control" maxlength="8" onkeypress="return numeros(event)"placeholder="DNI Apoderado" name="dni"  value=""required=""> 
                                            <input type="hidden" value="<?php echo $id ?>"  name="id" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <br>
                                            <button type="button" v-on:click="buscar" v-on:click="buscar"class="btn btn-info">Validar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1">Nombres <font color="red">*</font></label>
                                            <input type="text" v-model="nom" class="form-control" onkeypress="return letras(event)" maxlength="50"placeholder="Nombres" name="nom" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Apellido Paterno <font color="red">*</font></label>
                                            <input type="text" v-model="apepa" class="form-control" onkeypress="return letras(event)" maxlength="30"placeholder="Apellido Paterno" name="apepa" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Apellido Materno <font color="red">*</font></label>
                                            <input type="text" v-model="apema" class="form-control" onkeypress="return letras(event)" maxlength="30"placeholder="Apellido Materno" name="apema" required="">
                                        </div>
                                    </div>
                                    
                                </div>
                                

                                <h4 class="form-section"><i class="icon-clipboard4"></i> Requerimientos </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Direccion<font color="red">*</font></label>
                                            <input type="text" v-model="dir" class="form-control" maxlength="50" placeholder="Direccion" name="dir">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Telefono<font color="red">*</font></label>
                                            <input type="text" v-model="telf"  class="form-control" maxlength="12" onkeypress="return numeros(event)"placeholder="Telefono" name="telf">
                                        </div>
                                    </div>
                                    
                                </div>

                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Tipo Familiar</label>
                <select id="projectinput6" name="tipo" class="form-control">
                    <option value="<?php echo $idtipo ?>"><?php echo $tipo ?></option>
                                               <?php  
                                    $query = "SELECT * FROM tipoapoderado where est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>


                                        </div>
                                    </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <?php $dbocorreo = new dboCorreo();
                                            $correo = $dbocorreo->verUncorreo($dni)
                                            ?>
                                            <label for="projectinput1">Correo Electronico<font color="red">*</font></label>
                                            <input type="email" class="form-control" maxlength="150" placeholder="Correo Electronico" name="correo" value="<?php echo $correo[1]; ?>" >
                                        </div>
                                    </div>
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
                                                <option value="<?php echo $idest ?>"><?php echo $est ?></option>
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
       var regfam = new Vue({
  el: '#registro',
  data: {
    dni: "<?php echo $dni ?>",
    nom: "<?php echo $nom ?>",
    apepa: "<?php echo $apepa ?>",
    apema: "<?php echo $apema ?>",
    dir: "<?php echo $dir ?>",
    telf: "<?php echo $telf ?>",
    con:"<?php echo $con ?>",
    btalu:false,
    btapo:false
  },
  methods: {
    buscar: function () {

        var dni = this.dni;
        console.log(dni);

          this.bdni(dni);
 return false;
        
    },
    bdni: function(dni){
  var url = 'control/consulta_reniec.php';
  
   $.ajax({
        type:'POST',
        url:url,
        data:'dni='+dni,
        success: function(datos_dni){
            
            var datos = eval(datos_dni);
                regfam.dni=datos[0];
               regfam.apepa=datos[1];
                regfam.apema=datos[2];
               regfam.nom=datos[3];
        }
    });    
}  }});

    </script>
 
    <?php 
 include_once'./pie.php';  
?>