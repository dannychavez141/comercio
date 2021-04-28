<?php 
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Registrando Grado</a>
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
                    <h4 class="card-title" id="basic-layout-form">Registrando Grado</h4>
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
                            <p>Por favor ingrese los datos del Grado a Registrar</p>
                        </div>
                        <form class="form" action="control/cGrado.php" method="post" id="registro">
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Grado</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Codigo del Grado<font color="red">*</font></label>
                                            <input type="text" v-model="id" class="form-control" maxlength="8" onkeypress="return numeros(event)"placeholder="codigo" name="id" required="" readonly="" >
                                        </div>
                                    </div>
                                   
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Nombre del Grado <font color="red">*</font></label>
                                            <input type="text" v-model="grado" class="form-control" maxlength="30"placeholder="Nombre del Grado" name="grado" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Tipo de Grado</label>
                <select id="projectinput6" name="tipo" class="form-control">
                                               <?php  
                                    $query = "SELECT * FROM tipogrado where est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Estado</label>
                                            <select id="projectinput6" name="est" class="form-control">
                                                <option value="1">ACTIVO</option>
                                                <option value="2">INACTIVO</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                
                            </div>

                            <div class="form-actions">
                                <a href="index.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" class="btn btn-primary" value="R" name="baccion">
                                    <i class="icon-check2"></i> Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</section>



      </div> </div> 

    <script type="text/javascript">
   
       var reggrad = new Vue({
  el: '#registro',
  data: {
    id: "AUTOGENERADO",
    grado:""
  }
});

    </script>
 
    <?php 
 include_once'./pie.php';  
?>