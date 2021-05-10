-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2021 a las 17:29:35
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `platinobus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientos`
--

CREATE TABLE `asientos` (
  `id_autobus` int(10) NOT NULL,
  `id_asiento` int(2) NOT NULL,
  `id_boleto` int(10) DEFAULT NULL,
  `nombre_pasajero` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autobuses`
--

CREATE TABLE `autobuses` (
  `id_autobus` int(10) NOT NULL,
  `id_empleado` int(10) NOT NULL,
  `numero_autobus` int(10) NOT NULL,
  `placa` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `capacidad_asientos` int(2) NOT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletos`
--

CREATE TABLE `boletos` (
  `id_boleto` int(10) NOT NULL,
  `id_ruta` int(10) NOT NULL,
  `id_empleado` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `folio` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_salida` date NOT NULL,
  `num_asiento` int(2) NOT NULL,
  `fecha_expedicion` date NOT NULL,
  `precio` double NOT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) NOT NULL,
  `nombre_cli` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidop_cli` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellidom_cli` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `correo_electronico` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_cli` int(10) NOT NULL,
  `usuario_cli` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena_cli` varchar(16) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(10) NOT NULL,
  `id_terminal` int(10) NOT NULL,
  `nombre_emp` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidop_emp` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellidom_emp` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_emp` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_emp` bigint(10) NOT NULL,
  `fecha_ingreso_laboral` date NOT NULL,
  `rol` int(1) NOT NULL,
  `usuario_emp` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena_emp` varchar(16) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `id_terminal`, `nombre_emp`, `apellidop_emp`, `apellidom_emp`, `direccion_emp`, `telefono_emp`, `fecha_ingreso_laboral`, `rol`, `usuario_emp`, `contrasena_emp`) VALUES
(1, 4, 'Eunice', 'Carmona', 'Romero', 'Córdoba, Veracruz', 2712842374, '2021-04-20', 1, 'EuniceCR', '123456'),
(2, 4, 'Gerardo', 'Trejo', 'Lobato', 'Orizaba, Veracruz', 2722044596, '2021-05-01', 2, 'GerardoTL', '123456'),
(4, 4, 'Arturo', 'Gómez', 'López', 'Puebla, Puebla', 2441556369, '2021-05-08', 4, 'ArturoGL', '123456'),
(5, 3, 'Francisco Antonio', 'Xotlanihua', 'Castillo', 'Orizaba, Veracruz', 2721443090, '2021-04-20', 1, 'FcoAntonio', '123456'),
(6, 5, 'Aldo Jesús', 'Prado', 'Jiménez', 'Orizaba Centro', 2722109081, '2021-04-20', 1, 'AldoPJ', '123456'),
(8, 5, 'José Miguel', 'López', 'López', 'Nogales Calle principal', 2721554862, '2021-05-06', 4, 'JoseML', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nombre_emp` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `RFC` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `razon_social` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_emp` bigint(10) NOT NULL,
  `correo_electronico` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nombre_emp`, `RFC`, `razon_social`, `telefono_emp`, `correo_electronico`) VALUES
('Platino Bus', 'PBU210420IX3', 'Platino Bus S.A. de C.V.', 2721306862, 'platino.bus.mexico@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_ruta` int(10) NOT NULL,
  `id_terminal_origen` int(10) NOT NULL,
  `id_terminal_destino` int(10) NOT NULL,
  `id_autobus` int(10) NOT NULL,
  `horario` time(6) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terminales`
--

CREATE TABLE `terminales` (
  `id_terminal` int(10) NOT NULL,
  `id_empleado` int(10) NOT NULL,
  `nombre_ter` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_ter` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad_ter` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado_ter` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_ter` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `terminales`
--

INSERT INTO `terminales` (`id_terminal`, `id_empleado`, `nombre_ter`, `direccion_ter`, `ciudad_ter`, `estado_ter`, `telefono_ter`) VALUES
(3, 1, 'PB Orizaba', 'Sur 13 entre Av. Oriente 2 y Colón Oriente.', 'Orizaba', 'Veracruz', 2721443860),
(4, 2, 'PB Córdoba', 'Calle 15 entre Avenidas 11 y 7', 'Córdoba', 'Veracruz', 2712842374),
(5, 3, 'PB Xalapa', 'Avenida Ferrocarril Interoceánico entre Calles Coyoacán y Chapultepec', 'Xalapa', 'Veracruz', 2722109081),
(6, 4, 'PB Veracruz', 'Centro', 'Veracruz', 'Veracruz', 2224568475);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD PRIMARY KEY (`id_autobus`,`id_asiento`);

--
-- Indices de la tabla `autobuses`
--
ALTER TABLE `autobuses`
  ADD PRIMARY KEY (`id_autobus`),
  ADD KEY `FKAutobuses317583` (`id_empleado`);

--
-- Indices de la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`id_boleto`),
  ADD KEY `FKBoletos440211` (`id_cliente`),
  ADD KEY `FKBoletos977620` (`id_empleado`),
  ADD KEY `FKBoletos298925` (`id_ruta`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `FKEmpleados611016` (`id_terminal`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `FKRutas770277` (`id_terminal_origen`),
  ADD KEY `FKRutas490932` (`id_terminal_destino`),
  ADD KEY `FKRutas509318` (`id_autobus`);

--
-- Indices de la tabla `terminales`
--
ALTER TABLE `terminales`
  ADD PRIMARY KEY (`id_terminal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autobuses`
--
ALTER TABLE `autobuses`
  MODIFY `id_autobus` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `boletos`
--
ALTER TABLE `boletos`
  MODIFY `id_boleto` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id_ruta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `terminales`
--
ALTER TABLE `terminales`
  MODIFY `id_terminal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD CONSTRAINT `FKAsientos847347` FOREIGN KEY (`id_autobus`) REFERENCES `autobuses` (`id_autobus`);

--
-- Filtros para la tabla `autobuses`
--
ALTER TABLE `autobuses`
  ADD CONSTRAINT `FKAutobuses317583` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);

--
-- Filtros para la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD CONSTRAINT `FKBoletos298925` FOREIGN KEY (`id_ruta`) REFERENCES `rutas` (`id_ruta`),
  ADD CONSTRAINT `FKBoletos440211` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `FKBoletos977620` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `FKEmpleados611016` FOREIGN KEY (`id_terminal`) REFERENCES `terminales` (`id_terminal`);

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `FKRutas490932` FOREIGN KEY (`id_terminal_destino`) REFERENCES `terminales` (`id_terminal`),
  ADD CONSTRAINT `FKRutas509318` FOREIGN KEY (`id_autobus`) REFERENCES `autobuses` (`id_autobus`),
  ADD CONSTRAINT `FKRutas770277` FOREIGN KEY (`id_terminal_origen`) REFERENCES `terminales` (`id_terminal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
