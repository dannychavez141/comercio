
var idanio = anio.value;
var fech = fecha.value;
var tip = tipo.value;
var doc = docente.value;
console.log(doc + "-" + fech + "-" + tip + "-" + idanio)
$(buscar_datos(doc, fech, tip, idanio));

function buscar_datos(doc, fecha, tipo, anio) {
    $.ajax({
        url: './busqueda/buscarAsistenciaDocente.php',
        type: 'POST',
        dataType: 'html',
        data: {doc: doc, anio: anio,fecha: fecha, tipo: tipo}
    })
            .done(function (respuesta) {
                $("#datos").html(respuesta);
            })
            .fail(function () {
                console.log("error");
            });
}

function buscar() { // 1
    var doc = docente.value;
    var idanio = anio.value;
    var fech = fecha.value;
    var tip = tipo.value;
    console.log(doc + "-" + fech + "-" + tip + "-" + idanio)
    buscar_datos(doc, fech, tip, idanio);

}
