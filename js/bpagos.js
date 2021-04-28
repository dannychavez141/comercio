
var idanio = anio.value;
var idgrado = grado.value;
var idsecc = secc.value;
var fech= fecha.value;
var estado= est.value;
var tip = tipo.value;
var tipcomp = tcomp.value;
console.log(""+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado+"+"+tipcomp)
$(buscar_datos("",fech,tip, idanio, idgrado, idsecc,estado,tipcomp));

function buscar_datos(consulta,fecha,tipo,anio,grado,secc,estado,tipcomp){
	$.ajax({
		url: './busqueda/buscarPagos.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta,anio: anio,grado: grado,secc: secc,fecha: fecha,tipo: tipo,estado: estado,tipcomp: tipcomp}
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
var tipcomp = tcomp.value;
	if (valor != "") {
		console.log(valor+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado+"+"+tipcomp)
		buscar_datos(valor,fech,tip, idanio, idgrado, idsecc,estado,tipcomp);

	}else{console.log("valor"+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado+"+"+tipcomp)
		buscar_datos(valor,fech,tip, idanio, idgrado, idsecc,estado,tipcomp);
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
var tipcomp = tcomp.value;
	if (valor != "") {
		console.log(valor+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado+"+"+tipcomp)
		buscar_datos(valor,fech,tip, idanio, idgrado, idsecc,estado,tipcomp);

	}else{console.log(valor+"-"+fech+"-"+tip+"-"+idanio+"-"+idgrado+"-"+idsecc+"+"+estado+"+"+tipcomp)
		buscar_datos("",fech,tip, idanio, idgrado, idsecc,estado,tipcomp);
	}
}