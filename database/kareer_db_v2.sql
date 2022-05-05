-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2022 at 12:45 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kareer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(256) NOT NULL,
  `categoty_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_profile`
--

CREATE TABLE `instructor_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `instructor_name` varchar(64) NOT NULL,
  `headline` varchar(64) NOT NULL,
  `about_me` varchar(256) NOT NULL,
  `teaching_exp` varchar(64) NOT NULL,
  `course_exp` varchar(64) NOT NULL,
  `website` varchar(128) NOT NULL,
  `facebook` varchar(128) NOT NULL,
  `linkedin` varchar(128) NOT NULL,
  `twitter` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor_profile`
--

INSERT INTO `instructor_profile` (`id`, `user_id`, `instructor_name`, `headline`, `about_me`, `teaching_exp`, `course_exp`, `website`, `facebook`, `linkedin`, `twitter`) VALUES
(3, 28, 'Shahparan Rifat', 'Software Engineer', 'Noting about me till now', 'inperson', 'none', 'https://www.rifat.com', '', '', ''),
(5, 38, 'Abir Hossain', 'Php Developer', '', 'online', 'expert', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `learner_profile`
--

CREATE TABLE `learner_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `biography` varchar(256) NOT NULL,
  `dob` datetime DEFAULT NULL,
  `city` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `profile_pic` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learner_profile`
--

INSERT INTO `learner_profile` (`id`, `user_id`, `biography`, `dob`, `city`, `country`, `profile_pic`) VALUES
(5, 28, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg'),
(6, 29, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg'),
(7, 30, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg'),
(8, 31, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg'),
(9, 32, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg'),
(12, 38, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_learner` tinyint(1) NOT NULL,
  `is_instructor` tinyint(1) NOT NULL,
  `is_employer` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `is_learner`, `is_instructor`, `is_employer`, `is_admin`, `created_time`) VALUES
(28, 'Shahparan', 'Rifat', 'rifat@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 0, 0, '2022-04-18 07:37:39'),
(29, 'Millat', 'Hossain', 'millat@gmail.com', 'f44f9df3098300f1c314f2ddafe7ed0d48610816', 1, 0, 0, 0, '2022-04-11 16:51:34'),
(30, 'Hasan', 'Saon', 'saon@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 0, 0, '2022-04-11 23:54:47'),
(31, 'Light', 'Yeagami', 'light@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 0, 0, '2022-04-13 04:21:50'),
(32, 'Saul', 'Goodman', 'saul@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 0, 0, '2022-04-13 04:23:39'),
(38, 'Abir', 'Hossain', 'abir@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 0, 0, '2022-04-18 07:43:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f3` (`instructor_id`),
  ADD KEY `f4` (`categoty_id`);

--
-- Indexes for table `instructor_profile`
--
ALTER TABLE `instructor_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f2` (`user_id`);

--
-- Indexes for table `learner_profile`
--
ALTER TABLE `learner_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f1` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor_profile`
--
ALTER TABLE `instructor_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `learner_profile`
--
ALTER TABLE `learner_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `f3` FOREIGN KEY (`instructor_id`) REFERENCES `instructor_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `f4` FOREIGN KEY (`categoty_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `instructor_profile`
--
ALTER TABLE `instructor_profile`
  ADD CONSTRAINT `f2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `learner_profile`
--
ALTER TABLE `learner_profile`
  ADD CONSTRAINT `f1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
