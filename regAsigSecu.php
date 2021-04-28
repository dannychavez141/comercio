<?php
//error_reporting(0);
include_once'./cabezera.php';
include './control/cConexion.php';
include './modelo/dbodocente.php';
$dboconexion = new cConexion();
$dbodocente = new dbodocente();
$conn = $dboconexion->getBd();
$id = $_GET['cod'];
?>

<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a>
            </li>

            <li class="breadcrumb-item"><a href="verDocenteAsig.php">Seleccion de docente para asignar curso </a>
            </li>

            <li class="breadcrumb-item active"><a href="#">Cursos asignados al docente </a>
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
                                <h4 class="card-title" id="basic-layout-form">Cursos  asignados al docente</h4>
                                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>

                                    </ul>
                                </div>
                            </div> 
                            <?php
                            $datos = $dbodocente->verundocente($id);
                            $iddoc = $datos[0];
                            $dni = $datos[1];
                            $nom = $datos[3] . ' ' . $datos[4] . ' ' . $datos[2];
                            $grad = $datos['descrCargo'] . " - " . $datos['detalle'];
                            ?>
                            <div class="card-body collapse in" id="registro">
                                <div class="card-block">


                                    <div class="form-body">
                                        <h4 class="form-section"><i class="icon-head"></i>Informacion de Docente</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Dni Docente</label>
                                                    <input type="text"  class="form-control"  maxlength="8" placeholder="Dni Docente" name="dni" value="<?php echo $dni ?>" readonly="">
                                                    <input type="hidden"  class="form-control"  value="<?php echo $id ?>" id="iddoc">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput1">Apellidos y Nombres</label>
                                                    <input type="text"  class="form-control" value="<?php echo $nom ?>" maxlength="50"placeholder="Nombre del Curso" name="nom" readonly="">
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput2">Cargo en la Institucion</label>
                                                    <input type="text"  class="form-control" value="<?php echo $grad ?>"maxlength="50"placeholder="Grado del Curso" name="grad" readonly="">
                                                </div>
                                            </div>

                                        </div>                                                                                                    
                                    </div>                             
                                    <h4 class="form-section"><i class="icon-clipboard4"></i> Cursos de Secundaria, Grado y seccion asignada </h4>
                                    <br>
                                    <div class="row">
                                        <?php
                                        $vacio = true;
                                        $cursosAsignados = $dbodocente->VerCursosAsignados($id);

                                        $datos = count($cursosAsignados);
                                        ?>
                                        <form action="control/cAsigSecu.php" method="post">
                                            <table class='table'>
                                                <tr><td><input type="hidden"  class="form-control"  maxlength="8" placeholder="Codigo de Curso" name="iddoc" value="<?php echo $iddoc ?>" readonly="">
                                                        AÑO ESCOLAR:<div>
                                                            <select id="anio" name="anio" class="browser-default custom-select">
                                                                <?php
                                                                $mysqli = $dboconexion->getBd();
                                                                $query = "SELECT * FROM anioescolar where est = 1 order by idAnioEscolar desc; ";
                                                                $anioescolar = $mysqli->query($query);
                                                                while ($anio = $anioescolar->fetch_array()) {
                                                                    ?>
                                                                    <option value="<?php echo $anio[0] ?>"><?php echo $anio[1] ?></option>
                                                                <?php } ?>
                                                            </select></div>
                                                    </td>
                                                    <td>
                                                        NIVEL: <div><select id="tipo" name="tipo" onchange="cargardatos()" class="browser-default custom-select">
                                                                <?php
                                                                $mysqli = $dboconexion->getBd();
                                                                $query = "SELECT * FROM tipogrado where est = 1 order by idTipo desc; ";
                                                                $grados = $mysqli->query($query);
                                                                while ($grado = $grados->fetch_array()) {
                                                                    ?>
                                                                    <option value="<?php echo $grado[0] ?>"><?php echo $grado[1] ?></option>
                                                                <?php } ?>
                                                            </select></div>
                                                    </td>
                                                    <td>GRADO: 
                                                        <div id="dgrado"></div>
                                                    </td>
                                                </tr><tr>
                                                    <td>CURSO:
                                                        <div id="dcurso"></div>
                                                    </td>
                                                    <td>
                                                        SECCION:<div><select id="secc" name="secc" class="browser-default custom-select">
                                                                <?php
                                                                $query = "SELECT * FROM seccion where est=1;";
                                                                $resultado = $mysqli->query($query);
                                                                while ($row = $resultado->fetch_array()) {
                                                                    ?>
                                                                    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                                                <?php } ?>
                                                            </select></div></td>
                                                            <td><div><button type="button"  class="btn btn-info" onclick="agregar()">
                                                                <i class="icon-plus4"></i> Agregar
                                                            </button></div></td></tr>
                                            </table>
                                            <div id="listaasignaciones">

                                            </div>





                                    </div>

                                    </section>

                                    <script>
                                        var iddoc =<?php echo $id ?>
                                    </script>

                                </div> </div> 
                            <script src="js/jsAsignarCursos.js" type="text/javascript"></script>
                            <script src="js/funciones.js" type="text/javascript"></script>
                            <!-- ////////////////////////////////////////////////////////////////////////////-->
                            <?php
                            include_once'./pie.php';
                            ?>