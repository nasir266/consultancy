-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2025 at 10:15 AM
-- Server version: 10.6.22-MariaDB-cll-lve-log
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freedpka_pos2`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `city_id`, `name`, `created_at`, `updated_at`) VALUES
(9, 17, 'Bawachak', '2025-01-04 08:59:37', '2025-01-04 08:59:37'),
(10, 20, 'KARKHANO BAZAR', '2025-01-09 11:07:04', '2025-01-09 11:07:04'),
(11, 20, 'THATHYARAN WALI GALI', '2025-01-09 11:08:49', '2025-01-09 11:08:49'),
(12, 21, 'ANARKALI BAZAR', '2025-01-09 13:16:33', '2025-01-09 13:16:33'),
(13, 18, 'NORTH KARACHI', '2022-12-31 20:11:30', '2022-12-31 20:11:30'),
(14, 22, 'test', '2025-03-21 01:46:30', '2025-03-21 01:46:30'),
(23, 17, 'MONTGOMERY BAZAR', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(24, 18, 'SECTOR 11-G', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(25, 26, 'BAND ROAD', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(26, 26, 'CHAMMAN BAGH', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(27, 27, 'CHOWK AZAM', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(28, 17, 'JHANG BAZAR', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(29, 17, 'MAKUANA', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(30, 28, 'JAFIR QASIM STREET', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(31, 29, 'NAWABABAD', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(32, 26, 'SANGIYAN ROAD', '2025-06-19 00:20:43', '2025-06-19 00:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(17, 'Faisalabad', '2025-01-04 08:59:20', '2025-01-04 08:59:20'),
(18, 'Karachi', '2025-01-04 09:29:37', '2025-01-04 09:29:37'),
(19, 'Islamabad', '2025-01-04 09:31:43', '2025-01-04 09:31:43'),
(20, 'GUJRANWALA', '2025-01-09 11:06:31', '2025-01-09 11:06:31'),
(21, 'MULTAN', '2025-01-09 13:16:22', '2025-01-09 13:16:22'),
(22, 'testing', '2025-03-21 01:46:25', '2025-03-21 01:46:25'),
(26, 'LAHORE', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(27, 'LAYYAH', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(28, 'CHINIOT', '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(29, 'WAH CANTT', '2025-06-18 22:33:21', '2025-06-18 22:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `define_items`
--

CREATE TABLE `define_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `define_items`
--

INSERT INTO `define_items` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pent Coat', NULL, NULL),
(2, 'Cloth', '2025-01-08 14:57:38', '2025-01-08 14:57:38'),
(3, 'BABA SUITE-G', '2025-01-09 11:44:43', '2025-01-09 11:44:43'),
(4, 'BABA SUITE FULL', '2022-12-31 20:13:40', '2022-12-31 20:13:40'),
(5, 'BABY SUITE HALF', '2025-03-04 20:44:10', '2025-03-04 20:44:10'),
(6, 'BABY SUITE FULL', '2025-03-05 20:13:06', '2025-03-05 20:13:06'),
(7, 'testing', '2025-03-21 01:43:05', '2025-03-21 01:43:05'),
(8, 'testing2', '2025-03-21 01:43:36', '2025-03-21 01:43:36'),
(9, 'LADIES SUITE COTTON 3P', '2025-04-28 15:15:38', '2025-04-28 15:15:38'),
(10, 'BABA TRACK SUITE MICRO FULL', '2025-04-28 15:17:29', '2025-04-28 15:17:29'),
(11, 'BABA SUITE HALF', '2025-04-28 22:56:26', '2025-04-28 22:56:26'),
(12, 'BABA ROMPER SUITE HALF', '2025-04-28 23:03:33', '2025-04-28 23:03:33'),
(13, 'BABY SUITE LILAN', '2025-06-19 00:21:49', '2025-06-19 00:21:49'),
(14, 'BABY FROCK NET', '2025-07-09 16:33:22', '2025-07-09 16:33:22'),
(15, 'BABA T-SHIRT HALF', '2025-07-09 17:40:49', '2025-07-09 17:40:49'),
(16, 'BABA SHIRT HALF', '2025-07-09 17:41:34', '2025-07-09 17:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `define_sizes`
--

CREATE TABLE `define_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `define_sizes`
--

INSERT INTO `define_sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '14/18', NULL, NULL),
(2, '12/13', '2025-01-08 15:03:17', '2025-01-08 15:03:17'),
(3, 'SML', '2025-01-09 11:44:51', '2025-01-09 11:44:51'),
(4, 'MLXL', '2022-12-31 20:13:52', '2022-12-31 20:13:52'),
(5, '24/28', '2025-03-04 20:44:22', '2025-03-04 20:44:22'),
(6, '18/22', '2025-03-04 20:47:04', '2025-03-04 20:47:04'),
(7, '123/123123', '2025-03-21 01:44:15', '2025-03-21 01:44:15'),
(8, '12/12', '2025-03-25 05:12:22', '2025-03-25 05:12:22'),
(9, '13/13', '2025-03-25 05:12:40', '2025-03-25 05:12:40'),
(10, 'FREE', '2025-04-28 15:15:54', '2025-04-28 15:15:54'),
(11, '2/3', '2025-04-28 23:01:36', '2025-04-28 23:01:36'),
(12, '32/36', '2025-06-19 00:24:25', '2025-06-19 00:24:25'),
(13, '20/22', '2025-06-19 15:52:01', '2025-06-19 15:52:01'),
(14, '30/34', '2025-06-19 16:46:43', '2025-06-19 16:46:43'),
(15, '1/2', '2025-06-23 16:11:54', '2025-06-23 16:11:54'),
(16, 'ZERO', '2025-07-09 16:33:30', '2025-07-09 16:33:30'),
(17, '18/24', '2025-07-09 17:40:58', '2025-07-09 17:40:58'),
(18, '20/24', '2025-07-09 17:42:42', '2025-07-09 17:42:42'),
(19, 'M/L', '2025-07-09 17:44:03', '2025-07-09 17:44:03');

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
-- Table structure for table `godowns`
--

CREATE TABLE `godowns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `default_status` varchar(255) NOT NULL DEFAULT 'false',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `godowns`
--

INSERT INTO `godowns` (`id`, `name`, `default_status`, `created_at`, `updated_at`) VALUES
(1, 'Warehouse', 'true', NULL, NULL),
(2, 'Main Shop', 'false', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `purchase_rate` int(11) NOT NULL,
  `sale_rate` int(11) NOT NULL,
  `party_discount` int(11) DEFAULT NULL,
  `party_less` int(11) DEFAULT NULL,
  `customer_less` int(11) DEFAULT NULL,
  `wholesale_profit` varchar(255) NOT NULL,
  `packet_qty` int(11) DEFAULT NULL,
  `pieces_in_packet` int(11) DEFAULT NULL,
  `total_pieces` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'true',
  `retail_sale_rate_p` int(11) DEFAULT NULL,
  `retail_sale_rate` int(11) DEFAULT NULL,
  `retail_less` int(11) DEFAULT NULL,
  `retail_discount` int(11) DEFAULT NULL,
  `retail_profit` varchar(255) DEFAULT NULL,
  `min_level` int(11) DEFAULT NULL,
  `max_level` int(11) DEFAULT NULL,
  `w_sale_man_commension` int(11) DEFAULT NULL,
  `r_sale_man_commension` int(11) DEFAULT NULL,
  `define_item_id` int(11) NOT NULL,
  `define_size_id` int(11) NOT NULL,
  `party_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `date`, `image`, `item_code`, `barcode`, `description`, `purchase_rate`, `sale_rate`, `party_discount`, `party_less`, `customer_less`, `wholesale_profit`, `packet_qty`, `pieces_in_packet`, `total_pieces`, `status`, `retail_sale_rate_p`, `retail_sale_rate`, `retail_less`, `retail_discount`, `retail_profit`, `min_level`, `max_level`, `w_sale_man_commension`, `r_sale_man_commension`, `define_item_id`, `define_size_id`, `party_id`, `created_at`, `updated_at`) VALUES
