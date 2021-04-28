<?php error_reporting(0);
 include_once'./cabezera.php';  
 $dia=(date('Y')-18).'-'.date('m').'-'.date('d');
  $max=(date('Y')-5).'-'.date('m').'-'.date('d');
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Registardo Alumno</a>
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
                    <h4 class="card-title" id="basic-layout-form">Registardo Padres de la Semana</h4>
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
                            <p>Por favor ingrese los datos de los Padres a Elegir</p>
                        </div>
                        <form class="form" action="control/cPadresElegidos.php" method="post" id="registro" enctype="multipart/form-data">
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Padres</h4>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1">Ingrese los nombres de los padres a elegir<font color="red">*</font></label>
                                            <textarea name="data"class="form-control" placeholder="Ingrese los nombres de los padres a elegir" required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1">Ingrese el motivo de la eleccion de los padres<font color="red">*</font></label>
                                            <textarea name="descr"class="form-control" placeholder="Ingrese el motivo de la eleccion de los padres"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                     <div class="form-group">
                                    <label>Seleccione Fotografia</label>
                                    <label id="projectinput7" class="file center-block">
                                        <input type="file" id="file" name="file" accept=".jpg, .png" required="">
                                        <span class="file-custom"></span>
                                    </label>
                                </div>
                                </div>
                                   
                                    
                                </div>
                               
                                </div>
                                    
                                <div class="form-actions">
                                <a href="index.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" v-if="btapo==1 && btalu==1" class="btn btn-primary" value="R" name="baccion">
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
    
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php 
 include_once'./pie.php';  
?>