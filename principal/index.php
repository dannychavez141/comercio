<!DOCTYPE html>
<html lang="es">
    <?php
    error_reporting(0);
    include_once'./cabezera.php';
    // require 'conexion.php';
    //  
    ?>


</div>-->
<!-- Hero Slider -->
<div class="hero_slider_container">
    <div class="hero_slider owl-carousel">

        <!-- Hero Slide -->
        <div class="hero_slide">
            <div class="hero_slide_background" style="background-image:url(images/fondos/fondo1.jpg)"></div>
            <div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
                <div class="hero_slide_content text-center">
                    <h1 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Tu  <span>Educacion</span> es ahora!</h1>
                </div>
            </div>
        </div>

        <!-- Hero Slide -->
        <div class="hero_slide">
            <div class="hero_slide_background" style="background-image:url(images/fondos/fondo2.jpg)"></div>
            <div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
                <div class="hero_slide_content text-center">
                    <h1 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Construir tu <span>Futuro</span> lo decides tu!</h1>
                </div>
            </div>
        </div>


    </div>

    <div class="hero_slider_left hero_slider_nav trans_200"><span class="trans_200">Ant</span></div>
    <div class="hero_slider_right hero_slider_nav trans_200"><span class="trans_200">Sig</span></div>
</div>

</div>

<div class="hero_boxes">
    <div class="hero_boxes_inner">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 hero_box_col">
                    <div class="hero_box d-flex flex-row align-items-center justify-content-start">
                        <img src="images/earth-globe.svg" class="svg" alt="">
                        <div class="hero_box_content">
                            <h2 class="hero_box_title">Nuestro Sistema </h2>
                            <a href="../login.php" class="hero_box_link">Ingresar</a>
                        </div>
                    </div>
                </div>

                

                <div class="col-lg-6 hero_box_col">
                    <div class="hero_box d-flex flex-row align-items-center justify-content-start">
                        <img src="images/professor.svg" class="svg" alt="">
                        <div class="hero_box_content">
                            <h2 class="hero_box_title">Nuestros Docentes</h2>
                            <a href="docente.php" class="hero_box_link">Ver Mas</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Popular -->

<div class="popular page_section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title text-center">
                    <h1>Actividades Comercio N°64</h1>
                </div>
            </div>
        </div>

        <div class="row course_boxes">

            <!-- Popular Course Item -->
            <div class="col-lg-6 course_box">
                <div class="card">
                    <img class="card-img-top" src="img/cultura.jpg" alt="https://unsplash.com/@kellybrito">
                    <div class="card-body text-center">
                        <div class="card-title"><a href="#">Club Deportivo y Cultural</a></div>
                        <div class="card-text">¡¡Con Mente Sana y Cuerpo Sano!!</div>
                    </div>

                </div>
            </div>
            
            <div class="col-lg-6 course_box">
                <div class="card">
                    <img class="card-img-top" src="img/alumnos.jpg" alt="#">
                    <div class="card-body text-center">
                        <div class="card-title"><a href="#">Crecimiento Personal y Social</a></div>
                        <div class="card-text">Compañerismo e igualdad </div>
                    </div>

                </div>
            </div>

        </div>
    </div>		
</div>

<footer class="footer">
    <div class="container">


        <div class="footer_content">
            <div class="row">

                <!-- Footer Column - About -->
                <div class="col-lg-3 footer_col">

                    <!-- Logo -->
                    <div class="logo_container">
                        <div class="logo">
                            <img src="img/logo.png" alt="" width="50" height="50">
                            <span>Comercio N°64</span>
                        </div>
                    </div>


                </div>






            </div>
        </div>


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
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
<script>$(document).ready(function () {
                            $('#myModal').modal('toggle')
                        });</script>
</body>
</html>