<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $fechaDatos = $_POST['fechaDatos'];
    $altura = htmlentities(addslashes($_POST['altura']));
    $peso = htmlentities(addslashes($_POST['peso']));
    $cabeza = htmlentities(addslashes($_POST['cabeza']));
    $idBebe = $_SESSION['idBebe'];

	//comprobar si el crecimiento existe
	$buscarCrecimiento = $conexion->prepare("SELECT * FROM crecimiento WHERE fechaDatos = '$fechaDatos' AND idBebe = '$idBebe'  LIMIT 1");
    $buscarCrecimiento->bindParam(':fechaDatos', $fechaDatos, PDO::PARAM_STR);
    $buscarCrecimiento->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
    $buscarCrecimiento->execute();
    
    
	//si existe
	if($buscarCrecimiento->rowCount() == 1) {
		$array_respuesta['error'] = "Ya existen datos guardados en esa fecha.";
        $array_respuesta['guardado'] = false;
    } else {
		$nuevoCrecimiento = $conexion->prepare('INSERT INTO crecimiento (idBebe, fechaDatos, altura, peso, cabeza) VALUES(:idBebe, :fechaDatos, :altura, :peso, :cabeza)');
		$nuevoCrecimiento->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
		$nuevoCrecimiento->bindParam(':fechaDatos', $fechaDatos, PDO::PARAM_STR);
		$nuevoCrecimiento->bindParam(':altura', $altura, PDO::PARAM_STR);
		$nuevoCrecimiento->bindParam(':peso', $peso, PDO::PARAM_STR);
        $nuevoCrecimiento->bindParam(':cabeza', $cabeza, PDO::PARAM_STR);
		$nuevoCrecimiento->execute();

		$nuevoCrecimientoId = $conexion->lastInsertId();
		$array_respuesta['guardado'] = true;
	} 

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>