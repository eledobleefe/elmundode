<?php

require_once 'Conexion.php';

if(session_status() !== PHP_SESSION_ACTIVE) session_start();


//Aseguramos que el método de la petición es POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Content-Type: application/json");
	$array_respuesta=[];    
	$idBebe = $_SESSION['idBebe'];
    //Recibimos los datos de la imagen
	$input = $_POST['inputImagen'];
	echo $input;
    $carpeta = $_POST['carpeta'];
	//De donde sacamos la imagen input
	$nombreImagen = $_FILES[$input]['name'];
	$tipoImagen = $_FILES[$input]['type'];
    $tamanhoImagen = $_FILES[$input]['size'];
    $mensaje = "";
	
	//Sólo subirlo cuando sea menor que aprox 1MB
	if ($tamanhoImagen <= 1000000)  {
		//Y sea un archivo jpeg, jpg o png
		if ($tipoImagen == 'image/jpeg' || $tipoImagen == 'image/jpg' || $tipoImagen == 'image/png') {
			//Ruta de la carpeta destino en servidor
			$carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . 'elmundode_ok/img/usuarios/' . $carpeta;
			//Cambiamos el archivo del directorio temporal al directorio correspondiente
			move_uploaded_file($_FILES[$input]['tmp_name'], $carpetaDestino.$nombreImagen);
			
			try {
				$imgNacimiento = $_FILES[$input]['name'];
				$editarBebe = $conexion->prepare("UPDATE bebe SET imgNacimiento = '$imgNacimiento' WHERE idBebe = '$idBebe'");
				$editarBebe->bindParam(':idBebe', $idBebe, PDO::PARAM_INT);
				$editarBebe->bindParam(':imgNacimiento', $imgNacimiento, PDO::PARAM_STR);
				$editarBebe->execute();

			} catch(PDOException $e) {
				die("Error: " . $e->getMessage());
			}

            $array_respuesta['subida'] = "La imagen se ha guardado correctamente.";

            


		} else {
			$array_respuesta['error'] = "El tipo de imagen debe de ser jpeg, jpg o png.";
		}
	} else {
		$array_respuesta['error'] = "La imagen no ha de ser mayor de 1 mega";
    }
    
    echo $array_respuesta;
}

?>