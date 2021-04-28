
var app = new Vue({
    el: '#formulario',
    data: {clase: [],
        clases: [],
        estado: 'v'

    }

});

cargardatos();
function cargardatos() {
    apiNivel();
    apiAnio();
    apiSecciones();
    buscarDatos();

}
function actualizarCombo() {
    apiGrados();
    apiCursos();
    buscarDatos();
}
function cambiarVista(estado) {
    app.estado = estado;
    apiNivel();
    apiAnio();
    apiSecciones();
    buscarDatos();
    if (estado == 'r') {
        app.clase['codigo'] = '';
    }
}
function mantenimiento(estado, posicion) {
    app.estado = estado;
    app.clase = app.clases[posicion];
    console.log(estado + "-" + posicion);
}
function llenartabla(datos) {
    app.clases = datos;
    var tablas = document.getElementById('listaClases');
    var plantilla = "<table class='table table-striped ' border='1' align='center'>\n\
    <tr class='bg-warning' align='center'><<td>CURSO</td><td>GRADO Y SECCION</td><td>CODIGO</td><td>MANTENIMIENTO</td></tr>";
    var cantidad = datos.length;
    for (var i = 0; i < cantidad; i++) {
//console.log(datos[i]);
        plantilla += "<tr><td>" + datos[i]['curso'] + "</td>\n\
<td align='center' >" + datos[i]['grado'] + " " + datos[i]['secc'] + " (" + datos[i]['tipo'] + " - " + datos[i]['anio'] + ")</td>\n\
\n\<td align='center' >" + datos[i]['codigo'] + "</td>\n\
\n\<td align='center' >\n\
<button  class='btn btn-success' type='button' onclick=mantenimiento('m'," + i + ")>Modificar</button><br>\n\
<button class='btn btn-danger' type='button' onclick=mantenimiento('e'," + i + ")><i class='icon-android-remove'></i> \n\
Quitar</button>\n\
</td></tr>";
    }
    plantilla += " </table>";
    tablas.innerHTML = plantilla;
}
function buscarDatos() {
    try {
        app.clase['idgrado'] = document.getElementById("idgrado").value;
        app.clase['idsecc'] = document.getElementById("idsecc").value;
        app.clase['idanio'] = document.getElementById("idanio").value;
        app.clase['idcurso'] = document.getElementById("idcurso").value;
        console.log("sin error");
        var url = './ajax/cClassRoom.php?control=uno&idgrado=' + app.clase['idgrado'] + '&idsecc=' + app.clase['idsecc'] + '&idanio=' + app.clase['idanio'] + '&idcurso=' + app.clase['idcurso'];
        console.log(url);
    } catch (e) {
        app.clase['idgrado'] = "1";
        app.clase['idsecc'] = "1";
        app.clase['idanio'] = "5";
        // app.clase['idcurso'] = "1";
        var url = './ajax/cClassRoom.php?control=all&idgrado=' + app.clase['idgrado'] + '&idsecc=' + app.clase['idsecc'] + '&idanio=' + app.clase['idanio'] + '';
    }


    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response; // get the string from the response
        // console.log(datosApi);
        var datos = JSON.parse(datosApi); // convert it to an object
        llenartabla(datos);
    }
    return true;
}
function apiCursos() {
    try {
        var id = document.getElementById("idniv").value;
        console.log("valores:" + id);
    } catch (e) {
        var id = '1';
    }
    var request = new XMLHttpRequest();
    request.open('GET', './ajax/verCursosGrado.php?id=' + id);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        llenarCursos(datos);
    }

    return false;
}
function llenarCursos(datosapi) {
    var combohtml = document.getElementById("cCurso");
    //console.log(datosapi);
    var combo = "<select class='browser-default custom-select' name='idcurso' id='idcurso' onchange='accion(0)'> ";
    if (app.estado == 'v') {
        combo += "<option value='0'>TODOS</option>";
    }
    for (var i = 0; i < datosapi.length; i++) {
        combo += "<option value='" + datosapi[i][0] + "'>" + decode_utf8(datosapi[i]['descr']) + "</option>";
    }
    combo += "</select>";

    combohtml.innerHTML = combo;
}

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
        apiCursos();

    }

    return false;
}
function llenarNivel(datosapi) {
    var combohtml = document.getElementById("cNiv");
    // console.log(datosapi);
    var combo = "<select class='browser-default custom-select'onchange='actualizarCombo();accion(0);' name='idniv' id='idniv'>";

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<option value='" + datosapi[i]['idTipo'] + "'>" + decode_utf8(datosapi[i][1]) + "</option>";
    }
    combo += "</select>";

    combohtml.innerHTML = combo;
}
function apiAnio() {

    var request = new XMLHttpRequest();
    request.open('GET', './ajax/cAnioEscolar.php?control=all');
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        // console.log(datos);
        llenarAnios(datos);


    }

    return false;
}
function llenarAnios(datosapi) {
    var combohtml = document.getElementById("cAnio");
    //console.log(datosapi);
    var combo = "<select class='browser-default custom-select' name='idanio' id='idanio'onchange='accion(0)'>";

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<option value='" + datosapi[i]['idAnioEscolar'] + "'>" + decode_utf8(datosapi[i][1]) + "</option>";
    }
    combo += "</select>";

    combohtml.innerHTML = combo;
}
function apiGrados() {
    var id = document.getElementById("idniv").value;
    //console.log("valores:" + id);
    var request = new XMLHttpRequest();
    request.open('GET', './ajax/verGradoNivel.php?id=' + id);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        llenarGrados(datos);
    }

    return false;
}

