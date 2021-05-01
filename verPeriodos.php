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
                
                <li class="breadcrumb-item active"><a href="#">Periodos</a>
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
                    <h4 class="card-title" id="basic-layout-form">Periodos Registrados</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                           
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            
                        </ul>
                    </div>
                    <br>
                                 <div class="row">
                                     <table class='table table-striped ' border='1'>
                                        <thead class='bg-blue'>
                            <tr>
                                <th>CODIGO</th>
                                <th>DESCRIPCION DE CAPACIDAD</th>
                                <th>ESTADO</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead> 
<tbody>
                            

<?php  $vacio=true;
                                    $sql1 = "SELECT * FROM periodos p 
join estados e on p.est=e.idestados";
                                        $reg = $mysqli->query($sql1);
                                        while($dato = $reg->fetch_array())
                                        {   $vacio=false;
                                           
                                            ?>

                                   
                        <form  action="control/cperiodo.php" method="post" >
                       
                            <tr><td><?php echo $dato[0] ?>
                               <input type="hidden" name="id" value="<?php echo $dato[0] ?>">
                            </td>
                            <td><?php echo $dato[1] ?></td><td>
                            <select name="est">
                                <option value="<?php echo $dato[3] ?>"><?php echo $dato[4] ?></option>
                                <option value="1">ACTIVO</option>
                                <option value="2">INACTIVO</option>
                            </select></td>
                            <td><button class="btn btn-warning" value="M" name="baccion">
                                    <i class="icon-file-subtract"></i> Editar
                                </button></td></tr>
                        </form>
                                
<?php } ?>
</tbody></table>
<?php if ($vacio) {
 ?> <tr><td colspan="4"> NO HAY COMPETENCIAS REGISTRADAS AL CURSO</td></tr>
<?php  }?>


                                </div>
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