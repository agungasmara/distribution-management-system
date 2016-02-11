-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 11, 2016 at 08:21 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Distribution_Man_System`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) unsigned NOT NULL,
  `brand_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL,
  `cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `remarks`, `created_at`, `updated_at`) VALUES
(2, 'sdfsdfd', ' sdfsd', '2016-01-31 09:12:48', '2016-01-31 09:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL,
  `cus_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_12_170911_routes_table', 1),
('2016_01_12_171722_reps_table', 1),
('2016_01_16_090823_create_customers', 1),
('2016_01_17_152153_products', 1),
('2016_01_17_153318_vehicles', 1),
('2016_01_30_180454_brands', 1),
('2016_01_30_180618_categories', 1),
('2016_01_30_180816_sub_products', 1),
('2016_02_07_153242_stocks', 2),
('2016_02_11_043504_stockmain', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `cat_id`, `brand_id`, `remarks`, `created_at`, `updated_at`) VALUES
(4, 'Manchee', 2, 0, 'LOL', '2016-02-04 01:54:47', '2016-02-04 01:54:47'),
(10, 'Maliban Gold Maree', 2, 0, 'asd', '2016-02-10 23:44:41', '2016-02-10 23:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `reps`
--

CREATE TABLE `reps` (
  `id` int(10) unsigned NOT NULL,
  `rep_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(10) unsigned NOT NULL,
  `route_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rep_id` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) unsigned NOT NULL,
  `stock_main_id` int(11) DEFAULT NULL,
  `sub_product_id` int(11) DEFAULT NULL,
  `initial` int(11) DEFAULT NULL,
  `available` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `stock_main_id`, `sub_product_id`, `initial`, `available`, `expiry_date`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 1233, '1233', '0000-00-00', ' dsa', 'ACTIVE', '2016-02-11 01:02:39', '2016-02-11 01:02:39'),
(2, 9, 10, 1222, '1222', '0000-00-00', ' ', 'ACTIVE', '2016-02-11 01:37:26', '2016-02-11 01:37:26'),
(3, 9, 10, 12221233, '12221233', '0000-00-00', ' ', 'ACTIVE', '2016-02-11 01:38:08', '2016-02-11 01:38:08'),
(5, 10, 10, 444423456, '444423456', '0000-00-00', ' ', 'ACTIVE', '2016-02-11 01:42:01', '2016-02-11 01:42:01'),
(6, 12, 10, 2312, '2312', '0000-00-00', ' ', 'ACTIVE', '2016-02-11 01:47:44', '2016-02-11 01:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `stock_main`
--

CREATE TABLE `stock_main` (
  `id` int(10) unsigned NOT NULL,
  `stock_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recieved_date` date DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_main`
--

INSERT INTO `stock_main` (`id`, `stock_code`, `recieved_date`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'ABC123', '0000-00-00', ' ', '2016-02-11 01:02:19', '2016-02-11 01:02:19'),
(2, 'ABC123', '0000-00-00', ' dvs', '2016-02-11 01:04:20', '2016-02-11 01:04:20'),
(3, 'fsdf', '0000-00-00', ' ', '2016-02-11 01:05:03', '2016-02-11 01:05:03'),
(4, 'dfs', '0000-00-00', ' ', '2016-02-11 01:06:04', '2016-02-11 01:06:04'),
(5, 'sdfsd', '0000-00-00', ' dsf', '2016-02-11 01:06:10', '2016-02-11 01:06:10'),
(6, 'sd', '0000-00-00', ' cvxv', '2016-02-11 01:08:48', '2016-02-11 01:08:48'),
(7, 'asdas', '0000-00-00', ' ', '2016-02-11 01:12:06', '2016-02-11 01:12:06'),
(8, 'svd', '0000-00-00', ' dsc', '2016-02-11 01:12:42', '2016-02-11 01:12:42'),
(9, 'sada', '0000-00-00', ' ', '2016-02-11 01:37:20', '2016-02-11 01:37:20'),
(10, 'cjhb', '0000-00-00', ' ', '2016-02-11 01:41:30', '2016-02-11 01:41:30'),
(11, 'hgjk', '0000-00-00', ' hjjh', '2016-02-11 01:46:37', '2016-02-11 01:46:37'),
(12, 'dsf', '0000-00-00', ' ', '2016-02-11 01:47:32', '2016-02-11 01:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `sub_products`
--

CREATE TABLE `sub_products` (
  `id` int(10) unsigned NOT NULL,
  `sub_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `price` double(20,10) DEFAULT NULL,
  `buying_price` double(10,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_products`
--

INSERT INTO `sub_products` (`id`, `sub_name`, `pro_id`, `remarks`, `created_at`, `updated_at`, `price`, `buying_price`) VALUES
(10, '250g packet', 10, 'das', '2016-02-10 23:45:11', '2016-02-10 23:45:11', 25.0000000000, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) unsigned NOT NULL,
  `vehicle_model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reps`
--
ALTER TABLE `reps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_main`
--
ALTER TABLE `stock_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_products`
--
ALTER TABLE `sub_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `reps`
--
ALTER TABLE `reps`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `stock_main`
--
ALTER TABLE `stock_main`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sub_products`
--
ALTER TABLE `sub_products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;