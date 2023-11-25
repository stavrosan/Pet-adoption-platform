-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 04:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be20_cr5_animal_adoption_stavrosanagnostakis`
--
CREATE DATABASE IF NOT EXISTS `be20_cr5_animal_adoption_stavrosanagnostakis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be20_cr5_animal_adoption_stavrosanagnostakis`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` varchar(20) NOT NULL,
  `vaccinated` tinyint(1) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `picture`, `location`, `description`, `size`, `vaccinated`, `breed`, `age`, `status`) VALUES
(1, 'Mini', 'hamster.jpg', '123 Main St', 'Playfool small hamster ', 'Small', 1, 'Hamster', 3, 'Available'),
(2, 'Homer', 'lab.jpg', '456 Oak St', 'Energetic large dog', 'Large', 1, 'Labrador', 5, 'Available'),
(3, 'Whiskers', 'catsiam.jpg', '789 Pine St', 'Playful small cat', 'Small', 1, 'Siamese cat', 2, 'Available'),
(4, 'Iggy', 'iguana.jpg', '101 Maple St', 'Colorful and exotic iguana', 'Small', 0, 'Iguana', 7, 'Available'),
(5, 'Spike', 'hedge.jpg', '202 Cedar St', 'Cautious small hedgehog', 'Small', 0, 'African Pygmy', 4, 'Available'),
(6, 'Lithan', 'turtle.jpg', '303 Birch St', 'Adventurous large turtle', 'Large', 1, 'Box Turtle', 10, 'Adopted'),
(7, 'Buggs', 'rabbit.jpg', '404 Elm St', 'Sweet small rabbit', 'Small', 1, 'Holland Lop', 1, 'Available'),
(8, 'Polly', 'macawparrot.jpg', '505 Walnut St', 'Intelegent macaw parrot', 'Small', 0, 'Macaw Parrot', 9, 'Adopted'),
(9, 'Nemo', 'fish.jpg', '606 Cedar St', 'Bright and vibrant small fish', 'Small', 0, 'Goldfish', 1, 'Available'),
(10, 'Coco', 'horse.jpg', '707 Oak St', 'Charming large horse', 'Large', 1, 'Quarter Horse', 12, 'Available'),
(11, 'Jack', 'olddog.jpg', '808 Pine St', 'Loving senior dog', 'Large', 1, 'German Shepherd', 9, 'Available'),
(12, 'Jinx', 'oldcat.jpg', '909 Maple St', 'Calm senior cat', 'Small', 1, 'Persian cat', 12, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `id` int(11) NOT NULL,
  `adoption_date` date NOT NULL,
  `fk_userid` int(11) NOT NULL,
  `fk_petid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `status` varchar(6) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `pass`, `status`) VALUES
(2, '', '', 'user1@user.com', 0, '', 'user_avatar.png', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'user'),
(3, '', '', 'user2@user.com', 0, '', 'user_avatar.png', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'user'),
(4, '', '', 'admin1@admin.com', 0, '', 'user_avatar.png', '076b3ad56a27f109d8414307c9be4e3c5ce9e724801d28617021de8b858e4027', 'adm'),
(9, 'ssj', 'ddcc', 'user4@user.com', 4334445, 'wddd', 'avatar_user.png', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userid` (`fk_userid`),
  ADD KEY `fk_petid` (`fk_petid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`fk_userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`fk_petid`) REFERENCES `animals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
