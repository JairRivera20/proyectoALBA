-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2023 a las 22:16:42
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id_categoria` int(40) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Id_categoria`, `Nombre`) VALUES
(1, 'Standard American Beer'),
(2, 'International Lager'),
(3, 'Czech Lager'),
(4, 'Pale Malty European Lager'),
(5, 'Pale Bitter European Beer'),
(6, 'Amber Malty European Lager'),
(7, 'Amber Bitter European Beer'),
(8, 'Dark European Lager'),
(9, 'Strong European Beer'),
(10, 'German Wheat Beer'),
(11, 'British Bitter'),
(12, 'Pale Commonwealth Beer'),
(13, 'Brown British Beer'),
(14, 'Scottish Ale'),
(15, 'Irish Beer'),
(16, 'Dark Brittish Beer'),
(17, 'Strong British Ale'),
(18, 'Pale American Ale'),
(19, 'Amber and Brown American Beer'),
(20, 'American Porter and Stout'),
(21, 'IPA'),
(22, 'Strong American Ale'),
(23, 'European Sour Ale'),
(24, 'Belgian Ale'),
(25, 'Strong Belgian Ale'),
(26, 'Trappist Ale'),
(27, 'Historical Beer'),
(28, 'American Wild Ale'),
(29, 'Fruit Beer'),
(30, 'Spiced Beer'),
(31, 'Alternative Fermentables Beer'),
(32, 'Smoked Beer'),
(33, 'Wood Beer'),
(34, 'Specialty Beer'),
(35, 'Local Styles'),
(36, 'Standard Cider and Perry'),
(37, 'Specialty Cider and Perry'),
(38, 'Traditional Mead'),
(39, 'Fruit Mead'),
(40, 'Spiced Mead'),
(41, 'Specialty Mead');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cerveza`
--

CREATE TABLE `cerveza` (
  `Id_cerveza` int(40) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `fk_usuario` int(40) NOT NULL,
  `fk_estilo` int(40) NOT NULL,
  `Pendiente` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `Id_estilo` int(40) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `fk_categoria` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`Id_estilo`, `Nombre`, `fk_categoria`) VALUES
(1, 'Cream Ale', 1),
(2, 'Lager Ligera', 1),
(3, 'American Lager', 1),
(4, 'American Wheat Beer', 1),
(5, 'Internacional Pale Lager', 2),
(6, 'Internacional Amber Lager', 2),
(7, 'International Dark Lager', 2),
(8, 'Czech Pale Lager', 3),
(9, 'Czech Premium Pale Lager', 3),
(10, 'Czech Amber Lager', 3),
(11, 'Czech Dark Lager', 3),
(12, 'Munich Helles', 4),
(13, 'Festbier', 4),
(14, 'Helles Bock', 4),
(15, 'German Leichtbier', 5),
(16, 'Kölsch', 5),
(17, 'German Helles Exportbier', 5),
(18, 'German Pils', 5),
(19, 'Märzen', 6),
(20, 'Rauchbier', 6),
(21, 'Dunkles Bock', 6),
(22, 'Vienna Lager', 7),
(23, 'Albier', 7),
(24, 'Historical: Kellerbier', 27),
(25, 'Kellerbier: Pale Kellerbier', 7),
(26, 'Kellerbier: Amber Kellerbier', 7),
(27, 'Munich Dunkel', 8),
(28, 'Schwarzbier', 8),
(29, 'Doppelbock', 9),
(30, 'Eisbock', 9),
(31, 'Baltic Porter', 9),
(32, 'Weissbier', 10),
(33, 'Dunkles Weissbier', 10),
(34, 'Weizenbock', 10),
(35, 'Ordinary Bitter', 11),
(36, 'Best Bitter', 11),
(37, 'Strong Bitter', 11),
(38, 'British Golden Ale', 12),
(39, 'Australian Sparkling Ale', 12),
(40, 'English IPA', 12),
(41, 'Dark Mild', 13),
(42, 'British Brown Ale', 13),
(43, 'English Porter', 13),
(44, 'Scottish Light', 14),
(45, 'Scottish Heavy', 14),
(46, 'Scottish Export', 14),
(47, 'Irish Red Ale', 15),
(48, 'Irish Stout', 15),
(49, 'Irish Extra Stout', 15),
(50, 'Sweet Stout', 16),
(51, 'Oatmeal Stout', 16),
(52, 'Tropical Stout', 16),
(53, 'Foreign Extra Stout', 16),
(54, 'Strong British Ale', 17),
(55, 'British Strong Ale: Burton Ale', 17),
(56, 'Old Ale', 17),
(57, 'Wee Heavy', 17),
(58, 'English Barleywine', 17),
(59, 'Blonde Ale', 18),
(60, 'Pale American Ale', 18),
(61, 'American Amber Ale', 19),
(62, 'California Common', 19),
(63, 'American Brown Ale', 19),
(64, 'American Porter', 20),
(65, 'American Stout', 20),
(66, 'Imperial Stout', 20),
(67, 'American IPA', 21),
(68, 'Specialty IPA', 21),
(69, 'Specialty IPA: Belgian IPA', 21),
(70, 'Specialty IPA: White IPA', 21),
(71, 'Specialty IPA: Rye IPA', 21),
(72, 'Specialty IPA: Brown IPA', 21),
(73, 'Specialty IPA: Black IPA', 21),
(74, 'Specialty IPA: New England IPA', 21),
(75, 'Specialty IPA: Red IPA', 21),
(76, 'Double IPA', 22),
(77, 'American Strong Ale', 22),
(78, 'American Barleywine', 22),
(79, 'Wheatwine', 22),
(80, 'Berliner Weisse', 23),
(81, 'Flanders Red Ale', 23),
(82, 'Oud Bruin', 23),
(83, 'Lambic', 23),
(84, 'Gueuze', 23),
(85, 'Fruir Lambic', 23),
(86, 'Witbier', 24),
(87, 'Belgian Pale Ale', 24),
(88, 'Bière de Garde', 24),
(89, 'Belgian Blond Ale', 25),
(90, 'Saison', 25),
(91, 'Belgian Golden Strong Ale', 25),
(92, 'Belgian Dubbel', 26),
(93, 'Belgian Tripel', 26),
(94, 'Belgian Dark Strong Ale', 26),
(95, 'Historical Beer: Gose', 27),
(96, 'Historical Beer: Kentucky Common', 27),
(97, 'Historical Beer: Lichtenhainer', 27),
(98, 'Historical Beer: London Brown Ale', 27),
(99, 'Historical Beer: Piwo Grodziskie', 27),
(100, 'Historical Beer: Pre-Prohibition Lager', 27),
(101, 'Historical Beer: Pre-Prohibition Porter', 27),
(102, 'Historical Beer: Roggenbier', 27),
(103, 'Historical Beer: Sahti', 27),
(104, 'Brett Beer', 28),
(105, 'Mixed-Fermentation Sour Beer', 28),
(106, 'Wild Specialty Beer', 28),
(107, 'Fruit Beer', 29),
(108, 'Fruit and Spice Beer', 29),
(109, 'Specialty Fruit Beer', 29),
(110, 'Spice, Herbs, or Vegetables Beer', 30),
(111, 'Autumn Seasonal Beer', 30),
(112, 'Winter Seasonal Beer', 30),
(113, 'Alternative Grain Beer', 31),
(114, 'Alternative Sugar Beer', 31),
(115, 'Trappist Single', 26),
(116, 'Classic Style Smoked Beer', 32),
(117, 'Specialty Smoked Beer', 32),
(118, 'Wood-Aged Beer', 33),
(119, 'Specialty Wood-Aged Beer', 33),
(120, 'Clone Beer', 34),
(121, 'Mixed-Style Beer', 34),
(122, 'Experimental Beer', 34),
(123, 'Argentine Pampas Golden Ale', 35),
(124, 'Argentine IPA', 35),
(125, 'Italian Grape Ale', 35),
(126, 'Catharina Sour', 35),
(127, 'New Zealand Pilsner', 35),
(128, 'New World Cider', 36),
(129, 'English Cider', 36),
(130, 'French Cider', 36),
(131, 'New World Perry', 36),
(132, 'Traditional Perry', 36),
(133, 'New England Cider', 37),
(134, 'Cider with Other Fruit', 37),
(135, 'Applewine', 37),
(136, 'Ice Cider', 37),
(137, 'Cider with Herbs/Spices', 37),
(138, 'Specialty Cider/Perry', 37),
(139, 'Dry Mead', 38),
(140, 'Semi-Sweet Mead', 38),
(141, 'Sweet Mead', 38),
(142, 'Cyser', 39),
(143, 'Pyment', 39),
(144, 'Berry Mead', 39),
(145, 'Stone Fruit Mead', 39),
(146, 'Melomel', 39),
(147, 'Fruit and Spice Mead', 40),
(148, 'Spice, Herb or Vegetable Mead', 40),
(149, 'Braggot', 41),
(150, 'Historical Mead', 41),
(151, 'Experimental Mead', 41),
(152, 'Gose', 23),
(153, 'Belgian Single ', 26),
(154, 'Historical Beer: Kellerbier ', 27),
(155, 'Specialty IPA: Brut IPA ', 21),
(156, 'Hazy IPA', 21),
(157, 'Straight Sour Beer ', 28),
(158, 'Grape Ale ', 29),
(159, 'Specialty Spice Beer ', 30),
(163, 'Commercial Specialty Beer ', 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `Id_evento` int(40) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Fecha` date NOT NULL,
  `Lugar` varchar(50) NOT NULL,
  `Mesas` int(40) NOT NULL,
  `Primer_puesto` int(40) NOT NULL,
  `Segundo_puesto` int(40) NOT NULL,
  `Tercer_puesto` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_usuarios`
--

CREATE TABLE `evento_usuarios` (
  `Id` int(40) NOT NULL,
  `fk_evento` int(40) NOT NULL,
  `fk_usuarios` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general`
