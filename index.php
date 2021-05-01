
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
                
                
            </div>
            <!--/ stats -->


            
            
        </div>
           </div>

</div>
</div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<?php
include_once'./pie.php';
?>