-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2025 at 06:41 PM
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
-- Database: `souda_con_sis`
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
-- Table structure for table `cash_transactions`
--

DROP TABLE IF EXISTS `cash_transactions`;
CREATE TABLE IF NOT EXISTS `cash_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `transaction_number` varchar(32) NOT NULL,
  `user_id` int NOT NULL,
  `type` tinyint NOT NULL,
  `date` varchar(128) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `currency` varchar(64) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `year` int NOT NULL,
  `month` tinyint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cash_transactions`
--

INSERT INTO `cash_transactions` (`id`, `branch_id`, `transaction_number`, `user_id`, `type`, `date`, `amount`, `currency`, `description`, `year`, `month`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(32, 20, 'R251112-32', 4, 5, '1762972474', 500.00, NULL, NULL, 1404, 8, 1, 'احمد رضا 1', '2025-11-12 23:04:40', '2025-11-12 23:04:40'),
(33, 20, 'W251112-33', 4, 6, '1762972499', 450.00, NULL, NULL, 1404, 8, 1, 'احمد رضا 1', '2025-11-12 23:05:04', '2025-11-12 23:05:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

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
-- Table structure for table `edited`
--

DROP TABLE IF EXISTS `edited`;
CREATE TABLE IF NOT EXISTS `edited` (
  `id` int NOT NULL AUTO_INCREMENT,
  `edit_ref_id` int NOT NULL,
  `who_id` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `phone` int NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `branch_id`, `employee_name`, `father_name`, `phone`, `password`, `email`, `address`, `position`, `role`, `verify_token`, `forgot_token`, `forgot_token_expire`, `remember_token`, `expire_remember_token`, `image`, `description`, `salary_price`, `who_it`, `state`, `super_admin`, `notif`, `created_at`, `updated_at`) VALUES
(48, 100, 'ali', NULL, 11, '$2y$10$EfLQ0PKX4GeGGXnbfeNCdeao/DXcMSDb2Cm99gbyrLmuovnifQfki', 'ali.afg@gmail.com', NULL, '', 3, NULL, '1daa771ddafb5d1cdc6968fa34a02a4de8c28ed632288dfd33d403619c458ea9', '2025-03-01 13:47:53', NULL, NULL, '2024-09-01-23-53-55_66d4bf4bc0f96.jpg', NULL, 2000, '1', 1, 3, 2, '2024-09-01 23:53:55', '2025-11-10 22:05:03'),
(116, 20, 'احمد رضا 1', NULL, 22, '$2y$10$lvfOlBw5pMhnzGxLTMpdhOJAUdnpvXTj2xh.AW6/5AXndWqHA2fvu', NULL, '', '1', 1, NULL, NULL, NULL, '78045e6eed2d6ae7272ddae3cf703cd46839d2213c47208998037e75ea871513', '1', NULL, NULL, 2000, 'احمد رضا 1', 1, NULL, 2, '2025-11-10 21:59:19', '2025-11-14 20:14:07');

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
-- Table structure for table `factor_settings`
--

DROP TABLE IF EXISTS `factor_settings`;
CREATE TABLE IF NOT EXISTS `factor_settings` (
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
-- Dumping data for table `factor_settings`
--

INSERT INTO `factor_settings` (`id`, `branch_id`, `center_name`, `slogan`, `phone1`, `phone2`, `phone3`, `phone4`, `address`, `website`, `email`, `image`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 20, 'شرکت رنگسازی افغان فیضی', 'رشد صنعت ', '07999999', '07999999', '07999999', '324', 'هرات، چوک گلها', 'www.afghanfaizi.com', 'afghanfaizi@info.com', '2025-11-14-23-10-57_691777b98e87c.png', 1, 'احمد رضا 1', '2025-11-13 19:12:30', '2025-11-14 23:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `financial_summary`
--

DROP TABLE IF EXISTS `financial_summary`;
CREATE TABLE IF NOT EXISTS `financial_summary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `initial_balance` decimal(20,2) DEFAULT NULL,
  `total_sales_amount` decimal(20,2) DEFAULT NULL,
  `total_purchase_amount` decimal(20,2) DEFAULT NULL,
  `total_profit` decimal(20,2) DEFAULT NULL,
  `total_expense` decimal(20,2) DEFAULT NULL,
  `total_cash_in` decimal(20,2) DEFAULT NULL,
  `total_cash_out` decimal(20,2) DEFAULT NULL,
  `total_debt_to_users` decimal(20,2) DEFAULT NULL,
  `total_debt_from_users` decimal(20,2) DEFAULT NULL,
  `total_sales_count` int DEFAULT NULL,
  `total_purchases_count` int DEFAULT NULL,
  `total_sales_discount` decimal(15,2) DEFAULT NULL,
  `total_purchase_discount` decimal(20,2) DEFAULT NULL,
  `current_balance` decimal(15,2) DEFAULT NULL,
  `total_return_from_purchase` decimal(20,2) DEFAULT NULL,
  `total_return_from_sales` decimal(20,2) DEFAULT NULL,
  `year` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `financial_summary`
--

INSERT INTO `financial_summary` (`id`, `branch_id`, `initial_balance`, `total_sales_amount`, `total_purchase_amount`, `total_profit`, `total_expense`, `total_cash_in`, `total_cash_out`, `total_debt_to_users`, `total_debt_from_users`, `total_sales_count`, `total_purchases_count`, `total_sales_discount`, `total_purchase_discount`, `current_balance`, `total_return_from_purchase`, `total_return_from_sales`, `year`, `status`, `created_at`, `updated_at`) VALUES
(15, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2025-08-10 15:27:42', '2025-09-27 16:55:54'),
(16, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2025-08-10 15:27:43', '2025-08-10 15:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(124) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `package_price_buy` decimal(12,2) DEFAULT NULL,
  `package_price_sell` decimal(12,2) DEFAULT NULL,
  `quantity_in_pack` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `inventory_year` int NOT NULL,
  `inventory_month` tinyint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_name` (`product_name`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `branch_id`, `product_id`, `product_name`, `quantity`, `package_price_buy`, `package_price_sell`, `quantity_in_pack`, `status`, `inventory_year`, `inventory_month`, `created_at`, `updated_at`) VALUES
(23, 20, 79, 'تینر 1/5 لتره ممتاز', '-1', 800.00, 1080.00, 9, 1, 1404, 8, '2025-11-10 23:35:04', '2025-11-12 23:03:43'),
(24, 20, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', '', 900.00, 1000.00, 1, 1, 1404, 8, '2025-11-10 23:35:37', '2025-11-11 01:09:57'),
(30, 20, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', '3', 750.00, 850.00, 1, 1, 1404, 8, '2025-11-10 23:41:07', '2025-11-14 20:28:28'),
(31, 20, 1, 'رنگ روغنی براق 1کیلویی افغان فیضی 101', '-110', 3168.00, 3360.00, 16, 1, 1404, 8, '2025-11-10 23:49:19', '2025-11-12 00:09:52'),
(32, 20, 6, 'رنگ روغنی براق 1کیلویی افغان فیضی 133', '64', 2976.00, 3360.00, 16, 1, 1404, 8, '2025-11-10 23:52:25', '2025-11-12 22:43:00'),
(33, 20, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', '-16', 2976.00, 3360.00, 16, 1, 1404, 8, '2025-11-10 23:52:40', '2025-11-12 22:42:48'),
(34, 20, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', '23', 2000.00, 2200.00, 4, 1, 1404, 8, '2025-11-11 14:11:37', '2025-11-12 23:54:43'),
(35, 20, 83, 'تینر کلیر 1 لتره ', '20', 1500.00, 2000.00, 20, 1, 1404, 8, '2025-11-11 18:17:59', '2025-11-12 03:07:00'),
(39, 20, 13, 'رنگ روغنی براق 1کیلویی افغان فیضی 275', '16', 2976.00, 3360.00, 16, 1, 1404, 8, '2025-11-11 23:40:57', NULL),
(40, 20, 54, 'رنگ روغنی براق 1کیلویی افغان فیضی 3072', '34', 2976.00, 3360.00, 16, 1, 1404, 8, '2025-11-11 23:43:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(48) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ref_id` varchar(32) DEFAULT NULL,
  `branch_id` varchar(32) DEFAULT NULL,
  `user_id` varchar(32) DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `date` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `paid_amount` decimal(15,2) DEFAULT NULL,
  `invoice_type` tinyint DEFAULT NULL COMMENT '1-> sell, 2->purchase, 3-> return from sell, 4-> return from purchase',
  `tax_amount` decimal(12,2) DEFAULT NULL,
  `ancillary_expenses` decimal(12,2) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `month` tinyint DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `description` varchar(1024) DEFAULT NULL,
  `who_it` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`,`user_id`),
  KEY `invoice_type` (`invoice_type`),
  KEY `date` (`date`),
  KEY `invoice_number` (`invoice_number`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `ref_id`, `branch_id`, `user_id`, `total_amount`, `discount`, `date`, `paid_amount`, `invoice_type`, `tax_amount`, `ancillary_expenses`, `image`, `year`, `month`, `status`, `description`, `who_it`, `created_at`, `updated_at`) VALUES
(2, 'S251112-2', NULL, '20', '4', 1080.00, NULL, '1762972420', NULL, 1, NULL, NULL, NULL, 1404, 8, 2, NULL, 'احمد رضا 1', '2025-11-12 23:03:40', '2025-11-12 23:03:43'),
(3, 'P251112-3', NULL, '20', '4', 750.00, NULL, '1762972430', NULL, 2, NULL, NULL, NULL, 1404, 8, 2, NULL, 'احمد رضا 1', '2025-11-12 23:03:50', '2025-11-12 23:03:52'),
(4, 'RS251112-4', NULL, '20', '4', 750.00, NULL, '1762975463', NULL, 3, NULL, NULL, NULL, 1404, 8, 2, NULL, 'احمد رضا 1', '2025-11-12 23:54:23', '2025-11-12 23:54:25'),
(5, 'RP251112-5', NULL, '20', '4', 2000.00, NULL, '1762975478', NULL, 4, NULL, NULL, NULL, 1404, 8, 2, NULL, 'احمد رضا 1', '2025-11-12 23:54:38', '2025-11-12 23:54:43'),
(6, 'RS251113-6', NULL, '20', '4', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1404, 8, 1, NULL, 'احمد رضا 1', '2025-11-13 19:04:46', '2025-11-13 19:04:46'),
(7, 'P251114-7', NULL, '20', '4', 750.00, NULL, '1763134874', NULL, 2, NULL, NULL, NULL, 1404, 8, 2, NULL, 'احمد رضا 1', '2025-11-14 20:11:14', '2025-11-14 20:11:16'),
(8, 'S251114-8', NULL, '20', '4', 850.00, NULL, '1763135902', 50.00, 1, NULL, NULL, NULL, 1404, 8, 2, NULL, 'احمد رضا 1', '2025-11-14 20:28:22', '2025-11-14 20:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `quantity` int NOT NULL,
  `package_qty` int DEFAULT NULL,
  `package_price_buy` decimal(15,2) DEFAULT NULL,
  `package_price_sell` decimal(15,2) DEFAULT NULL,
  `quantity_in_pack` int NOT NULL,
  `unit_qty` int DEFAULT NULL,
  `discount` decimal(12,2) DEFAULT NULL,
  `item_total_price` decimal(12,2) NOT NULL,
  `seller_id` varchar(11) DEFAULT NULL,
  `item_status` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `expiration_date` varchar(256) DEFAULT NULL,
  `who_it` varchar(32) NOT NULL,
  `item_year` int NOT NULL,
  `item_month` tinyint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `product_id` (`product_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `branch_id`, `invoice_id`, `product_id`, `product_name`, `quantity`, `package_qty`, `package_price_buy`, `package_price_sell`, `quantity_in_pack`, `unit_qty`, `discount`, `item_total_price`, `seller_id`, `item_status`, `status`, `expiration_date`, `who_it`, `item_year`, `item_month`, `created_at`, `updated_at`) VALUES
(69, 20, 49, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 800.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:29:04', NULL),
(70, 20, 50, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 900.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:35:35', NULL),
(71, 20, 51, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 750.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:36:37', NULL),
(72, 20, 52, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 750.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:42:37', NULL),
(73, 20, 53, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 750.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:48:14', NULL),
(74, 20, 54, 1, 'رنگ روغنی براق 1کیلویی افغان فیضی 101', 16, 1, 3168.00, 3360.00, 16, NULL, 0.00, 3168.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:49:17', NULL),
(75, 20, 55, 6, 'رنگ روغنی براق 1کیلویی افغان فیضی 133', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 2976.00, '1', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:52:11', NULL),
(76, 20, 56, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 2976.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:52:40', NULL),
(77, 20, 57, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 3360.00, '', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:54:50', NULL),
(78, 20, 58, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 3360.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:55:12', NULL),
(79, 20, 59, 1, 'رنگ روغنی براق 1کیلویی افغان فیضی 101', 16, 1, 3168.00, 3360.00, 16, NULL, 0.00, 3168.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:58:21', NULL),
(80, 20, 60, 6, 'رنگ روغنی براق 1کیلویی افغان فیضی 133', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 2976.00, '', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-10 23:58:51', NULL),
(81, 20, 61, 1, 'رنگ روغنی براق 1کیلویی افغان فیضی 101', 16, 1, 3168.00, 3360.00, 16, NULL, 0.00, 3168.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 00:00:02', NULL),
(83, 20, 63, 79, 'تینر 1/5 لتره ممتاز', 1, NULL, 800.00, NULL, 9, 1, NULL, 88.89, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 00:01:34', NULL),
(84, 20, 64, 79, 'تینر 1/5 لتره ممتاز', 27, 3, 800.00, 1080.00, 9, NULL, 0.00, 2400.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 00:02:49', NULL),
(85, 20, 65, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 00:03:06', NULL),
(86, 20, 66, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:09:52', NULL),
(87, 20, 67, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:14:14', NULL),
(88, 20, 68, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 3360.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:15:22', NULL),
(89, 20, 69, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 3360.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:16:43', NULL),
(90, 20, 70, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:18:45', NULL),
(91, 20, 71, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:19:25', NULL),
(92, 20, 72, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:23:02', NULL),
(93, 20, 73, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:24:27', NULL),
(94, 20, 74, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:36:21', NULL),
(95, 20, 75, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:37:10', NULL),
(96, 20, 76, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:38:49', NULL),
(97, 20, 77, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:42:36', NULL),
(98, 20, 78, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:43:45', NULL),
(99, 20, 79, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:44:13', NULL),
(100, 20, 80, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:48:31', NULL),
(101, 20, 81, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:48:51', NULL),
(102, 20, 82, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:50:06', NULL),
(103, 20, 83, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:51:01', NULL),
(104, 20, 84, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:52:21', NULL),
(105, 20, 85, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 01:55:27', NULL),
(106, 20, 86, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:16:44', NULL),
(107, 20, 87, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:18:11', NULL),
(108, 20, 88, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:19:13', NULL),
(109, 20, 89, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 3360.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:21:08', NULL),
(110, 20, 90, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:21:28', NULL),
(111, 20, 91, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:25:56', NULL),
(112, 20, 92, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:26:47', NULL),
(113, 20, 93, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:27:27', NULL),
(114, 20, 94, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:29:51', NULL),
(115, 20, 95, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 10, 10, 900.00, 1000.00, 1, NULL, 0.00, 10000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:30:15', NULL),
(116, 20, 96, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:31:44', NULL),
(117, 20, 97, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 3360.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:39:38', NULL),
(118, 20, 98, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:39:53', NULL),
(119, 20, 99, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:41:31', NULL),
(120, 20, 100, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:42:11', NULL),
(121, 20, 101, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:43:28', NULL),
(122, 20, 102, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:45:23', NULL),
(123, 20, 103, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:50:36', NULL),
(124, 20, 104, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 3360.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:51:02', NULL),
(125, 20, 105, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:51:33', NULL),
(126, 20, 106, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:51:51', NULL),
(127, 20, 107, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 3360.00, '', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:52:01', NULL),
(128, 20, 108, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:52:50', NULL),
(129, 20, 109, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:53:24', NULL),
(130, 20, 110, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:55:07', NULL),
(131, 20, 111, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:56:17', NULL),
(132, 20, 112, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:57:22', NULL),
(133, 20, 113, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 02:59:51', NULL),
(134, 20, 114, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 40, 10, 2000.00, 2200.00, 4, NULL, 0.00, 20000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 14:11:29', NULL),
(135, 20, 115, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 4, 1, 2000.00, 2200.00, 4, NULL, 0.00, 2200.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 14:11:52', NULL),
(136, 20, 116, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 4, 1, 2000.00, 2200.00, 4, NULL, 0.00, 2200.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 14:14:54', NULL),
(137, 20, 117, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 4, 1, 2000.00, 2200.00, 4, NULL, 0.00, 2200.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 14:15:10', NULL),
(138, 20, 118, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 14:17:39', NULL),
(139, 20, 119, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 14:18:28', NULL),
(140, 20, 120, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 3360.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 14:21:50', NULL),
(141, 20, 121, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 14:54:38', NULL),
(142, 20, 122, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 2, 2, 750.00, 850.00, 1, NULL, 0.00, 1700.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 18:02:59', NULL),
(143, 20, 122, 1, 'رنگ روغنی براق 1کیلویی افغان فیضی 101', 160, 10, 3168.00, 3360.00, 16, NULL, 0.00, 33600.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 18:03:14', NULL),
(144, 20, 123, 83, 'تینر کلیر 1 لتره ', 20, 1, 1500.00, 2000.00, 20, NULL, 0.00, 1500.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 18:17:47', NULL),
(145, 20, 124, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 4, 1, 2000.00, 2200.00, 4, NULL, 0.00, 2200.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 21:47:12', NULL),
(146, 20, 125, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 1, NULL, 2000.00, 2200.00, 4, 1, 0.00, 500.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 21:50:24', NULL),
(147, 20, 126, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 800.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 23:36:14', NULL),
(148, 20, 126, 13, 'رنگ روغنی براق 1کیلویی افغان فیضی 275', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 2976.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 23:36:19', NULL),
(149, 20, 126, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 6, 1, 2000.00, 2200.00, 4, 2, 0.00, 3000.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 23:36:24', NULL),
(150, 20, 126, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 750.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 23:36:28', NULL),
(151, 20, 126, 1, 'رنگ روغنی براق 1کیلویی افغان فیضی 101', 18, 1, 3168.00, 3360.00, 16, 2, 0.00, 3564.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 23:36:35', NULL),
(152, 20, 127, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 800.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 23:43:15', NULL),
(153, 20, 127, 54, 'رنگ روغنی براق 1کیلویی افغان فیضی 3072', 34, 2, 2976.00, 3360.00, 16, 2, 0.00, 6324.00, '4', 1, 1, NULL, 'احمد رضا', 1404, 8, '2025-11-11 23:43:21', NULL),
(154, 20, 128, 83, 'تینر کلیر 1 لتره ', 20, 1, 1500.00, 2000.00, 20, NULL, 0.00, 2000.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 00:09:32', NULL),
(155, 20, 128, 76, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 900.00, 1000.00, 1, NULL, 0.00, 1000.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 00:09:35', NULL),
(156, 20, 128, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 4, 1, 2000.00, 2200.00, 4, NULL, 0.00, 2200.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 00:09:37', NULL),
(157, 20, 128, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 32, 2, 2976.00, 3360.00, 16, NULL, NULL, 6720.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 00:09:41', '2025-11-12 00:09:45'),
(158, 20, 128, 1, 'رنگ روغنی براق 1کیلویی افغان فیضی 101', 16, 1, 3168.00, 3360.00, 16, NULL, 0.00, 3360.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 00:09:49', NULL),
(161, 20, 131, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 2976.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 22:30:06', NULL),
(162, 20, 132, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 32, 2, 2976.00, 3360.00, 16, NULL, 0.00, 6720.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 22:42:46', NULL),
(163, 20, 133, 6, 'رنگ روغنی براق 1کیلویی افغان فیضی 133', 32, 2, 2976.00, 3360.00, 16, NULL, 0.00, 5952.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 22:42:59', NULL),
(164, 20, 1, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 4, 1, 2000.00, 2200.00, 4, NULL, 0.00, 2000.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 22:56:22', NULL),
(165, 20, 2, 79, 'تینر 1/5 لتره ممتاز', 9, 1, 800.00, 1080.00, 9, NULL, 0.00, 1080.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 23:03:40', NULL),
(166, 20, 3, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 750.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 23:03:50', NULL),
(167, 20, 4, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 750.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 23:54:23', NULL),
(168, 20, 5, 77, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', 4, 1, 2000.00, NULL, 4, NULL, NULL, 2000.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-12 23:54:38', NULL),
(169, 20, 6, 3, 'رنگ روغنی براق 1کیلویی افغان 049 ', 16, 1, 2976.00, 3360.00, 16, NULL, 0.00, 2976.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-13 19:04:46', NULL),
(170, 20, 7, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 750.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-14 20:11:14', NULL),
(171, 20, 8, 78, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', 1, 1, 750.00, 850.00, 1, NULL, 0.00, 850.00, '4', 1, 1, NULL, 'احمد رضا 1', 1404, 8, '2025-11-14 20:28:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_profits`
--

DROP TABLE IF EXISTS `invoice_profits`;
CREATE TABLE IF NOT EXISTS `invoice_profits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `invoice_item_id` int NOT NULL,
  `product_id` int NOT NULL,
  `batch_id` int NOT NULL,
  `quantity` int NOT NULL,
  `buy_price` decimal(15,2) NOT NULL,
  `sell_price` decimal(15,2) NOT NULL,
  `profit` decimal(15,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoice_profits`
--

INSERT INTO `invoice_profits` (`id`, `branch_id`, `invoice_id`, `invoice_item_id`, `product_id`, `batch_id`, `quantity`, `buy_price`, `sell_price`, `profit`, `status`, `created_at`, `updated_at`) VALUES
(1, 20, 21, 22, 1, 1, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-04 02:10:18', NULL),
(2, 20, 22, 23, 1, 2, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-04 02:12:03', NULL),
(3, 20, 23, 24, 1, 3, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-04 02:37:29', NULL),
(4, 20, 24, 25, 1, 4, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-04 16:20:46', NULL),
(5, 20, 25, 26, 1, 5, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-04 16:23:28', NULL),
(6, 20, 25, 26, 1, 6, 2, 1000.00, 1200.00, 400.00, 1, '2025-11-04 16:23:28', NULL),
(7, 20, 26, 27, 1, 6, 18, 1000.00, 1200.00, 3600.00, 1, '2025-11-04 20:51:17', NULL),
(8, 20, 26, 27, 1, 7, 2, 1000.00, 1200.00, 400.00, 1, '2025-11-04 20:51:17', NULL),
(9, 20, 27, 28, 1, 7, 2, 1000.00, 1200.00, 400.00, 1, '2025-11-04 21:00:11', NULL),
(10, 20, 30, 31, 1, 7, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-04 23:43:21', NULL),
(11, 20, 34, 35, 1, 7, 6, 1000.00, 1200.00, 1200.00, 1, '2025-11-05 14:56:52', NULL),
(12, 20, 34, 35, 1, 8, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-05 14:56:52', NULL),
(13, 20, 34, 35, 1, 9, 4, 1000.00, 1200.00, 800.00, 1, '2025-11-05 14:56:52', NULL),
(14, 20, 36, 37, 3, 21, 1, 20.00, 30.00, 10.00, 1, '2025-11-05 15:24:48', NULL),
(15, 20, 36, 38, 1, 9, 6, 1000.00, 1200.00, 1200.00, 1, '2025-11-05 15:24:48', NULL),
(16, 20, 36, 38, 1, 10, 4, 1000.00, 1200.00, 800.00, 1, '2025-11-05 15:24:48', NULL),
(17, 20, 38, 40, 1, 10, 6, 1000.00, 1200.00, 1200.00, 1, '2025-11-09 12:52:01', NULL),
(18, 20, 38, 40, 1, 11, 4, 1000.00, 1200.00, 800.00, 1, '2025-11-09 12:52:01', NULL),
(19, 20, 38, 40, 1, 11, 6, 1000.00, 1200.00, 1200.00, 1, '2025-11-09 12:52:38', NULL),
(20, 20, 38, 40, 1, 12, 4, 1000.00, 1200.00, 800.00, 1, '2025-11-09 12:52:38', NULL),
(21, 20, 39, 41, 1, 12, 6, 1000.00, 1200.00, 1200.00, 1, '2025-11-09 18:36:28', NULL),
(22, 20, 39, 41, 1, 13, 4, 1000.00, 1200.00, 800.00, 1, '2025-11-09 18:36:28', NULL),
(23, 20, 41, 53, 79, 33, 9, 800.00, 1080.00, 2520.00, 1, '2025-11-09 18:43:27', NULL),
(24, 20, 41, 54, 83, 34, 2, 1500.00, 2000.00, 1000.00, 1, '2025-11-09 18:43:27', NULL),
(25, 20, 41, 55, 77, 43, 4, 2000.00, 2200.00, 800.00, 1, '2025-11-09 18:43:27', NULL),
(26, 20, 41, 56, 13, 39, 16, 2976.00, 3360.00, 6144.00, 1, '2025-11-09 18:43:27', NULL),
(27, 20, 41, 57, 56, 41, 32, 2976.00, 3360.00, 12288.00, 1, '2025-11-09 18:43:27', NULL),
(28, 20, 41, 58, 55, 36, 33, 2976.00, 3360.00, 12672.00, 1, '2025-11-09 18:43:27', NULL),
(29, 20, 41, 59, 57, 37, 33, 3520.00, 4000.00, 15840.00, 1, '2025-11-09 18:43:27', NULL),
(30, 20, 41, 60, 61, 38, 5, 3296.00, 3680.00, 1920.00, 1, '2025-11-09 18:43:27', NULL),
(31, 20, 41, 61, 254, 40, 24, 2304.00, 2880.00, 13824.00, 1, '2025-11-09 18:43:27', NULL),
(32, 20, 57, 77, 3, 60, 16, 2976.00, 3360.00, 6144.00, 1, '2025-11-10 23:54:58', NULL),
(33, 20, 65, 85, 79, 33, 3, 800.00, 1080.00, 840.00, 1, '2025-11-11 00:03:08', NULL),
(34, 20, 65, 85, 79, 45, 6, 800.00, 1080.00, 1680.00, 1, '2025-11-11 00:03:08', NULL),
(35, 20, 66, 86, 76, 46, 1, 900.00, 1000.00, 100.00, 1, '2025-11-11 01:09:57', NULL),
(36, 20, 72, 92, 78, 52, 1, 750.00, 850.00, 100.00, 1, '2025-11-11 01:23:03', NULL),
(37, 20, 75, 95, 79, 45, 3, 800.00, 1080.00, 840.00, 1, '2025-11-11 01:37:11', NULL),
(38, 20, 75, 95, 79, 64, 6, 800.00, 1080.00, 1680.00, 1, '2025-11-11 01:37:11', NULL),
(39, 20, 76, 96, 79, 64, 9, 800.00, 1080.00, 2520.00, 1, '2025-11-11 01:38:50', NULL),
(40, 20, 77, 97, 78, 56, 1, 750.00, 850.00, 100.00, 1, '2025-11-11 01:42:46', NULL),
(41, 20, 79, 99, 79, 64, 9, 800.00, 1080.00, 2520.00, 1, '2025-11-11 01:44:14', NULL),
(42, 20, 81, 101, 78, 57, 1, 750.00, 850.00, 100.00, 1, '2025-11-11 01:48:52', NULL),
(43, 20, 82, 102, 79, 64, 3, 800.00, 1080.00, 840.00, 1, '2025-11-11 01:50:07', NULL),
(44, 20, 115, 135, 77, 43, 4, 2000.00, 2200.00, 800.00, 1, '2025-11-11 14:11:53', NULL),
(45, 20, 116, 136, 77, 65, 4, 2000.00, 2200.00, 800.00, 1, '2025-11-11 14:14:56', NULL),
(46, 20, 117, 137, 77, 65, 4, 2000.00, 2200.00, 800.00, 1, '2025-11-11 14:15:12', NULL),
(47, 20, 122, 143, 1, 13, 6, 1000.00, 1200.00, 1200.00, 1, '2025-11-11 18:03:17', NULL),
(48, 20, 122, 143, 1, 14, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-11 18:03:17', NULL),
(49, 20, 122, 143, 1, 15, 20, 1000.00, 1200.00, 4000.00, 1, '2025-11-11 18:03:17', NULL),
(50, 20, 122, 143, 1, 16, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-11 18:03:17', NULL),
(51, 20, 122, 143, 1, 17, 20, 1000.00, 1200.00, 4000.00, 1, '2025-11-11 18:03:18', NULL),
(52, 20, 122, 143, 1, 18, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-11 18:03:18', NULL),
(53, 20, 122, 143, 1, 19, 23, 1000.00, 1200.00, 4600.00, 1, '2025-11-11 18:03:18', NULL),
(54, 20, 122, 143, 1, 20, 10, 1000.00, 1200.00, 2000.00, 1, '2025-11-11 18:03:18', NULL),
(55, 20, 122, 143, 1, 35, 16, 3168.00, 3360.00, 3072.00, 1, '2025-11-11 18:03:18', NULL),
(56, 20, 122, 143, 1, 58, 16, 3168.00, 3360.00, 3072.00, 1, '2025-11-11 18:03:18', NULL),
(57, 20, 122, 143, 1, 61, 16, 3168.00, 3360.00, 3072.00, 1, '2025-11-11 18:03:18', NULL),
(58, 20, 122, 143, 1, 63, 3, 3168.00, 3360.00, 576.00, 1, '2025-11-11 18:03:18', NULL),
(59, 20, 124, 145, 77, 65, 4, 2000.00, 2200.00, 800.00, 1, '2025-11-11 21:47:27', NULL),
(60, 20, 128, 154, 83, 66, 20, 1500.00, 2000.00, 10000.00, 1, '2025-11-12 00:09:52', NULL),
(61, 20, 128, 156, 77, 65, 4, 2000.00, 2200.00, 800.00, 1, '2025-11-12 00:09:52', NULL),
(62, 20, 128, 158, 1, 63, 13, 3168.00, 3360.00, 2496.00, 1, '2025-11-12 00:09:52', NULL),
(63, 20, 128, 158, 1, 81, 3, 3168.00, 3360.00, 576.00, 1, '2025-11-12 00:09:52', NULL),
(64, 20, 132, 162, 3, 84, 16, 2976.00, 3360.00, 6144.00, 1, '2025-11-12 22:42:48', NULL),
(65, 20, 2, 165, 79, 77, 9, 800.00, 1080.00, 2520.00, 1, '2025-11-12 23:03:43', NULL),
(66, 20, 8, 171, 78, 80, 1, 750.00, 850.00, 100.00, 1, '2025-11-14 20:28:28', NULL);

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
(264, 'general', 93, NULL, NULL),
(265, 'general', 94, NULL, NULL),
(266, 'general', 97, NULL, NULL),
(267, 'general', 101, NULL, NULL),
(268, 'general', 104, NULL, NULL),
(269, 'general', 109, NULL, NULL),
(270, 'general', 110, NULL, NULL),
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `branch_id`, `name`, `who_it`, `state`, `created_at`, `updated_at`) VALUES
(1, 20, 'حسابدار', 'محمد رضا', 1, '2025-11-07 22:01:20', '2025-11-07 22:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int DEFAULT NULL,
  `product_name` varchar(124) NOT NULL,
  `product_code` varchar(124) DEFAULT NULL,
  `package_price_buy` decimal(15,2) DEFAULT NULL,
  `package_price_sell` decimal(15,2) DEFAULT NULL,
  `product_cat` varchar(124) NOT NULL,
  `package_type` varchar(32) NOT NULL,
  `quantity_in_pack` int NOT NULL,
  `unit_type` varchar(32) DEFAULT NULL,
  `award` tinyint DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `product_image` varchar(256) DEFAULT NULL,
  `who_it` varchar(60) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 -> active, 2 => deactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_name` (`product_name`),
  KEY `product_code` (`product_code`),
  KEY `idx_branch_product` (`branch_id`,`product_name`),
  KEY `award` (`award`)
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `branch_id`, `product_name`, `product_code`, `package_price_buy`, `package_price_sell`, `product_cat`, `package_type`, `quantity_in_pack`, `unit_type`, `award`, `description`, `product_image`, `who_it`, `status`, `created_at`, `updated_at`) VALUES
(1, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 101', NULL, 3168.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:18:14', '2025-11-04 08:24:11'),
(2, 20, 'رنگ روغنی براق نیم کیلویی افغان فیضی 101', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:19:18', '2025-11-04 08:32:03'),
(3, 20, 'رنگ روغنی براق 1کیلویی افغان 049 ', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:20:20', NULL),
(4, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 105', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:21:09', '2025-11-04 08:23:49'),
(5, 20, 'رنگ روغنی براق 1کیلویی تیره افغان فیضی 109', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:22:15', '2025-11-04 08:23:34'),
(6, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 133', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:23:10', NULL),
(7, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 176', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:28:10', '2025-11-04 08:29:05'),
(8, 20, 'رنگل روغنی براق 1 کیلویی افغان فیضی 175', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کارتن', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:29:53', '2025-11-04 08:31:42'),
(9, 20, 'رنگل روغنی براق 1کیلویی افغان فیضی 185', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:30:18', '2025-11-04 08:31:19'),
(10, 20, 'رنگل روغنی براق 1 کیلویی افغان فیضی 211', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کارتن', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:30:42', '2025-11-04 08:31:09'),
(11, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 206', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:33:24', NULL),
(12, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 231', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:34:00', NULL),
(13, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 275', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:34:41', NULL),
(14, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی300', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:35:30', NULL),
(15, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 302', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:37:33', NULL),
(16, 20, 'رنگ روغنی براق 1کیلویی تیره.افغان فیضی 331', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:38:23', NULL),
(17, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 356', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:39:31', NULL),
(18, 20, 'رنگ روغنی براق 1کیلویی تیره.افغان فیضی 390', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:40:23', NULL),
(19, 20, 'رنگ روغنی براق 1کیلویی تیره.افغان فیضی 400', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:41:09', NULL),
(20, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 401', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:42:45', NULL),
(21, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 402', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:43:17', NULL),
(22, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 405', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:44:04', NULL),
(23, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 404', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:45:02', NULL),
(24, 20, 'رنگ روغنی براق 1کیلویی تیره افغان فیضی 406', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:45:38', '2025-11-04 08:59:31'),
(25, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 760', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:46:11', NULL),
(26, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 411', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:48:56', NULL),
(27, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 412', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 08:56:02', '2025-11-04 08:57:29'),
(28, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 413', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 08:56:47', NULL),
(29, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 414', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:01:07', NULL),
(30, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 408', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:01:51', NULL),
(31, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 922', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:02:18', NULL),
(32, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 458', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:03:03', NULL),
(33, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 471', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:03:47', NULL),
(34, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 459', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:07:29', NULL),
(35, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 460', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:10:15', NULL),
(36, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 462', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:11:06', NULL),
(37, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 467', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:11:55', NULL),
(38, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 410', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:12:43', NULL),
(39, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 470', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:14:41', NULL),
(40, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 474', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:15:23', NULL),
(41, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 475', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:16:41', NULL),
(42, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 476', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 09:18:21', '2025-11-04 09:19:26'),
(43, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 468', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:20:33', NULL),
(44, 20, 'رنگ روغنی براق 1کیلویی تیره.افغان فیضی 469', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:21:12', NULL),
(45, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 473', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:21:46', NULL),
(46, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 465', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:22:14', NULL),
(47, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 407', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:22:49', NULL),
(48, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 477', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:23:23', NULL),
(49, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 556', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:24:01', NULL),
(50, 20, 'رنگ روغنی براق تیره 1 کیلویی افغان فیضی 661', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:25:17', NULL),
(51, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 810', NULL, 2960.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:28:41', NULL),
(52, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 3076', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:29:20', NULL),
(53, 20, 'رنگ روغنی براق 1کیلویی تیره.افغان فیضی 3034', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:30:01', NULL),
(54, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 3072', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:30:39', NULL),
(55, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 3075', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:31:12', NULL),
(56, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 3050', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:31:42', NULL),
(57, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 3300', NULL, 3520.00, 4000.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:33:12', NULL),
(58, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 415', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:35:39', NULL),
(59, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 3078', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:36:17', NULL),
(60, 20, 'رنگ روغنی براق 1کیلویی تیره. افغان فیضی 3033', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:37:01', NULL),
(61, 20, 'رنگ روغنی براق 1کیلویی تیره افغان فیضی 3022', NULL, 3296.00, 3680.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:37:39', NULL),
(62, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 3011', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:38:07', NULL),
(63, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 7000', NULL, 4000.00, 4800.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:38:35', NULL),
(64, 20, 'رنگ روغنی براق 1کیلویی افغان فیضی 150', NULL, 2976.00, 3360.00, 'براق روغنی فیضی', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 09:48:19', NULL),
(65, 20, 'ضد زنگ 4 کیلویی افغان فیضی ', NULL, 1764.00, 1920.00, 'ضد زنگ ', 'کارتن', 4, 'گالن', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:13:26', NULL),
(66, 20, 'ضد زنگ 1 کیلویی افغان فیضی ', NULL, 1344.00, 1560.00, 'ضد زنگ ', 'کارتن', 12, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:13:58', NULL),
(67, 20, 'ضد زنگ نیم کیلویی افغان فیضی ', NULL, 1416.00, 1680.00, 'ضد زنگ ', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:15:00', NULL),
(68, 20, 'ضد زنک 4 کیلویی قادر', NULL, 1268.00, 1480.00, 'ضد زنگ ', 'کارتن', 4, 'گالن', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:15:35', NULL),
(69, 20, 'ضد زنگ 1 کیلویی قادر', NULL, 984.00, 1200.00, 'ضد زنگ ', 'کارتن', 12, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:16:09', NULL),
(70, 20, 'ضد رنگ نیم کیلویی قادر', NULL, 1176.00, 1440.00, 'ضد زنگ ', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-04 10:16:42', '2025-11-04 10:19:15'),
(71, 20, 'ضد زنگ 4 کیلویی مکس', NULL, 1040.00, 1280.00, 'ضد زنگ ', 'کارتن', 4, 'گالن', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:17:17', NULL),
(72, 20, 'ضد زنگ 1 کیلویی مکس', NULL, 780.00, 960.00, 'ضد زنگ ', 'گالن', 12, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:18:04', NULL),
(73, 20, 'ضد زنگ نیم کیلویی مکس', NULL, 888.00, 1200.00, 'ضد زنگ ', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:18:54', NULL),
(74, 20, 'رنگ روغنی براق 4 کیلویی افغان فیضی 101', NULL, 2860.00, 3200.00, 'براق روغنی فیضی', 'کارتن', 4, 'گالن', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:21:08', NULL),
(75, 20, 'رنگ روغنی براق 4 کیلویی افغان فیضی 133', NULL, 2860.00, 3200.00, 'براق روغنی فیضی', 'کارتن', 4, 'گالن', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:21:47', NULL),
(76, 20, 'رنگ 100% تمام پلاستیک افغان فیضی 11 کیلویی ', NULL, 900.00, 1000.00, 'رنگ پلاستیک ', 'سطل', 1, NULL, 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:41:47', NULL),
(77, 20, 'رنگ 100%پلاستک 6 کیلویی افغان فیضی', NULL, 2000.00, 2200.00, 'رنگ پلاستیک ', 'کارتن', 4, 'گالن', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:42:48', NULL),
(78, 20, 'رنگ 75% پلاستیک افغان فیضی 11 کیلویی ', NULL, 750.00, 850.00, 'رنگ پلاستیک ', 'سطل', 1, NULL, 1, '', NULL, 'محمد رضا', 1, '2025-11-04 10:46:45', NULL),
(79, 20, 'تینر 1/5 لتره ممتاز', NULL, 800.00, 1080.00, 'تینر', 'کارتن', 9, 'بشکه', NULL, NULL, NULL, 'محمد رضا', 1, '2025-11-04 13:23:13', '2025-11-05 08:17:46'),
(80, 20, 'تینر نیم لتره ممتاز', NULL, 450.00, 600.00, 'تینر', 'کارتن', 12, 'بشکه', NULL, NULL, NULL, 'محمد رضا', 1, '2025-11-04 13:23:51', '2025-11-05 08:17:53'),
(81, 20, 'تینر کلیر 3 لتره ', NULL, 1302.00, 1500.00, 'تینر', 'کارتن', 6, 'بشکه', NULL, '', NULL, 'محمد رضا', 1, '2025-11-04 13:24:38', NULL),
(82, 20, 'تینر کلیر 2 لتره ', NULL, 1395.00, 1710.00, 'تینر', 'کارتن', 9, 'بشکه', NULL, '', NULL, 'محمد رضا', 1, '2025-11-04 13:27:43', NULL),
(83, 20, 'تینر کلیر 1 لتره ', NULL, 1500.00, 2000.00, 'تینر', 'کارتن', 20, 'بشکه', NULL, '', NULL, 'محمد رضا', 1, '2025-11-04 13:28:36', NULL),
(84, 20, 'رنگ روغنی هیل اکیلویی 201', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 14:34:43', NULL),
(85, 20, 'رنگ روغنی هل اکیلویی 049', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-04 14:35:27', NULL),
(86, 20, 'رنگ روغنی هل اکیلویی 105', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:20:30', NULL),
(87, 20, 'رنگ روغنی هل اکیلویی 109', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:21:09', NULL),
(88, 20, 'رنگ روغنی هل اکیلویی 133', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:21:47', NULL),
(89, 20, 'رنگ روغنی هل اکیلویی 150', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:22:16', NULL),
(90, 20, 'رنگ روغنی هل اکیلویی 176', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:23:00', NULL),
(91, 20, 'رنگ روغنی هل اکیلویی 175', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:24:26', NULL),
(92, 20, 'رنگ روغنی هل اکیلویی 185', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:25:16', NULL),
(93, 20, 'رنگ روغنی هل اکیلویی 211', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:25:46', NULL),
(94, 20, 'رنگ روغنی هل اکیلویی 206', NULL, 1952.00, 2240.00, 'رنگ  روغنی هیل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:26:29', NULL),
(95, 20, 'رنگ روغنی هل اکیلویی 231', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:27:44', NULL),
(96, 20, 'رنگ روغنی هل اکیلویی 275', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:29:01', NULL),
(97, 20, 'رنگ روغنی هل اکیلویی 300', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:31:43', NULL),
(98, 20, 'رنگ روغنی هل اکیلویی 302', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:32:17', NULL),
(99, 20, 'رنگ روغنی هل اکیلویی 331', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:33:20', NULL),
(100, 20, 'رنگ روغنی هل اکیلویی 356', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:39:50', NULL),
(101, 20, 'رنگ روغنی هل اکیلویی 390', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:40:21', NULL),
(102, 20, 'رنگ روغنی هل اکیلویی 400', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:40:47', NULL),
(103, 20, 'رنگ روغنی هل اکیلویی 401', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:41:25', NULL),
(104, 20, 'رنگ روغنی هل اکیلویی 402', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:41:57', NULL),
(105, 20, 'رنگ روغنی هل اکیلویی 404', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:42:33', NULL),
(106, 20, 'رنگ روغنی هل اکیلویی 405', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:43:06', NULL),
(107, 20, 'رنگ روغنی هل اکیلویی 406', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:43:48', NULL),
(108, 20, 'رنگ روغنی هل اکیلویی 760', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 08:44:18', NULL),
(109, 20, 'رنگ روغنی هل اکیلویی 411', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 09:29:47', NULL),
(110, 20, 'رنگ روغنی هل اکیلویی 412', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 09:30:22', NULL),
(111, 20, 'رنگ روغنی هل اکیلویی 413', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:04:10', NULL),
(112, 20, 'رنگ روغنی هل اکیلویی 414', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:04:37', NULL),
(113, 20, 'رنگ روغنی هل اکیلویی 408', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:05:10', NULL),
(114, 20, 'رنگ روغنی هل اکیلویی 922', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:05:40', NULL),
(115, 20, 'رنگ روغنی هل اکیلویی 458', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:06:10', NULL),
(116, 20, 'رنگ روغنی هل اکیلویی 471', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:06:44', NULL),
(117, 20, 'رنگ روغنی هل اکیلویی 459', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:07:16', NULL),
(118, 20, 'رنگ روغنی هل اکیلویی 460', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:07:46', NULL),
(119, 20, 'رنگ روغنی هل اکیلویی 462', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:08:10', NULL),
(120, 20, 'رنگ روغنی هل اکیلویی 467', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:08:43', NULL),
(121, 20, 'رنگ روغنی هل اکیلویی 410', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:09:10', NULL),
(122, 20, 'رنگ روغنی هل اکیلویی 470', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:09:38', NULL),
(123, 20, 'رنگ روغنی هل اکیلویی 474', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 10:10:12', NULL),
(124, 20, 'رنگ روغنی مکس 1کیلویی 201', NULL, 98.00, 120.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-05 12:54:12', '2025-11-05 13:29:14'),
(125, 20, 'رنگ روغنی هیل اکیلویی 475', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:02:28', NULL),
(126, 20, 'روغنی هل یک کیلو 476', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:05:30', NULL),
(127, 20, 'روغنی هل یک کیلو 468', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:06:44', NULL),
(128, 20, 'رنگ روغنی هل اکیلویی 469', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:08:21', NULL),
(129, 20, 'رنگ روغنی هل اکیلویی 473', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:09:57', NULL),
(130, 20, 'رنگ روغنی هل اکیلویی 465', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:10:37', NULL),
(131, 20, 'رنگ روغنی هیل اکیلویی 407', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:11:10', NULL),
(132, 20, 'رنگ روغنی هل اکیلویی 477', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:11:40', NULL),
(133, 20, 'رنگ روغنی هل اکیلویی 556', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:12:16', NULL),
(134, 20, 'رنگ روغنی هل اکیلویی 661', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:13:04', NULL),
(135, 20, 'رنگ روغنی هل اکیلویی 810', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:13:33', NULL),
(136, 20, 'رنگ روغنی هل اکیلویی 3076', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:14:12', NULL),
(137, 20, 'رنگ روغنی هل اکیلویی 3034', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:19:54', NULL),
(138, 20, 'رنگ روغنی هل اکیلویی 3072', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:20:27', NULL),
(139, 20, 'رنگ روغنی هل اکیلویی 3075', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '\r\n', NULL, 'محمد رضا', 1, '2025-11-05 13:21:00', NULL),
(140, 20, 'رنگ روغنی هیل اکیلویی 3050', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:21:30', NULL),
(141, 20, 'رنگ روغنی هیل اکیلویی 415', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:22:07', NULL),
(142, 20, 'رنگ روغنی هل اکیلویی 3078', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:26:00', NULL),
(143, 20, 'رنگ روغنی هل اکیلویی 3033', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:26:32', NULL),
(144, 20, 'رنگ روغنی هل اکیلویی 3022', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:27:22', NULL),
(145, 20, 'رنگ روغنی هل اکیلویی 3011', NULL, 1952.00, 2240.00, 'رنگ  روغنی هل', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 13:27:52', NULL),
(146, 20, 'رنگ روغنی مکس اکیلویی 049', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 15:34:44', NULL),
(147, 20, 'رنگ روغنی مکس اکیلویی 105', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 15:35:50', NULL),
(148, 20, 'رنگ روغنی مکس 1کیلویی 109', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 15:40:59', NULL),
(149, 20, 'رنگ روغنی مکس 1کیلویی 133', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-05 15:48:17', NULL),
(150, 20, 'رنگ روغنی مکس اکیلویی 150', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-05 15:51:48', '2025-11-06 09:08:47'),
(151, 20, 'رنگ روغنی مکس اکیلویی 176', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:18:31', NULL),
(152, 20, 'رنگ روغنی مکس اکیلویی 175', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:19:03', NULL),
(153, 20, 'رنگ روغنی مکس اکیلویی 185', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:19:51', NULL),
(154, 20, 'رنگ روغنی مکس اکیلویی 211', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:20:25', NULL),
(155, 20, 'رنگ روغنی مکس اکیلویی 206', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-06 09:21:01', '2025-11-06 09:21:25'),
(156, 20, 'رنگ روغنی مکس 1کیلویی 231', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:27:27', NULL),
(157, 20, 'رنگ روغنی مکس 1کیلو 231', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:29:30', NULL),
(158, 20, 'رنگ روغنی مکس اکیلویی 231', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:31:09', NULL),
(159, 20, 'رنگ روغنی مکس اکیلویی 275', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:33:04', NULL),
(160, 20, 'رنگ روغنی مکس 1کیلو 300', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:35:27', NULL),
(161, 20, 'رنگ روغنی مکس 1کیلویی 302', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:37:34', NULL),
(162, 20, 'رنگ روغنی مکس 1کیلویی 331', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:39:31', NULL),
(163, 20, 'رنگ روغنی مکس 1کیلویی 356', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:41:24', NULL),
(164, 20, 'رنگ روغنی مکس 1کیلویی 390', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:42:55', NULL),
(165, 20, 'رنگ روغنی مکس 1کیلویی 400', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:44:15', NULL),
(166, 20, 'رنگ روغنی مکس 1کیلویی 401', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:46:25', NULL),
(167, 20, 'رنگ روغنی مکس اکیلویی 402', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:58:15', NULL),
(168, 20, 'رنگ روغنی مکس اکیلویی 404', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 09:59:37', NULL),
(169, 20, 'رنگ روغنی مکس اکیلویی 405', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:01:23', NULL),
(170, 20, 'رنگ روغنی مکس اکیلویی 406', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:03:48', NULL),
(171, 20, 'رنگ روغنی مکس 1کیلویی 760', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:06:11', NULL),
(172, 20, 'رنگ روغنی مکس 1کیلویی 411', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:07:40', NULL),
(173, 20, 'رنگ روغنی مکس 1کیلویی 412', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:08:54', NULL),
(174, 20, 'رنگ روغنی مکس 1کیلویی 413', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:10:14', NULL),
(175, 20, 'رنگ روغنی مکس 1کیلویی 414', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:11:14', NULL),
(176, 20, 'رنگ روغنی مکس 1کیلویی 408', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:12:22', NULL),
(177, 20, 'رنگ روغنی مکس 1کیلویی 922', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:13:31', NULL),
(178, 20, 'رنگ روغنی مکس 1کیلویی 458', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:14:57', NULL),
(179, 20, 'رنگ روغنی مکس 1کیلویی 471', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:16:01', NULL),
(180, 20, 'رنگ روغنی مکس 1کیلویی 459', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:17:02', NULL),
(181, 20, 'رنگ روغنی مکس 1کیلویی 460', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:19:33', NULL),
(182, 20, 'رنگ روغنی مکس 1کیلویی 462', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:20:33', NULL),
(183, 20, 'رنگ روغنی مکس 1کیلویی 467', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:23:16', NULL),
(184, 20, 'رنگ روغنی مکس 1کیلویی 410', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:24:15', NULL),
(185, 20, 'رنگ روغنی مکس 1کیلویی 470', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:25:23', NULL),
(186, 20, 'رنگ روغنی مکس 1کیلویی 474', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:26:43', NULL),
(187, 20, 'رنگ روغنی مکس 1کیلویی 475', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:27:46', NULL),
(188, 20, 'رنگ روغنی مکس 1کیلویی 476', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:28:45', NULL),
(189, 20, 'رنگ روغنی مکس اکیلویی 468', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:29:45', NULL),
(190, 20, 'رنگ روغنی مکس 1کیلویی 469', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:31:04', NULL),
(191, 20, 'رنگ روغنی مکس 1کیلویی 473', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:32:44', NULL),
(192, 20, 'رنگ روغنی مکس 1کیلویی 465', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:33:51', NULL),
(193, 20, 'رنگ روغنی مکس 1کیلویی 407', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:35:08', NULL),
(194, 20, 'رنگ روغنی مکس اکیلویی 407', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:37:39', NULL),
(195, 20, 'رنگ روغنی مکس اکیلویی 477', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:39:03', NULL),
(196, 20, 'رنگ روغنی مکس 1کیلویی 556', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 10:40:38', NULL),
(197, 20, 'رنگ روغنی مکس 1کیلویی 661', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:20:27', NULL),
(198, 20, 'رنگ روغنی مکس 1کیلویی 810', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:21:34', NULL),
(199, 20, 'رنگ روغنی مکس 1کیلویی 3076', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:23:03', NULL),
(200, 20, 'رنگ روغنی مکس اکیلویی 3034', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:25:03', NULL),
(201, 20, 'رنگ روغنی مکس اکیلویی 3072', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:26:40', NULL),
(202, 20, 'رنگ روغنی مکس اکیلویی 3075', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:28:44', NULL),
(203, 20, 'رنگ روغنی مکس اکیلویی 3050', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '\r\n', NULL, 'محمد رضا', 1, '2025-11-06 12:31:24', NULL),
(204, 20, 'رنگ روغنی مکس 1کیلویی 415', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:34:14', NULL),
(205, 20, 'رنگ روغنی مکس 1کیلویی 3078', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:35:29', NULL),
(206, 20, 'رنگ روغنی مکس 1کیلویی 3033', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:36:40', NULL),
(207, 20, 'رنگ روغنی مکس 1کیلویی 3022', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:38:09', NULL),
(208, 20, 'رنگ روغنی مکس اکیلویی 3011', NULL, 1568.00, 1920.00, 'رنگ روغنی مکس', 'کارتن', 16, 'کیلو ', 1, '', NULL, 'محمد رضا', 1, '2025-11-06 12:43:10', NULL),
(209, 20, 'رنگ روغنی براق نیم کیلویی افغان فیضی 049', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:13:08', '2025-11-08 16:29:44'),
(210, 20, 'رنگ روغنی براق نیم کیلو 105', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:16:32', '2025-11-08 16:29:29'),
(211, 20, 'رنگ روغنی براق نیم کیلویی 109', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:18:30', '2025-11-08 16:16:56'),
(212, 20, 'رنگ روغنی براق نیم کیلویی 133', NULL, 2304.00, 29040.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:20:01', '2025-11-08 16:29:10'),
(213, 20, 'رنگ روغنی براق نیم کیلویی 150', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:21:25', '2025-11-08 16:28:56'),
(214, 20, 'رنگ روغنی براق نیم کیلویی 176', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:22:38', '2025-11-08 16:28:34'),
(215, 20, 'رنگ روغنی براق نیم کیلویی 175', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:24:03', '2025-11-08 16:28:17'),
(216, 20, 'رنگ روغنی براق نیم کیلویی 185', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:26:35', '2025-11-08 16:27:59'),
(217, 20, 'رنگ روغنی براق نیم کیلویی 211', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:28:10', '2025-11-08 16:27:45'),
(218, 20, 'رنگ روغنی براق نیم کیلویی 206', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:29:43', '2025-11-08 16:18:11'),
(219, 20, 'رنگ روغنی براق نیم کیلویی 231', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:30:59', '2025-11-09 10:57:20'),
(220, 20, 'رنگ روغنی براق نیم کیلویی275', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:32:43', '2025-11-08 16:27:23'),
(221, 20, 'رنگ روغنی براق نیم کیلویی 300', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:34:29', '2025-11-08 16:20:49'),
(222, 20, 'رنگ روغنی براق نیم کیلویی 302', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:35:45', '2025-11-08 16:21:21'),
(223, 20, 'رنگ روغنی براق نیم کیلویی 331', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:36:52', '2025-11-08 16:26:58'),
(224, 20, 'رنگ روغنی براق نیم کیلویی 356', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:38:16', '2025-11-08 16:26:37'),
(225, 20, 'رنگ روغنی براق نیم کیلویی 390', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:45:46', '2025-11-08 16:22:20'),
(226, 20, 'رنگ روغنی براق نیم کیلویی 400', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:46:53', '2025-11-08 16:23:25'),
(227, 20, 'رنگ روغنی براق نیم کیلویی 401', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:48:16', '2025-11-08 16:26:25'),
(228, 20, 'رنگ روغنی براق نیم کیلویی 402', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:49:30', '2025-11-08 16:26:12'),
(229, 20, 'رنگ روغنی براق نیم کیلویی 404', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:52:09', '2025-11-08 16:25:38'),
(230, 20, 'رنگ روغنی براق نیم کیلویی 405', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 15:53:52', '2025-11-08 16:23:58'),
(231, 20, 'رنگ روغنی براق نیم کیلویی 406', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 16:11:09', '2025-11-08 16:24:27'),
(232, 20, 'رنگ روغنی براق نیم کیلویی 760', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 16:12:33', '2025-11-08 16:25:17'),
(233, 20, 'رنگ روغنی براق نیم کیلویی 411', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'محمد رضا', 1, '2025-11-08 16:14:06', '2025-11-08 16:25:03'),
(234, 20, 'رنگ روغنی براق نیم کیلویی 412', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:05:47', NULL),
(235, 20, 'رنگ روغنی براق نیم کیلویی 413', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:07:40', NULL),
(236, 20, 'رنگ روغنی براق نیم کیلویی 414', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:09:19', NULL),
(237, 20, 'رنگ روغنی براق نیم کیلویی 408', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:10:58', NULL),
(238, 20, 'رنگ روغنی براق نیم کیلویی 922', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:12:01', NULL),
(239, 20, 'رنگ روغنی براق نیم کیلویی 458', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:13:57', NULL),
(240, 20, 'رنگ روغنی براق نیم کیلویی 471', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:15:23', NULL),
(241, 20, 'رنگ روغنی براق نیم کیلویی 459', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:16:58', NULL),
(242, 20, 'رنگ روغنی براق نیم کیلویی 460', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:18:17', NULL),
(243, 20, 'رنگ روغنی براق نیم کیلویی 462', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:19:23', NULL),
(244, 20, 'رنگ روغنی براق نیم کیلویی 467', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:20:59', NULL),
(245, 20, 'رنگ روغنی براق نیم کیلویی 410', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:22:05', NULL),
(246, 20, 'رنگ روغنی براق نیم کیلویی 470', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:23:11', NULL),
(247, 20, 'رنگ روغنی براق نیم کیلویی 474', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:24:23', NULL),
(248, 20, 'رنگ روغنی براق نیم کیلویی 475', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:25:19', NULL),
(249, 20, 'رنگ روغنی براق نیم کیلویی 476', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:26:09', NULL),
(250, 20, 'رنگ روغنی براق نیم کیلویی 468', NULL, 2304.00, 29520.00, 'براق روغنی فیضی', 'کارتن', 24, NULL, 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:27:08', NULL),
(251, 20, 'رنگ روغنی براق نیم کیلویی 469', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:30:20', NULL),
(252, 20, 'رنگ روغنی براق نیم کیلویی 473', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:31:31', NULL),
(253, 20, 'رنگ روغنی براق نیم کیلویی 3034', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:32:59', NULL),
(254, 20, 'رنگ روغنی براق نیم کیلویی 3072', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:34:01', NULL),
(255, 20, 'رنگ روغنی براق نیم کیلویی 3075', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:36:08', NULL),
(256, 20, 'رنگ روغنی براق نیم کیلویی 3050', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:37:35', NULL),
(257, 20, 'رنگ روغنی براق نیم کیلویی 415', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:39:25', NULL),
(258, 20, 'رنگ روغنی براق نیم کیلویی 3078', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:41:15', NULL),
(259, 20, 'رنگ روغنی براق نیم کیلویی 3033', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:42:14', NULL),
(260, 20, 'رنگ روغنی براق نیم کیلویی 3022', NULL, 2640.00, 3120.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, '', NULL, 'محمد رضا', 1, '2025-11-09 10:43:42', NULL),
(261, 20, 'رنگ روغنی براق نیم کیلویی 3011', NULL, 2304.00, 2880.00, 'براق روغنی فیضی', 'کارتن', 24, 'قوطی', 1, NULL, NULL, 'ali', 1, '2025-11-09 10:44:35', '2025-11-09 11:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

DROP TABLE IF EXISTS `products_category`;
CREATE TABLE IF NOT EXISTS `products_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `global` tinyint NOT NULL,
  `product_category_name` varchar(124) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products_category`
--

INSERT INTO `products_category` (`id`, `branch_id`, `global`, `product_category_name`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 20, 0, 'adad', 1, '', '2025-11-03 12:02:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_batches`
--

DROP TABLE IF EXISTS `product_batches`;
CREATE TABLE IF NOT EXISTS `product_batches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `product_id` int NOT NULL,
  `package_price_buy` decimal(15,2) DEFAULT NULL,
  `package_price_sell` decimal(15,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `expiration_date` varchar(256) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_batches`
--

INSERT INTO `product_batches` (`id`, `branch_id`, `product_id`, `package_price_buy`, `package_price_sell`, `quantity`, `expiration_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 20, 1, 1000.00, 1200.00, NULL, '1762155324', 2, '2025-11-03 15:02:44', '2025-11-04 02:10:18'),
(2, 20, 1, 1000.00, 1200.00, NULL, '', 2, '2025-11-03 15:03:56', '2025-11-04 02:12:03'),
(3, 20, 1, 1000.00, 1200.00, NULL, '', 2, '2025-11-03 15:09:19', '2025-11-04 02:37:29'),
(4, 20, 1, 1000.00, 1200.00, NULL, '', 2, '2025-11-03 15:09:56', '2025-11-04 16:20:46'),
(5, 20, 1, 1000.00, 1200.00, NULL, '', 2, '2025-11-03 17:48:38', '2025-11-04 16:23:28'),
(6, 20, 1, 1000.00, 1200.00, NULL, '', 2, '2025-11-03 18:05:28', '2025-11-04 20:51:17'),
(7, 20, 1, 1000.00, 1200.00, NULL, '', 2, '2025-11-03 18:06:27', '2025-11-05 14:56:52'),
(8, 20, 1, 1000.00, 1200.00, NULL, '', 2, '2025-11-03 18:18:00', '2025-11-05 14:56:52'),
(9, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-03 18:19:27', '2025-11-05 15:24:48'),
(10, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-03 18:19:50', '2025-11-09 12:52:01'),
(11, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-03 22:31:16', '2025-11-09 12:52:38'),
(12, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-03 23:41:02', '2025-11-09 18:36:28'),
(13, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-03 23:44:36', '2025-11-11 18:03:17'),
(14, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-03 23:45:37', '2025-11-11 18:03:17'),
(15, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-03 23:46:11', '2025-11-11 18:03:17'),
(16, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-04 01:09:08', '2025-11-11 18:03:18'),
(17, 20, 1, 1000.00, 1200.00, NULL, '1762193', 2, '2025-11-04 02:13:10', '2025-11-11 18:03:18'),
(18, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-04 23:42:14', '2025-11-11 18:03:18'),
(19, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-04 23:42:56', '2025-11-11 18:03:18'),
(20, 20, 1, 1000.00, 1200.00, NULL, NULL, 2, '2025-11-04 23:49:58', '2025-11-11 18:03:18'),
(21, 20, 3, 20.00, 30.00, NULL, NULL, 2, '2025-11-05 15:24:25', '2025-11-05 15:24:48'),
(33, 20, 79, 800.00, 1080.00, NULL, NULL, 2, '2025-11-09 18:41:46', '2025-11-11 00:03:08'),
(34, 20, 83, 1500.00, 2000.00, NULL, NULL, 2, '2025-11-09 18:41:46', '2025-11-09 18:43:27'),
(35, 20, 1, 3168.00, 3360.00, NULL, NULL, 2, '2025-11-09 18:41:46', '2025-11-11 18:03:18'),
(36, 20, 55, 2976.00, 3360.00, NULL, NULL, 2, '2025-11-09 18:41:46', '2025-11-09 18:43:27'),
(37, 20, 57, 3520.00, 4000.00, 31, NULL, 1, '2025-11-09 18:41:46', '2025-11-09 18:43:27'),
(38, 20, 61, 3296.00, 3680.00, 59, NULL, 1, '2025-11-09 18:41:46', '2025-11-09 18:43:27'),
(39, 20, 13, 2976.00, 3360.00, NULL, NULL, 2, '2025-11-09 18:41:46', '2025-11-09 18:43:27'),
(40, 20, 254, 2304.00, 2880.00, NULL, NULL, 2, '2025-11-09 18:41:46', '2025-11-09 18:43:27'),
(41, 20, 56, 2976.00, 3360.00, NULL, NULL, 2, '2025-11-09 18:41:46', '2025-11-09 18:43:27'),
(42, 20, 80, 450.00, 600.00, 24, NULL, 1, '2025-11-09 18:41:46', NULL),
(43, 20, 77, 2000.00, 2200.00, NULL, NULL, 2, '2025-11-09 18:41:46', '2025-11-11 14:11:53'),
(45, 20, 79, 800.00, 1080.00, NULL, NULL, 2, '2025-11-10 23:35:04', '2025-11-11 01:37:11'),
(46, 20, 76, 900.00, 1000.00, NULL, NULL, 2, '2025-11-10 23:35:37', '2025-11-11 01:09:57'),
(52, 20, 78, 750.00, 850.00, NULL, NULL, 2, '2025-11-10 23:41:07', '2025-11-11 01:23:03'),
(56, 20, 78, 750.00, 850.00, NULL, NULL, 2, '2025-11-10 23:47:53', '2025-11-11 01:42:46'),
(57, 20, 78, 750.00, 850.00, NULL, NULL, 2, '2025-11-10 23:48:17', '2025-11-11 01:48:52'),
(58, 20, 1, 3168.00, 3360.00, NULL, NULL, 2, '2025-11-10 23:49:19', '2025-11-11 18:03:18'),
(59, 20, 6, 2976.00, 3360.00, 16, NULL, 1, '2025-11-10 23:52:25', NULL),
(60, 20, 3, 2976.00, 3360.00, NULL, NULL, 2, '2025-11-10 23:52:40', '2025-11-10 23:54:58'),
(61, 20, 1, 3168.00, 3360.00, NULL, NULL, 2, '2025-11-10 23:58:23', '2025-11-11 18:03:18'),
(62, 20, 6, 2976.00, 3360.00, 16, NULL, 1, '2025-11-10 23:58:52', NULL),
(63, 20, 1, 3168.00, 3360.00, NULL, NULL, 2, '2025-11-11 00:00:03', '2025-11-12 00:09:52'),
(64, 20, 79, 800.00, 1080.00, NULL, NULL, 2, '2025-11-11 00:02:51', '2025-11-11 01:50:07'),
(65, 20, 77, 2000.00, 2200.00, 24, NULL, 1, '2025-11-11 14:11:37', '2025-11-12 00:09:52'),
(66, 20, 83, 1500.00, 2000.00, NULL, NULL, 2, '2025-11-11 18:17:59', '2025-11-12 00:09:52'),
(67, 20, 77, 2000.00, 2200.00, 1, NULL, 1, '2025-11-11 21:50:29', NULL),
(77, 20, 79, 800.00, 1080.00, NULL, NULL, 2, '2025-11-11 23:40:57', '2025-11-12 23:03:43'),
(78, 20, 13, 2976.00, 3360.00, 16, NULL, 1, '2025-11-11 23:40:57', NULL),
(79, 20, 77, 2000.00, 2200.00, 6, NULL, 1, '2025-11-11 23:40:57', NULL),
(80, 20, 78, 750.00, 850.00, NULL, NULL, 2, '2025-11-11 23:40:57', '2025-11-14 20:28:28'),
(81, 20, 1, 3168.00, 3360.00, 15, NULL, 1, '2025-11-11 23:40:57', '2025-11-12 00:09:52'),
(82, 20, 79, 800.00, 1080.00, 9, NULL, 1, '2025-11-11 23:43:37', NULL),
(83, 20, 54, 2976.00, 3360.00, 34, NULL, 1, '2025-11-11 23:43:37', NULL),
(84, 20, 3, 2976.00, 3360.00, NULL, NULL, 2, '2025-11-12 22:30:08', '2025-11-12 22:42:48'),
(85, 20, 6, 2976.00, 3360.00, 32, NULL, 1, '2025-11-12 22:43:00', NULL),
(86, 20, 78, 750.00, 850.00, 1, NULL, 1, '2025-11-12 23:03:52', NULL),
(87, 20, 78, 750.00, 850.00, 1, NULL, 1, '2025-11-12 23:54:25', NULL),
(88, 20, 78, 750.00, 850.00, 1, NULL, 1, '2025-11-14 20:11:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

DROP TABLE IF EXISTS `product_cat`;
CREATE TABLE IF NOT EXISTS `product_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `global` tinyint NOT NULL,
  `product_cat_name` varchar(124) NOT NULL,
  `who_it` varchar(60) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`id`, `branch_id`, `global`, `product_cat_name`, `who_it`, `status`, `created_at`, `updated_at`) VALUES
(1, 20, 0, 'test cat', '', 1, '2025-11-03 12:01:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `safe_transactions`
--

DROP TABLE IF EXISTS `safe_transactions`;
CREATE TABLE IF NOT EXISTS `safe_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_title` varchar(256) NOT NULL,
  `amount` int NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `money_invoice` varchar(256) DEFAULT NULL,
  `type` varchar(14) NOT NULL,
  `who_it` varchar(30) NOT NULL,
  `year` smallint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 => active, 2 => deactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `year` (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(124) DEFAULT NULL,
  `password` varchar(124) DEFAULT NULL,
  `is_customer` tinyint DEFAULT NULL,
  `is_seller` tinyint DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `user_image` varchar(254) DEFAULT NULL,
  `father_name` varchar(30) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_name` (`user_name`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `branch_id`, `user_name`, `phone`, `email`, `password`, `is_customer`, `is_seller`, `address`, `description`, `user_image`, `father_name`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(1, 20, 'عمومی', '1', NULL, NULL, 1, 1, '', '', NULL, '', 1, 'محمد رضا', '2025-11-04 11:39:44', NULL),
(4, 20, 'احمد حسینی 1', '0799', NULL, NULL, 1, 1, 'چوک گلها سنتر', NULL, '2025-11-10-15-43-43_6911c8e7099e3.jpg', NULL, 1, 'احمد رضا', '2025-11-09 18:38:44', '2025-11-11 14:31:33'),
(5, 20, 'hamdi rezaee', '66', NULL, NULL, 1, 1, 'herat', 'desc', '2025-11-11-14-32-12_691309a42b926.jpg', 'ali', 1, 'احمد رضا', '2025-11-11 14:32:12', NULL),
(6, 20, 'محمد رضا احمدی', '0799999999', NULL, '$2y$10$fVhSna7IN1cVEKlJezadnuQ0zU/vDhUTJPZ5iWd0/7p78rZyJ1TGa', 1, 1, 'هرات چوک گلها', 'توضیحات', '2025-11-11-21-57-57_6913721d5a467.jpg', 'غلام', 1, 'احمد رضا', '2025-11-11 21:57:57', '2025-11-11 22:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `users_transactions`
--

DROP TABLE IF EXISTS `users_transactions`;
CREATE TABLE IF NOT EXISTS `users_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `ref_id` varchar(32) DEFAULT NULL,
  `user_id` int NOT NULL,
  `transaction_type` tinyint NOT NULL DEFAULT '1' COMMENT '1 -> sale, 2 -> buy, 3 -> return for sale, 4 -> return for purchars, 5 -> Taking money from the user, 6 -> paying money to the user',
  `total_price` decimal(15,2) DEFAULT NULL,
  `paid_amount` decimal(15,2) DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `balance` decimal(15,2) NOT NULL,
  `year` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `month` tinyint NOT NULL,
  `transaction_date` varchar(124) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seller_id` (`user_id`),
  KEY `created_at` (`created_at`),
  KEY `transaction_type` (`transaction_type`),
  KEY `transaction_date` (`transaction_date`),
  KEY `ref_id` (`ref_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users_transactions`
--

INSERT INTO `users_transactions` (`id`, `branch_id`, `ref_id`, `user_id`, `transaction_type`, `total_price`, `paid_amount`, `discount`, `balance`, `year`, `month`, `transaction_date`, `status`, `who_it`, `created_at`, `updated_at`) VALUES
(169, 20, 'S251112-2', 4, 1, 1080.00, 0.00, 0.00, -1080.00, '1404', 8, '1762972420', 1, 'احمد رضا 1', '2025-11-12 23:03:43', NULL),
(170, 20, 'P251112-3', 4, 2, 750.00, 0.00, 0.00, -330.00, '1404', 8, '1762972430', 1, 'احمد رضا 1', '2025-11-12 23:03:52', NULL),
(171, 20, 'R251112-32', 4, 5, NULL, 500.00, NULL, 170.00, '1404', 8, '1762972474', 1, 'احمد رضا 1', '2025-11-12 23:04:40', NULL),
(172, 20, 'W251112-33', 4, 6, NULL, 450.00, NULL, -280.00, '1404', 8, '1762972499', 1, 'احمد رضا 1', '2025-11-12 23:05:04', NULL),
(173, 20, 'RS251112-4', 4, 3, 750.00, 0.00, 0.00, 470.00, '1404', 8, '1762975463', 1, 'احمد رضا 1', '2025-11-12 23:54:25', NULL),
(174, 20, 'RP251112-5', 4, 4, 2000.00, 0.00, NULL, -1530.00, '1404', 8, '1762975478', 1, 'احمد رضا 1', '2025-11-12 23:54:43', NULL),
(175, 20, 'P251114-7', 4, 2, 750.00, 0.00, 0.00, -780.00, '1404', 8, '1763134874', 1, 'احمد رضا 1', '2025-11-14 20:11:16', NULL),
(176, 20, 'S251114-8', 4, 1, 850.00, 50.00, 0.00, -1580.00, '1404', 8, '1763135902', 1, 'احمد رضا 1', '2025-11-14 20:28:28', NULL);

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
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `warehouse_name` varchar(256) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `branch_id` int NOT NULL,
  `manager_id` int DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `who_it` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
