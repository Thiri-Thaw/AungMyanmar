-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2022 at 06:59 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pyit_tine_htaung`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `enroll_date` datetime NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable` smallint(6) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `reason`, `amount`, `account_type_id`, `enroll_date`, `remark`, `enable`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(1, 'prepaid salary for soe soe', 150000, 2, '2022-03-25 00:00:00', NULL, 1, NULL, NULL, '2022-03-25 07:31:30', '2022-03-26 03:21:22'),
(2, 'For Delivery', 20000, 3, '2022-03-25 00:00:00', NULL, 1, NULL, NULL, '2022-03-25 08:45:51', '2022-03-25 08:45:51'),
(3, 'For Event', 500000, 4, '2022-03-25 00:00:00', NULL, 0, NULL, NULL, '2022-03-25 21:59:46', '2022-03-26 03:28:06'),
(4, 'For Party', 800000, 1, '2022-03-25 00:00:00', 'aaaaaaaaaa', 1, NULL, NULL, '2022-03-26 02:36:21', '2022-03-26 03:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `accounttypes`
--

CREATE TABLE `accounttypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable` smallint(6) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounttypes`
--

INSERT INTO `accounttypes` (`id`, `name`, `status`, `remark`, `enable`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(1, 'general cost3', 'income', 'ddfdffg', 1, NULL, NULL, '2022-03-24 21:53:15', '2022-03-25 02:00:27'),
(2, 'salary', 'expend', 'for soe soe prepaid', 0, NULL, NULL, '2022-03-24 21:59:46', '2022-03-25 22:25:24'),
(3, 'general cost1', 'expend', NULL, 1, NULL, NULL, '2022-03-24 22:01:12', '2022-03-24 22:01:12'),
(4, 'general cost2', 'expend', NULL, 0, NULL, NULL, '2022-03-24 22:01:55', '2022-03-25 01:11:23'),
(5, 'general cost2', 'expend', 'general cost2', 1, NULL, NULL, '2022-03-25 06:57:03', '2022-03-25 06:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `remark`, `enable`, `created_at`, `updated_at`, `created_by`, `edited_by`) VALUES
(1, 'ပိုးသတ်ဆေးffff', 'ပိုးသတ်ဆေးပိုးသတ်ဆေး', 1, '2022-03-24 20:47:38', '2022-03-25 01:15:33', NULL, NULL),
(2, 'မှိုသတ်ဆေး', 'မှိုသတ်ဆေးမှိုသတ်ဆေးffdf', 1, '2022-03-24 20:49:06', '2022-03-25 01:15:41', NULL, NULL),
(3, '‌‌အပင်သန်ဆေး', '‌‌အပင်သန်ဆေး‌‌အပင်သန်ဆေး', 1, '2022-03-24 20:50:24', '2022-03-24 20:50:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `remark`, `enable`, `created_at`, `updated_at`, `created_by`, `edited_by`) VALUES
(1, 'shwe nagar', 'shwe nagarshwe', 1, '2022-03-24 20:51:52', '2022-03-24 20:52:18', NULL, NULL),
(2, 'awba', 'awba awba', 1, '2022-03-24 20:52:32', '2022-03-24 20:52:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable` smallint(6) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `phone`, `remark`, `enable`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(1, 'Default Customer', 'Shwebo', '09777777777', 'customer one', 1, NULL, NULL, '2022-03-26 08:27:35', '2022-03-26 08:27:35'),
(2, 'customer two', 'Shwebo', '09752742998', 'customer two', 1, NULL, NULL, '2022-03-26 08:28:30', '2022-03-26 08:28:30'),
(3, 'Customer One', 'Shwebo', '09888888', 'fdffffgfgfg', 1, NULL, NULL, '2022-03-27 20:38:48', '2022-03-27 20:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchse_price` double NOT NULL,
  `retail_price` double NOT NULL,
  `wholesale_price` double NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available` smallint(6) NOT NULL DEFAULT 1,
  `enable` smallint(6) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `company_id`, `category_id`, `name`, `code`, `purchse_price`, `retail_price`, `wholesale_price`, `unit`, `remark`, `description`, `available`, `enable`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'item1', 'hs00001', 15000, 5, 3, 'Buu', NULL, NULL, 1, 1, NULL, NULL, '2022-03-24 20:53:13', '2022-03-24 20:53:13'),
(2, 1, 2, 'item2', 'us00001', 30000, 0, 0, 'Buu', NULL, NULL, 1, 1, NULL, NULL, '2022-03-24 20:54:17', '2022-03-24 20:54:17'),
(3, 2, 3, 'item3', 'us00001', 35000, 0, 0, 'Buu', NULL, NULL, 1, 1, NULL, NULL, '2022-03-25 07:15:46', '2022-03-25 07:15:46'),
(4, 2, 2, 'item4', 'gd003', 20000, 0, 0, 'Buu', 'fdffdf', 'dfdffdf', 1, 1, NULL, NULL, '2022-03-26 08:45:42', '2022-03-26 08:45:42'),
(5, 1, 1, 'test', '123', 200, 0, 0, 'test', '0', '0', 1, 1, NULL, NULL, '2022-03-27 08:08:54', '2022-03-27 08:08:54');

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
(94, '2014_10_12_000000_create_users_table', 1),
(95, '2014_10_12_100000_create_password_resets_table', 1),
(96, '2019_08_19_000000_create_failed_jobs_table', 1),
(97, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(98, '2022_03_22_080027_create_categories_table', 1),
(99, '2022_03_23_042235_create_items_table', 1),
(100, '2022_03_23_071423_create_companies_table', 1),
(102, '2022_03_25_032705_create_accounttypes_table', 2),
(103, '2022_03_25_075348_create_accounts_table', 3),
(104, '2022_03_25_031923_create_customers_table', 4),
(109, '2022_03_27_130744_create_sales_table', 5),
(110, '2022_03_27_131825_create_sale__details_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sub_total` double NOT NULL,
  `tax` double NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `paid_amount` double NOT NULL,
  `left_amount` double NOT NULL,
  `enable` smallint(6) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `sub_total`, `tax`, `discount`, `paid_amount`, `left_amount`, `enable`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(1, 3, 12000, 0, 0, 2000, 10000, 1, NULL, NULL, '2022-03-27 23:01:01', '2022-03-27 23:01:01'),
(2, 1, 33000, 10, 10, 3000, 30000, 1, NULL, NULL, '2022-03-27 23:04:49', '2022-03-27 23:04:49'),
(3, 1, 5200, 0, 0, 3000, 2200, 0, NULL, NULL, '2022-03-28 01:51:21', '2022-03-28 18:46:08'),
(4, 1, 6000, 0, 0, 0, 6000, 0, NULL, NULL, '2022-03-28 06:43:07', '2022-03-28 18:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `sale__details`
--

CREATE TABLE `sale__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `quantity` double NOT NULL,
  `enable` smallint(6) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale__details`
--

INSERT INTO `sale__details` (`id`, `sale_id`, `item_id`, `sale_price`, `quantity`, `enable`, `created_by`, `edited_by`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2000, 5, 1, NULL, NULL, '2022-03-27 23:01:01', '2022-03-27 23:01:01'),
(2, 1, 4, 1000, 2, 1, NULL, NULL, '2022-03-27 23:01:01', '2022-03-27 23:01:01'),
(3, 2, 3, 5000, 3, 1, NULL, NULL, '2022-03-27 23:04:49', '2022-03-27 23:04:49'),
(4, 2, 5, 2000, 9, 1, NULL, NULL, '2022-03-27 23:04:49', '2022-03-27 23:04:49'),
(5, 3, 1, 100, 2, 0, NULL, NULL, '2022-03-28 01:51:22', '2022-03-28 18:46:07'),
(6, 3, 5, 5000, 1, 0, NULL, NULL, '2022-03-28 01:51:22', '2022-03-28 18:46:08'),
(7, 4, 2, 2000, 2, 0, NULL, NULL, '2022-03-28 06:43:07', '2022-03-28 18:06:59'),
(8, 4, 4, 2000, 1, 0, NULL, NULL, '2022-03-28 06:43:07', '2022-03-28 18:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'casher',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `enable` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `created_by`, `edited_by`, `enable`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, NULL, 1, '2022-03-24 20:34:20', '$2y$10$ZBZVjIVbsQ8H9Rmbdckgbekyi3bW4wfG5iY6dD6cSz36veaPy4yWu', 'Wks50S0x4yvkt7ZKDzJELcWd7L1J1WYx9HLoWFxlgRPxrY0hTY0BzCOEjY2h', '2022-03-24 20:34:20', '2022-03-25 03:09:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounttypes`
--
ALTER TABLE `accounttypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale__details`
--
ALTER TABLE `sale__details`
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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `accounttypes`
--
ALTER TABLE `accounttypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale__details`
--
ALTER TABLE `sale__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
