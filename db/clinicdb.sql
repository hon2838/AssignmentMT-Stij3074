-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 03:31 PM
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
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `service_id` int(4) NOT NULL,
  `service_name` varchar(30) NOT NULL,
  `service_short_description` text NOT NULL,
  `service_description` text NOT NULL,
  `service_price` decimal(6,0) NOT NULL,
  `service_image_location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`service_id`, `service_name`, `service_short_description`, `service_description`, `service_price`, `service_image_location`) VALUES
(1, 'General Consultation', 'Basic health consultation with a general practitioner', 'A comprehensive health consultation with one of our experienced general practitioners, addressing any health concerns and providing expert advice on treatments and preventive care.', 50, 'general_consultation.jpg'),
(2, 'Pediatric Consultation', 'Health consultation for children', 'Specialized consultation services for children, providing comprehensive pediatric care from newborns to adolescents, including vaccinations, growth monitoring, and treatment of common illnesses.', 65, 'Pediatric_ Consultation.jpg'),
(3, 'Dental Cleaning', 'Professional teeth cleaning service', 'Professional dental cleaning service to remove plaque and tartar, polish teeth, and maintain oral hygiene. Includes a dental check-up to assess overall dental health.', 80, 'Dental_Cleaning.jpg'),
(4, 'Physical Therapy', 'Rehabilitation and physical therapy services', 'Personalized physical therapy sessions to help patients recover from injuries, surgeries, or manage chronic conditions. Includes tailored exercise programs, manual therapy, and patient education.', 70, 'Physical_Therapy.jpg'),
(5, 'Laboratory Testing', 'Comprehensive lab tests for diagnostics', 'A range of laboratory tests for diagnostic purposes, including blood tests, urine tests, and other specialized tests. Our state-of-the-art lab ensures accurate and timely results.', 100, 'Laboratory_Testing.jpg'),
(6, 'Vaccination', 'Immunization services', 'Administration of vaccines to prevent various infectious diseases. Includes consultation on vaccine schedules and management of vaccination records.', 30, 'Vaccination.jpg'),
(7, 'Cardiology Consultation', 'Specialist consultation for heart health', 'Expert cardiology consultation to assess and manage heart health. Includes diagnostic tests like ECG, stress tests, and personalized treatment plans for heart conditions.', 150, 'Cardiology.jpg'),
(8, 'Mental Health Counseling', 'Psychological counseling services', 'Confidential mental health counseling services to support emotional well-being. Includes therapy for anxiety, depression, stress management, and other mental health concerns.', 90, 'Mental Health Counseling.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `u_id` int(3) NOT NULL,
  `u_Name` varchar(50) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_Pw` varchar(40) NOT NULL,
  `u_PhoneNum` text NOT NULL,
  `u_Address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`u_id`, `u_Name`, `u_email`, `u_Pw`, `u_PhoneNum`, `u_Address`) VALUES
(9, 'HON JUN YOON', 'hon_jun_yoon@soc.uum.edu.my', '7ce0359f12857f2a90c7de465f40a95f01cb5da9', '0171234567', '123,\nPersiaran Paya Terubong 1,\n11900 Bayan Lepas, Pulau Pinang.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `u_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
