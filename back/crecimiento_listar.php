<?php

require_once "Conexion.php";

function listarCrecimiento() {

    if(session_status() !== PHP_SESSION_ACTIVE) session_start();


        $conexion = Conexion::conectar();
        $array_respuesta=[];
        $idBebe = $_SESSION['idBebe'];
        $nombreBebe = $_SESSION['nombreBebe'];

        try {
            $buscarCrecimientos = $conexion->prepare("SELECT * FROM crecimiento WHERE idBebe = '$idBebe' ORDER BY 3");
            $buscarCrecimientos->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
            $buscarCrecimientos->execute();
            $listaCrecimiento = $buscarCrecimientos->fetchAll();
            $mostrarCrecimientos = "<div class='my-3'>
                                    <h6 class='b_amarillo text-white rounded text-center text-uppercase py-3 my-4'>Cómo crece </h6>";

            if($buscarCrecimientos->rowCount() == 0) {
                $mostrarCrecimientos .= "<p class='p-3 my-4 text-center'>No hay datos de crecimiento guardados.</p>";
            } else {
                foreach ($listaCrecimiento as $crecimiento) {
                    $mostrarCrecimientos .= "
                    <div class='row my-1 justify-content-center align-items-center'>
                            <div class='col-sm-12 col-md-10'>
                                <ul class='list-group list-group-horizontal-sm'>
                                    <li class='list-group-item text-center w-100'>" . $crecimiento['fechaDatos'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $crecimiento['altura'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $crecimiento['peso'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $crecimiento['cabeza'] . "</li>
                                </ul>
                            </div>
                            <div class='col-sm-12 col-md-2 my-3'>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='mostrarCrecimientoEditado(" . $crecimiento['idCrecimiento'] . ")' data-toggle='modal' data-target='#actualizarCrecimiento'>
                                        <i class='fas fa-edit'></i>
                                    </span>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='eliminarCrecimiento(" . $crecimiento['idCrecimiento'] . ")' >
                                        <i class='fas fa-trash-alt text-white'></i>
                                    </span>						
                            </div>
                        </div>";
                }            
            
            }
            $mostrarCrecimientos .= "</div>";

            $array_respuesta['lista'] = $mostrarCrecimientos;

        } catch (PDOException $e) {
            die( "Error " . $e->getMessage());
        }

        return $array_respuesta;

}
?>