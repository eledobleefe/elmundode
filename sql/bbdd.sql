-- Creamos la base de datos
CREATE DATABASE `elmundode` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- Creamos las tablas usuarios, mundos, nacimiento, familia, embarazo, crecimiento, dientes, anecdotas
CREATE TABLE `elmundode`.`usuario` (
    `idUsuario` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR (50) NOT NULL,
    `apellidos` VARCHAR (50) NOT NULL,
    `usuarios` VARCHAR (50) NOT NULL,
    `pass` VARCHAR (32) NOT NULL,
    -- Ponemos 32 porque es el número de caracteres al pasar la contraseña md5
    `rol` ENUM('creador', 'visitante'),
    `idMundo` INT NOT NULL
) ENGINE = INNODB;



CREATE TABLE `elmundode`.`mundo` (
    `idMundo` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombreMundo` VARCHAR (50) NOT NULL,
    `textoMundo` VARCHAR (200) NOT NULL
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`usuario`
ADD FOREIGN KEY (`idMundo`) REFERENCES `elmundode`.`mundo`(`idMundo` );



CREATE TABLE `elmundode`.`nacimiento` (
    `idNacimiento` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fechaNacimiento` DATE NOT NULL,
    `horaNacimiento`TIME NOT NULL,
    `hospital` VARCHAR (50) NOT NULL,
    `ciudadNacimiento` VARCHAR (50) NOT NULL,
    `kgNacimiento` VARCHAR (50) NOT NULL,
    `cmNacimiento` VARCHAR (50) NOT NULL,
    `grupoSanguineo` ENUM('0 -', '0 +', 'A -', 'A +', 'B -', 'B +', 'AB -', 'AB +'), 
    `imgNacimiento` VARCHAR (50),
    `idMundo` INT NOT NULL 
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`nacimiento`
ADD FOREIGN KEY (`idMundo`) REFERENCES `elmundode`.`mundo`(`idMundo` );


CREATE TABLE `elmundode`.`familia` (
    `idFamilia` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `progenitor1` VARCHAR (50) NOT NULL,
    `edadP1` INT NOT NULL,
    `textoP1` VARCHAR (50) NOT NULL,
    `imgP1` VARCHAR (50),
    `progenitor2` VARCHAR (50) NOT NULL,
    `edadP2` INT NOT NULL,
    `textoP2` VARCHAR (50) NOT NULL,
    `imgP2` VARCHAR (50),
    `idMundo` INT NOT NULL
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`familia`
ADD FOREIGN KEY (`idMundo`) REFERENCES `elmundode`.`mundo`(`idMundo` );


CREATE TABLE `elmundode`.`embarazo` (
    `idEmbarazo` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `semanas` INT NOT NULL,
    `dias` INT NOT NULL,
    `kgAumento` FLOAT NOT NULL,
    `fechaEmbarazo` DATE NOT NULL,
    `imgEcografia` VARCHAR (50),
    `idMundo` INT NOT NULL
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`embarazo`
ADD FOREIGN KEY (`idMundo`) REFERENCES `elmundode`.`mundo`(`idMundo` );


CREATE TABLE `elmundode`.`crecimiento` (
    `idCrecimiento` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fechaDatos` DATE NOT NULL,
    `altura` FLOAT NOT NULL,
    `peso` FLOAT NOT NULL,
    `cabeza` FLOAT NOT NULL,
    `idMundo` INT NOT NULL
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`crecimiento`
ADD FOREIGN KEY (`idMundo`) REFERENCES `elmundode`.`mundo`(`idMundo` );


CREATE TABLE `elmundode`.`diente` (
    `idDiente` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fechaDiente` DATE NOT NULL,
    `ordenDiente` ENUM ('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'),
    `nombreDiente` ENUM ('Incisivo central izquierdo superior','Incisivo central derecho superior','Incisivo lateral izquierdo superior','Incisivo lateral derecho superior','Canino izquierdo superior','Canino derecho superior','Primer molar izquierdo superior','Primer molar derecho superior','Segundo molar izquierdo superior','Segundo molar derecho superior','Incisivo central izquierdo inferior','Incisivo central derecho inferior','Incisivo lateral izquierdo inferior','Incisivo lateral derecho inferior','Canino izquierdo inferior','Canino derecho inferior','Primer molar izquierdo inferior','Primer molar derecho inferior','Segundo molar izquierdo inferior','Segundo molar derecho inferior'),
     `idMundo` INT NOT NULL
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`diente`
ADD FOREIGN KEY (`idMundo`) REFERENCES `elmundode`.`mundo`(`idMundo` );


CREATE TABLE `elmundode`.`anecdota` (
    `idAnecdota` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    
    `nombrePalabra` VARCHAR (50) NOT NULL,
    `fechaPalabra` DATE NOT NULL,
    
    `fechaGateo` DATE NOT NULL,
    `lugarGateo` VARCHAR (50) NOT NULL,
    
    `fechaPasos` DATE NOT NULL,
    `lugarPasos` VARCHAR (50) NOT NULL,
    
    `nombrePeluche` VARCHAR (50) NOT NULL,
    `imgPeluche` VARCHAR (50) NOT NULL,
    
    `nombreColor` VARCHAR (50) NOT NULL,
    `imgColor` VARCHAR (50) NOT NULL,
    
    `nombrePlaya` VARCHAR (50) NOT NULL,
    `fechaPlaya` DATE NOT NULL,
    `imgPlaya` VARCHAR (50),
    
    `nombreCampo` VARCHAR (50) NOT NULL,
    `fechaCampo` DATE NOT NULL,
    `imgCampo` VARCHAR (50), 
    
    `nombreComida` VARCHAR (50) NOT NULL,
    `fechaComida` DATE NOT NULL,
    `imgComida` VARCHAR (50), 
    
    `nombreCole` VARCHAR (50) NOT NULL,
    `fechaCole` DATE NOT NULL,
    `imgCole` VARCHAR (50), 
    
    `nombreProfe` VARCHAR (50) NOT NULL,
    `cursoProfe` VARCHAR (50) NOT NULL,
    `imgProfe` VARCHAR (50), 
    
    `nombreAmigo` VARCHAR (50) NOT NULL,
    `lugarAmigo` DATE NOT NULL,
    `imgAmigo` VARCHAR (50), 
    
    `nombreCancion` VARCHAR (50) NOT NULL,
    `linkCancion` VARCHAR (50) NOT NULL,

    `nombrePelicula` VARCHAR (50) NOT NULL,
    `linkPelicula` VARCHAR (50) NOT NULL,
    
    `idMundo` INT NOT NULL

) ENGINE = INNODB;

ALTER TABLE `elmundode`.`anecdota`
ADD FOREIGN KEY (`idMundo`) REFERENCES `elmundode`.`mundo`(`idMundo` );

-- Creamos el usuario daw, que será el administrador, con la contraseña abc123.
CREATE USER `daw`
    IDENTIFIED BY 'abc123.';
    
-- Le damos acceso a todas las tablas (meteogalicia.*) al usuario dwes    
GRANT ALL ON `elmundode`.*
    TO `daw`;

