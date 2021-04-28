<?php 
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Ver Matriculas Secundaria</a>
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
                <h4 class="card-title">MATRICULAS SECUNDARIA REGISTRADAS</h4>
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
                    
                </div>
                <div class="table-responsive">
                    <center>
<section class="principal" >
  <div class="formulario">
    <label for="caja_busqueda">Buscar:</label>
    <input type="text"  name="caja_busqueda" id="caja_busqueda" placeholder="Inserte Alumno a buscar" size="20"></input>
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
                                    $query = "SELECT * FROM grado where idTipo=2 and est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
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
<?php include './busqueda/modaldetallematricula.php';
?>
  <div id="datos" onload="buscar()"></div>

</section>
              </center>      
                      

                </div>
            </div>
 </div> 

 <script type="text/javascript" src="js/bmatricula.js"></script>
  <script src="js/detallematricula.js" type="text/javascript"></script>
    <?php 
 include_once'./pie.php';  
?>