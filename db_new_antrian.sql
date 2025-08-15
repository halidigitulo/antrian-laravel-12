-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2025 at 01:30 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_new_antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` bigint UNSIGNED NOT NULL,
  `prefix` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Prefix for the queue, e.g., A, B, C',
  `number` int NOT NULL COMMENT 'Queue number, e.g., 1, 2, 3',
  `date` date NOT NULL COMMENT 'Date of the queue',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT 'Status of the queue: 0: waiting, 1: called, 2: completed',
  `loket_id` tinyint DEFAULT NULL COMMENT 'Loket where the queue is processed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `prefix`, `number`, `date`, `status`, `loket_id`, `created_at`, `updated_at`) VALUES
(1, 'A', 1, '2025-08-05', 0, NULL, '2025-08-05 05:49:31', '2025-08-05 05:49:31'),
(2, 'A', 2, '2025-08-05', 0, NULL, '2025-08-05 05:49:35', '2025-08-05 05:49:35'),
(3, 'B', 1, '2025-08-05', 0, NULL, '2025-08-05 05:49:42', '2025-08-05 05:49:42'),
(4, 'M', 1, '2025-08-05', 0, NULL, '2025-08-05 05:49:45', '2025-08-05 05:49:45'),
(5, 'A', 3, '2025-08-05', 0, NULL, '2025-08-05 05:49:54', '2025-08-05 05:49:54'),
(6, 'A', 4, '2025-08-05', 0, NULL, '2025-08-05 05:49:58', '2025-08-05 05:49:58'),
(7, 'A', 5, '2025-08-05', 0, NULL, '2025-08-05 05:50:22', '2025-08-05 05:50:22'),
(8, 'A', 1, '2025-08-06', 0, NULL, '2025-08-05 16:28:52', '2025-08-05 16:28:52'),
(9, 'A', 1, '2025-08-07', 1, 2, '2025-08-06 22:37:29', '2025-08-06 22:38:14'),
(10, 'A', 2, '2025-08-07', 1, 2, '2025-08-06 22:37:35', '2025-08-06 22:59:37'),
(11, 'A', 3, '2025-08-07', 1, 2, '2025-08-06 22:37:39', '2025-08-06 22:59:47'),
(12, 'B', 1, '2025-08-07', 1, 5, '2025-08-06 22:56:03', '2025-08-06 23:02:24'),
(13, 'M', 1, '2025-08-07', 1, 5, '2025-08-06 23:01:17', '2025-08-06 23:09:01'),
(14, 'M', 2, '2025-08-07', 1, 5, '2025-08-06 23:01:23', '2025-08-06 23:09:10'),
(15, 'M', 3, '2025-08-07', 1, 1, '2025-08-06 23:01:26', '2025-08-07 02:15:44'),
(16, 'A', 4, '2025-08-07', 1, 1, '2025-08-07 01:58:48', '2025-08-07 01:59:00'),
(17, 'A', 5, '2025-08-07', 1, 1, '2025-08-07 01:58:52', '2025-08-07 02:04:51'),
(18, 'A', 6, '2025-08-07', 1, 1, '2025-08-07 02:08:42', '2025-08-07 02:09:07'),
(19, 'A', 7, '2025-08-07', 1, 1, '2025-08-07 02:08:46', '2025-08-07 02:10:27'),
(20, 'A', 8, '2025-08-07', 1, 1, '2025-08-07 02:08:50', '2025-08-07 02:10:43'),
(21, 'B', 2, '2025-08-07', 1, 1, '2025-08-07 02:12:23', '2025-08-07 02:12:39'),
(22, 'B', 3, '2025-08-07', 1, 1, '2025-08-07 02:12:27', '2025-08-07 02:13:24'),
(23, 'B', 4, '2025-08-07', 1, 1, '2025-08-07 02:12:31', '2025-08-07 02:13:43'),
(24, 'M', 4, '2025-08-07', 1, 1, '2025-08-07 02:15:22', '2025-08-07 02:16:02'),
(25, 'M', 5, '2025-08-07', 1, 1, '2025-08-07 02:15:25', '2025-08-07 02:16:27'),
(26, 'M', 6, '2025-08-07', 1, 1, '2025-08-07 02:15:28', '2025-08-07 02:16:22'),
(27, 'A', 9, '2025-08-07', 1, 1, '2025-08-07 02:16:41', '2025-08-07 02:17:02'),
(28, 'A', 10, '2025-08-07', 1, 1, '2025-08-07 02:16:44', '2025-08-07 02:17:16'),
(29, 'A', 11, '2025-08-07', 1, 1, '2025-08-07 02:16:47', '2025-08-07 02:17:29'),
(30, 'A', 12, '2025-08-07', 1, 1, '2025-08-07 03:21:18', '2025-08-07 03:21:40'),
(31, 'B', 5, '2025-08-07', 1, 1, '2025-08-07 03:21:21', '2025-08-07 03:22:15'),
(32, 'B', 6, '2025-08-07', 1, 1, '2025-08-07 03:21:25', '2025-08-07 03:23:51'),
(33, 'A', 13, '2025-08-07', 1, 1, '2025-08-07 03:28:56', '2025-08-07 03:29:29'),
(34, 'B', 7, '2025-08-07', 1, 1, '2025-08-07 03:28:59', '2025-08-07 04:08:12'),
(35, 'M', 7, '2025-08-07', 1, 1, '2025-08-07 03:29:03', '2025-08-07 03:32:34'),
(36, 'B', 8, '2025-08-07', 1, 1, '2025-08-07 03:29:07', '2025-08-07 04:09:32'),
(37, 'M', 8, '2025-08-07', 1, 1, '2025-08-07 03:29:10', '2025-08-07 03:33:46'),
(38, 'A', 14, '2025-08-07', 1, 1, '2025-08-07 04:08:25', '2025-08-07 04:42:35'),
(39, 'B', 9, '2025-08-07', 1, 1, '2025-08-07 04:08:29', '2025-08-07 04:35:12'),
(40, 'A', 15, '2025-08-07', 0, NULL, '2025-08-07 06:36:29', '2025-08-07 06:36:29'),
(41, 'B', 10, '2025-08-07', 0, NULL, '2025-08-07 06:36:32', '2025-08-07 06:36:32'),
(42, 'M', 9, '2025-08-07', 1, 1, '2025-08-07 06:36:35', '2025-08-07 06:36:48'),
(43, 'M', 10, '2025-08-07', 0, NULL, '2025-08-07 06:36:38', '2025-08-07 06:36:38'),
(44, 'A', 16, '2025-08-07', 0, NULL, '2025-08-07 06:43:57', '2025-08-07 06:43:57'),
(45, 'A', 17, '2025-08-07', 0, NULL, '2025-08-07 13:03:00', '2025-08-07 13:03:00'),
(46, 'B', 11, '2025-08-07', 0, NULL, '2025-08-07 13:03:13', '2025-08-07 13:03:13'),
(47, 'A', 1, '2025-08-08', 1, 1, '2025-08-07 21:15:55', '2025-08-08 09:32:34'),
(48, 'B', 1, '2025-08-08', 1, 1, '2025-08-07 21:15:59', '2025-08-08 09:27:27'),
(49, 'M', 1, '2025-08-08', 1, 1, '2025-08-07 21:16:03', '2025-08-08 09:29:15'),
(50, 'A', 2, '2025-08-08', 1, 6, '2025-08-07 21:16:07', '2025-08-08 12:51:48'),
(51, 'B', 2, '2025-08-08', 1, 1, '2025-08-07 21:16:10', '2025-08-08 09:27:37'),
(52, 'M', 2, '2025-08-08', 1, 1, '2025-08-07 21:16:13', '2025-08-08 09:29:45'),
(53, 'A', 3, '2025-08-08', 0, NULL, '2025-08-07 21:18:36', '2025-08-07 21:18:36'),
(54, 'A', 4, '2025-08-08', 0, NULL, '2025-08-08 09:30:17', '2025-08-08 09:30:17'),
(55, 'B', 3, '2025-08-08', 1, 6, '2025-08-08 09:30:20', '2025-08-08 12:53:53'),
(56, 'M', 3, '2025-08-08', 0, NULL, '2025-08-08 09:30:23', '2025-08-08 09:30:23'),
(57, 'M', 4, '2025-08-08', 0, NULL, '2025-08-08 09:30:27', '2025-08-08 09:30:27'),
(58, 'M', 5, '2025-08-08', 0, NULL, '2025-08-08 09:30:30', '2025-08-08 09:30:30'),
(59, 'B', 4, '2025-08-08', 1, 1, '2025-08-08 09:30:33', '2025-08-08 13:16:50'),
(60, 'B', 5, '2025-08-08', 0, NULL, '2025-08-08 09:30:37', '2025-08-08 09:30:37'),
(61, 'A', 5, '2025-08-08', 0, NULL, '2025-08-08 09:30:40', '2025-08-08 09:30:40'),
(62, 'A', 1, '2025-08-12', 1, 1, '2025-08-11 21:00:42', '2025-08-11 21:09:52'),
(63, 'A', 2, '2025-08-12', 1, 1, '2025-08-11 21:00:46', '2025-08-11 21:10:29'),
(64, 'A', 3, '2025-08-12', 1, 1, '2025-08-11 21:00:50', '2025-08-11 21:21:29'),
(65, 'B', 1, '2025-08-12', 1, 1, '2025-08-11 21:00:56', '2025-08-11 21:02:27'),
(66, 'B', 2, '2025-08-12', 1, 1, '2025-08-11 21:01:02', '2025-08-11 21:03:50'),
(67, 'B', 3, '2025-08-12', 1, 1, '2025-08-11 21:01:07', '2025-08-11 21:04:21'),
(68, 'M', 1, '2025-08-12', 1, 1, '2025-08-11 21:01:11', '2025-08-11 21:04:31'),
(69, 'M', 2, '2025-08-12', 1, 1, '2025-08-11 21:01:15', '2025-08-11 21:55:08'),
(70, 'M', 3, '2025-08-12', 1, 2, '2025-08-11 21:01:19', '2025-08-11 22:10:16'),
(71, 'A', 4, '2025-08-12', 1, 2, '2025-08-11 22:20:26', '2025-08-11 22:21:11'),
(72, 'B', 4, '2025-08-12', 1, 2, '2025-08-11 22:20:30', '2025-08-11 23:27:19'),
(73, 'M', 4, '2025-08-12', 1, 2, '2025-08-11 22:20:33', '2025-08-11 23:31:03'),
(74, 'A', 5, '2025-08-12', 1, 2, '2025-08-11 22:20:36', '2025-08-11 23:08:41'),
(75, 'B', 5, '2025-08-12', 1, 2, '2025-08-11 22:20:40', '2025-08-11 23:28:14'),
(76, 'M', 5, '2025-08-12', 1, 2, '2025-08-11 22:20:44', '2025-08-11 23:31:25'),
(77, 'A', 6, '2025-08-12', 1, 1, '2025-08-11 22:20:48', '2025-08-11 23:32:35'),
(78, 'B', 6, '2025-08-12', 1, 2, '2025-08-11 22:20:52', '2025-08-11 23:28:31'),
(79, 'M', 6, '2025-08-12', 1, 2, '2025-08-11 22:20:56', '2025-08-11 23:31:43'),
(80, 'A', 7, '2025-08-12', 1, 1, '2025-08-11 23:32:01', '2025-08-11 23:33:18'),
(81, 'A', 8, '2025-08-12', 1, 1, '2025-08-11 23:32:05', '2025-08-11 23:33:57'),
(82, 'A', 9, '2025-08-12', 1, 1, '2025-08-11 23:32:08', '2025-08-11 23:34:40'),
(83, 'A', 10, '2025-08-12', 1, 1, '2025-08-12 00:17:59', '2025-08-12 00:18:54'),
(84, 'B', 7, '2025-08-12', 1, 1, '2025-08-12 00:18:03', '2025-08-12 00:18:42'),
(85, 'B', 8, '2025-08-12', 1, 1, '2025-08-12 00:18:07', '2025-08-12 00:20:06'),
(86, 'B', 9, '2025-08-12', 1, 1, '2025-08-12 00:18:10', '2025-08-12 00:20:16'),
(87, 'B', 10, '2025-08-12', 1, 1, '2025-08-12 00:18:14', '2025-08-12 00:21:35'),
(88, 'M', 7, '2025-08-12', 1, 1, '2025-08-12 00:18:17', '2025-08-12 14:28:00'),
(89, 'M', 8, '2025-08-12', 1, 1, '2025-08-12 00:18:20', '2025-08-12 14:33:08'),
(90, 'M', 9, '2025-08-12', 0, NULL, '2025-08-12 00:18:23', '2025-08-12 00:18:23'),
(91, 'M', 10, '2025-08-12', 0, NULL, '2025-08-12 00:18:26', '2025-08-12 00:18:26'),
(92, 'A', 11, '2025-08-12', 1, 1, '2025-08-12 03:49:17', '2025-08-12 14:21:40'),
(93, 'B', 11, '2025-08-12', 1, 1, '2025-08-12 04:16:32', '2025-08-12 14:25:26'),
(94, 'A', 12, '2025-08-12', 1, 2, '2025-08-12 04:23:47', '2025-08-12 14:39:23'),
(95, 'A', 13, '2025-08-12', 0, NULL, '2025-08-12 06:56:17', '2025-08-12 06:56:17'),
(96, 'A', 14, '2025-08-12', 0, NULL, '2025-08-12 14:28:39', '2025-08-12 14:28:39'),
(97, 'B', 12, '2025-08-12', 0, NULL, '2025-08-12 14:28:43', '2025-08-12 14:28:43'),
(98, 'B', 13, '2025-08-12', 0, NULL, '2025-08-12 14:28:46', '2025-08-12 14:28:46'),
(99, 'M', 11, '2025-08-12', 0, NULL, '2025-08-12 14:28:49', '2025-08-12 14:28:49'),
(100, 'A', 1, '2025-08-13', 1, 2, '2025-08-13 08:53:37', '2025-08-13 08:54:08'),
(101, 'B', 1, '2025-08-13', 1, 2, '2025-08-13 08:53:40', '2025-08-13 08:55:30'),
(102, 'M', 1, '2025-08-13', 1, 2, '2025-08-13 08:53:43', '2025-08-13 09:00:03'),
(103, 'A', 2, '2025-08-13', 1, 2, '2025-08-13 08:55:39', '2025-08-13 08:55:51'),
(104, 'B', 2, '2025-08-13', 1, 2, '2025-08-13 08:55:42', '2025-08-13 08:56:24'),
(105, 'B', 3, '2025-08-13', 1, 2, '2025-08-13 08:56:49', '2025-08-13 08:59:10'),
(106, 'A', 3, '2025-08-13', 1, 2, '2025-08-13 08:56:52', '2025-08-13 08:57:18'),
(107, 'B', 4, '2025-08-13', 1, 2, '2025-08-13 08:56:55', '2025-08-13 08:59:56'),
(108, 'A', 4, '2025-08-13', 1, 2, '2025-08-13 08:56:58', '2025-08-13 08:59:01'),
(109, 'A', 5, '2025-08-13', 1, 2, '2025-08-13 09:01:10', '2025-08-13 09:01:30'),
(110, 'B', 5, '2025-08-13', 1, 2, '2025-08-13 09:01:13', '2025-08-13 09:02:48'),
(111, 'A', 6, '2025-08-13', 1, 2, '2025-08-13 09:01:16', '2025-08-13 09:01:35'),
(112, 'A', 7, '2025-08-13', 1, 2, '2025-08-13 09:01:20', '2025-08-13 09:02:01'),
(113, 'B', 6, '2025-08-13', 1, 2, '2025-08-13 09:01:23', '2025-08-13 09:02:53'),
(114, 'B', 7, '2025-08-13', 1, 2, '2025-08-13 09:03:16', '2025-08-13 09:03:29'),
(115, 'A', 8, '2025-08-13', 1, 2, '2025-08-13 09:03:19', '2025-08-13 09:03:36'),
(116, 'B', 8, '2025-08-13', 1, 2, '2025-08-13 09:04:03', '2025-08-13 09:04:11'),
(117, 'B', 9, '2025-08-13', 1, 2, '2025-08-13 09:06:44', '2025-08-13 09:07:11'),
(118, 'B', 10, '2025-08-13', 1, 2, '2025-08-13 09:06:46', '2025-08-13 09:07:40'),
(119, 'A', 9, '2025-08-13', 1, 2, '2025-08-13 09:06:53', '2025-08-13 09:09:14'),
(120, 'A', 10, '2025-08-13', 1, 2, '2025-08-13 09:06:56', '2025-08-13 09:10:21'),
(121, 'A', 11, '2025-08-13', 1, 2, '2025-08-13 09:10:28', '2025-08-13 09:10:46'),
(122, 'A', 12, '2025-08-13', 1, 2, '2025-08-13 09:10:31', '2025-08-13 09:11:00'),
(123, 'A', 13, '2025-08-13', 1, 2, '2025-08-13 09:10:34', '2025-08-13 09:12:24'),
(124, 'A', 14, '2025-08-13', 1, 2, '2025-08-13 09:12:32', '2025-08-13 09:13:02'),
(125, 'B', 11, '2025-08-13', 1, 2, '2025-08-13 09:12:34', '2025-08-13 09:14:11'),
(126, 'B', 12, '2025-08-13', 0, NULL, '2025-08-13 09:12:37', '2025-08-13 09:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:53:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"dashboard.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:13:\"settings.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:12:\"roles.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:10:\"roles.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:12:\"roles.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"roles.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:10:\"users.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"users.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"users.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"users.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"menus.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:10:\"menus.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"menus.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:12:\"menus.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:14:\"profile.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:12:\"profile.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:14:\"profile.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:18:\"permissions.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:16:\"permissions.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:18:\"permissions.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:18:\"permissions.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:20:\"ambil-antrian.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:18:\"ambil-antrian.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:20:\"ambil-antrian.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:20:\"ambil-antrian.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:22:\"display-antrian.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:20:\"display-antrian.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:22:\"display-antrian.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:22:\"display-antrian.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:20:\"loket-antrian.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:18:\"loket-antrian.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:20:\"loket-antrian.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:20:\"loket-antrian.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:14:\"antrian.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:12:\"antrian.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:14:\"antrian.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:14:\"antrian.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:13:\"dokter.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:11:\"dokter.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:13:\"dokter.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:13:\"dokter.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:41;a:3:{s:1:\"a\";i:42;s:1:\"b\";s:18:\"konfigurasi.create\";s:1:\"c\";s:3:\"web\";}i:42;a:3:{s:1:\"a\";i:43;s:1:\"b\";s:16:\"konfigurasi.read\";s:1:\"c\";s:3:\"web\";}i:43;a:3:{s:1:\"a\";i:44;s:1:\"b\";s:18:\"konfigurasi.update\";s:1:\"c\";s:3:\"web\";}i:44;a:3:{s:1:\"a\";i:45;s:1:\"b\";s:18:\"konfigurasi.delete\";s:1:\"c\";s:3:\"web\";}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:19:\"spesialisasi.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:17:\"spesialisasi.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:19:\"spesialisasi.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:19:\"spesialisasi.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:23:\"general-settings.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:21:\"general-settings.read\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:23:\"general-settings.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:23:\"general-settings.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:4:\"user\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:6:\"satpam\";s:1:\"c\";s:3:\"web\";}}}', 1755095089);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesialisasi_id` tinyint UNSIGNED NOT NULL,
  `is_praktik` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `spesialisasi_id`, `is_praktik`, `created_at`, `updated_at`) VALUES
