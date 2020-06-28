<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $semanasEmbarazo = $_POST['semanasEmbarazo'];
    $diasEmbarazo = $_POST['diasEmbarazo'];
    $kgAumento = htmlentities(addslashes($_POST['kgAumento']));
    $fechaNoticia = htmlentities(addslashes($_POST['fechaNoticia']));
    $idBebe = $_SESSION['idBebe'];
    $idProgenitor = $_POST['idProgenitor'];
    

	//comprobar si el embarazo existe
	$buscarEmbarazo = $conexion->prepare("SELECT * FROM embarazo WHERE idProgenitor = '$idProgenitor' AND idBebe = '$idBebe' LIMIT 1");
    $buscarEmbarazo->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
    $buscarEmbarazo->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
	$buscarEmbarazo->execute();

	//si existe
	if($buscarEmbarazo->rowCount() == 0) {
		$array_respuesta['error'] = "No existe dicho embarazo";
        $array_respuesta['editado'] = false;
	} else {
		$embarazoEditado = $conexion->prepare("UPDATE embarazo SET semanasEmbarazo = '$semanasEmbarazo', diasEmbarazo = '$diasEmbarazo', kgAumento = '$kgAumento', fechaNoticia = '$fechaNoticia'  WHERE idProgenitor = '$idProgenitor' AND idBebe = '$idBebe'");
		$embarazoEditado->bindParam(':semanasEmbarazo', $semanasEmbarazo, PDO::PARAM_STR);
		$embarazoEditado->bindParam(':diasEmbarazo', $diasEmbarazo, PDO::PARAM_STR);
		$embarazoEditado->bindParam(':kgAumento', $kgAumento, PDO::PARAM_STR);
		$embarazoEditado->bindParam(':fechaNoticia', $fechaNoticia, PDO::PARAM_STR);
        $embarazoEditado->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $embarazoEditado->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $embarazoEditado->execute();
        
		$array_respuesta['editado'] = "El embarazo ha sido editado";
	}

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>