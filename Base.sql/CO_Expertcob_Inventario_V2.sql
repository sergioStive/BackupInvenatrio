-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema CO_Expertcob_Inventario
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema CO_Expertcob_Inventario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `CO_Expertcob_Inventario` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `CO_Expertcob_Inventario` ;

-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Ciudades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Ciudades` (
  `IdCiudad` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `NombreCiudad` VARCHAR(20) NOT NULL COMMENT '',
  PRIMARY KEY (`IdCiudad`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Sucursales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Sucursales` (
  `IdSucursal` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Barrio` VARCHAR(20) NOT NULL COMMENT '',
  `Direccion` VARCHAR(20) NOT NULL COMMENT '',
  `Telefono` VARCHAR(25) NULL COMMENT '',
  `IdCiudad` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdSucursal`)  COMMENT '',
  INDEX `fk_Sucursales_Ciudades1_idx` (`IdCiudad` ASC)  COMMENT '',
  CONSTRAINT `fk_Sucursales_Ciudades1`
    FOREIGN KEY (`IdCiudad`)
    REFERENCES `CO_Expertcob_Inventario`.`Ciudades` (`IdCiudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Oficinas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Oficinas` (
  `IdOficina` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `NombreOficina` VARCHAR(20) NOT NULL COMMENT '',
  `IdSucursal` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdOficina`)  COMMENT '',
  INDEX `fk_Oficinas_Sucursales1_idx` (`IdSucursal` ASC)  COMMENT '',
  CONSTRAINT `fk_Oficinas_Sucursales1`
    FOREIGN KEY (`IdSucursal`)
    REFERENCES `CO_Expertcob_Inventario`.`Sucursales` (`IdSucursal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Responsables`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Responsables` (
  `IdResponsable` BIGINT NOT NULL COMMENT '',
  `Nombres` VARCHAR(20) NOT NULL COMMENT '',
  `Apellidos` VARCHAR(20) NULL COMMENT '',
  PRIMARY KEY (`IdResponsable`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Puestos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Puestos` (
  `IdPuesto` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `NombrePuesto` VARCHAR(20) NOT NULL COMMENT '',
  `IdResponsable` BIGINT NOT NULL COMMENT '',
  `IdOficina` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdPuesto`)  COMMENT '',
  INDEX `fk_Puestos_Responsables1_idx` (`IdResponsable` ASC)  COMMENT '',
  INDEX `fk_Puestos_Oficinas1_idx` (`IdOficina` ASC)  COMMENT '',
  CONSTRAINT `fk_Puestos_Responsables1`
    FOREIGN KEY (`IdResponsable`)
    REFERENCES `CO_Expertcob_Inventario`.`Responsables` (`IdResponsable`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Puestos_Oficinas1`
    FOREIGN KEY (`IdOficina`)
    REFERENCES `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Marcas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Marcas` (
  `IdMarca` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `NombreMarca` VARCHAR(20) NOT NULL COMMENT '',
  PRIMARY KEY (`IdMarca`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Clases`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Clases` (
  `IdClase` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `NombreClase` VARCHAR(20) NOT NULL COMMENT '',
  PRIMARY KEY (`IdClase`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Tipos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Tipos` (
  `IdTipo` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `NombreTipo` VARCHAR(20) NOT NULL COMMENT '',
  `IdClase` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdTipo`)  COMMENT '',
  INDEX `fk_Tipos_Clases1_idx` (`IdClase` ASC)  COMMENT '',
  CONSTRAINT `fk_Tipos_Clases1`
    FOREIGN KEY (`IdClase`)
    REFERENCES `CO_Expertcob_Inventario`.`Clases` (`IdClase`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Estados` (
  `IdEstado` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Descripcion` VARCHAR(30) NOT NULL COMMENT '',
  PRIMARY KEY (`IdEstado`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`SistemaOperativos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`SistemaOperativos` (
  `IdSisOperativo` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `NombreSisOperativo` VARCHAR(25) NOT NULL COMMENT '',
  PRIMARY KEY (`IdSisOperativo`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Office`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Office` (
  `IdOffice` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `NombreOffice` VARCHAR(30) NOT NULL COMMENT '',
  PRIMARY KEY (`IdOffice`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Equipos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Equipos` (
  `Serial` VARCHAR(25) NOT NULL COMMENT '',
  `Procesador` VARCHAR(25) NOT NULL COMMENT '',
  `Ram` VARCHAR(10) NOT NULL COMMENT '',
  `Hdd` VARCHAR(10) NOT NULL COMMENT '',
  `Diquete` TINYINT(1) NOT NULL COMMENT '',
  `CdRom` VARCHAR(15) NOT NULL COMMENT '',
  `Antivirus` VARCHAR(20) NOT NULL COMMENT '',
  `SisOperativoKey` VARCHAR(30) NOT NULL COMMENT '',
  `OfficeKey` VARCHAR(30) NOT NULL COMMENT '',
  `IdSisOperativo` INT NOT NULL COMMENT '',
  `IdOficce` INT NOT NULL COMMENT '',
  PRIMARY KEY (`Serial`)  COMMENT '',
  INDEX `fk_Torres_Sistemas_Operativos1_idx` (`IdSisOperativo` ASC)  COMMENT '',
  INDEX `fk_Torres_Oficce1_idx` (`IdOficce` ASC)  COMMENT '',
  CONSTRAINT `fk_Torres_Sistemas_Operativos1`
    FOREIGN KEY (`IdSisOperativo`)
    REFERENCES `CO_Expertcob_Inventario`.`SistemaOperativos` (`IdSisOperativo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Torres_Oficce1`
    FOREIGN KEY (`IdOficce`)
    REFERENCES `CO_Expertcob_Inventario`.`Office` (`IdOffice`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Dispositivos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Dispositivos` (
  `IdDispositivo` INT NOT NULL COMMENT '',
  `Serial` VARCHAR(25) NULL COMMENT '',
  `Modelo` VARCHAR(15) NULL COMMENT '',
  `Valor` DECIMAL NOT NULL COMMENT '',
  `Observacion` VARCHAR(80) NULL COMMENT '',
  `IdMarca` INT NOT NULL COMMENT '',
  `IdTipo` INT NOT NULL COMMENT '',
  `IdEstado` INT NOT NULL COMMENT '',
  `SerialEquipo` VARCHAR(25) NULL COMMENT '',
  `IdPuesto` INT NOT NULL COMMENT '',
  INDEX `Idx_Serial` (`Serial` ASC)  COMMENT '',
  INDEX `Idx_Modelo` (`Modelo` ASC)  COMMENT '',
  INDEX `fk_Partes_Marcas1_idx` (`IdMarca` ASC)  COMMENT '',
  INDEX `fk_Partes_Tipos1_idx` (`IdTipo` ASC)  COMMENT '',
  INDEX `fk_Dispositivos_Estados1_idx` (`IdEstado` ASC)  COMMENT '',
  INDEX `fk_Dispositivos_Equipos1_idx` (`SerialEquipo` ASC)  COMMENT '',
  INDEX `fk_Dispositivos_Puestos1_idx` (`IdPuesto` ASC)  COMMENT '',
  PRIMARY KEY (`IdDispositivo`)  COMMENT '',
  CONSTRAINT `fk_Partes_Marcas1`
    FOREIGN KEY (`IdMarca`)
    REFERENCES `CO_Expertcob_Inventario`.`Marcas` (`IdMarca`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Partes_Tipos1`
    FOREIGN KEY (`IdTipo`)
    REFERENCES `CO_Expertcob_Inventario`.`Tipos` (`IdTipo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Dispositivos_Estados1`
    FOREIGN KEY (`IdEstado`)
    REFERENCES `CO_Expertcob_Inventario`.`Estados` (`IdEstado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Dispositivos_Equipos1`
    FOREIGN KEY (`SerialEquipo`)
    REFERENCES `CO_Expertcob_Inventario`.`Equipos` (`Serial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Dispositivos_Puestos1`
    FOREIGN KEY (`IdPuesto`)
    REFERENCES `CO_Expertcob_Inventario`.`Puestos` (`IdPuesto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Roles` (
  `IdRol` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `NombreRol` VARCHAR(15) NOT NULL COMMENT '',
  PRIMARY KEY (`IdRol`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Usuarios` (
  `IdUsuario` BIGINT NOT NULL COMMENT '',
  `Nombres` VARCHAR(20) NOT NULL COMMENT '',
  `Apellidos` VARCHAR(20) NULL COMMENT '',
  `Clave` VARCHAR(50) NOT NULL COMMENT '',
  `IdSucursal` INT NOT NULL COMMENT '',
  `IdRol` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdUsuario`)  COMMENT '',
  INDEX `fk_Usuarios_Sucursales1_idx` (`IdSucursal` ASC)  COMMENT '',
  INDEX `fk_Usuarios_Roles1_idx` (`IdRol` ASC)  COMMENT '',
  CONSTRAINT `fk_Usuarios_Sucursales1`
    FOREIGN KEY (`IdSucursal`)
    REFERENCES `CO_Expertcob_Inventario`.`Sucursales` (`IdSucursal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_Roles1`
    FOREIGN KEY (`IdRol`)
    REFERENCES `CO_Expertcob_Inventario`.`Roles` (`IdRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`MuebleEnseres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`MuebleEnseres` (
  `IdMuebleEnseres` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Descripcion` VARCHAR(35) NOT NULL COMMENT '',
  `Cantidad` INT NOT NULL COMMENT '',
  `Valor` DECIMAL NOT NULL COMMENT '',
  `IdEstado` INT NOT NULL COMMENT '',
  `IdOficina` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdMuebleEnseres`)  COMMENT '',
  INDEX `fk_Muebles_Enceres_Estados1_idx` (`IdEstado` ASC)  COMMENT '',
  INDEX `fk_MuebleEnseres_Oficinas1_idx` (`IdOficina` ASC)  COMMENT '',
  CONSTRAINT `fk_Muebles_Enceres_Estados1`
    FOREIGN KEY (`IdEstado`)
    REFERENCES `CO_Expertcob_Inventario`.`Estados` (`IdEstado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_MuebleEnseres_Oficinas1`
    FOREIGN KEY (`IdOficina`)
    REFERENCES `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Revisiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Revisiones` (
  `IdRevision` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Fecha` DATE NOT NULL COMMENT '',
  `Mantenimiento` ENUM('PREVENTIVO','CORRECTIVO') NOT NULL COMMENT '',
  `Responsable` VARCHAR(40) NOT NULL COMMENT '',
  `Observacion` VARCHAR(100) NULL COMMENT '',
  `SerialEquipo` VARCHAR(25) NOT NULL COMMENT '',
  PRIMARY KEY (`IdRevision`)  COMMENT '',
  INDEX `fk_Revisiones_Equipos1_idx` (`SerialEquipo` ASC)  COMMENT '',
  CONSTRAINT `fk_Revisiones_Equipos1`
    FOREIGN KEY (`SerialEquipo`)
    REFERENCES `CO_Expertcob_Inventario`.`Equipos` (`Serial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Proveedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Proveedores` (
  `IdProveedor` INT NOT NULL COMMENT '',
  `NombreProveeedor` VARCHAR(30) NOT NULL COMMENT '',
  `Direccion` VARCHAR(20) NOT NULL COMMENT '',
  `Telefono` VARCHAR(25) NOT NULL COMMENT '',
  `Email` VARCHAR(20) NOT NULL COMMENT '',
  PRIMARY KEY (`IdProveedor`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`Compras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`Compras` (
  `Factura` VARCHAR(15) NOT NULL COMMENT '',
  `Valor` DECIMAL NOT NULL COMMENT '',
  `Fecha` TIME NOT NULL COMMENT '',
  `Garantia` VARCHAR(15) NOT NULL COMMENT '',
  `IdProveedor` INT NOT NULL COMMENT '',
  INDEX `fk_Dispositivos_has_Proveedores_Proveedores1_idx` (`IdProveedor` ASC)  COMMENT '',
  PRIMARY KEY (`Factura`)  COMMENT '',
  CONSTRAINT `fk_Dispositivos_has_Proveedores_Proveedores1`
    FOREIGN KEY (`IdProveedor`)
    REFERENCES `CO_Expertcob_Inventario`.`Proveedores` (`IdProveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CO_Expertcob_Inventario`.`CompraDispositivos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `CO_Expertcob_Inventario`.`CompraDispositivos` (
  `Factura` VARCHAR(15) NOT NULL COMMENT '',
  `IdlDispositivo` INT NOT NULL COMMENT '',
  PRIMARY KEY (`Factura`, `IdlDispositivo`)  COMMENT '',
  INDEX `fk_Dispositivos_has_Compras_Dispositivos1_idx` (`IdlDispositivo` ASC)  COMMENT '',
  INDEX `fk_DispositivoCompras_Compras1_idx` (`Factura` ASC)  COMMENT '',
  CONSTRAINT `fk_Dispositivos_has_Compras_Dispositivos1`
    FOREIGN KEY (`IdlDispositivo`)
    REFERENCES `CO_Expertcob_Inventario`.`Dispositivos` (`IdDispositivo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DispositivoCompras_Compras1`
    FOREIGN KEY (`Factura`)
    REFERENCES `CO_Expertcob_Inventario`.`Compras` (`Factura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Ciudades`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Ciudades` (`IdCiudad`, `NombreCiudad`) VALUES (1, 'Bogotá ');
INSERT INTO `CO_Expertcob_Inventario`.`Ciudades` (`IdCiudad`, `NombreCiudad`) VALUES (2, 'Cali');
INSERT INTO `CO_Expertcob_Inventario`.`Ciudades` (`IdCiudad`, `NombreCiudad`) VALUES (3, 'Medellín');
INSERT INTO `CO_Expertcob_Inventario`.`Ciudades` (`IdCiudad`, `NombreCiudad`) VALUES (4, 'Cartagena');
INSERT INTO `CO_Expertcob_Inventario`.`Ciudades` (`IdCiudad`, `NombreCiudad`) VALUES (5, 'Barranquilla');
INSERT INTO `CO_Expertcob_Inventario`.`Ciudades` (`IdCiudad`, `NombreCiudad`) VALUES (6, 'Funza');

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Sucursales`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Sucursales` (`IdSucursal`, `Barrio`, `Direccion`, `Telefono`, `IdCiudad`) VALUES (1, 'El Lago', 'Carrera 16A #78-75', '2182070', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Sucursales` (`IdSucursal`, `Barrio`, `Direccion`, `Telefono`, `IdCiudad`) VALUES (2, 'El Campín', 'Carrera 30 # 52 - 15', '6542789', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Sucursales` (`IdSucursal`, `Barrio`, `Direccion`, `Telefono`, `IdCiudad`) VALUES (3, 'La Amapola', 'Calle 20B # 45-6 Sur', '2678903 - 3145678923', 3);
INSERT INTO `CO_Expertcob_Inventario`.`Sucursales` (`IdSucursal`, `Barrio`, `Direccion`, `Telefono`, `IdCiudad`) VALUES (4, 'El Rodadero', 'Calle 1 # 13 Este', '3576895', 5);
INSERT INTO `CO_Expertcob_Inventario`.`Sucursales` (`IdSucursal`, `Barrio`, `Direccion`, `Telefono`, `IdCiudad`) VALUES (5, 'Bodega', 'Diagonal 23 # 32 - 5', NULL, 6);

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Oficinas`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`, `NombreOficina`, `IdSucursal`) VALUES (1, '202', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`, `NombreOficina`, `IdSucursal`) VALUES (2, '503', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`, `NombreOficina`, `IdSucursal`) VALUES (3, '403', 3);
INSERT INTO `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`, `NombreOficina`, `IdSucursal`) VALUES (4, '403', 4);
INSERT INTO `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`, `NombreOficina`, `IdSucursal`) VALUES (5, '202', 3);
INSERT INTO `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`, `NombreOficina`, `IdSucursal`) VALUES (6, '501', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`, `NombreOficina`, `IdSucursal`) VALUES (7, '101', 4);
INSERT INTO `CO_Expertcob_Inventario`.`Oficinas` (`IdOficina`, `NombreOficina`, `IdSucursal`) VALUES (8, 'Bodega', 5);

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Responsables`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Responsables` (`IdResponsable`, `Nombres`, `Apellidos`) VALUES (1023013196, 'Erick Raúl ', 'Guzmán Ardila');
INSERT INTO `CO_Expertcob_Inventario`.`Responsables` (`IdResponsable`, `Nombres`, `Apellidos`) VALUES (1, 'Sistemas', NULL);
INSERT INTO `CO_Expertcob_Inventario`.`Responsables` (`IdResponsable`, `Nombres`, `Apellidos`) VALUES (2, '---', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Puestos`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Puestos` (`IdPuesto`, `NombrePuesto`, `IdResponsable`, `IdOficina`) VALUES (1, 'Sistemas 04', 1023013196, 1);
INSERT INTO `CO_Expertcob_Inventario`.`Puestos` (`IdPuesto`, `NombrePuesto`, `IdResponsable`, `IdOficina`) VALUES (2, 'Baño', 1, 3);
INSERT INTO `CO_Expertcob_Inventario`.`Puestos` (`IdPuesto`, `NombrePuesto`, `IdResponsable`, `IdOficina`) VALUES (3, 'Mantenimiento', 1, 4);
INSERT INTO `CO_Expertcob_Inventario`.`Puestos` (`IdPuesto`, `NombrePuesto`, `IdResponsable`, `IdOficina`) VALUES (4, 'Cocina', 2, 2);
INSERT INTO `CO_Expertcob_Inventario`.`Puestos` (`IdPuesto`, `NombrePuesto`, `IdResponsable`, `IdOficina`) VALUES (5, 'Alcoba 1', 2, 6);

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Marcas`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Marcas` (`IdMarca`, `NombreMarca`) VALUES (1, 'HP');
INSERT INTO `CO_Expertcob_Inventario`.`Marcas` (`IdMarca`, `NombreMarca`) VALUES (2, 'DELL');
INSERT INTO `CO_Expertcob_Inventario`.`Marcas` (`IdMarca`, `NombreMarca`) VALUES (3, 'LENOVO');
INSERT INTO `CO_Expertcob_Inventario`.`Marcas` (`IdMarca`, `NombreMarca`) VALUES (4, 'PANASONIC');

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Clases`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Clases` (`IdClase`, `NombreClase`) VALUES (1, 'Computo');
INSERT INTO `CO_Expertcob_Inventario`.`Clases` (`IdClase`, `NombreClase`) VALUES (2, 'Oficina');
INSERT INTO `CO_Expertcob_Inventario`.`Clases` (`IdClase`, `NombreClase`) VALUES (3, 'Maquinaria');

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Tipos`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`IdTipo`, `NombreTipo`, `IdClase`) VALUES (1, 'Torre', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`IdTipo`, `NombreTipo`, `IdClase`) VALUES (2, 'Monitor', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`IdTipo`, `NombreTipo`, `IdClase`) VALUES (3, 'Impresora', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`IdTipo`, `NombreTipo`, `IdClase`) VALUES (4, 'Teclado', 1);
INSERT INTO `CO_Expertcob_Inventario`.`Tipos` (`IdTipo`, `NombreTipo`, `IdClase`) VALUES (5, 'Moto', 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Estados`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Estados` (`IdEstado`, `Descripcion`) VALUES (1, 'Bueno');
INSERT INTO `CO_Expertcob_Inventario`.`Estados` (`IdEstado`, `Descripcion`) VALUES (2, 'Dañado');
INSERT INTO `CO_Expertcob_Inventario`.`Estados` (`IdEstado`, `Descripcion`) VALUES (3, 'Incompleto');
INSERT INTO `CO_Expertcob_Inventario`.`Estados` (`IdEstado`, `Descripcion`) VALUES (4, 'Para revisar');

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Roles` (`IdRol`, `NombreRol`) VALUES (1, 'Administrador');
INSERT INTO `CO_Expertcob_Inventario`.`Roles` (`IdRol`, `NombreRol`) VALUES (2, 'Sistemas');
INSERT INTO `CO_Expertcob_Inventario`.`Roles` (`IdRol`, `NombreRol`) VALUES (3, 'Consulta');

COMMIT;


-- -----------------------------------------------------
-- Data for table `CO_Expertcob_Inventario`.`Usuarios`
-- -----------------------------------------------------
START TRANSACTION;
USE `CO_Expertcob_Inventario`;
INSERT INTO `CO_Expertcob_Inventario`.`Usuarios` (`IdUsuario`, `Nombres`, `Apellidos`, `Clave`, `IdSucursal`, `IdRol`) VALUES (830121569, 'EXPERTCOB', 'LTDA', '471348c5ec682f1aff2058678d5fdaa4', 1, 1);

COMMIT;


GRANT ALL PRIVILEGES ON CO_Expertcob_Inventario .* TO 'inventario_admin'@'localhost' IDENTIFIED BY 'inventario_expertcob_ltda' WITH GRANT OPTION;