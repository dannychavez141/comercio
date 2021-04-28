<?php //error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 $cur=$_GET['cur'];
 $anio=$_GET['anio'];
$idgrad=$_GET['grad'];
$secc=$_GET['secc'];
$peri=$_GET['peri'];
$orden=0;
function notaprim($nota){
$notaletras='NE';
    if ($nota==0) {
        $notaletras='C';
    }
    if ($nota==1) {
        $notaletras='B';
    }
    if ($nota==2) {
        $notaletras='A';
    }
    if ($nota==3) {
        $notaletras='AD';
    }
    return $notaletras;
}
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                
                <li class="breadcrumb-item"><a href="verCursos.php">Seleccion de curso a asignados</a>
                </li>
               
                <li class="breadcrumb-item active"><a href="#">Ver de notas del curso</a>
                </li>
              </ol>
            </div>
          </div>
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        
      


        
<div class="content-body"><!-- Basic form layout section start -->
<section id="basic-form-layouts">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Ver de notas del curso</h4>
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
join tipogrado t on c.idtipogrado=t.idTipo where c.idCursos=$cur;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $idcur=$datos[0];
                                            $nom=$datos[1];
                                            $grad=$datos[7];
                                            } 
                                    $sql = "SELECT * FROM anioescolar where idAnioEscolar=$anio;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   
                                            $anioescolar=$datos[1];
                                            
                                           } 

                                           $sql = "SELECT * FROM grado where idGrado=$idgrad;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   
                                            $grado=$datos[1];
                                            
                                           }   
                                    $sql = "SELECT * FROM seccion where idSeccion=$secc;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   
                                            $seccion=$datos[1];
                                            
                                           } 
                                    $sql = "SELECT * FROM periodos where idPeriodos=$peri;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   
                                            $periodo=$datos[1];
                                            
                                           } 
                                    ?>


                <div class="card-body collapse in" id="registro">
                    <div class="card-block">
                        
                        
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Curso</h4>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Nombre del Curso</label>
                                            <input type="hidden"  class="form-control"  maxlength="8" placeholder="Codigo de Curso" name="idcur" value="<?php echo $idcur ?>" readonly="">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">AÑO ACADEMICO</label>
                                            
                                            <input type="text"  class="form-control" value="<?php echo $anioescolar ?>" maxlength="50"placeholder="Nombre del Curso" name="nom" readonly="">
                                        </div> 
                                    </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">PERIODO</label>
                                            <input type="text"  class="form-control" value="<?php echo $periodo ?>"maxlength="50"placeholder="Grado del Curso" name="grad" readonly="">
                                        </div>
                                    </div>
                                   
                                </div>  
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">GRADO</label>
                                            
                                            <input type="text"  class="form-control" value="<?php echo $grado ?>" maxlength="50"placeholder="Nombre del Curso" name="nom" readonly="">
                                        </div> 
                                    </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">SECCION</label>
                                            <input type="text"  class="form-control" value="<?php echo $seccion ?>"maxlength="50"placeholder="Grado del Curso" name="grad" readonly="">
                                        </div>
                                    </div>
                                   
                                </div>                                                                                                
                                </div>                             
                                <h4 class="form-section"><i class="icon-clipboard4"></i> ALUMNOS MATRICULADOS </h4>
                                <br>
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                     <table class='table users table-hover  table-striped' border='1'>
                                        <?php $sql2 = "SELECT * FROM competencias where idcurso=$cur and est=1;";
                                        $competencias = $mysqli->query($sql2);
                                        $cajas=$competencias->num_rows; ?>
                                        <thead class='bg-warning'>
                                        <tr><th colspan="2" ><font size="1"> <p align="center">DATOS DE ALUMNO</p></font></th>
                                            <th colspan="<?php echo $cajas ?>"><font size="1"> <p align="center">COMPETENCIAS</p></font></th>
<th  ><font size="1"> <p align="center">PROMEDIO</p></font></th>
                                        </tr>

                            <tr>
                             <th  ><font size="1"> <p align="center">N°</p></font></th>
                                <th ><font size="1"> <p align="center">APELLIDOS Y NOMBRES</p></font></th>

                               
                                  
                               <?php 
                                        while($comp = $competencias->fetch_array())
                                        { ?>
                                            <th><font size="1"><p align="center"><?php echo $comp[2] ?></p></font></th>
                                
                                    <?php  }?>

                            

                                <th><font size="1"><p align="center"><?php echo $periodo ?></p></font></th>
                          
                            </tr>
                        </thead> 
<tbody>
                           

<?php  $vacio=true;
$cont=0;
$suma=0;
$prom=0;
                                    $sql1 = "SELECT m.idMatricula,m.dnialu,concat(a.apepa,' ',a.apema,' ',a.nomb) as alumno FROM matricula m 
join alumnos a on m.dnialu=a.dni where m.idGrado=$idgrad and m.idSeccion=$secc and m.idAnioEscolar=$anio order by a.apepa;";
                                        $reg = $mysqli->query($sql1);
                                        while($dato = $reg->fetch_array())
                                        {   $vacio=false;
                                           $idmat=$dato[0];
                                           $orden++;
                                            ?>

                                   
                       
                            <tr><td><?php echo $orden ?>
                                
                            </td><td><?php echo $dato[2] ?></td>


                            <?php $sql2 = "SELECT * FROM notasalumno n join competencias c on n.idComp=c.idComp where n.idMatricula=$idmat and c.idcurso=$cur and c.est=1;";
                                        $competencias = $mysqli->query($sql2);
                                        while($comp = $competencias->fetch_array())
                                        { $nota=$comp[$peri+1];
                                            ?>
                                            <td><p align="center"><?php echo notaprim($nota) ?></p></td>

                                   <?php $cont++;
                                $suma=$comp[$peri+1];; 
                            }
$prom=$suma;

                            ?>
<td><p align="center"><?php echo notaprim($prom) ?></p></td>

                            </tr>
                        
                                
<?php $cont=0;
$suma=0;
$prom=0;} ?>
</tbody></table>
</div></div>
<?php if ($vacio) {
 ?> <tr><td colspan="4"> NO HAY ALUMNOS MATRICULADOS</td></tr>
<?php  }?>


                                </div>


                                
                                
                                
                            </div>

                           
                       
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