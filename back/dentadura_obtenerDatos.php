<?php
require_once 'config.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idDentadura = $_POST['idDentadura'];
	$array_respuesta=[];
    try {
        $obtenerDentadura = $conexion->prepare("SELECT * FROM dentadura WHERE idDentadura = '$idDentadura' LIMIT 1");
        $obtenerDentadura->bindParam(':idDentadura', $idDentadura, PDO::PARAM_INT);
        $obtenerDentadura->execute();

        if($obtenerDentadura->rowCount() == 1) {
            $unaDentadura = $obtenerDentadura->fetch(PDO::FETCH_ASSOC);
            $array_respuesta['encontrado'] = true;
            foreach ($unaDentadura as $clave => $valor) {
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