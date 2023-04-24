-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-04-2023 a las 09:22:56
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_usco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idcita` int NOT NULL,
  `id_consultorio` int DEFAULT NULL,
  `id_paciente` int DEFAULT NULL,
  `id_medico` int DEFAULT NULL,
  `fecha_hora` datetime NOT NULL,
  `anotacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `diagnostico` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_estado` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idcita`, `id_consultorio`, `id_paciente`, `id_medico`, `fecha_hora`, `anotacion`, `diagnostico`, `id_estado`) VALUES
(4, 13, 10, 8, '2023-04-24 08:30:00', '', 'thththt', 3),
(5, 1, 9, 8, '2023-04-24 08:30:00', '', 'No se serene, y tome mucho limon', 3),
(6, 1, 7, 8, '2023-04-24 08:30:00', 'No llego', 'Tiene gripa', 3),
(7, 1, 10, 8, '2023-04-24 11:00:00', 'No me gusta el doctor', NULL, 2),
(8, 5, 8, 10, '2023-04-23 13:30:00', NULL, NULL, 1),
(9, 5, 9, 8, '2023-04-24 02:00:00', NULL, NULL, 1),
(10, 15, 9, 10, '2023-04-26 13:00:00', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_medicamento`
--

CREATE TABLE `cita_medicamento` (
  `idcitamed` int NOT NULL,
  `id_cita` int NOT NULL,
  `id_medicamento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita_medicamento`
--

INSERT INTO `cita_medicamento` (`idcitamed`, `id_cita`, `id_medicamento`) VALUES
(8, 4, 1),
(11, 4, 1),
(9, 4, 2),
(10, 4, 2),
(12, 5, 1),
(13, 5, 4),
(14, 6, 1),
(15, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `idcon` int NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_mun` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`idcon`, `direccion`, `id_mun`) VALUES
(1, 'cll1 # 6-34', 596),
(2, 'Cra 4 - 5', 596),
(5, 'cll 3 4545', 751),
(6, 'cll 3', 751),
(7, 'cll 3', 751),
(8, 'cll 3', 751),
(9, 'cll 3', 751),
(13, 'cra 5 # 6-54', 633),
(14, 'cra 5 # 6-54', 633),
(15, 'cra 10', 633),
(16, 'cra 10', 633),
(17, 'cll 12A', 671),
(18, '34', 879),
(19, 'cll 3 #12-4', 786),
(22, 'cll 2A', 596);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `iddept` int NOT NULL,
  `nombre_dept` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`iddept`, `nombre_dept`) VALUES
