<?php 
 include_once'./cabezera.php';  
 require 'control/conexion.php';
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Niveles Educativos Registrados</a>
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
                    <h4 class="card-title" id="basic-layout-form">NIVELES EDUCATIVOS</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                           
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            
                        </ul>
                    </div>
                </div> 
                <div class="card-body collapse in" id="registro">
                    <div class="card-block">                                      
                                <h4 class="form-section"><i class="icon-clipboard4"></i> Nieveles educativos Registrados </h4>
                                <br>
                                 <div class="row">
                                     <table class='table table-striped ' border='1'>
                                        <thead class='bg-warning'>
                            <tr>
                                <th>CODIGO</th>
                                <th>DESCRIPCION NIVEL EDUCATIVO</th>
                                <th>ESTADO</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead> 
<tbody>
                            <form action="control/cNiveledu.php" method="post">
                            <tr><td>GENERADO<input type="hidden" name="idcur" value="<?php echo $idcur ?>">
                            </td><td><input type="text" name="descr" value="<?php echo $dato[2] ?>" size="30" require></td><td>
                            <select name="est">
                                <option value="1">ACTIVO</option>
                                <option value="2">INACTIVO</option>
                            </select></td>
                            <td><button  class="btn btn-info" value="R" name="baccion">
                                    <i class="icon-plus4"></i> Agregar
                                </button></td></tr>
                        </form>
<?php  $vacio=true;
                                    $sql1 = "SELECT * FROM tipogrado  t
join estados e  on t.est=e.idestados;";
                                        $reg = $mysqli->query($sql1);
                                        while($dato = $reg->fetch_array())
                                        {   $vacio=false;
                                           
                                            ?>
                        <form  action="control/cNiveledu.php" method="post" >
                       
                            <tr><td><?php echo $dato[0] ?>
                                <input type="hidden" name="id" value="<?php echo $dato[0] ?>">
                            </td><td><input type="text" name="descr" value="<?php echo $dato[1] ?>" size="30"></td><td>
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
 ?> <tr><td colspan="4"> NO HAY NIVELES EDUCATIVOS REGISTRADOS</td></tr>
<?php  }?> </div>
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