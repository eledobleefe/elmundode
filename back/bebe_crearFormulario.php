<?php
require_once 'Conexion.php';
require_once 'desplegarSelect.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

function crearFormularioBebe() {

    $conexion = Conexion::conectar();
    
    $listaGrupoSanguineo = listarGruposSanguineos();

    $formularioBebe = "";
    if(isset($_SESSION['idBebe'])) {
        $idBebe = $_SESSION['idBebe'];
        try {
            $obtenerBebe = $conexion->prepare("SELECT * FROM bebe WHERE idBebe = '$idBebe' LIMIT 1");
            $obtenerBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
            $obtenerBebe->execute();

            
            if($obtenerBebe->rowCount() == 1) {
                $unBebe = $obtenerBebe->fetch(PDO::FETCH_ASSOC);
                
                $selectGrupoSanguineo = desplegarSelectSeleccionado($listaGrupoSanguineo, $unBebe['grupoSanguineo']);
                
                $nombreBebe = $unBebe['nombreBebe'];
                $apellidosBebe = $unBebe['apellidosBebe'];
                $fechaNacimiento = $unBebe['fechaNacimiento'];
                $horaNacimiento = $unBebe['horaNacimiento'];
                $lugarNacimiento = $unBebe['lugarNacimiento'];
                $ciudadNacimiento = $unBebe['ciudadNacimiento'];
                $dedicatoriaBebe = $unBebe['dedicatoriaBebe'];
                $boton ="<button type='submit' name='btnEditarBebe' class='btn b_amarillo text-white mx-4 mb-4' onclick='editarBebe(" . $idBebe . ")'>Editar</button>";
                
            }

        } catch(PDOException $e) {
            die("Error: " . $e->getMessagge());
        }
    }  else {
        $nombreBebe = "";
        $apellidosBebe = "";
        $fechaNacimiento = "";
        $horaNacimiento = "";
        $lugarNacimiento = "";
        $ciudadNacimiento = "";
        $dedicatoriaBebe = "";
        $idBebe = "";
        $selectGrupoSanguineo = desplegarSelect($listaGrupoSanguineo);
        $boton ="<button type='submit' name='btnGuardarBebe' class='btn b_amarillo text-white mx-4 mb-4' onclick='guardarBebe(" . $idBebe . ")'>Guardar</button>";
    }
    $formularioBebe .= "
    <div class='container bg-white pt-3 sombra'>
        <form id='formBebe' method='post' action='' >
            <h6 class='amarillo border borde_amarillo rounded text-center text-uppercase py-3 m-3'>Datos del bebé</h6>
            <div id='msgErrorBebe' class='alert alert-warning mt-3 py-3 m-3' role='alert' style='display: none'></div>
            <div class='row py-3 px-4 mb-4'>
                <div class='col-sm-12 col-md-6'>
                    <div class='form-group'>
                        <label for='nombreBebe'>Nombre</label>
                        <input type='text' class='form-control' id='nombreBebe' name='nombreBebe' aria-describedby='helpNombreMundo' value='" . $nombreBebe . "' required>
                        <small id='helpNombreMundo' class='form-text text-muted' >El mundo que estás creando llevará este nombre, el del bebé.</small>
                    </div>
                </div>
                <div class='col-sm-12 col-md-6'>
                <div class='form-group'>
                    <label for='apellidosBebe'>Apellidos</label>
                            <input type='text' class='form-control' id='apellidosBebe' name='apellidosBebe' value='" . $apellidosBebe . "' required>
                        </div>
                    </div>
                </div>
                <hr class='b_amarillo'>
                <div class='row mt-5 pb-3 px-4'>
                    <div class='col-sm-12 col-md-4'>
                        <div class='form-group'>
                            <label for='fechaNacimiento'>Fecha de nacimiento</label>
                            <input type='date' class='form-control' id='fechaNacimiento' name='fechaNacimiento' value='" . $fechaNacimiento . "' required>
                        </div>
                    </div>
                    <div class='col-sm-12 col-md-4'>
                        <div class='form-group'>
                            <label for='horaNacimiento'>Hora de nacimiento</label>
                            <input type='time' class='form-control' id='horaNacimiento' name='horaNacimiento' value='" . $horaNacimiento . "' required>
                        </div>
                    </div>
                    <div class='col-sm-12 col-md-4'>
                        <div class='form-group'>
                            <label for='grupoSanguineo'>Grupo sanguíneo</label>
                            <select class='custom-select' id='grupoSanguineo' name='grupoSanguineo' required>
                                
                                <!--Mostramos las diferentes opciones que hay en la tabla de la BBDD-->
                                " . $selectGrupoSanguineo ."
                                
                        </select>
                        </div>
                    </div>
                </div>
                <div class='row pb-3 px-4'>
                    <div class='col-sm-12 col-md-6'>
                        <div class='form-group'>
                            <label for='lugarNacimiento'>Lugar de nacimiento</label>
                            <input type='text' class='form-control' id='lugarNacimiento' name='lugarNacimiento' value='" . $lugarNacimiento . "' placeholder='Ej. Hospital Teresa Herrera' required>
                        </div>
                    </div>
                    <div class='col-sm-12 col-md-6'>
                        <div class='form-group'>
                            <label for='ciudadNacimiento'>Ciudad de nacimiento</label>
                            <input type='text' class='form-control' id='ciudadNacimiento' name='ciudadNacimiento' value='" . $ciudadNacimiento . "' required>
                        </div>
                    </div>
                </div>
                <hr class='b_amarillo'>
                <div class='form-group my-5 mx-4'>
                    <label for='dedicatoriaBebe'>Dedicatoria</label>
                    <textarea rows='5' class='form-control' id='dedicatoriaBebe' name='dedicatoriaBebe' aria-describedby='helpDedicatoria' required>
                    " . $dedicatoriaBebe ."
                    </textarea>
                    <small id='helpDedicatoria' class='form-text text-muted'>Escribe una dedicatoria para el bebé. Será lo primero que leerá al visitar su mundo.</small>
                </div>
                <div class='form-group my-5 mx-4 w-75 d-block'>
					<label for='imNacimiento'>¿Alguna imagen que añadir?</label>
					<input type='file' class='form-control-file my-3' id='imNacimiento' name='imNacimiento'>
                </div>
                " . $boton . "
            </form>
    </div>";

    return $formularioBebe;
}
        
?>