<?php

require_once 'back/config.php';
require_once 'back/mostrarDatosBebe.php';

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

/*Si la sesión está vacía quiere decir que no se ha pasado por crear.php o por visitar.php.
Esta es una forma de evitar que alguien acceda a esta página pegando la url directamente en el navegador*/
if(empty($_SESSION)) {
	//Lo devolvemos a la página de index.html
	header("Location:index.php");
}

//Evitamos que un creador quiera entrar sin haber seleccionado un bebé
if ($_SESSION['rol'] == 'creador') {
	if(empty($_SESSION['idBebe'])){
		header("Location:crear_mundos.php");
	}
	$idBebe = $_SESSION['idBebe'];
} else {
	$idBebe = mostrarBebeVisitante($idUsuario);
}

//Si existe un usuario en la sesión mostramos en el menú la opción de log out y obtenemos información
if(!empty($_SESSION['idUsuario']) && !empty($_SESSION['rol'])) {
	$menuLogOut = '<li class="nav-item mt-3 my-lg-1 mx-lg-3">
							<a class="nav-link verde text-uppercase mb-3 mb-lg-0" href="logout.php">Salir</a>
						</li>';
	$separacionMenu = "<hr class='b_verde w-75 m-auto d-block d-lg-none'>";
	$idUsuario = $_SESSION['idUsuario'];
	$infoBebe = mostrarInformacionBebe($idBebe);
	$infoProgenitor = mostrarInformacionProgenitor($idBebe);
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
	
	<!--SECTION-->
	<section class="container-fluid" >
		<div class="row align-items-center">
			<div class="col-12 col-md-6 container-fluid my-3 my-md-0">
				<div class="container">
					<div class="row justify-content-around">
						<div class="col-12 col-md-8">
							<h4 class="verde py-3">¡Bienvenid@ a<br/>“El mundo de <?php echo $infoBebe['nombreBebe'];?>”!</h4>
							<p class="py-2"><?php echo $infoBebe['dedicatoriaBebe'];;?></p>
							<div class="row justify-content-end">
							<?php if(isset($infoProgenitor)) { foreach($infoProgenitor as $progenitor){
								echo "<div class='col-6'><p class='firma'>" . $progenitor['nombreProgenitor'] . "</p>
								<small class='col-6'>" . $progenitor['nombreProgenitor'] . " " . $progenitor['apellidosProgenitor'] . "</small></div>";}}?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<img class="img-fluid w-75  b_verde my-5" src="img/elmundode/visitar.svg">
			</div>
		</div>
</section>
<section>
	<div class="container-fluid b_verdeClaro my-3">
		<h5 class="text-white text-center text-uppercase py-3 font-weight-light">Historia</h5>
	</div>
	<div class="container-fluid">
		<div class="row justify-content-center">
				<?php if(isset($infoProgenitor)) { foreach($infoProgenitor as $progenitor){
					$calculo = calcularEdad($progenitor['fechaNProgenitor'],$infoBebe['fechaNacimiento']);
					if($progenitor['tipoProgenitor'] == 'madre'){
						$infoEmbarazo = mostrarInformacionEmbarazo($progenitor['idProgenitor'], $idBebe);
					}
					echo "<div class='col-12 col-sm-6'>
								<div class='card p-5 border-0'>
									<div class='row no-gutters'>
										<div class='col-md-5'>
											<img src='img/elmundode/" . $progenitor['tipoProgenitor'] . ".svg' class='card-img' alt='...'>
										</div>
										<div class='col-md-7'>
											<div class='card-body'>
												<h5 class='card-title verde'>" . $progenitor['nombreProgenitor'] ." <br/>
													" . $progenitor['apellidosProgenitor'] . "</h5>
												<hr class='b_verdeClaro'>
												<p class='card-text'>Cuando naciste tenía " . $calculo ."</p>
												<hr class='b_verdeClaro'>
												<p class='card-text'>" . $progenitor['descripcionProgenitor'] . "</p>
											</div>
										</div>
									</div>
								</div>
							</div>";
					}}
				?>
		</div>
		<div class="row my-3 justify-content-around">
			<div class='col-12 col-md-4 align-self-center'>
				<div class='row my-5 justify-content-end'>
					<div class='col-8 mostrarEmbarazo'>
						<p class='mb-0 ml-3'>Embarazo:</p>
						<p class='ml-3'>
							<?php 
							if(isset($infoEmbarazo)) {
								echo $infoEmbarazo['semanasEmbarazo'];
							} else {
								echo "No hay datos de";
							}
							?> semanas y 
							<?php 
								if(isset($infoEmbarazo)) {
									echo $infoEmbarazo['diasEmbarazo'];
								} else {
									echo "ni de";
								}
							?> días</p>
					</div>
				</div>
				<div class='row my-5 justify-content-end'>
					<div class='col-8 mostrarAumentoPeso'>
						<p class='mb-0 ml-3'>Aumento de peso:</p>
						<p class='ml-3'>
							<?php 
							if(isset($infoEmbarazo)) {
								$infoEmbarazo['kgAumento'];
							} else {
								echo "Nadie sabe si hubo más ";
							}
						?> kg </p>
					</div>
				</div>
				<div class='row my-5 justify-content-end'>
				<div class='col-8 mostrarFechaNoticia'>
						<p class='mb-0 ml-3'>Cuándo lo supimos:</p>
						<p class='ml-3'><?php 
							if(isset($infoEmbarazo)) {
								$fecha = new DateTIME($infoEmbarazo['fechaNoticia']);
								$formatoFecha = $fecha->format('m - d - y');
								$formatoFecha;
							} else {
								echo "No nos acordamos";
							}
							?> 
						 </p>
					</div>
				</div>
			</div>
			<div class='col-12 col-md-6'>
				<img class='img-fluid ecografia p-5 w-auto' src='img/elmundode/embarazo.jpg' alt='imagenEcografía'>
			</div>
		</div>
	</div>
</section>
	
	<!--Fin section-->
	
	<!--FOOTER-->	
	<?php include 'back/incluir/footer.php'; ?>	
    <?php include 'back/incluir/pie.php'; ?>   
</body>
</html>