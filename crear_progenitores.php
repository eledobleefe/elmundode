<?php
//Necesitamos el código de las siguientes páginas
require_once 'back/Conexion.php';
require_once 'back/Usuario.php';
require_once 'back/Bebe.php';
require_once 'back/Progenitor.php';
require_once 'back/funciones.php';

//Recuperamos la sesión
session_start();



/*Si la sesión está vacía quiere decir que no se ha pasado por crear_index.php.
Esta es una forma de evitar que alguien acceda a esta página pegando la url directamente en el navegador*/
/*if(empty($_SESSION)) {
	//Lo devolvemos a la página de index.html
	header("Location:index.html");
}*/



//Nos conectamos a la BBDD
try{
	$conexion = new Conexion();
	
} catch (Exception $e){
	//Si surge algún error lo capturamos y mostramos el mensaje correspondiente
	echo $e->getMessage();
}



//Cargamos el select del formulario
//Tipo progenitor:
$listaTipoProgenitor = Progenitor::listarTipoProgenitor();
$selectTipoProgenitor = desplegarSelect($listaTipoProgenitor);


//Guardamos en esta variable el idUsuario que habíamos guardado en la sesión
$idUsuario = $_SESSION['idUsuario'];
//Y si lo hay, el idBebe guardado en la sesión
if (!is_null($_SESSION['idBebe'])){
	$idBebe = $_SESSION['idBebe'];
	//Mostramos los padres si los hay ya
	$progenitoresExistentes = Progenitor::listarProgenitoresBebe($idBebe);
	$cuantosProgenitores = count($progenitoresExistentes);
	if($cuantosProgenitores !== 0){		
		if ($cuantosProgenitores == 2) {
			$nombreProgenitor1 = $progenitoresExistentes['0']['nombreProgenitor'];
			$apellidosProgenitor1 = $progenitoresExistentes['0']['apellidosProgenitor'];
			$tipoProgenitor1 = $progenitoresExistentes['0']['tipoProgenitor'];
			$selectTipoProgenitor1 = desplegarSelectSeleccionado($listaTipoProgenitor, $tipoProgenitor1);
			$fechaNProgenitor1 = $progenitoresExistentes['0']['fechaNProgenitor'];
			$lugarNProgenitor1 = $progenitoresExistentes['0']['lugarNProgenitor'];
			$descripcionProgenitor1 = $progenitoresExistentes['0']['descripcionProgenitor'];
			$nombreProgenitor2 = $progenitoresExistentes['1']['nombreProgenitor'];
			$apellidosProgenitor2 = $progenitoresExistentes['1']['apellidosProgenitor'];
			$tipoProgenitor2 = $progenitoresExistentes['1']['tipoProgenitor'];
			$selectTipoProgenitor2 = desplegarSelectSeleccionado($listaTipoProgenitor, $tipoProgenitor2);
			$fechaNProgenitor2 = $progenitoresExistentes['1']['fechaNProgenitor'];
			$lugarNProgenitor2 = $progenitoresExistentes['1']['lugarNProgenitor'];
			$descripcionProgenitor2 = $progenitoresExistentes['1']['descripcionProgenitor'];
		} if ($cuantosProgenitores == 1){
			$nombreProgenitor1 = $progenitoresExistentes['0']['nombreProgenitor'];
			$apellidosProgenitor1 = $progenitoresExistentes['0']['apellidosProgenitor'];
			$tipoProgenitor1 = $progenitoresExistentes['0']['tipoProgenitor'];
			$selectTipoProgenitor1 = desplegarSelectSeleccionado($listaTipoProgenitor, $tipoProgenitor1);
			$fechaNProgenitor1 = $progenitoresExistentes['0']['fechaNProgenitor'];
			$lugarNProgenitor1 = $progenitoresExistentes['0']['lugarNProgenitor'];
			$descripcionProgenitor1 = $progenitoresExistentes['0']['descripcionProgenitor'];
		}
	}
}




