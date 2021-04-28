
var idanio = anio.value;
var idmes = mes.value;
var dni = dnialu.value;


$(buscar_datos(dni, idmes,idanio));

function buscar_datos(dni,mes,anio){
	$.ajax({
		url: './busqueda/buscarAsistencias.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {dni: dni,anio: anio,mes: mes}
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}

function buscar(e) { // 1
var idanio = anio.value;
var idmes = mes.value;
var dni = dnialu.value;
console.log(dni+"-"+idanio+"-"+idmes)
buscar_datos(dni, idmes,idanio);
	
}