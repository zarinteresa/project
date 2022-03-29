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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `PostText` longtext NOT NULL,
  `Created` datetime NOT NULL,
  `Owner` varchar(100) NOT NULL,
  `PostId` int NOT NULL DEFAULT '0',
  `TopicId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostText`, `Created`, `Owner`, `PostId`, `TopicId`) VALUES
('Quantum computing, a form of computing that uses the power of quantum phenomena such as superposition and quantum entanglement, is the next noteworthy technology trend.   Because of its capability to instantly question, track, interpret, and act on data, regardless of source, this incredible technology trend also includes preventing the spread of the coronavirus and developing potential vaccines.   Quantum computing is now being used in banking and finance to monitor credit risk, perform high-frequency trading, and detect fraud. Quantum computers are now several times faster than traditional computers, including those from well-known companies', '2022-03-22 00:52:57', 'dhrubo', 0, 15),
('Cybersecurity does not seem to be cutting-edge technology, but it progresses at the same rate as other technologies. This is partly due to the constant emergence of new threats.   Malicious hackers attempting to gain unauthorized access to data would not give up quickly, and they will continue to find ways to avoid even the most stringent protection measures. It\'s partly due to the adoption of modern technologies to improve defense.   Since Cybersecurity will extend to guard against hackers as long as we have them, Cybersecurity will remain a popular technology.', '2022-03-22 00:53:17', 'dhrubo', 0, 16),
('If you\'ve heard of the Internet of Things (IoT), you should know that the IoT extends to the Internet of behavior as well.   The Internet of Things (IoT) is concerned with using data and insights to influence behavior. IoT devices are possible as massive databases for Internet of behavior (IoB) paradigms.   Businesses will be able to follow customer behavior and use IoB to benefit their respective channels with the aid of IoB. For example, a health-tracking app may collect information about your physical activity routine, diet, sleep, and other habits.   This information can be used to encourage more behavioral improvement, such as by creating personalized health plans', '2022-03-22 00:53:41', 'dhrubo', 0, 17),
('Human augmentation is a broad term that encompasses innovations that seek to improve human abilities and productivity.   Physical augmentation, such as prosthetics, AR lenses, and RFID tags infused inside humans, are all part of the field of human augmentation.  This can aid in the enhancement of human cognition, perception, and action abilities. This is accomplished by sensing and actuation technology, information fusion and fission, and artificial intelligence.', '2022-03-22 00:54:18', 'adity', 0, 18),
('The Distributed Cloud technology trend is poised to take Cloud Computing to new heights. It is concerned with distributing public cloud resources to various geographical locations, processes, updates, delivery, and other relevant activities being handled centrally by the original public cloud provider.   Instead of offering a centralized solution, it would assist in meeting the service needs of individual cloud locations separately.   Meanwhile, companies would undoubtedly benefit from this technological trend by decreasing latency, reducing the risk of data loss, and lowering costs.  Technologies such as Artificial Intelligence (AI), the Internet of Things (IoT), and others that involve processing large amounts of data in real-time will benefit from the introduction of Distributed Cloud technology.', '2022-03-22 00:54:38', 'adity', 0, 19),
('gggg', '2022-03-29 10:37:59', 'teresa', 0, 19),
('hi\r\n', '2022-03-29 12:10:21', 'teresa', 0, 19),
('helo adity', '2022-03-29 12:31:08', 'teresa', 0, 19),
('hello dhrubo', '2022-03-29 12:32:01', 'teresa', 0, 19),
('whta', '2022-03-29 12:33:35', 'teresa', 0, 19);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
