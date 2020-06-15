<?php

//Necesitamos acceso al código contenido en 'Conexion.php'
require_once 'Conexion.php';

//Creamos la clase Anecdota
class Anecdota{
	//Cada propiedad corresponde a una columna de la tabla 'anecdota'
	private $idBebe;
	private $fechaAnecdota;
	private $descripcionAnecdota;
	private $nombreAnecdota;
	private $lugarAnecdota;
	private $extraAnecdota;
	private $tipoExtra;
		
	//Excepto la constante con el nombre de la tabla
	const ANECDOTA = 'anecdota';
	
	//Métodos get y set correspondientes
	public function getIdBebe() {
		return $this->idBebe;
	}
	public function setIdBebe($idBebe){
		$this->idBebe = $idBebe;
		return $this;
	}
	
	public function getFechaAnecdota() {
		return $this->idBebe;
	}
	public function setFechaAnecdota($fechaAnecdota){
		$this->fechaAnecdota = $fechaAnecdota;
		return $this;
	}
	
	public function getDescripcionAnecdota() {
		return $this->descripcionAnecdota;
	}
	public function setDescripcionAnecdota($descripcionAnecdota){
		$this->descripcionAnecdota = $descripcionAnecdota;
		return $this;
	}
	
	public function getNombreAnecdota() {
		return $this->nombreAnecdota;
	}
	public function setNombreAnecdota($nombreAnecdota){
		$this->nombreAnecdota = $nombreAnecdota;
		return $this;
	}
	
	public function getLugarAnecdota() {
		return $this->lugarAnecdota;
	}
	public function setLugarAnecdota($lugarAnecdota){
		$this->lugarAnecdota = $lugarAnecdota;
		return $this;
	}
	
	public function getExtraAnecdota() {
		return $this->extraAnecdota;
	}
	public function setExtraAnecdota($extraAnecdota){
		$this->extraAnecdota = $extraAnecdota;
		return $this;
	}
	
	public function getTipoExtra() {
		return $this->tipoExtra;
	}
	public function setTipoExtra($tipoExtra){
		$this->tipoExtra = $tipoExtra;
		return $this;
	}
	
	//Método constructor
	public function __construct($idBebe, $fechaAnecdota, $descripcionAnecdota, $nombreAnecdota, $lugarAnecdota, $extraAnecdota, $tipoExtra) {
		$this->idBebe = $idBebe;
		$this->fechaAnecdota = $fechaAnecdota;
		$this->descripcionAnecdota = $descripcionAnecdota;
		$this->nombreAnecdota = $nombreAnecdota;
		$this->lugarAnecdota = $lugarAnecdota;
		$this->extraAnecdota = $extraAnecdota;
		$this->tipoExtra = $tipoExtra;		
	}
	
	//Método para guardar los datos de las anécdotas
	public function guardarAnecdotas(){
		//Conectamos la BBDD
		$conexion = new Conexion();
		//Preparamos la inserción de los datos
		$consulta = $conexion->prepare('INSERT INTO ' . self::ANECDOTA . ' (idBebe, fechaAnecdota, descripcionAnecdota, nombreAnecdota, lugarAnecdota, extraAnecdota, tipoExtra) VALUES(:idBebe, :fechaAnecdota, :descripcionAnecdota, :nombreAnecdota, :lugarAnecdota, :extraAnecdota, :tipoExtra)');
		//Identificamos los marcadores
		$consulta->bindParam(':idBebe', $this->idBebe);
		$consulta->bindParam(':fechaAnecdota', $this->fechaAnecdota);
		$consulta->bindParam(':descripcionAnecdota', $this->descripcionAnecdota);
		$consulta->bindParam(':nombreAnecdota', $this->nombreAnecdota);
		$consulta->bindParam(':lugarAnecdota', $this->lugarAnecdota);
		$consulta->bindParam(':extraAnecdota', $this->extraAnecdota);
		$consulta->bindParam(':tipoextra', $this->tipoExtra);
		//Ejecutamos la consulta
		$consulta->execute();
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para eliminar anécdotas
	public function eliminarAnecdotas(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la eliminación de los datos
		$consulta = $conexion->prepare('DELETE FROM ' . self::ANECDOTA . ' WHERE idBebe = :idBebe AND descripcionAnecdota = :descripcionAnecdota');
		//Identificamos los marcadores
		$consulta->bindParam(':idBebe', $this->idBebe);
		$consulta->bindParam(':descripcionAnecdota', $this->descripcionAnecdota);
		//Ejecutamos el borrado
		$consulta->execute();
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para buscar coincidencias de la anécdota del bebé
	public static function buscarAnecdotas($idBebe, $descripcionAnecdota){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta, seleccionado toda la información cuando coincida el idProgenitor y el idBebe
		$consulta = $conexion->prepare('SELECT fechaAnecdota, nombreAnecdota, lugarAnecdota, extraAnecdota, tipoExtra FROM ' .  self::ANECDOTA . ' WHERE idBebe = :idBebe AND descripcionAnecdota = :descripcionAnecdota');
		//Identificamos los marcadores
		$consulta->bindParam(':idBebe', $idBebe);
		$consulta->bindParam(':descripcionAnecdota', $descripcionAnecdota);
		//Ejecutamos la consulta
		$consulta->execute();
		//Guardamos el resultado en la variable
		$registro = $consulta->fetch();
		//Devolvemos los datos si ha habido coincidencia
		if ($registro) {
			return new self($idBebe, $return['fechaAnecdota'], $descripcionAnecdota, $return['nombreAnecdota'], $return['lugarAnecdota'], $return['extraAnecdota'], $return['tipoExtra']);
		} else {
			//Si no retornamos un false
			return false;
		}
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para listar las anécdotas de un bebé
	public static function listarAnecdotasBebe($idBebe) {
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta, seleccionando toda la información cuando coincida el idProgenitor
		$consulta = $conexion->prepare('SELECT * FROM ' . self::ANECDOTA . ' WHERE idBebe = :idBebe');
		//Identificamos el marcador
		$consulta->bindParam(':idBebe', $idBebe);
		//Ejecutamos la consulta
		$consulta->execute();
		//Guardamos el resultado en la variable
		$registro = $consulta->fetchAll();
		//Devolvemos los datos
		return $registro;
		//Cerramos la conexión
		$conexion = null;
	}
	
	
	//Método para listar los tipos dato extra
	public static function listarTipoExtra(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion->prepare('SHOW columns FROM anecdota LIKE "tipoExtra"');
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