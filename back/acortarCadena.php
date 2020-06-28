<?php
function acortarCadena($cadena, $limite){
    $termino = "...";
	if(strlen($cadena) > $limite){
		return substr($cadena, 0, $limite) . $termino;
	}
	
	// Si no, entonces devuelve la cadena normal
	return $cadena;
}
?>