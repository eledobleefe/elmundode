<?php
require_once 'config.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idProgenitor = $_POST['idProgenitor'];
	$array_respuesta=[];
    try {
        $obtenerProgenitor = $conexion->prepare("SELECT * FROM progenitor WHERE idProgenitor = '$idProgenitor' LIMIT 1");
        $obtenerProgenitor->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $obtenerProgenitor->execute();

        if($obtenerProgenitor->rowCount() == 1) {
            $unProgenitor = $obtenerProgenitor->fetch(PDO::FETCH_ASSOC);
            $array_respuesta['encontrado'] = true;
            foreach ($unProgenitor as $clave => $valor) {
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