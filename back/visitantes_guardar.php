<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $nombreUsuario = htmlentities(addslashes($_POST['nombreUsuario']));
	$apellidosUsuario = htmlentities(addslashes($_POST['apellidosUsuario']));
	$email = strtolower($_POST['email']);
	$pass = md5($_POST['pass']);
    $rol = $_POST['rol'];
    
    $idBebe = $_SESSION['idBebe'];


	//comprobar si el usuario existe
	$buscarUsuario = $conexion->prepare("SELECT * FROM usuario WHERE email = '$email'");
    $buscarUsuario->bindParam(':email', $email, PDO::PARAM_STR);
    $buscarUsuario->execute();
    

	//si existe
	if($buscarUsuario->rowCount() == 1) {
		$array_respuesta['error'] = "Ya existe un usuario creador con ese email";
        $array_respuesta['guardado'] = false;
    } else {
        try {
		$nuevoUsuario = $conexion->prepare('INSERT INTO usuario (nombreUsuario, apellidosUsuario, email, pass, rol) VALUES(:nombreUsuario, :apellidosUsuario, :email, :pass, :rol)');
        $nuevoUsuario->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
		$nuevoUsuario->bindParam(':apellidosUsuario', $apellidosUsuario, PDO::PARAM_STR);
		$nuevoUsuario->bindParam(':email', $email, PDO::PARAM_STR);
		$nuevoUsuario->bindParam(':pass', $pass, PDO::PARAM_STR);
        $nuevoUsuario->bindParam(':rol', $rol, PDO::PARAM_STR);
		$nuevoUsuario->execute();

        $idUsuario = $conexion->lastInsertId();

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        try {
            //Buscamos el usuario guardado
            $buscarCreado = $conexion->prepare("SELECT * FROM usuario WHERE idUsuario = '$idUsuario'");
            $buscarCreado->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $buscarCreado->execute();

            if($buscarCreado->rowCount() == 1){
                $mismoUsuario = $conexion-> prepare('INSERT INTO visitas (idBebe, idUsuario) VALUES(:idBebe, :idUsuario)');
                $mismoUsuario->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
                $mismoUsuario->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
                $mismoUsuario->execute();
        
                $idVisitas = $conexion->lastInsertId();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        
		$array_respuesta['guardado'] = true;
	} 

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>