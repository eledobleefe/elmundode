<?php

//Recuperamos la sesión
session_start();
//La destruimos
try {
	session_destroy();
	//Y redirigimos al index
	header("Location:index.html");
} catch (Exception $ex) {
	//Si surge algún error lo capturamos y mostramos el mensaje correspondiente
    echo $e->getMessage();
}


?>