function llenarGrados(datosapi) {
    var combohtml = document.getElementById("cGrado");
    // console.log(datosapi);
    var combo = "<select class='browser-default custom-select'name='idgrado'id='idgrado' onchange='accion(0)'>";

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<option value='" + datosapi[i][0] + "'>" + decode_utf8(datosapi[i]['descr']) + "</option>";
    }
    combo += "</select>";

    combohtml.innerHTML = combo;
}


function apiSecciones() {

    var request = new XMLHttpRequest();
    request.open('GET', './ajax/cSecciones.php?control=all');
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        llenarSecciones(datos);
    }

    return false;
}


function llenarSecciones(datosapi) {
    var combohtml = document.getElementById("cSecc");
    // console.log(datosapi);
    var combo = "<select class='browser-default custom-select'name='idsecc'id='idsecc' onchange='accion(0)'>";
    if (app.vista == 'v') {
        combo += "<option value='0'>TODOS</option>";
    }

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<option value='" + datosapi[i][0] + "'>" + decode_utf8(datosapi[i]['descr']) + "</option>";
    }
    combo += "</select>";

    combohtml.innerHTML = combo;
}
function selecM(modo, id) {
    app.vista = modo;
    app.horario = app.horarios[id];
    console.log(app.horario['urlHorario']);
}
function nuevo() {
    app.vista = 'r';
    apiNivel();
    apiAnio();
    apiSecciones()
    app.horario['urlHorario'] = "";
}
function cancelar() {

    apiNivel();
    apiAnio();
    apiSecciones()
    apiHorarios();
    app.estado = 'v';
    app.horario['grado'] = "";
    app.horario['seccion'] = "";
    app.horario['tipo'] = "";
    app.horario['anio'] = "";
    app.horario['urlHorario'] = "";
}

function baseDatos()
{
    if (app.clase['codigo'] != "") {
        $.ajax({
            url: './ajax/cClassRoom.php',
            type: 'POST',
            dataType: 'html',
            data: {control: app.estado,
                idgrado: app.clase['idgrado'],
                idsecc: app.clase['idsecc'],
                idanio: app.clase['idanio'],
                idcurso: app.clase['idcurso'],
                codigo: app.clase['codigo']
            }
        })
                .done(function (respuesta) {
                    console.log(respuesta);
                })
                .fail(function () {
                    console.log("error");
                });
    } else {
        alert("El campo del Codigo esta Vacio");

    }
}

function accion(val) {
    console.log(app.estado);
    switch (app.estado) {
        case 'v':
            buscarDatos();
            console.log(app.clase['idgrado'] + "-" + app.clase['idsecc'] + "-" + app.clase['idanio'] + "-" + app.clase['idcurso']);
            break;
        case 'r':
            app.clase['idgrado'] = document.getElementById("idgrado").value;
            app.clase['idsecc'] = document.getElementById("idsecc").value;
            app.clase['idanio'] = document.getElementById("idanio").value;
            app.clase['idcurso'] = document.getElementById("idcurso").value;
            console.log(app.clase['idgrado'] + "-" + app.clase['idsecc'] + "-" + app.clase['idanio'] + "-" + app.clase['idcurso'] + "-" + app.clase['codigo']);
            if (val == 1) {
                console.log(app.clase['idgrado'] + "-" + app.clase['idsecc'] + "-" + app.clase['idanio'] + "-" + app.clase['idcurso'] + "-" + app.clase['codigo']);
                baseDatos();

            }
            buscarDatos();
            break;
        case 'm':
            console.log(app.clase['idgrado'] + "-" + app.clase['idsecc'] + "-" + app.clase['idanio'] + "-" + app.clase['idcurso'] + "-" + app.clase['codigo']);
            baseDatos();
            cambiarVista('v');
            break;
        case 'e':
            console.log(app.clase['idgrado'] + "-" + app.clase['idsecc'] + "-" + app.clase['idanio'] + "-" + app.clase['idcurso'] + "-" + app.clase['codigo']);
            baseDatos();
            cambiarVista('v');
            break;

        default:

            break;
    }
}