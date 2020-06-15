<?php
//Necesitamos el código de las siguientes páginas
require_once 'back/Conexion.php';
require_once 'back/Usuario.php';
require_once 'back/Bebe.php';
require_once 'back/funciones.php';

//Recuperamos la sesión
session_start();



/*Si la sesión está vacía quiere decir que no se ha pasado por crear_index.php.
Esta es una forma de evitar que alguien acceda a esta página pegando la url directamente en el navegador*/
/*if(empty($_SESSION)) {
	//Lo devolvemos a la página de index.html
	header("Location:index.html");
}*/




//Guardamos en esta variable el idUsuario que habíamos guardado en la sesión
$idUsuario = $_SESSION['idUsuario'];
//Y si lo hay, el idBebe guardado en la sesión
if (isset($_SESSION['idBebe'])){
	$idBebe = $_SESSION['idBebe'];
}


//Nos conectamos a la BBDD
try{
	$conexion = new Conexion();
	
} catch (Exception $e){
	//Si surge algún error lo capturamos y mostramos el mensaje correspondiente
	echo $e->getMessage();
}



//Cargamos el select del formulario
//Grupo sanguíneo:
$listaGrupoSanguineo = Bebe::listarGruposSanguineos();
$selectGrupoSanguineo = desplegarSelect($listaGrupoSanguineo, null);


//Si el bebé existe mostramos sus datos
if (isset($idBebe)) {
	$bebeSeleccionado = Bebe::buscarBebesId($idBebe);
	//Y si lo encontramos
	if($bebeSeleccionado) {
		$nombreBebeSeleccionado = $bebeSeleccionado->getNombreBebe();
		$apellidosBebeSeleccionado = $bebeSeleccionado->getApellidosBebe();
		$fechaNacimientoSeleccionado = $bebeSeleccionado->getFechaNacimiento();
		$horaNacimientoSeleccionado = $bebeSeleccionado->getHoraNacimiento();
		$lugarNacimientoSeleccionado = $bebeSeleccionado->getlugarNacimiento();
		$ciudadNacimientoSeleccionado = $bebeSeleccionado->getciudadNacimiento();
		$grupoSanguineoSeleccionado = $bebeSeleccionado->getGrupoSanguineo();
		$dedicatoriaBebeSeleccionado = $bebeSeleccionado->getDedicatoriaBebe();
		$imgNacimientoSeleccionado = $bebeSeleccionado->getImgNacimiento();
	
		//Construimos el select
		$selectGrupoSanguineo = desplegarSelectSeleccionado($listaGrupoSanguineo, $grupoSanguineoSeleccionado);
	}
}

////////////////////////////////////////////////// NO FUNCIONA //////////////////////////////////////////////////////////////////
//Al pulsar el botón guardar
if(isset($_POST['btnGuardarBebe'])){
	
	//Guardamos los valores introducidos
	$nombreBebe = htmlentities(addslashes($_POST['nombreBebe']));
    $apellidosBebe = htmlentities(addslashes($_POST['apellidosBebe']));
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $horaNacimiento = $_POST['horaNacimiento'];
    $lugarNacimiento = htmlentities(addslashes($_POST['lugarNacimiento']));
    $ciudadNacimiento = htmlentities(addslashes($_POST['ciudadNacimiento']));
    $grupoSanguineo = $_POST['grupoSanguineo'];
	$dedicatoriaBebe = htmlentities(addslashes($_POST['dedicatoriaBebe']));
	
	//Y en el caso de que haya imagen la guardamos
    if(!empty($_POST['imgNacimiento'])){
		$imgNacimiento = $_POST['imgNacimiento'];
	} else {
		//Le asignamos un valor vacío
		$imgNacimiento = NULL;
	}
	
		
	
	try {
		//Miramos si existe un bebé con el mismo nombre y apellidos nacido el mismo día a la misma hora en el mismo hospital
		$bebeRepetido = Bebe::buscarBebesCompleto($nombreBebe, $apellidosBebe, $fechaNacimiento, $horaNacimiento, $lugarNacimiento, $ciudadNacimiento);
		if($bebeRepetido) {
			//Si existe en la tabla lanzamos un mensaje de alerta
			$mensajeBebe= "<div class='alert alert-warning mx-3' role='alert'>Un bebé con los mismos datos ya existe en nuestra Base de datos. Por favor, revísalos.</div>";
		} else {
			//Si no existe, guardamos el bebé en la tabla correspondiente
			$nuevoBebe = new Bebe(null, $nombreBebe, $apellidosBebe, $fechaNacimiento, $horaNacimiento, $lugarNacimiento, $ciudadNacimiento, $grupoSanguineo, $imgNacimiento, $dedicatoriaBebe, $idUsuario);
			$nuevoBebe->guardarBebes();
			//Y guardamos en la sesion el idBebe
			$_SESSION['idBebe'] = $nuevoBebe->getIdBebe();
			//Y en la variable que creamos para ello al inicio
			$idBebe = $_SESSION['idBebe'];
		}	
	} catch (Exception $e){
		//Si surge algún error lo capturamos y mostramos el mensaje correspondiente
		echo $e->getMessage();
	}
	
}

