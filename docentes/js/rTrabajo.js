
var app = new Vue({
    el: '#registro',
    data: {idalu: 1,
        iddoc: '',
        docente: '',
        fecha: '',
        descripcion: '',
        archivo: null,
        cursos: [],
        curso: [],
        actividades: [],
        actividad: [],
        limpio: [],
        estado: 'r'
    },
    methods: {
        onFileChange() {
            this.archivo = document.getElementById('file').value;
        },
        confirmar() {
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
console.log(usuario);
cursosDoc(idusuario);
apiactividades();
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
       // console.log("aca estoy");
      //  console.log(datos);
        app.cursos = datos;
        app.curso = datos[0];


    }
}
function apiactividades(id) {
    var request = new XMLHttpRequest();
    request.open('GET', '../ajax/cActividad.php?control=all');
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
       // console.log("aca estoy");
      //  console.log(datos);
        app.actividades = datos;
        app.actividad = datos[0];


    }
}
function registrar()
{
    var paqueteDeDatos = new FormData();
    if (app.archivo != null) {
        paqueteDeDatos.append('archivo', $('#file')[0].files[0]);
    }
    paqueteDeDatos.append('control', app.estado);
    paqueteDeDatos.append('curso', JSON.stringify(app.curso));
    paqueteDeDatos.append('fecha', app.fecha);
    paqueteDeDatos.append('descripcion', app.descripcion);
    console.log(app.actividad[0]);
    paqueteDeDatos.append('idActividad', app.actividad[0]);
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
                alert("TRABAJO REGISTRADO CORRECTAMENTE, SE LE REDIRECCIONARA A LA ADMINISTRACION DEL ENLACES Y PARTICIPANTES DEL TRABAJO");
               window.location = "adminTrabajo.php?idtra="+respuesta;
            })
            .fail(function () {
                console.log("error");
            });

}



