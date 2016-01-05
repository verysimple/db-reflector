-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: cargo
-- ------------------------------------------------------
-- Server version	5.5.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(45) DEFAULT '',
  `c_last_login` timestamp NULL DEFAULT NULL,
  `c_company` varchar(45) DEFAULT '',
  `c_city` varchar(45) DEFAULT '',
  `c_level` enum('Standard','Premium') NOT NULL DEFAULT 'Standard',
  `c_error` varbinary(5) DEFAULT NULL,
  `c_123` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`c_id`, `c_name`, `c_last_login`, `c_company`, `c_city`, `c_level`, `c_error`, `c_123`) VALUES (1,'UPDATE','2011-11-09 06:00:00','ACME 123','Chicago','Standard','','aaa'),(2,'Frank, Jimbo','2012-01-01 11:04:00','The Company','New York','Standard','',NULL),(3,'James, Erika','2012-01-03 11:04:00','Worker Bee','Los Angeles','Standard','',NULL),(4,'James, Grace','2012-01-01 11:04:00','The Company','New York','Premium','aaa',NULL);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `customer_view`
--

DROP TABLE IF EXISTS `customer_view`;
/*!50001 DROP VIEW IF EXISTS `customer_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `customer_view` AS SELECT 
 1 AS `c_id`,
 1 AS `c_name`,
 1 AS `c_last_login`,
 1 AS `c_company`,
 1 AS `c_city`,
 1 AS `c_level`,
 1 AS `c_error`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `no_key`
--

DROP TABLE IF EXISTS `no_key`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `no_key` (
  `nk_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `no_key`
--

LOCK TABLES `no_key` WRITE;
/*!40000 ALTER TABLE `no_key` DISABLE KEYS */;
/*!40000 ALTER TABLE `no_key` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_ship_date` date DEFAULT NULL,
  `p_ship_time` datetime DEFAULT NULL,
  `p_customer_id` int(10) unsigned DEFAULT NULL,
  `p_tracking_number` varchar(45) DEFAULT NULL,
  `p_description` text,
  `p_service` varchar(10) DEFAULT NULL,
  `p_destination` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `p_customer` (`p_customer_id`),
  KEY `p_service_code` (`p_service`),
  CONSTRAINT `p_customer` FOREIGN KEY (`p_customer_id`) REFERENCES `customer` (`c_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `p_service_code` FOREIGN KEY (`p_service`) REFERENCES `service` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
INSERT INTO `package` (`p_id`, `p_ship_date`, `p_ship_time`, `p_customer_id`, `p_tracking_number`, `p_description`, `p_service`, `p_destination`) VALUES (1,'2012-07-06','2012-11-07 00:00:00',3,'CC4567890123','office supplies','overnight','Chicago'),(2,'2012-01-31','2013-12-31 18:00:00',2,'BB9874567890','materials','2-day','New York'),(3,'2012-01-10','2012-01-07 17:23:00',3,'CC4567890123','updated description','ground','Los Angeles'),(4,'2011-12-24','2012-12-04 18:00:00',3,'AA1234567890','software','overnight','Chicago'),(5,'2012-07-01','2012-11-05 01:49:00',3,'BB9874567890','more office supplies','ground','New York'),(6,'2012-04-29','2012-12-11 02:24:32',2,'CC4567890123','fragile cargo','overnight','Chicago'),(7,'2012-04-28','2012-12-11 02:24:32',3,'AA1234567890','software','2-day','New York'),(8,'2012-04-29','2012-11-02 16:40:00',4,'BB9874567890','office supplies','overnight','Los Angeles'),(9,'2012-06-01','2012-12-11 02:24:32',3,'AA1234567890','fragile cargo','ground','Chicago'),(10,'2012-12-31','2012-11-02 16:41:00',2,'CC4567890123','widgets','overnight','New York'),(11,'2012-05-01','2012-08-07 16:41:00',3,'BB9874567890','fragile cargo','2-day','Chicago'),(12,'2012-04-28','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','New York'),(13,'2012-05-29','2012-12-11 02:24:32',2,'BB9874567890','fragile cargo','2-day','Los Angeles'),(14,'2012-04-28','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(15,'2012-08-01','2012-12-11 02:24:32',3,'BB9874567890','office supplies','ground','Chicago'),(16,'2012-05-01','2012-12-11 02:24:32',3,'CC4567890123','office supplies','overnight','Chicago'),(17,'2012-05-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(18,'2012-05-01','2012-12-11 02:24:32',1,'BB9874567890','office supplies','overnight','Chicago'),(19,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(20,'2012-05-01','2012-12-11 02:24:32',3,'BB9874567890','office supplies','overnight','Chicago'),(21,'2012-06-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(22,'2012-05-01','2012-12-11 02:24:32',1,'BB9874567890','office supplies','overnight','Chicago'),(23,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(24,'2012-05-01','2012-12-11 02:24:32',3,'CC4567890123','office supplies','overnight','Chicago'),(25,'2012-06-01','2012-12-11 02:24:32',4,'AA1234567890','UPDATED','overnight','Chicago'),(26,'2012-05-01','2012-12-11 02:24:32',1,'CC4567890123','office supplies','overnight','Chicago'),(27,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(28,'2012-05-01','2012-12-11 02:24:32',1,'AA1234567890','office supplies','overnight','Chicago'),(29,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(30,'2012-05-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(31,'2012-05-01','2012-12-11 02:24:32',1,'AA1234567890','office supplies','overnight','Chicago'),(32,'2012-06-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(33,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(34,'2012-05-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(35,'2012-05-01','2012-12-11 02:24:32',1,'AA1234567890','office supplies','overnight','Chicago'),(36,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(37,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(38,'2012-05-01','2012-12-11 02:24:32',4,'AA1234567890','office supplies','overnight','Chicago'),(39,'2012-05-01','2012-12-11 02:24:32',1,'AA1234567890','office supplies','overnight','Chicago'),(40,'2012-05-01','2012-12-11 02:24:32',2,'AA1234567890','office supplies','overnight','Chicago'),(41,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(42,'2012-06-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago'),(44,'2012-05-02','2012-11-03 17:23:00',2,'AA1234567890','office supplies','overnight','Chicago'),(45,'2012-05-01','2012-12-11 02:24:32',3,'AA1234567890','office supplies','overnight','Chicago');
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_status_code_id` varchar(3) DEFAULT NULL,
  `p_quantity` int(11) DEFAULT '1',
  `p_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `p_status_idx` (`p_status_code_id`),
  CONSTRAINT `p_status_code` FOREIGN KEY (`p_status_code_id`) REFERENCES `status_code` (`sc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
INSERT INTO `purchase` (`p_id`, `p_status_code_id`, `p_quantity`, `p_description`) VALUES (1,'O',1,'Purchase Order A'),(2,'O',1,'Purchase Order B');
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `s_id` varchar(10) NOT NULL,
  `s_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` (`s_id`, `s_name`) VALUES ('2-day','2-Day'),('book','Book Rate'),('ground','Ground'),('overnight','Overnight');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_code`
--

DROP TABLE IF EXISTS `status_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_code` (
  `sc_id` varchar(3) NOT NULL,
  `sc_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_code`
--

LOCK TABLES `status_code` WRITE;
/*!40000 ALTER TABLE `status_code` DISABLE KEYS */;
INSERT INTO `status_code` (`sc_id`, `sc_name`) VALUES ('C','Closed'),('O','Open');
/*!40000 ALTER TABLE `status_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `customer_view`
--

/*!50001 DROP VIEW IF EXISTS `customer_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `customer_view` AS select `customer`.`c_id` AS `c_id`,`customer`.`c_name` AS `c_name`,`customer`.`c_last_login` AS `c_last_login`,`customer`.`c_company` AS `c_company`,`customer`.`c_city` AS `c_city`,`customer`.`c_level` AS `c_level`,`customer`.`c_error` AS `c_error` from `customer` */;
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

-- Dump completed on 2016-01-04 23:23:33
