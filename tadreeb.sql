-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 10:14 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tadreeb`
--

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE `certification` (
  `ID_certification` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_workshop` int(10) NOT NULL,
  `attended` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trainess`
--

CREATE TABLE `trainess` (
  `username` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainess`
--

INSERT INTO `trainess` (`username`, `fullname`, `password`, `email`, `phoneNo`) VALUES
('1131810499', '', 'f30ec5fc330b31a5346368b8eaa4a388', 'n.alshouf@gmail.com', 0),
('vvvvv', '', '52c8263b953ed7d65e523cb458af62c3', 'nahidfawaz@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE `workshop` (
  `id_workshop1` int(10) NOT NULL,
  `id_workshop_provider` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `presenter` varchar(30) NOT NULL,
  `classification` varchar(255) NOT NULL,
  `target_group` varchar(30) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`id_workshop1`, `id_workshop_provider`, `title`, `presenter`, `classification`, `target_group`, `date`) VALUES
(1, 3, 'titileh', 'kxksk', 'ddjdj', 'jdk', '2020-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_provider`
--

CREATE TABLE `workshop_provider` (
  `id_provider` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workshop_provider`
--

INSERT INTO `workshop_provider` (`id_provider`, `username`, `department_name`, `email`, `password`) VALUES
(3, 'nahid', 'ناهد ', 'nafalmutairi@imamu.edu.sa', '112312');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`ID_certification`),
  ADD KEY `name` (`name`),
  ADD KEY `certification_ibfk_4` (`id_workshop`);

--
-- Indexes for table `trainess`
--
ALTER TABLE `trainess`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`id_workshop1`),
  ADD KEY `id_workshop` (`id_workshop_provider`) USING BTREE;

--
-- Indexes for table `workshop_provider`
--
ALTER TABLE `workshop_provider`
  ADD PRIMARY KEY (`id_provider`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certification`
--
ALTER TABLE `certification`
  MODIFY `ID_certification` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `workshop`
--
ALTER TABLE `workshop`
  MODIFY `id_workshop1` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `workshop_provider`
--
ALTER TABLE `workshop_provider`
  MODIFY `id_provider` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certification`
--
ALTER TABLE `certification`
  ADD CONSTRAINT `certification_ibfk_3` FOREIGN KEY (`name`) REFERENCES `trainess` (`username`),
  ADD CONSTRAINT `certification_ibfk_4` FOREIGN KEY (`id_workshop`) REFERENCES `workshop` (`id_workshop1`);

--
-- Constraints for table `workshop`
--
ALTER TABLE `workshop`
  ADD CONSTRAINT `workshop_ibfk_1` FOREIGN KEY (`id_workshop_provider`) REFERENCES `workshop_provider` (`id_provider`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
