<?php

//Necesitamos acceso al código contenido en 'Conexion.php'
require_once 'Conexion.php';

//Creamos la clase Embarazo
class Dentadura{
	//Cada propiedad corresponde a una columna de la tabla 'dentadura'
	private $idBebe;
	private $fechaDiente;
	private $ordenDiente;
	private $nombreDiente;	
		
	//Excepto la constante con el nombre de la tabla
	const DENTADURA = 'dentadura';
	
	//Métodos get y set correspondientes
	public function getIdBebe() {
		return $this->idBebe;
	}
	public function setIdBebe($idBebe){
		$this->idBebe = $idBebe;
		return $this;
	}
	
	public function getFechaDiente() {
		return $this->fechaDiente;
	}
	public function setFechaDiente($fechaDiente){
		$this->fechaDiente = $fechaDiente;
		return $this;
	}
	
	public function getOrdenDiente() {
		return $this->ordenDiente;
	}
	public function setOrdenDiente($ordenDiente){
		$this->ordenDiente = $ordenDiente;
		return $this;
	}
	
	public function getNombreDiente() {
		return $this->nombreDiente;
	}
	public function setNombreDiente($nombreDiente){
		$this->nombreDiente = $nombreDiente;
		return $this;
	}
	
	//Método constructor
	public function __construct($idBebe, $fechaDiente, $ordenDiente, $nombreDiente){
		//Conectamos la BBDD
		$this->idBebe = $idBebe;
		$this->fechaDiente = $fechaDiente;
		$this->ordenDiente = $ordenDiente;
		$this->nombreDiente = $nombreDiente;
	}
	
	//Método para guardar los datos de la dentadura en la tabla correspondiente
	public function guardarDentadura(){
		//Conectamos con la BBDD
		$conexion = new Conexion;
		//Preparamos la inserción de los datos
		$consulta = $conexion->prepare('INSERT INTO ' . self::DENTADURA . ' (idBebe, fechaDiente, ordenDiente, nombreDiente) VALUES(:idBebe, :fechaDiente, :ordenDiente, :nombreDiente)');
		//Identificamos los marcadores
		$consulta->bindParam(':idBebe', $this->idBebe);
		$consulta->bindParam(':fechaDiente', $this->fechaDiente);
		$consulta->bindParam(':ordenDiente', $this->ordenDiente);
		$consulta->bindParam(':nombreDiente', $this->nombreDientes);
		//Ejecutamos la consulta
		$consulta->execute();
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para eliminar dientes de la dentadura de un bebé
	public function eliminarDentadura(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la eliminación de los datos
		$consulta = $conexion->prepare('DELETE FROM ' . self::DENTADURA . ' WHERE idBebe = :idBebe AND nombreDiente = :nombreDiente');
		//Identificamos los marcadores
		$consulta->bindParam(':idBebe', $this->idBebe);
		$consulta->bindParam(':nombreDiente', $this->nombreDiente);
		//Ejecutamos el borrado
		$consulta->execute();
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para buscar coincidencias de dentadura del mismo bebé
	public static function buscarDentadura($idBebe, $nombreDiente){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta, seleccionado toda la información cuando coincida el idBebe y el nombreDiente
		$consulta = $conexion->prepare('SELECT fechaDiente, ordenDiente FROM ' . self::DENTADURA . ' WHERE idBebe = :idBebe AND nombreDiente = :nombreDiente');
		//Identificamos los marcadores
		$consulta->bindParam(':idBebe', $idBebe);
		$consulta->bindParam(':nombreDiente', $nombreDiente);
		//Ejecutamos la consulta
		$consulta->execute();
		//Guardamos el resultado en la variable
		$registro = $consulta->fetch();
		//Devolvemos los datos si ha habido coincidencia
		if($registro){
			return new self($idBebe, $registro['fechaDiente'], $registro['ordenDiente'], $nombreDiente);
		} else {
			//Si no retornamos un false
			return false;
		}
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para listar los dientes de un bebé
	public static function listarDentadura($idBebe){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta, seleccionando toda la información cuando coincida el idBebe
		$consulta = $conexion->prepare('SELECT * FROM ' . self::DENTADURA . ' WHERE idBebe = :idBebe');
		//Identificamos el marcador
		$consulta->bindParam(':idBebe', $idBebe);
		//Ejecutamos la consulta
		$consulta->execute();
		//Guardamos el resultado en la variable
		$registro = $consulta -> fetchAll();
		//Devolvemos los datos
		return $registro;
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para listar el orden de los dientes
	public static function listarOrdenDiente(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion->prepare('SHOW columns FROM dentadura LIKE "ordenDiente"');
		//Ejecutamos la consulta
		$consulta->execute();
		//Y guardamos la respuesta 
		$registro = $consulta->fetch();
		//Devolvemos los datos
		return $registro;
		//Cerramos la conexión;
		$conexion = null;
	}
	
	//Método para listar el nombre de los dientes
	public static function listarNombreDiente(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion->prepare('SHOW columns FROM dentadura LIKE "nombreDiente"');
		//Ejecutamos la consulta
		$consulta->execute();
		//Y guardamos la respuesta 
		$registro = $consulta->fetch();
		//Devolvemos los datos
		return $registro;
		//Cerramos la conexión;
		$conexion = null;
	}
}

?>