<?php
require_once "config.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
    $array_respuesta=[];
    $semanasEmbarazo = htmlentities(addslashes($_POST['semanasEmbarazo']));
    $diasEmbarazo = htmlentities(addslashes($_POST['diasEmbarazo']));
    $kgAumento = htmlentities(addslashes($_POST['kgAumento']));
    $fechaNoticia = htmlentities(addslashes($_POST['fechaNoticia']));
    $idBebe = $_SESSION['idBebe'];

    if(!isset($_POST['idProgenitor'])) {
        //selecconamos el progenitor de tipo 'madre'
        $buscarProgenitores = $conexion->prepare("SELECT * FROM progenitor WHERE idBebe = '$idBebe' AND tipoProgenitor = 'madre'");
        $buscarProgenitores->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $buscarProgenitores->bindParam(':tipoProgenitor', $tipoProgenitor, PDO::PARAM_STR);
        $buscarProgenitores->execute();
        $progenitor = $buscarProgenitores->fetch();
        $idProgenitor = $progenitor['idProgenitor'];
    } else {
        $idProgenitor = $_POST['idProgenitor'];
    }
    //si existe
	if($buscarProgenitores->rowCount() == 1) {

        //comprobar si el embarazo existe
        $buscarEmbarazo = $conexion->prepare("SELECT * FROM embarazo WHERE idBebe = '$idBebe' AND idProgenitor = '$idProgenitor' LIMIT 1");
        $buscarEmbarazo->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $buscarEmbarazo->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $buscarEmbarazo->execute();
        

        //si existe
        if($buscarEmbarazo->rowCount() == 1) {
            $array_respuesta['error'] = "Ya un embarazo registrado para este bebé.";
            $array_respuesta['guardado'] = false;
        } else {
            $nuevoEmbarazo = $conexion->prepare('INSERT INTO embarazo (idBebe, idProgenitor, semanasEmbarazo, diasEmbarazo, kgAumento, fechaNoticia) VALUES(:idBebe, :idProgenitor, :semanasEmbarazo, :diasEmbarazo, :kgAumento, :fechaNoticia)');
            $nuevoEmbarazo->bindParam(':semanasEmbarazo', $semanasEmbarazo, PDO::PARAM_STR);
            $nuevoEmbarazo->bindParam(':diasEmbarazo', $diasEmbarazo, PDO::PARAM_STR);
            $nuevoEmbarazo->bindParam(':kgAumento', $kgAumento, PDO::PARAM_STR);
            $nuevoEmbarazo->bindParam(':fechaNoticia', $fechaNoticia, PDO::PARAM_STR);
            $nuevoEmbarazo->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
            $nuevoEmbarazo->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
            $nuevoEmbarazo->execute();

            $array_respuesta['guardado'] = true;
        } 

    } else if ($buscarProgenitores->rowCount() > 1) {
        $array_respuesta['error'] = "Existe más de una madre. Revise los datos";
    } else {
        $array_respuesta['error'] = "No hay ninguna madre a la que asignárselo.";
    } 

	echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}

?>