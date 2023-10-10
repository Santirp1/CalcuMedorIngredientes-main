-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-10-2023 a las 09:29:41
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

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
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `unidadDeMedida` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `precio` decimal(20,0) NOT NULL,
  `icono` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `ultimaModificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `nombre`, `unidadDeMedida`, `precio`, `icono`, `id_usuario`, `ultimaModificacion`) VALUES
(1, 'Leche', 'Litros', '150', 'leche.png', 0, NULL),
(2, 'Infusion', 'Unidad', '80', 'cup.png', 0, NULL),
(3, 'Pan', 'Kg', '200', 'pan.png', 0, NULL),
(4, 'Dulce', 'Pote de 1kg', '600', 'ddl.png', 0, NULL),
(11, 'Coca-Cola', 'Botella grande', '290', 'leche.png', 0, NULL),
(21, 'Alfajores', 'Paquete de 6', '600', 'alfajor.png', 0, NULL),
(39, 'Medialunas', 'Unidad de 6', '300', 'factura.png', 28, '2009-10-23 09:10:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

DROP TABLE IF EXISTS `recetas`;
CREATE TABLE IF NOT EXISTS `recetas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb3_spanish_ci,
  `ingrediente` varchar(255) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `unidadDeMedida` varchar(50) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `icono` varchar(255) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id`, `nombre`, `descripcion`, `ingrediente`, `cantidad`, `unidadDeMedida`, `precio`, `icono`) VALUES
(5, 'prueba5', '', 'Infusion', '1.00', 'Unidad', '80.00', 'cup.png'),
(4, 'prueba4', '', 'Coca-Cola', '1.00', 'Botella grande', '290.00', 'leche.png'),
(3, 'prueba3', '', 'Alfajores', '1.00', 'Paquete de 6', '600.00', 'alfajor.png'),
(2, 'prueba2', '', 'Dulce', '1.00', 'Pote de 1kg', '600.00', 'ddl.png'),
(1, 'Santiago', '', 'Infusion', '1.00', 'Unidad', '80.00', 'cup.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta_ingredientes`
--

DROP TABLE IF EXISTS `receta_ingredientes`;
CREATE TABLE IF NOT EXISTS `receta_ingredientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receta_id` int NOT NULL,
  `ingrediente_id` int NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `unidadDeMedida` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `receta_id` (`receta_id`),
  KEY `ingrediente_id` (`ingrediente_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `receta_ingredientes`
--

INSERT INTO `receta_ingredientes` (`id`, `receta_id`, `ingrediente_id`, `cantidad`, `unidadDeMedida`) VALUES
(1, 1, 1, '1.00', 'Litros'),
(2, 2, 2, '1.00', 'Unidad'),
(3, 3, 3, '1.00', 'Unidad'),
(4, 4, 4, '1.00', 'Kg'),
(5, 5, 5, '1.00', 'Kg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `clave` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `apellido` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

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
