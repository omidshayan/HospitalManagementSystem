-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2025 at 01:02 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

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
(17, 'Invalid or missing CSRF token.', '::1', '2025-12-10 17:11:35', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosage`
--

INSERT INTO `dosage` (`id`, `dosage`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'tt', 1, 'ali', '2025-12-09 16:18:56', '2025-12-09 17:42:38'),
(2, 'ff', 1, 'ali', '2025-12-09 16:19:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

DROP TABLE IF EXISTS `drugs`;
CREATE TABLE IF NOT EXISTS `drugs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `generic_name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_id` int NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `generic_name`, `category_id`, `strength`, `unit`, `manufacturer`, `description`, `price`, `image`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'پا درد', NULL, 1, NULL, '2', NULL, NULL, NULL, NULL, 1, 'ali', '2025-12-03 09:28:16', '2025-12-08 00:27:53'),
(2, 'سر درد', '3343', 3, NULL, '2', 'af', 'dddd', NULL, NULL, 1, 'ali', '2025-12-07 23:45:24', '2025-12-08 00:44:08'),
(3, 'شکم درد', 'aaa', 4, NULL, '5', NULL, NULL, NULL, '2025-12-08-00-30-36_6935dce4cda80.jpg', 2, 'ali', '2025-12-08 00:12:38', '2025-12-08 00:44:13'),
(4, 'Anti-inflammatory, pain relief', '', 3, NULL, '6', '', '', NULL, NULL, 1, 'ali', '2025-12-09 00:41:15', NULL),
(5, 'Pain relief, fever reducer', '', 3, NULL, '4', '', '', NULL, NULL, 1, 'ali', '2025-12-09 00:41:28', NULL),
(6, 'Blood sugar control', '', 3, NULL, '5', '', '', NULL, NULL, 1, 'ali', '2025-12-09 00:41:38', NULL),
(7, 'Blood pressure control', '', 3, NULL, '5', '', '', NULL, NULL, 1, 'ali', '2025-12-09 00:41:49', NULL),
(8, 'Sedative, anti-anxiety', '', 3, NULL, '4', '', '', NULL, NULL, 1, 'ali', '2025-12-09 00:42:03', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drug_categories`
--

INSERT INTO `drug_categories` (`id`, `cat_name`, `description`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'for test', '', 1, 'ali', '2025-12-03 01:23:35', '2025-12-07 12:36:27'),
(2, 'for two ', NULL, 2, 'ali', '2025-12-03 01:24:05', '2025-12-03 01:39:46'),
(3, 'تابلت', '', 1, 'ali', '2025-12-07 12:35:59', NULL),
(4, 'سیرم', '', 1, 'ali', '2025-12-07 12:36:04', NULL),
(5, 'کپسول', NULL, 1, 'ali', '2025-12-07 12:36:10', '2025-12-09 20:00:08');

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
  `verify_token` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forgot_token` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `forgot_token_expire` datetime DEFAULT NULL,
  `remember_token` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `expire_remember_token` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `expertise` varchar(1024) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `branch_id`, `employee_name`, `father_name`, `phone`, `password`, `email`, `address`, `position`, `role`, `verify_token`, `forgot_token`, `forgot_token_expire`, `remember_token`, `expire_remember_token`, `expertise`, `image`, `description`, `salary_price`, `who_it`, `state`, `super_admin`, `notif`, `created_at`, `updated_at`) VALUES
