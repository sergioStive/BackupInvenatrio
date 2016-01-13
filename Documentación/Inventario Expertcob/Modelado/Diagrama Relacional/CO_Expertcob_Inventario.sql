SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `CO_Expertcob_Inventario` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `CO_Expertcob_Inventario` ;

-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Sucursales`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Sucursales` (
  `id_sucursal` INT NOT NULL AUTO_INCREMENT ,
  `ciudad` VARCHAR(15) NOT NULL ,
  `direccion` VARCHAR(20) NULL ,
  `telefono` VARCHAR(25) NULL ,
  PRIMARY KEY (`id_sucursal`) ,
  INDEX `Idx_Ciudad` (`ciudad` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Oficinas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Oficinas` (
  `num_oficina` INT NOT NULL AUTO_INCREMENT ,
  `nombre_oficina` VARCHAR(20) NOT NULL ,
  `id_sucursal` INT NOT NULL ,
  PRIMARY KEY (`num_oficina`) ,
  INDEX `fk_Oficinas_Sucursales1_idx` (`id_sucursal` ASC) ,
  CONSTRAINT `fk_Oficinas_Sucursales1`
    FOREIGN KEY (`id_sucursal` )
    REFERENCES `CO_Expertcob_Inventario`.`Sucursales` (`id_sucursal` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Responsables`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Responsables` (
  `numero_documento` BIGINT NOT NULL ,
  `nombres` VARCHAR(20) NOT NULL ,
  `apellidos` VARCHAR(20) NULL ,
  PRIMARY KEY (`numero_documento`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Puestos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Puestos` (
  `id_puesto` INT NOT NULL AUTO_INCREMENT ,
  `nombre_puesto` VARCHAR(20) NULL ,
  `id_responsable` BIGINT NOT NULL ,
  `num_oficina` INT NOT NULL ,
  PRIMARY KEY (`id_puesto`) ,
  INDEX `fk_Puestos_Responsables1_idx` (`id_responsable` ASC) ,
  INDEX `fk_Puestos_Oficinas1_idx` (`num_oficina` ASC) ,
  CONSTRAINT `fk_Puestos_Responsables1`
    FOREIGN KEY (`id_responsable` )
    REFERENCES `CO_Expertcob_Inventario`.`Responsables` (`numero_documento` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Puestos_Oficinas1`
    FOREIGN KEY (`num_oficina` )
    REFERENCES `CO_Expertcob_Inventario`.`Oficinas` (`num_oficina` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Marcas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Marcas` (
  `id_marca` INT NOT NULL AUTO_INCREMENT ,
  `nombre_marca` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`id_marca`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Clases`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Clases` (
  `id_clase` INT NOT NULL AUTO_INCREMENT ,
  `nombre_clase` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`id_clase`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Tipos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Tipos` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT ,
  `nombre_tipo` VARCHAR(20) NOT NULL ,
  `id_clase` INT NOT NULL ,
  PRIMARY KEY (`id_tipo`) ,
  INDEX `fk_Tipos_Clases1_idx` (`id_clase` ASC) ,
  CONSTRAINT `fk_Tipos_Clases1`
    FOREIGN KEY (`id_clase` )
    REFERENCES `CO_Expertcob_Inventario`.`Clases` (`id_clase` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Estados`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Estados` (
  `id_estado` INT NOT NULL AUTO_INCREMENT ,
  `descripcion` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`id_estado`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Dispositivos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Dispositivos` (
  `id_dispositivo` INT NOT NULL AUTO_INCREMENT ,
  `num_modelo` VARCHAR(15) NULL ,
  `serial` VARCHAR(25) NULL ,
  `valor` VARCHAR(15) NOT NULL ,
  `observacion` VARCHAR(40) NULL ,
  `id_puesto` INT NOT NULL ,
  `id_marca` INT NOT NULL ,
  `id_tipo` INT NOT NULL ,
  `id_estado` INT NOT NULL ,
  PRIMARY KEY (`id_dispositivo`) ,
  INDEX `fk_Partes_Puestos1_idx` (`id_puesto` ASC) ,
  INDEX `Idx_Serial` (`serial` ASC) ,
  INDEX `Idx_Modelo` (`num_modelo` ASC) ,
  INDEX `fk_Partes_Marcas1_idx` (`id_marca` ASC) ,
  INDEX `fk_Partes_Tipos1_idx` (`id_tipo` ASC) ,
  INDEX `fk_Dispositivos_Estados1_idx` (`id_estado` ASC) ,
  CONSTRAINT `fk_Partes_Puestos1`
    FOREIGN KEY (`id_puesto` )
    REFERENCES `CO_Expertcob_Inventario`.`Puestos` (`id_puesto` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Partes_Marcas1`
    FOREIGN KEY (`id_marca` )
    REFERENCES `CO_Expertcob_Inventario`.`Marcas` (`id_marca` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Partes_Tipos1`
    FOREIGN KEY (`id_tipo` )
    REFERENCES `CO_Expertcob_Inventario`.`Tipos` (`id_tipo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Dispositivos_Estados1`
    FOREIGN KEY (`id_estado` )
    REFERENCES `CO_Expertcob_Inventario`.`Estados` (`id_estado` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`SistemaOperativos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`SistemaOperativos` (
  `id_so` INT NOT NULL AUTO_INCREMENT ,
  `nombre_so` VARCHAR(25) NOT NULL ,
  PRIMARY KEY (`id_so`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Office`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Office` (
  `id_office` INT NOT NULL AUTO_INCREMENT ,
  `nombre_office` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`id_office`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Torres`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Torres` (
  `id_torrre` INT NOT NULL ,
  `procesador` VARCHAR(25) NULL ,
  `ram` VARCHAR(10) NULL ,
  `hdd` VARCHAR(10) NULL ,
  `diquete` VARCHAR(2) NULL ,
  `cd_rom` VARCHAR(2) NULL ,
  `antivirus` VARCHAR(2) NULL ,
  `sis_operativo_key` VARCHAR(20) NULL ,
  `office_key` VARCHAR(20) NULL ,
  `id_so` INT NOT NULL ,
  `id_oficce` INT NOT NULL ,
  INDEX `fk_Torres_Partes1_idx` (`id_torrre` ASC) ,
  PRIMARY KEY (`id_torrre`) ,
  INDEX `fk_Torres_Sistemas_Operativos1_idx` (`id_so` ASC) ,
  INDEX `fk_Torres_Oficce1_idx` (`id_oficce` ASC) ,
  CONSTRAINT `fk_Torres_Partes1`
    FOREIGN KEY (`id_torrre` )
    REFERENCES `CO_Expertcob_Inventario`.`Dispositivos` (`id_dispositivo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Torres_Sistemas_Operativos1`
    FOREIGN KEY (`id_so` )
    REFERENCES `CO_Expertcob_Inventario`.`SistemaOperativos` (`id_so` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Torres_Oficce1`
    FOREIGN KEY (`id_oficce` )
    REFERENCES `CO_Expertcob_Inventario`.`Office` (`id_office` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Roles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Roles` (
  `id_rol` INT NOT NULL AUTO_INCREMENT ,
  `nombre_rol` VARCHAR(15) NOT NULL ,
  PRIMARY KEY (`id_rol`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Usuarios` (
  `numero_documento` BIGINT NOT NULL ,
  `nombres` VARCHAR(20) NOT NULL ,
  `apellidos` VARCHAR(20) NULL ,
  `clave` VARCHAR(50) NOT NULL ,
  `id_sucursal` INT NOT NULL ,
  `id_rol` INT NOT NULL ,
  PRIMARY KEY (`numero_documento`) ,
  INDEX `fk_Usuarios_Sucursales1_idx` (`id_sucursal` ASC) ,
  INDEX `fk_Usuarios_Roles1_idx` (`id_rol` ASC) ,
  CONSTRAINT `fk_Usuarios_Sucursales1`
    FOREIGN KEY (`id_sucursal` )
    REFERENCES `CO_Expertcob_Inventario`.`Sucursales` (`id_sucursal` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Usuarios_Roles1`
    FOREIGN KEY (`id_rol` )
    REFERENCES `CO_Expertcob_Inventario`.`Roles` (`id_rol` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`MuebleEnceres`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`MuebleEnceres` (
  `id_mueble_encer` INT NOT NULL AUTO_INCREMENT ,
  `descripcion` VARCHAR(25) NULL ,
  `cantidad` INT NULL ,
  `valor` VARCHAR(15) NULL ,
  `id_estado` INT NOT NULL ,
  `num_oficina` INT NOT NULL ,
  PRIMARY KEY (`id_mueble_encer`) ,
  INDEX `fk_Muebles_Enceres_Estados1_idx` (`id_estado` ASC) ,
  INDEX `fk_MuebleEnceres_Oficinas1_idx` (`num_oficina` ASC) ,
  CONSTRAINT `fk_Muebles_Enceres_Estados1`
    FOREIGN KEY (`id_estado` )
    REFERENCES `CO_Expertcob_Inventario`.`Estados` (`id_estado` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_MuebleEnceres_Oficinas1`
    FOREIGN KEY (`num_oficina` )
    REFERENCES `CO_Expertcob_Inventario`.`Oficinas` (`num_oficina` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Revisiones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Revisiones` (
  `id_revision` INT NOT NULL AUTO_INCREMENT ,
  `fecha` DATE NOT NULL ,
  `mantenimiento` VARCHAR(15) NOT NULL ,
  `observacion` VARCHAR(40) NULL ,
  `id_dispositivo` INT NOT NULL ,
  PRIMARY KEY (`id_revision`) ,
  INDEX `fk_Revisiones_Dispositivos1_idx` (`id_dispositivo` ASC) ,
  CONSTRAINT `fk_Revisiones_Dispositivos1`
    FOREIGN KEY (`id_dispositivo` )
    REFERENCES `CO_Expertcob_Inventario`.`Dispositivos` (`id_dispositivo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `CO_Expertcob_Inventario` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Sucursales`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Sucursales` (`id_sucursal`, `ciudad`, `direccion`, `telefono`) VALUES (1, 'Bogotá D.C.', 'Carrera 16A #78-75', '2182070');

COMMIT;

-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Marcas`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Marcas` (`id_marca`, `nombre_marca`) VALUES (1, 'HP');
INSERT INTO `CO_Expertcob_Inventario`.`Marcas` (`id_marca`, `nombre_marca`) VALUES (2, 'DELL');
INSERT INTO `CO_Expertcob_Inventario`.`Marcas` (`id_marca`, `nombre_marca`) VALUES (3, 'LENOVO');
INSERT INTO `CO_Expertcob_Inventario`.`Marcas` (`id_marca`, `nombre_marca`) VALUES (4, 'PANASONIC');

COMMIT;

-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Clases`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Clases` (`id_clase`, `nombre_clase`) VALUES (1, 'Computo');
INSERT INTO `CO_Expertcob_Inventario`.`Clases` (`id_clase`, `nombre_clase`) VALUES (2, 'Oficina');
INSERT INTO `CO_Expertcob_Inventario`.`Clases` (`id_clase`, `nombre_clase`) VALUES (3, 'Maquinaria');

COMMIT;

-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Tipos`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`id_tipo`, `nombre_tipo`, `id_clase`) VALUES (1, 'Torre', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`id_tipo`, `nombre_tipo`, `id_clase`) VALUES (2, 'Monitor', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`id_tipo`, `nombre_tipo`, `id_clase`) VALUES (3, 'Impresora', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`id_tipo`, `nombre_tipo`, `id_clase`) VALUES (4, 'Teclado', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`id_tipo`, `nombre_tipo`, `id_clase`) VALUES (5, 'Moto', 3);

COMMIT;

-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Estados`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Estados` (`id_estado`, `descripcion`) VALUES (1, 'Bueno');
INSERT INTO `CO_Expertcob_Inventario`.`Estados` (`id_estado`, `descripcion`) VALUES (2, 'Dañado');
INSERT INTO `CO_Expertcob_Inventario`.`Estados` (`id_estado`, `descripcion`) VALUES (3, 'Incompleto');
INSERT INTO `CO_Expertcob_Inventario`.`Estados` (`id_estado`, `descripcion`) VALUES (4, 'Para revisar');

COMMIT;

-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Roles` (`id_rol`, `nombre_rol`) VALUES (1, 'Administrador');
INSERT INTO `CO_Expertcob_Inventario`.`Roles` (`id_rol`, `nombre_rol`) VALUES (2, 'Sistemas');
INSERT INTO `CO_Expertcob_Inventario`.`Roles` (`id_rol`, `nombre_rol`) VALUES (3, 'Consulta');

COMMIT;
