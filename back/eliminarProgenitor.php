<?php
require_once 'config.php';


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idProgenitor = $_POST['idProgenitor'];
	$array_respuesta=[];
    try {
        $eliminarBebe = $conexion->prepare("DELETE FROM progenitor WHERE idProgenitor = '$idProgenitor'");
        $eliminarBebe->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $eliminarBebe->execute();

        //Comprobamos que no existe el bebé
        $bebeEliminado = $conexion->prepare("SELECT * FROM progenitor WHERE idProgenitor = '$idProgenitor' LIMIT 1");
        $bebeEliminado->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $bebeEliminado->execute();
        if($bebeEliminado->rowCount() == 0) {
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