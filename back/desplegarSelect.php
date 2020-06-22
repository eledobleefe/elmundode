<?php 

require_once 'Conexion.php';

//Función para quitar las comillas de los select
function quitarComillas($cadena) {
  $resultado = preg_replace("/\'/", '', $cadena);
  return $resultado;
}

//Función despliegue de selects con información de los enum de las tablas
function desplegarSelect($row){
	$enum = $row['1'];
	$lista = strstr ($enum, "(");  
	$limpiarListIzquierda = ltrim ($lista, "("); 
	$limpiarListDerecha = rtrim ($limpiarListIzquierda, ")"); 
	$listaLimpia = explode (',', $limpiarListDerecha);
	$select ="";
	foreach($listaLimpia as $item){
		$item = quitarComillas($item);
		$select .= "<option value='" . $item ."'>". $item . "</option>";
	}
	return $select;
}

//Función despliegue de selects con información de los enum de las tablas con la opción correspondiente seleccionada
function desplegarSelectSeleccionado($row, $seleccionada){
	$enum = $row['1'];
	$lis = strstr ($enum, "(");  
	$lis = ltrim ($lis, "("); 
	$lis = rtrim ($lis, ")"); 
    $lista = explode (',', $lis);
	$select ="";
    $seleccionada = quitarComillas($seleccionada);
	foreach($lista as $clave=>$item){
        $item = quitarComillas($item);
		if ((strcmp($item, $seleccionada) === 0)){
			$select .= "<option value='" . $item ."' selected>". $item . "</option>";
		} else {
			$select .= "<option value='" . $item ."'>". $item . "</option>";
		}
	}
	return $select;
}


//Función para listar los tipos de grupo sanguíneo
function listarGruposSanguineos(){
    //Conectamos con la BBDD
    $conexion = Conexion::conectar();
    //Preparamos la consulta
    $consulta = $conexion->prepare('SHOW columns FROM bebe LIKE "grupoSanguineo"');
    //Ejecutamos la consulta
    $consulta->execute();
    //Y guardamos la respuesta 
    $registro = $consulta->fetch();
    //Devolvemos los datos
    return $registro;
    //Cerramos la conexión;
    $conexion = Conexion::desconectar();
}

//Función para listar los tipos de progenitor
function listarTipoProgenitor(){
    //Conectamos con la BBDD
    $conexion = Conexion::conectar();
    //Preparamos la consulta
    $consulta = $conexion->prepare('SHOW columns FROM progenitor LIKE "tipoProgenitor"');
    //Ejecutamos la consulta
    $consulta->execute();
    //Y guardamos la respuesta 
    $registro = $consulta->fetch();
    //Devolvemos los datos
    return $registro;
    //Cerramos la conexión;
    $conexion = Conexion::desconectar();
}

//Función para listar el orden de los dientes
function listarOrdenDiente(){
    //Conectamos con la BBDD
    $conexion = Conexion::conectar();
    //Preparamos la consulta
    $consulta = $conexion->prepare('SHOW columns FROM dentadura LIKE "ordenDiente"');
    //Ejecutamos la consulta
    $consulta->execute();
    //Y guardamos la respuesta 
    $registro = $consulta->fetch();
    //Devolvemos los datos
    return $registro;
    //Cerramos la conexión;
    $conexion = Conexion::desconectar();
}

//Función para listar el nombre de los dientes
function listarNombreDiente(){
    //Conectamos con la BBDD
    $conexion = Conexion::conectar();
    //Preparamos la consulta
    $consulta = $conexion->prepare('SHOW columns FROM dentadura LIKE "nombreDiente"');
    //Ejecutamos la consulta
    $consulta->execute();
    //Y guardamos la respuesta 
    $registro = $consulta->fetch();
    //Devolvemos los datos
    return $registro;
    //Cerramos la conexión;
    $conexion = Conexion::conectar();
}




?>