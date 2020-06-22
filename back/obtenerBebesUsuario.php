<?php

require_once "Conexion.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


function obtenerBebesUsuario($idUsuario, $nombreUsuario){
	
	$conexion = Conexion::conectar();
	
	try {
		$buscarBebe = $conexion->prepare("SELECT * FROM bebe WHERE idUsuario = '$idUsuario'");
		$buscarBebe->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
		$buscarBebe->execute();
		$listaBebes = $buscarBebe->fetchAll();
		$cardBebes = "";
		$contador = 0;

		if($buscarBebe->rowCount() != 0) {
			
			$cardBebes =  "<h1 id='misMundos' class='display-4 font-weight-normal text-white text-center pt-5'>¡Hola " . $nombreUsuario . "!</h1>
		<p class='text-white text-center m-5'>Recuerda que, como máximo, puedes crear tres mundos. <br/>¡Manos a la obra!</p>
		<div class='row row-cols-1 row-cols-md-3 justify-content-around align-items-center'>";
			
			foreach ($listaBebes as $unBebe){
				$cardBebes .= "
				<div class='col mb-4'>
					<div class='card sombra m-5 mx-md-1'>
					  <img src='img/elmundode/imagenPrueba_2.png' class='card-img-top' alt='imgPrueba'>
					  <div class='card-body text-center'>
						<h5 class='card-title'> El mundo de <br/>" . $unBebe['nombreBebe'] . " " . $unBebe['apellidosBebe'] . "</h5>
						<p class='card-text'>Nació el " . $unBebe['fechaNacimiento'] . " a las " . $unBebe['horaNacimiento'] . " en " . $unBebe['ciudadNacimiento'] . ".</p>
					  </div>
						<!--<form method='post' class='m-auto cardBebe'>
							<div class='form-group d-none'>
								<label for='idBebeElegido'>IdBebe:</label>
								<input type='text' class='form-control' id='idBebeElegido' name='idBebeElegido' value='" . $unBebe['idBebe'] . "'>
							</div>-->
							<div class='btn-group btn-group-md mb-3 mx-3' role='group' aria-label='idBebe'>
								<button type='submit' name='btnVerMundo' class='btn b_verdeClaro text-white' onclick='verMundoBebe(" . $unBebe['idBebe'] . ")'><i class='fas fa-globe-africa text-white mr-2'></i>Ver</button>
								<button type='submit' name='btnEditarBebe' class='btn b_verdeClaro text-white' onclick='obtenerDatosBebe(" . $unBebe['idBebe'] . ")'><i class='fas fa-edit text-white mr-2'></i>Editar</button>
								<button type='submit' name='btnBorrarBebe' class='btn b_verdeClaro text-white' onclick='eliminarBebe(" . $unBebe['idBebe'] . ")'><i class='far fa-trash-alt text-white mr-2'></i>Borrar</button>
							</div>
						<!-- </form> -->
					</div>
				</div>";
			$contador++;
		}


		if (count($listaBebes) < 3) {
			
			while ($contador < 3) {
				$cardBebes .= "<div class='col mb-4'>
									<a href='crear_bebes.php'><img src='img/elmundode/anadir.svg' class='card-img-top w-50 mx-auto mt-3 d-block'  alt='imgPrueba'></a>
									<a class='btn bg-white sombra my-5 mx-auto d-block verde w-50' href='crear_bebes.php' role='button'>Añadir bebé</a>
							 </div>";
				$contador++;
			}
		}
		
		$cardBebes .= "</div>"; 
			
	} else if (count($listaBebes) === 0) {
		$cardBebes .="<div class='col-md-8 p-lg-5 mx-auto py-5 my-auto text-center'>
						<h1 class='display-4 font-weight-normal text-white'>¡Hola " . $nombreUsuario . "!</h1>
        				<p class='lead font-weight-normal text-white'>Aún no nos has contado nada sobre tu bebé ni construído un mundo para él.<br/> ¡¿A qué esperas?!</p>
        				<a class='btn bg-white verde sombra' href='crear_bebes.php'>Empieza a crear</a>
    				</div>";
	}
	return $cardBebes;
		
	} catch(PDOException $e) {
		die("Error: " . $e->getMessagge());
	}
	
	$conexion = Conexion::desconectar();

}
?>