(1, 'dr. Lalu Irawan Surasmaji, M.Si.Med.,Sp.A', 1, 1, '2025-08-12 03:22:55', '2025-08-12 06:31:15'),
(2, 'dr. Kristopher May Pamudji, M.Biomed, Sp.A', 1, 1, '2025-08-12 03:34:40', '2025-08-12 04:32:13'),
(3, 'dr. Joko Anggoro, M.Sc.,Sp.PD(K)HOM', 8, 1, '2025-08-12 03:52:35', '2025-08-12 04:32:44'),
(4, 'dr. I Gusti Putu Winangun, Sp.PD,FINASIM', 8, 1, '2025-08-12 06:31:47', '2025-08-12 06:43:30'),
(5, 'dr. Karismayusa Sudjana, M. Biomed, Sp. PD', 8, 1, '2025-08-12 06:32:09', '2025-08-12 06:43:32'),
(6, 'dr. Rico Novyanto, Sp.PD', 8, 1, '2025-08-12 06:35:17', '2025-08-12 14:32:25'),
(7, 'dr. Sugianto Prajitno, Sp.BA', 33, 1, '2025-08-12 06:35:42', '2025-08-12 06:56:37'),
(8, 'Dr. dr. Ilsa Hunaifi, Sp.N.Subsp.ENK(K)', 36, 1, '2025-08-12 06:36:21', '2025-08-12 06:43:23'),
(9, 'dr. I Wayan Tunjung, Sp.S', 36, 1, '2025-08-12 06:36:35', '2025-08-12 06:43:31'),
(10, 'dr. Muhamad Arif Sudianto Utama, Sp. THT-KL', 7, 1, '2025-08-12 06:36:45', '2025-08-12 06:43:39'),
(11, 'dr. Markus Rambu, Sp. THT-KL', 7, 1, '2025-08-12 06:36:57', '2025-08-12 06:43:38'),
(12, 'dr. Dedianto Hidajat, Sp.DVE', 5, 1, '2025-08-12 06:37:08', '2025-08-12 06:43:22'),
(13, 'dr. Elly Rosilla Wijaya, Sp.KJ., M.M', 37, 1, '2025-08-12 06:37:41', '2025-08-12 06:43:24'),
(14, 'dr. Lusiana Wahyu Ratna Wijayanti, Sp. KJ', 37, 1, '2025-08-12 06:37:51', '2025-08-12 06:43:37'),
(15, 'dr. Basuki Rahmat, Sp.JP (K), FIHA', 4, 1, '2025-08-12 06:38:00', '2025-08-12 06:43:22'),
(16, 'Dr. dr. Yusra Pintaningrum, Sp.JP(K),FIHA,FAPSC,FAsCC,FAPSIC', 4, 1, '2025-08-12 06:38:10', '2025-08-12 06:43:24'),
(17, 'dr. A. A. Sg. Mas Meiswaryasti Putra, M. Bio. SpJP (K) FIHA', 4, 1, '2025-08-12 06:38:21', '2025-08-12 06:43:20'),
(18, 'dr. Evan Evianto, Sp.B', 2, 1, '2025-08-12 06:38:33', '2025-08-12 06:43:25'),
(19, 'dr. Ramses Indriawan,Sp.B (K) Onk.', 2, 1, '2025-08-12 06:38:51', '2025-08-12 07:11:13'),
(20, 'dr. Made Agus Suanjaya, Sp.B,Syvso.On(K),M.H,CMC', 2, 1, '2025-08-12 06:39:04', '2025-08-12 06:43:36'),
(21, 'dr. Noviana Maya Sari, M. biomed, Sp. B', 2, 1, '2025-08-12 06:39:13', '2025-08-12 06:43:41'),
(22, 'dr. Muhammad Amrul Husni, Sp.B', 2, 1, '2025-08-12 06:39:21', '2025-08-12 06:43:39'),
(23, 'dr. Henry Pebruanto, Sp.OT', 12, 1, '2025-08-12 06:39:33', '2025-08-12 06:43:29'),
(24, 'dr. H. Suharjendro, Sp.U(K),Ped.Urol', 11, 1, '2025-08-12 06:39:41', '2025-08-12 06:43:28'),
(25, 'dr. H. Slamet Tjahjono, Sp.P(K), FISR', 38, 1, '2025-08-12 06:40:11', '2025-08-12 06:43:28'),
(26, 'dr. Kana Wulung Arie Ichida Prinasetyo, Sp. P', 38, 1, '2025-08-12 06:40:20', '2025-08-12 06:43:32'),
(27, 'dr. Lili Dwiyanti, Sp. KFR', 10, 1, '2025-08-12 06:40:31', '2025-08-12 06:43:35'),
(28, 'dr. H. Nusairi, Sp.Rad(K)', 13, 1, '2025-08-12 06:40:40', '2025-08-12 06:43:26'),
(29, 'dr. Shirley Andriani Wiyono, M. Med.', 39, 1, '2025-08-12 06:41:12', '2025-08-12 14:32:24'),
(30, 'dr. Ayu Permata Sari, Sp.Ak', 39, 1, '2025-08-12 06:41:22', '2025-08-13 03:59:08'),
(31, 'drg. Siti Zaidah Z,Sp.BM', 3, 1, '2025-08-12 06:41:32', '2025-08-12 06:43:47'),
(32, 'drg. Regina Sugiyanthi', 3, 1, '2025-08-12 06:41:40', '2025-08-12 06:56:35'),
(33, 'dr. H. Adib Ahmad Shammakh, Sp.OG', 40, 1, '2025-08-12 06:42:19', '2025-08-12 06:43:25'),
(34, 'dr. Hj. Rusiyanti, Sp.OG', 40, 1, '2025-08-12 06:42:31', '2025-08-12 06:43:30'),
(35, 'dr. Muhammad Freddy Candra Sitepu, Sp. OG', 40, 1, '2025-08-12 06:42:39', '2025-08-12 06:43:40'),
(36, 'dr. Henry Santosa Sungkono, M. Biomed, Sp. M', 6, 1, '2025-08-12 06:42:53', '2025-08-12 06:43:29'),
(37, 'dr. Yulia Dewi Suandari, M.Biomed, Sp. M', 6, 1, '2025-08-12 06:43:01', '2025-08-12 06:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `running_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `running_text`, `created_at`, `updated_at`) VALUES
(1, 'Selamat Datang di Rumah Sakit Harapan Keluarga. Terimakasih atas kunjungan Anda. 🙏 #yourhealthourcare', '2025-08-05 02:03:16', '2025-08-12 07:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_antrian`
--

CREATE TABLE `jenis_antrian` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_antrian` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_aktif` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_antrian`
--

INSERT INTO `jenis_antrian` (`id`, `kode_antrian`, `nama`, `is_aktif`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Asuransi / Umum', 1, '2025-08-05 05:15:13', '2025-08-05 05:15:13'),
(2, 'B', 'BPJS Kesehatan', 1, '2025-08-05 05:20:05', '2025-08-05 05:22:30'),
(3, 'M', 'Mobile JKN', 1, '2025-08-05 05:23:35', '2025-08-05 05:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loket`
--

CREATE TABLE `loket` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_aktif` tinyint NOT NULL DEFAULT '1',
  `user_aktif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loket`
--

INSERT INTO `loket` (`id`, `nama`, `is_aktif`, `user_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Loket 1', 1, NULL, '2025-08-05 02:18:34', '2025-08-12 14:39:09'),
(2, 'Loket 2', 1, '7', '2025-08-05 02:21:43', '2025-08-12 14:39:14'),
(3, 'Loket 3', 1, NULL, '2025-08-05 02:21:57', '2025-08-05 02:23:05'),
(4, 'Loket 4', 1, NULL, '2025-08-05 02:22:06', '2025-08-05 02:23:05'),
(5, 'Loket 5', 1, NULL, '2025-08-05 02:22:16', '2025-08-06 23:09:17'),
(6, 'Loket 6', 0, NULL, '2025-08-08 12:51:24', '2025-08-08 12:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_protected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `menu_group`, `url`, `target`, `icon`, `parent_id`, `sort_order`, `permission_name`, `is_protected`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', NULL, '/dashboard', NULL, 'dashboard-2-line', NULL, 1, 'dashboard.read', 1, '2025-07-29 16:55:59', '2025-08-12 03:51:34'),
(2, 'Settings', NULL, '#', NULL, 'settings-line', NULL, 2, 'settings.read', 1, '2025-07-29 16:55:59', '2025-08-12 03:51:34'),
(3, 'Users', NULL, '/users', NULL, 'user-line', 2, 1, 'users.read', 1, '2025-07-29 16:55:59', '2025-08-12 03:51:34'),
(4, 'Roles', NULL, '/roles', NULL, 'guide-line', 2, 2, 'roles.read', 1, '2025-07-29 16:55:59', '2025-08-12 03:51:34'),
(5, 'Menus', NULL, '/menus', NULL, 'menu-line', 2, 3, 'menus.read', 1, '2025-07-29 16:55:59', '2025-08-12 03:51:34'),
(6, 'Permissions', NULL, '/permission', NULL, 'circle-line', 2, 4, 'permissions.read', 1, '2025-07-29 16:55:59', '2025-08-12 03:51:34'),
(7, 'Profile', NULL, '/profile', NULL, 'community-line', NULL, 3, 'profile.read', 1, '2025-07-29 16:55:59', '2025-08-12 03:51:34'),
(8, 'Antrian', NULL, '#', NULL, 'sort-number-asc', NULL, 4, NULL, 0, '2025-08-04 05:12:33', '2025-08-12 03:51:34'),
(9, 'Ambil', NULL, 'antrian/ambil', '_blank', 'circle-line', 8, 1, 'ambil-antrian.read', 0, '2025-08-04 05:12:59', '2025-08-12 03:51:34'),
(10, 'Display', NULL, '/antrian/display', '_blank', 'circle-line', 8, 2, 'display-antrian.read', 0, '2025-08-04 05:13:24', '2025-08-12 03:51:34'),
(11, 'Loket', NULL, 'antrian/loket', NULL, 'circle-line', 8, 3, NULL, 0, '2025-08-04 05:13:39', '2025-08-12 03:51:34'),
(13, 'Dokter', NULL, '/dokter', NULL, 'user-follow-fill', NULL, 5, 'dokter.read', 0, '2025-08-04 05:48:03', '2025-08-12 03:51:34'),
(14, 'Konfigurasi', NULL, 'konfigurasi', NULL, 'tools-line', NULL, 6, NULL, 0, '2025-08-04 05:56:31', '2025-08-12 03:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_10_131322_create_permission_tables', 1),
(5, '2025_07_10_132231_create_menus_table', 1),
(6, '2025_07_11_124816_add_is_protected_to_menus_table', 1),
(7, '2025_07_11_130525_add_menu_group_to_menus_table', 1),
(8, '2025_07_11_131949_add_sort_order_to_menus_table', 1),
(9, '2025_07_12_034829_add_username_to_users_table', 1),
(10, '2025_07_12_041716_add_details_to_users_table', 1),
(11, '2025_07_18_142912_create_profiles_table', 1),
(12, '2025_08_05_095257_create_general_settings_table', 2),
(13, '2025_08_05_101032_create_loket_table', 3),
(14, '2025_08_05_130826_create_jenis_antrian_table', 4),
(15, '2025_08_05_134400_create_antrian_table', 5),
(16, '2025_08_07_070509_add_icon_to_profiles_table', 6),
(17, '2025_08_12_090743_create_dokter_table', 7),
(18, '2025_08_12_091108_create_spesialisasi_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.read', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(2, 'settings.read', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(3, 'roles.create', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(4, 'roles.read', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(5, 'roles.update', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(6, 'roles.delete', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(7, 'users.read', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(8, 'users.create', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(9, 'users.update', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(10, 'users.delete', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(11, 'menus.create', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(12, 'menus.read', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(13, 'menus.update', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(14, 'menus.delete', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(15, 'profile.create', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(16, 'profile.read', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(17, 'profile.update', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(18, 'permissions.create', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(19, 'permissions.read', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(20, 'permissions.update', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(21, 'permissions.delete', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(22, 'ambil-antrian.create', 'web', '2025-08-04 05:31:41', '2025-08-12 03:50:44'),
(23, 'ambil-antrian.read', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(24, 'ambil-antrian.update', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(25, 'ambil-antrian.delete', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(26, 'display-antrian.create', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(27, 'display-antrian.read', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(28, 'display-antrian.update', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(29, 'display-antrian.delete', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(30, 'loket-antrian.create', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(31, 'loket-antrian.read', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(32, 'loket-antrian.update', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(33, 'loket-antrian.delete', 'web', '2025-08-04 05:31:41', '2025-08-04 05:31:41'),
(34, 'antrian.create', 'web', '2025-08-04 05:41:09', '2025-08-04 05:41:09'),
(35, 'antrian.read', 'web', '2025-08-04 05:41:09', '2025-08-04 05:41:09'),
(36, 'antrian.update', 'web', '2025-08-04 05:41:09', '2025-08-04 05:41:09'),
(37, 'antrian.delete', 'web', '2025-08-04 05:41:09', '2025-08-04 05:41:09'),
(38, 'dokter.create', 'web', '2025-08-04 05:48:08', '2025-08-04 05:48:08'),
(39, 'dokter.read', 'web', '2025-08-04 05:48:08', '2025-08-04 05:48:08'),
(40, 'dokter.update', 'web', '2025-08-04 05:48:08', '2025-08-04 05:48:08'),
(41, 'dokter.delete', 'web', '2025-08-04 05:48:08', '2025-08-04 05:48:08'),
(42, 'konfigurasi.create', 'web', '2025-08-04 05:57:07', '2025-08-04 05:57:07'),
(43, 'konfigurasi.read', 'web', '2025-08-04 05:57:07', '2025-08-04 05:57:07'),
(44, 'konfigurasi.update', 'web', '2025-08-04 05:57:07', '2025-08-04 05:57:07'),
(45, 'konfigurasi.delete', 'web', '2025-08-04 05:57:07', '2025-08-04 05:57:07'),
(46, 'spesialisasi.create', 'web', '2025-08-12 05:25:15', '2025-08-12 05:25:15'),
(47, 'spesialisasi.read', 'web', '2025-08-12 05:25:15', '2025-08-12 05:25:15'),
(48, 'spesialisasi.update', 'web', '2025-08-12 05:25:15', '2025-08-12 05:25:15'),
(49, 'spesialisasi.delete', 'web', '2025-08-12 05:25:15', '2025-08-12 05:25:15'),
(50, 'general-settings.create', 'web', '2025-08-12 07:18:36', '2025-08-12 07:18:36'),
(51, 'general-settings.read', 'web', '2025-08-12 07:18:36', '2025-08-12 07:18:36'),
(52, 'general-settings.update', 'web', '2025-08-12 07:18:36', '2025-08-12 07:18:36'),
(53, 'general-settings.delete', 'web', '2025-08-12 07:18:36', '2025-08-12 07:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direktur` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maps` text COLLATE utf8mb4_unicode_ci,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `nama`, `tagline`, `direktur`, `alamat`, `maps`, `telp`, `hp`, `email`, `website`, `video_url`, `instagram`, `facebook`, `youtube`, `tiktok`, `isi`, `logo`, `icon`, `cover`, `pdf`, `created_at`, `updated_at`) VALUES
(1, 'Antrian RS. Harapan Keluarga', 'Tagline Perusahaan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'https://www.youtube.com/embed/OpTuSWbMDMY', NULL, NULL, NULL, NULL, '<p><br></p>', 'Antrian RS. Harapan Keluarga_logo.png', 'Antrian RS. Harapan Keluarga_icon.png', NULL, NULL, '2025-07-29 16:55:59', '2025-08-07 06:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(2, 'user', 'web', '2025-07-29 16:55:59', '2025-07-29 16:55:59'),
(3, 'satpam', 'web', '2025-08-04 05:45:05', '2025-08-04 05:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(1, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(22, 3),
(23, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dIw46wRYJ2qu5wmm8PsfJpwDHrT5u4jSydkpgIeE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaDc3TXNVOHQxUHRwdTdTa3c1UmdOSDMzNnFPN2FpNm1yWGM0ZGZmZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hbnRyaWFuL2Rpc3BsYXkvZ2V0LWNhbGxlZC1xdWV1ZSI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1755076510);

-- --------------------------------------------------------

--
-- Table structure for table `spesialisasi`
--

CREATE TABLE `spesialisasi` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spesialisasi`
--

INSERT INTO `spesialisasi` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Spesialis Anak', NULL, '2025-08-12 06:31:03'),
(2, 'Spesialis Bedah Umum', NULL, NULL),
(3, 'Spesialis Gigi', NULL, NULL),
(4, 'Spesialis Jantung dan Pembuluh Darah', NULL, NULL),
(5, 'Spesialis Kulit dan Kelamin', NULL, NULL),
(6, 'Spesialis Mata', NULL, NULL),
(7, 'Spesialis THT', NULL, NULL),
(8, 'Spesialis Penyakit Dalam', NULL, NULL),
(9, 'Spesialis Psikiatri', NULL, NULL),
(10, 'Spesialis Rehabilitasi Medik', NULL, NULL),
(11, 'Spesialis Urologi', NULL, NULL),
(12, 'Spesialis Orthopedi', NULL, NULL),
(13, 'Spesialis Radiologi', NULL, NULL),
(14, 'Spesialis Anestesiologi', NULL, NULL),
(16, 'Spesialis Onkologi', NULL, NULL),
(33, 'Spesialis Bedah Anak', '2025-08-12 06:16:30', '2025-08-12 06:16:30'),
(36, 'Spesialis Saraf', '2025-08-12 06:36:11', '2025-08-12 06:36:11'),
(37, 'Spesialis Kesehatan Jiwa', '2025-08-12 06:37:27', '2025-08-12 06:37:27'),
(38, 'Spesialis Paru', '2025-08-12 06:40:02', '2025-08-12 06:40:02'),
(39, 'Spesalis Akupuntur', '2025-08-12 06:41:04', '2025-08-12 06:41:04'),
(40, 'Spesialis Kebidanan & Kandungan', '2025-08-12 06:42:08', '2025-08-12 06:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `role_id` tinyint NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `is_active`, `role_id`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'superadmin', 1, 1, '1754312965.png', '2025-07-29 16:55:59', '$2y$12$uZTrPAvXvgJNKRYeA2UfKeKL45qTsfMqPQ6c0aRwuRZ3kuyx26GM2', 'C1p40wMzStSyDQZ6GQXQrLzhbn75tRAvbMYkFTsuZYQPkdkdjjthGhPqD879', '2025-07-29 16:55:59', '2025-08-04 05:40:08'),
(3, 'Satpam', 'satpam', 1, 3, NULL, NULL, '$2y$12$qokiJC48MxQmtjjgljfwRudIdj4SrGQ9oPvDR6IgTxqk3MEJ6BaVy', NULL, '2025-08-04 05:45:34', '2025-08-04 05:45:34'),
(7, 'Loket 1', 'loket1', 1, 2, NULL, NULL, '$2y$12$Uwd2P0dtJ9lOAY0Qc77VFejRhbb4XOyjbx2e1FwgE/p6kzvrKpgTm', NULL, '2025-08-12 07:08:27', '2025-08-12 07:08:27'),
(8, 'Loket 2', 'loket2', 1, 2, NULL, NULL, '$2y$12$gvfJKnFMCTQw3IB3uYCviOrOdrGwab.maiox6vXJztszsFbDRFtDa', NULL, '2025-08-12 07:08:44', '2025-08-12 07:08:44'),
(9, 'Loket 3', 'loket3', 1, 2, NULL, NULL, '$2y$12$1vwyI.KUof8XcxWE95K1h.Thcn/97Kn.Wz1qJJc8/JNdYHTyTkrRe', NULL, '2025-08-12 07:09:00', '2025-08-12 07:09:00'),
(10, 'Loket 4', 'loket4', 1, 2, NULL, NULL, '$2y$12$rFpl.82dxVHYzpwXsIH/y.rg02ohd3gJkLytTiFfjFQe7iJdCLTGG', NULL, '2025-08-12 07:09:19', '2025-08-12 07:09:19'),
(11, 'Loket 5', 'loket5', 1, 2, NULL, NULL, '$2y$12$lFdzuh7JF8yRck6pnpIPU.16aENUB8iFN2RVFXkc0iaEXwRa8PkEC', NULL, '2025-08-12 07:09:35', '2025-08-12 07:09:35'),
(12, 'Loket 6', 'loket6', 1, 2, NULL, NULL, '$2y$12$uD8i32PoHFYYNxOVSq1lfuQGW.AuZtGplE3r.D4IFe8iAXsVqIAPO', NULL, '2025-08-12 07:09:54', '2025-08-12 07:09:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_antrian`
--
ALTER TABLE `jenis_antrian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis_antrian_kode_antrian_unique` (`kode_antrian`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loket`
--
ALTER TABLE `loket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loket_nama_unique` (`nama`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `spesialisasi`
--
ALTER TABLE `spesialisasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `spesialisasi_nama_unique` (`nama`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_antrian`
--
ALTER TABLE `jenis_antrian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loket`
--
ALTER TABLE `loket`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `spesialisasi`
--
ALTER TABLE `spesialisasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
