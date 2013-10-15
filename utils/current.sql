-- MySQL dump 10.14  Distrib 5.5.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: debb
-- ------------------------------------------------------
-- Server version	5.5.29-MariaDB-mariadb1~precise-log

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
-- Table structure for table `baseboard`
--

DROP TABLE IF EXISTS `baseboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baseboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_931095ACA76ED395` (`user_id`),
  KEY `IDX_931095ACFADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_931095ACA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_931095ACFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baseboard`
--

LOCK TABLES `baseboard` WRITE;
/*!40000 ALTER TABLE `baseboard` DISABLE KEYS */;
INSERT INTO `baseboard` VALUES (1,NULL,NULL,NULL,'Congatec','conga-BAF',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,'Congatec','conga-BM45',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,'Congatec','conga-CCA',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,'Intel','Desktop Board',NULL,'DB75EN',NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,'Intel','Desktop Board',NULL,'DQ77CP',NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,'Intel','Desktop Board',NULL,'DQ77MK',NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,'Kontron','COMe-bSC',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL),(8,NULL,NULL,NULL,'Toradex','Woodpecker',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `baseboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `box`
--

DROP TABLE IF EXISTS `box`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `slots` int(11) NOT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `mesh_resolution` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_in_mesh` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8A9483AA76ED395` (`user_id`),
  KEY `IDX_8A9483AFADE768C` (`powerUsageProfile_id`),
  KEY `IDX_8A9483A3DA5256D` (`image_id`),
  CONSTRAINT `FK_8A9483A3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `file` (`id`),
  CONSTRAINT `FK_8A9483AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_8A9483AFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `box`
--

LOCK TABLES `box` WRITE;
/*!40000 ALTER TABLE `box` DISABLE KEYS */;
/*!40000 ALTER TABLE `box` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chassis`
--

DROP TABLE IF EXISTS `chassis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chassis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `he_size` int(11) NOT NULL,
  `frontview` tinyint(1) DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `mesh_resolution` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_in_mesh` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_35C973DFA76ED395` (`user_id`),
  KEY `IDX_35C973DFFADE768C` (`powerUsageProfile_id`),
  KEY `IDX_35C973DF3DA5256D` (`image_id`),
  CONSTRAINT `FK_35C973DF3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `file` (`id`),
  CONSTRAINT `FK_35C973DFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_35C973DFFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chassis`
--

LOCK TABLES `chassis` WRITE;
/*!40000 ALTER TABLE `chassis` DISABLE KEYS */;
INSERT INTO `chassis` VALUES (1,NULL,1,NULL,NULL,'Christmann','RECS | Box Compute Unit',NULL,'v2.0 (Sirius) Case A',NULL,NULL,420,1090,0,0,0,0,0,0,0,1,0,NULL,NULL,NULL,NULL),(2,NULL,2,NULL,NULL,'Christmann','RECS | Box Power Unit',NULL,'v2.0 (Sirius)',NULL,NULL,449.88333,409.88333,0,0,0,0,0,0,0,6,1,NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,NULL,'Test','ChassisWithInletAndOutlet',NULL,NULL,NULL,NULL,180,120,0,0,0,0,0,0,0,1,0,NULL,NULL,NULL,'test');
/*!40000 ALTER TABLE `chassis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chassis_file`
--

DROP TABLE IF EXISTS `chassis_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chassis_file` (
  `chassis_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`chassis_id`,`file_id`),
  KEY `IDX_9FDACE8863EE729` (`chassis_id`),
  KEY `IDX_9FDACE8893CB796C` (`file_id`),
  CONSTRAINT `FK_9FDACE8893CB796C` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9FDACE8863EE729` FOREIGN KEY (`chassis_id`) REFERENCES `chassis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chassis_file`
--

LOCK TABLES `chassis_file` WRITE;
/*!40000 ALTER TABLE `chassis_file` DISABLE KEYS */;
INSERT INTO `chassis_file` VALUES (1,73),(1,74),(1,77),(1,78),(2,62),(2,63);
/*!40000 ALTER TABLE `chassis_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chassis_typ_specification`
--

DROP TABLE IF EXISTS `chassis_typ_specification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chassis_typ_specification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chassis_id` int(11) DEFAULT NULL,
  `field` int(11) DEFAULT NULL,
  `posx` int(11) NOT NULL,
  `posy` int(11) NOT NULL,
  `posz` double DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  `typ` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CDAF1B1563EE729` (`chassis_id`),
  CONSTRAINT `FK_CDAF1B1563EE729` FOREIGN KEY (`chassis_id`) REFERENCES `chassis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chassis_typ_specification`
--

LOCK TABLES `chassis_typ_specification` WRITE;
/*!40000 ALTER TABLE `chassis_typ_specification` DISABLE KEYS */;
INSERT INTO `chassis_typ_specification` VALUES (1,1,NULL,70,70,NULL,180,'CXP2'),(2,1,NULL,69,470,NULL,180,'CXP2'),(3,1,NULL,69,771,NULL,180,'CXP2'),(4,1,NULL,69,670,NULL,180,'CXP2'),(5,1,NULL,69,570,NULL,180,'CXP2'),(6,1,NULL,70,370,NULL,180,'CXP2'),(11,1,NULL,70,169,NULL,180,'CXP2'),(12,1,NULL,70,870,NULL,180,'CXP2'),(13,1,NULL,259,80,NULL,0,'CXP2'),(14,1,NULL,260,880,NULL,0,'CXP2'),(15,1,NULL,259,780,NULL,0,'CXP2'),(16,1,NULL,259,680,NULL,0,'CXP2'),(17,1,NULL,260,580,NULL,0,'CXP2'),(18,1,NULL,260,480,NULL,0,'CXP2'),(19,1,NULL,260,380,NULL,0,'CXP2'),(21,2,NULL,30,230,NULL,NULL,'PS'),(22,2,NULL,100,230,NULL,NULL,'PS'),(23,2,NULL,170,230,NULL,NULL,'PS'),(24,2,NULL,240,230,NULL,NULL,'PS'),(25,2,NULL,310,230,NULL,NULL,'PS'),(26,1,NULL,260,280,NULL,0,'CXP2'),(27,1,NULL,260,180,NULL,0,'CXP2'),(29,1,NULL,69,269,NULL,180,'CXP2'),(35,7,NULL,40,10,NULL,NULL,'CXP2');
/*!40000 ALTER TABLE `chassis_typ_specification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `component`
--

DROP TABLE IF EXISTS `component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_id` int(11) DEFAULT NULL,
  `processor_id` int(11) DEFAULT NULL,
  `baseboard_id` int(11) DEFAULT NULL,
  `coolingdevice_id` int(11) DEFAULT NULL,
  `memory_id` int(11) DEFAULT NULL,
  `powersupply_id` int(11) DEFAULT NULL,
  `heatsink_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_49FEA157460D9FD7` (`node_id`),
  KEY `IDX_49FEA15737BAC19A` (`processor_id`),
  KEY `IDX_49FEA157A7A20F9C` (`baseboard_id`),
  KEY `IDX_49FEA157524B8BF0` (`coolingdevice_id`),
  KEY `IDX_49FEA157CCC80CB3` (`memory_id`),
  KEY `IDX_49FEA157889B163B` (`powersupply_id`),
  KEY `IDX_49FEA15774023200` (`heatsink_id`),
  CONSTRAINT `FK_49FEA15737BAC19A` FOREIGN KEY (`processor_id`) REFERENCES `processor` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_49FEA157460D9FD7` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`),
  CONSTRAINT `FK_49FEA157524B8BF0` FOREIGN KEY (`coolingdevice_id`) REFERENCES `coolingdevice` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_49FEA15774023200` FOREIGN KEY (`heatsink_id`) REFERENCES `heatsink` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_49FEA157889B163B` FOREIGN KEY (`powersupply_id`) REFERENCES `powersupply` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_49FEA157A7A20F9C` FOREIGN KEY (`baseboard_id`) REFERENCES `baseboard` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_49FEA157CCC80CB3` FOREIGN KEY (`memory_id`) REFERENCES `memory` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component`
--

LOCK TABLES `component` WRITE;
/*!40000 ALTER TABLE `component` DISABLE KEYS */;
INSERT INTO `component` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,2,0),(2,1,NULL,NULL,NULL,NULL,NULL,NULL,4,0),(3,1,NULL,NULL,NULL,NULL,NULL,NULL,6,0),(4,1,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(5,1,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(6,1,NULL,NULL,NULL,NULL,1,NULL,5,1),(7,2,1,NULL,NULL,NULL,NULL,NULL,2,1),(8,2,NULL,NULL,NULL,2,NULL,NULL,4,1),(11,2,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(12,2,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(13,3,2,NULL,NULL,NULL,NULL,NULL,2,1),(14,3,NULL,NULL,NULL,2,NULL,NULL,4,1),(17,3,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(18,3,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(19,4,7,NULL,NULL,NULL,NULL,NULL,2,1),(20,4,NULL,NULL,NULL,1,NULL,NULL,4,2),(25,5,4,NULL,NULL,NULL,NULL,NULL,2,1),(26,5,NULL,NULL,NULL,1,NULL,NULL,4,1),(29,5,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(30,5,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(31,6,9,NULL,NULL,NULL,NULL,NULL,2,1),(32,6,NULL,NULL,NULL,2,NULL,NULL,4,2),(35,6,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(36,6,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(37,7,8,NULL,NULL,NULL,NULL,NULL,2,1),(38,7,NULL,NULL,NULL,3,NULL,NULL,4,2),(41,7,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(42,7,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(43,8,5,NULL,NULL,NULL,NULL,NULL,2,1),(44,8,NULL,NULL,NULL,2,NULL,NULL,4,1),(45,8,NULL,NULL,NULL,NULL,NULL,NULL,6,0),(46,8,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(47,8,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(48,8,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(49,9,6,NULL,NULL,NULL,NULL,NULL,2,1),(50,9,NULL,NULL,NULL,1,NULL,NULL,4,1),(53,9,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(54,9,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(79,14,3,NULL,NULL,NULL,NULL,NULL,2,1),(80,14,NULL,NULL,NULL,1,NULL,NULL,4,1),(83,14,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(84,14,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(85,6,NULL,NULL,NULL,NULL,NULL,14,6,1),(86,6,NULL,7,NULL,NULL,NULL,NULL,1,1),(87,7,NULL,NULL,NULL,NULL,NULL,14,6,1),(88,7,NULL,7,NULL,NULL,NULL,NULL,1,1),(89,5,NULL,NULL,NULL,NULL,NULL,15,6,1),(90,5,NULL,3,NULL,NULL,NULL,NULL,1,1),(91,14,NULL,NULL,NULL,NULL,NULL,15,6,1),(92,14,NULL,3,NULL,NULL,NULL,NULL,1,1),(93,4,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(94,4,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(95,4,NULL,NULL,NULL,NULL,NULL,2,6,1),(96,4,NULL,2,NULL,NULL,NULL,NULL,1,1),(97,2,NULL,NULL,NULL,NULL,NULL,4,6,1),(98,2,NULL,1,NULL,NULL,NULL,NULL,1,1),(99,3,NULL,NULL,NULL,NULL,NULL,4,6,1),(100,3,NULL,1,NULL,NULL,NULL,NULL,1,1),(101,9,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(102,9,NULL,NULL,NULL,NULL,NULL,NULL,6,0);
/*!40000 ALTER TABLE `component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cooling_eer`
--

DROP TABLE IF EXISTS `cooling_eer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cooling_eer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `LWT` double NOT NULL,
  `CWT` double NOT NULL,
  `Capacity` int(11) NOT NULL,
  `PowerUsage` int(11) NOT NULL,
  `EER` double NOT NULL,
  `coolingDevice_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FAF2B025A76ED395` (`user_id`),
  KEY `IDX_FAF2B025D0BA0953` (`coolingDevice_id`),
  CONSTRAINT `FK_FAF2B025A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_FAF2B025D0BA0953` FOREIGN KEY (`coolingDevice_id`) REFERENCES `coolingdevice` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cooling_eer`
--

LOCK TABLES `cooling_eer` WRITE;
/*!40000 ALTER TABLE `cooling_eer` DISABLE KEYS */;
INSERT INTO `cooling_eer` VALUES (3,NULL,5,25,769000,211200,3.64,20),(4,NULL,7,25,814000,219400,3.71,20),(5,NULL,10,25,886000,232700,3.81,20),(6,NULL,15,25,1013000,257800,3.93,20),(7,NULL,5,30,741000,230000,3.22,20),(8,NULL,7,30,785000,238600,3.29,20),(9,NULL,10,30,853000,252700,3.38,20),(10,NULL,15,30,974000,279300,3.49,20),(11,NULL,12,30,5000,1667,3,23);
/*!40000 ALTER TABLE `cooling_eer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coolingdevice`
--

DROP TABLE IF EXISTS `coolingdevice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coolingdevice` (
  `id` int(11) NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MaxCoolingCapacity` decimal(10,0) DEFAULT NULL,
  `MaxAirThroughput` decimal(10,0) DEFAULT NULL,
  `MaxWaterThroughput` decimal(10,0) DEFAULT NULL,
  `airThroughputProfile_id` int(11) DEFAULT NULL,
  `waterThroughputProfile_id` int(11) DEFAULT NULL,
  `CoolingCapacityRated` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2D21655BA525C861` (`airThroughputProfile_id`),
  KEY `IDX_2D21655B859EF5AA` (`waterThroughputProfile_id`),
  CONSTRAINT `FK_2D21655B859EF5AA` FOREIGN KEY (`waterThroughputProfile_id`) REFERENCES `flow_profile` (`id`),
  CONSTRAINT `FK_2D21655BA525C861` FOREIGN KEY (`airThroughputProfile_id`) REFERENCES `flow_profile` (`id`),
  CONSTRAINT `FK_2D21655BBF396750` FOREIGN KEY (`id`) REFERENCES `debb_simple` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coolingdevice`
--

LOCK TABLES `coolingdevice` WRITE;
/*!40000 ALTER TABLE `coolingdevice` DISABLE KEYS */;
INSERT INTO `coolingdevice` VALUES (20,'Refrigeration',1013000,NULL,NULL,NULL,NULL,900000),(23,'Refrigeration',5000,NULL,NULL,NULL,NULL,5000);
/*!40000 ALTER TABLE `coolingdevice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cstate`
--

DROP TABLE IF EXISTS `cstate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cstate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `processor_id` int(11) DEFAULT NULL,
  `power_usage` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A13F9B137BAC19A` (`processor_id`),
  CONSTRAINT `FK_5A13F9B137BAC19A` FOREIGN KEY (`processor_id`) REFERENCES `processor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cstate`
--

LOCK TABLES `cstate` WRITE;
/*!40000 ALTER TABLE `cstate` DISABLE KEYS */;
INSERT INTO `cstate` VALUES (7,9,13),(8,8,11),(9,4,11),(10,3,11),(11,1,11);
/*!40000 ALTER TABLE `cstate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debb_simple`
--

DROP TABLE IF EXISTS `debb_simple`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debb_simple` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `transform` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `typ` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `mesh_resolution` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_in_mesh` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F93B9079A76ED395` (`user_id`),
  KEY `IDX_F93B9079FADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_F93B9079A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F93B9079FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debb_simple`
--

LOCK TABLES `debb_simple` WRITE;
/*!40000 ALTER TABLE `debb_simple` DISABLE KEYS */;
INSERT INTO `debb_simple` VALUES (1,NULL,NULL,NULL,'Congatec','COM Express Heatsink',NULL,'COM Express Heatsink',NULL,NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,'Congatec','COM Express Heatspreader Heatsink BM45',NULL,'conga-BM45/HSP-HP-T',NULL,NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,'Congatec','COM Express Heatspreader Heatsink',NULL,'conga-TCA/HSP-T',NULL,NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,'Congatec','COM Express Passive Heatsink BAF',NULL,'conga-BAF/CSP-T',NULL,NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,'Congatec','COM Express Passive Heatsink',NULL,'conga-TCA/CSP-T',NULL,NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,'Kontron','COM Express Passive',NULL,'Heatpipe',NULL,NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,'Scythe','KATANA',NULL,'3 SCKTN-3000A',NULL,NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,NULL,NULL,'Toradex','Woodpacker Passive Heatspreader',NULL,NULL,NULL,NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,NULL,NULL,'40x40x28 FAN','AVC','DB04028B12U',NULL,'40x40x28mm Fan 13000RPM',7.92,6.6,NULL,2,'flowpump',0.04,0.028,0.04,0,0,0,0,0,0,NULL,NULL,'Outlet_'),(10,NULL,NULL,NULL,'Air Inlet Raised Floor','60x60cm',NULL,NULL,NULL,NULL,NULL,NULL,'flowpump',0.6,0.02,0.6,0,0,0,0,0,0,NULL,NULL,NULL),(11,NULL,NULL,NULL,'Air Outlet Raised Floor','60x60cm',NULL,NULL,NULL,NULL,NULL,NULL,'flowpump',0.6,0.02,0.6,0,0,0,0,0,0,NULL,NULL,NULL),(14,NULL,NULL,NULL,'Kontron','COM Express Passive Heatsink i7',NULL,'Heatsink',NULL,NULL,NULL,NULL,'heatsink',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL),(15,NULL,NULL,NULL,'Congatec','COM Express Heatspreader Atom',NULL,'Heatspreader for Intel Atom',NULL,NULL,NULL,NULL,'heatsink',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL),(16,NULL,NULL,'40x40x28 FAN','AVC','DB04028B12U',NULL,'40x40x28mm Fan 13000RPM',7.92,6.6,NULL,2,'flowpump',0.04,0.028,0.04,0,0,0,0,0,0,NULL,NULL,'Inlet_'),(20,NULL,NULL,'30XA-802 (screw compressor, air-cooled)','Christmann','Cooler',NULL,NULL,NULL,NULL,NULL,NULL,'coolingdevice',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL),(22,NULL,NULL,NULL,'lsiso-fannode',NULL,NULL,NULL,6,6,NULL,NULL,'flowpump',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL),(23,NULL,NULL,NULL,'lsiso-chiller','Testbed 5 kW',NULL,NULL,NULL,NULL,NULL,NULL,'coolingdevice',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL),(24,NULL,NULL,NULL,'lsiso-fanCRAH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'flowpump',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `debb_simple` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debbcomplex`
--

DROP TABLE IF EXISTS `debbcomplex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debbcomplex` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_12E739B9BF396750` FOREIGN KEY (`id`) REFERENCES `debb_simple` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debbcomplex`
--

LOCK TABLES `debbcomplex` WRITE;
/*!40000 ALTER TABLE `debbcomplex` DISABLE KEYS */;
INSERT INTO `debbcomplex` VALUES (20),(23);
/*!40000 ALTER TABLE `debbcomplex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debbcomplex_heatsink`
--

DROP TABLE IF EXISTS `debbcomplex_heatsink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debbcomplex_heatsink` (
  `debbcomplex` int(11) NOT NULL,
  `heatsink` int(11) NOT NULL,
  PRIMARY KEY (`debbcomplex`,`heatsink`),
  KEY `IDX_B756DC0812E739B9` (`debbcomplex`),
  KEY `IDX_B756DC086FCA9CF1` (`heatsink`),
  CONSTRAINT `FK_B756DC0812E739B9` FOREIGN KEY (`debbcomplex`) REFERENCES `debbcomplex` (`id`),
  CONSTRAINT `FK_B756DC086FCA9CF1` FOREIGN KEY (`heatsink`) REFERENCES `heatsink` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debbcomplex_heatsink`
--

LOCK TABLES `debbcomplex_heatsink` WRITE;
/*!40000 ALTER TABLE `debbcomplex_heatsink` DISABLE KEYS */;
/*!40000 ALTER TABLE `debbcomplex_heatsink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debbcomplex_inlet`
--

DROP TABLE IF EXISTS `debbcomplex_inlet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debbcomplex_inlet` (
  `debbcomplex` int(11) NOT NULL,
  `inlet` int(11) NOT NULL,
  PRIMARY KEY (`debbcomplex`,`inlet`),
  KEY `IDX_C81000DB12E739B9` (`debbcomplex`),
  KEY `IDX_C81000DB87D67A92` (`inlet`),
  CONSTRAINT `FK_C81000DB12E739B9` FOREIGN KEY (`debbcomplex`) REFERENCES `debbcomplex` (`id`),
  CONSTRAINT `FK_C81000DB87D67A92` FOREIGN KEY (`inlet`) REFERENCES `flow_pump` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debbcomplex_inlet`
--

LOCK TABLES `debbcomplex_inlet` WRITE;
/*!40000 ALTER TABLE `debbcomplex_inlet` DISABLE KEYS */;
/*!40000 ALTER TABLE `debbcomplex_inlet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debbcomplex_network`
--

DROP TABLE IF EXISTS `debbcomplex_network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debbcomplex_network` (
  `debbcomplex` int(11) NOT NULL,
  `network` int(11) NOT NULL,
  PRIMARY KEY (`debbcomplex`,`network`),
  KEY `IDX_F1EFA41412E739B9` (`debbcomplex`),
  KEY `IDX_F1EFA414608487BC` (`network`),
  CONSTRAINT `FK_F1EFA41412E739B9` FOREIGN KEY (`debbcomplex`) REFERENCES `debbcomplex` (`id`),
  CONSTRAINT `FK_F1EFA414608487BC` FOREIGN KEY (`network`) REFERENCES `network` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debbcomplex_network`
--

LOCK TABLES `debbcomplex_network` WRITE;
/*!40000 ALTER TABLE `debbcomplex_network` DISABLE KEYS */;
/*!40000 ALTER TABLE `debbcomplex_network` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debbcomplex_outlet`
--

DROP TABLE IF EXISTS `debbcomplex_outlet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debbcomplex_outlet` (
  `debbcomplex` int(11) NOT NULL,
  `outlet` int(11) NOT NULL,
  PRIMARY KEY (`debbcomplex`,`outlet`),
  KEY `IDX_9C6F639512E739B9` (`debbcomplex`),
  KEY `IDX_9C6F639593205CDB` (`outlet`),
  CONSTRAINT `FK_9C6F639512E739B9` FOREIGN KEY (`debbcomplex`) REFERENCES `debbcomplex` (`id`),
  CONSTRAINT `FK_9C6F639593205CDB` FOREIGN KEY (`outlet`) REFERENCES `flow_pump` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debbcomplex_outlet`
--

LOCK TABLES `debbcomplex_outlet` WRITE;
/*!40000 ALTER TABLE `debbcomplex_outlet` DISABLE KEYS */;
/*!40000 ALTER TABLE `debbcomplex_outlet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debbcomplex_sensor`
--

DROP TABLE IF EXISTS `debbcomplex_sensor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debbcomplex_sensor` (
  `debbcomplex` int(11) NOT NULL,
  `sensor` int(11) NOT NULL,
  PRIMARY KEY (`debbcomplex`,`sensor`),
  KEY `IDX_B3C928FE12E739B9` (`debbcomplex`),
  KEY `IDX_B3C928FEBC8617B0` (`sensor`),
  CONSTRAINT `FK_B3C928FE12E739B9` FOREIGN KEY (`debbcomplex`) REFERENCES `debbcomplex` (`id`),
  CONSTRAINT `FK_B3C928FEBC8617B0` FOREIGN KEY (`sensor`) REFERENCES `sensor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debbcomplex_sensor`
--

LOCK TABLES `debbcomplex_sensor` WRITE;
/*!40000 ALTER TABLE `debbcomplex_sensor` DISABLE KEYS */;
/*!40000 ALTER TABLE `debbcomplex_sensor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debbconnector`
--

DROP TABLE IF EXISTS `debbconnector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debbconnector` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `connector_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `con_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avail_space` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_5EE04726BF396750` FOREIGN KEY (`id`) REFERENCES `debb_simple` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debbconnector`
--

LOCK TABLES `debbconnector` WRITE;
/*!40000 ALTER TABLE `debbconnector` DISABLE KEYS */;
/*!40000 ALTER TABLE `debbconnector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debbsimple_file`
--

DROP TABLE IF EXISTS `debbsimple_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `debbsimple_file` (
  `debbsimple_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`debbsimple_id`,`file_id`),
  KEY `IDX_F5D0BAE48296F3DD` (`debbsimple_id`),
  KEY `IDX_F5D0BAE493CB796C` (`file_id`),
  CONSTRAINT `FK_F5D0BAE48296F3DD` FOREIGN KEY (`debbsimple_id`) REFERENCES `debb_simple` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F5D0BAE493CB796C` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debbsimple_file`
--

LOCK TABLES `debbsimple_file` WRITE;
/*!40000 ALTER TABLE `debbsimple_file` DISABLE KEYS */;
INSERT INTO `debbsimple_file` VALUES (2,58),(2,59),(4,81),(4,82),(9,66),(9,67),(14,51),(14,52),(15,53),(15,54),(16,68),(16,69);
/*!40000 ALTER TABLE `debbsimple_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mimeType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (1,'RECS v2.0 (Sirius).png','52317fdabacf3.png','image/png',263109),(2,'RECS v2.0 Netzteil.jpeg','523180e609cb8.jpeg','image/jpeg',483675),(3,'Block RECS v2.0 Netzteil.jpeg','52318b3493cf0.jpeg','image/jpeg',139575),(4,'Sirius_Netzteil_Node.wrl','52318b70412d7.wrl','model/vrml',592),(5,'Sirius_Netzteil_Node.stl','52318b75a2dd4.txt','text/plain',3308),(6,'AMD T40N.jpeg','52318c326786e.jpeg','image/jpeg',67618),(7,'AMD_board_00.stl','52318d6c947b6.txt','text/plain',1171914),(10,'conga-BAF.jpeg','52318e6d07885.jpeg','image/jpeg',67618),(11,'AMD_board_00.wrl','52318eb9235f1.wrl','model/vrml',134950),(12,'AMD_board_00.stl','52318ec786165.txt','text/plain',1171914),(13,'Intel_Core2Duo_00.wrl','5231909dd24c6.wrl','model/vrml',134950),(14,'Intel_Core2Duo_00.stl','523190ab42d53.txt','text/plain',1171914),(15,'conga-BM45-rep.png','523190c241ff2.png','image/png',1576732),(16,'conga-CCA.jpeg','5231917773002.jpeg','image/jpeg',52608),(17,'Intel_Atom_00.wrl','5231919936aa8.wrl','model/vrml',81541),(18,'Intel_Atom_00.stl','523191ac5be64.txt','text/plain',736924),(19,'Intel_I7_00.wrl','52319783cde18.wrl','model/vrml',206633),(20,'Intel_I7_00.stl','5231979bc732d.txt','text/plain',1764788),(21,'COMe-bSC2.jpeg','523197edba0ad.jpeg','image/jpeg',30344),(22,'COMe-bSC2.jpeg','52319846bf7bb.jpeg','image/jpeg',30344),(23,'Intel_I7_00.wrl','5231987991e91.wrl','model/vrml',206633),(24,'Intel_I7_00.stl','5231988ab1442.txt','text/plain',1764788),(25,'conga-BAF.jpeg','523199549733e.jpeg','image/jpeg',67618),(26,'woodpecker-z510.jpg','52319ae52487a.jpeg','image/jpeg',82299),(27,'woodpecker-z530.jpg','52319b724e6f9.jpeg','image/jpeg',81650),(28,'Schrank.wrl','5231aa0f36352.wrl','model/vrml',2091),(29,'Schrank.stl','5231aa16ce996.txt','text/plain',19777),(30,'Sirius_Netzteil.wrl','5232f7ae12bc2.wrl','model/vrml',2778),(31,'Sirius_Netzteil.stl','5232f7b265c31.txt','text/plain',25280),(34,'Schrank_Kuehlung.wrl','523b0d1a999ad.wrl','model/vrml',1083),(35,'Schrank_Kuehlung.stl','523b0d2fdd052.txt','text/plain',8810),(36,'Schrank_2m_hoch.wrl','523b0d6cbb1d5.wrl','model/vrml',2092),(37,'Schrank_2m_hoch.stl','523b0d75cc452.txt','text/plain',19765),(38,'Container.wrl','523b1097642fc.wrl','model/vrml',1004),(39,'Container.stl','523b109c88476.txt','text/plain',6659),(40,'RECS20_Case_A.stl','523bf2239e8a1.txt','text/plain',31241306),(41,'RECS20_Case_A.stl','523bf5a0d5c13.txt','text/plain',31241306),(42,'RECS20_Case_A.stl','523bf5b0de534.txt','text/plain',31241306),(43,'RECS20_Case_A.wrl','523c568c1427b.wrl','model/vrml',3987996),(44,'RECS20_Case_A.wrl','523c56ba3612c.wrl','model/vrml',3987996),(45,'RECS20_Case_A.wrl','523c56c3a20bf.wrl','model/vrml',3987996),(51,'Intel_I7_heatsink_00.wrl','524952b40865c.wrl','model/vrml',64714),(52,'Intel_I7_heatsink_00.stl','524952bd02e54.txt','text/plain',589917),(53,'Intel_Atom_Heatspreader_00.wrl','524953faa0363.wrl','model/vrml',1441),(54,'Intel_Atom_Heatspreader_00.stl','524953ffe641d.txt','text/plain',12124),(55,'Intel_Atom_00.wrl','5249548e44cf5.wrl','model/vrml',81541),(56,'Intel_Atom_00.stl','5249549b1726c.txt','text/plain',736924),(57,'conga-CCA.jpeg','524954c662108.jpeg','image/jpeg',52608),(58,'Intel_Core2Duo_heatsink_00.wrl','52495666c393d.wrl','model/vrml',12857),(59,'Intel_Core2Duo_heatsink_00.stl','5249566a82867.txt','text/plain',121788),(62,'Sirius_Netzteil.wrl','52495a46d949c.wrl','model/vrml',2778),(63,'Sirius_Netzteil.stl','52495a51061ac.txt','text/plain',25280),(66,'Luefter_40x40x28.wrl','524965f5ef6b4.wrl','model/vrml',103048),(67,'Luefter_40x40x28.stl','52496606a972a.txt','text/plain',914168),(68,'Luefter_40x40x28.wrl','524ac836d9be8.wrl','model/vrml',103048),(69,'Luefter_40x40x28.stl','524ac845bca9f.txt','text/plain',914168),(70,'CoolEmAll_Testbed.zip','5253be5ced4a3.zip','application/zip',186),(73,'RECS20_Case_A_cover-closed_fan-open.stl','525546d19f6bb.txt','text/plain',25178822),(74,'RECS20_Case_A_cover-closed_fan-open.wrl','525546ed6bea9.wrl','model/vrml',3352765),(77,'RECS20_Case_A_cover-open_fan-open.stl','525548b6ee5e7.txt','text/plain',25168947),(78,'RECS20_Case_A_cover-open_fan-open.wrl','525548d1bf18d.wrl','model/vrml',3351307),(79,'AMD_board_00.stl','5256c6c1b2641.txt','text/plain',1377915),(80,'AMD_board_00.wrl','5256c6c34a3c5.wrl','model/vrml',159731),(81,'AMD_heatsink_00.stl','5256c7769bec6.txt','text/plain',117378),(82,'AMD_heatsink_00.wrl','5256c776ea433.wrl','model/vrml',12364),(83,'logo-icon.png','5257f4517aa46.png','image/png',1540);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flow_profile`
--

DROP TABLE IF EXISTS `flow_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flow_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C2676E82A76ED395` (`user_id`),
  CONSTRAINT `FK_C2676E82A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flow_profile`
--

LOCK TABLES `flow_profile` WRITE;
/*!40000 ALTER TABLE `flow_profile` DISABLE KEYS */;
INSERT INTO `flow_profile` VALUES (2,NULL,'AVC DB04028B12U Flow'),(5,NULL,'Christmann Cooler Air'),(6,NULL,'Christmann Cooler Water'),(7,NULL,'Christmann Cooler Power');
/*!40000 ALTER TABLE `flow_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flow_pump`
--

DROP TABLE IF EXISTS `flow_pump`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flow_pump` (
  `id` int(11) NOT NULL,
  `maxrpm` int(11) DEFAULT NULL,
  `efficiency` double DEFAULT NULL,
  `inlet` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_26FD6EEABF396750` FOREIGN KEY (`id`) REFERENCES `debb_simple` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flow_pump`
--

LOCK TABLES `flow_pump` WRITE;
/*!40000 ALTER TABLE `flow_pump` DISABLE KEYS */;
INSERT INTO `flow_pump` VALUES (9,13000,60,0),(10,0,100,1),(11,0,100,0),(16,13000,60,1),(22,NULL,0.35,0),(24,NULL,0.55,0);
/*!40000 ALTER TABLE `flow_pump` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flow_state`
--

DROP TABLE IF EXISTS `flow_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flow_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flow` decimal(10,0) DEFAULT NULL,
  `power_usage` decimal(10,0) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flowProfile_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3D49AD87DC1F13EA` (`flowProfile_id`),
  CONSTRAINT `FK_3D49AD87DC1F13EA` FOREIGN KEY (`flowProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flow_state`
--

LOCK TABLES `flow_state` WRITE;
/*!40000 ALTER TABLE `flow_state` DISABLE KEYS */;
INSERT INTO `flow_state` VALUES (2,0,0,'off',2),(3,40,7,'on 100%',2),(8,0,0,NULL,5),(9,10,20,NULL,5),(10,20,40,NULL,5),(11,0,0,NULL,6),(12,10,10,NULL,6),(13,20,20,NULL,6),(14,0,0,NULL,7),(15,1,100,NULL,7),(16,2,200,NULL,7);
/*!40000 ALTER TABLE `flow_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flowpumptochassis`
--

DROP TABLE IF EXISTS `flowpumptochassis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flowpumptochassis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flowpump_id` int(11) DEFAULT NULL,
  `chassis_id` int(11) DEFAULT NULL,
  `field` int(11) DEFAULT NULL,
  `posx` int(11) NOT NULL,
  `posy` int(11) NOT NULL,
  `posz` int(11) DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7D7C88A719689C8E` (`flowpump_id`),
  KEY `IDX_7D7C88A763EE729` (`chassis_id`),
  CONSTRAINT `FK_7D7C88A763EE729` FOREIGN KEY (`chassis_id`) REFERENCES `chassis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_7D7C88A719689C8E` FOREIGN KEY (`flowpump_id`) REFERENCES `flow_pump` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flowpumptochassis`
--

LOCK TABLES `flowpumptochassis` WRITE;
/*!40000 ALTER TABLE `flowpumptochassis` DISABLE KEYS */;
INSERT INTO `flowpumptochassis` VALUES (8,9,7,NULL,10,50,0,NULL),(10,9,1,NULL,400,910,0,0),(11,16,1,NULL,0,110,0,0),(12,16,1,NULL,0,610,0,0),(13,16,1,NULL,0,910,0,0),(14,16,1,NULL,0,810,0,0),(15,16,1,NULL,0,710,0,0),(16,16,1,NULL,0,410,0,0),(17,16,1,NULL,0,310,0,0),(18,16,1,NULL,0,210,0,0),(19,16,1,NULL,0,510,0,0),(20,9,1,NULL,400,810,0,0),(21,9,1,NULL,400,710,0,0),(22,9,1,NULL,400,610,0,0),(23,9,1,NULL,400,510,0,0),(24,9,1,NULL,400,410,0,0),(25,9,1,NULL,400,310,0,0),(26,9,1,NULL,400,210,0,0),(27,9,1,NULL,400,110,0,0),(28,16,7,NULL,150,50,0,NULL);
/*!40000 ALTER TABLE `flowpumptochassis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flowpumptoroom`
--

DROP TABLE IF EXISTS `flowpumptoroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flowpumptoroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flowpump_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `field` int(11) DEFAULT NULL,
  `posx` int(11) NOT NULL,
  `posy` int(11) NOT NULL,
  `posz` int(11) DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8FC32D7B19689C8E` (`flowpump_id`),
  KEY `IDX_8FC32D7B54177093` (`room_id`),
  CONSTRAINT `FK_8FC32D7B54177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8FC32D7B19689C8E` FOREIGN KEY (`flowpump_id`) REFERENCES `flow_pump` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flowpumptoroom`
--

LOCK TABLES `flowpumptoroom` WRITE;
/*!40000 ALTER TABLE `flowpumptoroom` DISABLE KEYS */;
INSERT INTO `flowpumptoroom` VALUES (2,10,2,NULL,30,0,1,0),(3,11,2,NULL,30,510,2200,0),(4,11,3,NULL,190,160,2200,0),(5,10,3,NULL,10,160,0,0),(6,10,1,NULL,10,150,0,0),(7,11,1,NULL,120,150,2500,0);
/*!40000 ALTER TABLE `flowpumptoroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `heatsink`
--

DROP TABLE IF EXISTS `heatsink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `heatsink` (
  `id` int(11) NOT NULL,
  `transfer_rate` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_96BCFEA7BF396750` FOREIGN KEY (`id`) REFERENCES `debb_simple` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `heatsink`
--

LOCK TABLES `heatsink` WRITE;
/*!40000 ALTER TABLE `heatsink` DISABLE KEYS */;
INSERT INTO `heatsink` VALUES (1,NULL),(2,NULL),(3,NULL),(4,NULL),(5,NULL),(6,NULL),(7,NULL),(8,NULL),(14,NULL),(15,NULL);
/*!40000 ALTER TABLE `heatsink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memory`
--

DROP TABLE IF EXISTS `memory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `interface` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EA6D3435A76ED395` (`user_id`),
  KEY `IDX_EA6D3435FADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_EA6D3435A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_EA6D3435FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memory`
--

LOCK TABLES `memory` WRITE;
/*!40000 ALTER TABLE `memory` DISABLE KEYS */;
INSERT INTO `memory` VALUES (1,NULL,NULL,NULL,'Kingston','ValueRAM',NULL,'KVR800D2S6/2G',NULL,NULL,2048,NULL,NULL,NULL),(2,NULL,NULL,NULL,'Kingston','ValueRAM',NULL,'KVR800D2S6/4G',NULL,NULL,4096,NULL,NULL,NULL),(3,NULL,NULL,NULL,'Samsung','SO-DIMM',NULL,'GreenRAM',NULL,NULL,8192,NULL,NULL,NULL);
/*!40000 ALTER TABLE `memory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `network`
--

DROP TABLE IF EXISTS `network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `network` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `interface` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `technology` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_bandwidth` int(11) DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_608487BCA76ED395` (`user_id`),
  KEY `IDX_608487BCFADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_608487BCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_608487BCFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `network`
--

LOCK TABLES `network` WRITE;
/*!40000 ALTER TABLE `network` DISABLE KEYS */;
/*!40000 ALTER TABLE `network` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node`
--

DROP TABLE IF EXISTS `node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `mesh_resolution` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_in_mesh` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_857FE845A76ED395` (`user_id`),
  KEY `IDX_857FE845FADE768C` (`powerUsageProfile_id`),
  KEY `IDX_857FE8453DA5256D` (`image_id`),
  CONSTRAINT `FK_857FE8453DA5256D` FOREIGN KEY (`image_id`) REFERENCES `file` (`id`),
  CONSTRAINT `FK_857FE845A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_857FE845FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;
INSERT INTO `node` VALUES (1,NULL,3,NULL,NULL,'Block','Power Supply',NULL,'PS',NULL,NULL,0.055,0.17,0.188,0,0,0,0,0,0,NULL,'1 1 1','1 1 1',NULL),(2,NULL,10,NULL,NULL,'Congatec','conga-BAF - T40N',NULL,'CXP2',NULL,NULL,0.125,0.012,0.095,0,0,0,0,0,0,NULL,'1 1 1','1 1 1','amdf_0_'),(3,NULL,25,NULL,NULL,'Congatec','conga-BAF - T56N',NULL,'CXP2',NULL,NULL,0.125,0.012,0.095,0,0,0,0,0,0,NULL,'1 1 1','1 1 1',NULL),(4,NULL,15,NULL,NULL,'Congatec','conga-BM45',NULL,'CXP2',NULL,NULL,0.125,0.012,0.095,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(5,NULL,16,NULL,NULL,'Congatec','conga-CCA - N2600',NULL,'CXP2',NULL,NULL,0.095,0.012,0.095,0,0,0,0,0,0,NULL,NULL,NULL,'atom64_0_'),(6,NULL,21,NULL,NULL,'Kontron','COMe-bSC2 - 3615QE',NULL,'CXP2',NULL,NULL,0.125,0.013,0.125,0,0,0,0,0,0,NULL,NULL,NULL,'i7_0_'),(7,NULL,22,NULL,NULL,'Kontron','COMe-bSC2 - 2715QE',NULL,'CXP2',NULL,NULL,0.125,0.013,0.095,0,0,0,0,0,0,NULL,NULL,NULL,'i7_0_'),(8,NULL,26,NULL,NULL,'Toradex','Woodpecker',NULL,'CXP2',NULL,NULL,0.095,0.011,0.095,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(9,NULL,27,NULL,NULL,'Toradex','Woodpecker',NULL,'CXP2',NULL,NULL,0.095,0.011,0.095,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(14,NULL,57,NULL,NULL,'Congatec','conga-CCA - D510',NULL,'CXP2',NULL,NULL,0.095,0.012,0.095,0,0,0,0,0,0,NULL,NULL,NULL,'atom64_0_');
/*!40000 ALTER TABLE `node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_file`
--

DROP TABLE IF EXISTS `node_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_file` (
  `node_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`node_id`,`file_id`),
  KEY `IDX_4B3BBB86460D9FD7` (`node_id`),
  KEY `IDX_4B3BBB8693CB796C` (`file_id`),
  CONSTRAINT `FK_4B3BBB86460D9FD7` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4B3BBB8693CB796C` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_file`
--

LOCK TABLES `node_file` WRITE;
/*!40000 ALTER TABLE `node_file` DISABLE KEYS */;
INSERT INTO `node_file` VALUES (1,4),(1,5),(2,79),(2,80),(3,11),(3,12),(4,13),(4,14),(5,17),(5,18),(6,19),(6,20),(7,23),(7,24),(14,55),(14,56);
/*!40000 ALTER TABLE `node_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nodegroup`
--

DROP TABLE IF EXISTS `nodegroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodegroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `draft_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `mesh_resolution` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_in_mesh` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F741B948A76ED395` (`user_id`),
  KEY `IDX_F741B948FADE768C` (`powerUsageProfile_id`),
  KEY `IDX_F741B948E2F3C5D1` (`draft_id`),
  CONSTRAINT `FK_F741B948A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F741B948E2F3C5D1` FOREIGN KEY (`draft_id`) REFERENCES `chassis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_F741B948FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodegroup`
--

LOCK TABLES `nodegroup` WRITE;
/*!40000 ALTER TABLE `nodegroup` DISABLE KEYS */;
INSERT INTO `nodegroup` VALUES (1,NULL,1,NULL,NULL,'Christmann','RECS | Box Compute Unit 2.0 AMD','amd.rcu','AMD Fusion T40N',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'100 100 50','0.1 0.1 0.1','recs'),(2,NULL,1,NULL,NULL,'Christmann','RECS | Box Compute Unit 2.0 Atom',NULL,'Intel Atom N2600',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'100 100 50',NULL,'recs'),(3,NULL,1,NULL,NULL,'Christmann','RECS | Box Compute Unit 2.0 I7',NULL,'Intel i7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'recs'),(4,NULL,2,NULL,NULL,'Christmann','RECS | Box Power Unit 2.0',NULL,'Sirius',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,NULL,7,NULL,NULL,'Test','InletOutletTest',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `nodegroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nodegroup_file`
--

DROP TABLE IF EXISTS `nodegroup_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodegroup_file` (
  `nodegroup_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`nodegroup_id`,`file_id`),
  KEY `IDX_F3E6C41E2C147D48` (`nodegroup_id`),
  KEY `IDX_F3E6C41E93CB796C` (`file_id`),
  CONSTRAINT `FK_F3E6C41E2C147D48` FOREIGN KEY (`nodegroup_id`) REFERENCES `nodegroup` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F3E6C41E93CB796C` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodegroup_file`
--

LOCK TABLES `nodegroup_file` WRITE;
/*!40000 ALTER TABLE `nodegroup_file` DISABLE KEYS */;
INSERT INTO `nodegroup_file` VALUES (1,40),(1,43),(2,41),(2,45),(3,42),(3,44),(4,30),(4,31);
/*!40000 ALTER TABLE `nodegroup_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nodegrouptorack`
--

DROP TABLE IF EXISTS `nodegrouptorack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodegrouptorack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nodegroup_id` int(11) DEFAULT NULL,
  `rack_id` int(11) DEFAULT NULL,
  `field` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B7FFF352C147D48` (`nodegroup_id`),
  KEY `IDX_4B7FFF358E86A33E` (`rack_id`),
  CONSTRAINT `FK_4B7FFF352C147D48` FOREIGN KEY (`nodegroup_id`) REFERENCES `nodegroup` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4B7FFF358E86A33E` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodegrouptorack`
--

LOCK TABLES `nodegrouptorack` WRITE;
/*!40000 ALTER TABLE `nodegrouptorack` DISABLE KEYS */;
INSERT INTO `nodegrouptorack` VALUES (1,NULL,NULL,29),(2,3,1,19),(3,NULL,1,18),(4,NULL,1,17),(5,NULL,1,16),(6,NULL,1,15),(7,2,1,14),(8,NULL,1,13),(9,NULL,1,12),(10,NULL,1,11),(11,NULL,1,10),(12,1,1,9),(13,NULL,1,8),(14,NULL,1,7),(15,NULL,1,6),(16,NULL,1,5),(17,NULL,1,4),(18,NULL,1,3),(19,NULL,1,2),(20,NULL,1,1),(21,NULL,1,0),(32,NULL,NULL,41),(33,NULL,2,41),(34,1,2,40),(35,1,2,39),(36,1,2,38),(37,1,2,37),(38,4,2,36),(39,NULL,2,35),(40,NULL,2,34),(41,NULL,2,33),(42,NULL,2,32),(43,NULL,2,31),(44,2,2,30),(45,2,2,29),(46,2,2,28),(47,2,2,27),(48,4,2,26),(49,NULL,2,25),(50,NULL,2,24),(51,NULL,2,23),(52,NULL,2,22),(53,NULL,2,21),(54,3,2,20),(55,3,2,19),(56,3,2,18),(57,3,2,17),(58,4,2,16),(59,NULL,2,15),(60,NULL,2,14),(61,NULL,2,13),(62,NULL,2,12),(63,NULL,2,11),(64,NULL,2,10),(65,NULL,2,9),(66,NULL,2,8),(67,NULL,2,7),(68,NULL,2,6),(69,NULL,2,5),(70,NULL,2,4),(71,NULL,2,3),(72,NULL,2,2),(73,NULL,2,1),(74,NULL,2,0),(75,NULL,NULL,0),(76,NULL,3,0),(77,NULL,NULL,19),(97,1,NULL,14),(118,NULL,NULL,24),(119,NULL,6,24),(120,1,6,23),(121,NULL,6,22),(122,NULL,6,21),(123,1,6,20),(124,NULL,6,19),(125,NULL,6,18),(126,1,6,17),(127,NULL,6,16),(128,NULL,6,15),(129,NULL,6,14),(130,NULL,6,13),(131,4,6,12),(132,NULL,6,11),(133,NULL,6,10),(134,NULL,6,9),(135,NULL,6,8),(136,NULL,6,7),(137,NULL,6,6),(138,NULL,6,5),(139,NULL,6,4),(140,NULL,6,3),(141,NULL,6,2),(142,NULL,6,1),(143,NULL,6,0);
/*!40000 ALTER TABLE `nodegrouptorack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nodetonodegroup`
--

DROP TABLE IF EXISTS `nodetonodegroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodetonodegroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_id` int(11) DEFAULT NULL,
  `nodegroup_id` int(11) DEFAULT NULL,
  `field` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A3331D14460D9FD7` (`node_id`),
  KEY `IDX_A3331D142C147D48` (`nodegroup_id`),
  CONSTRAINT `FK_A3331D142C147D48` FOREIGN KEY (`nodegroup_id`) REFERENCES `nodegroup` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A3331D14460D9FD7` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodetonodegroup`
--

LOCK TABLES `nodetonodegroup` WRITE;
/*!40000 ALTER TABLE `nodetonodegroup` DISABLE KEYS */;
INSERT INTO `nodetonodegroup` VALUES (1,2,1,17),(2,2,1,16),(3,2,1,15),(4,2,1,14),(5,2,1,13),(6,2,1,12),(7,2,1,11),(8,2,1,10),(9,2,1,9),(10,2,1,8),(11,2,1,7),(12,2,1,6),(13,2,1,5),(14,2,1,4),(15,2,1,3),(16,2,1,2),(17,2,1,1),(18,2,1,0),(21,1,4,4),(22,1,4,3),(23,1,4,2),(24,1,4,1),(25,1,4,0),(26,14,2,17),(27,5,2,16),(28,5,2,15),(29,5,2,14),(30,5,2,13),(31,14,2,12),(32,14,2,11),(33,5,2,10),(34,5,2,9),(35,5,2,8),(36,5,2,7),(37,5,2,6),(38,5,2,5),(39,5,2,4),(40,5,2,3),(41,5,2,2),(42,5,2,1),(43,14,2,0),(46,7,3,17),(47,6,3,16),(48,6,3,15),(49,6,3,14),(50,6,3,13),(51,7,3,12),(52,7,3,11),(53,6,3,10),(54,6,3,9),(55,6,3,8),(56,6,3,7),(57,6,3,6),(58,6,3,5),(59,6,3,4),(60,6,3,3),(61,6,3,2),(62,6,3,1),(63,7,3,0),(92,8,10,0);
/*!40000 ALTER TABLE `nodetonodegroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `powersupply`
--

DROP TABLE IF EXISTS `powersupply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `powersupply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `class` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `total_output_power` decimal(10,0) NOT NULL,
  `efficiency` int(11) NOT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `powerProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A1AC480CA76ED395` (`user_id`),
  KEY `IDX_A1AC480CFADE768C` (`powerUsageProfile_id`),
  KEY `IDX_A1AC480CBAD3117C` (`powerProfile_id`),
  CONSTRAINT `FK_A1AC480CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_A1AC480CBAD3117C` FOREIGN KEY (`powerProfile_id`) REFERENCES `flow_profile` (`id`),
  CONSTRAINT `FK_A1AC480CFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `powersupply`
--

LOCK TABLES `powersupply` WRITE;
/*!40000 ALTER TABLE `powersupply` DISABLE KEYS */;
INSERT INTO `powersupply` VALUES (1,NULL,NULL,NULL,'BLOCK','Power Supply',NULL,'PVSE 230/12-15',NULL,NULL,'PSU',180,87,NULL,NULL,NULL);
/*!40000 ALTER TABLE `powersupply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processor`
--

DROP TABLE IF EXISTS `processor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `processor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `max_clock_speed` int(11) NOT NULL,
  `cores` int(11) DEFAULT NULL,
  `tdp` decimal(10,0) DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29C04650A76ED395` (`user_id`),
  KEY `IDX_29C04650FADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_29C04650A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_29C04650FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processor`
--

LOCK TABLES `processor` WRITE;
/*!40000 ALTER TABLE `processor` DISABLE KEYS */;
INSERT INTO `processor` VALUES (1,NULL,NULL,NULL,'AMD','Fusion G - T40N',NULL,'T40N',NULL,NULL,1000,2,14,NULL,NULL),(2,NULL,NULL,NULL,'AMD','Fusion G - T56N',NULL,'T56N',NULL,NULL,1600,2,18,NULL,NULL),(3,NULL,NULL,NULL,'Intel','Atom - D510',NULL,'D510',NULL,NULL,1666,4,14,NULL,NULL),(4,NULL,NULL,NULL,'Intel','Atom - N2600',NULL,'N2600',18,NULL,1600,4,16,NULL,NULL),(5,NULL,NULL,NULL,'Intel','Atom - Z510',NULL,'Z510',NULL,NULL,1100,1,2,NULL,NULL),(6,NULL,NULL,NULL,'Intel','Atom Z530',NULL,'Z530',NULL,NULL,1600,1,2,NULL,NULL),(7,NULL,NULL,NULL,'Intel','Core 2 Duo',NULL,'P8400',NULL,NULL,2267,2,25,NULL,NULL),(8,NULL,NULL,NULL,'Intel','Core i7 - 2715QE',NULL,'2715QE',NULL,NULL,3000,4,40,NULL,NULL),(9,NULL,NULL,NULL,'Intel','Core i7 - 3615QE',NULL,'3615QE',NULL,NULL,3300,4,45,NULL,NULL);
/*!40000 ALTER TABLE `processor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pstate`
--

DROP TABLE IF EXISTS `pstate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pstate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `processor_id` int(11) DEFAULT NULL,
  `frequency` decimal(10,0) NOT NULL,
  `voltage` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DF51898437BAC19A` (`processor_id`),
  CONSTRAINT `FK_DF51898437BAC19A` FOREIGN KEY (`processor_id`) REFERENCES `processor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=601 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pstate`
--

LOCK TABLES `pstate` WRITE;
/*!40000 ALTER TABLE `pstate` DISABLE KEYS */;
INSERT INTO `pstate` VALUES (5,1,800,1),(24,1,1000,1),(73,4,600,1),(74,4,800,1),(75,4,1000,1),(76,4,1200,1),(77,4,1400,1),(78,4,1600,1),(143,3,208,1),(144,3,416,1),(145,3,625,1),(146,3,833,1),(147,3,1041,1),(148,3,1250,1),(149,3,1458,1),(150,3,1666,1),(160,2,1000,1),(161,2,800,1),(387,8,800,1),(388,8,900,1),(389,8,1000,1),(390,8,1100,1),(391,8,1200,1),(392,8,1300,1),(393,8,1400,1),(394,8,1500,1),(395,8,1600,1),(396,8,1700,1),(397,8,1800,1),(398,8,1900,1),(399,8,2000,1),(400,8,2100,1),(401,8,3000,1),(584,9,1200,1),(585,9,1300,1),(586,9,1400,1),(587,9,1500,1),(588,9,1600,1),(589,9,1700,1),(590,9,1800,1),(591,9,1900,1),(592,9,2000,1),(593,9,2100,1),(594,9,2200,1),(595,9,2300,1),(596,9,3300,1);
/*!40000 ALTER TABLE `pstate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pstate_load_power_usage`
--

DROP TABLE IF EXISTS `pstate_load_power_usage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pstate_load_power_usage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pstate_id` int(11) DEFAULT NULL,
  `lLoad` double NOT NULL,
  `powerUsage` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_93B582E4765034D3` (`pstate_id`),
  CONSTRAINT `FK_93B582E4765034D3` FOREIGN KEY (`pstate_id`) REFERENCES `pstate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1138 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pstate_load_power_usage`
--

LOCK TABLES `pstate_load_power_usage` WRITE;
/*!40000 ALTER TABLE `pstate_load_power_usage` DISABLE KEYS */;
INSERT INTO `pstate_load_power_usage` VALUES (3,5,100,13.5),(72,5,50,13),(73,5,25,13),(74,24,50,13.5),(75,24,100,13.75),(76,24,25,13),(140,73,25,11.75),(141,73,50,12),(142,73,100,11.75),(143,74,25,12),(144,74,50,11.25),(145,74,100,11.5),(146,75,25,12),(147,75,50,11.75),(148,75,100,11.25),(149,76,25,12.25),(150,76,50,11.75),(151,76,100,11.5),(152,77,25,11.75),(153,77,50,11.5),(154,77,100,11.75),(155,78,25,12),(156,78,50,11.25),(157,78,100,12),(242,143,25,16.06),(243,143,50,16.13),(244,143,100,16.19),(245,144,25,16.5),(246,144,50,16.44),(247,144,100,16.38),(248,145,25,16.5),(249,145,50,16.5),(250,145,100,16.5),(251,146,25,16.44),(252,146,50,16.5),(253,146,100,16.5),(254,147,25,16.44),(255,147,50,16.5),(256,147,100,16.5),(257,148,25,16.5),(258,148,50,16.5),(259,148,100,16.5),(260,149,25,16.5),(261,149,50,16.5),(262,149,100,16.5),(263,150,25,16.5),(264,150,50,16.44),(265,150,100,16.5),(285,160,25,16.69),(286,160,50,16.5),(287,160,100,16.88),(288,161,25,15.94),(289,161,50,16.06),(290,161,100,16.25),(711,387,25,13.09),(712,387,50,14.62),(713,387,75,16.26),(714,387,100,17.71),(715,388,25,13.68),(716,388,50,15.33),(717,388,75,17.19),(718,388,100,18.89),(719,389,25,13.14),(720,389,50,15.91),(721,389,75,17.44),(722,389,100,19.82),(723,390,25,13.35),(724,390,50,15.79),(725,390,75,19.04),(726,390,100,21.25),(727,391,25,14.64),(728,391,50,15.75),(729,391,75,20.7),(730,391,100,22.15),(731,392,25,15.24),(732,392,50,17.55),(733,392,75,21.9),(734,392,100,23.97),(735,393,25,14.47),(736,393,50,18.8),(737,393,75,22.32),(738,393,100,26.64),(739,394,25,16.23),(740,394,50,18.4),(741,394,75,23.97),(742,394,100,27.46),(743,395,25,14.69),(744,395,50,19.44),(745,395,75,23.78),(746,395,100,29.38),(747,396,25,17.15),(748,396,50,20.36),(749,396,75,24.77),(750,396,100,30.78),(751,397,25,17.53),(752,397,50,22.33),(753,397,75,28.31),(754,397,100,32.05),(755,398,25,16.95),(756,398,50,22.68),(757,398,75,32.37),(758,398,100,33.62),(759,399,25,17.69),(760,399,50,22.18),(761,399,75,33.42),(762,399,100,36.85),(763,400,25,17.56),(764,400,50,21.22),(765,400,75,35.84),(766,400,100,40.72),(767,401,25,27.16),(768,401,50,40.17),(769,401,75,47.82),(770,401,100,52.42),(1083,584,25,17.1),(1084,584,50,20.6),(1085,584,75,23.85),(1086,584,100,26),(1087,585,25,20.05),(1088,585,50,23),(1089,585,75,23.25),(1090,585,100,26.7),(1091,586,25,17.65),(1092,586,50,21.65),(1093,586,75,25.1),(1094,586,100,27.95),(1095,587,25,18.9),(1096,587,50,23.6),(1097,587,75,25.35),(1098,587,100,28.5),(1099,588,25,19.75),(1100,588,50,23.95),(1101,588,75,27.4),(1102,588,100,29.45),(1103,589,25,20.2),(1104,589,50,22.6),(1105,589,75,28.8),(1106,589,100,30.7),(1107,590,25,20.05),(1108,590,50,22.6),(1109,590,75,27.1),(1110,590,100,30.9),(1111,591,25,22.4),(1112,591,50,23.3),(1113,591,75,27.75),(1114,591,100,32.35),(1115,592,25,22.7),(1116,592,50,22.8),(1117,592,75,28.1),(1118,592,100,33.65),(1119,593,25,22.8),(1120,593,50,21.15),(1121,593,75,27),(1122,593,100,33),(1123,594,25,21.3),(1124,594,50,22.15),(1125,594,75,30.85),(1126,594,100,35.2),(1127,595,25,21.15),(1128,595,50,27.8),(1129,595,75,33),(1130,595,100,35.75),(1131,596,25,23.9),(1132,596,50,39.65),(1133,596,75,46),(1134,596,100,57.05);
/*!40000 ALTER TABLE `pstate_load_power_usage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rack`
--

DROP TABLE IF EXISTS `rack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `nodegroupsize` int(11) DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `mesh_resolution` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_in_mesh` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DD796A8A76ED395` (`user_id`),
  KEY `IDX_3DD796A8FADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_3DD796A8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_3DD796A8FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rack`
--

LOCK TABLES `rack` WRITE;
/*!40000 ALTER TABLE `rack` DISABLE KEYS */;
INSERT INTO `rack` VALUES (1,NULL,NULL,NULL,'Christmann','Testbed_Rack',NULL,'PSNC',NULL,NULL,0.5,1.7,1.15,0.037,0,0,0.2,0,0,20,NULL,NULL,NULL,'rack'),(2,NULL,NULL,NULL,'Christmann','Rack_2Meter',NULL,NULL,NULL,NULL,0.8,2,1.2,0.037,0,0,0.067,0,0,42,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,'Christmann','SideCooler',NULL,NULL,NULL,NULL,0.2,2,1.2,0,0,0,0.06,0,0,1,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,'Christmann','ExportTestRack',NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,0,0,25,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `rack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rack_file`
--

DROP TABLE IF EXISTS `rack_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rack_file` (
  `rack_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`rack_id`,`file_id`),
  KEY `IDX_EBE8472F8E86A33E` (`rack_id`),
  KEY `IDX_EBE8472F93CB796C` (`file_id`),
  CONSTRAINT `FK_EBE8472F8E86A33E` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_EBE8472F93CB796C` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rack_file`
--

LOCK TABLES `rack_file` WRITE;
/*!40000 ALTER TABLE `rack_file` DISABLE KEYS */;
INSERT INTO `rack_file` VALUES (1,28),(1,29),(2,36),(2,37),(3,34),(3,35);
/*!40000 ALTER TABLE `rack_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `racktoroom`
--

DROP TABLE IF EXISTS `racktoroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `racktoroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rack_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `field` int(11) DEFAULT NULL,
  `posx` int(11) NOT NULL,
  `posy` int(11) NOT NULL,
  `posz` int(11) DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_55F136BF8E86A33E` (`rack_id`),
  KEY `IDX_55F136BF54177093` (`room_id`),
  CONSTRAINT `FK_55F136BF54177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_55F136BF8E86A33E` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `racktoroom`
--

LOCK TABLES `racktoroom` WRITE;
/*!40000 ALTER TABLE `racktoroom` DISABLE KEYS */;
INSERT INTO `racktoroom` VALUES (4,1,1,NULL,70,130,0,0),(10,2,2,NULL,0,30,0,270),(11,2,2,NULL,0,130,0,270),(12,2,2,NULL,0,330,0,270),(13,2,2,NULL,0,230,0,270),(19,3,2,NULL,0,110,0,270),(21,3,2,NULL,0,210,0,270),(23,3,2,NULL,0,310,0,270),(24,3,2,NULL,0,410,0,270),(25,2,2,NULL,0,430,0,270),(26,3,2,NULL,0,510,0,270),(27,3,3,NULL,80,130,0,0),(28,2,3,NULL,100,130,0,0);
/*!40000 ALTER TABLE `racktoroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reference`
--

DROP TABLE IF EXISTS `reference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `debbSimple_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AEA34913A76ED395` (`user_id`),
  KEY `IDX_AEA3491367717E` (`debbSimple_id`),
  CONSTRAINT `FK_AEA3491367717E` FOREIGN KEY (`debbSimple_id`) REFERENCES `debb_simple` (`id`),
  CONSTRAINT `FK_AEA34913A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reference`
--

LOCK TABLES `reference` WRITE;
/*!40000 ALTER TABLE `reference` DISABLE KEYS */;
/*!40000 ALTER TABLE `reference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `componentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_power` double DEFAULT NULL,
  `power_usage` double DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `building` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `mesh_resolution` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_in_mesh` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_729F519BA76ED395` (`user_id`),
  KEY `IDX_729F519BFADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_729F519BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_729F519BFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,NULL,NULL,NULL,NULL,'PSNC - Little Server Room',NULL,NULL,NULL,NULL,200,2.5,300,0,0,0,0,0,0,'PSNC','Little Server Room',NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,NULL,'for D3.5 - ComputeBox2 Blueprint',NULL,NULL,NULL,NULL,240,2.385,570,0,0,0,0,0,0,'for D3.5','ComputeBox2 Blueprint',NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,NULL,'TEST',NULL,NULL,NULL,NULL,319.76666,2.2,299.76666,0,0,0,0,0,0,NULL,'TEST',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_coolingdevice`
--

DROP TABLE IF EXISTS `room_coolingdevice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_coolingdevice` (
  `room_id` int(11) NOT NULL,
  `coolingdevice_id` int(11) NOT NULL,
  PRIMARY KEY (`room_id`,`coolingdevice_id`),
  KEY `IDX_4491D5BD54177093` (`room_id`),
  KEY `IDX_4491D5BD524B8BF0` (`coolingdevice_id`),
  CONSTRAINT `FK_4491D5BD524B8BF0` FOREIGN KEY (`coolingdevice_id`) REFERENCES `coolingdevice` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4491D5BD54177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_coolingdevice`
--

LOCK TABLES `room_coolingdevice` WRITE;
/*!40000 ALTER TABLE `room_coolingdevice` DISABLE KEYS */;
INSERT INTO `room_coolingdevice` VALUES (1,20);
/*!40000 ALTER TABLE `room_coolingdevice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_file`
--

DROP TABLE IF EXISTS `room_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_file` (
  `room_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`room_id`,`file_id`),
  KEY `IDX_EF9BDC7454177093` (`room_id`),
  KEY `IDX_EF9BDC7493CB796C` (`file_id`),
  CONSTRAINT `FK_EF9BDC7454177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_EF9BDC7493CB796C` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_file`
--

LOCK TABLES `room_file` WRITE;
/*!40000 ALTER TABLE `room_file` DISABLE KEYS */;
INSERT INTO `room_file` VALUES (2,38),(2,39);
/*!40000 ALTER TABLE `room_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensor`
--

DROP TABLE IF EXISTS `sensor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `min_value` double DEFAULT NULL,
  `max_value` double DEFAULT NULL,
  `factor` double DEFAULT NULL,
  `accuracy` double DEFAULT NULL,
  `input` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_BC8617B0BF396750` FOREIGN KEY (`id`) REFERENCES `debb_simple` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensor`
--

LOCK TABLES `sensor` WRITE;
/*!40000 ALTER TABLE `sensor` DISABLE KEYS */;
/*!40000 ALTER TABLE `sensor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'lsiso','lsiso','lsiso@irec.cat','lsiso@irec.cat',1,'nezjzslrdeogocgck88okwskgc0wks0','8EmJ4dVmgXOMFQyF4DfU/yxBzExBh/bYXskvx4h3aKISlckdaHHda3SrI491v7a4naf2GdWfipm4ovuDT2sxJg==','2013-10-14 12:57:06',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-16  0:00:05
