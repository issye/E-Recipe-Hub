-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 02:28 PM
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
-- Database: `recipe_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Failed','Updated','Logout','Critical','Success') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user`, `action`, `timestamp`, `status`) VALUES
(1, 'IssyeCooks', 'Logged In', '2025-01-29 16:46:07', 'Success'),
(2, 'IssyeCooks', 'Logged In', '2025-01-29 16:51:30', 'Success'),
(3, 'IssyeCooks', 'Logged In', '2025-01-29 17:05:21', 'Success'),
(4, 'issyeCooks', 'Logged In', '2025-01-29 17:05:49', 'Success'),
(5, 'cozykitchen@admin', 'Logged In', '2025-01-29 17:17:36', 'Success'),
(6, 'IssyeCooks', 'Logged In', '2025-01-29 17:17:55', 'Success'),
(7, 'arianagrande', 'Logged In', '2025-01-29 18:21:33', 'Success'),
(8, 'cozykitchen@admin', 'Logged In', '2025-01-29 18:23:21', 'Success'),
(9, 'cozykitchen@admin', 'Logged Out', '2025-01-29 18:33:44', 'Logout'),
(10, 'arianagrande', 'Logged In', '2025-01-29 18:33:54', 'Success'),
(11, 'arianagrande', 'Updated Profile', '2025-01-29 18:37:13', 'Updated'),
(12, 'arianagrande', 'Logged Out', '2025-01-29 18:38:11', 'Logout'),
(13, 'cozykitchen@admin', 'Logged In', '2025-01-29 18:39:38', 'Success'),
(14, 'cozykitchen@admin', 'Logged Out', '2025-01-29 18:40:08', 'Logout'),
(15, 'cozykitchen@admin', 'Logged In', '2025-01-29 18:40:17', 'Success'),
(16, 'cozykitchen@admin', 'Logged Out', '2025-01-29 18:40:19', 'Logout'),
(17, 'cozykitchen@admin', 'Logged In', '2025-01-29 18:41:06', 'Success'),
(18, 'IssyeCooks', 'Logged In', '2025-01-29 18:42:36', 'Success'),
(19, 'IssyeCooks', 'Logged Out', '2025-01-29 18:42:38', 'Logout'),
(20, 'cozykitchen@admin', 'Logged In', '2025-01-29 18:44:09', 'Success'),
(21, 'cozykitchen@admin', 'Logged Out', '2025-01-29 19:00:27', 'Logout'),
(22, 'IssyeCooks', 'Attempted Login', '2025-01-29 19:00:32', 'Failed'),
(23, 'arianagrande', 'Attempted Login', '2025-01-29 19:00:39', 'Failed'),
(24, 'arianagrande', 'Attempted Login', '2025-01-29 19:01:12', 'Failed'),
(25, 'cozykitchen@admin', 'Attempted Login', '2025-01-29 19:01:19', 'Failed'),
(26, 'cozykitchen@admin', 'Logged In', '2025-01-29 19:01:26', 'Success'),
(27, 'arianagrande', 'Logged In', '2025-01-29 19:05:40', 'Success'),
(28, 'arianagrande', 'Updated Profile', '2025-01-29 19:05:49', 'Updated'),
(29, 'cozykitchen@admin', 'Logged In', '2025-01-29 19:06:00', 'Success'),
(30, 'cozykitchen@admin', 'Logged Out', '2025-01-29 19:11:32', 'Logout'),
(31, 'IssyeCooks', 'Logged In', '2025-01-29 19:11:40', 'Success'),
(32, 'IssyeCooks', 'Profile Updated', '2025-01-29 19:11:47', 'Updated'),
(33, 'IssyeCooks', 'Logged Out', '2025-01-29 19:11:48', 'Logout'),
(34, 'cozykitchen@admin', 'Logged In', '2025-01-29 19:11:55', 'Success'),
(35, 'cozykitchen@admin', 'Logged Out', '2025-01-29 19:21:49', 'Logout'),
(36, 'cozykitchen@admin', 'Logged In', '2025-01-29 19:21:58', 'Success'),
(37, 'cozykitchen@admin', 'Logged Out', '2025-01-29 19:22:06', 'Logout'),
(38, 'cozykitchen@admin', 'Logged In', '2025-01-29 19:22:16', 'Success'),
(39, 'cozykitchen@admin', 'Logged Out', '2025-01-29 19:43:54', 'Logout'),
(40, 'cozykitchen@it', 'Login Attempt', '2025-01-29 19:48:50', 'Failed'),
(41, 'cozykitchen@it', 'Logged In', '2025-01-29 19:49:12', 'Success'),
(42, 'cozykitchen@it', 'Logged In', '2025-01-29 19:49:37', 'Success'),
(43, 'cozykitchen@it', 'Logged In', '2025-01-29 19:53:00', 'Success'),
(44, 'cozykitchen@it', 'Logged Out', '2025-01-29 20:06:35', 'Logout'),
(45, 'cozykitchen@admin', 'Logged In', '2025-01-29 20:06:45', 'Success'),
(46, 'cozykitchen@admin', 'Logged Out', '2025-01-29 20:24:56', 'Logout'),
(47, 'IssyeCooks', 'Logged In', '2025-01-29 20:25:04', 'Success'),
(48, 'IssyeCooks', 'Profile Updated', '2025-01-29 20:25:15', ''),
(49, 'IssyeCooks', 'Logged Out', '2025-01-29 20:25:23', 'Logout'),
(50, 'cozykitchen@it', 'Logged In', '2025-01-29 20:25:37', 'Success'),
(51, 'cozykitchen@it', 'Logged Out', '2025-01-29 20:25:59', 'Logout'),
(52, 'IssyeCooks', 'Logged In', '2025-01-29 20:26:17', 'Success'),
(53, 'issyeCooks', 'Logged In', '2025-01-31 23:28:26', 'Success'),
(54, 'issyeCooks', 'Logged In', '2025-01-31 23:31:54', 'Success'),
(55, 'issyeCooks', 'Logged In', '2025-02-01 12:45:55', 'Success'),
(56, 'issyeCooks', 'Logged In', '2025-02-01 22:52:04', 'Success'),
(57, 'issyeCooks', 'Login Attempt', '2025-02-01 23:09:13', 'Failed'),
(58, 'issyeCooks', 'Logged In', '2025-02-01 23:09:22', 'Success'),
(59, 'issyeCooks', 'Logged In', '2025-02-01 23:25:31', 'Success'),
(60, 'issyeCooks', 'Logged In', '2025-02-01 23:47:40', 'Success'),
(61, 'issyeCooks', 'Logged In', '2025-02-01 23:49:38', 'Success'),
(62, 'issyeCooks', 'Logged In', '2025-02-01 23:51:17', 'Success'),
(63, 'issyeCooks', 'Logged In', '2025-02-01 23:53:33', 'Success'),
(64, 'issyeCooks', 'Logged In', '2025-02-01 23:55:01', 'Success'),
(65, 'issyeCooks', 'Logged In', '2025-02-01 23:57:53', 'Success'),
(66, 'issyeCooks', 'Logged In', '2025-02-01 23:59:32', 'Success'),
(67, 'IssyeCooks', 'Logged In', '2025-02-02 09:09:56', 'Success'),
(68, 'IssyeCooks', 'Logged In', '2025-02-02 09:50:23', 'Success'),
(69, 'IssyeCooks', 'Logged In', '2025-02-02 16:05:32', 'Success'),
(70, 'IssyeCooks', 'Logged Out', '2025-02-02 16:14:13', 'Logout'),
(71, 'arianagrande', 'Logged In', '2025-02-02 16:14:20', 'Success'),
(72, 'arianagrande', 'Logged In', '2025-02-02 16:34:26', 'Success'),
(73, 'arianagrande', 'Logged Out', '2025-02-02 16:50:57', 'Logout'),
(74, 'IssyeCooks', 'Logged In', '2025-02-02 16:57:36', 'Success'),
(75, 'IssyeCooks', 'Logged Out', '2025-02-02 16:58:08', 'Logout'),
(76, 'IssyeCooks', 'Logged In', '2025-02-02 16:58:44', 'Success'),
(77, 'IssyeCooks', 'Logged Out', '2025-02-02 16:58:54', 'Logout'),
(78, 'IssyeCooks', 'Logged In', '2025-02-02 17:07:06', 'Success'),
(79, 'IssyeCooks', 'Logged Out', '2025-02-02 17:26:41', 'Logout'),
(80, 'cozykitchen@admin', 'Login Attempt', '2025-02-02 17:26:47', 'Failed'),
(81, 'cozykitchen@admin', 'Logged In', '2025-02-02 17:26:54', 'Success'),
(82, 'cozykitchen@admin', 'Logged Out', '2025-02-02 17:45:09', 'Logout'),
(83, 'fattahamin', 'Signed Up', '2025-02-02 17:47:00', 'Success'),
(84, 'fattahamin', 'Logged In', '2025-02-02 17:47:16', 'Success'),
(85, 'fattahamin', 'Profile Updated', '2025-02-02 17:51:08', ''),
(86, 'fattahamin', 'Logged Out', '2025-02-02 17:57:44', 'Logout'),
(87, 'cozykitchen@admin', 'Logged In', '2025-02-02 17:57:52', 'Success'),
(88, 'cozykitchen@admin', 'Logged Out', '2025-02-02 17:58:04', 'Logout'),
(89, 'IssyeCooks', 'Logged In', '2025-02-02 17:58:09', 'Success'),
(90, 'IssyeCooks', 'Logged Out', '2025-02-02 18:00:20', 'Logout'),
(91, 'IssyeCooks', 'Logged In', '2025-02-02 18:00:26', 'Success'),
(92, 'IssyeCooks', 'Logged In', '2025-02-02 18:04:13', 'Success'),
(93, 'IssyeCooks', 'Logged In', '2025-02-02 18:10:42', 'Success'),
(94, 'IssyeCooks', 'Logged Out', '2025-02-02 18:17:48', 'Logout'),
(95, 'cozykitchen@admin', 'Logged In', '2025-02-02 18:17:57', 'Success'),
(96, 'cozykitchen@admin', 'Logged Out', '2025-02-02 18:21:39', 'Logout'),
(97, 'IssyeCooks', 'Logged In', '2025-02-02 18:21:46', 'Success'),
(98, 'IssyeCooks', 'Logged Out', '2025-02-02 18:22:39', 'Logout'),
(99, 'cozykitchen@admin', 'Login Attempt', '2025-02-02 18:22:44', 'Failed'),
(100, 'cozykitchen@admin', 'Logged In', '2025-02-02 18:22:51', 'Success'),
(101, 'cozykitchen@admin', 'Logged Out', '2025-02-02 18:30:38', 'Logout'),
(102, 'IssyeCooks', 'Logged In', '2025-02-02 18:30:47', 'Success'),
(103, 'IssyeCooks', 'Logged Out', '2025-02-02 18:30:58', 'Logout'),
(104, 'cozykitchen@admin', 'Logged In', '2025-02-02 18:31:04', 'Success'),
(105, 'cozykitchen@admin', 'Logged Out', '2025-02-02 18:31:11', 'Logout'),
(106, 'IssyeCooks', 'Logged In', '2025-02-02 18:31:17', 'Success'),
(107, 'IssyeCooks', 'Logged Out', '2025-02-02 18:36:03', 'Logout'),
(108, 'cozykitchen@admin', 'Logged In', '2025-02-02 18:36:11', 'Success'),
(109, 'cozykitchen@admin', 'Logged Out', '2025-02-02 18:36:52', 'Logout'),
(110, 'arianagrande', 'Logged In', '2025-02-02 18:36:58', 'Success'),
(111, 'arianagrande', 'Logged Out', '2025-02-02 18:37:08', 'Logout'),
(112, 'fattahamin', 'Logged In', '2025-02-02 18:38:13', 'Success'),
(113, 'fattahamin', 'Logged Out', '2025-02-02 18:41:10', 'Logout'),
(114, 'arianagrande', 'Logged In', '2025-02-02 18:41:27', 'Success'),
(115, 'arianagrande', 'Logged Out', '2025-02-02 18:42:01', 'Logout'),
(116, 'fattahamin', 'Login Attempt', '2025-02-02 18:42:08', 'Failed'),
(117, 'fattahamin', 'Logged In', '2025-02-02 18:42:12', 'Success'),
(118, 'fattahamin', 'Logged Out', '2025-02-02 18:42:56', 'Logout'),
(119, 'cozykitchen@admin', 'Login Attempt', '2025-02-02 18:43:02', 'Failed'),
(120, 'cozykitchen@admin', 'Logged In', '2025-02-02 18:43:08', 'Success'),
(121, 'cozykitchen@admin', 'Logged Out', '2025-02-02 18:43:14', 'Logout'),
(122, 'arianagrande', 'Logged In', '2025-02-02 18:43:24', 'Success'),
(123, 'arianagrande', 'Logged Out', '2025-02-02 18:43:33', 'Logout'),
(124, 'cozykitchen@admin', 'Logged In', '2025-02-02 18:43:40', 'Success'),
(125, 'cozykitchen@admin', 'Logged Out', '2025-02-02 18:43:50', 'Logout'),
(126, 'arianagrande', 'Logged In', '2025-02-02 18:43:57', 'Success'),
(127, 'arianagrande', 'Logged In', '2025-02-02 18:56:44', 'Success'),
(128, 'IssyeCooks', 'Logged In', '2025-02-02 18:57:24', 'Success'),
(129, 'IssyeCooks', 'Logged In', '2025-02-02 18:58:32', 'Success'),
(130, 'IssyeCooks', 'Logged Out', '2025-02-02 19:08:12', 'Logout'),
(131, 'fattahamin', 'Login Attempt', '2025-02-02 19:16:14', 'Failed'),
(132, 'fattahamin', 'Login Attempt', '2025-02-02 19:16:19', 'Failed'),
(133, 'fattahamin', 'Login Attempt', '2025-02-02 19:17:21', 'Failed'),
(134, 'fattahamin', 'Logged In', '2025-02-02 19:24:52', 'Success'),
(135, 'fattahamin', 'Logged Out', '2025-02-02 19:33:02', 'Logout'),
(136, 'IssyeCooks', 'Logged In', '2025-02-02 19:33:27', 'Success'),
(137, 'IssyeCooks', 'Logged Out', '2025-02-02 19:33:51', 'Logout'),
(138, 'IssyeCooks', 'Login Attempt', '2025-02-02 19:37:02', 'Failed'),
(139, 'pastryQueen', 'Signed Up', '2025-02-02 19:38:16', 'Success'),
(140, 'daniallee', 'Signed Up', '2025-02-02 19:41:02', 'Success'),
(141, 'pastryQueen', 'Login Attempt', '2025-02-02 19:43:04', 'Failed'),
(142, 'pastryQueen', 'Login Attempt', '2025-02-02 19:43:19', 'Failed'),
(143, 'pastryQueen', 'Login Attempt', '2025-02-02 19:43:25', 'Failed'),
(144, 'pastryQueen', 'Logged In', '2025-02-02 19:44:04', 'Success'),
(145, 'pastryQueen', 'Profile Updated', '2025-02-02 19:44:52', ''),
(146, 'pastryQueen', 'Logged Out', '2025-02-02 19:52:09', 'Logout'),
(147, 'cozykitchen@admin', 'Login Attempt', '2025-02-02 19:53:03', 'Failed'),
(148, 'cozykitchen@admin', 'Logged In', '2025-02-02 19:53:11', 'Success'),
(149, 'cozykitchen@admin', 'Logged Out', '2025-02-02 19:53:50', 'Logout'),
(150, 'IssyeCooks', 'Logged In', '2025-02-04 23:19:28', 'Success'),
(151, 'IssyeCooks', 'Logged Out', '2025-02-04 23:26:10', 'Logout'),
(152, 'IssyeCooks', 'Logged In', '2025-02-04 23:26:34', 'Success'),
(153, 'IssyeCooks', 'Logged Out', '2025-02-05 00:06:00', 'Logout'),
(154, 'IssyeCooks', 'Logged In', '2025-02-05 00:10:59', 'Success'),
(155, 'IssyeCooks', 'Logged Out', '2025-02-05 00:11:30', 'Logout'),
(156, 'IssyeCooks', 'Logged In', '2025-02-05 00:19:14', 'Success'),
(157, 'IssyeCooks', 'Logged Out', '2025-02-05 00:57:06', 'Logout'),
(158, 'IssyeCooks', 'Logged In', '2025-02-05 00:57:16', 'Success'),
(159, 'IssyeCooks', 'Logged Out', '2025-02-05 00:58:26', 'Logout'),
(160, 'michelleyeoh', 'Logged In', '2025-02-05 01:00:34', 'Success'),
(161, 'michelleyeoh', 'Profile Updated', '2025-02-05 01:01:43', ''),
(162, 'michelleyeoh', 'Logged Out', '2025-02-05 01:07:13', 'Logout'),
(163, 'manothevar', 'Logged In', '2025-02-05 01:09:02', 'Success'),
(164, 'manothevar', 'Profile Updated', '2025-02-05 01:11:02', ''),
(165, 'IssyeCooks', 'Logged In', '2025-02-05 09:16:02', 'Success'),
(166, 'IssyeCooks', 'Profile Updated', '2025-02-05 09:26:41', ''),
(167, 'IssyeCooks', 'Profile Updated', '2025-02-05 10:11:34', ''),
(168, 'IssyeCooks', 'Profile Updated', '2025-02-05 10:12:26', ''),
(169, 'IssyeCooks', 'Logged Out', '2025-02-05 10:37:15', 'Logout'),
(170, 'IssyeCooks', 'Logged In', '2025-02-05 10:41:02', 'Success'),
(171, 'IssyeCooks', 'Logged Out', '2025-02-05 10:47:16', 'Logout'),
(172, 'IssyeCooks', 'Logged In', '2025-02-05 10:49:00', 'Success'),
(173, 'IssyeCooks', 'Logged In', '2025-02-05 10:59:53', 'Success'),
(174, 'IssyeCooks', 'Logged Out', '2025-02-05 11:00:38', 'Logout'),
(175, 'IssyeCooks', 'Logged In', '2025-02-05 11:02:28', 'Success'),
(176, 'IssyeCooks', 'Logged Out', '2025-02-05 11:04:15', 'Logout'),
(177, 'cozykitchen@admin', 'Logged In', '2025-02-05 11:04:40', 'Success'),
(178, 'cozykitchen@admin', 'Logged Out', '2025-02-05 11:31:01', 'Logout'),
(179, 'camilia', 'Logged In', '2025-02-05 11:31:12', 'Success'),
(180, 'camilia', 'Logged Out', '2025-02-05 11:31:23', 'Logout'),
(181, 'cozykitchen@admin', 'Logged In', '2025-02-05 11:31:29', 'Success'),
(182, 'cozykitchen@admin', 'Logged Out', '2025-02-05 11:36:00', 'Logout'),
(183, 'cozykitchen@it', 'Login Attempt', '2025-02-05 11:36:07', 'Failed'),
(184, 'cozykitchen@admin', 'Login Attempt', '2025-02-05 11:36:13', 'Failed'),
(185, 'cozykitchen@admin', 'Login Attempt', '2025-02-05 11:36:19', 'Failed'),
(186, 'cozykitchen@it', 'Logged In', '2025-02-05 11:36:27', 'Success'),
(187, 'cozykitchen@it', 'Logged Out', '2025-02-05 11:36:40', 'Logout'),
(188, 'issyeCooks', 'Logged In', '2025-02-05 15:48:32', 'Success'),
(189, 'IssyeCooks', 'Logged Out', '2025-02-05 15:50:13', 'Logout'),
(190, 'ck@admin', 'Login Attempt', '2025-02-05 15:50:27', 'Failed'),
(191, 'ck@admin', 'Login Attempt', '2025-02-05 15:50:36', 'Failed'),
(192, 'cozykitchen@admin', 'Logged In', '2025-02-05 15:51:11', 'Success'),
(193, 'cozykitchen@admin', 'Logged Out', '2025-02-05 15:51:46', 'Logout'),
(194, 'issyeCooks', 'Logged In', '2025-02-05 15:51:52', 'Success'),
(195, 'IssyeCooks', 'Logged Out', '2025-02-05 15:52:44', 'Logout'),
(196, 'cozykitchen@admin', 'Logged In', '2025-02-05 15:52:55', 'Success'),
(197, 'cozykitchen@admin', 'Logged Out', '2025-02-05 15:54:26', 'Logout'),
(198, 'cozykitchen@it', 'Logged In', '2025-02-05 15:54:44', 'Success'),
(199, 'cozykitchen@it', 'Logged Out', '2025-02-05 15:55:38', 'Logout'),
(200, 'issyeCooks', 'Logged In', '2025-02-05 16:09:25', 'Success'),
(201, 'IssyeCooks', 'Logged Out', '2025-02-05 16:50:24', 'Logout'),
(202, 'issyeCooks', 'Logged In', '2025-02-05 18:03:43', 'Success'),
(203, 'IssyeCooks', 'Logged Out', '2025-02-05 18:04:28', 'Logout'),
(204, 'issyeCooks', 'Logged In', '2025-02-05 18:06:43', 'Success'),
(205, 'issyeCooks', 'Logged In', '2025-02-06 01:46:17', 'Success'),
(206, 'issyeCooks', 'Logged In', '2025-02-09 00:47:21', 'Success'),
(207, 'IssyeCooks', 'Logged Out', '2025-02-09 00:47:40', 'Logout'),
(208, 'issyeCooks', 'Logged In', '2025-02-09 00:47:48', 'Success'),
(209, 'IssyeCooks', 'Logged Out', '2025-02-09 01:35:30', 'Logout'),
(210, 'issyeCooks', 'Logged In', '2025-02-09 01:40:02', 'Success'),
(211, 'issyeCooks', 'Login Attempt', '2025-02-09 01:45:12', 'Failed'),
(212, 'issyeCooks', 'Logged In', '2025-02-09 01:45:20', 'Success'),
(213, 'IssyeCooks', 'Logged Out', '2025-02-09 02:05:11', 'Logout'),
(214, 'issyeCooks', 'Logged In', '2025-02-10 00:52:38', 'Success'),
(215, 'issyeCooks', 'Logged In', '2025-02-10 01:14:51', 'Success'),
(216, 'IssyeCooks', 'Logged Out', '2025-02-10 03:01:51', 'Logout'),
(217, 'issyeCooks', 'Logged In', '2025-02-10 03:08:45', 'Success'),
(218, 'IssyeCooks', 'Logged Out', '2025-02-10 03:08:50', 'Logout'),
(219, 'issyeCooks', 'Logged In', '2025-02-10 03:15:31', 'Success'),
(220, 'IssyeCooks', 'Logged Out', '2025-02-10 03:15:51', 'Logout'),
(221, 'cozykitchen@admin', 'Logged In', '2025-02-10 03:16:13', 'Success'),
(222, 'issyeCooks', 'Logged In', '2025-02-10 03:16:37', 'Success'),
(223, 'issyeCooks', 'Logged In', '2025-02-10 14:20:51', 'Success'),
(224, 'issyeCooks', 'Logged In', '2025-02-10 14:27:41', 'Success'),
(225, 'issyeCooks', 'Logged In', '2025-02-10 14:42:20', 'Success'),
(226, 'issyeCooks', 'Logged In', '2025-02-10 14:43:01', 'Success'),
(227, 'IssyeCooks', 'Logged Out', '2025-02-10 15:22:17', 'Logout'),
(228, 'issyeCooks', 'Logged In', '2025-02-10 15:23:47', 'Success'),
(229, 'issyeCooks', 'Logged In', '2025-02-10 15:27:31', 'Success'),
(230, 'issyeCooks', 'Logged In', '2025-02-10 16:02:28', 'Success'),
(231, 'issyeCooks', 'Logged In', '2025-02-10 16:02:58', 'Success'),
(232, 'issyeCooks', 'Logged In', '2025-02-10 16:04:43', 'Success'),
(233, 'IssyeCooks', 'Logged Out', '2025-02-10 16:12:26', 'Logout'),
(234, 'cozykitchen@admin', 'Logged In', '2025-02-10 16:12:34', 'Success'),
(235, 'issyeCooks', 'Logged In', '2025-02-10 16:40:57', 'Success'),
(236, 'cozykitchen@admin', 'Logged In', '2025-02-10 16:44:39', 'Success'),
(237, 'cozykitchen@admin', 'Logged Out', '2025-02-10 17:30:39', 'Logout'),
(238, 'cozykitchen@it', 'Login Attempt', '2025-02-10 17:30:50', 'Failed'),
(239, 'cozykitchen@it', 'Logged In', '2025-02-10 17:34:18', 'Success'),
(240, 'cozykitchen@it', 'Logged Out', '2025-02-10 17:46:48', 'Logout'),
(241, 'cozykitchen@it', 'Login Attempt', '2025-02-10 17:47:13', 'Failed'),
(242, 'cozykitchen@it', 'Logged In', '2025-02-10 17:47:28', 'Success'),
(243, 'cozykitchen@it', 'Logged Out', '2025-02-10 17:48:14', 'Logout'),
(244, 'issyeCooks', 'Logged In', '2025-02-10 17:48:48', 'Success'),
(245, 'IssyeCooks', 'Profile Updated', '2025-02-10 17:49:38', ''),
(246, 'IssyeCooks', 'Logged Out', '2025-02-10 17:49:45', 'Logout'),
(247, 'EkaRamsay', 'Logged In', '2025-02-10 17:50:56', 'Success'),
(248, 'EkaRamsay', 'Profile Updated', '2025-02-10 17:57:26', ''),
(249, 'EkaRamsay', 'Profile Updated', '2025-02-10 18:02:51', ''),
(250, 'IssyeCooks', 'Profile Updated', '2025-02-10 20:30:00', ''),
(251, 'IssyeCooks', 'Logged Out', '2025-02-10 20:31:54', 'Logout'),
(252, 'cozykitchen@admin', 'Login Attempt', '2025-02-10 20:32:03', 'Failed'),
(253, 'cozykitchen@admin', 'Logged In', '2025-02-10 20:32:12', 'Success'),
(254, 'cozykitchen@admin', 'Logged Out', '2025-02-10 20:32:40', 'Logout'),
(255, 'cozykitchen@it', 'Logged In', '2025-02-10 20:32:50', 'Success'),
(256, 'cozykitchen@it', 'Logged Out', '2025-02-10 20:33:16', 'Logout'),
(257, 'IssyeCooks', 'Logged In', '2025-02-10 20:33:22', 'Success'),
(258, 'IssyeCooks', 'Logged In', '2025-02-10 20:52:59', 'Success'),
(259, 'IssyeCooks', 'Logged Out', '2025-02-10 21:03:06', 'Logout'),
(260, 'cozykitchen@admin', 'Login Attempt', '2025-02-10 21:03:17', 'Failed'),
(261, 'cozykitchen@admin', 'Logged In', '2025-02-10 21:03:25', 'Success'),
(262, 'cozykitchen@admin', 'Logged In', '2025-02-10 21:06:31', 'Success'),
(263, 'cozykitchen@admin', 'Logged Out', '2025-02-10 21:16:11', 'Logout'),
(264, 'IssyeCooks', 'Logged In', '2025-02-10 21:16:18', 'Success'),
(265, 'IssyeCooks', 'Logged Out', '2025-02-10 21:17:49', 'Logout'),
(266, 'cozykitchen@admin', 'Logged In', '2025-02-10 21:17:56', 'Success'),
(267, 'cozykitchen@admin', 'Logged Out', '2025-02-10 21:22:30', 'Logout'),
(268, 'IssyeCooks', 'Logged In', '2025-02-10 21:22:36', 'Success'),
(269, 'IssyeCooks', 'Logged Out', '2025-02-10 21:22:51', 'Logout'),
(270, 'cozykitchen@it', 'Logged In', '2025-02-10 21:22:59', 'Success'),
(271, 'cozykitchen@it', 'Logged Out', '2025-02-10 21:23:27', 'Logout'),
(272, 'IssyeCooks', 'Logged In', '2025-02-10 21:23:33', 'Success'),
(273, 'IssyeCooks', 'Logged Out', '2025-02-10 21:23:35', 'Logout'),
(274, 'IssyeCooks', 'Logged In', '2025-02-10 21:23:41', 'Success'),
(275, 'IssyeCooks', 'Logged Out', '2025-02-10 21:23:43', 'Logout'),
(276, 'cozykitchen@admin', 'Logged In', '2025-02-10 21:23:49', 'Success'),
(277, 'cozykitchen@admin', 'Logged Out', '2025-02-10 21:26:43', 'Logout'),
(278, 'IssyeCooks', 'Logged In', '2025-02-10 21:26:49', 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `recipe_id`, `created_at`) VALUES
(6, 1, 22, '2025-02-05 01:31:38'),
(7, 1, 23, '2025-02-05 03:03:43'),
(8, 1, 13, '2025-02-05 07:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `it_issues`
--

CREATE TABLE `it_issues` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `issue_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `priority` enum('Low','Medium','High','Critical') NOT NULL DEFAULT 'Medium',
  `status` enum('Resolved','Not Resolved') NOT NULL DEFAULT 'Not Resolved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `it_issues`
--

INSERT INTO `it_issues` (`id`, `user_id`, `issue_title`, `description`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Congested traffic', 'Cannot login although correct', 'Low', 'Resolved', '2025-01-29 11:34:11', '2025-01-29 12:06:11'),
(3, 2, 'Hacker sent threats', 'A hacker has been sending spam messages in an attempt to hack our website. So far, there have been 55 attempts.', 'Critical', 'Not Resolved', '2025-01-29 12:23:49', '2025-01-29 12:23:49'),
(4, 2, 'hack account', 'ada user nak hack my acc', 'Critical', 'Resolved', '2025-02-05 07:54:24', '2025-02-05 07:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `recipe_id`, `user_id`, `rating`, `message`, `created_at`, `updated_at`) VALUES
(4, 11, 5, 5, NULL, '2025-02-04 23:50:51', NULL),
(5, 18, 1, 3, NULL, '2025-02-04 23:50:51', NULL),
(7, 23, 1, 5, NULL, '2025-02-05 11:03:41', NULL),
(8, 13, 1, 5, NULL, '2025-02-05 15:48:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `recipeName` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ingredients` text NOT NULL,
  `instructions` text NOT NULL,
  `recipeImage` varchar(255) NOT NULL,
  `category` enum('Desserts','Pastries','Snacks','Malay Cuisine','Western','Breakfast','Chinese Cuisine','Indian Cuisine','Main Course') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `recipeName`, `description`, `ingredients`, `instructions`, `recipeImage`, `category`, `user_id`) VALUES
