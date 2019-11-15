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

-- Dumping structure for table ezprint.accounts
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `credit_balance` float(10,2) NOT NULL DEFAULT '0.00',
  `credit_total` float(10,2) NOT NULL DEFAULT '0.00',
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_accounts_users` (`user_id`),
  CONSTRAINT `FK_accounts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.accounts: ~6 rows (approximately)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `user_id`, `credit_balance`, `credit_total`, `address`) VALUES
	(1, 3, 100240.50, 100270.00, NULL),
	(2, 13, 21.50, 36.00, ''),
	(3, 4, 70.90, 77.00, ''),
	(4, 14, 0.00, 0.00, ''),
	(5, 15, 0.00, 0.00, ''),
	(6, 16, 0.00, 0.00, '');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Dumping structure for table ezprint.add_on
DROP TABLE IF EXISTS `add_on`;
CREATE TABLE IF NOT EXISTS `add_on` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `is_active` smallint(1) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.add_on: ~4 rows (approximately)
/*!40000 ALTER TABLE `add_on` DISABLE KEYS */;
INSERT INTO `add_on` (`id`, `name`, `description`, `price`, `is_active`, `updated_at`) VALUES
	(1, 'BINDING', 'bla val', 2.00, 1, '2019-10-05 13:48:54'),
	(2, 'CLEAR AT FRONT', 'test', 0.50, 1, '2019-10-05 13:49:36'),
	(3, 'CLEAR AT BACK', 'testing', 0.20, 1, '2019-10-05 13:49:58'),
	(4, 'DELIVERY SERVICE', 'test', 2.00, 1, '2019-10-05 13:50:26'),
	(5, 'TSET', 'rer', 1.00, 1, NULL);
/*!40000 ALTER TABLE `add_on` ENABLE KEYS */;

-- Dumping structure for table ezprint.credit_transaction
DROP TABLE IF EXISTS `credit_transaction`;
CREATE TABLE IF NOT EXISTS `credit_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL DEFAULT '0',
  `staff_id` int(11) unsigned NOT NULL,
  `type` int(11) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `current_balance` double NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_credit_transaction_users` (`staff_id`),
  CONSTRAINT `FK_credit_transaction_users` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.credit_transaction: ~35 rows (approximately)
/*!40000 ALTER TABLE `credit_transaction` DISABLE KEYS */;
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
	(35, 1, 0, 1, 1, 100, 100271.3, '2019-10-19 14:35:43'),
	(36, 1, 16, 1, 2, 5.1, 100266.2, '2019-11-15 18:09:26'),
	(37, 1, 17, 1, 2, 25.7, 100240.5, '2019-11-15 18:10:16');
/*!40000 ALTER TABLE `credit_transaction` ENABLE KEYS */;

-- Dumping structure for table ezprint.files
DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `total_page` int(11) NOT NULL DEFAULT '0',
  `notes` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_files_jobs` (`job_id`),
  CONSTRAINT `FK_files_jobs` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.files: ~0 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table ezprint.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `notes` longtext,
  `status` int(11) NOT NULL DEFAULT '1',
  `total_price` double(10,2) NOT NULL DEFAULT '0.00',
  `pickup_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.jobs: ~9 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` (`id`, `customer_id`, `staff_id`, `file`, `notes`, `status`, `total_price`, `pickup_date`, `created_at`, `completed_at`) VALUES
	(9, 3, 1, '../../asset/uploads/(HANNAN YUSOP)B031910175.pdf', NULL, 3, 3.20, '2019-10-17 23:22:10', '2019-10-17 23:22:10', NULL),
	(10, 3, 1, '../../asset/uploads/(HANNAN YUSOP)B031910175.pdf', NULL, 4, 3.20, '2019-10-17 23:22:10', '2019-09-17 23:22:10', NULL),
	(11, 13, 1, '../../asset/uploads/UNDERSTANDING AND CONCEPTUALIZING INTERACTION DESIGN.pdf', NULL, 1, 14.50, '2019-10-18 10:47:33', '2019-10-18 10:47:33', NULL),
	(12, 13, 1, '../../asset/uploads/UNDERSTANDING AND CONCEPTUALIZING INTERACTION DESIGN.pdf', NULL, 4, 14.50, '2019-10-18 10:48:21', '2019-08-18 10:48:21', NULL),
	(13, 4, 1, '../../asset/uploads/HANNAN & AISHAH LAB 4.pdf', NULL, 1, 2.90, '2019-10-18 10:55:58', '2019-10-18 10:55:58', NULL),
	(14, 4, 1, '../../asset/uploads/HANNAN_AISHAH.pdf', NULL, 2, 3.20, '2019-10-18 10:56:27', '2019-10-18 10:56:27', NULL),
	(15, 3, 1, '../../asset/uploads/HANNAN & AISHAH LAB 4.pdf', NULL, 2, 5.10, '2019-10-19 22:29:05', '2019-10-19 22:29:05', NULL),
	(16, 3, 0, '../../asset/uploads/144946.pdf', NULL, 1, 5.10, '2019-11-15 18:09:26', '2019-11-15 18:09:26', NULL),
	(17, 3, 0, '../../asset/uploads/BY GROUP.pdf', NULL, 1, 25.70, '2019-11-15 18:10:16', '2019-11-15 18:10:16', NULL);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table ezprint.jobs_has_add_on
DROP TABLE IF EXISTS `jobs_has_add_on`;
CREATE TABLE IF NOT EXISTS `jobs_has_add_on` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `add_on_id` int(11) NOT NULL,
  `price` double(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `FK_jobs_has_add_on_jobs` (`job_id`),
  KEY `FK_jobs_has_add_on_add_on` (`add_on_id`),
  CONSTRAINT `FK_jobs_has_add_on_add_on` FOREIGN KEY (`add_on_id`) REFERENCES `add_on` (`id`),
  CONSTRAINT `FK_jobs_has_add_on_jobs` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.jobs_has_add_on: ~27 rows (approximately)
/*!40000 ALTER TABLE `jobs_has_add_on` DISABLE KEYS */;
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
	(31, 15, 4, 2.00),
	(32, 16, 1, 2.00),
	(33, 16, 2, 0.50),
	(34, 16, 3, 0.20),
	(35, 16, 4, 2.00),
	(36, 17, 1, 2.00),
	(37, 17, 2, 0.50),
	(38, 17, 3, 0.20),
	(39, 17, 4, 2.00);
/*!40000 ALTER TABLE `jobs_has_add_on` ENABLE KEYS */;

-- Dumping structure for table ezprint.options
DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.options: ~2 rows (approximately)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` (`id`, `name`, `value`, `updated_at`) VALUES
	(1, 'price_black_and_white', '0.30', '2019-11-15 21:19:28'),
	(2, 'price_colour', '0.50', '2019-11-15 21:34:21');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;

