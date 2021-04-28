<?php error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 $id=$_GET['cod'];
 
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                
<li class="breadcrumb-item"><a href="selecAlumnoInsidencia.php">Selecionar Alumno Para ver Incidencias</a>
                </li>
               
                <li class="breadcrumb-item active"><a href="#">Incidencias</a>
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
                    <h4 class="card-title" id="basic-layout-form">Incidencias registradas al alumno</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                           
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            
                        </ul>
                    </div>
                </div> 
                

                <?php  
                                    $sql = "call verunamatricula($id)";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $dni=$datos[1];
                                            $nom=$datos[2];
                                            $grad=$datos[11]." ".$datos[13].' ('.$datos[7].')';
                                           $anio=$datos[9];
                                            ?>
                <div class="card-body collapse in" id="registro">
                    <div class="card-block">
                        
                        
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Alumno</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Dni Alumno</label>
                                            <input type="text"  class="form-control"  maxlength="8" placeholder="Codigo de Curso" name="dni" value="<?php echo $dni ?>" readonly="">
                                            <input type="hidden" name="idmat" id="idmat" value="<?php echo $id ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Apellidos y Nombres</label>
                                            <input type="text"  class="form-control" value="<?php echo $nom ?>" maxlength="50"placeholder="Apellidos y Nombres" name="nom" readonly="">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Grado y Seccion</label>
                                            <input type="text"  class="form-control" value="<?php echo $grad ?>" maxlength="50"placeholder="Grado y Seccion" name="grad" readonly="">
                                        </div> 
                                    </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Año Escolar</label>
                                            <input type="text"  class="form-control" value="<?php echo $anio ?>"maxlength="50"placeholder="Año Escolar" name="anio" readonly="">
                                        </div>
                                    </div>
                                   
                                </div>                                                                                                    
                                </div>                             
                                <h4 class="form-section"><i class="icon-clipboard4"></i> Incidencias Registradas </h4>
                                <br>
                                 


                                <div class="table-responsive">
                    <center>
<section class="principal" >
  <div class="formulario">
    <label for="caja_busqueda">Buscar:</label>
    <input type="text"  name="caja_busqueda" id="caja_busqueda" placeholder="Inserte fecha a buscar" size="100"></input>
    
  </div>
<br>
  <div id="datos"></div>

</section>
              </center>      
                      

                </div>
                                
                                
                            </div>

                           
                       
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>

</section>



      </div> </div> 
<script type="text/javascript" src="js/baluInsidenciamod.js"></script>
   
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php 
 include_once'./pie.php';  
?>