(9, 'Spaghetti Aglio e Olio', 'Aglio e Olio is a simple yet flavorful Italian pasta dish from Naples. It consists of spaghetti sautéed in olive oil with minced garlic, red pepper flakes, and parsley. The dish is often garnished with Parmesan cheese and sometimes enhanced with seafood or vegetables. It’s quick to prepare and highlights the rich flavors of garlic and olive oil.', '1 pound uncooked spaghetti\r\n½ cup olive oil\r\n6 cloves garlic, thinly sliced\r\n¼ teaspoon red pepper flakes, or to taste\r\nsalt and freshly ground black pepper to taste\r\n¼ cup chopped fresh Italian parsley\r\n1 cup finely grated Parmigiano-Reggiano cheese', '1. Boil the Pasta\r\n\r\n2. Bring a large pot of salted water to a boil.\r\n  - Cook the spaghetti according to the package instructions until al dente. \r\n  - Reserve ½ cup of pasta water, then drain the pasta.\r\n  - Prepare the Garlic Oil\r\n\r\n3. In a large pan, heat the olive oil over medium-low heat.\r\n   - Add the sliced garlic and red pepper flakes, stirring frequently.\r\n   - Sauté until the garlic turns golden brown (do not burn it).\r\n   - Combine Pasta and Sauce\r\n\r\n4. Add the drained pasta to the pan and toss to coat with the garlic oil.\r\n   - Pour in a little reserved pasta water (start with ¼ cup) to help the sauce coat the pasta evenly.\r\n   - Stir in the chopped parsley.\r\n   - Season and Serve\r\n\r\n5. Add salt and black pepper to taste.\r\n   - Optional: Sprinkle with grated Parmesan cheese and a bit of lemon zest for extra flavor.\r\n\r\n6. Serve immediately and enjoy!', 'uploads/Shrimp-Aglio-Olio-4.jpg', 'Western', 4),
(10, 'Beef Lasagna', 'A simple and delicious lasagna made with layers of rich meat sauce, creamy cheese filling, and tender pasta, baked until golden and bubbly. Perfect for a comforting homemade meal!', '9 lasagna noodles (cooked)\r\n1 lb ground beef\r\n2 cups marinara sauce\r\n1 cup ricotta cheese\r\n1 cup shredded mozzarella cheese (plus extra for topping)\r\n¼ cup grated Parmesan cheese\r\n1 egg (beaten)\r\nSalt & pepper (to taste)\r\n1 teaspoon Italian seasoning (optional)', '1. Preheat oven to 375°F (190°C).\r\n2. Cook lasagna noodles according to package instructions, then drain.\r\n3. Prepare meat sauce by browning 1 lb ground beef in a pan, then adding 2 cups marinara sauce and simmering for 5 minutes.\r\n4. Mix cheese filling: In a bowl, combine 1 cup ricotta cheese, 1 cup shredded mozzarella, ¼ cup grated Parmesan, and 1 beaten egg.\r\n5. Assemble lasagna: In a baking dish, layer meat sauce, lasagna noodles, and cheese filling, repeating layers until finished.\r\n6. Top with mozzarella cheese and cover with foil.\r\n7. Bake for 25 minutes, then remove foil and bake for another 10 minutes until cheese is bubbly.\r\n8. Let rest for 10 minutes before slicing and serving. Enjoy!', 'uploads/Step_1_Basic_Lasagna_with_Meaty_Sauce-5a99f20ec67335003717d34b.jpg', 'Western', 4),
(11, 'Pavlova', 'Pavlova is a light and airy meringue-based dessert with a crisp outer shell and a soft, marshmallow-like center. It is typically topped with whipped cream and fresh fruits like berries, kiwi, and passion fruit.', '4 egg whites (room temperature)\r\n1 cup granulated sugar\r\n1 teaspoon white vinegar\r\n1 teaspoon cornstarch\r\n1 teaspoon vanilla extract\r\n1 cup heavy cream (for topping)\r\n2 tablespoons powdered sugar (for whipped cream)\r\nFresh fruits (strawberries, blueberries, kiwi, passion fruit)', '1. Preheat oven to 250°F (120°C) and line a baking sheet with parchment paper.\r\n2. Beat egg whites in a clean, dry bowl until soft peaks form.\r\n3. Gradually add sugar (one spoon at a time) while beating until stiff, glossy peaks form.\r\n4. Fold in vinegar, cornstarch, and vanilla gently.\r\n5. Shape meringue into a circle on the baking sheet, creating a slightly hollow center.\r\n6. Bake for 90 minutes, then turn off the oven and let it cool inside with the door slightly open.\r\n7. Whip heavy cream with powdered sugar until fluffy.\r\n8. Top pavlova with whipped cream and fresh fruits.\r\n9. Serve immediately and enjoy!', 'uploads/australian-pavlova-recipe-256101-hero-01-f0bd5d2a3f0b4ec383fe8d16b8600bc9.jpg', 'Pastries', 4),
(12, 'Ayam Masak Merah', 'Ayam Masak Merah is a popular Malaysian dish featuring fried chicken coated in a rich, spicy, and slightly sweet tomato-based sauce. It is infused with aromatic spices like lemongrass, cinnamon, and star anise, making it a flavorful dish often served with nasi minyak or plain rice.', ' whole chicken (cut into pieces)\r\n1 teaspoon salt\r\n1 teaspoon turmeric powder\r\nOil (for frying)\r\n3 tablespoons oil\r\n1 cinnamon stick\r\n2 cloves\r\n2 star anise\r\n2 cardamom pods\r\n1 lemongrass stalk (bruised)\r\n3 tablespoons chili paste (adjust to taste)\r\n1 cup tomato sauce\r\n1 teaspoon sugar\r\n½ teaspoon salt\r\n½ cup water\r\n1 large onion (sliced)\r\n2 tomatoes (cut into wedges)\r\n½ cup peas (optional)', '1. Marinate chicken with 1 teaspoon salt and 1 teaspoon turmeric powder for 15 minutes.\r\n2. Deep-fry chicken in hot oil until golden brown, then set aside.\r\n3. Heat 3 tablespoons of oil in a pan.\r\n4. Sauté spices: Add 1 cinnamon stick, 2 cloves, 2 star anise, 2 cardamom pods, and 1 bruised lemongrass stalk until fragrant.\r\n5. Add 3 tablespoons chili paste and cook until the oil separates.\r\n6. Stir in 1 cup tomato sauce, 1 teaspoon sugar, and ½ teaspoon salt.\r\n7. Pour in ½ cup water and let it simmer for a few minutes.\r\n8. Add fried chicken, 1 sliced onion, 2 tomato wedges, and ½ cup peas (optional), then stir well.\r\n9. Simmer for 5 minutes, ensuring the chicken is well coated in the sauce.\r\n10. Serve hot with rice.', 'uploads/th.jpeg', 'Malay Cuisine', 5),
(13, 'Daging Rendang', 'Daging Rendang is a rich, flavorful, and aromatic slow-cooked beef dish from Indonesia, widely popular in Malaysia. Made with tender beef simmered in coconut milk and a fragrant blend of spices, it has a deep, caramelized flavor and thick, slightly dry gravy. Traditionally, it is served with rice, ketupat, or lemang.', '1 kg beef (cut into chunks)\r\n2 cups coconut milk\r\n1 cup water\r\n2 stalks lemongrass (bruised)\r\n3 kaffir lime leaves\r\n2 turmeric leaves (optional)\r\n1 cinnamon stick\r\n2 star anise\r\n3 cloves\r\nSalt and sugar (to taste)\r\n6 shallots\r\n4 cloves garlic\r\n3 red chilies (adjust to taste)\r\n2 inches ginger\r\n2 inches galangal\r\n2 inches turmeric\r\n1 tablespoon coriander powder', '1. Heat oil in a pan, then sauté the blended spice paste, cinnamon, star anise, cloves, lemongrass, and kaffir lime leaves until fragrant.\r\n2. Add beef, stirring until coated with the spices.\r\n3. Pour in coconut milk and water, then bring to a simmer.\r\n4. Cook on low heat for 2-3 hours, stirring occasionally, until the beef is tender and the sauce thickens.\r\n5. Season with salt and sugar, then continue cooking until the rendang is dark brown and the sauce is almost dry.\r\n6. Serve hot with rice, ketupat, or lemang.', 'uploads/Cara Membuat Daging Rendang Padang Enak.jpg', 'Malay Cuisine', 5),
(14, 'Lemang', 'Lemang is a traditional Malaysian and Indonesian dish made from glutinous rice, coconut milk, and salt, cooked inside a bamboo tube lined with banana leaves over an open fire. It has a slightly smoky flavor and a rich, creamy texture, often enjoyed with rendang or serunding (spiced grated coconut).', '3 cups glutinous rice (washed and soaked for 2 hours)\r\n2 cups coconut milk\r\n1 teaspoon salt\r\nBanana leaves (for lining)\r\nBamboo tubes (cut into 12–18 inch lengths)\r\n', '1. Prepare the bamboo tubes – clean them thoroughly and line the inside with banana leaves.\r\n2. Mix glutinous rice with coconut milk and salt in a bowl.\r\n3. Fill the bamboo with the rice mixture, leaving some space for expansion.\r\n4. Seal the top with more banana leaves.\r\n5. Cook over an open fire or charcoal grill, rotating occasionally for 2–3 hours until the rice is fully cooked.\r\n6. Remove from bamboo, slice, and serve with rendang or serunding.', 'uploads/1568829738_Butterkicap-Lemang-by-Shutterstock.jpg', 'Malay Cuisine', 5),
(15, 'Croissant ', 'A buttery, flaky, and crescent-shaped French pastry made with layers of laminated dough. Perfect for breakfast or as a sandwich base', '2 ¼ tsp active dry yeast\r\n1 cup warm milk\r\n3 ½ cups all-purpose flour\r\n¼ cup sugar\r\n1 tsp salt\r\n1 cup unsalted butter (cold)\r\n1 egg (for egg wash)', '1. Dissolve yeast in warm milk and let it sit for 5 minutes.\r\n2. Mix flour, sugar, and salt, then add yeast mixture and knead into dough.\r\n3. Roll the dough into a rectangle, place butter in the center, and fold.\r\n4. Refrigerate for 30 minutes, then roll and fold again (repeat 3 times).\r\n5. Roll out, cut into triangles, and roll into crescent shapes.\r\n6. Let rise for 2 hours, brush with egg wash, and bake at 375°F (190°C) for 20 minutes.', 'uploads/crossaints-2.jpg', 'Pastries', 7),
(16, 'Danish Pastry', 'A sweet, multi-layered pastry filled with custard, fruit, or jam, often topped with icing or nuts. Originally from Denmark but influenced by Austrian baking.', '2 cups all-purpose flour\r\n¼ cup sugar\r\n½ tsp salt\r\n1 tsp yeast\r\n½ cup milk (warm)\r\n1 egg\r\n½ cup unsalted butter (cold)\r\nFruit jam or custard for filling', '1. Dissolve yeast in warm milk and let it sit.\r\n2. Mix flour, sugar, and salt, then add yeast mixture and egg.\r\n3. Roll dough and fold in butter (like croissant dough).\r\n4. Chill, roll, and cut into squares.\r\n5. Add filling (jam or custard), fold corners, and let rise for 1 hour.\r\n6. Brush with egg wash and bake at 375°F (190°C) for 15–20 minutes.', 'uploads/367b8ffcdfd9c7354f26aa5920708fde.jpg', 'Pastries', 7),
(17, 'Puff Pastry 🍃', 'A light, crispy pastry made by folding butter into dough multiple times (lamination). Used in both sweet (napoleon, palmiers) and savory (vol-au-vent) dishes.', '2 cups all-purpose flour\r\n½ tsp salt\r\n½ cup water (cold)\r\n1 cup unsalted butter (cold)', '1. Mix flour, salt, and cold water to form dough.\r\n2. Roll out dough and place cold butter in the center.\r\n3. Fold, roll out, and repeat 4 times, chilling between folds.\r\n4. Roll to desired thickness, cut shapes, and bake at 400°F (200°C) for 15 minutes until golden.', 'uploads/057851d282b85db7c204a472042b3b4f.jpg', 'Pastries', 7),
(18, 'Éclair 🍫', 'A French choux pastry filled with cream (vanilla, chocolate, coffee) and topped with glossy chocolate glaze. Soft, airy, and delicious!', '1 cup water\r\n½ cup butter\r\n1 cup all-purpose flour\r\n4 eggs\r\n1 cup heavy cream (for filling)\r\n½ cup chocolate chips (for glaze)', '1. Heat water and butter in a pan until boiling.\r\n2. Add flour, stir until smooth, and let cool slightly.\r\n3. Beat in eggs one at a time until smooth.\r\n4. Pipe onto a baking sheet and bake at 375°F (190°C) for 25 minutes.\r\n5. Fill with whipped cream and top with melted chocolate.', 'uploads/874c7b24ddb1e07e31c4301a31723f8f.jpg', 'Pastries', 7),
(19, 'Apple Turnover 🍏', 'A handheld pastry filled with spiced apple filling, enclosed in flaky dough, and baked until golden. Can be glazed or dusted with sugar.', '1 sheet puff pastry\r\n2 apples (peeled, diced)\r\n¼ cup sugar\r\n½ tsp cinnamon\r\n1 tbsp butter\r\n1 egg (for egg wash)', '1. Cook apples with sugar, cinnamon, and butter until soft.\r\n2. Roll out puff pastry and cut into squares.\r\n3. Add apple filling, fold into triangles, and seal edges.\r\n4. Brush with egg wash and bake at 375°F (190°C) for 20 minutes.', 'uploads/861934f4bb002d7438bb631934c18079.jpg', 'Pastries', 7),
(20, 'Mapo Tofu (麻婆豆腐)', 'A spicy Sichuan dish made with soft tofu, minced meat, and a flavorful, numbing sauce made from Sichuan peppercorns.', '300g soft tofu (cubed)\r\n200g minced pork or beef\r\n2 tbsp doubanjiang (fermented chili bean paste)\r\n1 tbsp soy sauce\r\n1 tbsp Sichuan peppercorns\r\n2 garlic cloves (chopped)\r\n1 tsp ginger (chopped)\r\n1 cup chicken broth\r\n1 tsp cornstarch (mixed with 2 tbsp water)\r\n2 green onions (chopped)\r\n1 tbsp vegetable oil', '1. Heat oil, add Sichuan peppercorns, then remove them once fragrant.\r\n2. Sauté garlic, ginger, and doubanjiang for a minute.\r\n3. Add minced meat and cook until browned.\r\n4. Pour in chicken broth, soy sauce, and tofu cubes. Simmer for 5 minutes.\r\n5. Stir in cornstarch slurry to thicken the sauce.\r\n6. Garnish with green onions and serve with steamed rice.', 'uploads/79913444d7d8b10342f8691e2ef723b2.jpg', 'Chinese Cuisine', 11),
(21, 'Peking Duck (北京烤鸭)', 'A famous Beijing dish featuring crispy roasted duck served with thin pancakes, hoisin sauce, and scallions.', '1 whole duck (cleaned and dried)\r\n2 tbsp honey\r\n2 tbsp soy sauce\r\n1 tbsp five-spice powder\r\n1 tbsp rice vinegar\r\n1 tbsp sesame oil\r\n10 thin pancakes\r\n½ cup hoisin sauce\r\n1 cucumber (julienned)\r\n2 green onions (julienned)', '1. Rub duck with five-spice powder, soy sauce, honey, vinegar, and sesame oil.\r\n2. Let it air-dry in the fridge overnight.\r\n3. Roast at 180°C (350°F) for 1.5 hours, basting with honey water every 20 minutes.\r\n4. Slice duck thinly and serve with pancakes, hoisin sauce, cucumbers, and green onions.', 'uploads/a084152b0b8361c9f720f5a8869483c1.jpg', 'Chinese Cuisine', 11),
(22, 'Sweet and Sour Pork (咕噜肉)', 'A popular Cantonese dish featuring crispy pork in a tangy-sweet sauce with bell peppers and pineapple.', '300g pork (cubed)\r\n½ cup cornstarch\r\n1 egg\r\n1 green bell pepper (chopped)\r\n1 red bell pepper (chopped)\r\n½ cup pineapple chunks\r\n2 tbsp ketchup\r\n1 tbsp vinegar\r\n1 tbsp soy sauce\r\n1 tbsp sugar\r\n½ tsp salt\r\n2 tbsp water\r\nOil for frying', '1. Coat pork with egg and cornstarch, then deep-fry until crispy. Drain and set aside.\r\n2. Stir-fry bell peppers and pineapple in a pan.\r\n3. Mix ketchup, vinegar, soy sauce, sugar, salt, and water, then add to the pan.\r\n4. Toss in fried pork and coat evenly.\r\n5. Serve hot with rice.', 'uploads/07ce840cc1242b06cf688bd4b1d01711.jpg', 'Chinese Cuisine', 11),
(23, 'Butter Chicken (Murgh Makhani)', 'Butter Chicken is a rich and creamy North Indian dish, where tender chicken is cooked in a spiced tomato and butter-based sauce. It has a mildly sweet and tangy flavor, perfect with naan or basmati rice', '500g boneless chicken (cut into cubes)\r\n½ cup yogurt\r\n1 tbsp lemon juice\r\n1 tsp turmeric\r\n1 tsp red chili powder\r\n1 tsp garam masala\r\n1 tbsp ginger-garlic paste\r\n1 tbsp oil\r\nSalt to taste\r\n2 tbsp butter\r\n1 large onion (chopped)\r\n2 tomatoes (pureed)\r\n1 tbsp ginger-garlic paste\r\n1 tsp cumin powder\r\n1 tsp coriander powder\r\n½ tsp red chili powder\r\n½ cup heavy cream\r\n½ tsp fenugreek leaves (kasuri methi)\r\n1 tbsp honey or sugar\r\nSalt to taste\r\nFresh coriander for garnish', '1. Marinate the chicken: Mix all marinade ingredients and coat the chicken well. Let it sit for 2-4 hours.\r\n2. Grill the chicken: Cook in a pan until golden brown or grill for a smoky flavor. Set aside.\r\n3. Prepare the gravy: Melt butter in a pan, sauté onions until golden, then add ginger-garlic paste.\r\n4. Add tomato puree, cumin, coriander, chili powder, and cook until the mixture thickens.\r\n5. Blend the gravy for a smooth texture (optional).\r\n6. Return to heat, add chicken, heavy cream, fenugreek leaves, sugar, and salt. Simmer for 10 minutes.\r\n7. Garnish with fresh coriander and serve hot with naan or rice.', 'uploads/a13a7886f907aa0ad07784e87136d7ed.jpg', 'Indian Cuisine', 12),
(24, 'Masala Dosa', 'Masala Dosa is a crispy South Indian fermented rice and lentil crepe filled with a spiced potato filling. It is served with coconut chutney and sambar.', '2 cups rice\r\n½ cup urad dal (black gram)\r\n¼ cup poha (flattened rice)\r\n½ tsp fenugreek seeds\r\nSalt to taste\r\n3 boiled potatoes (mashed)\r\n1 onion (sliced)\r\n1 tsp mustard seeds\r\n1 green chili (chopped)\r\n½ tsp turmeric\r\n1 tsp cumin seeds\r\n8-10 curry leaves\r\n1 tbsp oil\r\n', '1. Prepare batter: Soak rice, urad dal, poha, and fenugreek seeds overnight. Blend into a smooth paste and ferment for 8-12 hours.\r\n2. Make the filling: Heat oil, add mustard seeds, cumin, curry leaves, and onions. Cook until soft.\r\n3. Add turmeric, green chili, salt, and mashed potatoes. Mix well and cook for 5 minutes.\r\n4. Cook dosa: Pour a ladle of batter onto a hot greased pan and spread thin. Cook until crisp.\r\n5. Assemble: Place potato filling inside the dosa, fold, and serve with chutney and sambar.', 'uploads/69e96b19c26f337f8b47257aa8e6ad25.jpg', '', 12),
(25, 'Kuih Lapis (Steamed Layer Cake)', ' A colorful, soft, and chewy layered cake made from coconut milk and rice flour, often enjoyed as a tea-time treat.', '200g rice flour\r\n100g tapioca flour\r\n150g sugar\r\n500ml coconut milk\r\n300ml water\r\nFood coloring (various colors)\r\n1/2 tsp salt', '1. Mix rice flour, tapioca flour, sugar, salt, coconut milk, and water into a smooth batter.\r\n2. Divide the batter into portions and color each with different food colors.\r\n3. Pour the first layer into a greased pan and steam for 5 minutes.\r\n4. Repeat the layering process, steaming each layer before adding the next.\r\n5. Once all layers are done, steam for another 15 minutes.\r\n6. Let cool completely before slicing.', 'uploads/c22c78b564c8998465daf8d85d7b9009.jpg', 'Desserts', 1),
(26, ' Kuih Seri Muka (Pandan Custard with Glutinous Rice)', ' A two-layered kuih with a fragrant pandan custard on top and a sticky glutinous rice base.', '300g glutinous rice (soaked for 4 hours)\r\n200ml coconut milk\r\n1/2 tsp salt\r\n1 pandan leaf (knotted)\r\n3 eggs\r\n150g sugar\r\n100ml pandan juice (blend pandan leaves with water and strain)\r\n200ml coconut milk\r\n50g plain flour\r\n20g cornflour', '1. Steam soaked glutinous rice with coconut milk, salt, and pandan leaf for 20 minutes. Press it into a greased pan.\r\n2. Mix eggs, sugar, pandan juice, coconut milk, flour, and cornflour until smooth.\r\n3. Strain and pour over the steamed rice layer.\r\n4. Steam for 25 minutes until the custard sets.\r\n5. Let cool before slicing.\r\n', 'uploads/11d8ef8f1779656579d85e770077f988.jpg', 'Western', 1),
(27, ' Kuih Ketayap (Pandan Coconut Crepe Roll)', 'A soft pandan-flavored crepe filled with caramelized grated coconut.', '150g all-purpose flour\r\n1 egg\r\n200ml coconut milk\r\n100ml water\r\n1 tsp pandan extract\r\n1/4 tsp salt\r\n150g grated coconut\r\n100g palm sugar (gula Melaka)\r\n2 tbsp water\r\n1 pandan leaf (knotted)', '1. Cook the filling by heating palm sugar, water, and pandan leaf until sugar melts. Add grated coconut and stir until well combined. Let cool.\r\n2. Mix all crepe batter ingredients until smooth.\r\n3. Heat a non-stick pan and cook thin crepes.\r\n4. Place a spoonful of coconut filling on each crepe, fold, and roll like a spring roll.\r\n5. Serve immediately.', 'uploads/3f01f0408c409fe704ea47c888575831.jpg', 'Malay Cuisine', 1),
(28, 'Kuih Cara Berlauk (Savory Minced Chicken/Fish Kuih)', 'A soft, savory kuih with a custard-like texture, often filled with spiced minced meat.', '150g all-purpose flour\r\n250ml coconut milk\r\n1 egg\r\n1/2 tsp salt\r\n1/2 tsp turmeric powder\r\n100g minced chicken or fish\r\n1 small onion (chopped)\r\n1 tbsp curry powder\r\n1 tbsp oil\r\nRed chilies and spring onions (for garnish)\r\n', '1. Sauté onion, curry powder, and minced chicken or fish until cooked. Set aside.\r\n2. Mix flour, coconut milk, egg, salt, and turmeric into a smooth batter.\r\n3. Heat a kuih cara mold, grease it lightly, and pour in batter until half-full.\r\n4. Add a spoonful of filling and top with red chili and spring onion.\r\n5. Cover and cook until firm.', 'uploads/b99365f63883192f715a19f99ce2fc4c.jpg', 'Malay Cuisine', 1),
(29, 'Classic Chocolate Chip Cookies 🍪', 'These classic chocolate chip cookies are crispy on the edges, chewy in the center, and loaded with melty chocolate chips. Perfect for any sweet craving!', '2 ¼ cups all-purpose flour\r\n1 tsp baking soda\r\n½ tsp salt\r\n1 cup unsalted butter, softened\r\n¾ cup granulated sugar\r\n¾ cup brown sugar, packed\r\n2 tsp vanilla extract\r\n2 large eggs\r\n2 cups semi-sweet chocolate chips', 'Preheat your oven to 350°F (175°C) and line a baking sheet with parchment paper.\r\nIn a bowl, whisk together flour, baking soda, and salt.\r\nIn another large bowl, cream butter, granulated sugar, and brown sugar until light and fluffy.\r\nMix in eggs and vanilla extract until well combined.\r\nGradually add the dry ingredients to the wet ingredients and mix until just combined.\r\nFold in the chocolate chips.\r\nScoop dough onto the prepared baking sheet, leaving space between each cookie.\r\nBake for 10-12 minutes until golden brown around the edges.\r\nLet cool on the baking sheet for 5 minutes, then transfer to a wire rack. Enjoy!', 'uploads/ChocChipCookies.jpg', 'Pastries', 13),
(30, 'Fluffy Blueberry Pancakes 🥞', 'These light and fluffy blueberry pancakes are perfect for a cozy breakfast. The burst of sweet blueberries in every bite makes them extra special!', '1 ½ cups all-purpose flour\r\n3 ½ tsp baking powder\r\n1 tsp salt\r\n1 tbsp sugar\r\n1 ¼ cups milk\r\n1 egg\r\n3 tbsp melted butter\r\n1 cup fresh or frozen blueberries', 'In a bowl, whisk together flour, baking powder, salt, and sugar.\r\nIn another bowl, whisk milk, egg, and melted butter until combined.\r\nPour the wet ingredients into the dry ingredients and mix until just combined (don’t overmix!).\r\nGently fold in the blueberries.\r\nHeat a non-stick pan or griddle over medium heat and lightly grease with butter or oil.\r\nPour about ¼ cup of batter onto the pan for each pancake.\r\nCook until bubbles form on the surface, then flip and cook for another 1-2 minutes until golden brown.\r\nServe warm with maple syrup and extra blueberries.', 'uploads/BlueberryPancakes.jpg', '', 13),
(31, 'Garlic Butter Shrimp Pasta 🍤🍝', 'This garlic butter shrimp pasta is a quick, restaurant-quality dish that combines juicy shrimp, a rich garlic butter sauce, and perfectly cooked pasta.', '8 oz spaghetti or fettuccine\r\n2 tbsp olive oil\r\n4 tbsp unsalted butter\r\n4 cloves garlic, minced\r\n1 lb shrimp, peeled and deveined\r\n1 tsp red pepper flakes (optional)\r\nSalt and pepper to taste\r\n¼ cup grated Parmesan cheese\r\n2 tbsp chopped parsley\r\n1 tbsp lemon juice', 'Cook pasta according to package instructions. Drain and set aside.\r\nIn a large pan, heat olive oil and 2 tbsp butter over medium heat.\r\nAdd garlic and red pepper flakes, sautéing for 30 seconds.\r\nAdd shrimp, season with salt and pepper, and cook for 2-3 minutes per side until pink and opaque.\r\nRemove shrimp from the pan and set aside.\r\nIn the same pan, melt the remaining 2 tbsp butter and add the cooked pasta. Toss to coat.\r\nStir in Parmesan, lemon juice, and parsley.\r\nReturn the shrimp to the pan and toss everything together.\r\nServe immediately with extra Parmesan on top.', 'uploads/GarlicShrimpPasta.jpg', '', 13),
(32, 'Tiramisu 🍰', 'Tiramisu is a classic Italian dessert made with layers of coffee-soaked ladyfingers and creamy mascarpone filling. It\'s light, rich, and perfect for coffee lovers.', '1 cup heavy cream\r\n½ cup mascarpone cheese\r\n¼ cup granulated sugar\r\n1 tsp vanilla extract\r\n1 cup brewed espresso (cooled)\r\n2 tbsp coffee liqueur (optional)\r\n24 ladyfinger biscuits\r\n2 tbsp cocoa powder\r\nDark chocolate shavings (for garnish)', 'Whisk heavy cream, mascarpone, sugar, and vanilla until stiff peaks form.\r\nMix espresso and coffee liqueur in a bowl. Quickly dip ladyfingers into the mixture (don’t soak them too much).\r\nLayer half of the soaked ladyfingers in a dish, followed by half of the mascarpone mixture. Repeat.\r\nDust with cocoa powder and refrigerate for at least 4 hours.\r\nGarnish with dark chocolate shavings before serving.', 'uploads/tiramisu.jpg', 'Desserts', 13),
(33, 'Cheesy Potato Croquettes 🍟', 'These crispy, cheesy potato croquettes are the perfect snack or appetizer. They have a golden crunchy exterior and a soft, cheesy center, making them an irresistible treat.', '3 large potatoes, boiled and mashed\r\n½ cup shredded cheddar cheese\r\n¼ cup chopped parsley\r\nSalt and pepper to taste\r\n1 egg\r\n½ cup all-purpose flour\r\n1 cup breadcrumbs\r\nOil for frying', 'Mix mashed potatoes, cheese, parsley, salt, and pepper. Shape into small cylinders.\r\nDip each croquette in flour, then beaten egg, then breadcrumbs.\r\nHeat oil and fry until golden brown.\r\nDrain on paper towels and serve with ketchup or aioli.', 'uploads/potatocroquettes.jpg', 'Snacks', 13),
(34, 'Nasi Lemak 🍛', 'Nasi Lemak is Malaysia’s national dish, featuring fragrant coconut rice served with spicy sambal, crispy anchovies, boiled eggs, and crunchy peanuts. It\'s a flavorful and satisfying meal.', '2 cups jasmine rice\r\n1 cup coconut milk\r\n1½ cups water\r\n1 pandan leaf (knotted)\r\n1 tsp salt\r\n1 cup dried anchovies (ikan bilis)\r\n1 cucumber, sliced\r\n2 boiled eggs\r\n½ cup peanuts\r\nSambal (chili paste)', 'Rinse the rice, then cook it with coconut milk, water, pandan leaf, and salt.\r\nFry dried anchovies until crispy.\r\nServe the coconut rice with fried anchovies, sliced cucumber, boiled eggs, peanuts, and sambal.', 'uploads/nasiLemak.jpg', '', 13),
(35, 'Grilled Steak with Garlic Butter🥩', 'A juicy, perfectly seared steak with rich garlic butter makes for a mouthwatering Western-style dish. It’s simple yet elegant, ideal for special occasions.', '2 ribeye steaks\r\nSalt and black pepper\r\n1 tbsp olive oil\r\n3 tbsp butter\r\n2 cloves garlic, minced\r\n1 tsp fresh thyme', 'Season steaks with salt and pepper.\r\nHeat olive oil in a pan and sear steaks for 3-4 minutes per side.\r\nReduce heat, add butter, garlic, and thyme. Spoon the butter over the steaks for 1-2 minutes.\r\nRest the steaks for 5 minutes before serving.', 'uploads/grilledSteak.jpg', 'Western', 13),
(37, 'Kung Pao Chicken 🥢', 'Kung Pao Chicken is a spicy, savory Chinese dish with tender chicken, crunchy peanuts, and a bold, flavorful sauce. It’s a perfect balance of heat and sweetness.', '2 boneless chicken breasts, diced\r\n2 tbsp soy sauce\r\n1 tbsp cornstarch\r\n2 tbsp oil\r\n3 cloves garlic, minced\r\n1-inch ginger, minced\r\n½ cup peanuts\r\n5 dried red chilies\r\n1 bell pepper, chopped\r\n1 tbsp oyster sauce\r\n1 tbsp rice vinegar\r\n1 tsp sugar', 'Marinate chicken in soy sauce and cornstarch for 10 minutes.\r\nHeat oil, sauté garlic, ginger, and chilies until fragrant.\r\nAdd chicken and cook until browned.\r\nToss in bell pepper, peanuts, oyster sauce, vinegar, and sugar. Stir-fry for another 2 minutes.\r\nServe with rice.', 'uploads/kungPaoChicken.jpg', '', 13),
(38, 'Butter Chicken 🍛', 'Butter Chicken is a creamy, rich Indian dish with tender chicken simmered in a spiced tomato-based sauce. It’s comforting, flavorful, and best enjoyed with naan or rice.', '2 boneless chicken breasts, cubed\r\n2 tbsp yogurt\r\n1 tsp garam masala\r\n1 tsp turmeric\r\n1 tsp chili powder\r\n2 tbsp butter\r\n1 onion, chopped\r\n2 cloves garlic, minced\r\n1-inch ginger, grated\r\n1 cup tomato puree\r\n½ cup heavy cream\r\nSalt to taste', 'Marinate chicken in yogurt, garam masala, turmeric, and chili powder for 30 minutes.\r\nHeat butter and cook onions, garlic, and ginger until soft.\r\nAdd tomato puree and cook for 5 minutes.\r\nAdd marinated chicken and cook until tender.\r\nStir in heavy cream and simmer for another 5 minutes.\r\nServe with naan or rice.', 'uploads/butterChicken.jpg', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `suspension_appeals`
--

CREATE TABLE `suspension_appeals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `suspension_reason` text NOT NULL,
  `appeal_message` text NOT NULL,
  `status` enum('Pending','Reviewed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Prefer not to say') DEFAULT 'Prefer not to say',
  `role` enum('visitor','user','admin','it_support') DEFAULT 'user',
  `profile_pic` varchar(255) DEFAULT 'default.png',
  `bio` text DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Suspended','Pending') NOT NULL DEFAULT 'Active',
  `address` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT 'default.png',
  `facebook` varchar(255) DEFAULT 'https://www.facebook.com',
  `twitter` varchar(255) DEFAULT 'https://www.instagram.com',
  `instagram` varchar(255) DEFAULT 'https://www.twitter.com',
  `suspension_reason` text DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `lockout_time` datetime DEFAULT NULL,
  `suspension_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `phone_number`, `password`, `gender`, `role`, `profile_pic`, `bio`, `created_at`, `status`, `address`, `profile_picture`, `facebook`, `twitter`, `instagram`, `suspension_reason`, `failed_attempts`, `lockout_time`, `suspension_count`) VALUES