//Si pulsa en guardar progenitor
if(isset($_POST['btnGuardarProgenitor'])){
	
	//Guardamos los valores introducidos
	$nombreProgenitor = htmlentities(addslashes($_POST['nombreProgenitor']));
    $apellidosProgenitor = htmlentities(addslashes($_POST['apellidosProgenitor']));
    $tipoProgenitor = $_POST['tipoProgenitor'];
    $fechaNProgenitor = $_POST['fechaNProgenitor'];
    $lugarNProgenitor = htmlentities(addslashes($_POST['lugarNProgenitor']));
    $descripcionProgenitor = htmlentities(addslashes($_POST['descripcionProgenitor']));
		
	//Y en el caso de que haya imagen la guardamos
    if(!empty($_POST['imgProgenitor'])){
		$imgProgenitor = $_POST['imgProgenitor'];
	} else {
		//Le asignamos un valor vacío
		$imgProgenitor = NULL;
	}
	
	try {
		//Miramos si ya existe un progenitor con esos datos
		$progenitorRepetido = Progenitor::buscarProgenitorCompleto($nombreProgenitor, $apellidosProgenitor, $fechaNProgenitor, $lugarNProgenitor, $idBebe);
		if($progenitorRepetido) {
			//Si existe en la tabla lanzamos un mensaje de alerta
			$mensajeProgenitor= "<div class='alert alert-warning mx-3' role='alert'>Un progenitor con los mismos datos que " . $progenitorRepetido->getNombreProgenitor() . " " . $progenitorRepetido->getApellidosProgenitor() . " ya existe en nuestra Base de datos. Por favor, revísalo.</div>";
		} else {
			//Si no existe, guardamos el bebé en la tabla correspondiente
			$nuevoProgenitor = new Progenitor(null, $nombreProgenitor, $apellidosProgenitor, $tipoProgenitor, $fechaNProgenitor, $lugarNProgenitor, $descripcionProgenitor, $idBebe);
			$nuevoProgenitor->guardarProgenitores();
			//Mostramos el mensaje de éxito en el guardado
			$exitoProgenitor = $nuevoProgenitor->getIdProgenitor();
			if($exitoProgenitor !== 0) {
				$mensajeProgenitor= "<div class='alert alert-success mx-3' role='alert'>Los datos de " . $nuevoProgenitor->getNombreProgenitor() . " " . $nuevoProgenitor->getApellidosProgenitor() . " se han guardado con éxito. </div>";
			}
	
			//Mostramos los padres
			$progenitoresExistentes = Progenitor::listarProgenitoresBebe($idBebe);
			$cuantosProgenitores = count($progenitoresExistentes);
			if($cuantosProgenitores !== 0){		
			if ($cuantosProgenitores == 2) {
				$nombreProgenitor1 = $progenitoresExistentes['0']['nombreProgenitor'];
				$apellidosProgenitor1 = $progenitoresExistentes['0']['apellidosProgenitor'];
				$tipoProgenitor1 = $progenitoresExistentes['0']['tipoProgenitor'];
				$selectTipoProgenitor1 = desplegarSelectSeleccionado($listaTipoProgenitor, $tipoProgenitor1);
				$fechaNProgenitor1 = $progenitoresExistentes['0']['fechaNProgenitor'];
				$lugarNProgenitor1 = $progenitoresExistentes['0']['lugarNProgenitor'];
				$descripcionProgenitor1 = $progenitoresExistentes['0']['descripcionProgenitor'];
				$nombreProgenitor2 = $progenitoresExistentes['1']['nombreProgenitor'];
				$apellidosProgenitor2 = $progenitoresExistentes['1']['apellidosProgenitor'];
				$tipoProgenitor2 = $progenitoresExistentes['1']['tipoProgenitor'];
				$selectTipoProgenitor2 = desplegarSelectSeleccionado($listaTipoProgenitor, $tipoProgenitor2);
				$fechaNProgenitor2 = $progenitoresExistentes['1']['fechaNProgenitor'];
				$lugarNProgenitor2 = $progenitoresExistentes['1']['lugarNProgenitor'];
				$descripcionProgenitor2 = $progenitoresExistentes['1']['descripcionProgenitor'];
			} if ($cuantosProgenitores == 1){
				$nombreProgenitor1 = $progenitoresExistentes['0']['nombreProgenitor'];
				$apellidosProgenitor1 = $progenitoresExistentes['0']['apellidosProgenitor'];
				$tipoProgenitor1 = $progenitoresExistentes['0']['tipoProgenitor'];
				$selectTipoProgenitor1 = desplegarSelectSeleccionado($listaTipoProgenitor, $tipoProgenitor1);
				$fechaNProgenitor1 = $progenitoresExistentes['0']['fechaNProgenitor'];
				$lugarNProgenitor1 = $progenitoresExistentes['0']['lugarNProgenitor'];
				$descripcionProgenitor1 = $progenitoresExistentes['0']['descripcionProgenitor'];
			}
	}
			
		}	
	} catch (Exception $e){
		//Si surge algún error lo capturamos y mostramos el mensaje correspondiente
		echo $e->getMessage();
	}
}

