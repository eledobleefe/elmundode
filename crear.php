<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<!-- Nuestro CSS -->
<link rel="stylesheet" href="estilos/elmundode.css">
	<!-- Iconos -->
<link rel="stylesheet" href="estilos/style.css">
<title>El mundo de - Crea tu mundo</title>
</head>

<body>
	<!--Menú-->
	<nav class="container navbar navbar-expand-lg navbar-light bg-white my-2"> <a class="navbar-brand" href="index.html">El mundo de</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
		  <li class="nav-item"> <a class="nav-link" href="index.html">Bienvenid@</a></li>
			<li class="nav-item dropdown active"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Crear<span class="sr-only">(current)</span></a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> 
				<a class="dropdown-item" href="#bebe">¿De quién es el mundo?</a> 
				<a class="dropdown-item" href="#">Another action</a> 
				<a class="dropdown-item" href="#">Something else here</a> 
				</div>
		  </li>
		  <li class="nav-item"> <a class="nav-link" href="#">Visitar</a> </li>
		</ul>
	  </div>
	</nav>
	<!--Fin menú-->
	
	<!--SECTION PRINCIPAL------------------------------------------------------------------------------------------------------------->
	<section class="container-fluid b_azulClaro">
		<div class="container py-5">
			<div class="accordion sombra" id="accordionExample">
			  <div class="card w-100">
				<div class="card-header b_amarillo" id="bebe">
				  <h2 class="mb-0">
					<button class="btn text-white btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					  Mi bebé
					</button>
				  </h2>
				</div>

				<div id="collapseOne" class="collapse show" aria-labelledby="bebe" data-parent="#accordionExample">
				  <div class="card-body">
					<div class="container py-3">
						<form>
							<div class="row py-3 px-4 mb-4">
						  		<div class="col-sm-12 col-md-6">
							  		<div class="form-group">
										<label for="nombreBebe">Nombre</label>
										<input type="text" class="form-control" id="nombreBebe" aria-describedby="helpNombreMundo">
										<small id="helpNombreMundo" class="form-text text-muted">El mundo que estás creando llevará este nombre, el del bebé.</small>
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-6">
							  		<div class="form-group">
										<label for="apellidosBebe">Apellidos</label>
										<input type="text" class="form-control" id="apellidosBebe">
						  			</div>
							  	</div>
						  	</div>
							<hr class="b_amarillo">
						  	<div class="row mt-5 pb-3 px-4">
								<div class="col-sm-12 col-md-4">
									<div class="form-group">
										<label for="fechaNacimiento">Fecha de nacimiento</label>
										<input type="date" class="form-control" id="fechaNacimiento">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-4">
								  	<div class="form-group">
										<label for="horaNacimiento">Hora de nacimiento</label>
										<input type="time" class="form-control" id="horaNacimiento">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-4">
								  	<div class="form-group">
										<label for="grupoSanguineo">Grupo sanguíneo</label>
										<select class="custom-select" id="grupoSanguineo" required>
										  <option value="0 -" selected>0 -</option>
										  <option value="0 +">0 +</option>
										  <option value="A -">A -</option>
										  <option value="A +">A +</option>
										  <option value="B -">B -</option>
										  <option value="B +">B +</option>
										  <option value="AB -">AB -</option>
										  <option value="AB +">AB +</option>
									  </select>
								  	</div>
							  	</div>
						 	 </div>
						  	<div class="row pb-3 px-4">
								<div class="col-sm-12 col-md-6">
						   			<div class="form-group">
										<label for="lugarNacimiento">Lugar de nacimiento</label>
										<input type="text" class="form-control" id="lugarNacimiento" placeholder="Ej. Hospital Teresa Herrera">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-6">
								  	<div class="form-group">
										<label for="ciudadNacimiento">Ciudad de nacimiento</label>
										<input type="text" class="form-control" id="ciudadNacimiento">
								  	</div>
						  		</div>
						  	</div>
							<hr class="b_amarillo">
							<div class="form-group my-5 mx-4">
								<label for="dedicatoriaBebe">Dedicatoria</label>
								<textarea rows="5" class="form-control" id="dedicatoriaBebe" aria-describedby="helpDedicatoria"></textarea>
								<small id="helpDedicatoria" class="form-text text-muted">Escribe una dedicatoria para el bebé. Será lo primero que leerá al visitar su mundo.</small>
							</div>
							<div class="custom-file my-5 mx-4 w-75 d-block">
								<input type="file" class="custom-file-input" id="imgNacimiento" lang="es">
								<label class="custom-file-label" for="imgNacimiento">Seleccionar Archivo</label>
							</div>
						  	<button type="guardar" class="btn b_amarillo text-white ml-4">Guardar</button>
						</form>
				  	</div>		
				  </div>
				</div>
			  </div>
			  <div class="card w-100">
				<div class="card-header b_azulOscuro" id="progenitor">
				  <h2 class="mb-0">
					<button class="btn text-white btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					  Los progenitores
					</button>
				  </h2>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="progenitor" data-parent="#accordionExample">
				  <div class="card-body">
					<div class="container py-3">
						<form>
							<div class="row py-3 px-4 mb-4">
						  		<div class="col-sm-12 col-md-6">
							  		<div class="form-group">
										<label for="nombreProgenitor">Nombre</label>
										<input type="text" class="form-control" id="nombreProgenitor">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-6">
							  		<div class="form-group">
										<label for="apellidosProgenitor">Apellidos</label>
										<input type="text" class="form-control" id="apellidosProgenitor">
						  			</div>
							  	</div>
						  	</div>
							<hr class="b_azulOscuro">
						  	<div class="row mt-5 pb-3 px-4">
								<div class="col-sm-12 col-md-4">
									<div class="form-group">
										<label for="fechaNProgenitor">Fecha de nacimiento</label>
										<input type="date" class="form-control" id="fechaNProgenitor">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-4">
								  	<div class="form-group">
										<label for="lugarNProgenitor">Lugar de nacimiento</label>
										<input type="time" class="form-control" id="lugarNProgenitor">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-4">
								  	<div class="form-group">
										<label for="tipoProgenitor">Tipo progenitor</label>
										<select class="custom-select" id="tipoProgenitor" required>
										  <option value="madre" selected>Madre</option>
										  <option value="padre">Padre</option>
									  </select>
								  	</div>
							  	</div>
						 	 </div>
							<hr class="b_azulOscuro">
							<div class="form-group my-5 mx-4">
								<label for="descripcionProgenitor">Descripción progenitor</label>
								<textarea rows="3" class="form-control" id="descripcionProgenitor" aria-describedby="helpDescripcion"></textarea>
								<small id="helpDescripcion" class="form-text text-muted">Escribe una pequeña frase que te definiera cuando os enterásteis de que seríais más en la familia.</small>
							</div>
							<div class="custom-file my-5 mx-4 w-75 d-block">
								<input type="file" class="custom-file-input" id="imgProgenitor" lang="es">
								<label class="custom-file-label" for="imgProgenitor">Seleccionar Archivo</label>
							</div>
						  	<button type="guardar" class="btn b_azulOscuro text-white ml-4">Guardar</button>
						</form>
				  </div>
				  </div>
				</div>
			  </div>
			  <div class="card w-100">
				<div class="card-header" id="headingThree">
				  <h2 class="mb-0">
					<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					  Collapsible Group Item #3
					</button>
				  </h2>
				</div>
				<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				  <div class="card-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
				  </div>
				</div>
			  </div>
			</div>
		</div>
	</section>
	
	
	
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
