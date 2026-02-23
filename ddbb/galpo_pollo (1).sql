-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-01-2026 a las 15:38:30
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
-- Base de datos: `galpo_pollo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `codigo` int(10) NOT NULL,
  `codigo_orions` varchar(10) NOT NULL,
  `descripcion_material` text NOT NULL,
  `cantidad_total` float NOT NULL,
  `cantidad_restante` int(20) NOT NULL,
  `unidad` float NOT NULL,
  `gastos_varios` int(11) NOT NULL,
  `precio_kilo` float NOT NULL,
  `cloro` int(11) NOT NULL,
  `vinagre` int(11) NOT NULL,
  `hacido_hacetico` int(11) NOT NULL,
  `vitaminas` int(11) NOT NULL,
  `precio_cloro` float NOT NULL,
  `precio_vinagre` float NOT NULL,
  `precio_hacido` float NOT NULL,
  `precio_vitamina` float NOT NULL,
  `precio_gastos_varios` float NOT NULL,
  `anores` int(10) NOT NULL,
  `precio_anores` float NOT NULL,
  `vacunas` int(10) NOT NULL,
  `precio_vacunas` float NOT NULL,
  `respiros` int(10) NOT NULL,
  `precio_respiros` int(11) NOT NULL,
  `tamo` int(10) NOT NULL,
  `precio_tamo` float NOT NULL,
  `cal` int(10) NOT NULL,
  `precio_cal` float NOT NULL,
  `antibiotico` int(10) NOT NULL,
  `precio_antibiotico` float NOT NULL,
  `abc` int(10) NOT NULL,
  `precio_abc` float NOT NULL,
  `vicarbonato` int(10) NOT NULL,
  `precio_vicarbonato` float NOT NULL,
  `melasa` int(10) NOT NULL,
  `precio_melasa` float NOT NULL,
  `yodo` int(10) NOT NULL,
  `precio_yodo` float NOT NULL,
  `agua_potable` int(1) NOT NULL,
  `precio_agua` float NOT NULL,
  `luz` int(10) NOT NULL,
  `precio_luz` float NOT NULL,
  `arriendo` int(10) NOT NULL,
  `precio_arriendo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`codigo`, `codigo_orions`, `descripcion_material`, `cantidad_total`, `cantidad_restante`, `unidad`, `gastos_varios`, `precio_kilo`, `cloro`, `vinagre`, `hacido_hacetico`, `vitaminas`, `precio_cloro`, `precio_vinagre`, `precio_hacido`, `precio_vitamina`, `precio_gastos_varios`, `anores`, `precio_anores`, `vacunas`, `precio_vacunas`, `respiros`, `precio_respiros`, `tamo`, `precio_tamo`, `cal`, `precio_cal`, `antibiotico`, `precio_antibiotico`, `abc`, `precio_abc`, `vicarbonato`, `precio_vicarbonato`, `melasa`, `precio_melasa`, `yodo`, `precio_yodo`, `agua_potable`, `precio_agua`, `luz`, `precio_luz`, `arriendo`, `precio_arriendo`) VALUES
