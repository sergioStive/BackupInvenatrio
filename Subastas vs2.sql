CREATE DATABASE  IF NOT EXISTS `subastas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `subastas`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: subastas
-- ------------------------------------------------------
-- Server version	5.5.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `CodCliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Un código cualquiera que puede ser la cédula',
  `NombreCliente` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `ApellidoCliente` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `tefefono` varchar(16) COLLATE latin1_spanish_ci DEFAULT NULL,
  `email` varchar(25) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'tucorreo@misena.edu.co',
  `clave` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `idRoles` int(12) NOT NULL,
  PRIMARY KEY (`CodCliente`),
  UNIQUE KEY `CodCliente` (`CodCliente`),
  KEY `idRoles_idx` (`idRoles`),
  CONSTRAINT `idRoles` FOREIGN KEY (`idRoles`) REFERENCES `roles` (`idRoles`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Clientes del ejercicio de senasoft 2014';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moneda`
--

DROP TABLE IF EXISTS `moneda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moneda` (
  `codMoneda` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMoneda` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codMoneda`),
  UNIQUE KEY `codMoneda` (`codMoneda`),
  UNIQUE KEY `nombreMoneda` (`nombreMoneda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Divisa con la que se hace se comprará el producto';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moneda`
--

LOCK TABLES `moneda` WRITE;
/*!40000 ALTER TABLE `moneda` DISABLE KEYS */;
/*!40000 ALTER TABLE `moneda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `codProducto` int(11) NOT NULL AUTO_INCREMENT,
  `NombreProducto` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `ValorInicial` double(4,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`codProducto`),
  UNIQUE KEY `codProducto` (`codProducto`),
  UNIQUE KEY `NombreProducto` (`NombreProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Productos de la subasta';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `idRoles` int(12) NOT NULL AUTO_INCREMENT,
  `nombres_rol` varchar(25) NOT NULL,
  PRIMARY KEY (`idRoles`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subastas`
--

DROP TABLE IF EXISTS `subastas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subastas` (
  `idSubasta` int(11) NOT NULL AUTO_INCREMENT,
  `productoCod` int(11) NOT NULL,
  `ClienteCod` int(11) NOT NULL,
  `MonedaCod` int(11) NOT NULL,
  `ValorOfrecido` double(6,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idSubasta`),
  UNIQUE KEY `idSubasta` (`idSubasta`),
  KEY `productoCod` (`productoCod`),
  KEY `ClienteCod` (`ClienteCod`),
  KEY `MonedaCod` (`MonedaCod`),
  CONSTRAINT `tblsubastas_fk` FOREIGN KEY (`productoCod`) REFERENCES `productos` (`codProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tblsubastas_fk1` FOREIGN KEY (`ClienteCod`) REFERENCES `clientes` (`CodCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tblsubastas_fk2` FOREIGN KEY (`MonedaCod`) REFERENCES `moneda` (`codMoneda`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Subastas que el cliente realiza en moneda especifica';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subastas`
--

LOCK TABLES `subastas` WRITE;
/*!40000 ALTER TABLE `subastas` DISABLE KEYS */;
/*!40000 ALTER TABLE `subastas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-06 17:34:27
