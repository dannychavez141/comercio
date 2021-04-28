<?php 
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 $hoy=date('Y-m-d');
 $año=date('Y')-5;
 $dia=date('m-d');
 $fecha=$año.'-'.$dia;
if (isset($_GET['recibo'])) {
  $recibo=$_GET['recibo'];
   $url="../pdfpago.php?cod=".$recibo;
echo "<script language=javascript>
window.open('".$url."', 'RECIBO DE PAGO', 'width=500, height=500');
</script>";
}
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Ver Deudas y Pensiones</a>
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
                <h4 class="card-title">DEUDAS Y PENSIONES REGISTRADAS </h4>
              
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
    <label for="projectinput6">Meses:</label> 
    <select id="fecha" onchange="buscar()" name="fecha">
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
                          <th>Nro de Deuda:</th>
                          <td>{{id}}</td>
                        </tr>
                        <tr>
                          
                          <th>Alumno(a):</th>
                          <td>{{alumno}}</td>
                        </tr>
                        <tr>
                          <th>Tipo de Deuda:</th>
                          <td>{{tipo}}</td>
                        </tr>
                         <tr>
                          <th>Concepto:</th>
                          <td>{{concep}}</td>
                        </tr>

                        <tr>
                          <th>Fecha de creacion:</th>
                          <td>{{ifec}}</td>
                        </tr>
                        <tr>
                         <tr>
                          <th>Dias activo:</th>
                          <td>{{dias}}</td>
                        </tr>
                          <th>Fecha de Vencimiento:</th>
                          <td>{{vfec}}</td>
                        </tr>
                         <tr>
                          <th>Dias para vencer:</th>
                          <td><div class="alert alert-danger" role="alert" v-if="vdias<0">
                        <span class="text-bold-600">Notificacion!</span> La deuda ya vencio y esta generando intereses
                      </div>
                      <div class="alert alert-warning" role="alert" v-if="vdias==0">
                        <span class="text-bold-600">Notificacion!</span> La deuda vence hoy
                      </div>
                      <div class="alert alert-success" role="alert" v-if="vdias>0">
                        <span class="text-bold-600">Notificacion!</span> La deuda tiene {{vdias}} dias para vencer
                      </div>
                    </td>
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

                      </table>
          
                      
                      <div class="modal-footer">
                      <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
<button type="button" class="btn btn-outline-danger" v-if="estado==1" onclick="anular()">Anular Deuda</button>
                      <button type="button" v-if="estado==1" class="btn btn-outline-primary" onclick="pagar()">Realizar Pago</button>
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

 <script type="text/javascript" src="js/bdeudas.js"></script>
 <script type="text/javascript">
  var deuda = new Vue({
  el: '#detallemod',
  data: {
    id: "",
    alumno: "",
    tipo: "",
    ifec: "",
    vfec: "",
    monto: 0.00,
    interes: 0.00,
    total: 0.00,
    est:false,
   concep:"",
    dias:0,
    vdias:0,
    estado:1
    
  }
  
});

  function detalles(id,alum,tip,mont,inte,ifecha,vfecha,ddescr,est) {
    console.log(ddescr);
    deuda.id=id;
        deuda.alumno=alum;
        deuda.tipo=tip;
        deuda.monto=parseFloat(mont).toFixed(2);
        deuda.interes=parseFloat(inte).toFixed(2);
        deuda.ifec=ifecha;
        deuda.concep=ddescr;
        deuda.vfec=vfecha;
        deuda.total=parseFloat(inte+mont).toFixed(2);
        deuda.estado=est;
      var f = new Date();
var hoy=f.getFullYear() + "-" + (f.getMonth() +1) + "-" +f.getDate()  ;
console.log(hoy);
deuda.dias=restaFechas(ifecha,hoy);
deuda.vdias=restaFechas(hoy,vfecha);
       
    }


   function restaFechas (f1,f2)
 {
 var aFecha1 = f1.split('-');
 var aFecha2 = f2.split('-');
 var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]);
 var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]);
 var dif = fFecha2 - fFecha1;
 var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
 return dias;
 }
 function pagar()
 { var url="pagar.php?cod="+deuda.id;
 //console.log(url);
 window.location.href = url;
 }
  function anular()
 { var url="control/anular.php?cod="+deuda.id;
 //console.log(url);
var statusConfirm = confirm("¿Deseas Anular esta deuda?"); 
if (statusConfirm == true) 
{ 
window.location.href = url; 

} 
 }

    </script>
    <?php 
 include_once'./pie.php';  
?>