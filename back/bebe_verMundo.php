<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
	$array_respuesta=[];
	$idBebe = $_POST['idBebe'];
	
	//comprobar si el bebe existe
	$buscarBebe = $conexion->prepare("SELECT * FROM bebe WHERE idBebe = '$idBebe' LIMIT 1");
	$buscarBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_STR);
	$buscarBebe->execute();
	
	//si existe
	if($buscarBebe->rowCount() == 1) {
        $unBebe = $buscarBebe->fetch(PDO::FETCH_ASSOC);
        $_SESSION['idBebe'] = $idBebe;
        $_SESSION['nombreBebe'] = $unBebe['nombreBebe'];
        $array_respuesta['redireccion'] = "visitar_mundos.php";
			
	} else {
		$array_respuesta['error'] = "Ha surgido un error";
	}
	
	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>