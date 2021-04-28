<?php error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
 $idDeuda=$_GET['cod'];
 //  ?>
 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item"><a href="verDeudas.php">Deudas Registradas</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Pagando Deuda</a>
                </li>
              </ol>
            </div>
          </div>
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        
<div class="content-body"><!-- Basic form layout section start -->
  <form class="form" action="control/cDeudas.php" method="post" id="registro">
<section id="basic-form-layouts">
    <div class="row match-height">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Pagando Deuda</h4>
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
                        
                        
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Deuda</h4>
                                                                
                                
                                   
                                    
 <div class="row">

  <div class="form-group">
                  <div class="col-md-10">
                    <table class="table">
                      <?php $slq="SELECT d.idDeuda,d.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alul,td.TipoDeudacol,d.fecha,d.vencimiento,d.monto,d.interes, 
d.descr,g.descr,s.descr,tg.descr, es.descrEst
FROM deuda d
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
join tipodeuda td on d.idTipoDeuda=td.idTipoDeuda
join grado g on m.idGrado=g.idGrado 
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo
JOIN estados es on d.est=es.idestados where idDeuda='$idDeuda';"; 
$Deudas=$mysqli->query($slq);
$deuda=$Deudas->fetch_array();

//echo $deuda[0];
//echo $slq;

?>

                                    <tr><td> <label for="projectinput1">Nro de Deuda:<font color="red">*</font></label>
                             <input type="text"  class="form-control"  maxlength="30"placeholder="Nro de Deuda" name="iddeuda" required="" 
                             readonly="" value="<?php echo $deuda[0]?>" >
                                       
                                       </td>
                                       <td> <label for="projectinput1">Dni Alumno <font color="red">*</font></label>
                             <input type="text"  class="form-control"  maxlength="30"placeholder="Dni Alumno " name="dni1" required="" 
                             readonly="" value="<?php echo $deuda[2]?>" >
                                       
                                       </td>

                                  </tr>
                                  <tr >
                                    <td colspan="2"> <label for="projectinput6"> Alumno </label>
                 <input type="text"  class="form-control"  maxlength="30"placeholder="Apellidos y Nombres " required="" readonly=""
                                           value="<?php echo $deuda[3]?>">
</tr>
<tr>
                                    <td colspan="2">  <label for="projectinput6">Descripcion de Deuda</label>
                <textarea class="form-control" name="descr1"required="" readonly=""><?php echo $deuda[9]?></textarea>
</td>
                                  </tr>
                                  <tr>
                                    <td> <label for="projectinput6">Seleccione el tipo de deuda: <?php echo $deuda[4]?></label>

                                    </td>
                                    
                                  </tr>
                                  
                                  
<tr><td> <label for="projectinput1">Dni Familiar:<font color="red">*</font></label>
                             <input type="text"  class="form-control"  maxlength="30"placeholder="Dni Familiar" name="dni1" required="" 
                             readonly="" v-model="dni1" >
                                       <input type="hidden" name="idapo" v-model="id">
                                       </td>
                                       <td><button type="button" class="btn btn-outline-primary " data-toggle="modal" data-target="#iconModal1">
                                       BUSCAR FAMILIAR 
                                    </button></td>

                                  </tr>
                                  <tr >
                                    <td colspan="2"> <label for="projectinput6"> Datos de Familiar: </label>
                 <input type="text"  class="form-control"  maxlength="30"placeholder="Apellidos y Nombres " name="datos1" required="" readonly="" v-model="datos1">
</tr>
<tr>
                                    <td>
                                       <label for="projectinput6"> MONTO : S/.</label><br>
                 <input type="text" class="form-control" name="monto"  placeholder="0.00" value="<?php echo number_format($deuda[7],2);?>" readonly="">
                                      
                                    </td>
                                    <td colspan="2">
                                       <label for="projectinput6"> INTERES POR VENCIMIENTO : S/.</label>
                 <input type="text" class="form-control" name="interes"  placeholder="0.00" value="<?php echo number_format($deuda[8],2);?>" readonly="" >
                                      
                                    </td>
                                  </tr>
<tr>
  <td>
    <label for="projectinput6"> TOTAL DEUDA: S/.</label>
    <input type="text" name="total"  class="form-control" placeholder="0.00" value="<?php echo number_format($deuda[7]+$deuda[8],2);?>" readonly="">
  </td>
  <td>
    <label for="projectinput6"> DINERO RECIBIDO: S/.</label><br>
    <input type="text" name="recibido"  class="form-control" placeholder="0.00"  onkeypress="return NumCheck(event, this)" value="" v-model="recibido" id="caja_recibido">
  </td>
  <td>
    <label for="projectinput6"> VUELTO: S/.</label><br>
    <input type="text" name="vuelto"  class="form-control" placeholder="0.00" value="" v-model="vuelto" onkeypress="return NumCheck(event, this)">


  </td>
