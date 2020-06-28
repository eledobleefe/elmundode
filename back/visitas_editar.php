<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $idVisitas = $_POST['idVisitas'];
    $nombreUsuario = htmlentities(addslashes($_POST['nombreUsuario']));
	$apellidosUsuario = htmlentities(addslashes($_POST['apellidosUsuario']));
	$email = strtolower($_POST['email']);
	$pass = md5($_POST['pass']);
    $idBebe = $_SESSION['idBebe'];

	//comprobar si el visitante existe
	$buscarVisitante = $conexion->prepare("SELECT * FROM visitas WHERE idVisitas = '$idVisitas' LIMIT 1");
    $buscarVisitante->bindParam(':idVisitas', $idVisitas, PDO::PARAM_INT);
	$buscarVisitante->execute();

	//si existe
	if($buscarVisitante->rowCount() == 0) {
		$array_respuesta['error'] = "No existe dicho visitante";
        $array_respuesta['editado'] = false;
	} else {
        $visitante = $buscarVisitante->fetch();
        $idUsuario = $visitante['idUsuario'];
		$visitanteEditado = $conexion->prepare("UPDATE usuario SET nombreUsuario = '$nombreUsuario', apellidosUsuario = '$apellidosUsuario', email = '$email', pass = '$pass' WHERE idUsuario = '$idUsuario'");
		$visitanteEditado->bindParam(':nombreUsuario', $nombreProgenitor, PDO::PARAM_STR);
		$visitanteEditado->bindParam(':apellidosUsuario', $apellidosProgenitor, PDO::PARAM_STR);
		$visitanteEditado->bindParam(':email', $email, PDO::PARAM_STR);
        $visitanteEditado->bindParam(':pass', $pass, PDO::PARAM_STR);
		$visitanteEditado->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $visitanteEditado->execute();
        
		$array_respuesta['editado'] = "Visitante editado con éxito";
	}

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>