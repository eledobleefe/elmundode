

// USUARIO

$(document).on("submit", "#formRegistrar", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		nombreUsuario: $("input[name ='nombreUsuario']", form).val(),
		apellidosUsuario: $("input[name='apellidosUsuario']", form).val(),
		email: $("input[type ='email']", form).val(),
		pass: $("input[type='password']", form).val(),
		rol: $("input[name ='rol']", form).val(),
	};
	
	$("#msgErrorRegistro").hide();
	var url_php = 'back/usuario_registrar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			$("#msgErrorRegistro").text(respuesta.error).show();
			$("#confirmPass").hide();
			//form[0].reset();
			return false;
		}
		if(respuesta.redireccion !== undefined){
			window.location = respuesta.redireccion;
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});

$(document).on("submit", "#formIniciarSesion", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		email: $("input[type ='email']",form).val(),
		pass: $("input[type='password']", form).val()
	}
	
	$("#msgErrorSesion").hide();
	var url_php = 'back/usuario_iniciarSesion.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		  if(respuesta.error !== undefined) {
			  $("#msgErrorSesion").text(respuesta.error).show();
			  return false;
		  }
		if(respuesta.redireccion !== undefined){
			window.location = respuesta.redireccion;
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});

$(document).on("submit", "#entrarMundo", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		email: $("input[type ='email']",form).val(),
		pass: $("input[type='password']", form).val()
	}
	
	$("#msgErrorVisitar").hide();
	var url_php = 'back/usuario_iniciarSesionVisitar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		  if(respuesta.error !== undefined) {
			  $("#msgErrorVisitar").text(respuesta.error).show();
			  return false;
		  }
		if(respuesta.redireccion !== undefined){
			window.location = respuesta.redireccion;
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});



// BEBE

