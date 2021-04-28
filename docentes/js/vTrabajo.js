
var app = new Vue({
    el: '#registro',
    data: {idalu: 1,
        iddoc: '',
        docente: '',
        fecha: '',
        descripcion: '',
        trabajos: [],
        cursos: [],
        curso: [],
        limpio: [],
        estado: 'all'
    },
    methods: {

        buscar() {
            if (window.confirm("Verifico todos los Datos?")) {
                console.log("Si");
                registrar();
                //   window.location = "adminTrabajo.php";
            } else {
                console.log("No");
            }
        }
    }

});
app.iddoc = idusuario;
app.docente = usuario;
//console.log(usuario);
cursosDoc(idusuario);
var f = new Date();
app.fecha = fcha;
//console.log(app.fecha);

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
        buscarTrabajos();

    }
}

function buscarTrabajos()
{
    var paqueteDeDatos = new FormData();
    paqueteDeDatos.append('control', app.estado);
    paqueteDeDatos.append('curso', JSON.stringify(app.curso));
    paqueteDeDatos.append('descripcion', app.descripcion);
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
                app.trabajos = JSON.parse(respuesta); // convert it to an object
                //  console.log(app.trabajos);

            })
            .fail(function () {
                console.log("error");
            });

}


