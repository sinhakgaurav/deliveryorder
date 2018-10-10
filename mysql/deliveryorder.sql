-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2018 at 09:24 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deliveryorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `distance`
--

CREATE TABLE `distance` (
  `id` int(11) NOT NULL,
  `start_latitude` varchar(25) NOT NULL,
  `start_longitude` varchar(25) NOT NULL,
  `end_latitude` varchar(25) NOT NULL,
  `end_longitude` varchar(25) NOT NULL,
  `distance` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distance`
--

INSERT INTO `distance` (`id`, `start_latitude`, `start_longitude`, `end_latitude`, `end_longitude`, `distance`) VALUES
(1, '28.704060', '77.102493', '28.535517', '77.391029', '46.732 Km'),
(2, '28.704060', '77.102493', '28.535517', '77.391029', '46.732 Km'),
(3, '28.704060', '77.102493', '28.535517', '77.391029', '46.732 Km'),
(4, '28.704060', '77.102493', '28.535517', '77.391029', '46.732 Km'),
(5, '28.704060', '77.102493', '28.535517', '77.391029', '46.732 Km'),
(6, '28.704060', '77.102493', '28.535517', '77.391029', '46.732 Km'),
(7, '28.704060', '77.102493', '28.535517', '77.391029', '46.732 Km'),
(8, '28.704060', '77.102493', '28.535517', '77.391029', '46.732 Km'),
(9, '28.704060', '77.102493', '29.535517', '77.391029', '128.287 Km'),
(10, '28.704061', '77.102498', '28.535527', '77.391049', '46.732 Km'),
(11, '28.704061', '77.102493', '28.535527', '77.391044', '46.732 Km'),
(12, '28.704061', '77.102493', '28.535517', '77.391044', '46.732 Km'),
(13, '28.704060', '77.102493', '28.535517', '77.391044', '46.732 Km'),
(14, '28.704060', '77.102493', '28.535512', '77.391044', '46.732 Km'),
(15, '28.704060', '77.102493', '28.535510', '77.391044', '46.732 Km'),
(16, '28.704060', '77.102493', '22.535510', '77.391044', '912.242 Km'),
(17, '38.704060', '77.102493', '28.535517', '77.391029', '0 Km'),
(18, '31.704060', '77.102493', '28.535517', '77.391029', '484.934 Km'),
(19, '34.704060', '77.102493', '28.535517', '77.391029', '0 Km'),
(20, '98.704060', '77.102493', '28.535517', '77.391029', '0 Km'),
(21, '18.704060', '77.102493', '28.535517', '77.391029', '1509.161 Km'),
(22, '68.704060', '77.102493', '28.535517', '77.391029', '0 Km'),
(23, '28.707090', '77.102493', '28.535517', '77.391029', '46.586 Km'),
(24, '28.707090', '77.102493', '28.599017', '77.391029', '45.433 Km');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `distance` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `distance`) VALUES
(1, 1, '46.732 Km'),
(2, 1, '46.732 Km'),
(3, 1, '46.732 Km'),
(4, 1, '46.732 Km'),
(5, 0, '46.732 Km'),
(6, 1, '46.732 Km'),
(7, 0, '46.732 Km'),
(8, 0, ''),
(9, 0, '46.732 Km'),
(10, 0, '128.287 Km'),
(11, 0, '46.732 Km'),
(12, 0, '46.732 Km'),
(13, 0, '46.732 Km'),
(14, 0, '46.732 Km'),
(15, 1, '46.732 Km'),
(16, 1, '46.732 Km'),
(17, 0, '46.732 Km'),
(18, 0, '46.732 Km'),
(19, 1, '46.732 Km'),
(20, 0, '46.732 Km'),
(21, 0, '46.732 Km'),
(22, 0, '46.732 Km'),
(23, 0, '46.732 Km'),
(24, 1, '46.732 Km'),
(25, 0, '912.242 Km'),
(26, 0, '0 Km'),
(27, 0, '0 Km'),
(28, 0, '0 Km'),
(29, 0, '0 Km'),
(30, 0, '0 Km'),
(31, 0, '0 Km'),
(32, 0, '0 Km'),
(33, 0, '484.934 Km'),
(34, 0, '484.934 Km'),
(35, 0, '0 Km'),
(36, 0, '0 Km'),
(37, 0, '0 Km'),
(38, 0, '0 Km'),
(39, 0, '0 Km'),
(40, 0, '0 Km'),
(41, 0, '1509.161 Km'),
(42, 0, '0 Km'),
(43, 0, '0 Km'),
(44, 0, '0 Km'),
(45, 0, '1509.161 Km'),
(46, 0, '46.732 Km'),
(47, 0, '46.586 Km'),
(48, 0, '45.433 Km');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distance`
--
ALTER TABLE `distance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distance`
--
ALTER TABLE `distance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
