var app = new Vue({
    el: '#datos',
    data: {
        vista: 'v',
        horario: [],
        horarios: []
    }

});
apiNivel();
apiAnio();
apiSecciones()
apiHorarios();


function apiNivel() {

    var request = new XMLHttpRequest();
    request.open('GET', './ajax/cNivelEduc.php?control=all');
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        // console.log(datos);
        llenarNivel(datos);
        apiGrados();

    }

    return false;
}