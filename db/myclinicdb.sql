-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2024 at 02:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myclinicdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `admin_id` int(3) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pw` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `admin_email`, `admin_pw`) VALUES
(6, 'joanchoo2201@hotmail.com', '5d88259c5bb0390f6ae3bf8db3d9ec0564317dce');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `p_name` varchar(30) NOT NULL,
  `p_email` varchar(30) NOT NULL,
  `p_phone` int(20) NOT NULL,
  `p_address` varchar(50) NOT NULL,
  `p_icNo` int(30) NOT NULL,
  `p_date_reg` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `p_id` int(11) NOT NULL,
  `p_image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`p_name`, `p_email`, `p_phone`, `p_address`, `p_icNo`, `p_date_reg`, `p_id`, `p_image`) VALUES
('Ahmad bin Ismail', 'ahmad.ismail@example.com', 123456789, '123 Jalan ABC, Kuala Lumpur', 880101, '2024-05-07 16:00:00.000000', 1, 'patient4.jpg'),
('Siti binti Abdullah', 'siti.abdullah@example.com', 198765432, '456 Jalan XYZ, Selangor', 900202, '2024-05-07 16:00:00.000000', 2, ''),
('Mohammad bin Yusof', 'mohammad.yusof@example.com', 178901234, '789 Jalan DEF, Penang', 750303, '2024-05-07 16:00:00.000000', 3, 'mohammad_yusof.jpg'),
('Noraini binti Lim', 'noraini.lim@example.com', 167890123, '101 Jalan GHI, Johor', 820404, '2024-05-07 16:00:00.000000', 4, 'patient4.jpg'),
('Kumar a/l Raj', 'kumar.raj@example.com', 134567890, '222 Jalan JKL, Perak', 870505, '2024-05-07 16:00:00.000000', 5, 'kumar_raj.jpg'),
('Wong Siew Mei', 'siewmei.wong@example.com', 112345678, '333 Jalan MNO, Melaka', 800606, '2024-05-07 16:00:00.000000', 6, 'siewmei_wong.jpg'),
('Tan Ah Kow', 'ahkow.tan@example.com', 145678901, '444 Jalan PQR, Pahang', 760707, '2024-05-07 16:00:00.000000', 7, 'ahkow_tan.jpg'),
('Lee Siew Ling', 'siewling.lee@example.com', 156789012, '555 Jalan STU, Sabah', 830808, '2024-05-07 16:00:00.000000', 8, 'siewling_lee.jpg'),
('Ganesh a/l Suppiah', 'ganesh.suppiah@example.com', 167890123, '666 Jalan VWX, Sarawak', 790909, '2024-05-07 16:00:00.000000', 9, 'ganesh_suppiah.jpg'),
('Kaur Jasvinder', 'jasvinder.kaur@example.com', 178901234, '777 Jalan YZA, Kedah', 780101, '2024-05-07 16:00:00.000000', 10, 'jasvinder_kaur.jpg'),
('Lim Ah Seng', 'ahseng.lim@example.com', 189012345, '888 Jalan BCD, Kelantan', 840202, '2024-05-07 16:00:00.000000', 11, 'ahseng_lim.jpg'),
('Rajesh a/l Muthu', 'rajesh.muthu@example.com', 190123456, '999 Jalan EFG, Terengganu', 810303, '2024-05-07 16:00:00.000000', 12, 'rajesh_muthu.jpg'),
('Chin Mei Ling', 'meiling.chin@example.com', 123456789, '111 Jalan HIJ, Negeri Sembilan', 860404, '2024-05-07 16:00:00.000000', 13, 'meiling_chin.jpg'),
('Chong Kok Weng', 'kokweng.chong@example.com', 134567890, '222 Jalan KLM, Johor', 770505, '2024-05-07 16:00:00.000000', 14, 'kokweng_chong.jpg'),
('Nurul Ain binti Sulaiman', 'nurulain.sulaiman@example.com', 145678901, '333 Jalan NOP, Perlis', 800606, '2024-05-07 16:00:00.000000', 15, 'nurulain_sulaiman.jpg'),
('Lim Swee Peng', 'sweepeng.lim@example.com', 156789012, '444 Jalan QRS, Perak', 790707, '2024-05-07 16:00:00.000000', 16, 'sweepeng_lim.jpg'),
('Ahmad bin Haji Abdullah', 'ahmad.abdullah@example.com', 167890123, '555 Jalan TUV, Kuala Lumpur', 830808, '2024-05-07 16:00:00.000000', 17, 'ahmad_abdullah.jpg'),
('Tan Mei Ling', 'meiling.tan@example.com', 178901234, '666 Jalan WXY, Selangor', 800909, '2024-05-07 16:00:00.000000', 18, 'meiling_tan.jpg'),
('Kumaresan a/l Suppiah', 'kumaresan.suppiah@example.com', 189012345, '777 Jalan YZA, Penang', 750101, '2024-05-07 16:00:00.000000', 19, 'kumaresan_suppiah.jpg'),
('Lau Ah Seng', 'ahseng.lau@example.com', 190123456, '888 Jalan BCD, Perak', 820202, '2024-05-07 16:00:00.000000', 20, 'ahseng_lau.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
