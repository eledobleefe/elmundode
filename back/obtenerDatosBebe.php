<?php
require_once 'config.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idBebe = $_POST['idBebe'];
	$array_respuesta=[];
    try {
        $obtenerBebe = $conexion->prepare("SELECT * FROM bebe WHERE idBebe = '$idBebe' LIMIT 1");
        $obtenerBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $obtenerBebe->execute();

        if($obtenerBebe->rowCount() == 1) {
            $unBebe = $obtenerBebe->fetch(PDO::FETCH_ASSOC);
            $_SESSION['idBebe'] = $idBebe;
			$_SESSION['nombreBebe'] = $unBebe['nombreBebe'];
            $array_respuesta['redireccion'] = 'crear_bebes.php';
            foreach ($unBebe as $clave => $valor) {
                $array_respuesta[$clave]= $valor;
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