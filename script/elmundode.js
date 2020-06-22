//Una vez que la página esté cargada
$(document).ready(function() {
	"use strict";
	
	//Comprobamos contraseñas---------------------------------------------------------------------------
	//variables
	var pass1 = $('#pass');
	var pass2 = $('#passNuevoRepite');
	var boton = $('#btn_registrar');
	var confirmacion = "¡Las contraseñas coinciden!";
	var negacion = "Las contraseñas no coinciden. Por favor, revísalas.";
	var vacio = "La contraseña no puede estar en blanco. Por favor, escribe algo más un espacio.";
	//oculto por defecto el elemento span
	var div = $('<div></div>').insertAfter(pass2);
	div.hide();
	//función que comprueba las dos contraseñas
	function coincidePassword(){
		var valor1 = pass1.val();
		var valor2 = pass2.val();
		//muestro el span
		div.show()/*.removeClass();*/;
		//condiciones dentro de la función
		if(valor1 !== valor2){
			div.text(negacion).addClass('alert alert-warning mt-3').attr({"role" : "alert", "id" : "confirmPass"});
			boton.prop('disabled',true);	
		}
		if(valor2 === " " || valor1 === " "){
			div.text(vacio).addClass('alert alert-warning mt-3').attr({"role" : "alert", "id" : "confirmPass"});
			boton.prop('disabled',true);	
		}
		if(valor1!==" " && valor2!==" " && valor1 === valor2){
			div.text(confirmacion).removeClass("alert alert-warning").addClass("alert alert-success mt-3").attr({"role" : "alert", "id" : "confirmPass"});
			boton.prop('disabled',false);
		}
	}

	
	//ejecuto la función al soltar la tecla
	pass2.keyup(function(){
		coincidePassword();
	});
	
	
});