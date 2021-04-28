<?php error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Padres de la semana</a>
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
                    <h4 class="card-title" id="basic-layout-form">Padres de la semana</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                     
                        </ul>
                    </div>
                </div>

<?php $sql = "SELECT * FROM apoelegidos order by idapoelegidos desc limit 1;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {                                
                                            $datos1=$datos[1];
                                            $descr1=$datos[2];  
                                            $ext1=$datos[3]; 
                                           
                                              } ?>



                <div class="card-body collapse in">
                    <div class="card-block">
                        
                        <form class="form" action="control/cCurso.php" method="post" id="registro">
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Elegidos</h4>
                                                                
                                
                                <div class="row">
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Datos de Padres Elegidos</label>
                <textarea class="form-control" readonly=""><?php echo $datos1  ?></textarea>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                         
<?php  if ($ext1=='0') {
   
?>
                   <img src='/img/noimage.png' width='200' height='200'></center>                            
<?php }else{ ?> <img src='img/padres/<?php echo '1.'.$ext1 ?>' width='150' height='150'>
<?php } ?>


                                        </div>
                                    </div>
                                    
                                   
                                </div>
                                <div class="row">
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Descripcion de eleccion de Padres</label>
                <textarea class="form-control" readonly=""><?php echo $descr1  ?></textarea>


                                        </div>
                                    </div>
                                   
                                </div>
                                
                                   
                                
                            </div>

                        
                        </form>
                    </div>
                </div>
            </div>
        </div>

</section>



      </div> </div> 

   
 
    <?php 
 include_once'./pie.php';  
?>