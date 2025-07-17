-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-07-2025 a las 21:40:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarImagen` (IN `id` INT(10), IN `n` VARCHAR(75), IN `d` TINYTEXT, IN `a` VARCHAR(50))   begin
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
  `nombre` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategorias`, `nombre`) VALUES
(1, 'Social'),
(2, 'Empresarial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idcomentarios` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `descripcion` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idcomentarios`, `fecha`, `nombre`, `descripcion`) VALUES
(1, '2025-07-15', 'Oswaldo Moguel', 'Para limitar el tamaño del contenedor de la imagen y evitar que se deforme con imágenes de diferentes dimensiones, puedes usar las siguientes soluciones'),
(2, '2025-07-15', 'Juan Carlos', 'A non-empty placeholder attribute is required on each <input> as our CSS-only floating label implementation relies on the :placeholder-shown pseudo-element to detect when the input is empty. The placeholder text itself is not visible; only the <label> is ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idimagenes` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `descripcion` tinytext NOT NULL,
  `archivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idimagenes`, `nombre`, `categoria`, `descripcion`, `archivo`) VALUES
(1, 'Nueva Imagen', 'Empresarial', 'dfgbfdbdf', '20250425_203412.jpg'),
(2, 'Automotriz', 'Social', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min2.jpeg'),
(3, 'Foto', 'Social', 'Decripcion de ejemplo', 'leyendas.jpg'),
(4, 'Chevrolet', 'Social', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min6.jpeg'),
(5, 'Carro Amarillo', 'Social', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min7.jpeg'),
(6, 'Atardecer', 'Empresarial', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min8.jpeg'),
(7, 'Nueva Imagen Agregar', 'Empresarial', 'Descripcion de foto agregada', 'IMG_20200818_171026.jpg'),
(8, 'Atardecer', 'Empresarial', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.', 'min3.jpeg'),
(9, 'Cantantes', 'Empresarial', 'Texto de ejemplo para la descripción de una imagen del proyecto/producto de la materia de Aplicaciones Web del tercer cuatrimestre grupo E del segundo momento.	\r\n', '_MG_4881.jpg'),
(12, 'Vistas', 'Social', 'Descripcion de prueba para imagen en index', '8727724.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `idpaquete` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` tinytext NOT NULL,
  `categoria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`idpaquete`, `nombre`, `precio`, `descripcion`, `categoria`) VALUES
(1, 'Básico', 1700, 'Fotos digitales con diversas características', 2),
(2, 'Premium', 3500, 'Cobertura evento teligioso y social, Álbum con 100 fotos impresas tamaño postal 4x, 400 fotografías digitales, 1 fotografía impresa 11x14 Pulgadas enmarcada', 1),
(3, 'superior', 4500, 'Cobertura evento teligioso y social, Álbum con 100 fotos impresas tamaño postal 4x, 400 fotografías digitales, 1 fotografía impresa 11x14 Pulgadas enmarcada', 2),
(9, 'Básico 2', 255, 'Descripcion de ejemplo para visualizar informacion en index', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `pass`) VALUES
(1, 'Magno', 'admin@magno.com', '2ecc02934da1282b9b8113020dfbafaf59591138c63cfda692c488c01c134fa5');

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
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `idcomentarios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idimagenes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `idpaquete` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
