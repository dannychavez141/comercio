<?php error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 $id=$_GET['cod'];
 $modo=$_GET['modo'];

  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <?php if ($modo==1) {
                    # code...
                 ?>
                <li class="breadcrumb-item"><a href="verCursoPrim.php">Competencias Cursos Primaria</a>
                </li>
                <?php }else{ ?>
<li class="breadcrumb-item"><a href="verCursoSecu.php">Competencias Cursos Secundaria</a>
                </li>
                <?php } ?>
                <li class="breadcrumb-item active"><a href="#">Competencias del Curso </a>
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
                    <h4 class="card-title" id="basic-layout-form">Competencias del Curso</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                           
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            
                        </ul>
                    </div>
                </div> 
                <?php  
                                    $sql = "SELECT * FROM cursos c join estados e on c.est=e.idestados 
join tipogrado t on c.idtipogrado=t.idTipo where c.idCursos=$id;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $idcur=$datos[0];
                                            $nom=$datos[1];
                                            $grad=$datos[7];
                                           
                                            ?>
                <div class="card-body collapse in" id="registro">
                    <div class="card-block">
                        
                        
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion del Curso</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Codigo del Curso</label>
                                            <input type="text"  class="form-control"  maxlength="8" placeholder="Codigo de Curso" name="idcur" value="<?php echo $idcur ?>" readonly="">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Nombre del Curso</label>
                                            <input type="text"  class="form-control" value="<?php echo $nom ?>" maxlength="50"placeholder="Nombre del Curso" name="nom" readonly="">
                                        </div> 
                                    </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Grado del Curso</label>
                                            <input type="text"  class="form-control" value="<?php echo $grad ?>"maxlength="50"placeholder="Grado del Curso" name="grad" readonly="">
                                        </div>
                                    </div>
                                   
                                </div>                                                                                                    
                                </div>                             
                                <h4 class="form-section"><i class="icon-clipboard4"></i> Competencias </h4>
                                <br>
                                 <div class="row">
                                     <table class='table table-striped ' border='1'>
                                        <thead class='bg-warning'>
                            <tr>
                                <th>CODIGO</th>
                                <th>DESCRIPCION DE LA CAPACIDAD</th>
                                <th>ESTADO</th>
                          
                            </tr>
                        </thead> 
<tbody>
                           

<?php  $vacio=true;
                                    $sql1 = "SELECT * FROM competencias c 
join estados e on c.est=e.idestados 
where c.idcurso=$id;";
                                        $reg = $mysqli->query($sql1);
                                        while($dato = $reg->fetch_array())
                                        {   $vacio=false;
                                           
                                            ?>

                                   
                        <form  action="control/cCapacidad.php" method="post" >
                       
                            <tr><td><?php echo $dato[0] ?>
                                
                            </td><td><?php echo $dato[2] ?></td><td><?php echo $dato[5] ?></td>
                            </tr>
                        </form>
                                
<?php } ?>
</tbody></table>
<?php if ($vacio) {
 ?> <tr><td colspan="4"> NO HAY COMPETENCIAS REGISTRADAS AL CURSO</td></tr>
<?php  }?>


                                </div>


                                
                                
                                
                            </div>

                           
                       
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