--

CREATE TABLE `general` (
  `Id` int(40) NOT NULL,
  `fk_cerveza` int(40) NOT NULL,
  `fk_usuario` int(40) NOT NULL,
  `Ejemplo` int(40) DEFAULT NULL,
  `Sin_fallas` int(40) DEFAULT NULL,
  `Maravilloso` int(40) DEFAULT NULL,
  `Comentario` varchar(500) DEFAULT NULL,
  `Nota` int(40) DEFAULT NULL,
  `Fallas` varchar(500) DEFAULT NULL,
  `Aroma` int(40) DEFAULT NULL,
  `Apariencia` int(40) DEFAULT NULL,
  `Sabor` int(40) DEFAULT NULL,
  `Sensacion` int(40) DEFAULT NULL,
  `Juzgado` int(40) NOT NULL,
  `Mesa` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango_competidor`
--

CREATE TABLE `rango_competidor` (
  `Id_rango_competidor` int(40) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rango_competidor`
--

INSERT INTO `rango_competidor` (`Id_rango_competidor`, `Nombre`) VALUES
(1, 'Cervecero profesional'),
(2, 'Sommerlier cerveza'),
(3, 'GABF/WBC'),
(4, 'Cicerone certificado'),
(5, 'Cicerone avanzado'),
(6, 'Cicerone maestro'),
(7, 'Cervecero casero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango_juez`
--

CREATE TABLE `rango_juez` (
  `Id_rango_juez` int(40) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rango_juez`
--

INSERT INTO `rango_juez` (`Id_rango_juez`, `Nombre`) VALUES
(1, 'Aprendiz'),
(2, 'Reconocido'),
(3, 'Certificado'),
(4, 'Nacional'),
(5, 'Maestro'),
(6, 'Gran Maestro'),
(7, 'Maestro honorario'),
(8, 'Gran Maestro honorario'),
(9, 'Juez de hidromiel'),
(10, 'Juez provisional'),
(11, 'Rango pendiente'),
(12, 'juez cibernético');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `Id_region` int(40) NOT NULL,
  `Nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`Id_region`, `Nombre`) VALUES
(1, 'Amazonas'),
(2, 'Antioquia'),
(3, 'Arauca'),
(4, 'Atlántico'),
(5, 'Bolívar'),
(6, 'Boyacá'),
(7, 'Caldas'),
(8, 'Caquetá'),
(9, 'Casanare'),
(10, 'Cauca'),
(11, 'Cesar'),
(12, 'Chocó'),
(13, 'Córdoba'),
(14, 'Cundinamarca'),
(15, 'Guainía'),
(16, 'Guaviare'),
(17, 'Huila'),
(18, 'La Guajira'),
(19, 'Magdalena'),
(20, 'Meta'),
(21, 'Nariño'),
(22, 'Norte de Santander'),
(23, 'Putumayo'),
(24, 'Quindío'),
(25, 'Risaralda'),
(26, 'San Andrés y Providencia'),
(27, 'Santander'),
(28, 'Sucre'),
(29, 'Tolima'),
(30, 'Valle del Cauca'),
(31, 'Vaupés'),
(32, 'Vichada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_usuario` int(40) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(35) NOT NULL,
  `Telefono` bigint(40) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Contrasena` varchar(128) NOT NULL,
  `Foto` longblob NOT NULL,
  `Hash512` varchar(128) NOT NULL,
  `Rol` int(40) NOT NULL,
  `fk_rango_competidor` int(40) DEFAULT NULL,
  `fk_rango_juez` int(40) DEFAULT NULL,
  `fk_region` int(40) DEFAULT NULL,
  `Activado` int(40) NOT NULL,
  `Codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id_categoria`);

--
-- Indices de la tabla `cerveza`
--
ALTER TABLE `cerveza`
  ADD PRIMARY KEY (`Id_cerveza`),
  ADD KEY `fk_estilo` (`fk_estilo`),
  ADD KEY `fk_estilo_2` (`fk_estilo`),
  ADD KEY `fk_usuarios` (`fk_usuario`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`Id_estilo`),
  ADD KEY `fk_categoria` (`fk_categoria`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`Id_evento`);

--
-- Indices de la tabla `evento_usuarios`
--
ALTER TABLE `evento_usuarios`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_evento` (`fk_evento`),
  ADD KEY `fk_usuarios` (`fk_usuarios`);

--
-- Indices de la tabla `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_aroma` (`Aroma`),
  ADD KEY `fk_apariencia` (`Apariencia`),
  ADD KEY `fk_sabor` (`Sabor`),
  ADD KEY `fk_sensacion_boca` (`Sensacion`),
  ADD KEY `fk_cerveza` (`fk_cerveza`);

--
-- Indices de la tabla `rango_competidor`
--
ALTER TABLE `rango_competidor`
  ADD PRIMARY KEY (`Id_rango_competidor`);

--
-- Indices de la tabla `rango_juez`
--
ALTER TABLE `rango_juez`
  ADD PRIMARY KEY (`Id_rango_juez`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`Id_region`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD KEY `fk_rango_competidor` (`fk_rango_competidor`),
  ADD KEY `fk_rango_juez` (`fk_rango_juez`),
  ADD KEY `fk_region` (`fk_region`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id_categoria` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `cerveza`
--
ALTER TABLE `cerveza`
  MODIFY `Id_cerveza` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `Id_estilo` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3014;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `Id_evento` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;

--
-- AUTO_INCREMENT de la tabla `evento_usuarios`
--
ALTER TABLE `evento_usuarios`
  MODIFY `Id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `general`
--
ALTER TABLE `general`
  MODIFY `Id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `rango_competidor`
--
ALTER TABLE `rango_competidor`
  MODIFY `Id_rango_competidor` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rango_juez`
--
ALTER TABLE `rango_juez`
  MODIFY `Id_rango_juez` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `Id_region` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_usuario` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cerveza`
--
ALTER TABLE `cerveza`
  ADD CONSTRAINT `cerveza_ibfk_4` FOREIGN KEY (`fk_estilo`) REFERENCES `estilos` (`Id_estilo`),
  ADD CONSTRAINT `cerveza_ibfk_7` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`Id_usuario`);

--
-- Filtros para la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD CONSTRAINT `estilos_ibfk_1` FOREIGN KEY (`fk_categoria`) REFERENCES `categorias` (`Id_categoria`);

--
-- Filtros para la tabla `evento_usuarios`
--
ALTER TABLE `evento_usuarios`
  ADD CONSTRAINT `evento_usuarios_ibfk_2` FOREIGN KEY (`fk_evento`) REFERENCES `evento` (`Id_evento`),
  ADD CONSTRAINT `evento_usuarios_ibfk_3` FOREIGN KEY (`fk_usuarios`) REFERENCES `usuarios` (`Id_usuario`);

--
-- Filtros para la tabla `general`
--
ALTER TABLE `general`
  ADD CONSTRAINT `general_ibfk_6` FOREIGN KEY (`fk_cerveza`) REFERENCES `cerveza` (`Id_cerveza`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`fk_rango_competidor`) REFERENCES `rango_competidor` (`Id_rango_competidor`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`fk_rango_juez`) REFERENCES `rango_juez` (`Id_rango_juez`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`fk_region`) REFERENCES `region` (`Id_region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