(1, 'Issye Lailiyah', 'IssyeCooks', 'issye03@gmail.com', '0143277626', '$2y$10$LxWCOU7bGx2j26wuEF5yp.WJiBXXAyKqHBjQUtPxSScHTkvdSdE7K', 'Female', 'user', 'default.png', 'A true custodian of tradition, Issye specializes in crafting authentic Malay kuih, bringing time-honored recipes to life with precision and passion. Committed to preserving Malaysia’s sweet heritage, they blend nostalgia with artistry, ensuring that these delicate treats continue to be cherished for generations.', '2025-01-18 03:56:20', 'Active', 'Ampang, Kuala Lumpur', 'uploads/67a9cbb2ea37b_issyeProPic.jpg', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com/issyeelaili/', NULL, 0, NULL, 0),
(2, 'Admin', 'cozykitchen@admin', 'admin@ck.com', '0000000000', '$2y$10$VEEP4AkmB5bu6yU1N0Fx0e46p4TtPGrz26.sgMg1ZVYQL0TpSpObC', 'Prefer not to say', 'admin', 'default.png', '', '2025-01-18 04:50:21', 'Active', NULL, 'default.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', NULL, 0, NULL, 0),
(3, 'IT Support', 'cozykitchen@it', 'itsupport@ck.com', '1111111111', '$2y$10$7qv68qLZdef.vdLFG3g3Geey/DHxJm.Kqogl2RxHZZ9IqdrXMXWbq', 'Prefer not to say', 'it_support', 'default.png', '', '2025-01-18 04:52:36', 'Active', NULL, 'default.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', NULL, 0, NULL, 0),
(4, 'Ariana Grande', 'arianagrande', 'arianagrande@work.com', '8955345678', '$2y$10$ZWWOavDHnnR.HaWAf8dVZ.nwGUP9woIB/fNvSR5seOFAn7TBVZ6tS', 'Female', 'user', 'default.png', '', '2025-01-29 10:21:22', 'Active', 'California, USA', 'uploads/679a0172b87ad_ariana-grande-pictures-7pjoki0fyx9da3is.jpg', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com/arianagrande/', NULL, 0, NULL, 0),
(5, 'Fattah Amin', 'fattahamin', 'fattah.work@gmail.com', '0183878659', '$2y$10$L0BUaLVz.jFD5ojLANeaK.ZPLmGd6pceb00Tk5MxI0MfxqYWBzlgy', 'Male', 'user', 'default.png', 'A master of Malay cuisine, Fattah is dedicated to preserving and elevating traditional flavors through authentic recipes and innovative presentations. With deep-rooted expertise in heritage cooking, they showcase the richness of Malaysia’s culinary traditions, ensuring that Malay cuisine continues to thrive both locally and globally.', '2025-02-02 09:47:00', 'Active', 'Kuala Lumpur', 'uploads/679f400c241eb_7n_fattahlncrkanfranceng00.jpg', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com/fattahaminz/', NULL, 0, NULL, 0),
(7, 'Lily Sha', 'pastryQueen', 'lilysha@gmail.com', '0176543271', '$2y$10$0gWTalI1bfnxGyk2F4zZBeXFiTgaRaO5FKx5LVc4GGD.oY39LWXDe', 'Female', 'user', 'default.png', 'Renowned for their exceptional pastry skills, Pevita has brought international acclaim to Malaysia by winning prestigious global pastry competitions. With a passion for blending artistry and technique, they push the boundaries of pastry innovation while incorporating Malaysian flavors, cementing their status as a world-class pastry chef.', '2025-02-02 11:38:16', 'Active', NULL, 'uploads/679f5ab4bbf44_26f22f57ad7892abd68d905268a5a3f7.jpg', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com/pevpearce/', NULL, 0, NULL, 0),
(9, 'Danial Lee', 'daniallee', 'daniallee@gmail.com', '0198765432', '$2y$10$C.TtOKO4rkA1vypnI.R.kepFFNMSQLUwuWLfvccpbbVxxhk6b6GO2', 'Male', 'user', 'default.png', '', '2025-02-02 11:41:02', 'Active', NULL, 'default.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', NULL, 0, NULL, 0),
(10, 'Camilia', 'camilia', 'camilia@gmail.com', '00000000', '$2y$10$Bw2AxVMrulcERP1qUYH5aehLfyA1t7P9PoesYOu0z1cYwqICOfPW.', 'Female', 'user', 'default.png', '', '2025-02-02 11:42:50', 'Active', NULL, 'default.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', NULL, 0, NULL, 0),
(11, 'Michelle Yeoh', 'michelleyeoh', 'michelleyeoh@gmail.com', '017629381', '$2y$10$AdSWL91dnDtQ7TbYZQGnxOdIqc3bInleyXDsWUSovQwUfEX7ulB8u', 'Female', 'user', 'default.png', 'A master of Chinese cuisine, Michelle is dedicated to showcasing Malaysia’s rich culinary heritage. With years of expertise, they blend traditional Chinese techniques with Malaysia’s diverse flavors, creating dishes that honor authenticity while embracing innovation. As a passionate advocate, they actively promote Malaysian Chinese cuisine globally, sharing its unique fusion of cultures through their culinary artistry.', '2025-02-04 16:59:43', 'Active', NULL, 'uploads/67a247f72b8b1_6e931181ab30fb01a76b60bf94a901f9.jpg', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', NULL, 0, NULL, 0),
(12, 'Mano Thevar', 'manothevar', 'manothevar@gmail.com', '014328765', '$2y$10$zDhzsk.AarR5JW00nZ47VOM6zVG6M6bj4vVsjuA3TNPJ8ugUU2eRO', 'Male', 'user', 'default.png', 'A culinary expert in Malaysian Indian cuisine, Mano Thevar masterfully combines bold spices and traditional techniques to create authentic yet innovative dishes. Passionate about preserving heritage, they promote the rich flavors and cultural significance of Malaysian Indian food, showcasing its diversity on the global stage.', '2025-02-04 17:08:46', 'Active', NULL, 'uploads/67a24a26262a1_35901.jpg', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', NULL, 0, NULL, 0),
(13, 'Zulaikha Afzan', 'EkaRamsay', 'zulaikhabeewan@gmail.com', '0149738597', '$2y$10$8cvpQo3jzb21kovNbg7/ZeOmF2MA8Jnw1pyA/OwEFcPtvYROqPIJK', 'Female', 'user', 'default.png', 'Join me on this sweet journey as I share my favorite recipes, tips, and baking adventures. Whether you\'re a beginner or an experienced baker, I hope my creations inspire you to get in the kitchen and bake something amazing!  Happy baking! 🍪🎂✨', '2025-02-10 09:50:44', 'Active', NULL, 'uploads/67a9cd86e9c60_ZuProPic.jpeg', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com/ikhaafzan?igsh=dTNnMWZkOWx6cHB1&amp;amp;utm_source=qr', NULL, 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user` (`user`),
  ADD KEY `idx_action` (`action`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`recipe_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `it_issues`
--
ALTER TABLE `it_issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recipe_id` (`recipe_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `suspension_appeals`
--
ALTER TABLE `suspension_appeals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `it_issues`
--
ALTER TABLE `it_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `suspension_appeals`
--
ALTER TABLE `suspension_appeals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `it_issues`
--
ALTER TABLE `it_issues`
  ADD CONSTRAINT `it_issues_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `suspension_appeals`
--
ALTER TABLE `suspension_appeals`
  ADD CONSTRAINT `suspension_appeals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
