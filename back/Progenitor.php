<?php

//Necesitamos acceso al código contenido en 'Conexion.php'
require_once 'Conexion.php';

//Creamos la clase Progenitor
class Progenitor {
    //Cada propiedad corresponde a una columna de la tabla 'progenitor'
    private $idProgenitor;
    private $nombreProgenitor;
    private $apellidosProgenitor;
    private $tipoProgenitor;
    private $fechaNProgenitor;
    private $lugarNProgenitor;
    private $descripcionProgenitor;
    private $idBebe;

    //Excepto la constante con el nombre de la tabla
    const PROGENITOR = 'progenitor';

    //Métodos get y set correspondientes

    public function getIdProgenitor()
    {
        return $this->idProgenitor;
    } 
    public function setIdProgenitor($idProgenitor)
    {
        $this->idProgenitor = $idProgenitor;

        return $this;
    }

    public function getNombreProgenitor()
    {
        return $this->nombreProgenitor;
    }
    public function setNombreProgenitor($nombreProgenitor)
    {
        $this->nombreProgenitor = $nombreProgenitor;

        return $this;
    }

    public function getApellidosProgenitor()
    {
        return $this->apellidosProgenitor;
    }
    public function setApellidosProgenitor($apellidosProgenitor)
    {
        $this->apellidosProgenitor = $apellidosProgenitor;

        return $this;
    }

    public function getTipoProgenitor()
    {
        return $this->tipoProgenitor;
    }
    public function setTipoProgenitor($tipoProgenitor)
    {
        $this->tipoProgenitor = $tipoProgenitor;

        return $this;
    }

    public function getFechaNProgenitor()
    {
        return $this->fechaNProgenitor;
    }
    public function setFechaNProgenitor($fechaNProgenitor)
    {
        $this->fechaNProgenitor = $fechaNProgenitor;

        return $this;
    }

    public function getLugarNProgenitor()
    {
        return $this->lugarNProgenitor;
    }
    public function setLugarNProgenitor($lugarNProgenitor)
    {
        $this->lugarNProgenitor = $lugarNProgenitor;

        return $this;
    }

    public function getDescripcionProgenitor()
    {
        return $this->descripcionProgenitor;
    }
    public function setDescripcionProgenitor($descripcionProgenitor)
    {
        $this->descripcionProgenitor = $descripcionProgenitor;

        return $this;
    }
 
    public function getIdBebe()
    {
        return $this->idBebe;
    }
    public function setIdBebe($idBebe)
    {
        $this->idBebe = $idBebe;

        return $this;
    }


    //Método constructor
    //El idProgenitor consta como null porque en la tabla es un valor que se auto incrementa    
    public function __construct($idProgenitor = null, $nombreProgenitor, $apellidosProgenitor, $tipoProgenitor, $fechaNProgenitor, $lugarNProgenitor, $descripcionProgenitor, $idBebe)
    {
        $this->idProgenitor = $idProgenitor;
        $this->nombreProgenitor = $nombreProgenitor;
        $this->apellidosProgenitor = $apellidosProgenitor;
        $this->tipoProgenitor = $tipoProgenitor;
        $this->fechaNProgenitor = $fechaNProgenitor;
        $this->lugarNProgenitor = $lugarNProgenitor;
        $this->descripcionProgenitor = $descripcionProgenitor;
        $this->idBebe = $idBebe;
    }


    //Para guardar los datos de los progenitores en la tabla de progenitor
    public function guardarProgenitores() {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la inserción de los datos
        $consulta = $conexion -> prepare('INSERT INTO '. self::PROGENITOR . ' (nombreProgenitor, apellidosProgenitor, tipoProgenitor, fechaNProgenitor, lugarNProgenitor, descripcionProgenitor, idBebe) VALUES(:nombreProgenitor, :apellidosProgenitor, :tipoProgenitor, :fechaNProgenitor, :lugarNProgenitor, :descripcionProgenitor, :idBebe)');
        //Identificamos los marcadores
        $consulta->bindParam(':nombreProgenitor', $this->nombreProgenitor);
        $consulta->bindParam(':apellidosProgenitor', $this->apellidosProgenitor);
        $consulta->bindParam(':tipoProgenitor', $this->tipoProgenitor);
        $consulta->bindParam(':fechaNProgenitor', $this->fechaNProgenitor);
        $consulta->bindParam(':lugarNProgenitor', $this->lugarNProgenitor);
        $consulta->bindParam(':descripcionProgenitor', $this->descripcionProgenitor);
        $consulta->bindParam(':idBebe', $this->idBebe);
        //Ejecutamos la consulta
        $consulta->execute();
        //Al finalizar la inserción recuperamos el idProgenitor que se acaba de insertar
        $this->idProgenitor=$conexion->lastInsertId();
        //Cerramos la conexión
        $conexion = null;
    }
	
	
/*	//Para actualizar los datos de los progenitores en la tabla de progenitor
    public function actualizarProgenitores() {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la inserción de los datos
        $consulta = $conexion -> prepare('UPDATE '. self::PROGENITOR . ' SET nombreProgenitor = :nombreProgenitor, apellidosProgenitor = :apellidosProgenitor, tipoProgenitor = :tipoProgenitor, fechaNProgenitor = :fechaNProgenitor, lugarNProgenitor = :lugarNProgenitor, descripcionProgenitor = :descripcionProgenitor, idBebe = :idBebe WHERE idProgenitor = :idProgenitor');
        //Identificamos los marcadores
		$consulta->bindParam(':idProgenitor', $this->idProgenitor);
        $consulta->bindParam(':nombreProgenitor', $this->nombreProgenitor);
        $consulta->bindParam(':apellidosProgenitor', $this->apellidosProgenitor);
        $consulta->bindParam(':tipoProgenitor', $this->tipoProgenitor);
        $consulta->bindParam(':fechaNProgenitor', $this->fechaNProgenitor);
        $consulta->bindParam(':lugarNProgenitor', $this->lugarNProgenitor);
        $consulta->bindParam(':descripcionProgenitor', $this->descripcionProgenitor);
        $consulta->bindParam(':idBebe', $this->idBebe);
        //Ejecutamos la consulta
        $consulta->execute();
        //Cerramos la conexión
        $conexion = null;
    }*/


