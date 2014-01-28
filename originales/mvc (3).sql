-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 26, 2014 at 05:22 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area`, `descripcion`) VALUES
(1, 'General', 'General'),
(2, 'Instrucción', 'Es el área encargada de la formación integral de los emevecistas en la fe de la iglesia y espiritualidad sodálite.'),
(3, 'Apostolado', 'Es el área encargada de velar por el trabajo y crecimiento apostólico.'),
(4, 'Espiritualidad', 'Es el área encargada de velar por la animación y crecimiento espiritual, vida sacramental y litúrgica y la profundización en la fe de la Iglesia de los emevecistas.'),
(5, 'Temporalidades', 'Es el área encargada de velar por la buena administración de los bienes y recursos materiales de la localidad.'),
(6, 'Comunicaciones', 'Es el área encargada de velar por que se dé a conocer adecuadamente nuestro carisma, según nuestra espiritualidad y estilo.');

-- --------------------------------------------------------

--
-- Table structure for table `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(50) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `area_id` int(11) NOT NULL,
  `nivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `cargo`
--

INSERT INTO `cargo` (`id`, `cargo`, `descripcion`, `area_id`, `nivel`) VALUES
(4, 'Agrupado', 'Persona que pertenece a una asociación', 3, 4),
(5, 'SuperAdmin', 'SuperAdmin', 0, 5),
(6, 'Encargado General', 'Encargado General MVC', 1, 1),
(7, 'Animador', 'Dirige una asociación', 3, 3),
(8, 'Encargado General C.A.', 'Encargado de un Centro Apostólico', 1, 1),
(10, 'Encargado General de Comunicaciones', 'Encargado del área de comunicaciones del MVC Ecuador', 6, 2),
(11, 'Encargado de Comunicaciones C.A.', 'Encargado del área de comunicaciones de un Centro Apostólico', 6, 2),
(12, 'Encargado General de Apostolado', 'Encargado del área de apostolado del MVC Ecuador', 3, 2),
(13, 'Encargado de Apostolado C.A.', 'Encargado del área de apostolado en un Centro Apostólico', 3, 2),
(14, 'Encargado General de Instrucción', 'Encargado del área de instrucción del MVC Ecuador', 2, 2),
(15, 'Encargado de Instrucción C.A.', 'Encargado del área de instrucción de un Centro Apostólico', 2, 2),
(16, 'Encargado General de Espiritualidad', 'Encargado del área de espiritualidad del MVC Ecuador', 4, 2),
(17, 'Encargado de Espiritualidad C.A.', 'Encargado del área de espiritualidad de un Centro Apostólico', 4, 2),
(18, 'Encargado General de Temporalidades', 'Encargado del área de temporalidades del MVC Ecuador', 5, 2),
(19, 'Encargado de Temporalidades C.A.', 'Encargado del área de temporalidades de un Centro Apostólico', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `centro`
--

CREATE TABLE IF NOT EXISTS `centro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `centro` varchar(200) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `telefono` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `direccion` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `centro`
--

