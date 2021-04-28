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
                                        $sql = "SELECT count(idAlumnos) FROM insidencias i
join matricula m on i.IdMat = m.idMatricula
join alumnos a on m.dnialu=a.dni
where a.dniapo='$id' and m.idAnioEscolar=$Uanio[1] ;;";
                                        $registro = $mysqli->query($sql);
                                        while ($datos = $registro->fetch_array()) {
                                            $insidencias = $datos[0];
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
                                        <span>Alumnos Apoderados Matriculados</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-user1 teal font-large-2 float-xs-right"></i>
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
                                        <h3 class="cyan"><?php echo $insidencias; ?></h3>
                                        <span>Insidencias Acumuladas </span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-ios-help-outline cyan font-large-2 float-xs-right"></i>
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

            <?php
            $sql = "SELECT count(idpago) FROM pago p
join deuda d on p.idDeuda=d.idDeuda
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
where a.dniapo='$id' and p.est='1';";
//echo $sql;
            $pagos = 0;
            $mysqli=$conexion->getBd();
            $registro = $mysqli->query($sql);
            while ($datos = $registro->fetch_array()) {
                $pagos = $datos[0];
            }
            $sql = "SELECT count(idDeuda) FROM deuda d 
join matricula m on d.idMatricula=m.idMatricula
join alumnos a on m.dnialu=a.dni
where a.dniapo='$id'and d.est='1';";
            $deudas = 0;
            $registro = $mysqli->query($sql);
            while ($datos = $registro->fetch_array()) {
                $deudas = $datos[0];
            }
          
            ?>
            <div class="row match-height">

<!--
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Deudas Y Pagos</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <p>Total Deudas Pagadas <?php echo $pagos ?>, No pagadas <?php echo $deudas ?>. <span class="float-xs-right"><a href="verDeudas.php">Todas las Deudas<i class="icon-arrow-right2"></i></a></span></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>RECIBO</th>
                                            <th>CONCEPTO Y ALUMNO</th>
                                            <th>ESTADO</th>
                                            <th>FECHA</th>
                                            <th>MONTO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    /*    $sql = "SELECT * FROM deuda d join matricula m on d.idMatricula=m.idMatricula
 join alumnos a on m.dnialu=a.dni 
 join grado g on m.idGrado=g.idGrado
 join seccion s on m.idSeccion=s.idSeccion
 join tipogrado tg on tg.idTipo=g.idTipo
where a.dniapo='$id' and d.est!='5' order by d.fecha limit 10; ;";
                                        $registro = $mysqli->query($sql);
                                        while ($row = $registro->fetch_array()) {
                                            if ($row[0] < 10) {
                                                $bol = 'R-0001-000';
                                            }
                                            if ($row[0] < 100 && $row[0] >= 10) {
                                                $bol = 'R-0001-00';
                                            }
                                            if ($row[0] < 1000 && $row[0] >= 100) {
                                                $bol = 'R-0001-0';
                                            }
                                            if ($row[0] < 10000 && $row[0] >= 1000) {
                                                $bol = 'R-0001-';
                                            }

                                            if ($row[8] != 1) {
                                                ?>

                                                <tr>
                                                    <td class="text-truncate"><?php echo $bol . $row[0]; ?></td>
                                                    <td class="text-truncate"  width="50"><?php echo $row[10] . "<br>" . $row[23] . " " . $row[24] . " " . $row[25] . " <br>" . $row[36] . " " . $row[40] . "<br>" . $row[43] . " "; ?></td>
                                                    <td class="text-truncate"><span class="tag tag-default tag-success">Pagado</span></td>
                                                    <td class="text-truncate"><?php echo $row[3]; ?></td>

                                                    <td class="text-truncate"><?php echo "S/." . number_format($row[6] + $row[7], 2); ?></td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <td class="text-truncate"><?php echo $bol . $row[0]; ?></td>
                                                    <td class="text-truncate"  width="50"><?php echo $row[10] . "<br>" . $row[23] . " " . $row[24] . " " . $row[25] . " <br>" . $row[36] . " " . $row[40] . "<br>" . $row[43] . " "; ?></td>
                                                    <td class="text-truncate"><span class="tag tag-default tag-warning">Pendiente</span></td>
                                                    <td class="text-truncate"><?php echo $row[3]; ?></td>

                                                    <td class="text-truncate"><?php echo "S/." . number_format($row[6] + $row[7], 2); ?></td>
                                                </tr>
                                            <?php
                                            }
                                        }*/
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Incidencias Registradas</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <p>Total Total de incidencias Generadas <?php echo $Uanio[1] . ": " . $insidencias ?> <span class="float-xs-right"><a href="verIncidencias.php">Todas las Incidencias<i class="icon-arrow-right2"></i></a></span></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>TIPO</th> 
                                            <th>ALUMNO</th>

                                            <th>FECHA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM insidencias i
join matricula m on i.Idmat=m.idMatricula
join alumnos a on m.dnialu=a.dni
join grado g on m.idGrado=g.idGrado
join seccion s on m.idSeccion=s.idSeccion
join tipogrado tg on g.idTipo=tg.idTipo 
join tipoinsidencia ti on i.idtipoIns=ti.idtipoInsidencia
where  a.dniapo='$id' and m.idAnioEscolar='$Uanio[0]' order by i.fecha desc
limit 10";
                                        $registro = $mysqli->query($sql);
                                        while ($row = $registro->fetch_array()) {
                                            $tipoinsi = explode("-", $row[43]);



                                            if ($tipoinsi[0] == "MERITO") {
                                                ?>

                                                <tr>
                                                    <td class="text-truncate"><a href="../pdfincidencia.php?cod=<?php echo $row[0]; ?>" target="_blank"><?php echo $row[0]; ?></a></td>
                                                    <td class="text-truncate"><span class="tag tag-default tag-success"><?php echo $tipoinsi[0] ?></span></td>
                                                    <td class="text-truncate"  width="50"><?php echo $tipoinsi[1] . "<br>" . $row[20] . " " . $row[21] . " " . $row[22] . " <br>" . $row[33] . " " . $row[37] . "<br>" . $row[43] . " "; ?></td>

                                                    <td class="text-truncate"><?php echo $row[6]; ?></td>


                                                </tr>
    <?php } else { ?>
                                                <tr>
                                                    <td class="text-truncate"><a href="../pdfincidencia.php?cod=<?php echo $row[0]; ?>" target="_blank"><?php echo $row[0]; ?></a></td>
                                                    <td class="text-truncate"><span class="tag tag-default tag-warning"><?php echo $tipoinsi[0] ?></span></td>
                                                    <td class="text-truncate"  width="50"><?php echo $tipoinsi[1] . "<br>" . $row[20] . " " . $row[21] . " " . $row[22] . " <br>" . $row[33] . " " . $row[37] . "<br>" . $row[43] . " "; ?></td>
                                                    <td class="text-truncate"><?php echo $row[6]; ?></td>


                                                </tr>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ////////////////////////////////////////////////////////////////////////////-->
            <?php
            include_once'./pie.php';
            ?>