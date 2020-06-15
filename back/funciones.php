<?php
//Necesitamos el código de los siguientes archivos
require_once 'Usuario.php';
require_once 'Bebe.php';
require_once 'Progenitor.php';


///////////////////////// GENÉRICOS  /////////////////////////////////

//Función para quitar las comillas de los select
function quitarComillas($cadena) {
  $resultado = preg_replace("/[^a-zA-Z0-9\+\-]+/", "", $cadena);
  return $resultado;
}

//Función despliegue de selects con información de los enum de las tablas
function desplegarSelect($row){
	$enum = $row['1'];
	$lista = strstr ($enum, "(");  
	$limpiarListIzquierda = ltrim ($lista, "("); 
	$limpiarListDerecha = rtrim ($limpiarListIzquierda, ")"); 
	$listaLimpia = explode (',', $limpiarListDerecha);
	$select ="";
	foreach($listaLimpia as $item){
		$item = quitarComillas($item);
		$select .= "<option value='" . $item ."'>". $item . "</option>";
	}
	return $select;
}

//Función despliegue de selects con información de los enum de las tablas con la opción correspondiente seleccionada
function desplegarSelectSeleccionado($row, $seleccionada){
	$enum = $row['1'];
	$lis = strstr ($enum, "(");  
	$lis = ltrim ($lis, "("); 
	$lis = rtrim ($lis, ")"); 
	$lista = explode (',', $lis);
	$select ="";
	$seleccionada = quitarComillas($seleccionada);
	foreach($lista as $item){
		$item = quitarComillas($item);
		if ((strcmp($item, $seleccionada) === 0)){
			$select .= "<option value='" . $item ."' selected>". $item . "</option>";
		} else {
			$select .= "<option value='" . $item ."'>". $item . "</option>";
		}
	}
	return $select;
}



//////////////////////////  CREAR_MUNDOS.PHP  ////////////////////////////////////

//Función para mostrar los bebés de un usuario
function mostrarBebes($idUsuario){
	$cardBebes = "";
	$listaBebes = Bebe::listarBebesUsuario($idUsuario);
	$usuario = Usuario::buscarUsuariosId($idUsuario);
	$contador = 0;
	if($listaBebes){
		$cardBebes = "<h1 class='display-4 font-weight-normal text-white text-center pt-5'>¡Hola " . $usuario->getnombreUsuario() . "!</h1>
		<p class='text-white text-center m-5'>Recuerda que, como máximo, puedes crear tres mundos. <br/>¡Manos a la obra!</p>
		<div class='row row-cols-1 row-cols-md-3 justify-content-around align-items-center'>";
		foreach ($listaBebes as $unBebe) {
			$cardBebes .= "
				<div class='col mb-4'>
					<div class='card sombra m-5 mx-md-1'>
					  <img src='img/elmundode/imagenPrueba_2.png' class='card-img-top' alt='imgPrueba'>
					  <div class='card-body text-center'>
						<h5 class='card-title'>" . $unBebe['nombreBebe'] . " " . $unBebe['apellidosBebe'] . "</h5>
						<p class='card-text'>Nació el " . $unBebe['fechaNacimiento'] . " a las " . $unBebe['horaNacimiento'] . " en " . $unBebe['ciudadNacimiento'] . ".</p>
					  </div>
						<form method='post' action='crear_mundos.php' class='m-auto'>
							<div class='form-group d-none'>
								<label for='idBebeElegido'>IdBebe:</label>
								<input type='text' class='form-control' id='idBebeElegido' name='idBebeElegido' value='" . $unBebe['idBebe'] . "'>
							</div>
							<div class='btn-group btn-group-md mb-3' role='group' aria-label='idBebe'>
								<button type='submit' name='btnVerMundo' class='btn b_verdeClaro text-white'>Ver</button>
								<button type='submit' name='btnEditarBebe' class='btn b_verdeClaro text-white'>Editar</button>
								<button type='submit' name='btnBorrarBebe' class='btn b_verdeClaro text-white'>Borrar</button>
							</div>
						</form>
					</div>
				</div>";
			$contador .= $contador + 1;
		}
		
		if (count($listaBebes) < 3) {
			
			while ($contador < 3) {
				$cardBebes .= "<div class='col mb-4'>
									<a href='crear_bebes.php'><img src='img/elmundode/anadir.svg' class='card-img-top w-50 mx-auto mt-3 d-block'  alt='imgPrueba'></a>
									<a class='btn bg-white sombra my-5 mx-auto d-block verde w-50' href='crear_bebes.php' role='button'>Añadir bebé</a>
							 </div>";
				$contador++;
			}
		}
		
		$cardBebes .= "</div>"; 
			
	} else if (count($listaBebes) === 0) {
		$cardBebes .="<div class='col-md-8 p-lg-5 mx-auto py-5 text-center'>
						<h1 class='display-4 font-weight-normal text-white'>¡Hola " . $usuario->getnombreUsuario() . "!</h1>
        				<p class='lead font-weight-normal text-white'>Aún no nos has contado nada sobre tu bebé ni construído un mundo para él.<br/> ¡¿A qué esperas?!</p>
        				<a class='btn bg-white verde sombra' href='crear_bebes.php'>Empieza a crear</a>
    				</div>";
	}
	return $cardBebes;
}



////////////////////////  CREAR_PROGENITORES.php  ////////////////////////////////////
//Función para limitar los progenitores de un bebé a 2
function maxProgenitor($idBebe){
	$mensajeMaxProgenitores = "";
	$listaProgenitores = Progenitor::listarProgenitoresBebe($idBebe);
	if($listaProgenitores){
		$numProgenitores = count($listaProgenitores);
		if($numProgenitores == '2') {
			$mensajeMaxProgenitores = "<div class='alert alert-warning mx-3' role='alert' id='maxNumBebe'>El máximo de progenitores por bebé es de dos. Has llegado al límite.<br/>Puedes editar los datos de los progenitores de la lista o completar los datos en las siguientes pestañas.</div>";
		}
	} 
	return $mensajeMaxProgenitores;
}





?>