<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $idProgenitor = $_POST['idProgenitor'];
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
	$buscarBebe = $conexion->prepare("SELECT * FROM progenitor WHERE idProgenitor = '$idProgenitor' LIMIT 1");
    $buscarBebe->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
	$buscarBebe->execute();

	//si existe
	if($buscarBebe->rowCount() == 0) {
		$array_respuesta['error'] = "No existe dicho progenitor";
        $array_respuesta['editado'] = false;
	} else {
		$progenitorEditado = $conexion->prepare("UPDATE progenitor SET nombreProgenitor = '$nombreProgenitor', apellidosProgenitor = '$apellidosProgenitor', tipoProgenitor = '$tipoProgenitor', fechaNProgenitor = '$fechaNProgenitor', lugarNProgenitor = '$lugarNProgenitor', descripcionProgenitor = '$descripcionProgenitor', imgProgenitor = '$imgProgenitor', idBebe = '$idBebe' WHERE idProgenitor = '$idProgenitor'");
		$progenitorEditado->bindParam(':nombreProgenitor', $nombreProgenitor, PDO::PARAM_STR);
		$progenitorEditado->bindParam(':apellidosProgenitor', $apellidosProgenitor, PDO::PARAM_STR);
		$progenitorEditado->bindParam(':tipoProgenitor', $tipoProgenitor, PDO::PARAM_STR);
		$progenitorEditado->bindParam(':fechaNProgenitor', $fechaNProgenitor, PDO::PARAM_STR);
        $progenitorEditado->bindParam(':lugarNProgenitor', $lugarNProgenitor, PDO::PARAM_STR);
        $progenitorEditado->bindParam(':descripcionProgenitor', $descripcionProgenitor, PDO::PARAM_STR);
        $progenitorEditado->bindParam(':imgProgenitor', $imgProgenitor, PDO::PARAM_STR);
        $progenitorEditado->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $progenitorEditado->execute();
        
		$array_respuesta['editado'] = true;
	}

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>