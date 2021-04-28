<?php
include_once'./cabezera.php';
//  
?>
<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a>
            </li>
            <li class="breadcrumb-item "><a href="verMatriculas.php">Ver Alumnos Matriculados</a>
            </li>
            <li class="breadcrumb-item active"><a href="#">Clases Virtuales</a>
            </li>
        </ol>
    </div>
</div>
<div class="app-content content container-fluid">
    <div class="content-wrapper">

        <!-- Table head options with primary background start -->
        <div class="row" id="formulario">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">CLASES VIRTUALES</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                            </ul>
                        </div>

                    </div>
                    <div class="card-block">
                        <div class="row col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="projectinput1">DNI</label>
                                        <input type="text" v-model="dnialu" class="form-control" value="" maxlength="50"placeholder="dni"readonly="">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput2">DATOS DE ALUMNO</label>
                                        <input type="text" v-model="alumno" class="form-control" value=""maxlength="50"placeholder="alumno"  readonly="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput2">SALON MATRICULADO</label>
                                        <input type="text" v-model="salon" class="form-control" value=""maxlength="50"placeholder="salon"  readonly="">
                                    </div>
                                </div>
                            </div> 
                            <hr>
                            <div class="col-xl-3 col-lg-6 col-xs-12">
                                <div class="card">
                                    <center>
                                    <img src="../img/Classlogo.png" class="card-img-top" alt="Card image" style="width: 100%" />

                                    <div class="card-block">
                                        <h4 class="card-title">CODIGO DE CLASES</h4>
                                        <div id='listaclases'></div>
                                    </div>
                                    </center>
                                </div>
                                <div class="card-footer " align='center'>
                                    <a href="https://classroom.google.com/" class="btn btn-success" target='_blank'><img src="../img/btnclass.png"  alt="Card image" style="width: 30%" /> IR A CLASSROOM</a>
                                </div>
                            </div>
<!--
                            <div class="col-xl-6 col-lg-6 col-xs-12">
                                <div class="card" >
                                    <center>
                                    <img src="../img/zoombaner.png" class="card-img-top" alt="Card image" style="width: 50%" />

                                    <div class="card-block">
                                        <h4 class="card-title">ENLACE DE DOCENTES</h4>
                                        <div id='listazoom'></div>
                                    </div>
                                    </center>
                                </div>
                                <center>
                                <div class="card-footer " align='center' style="width: 50%;" >
                                    <a href="https://zoom.us/" class="btn btn-blue" target='_blank'><img src="../img/zoomlogo.png"  alt="Card image" style="width: 25%;" />-   IR A ZOOM</a>
                                </div></center>
                            </div>-->
                            <div class="col-xl-9 col-lg-12 col-xs-12">
                                <div class="card">
                                    <center>
                                    <img src="../img/logohorario.png" class="card-img-top" alt="Card image" style="width: 25%" />

                                    <div class="card-block">
                                        <h4 class="card-title">ENLACE DE HORARIO</h4>
                                        <div id='listahorario' ></div>
                                       <!-- <div id='direccion' ></div>-->
                                    </div>
                                </center>
                                    
                                </div>
                               
                            </div>                     
                        </div>  
                    </div>
                    


                    </table>

                </div> 

            </div>
        </div> </div> </div> 
<script src="../js/funciones.js" type="text/javascript"></script>
<script src="js/clasesvirtuales.js" type="text/javascript"></script>
<?php
include_once'./pie.php';
?>