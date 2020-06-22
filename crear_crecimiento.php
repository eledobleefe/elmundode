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
	</nav>	<!--Fin menú-->
	
	<!--SECTION PRINCIPAL------------------------------------------------------------------------------------------------------------->
	<section class="container-fluid b_amarillo p-5">
		<!-- Migas de pan--------------------------------------------------------------------------------------------------------------->
		<div class="container">	
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="crear_bebes.php">Bebé</a></li>
					<li class="breadcrumb-item"><a href="crear_progenitores.php">Progenitores</a></li>
					<li class="breadcrumb-item"><a href="crear_embarazo.php">Embarazo</a></li>
					<li class="breadcrumb-item active" aria-current="page">Crecimiento</li>
					<li class="breadcrumb-item"><a href="crear_dentadura.php">Dentadura</a></li>
				<li class="breadcrumb-item"><a href="crear_anecdotas.php">Anécdotas</a></li>
				<li class="breadcrumb-item"><a href="crear_visitantes.php">Visitantes</a></li>
				</ol>
			</nav>
		</div>
	<!-- Fin migas de pan----------------------------------------------------------------------------------------------------------->
		<div class="container bg-white py-3 sombra">
			<div class="container-fluid my-3">
				<form id="formBebe" method="post" action="crear_crecimientos.php" >
					<h6 class="amarillo border borde_amarillo rounded text-center text-uppercase py-3">Datos del crecimiento</h6>
					<!--Mostramos el mensaje correspondiente-->
                    <?php if(isset($mensajeBebe)) echo $mensajeBebe ?>
                    <div class="alert alert-danger py-3 my-3">Página sin terminar</div>
					<div class="row mt-5 b-3">
						<div class="col-sm-12 col-md-3">
							<div class="form-group">
								<label for="fechaDatos">Fecha de los datos</label>
								<input type="date" class="form-control" id="fechaDatos">
							</div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="form-group">
								<label for="altura">Altura</label>
								<input type="text" class="form-control" id="altura">
							</div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="form-group">
								<label for="peso">Peso</label>
								<input type="text" class="form-control" id="peso">
							</div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="form-group">
								<label for="cabeza">Cabeza (contorno)</label>
								<input text="date" class="form-control" id="cabeza">
							</div>
						</div>
					</div>
					<button type="guardar" class="btn b_amarillo text-white my-3"><i class="far fa-save mr-2"></i>Guardar</button>
				</form>
			</div>
			
			<hr class="b_amarillo my-5">
			
			<div class="container-fluid my-3">
				<h6 class="b_amarillo text-white rounded text-center text-uppercase p-3 my-4">Tabla de crecimiento</h6>
				<div class="row my-1 justify-content-center align-items-center">
					<div class="col-sm-12 col-md-10">
						<ul class="list-group list-group-horizontal-sm">
							<li class="list-group-item text-center w-100">12-02-2020</li>
							<li class="list-group-item text-center w-100">50.50 cm</li>
							<li class="list-group-item text-center w-100">3.860 kg</li>
							<li class="list-group-item text-center w-100">40.00 cm</li>
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
							<li class="list-group-item text-center w-100">12-02-2020</li>
							<li class="list-group-item text-center w-100">50.50 cm</li>
							<li class="list-group-item text-center w-100">3.860 kg</li>
							<li class="list-group-item text-center w-100">40.00 cm</li>
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

											