# ************************************************************
# Sequel Ace SQL dump
# Version 20016
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 8.0.27)
# Database: cpe_quotation
# Generation Time: 2021-12-19 09:08:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cpe_parent_service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cpe_parent_service`;

CREATE TABLE `cpe_parent_service` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

LOCK TABLES `cpe_parent_service` WRITE;
/*!40000 ALTER TABLE `cpe_parent_service` DISABLE KEYS */;

INSERT INTO `cpe_parent_service` (`id`, `name`, `created_at`)
VALUES
	(1,'Clipping Path','2021-12-14 08:12:18'),
	(2,'Multi-clipping Path','2021-12-14 08:12:30'),
	(3,'Image Musking','2021-12-14 08:12:39'),
	(4,'Shadow','2021-12-14 08:12:46');

/*!40000 ALTER TABLE `cpe_parent_service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cpe_request_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cpe_request_meta`;

CREATE TABLE `cpe_request_meta` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int unsigned NOT NULL,
  `service_complexity_price_id` int unsigned NOT NULL,
  `addon_crop` tinyint(1) DEFAULT '0',
  `addon_resize_w` varchar(10) DEFAULT NULL,
  `addon_resize_h` varchar(10) DEFAULT NULL,
  `additional_comment` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`),
  KEY `service_complexity_price_id` (`service_complexity_price_id`),
  CONSTRAINT `cpe_request_meta_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `cpe_request_receive` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `cpe_request_meta_ibfk_2` FOREIGN KEY (`service_complexity_price_id`) REFERENCES `cpe_service_complexity_price` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



# Dump of table cpe_request_receive
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cpe_request_receive`;

CREATE TABLE `cpe_request_receive` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `received_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sender_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sender_contact` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sender_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sender_ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `total_image` int NOT NULL,
  `image_location` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



# Dump of table cpe_service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cpe_service`;

CREATE TABLE `cpe_service` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `parent_service` int unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_service` (`parent_service`),
  CONSTRAINT `cpe_service_ibfk_1` FOREIGN KEY (`parent_service`) REFERENCES `cpe_parent_service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

LOCK TABLES `cpe_service` WRITE;
/*!40000 ALTER TABLE `cpe_service` DISABLE KEYS */;

INSERT INTO `cpe_service` (`id`, `name`, `parent_service`, `created_at`)
VALUES
	(1,'Cliping Path',1,'2021-12-13 23:25:26'),
	(2,'Multi-Ciping Path',2,'2021-12-14 07:50:20'),
	(3,'Image Musking',3,'2021-12-14 07:50:41'),
	(4,'Natural Shadow',4,'2021-12-14 08:14:32'),
	(5,'Reflaction Shadow',4,'2021-12-14 08:14:45'),
	(6,'Drop Shadow',4,'2021-12-14 08:15:59');

/*!40000 ALTER TABLE `cpe_service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cpe_service_all
# ------------------------------------------------------------

DROP VIEW IF EXISTS `cpe_service_all`;

CREATE TABLE `cpe_service_all` (
   `id` INT UNSIGNED NOT NULL DEFAULT '0',
   `service_complexity_id` INT UNSIGNED NOT NULL,
   `price` DOUBLE NOT NULL,
   `show_default` TINYINT(1) NULL DEFAULT '0',
   `complexity_name` VARCHAR(100) NOT NULL DEFAULT '',
   `complexity_pic` VARCHAR(500) NULL,
   `service_id` INT UNSIGNED NOT NULL DEFAULT '0',
   `service_name` VARCHAR(100) NULL,
   `service_parent` INT UNSIGNED NULL DEFAULT '0'
) ENGINE=MyISAM;



# Dump of table cpe_service_complexity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cpe_service_complexity`;

CREATE TABLE `cpe_service_complexity` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int unsigned NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pictures` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq` (`service_id`,`name`),
  CONSTRAINT `cpe_service_complexity_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `cpe_service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

LOCK TABLES `cpe_service_complexity` WRITE;
/*!40000 ALTER TABLE `cpe_service_complexity` DISABLE KEYS */;

INSERT INTO `cpe_service_complexity` (`id`, `service_id`, `name`, `created_at`, `pictures`)
VALUES
	(1,1,'1-1','2021-12-13 23:25:42',NULL),
	(2,1,'1-2','2021-12-13 23:25:48',NULL),
	(3,1,'1-3','2021-12-13 23:25:53',NULL),
	(4,1,'1-4','2021-12-13 23:25:59',NULL),
	(5,2,'2-1','2021-12-19 14:47:57',NULL),
	(6,2,'2-2','2021-12-19 14:48:06',NULL),
	(7,5,'5-2','2021-12-19 14:49:56',NULL),
	(8,2,'2-3','2021-12-19 14:48:19',NULL),
	(9,2,'2-4','2021-12-19 14:48:26',NULL),
	(10,3,'3-1','2021-12-19 14:48:36',NULL),
	(11,3,'3-2','2021-12-19 14:48:45',NULL),
	(12,4,'4-1','2021-12-19 14:49:31',NULL),
	(13,5,'5-3','2021-12-19 14:50:05',NULL),
	(14,5,'5-1','2021-12-19 14:49:42',NULL),
	(15,4,'4-4','2021-12-19 14:54:34',NULL);

/*!40000 ALTER TABLE `cpe_service_complexity` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cpe_service_complexity_price
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cpe_service_complexity_price`;

CREATE TABLE `cpe_service_complexity_price` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `service_complexity_id` int unsigned NOT NULL,
  `time` int NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `show_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`service_complexity_id`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

LOCK TABLES `cpe_service_complexity_price` WRITE;
/*!40000 ALTER TABLE `cpe_service_complexity_price` DISABLE KEYS */;

INSERT INTO `cpe_service_complexity_price` (`id`, `service_complexity_id`, `time`, `price`, `created_at`, `show_default`)
VALUES
	(1,7,6,1.5,NULL,0),
	(2,13,12,1.25,NULL,0),
	(3,14,24,1,NULL,0),
	(4,15,6,2,NULL,0),
	(5,12,12,1.7,NULL,0),
	(6,1,6,1,NULL,0),
	(7,5,12,0.5,NULL,0),
	(8,2,12,0.5,NULL,0),
	(9,6,24,0.2,NULL,0),
	(10,10,6,1,NULL,0),
	(11,11,12,0.5,NULL,0);

/*!40000 ALTER TABLE `cpe_service_complexity_price` ENABLE KEYS */;
UNLOCK TABLES;




# Replace placeholder table for cpe_service_all with correct view syntax
# ------------------------------------------------------------

DROP TABLE `cpe_service_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cpe_service_all`
AS SELECT
   `cpe_service_complexity_price`.`id` AS `id`,
   `cpe_service_complexity_price`.`service_complexity_id` AS `service_complexity_id`,
   `cpe_service_complexity_price`.`price` AS `price`,
   `cpe_service_complexity_price`.`show_default` AS `show_default`,
   `cpe_service_complexity`.`name` AS `complexity_name`,
   `cpe_service_complexity`.`pictures` AS `complexity_pic`,
   `cpe_service`.`id` AS `service_id`,
   `cpe_service`.`name` AS `service_name`,
   `cpe_service`.`parent_service` AS `service_parent`
FROM ((`cpe_service_complexity_price` join `cpe_service_complexity`) join `cpe_service`) where ((`cpe_service_complexity_price`.`service_complexity_id` = `cpe_service_complexity`.`id`) and (`cpe_service`.`id` = `cpe_service_complexity`.`service_id`));

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