//////////////////////////////////////////////////// NO FUNCIONA ///////////////////////////////////////////////////////////////
//Si pulsa en editar progenitor
if(isset($_POST['btnEditarProgenitor'])){
	
	//Guardamos los valores introducidos
	$nombreProgenitor = htmlentities(addslashes($_POST['nombreProgenitor']));
    $apellidosProgenitor = htmlentities(addslashes($_POST['apellidosProgenitor']));
    $tipoProgenitor = $_POST['tipoProgenitor'];
    $fechaNProgenitor = $_POST['fechaNProgenitor'];
    $lugarNProgenitor = htmlentities(addslashes($_POST['lugarNProgenitor']));
    $descripcionProgenitor = htmlentities(addslashes($_POST['descripcionProgenitor']));
		
	//Y en el caso de que haya imagen la guardamos
    if(!empty($_POST['imgProgenitor'])){
		$imgProgenitor = $_POST['imgProgenitor'];
	} else {
		//Le asignamos un valor vacío
		$imgProgenitor = NULL;
	}
	
	
	try {
		//Actualizamos el progenitor
		//Lo buscamos en la BBDD
		$progenitorEditado = Progenitor::buscarProgenitorCompleto($nombreProgenitor, $apellidosProgenitor, $fechaNProgenitor, $lugarNProgenitor, $idBebe);
		//Si lo encontramos guardamos su idProgenitor
		if($progenitorEditado){
			$idProgenitor = $progenitorEditado->getIdProgenitor();
			$editarProgenitor = new Progenitor($idProgenitor, $nombreProgenitor, $apellidosProgenitor, $tipoProgenitor, $fechaNProgenitor, $lugarNProgenitor, $descripcionProgenitor, $idBebe);
			$editarProgenitor->guardarProgenitores();
		}
		//Mostramos el mensaje de éxito en el guardado
		$exitoProgenitor = Progenitor::buscarProgenitorId($idProgenitor);
		if(!$exitoProgenitor) {
			$mensajeProgenitor= "<div class='alert alert-success mx-3' role='alert'>Los datos de " . $nuevoProgenitor->getNombreProgenitor() . " " . $nuevoProgenitor->getNombreProgenitor() . " se han guardado con éxito. </div>";
		}
		
	} catch (Exception $e){
		//Si surge algún error lo capturamos y mostramos el mensaje correspondiente
		echo $e->getMessage();
	}
}


