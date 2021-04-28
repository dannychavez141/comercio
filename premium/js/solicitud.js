
var app = new Vue({
    el: '#formulario',
    data: {
        dniAlu: '',
        nombAlu: '',
        apepaAlu: '',
        apemaAlu: '',
        grados: [],
        grado: '',
        secciones: [],
        seccion: '',
        destino: '',
        dniApo: '',
        nombApo: '',
        apepaApo: '',
        apemaApo: '',
        parentescos: [],
        parentesco: 0,
        celular: '',
        motivo: '',
        estado: 'r',
        validado: true

    }, methods: {
        onSubmit() {

            registrar();
        }
    }

});

function registrar()
{var statusConfirm = confirm("¿Usted verifico los datos de Solicitud y desea generarla?"); 
if (statusConfirm == true) 
{ 

    if(app.validado==true) {
    // console.log(app.solicitud);
    $.ajax({
        url: '../ajax/cSolicitud.php',
        type: 'POST',
        dataType: 'html',
        data: {control: app.estado
            , dniAlum: app.dniAlu
            , nombAlum: app.nombAlu
            , apepaAlum: app.apepaAlu
            , apemaAlum: app.apemaAlu
            , dniApo: app.dniApo
            , nombApo: app.nombApo
            , apepaApo: app.apepaApo
            , apemaApo: app.apemaApo
            , idgrado: app.grado[0]
            , idseccion: app.seccion[0]
            , parentesco: app.parentesco[0]
            , motivo: app.motivo
            , celular: app.celular

        }
    })
            .done(function (respuesta) {
                //console.log(respuesta);
                alert(respuesta);
                window.location = "index.php";
            })
            .fail(function () {
                console.log("error");
            });
        }else{
            alert("EL ALUMNO CON DNI N°."+app.dniAlu+" YA TIENE REGISTRADA UNA SOLICITUD DE RETIRO. SI DESEA GENERAR LA SOLICITUD DE OTRO ALUMNO POR FAVOR INGRESE LOS DATOS VALIDOS");
            }}

}
apiGrados();
apiSecciones();
apiApoderado();
function validar() {
   var url = '../ajax/cSolicitud.php?control=v&dni='+app.dniAlu;
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
       // console.log(datos.length);
        if(datos.length>0){
            app.validado=false;
        }else{
            app.validado=true;
        }
     //   console.log(app.validado);
    }
   
    return false;
}
function apiGrados() {
    var url = '../ajax/cGrado.php?control=all';
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        console.log(datos);
        app.grados = datos;
        app.grado = datos[0];

    }

    return false;
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
        console.log(datos);
        app.secciones = datos;
        app.seccion = datos[0];

    }

    return false;
}
function apiApoderado() {
    var url = '../ajax/cTipoApoderado.php?control=all';
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        console.log(datos);
        app.parentescos = datos;
        app.parentesco = datos[0];

    }

    return false;
}
function numerosv(e) {
    validar();
var charCode 
charCode = e.keyCode 
status = charCode 
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
return false
}
return true
}