/////////////////////////////////////////////// NO FUNCIONA ////////////////////////////////////////////////////////////////
//Al pulsar el botón editar simplemente modificamos los datos sin advertencia
if(isset($_POST['btnEditarBebe'])){
	
	//Guardamos los valores introducidos
	$nombreBebe = htmlentities(addslashes($_POST['nombreBebe']));
    $apellidosBebe = htmlentities(addslashes($_POST['apellidosBebe']));
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $horaNacimiento = $_POST['horaNacimiento'];
    $lugarNacimiento = htmlentities(addslashes($_POST['lugarNacimiento']));
    $ciudadNacimiento = htmlentities(addslashes($_POST['ciudadNacimiento']));
    $grupoSanguineo = $_POST['grupoSanguineo'];
	$dedicatoriaBebe = htmlentities(addslashes($_POST['dedicatoriaBebe']));
	
	//Y en el caso de que haya imagen la guardamos
    if(!empty($_POST['imgNacimiento'])){
		$imgNacimiento = $_POST['imgNacimiento'];
	} else {
		//Le asignamos un valor vacío
		$imgNacimiento = NULL;
	}
		
	try {
		$bebeEditado = new Bebe($idBebe, $nombreBebe, $apellidosBebe, $fechaNacimiento, $horaNacimiento, $lugarNacimiento, $ciudadNacimiento, $grupoSanguineo, $imgNacimiento, $dedicatoriaBebe, $idUsuario);
		$bebeEditado->guardarBebes();
	} catch (Exception $e){
		//Si surge algún error lo capturamos y mostramos el mensaje correspondiente
		echo $e->getMessage();
	}
	
}





?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<!-- Required meta tags -->
<meta charset="utf-8" lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="estilos/bootstrap.css">
<!-- Nuestro CSS -->
<link rel="stylesheet" href="estilos/elmundode.css">
	<!-- Iconos -->
<link rel="stylesheet" href="estilos/style.css">
<title>El mundo de - Crea tu mundo</title>
</head>

<body>
	<!--MENÚ-->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top container-fluid shadow-sm">
	<a class="navbar-brand" href="index.html">
		<img class="img-fluid" src="img/elmundode/elmundode_240x40.png" alt="El mundo de"/>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item mt-3 my-lg-1 mx-lg-3">
				<a class="nav-link verde text-uppercase mb-3  mb-lg-0" href="index.html">Bienvenid@</a>
				<hr class="b_verde w-75 m-auto d-block d-lg-none">
			</li>
			<li class="nav-item mt-3 my-lg-1 mx-lg-3">
				<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="visitar.php">Visitar</a>
				<hr class="b_verde w-75 m-auto d-block d-lg-none">
			</li>
			<li class="nav-item active dropdown mt-3 my-lg-1 mx-lg-3">
				<a class="nav-link dropdown-toggle verde text-uppercase mb-3 mb-lg-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Crear
				</a>
				<hr class="b_verde w-75 m-auto d-block d-lg-none">
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="crear_mundos.php">Tus mundos</a>
					<a class="dropdown-item active" href="crear_bebes.php">Bebé<span class="sr-only">(current)</span></a>
					<a class="dropdown-item d-none" href="crear_progenitores.php">Progenitor</a>
					<a class="dropdown-item d-none" href="crear_embarazos.php">Embarazo</a>
					<a class="dropdown-item d-none" href="crear_crecimientos.php">Crecimiento</a>
					<a class="dropdown-item d-none" href="crear_dentaduras.php">Dentadura</a>
					<a class="dropdown-item d-none" href="crear_anecdotas.php">Anécdotas</a>
					<a class="dropdown-item d-none" href="crear_usuarios.php">Usuarios</a>
				</div>
			</li>
			<li class="nav-item mt-3 my-lg-1 mx-lg-3">
				<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="logout.php">Salir</a>
			</li>
		</ul>
	</div>
