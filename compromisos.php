<?php
include_once'./cabezera.php';
?>
<link rel="stylesheet" href="./js/modaltingle/tingle.min.css">
<script src="./js/modaltingle/tingle.min.js"></script>
<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-15 col-xs-12">
    <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Inicio</a>
            </li>
            <li class="breadcrumb-item active"><a href="#">Compromisos de Pago</a>
            </li>
        </ol>
    </div>
</div>
<?php
$vista = "ver";
if (isset($_GET['vista'])) {
    $vista = $_GET['vista'];
}
switch ($vista) {
    case "ver":
        include_once'./verCompromisos.php';

        break;
    case "reg":
        include_once'./RegCompromisos.php';

        break;
    case "mod":
        include_once'./modCompromisos.php';

        break;
    default:
        break;
}
?>

<?php
include_once'./pie.php';
