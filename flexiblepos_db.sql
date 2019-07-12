-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2019 at 07:38 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flexiblepos`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(12,2) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `logo_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fevicon_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starting_balance` decimal(12,2) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_users`
--

CREATE TABLE `company_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-foto.png',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_balance` decimal(8,2) DEFAULT NULL,
  `payment` decimal(8,2) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_reports`
--

CREATE TABLE `daily_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `prev_balance` decimal(12,2) NOT NULL,
  `total_sales` decimal(12,2) NOT NULL,
  `total_payment` decimal(12,2) NOT NULL,
  `total_dues` decimal(12,2) NOT NULL,
  `sale_profit` decimal(12,2) NOT NULL,
  `total_income` decimal(12,2) NOT NULL,
  `total_expense` decimal(12,2) NOT NULL,
  `total_receivings` decimal(12,2) NOT NULL,
  `total_receivings_payment` decimal(12,2) NOT NULL,
  `total_receivings_dues` decimal(12,2) NOT NULL,
  `total_supplier_payment` decimal(12,2) NOT NULL,
  `total_costing` decimal(12,2) NOT NULL,
  `net_balance` decimal(12,2) NOT NULL,
  `total_profit` decimal(12,2) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` decimal(12,2) NOT NULL,
  `dues` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `expense_category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flexible_pos_settings`
--

CREATE TABLE `flexible_pos_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `logo_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fevicon_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_name` text COLLATE utf8mb4_unicode_ci,
  `company_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `starting_balance` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `in_out_qty` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `upc_ean_isbn` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_name` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-foto.png',
  `cost_price` decimal(9,2) NOT NULL,
  `selling_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `type` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_kit_items`
--

CREATE TABLE `item_kit_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_kit_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost_price` decimal(15,2) NOT NULL,
  `total_selling_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_kit_item_temps`
--

CREATE TABLE `item_kit_item_temps` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost_price` decimal(15,2) NOT NULL,
  `total_selling_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(59, '2014_10_12_000000_create_users_table', 1),
