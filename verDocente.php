<?php 
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Ver Docentes</a>
                </li>
              </ol>
            </div>
          </div>
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        
      <!-- Table head options with primary background start -->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DOCENTES REGISTRADOS</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                      
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                  <div class="table-responsive">
                    <center>
<section class="principal" >
  <div class="formulario">
    <label for="caja_busqueda">Buscar:</label>
    <input type="text"  name="caja_busqueda" id="caja_busqueda" placeholder="Inserte Docente a buscar" size="100"></input>
    
  </div>
<br>
  <div id="datos"></div>

</section>
              </center>      
                      

                </div>  
                </div>
                
            </div>
 </div> 

 <script type="text/javascript" src="js/bdocente.js"></script>
    <?php 
 include_once'./pie.php';  
?>