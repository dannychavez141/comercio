<!DOCTYPE html>
<html lang="es">

    <?php
    include_once'./cabezera.php';
    require '../control/conexion.php';
    //  
    ?>
    <br><br><br><br><br>

    <!-- Teachers -->

    <div class="teachers page_section">
        <div class="container">
            <div class="row">
                <?php
                $query = "SELECT * FROM docente d 
join sexo s on d.idsex=s.idsexo
join estados e on d.est=e.idestados
join cargo t on d.idtipo=t.idcargo where d.est=1;";
                $resultado = $mysqli->query($query);
                while ($row = $resultado->fetch_array()) {
                    ?>


                    <!-- Teacher -->
                    <div class="col-lg-4 teacher">
                        <div class="card">
                            <div class="card_img">
                                <?php if ($row['ext'] == '0') { ?>
                                    <img class="card-img-top trans_200" src="../img/noimage.png" >
    <?php } else { ?>
                                    <img class="card-img-top trans_200" src="../img/docentes/<?php echo $row['dni'] . '.' . $row['ext'] ?>" >

    <?php } ?>
                            </div>
                            <div class="card-body text-center">
                                <div class="card-title"><a href="#"><?php echo $row[2] . ' ' . $row[3] . ' ' . $row[4] ?></a></div>
                                <div class="card-text"><?php echo $row['descrCargo'] ." ". $row['detalle'] ?></div>
                                <div class="teacher_social">
                                    <ul class="menu_social">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

<?php } ?>

            </div>
        </div>
    </div>



    <!-- Footer Copyright -->

    <div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
        <div class="footer_copyright">
            <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
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

</body>
</html>