(1, '9605176045', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '60411123', 'almacen', 6629.8, 0, 0, 0, 7000, 1, 1, 1, 2, 250000, 390000, 2127000, 95000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 200000, 1, 675000),
(3, '2139190892', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '5742384044', '', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 781000, 0, 0, 0, 0, 0, 0, 1, 750000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galpon_1`
--

CREATE TABLE `galpon_1` (
  `codigo` int(10) NOT NULL,
  `codigo_orions` varchar(10) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `tipo_alimento` varchar(200) NOT NULL,
  `fayido` int(255) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `cantidad_pollo` int(10) NOT NULL,
  `color` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `precio_pollo` float NOT NULL,
  `precio_alimento` float NOT NULL,
  `alimento_inicio` int(10) NOT NULL,
  `precio_inicio` float NOT NULL,
  `alimento_preinicio` int(10) NOT NULL,
  `precio_preinicio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galpon_1`
--

INSERT INTO `galpon_1` (`codigo`, `codigo_orions`, `descripcion`, `tipo_alimento`, `fayido`, `cantidad`, `cantidad_pollo`, `color`, `fecha_inicio`, `fecha_fin`, `precio_pollo`, `precio_alimento`, `alimento_inicio`, `precio_inicio`, `alimento_preinicio`, `precio_preinicio`) VALUES
(1, '60411123', 'todo bien', 'Soya', 200, 296, 2500, 'Blanco', '2025-10-13', '2025-11-29', 3400, 95200, 0, 0, 0, 0),
(2, '9638903003', 'eyry', 'dfd', 6, 20000, 34, 'cnvcn', '2025-12-03', '2025-12-03', 500, 7000, 50, 10000, 10, 2000),
(3, '2139190892', 'erhrhs', 'rrrrrrrrrrrrrrrrrrrrr', 6, 200, 2500, 'gfdhch', '2025-12-03', '2025-12-03', 3000, 100000, 50, 20000, 100, 50000),
(4, '5742384044', 'dev', 'soya', 0, 0, 3000, 'Blanco', '2025-12-13', '2025-12-25', 3400, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galpon_2`
--

CREATE TABLE `galpon_2` (
  `codigo` int(10) NOT NULL,
  `codigo_orions` varchar(10) NOT NULL,
  `color` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `cantidad` int(10) NOT NULL,
  `tipo_alimento` varchar(200) NOT NULL,
  `fayido` int(255) NOT NULL,
  `cantidad_pollo` int(10) NOT NULL,
  `precio_pollo` float NOT NULL,
  `precio_alimento` float NOT NULL,
  `alimento_preinicio` int(10) NOT NULL,
  `precio_preinicio` float NOT NULL,
  `alimento_inicio` int(10) NOT NULL,
  `precio_inicio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galpon_2`
--

INSERT INTO `galpon_2` (`codigo`, `codigo_orions`, `color`, `descripcion`, `fecha_inicio`, `fecha_fin`, `cantidad`, `tipo_alimento`, `fayido`, `cantidad_pollo`, `precio_pollo`, `precio_alimento`, `alimento_preinicio`, `precio_preinicio`, `alimento_inicio`, `precio_inicio`) VALUES
(2, '9605176045', 'dev', 'dev', '2025-12-05', '2025-12-05', 700, 'dev', 50, 560, 500, 500, 66, 700, 55, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(5) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Asignador'),
(3, 'Operador'),
(4, 'Usuario'),
(5, 'Externo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(5) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sigla` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `nombre`, `sigla`) VALUES
(1, 'Cédula de ciudadania', 'CC'),
(2, 'Tarjeta identidad', 'TI'),
(3, 'Cédula de extrangeria', 'CE'),
(4, 'Permiso especial', 'PEP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo` int(5) NOT NULL,
  `tipo_documento` varchar(5) NOT NULL,
  `numero_documento` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(30) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `regional_cod` int(5) NOT NULL,
  `centro_formacion_cod` int(5) NOT NULL,
  `direccion_sede` varchar(100) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `rol_id` int(5) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo`, `tipo_documento`, `numero_documento`, `nombre`, `usuario`, `contrasena`, `email`, `telefono`, `ciudad`, `regional_cod`, `centro_formacion_cod`, `direccion_sede`, `cargo`, `area`, `rol_id`, `estado`) VALUES
(1, 'CC', '1090368245', 'Carlos lopez', '1', '1', 'cjlopez231@sena.edu.co', '3223980756', 'undefined', 0, 0, 'undefined', 'undefined', 'undefined', 1, '1'),
(2, 'CC', '60411123', 'Maricela Lopez', '2', '2', 'maricelalpoz113@gamil.com', '3102200250', '', 0, 0, '', '', '', 1, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_orions` (`codigo_orions`);

--
-- Indices de la tabla `galpon_1`
--
ALTER TABLE `galpon_1`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `fecha` (`codigo_orions`);

--
-- Indices de la tabla `galpon_2`
--
ALTER TABLE `galpon_2`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `fecha` (`codigo_orions`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo_documento`),
  ADD UNIQUE KEY `sigla` (`sigla`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `galpon_2`
--
ALTER TABLE `galpon_2`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_documento` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
