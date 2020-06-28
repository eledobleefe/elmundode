<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $fechaAnecdota = $_POST['fechaAnecdota'];
    $nombreAnecdota = htmlentities(addslashes($_POST['nombreAnecdota']));
    $lugarAnecdota = htmlentities(addslashes($_POST['lugarAnecdota']));
    $descripcionAnecdota = htmlentities(addslashes($_POST['descripcionAnecdota']));
    $extraAnecdota = htmlentities(addslashes($_POST['extraAnecdota']));
    $tipoExtra = $_POST['tipoExtra'];
    $idBebe = $_SESSION['idBebe'];


	//comprobar si la anécdota existe
	$buscarAnecdota = $conexion->prepare("SELECT * FROM anecdota WHERE idBebe = '$idBebe' AND nombreAnecdota = '$nombreAnecdota' LIMIT 1");
    $buscarAnecdota->bindParam(':nombreAnecdota', $nombreAnecdota, PDO::PARAM_STR);
    $buscarAnecdota->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
    $buscarAnecdota->execute();
    

	//si existe
	if($buscarAnecdota->rowCount() == 1) {
		$array_respuesta['error'] = "Ya existe una anécdota con ese nombre";
        $array_respuesta['guardado'] = false;
    } else {
        try {
		$nuevaAnecdota = $conexion->prepare('INSERT INTO anecdota (idBebe, fechaAnecdota, nombreAnecdota, lugarAnecdota, descripcionAnecdota, extraAnecdota, tipoExtra) VALUES(:idBebe, :fechaAnecdota, :nombreAnecdota, :lugarAnecdota, :descripcionAnecdota, :extraAnecdota, :tipoExtra)');
		$nuevaAnecdota->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $nuevaAnecdota->bindParam(':fechaAnecdota', $fechaAnecdota, PDO::PARAM_STR);
		$nuevaAnecdota->bindParam(':nombreAnecdota', $nombreAnecdota, PDO::PARAM_STR);
		$nuevaAnecdota->bindParam(':lugarAnecdota', $lugarAnecdota, PDO::PARAM_STR);
		$nuevaAnecdota->bindParam(':descripcionAnecdota', $descripcionAnecdota, PDO::PARAM_STR);
        $nuevaAnecdota->bindParam(':extraAnecdota', $extraAnecdota, PDO::PARAM_STR);
        $nuevaAnecdota->bindParam(':tipoExtra', $tipoExtra, PDO::PARAM_STR);
		$nuevaAnecdota->execute();

		$nuevaAnecdotaId = $conexion->lastInsertId();
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