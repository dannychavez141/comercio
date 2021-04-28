<?php error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Alumnos de la semana</a>
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
                    <h4 class="card-title" id="basic-layout-form">Alumnos de la semana</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                     
                        </ul>
                    </div>
                </div>

<?php $sql = "SELECT * FROM mural m
join matricula m1 on m.idmat1=m1.idMatricula
join alumnos a1 on m1.dnialu=a1.dni
join grado g1 on m1.idGrado=g1.idGrado
join seccion s1 on m1.idSeccion=s1.idSeccion
join anioescolar ae1 on m1.idAnioEscolar=ae1.idAnioEscolar
join matricula m2 on m.idmat2=m2.idMatricula
join alumnos a2 on m2.dnialu=a2.dni
join grado g2 on m2.idGrado=g2.idGrado
join seccion s2 on m2.idSeccion=s2.idSeccion
join anioescolar ae2 on m2.idAnioEscolar=ae2.idAnioEscolar 
order by  m.idmural desc limit 1;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $dni1=$datos[8];                                
                                            $datos1=$datos[19].' '.$datos[20].' '.$datos[21].' (PRIMARIA- '.$datos[32].' '.$datos[36].'-'.$datos[39].')';
                                            $descr1=$datos[2];
                                            $dni2=$datos[52];
                                            $datos2=$datos[53].' '.$datos[54].' '.$datos[55].' (SECUNDARIA- '.$datos[66].' '.$datos[70].'-'.$datos[73].')';                                            
                                            $descr2=$datos[4];
                                           


                                              } ?>



                <div class="card-body collapse in">
                    <div class="card-block">
                        
                        <form class="form" action="control/cCurso.php" method="post" id="registro">
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Elegidos</h4>
                                                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Dni Alumno Elegido Primaria<font color="red">*</font></label>
                                            <input type="text" class="form-control" onkeypress="return numeros(event)" maxlength="30"placeholder="Dni Alumno Elegido Primaria" name="dni1" required=""
                                            value="<?php echo $dni1  ?>" readonly="">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Dni Alumno Elegido Secundaria<font color="red">*</font></label>
                                            <input type="text" class="form-control" onkeypress="return numeros(event)" maxlength="30"placeholder="Dni Alumno Elegido Secundaria" name="dni2" required="" readonly="" value="<?php echo $dni2  ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Datos Alumno Primaria</label>
                <textarea class="form-control" readonly=""><?php echo $datos1  ?></textarea>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Datos Alumno Secundaria</label>
                <textarea class="form-control" readonly=""><?php echo $datos2  ?></textarea>


                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Descripcion de eleccion Alumno Primaria</label>
                <textarea class="form-control" readonly=""><?php echo $descr1  ?></textarea>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Descripcion de eleccion Alumno Secundaria</label>
                <textarea class="form-control" readonly=""><?php echo $descr2  ?></textarea>


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