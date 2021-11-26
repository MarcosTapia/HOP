-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2021 a las 20:23:17
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bmw`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardaUsuarioHabilidades` (IN `habilidadesP` VARCHAR(100))  NO SQL
BEGIN
SELECT Split(habilidadesP,"|") AS SplitString;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `idArea` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`idArea`, `descripcion`) VALUES
(1, 'Preparación'),
(2, 'Inyección'),
(3, 'Acabado Final'),
(6, 'Almacen'),
(7, 'Corte'),
(9, 'Tableros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosempresa`
--

CREATE TABLE `datosempresa` (
  `idEmpresa` int(11) NOT NULL,
  `nombreEmpresa` varchar(100) NOT NULL,
  `rfcEmpresa` varchar(20) NOT NULL,
  `direccionEmpresa` varchar(200) NOT NULL,
  `emailEmpresa` varchar(100) NOT NULL,
  `telEmpresa` varchar(30) NOT NULL,
  `cpEmpresa` varchar(30) NOT NULL,
  `ciudadEmpresa` varchar(50) NOT NULL,
  `estadoEmpresa` varchar(50) NOT NULL,
  `paisEmpresa` varchar(50) NOT NULL,
  `anio` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datosempresa`
--

INSERT INTO `datosempresa` (`idEmpresa`, `nombreEmpresa`, `rfcEmpresa`, `direccionEmpresa`, `emailEmpresa`, `telEmpresa`, `cpEmpresa`, `ciudadEmpresa`, `estadoEmpresa`, `paisEmpresa`, `anio`) VALUES
(1, 'HOP', '123123', 'Direccion muestra', 'admin@wewire-harness.com', '1234', '1234567', 'Acámbaro', 'Guanajuato', 'México', '2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapas`
--

CREATE TABLE `etapas` (
  `idEtapa` int(11) NOT NULL,
  `numeroOperacion` varchar(4) NOT NULL,
  `descripcion_operacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `etapas`
--

INSERT INTO `etapas` (`idEtapa`, `numeroOperacion`, `descripcion_operacion`) VALUES
(1, '0101', 'Corte1'),
(3, '020', 'Corte e impresión'),
(4, '040', 'Desforre jacket interno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapas_materiaprima`
--

CREATE TABLE `etapas_materiaprima` (
  `idEtapaMateriaPrima` int(11) NOT NULL,
  `idEtapa` int(11) NOT NULL,
  `idMateriaPrima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `etapas_materiaprima`
--

INSERT INTO `etapas_materiaprima` (`idEtapaMateriaPrima`, `idEtapa`, `idMateriaPrima`) VALUES
(24, 4, 5),
(25, 3, 2),
(26, 3, 3),
(27, 3, 4),
(28, 3, 5),
(29, 1, 2),
(30, 1, 3),
(31, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--

CREATE TABLE `maquinas` (
  `idMaquina` int(11) NOT NULL,
  `numero_maquina` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre_maquina` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `idArea` int(11) NOT NULL,
  `idEtapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `maquinas`
--

INSERT INTO `maquinas` (`idMaquina`, `numero_maquina`, `nombre_maquina`, `idArea`, `idEtapa`) VALUES
(11, '433', 'Schleuniger', 7, 3),
(12, '517', 'Schleuniger', 7, 3),
(13, '449', 'Corte y Desforre', 7, 4),
(14, '450', 'Corte y Desforre', 7, 4),
(15, '458', 'Grommet Assembly Tube Automatic Machine', 7, 1),
(16, '471', 'Schäfer DAI', 1, 1),
(17, '472', 'Schäfer DAI', 1, 1),
(18, '473', 'Schäfer DAI', 1, 1),
(19, '474', 'Schäfer DAI', 1, 1),
(20, '475', 'Schäfer DAI', 1, 1),
(21, '78', 'Schäfer 2002', 1, 1),
(22, '303', 'Schäfer 2002', 1, 1),
(23, '443', 'Ensamble de Housing', 3, 1),
(24, '444', 'Ensamble de Housing', 3, 1),
(25, '445', 'Ensamble de Housing', 3, 1),
(26, '518', 'Ensamble de Housing', 3, 1),
(27, '446', 'Ensamble de sello automático', 3, 1),
(28, '447', 'Ensamble de sello automático', 3, 1),
(29, '448', 'Ensamble de sello automático', 3, 1),
(30, '519', 'Ensamble de sello automático', 3, 1),
(31, '479', 'Máquina de tubos Airstom', 1, 1),
(32, '480', 'Máquina de tubos Airstom', 1, 1),
(33, '490', 'Estación de tableros ZB', 3, 1),
(34, '499', 'Estación de tableros ZB', 3, 1),
(35, '500', 'Estación de tableros ZB', 3, 1),
(36, '501', 'Estación de tableros ZB', 3, 1),
(37, '528', 'Estación de tableros ZB', 3, 1),
(38, '1-A', 'Tablero de ensamble ZB', 9, 1),
(39, '1-B', 'Tablero de ensamble ZB', 9, 1),
(40, '2-A', 'Tablero de ensamble ZB', 9, 1),
(41, '2-B', 'Tablero de ensamble ZB', 9, 1),
(42, '3-A', 'Tablero de ensamble ZB', 9, 1),
(43, '3-B', 'Tablero de ensamble ZB', 9, 1),
(44, '4-A', 'Tablero de ensamble ZB', 9, 1),
(45, '4-B', 'Tablero de ensamble ZB', 9, 1),
(46, '5', 'Tablero de ensamble ZB', 9, 1),
(47, '6', 'Tablero de ensamble ZB', 9, 1),
(48, '7', 'Tablero de ensamble ZB', 9, 1),
(49, '8', 'Tablero de ensamble ZB', 9, 1),
(50, '9', 'Tablero de ensamble ZB', 9, 1),
(51, '10', 'Tablero de ensamble ZB', 9, 1),
(52, '505', 'Detección de conectores', 1, 1),
(53, '506', 'Detección de conectores', 1, 1),
(54, '510', 'Detección de conectores', 1, 1),
(55, '511', 'Detección de conectores', 1, 1),
(56, '522', 'Detección de conectores', 1, 1),
(57, '27', 'Engel', 2, 1),
(58, '28', 'Engel', 2, 1),
(59, '29', 'Engel', 2, 1),
(60, '30', 'Engel', 2, 1),
(61, '31', 'Arburg 375', 2, 1),
(62, '32', 'Arburg 375', 2, 1),
(63, '36', 'Arburg 375', 2, 1),
(64, '37', 'LWB', 2, 1),
(65, '38', 'Arburg 375', 2, 1),
(66, '39', 'Arburg 375', 2, 1),
(67, '40', 'Arburg 375', 2, 1),
(68, '41', 'Arburg 375', 2, 1),
(69, '42', 'LWB', 2, 1),
(70, '481', 'TSK', 3, 1),
(71, '512', 'TSK', 3, 1),
(72, '79', 'Kappa 350', 7, 1),
(73, '216', 'Alpha 355', 7, 1),
(74, '531', 'Alpha 550', 7, 1),
(75, '313', 'Alpha 488 S', 7, 1),
(76, '80', 'AM Strip', 1, 1),
(77, '147', 'AM Strip', 1, 1),
(78, '214', 'AM Strip', 1, 1),
(79, '172', 'Pull Grommet Machine Vintage', 1, 1),
(80, '217', 'Komax BT288', 3, 1),
(81, '426', 'Stopfen Machine', 1, 1),
(82, '343', 'Expander', 1, 1),
(83, '342', 'Expander', 1, 1),
(84, '344', 'Expander', 1, 1),
(85, '413', 'CCD machine', 2, 1),
(86, '417', 'Ensamble de tubo automático', 1, 1),
(87, '507', 'Ensamble de tubo automático', 1, 1),
(88, '434', 'Full Automatic Machine', 1, 1),
(89, '1', 'Arburg 1500', 2, 1),
(90, '2', 'Arburg 1500', 2, 1),
(91, '3', 'Arburg 1500', 2, 1),
(92, '4', 'Arburg 375', 2, 1),
(93, '5', 'Arburg 375', 2, 1),
(94, '6', 'Arburg 375', 2, 1),
(95, '7', 'Arburg 375', 2, 1),
(96, '8', 'Arburg 375', 2, 1),
(97, '9', 'Arburg 375', 2, 1),
(98, '10', 'Arburg 375', 2, 1),
(99, '11', 'Arburg 375', 2, 1),
(100, '12', 'Arburg 375', 2, 1),
(101, '13', 'Arburg 375', 2, 1),
(102, '14', 'Arburg 375', 2, 1),
(103, '15', 'Arburg 375', 2, 1),
(104, '16', 'Arburg 375', 2, 1),
(105, '17', 'Arburg 375', 2, 1),
(106, '18', 'Arburg 375', 2, 1),
(107, '19', 'Arburg 375', 2, 1),
(108, '21', 'Arburg 375', 2, 1),
(109, '22', 'Arburg 375', 2, 1),
(110, '23', 'Arburg 375', 2, 1),
(111, '24', 'Arburg 375', 2, 1),
(112, '25', 'LWB', 2, 1),
(113, '26', 'LWB', 2, 1),
(114, '43', 'LWB', 2, 1),
(115, '1', 'TSK', 3, 1),
(116, '2', 'TSK', 3, 1),
(117, '3', 'TSK', 3, 1),
(118, '4', 'TSK', 3, 1),
(119, '5', 'TSK', 3, 1),
(120, '6', 'TSK', 3, 1),
(121, '7', 'TSK', 3, 1),
(122, '8', 'TSK', 3, 1),
(123, '9', 'TSK', 3, 1),
(124, '10', 'TSK', 3, 1),
(125, '529', 'TSK', 3, 1),
(126, '520', 'Schäfer 2002', 1, 1),
(127, '521', 'Heat Shrinking tube machine', 1, 1),
(128, '513', 'TSK', 3, 1),
(130, '485', 'Prensa Manual', 1, 1),
(131, '20', 'LWB', 2, 1),
(132, '532', 'Prensa semiautomática', 1, 1),
(133, '44', 'Arburg 420', 2, 1),
(134, '8V0 927 902 G/17A 927 902 B/ 8V0 927 902 T', 'Tableros Dimensionales VW', 3, 1),
(135, '5NA 927 902 N', 'Tableros Dimensionales VW', 3, 1),
(136, '5NA 927 902 N_', 'Tableros Dimensionales VW', 3, 1),
(137, '8V0 927 902 F / 17A 927 902', 'Tableros Dimensionales VW', 3, 1),
(138, '3CN 927 902 E', 'Tableros Dimensionales VW', 3, 1),
(139, '3CN 927 902 D', 'Tableros Dimensionales VW', 3, 1),
(140, '3CN 927 902 D_', 'Tableros Dimensionales VW', 3, 1),
(141, '3CN 927 902 E_', 'Tableros Dimensionales VW', 3, 1),
(142, '5GD 927 902 / 17A 927 902 A', 'Tableros Dimensionales VW', 3, 1),
(143, '5NA 927 902 J', 'Tableros Dimensionales VW', 3, 1),
(144, '5NA 927 902 J_', 'Tableros Dimensionales VW', 3, 1),
(145, '5GD 927 902 B / 17A 927 902 C', 'Tableros Dimensionales VW', 3, 1),
(146, '2Q0 927 903 D', 'Tableros Auxiliares VW', 3, 1),
(147, '2Q0 927 903 D_', 'Tableros Auxiliares VW', 3, 1),
(148, '2Q0 927 904 C', 'Tableros Auxiliares VW', 3, 1),
(149, '2Q0 927 904 C_', 'Tableros Auxiliares VW', 3, 1),
(150, '2Q0 927 904 E', 'Tableros Auxiliares VW', 3, 1),
(151, '2Q0 927 904 E_', 'Tableros Auxiliares VW', 3, 1),
(152, '2Q0 927 903 E', 'Tableros Auxiliares VW', 3, 1),
(153, '2Q0 927 903 E_', 'Tableros Auxiliares VW', 3, 1),
(154, '3CN 927 903', 'Tableros Auxiliares VW', 3, 1),
(155, '3CN 927 903 D', 'Tableros Auxiliares VW', 3, 1),
(156, '3CN 927 903 E', 'Tableros Auxiliares VW', 3, 1),
(157, '5C0 927 904 A', 'Tableros Auxiliares VW', 3, 1),
(158, '5C0 927 903 B', 'Tableros Auxiliares VW', 3, 1),
(159, '5C0 927 904 C', 'Tableros Auxiliares VW', 3, 1),
(160, '5G0 927 903 AA', 'Tableros Auxiliares VW', 3, 1),
(161, '5G0 927 903 S', 'Tableros Auxiliares VW', 3, 1),
(162, '5G0 927 904 BM', 'Tableros Auxiliares VW', 3, 1),
(163, '5G0 927 904 AR', 'Tableros Auxiliares VW', 3, 1),
(164, '5G0 927 904 AR_', 'Tableros Auxiliares VW', 3, 1),
(165, '5G0 927 904 BB', 'Tableros Auxiliares VW', 3, 1),
(166, '5G0 927 903 AH', 'Tableros Auxiliares VW', 3, 1),
(167, '5G0 927 904 AQ', 'Tableros Auxiliares VW', 3, 1),
(168, '561 927 904 ', 'Tableros Auxiliares VW', 3, 1),
(169, '561 927 903 A', 'Tableros Auxiliares VW', 3, 1),
(170, '561 927 903 E', 'Tableros Auxiliares VW', 3, 1),
(171, '561 927 904 A', 'Tableros Auxiliares VW', 3, 1),
(172, '56D 927 904', 'Tableros Auxiliares VW', 3, 1),
(173, '56D 927 904_', 'Tableros Auxiliares VW', 3, 1),
(174, '5G0 927 904 AR/56D 927 904/5G0 927 904 BM', 'Tableros Auxiliares VW', 3, 1),
(175, '5TA 927 903 E', 'Tableros Auxiliares VW', 3, 1),
(176, '5TA 927 903 F', 'Tableros Auxiliares VW', 3, 1),
(177, '5TA 927 903 H', 'Tableros Auxiliares VW', 3, 1),
(178, '5TA 927 903 K', 'Tableros Auxiliares VW', 3, 1),
(179, '80A 972 251', 'Tableros Auxiliares VW', 3, 1),
(180, '80A 927 252', 'Tableros Auxiliares VW', 3, 1),
(181, '80A 972 253', 'Tableros Auxiliares VW', 3, 1),
(182, '80A 927 254', 'Tableros Auxiliares VW', 3, 1),
(183, '17A 927 903 A/C', 'Tableros Auxiliares VW', 3, 1),
(184, '17A 927 903', 'Tableros Auxiliares VW', 3, 1),
(185, '5U0 927 904', 'Tableros Auxiliares VW', 3, 1),
(186, '5U0 927 904 A', 'Tableros Auxiliares VW', 3, 1),
(187, '5G0 927 903 AK', 'Tableros Auxiliares VW', 3, 1),
(188, '2Q0 927 903 D Paso 1', 'Tableros Auxiliares VW', 2, 1),
(189, '2Q0 927 903 E Paso 1', 'Tableros Auxiliares VW', 2, 1),
(190, '2Q0 927 903 E Paso 1_', 'Tableros Auxiliares VW', 2, 1),
(191, '2Q0 927 904 C Paso 2', 'Tableros Auxiliares VW', 2, 1),
(192, '2Q0 927 904 E Y C Paso 1', 'Tableros Auxiliares VW', 2, 1),
(193, '2Q0 927 904 E Paso 1', 'Tableros Auxiliares VW', 2, 1),
(194, '2Q0 927 904 E Paso 2', 'Tableros Auxiliares VW', 2, 1),
(195, '3CN 927 903 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(196, '3CN 927 903 Paso 2', 'Tableros Auxiliares VW', 2, 1),
(197, '3CN 927 903 Paso 3', 'Tableros Auxiliares VW', 2, 1),
(198, '3CN 927 903 Desforre intermedio Paso 1', 'Tableros Auxiliares VW', 2, 1),
(199, '3CN 927 903 D Paso 1', 'Tableros Auxiliares VW', 2, 1),
(200, '3CN 927 903 D Paso 2', 'Tableros Auxiliares VW', 2, 1),
(201, '3CN 927 903 D Paso 3', 'Tableros Auxiliares VW', 2, 1),
(202, '3CN 927 903 D Paso 4', 'Tableros Auxiliares VW', 2, 1),
(203, '3CN 927 903 D Paso 4_', 'Tableros Auxiliares VW', 2, 1),
(204, '3CN 927 903 E Paso 1', 'Tableros Auxiliares VW', 2, 1),
(205, '3CN 927 903 E Paso 2', 'Tableros Auxiliares VW', 2, 1),
(206, '3CN 927 903 E Paso 3', 'Tableros Auxiliares VW', 2, 1),
(207, '3CN 927 903 E Paso 4', 'Tableros Auxiliares VW', 2, 1),
(208, '3CN 927 903 E Desforre intermedio Paso 4', 'Tableros Auxiliares VW', 2, 1),
(209, '3CN 927 902 E Paso 1', 'Tableros Auxiliares VW', 2, 1),
(210, '3CN 927 902 E Paso 2', 'Tableros Auxiliares VW', 2, 1),
(211, '3CN 927 902 E Paso 3', 'Tableros Auxiliares VW', 2, 1),
(212, '3CN 927 902 D Paso 1', 'Tableros Auxiliares VW', 2, 1),
(213, '3CN 927 902 D Paso 2', 'Tableros Auxiliares VW', 2, 1),
(214, '3CN 927 902 D Paso 3', 'Tableros Auxiliares VW', 2, 1),
(215, '5C0 927 903 B Paso 1', 'Tableros Auxiliares VW', 2, 1),
(216, '5C0 927 903 B Paso 2', 'Tableros Auxiliares VW', 2, 1),
(217, '5C0 927 903 B Paso 3', 'Tableros Auxiliares VW', 2, 1),
(218, '5C0 927 903 B Paso 3_', 'Tableros Auxiliares VW', 2, 1),
(219, '5C0 927 903 B Paso 4', 'Tableros Auxiliares VW', 2, 1),
(220, '5C0 927 903 B Desforre intermedio Paso 5', 'Tableros Auxiliares VW', 2, 1),
(221, '5C0 927 903 E Paso 1', 'Tableros Auxiliares VW', 2, 1),
(222, '5C0 927 903 E Paso 2', 'Tableros Auxiliares VW', 2, 1),
(223, '5C0 927 903 E Paso 3', 'Tableros Auxiliares VW', 2, 1),
(224, '5C0 927 903 E Paso 3_', 'Tableros Auxiliares VW', 2, 1),
(225, '5C0 927 903 E LAY- OUT', 'Tableros Auxiliares VW', 2, 1),
(226, '5C0 927 903 E Desforre intermedio Paso 4', 'Tableros Auxiliares VW', 2, 1),
(227, '5C0 927 904 A Paso 1', 'Tableros Auxiliares VW', 2, 1),
(228, '5C0 927 904 A Paso 2', 'Tableros Auxiliares VW', 2, 1),
(229, '5C0 927 904 A Paso 3', 'Tableros Auxiliares VW', 2, 1),
(230, '5C0 927 904 A Paso 4', 'Tableros Auxiliares VW', 2, 1),
(231, '5C0 927 904 A Paso 4_', 'Tableros Auxiliares VW', 2, 1),
(232, '5C0 927 904 A Paso 5', 'Tableros Auxiliares VW', 2, 1),
(233, '5C0 927 904 C Paso 1', 'Tableros Auxiliares VW', 2, 1),
(234, '5C0 927 904 C Paso 2', 'Tableros Auxiliares VW', 2, 1),
(235, '5C0 927 904 C Paso 3', 'Tableros Auxiliares VW', 2, 1),
(236, '5C0 927 904 C Paso 4', 'Tableros Auxiliares VW', 2, 1),
(237, '5C0 927 904 C Paso 4_', 'Tableros Auxiliares VW', 2, 1),
(238, '5C0 927 904 C Paso 5', 'Tableros Auxiliares VW', 2, 1),
(239, '5G0 927 903 AA Paso 1', 'Tableros Auxiliares VW', 2, 1),
(240, '5G0 927 903 AA Paso 2', 'Tableros Auxiliares VW', 2, 1),
(241, '5G0 927 903 AA Paso 3', 'Tableros Auxiliares VW', 2, 1),
(242, '5G0 927 903 AA Paso 4', 'Tableros Auxiliares VW', 2, 1),
(243, '5G0 927 903 AA Paso 5', 'Tableros Auxiliares VW', 2, 1),
(244, '5G0 927 903 AH Paso 1', 'Tableros Auxiliares VW', 2, 1),
(245, '5G0 927 903 AH Paso  2', 'Tableros Auxiliares VW', 2, 1),
(246, '5G0 927 903 AH Paso 3', 'Tableros Auxiliares VW', 2, 1),
(247, '5G0 927 903 AH Paso 4', 'Tableros Auxiliares VW', 2, 1),
(248, '5G0 927 903 AH Paso 5', 'Tableros Auxiliares VW', 2, 1),
(249, '5G0 927 903 AH LAY- OUT', 'Tableros Auxiliares VW', 2, 1),
(250, '5G0 927 903 AH LAY- OUT_', 'Tableros Auxiliares VW', 2, 1),
(251, '5G0 927 903 AH Desforre intermedio Paso 6', 'Tableros Auxiliares VW', 2, 1),
(252, '5G0 927 903 AK Paso 1', 'Tableros Auxiliares VW', 2, 1),
(253, '5G0 927 903 AK Paso 2', 'Tableros Auxiliares VW', 2, 1),
(254, '5G0 927 903 AK Paso 3', 'Tableros Auxiliares VW', 2, 1),
(255, '5G0 927 903 AK Desforre', 'Tableros Auxiliares VW', 2, 1),
(256, '5G0 927 903 S Paso 1', 'Tableros Auxiliares VW', 2, 1),
(257, '5G0 927 903 S Paso 2', 'Tableros Auxiliares VW', 2, 1),
(258, '5G0 927 903 S Paso 3', 'Tableros Auxiliares VW', 2, 1),
(259, '5G0 927 903 S Paso 4', 'Tableros Auxiliares VW', 2, 1),
(260, '5G0 927 903 S Desforre intermedio Paso 5', 'Tableros Auxiliares VW', 2, 1),
(261, '5G0 927 904 AQ Paso 1', 'Tableros Auxiliares VW', 2, 1),
(262, '5G0 927 904 AQ Paso 2', 'Tableros Auxiliares VW', 2, 1),
(263, '5G0 927 904 AQ Paso 3', 'Tableros Auxiliares VW', 2, 1),
(264, '5G0 927 904 AQ Paso 4', 'Tableros Auxiliares VW', 2, 1),
(265, '5G0 927 904 AQ Paso 5', 'Tableros Auxiliares VW', 2, 1),
(266, '5G0 927 904 AR Paso 1', 'Tableros Auxiliares VW', 2, 1),
(267, '5G0 927 904 AR Paso 2 ', 'Tableros Auxiliares VW', 2, 1),
(268, '5G0 927 904 AR Paso 3', 'Tableros Auxiliares VW', 2, 1),
(269, '5G0 927 904 AR Paso 4', 'Tableros Auxiliares VW', 2, 1),
(270, '5G0 927 904 AR Desforre Paso 1', 'Tableros Auxiliares VW', 2, 1),
(271, '5G0 927 904 BB Paso 1', 'Tableros Auxiliares VW', 2, 1),
(272, '5G0 927 904 BB Paso 2', 'Tableros Auxiliares VW', 2, 1),
(273, '5G0 927 904 BB Paso 3', 'Tableros Auxiliares VW', 2, 1),
(274, '5G0 927 904 BB Paso 4', 'Tableros Auxiliares VW', 2, 1),
(275, '5G0 927 904 BB Paso 5', 'Tableros Auxiliares VW', 2, 1),
(276, '561 927 903 A Paso 1', 'Tableros Auxiliares VW', 2, 1),
(277, '561 927 903 A Paso 2', 'Tableros Auxiliares VW', 2, 1),
(278, '561 927 903 A Paso 3', 'Tableros Auxiliares VW', 2, 1),
(279, '561 927 903 A Desforre intermedio Paso 5', 'Tableros Auxiliares VW', 2, 1),
(280, '561 927 903 A Paso 4', 'Tableros Auxiliares VW', 2, 1),
(281, '561 927 903 E Paso 1', 'Tableros Auxiliares VW', 2, 1),
(282, '561 927 903 E Paso 2', 'Tableros Auxiliares VW', 2, 1),
(283, '561 927 903 E Paso 3', 'Tableros Auxiliares VW', 2, 1),
(284, '561 927 903 E Desforre intermedio Paso 1', 'Tableros Auxiliares VW', 2, 1),
(285, '561 927 903 E Desforre final', 'Tableros Auxiliares VW', 2, 1),
(286, '561 927 904 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(287, '561 927 904 Paso 2', 'Tableros Auxiliares VW', 2, 1),
(288, '561 927 904 Paso 3', 'Tableros Auxiliares VW', 2, 1),
(289, '561 927 904 Paso 4', 'Tableros Auxiliares VW', 2, 1),
(290, '561 927 904 A Paso 1', 'Tableros Auxiliares VW', 2, 1),
(291, '561 927 904 A Paso 2', 'Tableros Auxiliares VW', 2, 1),
(292, '561 927 904 A Paso 3', 'Tableros Auxiliares VW', 2, 1),
(293, '561 927 904 A Paso 3_', 'Tableros Auxiliares VW', 2, 1),
(294, '561 927 904 A Paso 4', 'Tableros Auxiliares VW', 2, 1),
(295, '56D 927 904 ABS Paso 1', 'Tableros Auxiliares VW', 2, 1),
(296, '56D 927 904 ABS Paso 2', 'Tableros Auxiliares VW', 2, 1),
(297, '56D 927 904 GDL Paso 3', 'Tableros Auxiliares VW', 2, 1),
(298, '56D 927 904 ABS GDL Paso 4', 'Tableros Auxiliares VW', 2, 1),
(299, '56D 927 904 DESFORRE Paso 5', 'Tableros Auxiliares VW', 2, 1),
(300, '5GD 927 902/D Paso 1', 'Tableros Auxiliares VW', 2, 1),
(301, '5GD 927 902/D Paso 2', 'Tableros Auxiliares VW', 2, 1),
(302, '5GD 927 902 B/F Paso 1', 'Tableros Auxiliares VW', 2, 1),
(303, '5GD 927 902 B/F Paso 2', 'Tableros Auxiliares VW', 2, 1),
(304, '5TA 927 903 E Paso 1', 'Tableros Auxiliares VW', 2, 1),
(305, '5TA 927 903 E Paso 2', 'Tableros Auxiliares VW', 2, 1),
(306, '5TA 927 903 E Paso 3', 'Tableros Auxiliares VW', 2, 1),
(307, '5TA 927 903 E Desforre Final Paso 4', 'Tableros Auxiliares VW', 2, 1),
(308, '5TA 927 903 F Paso 1', 'Tableros Auxiliares VW', 2, 1),
(309, '5TA 927 903 F Paso 2', 'Tableros Auxiliares VW', 2, 1),
(310, '5TA 927 903 F Paso 3', 'Tableros Auxiliares VW', 2, 1),
(311, '5TA 927 903 F Paso 4', 'Tableros Auxiliares VW', 2, 1),
(312, '5TA 927 903 F Paso 4_', 'Tableros Auxiliares VW', 2, 1),
(313, '5TA 927 903 H Paso 1', 'Tableros Auxiliares VW', 2, 1),
(314, '5TA 927 903 H Paso 1_', 'Tableros Auxiliares VW', 2, 1),
(315, '5TA 927 903 H Paso 2', 'Tableros Auxiliares VW', 2, 1),
(316, '5TA 927 903 H Paso 3', 'Tableros Auxiliares VW', 2, 1),
(317, '5TA 927 903 H Paso 4', 'Tableros Auxiliares VW', 2, 1),
(318, '5TA 927 903 H Desforre intermedio Paso 1', 'Tableros Auxiliares VW', 2, 1),
(319, '5TA 927 903 H Layout Paso 1', 'Tableros Auxiliares VW', 2, 1),
(320, '5TA 927 903 K Paso 1', 'Tableros Auxiliares VW', 2, 1),
(321, '5TA 927 903 K Paso 2', 'Tableros Auxiliares VW', 2, 1),
(322, '5TA 927 903 K Paso 3', 'Tableros Auxiliares VW', 2, 1),
(323, '5TA 927 903 K Desforrre intermedio Paso 4', 'Tableros Auxiliares VW', 2, 1),
(324, '5TA 927 903 K Desforre 4', 'Tableros Auxiliares VW', 2, 1),
(325, '5NA 927 902 J Paso 1', 'Tableros Auxiliares VW', 2, 1),
(326, '5NA 927 902 J Paso 2', 'Tableros Auxiliares VW', 2, 1),
(327, '5NA 927 902 J Paso 3', 'Tableros Auxiliares VW', 2, 1),
(328, '5NA 927 902 N Paso 1', 'Tableros Auxiliares VW', 2, 1),
(329, '5NA 927 902 N Paso 2', 'Tableros Auxiliares VW', 2, 1),
(330, '5NA 927 902 N Paso 3', 'Tableros Auxiliares VW', 2, 1),
(331, '8V0 927 902 F/Q Paso 1', 'Tableros Auxiliares VW', 2, 1),
(332, '8V0 927 902 F Paso 2', 'Tableros Auxiliares VW', 2, 1),
(333, '8VO 927 902 F/17A 927 902 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(334, '8V0 927 902 G/T Paso 1', 'Tableros Auxiliares VW', 2, 1),
(335, '8V0 927 902 G/T Paso 2', 'Tableros Auxiliares VW', 2, 1),
(336, '8VO 927 902 G/17A 927 902 B Paso 1', 'Tableros Auxiliares VW', 2, 1),
(337, '80A 972 251 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(338, '80A 972 251 Paso 2', 'Tableros Auxiliares VW', 2, 1),
(339, '80A 972 251 Paso 3', 'Tableros Auxiliares VW', 2, 1),
(340, '80A 972 251 Desforre intermedio Paso 4', 'Tableros Auxiliares VW', 2, 1),
(341, '80A 972 251 LAY OUT', 'Tableros Auxiliares VW', 2, 1),
(342, '80A 972 252 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(343, '80A 972 252 Paso 2', 'Tableros Auxiliares VW', 2, 1),
(344, '80A 972 252 Paso 3', 'Tableros Auxiliares VW', 2, 1),
(345, '80A 972 252 Paso 4', 'Tableros Auxiliares VW', 2, 1),
(346, '80A 972 252 Desforre intermedio Paso 5', 'Tableros Auxiliares VW', 2, 1),
(347, '80A 972 253 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(348, '80A 972 253 Paso 2', 'Tableros Auxiliares VW', 2, 1),
(349, '80A 972 253 Paso 3', 'Tableros Auxiliares VW', 2, 1),
(350, '80A 972 254 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(351, '80A 972 254 Paso 2', 'Tableros Auxiliares VW', 2, 1),
(352, '80A 972 254 Paso 3', 'Tableros Auxiliares VW', 2, 1),
(353, '80A 972 254 Paso 4', 'Tableros Auxiliares VW', 2, 1),
(354, '80A927 927 253/254 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(355, '17A 927 902 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(356, '17A 927 902 Paso 2', 'Tableros Auxiliares VW', 2, 1),
(357, '17A 927 902 A Paso 1', 'Tableros Auxiliares VW', 2, 1),
(358, '17A 927 902 A Paso 2', 'Tableros Auxiliares VW', 2, 1),
(359, '17A 927 902 B Paso 1', 'Tableros Auxiliares VW', 2, 1),
(360, '17A 927 902 B Paso 2', 'Tableros Auxiliares VW', 2, 1),
(361, '17A 927 902 C Paso 1', 'Tableros Auxiliares VW', 2, 1),
(362, '17A 927 902 C Paso 2', 'Tableros Auxiliares VW', 2, 1),
(363, '17A 927 903 A Desforre final Paso 3', 'Tableros Auxiliares VW', 2, 1),
(364, '17A 927 903 A Desforre Intermedio Paso 4', 'Tableros Auxiliares VW', 2, 1),
(365, '17A 927 903 Desforre Final Paso 1', 'Tableros Auxiliares VW', 2, 1),
(366, '17A 927 903 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(367, '17A 927 903 Paso 2', 'Tableros Auxiliares VW', 2, 1),
(368, '17A 927 903 A Paso 1', 'Tableros Auxiliares VW', 2, 1),
(369, '17A 927 903 A Paso 2', 'Tableros Auxiliares VW', 2, 1),
(370, '17A 927 903_A/C Paso 1', 'Tableros Auxiliares VW', 2, 1),
(371, '17A 927 903 C Paso 1', 'Tableros Auxiliares VW', 2, 1),
(372, '17A 927 903 C Paso 2', 'Tableros Auxiliares VW', 2, 1),
(373, '17A 927 903 C Desforre intermedio Paso 3', 'Tableros Auxiliares VW', 2, 1),
(374, '17A 927 903 C Desforre final Paso 4', 'Tableros Auxiliares VW', 2, 1),
(375, '5U0 927 904 Paso 1', 'Tableros Auxiliares VW', 2, 1),
(376, '5U0 927 904 Paso 2', 'Tableros Auxiliares VW', 2, 1),
(377, '5U0 927 904 Paso 3', 'Tableros Auxiliares VW', 2, 1),
(378, '5U0 927 904 Paso 4', 'Tableros Auxiliares VW', 2, 1),
(379, '5U0 927 904 A Paso 1', 'Tableros Auxiliares VW', 2, 1),
(380, '5U0 927 904 A Paso 2', 'Tableros Auxiliares VW', 2, 1),
(381, '5U0 927 904 A Paso 3', 'Tableros Auxiliares VW', 2, 1),
(382, '5U0 927 904 A Paso 4', 'Tableros Auxiliares VW', 2, 1),
(383, '5U0 927 904 A Paso 5', 'Tableros Auxiliares VW', 2, 1),
(384, '5U0 927 904 A Paso 6', 'Tableros Auxiliares VW', 2, 1),
(385, 'A 167 540 53 00 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(386, 'A 167 540 53 00 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(387, 'A 167 540 52 18 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(388, 'A 167 540 52 18 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(389, 'A 167 540 54 00 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(390, 'A 167 540 54 00 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(391, 'A 167 540 18 11 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(392, 'A 167 540 18 11 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(393, 'A 167 540 57 00 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(394, 'A 167 540 57 00 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(395, 'A 167 540 49 18 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(396, 'A 167 540 49 18 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(397, 'A 167 540 58 07 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(398, 'A 167 540 58 07 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(399, 'A 167 540 48 00 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(400, 'A 167 540 48 00 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(401, 'A 167 540 60 20 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(402, 'A 167 540 60 20 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(403, 'A 167 540 47 00 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(404, 'A 167 540 47 00 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(405, 'A 167 540 57 20 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(406, 'A 167 540 57 20 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(407, 'A 167 540 17 11 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(408, 'A 167 540 17 11 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(409, 'A 167 540 58 00 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(410, 'A 167 540 58 00 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(411, 'A 167 540 58 00 - PASO 2 DESFORRE IZQUIERDO_', 'Tableros Auxiliares Daimler', 1, 1),
(412, 'A 167 540 58 20 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(413, 'A 167 540 58 20 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(414, 'A 167 540 51 18 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(415, 'A 167 540 51 18 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(416, 'A 167 540 H0 04 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(417, 'A 167 540 H0 04 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(418, 'A 167 540 56 20 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(419, 'A 167 540 56 20 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(420, 'A 167 540 55 20 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(421, 'A 167 540 55 20 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(422, 'A 167 540 H0 05 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(423, 'A 167 540 H0 05 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(424, 'A 167 540 52 00 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(425, 'A 167 540 52 00 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(426, 'A 167 540 50 18 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(427, 'A 167 540 50 18 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(428, 'A 167 540 57 07 - PASO 1 DESFORRE DERECHO', 'Tableros Auxiliares Daimler', 1, 1),
(429, 'A 167 540 57 07 - PASO 2 DESFORRE IZQUIERDO', 'Tableros Auxiliares Daimler', 1, 1),
(430, 'A 167 540 48 02 / A 167 540 49 02', 'Tableros Auxiliares Daimler', 1, 1),
(431, 'A 167 540 48 02 / A 167 540 49 02_', 'Tableros Auxiliares Daimler', 1, 1),
(432, 'A 167 540 17 11 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(433, 'A 167 540 17 11 PASO 2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(434, 'A 167 540 18 11 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(435, 'A 167 540 18 11 PASO 2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(436, 'A 167 540 47 00 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(437, 'A 167 540 47 00 PASO 2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(438, 'A 167 540 48 00 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(439, 'A 167 540 48 00 PASO 2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(440, 'A 167 540 49 18 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(441, 'A 167 540 49 18 PASO 2', 'Tableros Auxiliares Daimler', 2, 1),
(442, 'A 167 540 50 18 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(443, 'A 167 540 50 18 PASO 2', 'Tableros Auxiliares Daimler', 2, 1),
(444, 'A 167 540 51 18 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(445, 'A 167 540 51 18 PASO 2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(446, 'A 167 540 52 00 PASO 1 y 2', 'Tableros Auxiliares Daimler', 2, 1),
(447, 'A 167 540 52 00 PASO 3 y 4', 'Tableros Auxiliares Daimler', 2, 1),
(448, 'A 167 540 52 18 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(449, 'A 167 540 52 18 PASO 2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(450, 'A 167 540 53 00 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(451, 'A 167 540 53 00 PASO 2', 'Tableros Auxiliares Daimler', 2, 1),
(452, 'A 167 540 54 00 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(453, 'A 167 540 54 00 PASO 2', 'Tableros Auxiliares Daimler', 2, 1),
(454, 'A 167 540 55 20 PASO 1 y 2', 'Tableros Auxiliares Daimler', 2, 1),
(455, 'A 167 540 55 20 PASO 3 y 4', 'Tableros Auxiliares Daimler', 2, 1),
(456, 'A 167 540 55 20 PASO 5', 'Tableros Auxiliares Daimler', 2, 1),
(457, 'A 167 540 56 20 PASO 1 y 2', 'Tableros Auxiliares Daimler', 2, 1),
(458, 'A 167 540 56 20 PASO 3 y 4', 'Tableros Auxiliares Daimler', 2, 1),
(459, 'A 167 540 56 20 PASO 5', 'Tableros Auxiliares Daimler', 2, 1),
(460, 'A 167 540 57 00 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(461, 'A 167 540 57 00 PASO 2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(462, 'A 167 540 57 07 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(463, 'A 167 540 57 07 PASO 2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(464, 'A 167 540 57 20 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(465, 'A 167 540 57 20 PASO 2', 'Tableros Auxiliares Daimler', 2, 1),
(466, 'A 167 540 58 00 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(467, 'A 167 540 58 00 PASO 2  y 3', 'Tableros Auxiliares Daimler', 2, 1),
(468, 'A 167 540 58 07 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(469, 'A 167 540 58 07 PASO 2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(470, 'A 167 540 58 20 PASO 1', 'Tableros Auxiliares Daimler', 2, 1),
(471, 'A 167 540 58 20 PASO 2', 'Tableros Auxiliares Daimler', 2, 1),
(472, 'A 167 540 60 20 PASO 1 y 2', 'Tableros Auxiliares Daimler', 2, 1),
(473, 'A 167 540 60 20 PASO 3  y 4', 'Tableros Auxiliares Daimler', 2, 1),
(474, 'A 167 540 61 20 PASO 1,2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(475, 'A 167 540 62 20 PASO 1,2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(476, 'A 167 540 92 06 PASO 1,2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(477, 'A 167 540 92 06 PASO 4 y 5', 'Tableros Auxiliares Daimler', 2, 1),
(478, 'A 167 540 26 33 PASO 1 y 2', 'Tableros Auxiliares Daimler', 2, 1),
(479, 'A 167 540 26 33 PASO 3 y 4', 'Tableros Auxiliares Daimler', 2, 1),
(480, 'A 167 540 81 42 PASO 1,2 y 3', 'Tableros Auxiliares Daimler', 2, 1),
(481, 'A 167 540 81 42 PASO 4 y 5', 'Tableros Auxiliares Daimler', 2, 1),
(482, 'Cable U64/U65', 'Tableros Auxiliares Daimler', 2, 1),
(483, '1448358-00-B / 1448359-00-B', 'Tableros Auxiliares Tesla', 1, 1),
(484, '1415473-00-B / 1415475-00-B 1415476-00-B / 1415477-00-B', 'Tableros Auxiliares Tesla', 1, 1),
(485, '1448358-00-B / 1448359-00-B 1448362-00-B / 1448363-00-B', 'Tableros Auxiliares Tesla', 1, 1),
(486, '1448358-00-B / 1448359-00-B 1448362-00-B / 1448363-00-B_', 'Tableros Auxiliares Tesla', 1, 1),
(487, '1448358-00-B / 1448359-00-B_', 'Tableros Auxiliares Tesla', 1, 1),
(488, '1448358-00-B / 1448359-00-B 1448362-00-B / 1448363-00-B__', 'Tableros Auxiliares Tesla', 1, 1),
(489, '1448358-00-B', 'Tableros Auxiliares Tesla', 1, 1),
(490, '1448362-00-B', 'Tableros Auxiliares Tesla', 1, 1),
(491, 'Cable U64/U65', 'Tableros Auxiliares Tesla', 1, 1),
(492, '1448358-00-B Paso 1', 'Tableros Auxiliares Tesla', 2, 1),
(493, '1451473-00-B Paso 1', 'Tableros Auxiliares Tesla', 2, 1),
(494, '1451475-00-B Paso 1', 'Tableros Auxiliares Tesla', 2, 1),
(495, '1451476-00-B Paso 1', 'Tableros Auxiliares Tesla', 2, 1),
(496, '1451477-00-B Paso 1', 'Tableros Auxiliares Tesla', 2, 1),
(497, '1448359-00-B Paso 1', 'Tableros Auxiliares Tesla', 2, 1),
(498, '1448359-00-B Paso 2', 'Tableros Auxiliares Tesla', 2, 1),
(499, '1448362-00-B Paso 1', 'Tableros Auxiliares Tesla', 2, 1),
(500, '1448362-00-B Paso 2', 'Tableros Auxiliares Tesla', 2, 1),
(501, '1448363-00-B Paso 1', 'Tableros Auxiliares Tesla', 2, 1),
(502, '1448363-00-B Paso 2', 'Tableros Auxiliares Tesla', 2, 1),
(503, '533', 'Schunk', 1, 1),
(505, '2Q0 927 904 C Paso 1', 'Tableros Auxiliares VW', 2, 1),
(506, '2Q0 927 904 E Y C Paso 3', 'Tableros Auxiliares VW', 2, 1),
(507, '17A 927 902 C Desforre', 'Tableros Auxiliares VW', 2, 1),
(508, '2GA 927 902 H Paso 1', 'Tableros Auxiliares VW', 2, 1),
(509, '2GA 927 902 H Paso 2', 'Tableros Auxiliares VW', 2, 1),
(510, '2GA 927 902 H Paso 3', 'Tableros Auxiliares VW', 2, 1),
(511, '2GA 927 902 F Paso 1', 'Tableros Auxiliares VW', 2, 1),
(512, '2GA 927 902 F Paso 2', 'Tableros Auxiliares VW', 2, 1),
(513, '2GA 927 902 F Paso 3', 'Tableros Auxiliares VW', 2, 1),
(514, '5TA 927 903 F Paso 1', 'Tableros Auxiliares VW', 2, 1),
(515, '2H0 927 903 J/F Paso 1', 'Tableros Auxiliares VW', 2, 1),
(516, '2H3 927 903 D Paso 1', 'Tableros Auxiliares VW', 2, 1),
(517, '2H3 927 903 F Paso 1', 'Tableros Auxiliares VW', 2, 1),
(518, '2H3 927 903 C Paso 1', 'Tableros Auxiliares VW', 2, 1),
(519, '2H4 927 903 G Paso 1', 'Tableros Auxiliares VW', 2, 1),
(520, '2H4 927 903 F/H Paso 1', 'Tableros Auxiliares VW', 2, 1),
(521, '2H0 927 904 N Paso 1', 'Tableros Auxiliares VW', 2, 1),
(522, '2H0 927 904 N corte de tubo', 'Tableros Auxiliares VW', 2, 1),
(523, '2H0 927 904 M Paso 1', 'Tableros Auxiliares VW', 2, 1),
(524, '2H0 927 904 M', 'Tableros Auxiliares VW', 3, 1),
(525, '2H0 927 904 M corte de tubo', 'Tableros Auxiliares VW', 2, 1),
(526, '2H0 927 904 K', 'Tableros Auxiliares VW', 3, 1),
(527, '2H0 927 904 K Paso 1', 'Tableros Auxiliares VW', 2, 1),
(528, '2H0 927 904 K corte de tubo', 'Tableros Auxiliares VW', 2, 1),
(529, '2H0 927 904 G', 'Tableros Auxiliares VW', 3, 1),
(530, '2H0 927 904 G Paso 1', 'Tableros Auxiliares VW', 2, 1),
(531, '2H0 927 904 G corte de tubo', 'Tableros Auxiliares VW', 2, 1),
(532, '2H0 927 903 J', 'Tableros Auxiliares VW', 3, 1),
(533, '2H3 927 903 E', 'Tableros Auxiliares VW', 3, 1),
(534, '2H4 927 903 F', 'Tableros Auxiliares VW', 3, 1),
(535, '2H4 927 903 H', 'Tableros Auxiliares VW', 3, 1),
(536, '2H4 927 903 G', 'Tableros Auxiliares VW', 3, 1),
(537, '2H0 927 903 C', 'Tableros Auxiliares VW', 3, 1),
(538, 'E26520200', 'Tableros Auxiliares VW', 3, 1),
(539, '2H0 927 904 N', 'Tableros Auxiliares VW', 3, 1),
(540, '2H3 927 903 D', 'Tableros Auxiliares VW', 3, 1),
(541, '534', 'Schunk', 1, 1),
(543, '15', 'TSK', 3, 1),
(544, 'PT00030470', 'Tableros Dimensionales Rivian', 3, 1),
(545, 'PT00048098', 'Tableros Dimensionales Rivian', 3, 1),
(546, 'PT00030469', 'Tableros Dimensionales Rivian', 3, 1),
(547, '537', 'Schäfer 2002', 1, 1),
(548, 'Lay-out TS-WSS-EPB PT00000569', 'Tableros Auxiliares Rivian', 1, 1),
(549, 'Lay-out TS-ADS PT00000588', 'Tableros Auxiliares Rivian', 1, 1),
(550, 'Lay-out PT00030469/PT00030470', 'Tableros Auxiliares Rivian', 1, 1),
(551, 'Lay-out PT00000588/PT00000569', 'Tableros Auxiliares Rivian', 1, 1),
(552, 'Layout TS-ADS PT00000569', 'Tableros Auxiliares Rivian', 1, 1),
(553, 'PT00000588 Paso 5/5', 'Tableros Auxiliares Rivian', 1, 1),
(554, 'PT00000569 Paso 5/5', 'Tableros Auxiliares Rivian', 1, 1),
(555, 'Desforre TS-ADS PT00000569', 'Tableros Auxiliares Rivian', 1, 1),
(556, 'Desforre TS-ADS PT00000588', 'Tableros Auxiliares Rivian', 1, 1),
(557, '9P1 927 909 B (PT00030470/PT00030469)', 'Tableros Auxiliares Rivian', 2, 1),
(558, 'Board Drawing PT0004898/PT00048097', 'Tableros Auxiliares Rivian', 2, 1),
(559, 'Ramal TS-WSS-EPB PT00000588', 'Tableros Auxiliares Rivian', 2, 1),
(560, 'Ramal TS-ADS PT00000569', 'Tableros Auxiliares Rivian', 2, 1),
(561, 'Ramal TS-ADS PT00000588', 'Tableros Auxiliares Rivian', 2, 1),
(562, 'Ramal TS-WSS-EPB PT00000569', 'Tableros Auxiliares Rivian', 2, 1),
(563, 'PT00030470/PT00030469 Paso 1/3', 'Tableros Auxiliares Rivian', 2, 1),
(564, 'PT00030470/PT00030469 Paso 2/3', 'Tableros Auxiliares Rivian', 2, 1),
(565, 'PT00030470/PT00030469 Paso 3/3', 'Tableros Auxiliares Rivian', 2, 1),
(566, 'PT00000588/PT00000569 Paso 1/5', 'Tableros Auxiliares Rivian', 2, 1),
(567, 'PT00000588/PT00000569 Paso 1/5', 'Tableros Auxiliares Rivian', 2, 1),
(568, 'PT00000588/PT00000569 Paso 2/5', 'Tableros Auxiliares Rivian', 2, 1),
(569, 'PT00000588/PT00000569 Paso 2/5_1', 'Tableros Auxiliares Rivian', 2, 1),
(570, 'PT00000569 Paso 3/5', 'Tableros Auxiliares Rivian', 2, 1),
(571, 'PT00000569 Paso 3/5_1', 'Tableros Auxiliares Rivian', 2, 1),
(572, 'PT00000588 Paso 3/5', 'Tableros Auxiliares Rivian', 2, 1),
(573, 'PT00000569 Paso 4/5', 'Tableros Auxiliares Rivian', 2, 1),
(574, 'PT00000588 Paso 4/5', 'Tableros Auxiliares Rivian', 2, 1),
(575, 'PT00013307 C Ground Strap', 'Tableros Auxiliares Rivian', 1, 1),
(576, 'PT00048097', 'Tableros Dimensionales Rivian', 3, 1),
(577, 'PT0004898/PT00048097 Paso 1-2', 'Tableros Auxiliares Rivian', 2, 1),
(578, 'PT0004898/PT00048097 Paso 1/2', 'Tableros Auxiliares Rivian', 2, 1),
(579, '538', 'Schäfer 2002', 1, 1),
(580, '2H0 927 903 J/F Paso 1_1', 'Tableros Auxiliares VW', 2, 1),
(581, '17A 927 902 C Paso 3', 'Tableros Auxiliares VW', 2, 1),
(582, '17A 927 903 C Paso 3', 'Tableros Auxiliares VW', 2, 1),
(583, '8V0 927 902 F/G Paso 2', 'Tableros Auxiliares VW', 2, 1),
(584, '47', 'Arburg 375', 2, 1),
(585, '48', 'Arburg 375', 2, 1),
(586, '16', 'EMDEP', 3, 1),
(587, '46', 'Arburg 420', 2, 1),
(588, '45', 'Arburg 420', 2, 1),
(591, '539', 'Expander', 1, 1),
(592, '540', 'Schäfer 2002', 1, 1),
(593, '508', 'Falling Parts', 3, 1),
(594, '509', 'Falling Parts', 3, 1),
(595, '536', 'Unistrip', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_prima`
--

CREATE TABLE `materia_prima` (
  `idMateriaPrima` int(11) NOT NULL,
  `descripcion_materiaprima` varchar(100) NOT NULL,
  `nosap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materia_prima`
--

INSERT INTO `materia_prima` (`idMateriaPrima`, `descripcion_materiaprima`, `nosap`) VALUES
(2, 'Terminal', '222'),
(3, 'Sello', '3333'),
(4, 'Cable U65', '187097'),
(5, 'Cable 1101 mm', '190548');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `idOrden` int(11) NOT NULL,
  `numeroOrden` varchar(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idViajera` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`idOrden`, `numeroOrden`, `fecha`, `cantidad`, `idViajera`, `idUsuario`) VALUES
(1, '1', '2021-11-19 13:10:22', 100, 15, 24),
(44, '2', '2021-11-19 13:22:09', 1, 13, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_etapas`
--

CREATE TABLE `ordenes_etapas` (
  `idOrdenEtapa` int(11) NOT NULL,
  `idOrden` int(11) NOT NULL,
  `idEtapa` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `idProyecto` int(11) NOT NULL,
  `descripcion_proyecto` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`idProyecto`, `descripcion_proyecto`) VALUES
(2, 'Daimler'),
(3, 'BMW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `permisos` int(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `noEmpleado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `clave`, `permisos`, `nombre`, `apellido_paterno`, `apellido_materno`, `noEmpleado`) VALUES
(1, 'w4mpd', 'kikinalba', 1, '-', '-', '-', '1'),
(3, 'julio jimenez', '1110', 1, 'Julio', 'Jimenez', '-', '1110'),
(20, 'karla vigil', '1459', 1, 'Karla Angelina', 'Vigil', 'Pérez', '1459'),
(24, '1', '1', 2, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_etapas`
--

CREATE TABLE `usuarios_etapas` (
  `idUsuariosEtapas` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEtapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_etapas`
--

INSERT INTO `usuarios_etapas` (`idUsuariosEtapas`, `idUsuario`, `idEtapa`) VALUES
(32, 24, 1),
(33, 24, 3),
(34, 24, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajeras`
--

CREATE TABLE `viajeras` (
  `idViajera` int(11) NOT NULL,
  `sap` varchar(50) NOT NULL,
  `variant` varchar(50) NOT NULL,
  `standard` int(11) NOT NULL,
  `idArea` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `viajeras`
--

INSERT INTO `viajeras` (`idViajera`, `sap`, `variant`, `standard`, `idArea`, `idProyecto`) VALUES
(12, '12345', '123456', 100, 1, 2),
(13, '186567', 'A 167 540 58 00', 50, 1, 2),
(15, '3', '3', 3, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajeras_etapas`
--

CREATE TABLE `viajeras_etapas` (
  `idViajeraEtapa` int(11) NOT NULL,
  `idViajera` int(11) NOT NULL,
  `idEtapa` int(11) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `viajeras_etapas`
--

INSERT INTO `viajeras_etapas` (`idViajeraEtapa`, `idViajera`, `idEtapa`, `orden`) VALUES
(33, 13, 3, 1),
(34, 13, 4, 2),
(42, 12, 1, 1),
(43, 12, 3, 2),
(44, 12, 4, 3),
(45, 15, 1, 1),
(46, 15, 3, 2),
(47, 15, 4, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`idArea`);

--
-- Indices de la tabla `datosempresa`
--
ALTER TABLE `datosempresa`
  ADD PRIMARY KEY (`idEmpresa`);

--
-- Indices de la tabla `etapas`
--
ALTER TABLE `etapas`
  ADD PRIMARY KEY (`idEtapa`);

--
-- Indices de la tabla `etapas_materiaprima`
--
ALTER TABLE `etapas_materiaprima`
  ADD PRIMARY KEY (`idEtapaMateriaPrima`),
  ADD KEY `idEtapa` (`idEtapa`),
  ADD KEY `idMateriaPrima` (`idMateriaPrima`);

--
-- Indices de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`idMaquina`),
  ADD KEY `idArea` (`idArea`),
  ADD KEY `idArea_2` (`idArea`),
  ADD KEY `idEtapa` (`idEtapa`),
  ADD KEY `idArea_3` (`idArea`);

--
-- Indices de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`idMateriaPrima`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`idOrden`),
  ADD UNIQUE KEY `numeroOrden` (`numeroOrden`),
  ADD KEY `idViajera` (`idViajera`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `ordenes_etapas`
--
ALTER TABLE `ordenes_etapas`
  ADD PRIMARY KEY (`idOrdenEtapa`),
  ADD KEY `idOrden` (`idOrden`),
  ADD KEY `idEtapa` (`idEtapa`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`idProyecto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuarios_etapas`
--
ALTER TABLE `usuarios_etapas`
  ADD PRIMARY KEY (`idUsuariosEtapas`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEtapa` (`idEtapa`);

--
-- Indices de la tabla `viajeras`
--
ALTER TABLE `viajeras`
  ADD PRIMARY KEY (`idViajera`),
  ADD KEY `idArea` (`idArea`),
  ADD KEY `idProyecto` (`idProyecto`);

--
-- Indices de la tabla `viajeras_etapas`
--
ALTER TABLE `viajeras_etapas`
  ADD PRIMARY KEY (`idViajeraEtapa`),
  ADD KEY `idViajera` (`idViajera`),
  ADD KEY `idEtapa` (`idEtapa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `datosempresa`
--
ALTER TABLE `datosempresa`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `etapas`
--
ALTER TABLE `etapas`
  MODIFY `idEtapa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `etapas_materiaprima`
--
ALTER TABLE `etapas_materiaprima`
  MODIFY `idEtapaMateriaPrima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `idMaquina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=597;

--
-- AUTO_INCREMENT de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `idMateriaPrima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `idOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `ordenes_etapas`
--
ALTER TABLE `ordenes_etapas`
  MODIFY `idOrdenEtapa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `idProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuarios_etapas`
--
ALTER TABLE `usuarios_etapas`
  MODIFY `idUsuariosEtapas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `viajeras`
--
ALTER TABLE `viajeras`
  MODIFY `idViajera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `viajeras_etapas`
--
ALTER TABLE `viajeras_etapas`
  MODIFY `idViajeraEtapa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `etapas_materiaprima`
--
ALTER TABLE `etapas_materiaprima`
  ADD CONSTRAINT `etapas_materiaprima_ibfk_1` FOREIGN KEY (`idEtapa`) REFERENCES `etapas` (`idEtapa`),
  ADD CONSTRAINT `etapas_materiaprima_ibfk_2` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materia_prima` (`idMateriaPrima`);

--
-- Filtros para la tabla `maquinas`
--
ALTER TABLE `maquinas`
  ADD CONSTRAINT `maquinas_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `areas` (`idArea`),
  ADD CONSTRAINT `maquinas_ibfk_2` FOREIGN KEY (`idEtapa`) REFERENCES `etapas` (`idEtapa`);

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`idViajera`) REFERENCES `viajeras` (`idViajera`),
  ADD CONSTRAINT `ordenes_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `ordenes_etapas`
--
ALTER TABLE `ordenes_etapas`
  ADD CONSTRAINT `ordenes_etapas_ibfk_1` FOREIGN KEY (`idEtapa`) REFERENCES `etapas` (`idEtapa`),
  ADD CONSTRAINT `ordenes_etapas_ibfk_2` FOREIGN KEY (`idOrden`) REFERENCES `ordenes` (`idOrden`);

--
-- Filtros para la tabla `usuarios_etapas`
--
ALTER TABLE `usuarios_etapas`
  ADD CONSTRAINT `usuarios_etapas_ibfk_1` FOREIGN KEY (`idEtapa`) REFERENCES `etapas` (`idEtapa`),
  ADD CONSTRAINT `usuarios_etapas_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `viajeras`
--
ALTER TABLE `viajeras`
  ADD CONSTRAINT `viajeras_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `areas` (`idArea`),
  ADD CONSTRAINT `viajeras_ibfk_2` FOREIGN KEY (`idProyecto`) REFERENCES `proyectos` (`idProyecto`);

--
-- Filtros para la tabla `viajeras_etapas`
--
ALTER TABLE `viajeras_etapas`
  ADD CONSTRAINT `viajeras_etapas_ibfk_1` FOREIGN KEY (`idViajera`) REFERENCES `viajeras` (`idViajera`),
  ADD CONSTRAINT `viajeras_etapas_ibfk_2` FOREIGN KEY (`idEtapa`) REFERENCES `etapas` (`idEtapa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
