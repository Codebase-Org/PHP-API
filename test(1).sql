-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1:3306
-- Genereringstid: 15. 08 2023 kl. 10:07:43
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
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(150) NOT NULL,
  `role_id` int NOT NULL,
  `created_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `email`, `role_id`, `created_date`, `end_date`) VALUES
(1, 'RSBjwDO3BPQ=', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'ZSBjwDO3BPRfldPCG5nf+LWZ2w==', 1, '2023-05-09', NULL),
(2, 'djd12g==', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'djd12hqtC+Zrz9reDNbf', 1, '2023-05-09', NULL),
(3, 'djd12ms=', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'djd12muZGvBslZjdANTS+w==', 4, '2023-05-09', NULL),
(4, 'djd12m4=', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'djd12m6ZGvBslZjdANTS+w==', 1, '2023-05-09', NULL),
(5, 'djd12m8=', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'djd12m+ZGvBslZjdANTS+w==', 1, '2023-05-09', NULL),
(6, 'djd12mw=', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'djd12myZGvBslZjdANTS+w==', 1, '2023-05-09', NULL),
(7, 'USZzyj+3Gg==', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'cSZzyj+3GtVrhMXFQdvc9LeU', 4, '2023-05-25', NULL),
(8, 'USZzyj+3GqQ=', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'cSZzyj+3GqRfldPCG5nf+LWZ2w==', 4, '2023-05-25', NULL),
(9, 'USZzyj+3Gqc=', 'e21e779e00cc7fbb0edb1580dd0154b5fd1546b756e58d9d0172633854be9acd13c1e5da23429b8f8b8c9125cff17c6b50a72e5f2fd454801b077655d4944ded', 'cSZzyj+3GqdfldPCG5nf+LWZ2w==', 4, '2023-05-25', NULL);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `loginhistory`
--

DROP TABLE IF EXISTS `loginhistory`;
CREATE TABLE IF NOT EXISTS `loginhistory` (
  `loginhist_id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  PRIMARY KEY (`loginhist_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `loginhistory`
--

INSERT INTO `loginhistory` (`loginhist_id`, `account_id`, `login_time`, `logout_time`) VALUES
(1, 1, '2023-05-09 12:35:44', '2023-05-09 12:49:19'),
(2, 1, '2023-05-09 13:16:33', '2023-05-09 13:29:03'),
(3, 1, '2023-05-09 13:29:09', '2023-05-09 13:41:50'),
(4, 1, '2023-05-09 13:58:05', '2023-05-09 14:35:03'),
(5, 1, '2023-05-10 08:41:33', '2023-05-10 08:45:57'),
(6, 1, '2023-05-10 08:46:46', '2023-05-10 09:08:04'),
(7, 1, '2023-05-10 10:07:23', '2023-05-10 12:36:23'),
(8, 1, '2023-05-10 12:36:29', '2023-05-10 13:35:35'),
(9, 1, '2023-05-22 08:21:53', '2023-05-22 09:05:37'),
(10, 1, '2023-05-22 10:21:32', '2023-05-22 10:23:46'),
(11, 3, '2023-05-22 10:24:16', '2023-05-22 10:24:51'),
(12, 3, '2023-05-22 10:25:00', '2023-05-22 10:26:35'),
(13, 1, '2023-05-22 10:26:37', '2023-05-22 10:39:09'),
(14, 1, '2023-05-22 11:01:26', '2023-05-22 11:11:45'),
(15, 1, '2023-05-24 08:30:39', '2023-05-24 09:20:44'),
(16, 1, '2023-05-24 09:40:14', '2023-05-24 10:41:49'),
(17, 1, '2023-05-24 10:54:56', '2023-05-24 10:56:56'),
(18, 3, '2023-05-24 10:57:02', '2023-05-24 10:57:31'),
(19, 1, '2023-05-24 11:00:39', '2023-05-24 11:11:28'),
(20, 1, '2023-05-24 11:39:46', '2023-05-24 12:01:27'),
(21, 1, '2023-05-24 12:14:48', '2023-05-24 12:51:22'),
(22, 1, '2023-05-24 13:43:49', '2023-05-24 14:01:13'),
(23, 1, '2023-05-25 07:31:46', '2023-05-25 07:34:22'),
(24, 2, '2023-05-25 07:35:00', '2023-05-25 07:54:13'),
(25, 1, '2023-05-25 08:06:10', '2023-05-25 08:14:09'),
(26, 2, '2023-05-25 08:14:14', '2023-05-25 08:16:15'),
(27, 1, '2023-05-25 08:16:19', '2023-05-25 09:20:23'),
(28, 1, '2023-05-25 10:03:51', '2023-05-25 10:52:13'),
(29, 7, '2023-05-25 10:52:17', '2023-05-25 10:52:24'),
(30, 1, '2023-05-25 10:52:27', '2023-05-25 11:09:51'),
(31, 1, '2023-05-25 11:51:24', '2023-05-25 12:27:47');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `profile_id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `secondname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `information` text,
  `worktitle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data dump for tabellen `profile`
--

INSERT INTO `profile` (`profile_id`, `account_id`, `firstname`, `secondname`, `lastname`, `picture`, `information`, `worktitle`) VALUES
(1, 1, 'Tztlxju8Ag==', 'RTtqzD+rGg==', 'SjNo3T+3', NULL, 'Data kommer senere', 'Elev'),
(2, 3, 'Qzxiyyiq', '', 'Qzxi', NULL, 'Llkdsflkjhdsfl.kjhfdgsgfdsfdhdhbxvc bfstdh', 'Doven');

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
(1, 'Owner', '2023-04-24 11:00:39'),
(2, 'Admin', '2023-04-24 11:00:47'),
(3, 'Instructor', '2023-04-24 11:00:53'),
(4, 'Student', '2023-04-24 11:00:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
