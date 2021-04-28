<?php
include_once'./cabezeramovil.php';
//  
?>
<body style="background-image:url('images/fondos/frontal.jpg')">
<center>
  

        <!-- Table head options with primary background start -->
        <div class="row" id="formulario"  style="margin: 3px;padding: 1%">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title" style="color: black" > <span>CLASES VIRTUALES</span></h1>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                            </ul>
                        </div>

                    </div>
                    <div class="card-block" style="margin: 3px;padding: 1%; color: black"> 
                        <div class="row col-md-12">
                            <div class="row">
                                
                                </div>
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label for="projectinput2">SALON MATRICULADO</label>
                                        <input type="text" v-model="salon" class="form-control" value=""maxlength="50"placeholder="salon"  readonly="">
                                    </div>
                                </div>
                            </div> 
                            <hr><br>
                            <div class="row">
                            <div class="col-xl-4 col-lg-6 col-xs-12">
                                <div class="card">
                                    <center>
                                    <img src="../img/Classlogo.png" class="card-img-top" alt="Card image" style="width: 100%" />

                                    <div class="card-block">
                                        <h3 class="card-title">CODIGO DE CLASES</h3> 
                                       <br>
                                        <div id='listaclases'></div>
                                    </div>
                                    </center>
                                </div>
                                <div class="card-footer " align='center'>
                                    <a href="https://classroom.google.com/" class="btn btn-success" target='_blank'><img src="../img/btnclass.png"  alt="Card image" style="width: 30%" /> IR A CLASSROOM</a>
                                </div>
                            </div>
<!--
                            <div class="col-xl-4 col-lg-6 col-xs-12">
                                <div class="card" >
                                    <center>
                                    <img src="../img/zoombaner.png" class="card-img-top" alt="Card image" style="width: 50%" />

                                    <div class="card-block">
                                        <h3 class="card-title">ENLACE DE DOCENTES</h3>
                                        
                                        <div id='listazoom'></div>
                                        <h3>ZOOM DIRECCION</h3>
                                  <div id='direccion' ></div>
                                    </div>
                                    </center>
                                  
                                </div>
                                <center>
                                <div class="card-footer " align='center' style="width: 50%;" >
                                    <a href="https://zoom.us/" class="btn btn-blue" target='_blank'><img src="../img/zoomlogo.png"  alt="Card image" style="width: 25%;" />-   IR A ZOOM</a>
                                </div></center>
                            </div>-->
                            <div class="col-xl-4 col-lg-6 col-xs-12">
                                <div class="card">
                                    <center>
                                    <img src="../img/logohorario.png" class="card-img-top" alt="Card image" style="width: 0%" />
                                   
 
                                    <div class="card-block">
                                        <h3 class="card-title"><img src="../img/logohorario.png"  style="width: 10%" /> ENLACE DE HORARIO</h3>
                                        <div id='listahorario' ></div>
                                      
                                      
                                    </div></center>
                                    
                                </div>
                                <iframe v-bind:src="horario" width="100%" height="45%" ></iframe>
                                
                            </div>     
                              
                        </div>  
                            
                    </div>
                    
                </div> 

            </div>
        </div> 
</center>
</body>
<script src="js/clasesvirtualesmovil.js" type="text/javascript"></script>