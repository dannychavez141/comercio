
var app = new Vue({
    el: '#formulario',
    data: {
        idmat: '',
        dnialu: '',
        alumno: '',
        salon: '',
        idgrado: '',
        idsecc: '',
        idanio: '',
        clases: [],
        zoom: [],
        horario: ''

    }

});
app.idmat = getQueryVariable('cod');
console.log(app.idmat);
apimatricula(app.idmat);
function apimatricula(idmat) {

    var request = new XMLHttpRequest();
    request.open('GET', '../ajax/cMatricula.php?control=uno&cod=' + idmat);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        //  console.log(datos);
        app.dnialu = datos['dni'];
        app.alumno = datos['alu'];
        app.salon = datos['grado'] + " '" + datos['seccion'] + "' (" + datos['descr'] + " " + datos['anio'] + ")";
        app.idgrado = datos['idGrado'];
        app.idsecc = datos['idSeccion'];
        app.idanio = datos['idAnioEscolar'];
        apiclases(app.idgrado, app.idsecc, app.idanio);
        apizoom(app.idgrado, app.idsecc, app.idanio);
        apiHorario(app.idgrado, app.idsecc, app.idanio);
        apiDireccion();
    }

    return false;
}
function apiclases(idgrado, idsecc, idanio) {
    var url = '../ajax/cClassRoom.php?control=all&idgrado=' + idgrado + '&idsecc=' + idsecc + '&idanio=' + idanio;
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        //console.log(datos);
        llenarClases(datos);


    }

    return false;
}
function llenarClases(datosapi) {
    var combohtml = document.getElementById("listaclases");
    console.log(datosapi);
    var combo = "<table style='width: 100%'>";

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<tr><td>" + decode_utf8(datosapi[i]['curso']) + ":</td><td>\n\
<input type='text' class='form-control' value='" + datosapi[i]['codigo'] + "' readonly /></td></tr>";
    }
    combo += "</table>";

    combohtml.innerHTML = combo;
}

function apizoom(idgrado, idsecc, idanio) {
    var url = '../ajax/cZoomDocente.php?control=all&idgrado=' + idgrado + '&idsecc=' + idsecc + '&idanio=' + idanio;
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        //console.log(datos);
        llenarZoom(datos);


    }

    return false;
}
function llenarZoom(datosapi) {
    var combohtml = document.getElementById("listazoom");
    console.log(datosapi);
    var combo = "<table style='width: 100%' class='table'>";

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<tr><td>" + decode_utf8(datosapi[i]['nomb']+"\n"+ datosapi[i]['apepa']+"\n"+datosapi[i]['apema'] ) + " <br>\n\
Curso: <strong> "+ decode_utf8(datosapi[i]['descr']) +"</strong> Codigo: " + datosapi[i]['codigo'] + " Clave: " + datosapi[i]['pass'] + "</td><td> <a href='"+datosapi[i]['url'] +"' class='btn btn-blue' target='_blank'> ENLACE A ZOOM</a></td></tr>";
    }
    combo += "</table>";

    combohtml.innerHTML = combo;
}

function apiHorario(idgrado, idsecc, idanio) {
    var url = '../ajax/cHorarios.php?control=uno&idgrado=' + idgrado + '&idsecc=' + idsecc + '&idanio=' + idanio+'&idniv=0';
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        console.log(datos);
      llenarHorario(datos);


    }

    return false;
}
function llenarHorario(datosapi) {
    var combohtml = document.getElementById("listahorario");
    //console.log(datosapi);
    var combo = "<table style='width: 100%'>";

    for (var i = 0; i < datosapi.length; i++) {
         combo += "<tr align='center'><td>" + decode_utf8(datosapi[i]['grado']+"\n"+ datosapi[i]['seccion']+"\n<br>"+datosapi[i]['tipo']+" - "+datosapi[i]['anio']) + " <br>\n\
<br><a href='"+datosapi[i]['urlHorario'] +"' class='btn btn-warning' target='_blank'> ENLACE A HORARIO</a></td></tr>";
     }
    combo += "</table>";

    combohtml.innerHTML = combo;
}
function apiDireccion() {
    var url = '../ajax/cZoomDocente.php?control=uno&cod=18';
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        console.log(datos);
      llenarDireccion(datos);


    }

    return false;
}
function llenarDireccion(datosapi) {
    var combohtml = document.getElementById("direccion");
    //console.log(datosapi);
var combo = "<table style='width: 100%' class='table'>";

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<tr align='center'><td>" + decode_utf8(datosapi[i]['prof']) + "<h5>DIRECTOR</h5>Codigo: " + datosapi[i]['codigo'] + " <br>Clave: " + datosapi[i]['pass'] + "<br><a href='"+datosapi[i]['url'] +"' class='btn btn-blue' target='_blank'> ENLACE A ZOOM </a></td></tr>";
    }
    combo += "</table>";

    combohtml.innerHTML = combo;
}


function copiar(codigo) {
    console.log(codigo);
    document.execCommand('copy');
}