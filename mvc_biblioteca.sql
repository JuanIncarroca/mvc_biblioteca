-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 10:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc_biblioteca`
--

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

CREATE TABLE `autor` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ejemplar`
--

CREATE TABLE `ejemplar` (
  `Codigo` int(11) NOT NULL,
  `Localizacion` varchar(100) DEFAULT NULL,
  `CodigoLibro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `escribe`
--

CREATE TABLE `escribe` (
  `CodigoAutor` int(11) NOT NULL,
  `CodigoLibro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libro`
--

CREATE TABLE `libro` (
  `Codigo` int(11) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `Editorial` varchar(100) DEFAULT NULL,
  `Paginas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saca`
--

CREATE TABLE `saca` (
  `CodigoUsuario` int(11) NOT NULL,
  `CodigoEjemplar` int(11) NOT NULL,
  `FechaPrestamo` date NOT NULL,
  `FechaDevolucion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indexes for table `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `CodigoLibro` (`CodigoLibro`);

--
-- Indexes for table `escribe`
--
ALTER TABLE `escribe`
  ADD PRIMARY KEY (`CodigoAutor`,`CodigoLibro`),
  ADD KEY `CodigoLibro` (`CodigoLibro`);

--
-- Indexes for table `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`Codigo`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexes for table `saca`
--
ALTER TABLE `saca`
  ADD PRIMARY KEY (`CodigoUsuario`,`CodigoEjemplar`,`FechaPrestamo`),
  ADD KEY `CodigoEjemplar` (`CodigoEjemplar`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autor`
--
ALTER TABLE `autor`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ejemplar`
--
ALTER TABLE `ejemplar`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `libro`
--
ALTER TABLE `libro`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ejemplar`
--
ALTER TABLE `ejemplar`
  ADD CONSTRAINT `ejemplar_ibfk_1` FOREIGN KEY (`CodigoLibro`) REFERENCES `libro` (`Codigo`);

--
-- Constraints for table `escribe`
--
ALTER TABLE `escribe`
  ADD CONSTRAINT `escribe_ibfk_1` FOREIGN KEY (`CodigoAutor`) REFERENCES `autor` (`Codigo`),
  ADD CONSTRAINT `escribe_ibfk_2` FOREIGN KEY (`CodigoLibro`) REFERENCES `libro` (`Codigo`);

--
-- Constraints for table `saca`
--
ALTER TABLE `saca`
  ADD CONSTRAINT `saca_ibfk_1` FOREIGN KEY (`CodigoUsuario`) REFERENCES `usuario` (`Codigo`),
  ADD CONSTRAINT `saca_ibfk_2` FOREIGN KEY (`CodigoEjemplar`) REFERENCES `ejemplar` (`Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
