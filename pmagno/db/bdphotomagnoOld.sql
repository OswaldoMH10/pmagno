-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2023 a las 22:23:33
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdphotomagno`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarImagen` (IN `id` INT(10), IN `n` VARCHAR(75), IN `d` TINYTEXT, IN `a` VARCHAR(50))  begin
insert into imagenes(idimagenes,nombre,descripcion,archivo) values
(id,n,d,a);
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategorias` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(75) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategorias`, `nombre`) VALUES
(1, 'sociales'),
(2, 'empresas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idcomentarios` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `calificacion` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idimagenes` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `archivo` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idimagenes`, `nombre`, `descripcion`, `archivo`) VALUES
(1, 'Chevrolet 2', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min1.jpeg'),
(2, 'Automotriz', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min2.jpeg'),
(3, 'Foto', 'Dedcripcion de ejemplo', 'leyendas.jpg'),
(4, 'Chevrolet', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min6.jpeg'),
(5, 'Carro Amarillo', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min7.jpeg'),
(6, 'Atardecer', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min8.jpeg'),
(7, 'Quinceañera', 'Quinceañera posando para una foto', '_MG_6476-3.jpg'),
(8, 'Atardecer', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min3.jpeg'),
(9, 'Cantantes', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.	\r\n', '_MG_4881.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `idpaquete` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `categoria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`idpaquete`, `nombre`, `precio`, `descripcion`, `categoria`) VALUES
(1, 'Básico', 1500, 'Fotos digitales<br>\r\nFotos físicas\r\n', 1),
(2, 'premium', 3500, 'Cobertura evento teligioso y social, Álbum con 100 fotos impresas tamaño postal 4x, 400 fotografías digitales, 1 fotografía impresa 11x14 Pulgadas enmarcada', 2),
(3, 'superior', 4500, 'Cobertura evento teligioso y social, Álbum con 100 fotos impresas tamaño postal 4x, 400 fotografías digitales, 1 fotografía impresa 11x14 Pulgadas enmarcada', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategorias`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idcomentarios`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idimagenes`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`idpaquete`),
  ADD KEY `fk_paquete_categoria_idx` (`categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategorias` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idcomentarios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idimagenes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `idpaquete` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `fk_paquete_categoria` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`idcategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
