-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2024 a las 19:21:03
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
-- Base de datos: `transporte_escolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_transporte`
--

CREATE TABLE `registros_transporte` (
  `id` int(11) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `entre_calles` varchar(100) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` enum('Masculino','Femenino') NOT NULL,
  `lugar_nacimiento` varchar(100) DEFAULT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL,
  `curp` varchar(18) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `estatura` decimal(4,2) DEFAULT NULL,
  `tipo_sangre` varchar(3) DEFAULT NULL,
  `enfermedad_cronica` varchar(255) DEFAULT NULL,
  `servicio_medico` varchar(100) DEFAULT NULL,
  `alergia` varchar(100) NOT NULL,
  `correo_alumno` varchar(100) DEFAULT NULL,
  `apellido_paterno_tutor` varchar(50) NOT NULL,
  `apellido_materno_tutor` varchar(50) NOT NULL,
  `nombres_tutor` varchar(100) NOT NULL,
  `calle_tutor` varchar(100) NOT NULL,
  `entre_calles_tutor` varchar(100) DEFAULT NULL,
  `colonia_tutor` varchar(50) DEFAULT NULL,
  `municipio_tutor` varchar(50) DEFAULT NULL,
  `codigo_postal_tutor` varchar(10) DEFAULT NULL,
  `estado_civil_tutor` varchar(20) DEFAULT NULL,
  `fecha_nacimiento_tutor` date DEFAULT NULL,
  `telefono_tutor1` varchar(15) NOT NULL,
  `telefono_tutor2` varchar(15) DEFAULT NULL,
  `ocupacion_tutor` varchar(100) DEFAULT NULL,
  `curp_tutor` varchar(100) NOT NULL,
  `email_tutor` varchar(100) DEFAULT NULL,
  `ruta` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registros_transporte`
--
ALTER TABLE `registros_transporte`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registros_transporte`
--
ALTER TABLE `registros_transporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
