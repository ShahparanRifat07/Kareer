-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2022 at 10:06 PM
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

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Python', 'Python is a high-level, general-purpose programming language. Its design philosophy emphasizes code readability with the use of '),
(3, 'Web Development', 'Web development is the work involved in developing a website for the Internet or an intranet. Web development can range from dev'),
(4, 'Operating System', 'An operating system is system software that manages computer hardware, software resources, and provides common services for comp'),
(5, 'Systems design', 'Systems design is the process of defining the architecture, product design, modules, interfaces, and data for a system to satisf');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `is_preview` tinyint(1) NOT NULL DEFAULT 0,
  `point` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `section_id`, `name`, `description`, `url`, `is_preview`, `point`) VALUES
(2, 1, 'What is java', 'Java is a high-level, class-based, object-oriented programming language that is designed to have as few implementation dependenc', 'l9AzO1FMgM8', 1, '5'),
(3, 2, 'Variables', 'A variable is a container which holds the value while the Java program is executed. A variable is assigned with a data type. Var', 'N8LDSryePuc', 0, '5'),
(4, 3, 'Java Sockets', 'A socket in Java is one endpoint of a two-way communication link between two programs running on the network. A socket is bound ', 'BqBKEXLqdvI', 0, '5'),
(5, 2, 'Conditional Statements', 'Java has the following conditional statements: Use if to specify a block of code to be executed, if a specified condition is tru', 'P6ivQ3QRq0I', 0, '5'),
(6, 6, 'Intro to Python', 'Python is a high-level, interpreted, general-purpose programming language. Its design philosophy emphasizes code readability wit', 'Y8Tko2YC5hA', 1, '10'),
(7, 3, 'Java Thread', 'A thread is a thread of execution in a program. The Java Virtual Machine allows an application to have multiple threads of execu', 'TCd8QIS-2KI', 1, '15');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(256) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `picture` varchar(128) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_drafted` tinyint(1) NOT NULL DEFAULT 1,
  `is_submitted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `instructor_id`, `title`, `description`, `category_id`, `price`, `is_active`, `created_time`, `picture`, `is_approved`, `is_drafted`, `is_submitted`) VALUES
(8, 3, '30 days web development', 'Web development is the work involved in developing a website for the Internet or an intranet. Web development can range from developing a simple single static page of plain text to complex web applications.', 3, 20, 0, '2022-05-11 19:14:05', 'uploads/top11330 days web development1651786985249541840627444e9192f0.jpg', 0, 1, 0),
(9, 3, 'Learn Django', 'Django is a Python-based free and open-source web framework that follows the model–template–views architectural pattern. It is maintained by the Django Software Foundation, an independent organization established in the US as a 501 non-profit.', 1, 35, 0, '2022-05-11 19:14:18', 'uploads/django-dark3Learn Django165178703717711991176274451d001a7.jpg', 0, 1, 0),
(10, 3, 'Java Master Class', 'Java is a high-level, class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible.Java is used to write applications for different platforms that run JRE and supports applications that run on a ', 3, 15, 0, '2022-05-11 19:14:34', 'uploads/java3Java Master Class1651872877935880676275946deac19.jpg', 1, 0, 0),
(11, 5, 'The Complete Web Development Bootcamp', 'Web development is the work involved in developing a website for the Internet or an intranet. Web development can range from developing a simple single static page of plain text to complex web applications, electronic businesses, and social network service', 3, 30, 0, '2022-05-10 22:06:29', 'uploads/Teachable Thumbnails (1)5The Complete Web Development Bootcamp1651873010587617727627594f2ca9cf.jpg', 1, 0, 0);

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
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `course_id`, `name`) VALUES
(1, 10, 'Introduction'),
(2, 10, 'Basic'),
(3, 10, 'Advanced'),
(6, 9, 'Introduction');

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
(28, 'Shahparan', 'Rifat', 'rifat@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 1, 1, '2022-05-11 10:25:09'),
(29, 'Millat', 'Hossain', 'millat@gmail.com', 'f44f9df3098300f1c314f2ddafe7ed0d48610816', 1, 0, 0, 0, '2022-05-11 16:51:34'),
(30, 'Hasan', 'Saon', 'saon@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 0, 0, '2022-05-08 23:54:47'),
(31, 'Light', 'Yeagami', 'light@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 0, 0, '2022-05-08 04:21:50'),
(32, 'Saul', 'Goodman', 'saul@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 0, 0, '2022-05-01 04:23:39'),
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
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f6` (`section_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f3` (`instructor_id`),
  ADD KEY `f4` (`category_id`);

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
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f5` (`course_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `f6` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `f3` FOREIGN KEY (`instructor_id`) REFERENCES `instructor_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `f4` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;

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

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `f5` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
