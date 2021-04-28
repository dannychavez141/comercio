
var idanio = anio.value;



$(buscar_datos("", idanio, id));

function buscar_datos(consulta,anio,id){
	$.ajax({
		url: './busqueda/buscarNotas.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta,anio: anio,id: id,}
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
		console.log(valor+"-"+idanio+"-"+id)
		buscar_datos(valor, idanio, id);

	}else{
		buscar_datos("", idanio, id);
	}
});
function buscar(e) { // 1
var valor = caja_busqueda.value;
var idanio = anio.value;

	if (valor != "") {
		console.log(valor+"-"+idanio+"-"+id)
		buscar_datos(valor, idanio, id);

	}else{console.log(valor+"-"+idanio+"-"+id)
		buscar_datos("", idanio, id);
	}
}