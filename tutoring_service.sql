-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 03:50 PM
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
-- Database: `tutoring_service`
--
CREATE DATABASE IF NOT EXISTS `tutoring_service` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tutoring_service`;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `fk_course_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `university` varchar(50) DEFAULT NULL,
  `roomNumb` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `teacher` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `units` varchar(100) DEFAULT NULL,
  `availability` enum('avaiable','not avaiable') DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `subject`, `university`, `roomNumb`, `date`, `teacher`, `picture`, `language`, `duration`, `units`, `availability`, `name`, `fk_user_id`) VALUES
(1, 'Mathematics', 'ABC University', 'Room 101', NULL, 'Dr. Smith', 'https://cdn.pixabay.com/photo/2018/06/22/08/24/emotions-3490223_1280.jpg', 'English', '60', '3', 'avaiable', NULL, 12),
(2, 'Computer Science', 'XYZ College', 'Room 201', NULL, 'Prof. Johnson', 'https://cdn.pixabay.com/photo/2018/06/22/08/24/emotions-3490223_1280.jpg', 'English', '90', '4', NULL, NULL, 12),
(3, 'Physics', '123 Institute', 'Room 301', NULL, 'Prof. Williams', 'https://cdn.pixabay.com/photo/2018/06/22/08/24/emotions-3490223_1280.jpg', 'English', '75', '3', NULL, NULL, 12),
(4, 'Literature', 'DEF School', 'Room 102', NULL, 'Ms. Brown', 'https://cdn.pixabay.com/photo/2018/06/22/08/24/emotions-3490223_1280.jpg', 'English', '45', '2', NULL, NULL, 12),
(5, 'History', 'GHI University', 'Room 202', NULL, 'Dr. Davis', 'history_picture.jpg', 'English', '60', '3', NULL, NULL, NULL),
(6, 'Biology', 'MNO College', 'Room 302', NULL, 'Dr. Martinez', 'bio_picture.jpg', 'English', '60', '3', NULL, NULL, NULL),
(7, 'Chemistry', 'PQR Institute', 'Room 103', NULL, 'Prof. Thompson', 'chem_picture.jpg', 'English', '90', '4', NULL, NULL, NULL),
(8, 'Geography', 'STU School', 'Room 203', NULL, 'Ms. Garcia', 'geo_picture.jpg', 'English', '45', '2', NULL, NULL, NULL),
(9, 'Economics', 'VWX College', 'Room 303', NULL, 'Dr. Robinson', 'eco_picture.jpg', 'English', '75', '3', NULL, NULL, NULL),
(10, 'Art', 'YZA University', 'Room 104', NULL, 'Prof. Lee', 'art_picture.jpg', 'English', '60', '3', NULL, NULL, NULL),
(11, 'Biology', 'university of vienna', 'A293', '2024-04-25 12:00:00', 'Dr.Smith', 'defaultPic.jpg', 'English', '120', '3', 'avaiable', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `fk_course_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `secondName`, `email`, `password`, `address`, `phoneNumber`, `Status`, `picture`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123123', '123 Main St, City', '123-456-7890', 'user', NULL),
(2, 'Alice', 'Smith', 'alice.smith@example.com', '123123', '456 Elm St, Town', '456-789-0123', 'admin', NULL),
(3, 'Michael', 'Johnson', 'michael.johnson@example.com', '123123', '789 Oak St, Village', '789-012-3456', 'trainer', NULL),
(4, 'Emily', 'Brown', 'emily.brown@example.com', '123123', '987 Maple Ave, County', '987-654-3210', 'user', NULL),
(5, 'David', 'Martinez', 'david.martinez@example.com', '123123', '654 Pine Rd, Borough', '654-321-0987', 'admin', NULL),
(6, 'Sarah', 'Wilson', 'sarah.wilson@example.com', '123123', '321 Cedar Ln, Township', '321-098-7654', 'trainer', NULL),
(7, 'Kevin', 'Taylor', 'kevin.taylor@example.com', '123123', '456 Birch Blvd, Hamlet', '456-789-1230', 'user', NULL),
(8, 'Emma', 'Garcia', 'emma.garcia@example.com', '123123', '789 Spruce Dr, Manor', '789-012-3456', 'trainer', NULL),
(9, 'James', 'Lee', 'james.lee@example.com', '123123', '123 Fir Pl, Ranch', '123-456-7890', 'user', NULL),
(10, 'Sophia', 'Rodriguez', 'sophia.rodriguez@example.com', '123123', '456 Aspen Ct, Farm', '456-789-0123', 'user', NULL),
(11, 'Mario', 'Geremicca', 'mario@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'straße1', '05156161', 'user', 'defaultPic.jpg'),
(12, 'hassan', 'trainer', 'trainer@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'fuckoff nr1', '0000000001', 'trainer', 'defaultPic.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD KEY `fk_course_id` (`fk_course_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course_id` (`fk_course_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`fk_course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`fk_course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
