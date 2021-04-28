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

            <li class="breadcrumb-item active"><a href="#">Creacion de Ficha</a>
            </li>
        </ol>
    </div>
    <!-- <link href="js/estilo.css" rel="stylesheet" type="text/css"/>-->
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
                                <h4 class="card-title" id="basic-layout-form">BUSCAR TRABAJOS EN EL REPOSITORIO</h4>
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

                                    <form class="form"  method="post" id="registro" enctype="multipart/form-data"v-on:submit.prevent="confirmar()">
                                        <div class="form-body">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Buscar por tema:</label>
                                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese Busqueda" onkeyup="buscarTrabajos()" >

                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Buscar por Cargo:</label>
                                                        <select class="form-control" v-model="curso" onclick="buscarTrabajos()">
                                                            <option v-for="curso in cursos" v-bind:value="curso">
                                                                {{ curso[7]+" ("+curso[27]+" "+curso[31]+" "+curso[34]+" "+curso[37]+")"}}
                                                            </option>
                                                        </select>
                                                       <!--<span>Seleccionado: {{ curso }}</span>-->

                                                    </div> 
                                                </div>
                                            </div>


                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr class="bg-warning">
                                                                <th>NRO</th>
                                                                <th>DESCRIPCION</th>
                                                                <th>CURSO</th>
                                                                <th>AULA</th>
                                                                <th>FECHA</th>
                                                                <th>EDITAR</th>
                                                            </tr>
                                                            <tr v-for="trabajo in trabajos">
                                                                <td>{{trabajo['idtrabajos']}}</td>
                                                                <td>{{trabajo['descrTrab']}}</td>
                                                                <td>{{trabajo['curso']}}</td>
                                                                <td>{{trabajo['grado']+" "+trabajo['seccion']+" "+trabajo['anio']}}</td>
                                                                <td>{{trabajo['fecha']}}</td>
                                                                <td align="center"><a v-bind:href="'./adminTrabajo.php?idtra='+trabajo['idtrabajos']"><button type="button"><img src="../img/edit.jpg" alt="" width="30"></button></a></td>
                                                            </tr>
                                                            <tr v-if="trabajos.length==0" >
                                                                <td colspan="6" align="center">USTED NO REGISTRO NINGUN TRABAJO EN EL CURSO DE ESTE SALON AL REPOSITORIO</td>

                                                            </tr>
                                                        </table>

                                                    </div>
                                                </div>

                                            </div> 



                                        </div>  
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </section>
            <script src="../js/funciones.js" type="text/javascript"></script>
            <script src="js/vTrabajo.js" type="text/javascript"></script>

        </div> </div> 
</div>

<!-- ////////////////////////////////////////////////////////////////////////////-->
<?php
include_once'./pie.php';
