<?php
//Necesitamos los siguientes archivos
require_once 'back/Conexion.php';
require_once 'back/Usuario.php';

//Primero comprobamos si el usuario le ha dado a registrar
if(isset($_POST['registrar'])) {
	
	/*Primero guardamos los datos introducidos por el usuario
	pero para evitar el Cross-site scripting utilizamos htmlentities
	para transformar los caracteres especiales a html y addslashes
	para escaparlos*/
	$nombreUsuario = htmlentities(addslashes($_POST['nombre']));
	$apellidosUsuario = htmlentities(addslashes($_POST['apellidos']));
	$emailUsuario = htmlentities(addslashes($_POST['emailNuevo']));
	$passwordUsuario = htmlentities(addslashes($_POST['passNuevo']));
	//Además transformamos las contraseñas con la función md5
	$passUsuario = md5($passwordUsuario);
	
	//Conectamos a la base de datos
	try {
		$conexion = new Conexion();
	}
	//En el caso de que haya algún error en la conexión lo capturamos
	catch(PDOException $e) {
		die("Error: ".$e -> getMessage());
	}
	
	/*Guardamos en esta variable el resultado de buscar una coincidencia
	en la tabla usuarios con el email escrito por el usuario*/
	$repetido = Usuario::buscarUsuariosEmail($emailUsuario);
	/*Guardamos en la siguiente variable el resultado de buscar una coincidencia
	pero esta vez con email y contraseña insertado por el usuario*/
	$usuario = Usuario::buscarUsuariosCompleto($emailUsuario, $passUsuario);
		
	//Una vez tenemos el valor de dichas consultas
	try{
		//Si se repite el email pero no la contraseña
		if ($repetido && !$usuario) {
			//Lanzamos el mensaje para que revise el email
			$mensajeRegistro = "<div class='alert alert-warning' role='alert'>El email ya existe en nuestra base de datos. Por favor, revísalo.</div>";
		} elseif ($usuario) {
			/*En cambio, si coincide email y contraseña añadiremos al mensaje anterior
			si se ha equivocado de formulario y lo que quería era hacer login*/
			$mensajeRegistro= "<div class='alert alert-warning' role='alert'>El email y la contraseña ya existen en nuestra base de datos. Por favor, revísalos. ¿Seguro que no querías 'Iniciar sesión' en vez de registrarte?</div>";
		} else {
			//En el caso de que no coincida, quiere decir que es un usuario no registrado
			//Iniciamos sesión y guardamos sus datos
			session_start();
			$_SESSION['nombreUsuario'] = $nombreUsuario;
			$_SESSION['apellidosUsuario'] = $apellidosUsuario;
			$_SESSION['email'] = $emailUsuario;
			$_SESSION['pass'] = $passUsuario;
			$_SESSION['rol'] = 'creador';
			//Insertamos el nuevo usuario en la tabla de usuarios
			$nuevoUsuario = new Usuario(null, $nombreUsuario, $apellidosUsuario, $emailUsuario, $passUsuario, 'creador');
			$nuevoUsuario->guardarUsuarios();
			//Y guardamos su id
			$_SESSION['idUsuario'] = $nuevoUsuario->getIdUsuario();
			//Y lo rediccionaremos a la página de los formularios
			header("Location:crear_mundos.php");
		}
	}
	catch (Exception $e){
		//Si hay algún error lo capturamos y mostramos el mensaje correpondiente
		echo $e->getMessage();
	}
	
	//Cerramos conexión
	$conexion = null;
}