function obtenerDatosBebe(idBebe){
	event.preventDefault();

	url_php = "back/bebe_obtenerDatos.php";

		$.ajax({
			type:"POST",
			data: "idBebe=" + idBebe,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				  swal("Lo sentimos", "Disculpa, ha surgido un error", "error");
				  return false;
			  }
			if(respuesta.redireccion !== undefined){
				window.location = respuesta.redireccion;
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}

function eliminarBebe(idBebe){
	event.preventDefault();

	url_php = "back/bebe_eliminar.php";

		$.ajax({
			type:"POST",
			data: "idBebe=" + idBebe,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("Lo sentimos", "Disculpa, ha surgido un error", "error");
				  return false;
			  }
			if(respuesta.eliminado !== undefined){
				swal("¡Genial!", "Se ha eliminado con éxito este bebé", "success",{
					buttons: {
						btn1: "Ok",
					},
				})
				.then((value) => {
					if(value = "btn1"){
						window.location.reload();
					}
				});
				
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}

function verMundoBebe(idBebe){
	event.preventDefault();

	url_php = "back/bebe_verMundo.php";

		$.ajax({
			type:"POST",
			data: "idBebe=" + idBebe,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("Lo sentimos", "Disculpa, ha surgido un error", "error");
				  return false;
			  }
			if(respuesta.redireccion !== undefined){
				window.location = respuesta.redireccion;
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}

function subirImagenBebe(imgNacimiento) {
	var form = $('#formBebe');
	var carpeta = "bebe";
	var infoForm = {imgNacimiento, carpeta};
	var url_php = 'back/subirImagenBebe.php';

	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		  if(respuesta.error !== undefined) {
			  swal("¡Vaya!", respuesta.error, "error");
			  return false;
		  }
		if(respuesta.subura !== undefined){
			swal("¡Genial!", respuesta.subida, "success");
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
}


function guardarBebe(){
	event.preventDefault();
	var form = $('#formBebe');
	var infoForm = {
		nombreBebe: $("input[name ='nombreBebe']",form).val(),
		apellidosBebe: $("input[name='apellidosBebe']", form).val(),
		fechaNacimiento: $("input[name ='fechaNacimiento']",form).val(),
		horaNacimiento: $("input[name='horaNacimiento']", form).val(),
		lugarNacimiento: $("input[name ='lugarNacimiento']",form).val(),
		ciudadNacimiento: $("input[name='ciudadNacimiento']", form).val(),
		grupoSanguineo: $("select[name ='grupoSanguineo']",form).val(),
		//imgNacimiento: $("input[name='imgNacimiento']", form).val(),
		dedicatoriaBebe: $("#dedicatoriaBebe",form).val()
	}

	var url_php = 'back/bebe_guardar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		  if(respuesta.error !== undefined) {
			  $("#msgErrorBebe").text(respuesta.error).removeAttr('style');
			  return false;
		  }
		if(respuesta.redireccion !== undefined){
			var imgNacimiento = $("input[type='file']", form).val();
			if (imgNacimiento.length > 0 ){
				subirImagenBebe(imgNacimiento);
			}
			//window.location = respuesta.redireccion;
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
	
}

function editarBebe($idBebe){
	event.preventDefault();
	var form = $('#formBebe');
	var infoForm = {
		idBebe: $idBebe,
		nombreBebe: $("input[name ='nombreBebe']",form).val(),
		apellidosBebe: $("input[name='apellidosBebe']", form).val(),
		fechaNacimiento: $("input[name ='fechaNacimiento']",form).val(),
		horaNacimiento: $("input[name='horaNacimiento']", form).val(),
		lugarNacimiento: $("input[name ='lugarNacimiento']",form).val(),
		ciudadNacimiento: $("input[name='ciudadNacimiento']", form).val(),
		grupoSanguineo: $("select[name ='grupoSanguineo']",form).val(),
		imgNacimiento: $("input[name='imgNacimiento']", form).val(),
		dedicatoriaBebe: $("#dedicatoriaBebe",form).val(),
	}
	
	$("#msgErrorBebe").hide();
	var url_php = 'back/bebe_editar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		  if(respuesta.error !== undefined) {
			  $("#msgErrorBebe").text(respuesta.error).show();
			  return false;
		  }
		if(respuesta.editado == true){
			swal("¡Bebé editado", "¿Ahora qué quieres hacer? Puedes volver a ver todos tus mundos, editar los progenitores o cerrar la sesión.", "success", {
				buttons: {
				  btn1: "Ver mis mundos",
				  btn2: "Editar progenitores",
				  btn3: "Cerrar sesión"
				},
			  })
			  .then((value) => {
				switch (value) {
			   
					case "btn1":
						window.location = "crear.php";
						break;
				
					case "btn2":
						window.location = respuesta.redireccion;
						break;

					case "btn3":
						window.location = "logout.php";
						break;
			   
				}
			  });
		}
			
	})

	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
		
	
}


// PROGENITOR

function eliminarProgenitor(idProgenitor){
	event.preventDefault();

	url_php = "back/progenitor_eliminar.php";

		$.ajax({
			type:"POST",
			data: "idProgenitor=" + idProgenitor,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("Lo sentimos", "Disculpa, ha surgido un error", "error");
				  return false;
			  }
			if(respuesta.eliminado !== undefined){
				swal("¡Genial!", "Se ha eliminado con éxito este progenitor. ¿Ahora qué quieres hacer?", "success",{
					buttons: {
						btn1: "Editar progenitores",
						btn2: "Editar embarazo",
					},
				})
				.then((value) => {
					if(value = "btn1"){
						window.location.reload();
					} else {
						window.location = respuesta.redireccion;
					}
				});
				
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}


$(document).on("submit", "#formEditarProgenitor", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		idProgenitor: $("#idProgenitorEditado", form).val(),
		nombreProgenitor: $("input[name ='nombreProgenitor']", form).val(),
		apellidosProgenitor: $("input[name='apellidosProgenitor']", form).val(),
		tipoProgenitor: $("#tipoProgenitorEditado", form).val(),
		fechaNProgenitor: $("input[type='date']", form).val(),
		lugarNProgenitor: $("input[name ='lugarNProgenitor']", form).val(),
		descripcionProgenitor: $("#descripcionProgenitorEditado", form).val(),
		imgProgenitor: $("input[name='imgProgenitor']", form).val(),
	};
	
	$("#msgErrorRegistro").hide();
	var url_php = 'back/progenitor_editar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			$("#msgErrorProgenitorModal").text(respuesta.error).show();
			//form[0].reset();
			return false;
		}
		if(respuesta.editado == true){
			swal("¡Genial!", "El progenitor se ha actualizado", "success",{
				buttons: {
					btn1: "Ok",
				},
			})
			.then((value) => {
				if(value = "btn1"){
					$("#actualizarProgenitor").hide();
					window.location.reload();
				}
			});
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});


$(document).on("submit", "#formProgenitor", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		nombreProgenitor: $("input[name ='nombreProgenitor']", form).val(),
		apellidosProgenitor: $("input[name='apellidosProgenitor']", form).val(),
		tipoProgenitor: $("#tipoProgenitor", form).val(),
		fechaNProgenitor: $("input[type='date']", form).val(),
		lugarNProgenitor: $("input[name ='lugarNProgenitor']", form).val(),
		descripcionProgenitor: $("#descripcionProgenitor", form).val(),
		imgProgenitor: $("input[name='imgProgenitor']", form).val(),
	};
	
	$("#msgErrorProgenitor").hide();
	var url_php = 'back/progenitor_guardar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			$("#msgErrorProgenitor").text(respuesta.error).show();
			//form[0].reset();
			return false;
		}
		//Mostrar el li en la lista que hay que visualizar
		if(respuesta.guardado == true){
			swal("¡Progenitor guardado", "¿Ahora qué quieres hacer? Seguir en progenitores, pasar al formulario de embarazo o cerrar sesión", "success", {
				buttons: {
				  btn1: "Editar progenitores",
				  btn2: "Editar embarazo",
				  btn3: "Cerrar sesión"
				},
			  })
			  .then((value) => {
				switch (value) {
			   
					case "btn1":
						window.location = "crear_progenitores.php";
						break;
				
					case "btn2":
						window.location = respuesta.redireccion;
						break;

					case "btn3":
						window.location = "logout.php";
						break;
			   
				}
			  });

		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});


function mostrarProgenitorEditado(idProgenitor){
	event.preventDefault();

	url_php = "back/progenitor_obtenerDatos.php";

		$.ajax({
			type:"POST",
			data: "idProgenitor=" + idProgenitor,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("Lo sentimos", "Disculpa, ha surgido un error", "error");
				  return false;
			  }
			if(respuesta.encontrado == true){
				$('#idProgenitorEditado').val(respuesta.idProgenitor);
				$('#nombreProgenitorEditado').val(respuesta.nombreProgenitor);
				$('#apellidosProgenitorEditado').val(respuesta.apellidosProgenitor);
				$('#fechaNProgenitorEditado').val(respuesta.fechaNProgenitor);
				$('#lugarNProgenitorEditado').val(respuesta.lugarNProgenitor);
				$('#tipoProgenitorEditado').val(respuesta.tipoProgenitor);
				$('#descripcionProgenitorEditado').val(respuesta.descripcionProgenitor);
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}



// EMBARAZO

$(document).on("submit", "#formEmbarazo", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		semanasEmbarazo: $("input[name ='semanasEmbarazo']", form).val(),
		diasEmbarazo: $("input[name='diasEmbarazo']", form).val(),
		kgAumento: $("input[name ='kgAumento']", form).val(),
		fechaNoticia: $("input[name='fechaNoticia']", form).val(),
	};
	
	var url_php = 'back/embarazo_guardar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			swal("¡Vaya!", respuesta.error, "error");
			return false;
		}

		if(respuesta.guardado !== undefined){
			swal("¡Genial!", "Embarazo guardado", "success",{
				buttons: {
					btn1: "ok",
				},
			})
			.then((value) => {
				if(value = "btn1"){
					window.location.reload();
				}
			});
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});

function eliminarEmbarazo(idProgenitor){
	event.preventDefault();

	url_php = "back/embarazo_eliminar.php";

		$.ajax({
			type:"POST",
			data: "idProgenitor=" + idProgenitor,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			if(respuesta.error !== undefined) {
				swal("¡Vaya!", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.eliminado !== undefined){
				swal("¡Genial!", respuesta.eliminado, "success",{
					btn1: 'Ok',
				})
				.then((value) => {
					if(value = "btn1"){
						window.location.reload();
					}
				})
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}

function editarEmbarazo(idProgenitor){
	event.preventDefault();

	url_php = "back/embarazo_editar.php";
	var infoForm = {
		semanasEmbarazo: $("input[name ='semanasEmbarazo']").val(),
		diasEmbarazo: $("input[name='diasEmbarazo']").val(),
		kgAumento: $("input[name ='kgAumento']").val(),
		fechaNoticia: $("input[name='fechaNoticia']").val(),
		idProgenitor: $("input[name='idProgenitor']").val(),
	};
	

		$.ajax({
			type:"POST",
			data: infoForm,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			if(respuesta.error !== undefined) {
				swal("¡Vaya!", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.editado !== undefined){
				swal("¡Genial!", respuesta.editado, "success",{
					btn1: 'Ok',
				})
				.then((value) => {
					if(value = "btn1"){
						window.location.reload();
					}
				})
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}


// CRECIMIENTO

$(document).on("submit", "#formCrecimiento", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		fechaDatos: $("input[type ='date']", form).val(),
		altura: $("input[name='altura']", form).val(),
		peso: $("input[name ='peso']", form).val(),
		cabeza: $("input[name='cabeza']", form).val(),
	};
	
	var url_php = 'back/crecimiento_guardar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			swal("¡Vaya!", respuesta.error, "error");
			return false;
		}
		//Mostrar el li en la lista que hay que visualizar
		if(respuesta.guardado == true){
			swal("¡Genial", "Datos guardados.", "success", {
				buttons: {
				  btn1: "Ok",
				},
			  })
			  .then((value) => {
				if ('btn1') {
					window.location = 'crear_crecimiento.php';
				}
			  });

		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});


function mostrarCrecimientoEditado(idCrecimiento){
	event.preventDefault();

	url_php = "back/crecimiento_obtenerDatos.php";



		$.ajax({
			type:"POST",
			data: "idCrecimiento=" + idCrecimiento,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("¡Vaya!", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.encontrado == true){
				$('#idCrecimientoEditado').val(respuesta.idCrecimiento);
				$('#fechaDatosEditado').val(respuesta.fechaDatos);
				$('#alturaEditado').val(respuesta.altura);
				$('#pesoEditado').val(respuesta.peso);
				$('#cabezaEditado').val(respuesta.cabeza);
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}


$(document).on("submit", "#formEditarCrecimiento", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		idCrecimiento: $("#idCrecimientoEditado", form).val(),
		fechaDatos: $("input[type ='date']", form).val(),
		altura: $("input[name='altura']", form).val(),
		peso: $("input[name ='peso']", form).val(),
		cabeza: $("input[name='cabeza']", form).val(),
	};
	
	$("#msgErrorCrecimientoModal").hide();
	var url_php = 'back/crecimiento_editar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			$("#msgErrorCrecimientoModal").text(respuesta.error).show();
			//form[0].reset();
			return false;
		}
		if(respuesta.editado !== undefined){
			swal("¡Genial!", respuesta.editado, "success",{
				buttons: {
					btn1: "Ok",
				},
			})
			.then((value) => {
				if(value = "btn1"){
					$("#actualizarCrecimiento").hide();
					window.location.reload();
				}
			});
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});


function eliminarCrecimiento(idCrecimiento){
	event.preventDefault();

	url_php = "back/crecimiento_eliminar.php";

		$.ajax({
			type:"POST",
			data: "idCrecimiento=" + idCrecimiento,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("Lo sentimos", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.eliminado !== undefined){
				swal("¡Genial!", respuesta.eliminado, "success", {
					btn1: 'Ok',
				})
				.then((value) => {
					if(value = "btn1"){
						window.location.reload();
					}
				})
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}


// DENTADURA

$(document).on("submit", "#formDentadura", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		fechaDiente: $("input[type ='date']", form).val(),
		ordenDiente: $("select[name='ordenDiente']", form).val(),
		nombreDiente: $("select[name ='nombreDiente']", form).val(),
	};
	
	var url_php = 'back/dentadura_guardar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			swal("¡Vaya!", respuesta.error, "error");
			return false;
		}
		//Mostrar el li en la lista que hay que visualizar
		if(respuesta.guardado == true){
			swal("¡Genial", "Datos guardados.", "success", {
				buttons: {
				  btn1: "Ok",
				},
			  })
			  .then((value) => {
				if ('btn1') {
					window.location = 'crear_dentadura.php';
				}
			  });

		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});


function mostrarDentaduraEditado(idDentadura){
	event.preventDefault();

	url_php = "back/dentadura_obtenerDatos.php";



		$.ajax({
			type:"POST",
			data: "idDentadura=" + idDentadura,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("¡Vaya!", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.encontrado == true){
				$('#idDentaduraEditado').val(respuesta.idDentadura);
				$('#fechaDienteEditado').val(respuesta.fechaDiente);
				$('#ordenDienteEditado').val(respuesta.ordenDiente);
				$('#nombreDienteEditado').val(respuesta.nombreDiente);
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}


$(document).on("submit", "#formEditarDentadura", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		idDentadura: $("#idDentaduraEditado", form).val(),
		fechaDiente: $("input[type ='date']", form).val(),
		ordenDiente: $("select[name='ordenDiente']", form).val(),
		nombreDiente: $("select[name ='nombreDiente']", form).val(),
	};
	
	$("#msgErrorDentaduraModal").hide();
	var url_php = 'back/dentadura_editar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			$("#msgErrorDentaduraModal").text(respuesta.error).show();
			//form[0].reset();
			return false;
		}
		if(respuesta.editado !== undefined){
			swal("¡Genial!", respuesta.editado, "success",{
				buttons: {
					btn1: "Ok",
				},
			})
			.then((value) => {
				if(value = "btn1"){
					$("#actualizarDentadura").hide();
					window.location.reload();
				}
			});
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});


function eliminarDentadura(idDentadura){
	event.preventDefault();

	url_php = "back/dentadura_eliminar.php";

		$.ajax({
			type:"POST",
			data: "idDentadura=" + idDentadura,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("Lo sentimos", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.eliminado !== undefined){
				swal("¡Genial!", respuesta.eliminado, "success", {
					btn1: 'Ok',
				})
				.then((value) => {
					if(value = "btn1"){
						window.location.reload();
					}
				})
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}



// ANECDOTA
$(document).on("submit", "#formAnecdota", function(event){
	event.preventDefault();

	var imgAnecdota = $("#imgAnecdota", form).val();
	var linkAnecdota =  $("input[name='linkAnecdota']", form).val();

	if (imgAnecdota.length > 0 && linkAnecdota > 0) {
		swal("¡Elige!", "No se puede adjuntar una imagen y un link a la vez", "error");
		return false;
	} else if (imgAnecdota.length > 0 && linkAnecdota.length == 0) {

		var infoForm = {
			fechaAnecdota: $("input[type='date']", form).val(),
			nombreAnecdota: $("input[name ='nombreAnecdota']", form).val(),
			lugarAnecdota: $("input[name ='lugarAnecdota']", form).val(),
			descripcionAnecdota: $("textarea[name='descripcionAnecdota']", form).val(),
			extraAnecdota: $("#imgAnecdota", form).val(),
			tipoExtra: 'img',
		};
	} else if (imgAnecdota.length == 0 && linkAnecdota.length > 0) {
		var infoForm = {
			fechaAnecdota: $("input[type='date']", form).val(),
			nombreAnecdota: $("input[name ='nombreAnecdota']", form).val(),
			lugarAnecdota: $("input[name ='lugarAnecdota']", form).val(),
			descripcionAnecdota: $("textarea[name='descripcionAnecdota']", form).val(),
			extraAnecdota: $("input[name='linkAnecdota']", form).val(),
			tipoExtra: 'link',
		};
	} else {
		var infoForm = {
			fechaAnecdota: $("input[type='date']", form).val(),
			nombreAnecdota: $("input[name ='nombreAnecdota']", form).val(),
			lugarAnecdota: $("input[name ='lugarAnecdota']", form).val(),
			descripcionAnecdota: $("textarea[name='descripcionAnecdota']", form).val(),
			extraAnecdota: null,
			tipoExtra: 'ninguno',
		};
	}

	var form = $(this);

	var url_php = 'back/anecdotas_guardar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			swal("¡Error!", respuesta.error, "error");
			return false;
		}
		//Mostrar el li en la lista que hay que visualizar
		if(respuesta.guardado == true){
			swal("¡Anécdota guardada!", "Quedará para la posteridad", "success", {
				buttons: {
				btn1: "Ok",
				},
			})
			.then((value) => {
				if (value == "btn1") {
					window.location.reload();
				}
			});

		}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;

	
});

function mostrarAnecdotaEditado(idAnecdota){
	event.preventDefault();

	url_php = "back/anecdotas_obtenerDatos.php";



		$.ajax({
			type:"POST",
			data: "idAnecdota=" + idAnecdota,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("¡Vaya!", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.encontrado == true){
				$('#idAnecdotaEditado').val(respuesta.idAnecdota);
				$('#fechaAnecdotaEditado').val(respuesta.fechaAnecdota);
				$('#nombreAnecdotaEditado').val(respuesta.nombreAnecdota);
				$('#lugarAnecdotaEditado').val(respuesta.lugarAnecdota);
				$('#descripcionAnecdotaEditado').val(respuesta.descripcionAnecdota);

				switch(respuesta.tipoExtra){
					case 'img':
						$('#imgAnecdotaEditado').val(respuesta.extraAnecdota);
						break;
					case 'link':
						$('#linkAnecdotaEditado').val(respuesta.extraAnecdota);
						break;
				}
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}

$(document).on("submit", "#formEditarAnecdota", function(event){
	event.preventDefault();

	var imgAnecdota = $("#imgAnecdotaEditado", form).val();
	var linkAnecdota =  $("input[name='linkAnecdota']", form).val();

	if (imgAnecdota.length > 0 && linkAnecdota > 0) {
		swal("¡Elige!", "No se puede adjuntar una imagen y un link a la vez", "error");
		return false;
	} else if (imgAnecdota.length > 0 && linkAnecdota.length == 0) {

		var infoForm = {
			idAnecdota : $("input[name='idAnecdota']", form).val(),
			fechaAnecdota: $("#fechaAnecdotaEditado", form).val(),
			nombreAnecdota: $("#nombreAnecdotaEditado", form).val(),
			lugarAnecdota: $("#lugarAnecdotaEditado", form).val(),
			descripcionAnecdota: $("#descripcionAnecdotaEditado", form).val(),
			extraAnecdota: $("#imgAnecdotaEditado", form).val(),
			tipoExtra: 'img',
		};
	} else if (imgAnecdota.length == 0 && linkAnecdota.length > 0) {
		var infoForm = {
			idAnecdota : $("input[name='idAnecdota']", form).val(),
			fechaAnecdota: $("#fechaAnecdotaEditado", form).val(),
			nombreAnecdota: $("#nombreAnecdotaEditado", form).val(),
			lugarAnecdota: $("#lugarAnecdotaEditado", form).val(),
			descripcionAnecdota: $("#descripcionAnecdotaEditado", form).val(),
			extraAnecdota: $("#linkAnecdota", form).val(),
			tipoExtra: 'link',
		};
	} else {
		var infoForm = {
			idAnecdota : $("input[name='idAnecdota']", form).val(),
			fechaAnecdota: $("#fechaAnecdotaEditado", form).val(),
			nombreAnecdota: $("#nombreAnecdotaEditado", form).val(),
			lugarAnecdota: $("#lugarAnecdotaEditado", form).val(),
			descripcionAnecdota: $("#descripcionAnecdotaEditado", form).val(),
			extraAnecdota: null,
			tipoExtra: 'ninguno',
		};
	}

	var form = $(this);
	$("#msgErrorAnecdotaModal").hide();
	var url_php = 'back/anecdotas_editar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			$("#msgErrorAnecdotaModal").text(respuesta.error).show();
			return false;
		}
		//Mostrar el li en la lista que hay que visualizar
		if(respuesta.editado == true){
			swal("¡Anécdota guardada!", "Quedará para la posteridad", "success", {
				buttons: {
				btn1: "Ok",
				},
			})
			.then((value) => {
				if (value == "btn1") {
					window.location.reload();
				}
			});

		}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;

	
});

function eliminarAnecdota(idAnecdota){
	event.preventDefault();

	url_php = "back/anecdotas_eliminar.php";

		$.ajax({
			type:"POST",
			data: "idAnecdota=" + idAnecdota,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("Lo sentimos", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.eliminado !== undefined){
				swal("¡Genial!", respuesta.eliminado, "success", {
					btn1: 'Ok',
				})
				.then((value) => {
					if(value = "btn1"){
						window.location.reload();
					}
				})
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}


// VISITANTES
$(document).on("submit", "#formVisitas", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		nombreUsuario: $("input[name ='nombreUsuario']", form).val(),
		apellidosUsuario: $("input[name='apellidosUsuario']", form).val(),
		email: $("input[type ='email']", form).val(),
		pass: $("input[type='password']", form).val(),
		rol: 'visitante',
	};
	
	var url_php = 'back/visitantes_guardar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			swal("¡Vaya!", respuesta.error, "error");
			return false;
		}
		//Mostrar el li en la lista que hay que visualizar
		if(respuesta.guardado == true){
			swal("¡Genial", "Datos guardados.", "success", {
				buttons: {
				  btn1: "Ok",
				},
			  })
			  .then((value) => {
				if ('btn1') {
					window.location.reload();
				}
			  });

		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});

function mostrarVisitanteEditado(idVisitas){
	event.preventDefault();

	url_php = "back/visitas_obtenerDatos.php";



		$.ajax({
			type:"POST",
			data: "idVisitas=" + idVisitas,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("¡Vaya!", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.encontrado == true){
				$('#idVisitasEditado').val(respuesta.idVisitas);
				$('#nombreUsuarioEditado').val(respuesta.nombreUsuario);
				$('#apellidosUsuarioEditado').val(respuesta.apellidosUsuario);
				$('#emailEditado').val(respuesta.email);
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}

$(document).on("submit", "#formVisitasAnecdota", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		idVisitas: $("#idVisitasEditado", form).val(),
		nombreUsuario: $("input[name ='nombreUsuario']", form).val(),
		apellidosUsuario: $("input[name='apellidosUsuario']", form).val(),
		email: $("input[type ='email']", form).val(),
		pass: $("input[type ='password']", form).val(),
	};
	
	$("#msgErrorVisitasModal").hide();
	var url_php = 'back/visitas_editar.php';
	
	$.ajax({
		type:'POST',
		url: url_php,
		data: infoForm,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxHecho(respuesta){
		console.log(respuesta);
		if(respuesta.error !== undefined) {
			$("#msgErrorVisitasModal").text(respuesta.error).show();
			//form[0].reset();
			return false;
		}
		if(respuesta.editado !== undefined){
			swal("¡Genial!", respuesta.editado, "success",{
				buttons: {
					btn1: "Ok",
				},
			})
			.then((value) => {
				if(value = "btn1"){
					$("#actualizarVisitantes").hide();
					window.location.reload();
				}
			});
		}
	})
	.fail(function ajaxError(e){
		console.log(e);
	})
	.always(function ajaxSiempre(){
		console.log('Final de la llamada ajax.');
	})
	return false;
});

function eliminarVisitante(idVisitas){
	event.preventDefault();

	url_php = "back/visitas_eliminar.php";

		$.ajax({
			type:"POST",
			data: "idVisitas=" + idVisitas,
			url: url_php,
			dataType: 'json',
			async: true,
		})

		.done(function ajaxHecho(respuesta){
			console.log(respuesta);
			  if(respuesta.error !== undefined) {
				swal("Lo sentimos", respuesta.error, "error");
				  return false;
			  }
			if(respuesta.eliminado !== undefined){
				swal("¡Genial!", respuesta.eliminado, "success", {
					btn1: 'Ok',
				})
				.then((value) => {
					if(value = "btn1"){
						window.location.reload();
					}
				})
			}
		})
		.fail(function ajaxError(e){
			console.log(e);
		})
		.always(function ajaxSiempre(){
			console.log('Final de la llamada ajax.');
		})
		return false;		
	
}


//CREAR
function noBebe(){
	swal("¡Vaya!", "No puedes visitar un mundo sin seleccionar su bebé. Selecciona esta opción en el botón 'mundo' del bebé correspondiente." , "error");
	return false;
}