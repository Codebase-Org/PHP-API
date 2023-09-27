-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1:3306
-- Genereringstid: 27. 09 2023 kl. 09:36:46
-- Serverversion: 8.0.31
-- PHP-version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codebase`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role_id` int NOT NULL,
  `instructor_id` int DEFAULT NULL,
  `onlineStatus` tinyint(1) NOT NULL,
  `created_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `email`, `role_id`, `instructor_id`, `onlineStatus`, `created_date`, `end_date`) VALUES
(1, 'QT1iyzi4HfA/rsHfCsU=', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'bSVoyyiZDfp7hNTQHNKd+7mb1pw=', 1, NULL, 0, '2023-09-20', NULL),
(2, 'QT1iyzi4HfA/qNjCG8XG9KKXxQ==', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'azx12iisDeFwk/bSANPW9beL0t5T78Fm5w==', 3, NULL, 0, '2023-09-20', NULL),
(3, 'QT1iyzi4HfA/qNjCG8XG9KKXxdAO', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'azx12iisDeFwk4fxDNjX8rSZxJUR7M1k6pM=', 3, NULL, 0, '2023-09-20', NULL),
(4, 'QT1iyzi4HfA/qNjCG8XG9KKXxdAN', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'azx12iisDeFwk4TxDNjX8rSZxJUR7M1k6pM=', 3, NULL, 0, '2023-09-20', NULL),
(5, 'QT1iyzi4HfA/oNLcBtk=', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'YzZrxzSZDfp7hNTQHNKd+7mb1pw=', 2, NULL, 0, '2023-09-20', NULL),
(6, 'QT1iyzi4HfA/oNLcBtmTpg==', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'YzZrxzToLvZwhdPTDsTWubqX1JFT', 2, NULL, 0, '2023-09-20', NULL),
(8, 'QT1iyzi4HfA/ssLEC9Ld4w==', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'cSZzyj+3GtV8jtLUDdbA8viU2JNe7A==', 4, 4, 0, '2023-09-21', '2024-03-10');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `catname` varchar(150) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `categories`
--

INSERT INTO `categories` (`category_id`, `catname`, `picture`) VALUES
(1, 'HTML', 'html-logo.png'),
(2, '.NET Core', 'net-core-logo.png'),
(3, 'CSS', 'css-logo.png'),
(4, 'PHP', 'php-logo.png'),
(5, 'CSharp', 'csharp-logo.png'),
(6, 'JavaScript', 'javascript-logo.png'),
(7, 'Typescript', 'typescript-logo.png'),
(8, 'Python', 'python-logo.png'),
(9, 'Vue', 'vue-logo.png'),
(10, 'Angular', 'angular-logo.png'),
(11, 'React', 'react-logo.png'),
(12, 'C++', 'cplusplus.png');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `educations`
--

DROP TABLE IF EXISTS `educations`;
CREATE TABLE IF NOT EXISTS `educations` (
  `education_id` int NOT NULL AUTO_INCREMENT,
  `education` varchar(200) NOT NULL,
  PRIMARY KEY (`education_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `educations`
--

INSERT INTO `educations` (`education_id`, `education`) VALUES
(1, 'Datateknikker med speciale i programering'),
(2, 'Datateknikker med speciale i infrastruktur'),
(3, 'IT Supporter');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `faq_id` int NOT NULL AUTO_INCREMENT,
  `faq_title` varchar(255) NOT NULL,
  `faq_content` text NOT NULL,
  `faq_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`faq_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `login_histories`
--

