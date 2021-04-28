function cargarCursos(anio )
{
   $.ajax({
		url: './busqueda/cargarCursos.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {idanio: anio}
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	}); 
}
function cargarGrados(anio)
{
  $.ajax({
		url: './busqueda/cargarGrados.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {idanio: anio},
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});  
}
function cargarAsignaciones(iddoc)
{
  $.ajax({
		url: './busqueda/cargarAsignaciones.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {iddoc: iddoc},
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});  
}
function Agregar(iddoc)
{
  $.ajax({
		url: './busqueda/agregarAsignaciones.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {iddoc: iddoc},
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});  
}
function Eliminar(idanio,iddoc,idgrado,idseccion)
{
  $.ajax({
		url: './busqueda/eliminarAsignaciones.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {iddoc: iddoc},
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});  
}

