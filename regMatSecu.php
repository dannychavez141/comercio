<?php error_reporting(0);
 include_once'./cabezera.php';  
 $dia=(date('Y')-18).'-'.date('m').'-'.date('d');
  $max=(date('Y')-5).'-'.date('m').'-'.date('d');
   require 'control/conexion.php';
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Registrando Matricula Secundaria</a>
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
                    <h4 class="card-title" id="basic-layout-form">Registrando Matricula Secundaria</h4>
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
                        
                        <form class="form" action="control/cMatricula.php" method="post" id="registro" enctype="multipart/form-data">
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Alumno</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">DNI Alumno</label>
                                            <input type="text" v-model="dni" class="form-control" onkeypress="return numeros(event)" maxlength="8" placeholder="DNI Alumno" name="dni" required="">
                                            <input type="hidden" name="opc" value="Secu">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <br>
                                            <button type="button" v-on:click="buscaralu"  class="btn btn-info">BUSCAR</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1">Datos Alumno</label>
                                            <input type="text" v-model="nom" class="form-control" onkeypress="return letras(event)" maxlength="50"placeholder="Datos Alumno" name="nom" required="">
                                        </div>
                                    </div>
                                </div>
                                
                                

                                <h4 class="form-section"><i class="icon-clipboard4"></i> Datos Matricula </h4>

                                 <div class="row">
                                  <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Grado:</label>
                                            <select id="projectinput6" name="grado" class="form-control">
                                               <?php  
                                    $query = "SELECT * FROM grado where idTipo=2 and est=1;";
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
                                            <label for="projectinput6">Seccion:</label>
                                            <select id="projectinput6" name="seccion" class="form-control">
                                                <?php  
                                    $query = "SELECT * FROM seccion where est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                                
                                               
                                            </select>
                                        </div>
                                    </div>  
                                </div>
 <div class="row">
                                  <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Año Escolar:</label>
                                            <select id="anio" name="anio" class="form-control">
                                                <?php  
                                    $query = "SELECT * FROM anioescolar where est= 1 order by idAnioEscolar desc;";
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
                                            <label for="projectinput6">TIPO DE MATRICULA:</label>
                                            <select id="projectinput6" name="tmat" class="form-control">
                                             <?php  
                                    $query = "SELECT * FROM tipomatricula where est=1;";
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
                                            <label for="projectinput6">VACANTE :</label><br>
                                            <label ><input type="radio" name="vacante" value="1">SI</label><br>
                                            <label ><input type="radio" name="vacante"checked value="2">NO</label>
                                        </div>
                                    </div>  
                                  <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Estado:</label>
                                            <select id="projectinput6" name="est" class="form-control">
                                                <option value="1">Activo</option>
                                                <option value="2">Inactivo</option>
                                                
                                               
                                            </select>
                                        </div>
                                    </div>  
                                </div>

                                
                                    
                                
                            </div>

                            <div class="form-actions">
                                <a href="index.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" v-if="btalu==true" class="btn btn-primary" value="R" name="baccion">
                                    <i class="icon-check2"></i> Guardar
                                </button>
                            </div>
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
       var regalu = new Vue({
  el: '#registro',
  data: {
    dni: "",
    nom: "",
    btalu:false
  
  },
  methods: {
    buscaralu: function(){
    
 var dni = this.dni;
 var idanio = anio.value;
 console.log(idanio);
        var url = 'control/consulta_alumno.php';
  
   $.ajax({
        type:'POST',
        url:url,
        data:{'dni':dni,'idanio':""+idanio},
        success: function(datos_dni){
            
            var datos = eval(datos_dni);
               
                if (datos==null) { console.log("vacio");
                alert('ALUMNO CON DNI: '+dni+" NO REGISTRADO");
                regalu.btalu=false;
console.log(regalu.btalu);
            }

                else{ var modo=datos[4];
                    console.log(modo);
                    if (modo==0) {
                        alert('ALUMNO CON DNI: '+dni+" SE PUEDE MATRICULAR "); 
                    regalu.nom=datos[1]+" "+datos[2]+" "+datos[3];

regalu.btalu=true;
}else{
    alert('ALUMNO CON DNI: '+dni+" YA SE MATRICULO EN ESTE AÑO ESCOLAR"); 
    regalu.btalu=false;}
console.log(regalu.btalu);
           
            }

        }


    });  

          
 return false;
    
}
  }
});</script>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php 
 include_once'./pie.php';  
?>