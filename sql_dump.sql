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
  `time` int NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `show_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`service_complexity_id`,`time`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpe_service_complexity_price`
--

LOCK TABLES `cpe_service_complexity_price` WRITE;
/*!40000 ALTER TABLE `cpe_service_complexity_price` DISABLE KEYS */;
INSERT INTO `cpe_service_complexity_price` VALUES (1,7,6,1.5,NULL,0),(2,13,12,1.25,NULL,0),(3,14,24,1,NULL,0),(4,15,6,2,NULL,0),(5,12,12,1.7,NULL,0),(6,1,6,1,NULL,0),(7,5,12,0.5,NULL,0),(8,2,12,0.5,NULL,0),(9,6,24,0.2,NULL,0),(10,10,6,1,NULL,0),(11,11,12,0.5,NULL,0);
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
/*!50001 VIEW `cpe_service_all` AS select `cpe_service_complexity_price`.`id` AS `id`,`cpe_service_complexity_price`.`service_complexity_id` AS `service_complexity_id`,`cpe_service_complexity_price`.`price` AS `price`,`cpe_service_complexity_price`.`show_default` AS `show_default`,`cpe_service_complexity`.`name` AS `complexity_name`,`cpe_service`.`id` AS `service_id`,`cpe_service`.`name` AS `service_name`,`cpe_service`.`parent_service` AS `service_parent` from ((`cpe_service_complexity_price` join `cpe_service_complexity`) join `cpe_service`) where ((`cpe_service_complexity_price`.`service_complexity_id` = `cpe_service_complexity`.`id`) and (`cpe_service`.`id` = `cpe_service_complexity`.`service_id`)) */;
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

-- Dump completed on 2021-12-23 16:58:48
