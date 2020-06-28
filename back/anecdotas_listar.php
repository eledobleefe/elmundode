<?php

require_once "Conexion.php";
require_once "acortarCadena.php";

function listarAnecdotas() {

    if(session_status() !== PHP_SESSION_ACTIVE) session_start();


        $conexion = Conexion::conectar();
        $array_respuesta=[];
        $idBebe = $_SESSION['idBebe'];
        $nombreBebe = $_SESSION['nombreBebe'];

        try {
            $buscarAnecdotas = $conexion->prepare("SELECT * FROM anecdota WHERE idBebe = '$idBebe' ORDER BY 3 ");
            $buscarAnecdotas->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
            $buscarAnecdotas->execute();
            $listaAnecdotas = $buscarAnecdotas->fetchAll();
            $mostrarAnecdotas = "<div class='my-3'>
                                    <h6 class='b_amarillo text-white rounded text-center text-uppercase p-3 my-4'>Las anécdotas inolvidables </h6>";

            if($buscarAnecdotas->rowCount() == 0) {
                $mostrarAnecdotas .= "<p class='p-3 my-4 text-center'>No hay anécdotas guardados.</p>";
            } else if ($buscarAnecdotas->rowCount() <= 2) {
                foreach ($listaAnecdotas as $anecdota) {
                    $mostrarAnecdotas .= "
                    <div class='row my-1 justify-content-center align-items-center'>
                            <div class='col-sm-12 col-md-10'>
                                <ul class='list-group list-group-horizontal-sm'>
                                    <li class='list-group-item text-center w-100'>" . $anecdota['fechaAnecdota'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $anecdota['nombreAnecdota'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $anecdota['lugarAnecdota'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . acortarCadena($anecdota['descripcionAnecdota'], 20) . "</li>
                                </ul>
                            </div>
                            <div class='col-sm-12 col-md-2 my-3'>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='mostrarAnecdotaEditado(" . $anecdota['idAnecdota'] .")' data-toggle='modal' data-target='#actualizarAnecdota'>
                                        <i class='fas fa-edit'></i>
                                    </span>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='eliminarAnecdota(" . $anecdota['idAnecdota'] .")' >
                                        <i class='fas fa-trash-alt text-white'></i>
                                    </span>						
                            </div>
                        </div>";
                    if ($buscarAnecdotas->rowCount() == 2) {
                        $array_respuesta['ocultar'] = true;
                    }
                }            
            
            }else {
                $array_respuesta['error'] = "Ha surgido un error";
            }
            $mostrarAnecdotas .= "</div>";

            $array_respuesta['lista'] = $mostrarAnecdotas;

        } catch (PDOException $e) {
            die( "Error " . $e->getMessage());
        }

        return $array_respuesta;

}
?>