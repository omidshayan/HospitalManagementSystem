-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 14, 2025 at 12:03 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afghan_zar_sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `phone2` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `phone`, `phone2`, `code`, `address`, `is_active`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'شعبه اول', '', NULL, NULL, NULL, 1, 'admin', '2025-08-07 14:20:13', NULL),
(2, 'شعبه دوم', '', NULL, NULL, NULL, 1, 'admin', '2025-08-07 14:20:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `capital`
--

DROP TABLE IF EXISTS `capital`;
CREATE TABLE IF NOT EXISTS `capital` (
  `id` int NOT NULL AUTO_INCREMENT,
  `inventory` bigint NOT NULL,
  `debtors` bigint DEFAULT NULL,
  `creditor` bigint DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `money_balance` decimal(15,2) DEFAULT NULL,
  `money_debtor` decimal(15,2) DEFAULT NULL,
  `money_creditor` decimal(15,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `csrf_token_logs`
--

DROP TABLE IF EXISTS `csrf_token_logs`;
CREATE TABLE IF NOT EXISTS `csrf_token_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` varchar(1024) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `csrf_token_logs`
--

INSERT INTO `csrf_token_logs` (`id`, `message`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:40:41', NULL),
(2, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:42:22', NULL),
(3, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:42:25', NULL),
(4, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:43:09', NULL),
(5, 'Invalid or missing CSRF token.', '::1', '2025-08-06 23:44:54', NULL),
(6, 'Invalid or missing CSRF token.', '::1', '2025-08-07 00:09:52', NULL),
(7, 'Invalid or missing CSRF token.', '::1', '2025-08-07 00:30:01', NULL),
(8, 'Invalid or missing CSRF token.', '::1', '2025-08-07 18:11:51', NULL),
(9, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:32:12', NULL),
(10, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:42:18', NULL),
(11, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:45:57', NULL),
(12, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:48:04', NULL),
(13, 'Invalid or missing CSRF token.', '::1', '2025-08-08 23:48:30', NULL),
(14, 'Invalid or missing CSRF token.', '::1', '2025-08-12 21:28:24', NULL),
(15, 'Invalid or missing CSRF token.', '::1', '2025-08-12 21:28:50', NULL),
(16, 'Invalid or missing CSRF token.', '::1', '2025-08-13 17:58:59', NULL),
(17, 'Invalid or missing CSRF token.', '::1', '2025-08-13 18:43:36', NULL),
(18, 'Invalid or missing CSRF token.', '::1', '2025-08-13 18:46:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(50) NOT NULL,
  `father_name` varchar(30) DEFAULT NULL,
  `phone` int NOT NULL,
  `password` varchar(124) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `position` varchar(30) NOT NULL,
  `branch_id` int NOT NULL,
  `role` int DEFAULT '1',
  `verify_token` varchar(124) DEFAULT NULL,
  `forgot_token` varchar(256) DEFAULT NULL,
  `forgot_token_expire` datetime DEFAULT NULL,
  `remember_token` varchar(124) DEFAULT NULL,
  `expire_remember_token` varchar(124) DEFAULT NULL,
  `image` varchar(124) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `salary_price` int DEFAULT NULL,
  `who_it` varchar(30) NOT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `super_admin` tinyint DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_name` (`employee_name`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `father_name`, `phone`, `password`, `email`, `address`, `position`, `branch_id`, `role`, `verify_token`, `forgot_token`, `forgot_token_expire`, `remember_token`, `expire_remember_token`, `image`, `description`, `salary_price`, `who_it`, `state`, `super_admin`, `created_at`, `updated_at`) VALUES
(48, 'ali', NULL, 11, '$2y$10$lW.hGj4SfTrsZL.hLRC26.I6oON0TYbMHrAy1xM/jnTebFejeqx5i', 'javidmatima@gmail.com', NULL, '', 0, 2, NULL, '0773271c9258e60f63ae8e753f7f9c17d184d2fb496d594e1279bfd843f09169', '2025-08-11 23:16:53', '0ff152a08ade1e528a8bb273d01f3620', '2', '2024-09-01-23-53-55_66d4bf4bc0f96.jpg', NULL, 2000, '1', 1, 3, '2024-09-01 23:53:55', '2025-08-13 22:52:13'),
(93, 'fsds', NULL, 23423, '$2y$10$ppKLswVFgTN.Czj6bC/2Ju12hYA5DqoadU33D7Oj.zX/zQitzsbqS', 'javidmatima@gmail.com', NULL, 'مدیر مالی', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', 213213, 'ali', 1, NULL, '2025-08-07 22:15:30', NULL),
(94, 'علیرضا', NULL, 22, '$2y$10$aMMyPhbkqTwUi7jyrBu7qOYDIaqUkZlP.iQBXMZj.MZwp5GiWe45i', NULL, NULL, 'مدیر مالی', 2, 1, NULL, NULL, NULL, '3340f16ee78bbdd7ac26a545f88ed0ae', '2', '2025-08-07-22-20-26_6894e7629749d.jpg', 'توضیحات علیرضا', 20000, 'ali', 1, NULL, '2025-08-07 22:20:26', '2025-08-07 22:20:52'),
(95, 'محمد', NULL, 33, '$2y$10$vDRp.Ne5bFNyv6q0WwLhRO7xwM1a/PtOwZVfGuEHfV0Dhnq8LnGZq', NULL, NULL, 'حسابدار', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', 5000, 'علیرضا', 1, NULL, '2025-08-07 22:21:48', NULL),
(96, 'omid', NULL, 2322, '$2y$10$ipkdcMPLKEyfqTdX.lj0Se2j1Jz7/jfR7ixVPe6YBnWzdDgcoIcTW', NULL, NULL, 'مدیر مالی', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', 324343, 'ali', 2, NULL, '2025-08-08 22:02:37', '2025-08-09 00:27:55'),
(97, 'omid', 'reza', 44, '', NULL, NULL, 'مدیر مالی', 0, 1, NULL, NULL, NULL, NULL, NULL, '2025-08-08-23-51-07_68964e2386087.jpg', 'fot desc', 3000, 'ali', 2, NULL, '2025-08-08 23:39:10', '2025-08-09 00:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_expense` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `description` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `by_whom` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paid` decimal(15,2) DEFAULT NULL,
  `remainder` decimal(15,2) DEFAULT NULL,
  `who_it` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `year` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title_expense`, `category`, `amount`, `description`, `image`, `by_whom`, `paid`, `remainder`, `who_it`, `year`, `state`, `created_at`, `updated_at`) VALUES
(1, 'adsfd', '3', 0.00, '', NULL, NULL, 0.00, NULL, 'ali', '', 1, '2025-08-13 18:49:20', NULL),
(2, 'adsfsdf fa', '5', 333.00, 'sdafdsf ', '2025-08-13-21-52-05_689cc9bd37153.jpg', '96', 333.00, NULL, 'ali', '', 1, '2025-08-13 18:49:36', '2025-08-13 22:18:11'),
(3, 'پول چایی ', '5', 5.50, 'ببب', NULL, '48', 3.00, NULL, 'ali', '', 1, '2025-08-13 21:26:30', '2025-08-13 22:19:48'),
(4, 'adsfsdf', '', 333.00, 'fdf', NULL, NULL, 333.00, NULL, 'ali', '', 1, '2025-08-13 21:39:52', NULL),
(5, 'adsfsdf dd', '3', 333.00, 'fdf', NULL, '48', 333.00, NULL, 'ali', '', 1, '2025-08-13 21:39:56', '2025-08-13 22:33:51'),
(6, 'adsfsdf', '3', 333.00, 'fdf', NULL, '93', 333.00, NULL, 'ali', '', 1, '2025-08-13 21:47:11', NULL),
(7, 'adsfsdf', '3', 333.00, 'fdf', NULL, '93', 333.00, NULL, 'ali', '', 1, '2025-08-13 21:47:12', NULL),
(8, 'adsfsdf', '3', 333.00, 'fdf', NULL, '93', 333.00, NULL, 'ali', '', 1, '2025-08-13 21:47:13', NULL),
(9, 'adsfsdf', '3', 333.00, 'fdf', '2025-08-13-22-28-54_689cd25e3bc67.png', '93', 333.00, NULL, 'ali', '', 1, '2025-08-13 21:47:15', '2025-08-13 22:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_categories`
--

DROP TABLE IF EXISTS `expenses_categories`;
CREATE TABLE IF NOT EXISTS `expenses_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `who_it` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses_categories`
--

INSERT INTO `expenses_categories` (`id`, `cat_name`, `description`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(3, 'پول برق', 'این دسته جدید است a', 'ali', 1, '2025-08-13 18:02:12', '2025-08-13 18:42:45'),
(5, 'پول چاشت ', 'چاشت', 'ali', 1, '2025-08-13 18:02:31', '2025-08-13 18:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `not_access_logs`
--

DROP TABLE IF EXISTS `not_access_logs`;
CREATE TABLE IF NOT EXISTS `not_access_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `section_name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `page_address` varchar(124) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` varchar(512) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `not_access_logs`
--

INSERT INTO `not_access_logs` (`id`, `user_id`, `section_name`, `page_address`, `ip_address`, `user_agent`, `status`, `created_at`, `updated_at`) VALUES
(1, 48, 'gen2eral', '/afghan-zar-soft/employees', NULL, NULL, 1, '2025-08-06 23:27:22', NULL),
(2, 48, 'gen2eral', '/afghan-zar-soft/employees', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-06 23:28:43', NULL),
(3, 48, 'gen2eral', '/afghan-zar-soft/employees', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-06 23:30:29', NULL),
(4, 48, 'gen2eral', '/afghan-zar-soft/employees', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-06 23:30:44', NULL),
(5, 48, 'students', '/afghan-zar-soft/positions', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-06 23:31:40', NULL),
(6, 48, 'students', '/afghan-zar-soft/employee-details/93', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-07 00:33:18', NULL),
(7, 48, 'students', '/afghan-zar-soft/edit-employee/93', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-07 00:51:40', NULL),
(8, 48, 'students', '/afghan-zar-soft/edit-employee/93', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-07 18:02:02', NULL),
(9, 48, 'students', '/afghan-zar-soft/add-expense', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 1, '2025-08-07 23:23:30', NULL),
(10, 48, 'students', '/afghan-zar-soft/profile', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:00:10', NULL),
(11, 48, 'students', '/afghan-zar-soft/forgot-request', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:01:49', NULL),
(12, 48, 'students', '/afghan-zar-soft/edit-store-profile/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:09:36', NULL),
(13, 48, 'students', '/afghan-zar-soft/edit-store-profile/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:09:50', NULL),
(14, 48, 'students', '/afghan-zar-soft/edit-store-profile/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:10:03', NULL),
(15, 48, 'students', '/afghan-zar-soft/edit-store-profile/48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-11 23:11:07', NULL),
(16, 48, 'students', '/afghan-zar-soft/users', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 16:17:14', NULL),
(17, 48, 'students', '/afghan-zar-soft/user-details/4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 16:40:27', NULL),
(18, 48, 'students', '/afghan-zar-soft/user-details/4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 16:41:00', NULL),
(19, 48, 'students', '/afghan-zar-soft/user-details/3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 16:52:00', NULL),
(20, 48, 'students', '/afghan-zar-soft/add-expense', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 17:50:04', NULL),
(21, 48, 'students', '/afghan-zar-soft/expenses_categories', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 17:58:18', NULL),
(22, 48, 'students', '/afghan-zar-soft/expense-cat-store', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 17:58:52', NULL),
(23, 48, 'students', '/afghan-zar-soft/expense-cat-store', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 17:59:02', NULL),
(24, 48, 'students', '/afghan-zar-soft/change-status-expense-cat/5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 1, '2025-08-13 18:31:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employee_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `section_name`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 'general', 94, '2025-08-07 17:49:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `who_it` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(7, 'مدیر مالی', 'ali', 1, '2025-08-07 00:09:19', NULL),
(6, 'حسابدار', 'ali', 1, '2025-08-07 00:09:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `en_name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `section_id` int NOT NULL,
  `who_it` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `state` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `en_name`, `section_id`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(1, 'عمومی', 'general', 0, 'admin', 1, '2025-08-06 17:30:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(126) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `father_name` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(512) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state` int NOT NULL DEFAULT '1',
  `who_it` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `address`, `image`, `father_name`, `description`, `state`, `who_it`, `created_at`, `updated_at`) VALUES
(3, 'ali jan ', '22', NULL, NULL, 'ivhj', '2025-08-13-16-58-29_689c84edafb71.jpg', 'reza', 'ajf', 1, 'ali', '2025-08-13 16:15:20', '2025-08-13 17:19:39'),
(4, 'ali jan', '223', NULL, NULL, 'heart', '2025-08-13-16-50-41_689c831982a7e.jpg', 'reza', 'desc for ali jan', 1, 'ali', '2025-08-13 16:16:01', '2025-08-13 16:52:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
