-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2023 at 07:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_37138427`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `username` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `postId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`username`, `content`, `postId`, `commentId`, `date`) VALUES
('treasuretomy', 'Hi Jasmine! Nice to meet you.', 1, 1, '2023-04-08 01:02:17'),
('coffeehousejazz', 'Hi treasure, what is your favourite food?', 1, 2, '2023-04-08 11:32:29'),
('coffeehousejazz', 'help! I need coffee cake now', 3, 3, '2023-04-08 11:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `postId`, `username`) VALUES
(1, 1, 'treasuretomy');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `username` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `postImage` blob DEFAULT NULL,
  `topic` varchar(100) NOT NULL,
  `postId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `title` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`username`, `content`, `postImage`, `topic`, `postId`, `date`, `title`) VALUES
('coffeehousejazz', 'Hello everyone! My name is Jasmine. I just joined this blog and just wanted to say hello! Nice to meet you all, I hope we can be friends :)', NULL, 'Welcome', 1, '2023-04-06 22:56:59', 'Hello!'),
('treasuretomy', 'Hello!! My name is Takara', NULL, 'Welcome', 2, '2023-04-06 23:02:56', 'Hi'),
('coffeehousejazz', 'Does anyone got a good recipe for coffee cake? I really like the one they have at Starbucks and I want to eat it every morning but its getting kinda expensive lol.', NULL, 'Baking', 3, '2023-04-08 01:31:39', 'Coffee Cake Please');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isAdmin` int(1) DEFAULT NULL,
  `profileImage` blob DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `isAdmin`, `profileImage`, `nickname`, `bio`) VALUES
('admintest', 'admin@gmail.com', '$2y$10$CjLSvRKGGSEVbpBDFAwU8Os3dHdJcx2vY9w2yOZT0BXd2lvgOvWfy', 1, NULL, 'Indira', ''),
('bakinglover123', 'jazthepaz@icloud.com', '$2y$10$g2TU.wBkhwW/oUSD7e0K/.WWgqtfo9iGJxaQNN5twkcHCiZ/98hrO', NULL, NULL, NULL, NULL),
('coffeehousejazz', 'jazthepaz@gmail.com', '$2y$10$LRQq0ODiNi5pDE6ospaSNOoRjJQeJ9MCpyeb2oXpviz5XNRP43LAS', 0, 0x75706c6f6164732f6b696e64706e675f323832343137312e706e67, 'Jazz', 'I love coffee cake'),
('DeleteMe', 'delete@gmail.com', 'delete', 0, NULL, 'Delete Me', 'I am an evil account! Delete me!'),
('ilovesushi', 'j@gmail.com', '$2y$10$VE4oC2Dnz8JQmilk/hiQd.sCCLv1iV3D4aMZmTU9ACeAWdbAIX7va', NULL, NULL, 'Jaz', 'My favourite roll is spicy tuna.'),
('sugarandspice', 'i@gmail.com', '$2y$10$QA2qZwUHN/jTUxVt0yqkceRwMPDUuC4GBeIN.LDr1cxOc.azX7kTG', NULL, NULL, 'Indira', NULL),
('treasuretomy', 'takara.nishizaki@gmail.com', '$2y$10$0oallUJ1J6edF8j9rjLZn.JmRw76WgjMPw7vA9b/bLQGuvEynmA/S', 0, NULL, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
