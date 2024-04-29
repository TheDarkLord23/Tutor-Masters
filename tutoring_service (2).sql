-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Apr 2024 um 11:01
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
CREATE DATABASE IF NOT EXISTS `tutoring_service` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tutoring_service`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `fk_course_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `bookings`
--

INSERT INTO `bookings` (`id`, `fk_course_id`, `fk_user_id`) VALUES
(2, 1, 14),
(1, 2, 14),
(10, 1, 15),
(8, 3, 15),
(4, 4, 15),
(5, 5, 15),
(7, 7, 15),
(11, 8, 15),
(6, 9, 15),
(9, 10, 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `courses`
--

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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `fk_course_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `review`
--

INSERT INTO `review` (`id`, `rating`, `comment`, `date`, `fk_course_id`, `fk_user_id`) VALUES
(13, 5, 'best course ever', '2024-04-25 00:00:00', 2, 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `secondName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `Status` enum('user','admin','trainer') DEFAULT 'user',
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `firstName`, `secondName`, `email`, `password`, `address`, `phoneNumber`, `Status`, `picture`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123123', '123 Main St, City', '123-456-7890', 'user', NULL),
(2, 'Alice', 'Smith', 'alice.smith@example.com', '123123', '456 Elm St, Town', '456-789-0123', 'trainer', NULL),
(6, 'Prof.', 'Jhonson', 'prof.jhonson@example.com', '123123', '321 Cedar Ln, Township', '321-098-7654', 'trainer', NULL),
(7, 'Kevin', 'Taylor', 'kevin.taylor@example.com', '123123', '456 Birch Blvd, Hamlet', '456-789-1230', 'user', NULL),
(8, 'Mrs.', 'Garcia', 'emma.garcia@example.com', '123123', '789 Spruce Dr, Manor', '789-012-3456', 'trainer', NULL),
(9, 'James', 'Lee', 'james.lee@example.com', '123123', '123 Fir Pl, Ranch', '123-456-7890', 'user', NULL),
(10, 'Sophia', 'Rodriguez', 'sophia.rodriguez@example.com', '123123', '456 Aspen Ct, Farm', '456-789-0123', 'user', NULL),
(12, 'mario', 'Geremicca', 'mario@gmail.com', '', 'sfasfga', '2561561', 'user', 'defaultPic.jpg'),
(13, 'Sandro', 'Geremicca', 'sandro@gmail.com', '', 'straße1', '06507845962', 'user', 'defaultPic.jpg'),
(14, 'mattia', 'Geremicca', 'mattia@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'sdfsdf', '1561564', 'user', 'defaultPic.jpg'),
(15, 'roberto', 'geremicca', 'nando@aon.at', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '5asfasf', '5564564', 'user', 'defaultPic.jpg'),
(16, 'Mathias', 'Williams', 'mathias.williams@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Schulstraße1', '0648055416', 'trainer', 'defaultPic.jpg'),
(17, 'Emily', 'Brown', 'emily.brown@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Schulstraße5', '05648975152', 'trainer', 'defaultPic.jpg'),
(18, 'Jerry', 'Thompson', 'jerry.thompson@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Schönwiesenweg52', '0589155525', 'trainer', 'defaultPic.jpg'),
(19, 'Karin', 'Robinson', 'karin.robinson@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Feldweg 71', '05489547845', 'trainer', 'defaultPic.jpg'),
(20, 'Yung', 'Lee', 'yung.lee@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Wildschönau12', '048956842252', 'trainer', 'defaultPic.jpg'),
(21, 'Rodriogo', 'Martinez', 'rodrigo.martinez@hotmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'straße12', '06507845962', 'trainer', 'defaultPic.jpg'),
(22, 'Christian', 'Davis', 'christian.davis@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Müllergasse 9', '0670554895', 'trainer', 'defaultPic.jpg');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_booking` (`fk_user_id`,`fk_course_id`),
  ADD KEY `fk_course_id` (`fk_course_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indizes für die Tabelle `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course_id` (`fk_course_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`fk_course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`fk_course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
