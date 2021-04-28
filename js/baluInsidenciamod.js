
var mat = idmat.value;

$(buscar_datos("", mat));

function buscar_datos(consulta,idmat){
	$.ajax({
		url: './busqueda/buscarIncidencia.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta,idmat: idmat}
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
var mat = idmat.value;

	if (valor != "") {
		
		buscar_datos(valor, mat);

	}else{
		buscar_datos("", mat);
	}
});
function buscar(e) { // 1
var valor = caja_busqueda.value;
var mat = idmat.value;

	if (valor != "") {
		
		buscar_datos(valor, mat);

	}else{
		buscar_datos("", mat);
	}
}