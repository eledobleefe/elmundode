<?php

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<!-- Required meta tags -->
<meta charset="utf-8" lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="estilos/bootstrap.css">
<!-- Nuestro CSS -->
<link rel="stylesheet" href="estilos/elmundode.css">
	<!-- Iconos -->
<link rel="stylesheet" href="estilos/style.css">
<title>El mundo de - Crea tu mundo</title>
</head>

<body>
	<!--MENÚ-->
	<nav class="navbar navbar-light bg-white container-fluid">
  		<a class="navbar-brand" href="index.html">
			<img class="img-fluid" src="img/elmundode/elmundode_240x40.png" alt="El mundo de"/>
		</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
		  <div class="collapse navbar-collapse justify-content-center mb-3" id="menu">
			<ul class="navbar-nav text-center">
			  <li class="nav-item active b_gris text-uppercase mt-2 py-2" >
				<a class="nav-link text-white font-weight-bold" href="index.html">Bienvenid@ <span class="sr-only">(current)</span></a>
			  </li>
			  <li class="nav-item b_gris text-uppercase mt-2 py-2">
				<a class="nav-link text-white font-weight-bolder" href="crear_index.php">Crear</a>
			  </li>
			  <li class="nav-item b_gris text-uppercase mt-2 py-2">
				<a class="nav-link text-white font-weight-bolder" href="visitar.php">Visitar</a>
			  </li>
			</ul>
		  </div>
	</nav>
	<!--Fin menú-->
	
	<!--SECTION PRINCIPAL------------------------------------------------------------------------------------------------------------->
	<section class="container-fluid b_amarillo">
		<div class="container py-5">
			<!--PESTAÑAS--------------------------------------------------------------------------------------------------------->
			<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="bebe-tab" data-toggle="tab" href="#bebe" role="tab" aria-controls="bebe" aria-selected="true">Bebé</a>
			  	</li>
			  	<li class="nav-item" role="presentation">
					<a class="nav-link" id="progenitores-tab" data-toggle="tab" href="#progenitores" role="tab" aria-controls="progenitores" aria-selected="false">Progenitores</a>
			  	</li>
			  	<li class="nav-item" role="presentation">
					<a class="nav-link" id="embarazo-tab" data-toggle="tab" href="#embarazo" role="tab" aria-controls="embarazo" aria-selected="false">Embarazo</a>
			  	</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="crecimiento-tab" data-toggle="tab" href="#crecimiento" role="tab" aria-controls="crecimiento" aria-selected="true">Crecimiento</a>
			  	</li>
			  	<li class="nav-item" role="presentation">
					<a class="nav-link" id="dentadura-tab" data-toggle="tab" href="#dentadura" role="tab" aria-controls="dentadura" aria-selected="false">Dientes</a>
			  	</li>
			  	<li class="nav-item" role="presentation">
					<a class="nav-link" id="anecdotas-tab" data-toggle="tab" href="#anecdotas" role="tab" aria-controls="anecdotas" aria-selected="false">Anécdotas</a>
			  	</li>
			</ul>
			<!--Fin pestañas-->
			
			<!--CONTENIDO PESTAÑAS---------------------------------------------------------------------------------------------->
			<div class="tab-content todoAlto" id="myTabContent">
				
				<!--BEBÉ-------------------------------------------------------------------------------------------------------->
				<div class="tab-pane fade show active" id="bebe" role="tabpanel" aria-labelledby="bebe-tab">
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
						  	<button type="guardar" class="btn b_amarillo text-white mx-4 mb-4">Guardar</button>
						</form>
				  </div>				  
				</div>
				<!--Fin bebé-->	  

				<!--PROGENITORES------------------------------------------------------------------------------------------------>
				<div class="tab-pane fade" id="progenitores" role="tabpanel" aria-labelledby="progenitores-tab">
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
							<hr class="b_amarillo">
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
							<hr class="b_amarillo">
							<div class="form-group my-5 mx-4">
								<label for="descripcionProgenitor">Descripción progenitor</label>
								<textarea rows="3" class="form-control" id="descripcionProgenitor" aria-describedby="helpDescripcion"></textarea>
								<small id="helpDescripcion" class="form-text text-muted">Escribe una pequeña frase que te definiera cuando os enterásteis de que seríais más en la familia.</small>
							</div>
							<div class="custom-file my-5 mx-4 w-75 d-block">
								<input type="file" class="custom-file-input" id="imgProgenitor" lang="es">
								<label class="custom-file-label" for="imgProgenitor">Seleccionar Archivo</label>
							</div>
						  	<button type="guardar" class="btn b_amarillo text-white mx-4 mb-4">Guardar</button>
						</form>
					</div>
				</div>
				<!--Fin progenitor-->
				
				<!--EMBARAZO---------------------------------------------------------------------------------------------------->
			  	<div class="tab-pane fade" id="embarazo" role="tabpanel" aria-labelledby="embarazo-tab">
					<div class="container py-3">
						<form>
							<div class="row py-3 px-4 mb-4">
						  		<div class="col-sm-12 col-md-6">
							  		<div class="form-group">
										<label for="semanasEmbarazo">Semanas de embarazo</label>
										<input type="number" class="form-control" id="semanasEmbarazo">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-6">
							  		<div class="form-group">
										<label for="diasEmbarazo">+ Días de embarazo</label>
										<input type="number" class="form-control" id="diasEmbarazo" aria-describedby="helpEmbarazo">
										<small id="helpEmbarazo" class="form-text text-muted">No siempre nacen con 'x' semanas justas ;)</small>
						  			</div>
							  	</div>
						  	</div>
							<hr class="b_amarillo">
						  	<div class="row py-4 px-4">
								<div class="col-sm-12 col-md-6">
						   			<div class="form-group">
										<label for="kgAumento">Kg que la madre engordó en el embarazo</label>
										<input type="text" class="form-control" id="kgAumento">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-6">
								  	<div class="form-group">
										<label for="fechaNoticia">Fecha de la noticia</label>
										<input type="date" class="form-control" id="fechaNoticia" aria-describedby="helpNoticia">
										<small id="helpNoticia" class="form-text text-muted">Ese día en que os enterásteis de que crecía la familia.</small>
								  	</div>
						  		</div>
						  	</div>
						  	<button type="guardar" class="btn b_amarillo text-white mx-4 mb-4">Guardar</button>
						</form>
				  </div>
				</div>
				<!--Fin embarazo-->
				
				<!--CRECIMIENTO------------------------------------------------------------------------------------------------->
				<div class="tab-pane fade" id="crecimiento" role="tabpanel" aria-labelledby="crecimiento-tab">
					<div class="container py-3">
						<form>
							<div class="row py-3 px-4 mb-4 justify-content-between">
						  		<div class="col-sm-12 col-md-4">
							  		<div class="form-group">
										<label for="fechaDatos">Fecha de los datos</label>
										<input type="date" class="form-control" id="fechaDatos">
								  	</div>
							  	</div>
								<div class="col-sm-12 col-md-8">
							  		<div class="form-group">
										<label for="listaDatos">Fecha de los datos</label>
										<textarea rows="1" class="form-control" id="listaDatos">Aquí listar los datos de la tabla</textarea>
								  	</div>
							  	</div>
						  	</div>
							<hr class="b_amarillo">
						  	<div class="row py-4 px-4 justify-content-between">
								<div class="col-sm-12 col-md-4">
							  		<div class="form-group">
										<label for="altura">Altura</label>
										<input type="text" class="form-control" id="altura">
						  			</div>
							  	</div>
								<div class="col-sm-12 col-md-4">
						   			<div class="form-group">
										<label for="peso">Peso</label>
										<input type="text" class="form-control" id="peso">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-4">
								  	<div class="form-group">
										<label for="cabeza">Contorno de cabeza</label>
										<input text="date" class="form-control" id="cabeza">
								  	</div>
						  		</div>
						  	</div>
						  	<button type="guardar" class="btn b_amarillo text-white mx-4 mb-4">Guardar</button>
						</form>
				  </div>
				</div>
				<!--Fin crecimiento-->
				
				<!--DENTADURA--------------------------------------------------------------------------------------------------->
			  	<div class="tab-pane fade" id="dentadura" role="tabpanel" aria-labelledby="dentadura-tab">
					<div class="container py-3">
						<form>
							<div class="row py-3 px-4 mb-4 justify-content-between">
						  		<div class="col-sm-12 col-md-4">
							  		<div class="form-group">
										<label for="fechaDiente">Fecha de salida del diente</label>
										<input type="date" class="form-control" id="fechaDiente">
								  	</div>
							  	</div>
								<div class="col-sm-12 col-md-8">
							  		<div class="form-group">
										<label for="listaDientes">Listado</label>
										<textarea rows="1" class="form-control" id="listaDientes">Aquí listar los datos de la tabla</textarea>
								  	</div>
							  	</div>
						  	</div>
							<hr class="b_amarillo">
						  	<div class="row py-4 px-4 justify-content-between">
								<div class="col-sm-12 col-md-4">
							  		<div class="form-group">
										<label for="ordenDiente">Orden de salida</label>
										<select name="ordenDiente" class="form-control" id="ordenDiente">
											<option value="1">1</option>
										  	<option value="2">2</option>
										  	<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										  	<option value="6">6</option>
										  	<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
										  	<option value="10">10</option>
										  	<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
										  	<option value="14">14</option>
										  	<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
										  	<option value="18">18</option>
										  	<option value="19">19</option>
											<option value="20">20</option>
										</select>
						  			</div>
							  	</div>
								<div class="col-sm-12 col-md-8">
						   			<div class="form-group">
										<label for="nombreDiente">Orden de salida</label>
										<select name="nombreDiente" class="form-control" id="nombreDiente">
											<option value="Incisivo central izquierdo superior">Incisivo central izquierdo superior</option>
										  	<option value="Incisivo central derecho superior">Incisivo central derecho superior</option>
										  	<option value="Incisivo lateral izquierdo superior">Incisivo lateral izquierdo superior</option>
											<option value="Incisivo lateral derecho superior">Incisivo lateral derecho superior</option>
											<option value="Canino izquierdo superior">Canino izquierdo superior</option>
										  	<option value="Canino derecho superior">Canino derecho superior</option>
										  	<option value="Primer molar izquierdo superior">Primer molar izquierdo superior</option>
											<option value="Primer molar derecho superior">Primer molar derecho superior</option>
											<option value="Segundo molar izquierdo superior">Segundo molar izquierdo superior</option>
										  	<option value="Segundo molar derecho superior">Segundo molar derecho superior</option>
										  	<option value="Incisivo central izquierdo inferior">Incisivo central izquierdo inferior</option>
											<option value="Incisivo central derecho inferior">Incisivo central derecho inferior</option>
											<option value="Incisivo lateral izquierdo inferior">Incisivo lateral izquierdo inferior</option>
										  	<option value="Incisivo lateral derecho inferior">Incisivo lateral derecho inferior</option>
										  	<option value="Canino izquierdo inferior">Canino izquierdo inferior</option>
											<option value="Canino derecho inferior">Primer molar izquierdo inferior</option>
											<option value="Primer molar izquierdo inferior">Primer molar izquierdo inferior</option>
										  	<option value="Primer molar derecho inferior">Primer molar derecho inferior</option>
										  	<option value="Segundo molar izquierdo inferior">Segundo molar izquierdo inferior</option>
											<option value="Segundo molar derecho inferior">Segundo molar derecho inferior</option>
										</select>
						  			</div>
							  	</div>
						  	</div>
						  	<button type="guardar" class="btn b_amarillo text-white mx-4 mb-4">Guardar</button>
						</form>
				  </div>
				</div>
				<!--Fin dentadura-->
				
				<!--ANÉCDOTA----------------------------------------------------------------------------------------------------------------->
			  	<div class="tab-pane fade" id="anecdotas" role="tabpanel" aria-labelledby="anecdotas-tab">
					<div class="container py-3">
						<form>
							<div class="row py-3 px-4 mb-4 justify-content-around">
						  		<div class="col-sm-12 col-md-4">
							  		<div class="form-group">
										<label for="fechaAnecdota">Fecha de la anécdota</label>
										<input type="date" class="form-control" id="fechaAnecdota">
								  	</div>
							  	</div>
								<div class="col-sm-12 col-md-8">
							  		<div class="form-group">
										<label for="listaAnecdotas">Listado</label>
										<textarea rows="1" class="form-control" id="listaAnecdotas">Aquí listar los datos de la tabla</textarea>
								  	</div>
							  	</div>
						  	</div>
							<hr class="b_amarillo">
						  	<div class="row py-4 px-4 justify-content-between">
								<div class="col-sm-12 col-md-4">
							  		<div class="form-group">
										<label for="descripcionAnecdota">Título de la anécdota</label>
										<input type="text" class="form-control" id="descripcionAnecdota" placeholder="Ej. Primera palabra, primer gateo, primeros pasos, primer amigo...">
						  			</div>
							  	</div>
								<div class="col-sm-12 col-md-4">
						   			<div class="form-group">
										<label for="nombreAnecdota">Descripción de la anécdota</label>
										<input type="text" class="form-control" id="nombreAnecdota" placeholder="Ej. mamá (primera palabra), Adriana (primer amigo)... ">
								  	</div>
							  	</div>
							  	<div class="col-sm-12 col-md-4">
								  	<div class="form-group">
										<label for="lugarAnecdota">Lugar de la anécdota</label>
										<input text="date" class="form-control" id="lugarAnecdota" placeholder="Ej. nuestra casa (primera palabra), Paseo Marítimo de A Coruña (primeros pasos),...">
								  	</div>
						  		</div>
						  	</div>
							<hr class="b_amarillo">
						  	<div class="row py-4 px-4 justify-content-between align-content-baseline">
								<div class="col-sm-12 col-md-6">
									<div class="custom-file mt-4 w-100 d-block">
										<input type="file" class="custom-file-input" id="mediaAnecdota" lang="es">
										<label class="custom-file-label" for="mediaAnecdota">¿Tienes un vídeo o imagen?</label>
									</div>
							  	</div>
								<div class="col-sm-12 col-md-6">
						   			<div class="form-group">
										<label for="urlAnecdota">¿Hay algún vídeo o canción en la web a la que hacer referencia?</label>
										<input type="url" class="form-control" id="urlAnecdota">
								  	</div>
							  	</div>
						  	</div>
						  	<button type="guardar" class="btn b_amarillo text-white mx-4 mb-4">Guardar</button>
						</form>
				  </div>
				</div>
				<!--Fin anécdota-->
				
			</div>
		</div> 
	</section>
	
	
	
	<!--FOOTER-->	
	<footer class="container-fluid bg-dark blanco textofooter py-4 alfondo">
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

											