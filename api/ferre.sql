-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-07-2024 a las 22:37:03
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferre`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(11, 'Iluminacion'),
(12, 'Ferreteria'),
(13, 'Camping'),
(14, 'Maquinas Eléctricas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_normal` decimal(10,2) NOT NULL,
  `precio_rebajado` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `id_categoria` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio_normal`, `precio_rebajado`, `cantidad`, `imagen`, `id_categoria`) VALUES
(10, 'Tira Led RGB', 'Cinta Tira Led 5050 Rgb 5 Mts Transf Control Remoto Exterior', 14500.00, 14500.00, 15, '20240714222139.jpg', 11),
(11, 'Taladro Bosch', 'Taladro C Percusión Bosch Gsb 450 Re 10mm 450w Veloc Variab Color Azul', 105000.00, 89000.00, 4, '20240714222414.jpg', 14),
(12, 'Soldadora Esab', 'Soldadora Inverter Esab 160i + Accesorios Color Amarillo', 580000.00, 580000.00, 2, '20240714222525.jpg', 14),
(13, 'Martillo \"El Roble\"', 'Martillo ', 12500.00, 10000.00, 20, '20240714222632.jpg', 12),
(14, 'Termo con Funda de 750ml', 'Termo con Funda de 750ml de capacidad', 14000.00, 14000.00, 9, '20240714222821.jpg', 13),
(15, 'Botella Termica', 'Botella  térmica, modelo sports', 9000.00, 9000.00, 14, '20240714222932.jpg', 13),
(16, 'Kit de Destornilladores aislados IRIMO', 'Set Destornilladores Aislados Irimo Ranurados Y Philips 6 Pz', 75000.00, 68000.00, 8, '20240714223132.jpg', 12),
(17, 'Artefacto de iluminacion exterior', 'Artefacto Bi direccional de Iluminacion exterior', 17000.00, 17000.00, 12, '20240714223244.jpg', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `rol` enum('admin','cliente') DEFAULT 'cliente',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `nombre`, `rol`) VALUES
(1, 'admin', '$2y$10$sHYq./rsSn1DQC0.RldI.ubwMYb2p6Ys83IBU0on2.5guONNlcYIi', 'Administrador', 'admin'),
(2, 'Franco', '$2y$10$kUiDONV70HEne/G8dHfIqOtFkjecyvA89yzuPMRuPCwPNANdWmnHu', NULL, 'cliente'),
(3, 'Thor', '$2y$10$gXuGBL6uFlOsM10ZHFDo7u.LleuGeK4Uw1MRrKaw12wXhHhM1J/ju', NULL, 'cliente');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
