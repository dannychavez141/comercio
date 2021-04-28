
$(buscar_datos(""));

function buscar_datos(consulta) {
    $.ajax({
        url: './busqueda/buscarTodasMatriculas.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta}
    })
            .done(function (respuesta) {
                $("#datos").html(respuesta);
            })
            .fail(function () {
                console.log("error");
            });
}


$(document).on('keyup', '#caja_busqueda', function () {
    var valor = $(this).val();
    buscar_datos(valor);
});
function buscar(e) { // 1
    var valor = caja_busqueda.value;
    buscar_datos(valor);

}