<?php
include_once'./cabezera.php';
$fcha = date("Y-m-d");
?>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<meta http-equiv=”Content-Type” content=”text/html; charset=ISO-8859-1″ />
<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a>
            </li>

            <li class="breadcrumb-item active"><a href="#">Visualizacion de Fichas</a>
            </li>
        </ol>
    </div>
</div>
<script>
    usuario = '<?php echo $usuario; ?>';
    idusuario = '<?php echo $idusuario; ?>';
    fcha = '<?php echo $fcha; ?>';
</script>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-body"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Fichas de seguimiento de clases virtualess</h4>
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

                                    <form class="form" action="control/cIncidencia.php" method="post" id="registro">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="icon-head"></i>Informacion de Seguimiento</h4>
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Curso a Cargo:</label>
                                                        <select class="form-control" v-model="curso" onclick="fichasDoc()" id="cmbCurso">
                                                            <option value="-1" >TODOS LOS CURSOS ASIGNADOS</option>
                                                            <option v-for="curso in cursos" v-bind:value="curso">
                                                                {{ curso[7]+" ("+curso[27]+" "+curso[31]+" "+curso[34]+" "+curso[37]+")"}}
                                                            </option>
                                                        </select>
                                                      <!--  <span>Seleccionado: {{ curso }}</span>-->
                                                    </div> 
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">FECHA LIMITE:</label>
                                                        <input type="date"  class="form-control" v-model="fecha" onclick="fichasDoc()">

                                                    </div>

                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                    <label >VER TODOS</label>   
                                                        <input type="checkbox"  class="form-control" v-model="chktodos" onclick="fichasDocChk()"> 

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <table border="2" class="table table-bordered">
                                                            <thead class="bg-warning">
                                                                <tr align="center">
                                                                    <th >ID DE FICHA</th>
                                                                    <th>CURSO</th>
                                                                    <th>GRADO Y SECCION</th>
                                                                    <th>FECHA</th>
                                                                    <th>IMPRIMIR FICHA</th>
                                                                    <th>MANTENIMIENTO</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="ficha in fichas">
                                                                    <td>{{ficha['idfichacontrol']}}</td>
                                                                    <td>{{ficha['curso']}}</td>
                                                                    <td>{{ficha['grado']+' '+ficha['seccion']+' '+ficha['nivel']+' '+ficha['anio']}}</td>
                                                                    <td>{{ficha['fecha']}}</td>
                                                                    <td><a v-bind:href="'../reporteexcel/repFicha.php?id='+ficha['idfichacontrol']" target="_blank"><button type="button" class="btn btn-success">VER FICHA</button></a></td>
                                                                    <td><a v-bind:href="'./modFicha.php?id='+ficha['idfichacontrol']" ><button type="button" class="btn btn-warning">EDITAR </button></a></td>
                                                                </tr>
                                                               
                                                            </tbody>
                                                        </table>

                                                        
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
            <script src="../js/funciones.js" type="text/javascript"></script>
            <script src="js/vFicha.js" type="text/javascript"></script>

        </div> </div> 


    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php
    include_once'./pie.php';
    ?>