<?php

//Necesitamos acceso al código contenido en 'Conexion.php'
require_once 'Conexion.php';

//Creamos la clase Bebe
class Bebe {
    //Cada propiedad corresponde a una columna de la tabla 'bebe'
    private $idBebe;
    private $nombreBebe;
    private $apellidosBebe;
    private $fechaNacimiento;
    private $horaNacimiento;
    private $lugarNacimiento;
    private $ciudadNacimiento;
    private $grupoSanguineo;
    private $imgNacimiento;
    private $dedicatoriaBebe;
	private $idUsuario;
    //Excepto la constante con el nombreBebe de la tabla
    const BEBE = 'bebe';

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

    public function getNombreBebe()
    {
        return $this->nombreBebe;
    } 
    public function setNombreBebe($nombreBebe)
    {
        $this->nombreBebe = $nombreBebe;

        return $this;
    }

    public function getApellidosBebe()
    {
        return $this->apellidosBebe;
    } 
    public function setApellidosBebe($apellidosBebe)
    {
        $this->apellidosBebe = $apellidosBebe;

        return $this;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getHoraNacimiento()
    {
        return $this->horaNacimiento;
    }
    public function setHoraNacimiento($horaNacimiento)
    {
        $this->horaNacimiento = $horaNacimiento;

        return $this;
    }

    public function getlugarNacimiento()
    {
        return $this->lugarNacimiento;
    }
    public function setlugarNacimiento($lugarNacimiento)
    {
        $this->lugarNacimiento = $lugarNacimiento;

        return $this;
    }

    public function getciudadNacimiento()
    {
        return $this->ciudadNacimiento;
    }
    public function setciudadNacimiento($ciudadNacimiento)
    {
        $this->ciudadNacimiento = $ciudadNacimiento;

        return $this;
    }

    public function getGrupoSanguineo()
    {
        return $this->grupoSanguineo;
    }
    public function setGrupoSanguineo($grupoSanguineo)
    {
        $this->grupoSanguineo = $grupoSanguineo;

        return $this;
    }

    public function getImgNacimiento()
    {
        return $this->imgNacimiento;
    }
    public function setImgNacimiento($imgNacimiento)
    {
        $this->imgNacimiento = $imgNacimiento;

        return $this;
    }

    public function getDedicatoriaBebe()
    {
        return $this->dedicatoriaBebe;
    }
    public function setDedicatoriaBebe($dedicatoriaBebe)
    {
        $this->dedicatoriaBebe = $dedicatoriaBebe;

        return $this;
    }
	
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}
	public function setIdUsuario($idUsuario)
	{
		$this->idUsuario = $idUsuario;
	
		return $this;
	}


    //Método constructor
    //El idBebe consta como null porque en la tabla es un valor que se auto incrementa    
    public function __construct($idBebe = null, $nombreBebe, $apellidosBebe, $fechaNacimiento, $horaNacimiento, $lugarNacimiento, $ciudadNacimiento, $grupoSanguineo, $imgNacimiento, $dedicatoriaBebe, $idUsuario)
    {
        $this->idBebe = $idBebe;
        $this->nombreBebe = $nombreBebe;
        $this->apellidosBebe = $apellidosBebe;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->horaNacimiento = $horaNacimiento;
        $this->lugarNacimiento = $lugarNacimiento;
        $this->ciudadNacimiento = $ciudadNacimiento;
        $this->grupoSanguineo = $grupoSanguineo;
        $this->imgNacimiento = $imgNacimiento;
        $this->dedicatoriaBebe = $dedicatoriaBebe;
		$this->idUsuario = $idUsuario;
    }


    //Para guardar los datos del bebé en la tabla de bebés
    public function guardarBebes() {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la inserción de los datos
        $consulta = $conexion -> prepare('INSERT INTO ' . self::BEBE . ' (nombreBebe, apellidosBebe, fechaNacimiento, horaNacimiento, lugarNacimiento, ciudadNacimiento, grupoSanguineo, imgNacimiento, dedicatoriaBebe, idUsuario) VALUES (:nombreBebe, :apellidosBebe, :fechaNacimiento, :horaNacimiento, :lugarNacimiento, :ciudadNacimiento, :grupoSanguineo, :imgNacimiento, :dedicatoriaBebe, :idUsuario)');
		//Identificamos los marcadores
		$consulta->bindParam(':nombreBebe', $this->nombreBebe);
		$consulta->bindParam(':apellidosBebe', $this->apellidosBebe);
		$consulta->bindParam(':fechaNacimiento', $this->fechaNacimiento);
		$consulta->bindParam(':horaNacimiento', $this->horaNacimiento);
		$consulta->bindParam(':lugarNacimiento', $this->lugarNacimiento);
		$consulta->bindParam(':ciudadNacimiento', $this->ciudadNacimiento);
		$consulta->bindParam(':grupoSanguineo', $this->grupoSanguineo);
		$consulta->bindParam(':imgNacimiento', $this->imgNacimiento);
		$consulta->bindParam(':dedicatoriaBebe', $this->dedicatoriaBebe);
		$consulta->bindParam(':idUsuario', $this->idUsuario);
        //Ejecutamos la consulta
        $consulta->execute();
        //Al finalizar la inserción recuperamos el idBebe que se acaba de insertar
        $this->idBebe=$conexion->lastInsertId();
        //Cerramos la conexión
        $conexion = null;
    }

	
    //Para eliminar los datos del bebé en la tabla de bebés
    public function eliminarBebes() {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la eliminación de los datos
        $consulta = $conexion -> prepare('DELETE FROM '. self::BEBE . ' WHERE idBebe = :idBebe');
        //Identificamos los marcadores
        $consulta->bindParam(':idBebe', $this->idBebe);
        //Ejecutamos el borrado
        $consulta->execute();
        //Cerramos la conexión
        $conexion = null;
    }

