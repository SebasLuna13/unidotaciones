-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2026 a las 03:45:18
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
-- Base de datos: `unidotaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acabado`
--

CREATE TABLE `acabado` (
  `id_acabado` int(11) NOT NULL,
  `insumo` varchar(45) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `acabado`
--

INSERT INTO `acabado` (`id_acabado`, `insumo`, `precio`, `fecha_actualizacion`) VALUES
(0, 'No Aplica', 0, '2025-01-24'),
(1, 'Terminacion', 1500, '2025-01-24'),
(2, 'Planchado', 0, '2025-01-24'),
(3, 'Prelavado', 2500, '2025-01-24'),
(4, 'Prelavado + 100', 1500, '2026-02-05'),
(5, 'Prelavado y Terminado', 2800, '2025-01-24'),
(6, 'Lavado Especial +100', 1200, '2026-02-24'),
(8, 'Prelavado Energias de Pereira', 2800, '2026-03-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anticipo`
--

CREATE TABLE `anticipo` (
  `id_anticipo` int(11) NOT NULL,
  `porcentaje_anticipo` varchar(30) DEFAULT NULL,
  `valor_porcentaje` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `anticipo`
--

INSERT INTO `anticipo` (`id_anticipo`, `porcentaje_anticipo`, `valor_porcentaje`) VALUES
(0, '0%', 0),
(1, '10%', 0.1),
(2, '20%', 0.2),
(3, '30%', 0.3),
(4, '40%', 0.4),
(5, '50%', 0.5),
(6, '60%', 0.6),
(7, '70%', 0.7),
(8, '80%', 0.8),
(9, '90%', 0.9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsa`
--

CREATE TABLE `bolsa` (
  `id_bolsa` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `bolsa`
--

INSERT INTO `bolsa` (`id_bolsa`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 1),
(1, 'Bolsa 12X16', 'Und', 37, '2026-05-14', 0, 3, 1),
(2, 'Bolsa 14X20', 'und', 50.3, '2026-05-14', 0, 3, 1),
(5, 'Bolsa 5X9', 'und', 13, '2026-03-17', 0, 3, 1),
(6, 'Bolsa 10X16', 'und', 31, '2026-03-17', 0, 3, 1),
(7, 'Bolsa 18X24', 'und', 78, '2026-03-17', 0, 3, 1),
(8, 'Alma de carton para cliente suzuki ', 'und', 300, '2026-04-18', 0, 11, 1),
(9, 'Taco de carton para cliente suzuki', 'und', 100, '2026-04-18', 0, 11, 1),
(10, 'Bolsa 16X22', 'und', 78.9, '2026-05-14', 0, 37, 1),
(11, 'Bolsa 65X85', 'und', 21.8, '2026-05-14', 0, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsillo`
--

CREATE TABLE `bolsillo` (
  `id_bolsillo` int(11) NOT NULL,
  `tipo_bolsillo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `bolsillo`
--

INSERT INTO `bolsillo` (`id_bolsillo`, `tipo_bolsillo`) VALUES
(0, 'No Aplica'),
(1, 'Lateral'),
(2, 'Fuelle'),
(3, 'Parche'),
(4, 'Con Tapa sin Botón'),
(5, 'Con Tapa con Botón'),
(6, 'Tapa Velcro'),
(7, 'Ribete'),
(9, 'Parche con Ribete Cierre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsillo_combinado`
--

CREATE TABLE `bolsillo_combinado` (
  `id_bolsillocombinado` int(11) NOT NULL,
  `tipo_bolsillocombinado` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bolsillo_combinado`
--

INSERT INTO `bolsillo_combinado` (`id_bolsillocombinado`, `tipo_bolsillocombinado`) VALUES
(0, 'No Aplica'),
(1, 'Lateral'),
(2, 'Fuelle'),
(3, 'Parche'),
(4, 'Con Tapa sin Botón'),
(5, 'Con Tapa con Botón'),
(6, 'Tapa Velcro'),
(7, 'Ribete'),
(9, 'Parche con Ribete Cierre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsillo_combinado2`
--

CREATE TABLE `bolsillo_combinado2` (
  `id_bolsillocombinado2` int(11) NOT NULL,
  `tipo_bolsillocombinado2` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bolsillo_combinado2`
--

INSERT INTO `bolsillo_combinado2` (`id_bolsillocombinado2`, `tipo_bolsillocombinado2`) VALUES
(0, 'No Aplica'),
(1, 'Lateral'),
(2, 'Fuelle'),
(3, 'Parche'),
(4, 'Con Tapa sin Botón'),
(5, 'Con Tapa con Botón'),
(6, 'Tapa Velcro'),
(7, 'Ribete'),
(9, 'Parche con Ribete Cierre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boton`
--

CREATE TABLE `boton` (
  `id_boton` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `boton`
--

INSERT INTO `boton` (`id_boton`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, NULL, 0, 0, 2),
(1, 'Botón Consul Transparente  24 Líneas ', 'und', 81, '2026-02-03', 0, 39, 2),
(3, 'Botón Melody Blusa Camisa 18 Líneas 4 Huecos', 'und', 26, '2026-02-03', 0, 39, 2),
(6, 'Botón Metalico para Jean ', 'und', 66, '2026-02-03', 0, 11, 2),
(21, 'Botón Bandera  Pantalón 28 líneas 4 Hue', '28 lineas', 0, '2026-02-03', 0, 39, 2),
(22, 'Botón Eden Pantalón 30 líneas 4 Hue', '30 lineas', 132, '2026-02-03', 0, 39, 2),
(23, 'Boton Tentacion  colores var 24 lineas pant', 'und', 34, '2026-05-21', 0, 39, 2),
(24, 'Botón Melody Blusa Camisa 18 Líneas tinturado', 'und', 38, '2026-02-04', 0, 39, 2),
(25, 'Boton ignifugo 24 lineas', 'und', 339, '2026-03-17', 0, 20, 2),
(26, 'Boton Pantalonero 28 a 30 Lineas ', 'und', 168.07, '2026-04-18', 0, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boton2`
--

CREATE TABLE `boton2` (
  `id_boton2` int(11) NOT NULL,
  `insumo` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `medida` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `boton2`
--

INSERT INTO `boton2` (`id_boton2`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, NULL, 0, 0, 2),
(1, 'Botón Consul Transparente  24 Líneas ', 'und', 81, '2026-02-03', 0, 39, 2),
(3, 'Botón Melody Blusa Camisa 18 Líneas 4 Huecos', 'und', 26, '2026-02-03', 0, 39, 2),
(6, 'Botón Metalico para Jean ', 'und', 66, '2026-02-03', 0, 11, 2),
(14, 'Botón Bandera  Pantalón 28 líneas 4 Hue', '28 lineas', 152, '2025-05-19', 0, 39, 2),
(15, 'Botón Eden Pantalón 30 líneas 4 Hue', '30 lineas', 122, '2025-05-19', 0, 39, 2),
(16, 'Boton colores varios 24 lineas ', '24 lineas', 182, '2026-02-03', 0, 39, 2),
(17, 'Botón Melody Blusa Camisa 18 Líneas tinturado', 'und', 38, '2026-02-04', 0, 39, 2),
(18, 'Boton ignifugo 24 lineas', 'und', 339, '2026-03-17', 0, 20, 2),
(19, 'Boton Pantalonero 28 a 30 Lineas ', 'und', 168.07, '2026-04-18', 0, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `broche`
--

CREATE TABLE `broche` (
  `id_broche` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `broche`
--

INSERT INTO `broche` (`id_broche`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 3),
(1, 'Broche Plástico ', 'Und', 66, '2026-03-17', 0, 5, 3),
(7, 'Broche Metálico', 'und', 84, '2026-02-03', 0, 5, 3),
(8, 'Broche boton metalico a presion ', 'und', 231, '2026-04-18', 0, 8, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id_calificacion` int(11) NOT NULL,
  `calificacion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`id_calificacion`, `calificacion`) VALUES
(1, 'Muy Malo'),
(2, 'Malo'),
(3, 'Normal'),
(4, 'Bueno'),
(5, 'Muy Bueno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `califi_proveedor`
--

CREATE TABLE `califi_proveedor` (
  `id_registro` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_calificacion` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `califi_proveedortela`
--

CREATE TABLE `califi_proveedortela` (
  `id_registro` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_calificacion` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `cargo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `cargo`) VALUES
(1, 'Administrativo'),
(2, 'Operativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartera`
--

CREATE TABLE `cartera` (
  `id_cartera` int(11) NOT NULL,
  `tipo_cartera` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cartera`
--

INSERT INTO `cartera` (`id_cartera`, `tipo_cartera`) VALUES
(0, 'No Aplica'),
(1, 'Sin Cartera'),
(2, 'Sencilla'),
(3, 'Oculta'),
(4, 'Combinada'),
(5, 'Sobrepuesta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cinta_faya`
--

CREATE TABLE `cinta_faya` (
  `id_faya` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cinta_faya`
--

INSERT INTO `cinta_faya` (`id_faya`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 4),
(1, 'Cinta Faya 1 cms de ancho', 'metro', 209, '2026-02-03', 0, 35, 4),
(5, 'Cinta Faya 2 cms de ancho', 'metro', 310, '2026-02-04', 0, 35, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cinta_reflectiva`
--

CREATE TABLE `cinta_reflectiva` (
  `id_cinta` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cinta_reflectiva`
--

INSERT INTO `cinta_reflectiva` (`id_cinta`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No aplica', NULL, 0, '2025-01-24', 0, 0, 5),
(4, 'Cinta Reflectiva Gris TR520  2 pulgadas ', 'Metro', 1095, '2026-02-06', 0, 20, 5),
(5, 'Cinta Reflectiva Gris TR550 2 Pulgadas', 'Metro', 1510, '2026-02-06', 0, 20, 5),
(10, 'Cinta Reflectiva  Verde Gris TR300 1pulgada  ', 'Metro', 856, '2026-02-06', 0, 20, 5),
(11, 'Cinta Verde Gris 5 cms TR300  Total Reflecti', 'Metro', 1426, '2026-02-06', 0, 20, 5),
(16, 'Hilo FR 40 Tex 5000 metros', 'Cono 5000 ', 0, '2026-02-06', 0, 20, 5),
(18, 'Cinta Reflectiva Verde Gris TR300 2pulgadas', 'metro', 1429, '2026-02-20', 0, 20, 5),
(19, 'Cinta Reflectiva Gris 5cms las tresb', 'metro', 697, '2026-03-20', 0, 5, NULL),
(20, 'Tela reflectiva para corte en banda ', 'metro', 9243, '2026-04-18', 0, 51, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `nit` int(11) NOT NULL,
  `cod_cliente` int(11) DEFAULT NULL,
  `cliente` varchar(200) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_entidad` int(11) NOT NULL,
  `representante_legal` varchar(200) DEFAULT NULL,
  `cumple_representante` date DEFAULT NULL,
  `celular_representante` varchar(10) DEFAULT NULL,
  `correo_representante` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `cumple_contacto` date DEFAULT NULL,
  `celular_contacto` varchar(10) DEFAULT NULL,
  `correo_contacto` varchar(100) DEFAULT NULL,
  `contacto2` varchar(100) DEFAULT NULL,
  `cargo2` varchar(50) DEFAULT NULL,
  `cumple_contacto2` date DEFAULT NULL,
  `celular_contacto2` varchar(10) DEFAULT NULL,
  `correo_contacto2` varchar(100) DEFAULT NULL,
  `contacto3` varchar(100) DEFAULT NULL,
  `cargo3` varchar(50) DEFAULT NULL,
  `cumple_contacto3` date DEFAULT NULL,
  `celular_contacto3` varchar(10) DEFAULT NULL,
  `correo_contacto3` varchar(100) DEFAULT NULL,
  `contacto4` varchar(100) DEFAULT NULL,
  `cargo4` varchar(50) DEFAULT NULL,
  `cumple_contacto4` date DEFAULT NULL,
  `celular_contacto4` varchar(10) DEFAULT NULL,
  `correo_contacto4` varchar(100) DEFAULT NULL,
  `correo_factura` varchar(100) DEFAULT NULL,
  `fecha_cierrefacturacion` enum('22 de cada mes','23 de cada mes','24 de cada mes','25 de cada mes','26 de cada mes','27 de cada mes','28 de cada mes','29 de cada mes','30 de cada mes','31 de cada mes') DEFAULT NULL,
  `entregas_anuales` enum('Seleccione una opción','1 vez al año','2 veces al año','3 veces al año') DEFAULT NULL,
  `meses_entrega` varchar(255) DEFAULT NULL,
  `nuevos_ingresos` enum('No','Si') DEFAULT NULL,
  `cantidad_ingresos` int(11) DEFAULT NULL,
  `proveedor_actual` varchar(200) DEFAULT NULL,
  `departamento1` varchar(100) DEFAULT NULL,
  `ciudad1` varchar(100) DEFAULT NULL,
  `direccion1` varchar(100) DEFAULT NULL,
  `departamento2` varchar(100) DEFAULT NULL,
  `ciudad2` varchar(100) DEFAULT NULL,
  `direccion2` varchar(100) DEFAULT NULL,
  `departamento3` varchar(100) DEFAULT NULL,
  `ciudad3` varchar(100) DEFAULT NULL,
  `direccion3` varchar(100) DEFAULT NULL,
  `empleados_directos` int(11) DEFAULT NULL,
  `empleados_dotacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`nit`, `cod_cliente`, `cliente`, `id_usuario`, `id_entidad`, `representante_legal`, `cumple_representante`, `celular_representante`, `correo_representante`, `contacto`, `cargo`, `cumple_contacto`, `celular_contacto`, `correo_contacto`, `contacto2`, `cargo2`, `cumple_contacto2`, `celular_contacto2`, `correo_contacto2`, `contacto3`, `cargo3`, `cumple_contacto3`, `celular_contacto3`, `correo_contacto3`, `contacto4`, `cargo4`, `cumple_contacto4`, `celular_contacto4`, `correo_contacto4`, `correo_factura`, `fecha_cierrefacturacion`, `entregas_anuales`, `meses_entrega`, `nuevos_ingresos`, `cantidad_ingresos`, `proveedor_actual`, `departamento1`, `ciudad1`, `direccion1`, `departamento2`, `ciudad2`, `direccion2`, `departamento3`, `ciudad3`, `direccion3`, `empleados_directos`, `empleados_dotacion`) VALUES
(1, 800203005, 'mersatex sas', 1, 2, '', '0000-00-00', '', '', 'Alexander Bernal ', 'compras ', '0000-00-00', '3146442798', 'comprasmersatexsst@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'comprasmersatexsst@gmail.com', '31 de cada mes', NULL, NULL, NULL, NULL, 'confeccionar', 'Risaralda', 'Dosquebradas', 'carrerra 21 # 32-38', '', '', '', '', '', '', 70, 70),
(2, 891401628, 'COOPERATIVA DE TAXIS DE RDA', 1, 2, 'Eliécer de Jesús zapata ', '0000-00-00', '', 'gerencia@covicharalda.com.co', 'Melissa Pineda', 'Auxiliar contable y cartera', '0000-00-00', '3213041843', 'cartera@covicharalda.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@covicharalda.com.co', '25 de cada mes', NULL, NULL, NULL, NULL, 'Oscar De WAFRE', 'Risaralda', 'Pereira', 'Cra 12 No. 22-15 parque Olaya herrera', '', '', '', '', '', '', 0, 18),
(3, 891408261, 'Vicerrectoría de Proyecto de Vida', 1, 2, 'Alberto Behitman Céspedes de los Ríos ', '0000-00-00', '', 'rector@ucp.edu.co', 'Elizabeth Lopez Quintero ', 'Trabajadora social', '0000-00-00', '3105396092', 'Elizabeth.lopez@ucp.edu.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'Elizabeth.lopez@ucp.edu.co', '26 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, 'confeccionar ', 'Risaralda', 'Pereira', 'carrera 21 # 49-95 av. de las Américas ', '', '', '', '', '', '', 0, 12),
(4, 818000591, 'Expreso del pacifico S.A.S', 1, 2, 'Martin Orejuela ', '2006-12-13', '3015819751', 'morejuela24@hotmail.com', 'Martin Orejuela', 'Gerente', '0000-00-00', '3015819751', 'morejuela24@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'morejuela24@hotmail.com', '22 de cada mes', '2 veces al año', 'Abril,Agosto', 'No', 0, 'Confeccionista persona natural', 'Chocó', 'Quibdó', '', '', '', '', '', '', '', 15, 15),
(5, 900471667, 'constructora y promotora camu', 1, 2, 'Clarena Mejía Giraldo ', '0000-00-00', '', 'contabilidad@constructoracamu.com', 'Víctor Cerón ', 'Asistente talento humano ', '0000-00-00', '3122301978', 'bienestarth@constructoracamu.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturas@constructoracamu.com', '23 de cada mes', NULL, NULL, NULL, NULL, '', 'Quindío', 'Armenia', 'CL 21 # 16- 46 Piso 10 ', '', '', '', '', '', '', 0, 80),
(6, 891400669, 'Cámara de comercio de Pereira ', 1, 1, 'Jorge Iván Ramirez Cadavid ', '0000-00-00', '', 'logistica@camarapereira.org.co', 'Jorge Adrián Moreno', 'analista de gestión humana', '0000-00-00', '3136790059', 'jmarin@camarapereira.org.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'logistica@camarapereira.org.co', '27 de cada mes', NULL, NULL, NULL, NULL, '', 'Risaralda', 'Pereira', 'carrera 8 # 23-096 local 10 ', '', '', '', '', '', '', 50, 50),
(7, 900112820, 'CMS COLOMBIA LTDA', 1, 2, 'Aurys Yaneth Duarte Quintero', '0000-00-00', '', '', 'Daladier orozco ', 'Coordinador de seguridad', '0000-00-00', '3146737672', 'coorseguridad.pinares@dumianmedical.net', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'zaida.parra@duarquint.com', '22 de cada mes', NULL, NULL, NULL, NULL, 'Desde cali', 'Risaralda', 'Pereira', 'Cll 9 no. 20-60 pinares _ pinares medica', '', '', '', '', '', '', 12, 12),
(8, 891400467, 'CLUB CAMPESTRE ', 1, 2, 'Laura Palacio marin', '0000-00-00', '3009125281', 'info@campestrepereira.com', 'Carolina Cardona ', 'Directora de BIenestar ', '0000-00-00', '3184290471', 'dirbienestar@campestrepereira.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacioncccp@campestrepereira.com', '23 de cada mes', NULL, NULL, NULL, NULL, '', 'Risaralda', 'Pereira', 'Cerritos ', '', '', '', '', '', '', 120, 120),
(9, 901584336, 'Callcenter solutions off américa sas ', 1, 2, 'Alba  Lucia Jiménez Aguirre ', '0000-00-00', '3229499886', 'callcentersolutionsofa@gmail.com', 'Evelyn Vasquez santos ', 'Auxiliiar Administrativo ', '0000-00-00', '3143668107', 'evelynv@permanentandtotal.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'callcentersolutionsofa@gmail.com', '26 de cada mes', '3 veces al año', 'Enero, Mayo, Septiembre', 'No', 0, 'UFR ', 'Risaralda', 'Pereira', 'S C VIA CERRITOS PEREIRA ENTRE EN SONESTA HOTEL Y PARQUE CONSOTA 14 Y 15 CC CERRITOS MALL PH LC 306', '', '', '', '', '', '', 12, 12),
(10, 816004711, 'cooperativa de trabajo asociado multiplicadora de servicios multiser', 1, 2, 'Gloria Clemencia Gonzales Carmona ', '0000-00-00', '3206889146', 'gloriac62008@hotmail.com', 'Liliana Patricia Carmona ', 'administradora ', '0000-00-00', '3173777576', 'lilitoct@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'lilitoct@gmail.com', '27 de cada mes', '2 veces al año', 'Enero, Septiembre', 'No', 0, 'gino passcalli ', 'Risaralda', 'Pereira', 'Calle 21 Nro 5-47', '', '', '', '', '', '', 11, 11),
(11, 900091746, 'LA FABRICA DE LA FELICIDAD S.A.S', 1, 2, 'Juan Fenando Hoyos Castaño', '0000-00-00', '3104238447', 'contabilidad@juancamole.com', 'Diana Betancourt', 'auxiliar de compras ', '0000-00-00', '3232847393', 'jefecompras@juancamole.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recursoshumanos@juancamole.com', '24 de cada mes', '3 veces al año', 'Enero, Mayo, Septiembre', 'Si', -6, '', 'Risaralda', 'Pereira', 'CR 2 NORTE 17 97 CONJ EJE NEXOS BG 11 VARIANTE LA ROMELIA EL POLLO', '', '', '', '', '', '', 95, 95),
(12, 900686529, 'azkoyen andina sas', 1, 2, 'james perea ramirez', '0000-00-00', '3108637435', 'jamesperea@azkoyen.com', 'jeimy castro', 'coordinadora de rrhhysst', '1991-07-09', '3134777595', 'jeimycastro@azkoyen.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recepcion@misfacturas.com.co', '25 de cada mes', '3 veces al año', 'Abril, Agosto, Diciembre', 'Si', 8, 'la casa del guante, enciso', 'Risaralda', 'Pereira', 'kilometro 3 via pereira armenia centro logistico consota bodega 1-2', '', '', '', '', '', '', 29, 15),
(13, 900237788, 'Licorrumba sas', 1, 2, 'Duverney Arcila Idárraga ', '0000-00-00', '', 'gerencia@licorrumba.com', 'Daniela Niño ', 'Asiste gestión humana ', '0000-00-00', '3187081165', 'gestionhumana@licorrumba.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@licorrumba.com', '26 de cada mes', '1 vez al año', 'Enero, Mayo, Septiembre', 'Si', 5, '', 'Risaralda', 'Pereira', 'carrera 2 norte # 1-536 bodega 50', '', '', '', '', '', '', 51, 51),
(14, 900799930, 'Agrocentro sas', 1, 2, 'Fredy Arroyave Salazar ', '0000-00-00', '3214556678', 'agrocentro2011@hotmail.com', 'Yamile  Pérez ', 'Asistente talento humano ', '0000-00-00', '3056234052', 'yamile.p.centro@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionagocentro@gmail.com', '24 de cada mes', '1 vez al año', 'Enero', 'Si', 5, '', 'Risaralda', 'La Virginia', 'CARRERA 5 NRO.8A-43', '', '', '', '', '', '', 130, 89),
(15, 1128268067, 'cafeteria  y panaderia mega pan ', 1, 2, 'cindy alejandra orozco ', '0000-00-00', '3204354384', 'susana102310@gmail.com', 'alejandra orozco', 'administradora', '0000-00-00', '3204354384', 'susana102310@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'susana102310@gmail.com', '26 de cada mes', '1 vez al año', 'Noviembre', 'Si', 7, '', 'Risaralda', 'Pereira', 'calle 21 # 14 A 48', '', '', '', '', '', '', 6, 6),
(16, 1088256844, 'ferreteria don justo', 1, 2, 'ingrid castaño', '0000-00-00', '3053718055', 'donjustoferreteria@gmail.com', 'ingrid castaño', 'gerente ', '0000-00-00', '3053718055', 'donjustoferreteria@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'donjustoferreteria@gmail.com', '25 de cada mes', '3 veces al año', 'Enero, Abril, Agosto', 'Si', 4, '', 'Risaralda', 'Pereira', 'carrea49# 85 A 15', '', '', '', '', '', '', 7, 7),
(17, 901403993, 'distribuidora molins sas', 1, 2, 'cesar castañeda mora ', '0000-00-00', '3125419957', 'distribuidoramolins@gmail.com', 'cesar castañeda mora ', 'gerente ', '0000-00-00', '3125419957', 'distribuidoramolins@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'distribuidoramolins@gmail.com', '28 de cada mes', '1 vez al año', 'Agosto', 'Si', 3, '', 'Risaralda', 'Dosquebradas', 'carrera 16 A  # 10-86 zn industrial la popa ', '', '', '', '', '', '', 7, 7),
(18, 900151289, 'Vhz ingeniería sas sociedad por acciones simplificada', 1, 2, 'víctor Hugo zapata cárdenas ', '0000-00-00', '', 'contabilidad@vhz-ingenieria.com', 'Luisa Agudelo ', 'Asistente talento humano ', '0000-00-00', '3014549472', 'comercial@vhz-ingenieria.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@vhzingenieria.com', '27 de cada mes', '2 veces al año', 'Enero, Mayo, Septiembre', 'Si', 3, '', 'Risaralda', 'Pereira', 'calle 33 bis # 10-48', '', '', '', '', '', '', 0, 0),
(19, 900695452, 'Nase colombia sas', 1, 2, 'LUISA FERNANDA JARAMILLO', '0000-00-00', '3046569050', 'directoradministrativo@nasecolombia.com.co', 'María José  salazar franco', 'Coordinadora compras', '0000-00-00', '3128332765', 'coordinadorcompras@nasecolombia.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'compras@nasecolombia.com.co', '25 de cada mes', '3 veces al año', 'Enero', 'No', 0, 'unidotaciones del eje', 'Risaralda', 'Pereira', 'Calle 12# 23-68', '', '', '', '', '', '', 0, 0),
(20, 900174478, 'LOUIS DREYFUS COMPANY COLOMBIA SAS', 1, 2, 'ANDREA ASTORQUIZA', '0000-00-00', '3183440259', 'Andrea.Astorquiza@ldc.com', 'Astrid Rico', 'Analista Compras', '0000-00-00', '3173705171', 'astrid.rico@ldc.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cristina.londono@ldc.com', '25 de cada mes', '3 veces al año', 'Abril, Septiembre, Noviembre', 'No', 0, '', 'Risaralda', 'Pereira', 'TRILLADORA SAN ANTONIO VIA CERRITOS', '', '', '', '', '', '', 0, 0),
(22, 901185312, 'GREEN SUPERFOOD S.A.S', 1, 2, '', '0000-00-00', '', '', 'LEIDYS CRISTANCHO', 'Analista Compras', '0000-00-00', '3112160430', 'lcristancho@greensuperfood.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@greensuperfood.co', '26 de cada mes', '3 veces al año', 'Abril', 'No', 0, 'unidotaciones del eje', 'Quindío', 'Armenia', 'Vereda Mesopotamia', '', '', '', '', '', '', 0, 0),
(23, 900442933, 'SCRIBE COLOMBIA S.A.S', 1, 2, '', '0000-00-00', '', '', 'Vanesa Parra', 'Directora Gestion Humana', '0000-00-00', '3182111446', 'vanessa.parra@biopappel.com', 'Yamileth Echeverry', 'Analista Gestion Humana', '0000-00-00', '3103812249', 'yecheverry@biopappel.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'scriberecepcionfe@ekomercio.co', '22 de cada mes', '3 veces al año', 'Abril', 'No', 0, 'UNIDOTACIONES DEL EJE', 'Risaralda', 'Pereira', 'Avenida Santander Nº 11E 120 Via Libare', '', '', '', '', '', '', 0, 0),
(24, 1234567899, 'Ejemplo cliente nuevo', 1, 1, 'Timmy Turner', '2006-12-29', '3203450789', 'timmy@empresa.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturas@empresa.com', '25 de cada mes', '2 veces al año', 'Mayo', 'No', 0, 'anterior', 'Caldas', 'Anserma', 'carrera 1 G # 35 A 13', '', '', '', '', '', '', 120, 120),
(25, 901183864, 'comercializadora Hometex s.a.s ', 1, 2, 'Yakelin Aristizábal Giraldo ', '0000-00-00', '3113432933', 'facturacion@homtex.com.co', 'Yakelin Aristizábal ', 'Gerente ', '0000-00-00', '3113432933', 'facturacion@homtex.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@homtex.com.co', '25 de cada mes', '2 veces al año', 'Enero, Octubre', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 8 con 16 # 29-30 local 75 ', '', '', '', '', '', '', 16, 16),
(26, 901858843, 'iluminación eléctrico don justo ', 1, 2, 'Ingrid Castaño ', '0000-00-00', '3053718055', 'electricosdonjusto@gmail.com', 'Ingrid Castaño', 'gerente ', '0000-00-00', '3053718055', 'electricosdonjusto@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'electricosdonjusto@gmail.com', '22 de cada mes', '3 veces al año', 'Enero, Mayo, Octubre', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 26 # 78-15', '', '', '', '', '', '', 4, 4),
(27, 901147087, 'Importadora y comercializadora surtiplas sas ', 1, 2, '', '0000-00-00', '3004939990', 'contacto@surtiplas.com', 'katherine', 'compras ', '0000-00-00', '3004939892', 'contacto@surtiplas.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contacto@surtiplas.com', '25 de cada mes', '2 veces al año', 'Enero, Octubre', 'No', 0, '', 'Risaralda', 'Pereira', 'calle # 12-50 barrio Guadalupe ', '', '', '', '', '', '', 6, 6),
(28, 900073590, 'ASOCIACION DE PROFESIONALES DE LA SALUD APROSALUD', 1, 2, '', '0000-00-00', '', '', 'Claudia Patricia Valencia', 'Asistente Administrativa', '0000-00-00', '3163038077', 'cvalencia@aprosalud.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'aprosaludp@hotmail.com', '26 de cada mes', '3 veces al año', 'Marzo, Agosto, Noviembre', 'No', 0, 'UNIDOTACIONES DEL EJE', 'Risaralda', 'Pereira', 'CARRERA 11BIS # 2-09 BARRIO POPULAR MODELO', '', '', '', '', '', '', 0, 0),
(29, 900940142, 'life clean ', 1, 2, 'francisco javier pedroza ', '0000-00-00', '3245177633', 'compras@lifeclean.com', 'aldemar garcia londono', 'coordinador de compras ', '0000-00-00', '3245177633', 'compras@lifeclean.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'compras@lifeclean.com', '30 de cada mes', '2 veces al año', 'Enero, Julio', 'Si', 40, 'confeccionar ', 'Risaralda', 'Pereira', 'calle 15 16 A 45 barrio balher ', '', '', '', '', '', '', 800, 800),
(30, 901318507, '5 SENTIDOS, GESTION INTEGRAL DE RIESGOS SAS', 1, 2, 'Silvia Botero Restrepo', '0000-00-00', '3104711559', 'silvia.botero@5sentidos.co', 'Jessika Ruiz', 'Coordinadora TH', '0000-00-00', '3105163898', 'jessika.ruiz@5sentidos.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'hola@5sentidos.co', '28 de cada mes', '1 vez al año', 'Mayo', 'No', 0, 'UNIDOTACIONES DEL EJE', 'Risaralda', 'Pereira', 'Calle 14 No. 23 -72 Edificio alturia oficina 903', '', '', '', '', '', '', 0, 0),
(31, 816003954, 'COOPERATIVA DE PORCICULTORES DEL EJE CAFETERO', 1, 2, '', '0000-00-00', '', '', 'Cindy Cabrales', 'Directora Gestion Humana', '0000-00-00', '3218328257', 'cindy.cabrales@cercafe.com.co', 'Kelly Andrea Vasquez', 'Analista Gestion Humana', '0000-00-00', '3013325018', 'kelly.vasquez@cercafe.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturasproveedores@cercafe.com.co', '25 de cada mes', '3 veces al año', 'Abril, Agosto, Diciembre', 'No', 0, 'UNIDOTACIONES DEL EJE', 'Risaralda', 'Pereira', 'AV LAS AMERICAS MERCASA OF 403', '', '', '', '', '', '', 0, 0),
(32, 2147483647, 'kreative Q sas ', 1, 2, 'Maria Otilia Gonzales Buitrago ', '0000-00-00', '3217252266', 'facturacionkreativeq@gmail.com', 'carolina ', 'gestion de compras ', '0000-00-00', '3014712863', 'comprascarokreativeq@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionkreativeq@gmail.com', '27 de cada mes', '2 veces al año', 'Enero, Agosto', 'Si', 3, '', 'Risaralda', 'Pereira', 'en 4 tierra quimbaya ca 31 barrio cerritos', '', '', '', '', '', '', 35, 27),
(33, 100767421, 'RUFINO SANTACOLOMA VILLEGAS', 1, 2, '', '0000-00-00', '', '', 'Catalina Diaz Rojo', 'Coordinadora de Gestion Humana', '0000-00-00', '3103846147', 'calidad@macarena.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@lamacarena.org', '25 de cada mes', '1 vez al año', 'Mayo', 'No', 0, 'UNIDOTACIONES DEL EJE', 'Risaralda', 'Dosquebradas', 'Calle 11 Nº 6 - 211 Bodega 33 Antigua Plaza Ferias', '', '', '', '', '', '', 0, 0),
(34, 860003563, 'HITACHI ENERGY COLOMBIA SAS', 1, 2, '', '0000-00-00', '', '', 'Bibian Torres', 'Health, Safety and Environment Specialist PGTR', '0000-00-00', '3166933692', 'bibian.torres@hitachienergy.com', 'Diana Valencia', 'HS Specialist', '0000-00-00', '3142083747', 'diana.valencia@hitachienergy.com', 'Nicson Restrepo', 'HSE professional', '0000-00-00', '3224028136', 'nicson.restrepo-chiquito@hitachienergy.com', 'Cristian Ortiz Largo', 'HSE professional', '0000-00-00', '3126266918', 'cristian.ortiz-largo@hitachienergy.com', 'radicacion.facturas@hitachienergy.com', '26 de cada mes', '3 veces al año', 'Abril, Agosto, Diciembre', 'No', 0, 'UNIDOTACIONES DEL EJE', 'Risaralda', 'Dosquebradas', 'Zona Industrial La Popa, Cl. 16 #15-124', '', '', '', '', '', '', 0, 0),
(35, 901592375, 'International gps sas. bic ', 1, 2, 'Sebastián Ramirez Jiménez ', '0000-00-00', '3115367030', 'rastreointernacional@gmail.com', 'Andrea Perez ', 'Auxiliiar Administrativo ', '0000-00-00', '3128246183', 'rastreointernacional@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'rastreointernacional@gmail.com', '26 de cada mes', '2 veces al año', 'Febrero, Noviembre', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 16 # 23-56 barrio Centenario ', '', '', '', '', '', '', 3, 3),
(36, 900480569, 'JERONIMO MARTINS COLOMBIA SAS', 1, 2, '', '0000-00-00', '', '', 'SARA SIERRA ', 'Gerente Nacional de Compras', '0000-00-00', '3227216570', 'sara.sierra@jeronimo-martins.com', 'Yesica Hincapie ', 'Servicios Generales Compras Pereira', '0000-00-00', '3102469472', 'serviciosgeneralesr1@jeronimo-martins.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'serviciosgeneralesr1@jeronimo-martins.com', '22 de cada mes', '1 vez al año', 'Abril, Agosto, Diciembre', 'No', 0, 'ECO MARKET DE MEDELLIN ', 'Risaralda', 'Pereira', '', '', '', '', '', '', '', 15000, 15000),
(42, 816004301, 'A.Botero y CIA Sociedad en Comandita', 1, 1, '', '0000-00-00', '', '', 'Alberto Botero', '', '0000-00-00', '3122868616', 'adryidarraga@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'adryidarraga@hotmail.com', '22 de cada mes', '1 vez al año', 'Abril', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(46, 2147483647, 'cliente nuevo', 1, 1, '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturas@empresa.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(47, 901786138, 'AYC Sublimados Colombia', 1, 1, '', '0000-00-00', '3007262960', 'aycsublimadosd24@gmail.com', '', '', '0000-00-00', '3054145140', 'aycsublimadosd24@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'aycsublimadosd24@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 15 # 6 - 35', '', '', '', '', '', '', 0, 0),
(48, 900816822, 'Accedo Colombia SAS', 1, 1, '', '0000-00-00', '3182897427', 'laura.rodriguez@accedotech.com', 'Laura Rodriguez', 'accedo h', '0000-00-00', '6063170004', 'laura.rodriguez@accedotech.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'laura.rodriguez@accedotech.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Circunvalar # 5 - 20 Piso 8', '', '', '', '', '', '', 0, 0),
(49, 900336004, 'Administradora Colombiana de Pensiones Colpensiones ', 1, 1, '', '0000-00-00', '6014890909', 'contacto@colpensiones.gov.co', '', '', '0000-00-00', '6014890909', 'contacto@colpensiones.gov.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contacto@colpensiones.gov.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Carrera 9 # 59 - 43', '', '', '', '', '', '', 0, 0),
(50, 800138188, 'Administradora de Fondos de Pension y cesantias Proteccion SA', 1, 1, '', '0000-00-00', '6045109099', 'datospersonales@proteccion.com.co', '', '', '0000-00-00', '6045109099', 'datospersonales@proteccion.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'datospersonales@proteccion.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Antioquia', 'Medellín', 'Calle 49 # 63 - 100', '', '', '', '', '', '', 0, 0),
(51, 830073145, 'Administradora de Hoteles Nueva Granada S.A', 1, 1, '', '0000-00-00', '6063358398', 'tesoreria.abadiaplaza@ghlhoteles.com', '', '', '0000-00-00', '6063358398', 'tesoreria.adabiaplaza@ghlhoteles.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'tesoreria.abadiaplaza@ghlhoteles.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 8 # 21 - 67 Centro', '', '', '', '', '', '', 0, 0),
(52, 900188750, 'Agregados del Occidente de Risaralda', 1, 1, '', '0000-00-00', '6063114271', 'facturacion@agreoccidente.com', '', '', '0000-00-00', '6063114271', 'facturaccion@agreoccidente.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@agreoccidente.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'kilometro 15 Via La Virginia a Santuario Vereda Playa Rica Finca La Coquera', '', '', '', '', '', '', 0, 0),
(53, 900168438, 'Agroganadera y Consultores ASociados', 1, 1, '', '0000-00-00', '3162278622', 'mcfactura18@gmail.com', '', '', '0000-00-00', '3162278622', 'mcfactura18@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'mcfactura18@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 15 # 4 - 61 ', '', '', '', '', '', '', 0, 0),
(54, 901249018, 'Agroinversiones La Galicia SAS', 1, 1, '', '0000-00-00', '3176602724', 'agroinversiones.lagalicia@gmail.com', '', '', '0000-00-00', '3176602724', 'agroinversiones.lagalicia@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'agroinversiones.lagalicia@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Valle del Cauca', 'Roldanillo', 'Carrera 4 Norte # 8 - 13 ', '', '', '', '', '', '', 0, 0),
(55, 860503617, 'Seguros de Vida Alfa ', 1, 1, '', '0000-00-00', '6013077032', 'servicioalcliente@segurosalfa.com.co', '', '', '0000-00-00', '6013077032', 'servicioalcliente@segurosalfa.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'servicioalcliente@segurosalfa.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Avenida Calle 26 # 59- 15 Edificio Avianca Local 6', '', '', '', '', '', '', 0, 0),
(56, 839000495, 'Anas Wayuu', 1, 1, '', '0000-00-00', '6057256565', 'info@epsianaswayuu.com', '', '', '0000-00-00', '6057256565', 'info@epsianaswayuu.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'info@epsianaswayuu.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'La Guajira', 'Maicao', 'Carrera 16 # 16 - 31', '', '', '', '', '', '', 0, 0),
(57, 800001520, 'Apostar S.A', 1, 1, '', '0000-00-00', '3206128070', 'apostar@apostar.com.co', 'Marcela Bueno Aguirre', '', '0000-00-00', '3206128070', 'apostar@apostar.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'apostar@apostar.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 6 # 17  - 33', '', '', '', '', '', '', 0, 0),
(58, 901313091, 'Arba Colombia SAS', 1, 1, '', '0000-00-00', '3166273539', 'siesaferecepcion@siesa.com', '', '', '0000-00-00', '', 'siesaferecepcion@siesa.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'siesaferecepcion@siesa.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Valle del Cauca', 'Tuluá', 'Carrera 25 # 27 - 50 Oficina 316 Edificio Pleno Centro', '', '', '', '', '', '', 0, 0),
(59, 900275802, 'Aristizabal Joyeros', 1, 1, '', '0000-00-00', '6044448237', 'facturacionaristizabaljoyeros@gmail.com', '', '', '0000-00-00', '6044448237', 'facturacionaristizabaljoyeros@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionaristizabaljoyeros@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Antioquia', 'Medellín', '', '', '', '', '', '', '', 0, 0),
(60, 901141675, 'Arizul Colombia SAS', 1, 1, '', '0000-00-00', '3174013371', 'creacionesarizulazul@gmail.com', 'Adriana Josefina', '', '0000-00-00', '', 'creacionesarizulazul@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'creacionesarizulazul@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Carrera 19 # 12 - 51 Oficina M18', '', '', '', '', '', '', 0, 0),
(61, 800042471, 'Arus S.A', 1, 1, '', '0000-00-00', '6017424488', 'admon.proveedores@arus.com.co', '', '', '0000-00-00', '', 'admon.proveedores@arus.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'admon.proveedores@arus.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'admon.proveedores@arus.com.co', '', '', '', '', '', '', 0, 0),
(62, 901094148, 'ascensores JDR SAS', 1, 1, 'David Fabian Robayo', '0000-00-00', '3147706585', 'dav.robayo.garcia@gmail.com', 'David Fabian Robayo', '', '0000-00-00', '3147706585', 'dav.robayo.garcia@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'dav.robayo.garcia@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Calle 20 Bis # 15 - 02 Barrio Pradera Baja', '', '', '', '', '', '', 0, 0),
(63, 860524654, 'Aseguradora Solidaria de Colombia', 1, 1, 'Manuel Vasquez', '0000-00-00', '6013254555', 'manuel.vasquez@correseguros.co', 'Manuel Vasquez', '', '0000-00-00', '6013254555', 'manuel.vasquez@correseguros.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'manuel.vasquez@correseguros.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Calle 100 # 9A - 45 pISO 12', '', '', '', '', '', '', 0, 0),
(64, 900565867, 'Asesorias y Logistica ZF SAS', 1, 1, 'Lorena Pinzon', '0000-00-00', '6063163438', 'comercial@aselogzf.com', 'Lorena Pinzon', '', '0000-00-00', '6063163438', 'comercial@aselogzf.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'comercial@aselogzf.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Zona Franca Internacional Bodega 7', '', '', '', '', '', '', 0, 0),
(65, 900935126, 'Asmet Salud ', 1, 1, '', '0000-00-00', '3165375061', 'bogota@asmetsalud.com', '', '', '0000-00-00', '3165375061', 'bogota@asmetsalud.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'bogota@asmetsalud.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Carrera 7 # 35 - 23', '', '', '', '', '', '', 0, 0),
(66, 800137135, 'Asociacion Comunitaria de Emaus', 1, 1, '', '0000-00-00', '6063233526', 'emauspereira@gmail.com', 'Andres castrillon ', '', '0000-00-00', '6063233526', 'emauspereira@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'emauspereira@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Vereda Nuevo Sol Finca El Jordan', '', '', '', '', '', '', 0, 0),
(67, 891409057, 'Asociacion de Padres y Madres de Familia  del Colegio Calasanz ', 1, 1, '', '0000-00-00', '6063264877', 'asocalasanz@calasanz-pereira.edu.co', 'Mauricio Delgado Sepulveda', '', '0000-00-00', '6063264877', 'asocalasanz@calasanz-pereira.edu.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'asocalasanz@calasanz-pereira.edu.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 19 # 46 - 50 Barrio El Jardin', '', '', '', '', '', '', 0, 0),
(68, 800181614, 'Asociacion Viva Cerritos ', 1, 1, '', '0000-00-00', '3122734366', 'info@vivacerritos.com', 'Natalia Atehortua ', '', '0000-00-00', '3122734366', 'info@vivacerritos.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'info@vivacerritos.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Kilometro 8 Via Cerritos Entrada 7', '', '', '', '', '', '', 0, 0),
(69, 816001215, 'Asservi SAS', 1, 1, '', '0000-00-00', '6063267167', 'recepcionfacturas@asservi.com', '', '', '0000-00-00', '6063267167', 'recepcionfacturas@asservi.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recepcionfacturas@asservi.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Urbanizacion Belmonte Lote 7A Via Cerritos', '', '', '', '', '', '', 0, 0),
(70, 816001249, 'Asul SAS', 1, 1, '', '0000-00-00', '', 'compras@asul.com.co', 'Diana Rendon', '', '0000-00-00', '3145559380', 'compras@asul.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'compras@asul.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 12 # 3 - 23 ', '', '', '', '', '', '', 0, 0),
(71, 900133107, 'Atesa de Occidente', 1, 1, '', '0000-00-00', '3113844356', 'coord.sig@atesa.com.co', 'Yesica Taborda', '', '0000-00-00', '3113844356', 'fact.risaralda@atesa.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'fact.risaralda@atesa.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'KIlometro 15 Entrada 7 Via Pereira Cerritos', '', '', '', '', '', '', 0, 0),
(72, 900764367, 'Batara Parque Central ', 1, 1, '', '0000-00-00', '3024233247', 'contabilidadbatara@gmail.com', '', '', '0000-00-00', '6063168212', 'contabilidadbatara@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidadbatara@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 82 # 34 - 65 ', '', '', '', '', '', '', 0, 0),
(73, 900490788, 'Becall Outsourcing SAS', 1, 1, '', '0000-00-00', '6063402462', 'luisangel.martinez@becallgroup.com', 'luis Angel Martinez Melon', '', '0000-00-00', '6063402462', 'luisangel.martinez@becallgroup.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'luisange.martinez@becallgroup.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 10 # 17 - 55 Piso 8 Edificio Torre Central', '', '', '', '', '', '', 0, 0),
(74, 800138082, 'Bellatela', 1, 1, '', '0000-00-00', '6067357862', 'bellatelaarmenia@bellatela.com', '', '', '0000-00-00', '6067357862', 'bellatelaarmenia@bellatela.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'bellatelaarmenia@bellatela.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Quindío', 'Armenia', 'Calle 18 # 16 - 22', '', '', '', '', '', '', 0, 0),
(75, 900938433, 'Biable Ingenieria y Servicios SAS', 1, 1, '', '0000-00-00', '3155463150', 'biable.sas@gmail.com', 'Santiago Bedoya ', '', '0000-00-00', '3155463150', 'biable.sas@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'biable.sas@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 105 # 14A - 65 Manzana B Bodega 7 Sector Barlovento ', '', '', '', '', '', '', 0, 0),
(76, 901309315, 'BLCH SAS', 1, 1, '', '0000-00-00', '3117529315', 'blchfacturacion@gmail.com', 'Paula Viviana Parra', '', '0000-00-00', '', 'blchfacturacion@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'blchfacturacion@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Caldas', 'Villamaría', 'Calle 71 # 1 - 516 casa 151', '', '', '', '', '', '', 0, 0),
(77, 901560050, 'Blue Energy Ingenieria Sostenible SAS', 1, 1, '', '0000-00-00', '3108907411', 'bluenergysas@gmail.com', '', '', '0000-00-00', '3108907411', 'bluenergysas@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'bluenergysas@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 23 # 15 - 27 Barrio Centenario', '', '', '', '', '', '', 0, 0),
(78, 900350398, 'Botas Torino LTDA', 1, 1, '', '0000-00-00', '3125819781', 'botastorino@hotmail.com', '', '', '0000-00-00', '3125819781', 'botastorino@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'botastorino@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Tolima', 'Ibagué', 'Carrera 7 # 10 - 35 Barrio Belen ', '', '', '', '', '', '', 0, 0),
(79, 890300327, 'Brilladora El Diamante', 1, 1, '', '0000-00-00', '6025147777', 'administracionpereira@diamante.com.co', 'Claudia Tole', '', '0000-00-00', '6025147777', 'administracionpereira@diamante.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'administracionpereira@diamante.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Valle del Cauca', 'Cali', 'administracionpereira@diamante.com.co', '', '', '', '', '', '', 0, 0),
(80, 816006799, 'Busscar de Colombia SAS ', 1, 1, '', '0000-00-00', '6063148181', '816006799@factureinbox.co', 'Bruno Eduardo Seidel ', '', '0000-00-00', '6063148181', '816006799@factureinbox.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '81006799@factureinbox.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Kilometro 14 Via Cerritos', '', '', '', '', '', '', 0, 0),
(81, 2147483647, 'Call Center Solutions of America SAS ', 1, 1, '', '0000-00-00', '3168231263', 'callcentersolitionsofa@gmail.com', 'Alba Lucia Jimenez ', '', '0000-00-00', '3168231263', 'callcentersolutionsofa@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'calcentersolutionsofa@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Via Cerritos Pereira entre Sonesta Hotel y Parque Consota 14 y 15 Cerritos Mall  Plaza PH 306', '', '', '', '', '', '', 0, 0),
(82, 901402448, 'Calzaunico SAS', 1, 1, '', '0000-00-00', '6025533364', 'atencionalcliente@calzaunico.com', 'Carlos Alberto Hernandez ', '', '0000-00-00', '3005752443', 'atencionalcliente@calzaunico.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'atencionalcliente@calzaunico.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Valle del Cauca', 'Cali', 'Calle 24 # 7 - 17', '', '', '', '', '', '', 0, 0),
(83, 2147483647, 'Camposol Colombia', 1, 1, '', '0000-00-00', '3175130247', 'edocumentsco@camposol.co', 'Maria Alejandra Castano', '', '0000-00-00', '3175130247', 'edocumentsco@camposol.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'edocumentsco@camposol.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 15 # 12 - 37 oficina 901 Torre Nucleo Sector Los Alpes ', '', '', '', '', '', '', 0, 0),
(84, 900799501, 'CanizalesSAS', 1, 1, '', '0000-00-00', '3137210362', 'contabilidad@canizales.com.co', 'Andres Lasso', '', '0000-00-00', '3137210362', 'contabilidad@canizales.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@canizales.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Belalcazar Calle 18 # 16 - 24', '', '', '', '', '', '', 0, 0),
(85, 815005084, 'Cantera de Combia Sociedad Por Acciones Simplificadas', 1, 1, '', '0000-00-00', '3122600812', 'facturacion@canteradecombia.com', '', '', '0000-00-00', '', 'facturacion@canteradecombia.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@canteradecombia.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Kilometro 3 Via Pereira Marsella', '', '', '', '', '', '', 0, 0),
(86, 822004452, 'Carnes danny SAS', 1, 1, '', '0000-00-00', '6086707700', 'contabilidad@carnesdanny.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@carnesdanny.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'Carrera 38 # 26C - 72 Barrio Siete de Agosto', '', '', '', '', '', '', 0, 0),
(87, 900937951, 'Celugroup', 1, 1, '', '0000-00-00', '0345017389', 'jose.alzate.ext@outlook.com', '', '', '0000-00-00', '6045017389', 'jose.alzate.ext@outlook.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'jose.alzate.ext@outlook.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Antioquia', 'Medellín', 'Transversal 39B # 79A - 74', '', '', '', '', '', '', 0, 0),
(88, 900335120, 'Central de Ingenieros', 1, 1, '', '0000-00-00', '3105549306', 'centralingltda@gmail.com', 'Jhon Duenas', '', '0000-00-00', '3105549306', 'centralingltda@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'centralingltda@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 20 # 82 - 52', '', '', '', '', '', '', 0, 0),
(89, 800215977, 'Central Mayoristas de Alimentos Mercasa ', 1, 1, '', '0000-00-00', '3148939617', 'mercasafacturaele@hotmail.com', 'Gloria Cecilia Ochoa ', '', '0000-00-00', '', 'mercasafacturaele@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'manufacture@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'mercasafacturaele@hotmail.com', '', '', '', '', '', '', 0, 0),
(90, 891410922, 'Centro Comercial Alcides Arevalo', 1, 1, '', '0000-00-00', '6063356829', 'facturacentrocomercial@alcidesarevalo.com', '', '', '0000-00-00', '', 'facturacentrocomercial@alcidesarevalo.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacentrocomercial@alcidesarevalo.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'Calle 19 # 6 - 40 Oficina 300', '', '', '', '', '', '', 0, 0),
(91, 900489892, 'Centro Comercial El Progreso', 1, 1, '', '0000-00-00', '3147752161', 'docelectronicos@centrocomercialelprogreso.com', 'Orbilio de Jesus Echeverry Isaza', '', '0000-00-00', '6063320606', 'docelectronicos@centrocomercialelprogreso.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'docelectronicos@centrocomercialelprogreso.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Simon Bolivar Carrera 16 # 38 - 130', '', '', '', '', '', '', 0, 0),
(92, 900460864, 'etemco', 1, 1, '', '0000-00-00', '', 'auxiliarcontable@etemco.co', 'Carolina Castrillon Lopez', '', '0000-00-00', '6063347557', 'auxiliarcontable@etemco.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'auxiliarcontable@etemco.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 24 # 6 - 73', '', '', '', '', '', '', 0, 0),
(93, 901328293, 'Cestino Artesanal', 1, 1, '', '0000-00-00', '3137388428', 'cestinoartesanal@gmail.com', 'JUlio Gonzalez', '', '0000-00-00', '3137388428', 'cestinoartesanal@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cestinoartesanal@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 17 Bis # 15 - 42', '', '', '', '', '', '', 0, 0),
(94, 900827346, 'Clase y Cocina', 1, 1, '', '0000-00-00', '3165217215', 'agparquearboleda@gmail.com', 'Alexandra Clase y Cocina', '', '0000-00-00', '3165217215', 'agparquearboleda@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'agparquearboleda@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Circunvalar # 5 - 20 Local 225B', '', '', '', '', '', '', 0, 0),
(95, 890900265, 'Coats Cadena', 1, 1, '', '0000-00-00', '6063398200', 'co.invoices1@coats.com', 'Karen Otalvaro', '', '0000-00-00', '6063398200', 'co.invoces1@coats.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'co.invoices1@coats.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Santander # 5E - 87 Barrio Kennedy', '', '', '', '', '', '', 0, 0),
(96, 816000111, 'Comercial Onix', 1, 1, '', '0000-00-00', '6063413394', 'facturacion@comercialonix.com', '', '', '0000-00-00', '6063413394', 'facturacion@comercialonix.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@comercialonix.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'facturacion@comercialonix.com', '', '', '', '', '', '', 0, 0),
(97, 800187910, 'Comercializadora de Importados Los Amigos', 1, 1, '', '0000-00-00', '6024100019', 'proveedores@creamigo.com', 'Walter Ospina Arango', '', '0000-00-00', '6024100010', 'proveedores@creamigo.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'proveedores@creamigo.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Valle del Cauca', 'Cali', 'Carrera 1 # 47 - 51', '', '', '', '', '', '', 0, 0),
(98, 891480035, 'UNIVERSIDAD TECNOLOGICA DE PEREIRA ', 1, 1, '', '0000-00-00', '', '', 'FRANCY ', 'QUIMICA ', '0000-00-00', '3206680366', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'bodegaalmacen@utp.edu.co', '25 de cada mes', '1 vez al año', 'Noviembre', 'No', 0, '', 'Risaralda', 'Pereira', '', '', '', '', '', '', '', 2000, 0),
(99, 900304004, 'Compromiso Empresarial Para El Reciclaje ', 1, 1, '', '0000-00-00', '3166900988', 'infocempre@cempre.org.co', 'Andrea Aragon', '', '0000-00-00', '3166900988', 'infocempre@cempre.org.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'infocempre@cempre.org.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 5 # 69 - 14 Oficina 301', '', '', '', '', '', '', 0, 0),
(100, 800027890, 'Computadores y Suministros', 1, 1, '', '0000-00-00', '6063335206', 'compusum@une.net.co', '', '', '0000-00-00', '6063335206', 'compusum@une.net.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'compusum@une.net.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'compusum@une.net.co', '', '', '', '', '', '', 0, 0),
(101, 901386795, 'Con Toda confianza SAS', 1, 1, '', '0000-00-00', '3187772522', 'oir721@gmail.com', 'Oscar Julian Sarmiento', '', '0000-00-00', '3187772522', 'oir721@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'oir721@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 8 # 20 - 67 Oficina 408', '', '', '', '', '', '', 0, 0),
(102, 800103489, 'Conjunto Multifamiliar Las Garzas ', 1, 1, '', '0000-00-00', '3005292071', 'admonlasgarzasph@gmail.com', 'Deisy Diaz Romero', '', '0000-00-00', '3005292071', 'admonlasgarzasph@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'admonlasgarzasph@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida 30 de Agosto 34 - 38', '', '', '', '', '', '', 0, 0),
(103, 900294895, 'Conjunto Residencial Tacaragua Propiedad Horizontal', 1, 1, '', '0000-00-00', '6063310522', 'tacaragua00@gmail.com', 'Francia Elena Morales', '', '0000-00-00', '6063310522', 'tacaragua00@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'tacaragua00@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 5 # 19 - 25 Barrio Pinares ', '', '', '', '', '', '', 0, 0),
(104, 900856332, 'Construcciones y Consultoria de Obras SAS', 1, 1, '', '0000-00-00', '3002875714', 'cycovsas.fe@gmail.com', 'Jorge Tulcan', '', '0000-00-00', '3002875714', 'cycovsas.fe@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cucovsas.fe@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 97 # 16 - 00 Local 2 Urbanización Palmas de Belmonte', '', '', '', '', '', '', 0, 0),
(105, 816007300, 'Construcciones El Cairo', 1, 1, '', '0000-00-00', '3103705888', 'compras@cairo.com.co', 'Danielle Castaneda ', '', '0000-00-00', '3103705888', 'compras@cairo.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'compras@cairo.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Kilometro 16 Via Cerritos Viterbo', '', '', '', '', '', '', 0, 0),
(106, 900729014, 'construcciones Guayacan SAS', 1, 1, '', '0000-00-00', '3204786585', 'construguayacansas@hotmail.com', 'Carlos JUlio Guayacan', '', '0000-00-00', '3204786585', 'construguayacansas@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'construguayacansas@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Carrera 82 # 13F - 26 ', '', '', '', '', '', '', 0, 0),
(107, 901387233, 'construyendo Futuro y Espacio SAS', 1, 1, '', '0000-00-00', '3105140346', 'ventas@befitoficial.co', '', '', '0000-00-00', '3105140346', 'ventas@befitoficial.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'ventas@befitoficial.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', '', '', '', '', '', '', '', 0, 0),
(108, 891401761, 'Cooperativa de Taxis Consota Ltda', 1, 1, '', '0000-00-00', '6063335317', 'cootaxconsota@gmail.com', 'Mauricio Gonzalez', '', '0000-00-00', '6063335317', 'cootaxconsota@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cootaxconsota@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 16B # 17 - 23 Barrio Mejia Robledo', '', '', '', '', '', '', 0, 0),
(109, 900059695, 'Cooperativa de Trabajo Asociado Contribuir Empresarial', 1, 1, '', '0000-00-00', '6063266745', 'facturacion@contribuirempresarial.com', 'Yessenia Toro ', '', '0000-00-00', '6063266745', 'facturacion@contribuirempresarial.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@contribuirempresarial.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 34 # 8B - 40 Oficina 202 Barrio Primero de Febrero ', '', '', '', '', '', '', 0, 0),
(110, 891400592, 'Cooperativa de Transportadores del Risaralda', 1, 1, '', '0000-00-00', '6063138512', 'asistenteadministrativa@cootraris.com', 'Wilmar Alexander Gomez ', '', '0000-00-00', '6063138512', 'asistenteadministrativa@cootraris.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'asistenteadministrativa@cootraris.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Carrera 2 Norte 54 - 193 KIlometro 12 Variante La Romelia el Pollo', '', '', '', '', '', '', 0, 0);
INSERT INTO `cliente` (`nit`, `cod_cliente`, `cliente`, `id_usuario`, `id_entidad`, `representante_legal`, `cumple_representante`, `celular_representante`, `correo_representante`, `contacto`, `cargo`, `cumple_contacto`, `celular_contacto`, `correo_contacto`, `contacto2`, `cargo2`, `cumple_contacto2`, `celular_contacto2`, `correo_contacto2`, `contacto3`, `cargo3`, `cumple_contacto3`, `celular_contacto3`, `correo_contacto3`, `contacto4`, `cargo4`, `cumple_contacto4`, `celular_contacto4`, `correo_contacto4`, `correo_factura`, `fecha_cierrefacturacion`, `entregas_anuales`, `meses_entrega`, `nuevos_ingresos`, `cantidad_ingresos`, `proveedor_actual`, `departamento1`, `ciudad1`, `direccion1`, `departamento2`, `ciudad2`, `direccion2`, `departamento3`, `ciudad3`, `direccion3`, `empleados_directos`, `empleados_dotacion`) VALUES
(111, 891400646, 'Cooperativa del municipio de Pereira y Departamento de Risaralda', 1, 1, '', '0000-00-00', '6063358228', 'cooper40@gmail.com', 'Liliana Patricia Carmona', '', '0000-00-00', '6063358228', 'cooper40@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cooper40@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 21 # 5 - 48 ', '', '', '', '', '', '', 0, 0),
(112, 891400089, 'Cooperativa de Choferes de Pereira', 1, 1, '', '0000-00-00', '6063317161', 'coochoferessecretaria@gmail.com', '', '', '0000-00-00', '6063317161', 'coochoferessecretaria@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'coochoferessecretaria@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida del Rio # 5 - 75', '', '', '', '', '', '', 0, 0),
(113, 816007243, 'Cooperativa Multiactiva de Empleados de Busscar de Colombia', 1, 1, '', '0000-00-00', '6063148181', 'coobusscar@busscar.com.co', 'Gustavo Adolfo Mejia', '', '0000-00-00', '6063148181', 'coobusscar@busscar.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'coobusscar@busscar.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'KIlometro 14 Via Pereira Cerritos', '', '', '', '', '', '', 0, 0),
(114, 816007113, 'Crisalltex SA ', 1, 1, '', '0000-00-00', '6063366901', 'ejecomprasprod@crisalltex.com.co', '', '', '0000-00-00', '', 'ejecomprasprod@crisalltex.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'ejecomprasprod@crisalltex.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida 30 de Agosto # 47 - 80 ', '', '', '', '', '', '', 0, 0),
(115, 800053619, 'CUPULA', 1, 1, '', '0000-00-00', '3146435470', 'contabilidad@cupula.com.co', 'Laura Manzano', '', '0000-00-00', '3146435470', 'talentohumano@constructoracupula.com', 'Carlos Uriel Medina', 'Analista Talento Humano', '0000-00-00', '3206715390', 'carlos.medina@constructoracupula.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@cupula.com.co', '22 de cada mes', 'Seleccione una opción', 'Abril,Agosto,Diciembre', 'No', 0, '', 'Antioquia', 'Medellín', 'Carrera 48 # 16 Sur - 08 ', '', '', '', '', '', '', 0, 0),
(116, 900911811, 'Dent Removal SAS', 1, 1, '', '0000-00-00', '6063244512', 'dentmastercolombia@hotmail.com', '', '', '0000-00-00', '6063244512', 'dentmastercolombia@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'dentmastercolombia@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 15 Bis 23 - 08 Avenida Belalcazar Barrio Centro ', '', '', '', '', '', '', 0, 0),
(117, 901509923, 'Dia Linn SAS', 1, 1, '', '0000-00-00', '6063309504', 'dialinnsas@gmail.com', '', '', '0000-00-00', '6063309504', 'dialinn@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'dialinnsas@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Calle 8 # 19 - 40 Barrio El Japom', '', '', '', '', '', '', 0, 0),
(118, 901462803, 'El Gran Pez Pereira ', 1, 1, '', '0000-00-00', '3137469513', 'pesquera.elgranpez.pereira@hotmail.com', 'Lorenza Milena Velez ', '', '0000-00-00', '3137469513', 'pesquera.elgranpez.pereira@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'pesquera.elgranpez.pereira@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 23 Bis # 71 - 35 Barrio Cuba', '', '', '', '', '', '', 0, 0),
(119, 900955856, 'dos R Movilidad SAS', 1, 1, '', '0000-00-00', '3188717963', 'nuribe@dosr.co', 'Mary Rosado', '', '0000-00-00', '3188717963', 'nuribe@dosr.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'nuribe@dosr.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 43 # 1 Sur - 188 ', '', '', '', '', '', '', 0, 0),
(120, 800204486, 'Dotakondor SAS', 1, 1, '', '0000-00-00', '6044488933', 'contabilidad@dotakondor.com', '', '', '0000-00-00', '604488933', 'contabilidad@dotakondor.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@dotakondor', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Antioquia', 'Medellín', 'Carrera 50 # 50 - 14 Piso 18 Edificio Banco Popular', '', '', '', '', '', '', 0, 0),
(121, 900806869, 'Drogueria Castano', 1, 1, '', '0000-00-00', '6063338787', 'drogueriacastanopereira@gmail.com', '', '', '0000-00-00', '6063338787', 'Drogueriacastanopereira@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'drogueriacastanopereira@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 7 # 16 - 04', '', '', '', '', '', '', 0, 0),
(122, 891408453, 'Edificio Centro del Comercio Propiedad Horizontal', 1, 1, '', '0000-00-00', '3104219334', 'edificiocentrodelcomercio@hotmail.com', 'Diego Fernando Bernal', '', '0000-00-00', '6063350469', 'edificiocentrodelcomercio@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'edificiocentrodelcomercio@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 17 # 6 -29 Centro', '', '', '', '', '', '', 0, 0),
(123, 802018014, 'El Poblado SA', 1, 1, '', '0000-00-00', '6063292019', 'recepcionpei@elpobladosa.com', 'Ana Maria Toro', '', '0000-00-00', '6063292019', 'recepcionpei@elpobladosa.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recepcionpei@elpobladosa.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 49 # 74 - 157 ', '', '', '', '', '', '', 0, 0),
(124, 900935440, 'Electroval Colombia', 1, 1, '', '0000-00-00', '6063123885', 'fernando.ruiz@simat.co', 'Jorge Andres Ruiz', '', '0000-00-00', '6063123885', 'fernando.ruiz@simat.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'fernando.ruiz@simat', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 11 # 16B - 40 Oficina 511 Centro de Negocios Quality', '', '', '', '', '', '', 0, 0),
(125, 901472834, 'El Quimico SAS', 1, 1, '', '0000-00-00', '6063486660', 'elquimicomarket@outlook.com', 'Laura Catalina Guzman', '', '0000-00-00', '6063486660', 'elquimicomarket@outlook.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'elquimicomarket@outlook.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 7 # 13 - 20', '', '', '', '', '', '', 0, 0),
(126, 816006364, 'Equimes Distribuciones', 1, 1, '', '0000-00-00', '6063270636', 'equimes@equimes.com', '', '', '0000-00-00', '6063270636', 'equimes@equimes.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'equimes@equimes.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 24 Bis # 72B - 100 Barrio Cuba ', '', '', '', '', '', '', 0, 0),
(127, 900223824, 'espiritu Urbano SAS', 1, 1, '', '0000-00-00', '3174008525', 'espiritu.urbano@hotmail.com', 'Diana Alejandra Aristizabal', '', '0000-00-00', '3174008525', 'espiritu.urbano@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'espiritu.urbano@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 8 # 18 - 108 Barrio El Japom', '', '', '', '', '', '', 0, 0),
(128, 891409291, 'Eve Distribuciones', 1, 1, '', '0000-00-00', '6063248444', 'financiero.pereira@evedisa.com.co', 'Diego Calvo', '', '0000-00-00', '6063248444', 'financiero.pereira@evedisa.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'financiero.pereira@evedisa.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 22 # 9 - 63', '', '', '', '', '', '', 0, 0),
(129, 891411821, 'Federacion Nacional de Comerciantes Seccional  Risaralda', 1, 1, '', '0000-00-00', '6063254547', 'cartera@fenalcorisaralda.com', '6063254547', '', '0000-00-00', '', 'cartera@fenalcorisaralda.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cartera@fenalcorisaralda.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 7 # 16 - 50 Tercer Piso Edificio Centro del Comercio ', '', '', '', '', '', '', 0, 0),
(130, 901785847, 'Feel Fit Pereira', 1, 1, '', '0000-00-00', '3113745588', 'feelfitpereira@gmail.com', '', '', '0000-00-00', '3113745588', 'feelfitpereira@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'feelfitpereira@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 17 # 10 - 52 Local 4 Barrio Pinares', '', '', '', '', '', '', 0, 0),
(131, 891408269, 'Frigorifico de Pereira SA', 1, 1, '', '0000-00-00', '6063401644', 'proveedores@frigoper.com.co', 'Maria Alexandra NIeto', '', '0000-00-00', '6063401644', 'proveedores@frigoper.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'proveedores@froper.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 14 # 83 - 125 Villa OLimpica', '', '', '', '', '', '', 0, 0),
(132, 901040063, 'Generando Construcciones', 1, 1, '', '0000-00-00', '3122600812', 'facturacion@canteradecombia.com', 'Erika Valencia', '', '0000-00-00', '3122600812', 'facturacion@canteradecombia.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@canteradecombia.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Kilometro 3 Via Pereira Marsella', '', '', '', '', '', '', 0, 0),
(133, 2147483647, 'Green SuperfoodSAS', 1, 1, '', '0000-00-00', '3176622450', 'facturas@greensuperfood.co', '', '', '0000-00-00', '3176622450', 'facturas@greensuperfood.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturas@greensuperfood.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Quindío', 'Armenia', 'Vereda Mesopotamia Finca Mesopotamia', '', '', '', '', '', '', 0, 0),
(134, 901303960, 'Utilitario SAS', 1, 1, '', '0000-00-00', '3105152579', 'utilitariossas@gmail.com', '', '', '0000-00-00', '3105152579', 'utilitariossas@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'utilitariossas@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 46 # 46 - 53 ', '', '', '', '', '', '', 0, 0),
(135, 816006697, 'Vehiculos del Cafe SAS', 1, 1, '', '0000-00-00', '3177436977', 'facturacionelectronica@vehicafe.com.co', 'Edna Cardona', '', '0000-00-00', '3177436977', 'facturacionelectronica@vehicafe.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionelectronica@vehicafe.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida 30 de Agosto # 100 - 112 ', '', '', '', '', '', '', 0, 0),
(136, 900800220, 'Vicunha Colombia SAS', 1, 1, '', '0000-00-00', '3160180407', 'l.bravo@vicunha.com.br', '', '', '0000-00-00', '', 'l.bravo@vicunha.com.br', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'l.bravo@vicunha.com.br', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Antioquia', 'Medellín', 'calle 20 Sur # 27 - 55 Oficina 9947 ST 1', '', '', '', '', '', '', 0, 0),
(137, 900741830, 'Vital Mascotas SAS', 1, 1, '', '0000-00-00', '6063118330', 'administracion@vitalmascotas.com.co', '', '', '0000-00-00', '6063118330', 'administracion@vitalmascotas.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'administracion@vitalmascotas.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 14 # 21 - 82 Barrio Alamos', '', '', '', '', '', '', 0, 0),
(138, 900750221, 'Vpack SAS', 1, 1, '', '0000-00-00', '6063307457', 'comercial.vpack@gmail.com', 'Maria Isabel Nupan Garcia', '', '0000-00-00', '6063307457', 'comercial.vpack@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'comercial@vpackgmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Sec Antigua PLaza de Ferias Bodega 101B', '', '', '', '', '', '', 0, 0),
(139, 900268784, 'Wireless Communications colombia SAS', 1, 1, '', '0000-00-00', '3182705161', 'wirlcomm@wirlcomm.com', '', '', '0000-00-00', '6063400448', 'wirlcomm@wirlcomm.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'wirlcomm@wirlcomm.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 16 # 23 - 33 Barrio Centenario ', '', '', '', '', '', '', 0, 0),
(140, 891411226, 'Unidad Residencial Barrio Olimpico manzana 28 y 31 Propiedad Horizontal', 1, 1, '', '0000-00-00', '3175940822', 'unidadresidencialolimpico1@hotmail.com', 'Gloria Lucia Gallego Gonzalez', '', '0000-00-00', '6063371186', 'unidadresialolimpico1@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'unidadresidencialolimpico1@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 82 Bis # 18 - 10', '', '', '', '', '', '', 0, 0),
(141, 900431936, 'Umi Salud ', 1, 1, '', '0000-00-00', '3185482631', 'contabilidad@opticasvisionysol.com.co', 'Karol Lisbeth Perez', '', '0000-00-00', '3185482631', 'contabilidad@opticasvisionysol.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@opticasvisionysol.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 8 # 29 - 46', '', '', '', '', '', '', 0, 0),
(142, 900074359, 'Ucimed', 1, 1, '', '0000-00-00', '6063332099', 'asistentepereira@ucimedsa.com', '', '', '0000-00-00', '6063332099', 'asistentepereira@ucimedsa.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'asistentepereira@ucimedsa.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'Calle 3B # 15 - 34 Avenida Circunvalar', '', '', '', '', '', '', 0, 0),
(143, 901246517, 'Tu Reserva Trip SAS', 1, 1, '', '0000-00-00', '6063486379', 'contabilidad@tureservatrip.com', '', '', '0000-00-00', '6063486379', 'contabilidad@tureservatrip.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@tureservatrip.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 17 Bis # 15 -42 Piso 1 LOcal 1 Barrio mejia Robledo', '', '', '', '', '', '', 0, 0),
(144, 900406248, 'Trusan SAS', 1, 1, '', '0000-00-00', '6063288893', 'avisenal@yohoo.es', '', '', '0000-00-00', '6063288893', 'avisenal@yahoo.es', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'avisenal@yahoo.es', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Carrera 4 # 9A - 21 Barrio La Graciela ', '', '', '', '', '', '', 0, 0),
(145, 900119988, 'Triturados de Combia SA', 1, 1, '', '0000-00-00', '3122600812', 'facturacion@canteradecombia.com', 'Erika Valencia ', '', '0000-00-00', '3122600812', 'facturacio@canteradecombia.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@canteradecombia.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Kilometro 3 Via Pereira Marsella', '', '', '', '', '', '', 0, 0),
(146, 830081791, 'Transportes Pegasso SAS', 1, 1, '', '0000-00-00', '6015922424', 'compras@cairo.com.co', 'Danielle Castano', '', '0000-00-00', '6015922424', 'compras@cairo.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'compras@cairo.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Carrera 7 # 114 - 33 Oficina 805', '', '', '', '', '', '', 0, 0),
(147, 900431274, 'Topigenetica SAS', 1, 1, '', '0000-00-00', '3102566411', 'topigenetica@comprasgmail.com', '', '', '0000-00-00', '3102566411', 'topigeneticacompras@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'topigeneticacompras@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Edificio Administrativo Mercasa Oficina 402 Barrio Belmonte', '', '', '', '', '', '', 0, 0),
(148, 901799470, 'Techno Industrial', 1, 1, '', '0000-00-00', '3122068860', 'info@technoindustrial.com', '', '', '0000-00-00', '3122068860', 'info@technoindustrial.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'info@technoindustrial.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', '', '', '', '', '', '', '', 0, 0),
(149, 900555619, 'Surtifacil Pereira SAS', 1, 1, '', '0000-00-00', '6063401760', 'contabilidad@surtifacil.com.co', 'Fernando Ortiz Cardona', '', '0000-00-00', '6063401760', 'contabilidad@surtifacil.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@surtifacil.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 4 # 11 - 14', '', '', '', '', '', '', 0, 0),
(150, 901167716, 'Sohoapp', 1, 1, '', '0000-00-00', '3012372600', 'info@m3medios.com', 'Jennifer Valencia Acevedo', '', '0000-00-00', '3012372600', 'info@m3medios.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'info@m3medios.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 14 # 18 - 54 Carrera 9', '', '', '', '', '', '', 0, 0),
(151, 900411297, 'Soltedeco SAS', 1, 1, '', '0000-00-00', '3183932983', 'recepcionfacturacion@soltedeco.com', 'Sandra Rodriguez', '', '0000-00-00', '3183932983', 'recepcionfacturacion@soltedeco.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recepcionfacturacion@soltedeco.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Santander', 'Bucaramanga', 'Calle 98 # 25 - 145 Barrio Diamante 2', '', '', '', '', '', '', 0, 0),
(152, 901375887, 'Soluciones Para La Construccion AAA SAS', 1, 1, '', '0000-00-00', '6063401445', 'gestorcomercial1@macarena.com.co', 'Maria Angelica Perez', '', '0000-00-00', '6063401445', 'gestorcomercial1@macarena.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gestorcomercial1@macarena.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Calle 11 # 6 - 211 Bodega 33 Antigua plaza de Ferias', '', '', '', '', '', '', 0, 0),
(153, 901415570, 'Style D Amour SAS', 1, 1, '', '0000-00-00', '3186606969', 'paonkidsboutique@gmail.com', 'Anyi Vanessa Garcia Aguirre', '', '0000-00-00', '3186606969', 'paonkidsboutique@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'paonkidsboutique@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Centro Comercial Unicentro Local B12', '', '', '', '', '', '', 0, 0),
(154, 900616155, 'Super Pagos', 1, 1, '', '0000-00-00', '3172309003', 'facturaelectronica@superpagos.com', 'Angela Villa ', '', '0000-00-00', '6063446171', 'facturaelectronica@superpagos.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturaelectronica@superpagos.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 7 # 19 - 48 Banco POpular Piso 6', '', '', '', '', '', '', 0, 0),
(155, 900504501, 'Supertex Eje Cafetero ', 1, 1, '', '0000-00-00', '6063229393', 'auxcontableec@supertexinc.com', 'Andres Caicedo Estrada', '', '0000-00-00', '6063229393', 'auxcontableec@supertexinc.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'auxcontableec@supertexinc.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Carrera 16 # 36 - 98 Bodega P', '', '', '', '', '', '', 0, 0),
(156, 900150406, 'Gruas Pereira', 1, 1, '', '0000-00-00', '6063152340', 'contabilidad@gruaspereira.com', '', '', '0000-00-00', '6063152340', 'contabilidad@gruaspereira.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@gruaspereira.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Kilometro 10 Via Pereira Armenia Vereda Guacari', '', '', '', '', '', '', 0, 0),
(157, 901247628, 'Grupo Datos Mercadeo y Comercial DM ', 1, 1, '', '0000-00-00', '3183771164', 'gerencia@dmcgrupo.com', 'Aura Maria Cardona Calderon', '', '0000-00-00', '3183771164', 'gerencia@dmcgrupo.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gerencia@dmcgrupo.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida 30 de Agosto # 40 - 09 Piso 3', '', '', '', '', '', '', 0, 0),
(158, 901519140, 'Grupo La Licuadora SAS', 1, 1, '', '0000-00-00', '3103880286', 'contabilidad@lalicuadora.com.co', 'Julio Baza', '', '0000-00-00', '3103880286', 'contabilidad@lalicuadora.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@lalicuadora.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'contabilidad@lalicuadora.com.co', '', '', '', '', '', '', 0, 0),
(159, 901261048, 'Grupo Uma', 1, 1, '', '0000-00-00', '6063469021', 'sincontacto@gmail.com', '', '', '0000-00-00', '6063469021', 'sincontacto@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'sincontacto@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Quindío', 'La Tebaida', 'Zona Franca', '', '', '', '', '', '', 0, 0),
(160, 891400819, 'Guillermo Pulgarin S.A', 1, 1, '', '0000-00-00', '6063135500', 'facturaelectronica@kostazul.com', '', '', '0000-00-00', '6063135500', 'facturaelectronica@kostazul.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturaelectronica@kostazul.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Carrera 15 Bis # 25 - 120', '', '', '', '', '', '', 0, 0),
(161, 901559909, 'Hidrosanitarias y de Incendios ', 1, 1, '', '0000-00-00', '3118301622', 'hidroincendios2022@hotmail.com', '', '', '0000-00-00', '3118301622', 'hidroincendios2022@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'hidroincendios2022@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Manzana 7 Casa 11 POrtal del Campo Etapa 1 Barrio Galicia ', '', '', '', '', '', '', 0, 0),
(162, 900729995, 'Hoteles del Otun ', 1, 1, '', '0000-00-00', '6063113600', 'kelly.castillo@ghhoteles.com', '', '', '0000-00-00', '3108752527', 'kelly.castillo@ghhoteles.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'kelly.castillo@ghhoteles.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Kilometro 7 Via Pereira Cartago Barrio Cachipay', '', '', '', '', '', '', 0, 0),
(163, 2147483647, 'Ibiza PLaza SA', 1, 1, '', '0000-00-00', '3206197394', 'paulac@ibizaplaza.co', 'Paula Castaneda', '', '0000-00-00', '3206197394', 'paulac@ibizaplaza.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'paulac@ibizaplaza.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Centro Comercial Bolivar PLaza Local 214', '', '', '', '', '', '', 0, 0),
(164, 900458004, 'Iglesia Cristiana Palabra Pura Nueva Generacion', 1, 1, '', '0000-00-00', '6063387340', 'auxiliar.admin@iglesiapura.com', '', '', '0000-00-00', '6063387340', 'auxiliar.admin@iglesiapura.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'auxiliar.admin@iglesiapura.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 21 # 3 - 26', '', '', '', '', '', '', 0, 0),
(165, 800189984, 'Imagenes Diagnosticas', 1, 1, '', '0000-00-00', '6063320000', 'recepcionfacturas@imadiag.com', 'Laura Maria Ballesteros ', '', '0000-00-00', '6063320000', 'recepcionfacturas@imadiag.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recepcionfacturas@imadiag.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 4 # 20 - 36', '', '', '', '', '', '', 0, 0),
(166, 891401711, 'Industrias Electromecanicas Magnetron SAS', 1, 1, '', '0000-00-00', '3156613128', 'recepcionfacturacion@magnetron.com.co', 'Diego Guevara', '', '0000-00-00', '3156613128', 'recepcionfacturacion@magnetron.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recepcionfacturacion@magnetron.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Kilometro 9 Via Pereira Cartago', '', '', '', '', '', '', 0, 0),
(167, 901051267, 'Infotec.com SAS', 1, 1, '', '0000-00-00', '6063337558', 'administracion@infotecpereira.com.co', '', '', '0000-00-00', '6063337558', 'administracion@infotecpereira.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'administracion@infotecpereira.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 16 # 5 - 36', '', '', '', '', '', '', 0, 0),
(168, 900386708, 'Ingenieria de Construccion y Mineria de Colombia ', 1, 1, '', '0000-00-00', '6016584878', 'contacto@cymcol.com', 'Hernan Correa Hrrera', '', '0000-00-00', '6016584878', 'contacto@cymcol.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contacto@cymcol.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Calle 118 # 16 - 61 Oficina 502', '', '', '', '', '', '', 0, 0),
(169, 901222229, 'Inter Red JP Comunicaciones SAS', 1, 1, '', '0000-00-00', '3013728888', 'interreddjpcomunicacionessas@gmail.com', 'Jhon Jairo Castro ', '', '0000-00-00', '3013728888', 'interredjpcomunicacionessas@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'interredjpcomunicacionessas@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Vereda Frailes Finca la Gardenia ', '', '', '', '', '', '', 0, 0),
(170, 900691598, 'In-Tuitiva Consultores SAS', 1, 1, '', '0000-00-00', '3103758454', 'financiera@intuitivaconsultores.com', '', '', '0000-00-00', '3103758454', 'financiera@intuitivaconsultores.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'financiera@intuitivaconsultores.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Caldas', 'Manizales', 'Calle Palermo 69 # 24 - 37  ', '', '', '', '', '', '', 0, 0),
(171, 900609643, 'Inversiones Aristizabal Garcia SAS', 1, 1, '', '0000-00-00', '6042314778', 'facturacionaristizabaljoyeros@gmail.com', '', '', '0000-00-00', '6042314778', 'facturacionaristizabaljoyeros@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionaristizabaljoyeros@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Antioquia', 'Medellín', 'Calle 46 # 51A - 26 Local 430', '', '', '', '', '', '', 0, 0),
(172, 900264266, 'Inversiones Fenix del Cafe SAS', 1, 1, '', '0000-00-00', '6067318689', 'infecasas@hotmail.com', '', '', '0000-00-00', '6067318699', 'infecasas@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'infacasas@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Quindío', 'Armenia', 'Calle 16 # 19 - 61 LOcal 201', '', '', '', '', '', '', 0, 0),
(173, 901041459, 'Inversiones La 16 SAS', 1, 1, '', '0000-00-00', '6063257465', 'tuercasytornillos16@hotmail.com', 'Diana Miladis Arias', '', '0000-00-00', '6063257465', 'tuercasytornillos16@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'tuercasytornillos16@hotmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 16 # 8 - 41 ', '', '', '', '', '', '', 0, 0),
(174, 900983005, 'J.S Water SAS', 1, 1, '', '0000-00-00', '3104308090', 'auxiliar.jswatersas@gmail.com', 'Ivonne Quintero', '', '0000-00-00', '3104308090', 'auxiliar.jswatersas@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'auxiliar.jswatersas@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Centro Comercial Fiducentro Local D-118', '', '', '', '', '', '', 0, 0),
(175, 816005588, 'Kaisa SAS', 1, 1, '', '0000-00-00', '6063401445', 'facturacion@lamacarena.org', 'Catalina Diaz', '', '0000-00-00', '0363401445', 'facturacion@lamacarena.org', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@lamacarena.org', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Calle 11 # 6 - 211 Bodega 33', '', '', '', '', '', '', 0, 0),
(176, 901188803, 'Kontrol ing Interventoría y Supervision Tecnica SAS  ', 1, 1, '', '0000-00-00', '3173708570', 'kontrol.ing.tecnica@outlook.com', '', '', '0000-00-00', '3133708570', 'kontrol.ing.tecnica@outlook.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'kontrol.ing.tecnica@outlook.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Caldas', 'Manizales', 'Calle 8B # 11 - 44 Apartamento 601 Edificio Vittanza Chipre', '', '', '', '', '', '', 0, 0),
(177, 800083176, 'Lazos S.A ', 1, 1, '', '0000-00-00', '6063359700', 'contador@lazosnet.com', 'Eduardo Vallejo ', '', '0000-00-00', '6063359700', 'contador@lazosnet.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contador@lazosnet.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 8 # 23 - 09 Oficina 1105', '', '', '', '', '', '', 0, 0),
(178, 901245278, 'linea Agricola Colombiana SAS ', 1, 1, '', '0000-00-00', '6064030330', 'sebastian.florez@wenco.com.co', 'Eduardo Hernandez ', '', '0000-00-00', '6064030330', 'sebastian.florez@wenco.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'sebastian.florez@wenco.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Zona Franca Internacional de Pereira Bodega 19', '', '', '', '', '', '', 0, 0),
(179, 816004842, 'Magro S.A ', 1, 1, '', '0000-00-00', '6063204717', 'comprasmagro@gmail.com', '', '', '0000-00-00', '6063204717', 'comprasmagro@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'comprasmagro@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Las Americas Mercasa EDificio Administrativo Oficina 402', '', '', '', '', '', '', 0, 0),
(180, 900223334, 'Manufacturas Bajo Cero y Cia Ltda', 1, 1, '', '0000-00-00', '6016211853', 'manufacturasbajocero@gmail.com', '', '', '0000-00-00', '', 'manufacturasbajocero@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'manufacturasbajocero@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Carrera 27 # 70 - 57 ', '', '', '', '', '', '', 0, 0),
(181, 900277276, 'Maquinotas SAS', 1, 1, '', '0000-00-00', '6063333111', 'licitaciones@asul.com.co', '', '', '0000-00-00', '', 'licitaciones@asul.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'licitaciones@asul.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 12 # 2 - 23 Barrio Popular Modelo', '', '', '', '', '', '', 0, 0),
(182, 900859000, 'Masabor Colombia SAS', 1, 1, '', '0000-00-00', '3148188134', 'facturas@masabor.co', 'Angela Maria Echeverry Gomez', '', '0000-00-00', '3105197586', 'facturas@masabor.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturas@masabor.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Carrera 2A # 9A - 10 Sector La Badea', '', '', '', '', '', '', 0, 0),
(183, 805013949, 'Mercaloterias', 1, 1, '', '0000-00-00', '6024863445', 'tesoreria@mercaloterias.com', '', '', '0000-00-00', '6024863445', 'tesoreria@mercaloterias.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'tesoreria@mercaloterias.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Valle del Cauca', 'Cali', 'Calle 9 # 4 - 50', '', '', '', '', '', '', 0, 0),
(184, 900077031, 'Metal Cortes Risaralda SAS', 1, 1, '', '0000-00-00', '6063353020', 'facturacion@metalcortes.com.co', 'Luis Fernando Valdes', '', '0000-00-00', '6063353020', 'facturacion@metalcortes.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@metalcortes.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 18 # 16B - 09', '', '', '', '', '', '', 0, 0),
(185, 816008774, 'Metales y Maderas del Risaralda ', 1, 1, '', '0000-00-00', '6063261181', 'auxiliarcompras@metalesymaderas.co', 'Yenifer Guarin ', '', '0000-00-00', '6063261181', 'auxiliarcompras@metalesymaderas.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'auxiliarcompras@metalesymaderas.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida 30 de Agosto # 68 - 167', '', '', '', '', '', '', 0, 0),
(186, 900455578, 'Mil Zonas SAS', 1, 1, '', '0000-00-00', '3138849895', 'sgcmilzonas@gmail.com', 'Rodrigo Barreto ', '', '0000-00-00', '6012483879', 'sgcmilzonas@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'sgcmilzonas@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Cundinamarca', 'Cajicá', 'Carrera 6 # 20A - 42 Bodega 6 Parque Industrial y Comercial', '', '', '', '', '', '', 0, 0),
(187, 900463413, 'Mobiliar Ideas S.A.S', 1, 1, '', '0000-00-00', '6063304992', 'gerencia@mogano.com.co', '', '', '0000-00-00', '6063304992', 'gerencia@mogano.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gerencia@mogano.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 13 # 15 - 33 Edificio Torre Nucleo Local 3', '', '', '', '', '', '', 0, 0),
(188, 900766553, 'Moviaval SAS ', 1, 1, '', '0000-00-00', '6063252259', 'm.rosado@moviaval.com', 'Mary Rosado', '', '0000-00-00', '6063252259', 'm.rosado@moviaval.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'm.rosado@moviaval.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Circunvalar # 8B - 51 Oficina 302 Barrio Los alpes ', '', '', '', '', '', '', 0, 0),
(189, 900839808, 'Mowin Technologies SAS', 1, 1, '', '0000-00-00', '3104351049', 'facturacion@mowin-tech.com', '', '', '0000-00-00', '3104351049', 'facturacion@mowin-tech.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@mowin-tech.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 17 # 16B - 09 Local 8 ', '', '', '', '', '', '', 0, 0),
(190, 900743259, 'Oftalmologia de Alta Tecnologia ', 1, 1, '', '0000-00-00', '6063402779', 'gerencia@clinicaoat.com', 'David Salazar', '', '0000-00-00', '6063402779', 'gerencia@clinicaoat.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gerencia@clinicaoat.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'calle 6 # 17 - 55 ', '', '', '', '', '', '', 0, 0),
(191, 900480098, 'Optimo Inversiones y Proyectos S.A.S', 1, 1, '', '0000-00-00', '6063440414', 'facturacion@verticaldeconstruciones.com', 'Diego Alonso Sepulveda', '', '0000-00-00', '6063440414', 'facturacion@verticaldeconstrucciones.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@verticaldeconstrucciones.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 17 # 12 - 90 Sector Pinares', '', '', '', '', '', '', 0, 0),
(192, 860014710, 'Orden Religiosa de las EScuelas Pias o Escolapios ', 1, 1, '', '0000-00-00', '6016780968', 'facturacionelectronica@calasanz-pereira.edu.co', 'luis Oswaldo Ospina ', '', '0000-00-00', '6066781235', 'facturacionelectronica@calasanz-pereira.edu.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionelectronica@calasanz-pereira.edu.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Calle 175 # 17B - 81', '', '', '', '', '', '', 0, 0),
(193, 891411170, 'Panorama SAS', 1, 1, '', '0000-00-00', '6063402520', 'fepanorama@persianaspanorama.co', 'Luisa Arboleda', '', '0000-00-00', '6063402520', 'fepanorama@persianaspanorama.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'fepanorama@persianaspanorama.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Calle 8 # 13 - 20', '', '', '', '', '', '', 0, 0),
(194, 801001634, 'Parque nacional de la Cultura Agropecuaria SAS ', 1, 1, '', '0000-00-00', '3104042236', 'cont.panaca@panaca.co', 'Jorge Alonso Ballen', '', '0000-00-00', '3104042236', 'cont.panaca@panaca.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cont.panaca@panaca.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Antioquia', 'Medellín', 'carrera 43 calle 9 - 13 Oficinas 201 - 202 Edificio Modulor', '', '', '', '', '', '', 0, 0),
(195, 800027765, 'Partes y Complementos Plasticos SAS', 1, 1, '', '0000-00-00', '3118994331', '800027765@factureinbox.co', '', '', '0000-00-00', '6063495279', '800027765@factureinbox.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '800027765@factureinbox.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'La Virginia', 'Kilometro 3 Via Cerritos La Virginia Costado Izquierdo', '', '', '', '', '', '', 0, 0),
(196, 816004182, 'Pentagrama SAS', 1, 1, '', '0000-00-00', '6063295555', 'fe.recepcion@persianaspentagrama.com', 'Yeraldin Valencia', '', '0000-00-00', '606329555', 'fe.recepcion@persianaspentagrama.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'fe.recepcion@persianaspentagrama.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 40 # 11 - 55 Local 8 ', '', '', '', '', '', '', 0, 0),
(197, 900993495, 'Perlaseo SAS ', 1, 1, '', '0000-00-00', '3234671145', 'gerencia@perlaseo.com', '', '', '0000-00-00', '3234671145', 'gerencia@perlaseo.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gerencia@perlaseo.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida 30 de Agosto # 68 - 125 local 27 Cañaveral 1', '', '', '', '', '', '', 0, 0),
(198, 2147483647, 'Piscicola La Virginia ', 1, 1, '', '0000-00-00', '3103705888', 'compras@cairo.com.co', 'Margaret Venturini', '', '0000-00-00', '3113345623', 'compras@cairo.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'compras@cairo.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'La Virginia', 'Calle 18 # 5 - 27 ', '', '', '', '', '', '', 0, 0),
(199, 900110568, 'Plaza Mayor Constructora ', 1, 1, '', '0000-00-00', '6063304365', 'contabilidad@plazamayorconstructora.com', 'Daniela Hoyos ', '', '0000-00-00', '3153276370', 'contabilidad@plazamayorconstructora.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@plazamayorconstructora.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Centro Empresarial Guadalupe PLaza Calle 35 - 19 Oficina 4A', '', '', '', '', '', '', 0, 0),
(200, 901517611, 'Polaris Way SAS', 1, 1, '', '0000-00-00', '3206133732', 'polarisway21@gmail.com', 'Luis Arturo Aviles ', '', '0000-00-00', '3206133732', 'polarisway21@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'polarisway21@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 21 # 14 - 20 ', '', '', '', '', '', '', 0, 0),
(201, 890903939, 'Postobon SA', 1, 1, '', '0000-00-00', '6045765100', 'postobonofcentral@postobon.com.co', '', '', '0000-00-00', '6045765100', 'postobonofcentral@postobon.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'postobonofcentral@postobon.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Antioquia', 'Medellín', 'Calle 52 # 47 42 Piso 25', '', '', '', '', '', '', 0, 0),
(202, 800150223, 'Primatela', 1, 1, '', '0000-00-00', '6014137166', 'facturacionelectronica@primatela.com', 'Camila Andrea Quesada', '', '0000-00-00', '6014137166', 'facturacionelectronica@primatela.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionelectronica@primatela.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Carrera 63 # 17B - 50', '', '', '', '', '', '', 0, 0),
(203, 900204581, 'Prost Soportes Ortopédicos EU ', 1, 1, '', '0000-00-00', '6063337280', 'ortopedicascp@yahoo.com', '', '', '0000-00-00', '6063337280', 'ortopedicascp@yahoo.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'ortopedicascp@yahoo.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 24 # 6 - 45', '', '', '', '', '', '', 0, 0),
(206, 900409707, 'Proteccion Legal Abogados ', 1, 1, '', '0000-00-00', '3174376202', 'contabilidad@inmercio.com.co', 'Paula Andrea Torres ', '', '0000-00-00', '6063244040', 'contabilidad@inmercio.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@inmercio.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Juan B. Gutierrez # 17 - 55 Edificio Icono Oficina 508 Pinares de San Martin ', '', '', '', '', '', '', 0, 0),
(207, 900670973, 'Realidad Colombia ', 1, 1, '', '0000-00-00', '6063401608', 'facturacion@realidadcolombia.com', 'Alejandra Ortiz ', '', '0000-00-00', '6063401608', 'facturacion@realidadcolombia.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@realidadcolombia.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Calle 35 # 15 - 19 Oficina 503 Barrio Guadalupe ', '', '', '', '', '', '', 0, 0),
(208, 900007889, 'Recaudos Integrados ', 1, 1, '', '0000-00-00', '6063136100', 'facturacion@recaudosintegrados.com', '', '', '0000-00-00', '6063136100', 'facturacion@recaudosintegrados.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@recaudosintegrados.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida 30 de Agosto # 45 - 69 Barrio Maraya ', '', '', '', '', '', '', 0, 0),
(209, 800128680, 'Reencafe ', 1, 1, '', '0000-00-00', '6063365892', 'radicacionfacturas@reencafe.com', 'Jorge Ivan Gomez', '', '0000-00-00', '6063365892', 'radicacionfacturas@reencafe.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'radicacionfacturas@reencafe.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 45 # 8B - 45 Barrio Turin ', '', '', '', '', '', '', 0, 0),
(210, 900273435, 'Representaciones Idarraga e Idarraga SAS', 1, 1, '', '0000-00-00', '6063339192', 'facturacionelectronica@droguerias9192.com.co', 'Andrea Zaque ', '', '0000-00-00', '6063339192', 'facturacionelectronica@droguerias9192.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionelectronica@droguerias9192.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 7 # 16 - 79 ', '', '', '', '', '', '', 0, 0),
(211, 890929073, 'Ronelly SAS', 1, 1, '', '0000-00-00', '6044445590', 'recepcionfe@ronelly.com', '', '', '0000-00-00', '6044445590', 'recepcionfe@ronelly.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recepcionfe@ronelly.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Antioquia', 'Envigado', 'Carrera 49 # 46A Sur - 25', '', '', '', '', '', '', 0, 0),
(212, 900080616, 'SYM Servicios y Mercadeo SAS', 1, 1, '', '0000-00-00', '6063310404', 'recepcion.fe@servimercadeo.com', 'Dora Elena Taborda ', '', '0000-00-00', '6063310404', 'recepcion.fe@servimercadeo.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recepcion.fe@servimercadeo.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 12 # 3 - 55 ', '', '', '', '', '', '', 0, 0),
(213, 816006677, 'Saber SAS', 1, 1, '', '0000-00-00', '6063332647', 'comercialoffiexpress@gmail.com', '', '', '0000-00-00', '6063332647', 'comercialoffiexpress@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'comercialoffiexpress@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 3 # 18 - 26', '', '', '', '', '', '', 0, 0),
(214, 816005306, 'Sayonara SAS', 1, 1, '', '0000-00-00', '6063330003', 'facturacionelectronicaoficina@sayonara.co', '', '', '0000-00-00', '6063330003', 'facturacionelectronicaoficina@sayonara.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionelectronicaoficina@sayonara.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Circunvalar Calle 17 # 14 - 43 ', '', '', '', '', '', '', 0, 0),
(215, 900442955, 'Scribe Colombia SAS', 1, 1, '', '0000-00-00', '317704519', 'facturacolombia@biopappel.com', 'Johana Ramirez', '', '0000-00-00', '3173704519', 'facturacolombia@biopappel.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacolombia@biopappel.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida Santander # 11E - 20', '', '', '', '', '', '', 0, 0),
(216, 891408256, 'Seguridad Nacional Ltda', 1, 1, '', '0000-00-00', '3206192802', 'lmbustos@seguridadnacional.co', 'Lina Marcela Bustos ', '', '0000-00-00', '3206192802', 'lmbustos@seguridadnacional.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'lmbustos@seguridadnacional.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 10 # 15 - 64 Los Alpes ', '', '', '', '', '', '', 0, 0);
INSERT INTO `cliente` (`nit`, `cod_cliente`, `cliente`, `id_usuario`, `id_entidad`, `representante_legal`, `cumple_representante`, `celular_representante`, `correo_representante`, `contacto`, `cargo`, `cumple_contacto`, `celular_contacto`, `correo_contacto`, `contacto2`, `cargo2`, `cumple_contacto2`, `celular_contacto2`, `correo_contacto2`, `contacto3`, `cargo3`, `cumple_contacto3`, `celular_contacto3`, `correo_contacto3`, `contacto4`, `cargo4`, `cumple_contacto4`, `celular_contacto4`, `correo_contacto4`, `correo_factura`, `fecha_cierrefacturacion`, `entregas_anuales`, `meses_entrega`, `nuevos_ingresos`, `cantidad_ingresos`, `proveedor_actual`, `departamento1`, `ciudad1`, `direccion1`, `departamento2`, `ciudad2`, `direccion2`, `departamento3`, `ciudad3`, `direccion3`, `empleados_directos`, `empleados_dotacion`) VALUES
(217, 900728321, 'Servicios de Ingenieria y Mantenimiento de Transformadores SIMAT SAS', 1, 1, '', '0000-00-00', '6063123885', 'fernando.ruiz@simat.co', 'Fernando Ruiz ', '', '0000-00-00', '6063123885', 'fernando.ruiz@simat.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'fernando.ruiz@simat.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 11 # 16B - 04 Oficina 511 Edificio Quality', '', '', '', '', '', '', 0, 0),
(218, 901318414, 'SErvicios e Insumos Hernandez SAS', 1, 1, '', '0000-00-00', '3104032401', 'servinsumosh@outlook.com', '', '', '0000-00-00', '3104032401', 'servinsumosh@outllok.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'servinsumosh@outlook.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 28 # 7 - 14 Barrio Centro ', '', '', '', '', '', '', 0, 0),
(219, 901492683, 'Servicios logisticos Integrales del Eje SAS', 1, 1, '', '0000-00-00', '3206696611', 'comercial@srervilogindeleje.com', 'Juan Carlos Rassa', '', '0000-00-00', '3165245082', 'comercial@servilogindeleje.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'comercial@servilogindeleje.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Diagonal 25 # 24T - 331 Conjunto Terrazas del Lago Apartamento 905', '', '', '', '', '', '', 0, 0),
(220, 900810663, 'Smart Solar SAS', 1, 1, '', '0000-00-00', '3183121132', 'gestionhumana@smartsolar.com.co', 'Juan Quiceno ', '', '0000-00-00', '3183121132', 'gestionhumana@smartsolar.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gestionhumana@smartsolar.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Avenida 30 de Agosto 50 - 90 ', '', '', '', '', '', '', 0, 0),
(221, 891480071, 'Sociedad de Mejoras de Pereira ', 1, 1, '', '0000-00-00', '3224985018', 'secretaria@smpereira.org', 'Doralba Henao ', '', '0000-00-00', '3224985018', 'secretaria@smpereira.org', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'secretaria@smpereira.org', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 9 # 36 - 43 ', '', '', '', '', '', '', 0, 0),
(222, 816005778, 'IMPORTADORA MAZ LUV ', 1, 2, '', '0000-00-00', '', '', 'Alejandra', 'Administradora ', '0000-00-00', '3116417802', 'cartera@importortadoramazluv.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cartera@importadoramazluv.com', '25 de cada mes', '3 veces al año', 'Abril, Agosto, Diciembre', 'No', 0, '', 'Risaralda', 'Pereira', 'Cra 12 No. 19 / 39', '', '', '', '', '', '', 80, 80),
(223, 860013798, 'Universidad Libre', 1, 1, '', '0000-00-00', '3104594832', 'provefactu.pei@unilibre.edu.co', 'Julieth Paola Morales ', 'Directora de Gestion Humana', '0000-00-00', '3104594832', 'provefactu.pei@unilibre.edu.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'preovefactu.pei@unilibre.edu.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'Avenida de las Americas Carrera 28 # 96 - 102', '', '', '', '', '', '', 0, 0),
(224, 800014234, 'Marca Publicidad SAS', 1, 1, 'Jorge Enrique Carrero ', '0000-00-00', '3152903292', 'marca@marcapublicidad.com.co', 'Jorge Enrique Carrero ', '', '0000-00-00', '6013293007', 'marca@marcapublicidad.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'marca@marcapublicidad.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Bogotá D.C.', 'Bogotá D.C.', 'Carrera 69A # 64H - 15', '', '', '', '', '', '', 0, 0),
(225, 900893985, 'Fundacion Universitaria Comfamiliar ', 1, 1, 'Daisuri Grajales Vanegas', '0000-00-00', '6063172400', 'dvgrajales@uc.edu.co', 'Daisuri Grajales ', 'Auxiliar Gestion Humana', '0000-00-00', '6063172400', 'dvgrajales@uc.edu.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'dvgrajales@uc.edu.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 5 # 21 - 30', '', '', '', '', '', '', 0, 0),
(226, 900166673, 'Empresa Regional de Acueducto  Alcantarillado Aseo del Norte de Caldas ', 1, 1, '', '0000-00-00', '', 'administrativa@eran.com.co', 'Ana Maria Florez ', '', '0000-00-00', '3127236325', 'administrativa@eran.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'administrativa@eran.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Caldas', 'Manizales', '', '', '', '', '', '', '', 0, 0),
(227, 891480000, 'Comfamiliar Risaralda ', 1, 1, '', '0000-00-00', '6063135600', 'comprasdotacion@comfamiliar.com', '', '', '0000-00-00', '6063135600', 'comprasdotacion@comfamiliar.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'comprasdotacion@comfamiliar.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', '', '', '', '', '', '', '', 0, 0),
(228, 830515183, 'Frutales Las Lajas S.A', 1, 1, 'Juan Felipe Gaviria ', '0000-00-00', '3105178558', 'gerencia2@frutaleslaslajas.com', '', '', '0000-00-00', '3105178558', 'gerencia2@frutaleslaslajas.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gerancia2@frutaleslaslajas.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Valle del Cauca', 'Zarzal', 'Kilometro 1 Via Zarzal ', '', '', '', '', '', '', 0, 0),
(229, 900634148, 'El Barista SAS ', 1, 1, 'Leidy Johanna Murillo ', '0000-00-00', '3218312653', 'talentohumano@elbaristacafe.com', 'Leidy Johanna Murillo ', '', '0000-00-00', '3218312653', 'talentohumano@elbaristacafe.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'talentohumano@elbaristacafe.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 16 Bis # 15B - 51 Mejia Robledo ', '', '', '', '', '', '', 0, 0),
(230, 860400099, 'PREVISEG', 1, 2, 'JUAN CARLOS CALLEJAS ', '0000-00-00', '', '', 'LUISA FERNANDA TORRES', 'Directora COntable', '0000-00-00', '3016081702', 'Contabilidad@pravisec.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'Contabilidad@pravisec.com', '29 de cada mes', '3 veces al año', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Cra. 20 No. 22 / 09 PROVIDENCIA', '', '', '', '', '', '', 100, 0),
(231, 805007083, 'Ciudad Limpia ', 1, 1, '', '0000-00-00', '3160186417', 'auxejecafetero.rh@ciudadlimpia.com.co', 'Carolina Castaneda', '', '0000-00-00', '3160186417', 'auxejecafetero.rh@ciudadlimpia.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'auxejecafetero.rh@ciudadlimpia.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'Calle 24 # 7 - 29 Oficina 605Centro Comercial El Lago ', '', '', '', '', '', '', 0, 0),
(232, 900441009, 'Cruz y Gandini SAS', 1, 1, 'Leonardo Caviedes', '0000-00-00', '3234304594', 'infopereira@metodonec.com', 'Leonardo Caviedes', '', '0000-00-00', '3234304594', 'infopereira@metodonec.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'infopereira@metodonec.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Megacentro Pinares Torre 1 Consultorio 907', '', '', '', '', '', '', 0, 0),
(233, 891408586, 'Liga Contra el Cancer Risaralda ', 1, 1, '', '0000-00-00', '6063333340', 'liga@ligacancerrisaralda.com', '', '', '0000-00-00', '6063341513', 'liga@licacancerrisaralda.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'liga@ligacancerrisaralda.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Carrera 4 # 23 - 55', '', '', '', '', '', '', 0, 0),
(234, 901434039, 'Grupo Constructores Inteligentes ', 1, 1, 'Julieth Erazo ', '0000-00-00', '3193767370', 'rrhh@construintel.com', 'Julieth Erazo ', '', '0000-00-00', '3193767370', 'rrhh@construintel.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'rrhh@construintel.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 15 Este # 13 - 110 centro Comercial Pereira Plaza Local 232', '', '', '', '', '', '', 0, 0),
(235, 901720739, 'ZIAPF', 1, 1, 'Beatriz Elena Tamayo ', '0000-00-00', '6063401445', '901720739@factureinbox.co', 'Catalina Diaz Rojo ', '', '0000-00-00', '6063401445', 'calidad@macarena.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '901720739@factureinbox.co', '22 de cada mes', '1 vez al año', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 16 # 6 - 211 Antigua PLaza de Ferias ', '', '', '', '', '', '', 0, 0),
(236, 901056749, 'Jota Mundial SAS', 1, 1, 'Jairo Osorio ', '0000-00-00', '3046574699', 'gestiontributaria@jotamundial.com', 'Jairo Osorio ', '', '0000-00-00', '3046574699', 'gestiontributaria@jotamundial.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gestiontributaria@jotamundial.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'Calle 9 # 1 - 74', '', '', '', '', '', '', 0, 0),
(237, 810006056, 'Distribuciones Agrícolas ', 1, 1, 'Jhon Alexander', '0000-00-00', '3206289431', 'gestionhumana@agricolaelruiz.co', 'Jhon Alexander', '', '0000-00-00', '3206289431', 'gestionhumana@agricolaselruiz.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gestionhumana@agricolaselruiz.com', '22 de cada mes', '1 vez al año', 'Array', 'No', 0, '', 'Caldas', 'Manzanares', 'gestionhumana@agricolaselrey.co', '', '', '', '', '', '', 0, 0),
(238, 800180675, 'Rentar Inmobiliaria', 1, 1, 'Hector Aristizabal ', '0000-00-00', '3009121600', 'gestion.humana@rentarinmobiliaria.com', 'Hector Aristizabal ', '', '0000-00-00', '6063344240', 'gestion.humana@rentarinmobiliaria.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gestion.humana@rentarinmobiliaria.com', '22 de cada mes', 'Seleccione una opción', 'Enero', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 12 # 13 - 54 Barrio Alpes ', '', '', '', '', '', '', 0, 0),
(239, 2147483647, 'CREER IPS ', 1, 2, 'Juan David Gallego Franco ', '0000-00-00', '', '', 'Daniela MOLINA ', 'Asistente de GH ', '0000-00-00', '3117675055', 'asistente@creerips.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@creerips.com.co', '22 de cada mes', '3 veces al año', 'Abril', 'No', 0, '', 'Risaralda', 'Pereira', 'Cll 9 No. 16/31 barrio los Alpes ', '', '', '', '', '', '', 55, 0),
(240, 891408814, 'FONDO DE EMPLEADOS DE SALUD EN RISARALDA FESER ', 1, 2, 'ELIANA MARIA QUINTERO MARIN ', '0000-00-00', '3122810843', 'gerencia@feser.com.co', 'Claudia Diaz ', 'Asistente de Gerencia ', '0000-00-00', '3136263950', 'asistente@feser.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'asistente@feser.com.co', '25 de cada mes', '1 vez al año', 'Array', 'No', 0, 'Andres Franco', '', '', 'cra. 8 No. 20 / 67 Ofc 301', '', '', '', '', '', '', 11, 10),
(241, 901501901, 'GRUPO FAMILIAR ', 1, 1, 'ANA MARIA DEL SOCORRO ISAZA SANIN ', '0000-00-00', '3146190813', '', 'JAIME ROBLEDO', 'COMPRAS ', '0000-00-00', '3146190813', 'compras@urbanizar.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'compras@urbanizar.com.co', '26 de cada mes', '3 veces al año', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', '', '', '', '', '', '', '', 20, 20),
(242, 251814443, 'CLAUDIA VINASCO PINEDA DICOL', 1, 2, 'CLAUDIA VINASCO PINEDA ', '0000-00-00', '2146240608', 'dicol@hotmail.com', 'Johanna VInasco ', 'Administradora ', '0000-00-00', '3146240608', 'dicol@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'dicol@hotmail.com', '25 de cada mes', '1 vez al año', 'Array', 'No', 0, '', '', '', 'Cra. 18 No. 43 - 26 barrio san Fernando ', '', '', '', '', '', '', 10, 0),
(243, 901012906, 'WORLD MEDICAL SOLUCIONS', 1, 2, 'Javier Francisco Valencia ', '0000-00-00', '', '', 'Evelyn Medina ', 'Gerente Administrativa ', '0000-00-00', '3137218666', 'eve.medina17@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gerencia@worldmedicals.com.co', '30 de cada mes', '2 veces al año', 'Enero', 'No', 0, '', 'Risaralda', 'Pereira', '', '', '', '', '', '', '', 12, 10),
(244, 716224738, 'ORLANDO BEDOYA GIRALDO', 1, 2, 'ORLANDO BEDOYA GIRALDO', '0000-00-00', '3137213795', '', 'CATALINA  ARIAS', 'CALIDAD', '0000-00-00', '3165236395', 'calidad@curaduria1pereira.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'asistente@curaduria1pereira.com', '30 de cada mes', '1 vez al año', 'Abril', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 19 N° 6 48 oficina 305  ', '', '', '', '', '', '', 20, 0),
(245, 890985417, 'Universidad Vision de las Americas de Pereira', 1, 2, '', '0000-00-00', '', '', 'Ana Maria Betancur', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'nolosabemos@universidad.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'Avenida de las Américas No 98-56 Sector Belmonte', '', '', '', '', '', '', 0, 0),
(246, 800084227, 'SERVIMERCADEO SAS', 1, 2, '', '0000-00-00', '', '', 'Dora Elena Taborda', 'Lider de Compras', '0000-00-00', '314771436', 'compras@servimercadeo.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recepcion.fe@servimercadeo.com', '25 de cada mes', '3 veces al año', 'Abril, Agosto, Diciembre', 'No', 0, '', '', '', 'Cra 12 N°3 49', '', '', '', '', '', '', 0, 0),
(247, 1094905265, 'STEVEN QUEBRADA', 1, 2, 'Steven Quebrada', '0000-00-00', '3128920997', 'stequeri27@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'stequeri27@gmail.com', '30 de cada mes', '1 vez al año', 'Array', 'No', 0, '', 'Risaralda', 'Dosquebradas', 'MZ 3 CS 20 QUINTAS DEL BOSQUE', '', '', '', '', '', '', 0, 0),
(248, 900060153, 'CORNABIS', 1, 2, '', '0000-00-00', '', '', 'NATALIA MOLINA', 'Coordinadora de Gestion Humana', '1995-03-17', '3168452635', 'bienestarlaboral@cornabis.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cadaruttieneunadirecciondecorreo@cornabis.com', '25 de cada mes', '3 veces al año', 'Abril, Agosto, Diciembre', 'No', 0, '', 'Risaralda', 'Pereira', 'Cra 7 N° 19 48 Piso 9 Edificio Banco Popular', '', '', '', '', '', '', 0, 64),
(249, 901023365, 'COOPFAMIAGRO', 1, 2, '', '0000-00-00', '', '', 'Nidia Giraldo Martinez', 'Administracion', '0000-00-00', '3217689932', 'cooperativacoopfamiagro@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'cartera@coopfamiagro.com', '30 de cada mes', '2 veces al año', 'Febrero, Junio', 'No', 0, 'Santiago Dotaciones', 'Risaralda', 'Pereira', 'Calle 20 N° 9 36', '', '', '', '', '', '', 8, 7),
(250, 900533887, 'GARCIA QUIROGA COMUNICACIONES', 1, 2, 'Luis Garcia', '1951-12-26', '3136861515', 'garciaquiroga50@gmail.com', 'Jhon Mejia', 'Asistente', '0000-00-00', '3226007693', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'garciaquiroga50@gmail.com', '25 de cada mes', '1 vez al año', 'Febrero', 'No', 0, 'primera vez', 'Risaralda', 'Pereira', 'Mz 46 Cs 28 Barrio Corales', '', '', '', '', '', '', 3, 3),
(251, 900216238, 'PACHO DROGAS SAS', 1, 2, 'Javier Obando', '0000-00-00', '', '', 'Steven Betancur', 'Administrador General', '1995-09-08', '3217004479', 'lideradmin@pachodrogas.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'contabilidad@pachodrogas.com', '30 de cada mes', '2 veces al año', 'Febrero', 'No', 0, 'Kosta Brava y Confeccionar', 'Risaralda', 'Pereira', 'Cra 25 N° 80 116 Barrio Corales', '', '', '', '', '', '', 82, 82),
(252, 100000000, 'Edwin Cordero', 1, 2, 'Edwin Cordero', '0000-00-00', '3116188094', 'edwin.cordero.torres@outlook.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'edwin.cordero.torres@outlook.com', '30 de cada mes', '1 vez al año', 'Febrero', 'No', 0, 'no tiene', '', '', 'JAMUNDI VALLE DEL CAUCA', '', '', '', '', '', '', 0, 0),
(253, 901878623, 'SEGURIDAD PRIVADA LAS 3 S', 1, 2, '', '0000-00-00', '', '', 'Erika Herrera', 'Auxiliar Administrativa', '0000-00-00', '3046430881', 'las3sssseguridad@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'las3sssseguridad@gmail.com', '25 de cada mes', '3 veces al año', 'Abril, Agosto, Diciembre', 'No', 0, 'no tiene', 'Risaralda', 'Dosquebradas', 'Senderos de la Pradera - Sucursal Pereira', '', '', '', '', '', '', 0, 30),
(254, 901732183, 'DHUTRE', 1, 2, '', '0000-00-00', '', '', 'Maria Cristina Duque', '', '0000-00-00', '3205906277', 'mduque@comfamiliar.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'mduque@comfamiliar.com', '25 de cada mes', '1 vez al año', 'Febrero', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 82 36 25 Apto 704 Mirador de Batara', '', '', '', '', '', '', 0, 0),
(255, 800228215, 'CEDICAF SA', 1, 2, 'Franklin García ', '0000-00-00', '', '', 'Karen RIos Restrepo ', 'Lider de Comnpras', '0000-00-00', '3137912524', 'janlondono@cedicaf.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacionproveedores@cedicaf.com', '25 de cada mes', 'Seleccione una opción', 'Abril', 'No', 0, 'DOTACION INTEGRAL', 'Risaralda', 'Pereira', 'Cra. 15 No. 13-28 Los Alpes ', '', '', '', '', '', '', 1126, 1126),
(256, 901664341, 'LA FLORIDA H20 SAS', 1, 2, 'Emilio Mendez Giraldo', '0000-00-00', '', '', 'Daniela Peña ', 'coordinadora Contable ', '0000-00-00', '3123082052', 'aguaslaflorida@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'aguaslaflorida@gmail.com', '25 de cada mes', 'Seleccione una opción', 'Febrero', 'No', 0, '', 'Risaralda', 'Pereira', 'Cra 10 No. 5-27', '', '', '', '', '', '', 8, 8),
(257, 901442512, 'INVERSIONES SALUDABLES VITA', 1, 2, 'ELKIN DAVILA', '1985-09-27', '3215501948', 'info@vitaecomarket.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'info@vitaecomarket.com', '30 de cada mes', 'Seleccione una opción', 'Abril, Agosto, Diciembre', 'Si', 0, 'RUTA 29', 'Risaralda', 'Pereira', 'Cra 14 N° 12 55', '', '', '', '', '', '', 13, 12),
(258, 800103884, 'EMPRESA DE SERVICIOS PUBLICOS DE LA VIRGINIA', 1, 1, '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'comercial@unidotacionesdeleje.com', '22 de cada mes', 'Seleccione una opción', 'Enero', 'No', 0, 'DESCONOCIDO', '', '', '', '', '', '', '', '', '', 0, 0),
(259, 830107012, 'CARAVELA', 1, 2, '', '0000-00-00', '', '', 'Mateo Ortiz', 'Compras', '0000-00-00', '3137467720', 'mateo.ortiz@caravela.coffee', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'mateo.ortiz@caravela.coffee', '22 de cada mes', '2 veces al año', 'Junio, Diciembre', 'No', 0, '', 'Quindío', 'Armenia', ' Vía al Edén Km 7 Bdg el Lucero', '', '', '', '', '', '', 0, 0),
(260, 111111111, 'BANAPLAST', 1, 2, '', '0000-00-00', '', '', 'Vanessa Astudillo', 'Administrativo', '0000-00-00', '3162509520', 'dolly.astudillo@tc.tc', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'dolly.astdullo@tc.tc', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'La Tebaida-El Caimo, Nuevo Sol', '', '', '', '', '', '', 65, 0),
(261, 810000870, 'ALADINO SALAS DE JUEGO SAS', 1, 2, '', '0000-00-00', '6068846791', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'facturacion@aladinosalasdejuegos.com', '22 de cada mes', '3 veces al año', 'Abril, Agosto, Diciembre', 'No', 0, 'gino pascalli', 'Caldas', 'Manizales', 'Cra 23 23 60 of 405', '', '', '', '', '', '', 0, 0),
(262, 891409981, 'CLINICA LOS ROSALES ', 1, 1, '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'losrosales@pendienteporconfirmar.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', 'Risaralda', 'Pereira', 'carrera 9 No. 25-25', '', '', '', '', '', '', 0, 0),
(263, 900311215, 'ZONA FRANCA', 1, 1, 'CRISTIAN BENAVIDES', '0000-00-00', '3006725793', 'Diradministrativa@zonafrancadepereira.com', 'Cristian Benavides', '', '0000-00-00', '', 'Diradministrativa@zonafrancadepereira.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'Diradministrativa@zonafrancadepereira.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(264, 891400148, 'Flota Occidental ', 1, 1, 'Sara Vasquez', '0000-00-00', '3122886052', 'auxadministrativa@flotaoccidental.co', 'Diana Lorena', '', '0000-00-00', '3105114498', 'auxadministrativa@flotaoccidental.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'auxadministrativa@flotaoccidental.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(265, 900169541, 'COMERCIIALIZADORA LA POSADA', 1, 2, '', '0000-00-00', '', '', 'Lina Ramirez', 'Coordinadora de Gestion Humana', '0000-00-00', '3127327065', 'talentohumano@supermercadoscucuteno.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'talentohumano@supermercadoscucuteno.com', '22 de cada mes', '1 vez al año', 'Abril', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 70),
(266, 890800450, 'INDUMA', 1, 2, '', '0000-00-00', '', '', 'Monica Lorena Cardona', 'Lider Gestion Humana', '0000-00-00', '3146842038', 'monicalorena.cardona@induma.com.co', 'Julieth Cardona', 'Lider de Compras', '0000-00-00', '3103855682', 'auxiliar.compras@induma.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'monicalorena.cardona@induma.com.co', '22 de cada mes', '1 vez al año', 'Array', 'No', 0, 'La Flecha, Marvi, Bless, Megadotaciones, Uniroca II, Novamark', 'Caldas', 'Manizales', 'Km 1 via Termales del Otoño', '', '', '', '', '', '', 0, 0),
(267, 901361018, 'P Y J LOGISTICA', 1, 2, '', '0000-00-00', '', '', 'Diana Salazar', 'Administradora', '0000-00-00', '3105015809', 'dianitasalazar92@hotmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'dianitasalazar92@hotmail.com', '22 de cada mes', '1 vez al año', 'Junio', 'No', 0, 'Confeccionar', 'Risaralda', 'Dosquebradas', 'Cra 10 #64 D 28 CS 28 La Alameda', '', '', '', '', '', '', 9, 9),
(268, 1100000000, 'AVALOGIC SAS', 1, 2, '', '0000-00-00', '', '', 'Mari Rosado', 'Administradora', '0000-00-00', '3188717963', 'm.rosado@avalogicsas.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'm.rosado@avalogicsas.com', '25 de cada mes', '3 veces al año', 'Abril, Agosto, Diciembre', 'No', 0, '', 'Risaralda', 'Pereira', 'Calle 8 Nº 19 80 of 601', '', '', '', '', '', '', 30, 0),
(269, 800163984, 'GYB SAS', 1, 2, '', '0000-00-00', '', '', 'Alejandra', 'Directora Calidad y Procesos', '0000-00-00', '3164944789', 'directorcalidadyprocesos@gybsas.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'directorcalidadyprocesos@gybsas.com', '22 de cada mes', 'Seleccione una opción', 'Abril, Agosto, Diciembre', 'No', 0, '', '', '', 'Carrera 9Bis #6-72 Bodega 5  Antigua Plaza de Ferias La Badea', '', '', '', '', '', '', 43, 43),
(270, 901095524, 'LOGIDIS', 1, 2, '', '0000-00-00', '', '', 'David Londoño', 'Lider de SST', '0000-00-00', '3108016827', 'sgsst@logidis.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'sgsst@logidis.com.co', '22 de cada mes', 'Seleccione una opción', 'Junio, Septiembre, Diciembre', 'No', 0, '', '', '', 'Medellin con sede en Pereira- Dosquebradas', '', '', '', '', '', '', 36, 0),
(271, 1111111111, 'CAROLINA HINOJOSA MILLAN', 1, 1, 'CAROLINA HINOJOSA MILLAN', '1996-06-17', '3225486771', 'carolinahhm@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'carolinahhm@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(272, 2147483647, 'GRUPO CARTAMA', 1, 1, 'MELISSA ARISMENDI', '0000-00-00', '3206654714', 'MARISMENDI@CARTAMA.COM', 'MELISSA ARISMENDI', 'RRHH', '0000-00-00', '3206654714', 'MARISMENDI@CARTAMA.COM', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'MARISMENDI@CARTAMA.COM', '22 de cada mes', 'Seleccione una opción', 'Diciembre', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(273, 901010498, 'UKUMARI', 1, 1, 'SHARON SERNNA', '0000-00-00', '3217004606', 'recursoshumanos@ukumari.co', 'SHARON SERNA', 'REPRESENTANTE', '0000-00-00', '3217004606', 'recursoshumanos@ukumari.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'recursoshumanos@ukumari.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 25),
(274, 0, 'LOPEZ CORREA', 1, 1, 'LOPEZ CORREA', '0000-00-00', '', 'gestionhumana@lopezcorrea.com', '	Sandra Viviana Cortes Ospina', '', '0000-00-00', '', 'gestionhumana@lopezcorrea.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'gestionhumana@lopezcorrea.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(275, 901682887, 'CREA OCCIDENTAL', 1, 1, 'CREA', '0000-00-00', '3104100678', 'INFO@CREAESP.COM', 'CREA', 'RRHH', '0000-00-00', '3104100678', 'INFO@CREAESP.COM', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'INFO@CREAESP.COM', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'FACTURA@CREAESP.COM', '', '', '', '', '', '', 0, 0),
(276, 900689750, 'ARGOVAL', 1, 2, 'Daniel Velásquez M', '0000-00-00', '', 'administrativo1@argoval.com.co', '', '', '0000-00-00', '', 'administrativo1@argoval.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'administrativo1@argoval.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(277, 800099310, 'ALCALDIA DE DOSQUEBRADAS', 1, 1, 'AURELIO CARDONA', '0000-00-00', '', 'alcaurelio55@gmail.com', 'AURELIO CARDONA', 'alcalde', '0000-00-00', '', 'alcaurelio55@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'alcaurelio55@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(278, 891410354, 'CARDER', 1, 2, 'LAURA CAROLINA HENAO CEBALLOS', '0000-00-00', '3116511', 'INGENIEROALONSOPINEDA@GMAIL.COM', 'LAURA CAROLINA HENAO CEBALLOS', '', '0000-00-00', '3116511', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'INGENIEROALONSOPINEDA@GMAIL.COM', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(279, 1234567777, 'SONYAR', 1, 2, 'MARIANA', '0000-00-00', '3108037076', 'NOTIENE@G.COM', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'NOTIENE@G.COM', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(280, 900244429, 'TECNOVIDA', 1, 1, 'XIMENA TORO', '0000-00-00', '', 'COORDINACION.ASISTENCIAL@TECNOVIDA.CO', 'LISETH COSTA', 'COORDINADOR DE CALIDAD', '0000-00-00', '', 'COORDINACION.CALIDAD@TECNOVIDA.CO', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'COORDINACION.CALIDAD@TECNOVIDA.CO', '22 de cada mes', '1 vez al año', 'Array', 'No', 0, '', '', '', 'CALLE 24 ·5-41 PISO 3', '', '', '', '', '', '', 0, 0),
(281, 1111112222, 'EXCO', 1, 2, 'EXCO', '0000-00-00', '1111111111', 'EXCO@EXCO.COM', 'EXCO', 'EXCO', '0000-00-00', '1111111111', 'EXCO@EXCO.COM', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'EXCO@EXCO.COM', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(282, 816008064, 'DUNA S.A.S', 1, 1, 'SUSI GALVIS', '0000-00-00', '318570891', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(283, 111101, 'DE CERO', 1, 2, 'Mariana Ramirez', '0000-00-00', '3113733792', 'noaplica@n.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(284, 2147483647, 'Compañía Multiaceros S.A.S', 1, 1, 'Miryam Astrid Montoya', '0000-00-00', '3174274371', 'info@multiaceros.co', 'Miryam Astrid Montoya', 'REPRESENTANTE', '0000-00-00', '3174274371', 'info@multiaceros.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(285, 900434012, 'RODAS VEHI', 1, 2, 'VALENTINA RODAS', '0000-00-00', '3184283104', 'liquidaciones2@rotrasvehi.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'liquidaciones2@rotrasvehi.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'la pradera cll 22 #19-125', '', '', '', '', '', '', 0, 0),
(286, 900951622, 'FACTOR INK S.A.S', 3, 1, 'BARBERY GARCIA JHON BYRON', '0000-00-00', '3334906', 'factorink.pereira@gmail.com', 'BARBERY GARCIA JHON BYRON', 'RRHH', '0000-00-00', '3334906', 'factorink.pereira@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'factorink.pereira@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'Carrera 3a Bis No. 1-34', '', '', '', '', '', '', 0, 0),
(287, 900083863, 'CELEMA ', 9, 1, 'CELEMA CENTRAL LECHERA MANIZALES', '0000-00-00', '', 'atencionalcliente@celema.com.co', 'ANGELICA', 'JEFE', '0000-00-00', '3127270185', 'notiene@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'notiene@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(288, 816008815, 'TERMALES', 2, 2, '', '0000-00-00', '', '', 'SARA MARIA LARGO TREJOS', 'ANALISTA DE TALENTO HUMANO', '0000-00-00', '3655237', 'analista.talentohumano@termales.com.co', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'analista.talentohumano@termales.com.co', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(289, 900393478, 'RIBARCO SAS', 9, 1, 'RIBARCO SAS', '2006-12-31', '', '', 'Julieth', 'compras', '0000-00-00', '3167570249', 'ribarco@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'notiene@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(290, 901198592, 'CESAC S.A.S', 9, 2, 'El Centro De Especialistas En Salud De La Costa ', '2008-11-30', '35588555', '', 'SIN NOMBRE', 'JEFE', '0000-00-00', '3215485', 'lineadeatencion@cesacips.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'lineadeatencion@cesacips.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(291, 894410137, 'SUZUKI', 9, 2, 'IMAGINARIO', '0000-00-00', '45415474', '', 'NO TIENE', 'JEFE', '0000-00-00', '4548754152', 'notiene@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'notiene@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(292, 900241655, 'Solé', 9, 2, 'SOLUCIONES Y EQUIPOS PARA GATRONOMIA', '2008-12-31', '', 'ghumana@solesoluciones.com', 'Daniela Suarez ', 'jefe', '0000-00-00', '5745845', 'ghumana@solesoluciones.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'ghumana@solesoluciones.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(293, 410000, 'TRANSPRENSA', 2, 2, 'PTE INFORMACION', '0000-00-00', '321645526', 'asistente.compras@transprensa.com', 'Lilibeth Doncel', 'Asistente de compras Nacional', '0000-00-00', '321645526', 'asistente.compras@transprensa.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'asistente.compras@transprensa.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(294, 890003838, 'HAPPY SLEEP', 9, 2, 'HAPPY SLEEP', '2008-12-31', '46898955', 'sincontacto@gmail.com', 'sin info', 'jefe', '0000-00-00', '57741884', 'sincontacto@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'sincontacto@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'sincontacto@gmail.com', '', '', '', '', '', '', 0, 0),
(295, 900595430, 'VyP SEGURIDAD Y SALUD EN EL TRABAJO S.A.S', 9, 2, 'PATRICIA', '0000-00-00', '3246468325', 'vypsstcoordinacion@gmail.com', 'sin nombre', 'jefe', '0000-00-00', '3246468325', 'vypsstcoordinacion@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'vypsstcoordinacion@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', 'vypsstcoordinacion@gmail.com', '', '', '', '', '', '', 0, 0),
(296, 2147483647, 'Clinica OFTALMOLOGICA DE ALTA TECNOLOGIA S.A.S', 9, 2, 'SIN INFORMACION', '0000-00-00', '587854541', 'sininfo@gmail.com', 'sin info', 'jefe', '0000-00-00', '3685454156', 'sininfo@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'sininfo@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(297, 2147483647, 'ENERGIAS DE PEREIRA', 9, 1, 'JANIS ACOSTA MONTOYA', '2008-12-31', '5688512588', 'JACOSTAM@EEP.COM.CO', 'JANIS ACOSTA MONTOYA', 'jefe', '0000-00-00', '1588555798', 'JACOSTAM@EEP.COM.CO', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'JACOSTAM@EEP.COM.CO', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(298, 890908822, 'IGLU', 2, 2, 'PTE', '0000-00-00', '3227612618', 'PTE@GMAIL.COM', 'PTE', 'PPTE', '0000-00-00', '3100000000', 'PTE@GMAIL.COM', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'PTE@GMAIL.COM', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(299, 890002241, 'VIPCOL LIMITADA VIGILANCIA PRIVADA DE COLOMBIA', 2, 2, 'WILLIAM ALBERTO RODRIGUEZ DIAZ', '0000-00-00', '3148117039', 'programacionoperativavipcol@gmail.com', 'WILLIAM ALBERTO RODRIGUEZ DIAZ', 'REPRESENTANTE LEGAL', '0000-00-00', '3148117039', 'programacionoperativavipcol@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'programacionoperativavipcol@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(300, 2147483647, 'PCP PARTES Y COMPLEMENTOS PLASTICOS SAS', 9, 2, 'sin nombre ', '2008-12-31', '254584151', 'sininformacion@gmail.com', 'sin informacion', 'jefe', '0000-00-00', '2855744845', 'sininformacion@gmail.com', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', 'sininformacion@gmail.com', '22 de cada mes', 'Seleccione una opción', 'Array', 'No', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(301, 900277370, 'ISHOP', 2, 2, NULL, NULL, NULL, NULL, 'VIVIANA LOZANO', 'ASISTENTE DE RR HH', '0000-00-00', '3212158834', 'v.lozano@ishopgroup.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BOGOTÁ, D.C.', 'BOGOTÁ, D.C.', 'CRA 12 # 97 80 PISO 3 BARRIO CHICO RESERVADO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(302, 900622954, 'CUBIKAR S.A.S', 9, 2, NULL, NULL, NULL, NULL, 'LINA', 'GESTION DE COMPRAS', '2026-04-15', '3104510218', 'lina.gantiva@cubikar.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RISARALDA', 'PEREIRA', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(303, 2147483647, 'CAFE MARISCAL', 2, 2, NULL, NULL, NULL, NULL, '', '', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(304, 2147483647, 'TRANDECOL', 9, 2, NULL, NULL, NULL, NULL, 'ALLISON LONDOÑO', 'AUX ADMINISTRATIVA', '0000-00-00', '3154317838', 'sininfo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RISARALDA', 'PEREIRA', 'Av. 30 de agosto sector la villa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(305, 800091121, 'MERCAMAS', 2, 2, NULL, NULL, NULL, NULL, '', '', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(306, 901711711, 'VERTICE CAPITAL SAS', 9, 2, NULL, NULL, NULL, NULL, 'DIEGO SANCHEZ', '', '0000-00-00', '', 'diego.sanchez@urbancolombia.co', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(307, 901454191, 'URBAN COLOMBIA SAS', 9, 2, NULL, NULL, NULL, NULL, 'DIEGO SANCHEZ', '', '0000-00-00', '', 'diego.sanchez@urbancolombia.co', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BOGOTÁ, D.C.', 'BOGOTÁ, D.C.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(308, 900877746, 'Servirplus SAS', 9, 2, NULL, NULL, NULL, NULL, 'Jhoana Castrillón ', '', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RISARALDA', 'PEREIRA', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(309, 891401267, 'COOPERATIVA URBANOS PEREIRA', 9, 2, NULL, NULL, NULL, NULL, 'Claudia Arango', '-', '0000-00-00', '3117489763', 'info@urbanospereira.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RISARALDA', 'PEREIRA', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(310, 2147483647, 'ASC ELECTRONICA S.A', 9, 2, NULL, NULL, NULL, NULL, '', '', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RISARALDA', 'PEREIRA', 'Zona Industrial, Calle 8, Cl. 9 #10-30, Dosquebradas, Risaralda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo_min`
--

CREATE TABLE `consumo_min` (
  `id_consumo` int(11) NOT NULL,
  `precio_consumo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `consumo_min`
--

INSERT INTO `consumo_min` (`id_consumo`, `precio_consumo`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cordon`
--

CREATE TABLE `cordon` (
  `id_cordon` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cordon`
--

INSERT INTO `cordon` (`id_cordon`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 6),
(1, 'Cordon Para Ajuste Capota Por 10 Metros', 'metro', 250.5, '2026-01-30', 0, 5, 6),
(2, 'Cordon poliester tubular blanco y negro', 'metro', 203.4, '2026-04-18', 0, 35, 6),
(3, 'Resorte Con Cordon', 'metro', 0.3, '2026-01-30', 0, 5, 6),
(6, 'Cordon para sudadera tc colores ', 'metro', 210, '2026-01-30', 0, 5, 6),
(7, 'Cordon poliester tubular azul osc', 'metro', 224, '2026-04-18', 0, 35, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte`
--

CREATE TABLE `corte` (
  `id_corte` int(11) NOT NULL,
  `cant_corte` varchar(30) DEFAULT NULL,
  `precio_corte` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `corte`
--

INSERT INTO `corte` (`id_corte`, `cant_corte`, `precio_corte`, `fecha_actualizacion`) VALUES
(1, '1 a 12 Prendas', 8456.55, '2026-01-26'),
(2, '13 a 29 Prendas', 3273.5, '2026-01-26'),
(3, '30 a 59 Prendas', 1663.58, '2026-01-26'),
(4, '60 a 99 Prendas', 1014.79, '2026-01-26'),
(5, '100 a 1000', 507.39, '2026-01-26'),
(6, '1001 a 2000', 338.26, '2026-01-26'),
(7, 'Corte Chaqueta x2', 3500, '2026-02-18'),
(8, 'Corte Chaqueta x3', 5000, '2026-02-18'),
(9, 'Prenda Sencilla', 2000, '2026-01-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cremallera`
--

CREATE TABLE `cremallera` (
  `id_cremallera` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cremallera`
--

INSERT INTO `cremallera` (`id_cremallera`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 7),
(3, 'Cierre Pol 3 20 cms  ', 'und', 504, '2026-03-17', 0, 35, 7),
(7, 'Cierre 30 Cm  Invisible ', 'und', 0, '2026-02-06', 0, 5, 7),
(9, 'Cierre Continuo 2 Carrito Overol Metro', 'und', 1487.2, '2026-01-30', 0, 5, 7),
(15, 'Cierre  Separ Pol Nro 6 75 cms', 'und', 2528, '2026-02-06', 0, 35, 7),
(19, 'Cierre cobre calibre 4,5  17 cms', 'und', 484, '2026-03-17', 0, 35, 7),
(20, 'Cierre  Pol 6 12 a 17 cms jeans dielectrico ', 'und', 871, '2026-02-06', 0, 35, 7),
(21, 'Cierre cadena plastico FR 5', 'metro', 7505, '2026-02-20', 0, 20, 7),
(22, 'Cierre cobre calibre 4,5  15 cms', 'und', 442, '2026-03-12', 0, 35, 7),
(23, 'Cierre cobre calibre 4,5  12 cms', 'und', 396, '2026-03-12', 0, 35, 7),
(24, 'Cierre Pol 3 30 cms', 'und', 622, '2026-04-18', 0, 35, 7),
(25, 'Deslizador Niquelado ', 'und', 100, '2026-02-27', 0, 35, 7),
(26, 'Cierre Ignifugo 15 cms ', 'Und', 4089, '2026-03-12', 0, 35, 7),
(27, 'Cierre Separ Pol Nro 6 75 cms las 3bbb', 'und', 3200, '2026-04-18', 0, 50, 7),
(28, 'Cierre Separ Pol Nro 6 75 cms azul osc suzuki', 'und', 608, '2026-03-17', 0, 35, 7),
(29, 'Cierre Ignifugo 15 cms Total reflective', 'und', 4138, '2026-03-17', 0, 20, 7),
(30, 'Cierre pol 6 auto 416 pavonado 75 cms ', 'Und', 3212, '2026-03-24', 0, 35, NULL),
(31, 'Cierre pol 6 auto 416 pavonado 30 cms', 'und', 1523, '2026-03-24', 0, 35, NULL),
(32, 'Cierre Separ Pol Nro 6 75 cms Precio especial segun color ', 'und', 608, '2026-04-18', 0, 35, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cremallera2`
--

CREATE TABLE `cremallera2` (
  `id_cremallera2` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cremallera2`
--

INSERT INTO `cremallera2` (`id_cremallera2`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 7),
(3, 'Cierre Pol 3 20 cms  ', 'und', 504, '2026-03-17', 0, 35, 7),
(7, 'Cierre 30 Cm  Invisible ', 'und', 0, '2026-02-06', 0, 5, 7),
(9, 'Cierre Continuo 2 Carrito Overol Metro', 'und', 1487.2, '2026-01-30', 0, 5, 7),
(15, 'Cierre  Separ Pol Nro 6 75 cms', 'und', 2528, '2026-02-06', 0, 35, 7),
(19, 'Cierre cobre calibre 4,5  17 cms', 'und', 484, '2026-03-17', 0, 35, 7),
(20, 'Cierre  Pol 6 12 a 17 cms jeans dielectrico ', 'und', 871, '2026-02-06', 0, 35, 7),
(21, 'Cierre cadena plastico FR 5', 'metro', 7505, '2026-02-20', 0, 20, 7),
(22, 'Cierre cobre calibre 4,5  15 cms', 'und', 442, '2026-03-12', 0, 35, 7),
(23, 'Cierre cobre calibre 4,5  12 cms', 'und', 396, '2026-03-12', 0, 35, 7),
(24, 'Cierre Pol 3 30 cms', 'und', 622, '2026-04-18', 0, 35, 7),
(25, 'Deslizador Niquelado ', 'und', 100, '2026-02-27', 0, 35, 7),
(26, 'Cierre Ignifugo 15 cms ', 'Und', 4089, '2026-03-12', 0, 35, 7),
(27, 'Cierre Separ Pol Nro 6 75 cms las 3bbb', 'und', 3200, '2026-04-18', 0, 50, 7),
(28, 'Cierre Separ Pol Nro 6 75 cms azul osc suzuki', 'und', 608, '2026-03-17', 0, 35, 7),
(29, 'Cierre Ignifugo 15 cms Total reflective', 'und', 4138, '2026-03-17', 0, 20, 7),
(30, 'Cierre pol 6 auto 416 pavonado 75 cms ', 'Und', 3212, '2026-03-24', 0, 35, NULL),
(31, 'Cierre pol 6 auto 416 pavonado 30 cms', 'und', 1523, '2026-03-24', 0, 35, NULL),
(32, 'Cierre Separ Pol Nro 6 75 cms Precio especial segun color ', 'und', 608, '2026-04-18', 0, 35, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuello`
--

CREATE TABLE `cuello` (
  `id_cuello` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cuello`
--

INSERT INTO `cuello` (`id_cuello`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', 'und', 0, '2025-01-24', 0, 0, 8),
(1, 'Cuello Chaqueta Poliester', 'und', 2494.8, '2025-01-24', 0, 18, 8),
(2, 'Cuello Luigi Insumos Y Troquelados', 'Und', 1470, '2026-05-06', 0, 10, 8),
(3, 'Cuello Neru Sencillo', 'und', 1200, '2026-01-26', 0, 10, 8),
(4, 'Cuello Polialgodon Polo', 'juego', 3717.2, '2025-10-14', 0, 18, 8),
(5, 'Cuello Tejido Poliester', 'und', 1900, '2026-02-03', 0, 18, 8),
(6, 'Cuello Y Puño Poli algodón', 'juego', 3717.6, '2025-10-14', 0, 18, 8),
(7, 'Cuello Y Puño Poliéster', 'juego', 3767.5, '2025-01-24', 0, 18, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deslizador`
--

CREATE TABLE `deslizador` (
  `id_deslizador` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `deslizador`
--

INSERT INTO `deslizador` (`id_deslizador`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2026-03-04', 0, 0, 9),
(2, 'deslizador', 'und', 150, '2026-05-23', NULL, 0, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diseño`
--

CREATE TABLE `diseño` (
  `id_diseño` int(11) NOT NULL,
  `opcion_diseño` varchar(10) DEFAULT NULL,
  `precio_diseño` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `diseño`
--

INSERT INTO `diseño` (`id_diseño`, `opcion_diseño`, `precio_diseño`) VALUES
(0, 'No', 0),
(1, 'Si', 44000),
(2, 'Nuevo', 88000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encarterada`
--

CREATE TABLE `encarterada` (
  `id_encarterada` int(11) NOT NULL,
  `tipo_encarterada` varchar(100) DEFAULT NULL,
  `precio_encarterada` float DEFAULT NULL,
  `actualizacion_encarterada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `encarterada`
--

INSERT INTO `encarterada` (`id_encarterada`, `tipo_encarterada`, `precio_encarterada`, `actualizacion_encarterada`) VALUES
(0, 'No Aplica', 0, '2026-03-05'),
(1, 'No Tiene ', 0, '2026-02-11'),
(2, 'Tiene Encarterada', 1000, '2026-02-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE `entidad` (
  `id_entidad` int(11) NOT NULL,
  `tipo_entidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`id_entidad`, `tipo_entidad`) VALUES
(1, 'Publica'),
(2, 'Privada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

CREATE TABLE `entrega` (
  `id_entrega` int(11) NOT NULL,
  `tipo_entrega` varchar(20) DEFAULT NULL,
  `precio_entrega` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `entrega`
--

INSERT INTO `entrega` (`id_entrega`, `tipo_entrega`, `precio_entrega`) VALUES
(1, 'General', 0),
(2, 'Personalizada', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregado`
--

CREATE TABLE `entregado` (
  `id_entregado` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `por_entregar` int(11) DEFAULT NULL,
  `fecha_entregado` datetime DEFAULT NULL,
  `realizar_XS` int(11) DEFAULT NULL,
  `realizar_S` int(11) DEFAULT NULL,
  `realizar_M` int(11) DEFAULT NULL,
  `realizar_L` int(11) DEFAULT NULL,
  `realizar_XL` int(11) DEFAULT NULL,
  `realizar_2XL` int(11) DEFAULT NULL,
  `realizar_3XL` int(11) DEFAULT NULL,
  `realizar_4XL` int(11) DEFAULT NULL,
  `realizar_5XL` int(11) DEFAULT NULL,
  `realizar_6XL` int(11) DEFAULT NULL,
  `realizar_2` int(11) DEFAULT NULL,
  `realizar_4` int(11) DEFAULT NULL,
  `realizar_6` int(11) DEFAULT NULL,
  `realizar_8` int(11) DEFAULT NULL,
  `realizar_10` int(11) DEFAULT NULL,
  `realizar_12` int(11) DEFAULT NULL,
  `realizar_14` int(11) DEFAULT NULL,
  `realizar_16` int(11) DEFAULT NULL,
  `realizar_18` int(11) DEFAULT NULL,
  `realizar_20` int(11) DEFAULT NULL,
  `realizar_22` int(11) DEFAULT NULL,
  `realizar_24` int(11) DEFAULT NULL,
  `realizar_26` int(11) DEFAULT NULL,
  `realizar_28` int(11) DEFAULT NULL,
  `realizar_30` int(11) DEFAULT NULL,
  `realizar_32` int(11) DEFAULT NULL,
  `realizar_34` int(11) DEFAULT NULL,
  `realizar_36` int(11) DEFAULT NULL,
  `realizar_38` int(11) DEFAULT NULL,
  `realizar_40` int(11) DEFAULT NULL,
  `realizar_42` int(11) DEFAULT NULL,
  `realizar_44` int(11) DEFAULT NULL,
  `realizar_46` int(11) DEFAULT NULL,
  `realizar_48` int(11) DEFAULT NULL,
  `realizar_especial` int(11) DEFAULT NULL,
  `entrega_XS` int(11) DEFAULT NULL,
  `entrega_S` int(11) DEFAULT NULL,
  `entrega_M` int(11) DEFAULT NULL,
  `entrega_L` int(11) DEFAULT NULL,
  `entrega_XL` int(11) DEFAULT NULL,
  `entrega_2XL` int(11) DEFAULT NULL,
  `entrega_3XL` int(11) DEFAULT NULL,
  `entrega_4XL` int(11) DEFAULT NULL,
  `entrega_5XL` int(11) DEFAULT NULL,
  `entrega_6XL` int(11) DEFAULT NULL,
  `entrega_2` int(11) DEFAULT NULL,
  `entrega_4` int(11) DEFAULT NULL,
  `entrega_6` int(11) DEFAULT NULL,
  `entrega_8` int(11) DEFAULT NULL,
  `entrega_10` int(11) DEFAULT NULL,
  `entrega_12` int(11) DEFAULT NULL,
  `entrega_14` int(11) DEFAULT NULL,
  `entrega_16` int(11) DEFAULT NULL,
  `entrega_18` int(11) DEFAULT NULL,
  `entrega_20` int(11) DEFAULT NULL,
  `entrega_22` int(11) DEFAULT NULL,
  `entrega_24` int(11) DEFAULT NULL,
  `entrega_26` int(11) DEFAULT NULL,
  `entrega_28` int(11) DEFAULT NULL,
  `entrega_30` int(11) DEFAULT NULL,
  `entrega_32` int(11) DEFAULT NULL,
  `entrega_34` int(11) DEFAULT NULL,
  `entrega_36` int(11) DEFAULT NULL,
  `entrega_38` int(11) DEFAULT NULL,
  `entrega_40` int(11) DEFAULT NULL,
  `entrega_42` int(11) DEFAULT NULL,
  `entrega_44` int(11) DEFAULT NULL,
  `entrega_46` int(11) DEFAULT NULL,
  `entrega_48` int(11) DEFAULT NULL,
  `entrega_especial` int(11) DEFAULT NULL,
  `completado_XS` int(11) DEFAULT NULL,
  `completado_S` int(11) DEFAULT NULL,
  `completado_M` int(11) DEFAULT NULL,
  `completado_L` int(11) DEFAULT NULL,
  `completado_XL` int(11) DEFAULT NULL,
  `completado_2XL` int(11) DEFAULT NULL,
  `completado_3XL` int(11) DEFAULT NULL,
  `completado_4XL` int(11) DEFAULT NULL,
  `completado_5XL` int(11) DEFAULT NULL,
  `completado_6XL` int(11) DEFAULT NULL,
  `completado_2` int(11) DEFAULT NULL,
  `completado_4` int(11) DEFAULT NULL,
  `completado_6` int(11) DEFAULT NULL,
  `completado_8` int(11) DEFAULT NULL,
  `completado_10` int(11) DEFAULT NULL,
  `completado_12` int(11) DEFAULT NULL,
  `completado_14` int(11) DEFAULT NULL,
  `completado_16` int(11) DEFAULT NULL,
  `completado_18` int(11) DEFAULT NULL,
  `completado_20` int(11) DEFAULT NULL,
  `completado_22` int(11) DEFAULT NULL,
  `completado_24` int(11) DEFAULT NULL,
  `completado_26` int(11) DEFAULT NULL,
  `completado_28` int(11) DEFAULT NULL,
  `completado_30` int(11) DEFAULT NULL,
  `completado_32` int(11) DEFAULT NULL,
  `completado_34` int(11) DEFAULT NULL,
  `completado_36` int(11) DEFAULT NULL,
  `completado_38` int(11) DEFAULT NULL,
  `completado_40` int(11) DEFAULT NULL,
  `completado_42` int(11) DEFAULT NULL,
  `completado_44` int(11) DEFAULT NULL,
  `completado_46` int(11) DEFAULT NULL,
  `completado_48` int(11) DEFAULT NULL,
  `completado_especial` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entretela`
--

CREATE TABLE `entretela` (
  `id_entretela` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `entretela`
--

INSERT INTO `entretela` (`id_entretela`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 10),
(1, 'Entretela 2,5 Insumos Y Troquelados camisas ', '0,65', 196.9, '2026-01-30', 0, 11, 10),
(2, 'Entretela 3,5 Insumos Y Troquelados camisas', 'metro', 424, '2026-03-17', 0, 11, 10),
(3, 'Entretela No Tejida Interlon Adhesivo Fredenberg', '0,05', 0, '2026-01-26', 0, 11, 10),
(4, 'Entretela NS35 Para Pantalon', '0,25', 0, '2026-01-26', 0, 16, 10),
(5, 'Entretela QSM 7750 Spandex Para Pantalon', '0,25', 0, '2026-01-26', 0, 9, 10),
(6, 'Entretela 3,0 Insumos Y Troquelados blusas ', 'metro', 162, '2026-04-18', 0, 11, 10),
(7, 'Entretela 8070 HDPE  Inalsi', '0,09', 0, '2026-01-30', 0, 9, 10),
(9, 'Entretela NF 35 Blanco', 'metro', 2320, '2026-01-30', 0, 16, 10),
(10, 'Entretela 2010 Blanca con spandex ', 'metro', 3750, '2026-02-04', 0, 16, 10),
(11, 'Entretela 3,0 Insumos Y Troquelados Camisas Hombre ', 'metro', 365, '2026-04-18', 0, 11, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entretela2`
--

CREATE TABLE `entretela2` (
  `id_entretela2` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `entretela2`
--

INSERT INTO `entretela2` (`id_entretela2`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, NULL, 0, 0, 10),
(1, 'Entretela 2,5 Insumos Y Troquelados camisas ', '0,65', 196.9, '0000-00-00', 0, 11, 10),
(2, 'Entretela 3,5 Insumos Y Troquelados camisas', 'metro', 424, '2026-03-17', 0, 11, 10),
(3, 'Entretela No Tejida Interlon Adhesivo Fredenberg', '0,05', 0, '0000-00-00', 0, 11, 10),
(4, 'Entretela NS35 Para Pantalon', '0,25', 0, '0000-00-00', 0, 16, 10),
(5, 'Entretela QSM 7750 Spandex Para Pantalon', '0,25', 0, '0000-00-00', 0, 9, 10),
(6, 'Entretela 3,0 Insumos Y Troquelados blusas ', 'metro', 162, '2026-04-18', 0, 11, 10),
(7, 'Entretela 8070 HDPE  Inalsi', '0,09', 0, '0000-00-00', 0, 9, 10),
(9, 'Entretela NF 35 Blanco', 'metro', 2320, '0000-00-00', 0, 16, 10),
(10, 'Entretela 2010 Blanca con spandex ', 'metro', 3750, '0000-00-00', 0, 16, 10),
(12, 'Entretela 3,0 Insumos Y Troquelados camisa', 'metro', 365, '2026-03-17', 0, 11, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fajon_cintura`
--

CREATE TABLE `fajon_cintura` (
  `id_fajon_cintura` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fajon_cintura`
--

INSERT INTO `fajon_cintura` (`id_fajon_cintura`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, NULL, 0, 0, 27),
(2, 'fajon', 'und', 2800, '2026-05-20', 0, 0, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_tecnica`
--

CREATE TABLE `ficha_tecnica` (
  `id_fichatecnica` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `ficha_tecnica` longblob DEFAULT NULL,
  `color_entretela` varchar(100) DEFAULT NULL,
  `color_entretela2` varchar(100) DEFAULT NULL,
  `fecha_subida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ficha_tecnica`
--

INSERT INTO `ficha_tecnica` (`id_fichatecnica`, `id_producto`, `ficha_tecnica`, `color_entretela`, `color_entretela2`, `fecha_subida`) VALUES
(3, 2391, 0x436f7374656f5f456a656d706c6f20636c69656e7465206e7565766f2e786c7378, '', NULL, '2026-05-25 17:58:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fusionado`
--

CREATE TABLE `fusionado` (
  `id_fusionado` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `fusionado`
--

INSERT INTO `fusionado` (`id_fusionado`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 11),
(1, 'Fusionado Cuello', 'und', 700, '2026-01-30', 0, 10, 11),
(2, 'Fusionado Cuello Y Puño', 'und', 1400, '2026-02-04', 0, 10, 11),
(3, 'Fusionado Pantalon Spandex', 'und', 0, '2026-01-30', 0, 10, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guata`
--

CREATE TABLE `guata` (
  `id_guata` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `guata`
--

INSERT INTO `guata` (`id_guata`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 12),
(1, 'Guata Ancho 1,60 120 Gramo', 'metro', 3521.3, '2026-02-03', 0, 1, 12),
(2, 'Guata Semiprensada 1cm Grosor ', 'metro', 7499.5, '2026-02-26', 0, 19, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hiladilla`
--

CREATE TABLE `hiladilla` (
  `id_hiladilla` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `hiladilla`
--

INSERT INTO `hiladilla` (`id_hiladilla`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, NULL, 0, 0, 13),
(1, 'Hiladillo Poliester 103', '10 MM', 214, '0000-00-00', 0, 35, 13),
(3, 'Hiladillo pol 1 cms de ancho  compra centro', 'metro', 358, '2026-04-18', 0, 50, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hombrera`
--

CREATE TABLE `hombrera` (
  `id_hombrera` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `hombrera`
--

INSERT INTO `hombrera` (`id_hombrera`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 14),
(1, 'Hombreras', 'par', 1387.1, '2025-01-24', 0, 5, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lleva_reflectiva`
--

CREATE TABLE `lleva_reflectiva` (
  `id_lleva` int(11) NOT NULL,
  `tipo_llevar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lleva_reflectiva`
--

INSERT INTO `lleva_reflectiva` (`id_lleva`, `tipo_llevar`) VALUES
(1, 'No lleva'),
(2, 'En la parte Inferior'),
(3, 'En la rodilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logistica`
--

CREATE TABLE `logistica` (
  `id_logistica` int(11) NOT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `logistica`
--

INSERT INTO `logistica` (`id_logistica`, `precio`) VALUES
(1, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mano_obra`
--

CREATE TABLE `mano_obra` (
  `id_mano_obra` int(11) NOT NULL,
  `producto` varchar(300) DEFAULT NULL,
  `precio_confeccion` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `id_tipo_prenda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `mano_obra`
--

INSERT INTO `mano_obra` (`id_mano_obra`, `producto`, `precio_confeccion`, `fecha_actualizacion`, `id_tipo_prenda`) VALUES
(1, 'Camisa Antifluido Sencilla', 7000, '2026-05-26', 1),
(2, 'Camisa Chef o Aux cocina', 15000, '2026-02-18', 1),
(3, 'Camisa Ejecutiva MC', 14000, '2026-02-23', 1),
(4, 'Camisa Ejecutiva ML ', 18000, '2026-02-23', 1),
(5, 'Camisa Operativa MC con botones o cierre', 13000, '2026-02-23', 1),
(6, 'Camisa Operativa ML  con botones o cierre  ', 14000, '2026-02-18', 1),
(7, 'Camisa Senderismo MC', 16000, '2026-02-18', 1),
(8, 'Camisa Senderismo ML', 16500, '2026-02-23', 1),
(9, 'Camisa soldador Busscar', 14000, '2026-02-23', 1),
(10, 'Camisa soldador sencilla  Mag Hit', 9500, '2026-02-23', 1),
(11, 'Camisa soldador Suzuki', 25000, '2026-02-18', 1),
(12, 'Bata Laboratorio Cuello Neru', 13000, '2026-02-24', 1),
(13, 'Bata Laboratorio Cuello Sport', 12000, '2026-02-24', 1),
(14, 'Blazer Hombre', 30000, '2026-02-23', 1),
(15, 'Chaleco - 2 Tela + forro', 13000, '2026-02-24', 1),
(16, 'Chaleco - 3 Tela + forro + guata', 14000, '2026-02-24', 1),
(17, 'Chaleco -1 Tela sencilla ', 8000, '2026-02-24', 1),
(18, 'Chaleco Drill 2 Bolsillos', 12000, '2026-02-23', 1),
(19, 'Chaleco Drill 6 Bolsillos', 14000, '2026-02-23', 1),
(20, 'Chaleco Drill 8 a 9 Bolsillos', 15000, '2026-02-23', 1),
(21, 'Chaqueta conjunto operativa Cartama', 15000, '2026-02-24', 1),
(22, 'Delantal Cintura 2 Bolsillos', 5000, '2026-01-28', 1),
(23, 'Delantal Cintura Con Abertura', 5500, '2026-01-28', 1),
(24, 'Delantal Cuello', 6000, '2026-01-28', 1),
(25, 'Peto Futbol', 6000, '2026-01-28', 1),
(26, 'Polo MC ARA', 3800, '2026-02-18', 1),
(27, 'Polo MC Misma Tela', 6500, '2026-01-28', 1),
(28, 'Polo MC Tejido', 6000, '2026-01-28', 1),
(29, 'Polo ML Misma Tela', 7500, '2026-02-18', 1),
(30, 'Polo ML Tejido', 7000, '2026-02-18', 1),
(31, 'TShirt MC', 3500, '2026-02-23', 1),
(32, 'TShirt MC Con Cinta', 4000, '2026-02-23', 1),
(33, 'TShirt ML', 4000, '2026-02-23', 1),
(34, 'TShirt ML Con Cinta', 4500, '2026-02-23', 1),
(35, 'Blusa Antifluido Nivel de dif  2', 8000, '2026-02-19', 2),
(36, 'Blusa Antifluido Nivel de dif  3', 9000, '2026-02-19', 2),
(37, 'Blusa Antifluido Sencilla', 7000, '2026-02-23', 2),
(38, 'Blusa Ejecutiva MC', 14000, '2026-02-23', 2),
(39, 'Blusa Ejecutiva ML ', 18000, '2026-02-23', 2),
(40, 'Blusa manga 3/4 ', 14000, '2026-02-24', 2),
(41, 'Blusa Operativa MC con botones o cierre', 13000, '2026-02-23', 2),
(42, 'Blusa Operativa ML  con botones o cierre  ', 14000, '2026-02-18', 2),
(43, 'Blusa Senderismo MC', 16000, '2026-02-18', 2),
(44, 'Blusa Senderismo ML', 16500, '2026-02-23', 2),
(45, 'Blusa soldador Busscar', 14000, '2026-02-23', 2),
(46, 'Blusa soldador sencilla  Mag Hit', 9500, '2026-02-23', 2),
(47, 'Blusa soldador Suzuki', 25000, '2026-02-18', 2),
(48, 'Bata Laboratorio Cuello Neru', 13000, '2026-02-24', 2),
(49, 'Bata Laboratorio Cuello Sport', 12000, '2026-02-24', 2),
(50, 'Blazer Dama', 30000, '2026-02-23', 2),
(51, 'Camisa Chef o Aux cocina', 15000, '2026-02-18', 2),
(52, 'Chaleco  - 2 Tela + forro', 13000, '2026-02-24', 2),
(53, 'Chaleco - 1 Tela sencill', 8000, '2026-02-24', 2),
(54, 'Chaleco - 3 Tela + forro + guata', 14000, '2026-02-24', 2),
(55, 'Chaleco Drill 2 Bolsillos', 12000, '2026-02-23', 2),
(56, 'Chaleco Drill 6 Bolsillos', 14000, '2026-02-23', 2),
(57, 'Chaleco Drill 8 a 9 Bolsillos', 15000, '2026-02-23', 2),
(58, 'Chaqueta conjunto operativa Cartama', 15000, '2026-02-24', 2),
(59, 'Delantal Cintura 2 Bolsillos', 5000, '2026-01-28', 2),
(60, 'Delantal Cintura Con Abertura', 5500, '2026-01-28', 2),
(61, 'Delantal Cuello', 6000, '2026-01-28', 2),
(62, 'Peto Futbol', 6000, '2026-01-28', 2),
(63, 'Polo MC ARA', 3800, '2026-02-18', 2),
(64, 'Polo MC Misma Tela', 6500, '2026-01-28', 2),
(65, 'Polo MC Tejido', 6000, '2026-01-28', 2),
(66, 'Polo ML Misma Tela', 7500, '2026-02-18', 2),
(67, 'Polo ML Tejido', 7000, '2026-02-18', 2),
(68, 'TShirt MC', 3500, '2026-02-23', 2),
(69, 'TShirt MC Con Cinta', 4000, '2026-02-23', 2),
(70, 'TShirt ML', 4000, '2026-02-23', 2),
(71, 'TShirt ML Con Cinta', 4500, '2026-02-23', 2),
(72, 'Jean Dotacion más terminado', 7900, '2026-02-25', 3),
(73, 'Jean Cinta Reflectiva Bota', 8400, '2026-02-25', 3),
(74, 'Pantalon Camuflado', 20000, '2026-02-25', 3),
(75, 'Pantalón Clasico ', 16000, '2026-02-25', 3),
(76, 'Pantalon Drill adm Hombre', 16000, '2026-02-25', 3),
(77, 'Pantalon Clasico con pretina Industrial Hombre', 17000, '2026-02-25', 3),
(78, ' Jean Con ref en Guata', 8400, '2026-02-25', 3),
(79, 'Jean Con Guata Y Cinta', 8900, '2026-02-25', 3),
(80, 'Pantalón Vigilante', 14000, '2026-02-25', 3),
(81, 'Sudadera Antifluido Hombre', 6000, '2026-02-19', 3),
(82, 'Sudadera Ant Bolsillos Camuflado x2', 7000, '2026-02-25', 3),
(83, 'Pantaloneta con malla', 7000, '2026-02-25', 3),
(84, 'Sudadera en Drill con bolsillos camuflados', 9000, '2026-02-19', 3),
(85, 'Jean Dotacion m?s terminado', 7900, '2026-02-25', 4),
(86, 'Jean Cinta Reflectiva Bota', 8400, '2026-02-25', 4),
(87, 'Pantalon Camuflado', 20000, '2026-02-25', 4),
(88, 'Pantalón Clasico ', 16000, '2026-02-25', 4),
(89, 'Pantalon Drill adm Dama', 16000, '2026-02-25', 4),
(90, 'Pantalon Clasico con pretina Industrial Dama', 17000, '2026-02-25', 4),
(91, ' Jean Con ref en Guata', 8400, '2026-02-25', 4),
(92, 'Jean Con Guata Y Cinta', 8900, '2026-02-25', 4),
(93, 'Pantalón Vigilante', 14000, '2026-02-25', 4),
(94, 'Sudadera Antifluido Dama', 6000, '2026-02-19', 4),
(95, 'Sudadera Ant Bolsillos Camuflado x2', 7000, '2026-02-25', 4),
(96, 'Pantaloneta con malla', 7000, '2026-02-25', 4),
(97, 'Sudadera en Drill con bolsillos camuflados', 9000, '2026-02-19', 4),
(98, 'Buso Con Capota Sencillo', 11000, '2026-01-28', 5),
(99, 'Buso Con Capota Y Bolsillo', 12000, '2026-01-28', 5),
(100, 'Buso Sin Capota', 10000, '2026-01-28', 5),
(101, 'Chaqueta - 2 Tela + forro', 18000, '2026-02-24', 5),
(102, 'Chaqueta con capota - 1 Tela sencilla', 12500, '2026-02-24', 5),
(103, 'Chaqueta con capota - 3 Tela + forro + guata', 24000, '2026-02-24', 5),
(104, 'Chaqueta con capota - 2 Tela + forro', 20000, '2026-02-24', 5),
(105, 'Chaqueta - 3 Tela + forro + guata', 22000, '2026-02-24', 5),
(106, 'Chaqueta - 1 Tela sencilla', 10500, '2026-02-24', 5),
(107, 'Chaqueta bomber ', 20000, '2026-02-24', 5),
(108, 'Chaqueta especial cuartos fríos', 25000, '2026-02-24', 5),
(109, 'Overol Cinta Reflectiva', 17500, '2026-01-28', 6),
(110, 'Overol MC Drill', 21000, '2026-01-28', 6),
(111, 'Overol MC Drill Con Tapa Cierre', 22500, '2026-01-28', 6),
(112, 'Overol ML Antifluido', 22500, '2026-01-28', 6),
(113, 'Overol Ml Drill', 22000, '2026-01-28', 6),
(114, 'Overol ML Drill Con Detalles', 23500, '2026-01-28', 6),
(115, 'Conjunto Antifluido Con Contraste', 15000, '2026-01-28', 7),
(116, 'Conjunto Antifluido Con Diseño', 20500, '2026-01-28', 7),
(117, 'Conjunto Antifluido Sencillo', 14000, '0000-00-00', 7),
(118, 'Cofia Con Detalles', 4000, '0000-00-00', 7),
(119, 'Cofia Sencilla', 3500, '0000-00-00', 7),
(120, 'Gorra Beisbolera Beatriz Cartago', 5500, '0000-00-00', 7),
(121, 'Gorra Chavo Beatriz Cartago', 6000, '0000-00-00', 7),
(122, 'Gorra Tipo Monja', 3200, '0000-00-00', 7),
(123, 'Mangas', 3000, '0000-00-00', 7),
(124, 'Pava Con Broche Beatriz Cartago', 9300, '0000-00-00', 7),
(125, 'Pava Sin Broche Beatriz Cartago', 7800, '0000-00-00', 7),
(169, 'Conjunto en perchado', 16000, '2026-02-26', 7),
(170, 'Chaleco  x 2', 12000, '2026-02-26', 5),
(171, 'Bata Laboratorio Cuello Sport', 12000, '2026-02-27', 7),
(172, 'Ribarco ', 1, '2026-03-02', 1),
(173, 'Ribarco ', 1, '2026-03-02', 7),
(174, 'overol ', 22000, '2026-03-03', 3),
(175, 'overol', 22000, '2026-03-03', 1),
(176, 'Delantal cuello ', 6000, '2026-03-05', 7),
(177, 'Ribarco ', 1, '2026-03-18', 3),
(178, 'ENERGÍA DE PEREIRA ', 1, '2026-03-24', 2),
(179, 'Tapabocas', 1000, '2026-04-21', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marquilla`
--

CREATE TABLE `marquilla` (
  `id_marquilla` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `marquilla`
--

INSERT INTO `marquilla` (`id_marquilla`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(1, 'Marquilla', 'undidad', 60.5, '2025-01-24', 0, 0, 16),
(3, 'Marquilla tejida Suzuki ', 'Und', 196, '2026-02-03', 0, 12, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestra`
--

CREATE TABLE `muestra` (
  `id_muestra` int(11) NOT NULL,
  `requiere` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `muestra`
--

INSERT INTO `muestra` (`id_muestra`, `requiere`) VALUES
(1, 'No Requiere'),
(2, 'Si Requiere');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id_ordencompra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `consumo_tela` float DEFAULT NULL,
  `precio_telacompra` float DEFAULT NULL,
  `total_telacotizado` float DEFAULT NULL,
  `total_telacompra` float DEFAULT NULL,
  `dif_und_tela` float DEFAULT NULL,
  `dif_total_tela` float DEFAULT NULL,
  `consumo_realund` float DEFAULT NULL,
  `consumo_realtotal` float DEFAULT NULL,
  `dif_consumo_und` float DEFAULT NULL,
  `dif_consumo_total` float DEFAULT NULL,
  `consumo_telacombi` float DEFAULT NULL,
  `precio_telacombicompra` float DEFAULT NULL,
  `total_telacombicotizado` float DEFAULT NULL,
  `total_telacombicompra` float DEFAULT NULL,
  `dif_und_telacombi` float DEFAULT NULL,
  `dif_total_telacombi` float DEFAULT NULL,
  `consumo_combinadaund` float DEFAULT NULL,
  `consumo_combinadatotal` float DEFAULT NULL,
  `dif_consumocombi_und` float DEFAULT NULL,
  `dif_consumocombi_total` float DEFAULT NULL,
  `consumo_telaforro` float DEFAULT NULL,
  `precio_telaforrocompra` float DEFAULT NULL,
  `total_telaforrocotizado` float DEFAULT NULL,
  `total_telaforrocompra` float DEFAULT NULL,
  `dif_und_telaforro` float DEFAULT NULL,
  `dif_total_telaforro` float DEFAULT NULL,
  `consumo_forround` float DEFAULT NULL,
  `consumo_forrototal` float DEFAULT NULL,
  `dif_consumoforro_und` float DEFAULT NULL,
  `dif_consumoforro_total` float DEFAULT NULL,
  `consumo_totalcuello` float DEFAULT NULL,
  `precio_cuellocompra` float DEFAULT NULL,
  `total_cuellocotizado` float DEFAULT NULL,
  `total_cuellocompra` float DEFAULT NULL,
  `dif_und_cuello` float DEFAULT NULL,
  `dif_total_cuello` float DEFAULT NULL,
  `consumo_totaldeslizador` float DEFAULT NULL,
  `precio_deslizadorcompra` float DEFAULT NULL,
  `total_deslizadorcotizado` float DEFAULT NULL,
  `total_deslizadorcompra` float DEFAULT NULL,
  `dif_und_deslizador` float DEFAULT NULL,
  `dif_total_deslizador` float DEFAULT NULL,
  `consumo_totalfajon_cintura` float DEFAULT NULL,
  `precio_fajon_cinturacompra` float DEFAULT NULL,
  `total_fajon_cinturacotizado` float DEFAULT NULL,
  `total_fajon_cinturacompra` float DEFAULT NULL,
  `dif_und_fajon_cintura` float DEFAULT NULL,
  `dif_total_fajon_cintura` float DEFAULT NULL,
  `consumo_totalpuño` float DEFAULT NULL,
  `precio_puñocompra` float DEFAULT NULL,
  `total_puñocotizado` float DEFAULT NULL,
  `total_puñocompra` float DEFAULT NULL,
  `dif_und_puño` float DEFAULT NULL,
  `dif_total_puño` float DEFAULT NULL,
  `consumo_totalboton` float DEFAULT NULL,
  `precio_botoncompra` float DEFAULT NULL,
  `total_botoncotizado` float DEFAULT NULL,
  `total_botoncompra` float DEFAULT NULL,
  `dif_und_boton` float DEFAULT NULL,
  `dif_total_boton` float DEFAULT NULL,
  `consumo_totalboton2` float DEFAULT NULL,
  `precio_boton2compra` float DEFAULT NULL,
  `total_boton2cotizado` float DEFAULT NULL,
  `total_boton2compra` float DEFAULT NULL,
  `dif_und_boton2` float DEFAULT NULL,
  `dif_total_boton2` float DEFAULT NULL,
  `consumo_totalentretela` float DEFAULT NULL,
  `precio_entretelacompra` float DEFAULT NULL,
  `total_entretelacotizado` float DEFAULT NULL,
  `total_entretelacompra` float DEFAULT NULL,
  `dif_und_entretela` float DEFAULT NULL,
  `dif_total_entretela` float DEFAULT NULL,
  `consumo_totalentretela2` float DEFAULT NULL,
  `precio_entretela2compra` float DEFAULT NULL,
  `total_entretela2cotizado` float DEFAULT NULL,
  `total_entretela2compra` float DEFAULT NULL,
  `dif_und_entretela2` float DEFAULT NULL,
  `dif_total_entretela2` float DEFAULT NULL,
  `consumo_entretela2und` float DEFAULT NULL,
  `consumo_entretela2total` float DEFAULT NULL,
  `dif_consentretela2_und` float DEFAULT NULL,
  `dif_consentretela2_total` float DEFAULT NULL,
  `consumo_entretelaund` float DEFAULT NULL,
  `consumo_entretelatotal` float DEFAULT NULL,
  `dif_consentretela_und` float DEFAULT NULL,
  `dif_consentretela_total` float DEFAULT NULL,
  `consumo_totalcremallera` float DEFAULT NULL,
  `precio_cremalleracompra` float DEFAULT NULL,
  `total_cremalleracotizado` float DEFAULT NULL,
  `total_cremalleracompra` float DEFAULT NULL,
  `dif_und_cremallera` float DEFAULT NULL,
  `dif_total_cremallera` float DEFAULT NULL,
  `consumo_totalcremallera2` float DEFAULT NULL,
  `precio_cremallera2compra` float DEFAULT NULL,
  `total_cremallera2cotizado` float DEFAULT NULL,
  `total_cremallera2compra` float DEFAULT NULL,
  `dif_und_cremallera2` float DEFAULT NULL,
  `dif_total_cremallera2` float DEFAULT NULL,
  `consumo_totalvelcro` float DEFAULT NULL,
  `precio_velcrocompra` float DEFAULT NULL,
  `total_velcrocotizado` float DEFAULT NULL,
  `total_velcrocompra` float DEFAULT NULL,
  `dif_und_velcro` float DEFAULT NULL,
  `dif_total_velcro` float DEFAULT NULL,
  `consumo_totalresorte` float DEFAULT NULL,
  `precio_resortecompra` float DEFAULT NULL,
  `total_resortecotizado` float DEFAULT NULL,
  `total_resortecompra` float DEFAULT NULL,
  `dif_und_resorte` float DEFAULT NULL,
  `dif_total_resorte` float DEFAULT NULL,
  `consumo_totalresorte2` float DEFAULT NULL,
  `precio_resorte2compra` float DEFAULT NULL,
  `total_resorte2cotizado` float DEFAULT NULL,
  `total_resorte2compra` float DEFAULT NULL,
  `dif_und_resorte2` float DEFAULT NULL,
  `dif_total_resorte2` float DEFAULT NULL,
  `consumo_totalhombrera` float DEFAULT NULL,
  `precio_hombreracompra` float DEFAULT NULL,
  `total_hombreracotizado` float DEFAULT NULL,
  `total_hombreracompra` float DEFAULT NULL,
  `dif_und_hombrera` float DEFAULT NULL,
  `dif_total_hombrera` float DEFAULT NULL,
  `consumo_totalsesgo` float DEFAULT NULL,
  `precio_sesgocompra` float DEFAULT NULL,
  `total_sesgocotizado` float DEFAULT NULL,
  `total_sesgocompra` float DEFAULT NULL,
  `dif_und_sesgo` float DEFAULT NULL,
  `dif_total_sesgo` float DEFAULT NULL,
  `consumo_totaltrabilla` float DEFAULT NULL,
  `precio_trabillacompra` float DEFAULT NULL,
  `total_trabillacotizado` float DEFAULT NULL,
  `total_trabillacompra` float DEFAULT NULL,
  `dif_und_trabilla` float DEFAULT NULL,
  `dif_total_trabilla` float DEFAULT NULL,
  `consumo_totalvivo` float DEFAULT NULL,
  `precio_vivocompra` float DEFAULT NULL,
  `total_vivocotizado` float DEFAULT NULL,
  `total_vivocompra` float DEFAULT NULL,
  `dif_und_vivo` float DEFAULT NULL,
  `dif_total_vivo` float DEFAULT NULL,
  `consumo_totalcinta` float DEFAULT NULL,
  `precio_cintacompra` float DEFAULT NULL,
  `total_cintacotizado` float DEFAULT NULL,
  `total_cintacompra` float DEFAULT NULL,
  `dif_und_cinta` float DEFAULT NULL,
  `dif_total_cinta` float DEFAULT NULL,
  `consumo_totalfaya` float DEFAULT NULL,
  `precio_fayacompra` float DEFAULT NULL,
  `total_fayacotizado` float DEFAULT NULL,
  `total_fayacompra` float DEFAULT NULL,
  `dif_und_faya` float DEFAULT NULL,
  `dif_total_faya` float DEFAULT NULL,
  `consumo_totalguata` float DEFAULT NULL,
  `precio_guatacompra` float DEFAULT NULL,
  `total_guatacotizado` float DEFAULT NULL,
  `total_guatacompra` float DEFAULT NULL,
  `dif_und_guata` float DEFAULT NULL,
  `dif_total_guata` float DEFAULT NULL,
  `consumo_totalhiladilla` float DEFAULT NULL,
  `precio_hiladillacompra` float DEFAULT NULL,
  `total_hiladillacotizado` float DEFAULT NULL,
  `total_hiladillacompra` float DEFAULT NULL,
  `dif_und_hiladilla` float DEFAULT NULL,
  `dif_total_hiladilla` float DEFAULT NULL,
  `consumo_totalpretina` float DEFAULT NULL,
  `precio_pretinacompra` float DEFAULT NULL,
  `total_pretinacotizado` float DEFAULT NULL,
  `total_pretinacompra` float DEFAULT NULL,
  `dif_und_pretina` float DEFAULT NULL,
  `dif_total_pretina` float DEFAULT NULL,
  `consumo_totalbroche` float DEFAULT NULL,
  `precio_brochecompra` float DEFAULT NULL,
  `total_brochecotizado` float DEFAULT NULL,
  `total_brochecompra` float DEFAULT NULL,
  `dif_und_broche` float DEFAULT NULL,
  `dif_total_broche` float DEFAULT NULL,
  `consumo_totalcordon` float DEFAULT NULL,
  `precio_cordoncompra` float DEFAULT NULL,
  `total_cordoncotizado` float DEFAULT NULL,
  `total_cordoncompra` float DEFAULT NULL,
  `dif_und_cordon` float DEFAULT NULL,
  `dif_total_cordon` float DEFAULT NULL,
  `consumo_totalpuntera` float DEFAULT NULL,
  `precio_punteracompra` float DEFAULT NULL,
  `total_punteracotizado` float DEFAULT NULL,
  `total_punteracompra` float DEFAULT NULL,
  `dif_und_puntera` float DEFAULT NULL,
  `dif_total_puntera` float DEFAULT NULL,
  `consumo_totalplumilla` float DEFAULT NULL,
  `precio_plumillacompra` float DEFAULT NULL,
  `total_plumillacotizado` float DEFAULT NULL,
  `total_plumillacompra` float DEFAULT NULL,
  `dif_und_plumilla` float DEFAULT NULL,
  `dif_total_plumilla` float DEFAULT NULL,
  `consumo_totalvinilo` float DEFAULT NULL,
  `precio_vinilocompra` float DEFAULT NULL,
  `total_vinilocotizado` float DEFAULT NULL,
  `total_vinilocompra` float DEFAULT NULL,
  `dif_und_vinilo` float DEFAULT NULL,
  `dif_total_vinilo` float DEFAULT NULL,
  `consumo_totalmarquilla` float DEFAULT NULL,
  `precio_marquillacompra` float DEFAULT NULL,
  `total_marquillacotizado` float DEFAULT NULL,
  `total_marquillacompra` float DEFAULT NULL,
  `dif_und_marquilla` float DEFAULT NULL,
  `dif_total_marquilla` float DEFAULT NULL,
  `consumo_totalbolsa` longblob DEFAULT NULL,
  `precio_bolsacompra` longblob DEFAULT NULL,
  `total_bolsacotizado` longblob DEFAULT NULL,
  `total_bolsacompra` longblob DEFAULT NULL,
  `dif_und_bolsa` longblob DEFAULT NULL,
  `dif_total_bolsa` longblob DEFAULT NULL,
  `prendas_comprar` float DEFAULT NULL,
  `precio_prendacompra` float DEFAULT NULL,
  `total_prendacotizado` float DEFAULT NULL,
  `total_prendacompra` float DEFAULT NULL,
  `dif_und_prenda` float DEFAULT NULL,
  `dif_total_prenda` float DEFAULT NULL,
  `orden_compratela` longblob DEFAULT NULL,
  `orden_compratelacombi` longblob DEFAULT NULL,
  `orden_compratelaforro` longblob DEFAULT NULL,
  `orden_compraentretela` longblob DEFAULT NULL,
  `orden_compracuello` longblob DEFAULT NULL,
  `orden_comprapuño` longblob DEFAULT NULL,
  `orden_compravelcro` longblob DEFAULT NULL,
  `orden_comprahombrera` longblob DEFAULT NULL,
  `orden_comprasesgo` longblob DEFAULT NULL,
  `orden_compratrabilla` longblob DEFAULT NULL,
  `orden_compravivo` longblob DEFAULT NULL,
  `orden_compraguata` longblob DEFAULT NULL,
  `orden_comprapretina` longblob DEFAULT NULL,
  `orden_comprabroche` longblob DEFAULT NULL,
  `orden_compracordon` longblob DEFAULT NULL,
  `orden_comprapuntera` longblob DEFAULT NULL,
  `orden_compraplumilla` longblob DEFAULT NULL,
  `orden_compravinilo` longblob DEFAULT NULL,
  `orden_compraboton` longblob DEFAULT NULL,
  `orden_compraboton2` longblob DEFAULT NULL,
  `orden_compracremallera` longblob DEFAULT NULL,
  `orden_compracremallera2` longblob DEFAULT NULL,
  `orden_compraresorte` longblob DEFAULT NULL,
  `orden_compraresorte2` longblob DEFAULT NULL,
  `orden_compracinta` longblob DEFAULT NULL,
  `orden_comprafaya` longblob DEFAULT NULL,
  `orden_compramarquilla` longblob DEFAULT NULL,
  `orden_comprabolsa` longblob DEFAULT NULL,
  `orden_compraprenda` longblob DEFAULT NULL,
  `orden_compradeslizador` longblob DEFAULT NULL,
  `orden_compraentretela2` longblob DEFAULT NULL,
  `orden_comprafajon_cintura` longblob DEFAULT NULL,
  `orden_comprahiladilla` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id_ordencompra`, `id_producto`, `consumo_tela`, `precio_telacompra`, `total_telacotizado`, `total_telacompra`, `dif_und_tela`, `dif_total_tela`, `consumo_realund`, `consumo_realtotal`, `dif_consumo_und`, `dif_consumo_total`, `consumo_telacombi`, `precio_telacombicompra`, `total_telacombicotizado`, `total_telacombicompra`, `dif_und_telacombi`, `dif_total_telacombi`, `consumo_combinadaund`, `consumo_combinadatotal`, `dif_consumocombi_und`, `dif_consumocombi_total`, `consumo_telaforro`, `precio_telaforrocompra`, `total_telaforrocotizado`, `total_telaforrocompra`, `dif_und_telaforro`, `dif_total_telaforro`, `consumo_forround`, `consumo_forrototal`, `dif_consumoforro_und`, `dif_consumoforro_total`, `consumo_totalcuello`, `precio_cuellocompra`, `total_cuellocotizado`, `total_cuellocompra`, `dif_und_cuello`, `dif_total_cuello`, `consumo_totaldeslizador`, `precio_deslizadorcompra`, `total_deslizadorcotizado`, `total_deslizadorcompra`, `dif_und_deslizador`, `dif_total_deslizador`, `consumo_totalfajon_cintura`, `precio_fajon_cinturacompra`, `total_fajon_cinturacotizado`, `total_fajon_cinturacompra`, `dif_und_fajon_cintura`, `dif_total_fajon_cintura`, `consumo_totalpuño`, `precio_puñocompra`, `total_puñocotizado`, `total_puñocompra`, `dif_und_puño`, `dif_total_puño`, `consumo_totalboton`, `precio_botoncompra`, `total_botoncotizado`, `total_botoncompra`, `dif_und_boton`, `dif_total_boton`, `consumo_totalboton2`, `precio_boton2compra`, `total_boton2cotizado`, `total_boton2compra`, `dif_und_boton2`, `dif_total_boton2`, `consumo_totalentretela`, `precio_entretelacompra`, `total_entretelacotizado`, `total_entretelacompra`, `dif_und_entretela`, `dif_total_entretela`, `consumo_totalentretela2`, `precio_entretela2compra`, `total_entretela2cotizado`, `total_entretela2compra`, `dif_und_entretela2`, `dif_total_entretela2`, `consumo_entretela2und`, `consumo_entretela2total`, `dif_consentretela2_und`, `dif_consentretela2_total`, `consumo_entretelaund`, `consumo_entretelatotal`, `dif_consentretela_und`, `dif_consentretela_total`, `consumo_totalcremallera`, `precio_cremalleracompra`, `total_cremalleracotizado`, `total_cremalleracompra`, `dif_und_cremallera`, `dif_total_cremallera`, `consumo_totalcremallera2`, `precio_cremallera2compra`, `total_cremallera2cotizado`, `total_cremallera2compra`, `dif_und_cremallera2`, `dif_total_cremallera2`, `consumo_totalvelcro`, `precio_velcrocompra`, `total_velcrocotizado`, `total_velcrocompra`, `dif_und_velcro`, `dif_total_velcro`, `consumo_totalresorte`, `precio_resortecompra`, `total_resortecotizado`, `total_resortecompra`, `dif_und_resorte`, `dif_total_resorte`, `consumo_totalresorte2`, `precio_resorte2compra`, `total_resorte2cotizado`, `total_resorte2compra`, `dif_und_resorte2`, `dif_total_resorte2`, `consumo_totalhombrera`, `precio_hombreracompra`, `total_hombreracotizado`, `total_hombreracompra`, `dif_und_hombrera`, `dif_total_hombrera`, `consumo_totalsesgo`, `precio_sesgocompra`, `total_sesgocotizado`, `total_sesgocompra`, `dif_und_sesgo`, `dif_total_sesgo`, `consumo_totaltrabilla`, `precio_trabillacompra`, `total_trabillacotizado`, `total_trabillacompra`, `dif_und_trabilla`, `dif_total_trabilla`, `consumo_totalvivo`, `precio_vivocompra`, `total_vivocotizado`, `total_vivocompra`, `dif_und_vivo`, `dif_total_vivo`, `consumo_totalcinta`, `precio_cintacompra`, `total_cintacotizado`, `total_cintacompra`, `dif_und_cinta`, `dif_total_cinta`, `consumo_totalfaya`, `precio_fayacompra`, `total_fayacotizado`, `total_fayacompra`, `dif_und_faya`, `dif_total_faya`, `consumo_totalguata`, `precio_guatacompra`, `total_guatacotizado`, `total_guatacompra`, `dif_und_guata`, `dif_total_guata`, `consumo_totalhiladilla`, `precio_hiladillacompra`, `total_hiladillacotizado`, `total_hiladillacompra`, `dif_und_hiladilla`, `dif_total_hiladilla`, `consumo_totalpretina`, `precio_pretinacompra`, `total_pretinacotizado`, `total_pretinacompra`, `dif_und_pretina`, `dif_total_pretina`, `consumo_totalbroche`, `precio_brochecompra`, `total_brochecotizado`, `total_brochecompra`, `dif_und_broche`, `dif_total_broche`, `consumo_totalcordon`, `precio_cordoncompra`, `total_cordoncotizado`, `total_cordoncompra`, `dif_und_cordon`, `dif_total_cordon`, `consumo_totalpuntera`, `precio_punteracompra`, `total_punteracotizado`, `total_punteracompra`, `dif_und_puntera`, `dif_total_puntera`, `consumo_totalplumilla`, `precio_plumillacompra`, `total_plumillacotizado`, `total_plumillacompra`, `dif_und_plumilla`, `dif_total_plumilla`, `consumo_totalvinilo`, `precio_vinilocompra`, `total_vinilocotizado`, `total_vinilocompra`, `dif_und_vinilo`, `dif_total_vinilo`, `consumo_totalmarquilla`, `precio_marquillacompra`, `total_marquillacotizado`, `total_marquillacompra`, `dif_und_marquilla`, `dif_total_marquilla`, `consumo_totalbolsa`, `precio_bolsacompra`, `total_bolsacotizado`, `total_bolsacompra`, `dif_und_bolsa`, `dif_total_bolsa`, `prendas_comprar`, `precio_prendacompra`, `total_prendacotizado`, `total_prendacompra`, `dif_und_prenda`, `dif_total_prenda`, `orden_compratela`, `orden_compratelacombi`, `orden_compratelaforro`, `orden_compraentretela`, `orden_compracuello`, `orden_comprapuño`, `orden_compravelcro`, `orden_comprahombrera`, `orden_comprasesgo`, `orden_compratrabilla`, `orden_compravivo`, `orden_compraguata`, `orden_comprapretina`, `orden_comprabroche`, `orden_compracordon`, `orden_comprapuntera`, `orden_compraplumilla`, `orden_compravinilo`, `orden_compraboton`, `orden_compraboton2`, `orden_compracremallera`, `orden_compracremallera2`, `orden_compraresorte`, `orden_compraresorte2`, `orden_compracinta`, `orden_comprafaya`, `orden_compramarquilla`, `orden_comprabolsa`, `orden_compraprenda`, `orden_compradeslizador`, `orden_compraentretela2`, `orden_comprafajon_cintura`, `orden_comprahiladilla`) VALUES
(107, 2391, 150, 4250130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 120, 981842, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 147000, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 1400, 36400, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 75, 31800, NULL, NULL, NULL, NULL, 160, 31504, 700, 80000, 20.8, -7920, 1.2, 300, 0.5, -130, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 2393, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 147000, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 100, 80000, NULL, NULL, NULL, NULL, 1400, 36400, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 75, 31800, 350, 38000, 27.36, -264, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.8, 90, 0.09, -1, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0x5265732e303436206c61626f7220536f6369616c204761626f20677261646f203130c2b02e706466, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 2394, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 147000, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 100, 80000, NULL, NULL, NULL, NULL, 1400, 36400, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 75, 31800, 320, 31500, -2, 300, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.8, 110, -0.05, -35, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 2392, 240, 1707550, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 400, 1120000, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 200, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(20) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nit` int(11) NOT NULL,
  `consecutivo` varchar(30) DEFAULT NULL,
  `codficha_tecnica` varchar(30) DEFAULT NULL,
  `titulo_pedido` varchar(300) DEFAULT NULL,
  `fecha_pedido` datetime DEFAULT NULL,
  `fecha_entrega_muestra` date DEFAULT NULL,
  `fecha_entrega_cotizacion` date DEFAULT NULL,
  `fecha_produccion` datetime DEFAULT NULL,
  `fecha_envio_compra` datetime DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `total_factura` float DEFAULT NULL,
  `prendas_realizar` int(11) DEFAULT NULL,
  `valor_anticipo` float DEFAULT NULL,
  `plazo_pago` date DEFAULT NULL,
  `fecha_entrega1` date DEFAULT NULL,
  `fecha_entrega2` date DEFAULT NULL,
  `fecha_entrega3` date DEFAULT NULL,
  `listado_empleados` longblob DEFAULT NULL,
  `orden_compra` longblob DEFAULT NULL,
  `orden_compra_interno` longblob NOT NULL,
  `id_entrega` int(11) NOT NULL,
  `observaciones_pedido` varchar(1000) NOT NULL,
  `observaciones_logos` varchar(1000) NOT NULL,
  `logo1P` longblob NOT NULL,
  `logo2P` longblob NOT NULL,
  `logo3P` longblob NOT NULL,
  `logo4P` longblob NOT NULL,
  `estado` enum('Solicitud','Espera','Confirmado','Activo','Pedido','Inactivo','Pausado') DEFAULT NULL,
  `id_anticipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_usuario`, `nit`, `consecutivo`, `codficha_tecnica`, `titulo_pedido`, `fecha_pedido`, `fecha_entrega_muestra`, `fecha_entrega_cotizacion`, `fecha_produccion`, `fecha_envio_compra`, `fecha_entrega`, `total_factura`, `prendas_realizar`, `valor_anticipo`, `plazo_pago`, `fecha_entrega1`, `fecha_entrega2`, `fecha_entrega3`, `listado_empleados`, `orden_compra`, `orden_compra_interno`, `id_entrega`, `observaciones_pedido`, `observaciones_logos`, `logo1P`, `logo2P`, `logo3P`, `logo4P`, `estado`, `id_anticipo`) VALUES
(553, 1, 24, '01111', NULL, 'ejemplo ', '2026-05-20 17:21:53', NULL, '2026-05-29', NULL, NULL, NULL, 28325000, 300, NULL, NULL, NULL, NULL, NULL, 0x32303236303532333136353130375f36613131626564623035666535202836292e646f6378, NULL, '', 1, '', '', '', '', '', '', 'Activo', NULL),
(554, 1, 24, '01112', NULL, 'ejemplo 2', '2026-05-21 08:32:13', NULL, '2026-05-30', NULL, NULL, NULL, 9448680, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '', '', '', 'Pedido', NULL),
(555, 1, 24, 'ejem-0001', NULL, 'ejemplo con nueva logica', '2026-05-22 10:55:25', NULL, '2026-06-06', NULL, NULL, NULL, 41707500, 350, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 2, '', '', '', '', '', '', 'Confirmado', NULL),
(556, 1, 24, NULL, NULL, 'este es otro ejemplo mas', '2026-05-23 22:00:35', NULL, '2026-05-29', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '', '', '', '', '', '', 'Espera', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plumilla`
--

CREATE TABLE `plumilla` (
  `id_plumilla` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plumilla`
--

INSERT INTO `plumilla` (`id_plumilla`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, NULL, 0, 0, 17),
(1, 'Plumilla', 'und', 50, '0000-00-00', 0, 10, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prenda`
--

CREATE TABLE `prenda` (
  `id_prenda` int(11) NOT NULL,
  `nombre_prenda` varchar(100) DEFAULT NULL,
  `id_tipo_prenda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `prenda`
--

INSERT INTO `prenda` (`id_prenda`, `nombre_prenda`, `id_tipo_prenda`) VALUES
(0, 'Prenda Comprada a Externos', 0),
(1, 'Blazer Hombre', 1),
(2, 'Camisa Ejecutiva MC', 1),
(3, 'Camisa Ejecutiva ML', 1),
(4, 'Camisa Mc Antifluido ', 1),
(5, 'Camisa Tipo Soldador ML', 1),
(6, 'Camiseta Polo Manga Corta ', 1),
(7, 'Camiseta Polo Manga Larga ', 1),
(8, 'Chaleco Drill', 1),
(9, 'Camisa Chef ', 1),
(10, 'Tshirt MC  ', 1),
(11, 'Tshirt ML ', 1),
(12, 'Blazer Dama', 2),
(13, 'Blusa Antifluido MC ', 2),
(14, 'Blusa C/Neru Azul M/3-4 ', 2),
(15, 'Blusa Camisera MC', 2),
(16, 'Blusa Camisera ML', 2),
(17, 'Blusa Materna Cuello Neru ', 2),
(18, 'Camisa Tipo Soldador ML', 2),
(19, 'Camiseta Polo Manga Corta ', 2),
(20, 'Camiseta Polo Manga Larga ', 2),
(21, 'Chaleco Drill', 2),
(22, 'Chaqueta Chef ', 2),
(23, 'Tshirt MC  ', 2),
(24, 'Tshirt ML ', 2),
(25, 'Jean Caballero ', 3),
(26, 'Pantalón Camuflado Hombre', 3),
(27, 'Pantalón Clásico Hombre ', 3),
(28, 'Pantalón Drill Administrativo Hombre', 3),
(29, 'Pantalón Drill Operativo Hombre', 3),
(30, 'Pantalón Jean Cinta Hombre', 3),
(31, 'Pantalóneta Hombre ', 3),
(32, 'Sudadera Antifluido Bolsillos Camuflados Hombre', 3),
(33, 'Sudadera Antifluido Hombre', 3),
(34, 'Falda ', 4),
(35, 'Jean Dama ', 4),
(36, 'Pantalón Camuflado Dama', 4),
(37, 'Pantalón Clásico Dama ', 4),
(38, 'Pantalón Drill Administrativo Dama', 4),
(39, 'Pantalón Drill Operativo Dama', 4),
(40, 'Pantalón Jean Cinta Dama', 4),
(41, 'Sudadera Antifluido Bolsillos Camuflados Dama', 4),
(42, 'Sudadera Antifluido Dama', 4),
(43, 'Buzo Con Capota', 5),
(44, 'Camibuso Perchado ', 5),
(45, 'Chaleco Abollonado', 5),
(46, 'Chaqueta Con Capota ', 5),
(47, 'Chaqueta Sin Capota ', 5),
(48, 'Overol Dril Manga Corta ', 6),
(49, 'Overol Dril Manga Larga ', 6),
(50, 'Bata Manga Corta Hombre', 1),
(51, 'Bata Manga Larga Hombre', 1),
(52, 'Cofia Nase Combinado Dama ', 7),
(53, 'Cofia Nase Combinado Hombre ', 7),
(54, 'Cofia Normal', 7),
(55, 'Delantal Cintura', 7),
(56, 'Delantal Tipo Peto ', 7),
(57, 'Gorra Antifluido Beatriz Cartago ', 7),
(58, 'Gorra Beisbolera ', 7),
(59, 'Gorra Pava ', 7),
(60, 'Gorra Pava Con Capa', 7),
(61, 'Gorra Tipo Chavo ', 7),
(62, 'Gorra Tipo Monja ', 7),
(63, 'Gorra Visera Playera Y Tapanuca ', 7),
(64, 'Mangas ', 7),
(65, 'Pijama Térmica Cercafe Ancho ', 7),
(66, 'Tapabocas ', 7),
(67, 'Tulas ', 7),
(68, 'Camisa Operativa', 1),
(69, 'Blusa Operativa', 2),
(70, 'Camisa Tipo Zafarí Hombre', 1),
(71, 'Camisa Tipo Zafarí Dama', 2),
(72, 'Conjunto Antifluido', 7),
(73, 'Pantalón Materno', 4),
(74, 'Chaqueta Antifluido', 5),
(75, 'CAMISA DRILL MANGA LARGA', 1),
(76, 'CAMISA DRILL MANGA CORTA', 1),
(77, 'BLUSA MANGA 34', 2),
(78, 'BLUSA MC 3/4', 2),
(79, 'BLUSA MANGA CORTA', 2),
(80, 'PANTALON DRILL', 4),
(81, 'DELANTAL CUELLO', 7),
(82, 'Chaleco Sencillo', 1),
(83, 'Bata Manga Corta Dama', 2),
(84, 'Bata Manga Larga Dama', 2),
(85, 'BLUSA MATERNA', 2),
(86, 'Conjunto antifluido chef', 7),
(87, 'chaleco camuflado', 5),
(88, 'PAÑOLETA', 7),
(89, 'sudadera', 3),
(90, 'gorra', 7),
(91, 'Delantal', 7),
(92, 'Overol Antifluido ML', 6),
(93, 'Camisa soldador Reflectivo', 1),
(94, 'Cofia Astronauta', 7),
(95, 'Camisa M/L Operativa', 2),
(96, 'Camisa M/L Operativa', 1),
(97, 'Chaleco Antifluido', 5),
(98, 'Overol Dieléctrico manga larga', 6),
(99, 'CORBATA', 7),
(100, 'CORBATIN', 7),
(101, 'Overol', 6),
(102, 'GORRO', 7),
(103, 'GORRO VIGILANTE', 7),
(104, 'CAMISA CHEF DAMA', 2),
(105, 'CAMISA CHEF DAMA', 2),
(106, 'PANTALON DRIL OPERATIVO', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prenda_comprada`
--

CREATE TABLE `prenda_comprada` (
  `id_prendacomprada` int(11) NOT NULL,
  `nombre_producto` varchar(100) DEFAULT NULL,
  `precio_compra` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prenda_comprada`
--

INSERT INTO `prenda_comprada` (`id_prendacomprada`, `nombre_producto`, `precio_compra`, `fecha_actualizacion`, `id_proveedor`) VALUES
(0, 'No Aplica', 0, '0000-00-00', 0),
(1, 'Bota Blanca', 83163, '2026-02-26', 46),
(2, 'Bota Café ', 101357, '2026-02-26', 46),
(3, 'Bota Hemat Toda Negra ', 46746, '2026-02-26', 43),
(4, 'Bota Heros Rojo Negro ', 53891, '2026-02-26', 43),
(5, 'Bota Soldador', 177402, '2026-02-26', 46),
(6, 'Botas Soldador Talla 35/46', 83000, '2026-02-26', 44),
(7, 'Botas Soldador Talla 46 En Adelante', 85000, '2026-02-26', 44),
(8, 'Camiseta MC Blanco Cuello Redondo Y Colores Talla S/Xl 100% Alg', 11260, '2026-02-26', 41),
(9, 'Camiseta MC Blanco Cuello Redondo Y Colores Talla Xxl 100% Alg ', 14873, '2026-02-26', 41),
(10, 'Camiseta ML Blanco Cuello Redondo Y Colores Talla S/Xl Sin Rib 100% Alg', 16218, '2026-02-26', 41),
(11, 'Camiseta ML Blanco Cuello Redondo Y Colores Talla Xxl Sin Rib 100% Alg', 21218, '2026-02-26', 41),
(12, 'Gorra Beisbolera', 6000, '2026-02-26', 47),
(13, 'Gorra Tipo Chavo ', 9500, '2026-02-26', 47),
(14, 'Impermeables Tallas 2XL', 88324, '2026-02-26', 45),
(15, 'Impermeables Tallas S/XL', 69850, '2026-02-26', 45),
(16, 'Jean Dot Caballero Rigido Talla 26/36 Ref 038', 29748, '2026-02-26', 48),
(17, 'Jean Dot Caballero Rigido Talla 28/34 Ref 3004', 25210, '2026-02-26', 42),
(18, 'Jean Dot Caballero Rigido Talla 36/42 Ref 3004', 26890, '2026-02-26', 42),
(19, 'Jean Dot Caballero Rigido Talla 38/42 Ref 039', 32748, '2026-02-26', 48),
(20, 'Jean Dot Caballero Rigido Talla 44/46 Ref 038', 35748, '2026-02-26', 48),
(21, 'Jean Dot Caballero Spandex Talla 28/34 Ref 3005', 27731, '2026-02-26', 42),
(22, 'Jean Dot Caballero Spandex Talla 36/40 Ref 3005', 28571, '2026-02-26', 42),
(23, 'Jean Dot Dama Negro Talla 06/14 Ref 5668', 35210, '2026-02-26', 48),
(24, 'Jean Dot Dama Negro Talla 16/22 Ref 5669', 38571, '2026-02-26', 48),
(25, 'Jean Dot Dama Talla 16/22 Ref 1400', 27731, '2026-02-26', 42),
(26, 'Jean Dot Dama Talla 16/22 Ref 5591', 33924, '2026-02-26', 48),
(27, 'Jean Dot Dama Talla 24/26 Ref 5566', 36445, '2026-02-26', 48),
(28, 'Jean Dot Dama Talla 6/14 Ref 5590', 30403, '2026-02-26', 48),
(29, 'Jean Dot H Negro Talla 26/36 Ref 149', 35294, '2026-02-26', 48),
(30, 'Jean Dot H Negro Talla 38/42 Ref 152', 38655, '2026-02-26', 48),
(31, 'Jean Dot H Strech Tall 26/36 Ref 048', 31849, '2026-02-26', 48),
(32, 'Jean Dot H Strech Tall 38/42 Ref 049', 34849, '2026-02-26', 48),
(33, 'Jean Dot H Strech Tall 44/46 Ref 050', 37849, '2026-02-26', 48),
(34, 'Polo MC Adulto Blanco 65% Pol 35% Alg 2XL', 23928, '2026-02-26', 40),
(35, 'Polo MC Adulto Blanco 65% Pol 35% Alg 3XL', 26428, '2026-02-26', 40),
(36, 'Polo MC Adulto Blanco 65% Pol 35% Alg S/XL', 21428, '2026-02-26', 40),
(37, 'Polo MC Adulto Colores 65% Pol 35% Alg Talla 2XL', 24769, '2026-02-26', 40),
(38, 'Polo MC Adulto Colores 65% Pol 35% Alg Talla 3XL', 27269, '2026-02-26', 40),
(39, 'Polo MC Adulto Colores 65% Pol 35% Alg Talla S/XL', 22269, '2026-02-26', 40),
(40, 'Polo MC Blanco Colores Talla S/Xl 100% Alg', 26806, '2026-02-26', 41),
(41, 'Polo MC Blanco Colores Talla Xxl 100% Alg', 30168, '2026-02-26', 41),
(42, 'Polo ML Adulto Blanco 65% Pol 35% Alg 2XL', 26870, '2026-02-26', 40),
(43, 'Polo ML Adulto Blanco 65% Pol 35% Alg 3XL', 29370, '2026-02-26', 40),
(44, 'Polo ML Adulto Blanco 65% Pol 35% Alg S/XL', 24370, '2026-02-26', 40),
(45, 'Polo ML Adulto Colores 65% Pol 35% Alg Talla 2XL', 27710, '2026-02-26', 40),
(46, 'Polo ML Adulto Colores 65% Pol 35% Alg Talla 3XL ', 30210, '2026-02-26', 40),
(47, 'Polo ML Adulto Colores 65% Pol 35% Alg Talla S/XL', 25210, '2026-02-26', 40),
(48, 'T-Hirt Manga Corta Blanco 65% Pol 35% Alg Tallas 2XL', 15945, '2026-02-26', 40),
(49, 'T-Hirt Manga Corta Blanco 65% Pol 35% Alg Tallas 3XL', 18445, '2026-02-26', 40),
(50, 'T-Hirt Manga Corta Blanco 65% Pol 35% Alg Tallas S/XL', 13445, '2026-02-26', 40),
(51, 'T-Hirt Manga Corta Colores 65% Pol 35% Alg Talla 2XL', 16786, '2026-02-26', 40),
(52, 'T-Hirt Manga Corta Colores 65% Pol 35% Alg Talla 3XL', 19286, '2026-02-26', 40),
(53, 'T-Hirt Manga Corta Colores 65% Pol 35% Alg Talla S/XL', 14286, '2026-02-26', 40),
(54, 'T-Hirt Manga Larga Blanca Con Rib Cuello Y Puño 65% Pol 35% Alg Talla 2XL', 18466, '2026-02-26', 40),
(55, 'T-Hirt Manga Larga Blanca Con Rib Cuello Y Puño 65% Pol 35% Alg Talla 3XL', 20966, '2026-02-26', 40),
(56, 'T-Hirt Manga Larga Blanca Con Rib Cuello Y Puño 65% Pol 35% Alg Talla S/XL', 15966, '2026-02-26', 40),
(57, 'T-Hirt Manga Larga Colores Con Rib Cuello Y Puño 65% Pol 35% Alg Talla 2XL', 19306, '2026-02-26', 40),
(58, 'T-Hirt Manga Larga Colores Con Rib Cuello Y Puño 65% Pol 35% Alg Talla 3XL', 21806, '2026-02-26', 40),
(59, 'T-Hirt Manga Larga Colores Con Rib Cuello Y Puño 65% Pol 35% Alg Talla S/XL', 16806, '2026-02-26', 40),
(61, 'Pañoleta', 4000, '2026-03-20', 0),
(62, 'Pava cañera azul oscuro tipo chavo ', 7000, '2026-04-18', 49);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pretina`
--

CREATE TABLE `pretina` (
  `id_pretina` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pretina`
--

INSERT INTO `pretina` (`id_pretina`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, NULL, 0, 0, 18),
(1, 'Pretina Industrial ', 'metro', 1500, '2026-04-18', 0, 11, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_pedido` int(20) NOT NULL,
  `num_ficha` varchar(100) DEFAULT NULL,
  `num_orden_compra` varchar(100) DEFAULT NULL,
  `nombre_producto` varchar(300) DEFAULT NULL,
  `id_prenda` int(11) DEFAULT NULL,
  `id_prendacomprada` int(11) DEFAULT NULL,
  `promedio_consumo` float DEFAULT NULL,
  `id_tipo_producto` int(11) DEFAULT NULL,
  `cant_prendas` int(11) DEFAULT NULL,
  `mas_prendas` int(11) DEFAULT NULL,
  `suma_prendas` int(11) DEFAULT NULL,
  `cant_tallas` int(11) DEFAULT NULL,
  `id_tela` int(11) DEFAULT NULL,
  `precio_tela` float DEFAULT NULL,
  `valor_tela` float DEFAULT NULL,
  `id_telacombi` int(11) DEFAULT NULL,
  `precio_telacombinada` float DEFAULT NULL,
  `promedio_telacombi` float DEFAULT NULL,
  `valor_telacombi` float DEFAULT NULL,
  `id_telaforro` int(11) DEFAULT NULL,
  `precio_forro` float DEFAULT NULL,
  `promedio_forro` float DEFAULT NULL,
  `valor_forro` float DEFAULT NULL,
  `consumo_telas` float DEFAULT NULL,
  `id_cuello` int(11) DEFAULT NULL,
  `precio_cuello` float DEFAULT NULL,
  `consumo_cuello` float DEFAULT NULL,
  `valor_cuello` float DEFAULT NULL,
  `id_puño` int(11) DEFAULT NULL,
  `precio_puño` float DEFAULT NULL,
  `consumo_puño` float DEFAULT NULL,
  `valor_puño` float DEFAULT NULL,
  `id_boton` int(11) DEFAULT NULL,
  `precio_boton` float DEFAULT NULL,
  `cant_boton` float DEFAULT NULL,
  `valor_boton` float DEFAULT NULL,
  `id_boton2` int(11) DEFAULT NULL,
  `precio_boton2` float DEFAULT NULL,
  `cant_boton2` float DEFAULT NULL,
  `valor_boton2` float DEFAULT NULL,
  `id_cinta` int(11) DEFAULT NULL,
  `precio_cinta` float DEFAULT NULL,
  `cant_cinta` float DEFAULT NULL,
  `valor_cinta` float DEFAULT NULL,
  `id_marquilla` int(11) DEFAULT NULL,
  `id_bolsa` int(11) DEFAULT NULL,
  `id_cremallera` int(11) DEFAULT NULL,
  `precio_cremallera` float DEFAULT NULL,
  `cant_cremallera` float DEFAULT NULL,
  `valor_cremallera` float DEFAULT NULL,
  `id_cremallera2` int(11) DEFAULT NULL,
  `precio_cremallera2` float DEFAULT NULL,
  `cant_cremallera2` float DEFAULT NULL,
  `valor_cremallera2` float DEFAULT NULL,
  `id_deslizador` int(11) DEFAULT NULL,
  `precio_deslizador` float DEFAULT NULL,
  `cant_deslizador` float DEFAULT NULL,
  `valor_deslizador` float DEFAULT NULL,
  `id_entretela` int(11) DEFAULT NULL,
  `precio_entretela` float DEFAULT NULL,
  `cant_entretela` float DEFAULT NULL,
  `valor_entretela` float DEFAULT NULL,
  `id_entretela2` int(11) DEFAULT NULL,
  `precio_entretela2` float DEFAULT NULL,
  `cant_entretela2` float DEFAULT NULL,
  `valor_entretela2` float DEFAULT NULL,
  `id_fusionado` int(11) DEFAULT NULL,
  `precio_fusionado` float DEFAULT NULL,
  `consumo_fusionado` float DEFAULT NULL,
  `valor_fusionado` float DEFAULT NULL,
  `id_acabado` int(11) DEFAULT NULL,
  `id_velcro` int(11) DEFAULT NULL,
  `precio_velcro` float DEFAULT NULL,
  `cant_velcro` float DEFAULT NULL,
  `valor_velcro` float DEFAULT NULL,
  `id_resorte` int(11) DEFAULT NULL,
  `precio_resorte` float DEFAULT NULL,
  `cant_resorte` float DEFAULT NULL,
  `valor_resorte` float DEFAULT NULL,
  `id_resorte2` int(11) DEFAULT NULL,
  `precio_resorte2` float DEFAULT NULL,
  `cant_resorte2` float DEFAULT NULL,
  `valor_resorte2` float DEFAULT NULL,
  `id_hombrera` int(11) DEFAULT NULL,
  `precio_hombrera` float DEFAULT NULL,
  `cant_hombrera` float DEFAULT NULL,
  `valor_hombrera` float DEFAULT NULL,
  `id_sesgo` int(11) DEFAULT NULL,
  `precio_sesgo` float DEFAULT NULL,
  `cant_sesgo` float DEFAULT NULL,
  `valor_sesgo` float DEFAULT NULL,
  `id_trabilla` int(11) DEFAULT NULL,
  `precio_trabilla` float DEFAULT NULL,
  `cant_trabilla` float DEFAULT NULL,
  `valor_trabilla` float DEFAULT NULL,
  `id_vivo` int(11) DEFAULT NULL,
  `precio_vivo` float DEFAULT NULL,
  `cant_vivo` float DEFAULT NULL,
  `valor_vivo` float DEFAULT NULL,
  `id_faya` int(11) DEFAULT NULL,
  `precio_faya` float DEFAULT NULL,
  `cant_faya` float DEFAULT NULL,
  `valor_faya` float DEFAULT NULL,
  `id_guata` int(11) DEFAULT NULL,
  `precio_guata` float DEFAULT NULL,
  `cant_guata` float DEFAULT NULL,
  `valor_guata` float DEFAULT NULL,
  `id_pretina` int(11) DEFAULT NULL,
  `precio_pretina` int(11) DEFAULT NULL,
  `cant_pretina` float DEFAULT NULL,
  `valor_pretina` float DEFAULT NULL,
  `id_broche` int(11) DEFAULT NULL,
  `precio_broche` float DEFAULT NULL,
  `cant_broche` float DEFAULT NULL,
  `valor_broche` float DEFAULT NULL,
  `id_cordon` int(11) DEFAULT NULL,
  `precio_cordon` float DEFAULT NULL,
  `cant_cordon` float DEFAULT NULL,
  `valor_cordon` float DEFAULT NULL,
  `id_puntera` int(11) DEFAULT NULL,
  `precio_puntera` float DEFAULT NULL,
  `cant_puntera` float DEFAULT NULL,
  `valor_puntera` float DEFAULT NULL,
  `id_hiladilla` int(11) DEFAULT NULL,
  `precio_hiladilla` float DEFAULT NULL,
  `cant_hiladilla` float DEFAULT NULL,
  `valor_hiladilla` float DEFAULT NULL,
  `id_plumilla` int(11) DEFAULT NULL,
  `precio_plumilla` float DEFAULT NULL,
  `cant_plumilla` float DEFAULT NULL,
  `valor_plumilla` float DEFAULT NULL,
  `id_vinilo` int(11) DEFAULT NULL,
  `precio_vinilo` float DEFAULT NULL,
  `cant_vinilo` float DEFAULT NULL,
  `valor_vinilo` float DEFAULT NULL,
  `id_fajon_cintura` int(11) DEFAULT NULL,
  `precio_fajon_cintura` float DEFAULT NULL,
  `cant_fajon_cintura` float DEFAULT NULL,
  `valor_fajon_cintura` float DEFAULT NULL,
  `precio_bordado` float DEFAULT NULL,
  `precio_estampado` float DEFAULT NULL,
  `id_mano_obra` int(11) DEFAULT NULL,
  `precio_obra` float DEFAULT NULL,
  `id_encarterada` int(11) DEFAULT NULL,
  `precio_encarterada` float DEFAULT NULL,
  `id_puesta` int(11) DEFAULT NULL,
  `precio_puesta` float DEFAULT NULL,
  `id_logistica` int(11) DEFAULT NULL,
  `precio_logistica` float DEFAULT NULL,
  `id_diseño` int(11) DEFAULT NULL,
  `valor_diseño` float DEFAULT NULL,
  `id_corte` int(11) DEFAULT NULL,
  `id_consumo` int(11) DEFAULT NULL,
  `valor_corte` float DEFAULT NULL,
  `id_entrega` int(11) DEFAULT NULL,
  `precio_entrega` float DEFAULT NULL,
  `valor_flete` float DEFAULT NULL,
  `costo_total` float DEFAULT NULL,
  `margen_bruto` float NOT NULL,
  `nombre_proveedor` varchar(300) DEFAULT NULL,
  `precio_compra` int(20) DEFAULT NULL,
  `precio_venta` float DEFAULT NULL,
  `valor_poliza` float DEFAULT NULL,
  `valor_porcentajeestampilla` float DEFAULT NULL,
  `porcentaje_estampilla` float DEFAULT NULL,
  `valor_estampilla` float DEFAULT NULL,
  `precio_iva` float DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `id_bolsillo` int(11) DEFAULT NULL,
  `cant_bolsillos` varchar(50) DEFAULT NULL,
  `precio_bolsillo` float DEFAULT NULL,
  `id_bolsillocombinado` int(11) DEFAULT NULL,
  `cant_bolsilloscombinado` varchar(50) DEFAULT NULL,
  `precio_bolsillocombinado` float DEFAULT NULL,
  `id_bolsillocombinado2` int(11) DEFAULT NULL,
  `cant_bolsilloscombinado2` varchar(50) DEFAULT NULL,
  `precio_bolsillocombinado2` float DEFAULT NULL,
  `id_tablon` int(11) DEFAULT NULL,
  `id_muestra` int(11) DEFAULT NULL,
  `telaa` varchar(300) DEFAULT NULL,
  `telacombinada` varchar(300) DEFAULT NULL,
  `telaforro` varchar(300) DEFAULT NULL,
  `frentes` varchar(300) DEFAULT NULL,
  `espalda` varchar(300) DEFAULT NULL,
  `mangas` varchar(300) DEFAULT NULL,
  `cuello` varchar(300) DEFAULT NULL,
  `puño` varchar(300) DEFAULT NULL,
  `delanteros` varchar(300) DEFAULT NULL,
  `traseros` varchar(300) DEFAULT NULL,
  `pretina` varchar(300) DEFAULT NULL,
  `ensamble` varchar(300) DEFAULT NULL,
  `fajon` varchar(300) DEFAULT NULL,
  `forro` varchar(300) DEFAULT NULL,
  `logo` varchar(300) DEFAULT NULL,
  `id_tipo_logo` int(11) DEFAULT NULL,
  `cremallera` varchar(300) DEFAULT NULL,
  `boton` varchar(300) DEFAULT NULL,
  `ubica_combi` varchar(300) DEFAULT NULL,
  `ubica_reflectivos` varchar(300) DEFAULT NULL,
  `id_cartera` int(11) DEFAULT NULL,
  `obs_logo` varchar(300) DEFAULT NULL,
  `otros` varchar(300) DEFAULT NULL,
  `observaciones` varchar(3000) DEFAULT NULL,
  `observaciones_cotizacion` varchar(1000) DEFAULT NULL,
  `observaciones_comercial` varchar(1000) DEFAULT NULL,
  `observaciones_produccion` varchar(1000) DEFAULT NULL,
  `valor_agregado` varchar(300) DEFAULT NULL,
  `imagen` longblob DEFAULT NULL,
  `imagen2` longblob DEFAULT NULL,
  `imagen3` longblob DEFAULT NULL,
  `imagen4` longblob DEFAULT NULL,
  `logo1` longblob DEFAULT NULL,
  `logo2` longblob DEFAULT NULL,
  `logo3` longblob DEFAULT NULL,
  `logo4` longblob DEFAULT NULL,
  `color_tela` varchar(300) DEFAULT NULL,
  `color_telacombi` varchar(300) DEFAULT NULL,
  `color_telaforro` varchar(300) DEFAULT NULL,
  `id_lleva` int(11) DEFAULT NULL,
  `talla_XS` int(11) DEFAULT NULL,
  `talla_S` int(11) DEFAULT NULL,
  `talla_M` int(11) DEFAULT NULL,
  `talla_L` int(11) DEFAULT NULL,
  `talla_XL` int(11) DEFAULT NULL,
  `talla_2XL` int(11) DEFAULT NULL,
  `talla_3XL` int(11) DEFAULT NULL,
  `talla_4XL` int(11) DEFAULT NULL,
  `talla_5XL` int(11) DEFAULT NULL,
  `talla_6XL` int(11) DEFAULT NULL,
  `talla_2` int(11) DEFAULT NULL,
  `talla_4` int(11) DEFAULT NULL,
  `talla_6` int(11) DEFAULT NULL,
  `talla_8` int(11) DEFAULT NULL,
  `talla_10` int(11) DEFAULT NULL,
  `talla_12` int(11) DEFAULT NULL,
  `talla_14` int(11) DEFAULT NULL,
  `talla_16` int(11) DEFAULT NULL,
  `talla_18` int(11) DEFAULT NULL,
  `talla_20` int(11) DEFAULT NULL,
  `talla_22` int(11) DEFAULT NULL,
  `talla_24` int(11) DEFAULT NULL,
  `talla_26` int(11) DEFAULT NULL,
  `talla_28` int(11) DEFAULT NULL,
  `talla_30` int(11) DEFAULT NULL,
  `talla_32` int(11) DEFAULT NULL,
  `talla_34` int(11) DEFAULT NULL,
  `talla_36` int(11) DEFAULT NULL,
  `talla_38` int(11) DEFAULT NULL,
  `talla_40` int(11) DEFAULT NULL,
  `talla_42` int(11) DEFAULT NULL,
  `talla_44` int(11) DEFAULT NULL,
  `talla_46` int(11) DEFAULT NULL,
  `talla_48` int(11) DEFAULT NULL,
  `talla_especial` int(11) DEFAULT NULL,
  `precio_total` float DEFAULT NULL,
  `fecha_fichatecnica` datetime DEFAULT NULL,
  `fecha_produccion` datetime DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `fecha_finalizado` datetime DEFAULT NULL,
  `ficha_tecnica` longblob DEFAULT NULL,
  `estado` enum('Diseño','Compras','Produccion','Entregado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_pedido`, `num_ficha`, `num_orden_compra`, `nombre_producto`, `id_prenda`, `id_prendacomprada`, `promedio_consumo`, `id_tipo_producto`, `cant_prendas`, `mas_prendas`, `suma_prendas`, `cant_tallas`, `id_tela`, `precio_tela`, `valor_tela`, `id_telacombi`, `precio_telacombinada`, `promedio_telacombi`, `valor_telacombi`, `id_telaforro`, `precio_forro`, `promedio_forro`, `valor_forro`, `consumo_telas`, `id_cuello`, `precio_cuello`, `consumo_cuello`, `valor_cuello`, `id_puño`, `precio_puño`, `consumo_puño`, `valor_puño`, `id_boton`, `precio_boton`, `cant_boton`, `valor_boton`, `id_boton2`, `precio_boton2`, `cant_boton2`, `valor_boton2`, `id_cinta`, `precio_cinta`, `cant_cinta`, `valor_cinta`, `id_marquilla`, `id_bolsa`, `id_cremallera`, `precio_cremallera`, `cant_cremallera`, `valor_cremallera`, `id_cremallera2`, `precio_cremallera2`, `cant_cremallera2`, `valor_cremallera2`, `id_deslizador`, `precio_deslizador`, `cant_deslizador`, `valor_deslizador`, `id_entretela`, `precio_entretela`, `cant_entretela`, `valor_entretela`, `id_entretela2`, `precio_entretela2`, `cant_entretela2`, `valor_entretela2`, `id_fusionado`, `precio_fusionado`, `consumo_fusionado`, `valor_fusionado`, `id_acabado`, `id_velcro`, `precio_velcro`, `cant_velcro`, `valor_velcro`, `id_resorte`, `precio_resorte`, `cant_resorte`, `valor_resorte`, `id_resorte2`, `precio_resorte2`, `cant_resorte2`, `valor_resorte2`, `id_hombrera`, `precio_hombrera`, `cant_hombrera`, `valor_hombrera`, `id_sesgo`, `precio_sesgo`, `cant_sesgo`, `valor_sesgo`, `id_trabilla`, `precio_trabilla`, `cant_trabilla`, `valor_trabilla`, `id_vivo`, `precio_vivo`, `cant_vivo`, `valor_vivo`, `id_faya`, `precio_faya`, `cant_faya`, `valor_faya`, `id_guata`, `precio_guata`, `cant_guata`, `valor_guata`, `id_pretina`, `precio_pretina`, `cant_pretina`, `valor_pretina`, `id_broche`, `precio_broche`, `cant_broche`, `valor_broche`, `id_cordon`, `precio_cordon`, `cant_cordon`, `valor_cordon`, `id_puntera`, `precio_puntera`, `cant_puntera`, `valor_puntera`, `id_hiladilla`, `precio_hiladilla`, `cant_hiladilla`, `valor_hiladilla`, `id_plumilla`, `precio_plumilla`, `cant_plumilla`, `valor_plumilla`, `id_vinilo`, `precio_vinilo`, `cant_vinilo`, `valor_vinilo`, `id_fajon_cintura`, `precio_fajon_cintura`, `cant_fajon_cintura`, `valor_fajon_cintura`, `precio_bordado`, `precio_estampado`, `id_mano_obra`, `precio_obra`, `id_encarterada`, `precio_encarterada`, `id_puesta`, `precio_puesta`, `id_logistica`, `precio_logistica`, `id_diseño`, `valor_diseño`, `id_corte`, `id_consumo`, `valor_corte`, `id_entrega`, `precio_entrega`, `valor_flete`, `costo_total`, `margen_bruto`, `nombre_proveedor`, `precio_compra`, `precio_venta`, `valor_poliza`, `valor_porcentajeestampilla`, `porcentaje_estampilla`, `valor_estampilla`, `precio_iva`, `id_cargo`, `id_bolsillo`, `cant_bolsillos`, `precio_bolsillo`, `id_bolsillocombinado`, `cant_bolsilloscombinado`, `precio_bolsillocombinado`, `id_bolsillocombinado2`, `cant_bolsilloscombinado2`, `precio_bolsillocombinado2`, `id_tablon`, `id_muestra`, `telaa`, `telacombinada`, `telaforro`, `frentes`, `espalda`, `mangas`, `cuello`, `puño`, `delanteros`, `traseros`, `pretina`, `ensamble`, `fajon`, `forro`, `logo`, `id_tipo_logo`, `cremallera`, `boton`, `ubica_combi`, `ubica_reflectivos`, `id_cartera`, `obs_logo`, `otros`, `observaciones`, `observaciones_cotizacion`, `observaciones_comercial`, `observaciones_produccion`, `valor_agregado`, `imagen`, `imagen2`, `imagen3`, `imagen4`, `logo1`, `logo2`, `logo3`, `logo4`, `color_tela`, `color_telacombi`, `color_telaforro`, `id_lleva`, `talla_XS`, `talla_S`, `talla_M`, `talla_L`, `talla_XL`, `talla_2XL`, `talla_3XL`, `talla_4XL`, `talla_5XL`, `talla_6XL`, `talla_2`, `talla_4`, `talla_6`, `talla_8`, `talla_10`, `talla_12`, `talla_14`, `talla_16`, `talla_18`, `talla_20`, `talla_22`, `talla_24`, `talla_26`, `talla_28`, `talla_30`, `talla_32`, `talla_34`, `talla_36`, `talla_38`, `talla_40`, `talla_42`, `talla_44`, `talla_46`, `talla_48`, `talla_especial`, `precio_total`, `fecha_fichatecnica`, `fecha_produccion`, `fecha_entrega`, `fecha_finalizado`, `ficha_tecnica`, `estado`) VALUES
(2391, 553, '1', 'eje-1', NULL, 2, 0, 1.5, 1, 100, 0, 100, 2, 4, 28334.2, 42501.3, 19, 8182.02, 1.2, 9818.42, 0, 0, 0, 0, 2.7, 2, 1470, 1, 1470, 0, 0, 0, 0, 3, 26, 14, 364, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 424, 0.75, 318, 1, 196.9, 1.6, 315.04, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 0, 3, 14000, 1, 0, 1, 0, 1, 500, 0, 0, 5, 1, 507.39, 1, 0, 0, 72405, 0.6, NULL, NULL, 120675, 0, 0, 0, 0, 143603, 1, 0, '0', 0, 0, '0', 0, 0, '0', 0, 1, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 50, 0, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 14360300, '2026-05-20 17:51:23', NULL, '2026-07-03', NULL, NULL, 'Compras'),
(2392, 553, NULL, NULL, NULL, 46, 0, 1.2, 5, 200, 0, 200, 2, 2, 7114.8, 8537.76, 0, 0, 0, 0, 0, 0, 0, 0, 1.2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 2800, 2, 5600, 0, 0, 99, 12000, 0, 0, 1, 0, 1, 500, 0, 0, 1, 1, 8456.55, 1, 0, 0, 35205.1, 0.6, NULL, NULL, 58675.2, 0, 0, 0, 0, 69823.5, 1, 0, '0', 0, 0, '0', 0, 0, '0', 0, 1, NULL, NULL, NULL, NULL, 'este es un ejemplo', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'azul turquesa', '', '', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 13964700, NULL, NULL, NULL, NULL, NULL, NULL),
(2393, 554, '2', 'eje-2', NULL, 3, 0, 0, 1, 100, 0, 100, 2, 2, 7114.8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1470, 1, 1470, 3, 800, 1, 800, 3, 26, 14, 364, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 424, 0.75, 318, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 0, 8, 16500, 1, 0, 1, 0, 1, 500, 0, 0, 5, 1, 507.39, 1, 0, 0, 23070.2, 0.6, NULL, NULL, 38450.3, 0, 0, 0, 0, 45755.9, 1, 0, '0', 0, 0, '0', 0, 0, '0', 0, 1, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'azul turquesa', '', '', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 50, 0, 0, 0, 0, 0, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4575590, '2026-05-21 08:42:58', NULL, '2026-07-06', NULL, NULL, 'Diseño'),
(2394, 554, '3', 'eje-3', NULL, 3, 0, 0, 1, 100, 0, 100, 2, 2, 7114.8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1470, 1, 1470, 3, 800, 1, 800, 3, 26, 14, 364, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 424, 0.75, 318, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 0, 4, 18000, 1, 0, 1, 0, 1, 500, 0, 0, 5, 1, 507.39, 1, 0, 0, 24570.2, 0.6, NULL, NULL, 40950.3, 0, 0, 0, 0, 48730.9, 1, 0, '0', 0, 0, '0', 0, 0, '0', 0, 1, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', '', 1, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'azul turquesa', '', '', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 50, 0, 0, 0, 0, 0, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4873090, '2026-05-21 08:43:29', NULL, '2026-07-06', NULL, NULL, 'Diseño'),
(2397, 555, NULL, NULL, NULL, 3, 0, 1.7, 1, 100, 0, 100, 5, 3, 25747, 43769.9, 3, 25747, 1.5, 38620.5, 0, 0, 0, 0, 3.2, 2, 1470, 1, 1470, 3, 800, 1, 800, 3, 26, 14, 364, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 424, 0.75, 318, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 0, 4, 18000, 1, 0, 1, 0, 1, 500, 0, 0, 5, 1, 507.39, 2, 0, 0, 106961, 0.6, NULL, NULL, 178268, 0, 0, 0, 0, 212138, 1, 0, '0', 0, 0, '0', 0, 0, '0', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, '', NULL, '', NULL, '', 1, '', '', '', '', 1, NULL, NULL, '', '', '', '', '', 0x32303236303532333138323634345f366131316435343461663836352e77656270, 0x32303236303532333136353130375f366131316265646230353964612e77656270, '', '', 0x32303236303532333136353130375f366131316265646230356665352e646f6378, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21213800, NULL, NULL, NULL, NULL, NULL, NULL),
(2398, 555, NULL, NULL, NULL, 16, 0, 1.2, 2, 100, 0, 100, 2, 2, 7114.8, 8537.76, 0, 0, 0, 0, 0, 0, 0, 0, 1.2, 2, 1470, 1, 1470, 3, 800, 1, 800, 3, 26, 14, 364, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 424, 0.75, 318, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 0, 38, 14000, 1, 0, 1, 0, 1, 500, 0, 0, 3, 1, 1663.58, 2, 0, 0, 30264.1, 0.6, NULL, NULL, 50440.2, 0, 0, 0, 0, 60023.9, 1, 0, '0', 0, 0, '0', 0, 0, '0', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, '', NULL, '', NULL, '', 1, '', '', '', '', 1, NULL, NULL, '', '', '', '', '', 0x32303236303532333137343133355f366131316361616639303464322e706e67, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6002390, NULL, NULL, NULL, NULL, NULL, NULL),
(2399, 555, NULL, NULL, NULL, 0, 4, NULL, 8, 80, 0, 80, 2, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, 53891, 0.6, NULL, 53891, 89818.3, 0, 0, 0, 0, 106884, 1, 0, '', NULL, 0, '', NULL, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, '', NULL, '', NULL, '', 1, '', '', '', '', 0, NULL, NULL, '', '', '', '', '', 0x32303236303532333137353135315f366131316364313731373164642e61766966, '', '', '', 0x32303236303532333137353032395f366131316363633532303630612e706466, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8550700, NULL, NULL, NULL, NULL, NULL, NULL),
(2401, 555, NULL, NULL, NULL, 35, 0, 1.2, 4, 50, 0, 50, 2, 3, 25747, 30896.4, 0, 0, 0, 0, 1, 6975.74, 0.2, 1395.15, 1.4, 0, 0, 0, 0, 0, 0, 0, 0, 22, 132, 1, 132, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9, 2320, 2.3, 5336, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1500, 1, 1500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 86, 8400, 0, 0, 1, 0, 1, 500, 0, 0, 5, 1, 507.39, 2, 0, 0, 48777.7, 0.6, NULL, NULL, 81296.2, 0, 0, 0, 0, 96742.5, 1, 0, '0', 0, 0, '0', 0, 0, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, '', NULL, '', NULL, '', 1, '', '', '', '', 0, NULL, NULL, '', '', '', '', '', 0x32303236303532343034313835305f366131323630306165656436372e6a7067, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4837130, NULL, NULL, NULL, NULL, NULL, NULL),
(2403, 555, NULL, NULL, NULL, 47, 0, 2.3, 5, 20, 0, 20, 2, 1, 6975.74, 16044.2, 0, 0, 0, 0, 0, 0, 0, 0, 2.3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 3, 504, 1, 504, 0, 0, 0, 0, 2, 150, 1, 150, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 10000, 0, 0, 1, 0, 1, 500, 0, 0, 5, 1, 507.39, 2, 0, 0, 27816.4, 0.6, NULL, NULL, 46360.7, 0, 0, 0, 0, 55169.2, 1, 0, '0', 0, 0, '0', 0, 0, '0', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, '', NULL, '', NULL, '', 1, '', '', '', '', 1, NULL, NULL, '', '', '', '', '', 0x32303236303532333230313334315f366131316565353531376431622e6a706567, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1103380, NULL, NULL, NULL, NULL, NULL, NULL),
(2404, 556, NULL, NULL, NULL, 2, 0, NULL, 1, 200, NULL, NULL, 2, 1, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, '0', NULL, 0, '0', NULL, 0, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, '', NULL, '', NULL, '', 1, '', '', '', '', 1, NULL, NULL, '', NULL, NULL, NULL, '', 0x32303236303532343035313331345f366131323663636162616234662e77656270, '', '', '', '', '', '', '', 'Azul', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2406, 556, NULL, NULL, NULL, 68, 0, NULL, 1, 250, NULL, NULL, 5, 3, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, '0', NULL, 0, '0', NULL, 0, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, '', NULL, '', NULL, '', 1, '', '', '', '', 1, NULL, NULL, '', NULL, NULL, NULL, '', 0x32303236303532353232313430305f366131346164383837386466362e77656270, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `after_producto_delete` AFTER DELETE ON `producto` FOR EACH ROW BEGIN
    DECLARE total_pedido DECIMAL(10,2);
    
    -- Calcular la suma de precio_total para el mismo id_pedido
    SELECT COALESCE(SUM(precio_total), 0) INTO total_pedido
    FROM producto
    WHERE id_pedido = OLD.id_pedido;
    
    -- Actualizar el campo total_factura en la tabla pedido
    UPDATE pedido
    SET total_factura = total_pedido
    WHERE id_pedido = OLD.id_pedido;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_producto_update` AFTER UPDATE ON `producto` FOR EACH ROW BEGIN
    DECLARE total_pedido DECIMAL(10,2);
    
    -- Calcular la suma de precio_total para el mismo id_pedido
    SELECT SUM(precio_total) INTO total_pedido
    FROM producto
    WHERE id_pedido = NEW.id_pedido;
    
    -- Actualizar el campo total_factura en la tabla pedido
    UPDATE pedido
    SET total_factura = total_pedido
    WHERE id_pedido = NEW.id_pedido;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_productoprendas_delete` AFTER DELETE ON `producto` FOR EACH ROW BEGIN
    DECLARE total_prendas DECIMAL(10,2);
    
    -- Calcular la suma de suma_prendas para el mismo id_pedido
    SELECT COALESCE(SUM(suma_prendas), 0) INTO total_prendas
    FROM producto
    WHERE id_pedido = OLD.id_pedido;
    
    -- Actualizar el campo prendas_realizar en la tabla pedido
    UPDATE pedido
    SET prendas_realizar = total_prendas
    WHERE id_pedido = OLD.id_pedido;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_productoprendas_update` AFTER UPDATE ON `producto` FOR EACH ROW BEGIN
    DECLARE total_prendas DECIMAL(10,2);
    
    -- Calcular la suma de suma_prendas para el mismo id_pedido
    SELECT SUM(suma_prendas) INTO total_prendas
    FROM producto
    WHERE id_pedido = NEW.id_pedido;
    
    -- Actualizar el campo prendas_realizar en la tabla pedido
    UPDATE pedido
    SET prendas_realizar = total_prendas
    WHERE id_pedido = NEW.id_pedido;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto2`
--

CREATE TABLE `producto2` (
  `id_producto2` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_ordencompra` int(11) DEFAULT NULL,
  `id_tela2` int(11) DEFAULT NULL,
  `precio_tela2` float DEFAULT NULL,
  `promedio_consumo2` float DEFAULT NULL,
  `valor_tela2` float DEFAULT NULL,
  `consumo_tela2` float DEFAULT NULL,
  `precio_telacompra2` float DEFAULT NULL,
  `id_telacombi2` int(11) DEFAULT NULL,
  `precio_telacombi2` float DEFAULT NULL,
  `promedio_telacombi2` float DEFAULT NULL,
  `valor_telacombi2` float DEFAULT NULL,
  `consumo_totaltelacombi2` float DEFAULT NULL,
  `precio_telacombi2compra` float DEFAULT NULL,
  `id_telaforro2` int(11) DEFAULT NULL,
  `precio_forro2` float DEFAULT NULL,
  `promedio_forro2` float DEFAULT NULL,
  `valor_forro2` float DEFAULT NULL,
  `consumo_totaltelaforro2` float DEFAULT NULL,
  `precio_telaforro2compra` float DEFAULT NULL,
  `id_entretela22` int(11) DEFAULT NULL,
  `precio_entretela22` float DEFAULT NULL,
  `cant_entretela22` float DEFAULT NULL,
  `valor_entretela22` float DEFAULT NULL,
  `consumo_totalentretela22` float DEFAULT NULL,
  `precio_entretela22compra` float DEFAULT NULL,
  `id_entretela222` int(11) DEFAULT NULL,
  `precio_entretela222` float DEFAULT NULL,
  `cant_entretela222` float DEFAULT NULL,
  `valor_entretela222` float DEFAULT NULL,
  `consumo_totalentretela222` float DEFAULT NULL,
  `precio_entretela222compra` float DEFAULT NULL,
  `id_cuello2` int(11) DEFAULT NULL,
  `precio_cuello2` float DEFAULT NULL,
  `consumo_cuello2` float DEFAULT NULL,
  `valor_cuello2` float DEFAULT NULL,
  `consumo_totalcuello2` float DEFAULT NULL,
  `precio_cuello2compra` float DEFAULT NULL,
  `id_deslizador2` int(11) DEFAULT NULL,
  `precio_deslizador2` float DEFAULT NULL,
  `cant_deslizador2` float DEFAULT NULL,
  `valor_deslizador2` float DEFAULT NULL,
  `consumo_totaldeslizador2` float DEFAULT NULL,
  `precio_deslizador2compra` float DEFAULT NULL,
  `id_fajon_cintura2` int(11) DEFAULT NULL,
  `precio_fajon_cintura2` float DEFAULT NULL,
  `cant_fajon_cintura2` float DEFAULT NULL,
  `valor_fajon_cintura2` float DEFAULT NULL,
  `consumo_totalfajon_cintura2` float DEFAULT NULL,
  `precio_fajon_cintura2compra` float DEFAULT NULL,
  `id_puño2` int(11) DEFAULT NULL,
  `precio_puño2` float DEFAULT NULL,
  `consumo_puño2` float DEFAULT NULL,
  `valor_puño2` float DEFAULT NULL,
  `consumo_totalpuño2` float DEFAULT NULL,
  `precio_puño2compra` float DEFAULT NULL,
  `id_boton22` int(11) DEFAULT NULL,
  `precio_boton22` float DEFAULT NULL,
  `cant_boton22` float DEFAULT NULL,
  `valor_boton22` float DEFAULT NULL,
  `consumo_totalboton22` float DEFAULT NULL,
  `precio_boton22compra` float DEFAULT NULL,
  `id_boton222` int(11) DEFAULT NULL,
  `precio_boton222` float DEFAULT NULL,
  `cant_boton222` float DEFAULT NULL,
  `valor_boton222` float DEFAULT NULL,
  `consumo_totalboton222` float DEFAULT NULL,
  `precio_boton222compra` float DEFAULT NULL,
  `id_cremallera22` int(11) DEFAULT NULL,
  `precio_cremallera22` float DEFAULT NULL,
  `cant_cremallera22` float DEFAULT NULL,
  `valor_cremallera22` float DEFAULT NULL,
  `consumo_totalcremallera22` float DEFAULT NULL,
  `precio_cremallera22compra` float DEFAULT NULL,
  `id_cremallera222` int(11) DEFAULT NULL,
  `precio_cremallera222` float DEFAULT NULL,
  `cant_cremallera222` float DEFAULT NULL,
  `valor_cremallera222` float DEFAULT NULL,
  `consumo_totalcremallera222` float DEFAULT NULL,
  `precio_cremallera222compra` float DEFAULT NULL,
  `id_velcro2` int(11) DEFAULT NULL,
  `precio_velcro2` float DEFAULT NULL,
  `cant_velcro2` float DEFAULT NULL,
  `valor_velcro2` float DEFAULT NULL,
  `consumo_totalvelcro2` float DEFAULT NULL,
  `precio_velcro2compra` float DEFAULT NULL,
  `id_resorte22` int(11) DEFAULT NULL,
  `precio_resorte22` float DEFAULT NULL,
  `cant_resorte22` float DEFAULT NULL,
  `valor_resorte22` float DEFAULT NULL,
  `consumo_totalresorte22` float DEFAULT NULL,
  `precio_resorte22compra` float DEFAULT NULL,
  `id_resorte222` int(11) DEFAULT NULL,
  `precio_resorte222` float DEFAULT NULL,
  `cant_resorte222` float DEFAULT NULL,
  `valor_resorte222` float DEFAULT NULL,
  `consumo_totalresorte222` float DEFAULT NULL,
  `precio_resorte222compra` float DEFAULT NULL,
  `id_hombrera2` int(11) DEFAULT NULL,
  `precio_hombrera2` float DEFAULT NULL,
  `cant_hombrera2` float DEFAULT NULL,
  `valor_hombrera2` float DEFAULT NULL,
  `consumo_totalhombrera2` float DEFAULT NULL,
  `precio_hombrera2compra` float DEFAULT NULL,
  `id_sesgo2` int(11) DEFAULT NULL,
  `precio_sesgo2` float DEFAULT NULL,
  `cant_sesgo2` float DEFAULT NULL,
  `valor_sesgo2` float DEFAULT NULL,
  `consumo_totalsesgo2` float DEFAULT NULL,
  `precio_sesgo2compra` float DEFAULT NULL,
  `id_trabilla2` int(11) DEFAULT NULL,
  `precio_trabilla2` float DEFAULT NULL,
  `cant_trabilla2` float DEFAULT NULL,
  `valor_trabilla2` float DEFAULT NULL,
  `consumo_totaltrabilla2` float DEFAULT NULL,
  `precio_trabilla2compra` float DEFAULT NULL,
  `id_vivo2` int(11) DEFAULT NULL,
  `precio_vivo2` float DEFAULT NULL,
  `cant_vivo2` float DEFAULT NULL,
  `valor_vivo2` float DEFAULT NULL,
  `consumo_totalvivo2` float DEFAULT NULL,
  `precio_vivo2compra` float DEFAULT NULL,
  `id_cinta2` int(11) DEFAULT NULL,
  `precio_cinta2` float DEFAULT NULL,
  `cant_cinta2` float DEFAULT NULL,
  `valor_cinta2` float DEFAULT NULL,
  `consumo_totalcinta2` float DEFAULT NULL,
  `precio_cinta2compra` float DEFAULT NULL,
  `id_faya2` int(11) DEFAULT NULL,
  `precio_faya2` float DEFAULT NULL,
  `cant_faya2` float DEFAULT NULL,
  `valor_faya2` float DEFAULT NULL,
  `consumo_totalfaya2` float DEFAULT NULL,
  `precio_faya2compra` float DEFAULT NULL,
  `id_guata2` int(11) DEFAULT NULL,
  `precio_guata2` float DEFAULT NULL,
  `cant_guata2` float DEFAULT NULL,
  `valor_guata2` float DEFAULT NULL,
  `consumo_totalguata2` float DEFAULT NULL,
  `precio_guata2compra` float DEFAULT NULL,
  `id_hiladilla2` int(11) DEFAULT NULL,
  `precio_hiladilla2` float DEFAULT NULL,
  `cant_hiladilla2` float DEFAULT NULL,
  `valor_hiladilla2` float DEFAULT NULL,
  `consumo_totalhiladilla2` float DEFAULT NULL,
  `precio_hiladilla2compra` float DEFAULT NULL,
  `id_pretina2` int(11) DEFAULT NULL,
  `precio_pretina2` float DEFAULT NULL,
  `cant_pretina2` float DEFAULT NULL,
  `valor_pretina2` float DEFAULT NULL,
  `consumo_totalpretina2` float DEFAULT NULL,
  `precio_pretina2compra` float DEFAULT NULL,
  `id_broche2` int(11) DEFAULT NULL,
  `precio_broche2` float DEFAULT NULL,
  `cant_broche2` float DEFAULT NULL,
  `valor_broche2` float DEFAULT NULL,
  `consumo_totalbroche2` float DEFAULT NULL,
  `precio_broche2compra` float DEFAULT NULL,
  `id_cordon2` int(11) DEFAULT NULL,
  `precio_cordon2` float DEFAULT NULL,
  `cant_cordon2` float DEFAULT NULL,
  `valor_cordon2` float DEFAULT NULL,
  `consumo_totalcordon2` float DEFAULT NULL,
  `precio_cordon2compra` float DEFAULT NULL,
  `id_puntera2` int(11) DEFAULT NULL,
  `precio_puntera2` float DEFAULT NULL,
  `cant_puntera2` float DEFAULT NULL,
  `valor_puntera2` float DEFAULT NULL,
  `consumo_totalpuntera2` float DEFAULT NULL,
  `precio_puntera2compra` float DEFAULT NULL,
  `id_plumilla2` int(11) DEFAULT NULL,
  `precio_plumilla2` float DEFAULT NULL,
  `cant_plumilla2` float DEFAULT NULL,
  `valor_plumilla2` float DEFAULT NULL,
  `consumo_totalplumilla2` float DEFAULT NULL,
  `precio_plumilla2compra` float DEFAULT NULL,
  `id_vinilo2` int(11) DEFAULT NULL,
  `precio_vinilo2` float DEFAULT NULL,
  `cant_vinilo2` float DEFAULT NULL,
  `valor_vinilo2` float DEFAULT NULL,
  `consumo_totalvinilo2` float DEFAULT NULL,
  `precio_vinilo2compra` float DEFAULT NULL,
  `estado` enum('Espera','Completado','Parcial','Orden_Compra','Comprado','Ficha_Tecnica','Ficha_Subida','Evaluacion','Entregado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `producto2`
--

INSERT INTO `producto2` (`id_producto2`, `id_producto`, `id_ordencompra`, `id_tela2`, `precio_tela2`, `promedio_consumo2`, `valor_tela2`, `consumo_tela2`, `precio_telacompra2`, `id_telacombi2`, `precio_telacombi2`, `promedio_telacombi2`, `valor_telacombi2`, `consumo_totaltelacombi2`, `precio_telacombi2compra`, `id_telaforro2`, `precio_forro2`, `promedio_forro2`, `valor_forro2`, `consumo_totaltelaforro2`, `precio_telaforro2compra`, `id_entretela22`, `precio_entretela22`, `cant_entretela22`, `valor_entretela22`, `consumo_totalentretela22`, `precio_entretela22compra`, `id_entretela222`, `precio_entretela222`, `cant_entretela222`, `valor_entretela222`, `consumo_totalentretela222`, `precio_entretela222compra`, `id_cuello2`, `precio_cuello2`, `consumo_cuello2`, `valor_cuello2`, `consumo_totalcuello2`, `precio_cuello2compra`, `id_deslizador2`, `precio_deslizador2`, `cant_deslizador2`, `valor_deslizador2`, `consumo_totaldeslizador2`, `precio_deslizador2compra`, `id_fajon_cintura2`, `precio_fajon_cintura2`, `cant_fajon_cintura2`, `valor_fajon_cintura2`, `consumo_totalfajon_cintura2`, `precio_fajon_cintura2compra`, `id_puño2`, `precio_puño2`, `consumo_puño2`, `valor_puño2`, `consumo_totalpuño2`, `precio_puño2compra`, `id_boton22`, `precio_boton22`, `cant_boton22`, `valor_boton22`, `consumo_totalboton22`, `precio_boton22compra`, `id_boton222`, `precio_boton222`, `cant_boton222`, `valor_boton222`, `consumo_totalboton222`, `precio_boton222compra`, `id_cremallera22`, `precio_cremallera22`, `cant_cremallera22`, `valor_cremallera22`, `consumo_totalcremallera22`, `precio_cremallera22compra`, `id_cremallera222`, `precio_cremallera222`, `cant_cremallera222`, `valor_cremallera222`, `consumo_totalcremallera222`, `precio_cremallera222compra`, `id_velcro2`, `precio_velcro2`, `cant_velcro2`, `valor_velcro2`, `consumo_totalvelcro2`, `precio_velcro2compra`, `id_resorte22`, `precio_resorte22`, `cant_resorte22`, `valor_resorte22`, `consumo_totalresorte22`, `precio_resorte22compra`, `id_resorte222`, `precio_resorte222`, `cant_resorte222`, `valor_resorte222`, `consumo_totalresorte222`, `precio_resorte222compra`, `id_hombrera2`, `precio_hombrera2`, `cant_hombrera2`, `valor_hombrera2`, `consumo_totalhombrera2`, `precio_hombrera2compra`, `id_sesgo2`, `precio_sesgo2`, `cant_sesgo2`, `valor_sesgo2`, `consumo_totalsesgo2`, `precio_sesgo2compra`, `id_trabilla2`, `precio_trabilla2`, `cant_trabilla2`, `valor_trabilla2`, `consumo_totaltrabilla2`, `precio_trabilla2compra`, `id_vivo2`, `precio_vivo2`, `cant_vivo2`, `valor_vivo2`, `consumo_totalvivo2`, `precio_vivo2compra`, `id_cinta2`, `precio_cinta2`, `cant_cinta2`, `valor_cinta2`, `consumo_totalcinta2`, `precio_cinta2compra`, `id_faya2`, `precio_faya2`, `cant_faya2`, `valor_faya2`, `consumo_totalfaya2`, `precio_faya2compra`, `id_guata2`, `precio_guata2`, `cant_guata2`, `valor_guata2`, `consumo_totalguata2`, `precio_guata2compra`, `id_hiladilla2`, `precio_hiladilla2`, `cant_hiladilla2`, `valor_hiladilla2`, `consumo_totalhiladilla2`, `precio_hiladilla2compra`, `id_pretina2`, `precio_pretina2`, `cant_pretina2`, `valor_pretina2`, `consumo_totalpretina2`, `precio_pretina2compra`, `id_broche2`, `precio_broche2`, `cant_broche2`, `valor_broche2`, `consumo_totalbroche2`, `precio_broche2compra`, `id_cordon2`, `precio_cordon2`, `cant_cordon2`, `valor_cordon2`, `consumo_totalcordon2`, `precio_cordon2compra`, `id_puntera2`, `precio_puntera2`, `cant_puntera2`, `valor_puntera2`, `consumo_totalpuntera2`, `precio_puntera2compra`, `id_plumilla2`, `precio_plumilla2`, `cant_plumilla2`, `valor_plumilla2`, `consumo_totalplumilla2`, `precio_plumilla2compra`, `id_vinilo2`, `precio_vinilo2`, `cant_vinilo2`, `valor_vinilo2`, `consumo_totalvinilo2`, `precio_vinilo2compra`, `estado`) VALUES
(37, 2391, 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 424, 1.7, 720.8, 170, 72080, 1, 2494.8, 1, 2494.8, 100, 249480, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 2393, 108, 1, 6975.74, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 424, 0.89, 377.36, 89, 37736, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nit` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `banco` enum('Seleccione una Opcion','Banco Union','BBVA Colombia','Bancamia S.A.','Banco AV Villas','Banco Agrario','Banco Caja Social','Banco Davivienda SA','Banco Falabella SA','Banco Popular','Banco Santander','Banco Serfinanza','Banco W S.A.','Banco de Bogota','Banco de Occidente','Banco Mundo Mujer','Bancolombia','Bancoomeva','CITIBANK','Daviplata','Nequi','RappiPay') DEFAULT NULL,
  `tipo_cuenta` enum('Cuenta Corriente','Cuenta de Ahorros') DEFAULT NULL,
  `num_cuenta` varchar(20) DEFAULT NULL,
  `certificado_bancario` longblob DEFAULT NULL,
  `autorizacion` varchar(100) DEFAULT NULL,
  `repre_comercial` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nit`, `nombre`, `razon_social`, `celular`, `email`, `banco`, `tipo_cuenta`, `num_cuenta`, `certificado_bancario`, `autorizacion`, `repre_comercial`, `departamento`, `ciudad`, `direccion`, `descripcion`) VALUES
(0, 0, 'Ninguno', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL),
(1, 0, 'Cali Plasticos', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(2, 0, 'Confecciones Gym', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(3, 0, 'Dispol', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(4, 0, 'Estrada Y Velasquez', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(5, 0, 'Gerrajes', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(6, 0, 'Gerrajes Peleteria', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(7, 0, 'Hermano Mario Rivera', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(8, 0, 'Herrajes', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(9, 0, 'Insalsi', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(10, 0, 'Insumos Y Troquelados', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(11, 0, 'Iyt', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(12, 0, 'Marquillas Gamma', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(13, 0, 'Portofino', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(14, 0, 'Primavera', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(15, 0, 'Prointex', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(16, 0, 'Risaltex', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(17, 0, 'Taipei', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(18, 0, 'Tejido Rda', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(19, 0, 'Telares Medellin', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(20, 0, 'Total Reflectiv', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', ''),
(32, 901208883, 'Textiles Spirit', NULL, '3102074721', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', 'Julian Camargo', 'Bogotá D.C.', 'Bogotá D.C.', 'calle 78 no 63-64', ''),
(33, 901245912, 'Guia Logistica sas', NULL, '3218239936', 'dperez370@soy.sena.edu.co', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', 'alejandro', '', '', '', ''),
(34, 890204797, 'COLNOTEX', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(35, 805025631, 'EKA CORPORACION SAS ', NULL, '3203509829', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', 'venden cremalleras e insumos'),
(36, 0, 'Tejilar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 0, 'Retacon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 0, 'Patprimo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 890900533, 'INDUBOTON SAS', NULL, '3218576320', 'contabilidad@induboton.com.co', 'Banco Davivienda SA', 'Cuenta Corriente', '0000036369999192', 0x646f63756d656e746f732f636572746966696361646f732f, 'INDUBOTON SAS', 'JOHN TREJOS', 'Antioquia', 'Medellín', 'calle 44 sur 48-61', 'Proveedor de botones '),
(40, 900149163, 'YENJHON SA', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(41, 657629151, 'MARIA DEL PILAR GARCIA', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(42, 1010126473, 'FRANCISCO JAVIER VELEZ OROZCO', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(43, 901404844, 'INDUSTRIAS MGP SAS', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(44, 901898880, 'J Y G BOTAS INDUSTRIALES', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(45, 901142087, 'IMPORTADORA Y COMERCIALIZADORA', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(46, 800204486, 'DOTACONDOR SAS', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(47, 434690710, 'MARIA ERNESTINA CEBALLO GALEAN', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(48, 438549980, 'ALISARDO RESTREPO BUITRAGO', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(49, 79752562, 'JUAN ALFARO ARISTIZABAL ARISTIZABAL', 'EL IMPERIO DE LAS GORRAS ', '3022808822', 'aristizabaljuanalfaro18@gmail.com', 'Seleccione una Opcion', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', 'JUAN ALFARO ARISTIZABAL ', '', '', '', ''),
(50, 800116062, 'Las 3BBB sas', 'Las 3BBB sas', '', '', 'Seleccione una Opcion', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(51, 900418527, 'El Mayorista', 'Importadora de Insumos el mayorista sas', '', '', 'Seleccione una Opcion', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_tela`
--

CREATE TABLE `proveedor_tela` (
  `id_proveedor` int(11) NOT NULL,
  `nit` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `banco` enum('Seleccione una Opcion','Banco Union','BBVA Colombia','Bancamia S.A.','Banco AV Villas','Banco Agrario','Banco Caja Social','Banco Davivienda SA','Banco Falabella SA','Banco Popular','Banco Santander','Banco Serfinanza','Banco W S.A.','Banco de Bogota','Banco de Occidente','Bancolombia','Bancoomeva','Banco Mundo Mujer','CITIBANK','Daviplata','Nequi','RappiPay') DEFAULT NULL,
  `tipo_cuenta` enum('Cuenta Corriente','Cuenta de Ahorros') DEFAULT NULL,
  `num_cuenta` varchar(20) DEFAULT NULL,
  `certificado_bancario` longblob DEFAULT NULL,
  `autorizacion` varchar(100) DEFAULT NULL,
  `repre_comercial` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedor_tela`
--

INSERT INTO `proveedor_tela` (`id_proveedor`, `nit`, `nombre`, `razon_social`, `celular`, `email`, `banco`, `tipo_cuenta`, `num_cuenta`, `certificado_bancario`, `autorizacion`, `repre_comercial`, `departamento`, `ciudad`, `direccion`, `descripcion`) VALUES
(0, NULL, 'Ninguno', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, NULL, 'El Mayorista', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 'Quantto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 'Lafayette', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 'Icoltex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 'Bella Tela', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'Texticorp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, 'Stilotex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, 'Tramas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, 'Comertex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 'Margaritex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, 'T3 Textiles', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, NULL, 'Tienda Portofino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, NULL, 'Patprimo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, NULL, 'Sutex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, NULL, 'Danitex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, 'Risalltex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, 'Teks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, 'Fourtex - Fernando ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, NULL, 'Enciso', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, NULL, 'Margaretex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, NULL, 'Geomundo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, NULL, 'Texeli', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, NULL, 'Mil Telas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, NULL, 'Primatela', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, NULL, 'Cosmotextil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, NULL, 'Corbeta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, NULL, 'Bellatela Cali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, NULL, 'Textilia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, NULL, 'Dgt Nancy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, 'Intexco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, NULL, 'Comertex Tienda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, NULL, 'Ovetex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, NULL, 'Balletexco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, NULL, 'Jhon Uribe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, NULL, 'Top Tex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, 'Éxito - Custer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, NULL, 'Diego Sellartex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, 'Surtiplas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, 'Guantes Y Seguridad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, NULL, 'Asequin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, NULL, 'Dotacol', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, NULL, 'Dress Winter- Sthepany', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, NULL, 'Linda Textil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, NULL, 'Telares Medellin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, NULL, 'Tienda Comertex Detal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, NULL, 'Tienda Comertex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, NULL, 'Fibratela Maria Elena 31083513', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, 'Daccahs  Mario Ceballos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, 'Utex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, 'Retacol Lina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, NULL, 'Tejilar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, NULL, 'El Imperio De La Gorra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, NULL, 'Colteantioquia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, NULL, 'Dotaciones Calderon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, NULL, 'Poljean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, NULL, 'Insumos Y Textiles', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, NULL, 'Vicuña', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, NULL, 'Insumos Y Textiles- Bernardo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, NULL, 'Ryco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, NULL, 'Fenix', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, NULL, 'Linotex Medellin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, NULL, 'Textiles Yoyo Medellin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, NULL, 'Continental De Textiles', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, NULL, 'Tejilares Mauricio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, 'Textrama Rodrigo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, NULL, 'Risaltex', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, NULL, 'Trend Lab', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, NULL, 'Almacen Textifill Bogota', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, NULL, 'Tejilares Ana Cristina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, NULL, 'Yenjhon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, NULL, 'Gildan- Corbeta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, NULL, 'Portofino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, NULL, 'Retacon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, NULL, 'Mi Telas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, NULL, 'Francisco Rosero', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, NULL, 'Mapi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, NULL, 'Eduardo Mejia Z Sucesores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, NULL, 'Textiles del Pacifico', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 987455551, 'ABC Tela ejemplo', 'sebasyiAN', '3145351793', 'sebas.luna1013@gmail.com', 'Nequi', 'Cuenta Corriente', '1245789455222454', 0x646f63756d656e746f732f636572746966696361646f732f52657469726f20657374756469616e74652e706466, 'Luis Fernando torrez mejia', 'yo soy el representante', 'Boyacá', 'Chiquinquirá', 'carrera 1 G # 35 A 13', 'tiene dos ubicaciones y maneja muchas cosas '),
(82, 901208883, 'Textiles Spirit', NULL, '3102074721', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', 'Bogotá D.C.', 'Bogotá D.C.', '', ''),
(83, 901092002, 'Intermoda', NULL, '3127962972', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(84, 901245912, 'Guia Logistica sas', NULL, '3102074721', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', 'alejandro', '', '', '', ''),
(85, 900418527, 'INVERSIONES EL MAYORISTA', NULL, '3222773185', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', 'GERARDO', '', '', '', ''),
(86, 890204797, 'COLNOTEX', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(87, 901547424, 'TEXTILES MEDELLIN Y MODA', NULL, '3176991261', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(88, 890312487, 'DISTRIBUIDORA CALI PLASTICOS ', NULL, '', '', 'Banco Mundo Mujer', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', '', '', '', '', ''),
(89, 809004045, 'Fibratela SA', NULL, '3208448684', 'fibratela@fibratela.com.co', 'Bancolombia', 'Cuenta Corriente', '0000015321174919', 0x646f63756d656e746f732f636572746966696361646f732f, 'Fibratela SA', '', 'Tolima', 'Ibagué', 'Km 17 Via Ibague Buenos Aires par logistico nacional del Trolima A10', ' Telas Drill con spandex y rigidas'),
(90, 860000452, 'Manufacturas Eliot sas', 'Pat Primo', '3208515558', '', 'Seleccione una Opcion', 'Cuenta Corriente', '', 0x646f63756d656e746f732f636572746966696361646f732f, '', 'Nestor', '', '', '', 'Dos asesores \r\nMateo\r\nNestor Eduardo ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesta_cinta`
--

CREATE TABLE `puesta_cinta` (
  `id_puesta` int(11) NOT NULL,
  `tipo_puesta` varchar(300) DEFAULT NULL,
  `precio_puesta` float DEFAULT NULL,
  `actualizacion_puesta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `puesta_cinta`
--

INSERT INTO `puesta_cinta` (`id_puesta`, `tipo_puesta`, `precio_puesta`, `actualizacion_puesta`) VALUES
(1, 'No Necesita', 0, '2026-03-05'),
(2, 'Si Tiene Puesta de Cinta', 500, '2026-03-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntera`
--

CREATE TABLE `puntera` (
  `id_puntera` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `puntera`
--

INSERT INTO `puntera` (`id_puntera`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 19),
(1, 'Puntera Plastica Por 100 Unidades', 'und', 28.6, '2025-01-24', 0, 5, 19),
(5, 'Vinilo', NULL, 6210, NULL, NULL, 1, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puño`
--

CREATE TABLE `puño` (
  `id_puño` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `puño`
--

INSERT INTO `puño` (`id_puño`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 20),
(1, 'Puño Tejido Polo Poliéster', 'par', 1800.2, '2026-02-03', 0, 18, 20),
(2, 'Puño Tejido Buso Poliéster', 'par', 2006.4, '2025-01-24', 0, 18, 20),
(3, 'Puño Insumos Y Troquelados', 'pares', 800, '2026-05-06', 0, 11, 20),
(4, 'Puño Poli algodón Polo Par', 'juego', 1782, '2025-01-24', 0, 18, 20),
(6, 'Fajon Puño Camisa Magnetron x 2', 'par', 4200, '2025-06-20', 0, 10, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_reporte` int(11) NOT NULL,
  `ganancia_actual` float DEFAULT NULL,
  `ganancia_pasada` float DEFAULT NULL,
  `ventas_ene` float DEFAULT NULL,
  `ventas_feb` float DEFAULT NULL,
  `ventas_mar` float DEFAULT NULL,
  `ventas_abr` float DEFAULT NULL,
  `ventas_may` float DEFAULT NULL,
  `ventas_jun` float DEFAULT NULL,
  `ventas_jul` float DEFAULT NULL,
  `ventas_ago` float DEFAULT NULL,
  `ventas_sep` float DEFAULT NULL,
  `ventas_oct` float DEFAULT NULL,
  `ventas_nov` float DEFAULT NULL,
  `ventas_dic` float DEFAULT NULL,
  `pasado_ene` float DEFAULT NULL,
  `pasado_feb` float DEFAULT NULL,
  `pasado_mar` float DEFAULT NULL,
  `pasado_abr` float DEFAULT NULL,
  `pasado_may` float DEFAULT NULL,
  `pasado_jun` float DEFAULT NULL,
  `pasado_jul` float DEFAULT NULL,
  `pasado_ago` float DEFAULT NULL,
  `pasado_sep` float DEFAULT NULL,
  `pasado_oct` float DEFAULT NULL,
  `pasado_nov` float DEFAULT NULL,
  `pasado_dic` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id_reporte`, `ganancia_actual`, `ganancia_pasada`, `ventas_ene`, `ventas_feb`, `ventas_mar`, `ventas_abr`, `ventas_may`, `ventas_jun`, `ventas_jul`, `ventas_ago`, `ventas_sep`, `ventas_oct`, `ventas_nov`, `ventas_dic`, `pasado_ene`, `pasado_feb`, `pasado_mar`, `pasado_abr`, `pasado_may`, `pasado_jun`, `pasado_jul`, `pasado_ago`, `pasado_sep`, `pasado_oct`, `pasado_nov`, `pasado_dic`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resorte`
--

CREATE TABLE `resorte` (
  `id_resorte` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `resorte`
--

INSERT INTO `resorte` (`id_resorte`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 21),
(1, 'Resorte 1 Cms', 'metro', 285, '2026-04-18', 0, 5, 21),
(2, 'Resorte Blanco 4 cms de  ancho ', 'metro', 602, '2026-04-18', 0, 50, 21),
(3, 'Resorte 2 Cms  ', 'metro', 235, '2026-04-18', 0, 5, 21),
(4, 'Resorte Con Cordon por 50 Mts', 'metro', 757.9, '2025-01-24', 0, 5, 21),
(7, 'Resorte Negro 4 cms de ancho', 'und', 595, '2026-04-18', 0, 50, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resorte2`
--

CREATE TABLE `resorte2` (
  `id_resorte2` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `resorte2`
--

INSERT INTO `resorte2` (`id_resorte2`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 21),
(1, 'Resorte 1 Cms', 'metro', 285, '2026-04-18', 0, 5, 21),
(2, 'Resorte Blanco 4 cms de  ancho ', 'metro', 602, '2026-04-18', 0, 50, 21),
(3, 'Resorte 2 Cms  ', 'metro', 235, '2026-04-18', 0, 5, 21),
(4, 'Resorte Con Cordon por 50 Mts', 'metro', 757.9, '2025-01-24', 0, 5, 21),
(6, 'Resorte Negro 4 cms de ancho', 'und', 595, '2026-04-18', 0, 50, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesgo`
--

CREATE TABLE `sesgo` (
  `id_sesgo` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `sesgo`
--

INSERT INTO `sesgo` (`id_sesgo`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 22),
(1, 'Sesgo Ancho 16 Mm Metro', 'metro', 554.4, '2025-01-24', 0, 5, 22),
(2, 'Sesgo Ancho 16 Mm Pieza Por 10 Metros', 'metro', 452.1, '2025-01-24', 0, 5, 22),
(3, 'Sesgo Ancho 20 Mm Metro', 'metro', 740.3, '2025-01-24', 0, 5, 22),
(4, 'Sesgo Ancho 20 Mm Pieza Por 10 Metros', 'metro', 573.1, '2025-01-24', 0, 5, 22),
(5, 'Sesgo Embonado ', 'metro', 268, '2026-05-08', 0, 5, 22),
(11, 'Sesgo resorte blanco ', 'metro', 280, '2026-02-25', 0, 11, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablon`
--

CREATE TABLE `tablon` (
  `id_tablon` int(11) NOT NULL,
  `tipo_tablon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tablon`
--

INSERT INTO `tablon` (`id_tablon`, `tipo_tablon`) VALUES
(0, 'No Aplica'),
(1, 'Sin Tablon'),
(2, 'Con Tablon'),
(3, 'Sencillo'),
(4, 'Con Prences');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tela`
--

CREATE TABLE `tela` (
  `id_tela` int(11) NOT NULL,
  `id_tipo_tela` int(11) NOT NULL,
  `tela` varchar(300) DEFAULT NULL,
  `ancho` varchar(30) DEFAULT NULL,
  `peso` varchar(30) DEFAULT NULL,
  `caracteristicas` varchar(100) DEFAULT NULL,
  `rendimiento` varchar(50) DEFAULT NULL,
  `encogimiento` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades_metros` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tela`
--

INSERT INTO `tela` (`id_tela`, `id_tipo_tela`, `tela`, `ancho`, `peso`, `caracteristicas`, `rendimiento`, `encogimiento`, `precio`, `fecha_actualizacion`, `unidades_metros`, `id_proveedor`) VALUES
(0, 0, 'No Aplica', NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-22', NULL, 0),
(1, 1, 'Antifluido Adidas ', '1,5', '', '', '', '', 6975.74, '2026-01-22', 0, 1),
(2, 1, 'Antifluido Adidas Es Mas Impermeable ', '1,5', '105 Gr ', '100% Poliester', '', '', 7114.8, '2026-01-22', 0, 2),
(3, 1, 'Antifluido Alviero Strech Lafshield', '1,51', '205', '100% POLIESTER', '', '', 25747, '2026-04-17', 0, 3),
(4, 1, 'Antifluido Alviero Strech Lafshield Estampada', '1,5', '', '', '', '', 28334.2, '2025-12-15', 0, 3),
(5, 1, 'Antifluido Antimicrobial Microtec Cloro Antimicrobial', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(6, 1, 'Antifluido Antimicrobial Microtec Cloro Antimicrobial  Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(7, 1, 'Antifluido Antimicrobial Universal Cloro Antimicrobial', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(8, 1, 'Antifluido Aqua Max Cloro Resistencia', '1,5', '140 Gr', '', '', '', 12521, '2026-03-26', 0, 4),
(9, 1, 'Antifluido Astral (Se Parece Wembley Y Nike) ', '1,5', '115 Gr', '100%Poliester ', '', '', 8063.44, '2026-01-22', 0, 5),
(10, 1, 'Antifluido Balsillas ', '1,5', '', '100% Poliester', '', '', 5336.1, '2026-01-22', 0, 5),
(11, 1, 'Antifluido Betania', '1,48', '150 Gr', '65%Poliester - 35%Viscosa Sensacion Frescura ', '', '', 20756.9, '2025-12-15', 0, 3),
(12, 1, 'Antifluido Boston Navy ', '1,5', '', '', '', '', 12229.9, '2026-01-22', 0, 6),
(13, 1, 'Antifluido Caribe Cloro Resistente', '1,5', '', '', '', '', 25025.8, '2025-12-15', 0, 3),
(14, 1, 'Antifluido Caribe Cloro Resistente', '1,5', '', 'Estampado', '', '', 28281.3, '2025-12-15', 0, 3),
(15, 1, 'Antifluido Cooper', '1,5', '62-67 Gr', 'Repelente Al Agua No Impermeable Tipo Cortaviento ', '', '', 9486.4, '2026-01-22', 0, 7),
(16, 1, 'Antifluido Cosmos ', '1,53', '', '', '', '', 24299.9, '2026-01-30', 0, 3),
(17, 1, 'Antifluido Cosmos  Estampado', '1,53', '', '', '', '', 23585.6, '2025-12-15', 0, 3),
(18, 1, 'Antifluido Country', '1,53', '', '100% Poliester ', '', '', 7233.38, '2026-01-22', 0, 2),
(19, 1, 'Antifluido De 8 Homologa Universal De 3', '', '', '', '', '', 8182.02, '2026-01-22', 0, 8),
(20, 1, 'Antifluido Durango', '1,5', '', '', '', '', 23958.6, '2025-12-15', 0, 3),
(21, 1, 'Antifluido Electra ', '1,5', '', '100% Poliester Pelicula Clororesistencia', '', '', 19565.7, '2026-01-22', 0, 20),
(22, 1, 'Antifluido Kae Se Parece Al Tequila Es Opaco ', '1,6', '', '', '', '', 11265.1, '2026-01-22', 0, 9),
(23, 1, 'Antifluido Lacrosse', '1,48', '', '', '', '', 0, '2025-12-15', 0, 3),
(24, 1, 'Antifluido Liso Wr ', '1,5', '115 Gr', '100%Poliester Liviano Poca Clororesistencia', '', '', 8967.88, '2026-01-22', 0, 4),
(25, 1, 'Antifluido Manila', '1,46', '148 Gr', '65%Poliester - 60%Algodon ', '', '', 23104.8, '2025-12-15', 0, 3),
(26, 1, 'Antifluido 20 Extra', '', '', '', '', '', 19802.9, '2026-01-22', 0, 10),
(27, 1, 'Antifluido Megadrill Lafshield', '1,5', '', '', '', '', 27693.8, '2025-12-15', 0, 3),
(28, 1, 'Antifluido Metropol ', '1,5', '100 Gr', '100% Poliester ', '', '', 30522.5, '2026-01-22', 0, 7),
(29, 1, 'Antifluido Megadrill Lafshield Estampado', '1,5', '', '', '', '', 30522.5, '2025-12-15', 0, 3),
(30, 1, 'Antifluido Microdril Lafshield', '1,5', '', '', '', '', 29828.3, '2025-12-15', 0, 3),
(31, 1, 'Antifluido Microfibra Acabado Soft ', '1,48', '115 Gr', '100% Poliester', '', '', 31642.5, '2026-01-22', 0, 8),
(32, 1, 'Antifluido Microdril Lafshield Estampado', '1,5', '', '', '', '', 31642.5, '2025-12-15', 0, 3),
(33, 1, 'Antifluido Microprince', '1,51', '', '', '', '', 29028.4, '2025-12-15', 0, 3),
(34, 1, 'Antifluido Microtec Clor Resistente ', '1,5', '104', '100% POLIESTER', '', '', 22368.5, '2025-12-15', 0, 3),
(35, 1, 'Antifluido Microtec clororesistente Estampado', '1,5', '104', '100% POLIESTER', '', '', 29914.5, '2025-12-15', 0, 3),
(36, 1, 'Antifluido Mundial Clororesistente (Universal Clororesistente) ', '1,45', '30 Gr', '100%Poliester ', '', '', 14822.5, '2026-01-22', 0, 5),
(37, 1, 'Antifluido Napolen (Toque Soft) ', '1,5', '110 Gr', '100%Poliester ', '', '', 8300.6, '2026-01-22', 0, 5),
(38, 1, 'Antifluido Nike ', '1,5', '', '100% Poliester', '', '', 8419.18, '2026-01-22', 0, 11),
(39, 1, 'Antifluido Odeon', '', '', '', '', '', 15362.6, '2026-01-22', 0, 2),
(40, 1, 'Antifluido Olimpia Repel Estampado', '1,5', '', '', '', '', 9830.28, '2026-01-22', 0, 12),
(41, 1, 'Antifluido Olimpia Repel  Unicolor', '1,5', '', '', '', '', 8703.77, '2026-01-22', 0, 13),
(42, 1, 'Antifluido Forza ', '1.47', '105gr', '100% Poliester ', '', '', 6999, '2026-02-19', 0, 14),
(43, 1, 'Antifluido Plus Ancho ', '1,5', '', '', '', '', 9159, '2026-03-17', 0, 4),
(44, 1, 'Antifluido Riva ', '1,5', '137 Gr', '100% Poliester ', '', '', 10760.6, '2026-01-22', 0, 15),
(46, 1, 'Antifluido Spandex Baltimore ', '1,45', '120 Gr', '97%Poliester 3%Spandex ', '', '', 6284.74, '2026-01-22', 0, 5),
(47, 1, 'Antifluido Spandex Fatima ', '1,45', '140 Gr ', '92%Poliester-8%Spandex  Solo Blanco Por Ahora', '', '', 8431.04, '2026-01-22', 0, 2),
(48, 1, 'Antifluido Spandex Iguazu Lycra ', '1,5', '132', 'lycra 4% Pol Re. 96%', '', '', 27489, '2025-12-15', 0, 3),
(49, 1, 'Antifluido Spandex Lotus', '1.50', '169', 'Pol 96% lycra 4%', '', '', 30022.3, '2025-12-15', 0, 3),
(50, 1, 'Antifluido Spandex Lotus Estampado', '1.51', '170', '', '', '', 39077.5, '2025-12-15', 0, 3),
(51, 1, 'Antifluido Spandex Marruecos R', '', '', '', '', '', 33404, '2025-12-15', 0, 3),
(52, 1, 'Antifluido Spandex Metro ', '1,47', '180 Gr', '100% Poliester Strech Mecanico  Solo Blanco Por Ahora Spandex En La Trama', '', '', 0, '2026-01-22', 0, 2),
(53, 1, 'Antifluido Spandex Napolen ', '1,5', '150 Gr ', '96%Poliester - 4%Spandex ', '', '', 11656.4, '2026-01-22', 0, 16),
(54, 1, 'Antifluido Spandex Tesla ', '1,5', '', '95%Poliester - 5% Elastomero Peso 148', '', '', 12592.1, '2026-01-22', 0, 4),
(55, 1, 'Antifluido Spandex Tory ', '1,47', '135 Gr', '91%Poliester-9%Spandex   Solo Blanco Por Ahora', '', '', 0, '2026-01-22', 0, 2),
(56, 1, 'Antifluido Spandex Universal Lycra', '1,5', '', '', '', '', 27542.9, '2025-12-15', 0, 3),
(57, 1, 'Antifluido Tulum ', '1,5', '148 Gr ', '100% Poliester Texturizado ', '', '', 18027.4, '2026-01-22', 0, 4),
(58, 1, 'Antifluido T180', '1.80', '', '100% Poliester', '', '', 23500, '2026-02-12', 0, 3),
(59, 1, 'Antifluido T180  Estampada', '1.80', '', '100% POLIESTER', '', '', 26750, '2026-02-12', 0, 3),
(60, 1, 'Antifluido Tekila ', '1,5', '', '100% Poliester ', '', '', 12569.5, '2026-01-22', 0, 9),
(61, 1, 'Antifluido Tifon  Verde Neon Brigadista', '1,5', '', '', '', '', 4312, '2026-01-22', 0, 1),
(62, 1, 'Antifluido Tulun Homologa Universal Clororesistente ', '1,5', '', '', '', '', 18027.4, '2026-01-22', 0, 4),
(63, 1, 'Antifluido Tx 200 ', '1,5', '136gr', '100% POLIESTER', '', '', 16700, '2026-04-21', 0, 3),
(64, 1, 'Antifluido Tx 200 Estampada', '1,5', '136gr', '100% POLIESTER', '', '', 21950, '2026-02-19', 0, 3),
(65, 1, 'Antifluido Universal Cloro Resis 1,5 Unicolor', '1,5', '135', '100% POLIESTER', '', '', 23450, '2026-02-19', 0, 3),
(66, 1, 'Antifluido Universal Cloro Resistente Estampado', '1,5', '135', '100% POLIESTER', '', '', 26303.2, '2025-12-15', 0, 3),
(67, 1, 'Antifluido Universal Ripstop', '1,5', '', '', '', '', 21550, '2026-02-10', 0, 3),
(68, 1, 'Antifluido Universal Touch', '1,5', '', '', '', '', 23284.8, '2025-12-15', 0, 3),
(69, 1, 'Antifluido Urano Liviano Para Cortavientos', '', '', '', '', '', 9118.8, '2026-01-22', 0, 17),
(70, 1, 'Antifluido Valdo ', '1,5', '140 Gr', '100% Poliester', '', '', 9130.66, '2026-01-22', 0, 18),
(71, 1, 'Antifluido Velero R ', '1,58', '', '', '', '', 34172.6, '2025-12-15', 0, 3),
(72, 1, 'Antifluido Wembley ', '1,55', '104 Gr', '100% Poliester', '', '', 7990, '2026-02-17', 0, 16),
(73, 1, 'Antifluido Wembley Detal ', '1,55', '104 Gr', '100% Poliester', '', '', 10463.1, '2026-01-22', 0, 15),
(74, 1, 'Antifluido Wind Breaker ', '1,5', '', '100% Poliester', '', '', 5929, '2026-01-22', 0, 11),
(75, 1, 'Antifluido Zelandia Wr Soft ', '1,5', '105 Gr', '100%Poliester', '', '', 7292.67, '2026-01-22', 0, 2),
(76, 2, 'Burda Latina ', '', '180 Gr', '77% Poliester 23%Algodon', '', '', 10230.2, '2026-01-22', 0, 13),
(77, 3, 'Dril Camisa Confeccionada Polialgodon 19', '', '', '', '', '', 45837.6, '2026-01-22', 0, 19),
(78, 4, 'Camisera  Resort lc', '1,5', '', '', '', '', 23015.3, '2025-12-15', 0, 3),
(79, 4, 'Camisera Guayabera Resort Estampada', '1,5', '', '', '', '', 27542.9, '2025-12-15', 0, 3),
(80, 4, 'Camisero Acantha ', '1,5', '', '', '', '', 21250, '2026-02-02', 0, 3),
(81, 4, 'Camisero Adara', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(82, 4, 'Camisero Adara Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(83, 4, 'Camisero Alessio ', '1,5', '', '85% pol 15% alg', '', '', 26300, '2026-04-28', 0, 3),
(84, 4, 'Camisero Alessio lagerfeld ', '1,5', '', '85% pol 15% alg', '', '', 29350, '2026-04-28', 0, 3),
(85, 4, 'Camisero Andes ', '1,5', '', ' 100% poliester recicl', '', '', 21650, '2026-02-04', 0, 3),
(86, 4, 'Camisero Bamoa', '1,5', '', '100% Poliester', '', '', 20900, '2026-02-03', 0, 3),
(87, 4, 'Camisero Bamoa Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(88, 4, 'Camisero Carlita ', '1,5', '', '', '', '', 20277.2, '2026-01-22', 0, 20),
(89, 4, 'Camisero Chicago Unicolor Y Jasped', '1,5', '', '', '', '', 23284.8, '2025-12-15', 0, 3),
(90, 4, 'Camisero Danova L.C', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(91, 4, 'Camisero Danova L.C Estampada', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(92, 4, 'Camisero Dexter solo fondo ', '1,46', '137', 'Algodon 65% Poliester 35%', '', '', 25450, '2026-04-16', 0, 3),
(93, 4, 'Camisero Dinamica', '1,5', '', '', '', '', 18649.4, '2026-01-22', 0, 20),
(94, 4, 'Camisero Dull Khosibo ', '', '130 Gr', '100%Poliester', '', '', 21077.1, '2026-01-22', 0, 21),
(95, 4, 'Camisero E Padua Queen Estampado', '1,7', '', '', '', '', 0, '2025-12-15', 0, 3),
(96, 4, 'Camisero Éxito ', '1,48', '130 Gr', '95%Poliester-5% Algodón', '', '', 25826.7, '2026-01-22', 0, 22),
(97, 4, 'Camisero Fay', '1.50', '118gr', '100% Polyester', '', '', 12681.6, '2026-01-22', 0, 15),
(98, 4, 'Camisero Fay Negro', '', '', '', '', '', 24919, '2026-01-22', 0, 23),
(99, 4, 'Camisero Fay Queen ', '1,49', '118 Gr ', '100%Poliester', '', '', 25826.7, '2026-01-22', 0, 22),
(100, 4, 'Camisero Fay 25 ', '1,47', '125 Gr ', '100% Poliester', '', '', 21077.1, '2026-01-22', 0, 25),
(101, 4, 'Camisero Fay Detal ', '1,47', '125 Gr', '100% Poliester', '', '', 24919, '2026-01-22', 0, 15),
(102, 4, 'Camisero Fendi Mil Rayas colores varios ', '1,5', '100 Gr', '65%Poliester - 35%Algodon ', '', '', 10000, '2026-03-12', 0, 4),
(103, 4, 'Camisero Fill And Fill 20 ', '1,5', '', '100% Poliester ', '', '', 21077.1, '2026-01-22', 0, 20),
(104, 4, 'Camisero Fill And Fill 24 ', '', '', '100% Algodón ', '', '', 24919, '2026-01-22', 0, 24),
(106, 4, 'Camisero Gaell', '1,6', '', '', '', '', 21290.5, '2025-12-15', 0, 3),
(107, 4, 'Camisero Gorgona Lycra R ', '1,5', '119', 'Pol 96% lycra 4%', '', '', 26908, '2026-04-16', 0, 3),
(108, 4, 'Camisero Gorgona R Estampado', '1,5', '119', 'Pol 96% lycra 4%', '', '', 0.2, '2026-01-30', 0, 3),
(109, 4, 'Camisero Howard ', '1,7', '', '', '', '', 28459.2, '2025-12-15', 0, 3),
(110, 4, 'Camisero Kuvo Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(111, 4, 'Camisero Maori Estampado', '1,5', '99', '45%Algodon 55% Poliester ', '', '', 21290.5, '2025-12-15', 0, 3),
(112, 4, 'Camisero 20', '', '', '', '', '', 19684.3, '2026-01-22', 0, 20),
(113, 4, 'Camisero Metro L.C', '1,5', '', '', '', '', 21128.8, '2025-12-15', 0, 3),
(114, 4, 'Camisero Metro L.C  Estampada', '1,5', '', '', '', '', 34927.2, '2025-12-15', 0, 3),
(116, 4, 'Camisero Montecarlo ', '1,5', '100 Gr', '55%Poliester-45% Algodón Peso 95 A ', '', '', 14227.4, '2026-01-22', 0, 11),
(117, 4, 'Camisero New Prestige ', '1,45', '', '50%Algodon - 50% Poliester', '', '', 14945.4, '2026-01-22', 0, 14),
(118, 4, 'Camisero Nicole L.C', '1,5', '', '', '', '', 21883.4, '2025-12-15', 0, 3),
(119, 4, 'Camisero Nicole L.C Estampado', '1,5', '', '', '', '', 21883.4, '2025-12-15', 0, 3),
(120, 4, 'Camisero Popelina ', '1,5', '', '', '', '', 10241, '2026-01-22', 0, 15),
(122, 4, 'Tela camisera Popelina Brisa ', '1,5', '', '65%Poliester-35%Algodon', '', '', 7900, '2026-02-09', 0, 16),
(123, 4, 'Camisero Popelina Menta ', '', '', 'Poli-Alg ', '', '', 7589.12, '2026-01-22', 0, 26),
(124, 4, 'Camisero Popelina Menta ', '', '', 'Poli-Alg', '', '', 8419.18, '2026-01-22', 0, 26),
(125, 4, 'Camisero Popelina Pc Holandes ', '1,5', '150 Gr', '65% Poliester- 35% Viscosa', '', '', 0, '2026-01-22', 0, 16),
(126, 4, 'Camisero Popelina San Pablo ', '1.5', '150 Gr', '65%Poliester-35%Algodon', '', '', 7862, '2026-05-20', 0, 2),
(127, 4, 'Camisero Popelina Superior ', '1,5', '', '', '', '', 9512.27, '2026-01-22', 0, 4),
(128, 4, 'Camisero Queen', '1,65', '', '', '', '', 21290.5, '2025-12-15', 0, 3),
(129, 4, 'Camisero Queen Estampada', '1,65', '', '', '', '', 24362.8, '2025-12-15', 0, 3),
(130, 4, 'Camisero Rayas Steve2-1', '', '88 Gr ', '65%Poliester -35%Algodon', '', '', 7707.7, '2026-01-22', 0, 21),
(131, 4, 'Camisero Super Turin ', '1,45', '90 A 95 Gr', '55%Poliester-45% Algodón ', '', '', 14227.4, '2026-01-22', 0, 11),
(132, 4, 'Camisero Unicolor Y Estampadas ', '1,45', '', '100% Poliester', '', '', 17905.6, '2026-01-22', 0, 20),
(133, 4, 'Camisero Vargas Llosa ', '1,5', '110 Gr', '50% Poliester - 50% Algodón  ', '', '', 118461, '2026-04-24', 0, 90),
(134, 4, 'Camisero Universal Ristop Wicking', '', '', '', '', '', 21128.8, '2025-12-15', 0, 3),
(135, 4, 'Camisero Universal Ristop Wicking Estampado', '', '', '', '', '', 24686.2, '2025-12-15', 0, 3),
(136, 4, 'Camisero Veneta Plus', '1,53', '125 gr', 'Poliester 85% Algodon 15%', '', '', 25100, '2026-02-02', 0, 3),
(137, 4, 'Dacron Danes Blanco ', '1,45', '110 Gr', '65%Poliester 35%Algodon ', '', '', 9130.66, '2026-01-22', 0, 27),
(138, 4, 'Dacron Danes Colores ', '1,45', '110 Gr', '65%Poliester 35%Algodon ', '', '', 10079.3, '2026-01-22', 0, 27),
(139, 4, 'Dacron Lombardy ', '1,5', '100 Gr ', '35%Algodòn- 65% Poliester Blanco', '', '', 7424, '2026-03-26', 0, 2),
(141, 4, 'Dacron Otoñal Solo Blanco ', '1,5', '125 Gr', '65%Poliester 35%Algodon ', '', '', 10079.3, '2026-01-22', 0, 27),
(143, 4, 'Oxford  32 ', '1,5', '150 Gr', '50%Algodon-50% Poliester  ', '', '', 11846.1, '2026-01-22', 0, 32),
(144, 4, 'Oxford ', '1,45', '130 Gr ', '100%Algodon', '', '', 9486.4, '2026-01-22', 0, 21),
(145, 4, 'Oxford 160 Pat Primo        ', '1,6', '150 Gr   ', '52%Algodon- 48% Poliester    ', '', '', 9990, '2026-02-04', 0, 13),
(146, 4, 'Oxford Aquiles', '1,45', '160 Gr', '60%Algodon - 40%Poliester', '', '', 9960.72, '2026-01-22', 0, 8),
(147, 4, 'Oxford Azul Ml Camisa Confeccionada', '', '', '', '', '', 38272.2, '2026-01-22', 0, 33),
(148, 4, 'Oxford Blanco 34 ', '1,55', '155 Gr', '50%Poliester - 50% Algodón', '', '', 11265.1, '2026-01-22', 0, 34),
(149, 4, 'Tela oxford blanco 66 ', '1,6', '', '55%Algodon - 45%Poliester ', '', '', 11534.6, '2026-01-22', 0, 16),
(150, 4, 'Oxford Blanco 46 ', '1,5', '', '', '', '', 0, '2026-01-22', 0, 31),
(151, 4, 'Oxford Blanco 35', '1,5', '165 Gr', '50% Poliester-50% Algodón ', '', '', 11739.4, '2026-01-22', 0, 35),
(152, 4, 'Oxford Nacional  Colores varios ', '1,6', '', '55% Algodón - 45%Poliester', '', '', 11700, '2026-02-04', 0, 16),
(153, 4, 'Oxford Colores 35 ', '1,5', '165 Gramos', '50% Poliester - 50% Algodón ', '', '', 12213.7, '2026-01-22', 0, 35),
(154, 4, 'Oxford Deluxe ', '1,42', '208 Gr', '68%Algodon - 32% Poliester ', '', '', 18970.6, '2026-01-22', 0, 14),
(155, 4, 'Oxford Gris 15', '1,6', '', '', '', '', 11739.4, '2026-01-22', 0, 15),
(156, 4, 'Oxford Magno 135 ', '1,5', '', '60% Algodón - 40% Poliester', '', '', 8893.5, '2026-01-22', 0, 8),
(157, 4, 'Oxford Manhattan ', '', '', '60%Algodòn - 40%Poliester', '', '', 14535.8, '2026-01-22', 0, 2),
(158, 4, 'Oxford ', '', '', '60%Algodòn - 40%Poliester', '', '', 13661.5, '2026-01-22', 0, 2),
(159, 4, 'Oxford Rayas 66 ', '1,6', '155 Gr', '50%Algodon - 50%Poliester', '', '', 14585.3, '2026-01-22', 0, 16),
(160, 4, 'Oxford Rayas 4 ', '1,5', '', '', '', '', 14258.7, '2026-01-22', 0, 4),
(161, 4, 'Oxford Superoxford ', '1,5', '160 Gr', '60% Algodon-40% Poliester ', '', '', 11345, '2026-03-11', 0, 4),
(162, 4, 'Oxford Unioffice ', '1,6', '163 Gr', '62% Algodón - 38% Poliester', '', '', 13518.1, '2026-01-22', 0, 8),
(163, 4, 'Oxoford Azul Y Blanca Mc Confeccionada', '', '', '', '', '', 39859.1, '2026-01-22', 0, 36),
(164, 4, 'Oxoford 32 ', '1,5', '150 Gr ', '50% poliester - 50% Algodón ', '', '', 13031.9, '2026-01-22', 0, 32),
(165, 5, 'Camisero Spandex Atina ', '1,46', '116 Gr', '93%Poliester -7%Spandex ', '', '', 9249.24, '2026-01-22', 0, 21),
(166, 5, 'Camisero Strech Bershka ', '', '', '97%Algodon - 3%Spandex', '', '', 12213.7, '2026-01-22', 0, 24),
(167, 5, 'Camisero Strech Isabel ', '', '132 Gr', '92%Poliester - 8%Spandex ', '', '', 10079.3, '2026-01-22', 0, 29),
(168, 5, 'Camisero Strech Marcel Lycra', '1,5', '', '', '', '', 31046.4, '2025-12-15', 0, 3),
(169, 5, 'Camisero Strech Marcel Lycra Est', '1,5', '', '', '', '', 34927.2, '2025-12-15', 0, 3),
(170, 5, 'Camisero Strech Monet Lycra', '1,54', '', '', '', '', 28674.8, '2025-12-15', 0, 3),
(171, 5, 'Camisero Strech Popelina ', '', '', '97%Algodon - 3% Lycra', '', '', 9865.86, '2026-01-22', 0, 4),
(172, 5, 'Camisero Strech Popelina Dubay ', '1,45', '125 Gr  ', '97%Algodon - 3 %Spandex', '', '', 10672.2, '2026-01-22', 0, 16),
(173, 5, 'Camisero Strech Popelina Pera ', '', '', '97%Algodon - 3%Spandex', '', '', 10079.3, '2026-01-22', 0, 26),
(174, 5, 'Camisero Strech Popelina Santana', '', '', '', '', '', 7589.12, '2026-01-22', 0, 2),
(175, 5, 'Camisero Strech Popelina Uniklo', '1.60', '125 gr', 'Algodon 96% Spandex 4%', '', '', 14542.2, '2026-01-22', 0, 13),
(176, 5, 'Camisero Strech Popelina Victoria ', '1,45', '115 Gr', '97%Algodon - 3%Spandex', '', '', 9604.98, '2026-01-22', 0, 30),
(177, 5, 'Camisero Strech Rafael Lycra ', '1,5', '', '', '', '', 22530.2, '2026-01-22', 0, 20),
(178, 5, 'Camisero Strech Rosella Lycra', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(179, 5, 'Camisero Strech Rosella Lycra Estampado', '1,5', '', '', '', '', 30309, '2025-12-15', 0, 3),
(180, 5, 'Camisero Strech Skikda ', '', '', '92%Poliester - 8%Eslastomero', '', '', 7944.86, '2026-01-22', 0, 24),
(181, 6, 'Dacron 205 Plus ', '1,48', '115 Gr', '80%Poliester-20%Algodon ', '', '', 8893.5, '2026-01-22', 0, 8),
(182, 6, 'Dacron Chino Blanco 9', '', '', '', '', '', 5519.36, '2026-01-22', 0, 9),
(183, 6, 'Dacron Chino Blanco Toptex', '', '', '', '', '', 3675.98, '2026-01-22', 0, 35),
(184, 6, 'Dacron Chino Colores  ', '1,5', '', '80%Poliester-20% Algodón ', '', '', 4528.68, '2026-01-22', 0, 1),
(185, 6, 'Dacron Chino Colores Toptex', '', '', '', '', '', 4150.3, '2026-01-22', 0, 35),
(186, 6, 'Dacron Colores 5 ', '1,5', '90 Gr', '90%Poliester -10% Algodón  ', '', '', 6640.48, '2026-01-22', 0, 27),
(187, 6, 'Dacron Hidalgo Solo Blanco', '1,45', '', '', '', '', 5454.68, '2026-01-22', 0, 27),
(188, 6, 'Dacron S/F  camisero Seg.Nac', '1,5', '', '94% pol 6% Algodon ', '', '', 5500, '2026-02-03', 0, 63),
(189, 6, 'Dacron Marques ', '1,45', '', 'AnchoSolo Blanco 90%Poliester - 10%Algodon', '', '', 5929, '2026-01-22', 0, 27),
(190, 6, 'Dacron Perla Blanca ', '', '', '90% Pol-10% Alg Econòmica', '', '', 3913.14, '2026-01-22', 0, 2),
(191, 6, 'Dacron Popelina Diana ', '', '', '50 poliester - 50 algodón ', '', '', 12332.3, '2026-01-22', 0, 34),
(192, 6, 'Dacron Popelina Superior Blanca ', '1,48', '', '', '', '', 6581.19, '2026-01-22', 0, 9),
(193, 6, 'Dacron Popelina Blanca', '1,48', '', '', '', '', 9467, '2026-01-22', 0, 45),
(194, 7, 'En Este Moento No Tiene Pcc', '', '', '', '', '', 0, '2026-01-22', 0, 37),
(195, 7, 'Impermeabble Chaqueta Pantalon, Calibre 18 Color Azul Y Negro, Reflectivo Solo En Espalda De Chaqueta', '', '', '', '', '', 0, '2026-01-22', 0, 38),
(196, 7, 'Impermeable Chaqueta Pantalon Zapatones Y Bolso Calibre 18 Color Azul Y Negro, Reflectivo Solo En Espalda De Chaqueta', '', '', '', '', '', 0, '2026-01-22', 0, 38),
(197, 7, 'Impermeable Conjunto Negro Cinta Reflectiva En Espalda Manga Y Bota De 2 Chaqueta Pantalon Calibre 18 Talla S A Xl', '', '', '', '', '', 69930.9, '2026-01-22', 0, 39),
(198, 7, 'Impermeable Conjunto Negro Talla Xl C/Reflectivo, Cierre Velcro Y Cremallera Con Bolso Y Zapatones Cal-16', '', '', '', '', '', 76839.8, '2026-01-22', 0, 19),
(199, 7, 'Impermeable Conjunto Pantalón Y Chaqueta. En Color Amarillo Y Negro, De Las Talla M A La Xl', '', '', '', '', '', 45060.4, '2026-01-22', 0, 40),
(200, 7, 'Impermeable Pantalon Y Chqueta Sin Botas Ni Bolsito A 60.000 Hasta La Talla Xl Azul Y Negro Con Reflectivo 1 Linea En Bota Y Espalda', '', '', '', '', '', 59788, '2026-01-22', 0, 41),
(201, 7, 'Ref 505-20 Conjunto, Chaqueta Cierre Velcro Y Cremallera, Pantalón Con Resorte, Zapaton Con Suela Y Estuche Cargador (Calibre 16, Una Franja De Reflectivo De 1 En Manga De La Chaqueta, Bota Del Pantalón Y Espalda)', '', '', '', '', '', 55881.4, '2026-01-22', 0, 42),
(202, 7, 'Ref 605-18 Conjunto, Chaqueta Cierre Velcro Y Cremallera, Pantalón Con Resorte, Zapaton Con Suela Y Estuche Cargador (Calibre 18, Una Franja De Reflectivo De 1 En Manga De La Chaqueta, Bota Del Pantalón Y Espalda) ', '', '', '', '', '', 58258.4, '2026-01-22', 0, 42),
(203, 8, 'Fleece Alpaca ', '1,5', '200 Gr', '', '', '', 15984.6, '2026-01-22', 0, 43),
(204, 8, 'Fleece Polo Norte', '1,5', '230 Gr', '', '', '', 13636.7, '2026-01-22', 0, 43),
(205, 8, 'Fleece Suave Star ', '1,5', '128 Gr ', '100% Poliester ', '', '', 9058.43, '2026-01-22', 0, 13),
(206, 8, 'Fleece Super Fleeese', '', '', '', '', '', 10761.7, '2026-01-22', 0, 44),
(207, 9, 'Deportiva Atletica Activa ', '1,6', '140 Gr ', '100%Poliester Strech Mecanico Rendimiento 4,6', '', '', 3841.99, '2026-01-22', 0, 8),
(208, 9, 'Deportiva Bahhia 1.56', '1.56', '212', '80%Poliester -20% lycra', '', '', 29900, '2026-03-12', 0, 3),
(209, 9, 'Deportiva Bosstex Sec ', '', '', '100% Poliester', '', '', 7944.86, '2026-01-22', 0, 17),
(210, 9, 'Deportiva Dual', '1,57', '', '', '', '', 21290.5, '2025-12-15', 0, 3),
(211, 9, 'Deportiva Dunga Sec ', '1,5', '', '', '', '', 5767.3, '2026-01-22', 0, 13),
(212, 9, 'Deportiva Hydrotech ', '1,5', '', '', '', '', 18500, '2026-02-23', 0, 3),
(213, 9, 'Deportiva Hydrotech Antibact', '1,47', '', '', '', '', 19673.5, '2025-12-15', 0, 3),
(214, 9, 'Deportiva Hydrotech Reciclado Antibacterial ', '1,5', '', '100% POLIESTER', '', '', 19673.5, '2025-12-15', 0, 3),
(215, 9, 'Deportiva Megafil Sec ', '1,5', '', '', '', '', 6391.46, '2026-01-22', 0, 13),
(216, 9, 'Deportiva Montecarmelo ', '', '155 Gr  ', 'Poliéster 100% Microfibra ', '', '', 6166.16, '2026-01-22', 0, 51),
(217, 9, 'Deportiva Montesimone Reciclado', '', '', '', '', '', 22691.9, '2025-12-15', 0, 3),
(218, 9, 'Deportiva Montesimone', '1,52', '134', '100% POLIESTER', '', '', 23150, '2026-03-12', 0, 3),
(219, 9, 'Deportiva Paraiso ', '', '139 Gr  ', '100%Poliester ', '', '', 5276.81, '2026-01-22', 0, 51),
(220, 9, 'Deportiva Sportwear (Sudafrica) ', '1,55', '120 Gr', '100%Poliester ', '', '', 7707.7, '2026-01-22', 0, 27),
(221, 9, 'Deportiva Sudafrica ', '1,5', ' 145 Gr', '100%Poliester', '', '', 8644.48, '2026-01-22', 0, 17),
(222, 9, 'Deportiva Stamina', '1,48', '', '', '', '', 24847.9, '2025-12-15', 0, 3),
(223, 9, 'Deportiva Stepway', '1,7', '245 Gr', '92% Poliester 8% lycra ', '', '', 33150, '2026-03-12', 0, 3),
(224, 9, 'Deportiva Zanetti ', '1,73', '143', '100% POLIESTER', '', '', 20800, '2026-03-12', 0, 3),
(225, 10, 'Dril Borneo Plus segunda opcion  (Oriòn) ', '1,5', '230 Gr', '65% Poliester - 35%Algodon ', '', '', 9691.22, '2026-01-22', 0, 8),
(226, 10, 'Dril Cìtrico (Gabardina)', '', '', '', '', '', 13636.7, '2026-01-22', 0, 26),
(227, 10, 'Dril Malpelo ', '1,4', '240 Gr', '65% Poliester -35%Algodon ', '', '', 11265.1, '2026-01-22', 0, 34),
(228, 10, 'Dril Noruego (Chefs-Medicos) ', '1,5', '190 Gr', '80% Poliester - 20%Algodon', '', '', 10079.3, '2026-01-22', 0, 8),
(229, 10, 'Dril Orion ', '1,5', '240 Gr   ', '65% Poliester-35%Algodòn ', '', '', 9676, '2026-04-18', 0, 2),
(230, 10, 'Dril Orion 15 ', '1,5', '240 Gr', '65% Poliester-35%Algodòn ', '', '', 13769.3, '2026-01-22', 0, 15),
(231, 10, 'Dril Pocker ', '', '', '', '', '', 13992.4, '2026-01-22', 0, 9),
(232, 10, 'Dril Qatar', '1,5', '', '', '', '', 21750, '2026-02-19', 0, 3),
(233, 10, 'Dril Santafe textilera ', '1,5', '245 Gr', '65% Poliester - 35%Algodon. ', '', '', 10840, '2026-02-24', 0, 4),
(235, 10, 'Dril Universal Ecologico 32 ', '1,6', '220 Gr', '70% Algodòn - 30% Polies Reciclado ', '', '', 0, '2026-01-22', 0, 32),
(236, 11, 'Dril A100 MAX ', '1,6', '260 Gr', '100% Algodòn Colorante Reactivo ', '', '', 16723, '2026-03-19', 0, 4),
(237, 11, 'Dril Activo 32 ', '1,6', '250 Gr', '100% Algodón Colorante Reactivo Alta Fijacion ', '', '', 0.7, '2026-01-30', 0, 32),
(239, 11, 'Dril Apolo Colorante Reactivo Alta Fijacion ', '1,6', '7,4 Onz', '100% Algodón ', '', '', 18854.2, '2026-01-22', 0, 34),
(240, 11, 'Dril Espartano  Colorante Quimico Reactivo', '1,6', '265 Gr', '100%Algodon ', '', '', 16126.9, '2026-01-22', 0, 8),
(242, 11, 'Dril Forza ', '1,5', '220 Gr ', '35% Algodón / 65% Poliéster ', '', '', 12521, '2026-02-18', 0, 4),
(243, 11, 'Dril Forza', '1,5', '278', '100 % Algodon', '', '', 25800, '2026-02-18', 0, 3),
(244, 11, 'Dril Frutal', '1,67', '7,8 Onzas ', '100% Algodòn Blanco', '', '', 15296.8, '2026-01-22', 0, 26),
(245, 11, 'Dril Frutal Colores', '1,67', '7,8 Onzas ', '100% Algodòn ', '', '', 9711.7, '2026-01-22', 0, 26),
(246, 11, 'Dril Goliat  Reactivo Quimico No Tina,', '1,68', '7,4 Onz', '100% Algodon', '', '', 19429.9, '2026-01-22', 0, 46),
(247, 11, 'Dril Goliat Por Metro  Reactivo Quimico No Tina', '1,68', '7,4 Onz', '100% Algodon', '', '', 21702.3, '2026-01-22', 0, 46),
(248, 11, 'Dril Goliat  Reactivo Quimico No Tina', '1,68', '7,4 Onz', '100% Algodon', '', '', 19328.5, '2026-01-22', 0, 9),
(249, 11, 'Dril Hercules  Con Colorante Tina Medios', '1,58', '8 Onz 260 G', '100% Algodón', '', '', 12621, '2026-02-06', 0, 8),
(251, 11, 'Dril Kael  Sin Colorante Tina ', '1,6', '250 Gr', '100% Algodón', '', '', 18727, '2026-03-26', 0, 2),
(252, 11, 'Dril Kratos  ', '1,6', '', '100% Algodón', '', '', 12450.9, '2026-01-22', 0, 9),
(253, 11, 'Dril Nadal  Sin Colorante Tina', '1,6', '', '100% Algodón', '', '', 15300, '2026-03-26', 0, 16),
(254, 11, 'Dril Pegasso Medios Colorante Tina, Pelicula Anticloro, Proteccion Uv ', '1,68', '7,4 Onzas', '100% Algodón', '', '', 19404, '2026-01-22', 0, 34),
(255, 11, 'Dril Pegasso Oscuros Colorante Tina, Pelicula Anticloro, Proteccion Uv', '1,68', '7,4 Onzas', '100% Algodón', '', '', 19404, '2026-01-22', 0, 34),
(256, 11, 'Dril Raza  ', '1,6', '', '100% Algodòn', '', '', 14009.7, '2026-01-22', 0, 9),
(257, 11, 'Dril Raza Azteca  Colorante Tina ', '1,6', '275 Gr', '100% Algodòn', '', '', 20348.3, '2026-01-22', 0, 32),
(258, 11, 'Dril Raza Detal  Colorante Tina', '1,6', '2,15 Gr 7,6 Onzas', '100% Algodòn   ', '', '', 22719.9, '2026-01-22', 0, 44),
(259, 11, 'Dril Uniextrom ', '1,6', '250 Gr', '65%Algodon - 35%Poliester ', '', '', 11383.7, '2026-01-22', 0, 8),
(260, 11, 'Dril Universo 32  Colorante Tina', '1,6', '250 Gr', '100% Algodòn ', '', '', 17668.4, '2026-01-22', 0, 32),
(262, 11, 'Dril Vulcano O Activo  Con Colorante Reactivo Alta Fijacion', '1,6', '250 Gr', '100% Algodon', '', '', 18901, '2026-01-30', 0, 32),
(263, 11, 'Dril Rip Stop A r', '1,5', '185 Gr', '35% Algodón / 65% Poliéste', '', '', 15444.5, '2026-01-22', 0, 4),
(264, 12, 'Dril Sapndex Austin ', '1,6', '', '97% Algodón 3% Elastomero ', '', '', 19553.8, '2026-01-22', 0, 24),
(265, 12, 'Dril Spandex Espiga ', '1,57', '8 Onz ', '98 Algodo 2%Spadex ', '', '', 20040, '2026-01-22', 0, 26),
(267, 12, 'Dril Spandex Asuncion ', '1,6', '', '97% Algodón - 3% Elastomero', '', '', 21099.7, '2026-01-22', 0, 2),
(268, 12, 'Dril Spandex Avatar Flex', '1,6', '255 Gr 7,5onz', ' 98% Algodon 2% Spandex ', '', '', 22411.6, '2026-01-22', 0, 7),
(269, 12, 'Dril Spandex Biscaia ', '1,55', '6,4 Onzas ', '', '', '', 15534, '2026-01-22', 0, 8),
(270, 12, 'Dril Spandex Everest ', '1,6', '224 Gr', '97,5% - Algodón 2,5 % Elastomero  ', '', '', 19943, '2026-01-22', 0, 16),
(271, 12, 'Dril Spandex Everest Detal', '', '', '', '', '', 26405.6, '2026-01-22', 0, 15),
(272, 12, 'Dril Spandex Lenovoflex Elit  ', '1,4', '220 Gr', '59% Algodón -38%Poliester -3%Spandex', '', '', 11990, '2026-04-01', 0, 13),
(273, 12, 'Dril Spandex Lenovoflex Gold ', '1,4', '210 Gr', '59% Algodon - 38%Poliester - 3%Spandex ', '', '', 12990, '2026-04-01', 0, 13),
(274, 12, 'Dril Spandex Lisboa', '1,5', '260 Gr', '95% Algodon-5% Lycra', '', '', 19829.8, '2026-01-22', 0, 4),
(275, 12, 'Dril Spandex Liverpool', '', '', '', '', '', 0, '2026-01-22', 0, 47),
(276, 12, 'Dril Spandex Monserrate', '1,6', '265 Gr', '97,5% Algodon-2,5% Spandex', '', '', 16900.6, '2026-01-30', 0, 16),
(277, 12, 'Dril Spandex Moon ', '1,55', '198 Gr 7onz ', '98% Algodón -2% spandex', '', '', 16008.3, '2026-01-22', 0, 8),
(278, 12, 'Dril Spandex New Orleans', '', '', '', '', '', 0, '2026-01-22', 0, 47),
(279, 12, 'Dril Spandex Nouvelle - Delgado', '1,4', '216 Gr', '97% Algodón - 3% Spandex', '', '', 18368, '2026-01-22', 0, 13),
(280, 12, 'Dril Spandex Otawa ', '1,47', '', '98,66% Algodón 1,34%Spandex', '', '', 17182.2, '2026-01-22', 0, 48),
(281, 12, 'Dril Spandex Phoebe ', '1,44', 'Gr 7,3 Onz', '98%Algodon-2%Spandex ', '', '', 18854.2, '2026-01-22', 0, 7),
(282, 12, 'Dril Spandex Royal ', '1,5', '6,5 Onz', '97% Algodón - 3% Spandex, ', '', '', 18960.9, '2026-01-22', 0, 13),
(283, 12, 'Dril Spandex Star', '', '', '', '', '', 15800, '2026-02-19', 0, 8),
(284, 12, 'Dril Spandex Sun', '', '', '', '', '', 15652.6, '2026-01-22', 0, 8),
(285, 12, 'Dril Spandex Versalles 2 ', '1,5', '218 Gr', '98%Algod-2%Elastomero ', '', '', 20875.5, '2026-01-22', 0, 2),
(286, 12, 'Dril Star ', '', '7,5 Onza', '98% Alg-2 Span ', '', '', 15800, '2026-02-19', 0, 8),
(287, 13, 'Forro Vaskanit ', '1,55', '110 Gr', '100% Poliester', '', '', 4387.46, '2026-01-22', 0, 5),
(288, 13, 'Forro Brioni', '1,5', '', '', '', '', 20535.9, '2025-12-15', 0, 3),
(289, 13, 'Forro Briony Ancho ', '1,5', '', '', '', '', 3853.85, '2026-01-22', 0, 2),
(290, 13, 'Forro Briony 1 Ancho ', '1,5', '', '', '', '', 2291.83, '2026-01-22', 0, 1),
(291, 13, 'Forro Margaret Db ', '1,47', '120 Gr', '100%Poliester', '', '', 8288.74, '2026-01-22', 0, 43),
(292, 13, 'Forro Miami', '1,5', '', '', '', '', 12235.3, '2025-12-15', 0, 3),
(293, 13, 'Forro Michigan', '1,5', '', '', '', '', 15577.1, '2025-12-15', 0, 3),
(294, 13, 'Forro Microtitan', '1,48', '', '', '', '', 28674.8, '2025-12-15', 0, 3),
(295, 13, 'Forro Tafeta', '1,5', '', '', '', '', 2291.83, '2026-01-22', 0, 1),
(296, 13, 'Forro Uruguay ', '1,5', '110 Gr Kilo Rendimiento 6', '94,2 Polliester - 5,8 Elastano ', '', '', 8656.34, '2026-01-22', 0, 43),
(297, 14, 'Franela Barcelona (Tenemos Muestra)  ', '1,6', '150 Gramos', 'Poliester 65% -Algodón 35%,', '', '', 0, '2026-01-22', 0, 49),
(298, 14, 'Franela Barcelona (Tenemos Muestra)  Puede Homologar La Hamburgo', '1,6', '150 Gr', 'Poliester 65% -Algodón 35%', '', '', 0, '2026-01-22', 0, 49),
(299, 14, 'Franela Bavara', '', '', '', '', '', 10778.9, '2026-01-22', 0, 9),
(300, 14, 'Franela Bavara (Malagueña) ', '1,68', '190 Gr', '65%Poliester - 35% Algodón  ', '', '', 16242.2, '2026-01-22', 0, 50),
(301, 14, 'Franela Bavara 34', '1,7', '', '', '', '', 11858, '2026-01-22', 0, 34),
(302, 14, 'Franela Bavara Classic Blanco ', '1,8', '', '50% poliester - 50% Algodon ', '', '', 15640.7, '2026-01-22', 0, 16),
(303, 14, 'Franela Bavara Classic Claros ', '1,8', '', '50% poliester - 50% Algodon ', '', '', 16826.5, '2026-01-22', 0, 16),
(304, 14, 'Franela Bavara Classic Oscuros', '1,8', '', '50% Poleste - 50% Algodón  ', '', '', 18166.5, '2026-01-22', 0, 16),
(305, 14, 'Franela Bavaria Blancos', '1,8', '205 Gr Rend 2,71', '50%Poliester-50%Algodon', '', '', 16873.9, '2026-01-22', 0, 43),
(306, 14, 'Franela Bavaria  ', '1,8', '205 Gr Rend 2,71 Claro', '50%Poliester-50%Algodon ', '', '', 18913.5, '2026-01-22', 0, 43),
(307, 14, 'Franela Bavaria   Oscuros', '1,8', '205 Gr Rend 2,71', '50%Poliester-50%Algodon', '', '', 21795, '2026-01-22', 0, 43),
(308, 14, 'Franela Baviera Colores varios ', '1,7', '190 Gr', '65%Poliester-35%Algodon', '', '', 8800, '2026-02-16', 0, 51),
(310, 14, 'Franela Centauro ', '1,6', 'Rendimiento 3,5 - Minimo 3 Kil', '93%Algodon- 7%Spandex Algodón Peinado ', '', '', 14225.3, '2026-01-22', 0, 13),
(311, 14, 'Franela Danesa ', '1,46', '166 Gr', '65%Poliester -35% Algodón ', '', '', 10541.8, '2026-01-22', 0, 13),
(312, 14, 'Franela Escandinava Claros  Carga Min 580 Mts Por Color', '1,75', '155 Gr ', '100% Algodón Peinado', '', '', 13992.4, '2026-01-22', 0, 51),
(313, 14, 'Franela Escandinava Oscuros  Carga Min 580 Mts Por Color', '1,75', '155 Gr', '100% Algodón Peinado', '', '', 16008.3, '2026-01-22', 0, 51),
(314, 14, 'Franela Fria Peach, Kiwi', '', '', '', '', '', 0, '2026-01-22', 0, 14),
(315, 14, 'Franela Gold ', '1,6', '130 Gr', '95% Poliester-5% Spandex ', '', '', 5826.59, '2026-01-22', 0, 8),
(316, 14, 'Franela Hamburgo Rigida Color ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó', '', '', 13743.4, '2026-01-22', 0, 16),
(317, 14, 'Franela Hamburgo Rigida Blanco ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó ', '', '', 12925.2, '2026-01-22', 0, 16),
(318, 14, 'Franela Hamburgo Suave Blanco ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó ', '', '', 13518.1, '2026-01-22', 0, 16),
(319, 14, 'Franela Hamburgo Suave Color ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó', '', '', 15083.4, '2026-01-22', 0, 16),
(320, 14, 'Franela Harriet ', '1,7', '240 Gr', '100% Algodón ', '', '', 19553.8, '2026-01-22', 0, 13),
(321, 14, 'Franela Jeremy ', '1,8', '180 Gr', '100% Algodón ', '', '', 16589.3, '2026-01-22', 0, 13),
(322, 14, 'Franela Jersey Supergaroto Silk  Encogim 3% Tintura A Partir 1000 Metros', '1,55', '150 Gr', '100% Algodón', '', '', 14217.7, '2026-01-22', 0, 13),
(323, 14, 'Franela Minotauro ', '1,6', '', 'Algodón + Spandex', '', '', 13518.1, '2026-01-22', 0, 13),
(324, 14, 'Franela Nevada ', '1,8', '192 Gr', '65%Pol-35%Alg', '', '', 8419.18, '2026-01-22', 0, 30),
(325, 14, 'Franela Topacio Claros (Parecida A La Bavara)  s Encog 3% Tintura A Partir 800 Mts', '1,6', '180 Gr', '65%Poliester-35%Algodon ', '', '', 10304.6, '2026-01-22', 0, 13),
(326, 14, 'Franela Topacio Oscuros Y Gj(Parecida A La Bavara)   Encog 3% Tintura A Partir 800 Mts', '1,6', '180 Gr', '65%Poliester-35%Algodon', '', '', 11490.4, '2026-01-22', 0, 13),
(327, 15, 'Gorra Beisbolera Hebilla Metalica Al Por Mayor', '', '', '', '', '', 7007, '2026-01-22', 0, 52),
(328, 15, 'Gorra Tipo Chavo Dril Azul Oscuro A Partir 12 Unidades', '', '', '', '', '', 8605.67, '2026-01-22', 0, 52),
(329, 16, 'Ignifgas Ultra Soft ', '1,6', '7 oz', '', '', '', 82520.9, '2025-12-15', 0, 3),
(330, 16, 'Ignifugas Dh ', '1,55', '6,5 oz', '', '', '', 109805, '2025-12-15', 0, 3),
(331, 16, 'Ignifugas Indigo ', '1,7', '14 oz', '', '', '', 90061.5, '2025-12-15', 0, 3),
(332, 16, 'Ignifugas Indura ', '1,6', '7 oz', '', '', '', 67750, '2026-02-19', 0, 3),
(333, 16, 'Ignifugas Indura ', '1,6', '9 oz', '', '', '', 0, '2026-02-19', 0, 3),
(334, 16, 'Ignifugas Ultra Soft ', '1,6', '9 oz', '', '', '', 113481, '2025-12-15', 0, 3),
(335, 16, 'Ignifugas Ultra Soft Rib ', '1,45', '10 oz', '', '', '', 228089, '2025-12-15', 0, 3),
(336, 17, 'Impermeable Campero LM 100% pol 1.50 anch ', '1.50', '201 gr', '100% Poliester ', '', '', 32950, '2026-04-17', 0, 3),
(337, 17, 'Impermeable Branta', '1,47', '', '', '', '', 51744, '2025-12-15', 0, 3),
(338, 17, 'Impermeable Cerrusport', '1,5', '', '', '', '', 34927.2, '2025-12-15', 0, 3),
(339, 17, 'Impermeable Gavia', '1,49', '', '', '', '', 0, '2025-12-15', 0, 3),
(340, 17, 'Impermeable Glou Crushed', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(341, 17, 'Impermeable Gorek Alta Visibilidad ', '1,5', '138gr', '100% POLIESTER', '', '', 20650, '2026-03-25', 0, 3),
(342, 17, 'Impermeable Gorek', '1,5', '138gr', '100% POLIESTER', '', '', 20428.1, '2025-12-15', 0, 3),
(343, 17, 'Impermeable Kasac ', '1,5', '', '', '', '', 22152.9, '2025-12-15', 0, 3),
(344, 17, 'Impermeable Orion Cloro Resistente', '1.68', '113', '100% POLIESTER', '', '', 24200, '2026-02-26', 0, 3),
(345, 17, 'Impermeable Orion Stretch', '1,7', '', '', '', '', 25950, '2026-02-11', 0, 3),
(346, 17, 'Impermeable Tempestad Alta Visibilidad Evolut', '1,5', '', '', '', '', 34280.4, '2025-12-15', 0, 3),
(347, 17, 'Impermeable Tempestad', '1,5', '', '', '', '', 28567, '2025-12-15', 0, 3),
(348, 17, 'Impermeable Top Gun ', '1,5', '', '', '', '', 35804.7, '2025-12-15', 0, 3),
(349, 17, 'Impermeable Top Gun Alta Visibilidad ', '1,51', '', '', '', '', 38808, '2025-12-15', 0, 3),
(350, 17, 'Impermeable Tormenta Homologa El Tempestad De 3', '1,51', '', '', '', '', 19802.9, '2026-01-22', 0, 10),
(351, 17, 'Impermeable Vendaval ', '1,5', '', '', '', '', 23265.4, '2025-12-15', 0, 3),
(352, 17, 'Impermeable Vendaval Cloro Resitente', '1,5', '', '', '', '', 23500.4, '2025-12-15', 0, 3),
(353, 17, 'Impermeable Vendaval Crushed', '1,5', '', '', '', '', 25386.9, '2025-12-15', 0, 3),
(354, 18, 'Indigo Avila Viscosa ', '1,67', 'Pesos 10 Oz', '31,5%Pol-62%Algo-6,5% ', '', '', 14715.8, '2026-01-22', 0, 2),
(356, 18, 'Indigo  Apolo 2 pago contado', '1,70', '12.5 Oz', '100% Algodón', '', '', 11200, '2026-02-24', 0, 8),
(357, 19, 'Indigo Nuevo Romano   1metro 15546', '1,68', '7 Oz', '', '', '', 12605, '2026-02-27', 0, 31),
(358, 19, 'Indigo Twill   ', '1,8', '5,5 oz', '100% Algodón', '', '', 16601.2, '2026-01-22', 0, 16),
(359, 19, 'Indigo Twill Corsega  ', '1,5', '4,5 Oz', '100% Algodòn', '', '', 12557.6, '2026-01-22', 0, 16),
(360, 19, 'Indigo Camisa Indigo ', '', '7 Oz', '', '', '', 23597.4, '2026-01-22', 0, 54),
(361, 19, 'Indigo Camisero ', '1,7', '4 ,1 Oz ', '100% Algodón ', '', '', 21344.4, '2026-01-22', 0, 31),
(362, 19, 'Indigo Camisero 1969  ', '1,7', '10 Oz', '100% Algodón', '', '', 19328.5, '2026-01-22', 0, 2),
(363, 19, 'Indigo Camisero ', '1,7', '5 Oz', '', '', '', 19210, '2026-01-22', 0, 31),
(364, 19, 'Indigo Camisero  ', '1,5', '6,8 Oz', '100% Algodón', '', '', 11146.5, '2026-01-22', 0, 16),
(365, 19, 'Indigo Camisero ', '1,7', '9,5 Oz ', '70%Algod-28% Poliester- 2 Elastano ', '', '', 22411.6, '2026-01-22', 0, 31),
(366, 19, 'Indigo Camisero ', '1,63', '5 Oz', '70%Algod-30% Poliester  ', '', '', 19210, '2026-01-22', 0, 31),
(367, 19, 'Indigo Camisero America ', '1,67', '7 Oz', '100% Algodon', '', '', 16025.5, '2026-01-22', 0, 2),
(368, 19, 'Indigo Camisero Arles ', '1,5', '8,5 Oz', 'Comp Algodón + Poliester + Lycra', '', '', 15415.4, '2026-01-22', 0, 2),
(369, 19, 'Indigo Camisero Atenea ', '', '6 Oz', '100% Algodón ', '', '', 0, '2026-01-22', 0, 8),
(370, 19, 'Indigo Camisero Claire ', '1,7', '7 Oz ', '', '', '', 13755.3, '2026-01-22', 0, 55),
(371, 19, 'Indigo Camisero Latino ', '', '7 Oz ', '100% Algodón 1,70 Ancho', '', '', 12332.3, '2026-01-22', 0, 8),
(372, 19, 'Indigo Camisero Michigan ', '1,7', '5,3 Oz', '100% Algodón ', '', '', 13518.1, '2026-01-22', 0, 56),
(373, 19, 'Indigo Camisero Mucura ', '1,6', '10,4 Oz ', '100% Algodón ', '', '', 22411.6, '2026-01-22', 0, 31),
(374, 19, 'Indigo Camisero Pandora    0% Encogimiento', '1,7', '7 Oz', '100% Algodón', '', '', 0, '2026-01-22', 0, 8),
(375, 20, 'Indigo ', '', '', '', '', '', 17431.3, '2026-01-22', 0, 34),
(376, 20, 'Indigo Chronos ', '1,7', '13 Oz ', '80% Algodón -20%Poliester ', '', '', 13992.4, '2026-01-22', 0, 8),
(377, 20, 'Indigo ', '', '12 Oz', '100% Algodón  ', '', '', 15356.1, '2026-01-22', 0, 57),
(378, 20, 'Indigo 13 Onz Peso ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 17957.3, '2026-01-22', 0, 55),
(379, 20, 'Indigo Alfa ', '1,67', '12,8 Oz  ', '90%Algodon - 10% Poliester ', '', '', 17300.8, '2026-01-22', 0, 32),
(380, 20, 'Indigo Apolo 2 ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 14553, '2026-01-22', 0, 2),
(381, 20, 'Indigo Apolo 2 ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 11700, '2026-02-20', 0, 8),
(382, 20, 'Indigo Coloso ', '1,7', '13,75 Oz ', '100% Algodón ', '', '', 17609.1, '2026-01-22', 0, 8),
(383, 20, 'Indigo Dallas ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 19349, '2026-01-22', 0, 2),
(384, 20, 'Indigo Damasco ', '1,7', '13.5 Oz ', '', '', '', 18617.1, '2026-01-22', 0, 58),
(385, 20, 'Indigo Denver ', '1,69', '13,5 Oz ', '100% Algodón ', '', '', 21381.1, '2026-01-22', 0, 2),
(386, 20, 'Indigo Detroit ', '1,7', '13,75 Oz ', '100% Algodón ', '', '', 17668.4, '2026-01-22', 0, 53),
(387, 20, 'Indigo Inti ', '1,7', '12 Oz  ', '27%Poliester - 61%Algodon - 12%Viscosa ', '', '', 16025.5, '2026-01-22', 0, 2),
(388, 20, 'Indigo Lemmon ', '1,68', '12,5 Oz ', '100%Algodon', '', '', 11383.7, '2026-01-22', 0, 26),
(389, 20, 'Indigo Marvel ', '1,7', '13 Oz ', '100% Algodón ', '', '', 16838.4, '2026-01-22', 0, 34),
(390, 20, 'Indigo Super Inti ', '1,7', '12 Oz  ', '34%Poliester - 53%Algodon - 13%Rayon ', '', '', 16177.5, '2026-01-22', 0, 2),
(391, 20, 'Indigo Tazmania ', '1,7', '12 Oz ', '', '', '', 12289.2, '2026-01-22', 0, 57),
(392, 20, 'Indigo Tera ', '1,7', '13,5 Oz ', '100% Algodón ', '', '', 17312.7, '2026-01-22', 0, 9),
(393, 20, 'Indigo Texano ', '1,69', '12,5 Oz ', '100% Algodón ', '', '', 19349, '2026-01-22', 0, 2),
(394, 20, 'Indigo Tronic Delta ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 19565.7, '2026-01-22', 0, 9),
(395, 20, 'Indigo Tronic ', '1,7', '12,5 Oz', '100% Algodón ', '', '', 18735.6, '2026-01-22', 0, 9),
(396, 20, 'Indigo Tundra ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 17668.4, '2026-01-22', 0, 53),
(397, 20, 'Indigo Venecia ', '1,75', '13 Oz ', '100% Algodón ', '', '', 14229.6, '2026-01-22', 0, 56),
(398, 20, 'Indigo Vesubio ', '1,68', '13 Oz ', '100% Algodón Recilado ', '', '', 18854.2, '2026-01-22', 0, 34),
(399, 20, 'Indigo Vesubio Fabricato  ', '1,7', '12,6 Oz ', '100% Algodón', '', '', 17075.5, '2026-01-22', 0, 16),
(400, 20, 'Indigo Zeus  ', '1,7', '13,75 Oz ', '100% Algodón  ', '', '', 16482.6, '2026-01-22', 0, 2),
(401, 20, 'Indigo ', '1,7', '12,75 Oz', '100% Algodón ', '', '', 16018, '2026-01-22', 0, 26),
(402, 21, 'Indigo Bybury ', '1,84', '9,5 Oz ', 'Alg-Spandex', '', '', 12251.5, '2026-01-22', 0, 2),
(403, 21, 'Indigo Finlandia ', '1,33', '', '65% Algodon - 31%Poliester - 4% Lycra ', '', '', 13399.5, '2026-01-22', 0, 56),
(404, 21, 'Indigo Gènesis ', '1,6', '11,3 Oz ', '98%Poliester - 2%Spandex ', '', '', 15178.2, '2026-01-22', 0, 56),
(405, 21, 'Indigo Granada ', '1,54', '10 oz', '97% Algodon - 3%Lycra ', '', '', 13281, '2026-01-22', 0, 56),
(406, 21, 'Indigo Spandex Carlin ', '1,65', '10 Oz', '97% Indigo-3 Spandex ', '', '', 17034.6, '2026-01-22', 0, 55),
(407, 21, 'Indigo Spandex Mikonos ', '1,45', '9,7 Oz ', '98% Algodon -2 Spandex', '', '', 21344.4, '2026-01-22', 0, 8),
(408, 21, 'Indigo Spandex Missy Azul ', '1,44', '8,8 Oz ', '67% Algodon-30%Poliester- 3% Spandex', '', '', 16364, '2026-01-22', 0, 8),
(409, 21, 'Indigo Spandex Mostaza ', '1,6', '9 Oz', '79% Algodon - 19%Poliester - 2%Spdex', '', '', 10553.6, '2026-01-22', 0, 26),
(410, 21, 'Inidgo Licrado ', '1,8', '', '98%Algodon - 2%Elastano ', '', '', 20099.3, '2026-01-22', 0, 32),
(411, 22, 'Jean Dama ', '', '', '68% Algodón 20%  Poliester 2 Elastano ', '', '', 30618.4, '2026-01-22', 0, 59),
(412, 22, 'Jean Dama ', '', '', '68% Algodón 20% Poliester 2 Elastano ', '', '', 30618.4, '2026-01-22', 0, 59),
(413, 22, 'Jean Dama  ', '', '', '68% Algodón 20% Poliester 2 Elastano', '', '', 30618.4, '2026-01-22', 0, 59),
(414, 22, 'Jean Dama Con Spandex ', '', '', '', '', '', 26087.6, '2026-01-22', 0, 54),
(415, 22, 'Jean Dama ', '', '8 Oz', '', '', '', 33880.5, '2026-01-22', 0, 60),
(416, 22, 'Jean Dama ', '', '', '', '', '', 36868.7, '2026-01-22', 0, 60),
(417, 22, 'Jean Dama', '', '', '', '', '', 32883.3, '2026-01-22', 0, 60),
(418, 22, 'Jean Hombre Dotacion Composicion ', '', '', '', '', '', 31389.2, '2026-01-22', 0, 59),
(419, 22, 'Jean Hombre Dotacion Composicion', '', '', '', '', '', 34378.5, '2026-01-22', 0, 59),
(420, 22, 'Jean Hombre Dotacion Composicion ', '', '', '', '', '', 37367.8, '2026-01-22', 0, 59),
(421, 22, 'Jean Hombre Rigido ', '', '14 Oz', '', '', '', 26087.6, '2026-01-22', 0, 54),
(422, 22, 'Jean Hombre  ', '', '', 'Spandex', '', '', 35274.3, '2026-01-22', 0, 59),
(423, 22, 'Jean Hombre  ', '', '', 'Spandex', '', '', 38263.6, '2026-01-22', 0, 59),
(424, 22, 'Jean Hombre Talla 28 A 36', '', '', '', '', '', 29894, '2026-01-22', 0, 60),
(425, 22, 'Jean Hombre Talla 38 A 42', '', '', '', '', '', 31887.2, '2026-01-22', 0, 60),
(426, 22, 'Jean Hombre Talla 44-46 Y 48', '', '', '', '', '', 34876.5, '2026-01-22', 0, 60),
(427, 22, 'Jean Spandex Negro Caballero ', '', '', '', '', '', 39858, '2026-01-22', 0, 59),
(428, 22, 'Jean Spandex Negro Caballero ', '', '', '', '', '', 42848.3, '2026-01-22', 0, 59),
(429, 22, 'Jean Spandex Negro Dama ', '', '', '', '', '', 42748.1, '2026-01-22', 0, 59),
(430, 22, 'Jean Spandex Negro Dama ', '', '', '', '', '', 39757.7, '2026-01-22', 0, 59),
(431, 23, 'Malla Orion Para Forro Color Blanco', '', '', '', '', '', 2608.76, '2026-01-22', 0, 5),
(432, 23, 'Malla Para Forrar Camisa Mitad Espalda Blanca', '', '', '', '', '', 4349.73, '2026-01-22', 0, 4),
(433, 23, 'Malla Para Forrar Camisa Mitad Espalda Blanca O Chaquetta', '', '', '', '', '', 3488.41, '2026-01-22', 0, 1),
(434, 24, 'Impermeable Campero', '1,5', '', '', '', '', 32286.1, '2025-12-15', 0, 3),
(435, 24, 'Impermeable Huracan', '1,5', '', '', '', '', 44251.9, '2025-12-15', 0, 3),
(436, 24, 'Lona Reebag', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(437, 25, 'Tela lino flex America Minimat  ', '1.50', '100 Gr', '100% Poliester', '', '', 5000, '2026-04-18', 0, 48),
(438, 25, 'Lino Nova (Linoflex)', '', '', '', '', '', 6147.83, '2026-01-22', 0, 2),
(439, 25, 'Lino Vertigo ', '', '', '', '', '', 16601.2, '2026-01-22', 0, 61),
(440, 25, 'Linoflex ', '1,5', '', '100% Poliester ', '', '', 6166.16, '2026-01-22', 0, 5),
(441, 25, 'Linoflex  ', '1,54', '', '100% Poliester', '', '', 7472.7, '2026-01-22', 0, 4),
(442, 25, 'Linoflex Barcelona', '1,5', '', '100% Poliester ', '', '', 6144, '2026-02-27', 0, 16),
(443, 25, 'Linoflex ', '1,5', '', '100% Poliester  ', '', '', 9594.2, '2026-01-22', 0, 16),
(444, 25, 'Linoflex ', '1,5', '', '100% Poliester ', '', '', 7473.77, '2026-01-22', 0, 62),
(445, 25, 'Linoflex  ', '', '', '100% Poliester', '', '', 6083.15, '2026-01-22', 0, 9),
(446, 25, 'Linoflex Alicia ', '1,5', '175 Oz', '100% Poliester ', '', '', 0, '2026-01-22', 0, 2),
(447, 25, 'Linoflex ', '1,5', '', '100% Poliester ', '', '', 6277.19, '2026-01-22', 0, 1),
(448, 25, 'Linoflex Esmeralda ', '1,5', '', '100% Poliester ', '', '', 4861.78, '2026-01-22', 0, 2),
(449, 25, 'Linoflex Francia', '', '', '', '', '', 6417.33, '2026-01-22', 0, 2),
(450, 25, 'Linoflex Gabardina Alegado ', '1,5', '', '', '', '', 6284.74, '2026-01-22', 0, 58),
(451, 25, 'Linoflex Gabardina Ox Café Oscuro Coidgo 12417 Seguridad Nal ', '1,47', '', '100% Poliester', '', '', 5200, '2026-02-09', 0, 5),
(452, 25, 'Linoflex 61 ', '', '', '100% Poliester ', '', '', 8300.6, '2026-01-22', 0, 61),
(453, 25, 'Linoflex London ', '1,5', '180 Gr', '100% Poliester ', '', '', 4900, '2026-03-12', 0, 8),
(454, 25, 'Linoflex Lyon ', '1,45', '', '100% Poliester ', '', '', 13043.8, '2026-01-22', 0, 25),
(455, 25, 'Pantalon Alviero Strech', '1,51', '205', '100% POLIESTER', '', '', 24578.4, '2025-12-15', 0, 3),
(456, 25, 'Pantalon Ankara Lycra', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(457, 25, 'Pantalon Batari Lycra', '1,5', '', '', '', '', 28782.6, '2025-12-15', 0, 3),
(458, 25, 'Tela pantalon Bogaz Lycra', '1,5', '250', 'Poliester 97% Lycra 3%', '', '', 29200, '2026-02-02', 0, 3),
(459, 25, 'Pantalon Bogaz Lycra Estampado', '1,5', '', '', '', '', 28620.9, '2025-12-15', 0, 3),
(460, 25, 'Pantalon Brunno Lp', '1,54', '', '', '', '', 0, '2025-12-15', 0, 3),
(461, 25, 'Pantalon Chakma ', '', '', '97%Poliester - 3%Spandex', '', '', 14984.2, '2026-01-22', 0, 24),
(462, 25, 'Pantalon Cosmos ', '1,53', '', '', '', '', 20967.1, '2025-12-15', 0, 3),
(463, 25, 'Pantalon Dynamic', '1,49', '', '', '', '', 19457.9, '2025-12-15', 0, 3),
(464, 25, 'Pantalon Elegance ', '1,35', '243 Gr', '97%Poliester-3% Elastomero ', '', '', 16482.6, '2026-01-22', 0, 29),
(465, 25, 'Pantalon Florence Detal ', '1,4', '240 Gr', '94% Poliéster, 6% Spandex', '', '', 28697.4, '2026-01-22', 0, 44),
(466, 25, 'Pantalon Florence 14 ', '1,4', '240 Gr', '94% Poliéster, 6% Spandex', '', '', 14450, '2026-05-06', 0, 14),
(467, 25, 'Pantalon Lugo', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(468, 25, 'Pantalon Lyon Linoflex Strech Mecanico ', '1,5', '', '', '', '', 17194.1, '2026-01-22', 0, 25),
(469, 25, 'Pantalon Megadrill Lafshield', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(470, 25, 'Pantalon Microdril', '1,49', '', '', '', '', 27693.8, '2025-12-15', 0, 3),
(471, 25, 'Pantalon Moretti', '1,5', '', '', '', '', 26787.2, '2025-12-15', 0, 3),
(472, 25, 'Pantalon Novastretch Lc', '1,53', '', '', '', '', 32825.1, '2025-12-15', 0, 3),
(473, 25, 'Pantalon People Strech ', '1,4', '245 Gr', '96% Poliester - 4%Spandex', '', '', 22530.2, '2026-01-22', 0, 22),
(474, 25, 'Pantalon Praga ', '1,5', '30gm ', '96% Poliester - 4% spandex Supervertigo', '', '', 12332.3, '2026-01-22', 0, 8),
(475, 25, 'Pantalon Segal Wicking', '1,5', '', '', '', '', 31589.7, '2025-12-15', 0, 3),
(476, 25, 'Pantalon Soho (Supervertigo O Studio F)  ', '1,5', '239 Gr', '96% Poliester-4%Spandex', '', '', 0, '2026-01-22', 0, 59),
(477, 25, 'Pantalon Soho', '1,51', '', '', '', '', 22314.6, '2025-12-15', 0, 3),
(478, 25, 'Pantalon Stefano R', '1,56', '', '', '', '', 31315.9, '2025-12-15', 0, 3),
(479, 25, 'Pantalon Stefano Lycra R', '1,54', '', '', '', '', 37298.8, '2025-12-15', 0, 3),
(480, 25, 'Pantalon Super Big Star ', '1,42', '216- 239 Gr', '96% Poliester 4% Elastomero  ', '', '', 14111, '2026-01-22', 0, 24),
(481, 25, 'Pantalon Super Vertigo 15 ', '1,5', '', '65% Poliester-35%Algodon', '', '', 0, '2026-03-12', 0, 15),
(482, 25, 'Pantalon Supervertigo ', '1,4', '236 Gr  ', '96% Poliester 4%Elastomero ', '', '', 13500, '2026-03-17', 0, 29),
(483, 25, 'Pantalon Supervertigo5 ', '1,45', '', '', '', '', 12953.2, '2026-01-22', 0, 5),
(484, 25, 'Pantalon Tafetan Garota ', '', '', '65% Poliester-35%Algodòn', '', '', 12834.7, '2026-01-22', 0, 2),
(485, 25, 'Pantalon Tisu', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(486, 25, 'Pantalon Trevi ', '1,6', '', '', '', '', 29081.2, '2025-12-15', 0, 3),
(487, 25, 'Pantalon Triana Lycra', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3);
INSERT INTO `tela` (`id_tela`, `id_tipo_tela`, `tela`, `ancho`, `peso`, `caracteristicas`, `rendimiento`, `encogimiento`, `precio`, `fecha_actualizacion`, `unidades_metros`, `id_proveedor`) VALUES
(488, 25, 'Pantalon Versalles ', '1,43', '245 Gr', '95% Poliester Filamentos - 5% Elastomero ', '', '', 17341.8, '2026-01-22', 0, 4),
(489, 25, 'Pantalon Vertigo 15, Menos Pesado Que Supervertigo, Elongacion 1 Direccion ', '1,5', '200 Gr', '65%Poliester-35%Algodon ', '', '', 24546.1, '2026-01-22', 0, 15),
(490, 25, 'Pantalon Vertigo Lafayete ', '1,45', '320 Gr ', '98% Poliester 2% Spandex ', '', '', 11099.1, '2026-01-22', 0, 2),
(491, 25, 'Pantalon Vertigo Leticia   Por Ahora Solo Azul Oscuro', '1,45', '220 Gr ', '97% Poliester 3% Spandex', '', '', 0, '2026-01-22', 0, 2),
(492, 25, 'Pantalon Zulu Stretch', '1,5', '', '', '', '', 18379.9, '2025-12-15', 0, 3),
(493, 26, 'Gabardina Esparta ', '1,5', '180 Gr ', '20%Algodon - 80%Poliester ', '', '', 8507.58, '2026-01-22', 0, 2),
(494, 26, 'Gabardina Magenta ', '1,67', '200 Gr ', '49%Poliester 26%Algodon 25%Pst ', '', '', 15047.8, '2026-01-22', 0, 32),
(495, 26, 'Gabardina Olimpia Blanca ', '1,5', '182 Gr', '65%Poliester 35% Algodón ', '', '', 14293.2, '2026-01-22', 0, 2),
(496, 26, 'Tela pantalon Gabardina Praga ', '1,5', '193 Gr', '65%Pol - 35%Algodon ', '', '', 10500, '2026-04-18', 0, 2),
(497, 26, 'Gabardina Rio ', '1,5', '200 Gr', '65%Poliester - 35%Algodon', '', '', 9243, '2026-02-26', 0, 4),
(498, 26, 'Gabardina Tempo ', '1,7', '189 Gr ', '49%Poliester 26%Algodon 25%Pst ', '', '', 14111, '2026-01-22', 0, 66),
(499, 27, 'Perchado Cairo Plus', '', '', '', '', '', 11016.1, '2026-01-22', 0, 13),
(500, 27, 'Perchado Fastrack Pb', '1,63', '', '', '', '', 0, '2025-12-15', 0, 3),
(501, 27, 'Perchado Monaco ', '1,5', '264 Gr', '84%Poliester 16%Algodon ', '', '', 19553.8, '2026-01-22', 0, 13),
(502, 27, 'Perchado Monarca ', '1,5', '280 Gr', '100%Poliester ', '', '', 15877.9, '2026-01-22', 0, 13),
(503, 27, 'Perchado Montevideo ', '1,5', '164 Gr', '100%Poliester', '', '', 8644.48, '2026-01-22', 0, 13),
(504, 27, 'Perchado Seul ', '1,5', '200 Gr', '52%Poliester-48% Algodón ', '', '', 14016.2, '2026-01-22', 0, 43),
(505, 27, 'Perchado Seul ', '1,5', '200 Gr', '52%Poliester-48% Algodón ', '', '', 15723.7, '2026-01-22', 0, 43),
(506, 27, 'Perchado Seul Oscuro', '1,5', '200 Gr', '52%Poliester-48% Algodón', '', '', 18415.5, '2026-01-22', 0, 43),
(507, 27, 'Perchado Standford   Blanco', '1,5', '285 Gr', '44%Poliester-55% Algodón', '', '', 23111.2, '2026-01-22', 0, 43),
(508, 27, 'Perchado Standford  Claro', '1,5', '285 Gr', '44%Poliester-55% Algodón', '', '', 25067.8, '2026-01-22', 0, 43),
(509, 27, 'Perchado Standford Oscuro', '1,5', '285 Gr', '44%Poliester-55% Algodón', '', '', 29064, '2026-01-22', 0, 43),
(510, 28, 'Pique Palaos  Tenemos Muestra', '', '230 Gr', '', '', '', 0, '2026-01-22', 0, 0),
(511, 28, 'Pique ', '', '', '65% Poliester 35% Algodón', '', '', 22530.2, '2026-01-22', 0, 9),
(512, 28, 'Pique Action', '1,57', '', '', '', '', 33563.5, '2025-12-15', 0, 3),
(513, 28, 'Pique Antilla ', '1,8', '200 Gr', '65% Poliester 35%Algodon', '', '', 14703.9, '2026-01-22', 0, 51),
(514, 28, 'Pique Apolo ', '1,76', '', '20% Algodón - 80%Poliester ', '', '', 26680.5, '2025-12-15', 0, 3),
(515, 28, 'Pique Apoluss, Es Un Lacoste  Blanca', '1,8', '200 Gr', ' 100% Poliester ', '', '', 31962.7, '2026-01-22', 0, 50),
(516, 28, 'Pique Apoluss, Es Un Lacoste  ,  Negra Y Azul Oscura', '1,8', '200 Gr', '100% Poliester', '', '', 26893.9, '2026-01-22', 0, 50),
(517, 28, 'Pique Aranza ', '1,7', '210 Gr', '73%Pol - 27%Algo', '', '', 10990, '2026-03-17', 0, 13),
(518, 28, 'Pique Armani    Tipo Pique Lacoste Caiman $36000 Kg Rendimiento 3 Metros Venden Cuellos Y Puños', '1,5', '220 Gr', '100% Poliester', '', '', 10672.2, '2026-01-22', 0, 8),
(519, 28, 'Pique Atlantic +', '1,5', '', '', '', '', 28227.4, '2025-12-15', 0, 3),
(520, 28, 'Pique Barbados  Blanca ', '1,5', '', '65%Poliester 35% Algodón', '', '', 0, '2026-01-22', 0, 0),
(521, 28, 'Pique Cole Plus Alta Visibilidad 2.00', '', '', '', '', '', 21021, '2025-12-15', 0, 3),
(522, 28, 'Pique Cole Plus2', '', '', '', '', '', 21450, '2026-02-02', 0, 3),
(523, 28, 'Pique Dakota Classic Blanco  ', '2', '195 Gr ', '50% Poliester - 50% Algodón ', '', '', 18071.6, '2026-01-22', 0, 16),
(524, 28, 'Pique Dakota Classic Claros ', '2', '195 Gr ', '50% Poliester - 50% Algodón ', '', '', 19957, '2026-01-22', 0, 16),
(525, 28, 'Pique Dakota Classic Oscuros ', '2', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 21676.4, '2026-01-22', 0, 16),
(526, 28, 'Pique Db Color Microfibra', '1,8', '', '100% Poliester ', '', '', 13221.7, '2026-01-22', 0, 16),
(527, 28, 'Pique Decathon  (Polux)', '1,8', '', '100% Poliester', '', '', 15403.5, '2026-01-22', 0, 65),
(528, 28, 'Pique Decathon  (Polux) ', '1,8', '', '100% Poliester', '', '', 14445.2, '2026-01-22', 0, 16),
(529, 28, 'Pique Deportiva  ', '1,5', '', '100%Poliester', '', '', 10660.3, '2026-01-22', 0, 13),
(530, 28, 'Pique Deportiva Super ', '1,47', '209 Gr', '84,2 Poliester-15,8 Algodón', '', '', 12533.9, '2026-01-22', 0, 43),
(531, 28, 'Pique 60 Tipo Lacoste Blanca  Parece Apoluss,  Blanca', '1,8', '216 Gr ', '100% Poliester', '', '', 12688.1, '2026-01-22', 0, 5),
(532, 28, 'Pique 60 Tipo Lacoste Colores Parece Apoluss, ', '1,8', '216 Gr ', '100% Poliester ', '', '', 14466.8, '2026-01-22', 0, 5),
(533, 28, 'Pique Generra Blanco ', '2', '250 Gr', '50% Poliester - 50% Algodón ', '', '', 21522.3, '2026-01-22', 0, 66),
(534, 28, 'Pique Generra Claros ', '2', '250 Gr', '50% Poliester - 50% Algodón ', '', '', 22909.7, '2026-01-22', 0, 66),
(535, 28, 'Pique Generra Oscuros', '2', '250 Gr', '50% Poliester - 50% Algodón ', '', '', 24895.3, '2026-01-22', 0, 66),
(536, 28, 'Pique Hannover    Blancos', '1,8', '190 Gr', '77%Poliester-23 Algodón', '', '', 16648.6, '2026-01-22', 0, 43),
(537, 28, 'Pique Hannover    Claros', '1,8', '190 Gr', '77%Poliester-23 Algodón', '', '', 18771.2, '2026-01-22', 0, 43),
(538, 28, 'Pique Hannover    Oscuros', '1,8', '190 Gr', '77%Poliester-23 Algodón', '', '', 20561.8, '2026-01-22', 0, 43),
(539, 28, 'Pique Hannover  Tenemos Muestra', '', '200 Gr', '', '', '', 0, '2026-01-22', 0, 16),
(540, 28, 'Pique Lacost Mil Rayas ', '1,8', '210 Gr', '65%Poliester - 35%Algodon ', '', '', 10079.3, '2026-01-22', 0, 30),
(541, 28, 'Pique Lacoste ', '1,8', '200 Gr ', '65%Poliester-35% Algodón ', '', '', 12450.9, '2026-01-22', 0, 50),
(542, 28, 'Pique Lindatextil   Se Parece A La Poltexsec', '1,8', '200 Gr', '100% Poliester', '', '', 15356.1, '2026-01-22', 0, 43),
(543, 28, 'Pique Lucia ', '1,8', '220 Gr', '65% Poliester - 35% algodón   ', '', '', 11957.2, '2026-01-22', 0, 78),
(544, 28, 'Pique Madrigal Claros (Polux) ', '1,8', '220 Gr ', '100%Poliester', '', '', 8300.6, '2026-01-22', 0, 30),
(545, 28, 'Pique Madrigal Claros Homologa Polux', '', '', '', '', '', 8774.92, '2026-01-22', 0, 16),
(546, 28, 'Pique Madrigal Oscuros (Polux) ', '1,8', '220 Gr', '100%Poliester', '', '', 9012.08, '2026-01-22', 0, 0),
(547, 28, 'Pique Madrigal Oscuros Homologa Polux', '', '', '', '', '', 10458.8, '2026-01-22', 0, 0),
(548, 28, 'Pique Manila Claros ', '1,6', '180 Gr ', '80% Poliester -20% Algodón ', '', '', 7589.12, '2026-01-22', 0, 30),
(549, 28, 'Pique Manila Oscuros ', '1,6', '180 Gr', '80% Poliester -20% Algodón ', '', '', 8537.76, '2026-01-22', 0, 30),
(550, 28, 'Pique Oslo ', '1,8', '', '', '', '', 0, '2026-01-22', 0, 67),
(551, 28, 'Pique Palaos  Es Mas Suave Que Hannover Blancos', '1,8', '', '65%Poliester- 35%Algodon', '', '', 22755.5, '2026-01-22', 0, 43),
(552, 28, 'Pique Palaos   Es Mas Suave Que Hannover Claros', '1,8', '230 Gr', '65%Poliester- 35%Algodon ', '', '', 25316.8, '2026-01-22', 0, 43),
(553, 28, 'Pique Palaos   Es Mas Suave Que Hannover Oscuros', '1,8', '230 Gr', '65%Poliester- 35%Algodon', '', '', 28992.8, '2026-01-22', 0, 43),
(554, 28, 'Pique Palermo  Rollo', '1,83', '205 Gr', '100% Algodón', '', '', 26462.7, '2026-01-22', 0, 66),
(555, 28, 'Pique Poltexsec ', '1,8', '210 Gr', '100%Poliester ', '', '', 9690, '2026-03-11', 0, 13),
(556, 28, 'Pique Poluss  ', '1,65', '220 Gr', '', '', '', 13950.4, '2026-01-22', 0, 68),
(557, 28, 'Pique Poluss 34   ', '1,65', '220 Gr', '', '', '', 14822.5, '2026-01-22', 0, 34),
(558, 28, 'Pique Polux', '1,8', '226GR', '100% POLIESTER', '', '', 23400, '2026-02-13', 0, 3),
(559, 28, 'Pique 73 ', '1,9', '220 Gr ', '65% Poliester -35% Algodón ', '', '', 14148.8, '2026-01-22', 0, 50),
(560, 28, 'Pique Rus Blancos', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 19731.7, '2026-01-22', 0, 43),
(561, 28, 'Pique Ruso   Claros - 25 Dias Programacion Color', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 23182.4, '2026-01-22', 0, 43),
(562, 28, 'Pique Ruso  Oscuros 25 Dias Programacion Color', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 27309, '2026-01-22', 0, 43),
(563, 28, 'Pique Russo Blanco ', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 20538.1, '2026-01-22', 0, 66),
(564, 28, 'Pique Russo Medios ', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 24178.5, '2026-01-22', 0, 66),
(565, 28, 'Pique Russo Oscuros ', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 28459.2, '2026-01-22', 0, 66),
(566, 28, 'Pique Russo/Ref Nigeria ', '1,7', '216 Gr ', '65%Poliester-35%Algodon', '', '', 9367.82, '2026-01-22', 0, 30),
(567, 28, 'Pique Saturno ', '1,8', '180 Gr', '65% Poliester 35%Algodon', '', '', 0, '2026-01-22', 0, 69),
(568, 28, 'Pique Speed Igual A La Spray ', '1,5', '140 Gr', '100%Poliester ', '', '', 7673.2, '2026-01-22', 0, 5),
(569, 28, 'Pique Spray ', '1,47', '136 Gr', '100%Poliester ', '', '', 8763.06, '2026-01-22', 0, 43),
(570, 28, 'Pique Spray Azul Rey Y Azul La De Eve', '', '', '', '', '', 8964.65, '2026-01-22', 0, 16),
(571, 28, 'Pique Superior Claros ', '1,9', '220 Gr ', '65% Poliester 35%Algodon', '', '', 10672.2, '2026-01-22', 0, 30),
(572, 28, 'Pique Superior Medios ', '1,9', '220 Gr ', '65% Poliester 35%Algodon', '', '', 11858, '2026-01-22', 0, 0),
(573, 28, 'Pique Terranova Blanco ', '1,76', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 18729.2, '2026-01-22', 0, 66),
(574, 28, 'Pique Terranova Medios ', '1,76', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 21403.7, '2026-01-22', 0, 66),
(575, 28, 'Pique Terranova Oscuros ', '1,76', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 23301, '2026-01-22', 0, 66),
(576, 28, 'Pique Tikal R  Homologa Polux', '1,85', '', '', '', '', 29000, '2026-05-14', 0, 3),
(577, 28, 'Pique Togo ', '1,47', '110 Gr', '100% Poliester ', '', '', 7766.99, '2026-01-22', 0, 43),
(578, 28, 'Pique Ultra  Blanco', '1,8', '200 Gr', '65% Poliester 35%Algodon', '', '', 13518.1, '2026-01-22', 0, 16),
(579, 28, 'Pique Ultra    Colores', '1,8', '200 Gr', '65% Poliester 35%Algodon', '', '', 9723.56, '2026-01-22', 0, 16),
(580, 29, 'Polo Mc Blanca', '', '', '', '', '', 22420.2, '2026-01-22', 0, 70),
(581, 29, 'Polo Mc Color', '', '', '', '', '', 23416.3, '2026-01-22', 0, 70),
(582, 29, 'Polo Ml Blanca', '', '', '', '', '', 25907.6, '2026-01-22', 0, 70),
(583, 29, 'Polo Ml Color', '', '', '', '', '', 26903.6, '2026-01-22', 0, 70),
(584, 29, 'Polos Mc', '', '', '', '', '', 0, '2026-01-22', 0, 71),
(585, 30, 'Rib Bahamas Se Tiñe Con Prendas Entrega 25 A 30 Dias', '1,4', '216 Gr', '65%Poliester -35%Algodon', '', '', 9400, '2026-02-05', 0, 51),
(586, 30, 'Rib Éxito ', '1,6', '200 Gr', '65%Poliester -35%Algodon ', '', '', 17775.1, '2026-01-22', 0, 72),
(587, 30, 'Rib 73 ', '1,5', '', 'Poliesteralgodon ', '', '', 15942.5, '2026-01-22', 0, 73),
(589, 30, 'Tela Rib Supergaroto ', '1.10', '160 gr ', '100 % Algodon', '', '', 8990, '2026-02-20', 0, 13),
(590, 30, 'Rib Titanica ', '1,5', '', '64%Poliester -34%Algodon -2%Spandex ', '', '', 22233.8, '2026-01-22', 0, 13),
(591, 31, 'Genero 23  144 Hilos ', '2,5', '', '50% Poliester - 50% Algodón ', '', '', 17836.6, '2026-01-22', 0, 74),
(592, 31, 'Genero 66 144 Hilos  Solo Vende Rollos', '2,5', '', '50% Poliester - 50% Algodón', '', '', 12747.3, '2026-01-22', 0, 16),
(593, 31, 'Genero 44 144 Hilos  ', '2,4', '', '50% Poliester -  50% Algodón', '', '', 15743.1, '2026-01-22', 0, 44),
(594, 32, 'Impermeable Antimicrobial Vendaval Cloro Antimicrobial1.50', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(595, 32, 'Impermeable Orion Cloro Antimicrobial1.50', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(600, 33, 'Tela Bolsillo Negro Dajol Pc Chino ', '1,5', '', '80%Poliester -20% Algodón ', '', '', 0, '2026-01-30', 0, 16),
(602, 33, 'Tela Bolsillo Genero satinado Blanco y negro', '2.5', '250 Gr', '', '', '', 3865, '2026-02-25', 0, 1),
(603, 34, 'Tshirt Blanca  Solo Color Blanco', '', '', 'Algodón 100%', '', '', 8656.34, '2026-01-22', 0, 75),
(604, 34, 'Tshirt Mc', '', '', '', '', '', 17194.1, '2026-01-22', 0, 76),
(605, 34, 'Tshirt Mc Cuello Redondo Blanca', '', '', '', '', '', 12953.2, '2026-01-22', 0, 70),
(606, 34, 'Tshirt Mc Cuello Redondo Caballero Aritex Tallas S A Xl', '', '', '', '', '', 15743.1, '2026-01-22', 0, 77),
(607, 34, 'Tshirt Mc Cuello Redondo Color', '', '', '', '', '', 13950.4, '2026-01-22', 0, 70),
(608, 34, 'Tshirt Mc Cuello Redondo Dama Aritex Talla S A Xl', '', '', '', '', '', 16154.9, '2026-01-22', 0, 77),
(609, 34, 'Tshirt Mc Cuello V Blanca', '', '', '', '', '', 13152.7, '2026-01-22', 0, 70),
(610, 34, 'Tshirt Mc Cuellov Color', '', '', '', '', '', 14149.8, '2026-01-22', 0, 70),
(611, 34, 'Tshirt Ml Cuello Redondo Blanca', '', '', '', '', '', 15942.5, '2026-01-22', 0, 70),
(612, 34, 'Tshirt Ml Cuello Redondo Color', '', '', '', '', '', 16939.7, '2026-01-22', 0, 70),
(613, 34, 'Tshirt Ml', '', '', '', '', '', 19829.8, '2026-01-22', 0, 76),
(615, 28, 'OMEGA ', '1,8', '223 Gr', '100%poliester', '', '', 15415.4, '2026-01-22', 0, 14),
(616, 33, 'Tela Bolsillo ', '2,5', '', '', '', '', 0, '2026-01-30', 0, 16),
(617, 28, 'Pique Dornella Plus ', '1,8', '', '62% Poliester - 34% Algodón - 4% Spandex ', '', '', 18261.3, '2026-01-22', 0, 17),
(618, 1, 'Antifluido Repe Garnet1 T180 Estampada Negro Rayas base 22329 Stock 75115 Color 174405 ', '1.80', '', 'proceso digital  ', '', '', 34500, '2026-03-25', 0, 3),
(619, 1, 'Antifluido Repe Garnet1 T180 Estampada Negro Rayas base 22329 Stock 75115 Color 174405 ', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(620, 17, 'Tela poliamida Nylon  Filamentos 100%   Tafetan 1*1 Liviano (Chaquetas Cortavientos)', '1,5', '76 Gr', '', '', '', 3785.94, '2026-01-22', 0, 1),
(621, 4, 'Tela Ref 25000 ', '1,58', '100 Gr', 'Poliester 80% Algodon 20% ', '', '', 9308.53, '2026-01-22', 0, 28),
(622, 26, 'Linoflex Ref 5001 Tela Pantalonera ', '1,5', '', '100% Poliester ', '', '', 9469.15, '2026-01-22', 0, 28),
(623, 12, 'Hawai ', '1,63', '7.3 oz ', '98% Algodon 2% Elastano ', '', '', 15652.6, '2026-01-22', 0, 57),
(624, 1, 'Antifluido Potenza ', '1,45', '160 Gr', '100% Poliester ', '', '', 12999, '2026-02-18', 0, 14),
(625, 5, 'Cotton Popelin 150 ', '1,5', '', 'algodon 97% spandex 3% ', '', '', 15296.8, '2026-01-22', 0, 14),
(626, 5, 'Camisero Stretch Popelin ', '1,45', '120 Gr', 'polyester 75% algodon 23% spandex 2% ', '', '', 19943, '2026-01-22', 0, 14),
(627, 4, 'Camisero Marmara', '1,6', '120', 'Pol-Alg 92-8 ', '', '', 23716, '2025-12-15', 0, 3),
(628, 1, 'Antifluido Cosmos Cloro Spirit ', '1,52', '148 Gr', '100% Polyester ', '', '', 11990, '2026-04-16', 0, 82),
(629, 26, 'Gabardina Garota ', '1,5', '175 Gr', '', '', '', 9357, '2026-03-26', 0, 2),
(630, 9, 'Montecatini ', '1,5', '', '100% Polyester ', '', '', 7400, '2026-03-27', 0, 16),
(631, 9, 'Megafil Sec  ', '1,6', '112 Gms', '100% Polyester ', '', '', 6272.88, '2026-01-22', 0, 17),
(632, 21, 'Indigo Nakan Tejido Plano', '1,6', '318.7', '69% Filamentos de Algodon 29% Filamento de polyester 2% spandex', '', '', 12550.1, '2026-01-22', 0, 83),
(633, 28, 'Coqui Útil', '1,7', '', '3,2 - 35 Polyester 65% Algodón', '3,2', '', 8648.79, '2026-01-22', 0, 84),
(634, 14, 'Franela Jersey Crear Franela Sahara', '1,6', '149 Gm', '65% Poliéster 35% Algodón\r\n', '', '', 7233.38, '2026-01-22', 0, 84),
(635, 14, 'Franela Jabón', '1,5', '', '91% Polyester 9% Spandex', '3,5', '', 7450.06, '2026-01-22', 0, 17),
(636, 14, 'Franela Keira\r\n', '0,6', '', '33% Algodón 61% Polyester 6%Spandex', '3,5', '', 10160.2, '2026-01-22', 0, 17),
(637, 9, 'Hidrotech  ', '1.50', '138', '100% Polyester', '', '', 18500, '2026-03-12', 0, 3),
(638, 27, 'Perchado Olimpica', '1,5', '213', '46.3% Poliéster 53.7%', '', '', 20244.8, '2026-01-22', 0, 16),
(639, 27, 'Perchado Seul', '1,47', '190', '52% poliéster 48% Algodón', '3,16', '', 18142.7, '2026-01-22', 0, 16),
(640, 17, 'Tela Nylon Azul Turqueza\r\n', '', '', '100% Poliester\r\n', '', '', 4582.58, '2026-01-22', 0, 85),
(641, 4, 'Saray', '1,45', '105 Gms', '100% Poliester', '', '', 19684.3, '2026-01-22', 0, 10),
(642, 4, 'Popelina Malta Tejido Plano', '1,5', '18 Gms', '65% Poliester 35% Algodón', '', '', 9367.82, '2026-01-22', 0, 16),
(643, 4, 'Tela mega oxford  Top  Fashion ', '1.50', '165', 'pol 50% alg 50%', '', '', 9800, '2026-04-18', 0, 35),
(644, 27, 'Perchado Loto', '1,5', '', '100% Poliester', '', '', 7707.7, '2026-01-22', 0, 16),
(645, 20, 'Indigo Tokio', '1,8', '12,5 onz', '', '', '', 13970.9, '2026-01-22', 0, 83),
(646, 21, 'Indigo nakano', '1,6', '', '2% spandex 69% Algodón 29% poliester', '', '', 12550.1, '2026-01-22', 0, 83),
(647, 12, 'Dril spandex', '', '', '', '', '', 19921.4, '2026-01-22', 0, 87),
(648, 14, 'Franela Sahara R/4.2', '1,6', '149', 'Poliester algodon', '', '', 31388.1, '2026-01-22', 0, 84),
(649, 1, 'Antifluido Pacific Unicolor', '1,49', '', 'Poliester 91% Lycra 9', '', '', 27219.5, '2025-12-15', 0, 3),
(650, 1, 'ANTIFLUIDO PACIFIC PLUS LAFAYETTE STOCK 37402 Color 194056 azul rey', '', '', '', '', '', 27219.5, '2025-12-15', 0, 3),
(651, 13, 'FORRO STRONG ', '', '', '100% POLIESTER', '', '', 3664.12, '2026-01-22', 0, 14),
(652, 13, 'FORRO COLOMBIA ', '', '', '100% POLIESTER', '', '', 6251.32, '2026-01-22', 0, 14),
(653, 25, 'Tela Pantalon Patagonia ', '1.45', '204', '100% Polyester', '', '', 21560, '2026-01-22', 0, 14),
(654, 23, 'MALLA CON ARRESTO AZUL OSCURO (AGENTE TRANSITO)', '', '', '', '', '', 5425.57, '2026-01-22', 0, 88),
(655, 4, 'HAIDEN 100% POLIESTER ANCHO 1.45', '', '', '', '', '', 18433.8, '2026-01-22', 0, 10),
(656, 4, 'Andes R Estampada  100% Pol  Reciclado', '', '', '', '', '', 26550.7, '2026-01-30', 0, 3),
(657, 26, 'Tela gabardina magenta ', '1.5', '', '', '', '', 12828.2, '2026-01-22', 0, 16),
(658, 12, 'Drill New York ', '1.60', '263 gr', '97.5% Algodon 2.5% Elastomero ', '', '', 22900.2, '2026-01-30', 0, 89),
(659, 12, 'Drill Escocia pluss St ', '1.60', '270', '97% Algodon  3% Spandex', '', '', 15900, '2026-03-26', 0, 89),
(660, 4, 'CHAMBRAY DAKOTA STRECH', '145', '160 gr ', '65% Rayon 32% Poliester 3% Spandex', '', '', 11319, '2026-01-22', 0, 48),
(661, 19, 'Indigo Chambray Dakota Stretch ', '145', '160', '65% Rayon 32%poliestes 3% Spandex ', '', '', 9990, '2026-03-24', 0, 48),
(662, 27, 'Microtitan Plus Unicolor ', '1.49', '168', '100% Polyester', '', '', 28351.4, '2025-12-15', 0, 3),
(663, 4, ' Camisera Monaco 1', '147', '105', 'Pol 60% Alg 40%', '', '', 12936, '2026-01-22', 0, 14),
(664, 26, 'GABARDINA TITAN ', '', '5.06 ONZ', '', '', '', 10456.6, '2026-01-22', 0, 9),
(665, 33, 'Tela bolsillo microfibra Icoltex', '2.5', '100 gr ', '100% Polyester', '', '', 0, '2026-01-30', 0, 4),
(666, 1, 'Antifluido Nautica ', '1.50', '', 'Poliester 100%', '', '', 8877.33, '2026-01-22', 0, 44),
(667, 27, 'Perchado Piel de Angel ', '1.50', '', '100% POLIESTER', '', '', 9058.43, '2026-01-22', 0, 23),
(668, 27, 'Tela peluche ', '1.90', '', '100% POLIESTER', '', '', 22556.1, '2026-01-22', 0, 4),
(669, 4, 'Tela Resort LC base 22319 stock 24186', '1.50', '143', '100% Polyester', '', '', 23123.1, '2025-12-15', 0, 3),
(670, 9, 'Malla deportiva lamega ', '1.60', '55', '100% Polyester', '', '', 2690, '2026-03-26', 0, 13),
(673, 18, 'Indigo Perseo', '1.80', ' 12 onzas', '48% Alg 37% pol 18% Rayon ', '', '', 11900, '2026-02-24', 0, 8),
(674, 18, 'Indigo Perseo', '1.80', ' 12 onzas', '48% Alg 37% pol 18% Rayon ', '', '', 12700, '2026-02-13', 0, 8),
(675, 18, 'Indigo Dakota', '1.72', '9 onzas', '75% alg 23%pol 2% spa ', '', '', 11900, '2026-02-13', 0, 8),
(676, 23, 'Malla Kayac', '', '', '', '', '', 4998.69, '2026-01-22', 0, 4),
(677, 27, 'Perchado olimpia', '', '', '', '', '', 11685, '2026-02-24', 0, 4),
(678, 27, 'Perchado Dinamico', '', '', '100% Poliester', '', '', 9000, '2026-02-26', 0, 8),
(679, 1, 'Antifluido Mykonos', '150', '157 mg', '100% pol mecanico strech ', '', '', 19849.2, '2026-01-22', 0, 4),
(680, 17, 'Tela reflectiva para cintas color gris plata', '1.50', '', '100% POLIESTER', '', '', 10924, '2026-03-17', 0, 1),
(681, 0, 'tela', 'ancho', 'peso', 'caracteristicas', 'rendimiento', 'encogimiento', 0, '2026-01-22', 0, 0),
(682, 0, 'tela', 'ancho', 'peso', 'caracteristicas', 'rendimiento', 'encogimiento', 0, '2026-01-22', 0, 0),
(683, 1, 'Antifluido Zeus ', '1.50', '122 gr ', '100% POLIESTER', '', '', 5063, '2026-01-26', 0, 8),
(684, 1, 'Antifluido London ', '1.50', '120 gr', '100% Poliester ', '', '', 8244, '2026-01-26', 0, 4),
(685, 28, 'Pique Atlanta ', '185', '', '100% POLIESTER  Microfibra ', '', '', 11390, '2026-01-30', 0, 82),
(686, 4, 'Zara Lycra', '151', '130', '75% alg 22%pol 3% spa ', '', '', 18500, '2026-01-30', 0, 3),
(687, 4, 'Camisero srtech popelin rayas', '1.50', '118gr', '75% alg 23%pol 2% spa ', '', '', 11999, '2026-01-30', 0, 14),
(688, 14, 'Lycra Power area piscinas ', '1.50', '196 gr', 'Nylon 80% Spandex 20%', '3.0 metros por kilo', '', 20269, '2026-02-02', 0, 13),
(689, 25, 'Pantalon Referencia Noches de Viena ', '1.50', '230 Gr', '95% pol 5% spandex ', '', '', 10840, '2026-02-03', 0, 4),
(690, 6, 'Popelina Rigida Leonesa  blanca', '1.60', '120 gr', 'Pol 66% 35%', '', '', 8990, '2026-03-17', 0, 13),
(691, 9, 'Tela camiseta Centauro ', '1.60', '', 'Algodon 93% Spandex 7%    precio kilo $38.990', '3.5 metros por kilo ', '', 11140, '2026-02-20', 0, 13),
(692, 12, 'Drill Smart cod004-0521', '145', '250 Gr', '34% alg 64% pol 2% elastomero', '', '', 12464, '2026-02-04', 0, 2),
(695, 4, 'Oxford camisero solo fondo  icoltex', '150', '170', '60% alg 40% pol', '', '', 9870, '2026-03-09', 0, 4),
(696, 9, 'Polo Shirt 0434 Seg Nac 100% pol 220 gr ', '1.80', '220', '100% POLIESTER', '', '', 12900, '2026-02-05', 0, 61),
(697, 9, 'Tela camiseta Poltex sec', '1.80', '210 Gr', '100% Poliester', '', '', 9290, '2026-02-19', 0, 13),
(698, 4, 'Tela camisera oxford160  ', '1.60', '150 Gr', 'Algodon 52% poliester 48%', '', '', 9990, '2026-02-09', 0, 13),
(699, 12, 'Tela Drill Magenta Strech  Fabricato', '1.61', '215gr', '46% polieter fibra 26% polfilmto 3% elastomero', '', '', 16900, '2026-02-09', 0, 23),
(700, 12, 'Tela drill lycrado Himalaya TopTex', '1.60', '260 Gr', '97% Alg 3% Lycra ', '', '', 14900, '2026-03-12', 0, 35),
(701, 23, 'Malla dunga sec cliente Suzuk ', '1.50', '135gr', '100% POLIESTER', '', '', 7771, '2026-02-12', 0, 12),
(702, 1, 'Tela antifluido Nilo ', '1.50', '120 gr', '100% POLIESTER', '', '', 5798, '2026-02-10', 0, 4),
(703, 30, 'Tela rib spring master', '1.40', '220 Gr', 'Poliester 65% Algodon 35%', '', '', 12990, '2026-03-20', 0, 13),
(704, 4, 'Camisero FlaFil  Tg Ancho 1,5', '1.50', '117', '65%Poliester-35%Algodon', '', '', 12900, '2026-03-17', 0, 2),
(705, 4, 'Tela microfibra160-00  con fondeo color especial cliente ', '1.50', '110 gr', '100% POLIESTER', '', '', 14000, '2026-02-16', 0, 14),
(706, 14, 'Tela Tubular codigo 10A1J12 S/46 M/48 L/52 XL/55 Tallas espec 2XL/60 3XL/63 ', '', '160 gr ', '100% Algodón', '', '', 5083, '2026-02-17', 0, 44),
(707, 21, 'Tela indigo Gorgona ', '1.70', '9 onzas', '70% Alg 28% Pol 2% Elastomero ', '', '', 11500, '2026-02-17', 0, 9),
(708, 4, 'Tela popelina milan ', '1.50', '115 Gr', '65%Poliester-35%Algodon', '', '', 6400, '2026-02-17', 0, 16),
(709, 18, 'Indigo Apolo 2 pago credito Ancho 1,70 Peso 12.5 Oz', '1.70', '12.5 Oz', '100 % Algodon', '', '', 11700, '2026-02-24', 0, 8),
(710, 23, 'Tela malla Valiana ', '1.50', '', '93% pol 7% spandex', '6 mtr', '', 7832, '2026-05-08', 0, 13),
(711, 14, 'Tela Amorela lycra ', '1.50', '', '87% POLIESTER 13% APANDEX', '4 metr', '', 8807, '2026-02-25', 0, 13),
(712, 4, 'Tela dacron Icoltex ', '1.50', '100 Gr', '90% pol 10% alg', '', '', 4363, '2026-02-25', 0, 4),
(713, 14, 'Tela franela jersey  Catalina ', '1.60', '150 Gr', '65%Poliester-35%Algodon', '4 mtr ', '', 6092, '2026-02-26', 0, 87),
(714, 8, 'Tela polar fleece ancho ancho1.60 Icoltex', '160', '', '100% POLIESTER', '2.8 metro', '', 7203, '2026-02-27', 0, 4),
(715, 17, 'Impermeable Celta Ancho 1,66', '1.66', '212gr', '100% Poliester ', '', '', 20650, '2026-03-03', 0, 3),
(716, 25, 'Tela lino superflex Continental De Textiles', '1.50', '110', '100% Poliester ', '', '', 4500, '2026-05-08', 0, 63),
(717, 14, 'Tela Lmedellin 160 Silk color medio', ' 1.60 Peso ', '150 Gr	', '', '', '', 7690, '2026-04-18', 0, 13),
(718, 17, 'Tela para tula Cerro Max  icoltex ', '1,5', '80 gr', '100% Poliester', '', '', 3732, '2026-03-11', 0, 4),
(719, 18, 'Tela indigo Zara blue ', '1.67', '356', '80%Pol -18% Algo 2% Spandex', '', '', 13500, '2026-03-12', 0, 62),
(720, 4, 'Tela oxford orleans ', '1.47', '135', '55% Algodón - 45%Poliester', '', '', 12600, '2026-03-12', 0, 14),
(721, 6, 'Popelina Rigida Leonesa colores varios', '1,5', '', '65%Poliester-35%Algodon', '', '', 10990, '2026-03-17', 0, 13),
(722, 6, 'Dacron hortencia icoltex', '1.50', '', '65% Poliester - 35%Algodon ', '', '', 4462, '2026-03-17', 0, 4),
(723, 9, 'Tela Jersey pelicano  AJTEX', '1.60', '201 gr', '85% pol 15% spandex', '3.1 metros  por kilo', '', 10645, '2026-03-20', 0, 73),
(724, 4, 'Camisero Veneta Plus con descuento 5% lafa 10% cliente ', '1.53', '', '100% POLIESTER', '', '', 21460, '2026-03-24', 0, 3),
(725, 23, 'Malla Megafil sec multiusos 1.60 Peso 112gr colores base blanco negro azul osc', '1.60', '112 gr', '100% Polyester', '', '', 5290, '2026-03-30', 0, 13),
(726, 14, 'Franela Algodon pant materno ', '1.50', '110 gr', '100% Algodón', '', '', 6722, '2026-04-09', 0, 72),
(727, 14, 'Franela Brazilia  100% Algodon ', '1.55', '155 gr', '100% Algodón', '', '', 9990, '2026-04-15', 0, 13),
(728, 21, 'Indigo Zara blue 3204 Grupo Surtitex', '167', '381', '80% alg -18% pol 2% spandex', '', '', 12500, '2026-04-18', 0, 78),
(729, 6, 'Tela Dacron S/F Continental de textiles ', '1.50', '107', '94% pol 6% alg ', '', '', 5116, '2026-04-18', 0, 63),
(730, 23, 'Tela Malla lamega', '1.60', '55 gr', '100% Polyester', '', '', 2690, '2026-04-18', 0, 13),
(731, 14, 'Tela Lmedellin 160 Silk color claro ', '1.60', '150 Gr', '65%Poliester-35%Algodon', '', '', 6690, '2026-04-18', 0, 13),
(732, 14, 'Tela Lmedellin 160 Silk color oscuro ', '1.60', '150 Gr', '65%Poliester-35%Algodon', '', '', 7990, '2026-04-18', 0, 13),
(733, 23, 'Malla Dinamica  liviana Pol-Spa', '1.50', '111 gr', '92% pol 8% spandex', '', '', 6990, '2026-04-24', 0, 13),
(734, 10, 'Tela Drill TC Twill S/F Continental textiles', '1.50', '208', 'Poliester 85% Algodon 15%', '', '', 8231, '2026-05-11', 0, 63),
(735, 11, 'Tela Drill Thor Tramas ', '1.60', '255', '100 % Algodon', '', '', 10516, '2026-05-11', 0, 9),
(736, 4, 'Tela Popelina caobo PC John Uribe  ', '1.48', '103', '65% Poliester - 35%Algodon ', '', '', 6798, '2026-05-19', 0, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tela_combinada`
--

CREATE TABLE `tela_combinada` (
  `id_telacombi` int(11) NOT NULL,
  `id_tipo_tela` int(11) NOT NULL,
  `tela_combi` varchar(200) DEFAULT NULL,
  `ancho` varchar(30) DEFAULT NULL,
  `peso` varchar(30) DEFAULT NULL,
  `caracteristicas` varchar(100) DEFAULT NULL,
  `rendimiento` varchar(50) DEFAULT NULL,
  `encogimiento` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades_metros` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tela_combinada`
--

INSERT INTO `tela_combinada` (`id_telacombi`, `id_tipo_tela`, `tela_combi`, `ancho`, `peso`, `caracteristicas`, `rendimiento`, `encogimiento`, `precio`, `fecha_actualizacion`, `unidades_metros`, `id_proveedor`) VALUES
(0, 0, 'No Aplica', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, 0),
(1, 1, 'Antifluido Adidas ', '1,5', '', '', '', '', 6975.74, '2026-01-22', 0, 1),
(2, 1, 'Antifluido Adidas Es Mas Impermeable ', '1,5', '105 Gr ', '100% Poliester', '', '', 7114.8, '2026-01-22', 0, 2),
(3, 1, 'Antifluido Alviero Strech Lafshield', '1,51', '205', '100% POLIESTER', '', '', 25747, '2026-04-17', 0, 3),
(4, 1, 'Antifluido Alviero Strech Lafshield Estampada', '1,5', '', '', '', '', 28334.2, '2025-12-15', 0, 3),
(5, 1, 'Antifluido Antimicrobial Microtec Cloro Antimicrobial', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(6, 1, 'Antifluido Antimicrobial Microtec Cloro Antimicrobial  Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(7, 1, 'Antifluido Antimicrobial Universal Cloro Antimicrobial', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(8, 1, 'Antifluido Aqua Max Cloro Resistencia', '1,5', '140 Gr', '', '', '', 12521, '2026-03-26', 0, 4),
(9, 1, 'Antifluido Astral (Se Parece Wembley Y Nike) ', '1,5', '115 Gr', '100%Poliester ', '', '', 8063.44, '2026-01-22', 0, 5),
(10, 1, 'Antifluido Balsillas ', '1,5', '', '100% Poliester', '', '', 5336.1, '2026-01-22', 0, 5),
(11, 1, 'Antifluido Betania', '1,48', '150 Gr', '65%Poliester - 35%Viscosa Sensacion Frescura ', '', '', 20756.9, '2025-12-15', 0, 3),
(12, 1, 'Antifluido Boston Navy ', '1,5', '', '', '', '', 12229.9, '2026-01-22', 0, 6),
(13, 1, 'Antifluido Caribe Cloro Resistente', '1,5', '', '', '', '', 25025.8, '2025-12-15', 0, 3),
(14, 1, 'Antifluido Caribe Cloro Resistente', '1,5', '', 'Estampado', '', '', 28281.3, '2025-12-15', 0, 3),
(15, 1, 'Antifluido Cooper', '1,5', '62-67 Gr', 'Repelente Al Agua No Impermeable Tipo Cortaviento ', '', '', 9486.4, '2026-01-22', 0, 7),
(16, 1, 'Antifluido Cosmos ', '1,53', '', '', '', '', 24299.9, '2026-01-30', 0, 3),
(17, 1, 'Antifluido Cosmos  Estampado', '1,53', '', '', '', '', 23585.6, '2025-12-15', 0, 3),
(18, 1, 'Antifluido Country', '1,53', '', '100% Poliester ', '', '', 7233.38, '2026-01-22', 0, 2),
(19, 1, 'Antifluido De 8 Homologa Universal De 3', '', '', '', '', '', 8182.02, '2026-01-22', 0, 8),
(20, 1, 'Antifluido Durango', '1,5', '', '', '', '', 23958.6, '2025-12-15', 0, 3),
(21, 1, 'Antifluido Electra ', '1,5', '', '100% Poliester Pelicula Clororesistencia', '', '', 19565.7, '2026-01-22', 0, 20),
(22, 1, 'Antifluido Kae Se Parece Al Tequila Es Opaco ', '1,6', '', '', '', '', 11265.1, '2026-01-22', 0, 9),
(23, 1, 'Antifluido Lacrosse', '1,48', '', '', '', '', 0, '2025-12-15', 0, 3),
(24, 1, 'Antifluido Liso Wr ', '1,5', '115 Gr', '100%Poliester Liviano Poca Clororesistencia', '', '', 8967.88, '2026-01-22', 0, 4),
(25, 1, 'Antifluido Manila', '1,46', '148 Gr', '65%Poliester - 60%Algodon ', '', '', 23104.8, '2025-12-15', 0, 3),
(26, 1, 'Antifluido 20 Extra', '', '', '', '', '', 19802.9, '2026-01-22', 0, 10),
(27, 1, 'Antifluido Megadrill Lafshield', '1,5', '', '', '', '', 27693.8, '2025-12-15', 0, 3),
(28, 1, 'Antifluido Metropol ', '1,5', '100 Gr', '100% Poliester ', '', '', 30522.5, '2026-01-22', 0, 7),
(29, 1, 'Antifluido Megadrill Lafshield Estampado', '1,5', '', '', '', '', 30522.5, '2025-12-15', 0, 3),
(30, 1, 'Antifluido Microdril Lafshield', '1,5', '', '', '', '', 29828.3, '2025-12-15', 0, 3),
(31, 1, 'Antifluido Microfibra Acabado Soft ', '1,48', '115 Gr', '100% Poliester', '', '', 31642.5, '2026-01-22', 0, 8),
(32, 1, 'Antifluido Microdril Lafshield Estampado', '1,5', '', '', '', '', 31642.5, '2025-12-15', 0, 3),
(33, 1, 'Antifluido Microprince', '1,51', '', '', '', '', 29028.4, '2025-12-15', 0, 3),
(34, 1, 'Antifluido Microtec Clor Resistente ', '1,5', '104', '100% POLIESTER', '', '', 22368.5, '2025-12-15', 0, 3),
(35, 1, 'Antifluido Microtec clororesistente Estampado', '1,5', '104', '100% POLIESTER', '', '', 29914.5, '2025-12-15', 0, 3),
(36, 1, 'Antifluido Mundial Clororesistente (Universal Clororesistente) ', '1,45', '30 Gr', '100%Poliester ', '', '', 14822.5, '2026-01-22', 0, 5),
(37, 1, 'Antifluido Napolen (Toque Soft) ', '1,5', '110 Gr', '100%Poliester ', '', '', 8300.6, '2026-01-22', 0, 5),
(38, 1, 'Antifluido Nike ', '1,5', '', '100% Poliester', '', '', 8419.18, '2026-01-22', 0, 11),
(39, 1, 'Antifluido Odeon', '', '', '', '', '', 15362.6, '2026-01-22', 0, 2),
(40, 1, 'Antifluido Olimpia Repel Estampado', '1,5', '', '', '', '', 9830.28, '2026-01-22', 0, 12),
(41, 1, 'Antifluido Olimpia Repel  Unicolor', '1,5', '', '', '', '', 8703.77, '2026-01-22', 0, 13),
(42, 1, 'Antifluido Forza ', '1.47', '105gr', '100% Poliester ', '', '', 6999, '2026-02-19', 0, 14),
(43, 1, 'Antifluido Plus Ancho ', '1,5', '', '', '', '', 9159, '2026-03-17', 0, 4),
(44, 1, 'Antifluido Riva ', '1,5', '137 Gr', '100% Poliester ', '', '', 10760.6, '2026-01-22', 0, 15),
(46, 1, 'Antifluido Spandex Baltimore ', '1,45', '120 Gr', '97%Poliester 3%Spandex ', '', '', 6284.74, '2026-01-22', 0, 5),
(47, 1, 'Antifluido Spandex Fatima ', '1,45', '140 Gr ', '92%Poliester-8%Spandex  Solo Blanco Por Ahora', '', '', 8431.04, '2026-01-22', 0, 2),
(48, 1, 'Antifluido Spandex Iguazu Lycra ', '1,5', '132', 'lycra 4% Pol Re. 96%', '', '', 27489, '2025-12-15', 0, 3),
(49, 1, 'Antifluido Spandex Lotus', '1.50', '169', 'Pol 96% lycra 4%', '', '', 30022.3, '2025-12-15', 0, 3),
(50, 1, 'Antifluido Spandex Lotus Estampado', '1.51', '170', '', '', '', 39077.5, '2025-12-15', 0, 3),
(51, 1, 'Antifluido Spandex Marruecos R', '', '', '', '', '', 33404, '2025-12-15', 0, 3),
(52, 1, 'Antifluido Spandex Metro ', '1,47', '180 Gr', '100% Poliester Strech Mecanico  Solo Blanco Por Ahora Spandex En La Trama', '', '', 0, '2026-01-22', 0, 2),
(53, 1, 'Antifluido Spandex Napolen ', '1,5', '150 Gr ', '96%Poliester - 4%Spandex ', '', '', 11656.4, '2026-01-22', 0, 16),
(54, 1, 'Antifluido Spandex Tesla ', '1,5', '', '95%Poliester - 5% Elastomero Peso 148', '', '', 12592.1, '2026-01-22', 0, 4),
(55, 1, 'Antifluido Spandex Tory ', '1,47', '135 Gr', '91%Poliester-9%Spandex   Solo Blanco Por Ahora', '', '', 0, '2026-01-22', 0, 2),
(56, 1, 'Antifluido Spandex Universal Lycra', '1,5', '', '', '', '', 27542.9, '2025-12-15', 0, 3),
(57, 1, 'Antifluido Tulum ', '1,5', '148 Gr ', '100% Poliester Texturizado ', '', '', 18027.4, '2026-01-22', 0, 4),
(58, 1, 'Antifluido T180', '1.80', '', '100% Poliester', '', '', 23500, '2026-02-12', 0, 3),
(59, 1, 'Antifluido T180  Estampada', '1.80', '', '100% POLIESTER', '', '', 26750, '2026-02-12', 0, 3),
(60, 1, 'Antifluido Tekila ', '1,5', '', '100% Poliester ', '', '', 12569.5, '2026-01-22', 0, 9),
(61, 1, 'Antifluido Tifon  Verde Neon Brigadista', '1,5', '', '', '', '', 4312, '2026-01-22', 0, 1),
(62, 1, 'Antifluido Tulun Homologa Universal Clororesistente ', '1,5', '', '', '', '', 18027.4, '2026-01-22', 0, 4),
(63, 1, 'Antifluido Tx 200 ', '1,5', '136gr', '100% POLIESTER', '', '', 16700, '2026-04-21', 0, 3),
(64, 1, 'Antifluido Tx 200 Estampada', '1,5', '136gr', '100% POLIESTER', '', '', 21950, '2026-02-19', 0, 3),
(65, 1, 'Antifluido Universal Cloro Resis 1,5 Unicolor', '1,5', '135', '100% POLIESTER', '', '', 23450, '2026-02-19', 0, 3),
(66, 1, 'Antifluido Universal Cloro Resistente Estampado', '1,5', '135', '100% POLIESTER', '', '', 26303.2, '2025-12-15', 0, 3),
(67, 1, 'Antifluido Universal Ripstop', '1,5', '', '', '', '', 21550, '2026-02-10', 0, 3),
(68, 1, 'Antifluido Universal Touch', '1,5', '', '', '', '', 23284.8, '2025-12-15', 0, 3),
(69, 1, 'Antifluido Urano Liviano Para Cortavientos', '', '', '', '', '', 9118.8, '2026-01-22', 0, 17),
(70, 1, 'Antifluido Valdo ', '1,5', '140 Gr', '100% Poliester', '', '', 9130.66, '2026-01-22', 0, 18),
(71, 1, 'Antifluido Velero R ', '1,58', '', '', '', '', 34172.6, '2025-12-15', 0, 3),
(72, 1, 'Antifluido Wembley ', '1,55', '104 Gr', '100% Poliester', '', '', 7990, '2026-02-17', 0, 16),
(73, 1, 'Antifluido Wembley Detal ', '1,55', '104 Gr', '100% Poliester', '', '', 10463.1, '2026-01-22', 0, 15),
(74, 1, 'Antifluido Wind Breaker ', '1,5', '', '100% Poliester', '', '', 5929, '2026-01-22', 0, 11),
(75, 1, 'Antifluido Zelandia Wr Soft ', '1,5', '105 Gr', '100%Poliester', '', '', 7292.67, '2026-01-22', 0, 2),
(76, 2, 'Burda Latina ', '', '180 Gr', '77% Poliester 23%Algodon', '', '', 10230.2, '2026-01-22', 0, 13),
(77, 3, 'Dril Camisa Confeccionada Polialgodon 19', '', '', '', '', '', 45837.6, '2026-01-22', 0, 19),
(78, 4, 'Camisera  Resort lc', '1,5', '', '', '', '', 23015.3, '2025-12-15', 0, 3),
(79, 4, 'Camisera Guayabera Resort Estampada', '1,5', '', '', '', '', 27542.9, '2025-12-15', 0, 3),
(80, 4, 'Camisero Acantha ', '1,5', '', '', '', '', 21250, '2026-02-02', 0, 3),
(81, 4, 'Camisero Adara', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(82, 4, 'Camisero Adara Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(83, 4, 'Camisero Alessio ', '1,5', '', '85% pol 15% alg', '', '', 26300, '2026-04-28', 0, 3),
(84, 4, 'Camisero Alessio lagerfeld ', '1,5', '', '85% pol 15% alg', '', '', 29350, '2026-04-28', 0, 3),
(85, 4, 'Camisero Andes ', '1,5', '', ' 100% poliester recicl', '', '', 21650, '2026-02-04', 0, 3),
(86, 4, 'Camisero Bamoa', '1,5', '', '100% Poliester', '', '', 20900, '2026-02-03', 0, 3),
(87, 4, 'Camisero Bamoa Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(88, 4, 'Camisero Carlita ', '1,5', '', '', '', '', 20277.2, '2026-01-22', 0, 20),
(89, 4, 'Camisero Chicago Unicolor Y Jasped', '1,5', '', '', '', '', 23284.8, '2025-12-15', 0, 3),
(90, 4, 'Camisero Danova L.C', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(91, 4, 'Camisero Danova L.C Estampada', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(92, 4, 'Camisero Dexter solo fondo ', '1,46', '137', 'Algodon 65% Poliester 35%', '', '', 25450, '2026-04-16', 0, 3),
(93, 4, 'Camisero Dinamica', '1,5', '', '', '', '', 18649.4, '2026-01-22', 0, 20),
(94, 4, 'Camisero Dull Khosibo ', '', '130 Gr', '100%Poliester', '', '', 21077.1, '2026-01-22', 0, 21),
(95, 4, 'Camisero E Padua Queen Estampado', '1,7', '', '', '', '', 0, '2025-12-15', 0, 3),
(96, 4, 'Camisero Éxito ', '1,48', '130 Gr', '95%Poliester-5% Algodón', '', '', 25826.7, '2026-01-22', 0, 22),
(97, 4, 'Camisero Fay', '1.50', '118gr', '100% Polyester', '', '', 12681.6, '2026-01-22', 0, 15),
(98, 4, 'Camisero Fay Negro', '', '', '', '', '', 24919, '2026-01-22', 0, 23),
(99, 4, 'Camisero Fay Queen ', '1,49', '118 Gr ', '100%Poliester', '', '', 25826.7, '2026-01-22', 0, 22),
(100, 4, 'Camisero Fay 25 ', '1,47', '125 Gr ', '100% Poliester', '', '', 21077.1, '2026-01-22', 0, 25),
(101, 4, 'Camisero Fay Detal ', '1,47', '125 Gr', '100% Poliester', '', '', 24919, '2026-01-22', 0, 15),
(102, 4, 'Camisero Fendi Mil Rayas colores varios ', '1,5', '100 Gr', '65%Poliester - 35%Algodon ', '', '', 10000, '2026-03-12', 0, 4),
(103, 4, 'Camisero Fill And Fill 20 ', '1,5', '', '100% Poliester ', '', '', 21077.1, '2026-01-22', 0, 20),
(104, 4, 'Camisero Fill And Fill 24 ', '', '', '100% Algodón ', '', '', 24919, '2026-01-22', 0, 24),
(106, 4, 'Camisero Gaell', '1,6', '', '', '', '', 21290.5, '2025-12-15', 0, 3),
(107, 4, 'Camisero Gorgona Lycra R ', '1,5', '119', 'Pol 96% lycra 4%', '', '', 26908, '2026-04-16', 0, 3),
(108, 4, 'Camisero Gorgona R Estampado', '1,5', '119', 'Pol 96% lycra 4%', '', '', 0.2, '2026-01-30', 0, 3),
(109, 4, 'Camisero Howard ', '1,7', '', '', '', '', 28459.2, '2025-12-15', 0, 3),
(110, 4, 'Camisero Kuvo Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(111, 4, 'Camisero Maori Estampado', '1,5', '99', '45%Algodon 55% Poliester ', '', '', 21290.5, '2025-12-15', 0, 3),
(112, 4, 'Camisero 20', '', '', '', '', '', 19684.3, '2026-01-22', 0, 20),
(113, 4, 'Camisero Metro L.C', '1,5', '', '', '', '', 21128.8, '2025-12-15', 0, 3),
(114, 4, 'Camisero Metro L.C  Estampada', '1,5', '', '', '', '', 34927.2, '2025-12-15', 0, 3),
(116, 4, 'Camisero Montecarlo ', '1,5', '100 Gr', '55%Poliester-45% Algodón Peso 95 A ', '', '', 14227.4, '2026-01-22', 0, 11),
(117, 4, 'Camisero New Prestige ', '1,45', '', '50%Algodon - 50% Poliester', '', '', 14945.4, '2026-01-22', 0, 14),
(118, 4, 'Camisero Nicole L.C', '1,5', '', '', '', '', 21883.4, '2025-12-15', 0, 3),
(119, 4, 'Camisero Nicole L.C Estampado', '1,5', '', '', '', '', 21883.4, '2025-12-15', 0, 3),
(120, 4, 'Camisero Popelina ', '1,5', '', '', '', '', 10241, '2026-01-22', 0, 15),
(122, 4, 'Tela camisera Popelina Brisa ', '1,5', '', '65%Poliester-35%Algodon', '', '', 7900, '2026-02-09', 0, 16),
(123, 4, 'Camisero Popelina Menta ', '', '', 'Poli-Alg ', '', '', 7589.12, '2026-01-22', 0, 26),
(124, 4, 'Camisero Popelina Menta ', '', '', 'Poli-Alg', '', '', 8419.18, '2026-01-22', 0, 26),
(125, 4, 'Camisero Popelina Pc Holandes ', '1,5', '150 Gr', '65% Poliester- 35% Viscosa', '', '', 0, '2026-01-22', 0, 16),
(126, 4, 'Camisero Popelina San Pablo ', '1.5', '150 Gr', '65%Poliester-35%Algodon', '', '', 7862, '2026-05-20', 0, 2),
(127, 4, 'Camisero Popelina Superior ', '1,5', '', '', '', '', 9512.27, '2026-01-22', 0, 4),
(128, 4, 'Camisero Queen', '1,65', '', '', '', '', 21290.5, '2025-12-15', 0, 3),
(129, 4, 'Camisero Queen Estampada', '1,65', '', '', '', '', 24362.8, '2025-12-15', 0, 3),
(130, 4, 'Camisero Rayas Steve2-1', '', '88 Gr ', '65%Poliester -35%Algodon', '', '', 7707.7, '2026-01-22', 0, 21),
(131, 4, 'Camisero Super Turin ', '1,45', '90 A 95 Gr', '55%Poliester-45% Algodón ', '', '', 14227.4, '2026-01-22', 0, 11),
(132, 4, 'Camisero Unicolor Y Estampadas ', '1,45', '', '100% Poliester', '', '', 17905.6, '2026-01-22', 0, 20),
(133, 4, 'Camisero Vargas Llosa ', '1,5', '110 Gr', '50% Poliester - 50% Algodón  ', '', '', 118461, '2026-04-24', 0, 90),
(134, 4, 'Camisero Universal Ristop Wicking', '', '', '', '', '', 21128.8, '2025-12-15', 0, 3),
(135, 4, 'Camisero Universal Ristop Wicking Estampado', '', '', '', '', '', 24686.2, '2025-12-15', 0, 3),
(136, 4, 'Camisero Veneta Plus', '1,53', '125 gr', 'Poliester 85% Algodon 15%', '', '', 25100, '2026-02-02', 0, 3),
(137, 4, 'Dacron Danes Blanco ', '1,45', '110 Gr', '65%Poliester 35%Algodon ', '', '', 9130.66, '2026-01-22', 0, 27),
(138, 4, 'Dacron Danes Colores ', '1,45', '110 Gr', '65%Poliester 35%Algodon ', '', '', 10079.3, '2026-01-22', 0, 27),
(139, 4, 'Dacron Lombardy ', '1,5', '100 Gr ', '35%Algodòn- 65% Poliester Blanco', '', '', 7424, '2026-03-26', 0, 2),
(141, 4, 'Dacron Otoñal Solo Blanco ', '1,5', '125 Gr', '65%Poliester 35%Algodon ', '', '', 10079.3, '2026-01-22', 0, 27),
(143, 4, 'Oxford  32 ', '1,5', '150 Gr', '50%Algodon-50% Poliester  ', '', '', 11846.1, '2026-01-22', 0, 32),
(144, 4, 'Oxford ', '1,45', '130 Gr ', '100%Algodon', '', '', 9486.4, '2026-01-22', 0, 21),
(145, 4, 'Oxford 160 Pat Primo        ', '1,6', '150 Gr   ', '52%Algodon- 48% Poliester    ', '', '', 9990, '2026-02-04', 0, 13),
(146, 4, 'Oxford Aquiles', '1,45', '160 Gr', '60%Algodon - 40%Poliester', '', '', 9960.72, '2026-01-22', 0, 8),
(147, 4, 'Oxford Azul Ml Camisa Confeccionada', '', '', '', '', '', 38272.2, '2026-01-22', 0, 33),
(148, 4, 'Oxford Blanco 34 ', '1,55', '155 Gr', '50%Poliester - 50% Algodón', '', '', 11265.1, '2026-01-22', 0, 34),
(149, 4, 'Tela oxford blanco 66 ', '1,6', '', '55%Algodon - 45%Poliester ', '', '', 11534.6, '2026-01-22', 0, 16),
(150, 4, 'Oxford Blanco 46 ', '1,5', '', '', '', '', 0, '2026-01-22', 0, 31),
(151, 4, 'Oxford Blanco 35', '1,5', '165 Gr', '50% Poliester-50% Algodón ', '', '', 11739.4, '2026-01-22', 0, 35),
(152, 4, 'Oxford Nacional  Colores varios ', '1,6', '', '55% Algodón - 45%Poliester', '', '', 11700, '2026-02-04', 0, 16),
(153, 4, 'Oxford Colores 35 ', '1,5', '165 Gramos', '50% Poliester - 50% Algodón ', '', '', 12213.7, '2026-01-22', 0, 35),
(154, 4, 'Oxford Deluxe ', '1,42', '208 Gr', '68%Algodon - 32% Poliester ', '', '', 18970.6, '2026-01-22', 0, 14),
(155, 4, 'Oxford Gris 15', '1,6', '', '', '', '', 11739.4, '2026-01-22', 0, 15),
(156, 4, 'Oxford Magno 135 ', '1,5', '', '60% Algodón - 40% Poliester', '', '', 8893.5, '2026-01-22', 0, 8),
(157, 4, 'Oxford Manhattan ', '', '', '60%Algodòn - 40%Poliester', '', '', 14535.8, '2026-01-22', 0, 2),
(158, 4, 'Oxford ', '', '', '60%Algodòn - 40%Poliester', '', '', 13661.5, '2026-01-22', 0, 2),
(159, 4, 'Oxford Rayas 66 ', '1,6', '155 Gr', '50%Algodon - 50%Poliester', '', '', 14585.3, '2026-01-22', 0, 16),
(160, 4, 'Oxford Rayas 4 ', '1,5', '', '', '', '', 14258.7, '2026-01-22', 0, 4),
(161, 4, 'Oxford Superoxford ', '1,5', '160 Gr', '60% Algodon-40% Poliester ', '', '', 11345, '2026-03-11', 0, 4),
(162, 4, 'Oxford Unioffice ', '1,6', '163 Gr', '62% Algodón - 38% Poliester', '', '', 13518.1, '2026-01-22', 0, 8),
(163, 4, 'Oxoford Azul Y Blanca Mc Confeccionada', '', '', '', '', '', 39859.1, '2026-01-22', 0, 36),
(164, 4, 'Oxoford 32 ', '1,5', '150 Gr ', '50% poliester - 50% Algodón ', '', '', 13031.9, '2026-01-22', 0, 32),
(165, 5, 'Camisero Spandex Atina ', '1,46', '116 Gr', '93%Poliester -7%Spandex ', '', '', 9249.24, '2026-01-22', 0, 21),
(166, 5, 'Camisero Strech Bershka ', '', '', '97%Algodon - 3%Spandex', '', '', 12213.7, '2026-01-22', 0, 24),
(167, 5, 'Camisero Strech Isabel ', '', '132 Gr', '92%Poliester - 8%Spandex ', '', '', 10079.3, '2026-01-22', 0, 29),
(168, 5, 'Camisero Strech Marcel Lycra', '1,5', '', '', '', '', 31046.4, '2025-12-15', 0, 3),
(169, 5, 'Camisero Strech Marcel Lycra Est', '1,5', '', '', '', '', 34927.2, '2025-12-15', 0, 3),
(170, 5, 'Camisero Strech Monet Lycra', '1,54', '', '', '', '', 28674.8, '2025-12-15', 0, 3),
(171, 5, 'Camisero Strech Popelina ', '', '', '97%Algodon - 3% Lycra', '', '', 9865.86, '2026-01-22', 0, 4),
(172, 5, 'Camisero Strech Popelina Dubay ', '1,45', '125 Gr  ', '97%Algodon - 3 %Spandex', '', '', 10672.2, '2026-01-22', 0, 16),
(173, 5, 'Camisero Strech Popelina Pera ', '', '', '97%Algodon - 3%Spandex', '', '', 10079.3, '2026-01-22', 0, 26),
(174, 5, 'Camisero Strech Popelina Santana', '', '', '', '', '', 7589.12, '2026-01-22', 0, 2),
(175, 5, 'Camisero Strech Popelina Uniklo', '1.60', '125 gr', 'Algodon 96% Spandex 4%', '', '', 14542.2, '2026-01-22', 0, 13),
(176, 5, 'Camisero Strech Popelina Victoria ', '1,45', '115 Gr', '97%Algodon - 3%Spandex', '', '', 9604.98, '2026-01-22', 0, 30),
(177, 5, 'Camisero Strech Rafael Lycra ', '1,5', '', '', '', '', 22530.2, '2026-01-22', 0, 20),
(178, 5, 'Camisero Strech Rosella Lycra', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(179, 5, 'Camisero Strech Rosella Lycra Estampado', '1,5', '', '', '', '', 30309, '2025-12-15', 0, 3),
(180, 5, 'Camisero Strech Skikda ', '', '', '92%Poliester - 8%Eslastomero', '', '', 7944.86, '2026-01-22', 0, 24),
(181, 6, 'Dacron 205 Plus ', '1,48', '115 Gr', '80%Poliester-20%Algodon ', '', '', 8893.5, '2026-01-22', 0, 8),
(182, 6, 'Dacron Chino Blanco 9', '', '', '', '', '', 5519.36, '2026-01-22', 0, 9),
(183, 6, 'Dacron Chino Blanco Toptex', '', '', '', '', '', 3675.98, '2026-01-22', 0, 35),
(184, 6, 'Dacron Chino Colores  ', '1,5', '', '80%Poliester-20% Algodón ', '', '', 4528.68, '2026-01-22', 0, 1),
(185, 6, 'Dacron Chino Colores Toptex', '', '', '', '', '', 4150.3, '2026-01-22', 0, 35),
(186, 6, 'Dacron Colores 5 ', '1,5', '90 Gr', '90%Poliester -10% Algodón  ', '', '', 6640.48, '2026-01-22', 0, 27),
(187, 6, 'Dacron Hidalgo Solo Blanco', '1,45', '', '', '', '', 5454.68, '2026-01-22', 0, 27),
(188, 6, 'Dacron S/F  camisero Seg.Nac', '1,5', '', '94% pol 6% Algodon ', '', '', 5500, '2026-02-03', 0, 63),
(189, 6, 'Dacron Marques ', '1,45', '', 'AnchoSolo Blanco 90%Poliester - 10%Algodon', '', '', 5929, '2026-01-22', 0, 27),
(190, 6, 'Dacron Perla Blanca ', '', '', '90% Pol-10% Alg Econòmica', '', '', 3913.14, '2026-01-22', 0, 2),
(191, 6, 'Dacron Popelina Diana ', '', '', '50 poliester - 50 algodón ', '', '', 12332.3, '2026-01-22', 0, 34),
(192, 6, 'Dacron Popelina Superior Blanca ', '1,48', '', '', '', '', 6581.19, '2026-01-22', 0, 9),
(193, 6, 'Dacron Popelina Blanca', '1,48', '', '', '', '', 9467, '2026-01-22', 0, 45),
(194, 7, 'En Este Moento No Tiene Pcc', '', '', '', '', '', 0, '2026-01-22', 0, 37),
(195, 7, 'Impermeabble Chaqueta Pantalon, Calibre 18 Color Azul Y Negro, Reflectivo Solo En Espalda De Chaqueta', '', '', '', '', '', 0, '2026-01-22', 0, 38),
(196, 7, 'Impermeable Chaqueta Pantalon Zapatones Y Bolso Calibre 18 Color Azul Y Negro, Reflectivo Solo En Espalda De Chaqueta', '', '', '', '', '', 0, '2026-01-22', 0, 38),
(197, 7, 'Impermeable Conjunto Negro Cinta Reflectiva En Espalda Manga Y Bota De 2 Chaqueta Pantalon Calibre 18 Talla S A Xl', '', '', '', '', '', 69930.9, '2026-01-22', 0, 39),
(198, 7, 'Impermeable Conjunto Negro Talla Xl C/Reflectivo, Cierre Velcro Y Cremallera Con Bolso Y Zapatones Cal-16', '', '', '', '', '', 76839.8, '2026-01-22', 0, 19),
(199, 7, 'Impermeable Conjunto Pantalón Y Chaqueta. En Color Amarillo Y Negro, De Las Talla M A La Xl', '', '', '', '', '', 45060.4, '2026-01-22', 0, 40),
(200, 7, 'Impermeable Pantalon Y Chqueta Sin Botas Ni Bolsito A 60.000 Hasta La Talla Xl Azul Y Negro Con Reflectivo 1 Linea En Bota Y Espalda', '', '', '', '', '', 59788, '2026-01-22', 0, 41),
(201, 7, 'Ref 505-20 Conjunto, Chaqueta Cierre Velcro Y Cremallera, Pantalón Con Resorte, Zapaton Con Suela Y Estuche Cargador (Calibre 16, Una Franja De Reflectivo De 1 En Manga De La Chaqueta, Bota Del Pantal', '', '', '', '', '', 55881.4, '2026-01-22', 0, 42),
(202, 7, 'Ref 605-18 Conjunto, Chaqueta Cierre Velcro Y Cremallera, Pantalón Con Resorte, Zapaton Con Suela Y Estuche Cargador (Calibre 18, Una Franja De Reflectivo De 1 En Manga De La Chaqueta, Bota Del Pantal', '', '', '', '', '', 58258.4, '2026-01-22', 0, 42),
(203, 8, 'Fleece Alpaca ', '1,5', '200 Gr', '', '', '', 15984.6, '2026-01-22', 0, 43),
(204, 8, 'Fleece Polo Norte', '1,5', '230 Gr', '', '', '', 13636.7, '2026-01-22', 0, 43),
(205, 8, 'Fleece Suave Star ', '1,5', '128 Gr ', '100% Poliester ', '', '', 9058.43, '2026-01-22', 0, 13),
(206, 8, 'Fleece Super Fleeese', '', '', '', '', '', 10761.7, '2026-01-22', 0, 44),
(207, 9, 'Deportiva Atletica Activa ', '1,6', '140 Gr ', '100%Poliester Strech Mecanico Rendimiento 4,6', '', '', 3841.99, '2026-01-22', 0, 8),
(208, 9, 'Deportiva Bahhia 1.56', '1.56', '212', '80%Poliester -20% lycra', '', '', 29900, '2026-03-12', 0, 3),
(209, 9, 'Deportiva Bosstex Sec ', '', '', '100% Poliester', '', '', 7944.86, '2026-01-22', 0, 17),
(210, 9, 'Deportiva Dual', '1,57', '', '', '', '', 21290.5, '2025-12-15', 0, 3),
(211, 9, 'Deportiva Dunga Sec ', '1,5', '', '', '', '', 5767.3, '2026-01-22', 0, 13),
(212, 9, 'Deportiva Hydrotech ', '1,5', '', '', '', '', 18500, '2026-02-23', 0, 3),
(213, 9, 'Deportiva Hydrotech Antibact', '1,47', '', '', '', '', 19673.5, '2025-12-15', 0, 3),
(214, 9, 'Deportiva Hydrotech Reciclado Antibacterial ', '1,5', '', '100% POLIESTER', '', '', 19673.5, '2025-12-15', 0, 3),
(215, 9, 'Deportiva Megafil Sec ', '1,5', '', '', '', '', 6391.46, '2026-01-22', 0, 13),
(216, 9, 'Deportiva Montecarmelo ', '', '155 Gr  ', 'Poliéster 100% Microfibra ', '', '', 6166.16, '2026-01-22', 0, 51),
(217, 9, 'Deportiva Montesimone Reciclado', '', '', '', '', '', 22691.9, '2025-12-15', 0, 3),
(218, 9, 'Deportiva Montesimone', '1,52', '134', '100% POLIESTER', '', '', 23150, '2026-03-12', 0, 3),
(219, 9, 'Deportiva Paraiso ', '', '139 Gr  ', '100%Poliester ', '', '', 5276.81, '2026-01-22', 0, 51),
(220, 9, 'Deportiva Sportwear (Sudafrica) ', '1,55', '120 Gr', '100%Poliester ', '', '', 7707.7, '2026-01-22', 0, 27),
(221, 9, 'Deportiva Sudafrica ', '1,5', ' 145 Gr', '100%Poliester', '', '', 8644.48, '2026-01-22', 0, 17),
(222, 9, 'Deportiva Stamina', '1,48', '', '', '', '', 24847.9, '2025-12-15', 0, 3),
(223, 9, 'Deportiva Stepway', '1,7', '245 Gr', '92% Poliester 8% lycra ', '', '', 33150, '2026-03-12', 0, 3),
(224, 9, 'Deportiva Zanetti ', '1,73', '143', '100% POLIESTER', '', '', 20800, '2026-03-12', 0, 3),
(225, 10, 'Dril Borneo Plus segunda opcion  (Oriòn) ', '1,5', '230 Gr', '65% Poliester - 35%Algodon ', '', '', 9691.22, '2026-01-22', 0, 8),
(226, 10, 'Dril Cìtrico (Gabardina)', '', '', '', '', '', 13636.7, '2026-01-22', 0, 26),
(227, 10, 'Dril Malpelo ', '1,4', '240 Gr', '65% Poliester -35%Algodon ', '', '', 11265.1, '2026-01-22', 0, 34),
(228, 10, 'Dril Noruego (Chefs-Medicos) ', '1,5', '190 Gr', '80% Poliester - 20%Algodon', '', '', 10079.3, '2026-01-22', 0, 8),
(229, 10, 'Dril Orion ', '1,5', '240 Gr   ', '65% Poliester-35%Algodòn ', '', '', 9676, '2026-04-18', 0, 2),
(230, 10, 'Dril Orion 15 ', '1,5', '240 Gr', '65% Poliester-35%Algodòn ', '', '', 13769.3, '2026-01-22', 0, 15),
(231, 10, 'Dril Pocker ', '', '', '', '', '', 13992.4, '2026-01-22', 0, 9),
(232, 10, 'Dril Qatar', '1,5', '', '', '', '', 21750, '2026-02-19', 0, 3),
(233, 10, 'Dril Santafe textilera ', '1,5', '245 Gr', '65% Poliester - 35%Algodon. ', '', '', 10840, '2026-02-24', 0, 4),
(235, 10, 'Dril Universal Ecologico 32 ', '1,6', '220 Gr', '70% Algodòn - 30% Polies Reciclado ', '', '', 0, '2026-01-22', 0, 32),
(236, 11, 'Dril A100 MAX ', '1,6', '260 Gr', '100% Algodòn Colorante Reactivo ', '', '', 16723, '2026-03-19', 0, 4),
(237, 11, 'Dril Activo 32 ', '1,6', '250 Gr', '100% Algodón Colorante Reactivo Alta Fijacion ', '', '', 0.7, '2026-01-30', 0, 32),
(239, 11, 'Dril Apolo Colorante Reactivo Alta Fijacion ', '1,6', '7,4 Onz', '100% Algodón ', '', '', 18854.2, '2026-01-22', 0, 34),
(240, 11, 'Dril Espartano  Colorante Quimico Reactivo', '1,6', '265 Gr', '100%Algodon ', '', '', 16126.9, '2026-01-22', 0, 8),
(242, 11, 'Dril Forza ', '1,5', '220 Gr ', '35% Algodón / 65% Poliéster ', '', '', 12521, '2026-02-18', 0, 4),
(243, 11, 'Dril Forza', '1,5', '278', '100 % Algodon', '', '', 25800, '2026-02-18', 0, 3),
(244, 11, 'Dril Frutal', '1,67', '7,8 Onzas ', '100% Algodòn Blanco', '', '', 15296.8, '2026-01-22', 0, 26),
(245, 11, 'Dril Frutal Colores', '1,67', '7,8 Onzas ', '100% Algodòn ', '', '', 9711.7, '2026-01-22', 0, 26),
(246, 11, 'Dril Goliat  Reactivo Quimico No Tina,', '1,68', '7,4 Onz', '100% Algodon', '', '', 19429.9, '2026-01-22', 0, 46),
(247, 11, 'Dril Goliat Por Metro  Reactivo Quimico No Tina', '1,68', '7,4 Onz', '100% Algodon', '', '', 21702.3, '2026-01-22', 0, 46),
(248, 11, 'Dril Goliat  Reactivo Quimico No Tina', '1,68', '7,4 Onz', '100% Algodon', '', '', 19328.5, '2026-01-22', 0, 9),
(249, 11, 'Dril Hercules  Con Colorante Tina Medios', '1,58', '8 Onz 260 G', '100% Algodón', '', '', 12621, '2026-02-06', 0, 8),
(251, 11, 'Dril Kael  Sin Colorante Tina ', '1,6', '250 Gr', '100% Algodón', '', '', 18727, '2026-03-26', 0, 2),
(252, 11, 'Dril Kratos  ', '1,6', '', '100% Algodón', '', '', 12450.9, '2026-01-22', 0, 9),
(253, 11, 'Dril Nadal  Sin Colorante Tina', '1,6', '', '100% Algodón', '', '', 15300, '2026-03-26', 0, 16),
(254, 11, 'Dril Pegasso Medios Colorante Tina, Pelicula Anticloro, Proteccion Uv ', '1,68', '7,4 Onzas', '100% Algodón', '', '', 19404, '2026-01-22', 0, 34),
(255, 11, 'Dril Pegasso Oscuros Colorante Tina, Pelicula Anticloro, Proteccion Uv', '1,68', '7,4 Onzas', '100% Algodón', '', '', 19404, '2026-01-22', 0, 34),
(256, 11, 'Dril Raza  ', '1,6', '', '100% Algodòn', '', '', 14009.7, '2026-01-22', 0, 9),
(257, 11, 'Dril Raza Azteca  Colorante Tina ', '1,6', '275 Gr', '100% Algodòn', '', '', 20348.3, '2026-01-22', 0, 32),
(258, 11, 'Dril Raza Detal  Colorante Tina', '1,6', '2,15 Gr 7,6 Onzas', '100% Algodòn   ', '', '', 22719.9, '2026-01-22', 0, 44),
(259, 11, 'Dril Uniextrom ', '1,6', '250 Gr', '65%Algodon - 35%Poliester ', '', '', 11383.7, '2026-01-22', 0, 8),
(260, 11, 'Dril Universo 32  Colorante Tina', '1,6', '250 Gr', '100% Algodòn ', '', '', 17668.4, '2026-01-22', 0, 32),
(262, 11, 'Dril Vulcano O Activo  Con Colorante Reactivo Alta Fijacion', '1,6', '250 Gr', '100% Algodon', '', '', 18901, '2026-01-30', 0, 32),
(263, 11, 'Dril Rip Stop A r', '1,5', '185 Gr', '35% Algodón / 65% Poliéste', '', '', 15444.5, '2026-01-22', 0, 4),
(264, 12, 'Dril Sapndex Austin ', '1,6', '', '97% Algodón 3% Elastomero ', '', '', 19553.8, '2026-01-22', 0, 24),
(265, 12, 'Dril Spandex Espiga ', '1,57', '8 Onz ', '98 Algodo 2%Spadex ', '', '', 20040, '2026-01-22', 0, 26),
(267, 12, 'Dril Spandex Asuncion ', '1,6', '', '97% Algodón - 3% Elastomero', '', '', 21099.7, '2026-01-22', 0, 2),
(268, 12, 'Dril Spandex Avatar Flex', '1,6', '255 Gr 7,5onz', ' 98% Algodon 2% Spandex ', '', '', 22411.6, '2026-01-22', 0, 7),
(269, 12, 'Dril Spandex Biscaia ', '1,55', '6,4 Onzas ', '', '', '', 15534, '2026-01-22', 0, 8),
(270, 12, 'Dril Spandex Everest ', '1,6', '224 Gr', '97,5% - Algodón 2,5 % Elastomero  ', '', '', 19943, '2026-01-22', 0, 16),
(271, 12, 'Dril Spandex Everest Detal', '', '', '', '', '', 26405.6, '2026-01-22', 0, 15),
(272, 12, 'Dril Spandex Lenovoflex Elit  ', '1,4', '220 Gr', '59% Algodón -38%Poliester -3%Spandex', '', '', 11990, '2026-04-01', 0, 13),
(273, 12, 'Dril Spandex Lenovoflex Gold ', '1,4', '210 Gr', '59% Algodon - 38%Poliester - 3%Spandex ', '', '', 12990, '2026-04-01', 0, 13),
(274, 12, 'Dril Spandex Lisboa', '1,5', '260 Gr', '95% Algodon-5% Lycra', '', '', 19829.8, '2026-01-22', 0, 4),
(275, 12, 'Dril Spandex Liverpool', '', '', '', '', '', 0, '2026-01-22', 0, 47),
(276, 12, 'Dril Spandex Monserrate', '1,6', '265 Gr', '97,5% Algodon-2,5% Spandex', '', '', 16900.6, '2026-01-30', 0, 16),
(277, 12, 'Dril Spandex Moon ', '1,55', '198 Gr 7onz ', '98% Algodón -2% spandex', '', '', 16008.3, '2026-01-22', 0, 8),
(278, 12, 'Dril Spandex New Orleans', '', '', '', '', '', 0, '2026-01-22', 0, 47),
(279, 12, 'Dril Spandex Nouvelle - Delgado', '1,4', '216 Gr', '97% Algodón - 3% Spandex', '', '', 18368, '2026-01-22', 0, 13),
(280, 12, 'Dril Spandex Otawa ', '1,47', '', '98,66% Algodón 1,34%Spandex', '', '', 17182.2, '2026-01-22', 0, 48),
(281, 12, 'Dril Spandex Phoebe ', '1,44', 'Gr 7,3 Onz', '98%Algodon-2%Spandex ', '', '', 18854.2, '2026-01-22', 0, 7),
(282, 12, 'Dril Spandex Royal ', '1,5', '6,5 Onz', '97% Algodón - 3% Spandex, ', '', '', 18960.9, '2026-01-22', 0, 13),
(283, 12, 'Dril Spandex Star', '', '', '', '', '', 15800, '2026-02-19', 0, 8),
(284, 12, 'Dril Spandex Sun', '', '', '', '', '', 15652.6, '2026-01-22', 0, 8),
(285, 12, 'Dril Spandex Versalles 2 ', '1,5', '218 Gr', '98%Algod-2%Elastomero ', '', '', 20875.5, '2026-01-22', 0, 2),
(286, 12, 'Dril Star ', '', '7,5 Onza', '98% Alg-2 Span ', '', '', 15800, '2026-02-19', 0, 8),
(287, 13, 'Forro Vaskanit ', '1,55', '110 Gr', '100% Poliester', '', '', 4387.46, '2026-01-22', 0, 5),
(288, 13, 'Forro Brioni', '1,5', '', '', '', '', 20535.9, '2025-12-15', 0, 3),
(289, 13, 'Forro Briony Ancho ', '1,5', '', '', '', '', 3853.85, '2026-01-22', 0, 2),
(290, 13, 'Forro Briony 1 Ancho ', '1,5', '', '', '', '', 2291.83, '2026-01-22', 0, 1),
(291, 13, 'Forro Margaret Db ', '1,47', '120 Gr', '100%Poliester', '', '', 8288.74, '2026-01-22', 0, 43),
(292, 13, 'Forro Miami', '1,5', '', '', '', '', 12235.3, '2025-12-15', 0, 3),
(293, 13, 'Forro Michigan', '1,5', '', '', '', '', 15577.1, '2025-12-15', 0, 3),
(294, 13, 'Forro Microtitan', '1,48', '', '', '', '', 28674.8, '2025-12-15', 0, 3),
(295, 13, 'Forro Tafeta', '1,5', '', '', '', '', 2291.83, '2026-01-22', 0, 1),
(296, 13, 'Forro Uruguay ', '1,5', '110 Gr Kilo Rendimiento 6', '94,2 Polliester - 5,8 Elastano ', '', '', 8656.34, '2026-01-22', 0, 43),
(297, 14, 'Franela Barcelona (Tenemos Muestra)  ', '1,6', '150 Gramos', 'Poliester 65% -Algodón 35%,', '', '', 0, '2026-01-22', 0, 49),
(298, 14, 'Franela Barcelona (Tenemos Muestra)  Puede Homologar La Hamburgo', '1,6', '150 Gr', 'Poliester 65% -Algodón 35%', '', '', 0, '2026-01-22', 0, 49),
(299, 14, 'Franela Bavara', '', '', '', '', '', 10778.9, '2026-01-22', 0, 9),
(300, 14, 'Franela Bavara (Malagueña) ', '1,68', '190 Gr', '65%Poliester - 35% Algodón  ', '', '', 16242.2, '2026-01-22', 0, 50),
(301, 14, 'Franela Bavara 34', '1,7', '', '', '', '', 11858, '2026-01-22', 0, 34),
(302, 14, 'Franela Bavara Classic Blanco ', '1,8', '', '50% poliester - 50% Algodon ', '', '', 15640.7, '2026-01-22', 0, 16),
(303, 14, 'Franela Bavara Classic Claros ', '1,8', '', '50% poliester - 50% Algodon ', '', '', 16826.5, '2026-01-22', 0, 16),
(304, 14, 'Franela Bavara Classic Oscuros', '1,8', '', '50% Poleste - 50% Algodón  ', '', '', 18166.5, '2026-01-22', 0, 16),
(305, 14, 'Franela Bavaria Blancos', '1,8', '205 Gr Rend 2,71', '50%Poliester-50%Algodon', '', '', 16873.9, '2026-01-22', 0, 43),
(306, 14, 'Franela Bavaria  ', '1,8', '205 Gr Rend 2,71 Claro', '50%Poliester-50%Algodon ', '', '', 18913.5, '2026-01-22', 0, 43),
(307, 14, 'Franela Bavaria   Oscuros', '1,8', '205 Gr Rend 2,71', '50%Poliester-50%Algodon', '', '', 21795, '2026-01-22', 0, 43),
(308, 14, 'Franela Baviera Colores varios ', '1,7', '190 Gr', '65%Poliester-35%Algodon', '', '', 8800, '2026-02-16', 0, 51),
(310, 14, 'Franela Centauro ', '1,6', 'Rendimiento 3,5 - Minimo 3 Kil', '93%Algodon- 7%Spandex Algodón Peinado ', '', '', 14225.3, '2026-01-22', 0, 13),
(311, 14, 'Franela Danesa ', '1,46', '166 Gr', '65%Poliester -35% Algodón ', '', '', 10541.8, '2026-01-22', 0, 13),
(312, 14, 'Franela Escandinava Claros  Carga Min 580 Mts Por Color', '1,75', '155 Gr ', '100% Algodón Peinado', '', '', 13992.4, '2026-01-22', 0, 51),
(313, 14, 'Franela Escandinava Oscuros  Carga Min 580 Mts Por Color', '1,75', '155 Gr', '100% Algodón Peinado', '', '', 16008.3, '2026-01-22', 0, 51),
(314, 14, 'Franela Fria Peach, Kiwi', '', '', '', '', '', 0, '2026-01-22', 0, 14),
(315, 14, 'Franela Gold ', '1,6', '130 Gr', '95% Poliester-5% Spandex ', '', '', 5826.59, '2026-01-22', 0, 8),
(316, 14, 'Franela Hamburgo Rigida Color ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó', '', '', 13743.4, '2026-01-22', 0, 16),
(317, 14, 'Franela Hamburgo Rigida Blanco ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó ', '', '', 12925.2, '2026-01-22', 0, 16),
(318, 14, 'Franela Hamburgo Suave Blanco ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó ', '', '', 13518.1, '2026-01-22', 0, 16),
(319, 14, 'Franela Hamburgo Suave Color ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó', '', '', 15083.4, '2026-01-22', 0, 16),
(320, 14, 'Franela Harriet ', '1,7', '240 Gr', '100% Algodón ', '', '', 19553.8, '2026-01-22', 0, 13),
(321, 14, 'Franela Jeremy ', '1,8', '180 Gr', '100% Algodón ', '', '', 16589.3, '2026-01-22', 0, 13),
(322, 14, 'Franela Jersey Supergaroto Silk  Encogim 3% Tintura A Partir 1000 Metros', '1,55', '150 Gr', '100% Algodón', '', '', 14217.7, '2026-01-22', 0, 13),
(323, 14, 'Franela Minotauro ', '1,6', '', 'Algodón + Spandex', '', '', 13518.1, '2026-01-22', 0, 13),
(324, 14, 'Franela Nevada ', '1,8', '192 Gr', '65%Pol-35%Alg', '', '', 8419.18, '2026-01-22', 0, 30),
(325, 14, 'Franela Topacio Claros (Parecida A La Bavara)  s Encog 3% Tintura A Partir 800 Mts', '1,6', '180 Gr', '65%Poliester-35%Algodon ', '', '', 10304.6, '2026-01-22', 0, 13),
(326, 14, 'Franela Topacio Oscuros Y Gj(Parecida A La Bavara)   Encog 3% Tintura A Partir 800 Mts', '1,6', '180 Gr', '65%Poliester-35%Algodon', '', '', 11490.4, '2026-01-22', 0, 13),
(327, 15, 'Gorra Beisbolera Hebilla Metalica Al Por Mayor', '', '', '', '', '', 7007, '2026-01-22', 0, 52),
(328, 15, 'Gorra Tipo Chavo Dril Azul Oscuro A Partir 12 Unidades', '', '', '', '', '', 8605.67, '2026-01-22', 0, 52),
(329, 16, 'Ignifgas Ultra Soft ', '1,6', '7 oz', '', '', '', 82520.9, '2025-12-15', 0, 3),
(330, 16, 'Ignifugas Dh ', '1,55', '6,5 oz', '', '', '', 109805, '2025-12-15', 0, 3),
(331, 16, 'Ignifugas Indigo ', '1,7', '14 oz', '', '', '', 90061.5, '2025-12-15', 0, 3),
(332, 16, 'Ignifugas Indura ', '1,6', '7 oz', '', '', '', 67750, '2026-02-19', 0, 3),
(333, 16, 'Ignifugas Indura ', '1,6', '9 oz', '', '', '', 0, '2026-02-19', 0, 3),
(334, 16, 'Ignifugas Ultra Soft ', '1,6', '9 oz', '', '', '', 113481, '2025-12-15', 0, 3),
(335, 16, 'Ignifugas Ultra Soft Rib ', '1,45', '10 oz', '', '', '', 228089, '2025-12-15', 0, 3),
(336, 17, 'Impermeable Campero LM 100% pol 1.50 anch ', '1.50', '201 gr', '100% Poliester ', '', '', 32950, '2026-04-17', 0, 3),
(337, 17, 'Impermeable Branta', '1,47', '', '', '', '', 51744, '2025-12-15', 0, 3),
(338, 17, 'Impermeable Cerrusport', '1,5', '', '', '', '', 34927.2, '2025-12-15', 0, 3),
(339, 17, 'Impermeable Gavia', '1,49', '', '', '', '', 0, '2025-12-15', 0, 3),
(340, 17, 'Impermeable Glou Crushed', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(341, 17, 'Impermeable Gorek Alta Visibilidad ', '1,5', '138gr', '100% POLIESTER', '', '', 20650, '2026-03-25', 0, 3),
(342, 17, 'Impermeable Gorek', '1,5', '138gr', '100% POLIESTER', '', '', 20428.1, '2025-12-15', 0, 3),
(343, 17, 'Impermeable Kasac ', '1,5', '', '', '', '', 22152.9, '2025-12-15', 0, 3),
(344, 17, 'Impermeable Orion Cloro Resistente', '1.68', '113', '100% POLIESTER', '', '', 24200, '2026-02-26', 0, 3),
(345, 17, 'Impermeable Orion Stretch', '1,7', '', '', '', '', 25950, '2026-02-11', 0, 3),
(346, 17, 'Impermeable Tempestad Alta Visibilidad Evolut', '1,5', '', '', '', '', 34280.4, '2025-12-15', 0, 3),
(347, 17, 'Impermeable Tempestad', '1,5', '', '', '', '', 28567, '2025-12-15', 0, 3),
(348, 17, 'Impermeable Top Gun ', '1,5', '', '', '', '', 35804.7, '2025-12-15', 0, 3),
(349, 17, 'Impermeable Top Gun Alta Visibilidad ', '1,51', '', '', '', '', 38808, '2025-12-15', 0, 3),
(350, 17, 'Impermeable Tormenta Homologa El Tempestad De 3', '1,51', '', '', '', '', 19802.9, '2026-01-22', 0, 10),
(351, 17, 'Impermeable Vendaval ', '1,5', '', '', '', '', 23265.4, '2025-12-15', 0, 3),
(352, 17, 'Impermeable Vendaval Cloro Resitente', '1,5', '', '', '', '', 23500.4, '2025-12-15', 0, 3),
(353, 17, 'Impermeable Vendaval Crushed', '1,5', '', '', '', '', 25386.9, '2025-12-15', 0, 3),
(354, 18, 'Indigo Avila Viscosa ', '1,67', 'Pesos 10 Oz', '31,5%Pol-62%Algo-6,5% ', '', '', 14715.8, '2026-01-22', 0, 2),
(356, 18, 'Indigo  Apolo 2 pago contado', '1,70', '12.5 Oz', '100% Algodón', '', '', 11200, '2026-02-24', 0, 8),
(357, 19, 'Indigo Nuevo Romano   1metro 15546', '1,68', '7 Oz', '', '', '', 12605, '2026-02-27', 0, 31),
(358, 19, 'Indigo Twill   ', '1,8', '5,5 oz', '100% Algodón', '', '', 16601.2, '2026-01-22', 0, 16),
(359, 19, 'Indigo Twill Corsega  ', '1,5', '4,5 Oz', '100% Algodòn', '', '', 12557.6, '2026-01-22', 0, 16),
(360, 19, 'Indigo Camisa Indigo ', '', '7 Oz', '', '', '', 23597.4, '2026-01-22', 0, 54),
(361, 19, 'Indigo Camisero ', '1,7', '4 ,1 Oz ', '100% Algodón ', '', '', 21344.4, '2026-01-22', 0, 31),
(362, 19, 'Indigo Camisero 1969  ', '1,7', '10 Oz', '100% Algodón', '', '', 19328.5, '2026-01-22', 0, 2),
(363, 19, 'Indigo Camisero ', '1,7', '5 Oz', '', '', '', 19210, '2026-01-22', 0, 31),
(364, 19, 'Indigo Camisero  ', '1,5', '6,8 Oz', '100% Algodón', '', '', 11146.5, '2026-01-22', 0, 16),
(365, 19, 'Indigo Camisero ', '1,7', '9,5 Oz ', '70%Algod-28% Poliester- 2 Elastano ', '', '', 22411.6, '2026-01-22', 0, 31),
(366, 19, 'Indigo Camisero ', '1,63', '5 Oz', '70%Algod-30% Poliester  ', '', '', 19210, '2026-01-22', 0, 31),
(367, 19, 'Indigo Camisero America ', '1,67', '7 Oz', '100% Algodon', '', '', 16025.5, '2026-01-22', 0, 2),
(368, 19, 'Indigo Camisero Arles ', '1,5', '8,5 Oz', 'Comp Algodón + Poliester + Lycra', '', '', 15415.4, '2026-01-22', 0, 2),
(369, 19, 'Indigo Camisero Atenea ', '', '6 Oz', '100% Algodón ', '', '', 0, '2026-01-22', 0, 8),
(370, 19, 'Indigo Camisero Claire ', '1,7', '7 Oz ', '', '', '', 13755.3, '2026-01-22', 0, 55),
(371, 19, 'Indigo Camisero Latino ', '', '7 Oz ', '100% Algodón 1,70 Ancho', '', '', 12332.3, '2026-01-22', 0, 8),
(372, 19, 'Indigo Camisero Michigan ', '1,7', '5,3 Oz', '100% Algodón ', '', '', 13518.1, '2026-01-22', 0, 56),
(373, 19, 'Indigo Camisero Mucura ', '1,6', '10,4 Oz ', '100% Algodón ', '', '', 22411.6, '2026-01-22', 0, 31),
(374, 19, 'Indigo Camisero Pandora    0% Encogimiento', '1,7', '7 Oz', '100% Algodón', '', '', 0, '2026-01-22', 0, 8),
(375, 20, 'Indigo ', '', '', '', '', '', 17431.3, '2026-01-22', 0, 34),
(376, 20, 'Indigo Chronos ', '1,7', '13 Oz ', '80% Algodón -20%Poliester ', '', '', 13992.4, '2026-01-22', 0, 8),
(377, 20, 'Indigo ', '', '12 Oz', '100% Algodón  ', '', '', 15356.1, '2026-01-22', 0, 57),
(378, 20, 'Indigo 13 Onz Peso ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 17957.3, '2026-01-22', 0, 55),
(379, 20, 'Indigo Alfa ', '1,67', '12,8 Oz  ', '90%Algodon - 10% Poliester ', '', '', 17300.8, '2026-01-22', 0, 32),
(380, 20, 'Indigo Apolo 2 ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 14553, '2026-01-22', 0, 2),
(381, 20, 'Indigo Apolo 2 ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 11700, '2026-02-20', 0, 8),
(382, 20, 'Indigo Coloso ', '1,7', '13,75 Oz ', '100% Algodón ', '', '', 17609.1, '2026-01-22', 0, 8),
(383, 20, 'Indigo Dallas ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 19349, '2026-01-22', 0, 2),
(384, 20, 'Indigo Damasco ', '1,7', '13.5 Oz ', '', '', '', 18617.1, '2026-01-22', 0, 58),
(385, 20, 'Indigo Denver ', '1,69', '13,5 Oz ', '100% Algodón ', '', '', 21381.1, '2026-01-22', 0, 2),
(386, 20, 'Indigo Detroit ', '1,7', '13,75 Oz ', '100% Algodón ', '', '', 17668.4, '2026-01-22', 0, 53),
(387, 20, 'Indigo Inti ', '1,7', '12 Oz  ', '27%Poliester - 61%Algodon - 12%Viscosa ', '', '', 16025.5, '2026-01-22', 0, 2),
(388, 20, 'Indigo Lemmon ', '1,68', '12,5 Oz ', '100%Algodon', '', '', 11383.7, '2026-01-22', 0, 26),
(389, 20, 'Indigo Marvel ', '1,7', '13 Oz ', '100% Algodón ', '', '', 16838.4, '2026-01-22', 0, 34),
(390, 20, 'Indigo Super Inti ', '1,7', '12 Oz  ', '34%Poliester - 53%Algodon - 13%Rayon ', '', '', 16177.5, '2026-01-22', 0, 2),
(391, 20, 'Indigo Tazmania ', '1,7', '12 Oz ', '', '', '', 12289.2, '2026-01-22', 0, 57),
(392, 20, 'Indigo Tera ', '1,7', '13,5 Oz ', '100% Algodón ', '', '', 17312.7, '2026-01-22', 0, 9),
(393, 20, 'Indigo Texano ', '1,69', '12,5 Oz ', '100% Algodón ', '', '', 19349, '2026-01-22', 0, 2),
(394, 20, 'Indigo Tronic Delta ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 19565.7, '2026-01-22', 0, 9),
(395, 20, 'Indigo Tronic ', '1,7', '12,5 Oz', '100% Algodón ', '', '', 18735.6, '2026-01-22', 0, 9),
(396, 20, 'Indigo Tundra ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 17668.4, '2026-01-22', 0, 53),
(397, 20, 'Indigo Venecia ', '1,75', '13 Oz ', '100% Algodón ', '', '', 14229.6, '2026-01-22', 0, 56),
(398, 20, 'Indigo Vesubio ', '1,68', '13 Oz ', '100% Algodón Recilado ', '', '', 18854.2, '2026-01-22', 0, 34),
(399, 20, 'Indigo Vesubio Fabricato  ', '1,7', '12,6 Oz ', '100% Algodón', '', '', 17075.5, '2026-01-22', 0, 16),
(400, 20, 'Indigo Zeus  ', '1,7', '13,75 Oz ', '100% Algodón  ', '', '', 16482.6, '2026-01-22', 0, 2),
(401, 20, 'Indigo ', '1,7', '12,75 Oz', '100% Algodón ', '', '', 16018, '2026-01-22', 0, 26),
(402, 21, 'Indigo Bybury ', '1,84', '9,5 Oz ', 'Alg-Spandex', '', '', 12251.5, '2026-01-22', 0, 2),
(403, 21, 'Indigo Finlandia ', '1,33', '', '65% Algodon - 31%Poliester - 4% Lycra ', '', '', 13399.5, '2026-01-22', 0, 56),
(404, 21, 'Indigo Gènesis ', '1,6', '11,3 Oz ', '98%Poliester - 2%Spandex ', '', '', 15178.2, '2026-01-22', 0, 56),
(405, 21, 'Indigo Granada ', '1,54', '10 oz', '97% Algodon - 3%Lycra ', '', '', 13281, '2026-01-22', 0, 56),
(406, 21, 'Indigo Spandex Carlin ', '1,65', '10 Oz', '97% Indigo-3 Spandex ', '', '', 17034.6, '2026-01-22', 0, 55),
(407, 21, 'Indigo Spandex Mikonos ', '1,45', '9,7 Oz ', '98% Algodon -2 Spandex', '', '', 21344.4, '2026-01-22', 0, 8),
(408, 21, 'Indigo Spandex Missy Azul ', '1,44', '8,8 Oz ', '67% Algodon-30%Poliester- 3% Spandex', '', '', 16364, '2026-01-22', 0, 8),
(409, 21, 'Indigo Spandex Mostaza ', '1,6', '9 Oz', '79% Algodon - 19%Poliester - 2%Spdex', '', '', 10553.6, '2026-01-22', 0, 26),
(410, 21, 'Inidgo Licrado ', '1,8', '', '98%Algodon - 2%Elastano ', '', '', 20099.3, '2026-01-22', 0, 32),
(411, 22, 'Jean Dama ', '', '', '68% Algodón 20%  Poliester 2 Elastano ', '', '', 30618.4, '2026-01-22', 0, 59),
(412, 22, 'Jean Dama ', '', '', '68% Algodón 20% Poliester 2 Elastano ', '', '', 30618.4, '2026-01-22', 0, 59),
(413, 22, 'Jean Dama  ', '', '', '68% Algodón 20% Poliester 2 Elastano', '', '', 30618.4, '2026-01-22', 0, 59),
(414, 22, 'Jean Dama Con Spandex ', '', '', '', '', '', 26087.6, '2026-01-22', 0, 54),
(415, 22, 'Jean Dama ', '', '8 Oz', '', '', '', 33880.5, '2026-01-22', 0, 60),
(416, 22, 'Jean Dama ', '', '', '', '', '', 36868.7, '2026-01-22', 0, 60),
(417, 22, 'Jean Dama', '', '', '', '', '', 32883.3, '2026-01-22', 0, 60),
(418, 22, 'Jean Hombre Dotacion Composicion ', '', '', '', '', '', 31389.2, '2026-01-22', 0, 59),
(419, 22, 'Jean Hombre Dotacion Composicion', '', '', '', '', '', 34378.5, '2026-01-22', 0, 59),
(420, 22, 'Jean Hombre Dotacion Composicion ', '', '', '', '', '', 37367.8, '2026-01-22', 0, 59),
(421, 22, 'Jean Hombre Rigido ', '', '14 Oz', '', '', '', 26087.6, '2026-01-22', 0, 54),
(422, 22, 'Jean Hombre  ', '', '', 'Spandex', '', '', 35274.3, '2026-01-22', 0, 59),
(423, 22, 'Jean Hombre  ', '', '', 'Spandex', '', '', 38263.6, '2026-01-22', 0, 59),
(424, 22, 'Jean Hombre Talla 28 A 36', '', '', '', '', '', 29894, '2026-01-22', 0, 60),
(425, 22, 'Jean Hombre Talla 38 A 42', '', '', '', '', '', 31887.2, '2026-01-22', 0, 60),
(426, 22, 'Jean Hombre Talla 44-46 Y 48', '', '', '', '', '', 34876.5, '2026-01-22', 0, 60),
(427, 22, 'Jean Spandex Negro Caballero ', '', '', '', '', '', 39858, '2026-01-22', 0, 59),
(428, 22, 'Jean Spandex Negro Caballero ', '', '', '', '', '', 42848.3, '2026-01-22', 0, 59),
(429, 22, 'Jean Spandex Negro Dama ', '', '', '', '', '', 42748.1, '2026-01-22', 0, 59),
(430, 22, 'Jean Spandex Negro Dama ', '', '', '', '', '', 39757.7, '2026-01-22', 0, 59),
(431, 23, 'Malla Orion Para Forro Color Blanco', '', '', '', '', '', 2608.76, '2026-01-22', 0, 5),
(432, 23, 'Malla Para Forrar Camisa Mitad Espalda Blanca', '', '', '', '', '', 4349.73, '2026-01-22', 0, 4),
(433, 23, 'Malla Para Forrar Camisa Mitad Espalda Blanca O Chaquetta', '', '', '', '', '', 3488.41, '2026-01-22', 0, 1),
(434, 24, 'Impermeable Campero', '1,5', '', '', '', '', 32286.1, '2025-12-15', 0, 3),
(435, 24, 'Impermeable Huracan', '1,5', '', '', '', '', 44251.9, '2025-12-15', 0, 3),
(436, 24, 'Lona Reebag', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(437, 25, 'Tela lino flex America Minimat  ', '1.50', '100 Gr', '100% Poliester', '', '', 5000, '2026-04-18', 0, 48),
(438, 25, 'Lino Nova (Linoflex)', '', '', '', '', '', 6147.83, '2026-01-22', 0, 2),
(439, 25, 'Lino Vertigo ', '', '', '', '', '', 16601.2, '2026-01-22', 0, 61),
(440, 25, 'Linoflex ', '1,5', '', '100% Poliester ', '', '', 6166.16, '2026-01-22', 0, 5),
(441, 25, 'Linoflex  ', '1,54', '', '100% Poliester', '', '', 7472.7, '2026-01-22', 0, 4),
(442, 25, 'Linoflex Barcelona', '1,5', '', '100% Poliester ', '', '', 6144, '2026-02-27', 0, 16),
(443, 25, 'Linoflex ', '1,5', '', '100% Poliester  ', '', '', 9594.2, '2026-01-22', 0, 16),
(444, 25, 'Linoflex ', '1,5', '', '100% Poliester ', '', '', 7473.77, '2026-01-22', 0, 62),
(445, 25, 'Linoflex  ', '', '', '100% Poliester', '', '', 6083.15, '2026-01-22', 0, 9),
(446, 25, 'Linoflex Alicia ', '1,5', '175 Oz', '100% Poliester ', '', '', 0, '2026-01-22', 0, 2),
(447, 25, 'Linoflex ', '1,5', '', '100% Poliester ', '', '', 6277.19, '2026-01-22', 0, 1),
(448, 25, 'Linoflex Esmeralda ', '1,5', '', '100% Poliester ', '', '', 4861.78, '2026-01-22', 0, 2),
(449, 25, 'Linoflex Francia', '', '', '', '', '', 6417.33, '2026-01-22', 0, 2),
(450, 25, 'Linoflex Gabardina Alegado ', '1,5', '', '', '', '', 6284.74, '2026-01-22', 0, 58),
(451, 25, 'Linoflex Gabardina Ox Café Oscuro Coidgo 12417 Seguridad Nal ', '1,47', '', '100% Poliester', '', '', 5200, '2026-02-09', 0, 5),
(452, 25, 'Linoflex 61 ', '', '', '100% Poliester ', '', '', 8300.6, '2026-01-22', 0, 61),
(453, 25, 'Linoflex London ', '1,5', '180 Gr', '100% Poliester ', '', '', 4900, '2026-03-12', 0, 8),
(454, 25, 'Linoflex Lyon ', '1,45', '', '100% Poliester ', '', '', 13043.8, '2026-01-22', 0, 25),
(455, 25, 'Pantalon Alviero Strech', '1,51', '205', '100% POLIESTER', '', '', 24578.4, '2025-12-15', 0, 3),
(456, 25, 'Pantalon Ankara Lycra', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(457, 25, 'Pantalon Batari Lycra', '1,5', '', '', '', '', 28782.6, '2025-12-15', 0, 3),
(458, 25, 'Tela pantalon Bogaz Lycra', '1,5', '250', 'Poliester 97% Lycra 3%', '', '', 29200, '2026-02-02', 0, 3),
(459, 25, 'Pantalon Bogaz Lycra Estampado', '1,5', '', '', '', '', 28620.9, '2025-12-15', 0, 3),
(460, 25, 'Pantalon Brunno Lp', '1,54', '', '', '', '', 0, '2025-12-15', 0, 3),
(461, 25, 'Pantalon Chakma ', '', '', '97%Poliester - 3%Spandex', '', '', 14984.2, '2026-01-22', 0, 24),
(462, 25, 'Pantalon Cosmos ', '1,53', '', '', '', '', 20967.1, '2025-12-15', 0, 3),
(463, 25, 'Pantalon Dynamic', '1,49', '', '', '', '', 19457.9, '2025-12-15', 0, 3),
(464, 25, 'Pantalon Elegance ', '1,35', '243 Gr', '97%Poliester-3% Elastomero ', '', '', 16482.6, '2026-01-22', 0, 29),
(465, 25, 'Pantalon Florence Detal ', '1,4', '240 Gr', '94% Poliéster, 6% Spandex', '', '', 28697.4, '2026-01-22', 0, 44),
(466, 25, 'Pantalon Florence 14 ', '1,4', '240 Gr', '94% Poliéster, 6% Spandex', '', '', 14450, '2026-05-06', 0, 14),
(467, 25, 'Pantalon Lugo', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(468, 25, 'Pantalon Lyon Linoflex Strech Mecanico ', '1,5', '', '', '', '', 17194.1, '2026-01-22', 0, 25),
(469, 25, 'Pantalon Megadrill Lafshield', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(470, 25, 'Pantalon Microdril', '1,49', '', '', '', '', 27693.8, '2025-12-15', 0, 3),
(471, 25, 'Pantalon Moretti', '1,5', '', '', '', '', 26787.2, '2025-12-15', 0, 3),
(472, 25, 'Pantalon Novastretch Lc', '1,53', '', '', '', '', 32825.1, '2025-12-15', 0, 3),
(473, 25, 'Pantalon People Strech ', '1,4', '245 Gr', '96% Poliester - 4%Spandex', '', '', 22530.2, '2026-01-22', 0, 22),
(474, 25, 'Pantalon Praga ', '1,5', '30gm ', '96% Poliester - 4% spandex Supervertigo', '', '', 12332.3, '2026-01-22', 0, 8),
(475, 25, 'Pantalon Segal Wicking', '1,5', '', '', '', '', 31589.7, '2025-12-15', 0, 3),
(476, 25, 'Pantalon Soho (Supervertigo O Studio F)  ', '1,5', '239 Gr', '96% Poliester-4%Spandex', '', '', 0, '2026-01-22', 0, 59),
(477, 25, 'Pantalon Soho', '1,51', '', '', '', '', 22314.6, '2025-12-15', 0, 3),
(478, 25, 'Pantalon Stefano R', '1,56', '', '', '', '', 31315.9, '2025-12-15', 0, 3),
(479, 25, 'Pantalon Stefano Lycra R', '1,54', '', '', '', '', 37298.8, '2025-12-15', 0, 3),
(480, 25, 'Pantalon Super Big Star ', '1,42', '216- 239 Gr', '96% Poliester 4% Elastomero  ', '', '', 14111, '2026-01-22', 0, 24),
(481, 25, 'Pantalon Super Vertigo 15 ', '1,5', '', '65% Poliester-35%Algodon', '', '', 0, '2026-03-12', 0, 15),
(482, 25, 'Pantalon Supervertigo ', '1,4', '236 Gr  ', '96% Poliester 4%Elastomero ', '', '', 13500, '2026-03-17', 0, 29),
(483, 25, 'Pantalon Supervertigo5 ', '1,45', '', '', '', '', 12953.2, '2026-01-22', 0, 5),
(484, 25, 'Pantalon Tafetan Garota ', '', '', '65% Poliester-35%Algodòn', '', '', 12834.7, '2026-01-22', 0, 2),
(485, 25, 'Pantalon Tisu', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(486, 25, 'Pantalon Trevi ', '1,6', '', '', '', '', 29081.2, '2025-12-15', 0, 3),
(487, 25, 'Pantalon Triana Lycra', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3);
INSERT INTO `tela_combinada` (`id_telacombi`, `id_tipo_tela`, `tela_combi`, `ancho`, `peso`, `caracteristicas`, `rendimiento`, `encogimiento`, `precio`, `fecha_actualizacion`, `unidades_metros`, `id_proveedor`) VALUES
(488, 25, 'Pantalon Versalles ', '1,43', '245 Gr', '95% Poliester Filamentos - 5% Elastomero ', '', '', 17341.8, '2026-01-22', 0, 4),
(489, 25, 'Pantalon Vertigo 15, Menos Pesado Que Supervertigo, Elongacion 1 Direccion ', '1,5', '200 Gr', '65%Poliester-35%Algodon ', '', '', 24546.1, '2026-01-22', 0, 15),
(490, 25, 'Pantalon Vertigo Lafayete ', '1,45', '320 Gr ', '98% Poliester 2% Spandex ', '', '', 11099.1, '2026-01-22', 0, 2),
(491, 25, 'Pantalon Vertigo Leticia   Por Ahora Solo Azul Oscuro', '1,45', '220 Gr ', '97% Poliester 3% Spandex', '', '', 0, '2026-01-22', 0, 2),
(492, 25, 'Pantalon Zulu Stretch', '1,5', '', '', '', '', 18379.9, '2025-12-15', 0, 3),
(493, 26, 'Gabardina Esparta ', '1,5', '180 Gr ', '20%Algodon - 80%Poliester ', '', '', 8507.58, '2026-01-22', 0, 2),
(494, 26, 'Gabardina Magenta ', '1,67', '200 Gr ', '49%Poliester 26%Algodon 25%Pst ', '', '', 15047.8, '2026-01-22', 0, 32),
(495, 26, 'Gabardina Olimpia Blanca ', '1,5', '182 Gr', '65%Poliester 35% Algodón ', '', '', 14293.2, '2026-01-22', 0, 2),
(496, 26, 'Tela pantalon Gabardina Praga ', '1,5', '193 Gr', '65%Pol - 35%Algodon ', '', '', 10500, '2026-04-18', 0, 2),
(497, 26, 'Gabardina Rio ', '1,5', '200 Gr', '65%Poliester - 35%Algodon', '', '', 9243, '2026-02-26', 0, 4),
(498, 26, 'Gabardina Tempo ', '1,7', '189 Gr ', '49%Poliester 26%Algodon 25%Pst ', '', '', 14111, '2026-01-22', 0, 66),
(499, 27, 'Perchado Cairo Plus', '', '', '', '', '', 11016.1, '2026-01-22', 0, 13),
(500, 27, 'Perchado Fastrack Pb', '1,63', '', '', '', '', 0, '2025-12-15', 0, 3),
(501, 27, 'Perchado Monaco ', '1,5', '264 Gr', '84%Poliester 16%Algodon ', '', '', 19553.8, '2026-01-22', 0, 13),
(502, 27, 'Perchado Monarca ', '1,5', '280 Gr', '100%Poliester ', '', '', 15877.9, '2026-01-22', 0, 13),
(503, 27, 'Perchado Montevideo ', '1,5', '164 Gr', '100%Poliester', '', '', 8644.48, '2026-01-22', 0, 13),
(504, 27, 'Perchado Seul ', '1,5', '200 Gr', '52%Poliester-48% Algodón ', '', '', 14016.2, '2026-01-22', 0, 43),
(505, 27, 'Perchado Seul ', '1,5', '200 Gr', '52%Poliester-48% Algodón ', '', '', 15723.7, '2026-01-22', 0, 43),
(506, 27, 'Perchado Seul Oscuro', '1,5', '200 Gr', '52%Poliester-48% Algodón', '', '', 18415.5, '2026-01-22', 0, 43),
(507, 27, 'Perchado Standford   Blanco', '1,5', '285 Gr', '44%Poliester-55% Algodón', '', '', 23111.2, '2026-01-22', 0, 43),
(508, 27, 'Perchado Standford  Claro', '1,5', '285 Gr', '44%Poliester-55% Algodón', '', '', 25067.8, '2026-01-22', 0, 43),
(509, 27, 'Perchado Standford Oscuro', '1,5', '285 Gr', '44%Poliester-55% Algodón', '', '', 29064, '2026-01-22', 0, 43),
(510, 28, 'Pique Palaos  Tenemos Muestra', '', '230 Gr', '', '', '', 0, '2026-01-22', 0, 0),
(511, 28, 'Pique ', '', '', '65% Poliester 35% Algodón', '', '', 22530.2, '2026-01-22', 0, 9),
(512, 28, 'Pique Action', '1,57', '', '', '', '', 33563.5, '2025-12-15', 0, 3),
(513, 28, 'Pique Antilla ', '1,8', '200 Gr', '65% Poliester 35%Algodon', '', '', 14703.9, '2026-01-22', 0, 51),
(514, 28, 'Pique Apolo ', '1,76', '', '20% Algodón - 80%Poliester ', '', '', 26680.5, '2025-12-15', 0, 3),
(515, 28, 'Pique Apoluss, Es Un Lacoste  Blanca', '1,8', '200 Gr', ' 100% Poliester ', '', '', 31962.7, '2026-01-22', 0, 50),
(516, 28, 'Pique Apoluss, Es Un Lacoste  ,  Negra Y Azul Oscura', '1,8', '200 Gr', '100% Poliester', '', '', 26893.9, '2026-01-22', 0, 50),
(517, 28, 'Pique Aranza ', '1,7', '210 Gr', '73%Pol - 27%Algo', '', '', 10990, '2026-03-17', 0, 13),
(518, 28, 'Pique Armani    Tipo Pique Lacoste Caiman $36000 Kg Rendimiento 3 Metros Venden Cuellos Y Puños', '1,5', '220 Gr', '100% Poliester', '', '', 10672.2, '2026-01-22', 0, 8),
(519, 28, 'Pique Atlantic +', '1,5', '', '', '', '', 28227.4, '2025-12-15', 0, 3),
(520, 28, 'Pique Barbados  Blanca ', '1,5', '', '65%Poliester 35% Algodón', '', '', 0, '2026-01-22', 0, 0),
(521, 28, 'Pique Cole Plus Alta Visibilidad 2.00', '', '', '', '', '', 21021, '2025-12-15', 0, 3),
(522, 28, 'Pique Cole Plus2', '', '', '', '', '', 21450, '2026-02-02', 0, 3),
(523, 28, 'Pique Dakota Classic Blanco  ', '2', '195 Gr ', '50% Poliester - 50% Algodón ', '', '', 18071.6, '2026-01-22', 0, 16),
(524, 28, 'Pique Dakota Classic Claros ', '2', '195 Gr ', '50% Poliester - 50% Algodón ', '', '', 19957, '2026-01-22', 0, 16),
(525, 28, 'Pique Dakota Classic Oscuros ', '2', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 21676.4, '2026-01-22', 0, 16),
(526, 28, 'Pique Db Color Microfibra', '1,8', '', '100% Poliester ', '', '', 13221.7, '2026-01-22', 0, 16),
(527, 28, 'Pique Decathon  (Polux)', '1,8', '', '100% Poliester', '', '', 15403.5, '2026-01-22', 0, 65),
(528, 28, 'Pique Decathon  (Polux) ', '1,8', '', '100% Poliester', '', '', 14445.2, '2026-01-22', 0, 16),
(529, 28, 'Pique Deportiva  ', '1,5', '', '100%Poliester', '', '', 10660.3, '2026-01-22', 0, 13),
(530, 28, 'Pique Deportiva Super ', '1,47', '209 Gr', '84,2 Poliester-15,8 Algodón', '', '', 12533.9, '2026-01-22', 0, 43),
(531, 28, 'Pique 60 Tipo Lacoste Blanca  Parece Apoluss,  Blanca', '1,8', '216 Gr ', '100% Poliester', '', '', 12688.1, '2026-01-22', 0, 5),
(532, 28, 'Pique 60 Tipo Lacoste Colores Parece Apoluss, ', '1,8', '216 Gr ', '100% Poliester ', '', '', 14466.8, '2026-01-22', 0, 5),
(533, 28, 'Pique Generra Blanco ', '2', '250 Gr', '50% Poliester - 50% Algodón ', '', '', 21522.3, '2026-01-22', 0, 66),
(534, 28, 'Pique Generra Claros ', '2', '250 Gr', '50% Poliester - 50% Algodón ', '', '', 22909.7, '2026-01-22', 0, 66),
(535, 28, 'Pique Generra Oscuros', '2', '250 Gr', '50% Poliester - 50% Algodón ', '', '', 24895.3, '2026-01-22', 0, 66),
(536, 28, 'Pique Hannover    Blancos', '1,8', '190 Gr', '77%Poliester-23 Algodón', '', '', 16648.6, '2026-01-22', 0, 43),
(537, 28, 'Pique Hannover    Claros', '1,8', '190 Gr', '77%Poliester-23 Algodón', '', '', 18771.2, '2026-01-22', 0, 43),
(538, 28, 'Pique Hannover    Oscuros', '1,8', '190 Gr', '77%Poliester-23 Algodón', '', '', 20561.8, '2026-01-22', 0, 43),
(539, 28, 'Pique Hannover  Tenemos Muestra', '', '200 Gr', '', '', '', 0, '2026-01-22', 0, 16),
(540, 28, 'Pique Lacost Mil Rayas ', '1,8', '210 Gr', '65%Poliester - 35%Algodon ', '', '', 10079.3, '2026-01-22', 0, 30),
(541, 28, 'Pique Lacoste ', '1,8', '200 Gr ', '65%Poliester-35% Algodón ', '', '', 12450.9, '2026-01-22', 0, 50),
(542, 28, 'Pique Lindatextil   Se Parece A La Poltexsec', '1,8', '200 Gr', '100% Poliester', '', '', 15356.1, '2026-01-22', 0, 43),
(543, 28, 'Pique Lucia ', '1,8', '220 Gr', '65% Poliester - 35% algodón   ', '', '', 11957.2, '2026-01-22', 0, 78),
(544, 28, 'Pique Madrigal Claros (Polux) ', '1,8', '220 Gr ', '100%Poliester', '', '', 8300.6, '2026-01-22', 0, 30),
(545, 28, 'Pique Madrigal Claros Homologa Polux', '', '', '', '', '', 8774.92, '2026-01-22', 0, 16),
(546, 28, 'Pique Madrigal Oscuros (Polux) ', '1,8', '220 Gr', '100%Poliester', '', '', 9012.08, '2026-01-22', 0, 0),
(547, 28, 'Pique Madrigal Oscuros Homologa Polux', '', '', '', '', '', 10458.8, '2026-01-22', 0, 0),
(548, 28, 'Pique Manila Claros ', '1,6', '180 Gr ', '80% Poliester -20% Algodón ', '', '', 7589.12, '2026-01-22', 0, 30),
(549, 28, 'Pique Manila Oscuros ', '1,6', '180 Gr', '80% Poliester -20% Algodón ', '', '', 8537.76, '2026-01-22', 0, 30),
(550, 28, 'Pique Oslo ', '1,8', '', '', '', '', 0, '2026-01-22', 0, 67),
(551, 28, 'Pique Palaos  Es Mas Suave Que Hannover Blancos', '1,8', '', '65%Poliester- 35%Algodon', '', '', 22755.5, '2026-01-22', 0, 43),
(552, 28, 'Pique Palaos   Es Mas Suave Que Hannover Claros', '1,8', '230 Gr', '65%Poliester- 35%Algodon ', '', '', 25316.8, '2026-01-22', 0, 43),
(553, 28, 'Pique Palaos   Es Mas Suave Que Hannover Oscuros', '1,8', '230 Gr', '65%Poliester- 35%Algodon', '', '', 28992.8, '2026-01-22', 0, 43),
(554, 28, 'Pique Palermo  Rollo', '1,83', '205 Gr', '100% Algodón', '', '', 26462.7, '2026-01-22', 0, 66),
(555, 28, 'Pique Poltexsec ', '1,8', '210 Gr', '100%Poliester ', '', '', 9690, '2026-03-11', 0, 13),
(556, 28, 'Pique Poluss  ', '1,65', '220 Gr', '', '', '', 13950.4, '2026-01-22', 0, 68),
(557, 28, 'Pique Poluss 34   ', '1,65', '220 Gr', '', '', '', 14822.5, '2026-01-22', 0, 34),
(558, 28, 'Pique Polux', '1,8', '226GR', '100% POLIESTER', '', '', 23400, '2026-02-13', 0, 3),
(559, 28, 'Pique 73 ', '1,9', '220 Gr ', '65% Poliester -35% Algodón ', '', '', 14148.8, '2026-01-22', 0, 50),
(560, 28, 'Pique Rus Blancos', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 19731.7, '2026-01-22', 0, 43),
(561, 28, 'Pique Ruso   Claros - 25 Dias Programacion Color', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 23182.4, '2026-01-22', 0, 43),
(562, 28, 'Pique Ruso  Oscuros 25 Dias Programacion Color', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 27309, '2026-01-22', 0, 43),
(563, 28, 'Pique Russo Blanco ', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 20538.1, '2026-01-22', 0, 66),
(564, 28, 'Pique Russo Medios ', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 24178.5, '2026-01-22', 0, 66),
(565, 28, 'Pique Russo Oscuros ', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 28459.2, '2026-01-22', 0, 66),
(566, 28, 'Pique Russo/Ref Nigeria ', '1,7', '216 Gr ', '65%Poliester-35%Algodon', '', '', 9367.82, '2026-01-22', 0, 30),
(567, 28, 'Pique Saturno ', '1,8', '180 Gr', '65% Poliester 35%Algodon', '', '', 0, '2026-01-22', 0, 69),
(568, 28, 'Pique Speed Igual A La Spray ', '1,5', '140 Gr', '100%Poliester ', '', '', 7673.2, '2026-01-22', 0, 5),
(569, 28, 'Pique Spray ', '1,47', '136 Gr', '100%Poliester ', '', '', 8763.06, '2026-01-22', 0, 43),
(570, 28, 'Pique Spray Azul Rey Y Azul La De Eve', '', '', '', '', '', 8964.65, '2026-01-22', 0, 16),
(571, 28, 'Pique Superior Claros ', '1,9', '220 Gr ', '65% Poliester 35%Algodon', '', '', 10672.2, '2026-01-22', 0, 30),
(572, 28, 'Pique Superior Medios ', '1,9', '220 Gr ', '65% Poliester 35%Algodon', '', '', 11858, '2026-01-22', 0, 0),
(573, 28, 'Pique Terranova Blanco ', '1,76', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 18729.2, '2026-01-22', 0, 66),
(574, 28, 'Pique Terranova Medios ', '1,76', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 21403.7, '2026-01-22', 0, 66),
(575, 28, 'Pique Terranova Oscuros ', '1,76', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 23301, '2026-01-22', 0, 66),
(576, 28, 'Pique Tikal R  Homologa Polux', '1,85', '', '', '', '', 29000, '2026-05-14', 0, 3),
(577, 28, 'Pique Togo ', '1,47', '110 Gr', '100% Poliester ', '', '', 7766.99, '2026-01-22', 0, 43),
(578, 28, 'Pique Ultra  Blanco', '1,8', '200 Gr', '65% Poliester 35%Algodon', '', '', 13518.1, '2026-01-22', 0, 16),
(579, 28, 'Pique Ultra    Colores', '1,8', '200 Gr', '65% Poliester 35%Algodon', '', '', 9723.56, '2026-01-22', 0, 16),
(580, 29, 'Polo Mc Blanca', '', '', '', '', '', 22420.2, '2026-01-22', 0, 70),
(581, 29, 'Polo Mc Color', '', '', '', '', '', 23416.3, '2026-01-22', 0, 70),
(582, 29, 'Polo Ml Blanca', '', '', '', '', '', 25907.6, '2026-01-22', 0, 70),
(583, 29, 'Polo Ml Color', '', '', '', '', '', 26903.6, '2026-01-22', 0, 70),
(584, 29, 'Polos Mc', '', '', '', '', '', 0, '2026-01-22', 0, 71),
(585, 30, 'Rib Bahamas Se Tiñe Con Prendas Entrega 25 A 30 Dias', '1,4', '216 Gr', '65%Poliester -35%Algodon', '', '', 9400, '2026-02-05', 0, 51),
(586, 30, 'Rib Éxito ', '1,6', '200 Gr', '65%Poliester -35%Algodon ', '', '', 17775.1, '2026-01-22', 0, 72),
(587, 30, 'Rib 73 ', '1,5', '', 'Poliesteralgodon ', '', '', 15942.5, '2026-01-22', 0, 73),
(589, 30, 'Tela Rib Supergaroto ', '1.10', '160 gr ', '100 % Algodon', '', '', 8990, '2026-02-20', 0, 13),
(590, 30, 'Rib Titanica ', '1,5', '', '64%Poliester -34%Algodon -2%Spandex ', '', '', 22233.8, '2026-01-22', 0, 13),
(591, 31, 'Genero 23  144 Hilos ', '2,5', '', '50% Poliester - 50% Algodón ', '', '', 17836.6, '2026-01-22', 0, 74),
(592, 31, 'Genero 66 144 Hilos  Solo Vende Rollos', '2,5', '', '50% Poliester - 50% Algodón', '', '', 12747.3, '2026-01-22', 0, 16),
(593, 31, 'Genero 44 144 Hilos  ', '2,4', '', '50% Poliester -  50% Algodón', '', '', 15743.1, '2026-01-22', 0, 44),
(594, 32, 'Impermeable Antimicrobial Vendaval Cloro Antimicrobial1.50', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(595, 32, 'Impermeable Orion Cloro Antimicrobial1.50', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(600, 33, 'Tela Bolsillo Negro Dajol Pc Chino ', '1,5', '', '80%Poliester -20% Algodón ', '', '', 0, '2026-01-30', 0, 16),
(602, 33, 'Tela Bolsillo Genero satinado Blanco y negro', '2.5', '250 Gr', '', '', '', 3865, '2026-02-25', 0, 1),
(603, 34, 'Tshirt Blanca  Solo Color Blanco', '', '', 'Algodón 100%', '', '', 8656.34, '2026-01-22', 0, 75),
(604, 34, 'Tshirt Mc', '', '', '', '', '', 17194.1, '2026-01-22', 0, 76),
(605, 34, 'Tshirt Mc Cuello Redondo Blanca', '', '', '', '', '', 12953.2, '2026-01-22', 0, 70),
(606, 34, 'Tshirt Mc Cuello Redondo Caballero Aritex Tallas S A Xl', '', '', '', '', '', 15743.1, '2026-01-22', 0, 77),
(607, 34, 'Tshirt Mc Cuello Redondo Color', '', '', '', '', '', 13950.4, '2026-01-22', 0, 70),
(608, 34, 'Tshirt Mc Cuello Redondo Dama Aritex Talla S A Xl', '', '', '', '', '', 16154.9, '2026-01-22', 0, 77),
(609, 34, 'Tshirt Mc Cuello V Blanca', '', '', '', '', '', 13152.7, '2026-01-22', 0, 70),
(610, 34, 'Tshirt Mc Cuellov Color', '', '', '', '', '', 14149.8, '2026-01-22', 0, 70),
(611, 34, 'Tshirt Ml Cuello Redondo Blanca', '', '', '', '', '', 15942.5, '2026-01-22', 0, 70),
(612, 34, 'Tshirt Ml Cuello Redondo Color', '', '', '', '', '', 16939.7, '2026-01-22', 0, 70),
(613, 34, 'Tshirt Ml', '', '', '', '', '', 19829.8, '2026-01-22', 0, 76),
(615, 28, 'OMEGA ', '1,8', '223 Gr', '100%poliester', '', '', 15415.4, '2026-01-22', 0, 14),
(616, 33, 'Tela Bolsillo ', '2,5', '', '', '', '', 0, '2026-01-30', 0, 16),
(617, 28, 'Pique Dornella Plus ', '1,8', '', '62% Poliester - 34% Algodón - 4% Spandex ', '', '', 18261.3, '2026-01-22', 0, 17),
(618, 1, 'Antifluido Repe Garnet1 T180 Estampada Negro Rayas base 22329 Stock 75115 Color 174405 ', '1.80', '', 'proceso digital  ', '', '', 34500, '2026-03-25', 0, 3),
(619, 1, 'Antifluido Repe Garnet1 T180 Estampada Negro Rayas base 22329 Stock 75115 Color 174405 ', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(620, 17, 'Tela poliamida Nylon  Filamentos 100%   Tafetan 1*1 Liviano (Chaquetas Cortavientos)', '1,5', '76 Gr', '', '', '', 3785.94, '2026-01-22', 0, 1),
(621, 4, 'Tela Ref 25000 ', '1,58', '100 Gr', 'Poliester 80% Algodon 20% ', '', '', 9308.53, '2026-01-22', 0, 28),
(622, 26, 'Linoflex Ref 5001 Tela Pantalonera ', '1,5', '', '100% Poliester ', '', '', 9469.15, '2026-01-22', 0, 28),
(623, 12, 'Hawai ', '1,63', '7.3 oz ', '98% Algodon 2% Elastano ', '', '', 15652.6, '2026-01-22', 0, 57),
(624, 1, 'Antifluido Potenza ', '1,45', '160 Gr', '100% Poliester ', '', '', 12999, '2026-02-18', 0, 14),
(625, 5, 'Cotton Popelin 150 ', '1,5', '', 'algodon 97% spandex 3% ', '', '', 15296.8, '2026-01-22', 0, 14),
(626, 5, 'Camisero Stretch Popelin ', '1,45', '120 Gr', 'polyester 75% algodon 23% spandex 2% ', '', '', 19943, '2026-01-22', 0, 14),
(627, 4, 'Camisero Marmara', '1,6', '120', 'Pol-Alg 92-8 ', '', '', 23716, '2025-12-15', 0, 3),
(628, 1, 'Antifluido Cosmos Cloro Spirit ', '1,52', '148 Gr', '100% Polyester ', '', '', 11990, '2026-04-16', 0, 82),
(629, 26, 'Gabardina Garota ', '1,5', '175 Gr', '', '', '', 9357, '2026-03-26', 0, 2),
(630, 9, 'Montecatini ', '1,5', '', '100% Polyester ', '', '', 7400, '2026-03-27', 0, 16),
(631, 9, 'Megafil Sec  ', '1,6', '112 Gms', '100% Polyester ', '', '', 6272.88, '2026-01-22', 0, 17),
(632, 21, 'Indigo Nakan Tejido Plano', '1,6', '318.7', '69% Filamentos de Algodon 29% Filamento de polyester 2% spandex', '', '', 12550.1, '2026-01-22', 0, 83),
(633, 28, 'Coqui Útil', '1,7', '', '3,2 - 35 Polyester 65% Algodón', '3,2', '', 8648.79, '2026-01-22', 0, 84),
(634, 14, 'Franela Jersey Crear Franela Sahara', '1,6', '149 Gm', '65% Poliéster 35% Algodón', '', '', 7233.38, '2026-01-22', 0, 84),
(635, 14, 'Franela Jabón', '1,5', '', '91% Polyester 9% Spandex', '3,5', '', 7450.06, '2026-01-22', 0, 17),
(636, 14, 'Franela Keira', '0,6', '', '33% Algodón 61% Polyester 6%Spandex', '3,5', '', 10160.2, '2026-01-22', 0, 17),
(637, 9, 'Hidrotech  ', '1.50', '138', '100% Polyester', '', '', 18500, '2026-03-12', 0, 3),
(638, 27, 'Perchado Olimpica', '1,5', '213', '46.3% Poliéster 53.7%', '', '', 20244.8, '2026-01-22', 0, 16),
(639, 27, 'Perchado Seul', '1,47', '190', '52% poliéster 48% Algodón', '3,16', '', 18142.7, '2026-01-22', 0, 16),
(640, 17, 'Tela Nylon Azul Turqueza', '', '', '100% Poliester', '', '', 4582.58, '2026-01-22', 0, 85),
(641, 4, 'Saray', '1,45', '105 Gms', '100% Poliester', '', '', 19684.3, '2026-01-22', 0, 10),
(642, 4, 'Popelina Malta Tejido Plano', '1,5', '18 Gms', '65% Poliester 35% Algodón', '', '', 9367.82, '2026-01-22', 0, 16),
(643, 4, 'Tela mega oxford  Top  Fashion ', '1.50', '165', 'pol 50% alg 50%', '', '', 9800, '2026-04-18', 0, 35),
(644, 27, 'Perchado Loto', '1,5', '', '100% Poliester', '', '', 7707.7, '2026-01-22', 0, 16),
(645, 20, 'Indigo Tokio', '1,8', '12,5 onz', '', '', '', 13970.9, '2026-01-22', 0, 83),
(646, 21, 'Indigo nakano', '1,6', '', '2% spandex 69% Algodón 29% poliester', '', '', 12550.1, '2026-01-22', 0, 83),
(647, 12, 'Dril spandex', '', '', '', '', '', 19921.4, '2026-01-22', 0, 87),
(648, 14, 'Franela Sahara R/4.2', '1,6', '149', 'Poliester algodon', '', '', 31388.1, '2026-01-22', 0, 84),
(649, 1, 'Antifluido Pacific Unicolor', '1,49', '', 'Poliester 91% Lycra 9', '', '', 27219.5, '2025-12-15', 0, 3),
(650, 1, 'ANTIFLUIDO PACIFIC PLUS LAFAYETTE STOCK 37402 Color 194056 azul rey', '', '', '', '', '', 27219.5, '2025-12-15', 0, 3),
(651, 13, 'FORRO STRONG ', '', '', '100% POLIESTER', '', '', 3664.12, '2026-01-22', 0, 14),
(652, 13, 'FORRO COLOMBIA ', '', '', '100% POLIESTER', '', '', 6251.32, '2026-01-22', 0, 14),
(653, 25, 'Tela Pantalon Patagonia ', '1.45', '204', '100% Polyester', '', '', 21560, '2026-01-22', 0, 14),
(654, 23, 'MALLA CON ARRESTO AZUL OSCURO (AGENTE TRANSITO)', '', '', '', '', '', 5425.57, '2026-01-22', 0, 88),
(655, 4, 'HAIDEN 100% POLIESTER ANCHO 1.45', '', '', '', '', '', 18433.8, '2026-01-22', 0, 10),
(656, 4, 'Andes R Estampada  100% Pol  Reciclado', '', '', '', '', '', 26550.7, '2026-01-30', 0, 3),
(657, 26, 'Tela gabardina magenta ', '1.5', '', '', '', '', 12828.2, '2026-01-22', 0, 16),
(658, 12, 'Drill New York ', '1.60', '263 gr', '97.5% Algodon 2.5% Elastomero ', '', '', 22900.2, '2026-01-30', 0, 89),
(659, 12, 'Drill Escocia pluss St ', '1.60', '270', '97% Algodon  3% Spandex', '', '', 15900, '2026-03-26', 0, 89),
(660, 4, 'CHAMBRAY DAKOTA STRECH', '145', '160 gr ', '65% Rayon 32% Poliester 3% Spandex', '', '', 11319, '2026-01-22', 0, 48),
(661, 19, 'Indigo Chambray Dakota Stretch ', '145', '160', '65% Rayon 32%poliestes 3% Spandex ', '', '', 9990, '2026-03-24', 0, 48),
(662, 27, 'Microtitan Plus Unicolor ', '1.49', '168', '100% Polyester', '', '', 28351.4, '2025-12-15', 0, 3),
(663, 4, ' Camisera Monaco 1', '147', '105', 'Pol 60% Alg 40%', '', '', 12936, '2026-01-22', 0, 14),
(664, 26, 'GABARDINA TITAN ', '', '5.06 ONZ', '', '', '', 10456.6, '2026-01-22', 0, 9),
(665, 33, 'Tela bolsillo microfibra Icoltex', '2.5', '100 gr ', '100% Polyester', '', '', 0, '2026-01-30', 0, 4),
(666, 1, 'Antifluido Nautica ', '1.50', '', 'Poliester 100%', '', '', 8877.33, '2026-01-22', 0, 44),
(667, 27, 'Perchado Piel de Angel ', '1.50', '', '100% POLIESTER', '', '', 9058.43, '2026-01-22', 0, 23),
(668, 27, 'Tela peluche ', '1.90', '', '100% POLIESTER', '', '', 22556.1, '2026-01-22', 0, 4),
(669, 4, 'Tela Resort LC base 22319 stock 24186', '1.50', '143', '100% Polyester', '', '', 23123.1, '2025-12-15', 0, 3),
(670, 9, 'Malla deportiva lamega ', '1.60', '55', '100% Polyester', '', '', 2690, '2026-03-26', 0, 13),
(673, 18, 'Indigo Perseo', '1.80', ' 12 onzas', '48% Alg 37% pol 18% Rayon ', '', '', 11900, '2026-02-24', 0, 8),
(674, 18, 'Indigo Perseo', '1.80', ' 12 onzas', '48% Alg 37% pol 18% Rayon ', '', '', 12700, '2026-02-13', 0, 8),
(675, 18, 'Indigo Dakota', '1.72', '9 onzas', '75% alg 23%pol 2% spa ', '', '', 11900, '2026-02-13', 0, 8),
(676, 23, 'Malla Kayac', '', '', '', '', '', 4998.69, '2026-01-22', 0, 4),
(677, 27, 'Perchado olimpia', '', '', '', '', '', 11685, '2026-02-24', 0, 4),
(678, 27, 'Perchado Dinamico', '', '', '100% Poliester', '', '', 9000, '2026-02-26', 0, 8),
(679, 1, 'Antifluido Mykonos', '150', '157 mg', '100% pol mecanico strech ', '', '', 19849.2, '2026-01-22', 0, 4),
(680, 17, 'Tela reflectiva para cintas color gris plata', '1.50', '', '100% POLIESTER', '', '', 10924, '2026-03-17', 0, 1),
(681, 0, 'tela', 'ancho', 'peso', 'caracteristicas', 'rendimiento', 'encogimiento', 0, '2026-01-22', 0, 0),
(682, 0, 'tela', 'ancho', 'peso', 'caracteristicas', 'rendimiento', 'encogimiento', 0, '2026-01-22', 0, 0),
(683, 1, 'Antifluido Zeus ', '1.50', '122 gr ', '100% POLIESTER', '', '', 5063, '2026-01-26', 0, 8),
(684, 1, 'Antifluido London ', '1.50', '120 gr', '100% Poliester ', '', '', 8244, '2026-01-26', 0, 4),
(685, 28, 'Pique Atlanta ', '185', '', '100% POLIESTER  Microfibra ', '', '', 11390, '2026-01-30', 0, 82),
(686, 4, 'Zara Lycra', '151', '130', '75% alg 22%pol 3% spa ', '', '', 18500, '2026-01-30', 0, 3),
(687, 4, 'Camisero srtech popelin rayas', '1.50', '118gr', '75% alg 23%pol 2% spa ', '', '', 11999, '2026-01-30', 0, 14),
(688, 14, 'Lycra Power area piscinas ', '1.50', '196 gr', 'Nylon 80% Spandex 20%', '3.0 metros por kilo', '', 20269, '2026-02-02', 0, 13),
(689, 25, 'Pantalon Referencia Noches de Viena ', '1.50', '230 Gr', '95% pol 5% spandex ', '', '', 10840, '2026-02-03', 0, 4),
(690, 6, 'Popelina Rigida Leonesa  blanca', '1.60', '120 gr', 'Pol 66% 35%', '', '', 8990, '2026-03-17', 0, 13),
(691, 9, 'Tela camiseta Centauro ', '1.60', '', 'Algodon 93% Spandex 7%    precio kilo $38.990', '3.5 metros por kilo ', '', 11140, '2026-02-20', 0, 13),
(692, 12, 'Drill Smart cod004-0521', '145', '250 Gr', '34% alg 64% pol 2% elastomero', '', '', 12464, '2026-02-04', 0, 2),
(695, 4, 'Oxford camisero solo fondo  icoltex', '150', '170', '60% alg 40% pol', '', '', 9870, '2026-03-09', 0, 4),
(696, 9, 'Polo Shirt 0434 Seg Nac 100% pol 220 gr ', '1.80', '220', '100% POLIESTER', '', '', 12900, '2026-02-05', 0, 61),
(697, 9, 'Tela camiseta Poltex sec', '1.80', '210 Gr', '100% Poliester', '', '', 9290, '2026-02-19', 0, 13),
(698, 4, 'Tela camisera oxford160  ', '1.60', '150 Gr', 'Algodon 52% poliester 48%', '', '', 9990, '2026-02-09', 0, 13),
(699, 12, 'Tela Drill Magenta Strech  Fabricato', '1.61', '215gr', '46% polieter fibra 26% polfilmto 3% elastomero', '', '', 16900, '2026-02-09', 0, 23),
(700, 12, 'Tela drill lycrado Himalaya TopTex', '1.60', '260 Gr', '97% Alg 3% Lycra ', '', '', 14900, '2026-03-12', 0, 35),
(701, 23, 'Malla dunga sec cliente Suzuk ', '1.50', '135gr', '100% POLIESTER', '', '', 7771, '2026-02-12', 0, 12),
(702, 1, 'Tela antifluido Nilo ', '1.50', '120 gr', '100% POLIESTER', '', '', 5798, '2026-02-10', 0, 4),
(703, 30, 'Tela rib spring master', '1.40', '220 Gr', 'Poliester 65% Algodon 35%', '', '', 12990, '2026-03-20', 0, 13),
(704, 4, 'Camisero FlaFil  Tg Ancho 1,5', '1.50', '117', '65%Poliester-35%Algodon', '', '', 12900, '2026-03-17', 0, 2),
(705, 4, 'Tela microfibra160-00  con fondeo color especial cliente ', '1.50', '110 gr', '100% POLIESTER', '', '', 14000, '2026-02-16', 0, 14),
(706, 14, 'Tela Tubular codigo 10A1J12 S/46 M/48 L/52 XL/55 Tallas espec 2XL/60 3XL/63 ', '', '160 gr ', '100% Algodón', '', '', 5083, '2026-02-17', 0, 44),
(707, 21, 'Tela indigo Gorgona ', '1.70', '9 onzas', '70% Alg 28% Pol 2% Elastomero ', '', '', 11500, '2026-02-17', 0, 9),
(708, 4, 'Tela popelina milan ', '1.50', '115 Gr', '65%Poliester-35%Algodon', '', '', 6400, '2026-02-17', 0, 16),
(709, 18, 'Indigo Apolo 2 pago credito Ancho 1,70 Peso 12.5 Oz', '1.70', '12.5 Oz', '100 % Algodon', '', '', 11700, '2026-02-24', 0, 8),
(710, 23, 'Tela malla Valiana ', '1.50', '', '93% pol 7% spandex', '6 mtr', '', 7832, '2026-05-08', 0, 13),
(711, 14, 'Tela Amorela lycra ', '1.50', '', '87% POLIESTER 13% APANDEX', '4 metr', '', 8807, '2026-02-25', 0, 13),
(712, 4, 'Tela dacron Icoltex ', '1.50', '100 Gr', '90% pol 10% alg', '', '', 4363, '2026-02-25', 0, 4),
(713, 14, 'Tela franela jersey  Catalina ', '1.60', '150 Gr', '65%Poliester-35%Algodon', '4 mtr ', '', 6092, '2026-02-26', 0, 87),
(714, 8, 'Tela polar fleece ancho ancho1.60 Icoltex', '160', '', '100% POLIESTER', '2.8 metro', '', 7203, '2026-02-27', 0, 4),
(715, 17, 'Impermeable Celta Ancho 1,66', '1.66', '212gr', '100% Poliester ', '', '', 20650, '2026-03-03', 0, 3),
(716, 25, 'Tela lino superflex Continental De Textiles', '1.50', '110', '100% Poliester ', '', '', 4500, '2026-05-08', 0, 63),
(717, 14, 'Tela Lmedellin 160 Silk color medio', ' 1.60 Peso ', '150 Gr	', '', '', '', 7690, '2026-04-18', 0, 13),
(718, 17, 'Tela para tula Cerro Max  icoltex ', '1,5', '80 gr', '100% Poliester', '', '', 3732, '2026-03-11', 0, 4),
(719, 18, 'Tela indigo Zara blue ', '1.67', '356', '80%Pol -18% Algo 2% Spandex', '', '', 13500, '2026-03-12', 0, 62),
(720, 4, 'Tela oxford orleans ', '1.47', '135', '55% Algodón - 45%Poliester', '', '', 12600, '2026-03-12', 0, 14),
(721, 6, 'Popelina Rigida Leonesa colores varios', '1,5', '', '65%Poliester-35%Algodon', '', '', 10990, '2026-03-17', 0, 13),
(722, 6, 'Dacron hortencia icoltex', '1.50', '', '65% Poliester - 35%Algodon ', '', '', 4462, '2026-03-17', 0, 4),
(723, 9, 'Tela Jersey pelicano  AJTEX', '1.60', '201 gr', '85% pol 15% spandex', '3.1 metros  por kilo', '', 10645, '2026-03-20', 0, 73),
(724, 4, 'Camisero Veneta Plus con descuento 5% lafa 10% cliente ', '1.53', '', '100% POLIESTER', '', '', 21460, '2026-03-24', 0, 3),
(725, 23, 'Malla Megafil sec multiusos 1.60 Peso 112gr colores base blanco negro azul osc', '1.60', '112 gr', '100% Polyester', '', '', 5290, '2026-03-30', 0, 13),
(726, 14, 'Franela Algodon pant materno ', '1.50', '110 gr', '100% Algodón', '', '', 6722, '2026-04-09', 0, 72),
(727, 14, 'Franela Brazilia  100% Algodon ', '1.55', '155 gr', '100% Algodón', '', '', 9990, '2026-04-15', 0, 13),
(728, 21, 'Indigo Zara blue 3204 Grupo Surtitex', '167', '381', '80% alg -18% pol 2% spandex', '', '', 12500, '2026-04-18', 0, 78),
(729, 6, 'Tela Dacron S/F Continental de textiles ', '1.50', '107', '94% pol 6% alg ', '', '', 5116, '2026-04-18', 0, 63),
(730, 23, 'Tela Malla lamega', '1.60', '55 gr', '100% Polyester', '', '', 2690, '2026-04-18', 0, 13),
(731, 14, 'Tela Lmedellin 160 Silk color claro ', '1.60', '150 Gr', '65%Poliester-35%Algodon', '', '', 6690, '2026-04-18', 0, 13),
(732, 14, 'Tela Lmedellin 160 Silk color oscuro ', '1.60', '150 Gr', '65%Poliester-35%Algodon', '', '', 7990, '2026-04-18', 0, 13),
(733, 23, 'Malla Dinamica  liviana Pol-Spa', '1.50', '111 gr', '92% pol 8% spandex', '', '', 6990, '2026-04-24', 0, 13),
(734, 10, 'Tela Drill TC Twill S/F Continental textiles', '1.50', '208', 'Poliester 85% Algodon 15%', '', '', 8231, '2026-05-11', 0, 63),
(735, 11, 'Tela Drill Thor Tramas ', '1.60', '255', '100 % Algodon', '', '', 10516, '2026-05-11', 0, 9),
(736, 4, 'Tela Popelina caobo PC John Uribe  ', '1.48', '103', '65% Poliester - 35%Algodon ', '', '', 6798, '2026-05-19', 0, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tela_forro`
--

CREATE TABLE `tela_forro` (
  `id_telaforro` int(11) NOT NULL,
  `id_tipo_tela` int(11) NOT NULL,
  `tela_forro` varchar(200) DEFAULT NULL,
  `ancho` varchar(30) DEFAULT NULL,
  `peso` varchar(30) DEFAULT NULL,
  `caracteristicas` varchar(100) DEFAULT NULL,
  `rendimiento` varchar(50) DEFAULT NULL,
  `encogimiento` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades_metros` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tela_forro`
--

INSERT INTO `tela_forro` (`id_telaforro`, `id_tipo_tela`, `tela_forro`, `ancho`, `peso`, `caracteristicas`, `rendimiento`, `encogimiento`, `precio`, `fecha_actualizacion`, `unidades_metros`, `id_proveedor`) VALUES
(0, 0, 'No Aplica', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, 0),
(1, 1, 'Antifluido Adidas ', '1,5', '', '', '', '', 6975.74, '2026-01-22', 0, 1),
(2, 1, 'Antifluido Adidas Es Mas Impermeable ', '1,5', '105 Gr ', '100% Poliester', '', '', 7114.8, '2026-01-22', 0, 2),
(3, 1, 'Antifluido Alviero Strech Lafshield', '1,51', '205', '100% POLIESTER', '', '', 25747, '2026-04-17', 0, 3),
(4, 1, 'Antifluido Alviero Strech Lafshield Estampada', '1,5', '', '', '', '', 28334.2, '2025-12-15', 0, 3),
(5, 1, 'Antifluido Antimicrobial Microtec Cloro Antimicrobial', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(6, 1, 'Antifluido Antimicrobial Microtec Cloro Antimicrobial  Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(7, 1, 'Antifluido Antimicrobial Universal Cloro Antimicrobial', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(8, 1, 'Antifluido Aqua Max Cloro Resistencia', '1,5', '140 Gr', '', '', '', 12521, '2026-03-26', 0, 4),
(9, 1, 'Antifluido Astral (Se Parece Wembley Y Nike) ', '1,5', '115 Gr', '100%Poliester ', '', '', 8063.44, '2026-01-22', 0, 5),
(10, 1, 'Antifluido Balsillas ', '1,5', '', '100% Poliester', '', '', 5336.1, '2026-01-22', 0, 5),
(11, 1, 'Antifluido Betania', '1,48', '150 Gr', '65%Poliester - 35%Viscosa Sensacion Frescura ', '', '', 20756.9, '2025-12-15', 0, 3),
(12, 1, 'Antifluido Boston Navy ', '1,5', '', '', '', '', 12229.9, '2026-01-22', 0, 6),
(13, 1, 'Antifluido Caribe Cloro Resistente', '1,5', '', '', '', '', 25025.8, '2025-12-15', 0, 3),
(14, 1, 'Antifluido Caribe Cloro Resistente', '1,5', '', 'Estampado', '', '', 28281.3, '2025-12-15', 0, 3),
(15, 1, 'Antifluido Cooper', '1,5', '62-67 Gr', 'Repelente Al Agua No Impermeable Tipo Cortaviento ', '', '', 9486.4, '2026-01-22', 0, 7),
(16, 1, 'Antifluido Cosmos ', '1,53', '', '', '', '', 24299.9, '2026-01-30', 0, 3),
(17, 1, 'Antifluido Cosmos  Estampado', '1,53', '', '', '', '', 23585.6, '2025-12-15', 0, 3),
(18, 1, 'Antifluido Country', '1,53', '', '100% Poliester ', '', '', 7233.38, '2026-01-22', 0, 2),
(19, 1, 'Antifluido De 8 Homologa Universal De 3', '', '', '', '', '', 8182.02, '2026-01-22', 0, 8),
(20, 1, 'Antifluido Durango', '1,5', '', '', '', '', 23958.6, '2025-12-15', 0, 3),
(21, 1, 'Antifluido Electra ', '1,5', '', '100% Poliester Pelicula Clororesistencia', '', '', 19565.7, '2026-01-22', 0, 20),
(22, 1, 'Antifluido Kae Se Parece Al Tequila Es Opaco ', '1,6', '', '', '', '', 11265.1, '2026-01-22', 0, 9),
(23, 1, 'Antifluido Lacrosse', '1,48', '', '', '', '', 0, '2025-12-15', 0, 3),
(24, 1, 'Antifluido Liso Wr ', '1,5', '115 Gr', '100%Poliester Liviano Poca Clororesistencia', '', '', 8967.88, '2026-01-22', 0, 4),
(25, 1, 'Antifluido Manila', '1,46', '148 Gr', '65%Poliester - 60%Algodon ', '', '', 23104.8, '2025-12-15', 0, 3),
(26, 1, 'Antifluido 20 Extra', '', '', '', '', '', 19802.9, '2026-01-22', 0, 10),
(27, 1, 'Antifluido Megadrill Lafshield', '1,5', '', '', '', '', 27693.8, '2025-12-15', 0, 3),
(28, 1, 'Antifluido Metropol ', '1,5', '100 Gr', '100% Poliester ', '', '', 30522.5, '2026-01-22', 0, 7),
(29, 1, 'Antifluido Megadrill Lafshield Estampado', '1,5', '', '', '', '', 30522.5, '2025-12-15', 0, 3),
(30, 1, 'Antifluido Microdril Lafshield', '1,5', '', '', '', '', 29828.3, '2025-12-15', 0, 3),
(31, 1, 'Antifluido Microfibra Acabado Soft ', '1,48', '115 Gr', '100% Poliester', '', '', 31642.5, '2026-01-22', 0, 8),
(32, 1, 'Antifluido Microdril Lafshield Estampado', '1,5', '', '', '', '', 31642.5, '2025-12-15', 0, 3),
(33, 1, 'Antifluido Microprince', '1,51', '', '', '', '', 29028.4, '2025-12-15', 0, 3),
(34, 1, 'Antifluido Microtec Clor Resistente ', '1,5', '104', '100% POLIESTER', '', '', 22368.5, '2025-12-15', 0, 3),
(35, 1, 'Antifluido Microtec clororesistente Estampado', '1,5', '104', '100% POLIESTER', '', '', 29914.5, '2025-12-15', 0, 3),
(36, 1, 'Antifluido Mundial Clororesistente (Universal Clororesistente) ', '1,45', '30 Gr', '100%Poliester ', '', '', 14822.5, '2026-01-22', 0, 5),
(37, 1, 'Antifluido Napolen (Toque Soft) ', '1,5', '110 Gr', '100%Poliester ', '', '', 8300.6, '2026-01-22', 0, 5),
(38, 1, 'Antifluido Nike ', '1,5', '', '100% Poliester', '', '', 8419.18, '2026-01-22', 0, 11),
(39, 1, 'Antifluido Odeon', '', '', '', '', '', 15362.6, '2026-01-22', 0, 2),
(40, 1, 'Antifluido Olimpia Repel Estampado', '1,5', '', '', '', '', 9830.28, '2026-01-22', 0, 12),
(41, 1, 'Antifluido Olimpia Repel  Unicolor', '1,5', '', '', '', '', 8703.77, '2026-01-22', 0, 13),
(42, 1, 'Antifluido Forza ', '1.47', '105gr', '100% Poliester ', '', '', 6999, '2026-02-19', 0, 14),
(43, 1, 'Antifluido Plus Ancho ', '1,5', '', '', '', '', 9159, '2026-03-17', 0, 4),
(44, 1, 'Antifluido Riva ', '1,5', '137 Gr', '100% Poliester ', '', '', 10760.6, '2026-01-22', 0, 15),
(46, 1, 'Antifluido Spandex Baltimore ', '1,45', '120 Gr', '97%Poliester 3%Spandex ', '', '', 6284.74, '2026-01-22', 0, 5),
(47, 1, 'Antifluido Spandex Fatima ', '1,45', '140 Gr ', '92%Poliester-8%Spandex  Solo Blanco Por Ahora', '', '', 8431.04, '2026-01-22', 0, 2),
(48, 1, 'Antifluido Spandex Iguazu Lycra ', '1,5', '132', 'lycra 4% Pol Re. 96%', '', '', 27489, '2025-12-15', 0, 3),
(49, 1, 'Antifluido Spandex Lotus', '1.50', '169', 'Pol 96% lycra 4%', '', '', 30022.3, '2025-12-15', 0, 3),
(50, 1, 'Antifluido Spandex Lotus Estampado', '1.51', '170', '', '', '', 39077.5, '2025-12-15', 0, 3),
(51, 1, 'Antifluido Spandex Marruecos R', '', '', '', '', '', 33404, '2025-12-15', 0, 3),
(52, 1, 'Antifluido Spandex Metro ', '1,47', '180 Gr', '100% Poliester Strech Mecanico  Solo Blanco Por Ahora Spandex En La Trama', '', '', 0, '2026-01-22', 0, 2),
(53, 1, 'Antifluido Spandex Napolen ', '1,5', '150 Gr ', '96%Poliester - 4%Spandex ', '', '', 11656.4, '2026-01-22', 0, 16),
(54, 1, 'Antifluido Spandex Tesla ', '1,5', '', '95%Poliester - 5% Elastomero Peso 148', '', '', 12592.1, '2026-01-22', 0, 4),
(55, 1, 'Antifluido Spandex Tory ', '1,47', '135 Gr', '91%Poliester-9%Spandex   Solo Blanco Por Ahora', '', '', 0, '2026-01-22', 0, 2),
(56, 1, 'Antifluido Spandex Universal Lycra', '1,5', '', '', '', '', 27542.9, '2025-12-15', 0, 3),
(57, 1, 'Antifluido Tulum ', '1,5', '148 Gr ', '100% Poliester Texturizado ', '', '', 18027.4, '2026-01-22', 0, 4),
(58, 1, 'Antifluido T180', '1.80', '', '100% Poliester', '', '', 23500, '2026-02-12', 0, 3),
(59, 1, 'Antifluido T180  Estampada', '1.80', '', '100% POLIESTER', '', '', 26750, '2026-02-12', 0, 3),
(60, 1, 'Antifluido Tekila ', '1,5', '', '100% Poliester ', '', '', 12569.5, '2026-01-22', 0, 9),
(61, 1, 'Antifluido Tifon  Verde Neon Brigadista', '1,5', '', '', '', '', 4312, '2026-01-22', 0, 1),
(62, 1, 'Antifluido Tulun Homologa Universal Clororesistente ', '1,5', '', '', '', '', 18027.4, '2026-01-22', 0, 4),
(63, 1, 'Antifluido Tx 200 ', '1,5', '136gr', '100% POLIESTER', '', '', 16700, '2026-04-21', 0, 3),
(64, 1, 'Antifluido Tx 200 Estampada', '1,5', '136gr', '100% POLIESTER', '', '', 21950, '2026-02-19', 0, 3),
(65, 1, 'Antifluido Universal Cloro Resis 1,5 Unicolor', '1,5', '135', '100% POLIESTER', '', '', 23450, '2026-02-19', 0, 3),
(66, 1, 'Antifluido Universal Cloro Resistente Estampado', '1,5', '135', '100% POLIESTER', '', '', 26303.2, '2025-12-15', 0, 3),
(67, 1, 'Antifluido Universal Ripstop', '1,5', '', '', '', '', 21550, '2026-02-10', 0, 3),
(68, 1, 'Antifluido Universal Touch', '1,5', '', '', '', '', 23284.8, '2025-12-15', 0, 3),
(69, 1, 'Antifluido Urano Liviano Para Cortavientos', '', '', '', '', '', 9118.8, '2026-01-22', 0, 17),
(70, 1, 'Antifluido Valdo ', '1,5', '140 Gr', '100% Poliester', '', '', 9130.66, '2026-01-22', 0, 18),
(71, 1, 'Antifluido Velero R ', '1,58', '', '', '', '', 34172.6, '2025-12-15', 0, 3),
(72, 1, 'Antifluido Wembley ', '1,55', '104 Gr', '100% Poliester', '', '', 7990, '2026-02-17', 0, 16),
(73, 1, 'Antifluido Wembley Detal ', '1,55', '104 Gr', '100% Poliester', '', '', 10463.1, '2026-01-22', 0, 15),
(74, 1, 'Antifluido Wind Breaker ', '1,5', '', '100% Poliester', '', '', 5929, '2026-01-22', 0, 11),
(75, 1, 'Antifluido Zelandia Wr Soft ', '1,5', '105 Gr', '100%Poliester', '', '', 7292.67, '2026-01-22', 0, 2),
(76, 2, 'Burda Latina ', '', '180 Gr', '77% Poliester 23%Algodon', '', '', 10230.2, '2026-01-22', 0, 13),
(77, 3, 'Dril Camisa Confeccionada Polialgodon 19', '', '', '', '', '', 45837.6, '2026-01-22', 0, 19),
(78, 4, 'Camisera  Resort lc', '1,5', '', '', '', '', 23015.3, '2025-12-15', 0, 3),
(79, 4, 'Camisera Guayabera Resort Estampada', '1,5', '', '', '', '', 27542.9, '2025-12-15', 0, 3),
(80, 4, 'Camisero Acantha ', '1,5', '', '', '', '', 21250, '2026-02-02', 0, 3),
(81, 4, 'Camisero Adara', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(82, 4, 'Camisero Adara Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(83, 4, 'Camisero Alessio ', '1,5', '', '85% pol 15% alg', '', '', 26300, '2026-04-28', 0, 3),
(84, 4, 'Camisero Alessio lagerfeld ', '1,5', '', '85% pol 15% alg', '', '', 29350, '2026-04-28', 0, 3),
(85, 4, 'Camisero Andes ', '1,5', '', ' 100% poliester recicl', '', '', 21650, '2026-02-04', 0, 3),
(86, 4, 'Camisero Bamoa', '1,5', '', '100% Poliester', '', '', 20900, '2026-02-03', 0, 3),
(87, 4, 'Camisero Bamoa Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(88, 4, 'Camisero Carlita ', '1,5', '', '', '', '', 20277.2, '2026-01-22', 0, 20),
(89, 4, 'Camisero Chicago Unicolor Y Jasped', '1,5', '', '', '', '', 23284.8, '2025-12-15', 0, 3),
(90, 4, 'Camisero Danova L.C', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(91, 4, 'Camisero Danova L.C Estampada', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(92, 4, 'Camisero Dexter solo fondo ', '1,46', '137', 'Algodon 65% Poliester 35%', '', '', 25450, '2026-04-16', 0, 3),
(93, 4, 'Camisero Dinamica', '1,5', '', '', '', '', 18649.4, '2026-01-22', 0, 20),
(94, 4, 'Camisero Dull Khosibo ', '', '130 Gr', '100%Poliester', '', '', 21077.1, '2026-01-22', 0, 21),
(95, 4, 'Camisero E Padua Queen Estampado', '1,7', '', '', '', '', 0, '2025-12-15', 0, 3),
(96, 4, 'Camisero Éxito ', '1,48', '130 Gr', '95%Poliester-5% Algodón', '', '', 25826.7, '2026-01-22', 0, 22),
(97, 4, 'Camisero Fay', '1.50', '118gr', '100% Polyester', '', '', 12681.6, '2026-01-22', 0, 15),
(98, 4, 'Camisero Fay Negro', '', '', '', '', '', 24919, '2026-01-22', 0, 23),
(99, 4, 'Camisero Fay Queen ', '1,49', '118 Gr ', '100%Poliester', '', '', 25826.7, '2026-01-22', 0, 22),
(100, 4, 'Camisero Fay 25 ', '1,47', '125 Gr ', '100% Poliester', '', '', 21077.1, '2026-01-22', 0, 25),
(101, 4, 'Camisero Fay Detal ', '1,47', '125 Gr', '100% Poliester', '', '', 24919, '2026-01-22', 0, 15),
(102, 4, 'Camisero Fendi Mil Rayas colores varios ', '1,5', '100 Gr', '65%Poliester - 35%Algodon ', '', '', 10000, '2026-03-12', 0, 4),
(103, 4, 'Camisero Fill And Fill 20 ', '1,5', '', '100% Poliester ', '', '', 21077.1, '2026-01-22', 0, 20),
(104, 4, 'Camisero Fill And Fill 24 ', '', '', '100% Algodón ', '', '', 24919, '2026-01-22', 0, 24),
(106, 4, 'Camisero Gaell', '1,6', '', '', '', '', 21290.5, '2025-12-15', 0, 3),
(107, 4, 'Camisero Gorgona Lycra R ', '1,5', '119', 'Pol 96% lycra 4%', '', '', 26908, '2026-04-16', 0, 3),
(108, 4, 'Camisero Gorgona R Estampado', '1,5', '119', 'Pol 96% lycra 4%', '', '', 0.2, '2026-01-30', 0, 3),
(109, 4, 'Camisero Howard ', '1,7', '', '', '', '', 28459.2, '2025-12-15', 0, 3),
(110, 4, 'Camisero Kuvo Estampado', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(111, 4, 'Camisero Maori Estampado', '1,5', '99', '45%Algodon 55% Poliester ', '', '', 21290.5, '2025-12-15', 0, 3),
(112, 4, 'Camisero 20', '', '', '', '', '', 19684.3, '2026-01-22', 0, 20),
(113, 4, 'Camisero Metro L.C', '1,5', '', '', '', '', 21128.8, '2025-12-15', 0, 3),
(114, 4, 'Camisero Metro L.C  Estampada', '1,5', '', '', '', '', 34927.2, '2025-12-15', 0, 3),
(116, 4, 'Camisero Montecarlo ', '1,5', '100 Gr', '55%Poliester-45% Algodón Peso 95 A ', '', '', 14227.4, '2026-01-22', 0, 11),
(117, 4, 'Camisero New Prestige ', '1,45', '', '50%Algodon - 50% Poliester', '', '', 14945.4, '2026-01-22', 0, 14),
(118, 4, 'Camisero Nicole L.C', '1,5', '', '', '', '', 21883.4, '2025-12-15', 0, 3),
(119, 4, 'Camisero Nicole L.C Estampado', '1,5', '', '', '', '', 21883.4, '2025-12-15', 0, 3),
(120, 4, 'Camisero Popelina ', '1,5', '', '', '', '', 10241, '2026-01-22', 0, 15),
(122, 4, 'Tela camisera Popelina Brisa ', '1,5', '', '65%Poliester-35%Algodon', '', '', 7900, '2026-02-09', 0, 16),
(123, 4, 'Camisero Popelina Menta ', '', '', 'Poli-Alg ', '', '', 7589.12, '2026-01-22', 0, 26),
(124, 4, 'Camisero Popelina Menta ', '', '', 'Poli-Alg', '', '', 8419.18, '2026-01-22', 0, 26),
(125, 4, 'Camisero Popelina Pc Holandes ', '1,5', '150 Gr', '65% Poliester- 35% Viscosa', '', '', 0, '2026-01-22', 0, 16),
(126, 4, 'Camisero Popelina San Pablo ', '1.5', '150 Gr', '65%Poliester-35%Algodon', '', '', 7862, '2026-05-20', 0, 2),
(127, 4, 'Camisero Popelina Superior ', '1,5', '', '', '', '', 9512.27, '2026-01-22', 0, 4),
(128, 4, 'Camisero Queen', '1,65', '', '', '', '', 21290.5, '2025-12-15', 0, 3),
(129, 4, 'Camisero Queen Estampada', '1,65', '', '', '', '', 24362.8, '2025-12-15', 0, 3),
(130, 4, 'Camisero Rayas Steve2-1', '', '88 Gr ', '65%Poliester -35%Algodon', '', '', 7707.7, '2026-01-22', 0, 21),
(131, 4, 'Camisero Super Turin ', '1,45', '90 A 95 Gr', '55%Poliester-45% Algodón ', '', '', 14227.4, '2026-01-22', 0, 11),
(132, 4, 'Camisero Unicolor Y Estampadas ', '1,45', '', '100% Poliester', '', '', 17905.6, '2026-01-22', 0, 20),
(133, 4, 'Camisero Vargas Llosa ', '1,5', '110 Gr', '50% Poliester - 50% Algodón  ', '', '', 118461, '2026-04-24', 0, 90),
(134, 4, 'Camisero Universal Ristop Wicking', '', '', '', '', '', 21128.8, '2025-12-15', 0, 3),
(135, 4, 'Camisero Universal Ristop Wicking Estampado', '', '', '', '', '', 24686.2, '2025-12-15', 0, 3),
(136, 4, 'Camisero Veneta Plus', '1,53', '125 gr', 'Poliester 85% Algodon 15%', '', '', 25100, '2026-02-02', 0, 3),
(137, 4, 'Dacron Danes Blanco ', '1,45', '110 Gr', '65%Poliester 35%Algodon ', '', '', 9130.66, '2026-01-22', 0, 27),
(138, 4, 'Dacron Danes Colores ', '1,45', '110 Gr', '65%Poliester 35%Algodon ', '', '', 10079.3, '2026-01-22', 0, 27),
(139, 4, 'Dacron Lombardy ', '1,5', '100 Gr ', '35%Algodòn- 65% Poliester Blanco', '', '', 7424, '2026-03-26', 0, 2),
(141, 4, 'Dacron Otoñal Solo Blanco ', '1,5', '125 Gr', '65%Poliester 35%Algodon ', '', '', 10079.3, '2026-01-22', 0, 27),
(143, 4, 'Oxford  32 ', '1,5', '150 Gr', '50%Algodon-50% Poliester  ', '', '', 11846.1, '2026-01-22', 0, 32),
(144, 4, 'Oxford ', '1,45', '130 Gr ', '100%Algodon', '', '', 9486.4, '2026-01-22', 0, 21),
(145, 4, 'Oxford 160 Pat Primo        ', '1,6', '150 Gr   ', '52%Algodon- 48% Poliester    ', '', '', 9990, '2026-02-04', 0, 13),
(146, 4, 'Oxford Aquiles', '1,45', '160 Gr', '60%Algodon - 40%Poliester', '', '', 9960.72, '2026-01-22', 0, 8),
(147, 4, 'Oxford Azul Ml Camisa Confeccionada', '', '', '', '', '', 38272.2, '2026-01-22', 0, 33),
(148, 4, 'Oxford Blanco 34 ', '1,55', '155 Gr', '50%Poliester - 50% Algodón', '', '', 11265.1, '2026-01-22', 0, 34),
(149, 4, 'Tela oxford blanco 66 ', '1,6', '', '55%Algodon - 45%Poliester ', '', '', 11534.6, '2026-01-22', 0, 16),
(150, 4, 'Oxford Blanco 46 ', '1,5', '', '', '', '', 0, '2026-01-22', 0, 31),
(151, 4, 'Oxford Blanco 35', '1,5', '165 Gr', '50% Poliester-50% Algodón ', '', '', 11739.4, '2026-01-22', 0, 35),
(152, 4, 'Oxford Nacional  Colores varios ', '1,6', '', '55% Algodón - 45%Poliester', '', '', 11700, '2026-02-04', 0, 16),
(153, 4, 'Oxford Colores 35 ', '1,5', '165 Gramos', '50% Poliester - 50% Algodón ', '', '', 12213.7, '2026-01-22', 0, 35),
(154, 4, 'Oxford Deluxe ', '1,42', '208 Gr', '68%Algodon - 32% Poliester ', '', '', 18970.6, '2026-01-22', 0, 14),
(155, 4, 'Oxford Gris 15', '1,6', '', '', '', '', 11739.4, '2026-01-22', 0, 15),
(156, 4, 'Oxford Magno 135 ', '1,5', '', '60% Algodón - 40% Poliester', '', '', 8893.5, '2026-01-22', 0, 8),
(157, 4, 'Oxford Manhattan ', '', '', '60%Algodòn - 40%Poliester', '', '', 14535.8, '2026-01-22', 0, 2),
(158, 4, 'Oxford ', '', '', '60%Algodòn - 40%Poliester', '', '', 13661.5, '2026-01-22', 0, 2),
(159, 4, 'Oxford Rayas 66 ', '1,6', '155 Gr', '50%Algodon - 50%Poliester', '', '', 14585.3, '2026-01-22', 0, 16),
(160, 4, 'Oxford Rayas 4 ', '1,5', '', '', '', '', 14258.7, '2026-01-22', 0, 4),
(161, 4, 'Oxford Superoxford ', '1,5', '160 Gr', '60% Algodon-40% Poliester ', '', '', 11345, '2026-03-11', 0, 4),
(162, 4, 'Oxford Unioffice ', '1,6', '163 Gr', '62% Algodón - 38% Poliester', '', '', 13518.1, '2026-01-22', 0, 8),
(163, 4, 'Oxoford Azul Y Blanca Mc Confeccionada', '', '', '', '', '', 39859.1, '2026-01-22', 0, 36),
(164, 4, 'Oxoford 32 ', '1,5', '150 Gr ', '50% poliester - 50% Algodón ', '', '', 13031.9, '2026-01-22', 0, 32),
(165, 5, 'Camisero Spandex Atina ', '1,46', '116 Gr', '93%Poliester -7%Spandex ', '', '', 9249.24, '2026-01-22', 0, 21),
(166, 5, 'Camisero Strech Bershka ', '', '', '97%Algodon - 3%Spandex', '', '', 12213.7, '2026-01-22', 0, 24),
(167, 5, 'Camisero Strech Isabel ', '', '132 Gr', '92%Poliester - 8%Spandex ', '', '', 10079.3, '2026-01-22', 0, 29),
(168, 5, 'Camisero Strech Marcel Lycra', '1,5', '', '', '', '', 31046.4, '2025-12-15', 0, 3),
(169, 5, 'Camisero Strech Marcel Lycra Est', '1,5', '', '', '', '', 34927.2, '2025-12-15', 0, 3),
(170, 5, 'Camisero Strech Monet Lycra', '1,54', '', '', '', '', 28674.8, '2025-12-15', 0, 3),
(171, 5, 'Camisero Strech Popelina ', '', '', '97%Algodon - 3% Lycra', '', '', 9865.86, '2026-01-22', 0, 4),
(172, 5, 'Camisero Strech Popelina Dubay ', '1,45', '125 Gr  ', '97%Algodon - 3 %Spandex', '', '', 10672.2, '2026-01-22', 0, 16),
(173, 5, 'Camisero Strech Popelina Pera ', '', '', '97%Algodon - 3%Spandex', '', '', 10079.3, '2026-01-22', 0, 26),
(174, 5, 'Camisero Strech Popelina Santana', '', '', '', '', '', 7589.12, '2026-01-22', 0, 2),
(175, 5, 'Camisero Strech Popelina Uniklo', '1.60', '125 gr', 'Algodon 96% Spandex 4%', '', '', 14542.2, '2026-01-22', 0, 13),
(176, 5, 'Camisero Strech Popelina Victoria ', '1,45', '115 Gr', '97%Algodon - 3%Spandex', '', '', 9604.98, '2026-01-22', 0, 30),
(177, 5, 'Camisero Strech Rafael Lycra ', '1,5', '', '', '', '', 22530.2, '2026-01-22', 0, 20),
(178, 5, 'Camisero Strech Rosella Lycra', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(179, 5, 'Camisero Strech Rosella Lycra Estampado', '1,5', '', '', '', '', 30309, '2025-12-15', 0, 3),
(180, 5, 'Camisero Strech Skikda ', '', '', '92%Poliester - 8%Eslastomero', '', '', 7944.86, '2026-01-22', 0, 24),
(181, 6, 'Dacron 205 Plus ', '1,48', '115 Gr', '80%Poliester-20%Algodon ', '', '', 8893.5, '2026-01-22', 0, 8),
(182, 6, 'Dacron Chino Blanco 9', '', '', '', '', '', 5519.36, '2026-01-22', 0, 9),
(183, 6, 'Dacron Chino Blanco Toptex', '', '', '', '', '', 3675.98, '2026-01-22', 0, 35),
(184, 6, 'Dacron Chino Colores  ', '1,5', '', '80%Poliester-20% Algodón ', '', '', 4528.68, '2026-01-22', 0, 1),
(185, 6, 'Dacron Chino Colores Toptex', '', '', '', '', '', 4150.3, '2026-01-22', 0, 35),
(186, 6, 'Dacron Colores 5 ', '1,5', '90 Gr', '90%Poliester -10% Algodón  ', '', '', 6640.48, '2026-01-22', 0, 27),
(187, 6, 'Dacron Hidalgo Solo Blanco', '1,45', '', '', '', '', 5454.68, '2026-01-22', 0, 27),
(188, 6, 'Dacron S/F  camisero Seg.Nac', '1,5', '', '94% pol 6% Algodon ', '', '', 5500, '2026-02-03', 0, 63),
(189, 6, 'Dacron Marques ', '1,45', '', 'AnchoSolo Blanco 90%Poliester - 10%Algodon', '', '', 5929, '2026-01-22', 0, 27),
(190, 6, 'Dacron Perla Blanca ', '', '', '90% Pol-10% Alg Econòmica', '', '', 3913.14, '2026-01-22', 0, 2),
(191, 6, 'Dacron Popelina Diana ', '', '', '50 poliester - 50 algodón ', '', '', 12332.3, '2026-01-22', 0, 34),
(192, 6, 'Dacron Popelina Superior Blanca ', '1,48', '', '', '', '', 6581.19, '2026-01-22', 0, 9),
(193, 6, 'Dacron Popelina Blanca', '1,48', '', '', '', '', 9467, '2026-01-22', 0, 45),
(194, 7, 'En Este Moento No Tiene Pcc', '', '', '', '', '', 0, '2026-01-22', 0, 37),
(195, 7, 'Impermeabble Chaqueta Pantalon, Calibre 18 Color Azul Y Negro, Reflectivo Solo En Espalda De Chaqueta', '', '', '', '', '', 0, '2026-01-22', 0, 38),
(196, 7, 'Impermeable Chaqueta Pantalon Zapatones Y Bolso Calibre 18 Color Azul Y Negro, Reflectivo Solo En Espalda De Chaqueta', '', '', '', '', '', 0, '2026-01-22', 0, 38),
(197, 7, 'Impermeable Conjunto Negro Cinta Reflectiva En Espalda Manga Y Bota De 2 Chaqueta Pantalon Calibre 18 Talla S A Xl', '', '', '', '', '', 69930.9, '2026-01-22', 0, 39),
(198, 7, 'Impermeable Conjunto Negro Talla Xl C/Reflectivo, Cierre Velcro Y Cremallera Con Bolso Y Zapatones Cal-16', '', '', '', '', '', 76839.8, '2026-01-22', 0, 19),
(199, 7, 'Impermeable Conjunto Pantalón Y Chaqueta. En Color Amarillo Y Negro, De Las Talla M A La Xl', '', '', '', '', '', 45060.4, '2026-01-22', 0, 40),
(200, 7, 'Impermeable Pantalon Y Chqueta Sin Botas Ni Bolsito A 60.000 Hasta La Talla Xl Azul Y Negro Con Reflectivo 1 Linea En Bota Y Espalda', '', '', '', '', '', 59788, '2026-01-22', 0, 41),
(201, 7, 'Ref 505-20 Conjunto, Chaqueta Cierre Velcro Y Cremallera, Pantalón Con Resorte, Zapaton Con Suela Y Estuche Cargador (Calibre 16, Una Franja De Reflectivo De 1 En Manga De La Chaqueta, Bota Del Pantal', '', '', '', '', '', 55881.4, '2026-01-22', 0, 42),
(202, 7, 'Ref 605-18 Conjunto, Chaqueta Cierre Velcro Y Cremallera, Pantalón Con Resorte, Zapaton Con Suela Y Estuche Cargador (Calibre 18, Una Franja De Reflectivo De 1 En Manga De La Chaqueta, Bota Del Pantal', '', '', '', '', '', 58258.4, '2026-01-22', 0, 42),
(203, 8, 'Fleece Alpaca ', '1,5', '200 Gr', '', '', '', 15984.6, '2026-01-22', 0, 43),
(204, 8, 'Fleece Polo Norte', '1,5', '230 Gr', '', '', '', 13636.7, '2026-01-22', 0, 43),
(205, 8, 'Fleece Suave Star ', '1,5', '128 Gr ', '100% Poliester ', '', '', 9058.43, '2026-01-22', 0, 13),
(206, 8, 'Fleece Super Fleeese', '', '', '', '', '', 10761.7, '2026-01-22', 0, 44),
(207, 9, 'Deportiva Atletica Activa ', '1,6', '140 Gr ', '100%Poliester Strech Mecanico Rendimiento 4,6', '', '', 3841.99, '2026-01-22', 0, 8),
(208, 9, 'Deportiva Bahhia 1.56', '1.56', '212', '80%Poliester -20% lycra', '', '', 29900, '2026-03-12', 0, 3),
(209, 9, 'Deportiva Bosstex Sec ', '', '', '100% Poliester', '', '', 7944.86, '2026-01-22', 0, 17),
(210, 9, 'Deportiva Dual', '1,57', '', '', '', '', 21290.5, '2025-12-15', 0, 3),
(211, 9, 'Deportiva Dunga Sec ', '1,5', '', '', '', '', 5767.3, '2026-01-22', 0, 13),
(212, 9, 'Deportiva Hydrotech ', '1,5', '', '', '', '', 18500, '2026-02-23', 0, 3),
(213, 9, 'Deportiva Hydrotech Antibact', '1,47', '', '', '', '', 19673.5, '2025-12-15', 0, 3),
(214, 9, 'Deportiva Hydrotech Reciclado Antibacterial ', '1,5', '', '100% POLIESTER', '', '', 19673.5, '2025-12-15', 0, 3),
(215, 9, 'Deportiva Megafil Sec ', '1,5', '', '', '', '', 6391.46, '2026-01-22', 0, 13),
(216, 9, 'Deportiva Montecarmelo ', '', '155 Gr  ', 'Poliéster 100% Microfibra ', '', '', 6166.16, '2026-01-22', 0, 51),
(217, 9, 'Deportiva Montesimone Reciclado', '', '', '', '', '', 22691.9, '2025-12-15', 0, 3),
(218, 9, 'Deportiva Montesimone', '1,52', '134', '100% POLIESTER', '', '', 23150, '2026-03-12', 0, 3),
(219, 9, 'Deportiva Paraiso ', '', '139 Gr  ', '100%Poliester ', '', '', 5276.81, '2026-01-22', 0, 51),
(220, 9, 'Deportiva Sportwear (Sudafrica) ', '1,55', '120 Gr', '100%Poliester ', '', '', 7707.7, '2026-01-22', 0, 27),
(221, 9, 'Deportiva Sudafrica ', '1,5', ' 145 Gr', '100%Poliester', '', '', 8644.48, '2026-01-22', 0, 17),
(222, 9, 'Deportiva Stamina', '1,48', '', '', '', '', 24847.9, '2025-12-15', 0, 3),
(223, 9, 'Deportiva Stepway', '1,7', '245 Gr', '92% Poliester 8% lycra ', '', '', 33150, '2026-03-12', 0, 3),
(224, 9, 'Deportiva Zanetti ', '1,73', '143', '100% POLIESTER', '', '', 20800, '2026-03-12', 0, 3),
(225, 10, 'Dril Borneo Plus segunda opcion  (Oriòn) ', '1,5', '230 Gr', '65% Poliester - 35%Algodon ', '', '', 9691.22, '2026-01-22', 0, 8),
(226, 10, 'Dril Cìtrico (Gabardina)', '', '', '', '', '', 13636.7, '2026-01-22', 0, 26),
(227, 10, 'Dril Malpelo ', '1,4', '240 Gr', '65% Poliester -35%Algodon ', '', '', 11265.1, '2026-01-22', 0, 34),
(228, 10, 'Dril Noruego (Chefs-Medicos) ', '1,5', '190 Gr', '80% Poliester - 20%Algodon', '', '', 10079.3, '2026-01-22', 0, 8),
(229, 10, 'Dril Orion ', '1,5', '240 Gr   ', '65% Poliester-35%Algodòn ', '', '', 9676, '2026-04-18', 0, 2),
(230, 10, 'Dril Orion 15 ', '1,5', '240 Gr', '65% Poliester-35%Algodòn ', '', '', 13769.3, '2026-01-22', 0, 15),
(231, 10, 'Dril Pocker ', '', '', '', '', '', 13992.4, '2026-01-22', 0, 9),
(232, 10, 'Dril Qatar', '1,5', '', '', '', '', 21750, '2026-02-19', 0, 3),
(233, 10, 'Dril Santafe textilera ', '1,5', '245 Gr', '65% Poliester - 35%Algodon. ', '', '', 10840, '2026-02-24', 0, 4),
(235, 10, 'Dril Universal Ecologico 32 ', '1,6', '220 Gr', '70% Algodòn - 30% Polies Reciclado ', '', '', 0, '2026-01-22', 0, 32),
(236, 11, 'Dril A100 MAX ', '1,6', '260 Gr', '100% Algodòn Colorante Reactivo ', '', '', 16723, '2026-03-19', 0, 4),
(237, 11, 'Dril Activo 32 ', '1,6', '250 Gr', '100% Algodón Colorante Reactivo Alta Fijacion ', '', '', 0.7, '2026-01-30', 0, 32),
(239, 11, 'Dril Apolo Colorante Reactivo Alta Fijacion ', '1,6', '7,4 Onz', '100% Algodón ', '', '', 18854.2, '2026-01-22', 0, 34),
(240, 11, 'Dril Espartano  Colorante Quimico Reactivo', '1,6', '265 Gr', '100%Algodon ', '', '', 16126.9, '2026-01-22', 0, 8),
(242, 11, 'Dril Forza ', '1,5', '220 Gr ', '35% Algodón / 65% Poliéster ', '', '', 12521, '2026-02-18', 0, 4),
(243, 11, 'Dril Forza', '1,5', '278', '100 % Algodon', '', '', 25800, '2026-02-18', 0, 3),
(244, 11, 'Dril Frutal', '1,67', '7,8 Onzas ', '100% Algodòn Blanco', '', '', 15296.8, '2026-01-22', 0, 26),
(245, 11, 'Dril Frutal Colores', '1,67', '7,8 Onzas ', '100% Algodòn ', '', '', 9711.7, '2026-01-22', 0, 26),
(246, 11, 'Dril Goliat  Reactivo Quimico No Tina,', '1,68', '7,4 Onz', '100% Algodon', '', '', 19429.9, '2026-01-22', 0, 46),
(247, 11, 'Dril Goliat Por Metro  Reactivo Quimico No Tina', '1,68', '7,4 Onz', '100% Algodon', '', '', 21702.3, '2026-01-22', 0, 46),
(248, 11, 'Dril Goliat  Reactivo Quimico No Tina', '1,68', '7,4 Onz', '100% Algodon', '', '', 19328.5, '2026-01-22', 0, 9),
(249, 11, 'Dril Hercules  Con Colorante Tina Medios', '1,58', '8 Onz 260 G', '100% Algodón', '', '', 12621, '2026-02-06', 0, 8),
(251, 11, 'Dril Kael  Sin Colorante Tina ', '1,6', '250 Gr', '100% Algodón', '', '', 18727, '2026-03-26', 0, 2),
(252, 11, 'Dril Kratos  ', '1,6', '', '100% Algodón', '', '', 12450.9, '2026-01-22', 0, 9),
(253, 11, 'Dril Nadal  Sin Colorante Tina', '1,6', '', '100% Algodón', '', '', 15300, '2026-03-26', 0, 16),
(254, 11, 'Dril Pegasso Medios Colorante Tina, Pelicula Anticloro, Proteccion Uv ', '1,68', '7,4 Onzas', '100% Algodón', '', '', 19404, '2026-01-22', 0, 34),
(255, 11, 'Dril Pegasso Oscuros Colorante Tina, Pelicula Anticloro, Proteccion Uv', '1,68', '7,4 Onzas', '100% Algodón', '', '', 19404, '2026-01-22', 0, 34),
(256, 11, 'Dril Raza  ', '1,6', '', '100% Algodòn', '', '', 14009.7, '2026-01-22', 0, 9),
(257, 11, 'Dril Raza Azteca  Colorante Tina ', '1,6', '275 Gr', '100% Algodòn', '', '', 20348.3, '2026-01-22', 0, 32),
(258, 11, 'Dril Raza Detal  Colorante Tina', '1,6', '2,15 Gr 7,6 Onzas', '100% Algodòn   ', '', '', 22719.9, '2026-01-22', 0, 44),
(259, 11, 'Dril Uniextrom ', '1,6', '250 Gr', '65%Algodon - 35%Poliester ', '', '', 11383.7, '2026-01-22', 0, 8),
(260, 11, 'Dril Universo 32  Colorante Tina', '1,6', '250 Gr', '100% Algodòn ', '', '', 17668.4, '2026-01-22', 0, 32),
(262, 11, 'Dril Vulcano O Activo  Con Colorante Reactivo Alta Fijacion', '1,6', '250 Gr', '100% Algodon', '', '', 18901, '2026-01-30', 0, 32),
(263, 11, 'Dril Rip Stop A r', '1,5', '185 Gr', '35% Algodón / 65% Poliéste', '', '', 15444.5, '2026-01-22', 0, 4),
(264, 12, 'Dril Sapndex Austin ', '1,6', '', '97% Algodón 3% Elastomero ', '', '', 19553.8, '2026-01-22', 0, 24),
(265, 12, 'Dril Spandex Espiga ', '1,57', '8 Onz ', '98 Algodo 2%Spadex ', '', '', 20040, '2026-01-22', 0, 26),
(267, 12, 'Dril Spandex Asuncion ', '1,6', '', '97% Algodón - 3% Elastomero', '', '', 21099.7, '2026-01-22', 0, 2),
(268, 12, 'Dril Spandex Avatar Flex', '1,6', '255 Gr 7,5onz', ' 98% Algodon 2% Spandex ', '', '', 22411.6, '2026-01-22', 0, 7),
(269, 12, 'Dril Spandex Biscaia ', '1,55', '6,4 Onzas ', '', '', '', 15534, '2026-01-22', 0, 8),
(270, 12, 'Dril Spandex Everest ', '1,6', '224 Gr', '97,5% - Algodón 2,5 % Elastomero  ', '', '', 19943, '2026-01-22', 0, 16),
(271, 12, 'Dril Spandex Everest Detal', '', '', '', '', '', 26405.6, '2026-01-22', 0, 15),
(272, 12, 'Dril Spandex Lenovoflex Elit  ', '1,4', '220 Gr', '59% Algodón -38%Poliester -3%Spandex', '', '', 11990, '2026-04-01', 0, 13),
(273, 12, 'Dril Spandex Lenovoflex Gold ', '1,4', '210 Gr', '59% Algodon - 38%Poliester - 3%Spandex ', '', '', 12990, '2026-04-01', 0, 13),
(274, 12, 'Dril Spandex Lisboa', '1,5', '260 Gr', '95% Algodon-5% Lycra', '', '', 19829.8, '2026-01-22', 0, 4),
(275, 12, 'Dril Spandex Liverpool', '', '', '', '', '', 0, '2026-01-22', 0, 47),
(276, 12, 'Dril Spandex Monserrate', '1,6', '265 Gr', '97,5% Algodon-2,5% Spandex', '', '', 16900.6, '2026-01-30', 0, 16),
(277, 12, 'Dril Spandex Moon ', '1,55', '198 Gr 7onz ', '98% Algodón -2% spandex', '', '', 16008.3, '2026-01-22', 0, 8),
(278, 12, 'Dril Spandex New Orleans', '', '', '', '', '', 0, '2026-01-22', 0, 47),
(279, 12, 'Dril Spandex Nouvelle - Delgado', '1,4', '216 Gr', '97% Algodón - 3% Spandex', '', '', 18368, '2026-01-22', 0, 13),
(280, 12, 'Dril Spandex Otawa ', '1,47', '', '98,66% Algodón 1,34%Spandex', '', '', 17182.2, '2026-01-22', 0, 48),
(281, 12, 'Dril Spandex Phoebe ', '1,44', 'Gr 7,3 Onz', '98%Algodon-2%Spandex ', '', '', 18854.2, '2026-01-22', 0, 7),
(282, 12, 'Dril Spandex Royal ', '1,5', '6,5 Onz', '97% Algodón - 3% Spandex, ', '', '', 18960.9, '2026-01-22', 0, 13),
(283, 12, 'Dril Spandex Star', '', '', '', '', '', 15800, '2026-02-19', 0, 8),
(284, 12, 'Dril Spandex Sun', '', '', '', '', '', 15652.6, '2026-01-22', 0, 8),
(285, 12, 'Dril Spandex Versalles 2 ', '1,5', '218 Gr', '98%Algod-2%Elastomero ', '', '', 20875.5, '2026-01-22', 0, 2),
(286, 12, 'Dril Star ', '', '7,5 Onza', '98% Alg-2 Span ', '', '', 15800, '2026-02-19', 0, 8),
(287, 13, 'Forro Vaskanit ', '1,55', '110 Gr', '100% Poliester', '', '', 4387.46, '2026-01-22', 0, 5),
(288, 13, 'Forro Brioni', '1,5', '', '', '', '', 20535.9, '2025-12-15', 0, 3),
(289, 13, 'Forro Briony Ancho ', '1,5', '', '', '', '', 3853.85, '2026-01-22', 0, 2),
(290, 13, 'Forro Briony 1 Ancho ', '1,5', '', '', '', '', 2291.83, '2026-01-22', 0, 1),
(291, 13, 'Forro Margaret Db ', '1,47', '120 Gr', '100%Poliester', '', '', 8288.74, '2026-01-22', 0, 43),
(292, 13, 'Forro Miami', '1,5', '', '', '', '', 12235.3, '2025-12-15', 0, 3),
(293, 13, 'Forro Michigan', '1,5', '', '', '', '', 15577.1, '2025-12-15', 0, 3),
(294, 13, 'Forro Microtitan', '1,48', '', '', '', '', 28674.8, '2025-12-15', 0, 3),
(295, 13, 'Forro Tafeta', '1,5', '', '', '', '', 2291.83, '2026-01-22', 0, 1),
(296, 13, 'Forro Uruguay ', '1,5', '110 Gr Kilo Rendimiento 6', '94,2 Polliester - 5,8 Elastano ', '', '', 8656.34, '2026-01-22', 0, 43),
(297, 14, 'Franela Barcelona (Tenemos Muestra)  ', '1,6', '150 Gramos', 'Poliester 65% -Algodón 35%,', '', '', 0, '2026-01-22', 0, 49),
(298, 14, 'Franela Barcelona (Tenemos Muestra)  Puede Homologar La Hamburgo', '1,6', '150 Gr', 'Poliester 65% -Algodón 35%', '', '', 0, '2026-01-22', 0, 49),
(299, 14, 'Franela Bavara', '', '', '', '', '', 10778.9, '2026-01-22', 0, 9),
(300, 14, 'Franela Bavara (Malagueña) ', '1,68', '190 Gr', '65%Poliester - 35% Algodón  ', '', '', 16242.2, '2026-01-22', 0, 50),
(301, 14, 'Franela Bavara 34', '1,7', '', '', '', '', 11858, '2026-01-22', 0, 34),
(302, 14, 'Franela Bavara Classic Blanco ', '1,8', '', '50% poliester - 50% Algodon ', '', '', 15640.7, '2026-01-22', 0, 16),
(303, 14, 'Franela Bavara Classic Claros ', '1,8', '', '50% poliester - 50% Algodon ', '', '', 16826.5, '2026-01-22', 0, 16),
(304, 14, 'Franela Bavara Classic Oscuros', '1,8', '', '50% Poleste - 50% Algodón  ', '', '', 18166.5, '2026-01-22', 0, 16),
(305, 14, 'Franela Bavaria Blancos', '1,8', '205 Gr Rend 2,71', '50%Poliester-50%Algodon', '', '', 16873.9, '2026-01-22', 0, 43),
(306, 14, 'Franela Bavaria  ', '1,8', '205 Gr Rend 2,71 Claro', '50%Poliester-50%Algodon ', '', '', 18913.5, '2026-01-22', 0, 43),
(307, 14, 'Franela Bavaria   Oscuros', '1,8', '205 Gr Rend 2,71', '50%Poliester-50%Algodon', '', '', 21795, '2026-01-22', 0, 43),
(308, 14, 'Franela Baviera Colores varios ', '1,7', '190 Gr', '65%Poliester-35%Algodon', '', '', 8800, '2026-02-16', 0, 51),
(310, 14, 'Franela Centauro ', '1,6', 'Rendimiento 3,5 - Minimo 3 Kil', '93%Algodon- 7%Spandex Algodón Peinado ', '', '', 14225.3, '2026-01-22', 0, 13),
(311, 14, 'Franela Danesa ', '1,46', '166 Gr', '65%Poliester -35% Algodón ', '', '', 10541.8, '2026-01-22', 0, 13),
(312, 14, 'Franela Escandinava Claros  Carga Min 580 Mts Por Color', '1,75', '155 Gr ', '100% Algodón Peinado', '', '', 13992.4, '2026-01-22', 0, 51),
(313, 14, 'Franela Escandinava Oscuros  Carga Min 580 Mts Por Color', '1,75', '155 Gr', '100% Algodón Peinado', '', '', 16008.3, '2026-01-22', 0, 51),
(314, 14, 'Franela Fria Peach, Kiwi', '', '', '', '', '', 0, '2026-01-22', 0, 14),
(315, 14, 'Franela Gold ', '1,6', '130 Gr', '95% Poliester-5% Spandex ', '', '', 5826.59, '2026-01-22', 0, 8),
(316, 14, 'Franela Hamburgo Rigida Color ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó', '', '', 13743.4, '2026-01-22', 0, 16),
(317, 14, 'Franela Hamburgo Rigida Blanco ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó ', '', '', 12925.2, '2026-01-22', 0, 16),
(318, 14, 'Franela Hamburgo Suave Blanco ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó ', '', '', 13518.1, '2026-01-22', 0, 16),
(319, 14, 'Franela Hamburgo Suave Color ', '1,8', '190-200 Gr', '65%Poliester-35% Algodó', '', '', 15083.4, '2026-01-22', 0, 16),
(320, 14, 'Franela Harriet ', '1,7', '240 Gr', '100% Algodón ', '', '', 19553.8, '2026-01-22', 0, 13),
(321, 14, 'Franela Jeremy ', '1,8', '180 Gr', '100% Algodón ', '', '', 16589.3, '2026-01-22', 0, 13),
(322, 14, 'Franela Jersey Supergaroto Silk  Encogim 3% Tintura A Partir 1000 Metros', '1,55', '150 Gr', '100% Algodón', '', '', 14217.7, '2026-01-22', 0, 13),
(323, 14, 'Franela Minotauro ', '1,6', '', 'Algodón + Spandex', '', '', 13518.1, '2026-01-22', 0, 13),
(324, 14, 'Franela Nevada ', '1,8', '192 Gr', '65%Pol-35%Alg', '', '', 8419.18, '2026-01-22', 0, 30),
(325, 14, 'Franela Topacio Claros (Parecida A La Bavara)  s Encog 3% Tintura A Partir 800 Mts', '1,6', '180 Gr', '65%Poliester-35%Algodon ', '', '', 10304.6, '2026-01-22', 0, 13),
(326, 14, 'Franela Topacio Oscuros Y Gj(Parecida A La Bavara)   Encog 3% Tintura A Partir 800 Mts', '1,6', '180 Gr', '65%Poliester-35%Algodon', '', '', 11490.4, '2026-01-22', 0, 13),
(327, 15, 'Gorra Beisbolera Hebilla Metalica Al Por Mayor', '', '', '', '', '', 7007, '2026-01-22', 0, 52),
(328, 15, 'Gorra Tipo Chavo Dril Azul Oscuro A Partir 12 Unidades', '', '', '', '', '', 8605.67, '2026-01-22', 0, 52),
(329, 16, 'Ignifgas Ultra Soft ', '1,6', '7 oz', '', '', '', 82520.9, '2025-12-15', 0, 3),
(330, 16, 'Ignifugas Dh ', '1,55', '6,5 oz', '', '', '', 109805, '2025-12-15', 0, 3),
(331, 16, 'Ignifugas Indigo ', '1,7', '14 oz', '', '', '', 90061.5, '2025-12-15', 0, 3),
(332, 16, 'Ignifugas Indura ', '1,6', '7 oz', '', '', '', 67750, '2026-02-19', 0, 3),
(333, 16, 'Ignifugas Indura ', '1,6', '9 oz', '', '', '', 0, '2026-02-19', 0, 3),
(334, 16, 'Ignifugas Ultra Soft ', '1,6', '9 oz', '', '', '', 113481, '2025-12-15', 0, 3),
(335, 16, 'Ignifugas Ultra Soft Rib ', '1,45', '10 oz', '', '', '', 228089, '2025-12-15', 0, 3),
(336, 17, 'Impermeable Campero LM 100% pol 1.50 anch ', '1.50', '201 gr', '100% Poliester ', '', '', 32950, '2026-04-17', 0, 3),
(337, 17, 'Impermeable Branta', '1,47', '', '', '', '', 51744, '2025-12-15', 0, 3),
(338, 17, 'Impermeable Cerrusport', '1,5', '', '', '', '', 34927.2, '2025-12-15', 0, 3),
(339, 17, 'Impermeable Gavia', '1,49', '', '', '', '', 0, '2025-12-15', 0, 3),
(340, 17, 'Impermeable Glou Crushed', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(341, 17, 'Impermeable Gorek Alta Visibilidad ', '1,5', '138gr', '100% POLIESTER', '', '', 20650, '2026-03-25', 0, 3),
(342, 17, 'Impermeable Gorek', '1,5', '138gr', '100% POLIESTER', '', '', 20428.1, '2025-12-15', 0, 3),
(343, 17, 'Impermeable Kasac ', '1,5', '', '', '', '', 22152.9, '2025-12-15', 0, 3),
(344, 17, 'Impermeable Orion Cloro Resistente', '1.68', '113', '100% POLIESTER', '', '', 24200, '2026-02-26', 0, 3),
(345, 17, 'Impermeable Orion Stretch', '1,7', '', '', '', '', 25950, '2026-02-11', 0, 3),
(346, 17, 'Impermeable Tempestad Alta Visibilidad Evolut', '1,5', '', '', '', '', 34280.4, '2025-12-15', 0, 3),
(347, 17, 'Impermeable Tempestad', '1,5', '', '', '', '', 28567, '2025-12-15', 0, 3),
(348, 17, 'Impermeable Top Gun ', '1,5', '', '', '', '', 35804.7, '2025-12-15', 0, 3),
(349, 17, 'Impermeable Top Gun Alta Visibilidad ', '1,51', '', '', '', '', 38808, '2025-12-15', 0, 3),
(350, 17, 'Impermeable Tormenta Homologa El Tempestad De 3', '1,51', '', '', '', '', 19802.9, '2026-01-22', 0, 10),
(351, 17, 'Impermeable Vendaval ', '1,5', '', '', '', '', 23265.4, '2025-12-15', 0, 3),
(352, 17, 'Impermeable Vendaval Cloro Resitente', '1,5', '', '', '', '', 23500.4, '2025-12-15', 0, 3),
(353, 17, 'Impermeable Vendaval Crushed', '1,5', '', '', '', '', 25386.9, '2025-12-15', 0, 3),
(354, 18, 'Indigo Avila Viscosa ', '1,67', 'Pesos 10 Oz', '31,5%Pol-62%Algo-6,5% ', '', '', 14715.8, '2026-01-22', 0, 2),
(356, 18, 'Indigo  Apolo 2 pago contado', '1,70', '12.5 Oz', '100% Algodón', '', '', 11200, '2026-02-24', 0, 8),
(357, 19, 'Indigo Nuevo Romano   1metro 15546', '1,68', '7 Oz', '', '', '', 12605, '2026-02-27', 0, 31),
(358, 19, 'Indigo Twill   ', '1,8', '5,5 oz', '100% Algodón', '', '', 16601.2, '2026-01-22', 0, 16),
(359, 19, 'Indigo Twill Corsega  ', '1,5', '4,5 Oz', '100% Algodòn', '', '', 12557.6, '2026-01-22', 0, 16),
(360, 19, 'Indigo Camisa Indigo ', '', '7 Oz', '', '', '', 23597.4, '2026-01-22', 0, 54),
(361, 19, 'Indigo Camisero ', '1,7', '4 ,1 Oz ', '100% Algodón ', '', '', 21344.4, '2026-01-22', 0, 31),
(362, 19, 'Indigo Camisero 1969  ', '1,7', '10 Oz', '100% Algodón', '', '', 19328.5, '2026-01-22', 0, 2),
(363, 19, 'Indigo Camisero ', '1,7', '5 Oz', '', '', '', 19210, '2026-01-22', 0, 31),
(364, 19, 'Indigo Camisero  ', '1,5', '6,8 Oz', '100% Algodón', '', '', 11146.5, '2026-01-22', 0, 16),
(365, 19, 'Indigo Camisero ', '1,7', '9,5 Oz ', '70%Algod-28% Poliester- 2 Elastano ', '', '', 22411.6, '2026-01-22', 0, 31),
(366, 19, 'Indigo Camisero ', '1,63', '5 Oz', '70%Algod-30% Poliester  ', '', '', 19210, '2026-01-22', 0, 31),
(367, 19, 'Indigo Camisero America ', '1,67', '7 Oz', '100% Algodon', '', '', 16025.5, '2026-01-22', 0, 2),
(368, 19, 'Indigo Camisero Arles ', '1,5', '8,5 Oz', 'Comp Algodón + Poliester + Lycra', '', '', 15415.4, '2026-01-22', 0, 2),
(369, 19, 'Indigo Camisero Atenea ', '', '6 Oz', '100% Algodón ', '', '', 0, '2026-01-22', 0, 8),
(370, 19, 'Indigo Camisero Claire ', '1,7', '7 Oz ', '', '', '', 13755.3, '2026-01-22', 0, 55),
(371, 19, 'Indigo Camisero Latino ', '', '7 Oz ', '100% Algodón 1,70 Ancho', '', '', 12332.3, '2026-01-22', 0, 8),
(372, 19, 'Indigo Camisero Michigan ', '1,7', '5,3 Oz', '100% Algodón ', '', '', 13518.1, '2026-01-22', 0, 56),
(373, 19, 'Indigo Camisero Mucura ', '1,6', '10,4 Oz ', '100% Algodón ', '', '', 22411.6, '2026-01-22', 0, 31),
(374, 19, 'Indigo Camisero Pandora    0% Encogimiento', '1,7', '7 Oz', '100% Algodón', '', '', 0, '2026-01-22', 0, 8),
(375, 20, 'Indigo ', '', '', '', '', '', 17431.3, '2026-01-22', 0, 34),
(376, 20, 'Indigo Chronos ', '1,7', '13 Oz ', '80% Algodón -20%Poliester ', '', '', 13992.4, '2026-01-22', 0, 8),
(377, 20, 'Indigo ', '', '12 Oz', '100% Algodón  ', '', '', 15356.1, '2026-01-22', 0, 57),
(378, 20, 'Indigo 13 Onz Peso ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 17957.3, '2026-01-22', 0, 55),
(379, 20, 'Indigo Alfa ', '1,67', '12,8 Oz  ', '90%Algodon - 10% Poliester ', '', '', 17300.8, '2026-01-22', 0, 32),
(380, 20, 'Indigo Apolo 2 ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 14553, '2026-01-22', 0, 2),
(381, 20, 'Indigo Apolo 2 ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 11700, '2026-02-20', 0, 8),
(382, 20, 'Indigo Coloso ', '1,7', '13,75 Oz ', '100% Algodón ', '', '', 17609.1, '2026-01-22', 0, 8),
(383, 20, 'Indigo Dallas ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 19349, '2026-01-22', 0, 2),
(384, 20, 'Indigo Damasco ', '1,7', '13.5 Oz ', '', '', '', 18617.1, '2026-01-22', 0, 58),
(385, 20, 'Indigo Denver ', '1,69', '13,5 Oz ', '100% Algodón ', '', '', 21381.1, '2026-01-22', 0, 2),
(386, 20, 'Indigo Detroit ', '1,7', '13,75 Oz ', '100% Algodón ', '', '', 17668.4, '2026-01-22', 0, 53),
(387, 20, 'Indigo Inti ', '1,7', '12 Oz  ', '27%Poliester - 61%Algodon - 12%Viscosa ', '', '', 16025.5, '2026-01-22', 0, 2),
(388, 20, 'Indigo Lemmon ', '1,68', '12,5 Oz ', '100%Algodon', '', '', 11383.7, '2026-01-22', 0, 26),
(389, 20, 'Indigo Marvel ', '1,7', '13 Oz ', '100% Algodón ', '', '', 16838.4, '2026-01-22', 0, 34),
(390, 20, 'Indigo Super Inti ', '1,7', '12 Oz  ', '34%Poliester - 53%Algodon - 13%Rayon ', '', '', 16177.5, '2026-01-22', 0, 2),
(391, 20, 'Indigo Tazmania ', '1,7', '12 Oz ', '', '', '', 12289.2, '2026-01-22', 0, 57),
(392, 20, 'Indigo Tera ', '1,7', '13,5 Oz ', '100% Algodón ', '', '', 17312.7, '2026-01-22', 0, 9),
(393, 20, 'Indigo Texano ', '1,69', '12,5 Oz ', '100% Algodón ', '', '', 19349, '2026-01-22', 0, 2),
(394, 20, 'Indigo Tronic Delta ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 19565.7, '2026-01-22', 0, 9),
(395, 20, 'Indigo Tronic ', '1,7', '12,5 Oz', '100% Algodón ', '', '', 18735.6, '2026-01-22', 0, 9),
(396, 20, 'Indigo Tundra ', '1,7', '12,5 Oz ', '100% Algodón ', '', '', 17668.4, '2026-01-22', 0, 53),
(397, 20, 'Indigo Venecia ', '1,75', '13 Oz ', '100% Algodón ', '', '', 14229.6, '2026-01-22', 0, 56),
(398, 20, 'Indigo Vesubio ', '1,68', '13 Oz ', '100% Algodón Recilado ', '', '', 18854.2, '2026-01-22', 0, 34),
(399, 20, 'Indigo Vesubio Fabricato  ', '1,7', '12,6 Oz ', '100% Algodón', '', '', 17075.5, '2026-01-22', 0, 16),
(400, 20, 'Indigo Zeus  ', '1,7', '13,75 Oz ', '100% Algodón  ', '', '', 16482.6, '2026-01-22', 0, 2),
(401, 20, 'Indigo ', '1,7', '12,75 Oz', '100% Algodón ', '', '', 16018, '2026-01-22', 0, 26),
(402, 21, 'Indigo Bybury ', '1,84', '9,5 Oz ', 'Alg-Spandex', '', '', 12251.5, '2026-01-22', 0, 2),
(403, 21, 'Indigo Finlandia ', '1,33', '', '65% Algodon - 31%Poliester - 4% Lycra ', '', '', 13399.5, '2026-01-22', 0, 56),
(404, 21, 'Indigo Gènesis ', '1,6', '11,3 Oz ', '98%Poliester - 2%Spandex ', '', '', 15178.2, '2026-01-22', 0, 56),
(405, 21, 'Indigo Granada ', '1,54', '10 oz', '97% Algodon - 3%Lycra ', '', '', 13281, '2026-01-22', 0, 56),
(406, 21, 'Indigo Spandex Carlin ', '1,65', '10 Oz', '97% Indigo-3 Spandex ', '', '', 17034.6, '2026-01-22', 0, 55),
(407, 21, 'Indigo Spandex Mikonos ', '1,45', '9,7 Oz ', '98% Algodon -2 Spandex', '', '', 21344.4, '2026-01-22', 0, 8),
(408, 21, 'Indigo Spandex Missy Azul ', '1,44', '8,8 Oz ', '67% Algodon-30%Poliester- 3% Spandex', '', '', 16364, '2026-01-22', 0, 8),
(409, 21, 'Indigo Spandex Mostaza ', '1,6', '9 Oz', '79% Algodon - 19%Poliester - 2%Spdex', '', '', 10553.6, '2026-01-22', 0, 26),
(410, 21, 'Inidgo Licrado ', '1,8', '', '98%Algodon - 2%Elastano ', '', '', 20099.3, '2026-01-22', 0, 32),
(411, 22, 'Jean Dama ', '', '', '68% Algodón 20%  Poliester 2 Elastano ', '', '', 30618.4, '2026-01-22', 0, 59),
(412, 22, 'Jean Dama ', '', '', '68% Algodón 20% Poliester 2 Elastano ', '', '', 30618.4, '2026-01-22', 0, 59),
(413, 22, 'Jean Dama  ', '', '', '68% Algodón 20% Poliester 2 Elastano', '', '', 30618.4, '2026-01-22', 0, 59),
(414, 22, 'Jean Dama Con Spandex ', '', '', '', '', '', 26087.6, '2026-01-22', 0, 54),
(415, 22, 'Jean Dama ', '', '8 Oz', '', '', '', 33880.5, '2026-01-22', 0, 60),
(416, 22, 'Jean Dama ', '', '', '', '', '', 36868.7, '2026-01-22', 0, 60),
(417, 22, 'Jean Dama', '', '', '', '', '', 32883.3, '2026-01-22', 0, 60),
(418, 22, 'Jean Hombre Dotacion Composicion ', '', '', '', '', '', 31389.2, '2026-01-22', 0, 59),
(419, 22, 'Jean Hombre Dotacion Composicion', '', '', '', '', '', 34378.5, '2026-01-22', 0, 59),
(420, 22, 'Jean Hombre Dotacion Composicion ', '', '', '', '', '', 37367.8, '2026-01-22', 0, 59),
(421, 22, 'Jean Hombre Rigido ', '', '14 Oz', '', '', '', 26087.6, '2026-01-22', 0, 54),
(422, 22, 'Jean Hombre  ', '', '', 'Spandex', '', '', 35274.3, '2026-01-22', 0, 59),
(423, 22, 'Jean Hombre  ', '', '', 'Spandex', '', '', 38263.6, '2026-01-22', 0, 59),
(424, 22, 'Jean Hombre Talla 28 A 36', '', '', '', '', '', 29894, '2026-01-22', 0, 60),
(425, 22, 'Jean Hombre Talla 38 A 42', '', '', '', '', '', 31887.2, '2026-01-22', 0, 60),
(426, 22, 'Jean Hombre Talla 44-46 Y 48', '', '', '', '', '', 34876.5, '2026-01-22', 0, 60),
(427, 22, 'Jean Spandex Negro Caballero ', '', '', '', '', '', 39858, '2026-01-22', 0, 59),
(428, 22, 'Jean Spandex Negro Caballero ', '', '', '', '', '', 42848.3, '2026-01-22', 0, 59),
(429, 22, 'Jean Spandex Negro Dama ', '', '', '', '', '', 42748.1, '2026-01-22', 0, 59),
(430, 22, 'Jean Spandex Negro Dama ', '', '', '', '', '', 39757.7, '2026-01-22', 0, 59),
(431, 23, 'Malla Orion Para Forro Color Blanco', '', '', '', '', '', 2608.76, '2026-01-22', 0, 5),
(432, 23, 'Malla Para Forrar Camisa Mitad Espalda Blanca', '', '', '', '', '', 4349.73, '2026-01-22', 0, 4),
(433, 23, 'Malla Para Forrar Camisa Mitad Espalda Blanca O Chaquetta', '', '', '', '', '', 3488.41, '2026-01-22', 0, 1),
(434, 24, 'Impermeable Campero', '1,5', '', '', '', '', 32286.1, '2025-12-15', 0, 3),
(435, 24, 'Impermeable Huracan', '1,5', '', '', '', '', 44251.9, '2025-12-15', 0, 3),
(436, 24, 'Lona Reebag', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(437, 25, 'Tela lino flex America Minimat  ', '1.50', '100 Gr', '100% Poliester', '', '', 5000, '2026-04-18', 0, 48),
(438, 25, 'Lino Nova (Linoflex)', '', '', '', '', '', 6147.83, '2026-01-22', 0, 2),
(439, 25, 'Lino Vertigo ', '', '', '', '', '', 16601.2, '2026-01-22', 0, 61),
(440, 25, 'Linoflex ', '1,5', '', '100% Poliester ', '', '', 6166.16, '2026-01-22', 0, 5),
(441, 25, 'Linoflex  ', '1,54', '', '100% Poliester', '', '', 7472.7, '2026-01-22', 0, 4),
(442, 25, 'Linoflex Barcelona', '1,5', '', '100% Poliester ', '', '', 6144, '2026-02-27', 0, 16),
(443, 25, 'Linoflex ', '1,5', '', '100% Poliester  ', '', '', 9594.2, '2026-01-22', 0, 16),
(444, 25, 'Linoflex ', '1,5', '', '100% Poliester ', '', '', 7473.77, '2026-01-22', 0, 62),
(445, 25, 'Linoflex  ', '', '', '100% Poliester', '', '', 6083.15, '2026-01-22', 0, 9),
(446, 25, 'Linoflex Alicia ', '1,5', '175 Oz', '100% Poliester ', '', '', 0, '2026-01-22', 0, 2),
(447, 25, 'Linoflex ', '1,5', '', '100% Poliester ', '', '', 6277.19, '2026-01-22', 0, 1),
(448, 25, 'Linoflex Esmeralda ', '1,5', '', '100% Poliester ', '', '', 4861.78, '2026-01-22', 0, 2),
(449, 25, 'Linoflex Francia', '', '', '', '', '', 6417.33, '2026-01-22', 0, 2),
(450, 25, 'Linoflex Gabardina Alegado ', '1,5', '', '', '', '', 6284.74, '2026-01-22', 0, 58),
(451, 25, 'Linoflex Gabardina Ox Café Oscuro Coidgo 12417 Seguridad Nal ', '1,47', '', '100% Poliester', '', '', 5200, '2026-02-09', 0, 5),
(452, 25, 'Linoflex 61 ', '', '', '100% Poliester ', '', '', 8300.6, '2026-01-22', 0, 61),
(453, 25, 'Linoflex London ', '1,5', '180 Gr', '100% Poliester ', '', '', 4900, '2026-03-12', 0, 8),
(454, 25, 'Linoflex Lyon ', '1,45', '', '100% Poliester ', '', '', 13043.8, '2026-01-22', 0, 25),
(455, 25, 'Pantalon Alviero Strech', '1,51', '205', '100% POLIESTER', '', '', 24578.4, '2025-12-15', 0, 3),
(456, 25, 'Pantalon Ankara Lycra', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(457, 25, 'Pantalon Batari Lycra', '1,5', '', '', '', '', 28782.6, '2025-12-15', 0, 3),
(458, 25, 'Tela pantalon Bogaz Lycra', '1,5', '250', 'Poliester 97% Lycra 3%', '', '', 29200, '2026-02-02', 0, 3),
(459, 25, 'Pantalon Bogaz Lycra Estampado', '1,5', '', '', '', '', 28620.9, '2025-12-15', 0, 3),
(460, 25, 'Pantalon Brunno Lp', '1,54', '', '', '', '', 0, '2025-12-15', 0, 3),
(461, 25, 'Pantalon Chakma ', '', '', '97%Poliester - 3%Spandex', '', '', 14984.2, '2026-01-22', 0, 24),
(462, 25, 'Pantalon Cosmos ', '1,53', '', '', '', '', 20967.1, '2025-12-15', 0, 3),
(463, 25, 'Pantalon Dynamic', '1,49', '', '', '', '', 19457.9, '2025-12-15', 0, 3),
(464, 25, 'Pantalon Elegance ', '1,35', '243 Gr', '97%Poliester-3% Elastomero ', '', '', 16482.6, '2026-01-22', 0, 29),
(465, 25, 'Pantalon Florence Detal ', '1,4', '240 Gr', '94% Poliéster, 6% Spandex', '', '', 28697.4, '2026-01-22', 0, 44),
(466, 25, 'Pantalon Florence 14 ', '1,4', '240 Gr', '94% Poliéster, 6% Spandex', '', '', 14450, '2026-05-06', 0, 14),
(467, 25, 'Pantalon Lugo', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(468, 25, 'Pantalon Lyon Linoflex Strech Mecanico ', '1,5', '', '', '', '', 17194.1, '2026-01-22', 0, 25),
(469, 25, 'Pantalon Megadrill Lafshield', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(470, 25, 'Pantalon Microdril', '1,49', '', '', '', '', 27693.8, '2025-12-15', 0, 3),
(471, 25, 'Pantalon Moretti', '1,5', '', '', '', '', 26787.2, '2025-12-15', 0, 3),
(472, 25, 'Pantalon Novastretch Lc', '1,53', '', '', '', '', 32825.1, '2025-12-15', 0, 3),
(473, 25, 'Pantalon People Strech ', '1,4', '245 Gr', '96% Poliester - 4%Spandex', '', '', 22530.2, '2026-01-22', 0, 22),
(474, 25, 'Pantalon Praga ', '1,5', '30gm ', '96% Poliester - 4% spandex Supervertigo', '', '', 12332.3, '2026-01-22', 0, 8),
(475, 25, 'Pantalon Segal Wicking', '1,5', '', '', '', '', 31589.7, '2025-12-15', 0, 3),
(476, 25, 'Pantalon Soho (Supervertigo O Studio F)  ', '1,5', '239 Gr', '96% Poliester-4%Spandex', '', '', 0, '2026-01-22', 0, 59),
(477, 25, 'Pantalon Soho', '1,51', '', '', '', '', 22314.6, '2025-12-15', 0, 3),
(478, 25, 'Pantalon Stefano R', '1,56', '', '', '', '', 31315.9, '2025-12-15', 0, 3),
(479, 25, 'Pantalon Stefano Lycra R', '1,54', '', '', '', '', 37298.8, '2025-12-15', 0, 3),
(480, 25, 'Pantalon Super Big Star ', '1,42', '216- 239 Gr', '96% Poliester 4% Elastomero  ', '', '', 14111, '2026-01-22', 0, 24),
(481, 25, 'Pantalon Super Vertigo 15 ', '1,5', '', '65% Poliester-35%Algodon', '', '', 0, '2026-03-12', 0, 15),
(482, 25, 'Pantalon Supervertigo ', '1,4', '236 Gr  ', '96% Poliester 4%Elastomero ', '', '', 13500, '2026-03-17', 0, 29),
(483, 25, 'Pantalon Supervertigo5 ', '1,45', '', '', '', '', 12953.2, '2026-01-22', 0, 5),
(484, 25, 'Pantalon Tafetan Garota ', '', '', '65% Poliester-35%Algodòn', '', '', 12834.7, '2026-01-22', 0, 2),
(485, 25, 'Pantalon Tisu', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3),
(486, 25, 'Pantalon Trevi ', '1,6', '', '', '', '', 29081.2, '2025-12-15', 0, 3),
(487, 25, 'Pantalon Triana Lycra', '1,5', '', '', '', '', 0, '2025-12-15', 0, 3);
INSERT INTO `tela_forro` (`id_telaforro`, `id_tipo_tela`, `tela_forro`, `ancho`, `peso`, `caracteristicas`, `rendimiento`, `encogimiento`, `precio`, `fecha_actualizacion`, `unidades_metros`, `id_proveedor`) VALUES
(488, 25, 'Pantalon Versalles ', '1,43', '245 Gr', '95% Poliester Filamentos - 5% Elastomero ', '', '', 17341.8, '2026-01-22', 0, 4),
(489, 25, 'Pantalon Vertigo 15, Menos Pesado Que Supervertigo, Elongacion 1 Direccion ', '1,5', '200 Gr', '65%Poliester-35%Algodon ', '', '', 24546.1, '2026-01-22', 0, 15),
(490, 25, 'Pantalon Vertigo Lafayete ', '1,45', '320 Gr ', '98% Poliester 2% Spandex ', '', '', 11099.1, '2026-01-22', 0, 2),
(491, 25, 'Pantalon Vertigo Leticia   Por Ahora Solo Azul Oscuro', '1,45', '220 Gr ', '97% Poliester 3% Spandex', '', '', 0, '2026-01-22', 0, 2),
(492, 25, 'Pantalon Zulu Stretch', '1,5', '', '', '', '', 18379.9, '2025-12-15', 0, 3),
(493, 26, 'Gabardina Esparta ', '1,5', '180 Gr ', '20%Algodon - 80%Poliester ', '', '', 8507.58, '2026-01-22', 0, 2),
(494, 26, 'Gabardina Magenta ', '1,67', '200 Gr ', '49%Poliester 26%Algodon 25%Pst ', '', '', 15047.8, '2026-01-22', 0, 32),
(495, 26, 'Gabardina Olimpia Blanca ', '1,5', '182 Gr', '65%Poliester 35% Algodón ', '', '', 14293.2, '2026-01-22', 0, 2),
(496, 26, 'Tela pantalon Gabardina Praga ', '1,5', '193 Gr', '65%Pol - 35%Algodon ', '', '', 10500, '2026-04-18', 0, 2),
(497, 26, 'Gabardina Rio ', '1,5', '200 Gr', '65%Poliester - 35%Algodon', '', '', 9243, '2026-02-26', 0, 4),
(498, 26, 'Gabardina Tempo ', '1,7', '189 Gr ', '49%Poliester 26%Algodon 25%Pst ', '', '', 14111, '2026-01-22', 0, 66),
(499, 27, 'Perchado Cairo Plus', '', '', '', '', '', 11016.1, '2026-01-22', 0, 13),
(500, 27, 'Perchado Fastrack Pb', '1,63', '', '', '', '', 0, '2025-12-15', 0, 3),
(501, 27, 'Perchado Monaco ', '1,5', '264 Gr', '84%Poliester 16%Algodon ', '', '', 19553.8, '2026-01-22', 0, 13),
(502, 27, 'Perchado Monarca ', '1,5', '280 Gr', '100%Poliester ', '', '', 15877.9, '2026-01-22', 0, 13),
(503, 27, 'Perchado Montevideo ', '1,5', '164 Gr', '100%Poliester', '', '', 8644.48, '2026-01-22', 0, 13),
(504, 27, 'Perchado Seul ', '1,5', '200 Gr', '52%Poliester-48% Algodón ', '', '', 14016.2, '2026-01-22', 0, 43),
(505, 27, 'Perchado Seul ', '1,5', '200 Gr', '52%Poliester-48% Algodón ', '', '', 15723.7, '2026-01-22', 0, 43),
(506, 27, 'Perchado Seul Oscuro', '1,5', '200 Gr', '52%Poliester-48% Algodón', '', '', 18415.5, '2026-01-22', 0, 43),
(507, 27, 'Perchado Standford   Blanco', '1,5', '285 Gr', '44%Poliester-55% Algodón', '', '', 23111.2, '2026-01-22', 0, 43),
(508, 27, 'Perchado Standford  Claro', '1,5', '285 Gr', '44%Poliester-55% Algodón', '', '', 25067.8, '2026-01-22', 0, 43),
(509, 27, 'Perchado Standford Oscuro', '1,5', '285 Gr', '44%Poliester-55% Algodón', '', '', 29064, '2026-01-22', 0, 43),
(510, 28, 'Pique Palaos  Tenemos Muestra', '', '230 Gr', '', '', '', 0, '2026-01-22', 0, 0),
(511, 28, 'Pique ', '', '', '65% Poliester 35% Algodón', '', '', 22530.2, '2026-01-22', 0, 9),
(512, 28, 'Pique Action', '1,57', '', '', '', '', 33563.5, '2025-12-15', 0, 3),
(513, 28, 'Pique Antilla ', '1,8', '200 Gr', '65% Poliester 35%Algodon', '', '', 14703.9, '2026-01-22', 0, 51),
(514, 28, 'Pique Apolo ', '1,76', '', '20% Algodón - 80%Poliester ', '', '', 26680.5, '2025-12-15', 0, 3),
(515, 28, 'Pique Apoluss, Es Un Lacoste  Blanca', '1,8', '200 Gr', ' 100% Poliester ', '', '', 31962.7, '2026-01-22', 0, 50),
(516, 28, 'Pique Apoluss, Es Un Lacoste  ,  Negra Y Azul Oscura', '1,8', '200 Gr', '100% Poliester', '', '', 26893.9, '2026-01-22', 0, 50),
(517, 28, 'Pique Aranza ', '1,7', '210 Gr', '73%Pol - 27%Algo', '', '', 10990, '2026-03-17', 0, 13),
(518, 28, 'Pique Armani    Tipo Pique Lacoste Caiman $36000 Kg Rendimiento 3 Metros Venden Cuellos Y Puños', '1,5', '220 Gr', '100% Poliester', '', '', 10672.2, '2026-01-22', 0, 8),
(519, 28, 'Pique Atlantic +', '1,5', '', '', '', '', 28227.4, '2025-12-15', 0, 3),
(520, 28, 'Pique Barbados  Blanca ', '1,5', '', '65%Poliester 35% Algodón', '', '', 0, '2026-01-22', 0, 0),
(521, 28, 'Pique Cole Plus Alta Visibilidad 2.00', '', '', '', '', '', 21021, '2025-12-15', 0, 3),
(522, 28, 'Pique Cole Plus2', '', '', '', '', '', 21450, '2026-02-02', 0, 3),
(523, 28, 'Pique Dakota Classic Blanco  ', '2', '195 Gr ', '50% Poliester - 50% Algodón ', '', '', 18071.6, '2026-01-22', 0, 16),
(524, 28, 'Pique Dakota Classic Claros ', '2', '195 Gr ', '50% Poliester - 50% Algodón ', '', '', 19957, '2026-01-22', 0, 16),
(525, 28, 'Pique Dakota Classic Oscuros ', '2', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 21676.4, '2026-01-22', 0, 16),
(526, 28, 'Pique Db Color Microfibra', '1,8', '', '100% Poliester ', '', '', 13221.7, '2026-01-22', 0, 16),
(527, 28, 'Pique Decathon  (Polux)', '1,8', '', '100% Poliester', '', '', 15403.5, '2026-01-22', 0, 65),
(528, 28, 'Pique Decathon  (Polux) ', '1,8', '', '100% Poliester', '', '', 14445.2, '2026-01-22', 0, 16),
(529, 28, 'Pique Deportiva  ', '1,5', '', '100%Poliester', '', '', 10660.3, '2026-01-22', 0, 13),
(530, 28, 'Pique Deportiva Super ', '1,47', '209 Gr', '84,2 Poliester-15,8 Algodón', '', '', 12533.9, '2026-01-22', 0, 43),
(531, 28, 'Pique 60 Tipo Lacoste Blanca  Parece Apoluss,  Blanca', '1,8', '216 Gr ', '100% Poliester', '', '', 12688.1, '2026-01-22', 0, 5),
(532, 28, 'Pique 60 Tipo Lacoste Colores Parece Apoluss, ', '1,8', '216 Gr ', '100% Poliester ', '', '', 14466.8, '2026-01-22', 0, 5),
(533, 28, 'Pique Generra Blanco ', '2', '250 Gr', '50% Poliester - 50% Algodón ', '', '', 21522.3, '2026-01-22', 0, 66),
(534, 28, 'Pique Generra Claros ', '2', '250 Gr', '50% Poliester - 50% Algodón ', '', '', 22909.7, '2026-01-22', 0, 66),
(535, 28, 'Pique Generra Oscuros', '2', '250 Gr', '50% Poliester - 50% Algodón ', '', '', 24895.3, '2026-01-22', 0, 66),
(536, 28, 'Pique Hannover    Blancos', '1,8', '190 Gr', '77%Poliester-23 Algodón', '', '', 16648.6, '2026-01-22', 0, 43),
(537, 28, 'Pique Hannover    Claros', '1,8', '190 Gr', '77%Poliester-23 Algodón', '', '', 18771.2, '2026-01-22', 0, 43),
(538, 28, 'Pique Hannover    Oscuros', '1,8', '190 Gr', '77%Poliester-23 Algodón', '', '', 20561.8, '2026-01-22', 0, 43),
(539, 28, 'Pique Hannover  Tenemos Muestra', '', '200 Gr', '', '', '', 0, '2026-01-22', 0, 16),
(540, 28, 'Pique Lacost Mil Rayas ', '1,8', '210 Gr', '65%Poliester - 35%Algodon ', '', '', 10079.3, '2026-01-22', 0, 30),
(541, 28, 'Pique Lacoste ', '1,8', '200 Gr ', '65%Poliester-35% Algodón ', '', '', 12450.9, '2026-01-22', 0, 50),
(542, 28, 'Pique Lindatextil   Se Parece A La Poltexsec', '1,8', '200 Gr', '100% Poliester', '', '', 15356.1, '2026-01-22', 0, 43),
(543, 28, 'Pique Lucia ', '1,8', '220 Gr', '65% Poliester - 35% algodón   ', '', '', 11957.2, '2026-01-22', 0, 78),
(544, 28, 'Pique Madrigal Claros (Polux) ', '1,8', '220 Gr ', '100%Poliester', '', '', 8300.6, '2026-01-22', 0, 30),
(545, 28, 'Pique Madrigal Claros Homologa Polux', '', '', '', '', '', 8774.92, '2026-01-22', 0, 16),
(546, 28, 'Pique Madrigal Oscuros (Polux) ', '1,8', '220 Gr', '100%Poliester', '', '', 9012.08, '2026-01-22', 0, 0),
(547, 28, 'Pique Madrigal Oscuros Homologa Polux', '', '', '', '', '', 10458.8, '2026-01-22', 0, 0),
(548, 28, 'Pique Manila Claros ', '1,6', '180 Gr ', '80% Poliester -20% Algodón ', '', '', 7589.12, '2026-01-22', 0, 30),
(549, 28, 'Pique Manila Oscuros ', '1,6', '180 Gr', '80% Poliester -20% Algodón ', '', '', 8537.76, '2026-01-22', 0, 30),
(550, 28, 'Pique Oslo ', '1,8', '', '', '', '', 0, '2026-01-22', 0, 67),
(551, 28, 'Pique Palaos  Es Mas Suave Que Hannover Blancos', '1,8', '', '65%Poliester- 35%Algodon', '', '', 22755.5, '2026-01-22', 0, 43),
(552, 28, 'Pique Palaos   Es Mas Suave Que Hannover Claros', '1,8', '230 Gr', '65%Poliester- 35%Algodon ', '', '', 25316.8, '2026-01-22', 0, 43),
(553, 28, 'Pique Palaos   Es Mas Suave Que Hannover Oscuros', '1,8', '230 Gr', '65%Poliester- 35%Algodon', '', '', 28992.8, '2026-01-22', 0, 43),
(554, 28, 'Pique Palermo  Rollo', '1,83', '205 Gr', '100% Algodón', '', '', 26462.7, '2026-01-22', 0, 66),
(555, 28, 'Pique Poltexsec ', '1,8', '210 Gr', '100%Poliester ', '', '', 9690, '2026-03-11', 0, 13),
(556, 28, 'Pique Poluss  ', '1,65', '220 Gr', '', '', '', 13950.4, '2026-01-22', 0, 68),
(557, 28, 'Pique Poluss 34   ', '1,65', '220 Gr', '', '', '', 14822.5, '2026-01-22', 0, 34),
(558, 28, 'Pique Polux', '1,8', '226GR', '100% POLIESTER', '', '', 23400, '2026-02-13', 0, 3),
(559, 28, 'Pique 73 ', '1,9', '220 Gr ', '65% Poliester -35% Algodón ', '', '', 14148.8, '2026-01-22', 0, 50),
(560, 28, 'Pique Rus Blancos', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 19731.7, '2026-01-22', 0, 43),
(561, 28, 'Pique Ruso   Claros - 25 Dias Programacion Color', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 23182.4, '2026-01-22', 0, 43),
(562, 28, 'Pique Ruso  Oscuros 25 Dias Programacion Color', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 27309, '2026-01-22', 0, 43),
(563, 28, 'Pique Russo Blanco ', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 20538.1, '2026-01-22', 0, 66),
(564, 28, 'Pique Russo Medios ', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 24178.5, '2026-01-22', 0, 66),
(565, 28, 'Pique Russo Oscuros ', '1,8', '225 Gr', '65%Poliester-35%Algodon', '', '', 28459.2, '2026-01-22', 0, 66),
(566, 28, 'Pique Russo/Ref Nigeria ', '1,7', '216 Gr ', '65%Poliester-35%Algodon', '', '', 9367.82, '2026-01-22', 0, 30),
(567, 28, 'Pique Saturno ', '1,8', '180 Gr', '65% Poliester 35%Algodon', '', '', 0, '2026-01-22', 0, 69),
(568, 28, 'Pique Speed Igual A La Spray ', '1,5', '140 Gr', '100%Poliester ', '', '', 7673.2, '2026-01-22', 0, 5),
(569, 28, 'Pique Spray ', '1,47', '136 Gr', '100%Poliester ', '', '', 8763.06, '2026-01-22', 0, 43),
(570, 28, 'Pique Spray Azul Rey Y Azul La De Eve', '', '', '', '', '', 8964.65, '2026-01-22', 0, 16),
(571, 28, 'Pique Superior Claros ', '1,9', '220 Gr ', '65% Poliester 35%Algodon', '', '', 10672.2, '2026-01-22', 0, 30),
(572, 28, 'Pique Superior Medios ', '1,9', '220 Gr ', '65% Poliester 35%Algodon', '', '', 11858, '2026-01-22', 0, 0),
(573, 28, 'Pique Terranova Blanco ', '1,76', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 18729.2, '2026-01-22', 0, 66),
(574, 28, 'Pique Terranova Medios ', '1,76', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 21403.7, '2026-01-22', 0, 66),
(575, 28, 'Pique Terranova Oscuros ', '1,76', '195 Gr', '50% Poliester - 50% Algodón ', '', '', 23301, '2026-01-22', 0, 66),
(576, 28, 'Pique Tikal R  Homologa Polux', '1,85', '', '', '', '', 29000, '2026-05-14', 0, 3),
(577, 28, 'Pique Togo ', '1,47', '110 Gr', '100% Poliester ', '', '', 7766.99, '2026-01-22', 0, 43),
(578, 28, 'Pique Ultra  Blanco', '1,8', '200 Gr', '65% Poliester 35%Algodon', '', '', 13518.1, '2026-01-22', 0, 16),
(579, 28, 'Pique Ultra    Colores', '1,8', '200 Gr', '65% Poliester 35%Algodon', '', '', 9723.56, '2026-01-22', 0, 16),
(580, 29, 'Polo Mc Blanca', '', '', '', '', '', 22420.2, '2026-01-22', 0, 70),
(581, 29, 'Polo Mc Color', '', '', '', '', '', 23416.3, '2026-01-22', 0, 70),
(582, 29, 'Polo Ml Blanca', '', '', '', '', '', 25907.6, '2026-01-22', 0, 70),
(583, 29, 'Polo Ml Color', '', '', '', '', '', 26903.6, '2026-01-22', 0, 70),
(584, 29, 'Polos Mc', '', '', '', '', '', 0, '2026-01-22', 0, 71),
(585, 30, 'Rib Bahamas Se Tiñe Con Prendas Entrega 25 A 30 Dias', '1,4', '216 Gr', '65%Poliester -35%Algodon', '', '', 9400, '2026-02-05', 0, 51),
(586, 30, 'Rib Éxito ', '1,6', '200 Gr', '65%Poliester -35%Algodon ', '', '', 17775.1, '2026-01-22', 0, 72),
(587, 30, 'Rib 73 ', '1,5', '', 'Poliesteralgodon ', '', '', 15942.5, '2026-01-22', 0, 73),
(589, 30, 'Tela Rib Supergaroto ', '1.10', '160 gr ', '100 % Algodon', '', '', 8990, '2026-02-20', 0, 13),
(590, 30, 'Rib Titanica ', '1,5', '', '64%Poliester -34%Algodon -2%Spandex ', '', '', 22233.8, '2026-01-22', 0, 13),
(591, 31, 'Genero 23  144 Hilos ', '2,5', '', '50% Poliester - 50% Algodón ', '', '', 17836.6, '2026-01-22', 0, 74),
(592, 31, 'Genero 66 144 Hilos  Solo Vende Rollos', '2,5', '', '50% Poliester - 50% Algodón', '', '', 12747.3, '2026-01-22', 0, 16),
(593, 31, 'Genero 44 144 Hilos  ', '2,4', '', '50% Poliester -  50% Algodón', '', '', 15743.1, '2026-01-22', 0, 44),
(594, 32, 'Impermeable Antimicrobial Vendaval Cloro Antimicrobial1.50', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(595, 32, 'Impermeable Orion Cloro Antimicrobial1.50', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(600, 33, 'Tela Bolsillo Negro Dajol Pc Chino ', '1,5', '', '80%Poliester -20% Algodón ', '', '', 0, '2026-01-30', 0, 16),
(602, 33, 'Tela Bolsillo Genero satinado Blanco y negro', '2.5', '250 Gr', '', '', '', 3865, '2026-02-25', 0, 1),
(603, 34, 'Tshirt Blanca  Solo Color Blanco', '', '', 'Algodón 100%', '', '', 8656.34, '2026-01-22', 0, 75),
(604, 34, 'Tshirt Mc', '', '', '', '', '', 17194.1, '2026-01-22', 0, 76),
(605, 34, 'Tshirt Mc Cuello Redondo Blanca', '', '', '', '', '', 12953.2, '2026-01-22', 0, 70),
(606, 34, 'Tshirt Mc Cuello Redondo Caballero Aritex Tallas S A Xl', '', '', '', '', '', 15743.1, '2026-01-22', 0, 77),
(607, 34, 'Tshirt Mc Cuello Redondo Color', '', '', '', '', '', 13950.4, '2026-01-22', 0, 70),
(608, 34, 'Tshirt Mc Cuello Redondo Dama Aritex Talla S A Xl', '', '', '', '', '', 16154.9, '2026-01-22', 0, 77),
(609, 34, 'Tshirt Mc Cuello V Blanca', '', '', '', '', '', 13152.7, '2026-01-22', 0, 70),
(610, 34, 'Tshirt Mc Cuellov Color', '', '', '', '', '', 14149.8, '2026-01-22', 0, 70),
(611, 34, 'Tshirt Ml Cuello Redondo Blanca', '', '', '', '', '', 15942.5, '2026-01-22', 0, 70),
(612, 34, 'Tshirt Ml Cuello Redondo Color', '', '', '', '', '', 16939.7, '2026-01-22', 0, 70),
(613, 34, 'Tshirt Ml', '', '', '', '', '', 19829.8, '2026-01-22', 0, 76),
(615, 28, 'OMEGA ', '1,8', '223 Gr', '100%poliester', '', '', 15415.4, '2026-01-22', 0, 14),
(616, 33, 'Tela Bolsillo ', '2,5', '', '', '', '', 0, '2026-01-30', 0, 16),
(617, 28, 'Pique Dornella Plus ', '1,8', '', '62% Poliester - 34% Algodón - 4% Spandex ', '', '', 18261.3, '2026-01-22', 0, 17),
(618, 4, 'Antifluido Repe Garnet1 T180 Estampada Negro Rayas base 22329 Stock 75115 Color 174405 ', '1.80', '', 'proceso digital  ', '', '', 34500, '2026-03-25', 0, 3),
(619, 1, 'Antifluido Repe Garnet1 T180 Estampada Negro Rayas base 22329 Stock 75115 Color 174405 ', '', '', '', '', '', 0, '2025-12-15', 0, 3),
(620, 17, 'Tela poliamida Nylon  Filamentos 100%   Tafetan 1*1 Liviano (Chaquetas Cortavientos)', '1,5', '76 Gr', '', '', '', 3785.94, '2026-01-22', 0, 1),
(621, 4, 'Tela Ref 25000 ', '1,58', '100 Gr', 'Poliester 80% Algodon 20% ', '', '', 9308.53, '2026-01-22', 0, 28),
(622, 26, 'Linoflex Ref 5001 Tela Pantalonera ', '1,5', '', '100% Poliester ', '', '', 9469.15, '2026-01-22', 0, 28),
(623, 12, 'Hawai ', '1,63', '7.3 oz ', '98% Algodon 2% Elastano ', '', '', 15652.6, '2026-01-22', 0, 57),
(624, 1, 'Antifluido Potenza ', '1,45', '160 Gr', '100% Poliester ', '', '', 12999, '2026-02-18', 0, 14),
(625, 5, 'Cotton Popelin 150 ', '1,5', '', 'algodon 97% spandex 3% ', '', '', 15296.8, '2026-01-22', 0, 14),
(626, 5, 'Camisero Stretch Popelin ', '1,45', '120 Gr', 'polyester 75% algodon 23% spandex 2% ', '', '', 19943, '2026-01-22', 0, 14),
(627, 4, 'Camisero Marmara', '1,6', '120', 'Pol-Alg 92-8 ', '', '', 23716, '2025-12-15', 0, 3),
(628, 1, 'Antifluido Cosmos Cloro Spirit ', '1,52', '148 Gr', '100% Polyester ', '', '', 11990, '2026-04-16', 0, 82),
(629, 26, 'Gabardina Garota ', '1,5', '175 Gr', '', '', '', 9357, '2026-03-26', 0, 2),
(630, 9, 'Montecatini ', '1,5', '', '100% Polyester ', '', '', 7400, '2026-03-27', 0, 16),
(631, 9, 'Megafil Sec  ', '1,6', '112 Gms', '100% Polyester ', '', '', 6272.88, '2026-01-22', 0, 17),
(632, 21, 'Indigo Nakan Tejido Plano', '1,6', '318.7', '69% Filamentos de Algodon 29% Filamento de polyester 2% spandex', '', '', 12550.1, '2026-01-22', 0, 83),
(633, 28, 'Coqui Útil', '1,7', '', '3,2 - 35 Polyester 65% Algodón', '3,2', '', 8648.79, '2026-01-22', 0, 84),
(634, 14, 'Franela Jersey Crear Franela Sahara', '1,6', '149 Gm', '65% Poliéster 35% Algodón', '', '', 7233.38, '2026-01-22', 0, 84),
(635, 14, 'Franela Jabón', '1,5', '', '91% Polyester 9% Spandex', '3,5', '', 7450.06, '2026-01-22', 0, 17),
(636, 14, 'Franela Keira', '0,6', '', '33% Algodón 61% Polyester 6%Spandex', '3,5', '', 10160.2, '2026-01-22', 0, 17),
(637, 9, 'Hidrotech  ', '1.50', '138', '100% Polyester', '', '', 18500, '2026-03-12', 0, 3),
(638, 27, 'Perchado Olimpica', '1,5', '213', '46.3% Poliéster 53.7%', '', '', 20244.8, '2026-01-22', 0, 16),
(639, 27, 'Perchado Seul', '1,47', '190', '52% poliéster 48% Algodón', '3,16', '', 18142.7, '2026-01-22', 0, 16),
(640, 17, 'Tela Nylon Azul Turqueza', '', '', '100% Poliester', '', '', 4582.58, '2026-01-22', 0, 85),
(641, 4, 'Saray', '1,45', '105 Gms', '100% Poliester', '', '', 19684.3, '2026-01-22', 0, 10),
(642, 4, 'Popelina Malta Tejido Plano', '1,5', '18 Gms', '65% Poliester 35% Algodón', '', '', 9367.82, '2026-01-22', 0, 16),
(643, 4, 'Tela mega oxford  Top  Fashion ', '1.50', '165', 'pol 50% alg 50%', '', '', 9800, '2026-04-18', 0, 35),
(644, 27, 'Perchado Loto', '1,5', '', '100% Poliester', '', '', 7707.7, '2026-01-22', 0, 16),
(645, 20, 'Indigo Tokio', '1,8', '12,5 onz', '', '', '', 13970.9, '2026-01-22', 0, 83),
(646, 21, 'Indigo nakano', '1,6', '', '2% spandex 69% Algodón 29% poliester', '', '', 12550.1, '2026-01-22', 0, 83),
(647, 12, 'Dril spandex', '', '', '', '', '', 19921.4, '2026-01-22', 0, 87),
(648, 14, 'Franela Sahara R/4.2', '1,6', '149', 'Poliester algodon', '', '', 31388.1, '2026-01-22', 0, 84),
(649, 1, 'Antifluido Pacific Unicolor', '1,49', '', 'Poliester 91% Lycra 9', '', '', 27219.5, '2025-12-15', 0, 3),
(650, 1, 'ANTIFLUIDO PACIFIC PLUS LAFAYETTE STOCK 37402 Color 194056 azul rey', '', '', '', '', '', 27219.5, '2025-12-15', 0, 3),
(651, 13, 'FORRO STRONG ', '', '', '100% POLIESTER', '', '', 3664.12, '2026-01-22', 0, 14),
(652, 13, 'FORRO COLOMBIA ', '', '', '100% POLIESTER', '', '', 6251.32, '2026-01-22', 0, 14),
(653, 25, 'Tela Pantalon Patagonia ', '1.45', '204', '100% Polyester', '', '', 21560, '2026-01-22', 0, 14),
(654, 23, 'MALLA CON ARRESTO AZUL OSCURO (AGENTE TRANSITO)', '', '', '', '', '', 5425.57, '2026-01-22', 0, 88),
(655, 4, 'HAIDEN 100% POLIESTER ANCHO 1.45', '', '', '', '', '', 18433.8, '2026-01-22', 0, 10),
(656, 4, 'Andes R Estampada  100% Pol  Reciclado', '', '', '', '', '', 26550.7, '2026-01-30', 0, 3),
(657, 26, 'Tela gabardina magenta ', '1.5', '', '', '', '', 12828.2, '2026-01-22', 0, 16),
(658, 12, 'Drill New York ', '1.60', '263 gr', '97.5% Algodon 2.5% Elastomero ', '', '', 22900.2, '2026-01-30', 0, 89),
(659, 12, 'Drill Escocia pluss St ', '1.60', '270', '97% Algodon  3% Spandex', '', '', 15900, '2026-03-26', 0, 89),
(660, 4, 'CHAMBRAY DAKOTA STRECH', '145', '160 gr ', '65% Rayon 32% Poliester 3% Spandex', '', '', 11319, '2026-01-22', 0, 48),
(661, 19, 'Indigo Chambray Dakota Stretch ', '145', '160', '65% Rayon 32%poliestes 3% Spandex ', '', '', 9990, '2026-03-24', 0, 48),
(662, 27, 'Microtitan Plus Unicolor ', '1.49', '168', '100% Polyester', '', '', 28351.4, '2025-12-15', 0, 3),
(663, 4, ' Camisera Monaco 1', '147', '105', 'Pol 60% Alg 40%', '', '', 12936, '2026-01-22', 0, 14),
(664, 26, 'GABARDINA TITAN ', '', '5.06 ONZ', '', '', '', 10456.6, '2026-01-22', 0, 9),
(665, 33, 'Tela bolsillo microfibra Icoltex', '2.5', '100 gr ', '100% Polyester', '', '', 0, '2026-01-30', 0, 4),
(666, 1, 'Antifluido Nautica ', '1.50', '', 'Poliester 100%', '', '', 8877.33, '2026-01-22', 0, 44),
(667, 27, 'Perchado Piel de Angel ', '1.50', '', '100% POLIESTER', '', '', 9058.43, '2026-01-22', 0, 23),
(668, 27, 'Tela peluche ', '1.90', '', '100% POLIESTER', '', '', 22556.1, '2026-01-22', 0, 4),
(669, 4, 'Tela Resort LC base 22319 stock 24186', '1.50', '143', '100% Polyester', '', '', 23123.1, '2025-12-15', 0, 3),
(670, 9, 'Malla deportiva lamega ', '1.60', '55', '100% Polyester', '', '', 2690, '2026-03-26', 0, 13),
(673, 18, 'Indigo Perseo', '1.80', ' 12 onzas', '48% Alg 37% pol 18% Rayon ', '', '', 11900, '2026-02-24', 0, 8),
(674, 18, 'Indigo Perseo', '1.80', ' 12 onzas', '48% Alg 37% pol 18% Rayon ', '', '', 12700, '2026-02-13', 0, 8),
(675, 18, 'Indigo Dakota', '1.72', '9 onzas', '75% alg 23%pol 2% spa ', '', '', 11900, '2026-02-13', 0, 8),
(676, 23, 'Malla Kayac', '', '', '', '', '', 4998.69, '2026-01-22', 0, 4),
(677, 27, 'Perchado olimpia', '', '', '', '', '', 11685, '2026-02-24', 0, 4),
(678, 27, 'Perchado Dinamico', '', '', '100% Poliester', '', '', 9000, '2026-02-26', 0, 8),
(679, 1, 'Antifluido Mykonos', '150', '157 mg', '100% pol mecanico strech ', '', '', 19849.2, '2026-01-22', 0, 4),
(680, 17, 'Tela reflectiva para cintas color gris plata', '1.50', '', '100% POLIESTER', '', '', 10924, '2026-03-17', 0, 1),
(681, 0, 'tela', 'ancho', 'peso', 'caracteristicas', 'rendimiento', 'encogimiento', 0, '2026-01-22', 0, 0),
(682, 0, 'tela', 'ancho', 'peso', 'caracteristicas', 'rendimiento', 'encogimiento', 0, '2026-01-22', 0, 0),
(683, 1, 'Antifluido Zeus ', '1.50', '122 gr ', '100% POLIESTER', '', '', 5063, '2026-01-26', 0, 8),
(684, 1, 'Antifluido London ', '1.50', '120 gr', '100% Poliester ', '', '', 8244, '2026-01-26', 0, 4),
(685, 28, 'Pique Atlanta ', '185', '', '100% POLIESTER  Microfibra ', '', '', 11390, '2026-01-30', 0, 82),
(686, 4, 'Zara Lycra', '151', '130', '75% alg 22%pol 3% spa ', '', '', 18500, '2026-01-30', 0, 3),
(687, 4, 'Camisero srtech popelin rayas', '1.50', '118gr', '75% alg 23%pol 2% spa ', '', '', 11999, '2026-01-30', 0, 14),
(688, 14, 'Lycra Power area piscinas ', '1.50', '196 gr', 'Nylon 80% Spandex 20%', '3.0 metros por kilo', '', 20269, '2026-02-02', 0, 13),
(689, 25, 'Pantalon Referencia Noches de Viena ', '1.50', '230 Gr', '95% pol 5% spandex ', '', '', 10840, '2026-02-03', 0, 4),
(690, 6, 'Popelina Rigida Leonesa  blanca', '1.60', '120 gr', 'Pol 66% 35%', '', '', 8990, '2026-03-17', 0, 13),
(691, 9, 'Tela camiseta Centauro ', '1.60', '', 'Algodon 93% Spandex 7%    precio kilo $38.990', '3.5 metros por kilo ', '', 11140, '2026-02-20', 0, 13),
(692, 12, 'Drill Smart cod004-0521', '145', '250 Gr', '34% alg 64% pol 2% elastomero', '', '', 12464, '2026-02-04', 0, 2),
(695, 4, 'Oxford camisero solo fondo  icoltex', '150', '170', '60% alg 40% pol', '', '', 9870, '2026-03-09', 0, 4),
(696, 9, 'Polo Shirt 0434 Seg Nac 100% pol 220 gr ', '1.80', '220', '100% POLIESTER', '', '', 12900, '2026-02-05', 0, 61),
(697, 9, 'Tela camiseta Poltex sec', '1.80', '210 Gr', '100% Poliester', '', '', 9290, '2026-02-19', 0, 13),
(698, 4, 'Tela camisera oxford160  ', '1.60', '150 Gr', 'Algodon 52% poliester 48%', '', '', 9990, '2026-02-09', 0, 13),
(699, 12, 'Tela Drill Magenta Strech  Fabricato', '1.61', '215gr', '46% polieter fibra 26% polfilmto 3% elastomero', '', '', 16900, '2026-02-09', 0, 23),
(700, 12, 'Tela drill lycrado Himalaya TopTex', '1.60', '260 Gr', '97% Alg 3% Lycra ', '', '', 14900, '2026-03-12', 0, 35),
(701, 23, 'Malla dunga sec cliente Suzuk ', '1.50', '135gr', '100% POLIESTER', '', '', 7771, '2026-02-12', 0, 12),
(702, 1, 'Tela antifluido Nilo ', '1.50', '120 gr', '100% POLIESTER', '', '', 5798, '2026-02-10', 0, 4),
(703, 30, 'Tela rib spring master', '1.40', '220 Gr', 'Poliester 65% Algodon 35%', '', '', 12990, '2026-03-20', 0, 13),
(704, 4, 'Camisero FlaFil  Tg Ancho 1,5', '1.50', '117', '65%Poliester-35%Algodon', '', '', 12900, '2026-03-17', 0, 2),
(705, 4, 'Tela microfibra160-00  con fondeo color especial cliente ', '1.50', '110 gr', '100% POLIESTER', '', '', 14000, '2026-02-16', 0, 14),
(706, 14, 'Tela Tubular codigo 10A1J12 S/46 M/48 L/52 XL/55 Tallas espec 2XL/60 3XL/63 ', '', '160 gr ', '100% Algodón', '', '', 5083, '2026-02-17', 0, 44),
(707, 21, 'Tela indigo Gorgona ', '1.70', '9 onzas', '70% Alg 28% Pol 2% Elastomero ', '', '', 11500, '2026-02-17', 0, 9),
(708, 4, 'Tela popelina milan ', '1.50', '115 Gr', '65%Poliester-35%Algodon', '', '', 6400, '2026-02-17', 0, 16),
(709, 18, 'Indigo Apolo 2 pago credito Ancho 1,70 Peso 12.5 Oz', '1.70', '12.5 Oz', '100 % Algodon', '', '', 11700, '2026-02-24', 0, 8),
(710, 23, 'Tela malla Valiana ', '1.50', '', '93% pol 7% spandex', '6 mtr', '', 7832, '2026-05-08', 0, 13),
(711, 14, 'Tela Amorela lycra ', '1.50', '', '87% POLIESTER 13% APANDEX', '4 metr', '', 8807, '2026-02-25', 0, 13),
(712, 4, 'Tela dacron Icoltex ', '1.50', '100 Gr', '90% pol 10% alg', '', '', 4363, '2026-02-25', 0, 4),
(713, 14, 'Tela franela jersey  Catalina ', '1.60', '150 Gr', '65%Poliester-35%Algodon', '4 mtr ', '', 6092, '2026-02-26', 0, 87),
(714, 8, 'Tela polar fleece ancho ancho1.60 Icoltex', '160', '', '100% POLIESTER', '2.8 metro', '', 7203, '2026-02-27', 0, 4),
(715, 17, 'Impermeable Celta Ancho 1,66', '1.66', '212gr', '100% Poliester ', '', '', 20650, '2026-03-03', 0, 3),
(716, 25, 'Tela lino superflex Continental De Textiles', '1.50', '110', '100% Poliester ', '', '', 4500, '2026-05-08', 0, 63),
(717, 14, 'Tela Lmedellin 160 Silk color medio', ' 1.60 Peso ', '150 Gr	', '', '', '', 7690, '2026-04-18', 0, 13),
(718, 17, 'Tela para tula Cerro Max  icoltex ', '1,5', '80 gr', '100% Poliester', '', '', 3732, '2026-03-11', 0, 4),
(719, 18, 'Tela indigo Zara blue ', '1.67', '356', '80%Pol -18% Algo 2% Spandex', '', '', 13500, '2026-03-12', 0, 62),
(720, 4, 'Tela oxford orleans ', '1.47', '135', '55% Algodón - 45%Poliester', '', '', 12600, '2026-03-12', 0, 14),
(721, 6, 'Popelina Rigida Leonesa colores varios', '1,5', '', '65%Poliester-35%Algodon', '', '', 10990, '2026-03-17', 0, 13),
(722, 6, 'Dacron hortencia icoltex', '1.50', '', '65% Poliester - 35%Algodon ', '', '', 4462, '2026-03-17', 0, 4),
(723, 9, 'Tela Jersey pelicano  AJTEX', '1.60', '201 gr', '85% pol 15% spandex', '3.1 metros  por kilo', '', 10645, '2026-03-20', 0, 73),
(724, 4, 'Camisero Veneta Plus con descuento 5% lafa 10% cliente ', '1.53', '', '100% POLIESTER', '', '', 21460, '2026-03-24', 0, 3),
(725, 23, 'Malla Megafil sec multiusos 1.60 Peso 112gr colores base blanco negro azul osc', '1.60', '112 gr', '100% Polyester', '', '', 5290, '2026-03-30', 0, 13),
(726, 14, 'Franela Algodon pant materno ', '1.50', '110 gr', '100% Algodón', '', '', 6722, '2026-04-09', 0, 72),
(727, 14, 'Franela Brazilia  100% Algodon ', '1.55', '155 gr', '100% Algodón', '', '', 9990, '2026-04-15', 0, 13),
(728, 21, 'Indigo Zara blue 3204 Grupo Surtitex', '167', '381', '80% alg -18% pol 2% spandex', '', '', 12500, '2026-04-18', 0, 78),
(729, 6, 'Tela Dacron S/F Continental de textiles ', '1.50', '107', '94% pol 6% alg ', '', '', 5116, '2026-04-18', 0, 63),
(730, 23, 'Tela Malla lamega', '1.60', '55 gr', '100% Polyester', '', '', 2690, '2026-04-18', 0, 13),
(731, 14, 'Tela Lmedellin 160 Silk color claro ', '1.60', '150 Gr', '65%Poliester-35%Algodon', '', '', 6690, '2026-04-18', 0, 13),
(732, 14, 'Tela Lmedellin 160 Silk color oscuro ', '1.60', '150 Gr', '65%Poliester-35%Algodon', '', '', 7990, '2026-04-18', 0, 13),
(733, 23, 'Malla Dinamica  liviana Pol-Spa', '1.50', '111 gr', '92% pol 8% spandex', '', '', 6990, '2026-04-24', 0, 13),
(734, 10, 'Tela Drill TC Twill S/F Continental textiles', '1.50', '208', 'Poliester 85% Algodon 15%', '', '', 8231, '2026-05-11', 0, 63),
(735, 11, 'Tela Drill Thor Tramas ', '1.60', '255', '100 % Algodon', '', '', 10516, '2026-05-11', 0, 9),
(736, 4, 'Tela Popelina caobo PC John Uribe  ', '1.48', '103', '65% Poliester - 35%Algodon ', '', '', 6798, '2026-05-19', 0, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_insumo`
--

CREATE TABLE `tipo_insumo` (
  `id_tipoinsumo` int(11) NOT NULL,
  `tipo_insumo` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_insumo`
--

INSERT INTO `tipo_insumo` (`id_tipoinsumo`, `tipo_insumo`, `nombre`) VALUES
(1, 'bolsa', 'Bolsa'),
(2, 'boton', 'Botón'),
(3, 'broche', 'Broche'),
(4, 'cinta_faya', 'Cinta Faya'),
(5, 'cinta_reflectiva', 'Cinta Reflectiva'),
(6, 'cordon', 'Cordon'),
(7, 'cremallera', 'Cremallera'),
(8, 'cuello', 'Cuello'),
(9, 'deslizador', 'Deslizador'),
(10, 'entretela', 'Entretela'),
(11, 'fusionado', 'Fusionado'),
(12, 'guata', 'Guata'),
(13, 'hiladilla', 'Hiladilla'),
(14, 'hombrera', 'Hombreras'),
(16, 'marquilla', 'Marquilla'),
(17, 'plumilla', 'Plumilla'),
(18, 'pretina', 'Pretina'),
(19, 'puntera', 'Puntera'),
(20, 'puño', 'Puño'),
(21, 'resorte', 'Resorte'),
(22, 'sesgo', 'Sesgo'),
(23, 'trabilla', 'Trabilla'),
(24, 'velcro', 'Velcro'),
(25, 'vinilo', 'Vinilo'),
(26, 'vivo', 'Vivo'),
(27, 'fajon_cintura', 'Fajon en Cintura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_logo`
--

CREATE TABLE `tipo_logo` (
  `id_tipo_logo` int(11) NOT NULL,
  `tipo_logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_logo`
--

INSERT INTO `tipo_logo` (`id_tipo_logo`, `tipo_logo`) VALUES
(1, 'Sin Logo'),
(2, 'Logo Bordado'),
(3, 'Logo Estampado'),
(4, 'Logo Subliminado'),
(5, 'Logo Bordado y Estampado'),
(6, 'Logo Bordado y Subliminado'),
(7, 'Logo Estampado y Subliminado'),
(8, 'Logo Bordado, Estampado y Subliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_prenda`
--

CREATE TABLE `tipo_prenda` (
  `id_tipo_prenda` int(11) NOT NULL,
  `tipo_prenda` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_prenda`
--

INSERT INTO `tipo_prenda` (`id_tipo_prenda`, `tipo_prenda`) VALUES
(0, 'Prenda Comprada a Externos'),
(1, 'Superior Hombre'),
(2, 'Superior Mujer'),
(3, 'Inferior Hombre'),
(4, 'Inferior Mujer'),
(5, 'Chaqueta'),
(6, 'Overol'),
(7, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL,
  `tipo_producto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo_producto`, `tipo_producto`) VALUES
(1, 'Superior Hombre'),
(2, 'Superior Mujer'),
(3, 'Inferior Hombre'),
(4, 'Inferior Mujer'),
(5, 'Chaqueta'),
(6, 'Overol'),
(7, 'Otros'),
(8, 'Prenda Comprada a Externos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_tela`
--

CREATE TABLE `tipo_tela` (
  `id_tipo_tela` int(11) NOT NULL,
  `tipo_tela` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_tela`
--

INSERT INTO `tipo_tela` (`id_tipo_tela`, `tipo_tela`) VALUES
(0, 'No Aplica'),
(1, 'Antifluidos'),
(2, 'Burdas'),
(3, 'Camisa Confeccionada'),
(4, 'Camisera'),
(5, 'Camisera Strech'),
(6, 'Camisero Dacron'),
(7, 'Conjuntos Impermeables Para Moto'),
(8, 'Cuartos Frios - Fleece'),
(9, 'Deportiva'),
(10, 'Dril Liviano'),
(11, 'Dril Pesado'),
(12, 'Dril Spandex '),
(13, 'Forro'),
(14, 'Franela Jersey'),
(15, 'Gorras'),
(16, 'Ignifugas'),
(17, 'Impermeable'),
(18, 'Indigo'),
(19, 'Indigo Camisero'),
(20, 'Indigo Pesado'),
(21, 'Indigo Spandex'),
(22, 'Jeans Comprados'),
(23, 'Malla'),
(24, 'Militar'),
(25, 'Pantalon'),
(26, 'Pantalon Gabardina'),
(27, 'Perchados'),
(28, 'Pique'),
(29, 'Polos Y Tshirt Ya Confeccionadas'),
(30, 'Rib'),
(31, 'Sabanas'),
(32, 'Salud'),
(33, 'Tela Bolsillo'),
(34, 'Tshirt Confeccionadas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_visita`
--

CREATE TABLE `tipo_visita` (
  `id_tipo_visita` int(11) NOT NULL,
  `tipo_visita` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_visita`
--

INSERT INTO `tipo_visita` (`id_tipo_visita`, `tipo_visita`) VALUES
(0, 'Seleccione una opción'),
(1, 'Por primera vez'),
(2, 'Nueva propuesta'),
(3, 'Post. venta'),
(4, 'Seguimiento'),
(5, 'Mantenimiento'),
(6, 'Reclamaciones'),
(7, 'Cobro de cartera'),
(8, 'Toma de pedido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabilla`
--

CREATE TABLE `trabilla` (
  `id_trabilla` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `trabilla`
--

INSERT INTO `trabilla` (`id_trabilla`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 23),
(1, 'Trabilla Metalica', 'unidad', 138.6, '2025-01-24', 0, 8, 23),
(2, 'Trabilla Plastica', 'unidad', 29.7, '2025-01-24', 0, 5, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `encargado` varchar(100) DEFAULT NULL,
  `rol` varchar(30) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `pass` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `encargado`, `rol`, `user`, `pass`) VALUES
(1, 'Carolina García Gómez', 'comercial', 'comercial@unidotacionesdeleje.com', '12345'),
(2, 'Juan Camilo Gallego', 'comercial2', 'comercial2@unidotacionesdeleje.com', '12345'),
(3, 'Xiomara Tabares', 'comercial3', 'comercial3@unidotacionesdeleje.com', '12345'),
(4, '', 'costeo', 'costeo@unidotacionesdeleje.com', '12345'),
(5, '', 'diseño', 'diseño@unidotacionesdeleje.com', '12345'),
(6, NULL, 'trazo', 'trazo@unidotacionesdeleje.com', '12345'),
(7, '', 'compras', 'compras@unidotacionesdeleje.com', '12345'),
(8, '', 'produccion', 'produccion@unidotacionesdeleje.com', '12345'),
(9, 'Deisy Liliana Bermudez', 'comercial4', 'comercial4@unidotacionesdeleje.com', '12345'),
(10, NULL, 'inventario', 'inventario@unidotacionesdeleje.com', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `velcro`
--

CREATE TABLE `velcro` (
  `id_velcro` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `velcro`
--

INSERT INTO `velcro` (`id_velcro`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 24),
(1, 'Velcro Beige 2,5 Por Metro Seguridad Nal', 'metro', 850, '2026-02-16', 0, 5, 24),
(3, 'Velcro Negro2,5 Por Metro', 'metro', 538, '2026-04-18', 0, 50, 24),
(7, 'Velcro 5 cms ancho ', 'metro', 1134, '2026-02-16', 0, 5, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinilo`
--

CREATE TABLE `vinilo` (
  `id_vinilo` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vinilo`
--

INSERT INTO `vinilo` (`id_vinilo`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, NULL, 0, 0, 25),
(1, 'Vinilo', 'metro', 900, '2026-05-05', 0, 1, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `id_visita` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nit` int(11) NOT NULL,
  `id_tipo_visita` int(11) DEFAULT NULL,
  `fecha_visita` datetime NOT NULL,
  `descripcion_visita` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visita`
--

INSERT INTO `visita` (`id_visita`, `id_usuario`, `nit`, `id_tipo_visita`, `fecha_visita`, `descripcion_visita`) VALUES
(6, 5, 1, 4, '2024-07-24 08:13:36', 'el cliente pide cotización '),
(7, 5, 1, 2, '2024-07-31 11:56:43', 'otra cotizacion'),
(8, 1, 4, 2, '2024-08-05 09:52:57', 'Ofrecer dotación \r\n16 hombres operativos\r\n4 adm hombres\r\n5 mujeres adm\r\nEntrega 3 und por persona'),
(9, 5, 3, 2, '2024-08-06 11:07:45', 'ya se le había hecho cotización pero me pidió nuevamente cotizar unas prendas '),
(10, 5, 5, 1, '2024-08-06 11:38:55', 'cliente al cual le envié correo. Nos reunimos atraves de meet y solicitó cotización '),
(11, 1, 2, 2, '2024-08-06 13:09:37', 'El cliente requiere cotización con propuesta de diseño, debe tener la tela 60% algodón 40 poli, algo muy parecido buscan telas frescas. \r\nSon 18 personas : Mujeres 12\r\n                                 Hombres 6'),
(12, 5, 6, 2, '2024-08-09 08:36:22', 'solicitud de cotización atraves correo y otra información por medio del whatsapp '),
(13, 1, 7, 1, '2024-08-12 13:55:01', 'Camisa, pantalón corbatas y botas sin puntera \r\nCamisa Dacron otra alternativa económica, pantalón linoflex y drill con spandex , tennis cueros y botas sin puntera enviar fotos, \r\n2 mujeres \r\n10 hombres '),
(14, 1, 8, 2, '2024-08-13 14:16:24', 'Enviar cotización de tennis en cuero cocidos'),
(16, 5, 9, 1, '2024-08-16 08:32:32', 'La auxiliar administrativa esta interesada en hacer la dotación con nosotros pero solo van hacer una prueba con solo 20 prendas y si el resultado es positivo ya el proceso lo haríamos completamente. y serian mas de 60 prendas para confeccionar '),
(17, 5, 10, 1, '2024-08-16 09:30:33', 'solicito cotización '),
(18, 5, 11, 1, '2024-08-16 14:14:52', 'el cliente solicito cotización y agendar nuevamente una reunión para ya tomar decisiones '),
(19, 5, 12, 2, '2024-08-20 15:27:20', 'cotizacion'),
(20, 5, 13, 1, '2024-08-22 09:47:04', 'solicita cotización'),
(21, 5, 14, 1, '2024-08-23 08:40:35', 'el cliente necesita empezar el proceso ya que la entrega es a inicio de año... aun no se  hace cotización '),
(22, 5, 15, 2, '2024-08-26 15:41:33', 'solicita cotizacion '),
(23, 5, 16, 2, '2024-08-27 14:14:15', 'pide cotizacion '),
(24, 5, 17, 1, '2024-08-29 14:59:34', 'solicita cotización \r\n'),
(25, 5, 18, 2, '2024-08-30 14:24:34', 'solicitó cotización '),
(26, 5, 19, 3, '2024-09-03 12:35:45', 'Se crea cliente antiguo para procesar pedido (Marianella)'),
(27, 1, 20, 3, '2024-09-03 14:35:38', 'Se crea cliente antiguo para generar pedido - mariannella'),
(29, 1, 22, 4, '2024-09-04 09:39:46', 'se crea cliente antiguo para procesar pedido Mariannella'),
(30, 1, 23, 4, '2024-09-04 09:51:50', 'se crea cliente antiguo para procesar pedido Mariannella'),
(31, 1, 24, 1, '2024-09-05 10:56:08', 'estamos creando una prueba'),
(32, 5, 25, 1, '2024-09-06 10:22:18', 'solicito cotización '),
(33, 5, 26, 1, '2024-09-06 14:20:18', 'solicito cotización '),
(34, 5, 27, 1, '2024-09-06 15:09:40', 'solicito cotización '),
(35, 1, 28, 3, '2024-09-09 08:09:57', 'se crea cliente antiguo para cargar pedido Mariannella'),
(36, 5, 29, 1, '2024-09-10 09:44:29', 'solicito cotizacion'),
(37, 1, 30, 4, '2024-09-10 15:44:41', 'Se crea cliente antiguo para procesar pedido Mariannella'),
(38, 1, 31, 4, '2024-09-11 15:52:22', 'se crea cliente para montar pedido Mariannella'),
(39, 5, 32, 1, '2024-09-11 16:47:22', 'solicito cotizacion '),
(40, 1, 33, 4, '2024-09-16 15:03:26', 'se crea cliente para gestionar cotizacion para pedido- Mariannella'),
(41, 1, 34, 4, '2024-09-18 09:28:21', 'se crea cliente antiguo para cargar pedido - Mariannella'),
(42, 5, 35, 1, '2024-09-19 08:44:06', 'solicito cotización \r\n'),
(43, 1, 36, 1, '2024-09-25 10:15:41', 'El CLIENTE GENERA LICITACION EN OCTUBRE Y SOLICITA UN COTIZACION PARA 20000 UNIDADES '),
(49, 1, 42, 1, '2024-09-26 15:11:44', 'Iniciar proceso de contacto '),
(53, 1, 46, 1, '2024-09-26 17:23:49', 'thhhghhhfghhh'),
(54, 1, 47, 1, '2024-09-27 07:58:59', 'pendiente iniciar primer contacto '),
(55, 1, 48, 1, '2024-09-27 08:35:40', 'Pendiente iniciar proceso comercial '),
(56, 1, 49, 1, '2024-09-27 09:02:12', 'Pendiente iniciar proceso comercial'),
(57, 1, 50, 1, '2024-09-27 09:31:47', 'Pendiente por iniciar proceso comercial '),
(58, 1, 51, 1, '2024-09-27 09:39:14', 'Pendiente iniciar proceso comercial '),
(59, 1, 52, 1, '2024-09-27 09:49:22', 'Pendiente iniciar proceso comercial '),
(60, 1, 53, 1, '2024-09-27 10:13:04', 'Pendiente iniciar proceso comercial'),
(61, 1, 54, 1, '2024-09-27 10:21:42', 'Pendiente iniciar proceso comercial '),
(62, 1, 55, 1, '2024-09-27 10:45:23', 'Pendiente Iniciar proceso comercial '),
(63, 1, 56, 1, '2024-09-27 14:23:23', 'Iniciar proceso por area comercial '),
(64, 1, 57, 1, '2024-09-27 14:55:32', 'Pendiente iniciar proceso por area comercial '),
(65, 1, 58, 1, '2024-09-27 15:03:17', 'Pendiente iniciar proceso por area comercial'),
(66, 1, 59, 1, '2024-09-27 15:15:03', 'Pendiente iniciar proceso area comercial '),
(67, 1, 60, 1, '2024-09-27 15:25:08', 'iniciar proceso area comercial '),
(68, 1, 61, 1, '2024-09-27 15:55:03', 'Pendiente iniciar proceso por area comercial'),
(69, 1, 62, 1, '2024-09-27 16:03:13', 'Pendiente iniciar proceso area comercial '),
(70, 1, 63, 1, '2024-09-27 16:10:46', 'Pendiente iniciar proceso area comercial '),
(71, 1, 64, 1, '2024-09-27 16:33:01', 'Pendiente iniciar proceso area de ventas '),
(72, 1, 65, 1, '2024-09-27 17:05:36', 'Pendiente iniciar proceso area comercial'),
(73, 1, 66, 1, '2024-09-27 17:24:22', 'Pendiente iniciar proceso area comercial'),
(74, 1, 67, 1, '2024-09-27 17:51:21', 'Pendiente inicio proceso area comercial '),
(75, 1, 68, 1, '2024-09-27 18:32:30', 'Pendiente proceso area comercial '),
(76, 1, 69, 1, '2024-09-27 18:57:17', 'Pendiente iniciar proceso por area comercial '),
(77, 1, 70, 1, '2024-09-27 19:07:16', 'Pendiente iniciar proceso area de ventas '),
(78, 1, 71, 1, '2024-09-27 19:43:33', 'Pendiente proceso area de ventas'),
(79, 1, 72, 1, '2024-09-27 19:59:06', 'Pendiente proceso por area comercial '),
(80, 1, 73, 1, '2024-09-27 21:12:35', 'Pendiente proceso por area comercial '),
(81, 1, 74, 1, '2024-09-28 13:53:11', 'Pendiente iniciar proceso area comercial'),
(82, 1, 75, 1, '2024-09-28 14:13:16', 'Pendiente iniciar gestion por area comercial'),
(83, 1, 76, 1, '2024-09-28 14:30:09', 'Pendiente gestion por area comercial'),
(84, 1, 77, 1, '2024-09-28 14:36:04', 'Pendiente inicio por area comercial'),
(85, 1, 78, 1, '2024-09-28 14:57:15', 'pendiente iniciar proceso por area comercial'),
(86, 1, 79, 1, '2024-09-28 15:51:53', 'Pendiente gestion por area comercial'),
(87, 1, 80, 1, '2024-09-28 15:56:54', 'Pendiente iniciar gestion area comercial'),
(88, 1, 81, 1, '2024-09-28 16:16:45', 'Pendiente inicio gestion area comercial'),
(89, 1, 82, 2, '2024-09-28 16:23:45', 'Pendiente iniciar gestion area comercial'),
(90, 1, 83, 1, '2024-09-28 16:32:24', 'Pendiente iniciar gestion area comercial '),
(91, 1, 84, 1, '2024-09-29 14:32:35', 'Pendiente inicio de labor por area comercial '),
(92, 1, 85, 1, '2024-09-29 14:38:31', 'Pendiente iniciar proceso por area comercial '),
(93, 1, 86, 1, '2024-09-29 14:44:28', 'Pendiente iniciar proceso por area comercial '),
(94, 1, 87, 1, '2024-09-29 15:11:12', 'Pendiente Inicio de gestion por area comercial'),
(95, 1, 88, 1, '2024-09-29 15:49:23', 'Pendiente Inicio gestion por area comercial '),
(96, 1, 89, 1, '2024-09-29 15:54:54', 'Pendiente proceso por area comercial '),
(97, 1, 90, 1, '2024-09-29 15:59:27', 'Pendiente iniciar proceso por area comercial '),
(98, 1, 91, 1, '2024-09-29 16:08:41', 'Pendiente inicio de proceso por area comercial'),
(99, 1, 92, 1, '2024-09-29 16:42:05', 'Pendiente inicio de gestion por area comercial '),
(100, 1, 93, 1, '2024-09-29 16:50:10', 'Pendiente inicio de gestion por area comercial '),
(101, 1, 94, 1, '2024-09-29 17:00:50', 'Pendiente Inicio de gestion comercial'),
(102, 1, 95, 1, '2024-09-29 17:14:35', 'Pendiente inicio de gestion por area comercial'),
(103, 1, 96, 1, '2024-09-29 17:29:34', 'Pendiente inicio de area comercial'),
(104, 1, 97, 1, '2024-09-29 17:45:58', 'Pendiente iniciar proceso por area comercial'),
(105, 1, 98, 1, '2024-10-01 14:09:34', 'La dotación se debe entregar en la dirección> Cra. 27 No 10 / 02 Barrio Alamos Edificio 1 Piso 0 Mariana Bedoya Gestora de COmpras Tel 3137262 / 3137263 ext 7262 horario para entrega de 8 am a 11.30 am'),
(106, 1, 99, 1, '2024-10-02 08:10:15', 'Pendiente iniciar proceso por area comercial'),
(107, 1, 100, 1, '2024-10-02 08:15:49', 'Pendiente iniciar proceso por area comercial '),
(108, 1, 101, 1, '2024-10-02 08:22:29', 'Pendiente iniciar proceso por area comercial'),
(109, 1, 102, 1, '2024-10-02 08:45:42', 'pendiente inicio de gestion por area comercial'),
(110, 1, 103, 1, '2024-10-02 08:50:33', 'Pendiente inicio de gestion por area comercial '),
(111, 1, 104, 1, '2024-10-02 09:03:20', 'Pendiente inicio gestion por area comercial '),
(112, 1, 105, 1, '2024-10-02 09:07:40', 'Pendiente inicio de gestion por area comercial'),
(113, 1, 106, 1, '2024-10-02 09:13:35', 'Pendiente inicio de gestion por area comercial'),
(114, 1, 107, 1, '2024-10-02 09:21:21', 'Pendiente inicio de gestion por area comercial '),
(115, 1, 108, 1, '2024-10-02 09:35:56', 'Pendiente inicio de gestion por area comercial '),
(116, 1, 109, 1, '2024-10-02 09:42:34', 'Pendiente inicio de gestion por area comercial '),
(117, 1, 110, 1, '2024-10-02 09:57:28', 'Pendiente inicio de gestion por area comercial'),
(118, 1, 111, 1, '2024-10-02 10:00:55', 'Pendiente inicio de gestion por area comercial'),
(119, 1, 112, 1, '2024-10-02 10:13:12', 'Pendiente inicio de gestion por area comercial '),
(120, 1, 113, 1, '2024-10-02 10:17:42', 'Pendiente inicio de gestion por area comercial'),
(121, 1, 114, 1, '2024-10-02 14:31:16', 'Pendiente iniciar proceso por area comercial'),
(122, 1, 115, 1, '2024-10-02 14:39:08', 'Pendiente iniciar proceso por area comercial'),
(123, 1, 116, 1, '2024-10-02 14:43:12', 'Pendiente iniciar proceso area comercial'),
(124, 1, 117, 1, '2024-10-02 14:56:42', 'Pendiente iniciar proceso con area comercial '),
(125, 1, 118, 1, '2024-10-02 15:02:31', 'Pendiente iniciar proceso por area comercial'),
(126, 1, 119, 1, '2024-10-02 15:18:41', 'Pendiente Iniciar gestion por area comercial '),
(127, 1, 120, 1, '2024-10-02 15:28:06', 'Pendiente iniciar gestion area comercial'),
(128, 1, 121, 1, '2024-10-02 15:33:57', 'Pendiente iniciar proceso por area comercial'),
(129, 1, 122, 1, '2024-10-02 15:41:38', 'Pendiente iniciar gestion por area comercial '),
(130, 1, 123, 1, '2024-10-02 15:53:19', 'Pendiente iniciar gestion area comercial'),
(131, 1, 124, 1, '2024-10-02 16:06:24', 'Pendiente iniciar gestion area comercial '),
(132, 1, 125, 1, '2024-10-02 16:12:05', 'Pendiente Iniciar proceso area comercial'),
(133, 1, 126, 1, '2024-10-02 16:16:05', 'pendiente iniciar proceso por area comercial'),
(134, 1, 127, 1, '2024-10-02 16:21:16', 'Pendiente iniciar gestion por area comercial'),
(135, 1, 128, 1, '2024-10-02 16:29:37', 'Pendiente inicio de actividad por gestion comercial'),
(136, 1, 129, 1, '2024-10-02 17:20:33', 'Pendiente gestion por area comercial'),
(137, 1, 130, 1, '2024-10-02 17:25:03', 'Pendiente inicio de gestion por area comercial'),
(138, 1, 131, 1, '2024-10-02 17:32:39', 'Pendiente inicio gestion por area comercial'),
(139, 1, 132, 1, '2024-10-02 17:49:35', 'Pendiente inicio de gestion area comercial'),
(140, 1, 133, 1, '2024-10-02 17:58:59', 'Pendiente inicio gestion por area comercial'),
(141, 1, 134, 1, '2024-10-02 18:03:54', 'Pendiente gestion por area comercial'),
(142, 1, 135, 2, '2024-10-02 18:08:11', 'Entrega dotacion año 2025: 10 abril, 10 agosto y 20 diciembre\r\ncontacto Vanessa Alvarez Jefe Administrativa correo vanessa.alvarez@vehicafe.com.co'),
(143, 1, 136, 1, '2024-10-02 18:12:50', 'Pendiente iniciar gestion por area comercial'),
(144, 1, 137, 1, '2024-10-02 18:27:59', 'Pendiente inicio de gestion por area comercial'),
(145, 1, 138, 1, '2024-10-02 19:00:53', 'Pendiente iniciar proceso por area comercial'),
(146, 1, 139, 1, '2024-10-02 19:05:12', 'Pendiente iniciar gestion comercial'),
(147, 1, 140, 1, '2024-10-03 03:52:04', 'Pendiente iniciar proceso por area comercial'),
(148, 1, 141, 1, '2024-10-03 03:59:06', 'Pendiente inicio de gestion por area comercial'),
(149, 1, 142, 1, '2024-10-03 04:03:51', 'Pendiente inicio de gestion por area comercial'),
(150, 1, 143, 1, '2024-10-03 04:09:19', 'Pendiente inicio de gestion por area comercial'),
(151, 1, 144, 1, '2024-10-03 04:13:22', 'Pendiente inicio de gestion por area comercial'),
(152, 1, 145, 1, '2024-10-03 04:17:03', 'Pendiente inicio de gestion por area comercial'),
(153, 1, 146, 1, '2024-10-03 04:27:39', 'Pendiente iniciar proceso por area comercial '),
(154, 1, 147, 1, '2024-10-03 04:35:29', 'Pendiente inicio de gestion por area comercial '),
(155, 1, 148, 1, '2024-10-03 04:51:23', 'Pendiente inicio de gestion por area comercial'),
(156, 1, 149, 1, '2024-10-03 04:56:46', 'pendiente inicio de gestion por area comercial '),
(157, 1, 150, 1, '2024-10-03 05:20:26', 'Pendiente iniciar gestion por area comercial'),
(158, 1, 151, 1, '2024-10-03 05:26:50', 'Pendiente iniciar gestion por area comercial'),
(159, 1, 152, 1, '2024-10-03 05:39:47', 'Pendiente iniciar proceso por area comercial'),
(160, 1, 153, 1, '2024-10-03 05:46:51', 'Pendiente inicio de gestion por area comercial '),
(161, 1, 154, 1, '2024-10-03 05:54:08', 'Pendiente inicio de gestion por area comercial'),
(162, 1, 155, 1, '2024-10-03 06:00:58', 'pendiente inicio de gestion por area comercial'),
(163, 1, 156, 1, '2024-10-03 12:57:01', 'Pendiente inicio de gestion por area comercial'),
(164, 1, 157, 1, '2024-10-03 13:02:11', 'Pendiente iniciar gestion por area comercial '),
(165, 1, 158, 1, '2024-10-03 13:07:04', 'Pendiente inicio de gestion por area comercial'),
(166, 1, 159, 1, '2024-10-03 13:11:37', 'Pendiente inicio de gestion por area comercial'),
(167, 1, 160, 1, '2024-10-03 13:16:20', 'Pendiente inicio de gestion por area comercial'),
(168, 1, 161, 1, '2024-10-03 13:26:07', 'Pendiente iniciar proceso por area comercial '),
(169, 1, 162, 1, '2024-10-03 13:40:26', 'Pendiente inciar gestion por area comercial'),
(170, 1, 163, 1, '2024-10-03 13:45:01', 'Pendiente iniciar gestion por area comercial'),
(171, 1, 164, 1, '2024-10-03 13:50:57', 'Pendiente iniciar gestion por area comercial'),
(172, 1, 165, 1, '2024-10-03 14:35:28', 'Pendiente inicio de gestion por area comercial'),
(173, 1, 166, 1, '2024-10-03 15:15:44', 'Pendiente iniciar proceso por area comercial'),
(174, 1, 167, 1, '2024-10-03 15:20:31', 'Pendiente inicio de gestion por area comercial'),
(175, 1, 168, 1, '2024-10-03 15:29:51', 'Pendiente iniciar gestion por area comercial'),
(176, 1, 169, 1, '2024-10-03 15:36:51', 'Pendiente iniciar gestion por area comercial '),
(177, 1, 170, 1, '2024-10-03 15:50:50', 'Pendiente inicio de gestion por area comercial '),
(178, 1, 171, 1, '2024-10-05 14:08:49', 'pendiente inicio de gestion comercial'),
(179, 1, 172, 1, '2024-10-05 14:22:50', 'Pendiente inicio de gestion por area comercial '),
(180, 1, 173, 1, '2024-10-05 14:27:16', 'Pendiente inicio de gestion por area comercial '),
(181, 1, 174, 1, '2024-10-05 14:34:08', 'Pendiente inicio de gestion por area comercial'),
(182, 1, 175, 1, '2024-10-05 14:41:00', 'Pendiente inicio de gestion por area comercial '),
(183, 1, 176, 1, '2024-10-05 14:47:27', 'Pendiente inicio de gestion por area comercial '),
(184, 1, 177, 1, '2024-10-05 15:02:03', 'Pendiente iniciar proceso por area comercial '),
(185, 1, 178, 1, '2024-10-05 15:09:22', 'Pendiente iniciar proceso por area comercial '),
(186, 1, 179, 1, '2024-10-05 15:24:02', 'Pendiente inicio de gestion por area comercial '),
(187, 1, 180, 1, '2024-10-05 15:29:21', 'pendiente inicio de gestion por area comercial'),
(188, 1, 181, 1, '2024-10-05 15:35:13', 'Pendiente inicio de gestion por area comercial '),
(189, 1, 182, 1, '2024-10-05 15:44:24', 'Pendiente inicio de gestion por area comercial '),
(190, 1, 183, 1, '2024-10-05 15:52:39', 'Pendiente inicio de gestion de gestion area comercial'),
(191, 1, 184, 1, '2024-10-05 15:59:06', 'Pendiente inicio de gestion por area comercial'),
(192, 1, 185, 1, '2024-10-05 16:03:29', 'Pendiente inicio de gestion por area comercal '),
(193, 1, 186, 1, '2024-10-05 16:12:46', 'Pendiente inicio de gestion poe area comercial '),
(194, 1, 187, 1, '2024-10-05 16:18:40', 'Pendiente inicio de gestion por area comercial '),
(195, 1, 188, 1, '2024-10-05 16:27:00', 'Pendiente inicio de gestion por area comercial '),
(196, 1, 189, 1, '2024-10-05 16:33:36', 'Pendiente iniciar gestion por area comercial'),
(197, 1, 190, 1, '2024-10-05 16:56:43', 'Pendiente inicio de gestion por area comercial '),
(198, 1, 191, 1, '2024-10-05 18:11:30', 'Pendiente inicio de gestion por area comercial '),
(199, 1, 192, 1, '2024-10-05 18:18:14', 'Pendiente inicio de gestion por area comercial '),
(200, 1, 193, 1, '2024-10-05 18:25:12', 'Pendiente iniciar gestion por area comercial'),
(201, 1, 194, 1, '2024-10-05 18:30:50', 'Pendiente inicio de gestion por area comercial'),
(202, 1, 195, 1, '2024-10-05 18:40:44', 'pendiente inicio de gestion area comercial '),
(203, 1, 196, 1, '2024-10-05 18:47:31', 'Pendiente inicio de gestion comercial'),
(204, 1, 197, 1, '2024-10-05 18:53:19', 'Pendiente iniciar proceso con area comercial '),
(205, 1, 198, 1, '2024-10-05 19:58:37', 'Pendiente iniciar proceso por area comercial'),
(206, 1, 199, 1, '2024-10-05 20:07:37', 'Pendiente inicio de gestion por area comercial '),
(207, 1, 200, 1, '2024-10-05 20:19:59', 'Pendiente iniciar proceso por area comercial '),
(208, 1, 201, 1, '2024-10-05 20:28:59', 'Pendiente inicio de gestion por area comercial '),
(209, 1, 202, 1, '2024-10-06 11:14:50', 'Pendiente inicio de gestion por area comercial'),
(210, 1, 203, 1, '2024-10-06 11:26:49', 'Pendiente inicio de gestion por area comercial'),
(211, 1, 206, 1, '2024-10-06 12:02:07', 'Pendiente inicio de gestion por area comercial '),
(212, 1, 207, 1, '2024-10-06 12:06:33', 'Pendiente inicio de gestion por area comercial '),
(213, 1, 208, 1, '2024-10-06 12:12:37', 'pendiente inicio de gestion por area comercial'),
(214, 1, 209, 1, '2024-10-06 12:18:21', 'Pendiente inicio de gestion por area comercial '),
(215, 1, 210, 1, '2024-10-06 12:23:54', 'Pendiente inicio de gestion por area comercial '),
(216, 1, 211, 1, '2024-10-06 12:30:57', 'Pendiente inicio de gestion por area comercial'),
(217, 1, 212, 1, '2024-10-06 12:38:05', 'Pendiente inicio de gestion por area comercial '),
(218, 1, 213, 1, '2024-10-06 12:42:12', 'Pendiente inicio de gestion por area comercial '),
(219, 1, 214, 1, '2024-10-06 12:52:58', 'Pendiente inicio de gestion por area comercial '),
(220, 1, 215, 1, '2024-10-06 15:20:25', 'Pendiente inicio de gestion por area comercial'),
(221, 1, 216, 1, '2024-10-06 15:24:26', 'Pendiente inicio de gestion por area comercial '),
(222, 1, 217, 1, '2024-10-06 15:29:08', 'Pendiente inicio de gestion por area comercial '),
(223, 1, 218, 1, '2024-10-06 15:32:47', 'Pendiente inicio de gestion por area comercial '),
(224, 1, 219, 1, '2024-10-06 15:38:17', 'Pendiente inicio de gestion por area comercial'),
(225, 1, 220, 1, '2024-10-06 15:48:07', 'Pendiente inicio de gestion por area comercial'),
(226, 1, 221, 1, '2024-10-06 15:54:05', 'Pendiente inicio de gestion por area comercial '),
(227, 1, 28, 5, '2024-10-08 09:40:02', 'ENVIAR MODELO DE CONTRATO \r\nTRAER CATALOGO DE LA FAYETTE DE ALTERNATIVAS DE TELAS.\r\nTRAER DISENOS \r\nVIERNES 11 A LAS 8.00 a.m. '),
(228, 1, 222, 1, '2024-10-09 09:32:23', 'El cliente solicita cotización de polos ML y MC'),
(229, 1, 223, 1, '2024-10-11 14:38:50', 'Pendiente inicio de gestion por area comercial '),
(230, 1, 224, 1, '2024-10-17 09:09:34', 'Pendiente aprobacion de cotizacion. '),
(231, 1, 225, 2, '2024-10-17 12:48:42', 'Se inicia gestion de cotizacion '),
(232, 1, 226, 1, '2024-10-18 15:05:46', 'Pendiente inicio de cotizacion'),
(233, 1, 19, 5, '2024-10-21 11:11:00', 'Presentación de la nueva coordinadora de COmpras> María Jose Salazar franco cl 3128332765 \r\nCorreo coordinadorcompras@nasecolombia.com.co\r\nCompromisos, generar inventario en tela, generar cofia para afro y una muestra en la tela POTENZA\r\nEnviar cotización de botas con puntera y calzado antideslizante '),
(234, 1, 227, 2, '2024-10-21 14:16:00', 'Pendiente revisar cotizacion '),
(235, 1, 228, 2, '2024-10-21 16:18:52', 'Se envia propuesta para aprobacion '),
(236, 1, 229, 2, '2024-10-21 16:41:17', 'Pendiente aprobacion de cotizacion '),
(237, 1, 230, 1, '2024-10-23 08:40:04', 'Para el área administrativa son 6 personas, 3 hombres y 3 mujeres.\r\n2 camisas 2 pantalones por persona.\r\nÁrea Operativa nos enviara la ficha técnica '),
(238, 1, 231, 2, '2024-10-24 10:28:12', 'Pendiente revisar cotizacion '),
(239, 1, 34, 5, '2024-10-25 09:43:08', 'Se reciben las siguientes recomendaciones,\r\nPantalones gris y jeans aplicar 3 cm la bota\r\nCamiseta gris, esforzar las costuras laterales a 5 hilos\r\nLos cuellos de las polos realizarlos en poliester para que no se deformen.\r\nRealizar tallaje de mujer de pantalón gris, subir el alto de la cintura \r\n'),
(240, 1, 232, 1, '2024-10-28 16:03:27', 'SE inicia proceso de cotizacion '),
(241, 1, 233, 1, '2024-10-31 17:51:15', 'Inicio de actividad comercial '),
(242, 1, 234, 1, '2024-11-05 12:35:52', 'Inicio con cotización '),
(243, 1, 152, 2, '2024-11-05 14:29:13', 'Blusas ML Dama  gris de rayas tela Mónaco color 15 silver, drill gris el mismo de este a;o.\r\nDAMAS 3 HOMBRE 1 \r\nJEANS HOMBRES 4 CADA UNO DE 3 UNIDADES CON STRECH\r\nPOLOS GRIS CUELLO EN LA MISMA TELAS DOBLADILLADA LOGO GRIS TRIPLE A\r\n '),
(244, 1, 235, 1, '2024-11-05 15:18:47', 'Se realiza cotización '),
(245, 1, 236, 1, '2024-11-12 13:37:33', 'Inicio de cotizacion '),
(246, 1, 237, 1, '2024-11-12 16:03:55', 'Se inicia cotizacion '),
(247, 1, 233, 3, '2024-11-12 17:26:10', 'El cliente informa inconsistencias en el tallaje, un plan de acción es realizar una curva de tallas de los pantalones y blusas para que el cliente lo tenga en su set de tallas.\r\n\r\nOrganizar un inventario de BLusas T/6, T / 8  3 unidades por Talla solo mujer \r\n\r\nRealizar una muestra de antif.  COSMOS'),
(248, 1, 238, 1, '2024-11-14 14:10:10', 'Se inicia proceso comercial'),
(249, 1, 239, 1, '2024-11-26 16:47:58', 'El cliente requiere cotizacion de chaquetes '),
(250, 1, 240, 1, '2024-11-27 14:47:25', 'Cotizacion dotacion '),
(251, 1, 241, 1, '2024-11-29 14:37:17', 'Enviar cotización botas '),
(252, 1, 242, 1, '2024-11-29 16:23:35', 'Enviar cotización de polos '),
(253, 1, 243, 1, '2024-12-03 16:34:08', 'Enviar cotización '),
(254, 1, 244, 5, '2024-12-04 17:03:33', 'se realiza tallaje para enviar cotizacion'),
(255, 1, 245, 1, '2024-12-05 11:59:49', 'se crea cliente para subir cotizacion'),
(256, 1, 168, 4, '2024-12-09 10:05:33', 'Se habla con el señor Edwin, nos confirma fecha maxima para recepcion facturas dic24 , 30 diciembre. se le informa fecha de entrega pedido 18 diciembre'),
(257, 1, 166, 4, '2024-12-09 10:09:43', 'Se habla con Alejandra Aranga sobre seguimiento muestra prendas brigadistas enviadas, va a preguntar al area de Gestion Humana y nos informa. se deja para seguimiento el dia de mañana'),
(258, 1, 22, 3, '2024-12-09 10:13:31', 'Se habla con Nelita, se informa que obsequio de navidad se lo estambos enviando mañana por transporadora'),
(259, 1, 216, 3, '2024-12-09 10:46:46', 'Se habla con Hector obsequio de Navidad se les esta llevando entre mañana y pasado. Nos confirma que reciben factura en diciembre hasta el 20 Se envia correo a Carolina Mejia y a Hector informando que tenemos tela Andes R desde el mes de junio , para producir unas 200 camisas de gala, pte recibir OC'),
(260, 1, 31, 3, '2024-12-09 10:53:29', 'Se envia mail a Kelly solicitando informacion de fecha cierre factura diciembre y que debido a dificultadas con el estampado la fecha de entrega se corre para el 20 de diciembre'),
(261, 1, 208, 3, '2024-12-09 11:05:41', 'Llamada: se informa a Marisol que la entrega de las 2 polos grisese esta para el 13 dic por demora en los cuellos y puños tejidos. Y los 2 pantalones de garantia se entregan mañana'),
(262, 1, 222, 5, '2024-12-13 11:21:40', 'Por favor tener presente para el bordado siempre es BLANCO con rojo validar colores con el cliente antes de bordar '),
(263, 1, 246, 4, '2024-12-16 16:48:49', 'se crea cliente para subir OC'),
(264, 1, 247, 2, '2024-12-17 14:24:02', 'Se crea cliente para enviar cotizacion'),
(265, 1, 248, 1, '2024-12-23 14:49:45', 'necesitan nuevo proveedor de dotacion, anterior es pequeño ya no estan con el por mala calidad en la confeccion y la impuntualidad en la entrega. Estan en varias ciudades pero la principal es Pereira aca se entrega y ellos envian a sus sucursales. La factura debe salir a nombre de varios ruts '),
(266, 1, 249, 2, '2025-01-08 09:38:10', 'Se realiza visita comercial para informacion envio cotizacion dotacion administrativa. Mariannella'),
(267, 1, 250, 1, '2025-01-08 09:47:29', 'Se recibe visita para informacion requerida enviar cotizacion. Mariannella'),
(268, 1, 251, 2, '2025-01-08 09:58:47', 'Se realiza visita para mirar muestras y enviar cotizacion. Mariannella'),
(269, 1, 252, 1, '2025-01-14 15:48:56', 'cliente nos ubico por redes, comercializa polos bordadas el tiene la bordadora. Mariannella'),
(270, 1, 253, 1, '2025-01-14 16:08:34', 'Contacto telefonico solicita cotizacion . Mariannella'),
(271, 1, 254, 1, '2025-01-14 17:41:21', 'se crea para enviar cotizacion calzado tipo crocs. Mariannella'),
(272, 1, 255, 1, '2025-01-27 08:38:00', 'Requieren dotación para licitación enviar cotización al correo: lidercompras@cedicaf.com asistentecompras@cedicaf.com janlondono@cedicaf.com '),
(273, 1, 256, 1, '2025-01-28 08:26:36', 'Enviar cotización '),
(274, 1, 257, 1, '2025-01-28 12:02:30', 'se visita para enviar cotizacion sudaderas tipo jogger color negro en tela burda'),
(275, 1, 258, 1, '2025-01-30 17:27:49', 'Propuesta para un tercero '),
(276, 1, 259, 2, '2025-02-11 10:00:39', 'Se crea cliente para enviar cotizacion'),
(277, 1, 260, 1, '2025-02-11 11:37:03', 'se crea cliente para realizar solicitud cotizacion'),
(278, 1, 261, 1, '2025-02-18 13:34:58', 'se revisan muestras para cotizacion'),
(279, 1, 262, 1, '2025-02-26 11:25:34', 'se crea cliente para subir cotizacion, los datos de correo no son reales'),
(280, 1, 216, 2, '2025-03-03 11:09:46', 'Carolina revisa con cliente nueva caracteristica dotacion administrativa polos en polux y pantalones en dril spandex, 4 marzo se debe llevar propuesta nueva cotizacion'),
(281, 1, 244, 3, '2025-03-03 11:12:59', 'Visita post venta dotacion, nos entregan la camisa de Orlando Bedoya le quedo grande y como favor especial nos entregan las blusas de Gloria Motato y Carolina para hacer aberturas laterales en v, se entregan prendas a produccion. envimos correo con circular cuidado lavado prendas dotacion'),
(282, 1, 263, 1, '2025-03-12 14:58:49', 'Zona Franca.'),
(283, 1, 264, 1, '2025-03-12 15:36:39', 'FLOTA OCCIDENTAL '),
(284, 1, 265, 1, '2025-03-19 17:27:09', 'se crea cliente para enviar cotizacion'),
(285, 1, 266, 1, '2025-04-01 13:37:15', 'Carolina realiza visita a cliente y trae informacion de prendas, fotos y precios actuales para enviar propuesta'),
(286, 1, 267, 1, '2025-05-22 13:29:32', 'se crea cliente para enviar cotizacion'),
(287, 1, 268, 2, '2025-06-12 16:00:39', 'se visita cliente para recopilar informacion y presentar cotizacion'),
(288, 1, 269, 1, '2025-07-09 11:36:20', 'se crea cliente para enviar propuesta'),
(289, 1, 270, 1, '2025-07-10 13:53:51', 'Cliente solicita cotizacion de EEPs y ofrecer credito'),
(290, 1, 271, 1, '2025-07-17 13:59:54', 'CLIENTE VIA WPP'),
(291, 1, 272, 2, '2025-09-04 10:31:49', 'VISITA COMERCIAL'),
(292, 1, 273, 1, '2025-09-08 08:54:33', 'SOLICITUD DE COTIZACIÒN 25 CAMISAS'),
(293, 1, 274, 1, '2025-09-08 09:22:03', 'SOLICITUD DE COTIZACION'),
(294, 1, 275, 1, '2025-09-08 09:58:31', 'SOLICITUD DE COTIZACIÒN'),
(295, 1, 276, 1, '2025-09-08 14:13:45', 'SOLICITUD DE COTIZACION'),
(296, 1, 277, 1, '2025-09-09 14:27:18', 'solicitud de cotizaciòn'),
(297, 1, 278, 2, '2025-09-09 15:59:03', 'SOLICITUD DE COTIZACIÓN'),
(298, 1, 279, 1, '2025-10-06 11:44:18', 'SOLICITUD DE COTIZACION'),
(299, 1, 280, 1, '2025-10-08 16:14:32', 'PRESENTACIÓN DE PORTAFOLIO'),
(300, 1, 281, 1, '2025-10-29 14:00:55', 'COTIZACION'),
(301, 1, 282, 1, '2025-11-10 12:02:10', 'solicitud de cotización'),
(302, 1, 70, 2, '2025-11-17 11:09:54', 'Solicitud de cotizaciòn'),
(303, 1, 283, 1, '2025-11-20 11:10:46', 'Solicitud de cotización '),
(304, 1, 89, 2, '2025-11-20 13:51:58', 'nueva cotización'),
(305, 1, 284, 1, '2025-11-24 09:29:57', 'NUEVA COTIZACIÓN'),
(306, 1, 238, 2, '2025-11-24 17:38:26', 'SOLICITUD DE NUEVA COTIZACIÓN'),
(308, 1, 285, 1, '2025-11-27 14:17:05', 'COTIZACION'),
(309, 3, 286, 1, '2025-12-10 16:29:35', 'SOLICITUD DE COTIZACIÓN'),
(310, 9, 287, 1, '2026-01-22 09:56:46', 'Tipo de uniformes que manejan, telas y nuevas propuestas.\r\nRevisar correo y actualizar'),
(311, 2, 288, 1, '2026-01-28 16:44:38', 'licitacion'),
(312, 9, 289, 2, '2026-01-30 16:38:39', 'LICITACION revisar correos no son reales'),
(313, 9, 290, 1, '2026-02-02 11:59:07', 'LICITACION, revisar info y corregir no el real'),
(314, 9, 291, 1, '2026-02-03 14:42:52', 'cotizacion- Revisar datos no son reales'),
(315, 9, 292, 1, '2026-02-12 09:14:05', 'COTIZACION Revisar info no toda es real'),
(316, 2, 293, 1, '2026-02-17 09:46:47', 'SOLICITUD DE COTIZACION'),
(317, 9, 294, 2, '2026-02-17 12:13:15', 'Cotización, Revisar info no es real'),
(318, 9, 295, 1, '2026-02-23 11:25:34', 'COTIZACION / Revisar datos no todos son reales'),
(319, 9, 296, 2, '2026-02-23 16:00:43', 'cotizacion / revisar info no es real'),
(320, 9, 297, 2, '2026-03-06 10:25:20', 'COTIZACION ADMINISTRATIVA / Revisar info no toda es real'),
(321, 2, 298, 1, '2026-03-09 10:54:57', 'SOLICITUD DE COTIZACION'),
(322, 2, 299, 1, '2026-03-11 10:35:14', 'SOLICITUD DE COTIZACIÓN'),
(323, 9, 300, 1, '2026-03-17 15:54:32', 'COTIZACION / REVISAR INFORMACION NO ES REAL'),
(324, 2, 301, 1, '2026-04-13 11:50:40', 'SOLICITUD DE COTIZACION'),
(325, 9, 302, 2, '2026-04-15 07:10:16', 'COTIZACION NESTLE OPERATIVO'),
(326, 2, 303, 1, '2026-04-20 07:55:57', 'SOLICITUD DE COTIZACION'),
(327, 9, 304, 2, '2026-04-20 13:28:12', 'visita para nueva propuesta, corregir no todos los datos son reales'),
(328, 2, 305, 1, '2026-04-23 10:28:27', 'SOLICITUD DE COTIZACION'),
(329, 9, 306, 1, '2026-05-04 08:33:49', 'Solicitud de cotización '),
(330, 9, 307, 1, '2026-05-04 09:47:35', 'Cotización '),
(331, 9, 308, 1, '2026-05-08 08:15:58', 'Cliente para cotización ya que tercerisa su servicio con Suzuki'),
(332, 9, 309, 1, '2026-05-13 14:50:05', 'Empresa interesada en cotización para personal operativo '),
(333, 9, 310, 1, '2026-05-13 16:33:06', 'Solicitus de cotizacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivo`
--

CREATE TABLE `vivo` (
  `id_vivo` int(11) NOT NULL,
  `insumo` varchar(300) DEFAULT NULL,
  `medida` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_tipoinsumo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `vivo`
--

INSERT INTO `vivo` (`id_vivo`, `insumo`, `medida`, `precio`, `fecha_actualizacion`, `unidades`, `id_proveedor`, `id_tipoinsumo`) VALUES
(0, 'No Aplica', NULL, 0, '2025-01-24', 0, 0, 26),
(1, 'Vivo Embonado Mt', ' metro', 462, '2025-01-24', 0, 5, 26),
(2, 'Vivo Embonado Pieza 10 Metros', 'metro', 220, '2025-01-24', 0, 5, 26),
(3, 'Vivo Embonado Rollo 60 Mts', 'metros', 184.8, '2025-01-24', 0, 5, 26);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acabado`
--
ALTER TABLE `acabado`
  ADD PRIMARY KEY (`id_acabado`);

--
-- Indices de la tabla `anticipo`
--
ALTER TABLE `anticipo`
  ADD PRIMARY KEY (`id_anticipo`);

--
-- Indices de la tabla `bolsa`
--
ALTER TABLE `bolsa`
  ADD PRIMARY KEY (`id_bolsa`),
  ADD KEY `fk_boton_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `bolsillo`
--
ALTER TABLE `bolsillo`
  ADD PRIMARY KEY (`id_bolsillo`);

--
-- Indices de la tabla `bolsillo_combinado`
--
ALTER TABLE `bolsillo_combinado`
  ADD PRIMARY KEY (`id_bolsillocombinado`);

--
-- Indices de la tabla `bolsillo_combinado2`
--
ALTER TABLE `bolsillo_combinado2`
  ADD PRIMARY KEY (`id_bolsillocombinado2`);

--
-- Indices de la tabla `boton`
--
ALTER TABLE `boton`
  ADD PRIMARY KEY (`id_boton`),
  ADD KEY `fk_boton_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `boton2`
--
ALTER TABLE `boton2`
  ADD PRIMARY KEY (`id_boton2`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `broche`
--
ALTER TABLE `broche`
  ADD PRIMARY KEY (`id_broche`),
  ADD KEY `fk_otros_insumos_chaqueta_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id_calificacion`);

--
-- Indices de la tabla `califi_proveedor`
--
ALTER TABLE `califi_proveedor`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_calificacion` (`id_calificacion`);

--
-- Indices de la tabla `califi_proveedortela`
--
ALTER TABLE `califi_proveedortela`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_calificacion` (`id_calificacion`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `cartera`
--
ALTER TABLE `cartera`
  ADD PRIMARY KEY (`id_cartera`);

--
-- Indices de la tabla `cinta_faya`
--
ALTER TABLE `cinta_faya`
  ADD PRIMARY KEY (`id_faya`),
  ADD KEY `fk_otros_insumos_chaqueta_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `cinta_reflectiva`
--
ALTER TABLE `cinta_reflectiva`
  ADD PRIMARY KEY (`id_cinta`),
  ADD KEY `fk_boton_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`nit`),
  ADD KEY `id_entidad` (`id_entidad`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `consumo_min`
--
ALTER TABLE `consumo_min`
  ADD PRIMARY KEY (`id_consumo`);

--
-- Indices de la tabla `cordon`
--
ALTER TABLE `cordon`
  ADD PRIMARY KEY (`id_cordon`),
  ADD KEY `fk_otros_insumos_chaqueta_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `corte`
--
ALTER TABLE `corte`
  ADD PRIMARY KEY (`id_corte`);

--
-- Indices de la tabla `cremallera`
--
ALTER TABLE `cremallera`
  ADD PRIMARY KEY (`id_cremallera`),
  ADD KEY `fk_boton_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `cremallera2`
--
ALTER TABLE `cremallera2`
  ADD PRIMARY KEY (`id_cremallera2`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `cuello`
--
ALTER TABLE `cuello`
  ADD PRIMARY KEY (`id_cuello`),
  ADD KEY `fk_cuello_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `deslizador`
--
ALTER TABLE `deslizador`
  ADD PRIMARY KEY (`id_deslizador`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `diseño`
--
ALTER TABLE `diseño`
  ADD PRIMARY KEY (`id_diseño`);

--
-- Indices de la tabla `encarterada`
--
ALTER TABLE `encarterada`
  ADD PRIMARY KEY (`id_encarterada`);

--
-- Indices de la tabla `entidad`
--
ALTER TABLE `entidad`
  ADD PRIMARY KEY (`id_entidad`);

--
-- Indices de la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`id_entrega`);

--
-- Indices de la tabla `entregado`
--
ALTER TABLE `entregado`
  ADD PRIMARY KEY (`id_entregado`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `entretela`
--
ALTER TABLE `entretela`
  ADD PRIMARY KEY (`id_entretela`),
  ADD KEY `fk_boton_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `entretela2`
--
ALTER TABLE `entretela2`
  ADD PRIMARY KEY (`id_entretela2`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `fajon_cintura`
--
ALTER TABLE `fajon_cintura`
  ADD PRIMARY KEY (`id_fajon_cintura`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `ficha_tecnica`
--
ALTER TABLE `ficha_tecnica`
  ADD PRIMARY KEY (`id_fichatecnica`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `fusionado`
--
ALTER TABLE `fusionado`
  ADD PRIMARY KEY (`id_fusionado`),
  ADD KEY `fk_boton_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `guata`
--
ALTER TABLE `guata`
  ADD PRIMARY KEY (`id_guata`),
  ADD KEY `fk_otros_insumos_chaqueta_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `hiladilla`
--
ALTER TABLE `hiladilla`
  ADD PRIMARY KEY (`id_hiladilla`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `hombrera`
--
ALTER TABLE `hombrera`
  ADD PRIMARY KEY (`id_hombrera`),
  ADD KEY `fk_otros_insumos_superior_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `lleva_reflectiva`
--
ALTER TABLE `lleva_reflectiva`
  ADD PRIMARY KEY (`id_lleva`);

--
-- Indices de la tabla `logistica`
--
ALTER TABLE `logistica`
  ADD PRIMARY KEY (`id_logistica`);

--
-- Indices de la tabla `mano_obra`
--
ALTER TABLE `mano_obra`
  ADD PRIMARY KEY (`id_mano_obra`),
  ADD KEY `id_tipo_prenda` (`id_tipo_prenda`);

--
-- Indices de la tabla `marquilla`
--
ALTER TABLE `marquilla`
  ADD PRIMARY KEY (`id_marquilla`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `muestra`
--
ALTER TABLE `muestra`
  ADD PRIMARY KEY (`id_muestra`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id_ordencompra`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedido_anticipo1_idx` (`id_anticipo`),
  ADD KEY `id_cliente` (`nit`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `plumilla`
--
ALTER TABLE `plumilla`
  ADD PRIMARY KEY (`id_plumilla`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `prenda`
--
ALTER TABLE `prenda`
  ADD PRIMARY KEY (`id_prenda`),
  ADD KEY `id_caracteristica` (`id_tipo_prenda`);

--
-- Indices de la tabla `prenda_comprada`
--
ALTER TABLE `prenda_comprada`
  ADD PRIMARY KEY (`id_prendacomprada`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `pretina`
--
ALTER TABLE `pretina`
  ADD PRIMARY KEY (`id_pretina`),
  ADD KEY `fk_otros_insumos_chaqueta_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_superior_hombre_tela1_idx` (`id_tela`),
  ADD KEY `fk_superior_hombre_cuello1_idx` (`id_cuello`),
  ADD KEY `fk_superior_hombre_puño1_idx` (`id_puño`),
  ADD KEY `fk_superior_hombre_boton1_idx` (`id_boton`),
  ADD KEY `fk_superior_hombre_cinta_reflectiva1_idx` (`id_cinta`),
  ADD KEY `fk_superior_hombre_marquilla1_idx` (`id_marquilla`),
  ADD KEY `fk_superior_hombre_bolsa1_idx` (`id_bolsa`),
  ADD KEY `fk_superior_hombre_cremallera1_idx` (`id_cremallera`),
  ADD KEY `fk_superior_hombre_entretela1_idx` (`id_entretela`),
  ADD KEY `fk_superior_hombre_fusionado1_idx` (`id_fusionado`),
  ADD KEY `fk_superior_hombre_acabado1_idx` (`id_acabado`),
  ADD KEY `fk_superior_hombre_velcro1_idx` (`id_velcro`),
  ADD KEY `fk_superior_hombre_resorte1_idx` (`id_resorte`),
  ADD KEY `fk_superior_hombre_logistica1_idx` (`id_logistica`),
  ADD KEY `fk_superior_hombre_mano_obra_superior1_idx` (`id_mano_obra`),
  ADD KEY `fk_superior_hombre_diseño1_idx` (`id_diseño`),
  ADD KEY `fk_superior_hombre_corte1_idx` (`id_corte`),
  ADD KEY `fk_superior_hombre_consumo_min1_idx` (`id_consumo`),
  ADD KEY `fk_superior_hombre_prenda_superior_hombre1_idx` (`id_prenda`),
  ADD KEY `fk_superior_hombre_pedido1_idx` (`id_pedido`),
  ADD KEY `id_insumosdos` (`id_hombrera`),
  ADD KEY `id_entrega` (`id_entrega`),
  ADD KEY `fk_producto_tela_combinada1_idx` (`id_telacombi`),
  ADD KEY `fk_producto_sesgo1_idx` (`id_sesgo`),
  ADD KEY `fk_producto_vivo1_idx` (`id_vivo`),
  ADD KEY `fk_producto_cinta_faya1_idx` (`id_faya`),
  ADD KEY `fk_producto_guata1_idx` (`id_guata`),
  ADD KEY `fk_producto_pretina1_idx` (`id_pretina`),
  ADD KEY `fk_producto_broche1_idx` (`id_broche`),
  ADD KEY `fk_producto_puntera1_idx` (`id_puntera`),
  ADD KEY `fk_producto_trabilla1_idx` (`id_trabilla`),
  ADD KEY `fk_producto_copy1_cordon1_idx` (`id_cordon`),
  ADD KEY `fk_producto_tipo_prenda1_idx` (`id_cargo`),
  ADD KEY `id_bolsillo` (`id_bolsillo`),
  ADD KEY `id_telaforro` (`id_telaforro`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_tablon` (`id_tablon`),
  ADD KEY `id_muestra` (`id_muestra`),
  ADD KEY `id_tipo_prenda` (`id_tipo_producto`),
  ADD KEY `id_tipo_logo` (`id_tipo_logo`),
  ADD KEY `id_cartera` (`id_cartera`),
  ADD KEY `id_lleva` (`id_lleva`),
  ADD KEY `id_lleva_2` (`id_lleva`),
  ADD KEY `id_resorte2` (`id_resorte2`),
  ADD KEY `id_cremallera2` (`id_cremallera2`),
  ADD KEY `id_boton2` (`id_boton2`),
  ADD KEY `id_plumilla` (`id_plumilla`),
  ADD KEY `id_vinilo` (`id_vinilo`),
  ADD KEY `id_cremallera2_2` (`id_cremallera2`),
  ADD KEY `id_entretela2` (`id_entretela2`),
  ADD KEY `id_hiladilla` (`id_hiladilla`),
  ADD KEY `id_encarterada` (`id_encarterada`),
  ADD KEY `id_prendacomprada` (`id_prendacomprada`),
  ADD KEY `id_deslizador` (`id_deslizador`),
  ADD KEY `id_puesta` (`id_puesta`),
  ADD KEY `id_bolsillocombinado` (`id_bolsillocombinado`),
  ADD KEY `id_bolsillocombinado2` (`id_bolsillocombinado2`),
  ADD KEY `id_fajon_cintura` (`id_fajon_cintura`);

--
-- Indices de la tabla `producto2`
--
ALTER TABLE `producto2`
  ADD PRIMARY KEY (`id_producto2`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_tela` (`id_tela2`),
  ADD KEY `id_telacombi` (`id_telacombi2`),
  ADD KEY `id_telaforro` (`id_telaforro2`),
  ADD KEY `id_entretela2` (`id_entretela22`),
  ADD KEY `id_cuello2` (`id_cuello2`),
  ADD KEY `id_puño2` (`id_puño2`),
  ADD KEY `id_boton2` (`id_boton22`),
  ADD KEY `id_boton2_2` (`id_boton22`),
  ADD KEY `id_boton22` (`id_boton222`),
  ADD KEY `id_cremallera2` (`id_cremallera22`),
  ADD KEY `id_cremallera22` (`id_cremallera222`),
  ADD KEY `id_velcro2` (`id_velcro2`),
  ADD KEY `id_resorte2` (`id_resorte22`),
  ADD KEY `id_resorte22` (`id_resorte222`),
  ADD KEY `id_hombrera2` (`id_hombrera2`),
  ADD KEY `id_sesgo2` (`id_sesgo2`),
  ADD KEY `id_trabilla2` (`id_trabilla2`),
  ADD KEY `id_vivo2` (`id_vivo2`),
  ADD KEY `id_cinta2` (`id_cinta2`),
  ADD KEY `id_faya2` (`id_faya2`),
  ADD KEY `id_guata2` (`id_guata2`),
  ADD KEY `id_pretina2` (`id_pretina2`),
  ADD KEY `id_broche2` (`id_broche2`),
  ADD KEY `id_cordon2` (`id_cordon2`),
  ADD KEY `id_puntera2` (`id_puntera2`),
  ADD KEY `id_plumilla2` (`id_plumilla2`),
  ADD KEY `id_vinilo2` (`id_vinilo2`),
  ADD KEY `id_ordencompra` (`id_ordencompra`),
  ADD KEY `id_entretela222` (`id_entretela222`),
  ADD KEY `id_deslizador2` (`id_deslizador2`),
  ADD KEY `id_fajon_cintura2` (`id_fajon_cintura2`),
  ADD KEY `id_hiladilla2` (`id_hiladilla2`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `proveedor_tela`
--
ALTER TABLE `proveedor_tela`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `puesta_cinta`
--
ALTER TABLE `puesta_cinta`
  ADD PRIMARY KEY (`id_puesta`);

--
-- Indices de la tabla `puntera`
--
ALTER TABLE `puntera`
  ADD PRIMARY KEY (`id_puntera`),
  ADD KEY `fk_otros_insumos_chaqueta_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `puño`
--
ALTER TABLE `puño`
  ADD PRIMARY KEY (`id_puño`),
  ADD KEY `fk_puño_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reporte`);

--
-- Indices de la tabla `resorte`
--
ALTER TABLE `resorte`
  ADD PRIMARY KEY (`id_resorte`),
  ADD KEY `fk_boton_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `resorte2`
--
ALTER TABLE `resorte2`
  ADD PRIMARY KEY (`id_resorte2`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `sesgo`
--
ALTER TABLE `sesgo`
  ADD PRIMARY KEY (`id_sesgo`),
  ADD KEY `fk_otros_insumos_inferior_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `tablon`
--
ALTER TABLE `tablon`
  ADD PRIMARY KEY (`id_tablon`);

--
-- Indices de la tabla `tela`
--
ALTER TABLE `tela`
  ADD PRIMARY KEY (`id_tela`),
  ADD KEY `fk_tela_proveedor_tela1_idx` (`id_proveedor`),
  ADD KEY `id_tipo_tela` (`id_tipo_tela`);

--
-- Indices de la tabla `tela_combinada`
--
ALTER TABLE `tela_combinada`
  ADD PRIMARY KEY (`id_telacombi`),
  ADD KEY `fk_tela_proveedor_tela1_idx` (`id_proveedor`),
  ADD KEY `id_tipo_tela` (`id_tipo_tela`);

--
-- Indices de la tabla `tela_forro`
--
ALTER TABLE `tela_forro`
  ADD PRIMARY KEY (`id_telaforro`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipo_tela` (`id_tipo_tela`);

--
-- Indices de la tabla `tipo_insumo`
--
ALTER TABLE `tipo_insumo`
  ADD PRIMARY KEY (`id_tipoinsumo`);

--
-- Indices de la tabla `tipo_logo`
--
ALTER TABLE `tipo_logo`
  ADD PRIMARY KEY (`id_tipo_logo`);

--
-- Indices de la tabla `tipo_prenda`
--
ALTER TABLE `tipo_prenda`
  ADD PRIMARY KEY (`id_tipo_prenda`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipo_producto`);

--
-- Indices de la tabla `tipo_tela`
--
ALTER TABLE `tipo_tela`
  ADD PRIMARY KEY (`id_tipo_tela`);

--
-- Indices de la tabla `tipo_visita`
--
ALTER TABLE `tipo_visita`
  ADD PRIMARY KEY (`id_tipo_visita`);

--
-- Indices de la tabla `trabilla`
--
ALTER TABLE `trabilla`
  ADD PRIMARY KEY (`id_trabilla`),
  ADD KEY `fk_otros_insumos_overol_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `velcro`
--
ALTER TABLE `velcro`
  ADD PRIMARY KEY (`id_velcro`),
  ADD KEY `fk_boton_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `vinilo`
--
ALTER TABLE `vinilo`
  ADD PRIMARY KEY (`id_vinilo`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`id_visita`),
  ADD KEY `nit` (`nit`),
  ADD KEY `id_tipo_visita` (`id_tipo_visita`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `vivo`
--
ALTER TABLE `vivo`
  ADD PRIMARY KEY (`id_vivo`),
  ADD KEY `fk_otros_insumos_chaqueta_proveedor1_idx` (`id_proveedor`),
  ADD KEY `id_tipoinsumo` (`id_tipoinsumo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acabado`
--
ALTER TABLE `acabado`
  MODIFY `id_acabado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `bolsa`
--
ALTER TABLE `bolsa`
  MODIFY `id_bolsa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `bolsillo`
--
ALTER TABLE `bolsillo`
  MODIFY `id_bolsillo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `bolsillo_combinado`
--
ALTER TABLE `bolsillo_combinado`
  MODIFY `id_bolsillocombinado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `bolsillo_combinado2`
--
ALTER TABLE `bolsillo_combinado2`
  MODIFY `id_bolsillocombinado2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `boton`
--
ALTER TABLE `boton`
  MODIFY `id_boton` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `boton2`
--
ALTER TABLE `boton2`
  MODIFY `id_boton2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `broche`
--
ALTER TABLE `broche`
  MODIFY `id_broche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `califi_proveedor`
--
ALTER TABLE `califi_proveedor`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `califi_proveedortela`
--
ALTER TABLE `califi_proveedortela`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cinta_faya`
--
ALTER TABLE `cinta_faya`
  MODIFY `id_faya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cinta_reflectiva`
--
ALTER TABLE `cinta_reflectiva`
  MODIFY `id_cinta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `nit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT de la tabla `cordon`
--
ALTER TABLE `cordon`
  MODIFY `id_cordon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `corte`
--
ALTER TABLE `corte`
  MODIFY `id_corte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cremallera`
--
ALTER TABLE `cremallera`
  MODIFY `id_cremallera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `cremallera2`
--
ALTER TABLE `cremallera2`
  MODIFY `id_cremallera2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `cuello`
--
ALTER TABLE `cuello`
  MODIFY `id_cuello` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `deslizador`
--
ALTER TABLE `deslizador`
  MODIFY `id_deslizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `encarterada`
--
ALTER TABLE `encarterada`
  MODIFY `id_encarterada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `entidad`
--
ALTER TABLE `entidad`
  MODIFY `id_entidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `entregado`
--
ALTER TABLE `entregado`
  MODIFY `id_entregado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de la tabla `entretela`
--
ALTER TABLE `entretela`
  MODIFY `id_entretela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `entretela2`
--
ALTER TABLE `entretela2`
  MODIFY `id_entretela2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `fajon_cintura`
--
ALTER TABLE `fajon_cintura`
  MODIFY `id_fajon_cintura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ficha_tecnica`
--
ALTER TABLE `ficha_tecnica`
  MODIFY `id_fichatecnica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fusionado`
--
ALTER TABLE `fusionado`
  MODIFY `id_fusionado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `guata`
--
ALTER TABLE `guata`
  MODIFY `id_guata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `hiladilla`
--
ALTER TABLE `hiladilla`
  MODIFY `id_hiladilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `hombrera`
--
ALTER TABLE `hombrera`
  MODIFY `id_hombrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lleva_reflectiva`
--
ALTER TABLE `lleva_reflectiva`
  MODIFY `id_lleva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mano_obra`
--
ALTER TABLE `mano_obra`
  MODIFY `id_mano_obra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT de la tabla `marquilla`
--
ALTER TABLE `marquilla`
  MODIFY `id_marquilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `muestra`
--
ALTER TABLE `muestra`
  MODIFY `id_muestra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_ordencompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=557;

--
-- AUTO_INCREMENT de la tabla `plumilla`
--
ALTER TABLE `plumilla`
  MODIFY `id_plumilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `prenda_comprada`
--
ALTER TABLE `prenda_comprada`
  MODIFY `id_prendacomprada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `pretina`
--
ALTER TABLE `pretina`
  MODIFY `id_pretina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2409;

--
-- AUTO_INCREMENT de la tabla `producto2`
--
ALTER TABLE `producto2`
  MODIFY `id_producto2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `proveedor_tela`
--
ALTER TABLE `proveedor_tela`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `puesta_cinta`
--
ALTER TABLE `puesta_cinta`
  MODIFY `id_puesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `puntera`
--
ALTER TABLE `puntera`
  MODIFY `id_puntera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `puño`
--
ALTER TABLE `puño`
  MODIFY `id_puño` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `resorte`
--
ALTER TABLE `resorte`
  MODIFY `id_resorte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `resorte2`
--
ALTER TABLE `resorte2`
  MODIFY `id_resorte2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sesgo`
--
ALTER TABLE `sesgo`
  MODIFY `id_sesgo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tablon`
--
ALTER TABLE `tablon`
  MODIFY `id_tablon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tela`
--
ALTER TABLE `tela`
  MODIFY `id_tela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=737;

--
-- AUTO_INCREMENT de la tabla `tela_combinada`
--
ALTER TABLE `tela_combinada`
  MODIFY `id_telacombi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=737;

--
-- AUTO_INCREMENT de la tabla `tela_forro`
--
ALTER TABLE `tela_forro`
  MODIFY `id_telaforro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=737;

--
-- AUTO_INCREMENT de la tabla `tipo_insumo`
--
ALTER TABLE `tipo_insumo`
  MODIFY `id_tipoinsumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tipo_logo`
--
ALTER TABLE `tipo_logo`
  MODIFY `id_tipo_logo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_prenda`
--
ALTER TABLE `tipo_prenda`
  MODIFY `id_tipo_prenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_tela`
--
ALTER TABLE `tipo_tela`
  MODIFY `id_tipo_tela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tipo_visita`
--
ALTER TABLE `tipo_visita`
  MODIFY `id_tipo_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `trabilla`
--
ALTER TABLE `trabilla`
  MODIFY `id_trabilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `velcro`
--
ALTER TABLE `velcro`
  MODIFY `id_velcro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `vinilo`
--
ALTER TABLE `vinilo`
  MODIFY `id_vinilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `visita`
--
ALTER TABLE `visita`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT de la tabla `vivo`
--
ALTER TABLE `vivo`
  MODIFY `id_vivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bolsa`
--
ALTER TABLE `bolsa`
  ADD CONSTRAINT `bolsa_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_boton_proveedor1000` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `boton`
--
ALTER TABLE `boton`
  ADD CONSTRAINT `boton_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_boton_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `boton2`
--
ALTER TABLE `boton2`
  ADD CONSTRAINT `boton2_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boton2_ibfk_2` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `broche`
--
ALTER TABLE `broche`
  ADD CONSTRAINT `broche_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_otros_insumos_chaqueta_proveedor13` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `califi_proveedor`
--
ALTER TABLE `califi_proveedor`
  ADD CONSTRAINT `califi_proveedor_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `califi_proveedor_ibfk_2` FOREIGN KEY (`id_calificacion`) REFERENCES `calificacion` (`id_calificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `califi_proveedortela`
--
ALTER TABLE `califi_proveedortela`
  ADD CONSTRAINT `califi_proveedortela_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor_tela` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `califi_proveedortela_ibfk_2` FOREIGN KEY (`id_calificacion`) REFERENCES `calificacion` (`id_calificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cinta_faya`
--
ALTER TABLE `cinta_faya`
  ADD CONSTRAINT `cinta_faya_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_otros_insumos_chaqueta_proveedor10` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cinta_reflectiva`
--
ALTER TABLE `cinta_reflectiva`
  ADD CONSTRAINT `cinta_reflectiva_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_boton_proveedor10` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_entidad`) REFERENCES `entidad` (`id_entidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cordon`
--
ALTER TABLE `cordon`
  ADD CONSTRAINT `cordon_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_otros_insumos_chaqueta_proveedor14` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cremallera`
--
ALTER TABLE `cremallera`
  ADD CONSTRAINT `cremallera_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_boton_proveedor1000000` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cremallera2`
--
ALTER TABLE `cremallera2`
  ADD CONSTRAINT `cremallera2_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cremallera2_ibfk_2` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuello`
--
ALTER TABLE `cuello`
  ADD CONSTRAINT `cuello_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cuello_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `deslizador`
--
ALTER TABLE `deslizador`
  ADD CONSTRAINT `deslizador_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `deslizador_ibfk_2` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `entregado`
--
ALTER TABLE `entregado`
  ADD CONSTRAINT `entregado_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entretela`
--
ALTER TABLE `entretela`
  ADD CONSTRAINT `entretela_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_boton_proveedor10000000` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `entretela2`
--
ALTER TABLE `entretela2`
  ADD CONSTRAINT `entretela2_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `entretela2_ibfk_2` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `fajon_cintura`
--
ALTER TABLE `fajon_cintura`
  ADD CONSTRAINT `fajon_cintura_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fajon_cintura_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `ficha_tecnica`
--
ALTER TABLE `ficha_tecnica`
  ADD CONSTRAINT `ficha_tecnica_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fusionado`
--
ALTER TABLE `fusionado`
  ADD CONSTRAINT `fk_boton_proveedor100000000` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fusionado_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `guata`
--
ALTER TABLE `guata`
  ADD CONSTRAINT `fk_otros_insumos_chaqueta_proveedor11` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `guata_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `hiladilla`
--
ALTER TABLE `hiladilla`
  ADD CONSTRAINT `hiladilla_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hiladilla_ibfk_2` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `hombrera`
--
ALTER TABLE `hombrera`
  ADD CONSTRAINT `fk_otros_insumos_superior_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hombrera_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `mano_obra`
--
ALTER TABLE `mano_obra`
  ADD CONSTRAINT `mano_obra_ibfk_1` FOREIGN KEY (`id_tipo_prenda`) REFERENCES `tipo_prenda` (`id_tipo_prenda`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `marquilla`
--
ALTER TABLE `marquilla`
  ADD CONSTRAINT `marquilla_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marquilla_ibfk_2` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `orden_compra_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_anticipo1` FOREIGN KEY (`id_anticipo`) REFERENCES `anticipo` (`id_anticipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`nit`) REFERENCES `cliente` (`nit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plumilla`
--
ALTER TABLE `plumilla`
  ADD CONSTRAINT `plumilla_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plumilla_ibfk_2` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `prenda`
--
ALTER TABLE `prenda`
  ADD CONSTRAINT `prenda_ibfk_1` FOREIGN KEY (`id_tipo_prenda`) REFERENCES `tipo_prenda` (`id_tipo_prenda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prenda_comprada`
--
ALTER TABLE `prenda_comprada`
  ADD CONSTRAINT `prenda_comprada_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `pretina`
--
ALTER TABLE `pretina`
  ADD CONSTRAINT `fk_otros_insumos_chaqueta_proveedor12` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pretina_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_broche10` FOREIGN KEY (`id_broche`) REFERENCES `broche` (`id_broche`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_cinta_faya10` FOREIGN KEY (`id_faya`) REFERENCES `cinta_faya` (`id_faya`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_copy1_cordon1` FOREIGN KEY (`id_cordon`) REFERENCES `cordon` (`id_cordon`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_guata10` FOREIGN KEY (`id_guata`) REFERENCES `guata` (`id_guata`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_pretina10` FOREIGN KEY (`id_pretina`) REFERENCES `pretina` (`id_pretina`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_puntera10` FOREIGN KEY (`id_puntera`) REFERENCES `puntera` (`id_puntera`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_sesgo10` FOREIGN KEY (`id_sesgo`) REFERENCES `sesgo` (`id_sesgo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_tela_combinada10` FOREIGN KEY (`id_telacombi`) REFERENCES `tela_combinada` (`id_telacombi`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_tipo_prenda1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_trabilla10` FOREIGN KEY (`id_trabilla`) REFERENCES `trabilla` (`id_trabilla`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_vivo10` FOREIGN KEY (`id_vivo`) REFERENCES `vivo` (`id_vivo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_acabado10` FOREIGN KEY (`id_acabado`) REFERENCES `acabado` (`id_acabado`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_bolsa10` FOREIGN KEY (`id_bolsa`) REFERENCES `bolsa` (`id_bolsa`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_boton10` FOREIGN KEY (`id_boton`) REFERENCES `boton` (`id_boton`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_cinta_reflectiva10` FOREIGN KEY (`id_cinta`) REFERENCES `cinta_reflectiva` (`id_cinta`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_consumo_min10` FOREIGN KEY (`id_consumo`) REFERENCES `consumo_min` (`id_consumo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_corte10` FOREIGN KEY (`id_corte`) REFERENCES `corte` (`id_corte`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_cremallera10` FOREIGN KEY (`id_cremallera`) REFERENCES `cremallera` (`id_cremallera`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_cuello10` FOREIGN KEY (`id_cuello`) REFERENCES `cuello` (`id_cuello`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_diseño10` FOREIGN KEY (`id_diseño`) REFERENCES `diseño` (`id_diseño`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_entretela10` FOREIGN KEY (`id_entretela`) REFERENCES `entretela` (`id_entretela`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_fusionado10` FOREIGN KEY (`id_fusionado`) REFERENCES `fusionado` (`id_fusionado`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_logistica10` FOREIGN KEY (`id_logistica`) REFERENCES `logistica` (`id_logistica`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_mano_obra_superior10` FOREIGN KEY (`id_mano_obra`) REFERENCES `mano_obra` (`id_mano_obra`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_marquilla10` FOREIGN KEY (`id_marquilla`) REFERENCES `marquilla` (`id_marquilla`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_prenda_superior_hombre10` FOREIGN KEY (`id_prenda`) REFERENCES `prenda` (`id_prenda`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_puño10` FOREIGN KEY (`id_puño`) REFERENCES `puño` (`id_puño`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_resorte10` FOREIGN KEY (`id_resorte`) REFERENCES `resorte` (`id_resorte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_tela10` FOREIGN KEY (`id_tela`) REFERENCES `tela` (`id_tela`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_superior_hombre_velcro10` FOREIGN KEY (`id_velcro`) REFERENCES `velcro` (`id_velcro`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_bolsillo`) REFERENCES `bolsillo` (`id_bolsillo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_10` FOREIGN KEY (`id_cartera`) REFERENCES `cartera` (`id_cartera`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_11` FOREIGN KEY (`id_lleva`) REFERENCES `lleva_reflectiva` (`id_lleva`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_12` FOREIGN KEY (`id_cremallera2`) REFERENCES `cremallera2` (`id_cremallera2`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_13` FOREIGN KEY (`id_resorte2`) REFERENCES `resorte2` (`id_resorte2`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_14` FOREIGN KEY (`id_boton2`) REFERENCES `boton2` (`id_boton2`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_15` FOREIGN KEY (`id_plumilla`) REFERENCES `plumilla` (`id_plumilla`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_16` FOREIGN KEY (`id_vinilo`) REFERENCES `vinilo` (`id_vinilo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_17` FOREIGN KEY (`id_entretela2`) REFERENCES `entretela2` (`id_entretela2`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_18` FOREIGN KEY (`id_hiladilla`) REFERENCES `hiladilla` (`id_hiladilla`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_19` FOREIGN KEY (`id_encarterada`) REFERENCES `encarterada` (`id_encarterada`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_telaforro`) REFERENCES `tela_forro` (`id_telaforro`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_20` FOREIGN KEY (`id_prendacomprada`) REFERENCES `prenda_comprada` (`id_prendacomprada`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_21` FOREIGN KEY (`id_deslizador`) REFERENCES `deslizador` (`id_deslizador`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_22` FOREIGN KEY (`id_puesta`) REFERENCES `puesta_cinta` (`id_puesta`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_23` FOREIGN KEY (`id_bolsillocombinado`) REFERENCES `bolsillo_combinado` (`id_bolsillocombinado`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_24` FOREIGN KEY (`id_bolsillocombinado2`) REFERENCES `bolsillo_combinado2` (`id_bolsillocombinado2`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_25` FOREIGN KEY (`id_fajon_cintura`) REFERENCES `fajon_cintura` (`id_fajon_cintura`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_5` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_6` FOREIGN KEY (`id_tablon`) REFERENCES `tablon` (`id_tablon`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_7` FOREIGN KEY (`id_muestra`) REFERENCES `muestra` (`id_muestra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_8` FOREIGN KEY (`id_tipo_producto`) REFERENCES `tipo_producto` (`id_tipo_producto`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_9` FOREIGN KEY (`id_tipo_logo`) REFERENCES `tipo_logo` (`id_tipo_logo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `superior_hombre_ibfk_20` FOREIGN KEY (`id_hombrera`) REFERENCES `hombrera` (`id_hombrera`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `superior_hombre_ibfk_30` FOREIGN KEY (`id_entrega`) REFERENCES `entrega` (`id_entrega`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto2`
--
ALTER TABLE `producto2`
  ADD CONSTRAINT `producto2_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_10` FOREIGN KEY (`id_boton222`) REFERENCES `boton2` (`id_boton2`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_11` FOREIGN KEY (`id_cremallera22`) REFERENCES `cremallera` (`id_cremallera`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_12` FOREIGN KEY (`id_cremallera222`) REFERENCES `cremallera2` (`id_cremallera2`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_13` FOREIGN KEY (`id_resorte22`) REFERENCES `resorte` (`id_resorte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_14` FOREIGN KEY (`id_resorte222`) REFERENCES `resorte2` (`id_resorte2`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_15` FOREIGN KEY (`id_hombrera2`) REFERENCES `hombrera` (`id_hombrera`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_16` FOREIGN KEY (`id_sesgo2`) REFERENCES `sesgo` (`id_sesgo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_17` FOREIGN KEY (`id_trabilla2`) REFERENCES `trabilla` (`id_trabilla`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_18` FOREIGN KEY (`id_vivo2`) REFERENCES `vivo` (`id_vivo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_19` FOREIGN KEY (`id_cinta2`) REFERENCES `cinta_reflectiva` (`id_cinta`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_2` FOREIGN KEY (`id_tela2`) REFERENCES `tela` (`id_tela`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_20` FOREIGN KEY (`id_faya2`) REFERENCES `cinta_faya` (`id_faya`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_21` FOREIGN KEY (`id_guata2`) REFERENCES `guata` (`id_guata`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_22` FOREIGN KEY (`id_pretina2`) REFERENCES `pretina` (`id_pretina`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_23` FOREIGN KEY (`id_broche2`) REFERENCES `broche` (`id_broche`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_24` FOREIGN KEY (`id_cordon2`) REFERENCES `cordon` (`id_cordon`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_25` FOREIGN KEY (`id_puntera2`) REFERENCES `puntera` (`id_puntera`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_26` FOREIGN KEY (`id_plumilla2`) REFERENCES `plumilla` (`id_plumilla`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_27` FOREIGN KEY (`id_vinilo2`) REFERENCES `vinilo` (`id_vinilo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_28` FOREIGN KEY (`id_ordencompra`) REFERENCES `orden_compra` (`id_ordencompra`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_3` FOREIGN KEY (`id_telacombi2`) REFERENCES `tela_combinada` (`id_telacombi`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_4` FOREIGN KEY (`id_telaforro2`) REFERENCES `tela_forro` (`id_telaforro`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_6` FOREIGN KEY (`id_entretela22`) REFERENCES `entretela` (`id_entretela`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_7` FOREIGN KEY (`id_cuello2`) REFERENCES `cuello` (`id_cuello`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_8` FOREIGN KEY (`id_puño2`) REFERENCES `puño` (`id_puño`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto2_ibfk_9` FOREIGN KEY (`id_boton22`) REFERENCES `boton` (`id_boton`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `puntera`
--
ALTER TABLE `puntera`
  ADD CONSTRAINT `fk_otros_insumos_chaqueta_proveedor15` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `puntera_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `puño`
--
ALTER TABLE `puño`
  ADD CONSTRAINT `fk_puño_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `puño_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `resorte`
--
ALTER TABLE `resorte`
  ADD CONSTRAINT `fk_boton_proveedor100000` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `resorte_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `resorte2`
--
ALTER TABLE `resorte2`
  ADD CONSTRAINT `resorte2_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resorte2_ibfk_2` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `sesgo`
--
ALTER TABLE `sesgo`
  ADD CONSTRAINT `fk_otros_insumos_inferior_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sesgo_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `tela`
--
ALTER TABLE `tela`
  ADD CONSTRAINT `fk_tela_proveedor_tela1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor_tela` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tela_ibfk_1` FOREIGN KEY (`id_tipo_tela`) REFERENCES `tipo_tela` (`id_tipo_tela`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tela_combinada`
--
ALTER TABLE `tela_combinada`
  ADD CONSTRAINT `fk_tela_proveedor_tela10` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor_tela` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tela_combinada_ibfk_1` FOREIGN KEY (`id_tipo_tela`) REFERENCES `tipo_tela` (`id_tipo_tela`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tela_forro`
--
ALTER TABLE `tela_forro`
  ADD CONSTRAINT `tela_forro_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor_tela` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tela_forro_ibfk_3` FOREIGN KEY (`id_tipo_tela`) REFERENCES `tipo_tela` (`id_tipo_tela`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabilla`
--
ALTER TABLE `trabilla`
  ADD CONSTRAINT `fk_otros_insumos_overol_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `trabilla_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `velcro`
--
ALTER TABLE `velcro`
  ADD CONSTRAINT `fk_boton_proveedor10000` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `velcro_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `vinilo`
--
ALTER TABLE `vinilo`
  ADD CONSTRAINT `vinilo_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vinilo_ibfk_2` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`nit`) REFERENCES `cliente` (`nit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visita_ibfk_2` FOREIGN KEY (`id_tipo_visita`) REFERENCES `tipo_visita` (`id_tipo_visita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visita_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vivo`
--
ALTER TABLE `vivo`
  ADD CONSTRAINT `fk_otros_insumos_chaqueta_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `vivo_ibfk_1` FOREIGN KEY (`id_tipoinsumo`) REFERENCES `tipo_insumo` (`id_tipoinsumo`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
