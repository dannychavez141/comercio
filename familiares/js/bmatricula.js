
var idanio = anio.value;


$(buscar_datos("", idanio));

function buscar_datos(consulta,anio){
	$.ajax({
		url: './busqueda/buscarmatricula.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta,anio: anio}
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

	if (valor != "") {
		console.log(valor+"-"+idanio)
		buscar_datos(valor, idanio);

	}else{
		buscar_datos("", idanio);
	}
});
function buscar(e) { // 1
var valor = caja_busqueda.value;
var idanio = anio.value;

	if (valor != "") {
		console.log(valor+"-"+idanio)
		buscar_datos(valor, idanio);

	}else{console.log(valor+"-"+idanio)
		buscar_datos("", idanio);
	}
}