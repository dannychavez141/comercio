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
            <li class="breadcrumb-item active"><a href="#">Ver Todas las Matriculas</a>
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
                        <h4 class="card-title">MATRICULAS REGISTRADAS</h4>
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
                                        <div>
                                            <label for="caja_busqueda">BUSCAR POR DATOS DE ALUMNO O APODERADO:</label>
                                            <input type="text"  name="caja_busqueda" id="caja_busqueda" placeholder="Inserte Alumno a buscar" size="50%"></input>

                                            <button type="button" onclick="buscar()" class="btn btn-primary">BUSCAR</button>
                                        </div>

                                    </div>
                                    <br>
                                    <div id="datos" onload="buscar()"></div>

                                </section>
                            </center>      


                        </div>
                    </div>
                </div> 

                <script type="text/javascript" src="js/btodasmatriculas.js"></script>
                <?php
                include_once'./pie.php';
                