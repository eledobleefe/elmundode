<?php
require_once 'config.php';


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Content-Type: application/json");
    $idDentadura = $_POST['idDentadura'];
	$array_respuesta=[];
    try {
        $eliminarDentadura = $conexion->prepare("DELETE FROM dentadura WHERE idDentadura = '$idDentadura'");
        $eliminarDentadura->bindParam(':idDentadura', $idDentadura, PDO::PARAM_INT);
        $eliminarDentadura->execute();

        //Comprobamos que no existe la dentadura
        $dentaduraEliminada = $conexion->prepare("SELECT * FROM dentadura WHERE idDentadura = '$idDentadura' LIMIT 1");
        $dentaduraEliminada->bindParam(':idDentadura', $idDentadura, PDO::PARAM_INT);
        $dentaduraEliminada->execute();
        if($dentaduraEliminada->rowCount() == 0) {
            $array_respuesta['eliminado'] = "Diente eliminado con éxito";
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