    //Método para buscar coincidencias con el mismo idBebe
    public static function buscarBebesId($idBebe) {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la consulta, seleccionando toda la información cuando coincida el idBebe 
        $consulta = $conexion->prepare('SELECT nombreBebe, apellidosBebe, fechaNacimiento, horaNacimiento, lugarNacimiento, ciudadNacimiento, grupoSanguineo, imgNacimiento, dedicatoriaBebe, idUsuario FROM ' . self::BEBE . ' WHERE idBebe = :idBebe');
        //Identificamos el marcador
        $consulta->bindParam(':idBebe', $idBebe);
        //Ejecutamos la consulta
        $consulta->execute();
        //Guardamos el resultado en la variable
        $registro = $consulta->fetch();
        //Devolvemos los datos si ha habido coincidencia
        if ($registro) {
            return new self($idBebe, $registro['nombreBebe'], $registro['apellidosBebe'], $registro['fechaNacimiento'], $registro['horaNacimiento'], $registro['lugarNacimiento'], $registro['ciudadNacimiento'], $registro['grupoSanguineo'], $registro['imgNacimiento'], $registro['dedicatoriaBebe'], $registro['idUsuario']);
        } else {
            //Si no retornamos un false
            return false;
        }
        //Cerramos la conexión
        $conexion = null;
    }
	

	//Método para buscar coincidencias, bebés repetidos
    public static function buscarBebesCompleto($nombreBebe, $apellidosBebe, $fechaNacimiento, $horaNacimiento, $lugarNacimiento, $ciudadNacimiento) {
        //Conectamos con la BBDD
        $conexion = new Conexion();
        //Preparamos la consulta, seleccionando toda la información cuando coincida el idBebe 
        $consulta = $conexion->prepare('SELECT idBebe, grupoSanguineo, imgNacimiento, dedicatoriaBebe, idUsuario  FROM ' . self::BEBE . ' WHERE nombreBebe = :nombreBebe AND apellidosBebe = :apellidosBebe AND fechaNacimiento = :fechaNacimiento AND horaNacimiento = :horaNacimiento AND lugarNacimiento = :lugarNacimiento AND ciudadNacimiento = :ciudadNacimiento');
        //Identificamos el marcador
        $consulta->bindParam(':nombreBebe', $nombreBebe);
		$consulta->bindParam(':apellidosBebe', $apellidosBebe);
		$consulta->bindParam(':fechaNacimiento', $fechaNacimiento);
		$consulta->bindParam(':horaNacimiento', $horaNacimiento);
		$consulta->bindParam(':lugarNacimiento', $lugarNacimiento);
		$consulta->bindParam(':ciudadNacimiento', $ciudadNacimiento);
        //Ejecutamos la consulta
        $consulta->execute();
        //Guardamos el resultado en la variable
        $registro = $consulta->fetch();
        //Devolvemos los datos si ha habido coincidencia
        if ($registro) {
            return new self($registro['idBebe'], $nombreBebe, $apellidosBebe, $fechaNacimiento, $horaNacimiento, $lugarNacimiento, $ciudadNacimiento, $registro['grupoSanguineo'], $registro['imgNacimiento'], $registro['dedicatoriaBebe'], $registro['idUsuario']);
        } else {
            //Si no retornamos un false
            return false;
        }
        //Cerramos la conexión
        $conexion = null;
    }

	
	//Método para listar bebés
	public static function listarBebes() {
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la selección de los datos de la tabla
		$consulta = $conexion->prepare('SELECT * FROM ' . self::BEBE . ' ORDER BY idBebe');
		//Ejectamos la consulta 
		$consulta->execute();
		//Y guardamos todas las filas en esta variable
		$registros = $consulta->fetchAll();
		//Devolvemos los datos
		return $registros;
		//Cerramos la conexión
		$conexion = null;
	}
	
	
	//Método para listar bebés de un usuario
	public static function listarBebesUsuario($idUsuario) {
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la selección de los datos de la tabla
		$consulta = $conexion->prepare('SELECT * FROM ' . self::BEBE . ' WHERE idUsuario = :idUsuario ORDER BY idBebe');
		//Identificamos el marcador
        $consulta->bindParam(':idUsuario', $idUsuario);
		//Ejectamos la consulta 
		$consulta->execute();
		//Y guardamos todas las filas en esta variable
		$registros = $consulta->fetchAll();
		//Devolvemos los datos
		return $registros;
		//Cerramos la conexión
		$conexion = null;
	}
	
	//Método para listar los tipos de grupo sanguíneo
	public static function listarGruposSanguineos(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion->prepare('SHOW columns FROM bebe LIKE "grupoSanguineo"');
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