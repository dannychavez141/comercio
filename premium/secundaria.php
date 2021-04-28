<!DOCTYPE html>
<html lang="en">
<head>
<title>Premium College Secundaria</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Course Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/courses_styles.css">
<link rel="stylesheet" type="text/css" href="styles/courses_responsive.css">
</head>
<body>

<div class="super_container">

	<?php 
 include_once'./cabezera.php';  
 include '../control/cConexion.php';
 include '../modelo/dbogrado.php';
 $modelo= new dbogrado();
 $grados=$modelo->verGradosNivel(2);
 //  ?>
	
	<!-- Home -->
<br><br><br><br><br>

	<!-- Popular -->

	<div class="popular page_section">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<h1>Secciones Secundaria</h1>
					</div>
				</div>
			</div>

			<div class="row course_boxes">
				<?php $i=1;
                                foreach ($grados as $grado) { 
					
				 ?>
				<!-- Popular Course Item -->


				<div class="col-lg-4 course_box">
					<div class="card">
						<img class="card-img-top" src="img/<?php echo $i.'s.jpg' ?>" alt="Foto no subida">
						<div class="card-body text-center">
							 <div class="card-title"><a href="clasesvirtuales.php?idgrado=<?php echo $grado['idGrado'] ?>" target="_blank"><?php echo $i.' AÑO SECUNDARIA' ?></a></div>
							<div class="card-text">Premium College pucallpa</div>
						</div>
						
					</div>
				</div>
<?php $i++;} ?>
				

			</div>
		</div>		
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			
			<!-- Newsletter -->

			

			<!-- Footer Copyright -->

			<div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
				<div class="footer_copyright">
					<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
				</div>
				<div class="footer_social ml-sm-auto">
					<ul class="menu_social">
						
												<li class="menu_social_item"><a href="https://www.facebook.com/premiumcollegepucallpa"><i class="fab fa-facebook-f"></i></a></li>


					</ul>
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
<script src="js/courses_custom.js"></script>

</body>
</html>