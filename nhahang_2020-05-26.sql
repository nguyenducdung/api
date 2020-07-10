# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.28)
# Database: nhahang
# Generation Time: 2020-05-26 04:23:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bill_foods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bill_foods`;

CREATE TABLE `bill_foods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `food_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `num_of_food` int(11) DEFAULT NULL COMMENT 'số lượng món đã gọi',
  `price_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'tổng tiền của món ăn',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `bill_foods` WRITE;
/*!40000 ALTER TABLE `bill_foods` DISABLE KEYS */;

INSERT INTO `bill_foods` (`id`, `food_id`, `bill_id`, `num_of_food`, `price_total`, `created_at`, `updated_at`)
VALUES
	(1,1,1,1,'300000',NULL,NULL),
	(2,2,1,1,'20000',NULL,NULL),
	(3,1,5,1,'30000',NULL,NULL),
	(4,2,5,1,'20000',NULL,NULL),
	(5,1,6,1,'30000',NULL,NULL),
	(6,2,6,1,'20000',NULL,NULL),
	(7,1,7,1,'30000',NULL,NULL),
	(8,2,7,1,'20000',NULL,NULL);

/*!40000 ALTER TABLE `bill_foods` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bills
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bills`;

CREATE TABLE `bills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `num_of_food` int(11) DEFAULT NULL COMMENT 'số lượng món đã gọi',
  `price_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'tổng tiền của món ăn',
  `price_discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;

INSERT INTO `bills` (`id`, `customer_id`, `voucher_id`, `table_id`, `status`, `num_of_food`, `price_total`, `price_discount`, `created_at`, `updated_at`)
VALUES
	(1,1,1,1,1,1,'320000','32000',NULL,NULL),
	(5,1,NULL,1,1,2,'30000','','2020-05-26 11:14:56','2020-05-26 11:14:56'),
	(6,1,NULL,1,1,2,'30000','','2020-05-26 11:19:50','2020-05-26 11:19:50'),
	(7,1,NULL,1,1,2,'30000','','2020-05-26 11:22:06','2020-05-26 11:22:06');

/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;

INSERT INTO `customers` (`id`, `code`, `name`, `password`, `avatar`, `birthday`, `gender`, `phone`, `created_at`, `updated_at`, `email`)
VALUES
	(1,NULL,'chao','$2y$10$HpvpTsAP2ceJ9JTicU7bt.6EuYcZWEcTLuk6hogSYfYjzAO4o5.nG','chao','2019-04-05',1,'123456',NULL,'2020-05-26 09:54:37','chao@abcd.com'),
	(2,NULL,'Long trắng',NULL,NULL,NULL,NULL,'1234567','2020-05-26 08:01:54','2020-05-26 08:02:06','');

/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table foods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `foods`;

CREATE TABLE `foods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'thời gian cbi món ăn',
  `info` text COLLATE utf8mb4_unicode_ci COMMENT 'thông tin chi tiết',
  `price` double DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL COMMENT 'mã loại',
  `status` int(11) DEFAULT NULL,
  `num_of_order` int(11) DEFAULT NULL COMMENT 'số lượt gọi',
  `like_of_level` int(11) DEFAULT NULL COMMENT 'mức độ yêu thích',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

LOCK TABLES `foods` WRITE;
/*!40000 ALTER TABLE `foods` DISABLE KEYS */;

INSERT INTO `foods` (`id`, `name`, `image`, `time`, `info`, `price`, `type_id`, `status`, `num_of_order`, `like_of_level`, `created_at`, `updated_at`)
VALUES
	(1,'cháo','imgs/1_431106429.jpg','30',NULL,300000,1,1,20,5,NULL,NULL),
	(2,'chao trắng',NULL,NULL,NULL,20000,1,NULL,NULL,NULL,NULL,NULL),
	(3,'miến',NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `foods` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(25,'2014_10_12_000000_create_users_table',1),
	(26,'2014_10_12_100000_create_password_resets_table',1),
	(27,'2020_05_15_211152_create_customers_table',1),
	(28,'2020_05_15_215106_create_tables_table',1),
	(29,'2020_05_15_215226_create_foods_table',1),
	(30,'2020_05_15_215839_create_types_table',1),
	(31,'2020_05_15_215921_create_roles_table',1),
	(32,'2020_05_15_220010_create_user_tokens_table',1),
	(36,'2020_05_26_080619_create_vouchers_table',2),
	(37,'2020_05_26_080723_create_bill_foods_table',2),
	(38,'2020_05_26_080802_create_bills_table',2),
	(39,'2020_05_26_100542_create_price_discount_column_table_bills',3);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;



# Dump of table tables
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tables`;

CREATE TABLE `tables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `customer_limit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;

INSERT INTO `tables` (`id`, `code`, `name`, `status`, `customer_limit`, `created_at`, `updated_at`)
VALUES
	(1,NULL,'1',1,2,NULL,NULL);

/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'Món canh','2020-05-16 01:15:44','2020-05-16 01:18:09'),
	(2,'Món xào','2020-05-16 01:17:15','2020-05-16 01:17:15'),
	(3,'Món luộc','2020-05-16 01:17:26','2020-05-16 01:17:26'),
	(4,'Đồ nhắm rượu','2020-05-16 01:17:43','2020-05-16 01:17:43');

/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_tokens`;

CREATE TABLE `user_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

LOCK TABLES `user_tokens` WRITE;
/*!40000 ALTER TABLE `user_tokens` DISABLE KEYS */;

INSERT INTO `user_tokens` (`id`, `user_id`, `token`, `created_at`, `updated_at`)
VALUES
	(1,1,'e10adc3949ba59abbe56e057f20f883e','2020-05-16 11:36:59','2020-05-26 07:44:59'),
	(2,2,'fcea920f7412b5da7be0cf42b8c93759','2020-05-26 08:01:54','2020-05-26 08:01:54');

/*!40000 ALTER TABLE `user_tokens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `birthday` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `code`, `name`, `avatar`, `email`, `email_verified_at`, `password`, `phone`, `gender`, `role_id`, `birthday`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'f2ac9','admin','imgs/1_431106429.jpg','admin@gmail.com',NULL,'$2y$10$HpvpTsAP2ceJ9JTicU7bt.6EuYcZWEcTLuk6hogSYfYjzAO4o5.nG','789741951',1,1,'2020-04-27','Pu5OagReaNjx4erHOteJQvdBLDrjxQfTNOHhFop6jKrmCVNVaRweBN7p5efi','2020-05-15 22:46:09','2020-05-16 01:09:04'),
	(2,'9481b','Mai','imgs/1_929085270.jpg','mai@gmail.com',NULL,'$2y$10$i1lY1RPQ7SW9VmHmnsJBzeZrppsAAqUls3Fz63M0FFz/IoihN37MG','789456132',0,0,'2020-04-30',NULL,'2020-05-16 01:07:08','2020-05-16 01:07:08');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vouchers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vouchers`;

CREATE TABLE `vouchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'mã người nhận',
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `vouchers` WRITE;
/*!40000 ALTER TABLE `vouchers` DISABLE KEYS */;

INSERT INTO `vouchers` (`id`, `user_id`, `code`, `discount_percent`, `expiration_date`, `status`, `note`, `created_at`, `updated_at`)
VALUES
	(1,1,'alk33','10','2020-12-12',0,'Giảm giá 10% tổng hóa đơn',NULL,NULL);

/*!40000 ALTER TABLE `vouchers` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
