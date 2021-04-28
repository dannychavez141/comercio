<?php 
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 $hoy=date('Y-m-d');
 $año=date('Y')-5;
 $dia=date('m-d');
 $fecha=$año.'-'.$dia;

 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Ver Pagos Registrados</a>
                </li>
              </ol>
            </div>
          </div>
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        
      <!-- Table head options with primary background start -->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">PAGOS REGISTRADOS </h4>
              
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
<section class="principal" >
  <div class="formulario">
    <label for="caja_busqueda">Buscar:</label>
    <input type="text"  name="caja_busqueda" id="caja_busqueda" placeholder="Inserte Alumno a buscar" size="20"></input>
    <label for="projectinput6">Fecha:</label> 
    <select id="fecha" onchange="buscar()" name="fecha">
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
     <label for="projectinput6">TIPO:</label>
                                            <select id="tipo" name="tipo"  onchange="buscar()">
                                             <?php  
                                    $query = "SELECT * FROM tipodeuda";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>   
                                             <label for="projectinput6">COMPROBANTE:</label>
                                      <select id="tcomp" name="tcomp" onchange="buscar()">
                                                <option value="1">BOLETA DE VENTA</option>
                                                 <option value="2">FACTURA</option>
                                            </select>                                      
    <label for="projectinput6">Grado:</label>
                                            <select id="grado" name="grado" onchange="buscar()">
                                              <?php  
                                    $query = "SELECT * FROM grado g 
join tipogrado tg on g.idTipo=tg.idTipo 
where  g.est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1]." (".$row[5].")"; ?></option>
                                               <?php } ?>
                                            </select>
                                             <label for="projectinput6">Seccion:</label>
                                            <select id="secc" name="seccion" >
                                                <?php  
                                    $query = "SELECT * FROM seccion where est=1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>
                                            <label for="projectinput6">Año Escolar:</label>
                                            <select id="anio" name="anio" onchange="buscar()">
                                                <?php  
                                    $query = "SELECT * FROM anioescolar where est= 1 order by idAnioEscolar desc;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>
                                            <label for="projectinput6">Estado:</label>
                                            <select id="est" name="est" onchange="buscar()">
                                                <option value="1">ACTIVOS</option>
                                               <option value="5">ANULADOS</option>
                                            </select>
                     
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
<br>


  <div id="datos" onload="buscar()"></div>
</section>
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


   
  function anular()
 { var url="control/anularpago.php?cod="+deuda.idpag+"&deu="+deuda.iddeu;
 //console.log(url);
var statusConfirm = confirm("¿Deseas Anular esta Pago?"); 
if (statusConfirm == true) 
{ 
window.location.href = url; 

} 
 }

    </script>
    <?php 
 include_once'./pie.php';  
?>