    //Para eliminar los datos del progenitor en la tabla de progenitores
    public function eliminarProgenitores() {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la eliminación de los datos
        $consulta = $conexion -> prepare('DELETE FROM '. self::PROGENITOR . ' WHERE idProgenitor = :idProgenitor');
        //Identificamos los marcadores
        $consulta->bindParam(':idProgenitor', $this->idProgenitor);
        //Ejecutamos el borrado
        $consulta->execute();
        //Cerramos la conexión
        $conexion = null;
    }

    //Método para buscar coincidencias con el idProgenitor
    public static function buscarProgenitorId($idProgenitor) {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la consulta, seleccionando toda la información cuando coincida el idProgenitor 
        $consulta = $conexion->prepare('SELECT nombreProgenitor, apellidosProgenitor, tipoProgenitor, fechaNProgenitor, lugarNProgenitor, descripcionProgenitor, idBebe FROM ' . self::PROGENITOR . ' WHERE idProgenitor = :idProgenitor');
        //Identificamos el marcador
        $consulta->bindParam(':idProgenitor', $idProgenitor);
        //Ejecutamos la consulta
        $consulta->execute();
        //Guardamos el resultado en la variable
        $registro = $consulta->fetch();
        //Devolvemos los datos si ha habido coincidencia
        if ($registro) {
            return new self($idProgenitor, $registro['nombreProgenitor'], $registro['apellidosProgenitor'], $registro['tipoProgenitor'], $registro['fechaNProgenitor'], $registro['lugarNProgenitor'], $registro['descripcionProgenitor'], $registro['idBebe']);
        } else {
            //Si no retornamos un false
            return false;
        }
        //Cerramos la conexión
        $conexion = null;
    }

	
	//Método para buscar coincidencias con los datos únicos del progenitor
    public static function buscarProgenitorCompleto($nombreProgenitor, $apellidosProgenitor, $fechaNProgenitor, $lugarNProgenitor, $idBebe) {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la consulta, seleccionando toda la información cuando coincida el idProgenitor 
        $consulta = $conexion->prepare('SELECT idProgenitor, nombreProgenitor, apellidosProgenitor, tipoProgenitor, fechaNProgenitor, lugarNProgenitor, descripcionProgenitor, idBebe FROM ' . self::PROGENITOR . ' WHERE nombreProgenitor = :nombreProgenitor AND apellidosProgenitor = :apellidosProgenitor AND fechaNProgenitor = :fechaNProgenitor AND lugarNProgenitor = :lugarNProgenitor AND idBebe = :idBebe');
        //Identificamos el marcador
        $consulta->bindParam(':nombreProgenitor', $nombreProgenitor);
		$consulta->bindParam(':apellidosProgenitor', $apellidosProgenitor);
		$consulta->bindParam(':fechaNProgenitor', $fechaNProgenitor);
		$consulta->bindParam(':lugarNProgenitor', $lugarNProgenitor);
		$consulta->bindParam(':idBebe', $idBebe);
        //Ejecutamos la consulta
        $consulta->execute();
        //Guardamos el resultado en la variable
        $registro = $consulta->fetch();
        //Devolvemos los datos si ha habido coincidencia
        if ($registro) {
            return new self($registro['idProgenitor'], $nombreProgenitor, $apellidosProgenitor, $registro['tipoProgenitor'], $fechaNProgenitor, $lugarNProgenitor, $registro['descripcionProgenitor'], $idBebe);
        } else {
            //Si no retornamos un false
            return false;
        }
        //Cerramos la conexión
        $conexion = null;
    }
	
	
    //Método para listar los progenitores de un bebé
    public static function listarProgenitoresBebe($idBebe) {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la consulta, seleccionando toda la información cuando coincida el idProgenitor 
        $consulta = $conexion->prepare('SELECT * FROM ' . self::PROGENITOR . ' WHERE idBebe = :idBebe ORDER BY idProgenitor');
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
	
	
	//Método para listar los tipos de progenitor
	public static function listarTipoProgenitor(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion->prepare('SHOW columns FROM progenitor LIKE "tipoProgenitor"');
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
