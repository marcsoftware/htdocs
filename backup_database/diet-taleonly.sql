-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2020 at 07:31 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diet`
--

-- --------------------------------------------------------

--
-- Table structure for table `diet`
--

CREATE TABLE `diet` (
  `id` int(11) NOT NULL,
  `date` text,
  `name` text,
  `total_cals` varchar(100) DEFAULT NULL,
  `total_amount_label` text,
  `total_amount_unit` text,
  `amount_per_serv_unit` text,
  `amount_per_serv_label` text,
  `cal_per_serv` varchar(100) DEFAULT NULL,
  `customer_name` text,
  `custom_sort` decimal(30,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diet`
--

INSERT INTO `diet` (`id`, `date`, `name`, `total_cals`, `total_amount_label`, `total_amount_unit`, `amount_per_serv_unit`, `amount_per_serv_label`, `cal_per_serv`, `customer_name`, `custom_sort`) VALUES
(1, '2020/01/20', 'a', '1', 'undefined', '1.00', '1.00', 'undefined', '1', 'temp', '192844.00000'),
(2, '2020/01/20', 'a', '1', 'undefined', '1.00', '1.00', 'undefined', '1', 'bob', '192919.00000'),
(3, '2020/01/20', 'a', '1', 'undefined', '1.00', '1.00', 'undefined', '1', 'bob', '192921.00000'),
(4, '2020/01/20', 'a', '1', 'undefined', '1.00', '1.00', 'undefined', '1', 'bob', '192929.00000'),
(5, '2020/01/20', 'a', '1', 'undefined', '1.00', '1.00', 'undefined', '1', 'bob', '192944.00000'),
(6, '2020/01/22', 'a', '1', 'undefined', '1.00', '1.00', 'undefined', '1', 'bob', '193415.00000'),
(7, '2020/01/22', 'b', '1', 'undefined', '1.00', '1.00', 'undefined', '1', 'bob', '193601.00000'),
(8, '2020/01/22', 'marc', '100', 'cup', '1.00', '1.00', 'cup', '100', 'bob', '194102.00000'),
(9, '2020/01/22', 'marc', '100', 'cup', '1.00', '1.00', 'cup', '100', 'bob', '194102.00000'),
(10, '2020/01/22', 'marc', '100', 'cup', '1.00', '1.00', 'cup', '100', 'bob', '194206.00000'),
(11, '2020/01/22', 'marc', '100', 'cup', '1.00', '1.00', 'cup', '100', 'bob', '194403.00000'),
(12, '2020/01/22', 'marc', '100', 'cup', '1.00', '1.00', 'cup', '100', 'bob', '194418.00000'),
(13, '2020/01/22', 'marc', '100', 'cup', '1.00', '1.00', 'cup', '100', 'bob', '194723.00000'),
(14, '2020/01/22', 'marcmelcher', '100', 'cup', '1.00', '1.00', 'cup', '100', 'bob', '195016.00000'),
(15, '2020/01/22', 'marcmelcher', '100', 'cup', '1.00', '1.00', 'cup', '100', 'bob', '195235.00000'),
(16, '2020/01/22', 'marcmelcherdav', '100', 'cup', '1.00', '1.00', 'cup', '100', 'bob', '195239.00000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diet`
--
ALTER TABLE `diet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diet`
--
ALTER TABLE `diet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
