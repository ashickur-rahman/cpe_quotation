-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: cpe_quotation
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cpe_complexity_picture`
--

DROP TABLE IF EXISTS `cpe_complexity_picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpe_complexity_picture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `complexity_id` int unsigned DEFAULT NULL,
  `picture_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `show_in` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cpe_complexity_price_cpe_service_complexity_id_fk` (`complexity_id`),
  CONSTRAINT `cpe_complexity_price_cpe_service_complexity_id_fk` FOREIGN KEY (`complexity_id`) REFERENCES `cpe_service_complexity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpe_complexity_picture`
--

LOCK TABLES `cpe_complexity_picture` WRITE;
/*!40000 ALTER TABLE `cpe_complexity_picture` DISABLE KEYS */;
INSERT INTO `cpe_complexity_picture` VALUES (1,1,'sample_1','2021-12-22 10:08:38','b'),(2,1,'sample_3','2021-12-22 10:08:38','b'),(3,1,'sample_2','2021-12-22 10:09:53','v');
/*!40000 ALTER TABLE `cpe_complexity_picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpe_parent_service`
--

DROP TABLE IF EXISTS `cpe_parent_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpe_parent_service` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpe_parent_service`
--

LOCK TABLES `cpe_parent_service` WRITE;
/*!40000 ALTER TABLE `cpe_parent_service` DISABLE KEYS */;
INSERT INTO `cpe_parent_service` VALUES (1,'Clipping Path','2021-12-14 02:12:18'),(2,'Multi-clipping Path','2021-12-14 02:12:30'),(3,'Image Musking','2021-12-14 02:12:39'),(4,'Shadow','2021-12-14 02:12:46');
/*!40000 ALTER TABLE `cpe_parent_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpe_request_meta`
--

DROP TABLE IF EXISTS `cpe_request_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpe_request_meta`
--

LOCK TABLES `cpe_request_meta` WRITE;
/*!40000 ALTER TABLE `cpe_request_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `cpe_request_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpe_request_receive`
--

DROP TABLE IF EXISTS `cpe_request_receive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpe_request_receive`
--

LOCK TABLES `cpe_request_receive` WRITE;
/*!40000 ALTER TABLE `cpe_request_receive` DISABLE KEYS */;
/*!40000 ALTER TABLE `cpe_request_receive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpe_service`
--

DROP TABLE IF EXISTS `cpe_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpe_service` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `parent_service` int unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_service` (`parent_service`),
  CONSTRAINT `cpe_service_ibfk_1` FOREIGN KEY (`parent_service`) REFERENCES `cpe_parent_service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpe_service`
--

LOCK TABLES `cpe_service` WRITE;
/*!40000 ALTER TABLE `cpe_service` DISABLE KEYS */;
INSERT INTO `cpe_service` VALUES (1,'Clipping Path',1,'2021-12-13 17:25:26'),(2,'Multi-Ciping Path',2,'2021-12-14 01:50:20'),(3,'Image Musking',3,'2021-12-14 01:50:41'),(4,'Natural Shadow',4,'2021-12-14 02:14:32'),(5,'Reflaction Shadow',4,'2021-12-14 02:14:45'),(6,'Drop Shadow',4,'2021-12-14 02:15:59');
/*!40000 ALTER TABLE `cpe_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `cpe_service_all`
--

DROP TABLE IF EXISTS `cpe_service_all`;
/*!50001 DROP VIEW IF EXISTS `cpe_service_all`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `cpe_service_all` AS SELECT 
 1 AS `id`,
 1 AS `service_complexity_id`,
 1 AS `price`,
 1 AS `show_default`,
 1 AS `time_price`,
 1 AS `complexity_name`,
 1 AS `service_id`,
 1 AS `service_name`,
 1 AS `service_parent`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `cpe_service_complexity`
--

DROP TABLE IF EXISTS `cpe_service_complexity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpe_service_complexity` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int unsigned NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pictures` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq` (`service_id`,`name`),
  CONSTRAINT `cpe_service_complexity_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `cpe_service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpe_service_complexity`
--

LOCK TABLES `cpe_service_complexity` WRITE;
/*!40000 ALTER TABLE `cpe_service_complexity` DISABLE KEYS */;
INSERT INTO `cpe_service_complexity` VALUES (1,1,'1','2021-12-13 17:25:42',NULL),(2,1,'2','2021-12-13 17:25:48',NULL),(3,1,'3','2021-12-13 17:25:53',NULL),(4,1,'4','2021-12-13 17:25:59',NULL),(5,2,'1','2021-12-19 08:47:57',NULL),(6,2,'2','2021-12-19 08:48:06',NULL),(7,5,'2','2021-12-19 08:49:56',NULL),(8,2,'3','2021-12-19 08:48:19',NULL),(9,2,'4','2021-12-19 08:48:26',NULL),(10,3,'1','2021-12-19 08:48:36',NULL),(11,3,'2','2021-12-19 08:48:45',NULL),(12,4,'1','2021-12-19 08:49:31',NULL),(13,5,'3','2021-12-19 08:50:05',NULL),(14,5,'1','2021-12-19 08:49:42',NULL),(15,4,'4','2021-12-19 08:54:34',NULL);
/*!40000 ALTER TABLE `cpe_service_complexity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpe_service_complexity_price`
--

DROP TABLE IF EXISTS `cpe_service_complexity_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpe_service_complexity_price` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `service_complexity_id` int unsigned NOT NULL,
  `time_price` int NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `show_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`service_complexity_id`,`time_price`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpe_service_complexity_price`
--

LOCK TABLES `cpe_service_complexity_price` WRITE;
/*!40000 ALTER TABLE `cpe_service_complexity_price` DISABLE KEYS */;
INSERT INTO `cpe_service_complexity_price` VALUES (1,1,18,1,'2021-12-26 09:51:37',0),(2,1,36,0.8,'2021-12-26 09:52:25',1),(3,1,48,0.6,'2021-12-26 09:52:25',0),(4,1,72,0.5,'2021-12-26 09:52:43',0),(5,2,18,1.1,'2021-12-26 09:53:27',0),(6,2,36,1,'2021-12-26 09:53:27',1),(7,2,48,0.8,'2021-12-26 09:53:27',0),(8,2,72,0.6,'2021-12-26 09:53:27',0),(9,3,18,1.2,'2021-12-26 09:57:23',0),(10,3,36,1,'2021-12-26 09:57:23',1),(11,3,48,0.9,'2021-12-26 09:57:23',0),(12,3,72,0.8,'2021-12-26 09:57:23',0),(13,4,18,1.3,'2021-12-26 09:58:23',0),(14,4,36,1.1,'2021-12-26 09:58:23',1),(15,4,48,1,'2021-12-26 09:58:23',0),(16,4,72,0.9,'2021-12-26 09:58:23',0),(17,5,18,1.2,'2021-12-26 10:00:12',0),(18,5,36,1,'2021-12-26 10:00:12',1),(19,5,48,0.9,'2021-12-26 10:00:12',0),(20,5,72,0.8,'2021-12-26 10:00:12',0),(21,6,18,1.3,'2021-12-26 10:00:12',0),(22,6,36,1.1,'2021-12-26 10:00:12',1),(23,6,48,0.95,'2021-12-26 10:00:12',0),(24,6,72,0.85,'2021-12-26 10:00:12',0),(25,7,18,1.2,'2021-12-26 10:02:07',0),(26,7,36,1,'2021-12-26 10:02:07',1),(27,7,48,0.9,'2021-12-26 10:02:07',0),(28,7,72,0.8,'2021-12-26 10:02:07',0),(29,8,18,1.3,'2021-12-26 10:02:07',0),(30,8,36,1.1,'2021-12-26 10:02:07',1),(31,8,48,0.97,'2021-12-26 10:02:07',0),(32,8,72,0.87,'2021-12-26 10:02:07',0),(33,9,18,1.2,'2021-12-26 10:06:40',0),(34,9,36,1,'2021-12-26 10:06:40',1),(35,9,48,0.9,'2021-12-26 10:06:40',0),(36,9,72,0.1,'2021-12-26 10:06:40',0),(37,10,18,1.3,'2021-12-26 10:06:40',0),(38,10,36,1.1,'2021-12-26 10:06:40',1),(39,10,48,0.99,'2021-12-26 10:06:40',0),(40,10,72,0.89,'2021-12-26 10:06:40',0),(41,11,18,1.2,'2021-12-26 10:07:34',0),(42,11,36,1,'2021-12-26 10:07:34',1),(43,11,48,0.9,'2021-12-26 10:07:34',0),(44,11,72,0.1,'2021-12-26 10:07:34',0),(45,12,18,1.3,'2021-12-26 10:07:34',0),(46,12,36,1.1,'2021-12-26 10:07:34',1),(47,12,48,0.99,'2021-12-26 10:07:34',0),(48,12,72,0.89,'2021-12-26 10:07:34',0),(49,13,18,1.2,'2021-12-26 10:08:04',0),(50,13,36,1,'2021-12-26 10:08:04',1),(51,13,48,0.9,'2021-12-26 10:08:04',0),(52,13,72,0.1,'2021-12-26 10:08:04',0),(53,14,18,1.3,'2021-12-26 10:08:04',0),(54,14,36,1.1,'2021-12-26 10:08:04',1),(55,14,48,0.99,'2021-12-26 10:08:04',0),(56,14,72,0.89,'2021-12-26 10:08:04',0),(57,15,18,1.2,'2021-12-26 10:08:24',0),(58,15,36,1,'2021-12-26 10:08:24',1),(59,15,48,0.9,'2021-12-26 10:08:24',0),(60,15,72,0.1,'2021-12-26 10:08:24',0);
/*!40000 ALTER TABLE `cpe_service_complexity_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `cpe_service_all`
--

/*!50001 DROP VIEW IF EXISTS `cpe_service_all`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cpe_service_all` AS select `cpe_service_complexity_price`.`id` AS `id`,`cpe_service_complexity_price`.`service_complexity_id` AS `service_complexity_id`,`cpe_service_complexity_price`.`price` AS `price`,`cpe_service_complexity_price`.`show_default` AS `show_default`,`cpe_service_complexity_price`.`time_price` AS `time_price`,`cpe_service_complexity`.`name` AS `complexity_name`,`cpe_service`.`id` AS `service_id`,`cpe_service`.`name` AS `service_name`,`cpe_service`.`parent_service` AS `service_parent` from ((`cpe_service_complexity_price` join `cpe_service_complexity`) join `cpe_service`) where ((`cpe_service_complexity_price`.`service_complexity_id` = `cpe_service_complexity`.`id`) and (`cpe_service`.`id` = `cpe_service_complexity`.`service_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-02 17:31:25
