<?php
require_once 'config.php';

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idBebe = $_SESSION['idBebe'];
    $idCrecimiento = $_POST['idCrecimiento'];
    $array_respuesta=[];
    
    try {
            $eliminarCrecimiento = $conexion->prepare("DELETE FROM crecimiento WHERE idCrecimiento = '$idCrecimiento'");
            $eliminarCrecimiento->bindParam(':idCrecimiento', $idCrecimiento, PDO::PARAM_INT);
            $eliminarCrecimiento->execute();

            //Comprobamos que no existe el crecimiento
            $crecimientoEliminado = $conexion->prepare("SELECT * FROM crecimiento WHERE idCrecimiento = '$idCrecimiento'");
            $eliminarCrecimiento->bindParam(':idCrecimiento', $idCrecimiento, PDO::PARAM_INT);
            $crecimientoEliminado->execute();
            if($crecimientoEliminado->rowCount() == 0) {
                $array_respuesta['eliminado'] = "Datos de crecimiento eliminados con éxito";
            } else {
                $array_respuesta['error'] = "Disculpa, ha surgido un error";
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