(60, '2014_10_12_100000_create_password_resets_table', 1),
(61, '2015_05_29_074713_create_customers_table', 1),
(62, '2015_05_30_015027_create_items_table', 1),
(63, '2015_05_30_073533_create_suppliers_table', 1),
(64, '2015_06_02_010425_create_inventories_table', 1),
(65, '2015_06_03_013557_create_receivings_table', 1),
(66, '2015_06_03_134547_create_receiving_temps_table', 1),
(67, '2015_06_06_083156_create_sales_table', 1),
(68, '2015_06_06_083159_create_sale_temps_table', 1),
(69, '2015_06_07_042753_create_receiving_items_table', 1),
(70, '2015_06_08_050821_create_sale_items_table', 1),
(71, '2015_06_12_214916_create_item_kit_item_temps_table', 1),
(72, '2015_06_12_224226_create_item_kit_items_table', 1),
(73, '2015_06_16_163101_create_tutapos_settings_table', 1),
(74, '2017_05_22_165812_add_discount_tax_grandtotal_to_sales', 1),
(75, '2018_03_23_021440_create_sale_payments_table', 1),
(76, '2018_03_25_141132_create_flexible_pos_settings_table', 1),
(77, '2018_03_27_011844_create_customer_payments_table', 1),
(78, '2018_03_27_022156_create_expense_categories_table', 1),
(79, '2018_03_27_022640_create_expenses_table', 1),
(80, '2018_04_03_213954_create_daily_reports_table', 1),
(81, '2018_04_07_213837_create_receiving_payments_table', 1),
(82, '2018_04_07_214803_create_supplier_payments_table', 1),
(83, '2018_04_21_212541_create_accounts_table', 1),
(84, '2018_05_01_111157_create_transactions_table', 1),
(85, '2019_02_07_160619_create_companies_table', 1),
(86, '2019_02_07_170531_create_company_users_table', 1),
(87, '2019_02_08_131317_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `label`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'List Items', 'items.index', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(2, 'Create Items', 'items.create', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(3, 'Store Items', 'items.store', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(4, 'View Items', 'items.show', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(5, 'Delete Items', 'items.destroy', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(6, 'Update Items', 'items.update', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(7, 'Edit Items', 'items.edit', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(8, 'List Inventory', 'inventory.index', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(9, 'Create Inventory', 'inventory.create', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(10, 'Store Inventory', 'inventory.store', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(11, 'View Inventory', 'inventory.show', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(12, 'Delete Inventory', 'inventory.destroy', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(13, 'Update Inventory', 'inventory.update', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(14, 'Edit Inventory', 'inventory.edit', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(15, 'List Customers', 'customers.index', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(16, 'Create Customers', 'customers.create', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(17, 'Store Customers', 'customers.store', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(18, 'View Customers', 'customers.show', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(19, 'Delete Customers', 'customers.destroy', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(20, 'Update Customers', 'customers.update', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(21, 'Edit Customers', 'customers.edit', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(22, 'List Suppliers', 'suppliers.index', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(23, 'Create Suppliers', 'suppliers.create', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(24, 'Store Suppliers', 'suppliers.store', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(25, 'View Suppliers', 'suppliers.show', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(26, 'Delete Suppliers', 'suppliers.destroy', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(27, 'Update Suppliers', 'suppliers.update', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(28, 'Edit Suppliers', 'suppliers.edit', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(29, 'List Receivings', 'receivings.index', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(30, 'Create Receivings', 'receivings.create', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(31, 'Store Receivings', 'receivings.store', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(32, 'View Receivings', 'receivings.show', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(33, 'Delete Receivings', 'receivings.destroy', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(34, 'Update Receivings', 'receivings.update', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(35, 'Edit Receivings', 'receivings.edit', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(36, 'List Transactions', 'transactions.index', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(37, 'Create Transactions', 'transactions.create', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(38, 'Store Transactions', 'transactions.store', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(39, 'View Transactions', 'transactions.show', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(40, 'Delete Transactions', 'transactions.destroy', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(41, 'Update Transactions', 'transactions.update', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(42, 'Edit Transactions', 'transactions.edit', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(43, 'List Supplierpayments', 'supplierpayments.index', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(44, 'Create Supplierpayments', 'supplierpayments.create', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(45, 'Store Supplierpayments', 'supplierpayments.store', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(46, 'View Supplierpayments', 'supplierpayments.show', 'web', '2019-04-28 17:38:12', '2019-04-28 17:38:12'),
(47, 'Delete Supplierpayments', 'supplierpayments.destroy', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(48, 'Update Supplierpayments', 'supplierpayments.update', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(49, 'Edit Supplierpayments', 'supplierpayments.edit', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(50, 'List Sales', 'sales.index', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(51, 'Create Sales', 'sales.create', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(52, 'Store Sales', 'sales.store', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(53, 'View Sales', 'sales.show', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(54, 'Delete Sales', 'sales.destroy', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(55, 'Update Sales', 'sales.update', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(56, 'Edit Sales', 'sales.edit', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(57, 'List Salepayments', 'salepayments.index', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(58, 'Create Salepayments', 'salepayments.create', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(59, 'Store Salepayments', 'salepayments.store', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(60, 'View Salepayments', 'salepayments.show', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(61, 'Delete Salepayments', 'salepayments.destroy', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(62, 'Update Salepayments', 'salepayments.update', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(63, 'Edit Salepayments', 'salepayments.edit', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(64, 'List Dailyreport', 'dailyreport.index', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(65, 'Create Dailyreport', 'dailyreport.create', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(66, 'Store Dailyreport', 'dailyreport.store', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(67, 'View Dailyreport', 'dailyreport.show', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(68, 'Delete Dailyreport', 'dailyreport.destroy', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(69, 'Update Dailyreport', 'dailyreport.update', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(70, 'Edit Dailyreport', 'dailyreport.edit', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(71, 'List Receivingpayments', 'receivingpayments.index', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(72, 'Create Receivingpayments', 'receivingpayments.create', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(73, 'Store Receivingpayments', 'receivingpayments.store', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(74, 'View Receivingpayments', 'receivingpayments.show', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(75, 'Delete Receivingpayments', 'receivingpayments.destroy', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(76, 'Update Receivingpayments', 'receivingpayments.update', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(77, 'Edit Receivingpayments', 'receivingpayments.edit', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(78, 'List Expense', 'expense.index', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(79, 'Create Expense', 'expense.create', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(80, 'Store Expense', 'expense.store', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(81, 'View Expense', 'expense.show', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(82, 'Delete Expense', 'expense.destroy', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(83, 'Update Expense', 'expense.update', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(84, 'Edit Expense', 'expense.edit', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(85, 'List Expensecategory', 'expensecategory.index', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(86, 'Create Expensecategory', 'expensecategory.create', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(87, 'Store Expensecategory', 'expensecategory.store', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(88, 'View Expensecategory', 'expensecategory.show', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(89, 'Delete Expensecategory', 'expensecategory.destroy', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(90, 'Update Expensecategory', 'expensecategory.update', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(91, 'Edit Expensecategory', 'expensecategory.edit', 'web', '2019-04-28 17:38:13', '2019-04-28 17:38:13'),
(92, 'List Customerpayments', 'customerpayments.index', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(93, 'Create Customerpayments', 'customerpayments.create', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(94, 'Store Customerpayments', 'customerpayments.store', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(95, 'View Customerpayments', 'customerpayments.show', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(96, 'Delete Customerpayments', 'customerpayments.destroy', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(97, 'Update Customerpayments', 'customerpayments.update', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(98, 'Edit Customerpayments', 'customerpayments.edit', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(99, 'List Accounts', 'accounts.index', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(100, 'Create Accounts', 'accounts.create', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(101, 'Store Accounts', 'accounts.store', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(102, 'View Accounts', 'accounts.show', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(103, 'Delete Accounts', 'accounts.destroy', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(104, 'Update Accounts', 'accounts.update', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(105, 'Edit Accounts', 'accounts.edit', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(106, 'List Employees', 'employees.index', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(107, 'Create Employees', 'employees.create', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(108, 'Store Employees', 'employees.store', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(109, 'View Employees', 'employees.show', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(110, 'Delete Employees', 'employees.destroy', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(111, 'Update Employees', 'employees.update', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(112, 'Edit Employees', 'employees.edit', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(113, 'List Settings', 'flexiblepossetting.index', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(114, 'Create Settings', 'flexiblepossetting.create', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(115, 'Store Settings', 'flexiblepossetting.store', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(116, 'View Settings', 'flexiblepossetting.show', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(117, 'Delete Settings', 'flexiblepossetting.destroy', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(118, 'Update Settings', 'flexiblepossetting.update', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(119, 'Edit Settings', 'flexiblepossetting.edit', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(120, 'List Permissions', 'permissions.list', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(121, 'Assaign Roles', 'assaign.roles', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(122, 'Create Roles', 'employeerole.create', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(123, 'Create Permission Role', 'permissionrole.create', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(124, 'Create Permissions', 'permissions.create', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(125, 'Getsales Reports', 'reports.getsales', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(126, 'CreateDaily Reports', 'reports.createdaily', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(127, 'CreatePast Reports', 'reports.createpast', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(128, 'GetDaily Reports', 'reports.getdaily', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(129, 'CreateCustom Items', 'items.customcreate', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(130, 'PrintSales Reports', 'reports.printsales', 'web', '2019-04-28 17:38:14', '2019-04-28 17:38:14'),
(131, 'GetAllSale Reports', 'reports.getsalereport', 'web', '2019-04-28 17:38:15', '2019-04-28 17:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `receivings`
--

CREATE TABLE `receivings` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_type` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(12,2) NOT NULL,
  `payment` decimal(12,2) NOT NULL,
  `dues` decimal(12,2) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receiving_items`
--

CREATE TABLE `receiving_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `receiving_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `cost_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receiving_payments`
--

CREATE TABLE `receiving_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dues` decimal(12,2) NOT NULL,
  `receiving_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receiving_temps`
--

CREATE TABLE `receiving_temps` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `cost_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2019-04-28 17:38:15', '2019-04-28 17:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_type` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount` decimal(9,2) NOT NULL,
  `tax` decimal(9,2) NOT NULL,
  `grand_total` decimal(9,2) NOT NULL,
  `payment` decimal(9,2) NOT NULL,
  `dues` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `total_selling` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_payments`
--

CREATE TABLE `sale_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dues` decimal(12,2) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_temps`
--

CREATE TABLE `sale_temps` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `cost_price` decimal(9,2) NOT NULL,
  `selling_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `total_selling` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-foto.png',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_balance` decimal(12,2) DEFAULT NULL,
  `payment` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

CREATE TABLE `supplier_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_type` tinyint(4) NOT NULL,
  `transaction_with` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutapos_settings`
--

CREATE TABLE `tutapos_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `languange` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tutapos_settings`
--

INSERT INTO `tutapos_settings` (`id`, `languange`, `created_at`, `updated_at`) VALUES
(1, 'en', '2019-04-28 17:38:11', '2019-04-28 17:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@flexibleit.net', '$2y$10$ySJG/bU4KzxmknVcgHqsEuw32cEGkd/.iobYis3wsONYC2cwadQBq', NULL, '2019-04-28 17:38:11', '2019-04-28 17:38:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_user_id_foreign` (`user_id`);

--
-- Indexes for table `company_users`
--
ALTER TABLE `company_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_payments_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `daily_reports`
--
ALTER TABLE `daily_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daily_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`),
  ADD KEY `expenses_expense_category_id_foreign` (`expense_category_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flexible_pos_settings`
--
ALTER TABLE `flexible_pos_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_item_id_foreign` (`item_id`),
  ADD KEY `inventories_user_id_foreign` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_kit_items`
--
ALTER TABLE `item_kit_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_kit_items_item_kit_id_foreign` (`item_kit_id`),
  ADD KEY `item_kit_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `item_kit_item_temps`
--
ALTER TABLE `item_kit_item_temps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_kit_item_temps_item_id_foreign` (`item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receivings`
--
ALTER TABLE `receivings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receivings_supplier_id_foreign` (`supplier_id`),
  ADD KEY `receivings_user_id_foreign` (`user_id`);

--
-- Indexes for table `receiving_items`
--
ALTER TABLE `receiving_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiving_items_receiving_id_foreign` (`receiving_id`),
  ADD KEY `receiving_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `receiving_payments`
--
ALTER TABLE `receiving_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiving_payments_receiving_id_foreign` (`receiving_id`),
  ADD KEY `receiving_payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `receiving_temps`
--
ALTER TABLE `receiving_temps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiving_temps_item_id_foreign` (`item_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `sale_payments`
--
ALTER TABLE `sale_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_payments_user_id_foreign` (`user_id`),
  ADD KEY `sale_payments_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `sale_temps`
--
ALTER TABLE `sale_temps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_temps_item_id_foreign` (`item_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_payments_supplier_id_foreign` (`supplier_id`),
  ADD KEY `supplier_payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_account_id_foreign` (`account_id`);

--
-- Indexes for table `tutapos_settings`
--
ALTER TABLE `tutapos_settings`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_reports`
--
ALTER TABLE `daily_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flexible_pos_settings`
--
ALTER TABLE `flexible_pos_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_kit_items`
--
ALTER TABLE `item_kit_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_kit_item_temps`
--
ALTER TABLE `item_kit_item_temps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `receivings`
--
ALTER TABLE `receivings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiving_items`
--
ALTER TABLE `receiving_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiving_payments`
--
ALTER TABLE `receiving_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiving_temps`
--
ALTER TABLE `receiving_temps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_payments`
--
ALTER TABLE `sale_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_temps`
--
ALTER TABLE `sale_temps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutapos_settings`
--
ALTER TABLE `tutapos_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD CONSTRAINT `customer_payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `customer_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `daily_reports`
--
ALTER TABLE `daily_reports`
  ADD CONSTRAINT `daily_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`),
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `item_kit_items`
--
ALTER TABLE `item_kit_items`
  ADD CONSTRAINT `item_kit_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_kit_items_item_kit_id_foreign` FOREIGN KEY (`item_kit_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `item_kit_item_temps`
--
ALTER TABLE `item_kit_item_temps`
  ADD CONSTRAINT `item_kit_item_temps_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receivings`
--
ALTER TABLE `receivings`
  ADD CONSTRAINT `receivings_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `receivings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `receiving_items`
--
ALTER TABLE `receiving_items`
  ADD CONSTRAINT `receiving_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `receiving_items_receiving_id_foreign` FOREIGN KEY (`receiving_id`) REFERENCES `receivings` (`id`);

--
-- Constraints for table `receiving_payments`
--
ALTER TABLE `receiving_payments`
  ADD CONSTRAINT `receiving_payments_receiving_id_foreign` FOREIGN KEY (`receiving_id`) REFERENCES `receivings` (`id`),
  ADD CONSTRAINT `receiving_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `receiving_temps`
--
ALTER TABLE `receiving_temps`
  ADD CONSTRAINT `receiving_temps_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `sale_payments`
--
ALTER TABLE `sale_payments`
  ADD CONSTRAINT `sale_payments_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`),
  ADD CONSTRAINT `sale_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sale_temps`
--
ALTER TABLE `sale_temps`
  ADD CONSTRAINT `sale_temps_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD CONSTRAINT `supplier_payments_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `supplier_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
