-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-04-2019 a las 11:54:32
-- Versión del servidor: 5.7.25-0ubuntu0.18.04.2
-- Versión de PHP: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fep`
--
DROP DATABASE IF EXISTS `fep`;
CREATE DATABASE IF NOT EXISTS `fep` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fep`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_memoria`
--

DROP TABLE IF EXISTS `categoria_memoria`;
CREATE TABLE `categoria_memoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `subtotal` double NOT NULL DEFAULT '0',
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

DROP TABLE IF EXISTS `categoria_producto`;
CREATE TABLE `categoria_producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `grupo` varchar(50) NOT NULL,
  `id_profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memoria_costos`
--

DROP TABLE IF EXISTS `memoria_costos`;
CREATE TABLE `memoria_costos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `unidad_medida` varchar(45) DEFAULT NULL,
  `volumen` double DEFAULT NULL,
  `costo_unitario` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memoria_gastos`
--

DROP TABLE IF EXISTS `memoria_gastos`;
CREATE TABLE `memoria_gastos` (
  `id` int(11) NOT NULL,
  `concepto` varchar(100) NOT NULL,
  `unidad_medida` varchar(45) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo_unitario` double NOT NULL,
  `frecuencia` double NOT NULL,
  `costo_mensual` double NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mes_produccion`
--

DROP TABLE IF EXISTS `mes_produccion`;
CREATE TABLE `mes_produccion` (
  `id` int(11) NOT NULL,
  `monto` double DEFAULT NULL,
  `id_concepto` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros_produccion`
--

DROP TABLE IF EXISTS `parametros_produccion`;
CREATE TABLE `parametros_produccion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentaje_produccion`
--

DROP TABLE IF EXISTS `porcentaje_produccion`;
CREATE TABLE `porcentaje_produccion` (
  `id` int(11) NOT NULL,
  `ciclo` int(11) NOT NULL,
  `primera` int(2) NOT NULL DEFAULT '0',
  `segunda` int(2) NOT NULL DEFAULT '0',
  `tercera` int(2) NOT NULL DEFAULT '0',
  `mermas` int(2) NOT NULL DEFAULT '0',
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

DROP TABLE IF EXISTS `precios`;
CREATE TABLE `precios` (
  `id` int(11) NOT NULL,
  `primera` double NOT NULL,
  `segunda` double NOT NULL,
  `tercera` double NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_inversion`
--

DROP TABLE IF EXISTS `presupuesto_inversion`;
CREATE TABLE `presupuesto_inversion` (
  `id` int(11) NOT NULL,
  `concepto` varchar(45) DEFAULT NULL,
  `unidad` varchar(45) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `costo_unitario` double DEFAULT NULL,
  `montos` double DEFAULT NULL,
  `programas` double DEFAULT NULL,
  `socios` double DEFAULT NULL,
  `id_activo` int(11) DEFAULT NULL,
  `id_proyecto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion_mensual`
--

DROP TABLE IF EXISTS `produccion_mensual`;
CREATE TABLE `produccion_mensual` (
  `id` int(11) NOT NULL,
  `concepto` varchar(45) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

DROP TABLE IF EXISTS `tecnicos`;
CREATE TABLE `tecnicos` (
  `id` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `plantas_metro` int(11) NOT NULL,
  `plantas_modulo` int(11) NOT NULL,
  `rendimiento` int(11) NOT NULL,
  `um` varchar(50) NOT NULL,
  `modulos` int(11) NOT NULL,
  `riego` int(11) NOT NULL,
  `calefaccion` int(11) NOT NULL,
  `ciclos` int(11) NOT NULL,
  `inflacion` double NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_activo`
--

DROP TABLE IF EXISTS `tipo_activo`;
CREATE TABLE `tipo_activo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_activo`
--

INSERT INTO `tipo_activo` (`id`, `tipo`) VALUES
(1, 'activo'),
(2, 'pasivo'),
(3, 'capital');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `matricula` varchar(11) NOT NULL,
  `grupo` varchar(10) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `foto` varchar(500) NOT NULL DEFAULT 'No-profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `matricula`, `grupo`, `nombres`, `apellido_paterno`, `apellido_materno`, `pass`, `foto`) VALUES
(1, 'adminnova', 'root', 'Administrador de FEP', 'Nova', 'Universitas', '3strellitaMarinera', 'No-profile.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_memoria`
--
ALTER TABLE `categoria_memoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`grupo`),
  ADD UNIQUE KEY `grupo` (`grupo`);

--
-- Indices de la tabla `memoria_costos`
--
ALTER TABLE `memoria_costos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `memoria_gastos`
--
ALTER TABLE `memoria_gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mes_produccion`
--
ALTER TABLE `mes_produccion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `parametros_produccion`
--
ALTER TABLE `parametros_produccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `porcentaje_produccion`
--
ALTER TABLE `porcentaje_produccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuesto_inversion`
--
ALTER TABLE `presupuesto_inversion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `produccion_mensual`
--
ALTER TABLE `produccion_mensual`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `proyecto_id` (`id_proyecto`),
  ADD KEY `fk_proyecto_id_idx` (`id_proyecto`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `usuario_id_idx` (`id_usuario`);

--
-- Indices de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_activo`
--
ALTER TABLE `tipo_activo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_memoria`
--
ALTER TABLE `categoria_memoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `memoria_costos`
--
ALTER TABLE `memoria_costos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `memoria_gastos`
--
ALTER TABLE `memoria_gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mes_produccion`
--
ALTER TABLE `mes_produccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `parametros_produccion`
--
ALTER TABLE `parametros_produccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `porcentaje_produccion`
--
ALTER TABLE `porcentaje_produccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `presupuesto_inversion`
--
ALTER TABLE `presupuesto_inversion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `produccion_mensual`
--
ALTER TABLE `produccion_mensual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_activo`
--
ALTER TABLE `tipo_activo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
