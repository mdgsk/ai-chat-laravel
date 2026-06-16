-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 12:04 AM
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
-- Database: `ai_chat_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_histories`
--

CREATE TABLE `chat_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` longtext NOT NULL,
  `provider` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `time_taken` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_histories`
--

INSERT INTO `chat_histories` (`id`, `conversation_id`, `question`, `answer`, `provider`, `model`, `time_taken`, `created_at`, `updated_at`) VALUES
(82, 21, 'Hello', 'How may I help you?', 'gemini', 'gemini-2.5-flash', 3.48, '2026-06-11 10:09:54', '2026-06-11 10:09:54'),
(83, 20, 'Good Morning', 'Good morning! How can I assist you today?', 'gemini → ollama', 'qwen2.5:7b', 25.54, '2026-06-11 10:45:25', '2026-06-11 10:45:25'),
(84, 20, 'how are you?', 'I\'m AI, don\'t need feelings. How can I help?', 'ollama', 'qwen2.5:3b', 11.04, '2026-06-11 10:56:08', '2026-06-11 10:56:08'),
(85, 24, '111', 'Please provide more context or ask a question. I need information to help you better.', 'ollama', 'qwen2.5:3b', 7.93, '2026-06-11 11:10:20', '2026-06-11 11:10:20'),
(86, 23, '222', 'It seems there might be a misunderstanding. Please provide more information so I can assist you better.', 'ollama', 'qwen2.5:3b', 2.72, '2026-06-11 11:10:29', '2026-06-11 11:10:29'),
(87, 22, '333', 'I see you\'ve typed a number. Did you want assistance with a calculation or check if this is correct?', 'ollama', 'qwen2.5:3b', 2.85, '2026-06-11 11:10:44', '2026-06-11 11:10:44'),
(88, 46, '111', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:12', '2026-06-11 11:21:12'),
(89, 46, '222', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:15', '2026-06-11 11:21:15'),
(90, 46, '333', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:17', '2026-06-11 11:21:17'),
(91, 46, '444', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:19', '2026-06-11 11:21:19'),
(92, 46, '555', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:20', '2026-06-11 11:21:20'),
(93, 46, '666', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:22', '2026-06-11 11:21:22'),
(94, 46, '777', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:23', '2026-06-11 11:21:23'),
(95, 46, '888', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:25', '2026-06-11 11:21:25'),
(96, 46, '999', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:26', '2026-06-11 11:21:26'),
(97, 46, '000', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:28', '2026-06-11 11:21:28'),
(98, 42, '222', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:42', '2026-06-11 11:21:42'),
(99, 42, 'aaa', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:44', '2026-06-11 11:21:44'),
(100, 42, 'bbb', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:45', '2026-06-11 11:21:45'),
(101, 42, 'ccc', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:47', '2026-06-11 11:21:47'),
(102, 42, 'ddd', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:48', '2026-06-11 11:21:48'),
(103, 42, 'eee', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:49', '2026-06-11 11:21:49'),
(104, 42, 'fff', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:51', '2026-06-11 11:21:51'),
(105, 42, 'ggg', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:21:52', '2026-06-11 11:21:52'),
(106, 39, 'mmm', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:22:02', '2026-06-11 11:22:02'),
(107, 39, 'nnn', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:22:03', '2026-06-11 11:22:03'),
(108, 39, 'ooo', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:22:04', '2026-06-11 11:22:04'),
(109, 39, 'ppp', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:22:05', '2026-06-11 11:22:05'),
(110, 39, 'qqq', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:22:08', '2026-06-11 11:22:08'),
(111, 37, '...', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:22:19', '2026-06-11 11:22:19'),
(112, 37, 'zzz', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:42:51', '2026-06-11 11:42:51'),
(113, 37, '12', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:44:02', '2026-06-11 11:44:02'),
(114, 37, 'qqq', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 11:45:43', '2026-06-11 11:45:43'),
(115, 38, '111', 'I didn\'t catch that. Could you provide more context or ask a question?', 'ollama', 'qwen2.5:3b', 7.52, '2026-06-11 11:50:29', '2026-06-11 11:50:29'),
(116, 38, 'aa', 'I didn\'t catch that. Could you rephrase or ask a question?', 'ollama', 'qwen2.5:3b', 3.27, '2026-06-11 11:55:30', '2026-06-11 11:55:30'),
(117, 38, 'hi', 'Hello! How can I assist you?', 'gemini → ollama', 'qwen2.5:3b', 3.24, '2026-06-11 11:57:56', '2026-06-11 11:57:56'),
(118, 46, '111', 'Success msg from gemini sample', 'ollama', 'qwen2.5:3b', 9.18, '2026-06-11 12:38:12', '2026-06-11 12:38:12'),
(119, 46, '222', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:38:50', '2026-06-11 12:38:50'),
(120, 46, '1111', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:08', '2026-06-11 12:39:08'),
(121, 46, '222', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:12', '2026-06-11 12:39:12'),
(122, 46, '111', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:15', '2026-06-11 12:39:15'),
(123, 46, '222', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:16', '2026-06-11 12:39:16'),
(124, 46, '333', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:18', '2026-06-11 12:39:18'),
(125, 46, '444', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:19', '2026-06-11 12:39:19'),
(126, 46, '555', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:20', '2026-06-11 12:39:20'),
(127, 46, '666', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:21', '2026-06-11 12:39:21'),
(128, 46, '777', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:22', '2026-06-11 12:39:22'),
(129, 46, '888', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:24', '2026-06-11 12:39:24'),
(130, 46, '999', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:25', '2026-06-11 12:39:25'),
(131, 46, '000', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:26', '2026-06-11 12:39:26'),
(132, 46, '555', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:29', '2026-06-11 12:39:29'),
(133, 46, '666', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:30', '2026-06-11 12:39:30'),
(134, 46, '777', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:31', '2026-06-11 12:39:31'),
(135, 46, '888', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:32', '2026-06-11 12:39:32'),
(136, 46, '999', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:33', '2026-06-11 12:39:33'),
(137, 46, '555', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:35', '2026-06-11 12:39:35'),
(138, 46, '44', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:36', '2026-06-11 12:39:36'),
(139, 46, '333', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:37', '2026-06-11 12:39:37'),
(140, 46, '222', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:39', '2026-06-11 12:39:39'),
(141, 46, '111', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:39:40', '2026-06-11 12:39:40'),
(142, 48, '11', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:12', '2026-06-11 12:48:12'),
(143, 48, '22', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:14', '2026-06-11 12:48:14'),
(144, 48, '33', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:15', '2026-06-11 12:48:15'),
(145, 48, '44', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:16', '2026-06-11 12:48:16'),
(146, 48, '55', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:17', '2026-06-11 12:48:17'),
(147, 48, '66', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:18', '2026-06-11 12:48:18'),
(148, 48, '77', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:20', '2026-06-11 12:48:20'),
(149, 48, '88', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:22', '2026-06-11 12:48:22'),
(150, 48, '99', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:24', '2026-06-11 12:48:24'),
(151, 48, '00', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:26', '2026-06-11 12:48:26'),
(152, 48, 'aa', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:30', '2026-06-11 12:48:30'),
(153, 48, 'bbb', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:31', '2026-06-11 12:48:31'),
(154, 48, 'cc', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:33', '2026-06-11 12:48:33'),
(155, 48, 'dd', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:34', '2026-06-11 12:48:34'),
(156, 48, 'ee', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:37', '2026-06-11 12:48:37'),
(157, 48, 'ff', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:38', '2026-06-11 12:48:38'),
(158, 48, 'gg', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:39', '2026-06-11 12:48:39'),
(159, 48, 'hh', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:40', '2026-06-11 12:48:40'),
(160, 48, 'ii', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:43', '2026-06-11 12:48:43'),
(161, 48, 'jj', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:44', '2026-06-11 12:48:44'),
(162, 48, 'kk', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:45', '2026-06-11 12:48:45'),
(163, 48, 'll', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:46', '2026-06-11 12:48:46'),
(164, 48, 'mm', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:48', '2026-06-11 12:48:48'),
(165, 48, 'nn', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:49', '2026-06-11 12:48:49'),
(166, 48, 'oo', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:51', '2026-06-11 12:48:51'),
(167, 48, 'pp', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:52', '2026-06-11 12:48:52'),
(168, 48, 'qq', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:53', '2026-06-11 12:48:53'),
(169, 48, 'rr', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:54', '2026-06-11 12:48:54'),
(170, 48, 'ss', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:56', '2026-06-11 12:48:56'),
(171, 48, 'tt', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:57', '2026-06-11 12:48:57'),
(172, 48, 'uu', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:48:59', '2026-06-11 12:48:59'),
(173, 48, 'vv', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:49:01', '2026-06-11 12:49:01'),
(174, 48, 'ww', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:49:02', '2026-06-11 12:49:02'),
(175, 48, 'xx', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:49:04', '2026-06-11 12:49:04'),
(176, 48, 'yy', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:49:05', '2026-06-11 12:49:05'),
(177, 48, 'zz', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:49:07', '2026-06-11 12:49:07'),
(178, 48, '1a', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:51:19', '2026-06-11 12:51:19'),
(179, 48, '1b', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:51:22', '2026-06-11 12:51:22'),
(180, 48, '1c', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:51:25', '2026-06-11 12:51:25'),
(181, 48, '1d', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:53:21', '2026-06-11 12:53:21'),
(182, 48, '1e', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 12:53:24', '2026-06-11 12:53:24'),
(183, 48, '1f', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 13:52:05', '2026-06-11 13:52:05'),
(184, 48, '1g', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 13:52:14', '2026-06-11 13:52:14'),
(185, 48, 'zzz', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 14:16:36', '2026-06-11 14:16:36'),
(186, 48, 'ccc', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-11 14:16:48', '2026-06-11 14:16:48'),
(187, 46, 'hi', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-16 20:48:39', '2026-06-16 20:48:39'),
(188, 46, 'hi', 'Success msg from gemini sample', 'gemini sample', 'gemini-2.5-flash', 0.00, '2026-06-16 20:48:46', '2026-06-16 20:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 'Good Morning', '2026-06-11 10:04:50', '2026-06-11 10:56:08', NULL),
(21, 'aa', '2026-06-11 10:09:46', '2026-06-11 11:09:12', '2026-06-11 11:09:12'),
(22, '555', '2026-06-11 11:10:03', '2026-06-11 11:19:06', NULL),
(23, '222', '2026-06-11 11:10:05', '2026-06-11 11:11:07', '2026-06-11 11:11:07'),
(24, '111', '2026-06-11 11:10:07', '2026-06-11 11:19:11', '2026-06-11 11:19:11'),
(25, 'New Chat 12:11:20', '2026-06-11 11:11:20', '2026-06-11 11:11:20', NULL),
(26, 'New Chat 12:20:02', '2026-06-11 11:20:02', '2026-06-11 11:20:02', NULL),
(27, 'New Chat 12:20:03', '2026-06-11 11:20:03', '2026-06-11 11:20:03', NULL),
(28, 'New Chat 12:20:04', '2026-06-11 11:20:04', '2026-06-11 11:20:04', NULL),
(29, 'New Chat 12:20:06', '2026-06-11 11:20:06', '2026-06-11 11:20:06', NULL),
(30, 'New Chat 12:20:07', '2026-06-11 11:20:07', '2026-06-11 11:20:07', NULL),
(31, 'New Chat 12:20:08', '2026-06-11 11:20:08', '2026-06-11 11:20:08', NULL),
(32, 'New Chat 12:20:09', '2026-06-11 11:20:09', '2026-06-11 11:20:09', NULL),
(33, 'New Chat 12:20:10', '2026-06-11 11:20:10', '2026-06-11 11:20:10', NULL),
(34, 'New Chat 12:20:12', '2026-06-11 11:20:12', '2026-06-11 11:20:12', NULL),
(35, 'New Chat 12:20:13', '2026-06-11 11:20:13', '2026-06-11 11:20:13', NULL),
(36, 'New Chat 12:20:14', '2026-06-11 11:20:14', '2026-06-11 11:20:14', NULL),
(37, '...', '2026-06-11 11:20:15', '2026-06-11 11:45:43', NULL),
(38, 'hi', '2026-06-11 11:20:16', '2026-06-11 11:58:16', NULL),
(39, 'mmm', '2026-06-11 11:20:17', '2026-06-11 11:22:08', NULL),
(40, 'New Chat 12:20:18', '2026-06-11 11:20:18', '2026-06-11 11:20:18', NULL),
(41, 'New Chat 12:20:19', '2026-06-11 11:20:19', '2026-06-11 11:20:19', NULL),
(42, '222', '2026-06-11 11:20:20', '2026-06-11 11:21:52', NULL),
(43, 'New Chat 12:20:22', '2026-06-11 11:20:22', '2026-06-11 11:20:22', NULL),
(44, 'New Chat 12:20:23', '2026-06-11 11:20:23', '2026-06-11 11:20:23', NULL),
(45, 'New Chat 12:20:24', '2026-06-11 11:20:24', '2026-06-11 11:20:24', NULL),
(46, '111', '2026-06-11 11:20:25', '2026-06-16 20:48:46', NULL),
(47, 'New Chat 13:05:21', '2026-06-11 12:05:21', '2026-06-11 12:05:21', NULL),
(48, '11', '2026-06-11 12:48:02', '2026-06-11 14:16:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_09_160547_create_conversations_table', 1),
(5, '2026_06_09_160637_create_chat_histories_table', 1),
(6, '2026_06_10_173525_add_ai_fields_to_chat_histories_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2u96BLoxhXD7oclcjvTYd079rWKoLx4m0WJH36Mv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblJxMmRPSnVlNHlsWFdCTUVlVW9PTFp3dVQ3cmZ0VVdMWUZzUTVYQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb252ZXJzYXRpb25zLzQ2IjtzOjU6InJvdXRlIjtzOjE4OiJjb252ZXJzYXRpb25zLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781647383),
('yBFwyOpjVQt30jAfDtoQkwcJEWMxAQbMoJFyJwCp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjVFcVFHS1pUODliZU5PeUh5U2Y5RlRVcmNUR1puR1A0N2FpcjRlcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb252ZXJzYXRpb25zLzQ2IjtzOjU6InJvdXRlIjtzOjE4OiJjb252ZXJzYXRpb25zLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781191861);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `chat_histories`
--
ALTER TABLE `chat_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_histories`
--
ALTER TABLE `chat_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
