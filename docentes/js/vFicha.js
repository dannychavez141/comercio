
var app = new Vue({
    el: '#registro',
    data: {idalu: 1,
        iddoc: '',
        docente: '',
        fecha: '',
        cursos: [],
        curso: [],
        chktodos: true,
        fichas:[],
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
        console.log(datos);
        app.cursos = datos;
        app.curso = datos[0];
        fichasDoc();
    }
}
function fichasDoc() {
    //app.chktodos=!app.chktodos;
    var id= cmbCurso.value;
    if(id==-1){
        app.curso['idCursos']=id;
    }
    console.log("codigo de curso:"+id);
    var url='../ajax/cFicha.php?control=all&iddoc='+app.iddoc+'&idcur='+app.curso['idCursos']+'&fec='+app.fecha+'&chek='+app.chktodos;
    console.log(url);
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        console.log(datos);
        app.fichas = datos;
    }
}
function fichasDocChk() {
    app.chktodos=!app.chktodos;
    var id= cmbCurso.value;
    if(id==-1){
        app.curso['idCursos']=id;
    }
    console.log("codigo de curso:"+id);
    var url='../ajax/cFicha.php?control=all&iddoc='+app.iddoc+'&idcur='+app.curso['idCursos']+'&fec='+app.fecha+'&chek='+app.chktodos;
    console.log(url);
    var request = new XMLHttpRequest();
    request.open('GET', url);
    request.responseType = 'text'; // now we're getting a string!
    request.send();
    request.onload = function () {
        var datosApi = request.response;
        var datos = JSON.parse(datosApi); // convert it to an object
        console.log(datos);
        app.fichas = datos;
    }
}


