<?php

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
<title>El mundo de - Crea tu mundo</title>
</head>

<body>
	<!--MENÚ-->
	<nav class="navbar navbar-light bg-white container-fluid">
  		<a class="navbar-brand" href="index.html">
			<img class="img-fluid" src="img/elmundode/elmundode_240x40.png" alt="El mundo de"/>
		</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
		  <div class="collapse navbar-collapse justify-content-center mb-3" id="menu">
			<ul class="navbar-nav text-center">
			  <li class="nav-item active b_gris text-uppercase mt-2 py-2" >
				<a class="nav-link text-white font-weight-bold" href="index.html">Bienvenid@ <span class="sr-only">(current)</span></a>
			  </li>
			  <li class="nav-item b_gris text-uppercase mt-2 py-2">
				<a class="nav-link text-white font-weight-bolder" href="crear_index.php">Crear</a>
			  </li>
			  <li class="nav-item b_gris text-uppercase mt-2 py-2">
				<a class="nav-link text-white font-weight-bolder" href="visitar.php">Visitar</a>
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
					 <form class="borde_lila sombra rounded m-5 p-3">
						<div class="b_lila p-3 mb-4 rounded text-white text-uppercase text-center"><h6>¡Registrate aquí!</h6></div>
						<div class="form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" id="nombre" placeholder="Escribe tu nombre">
						</div>
						<div class="form-group">
							<label for="apellidos">Apellidos:</label>
							<input type="text" class="form-control" id="apellidos" placeholder="Escribe tus apellidos">
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="emailNuevo" placeholder="Introduce tu email">
						</div>
						<div class="form-group">
							<label for="pass">Contraseña:</label>
							<input type="password" class="form-control" id="passNuevo" placeholder="Introduce una contraseña">
						</div>
						 <div class="form-group">
							<label for="passRepite">Repite la contraseña:</label>
							<input type="password" class="form-control" id="passNuevoRepite" placeholder="">
						</div>
						<button type="submit" class="btn b_lila blanco">Registrarse</button>
					</form>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 b_amarillo">
				<div class="container">
					 <form class="borde_amarillo sombra rounded m-5 p-3">
						 <div class="b_amarillo p-3 mb-4 rounded text-white text-uppercase text-center">
						 	<img alt="¡Bienvenid@ de nuevo!" src="img/elmundode/saludos.svg" />
						 </div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" placeholder="Introduce tu email">
						</div>
						<div class="form-group">
							<label for="pass">Contraseña:</label>
							<input type="password" class="form-control" id="pass" placeholder="Introduce una contraseña">
						</div>
						<button type="submit" class="btn b_amarillo blanco">Iniciar sesión</button>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
