<?php
    require_once 'Conexion.php';

//Recuperamos la sesion
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

function mostrarBebeVisitante($idUsuario){
    try {
        $conexion = Conexion::conectar();
        $mostrarBebeVisitante = $conexion->prepare("SELECT idBebe FROM visitas WHERE idUsuario = '$idUsuario' LIMIT 1");
        $mostrarBebeVisitante->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $mostrarBebeVisitante->execute();

        if(!empty($mostrarBebeVisitante)) {
            $bebe = $mostrarBebeVisitante->fetchColumn();
            return $bebe;
        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    $conexion = Conexion::desconectar();
}
/*
function mostrarNombreBebe($idBebe) {
    try {
        $conexion = Conexion::conectar();
        $mostrarNombreBebe = $conexion->prepare("SELECT nombreBebe FROM bebe WHERE idBebe = '$idBebe' LIMIT 1");
        $mostrarNombreBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $mostrarNombreBebe->execute();

        if(!empty($mostrarNombreBebe)) {
            $nombreBebe = $mostrarNombreBebe->fetchColumn();
            return $nombreBebe;
        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    $conexion = Conexion::desconectar();
}*/
/*
function mostrarDedicatoriaBebe($idBebe) {
    try {
        $conexion = Conexion::conectar();
        $mostrarDedicatoriaBebe = $conexion->prepare("SELECT dedicatoriaBebe FROM bebe WHERE idBebe = '$idBebe' LIMIT 1");
        $mostrarDedicatoriaBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $mostrarDedicatoriaBebe->execute();

        if(!empty($mostrarDedicatoriaBebe)) {
            $dedicatoriaBebe = $mostrarDedicatoriaBebe->fetchColumn();
            return $dedicatoriaBebe;
        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    $conexion = Conexion::desconectar();
}*/

function mostrarInformacionBebe($idBebe) {
    try {
        $conexion = Conexion::conectar();
        $mostrarInformacionBebe = $conexion->prepare("SELECT * FROM bebe WHERE idBebe = '$idBebe' LIMIT 1");
        $mostrarInformacionBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $mostrarInformacionBebe->execute();

        if(!empty($mostrarInformacionBebe)) {
            $todaInfoBebe = $mostrarInformacionBebe->fetch();
            $infoBebe = [];
            foreach($todaInfoBebe as $clave=>$valor){
                $infoBebe[$clave] = $valor;
            }

        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    return $infoBebe;

    $conexion = Conexion::desconectar();
}

function mostrarInformacionProgenitor($idBebe) {
    try {
        $conexion = Conexion::conectar();
        $mostrarInformacionProgenitor = $conexion->prepare("SELECT * FROM progenitor WHERE idBebe = '$idBebe'");
        $mostrarInformacionProgenitor->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $mostrarInformacionProgenitor->execute();

        if(!empty($mostrarInformacionProgenitor)) {
            $todaInfoProgenitor = $mostrarInformacionProgenitor->fetchAll();
            $infoProgenitor = [];
            $contador=0;
            foreach($todaInfoProgenitor as $progenitor){
                foreach($progenitor as $clave=>$valor) {
                    $infoProgenitor[$contador][$clave] = $valor;
                }
                $contador++;
            }

        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    return $infoProgenitor;

    $conexion = Conexion::desconectar();
}

function mostrarInformacionEmbarazo($idProgenitor, $idBebe) {
    try {
        $conexion = Conexion::conectar();
        $mostrarInformacionEmbarazo = $conexion->prepare("SELECT * FROM embarazo WHERE idBebe = '$idBebe' AND idProgenitor = '$idProgenitor'");
        $mostrarInformacionEmbarazo->bindParam(':idProgenitor', $idProgenitor, PDO::PARAM_INT);
        $mostrarInformacionEmbarazo->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
        $mostrarInformacionEmbarazo->execute();

        if(!empty($mostrarInformacionEmbarazo)) {
            $todaInfoEmbarazo = $mostrarInformacionEmbarazo->fetch();
            $infoEmbarazo = [];
            foreach($todaInfoEmbarazo as $clave=>$valor) {
                $infoEmbarazo[$clave] = $valor;
            }

        }
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    return $infoEmbarazo;

    $conexion = Conexion::desconectar();
}


function calcularEdad($fechaProgenitor, $fechaBebe){
    $fechaNac = new DateTime($fechaProgenitor);
    $fechaBeb = new DateTime($fechaBebe);
    $edad = $fechaBeb->diff($fechaNac);
    $calculo = $edad->format('%y años');
    return $calculo;
}

?>