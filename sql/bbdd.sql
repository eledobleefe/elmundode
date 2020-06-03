-- Creamos la base de datos
CREATE DATABASE `elmundode` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- Creamos las tablas bebe, usuario, progenitor, crecimiento, dentadura, anecdota y embarazo

CREATE TABLE `elmundode`.`bebe` (
    `idBebe` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombreBebe` VARCHAR (50) NOT NULL,
    `apellidosBebe` VARCHAR (50) NOT NULL,
    `fechaNacimiento` DATE NOT NULL,
    `horaNacimiento` TIME NOT NULL,
    `hospitalNacimiento` VARCHAR (50),
    `lugarNacimiento` VARCHAR (50),
    `ciudadNacimiento` VARCHAR (50),
    `grupoSanguineo` ENUM('0 -', '0 +', 'A -', 'A +', 'B -', 'B +', 'AB -', 'AB +'),
    `imgNacimiento` VARCHAR (50),
    `dedicatoriaBebe` VARCHAR (200) NOT NULL,
    CONSTRAINT BebeUnico UNIQUE (nombreBebe, apellidosBebe, fechaNacimiento, horaNacimiento, lugarNacimiento)
) ENGINE = INNODB;



CREATE TABLE `elmundode`.`usuario` (
    `idUsuario` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombreUsuario` VARCHAR (50) NOT NULL,
    `apellidosUsuario` VARCHAR (50) NOT NULL,
    `email` VARCHAR (50) NOT NULL,
    `pass` VARCHAR (32) NOT NULL,
    -- Ponemos 32 porque es el número de caracteres al pasar la contraseña md5
    `rol` ENUM('creador', 'visitante'),
    `idBebe` INT NOT NULL,
    CONSTRAINT UsuarioUnico UNIQUE (email, pass)
) ENGINE = INNODB;

ALTER TABLE `elmundode`.`usuario`
ADD FOREIGN KEY (`idBebe`) REFERENCES `elmundode`.`bebe`(`idBebe` );

CREATE TABLE `elmundode`.`progenitor` (
    `idProgenitor` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombreProgenitor` VARCHAR (50) NOT NULL,
    `apellidosProgenitor` VARCHAR (50) NOT NULL,
    `tipoProgenitor` ENUM('madre','padre'),
    `fechaNProgenitor`  DATE NOT NULL,
    `lugarNProgenitor` VARCHAR (50) NOT NULL,
    `descripcionProgenitor`VARCHAR (50) NOT NULL,
    `idBebe` INT NOT NULL,
    CONSTRAINT ProgenitorUnico UNIQUE (nombreProgenitor, apellidosProgenitor, fechaNProgenitor, lugarNProgenitor)
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
    CONSTRAINT fkembarazo1 FOREIGN KEY (`idBebe`) REFERENCES `elmundode`.`bebe`(`idBebe` ),
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
    
-- Le damos acceso a todas las tablas (meteogalicia.*) al usuario dwes    
GRANT ALL ON `elmundode`.*
    TO `daw`;

