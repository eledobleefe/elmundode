<?php
require_once 'config.php';


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idVisitas = $_POST['idVisitas'];
	$array_respuesta=[];
    try {
        $visitanteBuscado = $conexion->prepare("SELECT * FROM visitas WHERE idVisitas = '$idVisitas' LIMIT 1");
        $visitanteBuscado->bindParam(':idVisitas', $idVisitas, PDO::PARAM_INT);
        $visitanteBuscado->execute();
        $visitante = $visitanteBuscado->fetch();
        $idUsuario = $visitante['idUsuario'];
        
        $eliminarVisitante = $conexion->prepare("DELETE FROM visitas WHERE idVisitas = '$idVisitas'");
        $eliminarVisitante->bindParam(':idVisitas', $idVisitas, PDO::PARAM_INT);
        $eliminarVisitante->execute();
        

        //Comprobamos que no existe la visita
        $visitanteEliminado = $conexion->prepare("SELECT * FROM visitas WHERE idVisitas = '$idVisitas' LIMIT 1");
        $visitanteEliminado->bindParam(':idVisitas', $idVisitas, PDO::PARAM_INT);
        $visitanteEliminado->execute();

        } catch(PDOException $e) {
            die("visitante: " . $e->getMessage());
        }

        if($visitanteEliminado->rowCount() == 0) {
            try{
            $eliminarUsuario = $conexion->prepare("DELETE FROM usuario WHERE idUsuario = '$idUsuario'");
            $eliminarUsuario->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $eliminarUsuario->execute();

            $usuarioEliminado = $conexion->prepare("SELECT * FROM usuario WHERE idUsuario = '$idUsuario' LIMIT 1");
            $usuarioEliminado->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $usuarioEliminado->execute();

            } catch(PDOException $e) {
                die("usuario: " . $e->getMessage());
            }

            $array_respuesta['eliminado'] = "Visitante eliminado con éxito";
        } else {
            $array_respuesta['error'] = "No se ha podido eliminar";
        }

    echo json_encode($array_respuesta);
} else {
	exit("Fuera de aquí");
}
    $conexion = Conexion::desconectar();

?>