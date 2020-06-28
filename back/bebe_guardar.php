<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $nombreBebe = htmlentities(addslashes($_POST['nombreBebe']));
    $apellidosBebe = htmlentities(addslashes($_POST['apellidosBebe']));
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $horaNacimiento = $_POST['horaNacimiento'];
    $lugarNacimiento = htmlentities(addslashes($_POST['lugarNacimiento']));
    $ciudadNacimiento = htmlentities(addslashes($_POST['ciudadNacimiento']));
    //$grupoSanguineo = $_POST['grupoSanguineo']; Porque da error el select. Carga más items de los que son. PENDIENTE DE MIRAR.
    $grupoSanguineo = htmlentities(addslashes($_POST['grupoSanguineo']));
    //Falta imagen. Pendiente de hacerlo con $_FILES
    $imgNacimiento = null;
    $dedicatoriaBebe = htmlentities(addslashes($_POST['dedicatoriaBebe']));
    $idUsuario = $_SESSION['idUsuario'];

	//comprobar si el bebe existe
	$buscarBebe = $conexion->prepare("SELECT * FROM bebe WHERE nombreBebe = '$nombreBebe' AND apellidosBebe = '$apellidosBebe' AND fechaNacimiento = '$fechaNacimiento' AND horaNacimiento = '$horaNacimiento' AND lugarNacimiento = '$lugarNacimiento' AND ciudadNacimiento = '$ciudadNacimiento'  LIMIT 1");
    $buscarBebe->bindParam(':nombreBebe', $nombreBebe, PDO::PARAM_STR);
    $buscarBebe->bindParam(':apellidosBebe', $apellidosBebe, PDO::PARAM_STR);
    $buscarBebe->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
    $buscarBebe->bindParam(':horaNacimiento', $horaNacimiento, PDO::PARAM_STR);
    $buscarBebe->bindParam(':lugarNacimiento', $lugarNacimiento, PDO::PARAM_STR);
    $buscarBebe->bindParam(':ciudadNacimiento', $ciudadNacimiento, PDO::PARAM_STR);
	$buscarBebe->execute();

	//si existe
	if($buscarBebe->rowCount() == 1) {
		$array_respuesta['error'] = "Ya existe un bebé con estos datos";
        $array_respuesta['guardado'] = false;
	} else {
		$nuevoBebe = $conexion->prepare('INSERT INTO bebe (nombreBebe, apellidosBebe, fechaNacimiento, horaNacimiento, lugarNacimiento, ciudadNacimiento, grupoSanguineo, imgNacimiento, dedicatoriaBebe, idUsuario) VALUES(:nombreBebe, :apellidosBebe, :fechaNacimiento, :horaNacimiento, :lugarNacimiento, :ciudadNacimiento, :grupoSanguineo, :imgNacimiento, :dedicatoriaBebe, :idUsuario)');
		$nuevoBebe->bindParam(':nombreBebe', $nombreBebe, PDO::PARAM_STR);
		$nuevoBebe->bindParam(':apellidosBebe', $apellidosBebe, PDO::PARAM_STR);
		$nuevoBebe->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
		$nuevoBebe->bindParam(':horaNacimiento', $horaNacimiento, PDO::PARAM_STR);
        $nuevoBebe->bindParam(':lugarNacimiento', $lugarNacimiento, PDO::PARAM_STR);
        $nuevoBebe->bindParam(':ciudadNacimiento', $ciudadNacimiento, PDO::PARAM_STR);
		$nuevoBebe->bindParam(':grupoSanguineo', $grupoSanguineo, PDO::PARAM_STR);
        $nuevoBebe->bindParam(':imgNacimiento', $imgNacimiento, PDO::PARAM_STR);
        $nuevoBebe->bindParam(':dedicatoriaBebe', $dedicatoriaBebe, PDO::PARAM_STR);
        $nuevoBebe->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
		$nuevoBebe->execute();

		$nuevoBebeId = $conexion->lastInsertId();

		$_SESSION['idBebe'] = $nuevoBebeId;
		$_SESSION['nombreBebe'] = $nombreBebe;
		$array_respuesta['redireccion'] = 'crear_progenitores.php';
		$array_respuesta['guardado'] = true;
	}

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>