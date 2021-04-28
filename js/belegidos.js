
var idanio = anio.value;
var idgrado = grado.value;
var idsecc = secc.value;

$(buscar_datos("", idanio, idgrado, idsecc));

function buscar_datos(consulta,anio,grado,secc){
	$.ajax({
		url: './busqueda/buscarElegido1.php' ,
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

var idanio2 = anio2.value;
var idgrado2 = grado2.value;
var idsecc2 = secc2.value;

$(buscar_datos2("", idanio2, idgrado2, idsecc2));

function buscar_datos2(consulta,anio,grado,secc){
	$.ajax({
		url: './busqueda/buscarElegido1.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta,anio: anio,grado: grado,secc: secc,}
	})
	.done(function(respuesta){
		$("#datos2").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}


$(document).on('keyup','#caja_busqueda2', function(){
	var valor = $(this).val();
var idanio = anio2.value;
var idgrado = grado2.value;
	var idsecc = secc2.value;
	if (valor != "") {
		console.log(valor+"-"+idanio+"-"+idgrado+"-"+idsecc)
		buscar_datos2(valor, idanio, idgrado, idsecc);

	}else{
		buscar_datos2("", idanio, idgrado, idsecc);
	}
});
function buscar2(e) { // 1
var valor = caja_busqueda2.value;
var idanio = anio2.value;
var idgrado = grado2.value;
	var idsecc = secc2.value;
	if (valor != "") {
		console.log(valor+"-"+idanio+"-"+idgrado+"-"+idsecc)
		buscar_datos2(valor, idanio, idgrado, idsecc);

	}else{console.log(valor+"-"+idanio+"-"+idgrado+"-"+idsecc)
		buscar_datos2("", idanio, idgrado, idsecc);
	}
}