
<footer class="footer footer-static footer-light navbar-border" 
        style=" position: fixed;
        bottom: 5px;">
    <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2021 , Todos los derechos Reservados. </span><span class="float-md-right d-xs-block d-md-inline-block">Hecho a mano y hecho con <i class="icon-heart5 pink"></i></span></p>
</footer>
<script type="text/javascript">
    function numeros(e) {
        var charCode
        charCode = e.keyCode
        status = charCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false
        }
        return true
    }
    function cerrar()
    {
        var statusConfirm = confirm("¿Deseas Cerrar La Seccion?");
        if (statusConfirm == true)
        {
            document.location = 'control/cerrar.php';

        }
    }
    function letras(e) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla == 8)
            return true; // 3
        patron = /[A-Za-z\s-ñ/Ñ]/; // 4
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    }

    function NumCheck(e, field) {
        key = e.keyCode ? e.keyCode : e.which
        // backspace
        if (key == 8)
            return true
        // 0-9
        if (key > 47 && key < 58) {
            if (field.value == "")
                return true
            regexp = /.[0-9]{2}$/
            return !(regexp.test(field.value))
        }
        // .
        if (key == 46) {
            if (field.value == "")
                return false
            regexp = /^[0-9]+$/
            return regexp.test(field.value)
        }
        // other key
        return false

    }



</script>
<script src="/librerias/app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
<script src="/librerias/app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
<script src="/librerias/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="/librerias/app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
<script src="/librerias/app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
<script src="/librerias/app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
<script src="/librerias/app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
<script src="/librerias/app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="/librerias/app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="/librerias/app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="/librerias/app-assets/js/core/app.js" type="text/javascript"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="/librerias/app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->