<?php

//Necesitamos acceso al código contenidUsuarioo en 'Conexion.php'
require_once 'Conexion.php';

//Creamos la clase Usuario
class Usuario {
    //Cada propiedad corresponde a una columna de la tabla 'usuario'
    private $idUsuario;
    private $nombreUsuario;
    private $apellidosUsuario;
    private $email;
    private $pass;
    private $rol;
    //Excepto la constante con el nombreUsuario de la tabla
    const USUARIO = 'usuario';

    //Métodos get y set correspondientes
    public function getIdUsuario()
    {
        return $this->idUsuario;
    } 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    public function getnombreUsuario()
    {
        return $this->nombreUsuario;
    }
    public function setnombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    public function getApellidosUsuario()
    {
        return $this->apellidosUsuario;
    }
    public function setApellidoUsuario($apellidoUsuario)
    {
        $this->apellidoUsuario = $apellidoUsuario;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getPass()
    {
        return $this->pass;
    }
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }


    public function getRol()
    {
        return $this->rol;
    }
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    

    //Método constructor
    //El idUsuario consta como null porque en la tabla es un valor que se auto incrementa    
    public function __construct($idUsuario = null, $nombreUsuario, $apellidosUsuario, $email, $pass, $rol)
    {
        $this->idUsuario= $idUsuario;
        $this->nombreUsuario= $nombreUsuario;
        $this->apellidosUsuario= $apellidosUsuario;
        $this->email= $email;
        $this->pass= $pass;
        $this->rol= $rol;
    }


	
	//Para guardar los datos del usuario en la tabla de usuarios
    public function guardarUsuarios() {
        //Conectamos con la BBDD
        $conexion = new Conexion();
		//Preparamos la inserción de los datos
		$consulta = $conexion -> prepare('INSERT INTO '. self::USUARIO . '(nombreUsuario, apellidosUsuario, email, pass, rol) VALUES(:nombreUsuario, :apellidosUsuario, :email, :pass, :rol)');
		//idUsuarioentificamos los marcadores
		$consulta->bindParam(':nombreUsuario', $this->nombreUsuario);
		$consulta->bindParam(':apellidosUsuario', $this->apellidosUsuario);
		$consulta->bindParam(':email', $this->email);
		$consulta->bindParam(':pass', $this->pass);
		$consulta->bindParam(':rol', $this->rol);
		//Ejecutamos la consulta
		$consulta->execute();
		//Al finalizar la inserción recuperamos el idUsuario que se acaba de insertar
		$this->idUsuario=$conexion->lastInsertId();
		//Cerramos la conexión
		$conexion = null;
    }


	//Método para eliminar usuario
	public function eliminarUsuarios(){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion -> prepare('DELETE FROM '. self::USUARIO . ' WHERE idUsuario = :idUsuario');
		//Identificamos los marcadores
		$consulta->bindParam(':idUsuario', $this->idUsuario);
		//Ejecutamos la consulta
		$consulta->execute();
		//Cerramos la conexión
		$conexion = null;
	}
	

	//Método buscar por idUsuario
	public static function buscarUsuariosId($idUsuario){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion -> prepare('SELECT nombreUsuario, apellidosUsuario, email, pass, rol FROM ' . self::USUARIO . ' WHERE idUsuario = :idUsuario');
		//Identificamos los marcadores
		$consulta -> bindParam(':idUsuario', $idUsuario);
		//Ejecutamos la consulta
		$consulta -> execute();
		//Guardamos el resultado en la variable
		$registro = $consulta ->fetch();
		//Devolvemos los datos si ha habido coincidencia
		if($registro){
			return new self($idUsuario, $registro['nombreUsuario'], $registro['apellidosUsuario'], $registro['email'], $registro['pass'], $registro['rol']);
		} else {
			return false;
		}
		//Cerramos la conexión
        $conexion = null;
	}
	
	
	//Método buscar por email
	public static function buscarUsuariosEmail($email){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion -> prepare('SELECT idUsuario, nombreUsuario, apellidosUsuario, pass, rol FROM ' . self::USUARIO . ' WHERE email = :email');
		//Identificamos los marcadores
		$consulta -> bindParam(':email', $email);
		//Ejecutamos la consulta
		$consulta -> execute();
		//Guardamos el resultado en la variable
		$registro = $consulta ->fetch();
		//Devolvemos los datos si ha habido coincidencia
		if($registro){
			return new self($registro['idUsuario'], $registro['nombreUsuario'], $registro['apellidosUsuario'], $email, $registro['pass'], $registro['rol']);
		} else {
			return false;
		}
		//Cerramos la conexión
        $conexion = null;
	}
	
	//Método buscar por email
	public static function buscarUsuariosCompleto($email,$pass){
		//Conectamos con la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion -> prepare('SELECT idUsuario, nombreUsuario, apellidosUsuario, rol FROM ' . self::USUARIO . ' WHERE email = :email AND pass = :pass');
		//Identificamos los marcadores
		$consulta -> bindParam(':email', $email);
		$consulta -> bindParam(':pass', $pass);
		//Ejecutamos la consulta
		$consulta -> execute();
		//Guardamos el resultado en la variable
		$registro = $consulta ->fetch();
		//Devolvemos los datos si ha habido coincidencia
		if($registro){
			return new self($registro['idUsuario'], $registro['nombreUsuario'], $registro['apellidosUsuario'], $email, $pass, $registro['rol']);
		} else {
			return false;
		}
		//Cerramos la conexión
        $conexion = null;
	}

	//Método para listar todos los usuarios
	public static function listarUsuarios(){
		//Conectamos a la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion -> prepare('SELECT * FROM '. self::USUARIO . ' ORDER BY idBebe');
		//Ejecutamos la consulta
		$consulta -> execute();
		//Guardamos la respuesta y la devolvemos
		$registros = $consulta -> fetchAll();
		return $registros;
		//Cerramos la conexion
		$conexion = null;
	}
	
	
	//Método para listar los usuarios de un idBebe
	public static function listarUsuariosBebe($idBebe){
		//Conectamos a la BBDD
		$conexion = new Conexion();
		//Preparamos la consulta
		$consulta = $conexion -> prepare('SELECT * FROM '. self::USUARIO . ' WHERE idBebe = :idBebe');
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
	
