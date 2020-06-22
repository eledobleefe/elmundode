<?php

require_once 'back/config.php';
require_once 'back/desplegarSelect.php';
require_once 'back/listarProgenitores.php';

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

/*Si la sesión está vacía quiere decir que no se ha pasado por crear_index.php.
Esta es una forma de evitar que alguien acceda a esta página pegando la url directamente en el navegador*/
if(empty($_SESSION)) {
	//Lo devolvemos a la página de index.html
	header("Location:index.php");
}

$nombreBebe = $_SESSION['nombreBebe'];
$idBebe = $_SESSION['idBebe'];

$listaTipoProgenitor = listarTipoProgenitor();
$selectTipoProgenitor = desplegarSelect($listaTipoProgenitor);

$listaProgenitores = listarProgenitores();
if(isset($listaProgenitores['lista'])) {
	$mostrarProgenitores = $listaProgenitores['lista'];
} else if(isset($listaProgenitores['lista'])) {
	$errorProgenitor = "<div id='msgErrorProgenitor' class='alert alert-warning mt-3 py-3 m-3' role='alert'></div>";
}
if (isset($listaProgenitores['ocultar'])){
	$ocultar = "class='d-none'";
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
				<li class="breadcrumb-item active" aria-current="page">Progenitores</li>
				<li class="breadcrumb-item"><a href="crear_embarazo.php">Embarazo</a></li>
				<li class="breadcrumb-item"><a href="crear_crecimiento.php">Crecimiento</a></li>
				<li class="breadcrumb-item"><a href="crear_dentadura.php">Dentadura</a></li>
				<li class="breadcrumb-item"><a href="crear_anecdotas.php">Anécdotas</a></li>
				<li class="breadcrumb-item"><a href="crear_visitantes.php">Visitantes</a></li>			
			</ol>
			</nav>
		</div>
	<!-- Fin migas de pan----------------------------------------------------------------------------------------------------------->
		<div class="container bg-white py-3 sombra">
			<form id="formProgenitor" method="post" action=""  <?php if(isset($ocultar)) echo $ocultar; ?>>
				<h6 class="amarillo border borde_amarillo rounded text-center text-uppercase py-3 m-3">Datos del progenitor</h6>
				<div id="msgErrorProgenitor" class="alert alert-warning mt-3 py-3 m-3" role="alert" style="display: none"></div>
				<div class="row py-3 mx-2 mb-4">
					<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="nombreProgenitor">Nombre</label>
								<input type="text" class="form-control" id="nombreProgenitor" name="nombreProgenitor" value="<?php if(isset($nombreProgenitor1)) echo $nombreProgenitor1 ?>" required>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="apellidosProgenitor">Apellidos</label>
								<input type="text" class="form-control" id="apellidosProgenitor" name="apellidosProgenitor" value="<?php if(isset($apellidosProgenitor1)) echo $apellidosProgenitor1 ?>" required>
							</div>
						</div>
					</div>
				<hr class="b_amarillo">
				<div class="row mt-5 pb-3 mx-2 px-md-1 justify-content-between">
					<div class="col-sm-12 col-md-4">
						<div class="form-group">
							<label for="fechaNProgenitor">Fecha de nacimiento</label>
							<input type="date" class="form-control" id="fechaNProgenitor" name="fechaNProgenitor" required>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div class="form-group">
							<label for="lugarNProgenitor">Lugar de nacimiento</label>
							<input type="text" class="form-control" id="lugarNProgenitor" name="lugarNProgenitor" required>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div class="form-group">
							<label for="tipoProgenitor">Tipo de progenitor</label>
							<select class="custom-select" id="tipoProgenitor" name="tipoProgenitor" required>
								<!--Mostramos las diferentes opciones que hay en la tabla de la BBDD-->
								<?php if(isset($selectTipoProgenitor)) echo $selectTipoProgenitor; ?>
							</select>
						</div>
					</div>
					</div>
					<hr class="b_amarillo">
					<div class="form-group my-5 mx-4">
						<label for="descripcionProgenitor">Descripción progenitor</label>
						<textarea rows="3" class="form-control" id="descripcionProgenitor" name="descripcionProgenitor" aria-describedby="helpDescripcion" required></textarea>
						<small id="helpDescripcion" class="form-text text-muted">Escribe una pequeña frase que te definiera cuando os enterásteis de que seríais más en la familia.</small>
					</div>
					<div class="custom-file my-5 mx-md-1 w-75 d-block">
						<input type="file" class="custom-file-input" id="imgProgenitor" name="imgProgenitor" lang="es">
						<label class="custom-file-label ml-4" for="imgProgenitor">Seleccionar Archivo</label>
					</div>
				<button type="submit" name="btnGuardarProgenitor" class="btn b_amarillo text-white ml-4 mb-4">Guardar</button>
			</form>
			<?php if(isset($mostrarProgenitores)) echo $mostrarProgenitores; ?>
			</div>

		</div>
	</section>
	
	<!--FOOTER-->	
	<?php include 'back/incluir/footer.php'; ?>	
	<?php include 'back/incluir/pie.php'; ?>   
	<?php require_once 'modalEditarProgenitor.php'; ?>	
</body>
</html>

											