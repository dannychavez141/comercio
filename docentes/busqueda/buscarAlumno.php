<?php

include_once'../control/conexion.php';

if (isset($_COOKIE['usuario'])) {
    echo "";
} else {
    header("Location: ../login.php");
    exit();
}
$usuario = $_COOKIE['usuario'];
$idusuario = $_COOKIE['idUsuario'];
$idtipo = $_COOKIE['idtipo'];
$tipo = $_COOKIE['tipo'];
if ($idtipo != 4) {
    header("Location: ../login.php");
    exit();
}
$conn = $mysqli;
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$salida = "";

$query = "SELECT * FROM asigdocente ad
join cursos c on ad.idCursos=c.idCursos
join docente d on ad.idDocente=d.idDocente
join grado g on ad.idGrado=g.idGrado
join seccion s on ad.idSeccion=s.idSeccion
join anioescolar ae on ad.idAnioEscolar=ae.idAnioEscolar
join estados e on ad.est=e.idestados
where d.idDocente='$idusuario'";
$sql = "";
$grado="";
$seccion="";
$anio="";
$resultado = $conn->query($query);


if ($resultado->num_rows > 0) {

    $salida .= "<table class='table table-striped ' border='1'>
                        <thead class='bg-blue'>
                            <tr>
                                <th>DNI</th>
                                <th>DATOS ALUMNO</th>
                                <th>GRADO Y SECCION</th>
                                <th>AÑO ESCOLAR</th>
                                
                                <th>AGREGAR</th>
                                 
                            </tr>
                        </thead>
                        <tbody>";

    while ($fila = $resultado->fetch_array()) {
        require '../control/conexion.php';
       $temp1=$fila[4];
        $temp2=$fila[2];
        $temp3=$fila[3];
        if($grado != $temp1 || $seccion != $temp2 || $anio != $temp3 )
        { $grado=$fila[4];
        $seccion=$fila[2];
        $anio=$fila[3];
        $sql = "call vermatricula('',$grado , $seccion, $anio);";
        if (isset($_POST['consulta'])) {
            $q = $mysqli->real_escape_string($_POST['consulta']);
            $sql = "call vermatricula('$q',$grado , $seccion, $anio);";
        }
        $lista = $mysqli->query($sql);
        while ($alum = $lista->fetch_array()) {
            $salida .= "<tr>
                        <td>" . $alum[1] . "</td>
                        <td>" . $alum[2] . "</td>
                       <td>" . $alum[10] . " " . $alum[12] . "</td>
                        <td>" . " " . $alum[8] . "</td>
                        
                        <td><a href='./regIncidencia.php?cod=" . $alum[0] . "'  ><center><img src='../img/mas.png' width='50' height='50'></center></a></td>
                        </tr>";
        }
    }}
    $salida .= "</tbody></table>";
} else {
    $salida .= "NO TIENE ALUMNOS  REGISTRADOS   $query :(";
}
echo $salida;

$conn->close();
?>