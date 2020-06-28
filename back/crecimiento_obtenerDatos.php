<?php
require_once 'config.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idBebe = $_SESSION['idBebe'];
    $idCrecimiento = $_POST['idCrecimiento'];
    $array_respuesta=[];
    
    try {
        $obtenerCrecimiento = $conexion->prepare("SELECT * FROM crecimiento WHERE idCrecimiento = '$idCrecimiento' LIMIT 1");
        $obtenerCrecimiento->bindParam(':idCrecimiento', $idCrecimiento, PDO::PARAM_INT);
        $obtenerCrecimiento->execute();

        if($obtenerCrecimiento->rowCount() == 1) {
            $unCrecimiento = $obtenerCrecimiento->fetch(PDO::FETCH_ASSOC);
            $array_respuesta['encontrado'] = true;
            foreach ($unCrecimiento as $clave => $valor) {
                $array_respuesta[$clave]= html_entity_decode($valor);
            }
        } else {
            $array_respuesta['error'] = "Ha surgido un error";
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