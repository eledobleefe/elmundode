<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
	$array_respuesta=[];
	$email = strtolower($_POST['email']);
	$pass = md5($_POST['pass']);
	
	//comprobar si el usuario existe
	$buscarUsuario = $conexion->prepare("SELECT * FROM usuario WHERE email = '$email' AND rol = 'visitante' LIMIT 1");
	$buscarUsuario->bindParam(':email', $email, PDO::PARAM_STR);
	$buscarUsuario->execute();
	
	//si existe
	if($buscarUsuario->rowCount() == 1) {
		$usuario = $buscarUsuario->fetch(PDO::FETCH_ASSOC);
		$idUsuario = $usuario['idUsuario'];
		$nombreUsuario = $usuario['nombreUsuario'];
		$password = $usuario['pass'];
		$rol = $usuario['rol'];
		if($pass === $password) {
			$_SESSION['idUsuario'] = $idUsuario;
			$_SESSION['nombreUsuario'] = $nombreUsuario;
			$_SESSION['email'] = $email;
			$_SESSION['rol'] = $rol;
            $array_respuesta['redireccion'] = 'visitar_mundos.php';
            
            

			
		} else {
			$array_respuesta['error'] = "Los datos no son válidos";
		}
		
	} else {
		
		$array_respuesta['error'] = "No tienes cuenta de visitante.";
	}
	
	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>