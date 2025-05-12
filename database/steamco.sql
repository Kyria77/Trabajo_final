-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2025 a las 18:09:49
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
-- Base de datos: `steamco`
--
CREATE DATABASE IF NOT EXISTS `steamco` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `steamco`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `idCita` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCita`),
  KEY `fk_user_cita` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) VALUES
(1, 12, '2025-05-26', 'Estructurar digital primera parte'),
(2, 12, '2025-05-26', 'Estructurar digital segunda parte'),
(3, 11, '2025-05-15', 'Primer día'),
(4, 12, '2025-05-14', 'Prueba 1'),
(6, 12, '2025-06-09', 'Formación Genially'),
(8, 15, '2025-05-09', 'Reunión proyecto'),
(9, 8, '2025-05-29', 'Estructurar digital hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `idImagen` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `alt` varchar(200) NOT NULL,
  `width` varchar(10) NOT NULL,
  `heigth` varchar(10) NOT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idImagen`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idImagen`, `nombre`, `alt`, `width`, `heigth`, `titulo`) VALUES
(1, 'LignoSat.png', 'LignoSat, el satélite japonés hecho de madera', '622', '477', 'LignoSat, el satélite japonés hecho de madera'),
(2, 'Rinnon.png', 'Médico enseñando un riñón de plástico y señalando la parte dañada.', '353', '486', 'Médico enseñando un riñón de plástico y señalando la parte dañada.'),
(3, 'Oso_polar.png', 'Oso polar encima de un bloque de hielo.', '355', '488', 'Oso polar encima de un bloque de hielo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `idNoticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `idImagen` int(11) NOT NULL,
  `texto` text NOT NULL,
  `fecha_creacion` date NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idNoticia`),
  UNIQUE KEY `titulo` (`titulo`),
  KEY `fk_user_noticia` (`idUser`),
  KEY `fk_user_imagenes` (`idImagen`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `idImagen`, `texto`, `fecha_creacion`, `idUser`) VALUES
(4, 'LignoSat, el satélite japonés hecho de madera', 1, 'En diciembre de 2024, llegaron a la Estación Espacial Internacional cinco CubeSats a bordo de la nave espacial SpaceX Dragon. Entre estos pequeños satélites, destacaba LignoSat un dispositivo de madera desarrollado por la Agencia Japonesa de Exploración Aeroespacial (JAXA) con el que estudiar cómo mejorar la sostenibilidad en el espacio.\r\nEste satélite tiene como objetivo investigar el comportamiento de la madera en el entorno espacial, un paso que podría ofrecer alternativas más ecológicas frente a los tradicionales materiales metálicos utilizados en satélites.\r\nLa investigación del uso de materiales orgánicos en el espacio surge como respuesta a los crecientes desafíos ambientales y la necesidad de explorar soluciones sostenibles para la exploración espacial. LignoSat busca evaluar las capacidades estructurales de la madera y cómo se comporta en condiciones extremas de radiación, temperatura y presión, características comunes en el espacio exterior.\r\nAunque los materiales convencionales, como el aluminio y el titanio, son altamente eficaces para la construcción de satélites, su producción tiene un alto costo ambiental. El uso de madera podría abrir nuevas posibilidades en la reducción de la huella de carbono de la industria espacial, especialmente si los resultados de LignoSat confirman que este material es adecuado para soportar las condiciones extremas del espacio.\r\nEl proyecto CubeSats de la ESA, caracterizado por la fabricación de nanosatélites cúbicos de entre 2 y 16 centímetros de lado, busca explorar la fabricación de satélites con costes mucho más reducidos, con objetivos muy específicos y limitados, y capaces de aprovechar el limitado espacio que queda libre en los cohetes de lanzamiento de otras misiones o en la Estación Espacial Internacional.\r\nEn 2013, la ESA comenzó a ofrecer a los estudiantes universitarios la oportunidad de desarrollar su propia misión espacial en el vuelo inaugural del cohete Vega. Esta iniciativa, llamada «Fly your satelite!», no solo demostró ser un exitoso proyecto educativo, también fue el punto de partida para la creación de toda una serie de satélites miniaturizados. Desde entonces, no solo ha sido posible realizar innumerables experimentos y mediciones a un coste mucho menor, sino que se ha avanzado en el desarrollo de sistemas de satélites, organizados en enjambres y capaces de generar una «mente colmena» espacial.\r\nComo parte de un innovador proyecto, la JAXA ha optado por utilizar paneles de 4 a 5,5 mm de madera de magnolia honoki, conocida por su durabilidad y resistencia, la cual ha sido sometida a un proceso de ensamblaje inspirado en técnicas de carpintería japonesa.', '2025-04-24', 11),
(5, 'Un nuevo instrumento español, portátil, de bajo coste, rápido y no invasivo contra las temidas piedras del riñón.', 2, 'La medicina conoce como litiasis o nefrolitiasis a la formación de las popularmente conocidas como «piedras del riñón» o «cálculos renales». Estos cuerpos sólidos de formas y composiciones diversas aparecen en la pelvis renal debido a una combinación de varios factores como la genética, la dieta, la ingesta insuficiente de agua, la toma de ciertos medicamentos, las infecciones del aparato urinario o la obesidad, entre otros.\r\nLos cálculos renales pueden formarse por la cristalización de sustancias como las sales de calcio, de fósforo, de ácido úrico o de cistina. Si son muy pequeños, suelen eliminarse de manera natural en la micción, algo que suele ser doloroso debido a que los cálculos tienen habitualmente aristas que pueden dañar las paredes del conducto urinario.\r\nPero si alcanzan un diámetro cercano a los 5 mm, obstruyen el uréter y causan un intenso dolor en la espalda o el abdomen. En casos extremos, esos cálculos pueden crecer tanto que ocupan gran parte de la pelvis renal y pueden causar problemas mucho más serios en el aparato urinario.\r\nLas consecuencias para la salud de los cálculos renales han impulsado a la medicina a desarrollar tratamientos para eliminarlos, desde medicamentos que favorecen la eliminación natural con reducción del dolor hasta cirugía para los casos más graves.\r\nEl procedimiento más moderno es la litotricia, que es una técnica no invasiva que emplea haces de ondas de choque de ultrasonidos enfocados sobre los cálculos, para producir vibraciones en ellos que causan su fragmentación en fina arena expulsable por la uretra. La litotricia requiere, por el momento, de equipos de grandes dimensiones que deben ser instalados en una sala de un hospital o de una clínica. El procedimiento es eficaz, pero costoso y no aplicable en consultas externas, ya que el equipo es muy voluminoso. Además, hoy por hoy no está exento de efectos secundarios, ya que la amplitud de las ondas de choque empleadas es grande y a veces se producen daños sobre los tejidos sanos que se encuentran en los alrededores del cálculo.\r\nLithovortex utiliza un nuevo tipo de onda acústica llamada haz de vórtice; que sería como un «remolino de sonido». Esta onda se enrosca y gira sobre sí misma cuando se focaliza sobre la piedra, lo que produce en ella esfuerzos de cizalla de una manera más eficiente que un haz convencional. Es como si dieran un «pellizco microscópico» en el interior de la piedra que hace que se fragmente en trozos muy finos. La operación completa se desarrolla en la mitad del tiempo que necesita una litotricia tradicional, que es de entre una y dos horas.\r\nEl Servicio de Urología del Hospital La Fe y en concreto su Núcleo de investigación traslacional integrado Urológico de Valencia (NITIUV), ha desarrollado las pruebas iniciales, que han consistido, hasta la fecha, en una fragmentación de cálculos artificiales en un entorno simulado y, ya en colaboración con la Unidad de Litotricia del Hospital de La Fe de València se ha validado su funcionamiento con cálculos reales, pero fuera de un ser vivo.', '2025-04-22', 11),
(6, 'Nuevos modelos del cambio climático: El deshielo del ártico haría más lluviosos a España y Portugal.', 3, 'El estudio, liderado por Ivana Cvijanovic un equipo de investigadoras del Instituto de Salud Global de Barcelona (ISGlobal), ha utilizado un enfoque novedoso. Consiste en proporcionar a los simuladores informáticos solo los datos correspondientes a la pérdida de la banquisa oceánica del Ártico, pero sin añadir el aumento térmico necesario para derretir el hielo y sin considerar, al mismo tiempo, otros factores relacionados con el cambio climático como la pérdida del hielo de la Antártida o la reducción de la vegetación en otras zonas del planeta.\r\nEl objetivo es que ni un aumento de calor impuesto artificialmente al modelo, ni la contribución forzada de los datos correspondientes a la deforestación o a una Antártida deshelada, afecten a la respuesta que generan las simulaciones.\r\nSe pretende con ello poner un poco de luz en el gran desacuerdo científico que existe en relación con los efectos globales y a largo plazo de la pérdida del hielo Ártico en el contexto del cambio climático global. La ciencia tiene claro que el cambio climático se está produciendo, pero determinar con exactitud cuáles serán los impactos de cada variable en las diferentes zonas del planeta es un asunto controvertido.\r\nPor esa razón, el trabajo del equipo de investigadoras de Cvijanovic, trata de aislar solo los cambios en una de estas variables de la ecuación del cambio climático y ver cómo se comportan las simulaciones. Como afirma Desislava Petrova, última autora del estudio, comprender la influencia del fenómeno del deshielo del Ártico por separado ayudará a afinar las predicciones globales.\r\nLas simulaciones en los tres modelos muestran que la desaparición del hielo marino del Ártico reduce significativamente el albedo superficial de la región (la cantidad de luz solar reflejada por la superficie terrestre), pero también pone en contacto directo a la atmósfera y la superficie oceánica (antes aisladas por el hielo) y esto afecta a la salinidad del agua marina superficial. Esos cambios locales influyen en las conexiones del sistema atmósfera – hidrosfera y determinan cambios en las condiciones de varias regiones del hemisferio norte.\r\nUno de los efectos más sorprendentes que muestran, con mayor o menor intensidad, todas las simulaciones de un planeta sin hielo ártico es la reducción de las lluvias en la región de California, mientras que el Mediterráneo occidental se hace más lluvioso.\r\nEsto no significa que se pueda afirmar que el cambio climático vaya a tener ese efecto concreto. Recordemos que, en el cambio climático global, además de la pérdida del hielo del Ártico, intervienen muchos otros factores: el calentamiento de la atmósfera debido a las emisiones de gases de efecto invernadero, que a su vez produce cambios en la circulación atmosférica; cambios en las corrientes oceánicas; cambios en la vegetación; el deshielo de la Antártida, etc.\r\nNo obstante, pese a que este estudio no considera todo el sistema climático del planeta, es interesante observar que tras unas décadas en las que la extensión del hielo ártico en verano está en mínimos jamás registrados, se están produciendo patrones climáticos muy similares a las predicciones del estudio del equipo de Cvijanovic. Un ejemplo son las persistentes sequías que California está experimentando en los últimos años.\r\n', '2025-04-28', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE IF NOT EXISTS `users_data` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fnac` date NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `sexo` enum('Femenino','Masculino','Prefiero no responder') DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`idUser`, `nombre`, `apellidos`, `email`, `telefono`, `fnac`, `direccion`, `sexo`) VALUES
(8, 'María Aurora', 'Cabello Lopera', 'aurora@gmail.com', '666111666', '2025-04-28', 'AVENIDA DE LAS NACIONES, Nº 32, 3ºC', 'Femenino'),
(11, 'Juan', 'Montero', 'juan@gmail.com', '666333666', '2025-04-28', 'AVENIDA DE LAS NACIONES, Nº 32, 3ºC', 'Masculino'),
(12, 'Mario', 'Bretones Álvarez', 'mario@gmail.com', '666333666', '1986-06-01', 'Calle Narvaez, 9', 'Masculino'),
(14, 'Inma', 'Montero C', 'inma@gmail.com', '666555444', '1991-02-24', 'AVENIDA DE LAS NACIONES, Nº 32, 3ºC', 'Prefiero no responder'),
(15, 'Vero', 'Montero Cabello', 'vero@gmail.com', '666555444', '2000-01-01', 'AVENIDA DE LAS NACIONES, Nº 32, 3ºC', 'Femenino'),
(16, 'Paula', 'Moreno', 'paula@gmail.com', '654654654', '2011-02-09', 'AVENIDA DE LAS NACIONES, Nº 32, 3ºC', 'Prefiero no responder'),
(17, 'Víctor', 'Mesa', 'victor@gmail.com', '651651651', '2010-09-15', 'AVENIDA DE LAS NACIONES, Nº 32, 3ºC', 'Masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_login`
--

CREATE TABLE IF NOT EXISTS `users_login` (
  `idLogin` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `rol` enum('admin','user') NOT NULL,
  PRIMARY KEY (`idLogin`),
  UNIQUE KEY `idUser` (`idUser`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users_login`
--

INSERT INTO `users_login` (`idLogin`, `idUser`, `usuario`, `pass`, `rol`) VALUES
(1, 8, 'aurora@gmail.com', '$2y$10$zB/Pnasf96HYDW8b90S59ul/yYyn5XKWS9FslOHEG44v26nFYlkJq', 'user'),
(4, 11, 'juan@gmail.com', '$2y$10$J/63Rb68XHw404FtpnmEEuchj9hiWyM6evc.4c4jDsBmFqpZKcgMS', 'user'),
(5, 12, 'mario@gmail.com', '$2y$10$hcx3icoN/FF1IweqtExMcOp.zrvnMULx29gt3hMoxHfuHPcFHKlUa', 'user'),
(7, 14, 'inma@gmail.com', '$2y$10$JCIsIsIgLMziyjr7/SZHkuOOMTWR3riGUoukh39WsE5Dmgahh3vWG', 'user'),
(8, 15, 'vero@gmail.com', '$2y$10$zsdOJhruED6U2LZGtms9Eu2rOH6vs/G01ppeLnNz3QYb.tV4rsOnW', 'admin'),
(9, 16, 'paula@gmail.com', '$2y$10$juzZ8OfE4lWAp4ymn4asAeL.hKfL/CdyBE.YM1LMQC.tEegW0.5Oa', 'user'),
(10, 17, 'victor@gmail.com', '$2y$10$Us96z9LnrYxnKknihHt0SeANlCsaktMurwU2749yf7/IRandCR5ha', 'user');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_user_cita` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_user_imagenes` FOREIGN KEY (`idImagen`) REFERENCES `imagenes` (`idImagen`),
  ADD CONSTRAINT `fk_user_noticia` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `fk_user_data` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
