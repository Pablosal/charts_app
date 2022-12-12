-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2022 a las 23:43:17
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; START TRANSACTION;
SET time_zone = "+00:00"; /*!40101
SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */; /*!40101
SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */; /*!40101
SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */; /*!40101
SET NAMES utf8mb4 */;
--
-- Base de datos: `respuestas_encuesta`
--
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` ( `food` varchar(25) NOT NULL, `exercise` varchar(25) NOT NULL, `drinks` varchar(25) NOT NULL, `follow_up` varchar(2) NOT NULL, `fruit` varchar(25) NOT NULL, `id` int(11) NOT NULL ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `respuestas`
--
INSERT INTO `respuestas` (`food`, `exercise`, `drinks`, `follow_up`, `fruit`, `id`) VALUES ('Comida Chatarra', '0 Horas', 'mas de un litro', 'si', '1 a 2', 12), ('Comida Chatarra', '0 Horas', 'mas de un litro', 'si', '1 a 2', 13), ('Comida Chatarra', '0 Horas', 'mas de un litro', 'si', '1 a 2', 14), ('Mas de 1', '1 Hora', 'mas de un litro', 'no', 'ninguna', 15), ('Mas de 1', '1 Hora', 'mas de un litro', 'no', 'ninguna', 16), ('Comida Chatarra', '0 Horas', 'mas de un litro', 'si', '1 a 2', 17), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'si', 'ninguna', 18), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'no', '1 a 2', 19), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'no', '1 a 2', 20), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'no', '1 a 2', 21), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'no', '1 a 2', 22), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'no', '1 a 2', 23), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'no', '1 a 2', 24), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'no', '1 a 2', 25), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'si', '1 a 2', 26), ('Carnes y verduras', '1 Hora', 'Mas de 2 Litros', 'si', '1 a 2', 27), ('Carnes y verduras', '1 Hora', 'Mas de 2 Litros', 'si', '1 a 2', 28), ('Carnes y verduras', '2 o mas horas', 'Mas de 2 Litros', 'no', 'ninguna', 29), ('Carnes y verduras', '2 o mas horas', 'Mas de 2 Litros', 'si', 'ninguna', 30), ('Carnes y verduras', '2 o mas horas', 'Mas de 2 Litros', 'si', 'ninguna', 31), ('Carnes y verduras', '2 o mas horas', 'Mas de 2 Litros', 'si', 'ninguna', 32), ('Carnes y verduras', '2 o mas horas', 'Mas de 2 Litros', 'si', 'ninguna', 33), ('Comida Chatarra', '2 o mas horas', 'Mas de 2 Litros', 'no', 'ninguna', 34), ('Comida Chatarra', '2 o mas horas', 'mas de un litro', 'si', 'ninguna', 35), ('Comida Chatarra', '2 o mas horas', 'mas de un litro', 'si', 'ninguna', 36), ('Comida Chatarra', '2 o mas horas', 'mas de un litro', 'si', 'ninguna', 37), ('Comida Chatarra', '2 o mas horas', 'mas de un litro', 'si', 'ninguna', 38), ('Legumbres', '1 Hora', 'mas de un litro', 'no', 'ninguna', 39), ('Legumbres', '1 Hora', 'una Cerveza', 'si', 'ninguna', 40), ('Legumbres', '1 Hora', 'una Cerveza', 'si', 'ninguna', 41), ('Legumbres', '1 Hora', 'una Cerveza', 'si', 'ninguna', 42), ('Comida Chatarra', '1 Hora', 'una Cerveza', 'si', 'ninguna', 43), ('Comida Chatarra', '1 Hora', 'mas de un litro', 'si', 'Mas de 1', 44), ('Legumbres', '0 Horas', 'mas de un litro', 'no', '1 a 2', 45), ('Carnes y verduras', '1 Hora', 'Mas de 2 Litros', 'no', 'Mas de 1', 46);
--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `respuestas`
--

ALTER TABLE `respuestas` ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `respuestas`
--

ALTER TABLE `respuestas` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 47; COMMIT; /*!40101

SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */; /*!40101
SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */; /*!40101
SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
-- Query para contar las veces de cada elemento
SELECT  COUNT(if(food = 'Comida Chatarra',1,null))     AS fastFood
       ,COUNT(if(food = 'Carnes y verduras',1,null))   AS vegetablesAndMeat
       ,COUNT(if(food = 'Legumbres',1,null))           AS legumes
       ,COUNT(if(fruit = 'ninguna',1,null))            AS noFruits
       ,COUNT(if(fruit = '1 a 2',1,null))              AS oneOrMore
       ,COUNT(if(fruit = 'Mas de 1',1,null))           AS moreThanOne
       ,COUNT(if(exercise = '0 Horas',1,null))         AS dontDoExercise
       ,COUNT(if(exercise = '1 Hora',1,null))          AS oneHour
       ,COUNT(if(exercise = '2 o mas horas',1,null))   AS moreThantwo
       ,COUNT(if(drinks = 'Menos de un litro',1,null)) AS lessThanOne
       ,COUNT(if(drinks = 'Mas de un litro',1,null))   AS moreThanOne
       ,COUNT(if(drinks = 'Mas de 2 litros',1,null))   AS moreThantwo
       ,COUNT(if(follow_up = 'si',1,null))             AS wantFollowUp
       ,COUNT(if(follow_up = 'no',1,null))             AS doesntwantFollowUp
FROM respuestas;