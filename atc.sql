-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2023 a las 23:49:12
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `atc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `ID` int(11) NOT NULL,
  `nombreconfiguracion` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`ID`, `nombreconfiguracion`, `valor`) VALUES
(3, 'binvenida_principal', 'Bienvenidos a Américan TecnyCompu'),
(4, 'binvenida_secundaria', 'SOPORTE TÉCNICO ESPECIALIZADO'),
(5, 'boton_principal', 'EMPEZAR'),
(6, 'link_boton_principal', 'SERVICIOS'),
(7, 'titulo_servicios', 'SERVICIOS'),
(8, 'descripcion_servicios', 'Descubra a qui nuestros servicios'),
(9, 'titulo_portafolio', 'NUESTRO PORTAFOLIO'),
(10, 'descripcion_portafolio', 'Una mirada a nuestro portafolio.'),
(11, 'titulo_sobre_nosotros', 'SOBRE NOSOTROS'),
(12, 'descripcion_sobre_nosotros', 'Américan TecnyCompu: Soporte Técnico Especializado - impulsando tu éxito'),
(13, 'ultima_about', '¡Se Parte de Nuestra Historia!'),
(14, 'titulo_team', 'NUESTRO EQUIPO'),
(15, 'descripcion_equipo', 'Personas que hacen realidad este proyecto'),
(16, 'descripcion_equipo_pie', 'Respaldados por un equipo experto en el área. Nuestro compromiso es proporcionar servicios de calidad que impulsen el éxito y la productividad de las empresas en el mundo digital actual.'),
(17, 'titulo_contacto', 'CONTÁCTENOS'),
(18, 'descripcion_Contactenos', 'info@tecnycompu.net'),
(19, 'link_tw', 'http://twitter.com'),
(20, 'link_face', 'https://www.facebook.com/javiermoranr'),
(21, 'link_linkedin', 'https://www.linkedin.com/in/javier-moran-rodriguez/'),
(22, 'boton_enviar_mensaje', 'Enviar Mensaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `ID` int(11) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`ID`, `fecha`, `titulo`, `descripcion`, `imagen`) VALUES
(6, '2023-06-19', 'Nosotros', 'Somos líderes en el campo del soporte técnico de tecnología de la información (TI). Brindamos soluciones confiables y eficientes para garantizar el funcionamiento óptimo de sistemas informáticos y servicios que impulsen el éxito y la productividad.', '1687200570_atc.png'),
(7, '2023-06-19', 'Nuestra Misión', 'Proporcionar soluciones de soporte técnico de alta calidad, confiables y personalizadas. Nos comprometemos a ayudar a nuestros clientes a maximizar el valor de sus inversiones en TI, ofreciendo servicios eficientes, innovadores y adaptados a su necesidad.', '1687200688_mision.png'),
(8, '2023-06-19', 'Nuestra Visión', 'Ser reconocidos como el proveedor líder de soluciones, destacando por nuestra excelencia, innovación y compromiso con la satisfacción del cliente. Buscamos ser la opción preferida de empresas y organizaciones en la optimización y gestión de sus sistemas.', '1687200747_vision.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `ID` int(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `nombrecompleto` varchar(255) NOT NULL,
  `puesto` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`ID`, `imagen`, `nombrecompleto`, `puesto`, `twitter`, `facebook`, `linkedin`) VALUES
(1, '1689615761_FOTO PERFIL 2022 2.jpg', 'JAVIER ALFONSO MORAN RODRIGUEZ', 'CEO', 'Twitter:', 'Facebook:', 'Linkedin:');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portafolio`
--

CREATE TABLE `portafolio` (
  `ID` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `portafolio`
--

INSERT INTO `portafolio` (`ID`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`) VALUES
(9, 'Sitio Web Corporativo', 'Desarrollamos sitios web corporativos', '1687133875_os.png', 'Asesorías en todo tipo de soporte técnico, implementación de TIC, consultoría etc.', 'Sirscom LTDA.', 'Servicios Web', 'http://www.sirscom.co'),
(10, 'Asesoría TI.', 'Sitio de soporte TI. 2', '1687133937_S01.jpg', 'Asesorías en todo tipo de soporte técnico, implementación de TIC, consultoría etc.', 'Sirscom LTDA: 2', 'Servicios', 'http://www.sirscom.co 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `ID` int(11) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`ID`, `icono`, `titulo`, `descripcion`) VALUES
(3, 'fa-cogs', 'Soporte Personalizado', 'Realizamos soporte en sitio, dependiendo del caso solicitado'),
(5, 'fa-wrench', 'Mantenimiento', 'Poporte físico y lógico de computadores, Portátiles y tablet.'),
(6, 'fa-user', 'Asesoría TI.', 'Asesorías en todo tipo de soporte técnico, implementación de TIC, consultoría etc.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `usuario`, `password`, `correo`) VALUES
(5, 'atc', '$2y$10$BmOVtac13R.OxuDH.dtThuHdKjkdR5..8QiZ98ur18nE8DxwrZS4K', 'tecnycompu@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
