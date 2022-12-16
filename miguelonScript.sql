-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2022 a las 17:49:41
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miguelon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterramiento`
--

CREATE TABLE `enterramiento` (
  `ID` int(11) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `ID_Yac` int(11) NOT NULL,
  `ID_Part` int(11) NOT NULL,
  `posicion` varchar(20) NOT NULL,
  `orientacion` varchar(20) NOT NULL,
  `tamanoEnterramientoAncho` float NOT NULL,
  `tamanoEnterramientoLargo` float NOT NULL,
  `tamanoIndividuo` float NOT NULL,
  `edadAprox` varchar(20) NOT NULL,
  `sexoEstimado` varchar(20) NOT NULL,
  `tipoDescomposicion` varchar(20) NOT NULL,
  `causaMuerte` varchar(200) NOT NULL,
  `tipoEnterramiento` varchar(20) NOT NULL,
  `restosIndirectos` varchar(300) NOT NULL,
  `Comentarios` varchar(500) NOT NULL,
  `ultModificacion` date DEFAULT NULL,
  `excavadores` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enterramiento`
--

INSERT INTO `enterramiento` (`ID`, `alias`, `ID_Yac`, `ID_Part`, `posicion`, `orientacion`, `tamanoEnterramientoAncho`, `tamanoEnterramientoLargo`, `tamanoIndividuo`, `edadAprox`, `sexoEstimado`, `tipoDescomposicion`, `causaMuerte`, `tipoEnterramiento`, `restosIndirectos`, `Comentarios`, `ultModificacion`, `excavadores`) VALUES
(56, '', 5, 2, 'dSupino', 'norte', 0, 0, 0, 'infantil', 'fem', 'vacio', '', 'primario', '-', '', '2022-12-15', 'oo@gmail.com'),
(57, '', 5, 2, 'dSupino', 'norte', 0, 0, 0, 'infantil', 'fem', 'vacio', '', 'primario', '-', '', '2022-12-15', 'oo@gmail.com'),
(58, 'normal', 3, 2, '', 'oeste', 0, 0, 654, 'infantil', 'masc', 'vacio', '', 'primario', 'existen restos indirectos', '', '2022-12-16', 'oo@gmail.com'),
(59, '', 3, 2, 'dProno', 'sur', 0, 0, 0, 'joven', 'masc', 'vacio', '', 'primario', '-', '', '2022-12-16', 'oo@gmail.com'),
(60, 'gg', 3, 2, 'dLatD', '', 0, 0, 0, 'infantil', 'masc', '', '', '', 'existen restos indirectos', '', '2022-12-16', 'oo@gmail.com'),
(61, '', 3, 2, 'dProno', 'este', 0, 0, 0, 'infantil', '', '', '', '', '-', '', '2022-12-16', 'oo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esqueleto`
--

CREATE TABLE `esqueleto` (
  `ID` int(11) NOT NULL,
  `ID_Ent` int(11) NOT NULL,
  `craneo` tinyint(1) NOT NULL,
  `vCervicales` int(11) NOT NULL,
  `mandibula` tinyint(4) NOT NULL,
  `vToracicas` int(11) NOT NULL,
  `claviculaDrcha` tinyint(4) NOT NULL,
  `claviculaIzqda` tinyint(4) NOT NULL,
  `manubrio` tinyint(4) NOT NULL,
  `escapulaIzqda` tinyint(4) NOT NULL,
  `escapulaDrcha` tinyint(4) NOT NULL,
  `esternon` tinyint(4) NOT NULL,
  `costillas` int(11) NOT NULL,
  `humeroDrcha` tinyint(4) NOT NULL,
  `humeroIzqda` tinyint(4) NOT NULL,
  `vLumbares` int(11) NOT NULL,
  `cubitoDrcha` tinyint(4) NOT NULL,
  `cubitoIzqda` tinyint(4) NOT NULL,
  `radioDrcha` tinyint(4) NOT NULL,
  `radioIzqda` tinyint(4) NOT NULL,
  `pelvis` tinyint(4) NOT NULL,
  `sacro` tinyint(4) NOT NULL,
  `coccix` tinyint(4) NOT NULL,
  `falangesDrchaManos` int(11) NOT NULL,
  `falangesIzqdaManos` int(11) NOT NULL,
  `atlas` tinyint(4) NOT NULL,
  `femurDrcha` tinyint(4) NOT NULL,
  `femurIzqda` tinyint(4) NOT NULL,
  `rotulaDrcha` tinyint(4) NOT NULL,
  `rotulaIzqda` tinyint(4) NOT NULL,
  `tibiaDrcha` tinyint(4) NOT NULL,
  `tibiaIzqda` tinyint(4) NOT NULL,
  `peroneDrcha` tinyint(4) NOT NULL,
  `peroneIzqda` tinyint(4) NOT NULL,
  `falangesDrchaPies` int(11) NOT NULL,
  `falangesIzqdaPies` int(11) NOT NULL,
  `indeterminado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `esqueleto`
--

INSERT INTO `esqueleto` (`ID`, `ID_Ent`, `craneo`, `vCervicales`, `mandibula`, `vToracicas`, `claviculaDrcha`, `claviculaIzqda`, `manubrio`, `escapulaIzqda`, `escapulaDrcha`, `esternon`, `costillas`, `humeroDrcha`, `humeroIzqda`, `vLumbares`, `cubitoDrcha`, `cubitoIzqda`, `radioDrcha`, `radioIzqda`, `pelvis`, `sacro`, `coccix`, `falangesDrchaManos`, `falangesIzqdaManos`, `atlas`, `femurDrcha`, `femurIzqda`, `rotulaDrcha`, `rotulaIzqda`, `tibiaDrcha`, `tibiaIzqda`, `peroneDrcha`, `peroneIzqda`, `falangesDrchaPies`, `falangesIzqdaPies`, `indeterminado`) VALUES
(5, 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 57, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 58, 0, 0, 0, 5, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 59, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 60, 0, 4, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 61, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 5, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participant`
--

CREATE TABLE `participant` (
  `ID` int(11) NOT NULL,
  `nombre_ap` varchar(200) NOT NULL,
  `contacto` varchar(200) NOT NULL,
  `contr` varchar(500) NOT NULL,
  `entidad` varchar(200) NOT NULL,
  `codigo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `participant`
--

INSERT INTO `participant` (`ID`, `nombre_ap`, `contacto`, `contr`, `entidad`, `codigo`) VALUES
(1, 'maria', 'maria@gmail.com', '$2y$10$Mw7jKSNyqc5yEMv/3Jjp5OzF53kG.aWdfSMzlQchrdk2IP.HlI4OS', 'maria', 'maria'),
(2, 'oo', 'oo@gmail.com', '$2y$10$PjvpInr.p8hs2NlYyQqEp.qAVGgJziEl8kceisW6ICnYp1RDN7.4W', 'oo', 'oo'),
(3, 'gg', 'gg@gmail.com', '$2y$10$hrd2d5rW8juyiHnYiijVS.mIItJb9ZrZ.jRQyFrOuuDjYKdsK60cW', '', 'gg'),
(6, 'gg', 'ggg@gmail.com', '$2y$10$HwJ1xkDne6U45a6Xt.8Yge.L69mNOxt88kXrfDSdgShvMipcuOhUa', '', 'gg'),
(8, 'ggg', 'gggg@gmail.com', '$2y$10$q5YfdGyBU.hACB8r2PvnQecnGZToGTdXuchNzAous0kWEimyccvOS', 'gg', 'gg'),
(9, 'fff', 'fff', 'fff', 'ff', 'ff');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `yacimient`
--

CREATE TABLE `yacimient` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `emplazamiento` varchar(200) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `yacimient`
--

INSERT INTO `yacimient` (`ID`, `nombre`, `emplazamiento`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(1, 'Yacimiento 3', '', '0000-00-00', '0000-00-00', 'activo'),
(3, 'Yaci oo', '', '0000-00-00', '0000-00-00', 'activo'),
(5, 'rr', 'rr', '0000-00-00', '0000-00-00', 'finalizado'),
(6, 'mm', 'mm', '0000-00-00', '0000-00-00', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `yacipart`
--

CREATE TABLE `yacipart` (
  `ID` int(11) NOT NULL,
  `ID_Yaci` int(11) NOT NULL,
  `ID_Parti` int(11) NOT NULL,
  `rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `yacipart`
--

INSERT INTO `yacipart` (`ID`, `ID_Yaci`, `ID_Parti`, `rol`) VALUES
(1, 1, 1, 'admin'),
(3, 3, 2, 'admin'),
(13, 5, 1, 'admin'),
(14, 1, 2, 'usu'),
(15, 6, 3, 'admin'),
(17, 3, 1, 'usu'),
(18, 5, 2, 'usu'),
(19, 1, 3, 'usu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `enterramiento`
--
ALTER TABLE `enterramiento`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `esqueleto`
--
ALTER TABLE `esqueleto`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `ID_Ent` (`ID_Ent`);

--
-- Indices de la tabla `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `contacto` (`contacto`);

--
-- Indices de la tabla `yacimient`
--
ALTER TABLE `yacimient`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `yacipart`
--
ALTER TABLE `yacipart`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_Yaci` (`ID_Yaci`,`ID_Parti`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `enterramiento`
--
ALTER TABLE `enterramiento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `esqueleto`
--
ALTER TABLE `esqueleto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `participant`
--
ALTER TABLE `participant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `yacimient`
--
ALTER TABLE `yacimient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `yacipart`
--
ALTER TABLE `yacipart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
