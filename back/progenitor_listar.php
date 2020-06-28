<?php

require_once "Conexion.php";

function listarProgenitores() {

    if(session_status() !== PHP_SESSION_ACTIVE) session_start();


        $conexion = Conexion::conectar();
        $array_respuesta=[];
        $idBebe = $_SESSION['idBebe'];
        $nombreBebe = $_SESSION['nombreBebe'];

        try {
            $buscarProgenitores = $conexion->prepare("SELECT * FROM progenitor WHERE idBebe = '$idBebe'");
            $buscarProgenitores->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
            $buscarProgenitores->execute();
            $listaProgenitores = $buscarProgenitores->fetchAll();
            $mostrarProgenitores = "<div class='container-fluid my-3'>
                                    <h6 class='b_amarillo text-white rounded text-center text-uppercase p-3 my-4'>Los padres </h6>";

            if($buscarProgenitores->rowCount() == 0) {
                $mostrarProgenitores .= "<p class='p-3 my-4 text-center'>No hay progenitores guardados.</p>";
            } else if ($buscarProgenitores->rowCount() <= 2) {
                foreach ($listaProgenitores as $progenitor) {
                    $mostrarProgenitores .= "
                    <div class='row my-1 justify-content-center align-items-center'>
                            <div class='col-sm-12 col-md-10'>
                                <ul class='list-group list-group-horizontal-sm'>
                                    <li class='list-group-item text-center w-100'>" . $progenitor['nombreProgenitor'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $progenitor['apellidosProgenitor'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $progenitor['tipoProgenitor'] . "</li>
                                </ul>
                            </div>
                            <div class='col-sm-12 col-md-2 my-3'>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='mostrarProgenitorEditado(" . $progenitor['idProgenitor'] .")' data-toggle='modal' data-target='#actualizarProgenitor'>
                                        <i class='fas fa-edit'></i>
                                    </span>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='eliminarProgenitor(" . $progenitor['idProgenitor'] .")' >
                                        <i class='fas fa-trash-alt text-white'></i>
                                    </span>						
                            </div>
                        </div>";
                    if ($buscarProgenitores->rowCount() == 2) {
                        $array_respuesta['ocultar'] = true;
                    }
                }            
            
            }else {
                $array_respuesta['error'] = "Ha surgido un error";
            }
            $mostrarProgenitores .= "</div>";

            $array_respuesta['lista'] = $mostrarProgenitores;

        } catch (PDOException $e) {
            die( "Error " . $e->getMessage());
        }

        return $array_respuesta;

}
?>