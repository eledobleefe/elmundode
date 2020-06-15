-- Creamos la base de datos
CREATE DATABASE `elmundode` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- Creamos las tablas bebe, usuario, progenitor, embarazo, crecimiento, dentadura y anecdota
CREATE TABLE `elmundode`.`usuario` (
    `idUsuario` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombreUsuario` VARCHAR (50) NOT NULL,
    `apellidosUsuario` VARCHAR (50) NOT NULL,
    `email` VARCHAR (50) NOT NULL,
    `pass` VARCHAR (32) NOT NULL,
    -- Ponemos 32 porque es el número de caracteres al pasar la contraseña md5
    `rol` ENUM('creador', 'visitante'),
    CONSTRAINT UsuarioUnico UNIQUE (email, pass)
) ENGINE = INNODB;

CREATE TABLE `elmundode`.`bebe` (
    `idBebe` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombreBebe` VARCHAR (50) NOT NULL,
    `apellidosBebe` VARCHAR (50) NOT NULL,
    `fechaNacimiento` DATE NOT NULL,
    `horaNacimiento` TIME NOT NULL,
    `lugarNacimiento` VARCHAR (50),
    `ciudadNacimiento` VARCHAR (50),
    `grupoSanguineo` ENUM('0 -', '0 +', 'A -', 'A +', 'B -', 'B +', 'AB -', 'AB +'),
    `imgNacimiento` VARCHAR (50),
    `dedicatoriaBebe` VARCHAR (200) NOT NULL,
    `idUsuario`INT NOT NULL,
    CONSTRAINT BebeUnico UNIQUE (nombreBebe, apellidosBebe, fechaNacimiento, horaNacimiento, lugarNacimiento)
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`bebe`
ADD FOREIGN KEY (`idUsuario`) REFERENCES `elmundode`.`usuario`(`idUsuario` );

CREATE TABLE `elmundode`.`progenitor` (
    `idProgenitor` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombreProgenitor` VARCHAR (50) NOT NULL,
    `apellidosProgenitor` VARCHAR (50) NOT NULL,
    `tipoProgenitor` ENUM('madre','padre'),
    `fechaNProgenitor`  DATE NOT NULL,
    `lugarNProgenitor` VARCHAR (50) NOT NULL,
    `descripcionProgenitor`VARCHAR (50) NOT NULL,
    `imgProgenitor` VARCHAR (50),
    `idBebe` INT NOT NULL,
    CONSTRAINT ProgenitorUnico UNIQUE (nombreProgenitor, apellidosProgenitor, fechaNProgenitor, lugarNProgenitor, idBebe)
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`progenitor`
ADD FOREIGN KEY (`idBebe`) REFERENCES `elmundode`.`bebe`(`idBebe` );

CREATE TABLE `elmundode`.`embarazo` (
    `idBebe` INT NOT NULL,
    `idProgenitor` INT NOT NULL,
    `semanasEmbarazo` INT NOT NULL,
    `diasEmbarazo` INT NOT NULL,
    `kgAumento` FLOAT NOT NULL,
    `fechaNoticia` DATE NOT NULL,
    CONSTRAINT fkembarazo1 FOREIGN KEY (`idBebe`) REFERENCES `elmundode`.`bebe`(`idBebe` ) ,
    CONSTRAINT fkembarazo2 FOREIGN KEY (`idProgenitor`) REFERENCES `elmundode`.`progenitor`(`idProgenitor` ) 
) ENGINE = INNODB;


ALTER TABLE `elmundode`.`embarazo`
ADD PRIMARY KEY (`idBebe`, `idProgenitor`);


CREATE TABLE `elmundode`.`crecimiento` (
    `idBebe` INT NOT NULL,
    `fechaDatos` DATE NOT NULL,
    `altura` FLOAT NOT NULL,
    `peso` FLOAT NOT NULL,
    `cabeza` FLOAT NOT NULL,
    CONSTRAINT fkcrecimiento FOREIGN KEY (`idBebe`) REFERENCES `elmundode`.`bebe`(`idBebe` ) 
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`crecimiento`
ADD PRIMARY KEY (`idBebe`, `fechaDatos`);


CREATE TABLE `elmundode`.`dentadura` (
    `idBebe` INT NOT NULL,
    `fechaDiente` DATE NOT NULL,
    `ordenDiente` ENUM ('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'),
    `nombreDiente` ENUM ('Incisivo central izquierdo superior','Incisivo central derecho superior','Incisivo lateral izquierdo superior','Incisivo lateral derecho superior','Canino izquierdo superior','Canino derecho superior','Primer molar izquierdo superior','Primer molar derecho superior','Segundo molar izquierdo superior','Segundo molar derecho superior','Incisivo central izquierdo inferior','Incisivo central derecho inferior','Incisivo lateral izquierdo inferior','Incisivo lateral derecho inferior','Canino izquierdo inferior','Canino derecho inferior','Primer molar izquierdo inferior','Primer molar derecho inferior','Segundo molar izquierdo inferior','Segundo molar derecho inferior'),
     CONSTRAINT fkdentadura FOREIGN KEY (`idBebe`) REFERENCES `elmundode`.`bebe`(`idBebe` ) 
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`dentadura`
ADD PRIMARY KEY (`idBebe`, `nombreDiente`);


CREATE TABLE `elmundode`.`anecdota` (
    `idBebe` INT NOT NULL,
    `fechaAnecdota` DATE NOT NULL,
    `descripcionAnecdota` VARCHAR (50) NOT NULL,
    `nombreAnecdota` VARCHAR (50),
    `lugarAnecdota` VARCHAR (50),
    `extraAnecdota` VARCHAR (200),
    `tipoExtra` ENUM ('link', 'img'),
    CONSTRAINT fkanecdota FOREIGN KEY (`idBebe`) REFERENCES `elmundode`.`bebe`(`idBebe` ) 
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`anecdota`
ADD PRIMARY KEY (`idBebe`, `descripcionAnecdota`);


-- Creamos el usuario daw, que será el administrador, con la contraseña abc123.
CREATE USER `daw`
    IDENTIFIED BY 'abc123.';
    
-- Le damos acceso a todas las tablas (elmundode.*) al usuario daw    
GRANT ALL ON `elmundode`.*
    TO `daw`;

-- Creamos los disparadores:
-- Para que cuando se borre un usuario creador se borren los bebés asociados
CREATE TRIGGER `delete_bebe` AFTER DELETE ON `usuario`
FOR EACH ROW BEGIN
    DELETE FROM bebe WHERE bebe.idBebe = usuario.idBebe AND usuario.rol = 'creador';
END

-- Para que cuando se borre un bebe se borren todos los datos asociados
CREATE TRIGGER `delete_mundobebe` AFTER DELETE ON `bebe`
FOR EACH ROW BEGIN
    --Que sólo elimine los usuarios vinculados con rol de visitante
    DELETE FROM usuario WHERE usuario.idBebe = bebe.idBebe AND usuario.rol = 'visitante';
    DELETE FROM progenitor WHERE progenitor.idBebe = bebe.idBebe;
    DELETE FROM embarazo WHERE embarazo.idBebe = bebe.idBebe;
    DELETE FROM crecimiento WHERE crecimiento.idBebe = bebe.idBebe;
    DELETE FROM dentadura WHERE dentadura.idBebe = bebe.idBebe;
    DELETE FROM anecdota WHERE anecdota.idBebe = bebe.idBebe;
END

-- Para que cuando se borre un progenitor se borren los embarazos asociados
CREATE TRIGGER `delete_embarazo` AFTER DELETE ON `progenitor`
FOR EACH ROW BEGIN
    DELETE FROM embarazo WHERE embarazo.idProgenitor = old.idProgenitor;
END