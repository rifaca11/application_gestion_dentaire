-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 02:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rdv`
--

-- --------------------------------------------------------

--
-- Table structure for table `creneau`
--

CREATE TABLE `creneau` (
  `creneau_id` int(11) NOT NULL,
  `start_at` time DEFAULT NULL,
  `end_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `creneau`
--

INSERT INTO `creneau` (`creneau_id`, `start_at`, `end_at`) VALUES
(1, '10:00:00', '10:30:00'),
(2, '11:00:00', '11:30:00'),
(3, '14:00:00', '14:30:00'),
(4, '15:00:00', '15:30:00'),
(5, '16:00:00', '16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientId` int(11) NOT NULL,
  `patientFirstName` varchar(110) DEFAULT NULL,
  `patientLastName` varchar(110) DEFAULT NULL,
  `patientCIN` varchar(110) DEFAULT NULL,
  `patientEmail` varchar(110) DEFAULT NULL,
  `Reference` varchar(110) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientId`, `patientFirstName`, `patientLastName`, `patientCIN`, `patientEmail`, `Reference`) VALUES
(1, 'charifa', 'hniguira', 'HH112233', 'charifa@gmail.com', NULL),
(2, 'achraf', 'hniguira', 'HH223344', 'achraf@gmail.com', NULL),
(27, 'hicham', 'el kamouni', 'HH1287', 'hicham@gmail.com', 'hielHH4635219493cc32078808'),
(28, 'haytham', 'el houadi', 'HH1452', 'haytham@gmail.com', 'haelHH02299915119865ef3bd3'),
(29, 'idris', 'ait hadou', 'HH1492', 'idriss@gmail.com', 'idaiHH5f8cadaabe2d6c1c6dcc'),
(30, 'youssef', 'wakhidi', 'HH76757', 'youssef@gmail.com', 'yowaHH1c38ce5d551db1132207');

-- --------------------------------------------------------

--
-- Table structure for table `rdvs`
--

CREATE TABLE `rdvs` (
  `patientId_fk` int(11) DEFAULT NULL,
  `creneau_id_fk` int(11) DEFAULT NULL,
  `patient_subject` varchar(110) DEFAULT NULL,
  `c_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rdv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rdvs`
--

INSERT INTO `rdvs` (`patientId_fk`, `creneau_id_fk`, `patient_subject`, `c_date`, `created_at`, `rdv_id`) VALUES
(1, 4, 'sujet1', '2022-04-01', '2022-04-03 21:31:49', 3),
(1, 2, 'sujet2', '2022-04-02', '2022-04-03 21:31:41', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creneau`
--
ALTER TABLE `creneau`
  ADD PRIMARY KEY (`creneau_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientId`);

--
-- Indexes for table `rdvs`
--
ALTER TABLE `rdvs`
  ADD PRIMARY KEY (`rdv_id`),
  ADD KEY `creneau_id_fk` (`creneau_id_fk`) USING BTREE,
  ADD KEY `patientId_fk` (`patientId_fk`,`creneau_id_fk`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creneau`
--
ALTER TABLE `creneau`
  MODIFY `creneau_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `rdvs`
--
ALTER TABLE `rdvs`
  MODIFY `rdv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rdvs`
--
ALTER TABLE `rdvs`
  ADD CONSTRAINT `rdvs_ibfk_1` FOREIGN KEY (`patientId_fk`) REFERENCES `patient` (`patientId`),
  ADD CONSTRAINT `rdvs_ibfk_2` FOREIGN KEY (`creneau_id_fk`) REFERENCES `creneau` (`creneau_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