(5, 'ANTIOQUIA'),
(8, 'ATLÁNTICO'),
(11, 'BOGOTÁ, D.C.'),
(13, 'BOLÍVAR'),
(15, 'BOYACÁ'),
(17, 'CALDAS'),
(18, 'CAQUETÁ'),
(19, 'CAUCA'),
(20, 'CESAR'),
(23, 'CÓRDOBA'),
(25, 'CUNDINAMARCA'),
(27, 'CHOCÓ'),
(41, 'HUILA'),
(44, 'LA GUAJIRA'),
(47, 'MAGDALENA'),
(50, 'META'),
(52, 'NARIÑO'),
(54, 'NORTE DE SANTANDER'),
(63, 'QUINDIO'),
(66, 'RISARALDA'),
(68, 'SANTANDER'),
(70, 'SUCRE'),
(73, 'TOLIMA'),
(76, 'VALLE DEL CAUCA'),
(81, 'ARAUCA'),
(85, 'CASANARE'),
(86, 'PUTUMAYO'),
(88, 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA'),
(91, 'AMAZONAS'),
(94, 'GUAINÍA'),
(95, 'GUAVIARE'),
(97, 'VAUPÉS'),
(99, 'VICHADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idestado` int NOT NULL,
  `nombre_estado` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idestado`, `nombre_estado`) VALUES
(1, 'Activa'),
(2, 'Cancelada'),
(3, 'Efectuada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `idmed` int NOT NULL,
  `nombre_medicamento` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`idmed`, `nombre_medicamento`) VALUES
(1, 'acetaminofén'),
(2, 'diclofenaco'),
(3, 'ibuprofeno'),
(4, 'naproxeno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `idmun` int NOT NULL,
  `nombre_mun` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_dept` int NOT NULL,
  `estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`idmun`, `nombre_mun`, `id_dept`, `estado`) VALUES
(1, 'Abriaquí', 5, 1),
(2, 'Acacías', 50, 1),
(3, 'Acandí', 27, 1),
(4, 'Acevedo', 41, 1),
(5, 'Achí', 13, 1),
(6, 'Agrado', 41, 1),
(7, 'Agua de Dios', 25, 1),
(8, 'Aguachica', 20, 1),
(9, 'Aguada', 68, 1),
(10, 'Aguadas', 17, 1),
(11, 'Aguazul', 85, 1),
(12, 'Agustín Codazzi', 20, 1),
(13, 'Aipe', 41, 1),
(14, 'Albania', 18, 1),
(15, 'Albania', 44, 1),
(16, 'Albania', 68, 1),
(17, 'Albán', 25, 1),
(18, 'Albán (San José)', 52, 1),
(19, 'Alcalá', 76, 1),
(20, 'Alejandria', 5, 1),
(21, 'Algarrobo', 47, 1),
(22, 'Algeciras', 41, 1),
(23, 'Almaguer', 19, 1),
(24, 'Almeida', 15, 1),
(25, 'Alpujarra', 73, 1),
(26, 'Altamira', 41, 1),
(27, 'Alto Baudó (Pie de Pato)', 27, 1),
(28, 'Altos del Rosario', 13, 1),
(29, 'Alvarado', 73, 1),
(30, 'Amagá', 5, 1),
(31, 'Amalfi', 5, 1),
(32, 'Ambalema', 73, 1),
(33, 'Anapoima', 25, 1),
(34, 'Ancuya', 52, 1),
(35, 'Andalucía', 76, 1),
(36, 'Andes', 5, 1),
(37, 'Angelópolis', 5, 1),
(38, 'Angostura', 5, 1),
(39, 'Anolaima', 25, 1),
(40, 'Anorí', 5, 1),
(41, 'Anserma', 17, 1),
(42, 'Ansermanuevo', 76, 1),
(43, 'Anzoátegui', 73, 1),
(44, 'Anzá', 5, 1),
(45, 'Apartadó', 5, 1),
(46, 'Apulo', 25, 1),
(47, 'Apía', 66, 1),
(48, 'Aquitania', 15, 1),
(49, 'Aracataca', 47, 1),
(50, 'Aranzazu', 17, 1),
(51, 'Aratoca', 68, 1),
(52, 'Arauca', 81, 1),
(53, 'Arauquita', 81, 1),
(54, 'Arbeláez', 25, 1),
(55, 'Arboleda (Berruecos)', 52, 1),
(56, 'Arboledas', 54, 1),
(57, 'Arboletes', 5, 1),
(58, 'Arcabuco', 15, 1),
(59, 'Arenal', 13, 1),
(60, 'Argelia', 5, 1),
(61, 'Argelia', 19, 1),
(62, 'Argelia', 76, 1),
(63, 'Ariguaní (El Difícil)', 47, 1),
(64, 'Arjona', 13, 1),
(65, 'Armenia', 5, 1),
(66, 'Armenia', 63, 1),
(67, 'Armero (Guayabal)', 73, 1),
(68, 'Arroyohondo', 13, 1),
(69, 'Astrea', 20, 1),
(70, 'Ataco', 73, 1),
(71, 'Atrato (Yuto)', 27, 1),
(72, 'Ayapel', 23, 1),
(73, 'Bagadó', 27, 1),
(74, 'Bahía Solano (Mútis)', 27, 1),
(75, 'Bajo Baudó (Pizarro)', 27, 1),
(76, 'Balboa', 19, 1),
(77, 'Balboa', 66, 1),
(78, 'Baranoa', 8, 1),
(79, 'Baraya', 41, 1),
(80, 'Barbacoas', 52, 1),
(81, 'Barbosa', 5, 1),
(82, 'Barbosa', 68, 1),
(83, 'Barichara', 68, 1),
(84, 'Barranca de Upía', 50, 1),
(85, 'Barrancabermeja', 68, 1),
(86, 'Barrancas', 44, 1),
(87, 'Barranco de Loba', 13, 1),
(88, 'Barranquilla', 8, 1),
(89, 'Becerríl', 20, 1),
(90, 'Belalcázar', 17, 1),
(91, 'Bello', 5, 1),
(92, 'Belmira', 5, 1),
(93, 'Beltrán', 25, 1),
(94, 'Belén', 15, 1),
(95, 'Belén', 52, 1),
(96, 'Belén de Bajirá', 27, 1),
(97, 'Belén de Umbría', 66, 1),
(98, 'Belén de los Andaquíes', 18, 1),
(99, 'Berbeo', 15, 1),
(100, 'Betania', 5, 1),
(101, 'Beteitiva', 15, 1),
(102, 'Betulia', 5, 1),
(103, 'Betulia', 68, 1),
(104, 'Bituima', 25, 1),
(105, 'Boavita', 15, 1),
(106, 'Bochalema', 54, 1),
(107, 'Bogotá D.C.', 11, 1),
(108, 'Bojacá', 25, 1),
(109, 'Bojayá (Bellavista)', 27, 1),
(110, 'Bolívar', 5, 1),
(111, 'Bolívar', 19, 1),
(112, 'Bolívar', 68, 1),
(113, 'Bolívar', 76, 1),
(114, 'Bosconia', 20, 1),
(115, 'Boyacá', 15, 1),
(116, 'Briceño', 5, 1),
(117, 'Briceño', 15, 1),
(118, 'Bucaramanga', 68, 1),
(119, 'Bucarasica', 54, 1),
(120, 'Buenaventura', 76, 1),
(121, 'Buenavista', 15, 1),
(122, 'Buenavista', 23, 1),
(123, 'Buenavista', 63, 1),
(124, 'Buenavista', 70, 1),
(125, 'Buenos Aires', 19, 1),
(126, 'Buesaco', 52, 1),
(127, 'Buga', 76, 1),
(128, 'Bugalagrande', 76, 1),
(129, 'Burítica', 5, 1),
(130, 'Busbanza', 15, 1),
(131, 'Cabrera', 25, 1),
(132, 'Cabrera', 68, 1),
(133, 'Cabuyaro', 50, 1),
(134, 'Cachipay', 25, 1),
(135, 'Caicedo', 5, 1),
(136, 'Caicedonia', 76, 1),
(137, 'Caimito', 70, 1),
(138, 'Cajamarca', 73, 1),
(139, 'Cajibío', 19, 1),
(140, 'Cajicá', 25, 1),
(141, 'Calamar', 13, 1),
(142, 'Calamar', 95, 1),
(143, 'Calarcá', 63, 1),
(144, 'Caldas', 5, 1),
(145, 'Caldas', 15, 1),
(146, 'Caldono', 19, 1),
(147, 'California', 68, 1),
(148, 'Calima (Darién)', 76, 1),
(149, 'Caloto', 19, 1),
(150, 'Calí', 76, 1),
(151, 'Campamento', 5, 1),
(152, 'Campo de la Cruz', 8, 1),
(153, 'Campoalegre', 41, 1),
(154, 'Campohermoso', 15, 1),
(155, 'Canalete', 23, 1),
(156, 'Candelaria', 8, 1),
(157, 'Candelaria', 76, 1),
(158, 'Cantagallo', 13, 1),
(159, 'Cantón de San Pablo', 27, 1),
(160, 'Caparrapí', 25, 1),
(161, 'Capitanejo', 68, 1),
(162, 'Caracolí', 5, 1),
(163, 'Caramanta', 5, 1),
(164, 'Carcasí', 68, 1),
(165, 'Carepa', 5, 1),
(166, 'Carmen de Apicalá', 73, 1),
(167, 'Carmen de Carupa', 25, 1),
(168, 'Carmen de Viboral', 5, 1),
(169, 'Carmen del Darién (CURBARADÓ)', 27, 1),
(170, 'Carolina', 5, 1),
(171, 'Cartagena', 13, 1),
(172, 'Cartagena del Chairá', 18, 1),
(173, 'Cartago', 76, 1),
(174, 'Carurú', 97, 1),
(175, 'Casabianca', 73, 1),
(176, 'Castilla la Nueva', 50, 1),
(177, 'Caucasia', 5, 1),
(178, 'Cañasgordas', 5, 1),
(179, 'Cepita', 68, 1),
(180, 'Cereté', 23, 1),
(181, 'Cerinza', 15, 1),
(182, 'Cerrito', 68, 1),
(183, 'Cerro San Antonio', 47, 1),
(184, 'Chachaguí', 52, 1),
(185, 'Chaguaní', 25, 1),
(186, 'Chalán', 70, 1),
(187, 'Chaparral', 73, 1),
(188, 'Charalá', 68, 1),
(189, 'Charta', 68, 1),
(190, 'Chigorodó', 5, 1),
(191, 'Chima', 68, 1),
(192, 'Chimichagua', 20, 1),
(193, 'Chimá', 23, 1),
(194, 'Chinavita', 15, 1),
(195, 'Chinchiná', 17, 1),
(196, 'Chinácota', 54, 1),
(197, 'Chinú', 23, 1),
(198, 'Chipaque', 25, 1),
(199, 'Chipatá', 68, 1),
(200, 'Chiquinquirá', 15, 1),
(201, 'Chiriguaná', 20, 1),
(202, 'Chiscas', 15, 1),
(203, 'Chita', 15, 1),
(204, 'Chitagá', 54, 1),
(205, 'Chitaraque', 15, 1),
(206, 'Chivatá', 15, 1),
(207, 'Chivolo', 47, 1),
(208, 'Choachí', 25, 1),
(209, 'Chocontá', 25, 1),
(210, 'Chámeza', 85, 1),
(211, 'Chía', 25, 1),
(212, 'Chíquiza', 15, 1),
(213, 'Chívor', 15, 1),
(214, 'Cicuco', 13, 1),
(215, 'Cimitarra', 68, 1),
(216, 'Circasia', 63, 1),
(217, 'Cisneros', 5, 1),
(218, 'Ciénaga', 15, 1),
(219, 'Ciénaga', 47, 1),
(220, 'Ciénaga de Oro', 23, 1),
(221, 'Clemencia', 13, 1),
(222, 'Cocorná', 5, 1),
(223, 'Coello', 73, 1),
(224, 'Cogua', 25, 1),
(225, 'Colombia', 41, 1),
(226, 'Colosó (Ricaurte)', 70, 1),
(227, 'Colón', 86, 1),
(228, 'Colón (Génova)', 52, 1),
(229, 'Concepción', 5, 1),
(230, 'Concepción', 68, 1),
(231, 'Concordia', 5, 1),
(232, 'Concordia', 47, 1),
(233, 'Condoto', 27, 1),
(234, 'Confines', 68, 1),
(235, 'Consaca', 52, 1),
(236, 'Contadero', 52, 1),
(237, 'Contratación', 68, 1),
(238, 'Convención', 54, 1),
(239, 'Copacabana', 5, 1),
(240, 'Coper', 15, 1),
(241, 'Cordobá', 63, 1),
(242, 'Corinto', 19, 1),
(243, 'Coromoro', 68, 1),
(244, 'Corozal', 70, 1),
(245, 'Corrales', 15, 1),
(246, 'Cota', 25, 1),
(247, 'Cotorra', 23, 1),
(248, 'Covarachía', 15, 1),
(249, 'Coveñas', 70, 1),
(250, 'Coyaima', 73, 1),
(251, 'Cravo Norte', 81, 1),
(252, 'Cuaspud (Carlosama)', 52, 1),
(253, 'Cubarral', 50, 1),
(254, 'Cubará', 15, 1),
(255, 'Cucaita', 15, 1),
(256, 'Cucunubá', 25, 1),
(257, 'Cucutilla', 54, 1),
(258, 'Cuitiva', 15, 1),
(259, 'Cumaral', 50, 1),
(260, 'Cumaribo', 99, 1),
(261, 'Cumbal', 52, 1),
(262, 'Cumbitara', 52, 1),
(263, 'Cunday', 73, 1),
(264, 'Curillo', 18, 1),
(265, 'Curití', 68, 1),
(266, 'Curumaní', 20, 1),
(267, 'Cáceres', 5, 1),
(268, 'Cáchira', 54, 1),
(269, 'Cácota', 54, 1),
(270, 'Cáqueza', 25, 1),
(271, 'Cértegui', 27, 1),
(272, 'Cómbita', 15, 1),
(273, 'Córdoba', 13, 1),
(274, 'Córdoba', 52, 1),
(275, 'Cúcuta', 54, 1),
(276, 'Dabeiba', 5, 1),
(277, 'Dagua', 76, 1),
(278, 'Dibulla', 44, 1),
(279, 'Distracción', 44, 1),
(280, 'Dolores', 73, 1),
(281, 'Don Matías', 5, 1),
(282, 'Dos Quebradas', 66, 1),
(283, 'Duitama', 15, 1),
(284, 'Durania', 54, 1),
(285, 'Ebéjico', 5, 1),
(286, 'El Bagre', 5, 1),
(287, 'El Banco', 47, 1),
(288, 'El Cairo', 76, 1),
(289, 'El Calvario', 50, 1),
(290, 'El Carmen', 54, 1),
(291, 'El Carmen', 68, 1),
(292, 'El Carmen de Atrato', 27, 1),
(293, 'El Carmen de Bolívar', 13, 1),
(294, 'El Castillo', 50, 1),
(295, 'El Cerrito', 76, 1),
(296, 'El Charco', 52, 1),
(297, 'El Cocuy', 15, 1),
(298, 'El Colegio', 25, 1),
(299, 'El Copey', 20, 1),
(300, 'El Doncello', 18, 1),
(301, 'El Dorado', 50, 1),
(302, 'El Dovio', 76, 1),
(303, 'El Espino', 15, 1),
(304, 'El Guacamayo', 68, 1),
(305, 'El Guamo', 13, 1),
(306, 'El Molino', 44, 1),
(307, 'El Paso', 20, 1),
(308, 'El Paujil', 18, 1),
(309, 'El Peñol', 52, 1),
(310, 'El Peñon', 13, 1),
(311, 'El Peñon', 68, 1),
(312, 'El Peñón', 25, 1),
(313, 'El Piñon', 47, 1),
(314, 'El Playón', 68, 1),
(315, 'El Retorno', 95, 1),
(316, 'El Retén', 47, 1),
(317, 'El Roble', 70, 1),
(318, 'El Rosal', 25, 1),
(319, 'El Rosario', 52, 1),
(320, 'El Tablón de Gómez', 52, 1),
(321, 'El Tambo', 19, 1),
(322, 'El Tambo', 52, 1),
(323, 'El Tarra', 54, 1),
(324, 'El Zulia', 54, 1),
(325, 'El Águila', 76, 1),
(326, 'Elías', 41, 1),
(327, 'Encino', 68, 1),
(328, 'Enciso', 68, 1),
(329, 'Entrerríos', 5, 1),
(330, 'Envigado', 5, 1),
(331, 'Espinal', 73, 1),
(332, 'Facatativá', 25, 1),
(333, 'Falan', 73, 1),
(334, 'Filadelfia', 17, 1),
(335, 'Filandia', 63, 1),
(336, 'Firavitoba', 15, 1),
(337, 'Flandes', 73, 1),
(338, 'Florencia', 18, 1),
(339, 'Florencia', 19, 1),
(340, 'Floresta', 15, 1),
(341, 'Florida', 76, 1),
(342, 'Floridablanca', 68, 1),
(343, 'Florián', 68, 1),
(344, 'Fonseca', 44, 1),
(345, 'Fortúl', 81, 1),
(346, 'Fosca', 25, 1),
(347, 'Francisco Pizarro', 52, 1),
(348, 'Fredonia', 5, 1),
(349, 'Fresno', 73, 1),
(350, 'Frontino', 5, 1),
(351, 'Fuente de Oro', 50, 1),
(352, 'Fundación', 47, 1),
(353, 'Funes', 52, 1),
(354, 'Funza', 25, 1),
(355, 'Fusagasugá', 25, 1),
(356, 'Fómeque', 25, 1),
(357, 'Fúquene', 25, 1),
(358, 'Gachalá', 25, 1),
(359, 'Gachancipá', 25, 1),
(360, 'Gachantivá', 15, 1),
(361, 'Gachetá', 25, 1),
(362, 'Galapa', 8, 1),
(363, 'Galeras (Nueva Granada)', 70, 1),
(364, 'Galán', 68, 1),
(365, 'Gama', 25, 1),
(366, 'Gamarra', 20, 1),
(367, 'Garagoa', 15, 1),
(368, 'Garzón', 41, 1),
(369, 'Gigante', 41, 1),
(370, 'Ginebra', 76, 1),
(371, 'Giraldo', 5, 1),
(372, 'Girardot', 25, 1),
(373, 'Girardota', 5, 1),
(374, 'Girón', 68, 1),
(375, 'Gonzalez', 20, 1),
(376, 'Gramalote', 54, 1),
(377, 'Granada', 5, 1),
(378, 'Granada', 25, 1),
(379, 'Granada', 50, 1),
(380, 'Guaca', 68, 1),
(381, 'Guacamayas', 15, 1),
(382, 'Guacarí', 76, 1),
(383, 'Guachavés', 52, 1),
(384, 'Guachené', 19, 1),
(385, 'Guachetá', 25, 1),
(386, 'Guachucal', 52, 1),
(387, 'Guadalupe', 5, 1),
(388, 'Guadalupe', 41, 1),
(389, 'Guadalupe', 68, 1),
(390, 'Guaduas', 25, 1),
(391, 'Guaitarilla', 52, 1),
(392, 'Gualmatán', 52, 1),
(393, 'Guamal', 47, 1),
(394, 'Guamal', 50, 1),
(395, 'Guamo', 73, 1),
(396, 'Guapota', 68, 1),
(397, 'Guapí', 19, 1),
(398, 'Guaranda', 70, 1),
(399, 'Guarne', 5, 1),
(400, 'Guasca', 25, 1),
(401, 'Guatapé', 5, 1),
(402, 'Guataquí', 25, 1),
(403, 'Guatavita', 25, 1),
(404, 'Guateque', 15, 1),
(405, 'Guavatá', 68, 1),
(406, 'Guayabal de Siquima', 25, 1),
(407, 'Guayabetal', 25, 1),
(408, 'Guayatá', 15, 1),
(409, 'Guepsa', 68, 1),
(410, 'Guicán', 15, 1),
(411, 'Gutiérrez', 25, 1),
(412, 'Guática', 66, 1),
(413, 'Gámbita', 68, 1),
(414, 'Gámeza', 15, 1),
(415, 'Génova', 63, 1),
(416, 'Gómez Plata', 5, 1),
(417, 'Hacarí', 54, 1),
(418, 'Hatillo de Loba', 13, 1),
(419, 'Hato', 68, 1),
(420, 'Hato Corozal', 85, 1),
(421, 'Hatonuevo', 44, 1),
(422, 'Heliconia', 5, 1),
(423, 'Herrán', 54, 1),
(424, 'Herveo', 73, 1),
(425, 'Hispania', 5, 1),
(426, 'Hobo', 41, 1),
(427, 'Honda', 73, 1),
(428, 'Ibagué', 73, 1),
(429, 'Icononzo', 73, 1),
(430, 'Iles', 52, 1),
(431, 'Imúes', 52, 1),
(432, 'Inzá', 19, 1),
(433, 'Inírida', 94, 1),
(434, 'Ipiales', 52, 1),
(435, 'Isnos', 41, 1),
(436, 'Istmina', 27, 1),
(437, 'Itagüí', 5, 1),
(438, 'Ituango', 5, 1),
(439, 'Izá', 15, 1),
(440, 'Jambaló', 19, 1),
(441, 'Jamundí', 76, 1),
(442, 'Jardín', 5, 1),
(443, 'Jenesano', 15, 1),
(444, 'Jericó', 5, 1),
(445, 'Jericó', 15, 1),
(446, 'Jerusalén', 25, 1),
(447, 'Jesús María', 68, 1),
(448, 'Jordán', 68, 1),
(449, 'Juan de Acosta', 8, 1),
(450, 'Junín', 25, 1),
(451, 'Juradó', 27, 1),
(452, 'La Apartada y La Frontera', 23, 1),
(453, 'La Argentina', 41, 1),
(454, 'La Belleza', 68, 1),
(455, 'La Calera', 25, 1),
(456, 'La Capilla', 15, 1),
(457, 'La Ceja', 5, 1),
(458, 'La Celia', 66, 1),
(459, 'La Cruz', 52, 1),
(460, 'La Cumbre', 76, 1),
(461, 'La Dorada', 17, 1),
(462, 'La Esperanza', 54, 1),
(463, 'La Estrella', 5, 1),
(464, 'La Florida', 52, 1),
(465, 'La Gloria', 20, 1),
(466, 'La Jagua de Ibirico', 20, 1),
(467, 'La Jagua del Pilar', 44, 1),
(468, 'La Llanada', 52, 1),
(469, 'La Macarena', 50, 1),
(470, 'La Merced', 17, 1),
(471, 'La Mesa', 25, 1),
(472, 'La Montañita', 18, 1),
(473, 'La Palma', 25, 1),
(474, 'La Paz', 68, 1),
(475, 'La Paz (Robles)', 20, 1),
(476, 'La Peña', 25, 1),
(477, 'La Pintada', 5, 1),
(478, 'La Plata', 41, 1),
(479, 'La Playa', 54, 1),
(480, 'La Primavera', 99, 1),
(481, 'La Salina', 85, 1),
(482, 'La Sierra', 19, 1),
(483, 'La Tebaida', 63, 1),
(484, 'La Tola', 52, 1),
(485, 'La Unión', 5, 1),
(486, 'La Unión', 52, 1),
(487, 'La Unión', 70, 1),
(488, 'La Unión', 76, 1),
(489, 'La Uvita', 15, 1),
(490, 'La Vega', 19, 1),
(491, 'La Vega', 25, 1),
(492, 'La Victoria', 15, 1),
(493, 'La Victoria', 17, 1),
(494, 'La Victoria', 76, 1),
(495, 'La Virginia', 66, 1),
(496, 'Labateca', 54, 1),
(497, 'Labranzagrande', 15, 1),
(498, 'Landázuri', 68, 1),
(499, 'Lebrija', 68, 1),
(500, 'Leiva', 52, 1),
(501, 'Lejanías', 50, 1),
(502, 'Lenguazaque', 25, 1),
(503, 'Leticia', 91, 1),
(504, 'Liborina', 5, 1),
(505, 'Linares', 52, 1),
(506, 'Lloró', 27, 1),
(507, 'Lorica', 23, 1),
(508, 'Los Córdobas', 23, 1),
(509, 'Los Palmitos', 70, 1),
(510, 'Los Patios', 54, 1),
(511, 'Los Santos', 68, 1),
(512, 'Lourdes', 54, 1),
(513, 'Luruaco', 8, 1),
(514, 'Lérida', 73, 1),
(515, 'Líbano', 73, 1),
(516, 'López (Micay)', 19, 1),
(517, 'Macanal', 15, 1),
(518, 'Macaravita', 68, 1),
(519, 'Maceo', 5, 1),
(520, 'Machetá', 25, 1),
(521, 'Madrid', 25, 1),
(522, 'Magangué', 13, 1),
(523, 'Magüi (Payán)', 52, 1),
(524, 'Mahates', 13, 1),
(525, 'Maicao', 44, 1),
(526, 'Majagual', 70, 1),
(527, 'Malambo', 8, 1),
(528, 'Mallama (Piedrancha)', 52, 1),
(529, 'Manatí', 8, 1),
(530, 'Manaure', 44, 1),
(531, 'Manaure Balcón del Cesar', 20, 1),
(532, 'Manizales', 17, 1),
(533, 'Manta', 25, 1),
(534, 'Manzanares', 17, 1),
(535, 'Maní', 85, 1),
(536, 'Mapiripan', 50, 1),
(537, 'Margarita', 13, 1),
(538, 'Marinilla', 5, 1),
(539, 'Maripí', 15, 1),
(540, 'Mariquita', 73, 1),
(541, 'Marmato', 17, 1),
(542, 'Marquetalia', 17, 1),
(543, 'Marsella', 66, 1),
(544, 'Marulanda', 17, 1),
(545, 'María la Baja', 13, 1),
(546, 'Matanza', 68, 1),
(547, 'Medellín', 5, 1),
(548, 'Medina', 25, 1),
(549, 'Medio Atrato', 27, 1),
(550, 'Medio Baudó', 27, 1),
(551, 'Medio San Juan (ANDAGOYA)', 27, 1),
(552, 'Melgar', 73, 1),
(553, 'Mercaderes', 19, 1),
(554, 'Mesetas', 50, 1),
(555, 'Milán', 18, 1),
(556, 'Miraflores', 15, 1),
(557, 'Miraflores', 95, 1),
(558, 'Miranda', 19, 1),
(559, 'Mistrató', 66, 1),
(560, 'Mitú', 97, 1),
(561, 'Mocoa', 86, 1),
(562, 'Mogotes', 68, 1),
(563, 'Molagavita', 68, 1),
(564, 'Momil', 23, 1),
(565, 'Mompós', 13, 1),
(566, 'Mongua', 15, 1),
(567, 'Monguí', 15, 1),
(568, 'Moniquirá', 15, 1),
(569, 'Montebello', 5, 1),
(570, 'Montecristo', 13, 1),
(571, 'Montelíbano', 23, 1),
(572, 'Montenegro', 63, 1),
(573, 'Monteria', 23, 1),
(574, 'Monterrey', 85, 1),
(575, 'Morales', 13, 1),
(576, 'Morales', 19, 1),
(577, 'Morelia', 18, 1),
(578, 'Morroa', 70, 1),
(579, 'Mosquera', 25, 1),
(580, 'Mosquera', 52, 1),
(581, 'Motavita', 15, 1),
(582, 'Moñitos', 23, 1),
(583, 'Murillo', 73, 1),
(584, 'Murindó', 5, 1),
(585, 'Mutatá', 5, 1),
(586, 'Mutiscua', 54, 1),
(587, 'Muzo', 15, 1),
(588, 'Málaga', 68, 1),
(589, 'Nariño', 5, 1),
(590, 'Nariño', 25, 1),
(591, 'Nariño', 52, 1),
(592, 'Natagaima', 73, 1),
(593, 'Nechí', 5, 1),
(594, 'Necoclí', 5, 1),
(595, 'Neira', 17, 1),
(596, 'Neiva', 41, 1),
(597, 'Nemocón', 25, 1),
(598, 'Nilo', 25, 1),
(599, 'Nimaima', 25, 1),
(600, 'Nobsa', 15, 1),
(601, 'Nocaima', 25, 1),
(602, 'Norcasia', 17, 1),
(603, 'Norosí', 13, 1),
(604, 'Novita', 27, 1),
(605, 'Nueva Granada', 47, 1),
(606, 'Nuevo Colón', 15, 1),
(607, 'Nunchía', 85, 1),
(608, 'Nuquí', 27, 1),
(609, 'Nátaga', 41, 1),
(610, 'Obando', 76, 1),
(611, 'Ocamonte', 68, 1),
(612, 'Ocaña', 54, 1),
(613, 'Oiba', 68, 1),
(614, 'Oicatá', 15, 1),
(615, 'Olaya', 5, 1),
(616, 'Olaya Herrera', 52, 1),
(617, 'Onzaga', 68, 1),
(618, 'Oporapa', 41, 1),
(619, 'Orito', 86, 1),
(620, 'Orocué', 85, 1),
(621, 'Ortega', 73, 1),
(622, 'Ospina', 52, 1),
(623, 'Otanche', 15, 1),
(624, 'Ovejas', 70, 1),
(625, 'Pachavita', 15, 1),
(626, 'Pacho', 25, 1),
(627, 'Padilla', 19, 1),
(628, 'Paicol', 41, 1),
(629, 'Pailitas', 20, 1),
(630, 'Paime', 25, 1),
(631, 'Paipa', 15, 1),
(632, 'Pajarito', 15, 1),
(633, 'Palermo', 41, 1),
(634, 'Palestina', 17, 1),
(635, 'Palestina', 41, 1),
(636, 'Palmar', 68, 1),
(637, 'Palmar de Varela', 8, 1),
(638, 'Palmas del Socorro', 68, 1),
(639, 'Palmira', 76, 1),
(640, 'Palmito', 70, 1),
(641, 'Palocabildo', 73, 1),
(642, 'Pamplona', 54, 1),
(643, 'Pamplonita', 54, 1),
(644, 'Pandi', 25, 1),
(645, 'Panqueba', 15, 1),
(646, 'Paratebueno', 25, 1),
(647, 'Pasca', 25, 1),
(648, 'Patía (El Bordo)', 19, 1),
(649, 'Pauna', 15, 1),
(650, 'Paya', 15, 1),
(651, 'Paz de Ariporo', 85, 1),
(652, 'Paz de Río', 15, 1),
(653, 'Pedraza', 47, 1),
(654, 'Pelaya', 20, 1),
(655, 'Pensilvania', 17, 1),
(656, 'Peque', 5, 1),
(657, 'Pereira', 66, 1),
(658, 'Pesca', 15, 1),
(659, 'Peñol', 5, 1),
(660, 'Piamonte', 19, 1),
(661, 'Pie de Cuesta', 68, 1),
(662, 'Piedras', 73, 1),
(663, 'Piendamó', 19, 1),
(664, 'Pijao', 63, 1),
(665, 'Pijiño', 47, 1),
(666, 'Pinchote', 68, 1),
(667, 'Pinillos', 13, 1),
(668, 'Piojo', 8, 1),
(669, 'Pisva', 15, 1),
(670, 'Pital', 41, 1),
(671, 'Pitalito', 41, 1),
(672, 'Pivijay', 47, 1),
(673, 'Planadas', 73, 1),
(674, 'Planeta Rica', 23, 1),
(675, 'Plato', 47, 1),
(676, 'Policarpa', 52, 1),
(677, 'Polonuevo', 8, 1),
(678, 'Ponedera', 8, 1),
(679, 'Popayán', 19, 1),
(680, 'Pore', 85, 1),
(681, 'Potosí', 52, 1),
(682, 'Pradera', 76, 1),
(683, 'Prado', 73, 1),
(684, 'Providencia', 52, 1),
(685, 'Providencia', 88, 1),
(686, 'Pueblo Bello', 20, 1),
(687, 'Pueblo Nuevo', 23, 1),
(688, 'Pueblo Rico', 66, 1),
(689, 'Pueblorrico', 5, 1),
(690, 'Puebloviejo', 47, 1),
(691, 'Puente Nacional', 68, 1),
(692, 'Puerres', 52, 1),
(693, 'Puerto Asís', 86, 1),
(694, 'Puerto Berrío', 5, 1),
(695, 'Puerto Boyacá', 15, 1),
(696, 'Puerto Caicedo', 86, 1),
(697, 'Puerto Carreño', 99, 1),
(698, 'Puerto Colombia', 8, 1),
(699, 'Puerto Concordia', 50, 1),
(700, 'Puerto Escondido', 23, 1),
(701, 'Puerto Gaitán', 50, 1),
(702, 'Puerto Guzmán', 86, 1),
(703, 'Puerto Leguízamo', 86, 1),
(704, 'Puerto Libertador', 23, 1),
(705, 'Puerto Lleras', 50, 1),
(706, 'Puerto López', 50, 1),
(707, 'Puerto Nare', 5, 1),
(708, 'Puerto Nariño', 91, 1),
(709, 'Puerto Parra', 68, 1),
(710, 'Puerto Rico', 18, 1),
(711, 'Puerto Rico', 50, 1),
(712, 'Puerto Rondón', 81, 1),
(713, 'Puerto Salgar', 25, 1),
(714, 'Puerto Santander', 54, 1),
(715, 'Puerto Tejada', 19, 1),
(716, 'Puerto Triunfo', 5, 1),
(717, 'Puerto Wilches', 68, 1),
(718, 'Pulí', 25, 1),
(719, 'Pupiales', 52, 1),
(720, 'Puracé (Coconuco)', 19, 1),
(721, 'Purificación', 73, 1),
(722, 'Purísima', 23, 1),
(723, 'Pácora', 17, 1),
(724, 'Páez', 15, 1),
(725, 'Páez (Belalcazar)', 19, 1),
(726, 'Páramo', 68, 1),
(727, 'Quebradanegra', 25, 1),
(728, 'Quetame', 25, 1),
(729, 'Quibdó', 27, 1),
(730, 'Quimbaya', 63, 1),
(731, 'Quinchía', 66, 1),
(732, 'Quipama', 15, 1),
(733, 'Quipile', 25, 1),
(734, 'Ragonvalia', 54, 1),
(735, 'Ramiriquí', 15, 1),
(736, 'Recetor', 85, 1),
(737, 'Regidor', 13, 1),
(738, 'Remedios', 5, 1),
(739, 'Remolino', 47, 1),
(740, 'Repelón', 8, 1),
(741, 'Restrepo', 50, 1),
(742, 'Restrepo', 76, 1),
(743, 'Retiro', 5, 1),
(744, 'Ricaurte', 25, 1),
(745, 'Ricaurte', 52, 1),
(746, 'Rio Negro', 68, 1),
(747, 'Rioblanco', 73, 1),
(748, 'Riofrío', 76, 1),
(749, 'Riohacha', 44, 1),
(750, 'Risaralda', 17, 1),
(751, 'Rivera', 41, 1),
(752, 'Roberto Payán (San José)', 52, 1),
(753, 'Roldanillo', 76, 1),
(754, 'Roncesvalles', 73, 1),
(755, 'Rondón', 15, 1),
(756, 'Rosas', 19, 1),
(757, 'Rovira', 73, 1),
(758, 'Ráquira', 15, 1),
(759, 'Río Iró', 27, 1),
(760, 'Río Quito', 27, 1),
(761, 'Río Sucio', 17, 1),
(762, 'Río Viejo', 13, 1),
(763, 'Río de oro', 20, 1),
(764, 'Ríonegro', 5, 1),
(765, 'Ríosucio', 27, 1),
(766, 'Sabana de Torres', 68, 1),
(767, 'Sabanagrande', 8, 1),
(768, 'Sabanalarga', 5, 1),
(769, 'Sabanalarga', 8, 1),
(770, 'Sabanalarga', 85, 1),
(771, 'Sabanas de San Angel (SAN ANGEL)', 47, 1),
(772, 'Sabaneta', 5, 1),
(773, 'Saboyá', 15, 1),
(774, 'Sahagún', 23, 1),
(775, 'Saladoblanco', 41, 1),
(776, 'Salamina', 17, 1),
(777, 'Salamina', 47, 1),
(778, 'Salazar', 54, 1),
(779, 'Saldaña', 73, 1),
(780, 'Salento', 63, 1),
(781, 'Salgar', 5, 1),
(782, 'Samacá', 15, 1),
(783, 'Samaniego', 52, 1),
(784, 'Samaná', 17, 1),
(785, 'Sampués', 70, 1),
(786, 'San Agustín', 41, 1),
(787, 'San Alberto', 20, 1),
(788, 'San Andrés', 68, 1),
(789, 'San Andrés Sotavento', 23, 1),
(790, 'San Andrés de Cuerquía', 5, 1),
(791, 'San Antero', 23, 1),
(792, 'San Antonio', 73, 1),
(793, 'San Antonio de Tequendama', 25, 1),
(794, 'San Benito', 68, 1),
(795, 'San Benito Abad', 70, 1),
(796, 'San Bernardo', 25, 1),
(797, 'San Bernardo', 52, 1),
(798, 'San Bernardo del Viento', 23, 1),
(799, 'San Calixto', 54, 1),
(800, 'San Carlos', 5, 1),
(801, 'San Carlos', 23, 1),
(802, 'San Carlos de Guaroa', 50, 1),
(803, 'San Cayetano', 25, 1),
(804, 'San Cayetano', 54, 1),
(805, 'San Cristobal', 13, 1),
(806, 'San Diego', 20, 1),
(807, 'San Eduardo', 15, 1),
(808, 'San Estanislao', 13, 1),
(809, 'San Fernando', 13, 1),
(810, 'San Francisco', 5, 1),
(811, 'San Francisco', 25, 1),
(812, 'San Francisco', 86, 1),
(813, 'San Gíl', 68, 1),
(814, 'San Jacinto', 13, 1),
(815, 'San Jacinto del Cauca', 13, 1),
(816, 'San Jerónimo', 5, 1),
(817, 'San Joaquín', 68, 1),
(818, 'San José', 17, 1),
(819, 'San José de Miranda', 68, 1),
(820, 'San José de Montaña', 5, 1),
(821, 'San José de Pare', 15, 1),
(822, 'San José de Uré', 23, 1),
(823, 'San José del Fragua', 18, 1),
(824, 'San José del Guaviare', 95, 1),
(825, 'San José del Palmar', 27, 1),
(826, 'San Juan de Arama', 50, 1),
(827, 'San Juan de Betulia', 70, 1),
(828, 'San Juan de Nepomuceno', 13, 1),
(829, 'San Juan de Pasto', 52, 1),
(830, 'San Juan de Río Seco', 25, 1),
(831, 'San Juan de Urabá', 5, 1),
(832, 'San Juan del Cesar', 44, 1),
(833, 'San Juanito', 50, 1),
(834, 'San Lorenzo', 52, 1),
(835, 'San Luis', 73, 1),
(836, 'San Luís', 5, 1),
(837, 'San Luís de Gaceno', 15, 1),
(838, 'San Luís de Palenque', 85, 1),
(839, 'San Marcos', 70, 1),
(840, 'San Martín', 20, 1),
(841, 'San Martín', 50, 1),
(842, 'San Martín de Loba', 13, 1),
(843, 'San Mateo', 15, 1),
(844, 'San Miguel', 68, 1),
(845, 'San Miguel', 86, 1),
(846, 'San Miguel de Sema', 15, 1),
(847, 'San Onofre', 70, 1),
(848, 'San Pablo', 13, 1),
(849, 'San Pablo', 52, 1),
(850, 'San Pablo de Borbur', 15, 1),
(851, 'San Pedro', 5, 1),
(852, 'San Pedro', 70, 1),
(853, 'San Pedro', 76, 1),
(854, 'San Pedro de Cartago', 52, 1),
(855, 'San Pedro de Urabá', 5, 1),
(856, 'San Pelayo', 23, 1),
(857, 'San Rafael', 5, 1),
(858, 'San Roque', 5, 1),
(859, 'San Sebastián', 19, 1),
(860, 'San Sebastián de Buenavista', 47, 1),
(861, 'San Vicente', 5, 1),
(862, 'San Vicente del Caguán', 18, 1),
(863, 'San Vicente del Chucurí', 68, 1),
(864, 'San Zenón', 47, 1),
(865, 'Sandoná', 52, 1),
(866, 'Santa Ana', 47, 1),
(867, 'Santa Bárbara', 5, 1),
(868, 'Santa Bárbara', 68, 1),
(869, 'Santa Bárbara (Iscuandé)', 52, 1),
(870, 'Santa Bárbara de Pinto', 47, 1),
(871, 'Santa Catalina', 13, 1),
(872, 'Santa Fé de Antioquia', 5, 1),
(873, 'Santa Genoveva de Docorodó', 27, 1),
(874, 'Santa Helena del Opón', 68, 1),
(875, 'Santa Isabel', 73, 1),
(876, 'Santa Lucía', 8, 1),
(877, 'Santa Marta', 47, 1),
(878, 'Santa María', 15, 1),
(879, 'Santa María', 41, 1),
(880, 'Santa Rosa', 13, 1),
(881, 'Santa Rosa', 19, 1),
(882, 'Santa Rosa de Cabal', 66, 1),
(883, 'Santa Rosa de Osos', 5, 1),
(884, 'Santa Rosa de Viterbo', 15, 1),
(885, 'Santa Rosa del Sur', 13, 1),
(886, 'Santa Rosalía', 99, 1),
(887, 'Santa Sofía', 15, 1),
(888, 'Santana', 15, 1),
(889, 'Santander de Quilichao', 19, 1),
(890, 'Santiago', 54, 1),
(891, 'Santiago', 86, 1),
(892, 'Santo Domingo', 5, 1),
(893, 'Santo Tomás', 8, 1),
(894, 'Santuario', 5, 1),
(895, 'Santuario', 66, 1),
(896, 'Sapuyes', 52, 1),
(897, 'Saravena', 81, 1),
(898, 'Sardinata', 54, 1),
(899, 'Sasaima', 25, 1),
(900, 'Sativanorte', 15, 1),
(901, 'Sativasur', 15, 1),
(902, 'Segovia', 5, 1),
(903, 'Sesquilé', 25, 1),
(904, 'Sevilla', 76, 1),
(905, 'Siachoque', 15, 1),
(906, 'Sibaté', 25, 1),
(907, 'Sibundoy', 86, 1),
(908, 'Silos', 54, 1),
(909, 'Silvania', 25, 1),
(910, 'Silvia', 19, 1),
(911, 'Simacota', 68, 1),
(912, 'Simijaca', 25, 1),
(913, 'Simití', 13, 1),
(914, 'Sincelejo', 70, 1),
(915, 'Sincé', 70, 1),
(916, 'Sipí', 27, 1),
(917, 'Sitionuevo', 47, 1),
(918, 'Soacha', 25, 1),
(919, 'Soatá', 15, 1),
(920, 'Socha', 15, 1),
(921, 'Socorro', 68, 1),
(922, 'Socotá', 15, 1),
(923, 'Sogamoso', 15, 1),
(924, 'Solano', 18, 1),
(925, 'Soledad', 8, 1),
(926, 'Solita', 18, 1),
(927, 'Somondoco', 15, 1),
(928, 'Sonsón', 5, 1),
(929, 'Sopetrán', 5, 1),
(930, 'Soplaviento', 13, 1),
(931, 'Sopó', 25, 1),
(932, 'Sora', 15, 1),
(933, 'Soracá', 15, 1),
(934, 'Sotaquirá', 15, 1),
(935, 'Sotara (Paispamba)', 19, 1),
(936, 'Sotomayor (Los Andes)', 52, 1),
(937, 'Suaita', 68, 1),
(938, 'Suan', 8, 1),
(939, 'Suaza', 41, 1),
(940, 'Subachoque', 25, 1),
(941, 'Sucre', 19, 1),
(942, 'Sucre', 68, 1),
(943, 'Sucre', 70, 1),
(944, 'Suesca', 25, 1),
(945, 'Supatá', 25, 1),
(946, 'Supía', 17, 1),
(947, 'Suratá', 68, 1),
(948, 'Susa', 25, 1),
(949, 'Susacón', 15, 1),
(950, 'Sutamarchán', 15, 1),
(951, 'Sutatausa', 25, 1),
(952, 'Sutatenza', 15, 1),
(953, 'Suárez', 19, 1),
(954, 'Suárez', 73, 1),
(955, 'Sácama', 85, 1),
(956, 'Sáchica', 15, 1),
(957, 'Tabio', 25, 1),
(958, 'Tadó', 27, 1),
(959, 'Talaigua Nuevo', 13, 1),
(960, 'Tamalameque', 20, 1),
(961, 'Tame', 81, 1),
(962, 'Taminango', 52, 1),
(963, 'Tangua', 52, 1),
(964, 'Taraira', 97, 1),
(965, 'Tarazá', 5, 1),
(966, 'Tarqui', 41, 1),
(967, 'Tarso', 5, 1),
(968, 'Tasco', 15, 1),
(969, 'Tauramena', 85, 1),
(970, 'Tausa', 25, 1),
(971, 'Tello', 41, 1),
(972, 'Tena', 25, 1),
(973, 'Tenerife', 47, 1),
(974, 'Tenjo', 25, 1),
(975, 'Tenza', 15, 1),
(976, 'Teorama', 54, 1),
(977, 'Teruel', 41, 1),
(978, 'Tesalia', 41, 1),
(979, 'Tibacuy', 25, 1),
(980, 'Tibaná', 15, 1),
(981, 'Tibasosa', 15, 1),
(982, 'Tibirita', 25, 1),
(983, 'Tibú', 54, 1),
(984, 'Tierralta', 23, 1),
(985, 'Timaná', 41, 1),
(986, 'Timbiquí', 19, 1),
(987, 'Timbío', 19, 1),
(988, 'Tinjacá', 15, 1),
(989, 'Tipacoque', 15, 1),
(990, 'Tiquisio (Puerto Rico)', 13, 1),
(991, 'Titiribí', 5, 1),
(992, 'Toca', 15, 1),
(993, 'Tocaima', 25, 1),
(994, 'Tocancipá', 25, 1),
(995, 'Toguí', 15, 1),
(996, 'Toledo', 5, 1),
(997, 'Toledo', 54, 1),
(998, 'Tolú', 70, 1),
(999, 'Tolú Viejo', 70, 1),
(1000, 'Tona', 68, 1),
(1001, 'Topagá', 15, 1),
(1002, 'Topaipí', 25, 1),
(1003, 'Toribío', 19, 1),
(1004, 'Toro', 76, 1),
(1005, 'Tota', 15, 1),
(1006, 'Totoró', 19, 1),
(1007, 'Trinidad', 85, 1),
(1008, 'Trujillo', 76, 1),
(1009, 'Tubará', 8, 1),
(1010, 'Tuchín', 23, 1),
(1011, 'Tulúa', 76, 1),
(1012, 'Tumaco', 52, 1),
(1013, 'Tunja', 15, 1),
(1014, 'Tunungua', 15, 1),
(1015, 'Turbaco', 13, 1),
(1016, 'Turbaná', 13, 1),
(1017, 'Turbo', 5, 1),
(1018, 'Turmequé', 15, 1),
(1019, 'Tuta', 15, 1),
(1020, 'Tutasá', 15, 1),
(1021, 'Támara', 85, 1),
(1022, 'Támesis', 5, 1),
(1023, 'Túquerres', 52, 1),
(1024, 'Ubalá', 25, 1),
(1025, 'Ubaque', 25, 1),
(1026, 'Ubaté', 25, 1),
(1027, 'Ulloa', 76, 1),
(1028, 'Une', 25, 1),
(1029, 'Unguía', 27, 1),
(1030, 'Unión Panamericana (ÁNIMAS)', 27, 1),
(1031, 'Uramita', 5, 1),
(1032, 'Uribe', 50, 1),
(1033, 'Uribia', 44, 1),
(1034, 'Urrao', 5, 1),
(1035, 'Urumita', 44, 1),
(1036, 'Usiacuri', 8, 1),
(1037, 'Valdivia', 5, 1),
(1038, 'Valencia', 23, 1),
(1039, 'Valle de San José', 68, 1),
(1040, 'Valle de San Juan', 73, 1),
(1041, 'Valle del Guamuez', 86, 1),
(1042, 'Valledupar', 20, 1),
(1043, 'Valparaiso', 5, 1),
(1044, 'Valparaiso', 18, 1),
(1045, 'Vegachí', 5, 1),
(1046, 'Venadillo', 73, 1),
(1047, 'Venecia', 5, 1),
(1048, 'Venecia (Ospina Pérez)', 25, 1),
(1049, 'Ventaquemada', 15, 1),
(1050, 'Vergara', 25, 1),
(1051, 'Versalles', 76, 1),
(1052, 'Vetas', 68, 1),
(1053, 'Viani', 25, 1),
(1054, 'Vigía del Fuerte', 5, 1),
(1055, 'Vijes', 76, 1),
(1056, 'Villa Caro', 54, 1),
(1057, 'Villa Rica', 19, 1),
(1058, 'Villa de Leiva', 15, 1),
(1059, 'Villa del Rosario', 54, 1),
(1060, 'Villagarzón', 86, 1),
(1061, 'Villagómez', 25, 1),
(1062, 'Villahermosa', 73, 1),
(1063, 'Villamaría', 17, 1),
(1064, 'Villanueva', 13, 1),
(1065, 'Villanueva', 44, 1),
(1066, 'Villanueva', 68, 1),
(1067, 'Villanueva', 85, 1),
(1068, 'Villapinzón', 25, 1),
(1069, 'Villarrica', 73, 1),
(1070, 'Villavicencio', 50, 1),
(1071, 'Villavieja', 41, 1),
(1072, 'Villeta', 25, 1),
(1073, 'Viotá', 25, 1),
(1074, 'Viracachá', 15, 1),
(1075, 'Vista Hermosa', 50, 1),
(1076, 'Viterbo', 17, 1),
(1077, 'Vélez', 68, 1),
(1078, 'Yacopí', 25, 1),
(1079, 'Yacuanquer', 52, 1),
(1080, 'Yaguará', 41, 1),
(1081, 'Yalí', 5, 1),
(1082, 'Yarumal', 5, 1),
(1083, 'Yolombó', 5, 1),
(1084, 'Yondó (Casabe)', 5, 1),
(1085, 'Yopal', 85, 1),
(1086, 'Yotoco', 76, 1),
(1087, 'Yumbo', 76, 1),
(1088, 'Zambrano', 13, 1),
(1089, 'Zapatoca', 68, 1),
(1090, 'Zapayán (PUNTA DE PIEDRAS)', 47, 1),
(1091, 'Zaragoza', 5, 1),
(1092, 'Zarzal', 76, 1),
(1093, 'Zetaquirá', 15, 1),
(1094, 'Zipacón', 25, 1),
(1095, 'Zipaquirá', 25, 1),
(1096, 'Zona Bananera (PRADO - SEVILLA)', 47, 1),
(1097, 'Ábrego', 54, 1),
(1098, 'Íquira', 41, 1),
(1099, 'Úmbita', 15, 1),
(1100, 'Útica', 25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrol` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idrol`, `name`) VALUES
(1, 'Admin'),
(2, 'Medico'),
(3, 'Paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `documento` int NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `rol_id` int NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `correo`, `password`, `documento`, `fecha_nacimiento`, `rol_id`, `direccion`, `telefono`) VALUES
(7, 'Andy', 'andy@gmail.com', '$2y$10$PQeijaOegWJq8mG.dGTwVunmyFgLNYs7gPjnOwlZBzdaCd6l9sFpC', 1004224748, '2000-06-23', 1, 'cll 1 # 6-56', 424343),
(8, 'Camilo', 'camilo@gmail.com', '$2y$10$NvduWCzrPVsbIDJiq8xdAud6r/30cvfyMqhhQ2aFe0sSSvTLxRuPu', 12332332, '2003-11-23', 2, 'cll1 # 5-45', 433223232),
(9, 'Carlos', 'carlos@gmail.com', '$2y$10$ruJJdEWj/pNLa1VkaKb0DOUnW/DdPo8e1LMVKSsJdogDMzTK6ys5G', 18038032, '2008-10-23', 3, 'cll 45 # 5-44', 3219098432),
(10, 'Felipe', 'felipe@gmail.com', '$2y$10$faMrQY6VtAAuDQwNo18f0eziYYtjli760KgwV6iE8ZsFXSypGZzYK', 12332321, '1997-11-23', 2, 'cra 3 ', 329829838),
(11, 'Erika@gmail.com', 'erika@gmail.com', '$2y$10$EkR2zBgKB6PetKsUcXALLO.1pAnFsQnDpk9ZZZBSej/7fqCV8vuIq', 1122123, '2002-06-24', 3, 'cll 5 # 4-45', 43242434),
(12, 'Fernanda', 'fernanda@gmail.com', '$2y$10$vE8D04HP2vo0N5UGIBPNAuuIYA2ZeQUrdbqB6UF.FS6aur4OmApy2', 3433232, '2003-07-24', 3, 'cll 5 # 65-4', 3214445454),
(13, 'camila', 'camila@gmail.com', '$2y$10$tk5.DfwEVOymDASXxPFQUOSHRLJ8MrRvslElTlm5rICU37t7AoZz.', 12234444, '2007-11-24', 3, 'cll 4', 321454232);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idcita`),
  ADD KEY `id_consultorio` (`id_consultorio`,`id_paciente`,`id_medico`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `cita_medicamento`
--
ALTER TABLE `cita_medicamento`
  ADD PRIMARY KEY (`idcitamed`),
  ADD KEY `id_cita` (`id_cita`,`id_medicamento`),
  ADD KEY `id_medicamento` (`id_medicamento`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`idcon`),
  ADD KEY `id_mun` (`id_mun`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`iddept`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`idmed`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`idmun`),
  ADD KEY `id_dept` (`id_dept`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idcita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cita_medicamento`
--
ALTER TABLE `cita_medicamento`
  MODIFY `idcitamed` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `idcon` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `iddept` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idestado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `idmed` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `idmun` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1101;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idrol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`id_consultorio`) REFERENCES `consultorios` (`idcon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_4` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`idestado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_5` FOREIGN KEY (`id_paciente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_6` FOREIGN KEY (`id_medico`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita_medicamento`
--
ALTER TABLE `cita_medicamento`
  ADD CONSTRAINT `cita_medicamento_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`idcita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_medicamento_ibfk_2` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`idmed`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD CONSTRAINT `consultorios_ibfk_1` FOREIGN KEY (`id_mun`) REFERENCES `municipios` (`idmun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`id_dept`) REFERENCES `departamentos` (`iddept`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
