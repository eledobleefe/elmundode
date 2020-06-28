<?php
require_once 'config.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idAnecdota = $_POST['idAnecdota'];
	$array_respuesta=[];
    try {
        $obtenerAnecdota = $conexion->prepare("SELECT * FROM anecdota WHERE idAnecdota = '$idAnecdota' LIMIT 1");
        $obtenerAnecdota->bindParam(':idAnecdota', $idAnecdota, PDO::PARAM_INT);
        $obtenerAnecdota->execute();

        if($obtenerAnecdota->rowCount() == 1) {
            $unaAnecdota = $obtenerAnecdota->fetch(PDO::FETCH_ASSOC);
            $array_respuesta['encontrado'] = true;
            foreach ($unaAnecdota as $clave => $valor) {
                $array_respuesta[$clave]= html_entity_decode($valor);
            }
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