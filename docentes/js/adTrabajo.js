
var app = new Vue({
    el: '#registro',
    data: {idtrab: '',
        iddoc: '',
        docente: '',
        trabajo: [],
        descripcion: '',
        archivo: null,
        cursos: [],
        curso: [],
        cursoE: [],
        alumnos: [],
        alumno: [],
        elegido: false,
        participantes: [],
        enlaces: [],
        descrenlace: '',
        enlace: '',
        limpio: [],
        estado: 'm',
        busqueda: "",
        actividades: [],
        actividad: [],
    },
    methods: {
        onFileChange() {
            this.archivo = document.getElementById('file').value;
        },
        confirmar() {
            if (window.confirm("Verifico todos los Datos?")) {
              //  console.log("Si");
                this.trabajo['iddocente'] = this.curso['idDocente'];
                this.trabajo['idcurso'] = this.curso['idCursos'];
                this.trabajo['idGrado'] = this.curso['idGrado'];
                this.trabajo['idseccion'] = this.curso['idSeccion'];
                this.trabajo['idanioescolar'] = this.curso['idAnioEscolar'];
                this.trabajo['idActividad'] = this.actividad['idActividad'];
                //console.log(this.curso);
                //console.log(this.trabajo);
                registrar();
                //   window.location = "adminTrabajo.php";
            } else {
                console.log("No");
            }
        }, elegir(i) {
            console.log(i);
            this.alumno = this.alumnos[i];
            this.elegido = true;
            console.log(this.alumno);
        }, addPart() {
            if (this.elegido == true) {
                addParticipante();
                participantes();
            } else {
                alert('Usted no a elegido un alumno a asignar al trabajo');
            }
        }
        , delPart(idmat) {
            console.log(idmat);
            delateParticipante(idmat);


        }
        , addEnl() {
            addEnlace();
            enlaces();
        }
        , delEnl(idenlace) {
            //  console.log(idmat);
            delateEnlace(idenlace);


        }
    }

});
app.iddoc = idusuario;
app.docente = usuario;
//console.log(usuario);
app.idtrab = getQueryVariable('idtra');
btrabajo();
var f = new Date();
//console.log(app.fecha);
function btrabajo() {
    var request = new XMLHttpRequest();
    var url='../ajax/cTrabajo.php?control=uno&idtrab=' + app.idtrab;
    console.log(url);
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        // console.log("aca estoy");
        console.log(datos);
        app.trabajo = datos[0];
        cursoTrabajo();
        cursosDoc(idusuario);

    }
}
function cursoTrabajo() {
    var request = new XMLHttpRequest();
    let url = '../ajax/verCursosAsignados.php?iddoc=' + app.trabajo['iddocente'] +
            '&idcurso=' + app.trabajo['idcurso'] + '&idgrado=' + app.trabajo['idGrado'] +
            '&idseccion=' + app.trabajo['idseccion'] + '&idanio=' + app.trabajo['idanioescolar'];
    //console.log(url);
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        //console.log(datosApi);
        var datos = JSON.parse(datosApi); // convert it to an object
        // console.log("aca estoy");
        console.log(datos);
        app.curso = datos[0];
    }
}
function cursosDoc(id) {
    var request = new XMLHttpRequest();
    var url='../ajax/verCursosAsignados.php?id=' + id;
    console.log(url);
    request.open('GET', url );
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        // console.log("aca estoy");
        // console.log(datos);
        app.cursos = datos;
        //app.curso = datos[0];
        app.cursoE = datos[0];
        alumnosMat();
        participantes();
       enlaces();

    }
}
function alumnosMat() {
    var request = new XMLHttpRequest();
    request.open('GET', '../ajax/cAlumnos.php?control=busq&busq=' + app.busqueda + '&idgrado=' + app.cursoE['idGrado'] + '&idsecc=' + app.cursoE['idSeccion'] + '&idanio=' + app.cursoE['idAnioEscolar']);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        //  console.log(datosApi);
        var datos = JSON.parse(datosApi); // convert it to an object
        //   console.log("aca estoy");
        //  console.log(datos);
        app.alumnos = datos;



    }
}
function participantes() {
    var request = new XMLHttpRequest();
    request.open('GET', '../ajax/cTrabajo.php?control=part&idtrab=' + app.idtrab);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        //  console.log(datosApi);
        var datos = JSON.parse(datosApi); // convert it to an object
        // console.log("aca estoy");
        console.log(datos);
        app.participantes = datos;
    }
}
function enlaces() {
    var request = new XMLHttpRequest();
    request.open('GET', '../ajax/cTrabajo.php?control=Enlace&idtrab=' + app.idtrab);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        //   console.log(datosApi);
        var datos = JSON.parse(datosApi); // convert it to an object
        // console.log("aca estoy");
        console.log(datos);
        app.enlaces = datos;
    }
}
function registrar()
{
    var paqueteDeDatos = new FormData();
    if (app.archivo != null) {
        paqueteDeDatos.append('archivo', $('#file')[0].files[0]);
    }
    paqueteDeDatos.append('control', app.estado);
    paqueteDeDatos.append('trabajo', JSON.stringify(app.trabajo));
    paqueteDeDatos.append('varchivo', app.archivo);
    $.ajax({
        url: '../ajax/cTrabajo.php',
        type: 'POST',
        contentType: false,
        dataType: 'html',
        data: paqueteDeDatos,
        processData: false,
        cache: false,
    })
            .done(function (respuesta) {
                console.log(respuesta);
                alert("TRABAJO MODIFICADO CORRECTAMENTE");
                //window.location = "adminTrabajo.php?idtra="+respuesta;
            })
            .fail(function () {
                console.log("error");
            });

}
function addParticipante()
{
    var paqueteDeDatos = new FormData();
    paqueteDeDatos.append('control', 'addpart');
    paqueteDeDatos.append('idmat', app.alumno['idMatricula']);
    paqueteDeDatos.append('idtrab', app.idtrab);
    $.ajax({
        url: '../ajax/cTrabajo.php',
        type: 'POST',
        contentType: false,
        dataType: 'html',
        data: paqueteDeDatos,
        processData: false,
        cache: false,
    })
            .done(function (respuesta) {
                // console.log(respuesta);
                // alert(respuesta);
            })
            .fail(function () {
                console.log("error");
            });

}
function delateParticipante(idMat)
{
    var paqueteDeDatos = new FormData();
    paqueteDeDatos.append('control', 'delPart');
    paqueteDeDatos.append('idtrab', app.idtrab);
    paqueteDeDatos.append('idmat', idMat);
    $.ajax({
        url: '../ajax/cTrabajo.php',
        type: 'POST',
        contentType: false,
        dataType: 'html',
        data: paqueteDeDatos,
        processData: false,
        cache: false,
    })
            .done(function (respuesta) {
                console.log(respuesta);
                // alert(respuesta);
                participantes();
            })
            .fail(function () {
                console.log("error");
            });

}
function delateEnlace(idenlace)
{
    var paqueteDeDatos = new FormData();
    paqueteDeDatos.append('control', 'delEnlace');
    paqueteDeDatos.append('idtrab', app.idtrab);
    paqueteDeDatos.append('idenlace', idenlace);
    $.ajax({
        url: '../ajax/cTrabajo.php',
        type: 'POST',
        contentType: false,
        dataType: 'html',
        data: paqueteDeDatos,
        processData: false,
        cache: false,
    })
            .done(function (respuesta) {
                console.log(respuesta);
                // alert(respuesta);
                enlaces();
            })
            .fail(function () {
                console.log("error");
            });

}
function addEnlace()
{
    if (app.descrenlace != '' && app.enlace != '') {
        var paqueteDeDatos = new FormData();
        paqueteDeDatos.append('control', 'addEnlace');
        paqueteDeDatos.append('idtrab', app.idtrab);
        paqueteDeDatos.append('descrEnlace', app.descrenlace);
        paqueteDeDatos.append('enlace', app.enlace);
        $.ajax({
            url: '../ajax/cTrabajo.php',
            type: 'POST',
            contentType: false,
            dataType: 'html',
            data: paqueteDeDatos,
            processData: false,
            cache: false,
        })
                .done(function (respuesta) {
                    console.log(respuesta);
                    // alert(respuesta);
                    enlaces();
                    app.descrenlace = '';
                    app.enlace = '';
                })
                .fail(function () {
                    console.log("error");
                });
    } else {
        alert("POR FAVOR LLENE LAS LOS CAMPOS DEL ENLASE QUE DESEE AGREGAR");
    }
}
