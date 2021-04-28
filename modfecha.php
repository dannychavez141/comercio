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
                <li class="breadcrumb-item active"><a href="#">Registrando Fechas al Calendario Civico</a>
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
                    <h4 class="card-title" id="basic-layout-form">Registrando Fechas al Calendario Civico</h4>
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
                            <p>Por favor ingrese los datos de Fecha al Calendario Civico a Registrar</p>
                        </div>
                        <form class="form" action="control/cFechas.php" method="post" id="registro">
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Fecha</h4>
                               <?php  
                                    $sql = "SELECT * FROM calendario c 
join estados e on c.est=e.idestados
where c.idcalendario=$id;";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $id=$datos[0];
                                            $descr=$datos[1];
                                             $dia=$datos[2];
                                            $idmes=$datos[3];
                                            $idest=$datos[6];
                                             $est=$datos[7];
                                             switch ($idmes) {
        case '1':
        $mes='ENERO';
        break;
        case '2':
        $mes='FEBRERO';
        break;
        case '3':
        $mes='MARZO';
        break;
        case '4':
        $mes='ABRIL';
        break;
        case '5':
        $mes='MAYO';
        break;
        case '6':
        $mes='JUNIO';
        break;
        case '7':
        $mes='JULIO';
        break;
        case '8':
        $mes='AGOSTO';
        break;
        case '9':
        $mes='SEPTIEMBRE';
        break;
        case '10':
        $mes='OCTUBRE';
        break;
        case '11':
        $mes='NOVIEMBRE';
        break;
        case '12':
        $mes='DICIEMBRE';
        break;

    
    default:
        # code...
        break;
}
                                           }
                                            ?>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Codigo del Fecha<font color="red">*</font></label>
                                            <input type="text" class="form-control" maxlength="8" onkeypress="return numeros(event)"placeholder="codigo" name="id" required="" readonly="" value="<?php echo $id ?>" >
                                        </div>
                                    </div>
                                   
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1">Descripcion de celebracion<font color="red">*</font></label>
                                            <textarea name="descr" class="form-control" placeholder="Descripcion de celebracion" required=""><?php echo $descr ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">DIA</label>
                <select id="projectinput6" name="dia" class="form-control">
                                               <option value="<?php echo $dia ?>"><?php echo $dia ?></option>
                                               <?php  

                                   for ($i=1; $i <= 31 ; $i++) { 
                                       ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                               <?php } ?>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">MES</label>
                                            <select id="projectinput6" name="mes" class="form-control">


                                                <option value="<?php echo $idmes ?>"><?php echo $mes ?>                       
                                                </option>
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
                                                <option value="11">NOVIEMBRE</option>
                                                <option value="12">DICIEMBRE</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput6">Estado</label>
                                            <select id="projectinput6" name="est" class="form-control">
                                               <option value="<?php echo $idest ?>"><?php echo $est ?>                       
                                                </option>
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
                                <button type="submit" class="btn btn-primary" value="M" name="baccion">
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
   
       var regalu = new Vue({
  el: '#registro',
  data: {
    id: "AUTOGENERADO",
    cur:""
  }
});

    </script>
 
    <?php 
 include_once'./pie.php';  
?>