-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ezprint
DROP DATABASE IF EXISTS `ezprint`;
CREATE DATABASE IF NOT EXISTS `ezprint` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ezprint`;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2019 at 04:46 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezprint`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `credit_balance` float(10,2) NOT NULL DEFAULT 0.00,
  `credit_total` float(10,2) NOT NULL DEFAULT 0.00,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `credit_balance`, `credit_total`, `address`) VALUES
(1, 3, 100271.30, 100270.00, NULL),
(2, 13, 21.50, 36.00, ''),
(3, 4, 70.90, 77.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `add_on`
--

CREATE TABLE `add_on` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float(10,2) NOT NULL DEFAULT 0.00,
  `is_active` smallint(1) NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_on`
--

INSERT INTO `add_on` (`id`, `name`, `description`, `price`, `is_active`, `updated_at`) VALUES
(1, 'Binding', 'bla val', 2.00, 1, '2019-10-05 13:48:54'),
(2, 'clear at front', NULL, 0.50, 1, '2019-10-05 13:49:36'),
(3, 'clear at back', NULL, 0.20, 1, '2019-10-05 13:49:58'),
(4, 'delivery service', NULL, 2.00, 1, '2019-10-05 13:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `credit_transaction`
--

CREATE TABLE `credit_transaction` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL DEFAULT 0,
  `staff_id` int(11) UNSIGNED NOT NULL,
  `type` int(11) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `current_balance` double NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_transaction`
--

INSERT INTO `credit_transaction` (`id`, `account_id`, `job_id`, `staff_id`, `type`, `amount`, `current_balance`, `created_at`) VALUES
(3, 1, 9, 1, 2, 3.2, 6.8, '2019-10-17 15:22:10'),
(4, 1, 9, 1, 3, 3.2, 10, '2019-10-17 16:47:39'),
(5, 1, 9, 1, 3, 3.2, 10, '2019-10-17 16:55:07'),
(6, 1, 9, 1, 3, 3.2, 10, '2019-10-17 16:57:08'),
(7, 1, 9, 1, 3, 3.2, 10, '2019-10-17 16:59:03'),
(8, 1, 9, 1, 3, 3.2, 13.2, '2019-10-17 17:07:10'),
(9, 1, 9, 1, 3, 3.2, 16.4, '2019-10-17 17:07:33'),
(10, 2, 0, 1, 1, 2, 4, '2019-10-18 02:44:22'),
(11, 2, 0, 1, 1, 2, 6, '2019-10-18 02:44:27'),
(12, 2, 0, 1, 1, 30, 36, '2019-10-18 02:44:31'),
(13, 2, 11, 1, 2, 14.5, 21.5, '2019-10-18 02:47:33'),
(14, 2, 12, 1, 2, 14.5, 7, '2019-10-18 02:48:21'),
(15, 2, 12, 1, 3, 14.5, 21.5, '2019-10-18 02:49:25'),
(16, 3, 0, 1, 1, 2, 2, '2019-10-18 02:54:06'),
(17, 3, 0, 1, 1, 2, 4, '2019-10-18 02:54:10'),
(18, 3, 0, 1, 1, 3, 7, '2019-10-18 02:54:14'),
(19, 3, 0, 1, 1, 40, 47, '2019-10-18 02:54:17'),
(20, 3, 0, 1, 1, 30, 77, '2019-10-18 02:54:21'),
(21, 3, 13, 1, 2, 2.9, 74.1, '2019-10-18 02:55:58'),
(22, 3, 14, 1, 2, 3.2, 70.9, '2019-10-18 02:56:27'),
(23, 1, 15, 1, 2, 5.1, 11.3, '2019-10-19 14:29:05'),
(24, 1, 0, 1, 1, -100, -88.7, '2019-10-19 14:30:48'),
(25, 1, 0, 1, 1, -100, -188.7, '2019-10-19 14:30:56'),
(26, 1, 0, 1, 1, -10, -198.7, '2019-10-19 14:31:00'),
(27, 1, 0, 1, 1, -10, -208.7, '2019-10-19 14:32:42'),
(28, 1, 0, 1, 1, -10, -218.7, '2019-10-19 14:34:26'),
(29, 1, 0, 1, 1, -10, -228.7, '2019-10-19 14:34:29'),
(30, 1, 0, 1, 1, 100000, 99771.3, '2019-10-19 14:35:23'),
(31, 1, 0, 1, 1, 100, 99871.3, '2019-10-19 14:35:27'),
(32, 1, 0, 1, 1, 100, 99971.3, '2019-10-19 14:35:32'),
(33, 1, 0, 1, 1, 100, 100071.3, '2019-10-19 14:35:35'),
(34, 1, 0, 1, 1, 100, 100171.3, '2019-10-19 14:35:38'),
(35, 1, 0, 1, 1, 100, 100271.3, '2019-10-19 14:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `total_page` int(11) NOT NULL DEFAULT 0,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `total_price` double(10,2) NOT NULL DEFAULT 0.00,
  `pickup_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `customer_id`, `staff_id`, `file`, `notes`, `status`, `total_price`, `pickup_date`, `created_at`, `completed_at`) VALUES
(9, 3, 1, '../../asset/uploads/(HANNAN YUSOP)B031910175.pdf', NULL, 3, 3.20, '2019-10-17 15:22:10', '2019-10-17 15:22:10', NULL),
(10, 3, 1, '../../asset/uploads/(HANNAN YUSOP)B031910175.pdf', NULL, 4, 3.20, '2019-10-17 15:22:10', '2019-09-17 15:22:10', NULL),
(11, 13, 1, '../../asset/uploads/UNDERSTANDING AND CONCEPTUALIZING INTERACTION DESIGN.pdf', NULL, 3, 14.50, '2019-10-18 02:47:33', '2019-10-18 02:47:33', NULL),
(12, 13, 1, '../../asset/uploads/UNDERSTANDING AND CONCEPTUALIZING INTERACTION DESIGN.pdf', NULL, 4, 14.50, '2019-10-18 02:48:21', '2019-08-18 02:48:21', NULL),
(13, 4, 1, '../../asset/uploads/HANNAN & AISHAH LAB 4.pdf', NULL, 3, 2.90, '2019-10-18 02:55:58', '2019-10-18 02:55:58', NULL),
(14, 4, 1, '../../asset/uploads/HANNAN_AISHAH.pdf', NULL, 3, 3.20, '2019-10-18 02:56:27', '2019-10-18 02:56:27', NULL),
(15, 3, 1, '../../asset/uploads/HANNAN & AISHAH LAB 4.pdf', NULL, 3, 5.10, '2019-10-19 14:29:05', '2019-10-19 14:29:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_has_add_on`
--

CREATE TABLE `jobs_has_add_on` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `add_on_id` int(11) NOT NULL,
  `price` double(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_has_add_on`
--

INSERT INTO `jobs_has_add_on` (`id`, `job_id`, `add_on_id`, `price`) VALUES
(13, 9, 2, 0.50),
(14, 9, 4, 2.00),
(15, 11, 1, 2.00),
(16, 11, 2, 0.50),
(17, 11, 3, 0.20),
(18, 11, 4, 2.00),
(19, 12, 1, 2.00),
(20, 12, 2, 0.50),
(21, 12, 3, 0.20),
(22, 12, 4, 2.00),
(23, 13, 1, 2.00),
(24, 13, 2, 0.50),
(25, 14, 1, 2.00),
(26, 14, 2, 0.50),
(27, 14, 3, 0.20),
(28, 15, 1, 2.00),
(29, 15, 2, 0.50),
(30, 15, 3, 0.20),
(31, 15, 4, 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(3, 'customer'),
(1, 'manager'),
(2, 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_ip_address` varchar(50) DEFAULT NULL,
  `is_active` smallint(1) NOT NULL DEFAULT 0,
  `is_confirm` smallint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `password`, `fullname`, `last_login_at`, `last_ip_address`, `is_active`, `is_confirm`, `created_at`) VALUES
(1, 1, '1', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'MANAGER ACCOUNT', '2019-10-19 14:29:36', '192.168.64.1', 1, 1, '2019-10-05 16:10:00'),
(2, 2, 'staff@ezprint.com', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'STAFF ACCOUNT', '2019-10-05 16:10:37', NULL, 1, 1, '2019-10-05 16:10:44'),
(3, 3, 'cs', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'CUSTOMER ACCOUNT', '2019-10-19 14:36:41', '192.168.64.1', 1, 1, '2019-10-05 16:11:50'),
(4, 3, 'test', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'CUSTOMER TEST', '2019-10-18 02:55:17', '192.168.64.1', 1, 1, '2019-10-18 01:42:17'),
(13, 3, 're', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'JUDIKA MARAN', '2019-10-18 02:45:08', '192.168.64.1', 1, 1, '2019-10-18 02:00:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_accounts_users` (`user_id`);

--
-- Indexes for table `add_on`
--
ALTER TABLE `add_on`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `credit_transaction`
--
ALTER TABLE `credit_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_credit_transaction_users` (`staff_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_files_jobs` (`job_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_has_add_on`
--
ALTER TABLE `jobs_has_add_on`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_jobs_has_add_on_jobs` (`job_id`),
  ADD KEY `FK_jobs_has_add_on_add_on` (`add_on_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_users_roles` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `add_on`
--
ALTER TABLE `add_on`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `credit_transaction`
--
ALTER TABLE `credit_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs_has_add_on`
--
ALTER TABLE `jobs_has_add_on`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `FK_accounts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `credit_transaction`
--
ALTER TABLE `credit_transaction`
  ADD CONSTRAINT `FK_credit_transaction_users` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `FK_files_jobs` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`);

--
-- Constraints for table `jobs_has_add_on`
--
ALTER TABLE `jobs_has_add_on`
  ADD CONSTRAINT `FK_jobs_has_add_on_add_on` FOREIGN KEY (`add_on_id`) REFERENCES `add_on` (`id`),
  ADD CONSTRAINT `FK_jobs_has_add_on_jobs` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
