-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2021 a las 04:43:01
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

--
-- Volcado de datos para la tabla `autobuses`
--

INSERT INTO `autobuses` (`id_autobus`, `id_empleado`, `numero_autobus`, `placa`, `capacidad_asientos`, `estado`) VALUES
(1, 26, 1, 'ABC-123-A', 30, 'c'),
(2, 4, 2, 'ABC-123-B', 30, 'c'),
(3, 12, 3, 'ABC-123-C', 32, 'c'),
(4, 8, 4, 'ABC-123-D', 29, 'c'),
(5, 27, 5, 'ABC-123-E', 32, 'c'),
(6, 40, 6, 'ABC-123-F', 29, 'c'),
(7, 30, 7, 'ABC-123-G', 30, 'c'),
(8, 32, 8, 'ABC-123-H', 30, 'c'),
(9, 37, 9, 'ABC-123-I', 30, 'c'),
(10, 41, 10, 'ABC-123-J', 30, 'c'),
(11, 42, 11, 'ABC-123-K', 32, 'c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletos`
--

CREATE TABLE `boletos` (
  `id_boleto` int(10) NOT NULL,
  `id_ruta` int(10) NOT NULL,
  `id_empleado` int(10) DEFAULT NULL,
  `id_cliente` int(10) DEFAULT NULL,
  `nombre_pasajero` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
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
  `telefono_cli` bigint(10) NOT NULL,
  `usuario_cli` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena_cli` varchar(16) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_cli`, `apellidop_cli`, `apellidom_cli`, `correo_electronico`, `telefono_cli`, `usuario_cli`, `contrasena_cli`) VALUES
(1, 'José Ángel', 'Martínez', 'Cruz', 'jose_angel404@hotmail.com', 2721394520, 'JoseMartinez', 'Jose0007'),
(2, 'Alondra', 'Castañeda', 'Morales', 'alondra.22@hotmail.com', 2711448750, 'AlondraCM', 'JDKLMD32'),
(3, 'Armando', 'Romero', 'Guzmán', 'armando.ro484@gmail.com', 2721663020, 'ArmadoRomero', '123456'),
(4, 'Gabriel', 'De los Santos', 'Cruz', 'gabriel_cruz_22@gmail.com', 2721509874, 'GabrielCruz33', 'ABCD123456'),
(11, 'Francisco Antonio', 'Xotlanihua', 'Castillo', 'fco.antonio11@hotmail.com', 2721443860, 'Frank_XC', '123456'),
(13, 'Martin', 'Xotlanihua', 'Castillo', 'martin.xc.33@gmail.com', 2721306862, 'Martin_007', '123456');

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
(2, 4, 'Gerardo', 'Trejo', 'Lobato', 'Orizaba, Veracruz', 2722044596, '2021-05-01', 4, 'GerardoTL', '123456'),
(4, 4, 'Arturo', 'Gómez', 'López', 'Puebla, Puebla', 2441556369, '2021-05-08', 4, 'ArturoGL', '123456'),
(5, 3, 'Francisco Antonio', 'Xotlanihua', 'Castillo', 'Orizaba, Veracruz', 2721443090, '2021-04-20', 1, 'FcoAntonio', '123456'),
(8, 5, 'José Miguel', 'López', 'Castillo', 'Nogales Calle principal', 2721554862, '2021-05-06', 4, 'JoseML', '123456'),
(10, 3, 'Adrian', 'Cortes', 'Diaz', 'Orizaba, Ver.', 2714456789, '2021-05-13', 1, 'AdrianCor', '12324234234'),
(11, 6, 'Josue', 'Alberto', 'Cruz', 'Calle Independencia N.12', 2721443860, '2021-05-24', 1, 'JosueAC', '123456'),
(12, 5, 'Joaquín', 'Peralta', 'Gúzman', 'Xalapa Col. Centro entre Av 13 y 15', 2721443060, '2021-05-13', 4, 'JoaquinPG', '123456'),
(21, 3, 'David', 'De los Santos', 'Mazahua', 'Calle Flores No 342 Col. Cruz', 2721272395, '2021-05-14', 2, 'DavidDF4', 'ABC1234'),
(22, 3, 'Hugo', 'Pérez', 'Rosales', 'Oriente 20 entre calles 7 y 9', 2565433232, '2021-05-14', 3, 'HugoPR004', '123456'),
(26, 3, 'Carlos', 'Ramirez', 'Cruz', 'Oriente 31 entre norte 2 y 4', 2721683244, '2021-05-10', 4, 'CarlosRC', '123456'),
(27, 6, 'Roberto', 'Martínez', 'Cruz', 'Calle constitución entre Av. Juárez y Márquez No 145', 2221648751, '2021-05-03', 4, 'RobertoMCruz', '123456'),
(28, 8, 'Martin', 'Castillo', 'Rodríguez', 'Avenida Flores No 1324 Col. Guzmán', 2721639584, '2021-05-03', 1, 'MartinCR', '123456'),
(29, 5, 'Aldo Jesus', 'Prado', 'Jimenez', 'Avenida Principal No 1453 Col Centro', 2722109081, '2021-04-20', 1, 'AldoPJ', '123456'),
(30, 12, 'Eduardo', 'Lopez', 'Lopez', 'Centro de la ciudad No 1232 Frente a la escuela Guzmán', 2215609651, '2021-05-10', 4, 'EduLopez', '654321'),
(31, 9, 'Carmen', 'Vázquez', 'Castro', 'Col. Centro Numero 1321', 2319874562, '2021-05-18', 1, 'CarmenVC', '123456'),
(32, 3, 'Martin', 'Castro', 'Ramírez', 'Avenida 11 entre calles 19 y 21', 1234567890, '2021-05-18', 4, 'MartinCR01', '123456'),
(33, 3, 'Alonso', 'Núñez', 'Ruiz', 'Oriente 7 entre Norte 14 y 16', 2721998562, '2021-05-20', 3, 'AlonsoNR', '54321AB'),
(34, 9, 'Carlos', 'Flores', 'Estrada', 'Calle Independencia entre Avenidas 14 y 16', 2241587845, '2021-05-21', 2, 'CarlosFE', 'ABCD1234'),
(35, 7, 'Carmen', 'Martinez', 'Flores', 'Avenida Hidalgo entre Calles Morelos y 5 de Mayo', 2221584562, '2021-05-17', 2, 'Carmen', 'Carmen1234'),
(36, 7, 'Margarita', 'De la Cruz', 'Carbajal', 'Calle Martínez entre Avenidas 33 y 35', 2211324578, '2021-05-17', 1, 'MargaritaCruz', 'Margarita1234'),
(37, 9, 'Carlos', 'Hernández', 'Camarillo', 'Calle 22 No. 12 Col. Guerrero', 2211478798, '2021-05-21', 4, 'CarlosHC', '1234565432'),
(38, 14, 'Kevin', 'Tornell', 'Zavala', 'Calle Madero entre Av 16 y 18', 2721587962, '2021-05-17', 1, 'KevinTornell', '1234Kevin'),
(39, 12, 'Arturo', 'Villa', 'Martínez', 'Unidad habitacional Palmas Col. Centro', 2724891020, '2021-05-10', 1, 'ArturoVMM', 'Pass4321'),
(40, 8, 'Ricardo', 'Alvarez', 'Juarez', 'Col. Centro', 2221408968, '2021-05-31', 4, 'RicardoAJ', '123456'),
(41, 3, 'José Antonio', 'Rodríguez', 'Cruz', 'Oriente 34 esquina sur 13', 2721003215, '2021-05-31', 4, 'JoseAnt', '123456'),
(42, 3, 'Uriel', 'Ruiz', 'Cadena', 'Sur 20 esquina Poniente 7', 2721603895, '2021-06-01', 4, 'UrielRC', '123456'),
(43, 3, 'Tadeo', 'Lira', 'Martínez', 'Rio Blanco Calle Vicente Guerreo', 2721468751, '2021-06-01', 4, 'TadeoLM', '123456'),
(44, 3, 'Marco Antonio', 'Diaz', 'Peláez', 'Ixtaczoquitlan Centro', 2721558430, '2021-06-01', 4, 'MarcoDP', '123456');

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
  `horario` time NOT NULL,
  `precio` double NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id_ruta`, `id_terminal_origen`, `id_terminal_destino`, `id_autobus`, `horario`, `precio`, `estado`) VALUES
(1, 3, 9, 1, '05:30:00', 450, 1),
(2, 4, 6, 2, '18:30:00', 450, 1),
(3, 8, 3, 6, '12:30:00', 350, 1),
(4, 3, 9, 8, '12:30:00', 500, 1),
(5, 3, 9, 10, '17:30:00', 450, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terminales`
--

CREATE TABLE `terminales` (
  `id_terminal` int(10) NOT NULL,
  `id_empleado` int(10) DEFAULT NULL,
  `nombre_ter` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_ter` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad_ter` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `estado_ter` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_ter` bigint(10) NOT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `terminales`
--

INSERT INTO `terminales` (`id_terminal`, `id_empleado`, `nombre_ter`, `direccion_ter`, `ciudad_ter`, `estado_ter`, `telefono_ter`, `imagen`) VALUES
(3, 10, 'PB Orizaba', 'Sur 13 entre Av. Oriente 2 y Colón Oriente No.1432 Col. Centro', 'Orizaba', 'Veracruz', 2721443860, 'Orizaba.jpg'),
(4, 1, 'PB Córdoba', 'Calle 15 entre Avenidas 11 y 7 No. 143 Col. Hidalgo', 'Córdoba', 'Veracruz', 2712842374, 'Cordoba.jpg'),
(5, 29, 'PB Xalapa', 'Avenida Ferrocarril Interoceánico entre Calles Coyoacán y Chapultepec', 'Xalapa', 'Veracruz', 2722109081, 'Xalapa.jpg'),
(6, 11, 'PB Veracruz', 'Calle principal entre Avenidas Reforma y Puerto No. 13 Col. Centro', 'Veracruz', 'Veracruz', 2224568475, 'Veracruz.jpg'),
(7, 36, 'PB Boca del Rio', 'Calle Principal entre Prolongación de Av. 10 y Av 14 No. 3 Col. Centro', 'Boca del Rio', 'Veracruz', 2721443095, 'BocaDelRio.jpg'),
(8, 28, 'PB Poza Rica', 'Calle Flores entre Avenidas 5 y 7 No. 986 Col Juárez', 'Poza Rica', 'Veracruz', 2229638747, 'PosaRica.jpg'),
(9, 31, 'PB Alvarado', 'Calle Reforma entre Avenidas 7 y 9 Frente a Empacadora Small Col. García', 'Alvarado', 'Veracruz', 2231578469, 'Alvarado.jpg'),
(12, 39, 'PB Coatza', 'Avenida 17 entre calles 2 y 4 No. 156 Col. Santa Rosa', 'Coatzacoalcos', 'Veracruz', 9212789562, 'Coatzacoalcos.jpg'),
(14, 38, 'PB Rio Blanco', 'Avenida independencia entre Calles Reforma y Revolución No. 864 Col. Centro', 'Rio Blanco', 'Veracruz', 2721107545, 'RioBlanco.jpg');

--
-- Índices para tablas volcadas
--

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
  MODIFY `id_autobus` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `boletos`
--
ALTER TABLE `boletos`
  MODIFY `id_boleto` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id_ruta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `terminales`
--
ALTER TABLE `terminales`
  MODIFY `id_terminal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

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
