<?php
error_reporting(0);
include_once'./cabezera.php';
if ($idtipo == 3) {
    include './nopermiso.php';
    exit();
}
$dia = (date('Y') - 18) . '-' . date('m') . '-' . date('d');
$max = (date('Y') - 5) . '-' . date('m') . '-' . date('d');
require 'control/conexion.php';
$id = $_GET['cod'];
?>

<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a>
            </li>

            <li class="breadcrumb-item active"><a href="#"> Modificando Matricula </a>
            </li>
        </ol>
    </div>
</div>
<div class="app-content content container-fluid">
    <div class="content-wrapper">





        <div class="content-body"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">Modificando Matricula </h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                <div class="card-block">

                                    <form class="form" action="control/cMatricula.php" method="post" id="registro" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="icon-head"></i>Informacion de Matricula</h4>
                                            <?php
                                            $sql = "SELECT m.idMatricula,a.dni,concat(a.apepa,' ',a.apema,' ',a.nomb) as alu,a.ext,ap.dni,concat(ap.nomb,' ',ap.apepa,' ',ap.apema)as apo,
tg.idTipo,tg.descr,ae.idAnioEscolar,ae.descr,g.idGrado,g.descr,g.idtipo,s.idSeccion,s.descr,m.fecha,u.idUsuario,concat(u.nomb,' ',u.apepa,' ',u.apema) as usu,m.est,e.idestados,e.descrEst
,tm.idtipomatricula, tm.descr     FROM matricula m 
join alumnos a on m.dnialu=a.dni 
join apoderado ap on a.dniapo=ap.dni 
join grado g on m.idGrado=g.idGrado
join tipogrado tg on g.idTipo=tg.idTipo
join seccion s on m.idSeccion=s.idSeccion 
join anioescolar ae on m.idAnioEscolar=ae.idAnioEscolar
join usuario u on m.idUsuario=u.idUsuario
join estados e on m.est=e.idestados
join tipomatricula tm on m.idtipomat=tm.idtipomatricula
where m.idMatricula='$id'";
                                            $matricula = $mysqli->query($sql);
                                            while ($datos = $matricula->fetch_array()) {
                                                ?>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">DNI Alumno</label>
                                                            <input type="text"  class="form-control" onkeypress="return numeros(event)" maxlength="8" placeholder="DNI Alumno" name="dni" required="" readonly="" value="<?php echo $datos[1] ?>     ">
                                                            <input type="hidden" name="id" value="<?php echo $id ?>     ">
                                                            <input type="hidden" name="tipo" value="<?php echo $datos[6] ?>     ">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Datos Alumno</label>
                                                            <input type="text"  class="form-control" onkeypress="return letras(event)" maxlength="50"placeholder="Datos Alumno" name="nom" required="" value="<?php echo $datos[2] ?>     "readonly="">
                                                        </div>
                                                    </div>
                                                </div>



                                                <h4 class="form-section"><i class="icon-clipboard4"></i> Datos Matricula </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput6">Grado:</label>
                                                            <select id="projectinput6" name="grado" class="form-control">
                                                                <option value="<?php echo $datos[10] ?>"><?php echo $datos[11] ?></option>
                                                                <?php
                                                                $query = "SELECT * FROM grado where idTipo='$datos[6]' and est=1;";
                                                                $resultado = $mysqli->query($query);
                                                                while ($row = $resultado->fetch_array()) {
                                                                    ?>
                                                                    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                                                <?php } ?>


                                                            </select>
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput6">Seccion:</label>
                                                            <select id="projectinput6" name="seccion" class="form-control">
                                                                <option value="<?php echo $datos[13] ?>"><?php echo $datos[14] ?></option>
                                                                <?php
                                                                $query = "SELECT * FROM seccion where est=1;";
                                                                $resultado = $mysqli->query($query);
                                                                while ($row = $resultado->fetch_array()) {
                                                                    ?>
                                                                    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                                                <?php } ?>


                                                            </select>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput6">Año Escolar:</label>

                                                            <select id="anio" name="anio" class="form-control">
                                                                <option value="<?php echo $datos[8] ?>"><?php echo $datos[9] ?></option>
                                                                <?php
                                                                $query = "SELECT * FROM anioescolar where est= 1 order by idAnioEscolar desc;";
                                                                $resultado = $mysqli->query($query);
                                                                while ($row = $resultado->fetch_array()) {
                                                                    ?>
                                                                    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput6">TIPO DE MATRICULA:</label>
                                                            <select id="projectinput6" name="tmat" class="form-control">
                                                              <option value="<?php echo $datos[21] ?>"><?php echo $datos[22] ?></option>

                                                                <?php
                                                                $query = "SELECT * FROM tipomatricula where est=1;";
                                                                $resultado = $mysqli->query($query);
                                                                while ($row = $resultado->fetch_array()) {
                                                                    ?>
                                                                    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                    </div>  


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput6">Estado:</label>
                                                            <select id="projectinput6" name="est" class="form-control">
                                                                <option value="<?php echo $datos[19] ?>"><?php echo $datos[20] ?></option>
                                                                <option value="1">ACTIVO</option>
                                                                <option value="2">INACTIVO</option>
                                                                <option value="3">RETIRADO</option>

                                                            </select>
                                                        </div>
                                                    </div>  
                                                </div>

                                            <?php } ?>


                                        </div>

                                        <div class="form-actions">
                                            <a href="index.php"><button type="button" class="btn btn-warning mr-1">
                                                    <i class="icon-cross2"></i> Cancelar
                                                </button></a>
                                            <button type="submit" v-if="btalu==true" class="btn btn-primary" value="M" name="baccion">
                                                <i class="icon-check2"></i> Guardar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            </section>



        </div> </div> 


    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php
    include_once'./pie.php';
    ?>