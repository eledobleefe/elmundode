<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $idDentadura = $_POST['idDentadura'];
    $fechaDiente = $_POST['fechaDiente'];
    $ordenDiente = $_POST['ordenDiente'];
    $nombreDiente = $_POST['nombreDiente'];
    
    $idBebe = $_SESSION['idBebe'];

	//comprobar si el diente existe
	$buscarDentadura = $conexion->prepare("SELECT * FROM dentadura WHERE idDentadura = '$idDentadura' LIMIT 1");
    $buscarDentadura->bindParam(':idDentadura', $idDentadura, PDO::PARAM_INT);
	$buscarDentadura->execute();

	//comprobar si el orden existe
	$buscarOrden = $conexion->prepare("SELECT * FROM dentadura WHERE ordenDiente = '$ordenDiente' AND idBebe = '$idBebe' LIMIT 1");
    $buscarOrden->bindParam(':ordenDiente', $ordenDiente, PDO::PARAM_INT);
	$buscarOrden->execute();

	$dentaduraActual = $buscarDentadura->fetch();
	$idDentaduraActual = $dentaduraActual['idDentadura'];
	$dentaduraOrden = $buscarOrden->fetch();
	$idDentaduraOrden = $dentaduraOrden['idDentadura'];

	//si existe
	if($buscarDentadura->rowCount() == 0) {
		$array_respuesta['error'] = "No existe dicho diente aún";
        $array_respuesta['editado'] = false;
	} else if ($buscarOrden->rowCount() == 1 && $dentaduraActual !== $dentaduraOrden) {
		$array_respuesta['error'] = "Ya existe un diente en ese orden";
        $array_respuesta['editado'] = false;
 	} else  {
		$dentaduraEditada = $conexion->prepare("UPDATE dentadura SET fechaDiente = '$fechaDiente', ordenDiente = '$ordenDiente', nombreDiente = '$nombreDiente' WHERE idDentadura = '$idDentadura'");
		$dentaduraEditada->bindParam(':fechaDiente', $fechaDiente, PDO::PARAM_STR);
		$dentaduraEditada->bindParam(':ordenDiente', $ordenDiente, PDO::PARAM_STR);
		$dentaduraEditada->bindParam(':nombreDiente', $nombreDiente, PDO::PARAM_STR);
        $dentaduraEditada->bindParam(':idDentadura', $idDentadura, PDO::PARAM_INT);
        $dentaduraEditada->execute();
        
		$array_respuesta['editado'] = "Vaya dentadura se está formando";
	}

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>