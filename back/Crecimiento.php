<?php
//Necesitamos acceso al código contenido en 'Conexion.php'
require_once 'Conexion.php';

//Creamos la clase Crecimiento
class Crecimiento{
	//Cada propiedad corresponde a una columna de la tabla 'crecimiento'
	private $idBebe;
	private $fechaDatos;
	private $altura;
	private $peso;
	private $cabeza;
		
	//Excepto la constante con el nombre de la tabla
	const CRECIMIENTO = 'crecimiento';
	
	
	//Métodos get y set correspondientes
	public function getIdBebe(){
		return $this->idBebe;
	}
	public function setIdBebe(){
		$this->idUsuario = $idUsuario;
        return $this;
	}
	
	public function getFechaDatos(){
		return $this->fechaDatos;
	}
	public function setFechaDatos(){
		$this->fechaDatos = $fechaDatos;
        return $this;
	}

public function getAltura(){
		return $this->altura;
	}
	public function setAltura(){
		$this->altura = $altura;
        return $this;
	}

public function getPeso(){
		return $this->peso;
	}
	public function setPeso(){
		$this->peso = $peso;
        return $this;
	}

public function getCabeza(){
		return $this->cabeza;
	}
	public function setCabeza(){
		$this->cabeza = $cabeza;
        return $this;
	}
	
	
	//Método constructor
	public function __construct($idBebe, $fechaDatos, $altura, $peso, $cabeza)
{
	$this->idBebe = $idBebe;
	$this->fechaDatos = $fechaDatos;
	$this->altura = $altura;
	$this->peso = $peso;
	$this->cabeza = $cabeza;
}


//Para guardar los datos del crecimiento en la tabla de crecimiento
    public function guardarCrecimientos() {
        //Conectamos con la BBDD
        $conexion = new Conexion();
		//Preparamos la inserción de los datos
		$consulta = $conexion -> prepare('INSERT INTO '. self::CRECIMIENTO . ' (idBebe, fechaDatos, altura, peso, cabeza) VALUES (:idBebe, :fechaDatos, :altura, :peso, :cabeza)');
		//identificamos los marcadores
		$consulta->bindParam(':idBebe', $this->idBebe);
		$consulta->bindParam(':fechaDatos', $this->fechaDatos);
		$consulta->bindParam(':altura', $this->altura);
		$consulta->bindParam(':peso', $this->peso);
		$consulta->bindParam(':cabeza', $this->cabeza);
		//Ejecutamos la consulta
		$consulta->execute();
		//Cerramos la conexión
		$conexion = null;
    }


	//Método para eliminar crecimientos
	public function eliminarCrecimientos(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion -> prepare('DELETE FROM '. self::CRECIMIENTO . ' WHERE idBebe = :idBebe AND fechaDatos = :fechaDatos');
		//Identificamos los marcadores
		$consulta->bindParam(':idBebe', $this->idBebe);
		$consulta->bindParam(':fechaDatos', $this->fechaDatos);
		//Ejecutamos la consulta
		$consulta->execute();
		//Cerramos la conexión
		$conexion = null;
	}

//Método buscar por idBebe y fechaDatos
	public static function buscarCrecimientos($idBebe,$fechaDatos){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion -> prepare('SELECT altura, peso, cabeza FROM ' . self::CRECIMIENTO . ' WHERE idBebe = :idBebe AND fechaDatos = :fechaDatos');
		//Identificamos los marcadores
		$consulta -> bindParam(':idBebe', $idBebe);
		$consulta -> bindParam(':fechaDatos', $fechaDatos);
		//Ejecutamos la consulta
		$consulta -> execute();
		//Guardamos el resultado en la variable
		$registro = $consulta ->fetch();
		//Devolvemos los datos si ha habido coincidencia
		if($registro){
			return new self($idBebe, $fechaDatos, $registro['altura'], $registro['peso'], $registro['cabeza']);
		} else {
			return false;
		}
		//Cerramos la conexión
        $conexion = null;
	}

//Método para listar los crecimientos de un idBebe
	public static function listarCrecimientosBebe($idBebe){
		//Conectamos a la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion -> prepare('SELECT * FROM '. self::CRECIMIENTO . ' WHERE idBebe = :idBebe');
		//Identificamos los marcadores
		$consulta -> bindParam(':idBebe', $idBebe);
		//Ejecutamos la consulta
		$consulta -> execute();
		//Guardamos la respuesta y la devolvemos
		$registros = $consulta -> fetchAll();
		return $registros;
		//Cerramos la conexion
		$conexion = null;
	}


	
}
?>