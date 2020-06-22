<?php
	if(session_status() !== PHP_SESSION_ACTIVE) session_start();

	//Si existe un usuario en la sesión mostramos en el menú la opción de log out
	if(!empty($_SESSION['idUsuario']) && !empty($_SESSION['rol'])) {
			$menuLogOut = '<li class="nav-item mt-3 my-lg-1 mx-lg-3">
								<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="logout.php">Salir</a>
							</li>';
			$separacionMenu = "<hr class='b_verde w-75 m-auto d-block d-lg-none'>";
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
				<li class="nav-item active mt-3 my-lg-1 mx-lg-3">
					<a class="nav-link verde text-uppercase mb-3  mb-lg-0" href="index.php">Bienvenid@<span class="sr-only">(current)</span></a>
					<hr class="b_verde w-75 m-auto d-block d-lg-none">
				</li>
				<li class="nav-item mt-3 my-lg-1 mx-lg-3">
					<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="visitar.php">Visitar</a>
					<hr class="b_verde w-75 m-auto d-block d-lg-none">
				</li>
				<li class="nav-item mt-3 my-lg-1 mx-lg-3">
					<a class="nav-link verde text-uppercase mb-3  mb-lg-0" href="crear.php">Crear</a>
					<?php if(isset($separacionMenu)) echo $separacionMenu; ?>
				</li>
				<?php if(isset($menuLogOut)) echo $menuLogOut; ?>
			</ul>
		</div>
	</nav>
	<!--Fin menú-->
	
	<!-- SECTION 1: con la imagen principal y el texto introductorio-->
	
	<section class="container mb-5">
		<div class="row align-items-center justify-content-between">
			<div class="col-sm-12 col-lg-4">
				<div class="container m-1 m-sm-5 m-lg-0 w-auto">
					<h1 class="verdeClaro my-4">Bienvenid@</h1>
					<p>Seguramente te preguntarás ¿de quién es el mundo?, ¿qué haces aquí?, o mejor incluso, ¿qué puedes hacer en esta 	página?</p>
					<p>Se trata nada más y nada menos que de un álbum de recuerdos. Sin embargo es fácil de utilizar, bonito, diferente y nada cursi.</p>
					<p>Lo primero que has de hacer es elegir tu rol: creador o visitante.</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<img class="img-fluid" src="img/elmundode/index_portada.png" alt="Bienvenido a 'El mundo de'"/>
			</div>
		</div>
	</section>
	<!--Fin section1 -->
	
	<!-- SECTION 2: con las cards para dividir por rol a los usuarios y direccionarles a la página correcta-->
	<section class="container-fluid">
		<div class="row" id="crearovisitar">
			<div class="col-md-6 b_lila py-5">
				<div class="card cardIndex sombra" >
					<img src="img/elmundode/index_crear.svg" class="card-img-top" alt="Crea un mundo">
					<div class="card-body">
						<h5 class="card-title amarillo">Cuéntale sus primeros pasos</h5>
						<p class="card-text">Guarda esas anécdotas y curiosidades para que después tus pequeños puedan 	disfrutar de ellas.</p>
						<p class="card-text">Cuéntales más sobre su vida. Lo guardaremos todo en un cofre atemporal.</p>
						<a href="crear.php" class="btn b_amarillo text-white">Crear</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 b_amarillo py-5">
				<div class="card cardIndex sombra">
					<img src="img/elmundode/index_visitar.svg" class="card-img-top" alt="Visita tu mundo">
					<div class="card-body">
						<h5 class="card-title verde">Adéntrate en la historia de tu vida</h5>
						<p class="card-text">Tus padres han guardado para ti esos pequeños detalles que dieron sentido a tus primeros días.</p>
						<p class="card-text">Anécdotas e historias de los primeros meses de tu vida a un solo click.</p>
						<a href="visitar.php" class="btn b_verde text-white">Visitar</a>
					</div>
				</div>	
			</div>
		</div>
	</section>
	<!--Fin section 2-->
<?php include 'back/incluir/footer.php'; ?>	

<?php include 'back/incluir/pie.php'; ?>

</body>
</html>