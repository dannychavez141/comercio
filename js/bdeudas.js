
var idanio = anio.value;
var idgrado = grado.value;
var idsecc = secc.value;
var fech= fecha.value;
var estado= est.value;
var tip = tipo.value;
console.log(""+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado)
$(buscar_datos("",fech,tip, idanio, idgrado, idsecc,estado));

function buscar_datos(consulta,fecha,tipo,anio,grado,secc,estado){
	$.ajax({
		url: './busqueda/buscarDeudas.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta,anio: anio,grado: grado,secc: secc,fecha: fecha,tipo: tipo,estado: estado}
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
	var fech= fecha.value;
var tip = tipo.value;
var estado= est.value;
	if (valor != "") {
		console.log(valor+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado)
		buscar_datos(valor,fech,tip, idanio, idgrado, idsecc,estado);

	}else{console.log("valor"+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado)
		buscar_datos("",fech,tip, idanio, idgrado, idsecc,estado);
	}
});
function buscar(e) { // 1
var valor = caja_busqueda.value;
var idanio = anio.value;
var idgrado = grado.value;
var idsecc = secc.value;
var fech= fecha.value;
var tip = tipo.value;
var estado= est.value;
	if (valor != "") {
		console.log(valor+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado)
		buscar_datos(valor,fech,tip, idanio, idgrado, idsecc,estado);

	}else{console.log(valor+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado)
		buscar_datos("",fech,tip, idanio, idgrado, idsecc,estado);
	}
}