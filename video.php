<?php error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Registrando Año Escolar</a>
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
                    <h4 class="card-title" id="basic-layout-form">Video de Periodico</h4>
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
                        <?php $sql = "SELECT * FROM video a 
join estados e on a.est=e.idestados ";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $id=$datos[0];
                                            $url=$datos[2];
                                            $idest=$datos[4];
                                             $est=$datos[5]; } ?>
                        <form class="form" action="control/cVideo.php" method="post" id="registro" enctype="multipart/form-data">
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Url de lista de reproduccion</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Codigo</label>
                                            <input type="text"  class="form-control" onkeypress="return numeros(event)" maxlength="8" placeholder="Codigo" value="Oculto" readonly="">
                                            <input type="hidden" name="id" value="<?php echo $id?>">
                                        </div>
                                    </div>
                                   
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1"> Url actual</label>
                                            <textarea name="url" placeholder="Url Actual" class="form-control" required=""><?php echo $url?></textarea>
                                           
                                        </div>
                                    
                                </div>
                                </div>
                                 <div class="row">
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Estado:</label>
                                            <select id="projectinput6" name="est" class="form-control">
                                               
                                                <option value="<?php echo $idest ?>"><?php echo $est ?></option>
                                                <option value="1">ACTIVO</option>
                                                <option value="2">INACTIVO</option>
                                           
                                               
                                            </select>
                                        </div>
                                    </div></div>
                                
                            </div>

                            <div class="form-actions">
                                <a href="index.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" class="btn btn-primary" value="M" name="baccion">
                                    <i class="icon-check2"></i> Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</section>



      </div> </div> 

   
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php 
 include_once'./pie.php';  
?>