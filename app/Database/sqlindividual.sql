-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Servidor:                     MySQL 8.4.3 - Community Server (GPL)
-- Sistema operativo:             Windows (Win64)
-- HeidiSQL versión:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET NAMES utf8 */;
 /*!50503 SET NAMES utf8mb4 */;
 /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
 /*!40103 SET TIME_ZONE='+00:00' */;
 /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
 /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
 /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- --------------------------------------------------------
-- Base de datos
-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `sistema_menus`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_0900_ai_ci;
USE `sistema_menus`;

-- --------------------------------------------------------
-- TABLAS BASE (sin dependencias)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `departamentos` (
  `iddepartamento` INT NOT NULL AUTO_INCREMENT,
  `departamento` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`iddepartamento`),
  UNIQUE KEY `departamento` (`departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `categorias` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `personas` (
  `idpersona` INT NOT NULL AUTO_INCREMENT,
  `apellidos` VARCHAR(100) NOT NULL,
  `nombres` VARCHAR(100) NOT NULL,
  `tipodoc` VARCHAR(20) NOT NULL,
  `numerodoc` VARCHAR(20) NOT NULL,
  `telefono` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idpersona`),
  UNIQUE KEY `numerodoc` (`numerodoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `usuarios_login` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `fecha_registro` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
-- TABLAS INTERMEDIAS (dependen de las anteriores)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `provincias` (
  `idprovincia` INT NOT NULL AUTO_INCREMENT,
  `provincia` VARCHAR(100) NOT NULL,
  `iddepartamento` INT NOT NULL,
  PRIMARY KEY (`idprovincia`),
  UNIQUE KEY `provincia` (`provincia`),
  KEY `iddepartamento` (`iddepartamento`),
  CONSTRAINT `fk_provincias_departamentos`
    FOREIGN KEY (`iddepartamento`) REFERENCES `departamentos` (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `distritos` (
  `iddistrito` INT NOT NULL AUTO_INCREMENT,
  `distrito` VARCHAR(100) NOT NULL,
  `idprovincia` INT NOT NULL,
  PRIMARY KEY (`iddistrito`),
  KEY `idprovincia` (`idprovincia`),
  CONSTRAINT `fk_distritos_provincias`
    FOREIGN KEY (`idprovincia`) REFERENCES `provincias` (`idprovincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nombreusuario` VARCHAR(50) NOT NULL,
  `claveacceso` VARCHAR(255) NOT NULL,
  `nivelacceso` ENUM('admin','representante','cliente') DEFAULT 'cliente',
  `idpersona` INT NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `nombreusuario` (`nombreusuario`),
  KEY `idpersona` (`idpersona`),
  CONSTRAINT `fk_usuarios_personas`
    FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- TABLAS PRINCIPALES (negocios, locales, etc.)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `negocios` (
  `idnegocio` INT NOT NULL AUTO_INCREMENT,
  `idcategoria` INT NOT NULL,
  `idrepresentante` INT NOT NULL,
  `nombre` VARCHAR(150) NOT NULL,
  `nombrecomercial` VARCHAR(150) DEFAULT NULL,
  `slogan` VARCHAR(255) DEFAULT NULL,
  `ruc` VARCHAR(11) DEFAULT NULL,
  `logo` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`idnegocio`),
  UNIQUE KEY `ruc` (`ruc`),
  KEY `idcategoria` (`idcategoria`),
  KEY `idrepresentante` (`idrepresentante`),
  CONSTRAINT `fk_negocios_categoria`
    FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`),
  CONSTRAINT `fk_negocios_persona`
    FOREIGN KEY (`idrepresentante`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `locales` (
  `idlocales` INT NOT NULL AUTO_INCREMENT,
  `idnegocio` INT NOT NULL,
  `iddistrito` INT NOT NULL,
  `direccion` VARCHAR(255) DEFAULT NULL,
  `telefono` VARCHAR(20) DEFAULT NULL,
  `latitud` DOUBLE DEFAULT NULL,
  `longitud` DOUBLE DEFAULT NULL,
  PRIMARY KEY (`idlocales`),
  KEY `idnegocio` (`idnegocio`),
  KEY `iddistrito` (`iddistrito`),
  CONSTRAINT `fk_locales_negocios`
    FOREIGN KEY (`idnegocio`) REFERENCES `negocios` (`idnegocio`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_locales_distritos`
    FOREIGN KEY (`iddistrito`) REFERENCES `distritos` (`iddistrito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `horarios` (
  `idhorario` INT NOT NULL AUTO_INCREMENT,
  `idlocales` INT NOT NULL,
  `diasemana` ENUM('lunes','martes','miercoles','jueves','viernes','sabado','domingo') DEFAULT NULL,
  `inicio` TIME DEFAULT NULL,
  `fin` TIME DEFAULT NULL,
  PRIMARY KEY (`idhorario`),
  KEY `idlocales` (`idlocales`),
  CONSTRAINT `fk_horarios_locales`
    FOREIGN KEY (`idlocales`) REFERENCES `locales` (`idlocales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `secciones` (
  `idseccion` INT NOT NULL AUTO_INCREMENT,
  `seccion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idseccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `cartas` (
  `idcarta` INT NOT NULL AUTO_INCREMENT,
  `idlocales` INT NOT NULL,
  `idseccion` INT NOT NULL,
  `nombreplato` VARCHAR(150) NOT NULL,
  `precio` DECIMAL(10,2) DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`idcarta`),
  KEY `idlocales` (`idlocales`),
  KEY `idseccion` (`idseccion`),
  CONSTRAINT `fk_cartas_locales`
    FOREIGN KEY (`idlocales`) REFERENCES `locales` (`idlocales`),
  CONSTRAINT `fk_cartas_seccion`
    FOREIGN KEY (`idseccion`) REFERENCES `secciones` (`idseccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `contratos` (
  `idcontrato` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `idnegocio` INT NOT NULL,
  `fechainicio` DATE DEFAULT NULL,
  `fechafin` DATE DEFAULT NULL,
  `inversion` DECIMAL(12,2) DEFAULT NULL,
  PRIMARY KEY (`idcontrato`),
  KEY `idusuario` (`idusuario`),
  KEY `idnegocio` (`idnegocio`),
  CONSTRAINT `fk_contratos_usuario`
    FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `fk_contratos_negocio`
    FOREIGN KEY (`idnegocio`) REFERENCES `negocios` (`idnegocio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `comentarios` (
  `idcomentario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idlocales` INT NOT NULL,
  `tokenusuario` INT UNSIGNED NOT NULL,
  `comentario` TEXT NOT NULL,
  `valoracion` TINYINT NOT NULL,
  `fechahora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcomentario`),
  KEY `tokenusuario` (`tokenusuario`),
  KEY `idlocales` (`idlocales`),
  CONSTRAINT `fk_comentarios_usuario`
    FOREIGN KEY (`tokenusuario`) REFERENCES `usuarios_login` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_comentarios_local`
    FOREIGN KEY (`idlocales`) REFERENCES `locales` (`idlocales`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `reservas` (
  `idreserva` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idhorario` INT NOT NULL,
  `idlocales` INT NOT NULL,
  `fechahora` DATETIME NOT NULL,
  `cantidadpersonas` INT DEFAULT NULL,
  `confirmacion` TINYINT(1) DEFAULT '0',
  `idusuariovalida` INT UNSIGNED DEFAULT NULL,
  `idpersonasolicitud` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idreserva`),
  KEY `idhorario` (`idhorario`),
  KEY `idlocales` (`idlocales`),
  KEY `idusuariovalida` (`idusuariovalida`),
  KEY `idpersonasolicitud` (`idpersonasolicitud`),
  CONSTRAINT `fk_reservas_horario`
    FOREIGN KEY (`idhorario`) REFERENCES `horarios` (`idhorario`) ON DELETE CASCADE,
  CONSTRAINT `fk_reservas_local`
    FOREIGN KEY (`idlocales`) REFERENCES `locales` (`idlocales`) ON DELETE CASCADE,
  CONSTRAINT `fk_reservas_validador`
    FOREIGN KEY (`idusuariovalida`) REFERENCES `usuarios_login` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_reservas_solicitante`
    FOREIGN KEY (`idpersonasolicitud`) REFERENCES `usuarios_login` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Restaurar configuraciones previas
-- --------------------------------------------------------
/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
 /*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
 /*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
 /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
 /*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