INSERT INTO `centro` (`id`, `centro`, `descripcion`, `fecha_creacion`, `telefono`, `direccion`, `email`) VALUES
(1, 'Virgen del Pilar', 'C.A. del sur de  Guayaquil', '2003-10-12', '', 'Francisco Segura 1207 entre La Habana y México', 'ca.virgendelpilar@gmail.com'),
(2, 'Nuestra Señora de la Reconciliación', 'C.A. del norte de Guayaquil', '2013-01-01', '', '', ''),
(3, 'Sagrada Familia', 'C.A. en la Alborada (Guayaquil)', '2013-01-01', '', '', ''),
(4, 'Madre del Peregrinar', 'C.A. en Urdesa (Guayaquil)', '2013-01-01', '', '', ''),
(5, 'Santa María de los Ríos', 'C.A. en la puntilla (Guayaquil)', '2014-01-16', '', '', ''),
(6, 'Madre de los Apóstoles', 'C.A. en Ceibos (Guayaquil)', '2013-01-01', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `instancia_despliegue`
--

CREATE TABLE IF NOT EXISTS `instancia_despliegue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `centro_id` int(11) NOT NULL,
  `despliegue` varchar(255) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `lugar` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `colaboracion` double DEFAULT '0',
  `numero_taller` int(11) DEFAULT NULL,
  `categoria` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contenidos` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `observaciones` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `lista_recursos` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `ingreso` double DEFAULT '0',
  `egreso` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `instancia_despliegue`
--

INSERT INTO `instancia_despliegue` (`id`, `centro_id`, `despliegue`, `descripcion`, `fecha_creacion`, `fecha_fin`, `horario`, `lugar`, `colaboracion`, `numero_taller`, `categoria`, `contenidos`, `observaciones`, `lista_recursos`, `ingreso`, `egreso`) VALUES
(1, 1, 'Campaña Navidad Es Jesús 2013', 'Es una instancia para compartir la Buena Nueva del Nacimiento del Señor Jesús a todos nuestros hermanos en la fe, y llevarles lo necesario para que la alegría de la celebración se vea reflejada en una mesa en la que no falten alimentos.', '2013-09-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(15, 1, 'Charla del Mes Enero', 'Enero', '2014-01-25', '0000-00-00', '18:30:00', 'Cp sur', 1, 0, '', '', '', '', 0, 0),
(16, 1, 'Rosario Comunitario', '', '2014-01-18', '0000-00-00', '18:30:00', '', 0, 0, '', '', '', '', 0, 0),
(17, 1, 'Jornada de Adviento 2013', 'Preparacion para la Navidad', '2013-12-14', '2013-12-15', '15:00:00', 'Cp sur', 3, 0, '', '', '', '', 0, 0),
(18, 1, 'S.S. Pan Para Mi Hermano', 'Servicio Solidario', '2014-01-09', '0000-00-00', '00:00:00', '', 0, 0, '', '', '', '', 0, 0),
(19, 1, 'S.S. Madre Peregrina Nigeria', 'Servicio Solidario', '2014-01-12', '0000-00-00', '00:00:00', '', 0, 0, '', '', '', '', 0, 0),
(20, 1, 'S.S. Madre de la Solidaridad', 'Servicio Solidario', '2014-01-12', '0000-00-00', '00:00:00', '', 0, 0, '', '', '', '', 0, 0),
(21, 1, 'S. S. Comparte', 'Servicio Solidario', '2014-01-05', '0000-00-00', '00:00:00', '', 0, 0, '', '', '', '', 0, 0),
(22, 1, 'balance', 'Donación', '2014-01-02', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 150, 0),
(23, 1, 'balance', 'Gastos de Publicidad', '2014-01-17', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 200),
(24, 1, 'balance', 'Compra de artículos varios ', '2014-01-04', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 75),
(25, 1, 'balance', 'Donación', '2014-01-24', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `instancia_permanencia`
--

CREATE TABLE IF NOT EXISTS `instancia_permanencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `centro_id` int(11) NOT NULL,
  `permanencia` varchar(50) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `instancia_permanencia`
--

INSERT INTO `instancia_permanencia` (`id`, `centro_id`, `permanencia`, `descripcion`, `fecha_creacion`, `fecha_fin`) VALUES
(1, 1, 'Santa María del Fiat', 'Agrupadas marianas VDP', NULL, '0000-00-00'),
(2, 1, 'Via Veritas Vita', 'Agrupadas universitarias VDP', NULL, '0000-00-00'),
(3, 1, 'Santa María de la Visitación', 'Agrupadas mayores VDP', NULL, '0000-00-00'),
(4, 1, 'Santa Clara de Asis', 'Agrupadas colegiales VDP', NULL, '0000-00-00'),
(6, 2, 'San Benito', 'Agrupados universitarios', NULL, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `ciudad` enum('Santiago de Guayaquil','San Pablo de Manta','San Francisco de Quito') NOT NULL DEFAULT 'Santiago de Guayaquil',
  `sexo` enum('hombre','mujer') NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `domicilio` varchar(150) DEFAULT NULL,
  `nivel_estudio` varchar(20) DEFAULT NULL,
  `institucion` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular_claro` varchar(15) DEFAULT NULL,
  `celular_movistar` varchar(15) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `facebook` varchar(20) DEFAULT NULL,
  `twitter` varchar(20) DEFAULT NULL,
  `foto` varchar(80) DEFAULT NULL,
  `relacion` enum('agrupado','visitante') NOT NULL,
  `estado` enum('activo','pasivo') NOT NULL,
  `fecha_registro` date NOT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `contrasena` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `apellido`, `ciudad`, `sexo`, `edad`, `fecha_nacimiento`, `domicilio`, `nivel_estudio`, `institucion`, `telefono`, `celular_claro`, `celular_movistar`, `email`, `facebook`, `twitter`, `foto`, `relacion`, `estado`, `fecha_registro`, `usuario`, `contrasena`) VALUES
(1, 'Andrea Nathaly', 'Simbaña Brito', 'Santiago de Guayaquil', 'mujer', 23, '1990-02-11', 'Cdla. Los Esteros Mz45a V42', 'universitario', 'ESPOL', '042423144', '0988442019', '', 'andrea_sb112@hotmail.com', 'andy.nsb', 'andy_nsb', NULL, 'agrupado', 'activo', '2013-12-18', 'andy', '1111'),
(2, 'Angel Xavier', 'Astudillo Aguilar', 'Santiago de Guayaquil', 'hombre', 23, '1990-07-10', 'Duran', 'universitario', 'ESPOL', '', '', '', 'xavieras1@gmail.com', '', '', NULL, 'agrupado', 'activo', '2013-12-20', 'angel', 'angel'),
(3, 'Gustavo Omar', 'Leon Idrovo', 'Santiago de Guayaquil', 'hombre', 25, '0000-00-00', 'Maldonado 3812 y la 19ava', 'universitario', 'Escuela de Negocios Humane', '042460335', '0991028274', '', 'gusta-leon@hotmail.com', '', '', NULL, 'agrupado', 'activo', '0000-00-00', 'gleon', 'gleon'),
(4, 'Julian', 'Perez', 'Santiago de Guayaquil', 'hombre', 25, '1988-11-19', 'Sexta y Camilo Destruge', 'profesional', 'UCSG', NULL, '0989739366', NULL, 'julian_perez_rodriguez@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(5, 'Mauricio', 'Montoya', 'Santiago de Guayaquil', 'hombre', 24, '1989-09-07', 'Cdla. La Fragata', 'universitario', 'Escuela de Negocios Humane', '2495824', NULL, NULL, 'sermoumon1989@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(6, 'Miguel Angel', 'Almeida Franco', 'Santiago de Guayaquil', 'hombre', 25, '1988-09-23', 'Cdla. Los Almendros Mz C', 'universitario', 'ESPOL', '2340116', '092244166', NULL, 'miguel_almeida_franco@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(7, 'Cristhian Andres', 'Montoya Alava', 'Santiago de Guayaquil', 'hombre', 25, '1988-06-04', 'Los Rios y Huancavilca', 'universitario', 'ESPOL', NULL, '0994129870', NULL, 'cmontoya88@hotmail.es', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(8, 'Emilio', 'Guillen', 'Santiago de Guayaquil', 'hombre', 25, '1988-12-14', 'Cdla. Terranostra', 'universitario', 'ESPOL', NULL, '0995273897', NULL, 'emilio_armas@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(9, 'Daniel', 'García', 'Santiago de Guayaquil', 'hombre', 24, '1989-01-02', 'Colón y la 10ma', 'universitario', 'ESPOL', NULL, '0991542596', NULL, 'digarcia@hotmail.es', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(10, 'Carlos', 'Espinoza', 'Santiago de Guayaquil', '', 22, '1992-03-30', 'Cdla. La Floresta', 'universitario', 'UPS', NULL, '0994180008', NULL, 'alfredocalito@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(11, 'Fernando', 'Garnica', 'Santiago de Guayaquil', 'hombre', 21, '1992-04-21', 'Cdla. Las Acacias', 'universitario', 'ESPOL', '2340242', '0987831826', NULL, 'fernando_garnica@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(12, 'Carlos', 'Pilozo', 'Santiago de Guayaquil', 'hombre', 22, '1991-05-24', 'Capitán Nájera 3520 entre la séptima y la octava', 'universitario', 'ESPOL', '2453809', '0991977779', NULL, 'c_a_pilozo@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(13, 'Christian ', 'Silva', 'Santiago de Guayaquil', 'hombre', 22, '1991-01-09', 'Cdla. 9 octubre', 'universitario', 'ESPOL', '2445117', '0986497717', NULL, 'csilvab@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(14, 'Jaime', 'Andrade', 'Santiago de Guayaquil', 'hombre', 21, '1992-03-09', 'Cdla. Los Tulipanes', 'universitario', 'ESPOL', '2423393', '0907055866', NULL, 'jaime_andrade92@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(15, 'André ', 'Herreira', 'Santiago de Guayaquil', 'hombre', 19, '1994-06-08', 'La Habana 1105 y calle C', 'universitario', 'UPS', '', '0993705429', NULL, 'jpilla2006@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(16, 'Nicolás ', 'Ortega', 'Santiago de Guayaquil', 'hombre', 19, '1994-07-04', 'La Saiba mz G V10', 'universitario', 'USM', '2346983', '0988399358', NULL, 'omar_niko@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(17, 'Diego', 'Cabrera', 'Santiago de Guayaquil', 'hombre', 19, '1994-04-30', 'Oconnor y la Habana', '', '', '2440978', '', '0982212508', 'jorge_diego_c@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(18, 'Xavier', 'Guerra', 'Santiago de Guayaquil', 'hombre', 19, '1994-04-29', 'Azuay y Cañar', '', '', '2448192', '', '098489899', 'xavi_emelexista@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(19, 'Andy', 'Escobar', 'Santiago de Guayaquil', 'hombre', 20, '1993-10-09', 'Gral. Gomez y Sta. Elena', 'universitario', 'UPS', '2335883', NULL, '0971199493', 'xinoandyescobar@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(20, 'Adrián', 'Saavedra', 'Santiago de Guayaquil', 'hombre', 19, '1994-09-12', 'Cdla. Las Tejas mz4 V6', 'universitario', 'ESPOL', '2556621', '0997119493', NULL, 'adriansaavedra51@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(21, 'Pablo', 'Del Pozo', 'Santiago de Guayaquil', 'hombre', 19, '1994-06-22', 'Cdla. Pradera 1', 'universitario', 'ESPOL', '', '', '0984110129', 'pabloluis_2010@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(22, 'Brian', 'Acosta', 'Santiago de Guayaquil', 'hombre', 20, '1993-11-05', 'El Oro y García Moreno', 'universitario', 'UPS', '2447741', '', '0990273923', 'briansuas@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(23, 'Andrés', 'Chuqui', 'Santiago de Guayaquil', 'hombre', 21, '1992-08-20', 'Chambers y la Habana', '', '', '2342191', '0986442073', NULL, 'andres90@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(24, 'Geovanny', 'Nájera', 'Santiago de Guayaquil', 'hombre', 27, '1986-05-28', '20ava entre Letamendi y San Martin', 'universitario', 'FACSO', '2477331', '0993696321', NULL, 'geovannynajerah@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(25, 'Pedro', 'Ramirez', 'Santiago de Guayaquil', 'hombre', 28, '1986-07-27', 'Barrio Cuba', 'universitario', 'UPS', '5115235', '0995617644', '0996875896', 'pf_ramirezr@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(26, 'Francisco', 'Cruz', 'Santiago de Guayaquil', 'hombre', 28, '1985-08-09', 'Sauces 2', 'universitario', 'UPS', '2239388', '', '', 'franciscocruz907@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(27, 'Danilo', 'Bermeo', 'Santiago de Guayaquil', 'hombre', 28, '1985-02-14', 'Cdla. Las Acacias', 'universitario', NULL, '2442958', '0984601355', NULL, 'danilowin_149@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(28, 'Felix', 'Montoya', 'Santiago de Guayaquil', 'hombre', 32, '1981-05-26', 'Los Rios y Huancavilca', 'profesional', NULL, '2365749', '09995226540', NULL, 'nacfec@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(29, 'Hilda', 'Granda', 'Santiago de Guayaquil', 'mujer', 30, '1982-04-27', 'Coop. Cristina Ponguillo Mz F V10', 'profesional', NULL, '2346686', '0983336007', NULL, 'hildagranda15@hotmail.com', NULL, NULL, NULL, '', '', '0000-00-00', NULL, NULL),
(30, 'Verónica', 'Asanza', 'Santiago de Guayaquil', 'mujer', 29, '1984-02-26', 'Portal del Sol mz 1380 V23', 'profesional', NULL, '3903979', '0989051060', '098394125', 'veronica.asanza@gmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(31, 'Vanessa', 'Viteri', 'Santiago de Guayaquil', 'mujer', 27, '1984-01-29', 'Cdla. Las Acacias Bloque A2', 'profesional', 'ESPOL', '2331469', '0992260451', NULL, NULL, NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(32, 'Rosita', 'Castillo', 'Santiago de Guayaquil', 'mujer', 32, '1982-09-11', 'Cdla. Las Acacias Bloque A2', 'profesional', 'ESPOL', '2341129', NULL, '0985686119', 'rosita.castillo@gmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(33, 'Andrea', 'García', 'Santiago de Guayaquil', 'mujer', 30, '1986-07-31', 'José Mascote y Bolivia', 'profesional', 'ESPOL', '2366109', '0993258981', NULL, NULL, NULL, NULL, NULL, 'agrupado', 'activo', '0000-00-00', NULL, NULL),
(34, 'Catalina', 'Solis', 'Santiago de Guayaquil', 'mujer', 25, '1989-11-07', 'Cdla. Pradera 3 Mz D86 V3 ', 'profesional', 'ESPOL', '2556377', '0988044641', NULL, 'catita.isa79@gmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(35, 'Laiz', 'Larrea', 'Santiago de Guayaquil', 'mujer', 25, '1989-12-12', 'México 229 y Montevideo', 'universitario', 'UPS', '2445442', NULL, '098565583', 'mtopo_120@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(36, 'Libeth', 'Larrea', 'Santiago de Guayaquil', 'mujer', 23, '1991-05-10', 'México 229 y Montevideo ', 'universitario', 'ESTATAL', '2445442', '0995727702', NULL, 'libeth_lr@hotmail.com', NULL, NULL, NULL, 'agrupado', 'pasivo', '2014-01-01', NULL, NULL),
(37, 'Estefanía', 'Andrade', 'Santiago de Guayaquil', 'mujer', 24, '1990-04-06', 'Cdla. Pradera 3 mz D114 V3', 'universitario', 'UCSG', '2424593', NULL, '0999090030', 'nia_andrade16@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(38, 'Kristy', 'Cardenas', 'Santiago de Guayaquil', 'mujer', 25, '1989-03-27', 'Cdla. Guayacanes', 'universitario', 'ESTATAL', '2824695', '0993836769', NULL, 'kris_16_best@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(39, 'Stefanía', 'Icaza', 'Santiago de Guayaquil', 'mujer', 25, '1989-03-27', 'Cdla. Pradera 2 Bloque B1 Dep. 203', 'universitario', 'ESTATAL', '2433219', '0994525207', NULL, 'stefania_ikza@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(40, 'Nichole', 'Caamaño', 'Santiago de Guayaquil', 'mujer', 24, '1991-05-30', 'Lizardo García y Francisco Segura', 'universitario', 'ESTATAL', NULL, '0993408797', NULL, 'nadiacaamano@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(41, 'Ivette', 'Solórzano', 'Santiago de Guayaquil', 'mujer', 24, '1990-02-17', 'Nicolás Segovia y la A', 'profesional', 'ESPOL', '2342321', '0984606050', NULL, 'ivy_punk17@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(42, 'Sonia', 'Fiallos', 'Santiago de Guayaquil', 'mujer', 30, '1984-12-18', 'Cdla. Pradera 2 mz D30 V9', 'profesional', 'UCSG', '2438080', '0988668167', NULL, 'prettysoni16@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(43, 'Fallon', 'Tayo', 'Santiago de Guayaquil', 'mujer', 24, '1990-10-11', 'Pedro Pablo Gómez 1111 entre Los Ríos y Esmeraldas', 'universitario', 'ESTATAL', '2374930', '0979608825', NULL, 'fallontayo@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(44, 'Gabriela', 'Jaramillo', 'Santiago de Guayaquil', 'mujer', 31, '1983-06-08', 'Cdla. Pradera 2 mz D38 V40', 'universitario', 'UPS', '2433238', '0982751300', NULL, 'hello-gabby@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(45, 'Lissette', 'Roman', 'Santiago de Guayaquil', 'mujer', 25, '1989-01-20', 'Callejón Parra y la 30', 'universitario', 'ESPOL', '2841760', NULL, '0987924347', 'lissroman8@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(46, 'Cinthya', 'Ayauca', 'Santiago de Guayaquil', 'mujer', 26, '1988-02-28', 'Cdla. Sauces 9 mz 523 V19', 'profesional', 'UPS', '2574905', '0991142626', '098733289', 'cinthya_pao16@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(47, 'Rita', 'Gipsy', 'Santiago de Guayaquil', 'mujer', 31, '1983-04-14', 'Oriente 1312 y Washington', 'profesional', NULL, '2440988', '0985010461', NULL, 'gypsy24147@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(48, 'Susana', 'Gonzales', 'Santiago de Guayaquil', 'mujer', 31, '1983-02-23', 'Av. Domingo Comín y Pio Jaramillo', 'universitario', NULL, '2420480', '0989125649', NULL, 'susanax23@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(49, 'Jennifer', 'Mazza', 'Santiago de Guayaquil', 'mujer', 27, '1987-02-10', 'Cdla. Los Esteros mz 19 V71', 'profesional', 'UPS', '2490677', '0980110058', NULL, 'jennifer_87_2@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(50, 'Mariuxi', 'Villón', 'Santiago de Guayaquil', 'mujer', 28, '1986-05-11', 'Camilo Destruge 2714 y Leonidas Plaza', 'profesional', 'ESTATAL', '2361360', '0994340094', NULL, 'mariuxi.roma@gmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(51, 'Patricia', 'Parra', 'Santiago de Guayaquil', 'mujer', 24, '1990-07-25', 'Argentina 1805 y José Mascote', 'profesional', 'UCSG', '2363767', '0985712516', NULL, 'patricia_parra67m@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(52, 'Grace', 'Coronel', 'Santiago de Guayaquil', 'mujer', 25, '1989-04-03', 'Argentina 1805 y José Mascote', 'universitario', 'ESTATAL', '2363767', '0991154993', NULL, 'coronel_grace3489@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(53, 'María Fernanda', 'Desiderio', 'Santiago de Guayaquil', 'mujer', 20, '1994-08-24', 'La Habana 1101 y la C', 'universitario', 'ESPOL', '2346675', '0992058600', NULL, 'cutie_dm@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(54, 'Verónica', 'Muñoz', 'Santiago de Guayaquil', 'mujer', 19, '1995-01-20', 'Av. 25 de Julio y Vicente Trujillo', 'universitario', 'UCG', '5105584', '0969796421', NULL, 'lagatitaverito@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(55, 'Laura', 'Bravo', 'Santiago de Guayaquil', 'mujer', 19, '1995-05-30', 'Cdla. Las Acacias mz A7 V16', 'universitario', 'UCG', '2345411', '0983520304', NULL, 'lauri95_rvg@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(56, 'Katia Fernanda', 'Simbaña Brito', 'Santiago de Guayaquil', 'mujer', 20, '1994-06-05', 'Cdla. Los Esteros mz 45A V42', 'universitario', 'ESPOL', '2423144', '0989355260', '', 'katty_sb161@hotmail.com', '', '', NULL, 'agrupado', 'activo', '2014-01-01', '', '*****'),
(57, 'Diana', 'Fiallos', 'Santiago de Guayaquil', 'mujer', 20, '1995-03-18', 'Cdla. Pradera 2 mz D30 V9', 'universitario', 'UCSG', '2438080', '094093389', NULL, 'diana78_gfh@hotmail.com', NULL, NULL, NULL, 'agrupado', 'pasivo', '2014-01-01', NULL, NULL),
(58, 'Sara', 'Llopis', 'Santiago de Guayaquil', 'mujer', 19, '1994-08-29', NULL, 'universitario', 'UCSG', '2402253', '0969796421', NULL, 'saxitap_29@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL),
(59, 'Leslye', 'Cabrera', 'Santiago de Guayaquil', 'mujer', 20, '1994-11-11', 'Cdla. Las Acacias mz G5 V2', 'universitario', 'UCSG', '2346013', '0980052157', NULL, 'leslye.nicole@hotmail.com', NULL, NULL, NULL, 'agrupado', 'activo', '2014-01-01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `persona_centro_cargo_instancia`
--

CREATE TABLE IF NOT EXISTS `persona_centro_cargo_instancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `centro_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `instancia` varchar(500) CHARACTER SET utf8 NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `persona_centro_cargo_instancia`
--

INSERT INTO `persona_centro_cargo_instancia` (`id`, `persona_id`, `centro_id`, `cargo_id`, `instancia`, `fecha_creacion`, `fecha_fin`) VALUES
(1, 1, 1, 4, 'Santa María del Fiat', '2014-01-01', '0000-00-00'),
(7, 1, 1, 0, 'Campaña Navidad Es Jesús 2013', '2013-10-01', '2013-12-31'),
(8, 1, 1, 5, '', '2014-01-01', '0000-00-00'),
(10, 3, 1, 8, '', '2010-01-01', '0000-00-00'),
(11, 2, 2, 0, 'San Benito', '2014-01-01', '0000-00-00'),
(12, 1, 1, 0, 'Rosario Comunitario', '2014-01-09', '0000-00-00'),
(13, 3, 1, 0, 'S.S. Madre Peregrina Nigeria', '2014-01-16', '0000-00-00'),
(14, 1, 1, 0, 'Charla del Mes Enero', '2014-01-18', '0000-00-00'),
(15, 3, 1, 0, 'Charla del Mes Enero', '2014-01-18', '0000-00-00'),
(16, 3, 1, 0, 'S.S. Pan Para Mi Hermano', '2014-01-23', '0000-00-00'),
(17, 2, 2, 0, 'Jornada de Adviento 2013', '2013-12-07', '0000-00-00'),
(18, 2, 2, 0, 'Rosario Comunitario', '2014-01-04', '0000-00-00'),
(20, 2, 3, 13, '', '2014-01-01', '0000-00-00'),
(21, 1, 1, 11, '', '2012-01-01', '2013-01-01'),
(22, 2, 3, 7, '', '2014-01-16', '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
