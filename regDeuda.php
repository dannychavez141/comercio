
<?php error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Registrar deuda</a>
                </li>
              </ol>
            </div>
          </div>
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        
<div class="content-body"><!-- Basic form layout section start -->
  <form class="form" action="control/cDeudas.php" method="post" id="registro">
<section id="basic-form-layouts">
    <div class="row match-height">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Registrando deuda</h4>
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
                        
                        
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Deuda</h4>
                                                                
                                
                                    <!-- Button trigger modal -->
                                    
 <div class="row">

  <div class="form-group">
                  <div class="col-md-10">
                    <table class="table">
                                    <tr><td> <label for="projectinput1">Dni Alumno <font color="red">*</font></label>
                                            <input type="text" v-model="dni1" class="form-control"  maxlength="30"placeholder="Dni Alumno " name="dni1" required="" readonly=""
                                           >
                                           <input type="hidden" name="id" v-model="id">
                                       </td>
                                       <td><button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#iconModal1">
                                       BUSCAR ALUMNOS 
                                    </button></td>

                                  </tr>
                                  <tr >
                                    <td colspan="2"> <label for="projectinput6"> Alumno </label>
                 <input type="text" v-model="datos1" class="form-control"  maxlength="30"placeholder="Apellidos y Nombres " name="datos1" required="" readonly=""
                                           >
</tr>
<tr>
                                    <td colspan="2">  <label for="projectinput6">Descripcion de Deuda</label>
                <textarea class="form-control" name="descr1"required=""></textarea>
</td>
                                  </tr>
                                  <tr>
                                    <td> <label for="projectinput6">Seleccione el tipo de deuda</label>
<select name="tipodeuda" >

  <?php  
                                    $query = "SELECT * FROM tipodeuda ORDER BY idTipoDeuda desc;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>

</select>
                                    </td>
                                    <td>
                                       <label for="projectinput6"> MONTO : S/.</label>
                 <input type="text" name="monto" onkeypress="return NumCheck(event, this)" placeholder="0.00" value="0.00">
                                      
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                       <label for="projectinput6"> Confirmar datos:</label>
                                       <input type="checkbox" id="checkbox" v-model="checked">
                                    </td>
                                  </tr>
                                  </table>
                     
                                        </div>
                                    </div>
                                    
                                    
                                </div>


                                <div class="form-actions">
                                <a href="index.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" v-if="btalu1==1 && checked==true"class="btn btn-primary" value="R" name="baccion">
                                    <i class="icon-check2"></i> Guardar
                                </button>
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
    <input type="text"  name="caja_busqueda" id="caja_busqueda" placeholder="Inserte Alumno Primaria a buscar" class="form-control"></input>
    <label for="projectinput6">Año Escolar:</label>
                                            <select id="anio" name="anio" onchange="buscar()">
                                                <?php  
                                    $query = "SELECT * FROM anioescolar where est= 1 order by idAnioEscolar desc;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>
    <label for="projectinput6">Grado:</label>
                                            <select id="grado" name="grado" onchange="buscar()">
                                               <?php  
                                    $query = "SELECT * FROM grado where idTipo=1 and est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?>(Primaria)</option>
                                               <?php } ?>
                                                <?php  
                                    $query = "SELECT * FROM grado where idTipo=2 and est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?>(Secundaria)</option>
                                               <?php } ?>
                                    
                                            </select>
                                             <label for="projectinput6">Seccion:</label>
                                            <select id="secc" name="seccion" onchange="buscar()">
                                                <?php  
                                    $query = "SELECT * FROM seccion where est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>
                                            <button type="button" onclick="buscar()" class="btn btn-primary">BUSCAR</button>
    
  </div>
<br>
  <div id="datos"></div>

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
                            
                   

                                        </div>


                               
                                 
                                
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>

</section>

</form>  

      </div> </div> 

   
  <script type="text/javascript" src="js/belegidos.js"></script>
   <script type="text/javascript">
    var rapepa="",rapema="",rnom="";
    var f = new Date();
       var elegidos = new Vue({
  el: '#registro',
  data: {
    id:0,
    dni1: "",
    datos1: "",
    id1: "",
    btalu1:0,
    checked:''
    
  }
});
function buscarele(idmat,modo){

console.log(idmat+'-'+modo);
 
        var url = 'control/consulta_elegidos.php';
 
   $.ajax({
        type:'POST',
        url:url,
        data:'idmat='+idmat,
        success: function(datos_dni){
            
            var datos = eval(datos_dni);
               
                if (datos==null) { console.log("vacio");
                alert('ALUMNO CON MATRICULA: '+idmat+" NO REGISTRADO");
                regalu.btalu1=0;
            }

                else
                  { elegidos.id=idmat;
                     elegidos.dni1=datos[0];
                     elegidos.id1=datos[2];
                    elegidos.datos1=datos[1];
                    elegidos.btalu1=1;
                    console.log(elegidos.btalu1);

            }

        }


    });  


          
 return false;

}


    </script>
    <?php 
 include_once'./pie.php';  
?>