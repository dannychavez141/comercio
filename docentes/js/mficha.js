
var app = new Vue({
    el: '#registro',
    data: {idFicha: '',
        ficha: [],
        docente: '',
        salon: '',
        fecha: '',
        sesion: '',
        semana: '',
        competencias: [],
        competencia: [],
        limpio: [],
        alumnos: [],
        estado: 'm'
    }

});
app.idFicha = getQueryVariable('id');
console.log(app.idFicha);
datosFicha(app.idFicha);
function datosFicha(id) {
    var url = '../ajax/cFicha.php?control=uno&id=' + id;
    console.log(url);
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
       // console.log("aca estoy");
      //  console.log(datos);
        app.ficha = datos;
        app.docente = app.ficha['apepa'] + ' ' + app.ficha['apema'] + ' ' + app.ficha['nomb'];
        app.salon = app.ficha['grado'] + ' ' + app.ficha['seccion'] + ' ' + app.ficha['nivel'];
        competenciCurso(app.idFicha);
        alumnosClase(app.ficha['idGrado'], app.ficha['idSeccion'], app.ficha['idAnioEscolar']);

    }
}

function competenciCurso(id) {
    var url = '../ajax/cCompetencia.php?control=uno&idficha=' + id;
   // console.log(url);
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        //console.log(datos);
        app.competencias = datos;



    }

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
        var datos = JSON.parse(datosApi); // convert it to an object
        //console.log(datos);
        for (var i = 0; i < datos.length; i++) {
            datos[i]['zoom'] = false;
            datos[i]['class'] = false;
            datos[i]['acti'] = false;
            datos[i]['comAlu'] = false;
            datos[i]['comDoc'] = false;
            datos[i]['whapp'] = false;
            datos[i]['part'] = false;
            datos[i]['txtcomAlu'] = '';
            datos[i]['txtcomDoc'] = '';
        }
        app.alumnos = datos;
        // console.log(app.alumnos)

        buscarAlumnoFicha();
    }

}
function buscarAlumnoFicha() {
    var cantidad = app.alumnos.length;
    //console.log(cantidad);
    for (var i = 0; i < cantidad; i++) {
        //console.log(app.alumnos[i]); 
        buscarAlumno(app.idFicha, app.alumnos[i]['idMatricula'], i);
      ///  console.log(app.alumnos[i]['zoom']);
    }
}
function buscarAlumno(idMat, idFicha, i) {
    var url = '../ajax/cFicha.php?control=b&idmat=' + idMat + '&idficha=' + idFicha;
    // console.log(url);
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
      //  console.log(datos);
        // console.log(datos[0]['zoom']);
        if (datos[0]['zoom'] == 1) {
            app.alumnos[i]['zoom'] = true;
        } else {
            app.alumnos[i]['zoom'] = false;
        }

        if (datos[0]['celular'] == 1) {
            app.alumnos[i]['whapp'] = true;
        } else {
            app.alumnos[i]['whapp'] = false;
        }
        if (datos[0]['classroom'] == 1) {
            app.alumnos[i]['class'] = true;
        } else {
            app.alumnos[i]['class'] = false;
        }
        if (datos[0]['actividad'] == 1) {
            app.alumnos[i]['acti'] = true;
        } else {
            app.alumnos[i]['acti'] = false;
        }
        if (datos[0]['chcmAlu'] == 1) {
            app.alumnos[i]['comAlu'] = true;
        } else {
            app.alumnos[i]['comAlu'] = false;
        }
        if (datos[0]['chcmDoc'] == 1) {
            app.alumnos[i]['comDoc'] = true;
        } else {
            app.alumnos[i]['comDoc'] = false;
        }
        if (datos[0]['participacion'] == 1) {
            app.alumnos[i]['part'] = true;
        } else {
            app.alumnos[i]['part'] = false;
        }
        
 app.alumnos[i]['txtcomAlu'] = datos[0]['cmAlum'];
  app.alumnos[i]['txtcomAlu'] = datos[0]['cmDoc'];

     //   console.log(app.alumnos[i]['zoom']+''+app.alumnos[i]['whapp']+''+app.alumnos[i]['class']+''+app.alumnos[i]['acti']+''+app.alumnos[i]['comAlu']+''+app.alumnos[i]['comDoc']);  
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
    

        $.ajax({
            url: '../ajax/cFicha.php',
            type: 'POST',
            dataType: 'html',
            data: {control: app.estado,
                ficha: JSON.stringify(app.ficha),
                alumnos: JSON.stringify(app.alumnos)
            }
        })
                .done(function (respuesta) {
                   // console.log(respuesta);
                   alert("FICHA MODIFICADA CORRECTAMENTE");
                 window.location = "verFicha.php";
                })
                .fail(function () {
                    console.log("error");
                });
    } 

