<?php
include_once'./cabezera.php';
require 'control/conexion.php';

//  
function codnota($nota, $modo) {

    if ($modo == 1 || $modo == 3) {
        $notaletras = 'NE';
        if ($nota == 0) {
            $notaletras = 'C';
        }
        if ($nota == 1) {
            $notaletras = 'B';
        }
        if ($nota == 2) {
            $notaletras = 'A';
        }
        if ($nota == 3) {
            $notaletras = 'AD';
        }
    } else {
        if ($nota <= -1) {
            $notaletras = 'NE';
        } else {
            $notaletras = $nota;
        }
    }
    return $notaletras;
}
?>
<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a>
            </li>
            <li class="breadcrumb-item active"><a href="#">Exportando Notas</a>
            </li>
        </ol>
    </div>
</div>
<div class="app-content content container-fluid">
    <div class="content-wrapper">





        <div class="content-body"><!-- Basic form layout section start -->

            <section id="basic-form-layouts">
                <div class="row match-height">
                    <?php
                    $sql = "SELECT * FROM tipogrado where est=1;";
                    $niveles = $mysqli->query($sql);
                    while ($nivel = $niveles->fetch_array()) {
                        ?>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">LISTA NOTAS <?php echo $nivel[1] ?></h4>
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

                                        <form class="form" action="reporteexcel/notasexcel.php" method="post" id="registro" target="_blank">
                                            <div class="form-body">
                                                AÑO ACADEMICO:<select name="anio">
                                                    <?php
                                                    require 'control/conexion.php';
                                                    $asql = "SELECT * FROM anioescolar order by idAnioEscolar desc;";
                                                    $anios = $mysqli->query($asql);
                                                    while ($anio = $anios->fetch_array()) {
                                                        ?> 
                                                        <option value="<?php echo $anio[0] ?>"><?php echo $anio[1] ?></option>
    <?php } ?>
                                                </select>
                                                <button type="submit" class="btn btn-primary" value="R" name="baccion">
                                                    <i class="icon-check2"></i> EXPORTAR EXCEL
                                                </button>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table  border='1'>
                                                            <thead class='bg-warning'>
                                                                <tr><th>N°</th><th>ALUMNO</th><th>GRADO</th><th>SECCION</th>
                                                                    <?php
                                                                    require 'control/conexion.php';
                                                                    $sql1 = "SELECT distinct(cu.descr) FROM notasalumno na join competencias c on na.idComp=c.idComp join matricula m on na.idMatricula=m.idMatricula 
join cursos cu on c.idcurso=cu.idCursos   where cu.idtipogrado='$nivel[0]' and c.est=1 ;";
                                                                    $cursos = $mysqli->query($sql1);
                                                                    while ($curso = $cursos->fetch_array()) {
                                                                        ?>
                                                                        <th><?php echo $curso[0] ?></th>
    <?php } ?>
                                                                </tr>
                                                            </thead>

                                                            <?php
                                                            include 'control/conexion.php';
                                                            $modo = 1;

                                                            $sql2 = "SELECT idMatricula,al.apepa,al.apema,al.nomb,g.descr,s.descr,g.idGrado,g.idTipo FROM matricula m 
join alumnos al on m.dnialu=al.dni
join grado g on m.idGrado=g.idGrado 
join seccion s on m.idSeccion=s.idSeccion
where g.idTipo='$nivel[0]'and m.est='1' order by g.descr,s.descr,g.idTipo,al.apepa ;";
                                                            $matriculas = $mysqli->query($sql2);
                                                            while ($matricula = $matriculas->fetch_array()) {
                                                                echo "<tr>";
                                                                if ($matricula[6] != 7) {

                                                                    $modo = $matricula[7];
                                                                } else {
                                                                    $modo = 1;
                                                                }
                                                                $tempcur = "";
                                                                $nota1 = 0;
                                                                $nota2 = 0;
                                                                $nota3 = 0;
                                                                $nota4 = 0;
                                                                $suma1 = 0;
                                                                $suma2 = 0;
                                                                $suma3 = 0;
                                                                $suma4 = 0;
                                                                $prom = 0;
                                                                $cont = 0;

                                                                echo "<td>" . $matricula[0] . "</td>" . "<td>" . $matricula[1] . " " . $matricula[2] . " " . $matricula[3] . "</td><td>" . $matricula[4] . "</td><td>" . $matricula[5] . "</td>";
                                                                include 'control/conexion.php';
                                                                $sql3 = "call vernotas($matricula[0]);";
                                                                $notas = $mysqli->query($sql3);

                                                                while ($nota = $notas->fetch_array()) {
                                                                    if ($modo == 2) {
                                                                        if ($tempcur != $nota[0]) {
                                                                            if ($tempcur != "") {
                                                                                $suma1 = round($nota1 / $cont);
                                                                                $suma2 = round($nota2 / $cont);
                                                                                $suma3 = round($nota3 / $cont);
                                                                                $suma4 = round($nota4 / $cont);
                                                                                $prom = round(($suma1 + $suma2 + $suma3 + $suma4) / 4);
                                                                                echo "<td>" . codnota($prom, $modo) . "</td>";
                                                                                $nota1 = 0;
                                                                                $nota2 = 0;
                                                                                $nota3 = 0;
                                                                                $nota4 = 0;
                                                                                $cont = 0;
                                                                            }
                                                                            $tempcur = $nota[0];
                                                                            $nota1 = $nota1 + $nota[2];
                                                                            $nota2 = $nota2 + $nota[3];
                                                                            $nota3 = $nota3 + $nota[4];
                                                                            $nota4 = $nota4 + $nota[5];
                                                                            $cont++;
                                                                        } else {
                                                                            $nota1 = $nota1 + $nota[2];
                                                                            $nota2 = $nota2 + $nota[3];
                                                                            $nota3 = $nota3 + $nota[4];
                                                                            $nota4 = $nota4 + $nota[5];
                                                                            $cont++;
                                                                        }
                                                                    } else {
                                                                        if ($tempcur != $nota[0]) {
                                                                            if ($tempcur != "") {
                                                                                $suma1 = $nota1;
                                                                                $suma2 = $nota2;
                                                                                $suma3 = $nota3;
                                                                                $suma4 = $nota4;
                                                                                $prom = $suma4;
                                                                                echo "<td>" . codnota($prom, $modo) . "</td>";
                                                                                $nota1 = 0;
                                                                                $nota2 = 0;
                                                                                $nota3 = 0;
                                                                                $nota4 = 0;
                                                                                $cont = 0;
                                                                            }
                                                                            $tempcur = $nota[0];
                                                                            $nota1 = $nota[2];
                                                                            $nota2 = $nota[3];
                                                                            $nota3 = $nota[4];
                                                                            $nota4 = $nota[5];
                                                                            $cont++;
                                                                        } else {
                                                                            $nota1 = $nota[2];
                                                                            $nota2 = $nota[3];
                                                                            $nota3 = $nota[4];
                                                                            $nota4 = $nota[5];
                                                                            $cont++;
                                                                        }
                                                                    }
                                                                }
                                                                if ($modo == 2) {
                                                                    if ($tempcur != $nota[0]) {
                                                                        if ($tempcur != "") {
                                                                            $suma1 = round($nota1 / $cont);
                                                                            $suma2 = round($nota2 / $cont);
                                                                            $suma3 = round($nota3 / $cont);
                                                                            $suma4 = round($nota4 / $cont);
                                                                            $prom = round(($suma1 + $suma2 + $suma3 + $suma4) / 4);
                                                                            echo "<td>" . codnota($prom, $modo) . "</td>";
                                                                            $nota1 = 0;
                                                                            $nota2 = 0;
                                                                            $nota3 = 0;
                                                                            $nota4 = 0;
                                                                            $cont = 0;
                                                                        }
                                                                    }
                                                                } else {
                                                                    if ($tempcur != $nota[0]) {
                                                                        if ($tempcur != "") {
                                                                            $suma1 = $nota1;
                                                                            $suma2 = $nota2;
                                                                            $suma3 = $nota3;
                                                                            $suma4 = $nota4;
                                                                            $prom = $suma4;
                                                                            echo "<td>" . codnota($prom, $modo) . "</td>";
                                                                            $nota1 = 0;
                                                                            $nota2 = 0;
                                                                            $nota3 = 0;
                                                                            $nota4 = 0;
                                                                            $cont = 0;
                                                                        }
                                                                    }
                                                                }
                                                                echo "</tr>";
                                                            }
                                                            ?>                                  




                                                        </table>
                                                    </div>
                                                </div>




                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php } ?>
                </div>


            </section>



        </div> 

        <script type="text/javascript">

            var regcur = new Vue({
                el: '#registro',
                data: {
                    id: "AUTOGENERADO",
                    cur: ""
                }
            });

        </script>

        <?php
        include_once'./pie.php';
        ?>