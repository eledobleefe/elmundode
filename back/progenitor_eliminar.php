<?php
require_once 'config.php';


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idProgenitor = $_POST['idProgenitor'];
	$array_respuesta=[];
    try {
        $eliminarProgenitor = $conexion->prepare("DELETE FROM progenitor WHERE idProgenitor = '$idProgenitor'");
        $eliminarProgenitor->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $eliminarProgenitor->execute();

        //Comprobamos que no existe el progenitor
        $progenitorEliminado = $conexion->prepare("SELECT * FROM progenitor WHERE idProgenitor = '$idProgenitor' LIMIT 1");
        $progenitorEliminado->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $progenitorEliminado->execute();
        if($progenitorEliminado->rowCount() == 0) {
            $array_respuesta['eliminado'] = "Progenitor eliminado con éxito";
            $array_respuesta['redireccion'] = "../crear_embarazos.php";
        } else {
            $array_respuesta['error'] = "No se ha podido eliminar";
        }

    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}
    $conexion = Conexion::desconectar();

?>