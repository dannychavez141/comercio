<?php 
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 //  ?>
 <script type="text/javascript"> var id=<?php echo $idusuario ?>;</script>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Ver Incidencias</a>
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
                <h4 class="card-title">INCIDENCIAS DE ALUMNOS REGISTRADOS </h4>
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

                      <?php 
 $idusuario=$_COOKIE['idUsuario'];
                            if ($idusuario=="") {
                               $idusuario="******************";
                            }


                        $sql = "SELECT dni FROM apoderado where idApoderado='$idusuario';";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $dni=$datos[0];
                                        }


                       ?>
<section class="principal" >
  <div class="formulario">
    <label for="caja_busqueda">Buscar:</label>

    <label for="projectinput6">Alumnos(as):</label>
                                            <select id="dnialu" name="dnialu" onchange="buscar()">
                                                <?php  
                                    $query = "SELECT a.dni,
concat(a.nomb,' ',a.apepa,' ',a.apema ) as alum
FROM alumnos a where a.dniapo='$dni'";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>
                                             <label for="projectinput6">Fecha:</label> 
    <select id="mes" onchange="buscar()" name="mes">
       <option value="0">TODOS LOS MESES</option>
      <option value="1">ENERO</option>
      <option value="2">FEBRERO</option>
      <option value="3">MARZO</option>
      <option value="4">ABRIL</option>
      <option value="5">MAYO</option>
      <option value="6">JUNIO</option>
      <option value="7">JULIO</option>
      <option value="8">AGOSTO</option>
      <option value="9">SEPTIEMBRE</option>
      <option value="10">OCTUBRE</option>
      <option value="11">NOVIENBRE</option>
      <option value="12">DICIEMBRE</option>
    </select>
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
    
                                            <button type="button" onclick="buscar()" class="btn btn-primary">BUSCAR</button>
                     

  </div>
<br>
  <div id="datos" onload="buscar()"></div>

</section>
              </center>      
                      

                </div>
            </div>
 </div> 

 <script type="text/javascript" src="js/bincidencias.js"></script>


    <?php 
 include_once'./pie.php';  
?>