(1, '2025-02-27', NULL, 'F12345', '12', 'F12345-Pent Coat-14/18-1-OTTH-$-R$', 12, 123, 1234, 123, 421, '-2999.33% | -360', 20, 20, 400, 'true', 12, 123, 421, 123, '123', NULL, NULL, 321, 42, 1, 1, 1, '2025-01-06 05:22:41', '2025-03-04 08:35:13'),
(2, '2025-01-06', NULL, 'F12346', '12', 'F12346-Pent Coat-14/18-1-OTTH-$-R$', 12, 123, 421, 123, 421, '142', 10, 20, 200, 'true', 12, 123, 421, 123, '123', NULL, NULL, 321, 42, 1, 1, 1, '2025-01-06 05:23:02', '2025-03-19 20:15:33'),
(3, '2025-01-08', NULL, 'F12342', '12', 'F12342-Pent Coat-14/18-1-OTTH-$-R$', 13, 123, 20, 2, 421, '-4826.15% | -627', 10, 20, 200, 'active', 13, 139, 421, 123, '-463.42% | -570', NULL, NULL, 321, 42, 1, 1, 1, '2025-01-06 05:23:39', '2025-07-09 02:27:14'),
(4, '2025-02-13', NULL, 'F12341', '4', 'F1234-Cloth-14/18-1-TZ--', 10, 20, 20, 10, 20, '20.00% | 2', 110, 20, 2200, 'true', 10, 22, NULL, NULL, '10.00% | 2', NULL, NULL, NULL, NULL, 2, 1, 1, '2025-02-13 11:18:53', '2025-02-13 11:18:53'),
(5, '2025-02-26', NULL, 'F123', '5', 'F1234-Pent Coat-14/18-2-TZ--', 10, 20, 20, 20, 2, '300.00% | 30', 10, 20, 200, 'true', 10, 22, NULL, NULL, '10.00% | 2', NULL, NULL, NULL, NULL, 1, 1, 2, '2025-02-26 10:56:33', '2025-02-26 10:56:33'),
(6, '2025-02-26', NULL, 'F12', '6', 'F1234-Pent Coat-14/18-1-T--', 1, 2, 20, 21, 1, '2120.00% | 21', 10, 20, 200, 'true', 10, 2, NULL, NULL, '10.00% | 0', NULL, NULL, NULL, NULL, 1, 1, 1, '2025-02-26 10:57:23', '2025-02-26 10:57:23'),
(7, '2025-02-26', NULL, 'F12344', '7', 'F1234-Pent Coat-14/18-1-OT--', 12, 12, 20, 12, 12, '20.00% | 2', 12, 12, 144, 'true', 10, 13, NULL, NULL, '10.00% | 1', NULL, NULL, NULL, NULL, 1, 1, 1, '2025-02-26 10:58:46', '2025-02-26 10:58:46'),
(8, '2025-02-26', NULL, 'F12343', '8', 'F1234-Pent Coat-14/18-1-OT--', 12, 12, 2012, 12, 12, '2012.00% | 241', 12, 12, 144, 'true', 10, 13, NULL, NULL, '10.00% | 1', NULL, NULL, NULL, NULL, 1, 1, 1, '2025-02-26 11:00:44', '2025-02-26 11:00:44'),
(9, '2025-02-26', NULL, 'F12349', '9', 'F1234-Pent Coat-14/18-1-O--', 12, 1, 201, 12, 12, '109.33% | 13', 12, 12, 144, 'true', 10, 1, NULL, NULL, '10.00% | 0', NULL, NULL, NULL, NULL, 1, 1, 1, '2025-02-26 11:01:16', '2025-02-26 11:01:16'),
(10, '2025-02-26', NULL, 'D123', '10', 'D123-Pent Coat-14/18-4-OT--', 12, 12, 2912, 12, 12, '2912.00% | 349', 12, 12, 144, 'true', 10, 13, NULL, NULL, '10.00% | 1', NULL, NULL, NULL, NULL, 1, 1, 4, '2025-02-26 11:01:33', '2025-02-26 11:01:33'),
(11, '2025-02-26', NULL, 'F12340', '11', 'F1234-Pent Coat-14/18-1-OT--', 12, 12, 20, 12, 12, '20.00% | 2', 10, 20, 200, 'true', 10, 13, NULL, NULL, '10.00% | 1', NULL, NULL, NULL, NULL, 1, 1, 1, '2025-02-26 11:03:21', '2025-02-26 11:29:02'),
(12, '2025-02-26', NULL, 'F123444', '12', 'F123444-Pent Coat-14/18-1-TZ--', 10, 20, 10, NULL, NULL, '110.00% | 11', 10, 20, 200, 'true', 10, 22, NULL, NULL, '10.00% | 2', NULL, NULL, NULL, NULL, 1, 1, 1, '2025-02-26 11:06:15', '2025-03-04 08:56:17'),
(13, '2025-02-26', NULL, 'F123455', '13', 'F123455-Pent Coat-14/18-1-TZ--', 10, 20, 20, 202, 20, '1940.00% | 194', 10, 20, 200, 'true', 10, 22, NULL, NULL, '10.00% | 2', NULL, NULL, NULL, NULL, 1, 1, 1, '2025-02-26 11:33:00', '2025-03-04 08:56:09'),
(14, '2025-03-04', NULL, 'D9123', '14', 'D9123-Pent Coat-14/18-3-OT--', 12, 12, 20, NULL, NULL, '20.00% | 2', 10, 10, 100, 'true', 10, 13, NULL, NULL, '10.00% | 1', NULL, NULL, NULL, NULL, 1, 1, 3, '2025-02-26 11:49:14', '2025-03-04 08:36:49'),
(15, '2025-03-04', NULL, 'F1234455', '15', 'F1234455-BABA TRACK SUITE MICRO FULL-FREE-12-NNFI--', 995, 995, 10, NULL, NULL, '10.00% | 100', NULL, NULL, NULL, 'active', 15, 10, NULL, NULL, '15.00% | 149', NULL, NULL, NULL, NULL, 10, 10, 12, '2025-03-04 20:44:49', '2025-06-18 22:49:47'),
(16, '2025-03-04', NULL, 'H228', '16', 'H228-BABY SUITE HALF-18/22-12-OZNFI--', 1095, 1095, 10, NULL, NULL, '10.00% | 110', 6, 6, 36, 'true', 15, NULL, NULL, NULL, '15.00% | 164', NULL, NULL, NULL, NULL, 5, 6, 12, '2025-03-04 20:47:19', '2025-03-05 00:07:29'),
(17, '2025-03-04', NULL, 'H230', '17', 'H230-BABY SUITE HALF-18/22-12-OOSFI--', 1165, 1165, 10, NULL, NULL, '10.00% | 117', 4, 6, 24, 'true', 15, NULL, NULL, NULL, '15.00% | 175', NULL, NULL, NULL, NULL, 5, 6, 12, '2025-03-04 20:47:47', '2025-03-04 20:47:47'),
(18, '2025-03-04', NULL, 'H240', '18', 'H240-BABY SUITE HALF-18/22-12-OZSZ--', 1060, 1060, 10, NULL, NULL, '10.00% | 106', 4, 6, 24, 'true', 15, NULL, NULL, NULL, '15.00% | 159', NULL, NULL, NULL, NULL, 5, 6, 12, '2025-03-04 20:48:10', '2025-03-04 20:48:10'),
(19, '2025-03-05', NULL, 'H3110', '19', 'H3110-BABY SUITE HALF-14/18-12-NFIFI--', 955, 955, 10, NULL, NULL, '10.00% | 96', NULL, NULL, NULL, 'true', 15, NULL, NULL, NULL, '15.00% | 143', NULL, NULL, NULL, NULL, 5, 1, 12, '2025-03-04 20:48:33', '2025-03-05 11:18:25'),
(20, '2025-03-04', NULL, 'H3730', '20', 'H3730-BABY SUITE HALF-18/22-12-ESFI--', 865, 865, 10, NULL, NULL, '10.00% | 87', NULL, NULL, NULL, 'true', 15, NULL, NULL, NULL, '15.00% | 130', NULL, NULL, NULL, NULL, 5, 6, 12, '2025-03-04 20:48:53', '2025-03-05 00:18:35'),
(21, '2025-03-05', NULL, NULL, '21', '-BABY SUITE HALF-SML-11-FIZZ--', 500, 500, 10, 10, NULL, '12.00% | 60', 10, 20, 200, 'active', 10, NULL, NULL, NULL, '10.00% | 50', NULL, NULL, NULL, NULL, 5, 3, 11, '2025-03-05 11:19:04', '2025-03-27 10:59:06'),
(22, '2025-03-05', NULL, 'F000', '22', 'F000-Pent Coat-12/13-1-TZ--', 10, 20, 20, NULL, NULL, '120.00% | 12', NULL, NULL, NULL, 'true', 15, 10, NULL, NULL, '15.00% | 3', NULL, NULL, NULL, NULL, 1, 2, 1, '2025-03-05 12:34:54', '2025-03-21 01:19:07'),
(23, '2025-03-05', NULL, 'F001', '23', 'F001-Pent Coat-14/18-1-TZ--', 10, 20, 20, NULL, NULL, '120.00% | 12', 20, 20, 400, 'active', 15, 10, NULL, NULL, '15.00% | 3', NULL, NULL, NULL, NULL, 1, 1, 1, '2025-03-05 12:36:20', '2025-04-07 14:55:44'),
(24, '2025-03-05', NULL, NULL, '24', '-Pent Coat-14/18-5-TZ--', 10, 20, 123, 10, 20, '123.00% | 12', 10, 20, 200, 'inactive', 15, 23, NULL, NULL, '15.00% | 3', NULL, NULL, NULL, NULL, 1, 1, 5, '2025-03-05 13:36:58', '2025-04-07 14:59:56'),
(25, '2025-04-28', NULL, 'AM-1401', '25', 'AM-1401-BABA SUITE HALF-14/18-14-FTHZ--', 430, 430, 10, NULL, NULL, '10.00% | 43', 8, 6, 48, 'active', 15, 495, NULL, NULL, '15.00% | 65', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 22:56:43', '2025-04-28 22:56:43'),
(26, '2025-04-28', NULL, 'AM-2501', '26', 'AM-2501-BABA SUITE HALF-14/18-14-THNFI--', 395, 395, 10, NULL, NULL, '10.00% | 40', 6, 6, 36, 'active', 15, 454, NULL, NULL, '15.00% | 59', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 22:57:13', '2025-04-28 22:57:13'),
(27, '2025-04-28', NULL, 'AM-4701', '27', 'AM-4701-BABA SUITE HALF-14/18-14-FZFI--', 405, 405, 10, NULL, NULL, '10.00% | 41', 6, 6, 36, 'active', 15, 466, NULL, NULL, '15.00% | 61', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 22:57:34', '2025-04-28 22:57:34'),
(28, '2025-04-28', NULL, 'AM-5101', '28', 'AM-5101-BABA SUITE HALF-14/18-14-FFIFI--', 455, 455, 10, NULL, NULL, '10.00% | 46', 6, 6, 36, 'active', 15, 523, NULL, NULL, '15.00% | 68', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 22:58:01', '2025-04-28 22:58:01'),
(29, '2025-04-28', NULL, 'AM-5201', '29', 'AM-5201-BABA SUITE HALF-14/18-14-FZFI--', 405, 405, 10, NULL, NULL, '10.00% | 41', 4, 6, 24, 'active', 15, 466, NULL, NULL, '15.00% | 61', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 22:58:55', '2025-04-28 22:58:55'),
(30, '2025-04-28', NULL, 'AM-5301', '30', 'AM-5301-BABA SUITE HALF-14/18-14-FZFI--', 405, 405, 10, NULL, NULL, '10.00% | 41', 4, 6, 24, 'active', 15, 466, NULL, NULL, '15.00% | 61', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 22:59:15', '2025-04-28 22:59:15'),
(31, '2025-04-28', NULL, 'AM-5401', '31', 'AM-5401-BABA SUITE HALF-14/18-14-FTZ--', 420, 420, 10, NULL, NULL, '10.00% | 42', 6, 6, 36, 'active', 15, 483, NULL, NULL, '15.00% | 63', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 22:59:45', '2025-04-28 22:59:45'),
(32, '2025-04-28', NULL, 'AM-5701', '32', 'AM-5701-BABA SUITE HALF-14/18-14-THEFI--', 385, 385, 10, NULL, NULL, '10.00% | 39', 6, 6, 36, 'active', 15, 443, NULL, NULL, '15.00% | 58', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 23:00:17', '2025-04-28 23:00:17'),
(33, '2025-04-28', NULL, 'AM-5801', '33', 'AM-5801-BABA SUITE HALF-14/18-14-THEFI--', 385, 385, 10, NULL, NULL, '10.00% | 39', 6, 6, 36, 'active', 15, 443, NULL, NULL, '15.00% | 58', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 23:00:48', '2025-04-28 23:00:48'),
(34, '2025-04-28', NULL, 'AM-6401', '34', 'AM-6401-BABA SUITE HALF-14/18-14-THNFI--', 395, 395, 10, NULL, NULL, '10.00% | 40', 6, 6, 36, 'active', 15, 454, NULL, NULL, '15.00% | 59', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 23:01:12', '2025-04-28 23:01:12'),
(35, '2025-04-28', NULL, 'AM-6701', '35', 'AM-6701-BABA ROMPER SUITE HALF-2/3-14-FSEFI--', 475, 475, 10, NULL, NULL, '10.00% | 48', 2, 6, 12, 'active', 15, 546, NULL, NULL, '15.00% | 71', NULL, NULL, NULL, NULL, 12, 11, 14, '2025-04-28 23:01:52', '2025-04-28 23:04:07'),
(36, '2025-04-28', NULL, 'AM-6901', '36', 'AM-6901-BABA ROMPER SUITE HALF-2/3-14-FNZ--', 490, 490, 10, NULL, NULL, '10.00% | 49', 2, 6, 12, 'active', 15, 564, NULL, NULL, '15.00% | 74', NULL, NULL, NULL, NULL, 12, 11, 14, '2025-04-28 23:02:22', '2025-04-28 23:04:47'),
(37, '2025-04-28', NULL, 'AM-7001', '37', 'AM-7001-BABA ROMPER SUITE HALF-2/3-14-FNZ--', 490, 490, 10, NULL, NULL, '10.00% | 49', 2, 6, 12, 'active', 15, 564, NULL, NULL, '15.00% | 74', NULL, NULL, NULL, NULL, 12, 11, 14, '2025-04-28 23:05:26', '2025-04-28 23:05:26'),
(38, '2025-04-28', NULL, 'AM-7101', '38', 'AM-7101-BABA SUITE HALF-14/18-14-FFZ--', 440, 440, 10, NULL, NULL, '10.00% | 44', 6, 6, 36, 'active', 15, 506, NULL, NULL, '15.00% | 66', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 23:05:48', '2025-04-28 23:07:02'),
(39, '2025-04-28', NULL, 'AM-7501', '39', 'AM-7501-BABA SUITE HALF-14/18-14-FOZ--', 410, 410, 10, NULL, NULL, '10.00% | 41', 6, 6, 36, 'active', 15, 472, NULL, NULL, '15.00% | 62', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 23:06:16', '2025-04-28 23:06:16'),
(40, '2025-04-28', NULL, 'AM-7601', '40', 'AM-7601-BABA SUITE HALF-14/18-14-THNFI--', 395, 395, 10, NULL, NULL, '10.00% | 40', 6, 6, 36, 'active', 15, 454, NULL, NULL, '15.00% | 59', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 23:07:41', '2025-04-28 23:07:41'),
(41, '2025-04-28', NULL, 'AM-7801', '41', 'AM-7801-BABA SUITE HALF-14/18-14-FZFI--', 405, 405, 10, NULL, NULL, '10.00% | 41', 6, 6, 36, 'active', 15, 466, NULL, NULL, '15.00% | 61', NULL, NULL, NULL, NULL, 11, 1, 14, '2025-04-28 23:08:05', '2025-04-28 23:08:05'),
(42, '2025-04-28', NULL, NULL, '42', '-BABY SUITE HALF-18/22-14-SFZ--', 640, 640, 10, NULL, NULL, '10.00% | 64', NULL, NULL, NULL, 'active', 15, 736, NULL, NULL, '15.00% | 96', NULL, NULL, NULL, NULL, 5, 6, 14, '2025-04-28 23:31:52', '2025-05-13 19:20:22'),
(43, '2025-06-18', NULL, 'P-126', '43', 'P-126-BABY SUITE LILAN-24/28-32-SEOFI--', 650, 715, NULL, NULL, NULL, '10.00% | 65', 6, 6, 36, 'active', 15, 822, NULL, NULL, '15.00% | 107', NULL, NULL, NULL, NULL, 13, 5, 32, '2025-06-19 00:23:58', '2025-07-07 16:34:56'),
(44, '2025-06-18', NULL, 'P-216', '44', 'P-216-BABY SUITE LILAN-32/36-32-ETFI--', 750, 825, NULL, NULL, NULL, '10.00% | 75', 36, 6, 216, 'active', 15, 949, NULL, NULL, '15.00% | 124', NULL, NULL, NULL, NULL, 13, 12, 32, '2025-06-19 00:25:21', '2025-06-19 00:25:21'),
(45, '2025-06-19', NULL, '00321', '45', '00321-BABY SUITE HALF-18/22-33-SSFI--', 610, 665, NULL, 5, NULL, '9.84% | 60', 12, 6, 72, 'active', 15, 765, NULL, NULL, '15.00% | 100', NULL, NULL, NULL, NULL, 5, 6, 33, '2025-06-19 15:50:43', '2025-06-19 15:50:43'),
(46, '2025-06-19', NULL, '00322', '46', '00322-BABY SUITE HALF-24/28-33-SEEFI--', 720, 785, NULL, 5, NULL, '9.72% | 70', 12, 6, 72, 'active', 15, 903, NULL, NULL, '15.00% | 118', NULL, NULL, NULL, NULL, 5, 5, 33, '2025-06-19 15:51:09', '2025-06-19 15:51:09'),
(47, '2025-06-19', NULL, '00323', '47', '00323-BABY SUITE HALF-18/22-33-STZ--', 570, 620, NULL, 5, NULL, '9.65% | 55', 12, 6, 72, 'active', 15, 713, NULL, NULL, '15.00% | 93', NULL, NULL, NULL, NULL, 5, 6, 33, '2025-06-19 15:51:39', '2025-06-19 15:51:39'),
(48, '2025-06-19', NULL, '01504', '48', '01504-BABA SUITE HALF-20/22-33-THOFI--', 295, 315, NULL, 5, NULL, '8.47% | 25', 12, 6, 72, 'active', 15, 362, NULL, NULL, '15.00% | 47', NULL, NULL, NULL, NULL, 11, 13, 33, '2025-06-19 15:52:15', '2025-06-19 15:52:15'),
(49, '2025-06-19', NULL, '01752', '49', '01752-BABA SUITE HALF-SML-33-FIFIZ--', 505, 550, NULL, 5, NULL, '9.90% | 50', 12, 6, 72, 'active', 15, 633, NULL, NULL, '15.00% | 83', NULL, NULL, NULL, NULL, 11, 3, 33, '2025-06-19 15:52:46', '2025-06-19 15:52:46'),
(50, '2025-06-19', NULL, 'H330', '50', 'H330-BABA SUITE HALF-SML-12-NNFI--', 995, 995, 10, NULL, NULL, '10.00% | 100', 4, 6, 24, 'active', 40, 1393, NULL, NULL, '40.00% | 398', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-06-19 16:23:18', '2025-06-19 16:23:18'),
(51, '2025-06-19', NULL, 'H331', '51', 'H331-BABA SUITE HALF-SML-12-NSZ--', 960, 960, 10, NULL, NULL, '10.00% | 96', 5, 6, 30, 'active', 40, 1344, NULL, NULL, '40.00% | 384', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-06-19 16:24:06', '2025-06-19 16:24:06'),
(52, '2025-06-19', NULL, 'H334', '52', 'H334-BABA SUITE HALF-SML-12-NTHZ--', 930, 930, 10, NULL, NULL, '10.00% | 93', 5, 6, 30, 'active', 40, 1302, NULL, NULL, '40.00% | 372', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-06-19 16:24:41', '2025-06-19 16:24:41'),
(53, '2025-06-19', NULL, 'H393', '53', 'H393-BABA SUITE HALF-SML-12-NTFI--', 925, 925, 10, NULL, NULL, '10.00% | 93', 5, 6, 30, 'active', 40, 1295, NULL, NULL, '40.00% | 370', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-06-19 16:25:09', '2025-06-19 16:25:09'),
(54, '2025-06-19', NULL, 'H394', '54', 'H394-BABA SUITE HALF-SML-12-NOZ--', 910, 910, 10, NULL, NULL, '10.00% | 91', 5, 6, 30, 'active', 40, 1274, NULL, NULL, '40.00% | 364', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-06-19 16:25:40', '2025-06-19 16:25:40'),
(55, '2025-06-19', NULL, 'H440', '55', 'H440-BABA SUITE HALF-SML-12-NOFI--', 915, 915, 10, NULL, NULL, '10.00% | 92', 5, 6, 30, 'active', 40, 1281, NULL, NULL, '40.00% | 366', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-06-19 16:26:13', '2025-06-19 16:26:13'),
(56, '2025-06-19', NULL, 'H441', '56', 'H441-BABA ROMPER SUITE HALF-SML-12-NTHFI--', 935, 935, 10, NULL, NULL, '10.00% | 94', 5, 6, 30, 'active', 40, 1309, NULL, NULL, '40.00% | 374', NULL, NULL, NULL, NULL, 12, 3, 12, '2025-06-19 16:26:43', '2025-06-19 16:26:43'),
(57, '2025-06-19', NULL, 'H442', '57', 'H442-BABA SUITE HALF-SML-12-NTHFI--', 935, 935, 10, NULL, NULL, '10.00% | 94', 5, 6, 30, 'active', 40, 1309, NULL, NULL, '40.00% | 374', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-06-19 16:27:39', '2025-06-19 16:27:39'),
(58, '2025-06-19', NULL, 'H443', '58', 'H443-BABA SUITE HALF-SML-12-NFFI--', 945, 945, 10, NULL, NULL, '10.00% | 95', 5, 6, 30, 'active', 40, 1323, NULL, NULL, '40.00% | 378', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-06-19 16:28:02', '2025-06-19 16:28:02'),
(59, '2025-06-19', NULL, 'H468', '59', 'H468-BABA SUITE HALF-SML-12-NTFI--', 925, 925, 10, NULL, NULL, '10.00% | 93', 5, 6, 30, 'active', 40, 1295, NULL, NULL, '40.00% | 370', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-06-19 16:28:36', '2025-06-19 16:28:36'),
(60, '2025-06-19', NULL, '1233', '60', '1233-BABY SUITE HALF-18/22-34-SETZ--', 660, 720, NULL, 5, NULL, '9.85% | 65', 4, 6, 24, 'active', 40, 1008, NULL, NULL, '40.00% | 288', NULL, NULL, NULL, NULL, 5, 6, 34, '2025-06-19 16:44:01', '2025-06-19 16:44:01'),
(61, '2025-06-19', NULL, '1235', '61', '1235-BABY SUITE HALF-18/22-34-SETZ--', 660, 720, NULL, 5, NULL, '9.85% | 65', 6, 6, 36, 'active', 40, 1008, NULL, NULL, '40.00% | 288', NULL, NULL, NULL, NULL, 5, 6, 34, '2025-06-19 16:44:30', '2025-06-19 16:44:30'),
(62, '2025-06-19', NULL, '1236', '62', '1236-BABY SUITE HALF-18/22-34-SETZ--', 660, 720, NULL, 5, NULL, '9.85% | 65', 6, 6, 36, 'active', 40, 1008, NULL, NULL, '40.00% | 288', NULL, NULL, NULL, NULL, 5, 6, 34, '2025-06-19 16:44:54', '2025-06-19 16:44:54'),
(63, '2025-06-19', NULL, '1237', '63', '1237-BABY SUITE HALF-18/22-34-SETHFI--', 675, 735, NULL, 5, NULL, '9.63% | 65', 6, 6, 36, 'active', 40, 1029, NULL, NULL, '40.00% | 294', NULL, NULL, NULL, NULL, 5, 6, 34, '2025-06-19 16:45:25', '2025-06-19 16:45:25'),
(64, '2025-06-19', NULL, '9300', '64', '9300-BABY SUITE HALF-24/28-34-NFIFI--', 875, 955, NULL, 5, NULL, '9.71% | 85', 4, 6, 24, 'active', 40, 1337, NULL, NULL, '40.00% | 382', NULL, NULL, NULL, NULL, 5, 5, 34, '2025-06-19 16:46:25', '2025-06-19 16:46:25'),
(65, '2025-06-19', NULL, '9301', '65', '9301-BABY SUITE HALF-30/34-34-OTHZFI--', 1195, 1305, NULL, 5, NULL, '9.62% | 115', 4, 6, 24, 'active', 40, 1827, NULL, NULL, '40.00% | 522', NULL, NULL, NULL, NULL, 5, 14, 34, '2025-06-19 16:46:54', '2025-06-19 16:46:54'),
(66, '2025-06-19', NULL, '192', '66', '192-BABA SUITE HALF-SML-35-TNZ--', 265, 290, NULL, NULL, NULL, '9.43% | 25', 1, 4, 4, 'active', 40, 406, NULL, NULL, '40.00% | 116', NULL, NULL, NULL, NULL, 11, 3, 35, '2025-06-19 17:16:12', '2025-06-19 17:17:32'),
(67, '2025-06-23', NULL, '1372', '67', '1372-BABY SUITE HALF-18/22-11-SOFI--', 560, 615, NULL, NULL, NULL, '9.82% | 55', 4, 6, 24, 'active', 40, 861, NULL, NULL, '40.00% | 246', NULL, NULL, NULL, NULL, 5, 6, 11, '2025-06-23 16:05:48', '2025-06-23 16:05:48'),
(68, '2025-06-23', NULL, '1377', '68', '1377-BABY SUITE HALF-18/22-11-FIFIZ--', 500, 550, NULL, NULL, NULL, '10.00% | 50', 4, 6, 24, 'active', 40, 770, NULL, NULL, '40.00% | 220', NULL, NULL, NULL, NULL, 5, 6, 11, '2025-06-23 16:07:13', '2025-06-23 16:07:13'),
(69, '2025-06-23', NULL, '1383', '69', '1383-BABY SUITE HALF-18/22-11-FIZFI--', 460, 505, NULL, NULL, NULL, '9.78% | 45', 4, 6, 24, 'active', 40, 707, NULL, NULL, '40.00% | 202', NULL, NULL, NULL, NULL, 5, 6, 11, '2025-06-23 16:07:35', '2025-06-23 16:07:35'),
(70, '2025-06-23', NULL, '1725', '70', '1725-BABY SUITE HALF-18/22-11-FEZ--', 440, 480, NULL, NULL, NULL, '9.09% | 40', 5, 6, 30, 'active', 40, 672, NULL, NULL, '40.00% | 192', NULL, NULL, NULL, NULL, 5, 6, 11, '2025-06-23 16:08:28', '2025-06-23 16:08:28'),
(71, '2025-06-23', NULL, '1726', '71', '1726-BABY SUITE HALF-18/22-11-FISEZ--', 520, 570, NULL, NULL, NULL, '9.62% | 50', 5, 6, 30, 'active', 40, 798, NULL, NULL, '40.00% | 228', NULL, NULL, NULL, NULL, 5, 6, 11, '2025-06-23 16:08:52', '2025-06-23 16:08:52'),
(72, '2025-06-23', NULL, '2486', '72', '2486-BABY SUITE HALF-2/3-11-THNFI--', 360, 395, NULL, NULL, NULL, '9.72% | 35', 4, 6, 24, 'active', 40, 553, NULL, NULL, '40.00% | 158', NULL, NULL, NULL, NULL, 5, 11, 11, '2025-06-23 16:09:19', '2025-06-23 16:09:19'),
(73, '2025-06-23', NULL, '2559', '73', '2559-BABY SUITE HALF-2/3-11-FZFI--', 370, 405, NULL, NULL, NULL, '9.46% | 35', 4, 6, 24, 'active', 40, 567, NULL, NULL, '40.00% | 162', NULL, NULL, NULL, NULL, 5, 11, 11, '2025-06-23 16:10:05', '2025-06-23 16:10:05'),
(74, '2025-06-23', NULL, '5208', '74', '5208-BABY SUITE HALF-18/22-11-SNZ--', 630, 690, NULL, NULL, NULL, '9.52% | 60', 4, 6, 24, 'active', 40, 966, NULL, NULL, '40.00% | 276', NULL, NULL, NULL, NULL, 5, 6, 11, '2025-06-23 16:10:48', '2025-06-23 16:10:48'),
(75, '2025-06-23', NULL, '5219', '75', '5219-BABY SUITE HALF-18/22-11-SNZ--', 630, 690, NULL, NULL, NULL, '9.52% | 60', 5, 6, 30, 'active', 40, 966, NULL, NULL, '40.00% | 276', NULL, NULL, NULL, NULL, 5, 6, 11, '2025-06-23 16:11:25', '2025-07-09 03:23:09'),
(76, '2025-06-23', NULL, '5220', '76', '5220-BABY SUITE HALF-1/2-11-THNFI--', 360, 395, NULL, NULL, NULL, '9.72% | 35', 4, 6, 24, 'active', 40, 553, NULL, NULL, '40.00% | 158', NULL, NULL, NULL, NULL, 5, 15, 11, '2025-06-23 16:12:15', '2025-06-23 16:12:15'),
(77, '2025-06-23', NULL, '6040', '77', '6040-BABY SUITE HALF-18/22-11-FSEZ--', 430, 470, 30, 10, 4, '40.70% | 175', 10, 20, 200, 'active', 40, 658, NULL, NULL, '40.00% | 188', NULL, NULL, NULL, NULL, 5, 6, 11, '2025-06-23 16:12:58', '2025-07-09 03:34:24'),
(78, '2025-06-23', NULL, '6160', '78', '6160-BABY SUITE HALF-2/3-11-THSZ--', 330, 360, NULL, NULL, NULL, '9.09% | 30', 4, 6, 24, 'active', 40, 504, NULL, NULL, '40.00% | 144', NULL, NULL, NULL, NULL, 5, 11, 11, '2025-06-23 16:13:24', '2025-06-23 16:13:24'),
(79, '2025-06-23', NULL, '7087', '79', '7087-BABY SUITE HALF-18/22-11-FIZFI--', 460, 505, 10, 20, 10, '21.96% | 101', 10, 20, 200, 'active', 40, 707, NULL, NULL, '40.00% | 202', NULL, NULL, NULL, NULL, 5, 6, 11, '2025-06-23 16:13:53', '2025-07-09 03:34:13'),
(80, '2025-07-09', NULL, '2130-C', '80', '2130-C-BABY SUITE HALF-24/28-36-NOZ--', 830, 910, NULL, NULL, NULL, '9.64% | 80', 8, 6, 48, 'active', 50, 0, NULL, NULL, '50.00% | 455', NULL, NULL, NULL, NULL, 5, 5, 36, '2025-07-09 16:27:58', '2025-07-09 16:27:58'),
(81, '2025-07-09', NULL, '2130-D', '81', '2130-D-BABY SUITE HALF-30/34-36-OZEFI--', 990, 1085, NULL, NULL, NULL, '9.60% | 95', 8, 6, 48, 'active', 50, NULL, NULL, NULL, '50.00% | 543', NULL, NULL, NULL, NULL, 5, 14, 36, '2025-07-09 16:28:36', '2025-07-09 16:28:36'),
(82, '2025-07-09', NULL, '3022-B', '82', '3022-B-BABY SUITE HALF-18/22-36-SOFI--', 560, 615, NULL, NULL, NULL, '9.82% | 55', 4, 6, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 308', NULL, NULL, NULL, NULL, 5, 6, 36, '2025-07-09 16:29:03', '2025-07-09 16:29:03'),
(83, '2025-07-09', NULL, '3022-C', '83', '3022-C-BABY SUITE HALF-24/28-36-SETFI--', 660, 725, NULL, NULL, NULL, '9.85% | 65', 6, 6, 36, 'active', 50, NULL, NULL, NULL, '50.00% | 363', NULL, NULL, NULL, NULL, 5, 5, 36, '2025-07-09 16:29:39', '2025-07-09 16:29:39'),
(84, '2025-07-09', NULL, '2126-B', '84', '2126-B-BABY SUITE HALF-18/22-36-SEFIFI--', 690, 755, NULL, NULL, NULL, '9.42% | 65', 6, 6, 36, 'active', 50, NULL, NULL, NULL, '50.00% | 378', NULL, NULL, NULL, NULL, 5, 6, 36, '2025-07-09 16:30:44', '2025-07-09 16:30:44'),
(85, '2025-07-09', NULL, '2126-C', '85', '2126-C-BABY SUITE HALF-24/28-36-ENZ--', 810, 890, NULL, NULL, NULL, '9.88% | 80', 6, 6, 36, 'active', 50, NULL, NULL, NULL, '50.00% | 445', NULL, NULL, NULL, NULL, 5, 5, 36, '2025-07-09 16:31:26', '2025-07-09 16:31:26'),
(86, '2025-07-09', NULL, '2126-D', '86', '2126-D-BABY SUITE HALF-30/34-36-OZSFI--', 970, 1065, NULL, NULL, NULL, '9.79% | 95', 6, 6, 36, 'active', 50, NULL, NULL, NULL, '50.00% | 533', NULL, NULL, NULL, NULL, 5, 14, 36, '2025-07-09 16:31:58', '2025-07-09 16:31:58'),
(87, '2025-07-09', NULL, '2133-B', '87', '2133-B-BABY SUITE HALF-24/28-36-EFIFI--', 780, 855, NULL, NULL, NULL, '9.62% | 75', 6, 6, 36, 'active', 50, NULL, NULL, NULL, '50.00% | 428', NULL, NULL, NULL, NULL, 5, 5, 36, '2025-07-09 16:32:25', '2025-07-09 16:32:25'),
(88, '2025-07-09', NULL, '2133-C', '88', '2133-C-BABY SUITE HALF-30/34-36-OZFIFI--', 960, 1055, NULL, NULL, NULL, '9.90% | 95', 6, 6, 36, 'active', 50, NULL, NULL, NULL, '50.00% | 528', NULL, NULL, NULL, NULL, 5, 14, 36, '2025-07-09 16:32:47', '2025-07-09 16:32:47'),
(89, '2025-07-09', NULL, '0058-A', '89', '0058-A-BABY FROCK NET-ZERO-36-FITFI--', 480, 525, NULL, NULL, NULL, '9.38% | 45', 8, 3, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 263', NULL, NULL, NULL, NULL, 14, 16, 36, '2025-07-09 16:33:50', '2025-07-09 16:33:50'),
(90, '2025-07-09', NULL, '0058-B', '90', '0058-B-BABY FROCK NET-18/22-36-STHFI--', 580, 635, NULL, NULL, NULL, '9.48% | 55', 8, 3, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 318', NULL, NULL, NULL, NULL, 14, 6, 36, '2025-07-09 16:34:17', '2025-07-09 16:34:17'),
(91, '2025-07-09', NULL, '1223-B', '91', '1223-B-BABY FROCK NET-18/22-36-STHFI--', 580, 635, NULL, NULL, NULL, '9.48% | 55', 8, 3, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 318', NULL, NULL, NULL, NULL, 14, 6, 36, '2025-07-09 16:34:45', '2025-07-09 16:34:45'),
(92, '2025-07-09', NULL, 'H119', '92', 'H119-BABA SUITE HALF-1/2-12-FISZ--', 560, 560, 10, NULL, NULL, '10.00% | 56', 4, 8, 32, 'active', 50, 0, NULL, NULL, '50.00% | 280', NULL, NULL, NULL, NULL, 11, 15, 12, '2025-07-09 17:40:02', '2025-07-09 17:40:02'),
(93, '2025-07-09', NULL, 'H163', '93', 'H163-BABA SUITE HALF-1/2-12-SEFFI--', 745, 745, 10, NULL, NULL, '10.00% | 75', 3, 8, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 373', NULL, NULL, NULL, NULL, 11, 15, 12, '2025-07-09 17:40:20', '2025-07-09 17:40:20'),
(94, '2025-07-09', NULL, 'H365', '94', 'H365-BABA T-SHIRT HALF-18/24-12-FNFI--', 495, 495, 10, NULL, NULL, '10.00% | 50', 5, 8, 40, 'active', 50, NULL, NULL, NULL, '50.00% | 248', NULL, NULL, NULL, NULL, 15, 17, 12, '2025-07-09 17:41:08', '2025-07-09 17:41:08'),
(95, '2025-07-09', NULL, 'H367', '95', 'H367-BABA SHIRT HALF-18/24-12-FNFI--', 495, 495, 10, NULL, NULL, '10.00% | 50', 4, 8, 32, 'active', 50, NULL, NULL, NULL, '50.00% | 248', NULL, NULL, NULL, NULL, 16, 17, 12, '2025-07-09 17:41:53', '2025-07-09 17:41:53'),
(96, '2025-07-09', NULL, 'H368', '96', 'H368-BABA T-SHIRT HALF-18/24-12-FINFI--', 595, 595, 10, NULL, NULL, '10.00% | 60', 4, 8, 32, 'active', 50, NULL, NULL, NULL, '50.00% | 298', NULL, NULL, NULL, NULL, 15, 17, 12, '2025-07-09 17:42:23', '2025-07-09 17:42:23'),
(97, '2025-07-09', NULL, 'H369', '97', 'H369-BABA SHIRT HALF-20/24-12-FINFI--', 595, 595, 10, NULL, NULL, '10.00% | 60', 5, 6, 30, 'active', 50, NULL, NULL, NULL, '50.00% | 298', NULL, NULL, NULL, NULL, 16, 18, 12, '2025-07-09 17:42:54', '2025-07-09 17:42:54'),
(98, '2025-07-09', NULL, 'H374', '98', 'H374-BABA SHIRT HALF-20/24-12-FISFI--', 565, 565, 10, NULL, NULL, '10.00% | 57', 4, 6, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 283', NULL, NULL, NULL, NULL, 16, 18, 12, '2025-07-09 17:43:18', '2025-07-09 17:43:18'),
(99, '2025-07-09', NULL, 'H422', '99', 'H422-BABA SUITE HALF-SML-12-NTHFI--', 935, 935, 10, NULL, NULL, '10.00% | 94', 4, 6, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 468', NULL, NULL, NULL, NULL, 11, 3, 12, '2025-07-09 17:43:43', '2025-07-09 17:43:43'),
(100, '2025-07-09', NULL, 'H460', '100', 'H460-BABA SUITE HALF-M/L-12-NNFI--', 995, 995, 10, NULL, NULL, '10.00% | 100', 4, 8, 32, 'active', 50, NULL, NULL, NULL, '50.00% | 498', NULL, NULL, NULL, NULL, 11, 19, 12, '2025-07-09 17:44:11', '2025-07-09 17:44:11'),
(101, '2025-07-09', NULL, '1217', '101', '1217-BABY SUITE HALF-1/2-34-FFFI--', 410, 445, NULL, 5, NULL, '9.76% | 40', 4, 6, 24, 'active', 50, 0, NULL, NULL, '50.00% | 223', NULL, NULL, NULL, NULL, 5, 15, 34, '2025-07-09 17:47:52', '2025-07-09 17:47:52'),
(102, '2025-07-09', NULL, '1218', '102', '1218-BABY SUITE HALF-1/2-34-FFIFI--', 420, 455, NULL, 5, NULL, '9.52% | 40', 4, 6, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 228', NULL, NULL, NULL, NULL, 5, 15, 34, '2025-07-09 17:48:12', '2025-07-09 17:48:12'),
(103, '2025-07-09', NULL, '1219', '103', '1219-BABY SUITE HALF-18/22-34-SETZ--', 660, 720, NULL, 5, NULL, '9.85% | 65', 4, 6, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 360', NULL, NULL, NULL, NULL, 5, 6, 34, '2025-07-09 17:48:35', '2025-07-09 17:48:35'),
(104, '2025-07-09', NULL, '1220', '104', '1220-BABY SUITE HALF-18/22-34-SEOZ--', 650, 710, NULL, 5, NULL, '10.00% | 65', 4, 6, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 355', NULL, NULL, NULL, NULL, 5, 6, 34, '2025-07-09 17:48:57', '2025-07-09 17:48:57'),
(105, '2025-07-09', NULL, '1221', '105', '1221-BABY SUITE HALF-18/22-34-STFI--', 575, 625, NULL, 5, NULL, '9.57% | 55', 4, 6, 24, 'active', 50, NULL, NULL, NULL, '50.00% | 313', NULL, NULL, NULL, NULL, 5, 6, 34, '2025-07-09 17:49:24', '2025-07-09 17:49:24'),
(106, '2025-07-09', NULL, '9285', '106', '9285-BABY SUITE HALF-24/28-34-NFIFI--', 875, 955, NULL, 5, NULL, '9.71% | 85', 3, 6, 18, 'active', 50, NULL, NULL, NULL, '50.00% | 478', NULL, NULL, NULL, NULL, 5, 5, 34, '2025-07-09 17:49:46', '2025-07-09 17:49:46'),
(107, '2025-07-09', NULL, '9289', '107', '9289-BABY SUITE HALF-30/34-34-OTHZFI--', 1195, 1305, NULL, 5, NULL, '9.62% | 115', 3, 6, 18, 'active', 50, NULL, NULL, NULL, '50.00% | 653', NULL, NULL, NULL, NULL, 5, 14, 34, '2025-07-09 17:50:22', '2025-07-09 17:50:22'),
(108, '2025-07-09', NULL, '9290', '108', '9290-BABY SUITE HALF-30/34-34-OOSZ--', 1060, 1160, NULL, 5, NULL, '9.91% | 105', 3, 6, 18, 'active', 50, NULL, NULL, NULL, '50.00% | 580', NULL, NULL, NULL, NULL, 5, 14, 34, '2025-07-09 17:50:45', '2025-07-09 17:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `item_invoices`
--

CREATE TABLE `item_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `bill_no` int(11) NOT NULL,
  `vr_no` int(11) NOT NULL,
  `party_inv_date` date NOT NULL,
  `party_inv_no` varchar(255) DEFAULT NULL,
  `bilty_no` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `pkt_qty` int(11) NOT NULL,
  `total_pcs` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `less` int(11) NOT NULL,
  `g_amount` int(11) NOT NULL,
  `inv_disc_perc` int(11) DEFAULT NULL,
  `disc_perc` varchar(50) NOT NULL,
  `net_amount` int(11) NOT NULL,
  `freight` int(11) DEFAULT NULL,
  `paid_amount` int(11) DEFAULT NULL,
  `total_less` varchar(100) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `godown_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cash_amount` int(10) DEFAULT NULL,
  `cash_remarks` varchar(500) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `bank_account_title` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `bank_amount` int(10) DEFAULT NULL,
  `bank_remarks` varchar(500) DEFAULT NULL,
  `cheque_bank` varchar(500) DEFAULT NULL,
  `cheque_amount` int(10) DEFAULT NULL,
  `cheque_date` varchar(255) DEFAULT NULL,
  `cheque_remarks` varchar(500) DEFAULT NULL,
  `bt_from` varchar(255) DEFAULT NULL,
  `bt_to` varchar(255) DEFAULT NULL,
  `bt_account_title` varchar(255) DEFAULT NULL,
  `bt_account_number` varchar(255) DEFAULT NULL,
  `bt_amount` varchar(255) DEFAULT NULL,
  `bt_remarks` varchar(500) DEFAULT NULL,
  `payment_total_amount` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_invoices`
--

INSERT INTO `item_invoices` (`id`, `date`, `bill_no`, `vr_no`, `party_inv_date`, `party_inv_no`, `bilty_no`, `remarks`, `pkt_qty`, `total_pcs`, `amount`, `less`, `g_amount`, `inv_disc_perc`, `disc_perc`, `net_amount`, `freight`, `paid_amount`, `total_less`, `total_amount`, `payment_status`, `godown_id`, `cash_amount`, `cash_remarks`, `bank`, `bank_account_title`, `bank_account_number`, `bank_amount`, `bank_remarks`, `cheque_bank`, `cheque_amount`, `cheque_date`, `cheque_remarks`, `bt_from`, `bt_to`, `bt_account_title`, `bt_account_number`, `bt_amount`, `bt_remarks`, `payment_total_amount`, `created_at`, `updated_at`) VALUES
(1, '2025-01-08', 1, 1, '2025-01-08', '20', '30', 'remarks', 10, 0, 2600, 0, 2600, 20, '421', -8346, 30, 10, '0', -8356, 'cash', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-08 12:05:42', '2025-01-08 12:07:47'),
(2, '2025-01-08', 2, 1, '2025-01-08', '20', '30', 'remarks', 133, 200, 2400, 24600, -22200, 10, '421', -32304, 30, 50, '0', -32304, 'cash', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-08 12:07:06', '2025-01-08 13:00:43'),
(3, '2025-02-13', 3, 1, '2025-02-13', '2', '3', NULL, 20, 300, 3300, 2200, 1100, NULL, '20', 440, NULL, NULL, '1', 440, 'cash', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-13 11:52:00', '2025-02-13 11:52:00'),
(4, '2025-02-26', 4, 1, '2025-02-26', '10', '20', 'remarks', 20, 400, 4400, 2400, 2000, NULL, '20', 1120, NULL, NULL, '1', 1120, 'cash', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-26 11:29:53', '2025-02-26 11:29:53'),
(5, '2025-03-04', 5, 1, '2025-03-04', '20', '30', 'Remarks', 10, 200, 80, 40400, -38400, NULL, '20', -38800, NULL, 80, '0', -38800, 'cash', 1, 10, 'Remarks', NULL, NULL, NULL, 20, 'bank remarks', NULL, 50, '2025-03-04', 'cheque remarks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-04 07:49:38', '2025-03-04 07:49:38'),
(6, '2025-03-04', 6, 2, '2025-03-04', NULL, NULL, NULL, 30, 600, 6400, 80800, -74400, NULL, '20', -75680, NULL, 80, '0', -75680, 'cash', 1, 10, 'remarks', 'Meezan Bank', NULL, NULL, 20, 'remarks', 'Meezan Bank', 50, '2025-03-05', 'remarks 3', NULL, NULL, NULL, NULL, NULL, NULL, 80, '2025-03-04 07:52:41', '2025-03-04 07:52:41'),
(7, '2025-03-05', 7, 1, '2025-03-05', NULL, NULL, NULL, 10, 200, 2000, 0, 2000, NULL, '20', 1600, NULL, NULL, '5', 1600, 'cash', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-05 12:34:59', '2025-03-05 12:34:59'),
(8, '2025-03-05', 8, 2, '2025-03-05', 'A/234', 'B/123', NULL, 10, 200, 2000, 0, 2000, 20, '0% |  0', 2000, NULL, NULL, '5', 1600, 'cash', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-05 12:36:36', '2025-03-21 02:15:25'),
(9, '2025-03-19', 9, 1, '2025-03-19', NULL, NULL, NULL, 10, 200, 2000, 2000, 0, NULL, '123', -2460, NULL, 372, '0', -2832, 'cash', 1, 100, 'rem', 'Meezan Bank', 'title', '1234124', 123, 'remar 2', 'Meezan Bank', 50, '2025-03-18', 'remarks 3', 'Meezan Bank', 'Bank alfalah', 'acc', '074123', '99', 'remarks 4', 372, '2025-03-19 04:35:43', '2025-03-19 04:35:43'),
(10, '2025-03-21', 10, 1, '2025-03-21', NULL, NULL, NULL, 10, 200, 2000, 2000, 0, 10, '123% |  2460', -2460, NULL, NULL, '0', -2214, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-21 02:16:00', '2025-03-21 02:16:00'),
(11, '2025-03-21', 11, 2, '2025-03-21', NULL, NULL, NULL, 10, 200, 2000, 2000, 0, 10, '123% |  2460', -2460, NULL, 269, '0% | 4460', -2739, 'credit', 1, 100, 'remark', 'Bank alfalah', 'title', '1234124', 20, 'remark', 'Meezan Bank', 50, '2025-03-26', 'remark che', 'Meezan Bank', 'Meezan Bank', 'acc', '074123', '99', 'remark bt', 269, '2025-03-21 02:16:23', '2025-03-25 05:11:12'),
(12, '2025-04-28', 12, 1, '2025-04-21', '2284', '7566/2', NULL, 88, 528, 219180, 0, 219180, NULL, '10% |  21918', 197262, 1000, 157262, '10% | 21918', 41000, 'credit', 1, 7262, NULL, 'Meezan Bank', 'SHABEER AHMAD & CO', '0422765529664', 50000, NULL, 'Meezan Bank', 50000, '2025-05-10', NULL, 'Meezan Bank', 'Bank alfalah', 'SHABEER AHMAD & CO', '04227655669665', '50000', NULL, 157262, '2025-04-28 23:11:51', '2025-04-28 23:11:51'),
(13, '2025-04-28', 13, 2, '2025-04-28', NULL, NULL, NULL, 5, 30, 19200, 0, 19200, NULL, '10% |  1920', 17280, NULL, NULL, '10% | 1920', 17280, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-28 23:32:06', '2025-04-28 23:32:06'),
(14, '2025-06-18', 14, 1, '2025-05-23', '016', '8986/1', NULL, 57, 342, 243900, 0, 243900, NULL, '0% |  0', 243900, NULL, NULL, 'Infinity% | 0', 243900, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-19 00:26:04', '2025-06-19 00:26:04'),
(15, '2025-06-19', 15, 1, '2025-06-17', '007008', '4429/2', 'AL ANSARI GOOD TRANS. CO', 60, 360, 194400, 1800, 192600, NULL, 'null% |  0', 192600, NULL, 142600, '108% | 1800', 50000, 'credit', 1, 600, NULL, 'Meezan Bank', 'SAIF KHALID', '01006665544863', 50000, NULL, 'Meezan Bank', 42000, '2025-06-30', NULL, 'Meezan Bank', 'Bank alfalah', 'SAIF KHALID', '01001155664886', '50000', NULL, 142600, '2025-06-19 15:58:58', '2025-06-19 16:00:33'),
(16, '2025-06-19', 16, 2, '2025-06-16', 'C3840', '10561/1', NULL, 49, 294, 275280, 0, 275280, NULL, '10% |  27528', 247752, NULL, 147752, '10% | 27528', 100000, 'credit', 1, 7752, NULL, 'Meezan Bank', 'BEST BOY BY AL JOBAT', '0111554488862', 40000, NULL, 'Meezan Bank', 50000, '2025-06-28', NULL, 'Meezan Bank', 'Bank alfalah', 'BEST BOY BY AL JOBAT', '01155545564', '50000', NULL, 147752, '2025-06-19 16:31:50', '2025-06-19 16:31:50'),
(17, '2025-06-19', 17, 3, '2025-06-15', '1599', '265700/1', NULL, 30, 180, 137340, 900, 136440, NULL, '0% |  0', 136440, NULL, NULL, '153% | 900', 136440, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-19 16:55:04', '2025-06-19 16:55:04'),
(18, '2025-06-23', 18, 1, '2025-06-21', '7221', '8769/2', NULL, 108, 648, 301920, 0, 301920, NULL, '0% |  0', 301920, NULL, NULL, 'Infinity% | 0', 301920, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-23 16:20:36', '2025-06-23 16:20:36'),
(19, '2025-07-08', 19, 1, '2025-07-08', '10', '30', 'remarks', 15, 230, 110900, 0, 110900, 10, '0% |  0', 110900, 10, 20, 'Infinity% | 0', 110880, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-09 03:23:39', '2025-07-09 03:23:39'),
(20, '2025-07-08', 20, 2, '2025-07-08', NULL, NULL, NULL, 10, 20, 9200, 0, 9200, NULL, '0% |  0', 9200, NULL, NULL, 'Infinity% | 0', 9200, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-09 03:29:09', '2025-07-09 03:29:09'),
(21, '2025-07-08', 21, 3, '2025-07-08', NULL, NULL, NULL, 20, 400, 178000, 0, 178000, 5, '30% |  53400', 124600, 10, 4, '4% | 41000', 124601, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-09 03:34:38', '2025-07-09 03:34:38'),
(22, '2025-07-09', 22, 1, '2025-07-09', '715', '254811/2', NULL, 80, 408, 315480, 0, 315480, 1000, 'null% |  0', 315480, 2000, 65480, 'Infinity% | 0', 251000, 'credit', 1, 480, 'RAMZAN', 'Meezan Bank', 'RAMZAN ALI', '10007655545566', 5000, NULL, 'Meezan Bank', 10000, '2025-08-01', 'SELF', 'Meezan Bank', 'Bank alfalah', 'RAMZAN ALI', '10005545566554', '50000', 'CHAND RAT', 65480, '2025-07-09 16:40:45', '2025-07-09 17:38:35'),
(23, '2025-07-09', 23, 2, '2025-07-09', 'C1901', '5842/1', NULL, 37, 270, 176170, 0, 176170, NULL, '10% |  17617', 158553, NULL, NULL, '10% | 17617', 158553, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-09 17:44:45', '2025-07-09 17:44:45'),
(24, '2025-07-09', 24, 3, '2025-07-09', '1351', '253336/1', NULL, 29, 174, 121500, 0, 121500, NULL, '0% |  0', 121500, NULL, NULL, '140% | 870', 121500, 'credit', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-09 17:51:19', '2025-07-09 17:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `item_invoice_lists`
--

CREATE TABLE `item_invoice_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `party_item_code` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `godown` varchar(100) DEFAULT NULL,
  `packet_qty` int(11) DEFAULT NULL,
  `pieces_in_packet` int(11) DEFAULT NULL,
  `total_pcs` int(11) DEFAULT NULL,
  `purchase_rate` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `less_per_pcs` decimal(10,2) DEFAULT NULL,
  `discount_per_pcs` decimal(10,2) DEFAULT NULL,
  `l_rate` decimal(10,2) DEFAULT NULL,
  `gross_amount` decimal(10,2) DEFAULT NULL,
  `total_less` decimal(10,2) DEFAULT NULL,
  `total_discount_percent` decimal(5,2) DEFAULT NULL,
  `party_less_total` decimal(10,2) DEFAULT NULL,
  `party_total_discount` decimal(10,2) DEFAULT NULL,
  `party_discount` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_invoice_lists`
--

INSERT INTO `item_invoice_lists` (`id`, `item_invoice_id`, `item_id`, `created_at`, `updated_at`, `barcode`, `party_item_code`, `description`, `godown`, `packet_qty`, `pieces_in_packet`, `total_pcs`, `purchase_rate`, `amount`, `less_per_pcs`, `discount_per_pcs`, `l_rate`, `gross_amount`, `total_less`, `total_discount_percent`, `party_less_total`, `party_total_discount`, `party_discount`) VALUES
(1, 1, 3, '2025-01-08 12:06:19', '2025-01-08 12:06:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 3, '2025-01-08 12:35:09', '2025-01-08 12:35:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 2, '2025-01-08 13:00:43', '2025-01-08 13:00:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 3, 4, '2025-02-13 11:52:00', '2025-02-13 11:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 3, 3, '2025-02-13 11:52:00', '2025-02-13 11:52:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 4, 12, '2025-02-26 11:29:53', '2025-02-26 11:29:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 4, 11, '2025-02-26 11:29:53', '2025-02-26 11:29:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 5, 13, '2025-03-04 07:49:38', '2025-03-04 07:49:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 6, 14, '2025-03-04 07:52:41', '2025-03-04 07:52:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 6, 13, '2025-03-04 07:52:41', '2025-03-04 07:52:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 7, 22, '2025-03-05 12:34:59', '2025-03-05 12:34:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 8, 23, '2025-03-05 12:36:36', '2025-03-05 12:36:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 9, 24, '2025-03-19 04:35:43', '2025-03-19 04:35:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 10, 24, '2025-03-21 02:16:00', '2025-03-21 02:16:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 11, 24, '2025-03-21 02:16:23', '2025-03-21 02:16:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 12, 25, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 12, 26, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 12, 27, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 12, 28, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 12, 29, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 12, 30, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 12, 31, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 12, 32, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 12, 33, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 12, 34, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 12, 35, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 12, 36, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 12, 37, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 12, 39, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 12, 38, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 12, 40, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 12, 41, '2025-04-28 23:11:51', '2025-04-28 23:11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 13, 42, '2025-04-28 23:32:06', '2025-04-28 23:32:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 14, 43, '2025-06-19 00:26:04', '2025-06-19 00:26:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 14, 44, '2025-06-19 00:26:04', '2025-06-19 00:26:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 15, 45, '2025-06-19 15:58:58', '2025-06-19 15:58:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 15, 46, '2025-06-19 15:58:58', '2025-06-19 15:58:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 15, 47, '2025-06-19 15:58:58', '2025-06-19 15:58:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 15, 48, '2025-06-19 15:58:58', '2025-06-19 15:58:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 15, 49, '2025-06-19 15:58:58', '2025-06-19 15:58:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 16, 50, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 16, 51, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 16, 52, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 16, 53, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 16, 54, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 16, 55, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 16, 56, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 16, 57, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 16, 58, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 16, 59, '2025-06-19 16:31:50', '2025-06-19 16:31:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 17, 60, '2025-06-19 16:55:04', '2025-06-19 16:55:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 17, 61, '2025-06-19 16:55:04', '2025-06-19 16:55:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 17, 62, '2025-06-19 16:55:04', '2025-06-19 16:55:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 17, 63, '2025-06-19 16:55:04', '2025-06-19 16:55:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 17, 64, '2025-06-19 16:55:04', '2025-06-19 16:55:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 17, 65, '2025-06-19 16:55:04', '2025-06-19 16:55:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 18, 67, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 18, 68, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 18, 69, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 18, 70, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 18, 71, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 18, 72, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 18, 73, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 18, 74, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 18, 75, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 18, 76, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 18, 77, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 18, 78, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 18, 79, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 18, 67, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 18, 68, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 18, 69, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 18, 70, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 18, 71, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 18, 72, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 18, 73, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 18, 74, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 18, 75, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 18, 76, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 18, 77, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 18, 78, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 18, 79, '2025-06-23 16:20:36', '2025-06-23 16:20:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 21, 79, '2025-07-09 03:34:38', '2025-07-09 03:34:38', '79', '7087', '7087-BABY SUITE HALF-18/22-11-FIZFI--', 'Warehouse', 10, 20, 200, 460.00, 92000.00, 20.00, 46.00, 394.00, 78800.00, 13200.00, 21.96, 4000.00, 9200.00, 10.00),
(86, 21, 77, '2025-07-09 03:34:38', '2025-07-09 03:34:38', '77', '6040', '6040-BABY SUITE HALF-18/22-11-FSEZ--', 'Warehouse', 10, 20, 200, 430.00, 86000.00, 10.00, 129.00, 291.00, 58200.00, 27800.00, 40.70, 2000.00, 25800.00, 30.00),
(87, 22, 80, '2025-07-09 16:40:45', '2025-07-09 16:40:45', '80', '2130-C', '2130-C-BABY SUITE HALF-24/28-36-NOZ--', 'Warehouse', 8, 6, 48, 830.00, 39840.00, NULL, 0.00, 830.00, 39840.00, 0.00, 9.64, 0.00, 0.00, NULL),
(88, 22, 81, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '81', '2130-D', '2130-D-BABY SUITE HALF-30/34-36-OZEFI--', 'Warehouse', 8, 6, 48, 990.00, 47520.00, NULL, 0.00, 990.00, 47520.00, 0.00, 9.60, 0.00, 0.00, NULL),
(89, 22, 82, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '82', '3022-B', '3022-B-BABY SUITE HALF-18/22-36-SOFI--', 'Warehouse', 4, 6, 24, 560.00, 13440.00, NULL, 0.00, 560.00, 13440.00, 0.00, 9.82, 0.00, 0.00, NULL),
(90, 22, 83, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '83', '3022-C', '3022-C-BABY SUITE HALF-24/28-36-SETFI--', 'Warehouse', 6, 6, 36, 660.00, 23760.00, NULL, 0.00, 660.00, 23760.00, 0.00, 9.85, 0.00, 0.00, NULL),
(91, 22, 84, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '84', '2126-B', '2126-B-BABY SUITE HALF-18/22-36-SEFIFI--', 'Warehouse', 6, 6, 36, 690.00, 24840.00, NULL, 0.00, 690.00, 24840.00, 0.00, 9.42, 0.00, 0.00, NULL),
(92, 22, 85, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '85', '2126-C', '2126-C-BABY SUITE HALF-24/28-36-ENZ--', 'Warehouse', 6, 6, 36, 810.00, 29160.00, NULL, 0.00, 810.00, 29160.00, 0.00, 9.88, 0.00, 0.00, NULL),
(93, 22, 86, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '86', '2126-D', '2126-D-BABY SUITE HALF-30/34-36-OZSFI--', 'Warehouse', 6, 6, 36, 970.00, 34920.00, NULL, 0.00, 970.00, 34920.00, 0.00, 9.79, 0.00, 0.00, NULL),
(94, 22, 87, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '87', '2133-B', '2133-B-BABY SUITE HALF-24/28-36-EFIFI--', 'Warehouse', 6, 6, 36, 780.00, 28080.00, NULL, 0.00, 780.00, 28080.00, 0.00, 9.62, 0.00, 0.00, NULL),
(95, 22, 88, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '88', '2133-C', '2133-C-BABY SUITE HALF-30/34-36-OZFIFI--', 'Warehouse', 6, 6, 36, 960.00, 34560.00, NULL, 0.00, 960.00, 34560.00, 0.00, 9.90, 0.00, 0.00, NULL),
(96, 22, 89, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '89', '0058-A', '0058-A-BABY FROCK NET-ZERO-36-FITFI--', 'Warehouse', 8, 3, 24, 480.00, 11520.00, NULL, 0.00, 480.00, 11520.00, 0.00, 9.38, 0.00, 0.00, NULL),
(97, 22, 90, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '90', '0058-B', '0058-B-BABY FROCK NET-18/22-36-STHFI--', 'Warehouse', 8, 3, 24, 580.00, 13920.00, NULL, 0.00, 580.00, 13920.00, 0.00, 9.48, 0.00, 0.00, NULL),
(98, 22, 91, '2025-07-09 17:38:35', '2025-07-09 17:38:35', '91', '1223-B', '1223-B-BABY FROCK NET-18/22-36-STHFI--', 'Warehouse', 8, 3, 24, 580.00, 13920.00, NULL, 0.00, 580.00, 13920.00, 0.00, 9.48, 0.00, 0.00, NULL),
(99, 23, 92, '2025-07-09 17:44:45', '2025-07-09 17:44:45', '92', 'H119', 'H119-BABA SUITE HALF-1/2-12-FISZ--', 'Warehouse', 4, 8, 32, 560.00, 17920.00, NULL, 56.00, 504.00, 16128.00, 1792.00, 10.00, 0.00, 1792.00, 10.00),
(100, 23, 93, '2025-07-09 17:44:45', '2025-07-09 17:44:45', '93', 'H163', 'H163-BABA SUITE HALF-1/2-12-SEFFI--', 'Warehouse', 3, 8, 24, 745.00, 17880.00, NULL, 74.50, 670.50, 16092.00, 1788.00, 10.00, 0.00, 1788.00, 10.00),
(101, 23, 94, '2025-07-09 17:44:45', '2025-07-09 17:44:45', '94', 'H365', 'H365-BABA T-SHIRT HALF-18/24-12-FNFI--', 'Warehouse', 5, 8, 40, 495.00, 19800.00, NULL, 49.50, 445.50, 17820.00, 1980.00, 10.00, 0.00, 1980.00, 10.00),
(102, 23, 95, '2025-07-09 17:44:45', '2025-07-09 17:44:45', '95', 'H367', 'H367-BABA SHIRT HALF-18/24-12-FNFI--', 'Warehouse', 4, 8, 32, 495.00, 15840.00, NULL, 49.50, 445.50, 14256.00, 1584.00, 10.00, 0.00, 1584.00, 10.00),
(103, 23, 96, '2025-07-09 17:44:45', '2025-07-09 17:44:45', '96', 'H368', 'H368-BABA T-SHIRT HALF-18/24-12-FINFI--', 'Warehouse', 4, 8, 32, 595.00, 19040.00, NULL, 59.50, 535.50, 17136.00, 1904.00, 10.00, 0.00, 1904.00, 10.00),
(104, 23, 97, '2025-07-09 17:44:45', '2025-07-09 17:44:45', '97', 'H369', 'H369-BABA SHIRT HALF-20/24-12-FINFI--', 'Warehouse', 5, 6, 30, 595.00, 17850.00, NULL, 59.50, 535.50, 16065.00, 1785.00, 10.00, 0.00, 1785.00, 10.00),
(105, 23, 98, '2025-07-09 17:44:45', '2025-07-09 17:44:45', '98', 'H374', 'H374-BABA SHIRT HALF-20/24-12-FISFI--', 'Warehouse', 4, 6, 24, 565.00, 13560.00, NULL, 56.50, 508.50, 12204.00, 1356.00, 10.00, 0.00, 1356.00, 10.00),
(106, 23, 99, '2025-07-09 17:44:45', '2025-07-09 17:44:45', '99', 'H422', 'H422-BABA SUITE HALF-SML-12-NTHFI--', 'Warehouse', 4, 6, 24, 935.00, 22440.00, NULL, 93.50, 841.50, 20196.00, 2244.00, 10.00, 0.00, 2244.00, 10.00),
(107, 23, 100, '2025-07-09 17:44:45', '2025-07-09 17:44:45', '100', 'H460', 'H460-BABA SUITE HALF-M/L-12-NNFI--', 'Warehouse', 4, 8, 32, 995.00, 31840.00, NULL, 99.50, 895.50, 28656.00, 3184.00, 10.00, 0.00, 3184.00, 10.00),
(108, 24, 101, '2025-07-09 17:51:19', '2025-07-09 17:51:19', '101', '1217', '1217-BABY SUITE HALF-1/2-34-FFFI--', 'Warehouse', 4, 6, 24, 410.00, 9840.00, 5.00, 0.00, 405.00, 9720.00, 120.00, 9.76, 120.00, 0.00, NULL),
(109, 24, 102, '2025-07-09 17:51:19', '2025-07-09 17:51:19', '102', '1218', '1218-BABY SUITE HALF-1/2-34-FFIFI--', 'Warehouse', 4, 6, 24, 420.00, 10080.00, 5.00, 0.00, 415.00, 9960.00, 120.00, 9.52, 120.00, 0.00, NULL),
(110, 24, 103, '2025-07-09 17:51:19', '2025-07-09 17:51:19', '103', '1219', '1219-BABY SUITE HALF-18/22-34-SETZ--', 'Warehouse', 4, 6, 24, 660.00, 15840.00, 5.00, 0.00, 655.00, 15720.00, 120.00, 9.85, 120.00, 0.00, NULL),
(111, 24, 104, '2025-07-09 17:51:19', '2025-07-09 17:51:19', '104', '1220', '1220-BABY SUITE HALF-18/22-34-SEOZ--', 'Warehouse', 4, 6, 24, 650.00, 15600.00, 5.00, 0.00, 645.00, 15480.00, 120.00, 10.00, 120.00, 0.00, NULL),
(112, 24, 105, '2025-07-09 17:51:19', '2025-07-09 17:51:19', '105', '1221', '1221-BABY SUITE HALF-18/22-34-STFI--', 'Warehouse', 4, 6, 24, 575.00, 13800.00, 5.00, 0.00, 570.00, 13680.00, 120.00, 9.57, 120.00, 0.00, NULL),
(113, 24, 106, '2025-07-09 17:51:19', '2025-07-09 17:51:19', '106', '9285', '9285-BABY SUITE HALF-24/28-34-NFIFI--', 'Warehouse', 3, 6, 18, 875.00, 15750.00, 5.00, 0.00, 870.00, 15660.00, 90.00, 9.71, 90.00, 0.00, NULL),
(114, 24, 107, '2025-07-09 17:51:19', '2025-07-09 17:51:19', '107', '9289', '9289-BABY SUITE HALF-30/34-34-OTHZFI--', 'Warehouse', 3, 6, 18, 1195.00, 21510.00, 5.00, 0.00, 1190.00, 21420.00, 90.00, 9.62, 90.00, 0.00, NULL),
(115, 24, 108, '2025-07-09 17:51:19', '2025-07-09 17:51:19', '108', '9290', '9290-BABY SUITE HALF-30/34-34-OOSZ--', 'Warehouse', 3, 6, 18, 1060.00, 19080.00, 5.00, 0.00, 1055.00, 18990.00, 90.00, 9.91, 90.00, 0.00, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_10_04_072409_create_sessions_table', 1),
(7, '2024_12_12_120153_create_cities_table', 2),
(8, '2024_12_12_120313_create_areas_table', 2),
(9, '2024_12_12_120458_create_parties_table', 3),
(10, '2025_01_04_143354_create_party_mobiles_table', 4),
(12, '2025_01_04_160123_create_party_lesses_table', 5),
(13, '2025_01_05_143615_create_define_items_table', 5),
(14, '2025_01_05_143626_create_define_sizes_table', 5),
(15, '2025_01_05_143627_create_items_table', 5),
(16, '2025_01_08_123727_create_godowns_table', 6),
(18, '2025_01_08_130631_create_item_invoices_table', 7),
(19, '2025_01_08_154241_create_item_invoice_lists_table', 7),
(20, '2025_02_13_135925_create_settings_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `bill_limit` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `care_of` varchar(255) DEFAULT NULL,
  `whatsapp_greeting` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `whatsapp_file` varchar(255) DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `date`, `image`, `name`, `type`, `address`, `discount`, `remark`, `status`, `bill_limit`, `duration`, `email`, `care_of`, `whatsapp_greeting`, `file`, `whatsapp_file`, `area_id`, `mobile`, `label`, `created_at`, `updated_at`) VALUES
(1, '2025-01-04', NULL, 'Abdul', 'Income', 'address details', '20', 'remarks', 'active', '123', '2', 'abdul@gmail.com', 'care of', 'greeting', NULL, NULL, 9, '1234', 'mobile shop', '2025-01-04 09:01:54', '2025-01-04 09:09:11'),
(2, '2025-01-05', NULL, 'Test', 'Income', 'address', '20', 'remark', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '1234', 'label', '2025-01-05 05:59:39', '2025-01-05 05:59:39'),
(3, '2025-01-05', NULL, 'Abdul', 'Income', 'address', '20', 'remark', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '1234', 'mobile shop', '2025-01-05 06:02:56', '2025-01-05 06:02:56'),
(4, '2025-01-05', NULL, 'test', 'Income', 'address', '29', 'remark', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '123', '2123', '2025-01-05 06:04:21', '2025-01-05 06:04:21'),
(5, '2025-01-05', NULL, 'test', 'Income', 'address', '123', 'remark', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '1234', 'label', '2025-01-05 06:04:53', '2025-01-05 06:04:53'),
(6, '2025-01-05', NULL, 'Abdul', 'Income', 'address', '10', 'remarks', 'inactive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '1234', 'label', '2025-01-05 06:07:27', '2025-01-05 06:13:23'),
(7, '2025-01-05', NULL, 'Abdul', 'Income', 'address', '10', 'remarks', 'inactive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '1234', 'label', '2025-01-09 11:11:52', '2025-01-09 13:12:48'),
(8, '2025-01-09', NULL, 'AL ASIM HOSIERY STORE GUJRANWALA', 'Creditor', 'GALI MOLVI SARAJ DIN, SHOP #257,BAZAR THANE WALA,NEAR THATHYARAN WALI GALI,', '10', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, '03217415994', 'OFFICE', '2025-01-09 11:40:20', '2025-01-09 11:40:20'),
(9, '2025-01-09', NULL, 'AMNA FAISHION MULTAN', 'Creditor', 'HOUSE #5-B-2,L-600, GULSHAN-E-SAEED,', '10', 'WAQAS SAHIB', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '03002343619', 'OFFICE', '2025-01-09 13:18:16', '2025-02-10 04:15:41'),
(10, '2025-02-10', NULL, 'Test', 'Income', 'Address', '', 'remarks', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '1234567', 'label', '2025-02-10 04:51:04', '2025-03-21 00:42:02'),
(11, '2023-01-01', NULL, 'NADEEM GARMENTS KARACHI', 'Creditor', 'ADD', NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, '03227655344', 'OFFICE', '2022-12-31 20:12:25', '2025-06-23 16:04:45'),
(12, '2025-03-04', NULL, 'BEST BOY BY AL JOBAT GARMENTS KARACHI', 'Creditor', 'NORTH KARACHI', '10', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, '03033656711', 'OFFICE', '2025-03-04 20:43:17', '2025-03-04 20:43:17'),
(13, '2025-03-21', NULL, 'test', 'Income', 'address', NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '1235', 'label', '2025-03-21 00:42:57', '2025-03-21 00:42:57'),
(14, '2025-04-28', NULL, 'MY & ME GARMENTS (ADNAN) KARACHI', 'Creditor', '11-G', '10', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, '03222117317', 'ADNAN', '2025-04-28 22:55:33', '2025-04-28 22:55:54'),
(23, '', NULL, 'DOST KHAN GARMENTS FAISALABAD', 'CREDITOR', '', NULL, 'DEAL IN KNITTING WEAR', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(24, '', NULL, 'JAMNI COLLECTION M SULEMAN NATHU KARACHI', 'CREDITOR', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL, NULL, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(25, '', NULL, 'IQRA BEERA ANWER LAHORE', 'CREDITOR', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, NULL, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(26, '', NULL, 'THREE STAR GARMENTS ASIF LAHORE', 'CREDITOR', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, NULL, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(27, '', NULL, 'SARDAR GARMENTS SHOPPING CENTER LAYYAH', 'DEBITOR', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, NULL, NULL, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(28, '', NULL, 'AL HARAM FASHION JHANG BAZAR', 'DEBITOR', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, NULL, NULL, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(29, '', NULL, 'BABA SULTAN MAKUANA', 'DEBITOR', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, NULL, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(30, '', NULL, 'SIAL CUTE KIDS GARMENTS CHINIOT', 'DEBITOR', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, NULL, NULL, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(31, '', NULL, 'M S KIDS CENTER WAH CANTT', 'DEBITOR', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, NULL, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(32, '2025-06-18', NULL, 'CAT WALK GARMENTS LAHORE', 'Creditor', 'BARDEN ROAD, NEW MALIK PARK, SANGIYAN ROAD, NEAR SANGIYAN TOLL PLAZA,', NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '03014848233', 'M WARIS', '2025-06-19 00:20:52', '2025-06-19 00:20:52'),
(33, '2025-06-19', NULL, 'AL SAIF GARMENTS KARACHI', 'Creditor', 'NEW KARACHI', NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, '03006674556', 'FACTORY', '2025-06-19 15:48:31', '2025-06-19 15:48:31'),
(34, '2025-06-19', NULL, 'G-P CARE BY UROOJ GARMENTS KARACHI', 'Creditor', 'NEW KARACHI', NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, '03219254141', 'ASIF SHEIKH', '2025-06-19 16:42:48', '2025-06-19 16:42:48'),
(35, '2025-06-19', NULL, 'TAYA FASHION BY ASHRAF BROTHERS KARACHI', 'Creditor', 'NEW KARACHI', NULL, NULL, 'active', '100000', '15', 'havelywale@gmail.com', 'HAVELY WALE', NULL, NULL, NULL, 24, '03312422308', 'ASHRAF', '2025-06-19 17:13:37', '2025-06-19 17:14:36'),
(36, '2025-07-09', NULL, 'JOJEY GARMENTS KARACHI', 'Creditor', '125/12, SECTOR 11-G, NEW KARACHI, NEAR NOORANI MASJID', NULL, 'AIMAN KOLEKSI', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, '03152327138', 'OFFICE', '2025-07-09 16:23:37', '2025-07-09 16:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `party_lesses`
--

CREATE TABLE `party_lesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `less` int(11) DEFAULT NULL,
  `party_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `party_lesses`
--

INSERT INTO `party_lesses` (`id`, `from`, `to`, `less`, `party_id`, `created_at`, `updated_at`) VALUES
(1, 1, 499, 20, 6, '2025-01-08 03:17:36', '2025-01-08 03:17:36'),
(2, 500, 1000, 30, 6, '2025-01-08 03:17:36', '2025-01-08 03:17:36'),
(3, 1, 499, 20, 7, '2025-01-09 11:17:45', '2025-01-09 11:17:45'),
(4, 500, 1000, 30, 7, '2025-01-09 11:17:45', '2025-01-09 11:17:45'),
(5, 1, 300, 5, 8, '2025-01-09 11:40:20', '2025-01-09 11:40:20'),
(6, 1, 300, 5, 9, '2025-01-09 13:18:16', '2025-01-09 13:18:16'),
(7, 301, 500, 10, 9, '2025-01-09 13:18:16', '2025-01-09 13:18:16'),
(8, 0, 0, 0, 10, '2025-02-10 04:51:04', '2025-03-21 00:42:02'),
(9, 0, 0, 0, 11, '2022-12-31 20:12:25', '2025-03-21 00:30:45'),
(11, 500, 1000, 20, 27, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(12, 1, 5000, 5, 33, '2025-06-19 15:48:31', '2025-06-19 15:48:31'),
(13, 1, 5000, 5, 34, '2025-06-19 16:42:48', '2025-06-19 16:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `party_mobiles`
--

CREATE TABLE `party_mobiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `party_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `party_mobiles`
--

INSERT INTO `party_mobiles` (`id`, `mobile`, `label`, `party_id`, `created_at`, `updated_at`) VALUES
(1, '123456', 'shop 2', 1, '2025-01-04 09:51:58', '2025-01-04 09:59:58'),
(2, '123', 'shop5', 1, '2025-01-04 09:51:58', '2025-01-04 10:18:09'),
(6, '123456', 'shop 2', 6, '2025-01-05 06:08:06', '2025-01-05 06:08:06'),
(7, '123456', 'shop 2', 7, '2025-01-09 11:11:52', '2025-01-09 11:17:45'),
(8, '03215754444', 'WAREHOUSE', 8, '2025-01-09 11:40:20', '2025-01-09 11:40:20'),
(9, '03212218906', 'WAREHOUSE', 9, '2025-01-09 13:18:16', '2025-01-09 13:18:16'),
(10, '03123258927', 'WORK', 9, '2025-01-09 13:18:16', '2025-01-09 13:18:16'),
(11, '123456', 'shop 2', 2, '2025-01-09 13:26:59', '2025-01-09 13:26:59'),
(12, '123', 'shop5', 2, '2025-01-09 13:26:59', '2025-01-09 13:26:59'),
(13, '', '', 10, '2025-02-10 04:51:04', '2025-03-21 00:42:02'),
(14, '03337655455', 'WAREHOUSE', 11, '2022-12-31 20:12:25', '2022-12-31 20:12:25'),
(15, '03117655699', 'WAREHOUSE', 12, '2025-03-04 20:43:17', '2025-03-04 20:43:17'),
(18, '03014765190', 'OFFICE', 25, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(19, '031727220970', NULL, 30, '2025-06-18 22:33:21', '2025-06-18 22:33:21'),
(20, '03064337628', 'FACTORY', 32, '2025-06-19 00:20:52', '2025-06-19 00:20:52'),
(21, '03222154306', 'M HASSAN', 35, '2025-06-19 17:13:37', '2025-06-19 17:13:37'),
(22, '03212518614', 'WAREHOUSE', 36, '2025-07-09 16:23:37', '2025-07-09 16:23:37'),
(23, '03166190226', 'FACTORY', 36, '2025-07-09 16:23:37', '2025-07-09 16:23:37'),
(24, '02136904412', 'PTCL', 36, '2025-07-09 16:23:37', '2025-07-09 16:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3hIqm5tjoO2q5ys1Wkh2vyxv3WiRK3w9ZksJbaGy', NULL, '196.251.72.247', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXB0RHBBdVQ0M3kycHV2OGVHZkVjc3ZCOThDSjJMNU80TUtxQ0ZSUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUvcGFydHkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753985822),
('3ZHaR2tL0ZGfH0de6Y5Ug5Ebe9Q26u0eRv8Hz7DC', NULL, '20.171.207.45', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.2; +https://openai.com/gptbot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjFRamlMdFZSODVJMGlMbm9JT3ljWnpydnJnRTdWd1NKZE84SHM3bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUvcGFydHkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1754108337),
('7cuQbMahmjUPfImwaykAQPv5myQOgY79ihqBZN9Q', NULL, '58.65.221.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGhRdTg4b21UbXJtUE1IZDhwZEZ5SENqcFZERE5lNk84SHBIYzYwNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUvcHVibGljL2l0ZW0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753971008),
('8EJheWULOp9nYsoP7oy3WSlBwv2ChWIztSdwNUoc', NULL, '3.138.185.30', 'Mozilla/5.0 zgrab/0.x', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQW1OZnFVMHVUVkw4aklUZllMcVpXTWxyWWFvSGduSVFSaEVIeDI2dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753996869),
('e4QKPOsGnc6avdHvN0OyUwbFUcHXUIIzTzUVbHcm', NULL, '3.138.185.30', 'Mozilla/5.0 zgrab/0.x', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUVyNnZtZUwyOGlpQUhGT2lyWHQycnF2STBJSWkzMkJMMGxRdldZYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUvcGFydHkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753996869),
('H20gT8ufjgDLVlnvRUGDAxtXpoSMFfAAZpjMeuxB', NULL, '43.242.103.17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3VNQ3RXaXNvWGtkVUNSMTVpcFY0bEFYUE5lczJLcEowR2ZsUHZRVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUvcHVibGljL2l0ZW0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753974599),
('hAgJTK9NypWB8I6WXuT1U1sTJcBZcMED77UJrc0S', NULL, '3.138.185.30', 'Mozilla/5.0 zgrab/0.x', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0NZaXB0eW1VTWhOUHIxZVJwYlBzYUROWWZsVW5FVnJhV1ZlVzF4MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUvcGFydHkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753996869),
('HNRdze8nol9mOMDaHM5guu4zwimiFmic6DDw5e6Q', NULL, '196.251.72.247', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2hiR2lVWHU0MWxXVWduTFpDRzZDUHIzUGdRRUhYZHcyVURPR09HVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753985821),
('MPzj9rPXL3YUFe77GrFhUWhF2HNWJlWSn0nnv4O2', NULL, '13.56.158.243', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2U1SWVsbWNNUDBzT0cxcERTbXhhcVFmZ2lseEpoYUR5a2xlWXppZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUvcGFydHkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1754078154),
('n5XYX3XdSvl9cLGV6i01ARDtbrL4R4H1WsVcguWi', NULL, '39.39.230.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3hsSXBEOEdLeHk0dU5IWlRQUUlDbFBFZkFPS0ZZdkRCMlp5T202VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUvY3VzdG9tZXItcGF5bWVudC1yZWNlaXZlZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753973586),
('Sx4I8ylnaWhpUhaHLA8bTs7LP4ep2yvB3zFt0fr2', NULL, '3.138.185.30', 'Mozilla/5.0 zgrab/0.x', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVRIREFuSm9VSzNycHFMQ2dRaTVuRFJkZkhrUkpUWHBVRndpUXo5ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753996869),
('X2rWCLI8wQe7ntAlw3LzKIt39TkoITQ6KyzqPZwB', NULL, '196.251.72.247', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkNacXpZNU82NFY4TnNpMWlOMTdjTFhoMmRuY0x4azlGejQxWGxoeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vcG9zMi5mcmVlbGFuY2VkZW1vLnNpdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1753985821),
('YT6AYYppKIqkSSEGkjsgRIjDoAeIzrmGmPCUXvef', NULL, '20.171.207.39', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.2; +https://openai.com/gptbot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUFJQzFjVjBRYUpGR2xRU3Vlazc2bk5TYzdiM0l5QU80dFNFZGF2VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vd3d3LnBvczIuZnJlZWxhbmNlZGVtby5zaXRlL3BhcnR5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1754103301);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `retail_sale_rate` int(11) NOT NULL,
  `retail_sale_rate_rs` int(10) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `retail_sale_rate`, `retail_sale_rate_rs`, `barcode`, `created_at`, `updated_at`) VALUES
(1, 50, 0, 'size_4', NULL, '2025-07-10 10:57:08');

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
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_city_id_foreign` (`city_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `define_items`
--
ALTER TABLE `define_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `define_sizes`
--
ALTER TABLE `define_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `godowns`
--
ALTER TABLE `godowns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_party_id_foreign` (`party_id`);

--
-- Indexes for table `item_invoices`
--
ALTER TABLE `item_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_invoices_godown_id_foreign` (`godown_id`);

--
-- Indexes for table `item_invoice_lists`
--
ALTER TABLE `item_invoice_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_invoice_lists_item_invoice_id_foreign` (`item_invoice_id`),
  ADD KEY `item_invoice_lists_item_id_foreign` (`item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parties_area_id_foreign` (`area_id`);

--
-- Indexes for table `party_lesses`
--
ALTER TABLE `party_lesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_lesses_party_id_foreign` (`party_id`);

--
-- Indexes for table `party_mobiles`
--
ALTER TABLE `party_mobiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_mobiles_party_id_foreign` (`party_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `define_items`
--
ALTER TABLE `define_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `define_sizes`
--
ALTER TABLE `define_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `godowns`
--
ALTER TABLE `godowns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `item_invoices`
--
ALTER TABLE `item_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `item_invoice_lists`
--
ALTER TABLE `item_invoice_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `party_lesses`
--
ALTER TABLE `party_lesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `party_mobiles`
--
ALTER TABLE `party_mobiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_invoices`
--
ALTER TABLE `item_invoices`
  ADD CONSTRAINT `item_invoices_godown_id_foreign` FOREIGN KEY (`godown_id`) REFERENCES `godowns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_invoice_lists`
--
ALTER TABLE `item_invoice_lists`
  ADD CONSTRAINT `item_invoice_lists_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_invoice_lists_item_invoice_id_foreign` FOREIGN KEY (`item_invoice_id`) REFERENCES `item_invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parties`
--
ALTER TABLE `parties`
  ADD CONSTRAINT `parties_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `party_lesses`
--
ALTER TABLE `party_lesses`
  ADD CONSTRAINT `party_lesses_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `party_mobiles`
--
ALTER TABLE `party_mobiles`
  ADD CONSTRAINT `party_mobiles_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
