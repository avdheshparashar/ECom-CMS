-- MySQL dump 10.13  Distrib 5.6.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ascreation
-- ------------------------------------------------------
-- Server version	5.6.24-0ubuntu2

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
-- Table structure for table `tbl_billings`
--

DROP TABLE IF EXISTS `tbl_billings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_billings` (
  `billing_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` text,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `mobilenumber` bigint(12) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`billing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_billings`
--

LOCK TABLES `tbl_billings` WRITE;
/*!40000 ALTER TABLE `tbl_billings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_billings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_brands`
--

DROP TABLE IF EXISTS `tbl_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` mediumtext,
  `image` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `slug` varchar(50) NOT NULL,
  `banner_image` varchar(50) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_brands`
--

LOCK TABLES `tbl_brands` WRITE;
/*!40000 ALTER TABLE `tbl_brands` DISABLE KEYS */;
INSERT INTO `tbl_brands` VALUES (16,'Nike','0','','2015-07-09 08:13:08','2015-07-09 10:45:18','nike','1.jpg'),(17,'Suunto','0','','2015-07-09 11:46:00','0000-00-00 00:00:00','suunto','1.jpg'),(18,'Garmin','0','','2015-07-09 11:46:15','0000-00-00 00:00:00','garmin','1.jpg');
/*!40000 ALTER TABLE `tbl_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categories` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `description` text,
  `image_name` varchar(30) DEFAULT NULL,
  `page_title` varchar(30) NOT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `lft` int(4) NOT NULL,
  `ryt` int(4) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `banner_image` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categories`
--

LOCK TABLES `tbl_categories` WRITE;
/*!40000 ALTER TABLE `tbl_categories` DISABLE KEYS */;
INSERT INTO `tbl_categories` VALUES (1,0,'Adventure, Sports & Outdoor','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','1.jpg','Adventure, Sports & Outdoor','Adventure, Sports & Outdoor','Adventure, Sports & Outdoor',1,26,'Adventure_Sports_Outdoor',1,'2015-06-01 14:48:59','0000-00-00 00:00:00','banner1.jpg'),(2,0,'Analytical, Hydrology & Weathe','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','2.jpg','Analytical & Weather','Analytical & Weather','Analytical & Weather',27,46,'Analytical_Weather',1,'2015-06-01 14:54:14','0000-00-00 00:00:00','banner1.jpg'),(3,0,'Wildlife, Forestry & Survey','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','3.jpg','Wildlife, Forestry & Survey','Wildlife, Forestry & Survey','Wildlife, Forestry & Survey',47,54,'Wildlife_Forestry_Survey',1,'2015-06-01 14:54:39','0000-00-00 00:00:00','banner1.jpg'),(4,1,'Salomon','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','4.jpg','Salomon','Salomon','Salomon',12,25,'salomon',1,'2015-06-01 14:55:11','0000-00-00 00:00:00','banner1.jpg'),(5,1,'Suunto','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','5.jpg','','Suunto','Suunto',6,11,'sunnto',1,'2015-06-01 15:01:00','0000-00-00 00:00:00','banner1.jpg'),(6,2,'Marmot','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','6.jpg','','Marmot','Marmot',44,45,'marmot',1,'2015-06-01 15:01:25','0000-00-00 00:00:00','banner1.jpg'),(7,2,'Hawke','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','7.jpg','','Hawke','Hawke',40,43,'hawke',1,'2015-06-01 15:01:54','0000-00-00 00:00:00','banner1.jpg'),(8,3,'Ram Mount','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','9.jpg','','Ram Mount','Ram Mount',54,59,'ram_mount',1,'2015-06-01 15:02:30','0000-00-00 00:00:00','banner1.jpg'),(9,3,'Vectrincs','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','10.jpg','','Vectrincs','Vectrincs',52,53,'vectrincs',1,'2015-06-01 15:03:25','0000-00-00 00:00:00','banner1.jpg'),(10,3,'Estwing','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','19.jpg','','Estwing','Estwing',48,51,'estwing',1,'2015-06-01 15:03:50','0000-00-00 00:00:00','banner1.jpg'),(11,5,'Footwear','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','1.jpg','','Footwear','Footwear',7,10,'footwear',1,'2015-06-01 15:04:06','0000-00-00 00:00:00','banner1.jpg'),(12,4,'Apparel','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','1.jpg','','Apparel','Apparel',23,24,'apparel',1,'2015-06-01 15:04:42','0000-00-00 00:00:00','banner1.jpg'),(13,7,'Watches','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','1.jpg','','Watches','Watches',41,42,'watches',1,'2015-06-01 15:05:24','0000-00-00 00:00:00','banner1.jpg'),(14,10,'Compass','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','1.jpg','','Compass','Compass',49,50,'compass',1,'2015-06-01 15:06:09','0000-00-00 00:00:00','banner1.jpg'),(15,8,'Planimeter','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','1.jpg','','Planimeter','Planimeter',55,58,'planimeter',1,'2015-06-01 15:06:25','0000-00-00 00:00:00','banner1.jpg'),(16,11,'Hiking','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','1.jpg','','Hiking','Hiking',8,9,'hiking',1,'2015-06-01 15:06:42','0000-00-00 00:00:00','banner1.jpg'),(17,15,'Amphibious Sports','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','1.jpg','','Amphibious Sports','Amphibious Sports',56,57,'amphibious_sports',1,'2015-06-01 15:07:03','0000-00-00 00:00:00','banner1.jpg'),(21,3,'Regatta','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','12.jpg','Regatta','Regatta','Regatta',48,53,'regatta',1,'2015-06-12 03:56:53','0000-00-00 00:00:00','banner1.jpg'),(22,21,'T-shirt','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','about-banner.jpg','','T-shirt','T-shirt',51,52,'t-shirt',1,'2015-06-12 04:15:11','0000-00-00 00:00:00','banner1.jpg'),(23,4,'Backpacking','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','SALOMON.jpg','','Backpacking','Backpacking',21,22,'backpacking',1,'2015-06-12 08:11:01','0000-00-00 00:00:00','banner1.jpg'),(24,4,'Hiking','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','SALOMON.jpg','','Hiking','Hiking',19,20,'hiking-1',1,'2015-06-12 08:18:27','0000-00-00 00:00:00','banner1.jpg'),(25,4,'Running','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','SALOMON.jpg','','Running\n','Running\n',17,18,'running',1,'2015-06-12 08:18:44','0000-00-00 00:00:00','banner1.jpg'),(26,4,'Mountain Trail','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','SALOMON.jpg','','Mountain Trail','Mountain Trail',15,16,'mountain-trail',1,'2015-06-12 08:19:32','0000-00-00 00:00:00','banner1.jpg'),(27,4,'Trail Running','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','SALOMON.jpg','','Trail Running\n','Trail Running\n',13,14,'trail-running',1,'2015-06-12 08:19:53','0000-00-00 00:00:00','banner1.jpg'),(28,21,'Accessories','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','SALOMON.jpg','','Accessories','Accessories',49,50,'accessories',1,'2015-06-12 08:21:25','0000-00-00 00:00:00','banner1.jpg'),(29,2,'Lingti','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','8.jpg','','Lingti','Lingti',30,39,'lingti',1,'2015-06-12 08:29:09','0000-00-00 00:00:00','banner1.jpg'),(30,29,'Backpack','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','SALOMON.jpg','','Backpack','Backpack',37,38,'backpack',1,'2015-06-12 08:29:50','0000-00-00 00:00:00','banner1.jpg'),(31,29,'Sleeping Bag','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','SALOMON.jpg','','Sleeping Bag','Sleeping Bag',35,36,'sleeping-bag',1,'2015-06-12 08:30:14','0000-00-00 00:00:00','banner1.jpg'),(32,29,'Tent','Lorem ipsum dolor sit amet,consectetur adipiscing elit.','SALOMON.jpg','','Tent','Tent',33,34,'tent',1,'2015-06-12 08:30:37','0000-00-00 00:00:00','banner1.jpg'),(33,1,'GPS','GPS','garmin.jpg','','GPS','GPS',4,5,'gps',1,'2015-07-08 10:06:45','0000-00-00 00:00:00','banner1.jpg'),(34,1,'Sleeping Bag','Sleeping Bag','slipping-bag.jpg','','Sleeping Bag','Sleeping Bag',2,3,'sleeping-bag-1',1,'2015-07-08 10:08:45','0000-00-00 00:00:00','banner1.jpg'),(35,2,'Binocular','Binocular','garmin.jpg','','Binocular','Binocular',28,29,'binocular',1,'2015-07-08 11:30:36','0000-00-00 00:00:00',''),(36,29,'Binocular','Binocularasdkjasdh','garmin.jpg','Binocular','Binocular','Binocular',31,32,'binocular-1',1,'2015-07-08 11:47:31','0000-00-00 00:00:00','1.png');
/*!40000 ALTER TABLE `tbl_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_controller_methods`
--

DROP TABLE IF EXISTS `tbl_controller_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_controller_methods` (
  `controller_method_id` int(20) NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`controller_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_controller_methods`
--

LOCK TABLES `tbl_controller_methods` WRITE;
/*!40000 ALTER TABLE `tbl_controller_methods` DISABLE KEYS */;
INSERT INTO `tbl_controller_methods` VALUES (1,'controllermethod','index',0,'2015-03-19 06:04:25','0000-00-00 00:00:00'),(2,'controllermethod','add',0,'2015-03-19 06:04:25','0000-00-00 00:00:00'),(3,'controllermethod','edit',0,'2015-03-19 06:29:23','0000-00-00 00:00:00'),(4,'category','index',0,'2015-05-12 06:33:41','0000-00-00 00:00:00'),(5,'category','inquiry',0,'2015-05-12 06:33:41','0000-00-00 00:00:00'),(6,'category','export',0,'2015-05-12 06:33:41','0000-00-00 00:00:00'),(7,'category','add',0,'2015-05-12 06:33:42','0000-00-00 00:00:00'),(8,'category','edit',0,'2015-05-12 06:33:42','0000-00-00 00:00:00'),(9,'brand','index',0,'2015-05-12 06:34:06','0000-00-00 00:00:00'),(10,'brand','export',0,'2015-05-12 06:34:06','0000-00-00 00:00:00'),(11,'brand','save',0,'2015-05-12 06:34:06','0000-00-00 00:00:00'),(12,'discount','index',0,'2015-05-12 06:34:28','0000-00-00 00:00:00'),(13,'discount','changestatus',0,'2015-05-12 06:34:28','0000-00-00 00:00:00'),(14,'discount','add',0,'2015-05-12 06:34:28','0000-00-00 00:00:00'),(15,'discount','save',0,'2015-05-12 06:34:28','0000-00-00 00:00:00'),(16,'discount','history',0,'2015-05-12 06:34:28','0000-00-00 00:00:00'),(17,'gallery','index',0,'2015-05-12 06:34:55','0000-00-00 00:00:00'),(18,'inventory','index',0,'2015-05-12 06:35:56','0000-00-00 00:00:00'),(19,'inventory','delete',0,'2015-05-12 06:35:56','0000-00-00 00:00:00'),(20,'inventory','add',0,'2015-05-12 06:35:56','0000-00-00 00:00:00'),(21,'inventory','edit',0,'2015-05-12 06:35:56','0000-00-00 00:00:00'),(22,'inventory','save',0,'2015-05-12 06:35:56','0000-00-00 00:00:00'),(23,'offer','index',0,'2015-05-12 06:36:44','0000-00-00 00:00:00'),(24,'offer','changestatus',0,'2015-05-12 06:36:44','0000-00-00 00:00:00'),(25,'offer','delete',0,'2015-05-12 06:36:44','0000-00-00 00:00:00'),(26,'offer','add',0,'2015-05-12 06:36:44','0000-00-00 00:00:00'),(27,'offer','edit',0,'2015-05-12 06:36:44','0000-00-00 00:00:00'),(28,'offer','save',0,'2015-05-12 06:36:44','0000-00-00 00:00:00'),(29,'order','index',0,'2015-05-12 06:37:18','0000-00-00 00:00:00'),(30,'order','changestatus',0,'2015-05-12 06:37:18','0000-00-00 00:00:00'),(31,'order','history',0,'2015-05-12 06:37:18','0000-00-00 00:00:00'),(32,'order','invoice',0,'2015-05-12 06:37:18','0000-00-00 00:00:00'),(33,'review','index',0,'2015-05-12 06:37:54','0000-00-00 00:00:00'),(34,'review','changestatus',0,'2015-05-12 06:37:54','0000-00-00 00:00:00'),(35,'review','delete',0,'2015-05-12 06:37:54','0000-00-00 00:00:00'),(36,'setting','index',0,'2015-05-12 06:38:20','0000-00-00 00:00:00'),(37,'setting','delete',0,'2015-05-12 06:38:20','0000-00-00 00:00:00'),(38,'setting','save',0,'2015-05-12 06:38:20','0000-00-00 00:00:00'),(39,'permission','index',0,'2015-05-12 06:41:17','0000-00-00 00:00:00'),(40,'permission','getSelectedRoleData',0,'2015-05-12 06:41:17','0000-00-00 00:00:00'),(41,'permission','add',0,'2015-05-12 06:41:17','0000-00-00 00:00:00'),(42,'permission','edit',0,'2015-05-12 06:41:17','0000-00-00 00:00:00'),(43,'permission','delete',0,'2015-05-12 06:41:17','0000-00-00 00:00:00'),(44,'permission','updataPermissionAction',0,'2015-05-12 06:41:17','0000-00-00 00:00:00'),(45,'role','index',0,'2015-05-12 06:41:45','0000-00-00 00:00:00'),(46,'role','add',0,'2015-05-12 06:41:45','0000-00-00 00:00:00'),(47,'role','edit',0,'2015-05-12 06:41:45','0000-00-00 00:00:00'),(48,'role','delete',0,'2015-05-12 06:41:45','0000-00-00 00:00:00'),(49,'subscriber','index',0,'2015-05-12 06:44:09','0000-00-00 00:00:00'),(50,'subscriber','export',0,'2015-05-12 06:44:09','0000-00-00 00:00:00'),(51,'subscriber','add',0,'2015-05-12 06:44:09','0000-00-00 00:00:00'),(52,'subscriber','edit',0,'2015-05-12 06:44:09','0000-00-00 00:00:00'),(53,'page','index',0,'2015-05-12 06:44:57','0000-00-00 00:00:00'),(54,'page','add',0,'2015-05-12 06:44:57','0000-00-00 00:00:00'),(55,'page','edit',0,'2015-05-12 06:44:57','0000-00-00 00:00:00'),(56,'page','save',0,'2015-05-12 06:44:57','0000-00-00 00:00:00'),(57,'page','delete',0,'2015-05-12 06:44:57','0000-00-00 00:00:00'),(58,'product','index',0,'2015-05-18 04:35:53','0000-00-00 00:00:00'),(59,'product','add',0,'2015-05-18 04:35:53','0000-00-00 00:00:00'),(60,'product','edit',0,'2015-05-18 04:35:53','0000-00-00 00:00:00'),(61,'product','update',0,'2015-05-18 04:35:53','0000-00-00 00:00:00'),(62,'product','fetch_image',0,'2015-05-18 04:35:53','0000-00-00 00:00:00'),(63,'product','fetch_album',0,'2015-05-18 04:35:53','0000-00-00 00:00:00'),(64,'product','upload',0,'2015-05-18 04:35:53','0000-00-00 00:00:00'),(65,'product','remove_image',0,'2015-05-18 04:35:53','0000-00-00 00:00:00'),(66,'slideshow','index',0,'2015-05-18 07:18:47','0000-00-00 00:00:00'),(67,'slideshow','add',0,'2015-05-18 07:18:47','0000-00-00 00:00:00'),(68,'slideshow','edit',0,'2015-05-18 07:18:47','0000-00-00 00:00:00'),(69,'slideshow','delete',0,'2015-05-18 07:18:47','0000-00-00 00:00:00'),(70,'slideshow','save',0,'2015-05-18 07:18:47','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_controller_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_customers`
--

DROP TABLE IF EXISTS `tbl_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `mobilenumber` bigint(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `verifylink` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_customers`
--

LOCK TABLES `tbl_customers` WRITE;
/*!40000 ALTER TABLE `tbl_customers` DISABLE KEYS */;
INSERT INTO `tbl_customers` VALUES (1,1,'viral','thakkar',919909704757,'viral@bugletech.com','cce3546c1c8bdb0081cdab254741f60629d137c4',NULL,NULL,1,'2015-03-04 07:27:58','2015-03-05 05:39:49'),(2,2,'sagar','khatri',9909704757,'viral@bugletech.com','admin.123',NULL,NULL,1,'2015-03-04 07:29:50','0000-00-00 00:00:00'),(3,3,'tejas','khatri',9909704757,'viral@bugletech.com','admin.123',NULL,NULL,1,'2015-03-04 07:30:06','0000-00-00 00:00:00'),(4,0,'viral','thakkar',990904757,'sdf@mailinator.com','admin.123','5ab1a8202e312447b118515f1e1f4d72',NULL,0,'2015-03-05 06:23:14','2015-06-10 05:53:49'),(5,0,'sdfsd','sdfsdf',9834123434,'sasdf@mailinator.com','admin.123','0',NULL,0,'2015-03-05 06:34:00','0000-00-00 00:00:00'),(6,7,'Viral','Thakkar',9834123434,'viral@bugletech.com','admin.123','0',NULL,1,'2015-03-05 06:39:02','0000-00-00 00:00:00'),(8,4,'sdfsd','sdfsdf',9834123434,'yoo@bugletech.com','c44539d0a860f889eeedfa359de2050863b75d4b','0',NULL,0,'2015-03-05 07:12:18','0000-00-00 00:00:00'),(9,0,'viral','SHUKAL',9812121212,'NIPEN@MAILINATOR.COM','c9ae4edfb425bff9aeb4740eb89b91a33071ced8','73c78013c14dcb42f0eda4571404ab1f',NULL,0,'2015-06-09 05:12:57','0000-00-00 00:00:00'),(10,0,'ldfsdkfj','lkjslkdfjsdlkj',9939384343,'kljsdfj@mailinator.com','c9ae4edfb425bff9aeb4740eb89b91a33071ced8','8609639f42ec3a0554ef3bfc37bfaaf1',NULL,0,'2015-06-09 05:33:28','0000-00-00 00:00:00'),(11,6,'Avdhesh','parashar',9923121212,'avdhesh@bugletech.com','c9ae4edfb425bff9aeb4740eb89b91a33071ced8','b77ac6dae827f4caad3a7a4597a5564a',NULL,0,'2015-06-11 07:03:49','0000-00-00 00:00:00'),(12,0,'kiran','kher',8223121212,'kiran@mailinator.com','c9ae4edfb425bff9aeb4740eb89b91a33071ced8','7442a6738ae83056c2755e5f69000509',NULL,0,'2015-06-11 07:04:31','0000-00-00 00:00:00'),(13,0,'Ronit','roy',9034123456,'ronit@mailinator.com','c9ae4edfb425bff9aeb4740eb89b91a33071ced8','92ef8a1a34b5c974cb92bea6df05103d',NULL,0,'2015-06-17 09:39:38','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_discount_categories`
--

DROP TABLE IF EXISTS `tbl_discount_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_discount_categories` (
  `discount_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `discount_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`discount_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_discount_categories`
--

LOCK TABLES `tbl_discount_categories` WRITE;
/*!40000 ALTER TABLE `tbl_discount_categories` DISABLE KEYS */;
INSERT INTO `tbl_discount_categories` VALUES (1,2,5),(2,2,11),(3,2,16);
/*!40000 ALTER TABLE `tbl_discount_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_discounthistories`
--

DROP TABLE IF EXISTS `tbl_discounthistories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_discounthistories` (
  `discounthistory_id` int(10) NOT NULL AUTO_INCREMENT,
  `discount_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `order_id` int(4) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`discounthistory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_discounthistories`
--

LOCK TABLES `tbl_discounthistories` WRITE;
/*!40000 ALTER TABLE `tbl_discounthistories` DISABLE KEYS */;
INSERT INTO `tbl_discounthistories` VALUES (1,1,1,1,'2015-06-06 06:28:52'),(2,1,2,2,'2015-06-06 06:28:52');
/*!40000 ALTER TABLE `tbl_discounthistories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_discounts`
--

DROP TABLE IF EXISTS `tbl_discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_discounts` (
  `discount_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `code` varchar(10) NOT NULL,
  `is_limit` int(4) DEFAULT NULL COMMENT 'If no limit=> 0 else actual value of number of times usable limit',
  `discount_type` int(1) DEFAULT NULL COMMENT '1=> Precent based, 2=> fixed amount',
  `discount_amount` int(5) DEFAULT NULL COMMENT 'If discount_type=> 2, it is actual value of discount amount ELSE NULL',
  `min_order` int(5) DEFAULT NULL COMMENT 'min purchase amount for which discount is valid',
  `discount_begin` datetime DEFAULT NULL COMMENT 'datetime from when discount begins',
  `discount_ends` datetime DEFAULT NULL COMMENT 'if is_expire=> 1, datetime from when discount ends',
  `is_expire` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `applytoall` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`discount_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_discounts`
--

LOCK TABLES `tbl_discounts` WRITE;
/*!40000 ALTER TABLE `tbl_discounts` DISABLE KEYS */;
INSERT INTO `tbl_discounts` VALUES (1,'Summer Sell','6SC5MNCRM9',3,1,10,1999,'2015-06-01 00:00:00','2015-06-10 00:00:00',1,1,'2015-06-03 09:51:39',1),(2,'discount','K6VNTLFUA7',0,1,10,1000,'2015-06-08 00:00:00',NULL,0,1,'2015-06-03 13:07:22',0);
/*!40000 ALTER TABLE `tbl_discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fields`
--

DROP TABLE IF EXISTS `tbl_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fields` (
  `field_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `field_type` int(1) NOT NULL DEFAULT '0',
  `is_require` int(1) NOT NULL DEFAULT '0',
  `is_filter` int(1) NOT NULL DEFAULT '0',
  `content` text,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fields`
--

LOCK TABLES `tbl_fields` WRITE;
/*!40000 ALTER TABLE `tbl_fields` DISABLE KEYS */;
INSERT INTO `tbl_fields` VALUES (13,'Gender',1,1,1,'Male,Female,Unisex'),(14,'Size',1,1,1,'S, M, L, XL, XXL, 6, 8, 10, 12'),(15,'Color',1,0,0,'Red,Green,Blue,'),(18,'Features',1,0,0,NULL),(19,'Brand',1,1,1,'sunnato'),(20,'Category',1,0,0,NULL);
/*!40000 ALTER TABLE `tbl_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_groups`
--

DROP TABLE IF EXISTS `tbl_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_groups` (
  `group_id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_groups`
--

LOCK TABLES `tbl_groups` WRITE;
/*!40000 ALTER TABLE `tbl_groups` DISABLE KEYS */;
INSERT INTO `tbl_groups` VALUES (1,'admin','2015-03-04 06:54:57'),(2,'customer','2015-03-04 06:55:05');
/*!40000 ALTER TABLE `tbl_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_images`
--

DROP TABLE IF EXISTS `tbl_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_images` (
  `image_id` int(10) NOT NULL,
  `album_id` int(10) NOT NULL,
  `image_name` varchar(30) NOT NULL,
  `image_alt` varchar(30) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_images`
--

LOCK TABLES `tbl_images` WRITE;
/*!40000 ALTER TABLE `tbl_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_inquiries`
--

DROP TABLE IF EXISTS `tbl_inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_inquiries` (
  `inquiry_id` int(5) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `customer_id` int(10) DEFAULT '0',
  `name` varchar(80) NOT NULL,
  `city` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobilenumber` bigint(15) NOT NULL,
  `message` text,
  `is_reply` int(1) NOT NULL DEFAULT '0' COMMENT '0=> not replied to inquiry  so far, 1=> replied',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inquiry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_inquiries`
--

LOCK TABLES `tbl_inquiries` WRITE;
/*!40000 ALTER TABLE `tbl_inquiries` DISABLE KEYS */;
INSERT INTO `tbl_inquiries` VALUES (1,7,0,'sdf','sdf','sdf@gmail.com',5456456,'shdklgh\n',0,'2015-06-09 09:11:47'),(4,7,0,'Avdhesh','Ahmedabad','avdhesh@bugletech.com',654541654,'Waah!!',0,'2015-06-09 12:30:49');
/*!40000 ALTER TABLE `tbl_inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_offers`
--

DROP TABLE IF EXISTS `tbl_offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_offers` (
  `offer_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `discount_type` int(1) NOT NULL COMMENT 'If 1=> percent based, 2=> actual amount',
  `discount_amount` int(5) NOT NULL COMMENT 'if value of discount_type flag is 2, then it is actual amount of offer',
  `discount_on` int(1) NOT NULL COMMENT 'If value is 1=>offer is on Product, If value is 2=> Offer is on category ',
  `item_id` int(10) NOT NULL COMMENT 'If value of flag discount_on is 1=>this column will have product_id,If discount_on is 2=>It is category_id',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_offers`
--

LOCK TABLES `tbl_offers` WRITE;
/*!40000 ALTER TABLE `tbl_offers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_orderdetails`
--

DROP TABLE IF EXISTS `tbl_orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_orderdetails` (
  `orderdetail_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `parameter` varchar(100) DEFAULT NULL,
  `qty` int(5) NOT NULL,
  `price` int(8) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderdetail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orderdetails`
--

LOCK TABLES `tbl_orderdetails` WRITE;
/*!40000 ALTER TABLE `tbl_orderdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_orderhistories`
--

DROP TABLE IF EXISTS `tbl_orderhistories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_orderhistories` (
  `orderhistory_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) NOT NULL,
  `giftcard_id` int(10) NOT NULL,
  `discount_id` int(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderhistory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orderhistories`
--

LOCK TABLES `tbl_orderhistories` WRITE;
/*!40000 ALTER TABLE `tbl_orderhistories` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_orderhistories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `shipping_id` int(10) NOT NULL,
  `billing_id` int(10) NOT NULL,
  `sub_total` int(10) NOT NULL,
  `discount` int(5) NOT NULL DEFAULT '0' COMMENT 'total discount amount on this order',
  `giftcard` int(5) NOT NULL DEFAULT '0' COMMENT 'Amount of money used as credit in this order',
  `final_total` int(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orders`
--

LOCK TABLES `tbl_orders` WRITE;
/*!40000 ALTER TABLE `tbl_orders` DISABLE KEYS */;
INSERT INTO `tbl_orders` VALUES (1,1,1,1,100,10,12,3434,1,'2015-03-05 07:55:26','0000-00-00 00:00:00'),(2,2,1,1,100,10,12,3434,3,'2015-03-05 07:55:54','0000-00-00 00:00:00'),(3,1,2,1,500,12,10,400,3,'2015-03-05 08:54:03','0000-00-00 00:00:00'),(4,2,2,8,1000,100,200,700,3,'2015-03-09 12:06:10','0000-00-00 00:00:00'),(5,2,2,9,1000,100,200,700,0,'2015-03-09 12:11:36','0000-00-00 00:00:00'),(6,2,2,10,1000,100,200,700,0,'2015-03-09 12:14:42','0000-00-00 00:00:00'),(7,2,2,11,1000,100,200,700,2,'2015-03-09 12:15:43','0000-00-00 00:00:00'),(8,1,2,12,1000,100,200,700,1,'2015-03-09 12:16:47','0000-00-00 00:00:00'),(9,2,2,13,1000,100,200,700,2,'2015-03-09 12:16:58','0000-00-00 00:00:00'),(10,2,2,14,1000,100,200,700,0,'2015-03-09 12:19:01','0000-00-00 00:00:00'),(11,2,2,15,1000,100,200,700,0,'2015-03-09 12:23:22','0000-00-00 00:00:00'),(12,2,2,16,1000,100,200,700,0,'2015-03-09 12:23:40','0000-00-00 00:00:00'),(13,2,2,17,1000,100,200,700,0,'2015-03-09 12:24:05','0000-00-00 00:00:00'),(14,2,2,18,1000,100,200,700,2,'2015-03-09 12:24:23','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permissions`
--

DROP TABLE IF EXISTS `tbl_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permissions` (
  `permission_id` int(20) NOT NULL AUTO_INCREMENT,
  `controller_method_id` int(20) NOT NULL,
  `role_id` int(5) NOT NULL,
  `permission` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permissions`
--

LOCK TABLES `tbl_permissions` WRITE;
/*!40000 ALTER TABLE `tbl_permissions` DISABLE KEYS */;
INSERT INTO `tbl_permissions` VALUES (1,4,1,1),(2,5,1,1),(3,6,1,1),(4,7,1,1),(5,8,1,1),(6,9,1,1),(7,10,1,1),(8,11,1,1),(9,12,1,1),(10,13,1,1),(11,14,1,1),(12,15,1,1),(13,16,1,1),(14,17,1,1),(15,18,1,1),(16,19,1,1),(17,20,1,1),(18,21,1,1),(19,22,1,1),(20,23,1,1),(21,24,1,1),(22,25,1,1),(23,26,1,1),(24,27,1,1),(25,28,1,1),(26,29,1,1),(27,30,1,1),(28,31,1,1),(29,32,1,1),(30,33,1,1),(31,34,1,1),(32,35,1,1),(33,36,1,1),(34,37,1,1),(35,38,1,1),(36,1,1,1),(37,2,1,1),(38,3,1,1),(39,39,1,1),(40,40,1,1),(41,41,1,1),(42,42,1,1),(43,43,1,1),(44,44,1,1),(45,45,1,1),(46,46,1,1),(47,47,1,1),(48,48,1,1),(49,49,1,1),(50,50,1,1),(51,51,1,1),(52,52,1,1),(53,53,1,1),(54,54,1,1),(55,55,1,1),(56,56,1,1),(57,57,1,1),(58,4,2,1),(59,5,3,1),(60,4,3,1),(61,6,3,1),(62,7,3,1),(63,8,3,1),(64,9,3,1),(65,58,1,1),(66,59,1,1),(67,60,1,1),(68,61,1,1),(69,62,1,1),(70,63,1,1),(71,64,1,1),(72,65,1,1),(73,66,1,1),(74,67,1,1),(75,68,1,1),(76,69,1,1),(77,70,1,1);
/*!40000 ALTER TABLE `tbl_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product_categories`
--

DROP TABLE IF EXISTS `tbl_product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product_categories` (
  `product_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`product_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product_categories`
--

LOCK TABLES `tbl_product_categories` WRITE;
/*!40000 ALTER TABLE `tbl_product_categories` DISABLE KEYS */;
INSERT INTO `tbl_product_categories` VALUES (1,1,5),(2,1,6),(3,2,5),(4,2,9),(5,2,10),(6,3,5),(7,3,10),(8,4,5),(9,4,13),(10,5,5),(11,5,15),(12,6,5),(13,6,15),(14,7,5),(15,8,5),(17,10,5),(18,9,1),(19,9,34),(20,9,33),(21,9,11),(22,9,16),(23,9,29),(24,9,21),(25,1,33),(26,1,27),(27,1,15),(28,11,34),(29,12,33);
/*!40000 ALTER TABLE `tbl_product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product_details`
--

DROP TABLE IF EXISTS `tbl_product_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product_details` (
  `product_details_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `field_id` int(10) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`product_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product_details`
--

LOCK TABLES `tbl_product_details` WRITE;
/*!40000 ALTER TABLE `tbl_product_details` DISABLE KEYS */;
INSERT INTO `tbl_product_details` VALUES (4,1,13,'Male'),(7,1,14,'S'),(10,1,15,'Green'),(14,2,13,'Female'),(17,2,14,'S'),(18,2,15,'Red'),(19,3,18,' Altimeter'),(20,3,18,'Barometric pressure'),(21,3,18,'trend'),(22,3,18,'3D compass'),(23,3,13,'Male'),(24,3,14,'L'),(25,3,14,'M'),(26,3,14,'S'),(27,3,15,'Blue'),(28,4,18,'Max Depth'),(29,4,18,'descent'),(30,4,18,'max'),(31,4,18,'altitude'),(32,4,13,'Male'),(33,4,14,'L'),(34,4,14,'M'),(35,4,14,'S'),(36,4,15,'Black'),(37,4,15,'white'),(38,5,18,' Log:last 8 ascent'),(39,5,18,'descent'),(40,5,18,'max'),(41,5,18,'altitude'),(42,5,13,'Male'),(43,5,14,'L'),(44,5,14,'M'),(45,5,14,'S'),(46,5,15,'Green'),(47,5,15,'SteelBlack'),(48,6,18,'Auto dive mode with depth'),(49,6,18,'Max Depth'),(50,6,18,'Dive Time'),(51,6,13,'Female'),(52,6,14,'L'),(53,6,14,'M'),(54,6,14,'S'),(55,6,15,'Blue'),(56,6,15,'White'),(57,7,18,'Log :last 14 dives'),(58,7,18,'Altimeter'),(59,7,18,'Barometric pressure & trend'),(60,7,18,'3D compass'),(61,7,13,'Female'),(62,7,14,'L'),(63,7,14,'M'),(64,7,14,'S'),(65,7,15,'Black'),(66,7,15,'white'),(67,8,18,'last 8 ascent'),(68,8,18,'descent'),(69,8,18,'max'),(70,8,18,'altitude'),(71,8,13,'Male'),(72,8,14,'L'),(73,8,14,'M'),(74,8,14,'S'),(75,8,15,'Blue'),(79,9,13,'Male'),(82,9,14,'S'),(83,9,15,'Green'),(88,10,13,'Male'),(91,10,14,'S'),(94,10,19,'Suunto'),(95,10,20,'Suunto'),(96,9,19,'Nike'),(97,9,20,'Regatta'),(98,9,20,'Lingti'),(99,9,20,'GPS'),(100,9,20,'Sleeping Bag'),(101,2,19,'Suunto'),(102,2,20,'Suunto'),(103,2,20,'Marmot'),(104,2,20,'Vectrincs'),(105,2,20,'Estwing'),(106,2,20,'Lingti'),(107,2,20,'GPS'),(108,1,19,'Nike'),(109,1,20,'Suunto'),(110,1,20,'Marmot'),(111,1,20,'GPS'),(112,11,13,'Male'),(113,11,13,'Female'),(114,11,14,'S'),(115,11,14,' M'),(116,11,15,'Red'),(117,11,15,'Green'),(118,12,13,'Male');
/*!40000 ALTER TABLE `tbl_product_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product_filters`
--

DROP TABLE IF EXISTS `tbl_product_filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product_filters` (
  `product_filter_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `field_id` int(10) NOT NULL,
  `details` varchar(255) NOT NULL,
  `is_price` int(1) DEFAULT '0',
  PRIMARY KEY (`product_filter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product_filters`
--

LOCK TABLES `tbl_product_filters` WRITE;
/*!40000 ALTER TABLE `tbl_product_filters` DISABLE KEYS */;
INSERT INTO `tbl_product_filters` VALUES (3,1,0,'79950',1),(14,2,0,'62950',1),(15,2,18,'Altimeter',0),(16,2,18,'Barometric pressure & trend',0),(17,2,18,'3D:compass',0),(18,2,13,'Female',0),(19,2,14,'L',0),(20,2,14,'M',0),(21,2,14,'S',0),(22,2,15,'Red',0),(23,3,0,'79950',1),(24,3,18,'Altimeter',0),(25,3,18,'Barometric pressure',0),(26,3,18,'trend',0),(27,3,18,'3D compass',0),(28,3,13,'Male',0),(29,3,14,'L',0),(30,3,14,'M',0),(31,3,14,'S',0),(32,3,15,'Blue',0),(33,4,0,'65950',1),(34,4,18,'Max Depth',0),(35,4,18,'descent',0),(36,4,18,'max',0),(37,4,18,'altitude',0),(38,4,13,'Male',0),(39,4,14,'L',0),(40,4,14,'M',0),(41,4,14,'S',0),(42,4,15,'Black',0),(43,4,15,'white',0),(44,5,0,'65950',1),(45,5,18,'Log:last 8 ascent',0),(46,5,18,'descent',0),(47,5,18,'max',0),(48,5,18,'altitude',0),(49,5,13,'Male',0),(50,5,14,'L',0),(51,5,14,'M',0),(52,5,14,'S',0),(53,5,15,'Green',0),(54,5,15,'SteelBlack',0),(55,6,0,'64950',1),(56,6,18,'Auto dive mode with depth',0),(57,6,18,'Max Depth',0),(58,6,18,'Dive Time',0),(59,6,13,'Female',0),(60,6,14,'L',0),(61,6,14,'M',0),(62,6,14,'S',0),(63,6,15,'Blue',0),(64,6,15,'White',0),(65,7,0,'64950',1),(66,7,18,'Log :last 14 dives',0),(67,7,18,'Altimeter',0),(68,7,18,'Barometric pressure & trend',0),(69,7,18,'3D compass',0),(70,7,13,'Female',0),(71,7,14,'L',0),(72,7,14,'M',0),(73,7,14,'S',0),(74,7,15,'Black',0),(75,7,15,'white',0),(76,8,0,'69950',1),(77,8,18,'last 8 ascent',0),(78,8,18,'descent',0),(79,8,18,'max',0),(80,8,18,'altitude',0),(81,8,13,'Male',0),(82,8,14,'L',0),(83,8,14,'M',0),(84,8,14,'S',0),(85,8,15,'Blue',0),(86,9,0,'64950',1),(87,9,18,'Auto dive mode with depth',0),(88,9,18,'Water Temperature',0),(89,9,18,'Loglast14dives',0),(90,9,13,'Male',0),(91,9,14,'L',0),(92,9,14,'M',0),(93,9,14,'S',0),(94,9,15,'Green',0),(95,9,15,'SteelBlack',0),(96,10,0,'64950',1),(97,10,18,'Max Depth',0),(98,10,18,'Dive Time',0),(99,10,18,'Water Temperature',0),(100,10,13,'Male',0),(101,10,14,'L',0),(102,10,14,'M',0),(103,10,14,'S',0),(104,10,15,'Black',0),(105,10,15,'White',0),(106,10,19,'Nike',0),(107,9,19,'Nike',0),(108,9,20,'Lingti',0),(109,9,20,'GPS',0),(110,1,20,'Suunto',0),(111,1,20,'Marmot',0),(112,1,20,'GPS',0),(113,11,0,'2000',1),(114,11,13,'Male',0),(115,11,13,'Female',0),(116,11,14,'S',0),(117,11,14,' M',0),(118,11,15,'Red',0),(119,11,15,'Green',0),(120,12,0,'1000',1),(121,12,13,'Male',0);
/*!40000 ALTER TABLE `tbl_product_filters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product_images`
--

DROP TABLE IF EXISTS `tbl_product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product_images` (
  `product_image_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `image` varchar(30) NOT NULL,
  PRIMARY KEY (`product_image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product_images`
--

LOCK TABLES `tbl_product_images` WRITE;
/*!40000 ALTER TABLE `tbl_product_images` DISABLE KEYS */;
INSERT INTO `tbl_product_images` VALUES (1,1,'salomon_06.jpg'),(2,2,'lingti_03.jpg'),(3,2,'lingti_03.jpg'),(4,3,'lingti_12.jpg'),(5,3,'lingti_12.jpg'),(6,4,'regetta_10.jpg'),(7,4,'regetta_10.jpg'),(8,5,'lingti_01.jpg'),(9,5,'lingti_01.jpg'),(10,6,'lingti_03.jpg'),(11,6,'lingti_03.jpg'),(12,7,'lingti_12.jpg'),(13,7,'lingti_12.jpg'),(14,8,'regetta_10.jpg'),(15,9,'salomon_06.jpg'),(16,9,'salomon_06.jpg'),(17,11,'559fadac5b578.png'),(18,11,'559fadac5baa6.png'),(19,11,'559fadac5bdb6.png'),(20,12,'559fb084b120d.png'),(21,12,'559fb084b13f5.png'),(22,12,'559fb084b179d.png'),(23,12,'559fb084b1a07.png');
/*!40000 ALTER TABLE `tbl_product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product_offers`
--

DROP TABLE IF EXISTS `tbl_product_offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product_offers` (
  `product_offer_id` int(10) NOT NULL AUTO_INCREMENT,
  `offer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  PRIMARY KEY (`product_offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product_offers`
--

LOCK TABLES `tbl_product_offers` WRITE;
/*!40000 ALTER TABLE `tbl_product_offers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_product_offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product_prices`
--

DROP TABLE IF EXISTS `tbl_product_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product_prices` (
  `product_prices_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `original_price` int(7) NOT NULL,
  `discount_price` int(7) NOT NULL DEFAULT '0',
  `size` varchar(4) NOT NULL DEFAULT '0',
  `color` varchar(15) NOT NULL DEFAULT '0',
  `stock` int(4) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`product_prices_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product_prices`
--

LOCK TABLES `tbl_product_prices` WRITE;
/*!40000 ALTER TABLE `tbl_product_prices` DISABLE KEYS */;
INSERT INTO `tbl_product_prices` VALUES (1,1,0,0,'XL','0',2,'2015-06-19 07:47:17','0000-00-00 00:00:00'),(2,1,0,0,'L','0',3,'2015-06-19 07:47:17','0000-00-00 00:00:00'),(3,2,0,0,'XXL','0',10,'2015-06-19 07:47:18','0000-00-00 00:00:00'),(4,2,0,0,'10','0',5,'2015-06-19 07:47:18','0000-00-00 00:00:00'),(5,3,0,0,'S','0',7,'2015-06-19 07:47:18','0000-00-00 00:00:00'),(6,3,0,0,'L','0',4,'2015-06-19 07:47:18','0000-00-00 00:00:00'),(7,3,0,0,'XXL','0',3,'2015-06-19 07:47:18','0000-00-00 00:00:00'),(8,4,0,0,'10','0',5,'2015-06-19 07:47:18','0000-00-00 00:00:00'),(9,4,0,0,'12','0',6,'2015-06-19 07:47:18','0000-00-00 00:00:00'),(10,5,0,0,'XL','0',2,'2015-06-19 07:47:18','0000-00-00 00:00:00'),(11,5,0,0,'L','0',3,'2015-06-19 07:47:18','0000-00-00 00:00:00'),(12,6,0,0,'S','0',2,'2015-06-19 07:47:19','0000-00-00 00:00:00'),(13,6,0,0,'XXL','0',2,'2015-06-19 07:47:19','0000-00-00 00:00:00'),(14,7,0,0,'XL','0',10,'2015-06-19 07:47:19','0000-00-00 00:00:00'),(15,7,0,0,'L','0',5,'2015-06-19 07:47:19','0000-00-00 00:00:00'),(16,7,0,0,'XXL','0',5,'2015-06-19 07:47:19','0000-00-00 00:00:00'),(17,8,0,0,'S','0',4,'2015-06-19 07:47:20','0000-00-00 00:00:00'),(18,8,0,0,'XXL','0',5,'2015-06-19 07:47:20','0000-00-00 00:00:00'),(19,9,0,0,'XXL','0',9,'2015-06-19 07:47:20','0000-00-00 00:00:00'),(20,9,0,0,'L','0',9,'2015-06-19 07:47:20','0000-00-00 00:00:00'),(21,10,0,0,'XL','0',2,'2015-06-19 07:47:20','0000-00-00 00:00:00'),(22,10,0,0,'M','0',2,'2015-06-19 07:47:20','0000-00-00 00:00:00'),(23,10,0,0,'S','0',3,'2015-06-19 07:47:20','0000-00-00 00:00:00'),(24,11,0,0,'0','0',20,'2015-07-10 11:34:04','0000-00-00 00:00:00'),(25,12,0,0,'0','0',20,'2015-07-10 11:46:12','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_product_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product_tags`
--

DROP TABLE IF EXISTS `tbl_product_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product_tags` (
  `product_tags_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `tag` varchar(30) NOT NULL COMMENT 'Product tags, used for search purpose, not comma seperated',
  PRIMARY KEY (`product_tags_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product_tags`
--

LOCK TABLES `tbl_product_tags` WRITE;
/*!40000 ALTER TABLE `tbl_product_tags` DISABLE KEYS */;
INSERT INTO `tbl_product_tags` VALUES (1,1,'sm'),(2,1,'tags'),(3,2,'Smartwatch'),(4,2,'Premiumsportswatch'),(5,3,'mohan'),(6,3,'Premiumsportswatch'),(7,4,'Smartwatch'),(8,4,'Premiumsportswatch'),(9,5,'Smartwatch'),(10,5,'Premiumsportswatch'),(11,6,'Smartwatch'),(12,6,'Premiumsportswatch'),(13,7,'Smartwatch'),(14,7,'Premiumsportswatch'),(15,8,'Smartwatch'),(16,8,'Premiumsportswatch'),(17,9,'Smartwatch'),(18,9,'Premiumsportswatch'),(19,10,'Smartwatch'),(20,10,'Premiumsportswatch'),(21,11,'ksjfdksf'),(22,11,'sfsdf'),(23,12,'sdklsjf');
/*!40000 ALTER TABLE `tbl_product_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` text,
  `reference_number` varchar(50) NOT NULL COMMENT 'Unique code assigned to each product',
  `main_image` varchar(30) NOT NULL COMMENT 'relative path of the main image of the product',
  `is_inventory` int(1) NOT NULL DEFAULT '0',
  `is_featured` int(1) NOT NULL DEFAULT '0',
  `is_purchasable` int(1) NOT NULL DEFAULT '1' COMMENT '1=> Product is purchasable;0=>Not Purchasable',
  `page_title` varchar(30) NOT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `short_description` varchar(255) DEFAULT NULL,
  `discount_price` int(7) NOT NULL,
  `price` int(8) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `stamp` int(1) DEFAULT NULL,
  `additional_info` varchar(255) DEFAULT NULL,
  `specs` varchar(255) DEFAULT NULL,
  `specifications` varchar(255) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_products`
--

LOCK TABLES `tbl_products` WRITE;
/*!40000 ALTER TABLE `tbl_products` DISABLE KEYS */;
INSERT INTO `tbl_products` VALUES (1,16,'Elementum Aqua N/Steel','<p>description</p>\n','SS014527000','regetta_01.jpg',0,0,0,'Sunnto watch','Sunnto watch','Sunnto watch','product1',1,'2015-06-19 07:47:17','0000-00-00 00:00:00','Suunto Elementum Aqua Steel - Premium Sports Watch For Urban And Underwater Use',0,79950,NULL,'https://www.youtube.com/embed/1NJWh5ex7ew',0,'<p>additional info</p>','[]',NULL,'null'),(2,17,'Elementum Aqua N/Black Rubber','<p>description</p>\n','SS014528000','regetta_03.jpg',0,0,0,'Sunnto watch','Sunnto watch','Sunnto watch','product2',1,'2015-06-19 07:47:17','0000-00-00 00:00:00','Suunto Elementum Aqua Black Rubber / Dark Display - Premium Sports Watch For Urban And Underwater Use',0,62950,NULL,'https://www.youtube.com/embed/1NJWh5ex7ew',0,'<p>additional info</p>','[]',NULL,'null'),(3,16,'Elementum Terra N/Steel','Suunto Elementum Terra is a superbly crafted timepiece, exclusively manufactured in Finland. This urban inspired premium watch combines a heritage in craftsmanship with precision digital technology. While the Terra is perfect for urban use, it also measures altitude and weather trends and includes a unique 3D compass for adventures in the great outdoors. Designed with stainless steel casing and a sapphire crystal glass to withstand the elements.','SS014521000','regetta_05.jpg',1,0,1,'Sunnto watch','Sunnto watch','Sunnto watch','product3',1,'2015-06-19 07:47:18','0000-00-00 00:00:00','Suunto Elementum Terra N/Steel - Premium Sports Watch For Urban And Mountain Life',0,79950,NULL,'https://www.youtube.com/embed/1NJWh5ex7ew',2,'0',NULL,NULL,'null'),(4,17,'Elementum Terra N/ Black/Red Leather','Suunto Elementum Terra is a superbly crafted timepiece, exclusively manufactured in Finland. This urban inspired premium watch combines a heritage in craftsmanship with precision digital technology. While the Terra is perfect for urban use, it also measures altitude and weather trends and includes a unique 3D compass for adventures in the great outdoors. Designed with stainless steel casing and a sapphire crystal glass to withstand the elements.','SS019171000','regetta_07.jpg',1,0,1,'Sunnto watch','Sunnto watch','Sunnto watch','product4',1,'2015-06-19 07:47:18','0000-00-00 00:00:00','Suunto Elementum Terra Black/Red Leather - Premium Sports Watch For Urban And Mountain Life',0,65950,NULL,'0',0,'0',NULL,NULL,'null'),(5,16,'Elementum Terra N/ Black/Yellow Leather','Suunto Elementum Terra is a superbly crafted timepiece, exclusively manufactured in Finland. This urban inspired premium watch combines a heritage in craftsmanship with precision digital technology. While the Terra is perfect for urban use, it also measures altitude and weather trends and includes a unique 3D compass for adventures in the great outdoors. Designed with stainless steel casing and a sapphire crystal glass to withstand the elements.','SS019997000','regetta_09.jpg',1,0,1,'Sunnto watch','Sunnto watch','Sunnto watch','product5',1,'2015-06-19 07:47:18','0000-00-00 00:00:00','Suunto Elementum Terra Black/Yellow Leather - Premium Sports Watch For Urban And Mountain Life',0,65950,NULL,'https://www.youtube.com/embed/1NJWh5ex7ew',0,'0',NULL,NULL,'null'),(6,17,'Elementum Terra All Black N/Black','Suunto Elementum Terra is a superbly crafted timepiece, exclusively manufactured in Finland. This urban inspired premium watch combines a heritage in craftsmanship with precision digital technology. While the Terra is perfect for urban use, it also measures altitude and weather trends and includes a unique 3D compass for adventures in the great outdoors. Designed with stainless steel casing and a sapphire crystal glass to withstand the elements.','SS016979000','regetta_01.jpg',1,0,1,'Sunnto watch','Sunnto watch','Sunnto watch','product6',1,'2015-06-19 07:47:19','0000-00-00 00:00:00','Suunto Elementum Terra All Black - Premium Sports Watch For Urban And Mountain Life',0,64950,NULL,'https://www.youtube.com/embed/1NJWh5ex7ew',0,'0',NULL,NULL,'null'),(7,16,'Elementum Terra P/Black Rubber','Suunto Elementum Terra is a superbly crafted timepiece, exclusively manufactured in Finland. This urban inspired premium watch combines a heritage in craftsmanship with precision digital technology. While the Terra is perfect for urban use, it also measures altitude and weather trends and includes a unique 3D compass for adventures in the great outdoors. Designed with stainless steel casing and a sapphire crystal glass to withstand the elements.','SS018732000','regetta_03.jpg',1,0,1,'Sunnto watch','Sunnto watch','Sunnto watch','product7',1,'2015-06-19 07:47:19','0000-00-00 00:00:00','Suunto Elementum Terra P/Black Rubber - Premium Sports Watch For Urban And Mountain Life',0,64950,NULL,'https://www.youtube.com/embed/1NJWh5ex7ew',1,'0',NULL,NULL,'null'),(8,18,'Elementum Terra N/Stealth Rubber','Suunto Elementum Terra is a superbly crafted timepiece, exclusively manufactured in Finland. This urban inspired premium watch combines a heritage in craftsmanship with precision digital technology. While the Terra is perfect for urban use, it also measures altitude and weather trends and includes a unique 3D compass for adventures in the great outdoors. Designed with stainless steel casing and a sapphire crystal glass to withstand the elements.','SS020336000','regetta_05.jpg',1,0,1,'Sunnto watch','Sunnto watch','Sunnto watch','product8',1,'2015-06-19 07:47:19','0000-00-00 00:00:00','Suunto Elementum Terra N/Stealth Rubber - Premium Sports Watch For Urban And Mountain Life',0,69950,NULL,'0',2,'0',NULL,NULL,'null'),(9,16,'Elementum Terra N/Amber Rubber','<p>description</p>\n','SS019172000','regetta_07.jpg',0,0,0,'Sunnto watch','Sunnto watch','Sunnto watch','product9',1,'2015-06-19 07:47:20','0000-00-00 00:00:00','Suunto Elementum Terra N/Amber Rubber - Premium Sports Watch For Urban And Mountain Life',0,64950,NULL,'0',0,'<p>additional info</p>','[]',NULL,'null'),(10,17,'Elementum Terra N/Brown Leather','<p>description</p>\n','SS018733000','regetta_09.jpg',0,0,0,'Sunnto watch','Sunnto watch','Sunnto watch','product10',0,'2015-06-19 07:47:20','0000-00-00 00:00:00','Suunto Elementum Terra N/Brown Leather - Premium Sports Watch For Urban And Mountain Life',0,64950,NULL,'0',0,'<p>additional info</p>','[]',NULL,'null'),(11,17,'dkffkjfh','<p>description</p>\n','dkjfhsdkjgh','559fadac50c39.png',1,0,1,'dkffkjfh','dkffkjfh','dkffkjfh','dkffkjfh',0,'2015-07-10 11:34:04','0000-00-00 00:00:00','sdjksdhf',0,2000,NULL,'',0,'<p>additional info</p>','{\"asd\":\"sdd\"}',NULL,NULL),(12,16,'ksaddkajfhjshfkj','<p>description</p>\n','kjshkjfdhsdkjf','559fb084b0f46.png',1,0,1,'ksaddkajfhjshfkj','ksaddkajfhjshfkj','ksaddkajfhjshfkj','ksaddkajfhjshfkj',0,'2015-07-10 11:46:12','0000-00-00 00:00:00','sdkjfhskjfh',0,1000,NULL,'',0,'<p>additional info</p>','',NULL,NULL);
/*!40000 ALTER TABLE `tbl_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_publicationiamges`
--

DROP TABLE IF EXISTS `tbl_publicationiamges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_publicationiamges` (
  `publicationimage_id` int(10) NOT NULL AUTO_INCREMENT,
  `publication_id` int(10) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  PRIMARY KEY (`publicationimage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_publicationiamges`
--

LOCK TABLES `tbl_publicationiamges` WRITE;
/*!40000 ALTER TABLE `tbl_publicationiamges` DISABLE KEYS */;
INSERT INTO `tbl_publicationiamges` VALUES (1,1,'1w.jpg'),(2,1,'2.jpg'),(3,1,'3.jpg');
/*!40000 ALTER TABLE `tbl_publicationiamges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_publications`
--

DROP TABLE IF EXISTS `tbl_publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_publications` (
  `publication_id` int(10) NOT NULL AUTO_INCREMENT,
  `publish_date` datetime DEFAULT NULL,
  `publication_name` varchar(255) DEFAULT NULL,
  `main_image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_publications`
--

LOCK TABLES `tbl_publications` WRITE;
/*!40000 ALTER TABLE `tbl_publications` DISABLE KEYS */;
INSERT INTO `tbl_publications` VALUES (1,'2015-06-01 00:00:00','Divya Bhaskar','1.png','www.divyabhaskar.co.in','2015-06-03 09:49:49','A&S Creations to open its flagship store at Connaught Place','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.'),(2,'2015-07-15 00:00:00','Divya Bhaskar','2.png','google.com','2015-07-08 09:49:18','Coming in June: Software update for Suunto EON Steel','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.');
/*!40000 ALTER TABLE `tbl_publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_roles` (
  `role_id` int(5) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'Administrator','2015-03-19 07:23:24','2015-03-23 20:04:48'),(2,'HR','2015-03-19 07:39:08','0000-00-00 00:00:00'),(3,'Manager','2015-05-12 06:32:04','2015-05-15 18:38:46'),(4,'Customer','2015-06-12 07:17:41','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_settings`
--

DROP TABLE IF EXISTS `tbl_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_settings` (
  `settings_id` int(10) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(80) NOT NULL,
  `setting_value` text NOT NULL,
  `setting_type` int(1) NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_settings`
--

LOCK TABLES `tbl_settings` WRITE;
/*!40000 ALTER TABLE `tbl_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_shippings`
--

DROP TABLE IF EXISTS `tbl_shippings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_shippings` (
  `shipping_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` text,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `mobilenumber` bigint(12) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`shipping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_shippings`
--

LOCK TABLES `tbl_shippings` WRITE;
/*!40000 ALTER TABLE `tbl_shippings` DISABLE KEYS */;
INSERT INTO `tbl_shippings` VALUES (1,4,NULL,NULL,'A/5, Bhagyodaya society,','Bh. Indraneel society, Vejalpur road, jivrajpark','Ahmedabad','Guajrat','India',380015,NULL,'2015-06-09 06:08:51','0000-00-00 00:00:00'),(2,4,NULL,NULL,'A/5, Bhagyodaya society,','Bh. Indraneel society, Vejalpur road, jivrajpark','Ahmedabad','Guajrat','India',380015,NULL,'2015-06-09 06:10:24','0000-00-00 00:00:00'),(3,6,NULL,NULL,'A/5, Bhagyodaya society,','Bh. Indraneel society, Vejalpur road, jivrajpark','Ahmedabad','Guajrat','India',380015,NULL,'2015-06-09 06:12:02','0000-00-00 00:00:00'),(4,6,NULL,NULL,'A/5, Bhagyodaya society,','Bh. Indraneel society, Vejalpur road, jivrajpark','Ahmedabad','Guajrat','India',380015,NULL,'2015-06-09 06:14:14','0000-00-00 00:00:00'),(5,6,NULL,NULL,'A/5, Bhagyodaya society,','Bh. Indraneel society, Vejalpur road, jivrajpark','Ahmedabad','Guajrat','India',380015,NULL,'2015-06-09 06:14:18','0000-00-00 00:00:00'),(6,6,NULL,NULL,'Gujarat Colony Sarkhej2','india','ahmedabad','Maharashtra','U.S.',380023,NULL,'2015-06-09 06:34:22','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_shippings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sizes`
--

DROP TABLE IF EXISTS `tbl_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sizes` (
  `size_id` int(2) NOT NULL AUTO_INCREMENT,
  `value` varchar(20) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sizes`
--

LOCK TABLES `tbl_sizes` WRITE;
/*!40000 ALTER TABLE `tbl_sizes` DISABLE KEYS */;
INSERT INTO `tbl_sizes` VALUES (3,'L'),(4,'XL'),(5,'XXL'),(16,'44'),(17,'90'),(18,'42'),(19,'20'),(20,'22'),(21,'24'),(22,'26'),(23,'28');
/*!40000 ALTER TABLE `tbl_sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_slideshows`
--

DROP TABLE IF EXISTS `tbl_slideshows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_slideshows` (
  `slideshow_id` int(1) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(30) NOT NULL,
  `image_alt` varchar(20) NOT NULL,
  `link` varchar(30) DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`slideshow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_slideshows`
--

LOCK TABLES `tbl_slideshows` WRITE;
/*!40000 ALTER TABLE `tbl_slideshows` DISABLE KEYS */;
INSERT INTO `tbl_slideshows` VALUES (4,'slider1.jpg','4','http://www.google.com','2015-03-23 06:36:17'),(5,'slider2.jpg','5','0','2015-03-23 06:36:41'),(6,'slider3.jpg','6','http://www.google.com','2015-03-23 06:36:50'),(9,'slider4.jpg','Appointment.png','0','2015-05-18 10:40:53'),(11,'slider5.jpg','1.JPG','http://wwww.google.com','2015-05-18 12:41:55'),(12,'slider6.jpg','Appointment.png','0','2015-05-18 10:40:53');
/*!40000 ALTER TABLE `tbl_slideshows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subscribers`
--

DROP TABLE IF EXISTS `tbl_subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subscribers` (
  `subscriber_id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`subscriber_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subscribers`
--

LOCK TABLES `tbl_subscribers` WRITE;
/*!40000 ALTER TABLE `tbl_subscribers` DISABLE KEYS */;
INSERT INTO `tbl_subscribers` VALUES (1,'viral@bugletech.com','2015-03-04 04:39:38'),(3,'avdhesh@bugletech.com','2015-03-04 04:57:32'),(4,'sagar@bugletech.com','2015-03-04 04:57:36'),(5,'tejas@bugletech.com','2015-03-04 04:57:39'),(6,'umang@bugletech.com','2015-03-04 04:57:47'),(8,'ravi.kamdar@bugletech.com','2015-03-04 04:59:27'),(9,'p@mailinator.com','2015-03-18 11:21:16'),(10,'m@mailinator.com','2015-03-18 11:21:22'),(11,'r@mailinator.com','2015-03-18 11:21:28'),(12,'d@mailinator.com','2015-03-18 11:21:35'),(13,'q@mailinator.com','2015-03-18 11:21:41');
/*!40000 ALTER TABLE `tbl_subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tests`
--

DROP TABLE IF EXISTS `tbl_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tests` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `parent_id` int(2) NOT NULL,
  `lft` int(4) NOT NULL,
  `ryt` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tests`
--

LOCK TABLES `tbl_tests` WRITE;
/*!40000 ALTER TABLE `tbl_tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_teststatus`
--

DROP TABLE IF EXISTS `tbl_teststatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_teststatus` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `parent_id` int(2) NOT NULL,
  `lft` int(4) NOT NULL,
  `ryt` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_teststatus`
--

LOCK TABLES `tbl_teststatus` WRITE;
/*!40000 ALTER TABLE `tbl_teststatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_teststatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `group_id` int(3) NOT NULL,
  `forgetlink` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'viral@bugletech.com',NULL,'cce3546c1c8bdb0081cdab254741f60629d137c4',2,'baadb27af28f1dd3ed37bb349b3f46ad',1,'2015-03-04 06:57:00',0),(2,'avdhesh@bugletech.com',NULL,'c9ae4edfb425bff9aeb4740eb89b91a33071ced8',2,NULL,1,'2015-03-04 06:58:40',0),(3,'tejas@bugletech.com',NULL,'c9ae4edfb425bff9aeb4740eb89b91a33071ced8',2,NULL,1,'2015-03-04 07:01:23',4),(4,'yoo@bugletech.com ',NULL,'c44539d0a860f889eeedfa359de2050863b75d4b',2,'0',0,'2015-03-05 07:18:12',4),(5,'admin@admin.com',NULL,'c9ae4edfb425bff9aeb4740eb89b91a33071ced8',1,NULL,1,'2015-03-17 13:36:54',1),(6,'avdhesh@bugletech.com','Avdhesh','c9ae4edfb425bff9aeb4740eb89b91a33071ced8',0,NULL,1,'2015-05-15 22:23:07',4),(7,'viral@bugletech.com','Viral','c9ae4edfb425bff9aeb4740eb89b91a33071ced8',0,'baadb27af28f1dd3ed37bb349b3f46ad',1,'2015-05-15 22:23:43',4);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-10 17:12:33
