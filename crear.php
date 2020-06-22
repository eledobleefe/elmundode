<?php
//Necesitamos los siguientes archivos
require_once 'back/config.php';


//Iniciamos la sesión
if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Si existe un usuario creador en la sesión es que ya hemos pasado por esta página, así que lo redirigimos al dashboard
if(!empty($_SESSION['idUsuario']) && !empty($_SESSION['rol'])) {
	if($_SESSION['rol'] == 'creador') {
		header("Location:crear_mundos.php");
	} else{
		//si es visitante mostramos el logout en el menú
		//Si existe un usuario en la sesión mostramos en el menú la opción de log out
		$menuLogOut = '<li class="nav-item mt-3 my-lg-1 mx-lg-3">
							<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="logout.php">Salir</a>
						</li>';
		$separacionMenu = "<hr class='b_verde w-75 m-auto d-block d-lg-none'>";
	}
}


?>


<!doctype html>
<html>

<?php include 'back/incluir/cabecera.php'; ?>

<body>
	<!--MENÚ-->
	<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top container-fluid shadow-sm">
		<a class="navbar-brand" href="index.php">
			<img class="img-fluid" src="img/elmundode/elmundode_240x40.png" alt="El mundo de"/>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item mt-3 my-lg-1 mx-lg-3">
					<a class="nav-link verde text-uppercase mb-3  mb-lg-0" href="index.php">Bienvenid@</a>
					<hr class="b_verde w-75 m-auto d-block d-lg-none">
				</li>
				<li class="nav-item mt-3 my-lg-1 mx-lg-3">
					<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="visitar.php">Visitar</a>
					<hr class="b_verde w-75 m-auto d-block d-lg-none">
				</li>
				<li class="nav-item active mt-3 my-lg-1 mx-lg-3">
					<a class="nav-link verde text-uppercase mb-3  mb-lg-0" href="crear.php">Crear<span class="sr-only">(current)</span></a>
					<?php if(isset($separacionMenu)) echo $separacionMenu; ?>
				</li>
				<?php if(isset($menuLogOut)) echo $menuLogOut; ?>
			</ul>
		</div>
	</nav>
	<!--Fin menú-->
	
	
	<!--SECTION: donde veremos los dos formularios para que accedan los creadores (no registrados y registrados)-->
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-6 b_lila">
				<div class="container">
					 <form id="formRegistrar" class="borde_lila sombra rounded m-5 p-3" method='post'>
						<div class="b_lila p-3 mb-4 rounded text-white text-uppercase text-center"><h6>¡Registrate aquí!</h6></div>
						<div id="msgErrorRegistro" class="alert alert-warning mt-3" role="alert" style="display: none"></div>
						<div class="form-group">
							<label for="nombreUsuario">Nombre:</label>
							<input type="text" class="form-control" name="nombreUsuario" placeholder="Escribe tu nombre" required>
						</div>
						<div class="form-group">
							<label for="apellidosUsuario">Apellidos:</label>
							<input type="text" class="form-control" name="apellidosUsuario" placeholder="Escribe tus apellidos" required>
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" name="email" placeholder="Introduce tu email" required>
						</div>
						<div class="form-group">
							<label for="pass">Contraseña:</label>
							<input type="password" class="form-control" id="pass" name="pass" placeholder="Introduce una contraseña" required>
						</div>
						 <div class="form-group">
							<label for="passNuevoRepite">Repite la contraseña:</label>
							<input type="password" class="form-control" id="passNuevoRepite" placeholder="" required>
						</div>
						<input type="text" class="d-none" name="rol"  value="creador">
						 <button type="submit" class="btn b_lila blanco" id="btn_registrar">Registrar</button>
					</form>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 b_amarillo">
				<div class="container">
					 <form id="formIniciarSesion" class="borde_amarillo sombra rounded m-5 p-3" method='post'>
						 <div class="b_amarillo p-3 mb-4 rounded text-white text-uppercase text-center">
						 	<img alt="¡Bienvenid@ de nuevo!" src="img/elmundode/saludos.svg" />
						 </div>
						 <div id="msgErrorSesion" class="alert alert-warning mt-3" role="alert" style="display: none"></div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" name="email" placeholder="Introduce tu email">
						</div>
						<div class="form-group">
							<label for="pass">Contraseña:</label>
							<input type="password" class="form-control" name="pass" placeholder="Introduce una contraseña">
						</div>
						<button type="submit" class="btn b_amarillo blanco">Iniciar sesión</button>
					</form>
				</div>
			</div>
		</div>
		
	</section>
	<!--Fin section-->
	
<?php include 'back/incluir/footer.php'; ?>	

<?php include 'back/incluir/pie.php'; ?>

</body>
</html>
