-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-03-2020 a las 02:07:02
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `clinic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_medica`
--

CREATE TABLE IF NOT EXISTS `atencion_medica` (
  `id_atmedica` int(11) NOT NULL AUTO_INCREMENT,
  `receta` varchar(100) NOT NULL,
  `ficha` varchar(45) NOT NULL,
  `ordenes` varchar(45) NOT NULL,
  `pedidoMedico` varchar(45) NOT NULL,
  `diagnostico` varchar(45) NOT NULL,
  `turno` date NOT NULL,
  PRIMARY KEY (`id_atmedica`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `atencion_medica`
--

INSERT INTO `atencion_medica` (`id_atmedica`, `receta`, `ficha`, `ordenes`, `pedidoMedico`, `diagnostico`, `turno`) VALUES
(1, 'amoxidal 250 c/8hs', 'tratamiento odontologico', '011', 'cepillarse regularmente los dientes', 'infeccion en caries', '2019-12-24'),
(5, 'quraplus c/12 hs', 'prueba', '008', 'gripe ', 'caso leve', '2016-02-25'),
(6, 'lorazepan 1 mg c/12hs', 'ansiedad', '0046', 'descansar 8 hs diarias', 'caso leve', '2020-02-01'),
(7, 'paracetamol 500 c/8hs', 'dolor agudo', '009', 'reposo', 'tratamiento prolongado', '2020-02-12'),
(8, 'dipirona jbe cada 12 hs', 'prueba', '02', 'paÃ±os frios', 'fiebre aguda', '2019-01-12'),
(9, 'bronax flex cada 12hs', 'tratamiento prolongado', '0077', 'dolor agudo', 'escoliosis', '2018-05-05'),
(10, 'otosporin l 10 gotas cada 2 hs', 'prueba', '0152', 'mantener el oido en alto', 'otitis grave', '2017-08-15'),
(11, 'paracetamol 2 caja', 'fiebre', '0086', 'ingerir las pastillas durante una semana', 'tratamiento prolongado', '2020-02-22'),
(13, 'paracetamol 4 caja', 'fiebre', '5656', 'ingerir las pastillas durante tres semanas', 'caso leve', '2020-02-17'),
(14, 'paracetamol 5 cajas', 'fiebre', '1375', 'ingerir las pastillas durante tres semanas', 'caso leve', '2020-02-18'),
(15, 'paracetamol 2 cajas', 'fiebre', '1122', 'ingerir las pastillas durante tres semanas', 'caso leve', '2020-02-08'),
(16, 'aspirina c 240mg', 'dolor de cabeza', '11234', 'tomar una pastilla al dia', 'no es urgente', '2020-02-22'),
(17, 'ibuprofeno 400mg', 'congestiÃ³n', '10012', 'tomar la pastilla dos veces al dÃ­a ', 'no es urgente', '2020-02-28'),
(18, 'dolostop 650mg', 'estado gripal', '1102', 'ingerir el medicamento dos veces al dÃ­a', 'no es urgente', '2020-02-20'),
(19, 'omeprazol 20mg', 'catarro y malestar', '19922', 'ingerir receta dos veces a la semana', 'no es urgente', '2020-03-21'),
(20, 'Aspirina C 240mg', 'fiebre y vomitos', '11244', 'tomar los medicamentos dos veces al dÃ­a', 'Urgente', '2020-03-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `idcita` int(11) NOT NULL AUTO_INCREMENT,
  `citfecha` date NOT NULL,
  `cithorai` time NOT NULL,
  `cithoraf` time NOT NULL,
  `citPaciente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `citMedico` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `citConsultorio` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `citestado` enum('Asignado','atendido') COLLATE utf8_spanish_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `citobservaciones` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idcita`),
  KEY `cithora` (`cithorai`),
  KEY `idPaciente` (`citPaciente`),
  KEY `idMedico` (`citMedico`),
  KEY `idConsultorio` (`citConsultorio`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idcita`, `citfecha`, `cithorai`, `cithoraf`, `citPaciente`, `citMedico`, `citConsultorio`, `citestado`, `idUsuario`, `citobservaciones`) VALUES
(6, '2020-01-30', '14:30:00', '15:00:00', 'raul andres Gallardo', 'Andrea Mayra Perez', 'Pediatrico', 'Asignado', 1, ''),
(7, '2020-01-24', '15:30:00', '16:30:00', 'sergio  Perez', 'cintia Amaya', 'Odontologico', 'Asignado', 1, ''),
(9, '2020-02-21', '12:45:00', '13:45:00', 'Marina Bender', 'Sofia Molina', 'Oftalmologico', 'Asignado', 1, ''),
(10, '2020-01-08', '09:50:00', '09:58:00', 'Cortez Celeste', 'veronica soledad Ayala', 'Ecografia', 'Asignado', 1, ''),
(11, '2018-01-25', '07:20:00', '08:00:00', 'Mercedes Dalma', 'moises Tapia', 'CirugÃ­a', 'atendido', 1, ''),
(12, '2020-02-06', '17:00:00', '17:15:00', 'Luque Monica', 'veronica soledad Ayala', 'Ecografia', 'atendido', 1, ''),
(13, '2020-02-03', '09:33:00', '09:50:00', 'Lerda Lara', 'Andrea Mayra Perez', 'Pediatrico', 'atendido', 1, ''),
(14, '2019-11-12', '16:35:00', '17:42:00', 'Banega Maria', 'cintia Amaya', 'Odontologico', 'atendido', 1, ''),
(15, '2020-01-08', '07:32:00', '07:40:00', 'Juncos Tomas', 'mercedes alba Mercado', 'Kinesiologico', 'atendido', 1, ''),
(16, '2020-02-07', '12:00:00', '12:45:00', 'Veiga Marta', 'moises Tapia', 'Guardia', 'atendido', 1, ''),
(17, '2020-02-07', '14:03:00', '14:15:00', 'Tarditi Alberto', 'gabriel ernesto Gutierrez', 'Traumatologico', 'atendido', 1, ''),
(18, '2019-12-10', '19:15:00', '19:30:00', 'Sosa Ernesto', 'moises Tapia', 'Guardia', 'atendido', 1, ''),
(19, '2020-02-10', '09:12:00', '09:20:00', 'Gonzalez Melina', 'veronica soledad Ayala', 'Ecografia', 'atendido', 1, ''),
(23, '2020-02-18', '11:45:00', '12:45:00', 'Leandro Alberto Gomez', 'Andrea Mayra Perez', 'Odontologico', 'Asignado', 1, ''),
(24, '2020-02-18', '12:45:00', '13:45:00', 'Lautaro Tomas Acosta', 'Andrea Mayra Perez', 'Ecografia', 'Asignado', 1, ''),
(25, '2020-02-28', '13:45:00', '14:45:00', 'Lisandro Suarez', 'Andrea Mayra Perez', 'Kinesiologico', 'Asignado', 1, ''),
(26, '2020-02-29', '11:45:00', '12:45:00', 'Mariana Arias', 'Andrea Mayra Perez', 'Kinesiologico', 'Asignado', 1, ''),
(27, '2020-02-15', '16:45:00', '17:45:00', 'Matias Roberto Moralez', 'Sofia Molina', 'CirugÃ­a', 'atendido', 1, ''),
(28, '2019-11-14', '10:45:00', '12:45:00', 'Alberto Luis Romero', 'moises Tapia', 'Traumatologico', 'atendido', 1, ''),
(29, '2018-01-12', '08:33:00', '09:35:00', 'Ines Maria Tolosa', 'bianca Garcia', 'Pediatrico', 'atendido', 1, ''),
(30, '2019-11-15', '09:30:00', '10:30:00', 'Jorge Luis Soto', 'gabriel ernesto Gutierrez', 'CirugÃ­a', 'atendido', 1, ''),
(31, '2020-02-27', '19:45:00', '20:45:00', 'Albertina Carry', 'Andrea Mayra Perez', 'Kinesiologico', 'Asignado', 1, ''),
(32, '2020-03-04', '15:30:00', '16:30:00', 'Ramiro Ezequiel Ferrer', 'cintia Amaya', 'CirugÃ­a', 'Asignado', 1, ''),
(33, '2020-03-06', '17:00:00', '18:00:00', 'Maria Celeste Rojas', 'Sofia Molina', 'CirugÃ­a', 'Asignado', 1, ''),
(34, '2020-03-06', '12:00:00', '13:00:00', 'Raul Leonardo Sosa', 'cintia Amaya', 'Kinesiologico', 'Asignado', 1, ''),
(35, '2020-02-14', '13:50:00', '14:50:00', 'Clara Molina', 'Sofia Molina', 'Odontologico', 'Asignado', 1, 'Es urgente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE IF NOT EXISTS `consultorios` (
  `idConsultorio` int(11) NOT NULL AUTO_INCREMENT,
  `conNombre` char(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idConsultorio`),
  UNIQUE KEY `conNombre` (`conNombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`idConsultorio`, `conNombre`) VALUES
(2, 'CirugÃ­a'),
(5, 'Ecografia'),
(8, 'Guardia'),
(7, 'Kinesiologico'),
(4, 'Odontologico'),
(6, 'Oftalmologico'),
(1, 'Pediatrico'),
(3, 'Traumatologico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE IF NOT EXISTS `domicilio` (
  `idDomicilio` int(11) NOT NULL AUTO_INCREMENT,
  `calle` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `piso` int(11) DEFAULT NULL,
  `departamento` varchar(45) DEFAULT NULL,
  `codPostal` int(11) NOT NULL,
  `idLocalidad` int(11) NOT NULL,
  PRIMARY KEY (`idDomicilio`),
  UNIQUE KEY `idDomicilio` (`idDomicilio`),
  KEY `idBarrio` (`idLocalidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`idDomicilio`, `calle`, `numero`, `piso`, `departamento`, `codPostal`, `idLocalidad`) VALUES
(1, 'San Martin', 246, NULL, NULL, 1011, 2),
(2, 'Viamonte', 1037, NULL, NULL, 8002, 3),
(3, 'Sarmiento', 1005, NULL, NULL, 5022, 1),
(4, 'Belgrano', 102, NULL, NULL, 5022, 1),
(5, 'Zarate', 558, 0, '', 1032, 4),
(6, 'San Martin', 568, NULL, NULL, 1003, 2),
(7, 'Chiclana', 1165, NULL, NULL, 1003, 2),
(13, 'Belgrano', 1222, NULL, NULL, 5008, 1),
(14, 'Rodriguez', 1037, NULL, NULL, 1011, 2),
(16, 'Castelli', 123, 0, '', 8002, 3),
(17, 'Alberdi', 1207, 0, '', 8002, 3),
(18, 'Socrates', 1298, 0, '', 8002, 3),
(21, 'Pacifico', 1067, 0, '', 8002, 4),
(22, 'San Luis', 254, 0, '', 2455, 10),
(23, 'San Martin', 0, 0, '', 4477, 12),
(24, 'Belgrano', 474, 0, '', 2516, 6),
(25, 'Jose Manuel Celayes ', 354, 0, '', 5225, 1),
(26, 'Santa Fe', 0, 0, '', 4357, 6),
(27, 'Luna', 1366, 0, '', 5877, 4),
(28, 'Lorenzi ', 235, 0, '', 6654, 8),
(29, 'Cordoba', 0, 0, '', 5000, 1),
(30, 'Rosales', 1085, 0, '', 0, 3),
(31, 'Rosales', 1009, 0, '', 0, 3),
(32, 'Sarmiento', 1002, 0, '', 0, 3),
(33, 'Mallea', 1293, 0, '', 8002, 3),
(34, 'Sarmiento', 1122, 0, '', 8002, 3),
(35, 'Rosales', 2912, 0, '', 8002, 3),
(36, 'Donado', 123, 0, '', 8002, 3),
(38, 'Viamonte', 1549, 0, '', 8002, 16),
(40, 'Rosario', 1234, 10, 'A', 5021, 1),
(41, 'Alvear', 125, 0, '', 5012, 1),
(42, 'Viamonte', 3450, 0, '', 5012, 1),
(43, 'Chiclana', 98, 0, '', 5012, 1),
(44, 'Viamonte', 1421, 0, '', 5012, 1),
(45, 'Inglaterra', 987, 0, '', 8002, 3),
(46, 'Terrada', 1543, 0, '', 8003, 3),
(47, 'Castelli', 78, 0, '', 8003, 3),
(48, 'Sixto Laspiur', 998, 0, '', 8002, 3),
(49, 'Soler', 1148, 0, '', 5002, 3),
(50, 'Viamonte', 2001, 0, '', 8000, 3),
(51, 'Rosario ', 1222, 0, '', 8000, 1),
(52, 'viamonte', 122, 0, '', 8000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE IF NOT EXISTS `especialidades` (
  `idespecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `espNombre` char(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idespecialidad`),
  UNIQUE KEY `espNombre` (`espNombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`idespecialidad`, `espNombre`) VALUES
(6, 'Ecografia'),
(7, 'Fisioterapia'),
(9, 'Guardia'),
(4, 'Odontologia'),
(2, 'Oftalmologia'),
(1, 'Pediatria'),
(5, 'Psicologia'),
(3, 'Traumatologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE IF NOT EXISTS `historia_clinica` (
  `id_hclinica` int(11) NOT NULL AUTO_INCREMENT,
  `datosPacientes` varchar(45) NOT NULL,
  `fechaAlta` date NOT NULL,
  `enfermedades` varchar(100) NOT NULL,
  `cirugias` varchar(50) NOT NULL,
  `medicamentos` varchar(50) NOT NULL,
  `obraSocial` varchar(45) NOT NULL,
  `idAtencion` int(11) NOT NULL,
  PRIMARY KEY (`id_hclinica`),
  KEY `idAtencion` (`idAtencion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `historia_clinica`
--

INSERT INTO `historia_clinica` (`id_hclinica`, `datosPacientes`, `fechaAlta`, `enfermedades`, `cirugias`, `medicamentos`, `obraSocial`, `idAtencion`) VALUES
(1, 'Rodrigo Mena', '2019-12-28', 'Fiebre', 'ninguna', 'sesiones semanales', 'IOMA', 1),
(4, 'Marcela Romero', '2020-01-05', 'cancer', 'ninguna', 'sesiones semanales', 'OSECAC', 5),
(5, 'Hector Gonzalez', '2019-12-18', 'artrosis', 'ninguna', 'artrait 15 mg x 8', 'PAMI', 6),
(6, 'Pamela Leiva', '2020-02-12', 'gastritis', 'ninguna', 'ranitidina', 'OSDE', 7),
(7, 'Guillermo Andres Suarez', '2020-02-03', 'asma', 'Si', 'seretide x 120 dosis', 'OSPRERA', 10),
(8, 'marina  bender', '2020-02-14', 'fiebre', 'ninguno', 'amoxidal', 'apross', 14),
(9, 'juan pablo baydas', '2020-02-14', 'fiebre y otros dolores', 'Ninguna', 'paracetamol', 'apross', 15),
(12, 'romina ana arias', '2020-02-28', 'fiebre y catarro', 'no', 'omeprazol 20mg', 'apross', 15),
(13, 'lorena angela pezutti', '2020-03-07', 'dolor de cabeza', 'no', 'aspirina c 240mg', 'apross', 16),
(14, 'hilda molina', '2020-03-15', 'congestiÃ³n', 'no', 'paracetamol 500mg', 'osprera', 17),
(15, 'alberto luis  romero', '2020-03-22', 'estado gripal y vomitos', 'no', 'dolostop 650mg', 'medicus', 18),
(16, 'ines maria tolosa', '2020-03-07', 'catarro', 'no', 'Dolostop 650mg', 'ospjn', 19),
(19, 'Jorge Luis Soto', '2020-03-19', 'fiebre y vomitos', 'no', 'Aspirina C 240mg', 'osde', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE IF NOT EXISTS `localidad` (
  `idLocalidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `idProvincia` int(11) NOT NULL,
  PRIMARY KEY (`idLocalidad`),
  KEY `idProvincia` (`idProvincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`idLocalidad`, `nombre`, `idProvincia`) VALUES
(1, 'Cordoba', 2),
(2, 'Buenos Aires', 1),
(3, 'Bahía Blanca', 1),
(4, 'La Plata', 1),
(5, 'Mar del Plata', 1),
(6, 'Rosario', 3),
(7, 'Santa Fe', 3),
(8, 'Mendoza', 9),
(9, 'Río Cuarto', 2),
(10, 'Villa María', 2),
(11, 'Tandil', 1),
(12, 'San Miguel de Tucumán', 8),
(13, 'Necochea', 1),
(14, 'Rio Gallegos', 4),
(15, 'Monte Hermoso', 1),
(16, 'Punta Alta', 1),
(18, 'Sierra de la Ventana', 1),
(19, 'Pinamar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE IF NOT EXISTS `medicamento` (
  `idmedicamento` int(11) NOT NULL AUTO_INCREMENT,
  `mednombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idmedicamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`idmedicamento`, `mednombre`) VALUES
(1, 'Paracetamol 500mg'),
(2, 'Paracetamol 650mg'),
(3, 'Aspirina C 240mg'),
(4, 'Aspirina C 400mg'),
(5, 'Aspirina Plus 50mg'),
(6, 'Ibuprofeno 400mg'),
(7, 'Ibuprofeno 600mg'),
(8, 'Dolostop 650mg'),
(9, 'Omeprazol 40mg'),
(10, 'Omeprazol 20mg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE IF NOT EXISTS `medicos` (
  `idMedico` int(11) NOT NULL AUTO_INCREMENT,
  `medidentificacion` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `medEspecialidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medingreso` date NOT NULL,
  `idPersona` int(11) NOT NULL,
  PRIMARY KEY (`idMedico`),
  UNIQUE KEY `medidentificacion` (`medidentificacion`),
  KEY `medpersona` (`idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`idMedico`, `medidentificacion`, `medEspecialidad`, `medingreso`, `idPersona`) VALUES
(4, '10166', 'Oftalmologia', '2020-02-09', 7),
(5, '00342', 'Pediatria', '2020-02-09', 8),
(10, '12009', 'Traumatologia', '2020-02-09', 25),
(12, '13067', 'Ecografia', '2020-02-10', 26),
(13, '13009', 'Odontologia', '2020-02-10', 27),
(14, '54781', 'Pediatria', '2017-09-26', 44),
(15, '01787', 'Fisioterapia', '2019-06-06', 45),
(16, '18874', 'Guardia', '2015-06-29', 46);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_social`
--

CREATE TABLE IF NOT EXISTS `obra_social` (
  `id_obrasocial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id_obrasocial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `obra_social`
--

INSERT INTO `obra_social` (`id_obrasocial`, `nombre`) VALUES
(1, 'IOMA'),
(2, 'OSPJN'),
(3, 'OSDE'),
(4, 'MEDICUS'),
(5, 'OSECAC'),
(6, 'PAMI'),
(7, 'APROSS'),
(8, 'OSPRERA'),
(9, 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `pacSexo` enum('Femenino','Masculino') COLLATE utf8_spanish_ci NOT NULL,
  `PacObraSocial` int(11) NOT NULL,
  `pacEstado` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPaciente`),
  KEY `idPersona` (`idPersona`),
  KEY `PacObraSocial` (`PacObraSocial`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`idPaciente`, `idPersona`, `pacSexo`, `PacObraSocial`, `pacEstado`) VALUES
(4, 30, 'Masculino', 3, 'Dado de alta'),
(5, 31, 'Femenino', 5, 'Dada de alta'),
(6, 32, 'Masculino', 7, 'Dado de alta'),
(7, 39, 'Femenino', 7, 'dado de alta'),
(8, 40, 'Masculino', 8, 'dado de alta'),
(9, 41, 'Femenino', 4, 'dado de alta'),
(10, 42, 'Masculino', 8, 'dado de alta'),
(11, 43, 'Femenino', 2, 'dado de alta'),
(12, 50, 'Masculino', 1, 'Dado de alta'),
(13, 52, 'Femenino', 3, 'Dado de alta'),
(14, 55, 'Femenino', 5, 'Dado de alta'),
(16, 57, 'Femenino', 2, 'Dado de alta'),
(17, 58, 'Masculino', 6, 'Asignado'),
(18, 59, 'Femenino', 4, 'Asignado'),
(19, 60, 'Masculino', 8, 'Dado de alta'),
(20, 61, 'Femenino', 1, 'Dado de alta'),
(21, 62, 'Masculino', 1, 'Dado de alta'),
(22, 63, 'Femenino', 1, 'Dado de alta'),
(23, 64, 'Masculino', 4, 'Asignado'),
(24, 65, 'Femenino', 3, 'Asignado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `telefono` int(19) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `dni` int(11) NOT NULL,
  `idDomicilio` int(11) NOT NULL,
  PRIMARY KEY (`idPersona`),
  UNIQUE KEY `idPersona` (`idPersona`),
  KEY `idTipoDni` (`dni`),
  KEY `idDomicilio` (`idDomicilio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `nombre`, `apellido`, `fechaNacimiento`, `telefono`, `email`, `dni`, `idDomicilio`) VALUES
(7, 'Sofia', 'Molina', '1970-02-03', 2147483647, 'smolina@gmail.com', 27006447, 2),
(8, 'Andrea Mayra', 'Perez', '1982-06-09', 351470012, 'aperez@gmail.com', 30124302, 5),
(25, 'gabriel ernesto', 'Gutierrez', '1981-05-14', 4512632, 'ggutierrez@gmail.com', 29129086, 3),
(26, 'veronica soledad', 'Ayala', '1989-03-03', 4556698, 'vayala@gmail.com', 35271608, 16),
(27, 'cintia', 'Amaya', '1988-11-30', 4550010, 'camaya@gmail.com', 34201608, 17),
(30, 'Guillermo Andres', 'Suarez', '1988-07-10', 2147483647, 'gsuarez@gmail.com', 34022546, 4),
(31, 'Marina ', 'Bender', '1990-02-04', 2147483647, 'mbender@gmail.com', 36998106, 13),
(32, 'Ramiro Emiliano', 'Dietrich', '1977-03-24', 2147483647, 'rdietrich@gmail.com', 29129012, 18),
(34, 'Sebastian', 'Suarez', '1982-07-11', 154787342, 'ssuarez@gmail.com', 31011802, 1),
(35, 'Pablo Daniel', 'Sosa', '1990-02-11', 154987521, 'psosa@gmail.com', 36002987, 7),
(38, 'Nahuel Guillermo', 'Matz', '1998-03-22', 154154792, 'pmatz@gmail.com', 39920123, 21),
(39, 'Pamela', 'Leiva', '1997-01-25', 224487759, 'pamelei@gmail.com', 47245985, 22),
(40, 'Hector', 'Gonzalez', '1964-07-25', 447874759, 'hectorg@hotmail.com', 55574866, 23),
(41, 'Marcela', 'Romero', '1975-02-05', 2147483647, 'marcela@gmail.com', 12475694, 24),
(42, 'Juan Pablo', 'Baydas', '2000-10-14', 2147483647, 'juanb@gmail.com', 54786952, 25),
(43, 'Antonia Romina', 'Medina', '2014-05-15', 2147483647, 'antom@gmail.com', 53474758, 26),
(44, 'Bianca Maria', 'Sanchez', '1987-06-05', 4517874, 'biancasanchez@gmail.com', 32212555, 27),
(45, 'mercedes alba', 'Mercado', '1961-04-25', 2147483647, 'albam@hotmail.com', 14668887, 28),
(46, 'moises', 'Tapia', '1978-07-26', 4512234, 'tapiam@hotmail.com', 35477621, 29),
(47, 'veronica romina', 'Albanesi', '1994-12-01', 2147483647, 'valbanesi@gmail.com', 36286123, 30),
(48, 'Edgar Andres', 'Molinas', '1996-12-06', 2147483647, 'emolinas@gmail.com', 36001987, 31),
(49, 'ramiro ricardo', 'Molinaz', '1996-01-05', 2147483647, 'rmolinaz@gmail.com', 38122001, 32),
(50, 'leandro tomas', 'Guituierrez', '1992-01-17', 2147483647, 'lguituierrez@gmail.com', 36001442, 33),
(51, 'Luis carlos', 'Puyol', '1992-01-03', 2147483647, 'tpuyol@gmail.com', 30123921, 34),
(52, 'romina ana', 'Arias', '2000-02-11', 2147483647, 'rarias@gmail.com', 35199212, 35),
(53, 'ana belen', 'Mozas', '1982-02-12', 2147483647, 'moza@gmail.com', 30123051, 36),
(55, 'lorena angela', 'Pezutti', '1977-02-04', 4546470, 'lpezutti@gmail.com', 28210364, 38),
(57, 'hilda', 'Molina', '1978-01-06', 4515678, 'hmolina@gmail.com', 28123006, 40),
(58, 'Alberto Luis ', 'Romero', '1975-02-06', 4561209, 'aromero@gmail.com', 26123982, 41),
(59, 'Ines Maria', 'Tolosa', '1972-07-12', 4516790, 'mtolosa@gmail.com', 24001997, 42),
(60, 'Jorge Luis', 'Soto', '1968-05-12', 4567809, 'jsoto@gmail.com', 20998074, 43),
(61, 'Albertina ', 'Carry', '1996-02-24', 4551008, 'acarry@gmail.com', 37002112, 44),
(62, 'Ramiro Ezequiel', 'Ferrer', '1986-06-12', 4510087, 'rferrer@gmail.com', 32009129, 45),
(63, 'Maria Celeste', 'Rojas', '1990-12-12', 4556798, 'mrojas@gmail.com', 34506991, 46),
(64, 'Raul Leonardo', 'Sosa', '1994-08-21', 4512398, 'rsosa@gmail.com', 36002993, 47),
(65, 'Clara', 'Molina', '1982-10-11', 4560029, 'cmolina@gmail.com', 31005424, 48),
(69, 'leandro', 'sosa', '2020-01-08', 451567722, 'dleo22@gmail.com', 30123011, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `idProvincia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`idProvincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idProvincia`, `nombre`) VALUES
(1, 'Buenos Aires'),
(2, 'Cordoba'),
(3, 'Santa Fe'),
(4, 'Santa Cruz'),
(5, 'La Pampa'),
(6, 'Tierra del Fuego'),
(7, 'Catamarca'),
(8, 'Tucumán'),
(9, 'Mendoza'),
(10, 'Chubut');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaIngreso` date NOT NULL,
  `idPersona` int(11) NOT NULL,
  `Roll` varchar(15) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Limitado',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `idPersona` (`idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `fechaIngreso`, `idPersona`, `Roll`) VALUES
(1, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', '2020-02-11', 34, 'admin'),
(4, 'psosa', '2f119ad3ddc2cb3d099479f9b0adaaeafe92bcad8bf2edce4941cb1d7c00c38f4030438952cdba66f1044ddc98fbe9b8b6d6c384b9df4061aeb097dc2bf543eb', '2020-02-11', 35, 'Limitado'),
(9, 'pmatz', 'b3892ba357ba3217d9d02f98a5f1379058513caad7c83e02876884037364f31537bd07eeec4d59508b6c44a6ebb22d96345a5c7ce5fa20be6ce6d7beafe52340', '2020-02-11', 38, 'Limitado');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `domicilio_ibfk_5` FOREIGN KEY (`idLocalidad`) REFERENCES `localidad` (`idLocalidad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD CONSTRAINT `historia_clinica_ibfk_1` FOREIGN KEY (`idAtencion`) REFERENCES `atencion_medica` (`id_atmedica`) ON DELETE CASCADE;

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `localidad_ibfk_2` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`idProvincia`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `medicos_ibfk_3` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_3` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pacientes_ibfk_4` FOREIGN KEY (`PacObraSocial`) REFERENCES `obra_social` (`id_obrasocial`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_5` FOREIGN KEY (`idDomicilio`) REFERENCES `domicilio` (`idDomicilio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
