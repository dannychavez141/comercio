var matricula = new Vue({
    el: '#detallemod',
    data: {
        idmat: "",
        dnialu: "",
        alumno: "",
        dniapo: "",
        apo: "",
        fecha: "",
        telefono: "",
        grado: "",
        direccion: "",
        usuario: "",
        estado: ""

    }

});

function detalles(idmat) {
    console.log(idmat);
    var url = './modelo/ajaxmatricula.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: 'idmat=' + idmat,
        success: function (datos_matricula) {

            var datos = eval(datos_matricula);
            matricula.idmat = datos[0];
            matricula.dnialu = datos[1];
            matricula.alumno = datos[2];
            matricula.dniapo = datos[3];
            matricula.apo = datos[4];
            
            matricula.fecha = datos[6];
            matricula.grado = datos[5];
            matricula.telefono = datos[8];
            matricula.direccion = datos[7];
            matricula.usuario = datos[9];
            matricula.estado = datos[10];
        }
    });
    return false;
}

