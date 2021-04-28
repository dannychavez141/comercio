
var app = new Vue({
    el: '#formularo',
    data: {
        iddocente: '',
        docente: '',
        dnidocente: '',
        zoomurl: '',
        zoomcod: '',
        zoompass: '',
        estado: 'm'

    }

});
app.iddocente = getQueryVariable('cod');

console.log(app.iddocente);
apiDocente(app.iddocente);
apiZoomDocente(app.iddocente);
function apiDocente(cod) {
    var request = new XMLHttpRequest();
    var url = './ajax/cdocente.php?control=uno&cod=' + cod;
    console.log(url);
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
       // console.log(datos);
        app.dnidocente = datos['dni'];
        app.docente = datos['nomb'] + ' ' + datos['apepa'] + ' ' + datos['apema'];

    }

    return false;
}
function apiZoomDocente(cod) {
    var request = new XMLHttpRequest();
    var url = './ajax/cZoomdocente.php?control=uno&cod=' + cod;
    console.log(url);
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
       // console.log(datos);
       // console.log(datos.length);
        if (datos.length != 0) {
            app.zoomurl = datos[0]['url'];
            app.zoomcod = datos[0]['codigo'];
            app.zoompass = datos[0]['pass'];
           // console.log(datos[0]['url']);
        } else {
            app.estado = 'r';

        }
    }

    return false;
}
function accion() {
    $.ajax({
        url: './ajax/cZoomdocente.php',
        type: 'POST',
        dataType: 'html',
        data: {control: app.estado,
            iddoc: app.iddocente,
            url: app.zoomurl,
            codigo: app.zoomcod,
            pass: app.zoompass}
    })
            .done(function (respuesta) {
                console.log(respuesta);
                alert(respuesta);
                window.location="verDocente.php";
            })
            .fail(function () {
                console.log("error");
            });
}
