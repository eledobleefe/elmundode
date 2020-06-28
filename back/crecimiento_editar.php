<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $idBebe = $_SESSION['idBebe'];
	$idCrecimiento = $_POST['idCrecimiento'];
	$fechaDatos = htmlentities(addslashes($_POST['fechaDatos']));
    $altura = htmlentities(addslashes($_POST['altura']));
    $peso = htmlentities(addslashes($_POST['peso']));
    $cabeza = htmlentities(addslashes($_POST['cabeza']));

	//comprobar si el crecimiento existe
	$buscarCrecimiento = $conexion->prepare("SELECT * FROM crecimiento WHERE idCrecimiento = '$idCrecimiento' LIMIT 1");
    $buscarCrecimiento->bindParam(':idCrecimiento', $idCrecimiento, PDO::PARAM_INT);
	$buscarCrecimiento->execute();

	//si existe
	if($buscarCrecimiento->rowCount() == 0) {
		$array_respuesta['error'] = "No existen datos en esta fechas";
        $array_respuesta['editado'] = false;
	} else {
		$progenitorEditado = $conexion->prepare("UPDATE crecimiento SET fechaDatos = '$fechaDatos', altura = '$altura', peso = '$peso', cabeza = '$cabeza' WHERE idBebe = '$idBebe' AND idCrecimiento = '$idCrecimiento' ");
		$progenitorEditado->bindParam(':fechaDatos', $fechaDatos, PDO::PARAM_STR);
		$progenitorEditado->bindParam(':altura', $altura, PDO::PARAM_STR);
		$progenitorEditado->bindParam(':peso', $peso, PDO::PARAM_STR);
        $progenitorEditado->bindParam(':cabeza', $cabeza, PDO::PARAM_STR);
		$progenitorEditado->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
		$progenitorEditado->bindParam(':idCrecimiento', $idCrecimiento, PDO::PARAM_INT);
        $progenitorEditado->execute();
        
		$array_respuesta['editado'] = "Los datos se han editado con éxito.";
	}

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>