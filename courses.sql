-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Apr 2024 um 10:59
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `tutoring_service`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `university` varchar(50) DEFAULT NULL,
  `roomNumb` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `teacher` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `units` varchar(100) DEFAULT NULL,
  `availability` enum('avaiable','not avaiable') DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `courses`
--

INSERT INTO `courses` (`id`, `subject`, `university`, `roomNumb`, `date`, `teacher`, `email`, `picture`, `language`, `duration`, `units`, `availability`, `name`) VALUES
(1, 'Mathematics', 'ABC University', 'Room 101', NULL, 'Dr. Smith', 'alice.smith@example.com', 'math_picture.jpg', 'English', '60', '3', 'avaiable', NULL),
(2, 'Computer Science', 'XYZ College', 'Room 201', NULL, 'Prof. Johnson', 'prof.jhonson@example.com', 'cs_picture.jpg', 'English', '90', '4', NULL, NULL),
(3, 'Physics', '123 Institute', 'Room 301', NULL, 'Prof. Williams', 'mathias.williams@gmail.com', 'physics_picture.jpg', 'English', '75', '3', NULL, NULL),
(4, 'Literature', 'DEF School', 'Room 102', NULL, 'Ms. Brown', 'emily.brown@gmail.com', 'lit_picture.jpg', 'English', '45', '2', NULL, NULL),
(5, 'History', 'GHI University', 'Room 202', NULL, 'Dr. Davis', 'christian.davis@gmail.com', 'history_picture.jpg', 'English', '60', '3', NULL, NULL),
(6, 'Biology', 'MNO College', 'Room 302', NULL, 'Dr. Martinez', 'rodrigo.martinez@hotmail.com', 'bio_picture.jpg', 'English', '60', '3', NULL, NULL),
(7, 'Chemistry', 'PQR Institute', 'Room 103', NULL, 'Prof. Thompson', '	\r\njerry.thompson@gmail.com', 'chem_picture.jpg', 'English', '90', '4', NULL, NULL),
(8, 'Geography', 'STU School', 'Room 203', NULL, 'Ms. Garcia', 'emma.garcia@example.com', 'geo_picture.jpg', 'English', '45', '2', NULL, NULL),
(9, 'Economics', 'VWX College', 'Room 303', NULL, 'Dr. Robinson', 'karin.robinson@gmail.com', 'eco_picture.jpg', 'English', '75', '3', NULL, NULL),
(10, 'Art', 'YZA University', 'Room 104', NULL, 'Prof. Lee', '	\r\nyung.lee@gmail.com', 'art_picture.jpg', 'English', '60', '3', NULL, NULL),
(11, 'Biology', 'university of vienna', 'A293', '2024-04-25 12:00:00', 'Dr.Smith', 'alice.smith@example.com', 'defaultPic.jpg', 'English', '120', '3', 'avaiable', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
