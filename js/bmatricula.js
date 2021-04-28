
var idanio = anio.value;
var idgrado = grado.value;
var idsecc = secc.value;

$(buscar_datos("", idanio, idgrado, idsecc));

function buscar_datos(consulta,anio,grado,secc){
	$.ajax({
		url: './busqueda/buscarMatricula.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta,anio: anio,grado: grado,secc: secc,}
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
	if (valor != "") {
		console.log(valor+"-"+idanio+"-"+idgrado+"-"+idsecc)
		buscar_datos(valor, idanio, idgrado, idsecc);

	}else{
		buscar_datos("", idanio, idgrado, idsecc);
	}
});
function buscar(e) { // 1
var valor = caja_busqueda.value;
var idanio = anio.value;
var idgrado = grado.value;
	var idsecc = secc.value;
	if (valor != "") {
		console.log(valor+"-"+idanio+"-"+idgrado+"-"+idsecc)
		buscar_datos(valor, idanio, idgrado, idsecc);

	}else{console.log(valor+"-"+idanio+"-"+idgrado+"-"+idsecc)
		buscar_datos("", idanio, idgrado, idsecc);
	}
}