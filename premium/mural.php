<!DOCTYPE html>
<html lang="es">

<?php //error_reporting(0);
 include_once'./cabmural.php';  
 require '../control/conexion.php';
 //  ?>

<body >
	<!-- Teachers -->

	
		
			<h1 align="center">
				<span style="color: red; font-size: 2em; ">MURAL PREMIUM COLLEGE</span></h1>
			<h2><span style="color: red;">--PADRES DE LA SEMANA ------ ALUMNOS PREMIUM DE LA SEMANA</span></h2><br>
			<div class="row">
				 <?php  
                                    $query = "SELECT * FROM apoelegidos order by idapoelegidos desc limit 1;";
                                        $resultado = $mysqli->query($query);
                                        while($datos = $resultado->fetch_array())
                                        {  $datos1=$datos[1];
                                            $descr1=$datos[2];  
                                            $ext1=$datos[3]; 
                                           //echo $datos1.$descr1.$ext1

                                        	?>
 <!-- Teacher -->
				<div class="col-lg-2 teacher">
					<div class="card">
						<div class="card_img">
							<?php  if ($ext1=='0') { ?>
							<img class="card-img-top trans_200" src="../img/noimage.png" >
						<?php }else{ ?>
	          <img class="card-img-top trans_200" src="../img/padres/<?php echo '1.'.$ext1 ?>" >

						<?php } ?>
						</div>
						<div class="card-body text-center">
							<div class="card-title"><?php echo$datos1 ?></div>
							<div class="card-text"><?php echo $descr1 ?></div>
							<div class="teacher_social">
								<ul class="menu_social">
									
								</ul>
							</div>
						</div>
					</div>
				</div>                             
				        <?php  }
                                    $query = "SELECT * FROM mural m
join matricula m1 on m.idmat1=m1.idMatricula
join alumnos a1 on m1.dnialu=a1.dni
join grado g1 on m1.idGrado=g1.idGrado
join seccion s1 on m1.idSeccion=s1.idSeccion
join anioescolar ae1 on m1.idAnioEscolar=ae1.idAnioEscolar
join matricula m2 on m.idmat2=m2.idMatricula
join alumnos a2 on m2.dnialu=a2.dni
join grado g2 on m2.idGrado=g2.idGrado
join seccion s2 on m2.idSeccion=s2.idSeccion
join anioescolar ae2 on m2.idAnioEscolar=ae2.idAnioEscolar 
order by  m.idmural desc limit 1;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {
                                          $dni1=$row[8];                                
                                            $datos1=$row[19].' '.$row[20].' '.$row[21].' <BR>(PRIMARIA- '.$row[32].' '.$row[36].'-'.$row[39].')';
                                            $descr1=$row[2];
                                            $dni2=$row[52];
                                            $datos2=$row[53].' '.$row[54].' '.$row[55].' <BR>(SECUNDARIA- '.$row[66].' '.$row[70].'-'.$row[73].')';                                            
                                            $descr2=$row[4];
                                           

                                        	?>
                                                
               
				<!-- Teacher -->
				<div class="col-lg-2 teacher">
					<div class="card">
						<div class="card_img">
							<?php  if ($row[26]=='0') { ?>
							<img class="card-img-top trans_200" src="../img/noimage.png" >
						<?php }else{ ?>
	          <img class="card-img-top trans_200" src="../img/alumnos/<?php echo $dni1.'.'.$row[26] ?>" >

						<?php } ?>
						</div>
						<div class="card-body text-center">
							<div class="card-title"><?php echo$datos1 ?></div>
							<div class="card-text"><?php echo $descr1 ?></div>
							<div class="teacher_social">
								<ul class="menu_social">
									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Teacher -->
				<div class="col-lg-2 teacher">
					<div class="card">
						<div class="card_img">
							<?php  if ($row[60]=='0') { ?>
							<img class="card-img-top trans_200" src="../img/noimage.png" >
						<?php }else{ ?>
	          <img class="card-img-top trans_200" src="../img/alumnos/<?php echo $dni2.'.'.$row[60] ?>" >

						<?php } ?>
						</div>
						<div class="card-body text-center">
							<div class="card-title"><?php echo$datos2 ?></div>
							<div class="card-text"><?php echo $descr2 ?></div>
							<div class="teacher_social">
								<ul class="menu_social">
									
								</ul>
							</div>
						</div>
					</div>
				</div>

				  <?php } ?>
<!-- Teacher -->
				<div class="col-lg-3 teacher">
					<div class="card">
						<div class="card_img">
							
							<?php  
                                           
                                    $query = "SELECT * FROM video;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        { ?>
							<iframe width="900" height="450" src="https://www.youtube.com/embed/youtube.com/embed/videoseries?list=<?php echo $row[2]?>&autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							<?php  }?>
						</div>
						
					</div>
				</div>
			</div>

			
				<div class="app-content content container-fluid">
      <div class="content-wrapper">
       
        <div class="content-body"><!-- Basic Carousel start -->
