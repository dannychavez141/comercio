<?php //error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
    $conn = $mysqli;
 $id=$_GET['cod'];
  $dia=date('Y').'-'.date('m').'-'.date('d');
  $hora=date('H').':'.date('s');
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                
<li class="breadcrumb-item"><a href="selecAlumno.php">Lista de Alumnos a cargo</a>
                </li>
               
                <li class="breadcrumb-item active"><a href="#">Alumno Seleccionado</a>
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
                    <h4 class="card-title" id="basic-layout-form">Registrar Insidencia</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                           
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            
                        </ul>
                    </div>
                </div> 
                <?php  
                                    $sql = "call verunamatricula($id);";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $iddoc=$datos[0];
                                            $dni=$datos[1];
                                            $nom=$datos[2];
                                            $grad=$datos[11]." ".$datos[13];
                                           $anio=$datos[9];
                                            ?>
                <div class="card-body collapse in" id="registro">
                    <div class="card-block">
                        
                        <form class="form" action="control/cIncidencia.php" method="post" id="registro">
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Alumno</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Dni Alumno</label>
                                            <input type="text"  class="form-control"  maxlength="8" placeholder="Dni Alumno" name="dni" value="<?php echo $dni ?>" readonly="">
                                            <input type="hidden" name="idmat" value="<?php echo $id; ?>">

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
                                            <label for="projectinput2">Grado y Seccion</label>
                                            <input type="text"  class="form-control" value="<?php echo $grad ?>"maxlength="50"placeholder="Grado del Curso" name="grad" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Año Escolar</label>
                                            <input type="text"  class="form-control" value="<?php echo $anio ?>"maxlength="50"placeholder="Año Escolar" name="anio" readonly="">
                                        </div>
                                    </div>
                                   
                                </div>  
                                <div class="row">
                                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Fecha de Insidencia</label>
                                         <input type="date" name="fec" class="form-control" value="<?php echo $dia ?>">
                                        </div>
                                    </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Tipo Insidencia</label>
                                            <select class="form-control" name="tipo">
                                                <?php  
                                                require 'control/conexion.php';
                                    $query = "SELECT * FROM tipoinsidencia";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                        </div> 
                                    </div>
                                </div>    
                                <div class="row">
                                    
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput2">Describir Insidencia</label>
                                          <textarea class="form-control" name="descr" placeholder="Escribe descripcion de la Insidencia" required=""></textarea>
                                        </div>
                                    </div>
                                   
                                </div>   

                                <div class="form-actions">
                                <a href="regInsidencia.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" class="btn btn-primary" value="R" name="baccion">
                                    <i class="icon-check2"></i> Guardar
                                </button>
                            </div>


                                </div>                             
                               

                            </div>
</form>
                           
                       
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>

</section>



      </div> </div> 

   
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php 
 include_once'./pie.php';  
?>