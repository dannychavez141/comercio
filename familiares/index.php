<?php
include_once'./cabezera.php';
require '../control/cConexion.php';
include '../modelo/dboanioescolar.php';
$dboAnio = new dboanioescolar();
$Uanio = $dboAnio->ultimoanio();
//  
?>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="media">
                                    <div class="media-body text-xs-left">
                                        <?php
                                        $idusuario = $_COOKIE['idUsuario'];
                                        if ($idusuario == "") {
                                            $idusuario = "******************";
                                        }
                                        $alumnos = 0;
                                        $matriculados = 0;
                                        $conexion = new cConexion();
                                        $mysqli = $conexion->getBd();
                                        $sql = "SELECT dni FROM apoderado where idApoderado='$idusuario';";
                                        $registro = $mysqli->query($sql);
                                        while ($datos = $registro->fetch_array()) {
                                            $id = $datos[0];
                                        }

                                        $sql = "SELECT count(idAlumnos) FROM alumnos where dniapo='$id' ;";
                                        $registro = $mysqli->query($sql);
                                        while ($datos = $registro->fetch_array()) {
                                            $alumnos = $datos[0];
                                        }
                                         $mysqli = $conexion->getBd();
                                        $sql = "SELECT count(idMatricula) FROM matricula m
join alumnos a on m.dnialu=a.dni where a.dniapo='$id' and m.idAnioEscolar=$Uanio[0] ;";
                                        $registro = $mysqli->query($sql);
                                        while ($datos = $registro->fetch_array()) {
                                            $matriculados = $datos[0];
                                        }
                                       
                                        ?>
                                        <h3 class="pink"><?php echo $alumnos; ?></h3>
                                        <span>Alumnos A su nombre</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-bag2 pink font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block">
                                <div class="media">
                                    <div class="media-body text-xs-left">
                                        <h3 class="teal"><?php echo $matriculados; ?></h3>
                                        <span>Apoderados Matriculados</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-user1 teal font-large-2 float-xs-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
            <!--/ stats -->

            <!--/ project charts -->
            <!-- Recent invoice with Statistics -->

            
                

            </div>
            <!-- ////////////////////////////////////////////////////////////////////////////-->
            <?php
            include_once'./pie.php';
            ?>