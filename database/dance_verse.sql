-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 11:35 PM
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
-- Database: `dance_verse`
--

-- --------------------------------------------------------

--
-- Table structure for table `dance`
--

CREATE TABLE `dance` (
  `id_dance` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `difficulty_level` int(10) NOT NULL,
  `dance_style` varchar(50) NOT NULL,
  `video_url` varchar(500) NOT NULL,
  `choreographer` varchar(300) NOT NULL,
  `duration` time NOT NULL,
  `music` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance`
--

INSERT INTO `dance` (`id_dance`, `title`, `difficulty_level`, `dance_style`, `video_url`, `choreographer`, `duration`, `music`) VALUES
(19, 'Gyuri Choreography', 3, 'Hip Hop', 'https://www.youtube.com/embed/xTxtLPhO2F8?si=CqKsBA0LylwJaP9J', 'MOVE Dance Studio', '00:00:42', 'Doja Cat - Woman'),
(20, 'Juana Choreography', 5, 'Other', 'https://www.youtube.com/embed/YXNlxXMMF44', 'Moshiee', '00:01:10', 'Unholy - Sam Smith'),
(32, 'Danni Heverin Jazz Class', 7, 'Other', 'https://www.youtube.com/embed/zh0bghmBLug?si=aff-st-RIToI8xoq', 'Danni Heverin', '00:01:08', '“Maneater” - Nelly Furtado');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(2, 'bajicmarina', '$2y$10$Ol5IoURAzD6AoSmKtRKW2uubxGc/cMtU.VGE2WQTuCgitNvcAEHKS'),
(4, 'mb_cyfr', '$2y$10$.7HSdg4XJw3mpACTPOHGG.7hErPszafBaRSG5P26eeKRnGap4AFvK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dance`
--
ALTER TABLE `dance`
  ADD PRIMARY KEY (`id_dance`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dance`
--
ALTER TABLE `dance`
  MODIFY `id_dance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
