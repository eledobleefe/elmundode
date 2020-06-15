<?php
//Para trabajar necesitaremos
require_once 'back/Conexion.php';
require_once 'back/Usuario.php';
require_once 'back/Bebe.php';
require_once 'back/funciones.php';


//Recuperamos la sesión-------------------------------------------------------------------------
session_start();

/*Si la sesión está vacía quiere decir que no se ha pasado por crear_index.php.
Esta es una forma de evitar que alguien acceda a esta página pegando la url directamente en el navegador*/
/*if(empty($_SESSION)) {
	//Lo devolvemos a la página de index.html
	header("Location:index.html");
}*/

//Después recuperamos el idUsuario guardado en la sesión----------------------------------------
$idUsuario = $_SESSION['idUsuario'];


//Nos conectamos a la BBDD----------------------------------------------------------------------
try {
	$conexion = new Conexion();
}
//En el caso de que haya algún error en la conexión lo capturamos
catch(PDOException $e){
	die("Error: " . $e->getMessage());
}


//Guardamos el resultado de la función mostrar bebés para mostrar en la página------------------
$mostrarBebes = mostrarBebes($idUsuario);


//Si el usuario le da a 'Ver mundo'-------------------------------------------------------------
if(isset($_POST['btnVerMundo'])){
	//Obtenemos el id del bebé elegido
	if(isset($_POST['idBebeElegido'])){
		$idBebeElegido = $_POST['idBebeElegido'];
		//Guardamos su valor en la sesión
		$_SESSION['idBebe'] = $idBebeElegido;
		//Y lo redirigimos a la página de mundos
		header("Location:visitar.php");
	}
}


//Si el usuario le da a 'Editar'----------------------------------------------------------------
if(isset($_POST['btnEditarBebe'])){
	//Obtenemos el id del bebé elegido
	if(isset($_POST['idBebeElegido'])){
		$idBebeElegido = $_POST['idBebeElegido'];
		//Guardamos su valor en la sesión
		$_SESSION['idBebe'] = $idBebeElegido;
		//Y lo redirigimos a la página de editar mundos
		header("Location:crear_bebes.php");
	}
}




//Si el usuario le da a 'Borrar'----------------------------------------------------------------
if(isset($_POST['btnBorrarBebe'])){
	//Obtenemos el id del bebé elegido
	if(isset($_POST['idBebeElegido'])){
		$idBebeElegido = $_POST['idBebeElegido'];
		//Y borramos el bebé
		$bebeBorrar = Bebe::buscarBebesId($idBebeElegido);
		$bebeBorrar->eliminarBebes();
		//Y actualizamos 
		$mostrarBebes = mostrarBebes($idUsuario);
	}
}


?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="estilos/bootstrap.css">
<!-- Nuestro CSS -->
<link rel="stylesheet" href="estilos/elmundode.css">
	<!-- Iconos -->
<link rel="stylesheet" href="estilos/style.css">
	<!--Favicon-->
<link rel="icon" type="image/png" href="img/elmundode/favicon.png" sizes="32x32">
<title>El mundo de - Crea tu mundo</title>
</head>
<script>
	//Limpiamos los datos de la sesión
	sessionStorage.clear();
</script>
	
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
					<a class="dropdown-item active" href="crear_mundos.php">Tus mundos<span class="sr-only">(current)</span></a>
					<a class="dropdown-item d-none" href="crear_bebes.php">Bebé</a>
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
	
	<!--SECTION-->
	<div class="container-fluid b_verde todoAlto">
		<?php if(isset($mostrarBebes)) echo $mostrarBebes ?>
	</div>
	<!--Fin section-->
	
	
	<!--FOOTER-->	
	<footer class="container-fluid bg-dark blanco textofooter py-4">
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
<script src="script/bootstrap.min.js"></script>
<!--JavaScript propio con validación de email repetido-->
	<script src="script/crear_index.js"></script>
</body>
</html>