-- Dumping structure for table ezprint.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(3, 'customer'),
	(1, 'manager'),
	(2, 'staff');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table ezprint.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_ip_address` varchar(50) DEFAULT NULL,
  `is_active` smallint(1) NOT NULL DEFAULT '0',
  `is_confirm` smallint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_users_roles` (`role_id`),
  CONSTRAINT `FK_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.users: ~12 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `role_id`, `email`, `password`, `fullname`, `last_login_at`, `last_ip_address`, `is_active`, `is_confirm`, `created_at`) VALUES
	(1, 1, 'admin@ezprint.my', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'MANAGER ACCOUNT', '2019-11-15 20:47:14', '127.0.0.1', 1, 1, '2014-10-05 16:10:00'),
	(2, 2, 'staff@ezprint.com', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'STAFF ACCOUNT', '2019-10-05 16:10:37', NULL, 1, 1, '2019-10-05 16:10:44'),
	(3, 3, 'syarifah@gmail.com', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'SYARIFAH SYAHIRA BINTI OTHMAN', '2019-11-15 17:31:02', '127.0.0.1', 1, 1, '2019-10-05 16:11:50'),
	(4, 3, 'arman@hotmail.com', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'INSP. ARMAN BINTI MUDA', '2019-10-18 02:55:17', '192.168.64.1', 1, 1, '2019-10-18 01:42:17'),
	(13, 3, 'emelia_92@gmail.com', '$2y$12$sAdS7Z4PX.PW0JIG.oSTT.eCm12XjEd8CVKTcyQBY8NosPCtNCK1m', 'AMELIA NATASHA BINTI DR. BIJAY', '2019-10-18 02:45:08', '192.168.64.1', 1, 1, '2019-10-18 02:00:11'),
	(14, 3, 'rosmah@wechat.my', 'secret', 'ROSMAH BINTI MANSUR', NULL, NULL, 1, 1, '2019-11-15 15:34:30'),
	(15, 3, 'ismail_ked@gmail.com', 'secret', 'ISMAIL BIN HJ KEDRI', NULL, NULL, 1, 1, '2019-11-15 15:34:57'),
	(16, 3, 'azrul@gmail.com', 'secret', 'AZRUL LOY BIN MOHD. MUDA', NULL, NULL, 1, 1, '2019-11-15 16:04:52'),
	(19, 1, 'manager@test', 'secret', 'MANAGER TEST', NULL, NULL, 1, 1, '2019-11-15 19:52:31'),
	(20, 1, 'safwan@ezprint.my', 'secret', 'SAFWAN BIN YUSOP', NULL, NULL, 1, 1, '2019-11-15 19:53:06'),
	(21, 1, 'miasara@ezprint.my', '$2y$10$fyKwLqKfUjr1nxIC9jQz6ulfrSBmNVUbvdVYWgCpVOBTtzfhbGAS.', 'MIA SARA BT AHMAD', NULL, NULL, 1, 1, '2019-11-15 19:54:27'),
	(23, 2, 'zul@ezprint.my', 'secret', 'ZULKARNAIN B ALI HAMDAN', NULL, NULL, 1, 1, '2019-11-15 19:54:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
