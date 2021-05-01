
var app = new Vue({
    el: '#formulario',
    data: {
        trabajos: [],
        grados: [],
        secciones: [],
        anios: [],
        actividades: [],
        idgrado: '0',
        idseccion: '0',
        idanio: '0',
        idactividad: '0',
        busq: '',
        participantes: [],
        enlaces: []
    }

});
apiactividad();
apianio();
//console.log("aca toy");
function buscar(){
    var idanio=document.getElementById("cmbAnio").value;
     var idgrado=document.getElementById("cmbgrado").value;
      var idseccion=document.getElementById("cmbSeccion").value;
      var idactividad=document.getElementById("cmbActividad").value;
      console.log(idanio+"-"+idgrado+"-"+idseccion+"-"+app.busq+"-"+idactividad);
    apitrabajos(idgrado,idseccion,idanio,idactividad);
}
function apitrabajos(idgrado, idsecc, idanio,idactividad) {
    var url = '../ajax/cTrabajo.php?control=all&busq=' + app.busq + '&idgrado=' + idgrado + '&idseccion=' + idsecc + '&idanio=' + idanio+ '&idActividad=' + idactividad;
   console.log(url);
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        app.trabajos = datos;
        app.participantes= [];
        app.enlaces= [];
        buscarParticipante();
      // console.log(app.trabajos);
    }
   // console.log("ya sali");
    return false;
}
function buscarParticipante() {
    let cont = 0;
    for (trabajo of app.trabajos) {
        //  console.log(trabajo['idtrabajos']);
        //console.log(trabajo);
        // app.trabajos[cont]['participantes'] = [];
        //  app.trabajos[cont]['enlaces'] = [];
        apiParticipante(trabajo['idtrabajos']);
        apienlaces(trabajo['idtrabajos']);
        cont++;
    }
}
function apiParticipante(idTrabajo)
{
    var request = new XMLHttpRequest();
    var url = '../ajax/cTrabajo.php?control=part&idtrab=' + idTrabajo;
   console.log(url);
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        //   console.log(datosApi);
        var datos = JSON.parse(datosApi); // convert it to an object
        // console.log("aca estoy");
        console.log(datos);
        app.participantes.push(datos);
    }
}
function apienlaces(idTrabajo) {
    var request = new XMLHttpRequest();
    var url = '../ajax/cTrabajo.php?control=Enlace&idtrab=' + idTrabajo;
    //  console.log(url);
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        //  console.log(datosApi);
        var datos = JSON.parse(datosApi); // convert it to an object
        // console.log("aca estoy");
        console.log(datos);
        app.enlaces.push(datos);
    }
}



function apiSecciones() {
    var url = '../ajax/cSecciones.php?control=all';
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        //  console.log(datos);
        app.secciones = datos;
        apitrabajos('0', '0', '0','0');
    }

    return false;
}
function apigrados() {
    var url = '../ajax/cGrado.php?control=all';
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        //  console.log(datos);
        app.grados = datos;
        apiSecciones();
        // return true;
    }
    return false;
}

function apianio() {
    var url = '../ajax/cAnioEscolar.php?control=all';
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        //  console.log(datos);
        app.anios = datos;
        apigrados();
        
    }
    return false;
}
function apiactividad() {
    var url = '../ajax/cActividad.php?control=all';
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        //  console.log(datos);
        app.actividades = datos;
    }
    return false;
}