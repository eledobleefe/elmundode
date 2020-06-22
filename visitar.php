<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//Si existe un usuario en la sesión
if(!empty($_SESSION['idUsuario'])) {
	header("Location:visitar_mundos.php");
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
					<hr class="b_verde w-75 m-auto d-block d-lg-none">
				</li>
			</ul>
		</div>
	</nav>
	<!--Fin menú-->
	
	<!--SECTION-->
	<div class="container-fluid" >
		<div class="row align-items-center">
			<div class="col-12 col-md-6 container-fluid my-3 my-md-0">
				<div class="container">
					<div class="row justify-content-around">
						<div class="col-12 col-md-8">
							<h4 class="verde py-3">¡Bienvenid@ a “El mundo de”!</h4>
							<p class="py-2">¡Un momento! Aún no te has presentado ni has dicho tu clave secreta para poder entrar. Como sabrás, nadie sin santo y seña abre la puerta.</p>
							<p class="py-2">¿Que aún no tienes? Entonces habla con tus padres o con los creadores del mundo que quieres visitar. Sólo ellos podrán darte acceso.</p>
							<form id="entrarMundo" class="pt-2" method="post" action="">
								<div class="form-row my-3">
									<div class="col">
										<input type="email" name="email" class="form-control" placeholder="Email">
									</div>
									<div class="col">
										<input type="password" name="pass" class="form-control" placeholder="Contraseña">
									</div>
								</div>
								<button type="submit" name="btnEntrarMundo" class="btn b_verde text-white my-3">Entrar</button>
							</form>
							<div id="msgErrorVisitar" class="alert alert-warning mt-3" role="alert" style="display: none"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 b_verde">
				<img class="img-fluid" src="img/elmundode/visitar.svg">
			</div>
		</div>
	</div>
	
	<!--Fin section-->
	
	<!--FOOTER-->	
	<?php include 'back/incluir/footer.php'; ?>	
    <?php include 'back/incluir/pie.php'; ?>   
</body>
</html>