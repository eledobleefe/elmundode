<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $idBebe = $_POST['idBebe'];
    $nombreBebe = htmlentities(addslashes($_POST['nombreBebe']));
    $apellidosBebe = htmlentities(addslashes($_POST['apellidosBebe']));
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $horaNacimiento = $_POST['horaNacimiento'];
    $lugarNacimiento = htmlentities(addslashes($_POST['lugarNacimiento']));
    $ciudadNacimiento = htmlentities(addslashes($_POST['ciudadNacimiento']));
    //$grupoSanguineo = $_POST['grupoSanguineo']; Porque da error el select. Carga más items de los que son. PENDIENTE DE MIRAR.
    $grupoSanguineo = '0 -';
    //Falta imagen. Pendiente de hacerlo con $_FILES
    $imgNacimiento = null;
    $dedicatoriaBebe = htmlentities(addslashes($_POST['dedicatoriaBebe']));
    $idUsuario = $_SESSION['idUsuario'];

	//comprobar si el bebe existe
	$buscarBebe = $conexion->prepare("SELECT * FROM bebe WHERE idBebe = '$idBebe' LIMIT 1");
    $buscarBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
	$buscarBebe->execute();

	//si existe
	if($buscarBebe->rowCount() == 0) {
		$array_respuesta['error'] = "No existe dicho bebé";
        $array_respuesta['editado'] = false;
	} else {
		$editarBebe = $conexion->prepare("UPDATE bebe SET nombreBebe = '$nombreBebe', apellidosBebe = '$apellidosBebe', fechaNacimiento = '$fechaNacimiento', horaNacimiento = '$horaNacimiento', lugarNacimiento = '$lugarNacimiento', ciudadNacimiento = '$ciudadNacimiento', grupoSanguineo = '$grupoSanguineo', imgNacimiento = '$imgNacimiento', dedicatoriaBebe = '$dedicatoriaBebe', idUsuario = '$idUsuario' WHERE idBebe = '$idBebe'");
        $editarBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $editarBebe->bindParam(':nombreBebe', $nombreBebe, PDO::PARAM_STR);
		$editarBebe->bindParam(':apellidosBebe', $apellidosBebe, PDO::PARAM_STR);
		$editarBebe->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
		$editarBebe->bindParam(':horaNacimiento', $horaNacimiento, PDO::PARAM_STR);
        $editarBebe->bindParam(':lugarNacimiento', $lugarNacimiento, PDO::PARAM_STR);
        $editarBebe->bindParam(':ciudadNacimiento', $ciudadNacimiento, PDO::PARAM_STR);
		$editarBebe->bindParam(':grupoSanguineo', $grupoSanguineo, PDO::PARAM_STR);
        $editarBebe->bindParam(':imgNacimiento', $imgNacimiento, PDO::PARAM_STR);
        $editarBebe->bindParam(':dedicatoriaBebe', $dedicatoriaBebe, PDO::PARAM_STR);
        $editarBebe->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
		$editarBebe->execute();

        $_SESSION['idBebe'] = $idBebe;
		$_SESSION['nombreBebe'] = $nombreBebe;
		$array_respuesta['redireccion'] = 'crear_progenitores.php';
		$array_respuesta['editado'] = true;
	}

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>