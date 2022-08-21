-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2022 at 06:40 PM
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
(5, 'Systems design', 'Systems design is the process of defining the architecture, product design, modules, interfaces, and data for a system to satisf'),
(6, 'Artificial Intelligence', 'Artificial intelligence (AI) is the ability of a computer or a robot controlled by a computer to do tasks that are usually done ');

-- --------------------------------------------------------

--
-- Table structure for table `company_size`
--

CREATE TABLE `company_size` (
  `id` int(11) NOT NULL,
  `size` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_size`
--

INSERT INTO `company_size` (`id`, `size`) VALUES
(1, '0-1'),
(2, '2-10'),
(3, '11-50'),
(4, '51-200'),
(5, '201-500'),
(6, '501-1000'),
(7, '1001-5000');

-- --------------------------------------------------------

--
-- Table structure for table `company_type`
--

CREATE TABLE `company_type` (
  `id` int(11) NOT NULL,
  `type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_type`
--

INSERT INTO `company_type` (`id`, `type`) VALUES
(1, 'Educational'),
(2, 'Government Agency'),
(3, 'Non Profit'),
(4, 'Partnership'),
(5, 'Privately Held'),
(6, 'Public Company'),
(7, 'Self Employed'),
(8, 'Self Owned');

-- --------------------------------------------------------

--
-- Table structure for table `complete_content`
--

CREATE TABLE `complete_content` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complete_content`
--

INSERT INTO `complete_content` (`id`, `learner_id`, `content_id`) VALUES
(5, 8, 12),
(6, 8, 10),
(7, 9, 2),
(8, 9, 3),
(9, 9, 5),
(12, 8, 11),
(13, 6, 2),
(14, 6, 3),
(15, 6, 5),
(16, 6, 4),
(17, 6, 7),
(18, 6, 11),
(19, 8, 16),
(20, 8, 17),
(21, 8, 18),
(22, 8, 19),
(23, 8, 20);

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
(7, 3, 'Java Thread', 'A thread is a thread of execution in a program. The Java Virtual Machine allows an application to have multiple threads of execu', 'TCd8QIS-2KI', 1, '15'),
(9, 8, 'Variables', 'Variables is the first step toward learn programming', '6JtP8xk1U_k', 1, '2'),
(10, 9, 'Python Introduction', '', 'x7X9w_GIm1s', 1, '1'),
(11, 10, 'HTML intro', 'Learn HTML super easy', 'UB1O30fR-EE', 1, '4'),
(12, 9, 'Variables', 'Python variables', 'cQT33yu9pY8', 0, '2'),
(15, 12, 'Intro to Python', '', 'I2wURDqiXdM', 0, '2'),
(16, 10, 'Html body', '', 'UB1O30fR-EE', 0, '20'),
(17, 13, 'Input tag', '', 'UB1O30fR-EE', 0, '20'),
(18, 13, 'html form', '', 'UB1O30fR-EE', 0, '20'),
(19, 13, 'html form2', '', 'UB1O30fR-EE', 0, '20'),
(20, 14, 'CSS selector', '', 'UB1O30fR-EE', 0, '20');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `picture` varchar(128) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_drafted` tinyint(1) NOT NULL DEFAULT 1,
  `is_submitted` tinyint(1) NOT NULL DEFAULT 0,
  `point_needed` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `instructor_id`, `title`, `description`, `category_id`, `price`, `is_active`, `created_time`, `picture`, `is_approved`, `is_drafted`, `is_submitted`, `point_needed`) VALUES
(8, 3, '30 days web development', 'Web development is the work involved in developing a website for the Internet or an intranet. Web development can range from developing a simple single static page of plain text to complex web applications.', 3, 20, 0, '2022-05-11 19:14:05', 'uploads/top11330 days web development1651786985249541840627444e9192f0.jpg', 0, 1, 0, '600'),
(9, 3, 'Learn Django', 'Django is a Python-based free and open-source web framework that follows the model–template–views architectural pattern. It is maintained by the Django Software Foundation, an independent organization established in the US as a 501 non-profit.', 1, 35, 0, '2022-05-11 19:14:18', 'uploads/django-dark3Learn Django165178703717711991176274451d001a7.jpg', 0, 1, 0, '300'),
(10, 3, 'Java Master Class', 'Java is a high-level, class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible.Java is used to write applications for different platforms that run JRE and supports applications that run on a ', 3, 15, 0, '2022-05-11 19:14:34', 'uploads/java3Java Master Class1651872877935880676275946deac19.jpg', 1, 0, 0, '300'),
(17, 5, 'Learn PHP', 'PHP is a general-purpose scripting language geared toward web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994. The PHP reference implementation is now produced by The PHP Group.', 3, 20, 0, '2022-05-11 21:09:02', 'uploads/php5Learn PHP16523033422022000500627c25ee5e9c7.jpg', 1, 0, 0, '250'),
(18, 5, 'Learn Python', 'Python is a high-level, interpreted, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. Python is dynamically-typed and garbage-collecte', 1, 10, 0, '2022-05-11 21:44:21', 'uploads/python5Learn Python1652305461900284470627c2e35ebf5e.jpg', 1, 0, 0, '250'),
(20, 6, 'Data Science for Everyone', 'Data scientists are analytical experts who utilize their skills in both technology and social science to find trends and manage data. They use industry knowledge, contextual understanding, skepticism of existing assumptions – to uncover solutions to busine', 3, 20, 0, '2022-05-12 09:22:44', 'uploads/data science6Data Science for Everyone16523473641553963511627cd1e44281c.jpg', 1, 0, 0, '300'),
(21, 6, 'Advanced Machine Learning', 'Machine learning is a method of data analysis that automates analytical model building. It is a branch of artificial intelligence based on the idea that systems can learn from data, identify patterns and make decisions with minimal human intervention.', 6, 30, 0, '2022-05-12 09:28:13', 'uploads/ai6Advanced Machine Learning1652347693661183331627cd32d71c61.jpg', 1, 0, 0, '350'),
(22, 7, 'Learn HTML and CSS', 'Front-end web development is the development of the graphical user interface of a website, through the use of HTML, CSS, and JavaScript, so that users can view and interact with that website', 3, 5, 0, '2022-05-12 09:34:08', 'uploads/frontend7Learn HTML and CSS1652348048802846210627cd4908dc91.jpg', 1, 0, 0, '100'),
(23, 6, 'System Analysis and Design', 'System analysis and design', 3, 20, 0, '2022-05-13 09:21:40', 'uploads/top116System Analysis and Design1652433700943526507627e2324bebc2.jpg', 0, 1, 1, '250');

-- --------------------------------------------------------

--
-- Table structure for table `course_rating`
--

CREATE TABLE `course_rating` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `rating` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_rating`
--

INSERT INTO `course_rating` (`id`, `course_id`, `learner_id`, `rating`) VALUES
(8, 22, 13, 5),
(9, 18, 13, 4),
(10, 22, 8, 4),
(11, 20, 8, 3),
(12, 18, 8, 5),
(13, 21, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_transaction`
--

CREATE TABLE `course_transaction` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `transaction_id` varchar(128) NOT NULL,
  `transaction_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_transaction`
--

INSERT INTO `course_transaction` (`id`, `course_id`, `learner_id`, `transaction_id`, `transaction_time`) VALUES
(1, 18, 8, '47512e28-8494-4849-983e-0d3c43b54b34', '2022-05-12 12:32:35'),
(2, 22, 8, '58dc52f1-8ce1-4bd5-b94f-26088f664512', '2022-05-12 13:42:02'),
(3, 17, 9, 'de2e5d6d-5042-49a1-a257-15c44b1daa8a', '2022-05-12 13:43:02'),
(4, 20, 9, '07375693-fdc2-4021-a9cd-271aa89eddc7', '2022-05-12 13:43:23'),
(5, 22, 13, '027c4925-c7e2-43df-8eb9-00735fa48aef', '2022-05-12 13:44:15'),
(6, 18, 13, '97812100-a291-4019-8fc7-04ed84c776a3', '2022-05-12 13:44:25'),
(7, 20, 13, 'e29fc43c-a5ea-4a5f-b910-21ef1aa4942a', '2022-05-12 17:14:19'),
(8, 20, 8, 'a42fc8f9-e84e-4173-a371-094ba4ba32a9', '2022-05-12 18:21:30'),
(9, 10, 14, '4f995740-c281-4848-91b1-1c87a8c79ef2', '2022-05-13 09:03:57'),
(10, 10, 9, '1a87f23c-41b3-4556-b616-1ebe1394de50', '2022-05-19 13:27:39'),
(11, 10, 6, 'cab41f25-326c-470a-b009-2a8b02af1570', '2022-05-20 11:45:47'),
(12, 22, 6, '8c5969b3-5e2f-48b1-a4ad-19fef6d4a073', '2022-05-20 11:46:20'),
(13, 21, 8, '2fa8c71b-0080-4177-9442-199a3dcec6ac', '2022-05-20 12:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `course_view`
--

CREATE TABLE `course_view` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `viewed_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_view`
--

INSERT INTO `course_view` (`id`, `course_id`, `viewed_time`) VALUES
(1, 22, '2022-05-12 21:05:54'),
(2, 18, '2022-05-12 21:06:06'),
(3, 20, '2022-05-12 21:06:11'),
(4, 17, '2022-05-12 21:06:16'),
(5, 22, '2022-05-12 21:06:20'),
(6, 22, '2022-05-12 21:06:26'),
(7, 22, '2022-05-12 21:09:45'),
(8, 17, '2022-05-12 21:09:50'),
(9, 22, '2022-05-12 21:09:55'),
(10, 18, '2022-05-12 21:10:00'),
(11, 18, '2022-05-12 21:14:05'),
(12, 18, '2022-05-12 21:14:09'),
(13, 18, '2022-05-12 21:35:49'),
(14, 22, '2022-05-12 21:41:49'),
(15, 17, '2022-05-12 21:41:53'),
(16, 10, '2022-05-12 21:51:15'),
(17, 10, '2022-05-12 21:51:52'),
(18, 10, '2022-05-12 21:51:58'),
(19, 10, '2022-05-12 21:52:07'),
(20, 10, '2022-05-12 21:52:14'),
(21, 20, '2022-05-12 22:08:27'),
(22, 22, '2022-05-12 22:18:10'),
(23, 22, '2022-05-12 22:18:16'),
(24, 17, '2022-05-12 22:18:22'),
(25, 22, '2022-05-13 08:41:30'),
(26, 10, '2022-05-13 08:41:56'),
(27, 10, '2022-05-13 08:42:09'),
(28, 10, '2022-05-13 08:42:13'),
(29, 10, '2022-05-13 08:51:28'),
(30, 10, '2022-05-13 08:52:06'),
(31, 22, '2022-05-13 09:00:45'),
(32, 10, '2022-05-13 09:00:59'),
(33, 22, '2022-05-13 09:02:32'),
(34, 10, '2022-05-13 09:02:39'),
(35, 10, '2022-05-13 09:03:12'),
(36, 10, '2022-05-13 09:03:41'),
(37, 10, '2022-05-13 09:03:58'),
(38, 10, '2022-05-13 09:04:24'),
(39, 21, '2022-05-13 09:05:51'),
(40, 20, '2022-05-13 09:05:55'),
(41, 21, '2022-05-13 09:06:10'),
(42, 21, '2022-05-13 09:06:14'),
(43, 23, '2022-05-13 09:22:14'),
(44, 23, '2022-05-13 09:22:21'),
(45, 23, '2022-05-13 09:22:27'),
(46, 23, '2022-05-13 09:22:32'),
(47, 23, '2022-05-13 09:23:02'),
(48, 10, '2022-05-13 09:47:32'),
(49, 10, '2022-05-13 09:47:42'),
(50, 20, '2022-05-13 23:15:56'),
(51, 20, '2022-05-13 23:16:01'),
(52, 22, '2022-05-13 23:16:10'),
(53, 18, '2022-05-13 23:16:16'),
(54, 22, '2022-05-18 19:22:52'),
(55, 10, '2022-05-18 19:23:01'),
(56, 10, '2022-05-18 23:11:41'),
(57, 9, '2022-05-18 23:12:12'),
(58, 10, '2022-05-18 23:12:17'),
(59, 20, '2022-05-19 09:59:47'),
(60, 20, '2022-05-19 10:32:48'),
(80, 10, '2022-05-19 11:02:58'),
(81, 10, '2022-05-19 11:06:21'),
(82, 10, '2022-05-19 11:06:57'),
(83, 22, '2022-05-19 11:07:07'),
(84, 20, '2022-05-19 11:07:12'),
(85, 18, '2022-05-19 11:07:17'),
(86, 21, '2022-05-19 11:07:25'),
(87, 20, '2022-05-19 11:07:28'),
(88, 18, '2022-05-19 11:07:34'),
(89, 18, '2022-05-19 11:07:53'),
(90, 18, '2022-05-19 11:07:59'),
(91, 18, '2022-05-19 11:08:09'),
(92, 18, '2022-05-19 11:08:16'),
(93, 18, '2022-05-19 11:08:16'),
(94, 18, '2022-05-19 11:08:55'),
(95, 18, '2022-05-19 11:10:25'),
(96, 22, '2022-05-19 11:10:47'),
(97, 20, '2022-05-19 11:10:56'),
(98, 22, '2022-05-19 11:11:33'),
(99, 22, '2022-05-19 11:11:38'),
(100, 20, '2022-05-19 11:11:41'),
(101, 20, '2022-05-19 11:12:00'),
(102, 20, '2022-05-19 11:12:18'),
(103, 20, '2022-05-19 11:12:38'),
(104, 20, '2022-05-19 11:13:09'),
(105, 21, '2022-05-19 12:48:01'),
(106, 10, '2022-05-19 12:48:05'),
(107, 10, '2022-05-19 12:48:09'),
(108, 10, '2022-05-19 12:48:15'),
(109, 22, '2022-05-19 12:59:17'),
(110, 22, '2022-05-19 12:59:23'),
(111, 18, '2022-05-19 12:59:27'),
(112, 20, '2022-05-19 12:59:30'),
(113, 20, '2022-05-19 13:00:00'),
(114, 20, '2022-05-19 13:00:05'),
(115, 20, '2022-05-19 13:01:16'),
(116, 21, '2022-05-19 13:01:19'),
(117, 10, '2022-05-19 13:01:25'),
(118, 10, '2022-05-19 13:01:29'),
(119, 20, '2022-05-19 13:01:33'),
(120, 20, '2022-05-19 13:04:12'),
(121, 18, '2022-05-19 13:09:19'),
(122, 18, '2022-05-19 13:09:23'),
(123, 10, '2022-05-19 13:27:39'),
(124, 10, '2022-05-19 13:38:49'),
(125, 10, '2022-05-19 13:38:54'),
(126, 10, '2022-05-19 13:38:58'),
(127, 20, '2022-05-19 14:34:09'),
(128, 20, '2022-05-19 14:38:20'),
(129, 20, '2022-05-19 14:38:26'),
(130, 20, '2022-05-19 14:38:47'),
(131, 20, '2022-05-19 14:39:13'),
(132, 20, '2022-05-19 14:39:26'),
(133, 20, '2022-05-19 14:45:38'),
(134, 18, '2022-05-19 14:45:45'),
(135, 20, '2022-05-19 14:45:50'),
(136, 20, '2022-05-19 14:45:55'),
(137, 20, '2022-05-19 14:46:03'),
(138, 20, '2022-05-19 14:46:11'),
(139, 22, '2022-05-19 14:46:15'),
(140, 22, '2022-05-19 14:46:24'),
(141, 18, '2022-05-19 14:46:36'),
(142, 20, '2022-05-19 14:47:07'),
(143, 20, '2022-05-19 14:48:05'),
(144, 21, '2022-05-19 14:48:09'),
(145, 20, '2022-05-19 14:48:17'),
(147, 10, '2022-05-20 11:44:27'),
(148, 10, '2022-05-20 11:44:32'),
(149, 22, '2022-05-20 11:44:41'),
(150, 20, '2022-05-20 11:44:45'),
(151, 21, '2022-05-20 11:44:50'),
(152, 18, '2022-05-20 11:44:54'),
(153, 10, '2022-05-20 11:45:21'),
(154, 10, '2022-05-20 11:45:25'),
(155, 10, '2022-05-20 11:45:34'),
(156, 10, '2022-05-20 11:45:47'),
(157, 22, '2022-05-20 11:46:20'),
(158, 21, '2022-05-20 12:39:36'),
(159, 21, '2022-05-20 12:39:49'),
(160, 22, '2022-05-20 12:40:01'),
(161, 22, '2022-05-20 12:50:40'),
(162, 22, '2022-05-20 23:50:37'),
(163, 22, '2022-05-20 23:51:04'),
(164, 22, '2022-05-20 23:51:39'),
(165, 22, '2022-05-20 23:52:03'),
(166, 22, '2022-05-20 23:52:18'),
(167, 22, '2022-05-20 23:52:18'),
(168, 22, '2022-05-20 23:52:51'),
(169, 22, '2022-05-20 23:53:14'),
(170, 22, '2022-05-20 23:53:29'),
(171, 22, '2022-05-20 23:53:40'),
(172, 22, '2022-05-20 23:53:41'),
(173, 22, '2022-05-20 23:53:55'),
(174, 22, '2022-05-20 23:54:18'),
(175, 21, '2022-05-20 23:57:35'),
(176, 22, '2022-05-20 23:58:10'),
(177, 22, '2022-05-20 23:58:16'),
(178, 22, '2022-05-21 01:17:15'),
(179, 21, '2022-05-21 01:17:34'),
(180, 21, '2022-05-21 01:17:39'),
(181, 20, '2022-05-21 01:35:27'),
(182, 21, '2022-05-21 01:45:10'),
(183, 20, '2022-05-21 01:45:16'),
(184, 22, '2022-05-21 01:45:21'),
(185, 22, '2022-05-21 01:48:54'),
(186, 22, '2022-05-21 01:51:29'),
(187, 22, '2022-05-21 01:53:38'),
(188, 22, '2022-05-21 01:54:04'),
(189, 22, '2022-05-21 01:54:07'),
(190, 22, '2022-05-21 01:56:08'),
(191, 22, '2022-05-21 01:56:13'),
(192, 22, '2022-05-21 01:56:52'),
(193, 22, '2022-05-21 01:56:56'),
(194, 22, '2022-05-21 01:57:57'),
(195, 22, '2022-05-21 01:58:27'),
(196, 22, '2022-05-21 01:58:53'),
(197, 22, '2022-05-21 01:59:12'),
(198, 22, '2022-05-21 01:59:30'),
(199, 18, '2022-05-21 01:59:46'),
(200, 18, '2022-05-21 01:59:50'),
(201, 22, '2022-05-21 02:00:37'),
(202, 22, '2022-05-21 02:00:42'),
(203, 20, '2022-05-21 02:00:48'),
(204, 20, '2022-05-21 02:00:51'),
(205, 20, '2022-05-21 02:00:54'),
(206, 18, '2022-05-21 02:01:00'),
(207, 18, '2022-05-21 02:01:04'),
(208, 21, '2022-05-21 02:01:09'),
(209, 21, '2022-05-21 02:01:13'),
(210, 22, '2022-05-21 02:36:33'),
(211, 10, '2022-05-21 02:36:55'),
(212, 10, '2022-05-21 03:24:05'),
(213, 22, '2022-05-23 05:32:10'),
(214, 21, '2022-05-23 05:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school` varchar(128) NOT NULL,
  `degree` varchar(128) NOT NULL,
  `field` varchar(128) NOT NULL,
  `start_time` varchar(11) NOT NULL,
  `end_time` varchar(11) NOT NULL DEFAULT 'Continue'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `user_id`, `school`, `degree`, `field`, `start_time`, `end_time`) VALUES
(2, 31, 'Tokyo University', 'Bachelor of science and engineering', 'Computer science and engineering', '2019', '2022'),
(3, 28, 'United International University', 'Bachelor of science and engineering', 'Computer science and engineering', '2019', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `employer_profile`
--

CREATE TABLE `employer_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `industry` int(11) NOT NULL,
  `company_size` int(11) NOT NULL,
  `company_type` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `year_founded` year(4) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `location` int(11) NOT NULL,
  `website` varchar(256) NOT NULL DEFAULT '',
  `picture` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employer_profile`
--

INSERT INTO `employer_profile` (`id`, `user_id`, `company_name`, `description`, `industry`, `company_size`, `company_type`, `phone`, `year_founded`, `created_time`, `location`, `website`, `picture`) VALUES
(6, 31, 'HTC Group', 'HTC Corporation is a Taiwanese consumer electronics company headquartered in Xindian District, New Taipei City, Taiwan. Founded in 1997, HTC began as an original design manufacturer and original equipment manufacturer, designing and manufacturing laptop computers.', 3, 6, 5, '02846836271', 1988, '2022-05-13 19:42:40', 8, 'https://www.htc.com', 'uploads_company_image/htcHTC Group1652470960982146201627eb4b02b2f2.jpg'),
(7, 28, 'Kareer', 'A platform where you can learn and earn', 1, 2, 8, '01911467735', 2022, '2022-05-13 23:10:39', 1, 'www.kareer.com', 'uploads_company_image/Add a headingKareer1652483439484424354627ee56f5a98c.jpg'),
(8, 32, 'Intagram', 'Instagram is an American photo and video sharing social networking service founded in 2010 by Kevin Systrom and Mike Krieger, and later acquired by Facebook Inc.. The app allows users to upload media that can be edited with filters and organized by hashtags and geographical tagging', 1, 7, 5, '01926478362', 2007, '2022-05-19 23:10:40', 8, 'www.instagram.com', 'uploads_company_image/instagramIntagram165300184014763461616286ce70878c6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `job_title` varchar(128) NOT NULL,
  `job_type` varchar(64) NOT NULL,
  `start_time` varchar(11) NOT NULL,
  `end_time` varchar(11) NOT NULL DEFAULT 'Continue',
  `location` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `user_id`, `company_name`, `job_title`, `job_type`, `start_time`, `end_time`, `location`) VALUES
(1, 31, 'Samsung R&D Institute Bangladesh Ltd', 'Administrative Assistant', 'Part-time', '2017', '2021', 'Dhaka,Bangladesh'),
(2, 31, 'Torry Harris Integration Solutions', ' Software Engineer', 'Full-time', '2012', '2016', 'Munich,Germany'),
(5, 28, 'Kareer', 'Junior Java Developer', 'Part-time', '2022', '', 'Dhaka,Bangladesh'),
(6, 31, 'Google ', 'Frontend Developer', 'Part-time', '2021', '2022', 'Dhaka,Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `follow_learner`
--

CREATE TABLE `follow_learner` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follow_learner`
--

INSERT INTO `follow_learner` (`id`, `user_id`, `follower_id`, `created_time`) VALUES
(1, 40, 31, '2022-05-21 00:34:43'),
(2, 28, 31, '2022-05-21 00:35:21'),
(4, 29, 28, '2022-05-21 00:36:25'),
(5, 30, 28, '2022-05-21 00:36:28'),
(6, 32, 28, '2022-05-21 01:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

CREATE TABLE `industry` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`id`, `name`) VALUES
(1, 'Software Development'),
(2, 'Data Security Software Products'),
(3, 'IT System Custom Software Development'),
(4, 'Desktop Computing Software Products'),
(5, 'Mobile Computing Software Products'),
(6, 'Embeded Software Products');

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
(5, 38, 'Abir Hossain', 'Php Developer', '', 'online', 'expert', '', '', '', ''),
(6, 29, 'Millat Hossain', 'Data Scientist', 'Data scientists are analytical experts who utilize their skills in both technology and social science to find trends and manage data. They use industry knowledge, contextual understanding, skepticism of existing assumptions – to uncover solutions to busine', 'online', 'expert', 'https://www.millat.com', '', '', ''),
(7, 30, 'Md Hasan Saon', 'Frontend Developer', 'Front-end web development is the development of the graphical user interface of a website, through the use of HTML, CSS, and JavaScript, so that users can view and interact with that website', 'inperson', 'none', 'https://www.saon.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `type` int(11) NOT NULL,
  `schedule` int(11) NOT NULL,
  `people` varchar(11) NOT NULL,
  `minimum` varchar(11) NOT NULL,
  `maximum` varchar(11) NOT NULL,
  `location` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `employe_id`, `title`, `description`, `type`, `schedule`, `people`, `minimum`, `maximum`, `location`, `created_time`, `is_active`) VALUES
(3, 6, 'Senior Python Developer', 'A Python Developer is responsible for coding, designing, deploying, and debugging development projects, typically on the server-side (or back-end). They may, however, also help organizations with their technological framework.', 3, 3, '2', '60000', '120000', 2, '2022-05-18 22:34:35', 1),
(4, 6, 'Junior Java Developer', 'A Java Developer is responsible for the design, development, and management of Java-based applications. Because Java is used so widely, particularly by large organizations, the daily roles vary widely, but can include owning a particular application or working on several at one time', 1, 3, '10', '40000', '750000', 4, '2022-05-18 22:49:20', 1),
(5, 7, 'Python Developer', 'A Python Developer is responsible for coding, designing, deploying, and debugging development projects, typically on the server-side (or back-end). They may, however, also help organizations with their technological framework.', 5, 4, '20', '10000', '30000', 1, '2022-05-18 22:52:37', 1),
(6, 8, 'Senior Django Developer', 'Toptal developers work with speed and efficiency to deliver the highest quality of work. We are looking for someone who is passionate about their client’s business, and ready to work on exciting projects with Fortune 500 companies and Silicon Valley startups, with great rates and zero hassles. If you are looking for a place to advance your career, enhance your skill set, and build connections around the globe, Toptal is right for you.\r\n', 1, 1, '3', '90000', '150000', 8, '2022-05-19 23:11:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_apply`
--

CREATE TABLE `job_apply` (
  `id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `job_call` tinyint(1) NOT NULL DEFAULT 0,
  `meeting_time` varchar(64) DEFAULT NULL,
  `meet_link` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_apply`
--

INSERT INTO `job_apply` (`id`, `learner_id`, `job_id`, `created_time`, `job_call`, `meeting_time`, `meet_link`) VALUES
(1, 8, 6, '2022-05-20 10:27:49', 0, NULL, NULL),
(2, 8, 5, '2022-05-20 10:30:31', 1, '22/05/2022', 'https://zoom.us/j/5551112222'),
(3, 9, 6, '2022-05-20 10:33:18', 0, NULL, NULL),
(4, 9, 3, '2022-05-20 10:33:26', 0, '', NULL),
(5, 6, 6, '2022-05-20 11:47:49', 0, NULL, NULL),
(6, 6, 3, '2022-05-20 11:48:00', 1, '22/05/2022', 'https://zoom.us/j/5551112222'),
(8, 6, 5, '2022-05-20 20:32:43', 1, '22/05/2022', 'https://zoom.us/j/5551112222');

-- --------------------------------------------------------

--
-- Table structure for table `job_schedule`
--

CREATE TABLE `job_schedule` (
  `id` int(11) NOT NULL,
  `schedule` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_schedule`
--

INSERT INTO `job_schedule` (`id`, `schedule`) VALUES
(1, '8 hour shift'),
(2, '10 hour shift'),
(3, '12 hour shift'),
(4, 'Weekend availability'),
(5, 'Monday to Friday'),
(6, 'On call');

-- --------------------------------------------------------

--
-- Table structure for table `job_transaction`
--

CREATE TABLE `job_transaction` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `transaction_id` varchar(128) NOT NULL,
  `transaction_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_transaction`
--

INSERT INTO `job_transaction` (`id`, `job_id`, `employe_id`, `transaction_id`, `transaction_time`) VALUES
(1, 3, 6, '34c4eee5-4591-4770-a9ae-0453c53de2b6', '2022-05-18 22:34:35'),
(2, 4, 6, '84d2d298-4718-447f-9ff9-0922f924873e', '2022-05-18 22:49:20'),
(3, 5, 7, '9e2c13b4-590b-459d-9634-06dc96234913', '2022-05-18 22:52:37'),
(4, 6, 8, '03e342a9-5e4c-43ab-8395-013d1de32860', '2022-05-19 23:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`id`, `type`) VALUES
(1, 'Full-time'),
(2, 'Part-time'),
(3, 'Contract'),
(4, 'Temporary'),
(5, 'Internship'),
(6, 'Remote');

-- --------------------------------------------------------

--
-- Table structure for table `learner_profile`
--

CREATE TABLE `learner_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `biography` varchar(512) NOT NULL,
  `dob` datetime DEFAULT NULL,
  `city` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `profile_pic` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learner_profile`
--

INSERT INTO `learner_profile` (`id`, `user_id`, `biography`, `dob`, `city`, `country`, `profile_pic`) VALUES
(5, 28, 'A python Developer is a programmer who designs, develops, and manages Java-based applications and software. With most large organizations using Java to implement software systems and backend services, a Java developer is one of the most sought-after jobs today', '0000-00-00 00:00:00', 'Dhaka', 'Bangladesh', 'img/defult.jpg'),
(6, 29, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg'),
(7, 30, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg'),
(8, 31, 'Experienced in the accounting industry. \r\nSelf taught web developer, interested in full stack technologies like HTML, CSS , JavaScript, PHP, MySQL, Node.js. \r\n', '0000-00-00 00:00:00', 'Tokyo', 'Japan', 'uploads_profile_pic/light816529984905529837496286c15a41075.jpg'),
(9, 32, 'No Biography', '0000-00-00 00:00:00', '', '', 'uploads_profile_pic/Saul Goodman9165304277834711041362876e5a2b1fc.jpg'),
(12, 38, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg'),
(13, 39, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg'),
(14, 40, 'No Biography', '0000-00-00 00:00:00', '', '', 'img/defult.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`) VALUES
(1, 'Dhaka'),
(2, 'Chittagong'),
(3, 'Kolkata'),
(4, 'Delhi'),
(5, 'Mumbai'),
(6, 'Karachi'),
(7, 'Kathmandu'),
(8, 'Singapore'),
(9, 'Kuala Lumpur');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `about` varchar(256) NOT NULL,
  `start_time` varchar(11) NOT NULL,
  `end_time` varchar(11) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `user_id`, `name`, `about`, `start_time`, `end_time`, `url`) VALUES
(0, 28, 'Page Replacement Algorithm', 'In a computer operating system that uses paging for virtual memory management, page replacement algorithms decide which memory pages to page out, sometimes called swap out, or write to disk, when a page of memory needs to be allocated', '2022', '2022', 'https://github.com/ShahparanRifat07/Page-Replacement-Algorithm'),
(0, 31, 'Fish feeding system', 'Two dosing systems are usually used for feed dosage in aquaculture fish farms: Gravimetric and Volumetric. Gravimetric systems are based on weighing the doses by means of one or more electronic load cells. The only unit of measurement is weight. In volumet', '2022', '2022', 'https://www.fishfarmfeeder.com/en/blog/components-automatic-aquaculture-feeding-systems/#:~:text=Two%20dosing%20systems%20are%20usually,made%20according%20to%20the%20volume.');

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
(6, 9, 'Introduction'),
(8, 17, 'Introduction'),
(9, 20, 'Basic Python'),
(10, 22, 'Learn HTML'),
(12, 18, 'Introduction'),
(13, 22, 'HTML'),
(14, 22, 'CSS');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `user_id`, `skill`) VALUES
(1, 28, 'Java'),
(2, 28, 'Django'),
(3, 28, 'JavaScript'),
(4, 31, 'Java');

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
  `created_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `is_learner`, `is_instructor`, `is_employer`, `is_admin`, `created_time`) VALUES
(28, 'Shahparan', 'Rifat', 'rifat@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 1, 1, '2022-05-11 10:25:09'),
(29, 'Millat', 'Hossain', 'millat@gmail.com', 'f44f9df3098300f1c314f2ddafe7ed0d48610816', 1, 1, 0, 0, '2022-05-12 09:21:01'),
(30, 'Hasan', 'Saon', 'saon@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 0, 0, '2022-05-12 09:32:45'),
(31, 'Light', 'Yeagami', 'light@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 1, 0, '2022-05-16 04:21:50'),
(32, 'Saul', 'Goodman', 'saul@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 1, 0, '2022-05-01 04:23:39'),
(38, 'Abir', 'Hossain', 'abir@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 0, 0, '2022-05-18 07:43:03'),
(39, 'Eran', 'Yagar', 'eran@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 0, 0, '2022-05-12 13:43:59'),
(40, 'Walter', 'White', 'white@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 0, 0, 0, '2022-05-18 09:01:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_size`
--
ALTER TABLE `company_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_type`
--
ALTER TABLE `company_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complete_content`
--
ALTER TABLE `complete_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f10` (`learner_id`),
  ADD KEY `f11` (`content_id`);

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
-- Indexes for table `course_rating`
--
ALTER TABLE `course_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f30` (`course_id`),
  ADD KEY `f31` (`learner_id`);

--
-- Indexes for table `course_transaction`
--
ALTER TABLE `course_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f7` (`course_id`),
  ADD KEY `f8` (`learner_id`);

--
-- Indexes for table `course_view`
--
ALTER TABLE `course_view`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f9` (`course_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f23` (`user_id`);

--
-- Indexes for table `employer_profile`
--
ALTER TABLE `employer_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f12` (`industry`),
  ADD KEY `f13` (`company_size`),
  ADD KEY `f14` (`company_type`),
  ADD KEY `f15` (`location`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f22` (`user_id`);

--
-- Indexes for table `follow_learner`
--
ALTER TABLE `follow_learner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f28` (`user_id`),
  ADD KEY `f29` (`follower_id`);

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor_profile`
--
ALTER TABLE `instructor_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f2` (`user_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f17` (`type`),
  ADD KEY `f18` (`schedule`),
  ADD KEY `f19` (`location`),
  ADD KEY `f16` (`employe_id`);

--
-- Indexes for table `job_apply`
--
ALTER TABLE `job_apply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f26` (`learner_id`),
  ADD KEY `f27` (`job_id`);

--
-- Indexes for table `job_schedule`
--
ALTER TABLE `job_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_transaction`
--
ALTER TABLE `job_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f20` (`job_id`),
  ADD KEY `f21` (`employe_id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learner_profile`
--
ALTER TABLE `learner_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f1` (`user_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD KEY `f25` (`user_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f5` (`course_id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f24` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_size`
--
ALTER TABLE `company_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company_type`
--
ALTER TABLE `company_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `complete_content`
--
ALTER TABLE `complete_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `course_rating`
--
ALTER TABLE `course_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_transaction`
--
ALTER TABLE `course_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_view`
--
ALTER TABLE `course_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employer_profile`
--
ALTER TABLE `employer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `follow_learner`
--
ALTER TABLE `follow_learner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `instructor_profile`
--
ALTER TABLE `instructor_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_apply`
--
ALTER TABLE `job_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job_schedule`
--
ALTER TABLE `job_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_transaction`
--
ALTER TABLE `job_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `learner_profile`
--
ALTER TABLE `learner_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complete_content`
--
ALTER TABLE `complete_content`
  ADD CONSTRAINT `f10` FOREIGN KEY (`learner_id`) REFERENCES `learner_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `f11` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`);

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
-- Constraints for table `course_rating`
--
ALTER TABLE `course_rating`
  ADD CONSTRAINT `f30` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `f31` FOREIGN KEY (`learner_id`) REFERENCES `learner_profile` (`id`);

--
-- Constraints for table `course_transaction`
--
ALTER TABLE `course_transaction`
  ADD CONSTRAINT `f7` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `f8` FOREIGN KEY (`learner_id`) REFERENCES `learner_profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `course_view`
--
ALTER TABLE `course_view`
  ADD CONSTRAINT `f9` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `f23` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employer_profile`
--
ALTER TABLE `employer_profile`
  ADD CONSTRAINT `f12` FOREIGN KEY (`industry`) REFERENCES `industry` (`id`),
  ADD CONSTRAINT `f13` FOREIGN KEY (`company_size`) REFERENCES `company_size` (`id`),
  ADD CONSTRAINT `f14` FOREIGN KEY (`company_type`) REFERENCES `company_type` (`id`),
  ADD CONSTRAINT `f15` FOREIGN KEY (`location`) REFERENCES `location` (`id`);

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `f22` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follow_learner`
--
ALTER TABLE `follow_learner`
  ADD CONSTRAINT `f28` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `f29` FOREIGN KEY (`follower_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `instructor_profile`
--
ALTER TABLE `instructor_profile`
  ADD CONSTRAINT `f2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `f16` FOREIGN KEY (`employe_id`) REFERENCES `employer_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `f17` FOREIGN KEY (`type`) REFERENCES `job_type` (`id`),
  ADD CONSTRAINT `f18` FOREIGN KEY (`schedule`) REFERENCES `job_schedule` (`id`),
  ADD CONSTRAINT `f19` FOREIGN KEY (`location`) REFERENCES `location` (`id`);

--
-- Constraints for table `job_apply`
--
ALTER TABLE `job_apply`
  ADD CONSTRAINT `f26` FOREIGN KEY (`learner_id`) REFERENCES `learner_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `f27` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_transaction`
--
ALTER TABLE `job_transaction`
  ADD CONSTRAINT `f20` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `f21` FOREIGN KEY (`employe_id`) REFERENCES `employer_profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `learner_profile`
--
ALTER TABLE `learner_profile`
  ADD CONSTRAINT `f1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `f25` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `f5` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `f24` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
