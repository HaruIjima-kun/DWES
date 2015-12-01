-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2015 a las 23:31:50
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestor_multimedia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores`
--

CREATE TABLE `directores` (
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nacionalidad` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `directores`
--

INSERT INTO `directores` (`nombre`, `nacionalidad`) VALUES
('Masakazu Obara', 'Japonés'),
('Seiji Kishi', 'Japonés'),
('Shinji Aramaki', 'Japonés'),
('Yooichi Ueda', 'Japonés');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disco_duro`
--

CREATE TABLE `disco_duro` (
  `id` smallint(2) NOT NULL,
  `capacidad` varchar(10) CHARACTER SET latin1 NOT NULL,
  `fabricante` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `disco_duro`
--

INSERT INTO `disco_duro` (`id`, `capacidad`, `fabricante`) VALUES
(1, '1Tb', 'Western Digital'),
(2, '2Tb', 'Segate'),
(3, '2Tb Caviar', 'Western Digital'),
(4, '4Tb Caviar', 'Western Digital');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `nombre` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`nombre`) VALUES
('Acción'),
('Ciencia ficción'),
('Comedia'),
('Drama'),
('Fantasía'),
('Pepe'),
('Romance'),
('Tragedia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `id` int(4) NOT NULL,
  `titulo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `titulo_original` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `anio` year(4) DEFAULT NULL,
  `numero_capitulos` smallint(4) DEFAULT NULL,
  `numero_ovas` smallint(2) DEFAULT NULL,
  `genero` varchar(25) CHARACTER SET latin1 NOT NULL,
  `duracion_capitulo` time DEFAULT NULL,
  `duracion_total` time DEFAULT NULL,
  `director` varchar(50) CHARACTER SET latin1 NOT NULL,
  `f_estreno` date DEFAULT NULL,
  `temporadas` smallint(2) DEFAULT NULL,
  `tipo` varchar(11) CHARACTER SET latin1 NOT NULL,
  `img_portada` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `hdd` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `multimedia`
--

INSERT INTO `multimedia` (`id`, `titulo`, `titulo_original`, `anio`, `numero_capitulos`, `numero_ovas`, `genero`, `duracion_capitulo`, `duracion_total`, `director`, `f_estreno`, `temporadas`, `tipo`, `img_portada`, `hdd`) VALUES
(1, 'Angel Beats!', NULL, 2010, 13, 2, 'Drama', '00:24:29', '23:06:00', 'Seiji Kishi', '2010-04-02', 1, 'Anime', '../imgPortada/angelbeats.jpg', 1),
(2, 'Asobi ni Iku yo!', NULL, 2010, 12, 1, 'Ciencia ficción', '00:23:47', NULL, 'Yooichi Ueda', '2010-07-10', 1, 'Anime', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_multimedia`
--

CREATE TABLE `tipo_multimedia` (
  `nombre` varchar(11) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_multimedia`
--

INSERT INTO `tipo_multimedia` (`nombre`) VALUES
('Anime'),
('Película'),
('Serie');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `directores`
--
ALTER TABLE `directores`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `disco_duro`
--
ALTER TABLE `disco_duro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genero` (`genero`,`director`,`tipo`,`hdd`),
  ADD KEY `fk_directores` (`director`),
  ADD KEY `fk_tipoMultimedia` (`tipo`),
  ADD KEY `fk_disco_duro` (`hdd`);

--
-- Indices de la tabla `tipo_multimedia`
--
ALTER TABLE `tipo_multimedia`
  ADD PRIMARY KEY (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `fk_directores` FOREIGN KEY (`director`) REFERENCES `directores` (`nombre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_disco_duro` FOREIGN KEY (`hdd`) REFERENCES `disco_duro` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_generos` FOREIGN KEY (`genero`) REFERENCES `generos` (`nombre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipoMultimedia` FOREIGN KEY (`tipo`) REFERENCES `tipo_multimedia` (`nombre`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
