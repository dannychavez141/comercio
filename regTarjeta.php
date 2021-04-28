<?php //error_reporting(0);
 include_once'./cabezera.php';  
 require 'control/conexion.php';
    $conn = $mysqli;
 $id=$_GET['cod'];
 
  ?>

 <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a>
                </li>
                 <li class="breadcrumb-item active"><a href="verTarjeta.php">Seleccion de alumno para asignar targeta</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Alumno Seleccionado</a>
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
                    <h4 class="card-title" id="basic-layout-form">Alumno Seleccionado</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                           
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            
                        </ul>
                    </div>
                </div> 
                <?php  
                                    $sql = "

SELECT m.idMatricula,a.dni,concat(a.nomb,' ',a.apepa,' ',a.apema) as alu, a.ext, a.targeta ,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.descrEst
FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
where m.idMatricula='$id'";
                                        $registro = $mysqli->query($sql);
                                        while($datos = $registro->fetch_array())
                                        {   $iddoc=$datos[0];
                                            $dni=$datos[1];
                                            $nom=$datos[2];
                                            $grad=$datos[12]." ".$datos[14]." (".$datos[10].")";
                                           $actual=$datos[4];
                                          
                                            ?>
                <div class="card-body collapse in" id="registro">
                    <div class="card-block">
                        <form method="post" action="control/ctarjeta.php" id="registro">
                        
                            <div class="form-body">
                                <h4 class="form-section"><i class="icon-head"></i>Informacion de Alumno</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Dni Alumno</label>
                                            <input type="text"  class="form-control"  maxlength="8" placeholder="Dni Docente" name="dni" id='iddni' value="<?php echo $dni ?>" readonly="">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Buscar Tarjeta</label><br>
                                           <button type="button" class="btn btn-primary" onclick="targeta()">BUSCAR</button> 
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1">Apellidos y Nombres</label>
                                            <input type="text"  class="form-control" value="<?php echo $nom ?>" maxlength="50"placeholder="Nombre del Curso" name="nom" readonly="">
                                        </div> 
                                    </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Grado Y Seccion Actual</label>
                                            <input type="text"  class="form-control" value="<?php echo $grad ?>"maxlength="50"placeholder="Grado del Curso" name="grad" readonly="">
                                        </div>
                                    </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Codigo Tarjeta Actual:</label>
                                            <input type="text"  class="form-control" value="<?php echo $actual ?>"maxlength="50"placeholder="Tarjeta" name="tarjeta" id="actual" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput2">Codigo Nueva Tarjeta:</label>
                                            <input type="text"  class="form-control" v-model="idtarjeta" value="" maxlength="50"placeholder="Nueva Tarjeta" name="newtarjeta" require id="newtarjeta" readonly>
                                        </div>
                                    </div>
                                </div>                                                                                                    
                                </div>                             
                                
                                    <div class="form-actions">
                                <a href="verTarjeta.php"><button type="button" class="btn btn-warning mr-1">
                                    <i class="icon-cross2"></i> Cancelar
                                </button></a>
                                <button type="submit" v-if="reg==true" class="btn btn-primary" value="M" name="baccion">
                                    <i class="icon-check2"></i> Guardar
                                </button>
                            </div> 
                            

</form>
                                
                            </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>

</section>

      </div> </div> 

   <script type="text/javascript">
       buscar();
//targeta();


       function buscar()
      
       {
        var idactual = newtarjeta.value;
        var url = 'control/consulta_tarjeta.php';
         console.log("-----"+idactual);
   $.ajax({
        type:'POST',
        url:url,
        data:'id='+idactual,
        success: function(datos_dni){
            
            var datos = eval(datos_dni);
               
                if (datos==null) { console.log("vacio");
               //alert('APODERADO CON DNI: '+dni+" NO REGISTRADO");
            }

                else{ var idtar=datos[1];
                  var igual=datos[2];
 regalu.idtarjeta=idtar;
 //console.log("+++"+datos[0]);
// console.log("+++"+idtar);
 //console.log("+++"+igual);
//console.log("+++"+datos[4]);
regalu.reg=false;

      console.log(regalu.reg);        
              }

        }


    });  
      
 return false;

   }
   function targeta()
      
       {
        var idactual = newtarjeta.value;
        var url = 'control/consulta_tarjeta.php';
         console.log("-----"+idactual);
   $.ajax({
        type:'POST',
        url:url,
        data:'id='+idactual,
        success: function(datos_dni){
            
            var datos = eval(datos_dni);
               
                if (datos==null) { console.log("vacio");
               //alert('APODERADO CON DNI: '+dni+" NO REGISTRADO");
            }

                else{ var idtar=datos[1];
                  var igual=datos[2];
 regalu.idtarjeta=idtar;
 //console.log("+++"+datos[0]);
// console.log("+++"+idtar);
 //console.log("+++"+igual);
//console.log("+++"+datos[4]);
if (idtar!="") 
{
if (igual==false) {
  alert("Se puede asignar tarjeta")
regalu.reg=true;
}else{var alumno=datos[3];
  alert("Tarjeta ya asignada a otro alumno:"+alumno)
 regalu.reg=false;
}
}else
{ alert("Pase tarjeta por favor;")
  regalu.reg=false;

}
      console.log(regalu.reg);        
              }

        }


    });  
      
 return false;

   }
       var regalu = new Vue({
  el: '#registro',
  data: {
    idtarjeta: "",
    reg:false
    
  },
  methods: {
    
  }
});



   </script>
   
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php 
 include_once'./pie.php';  
?>