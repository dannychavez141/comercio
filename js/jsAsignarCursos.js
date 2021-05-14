cargardatos();
buscarDatos();
function cargardatos() {
    apiGrados();
    apiCursos();
}
function guardar()
{
    var txtsaldo = document.getElementById("txtadd").value;
    var notificacion = document.getElementById("notificacion")
    console.log(txtsaldo);
    if (txtsaldo > 0) {
        notificacion.innerHTML = "";
        document.getElementById("formulario").submit();
    } else {
        notificacion.innerHTML = "<div class='mensaje'> \n\
<div class='alert alert-danger' role='alert'> \n\
Error en al modificar Alumno. \n\
</div>\n\
</div>";
    }
}

function llenartabla(datos) {
    var tablas = document.getElementById('listaasignaciones');
    var plantilla = "<table class='table table-striped ' border='1' align='center'>\n\
    <tr class='bg-blue'><td>CURSO</td><td>GRADO Y SECCION</td><td>AÑO</td><td>QUITAR</td></tr>";
    var cantidad = datos.length;
    for (var i = 0; i < cantidad; i++) {
//console.log(datos[i]);
        plantilla += "<tr><td>" + datos[i][7] + "</td>\n\
<td align='center' >" + datos[i][27] + " " + datos[i][31] + " (" + datos[i][34] + ")</td>\n\
\n\<td align='center' >" + datos[i][37] + "</td>\n\
\n\<td align='center' ><button  class='btn btn-danger' type='button' onclick='quitar(" + datos[i][0] + "," + datos[i][1] + "," + datos[i][2] + "," + datos[i][3] +"," + datos[i][4] + ")'><i class='icon-android-remove'></i> \n\
Quitar</button></td></tr>";
    }
    plantilla += " </table>";
    tablas.innerHTML = plantilla;
}
function buscarDatos() {
    var id = document.getElementById("iddoc").value;
   // console.log("buscadro:" + id);
    var request = new XMLHttpRequest();
    request.open('GET', './ajax/verCursosAsignados.php?id=' + id);
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

function apiGrados() {
    var id = document.getElementById("tipo").value;
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
    var combohtml = document.getElementById("dgrado");
   // console.log(datosapi);
    var combo = "<select class='browser-default custom-select' name='idgrado'id='idgrado'>";

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<option value='" + datosapi[i][0] + "'>" + decode_utf8(datosapi[i]['descr']) + "</option>";
    }
    combo += "</select>";

    combohtml.innerHTML = combo;
}
function apiCursos() {
    var id = document.getElementById("tipo").value;
    console.log("valores:" + id);
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
    var combohtml = document.getElementById("dcurso");
   // console.log(datosapi);
    var combo = "<select class='browser-default custom-select' name='idcurso' id='idcurso'> ";

    for (var i = 0; i < datosapi.length; i++) {
        combo += "<option value='" + datosapi[i][0] + "'>" + decode_utf8(datosapi[i]['descr']) + "</option>";
    }
    combo += "</select>";

    combohtml.innerHTML = combo;
}
function quitar(iddoc, idcurso, idgrado, idsecc,idanio)
{
    console.log("-" + iddoc + "-" + idcurso + "-" + idgrado + "-" + idsecc+ "-" + idanio);
$.ajax({
		url: './ajax/quitarCurso.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {iddoc: iddoc,idcurso: idcurso,idgrado: idgrado,idsecc: idsecc,idanio: idanio}
	})
	.done(function(respuesta){
                buscarDatos();
		console.log(respuesta);
	})
	.fail(function(){
		console.log("error");
	});


}
function agregar()
{
    var iddoc = document.getElementById("iddoc").value;
    var idcurso = document.getElementById("idcurso").value;
    var idgrado = document.getElementById("idgrado").value;
    var idsecc = document.getElementById("secc").value;
    var idanio = document.getElementById("anio").value;
    console.log("-" + iddoc + "-" + idcurso + "-" + idgrado + "-" + idsecc + "-" + idanio);

	$.ajax({
		url: './ajax/asignarCurso.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {iddoc: iddoc,idcurso: idcurso,idgrado: idgrado,idsecc: idsecc,idanio: idanio}
	})
	.done(function(respuesta){
		console.log(respuesta);
        buscarDatos();
	})
	.fail(function(){
		console.log("error");
	});
}


