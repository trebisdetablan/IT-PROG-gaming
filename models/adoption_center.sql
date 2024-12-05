-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 02:18 PM
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
-- Database: `adoption_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `pet_id` int(16) NOT NULL,
  `username` varchar(21) NOT NULL,
  `accepted` int(1) NOT NULL, 
  `method` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoptions`
--

INSERT INTO `adoptions` (`pet_id`, `username`, `accepted`, `method`, `date`, `time`) 
VALUES (2, 'yoshi', 1, 'Pick Up', '2024-12-15', '14:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `hearts`
--

CREATE TABLE `hearts` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `username` varchar(21) NOT NULL,
  `pet_id` int(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hearts`
--

INSERT INTO `hearts` (`id`, `username`, `pet_id`) VALUES
(1, 'yoshi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pet_info`
--

CREATE TABLE `pet_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  `breed` varchar(32) NOT NULL,
  `availability` int(1) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `personality` varchar(64) NOT NULL,
  `coat` varchar(512) NOT NULL,
  `eyes` varchar(512) NOT NULL,
  `image_url` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_info`
--

INSERT INTO `pet_info` (`id`, `name`, `type`, `breed`, `availability`, `age`, `gender`, `personality`, `coat`, `eyes`, `image_url`) VALUES
(1, 'Peekaboo', 'Cat', 'Domestic Cat', 1, 3, 'M', 'Friendly', 'Gray, black, and white with black stripes and white paws', 'Bright yellow-green', '../public/images/Peekaboo.png'),
(2, 'Hansolo', 'Cat', 'Domestic Cat', 0, 2, 'M', 'Extraverted', 'Gray, black, and white with black stripes and white paws', 'Green', '../public/images/hansolo.png'),
(3, 'Periwinkle', 'Cat', 'Domestic Cat', 1, 3, 'F', 'Playful', 'White with black markings on the head and tail', 'Bright yellow', '../public/images/periwinkle.png'),
(4, 'Gustav', 'Dog', 'Bichon Frise', 0, 12, 'M', 'Playful', 'White', 'Brown', '../public/images/gustavo.png'),
(5, 'Chanel', 'Dog', 'Bichon Frise', 1, 15, 'F', 'Relaxed', 'White', 'Brown', '../public/images/chanel.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `username` varchar(21) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(64) NOT NULL,
  `phone_number` int(15) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `city` varchar(168) DEFAULT NULL,
  `is_admin` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`username`, `email`, `password`, `phone_number`, `address`, `zip_code`, `city`, `is_admin`) VALUES
('yoshi', 'yoshinoishibashi@gmail.com', '$2y$10$QkhNU2ufi1LZk8.cIxeX3OPa1JRmX25acvIQ1AoUW7nvj8hjwJRSm', 2147483647, 'Kata 204, Royal Palm Residences, Acacia Estates', '1639', 'Ususan, Taguig City', 0);

-- --------------------------------------------------------

-- AUTO_INCREMENT for dumped tables

--
-- AUTO_INCREMENT for table `pet_info`
--
ALTER TABLE `pet_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hearts`
--
ALTER TABLE `hearts`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