//Si por el contrario le ha dado a iniciar sesión
if(isset($_POST['iniciar'])) {
	
	/*Primero guardamos los datos introducidos por el usuario
	pero para evitar el Cross-site scripting utilizamos htmlentities
	para transformar los caracteres especiales a html y addslashes
	para escaparlos*/
	$emailUsuario = htmlentities(addslashes($_POST['email']));
	$passwordUsuario = htmlentities(addslashes($_POST['pass']));
	//Además transformamos las contraseñas con la función md5
	$passUsuario = md5($passwordUsuario);
	
	//Conectamos a la base de datos
	try {
		$conexion = new Conexion();
	}
	//En el caso de que haya algún error en la conexión lo capturamos
	catch(PDOException $e) {
		die("Error: ".$e -> getMessage());
	}
	
	/*Guardamos en esta variable el resultado de buscar una coincidencia
	en la tabla usuarios con el email escrito por el usuario*/
	$repetido = Usuario::buscarUsuariosEmail($emailUsuario);
	/*Guardamos en la siguiente variable el resultado de buscar una coincidencia
	pero esta vez con email y contraseña insertado por el usuario*/
	$usuario = Usuario::buscarUsuariosCompleto($emailUsuario, $passUsuario);
	
	//Una vez tenemos el valor de dichas consultas
	try{
		//Si se repite el email pero no la contraseña
		if ($repetido && !$usuario) {
			//Lanzamos el mensaje para que revise el email
			$mensajeIniciar= "<div class='alert alert-warning' role='alert'>El email o contraseña no es correcto. Por favor, revíselos.</div>";
		} elseif ($usuario) {
			//Si coincide email y contraseña, comprobamos que su rol sea creador
			$rol = $usuario->getRol();
			if($rol=='creador'){	
				// Si es creador guardaremos en la sesión los datos del usuario
				session_start();
				$_SESSION['idUsuario'] = $usuario->getIdUsuario();
				$_SESSION['nombreUsuario'] = $usuario->getnombreUsuario();
				$_SESSION['apellidosUsuario'] = $usuario->getApellidosUsuario();
				$_SESSION['email'] = $emailUsuario;
				$_SESSION['pass'] = $passUsuario;
				$_SESSION['rol'] = $usuario->getRol();
				//Y lo rediccionaremos a la página de los formularios
				header("Location:crear_mundos.php");
			} else{
				//Si es visitante lanzamos el siguiente aviso
				$mensajeIniciar= "<div class='alert alert-warning' role='alert'>El email o contraseña corresponde con un visitante no con un creador. Por favor, vaya a la página <a href='visitar.php' alt='visitar'>Visitar</a> para visitar su mundo.</div>";
			}
			
		} else {
			/*En el caso de que no coincida, quiere decir que es un usuario no registrado 
			por lo que lo derivamos al formulario correspondiente*/
			$mensajeIniciar= "<div class='alert alert-warning' role='alert'>No existe ningún usuario con esos datos. Por favor, revísalos o  cubre el formulario de regitro.</div>";
		}
	}
	catch (Exception $e) {
		//Si hay algún error lo capturamos y mostramos el mensaje correspondiente
		echo $e->getMessage();
	}
	
	$conexion = null;
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
				<li class="nav-item active mt-3 my-lg-1 mx-lg-3">
					<a class="nav-link verde text-uppercase mb-3  mb-lg-0" href="crear_index.php">Crear<span class="sr-only">(current)</span></a>
					<hr class="b_verde w-75 m-auto d-block d-lg-none">
				</li>
				<li class="nav-item mt-3 my-lg-1 mx-lg-3">
					<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="logout.php">Salir</a>
				</li>
			</ul>
		</div>
	</nav>
	<!--Fin menú-->
	
	
	<!--SECTION: donde veremos los dos formularios para que accedan los creadores (no registrados y registrados)-->
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-6 b_lila">
				<div class="container">
					 <form id="registrar" class="borde_lila sombra rounded m-5 p-3" action="crear_index.php" method='post'>
						<div class="b_lila p-3 mb-4 rounded text-white text-uppercase text-center"><h6>¡Registrate aquí!</h6></div>
						 <!--Mostramos el mensaje correspondiente-->
						<?php if(isset($mensajeRegistro)) echo $mensajeRegistro ?>
						<div class="form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre" required>
						</div>
						<div class="form-group">
							<label for="apellidos">Apellidos:</label>
							<input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escribe tus apellidos" required>
						</div>
						<div class="form-group">
							<label for="emailNuevo">Email:</label>
							<input type="email" class="form-control" id="emailNuevo" name="emailNuevo" placeholder="Introduce tu email" required>
						</div>
						<div class="form-group">
							<label for="passNuevo">Contraseña:</label>
							<input type="password" class="form-control" id="passNuevo" name="passNuevo" placeholder="Introduce una contraseña" required>
						</div>
						 <div class="form-group">
							<label for="passNuevoRepite">Repite la contraseña:</label>
							<input type="password" class="form-control" id="passNuevoRepite" name="passNuevoRepite" placeholder="" required>
						</div>
						<button type="submit" class="btn b_lila blanco" name="registrar" id="btn_registrar">Registrarse</button>
					</form>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 b_amarillo">
				<div class="container">
					 <form class="borde_amarillo sombra rounded m-5 p-3" action="crear_index.php" method='post'>
						 <div class="b_amarillo p-3 mb-4 rounded text-white text-uppercase text-center">
						 	<img alt="¡Bienvenid@ de nuevo!" src="img/elmundode/saludos.svg" />
						 </div>
						 <!--Mostramos el mensaje correspondiente-->
						<?php if(isset($mensajeIniciar)) echo $mensajeIniciar ?>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu email">
						</div>
						<div class="form-group">
							<label for="pass">Contraseña:</label>
							<input type="password" class="form-control" id="pass" name="pass" placeholder="Introduce una contraseña">
						</div>
						<button type="submit" class="btn b_amarillo blanco" name="iniciar">Iniciar sesión</button>
					</form>
				</div>
			</div>
		</div>
		
	</section>
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
