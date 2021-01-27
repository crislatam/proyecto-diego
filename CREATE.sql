CREATE DATABASE `diego` /*!40100 DEFAULT CHARACTER SET utf8 */;

CREATE TABLE `restaurante` (
  `rut` varchar(45) NOT NULL,
  `primerNombre` varchar(45) NOT NULL,
  `segundoNombre` varchar(45) NOT NULL,
  `apellidoPaterno` varchar(45) NOT NULL,
  `apellidoMaterno` varchar(45) NOT NULL,
  `edad` int(11) NOT NULL,
  `celular` int(11) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `salud` varchar(45) NOT NULL,
  `temperatura` int(11) NOT NULL,
  `fechatiempoActual` datetime NOT NULL,
  UNIQUE KEY `fechatiempoActual_UNIQUE` (`fechatiempoActual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
