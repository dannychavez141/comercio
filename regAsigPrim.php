<?php //error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
    $conn = $mysqli;
 $id=$_GET['cod'];
 
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                
<li class="breadcrumb-item"><a href="verDocenteAsig.php?modo=1">Seleccion de docente para asignar curso primaria</a>
                </li>
               
                <li class="breadcrumb-item active"><a href="#">Cursos Primaria asignados al docente </a>
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
                    <h4 class="card-title" id="basic-layout-form">Cursos Primaria asignados al docente</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                           
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            
                        </ul>
                    </div>
                </div> 
                <?php  
                                    $sql = "call verunadocente($id)";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $iddoc=$datos[0];
                                            $dni=$datos[1];
                                            $nom=$datos[3].' '.$datos[4].' '.$datos[2];
                                            $grad=$datos[19];
                                           
                                            ?>
                <div class="card-body collapse in" id="registro">
                    <div class="card-block">
                        
                        
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Docente</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Dni Docente</label>
                                            <input type="text"  class="form-control"  maxlength="8" placeholder="Dni Docente" name="dni" value="<?php echo $dni ?>" readonly="">
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Apellidos y Nombres</label>
                                            <input type="text"  class="form-control" value="<?php echo $nom ?>" maxlength="50"placeholder="Nombre del Curso" name="nom" readonly="">
                                        </div> 
                                    </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Estado</label>
                                            <input type="text"  class="form-control" value="<?php echo $grad ?>"maxlength="50"placeholder="Grado del Curso" name="grad" readonly="">
                                        </div>
                                    </div>
                                   
                                </div>                                                                                                    
                                </div>                             
                                <h4 class="form-section"><i class="icon-clipboard4"></i> Cursos de Grado y seccion asignada </h4>
                                <br>
                                 <div class="row">
                                     
                            

<?php   require 'control/conexion.php';
$vacio=true;
 $sql1 = "SELECT * FROM asigdocente ad
join cursos c on ad.idCursos=c.idCursos
join docente d on ad.idDocente=d.idDocente
join grado g on ad.idGrado=g.idGrado
join seccion s on ad.idSeccion=s.idSeccion
join anioescolar ae on ad.idAnioEscolar=ae.idAnioEscolar
join estados e on ad.est=e.idestados
where d.idDocente=$id";
                                        $reg = $mysqli->query($sql1);

                           $datos=$reg->num_rows;            
                                        
                                          if ($datos==0) {                                             
             ?>
<form action="control/cAsigPrim.php" method="post">
                       <table class='table'>
                            <tr><td><input type="hidden"  class="form-control"  maxlength="8" placeholder="Codigo de Curso" name="iddoc" value="<?php echo $iddoc ?>" readonly="">
                             AÑO ESCOLAR:<select id="anio" name="anio" >
                                                <?php  require 'control/conexion.php';
                                    $query = "SELECT * FROM anioescolar where est= 1 order by idAnioEscolar desc;";
                                        $anioescolar = $mysqli->query($query);
                                        while($anio = $anioescolar->fetch_array())
                                        {?>
                                                <option value="<?php echo $anio[0] ?>"><?php echo $anio[1] ?></option>
                                               <?php } ?>
                                            </select>
                            </td>
                            <td>GRADO:<select id="grado" name="grado" >
                                              <?php  
                                    $query = "SELECT * FROM grado g 
join tipogrado tg on g.idTipo=tg.idTipo 
where  g.est=1 and g.idTipo!=2;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                               <option value="<?php echo $row[0] ?>"><?php echo $row[1]." (".$row[5].")"; ?></option>
                                               <?php } ?>
                                            </select></td><td>
                           SECCION:<select id="secc" name="secc" >
                                                <?php  
                                    $query = "SELECT * FROM seccion where est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select></td>
                            <td><button  class="btn btn-info" value="R" name="baccion">
                                    <i class="icon-plus4"></i> Agregar
                                </button></td></tr>
                        </form></table>
                            <br>


<?php } else { ?><form action="control/cAsigPrim.php" method="post">
                       <table class='table'><tr><td><input type="hidden"  class="form-control"  maxlength="8" placeholder="Codigo de Curso" name="iddoc" value="<?php echo $iddoc ?>" readonly="">
                       Eliminar los cursos asignados al docente de primaria: </td>
                           <td><button  class="btn btn-danger" value="M" name="baccion">
                                    <i class="icon-android-remove"></i> Quitar Cursos Asignados
                                </button></td>
                             
                            
                            </tr></table>
                            <br>
                        </form>
<?php   } ?>
<table class='table table-striped ' border='1'>
                                        <thead class='bg-primary'>
                            <tr><th>CURSO</th>
                                <th>GRADO</th>
                                <th>SECCION</th>
                                <th>AÑO ESCOLAR</th>
                                
                            </tr>
                        </thead> 
<tbody>
                                   <?php  

                                 
                                   while($dato = $reg->fetch_array())
                                        {   $vacio=false; ?>
                        
                                <tr>
                            <td><?php echo $dato[7] ?></td>
                            <td><?php echo $dato[26] ?></td>
                            <td><?php echo $dato[30] ?></td>
                            <td><?php echo $dato[33] ?></td>
                            </tr>
<?php } ?>
</tbody></table>
<?php if ($vacio) {
 ?> <tr><td colspan="4"> NO HAY CURSOS ASIGNADOS AL DOCENTE</td></tr>
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