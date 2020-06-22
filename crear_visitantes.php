<?php

require_once 'back/config.php';

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

/*Si la sesión está vacía quiere decir que no se ha pasado por crear_index.php.
Esta es una forma de evitar que alguien acceda a esta página pegando la url directamente en el navegador*/
if(empty($_SESSION)) {
	//Lo devolvemos a la página de index.html
	header("Location:index.php");
}

$nombreBebe = $_SESSION['nombreBebe'];
$idBebe = $_SESSION['idBebe'];



?>

<!doctype html>
<html>
<?php include 'back/incluir/cabecera.php'; ?>

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
					<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="crear.php">Crear<span class="sr-only">(current)</span></a>
					<hr class="b_verde w-75 m-auto d-block d-lg-none">
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
		<!-- Migas de pan--------------------------------------------------------------------------------------------------------------->
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="crear_bebes.php">Bebé</a></li>
					<li class="breadcrumb-item"><a href="crear_progenitores.php">Progenitores</a></li>
					<li class="breadcrumb-item active" aria-current="page">Embarazo</li>
					<li class="breadcrumb-item"><a href="crear_crecimiento.php">Crecimiento</a></li>
					<li class="breadcrumb-item"><a href="crear_dentadura.php">Dentadura</a></li>
					<li class="breadcrumb-item"><a href="crear_anecdotas.php">Anécdotas</a></li>
					<li class="breadcrumb-item"><a href="crear_visitantes.php">Visitantes</a></li>
				</ol>
			</nav>
		</div>
	<!-- Fin migas de pan----------------------------------------------------------------------------------------------------------->
		<div class="container bg-white py-3 sombra">
			<div class="container-fluid my-3">
				<form id="formBebe" method="post" action="crear_anecdotas.php" >
					<h6 class="amarillo border borde_amarillo rounded text-center text-uppercase py-3">Datos del usuario</h6>
					<!--Mostramos el mensaje correspondiente-->
                    <?php if(isset($mensajeBebe)) echo $mensajeBebe ?>
                    <div class="alert alert-danger py-3 my-3">Página sin terminar</div>
					<div class="row pt-3 justify-content-between">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="fechaDatos">Nombre</label>
								<input type="text" class="form-control" id="fechaDatos">
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="altura">Apellidos</label>
								<input type="text" class="form-control" id="descripcionAnecdota" >
							</div>
						</div>
					</div>
					<div class="row justify-content-between">
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="altura">Email</label>
								<input type="email" class="form-control" id="descripcionAnecdota">
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="peso">Contraseña</label>
								<input type="pass" class="form-control" id="lugarAnecdota" >
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="peso">Repite la constraseña</label>
								<input type="pass" class="form-control" id="lugarAnecdota" >
							</div>
						</div>
					</div>
					<button type="guardar" class="btn b_amarillo text-white my-3"><i class="far fa-save mr-2"></i>Guardar</button>
					<a href="visitar_mundo.php" class="btn b_amarillo text-white mx-sm-1 my-3"><i class="far fa-check-square mr-2"></i>Listo</a>
				</form>
			</div>
			
			<hr class="b_amarillo my-5">
			
			<div class="container-fluid my-3">
				<h6 class="b_amarillo text-white rounded text-center text-uppercase p-3 my-4">Tabla de usuarios</h6>
				<div class="row my-1 justify-content-center align-items-center">
					<div class="col-sm-12 col-md-10">
						<ul class="list-group list-group-horizontal-sm">
							<li class="list-group-item text-center w-100">Bimba</li>
							<li class="list-group-item text-center w-100">Galgo Galgo</li>
							<li class="list-group-item text-center w-100">email@email.com</li>
						</ul>
					</div>
					<div class="col-sm-12 col-md-2 my-3">
							<span class="btn b_amarillo btn-sm text-white" onclick="" data-toggle="modal" data-target="">
								<i class="fas fa-edit"></i>
							</span>
							<span class="btn b_amarillo btn-sm text-white" onclick="" data-toggle="modal" data-target="">
								<i class="fas fa-trash-alt text-white"></i>
							</span>						
					</div>
				</div>
				<div class="row my-1 justify-content-around align-items-center">
					<div class="col-sm-12 col-md-10">
						<ul class="list-group list-group-horizontal-sm">
							<li class="list-group-item text-center w-100">Bimba</li>
							<li class="list-group-item text-center w-100">Galgo Galgo</li>
							<li class="list-group-item text-center w-100">email@email.com</li>
						</ul>
					</div>
					<div class="col-sm-12 col-md-2 my-3">
							<span class="btn b_amarillo btn-sm text-white" onclick="" data-toggle="modal" data-target="">
								<i class="fas fa-edit"></i>
							</span>
							<span class="btn b_amarillo btn-sm text-white" onclick="" data-toggle="modal" data-target="">
								<i class="fas fa-trash-alt text-white"></i>
							</span>						
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!--FOOTER-->	
	<?php include 'back/incluir/footer.php'; ?>	
    <?php include 'back/incluir/pie.php'; ?>   
</body>
</html>

											