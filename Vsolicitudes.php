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
            <li class="breadcrumb-item active"><a href="#">Ver Docentes</a>
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
                        <h4 class="card-title">SOLICITUD DE RETIRO</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in" id="datos">
                        <div class="card-block card-dashboard">
                            <div class="table-responsive">
                                <center>
                                    <section class="principal" >
                                        <div class="formulario">
                                            <label for="caja_busqueda">Buscar:</label>
                                            <input type="text"  class="form-control"name="caja_busqueda" id="caja_busqueda" placeholder="Inserte Docente a buscar" size="50">

                                        </div>
                                        <br>
                                        <div class="table-responsive" align="center">
                                            
                                            <table border="1"  class="table table-sm ">
                                                <thead >
                                                    <tr class="bg-warning">
                                                        <th rowspan="2">Nro</th>
                                                        <th colspan="2">Datos de Alumno</th>
                                                        <th rowspan="2">Grado y Seccion</th>
                                                        
                                                        <th colspan="3">Datos de Apoderado</th>
                                                       
                                                        <th rowspan="2">Mantenimiento</th>
                                                    </tr>
                                                    <tr class="bg-warning">
                                                     
                                                        <th>Dni Alumno</th>
                                                        <th>Datos de Alumno</th>
                                                        
                                                        <th>Dni Apoderado</th>
                                                        <th>Datos de Apoderado</th>
                                                        <th>Nro de Celular</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                  
                                                </tbody>
                                            </table>

                                        </div>
                                    </section>
                                </center>      


                            </div>  
                        </div>

                    </div>
                </div> 

                <script src="js/jsSolicitudes.js" type="text/javascript"></script>
                <?php
                include_once'./pie.php';
                ?>

                </html>
