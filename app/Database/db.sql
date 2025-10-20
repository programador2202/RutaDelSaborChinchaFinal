-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para sistema_menus
CREATE DATABASE IF NOT EXISTS `sistema_menus` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistema_menus`;

-- Volcando estructura para tabla sistema_menus.cartas
CREATE TABLE IF NOT EXISTS `cartas` (
  `idcarta` int NOT NULL AUTO_INCREMENT,
  `idlocales` int NOT NULL,
  `idseccion` int NOT NULL,
  `nombreplato` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idcarta`),
  KEY `idlocales` (`idlocales`),
  KEY `fk_cartas_seccion` (`idseccion`),
  CONSTRAINT `cartas_ibfk_1` FOREIGN KEY (`idlocales`) REFERENCES `locales` (`idlocales`),
  CONSTRAINT `fk_cartas_seccion` FOREIGN KEY (`idseccion`) REFERENCES `secciones` (`idseccion`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `idcategoria` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `idcomentario` int NOT NULL AUTO_INCREMENT,
  `idlocales` int NOT NULL,
  `tokenusuario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fechahora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comentario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `valoracion` int DEFAULT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `idlocales` (`idlocales`),
  CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idlocales`) REFERENCES `locales` (`idlocales`),
  CONSTRAINT `comentarios_chk_1` CHECK (((`valoracion` >= 1) and (`valoracion` <= 5)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sistema_menus.comentarios: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sistema_menus.contratos
CREATE TABLE IF NOT EXISTS `contratos` (
  `idcontrato` int NOT NULL AUTO_INCREMENT,
  `idusuario` int NOT NULL,
  `idnegocio` int NOT NULL,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `inversion` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`idcontrato`),
  KEY `idusuario` (`idusuario`),
  KEY `idnegocio` (`idnegocio`),
  CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `contratos_ibfk_2` FOREIGN KEY (`idnegocio`) REFERENCES `negocios` (`idnegocio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sistema_menus.contratos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sistema_menus.departamentos
CREATE TABLE IF NOT EXISTS `departamentos` (
  `iddepartamento` int NOT NULL AUTO_INCREMENT,
  `departamento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`iddepartamento`),
  UNIQUE KEY `departamento` (`departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.distritos
CREATE TABLE IF NOT EXISTS `distritos` (
  `iddistrito` int NOT NULL AUTO_INCREMENT,
  `distrito` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `idprovincia` int NOT NULL,
  PRIMARY KEY (`iddistrito`),
  KEY `idprovincia` (`idprovincia`),
  CONSTRAINT `distritos_ibfk_1` FOREIGN KEY (`idprovincia`) REFERENCES `provincias` (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=1868 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.horarios
CREATE TABLE IF NOT EXISTS `horarios` (
  `idhorario` int NOT NULL AUTO_INCREMENT,
  `idlocales` int NOT NULL,
  `diasemana` enum('lunes','martes','miercoles','jueves','viernes','sabado','domingo') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `inicio` time DEFAULT NULL,
  `fin` time DEFAULT NULL,
  PRIMARY KEY (`idhorario`),
  KEY `idlocales` (`idlocales`),
  CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`idlocales`) REFERENCES `locales` (`idlocales`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.locales
CREATE TABLE IF NOT EXISTS `locales` (
  `idlocales` int NOT NULL AUTO_INCREMENT,
  `idnegocio` int NOT NULL,
  `iddistrito` int NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  PRIMARY KEY (`idlocales`),
  KEY `idnegocio` (`idnegocio`),
  KEY `iddistrito` (`iddistrito`),
  CONSTRAINT `locales_ibfk_1` FOREIGN KEY (`idnegocio`) REFERENCES `negocios` (`idnegocio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `locales_ibfk_2` FOREIGN KEY (`iddistrito`) REFERENCES `distritos` (`iddistrito`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.negocios
CREATE TABLE IF NOT EXISTS `negocios` (
  `idnegocio` int NOT NULL AUTO_INCREMENT,
  `idcategoria` int NOT NULL,
  `idrepresentante` int NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombrecomercial` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `slogan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ruc` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idnegocio`),
  UNIQUE KEY `ruc` (`ruc`),
  KEY `idcategoria` (`idcategoria`),
  KEY `idrepresentante` (`idrepresentante`),
  CONSTRAINT `negocios_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`),
  CONSTRAINT `negocios_ibfk_2` FOREIGN KEY (`idrepresentante`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `idpersona` int NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombres` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipodoc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `numerodoc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idpersona`),
  UNIQUE KEY `numerodoc` (`numerodoc`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.provincias
CREATE TABLE IF NOT EXISTS `provincias` (
  `idprovincia` int NOT NULL AUTO_INCREMENT,
  `provincia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `iddepartamento` int NOT NULL,
  PRIMARY KEY (`idprovincia`),  UNIQUE KEY `provincia` (`provincia`),
  KEY `iddepartamento` (`iddepartamento`),
  CONSTRAINT `provincias_ibfk_1` FOREIGN KEY (`iddepartamento`) REFERENCES `departamentos` (`iddepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.reservas
CREATE TABLE IF NOT EXISTS `reservas` (
  `idreserva` int NOT NULL AUTO_INCREMENT,
  `idhorario` int NOT NULL,
  `fechahora` datetime NOT NULL,
  `cantidadpersonas` int DEFAULT NULL,
  `confirmacion` tinyint(1) DEFAULT '0',
  `idusuariovalida` int DEFAULT NULL,
  `idpersonasolicitud` int NOT NULL,
  PRIMARY KEY (`idreserva`),
  KEY `idhorario` (`idhorario`),
  KEY `idusuariovalida` (`idusuariovalida`),
  KEY `idpersonasolicitud` (`idpersonasolicitud`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idhorario`) REFERENCES `horarios` (`idhorario`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`idusuariovalida`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`idpersonasolicitud`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sistema_menus.reservas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sistema_menus.secciones
CREATE TABLE IF NOT EXISTS `secciones` (
  `idseccion` int NOT NULL AUTO_INCREMENT,
  `seccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idseccion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla sistema_menus.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nombreusuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `claveacceso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nivelacceso` enum('admin','representante','cliente') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'cliente',
  `idpersona` int NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `nombreusuario` (`nombreusuario`),
  KEY `idpersona` (`idpersona`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


use sistema_menus;

