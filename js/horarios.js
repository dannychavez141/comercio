
var app = new Vue({
    el: '#registro',
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
function llenarNivel(datosapi) {
    var combohtml = document.getElementById("cNiv");
    console.log(datosapi);
    var combo = "<select class='browser-default custom-select'onchange='apiGrados();accion()' name='idniv' id='idniv'>";

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
    console.log(datosapi);
    var combo = "<select class='browser-default custom-select'onchange='accion()' name='idanio' id='idanio'>";

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<option value='" + datosapi[i]['idAnioEscolar'] + "'>" + decode_utf8(datosapi[i][1]) + "</option>";
    }
    combo += "</select>";

    combohtml.innerHTML = combo;
}
function apiGrados() {
    var id = document.getElementById("idniv").value;
    console.log("valores:" + id);
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
    if (app.vista == 'v') {
        combo += "<option value='0'>TODOS</option>";
    }

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<option value='" + datosapi[i][0] + "'>" + decode_utf8(datosapi[i]['descr']) + "</option>";
    }
    combo += "</select>";

    combohtml.innerHTML = combo;
}

function apiHorarios() {
    app.vista = 'v';
    try {

        app.horario['idGrado'] = document.getElementById("idgrado").value;
        app.horario['idsecc'] = document.getElementById("idsecc").value;
        app.horario['idanio'] = document.getElementById("idanio").value;
        app.horario['idTipo'] = document.getElementById("idniv").value;
        var url = './ajax/cHorarios.php?control=uno&idgrado=' + app.horario['idGrado'] + '&idsecc=' + app.horario['idsecc'] + '&idanio=' + app.horario['idanio'] + '&idniv=' + app.horario['idTipo'];
    } catch (e) {
        app.horario['idGrado'] = '0';
        app.horario['idsecc'] = '0';
        app.horario['idanio'] = '0';
        var url = './ajax/cHorarios.php?control=all';
    }

    console.log(url);
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        llenarHorarios(datos);
    }

    return false;
}


function llenarHorarios(datosapi) {
    var combohtml = document.getElementById("listado");
    console.log(datosapi);
    var combo = "";
    app.horarios = datosapi;
    for (var i = 0; i < datosapi.length; i++) {

        combo += "<div class='col-xl-2 col-lg-6 col-xs-10'> <div class='card'>     \n\
   <div class='card-block'>         <div class='card-title' align='center'>      \n\
   HORARIO " + datosapi[i]['tipo'] + "        </div>         <div class='card-header' align='center'> \n\
  " + datosapi[i]['grado'] + " '" + decode_utf8(datosapi[i]['seccion']) + "' (" + datosapi[i]['anio'] + ")         </div> \n\
          <div class='card-body' align='center'>\n\
<a href='" + datosapi[i]['urlHorario'] + "' target='_blank' onclick='accion()' >VER DETALLADO</a> \n\
 </div>\n\
  <div class='card-footer'>\n\
 <button type='button'class='form-control btn-danger' onclick=selecM('m','" + i + "') >Editar</button><br> <button type='button'class='form-control btn btn-warning' onclick=selecM('e','" + i + "')>Eliminar</button>\n\
                                                                    </div>\n\
                                                                </div>\n\
                                                            </div>\n\
                                                        </div>";

    }
    combo += "";

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
    app.vista = 'v';
    app.horario['grado'] = "";
    app.horario['seccion'] = "";
    app.horario['tipo'] = "";
    app.horario['anio'] = "";
    app.horario['urlHorario'] = "";
}

function agregar()
{
    app.horario['idGrado'] = document.getElementById("idgrado").value;
    app.horario['idSeccion'] = document.getElementById("idsecc").value;
    app.horario['idAnioEscolar'] = document.getElementById("idanio").value;
    console.log("-" + app.horario['idGrado'] + "-" + app.horario['idSeccion'] + "-" + app.horario['idAnioEscolar'] + "-" + app.horario['urlHorario']);
    if (app.horario['urlHorario'] != "") {
        $.ajax({
            url: './ajax/cHorarios.php',
            type: 'POST',
            dataType: 'html',
            data: {control: app.vista,
                idgrado: app.horario['idGrado'],
                idsecc: app.horario['idSeccion'],
                idanio: app.horario['idAnioEscolar'],
                urlHorario: app.horario['urlHorario']}
        })
                .done(function (respuesta) {
                    console.log(respuesta);
                    apiHorarios();
                })
                .fail(function () {
                    console.log("error");
                });
    } else {
        alert("El campo de URL esta Vacio");
        app.vista = 'v';
    }
}
function modificar()
{
    console.log("-" + app.horario['idGrado'] + "-" + app.horario['idSeccion'] + "-" + app.horario['idAnioEscolar'] + "-" + app.horario['urlHorario']);

    $.ajax({
        url: './ajax/cHorarios.php',
        type: 'POST',
        dataType: 'html',
        data: {control: app.vista,
            idgrado: app.horario['idGrado'],
            idsecc: app.horario['idSeccion'],
            idanio: app.horario['idAnioEscolar'],
            urlHorario: app.horario['urlHorario']}
    })
            .done(function (respuesta) {
                console.log(respuesta);
                apiHorarios();
            })
            .fail(function () {
                console.log("error");
            });
}

function quitar()
{
    console.log("-" + app.horario['idGrado'] + "-" + app.horario['idSeccion'] + "-" + app.horario['idAnioEscolar'] + "-" + app.horario['urlHorario']);

    $.ajax({
        url: './ajax/cHorarios.php',
        type: 'POST',
        dataType: 'html',
        data: {control: app.vista,
            idgrado: app.horario['idGrado'],
            idsecc: app.horario['idSeccion'],
            idanio: app.horario['idAnioEscolar'],
            urlHorario: app.horario['urlHorario']}
    })
            .done(function (respuesta) {
                console.log(respuesta);

                apiHorarios();
            })
            .fail(function () {
                console.log("error");
            });

}
function accion(val) {
    console.log(app.vista);
    switch (app.vista) {
        case 'v':

            apiHorarios();

            break;
        case 'r':
            if (val == 1) {
                agregar();
                cancelar();
            }

            break;
        case 'm':
            modificar();
            cancelar();

            break;
        case 'e':
            quitar();
            cancelar();
            break;

        default:

            break;
    }
}