<?php

//Necesitamos acceso al código contenido en 'Conexion.php'
require_once 'Conexion.php';

//Creamos la clase Embarazo
class Embarazo {
    //Cada propiedad corresponde a una columna de la tabla 'embarazo'
    private $idBebe;
    private $idProgenitor;
    private $semanasEmbarazo;
    private $diasEmbarazo;
    private $kgAumento;
    private $fechaNoticia;

    //Excepto la constante con el nombre de la tabla
    const EMBARAZO = 'embarazo';

    //Métodos get y set correspondientes
    public function getIdBebe()
    {
        return $this->idBebe;
    }
    public function setIdBebe($idBebe)
    {
        $this->idBebe = $idBebe;

        return $this;
    }

    public function getIdProgenitor()
    {
        return $this->idProgenitor;
    }
    public function setIdProgenitor($idProgenitor)
    {
        $this->idProgenitor = $idProgenitor;

        return $this;
    }
    

    public function getSemanasEmbarazo()
    {
        return $this->semanasEmbarazo;
    }
    public function setSemanasEmbarazo($semanasEmbarazo)
    {
        $this->semanasEmbarazo = $semanasEmbarazo;

        return $this;
    }

    

    public function getDiasEmbarazo()
    {
        return $this->diasEmbarazo;
    }
    public function setDiasEmbarazo($diasEmbarazo)
    {
        $this->diasEmbarazo = $diasEmbarazo;

        return $this;
    }

    public function getKgAumento()
    {
        return $this->kgAumento;
    }
    public function setKgAumento($kgAumento)
    {
        $this->kgAumento = $kgAumento;

        return $this;
    }

    public function getFechaNoticia()
    {
        return $this->fechaNoticia;
    }
    public function setFechaNoticia($fechaNoticia)
    {
        $this->fechaNoticia = $fechaNoticia;

        return $this;
    }


    //Método constructor
    public function __construct($idBebe, $idProgenitor, $semanasEmbarazo, $diasEmbarazo, $kgAumento, $fechaNoticia){
        $this->idBebe = $idBebe;
        $this->idProgenitor = $idProgenitor;
        $this->semanasEmbarazo = $semanasEmbarazo;
        $this->diasEmbarazo = $diasEmbarazo;
        $this->kgAumento = $kgAumento;
        $this->fechaNoticia = $fechaNoticia;
    }

    //Para guardar los datos del embarazo en la tabla correspondiente
    public function guardarEmbarazos() {
        //Conectamos con la BBDD
        $conexion = new Conexion;
        //Preparamos la inserción de los datos
        $consulta = $conexion->prepare('INSERT INTO ' . self::EMBARAZO . ' (idBebe, idProgenitor, semanasEmbarazo, kgAumento, fechaNoticia) VALUES(:idBebe, :idProgenitor, :semanasEmbarazo, :diasEmbarazo, :kgAumento, :fechaNoticia)');
        //Identificamos los marcadores
		$consulta->bindParam(':idBebe', $this->idBebe);
		$consulta->bindParam(':idProgenitor', $this->idProgenitor);
		$consulta->bindParam(':semanasEmbarazo', $this->semanasEmbarazo);
		$consulta->bindParam(':diasEmbarazo', $this->diasEmbarazo);
		$consulta->bindParam(':kgAumento', $this->kgAumento);
		$consulta->bindParam(':fechaNoticia', $this->fechaNoticia);
		//Ejecutamos la consulta
		$consulta->execute();
		//Cerramos la conexión
		$conexion = null;
    }
	
	//Método para eliminar embarazos
	public function eliminarEmbarazos(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la eliminación de los datos
		$consulta = $conexion->prepare('DELETE FROM ' . self::EMBARAZO . ' WHERE idBebe = :idBebe AND idProgenitor = :idProgenitor');
		//Identificamos los marcadores
		$consulta->bindParam(':idBebe', $this->idBebe);
		$consulta->bindParam(':idProgenitor', $this->idProgenitor);
		//Ejecutamos el borrado
		$consulta->execute();
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para buscar coincidencias de embarazo del mismo bebé
	public static function buscarEmbarazo($idBebe, $idProgenitor){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta, seleccionado toda la información cuando coincida el idProgenitor y el idBebe
		$consulta = $conexion->prepare('SELECT semanasEmbarazo, diasEmbarazo, kgAumento, fechaNoticia FROM ' .  self::EMBARAZO . ' WHERE idBebe = :idBebe AND idProgenitor = :idProgenitor');
		//Identificamos los marcadores
		$consulta->bindParam(':idBebe', $idBebe);
		$consulta->bindParam(':idProgenitor', $idProgenitor);
		//Ejecutamos la consulta
		$consulta->execute();
		//Guardamos el resultado en la variable
		$registro = $consulta->fetch();
		//Devolvemos los datos si ha habido coincidencia
		if ($registro) {
			return new self($idBebe, $idProgenitor, $return['semanasEmbarazo'], $return['diasEmbarazo'], $return['kgAumento'], $return['fechaNoticia']);
		} else {
			//Si no retornamos un false
			return false;
		}
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para listar los embarazos de un progenitor
	public static function listarEmbarazosProgenitor($idProgenitor) {
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta, seleccionando toda la información cuando coincida el idProgenitor
		$consulta = $conexion->prepare('SELECT * FROM ' . self::EMBARAZO . ' WHERE idProgenitor = :idProgenitor');
		//Identificamos el marcador
		$consulta->bindParam(':idProgenitor', $idProgenitor);
		//Ejecutamos la consulta
		$consulta->execute();
		//Guardamos el resultado en la variable
		$registro = $consulta->fetchAll();
		//Devolvemos los datos
		return $registro;
		//Cerramos la conexión
		$conexion = null;
	}

}


?>