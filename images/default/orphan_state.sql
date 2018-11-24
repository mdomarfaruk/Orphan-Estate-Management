-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 11:57 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orphan_state`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_chart_of_accounts`
--

CREATE TABLE `acc_chart_of_accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `parent_id` int(11) UNSIGNED DEFAULT NULL,
  `details` varchar(100) NOT NULL DEFAULT '',
  `code` int(11) UNSIGNED NOT NULL,
  `type_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'meaning type of chart ids, Like income, expense, asset , liabilities &amp; equity 1 = asset, 3 = income, 4 = Expense',
  `head_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = Main, 1 = User Generated, 2 = System Generated',
  `opt_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Operation Type. 1 = Credit, 2 = Debit',
  `vat_type` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 = No Vat, 1 = Vat Exclude, 2 = Vat Include',
  `adjustment_group` tinyint(1) UNSIGNED DEFAULT '0' COMMENT 'To handle show hide from adjustment entry panel. 0 = False, 1 = True',
  `branch_id` smallint(6) UNSIGNED DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 3 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc_chart_of_accounts`
--

INSERT INTO `acc_chart_of_accounts` (`id`, `name`, `parent_id`, `details`, `code`, `type_id`, `head_type`, `opt_type`, `vat_type`, `adjustment_group`, `branch_id`, `created_time`, `updated_at`, `created_at`, `is_active`) VALUES
(1, 'Asset', NULL, '', 10000000, 1, 0, 1, 0, 0, NULL, '2018-11-01 15:27:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Current Asset', 1, '', 10100000, 1, 1, 1, 0, 0, NULL, '2018-11-01 15:28:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'Fixed Asset', 1, '', 10200000, 1, 1, 1, 0, 0, NULL, '2018-11-01 15:28:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'Bank Group', 2, '', 10101000, 1, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 'Cash & cash Equivalent', 2, '', 10102000, 1, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 'Main Cash', 5, '', 10102001, 1, 2, 1, 0, 0, NULL, '2018-11-01 15:34:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 'DBBL', 4, '', 10101001, 1, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(8, 'Income', NULL, '', 30000000, 3, 0, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(9, 'Direct Income', 8, '', 30100000, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(10, 'Indirect Income', 8, '', 30200000, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(11, 'সরকারের অনুদান', 9, '', 30101000, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(12, 'সরকারের অনুদান- (1%)', 11, '', 30101001, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(13, 'রশিদের মাধ্যমে আদায়', 9, '', 30102000, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(14, 'বড় দান বাক্স', 9, '', 30103000, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(15, 'ছোট দান বাক্স', 9, '', 30104000, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(16, 'কৃষি পন্য বিক্রয়', 9, '', 30105000, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(17, 'ধান বিক্রয়', 16, '', 30105001, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(18, 'চাল বিক্রয়', 16, '', 30105002, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(19, 'মাছ বিক্রয়', 16, '', 30105003, 3, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(20, 'Expense', NULL, '', 40000000, 3, 0, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(21, 'এতিমের পতিপালন', 20, '', 40101000, 4, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(22, 'কর্মচারীর বেতন', 20, '', 40102000, 4, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(23, 'শিক্ষকের বেতন', 20, '', 40103000, 4, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(24, 'উন্নায়ন ব্যয়', 20, '', 40105000, 4, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(25, 'মেরামত ', 20, '', 40105000, 4, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(26, 'অন্যান্য ব্যয়', 20, '', 40106000, 4, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(27, 'কৃষি - চাষা বাদ', 20, '', 40107000, 4, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(28, 'মাছ চাষ', 20, '', 40108000, 4, 1, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(29, 'খাবার ও অন্যান্য', 21, '', 40101001, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(30, 'চিকিৎসা', 21, '', 40101002, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(31, 'কাপড়-চোপড়', 21, '', 40101003, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(32, 'বই-খাতা', 21, '', 40101004, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(33, 'নতুন ভবন তৈরি', 24, '', 40105001, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(34, 'নতুন ভবনের জায়গা ক্রয়', 24, '', 40105002, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(35, 'পুরাতন ভবন মেরামত ', 25, '', 40105001, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(36, 'মসজিদ', 28, '', 40106001, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(37, 'স্টেশনারী', 28, '', 40106002, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(38, 'ধান চাষ', 27, '', 40107001, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(39, 'মাছ চাষ ব্যায়', 28, '', 40108001, 4, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(40, 'লিল্লাহ', 13, 'Money receipt(Donar)', 30102001, 3, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(41, 'যাকাত', 13, 'Money receipt(Donar)', 30102002, 3, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(42, 'হাদিয়া', 13, 'Money receipt(Donar)', 30102003, 3, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(43, 'দৈনিক খাবার', 13, 'Money receipt(Donar)', 30102004, 3, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(44, 'শিক্ষা', 13, 'Money receipt(Donar)', 30102005, 3, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(45, 'মসজিদ', 13, 'Money receipt(Donar)', 30102006, 3, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(46, 'মিলাদ', 13, 'Money receipt(Donar)', 30102007, 3, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(47, 'অন্যান্য', 13, 'Money receipt(Donar)', 30102008, 3, 2, 1, 0, 0, NULL, '2018-11-01 15:32:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(48, 'Box-4', 14, 'Donation Box Group', 30103001, NULL, 2, 1, 0, 0, NULL, '2018-11-06 04:03:40', '2018-11-06 12:56:05', '2018-11-06 04:03:40', 1),
(49, 'Box-3', 14, 'Donation Box Group', 30103002, 3, 2, 1, 0, 0, NULL, '2018-11-06 04:07:13', '2018-11-06 12:55:56', '2018-11-06 04:07:13', 1),
(50, 'Box-2', 14, 'Donation Box Group', 30103003, 3, 2, 1, 0, 0, NULL, '2018-11-06 05:13:45', '2018-11-06 12:55:48', '2018-11-06 05:13:45', 1),
(51, 'Box-1', 14, 'Donation Box Group', 30103004, 3, 2, 1, 0, 0, NULL, '2018-11-06 07:11:52', '2018-11-06 12:55:38', '2018-11-06 07:11:52', 1),
(52, 'BRAC Bank d', 4, 'Bank Group Group', 10101002, 1, 2, 1, 0, 0, NULL, '2018-11-07 00:56:24', '2018-11-07 02:27:16', '2018-11-07 00:56:24', 1),
(53, 'DBBL', 4, 'Bank Group', 10101003, 1, 2, 1, 0, 0, NULL, '2018-11-07 02:27:39', '2018-11-07 02:27:39', '2018-11-07 02:27:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acc_invoices`
--

