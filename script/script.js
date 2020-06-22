
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
	var url_php = 'back/registrarUsuario.php';
	
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
	var url_php = 'back/iniciarSesion.php';
	
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
	var url_php = 'back/guardarProgenitor.php';
	
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


function obtenerDatosBebe(idBebe){
	event.preventDefault();

	url_php = "back/obtenerDatosBebe.php";

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

	url_php = "back/eliminarBebe.php";

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

	url_php = "back/verMundoBebe.php";

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
		imgNacimiento: $("input[name='imgNacimiento']", form).val(),
		dedicatoriaBebe: $("#dedicatoriaBebe",form).val()
	}
	
	//$("#msgErrorBebe").hide();
	var url_php = 'back/guardarBebe.php';
	
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
	var url_php = 'back/editarBebe.php';
	
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

function eliminarProgenitor(idProgenitor){
	event.preventDefault();

	url_php = "back/eliminarProgenitor.php";

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
	var url_php = 'back/editarProgenitor.php';
	
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


function mostrarProgenitorEditado(idProgenitor){
	event.preventDefault();

	url_php = "back/obtenerDatosProgenitor.php";

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

$(document).on("submit", "#entrarMundo", function(event){
	event.preventDefault();
	var form = $(this);
	var infoForm = {
		email: $("input[type ='email']",form).val(),
		pass: $("input[type='password']", form).val()
	}
	
	$("#msgErrorVisitar").hide();
	var url_php = 'back/iniciarSesionVisitar.php';
	
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