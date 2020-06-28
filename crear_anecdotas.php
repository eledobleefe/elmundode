<?php

require_once 'back/config.php';
require_once 'back/anecdotas_listar.php';

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

/*Si la sesión está vacía quiere decir que no se ha pasado por crear_index.php.
Esta es una forma de evitar que alguien acceda a esta página pegando la url directamente en el navegador*/
if(empty($_SESSION)) {
	//Lo devolvemos a la página de index.php
	header("Location:index.php");
}

$nombreBebe = $_SESSION['nombreBebe'];
$idBebe = $_SESSION['idBebe'];

$listaAnecdotas = listarAnecdotas();
if(isset($listaAnecdotas['lista'])) {
	$mostrarAnecdotas = $listaAnecdotas['lista'];
} else if(isset($listaAnecdotas['lista'])) {
	$errorAnecdotas = "<div id='msgErrorAnecdotas' class='alert alert-warning mt-3 py-3 m-3' role='alert'></div>";
}



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
					<a class="nav-link verde text-uppercase mb-3  mb-lg-0" href="index.php">Bienvenid@</a>
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
					<li class="breadcrumb-item"><a href="crear_bebes.php"><?php echo $nombreBebe; ?></a></li>
					<li class="breadcrumb-item"><a href="crear_progenitores.php">Progenitores</a></li>
					<li class="breadcrumb-item active"><a href="crear_embarazo.php">Embarazo</a></li>
					<li class="breadcrumb-item"><a href="crear_crecimiento.php">Crecimiento</a></li>
					<li class="breadcrumb-item"><a href="crear_dentadura.php">Dentadura</a></li>
					<li class="breadcrumb-item active" aria-current="page">Anécdotas</li>
					<li class="breadcrumb-item"><a href="crear_visitantes.php">Visitantes</a></li>
				</ol>
			</nav>
		</div>
	<!-- Fin migas de pan----------------------------------------------------------------------------------------------------------->
		<div class="container bg-white py-3 sombra">
			<div class="container-fluid my-3 justify-content-end">
				<form id="formAnecdota" method="post" action="" >
					<h6 class="amarillo border borde_amarillo rounded text-center text-uppercase py-3">Datos de la anécdota</h6>
					<div class="row pt-3 my-2">
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="fechaAnecdota">Fecha de los datos</label>
								<input type="date" class="form-control" id="fechaAnecdota" name="fechaAnecdota">
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="nombreAnecdota">Nombre de la anécdota</label>
								<input type="text" class="form-control" id="nombreAnecdota" name="nombreAnecdota" placeholder="Ej. Primera palabra, primer gateo, primeros pasos, primer amigo...">
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="lugarAnecdota">Lugar de la anécdota</label>
								<input type="text" class="form-control" id="lugarAnecdota" name="lugarAnecdota" placeholder="Ej. nuestra casa (primera palabra), Paseo Marítimo de A Coruña (primeros pasos),...">
							</div>
						</div>
					</div>
					<div class="row my-2">
						<div class="col-12">
							<div class="form-group">
								<label for="descripcionAnecdota">Descripción de la anécdota</label>
								<textarea rows="3" class="form-control" id="descripcionAnecdota" name="descripcionAnecdota" aria-describedby="helpDescripcion" required>
								</textarea>
								<small id="helpDescripcion" class="form-text text-muted">Escribe en pocas palabras algún detalle más de la anécdota.</small>
							</div>
						</div>
					</div>
					<div class="row align-items-center my-2">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="imgAnecdota">¿Alguna imagen que añadir?</label>
								<input type="file" class="form-control-file my-3" id="imgAnecdota" name="imgAnecdota">
							</div>
						</div>
						<div class="col-12 col-md-6">
							<label for="linkAnecdota">¿Algún link que adjuntar?</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">url:</span>
								</div>
								<input type="text" class="form-control" id="linkAnecdota" name="linkAnecdota" aria-describedby="basic-addon3">
							</div>
						</div>
					</div>
					<button type="submit" class="btn b_amarillo text-white my-3"><i class="far fa-save mr-2"></i>Guardar</button>
				</form>
				<?php if(isset($mostrarAnecdotas)) echo $mostrarAnecdotas; ?>
			</div>
	</section>
	
	<!--FOOTER-->	
	<!--FOOTER-->	
	<?php include 'back/incluir/footer.php'; ?>	
    <?php include 'back/incluir/pie.php'; ?>   
	<?php require_once 'modalEditarAnecdota.php'; ?>	

</body>
</html>

											