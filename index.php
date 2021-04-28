
<?php
include './control/cConexion.php';
include './modelo/dboanioescolar.php';
include_once'./cabezera.php';
require 'control/conexion.php';
$dboanio = new dboanioescolar();
$anio = $dboanio->ultimoanio();
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
                                        $query = "SELECT count(idDocente) FROM docente where est=1;";
                                        $resultado = $mysqli->query($query);
                                        while ($row = $resultado->fetch_array()) {
                                            ?>    
                                            <h3 class="pink"><?php echo $row[0] ?></h3>
<?php } ?>
                                        <span>Docentes Registrados</span>
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
                                        <?php
                                        $query = "SELECT count(m.idMatricula ),a.descr FROM matricula m 
join anioescolar a on m.idAnioEscolar=a.idAnioEscolar
where m.idAnioEscolar=$anio[0] and m.est=1;";
                                        //echo $query;
                                        $resultado = $mysqli->query($query);
                                        while ($row = $resultado->fetch_array()) {
                                            $nanio = $row[1];
                                            ?>    
                                            <h3 class="teal"><?php echo $row[0] ?></h3>




                                            <span>Alumnos Matriculados <?php echo ' ' . $row[1] ?></span>  
                                        <?php
                                        }
                                        
                                        $sql = "SELECT count(idAlumnos) FROM insidencias i
join matricula m on i.IdMat = m.idMatricula
join alumnos a on m.dnialu=a.dni
where  m.idAnioEscolar=$anio[0] ;";
                                        $registro = $mysqli->query($sql);
                                        while ($datos = $registro->fetch_array()) {
                                            $insidencias = $datos[0];
                                        }



                                        $sql = "SELECT count(idpago) FROM pago p
join deuda d on p.idDeuda=d.idDeuda
join matricula m on d.idMatricula=m.idMatricula
where m.idAnioEscolar=$anio[0];";
                                        $pagos = 0;
                                        while ($datos = $registro->fetch_array()) {
                                            $pagos = $datos[0];
                                        }
                                        $sql = "SELECT count(idDeuda) FROM deuda d 
join matricula m on d.idMatricula=m.idMatricula
where m.idAnioEscolar=$anio[0];";
                                        $deudas = 0;
                                        $registro = $mysqli->query($sql);
                                        while ($datos = $registro->fetch_array()) {
                                            $deudas = $datos[0];
                                        }
                                        ?>
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
                                        <h3 class="deep-orange"><?php echo $pagos ?></h3>
                                        <span>Pagos Registrados</span>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-diagram deep-orange font-large-2 float-xs-right"></i>
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
                                        <h3 class="cyan"><?php echo $insidencias ?></h3>
                                        <span>Incidencias Registradas en el <?php echo $nanio ?></span>
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
                                    $sql = "SELECT * FROM deuda d join matricula m on d.idMatricula=m.idMatricula
 join alumnos a on m.dnialu=a.dni 
 join grado g on m.idGrado=g.idGrado
 join seccion s on m.idSeccion=s.idSeccion
 join tipogrado tg on tg.idTipo=g.idTipo
