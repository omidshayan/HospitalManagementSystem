-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 04, 2025 at 07:27 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `csrf_token_logs`
--

INSERT INTO `csrf_token_logs` (`id`, `message`, `ip_address`, `created_at`, `updated_at`) VALUES
(6, 'Invalid or missing CSRF token.', '::1', '2025-12-02 23:09:44', NULL),
(7, 'Invalid or missing CSRF token.', '::1', '2025-12-02 23:09:49', NULL),
(8, 'Invalid or missing CSRF token.', '::1', '2025-12-03 15:32:18', NULL),
(9, 'Invalid or missing CSRF token.', '::1', '2025-12-04 23:46:27', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `generic_name`, `category_id`, `strength`, `unit`, `manufacturer`, `description`, `price`, `image`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'for test', NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2025-12-03 09:28:16', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drug_categories`
--

INSERT INTO `drug_categories` (`id`, `cat_name`, `description`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'for test', '', 1, 'ali', '2025-12-03 01:23:35', NULL),
(2, 'for two ', NULL, 2, 'ali', '2025-12-03 01:24:05', '2025-12-03 01:39:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `branch_id`, `employee_name`, `father_name`, `phone`, `password`, `email`, `address`, `position`, `role`, `verify_token`, `forgot_token`, `forgot_token_expire`, `remember_token`, `expire_remember_token`, `image`, `description`, `salary_price`, `who_it`, `state`, `super_admin`, `notif`, `created_at`, `updated_at`) VALUES
(48, 100, 'ali', NULL, '11', '$2y$10$EfLQ0PKX4GeGGXnbfeNCdeao/DXcMSDb2Cm99gbyrLmuovnifQfki', 'ali.afg@gmail.com', NULL, '', 2, NULL, '1daa771ddafb5d1cdc6968fa34a02a4de8c28ed632288dfd33d403619c458ea9', '2025-03-01 13:47:53', '7c396f01862af3f8a02425df48586b23d095bf513a5daf59d2a7d15ae0c54d9a', '3', '2024-09-01-23-53-55_66d4bf4bc0f96.jpg', NULL, 2000, '1', 1, 3, 2, '2024-09-01 23:53:55', '2025-12-02 22:53:42'),
(116, 20, 'احمد رضا 1', NULL, '22', '$2y$10$lvfOlBw5pMhnzGxLTMpdhOJAUdnpvXTj2xh.AW6/5AXndWqHA2fvu', NULL, '', '1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, 'احمد رضا 1', 1, NULL, 2, '2025-11-10 21:59:19', '2025-12-02 22:52:38'),
(117, 0, '1112', NULL, '212121', '$2y$10$eT2k1.wU0Y7BcqTBor.PVOHXAo7fNwqDLj/0F3Fs8EQo748qqiSgO', NULL, NULL, 'sdf', 1, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 'ali', 1, NULL, 1, '2025-12-02 23:49:30', NULL),
(118, 0, 'ffffff', NULL, '79999', '', NULL, NULL, 'a', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ali', 1, NULL, 1, '2025-12-02 23:51:34', '2025-12-03 00:00:31'),
(119, 0, 'احمد رضا ', NULL, '07008458', '', NULL, NULL, 'a', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ali', 1, NULL, 1, '2025-12-02 23:52:20', '2025-12-03 00:01:28'),
(120, 0, 'عباس', NULL, '55', '', NULL, NULL, 'a', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-03-00-50-57_692f4a2992ca8.jpg', NULL, NULL, 'ali', 1, NULL, 1, '2025-12-03 00:50:57', '2025-12-04 01:08:45');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `not_access_logs`
--

INSERT INTO `not_access_logs` (`id`, `user_id`, `section_name`, `page_address`, `ip_address`, `user_agent`, `status`, `created_at`, `updated_at`) VALUES
(1, 101, 'students', '/souda-con/add-expense', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-03 11:58:50', NULL),
(2, 101, 'students', '/souda-con/expenses_categories', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-03 12:00:33', NULL),
(3, 101, 'students', '/souda-con/product-category-store', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-03 12:01:57', NULL),
(4, 101, 'edit-package', '/souda-con/edit-invoice-sale/15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-04 01:08:15', NULL),
(5, 101, 'students', '/souda-con/search-user-details', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-04 02:39:29', NULL),
(6, 101, 'students', '/souda-con/invoice-details/35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-08 18:40:16', NULL),
(7, 101, 'students', '/souda-con/invoice-details/38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-09 14:28:38', NULL),
(8, 101, 'students', '/souda-con/invoice-details/33', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-09 14:28:54', NULL),
(9, 101, 'students', '/souda-con/user-details/4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-10 00:35:06', NULL),
(10, 101, 'students', '/souda-con/user-details/4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-10 15:13:31', NULL),
(11, 101, 'students', '/souda-con/user-details/4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-10 15:14:00', NULL),
(12, 101, 'students', '/souda-con/user-details/4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-10 15:14:10', NULL),
(13, 116, 'general', '/souda-con/', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-10 22:05:08', NULL),
(14, 116, 'students', '/souda-con/invoice-details/125', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-11 22:48:51', NULL),
(15, 116, 'students', '/souda-con/sale-invoice-details/128', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-12 18:26:08', NULL),
(16, 116, 'genral', '/souda-con/sale-invoice-details/121', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-12 18:26:35', NULL),
(17, 116, 'genral', '/souda-con/sale-invoice-details/128', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 1, '2025-11-12 18:26:49', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `section_name`, `employee_id`, `created_at`, `updated_at`) VALUES
(271, 'general', 116, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `branch_id`, `name`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(1, 20, 'a', 'ali', 2, '2025-11-07 22:01:20', '2025-12-02 23:22:12'),
(2, 0, '11', 'ali', 1, '2025-12-02 22:54:20', '2025-12-02 23:20:21'),
(3, 0, 'a', 'ali', 1, '2025-12-02 22:54:46', NULL),
(4, 0, 'f', 'ali', 1, '2025-12-02 22:54:48', NULL),
(5, 0, 'sdf', 'ali', 1, '2025-12-02 22:54:55', NULL),
(6, 0, '1', 'ali', 1, '2025-12-02 22:56:15', NULL),
(7, 0, 'ffs', 'ali', 1, '2025-12-02 22:56:27', NULL),
(8, 0, '221', 'ali', 1, '2025-12-02 22:56:39', NULL),
(9, 0, '45', 'ali', 1, '2025-12-02 22:56:41', NULL),
(10, 0, '687', 'ali', 1, '2025-12-02 22:56:43', NULL),
(11, 0, '245', 'ali', 1, '2025-12-02 22:56:45', NULL),
(12, 0, 'dd', 'ali', 1, '2025-12-02 23:13:28', NULL);

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
  `year` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `month` tinyint NOT NULL,
  `type` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `visit_id`, `patient_name`, `doctor_id`, `year`, `month`, `type`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(4, NULL, 0, NULL, 48, '1404', 9, 1, 2, 'ali', '2025-12-04 00:55:42', '2025-12-04 01:24:03'),
(5, NULL, 0, NULL, 48, '1404', 9, 1, 2, 'ali', '2025-12-04 01:24:11', '2025-12-04 01:24:18'),
(6, NULL, 0, NULL, 48, '1404', 9, 1, 2, 'ali', '2025-12-04 02:11:58', '2025-12-04 23:55:10'),
(7, NULL, 0, NULL, 48, '1404', 9, 1, 1, 'ali', '2025-12-04 23:55:28', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_items`
--

INSERT INTO `prescription_items` (`id`, `drug_name`, `prescription_id`, `drug_id`, `dosage`, `interval_time`, `duration_days`, `usage_instruction`, `description`, `drug_count`, `status`, `created_at`, `updated_at`) VALUES
(5, 'for test', 3, 1, '1', 'بعد از غذا', NULL, '1', '', 1, 1, '2025-12-03 23:51:29', NULL),
(6, 'for test', 4, 1, '1', 'بعد از غذا', NULL, '1', '', 1, 1, '2025-12-04 00:55:42', NULL),
(7, 'for test', 5, 1, '1', 'بعد از غذا', NULL, '1', '', 1, 1, '2025-12-04 01:24:11', NULL),
(9, 'for test', 6, 1, '1', 'بعد از غذا', NULL, '1', '', 1, 1, '2025-12-04 23:49:44', NULL),
(10, 'for test', 7, 1, '1', 'بعد از غذا', NULL, '1', '', 1, 1, '2025-12-04 23:55:28', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `en_name`, `section_id`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(151, 'شاگردان', 'students', NULL, '', 1, '2024-11-23 21:51:01', NULL),
(152, 'ثبت شاگرد', 'addNewStudent', 151, '', 1, '2024-11-23 21:51:43', NULL),
(153, 'نمایش شاگردان', 'showStudents', 151, '', 1, '2024-11-23 21:52:01', NULL),
(154, 'ثبت شاگرد در صنف', 'addStudentAtClass', 151, '', 1, '2024-11-23 21:52:33', NULL),
(155, 'مدیریت صنف ها', 'classesManagement', NULL, '', 1, '2024-11-23 21:53:06', NULL),
(156, 'برگزاری صنف جدید', 'holdingNewClass', 155, '', 1, '2024-11-23 21:53:48', NULL),
(157, 'نمایش صنف های برگزار شده', 'showHoldingClasses', 155, '', 1, '2024-11-23 21:54:17', NULL),
(158, 'ساعت های درسی', 'times', 155, '', 1, '2024-11-23 21:54:43', NULL),
(159, 'صنف های درسی', 'classRooms', 155, '', 1, '2024-11-23 21:56:16', NULL),
(160, 'مدیریت درسی', 'courseManagement', NULL, '', 1, '2024-11-23 21:56:51', NULL),
(161, 'دیپارتمنت ها', 'departments', 159, '', 1, '2024-11-23 21:57:10', NULL),
(162, 'دروس', 'lessons', 160, '', 1, '2024-11-23 21:57:37', NULL),
(163, 'پکیج ها', 'packages', 160, '', 1, '2024-11-23 21:57:59', NULL),
(164, 'مدیریت نمرات', 'gradeManagement', NULL, '', 1, '2024-11-23 21:58:31', NULL),
(165, 'ثبت نمرات', 'addGrade', 164, '', 1, '2024-11-23 21:59:01', NULL),
(166, 'نمایش نمرات', 'showGrade', 164, '', 1, '2024-11-23 21:59:14', NULL),
(167, 'مدیریت حاضری', 'attendanceManagement', NULL, '', 1, '2024-11-23 21:59:43', NULL),
(168, 'ثبت حاضری', 'addAttendance', 167, '', 1, '2024-11-23 22:00:07', NULL),
(169, 'نمایش حاضری ها', 'showAttendance', 167, '', 1, '2024-11-23 22:00:20', NULL),
(170, 'مدیریت مالی', 'financialManagement', NULL, '', 1, '2024-11-23 22:00:41', NULL),
(171, 'موجودی صندوق', 'fundBalance', 170, '', 1, '2024-11-23 22:01:38', NULL),
(172, 'افزودن پول (کیف پول)', 'addMoneyToWallet', 170, '', 1, '2024-11-23 22:02:56', NULL),
(173, 'نمایش کیف پول', 'showWallets', 170, '', 1, '2024-11-23 22:03:13', NULL),
(174, 'مصارف', 'expenses', NULL, '', 1, '2024-11-23 22:04:22', NULL),
(175, 'ثبت مصرفی', 'addExpenses', 174, '', 1, '2024-11-23 22:05:03', NULL),
(176, 'نمایش مصارف', 'showExpenses', 174, '', 1, '2024-11-23 22:05:31', NULL),
(177, 'مدیریت دسته بندی های مصارف', 'categoryExpenses', 174, '', 1, '2024-11-23 22:06:11', NULL),
(178, 'کارمندان', 'employees', NULL, '', 1, '2024-11-23 22:07:05', NULL),
(179, 'ثبت کارمند جدید', 'addEmployee', 178, '', 1, '2024-11-23 22:07:29', NULL),
(180, 'نمایش کارمندان', 'showEmployees', 178, '', 1, '2024-11-23 22:07:44', NULL),
(181, 'مدیریت وظایف کارمندان', 'positionsOfEmployees', 178, '', 1, '2024-11-23 22:08:26', NULL),
(182, 'مراکز و قراردادها', 'centerAndContracts', NULL, '', 1, '2024-11-23 22:09:11', NULL),
(183, 'مدیریت مراکز', 'centerManagement', 182, '', 1, '2024-11-23 22:09:40', NULL),
(184, 'مدیریت قراردادها', 'contractManagement', 182, '', 1, '2024-11-23 22:10:06', NULL),
(185, 'مدیریت سوالات', 'questionsManagement', NULL, '', 1, '2024-11-23 22:10:32', NULL),
(186, 'سوالات چهار گزینه ای', 'fourOptionsQuestions', 185, '', 1, '2024-11-23 22:12:02', NULL),
(187, 'تنظیمات', 'settings', NULL, '', 1, '2024-11-23 22:12:26', NULL),
(188, 'ثبت پکیج جدید', 'package-store', 163, '', 1, '2025-01-04 21:00:33', NULL),
(189, 'صفحه ویرایش پکیج', 'edit-package', 163, '', 1, '2025-01-04 22:43:05', NULL),
(190, 'ثبت ویرایش پکیج', 'edit-package-store', 163, '', 1, '2025-01-04 22:58:50', NULL),
(191, 'تغییر وضعیت پکیج', 'change-status-package', 163, '', 1, '2025-01-04 23:14:33', NULL),
(192, 'نمایش جزئیات پکیج', 'package-details', 163, '', 1, '2025-01-04 23:16:30', NULL),
(193, 'ثبت درس', 'lesson-store', 162, '', 1, '2025-01-04 23:28:22', NULL),
(194, 'صفحه ویرایش درس', 'edit-lesson', 162, '', 1, '2025-01-04 23:38:56', NULL),
(195, 'ثبت ویرایش درس', 'edit-lesson-store', 162, '', 1, '2025-01-04 23:47:03', NULL),
(196, 'نمایش جزئیات درس', 'lesson-details', 162, '', 1, '2025-01-05 14:34:50', NULL),
(197, 'تغییر وضعیت درس', 'change-status-lesson', 162, '', 1, '2025-01-05 14:38:43', NULL),
(198, 'ثبت صنف درسی جدید', 'classRoom-store', 155, '', 1, '2025-01-05 15:03:22', NULL),
(199, 'صفحه ویرایش صنف درسی', 'edit-classRoom', 155, '', 1, '2025-01-05 15:06:01', NULL),
(200, 'ثبت ویرایش صنف درسی', 'edit-classRoom-store', 155, '', 1, '2025-01-05 15:07:56', NULL),
(201, 'نمایش جزئیات صنف درسی', 'classRoom-details', 155, '', 1, '2025-01-05 15:17:21', NULL),
(202, 'تغییر وضعیت صنف درسی', 'change-status-classRoom', 155, '', 1, '2025-01-05 15:20:09', NULL),
(203, 'ثبت ساعت درسی', 'time-store', 155, '', 1, '2025-01-05 15:42:09', NULL),
(204, 'ویرایش ساعت درسی', 'edit-time', 155, '', 1, '2025-01-05 15:48:47', NULL),
(205, 'ثبت ویرایش ساعت درسی', 'edit-time-store', 155, '', 1, '2025-01-05 15:52:44', NULL),
(206, 'نمایش جزئیات ساعت درسی', 'time-details', 155, '', 1, '2025-01-05 15:56:20', NULL),
(207, 'تغییر وضعیت ساعت درسی', 'change-status-time', 155, '', 1, '2025-01-05 15:58:16', NULL),
(208, 'انتخاب درس برای برگزاری صنف جدید', 'select-losson', 155, '', 1, '2025-01-05 16:34:02', NULL),
(209, 'نمایش فرم برگزاری صنف جدید', 'add-class', 155, '', 1, '2025-01-05 16:39:26', NULL),
(210, 'ثبت برگزاری صنف جدید', 'class-store', 155, '', 1, '2025-01-05 21:52:24', NULL),
(211, 'نمایش جزئیات صنف برگزار شده', 'class-details', 155, '', 1, '2025-01-05 21:58:16', NULL),
(212, 'صفحه انتخاب دیپارتمنت برای ثبت شاگرد در صنف', 'get-department-register', 151, 'ali', 1, '2025-01-07 22:38:44', NULL),
(213, 'فیس ها', 'payments', NULL, 'ali', 1, '2025-01-22 23:38:23', NULL),
(214, 'ثبت فیس شاگرد', 'fee-payment', 213, 'ali', 1, '2025-01-22 23:38:52', NULL),
(215, 'تغییر بین سال ها', 'years', NULL, '', 1, '2024-11-23 22:00:41', NULL),
(216, 'بروزرسانی بخش‌ها', 'update_sections', NULL, '', 1, '2024-11-23 22:07:05', NULL),
(217, 'عمومی', 'general', NULL, '', 1, '2024-11-23 21:51:01', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 'ss aaa', 1, 'ali', '2025-12-03 02:36:15', '2025-12-03 02:46:54'),
(2, 'two', 1, 'ali', '2025-12-03 02:47:06', NULL),
(3, 'tree', 1, 'ali', '2025-12-03 02:47:10', NULL);

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
  `birth_date` varchar(4) DEFAULT NULL,
  `phone_relative` varchar(15) DEFAULT NULL,
  `blood_group` varchar(15) DEFAULT NULL,
  `chronic_diseases` varchar(1024) DEFAULT NULL,
  `allergies` varchar(1024) DEFAULT NULL,
  `past_surgeries` varchar(1024) DEFAULT NULL,
  `height` varchar(5) DEFAULT NULL,
  `weight` varchar(5) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `user_image` varchar(254) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_code`, `user_name`, `password`, `father_name`, `phone`, `email`, `gender`, `birth_date`, `phone_relative`, `blood_group`, `chronic_diseases`, `allergies`, `past_surgeries`, `height`, `weight`, `address`, `description`, `user_image`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, '1', 'عمومی', NULL, '', '1', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 1, 'محمد رضا', '2025-11-04 11:39:44', NULL),
(4, '1', 'احمد حسینی 1', NULL, NULL, '0799', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'چوک گلها سنتر', NULL, '2025-11-10-15-43-43_6911c8e7099e3.jpg', 1, 'احمد رضا', '2025-11-09 18:38:44', '2025-11-11 14:31:33'),
(5, '1', 'hamdi rezaee', NULL, 'ali', '66', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'herat', 'desc', '2025-11-11-14-32-12_691309a42b926.jpg', 1, 'احمد رضا', '2025-11-11 14:32:12', NULL),
(6, '1', 'محمد رضا احمدی', '$2y$10$fVhSna7IN1cVEKlJezadnuQ0zU/vDhUTJPZ5iWd0/7p78rZyJ1TGa', 'غلام', '0799999999', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'هرات چوک گلها', 'توضیحات', '2025-11-11-21-57-57_6913721d5a467.jpg', 1, 'احمد رضا', '2025-11-11 21:57:57', '2025-11-11 22:02:26');

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
