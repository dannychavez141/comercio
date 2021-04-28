<?php error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 $id=$_GET['cod'];
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li> 
                <li class="breadcrumb-item"><a href="verAnio.php">Ver Año Escolar</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Modificando Año Escolar</a>
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
                    <h4 class="card-title" id="basic-layout-form">Modificando Año Escolar</h4>
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
                        <div class="card-text">
                            <p>Por favor ingrese los nuevos datos del Año Escolar</p>
                        </div>
                        <form class="form" action="control/cAnio.php" method="post" id="registro">
                            <?php  
                                    $sql = "SELECT * FROM anioescolar a 
join estados e on a.est=e.idestados where a.idAnioEscolar=$id;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $id=$datos[0];
                                            $anio=$datos[1];
                                            $idest=$datos[3];
                                             $est=$datos[4];
                                           
                                            ?>
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion del Año Escolar</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Codigo<font color="red">*</font></label>
                                            <input type="text" class="form-control" maxlength="8" onkeypress="return numeros(event)"
                                              value="<?php echo $id ?>"  name="id"required=""  readonly=""> 
                                           
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Nombre del Año Escolar <font color="red">*</font></label>
                                            <input type="text" v-model="anio" class="form-control" onkeypress="return numeros(event)" maxlength="5"placeholder="Nombre del Año Escolar" name="anio" required="">
                                        </div>
                                    </div>
                                </div>
                                
                                  
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Estado</label>
                                            <select id="projectinput6" name="est" class="form-control">
                                                <option value="<?php echo $idest ?>"><?php echo $est ?></option>
                                                <option value="1">ACTIVO</option>
                                                <option value="2">INACTIVO</option>
                                               
                                               
                                            </select>
                                        </div>
                                    </div>
                                
                            </div>

                            <div class="form-actions">
                                <a href="verCurso.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" class="btn btn-primary" value="M" name="baccion">
                                    <i class="icon-check2"></i> Guardar
                                </button>
                            </div>
                             <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</section>



      </div> </div> 

    <script type="text/javascript">
    
       var regalu = new Vue({
  el: '#registro',
  data: {
    anio: "<?php echo $anio ?>",
  
  }
});

    </script>
 
    <?php 
 include_once'./pie.php';  
?>