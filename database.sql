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
  `address` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_accounts_users` (`user_id`),
  CONSTRAINT `FK_accounts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.accounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `user_id`, `credit_balance`, `credit_total`, `address`) VALUES
	(1, 2, 10.00, 10.00, NULL);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Dumping structure for table ezprint.add_on
DROP TABLE IF EXISTS `add_on`;
CREATE TABLE IF NOT EXISTS `add_on` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `is_active` smallint(1) NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.add_on: ~4 rows (approximately)
/*!40000 ALTER TABLE `add_on` DISABLE KEYS */;
INSERT INTO `add_on` (`id`, `name`, `description`, `price`, `is_active`, `updated_at`) VALUES
	(1, 'Binding', 'bla val', 2.00, 1, '2019-10-05 13:48:54'),
	(2, 'clear at front', NULL, 0.50, 1, '2019-10-05 13:49:36'),
	(3, 'clear at back', NULL, 0.20, 1, '2019-10-05 13:49:58'),
	(4, 'delivery service', NULL, 2.00, 1, '2019-10-05 13:50:26');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.credit_transaction: ~0 rows (approximately)
/*!40000 ALTER TABLE `credit_transaction` DISABLE KEYS */;
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
  `notes` longtext,
  `status` int(11) NOT NULL DEFAULT '1',
  `total_price` double(10,2) NOT NULL DEFAULT '0.00',
  `xxx_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.jobs_has_add_on: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobs_has_add_on` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.options: ~0 rows (approximately)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;

-- Dumping structure for table ezprint.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.roles: ~2 rows (approximately)
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
  `password` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ezprint.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `role_id`, `email`, `password`, `fullname`, `last_login_at`, `last_ip_address`, `is_active`, `is_confirm`, `created_at`) VALUES
	(1, 1, 'manager@ezprint.com', 'secret', 'MANAGER ACCOUNT', '2019-10-05 16:09:49', '127.0.0.1', 1, 1, '2019-10-05 16:10:00'),
	(2, 2, 'staff@ezprint.com', 'secret', 'STAFF ACCOUNT', '2019-10-05 16:10:37', NULL, 1, 1, '2019-10-05 16:10:44'),
	(3, 3, 'cs', 'secret', 'CUSTOMER ACCOUNT', '2019-10-16 08:36:27', '127.0.0.1', 1, 1, '2019-10-05 16:11:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
