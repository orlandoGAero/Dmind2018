-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-08-2015 a las 00:24:30
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `digitalm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areacontacto`
--

CREATE TABLE IF NOT EXISTS `areacontacto` (
  `id_areacontacto` int(10) NOT NULL,
  `nombre_areacontacto` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `areacontacto`
--

INSERT INTO `areacontacto` (`id_areacontacto`, `nombre_areacontacto`) VALUES
(1, 'Compras'),
(2, 'Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(10) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'Video'),
(2, 'Voz'),
(3, 'Datos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_cliente`
--

CREATE TABLE IF NOT EXISTS `categoria_cliente` (
  `id_categoria_cliente` int(10) NOT NULL DEFAULT '0',
  `nombre_categoria_cliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_cliente`
--

INSERT INTO `categoria_cliente` (`id_categoria_cliente`, `nombre_categoria_cliente`) VALUES
(1, 'Cableados'),
(2, 'Electronica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(10) NOT NULL,
  `nombre_cliente` varchar(70) NOT NULL,
  `razonSocial` varchar(70) NOT NULL,
  `fecha_alta` varchar(10) NOT NULL,
  `id_datfiscal` varchar(50) NOT NULL,
  `id_direccion` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `id_contacto` varchar(50) DEFAULT NULL,
  `id_bancarios` varchar(30) NOT NULL,
  `id_categoria_cliente` int(10) NOT NULL,
  `direccion_web` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `razonSocial`, `fecha_alta`, `id_datfiscal`, `id_direccion`, `telefono`, `id_contacto`, `id_bancarios`, `id_categoria_cliente`, `direccion_web`) VALUES
(1, 'IVAN PEÑALOZA CARDENAS', 'Vivotek SA de CV', '2015-07-16', '4', '7', '2712211', '1', '1', 1, 'www.miweb.coms'),
(2, 'Jose Pedroza Mendes', 'Server SA de Cv', '2015-07-16', '5', '13', '123456789', '0', '5', 1, 'www.ww..ww'),
(8, '', '', '2015-08-10', '13', '29', '', '0', '12', 0, ''),
(7, 'Empresa', 'Empresa SA de SV', '2015-08-10', '12', '25', '1234567890', '0', '11', 2, 'www.empresa.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientexcontacto`
--

CREATE TABLE IF NOT EXISTS `clientexcontacto` (
  `id` int(5) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_contacto` int(5) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientexcontacto`
--

INSERT INTO `clientexcontacto` (`id`, `id_cliente`, `id_contacto`) VALUES
(27, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE IF NOT EXISTS `contactos` (
  `id_contacto` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_alta` varchar(50) NOT NULL,
  `id_direccion` int(15) NOT NULL,
  `id_areacontacto` int(15) NOT NULL,
  `telefono_casa` varchar(11) DEFAULT NULL,
  `tel_oficina` varchar(11) DEFAULT NULL,
  `tel_emergencia` varchar(11) DEFAULT NULL,
  `movil` varchar(11) DEFAULT NULL,
  `email_personal` varchar(50) NOT NULL,
  `email_institucion` varchar(50) NOT NULL,
  `facebook` varchar(70) DEFAULT NULL,
  `direccion_web` varchar(70) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `skype` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id_contacto`, `nombre`, `fecha_alta`, `id_direccion`, `id_areacontacto`, `telefono_casa`, `tel_oficina`, `tel_emergencia`, `movil`, `email_personal`, `email_institucion`, `facebook`, `direccion_web`, `twitter`, `skype`) VALUES
(1, 'IVAN PEÑALOZA CARDENAS', '2014-07-07', 1, 1, '44444', '222222', '22222', '2712211', 'emprespers@as-s', 'ross@empresa.com', 'empres', 'www.miweb.coms', 'empres', 'empress2'),
(2, 'jose espinoza', '2015-07-14', 2, 1, '5678901234', '0987654321', '911', '1234567890', 'pers@personal.com', 'empresa@empres.cpm', 'empresa21', 'empresa21.xom', '@empreslas22', 'no'),
(3, 'emman', '2015-08-08', 14, 1, '7223456733', '7223456738', '', '7223456738', 'info@terra.om.mx', '', '', '', '', ''),
(4, 'emmanuel', '2015-08-10', 28, 1, '', '7222276149', '', '7224800907|', 'info@digitalmind.com', 'erespejel@digitalmind.com.mx', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE IF NOT EXISTS `cotizacion` (
  `id_cotizacion` int(10) NOT NULL,
  `folio` int(11) DEFAULT NULL,
  `fecha` varchar(30) DEFAULT NULL,
  `id_cliente` int(10) DEFAULT NULL,
  `id_moneda` int(10) NOT NULL,
  `subtotal` double DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `guardada` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`id_cotizacion`, `folio`, `fecha`, `id_cliente`, `id_moneda`, `subtotal`, `iva`, `total`, `estado`, `guardada`) VALUES
(1, 1, '2015-07-06', 1, 2, 600, 0, 600, 1, 1),
(2, 2, '2015-08-19', 1, 1, 4, 0, 4, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_bancarios`
--

CREATE TABLE IF NOT EXISTS `datos_bancarios` (
  `id_bancarios` int(10) NOT NULL,
  `nombre_banco` varchar(70) NOT NULL,
  `sucursal` varchar(50) NOT NULL,
  `titular` varchar(70) NOT NULL,
  `no_cuenta` int(20) NOT NULL,
  `clave_interbancaria` int(18) NOT NULL,
  `tipo_cuenta` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_bancarios`
--

INSERT INTO `datos_bancarios` (`id_bancarios`, `nombre_banco`, `sucursal`, `titular`, `no_cuenta`, `clave_interbancaria`, `tipo_cuenta`) VALUES
(1, 'HSBC', 'Toluca', 'Rosalina', 2147483647, 1234567, 'Cheques'),
(2, 'HSBC', 'Metepec', 'Juan CV', 2147483647, 1234567, 'Cheques'),
(3, 'banam', '4', 'manolo', 34664782, 0, 'Debito'),
(5, 'Santander', '12', 'Jose Pedroza Mendes', 19992, 123, 'credito'),
(4, 'HSBC', 'plaza', 'Emanuel Espejel', 345678, 1234, 'Cheques'),
(6, '', '', '', 0, 0, ''),
(7, '', '', '', 0, 0, ''),
(8, '', '', '', 0, 0, ''),
(9, '', '', '', 0, 0, ''),
(10, 'HSBC', 'Uno', 'Jorge Beltran Lopez', 345678, 3647, 'Cheques'),
(11, 'HSBC', 'Santa Fe', 'Jorge Beltran Lopez', 2147483647, 3647, 'Cheques'),
(12, '', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_fiscales`
--

CREATE TABLE IF NOT EXISTS `datos_fiscales` (
  `id_datfiscal` int(10) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `tipo_razon_social` varchar(30) NOT NULL,
  `id_direccion` int(10) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_fiscales`
--

INSERT INTO `datos_fiscales` (`id_datfiscal`, `razon_social`, `rfc`, `tipo_razon_social`, `id_direccion`, `email`) VALUES
(1, 'Vivotek SA de CV', 'VIV010203TEK', 'Moral', 1, 'ross@empresa.com'),
(2, 'Vivotek SA de CVs', 'VIV010203TEKs', 'Social', 3, 'soporte@vivotek.coms'),
(6, 'Digital Mind', 'DFR675GGS', 'Moral', 12, 'admin@digitalm.com'),
(5, 'Server SA de Cv', 'SRSTREJJ6788', 'Social', 7, 'soporte@server.com'),
(4, 'Vivotek SA de CV', 'VIV010203TEK', 'Moral', 9, 'ross@empresa.com'),
(7, '', '', 'Moral', 16, ''),
(8, '', '', 'Moral', 18, ''),
(9, '', '', 'Moral', 20, ''),
(10, '', '', 'Moral', 22, ''),
(11, 'Empresa SA de SV', 'EMPR120221EREE', 'Moral', 24, 'empresa@empresa.em'),
(12, 'Empresa SA de SV', 'EMPR120221EREE', 'Social', 26, 'empresa@empresa.em'),
(13, '', '', 'Moral', 30, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cotizacion`
--

CREATE TABLE IF NOT EXISTS `detalle_cotizacion` (
  `id_cotizacion` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 NOT NULL,
  `nota` varchar(500) DEFAULT NULL,
  `id_producto` int(100) NOT NULL,
  `cantidad` double NOT NULL,
  `precio` double NOT NULL,
  `importe` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_cotizacion`
--

INSERT INTO `detalle_cotizacion` (`id_cotizacion`, `descripcion`, `nota`, `id_producto`, `cantidad`, `precio`, `importe`) VALUES
(1, 'Camara -TT101P Balun EPCOM', '  \r\n', 5, 2, 300, 600),
(1, 'Telefono -telip-2y telefonos inalambricos UBIQUITI', '  \r\n', 24, 2, 1200, 0),
(2, 'Camara-Wantfon telefono inalambrico Rocket', '  \r\n', 1, 2, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id_venta` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `nota` varchar(400) DEFAULT NULL,
  `id_producto` int(20) NOT NULL,
  `no_serie` int(40) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `importe` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_venta`, `descripcion`, `nota`, `id_producto`, `no_serie`, `cantidad`, `precio`, `importe`) VALUES
(1, 'Camara-Wantfon 11 telefono inalambrico Rocket', '  \r\n', 1, 11, 1, 32.88, 32.88);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE IF NOT EXISTS `direcciones` (
  `id_direccion` int(10) NOT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `num_ext` varchar(20) DEFAULT NULL,
  `num_int` varchar(20) DEFAULT NULL,
  `colonia` varchar(50) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  `municipio` text,
  `estado` text,
  `pais` varchar(200) DEFAULT NULL,
  `cod_postal` int(5) DEFAULT NULL,
  `sucursal` varchar(100) DEFAULT NULL,
  `gps_ubicacion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id_direccion`, `calle`, `num_ext`, `num_int`, `colonia`, `localidad`, `referencia`, `municipio`, `estado`, `pais`, `cod_postal`, `sucursal`, `gps_ubicacion`) VALUES
(1, 'Morelos', '150', '12', 'Centro', 'toluca', 'ssss', 'Toluca', 'Edo. Mexico', 'mexico', 235, '1', ''),
(2, 'pino suarez', '12', '8', 'sor juana', 'zinacantepec', 'al lado de elecktra', 'Xochimilco', 'Mexico', 'mexico', 50400, '1', 'ss'),
(3, 'juarez', '12', '11', 'Centroo', 'San pedro', 'escuela primaria', 'Toluca', 'Edo. Mexicooo', NULL, 50440, '1', 'ascaosucahiochuiashciu'),
(4, 'sdfgh', '1', '2', 'asdfgh', 'La piedra', 'asdfghjkl', 'Toluca', 'asouh', 'mexico', 1234, '1', ''),
(7, 'juarez', '12', '11', 'Centroo', 'La peña', 'escuela primaria', 'Metepec', 'Mexicooo', 'mexico', 50440, '1', 'ascaosucahiochuiashciu'),
(8, 'juarez', '12', '11', 'Centroo', 'cuautla', 'escuela primaria', 'Cuautla', 'Mexicooo', 'mexico', 50440, '1', 'ascaosucahiochuiashciu'),
(9, 'juarez', '12', '11', 'Centroo', 'La peña', 'escuela primaria', 'Metepec', 'Mexicooo', 'mexico', 50440, '1', 'ascaosucahiochuiashciu'),
(10, 'juarez', '12', '11', 'Centroo', 'cuautla', 'escuela primaria', 'Cuautla', 'Mexicooo', 'mexico', 50440, '1', 'ascaosucahiochuiashciu'),
(11, 'Tollocan', '2007', '2008', 'Matlazincas', 'La teresona', 'cortina amarilla', 'Toluca', 'Edo. México', 'México', 2008, '', ''),
(12, 'Tollocan', '2007', '2008', 'Matlazincas', 'La teresona', 'cortina amarilla', 'Toluca', 'Edo. México', NULL, 2008, NULL, NULL),
(13, 'juarez', '12', '11', 'Centroo', 'La peña', 'escuela primaria', 'Metepec', 'Mexicooo', 'mexico', 50440, '1', ''),
(14, 'manuel', '140', 'b', 'carlos hank', '', '', 'toluca', 'mex', 'mex', 50029, '', ''),
(15, '', '', '', '', '', '', '', '', '', 0, '', ''),
(16, '', '', '', '', '', '', '', '', '', 0, NULL, ''),
(17, '', '', '', '', '', '', '', '', '', 0, '', ''),
(18, '', '', '', '', '', '', '', '', '', 0, NULL, ''),
(19, '', '', '', '', '', '', '', '', '', 0, '', ''),
(20, '', '', '', '', '', '', '', '', '', 0, NULL, ''),
(21, '', '', '', '', '', '', '', '', '', 0, '', ''),
(22, '', '', '', '', '', '', '', '', '', 0, NULL, ''),
(23, 'Benito Juarez', '2131', '2344', 'Valle de las Monjas', 'San Mateo', 'Poston amarillo', 'Cuajimalpa', 'Distrito Federal', 'México', 11111, '', 'S/n'),
(24, 'Benito Juarez', '2131', '2344', 'Valle de las Monjas', 'San Mateo', 'Poston amarillo', 'Cuajimalpa', 'Distrito Federal', 'México', 11111, NULL, NULL),
(25, 'Benito Juarez', '2131', '2344', 'Valle de las Monjas', 'San Mateo', 'Poston amarillo', '', 'Distrito Federal', 'México', 11111, 'Santa Fe', ''),
(26, 'Benito Juarez', '2131', '2344', 'Valle de las Monjas', 'San Mateo', 'Poston amarillo', 'Cuajimalpa', 'Distrito Federal', 'México', 11111, NULL, ''),
(27, '', '', '', '', '', '', '', '', '', 0, '', ''),
(28, 'manuel', '140', 'b', 'hank', '', '', 'toluca', 'mexico', 'Mexico', 50026, '', ''),
(29, '', '', '', '', '', '', '', '', '', 0, '', ''),
(30, '', '', '', '', '', '', '', '', '', 0, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `division`
--

CREATE TABLE IF NOT EXISTS `division` (
  `id_division` int(10) NOT NULL,
  `nombre_division` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `division`
--

INSERT INTO `division` (`id_division`, `nombre_division`) VALUES
(1, 'CCTV'),
(2, 'VoIP'),
(3, 'Telefonia'),
(4, 'Cableado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE IF NOT EXISTS `entregas` (
  `ID_ENTREGA` int(10) NOT NULL,
  `FOLIO` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `CANTIDAD` int(5) NOT NULL,
  `ID_INVENTARIO` int(10) NOT NULL,
  `id_contacto` int(10) NOT NULL,
  `ARCHIV_COMPR_TRANS` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` int(10) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `nombre_estado`) VALUES
(1, 'nuevo'),
(2, 'usado'),
(3, 'bueno'),
(4, 'malo'),
(5, 'roto'),
(6, 'descontinuado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `id_inventario` int(10) NOT NULL,
  `id_proveedor` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `no_serie` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `pedido_de_importacion` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `no_factura` int(10) DEFAULT NULL,
  `id_estado` int(10) DEFAULT NULL,
  `id_status` int(10) DEFAULT NULL,
  `id_ubicacion` int(10) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_proveedor`, `id_producto`, `no_serie`, `pedido_de_importacion`, `no_factura`, `id_estado`, `id_status`, `id_ubicacion`, `color`) VALUES
(1, 3, 1, '11', '11', 111, 2, 4, 3, 'negro'),
(2, 1, 1, '56', '56', 56, 3, 4, 1, 'negro'),
(3, 1, 2, '777', '77', 787, 3, 4, 1, 'negro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(200) NOT NULL,
  `id_categoria` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre_marca`, `id_categoria`) VALUES
(1, 'Vivitek', 1),
(3, 'Linsys', 1),
(3, 'Linsys', 2),
(2, 'cisco', 3),
(4, 'Rocket', 3),
(5, 'EPCOM', 3),
(6, 'UBIQUITI', 3),
(6, 'UBIQUITI', 2),
(6, 'UBIQUITI', 1),
(7, 'Panasonic', 2),
(2, 'cisco', 1),
(1, 'Vivitek', 2),
(7, 'Panasonic', 3),
(1, 'Vivitek', 3),
(7, 'Panasonic', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_productos`
--

CREATE TABLE IF NOT EXISTS `marca_productos` (
  `id_marca` int(10) NOT NULL,
  `nombre_marca` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marca_productos`
--

INSERT INTO `marca_productos` (`id_marca`, `nombre_marca`) VALUES
(1, 'Vivitek'),
(2, 'cisco'),
(3, 'Linsys'),
(4, 'Rocket'),
(5, 'EPCOM'),
(6, 'UBIQUIT'),
(7, 'Panasonic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE IF NOT EXISTS `moneda` (
  `id_moneda` int(10) NOT NULL,
  `nombre_moneda` varchar(50) NOT NULL,
  `valor` float NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`id_moneda`, `nombre_moneda`, `valor`) VALUES
(2, 'Peso', 1),
(1, 'Dolar', 16.9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombres`
--

CREATE TABLE IF NOT EXISTS `nombres` (
  `id_nombre` int(10) NOT NULL DEFAULT '0',
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nombres`
--

INSERT INTO `nombres` (`id_nombre`, `nombre`) VALUES
(1, 'Camara'),
(2, 'Switch'),
(3, 'Cable'),
(4, 'Router'),
(5, 'Telefono');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE IF NOT EXISTS `notas` (
  `ID_Nota` int(5) NOT NULL,
  `Fecha` date NOT NULL,
  `Nombre_Cliente` varchar(100) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `RFC` varchar(20) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Cantidad` int(5) NOT NULL,
  `Descripcion_Producto` varchar(100) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Importe` int(11) NOT NULL,
  `IVA` int(11) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(10) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `id_subcategoria` int(10) NOT NULL,
  `id_division` int(10) NOT NULL,
  `id_nombre` int(200) NOT NULL,
  `id_tipo` int(10) NOT NULL,
  `id_marca` int(10) NOT NULL,
  `modelo` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `precio` float NOT NULL,
  `id_moneda` int(10) NOT NULL,
  `id_unidad` int(10) NOT NULL,
  `descripcion` text CHARACTER SET utf8 NOT NULL,
  `exit_inventario` int(5) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=226 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `id_subcategoria`, `id_division`, `id_nombre`, `id_tipo`, `id_marca`, `modelo`, `precio`, `id_moneda`, `id_unidad`, `descripcion`, `exit_inventario`) VALUES
(1, 1, 1, 1, 1, 2, 4, 'Wantfon', 33.8, 2, 1, 'telefono inalambrico', 2),
(223, 3, 1, 1, 4, 0, 6, 'LOCOM2', 8, 1, 1, 'Access Point', 0),
(3, 1, 2, 1, 1, 3, 1, 'SPA2102s', 1000, 0, 1, 'Adaptador de Telefonos', 0),
(4, 3, 1, 1, 4, 0, 2, 'U31H4', 200, 0, 1, 'Adaptador Hembra', 0),
(5, 1, 3, 2, 1, 0, 5, 'TT101P', 300, 0, 0, 'Balun', 0),
(6, 3, 1, 3, 4, 0, 5, 'TT101PVK', 400, 0, 0, 'Balun', 0),
(7, 3, 1, 2, 2, 0, 3, 'DK4', 500, 0, 1, 'otro', 0),
(8, 1, 1, 2, 1, 1, 2, 'D2-2015', 600, 0, 1, 'sssss', 0),
(9, 1, 3, 2, 1, 0, 3, 'DS-500', 100, 0, 0, '', 0),
(10, 3, 1, 3, 3, 0, 2, 'Categoria 6', 740, 0, 1, 'UTP  C4', 0),
(12, 1, 1, 1, 1, 1, 2, 'DNSS', 460, 0, 1, 'Router', 0),
(13, 1, 1, 1, 1, 1, 6, 'TC-P24C5E', 1000, 0, 1, 'Patch Panel', 0),
(14, 1, 1, 1, 1, 2, 1, 'HERE', 200, 0, 1, 'asdc', 0),
(15, 3, 1, 1, 4, 0, 7, 'KX-T7030', 450, 0, 1, 'Telefono', 0),
(16, 1, 1, 1, 1, 1, 1, 'DK20000', 500, 0, 1, 'vgchgc', 0),
(2, 1, 3, 1, 1, 1, 3, 'Camvig', 8, 1, 1, 'vvvv', 1),
(18, 3, 1, 2, 2, 0, 2, 'VID-CAM', 100, 0, 1, 'Vid', 0),
(19, 1, 1, 1, 1, 3, 1, 'DK20', 100, 0, 1, 'movil', 0),
(20, 3, 1, 1, 2, 0, 1, 'DK2011', 130, 0, 1, 'Otrro', 0),
(21, 1, 1, 1, 1, 1, 2, 'DK20000', 1111, 0, 1, 'Vid', 0),
(22, 3, 1, 1, 2, 0, 1, 'DK20000', 100, 0, 1, 'movil', 0),
(23, 1, 1, 1, 1, 1, 1, 'askuh', 123, 0, 2, 'nada', 0),
(27, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0),
(28, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0),
(224, 1, 1, 1, 1, 4, 5, '2015', 12, 2, 1, 'paquete de vigilancia', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(10) NOT NULL,
  `nom_proveedor` varchar(70) NOT NULL,
  `fecha_alta` varchar(100) NOT NULL,
  `id_datfiscal` int(5) NOT NULL,
  `id_direccion` int(5) NOT NULL,
  `id_bancarios` varchar(30) NOT NULL,
  `id_contacto` int(5) DEFAULT NULL,
  `telefono` int(5) DEFAULT NULL,
  `id_categoria_cliente` int(100) NOT NULL,
  `direccion_web` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nom_proveedor`, `fecha_alta`, `id_datfiscal`, `id_direccion`, `id_bancarios`, `id_contacto`, `telefono`, `id_categoria_cliente`, `direccion_web`) VALUES
(1, 'Vivotek', '2014-09-19', 1, 2, '1', 2, 71212124, 2, 'www.vivotek.coms'),
(2, 'Empretel', '2014-09-24', 2, 4, '2', 3, 72112761, 2, 'www.empretel.com'),
(3, 'Digital Mind', '2015-07-31', 6, 11, '4', NULL, 34567, 1, 'https://www.digitalmind.mx'),
(4, 'Empresa', '2015-08-10', 11, 23, '10', NULL, 1234567890, 1, 'www.empresa.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedorxcontacto`
--

CREATE TABLE IF NOT EXISTS `proveedorxcontacto` (
  `id` int(10) unsigned NOT NULL,
  `id_proveedor` int(10) DEFAULT NULL,
  `id_contacto` int(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedorxcontacto`
--

INSERT INTO `proveedorxcontacto` (`id`, `id_proveedor`, `id_contacto`) VALUES
(1, 1, 3),
(9, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE IF NOT EXISTS `recibos` (
  `ID_RECIBO` int(10) NOT NULL,
  `FOLIO` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `CANTIDAD` int(5) NOT NULL,
  `ID_INVENTARIO` int(10) NOT NULL,
  `id_contacto` int(10) NOT NULL,
  `ARCHIV_COMPR_TRANS` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(10) NOT NULL,
  `nombre_status` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id_status`, `nombre_status`) VALUES
(1, 'pedido'),
(2, 'comprado'),
(3, 'recibido'),
(4, 'inventariado'),
(5, 'vendido'),
(6, 'cotizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_venta`
--

CREATE TABLE IF NOT EXISTS `status_venta` (
  `id_status_venta` int(11) NOT NULL,
  `nombre_status_venta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status_venta`
--

INSERT INTO `status_venta` (`id_status_venta`, `nombre_status_venta`) VALUES
(1, 'No Pagado'),
(2, 'Pagado'),
(3, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id_subcategoria` int(11) NOT NULL,
  `nombre_subcategoria` varchar(111) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcategoria`, `nombre_subcategoria`) VALUES
(1, 'IP'),
(2, 'Digital'),
(3, 'Analogico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `id_tipo` int(10) NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id_tipo`, `nombre_tipo`) VALUES
(1, 'Domo'),
(2, 'Fija'),
(4, 'POE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_transaccion`
--

CREATE TABLE IF NOT EXISTS `tipo_transaccion` (
  `id_tipo_transaccion` int(10) unsigned NOT NULL,
  `nombre_tipo_transaccion` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_transaccion`
--

INSERT INTO `tipo_transaccion` (`id_tipo_transaccion`, `nombre_tipo_transaccion`) VALUES
(1, 'Inventario'),
(2, 'Cotizacion'),
(3, 'Venta'),
(4, 'Compra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE IF NOT EXISTS `transacciones` (
  `id_transaccion` int(10) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `id_operacion` varchar(200) NOT NULL,
  `id_tipo_transaccion` int(10) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id_transaccion`, `fecha`, `id_operacion`, `id_tipo_transaccion`, `descripcion`) VALUES
(1, '17-08-2015', '1', 1, ''),
(2, '17-08-2015', '2', 1, '							\r\n						'),
(3, '17-08-2015', '3', 1, ''),
(4, '2015-08-19', '1', 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE IF NOT EXISTS `ubicaciones` (
  `id_ubicacion` int(10) NOT NULL,
  `nombre_ubicacion` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id_ubicacion`, `nombre_ubicacion`) VALUES
(1, 'bodega'),
(2, 'mostrador'),
(3, 'oficina'),
(4, 'casa'),
(5, 'en ruta'),
(6, 'proveedor'),
(7, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE IF NOT EXISTS `unidades` (
  `id_unidad` int(10) NOT NULL,
  `nombre_unidad` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id_unidad`, `nombre_unidad`) VALUES
(1, 'Pieza'),
(2, 'Metro'),
(3, 'Bolsa'),
(4, 'Paquete');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(4) NOT NULL,
  `usuario` varchar(15) NOT NULL DEFAULT '',
  `contrasena` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `usuario_freg` datetime DEFAULT '0000-00-00 00:00:00',
  `tipo` varchar(50) DEFAULT '2',
  `facebook` varchar(250) DEFAULT NULL,
  `twitter` varchar(250) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasena`, `email`, `usuario_freg`, `tipo`, `facebook`, `twitter`, `avatar`) VALUES
(2, 'ismael', '123456', 'chrixma@gmail.com', NULL, 'iuhsaiuhñ', NULL, NULL, NULL),
(1, 'admin', '123456', 'admin@hotmail.com', '2014-08-15 13:27:29', 'administrador', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `id_venta` int(10) NOT NULL,
  `tipo_venta` varchar(40) NOT NULL,
  `id_vendedor` int(10) NOT NULL,
  `id_status_venta` int(10) NOT NULL,
  `folio` varchar(10) NOT NULL,
  `fecha` varchar(40) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_moneda` int(10) NOT NULL,
  `subtotal` double NOT NULL,
  `iva` int(10) NOT NULL,
  `total` double NOT NULL,
  `guardado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `tipo_venta`, `id_vendedor`, `id_status_venta`, `folio`, `fecha`, `hora`, `id_cliente`, `id_moneda`, `subtotal`, `iva`, `total`, `guardado`) VALUES
(1, '0', 0, 1, 'V-1', '2015-08-19', '4:23 pm', 0, 2, 32.880001068115234, 0, 32.880001068115, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areacontacto`
--
ALTER TABLE `areacontacto`
  ADD PRIMARY KEY (`id_areacontacto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categoria_cliente`
--
ALTER TABLE `categoria_cliente`
  ADD PRIMARY KEY (`id_categoria_cliente`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`), ADD KEY `razonSocial` (`razonSocial`), ADD FULLTEXT KEY `nombre` (`nombre_cliente`,`razonSocial`,`fecha_alta`);

--
-- Indices de la tabla `clientexcontacto`
--
ALTER TABLE `clientexcontacto`
  ADD PRIMARY KEY (`id`), ADD KEY `id_cliente` (`id_cliente`), ADD KEY `id_contacto` (`id_contacto`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contacto`), ADD KEY `ID_AreaContacto` (`id_areacontacto`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`id_cotizacion`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `datos_bancarios`
--
ALTER TABLE `datos_bancarios`
  ADD PRIMARY KEY (`id_bancarios`);

--
-- Indices de la tabla `datos_fiscales`
--
ALTER TABLE `datos_fiscales`
  ADD PRIMARY KEY (`id_datfiscal`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`);

--
-- Indices de la tabla `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id_division`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`ID_ENTREGA`), ADD KEY `ID_INVENTARIO` (`ID_INVENTARIO`), ADD KEY `id_cliente` (`id_cliente`), ADD KEY `id_contacto` (`id_contacto`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`), ADD KEY `ID_Estado` (`id_estado`), ADD KEY `ID_Status` (`id_status`), ADD KEY `ID_Ubicacion` (`id_ubicacion`), ADD KEY `ID_PRODUCTO` (`id_producto`), ADD KEY `CLAVEPROVEEDOR` (`id_proveedor`);

--
-- Indices de la tabla `marca_productos`
--
ALTER TABLE `marca_productos`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id_moneda`);

--
-- Indices de la tabla `nombres`
--
ALTER TABLE `nombres`
  ADD PRIMARY KEY (`id_nombre`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`ID_Nota`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`), ADD KEY `ID_Categoria` (`id_categoria`), ADD KEY `ID_SubCategoria` (`id_subcategoria`), ADD KEY `ID_Division` (`id_division`), ADD KEY `ID_Tipo` (`id_tipo`), ADD KEY `ID_Unidad` (`id_unidad`), ADD KEY `ID_Marca` (`id_marca`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`), ADD KEY `ID_DatFiscal` (`id_datfiscal`), ADD KEY `ID_Direccion` (`id_direccion`), ADD KEY `id_contacto` (`telefono`), ADD KEY `ID_Bancarios` (`id_contacto`);

--
-- Indices de la tabla `proveedorxcontacto`
--
ALTER TABLE `proveedorxcontacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD PRIMARY KEY (`ID_RECIBO`), ADD KEY `ID_INVENTARIO` (`ID_INVENTARIO`), ADD KEY `id_cliente` (`id_cliente`), ADD KEY `id_contacto` (`id_contacto`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indices de la tabla `status_venta`
--
ALTER TABLE `status_venta`
  ADD PRIMARY KEY (`id_status_venta`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_transaccion`
--
ALTER TABLE `tipo_transaccion`
  ADD PRIMARY KEY (`id_tipo_transaccion`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id_transaccion`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id_ubicacion`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id_unidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areacontacto`
--
ALTER TABLE `areacontacto`
  MODIFY `id_areacontacto` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `clientexcontacto`
--
ALTER TABLE `clientexcontacto`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `id_cotizacion` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `datos_bancarios`
--
ALTER TABLE `datos_bancarios`
  MODIFY `id_bancarios` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `datos_fiscales`
--
ALTER TABLE `datos_fiscales`
  MODIFY `id_datfiscal` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `division`
--
ALTER TABLE `division`
  MODIFY `id_division` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `ID_ENTREGA` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `marca_productos`
--
ALTER TABLE `marca_productos`
  MODIFY `id_marca` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_moneda` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `ID_Nota` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=226;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `proveedorxcontacto`
--
ALTER TABLE `proveedorxcontacto`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `ID_RECIBO` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id_tipo` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_transaccion`
--
ALTER TABLE `tipo_transaccion`
  MODIFY `id_tipo_transaccion` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id_transaccion` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id_ubicacion` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id_unidad` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
