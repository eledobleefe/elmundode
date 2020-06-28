<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $fechaDiente = htmlentities(addslashes($_POST['fechaDiente']));
    $ordenDiente = $_POST['ordenDiente'];
    $nombreDiente = $_POST['nombreDiente'];
    
    $idBebe = $_SESSION['idBebe'];

	//comprobar si la dentadura existe
	$buscarDentadura = $conexion->prepare("SELECT * FROM dentadura WHERE nombreDiente = '$nombreDiente' AND idBebe = '$idBebe' LIMIT 1");
    $buscarDentadura->bindParam(':nombreDiente', $nombreDiente, PDO::PARAM_STR);
    $buscarDentadura->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
    $buscarDentadura->execute();
	
	//comprobar si ya existe un diente en ese orden
	$buscarOrden = $conexion->prepare("SELECT * FROM dentadura WHERE ordenDiente = '$ordenDiente' AND idBebe = '$idBebe' LIMIT 1");
    $buscarOrden->bindParam(':ordenDiente', $ordenDiente, PDO::PARAM_STR);
    $buscarOrden->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
    $buscarOrden->execute();

    //comprobar cuantas dentaduras tiene el bebe
	$buscarDentaduras = $conexion->prepare("SELECT * FROM dentadura WHERE idBebe = '$idBebe'");
    $buscarDentaduras->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
    $buscarDentaduras->execute();

	//si existe
	if($buscarDentadura->rowCount() == 1) {
		$array_respuesta['error'] = "Ya existe ese diente para este bebé";
        $array_respuesta['guardado'] = false;
	} else if($buscarOrden->rowCount() == 1) {
		$array_respuesta['error'] = "Ya existe un diente en este orden";
        $array_respuesta['guardado'] = false;	
	} else {
		$nuevaDentadura = $conexion->prepare('INSERT INTO dentadura (idBebe, fechaDiente, ordenDiente, nombreDiente) VALUES(:idBebe, :fechaDiente, :ordenDiente, :nombreDiente)');
		$nuevaDentadura->bindParam(':fechaDiente', $fechaDiente, PDO::PARAM_STR);
		$nuevaDentadura->bindParam(':ordenDiente', $ordenDiente, PDO::PARAM_STR);
		$nuevaDentadura->bindParam(':nombreDiente', $nombreDiente, PDO::PARAM_STR);
        $nuevaDentadura->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
		$nuevaDentadura->execute();

		$nuevaDentaduraId = $conexion->lastInsertId();

		$array_respuesta['guardado'] = true;
	} 

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>