
<?php
error_reporting(0);
require 'conexion.php';
$accion = $_POST['baccion'];
    echo "go?".$accion;
    switch ($accion) {
      case 'M':
      $dni = $_POST['dni'];
          $tarjeta = $_POST['newtarjeta'];
     $sql="UPDATE `alumnos` SET `targeta` = '$tarjeta' WHERE (`dni` = '$dni');";
        echo $sql;
      $rs=$mysqli->query($sql);
        $sql="UPDATE `temp` SET `codigo` = '' WHERE `idtemp` = '1'";
      echo $sql;
         $rs=$mysqli->query($sql);
         $mysqli->close();
 header("Location: ../verTarjeta.php?tconf=true");
       exit;
            break;
      default:
        # code...
        break;
    }


?>