//Si pulsa en borrar progenitor
if(isset($_POST['btnBorrarProgenitor'])){
	
	//Guardamos los valores introducidos
	$nombreProgenitor = htmlentities(addslashes($_POST['nombreProgenitor']));
    $apellidosProgenitor = htmlentities(addslashes($_POST['apellidosProgenitor']));
    $fechaNProgenitor = $_POST['fechaNProgenitor'];
    $lugarNProgenitor = htmlentities(addslashes($_POST['lugarNProgenitor']));
    $descripcionProgenitor = htmlentities(addslashes($_POST['descripcionProgenitor']));
	$progenitorBorrado = Progenitor::buscarProgenitorCompleto($nombreProgenitor, $apellidosProgenitor, $fechaNProgenitor, $lugarNProgenitor, $idBebe);
	

	try {
		//Y conseguimos el idProgenitor
		if($progenitorBorrado){
			$idProgenitorBorrado = $progenitorBorrado->getIdProgenitor();
			//para borrar el progenitor
			$progenitorBorrado->eliminarProgenitores();
		}
		
		$progenitor = Progenitor::buscarProgenitorCompleto($nombreProgenitor, $apellidosProgenitor, $fechaNProgenitor, $lugarNProgenitor, $idBebe);
		if (!$progenitor){
			//Mostramos el mensaje de éxito en el borrado
			$mensajeProgenitor= "<div class='alert alert-success mx-3' role='alert'>Los datos de " . $nombreProgenitor . " " . $apellidosProgenitor . " se han borrado con éxito. </div>";
			//Mostramos los padres
			$progenitoresExistentes = Progenitor::listarProgenitoresBebe($idBebe);
			$cuantosProgenitores = count($progenitoresExistentes);
			if($cuantosProgenitores !== 0){		
				if ($cuantosProgenitores == 2) {
					$nombreProgenitor1 = $progenitoresExistentes['0']['nombreProgenitor'];
					$apellidosProgenitor1 = $progenitoresExistentes['0']['apellidosProgenitor'];
					$tipoProgenitor1 = $progenitoresExistentes['0']['tipoProgenitor'];
					$selectTipoProgenitor1 = desplegarSelectSeleccionado($listaTipoProgenitor, $tipoProgenitor1);
					$fechaNProgenitor1 = $progenitoresExistentes['0']['fechaNProgenitor'];
					$lugarNProgenitor1 = $progenitoresExistentes['0']['lugarNProgenitor'];
					$descripcionProgenitor1 = $progenitoresExistentes['0']['descripcionProgenitor'];
					$nombreProgenitor2 = $progenitoresExistentes['1']['nombreProgenitor'];
					$apellidosProgenitor2 = $progenitoresExistentes['1']['apellidosProgenitor'];
					$tipoProgenitor2 = $progenitoresExistentes['1']['tipoProgenitor'];
					$selectTipoProgenitor2 = desplegarSelectSeleccionado($listaTipoProgenitor, $tipoProgenitor2);
					$fechaNProgenitor2 = $progenitoresExistentes['1']['fechaNProgenitor'];
					$lugarNProgenitor2 = $progenitoresExistentes['1']['lugarNProgenitor'];
					$descripcionProgenitor2 = $progenitoresExistentes['1']['descripcionProgenitor'];
				} if ($cuantosProgenitores == 1){
					$nombreProgenitor1 = $progenitoresExistentes['0']['nombreProgenitor'];
					$apellidosProgenitor1 = $progenitoresExistentes['0']['apellidosProgenitor'];
					$tipoProgenitor1 = $progenitoresExistentes['0']['tipoProgenitor'];
					$selectTipoProgenitor1 = desplegarSelectSeleccionado($listaTipoProgenitor, $tipoProgenitor1);
					$fechaNProgenitor1 = $progenitoresExistentes['0']['fechaNProgenitor'];
					$lugarNProgenitor1 = $progenitoresExistentes['0']['lugarNProgenitor'];
					$descripcionProgenitor1 = $progenitoresExistentes['0']['descripcionProgenitor'];
					$nombreProgenitor2 = "";
					$apellidosProgenitor2 = "";
					$selectTipoProgenitor2 = desplegarSelect($listaTipoProgenitor);
					$fechaNProgenitor2 = "";
					$lugarNProgenitor2 = "";
					$descripcionProgenitor2 ="";
				}
			}
		}
		
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
						<a class="dropdown-item" href="crear_bebes.php">Bebé</a>
						<a class="dropdown-item active" href="crear_progenitores.php">Progenitor<span class="sr-only">(current)</span></a>
						<a class="dropdown-item" href="crear_embarazos.php">Embarazo</a>
						<a class="dropdown-item" href="crear_crecimientos.php">Crecimiento</a>
						<a class="dropdown-item" href="crear_dentaduras.php">Dentadura</a>
						<a class="dropdown-item" href="crear_anecdotas.php">Anécdotas</a>
						<a class="dropdown-item" href="crear_usuarios.php">Usuarios</a>
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
			<!--Mostramos el mensaje correspondiente-->
			<?php if(isset($mensajeProgenitor)) echo $mensajeProgenitor?>
			<!--Mostramos el mensaje correspondiente-->
			<?php if(isset($mensajeMaxProgenitor)) echo $mensajeMaxProgenitor?>
			
			<div class="row justify-content-around">
				<div class="col-sm-12 col-md-5">
					<form id="formProgenitor1" method="post" action="crear_progenitores.php" >
						<h6 class="amarillo border borde_amarillo rounded text-center text-uppercase py-3 m-3">Datos del progenitor nº1</h6>
						<div class="row py-3 px-4 px-md-1 mb-4">
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<label for="nombreProgenitor">Nombre</label>
									<input type="text" class="form-control" id="nombreProgenitor" name="nombreProgenitor" value="<?php if(isset($nombreProgenitor1)) echo $nombreProgenitor1 ?>" required>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<label for="apellidosProgenitor">Apellidos</label>
									<input type="text" class="form-control" id="apellidosProgenitor" name="apellidosProgenitor" value="<?php if(isset($apellidosProgenitor1)) echo $apellidosProgenitor1 ?>" required>
								</div>
							</div>
						</div>
						<hr class="b_amarillo">
						<div class="row mt-5 pb-3 px-4 px-md-1 justify-content-between">
							<div class="col-sm-12 col-md-4">
								<div class="form-group">
									<label for="fechaNProgenitor">Fecha de nacimiento</label>
									<input type="date" class="form-control" id="fechaNProgenitor" name="fechaNProgenitor" value="<?php if(isset($fechaNProgenitor1)) echo $fechaNProgenitor1 ?>" required>
								</div>
							</div>
							<div class="col-sm-12 col-md-4">
								<div class="form-group">
									<label for="lugarNProgenitor">Lugar de nacimiento</label>
									<input type="text" class="form-control" id="lugarNProgenitor" name="lugarNProgenitor" value="<?php if(isset($lugarNProgenitor1)) echo $lugarNProgenitor1 ?>" required>
								</div>
							</div>
							<div class="col-sm-12 col-md-4">
								<div class="form-group">
									<label for="tipoProgenitor">Tipo de progenitor</label>
									<select class="custom-select" id="tipoProgenitor" name="tipoProgenitor" required>
										<!--Mostramos las diferentes opciones que hay en la tabla de la BBDD-->
										<?php if(isset($selectTipoProgenitor1)) { echo $selectTipoProgenitor1; } else { echo $selectTipoProgenitor;} ?>
								  </select>
								</div>
							</div>
						 </div>
						<hr class="b_amarillo">
						<div class="form-group my-5 mx-4 mx-md-1">
							<label for="descripcionProgenitor">Descripción progenitor</label>
							<textarea rows="3" class="form-control" id="descripcionProgenitor" name="descripcionProgenitor" aria-describedby="helpDescripcion" required>
							<?php if(isset($descripcionProgenitor1)) echo $descripcionProgenitor1 ?></textarea>
							<small id="helpDescripcion" class="form-text text-muted">Escribe una pequeña frase que te definiera cuando os enterásteis de que seríais más en la familia.</small>
						</div>
						<div class="custom-file my-5 mx-4 mx-md-1 w-75 d-block">
							<input type="file" class="custom-file-input" id="imgProgenitor" name="imgProgenitor" lang="es">
							<label class="custom-file-label" for="imgProgenitor">Seleccionar Archivo</label>
						</div>
						<button type="submit" name="btnGuardarProgenitor" class="btn b_amarillo text-white mx-4 mb-4">Guardar</button>
						<button type="submit" name="btnEditarProgenitor" class="btn b_amarillo text-white mx-4 mb-4">Editar</button>
						<button type="submit" name="btnBorrarProgenitor" class="btn b_amarillo text-white mx-4 mb-4">Borrar</button>
					</form>
				</div>
				<div class="col-sm-12 col-md-5">
					<form id="formProgenitor2" method="post" action="crear_progenitores.php">
						<h6 class="amarillo border borde_amarillo rounded text-center text-uppercase py-3 m-3">Datos del progenitor nº2</h6>
						<div class="row py-3 px-4 px-sm-1 mb-4 justify-content-between">
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<label for="nombreProgenitor">Nombre</label>
									<input type="text" class="form-control" id="nombreProgenitor" name="nombreProgenitor" value="<?php if(isset($nombreProgenitor2)) echo $nombreProgenitor2 ?>" required>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<label for="apellidosProgenitor">Apellidos</label>
									<input type="text" class="form-control" id="apellidosProgenitor" name="apellidosProgenitor" value="<?php if(isset($apellidosProgenitor2)) echo $apellidosProgenitor2 ?>" required>
								</div>
							</div>
						</div>
						<hr class="b_amarillo">
						<div class="row mt-5 pb-3 px-4 px-md-1">
							<div class="col-sm-12 col-md-4">
								<div class="form-group">
									<label for="fechaNProgenitor">Fecha de nacimiento</label>
									<input type="date" class="form-control" id="fechaNProgenitor" name="fechaNProgenitor" value="<?php if(isset($fechaNProgenitor2)) echo $fechaNProgenitor2 ?>" required>
								</div>
							</div>
							<div class="col-sm-12 col-md-4">
								<div class="form-group">
									<label for="lugarNProgenitor">Lugar de nacimiento</label>
									<input type="text" class="form-control" id="lugarNProgenitor" name="lugarNProgenitor" value="<?php if(isset($lugarNProgenitor2)) echo $lugarNProgenitor2 ?>" required>
								</div>
							</div>
							<div class="col-sm-12 col-md-4">
								<div class="form-group">
									<label for="tipoProgenitor">Tipo de progenitor</label>
									<select class="custom-select" id="tipoProgenitor" name="tipoProgenitor" required>
										<!--Mostramos las diferentes opciones que hay en la tabla de la BBDD-->
										<?php if(isset($selectTipoProgenitor2)) {echo $selectTipoProgenitor2;} else { echo $selectTipoProgenitor;} ?>
								  </select>
								</div>
							</div>
						 </div>
						<hr class="b_amarillo">
						<div class="form-group my-5 mx-4 mx-md-1">
							<label for="descripcionProgenitor">Descripción progenitor</label>
							<textarea rows="3" class="form-control" id="descripcionProgenitor" name="descripcionProgenitor" aria-describedby="helpDescripcion" required>
							<?php if(isset($descripcionProgenitor2)) echo $descripcionProgenitor2 ?></textarea>
							<small id="helpDescripcion" class="form-text text-muted">Escribe una pequeña frase que te definiera cuando os enterásteis de que seríais más en la familia.</small>
						</div>
						<div class="custom-file my-5 mx-4 mx-md-1 w-75 d-block">
							<input type="file" class="custom-file-input" id="imgProgenitor" name="imgProgenitor" lang="es">
							<label class="custom-file-label" for="imgProgenitor">Seleccionar Archivo</label>
						</div>
						<button type="submit" name="btnGuardarProgenitor" class="btn b_amarillo text-white mx-4 mb-4">Guardar</button>
						<button type="submit" name="btnEditarProgenitor" class="btn b_amarillo text-white mx-4 mb-4">Editar</button>
						<button type="submit" name="btnBorrarProgenitor" class="btn b_amarillo text-white mx-4 mb-4">Borrar</button>
					</form>
				</div>
			</div>
			<div class="row justify-content-around b_amarillo text-right">
				<!--Mostramos la lista de progenitores si la hay-->
				<?php if(isset($mostrarProgenitor)) echo $mostrarProgenitor?>
			</div>
			<a class="btn b_amarillo text-white mx-4 mb-4" href="crear_embarazos.php">Siguiente</a>
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

											