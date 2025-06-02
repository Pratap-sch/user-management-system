-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2025 at 11:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db4`
--

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(555) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `dob` date NOT NULL,
  `age` int(10) NOT NULL,
  `role` varchar(50) NOT NULL,
  `asc_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`uid`, `name`, `lname`, `email`, `password`, `mobile`, `address`, `dob`, `age`, `role`, `asc_id`) VALUES
(1, 'Jotika', 'Roy', 'a9549570@gmail.com', '$2y$10$W4vz3SthlBcnvpBl1FeGe.hW.p24viVsifzWDqQRh5cVQbdGRDC6O', 7586974397, '', '0000-00-00', 0, 'super_admin', 0),
(2, 'Bikki ', 'Paul', 'bikkipaul1234@gmail.com', '$2y$10$vGG5MePyy3C.5IqRja2VCeU4vVlx4AE2zOpzHHke2UVWeauAPaHmq', 7319052004, '', '0000-00-00', 0, 'super_admin', 0),
(3, 'Jotika', 'Roy', 'a9549570@gmail.com', '$2y$10$W4vz3SthlBcnvpBl1FeGe.hW.p24viVsifzWDqQRh5cVQbdGRDC6O', 7586974397, '', '0000-00-00', 0, 'super_admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
