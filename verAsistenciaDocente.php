<?php 
include './control/cConexion.php';
include './modelo/dbodocente.php'; 
include_once'./cabezera.php';  
 require 'control/conexion.php';
 $hoy=date('Y-m-d');
 $año=date('Y')-5;
 $dia=date('m-d');
 $fecha=$año.'-'.$dia;
if (isset($_GET['cod'])) {
    $cod=$_GET['cod'];
    $bddocentes=new dbodocente();
    $docente=$bddocentes->verundocente($cod);
 ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item"><a href="verDoncenteAsistencia.php">Seleccionar Docente</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Ver Asistencias del Docente</a>
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
                <h4 class="card-title">ASISTENCIAS Y SALIDAS REGISTRADAS AL DOCENTE</h4>
               

                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                      
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">
                
                <div class="table-responsive">
                    <center>
<section class="principal" >
     <table border="1" class='table table-bordered'>
                       
                            <tr>
                                <th>DNI</th>
                                <td><?php echo $docente[1];?></td>
                            </tr>
                            <tr><th>Docente:</th>
                                <td><?php echo $docente[2]." ".$docente[3]." ".$docente[4];?></td>
                                
                            </tr>
                       
                    </table>
  <div class="formulario">
      <input type="hidden" id="docente" value="<?php echo $docente[0];?>" />
    <label for="projectinput6">Fecha:</label> 
    <select id="fecha" onchange="buscar()" name="fecha">
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
    </select><label for="projectinput6">TIPO:</label>
                                            <select id="tipo" name="tipo"  onchange="buscar()">
                                              
                                                <option value="1">ENTRADAS</option>
                                               <option value="2">SALIDAS</option>
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
<?php }?>
        <script type="text/javascript" src="js/basistenciadocente.js"></script>
    <?php 
 include_once'./pie.php';  
?>