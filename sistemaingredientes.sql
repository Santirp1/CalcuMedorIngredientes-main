-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-10-2022 a las 17:08:44
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemaingredientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8 NOT NULL,
  `unidadDeMedida` varchar(20) CHARACTER SET utf8 NOT NULL,
  `precio` decimal(20,0) NOT NULL,
  `icono` varchar(20) CHARACTER SET utf8 NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ultimaModificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `nombre`, `unidadDeMedida`, `precio`, `icono`, `id_usuario`, `ultimaModificacion`) VALUES
(1, 'Leche', 'Litros', '150', 'leche.png', 0, NULL),
(2, 'Infusion', 'Unidad', '80', 'cup.png', 0, NULL),
(3, 'Pan', 'Kg', '200', 'pan.png', 0, NULL),
(4, 'Dulce', 'Pote de 1kg', '600', 'ddl.png', 0, NULL),
(11, 'Coca-Cola', 'Botella grande', '290', 'leche.png', 0, NULL),
(21, 'Alfajores', 'Paquete de 6', '600', 'alfajor.png', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `nombre`, `apellido`, `email`) VALUES
(26, 'bb', '$2y$10$rlv.nzssL9CZawUTrIV.DuBNbf/r3AD4SfBiqnf/82lr6riETk4wW', 'bb', 'bb', 'bb@bb.com'),
(28, 'Administrador', '$2y$10$0JndizGRtTS2SHEue241aODqY.I8MXhWE0KT9hOZnffVZdixYX4hy', 'Administrador', 'Administrador', 'Administrador@administrador.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