(48, 100, 'ali', NULL, '11', '$2y$10$iuxczaYiD3vNG1eNsBV2au/XRgxZDOujEHZAYL1Tz4m6HBjJ6QNau', 'ali.afg@gmail.com', NULL, '', 2, NULL, '1daa771ddafb5d1cdc6968fa34a02a4de8c28ed632288dfd33d403619c458ea9', '2025-03-01 13:47:53', '8a6484e849e4ed01f0bf304f2774e9e1bdd87be09c3426aa6dbd187d1583ea3a', '3', 'متخصص گوش حلق بینی', '2024-09-01-23-53-55_66d4bf4bc0f96.jpg', NULL, 2000, '1', 1, 3, 2, '2024-09-01 23:53:55', '2025-12-09 03:18:37'),
(143, 0, 'احمد رضا', NULL, '22', '', 'afghanfaizi@info.com', '', 'داکتر', 1, NULL, NULL, NULL, NULL, NULL, 'lalllllli', '2025-12-10-00-38-45_693881cdc2d5c.jpg', NULL, NULL, 'ali', 1, NULL, 1, '2025-12-10 00:38:45', '2025-12-10 02:16:09'),
(144, 0, 'safsdfsdf', NULL, '324324324324', '$2y$10$y3mW2tI56Wbm5HAZWnAvhOAeMSAOJxePc6ockAASf8PEzRDs/Kf9O', '', '', 'داکتر', 1, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, 'ali', 1, NULL, 1, '2025-12-10 01:21:01', NULL),
(145, 0, 'محمد محمدی', NULL, '33', '$2y$10$NpCPqSVD5bG.tj9SVqADYea9mh2.hyX2pzfWKunKqWuoe8/AfLH7W', 'afghanfaizi@info.com', 'ادرس محمد', 'داکتر', 1, NULL, NULL, NULL, NULL, NULL, 'متخصص داروهای بیماری', '2025-12-10-02-15-57_693898953e53d.png', 'توضیحات محمد', NULL, 'ali', 1, NULL, 1, '2025-12-10 02:15:57', '2025-12-10 17:25:46'),
(146, 0, 'omid', NULL, '55', '$2y$10$1.9peA/BKo6MeR0V/qDi1OQ1PztlVACidRmUuLYlLE19PD5H1Y0wm', '', '', 'داکتر', 1, NULL, NULL, NULL, 'cf65c730910b8aee14e450074770a5016fe3af6ebd57db12f3524457cb9cb01e', '1', '', '2025-12-10-17-25-37_69396dc920cb9.jpg', '', NULL, 'ali', 1, NULL, 1, '2025-12-10 17:25:37', '2025-12-10 17:25:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intake_instructions`
--

INSERT INTO `intake_instructions` (`id`, `intake_instructions`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'ss', 2, 'ali', '2025-12-09 17:31:43', '2025-12-09 17:43:13'),
(2, 'ad', 1, 'ali', '2025-12-09 17:43:53', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intake_times`
--

INSERT INTO `intake_times` (`id`, `intake_time`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'aa', 1, 'ali', '2025-12-09 14:59:05', '2025-12-09 17:15:19'),
(2, 'بب', 2, 'ali', '2025-12-09 14:59:47', '2025-12-09 16:22:36'),
(3, 'قبل از عذا', 1, 'ali', '2025-12-09 15:00:07', NULL),
(4, 'بعد از شما', 1, 'ali', '2025-12-09 15:00:09', NULL),
(5, 'قبل از شام', 1, 'ali', '2025-12-09 15:00:12', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `not_access_logs`
--

INSERT INTO `not_access_logs` (`id`, `user_id`, `section_name`, `page_address`, `ip_address`, `user_agent`, `status`, `created_at`, `updated_at`) VALUES
(22, 122, 'general', '/HospitalManagementSystem/patients', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 1, '2025-12-07 13:37:26', NULL),
(23, 122, 'general', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 1, '2025-12-07 13:41:04', NULL),
(24, 122, 'general', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 1, '2025-12-07 13:42:05', NULL),
(25, 123, 'general', '/HospitalManagementSystem/', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 1, '2025-12-08 15:36:28', NULL),
(26, 123, 'general', '/HospitalManagementSystem/', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 1, '2025-12-08 15:37:52', NULL),
(27, 48, 'general', '/HospitalManagementSystem/employees', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-08 15:37:54', NULL),
(28, 48, 'general', '/HospitalManagementSystem/employees', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-08 15:38:34', NULL),
(29, 48, 'students', '/HospitalManagementSystem/manage-years', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-08 16:14:13', NULL),
(30, 130, 'general', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 1, '2025-12-09 19:44:29', NULL),
(31, 130, 'general', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 1, '2025-12-09 19:44:46', NULL),
(32, 130, 'general', '/HospitalManagementSystem/prescription-print', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 1, '2025-12-09 19:44:47', NULL),
(33, 130, 'general', '/HospitalManagementSystem/prescription-print', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 1, '2025-12-09 19:44:49', NULL),
(34, 130, 'general', '/HospitalManagementSystem/profile', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 1, '2025-12-09 19:44:50', NULL),
(35, 48, 'prescriptionPrint', '/HospitalManagementSystem/prescription-print', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-09 19:54:21', NULL),
(36, 48, 'showPatients', '/HospitalManagementSystem/patients', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-09 20:13:50', NULL),
(37, 48, 'showPatients', '/HospitalManagementSystem/patients', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-09 20:13:52', NULL),
(38, 48, 'showPatients', '/HospitalManagementSystem/patients', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-09 20:14:01', NULL),
(39, 48, 'showPatients', '/HospitalManagementSystem/patients', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-09 20:14:30', NULL),
(40, 48, 'showPatients', '/HospitalManagementSystem/patients', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-09 20:14:33', NULL),
(41, 48, 'patients', '/HospitalManagementSystem/patients', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-09 20:16:01', NULL),
(42, 48, 'patients', '/HospitalManagementSystem/patients', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-09 20:16:03', NULL),
(43, 48, 'patients', '/HospitalManagementSystem/patients', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 1, '2025-12-09 20:16:05', NULL),
(44, 141, 'dashboard', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-09 23:55:35', NULL),
(45, 141, 'dashboard', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-09 23:55:42', NULL),
(46, 141, 'dashboard', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-09 23:55:43', NULL),
(47, 142, 'general', '/HospitalManagementSystem/add-employee', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 00:00:54', NULL),
(48, 142, 'general', '/HospitalManagementSystem/add-employee', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 00:00:56', NULL),
(49, 142, 'general', '/HospitalManagementSystem/employees', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 00:00:59', NULL),
(50, 142, 'general', '/HospitalManagementSystem/profile', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 00:01:15', NULL),
(51, 142, 'general', '/HospitalManagementSystem/profile', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 00:02:23', NULL),
(52, 142, 'general', '/HospitalManagementSystem/search-product-purchase', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 00:36:07', NULL),
(53, 143, 'dashboard', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 01:41:56', NULL),
(54, 143, 'dashboard', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 01:42:01', NULL),
(55, 143, 'general', '/HospitalManagementSystem/profile', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 01:42:26', NULL),
(56, 143, 'prescriptionPrint', '/HospitalManagementSystem/prescription-print', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 02:00:44', NULL),
(57, 143, 'dashboard', '/HospitalManagementSystem/', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 02:00:46', NULL),
(58, 143, 'general', '/HospitalManagementSystem/profile', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 02:00:52', NULL),
(59, 143, 'addPrescription', '/HospitalManagementSystem/add-prescription', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 02:08:34', NULL),
(60, 143, 'showDrugs', '/HospitalManagementSystem/drugs', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 02:10:40', NULL),
(61, 143, 'showDrugs', '/HospitalManagementSystem/drugs', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 02:11:00', NULL),
(62, 143, 'showDrugs', '/HospitalManagementSystem/drugs', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 02:11:20', NULL),
(63, 143, 'addEmployee', '/HospitalManagementSystem/add-employee', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 02:11:44', NULL),
(64, 145, 'showEmployees', '/HospitalManagementSystem/employees', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 12:37:23', NULL),
(65, 145, 'showEmployees', '/HospitalManagementSystem/employees', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 12:38:38', NULL),
(66, 145, 'addEmployee', '/HospitalManagementSystem/add-employee', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 1, '2025-12-10 17:25:44', NULL);

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
(1, 10, 1, '', '2025-12-09 09:50:25', '2025-12-09 14:44:12');

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
) ENGINE=InnoDB AUTO_INCREMENT=640 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `section_name`, `employee_id`, `created_at`, `updated_at`) VALUES
(271, 'general', 116, NULL, NULL),
(380, 'prescriptionPrint', 142, '2025-12-10 00:00:41', NULL),
(381, 'parentPatients', 142, '2025-12-10 00:00:41', NULL),
(382, 'showPatients', 142, '2025-12-10 00:00:41', NULL),
(383, 'parentPrescription', 142, '2025-12-10 00:00:41', NULL),
(384, 'addPrescription', 142, '2025-12-10 00:00:41', NULL),
(385, 'showPrescription', 142, '2025-12-10 00:00:41', NULL),
(386, 'parentEmployee', 142, '2025-12-10 00:00:41', NULL),
(387, 'addEmployee', 142, '2025-12-10 00:00:41', NULL),
(388, 'showEmployees', 142, '2025-12-10 00:00:41', NULL),
(389, 'dashboard', 142, '2025-12-10 00:00:41', NULL),
(390, 'profile', 142, '2025-12-10 00:00:41', NULL),
(397, 'dashboard', 144, '2025-12-10 01:21:01', NULL),
(398, 'profile', 144, '2025-12-10 01:21:01', NULL),
(399, 'general', 144, '2025-12-10 01:21:01', NULL),
(400, 'prescriptionPrint', 144, '2025-12-10 01:28:09', NULL),
(549, 'addDrug', 143, '2025-12-10 12:38:33', NULL),
(550, 'parentDrug', 143, '2025-12-10 12:38:33', NULL),
(551, 'addPatient', 143, '2025-12-10 12:38:33', NULL),
(552, 'parentPatients', 143, '2025-12-10 12:38:33', NULL),
(553, 'prescriptionPrint', 143, '2025-12-10 12:38:33', NULL),
(554, 'dashboard', 143, '2025-12-10 12:38:33', NULL),
(555, 'profile', 143, '2025-12-10 12:38:33', NULL),
(556, 'general', 143, '2025-12-10 12:38:33', NULL),
(605, 'addPrescription', 145, '2025-12-10 16:11:11', NULL),
(606, 'parentPrescription', 145, '2025-12-10 16:11:11', NULL),
(607, 'addDrug', 145, '2025-12-10 16:11:11', NULL),
(608, 'parentDrug', 145, '2025-12-10 16:11:11', NULL),
(609, 'numberDrugs', 145, '2025-12-10 16:11:11', NULL),
(610, 'parentSetting', 145, '2025-12-10 16:11:11', NULL),
(611, 'prescriptionPrint', 145, '2025-12-10 16:11:11', NULL),
(612, 'dashboard', 145, '2025-12-10 16:11:11', NULL),
(613, 'profile', 145, '2025-12-10 16:11:11', NULL),
(614, 'general', 145, '2025-12-10 16:11:11', NULL),
(615, 'prescriptionPrint', 146, '2025-12-10 17:25:37', NULL),
(616, 'parentPatients', 146, '2025-12-10 17:25:37', NULL),
(617, 'showPatients', 146, '2025-12-10 17:25:37', NULL),
(618, 'addPatient', 146, '2025-12-10 17:25:37', NULL),
(619, 'parentPrescription', 146, '2025-12-10 17:25:37', NULL),
(620, 'addPrescription', 146, '2025-12-10 17:25:37', NULL),
(621, 'showPrescription', 146, '2025-12-10 17:25:37', NULL),
(622, 'parentEmployee', 146, '2025-12-10 17:25:37', NULL),
(623, 'addEmployee', 146, '2025-12-10 17:25:37', NULL),
(624, 'showEmployees', 146, '2025-12-10 17:25:37', NULL),
(625, 'positions', 146, '2025-12-10 17:25:37', NULL),
(626, 'parentDrug', 146, '2025-12-10 17:25:37', NULL),
(627, 'addDrug', 146, '2025-12-10 17:25:37', NULL),
(628, 'showDrugs', 146, '2025-12-10 17:25:37', NULL),
(629, 'catDrug', 146, '2025-12-10 17:25:37', NULL),
(630, 'unitDrug', 146, '2025-12-10 17:25:37', NULL),
(631, 'parentSetting', 146, '2025-12-10 17:25:37', NULL),
(632, 'numberDrugs', 146, '2025-12-10 17:25:37', NULL),
(633, 'intakeTime', 146, '2025-12-10 17:25:37', NULL),
(634, 'dosage', 146, '2025-12-10 17:25:37', NULL),
(635, 'intakeInstructions', 146, '2025-12-10 17:25:37', NULL),
(636, 'settingPrescription', 146, '2025-12-10 17:25:37', NULL),
(637, 'dashboard', 146, '2025-12-10 17:25:37', NULL),
(638, 'profile', 146, '2025-12-10 17:25:37', NULL),
(639, 'general', 146, '2025-12-10 17:25:37', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `branch_id`, `name`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(1, 0, 'داکتر', 'ali', 1, '2025-12-08 15:31:51', NULL),
(2, 0, 'کارمند', 'ali', 1, '2025-12-08 15:32:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE IF NOT EXISTS `prescriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int DEFAULT NULL,
  `visit_id` int NOT NULL,
  `patient_name` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `birth_year` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bp` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pr` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rr` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `temp` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `spo2` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `year` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `month` tinyint NOT NULL,
  `type` tinyint NOT NULL DEFAULT '1' COMMENT '1->simble-visit',
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `visit_id`, `patient_name`, `doctor_id`, `birth_year`, `bp`, `pr`, `rr`, `temp`, `spo2`, `year`, `month`, `type`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(52, 31, 0, 'gholam reza', 48, '1374', NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, 2, 'ali', '2025-12-10 17:09:49', '2025-12-10 17:10:16'),
(53, 31, 0, 'gholam reza', 48, '1374', NULL, NULL, NULL, NULL, NULL, '1404', 9, 1, 2, 'ali', '2025-12-10 17:11:39', '2025-12-10 17:11:47');

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
  `description` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `drug_count` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_items`
--

INSERT INTO `prescription_items` (`id`, `drug_name`, `prescription_id`, `drug_id`, `dosage`, `interval_time`, `duration_days`, `usage_instruction`, `description`, `drug_count`, `status`, `created_at`, `updated_at`) VALUES
(73, 'Anti-inflammatory, pain relief', 51, 4, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-10 17:01:18', NULL),
(74, 'Pain relief, fever reducer', 51, 5, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-10 17:05:42', NULL),
(75, 'Anti-inflammatory, pain relief', 52, 4, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-10 17:09:49', NULL),
(76, 'Pain relief, fever reducer', 53, 5, NULL, NULL, NULL, NULL, '', 1, 1, '2025-12-10 17:11:39', NULL);

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
(1, 20, 'شرکت رنگسازی افغان فیضی f', 'رشد صنعت اقدار ملت', '07999999', '07999999', NULL, NULL, 'افغانستان-هرات، جاده بانک خون، رو به روی اتاق های تجارت\r\n', 'www.afghanfaizi.com', 'afghanfaizi@info.com', '2025-12-06-13-07-18_6933eb3eba5df.jpg', 1, 'ali', '2025-11-13 19:12:30', '2025-12-06 13:39:19');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

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
(26, NULL, 'parentSetting', NULL, '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `sell_any_situation` tinyint NOT NULL DEFAULT '1' COMMENT '1 -> permission to sell any situation, 2 -> not permission',
  `buy_any_situation` tinyint NOT NULL DEFAULT '1' COMMENT '1 -> permission to buy any situation, 2 -> not permission',
  `expiration_date` tinyint DEFAULT '1',
  `warehouse` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `branch_id`, `sell_any_situation`, `buy_any_situation`, `expiration_date`, `warehouse`, `created_at`, `updated_at`) VALUES
(1, 20, 1, 1, 2, 2, '2025-04-01 13:30:36', '2025-11-04 02:13:45');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'ss aaa', 1, 'ali', '2025-12-03 02:36:15', '2025-12-03 02:46:54'),
(2, 'two', 1, 'ali', '2025-12-03 02:47:06', NULL),
(3, 'tree', 1, 'ali', '2025-12-03 02:47:10', NULL),
(4, 'عدد', 1, 'ali', '2025-12-07 12:36:38', NULL),
(5, 'کیلو', 1, 'ali', '2025-12-07 12:36:41', NULL),
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_code`, `user_name`, `password`, `father_name`, `phone`, `email`, `gender`, `birth_year`, `phone_relative`, `blood_group`, `chronic_diseases`, `allergies`, `past_surgeries`, `height`, `weight`, `address`, `description`, `image`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, '1', 'عمومی', NULL, '', '1', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 1, 'محمد رضا', '2025-11-04 11:39:44', NULL),
(31, NULL, 'gholam reza', NULL, '', '', NULL, 'آقا', 1374, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-10 17:10:16', NULL);

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
