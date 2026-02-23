-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2022 a las 23:17:27
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_averias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `codigo` int(10) NOT NULL,
  `codigo_orions` varchar(10) NOT NULL,
  `descripcion_material` text NOT NULL,
  `cantidad_total` int(20) NOT NULL,
  `cantidad_restante` int(20) NOT NULL,
  `unidad` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`codigo`, `codigo_orions`, `descripcion_material`, `cantidad_total`, `cantidad_restante`, `unidad`) VALUES
(1, '12345', 'pruebas de registro', 5, 2, '/'),
(2, '123456789', 'mas pruebas', 3, 1, '/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_formacion`
--

CREATE TABLE `centro_formacion` (
  `id_centro` int(5) NOT NULL,
  `regional_cod` int(5) NOT NULL,
  `cod_centro_formacion` int(5) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `nombre_centro` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `centro_formacion`
--

INSERT INTO `centro_formacion` (`id_centro`, `regional_cod`, `cod_centro_formacion`, `sigla`, `nombre_centro`) VALUES
(84, 54, 9119, 'CEDRUM', 'CENTRO DE FORMACIÓN PARA EL DESARROLLO RURAL Y MINERO - NORTE DE SANTANDER'),
(86, 54, 9537, 'CIES', 'CENTRO DE LA INDUSTRIA, LA EMPRESA Y LOS SERVICIOS-NORTE DE SANTANDER'),
(119, 54, 1991, 'SENA', 'DESPACHO DE DIRECCIÓN GENERAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_municipio_localidad` int(10) NOT NULL,
  `departamento` int(5) NOT NULL,
  `codigo` int(5) NOT NULL,
  `municipios` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_municipio_localidad`, `departamento`, `codigo`, `municipios`) VALUES
(1, 18, 1, 'CUCUTA'),
(2, 18, 3, 'ABREGO'),
(3, 18, 51, 'ARBOLEDAS'),
(4, 18, 99, 'BOCHALEMA'),
(5, 18, 109, 'BUCARASICA'),
(6, 18, 125, 'CACOTA'),
(7, 18, 128, 'CACHIRA'),
(8, 18, 172, 'CHINACOTA'),
(9, 18, 174, 'CHITAGA'),
(10, 18, 206, 'CONVENCION'),
(11, 18, 223, 'CUCUTILLA'),
(12, 18, 239, 'DURANIA'),
(13, 18, 245, 'EL CARMEN'),
(14, 18, 250, 'EL TARRA'),
(15, 18, 261, 'EL ZULIA'),
(16, 18, 313, 'GRAMALOTE'),
(17, 18, 344, 'HACARI'),
(18, 18, 347, 'HERRAN'),
(19, 18, 377, 'LABATECA'),
(20, 18, 385, 'LA ESPERANZA'),
(21, 18, 398, 'LA PLAYA'),
(22, 18, 405, 'LOS PATIOS'),
(23, 18, 418, 'LOURDES'),
(24, 18, 480, 'MUTISCUA'),
(25, 18, 498, 'OCAÑA'),
(26, 18, 518, 'PAMPLONA'),
(27, 18, 520, 'PAMPLONITA'),
(28, 18, 553, 'PUERTO SANTANDER'),
(29, 18, 599, 'RAGONVALIA'),
(30, 18, 660, 'SALAZAR'),
(31, 18, 670, 'SAN CALIXTO'),
(32, 18, 673, 'SAN CAYETANO'),
(33, 18, 680, 'SANTIAGO'),
(34, 18, 720, 'SARDINATA'),
(35, 18, 743, 'SILOS'),
(36, 18, 800, 'TEORAMA'),
(37, 18, 810, 'TIBU'),
(38, 18, 820, 'TOLEDO'),
(39, 18, 871, 'VILLACARO'),
(40, 18, 874, 'VILLA DEL ROSARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE `edificio` (
  `codigo` int(11) NOT NULL,
  `edificio_reporte` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `edificio`
--

INSERT INTO `edificio` (`codigo`, `edificio_reporte`) VALUES
(1, 'Administrativo'),
(2, 'Industria'),
(3, 'Biblioteca'),
(4, 'Aprendices'),
(5, 'Tecnoparque Tecnoacademia Cucuta'),
(6, 'Comuneros'),
(7, 'Calzado'),
(8, 'Los Patios'),
(9, 'Casa de las Cajas Reales Pamplona'),
(10, 'Agroindustrial Pamplona'),
(11, 'Tecnoparque Ocaña'),
(12, 'Centro de Alturas Ocaña'),
(13, 'Tamaco Ocaña');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_reporte`
--

CREATE TABLE `estado_reporte` (
  `id_estado_rep` int(5) NOT NULL,
  `id_estado_reporte` int(5) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_reporte`
--

INSERT INTO `estado_reporte` (`id_estado_rep`, `id_estado_reporte`, `estado`) VALUES
(1, 1, 'REGISTRADO'),
(2, 2, 'EN PROCESO'),
(3, 3, 'CERRADO'),
(4, 4, 'CANCELADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `codigo` int(10) NOT NULL,
  `reporte_id` int(10) NOT NULL,
  `codigo_orions` varchar(10) NOT NULL,
  `descripcion_material` text NOT NULL,
  `cantidad` int(10) NOT NULL,
  `unidad` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`codigo`, `reporte_id`, `codigo_orions`, `descripcion_material`, `cantidad`, `unidad`) VALUES
(1, 12, '12345', 'otras pruebas mas', 5, '/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regional`
--

CREATE TABLE `regional` (
  `id_regional` int(5) NOT NULL,
  `cod_regional` int(5) NOT NULL,
  `nombre_regional` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `regional`
--

INSERT INTO `regional` (`id_regional`, `cod_regional`, `nombre_regional`) VALUES
(1, 91, 'AMAZONAS'),
(2, 5, 'ANTIOQUIA'),
(3, 11, 'DISTRITO CAPITAL'),
(4, 13, 'BOLÍVAR'),
(5, 15, 'BOYACÁ'),
(6, 17, 'CALDAS'),
(7, 19, 'CAUCA'),
(8, 20, 'CESAR'),
(9, 23, 'CÓRDOBA'),
(10, 25, 'CUNDINAMARCA'),
(11, 27, 'CHOCÓ'),
(12, 41, 'HUILA'),
(13, 44, 'GUAJIRA'),
(14, 47, 'MAGDALENA'),
(15, 50, 'META'),
(16, 52, 'NARIÑO'),
(17, 54, 'NORTE DE SANTANDER'),
(18, 81, 'ARAUCA'),
(20, 9103, 'ATLÁNTICO'),
(21, 9517, 'CAQUETÁ'),
(22, 9519, 'CASANARE'),
(23, 94, 'GUAINÍA'),
(24, 95, 'GUAVIARE'),
(25, 86, 'PUTUMAYO'),
(26, 63, 'QUINDÍO'),
(27, 66, 'RISARALDA'),
(28, 88, 'SAN_ANDRÉS'),
(29, 9119, 'SANTANDER'),
(30, 9542, 'SUCRE'),
(31, 73, 'TOLIMA'),
(32, 97, 'VAUPÉS'),
(33, 99, 'VICHADA'),
(34, 9124, 'VALLE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_reporte` int(10) NOT NULL,
  `consecutivo` int(10) DEFAULT NULL,
  `usuario_id` varchar(20) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `operador_id` varchar(20) NOT NULL,
  `nombre_operador` varchar(20) NOT NULL,
  `estado_reporte_id` int(5) NOT NULL,
  `regional_cod` int(5) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `centro_formacion_cod` int(5) NOT NULL,
  `edificio_reporte` varchar(200) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  `descripcion_usuario` text NOT NULL,
  `descripcion_operador` text NOT NULL,
  `lugar_situacion` text NOT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`id_reporte`, `consecutivo`, `usuario_id`, `nombre_usuario`, `operador_id`, `nombre_operador`, `estado_reporte_id`, `regional_cod`, `ciudad`, `centro_formacion_cod`, `edificio_reporte`, `sede`, `fecha_registro`, `fecha_asignacion`, `descripcion_usuario`, `descripcion_operador`, `lugar_situacion`, `fecha_cierre`, `observaciones`) VALUES
(1, 1, '1090368245', 'carlos diaz', '', '', 1, 47, 'HACARI', 9119, 'pruebas.com', 'Cra. 5 #4-18 Sede de las Cajas Reales', '2022-10-08', NULL, 'afss', 'undefined', 'saf', NULL, ''),
(2, 2, '1090368245', 'carlos diaz', '', '', 1, 54, 'EL ZULIA', 9119, 'pruebas.com', 'Calle 2N Avda. 4 y 5 Barrio Pescadero', '2022-10-08', NULL, 'mas pruebas', 'undefined', 'pruemas', NULL, 'XXX'),
(3, 3, '1090368245', 'carlos diaz', '', '', 1, 47, 'ARBOLEDAS', 9119, 'pruebas.com', 'Calle 2N Avda. 4 y 5 Barrio Pescadero', '2022-10-08', NULL, 'dg', 'undefined', 'sdg', NULL, 'DDQDWQE XXX'),
(4, 4, '1090368245', 'carlos diaz', '1092234133', 'Carlos ortiz', 1, 47, 'GRAMALOTE', 9537, 'pruebas.com', 'Calle 2N Avda. 4 y 5 Barrio Pescadero', '2022-10-08', '2022-10-10', 'asfsaf', 'undefined', 'sfafa', NULL, ''),
(5, 5, '1090368245', 'carlos diaz', '', '', 1, 27, 'ARBOLEDAS', 9119, 'Administrativo', 'Calle 2N entre Avenidas 4 y 5, Barrio Pescadero', '2022-10-08', NULL, 'aggs', 'undefined', 'gaga', NULL, 'di'),
(6, 6, '1090368245', 'carlos diaz', '1092234133', 'Carlos ortiz', 2, 25, 'ARBOLEDAS', 9119, 'Industria', 'Calle 2N entre Avenidas 4 y 5, Barrio Pescadero', '2022-10-08', '2022-10-10', 'mas pruebas', 'undefined', 'pruebas.com', NULL, ''),
(7, 7, '1090368245', 'carlos diaz', '1092234133', 'Carlos ortiz', 3, 11, 'BOCHALEMA', 9119, 'Industria', 'Calle 2N entre Avenidas 4 y 5, Barrio Pescadero', '2022-10-10', '2022-10-10', 'rys4htnexyfhc g', 'undefined', 'mrdydxryrdc', '2022-10-10', 'safafsaaaaa'),
(8, 8, '1092234132', 'javier lopez ', '', '', 1, 54, 'CUCUTA', 1991, 'undefined', 'Calle 2N entre Avenidas 4 y 5, Barrio Pescadero', '2022-10-10', NULL, 'undefined', '', 'PRUEBAS', NULL, ''),
(9, 9, '1092234132', 'javier lopez ', '', '', 1, 11, 'BOCHALEMA', 9119, 'undefined', 'Calle 2N 1N-142 Barrio Pescadero', '2022-10-10', NULL, 'undefined', '', 'AFSFAFA', NULL, ''),
(10, 10, '1092234132', 'javier lopez ', '', '', 1, 15, 'BUCARASICA', 9119, 'undefined', 'Calle 2N 1N-142 Barrio Pescadero', '2022-10-10', NULL, 'SSSSS', '', 'SSSSS', NULL, ''),
(11, 11, '1092234132', 'javier lopez ', '', '', 1, 11, 'ARBOLEDAS', 9537, 'undefined', 'Calle 2N entre Avenidas 4 y 5, Barrio Pescadero', '2022-10-10', NULL, 'SDGDSGS', '', 'SGDGS', NULL, ''),
(12, 12, '1092234132', 'javier lopez ', '', '', 1, 11, 'ARBOLEDAS', 9537, 'Biblioteca', 'Calle 2N 1N-142 Barrio Pescadero', '2022-10-10', NULL, 'DDFGDF', '', 'FFFFD', NULL, ''),
(14, 14, '1092234132', 'javier lopez ', '1092234133', 'Carlos ortiz', 3, 54, 'CUCUTA', 1991, 'Administrativo', 'Calle 2N entre Avenidas 4 y 5, Barrio Pescadero', '2022-10-10', '2022-10-10', 'POR FIN TERMINAMOS', 'undefined', 'ULTIMAS PRUEBAS', '2022-10-10', 'MAS PRUEBAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(5) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id_sede` int(5) NOT NULL,
  `centro_formacion_cod` int(5) NOT NULL,
  `codigo_sede` int(5) NOT NULL,
  `municipioLocalidad` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id_sede`, `centro_formacion_cod`, `codigo_sede`, `municipioLocalidad`, `direccion`) VALUES
(1, 9119, 1, 'CUCUTA', 'Calle 2N entre Avenidas 4 y 5, Barrio Pescadero'),
(2, 9537, 125, 'CUCUTA', 'Calle 2N 1N-142 Barrio Pescadero'),
(3, 9537, 126, 'CUCUTA', 'Avenida Canal Bogotá # 1N-30'),
(4, 9537, 259, 'CUCUTA', 'Calle 3  #6-48 Barrio Comuneros'),
(5, 9119, 1991, 'LOS PATIOS', 'Avenida 10 # 29-06, Patios Centro'),
(6, 9119, 9537, 'PAMPLONA', 'Carrera 5 # 4-20, Centro'),
(7, 9119, 5445, 'PAMPLONA', '9A # 3-120 Barrio Camellon'),
(8, 9119, 2222, 'OCAÑA', 'Transversal 30 # 7-110 Barrio Primavera'),
(9, 9537, 333333, 'OCAÑA', 'Carrera 9 A #39-56 Las Ferias'),
(10, 9119, 55555, 'OCAÑA', 'Calle 12 # 10-40, Barrio Tamaco'),
(11, 9119, 6666, 'CUCUTA', 'Calle 18 # 5-25 Zona Industrial, Prados Norte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(5) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sigla` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo`, `tipo_documento`, `numero_documento`, `nombre`, `usuario`, `contrasena`, `email`, `telefono`, `ciudad`, `regional_cod`, `centro_formacion_cod`, `direccion_sede`, `cargo`, `area`, `rol_id`, `estado`) VALUES
(1, 'CC', '1090368245', 'carlos diaz', '1', '1', 'crdiaz@sena.edu.co', '3017947006', 'CUCUTA', 54, 9119, 'Calle 2N Avda. 4 y 5 Barrio Pescadero', 'area', '1', 1, '1'),
(2, 'CC', '1092234132', 'javier lopez ', '4', '4', 'cjlopez@misena.edu.co', '11111111', 'CUCUTA', 54, 9537, 'Calle 2N Avda. 4 y 5 Barrio Pescadero', 'pruebas', 'oficina', 4, '1'),
(3, 'CC', '1092234133', 'Carlos ortiz', '3', '3', 'cjlopez231@misena.edu.co', '2222222', 'CUCUTA', 54, 9537, 'Calle 2N Avda. 4 y 5 Barrio Pescadero', 'area pruebas', 'mas area', 3, '1'),
(4, 'CC', '11111111', 'Leidy bibiana gonzalez pardo', '2', '2', 'lbgonzalezp@sena.edu.co', '222222222', 'CUCUTA', 54, 9119, 'Calle 2N Avda. 4 y 5 Barrio Pescadero', 'xxxx', 'xxxx', 2, '1'),
(5, 'CC', '60318501', 'Fanny Suarez', '60318501', '60318501', 'frsuarez@sena.edu.co', '3183270410', 'CUCUTA', 54, 9119, 'Calle 2N Avda. 4 y 5 Barrio Pescadero', 'Profesional Infraestructura', 'Grupo de apoyo administrativo mixto', 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_estado`
--

CREATE TABLE `usuario_estado` (
  `codigo` int(5) NOT NULL,
  `nombre_estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario_estado`
--

INSERT INTO `usuario_estado` (`codigo`, `nombre_estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

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
-- Indices de la tabla `centro_formacion`
--
ALTER TABLE `centro_formacion`
  ADD PRIMARY KEY (`id_centro`),
  ADD UNIQUE KEY `cod_centro` (`cod_centro_formacion`),
  ADD KEY `regional_cod` (`regional_cod`),
  ADD KEY `cod_centro_2` (`cod_centro_formacion`),
  ADD KEY `cod_centro_formacion` (`cod_centro_formacion`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_municipio_localidad`),
  ADD UNIQUE KEY `ciudad` (`municipios`),
  ADD KEY `departamento` (`departamento`);

--
-- Indices de la tabla `edificio`
--
ALTER TABLE `edificio`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `estado_reporte`
--
ALTER TABLE `estado_reporte`
  ADD PRIMARY KEY (`id_estado_rep`),
  ADD UNIQUE KEY `id_estado_reporte` (`id_estado_reporte`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigo_orions` (`codigo_orions`);

--
-- Indices de la tabla `regional`
--
ALTER TABLE `regional`
  ADD PRIMARY KEY (`id_regional`),
  ADD UNIQUE KEY `cod_region` (`cod_regional`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `sede` (`sede`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `regional_cod` (`regional_cod`),
  ADD KEY `centro_formacion_cod` (`centro_formacion_cod`),
  ADD KEY `estado_reporte_id` (`estado_reporte_id`),
  ADD KEY `operador_id` (`operador_id`) USING BTREE,
  ADD KEY `consecutivo` (`consecutivo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sede`),
  ADD UNIQUE KEY `codigo` (`codigo_sede`),
  ADD KEY `centro_formacion_cod` (`centro_formacion_cod`);

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
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `identificacion` (`numero_documento`) USING BTREE,
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `tipo_documento` (`tipo_documento`),
  ADD KEY `regional_cod` (`regional_cod`),
  ADD KEY `centro_formacion_cod` (`centro_formacion_cod`),
  ADD KEY `ciudad` (`ciudad`);

--
-- Indices de la tabla `usuario_estado`
--
ALTER TABLE `usuario_estado`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `centro_formacion`
--
ALTER TABLE `centro_formacion`
  MODIFY `id_centro` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_municipio_localidad` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `edificio`
--
ALTER TABLE `edificio`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `estado_reporte`
--
ALTER TABLE `estado_reporte`
  MODIFY `id_estado_rep` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `regional`
--
ALTER TABLE `regional`
  MODIFY `id_regional` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_reporte` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sede` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_documento` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario_estado`
--
ALTER TABLE `usuario_estado`
  MODIFY `codigo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `centro_formacion`
--
ALTER TABLE `centro_formacion`
  ADD CONSTRAINT `centro_formacion_ibfk_1` FOREIGN KEY (`regional_cod`) REFERENCES `regional` (`cod_regional`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`numero_documento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reporte_ibfk_5` FOREIGN KEY (`estado_reporte_id`) REFERENCES `estado_reporte` (`id_estado_reporte`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