</tr>
<tr>
                                    <td>
                                       <label for="projectinput6">TIPO DE COMPROBANTE:</label>
                                      <select id="tipocomp" name="tipocomp" class="form-control" >
                                                <option value="1">BOLETA DE VENTA</option>
                                                 <option value="2">FACTURA</option>
                                            </select>    
                                    </td>
                                    <td>
                                       <label for="projectinput6">METODO DE PAGO</label>
                                      <select id="tipopago" name="tipopago" class="form-control" >
                                             <?php  
                                    $query = "SELECT * FROM tipopago";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                               <?php } ?>
                                            </select>    
                                    </td>
                                    <td  v-if="vuelto<0">
                                       <label for="projectinput6">Pago parcial:</label>
                                       <input type="checkbox" id="checkbox2" v-model="checked2" name="parcial">
                                    </td>
                                    <td>
                                       <label for="projectinput6"> Confirmar datos:</label>
                                       <input type="checkbox" id="checkbox" v-model="checked">
                                    </td>
                                  </tr>

                                  </table>
                     
                                        </div>
                                    </div>                                  
                                                                    </div>
                               <div class="form-actions">
                                <a href="index.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" v-if="btalu1==1 && checked==true && vuelto>=0"class="btn btn-primary" value="M" name="baccion">
                                    <i class="icon-check2"></i> Guardar
                                </button>
                                <button type="submit" v-if="btalu1==1 && checked==true && checked2==true && recibido>=(monto/2)"class="btn btn-primary" value="M" name="baccion">
                                    <i class="icon-check2"></i> Guardar
                                </button>
                            </div>


                                    <!-- Modal -->
                                    <div class="modal fade text-xs-left" id="iconModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel2"><i class="icon-road2"></i>Apoderados Registrados</h4>
                                          </div>
                                          <div class="modal-body">
                                           <div class="card-header no-border">
                
               
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    
                        
                         <fieldset class="form-group position-relative has-icon-left mb-0">
                           
                            <center>
<section class="principal" >
<a href="regApoderado.php" target="-blank" ><button class="btn btn-primary" type="button">REGISTRAR FAMILIAR</button></a>
  <div class="formulario">
    <label for="caja_busqueda">Buscar:</label>
    <input type="text"  name="caja_busqueda" id="caja_busqueda" placeholder="Inserte familiar a buscar" class="form-control"></input>
                                            
  </div>
<br>
  <div id="datos"></div>

</section>
              </center>  
                           
                        </fieldset> 
                             
                    
                </div>
            </div>
    

                                          </div>
                                          <div class="modal-footer">
                                            
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                        </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>

</section>

</form>  

      </div> </div> 

   
  <script type="text/javascript" src="js/bapopago.js"></script>
  <script type="text/javascript" src="js/numeral.min.js"></script>
   <script type="text/javascript">

    var rapepa="",rapema="",rnom="";
    var f = new Date();
       var elegidos = new Vue({
  el: '#registro',
  data: {
    id:0,
    dni1: "",
    datos1: "",
    btalu1:0,
    monto: <?php echo number_format($deuda[7]+$deuda[8],2);?>,
    recibido:0.00,
    vuelto:<?php echo number_format(($deuda[7]+$deuda[8])*-1,2);?>,
    checked:'',
    checked2:'',
    dniapo:''
    
  }
});

function buscarele(dni){

var dniapo="";
dniapo=dni;
 
        var url = 'control/consulta_apoderado.php';
 
   $.ajax({
        type:'POST',
        url:url,
        data:'dni='+dniapo,
        success: function(datos_dni){
            
            var datos = eval(datos_dni);
               
                if (datos==null) { console.log("vacio");
                alert('FAMILIAR CON DNI: '+dniapo+" NO REGISTRADO");
                regalu.btalu1=0;
            }

                else
                  { elegidos.id=datos[4];
                     elegidos.dni1=datos[0];
                    elegidos.datos1=datos[1];
                    elegidos.btalu1=1;
                    console.log(elegidos.btalu1+"-"+elegidos.id);

            }

        }


    });  


          
 return false;

}

$(document).on('keyup','#caja_recibido', function(){
  var valor = $(this).val();
 
  elegidos.vuelto=valor-elegidos.monto;

elegidos.vuelto= numeral(elegidos.vuelto).format('0.00');
});

    </script>
    <?php 
 include_once'./pie.php';  
?>