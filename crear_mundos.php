<?php
//Necesitamos los siguientes archivos
require_once 'back/config.php';
require_once 'back/usuario_obtenerBebes.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

/*Si la sesión está vacía quiere decir que no se ha pasado por crear_index.php.
Esta es una forma de evitar que alguien acceda a esta página pegando la url directamente en el navegador*/
if(empty($_SESSION)) {
	//Lo devolvemos a la página de index.php
	header("Location:index.php");
}

/*Vaciamos la sessión con el idBebe si es que existe*/
if (isset($_SESSION['idBebe'])) {
	unset($_SESSION['idBebe']);
} 

$idUsuario = $_SESSION['idUsuario'];
$nombreUsuario = $_SESSION['nombreUsuario'];
$misMundos = obtenerBebesUsuario($idUsuario, $nombreUsuario);


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
				<li class="nav-item mt-3 my-lg-1 mx-lg-3">
					<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="logout.php">Salir</a>
				</li>
			</ul>
		</div>
	</nav>
	<!--Fin menú-->
	
	<!--SECTION-->
	<section class="container-fluid b_verde">
		<?php if(isset($misMundos)) echo $misMundos; ?>
	</section>
	<!--Fin section-->
<?php include 'back/incluir/footer.php'; ?>	

<?php include 'back/incluir/pie.php'; ?>

</body>
</html>
