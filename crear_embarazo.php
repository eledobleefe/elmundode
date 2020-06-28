<?php

require_once 'back/config.php';
require_once 'back/embarazo_mostrarDatos.php';

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

/*Si la sesión está vacía quiere decir que no se ha pasado por crear_index.php.
Esta es una forma de evitar que alguien acceda a esta página pegando la url directamente en el navegador*/
if(empty($_SESSION)) {
	//Lo devolvemos a la página de index.php
	header("Location:index.php");
}

$nombreBebe = $_SESSION['nombreBebe'];
$idBebe = $_SESSION['idBebe'];

$mostrarEmbarazo = mostrarDatosEmbarazo($idBebe);




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
					<li class="breadcrumb-item"><a href="crear_bebes.php"><?php echo $nombreBebe; ?></a></li>
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
		<div class="container bg-white pt-3 sombra">
			<form id="formEmbarazo" method="post" action="" >
				<h6 class="amarillo border borde_amarillo rounded text-center text-uppercase py-3 m-3">Datos del embarazo</h6>
				<input type="number" class="d-none" name='idProgenitor' <?php if(isset($mostrarEmbarazo['idProgenitor'])) echo "value='" . $mostrarEmbarazo['idProgenitor'] . "'"; ?>>
				<div class="row py-3 px-4 mb-4">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="semanasEmbarazo">Semanas de embarazo</label>
							<input type="number" class="form-control" id="semanasEmbarazo" name="semanasEmbarazo" <?php if(isset($mostrarEmbarazo['semanasEmbarazo'])) echo "value='" . $mostrarEmbarazo['semanasEmbarazo'] . "'"; ?>>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="diasEmbarazo">+ Días de embarazo</label>
							<input type="number" class="form-control" id="diasEmbarazo" name="diasEmbarazo" aria-describedby="helpEmbarazo" <?php if(isset($mostrarEmbarazo['diasEmbarazo'])) echo "value='" . $mostrarEmbarazo['diasEmbarazo'] . "'"; ?>>
							<small id="helpEmbarazo" class="form-text text-muted">No siempre nacen con 'x' semanas justas ;)</small>
						</div>
					</div>
				</div>
				<hr class="b_amarillo">
				<div class="row py-4 px-4">
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="kgAumento">Kg que la madre engordó en el embarazo</label>
							<input type="text" class="form-control" id="kgAumento" name="kgAumento" <?php if(isset($mostrarEmbarazo['kgAumento'])) echo "value='" . $mostrarEmbarazo['kgAumento'] . "'"; ?>>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<label for="fechaNoticia">Fecha de la noticia</label>
							<input type="date" class="form-control" id="fechaNoticia" name="fechaNoticia" aria-describedby="helpNoticia" <?php if(isset($mostrarEmbarazo['fechaNoticia'])) echo "value='" . $mostrarEmbarazo['fechaNoticia'] . "'"; ?>>
							<small id="helpNoticia" class="form-text text-muted">Ese día en que os enterásteis de que crecía la familia.</small>
						</div>
					</div>
				</div>
				<button type="submit" id="guardar" class="btn b_amarillo text-white mx-4 mb-4" <?php if(count($mostrarEmbarazo) > 0) echo "hidden"; ?>><i class="far fa-save mr-2"></i>Guardar</button>
				<div class='botonesOcultos' <?php if(count($mostrarEmbarazo) == 0) echo "hidden"; ?>>
					<span class='btn b_amarillo text-white mx-4 mb-4' onclick='editarEmbarazo()'>Editar</span>
					<span class='btn b_amarillo text-white mx-4 mb-4' onclick='<?php if(isset($mostrarEmbarazo['idProgenitor'])) echo "eliminarEmbarazo(" . $mostrarEmbarazo['idProgenitor'] . ")";  ?>' >Borrar</span>
				</div>
			</form>
		</div>
	</section>
	
	<!--FOOTER-->	
	<?php include 'back/incluir/footer.php'; ?>	
    <?php include 'back/incluir/pie.php'; ?>   
</body>
</html>

											