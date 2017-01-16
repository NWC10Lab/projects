-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u6
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-01-2017 a las 09:48:45
-- Versión del servidor: 5.5.53
-- Versión de PHP: 5.4.45-0+deb7u5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `c91monitoringdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`code`, `username`, `password`, `active`, `timestamp`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 1, '2017-01-10 14:01:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_archivados`
--

CREATE TABLE IF NOT EXISTS `clientes_archivados` (
  `cde` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cde`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_favoritos`
--

CREATE TABLE IF NOT EXISTS `clientes_favoritos` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_zonas`
--

CREATE TABLE IF NOT EXISTS `clientes_zonas` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `clientes_zonas`
--

INSERT INTO `clientes_zonas` (`code`, `cliente_id`, `zona_id`, `timestamp`) VALUES
(1, 1, 28010, '2017-01-14 18:02:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leads`
--

CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anuncio` varchar(100) NOT NULL,
  `prop` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `precio` int(7) NOT NULL,
  `metros` int(2) NOT NULL,
  `dorm` int(2) NOT NULL,
  `aseos` int(2) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `enlace` varchar(100) NOT NULL,
  `directorio` varchar(10) NOT NULL,
  `zona` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=266 ;

--
-- Volcado de datos para la tabla `leads`
--

INSERT INTO `leads` (`id`, `anuncio`, `prop`, `tel`, `precio`, `metros`, `dorm`, `aseos`, `foto`, `enlace`, `directorio`, `zona`, `fecha`) VALUES
(239, 'CENTRO - VALLE INCLÁN', 'María José (Particular)', '607772879', 175000, 129, 3, 2, 'https://imgredirect.milanuncios.com/fp/1828/47/venta-de-pisos/centro-Valle-Inclán-182847565_1.jpg?t=14842201661150508243', 'http://www.milanuncios.com/venta-de-pisos-en-madrid-madrid/centro-182847565.htm', 'milanuncio', '28010', '2017-01-12 11:22:58'),
(253, 'Ático en venta en calle Otero, 3, Guindalera, Madrid', ' Particular - Angel ', ' 686 242 347 ', 320000, 110, 4, 2, 'https://img3.idealista.com/blur/WEB_DETAIL-M-P/0/id.pro.es.image.master/0d/2a/14/184315796.jpg', 'https://www.idealista.com/inmueble/35640852/', 'idealista', '28032', '2017-01-12 17:50:16'),
(254, 'Piso en venta en Vallehermoso, Madrid', ' Particular - Pablo ', ' 675 845 985 ', 279000, 72, 2, 1, 'https://img3.idealista.com/blur/WEB_DETAIL-M-L/0/id.pro.es.image.master/8b/fe/6a/184324830.jpg', 'https://www.idealista.com/inmueble/35641307/', 'idealista', '28010', '2017-01-12 18:30:39'),
(255, 'SALAMANCA', 'particular (Particular)', '629344261', 180000, 37, 1, 1, 'https://imgredirect.milanuncios.com/fp/2188/69/venta-de-pisos/Salamanca-Almería-8-218869406_1.jpg?t=14842615502118724551', 'http://www.milanuncios.com/venta-de-pisos-en-madrid-madrid/salamanca-218869406.htm', 'milanuncio', '28032', '2017-01-12 22:52:47'),
(256, 'Piso en venta en calle del General Oraá, 49, Castellana, Madrid', ' Particular - Teresa ', ' 686 976 898 ', 269000, 40, 1, 1, 'https://img3.idealista.com/blur/WEB_DETAIL-M-L/0/id.pro.es.image.master/07/94/35/183584721.jpg', 'https://www.idealista.com/inmueble/35594733/', 'idealista', '28032', '2017-01-13 10:10:11'),
(257, 'SALAMANCA - FRANCISCO SILVELA', 'Mar (Particular)', '608324311', 590000, 216, 4, 2, 'https://imgredirect.milanuncios.com/fp/2104/33/venta-de-pisos/Salamanca-Francisco-Silvela-210433037_1.jpg?t=14843101251534052720', 'http://www.milanuncios.com/venta-de-pisos-en-madrid-madrid/salamanca-210433037.htm', 'milanuncio', '28032', '2017-01-13 12:22:18'),
(260, '\r\n                Piso en Vallehermoso / Vallehermoso,  Madrid Capital\r\n            ', '\r\n            Daniel, particular\r\n        ', '', 540000, 147, 3, 2, 'http://www.fotocasa.es/Handlers/PhoneImageText.ashx?Text=A0E3C9693FBA13FBB5EC51DC09A247CE', 'http://www.fotocasa.es/vivienda/madrid-capital/calefaccion-parking-terraza-ascensor-no-amueblado-val', 'fotocasa', '28010', '2017-01-13 14:24:26'),
(261, '\r\n                Piso en  Alonso Cano, 78 / Ríos Rosas - Nuevos Ministerios,  Madrid Capital\r\n     ', '\r\n            Ivandga, particular\r\n        ', '', 170000, 34, 1, 1, 'http://www.fotocasa.es/Handlers/PhoneImageText.ashx?Text=81915AE57B13A73ED85F8EBFDB18A10C', 'http://www.fotocasa.es/vivienda/madrid-capital/calefaccion-ascensor-no-amueblado-alonso-cano-78-1410', 'fotocasa', '28010', '2017-01-13 14:26:20'),
(262, 'Piso en venta en calle Francisco Navacerrada, 36, Guindalera, Madrid', ' Particular - Olivia ', ' 604 376 463 ', 110000, 35, 1, 1, 'https://img3.idealista.com/blur/WEB_DETAIL-M-P/0/id.pro.es.image.master/6b/6e/e7/184495095.jpg', 'https://www.idealista.com/inmueble/35650880/', 'idealista', '28032', '2017-01-13 17:30:13'),
(263, 'Piso en venta en calle Boix y Morer, 9, Vallehermoso, Madrid', ' Particular - Fernando ', ' 636 515 998 ', 349000, 50, 1, 1, 'https://img3.idealista.com/blur/WEB_DETAIL-M-P/0/id.pro.es.image.master/51/20/9f/184474149.jpg', 'https://www.idealista.com/inmueble/35649805/', 'idealista', '28010', '2017-01-13 17:30:24'),
(264, 'CHAMBERI - JOSE ABASCAL 23', 'Celia (Particular)', '607955835', 320000, 57, 1, 1, 'https://imgredirect.milanuncios.com/fp/2202/16/venta-de-apartamentos/Chamberi-Jose-Abascal-23-220216031_1.jpg?t=1484334457302425334', 'http://www.milanuncios.com/venta-de-apartamentos-en-madrid-madrid/chamberi-220216031.htm', 'milanuncio', '28010', '2017-01-13 19:07:53'),
(265, 'CHAMBERI - SAGUNTO 14', 'Mercedes (Particular)', '600929484', 185000, 48, 2, 1, 'https://imgredirect.milanuncios.com/fp/2202/17/venta-de-pisos/Chamberi-Sagunto-14-220217829_1.jpg?t=1484336262538223677', 'http://www.milanuncios.com/venta-de-pisos-en-madrid-madrid/chamberi-220217829.htm', 'milanuncio', '28010', '2017-01-13 19:37:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
