-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2022 at 07:03 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itdiscussionforum`
--

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `Title` varchar(100) NOT NULL,
  `Created` datetime NOT NULL,
  `Owner` varchar(100) NOT NULL,
  `TopicId` int NOT NULL AUTO_INCREMENT,
  `Likes` int NOT NULL DEFAULT '0',
  `Hot` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`TopicId`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`Title`, `Created`, `Owner`, `TopicId`, `Likes`, `Hot`) VALUES
('5G', '2022-03-22 00:46:26', 'teresa', 13, 0, 0),
('Quantum computing ', '2022-03-22 00:52:57', 'dhrubo', 15, 0, 0),
('Cybersecurity ', '2022-03-22 00:53:17', 'dhrubo', 16, 1, 0),
(' Internet of behaviors (IoB) ', '2022-03-22 00:53:41', 'dhrubo', 17, 0, 0),
('Human augmentation ', '2022-03-22 00:54:17', 'adity', 18, 0, 0),
('Distributed cloud ', '2022-03-22 00:54:37', 'adity', 19, 3, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
