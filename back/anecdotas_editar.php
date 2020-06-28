<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $idBebe = $_SESSION['idBebe'];
	$idAnecdota = $_POST['idAnecdota'];
	$fechaAnecdota = $_POST['fechaAnecdota'];
    $nombreAnecdota = htmlentities(addslashes($_POST['nombreAnecdota']));
    $lugarAnecdota = htmlentities(addslashes($_POST['lugarAnecdota']));
    $descripcionAnecdota = htmlentities(addslashes($_POST['descripcionAnecdota']));
    $extraAnecdota = htmlentities(addslashes($_POST['extraAnecdota']));
    $tipoExtra = htmlentities(addslashes($_POST['tipoExtra']));

	//comprobar si la anécdota existe
	$buscarAnecdota = $conexion->prepare("SELECT * FROM anecdota WHERE idAnecdota = '$idAnecdota' LIMIT 1");
    $buscarAnecdota->bindParam(':idAnecdota', $idAnecdota, PDO::PARAM_INT);
	$buscarAnecdota->execute();

	//si existe
	if($buscarAnecdota->rowCount() == 0) {
		$array_respuesta['error'] = "En el cofre de las anécdotas no existe ninguna como esa";
        $array_respuesta['editado'] = false;
	} else {
		$progenitorEditado = $conexion->prepare("UPDATE anecdota SET fechaAnecdota = '$fechaAnecdota', nombreAnecdota = '$nombreAnecdota', lugarAnecdota = '$lugarAnecdota', descripcionAnecdota = '$descripcionAnecdota' WHERE idBebe = '$idBebe' AND idAnecdota = '$idAnecdota' ");
		$progenitorEditado->bindParam(':fechaAnecdota', $fechaAnecdota, PDO::PARAM_STR);
		$progenitorEditado->bindParam(':nombreAnecdota', $nombreAnecdota, PDO::PARAM_STR);
		$progenitorEditado->bindParam(':lugarAnecdota', $lugarAnecdota, PDO::PARAM_STR);
        $progenitorEditado->bindParam(':descripcionAnecdota', $descripcionAnecdota, PDO::PARAM_STR);
		$progenitorEditado->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $progenitorEditado->bindParam(':idAnecdota', $idAnecdota, PDO::PARAM_INT);
        
        $progenitorEditado->execute();
        
		$array_respuesta['editado'] = true;
	}

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>