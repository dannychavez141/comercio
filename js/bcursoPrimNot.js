
var idanio = anio.value;
var idgrado = grado.value;
var idsecc = secc.value;
var idperi = peri.value;

$(buscar_datos("", idanio, idgrado, idsecc,idperi,idtipo));

function buscar_datos(consulta,anio,grado,secc,peri,tipo){
	$.ajax({
		url: './busqueda/buscarCursoNot.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta,anio: anio,grado: grado,secc: secc,peri: peri,tipo: tipo}
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}


$(document).on('keyup','#caja_busqueda', function(){
	var valor = $(this).val();
var idanio = anio.value;
var idgrado = grado.value;
	var idsecc = secc.value;
	var idperi = peri.value;
	if (valor != "") {
		console.log(valor+"-"+idanio+"-"+idgrado+"-"+idsecc+"-"+idtipo)
		buscar_datos(valor, idanio, idgrado, idsecc,idperi,idtipo);

	}else{
		buscar_datos("", idanio, idgrado, idsecc,idperi,idtipo);
	}
});
function buscar(e) { // 1
var valor = caja_busqueda.value;
var idanio = anio.value;
var idgrado = grado.value;
var idsecc = secc.value;
var idperi = peri.value;
	if (valor != "") {
		console.log(valor+"-"+idanio+"-"+idgrado+"-"+idsecc+"-"+idtipo)
		buscar_datos(valor, idanio, idgrado, idsecc,idperi,idtipo);

	}else{console.log(valor+"-"+idanio+"-"+idgrado+"-"+idsecc+"-"+idtipo)
		buscar_datos("", idanio, idgrado, idsecc,idperi,idtipo);
	}
	//alert("Seleccion Correcta, elija el curso que desea subir notas");
}