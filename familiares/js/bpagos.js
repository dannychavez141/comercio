
var idanio = anio.value;
var idmes = mes.value;
var dni = dnialu.value;
var dniapo = id;
console.log(dni+"-"+idanio+"-"+idmes+"-"+dniapo)
$(buscar_datos(dni, idmes,idanio,dniapo));

function buscar_datos(dni,mes,anio,dniapo){
	$.ajax({
		url: './busqueda/buscarPagos.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {dni: dni,anio: anio,mes: mes,dniapo: dniapo}
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
var dniapo = id;
console.log(dni+"-"+idanio+"-"+idmes+"-"+dniapo)
buscar_datos(dni, idmes,idanio,dniapo);
	
}