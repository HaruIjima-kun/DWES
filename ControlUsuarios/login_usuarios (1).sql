-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2016 a las 16:52:47
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `alias` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaAlta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(1) NOT NULL,
  `personal` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `avatar` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`email`, `clave`, `alias`, `fechaAlta`, `admin`, `personal`, `activo`, `avatar`) VALUES
('admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Haru Ijima', '2016-01-10 19:25:35', 1, 0, 1, '../dist/img/avatar6.jpg'),
('eva@gmail.com', '3da1befff5b5c75e2e99948ffb230642c19fac6a', 'eva', '2016-01-17 18:52:28', 1, 0, 1, '../dist/img/avatar7.jpg'),
('gloria@gmail.com', 'a7a2f714daa2444d8bbee207554302ff38d2e478', 'gloria', '2016-01-17 17:53:25', 0, 0, 1, ''),
('haru@gmail.com', 'f7976dc425bcce048120127956a7ec59259f4452', 'haru', '2016-01-16 20:46:53', 0, 1, 1, '../dist/img/avatar6.jpg'),
('pepe@pepe.com', '99800b85d3383e3a2fb45eb7d0066a4879a9dad0', 'pepe', '2016-01-18 00:41:56', 1, 0, 1, '../dist/img/avatar2.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `alias` (`alias`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
