<?php
require_once 'config.php';


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    $idProgenitor = $_POST['idProgenitor'];
    $idBebe = $_SESSION['idBebe'];
	$array_respuesta=[];
    try {
        $eliminarEmbarazo = $conexion->prepare("DELETE FROM embarazo WHERE idProgenitor = '$idProgenitor' AND idBebe = '$idBebe'");
        $eliminarEmbarazo->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $eliminarEmbarazo->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $eliminarEmbarazo->execute();

        //Comprobamos que no existe el embarazo
        $embarazoEliminado = $conexion->prepare("SELECT * FROM embarazo WHERE idProgenitor = '$idProgenitor' LIMIT 1");
        $embarazoEliminado->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $embarazoEliminado->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $embarazoEliminado->execute();
        if($embarazoEliminado->rowCount() == 0) {
            $array_respuesta['eliminado'] = "Embarazo eliminado con éxito";
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