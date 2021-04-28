
var idperi = peri.value;

$(buscar_datos("",idperi));

function buscar_datos(consulta,peri){
	$.ajax({
		url: './busqueda/buscarCursos.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta,peri: peri}
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
 
	var idperi = peri.value;
	if (valor != "") {
		console.log(valor+"-"+idperi)
		buscar_datos(valor,idperi);

	}else{
		buscar_datos("", idperi);
	}
});
function buscar(e) { // 1
var valor = caja_busqueda.value;
var idperi = peri.value;
	if (valor != "") {
		console.log(valor+"-"+idperi)
		buscar_datos(valor, idperi);

	}else{console.log(valor+"-"+idperi)
		buscar_datos("",idperi)
	}
	alert("Seleccion Correcta, elija el curso que desea subir notas");
}