</nav>
	<!--Fin menú-->
	
	<!--SECTION PRINCIPAL------------------------------------------------------------------------------------------------------------->
	<section class="container-fluid b_amarillo p-5">
		<div class="container bg-white pt-3 sombra">
			<form id="formBebe" method="post" action="crear_bebes.php" >
							<h6 class="amarillo border borde_amarillo rounded text-center text-uppercase py-3 m-3">Datos del bebé</h6
							
							<!--Mostramos el mensaje correspondiente-->
							<?php if(isset($mensajeBebe)) echo $mensajeBebe ?>

							<div class="row py-3 px-4 mb-4">
						  		<div class="col-sm-12 col-md-6">
							  		<div class="form-group">
										<label for="nombreBebe">Nombre</label>
										<input type="text" class="form-control" id="nombreBebe" name="nombreBebe" aria-describedby="helpNombreMundo" value="<?php if(isset($nombreBebeSeleccionado)) echo $nombreBebeSeleccionado ?>" required>
										<small id="helpNombreMundo" class="form-text text-muted" >El mundo que estás creando llevará este nombre, el del bebé.</small>
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-6">
							  		<div class="form-group">
										<label for="apellidosBebe">Apellidos</label>
										<input type="text" class="form-control" id="apellidosBebe" name="apellidosBebe" value="<?php if(isset($apellidosBebeSeleccionado)) echo $apellidosBebeSeleccionado ?>" required>
						  			</div>
							  	</div>
						  	</div>
							<hr class="b_amarillo">
						  	<div class="row mt-5 pb-3 px-4">
								<div class="col-sm-12 col-md-4">
									<div class="form-group">
										<label for="fechaNacimiento">Fecha de nacimiento</label>
										<input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="<?php if(isset($fechaNacimientoSeleccionado)) echo $fechaNacimientoSeleccionado ?>" required>
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-4">
								  	<div class="form-group">
										<label for="horaNacimiento">Hora de nacimiento</label>
										<input type="time" class="form-control" id="horaNacimiento" name="horaNacimiento" value="<?php if(isset($horaNacimientoSeleccionado)) echo $horaNacimientoSeleccionado ?>" required>
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-4">
								  	<div class="form-group">
										<label for="grupoSanguineo">Grupo sanguíneo</label>
										<select class="custom-select" id="grupoSanguineo" name="grupoSanguineo" value="<?php if(isset($grupoSanguineoSeleccionado)) echo $grupoSanguineoSeleccionado ?>" required>
										  	
											<!--Mostramos las diferentes opciones que hay en la tabla de la BBDD-->
											<?php if(isset($selectGrupoSanguineo)) echo $selectGrupoSanguineo ?>
											
									  </select>
								  	</div>
							  	</div>
						 	 </div>
						  	<div class="row pb-3 px-4">
								<div class="col-sm-12 col-md-6">
						   			<div class="form-group">
										<label for="lugarNacimiento">Lugar de nacimiento</label>
										<input type="text" class="form-control" id="lugarNacimiento" name="lugarNacimiento" value="<?php if(isset($lugarNacimientoSeleccionado)) echo $lugarNacimientoSeleccionado ?>" placeholder="Ej. Hospital Teresa Herrera" required>
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-6">
								  	<div class="form-group">
										<label for="ciudadNacimiento">Ciudad de nacimiento</label>
										<input type="text" class="form-control" id="ciudadNacimiento" name="ciudadNacimiento" value="<?php if(isset($ciudadNacimientoSeleccionado)) echo $ciudadNacimientoSeleccionado ?>" required>
								  	</div>
						  		</div>
						  	</div>
							<hr class="b_amarillo">
							<div class="form-group my-5 mx-4">
								<label for="dedicatoriaBebe">Dedicatoria</label>
								<textarea rows="5" class="form-control" id="dedicatoriaBebe" name="dedicatoriaBebe" aria-describedby="helpDedicatoria" required>
									<?php if(isset($dedicatoriaBebeSeleccionado)) echo trim($dedicatoriaBebeSeleccionado) ?>
								</textarea>
								<small id="helpDedicatoria" class="form-text text-muted">Escribe una dedicatoria para el bebé. Será lo primero que leerá al visitar su mundo.</small>
							</div>
							<div class="custom-file my-5 mx-4 w-75 d-block">
								<input type="file" class="custom-file-input" id="imgNacimiento" lang="es">
								<label class="custom-file-label" for="imgNacimiento">Seleccionar Archivo</label>
							</div>
						  	<button type="submit" name="btnGuardarBebe" class="btn b_amarillo text-white mx-4 mb-4">Guardar</button>
							<button type="submit" name="btnEditarBebe" class="btn b_amarillo text-white mx-4 mb-4">Editar</button>
							<a class="btn b_amarillo text-white mx-4 mb-4" href="crear_progenitores.php">Siguiente</a>
						</form>
		</div>
	</section>
	
	<!--FOOTER-->	
	<footer class="container-fluid bg-dark blanco textofooter py-4 alfondo">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-sm-12 col-md-1">
					<p>Logo</p>
				</div>
				<div class="col-sm-12 col-md-3">
					<p>Proyecto de Laura Fernández Fernández para C.S. Desarrollo de aplicaciones web</p>
				</div>
				<div class="col-sm-12 col-md-3">
					<ul>
						<li><a href="#" alt="Política de cookies">Política de cookies</a></li>
						<li><a href="#" alt="Política de privacidad">Política de privacidad</a></li>
					</ul>
				</div>
				<div class="col-sm-12 col-md-1">
					<a href="#" alt="Política de LinkedIn"><span class="icon-linkedin"></span></a>
				</div>
			</div>
		</div>
	</footer>
	<!--Fin del footer-->
	<!-- Optional JavaScript --> 
	<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> 
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<!--JavaScript propio-->
	<script src="script/crear.js"></script>
</body>
</html>

											