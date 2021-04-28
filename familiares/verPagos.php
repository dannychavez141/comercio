<?php 
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 //  
 ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Ver Deudas Pendientes</a>
                </li>
              </ol>
            </div>
          </div>

          <?php  ?>
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        
      <!-- Table head options with primary background start -->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DEUDAS PENDIENTES DE ALUMNOS APODERADOS</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                      
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                    
                </div>
                <div class="table-responsive">
                    <center>

                      <?php 
 $idusuario=$_COOKIE['idUsuario'];
                            if ($idusuario=="") {
                               $idusuario="******************";
                            }


                        $sql = "SELECT dni FROM apoderado where idApoderado='$idusuario';";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $dni=$datos[0];
                                        }


                       ?>
                        <script type="text/javascript"> var id=<?php echo "".$dni ?>;</script>
<section class="principal" >
  <div class="formulario">
    <label for="caja_busqueda">Buscar:</label>

    <label for="projectinput6">Alumnos(as):</label>
                                            <select id="dnialu" name="dnialu" onchange="buscar()" class="browser-default custom-select">
                                                 <option value="0">TODOS LOS ALUMNOS APODERADOS</option>
                                                <?php  
                                    $query = "SELECT a.dni,
concat(a.nomb,' ',a.apepa,' ',a.apema ) as alum
FROM alumnos a where a.dniapo='$dni'";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>
                                             <label for="projectinput6">Fecha:</label> 
    <select id="mes" onchange="buscar()" name="mes" class="browser-default custom-select">
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
    </select>
    <label for="projectinput6">Año Escolar:</label>
                                            <select id="anio" name="anio" onchange="buscar()" class="browser-default custom-select">
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
<section id="basic-modals">
  <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">

                  <!-- Modal -->
                  <div class="modal fade text-xs-left" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel2"><i class="icon-road2"></i>Detalles de Deuda</h4>
                      </div>
                      <div class="modal-body" id="detallemod">
                     <table>
                        <tr>
                          <th>Nro de Pago:</th>
                          <td>{{idpag}}</td>
                        </tr>
                        <tr>
                          <th>Nro de Deuda:</th>
                          <td>{{iddeu}}</td>
                        </tr>
                        <tr>
                          <th>Realizado por:</th>
                          <td>{{familiar}}</td>
                        </tr>
                        <tr>
                          <th>Alumno(a):</th>
                          <td>{{alumno}}</td>
                        </tr>
                        <tr>
                          <th>Metodo de pago:</th>
                          <td>{{tipo}}</td>
                        </tr>
                         <tr>
                          <th>Concepto:</th>
                          <td>{{concep}}</td>
                        </tr>
                        <tr>
                          <th>Fecha de Pago:</th>
                          <td>{{pfec}}</td>
                        </tr>
                        <tr>
                          <th>Monto:</th>
                          <td>S/.{{monto}}</td>
                        </tr>
                        <tr>
                          <th>Interes Acumulado:</th>
                          <td>S/.{{interes}}</td>
                        </tr>
                        <tr>
                          <th>Total de Deuda:</th>
                          <td>S/.{{total}}</td>
                        </tr>
                        <tr>
                          <th>Monto Recibido:</th>
                          <td>S/.{{recibido}}</td>
                        </tr>
                        <tr>
                          <th>Vuelto:</th>
                          <td>S/.{{vuelto}}</td>
                        </tr>

                      </table>
          
                      
                      <div class="modal-footer">
                      <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
<button type="button" class="btn btn-outline-danger" v-if="estado==1" onclick="anular()">Anular Pago</button>
                     
                     </div>
                      
                     </div>
                      </div>
                    </div>
                    </div>
                  </div>   
                </div>
              </div>

</section>

<br>
  <div id="datos" onload="buscar()"></div>

</section>
              </center>      
                      

                </div>
            </div>
 </div> 

 <script type="text/javascript" src="js/bpagos.js"></script>
  <script type="text/javascript">
  var deuda = new Vue({
  el: '#detallemod',
  data: {
    iddeu: "",
     idpag: "",
    alumno: "",
     familiar: "",
    tipo: "",
    pfec: "",
    monto: 0.00,
    interes: 0.00,
    total: 0.00,
    recibido:0.00,
    vuelto:0.00,
    est:false,
   concep:"",
    estado:1
    
  }
  
});

  function detalles(idpag,iddeu,alum,apo,tip,mont,inte,pfecha,ddescr,recibido,vuelto,est) {
   console.log(ddescr);
    deuda.iddeu=iddeu;
      deuda.idpag=idpag;
        deuda.alumno=alum;
        deuda.familiar=apo;
        deuda.tipo=tip;
        deuda.monto=parseFloat(mont).toFixed(2);
        deuda.interes=parseFloat(inte).toFixed(2);
        deuda.concep=ddescr;
        deuda.pfec=pfecha;
        deuda.total=parseFloat(inte+mont).toFixed(2);
        deuda.estado=est;
        deuda.vuelto=parseFloat(vuelto).toFixed(2);
        deuda.recibido=parseFloat(recibido).toFixed(2);
       
    }


   
  

    </script>

    <?php 
 include_once'./pie.php';  
?>