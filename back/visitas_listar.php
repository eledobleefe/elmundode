<?php

require_once "Conexion.php";

function listarVisitantes() {

    if(session_status() !== PHP_SESSION_ACTIVE) session_start();


        $conexion = Conexion::conectar();
        $array_respuesta=[];
        $idBebe = $_SESSION['idBebe'];
        $nombreBebe = $_SESSION['nombreBebe'];

        try {
            $buscarVisitas = $conexion->prepare("SELECT * FROM visitas WHERE idBebe = '$idBebe'");
            $buscarVisitas->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
            $buscarVisitas->execute();
            $listaVisitantes = $buscarVisitas->fetchAll();
            $mostrarVisitas = "<div class='my-3'>
                                    <h6 class='b_amarillo text-white rounded text-center text-uppercase p-3 my-4'>Usuarios con permiso</h6>";

            if($buscarVisitas->rowCount() == 0) {
                $mostrarVisitas .= "<p class='p-3 my-4 text-center'>No hay progenitores guardados.</p>";
            } else {
                foreach ($listaVisitantes as $visitante) {
                    $idUsuario = $visitante['idUsuario'];
                    $idVisita = $visitante['idVisitas'];
                    $buscarUsuario = $conexion->prepare("SELECT * FROM usuario WHERE idUsuario = '$idUsuario'");
                    $buscarUsuario->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
                    $buscarUsuario->execute();
                    $elUsuario = $buscarUsuario->fetch();


                    $mostrarVisitas .= "
                    <div class='row my-1 justify-content-center align-items-center'>
                            <div class='col-sm-12 col-md-10'>
                                <ul class='list-group list-group-horizontal-sm'>
                                    <li class='list-group-item text-center w-100'>" . $elUsuario['nombreUsuario'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $elUsuario['apellidosUsuario'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $elUsuario['email'] . "</li>
                                </ul>
                            </div>
                            <div class='col-sm-12 col-md-2 my-3'>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='mostrarVisitanteEditado(" . $idVisita .")' data-toggle='modal' data-target='#actualizarVisitantes'>
                                        <i class='fas fa-edit'></i>
                                    </span>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='eliminarVisitante(" . $idVisita .")' >
                                        <i class='fas fa-trash-alt text-white'></i>
                                    </span>						
                            </div>
                        </div>";
                }            
            
            }
            $mostrarVisitas .= "</div>";

            $array_respuesta['lista'] = $mostrarVisitas;

        } catch (PDOException $e) {
            die( "Error " . $e->getMessage());
        }

        return $array_respuesta;

}
?>