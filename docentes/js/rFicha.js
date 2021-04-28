
var app = new Vue({
    el: '#registro',
    data: {idalu: 1,
        iddoc: '',
        docente: '',
        fecha: '',
        sesion: '',
        semana: '',
        cursos: [],
        curso: [],
        competencias: [],
        competencia: [],
        limpio: [],
        alumnos: [],
        alumno: [],
        estado: 'r'
    }

});
app.iddoc = idusuario;
app.docente = usuario;
console.log(usuario);
cursosDoc(idusuario);
var f = new Date();
app.fecha = fcha;
console.log(app.fecha);

function cursosDoc(id) {
    var request = new XMLHttpRequest();
    request.open('GET', '../ajax/verCursosAsignados.php?id=' + id);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
         console.log("aca estoy");
        console.log(datos);
        app.cursos = datos;
        app.curso = datos[0];
        competenciCurso(app.curso[6]);
        alumnosClase(app.curso[26], app.curso[30], app.curso[36]);

    }
}

function competenciCurso(id) {
    var request = new XMLHttpRequest();
    request.open('GET', '../ajax/cCompetencia.php?control=all&idcurso=' + id);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        //console.log(datos);
        app.competencias = datos;
        app.competencia=app.limpio;
        // console.log("aca estoy");
        //console.log(app.competencias)
        

    }
    alumnosClase(app.curso[26], app.curso[30], app.curso[36]);
}
function alumnosClase(idgrado, idsecc, idanio) {
    var url = '../ajax/cAlumnos.php?control=lista&idgrado=' + idgrado + '&idsecc=' + idsecc + '&idanio=' + idanio;
   // console.log(url);
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
         console.log(datosApi);
        var datos = JSON.parse(datosApi); // convert it to an object
        //console.log(datos);
        app.alumnos = datos;
       // console.log(app.alumnos)

    }
}
function confirmar() {
    if (window.confirm("Verifico todos los Datos?")) {
        console.log("Si");
        registrar();
    } else {
        console.log("No");
    }
}
function registrar()
{
    if (app.competencia.length > 0) {


        $.ajax({
            url: '../ajax/cFicha.php',
            type: 'POST',
            dataType: 'html',
            data: {control: app.estado,
                curso: JSON.stringify(app.curso),
                sesion: app.sesion,
                semana: app.semana,
                fecha: app.fecha,
                competencias: JSON.stringify(app.competencia),
                alumnos: JSON.stringify(app.alumnos)
            }
        })
                .done(function (respuesta) {
                   // console.log(respuesta);
                   alert("FICHA REGISTRADA CORRECTAMENTE");
                   window.location="verFicha.php";
                })
                .fail(function () {
                    console.log("error");
                });
    } else {
        alert("Usted tiene que seleccionar una o mas competencias");
    }
}

