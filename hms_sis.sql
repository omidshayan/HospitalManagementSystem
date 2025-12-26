-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 26, 2025 at 09:55 PM
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
-- Database: `hms_sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_balances`
--

DROP TABLE IF EXISTS `account_balances`;
CREATE TABLE IF NOT EXISTS `account_balances` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_purchase` decimal(15,2) DEFAULT NULL,
  `total_sales` decimal(15,2) DEFAULT NULL,
  `total_purchase_returns` decimal(15,2) DEFAULT NULL,
  `total_sales_returns` decimal(15,2) DEFAULT NULL,
  `total_discount_purchase` decimal(15,2) DEFAULT NULL,
  `total_discount_sales` decimal(15,2) DEFAULT NULL,
  `total_payments` decimal(15,2) DEFAULT NULL,
  `total_receipts` decimal(15,2) DEFAULT NULL,
  `balance` decimal(15,2) DEFAULT NULL,
  `last_transaction_at` date DEFAULT NULL,
  `year` varchar(4) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`branch_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `account_balances`
--

INSERT INTO `account_balances` (`id`, `branch_id`, `user_id`, `total_purchase`, `total_sales`, `total_purchase_returns`, `total_sales_returns`, `total_discount_purchase`, `total_discount_sales`, `total_payments`, `total_receipts`, `balance`, `last_transaction_at`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 20, 1, 17310.00, 2976.00, 2976.00, NULL, NULL, NULL, 17310.00, NULL, 5952.00, '2025-11-11', '', 1, '2025-11-04 11:39:44', '2025-11-11 02:52:05'),
(2, 20, 2, 5280.00, 20.00, NULL, NULL, NULL, NULL, 1780.00, NULL, -3480.00, '2025-11-05', '', 1, '2025-11-04 11:40:23', '2025-11-05 15:24:25'),
(4, 20, 3, 6030.00, 3300.00, 1000.00, 2000.00, NULL, NULL, 3750.00, 4200.00, -4180.00, '2025-11-09', '', 1, '2025-11-04 23:41:55', '2025-11-09 12:52:38'),
(5, 20, 4, 26130.00, 30642.00, 750.00, 2000.00, 200.00, 624.00, 3872.00, 3220.00, 3490.00, '2025-11-14', '', 1, '2025-11-09 18:38:44', '2025-11-14 20:28:28'),
(6, 20, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '2025-11-11 14:32:12', NULL),
(7, 20, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, '2025-11-11 21:57:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_sis`
--

DROP TABLE IF EXISTS `admin_sis`;
CREATE TABLE IF NOT EXISTS `admin_sis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `role` int NOT NULL DEFAULT '1',
  `verify_token` varchar(124) DEFAULT NULL,
  `image` varchar(124) DEFAULT NULL,
  `state` tinyint NOT NULL DEFAULT '1' COMMENT '1 -> ative, 2 -> deactive\r\n',
  `forgot_token` varchar(256) DEFAULT NULL,
  `forgot_token_expire` datetime DEFAULT NULL,
  `remember_token` varchar(124) DEFAULT NULL,
  `expire_remember_token` varchar(124) DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin_sis`
--

INSERT INTO `admin_sis` (`id`, `name`, `phone`, `password`, `role`, `verify_token`, `image`, `state`, `forgot_token`, `forgot_token_expire`, `remember_token`, `expire_remember_token`, `last_visit`, `created_at`, `updated_at`) VALUES
(1, 'ahmad', '11', '$2y$10$j/uRpDUpYm/4mFe2k5Mz3eIhr89/207kgYTsKuZ13jHYDAb3bD6Rm', 3, NULL, NULL, 1, NULL, '2024-05-22 18:20:16', 'af98ebf7e817d5dfb0a60943047a8e0407a7a7cb36e46f726d3c3e63fe52a68f', '3', NULL, '2024-05-23 22:50:16', '2025-08-04 00:00:51'),
(2, 'ahmad', '22', '$2y$10$j/uRpDUpYm/4mFe2k5Mz3eIhr89/207kgYTsKuZ13jHYDAb3bD6Rm', 1, NULL, NULL, 1, NULL, '2024-05-22 18:20:16', NULL, NULL, NULL, '2024-05-23 22:50:16', '2024-05-24 15:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

DROP TABLE IF EXISTS `admissions`;
CREATE TABLE IF NOT EXISTS `admissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `user_name` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `age` varchar(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doctor_id` int NOT NULL,
  `queue_number` int DEFAULT NULL,
  `admission_date` datetime DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `admission_type` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `visit_fee` int DEFAULT NULL,
  `payment_status` int DEFAULT NULL,
  `description` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1->panding, 2->visit, 3->cancel',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `patient_id`, `user_name`, `age`, `doctor_id`, `queue_number`, `admission_date`, `department_id`, `admission_type`, `visit_fee`, `payment_status`, `description`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(23, 174, 'حسن فتحی', '25', 1, 1, NULL, 2, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-25 22:58:50', NULL),
(24, 175, 'امیر حسنی', '32', 1, 2, NULL, 2, NULL, NULL, NULL, NULL, 2, 'کاظم حسینی', '2025-12-25 22:59:07', '2025-12-25 23:02:05'),
(25, 176, 'جعفر رجبی', '45', 1, 3, NULL, 2, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-25 22:59:23', NULL),
(27, 169, 'هاشمی', '65', 163, 1, NULL, 2, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-25 23:01:05', NULL),
(28, 178, 'اکبر اما', '43', 1, 1, NULL, 2, NULL, NULL, NULL, NULL, 2, 'کاظم حسینی', '2025-12-26 13:27:03', '2025-12-26 15:34:25'),
(29, 178, 'اکبر اما', '43', 1, 2, NULL, 2, NULL, NULL, NULL, NULL, 2, 'کاظم حسینی', '2025-12-26 13:50:46', '2025-12-26 16:20:55'),
(30, 179, 'asi', '14', 1, 3, NULL, 2, NULL, NULL, NULL, NULL, 2, 'کاظم حسینی', '2025-12-26 16:20:18', '2025-12-26 16:49:42'),
(31, 183, 'غلام رضا احمدی', '25', 1, 4, NULL, 2, NULL, NULL, NULL, NULL, 2, 'کاظم حسینی', '2025-12-26 16:59:13', '2025-12-26 17:23:01'),
(32, 185, 'جمشید رضایی', '40', 1, 5, NULL, 2, NULL, NULL, NULL, NULL, 2, 'کاظم حسینی', '2025-12-26 17:30:14', '2025-12-26 17:30:26'),
(33, 151, 'sadfsdf', '22', 1, 1, NULL, 2, NULL, NULL, NULL, NULL, 2, 'کاظم حسینی', '2025-12-27 01:18:58', '2025-12-27 01:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(256) NOT NULL,
  `en_branch_name` varchar(128) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `en_branch_name`, `phone`, `phone2`, `code`, `address`, `is_active`, `who_it`, `created_at`, `updated_at`) VALUES
(20, 'شعبه مرکزی', 'center', '', '', NULL, '', 1, 'ali', '2025-08-10 15:27:42', NULL),
(23, 'شعبه دوم', 'two', '', '', NULL, '', 1, 'ali', '2025-08-10 15:27:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `calendar_settings`
--

DROP TABLE IF EXISTS `calendar_settings`;
CREATE TABLE IF NOT EXISTS `calendar_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `calendar_type` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `calendar_settings`
--

INSERT INTO `calendar_settings` (`id`, `calendar_type`, `created_at`, `updated_at`) VALUES
(1, 'jalali', '2025-03-05 07:43:51', '2025-03-07 23:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'هندی', 1, 'کاظم حسینی', '2025-12-26 22:39:27', '2025-12-26 22:52:05'),
(3, 'ایرانی', 1, 'کاظم حسینی', '2025-12-26 22:40:38', '2025-12-26 22:52:10'),
(4, 'پاکستانی', 1, 'کاظم حسینی', '2025-12-26 22:40:44', '2025-12-26 22:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `csrf_token_logs`
--

DROP TABLE IF EXISTS `csrf_token_logs`;
CREATE TABLE IF NOT EXISTS `csrf_token_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` varchar(1024) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `csrf_token_logs`
--

INSERT INTO `csrf_token_logs` (`id`, `message`, `ip_address`, `created_at`, `updated_at`) VALUES
(6, 'Invalid or missing CSRF token.', '::1', '2025-12-02 23:09:44', NULL),
(7, 'Invalid or missing CSRF token.', '::1', '2025-12-02 23:09:49', NULL),
(8, 'Invalid or missing CSRF token.', '::1', '2025-12-03 15:32:18', NULL),
(9, 'Invalid or missing CSRF token.', '::1', '2025-12-04 23:46:27', NULL),
(10, 'Invalid or missing CSRF token.', '::1', '2025-12-05 01:10:39', NULL),
(11, 'Invalid or missing CSRF token.', '::1', '2025-12-05 01:10:43', NULL),
(12, 'Invalid or missing CSRF token.', '::1', '2025-12-08 00:26:39', NULL),
(13, 'Invalid or missing CSRF token.', '::1', '2025-12-08 16:22:52', NULL),
(14, 'Invalid or missing CSRF token.', '::1', '2025-12-10 14:21:31', NULL),
(15, 'Invalid or missing CSRF token.', '::1', '2025-12-10 14:22:23', NULL),
(16, 'Invalid or missing CSRF token.', '::1', '2025-12-10 17:10:05', NULL),
(17, 'Invalid or missing CSRF token.', '::1', '2025-12-10 17:11:35', NULL),
(18, 'Invalid or missing CSRF token.', '::1', '2025-12-11 01:11:00', NULL),
(19, 'Invalid or missing CSRF token.', '127.0.0.1', '2025-12-11 02:48:23', NULL),
(20, 'Invalid or missing CSRF token.', '::1', '2025-12-11 16:54:35', NULL),
(21, 'Invalid or missing CSRF token.', '::1', '2025-12-11 17:12:35', NULL),
(22, 'Invalid or missing CSRF token.', '::1', '2025-12-12 01:50:17', NULL),
(23, 'Invalid or missing CSRF token.', '::1', '2025-12-12 02:23:21', NULL),
(24, 'Invalid or missing CSRF token.', '::1', '2025-12-12 14:53:57', NULL),
(25, 'Invalid or missing CSRF token.', '::1', '2025-12-12 15:53:20', NULL),
(26, 'Invalid or missing CSRF token.', '::1', '2025-12-12 16:26:11', NULL),
(27, 'Invalid or missing CSRF token.', '::1', '2025-12-12 16:28:32', NULL),
(28, 'Invalid or missing CSRF token.', '::1', '2025-12-12 16:29:07', NULL),
(29, 'Invalid or missing CSRF token.', '::1', '2025-12-12 16:31:08', NULL),
(30, 'Invalid or missing CSRF token.', '::1', '2025-12-12 16:32:03', NULL),
(31, 'Invalid or missing CSRF token.', '127.0.0.1', '2025-12-15 18:59:28', NULL),
(32, 'Invalid or missing CSRF token.', '::1', '2025-12-16 00:17:04', NULL),
(33, 'Invalid or missing CSRF token.', '::1', '2025-12-16 00:41:18', NULL),
(34, 'Invalid or missing CSRF token.', '::1', '2025-12-16 00:51:49', NULL),
(35, 'Invalid or missing CSRF token.', '::1', '2025-12-16 00:56:36', NULL),
(36, 'Invalid or missing CSRF token.', '::1', '2025-12-16 01:21:25', NULL),
(37, 'Invalid or missing CSRF token.', '::1', '2025-12-16 20:45:21', NULL),
(38, 'Invalid or missing CSRF token.', '::1', '2025-12-16 21:24:17', NULL),
(39, 'Invalid or missing CSRF token.', '::1', '2025-12-16 21:24:55', NULL),
(40, 'Invalid or missing CSRF token.', '::1', '2025-12-16 21:25:51', NULL),
(41, 'Invalid or missing CSRF token.', '::1', '2025-12-16 22:35:46', NULL),
(42, 'Invalid or missing CSRF token.', '::1', '2025-12-16 22:50:32', NULL),
(43, 'Invalid or missing CSRF token.', '::1', '2025-12-16 22:52:12', NULL),
(44, 'Invalid or missing CSRF token.', '::1', '2025-12-16 23:01:41', NULL),
(45, 'Invalid or missing CSRF token.', '::1', '2025-12-16 23:02:08', NULL),
(46, 'Invalid or missing CSRF token.', '::1', '2025-12-17 00:35:15', NULL),
(47, 'Invalid or missing CSRF token.', '::1', '2025-12-17 00:41:57', NULL),
(48, 'Invalid or missing CSRF token.', '::1', '2025-12-17 01:10:22', NULL),
(49, 'Invalid or missing CSRF token.', '::1', '2025-12-17 01:37:56', NULL),
(50, 'Invalid or missing CSRF token.', '::1', '2025-12-17 01:38:17', NULL),
(51, 'Invalid or missing CSRF token.', '::1', '2025-12-17 01:39:12', NULL),
(52, 'Invalid or missing CSRF token.', '::1', '2025-12-17 01:39:50', NULL),
(53, 'Invalid or missing CSRF token.', '::1', '2025-12-17 01:40:32', NULL),
(54, 'Invalid or missing CSRF token.', '::1', '2025-12-17 01:40:46', NULL),
(55, 'Invalid or missing CSRF token.', '::1', '2025-12-17 01:41:59', NULL),
(56, 'Invalid or missing CSRF token.', '::1', '2025-12-17 01:42:11', NULL),
(57, 'Invalid or missing CSRF token.', '127.0.0.1', '2025-12-17 01:49:40', NULL),
(58, 'Invalid or missing CSRF token.', '::1', '2025-12-22 00:59:42', NULL),
(59, 'Invalid or missing CSRF token.', '::1', '2025-12-22 02:29:32', NULL),
(60, 'Invalid or missing CSRF token.', '::1', '2025-12-22 02:29:46', NULL),
(61, 'Invalid or missing CSRF token.', '::1', '2025-12-22 02:31:08', NULL),
(62, 'Invalid or missing CSRF token.', '::1', '2025-12-22 02:44:28', NULL),
(63, 'Invalid or missing CSRF token.', '::1', '2025-12-22 02:52:05', NULL),
(64, 'Invalid or missing CSRF token.', '::1', '2025-12-22 02:55:46', NULL),
(65, 'Invalid or missing CSRF token.', '::1', '2025-12-22 03:36:12', NULL),
(66, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:42:50', NULL),
(67, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:42:54', NULL),
(68, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:43:51', NULL),
(69, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:44:34', NULL),
(70, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:45:00', NULL),
(71, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:48:05', NULL),
(72, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:49:48', NULL),
(73, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:51:09', NULL),
(74, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:52:09', NULL),
(75, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:52:23', NULL),
(76, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:58:22', NULL),
(77, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:58:32', NULL),
(78, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:59:08', NULL),
(79, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:59:16', NULL),
(80, 'Invalid or missing CSRF token.', '::1', '2025-12-25 01:59:48', NULL),
(81, 'Invalid or missing CSRF token.', '::1', '2025-12-25 02:01:07', NULL),
(82, 'Invalid or missing CSRF token.', '::1', '2025-12-25 02:01:13', NULL),
(83, 'Invalid or missing CSRF token.', '::1', '2025-12-25 02:11:00', NULL),
(84, 'Invalid or missing CSRF token.', '::1', '2025-12-25 02:11:07', NULL),
(85, 'Invalid or missing CSRF token.', '::1', '2025-12-25 02:13:10', NULL),
(86, 'Invalid or missing CSRF token.', '::1', '2025-12-25 02:13:28', NULL),
(87, 'Invalid or missing CSRF token.', '::1', '2025-12-25 16:41:00', NULL),
(88, 'Invalid or missing CSRF token.', '::1', '2025-12-26 13:27:27', NULL),
(89, 'Invalid or missing CSRF token.', '::1', '2025-12-26 13:51:02', NULL),
(90, 'Invalid or missing CSRF token.', '::1', '2025-12-26 15:41:54', NULL),
(91, 'Invalid or missing CSRF token.', '::1', '2025-12-26 16:22:10', NULL),
(92, 'Invalid or missing CSRF token.', '::1', '2025-12-26 17:34:34', NULL),
(93, 'Invalid or missing CSRF token.', '::1', '2025-12-26 17:35:31', NULL),
(94, 'Invalid or missing CSRF token.', '::1', '2025-12-26 21:14:10', NULL),
(95, 'Invalid or missing CSRF token.', '::1', '2025-12-26 23:06:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daily_reports`
--

DROP TABLE IF EXISTS `daily_reports`;
CREATE TABLE IF NOT EXISTS `daily_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `report_date` date NOT NULL,
  `total_sales` decimal(15,2) DEFAULT NULL,
  `total_purchases` decimal(15,2) DEFAULT NULL,
  `total_payments` decimal(15,2) DEFAULT NULL,
  `total_received` decimal(15,2) DEFAULT NULL,
  `total_purchase_discounts` decimal(15,2) DEFAULT NULL,
  `total_discount_sales` decimal(15,2) DEFAULT NULL,
  `total_purchase_return` decimal(15,2) DEFAULT NULL,
  `total_sales_return` decimal(15,2) DEFAULT NULL,
  `total_creditor` decimal(15,2) DEFAULT NULL,
  `total_debts` decimal(15,2) DEFAULT NULL,
  `total_expenses` decimal(15,2) DEFAULT NULL,
  `gross_profit` decimal(15,2) DEFAULT NULL,
  `invoice_count` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_at` (`created_at`),
  KEY `branch_id` (`branch_id`),
  KEY `report_date` (`report_date`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `daily_reports`
--

INSERT INTO `daily_reports` (`id`, `branch_id`, `report_date`, `total_sales`, `total_purchases`, `total_payments`, `total_received`, `total_purchase_discounts`, `total_discount_sales`, `total_purchase_return`, `total_sales_return`, `total_creditor`, `total_debts`, `total_expenses`, `gross_profit`, `invoice_count`, `created_at`, `updated_at`) VALUES
(1, 20, '2025-11-03', NULL, 13000.00, NULL, NULL, NULL, NULL, 1000.00, 5000.00, -5000.00, 12000.00, NULL, NULL, 16, '2025-11-03 15:02:44', '2025-11-03 23:51:31'),
(2, 20, '2025-11-04', 10080.00, 5300.00, NULL, 4140.00, NULL, NULL, 3000.00, 2000.00, 4440.00, 2800.00, NULL, NULL, 16, '2025-11-04 01:09:08', '2025-11-04 23:49:58'),
(3, 20, '2025-11-05', 3630.00, 20.00, NULL, NULL, NULL, NULL, NULL, NULL, 3630.00, 20.00, NULL, NULL, 3, '2025-11-05 14:56:52', '2025-11-05 15:24:48'),
(4, 20, '2025-11-09', 52710.00, 53918.67, 50000.00, 21200.00, NULL, 1000.00, NULL, NULL, 30510.00, 3918.67, NULL, NULL, 4, '2025-11-09 12:52:38', '2025-11-09 18:43:27'),
(5, 20, '2025-11-10', 18830.00, 13070.00, 300.00, 8750.00, NULL, NULL, NULL, 6144.00, 3936.00, 12770.00, NULL, NULL, 16, '2025-11-10 00:32:19', '2025-11-10 23:58:52'),
(6, 20, '2025-11-11', 121540.00, 42614.00, 1200.00, 8860.00, 624.00, 300.00, 88.89, 3168.00, 109212.00, 40701.11, NULL, NULL, 66, '2025-11-11 00:00:03', '2025-11-11 23:43:37'),
(7, 20, '2025-11-12', 23080.00, 9678.00, NULL, NULL, NULL, NULL, 2000.00, 750.00, 22330.00, 7678.00, NULL, NULL, 8, '2025-11-12 00:09:52', '2025-11-12 23:54:43'),
(8, 20, '2025-11-14', 850.00, 750.00, NULL, 50.00, NULL, NULL, NULL, NULL, 800.00, 750.00, NULL, NULL, 2, '2025-11-14 20:11:16', '2025-11-14 20:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `manager_id` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `manager_id`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'طبی', 2, 2, 'کاظم حسینی', '2025-12-24 23:43:02', '2025-12-25 00:01:40'),
(2, 'لابراتوار', 3, 1, 'کاظم حسینی', '2025-12-24 23:43:09', '0000-00-00 00:00:00'),
(3, 'test', 2, 1, 'کاظم حسینی', '2025-12-24 23:49:53', '2025-12-24 23:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `dosage`
--

DROP TABLE IF EXISTS `dosage`;
CREATE TABLE IF NOT EXISTS `dosage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosage` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosage`
--

INSERT INTO `dosage` (`id`, `dosage`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(3, 'یک دانه در روز', 1, 'کاظم حسینی', '2025-12-11 01:09:12', '2025-12-25 00:01:53'),
(4, 'دو دانه در روز', 2, 'کاظم حسینی', '2025-12-11 02:34:12', '2025-12-25 00:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

DROP TABLE IF EXISTS `drugs`;
CREATE TABLE IF NOT EXISTS `drugs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `generic_name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_id` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `strength` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `manufacturer` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `image` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `generic_name`, `category_id`, `strength`, `unit`, `manufacturer`, `description`, `price`, `image`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(2, 'Ibuprofen', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(3, 'Amoxicillin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(4, 'Azithromycin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(5, 'Ciprofloxacin', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(6, 'Metformin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(7, 'Amlodipine', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(8, 'Losartan', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(9, 'Omeprazole', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(10, 'Pantoprazole', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(11, 'Ranitidine', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(12, 'Levofloxacin', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(13, 'Clarithromycin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(14, 'Doxycycline', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(15, 'Metronidazole', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(16, 'Hydrochlorothiazide', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(17, 'Furosemide', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(18, 'Atorvastatin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(19, 'Simvastatin', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(20, 'Rosuvastatin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(21, 'Prednisolone', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(22, 'Cetirizine', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(23, 'Loratadine', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(24, 'Montelukast', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(25, 'Domperidone', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(26, 'Salbutamol', NULL, 'سیرم', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(27, 'Budesonide', NULL, 'سیرم', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(28, 'Insulin', NULL, 'سیرم', NULL, 'کارٹن', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(29, 'Heparin', NULL, 'سیرم', NULL, 'کارٹن', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(30, 'Normal Saline', NULL, 'سیرم', NULL, 'کارٹن', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(31, 'Ringer Lactate', NULL, 'سیرم', NULL, 'کارٹن', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(32, 'Glucose 5%', NULL, 'سیرم', NULL, 'کارٹن', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(33, 'Glucose 10%', NULL, 'سیرم', NULL, 'کارٹن', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(34, 'Clexane', NULL, 'سیرم', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(35, 'Meropenem', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(36, 'Ceftriaxone', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(37, 'Ceftazidime', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(38, 'Vancomycin', NULL, 'سیرم', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(39, 'Linezolid', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(40, 'Warfarin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-12-12 00:34:21', '2025-12-12 00:34:21'),
(41, 'Losartan', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(42, 'Valsartan', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(43, 'Olmesartan', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(44, 'Telmisartan', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(45, 'Atenolol', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(46, 'Bisoprolol', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(47, 'Nebivolol', NULL, 'گولی', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(48, 'Verapamil', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(49, 'Diltiazem', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(50, 'Furosemide', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(51, 'Hydrochlorothiazide', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(52, 'Spironolactone', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(53, 'Amiloride', NULL, 'تاپلت', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(54, 'Clonidine', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(55, 'Hydralazine', NULL, 'تاپلت', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(56, 'Atorvastatin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(57, 'Rosuvastatin', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(58, 'Simvastatin', NULL, 'گولی', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(59, 'Pravastatin', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(60, 'Gemfibrozil', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(61, 'Fenofibrate', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(62, 'Ezetimibe', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(63, 'Warfarin', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(64, 'Rivaroxaban', NULL, 'تاپلت', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(65, 'Apixaban', NULL, 'گولی', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(66, 'Dabigatran', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(67, 'Enoxaparin', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(68, 'Heparin', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(69, 'Ticagrelor', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(70, 'Prasugrel', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(71, 'Clopidogrel', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(72, 'Alteplase', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(73, 'Metformin Extended Release', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(74, 'Pioglitazone', NULL, 'تاپلت', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(75, 'Repaglinide', NULL, 'گولی', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(76, 'Nateglinide', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(77, 'Exenatide', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(78, 'Liraglutide', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(79, 'Dapagliflozin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(80, 'Canagliflozin', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(81, 'Empagliflozin', NULL, 'گولی', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(82, 'Insulin Lispro', NULL, 'سیرم', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(83, 'Insulin Glargine', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(84, 'Insulin Detemir', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(85, 'Insulin Aspart', NULL, 'سیرم', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(86, 'Sitagliptin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(87, 'Saxagliptin', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(88, 'Linagliptin', NULL, 'گولی', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(89, 'Vildagliptin', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(90, 'Budesonide', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(91, 'Montelukast', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(92, 'Salbutamol', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(93, 'Formoterol', NULL, 'تاپلت', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(94, 'Tiotropium', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(95, 'Theophylline', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(96, 'Cromolyn Sodium', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(97, 'Omeprazole', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(98, 'Rabeprazole', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(99, 'Pantoprazole', NULL, 'تاپلت', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(100, 'Sucralfate', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(101, 'Misoprostol', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(102, 'Lactulose', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(103, 'Loperamide', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(104, 'Diphenoxylate', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(105, 'Ranitidine', NULL, 'گولی', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(106, 'Famotidine', NULL, 'تاپلت', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(107, 'Bisacodyl', NULL, 'گولی', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(108, 'Senna', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(109, 'Polyethylene Glycol (PEG)', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(110, 'Clotrimazole', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(111, 'Terbinafine', NULL, 'تاپلت', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(112, 'Fluconazole', NULL, 'گولی', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(113, 'Itraconazole', NULL, 'تاپلت', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(114, 'Amphotericin B', NULL, 'سیرم', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(115, 'Doxycycline', NULL, 'گولی', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(116, 'Clarithromycin', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 2, '', '2025-01-01 00:00:00', '2025-12-14 03:14:47'),
(117, 'Azithromycin', NULL, 'گولی', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(118, 'Tobramycin', NULL, 'سیرم', NULL, 'عدد', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(119, 'Linezolid', NULL, 'تاپلت', NULL, 'بسته', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-12-14 03:40:34'),
(120, 'Meropenem', NULL, 'سیرم', NULL, 'کارتن', NULL, NULL, NULL, NULL, 1, '', '2025-01-01 00:00:00', '2025-01-01 00:00:00'),
(121, 'ostamin', NULL, '3', NULL, '8', NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-13 02:05:44', '2025-12-14 03:41:08'),
(122, 'amofdsf d500 ml', '', '3', NULL, '8', '', '', NULL, NULL, 1, 'احمد هاشمی', '2025-12-15 19:28:38', NULL),
(123, 'amo sadlfjsadf asdf 250ml', '', '4', NULL, '9', '', '', NULL, NULL, 1, 'احمد هاشمی', '2025-12-15 19:28:49', NULL),
(124, 'relief 500m', '', '3', NULL, '9', '', '', NULL, NULL, 1, 'احمد هاشمی', '2025-12-16 11:46:48', NULL),
(125, 'relief 250m', '', '3', NULL, '9', '', '', NULL, NULL, 1, 'احمد هاشمی', '2025-12-16 11:47:20', NULL),
(126, 'sadfadsfsadf sadflsjdf  500ml', '', '3', NULL, '9', '', '', NULL, NULL, 1, 'احمد هاشمی', '2025-12-17 02:04:59', NULL),
(127, 'fdadsfsafsdf sadfasdf 500ml', '', '3', NULL, '9', '', '', NULL, NULL, 1, 'احمد هاشمی', '2025-12-17 02:10:51', NULL),
(128, 'amo 500ml pk', '', '3', NULL, '9', '', '', NULL, NULL, 1, 'احمد هاشمی', '2025-12-18 01:50:55', NULL),
(129, 'amo 500ml ir', '', '3', NULL, '9', '', '', NULL, NULL, 1, 'احمد هاشمی', '2025-12-18 01:51:08', NULL),
(130, 'amo 250ml pk', '', '3', NULL, '9', '', '', NULL, NULL, 1, 'احمد هاشمی', '2025-12-18 01:51:21', NULL),
(131, 'Amoxicillin 500', NULL, '3', NULL, '9', NULL, NULL, NULL, NULL, 2, 'کاظم حسینی', '2025-12-22 03:10:21', '2025-12-26 02:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `drug_categories`
--

DROP TABLE IF EXISTS `drug_categories`;
CREATE TABLE IF NOT EXISTS `drug_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drug_categories`
--

INSERT INTO `drug_categories` (`id`, `cat_name`, `description`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(3, 'تابلت', '', 1, 'ali', '2025-12-07 12:35:59', NULL),
(4, 'سیرم', '', 1, 'ali', '2025-12-07 12:36:04', NULL),
(5, 'کپسول', NULL, 1, 'ali', '2025-12-07 12:36:10', '2025-12-09 20:00:08'),
(8, 'پماد', '', 1, 'احمد هاشمی', '2025-12-18 01:48:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `employee_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `father_name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `position` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `role` int DEFAULT '1',
  `department_id` int DEFAULT NULL,
  `verify_token` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forgot_token` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forgot_token_expire` datetime DEFAULT NULL,
  `remember_token` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `expire_remember_token` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `expertise` varchar(1024) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `image` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `salary_price` int DEFAULT NULL,
  `who_it` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `super_admin` tinyint DEFAULT NULL,
  `notif` tinyint NOT NULL DEFAULT '1' COMMENT '1 -> disable, 2 -> active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_name` (`employee_name`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `branch_id`, `employee_name`, `father_name`, `phone`, `password`, `email`, `address`, `position`, `role`, `department_id`, `verify_token`, `forgot_token`, `forgot_token_expire`, `remember_token`, `expire_remember_token`, `expertise`, `gender`, `image`, `description`, `salary_price`, `who_it`, `state`, `super_admin`, `notif`, `created_at`, `updated_at`) VALUES
(1, 100, 'کاظم حسینی', NULL, '11', '$2y$10$iuxczaYiD3vNG1eNsBV2au/XRgxZDOujEHZAYL1Tz4m6HBjJ6QNau', 'kazemafg@gmail.com', NULL, 'داکتر', 2, 2, NULL, '1daa771ddafb5d1cdc6968fa34a02a4de8c28ed632288dfd33d403619c458ea9', '2025-03-01 13:47:53', '93da1fe626def0451bfd6324282e00cc7fa9db8d5b51381db17dfeb56e8118a1', '3', 'متخصص گوش حلق بینی', NULL, '2024-09-01-23-53-55_66d4bf4bc0f96.jpg', NULL, 2000, '1', 1, 3, 2, '2024-09-01 23:53:55', '2025-12-26 02:01:38'),
(149, 0, 'حسن رضایی', NULL, '0799999999', '$2y$10$/rBJVmIQFUIJ/CgvjMjHZ.und0NRQIuJA2VxXFC/XEED8MLfSk/SK', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2025-12-12-02-18-59_693b3c4ba0f10.jpg', '', NULL, 'کاظم حسینی', 1, NULL, 1, '2025-12-12 02:18:59', '2025-12-12 02:25:46'),
(154, 100, 'ادمین دمو', NULL, '12345', '$2y$10$iuxczaYiD3vNG1eNsBV2au/XRgxZDOujEHZAYL1Tz4m6HBjJ6QNau', 'kazemafg@gmail.com', NULL, '', 2, NULL, NULL, '1daa771ddafb5d1cdc6968fa34a02a4de8c28ed632288dfd33d403619c458ea9', '2025-03-01 13:47:53', NULL, NULL, 'متخصص گوش حلق بینی', NULL, '2024-09-01-23-53-55_66d4bf4bc0f96.jpg', NULL, 2000, '1', 1, 3, 2, '2024-09-01 23:53:55', '2025-12-14 03:55:55'),
(155, 0, 'محمد احمدی', NULL, '0766666666', '$2y$10$pYigrU23y3fu3FXo0zYPI.8EeGRLReHBiewCUoc.LCZl/BDbCIEu.', '', '', 'داکتر', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'فوق تخصص جراحی', NULL, NULL, '', NULL, 'احمد هاشمی', 1, NULL, 1, '2025-12-15 18:41:55', '2025-12-16 16:32:44'),
(157, 0, 'احمد مرادی', NULL, '0793222222', '$2y$10$QU3AcxXsUezGsRFDjdQUu.tZ3GUNDOp2kjQWFE009K6Jq.2yTfbcK', '', '', 'داکتر', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'فوق تخصص جراحی', NULL, NULL, '', NULL, 'احمد هاشمی', 1, NULL, 1, '2025-12-16 16:32:34', '2025-12-16 16:34:17'),
(159, 0, 'omid', NULL, '333', '$2y$10$qtEFXNsIQsk06wBWREmoIuIgdD.6/srs3jfg5xnUr7uKpKqmtvDcG', '', '', 'آقا', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'فوق تخصص جراحی', NULL, NULL, '', NULL, 'کاظم حسینی', 1, NULL, 1, '2025-12-25 01:18:56', NULL),
(160, 0, 'غلام رضا', NULL, '22', '$2y$10$BGBmvLU55rz5Wl2gv2nT4eqo23tQESPdfRw6VhMBipzvvYuUPCn8C', '', '', 'آقا', 1, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, 'کاظم حسینی', 1, NULL, 1, '2025-12-25 01:19:15', NULL),
(161, 0, 'احمدرضا هاشمی اصلی', NULL, '65', '$2y$10$uI.o7.hpa6xFgmHfszbZNONmFr3ODj/dzXSGRWj44N/oNe8R2O7vu', '', '', 'داکتر', 1, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, 'کاظم حسینی', 1, NULL, 1, '2025-12-25 02:39:05', NULL),
(163, 0, 'mohammad jan', NULL, '456', '$2y$10$pgcJrrxWq3qtYjUMuYRXYeQ1t5DUF.1s39/NOlxb/BeXspwW4C2W6', '', '', 'داکتر', 1, 2, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, 'کاظم حسینی', 1, NULL, 1, '2025-12-25 02:44:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_expenses` varchar(124) NOT NULL,
  `category` varchar(30) NOT NULL,
  `price` varchar(11) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `image_expense` varchar(124) DEFAULT NULL,
  `by_whom` varchar(40) DEFAULT NULL,
  `payment_expense` varchar(11) DEFAULT NULL,
  `remainder_expense` varchar(11) DEFAULT NULL,
  `who_it` varchar(30) NOT NULL,
  `year` smallint NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content` (`title_expenses`),
  KEY `year` (`year`),
  KEY `category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_categories`
--

DROP TABLE IF EXISTS `expenses_categories`;
CREATE TABLE IF NOT EXISTS `expenses_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `who_it` varchar(30) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expenses_categories`
--

INSERT INTO `expenses_categories` (`id`, `cat_name`, `description`, `who_it`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test', '', 'محمد رضا', 1, '2025-11-03 12:00:54', NULL),
(2, 'لابراتوار', '', 'احمد رضا 1', 1, '2025-11-14 20:27:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intake_instructions`
--

DROP TABLE IF EXISTS `intake_instructions`;
CREATE TABLE IF NOT EXISTS `intake_instructions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intake_instructions` varchar(512) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intake_instructions`
--

INSERT INTO `intake_instructions` (`id`, `intake_instructions`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(3, 'خوراکی', 1, 'کاظم حسینی', '2025-12-11 01:11:03', NULL),
(4, 'به رگ', 1, 'کاظم حسینی', '2025-12-11 02:34:26', NULL),
(5, 'به گوشت', 1, 'کاظم حسینی', '2025-12-11 02:34:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intake_times`
--

DROP TABLE IF EXISTS `intake_times`;
CREATE TABLE IF NOT EXISTS `intake_times` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intake_time` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intake_times`
--

INSERT INTO `intake_times` (`id`, `intake_time`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(3, 'قبل از غذا', 1, 'کاظم حسینی', '2025-12-09 15:00:07', '2025-12-11 02:33:50'),
(6, 'بعد از غذا', 1, 'کاظم حسینی', '2025-12-11 02:32:56', NULL),
(7, 'هر شش ساعت', 1, 'کاظم حسینی', '2025-12-11 02:32:59', NULL),
(8, 'همراه با غذا', 1, 'احمد هاشمی', '2025-12-15 18:54:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `user_id` int NOT NULL,
  `ref_id` varchar(32) NOT NULL,
  `notif_type` tinyint NOT NULL DEFAULT '1' COMMENT '1->sale,buy.returns, 1->payment and recipt, 3->salaries',
  `title` varchar(64) NOT NULL,
  `msg` varchar(1024) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `read_at` date DEFAULT NULL,
  `state` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_status_created` (`user_id`,`status`,`created_at`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=428 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `branch_id`, `user_id`, `ref_id`, `notif_type`, `title`, `msg`, `status`, `read_at`, `state`, `created_at`, `updated_at`) VALUES
(404, 20, 48, '7', 2, 'فاکتور خرید', 'فاکتور خرید (شماره 7) ثبت شد.', 1, NULL, 1, '2025-11-14 20:11:16', NULL),
(405, 20, 116, '7', 2, 'فاکتور خرید', 'فاکتور خرید (شماره 7) ثبت شد.', 1, NULL, 1, '2025-11-14 20:11:16', NULL),
(406, 20, 4, '7', 2, 'فاکتور خرید', 'فاکتور فروش (شماره 7) به حساب شما ثبت شد.', 1, NULL, 1, '2025-11-14 20:11:16', NULL),
(407, 20, 48, '48', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:11:47', NULL),
(408, 20, 116, '48', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:11:47', NULL),
(409, 20, 116, '48', 7, 'پرداخت معاش', 'پرداخت معاش  48 برای شما ثبت شد.', 1, NULL, 1, '2025-11-14 20:11:47', NULL),
(410, 20, 48, '49', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:12:34', NULL),
(411, 20, 116, '49', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:12:34', NULL),
(412, 20, 116, '49', 7, 'پرداخت معاش', 'پرداخت معاش  49 برای شما ثبت شد.', 1, NULL, 1, '2025-11-14 20:12:34', NULL),
(413, 20, 48, '50', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:13:26', NULL),
(414, 20, 116, '50', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:13:26', NULL),
(415, 20, 116, '50', 7, 'پرداخت معاش', 'پرداخت معاش  50 برای شما ثبت شد.', 1, NULL, 1, '2025-11-14 20:13:26', NULL),
(416, 20, 48, '51', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:14:21', NULL),
(417, 20, 116, '51', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:14:21', NULL),
(418, 20, 116, '51', 7, 'پرداخت معاش', 'پرداخت معاش  51 برای شما ثبت شد.', 1, NULL, 1, '2025-11-14 20:14:21', NULL),
(419, 20, 48, '52', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:15:50', NULL),
(420, 20, 116, '52', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:15:50', NULL),
(421, 20, 116, '52', 7, 'پرداخت معاش', 'پرداخت معاش  52 برای شما ثبت شد.', 1, NULL, 1, '2025-11-14 20:15:50', NULL),
(422, 20, 48, '53', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:16:08', NULL),
(423, 20, 116, '53', 7, 'پرداخت معاش', 'پرداخت معاش برای احمد رضا 1 ثبت شد.', 1, NULL, 1, '2025-11-14 20:16:08', NULL),
(424, 20, 116, '53', 7, 'پرداخت معاش', 'پرداخت معاش  53 برای شما ثبت شد.', 1, NULL, 1, '2025-11-14 20:16:08', NULL),
(425, 20, 48, '8', 1, 'فاکتور فروش', 'فاکتور فروش (شماره 8) ثبت شد.', 1, NULL, 1, '2025-11-14 20:28:28', NULL),
(426, 20, 116, '8', 1, 'فاکتور فروش', 'فاکتور فروش (شماره 8) ثبت شد.', 1, NULL, 1, '2025-11-14 20:28:28', NULL),
(427, 20, 4, '8', 1, 'فاکتور فروش', 'فاکتور خرید (شماره 8) برای شما ثبت شد.', 1, NULL, 1, '2025-11-14 20:28:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `not_access_logs`
--

DROP TABLE IF EXISTS `not_access_logs`;
CREATE TABLE IF NOT EXISTS `not_access_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `page_address` varchar(124) NOT NULL,
  `ip_address` varchar(32) DEFAULT NULL,
  `user_agent` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `not_access_logs`
--

INSERT INTO `not_access_logs` (`id`, `user_id`, `section_name`, `page_address`, `ip_address`, `user_agent`, `status`, `created_at`, `updated_at`) VALUES
(75, 155, 'showDrugs', '/HospitalManagementSystem/drugs', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-15 18:46:37', NULL),
(76, 155, 'addEmployee', '/HospitalManagementSystem/add-employee', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-16 15:15:58', NULL),
(77, 155, 'intakeTime', '/HospitalManagementSystem/tests', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-16 15:22:11', NULL),
(78, 155, 'addEmployee', '/HospitalManagementSystem/add-employee', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-16 16:32:42', NULL),
(79, 158, 'addEmployee', '/HospitalManagementSystem/add-employee', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-17 00:35:42', NULL),
(80, 1, 'students', '/HospitalManagementSystem/search-em', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 1, '2025-12-24 21:26:02', NULL),
(81, 1, 'students', '/HospitalManagementSystem/search-em', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 1, '2025-12-24 21:28:16', NULL),
(82, 1, 'students', '/HospitalManagementSystem/search-em', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 1, '2025-12-24 21:28:19', NULL),
(83, 1, 'departments', '/HospitalManagementSystem/departments', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 1, '2025-12-24 23:34:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `number_of_drugs`
--

DROP TABLE IF EXISTS `number_of_drugs`;
CREATE TABLE IF NOT EXISTS `number_of_drugs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `number_of_drugs`
--

INSERT INTO `number_of_drugs` (`id`, `number`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 20, 1, '', '2025-12-09 09:50:25', '2025-12-17 02:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_name` varchar(50) DEFAULT NULL,
  `employee_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=930 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `section_name`, `employee_id`, `created_at`, `updated_at`) VALUES
(271, 'general', 116, NULL, NULL),
(800, 'addPatient', 148, '2025-12-11 17:45:50', NULL),
(801, 'parentPatients', 148, '2025-12-11 17:45:50', NULL),
(802, 'prescriptionPrint', 148, '2025-12-11 17:45:50', NULL),
(803, 'dashboard', 148, '2025-12-11 17:45:50', NULL),
(804, 'profile', 148, '2025-12-11 17:45:50', NULL),
(805, 'general', 148, '2025-12-11 17:45:50', NULL),
(806, 'prescriptionPrint', 149, '2025-12-12 02:18:59', NULL),
(807, 'parentPatients', 149, '2025-12-12 02:18:59', NULL),
(808, 'addPatient', 149, '2025-12-12 02:18:59', NULL),
(809, 'parentPrescription', 149, '2025-12-12 02:18:59', NULL),
(810, 'addPrescription', 149, '2025-12-12 02:18:59', NULL),
(811, 'showPrescription', 149, '2025-12-12 02:18:59', NULL),
(812, 'dashboard', 149, '2025-12-12 02:18:59', NULL),
(813, 'profile', 149, '2025-12-12 02:18:59', NULL),
(814, 'general', 149, '2025-12-12 02:18:59', NULL),
(815, 'dashboard', 150, '2025-12-12 03:10:46', NULL),
(816, 'profile', 150, '2025-12-12 03:10:46', NULL),
(817, 'general', 150, '2025-12-12 03:10:46', NULL),
(818, 'parentPatients', 151, '2025-12-12 03:16:59', NULL),
(819, 'showPatients', 151, '2025-12-12 03:16:59', NULL),
(820, 'addPatient', 151, '2025-12-12 03:16:59', NULL),
(821, 'parentPrescription', 151, '2025-12-12 03:16:59', NULL),
(822, 'addPrescription', 151, '2025-12-12 03:16:59', NULL),
(823, 'showPrescription', 151, '2025-12-12 03:16:59', NULL),
(824, 'dashboard', 151, '2025-12-12 03:16:59', NULL),
(825, 'profile', 151, '2025-12-12 03:16:59', NULL),
(826, 'general', 151, '2025-12-12 03:16:59', NULL),
(827, 'prescriptionPrint', 152, '2025-12-12 15:34:36', NULL),
(828, 'parentPatients', 152, '2025-12-12 15:34:36', NULL),
(829, 'showPatients', 152, '2025-12-12 15:34:36', NULL),
(830, 'addPatient', 152, '2025-12-12 15:34:36', NULL),
(831, 'parentPrescription', 152, '2025-12-12 15:34:36', NULL),
(832, 'addPrescription', 152, '2025-12-12 15:34:36', NULL),
(833, 'showPrescription', 152, '2025-12-12 15:34:36', NULL),
(834, 'dashboard', 152, '2025-12-12 15:34:36', NULL),
(835, 'profile', 152, '2025-12-12 15:34:36', NULL),
(836, 'general', 152, '2025-12-12 15:34:36', NULL),
(837, 'prescriptionPrint', 153, '2025-12-12 15:37:35', NULL),
(838, 'parentPatients', 153, '2025-12-12 15:37:35', NULL),
(839, 'showPatients', 153, '2025-12-12 15:37:35', NULL),
(840, 'addPatient', 153, '2025-12-12 15:37:35', NULL),
(841, 'parentPrescription', 153, '2025-12-12 15:37:35', NULL),
(842, 'addPrescription', 153, '2025-12-12 15:37:35', NULL),
(843, 'showPrescription', 153, '2025-12-12 15:37:35', NULL),
(844, 'dashboard', 153, '2025-12-12 15:37:35', NULL),
(845, 'profile', 153, '2025-12-12 15:37:35', NULL),
(846, 'general', 153, '2025-12-12 15:37:35', NULL),
(867, 'prescriptionPrint', 156, '2025-12-15 18:48:20', NULL),
(868, 'dashboard', 156, '2025-12-15 18:48:20', NULL),
(869, 'profile', 156, '2025-12-15 18:48:20', NULL),
(870, 'general', 156, '2025-12-15 18:48:20', NULL),
(883, 'addPrescription', 155, '2025-12-16 15:19:59', NULL),
(884, 'showPrescription', 155, '2025-12-16 15:19:59', NULL),
(885, 'parentPrescription', 155, '2025-12-16 15:19:59', NULL),
(886, 'addDrug', 155, '2025-12-16 15:19:59', NULL),
(887, 'parentDrug', 155, '2025-12-16 15:19:59', NULL),
(888, 'tests', 155, '2025-12-16 15:19:59', NULL),
(889, 'parentSetting', 155, '2025-12-16 15:19:59', NULL),
(890, 'showPatients', 155, '2025-12-16 15:19:59', NULL),
(891, 'addPatient', 155, '2025-12-16 15:19:59', NULL),
(892, 'parentPatients', 155, '2025-12-16 15:19:59', NULL),
(893, 'prescriptionPrint', 155, '2025-12-16 15:19:59', NULL),
(894, 'dashboard', 155, '2025-12-16 15:19:59', NULL),
(895, 'profile', 155, '2025-12-16 15:19:59', NULL),
(896, 'general', 155, '2025-12-16 15:19:59', NULL),
(897, 'parentPatients', 157, '2025-12-16 16:32:34', NULL),
(898, 'showPatients', 157, '2025-12-16 16:32:34', NULL),
(899, 'addPatient', 157, '2025-12-16 16:32:34', NULL),
(900, 'parentPrescription', 157, '2025-12-16 16:32:34', NULL),
(901, 'addPrescription', 157, '2025-12-16 16:32:34', NULL),
(902, 'showPrescription', 157, '2025-12-16 16:32:34', NULL),
(903, 'dashboard', 157, '2025-12-16 16:32:34', NULL),
(904, 'profile', 157, '2025-12-16 16:32:34', NULL),
(905, 'general', 157, '2025-12-16 16:32:34', NULL),
(906, 'parentPatients', 158, '2025-12-16 16:35:38', NULL),
(907, 'showPatients', 158, '2025-12-16 16:35:38', NULL),
(908, 'addPatient', 158, '2025-12-16 16:35:38', NULL),
(909, 'parentPrescription', 158, '2025-12-16 16:35:38', NULL),
(910, 'addPrescription', 158, '2025-12-16 16:35:38', NULL),
(911, 'showPrescription', 158, '2025-12-16 16:35:38', NULL),
(912, 'dashboard', 158, '2025-12-16 16:35:38', NULL),
(913, 'profile', 158, '2025-12-16 16:35:38', NULL),
(914, 'general', 158, '2025-12-16 16:35:38', NULL),
(915, 'dashboard', 159, '2025-12-25 01:18:56', NULL),
(916, 'profile', 159, '2025-12-25 01:18:56', NULL),
(917, 'general', 159, '2025-12-25 01:18:56', NULL),
(918, 'dashboard', 160, '2025-12-25 01:19:15', NULL),
(919, 'profile', 160, '2025-12-25 01:19:15', NULL),
(920, 'general', 160, '2025-12-25 01:19:15', NULL),
(921, 'dashboard', 161, '2025-12-25 02:39:05', NULL),
(922, 'profile', 161, '2025-12-25 02:39:05', NULL),
(923, 'general', 161, '2025-12-25 02:39:05', NULL),
(924, 'dashboard', 162, '2025-12-25 02:42:59', NULL),
(925, 'profile', 162, '2025-12-25 02:42:59', NULL),
(926, 'general', 162, '2025-12-25 02:42:59', NULL),
(927, 'dashboard', 163, '2025-12-25 02:44:26', NULL),
(928, 'profile', 163, '2025-12-25 02:44:26', NULL),
(929, 'general', 163, '2025-12-25 02:44:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `name` varchar(64) NOT NULL,
  `who_it` varchar(30) NOT NULL,
  `state` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `branch_id`, `name`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(1, 0, 'داکتر', 'کاظم حسینی', 1, '2025-12-08 15:31:51', '2025-12-11 00:39:55'),
(8, 0, 'حسابدار', 'کاظم حسینی', 1, '2025-12-11 01:54:52', NULL),
(12, 0, 'آشپز', 'کاظم حسینی', 2, '2025-12-11 02:22:13', '2025-12-14 03:40:01'),
(13, 0, 'گارد', 'احمد هاشمی', 1, '2025-12-15 18:40:14', NULL),
(14, 0, 'تحویل دهی نسخه', 'احمد هاشمی', 1, '2025-12-15 18:47:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE IF NOT EXISTS `prescriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int DEFAULT NULL,
  `visit_id` int DEFAULT NULL,
  `patient_name` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `admission_id` int DEFAULT NULL,
  `birth_year` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `diagnosis` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bp` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pr` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rr` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `temp` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `spo2` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `year` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `month` tinyint NOT NULL,
  `type` tinyint NOT NULL DEFAULT '1' COMMENT '1->simble-visit',
  `edited` tinyint DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `visit_id`, `patient_name`, `doctor_id`, `admission_id`, `birth_year`, `diagnosis`, `bp`, `pr`, `rr`, `temp`, `spo2`, `year`, `month`, `type`, `edited`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 34, 0, 'علی رضایی', 1, NULL, '1378', NULL, '120/80', '78', '16', '36.7', '98', '1404', 10, 1, NULL, 3, 'کاظم حسینی', '2025-12-09 01:08:57', '2025-12-26 15:18:06'),
(2, 12, 0, 'مریم احمدی', 1, NULL, '1385', NULL, '110/70', '74', '17', '36.5', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-12 01:08:57', '2025-12-12 01:08:57'),
(3, 77, 0, 'سارا محمدی', 2, NULL, '1370', NULL, '115/75', '80', '18', '37.0', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-12 01:08:57', '2025-12-12 01:08:57'),
(4, 52, 0, 'حسن عباسی', 1, NULL, '1392', NULL, '125/85', '72', '15', '36.4', '96', '1404', 9, 1, NULL, 3, 'admin', '2025-12-11 01:08:57', '2025-12-12 01:08:57'),
(5, 90, 0, 'نیلوفر سادات', 3, NULL, '1381', NULL, '118/76', '79', '17', '36.6', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-12 01:08:57'),
(6, 63, 0, 'جواد رحیمی', 4, NULL, '1375', NULL, '130/90', '85', '19', '37.1', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-12 01:08:57'),
(7, 18, 0, 'زهرا اکبری', 1, NULL, '1390', NULL, '108/68', '70', '16', '36.3', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-12 01:08:57'),
(8, 41, 0, 'فاطمه یوسفی', 4, NULL, '1387', NULL, '112/72', '76', '17', '36.5', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-12 01:08:57', '2025-12-12 01:08:57'),
(9, 25, 0, 'علی احمدی', 4, NULL, '1373', NULL, '118/78', '83', '18', '36.9', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-11 01:08:57', '2025-12-11 01:08:57'),
(10, 57, 0, 'سارا هاشمی', 3, NULL, '1391', NULL, '122/80', '77', '17', '36.6', '96', '1404', 9, 1, NULL, 3, 'admin', '2025-12-11 01:08:57', '2025-12-11 01:08:57'),
(11, 88, 0, 'نگین رسولی', 1, NULL, '1384', NULL, '119/74', '75', '16', '36.4', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-11 01:08:57', '2025-12-11 01:08:57'),
(12, 12, 0, 'حسین موسوی', 3, NULL, '1380', NULL, '128/82', '84', '18', '37.0', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-11 01:08:57', '2025-12-11 01:08:57'),
(13, 44, 0, 'زهرا کریمی', 4, NULL, '1393', NULL, '114/73', '71', '15', '36.3', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-11 01:08:57', '2025-12-11 01:08:57'),
(14, 101, 0, 'ندا مرادی', 6, NULL, '1379', NULL, '116/74', '79', '16', '36.5', '96', '1404', 9, 1, NULL, 3, 'admin', '2025-12-11 01:08:57', '2025-12-11 01:08:57'),
(15, 73, 0, 'مهدی قربانی', 5, NULL, '1394', NULL, '111/71', '72', '15', '36.3', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-11 01:08:57', '2025-12-11 01:08:57'),
(16, 7, 0, 'راضیه انوری', 1, NULL, '1372', NULL, '124/81', '78', '17', '36.8', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-10 01:08:57', '2025-12-10 01:08:57'),
(17, 95, 0, 'شیما عزیزی', 2, NULL, '1386', NULL, '113/69', '70', '15', '36.4', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-10 01:08:57', '2025-12-10 01:08:57'),
(18, 60, 0, 'یاسین روستا', 6, NULL, '1377', NULL, '125/83', '82', '18', '37.1', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-10 01:08:57', '2025-12-10 01:08:57'),
(19, 22, 0, 'فریبا سهرابی', 1, NULL, '1383', NULL, '109/67', '74', '16', '36.2', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-10 01:08:57', '2025-12-10 01:08:57'),
(20, 48, 0, 'شیرین نوروزی', 5, NULL, '1388', NULL, '132/89', '86', '19', '37.3', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-10 01:08:57', '2025-12-10 01:08:57'),
(21, 102, 0, 'فرزاد طاهری', 6, NULL, '1376', NULL, '117/76', '80', '17', '36.7', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-10 01:08:57', '2025-12-10 01:08:57'),
(22, 31, 0, 'بهاره رستگار', 5, NULL, '1390', NULL, '120/74', '77', '15', '36.4', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-10 01:08:57', '2025-12-10 01:08:57'),
(23, 40, 0, 'کاظم یعقوبی', 6, NULL, '1382', NULL, '115/72', '76', '17', '36.5', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-09 01:08:57'),
(24, 68, 0, 'زهرا نعمتی', 4, NULL, '1389', NULL, '118/79', '81', '18', '36.8', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-09 01:08:57'),
(25, 11, 0, 'شقایق فضلی', 6, NULL, '1374', NULL, '122/81', '83', '17', '36.6', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-09 01:08:57'),
(26, 70, 0, 'امید مرادی', 6, NULL, '1395', NULL, '128/86', '88', '19', '37.2', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-09 01:08:57'),
(27, 27, 0, 'حمید رسولی', 4, NULL, '1371', NULL, '110/69', '73', '16', '36.4', '96', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-09 01:08:57'),
(28, 53, 0, 'مونا فرهمند', 4, NULL, '1392', NULL, '116/74', '78', '16', '36.5', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-09 01:08:57'),
(29, 118, 0, 'زهرا وطن‌دوست', 6, NULL, '1384', NULL, '113/71', '75', '16', '36.4', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-09 01:08:57', '2025-12-09 01:08:57'),
(30, 16, 0, 'الهام صدیقی', 6, NULL, '1387', NULL, '121/80', '82', '18', '36.9', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-08 01:08:57', '2025-12-08 01:08:57'),
(31, 92, 0, 'حمیده هراتی', 1, NULL, '1378', NULL, '130/90', '86', '19', '37.3', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-08 01:08:57', '2025-12-08 01:08:57'),
(32, 36, 0, 'سلمان فرجی', 5, NULL, '1381', NULL, '119/77', '76', '17', '36.6', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-08 01:08:57', '2025-12-08 01:08:57'),
(33, 101, 0, 'ابراهیم سلیمانی', 2, NULL, '1375', NULL, '117/74', '74', '16', '36.4', '96', '1404', 9, 1, NULL, 3, 'admin', '2025-12-08 01:08:57', '2025-12-08 01:08:57'),
(34, 55, 0, 'معصومه شکوری', 2, NULL, '1393', NULL, '115/73', '78', '17', '36.5', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-08 01:08:57', '2025-12-08 01:08:57'),
(35, 80, 0, 'شیوا احمدپور', 4, NULL, '1383', NULL, '122/82', '84', '18', '36.9', '99', '1404', 9, 1, NULL, 3, 'admin', '1900-01-06 00:00:00', '2025-12-08 01:08:57'),
(36, 14, 0, 'فاطمه ذبیحی', 5, NULL, '1376', NULL, '112/70', '72', '16', '36.3', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-08 01:08:57', '2025-12-08 01:08:57'),
(37, 84, 0, 'امیر جعفری', 3, NULL, '1391', NULL, '120/79', '80', '18', '36.8', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-07 01:08:57', '2025-12-07 01:08:57'),
(38, 10, 0, 'سمیه بخشی', 5, NULL, '1380', NULL, '118/75', '76', '17', '36.5', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 00:00:00', '2025-12-07 01:08:57'),
(39, 49, 0, 'کاوه سعیدی', 5, NULL, '1386', NULL, '130/87', '85', '19', '37.2', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-07 01:08:57', '2025-12-07 01:08:57'),
(40, 22, 0, 'الهه محمودی', 3, NULL, '1394', NULL, '116/74', '72', '16', '36.4', '96', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 01:08:57', '2025-12-07 01:08:57'),
(41, 97, 0, 'ابراهیم جمالی', 1, NULL, '1379', NULL, '121/81', '79', '17', '36.6', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-07 01:08:57', '2025-12-07 01:08:57'),
(42, 61, 0, 'آرزو یکتا', 5, NULL, '1389', NULL, '114/73', '74', '16', '36.5', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-07 01:08:57', '2025-12-07 01:08:57'),
(43, 33, 0, 'پویا شیرازی', 3, NULL, '1392', NULL, '125/83', '81', '18', '37.0', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-07 01:08:57', '2025-12-07 01:08:57'),
(44, 28, 0, 'سعیده مقیمی', 5, NULL, '1384', NULL, '118/78', '79', '17', '36.6', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 01:08:57', '2025-12-06 01:08:57'),
(45, 50, 0, 'پدرام قائمی', 5, NULL, '1371', NULL, '126/84', '83', '19', '37.1', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 01:08:57', '2025-12-06 01:08:57'),
(46, 93, 0, 'فاطمه محسنی', 2, NULL, '1390', NULL, '112/71', '73', '16', '36.4', '97', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 01:08:57', '2025-12-06 01:08:57'),
(47, 15, 0, 'نیما یوسفی', 3, NULL, '1387', NULL, '115/72', '74', '16', '36.3', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 01:08:57', '2025-12-06 01:08:57'),
(48, 71, 0, 'بیتا فرجی', 3, NULL, '1375', NULL, '130/90', '86', '19', '37.3', '99', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 01:08:57', '2025-12-06 01:08:57'),
(49, 109, 0, 'محمد افکاری', 3, NULL, '1393', NULL, '117/76', '78', '17', '36.6', '98', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 01:08:57', '2025-12-06 01:08:57'),
(50, 6, 0, 'الهام ناصری', 5, NULL, '1373', NULL, '113/69', '72', '15', '36.3', '96', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 01:08:57', '2025-12-06 01:08:57'),
(51, 6, 0, 'الهام ناصری', 6, NULL, '1373', NULL, '113/69', '72', '15', '36.3', '96', '1404', 9, 1, NULL, 3, 'admin', '2025-12-06 01:08:57', '2025-12-06 01:08:57'),
(52, 51, 0, 'محمد احمدی', 1, NULL, '1379', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 01:49:57', '2025-12-12 01:50:41'),
(54, 52, 0, 'حسین رضایی', 1, NULL, '1379', NULL, '33', NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 02:23:29', '2025-12-12 02:25:04'),
(71, 67, 0, 'حسن مرادی', 1, NULL, '1374', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 14:43:35', '2025-12-12 14:53:02'),
(72, 68, 0, 'احمد حسینی', 1, NULL, '1360', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 14:57:05', '2025-12-12 15:01:57'),
(73, 69, 0, 'محمد رضا احمدی', 1, NULL, '1379', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 15:02:35', '2025-12-12 15:02:49'),
(74, 70, 0, 'اسد غلامی', 1, NULL, '1381', NULL, '33', NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 15:03:26', '2025-12-12 15:24:48'),
(75, 71, 0, 'محمد رضا احمدی', 1, NULL, '1363', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 16:26:20', '2025-12-12 16:27:20'),
(76, 72, 0, 'کاظم احمدی', 1, NULL, '1381', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 16:29:12', '2025-12-12 16:30:15'),
(77, 73, 0, 'کاظم', 1, NULL, '1379', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 16:31:17', '2025-12-12 16:31:27'),
(78, 74, 0, 'کاظم ', 1, NULL, '1384', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 16:32:07', '2025-12-12 16:32:40'),
(79, 75, 0, 'فهیم', 1, NULL, '1384', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'کاظم حسینی', '2025-12-12 16:33:18', '2025-12-12 16:34:08'),
(80, 76, 0, 'احمد', 154, NULL, '1382', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'ادمین دمو', '2025-12-12 22:56:13', '2025-12-13 22:56:05'),
(174, 126, 0, 'علی رضایی', 2, NULL, '1379', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, NULL, 3, 'احمد هاشمی', '2025-12-17 02:11:58', '2025-12-18 01:53:17'),
(175, 127, 0, 'dsfsdfd', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-21 19:24:32', '2025-12-22 00:59:33'),
(176, 128, 0, 'احمد حسینی', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:07:16', '2025-12-22 01:08:58'),
(177, 129, 0, 'sadfdsfd', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:11:11', '2025-12-22 01:11:15'),
(178, 130, 0, 'dsfsdf3', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:11:32', '2025-12-22 01:11:34'),
(179, 131, 0, '333', 1, NULL, '1402', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:12:11', '2025-12-22 01:12:14'),
(180, 132, 0, '33', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:12:33', '2025-12-22 01:12:35'),
(181, 133, 0, 'احمد حسینی', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:15:33', '2025-12-22 01:15:37'),
(182, 134, 0, '3334', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:16:24', '2025-12-22 01:16:27'),
(183, 135, 0, 'sdfdf', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:16:48', '2025-12-22 01:16:52'),
(184, 136, 0, 'sdfdsf', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:17:09', '2025-12-22 01:17:12'),
(185, 137, 0, 'dsfsdf', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:20:47', '2025-12-22 01:20:49'),
(186, 138, 0, 'afsdf', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:21:57', '2025-12-22 01:22:00'),
(187, 133, 0, 'احمد حسینی', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:29:37', '2025-12-22 01:29:40'),
(188, 139, 0, 'dfdf', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:30:39', '2025-12-22 01:30:41'),
(189, 135, 0, 'sdfdf', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 01:31:23', '2025-12-22 01:31:25'),
(190, 140, 0, 'sadfsadf', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 02:31:49', '2025-12-22 02:31:52'),
(191, 141, 0, 'trytry', 1, NULL, '1349', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 02:42:21', '2025-12-22 02:43:48'),
(192, 128, 0, 'احمد حسینی', 1, NULL, '1371', 'باید ازمایش دهد', '33', '33', '4', NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 02:44:31', '2025-12-22 02:45:46'),
(193, 142, 0, 'احمد حسینی', 1, NULL, '1379', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 02:56:40', '2025-12-22 02:57:02'),
(197, 143, 0, 'احمد حسینی', 1, NULL, '1379', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 03:22:18', '2025-12-22 03:23:06'),
(200, 144, 0, 'احمد حسینی', 1, NULL, '1379', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 03:33:43', '2025-12-22 03:34:33'),
(202, 145, 0, 'احمد حسینی', 1, NULL, '1381', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 03:40:18', '2025-12-22 03:41:17'),
(203, 146, 0, 'محمد رضا احمدی', 1, NULL, '1349', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 03:54:32', '2025-12-22 03:54:48'),
(204, 147, 0, 'احمد حسینی', 1, NULL, '1359', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 03:59:16', '2025-12-22 03:59:39'),
(205, 148, 0, 'احمد حسینی', 1, NULL, '1384', 'باید ازمایش دهد', '33', '33', '22', NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-22 04:00:00', '2025-12-22 04:00:29'),
(206, 149, 0, 'شش', 1, NULL, '1401', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-23 02:55:10', '2025-12-23 02:55:14'),
(207, NULL, NULL, 'احمد حسینی a', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-24 17:24:33', '2025-12-24 17:24:42'),
(208, 150, NULL, 'احمد حسینی 22', 1, NULL, '1360', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-24 17:25:17', '2025-12-24 17:25:36'),
(209, 157, NULL, '111', 1, NULL, '1382', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 03:24:49', '2025-12-25 03:24:55'),
(210, 158, NULL, 'احمد حسینی', 1, NULL, '1402', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 03:25:07', '2025-12-25 03:25:12'),
(211, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 05:16:22', '2025-12-25 05:33:03'),
(212, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 05:34:21', '2025-12-25 05:34:23'),
(213, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 05:38:56', '2025-12-25 05:38:58'),
(214, 165, NULL, 'رجب علی', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 14:24:17', '2025-12-25 14:36:42'),
(215, 149, NULL, 'شش', 1, 9, '1401', 'ddddd', '33', '33', NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 14:39:34', '2025-12-25 14:40:21'),
(216, 165, NULL, 'رجب علی', 1, 15, '1371', '33333', '33', NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 14:50:19', '2025-12-25 14:50:29'),
(217, 167, NULL, 'رجب احمد', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 14:51:24', '2025-12-25 14:51:34'),
(218, 168, NULL, 'صادق رضایی', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 14:56:22', '2025-12-25 14:56:33'),
(219, 168, NULL, 'صادق رضایی', 1, 17, '1371', 'ffff', NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 14:57:19', '2025-12-25 14:57:26'),
(220, 171, NULL, 'mamad', 1, NULL, '1379', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 16:37:01', '2025-12-25 16:37:09'),
(221, 172, NULL, 'احمد حسینی', 1, NULL, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 16:37:35', '2025-12-25 16:37:38'),
(222, 159, NULL, 'ملا جان', 1, 11, '1371', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 16:41:04', '2025-12-25 16:41:08'),
(223, 169, NULL, 'هاشمی', 1, 19, '1339', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 16:41:23', '2025-12-25 16:41:41'),
(224, 175, NULL, 'امیر حسنی', 1, 24, '1372', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-25 23:01:46', '2025-12-25 23:02:05'),
(225, 178, NULL, 'اکبر اما', 1, 28, '1361', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-26 13:27:30', '2025-12-26 13:27:31'),
(226, 178, NULL, 'اکبر اما', 1, 29, '1361', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-26 13:51:06', '2025-12-26 13:51:08'),
(227, 178, NULL, 'اکبر اما', 1, 28, '1361', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-26 15:33:37', '2025-12-26 15:34:25'),
(228, 180, NULL, 'اکبر اما', 1, 29, '1361', 'برای است است', '1.5', '22', '4', '22', '50.2', '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-26 15:41:37', '2025-12-26 16:48:50'),
(229, 182, NULL, 'asi', 1, 30, '1390', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-26 16:49:40', '2025-12-26 16:54:35'),
(230, 184, NULL, 'غلام رضا احمدی', 1, 31, '1379', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-26 17:23:00', '2025-12-26 21:14:30'),
(231, 185, NULL, 'fffffff', 1, 32, '1364', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, 1, 2, 'کاظم حسینی', '2025-12-26 17:30:25', '2025-12-27 01:57:21'),
(232, 172, NULL, 'احمد حسینی', 1, NULL, '1371', 'f', '1.5', '22', NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-26 22:56:23', '2025-12-26 23:09:28'),
(236, 151, NULL, 'sadfsdf', 1, 33, '1382', NULL, NULL, NULL, NULL, NULL, NULL, '1404', 10, 1, NULL, 2, 'کاظم حسینی', '2025-12-27 01:10:04', '2025-12-27 01:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_items`
--

DROP TABLE IF EXISTS `prescription_items`;
CREATE TABLE IF NOT EXISTS `prescription_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `drug_name` varchar(124) COLLATE utf8mb4_general_ci NOT NULL,
  `prescription_id` int NOT NULL,
  `drug_id` int NOT NULL,
  `dosage` varchar(124) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `interval_time` varchar(124) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration_days` varchar(124) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usage_instruction` varchar(124) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `drug_count` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `drug_name` (`drug_name`)
) ENGINE=InnoDB AUTO_INCREMENT=417 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_items`
--

INSERT INTO `prescription_items` (`id`, `drug_name`, `prescription_id`, `drug_id`, `dosage`, `interval_time`, `duration_days`, `usage_instruction`, `company`, `description`, `drug_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol', 12, 5, '500mg', 'Every 8 hours', '5', 'Oral', NULL, '', 15, 1, '2025-12-05 10:12:00', '2025-12-05 10:12:00'),
(2, 'Amoxicillin', 3, 8, '250mg', 'Every 12 hours', '7', 'Oral', NULL, '', 20, 1, '2025-12-06 11:30:00', '2025-12-06 11:30:00'),
(3, 'Ibuprofen', 27, 15, '200mg', 'Every 6 hours', '3', 'Oral', NULL, '', 10, 1, '2025-12-07 09:45:00', '2025-12-07 09:45:00'),
(4, 'Cetirizine', 9, 22, '10mg', 'Every 24 hours', '10', 'Oral', NULL, '', 30, 1, '2025-12-08 14:20:00', '2025-12-08 14:20:00'),
(5, 'Metformin', 44, 18, '500mg', 'Every 12 hours', '7', 'Oral', NULL, '', 18, 1, '2025-12-09 16:10:00', '2025-12-09 16:10:00'),
(6, 'Clonazepam', 15, 20, '0.5mg', 'Every 24 hours', '14', 'Oral', NULL, '', 14, 1, '2025-12-10 12:00:00', '2025-12-10 12:00:00'),
(7, 'Diazepam', 22, 25, '5mg', 'Every 12 hours', '7', 'Oral', NULL, '', 21, 1, '2025-12-11 09:30:00', '2025-12-11 09:30:00'),
(8, 'Warfarin', 8, 30, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 60, 1, '2025-12-12 10:15:00', '2025-12-12 10:15:00'),
(9, 'Atorvastatin', 33, 35, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2025-12-13 14:45:00', '2025-12-13 14:45:00'),
(10, 'Loratadine', 6, 40, '10mg', 'Every 24 hours', '60', 'Oral', NULL, '', 60, 1, '2025-12-14 11:10:00', '2025-12-14 11:10:00'),
(11, 'Alprazolam', 40, 45, '0.25mg', 'Every 12 hours', '10', 'Oral', NULL, '', 20, 1, '2025-12-15 13:30:00', '2025-12-15 13:30:00'),
(12, 'Calcium Carbonate', 18, 50, '500mg', 'Every 24 hours', '20', 'Oral', NULL, '', 40, 1, '2025-12-16 15:00:00', '2025-12-16 15:00:00'),
(13, 'Fluoxetine', 5, 55, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2025-12-17 09:50:00', '2025-12-17 09:50:00'),
(14, 'Salbutamol', 12, 60, '50mcg', 'Every 12 hours', '30', 'Inhalation', NULL, '', 60, 1, '2025-12-18 11:20:00', '2025-12-18 11:20:00'),
(15, 'Losartan', 30, 65, '50mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2025-12-19 08:40:00', '2025-12-19 08:40:00'),
(16, 'Azithromycin', 25, 70, '250mg', 'Every 24 hours', '5', 'Oral', NULL, '', 10, 1, '2025-12-20 10:55:00', '2025-12-20 10:55:00'),
(17, 'Propranolol', 45, 75, '40mg', 'Every 12 hours', '60', 'Oral', NULL, '', 120, 1, '2025-12-21 14:10:00', '2025-12-21 14:10:00'),
(18, 'Citalopram', 28, 80, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2025-12-22 15:25:00', '2025-12-22 15:25:00'),
(19, 'Lorazepam', 2, 85, '1mg', 'Every 12 hours', '10', 'Oral', NULL, '', 20, 1, '2025-12-23 16:35:00', '2025-12-23 16:35:00'),
(20, 'Hydrochlorothiazide', 50, 90, '25mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2025-12-24 17:45:00', '2025-12-24 17:45:00'),
(21, 'Clidinium', 1, 95, '2mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '2025-12-25 09:10:00', '2025-12-25 09:10:00'),
(22, 'Tamoxifen', 7, 100, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2025-12-26 11:20:00', '2025-12-26 11:20:00'),
(23, 'Corticosteroid', 35, 105, '10mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '2025-12-27 12:30:00', '2025-12-27 12:30:00'),
(24, 'Phenylephrine', 21, 110, '10mg', 'Every 8 hours', '7', 'Oral', NULL, '', 21, 1, '2025-12-28 14:40:00', '2025-12-28 14:40:00'),
(25, 'Penicillin', 39, 115, '500mg', 'Every 6 hours', '10', 'Oral', NULL, '', 40, 1, '2025-12-29 15:50:00', '2025-12-29 15:50:00'),
(26, 'Colchicine', 23, 120, '0.6mg', 'Every 12 hours', '5', 'Oral', NULL, '', 15, 1, '2025-12-30 16:55:00', '2025-12-30 16:55:00'),
(27, 'Hydroxychloroquine', 10, 1, '200mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2025-12-31 10:05:00', '2025-12-31 10:05:00'),
(28, 'Metronidazole', 42, 3, '500mg', 'Every 8 hours', '7', 'Oral', NULL, '', 21, 1, '2026-01-01 11:15:00', '2026-01-01 11:15:00'),
(29, 'Gabapentin', 17, 5, '300mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-01-02 12:25:00', '2026-01-02 12:25:00'),
(30, 'Diphenhydramine', 38, 8, '25mg', 'Every 24 hours', '10', 'Oral', NULL, '', 20, 1, '2026-01-03 13:35:00', '2026-01-03 13:35:00'),
(31, 'Azithromycin', 11, 12, '500mg', 'Every 24 hours', '5', 'Oral', NULL, '', 10, 1, '2026-01-04 08:15:00', '2026-01-04 08:15:00'),
(32, 'Naproxen', 29, 18, '250mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '2026-01-05 09:25:00', '2026-01-05 09:25:00'),
(33, 'Levothyroxine', 7, 23, '50mcg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-01-06 10:35:00', '2026-01-06 10:35:00'),
(34, 'Furosemide', 34, 27, '40mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '2026-01-07 11:45:00', '2026-01-07 11:45:00'),
(35, 'Albuterol', 13, 30, '90mcg', 'Every 6 hours', '10', 'Inhalation', NULL, '', 40, 1, '2026-01-08 12:55:00', '2026-01-08 12:55:00'),
(36, 'Clindamycin', 25, 33, '300mg', 'Every 8 hours', '7', 'Oral', NULL, '', 21, 1, '2026-01-09 13:05:00', '2026-01-09 13:05:00'),
(37, 'Doxycycline', 20, 36, '100mg', 'Every 12 hours', '10', 'Oral', NULL, '', 20, 1, '2026-01-10 14:15:00', '2026-01-10 14:15:00'),
(38, 'Gabapentin', 40, 38, '300mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-01-11 15:25:00', '2026-01-11 15:25:00'),
(39, 'Hydrocodone', 18, 41, '5mg', 'Every 6 hours', '7', 'Oral', NULL, '', 28, 1, '2026-01-12 16:35:00', '2026-01-12 16:35:00'),
(40, 'Ipratropium', 32, 44, '17mcg', 'Every 8 hours', '10', 'Inhalation', NULL, '', 30, 1, '2026-01-13 17:45:00', '2026-01-13 17:45:00'),
(41, 'Levofloxacin', 6, 47, '500mg', 'Every 24 hours', '7', 'Oral', NULL, '', 14, 1, '2026-01-14 08:55:00', '2026-01-14 08:55:00'),
(42, 'Meloxicam', 9, 50, '15mg', 'Every 24 hours', '10', 'Oral', NULL, '', 20, 1, '2026-01-15 09:05:00', '2026-01-15 09:05:00'),
(43, 'Methylprednisolone', 31, 53, '4mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '2026-01-16 10:15:00', '2026-01-16 10:15:00'),
(44, 'Montelukast', 22, 56, '10mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-01-17 11:25:00', '2026-01-17 11:25:00'),
(45, 'Nifedipine', 14, 59, '30mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-01-18 12:35:00', '2026-01-18 12:35:00'),
(46, 'Omeprazole', 37, 62, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-01-19 13:45:00', '2026-01-19 13:45:00'),
(47, 'Pantoprazole', 27, 65, '40mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '2026-01-20 14:55:00', '2026-01-20 14:55:00'),
(48, 'Phenytoin', 16, 68, '100mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '2026-01-21 15:05:00', '2026-01-21 15:05:00'),
(49, 'Prednisone', 23, 71, '10mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '2026-01-22 16:15:00', '2026-01-22 16:15:00'),
(50, 'Ranitidine', 19, 74, '150mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '2026-01-23 17:25:00', '2026-01-23 17:25:00'),
(51, 'Sertraline', 24, 77, '50mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-01-24 08:35:00', '2026-01-24 08:35:00'),
(52, 'Sildenafil', 35, 80, '25mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-01-25 09:45:00', '2026-01-25 09:45:00'),
(53, 'Tamsulosin', 12, 83, '0.4mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-01-26 10:55:00', '2026-01-26 10:55:00'),
(54, 'Tetracycline', 28, 86, '250mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '2026-01-27 11:05:00', '2026-01-27 11:05:00'),
(55, 'Tramadol', 4, 89, '50mg', 'Every 6 hours', '10', 'Oral', NULL, '', 40, 1, '2026-01-28 12:15:00', '2026-01-28 12:15:00'),
(56, 'Valacyclovir', 49, 92, '500mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '2026-01-29 08:25:00', '2026-01-29 08:25:00'),
(57, 'Venlafaxine', 6, 95, '75mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-01-30 09:35:00', '2026-01-30 09:35:00'),
(58, 'Verapamil', 18, 98, '80mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-01-31 10:45:00', '2026-01-31 10:45:00'),
(59, 'Warfarin', 25, 101, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-01 11:55:00', '2026-02-01 11:55:00'),
(60, 'Zolpidem', 42, 104, '10mg', 'Before sleep', '14', 'Oral', NULL, '', 14, 1, '2026-02-02 12:05:00', '2026-02-02 12:05:00'),
(61, 'Acyclovir', 8, 107, '400mg', 'Every 8 hours', '10', 'Oral', NULL, '', 30, 1, '2026-02-03 13:15:00', '2026-02-03 13:15:00'),
(62, 'Alprazolam', 16, 110, '0.5mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '2026-02-04 14:25:00', '2026-02-04 14:25:00'),
(63, 'Amlodipine', 30, 113, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-05 15:35:00', '2026-02-05 15:35:00'),
(64, 'Amoxicillin', 12, 116, '500mg', 'Every 8 hours', '7', 'Oral', NULL, '', 21, 1, '2026-02-06 16:45:00', '2026-02-06 16:45:00'),
(65, 'Atorvastatin', 4, 119, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-07 17:55:00', '2026-02-07 17:55:00'),
(66, 'Baclofen', 22, 5, '10mg', 'Every 8 hours', '14', 'Oral', NULL, '', 42, 1, '2026-02-08 08:05:00', '2026-02-08 08:05:00'),
(67, 'Benazepril', 41, 8, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-09 09:15:00', '2026-02-09 09:15:00'),
(68, 'Bupropion', 35, 11, '150mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-10 10:25:00', '2026-02-10 10:25:00'),
(69, 'Carbamazepine', 27, 14, '200mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '2026-02-11 11:35:00', '2026-02-11 11:35:00'),
(70, 'Cetirizine', 39, 17, '10mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '2026-02-12 12:45:00', '2026-02-12 12:45:00'),
(71, 'Ciprofloxacin', 10, 20, '500mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '2026-02-13 13:55:00', '2026-02-13 13:55:00'),
(72, 'Clonazepam', 5, 23, '0.5mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '2026-02-14 14:05:00', '2026-02-14 14:05:00'),
(73, 'Codeine', 31, 26, '30mg', 'Every 6 hours', '7', 'Oral', NULL, '', 28, 1, '2026-02-15 15:15:00', '2026-02-15 15:15:00'),
(74, 'Cyclobenzaprine', 9, 29, '10mg', 'Every 8 hours', '14', 'Oral', NULL, '', 42, 1, '2026-02-16 16:25:00', '2026-02-16 16:25:00'),
(75, 'Diclofenac', 23, 32, '50mg', 'Every 8 hours', '7', 'Oral', NULL, '', 21, 1, '2026-02-17 17:35:00', '2026-02-17 17:35:00'),
(76, 'Diphenhydramine', 1, 35, '25mg', 'Every 8 hours', '14', 'Oral', NULL, '', 42, 1, '2026-02-18 08:45:00', '2026-02-18 08:45:00'),
(77, 'Duloxetine', 15, 38, '60mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-19 09:55:00', '2026-02-19 09:55:00'),
(78, 'Enalapril', 18, 41, '10mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-20 10:05:00', '2026-02-20 10:05:00'),
(79, 'Escitalopram', 33, 44, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-21 11:15:00', '2026-02-21 11:15:00'),
(80, 'Esomeprazole', 26, 47, '40mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '2026-02-22 12:25:00', '2026-02-22 12:25:00'),
(81, 'Etodolac', 8, 50, '300mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '2026-02-23 13:35:00', '2026-02-23 13:35:00'),
(82, 'Ezetimibe', 21, 53, '10mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-24 14:45:00', '2026-02-24 14:45:00'),
(83, 'Famotidine', 14, 56, '40mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '2026-02-25 15:55:00', '2026-02-25 15:55:00'),
(84, 'Fentanyl', 37, 59, '25mcg/hr', 'Every 72 hours', '7', 'Patch', NULL, '', 4, 1, '2026-02-26 16:05:00', '2026-02-26 16:05:00'),
(85, 'Fluconazole', 12, 62, '200mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '2026-02-27 17:15:00', '2026-02-27 17:15:00'),
(86, 'Fluoxetine', 44, 65, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-28 08:20:00', '2026-02-28 08:20:00'),
(87, 'Furosemide', 27, 68, '40mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-02-28 09:30:00', '2026-02-28 09:30:00'),
(88, 'Gabapentin', 10, 71, '300mg', 'Every 8 hours', '30', 'Oral', NULL, '', 90, 1, '2026-02-28 10:40:00', '2026-02-28 10:40:00'),
(89, 'Glipizide', 3, 74, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-28 11:50:00', '2026-02-28 11:50:00'),
(90, 'Glyburide', 49, 77, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-28 13:00:00', '2026-02-28 13:00:00'),
(91, 'Hydrochlorothiazide', 22, 80, '25mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-28 14:10:00', '2026-02-28 14:10:00'),
(92, 'Hydrocodone', 18, 83, '10mg', 'Every 6 hours', '7', 'Oral', NULL, '', 28, 1, '2026-02-28 15:20:00', '2026-02-28 15:20:00'),
(93, 'Ibuprofen', 7, 86, '400mg', 'Every 8 hours', '14', 'Oral', NULL, '', 42, 1, '2026-02-28 16:30:00', '2026-02-28 16:30:00'),
(94, 'Insulin', 33, 89, '10 units', 'Before meals', '30', 'Injection', NULL, '', 90, 1, '2026-02-28 17:40:00', '2026-02-28 17:40:00'),
(95, 'Ipratropium', 41, 92, '2 inhalations', 'Every 6 hours', '14', 'Inhalation', NULL, '', 56, 1, '2026-02-28 18:50:00', '2026-02-28 18:50:00'),
(96, 'Labetalol', 15, 95, '100mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '2026-02-28 20:00:00', '2026-02-28 20:00:00'),
(97, 'Lisinopril', 29, 98, '10mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-28 21:10:00', '2026-02-28 21:10:00'),
(98, 'Lorazepam', 12, 101, '1mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-02-28 22:20:00', '2026-02-28 22:20:00'),
(99, 'Losartan', 4, 104, '50mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-02-28 23:30:00', '2026-02-28 23:30:00'),
(100, 'Meloxicam', 35, 107, '15mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Metformin', 38, 110, '500mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Methotrexate', 24, 113, '7.5mg', 'Once weekly', '4', 'Oral', NULL, '', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'Metoprolol', 6, 116, '50mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Montelukast', 20, 119, '10mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Naproxen', 43, 5, '500mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Nifedipine', 9, 8, '30mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Nitrofurantoin', 17, 11, '100mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Nitroglycerin', 28, 14, '0.4mg', 'Every 8 hours', '14', 'Sublingual', NULL, '', 42, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Olanzapine', 32, 17, '10mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Omeprazole', 11, 20, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Ondansetron', 14, 23, '8mg', 'Every 8 hours', '7', 'Oral', NULL, '', 21, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Oxycodone', 25, 26, '10mg', 'Every 6 hours', '7', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Pantoprazole', 19, 29, '40mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'Paroxetine', 37, 32, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Prednisone', 26, 35, '10mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Pregabalin', 13, 38, '150mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Propranolol', 21, 41, '40mg', 'Every 12 hours', '30', 'Oral', NULL, '', 60, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Quetiapine', 34, 44, '50mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Ranitidine', 40, 47, '150mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Risperidone', 7, 50, '2mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Rosuvastatin', 16, 53, '10mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Sertraline', 23, 56, '50mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Sildenafil', 30, 59, '50mg', 'Every 24 hours', '14', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Simvastatin', 9, 62, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Spironolactone', 41, 65, '25mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Sulfamethoxazole', 14, 68, '800mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Tamsulosin', 25, 71, '0.4mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Trazodone', 19, 74, '50mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Tramadol', 37, 77, '50mg', 'Every 6 hours', '14', 'Oral', NULL, '', 56, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Valacyclovir', 26, 80, '500mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Venlafaxine', 13, 83, '75mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Verapamil', 21, 86, '80mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Warfarin', 34, 89, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Zolpidem', 40, 92, '10mg', 'Before sleep', '14', 'Oral', NULL, '', 14, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Acyclovir', 7, 95, '400mg', 'Every 8 hours', '10', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Alprazolam', 3, 98, '0.5mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Amlodipine', 28, 101, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Amoxicillin', 12, 104, '500mg', 'Every 8 hours', '7', 'Oral', NULL, '', 21, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Atorvastatin', 22, 107, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Baclofen', 18, 110, '10mg', 'Every 8 hours', '14', 'Oral', NULL, '', 42, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Budesonide', 6, 113, '180mcg', 'Twice daily', '30', 'Inhalation', NULL, '', 60, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Ciprofloxacin', 44, 116, '500mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Clindamycin', 20, 119, '300mg', 'Every 8 hours', '10', 'Oral', NULL, '', 30, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Clonazepam', 33, 5, '0.5mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Codeine', 15, 8, '30mg', 'Every 6 hours', '7', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Dexamethasone', 9, 11, '4mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Diazepam', 27, 14, '5mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Diclofenac', 7, 17, '50mg', 'Every 8 hours', '14', 'Oral', NULL, '', 42, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Diphenhydramine', 41, 20, '25mg', 'Every 8 hours', '7', 'Oral', NULL, '', 21, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'Doxycycline', 12, 23, '100mg', 'Every 12 hours', '7', 'Oral', NULL, '', 14, 1, '2026-03-01 08:00:00', '2026-03-01 08:00:00'),
(151, 'Enalapril', 18, 26, '10mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-01 09:10:00', '2026-03-01 09:10:00'),
(152, 'Escitalopram', 3, 29, '10mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-01 10:20:00', '2026-03-01 10:20:00'),
(153, 'Esomeprazole', 28, 32, '40mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-01 11:30:00', '2026-03-01 11:30:00'),
(154, 'Etodolac', 12, 35, '300mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-03-01 12:40:00', '2026-03-01 12:40:00'),
(155, 'Exenatide', 25, 38, '5mcg', 'Twice daily', '30', 'Injection', NULL, '', 60, 1, '2026-03-01 13:50:00', '2026-03-01 13:50:00'),
(156, 'Famotidine', 19, 41, '20mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-03-01 15:00:00', '2026-03-01 15:00:00'),
(157, 'Fenofibrate', 37, 44, '145mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-01 16:10:00', '2026-03-01 16:10:00'),
(158, 'Fexofenadine', 26, 47, '180mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-01 17:20:00', '2026-03-01 17:20:00'),
(159, 'Finasteride', 13, 50, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-01 18:30:00', '2026-03-01 18:30:00'),
(160, 'Fluconazole', 21, 53, '150mg', 'Once daily', '7', 'Oral', NULL, '', 7, 1, '2026-03-01 19:40:00', '2026-03-01 19:40:00'),
(161, 'Fluoxetine', 34, 56, '20mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-01 20:50:00', '2026-03-01 20:50:00'),
(162, 'Furosemide', 40, 59, '40mg', 'Every 12 hours', '14', 'Oral', NULL, '', 28, 1, '2026-03-01 22:00:00', '2026-03-01 22:00:00'),
(163, 'Gabapentin', 7, 62, '300mg', 'Every 8 hours', '30', 'Oral', NULL, '', 90, 1, '2026-03-01 23:10:00', '2026-03-01 23:10:00'),
(164, 'Glipizide', 16, 65, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-02 08:20:00', '2026-03-02 08:20:00'),
(165, 'Glyburide', 23, 68, '5mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-02 09:30:00', '2026-03-02 09:30:00'),
(166, 'Hydrochlorothiazide', 30, 71, '25mg', 'Every 24 hours', '30', 'Oral', NULL, '', 30, 1, '2026-03-02 10:40:00', '2026-03-02 10:40:00'),
(167, 'Hydrocodone', 9, 74, '10mg', 'Every 6 hours', '7', 'Oral', NULL, '', 28, 1, '2026-03-02 11:50:00', '2026-03-02 11:50:00'),
(168, 'Ibuprofen', 44, 77, '400mg', 'Every 8 hours', '14', 'Oral', NULL, '', 42, 1, '2026-03-02 13:00:00', '2026-03-02 13:00:00'),
(169, 'Insulin', 18, 80, '10 units', 'Before meals', '30', 'Injection', NULL, '', 90, 1, '2026-03-02 14:10:00', '2026-03-02 14:10:00'),
(170, 'Ipratropium', 27, 83, '2 inhalations', 'Every 6 hours', '14', 'Inhalation', NULL, '', 56, 1, '2026-03-02 15:20:00', '2026-03-02 15:20:00'),
(171, 'Amlodipine', 52, 7, 'یک دانه در روز', 'قبل از غذا', NULL, 'خوراکی', NULL, '', 3, 1, '2025-12-12 01:49:57', NULL),
(173, 'Amlodipine', 54, 7, NULL, 'قبل از غذا', NULL, NULL, NULL, '', 3, 1, '2025-12-12 02:23:29', NULL),
(174, 'Amphotericin B', 54, 114, 'یک دانه در روز', NULL, NULL, NULL, NULL, '', 6, 1, '2025-12-12 02:23:44', NULL),
(175, 'Atenolol', 54, 45, NULL, 'قبل از غذا', NULL, NULL, NULL, '', 2, 1, '2025-12-12 02:24:10', NULL),
(176, 'Amiloride', 55, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:26:11', NULL),
(177, 'Alteplase', 56, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:30:53', NULL),
(178, 'Amlodipine', 57, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:33:54', NULL),
(179, 'Amiloride', 58, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:42:18', NULL),
(180, 'Alteplase', 59, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:47:29', NULL),
(181, 'Amphotericin B', 60, 114, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:50:46', NULL),
(182, 'Amoxicillin', 61, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:52:59', NULL),
(183, 'Alteplase', 62, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:55:49', NULL),
(184, 'Amiloride', 63, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:56:24', NULL),
(185, 'Amoxicillin', 64, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:58:10', NULL),
(186, 'Amoxicillin', 65, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 02:59:10', NULL),
(187, 'Amoxicillin', 66, 3, NULL, 'قبل از غذا', NULL, NULL, NULL, '', 5, 1, '2025-12-12 03:21:05', NULL),
(188, 'Atorvastatin', 66, 56, NULL, 'بعد از غذا', NULL, NULL, NULL, '', 1, 1, '2025-12-12 03:21:19', NULL),
(189, 'Amlodipine', 66, 7, NULL, NULL, NULL, NULL, NULL, '', 3, 1, '2025-12-12 03:21:55', NULL),
(190, 'Amlodipine', 67, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 14:12:15', NULL),
(191, 'Amoxicillin', 68, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 14:21:47', NULL),
(192, 'Amoxicillin', 69, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 14:23:43', NULL),
(193, 'Amiloride', 70, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 14:25:41', NULL),
(194, 'Amphotericin B', 71, 114, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 14:43:35', NULL),
(195, 'Alteplase', 71, 72, NULL, 'قبل از غذا', NULL, NULL, NULL, '', 1, 1, '2025-12-12 14:51:23', NULL),
(196, 'Atenolol', 71, 45, NULL, 'بعد از غذا', NULL, NULL, NULL, '', 4, 1, '2025-12-12 14:51:42', NULL),
(197, 'Amoxicillin', 72, 3, NULL, 'قبل از غذا', NULL, NULL, NULL, '', 1, 1, '2025-12-12 14:57:05', NULL),
(198, 'Apixaban', 73, 65, NULL, 'قبل از غذا', NULL, NULL, NULL, '', 5, 1, '2025-12-12 15:02:35', NULL),
(199, 'Amlodipine', 74, 7, 'یک دانه در روز', 'قبل از غذا', NULL, 'خوراکی', NULL, '', 1, 1, '2025-12-12 15:03:26', NULL),
(200, 'Amiloride', 75, 53, 'یک دانه در روز', 'قبل از غذا', NULL, NULL, NULL, '', 5, 1, '2025-12-12 16:26:20', NULL),
(201, 'Amphotericin B', 76, 114, NULL, 'قبل از غذا', NULL, NULL, NULL, '', 1, 1, '2025-12-12 16:29:12', NULL),
(202, 'Amphotericin B', 77, 114, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 16:31:17', NULL),
(203, 'Amiloride', 78, 53, NULL, 'قبل از غذا', NULL, NULL, NULL, '', 1, 1, '2025-12-12 16:32:07', NULL),
(204, 'Clarithromycin', 79, 13, NULL, 'قبل از غذا', NULL, NULL, NULL, '', 1, 1, '2025-12-12 16:33:18', NULL),
(205, 'Alteplase', 80, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-12 22:56:13', NULL),
(206, 'Amoxicillin', 80, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-13 20:44:16', NULL),
(207, 'Atenolol', 80, 45, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-13 20:44:26', NULL),
(208, 'Atorvastatin', 80, 18, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-13 20:44:33', NULL),
(209, 'Atenolol', 81, 45, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-13 20:44:59', NULL),
(210, 'Apixaban', 81, 65, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-13 20:51:37', NULL),
(211, 'Alteplase', 81, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-13 22:54:21', NULL),
(212, 'Amiloride', 82, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-13 22:55:32', NULL),
(213, 'Alteplase', 85, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 02:51:35', NULL),
(216, 'Amiloride', 87, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 03:23:49', NULL),
(217, 'Amphotericin B', 87, 114, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 03:23:58', NULL),
(218, 'Azithromycin', 87, 4, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 03:24:01', NULL),
(222, 'Amiloride', 89, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 03:48:06', NULL),
(223, 'Alteplase', 90, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 03:52:02', NULL),
(224, 'Apixaban', 90, 65, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 03:52:05', NULL),
(225, 'Atorvastatin', 90, 18, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 03:52:12', NULL),
(226, 'Amoxicillin', 91, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 03:53:55', NULL),
(227, 'Atorvastatin', 92, 56, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-14 03:54:49', NULL),
(229, 'Apixaban', 94, 65, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 03:24:23', NULL),
(231, 'Insulin Aspart', 97, 85, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 15:09:09', NULL),
(233, 'Amiloride', 101, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 16:24:46', NULL),
(234, 'Apixaban', 101, 65, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 16:24:48', NULL),
(235, 'Atenolol', 102, 45, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 18:55:34', NULL),
(236, 'Amphotericin B', 102, 114, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 18:55:42', NULL),
(237, 'Atorvastatin', 102, 18, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 18:55:44', NULL),
(238, 'Bisoprolol', 102, 46, NULL, NULL, NULL, NULL, NULL, 'این دارو خاص است', 1, 1, '2025-12-15 18:56:12', NULL),
(239, 'Amiloride', 103, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 18:59:31', NULL),
(240, 'Alteplase', 104, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 19:03:19', NULL),
(241, 'amofdsf d500 ml', 105, 122, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 19:30:03', NULL),
(242, 'Amiloride', 105, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 23:47:26', NULL),
(243, 'Alteplase', 106, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-15 23:51:09', NULL),
(244, 'Amiloride', 107, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 00:17:07', NULL),
(245, 'Amiloride', 108, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 00:17:35', NULL),
(246, 'Amiloride', 109, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 00:41:23', NULL),
(247, 'amofdsf d500 ml', 110, 122, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 00:48:11', NULL),
(248, 'Amiloride', 111, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 00:48:56', NULL),
(249, 'Amiloride', 112, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 00:51:52', NULL),
(250, 'Alteplase', 113, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 00:52:25', NULL),
(251, 'Amiloride', 114, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 00:55:20', NULL),
(252, 'Amiloride', 115, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 00:56:39', NULL),
(253, 'Glucose 10%', 116, 33, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 01:21:29', NULL),
(255, 'relief 250m', 119, 125, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 11:49:16', NULL),
(256, 'relief 500m', 119, 124, 'یک دانه در روز', 'بعد از غذا', NULL, 'خوراکی', NULL, '', 5, 1, '2025-12-16 11:49:44', NULL),
(257, 'amo sadlfjsadf asdf 250ml', 119, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 16:33:29', NULL),
(258, 'Amiloride', 120, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 16:36:23', NULL),
(259, 'Amphotericin B', 121, 114, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 16:38:09', NULL),
(260, 'Amiloride', 122, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 20:44:14', NULL),
(261, 'Amlodipine', 123, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 20:44:50', NULL),
(262, 'Amlodipine', 124, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 20:45:34', NULL),
(263, 'amo sadlfjsadf asdf 250ml', 125, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 21:24:34', NULL),
(264, 'amo sadlfjsadf asdf 250ml', 126, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 21:25:42', NULL),
(265, 'Amlodipine', 127, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 21:26:19', NULL),
(266, 'amo sadlfjsadf asdf 250ml', 128, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 22:38:25', NULL),
(267, 'Alteplase', 129, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 22:42:05', NULL),
(268, 'amo sadlfjsadf asdf 250ml', 130, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 22:46:15', NULL),
(269, 'Amiloride', 131, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 22:49:16', NULL),
(270, 'Amiloride', 132, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 22:51:25', NULL),
(271, 'Amiloride', 133, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 22:52:17', NULL),
(272, 'Alteplase', 134, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 23:01:54', NULL),
(273, 'Amiloride', 135, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 23:02:10', NULL),
(274, 'Alteplase', 136, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 23:46:49', NULL),
(275, 'Apixaban', 137, 65, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-16 23:47:06', NULL),
(276, 'amo sadlfjsadf asdf 250ml', 138, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:15:12', NULL),
(277, 'Amiloride', 139, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:22:00', NULL),
(278, 'Amiloride', 140, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:22:26', NULL),
(279, 'Amlodipine', 140, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:22:35', NULL),
(280, 'Amiloride', 141, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:27:16', NULL),
(281, 'Amiloride', 142, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:29:02', NULL),
(282, 'Amlodipine', 143, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:30:44', NULL),
(283, 'Amlodipine', 144, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:31:03', NULL),
(284, 'amo sadlfjsadf asdf 250ml', 145, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:33:31', NULL),
(285, 'amo sadlfjsadf asdf 250ml', 146, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:35:04', NULL),
(286, 'Amiloride', 147, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:41:28', NULL),
(287, 'Amlodipine', 148, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:42:02', NULL),
(288, 'amo sadlfjsadf asdf 250ml', 149, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:42:14', NULL),
(289, 'Amoxicillin', 150, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:42:44', NULL),
(290, 'Amiloride', 151, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 00:59:52', NULL),
(291, 'Amiloride', 152, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:01:09', NULL),
(294, 'Amiloride', 155, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:07:55', NULL),
(295, 'amofdsf d500 ml', 156, 122, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:08:14', NULL),
(296, 'Alteplase', 157, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:09:41', NULL),
(297, 'amo sadlfjsadf asdf 250ml', 158, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:13:24', NULL),
(298, 'amo sadlfjsadf asdf 250ml', 159, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:14:02', NULL),
(299, 'Amlodipine', 160, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:15:12', NULL),
(300, 'amo sadlfjsadf asdf 250ml', 161, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:18:28', NULL),
(301, 'Alteplase', 162, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:36:08', NULL),
(302, 'Amiloride', 163, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:37:18', NULL),
(303, 'Alteplase', 164, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:37:59', NULL),
(304, 'Amiloride', 165, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:38:19', NULL),
(305, 'amo sadlfjsadf asdf 250ml', 166, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:39:14', NULL),
(306, 'Amoxicillin', 167, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:39:52', NULL),
(307, 'Amphotericin B', 168, 114, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:40:35', NULL),
(308, 'Amiloride', 169, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:41:19', NULL),
(309, 'Alteplase', 170, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:42:03', NULL),
(310, 'Alteplase', 171, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:42:13', NULL),
(311, 'Amlodipine', 172, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 01:49:58', NULL),
(315, 'Amlodipine', 174, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 02:11:58', NULL),
(316, 'Alteplase', 174, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 02:12:06', NULL),
(317, 'Azithromycin', 174, 4, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 02:12:10', NULL),
(318, 'Atenolol', 174, 45, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-17 02:12:15', NULL),
(319, 'Alteplase', 175, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-21 19:24:32', NULL),
(320, 'Alteplase', 176, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:07:16', NULL),
(321, 'amo 500ml pk', 176, 128, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:08:06', NULL),
(322, 'amo 500ml ir', 177, 129, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:11:11', NULL),
(323, 'amo 500ml pk', 178, 128, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:11:32', NULL),
(324, 'Amlodipine', 179, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:12:11', NULL),
(325, 'amo 250ml pk', 180, 130, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:12:33', NULL),
(326, 'amo 250ml pk', 181, 130, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:15:33', NULL),
(327, 'Amiloride', 182, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:16:24', NULL),
(328, 'Amlodipine', 183, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:16:48', NULL),
(329, 'amo 250ml pk', 184, 130, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:17:09', NULL),
(330, 'Amlodipine', 185, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:20:47', NULL),
(331, 'Amlodipine', 186, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:21:57', NULL),
(332, 'Amiloride', 187, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:29:37', NULL),
(333, 'Amiloride', 188, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:30:39', NULL),
(334, 'Amiloride', 189, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 01:31:23', NULL),
(335, 'Amlodipine', 190, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 02:31:49', NULL),
(336, 'Alteplase', 191, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 02:42:21', NULL),
(337, 'Amlodipine', 192, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 02:44:31', NULL),
(338, 'Atorvastatin', 193, 56, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 02:56:40', NULL),
(339, 'Cromolyn Sodium', 193, 96, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 02:56:47', NULL),
(340, 'Ceftazidime', 193, 37, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 02:56:50', NULL),
(341, 'amo sadlfjsadf asdf 250ml', 193, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 02:56:54', NULL),
(347, 'Amoxicillin 500', 197, 131, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:22:18', NULL),
(348, 'Atorvastatin', 197, 56, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:22:27', NULL),
(349, 'Fluconazole', 197, 112, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:22:33', NULL),
(350, 'Ciprofloxacin', 197, 5, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:22:37', NULL),
(357, 'Amoxicillin 500', 200, 131, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:33:43', NULL),
(358, 'Fluconazole', 200, 112, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:34:01', NULL),
(359, 'Alteplase', 200, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:34:07', NULL),
(363, 'Amoxicillin 500', 202, 131, NULL, 'بعد از غذا', NULL, NULL, NULL, '', 5, 1, '2025-12-22 03:40:18', NULL),
(364, 'Budesonide', 202, 90, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:40:34', NULL),
(365, 'Dapagliflozin', 202, 79, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:40:42', NULL),
(366, 'Amiloride', 203, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:54:40', NULL),
(367, 'Amlodipine', 204, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 03:59:28', NULL),
(368, 'Amiloride', 205, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-22 04:00:00', NULL),
(369, 'Glucose 10%', 206, 33, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-23 02:55:10', NULL),
(370, 'Amlodipine', 207, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-24 17:24:33', NULL),
(371, 'amo 500ml ir', 208, 129, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-24 17:25:17', NULL),
(372, 'Glucose 10%', 209, 33, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 03:24:49', NULL),
(373, 'Glucose 10%', 210, 33, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 03:25:07', NULL),
(374, 'Alteplase', 211, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 05:16:22', NULL),
(375, 'amo 500ml ir', 212, 129, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 05:34:21', NULL),
(376, 'Glucose 10%', 213, 33, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 05:38:56', NULL),
(377, 'Amlodipine', 214, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 14:24:17', NULL),
(378, 'amo 500ml ir', 215, 129, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 14:39:34', NULL),
(379, 'Glucose 10%', 216, 33, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 14:50:19', NULL),
(380, 'Amlodipine', 217, 7, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 14:51:24', NULL),
(381, 'amo 500ml ir', 218, 129, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 14:56:22', NULL),
(382, 'amo 500ml ir', 219, 129, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 14:57:19', NULL),
(383, 'amo 250ml pk', 220, 130, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 16:37:01', NULL),
(384, 'amo sadlfjsadf asdf 250ml', 221, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 16:37:35', NULL),
(385, 'amo sadlfjsadf asdf 250ml', 222, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 16:41:04', NULL),
(386, 'amo sadlfjsadf asdf 250ml', 223, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 16:41:23', NULL),
(387, 'Amoxicillin', 223, 3, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 16:41:30', NULL),
(388, 'Glucose 10%', 224, 33, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-25 23:01:46', NULL),
(389, 'Amiloride', 225, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 13:27:30', NULL),
(391, 'Amiloride', 1, 53, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 15:14:50', NULL),
(392, 'Alteplase', 1, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 15:17:37', NULL),
(393, 'amo sadlfjsadf asdf 250ml', 1, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 15:18:06', NULL),
(394, 'Alteplase', 226, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 15:23:40', NULL),
(395, 'amo 500ml ir', 226, 129, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 15:24:21', NULL),
(396, 'amo sadlfjsadf asdf 250ml', 226, 123, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 15:24:25', NULL),
(397, 'Alteplase', 227, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 15:33:37', NULL),
(402, 'Hydralazine', 228, 55, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 16:20:32', NULL),
(404, 'Alteplase', 229, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 16:49:40', NULL),
(405, 'Alteplase', 230, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 17:23:00', NULL),
(406, 'Alteplase', 231, 72, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 17:30:25', NULL),
(410, 'amofdsf d500 ml', 232, 122, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-26 23:01:36', NULL),
(411, 'Ceftazidime', 232, 37, NULL, NULL, NULL, NULL, 'ایرانی', '', 1, 1, '2025-12-26 23:02:24', NULL),
(412, 'Alteplase', 232, 72, NULL, NULL, NULL, NULL, 'پاکستانی', '', 1, 1, '2025-12-26 23:05:05', NULL),
(413, 'Bisacodyl', 232, 107, NULL, NULL, NULL, NULL, 'هندی', '', 1, 1, '2025-12-26 23:05:23', NULL),
(415, 'Alteplase', 236, 72, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, '2025-12-27 01:10:04', NULL),
(416, 'Glucose 10%', 231, 33, NULL, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-27 01:54:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_settings`
--

DROP TABLE IF EXISTS `prescription_settings`;
CREATE TABLE IF NOT EXISTS `prescription_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `center_name` varchar(256) NOT NULL,
  `slogan` varchar(512) DEFAULT NULL,
  `phone1` varchar(15) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `phone3` varchar(15) DEFAULT NULL,
  `phone4` varchar(15) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `website` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `image` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `prescription_settings`
--

INSERT INTO `prescription_settings` (`id`, `branch_id`, `center_name`, `slogan`, `phone1`, `phone2`, `phone3`, `phone4`, `address`, `website`, `email`, `image`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 20, 'نام کلینیک شما', 'متن کوتاه برای شعار مرکز', '0795444444', '0700999999', '0799999999', '0799999999', 'آدرس معاینه خانه، کلینیک یا شفاخانه شما', 'www.demo.com', 'demo@info.com', '2025-12-25-16-38-19_694d29339a4cf.jpg', 1, 'کاظم حسینی', '2025-11-13 19:12:30', '2025-12-25 16:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `recommended`
--

DROP TABLE IF EXISTS `recommended`;
CREATE TABLE IF NOT EXISTS `recommended` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prescription_id` int NOT NULL,
  `recommended` varchar(1024) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recommended`
--

INSERT INTO `recommended` (`id`, `prescription_id`, `recommended`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(22, 94, '12', 1, '', '2025-12-15 03:29:03', NULL),
(23, 94, '15', 1, '', '2025-12-15 03:29:49', NULL),
(24, 101, '13', 1, '', '2025-12-15 16:24:22', NULL),
(25, 101, '15', 1, '', '2025-12-15 16:24:34', NULL),
(26, 104, '16', 1, '', '2025-12-15 19:02:48', NULL),
(27, 104, '17', 1, '', '2025-12-15 19:02:48', NULL),
(28, 104, '13', 1, '', '2025-12-15 19:02:48', NULL),
(29, 105, '16', 1, '', '2025-12-15 19:30:03', NULL),
(30, 105, '17', 1, '', '2025-12-15 19:30:03', NULL),
(31, 106, '16', 1, '', '2025-12-15 23:51:09', NULL),
(32, 107, '12', 1, '', '2025-12-16 00:17:12', NULL),
(33, 107, '16', 1, '', '2025-12-16 00:17:12', NULL),
(34, 108, '12', 1, '', '2025-12-16 00:17:38', NULL),
(35, 109, '16', 1, '', '2025-12-16 00:41:32', NULL),
(36, 109, '17', 1, '', '2025-12-16 00:41:32', NULL),
(37, 110, '16', 1, '', '2025-12-16 00:48:19', NULL),
(38, 110, '17', 1, '', '2025-12-16 00:48:19', NULL),
(39, 111, '16', 1, '', '2025-12-16 00:49:00', NULL),
(40, 112, '16', 1, '', '2025-12-16 00:52:02', NULL),
(41, 112, '17', 1, '', '2025-12-16 00:52:02', NULL),
(42, 112, '15', 1, '', '2025-12-16 00:52:02', NULL),
(43, 113, '16', 1, '', '2025-12-16 00:52:32', NULL),
(44, 113, '17', 1, '', '2025-12-16 00:52:32', NULL),
(45, 114, '16', 1, '', '2025-12-16 00:55:26', NULL),
(46, 115, '16', 1, '', '2025-12-16 00:56:44', NULL),
(47, 117, '16', 1, '', '2025-12-16 01:22:35', NULL),
(48, 161, '16', 1, '', '2025-12-17 01:18:32', NULL),
(49, 171, '16', 1, '', '2025-12-17 01:42:18', NULL),
(51, 192, '16', 1, '', '2025-12-22 02:45:29', NULL),
(52, 203, '16', 1, '', '2025-12-22 03:54:32', NULL),
(53, 203, '17', 1, '', '2025-12-22 03:54:32', NULL),
(54, 204, '19', 1, '', '2025-12-22 03:59:16', NULL),
(55, 204, '16', 1, '', '2025-12-22 03:59:16', NULL),
(56, 205, '16', 1, '', '2025-12-22 04:00:05', NULL),
(57, 208, '16', 1, '', '2025-12-24 17:25:29', NULL),
(58, 215, '16', 1, '', '2025-12-25 14:39:45', NULL),
(59, 223, '16', 1, '', '2025-12-25 16:41:34', NULL),
(60, 227, '16', 1, '', '2025-12-26 15:33:44', NULL),
(62, 227, '17', 1, '', '2025-12-26 15:40:57', NULL),
(63, 228, '16', 1, '', '2025-12-26 15:41:37', NULL),
(66, 232, '18', 1, '', '2025-12-26 23:06:17', NULL),
(67, 232, '16', 1, '', '2025-12-26 23:09:17', NULL),
(68, 232, '17', 1, '', '2025-12-26 23:09:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salary_months`
--

DROP TABLE IF EXISTS `salary_months`;
CREATE TABLE IF NOT EXISTS `salary_months` (
  `id` int NOT NULL AUTO_INCREMENT,
  `month_number` tinyint NOT NULL,
  `month_name` varchar(16) NOT NULL,
  `year` int NOT NULL,
  `is_current` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `salary_months`
--

INSERT INTO `salary_months` (`id`, `month_number`, `month_name`, `year`, `is_current`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'حمل', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(2, 2, 'ثور', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(3, 3, 'جوزا', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(4, 4, 'سرطان', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(5, 5, 'اسد', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(6, 6, 'سنبله', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(7, 7, 'میزان', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(8, 8, 'عقرب', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(9, 9, 'قوس', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(10, 10, 'جدی', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(11, 11, 'دلو', 1404, 0, 0, '2025-11-08 12:01:26', NULL),
(12, 12, 'حوت', 1404, 0, 0, '2025-11-08 12:01:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salary_transactions`
--

DROP TABLE IF EXISTS `salary_transactions`;
CREATE TABLE IF NOT EXISTS `salary_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `base_salary` decimal(10,2) NOT NULL,
  `period_id` int DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_type` tinyint NOT NULL DEFAULT '1' COMMENT '1->salary, 2->overtime, 3->kasri',
  `description` varchar(1024) DEFAULT NULL,
  `date` varchar(32) NOT NULL,
  `year` int NOT NULL,
  `month` tinyint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `salary_transactions`
--

INSERT INTO `salary_transactions` (`id`, `branch_id`, `employee_id`, `base_salary`, `period_id`, `amount`, `transaction_type`, `description`, `date`, `year`, `month`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(47, 20, 116, 1000.00, NULL, 200.00, 1, '', '1762972456', 1404, 7, 1, 'احمد رضا 1', '2025-11-12 23:04:19', NULL),
(48, 20, 116, 1000.00, NULL, 500.00, 1, '', '1763134902', 1404, 7, 1, 'احمد رضا 1', '2025-11-14 20:11:47', NULL),
(49, 20, 116, 1000.00, NULL, 100.00, 1, '', '1763134949', 1404, 7, 1, 'احمد رضا 1', '2025-11-14 20:12:34', NULL),
(50, 20, 116, 1000.00, NULL, 500.00, 1, '', '1763135002', 1404, 8, 1, 'احمد رضا 1', '2025-11-14 20:13:26', NULL),
(51, 20, 116, 2000.00, NULL, 200.00, 1, '', '1763135057', 1404, 8, 1, 'احمد رضا 1', '2025-11-14 20:14:21', NULL),
(52, 20, 116, 2000.00, NULL, 1300.00, 1, '', '1763135145', 1404, 8, 1, 'احمد رضا 1', '2025-11-14 20:15:50', NULL),
(53, 20, 116, 2000.00, NULL, 500.00, 1, '', '1763135164', 1404, 8, 1, 'احمد رضا 1', '2025-11-14 20:16:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(124) DEFAULT NULL,
  `en_name` varchar(30) DEFAULT NULL,
  `section_id` int DEFAULT NULL,
  `who_it` varchar(30) NOT NULL,
  `state` tinyint DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `en_name`, `section_id`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(1, 'داکتر', 'general', NULL, '', 1, NULL, NULL),
(2, NULL, 'prescriptionPrint', NULL, '', 1, NULL, NULL),
(3, NULL, 'parentPatients', NULL, '', 1, NULL, NULL),
(4, NULL, 'parentPrescription', NULL, '', 1, NULL, NULL),
(5, NULL, 'addPrescription', NULL, '', 1, NULL, NULL),
(6, NULL, 'showPrescription', NULL, '', 1, NULL, NULL),
(7, NULL, 'parentEmployee', NULL, '', 1, NULL, NULL),
(8, NULL, 'addEmployee', NULL, '', 1, NULL, NULL),
(9, NULL, 'showEmployees', NULL, '', 1, NULL, NULL),
(10, NULL, 'positions', NULL, '', 1, NULL, NULL),
(11, NULL, 'parentDrug', NULL, '', 1, NULL, NULL),
(12, NULL, 'addDrug', NULL, '', 1, NULL, NULL),
(13, NULL, 'showDrugs', NULL, '', 1, NULL, NULL),
(14, NULL, 'catDrug', NULL, '', 1, NULL, NULL),
(15, NULL, 'unitDrug', NULL, '', 1, NULL, NULL),
(16, NULL, 'parentNumberDrugs', NULL, '', 1, NULL, NULL),
(17, NULL, 'numberDrugs', NULL, '', 1, NULL, NULL),
(18, NULL, 'intakeTime', NULL, '', 1, NULL, NULL),
(19, NULL, 'dosage', NULL, '', 1, NULL, NULL),
(20, NULL, 'intakeInstructions', NULL, '', 1, NULL, NULL),
(21, NULL, 'prescriptionSettings', NULL, '', 1, NULL, NULL),
(22, NULL, 'profile', NULL, '', 1, NULL, NULL),
(23, NULL, 'dashboard', NULL, '', 1, NULL, NULL),
(24, NULL, 'showPatients', NULL, '', 1, NULL, NULL),
(25, NULL, 'addPatient', NULL, '', 1, NULL, NULL),
(26, NULL, 'parentSetting', NULL, '', 1, NULL, NULL),
(27, NULL, 'tests', NULL, '', 1, NULL, NULL),
(28, NULL, 'parentAdmission', NULL, '', 1, NULL, NULL),
(29, NULL, 'addAdmission', NULL, '', 1, NULL, NULL),
(30, NULL, 'showAdmissions', NULL, '', 1, NULL, NULL),
(31, NULL, 'parentDepartment', NULL, '', 1, NULL, NULL),
(32, NULL, 'departments', NULL, '', 1, NULL, NULL),
(34, NULL, 'companies', NULL, '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `single_print` tinyint NOT NULL DEFAULT '1',
  `admission` tinyint DEFAULT '1',
  `count_drug` tinyint NOT NULL DEFAULT '1',
  `intake_time` tinyint NOT NULL DEFAULT '1',
  `dosage` tinyint NOT NULL DEFAULT '1',
  `company` tinyint NOT NULL DEFAULT '1',
  `description` tinyint NOT NULL DEFAULT '1',
  `intake_instructions` tinyint NOT NULL DEFAULT '1',
  `tests` tinyint NOT NULL DEFAULT '1',
  `warehouse` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `branch_id`, `single_print`, `admission`, `count_drug`, `intake_time`, `dosage`, `company`, `description`, `intake_instructions`, `tests`, `warehouse`, `created_at`, `updated_at`) VALUES
(1, 20, 2, 1, 1, 1, 1, 1, 1, 1, 2, 2, '2025-04-01 13:30:36', '2025-12-27 01:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `test_name` varchar(512) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_name`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(16, 'ازمایش قند خون', 1, 'احمد هاشمی', '2025-12-15 19:02:05', NULL),
(17, 'ازمایش دیابت', 1, 'احمد هاشمی', '2025-12-15 19:02:09', NULL),
(18, 'ازمایش سوم', 1, 'کاظم حسینی', '2025-12-22 03:54:13', NULL),
(19, 'ازمایش چهارم', 1, 'کاظم حسینی', '2025-12-22 03:59:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(8, 'بسته', 1, 'کاظم حسینی', '2025-12-11 02:28:30', NULL),
(9, 'عدد', 1, 'کاظم حسینی', '2025-12-11 02:28:33', NULL),
(6, 'کارتن', 1, 'ali', '2025-12-07 12:36:46', NULL),
(7, 'باکس', 1, 'ali', '2025-12-07 12:36:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_code` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_name` varchar(64) NOT NULL,
  `password` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `father_name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(124) DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `birth_year` int DEFAULT NULL,
  `phone_relative` varchar(15) DEFAULT NULL,
  `blood_group` varchar(15) DEFAULT NULL,
  `chronic_diseases` varchar(1024) DEFAULT NULL,
  `allergies` varchar(1024) DEFAULT NULL,
  `past_surgeries` varchar(1024) DEFAULT NULL,
  `height` varchar(5) DEFAULT NULL,
  `weight` varchar(5) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `image` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_code`, `user_name`, `password`, `father_name`, `phone`, `email`, `gender`, `birth_year`, `phone_relative`, `blood_group`, `chronic_diseases`, `allergies`, `past_surgeries`, `height`, `weight`, `address`, `description`, `image`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'UC001', 'امیر', 'pass123', 'کاظمی', '07001230001', 'amir1@example.com', 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-01 08:15:00', '2024-05-01 08:15:00'),
(2, 'UC002', 'سارا', 'pass123', 'محمدی', '07001230002', 'sara1@example.com', 'خانم', 1368, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-02 09:20:00', '2024-05-02 09:20:00'),
(3, 'UC003', 'حسین', 'pass123', 'رحیمی', '07001230003', 'hossein1@example.com', 'آقا', 1365, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-03 10:25:00', '2024-05-03 10:25:00'),
(4, 'UC004', 'مریم', 'pass123', 'کریمی', '07001230004', 'maryam1@example.com', 'خانم', 1374, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-04 11:30:00', '2024-05-04 11:30:00'),
(5, 'UC005', 'علی', 'pass123', 'کاظمی', '07001230005', 'ali1@example.com', 'آقا', 1360, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-05 12:35:00', '2024-05-05 12:35:00'),
(6, 'UC006', 'نازنین', 'pass123', 'محمدی', '07001230006', 'nazanin1@example.com', 'خانم', 1367, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-06 13:40:00', '2024-05-06 13:40:00'),
(7, 'UC007', 'رضا', 'pass123', 'رحیمی', '07001230007', 'reza1@example.com', 'آقا', 1373, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-07 14:45:00', '2024-05-07 14:45:00'),
(8, 'UC008', 'فاطمه', 'pass123', 'کریمی', '07001230008', 'fatemeh1@example.com', 'خانم', 1362, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-08 15:50:00', '2024-05-08 15:50:00'),
(9, 'UC009', 'مهدی', 'pass123', 'کاظمی', '07001230009', 'mahdi1@example.com', 'آقا', 1369, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-09 16:55:00', '2024-05-09 16:55:00'),
(10, 'UC010', 'نرگس', 'pass123', 'محمدی', '07001230010', 'narges1@example.com', 'خانم', 1375, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-10 18:00:00', '2024-05-10 18:00:00'),
(11, 'UC011', 'کامران', 'pass123', 'رحیمی', '07001230011', 'kamran1@example.com', 'آقا', 1364, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-11 08:10:00', '2024-05-11 08:10:00'),
(12, 'UC012', 'زهرا', 'pass123', 'کریمی', '07001230012', 'zahra1@example.com', 'خانم', 1370, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-12 09:15:00', '2024-05-12 09:15:00'),
(13, 'UC013', 'امین', 'pass123', 'کاظمی', '07001230013', 'amin1@example.com', 'آقا', 1368, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-13 10:20:00', '2024-05-13 10:20:00'),
(14, 'UC014', 'مونا', 'pass123', 'محمدی', '07001230014', 'mona1@example.com', 'خانم', 1372, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-14 11:25:00', '2024-05-14 11:25:00'),
(15, 'UC015', 'سعید', 'pass123', 'رحیمی', '07001230015', 'saeed1@example.com', 'آقا', 1363, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-15 12:30:00', '2024-05-15 12:30:00'),
(16, 'UC016', 'راضیه', 'pass123', 'کریمی', '07001230016', 'raziyeh1@example.com', 'خانم', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-16 13:35:00', '2024-05-16 13:35:00'),
(17, 'UC017', 'وحید', 'pass123', 'کاظمی', '07001230017', 'vahid1@example.com', 'آقا', 1366, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-17 14:40:00', '2024-05-17 14:40:00'),
(18, 'UC018', 'مریم', 'pass123', 'محمدی', '07001230018', 'maryam2@example.com', 'خانم', 1369, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-18 15:45:00', '2024-05-18 15:45:00'),
(19, 'UC019', 'علی', 'pass123', 'رحیمی', '07001230019', 'ali2@example.com', 'آقا', 1361, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-19 16:50:00', '2024-05-19 16:50:00'),
(20, 'UC020', 'فاطمه', 'pass123', 'کریمی', '07001230020', 'fatemeh2@example.com', 'خانم', 1373, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-20 17:55:00', '2024-05-20 17:55:00'),
(21, 'UC021', 'مجید', 'pass123', 'کاظمی', '07001230021', 'majid@example.com', 'آقا', 1367, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-21 08:05:00', '2024-05-21 08:05:00'),
(22, 'UC022', 'ناهید', 'pass123', 'محمدی', '07001230022', 'nahid@example.com', 'خانم', 1365, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-22 09:10:00', '2024-05-22 09:10:00'),
(23, 'UC023', 'سعید', 'pass123', 'رحیمی', '07001230023', 'saeed@example.com', 'آقا', 1362, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-23 10:15:00', '2024-05-23 10:15:00'),
(24, 'UC024', 'الهام', 'pass123', 'کریمی', '07001230024', 'elham@example.com', 'خانم', 1370, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-24 11:20:00', '2024-05-24 11:20:00'),
(25, 'UC025', 'حسین', 'pass123', 'کاظمی', '07001230025', 'hossein@example.com', 'آقا', 1368, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-25 12:25:00', '2024-05-25 12:25:00'),
(26, 'UC026', 'نگار', 'pass123', 'محمدی', '07001230026', 'negar@example.com', 'خانم', 1372, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-26 13:30:00', '2024-05-26 13:30:00'),
(27, 'UC027', 'رضا', 'pass123', 'رحیمی', '07001230027', 'reza@example.com', 'آقا', 1360, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-27 14:35:00', '2024-05-27 14:35:00'),
(28, 'UC028', 'مژگان', 'pass123', 'کریمی', '07001230028', 'mozhgan@example.com', 'خانم', 1369, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-28 15:40:00', '2024-05-28 15:40:00'),
(29, 'UC029', 'مجتبی', 'pass123', 'کاظمی', '07001230029', 'mojtaba@example.com', 'آقا', 1373, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-29 16:45:00', '2024-05-29 16:45:00'),
(30, 'UC030', 'الهام', 'pass123', 'محمدی', '07001230030', 'elham2@example.com', 'خانم', 1363, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-30 17:50:00', '2024-05-30 17:50:00'),
(31, 'UC031', 'حسین', 'pass123', 'رحیمی', '07001230031', 'hossein2@example.com', 'آقا', 1366, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-05-31 08:00:00', '2024-05-31 08:00:00'),
(32, 'UC032', 'سمیرا', 'pass123', 'کریمی', '07001230032', 'samira@example.com', 'خانم', 1361, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-01 09:05:00', '2024-06-01 09:05:00'),
(33, 'UC033', 'علی', 'pass123', 'کاظمی', '07001230033', 'ali3@example.com', 'آقا', 1367, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-02 10:10:00', '2024-06-02 10:10:00'),
(34, 'UC034', 'مریم', 'pass123', 'محمدی', '07001230034', 'maryam3@example.com', 'خانم', 1365, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-03 11:15:00', '2024-06-03 11:15:00'),
(35, 'UC035', 'حمید', 'pass123', 'رحیمی', '07001230035', 'hamid@example.com', 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-04 12:20:00', '2024-06-04 12:20:00'),
(36, 'UC036', 'الهام', 'pass123', 'کریمی', '07001230036', 'elham3@example.com', 'خانم', 1368, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-05 13:25:00', '2024-06-05 13:25:00'),
(37, 'UC037', 'رضا', 'pass123', 'کاظمی', '07001230037', 'reza2@example.com', 'آقا', 1362, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-06 14:30:00', '2024-06-06 14:30:00'),
(38, 'UC038', 'سارا', 'pass123', 'محمدی', '07001230038', 'sara2@example.com', 'خانم', 1374, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-07 15:35:00', '2024-06-07 15:35:00'),
(39, 'UC039', 'حسین', 'pass123', 'رحیمی', '07001230039', 'hossein3@example.com', 'آقا', 1360, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-08 16:40:00', '2024-06-08 16:40:00'),
(40, 'UC040', 'مریم', 'pass123', 'کریمی', '07001230040', 'maryam4@example.com', 'خانم', 1363, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-09 17:45:00', '2024-06-09 17:45:00'),
(41, 'UC041', 'علی', 'pass123', 'کاظمی', '07001230041', 'ali4@example.com', 'آقا', 1369, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-10 08:50:00', '2024-06-10 08:50:00'),
(42, 'UC042', 'زهرا', 'pass123', 'محمدی', '07001230042', 'zahra2@example.com', 'خانم', 1370, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-11 09:55:00', '2024-06-11 09:55:00'),
(43, 'UC043', 'حسن', 'pass123', 'رحیمی', '07001230043', 'hasan@example.com', 'آقا', 1361, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-12 10:00:00', '2024-06-12 10:00:00'),
(44, 'UC044', 'نرگس', 'pass123', 'کریمی', '07001230044', 'narges2@example.com', 'خانم', 1364, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-13 11:05:00', '2024-06-13 11:05:00'),
(45, 'UC045', 'امید', 'pass123', 'کاظمی', '07001230045', 'omid@example.com', 'آقا', 1375, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-14 12:10:00', '2024-06-14 12:10:00'),
(46, 'UC046', 'سمیرا', 'pass123', 'محمدی', '07001230046', 'samira2@example.com', 'خانم', 1373, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-15 13:15:00', '2024-06-15 13:15:00'),
(47, 'UC047', 'رضا', 'pass123', 'رحیمی', '07001230047', 'reza3@example.com', 'آقا', 1365, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-16 14:20:00', '2024-06-16 14:20:00'),
(48, 'UC048', 'لیلا', 'pass123', 'کریمی', '07001230048', 'leila@example.com', 'خانم', 1360, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '2024-06-17 15:25:00', '2024-06-17 15:25:00'),
(145, NULL, 'احمد حسینی', NULL, '', '', NULL, 'آقا', 1381, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-22 03:41:17', NULL),
(146, NULL, 'محمد رضا احمدی', NULL, '', '', NULL, 'آقا', 1349, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-22 03:54:48', NULL),
(147, NULL, 'احمد حسینی', NULL, '', '', NULL, 'آقا', 1359, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-22 03:59:39', NULL),
(148, NULL, 'احمد حسینی', NULL, '', '', NULL, 'آقا', 1384, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-22 04:00:29', NULL),
(149, NULL, 'شش', NULL, '', '', NULL, 'آقا', 1401, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-23 02:55:14', NULL),
(150, NULL, 'احمد حسینی 22', NULL, '', '', NULL, 'آقا', 1360, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-24 17:25:36', NULL),
(151, NULL, 'sadfsdf', NULL, '', '', NULL, 'آقا', 1382, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 00:32:30', NULL),
(152, NULL, 'احمد حسینی', NULL, '', '', NULL, 'آقا', 1382, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 00:33:14', NULL),
(153, NULL, 'عمومی', NULL, '', '', NULL, 'آقا', 1399, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 00:33:26', NULL),
(154, NULL, 'sdfdsf', NULL, '', '', NULL, 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 00:55:05', NULL),
(155, NULL, 'ali jan rezaee', NULL, '', '', NULL, NULL, 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 1, 'کاظم حسینی', '2025-12-25 01:47:50', NULL),
(156, NULL, 'احمد حسینی بببب', NULL, '', '', NULL, 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 03:10:01', NULL),
(157, NULL, '111', NULL, '', '', NULL, 'آقا', 1382, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-25 03:24:55', NULL),
(158, NULL, 'احمد حسینی', NULL, '', '', NULL, 'آقا', 1402, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-25 03:25:12', NULL),
(159, NULL, 'ملا جان', NULL, '', '', NULL, 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 04:59:45', NULL),
(160, NULL, 'اصغر گوشنه', NULL, '', '', NULL, 'آقا', 1350, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 04:59:56', NULL),
(161, NULL, 'رضا غلامی', NULL, '', '', NULL, 'آقا', 1382, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 05:00:07', NULL),
(162, NULL, 'ممدانی', NULL, '', '', NULL, 'آقا', 1349, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 05:01:22', NULL),
(163, NULL, 'sdfdsfsd', NULL, '', '', NULL, 'آقا', 1182, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 05:02:53', NULL),
(164, NULL, 'قاسم جان', NULL, '', '', NULL, 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 05:03:58', NULL),
(165, NULL, 'رجب علی', NULL, '', '', NULL, 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 05:04:13', NULL),
(166, NULL, 'ضضضضضض', NULL, '', '', NULL, 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 05:10:49', NULL),
(167, NULL, 'رجب احمد', NULL, '', '', NULL, 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-25 14:51:34', NULL),
(168, NULL, 'صادق رضایی', NULL, '', '', NULL, 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-25 14:56:33', NULL),
(169, NULL, 'هاشمی', NULL, '', '', NULL, 'آقا', 1339, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 15:41:25', NULL),
(170, NULL, 'عباس', NULL, '', '', NULL, 'آقا', 1359, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 15:42:23', NULL),
(171, NULL, 'mamad', NULL, '', '', NULL, 'آقا', 1379, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-25 16:37:09', NULL),
(172, NULL, 'احمد حسینی', NULL, '', '', NULL, 'آقا', 1371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-25 16:37:38', NULL),
(173, NULL, 'علی احمدی', NULL, '', '', NULL, 'آقا', 1379, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 16:39:43', NULL),
(174, NULL, 'حسن فتحی', NULL, '', '', NULL, 'آقا', 1379, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 22:58:50', NULL),
(175, NULL, 'امیر حسنی', NULL, '', '', NULL, 'آقا', 1372, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 22:59:07', NULL),
(176, NULL, 'جعفر رجبی', NULL, '', '', NULL, 'آقا', 1359, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-25 22:59:23', NULL),
(178, NULL, 'sudn h', NULL, NULL, NULL, NULL, 'آقا', 1361, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'کاظم حسینی', '2025-12-26 13:27:03', '2025-12-27 01:51:27'),
(179, NULL, 'asi', NULL, '', '', NULL, 'آقا', 1390, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 'کاظم حسینی', '2025-12-26 16:20:18', NULL),
(180, NULL, 'اکبر اما', NULL, '', '', NULL, 'آقا', 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-26 16:22:25', NULL),
(181, NULL, 'asi', NULL, '', '', NULL, 'آقا', 1385, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-26 16:50:38', NULL),
(182, NULL, 'asi', NULL, '', '', NULL, 'آقا', 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-26 16:54:35', NULL),
(184, NULL, 'غلام رضا احمدی', NULL, NULL, NULL, NULL, 'آقا', 1379, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-26 17:23:33', '2025-12-26 21:13:51'),
(185, NULL, 'fffffff', NULL, NULL, NULL, NULL, 'آقا', 1364, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'herat', 'desc', NULL, 1, 'کاظم حسینی', '2025-12-26 17:29:52', '2025-12-27 01:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_agent`
--

DROP TABLE IF EXISTS `user_agent`;
CREATE TABLE IF NOT EXISTS `user_agent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(124) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `user_ip` varchar(30) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `isp` varchar(128) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `region` varchar(20) DEFAULT NULL,
  `org` varchar(100) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  `browser` varchar(20) DEFAULT NULL,
  `device` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `user_licenses`
--

DROP TABLE IF EXISTS `user_licenses`;
CREATE TABLE IF NOT EXISTS `user_licenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `license_key` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_licenses`
--

INSERT INTO `user_licenses` (`id`, `user_id`, `branch_id`, `license_key`, `start_date`, `end_date`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 48, 48, 'sadfa3243edfdsfd', '2025-09-04', '2026-09-17', 1, NULL, '2025-09-17 12:37:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

DROP TABLE IF EXISTS `visits`;
CREATE TABLE IF NOT EXISTS `visits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `visit_date` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `symptoms` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'alaem',
  `diagnosis` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'tashkhis',
  `note` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doctor_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

DROP TABLE IF EXISTS `years`;
CREATE TABLE IF NOT EXISTS `years` (
  `id` int NOT NULL AUTO_INCREMENT,
  `year` smallint DEFAULT NULL,
  `calendar_type` varchar(11) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 -> active, 2 -> deactive',
  `activation_code` varchar(32) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `year` (`year`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `year`, `calendar_type`, `status`, `activation_code`, `created_at`, `updated_at`) VALUES
(1, 1404, 'jalali', 1, NULL, '2025-02-25 17:47:21', '2025-09-16 23:41:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