CREATE TABLE `acc_invoices` (
  `id` int(20) UNSIGNED NOT NULL,
  `record_type` tinyint(3) UNSIGNED NOT NULL COMMENT '1 = donar(money receipt), 2 = donation box, 3 = bank_receipt, 4 = other_receipt,  5 =  cash payment, 6 = bank payment ',
  `record_date` date NOT NULL,
  `inv_amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT '0.00',
  `net_amount` decimal(10,2) NOT NULL,
  `is_paid` tinyint(1) UNSIGNED DEFAULT '1' COMMENT '1 = Yes(paid), 0 = No(paid) ',
  `generate_type` tinyint(1) UNSIGNED DEFAULT '1' COMMENT '1 = Manual Generate, 0 = system generate',
  `received_by` int(11) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = delete,1 = active, 2 = inactive',
  `is_modifiy` tinyint(1) DEFAULT '0' COMMENT '1 = Yes(modifiy), 0 = No(modifiy) ',
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(15) NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc_invoices`
--

INSERT INTO `acc_invoices` (`id`, `record_type`, `record_date`, `inv_amount`, `discount`, `net_amount`, `is_paid`, `generate_type`, `received_by`, `bank_id`, `transaction_id`, `is_active`, `is_modifiy`, `created_by`, `created_time`, `created_ip`, `updated_by`, `updated_time`, `updated_ip`) VALUES
(1, 2, '2018-11-08', '5100.00', '0.00', '5100.00', 1, 1, 1, NULL, '18110807433523', 1, 0, 1, '2018-11-08 13:43:35', '::1', NULL, NULL, NULL),
(2, 1, '2018-11-08', '1000.00', '0.00', '1000.00', 1, 1, 1, NULL, '18110807454189', 1, 0, 1, '2018-11-08 13:45:41', '::1', NULL, NULL, NULL),
(3, 3, '2018-11-08', '1000.00', '0.00', '1000.00', 1, 1, 1, NULL, '18110807462179', 1, 0, 1, '2018-11-08 13:46:21', '::1', NULL, NULL, NULL),
(4, 5, '2018-11-08', '100.00', '0.00', '100.00', 1, 1, 1, NULL, '18110807470232', 1, 0, 1, '2018-11-08 13:47:02', '::1', NULL, NULL, NULL),
(5, 6, '2018-11-08', '1500.00', '0.00', '1500.00', 1, 1, 1, NULL, '18110807473781', 1, 0, 1, '2018-11-08 13:47:37', '::1', NULL, NULL, NULL),
(6, 6, '2018-11-08', '45500.00', '0.00', '45500.00', 1, 1, 1, NULL, '18110807550268', 1, 0, 1, '2018-11-08 13:55:02', '::1', NULL, NULL, NULL),
(7, 5, '2018-11-12', '200.00', '0.00', '200.00', 1, 1, 1, NULL, '18111210445615', 0, 0, 1, '2018-11-12 10:46:05', '::1', 1, '2018-11-12 04:46:05', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `acc_invoices_details`
--

CREATE TABLE `acc_invoices_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `book_no` varchar(50) DEFAULT NULL,
  `receipt_no` varchar(50) DEFAULT NULL,
  `donar_name_id` int(11) UNSIGNED DEFAULT NULL,
  `acc_chart_of_account_id` int(11) UNSIGNED NOT NULL COMMENT 'maintain debit account Id',
  `credited_chart_of_acc` int(11) UNSIGNED DEFAULT NULL,
  `note` text,
  `amount` decimal(10,2) NOT NULL,
  `box_no` int(11) UNSIGNED DEFAULT NULL,
  `collected_by_id` int(11) UNSIGNED DEFAULT NULL,
  `withness_id` int(11) UNSIGNED DEFAULT NULL,
  `bank_id` mediumint(11) UNSIGNED DEFAULT NULL,
  `cheque_no` varchar(30) DEFAULT NULL,
  `vouchar_no` varchar(30) DEFAULT NULL,
  `payee_id` int(11) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(15) NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc_invoices_details`
--

INSERT INTO `acc_invoices_details` (`id`, `invoice_id`, `book_no`, `receipt_no`, `donar_name_id`, `acc_chart_of_account_id`, `credited_chart_of_acc`, `note`, `amount`, `box_no`, `collected_by_id`, `withness_id`, `bank_id`, `cheque_no`, `vouchar_no`, `payee_id`, `is_active`, `created_by`, `created_time`, `created_ip`, `updated_by`, `updated_time`, `updated_ip`) VALUES
(1, 1, NULL, NULL, NULL, 6, 49, 'donation box amount 5000 tk received', '5000.00', NULL, 3, 8, NULL, NULL, NULL, NULL, 1, 1, '2018-11-08 13:43:35', '::1', NULL, NULL, NULL),
(2, 1, NULL, NULL, NULL, 6, 51, 'donation box amount  100 received karim', '100.00', NULL, 30, 6, NULL, NULL, NULL, NULL, 1, 1, '2018-11-08 13:43:35', '::1', NULL, NULL, NULL),
(3, 2, 'book-12', '15000', 4, 6, 40, '100k receive', '1000.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-11-08 13:45:41', '::1', NULL, NULL, NULL),
(4, 3, NULL, NULL, NULL, 6, 7, 'key person', '1000.00', NULL, NULL, NULL, NULL, 'dbbl-15000', NULL, NULL, 1, 1, '2018-11-08 13:46:21', '::1', NULL, NULL, NULL),
(5, 4, NULL, NULL, NULL, 29, NULL, 'dhoha', '100.00', NULL, NULL, NULL, NULL, NULL, 'vouchar', 31, 1, 1, '2018-11-08 13:47:02', '::1', NULL, NULL, NULL),
(6, 5, NULL, NULL, NULL, 30, NULL, 'sdf', '1500.00', NULL, NULL, NULL, 7, NULL, 'vour', 32, 1, 1, '2018-11-08 13:47:37', '::1', NULL, NULL, NULL),
(7, 6, NULL, NULL, NULL, 29, 7, 'hello', '45500.00', NULL, NULL, NULL, 7, NULL, 'vouchar -450', 17, 1, 1, '2018-11-08 13:55:02', '::1', NULL, NULL, NULL),
(8, 7, NULL, NULL, NULL, 30, 6, NULL, '150.00', NULL, NULL, NULL, NULL, NULL, 'vouchar-150', 17, 0, 1, '2018-11-12 10:46:05', '::1', 1, '2018-11-12 04:46:05', '::1'),
(9, 7, NULL, NULL, NULL, 30, 6, '3', '50.00', NULL, NULL, NULL, NULL, NULL, '3', 16, 0, 1, '2018-11-12 10:46:05', '::1', 1, '2018-11-12 04:46:05', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `acc_transaction`
--

CREATE TABLE `acc_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) UNSIGNED NOT NULL,
  `debit_id` int(11) UNSIGNED DEFAULT NULL,
  `credit_id` int(11) UNSIGNED DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_by_ip` varchar(15) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 = delete, 1 = active, 2 = inactive ',
  `comments` text,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT NULL,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc_transaction`
--

INSERT INTO `acc_transaction` (`id`, `invoice_id`, `amount`, `debit_id`, `credit_id`, `created_by`, `created_by_ip`, `created_time`, `is_active`, `comments`, `updated_by`, `updated_time`, `updated_ip`) VALUES
(1, 1, '5000.00', 6, 49, 1, '::1', '2018-11-08 13:43:35', 1, 'donation box amount 5000 tk received', NULL, NULL, NULL),
(2, 1, '100.00', 6, 51, 1, '::1', '2018-11-08 13:43:35', 1, 'donation box amount  100 received karim', NULL, NULL, NULL),
(3, 2, '1000.00', 6, 40, 1, '::1', '2018-11-08 13:45:41', 1, '100k receive', NULL, NULL, NULL),
(4, 3, '1000.00', 6, 7, 1, '::1', '2018-11-08 13:46:21', 1, 'key person', NULL, NULL, NULL),
(5, 4, '100.00', 29, 6, 1, '::1', '2018-11-08 13:47:02', 1, 'dhoha', NULL, NULL, NULL),
(6, 5, '1500.00', 30, 7, 1, '::1', '2018-10-10 13:47:37', 1, 'sdf', NULL, NULL, NULL),
(7, 6, '45500.00', 29, 7, 1, '::1', '2018-11-10 18:00:00', 1, 'hello', NULL, NULL, NULL),
(8, 7, '150.00', 30, 6, 1, '::1', '2018-11-12 04:44:56', 0, NULL, 1, '2018-11-12 04:46:05', '::1'),
(9, 7, '50.00', 30, 6, 1, '::1', '2018-11-12 04:44:56', 0, '3', 1, '2018-11-12 04:46:05', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `all_sttings`
--

CREATE TABLE `all_sttings` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` tinyint(4) UNSIGNED DEFAULT NULL COMMENT '1= designaion 2= department  , 3= role',
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1= active 2= inactive, 3= delete',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_sttings`
--

INSERT INTO `all_sttings` (`id`, `type`, `title`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sales man', 2, NULL, NULL, '2018-10-25 21:46:41'),
(2, 1, 'হিসাবরক্ষক', 1, NULL, '2018-10-23 09:25:36', '2018-10-25 21:50:31'),
(3, 1, 'asdf', 2, NULL, '2018-10-23 09:26:01', '2018-10-23 12:21:31'),
(4, 1, 'hello data dd', 2, NULL, '2018-10-23 09:26:13', '2018-10-23 12:21:22'),
(5, 1, 'hello ddata', 2, NULL, '2018-10-23 12:05:09', '2018-10-23 12:20:37'),
(6, 1, 'dd', 2, NULL, '2018-10-23 12:07:01', '2018-10-23 12:20:06'),
(7, 2, 'হিসাব সেখশান', 1, NULL, '2018-10-23 12:35:45', '2018-10-25 21:51:38'),
(8, 2, 'কওমি সেকশান', 1, NULL, '2018-10-23 12:36:21', '2018-10-25 21:51:25'),
(9, 2, 'hello data', 2, NULL, '2018-10-23 12:36:43', '2018-10-23 12:39:46'),
(10, 2, 'test d', 2, NULL, '2018-10-23 12:36:50', '2018-10-23 12:37:27'),
(11, 2, 'হাদিস সেকশান', 1, NULL, '2018-10-23 12:40:09', '2018-10-25 21:51:07'),
(12, 3, '33', 2, NULL, '2018-10-23 12:54:31', '2018-10-23 12:55:46'),
(13, 3, 'ddd', 2, NULL, '2018-10-23 12:54:58', '2018-10-23 12:55:39'),
(14, 3, 'ম্যানাজার', 1, NULL, '2018-10-23 12:55:53', '2018-10-25 21:52:14'),
(15, 3, 'সুপার এডমিন', 1, NULL, '2018-10-23 12:55:59', '2018-10-25 21:51:59'),
(16, 1, 'মোলভী', 1, NULL, '2018-10-25 21:50:07', '2018-10-25 21:50:07'),
(17, 1, 'মাওলানা', 1, NULL, '2018-10-25 21:50:18', '2018-10-25 21:50:18'),
(18, 3, 'অপারেটর', 1, NULL, '2018-10-25 23:19:05', '2018-10-25 23:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `bank_infos`
--

CREATE TABLE `bank_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc_chart_of_account_id` int(11) UNSIGNED NOT NULL,
  `account_no` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_telephone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=active, 2=inactive, 0=delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_infos`
--

INSERT INTO `bank_infos` (`id`, `acc_chart_of_account_id`, `account_no`, `bank_address`, `author_name`, `author_address`, `author_telephone`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 0, '0001-0002-0003', 'Dhanmondi', 'Mr Omar Faruk', 'Nowakhali', '01839468452', 1, NULL, '2018-10-25 14:02:52'),
(2, 0, 'hello the world', 'feni', 'shohag', 'lemua d', '0183976452', 1, '2018-10-25 13:59:29', '2018-10-25 14:03:39'),
(3, 52, '001-002', 'dhaka', 'sha alam', 'dhaka', '018300222', 1, '2018-11-07 00:56:24', '2018-11-07 00:56:24'),
(4, 53, '001-002-003', 'dhaka', 'omar faruk', 'dhaka', '0183976455', 1, '2018-11-07 02:27:39', '2018-11-07 02:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `collector_withness_info`
--

CREATE TABLE `collector_withness_info` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = collector, 2 = withness ',
  `title` varchar(80) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `collector_withness_info`
--

INSERT INTO `collector_withness_info` (`id`, `type`, `title`, `created_by`, `created_time`, `created_ip`) VALUES
(1, 1, '33', 1, '2018-11-06 12:47:19', '::1'),
(2, 2, '33', 1, '2018-11-06 12:47:19', '::1'),
(3, 1, 'kamal', 1, '2018-11-06 12:51:13', '::1'),
(4, 2, 'hssan', 1, '2018-11-06 12:51:13', '::1'),
(5, 1, 'jamal', 1, '2018-11-06 12:51:13', '::1'),
(6, 2, 'karim', 1, '2018-11-06 12:51:13', '::1'),
(7, 1, 'Karim', 1, '2018-11-06 12:56:38', '::1'),
(8, 2, 'Rahim', 1, '2018-11-06 12:56:38', '::1'),
(9, 1, 'w', 1, '2018-11-06 22:35:12', '::1'),
(10, 2, 'ww', 1, '2018-11-06 22:35:12', '::1'),
(11, 1, '3', 1, '2018-11-06 22:35:12', '::1'),
(12, 2, '3', 1, '2018-11-06 22:35:12', '::1'),
(13, 1, '11', 1, '2018-11-07 02:53:22', '::1'),
(14, 2, '11', 1, '2018-11-07 02:53:23', '::1'),
(15, 3, '3', 1, '2018-11-07 04:03:21', '::1'),
(16, 3, '33', 1, '2018-11-07 04:03:22', '::1'),
(17, 3, 'shohag', 1, '2018-11-07 04:04:20', '::1'),
(18, 3, '22', 1, '2018-11-07 05:06:28', '::1'),
(19, 3, '4', 1, '2018-11-07 06:27:38', '::1'),
(20, 3, '11', 1, '2018-11-07 06:52:19', '::1'),
(21, 3, '44', 1, '2018-11-07 06:52:20', '::1'),
(22, 1, 'ss', 1, '2018-11-07 07:23:45', '::1'),
(23, 2, 's', 1, '2018-11-07 07:23:45', '::1'),
(24, 3, 'rahim', 1, '2018-11-08 07:29:48', '::1'),
(25, 3, 'shamim', 1, '2018-11-08 09:42:55', '::1'),
(26, 3, 'shimul', 1, '2018-11-08 09:42:55', '::1'),
(27, 3, 'dd', 1, '2018-11-08 12:47:07', '::1'),
(28, 1, '223', 1, '2018-11-08 13:12:17', '::1'),
(29, 2, '22', 1, '2018-11-08 13:12:17', '::1'),
(30, 1, 'rahim', 1, '2018-11-08 13:43:35', '::1'),
(31, 3, 'ska', 1, '2018-11-08 13:47:02', '::1'),
(32, 3, 'hami', 1, '2018-11-08 13:47:37', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `donar_infos`
--

CREATE TABLE `donar_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=active, 2=inactive, 0=delete',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donar_infos`
--

INSERT INTO `donar_infos` (`id`, `name`, `address`, `email`, `mobile`, `note`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abdullah sagor', 'dhaka', 'shoag@gmail.com', '0183456565', 'dhkaa', 2, NULL, NULL, '2018-11-06 06:56:48'),
(2, 'Hossain', 'nohakhali', 'asdf', 'asdf', 'asdf', 1, NULL, '2018-10-25 14:33:47', '2018-10-25 14:33:47'),
(3, 'kamal', 'Chittagong', '3', '3', '33', 2, NULL, '2018-10-25 14:53:05', '2018-10-25 21:47:39'),
(4, 'Rahim', 'Feni', 'dhaka@gmail.com', '0189746', 'dhaka', 1, NULL, '2018-10-25 21:25:21', '2018-10-25 21:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `donation_boxes`
--

CREATE TABLE `donation_boxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `box_type` tinyint(1) UNSIGNED DEFAULT NULL,
  `acc_chart_of_account_id` int(11) UNSIGNED DEFAULT NULL,
  `box_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custodian_name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `established_date` date NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=active, 2=inactive, 0=delete',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_boxes`
--

INSERT INTO `donation_boxes` (`id`, `box_type`, `acc_chart_of_account_id`, `box_location`, `custodian_name`, `established_date`, `note`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'asdf', 'asdf', '2018-10-17', 'qqq', 0, NULL, '2018-10-26 00:02:05', '2018-11-06 06:59:54'),
(2, 1, 48, '3', '3', '2018-11-08', 'asdfsadf', 1, NULL, '2018-11-06 04:03:40', '2018-11-06 07:00:07'),
(3, 1, 49, '3', 'karim', '2018-11-06', 'asdf', 1, NULL, '2018-11-06 04:07:13', '2018-11-06 04:07:13'),
(4, 2, 50, 'hello the sdf\r\ndfasf\r\nasdf', 'd', '2018-11-15', 'hell thei woed\r\nasdfhaosh a\r\narare oy', 1, NULL, '2018-11-06 05:13:45', '2018-11-06 06:56:04'),
(5, 1, 51, 'hello', 'dkak dafs', '2018-11-05', 'asdf asdf ddd', 1, NULL, '2018-11-06 07:11:52', '2018-11-06 07:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(16, '2014_10_12_000000_create_users_table', 1),
(17, '2014_10_12_100000_create_password_resets_table', 1),
(18, '2018_10_18_160335_create_orphan_infos_table', 1),
(19, '2018_10_23_122109_create_all_settings_table', 1),
(20, '2018_10_23_124712_create_staff_infos_table', 1),
(21, '2018_10_25_171952_create_bank_infos_table', 2),
(22, '2018_10_25_200644_create_donar_infos_table', 3),
(23, '2018_10_26_054332_create_donation_boxs_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_openings`
--

CREATE TABLE `monthly_openings` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `modify_last_date` date DEFAULT NULL,
  `sorting` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '3' COMMENT '0 = delete, 1 = running, 2 = previous, 3 = next  ',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(15) NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `monthly_openings`
--

INSERT INTO `monthly_openings` (`id`, `title`, `start_date`, `end_date`, `modify_last_date`, `sorting`, `status`, `created_by`, `created_at`, `created_ip`, `updated_by`, `updated_at`, `updated_ip`) VALUES
(1, 'November - 2018', '2018-11-01', '2018-11-30', '2018-12-05', 1, 1, 1, '2018-11-11 08:05:37', '127.0.0.1', NULL, NULL, NULL),
(2, 'Octobar - 2018', '2018-10-01', '2018-10-30', '2018-12-05', 1, 2, 1, '2018-11-11 12:43:40', '127.0.0.1', NULL, NULL, NULL),
(3, 'December- 2018', '2018-12-01', '2018-12-30', '2018-12-26', 3, 2, 1, '2018-11-12 04:33:08', '::1', NULL, '2018-11-12 04:33:08', NULL),
(4, 'u', '2019-01-10', '1970-01-01', '1970-01-01', 7, 0, 1, '2018-11-12 10:40:48', '::1', NULL, '2018-11-12 04:40:48', NULL),
(5, 'u', '1970-01-01', '1970-01-01', '1970-01-01', 7, 0, 1, '2018-11-12 10:40:51', '::1', NULL, '2018-11-12 04:40:51', NULL),
(6, 'hello the world', '2018-11-06', '2018-11-21', '2018-11-07', 3, 2, 1, '2018-11-12 04:38:37', '::1', NULL, '2018-11-12 04:38:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orphan_infos`
--

CREATE TABLE `orphan_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `orphan_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_eng` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bng` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gardian_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `admission_date` date NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orphan_infos`
--

INSERT INTO `orphan_infos` (`id`, `orphan_id`, `name_eng`, `name_bng`, `father_name`, `mother_name`, `gardian_name`, `mobile_no`, `address`, `birth_date`, `admission_date`, `photo`, `details`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1540062320', 'sdf', 'asdf', 'asdf', 'adf', 'asdf', '01839707645', 'asdf', '2018-10-20', '2018-10-10', NULL, NULL, 2, NULL, '2018-10-20 13:05:20', '2018-10-22 09:23:33'),
(2, '1540062435', 'sdf', 'asdf', 'asdf', 'adf', 'asdf', 'dd', 'asdf', '2018-10-20', '2018-10-10', NULL, NULL, 2, NULL, '2018-10-20 13:07:16', '2018-10-25 23:07:05'),
(3, '1540063804', 'sdaf', 'asdf', 'asdf', 'asdf', 'asdf', '3', 'asdf', '2018-10-25', '2018-10-18', NULL, NULL, 2, NULL, '2018-10-20 13:30:04', '2018-10-23 12:22:06'),
(4, '1540180048', 'ss', 'ss', 'ss', 's', 's', '3', 's', '2018-10-22', '2018-10-22', NULL, NULL, 2, NULL, '2018-10-21 21:47:28', '2018-10-22 09:29:23'),
(5, '1540221217', 'mehedi hassan', 'মেহেদী হাসান', 'বাবা', 'মা', 'অভিবাভক', '01839764555', 'dhaka', '1999-10-20', '2018-10-10', NULL, NULL, 2, NULL, '2018-10-22 09:13:37', '2018-10-22 09:28:45'),
(6, '1540288619', 'Mehadi', 'shoha', 'father', 'mother', 'sister', '018397645', 'dhaka', '2018-10-16', '2018-10-17', '1540527056.jpg', NULL, 1, NULL, '2018-10-23 03:57:00', '2018-10-25 22:10:57'),
(7, '1540288740', 'd', '3', 'd', '3', 'd', '3', 'd', '2018-10-23', '2018-10-10', NULL, NULL, 2, NULL, '2018-10-23 03:59:00', '2018-10-23 03:59:12'),
(8, '1540292334', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', '2018-10-17', '2018-10-11', 'f896b9bc6f3da0352efeacc4920ccbb4_nomi-1534441872.jpg', NULL, 2, NULL, '2018-10-23 04:58:54', '2018-10-25 23:07:08'),
(9, '1540292446', 'sadf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', '2018-10-16', '2018-10-11', '1540526997.jpg', NULL, 2, NULL, '2018-10-23 05:00:46', '2018-10-25 23:07:00'),
(10, '1540292627', 'shimul vai', 'shimul', 'faher', 'mother', 'gardian', '01839764555', 'dhkaa', '2018-10-23', '2018-10-18', '1540531098.jpg', NULL, 1, NULL, '2018-10-23 05:03:47', '2018-10-25 23:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_infos`
--

CREATE TABLE `staff_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `staff_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_eng` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bng` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_id` int(11) UNSIGNED DEFAULT NULL COMMENT '#all_settings type=1',
  `role_id` int(10) UNSIGNED DEFAULT NULL COMMENT '#all_settings type=3',
  `department_id` int(11) UNSIGNED DEFAULT NULL COMMENT '#all_settings type=2',
  `birth_date` date NOT NULL,
  `join_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_infos`
--

INSERT INTO `staff_infos` (`id`, `staff_id`, `name_eng`, `name_bng`, `father_name`, `mother_name`, `mobile_no`, `address`, `designation_id`, `role_id`, `department_id`, `birth_date`, `join_date`, `salary`, `photo`, `details`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'STUFF-1540399134', 'asdf', '2', 'asdf', '22', '2', 'asdf', NULL, NULL, NULL, '1970-01-01', '1970-01-01', '22.00', '', NULL, 2, NULL, '2018-10-24 10:38:54', '2018-10-24 13:31:39'),
(2, 'STUFF-1540403218', 'Mehedi', 'মেহীেদী হাসান', 'বাবা', 'মা', '01839764565', 'asdf', 1, NULL, NULL, '2018-10-18', '2018-10-23', '50000.00', '', NULL, 2, NULL, '2018-10-24 11:46:58', '2018-10-24 13:31:45'),
(3, 'STUFF-1540413436', 'shohag', 'asdf', 'asdf', 'asdf', 'asdf', 'adsf', 1, NULL, 11, '2018-10-26', '2018-10-27', '5000.00', '1540413436.jpg', NULL, 1, NULL, '2018-10-24 12:10:16', '2018-10-24 14:37:16'),
(4, 'STUFF-1540527116', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 16, NULL, 8, '2018-10-08', '2018-10-08', '5000.00', '', NULL, 1, NULL, '2018-10-25 22:11:56', '2018-10-25 22:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md Omar faruk', 'omarlemua@gmail.com', '$2y$10$7mWtGZSmA.rSCstaAjkqT.jFP6YxkFneyLRA8On3b1m8c3OVQ9jOK', 'i2Ox31XeBt289tRIElZMbA3MQn5cEX54OJQgTCgpnUsWaNo6MTQeYXoUm7Ww', '2018-11-06 00:09:44', '2018-11-06 00:09:44'),
(2, 'Mr rahim', 'rahim@gmail.com', '$2y$10$tdoQECu9OP0PeG4duPsufuBfb/kRs6aNhn8kcLIw8P2i/nDLRsCYO', 'akbCJh3eUq0e30rThFkk6NPfR0h4X8MsUieUpxSgi7TeCWFZHQAeQwEWu85h', '2018-11-06 00:12:44', '2018-11-06 00:12:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_chart_of_accounts`
--
ALTER TABLE `acc_chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_invoices`
--
ALTER TABLE `acc_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_invoices_details`
--
ALTER TABLE `acc_invoices_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debit_chart_of_acc` (`debit_id`);

--
-- Indexes for table `all_sttings`
--
ALTER TABLE `all_sttings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_infos`
--
ALTER TABLE `bank_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collector_withness_info`
--
ALTER TABLE `collector_withness_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donar_infos`
--
ALTER TABLE `donar_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_boxes`
--
ALTER TABLE `donation_boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_openings`
--
ALTER TABLE `monthly_openings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orphan_infos`
--
ALTER TABLE `orphan_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `staff_infos`
--
ALTER TABLE `staff_infos`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `acc_chart_of_accounts`
--
ALTER TABLE `acc_chart_of_accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `acc_invoices`
--
ALTER TABLE `acc_invoices`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `acc_invoices_details`
--
ALTER TABLE `acc_invoices_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `all_sttings`
--
ALTER TABLE `all_sttings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bank_infos`
--
ALTER TABLE `bank_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `collector_withness_info`
--
ALTER TABLE `collector_withness_info`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `donar_infos`
--
ALTER TABLE `donar_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donation_boxes`
--
ALTER TABLE `donation_boxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `monthly_openings`
--
ALTER TABLE `monthly_openings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orphan_infos`
--
ALTER TABLE `orphan_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff_infos`
--
ALTER TABLE `staff_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  ADD CONSTRAINT `debit_chart_of_acc` FOREIGN KEY (`debit_id`) REFERENCES `acc_chart_of_accounts` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
