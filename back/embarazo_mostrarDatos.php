<?php
    require_once 'Conexion.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

function mostrarDatosEmbarazo($idBebe){
    try {
        $conexion = Conexion::conectar();
        $datosEmbarazo = [];

        //comprobar si el embarazo existe
        $buscarEmbarazo = $conexion->prepare("SELECT * FROM embarazo WHERE idBebe = '$idBebe' LIMIT 1");
        $buscarEmbarazo->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $buscarEmbarazo->execute();

        if($buscarEmbarazo->rowCount() == 1){
            $embarazo = $buscarEmbarazo->fetch();
            foreach ($embarazo as $clave => $valor) {
                $datosEmbarazo[$clave] = $valor;
            }
        }

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
        return $datosEmbarazo;
        $conexion = Conexion::desconectar();
}

?>