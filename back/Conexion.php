<?php

//Creamos una clase para la conexión

class Conexion {

    //guardamos la información necesaria para la conexión 
    //en las propiedades de la clase
    private $tipoDB = 'mysql';
    private $host = 'localhost';
    private $bbdd = 'elmundode';
    private $usuario = 'daw';
    private $password = 'abc123.';
	
	protected static $conexion;

    private function __construct() {
        //Usamos un try catch para controlar posibles errores
        try {
            self::$conexion = new PDO($this->tipoDB . ':host=' . $this->host . ';dbname=' . $this->bbdd, $this->usuario, $this->password);
			self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$conexion->setAttribute(PDO::ATTR_PERSISTENT, false);
        } catch (PDOException $e) {
            echo "Error.No se puede conectar a la base de datos.\n" . $e->getMessage();
            exit;
        }
    }

	public static function conectar(){
		if(!self::$conexion){
			new Conexion();
        }
        return self::$conexion;
	}
	
	public static function desconectar(){
		if(self::$conexion){
			self::$conexion = null;
        }
        return self::$conexion;
	}
}
