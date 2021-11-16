-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2020 at 07:47 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `admin_name`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE `certification` (
  `id_certification` int(10) NOT NULL,
  `id_trainess` int(10) NOT NULL,
  `id_workshop` int(10) NOT NULL,
  `attended` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`id_certification`, `id_trainess`, `id_workshop`, `attended`) VALUES
(31, 1, 3, 0),
(32, 4, 1, 0),
(33, 4, 11, 0),
(34, 13, 1, 1),
(35, 13, 17, 0),
(36, 1, 1, 1),
(37, 14, 19, 0),
(38, 14, 18, 0),
(39, 18, 18, 0),
(40, 20, 25, 0),
(41, 20, 20, 0),
(42, 18, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `target_class`
--

CREATE TABLE `target_class` (
  `class_id` int(2) NOT NULL,
  `class_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `target_class`
--

INSERT INTO `target_class` (`class_id`, `class_name`) VALUES
(1, 'طالبات البكالوريوس'),
(2, 'طالبات الماجستير'),
(3, 'اعضاء هيئة التدريس'),
(4, 'موظفات');

-- --------------------------------------------------------

--
-- Table structure for table `trainess`
--

CREATE TABLE `trainess` (
  `id_trainess` int(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainess`
--

INSERT INTO `trainess` (`id_trainess`, `fullname`, `username`, `password`, `email`) VALUES
(1, 'Nahid ', 'nahid', '202cb962ac59075b964b07152d234b70', 'nahid@gmail.com'),
(15, 'حصة', 'hessah', '25d55ad283aa400af464c76d713c07ad', 'hhhhh@hotmail.com'),
(18, '   ديما محمد', 'dema', '25d55ad283aa400af464c76d713c07ad', 'dema@gmail.com'),
(19, 'wala', 'walaa', '25d55ad283aa400af464c76d713c07ad', 'wala@hotmail.com'),
(20, 'سميه عبدالرحمن السريع', 'somayah', '25d55ad283aa400af464c76d713c07ad', 'somayah.s88@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE `workshop` (
  `id_workshop_provider` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `presenter` varchar(100) NOT NULL,
  `date_workshop` date NOT NULL,
  `time_workshop` time NOT NULL,
  `location` int(15) NOT NULL,
  `section_location` varchar(50) NOT NULL,
  `section_number` varchar(30) NOT NULL,
  `target_group` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `seats` int(5) NOT NULL,
  `reserved_seats` int(5) NOT NULL,
  `id_workshop` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`id_workshop_provider`, `title`, `description`, `presenter`, `date_workshop`, `time_workshop`, `location`, `section_location`, `section_number`, `target_group`, `seats`, `reserved_seats`, `id_workshop`) VALUES
(17, 'مقدمه عن الهوية الرقمية', 'الهوية الرقمية\r\n\r\nيوجد شهادة حضور', 'أ.حصه العجمي', '2020-04-23', '15:00:00', 324, 'تعليمية', '1c112', '', 48, 2, 20),
(13, 'تعلم أساسيات PHP', 'أساسيات PHP', 'أ.سميه السريع', '2020-04-22', '14:00:00', 324, 'تعليمية', '1c111', '', 49, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `workshop_provider`
--

CREATE TABLE `workshop_provider` (
  `id_provider` int(10) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workshop_provider`
--

INSERT INTO `workshop_provider` (`id_provider`, `department_name`, `username`, `password`, `email`, `status`) VALUES
(11, 'كلية أصول الدين', 'imam_nahid', '25d55ad283aa400af464c76d713c07ad', 'nahid@imamu.edu.sa', 1),
(12, 'كلية الطب', 'imam_maha', '25d55ad283aa400af464c76d713c07ad', 'maha@imamu.edu.sa', 1),
(13, 'كلية علوم الحاسب والمعلومات', 'imam_somayah', '25d55ad283aa400af464c76d713c07ad', 'somayah@imamu.edu.sa', 1),
(17, 'كلية علوم الحاسب والمعلومات', 'imam_hessah', '25d55ad283aa400af464c76d713c07ad', 'HAAAJMI@imamu.edu.sa', 1),
(18, 'مركز الدراسات والمعلومات', 'imam_lama', '25d55ad283aa400af464c76d713c07ad', 'lama@imamu.edu.sa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workshop_target_class`
--

CREATE TABLE `workshop_target_class` (
  `id_workshop` int(5) NOT NULL,
  `id_class` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workshop_target_class`
--

INSERT INTO `workshop_target_class` (`id_workshop`, `id_class`) VALUES
(1, 1),
(1, 2),
(3, 1),
(4, 2),
(4, 4),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(15, 1),
(15, 4),
(16, 1),
(16, 2),
(17, 2),
(17, 3),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`id_certification`);

--
-- Indexes for table `target_class`
--
ALTER TABLE `target_class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `trainess`
--
ALTER TABLE `trainess`
  ADD PRIMARY KEY (`id_trainess`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`id_workshop`);

--
-- Indexes for table `workshop_provider`
--
ALTER TABLE `workshop_provider`
  ADD PRIMARY KEY (`id_provider`);

--
-- Indexes for table `workshop_target_class`
--
ALTER TABLE `workshop_target_class`
  ADD PRIMARY KEY (`id_workshop`,`id_class`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certification`
--
ALTER TABLE `certification`
  MODIFY `id_certification` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `target_class`
--
ALTER TABLE `target_class`
  MODIFY `class_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trainess`
--
ALTER TABLE `trainess`
  MODIFY `id_trainess` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `workshop`
--
ALTER TABLE `workshop`
  MODIFY `id_workshop` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `workshop_provider`
--
ALTER TABLE `workshop_provider`
  MODIFY `id_provider` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
