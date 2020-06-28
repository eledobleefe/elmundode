<?php

require_once "Conexion.php";

function listarDentadura() {

    if(session_status() !== PHP_SESSION_ACTIVE) session_start();


        $conexion = Conexion::conectar();
        $array_respuesta=[];
        $idBebe = $_SESSION['idBebe'];
        $nombreBebe = $_SESSION['nombreBebe'];

        try {
            $buscarDentaduras = $conexion->prepare("SELECT * FROM dentadura WHERE idBebe = '$idBebe' ORDER BY 2, 3");
            $buscarDentaduras->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
            $buscarDentaduras->bindParam(':fechaDiente', $fechaDiente, PDO::PARAM_INT);
            $buscarDentaduras->bindParam(':ordenDiente', $ordenDiente, PDO::PARAM_INT);
            $buscarDentaduras->execute();
            $listaDentaduras = $buscarDentaduras->fetchAll();
            $mostrarDentaduras = "<div class='my-3'>
                                    <h6 class='b_amarillo text-white rounded text-center text-uppercase p-3 my-4'>Vaya dientes </h6>";

            if($buscarDentaduras->rowCount() == 0) {
                $mostrarDentaduras .= "<p class='p-3 my-4 text-center'>No hay dientes guardados.</p>";
            } else if ($buscarDentaduras->rowCount() !== 0) {
                foreach ($listaDentaduras as $dentadura) {
                    $mostrarDentaduras .= "
                    <div class='row my-1 justify-content-center align-items-center'>
                            <div class='col-sm-12 col-md-10'>
                                <ul class='list-group list-group-horizontal-sm'>
                                    <li class='list-group-item text-center w-100'>" . $dentadura['fechaDiente'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $dentadura['ordenDiente'] . "</li>
                                    <li class='list-group-item text-center w-100'>" . $dentadura['nombreDiente'] . "</li>
                                </ul>
                            </div>
                            <div class='col-sm-12 col-md-2 my-3'>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='mostrarDentaduraEditado(" . $dentadura['idDentadura'] .")' data-toggle='modal' data-target='#actualizarDentadura'>
                                        <i class='fas fa-edit'></i>
                                    </span>
                                    <span class='btn b_amarillo btn-sm text-white' onclick='eliminarDentadura(" . $dentadura['idDentadura'] .")' >
                                        <i class='fas fa-trash-alt text-white'></i>
                                    </span>						
                            </div>
                        </div>";
                    if ($buscarDentaduras->rowCount() == 2) {
                        $array_respuesta['ocultar'] = true;
                    }
                }            
            
            }else {
                $array_respuesta['error'] = "Ha surgido un error";
            }
            $mostrarDentaduras .= "</div>";

            $array_respuesta['lista'] = $mostrarDentaduras;

        } catch (PDOException $e) {
            die( "Error " . $e->getMessage());
        }

        return $array_respuesta;

}
?>