DROP TABLE IF EXISTS `login_histories`;
CREATE TABLE IF NOT EXISTS `login_histories` (
  `loginhist_id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  PRIMARY KEY (`loginhist_id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `login_histories`
--

INSERT INTO `login_histories` (`loginhist_id`, `account_id`, `login_time`, `logout_time`) VALUES
(1, 1, '2023-09-20 14:16:59', '2023-09-20 14:22:17'),
(2, 1, '2023-09-20 14:22:22', '2023-09-20 15:58:06'),
(3, 1, '2023-09-20 16:04:15', '2023-09-20 16:09:36'),
(4, 1, '2023-09-20 16:09:41', '2023-09-20 16:27:34'),
(5, 1, '2023-09-20 16:27:38', '2023-09-20 16:34:47'),
(6, 1, '2023-09-20 16:34:51', '2023-09-20 16:37:40'),
(7, 1, '2023-09-20 16:38:09', '2023-09-20 16:45:35'),
(8, 1, '2023-09-20 16:45:41', '2023-09-20 16:57:29'),
(9, 1, '2023-09-20 17:11:27', '2023-09-20 19:07:46'),
(10, 1, '2023-09-20 19:08:47', '2023-09-20 19:58:08'),
(11, 1, '2023-09-20 20:03:05', '2023-09-20 20:21:07'),
(12, 1, '2023-09-21 06:53:52', '2023-09-21 08:19:06'),
(13, 1, '2023-09-21 08:21:03', '2023-09-21 10:06:31'),
(14, 5, '2023-09-21 10:06:40', '2023-09-21 10:15:00'),
(15, 1, '2023-09-21 10:15:06', '2023-09-21 10:25:24'),
(16, 6, '2023-09-21 10:28:20', '2023-09-21 10:31:16'),
(17, 2, '2023-09-21 10:31:23', '2023-09-21 10:34:14'),
(18, 6, '2023-09-21 10:34:18', '2023-09-21 10:34:23'),
(19, 3, '2023-09-21 10:34:28', '2023-09-21 10:38:04'),
(20, 4, '2023-09-21 10:38:09', '2023-09-21 10:42:46'),
(21, 1, '2023-09-21 10:43:54', '2023-09-21 10:56:50'),
(22, 7, '2023-09-21 10:56:20', '2023-09-21 11:18:02'),
(23, 1, '2023-09-21 10:57:38', '2023-09-21 10:58:43'),
(24, 6, '2023-09-21 10:58:52', '2023-09-21 11:07:08'),
(25, 7, '2023-09-21 11:07:13', '2023-09-21 11:07:28'),
(26, 1, '2023-09-21 11:07:41', '2023-09-21 11:20:10'),
(27, 1, '2023-09-21 11:15:00', '2023-09-21 11:15:14'),
(28, 7, '2023-09-21 11:27:50', '2023-09-21 11:38:14'),
(29, 1, '2023-09-21 11:52:05', '2023-09-21 12:03:26'),
(30, 2, '2023-09-21 12:44:41', '2023-09-21 14:14:59'),
(31, 7, '2023-09-21 13:50:55', '2023-09-21 14:05:12'),
(32, 4, '2023-09-21 14:15:06', '2023-09-21 14:15:10'),
(33, 3, '2023-09-21 14:15:14', '2023-09-21 14:39:57'),
(34, 1, '2023-09-21 14:40:05', '2023-09-21 14:42:14'),
(35, 2, '2023-09-21 14:42:20', '2023-09-21 15:00:36'),
(36, 1, '2023-09-21 14:48:45', NULL),
(37, 1, '2023-09-21 14:49:18', NULL),
(38, 1, '2023-09-21 14:51:36', NULL),
(39, 2, '2023-09-21 14:52:49', '2023-09-21 14:59:16'),
(40, 1, '2023-09-21 14:53:13', NULL),
(41, 3, '2023-09-21 14:59:35', '2023-09-21 14:59:43'),
(42, 4, '2023-09-21 15:00:01', '2023-09-21 15:02:23'),
(43, 4, '2023-09-21 15:02:52', '2023-09-21 15:03:07'),
(44, 4, '2023-09-21 15:03:15', '2023-09-21 15:05:41'),
(45, 8, '2023-09-21 15:05:44', '2023-09-21 16:49:29'),
(46, 8, '2023-09-21 16:49:33', '2023-09-21 16:54:56'),
(47, 4, '2023-09-21 16:55:02', '2023-09-21 16:55:51'),
(48, 8, '2023-09-21 16:55:59', '2023-09-21 17:05:28'),
(49, 4, '2023-09-21 17:06:02', '2023-09-21 17:07:09'),
(50, 8, '2023-09-21 17:07:14', '2023-09-21 17:07:33'),
(51, 4, '2023-09-21 17:12:17', '2023-09-21 17:14:05'),
(52, 8, '2023-09-21 17:19:08', NULL),
(53, 8, '2023-09-21 17:20:22', '2023-09-21 17:41:53'),
(54, 8, '2023-09-21 17:25:54', '2023-09-21 17:26:19'),
(55, 8, '2023-09-21 17:31:52', NULL),
(56, 8, '2023-09-21 17:32:11', '2023-09-21 17:32:41'),
(57, 8, '2023-09-21 19:20:46', NULL),
(58, 8, '2023-09-21 19:20:49', '2023-09-21 19:23:01'),
(59, 4, '2023-09-21 19:21:25', '2023-09-21 19:27:39'),
(60, 1, '2023-09-21 19:24:07', '2023-09-21 19:27:42'),
(61, 8, '2023-09-22 07:43:52', '2023-09-22 07:51:33'),
(62, 2, '2023-09-22 07:52:09', '2023-09-22 08:20:36'),
(63, 4, '2023-09-22 09:14:21', '2023-09-22 09:36:47'),
(64, 8, '2023-09-22 09:25:42', '2023-09-22 09:26:35'),
(65, 8, '2023-09-25 07:42:35', '2023-09-25 07:43:28'),
(66, 4, '2023-09-25 07:43:51', '2023-09-25 07:46:22'),
(67, 8, '2023-09-25 07:46:51', '2023-09-25 07:47:49'),
(68, 4, '2023-09-25 07:47:53', '2023-09-25 08:02:35'),
(69, 2, '2023-09-26 10:27:40', '2023-09-26 12:10:01'),
(70, 2, '2023-09-26 12:10:08', '2023-09-26 13:30:50'),
(71, 2, '2023-09-27 08:48:38', '2023-09-27 09:21:11'),
(72, 2, '2023-09-27 09:34:02', '2023-09-27 10:45:41');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int NOT NULL,
  `to_account_id` int NOT NULL,
  `from_account_id` int NOT NULL,
  `subject` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `send_date` datetime NOT NULL,
  `readornot` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `post_type_id` int NOT NULL,
  `category_id` int NOT NULL,
  `account_id` int NOT NULL,
  `post_headline` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_update` datetime DEFAULT NULL,
  `post_views` int DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `post_types`
--

DROP TABLE IF EXISTS `post_types`;
CREATE TABLE IF NOT EXISTS `post_types` (
  `post_type_id` int NOT NULL AUTO_INCREMENT,
  `post_type_title` varchar(50) NOT NULL,
  PRIMARY KEY (`post_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `post_types`
--

INSERT INTO `post_types` (`post_type_id`, `post_type_title`) VALUES
(1, 'Forum'),
(2, 'Article'),
(3, 'Notes');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `profile_id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `secondname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `education` varchar(150) DEFAULT NULL,
  `internship` varchar(150) DEFAULT NULL,
  `information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `worktitle` varchar(100) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `profiles`
--

INSERT INTO `profiles` (`profile_id`, `account_id`, `firstname`, `secondname`, `lastname`, `picture`, `education`, `internship`, `information`, `worktitle`, `location`, `birthday`) VALUES
(1, 1, 'SD1nxTO0', 'VD1o', 'Qzxi', 'scrooge.png', 'Datateknikker med speciale i programering', 'Nothing needed', 'This is an owner test profile, let us see if this profile get updated with success, yet another update, third time is the charm.', 'CEO', 'TEC Ballerup', '1867-11-11'),
(2, 5, 'QzxiyyiqB/t6', '', 'Qzxi', 'daisy.webp', 'Datateknikker med speciale i programering', 'Nothing needed', 'Daisy Duck is a hard nut to crack open', 'Team Cordinator', 'TEC Ballerup', '1940-06-07'),
(3, 6, 'TztowDO8', '', 'Tz1z3T8=', 'minnie-mouse.png', 'IT Supporter', 'Nothing needed', 'Minnie tries to be like Daisy, but it does not work as well as it should.', 'Team Coordinator', 'TEC Ballerup', '1928-11-18'),
(4, 2, 'TztlxT+g', '', 'Tz1z3T8=', 'mickey-mouse.png', 'Datateknikker med speciale i infrastruktur', 'Nothing needed', 'Mickey is a good instructor who like to help where he can', 'Team Instructor', 'TEC Ballerup', '1928-11-18'),
(5, 3, 'Rj1ozza9', '', 'RidlxQ==', 'donald.png', 'IT Supporter', 'Could use a lot', 'Donald really tries, But all the time he manage to get the entire network to break down. How he does it nobody knows, But hey it is Donald Duck we have here.', 'Team Instructor', 'TEC Ballerup', '1934-06-09'),
(6, 4, 'RSt0wQ==', '', 'RTdn3Da2AeZ6', 'gearloose.png', 'Datateknikker med speciale i programering', 'Nothing needed', 'He should be a Team Instructor, but you find him all other places then behind his desk. He like to make the most insane inventions all the time, most of them work if not Donald has been near them.', 'Inventor', 'TEC Ballerup', '1952-05-19'),
(7, 8, 'RT1pyCM=', '', 'RT1pyA==', 'goofy.webp', 'Datateknikker med speciale i programering', 'TEC Ballerup Internship Center', 'Goofy tries what he can to learn programming, but most of the times he ends up with a puzzle. A puzzle he haven\'t solved yet. What it is nobody knows, really strange indeed.', 'Student', 'TEC Ballerup', '1932-05-25');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`) VALUES
(1, 'Owner', '2023-08-18 14:15:26'),
(2, 'Admin', '2023-08-18 14:15:32'),
(3, 'Instructor', '2023-08-18 14:15:40'),
(4, 'Student', '2023-08-18 14:15:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