<section id="basic-carousel">
	
	<div class="row">
		
		<div class="col-md-12 col-sm-12">
			<div class="card">
				
				<div class="card-body collapse in">
					<div class="card-block">
						<div id="carousel-example-caption" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carousel-example-caption" data-slide-to="0" class="active"></li>
								<li data-target="#carousel-example-caption" data-slide-to="1"></li>
								<li data-target="#carousel-example-caption" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									
									<center>
									<span align='center'><h3>PREMIUN COLLEGE</h3>
									<h4>COLEGIO DE ALTAS CAPACIDADES, EL FUTURO ESTA EN TUS MANOS</h4></span>
									</center>
									<div class="carousel-caption">
										
									</div>
								</div>

<?php  
                                           	$dia=date('d');
                                           	$mes=date('n');
                                    $query = "SELECT * FROM calendario where dia>='$dia' and mes='$mes' limit 5;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {  switch ($row[3]) {
        case '1':
        $mes='ENERO';
        break;
        case '2':
        $mes='FEBRERO';
        break;
        case '3':
        $mes='MARZO';
        break;
        case '4':
        $mes='ABRIL';
        break;
        case '5':
        $mes='MAYO';
        break;
        case '6':
        $mes='JUNIO';
        break;
        case '7':
        $mes='JULIO';
        break;
        case '8':
        $mes='AGOSTO';
        break;
        case '9':
        $mes='SEPTIEMBRE';
        break;
        case '10':
        $mes='OCTUBRE';
        break;
        case '11':
        $mes='NOVIEMBRE';
        break;
        case '12':
        $mes='DICIEMBRE';
        break;

    
    default:
        # code...
        break;
}
                                        	?>
                                               
								<div class="carousel-item">
									<center>
									<span align='center'><h3><?php echo $row[2].' de '.$mes.' se celebra:' ?></h3>
										<h4><?php echo utf8_encode($row[1])?></h4></span>
									</center>
									<div class="carousel-caption">
										
									</div>
								</div>
                                              
                                           	
                                           		 <?php } ?>






								
							</div>
							<a class="left carousel-control" href="#carousel-example-caption" role="button" data-slide="prev">
								<span class="icon-prev" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#carousel-example-caption" role="button" data-slide="next">
								<span class="icon-next" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Basic Carousel end -->

        </div>
     
    </div>
			</div>
			

			<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        	<center>
                                           <table class='table table-striped ' border="1"> <tr align="center" style="background: orange"><TD colspan='7'><span style="color: black;">CALENDARIO CIVICO ESCOLAR</span></TD></tr>
                                           	<?php  
                                           	$dia=date('d');
                                           	$mes=date('n');
                                    $query = "SELECT * FROM calendario where dia>='$dia' and mes='$mes' limit 5;";
                                        $resultado = $mysqli->query($query);
                                        while($row = $resultado->fetch_array())
                                        {  switch ($row[3]) {
        case '1':
        $mes='ENERO';
        break;
        case '2':
        $mes='FEBRERO';
        break;
        case '3':
        $mes='MARZO';
        break;
        case '4':
        $mes='ABRIL';
        break;
        case '5':
        $mes='MAYO';
        break;
        case '6':
        $mes='JUNIO';
        break;
        case '7':
        $mes='JULIO';
        break;
        case '8':
        $mes='AGOSTO';
        break;
        case '9':
        $mes='SEPTIEMBRE';
        break;
        case '10':
        $mes='OCTUBRE';
        break;
        case '11':
        $mes='NOVIEMBRE';
        break;
        case '12':
        $mes='DICIEMBRE';
        break;

    
    default:
        # code...
        break;
}
                                        	?>
                                               
                                              
                                           	<tr style="background: blue"><TD colspan='1'><span style="color: white;"><?php echo $row[2].' de '.$mes ?></span></TD><TD colspan='5'><span style="color: white;"><?php echo utf8_encode($row[1]) ?> </span></TD></tr>
                                           		 <?php } ?>
                                        </table>
                                    </center>
                                        </div>
                                    </div>
       
	


	</body>

			<!-- Footer Copyright -->

			<div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
				<div class="footer_copyright">
					<span align='center' ><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
				</div>
				
			</div>

		</div>
	</footer>

</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/teachers_custom.js"></script>
<script src="/librerias/app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="/librerias/app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="/librerias/app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="/librerias/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="/librerias/app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="/librerias/app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="/librerias/app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="/librerias/app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="/librerias/app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="/librerias/app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="/librerias/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/librerias/app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="/librerias/app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>

</body>
</html>