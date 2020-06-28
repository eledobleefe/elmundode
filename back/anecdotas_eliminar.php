<?php
require_once 'config.php';


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idAnecdota = $_POST['idAnecdota'];
	$array_respuesta=[];
    try {
        $eliminarAnecdota = $conexion->prepare("DELETE FROM anecdota WHERE idAnecdota = '$idAnecdota'");
        $eliminarAnecdota->bindParam(':idAnecdota', $idAnecdota, PDO::PARAM_INT);
        $eliminarAnecdota->execute();

        //Comprobamos que no existe la anécdota
        $anecdotaEliminada = $conexion->prepare("SELECT * FROM anecdota WHERE idAnecdota = '$idAnecdota' LIMIT 1");
        $anecdotaEliminada->bindParam(':idAnecdota', $idAnecdota, PDO::PARAM_INT);
        $anecdotaEliminada->execute();
        if($anecdotaEliminada->rowCount() == 0) {
            $array_respuesta['eliminado'] = "Anécdota eliminada con éxito";
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