where  d.est!='5' and   m.idAnioEscolar='$anio[0]'  order by d.idDeuda  desc limit 10;";
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
    <?php }
}
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
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
                            <p>Total Total de incidencias Generadas <?php echo $nanio . ": " . $insidencias ?> <span class="float-xs-right"><a href="selecAlumnoInsidencia.php">Todas las Incidencias<i class="icon-arrow-right2"></i></a></span></p>
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
where  m.idAnioEscolar='$anio[0]' order by i.fecha desc
limit 10";
                                    $registro = $mysqli->query($sql);
                                    while ($row = $registro->fetch_array()) {
                                        $tipoinsi = explode("-", $row[43]);



                                        if ($tipoinsi[0] == "MERITO") {
                                            ?>

                                            <tr>
                                                <td class="text-truncate"><a href="pdfincidencia.php?cod=<?php echo $row[0]; ?>" target="_blank"><?php echo $row[0]; ?></a></td>
                                                <td class="text-truncate"><span class="tag tag-default tag-success"><?php echo $tipoinsi[0] ?></span></td>
                                                <td class="text-truncate"  width="50"><?php echo $tipoinsi[1] . "<br>" . $row[20] . " " . $row[21] . " " . $row[22] . " <br>" . $row[33] . " " . $row[37] . "<br>" . $row[43] . " "; ?></td>

                                                <td class="text-truncate"><?php echo $row[6]; ?></td>


                                            </tr>
    <?php } else { ?>
                                            <tr>
                                                <td class="text-truncate"><a href="pdfincidencia.php?cod=<?php echo $row[0]; ?>" target="_blank"><?php echo $row[0]; ?></a></td>
                                                <td class="text-truncate"><span class="tag tag-default tag-warning"><?php echo $tipoinsi[0] ?></span></td>
                                                <td class="text-truncate"  width="50"><?php echo $tipoinsi[1] . "<br>" . $row[20] . " " . $row[21] . " " . $row[22] . " <br>" . $row[33] . " " . $row[37] . "<br>" . $row[43] . " "; ?></td>
                                                <td class="text-truncate"><?php echo $row[6]; ?></td>


                                            </tr>
            <?php }
        }
        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent invoice with Statistics -->
        <?php /* ?>
          <div class="row match-height">
          <div class="col-xl-4 col-md-6 col-sm-12">
          <div class="card" style="height: 440px;">
          <div class="card-body">
          <img class="card-img-top img-fluid" src="../../app-assets/images/carousel/05.jpg" alt="Card image cap">
          <div class="card-block">
          <h4 class="card-title">Basic</h4>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-outline-pink">Go somewhere</a>
          </div>
          </div>
          </div>
          </div>
          <div class="col-xl-4 col-md-6 col-sm-12">
          <div class="card" style="height: 440px;">
          <div class="card-body">
          <div class="card-block">
          <h4 class="card-title">List Group</h4>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
          <ul class="list-group list-group-flush">
          <li class="list-group-item">
          <span class="tag tag-default tag-pill bg-primary float-xs-right">4</span> Cras justo odio
          </li>
          <li class="list-group-item">
          <span class="tag tag-default tag-pill bg-info float-xs-right">2</span> Dapibus ac facilisis in
          </li>
          <li class="list-group-item">
          <span class="tag tag-default tag-pill bg-warning float-xs-right">1</span> Morbi leo risus
          </li>
          <li class="list-group-item">
          <span class="tag tag-default tag-pill bg-success float-xs-right">3</span> Porta ac consectetur ac
          </li>
          <li class="list-group-item">
          <span class="tag tag-default tag-pill bg-danger float-xs-right">8</span> Vestibulum at eros
          </li>
          </ul>
          <div class="card-block">
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
          </div>
          </div>
          </div>
          </div>
          <div class="col-xl-4 col-md-12 col-sm-12">
          <div class="card" style="height: 440px;">
          <div class="card-body">
          <div class="card-block">
          <h4 class="card-title">Carousel</h4>
          <h6 class="card-subtitle text-muted">Support card subtitle</h6>
          </div>
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
          <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
          </ol>
          <div class="carousel-inner" role="listbox">
          <div class="carousel-item">
          <img src="../../app-assets/images/carousel/02.jpg" alt="First slide">
          </div>
          <div class="carousel-item active">
          <img src="../../app-assets/images/carousel/03.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
          <img src="../../app-assets/images/carousel/01.jpg" alt="Third slide">
          </div>
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="icon-prev" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="icon-next" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
          </a>
          </div>
          <div class="card-block">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
          </div>
          </div>
          </div>
          <?php */ ?>
    </div>

</div>
</div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<?php
include_once'./pie.php';
?>