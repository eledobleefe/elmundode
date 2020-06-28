<?php
require_once 'config.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idVisitas = $_POST['idVisitas'];
    $array_respuesta=[];
    $array_respuesta['idVisitas'] = $idVisitas;
    try {
        $obtenerVisitas = $conexion->prepare("SELECT * FROM visitas WHERE idVisitas = '$idVisitas' LIMIT 1");
        $obtenerVisitas->bindParam(':idVisitas', $idVisitas, PDO::PARAM_INT);
        $obtenerVisitas->execute();
        if($obtenerVisitas->rowCount() == 1) {
            $visitas = $obtenerVisitas->fetch();
            $idUsuario = $visitas['idUsuario'];

            try {
            $obtenerUsuario = $conexion->prepare("SELECT * FROM usuario WHERE idUsuario = '$idUsuario' LIMIT 1");
            $obtenerUsuario->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $obtenerUsuario->execute();
            $unUsuario = $obtenerUsuario->fetch(PDO::FETCH_ASSOC);
            $array_respuesta['encontrado'] = true;
            foreach ($unUsuario as $clave => $valor) {
                $array_respuesta[$clave]= html_entity_decode($valor);
            }
            } catch (PDOException $e){
                die("Obtenerusuario: " . $e->getMessage());
            }
        }

    } catch(PDOException $e) {
        die("Generito: " . $e->getMessage());
    }
    echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}
    $conexion = Conexion::desconectar();

?>