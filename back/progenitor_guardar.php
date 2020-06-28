<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $nombreProgenitor = htmlentities(addslashes($_POST['nombreProgenitor']));
    $apellidosProgenitor = htmlentities(addslashes($_POST['apellidosProgenitor']));
    $tipoProgenitor = $_POST['tipoProgenitor'];
    $fechaNProgenitor = $_POST['fechaNProgenitor'];
    $lugarNProgenitor = htmlentities(addslashes($_POST['lugarNProgenitor']));
    $descripcionProgenitor = htmlentities(addslashes($_POST['descripcionProgenitor']));
    //Falta imagen. Pendiente de hacerlo con $_FILES
    $imgProgenitor = null;
    $idBebe = $_SESSION['idBebe'];

	//comprobar si el progenitor existe
	$buscarProgenitor = $conexion->prepare("SELECT * FROM progenitor WHERE nombreProgenitor = '$nombreProgenitor' AND apellidosProgenitor = '$apellidosProgenitor' AND fechaNProgenitor = '$fechaNProgenitor' AND lugarNProgenitor = '$lugarNProgenitor' AND idBebe = '$idBebe'  LIMIT 1");
    $buscarProgenitor->bindParam(':nombreProgenitor', $nombreProgenitor, PDO::PARAM_STR);
    $buscarProgenitor->bindParam(':apellidosProgenitor', $apellidosProgenitor, PDO::PARAM_STR);
    $buscarProgenitor->bindParam(':fechaNProgenitor', $fechaNProgenitor, PDO::PARAM_STR);
    $buscarProgenitor->bindParam(':lugarNProgenitor', $lugarNProgenitor, PDO::PARAM_STR);
    $buscarProgenitor->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
    $buscarProgenitor->execute();
    
    //comprobar cuantos progenitores tiene el bebe
	$buscarProgenitores = $conexion->prepare("SELECT * FROM progenitor WHERE idBebe = '$idBebe'");
    $buscarProgenitores->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
    $buscarProgenitores->execute();

	//si existe
	if($buscarProgenitor->rowCount() == 1) {
		$array_respuesta['error'] = "Ya existe un progenitor con estos datos";
        $array_respuesta['guardado'] = false;
    } else if ($buscarProgenitores->rowCount() < 2){
		$nuevoProgenitor = $conexion->prepare('INSERT INTO progenitor (nombreProgenitor, apellidosProgenitor, tipoProgenitor, fechaNProgenitor, lugarNProgenitor, descripcionProgenitor, imgProgenitor, idBebe) VALUES(:nombreProgenitor, :apellidosProgenitor, :tipoProgenitor, :fechaNProgenitor, :lugarNProgenitor, :descripcionProgenitor, :imgProgenitor, :idBebe)');
		$nuevoProgenitor->bindParam(':nombreProgenitor', $nombreProgenitor, PDO::PARAM_STR);
		$nuevoProgenitor->bindParam(':apellidosProgenitor', $apellidosProgenitor, PDO::PARAM_STR);
		$nuevoProgenitor->bindParam(':tipoProgenitor', $tipoProgenitor, PDO::PARAM_STR);
		$nuevoProgenitor->bindParam(':fechaNProgenitor', $fechaNProgenitor, PDO::PARAM_STR);
        $nuevoProgenitor->bindParam(':lugarNProgenitor', $lugarNProgenitor, PDO::PARAM_STR);
        $nuevoProgenitor->bindParam(':descripcionProgenitor', $descripcionProgenitor, PDO::PARAM_STR);
        $nuevoProgenitor->bindParam(':imgProgenitor', $imgProgenitor, PDO::PARAM_STR);
        $nuevoProgenitor->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
		$nuevoProgenitor->execute();

		$nuevoProgenitorId = $conexion->lastInsertId();

		$array_respuesta['redireccion'] = 'crear_embarazo.php';
		$array_respuesta['guardado'] = true;
	} else {
        $array_respuesta['error'] = "Has llegado al límite de progenitores";
        $array_respuesta['guardado'] = false;
        //$array_respuesta['limite'] = true;
    }

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>