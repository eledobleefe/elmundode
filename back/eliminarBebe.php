<?php
require_once 'config.php';


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idBebe = $_POST['idBebe'];
	$array_respuesta=[];
    try {
        $eliminarBebe = $conexion->prepare("DELETE FROM bebe WHERE idBebe = '$idBebe'");
        $eliminarBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $eliminarBebe->execute();

        //Comprobamos que no existe el bebé
        $bebeEliminado = $conexion->prepare("SELECT * FROM bebe WHERE idBebe = '$idBebe' LIMIT 1");
        $bebeEliminado->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $bebeEliminado->execute();
        if($bebeEliminado->rowCount() == 0) {
            $array_respuesta['eliminado'] = "Bebé eliminado con éxito";
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