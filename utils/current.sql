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
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_931095ACA76ED395` (`user_id`),
  KEY `IDX_931095ACFADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_931095ACA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_931095ACFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baseboard`
--

LOCK TABLES `baseboard` WRITE;
/*!40000 ALTER TABLE `baseboard` DISABLE KEYS */;
INSERT INTO `baseboard` VALUES (1,NULL,NULL,NULL,'Congatec','conga-BAF',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,'Congatec','conga-BM45',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,'Congatec','conga-CCA',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,'Intel','Desktop Board',NULL,'DB75EN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,'Intel','Desktop Board',NULL,'DQ77CP',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,'Intel','Desktop Board',NULL,'DQ77MK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,'Kontron','COMe-bSC',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,NULL,NULL,'Toradex','Woodpecker',NULL,'COM-Express Type 2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,NULL,NULL,NULL,'Chrismann','Apalis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
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
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_35C973DFA76ED395` (`user_id`),
  KEY `IDX_35C973DFFADE768C` (`powerUsageProfile_id`),
  KEY `IDX_35C973DF3DA5256D` (`image_id`),
  CONSTRAINT `FK_35C973DF3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `file` (`id`),
  CONSTRAINT `FK_35C973DFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_35C973DFFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chassis`
--

LOCK TABLES `chassis` WRITE;
/*!40000 ALTER TABLE `chassis` DISABLE KEYS */;
INSERT INTO `chassis` VALUES (1,NULL,1,NULL,NULL,'Christmann','RECS | Box Compute Unit',NULL,'v2.0 (Sirius) Case A',NULL,420,1090,0,0,0,0,0,0,0,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,2,NULL,NULL,'Christmann','RECS | Box Power Unit',NULL,'v2.0 (Sirius)',NULL,449.88333,409.88333,0,0,0,0,0,0,0,6,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,NULL,'Test','ChassisWithInletAndOutlet',NULL,NULL,NULL,180,120,0,0,0,0,0,0,0,1,0,NULL,NULL,NULL,'test',NULL,NULL,NULL,NULL,NULL),(12,NULL,88,NULL,NULL,'Christmann','RECS 3.0 | Box Compute Unit',NULL,'Arneb',NULL,439.88333,1119.88333,0,0,0,0,0,0,0,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,NULL,263,NULL,NULL,'PCSS Chassis',NULL,NULL,NULL,NULL,900,480,0,0,0,0,0,0,0,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
INSERT INTO `chassis_file` VALUES (1,180),(1,205),(2,148),(2,149),(12,206),(12,208);
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
  `posx` int(11) DEFAULT NULL,
  `posy` int(11) DEFAULT NULL,
  `posz` int(11) DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  `typ` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custom_pos_x` decimal(18,9) DEFAULT NULL,
  `custom_pos_y` decimal(18,9) DEFAULT NULL,
  `custom_pos_z` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CDAF1B1563EE729` (`chassis_id`),
  CONSTRAINT `FK_CDAF1B1563EE729` FOREIGN KEY (`chassis_id`) REFERENCES `chassis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chassis_typ_specification`
--

LOCK TABLES `chassis_typ_specification` WRITE;
/*!40000 ALTER TABLE `chassis_typ_specification` DISABLE KEYS */;
INSERT INTO `chassis_typ_specification` VALUES (1,1,NULL,260,930,0,180,'CXP2',0.256340000,0.929950000,0.017390000),(2,1,NULL,260,820,0,180,'CXP2',0.256340000,0.824950000,0.017390000),(3,1,NULL,260,720,0,180,'CXP2',0.256340000,0.719950000,0.017390000),(4,1,NULL,260,610,0,180,'CXP2',0.256340000,0.614950000,0.017390000),(5,1,NULL,260,510,0,180,'CXP2',0.256340000,0.509950000,0.017390000),(6,1,NULL,260,400,0,180,'CXP2',0.256340000,0.404950000,0.017390000),(11,1,NULL,260,300,0,180,'CXP2',0.256340000,0.299950000,0.017390000),(12,1,NULL,260,190,0,180,'CXP2',0.256340000,0.194950000,0.017390000),(13,1,NULL,260,90,0,180,'CXP2',0.256340000,0.089950000,0.017390000),(14,1,NULL,70,920,0,0,'CXP2',0.167660000,1.017030000,0.017390000),(15,1,NULL,70,810,0,0,'CXP2',0.167660000,0.912030000,0.017390000),(16,1,NULL,70,710,0,0,'CXP2',0.167660000,0.807030000,0.017390000),(17,1,NULL,70,600,0,0,'CXP2',0.167660000,0.702030000,0.017390000),(18,1,NULL,70,500,0,0,'CXP2',0.167660000,0.597030000,0.017390000),(19,1,NULL,70,390,0,0,'CXP2',0.167660000,0.492030000,0.017390000),(21,2,NULL,30,230,0,0,'PS',NULL,NULL,NULL),(22,2,NULL,100,230,0,0,'PS',NULL,NULL,NULL),(23,2,NULL,170,230,0,0,'PS',NULL,NULL,NULL),(24,2,NULL,240,230,0,0,'PS',NULL,NULL,NULL),(25,2,NULL,310,230,0,0,'PS',NULL,NULL,NULL),(26,1,NULL,70,290,0,0,'CXP2',0.167660000,0.387030000,0.017390000),(27,1,NULL,70,180,0,0,'CXP2',0.167660000,0.282030000,0.017390000),(29,1,NULL,70,80,0,0,'CXP2',0.167660000,0.177030000,0.017390000),(35,7,NULL,40,10,NULL,NULL,'CXP2',NULL,NULL,NULL),(68,12,NULL,70,60,0,270,'CXP2',0.190900000,0.100660000,0.005000000),(69,12,NULL,70,80,0,270,'CXP2',0.190900000,0.125660000,0.005000000),(70,12,NULL,70,100,0,270,'CXP2',0.190900000,0.150660000,0.005000000),(71,12,NULL,70,120,0,270,'CXP2',0.190900000,0.175670000,0.005000000),(72,12,NULL,280,60,0,90,'CXP2',0.249100000,0.100830000,0.005000000),(73,12,NULL,280,80,0,90,'CXP2',0.249100000,0.125840000,0.005000000),(74,12,NULL,280,100,0,90,'CXP2',0.249100000,0.150840000,0.005000000),(75,12,NULL,280,120,0,90,'CXP2',0.249100000,0.175840000,0.005000000),(76,12,NULL,70,170,0,270,'CXP2',0.190900000,0.210660000,0.005000000),(77,12,NULL,70,190,0,270,'CXP2',0.190900000,0.235660000,0.005000000),(78,12,NULL,70,210,0,270,'CXP2',0.190900000,0.260660000,0.005000000),(79,12,NULL,70,230,0,270,'CXP2',0.190900000,0.285660000,0.005000000),(81,12,NULL,70,280,0,270,'CXP2',0.190900000,0.320660000,0.005000000),(82,12,NULL,70,300,0,270,'CXP2',0.190900000,0.345660000,0.005000000),(83,12,NULL,70,320,0,270,'CXP2',0.190900000,0.370660000,0.005000000),(84,12,NULL,70,340,0,270,'CXP2',0.190900000,0.395670000,0.005000000),(85,12,NULL,70,390,0,270,'CXP2',0.190900000,0.430660000,0.005000000),(86,12,NULL,70,410,0,270,'CXP2',0.190900000,0.455660000,0.005000000),(87,12,NULL,70,430,0,270,'CXP2',0.190900000,0.480660000,0.005000000),(88,12,NULL,70,450,0,270,'CXP2',0.190900000,0.505670000,0.005000000),(89,12,NULL,70,500,0,270,'CXP2',0.190900000,0.540660000,0.005000000),(90,12,NULL,70,520,0,270,'CXP2',0.190900000,0.565660000,0.005000000),(91,12,NULL,70,540,0,270,'CXP2',0.190900000,0.590660000,0.005000000),(92,12,NULL,70,560,0,270,'CXP2',0.190900000,0.615670000,0.005000000),(93,12,NULL,70,610,0,270,'CXP2',0.190900000,0.650660000,0.005000000),(94,12,NULL,70,630,0,270,'CXP2',0.190900000,0.675660000,0.005000000),(95,12,NULL,70,650,0,270,'CXP2',0.190900000,0.700660000,0.005000000),(96,12,NULL,70,670,0,270,'CXP2',0.190900000,0.725670000,0.005000000),(97,12,NULL,70,720,0,270,'CXP2',0.190900000,0.760660000,0.005000000),(98,12,NULL,70,740,0,270,'CXP2',0.190900000,0.785660000,0.005000000),(99,12,NULL,70,760,0,270,'CXP2',0.190900000,0.810660000,0.005000000),(100,12,NULL,70,780,0,270,'CXP2',0.190900000,0.835670000,0.005000000),(101,12,NULL,70,830,0,270,'CXP2',0.190900000,0.870660000,0.005000000),(102,12,NULL,70,850,0,270,'CXP2',0.190900000,0.895660000,0.005000000),(103,12,NULL,70,870,0,270,'CXP2',0.190900000,0.920660000,0.005000000),(104,12,NULL,70,890,0,270,'CXP2',0.190900000,0.945670000,0.005000000),(105,12,NULL,70,940,0,270,'CXP2',0.190900000,0.980660000,0.005000000),(106,12,NULL,70,960,0,270,'CXP2',0.190900000,1.005660000,0.005000000),(107,12,NULL,70,980,0,270,'CXP2',0.190900000,1.030660000,0.005000000),(108,12,NULL,70,1000,0,270,'CXP2',0.190900000,1.055660000,0.005000000),(109,12,NULL,280,170,0,90,'CXP2',0.249100000,0.210830000,0.005000000),(110,12,NULL,280,190,0,90,'CXP2',0.249100000,0.235840000,0.005000000),(111,12,NULL,280,210,0,90,'CXP2',0.249100000,0.260840000,0.005000000),(112,12,NULL,280,230,0,90,'CXP2',0.249100000,0.285840000,0.005000000),(113,12,NULL,280,280,0,90,'CXP2',0.249100000,0.320830000,0.005000000),(114,12,NULL,280,300,0,90,'CXP2',0.249100000,0.345840000,0.005000000),(115,12,NULL,280,320,0,90,'CXP2',0.249100000,0.370840000,0.005000000),(116,12,NULL,280,340,0,90,'CXP2',0.249100000,0.395840000,0.005000000),(117,12,NULL,280,390,0,90,'CXP2',0.249100000,0.430830000,0.005000000),(118,12,NULL,280,410,0,90,'CXP2',0.249100000,0.455840000,0.005000000),(119,12,NULL,280,430,0,90,'CXP2',0.249100000,0.480840000,0.005000000),(120,12,NULL,280,450,0,90,'CXP2',0.249100000,0.505840000,0.005000000),(121,12,NULL,280,500,0,90,'CXP2',0.249100000,0.540830000,0.005000000),(122,12,NULL,280,520,0,90,'CXP2',0.249100000,0.565840000,0.005000000),(123,12,NULL,280,540,0,90,'CXP2',0.249100000,0.590840000,0.005000000),(124,12,NULL,280,560,0,90,'CXP2',0.249100000,0.615840000,0.005000000),(125,12,NULL,280,610,0,90,'CXP2',0.249100000,0.650830000,0.005000000),(126,12,NULL,280,630,0,90,'CXP2',0.249100000,0.675840000,0.005000000),(127,12,NULL,280,650,0,90,'CXP2',0.249100000,0.700840000,0.005000000),(128,12,NULL,280,670,0,90,'CXP2',0.249100000,0.725840000,0.005000000),(129,12,NULL,280,720,0,90,'CXP2',0.249100000,0.760830000,0.005000000),(130,12,NULL,280,740,0,90,'CXP2',0.249100000,0.785840000,0.005000000),(131,12,NULL,280,760,0,90,'CXP2',0.249100000,0.810840000,0.005000000),(132,12,NULL,280,780,0,90,'CXP2',0.249100000,0.835840000,0.005000000),(133,12,NULL,280,830,0,90,'CXP2',0.249100000,0.870830000,0.005000000),(134,12,NULL,280,850,0,90,'CXP2',0.249100000,0.895840000,0.005000000),(135,12,NULL,280,870,0,90,'CXP2',0.249100000,0.920840000,0.005000000),(136,12,NULL,280,890,0,90,'CXP2',0.249100000,0.945840000,0.005000000),(137,12,NULL,280,940,0,90,'CXP2',0.249100000,0.980830000,0.005000000),(138,12,NULL,280,960,0,90,'CXP2',0.249100000,1.005840000,0.005000000),(139,12,NULL,280,980,0,90,'CXP2',0.249100000,1.030840000,0.005000000),(140,12,NULL,280,1000,0,90,'CXP2',0.249100000,1.055840000,0.005000000),(141,15,NULL,400,200,0,0,'CXP2',NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component`
--

LOCK TABLES `component` WRITE;
/*!40000 ALTER TABLE `component` DISABLE KEYS */;
INSERT INTO `component` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,2,0),(2,1,NULL,NULL,NULL,NULL,NULL,NULL,4,0),(3,1,NULL,NULL,NULL,NULL,NULL,NULL,6,0),(4,1,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(5,1,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(6,1,NULL,NULL,NULL,NULL,1,NULL,5,1),(7,2,1,NULL,NULL,NULL,NULL,NULL,2,1),(8,2,NULL,NULL,NULL,2,NULL,NULL,4,1),(13,3,2,NULL,NULL,NULL,NULL,NULL,2,1),(14,3,NULL,NULL,NULL,2,NULL,NULL,4,1),(17,3,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(18,3,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(19,4,7,NULL,NULL,NULL,NULL,NULL,2,1),(20,4,NULL,NULL,NULL,1,NULL,NULL,4,2),(25,5,4,NULL,NULL,NULL,NULL,NULL,2,1),(26,5,NULL,NULL,NULL,1,NULL,NULL,4,1),(29,5,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(30,5,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(31,6,9,NULL,NULL,NULL,NULL,NULL,2,1),(32,6,NULL,NULL,NULL,2,NULL,NULL,4,2),(35,6,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(36,6,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(37,7,8,NULL,NULL,NULL,NULL,NULL,2,1),(38,7,NULL,NULL,NULL,3,NULL,NULL,4,2),(41,7,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(42,7,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(43,8,5,NULL,NULL,NULL,NULL,NULL,2,1),(44,8,NULL,NULL,NULL,2,NULL,NULL,4,1),(45,8,NULL,NULL,NULL,NULL,NULL,NULL,6,0),(46,8,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(47,8,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(48,8,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(49,9,6,NULL,NULL,NULL,NULL,NULL,2,1),(50,9,NULL,NULL,NULL,1,NULL,NULL,4,1),(53,9,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(54,9,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(79,14,3,NULL,NULL,NULL,NULL,NULL,2,1),(80,14,NULL,NULL,NULL,1,NULL,NULL,4,1),(83,14,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(84,14,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(85,6,NULL,NULL,NULL,NULL,NULL,14,6,1),(86,6,NULL,7,NULL,NULL,NULL,NULL,1,1),(87,7,NULL,NULL,NULL,NULL,NULL,14,6,1),(88,7,NULL,7,NULL,NULL,NULL,NULL,1,1),(89,5,NULL,NULL,NULL,NULL,NULL,15,6,1),(90,5,NULL,3,NULL,NULL,NULL,NULL,1,1),(91,14,NULL,NULL,NULL,NULL,NULL,15,6,1),(92,14,NULL,3,NULL,NULL,NULL,NULL,1,1),(93,4,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(94,4,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(95,4,NULL,NULL,NULL,NULL,NULL,2,6,1),(96,4,NULL,2,NULL,NULL,NULL,NULL,1,1),(97,2,NULL,NULL,NULL,NULL,NULL,4,6,1),(99,3,NULL,NULL,NULL,NULL,NULL,4,6,1),(100,3,NULL,1,NULL,NULL,NULL,NULL,1,1),(101,9,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(102,9,NULL,NULL,NULL,NULL,NULL,NULL,6,0),(120,17,NULL,NULL,NULL,NULL,NULL,NULL,5,0),(123,17,NULL,NULL,NULL,NULL,NULL,25,6,1),(125,17,15,NULL,NULL,NULL,NULL,NULL,2,1),(126,17,NULL,NULL,NULL,4,NULL,NULL,4,1),(127,17,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(128,17,NULL,11,NULL,NULL,NULL,NULL,1,1),(142,2,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(143,2,NULL,NULL,NULL,NULL,NULL,NULL,5,NULL),(144,2,NULL,1,NULL,NULL,NULL,NULL,1,NULL);
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
  `power_usage` int(11) NOT NULL,
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
INSERT INTO `cooling_eer` VALUES (3,NULL,5,25,769000,211200,3.64,20),(4,NULL,7,25,814000,219400,3.71,20),(5,NULL,10,25,886000,232700,3.81,20),(6,NULL,15,25,1013000,257800,3.93,20),(7,NULL,5,30,741000,230000,3.22,20),(8,NULL,7,30,785000,238600,3.29,20),(9,NULL,10,30,853000,252700,3.38,20),(10,NULL,15,30,974000,279300,3.49,20),(11,NULL,10,30,5000,1667,3,23);
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
  `max_cooling_capacity` decimal(18,9) DEFAULT NULL,
  `cooling_capacity_rated` decimal(18,9) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_2D21655BBF396750` FOREIGN KEY (`id`) REFERENCES `debb_simple` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coolingdevice`
--

LOCK TABLES `coolingdevice` WRITE;
/*!40000 ALTER TABLE `coolingdevice` DISABLE KEYS */;
INSERT INTO `coolingdevice` VALUES (20,'Refrigeration',1013000.000000000,3000.000000000),(23,'Refrigeration',5000.000000000,5000.000000000);
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
  `power_usage` decimal(18,9) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
INSERT INTO `cstate` VALUES (7,9,13.000000000,NULL),(8,8,11.000000000,NULL),(9,4,11.000000000,NULL),(10,3,11.000000000,NULL),(11,1,11.000000000,NULL);
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
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F93B9079A76ED395` (`user_id`),
  KEY `IDX_F93B9079FADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_F93B9079A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F93B9079FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debb_simple`
--

LOCK TABLES `debb_simple` WRITE;
/*!40000 ALTER TABLE `debb_simple` DISABLE KEYS */;
INSERT INTO `debb_simple` VALUES (1,NULL,NULL,NULL,'Congatec','COM Express Heatsink',NULL,'COM Express Heatsink',NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,'Congatec','COM Express Heatspreader Heatsink BM45',NULL,'conga-BM45/HSP-HP-T',NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,'Congatec','COM Express Heatspreader Heatsink',NULL,'conga-TCA/HSP-T',NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,'Congatec','COM Express Passive Heatsink BAF',NULL,'conga-BAF/CSP-T',NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,'Congatec','COM Express Passive Heatsink',NULL,'conga-TCA/CSP-T',NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,'Kontron','COM Express Passive',NULL,'Heatpipe',NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,'Scythe','KATANA',NULL,'3 SCKTN-3000A',NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,NULL,NULL,'Toradex','Woodpacker Passive Heatspreader',NULL,NULL,NULL,NULL,NULL,'heatsink',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,NULL,NULL,'40x40x28 FAN','AVC','DB04028B12U',NULL,'40x40x28mm Fan 13000RPM',7.92,NULL,2,'flowpump',0.04,0.04,0.028,0,0,0,0,0,0,NULL,NULL,'Outlet_',NULL,NULL,NULL,NULL,NULL),(10,NULL,NULL,NULL,'Air Inlet Raised Floor','60x60cm',NULL,NULL,NULL,NULL,NULL,'flowpump',0.6,0.02,0.6,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,NULL,NULL,NULL,'Air Outlet Raised Floor','60x60cm',NULL,NULL,NULL,NULL,NULL,'flowpump',0.6,0.02,0.6,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,NULL,NULL,NULL,'Kontron','COM Express Passive Heatsink i7',NULL,'Heatsink',NULL,NULL,NULL,'heatsink',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,NULL,NULL,NULL,'Congatec','COM Express Heatspreader Atom',NULL,'Heatspreader for Intel Atom',NULL,NULL,NULL,'heatsink',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,NULL,NULL,'40x40x28 FAN','AVC','DB04028B12U',NULL,'40x40x28mm Fan 13000RPM',7.92,NULL,2,'flowpump',0.04,0.04,0.028,0,0,0,0,0,0,NULL,NULL,'Inlet_',NULL,NULL,NULL,NULL,NULL),(20,NULL,NULL,'30XA-802 (screw compressor, air-cooled)','Christmann','Cooler',NULL,NULL,NULL,NULL,NULL,'coolingdevice',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,NULL,NULL,NULL,'lsiso-fannode',NULL,NULL,NULL,6,NULL,NULL,'flowpump',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,NULL,NULL,NULL,'lsiso-chiller','Testbed 5 kW',NULL,NULL,NULL,NULL,NULL,'coolingdevice',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,NULL,NULL,NULL,'lsiso-fanCRAH',NULL,NULL,NULL,NULL,NULL,NULL,'flowpump',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,NULL,NULL,NULL,'Christmann','Apalis Heatsink',NULL,NULL,NULL,NULL,NULL,'heatsink',0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
INSERT INTO `debbsimple_file` VALUES (2,146),(2,147),(4,140),(4,183),(9,204),(9,214),(14,142),(14,184),(15,138),(15,182),(16,203),(16,213),(25,160),(25,201);
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
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (1,'RECS v2.0 (Sirius).png','52317fdabacf3.png','image/png',263109),(2,'RECS v2.0 Netzteil.jpeg','523180e609cb8.jpeg','image/jpeg',483675),(3,'Block RECS v2.0 Netzteil.jpeg','52318b3493cf0.jpeg','image/jpeg',139575),(6,'AMD T40N.jpeg','52318c326786e.jpeg','image/jpeg',67618),(7,'AMD_board_00.stl','52318d6c947b6.txt','text/plain',1171914),(10,'conga-BAF.jpeg','52318e6d07885.jpeg','image/jpeg',67618),(15,'conga-BM45-rep.png','523190c241ff2.png','image/png',1576732),(16,'conga-CCA.jpeg','5231917773002.jpeg','image/jpeg',52608),(21,'COMe-bSC2.jpeg','523197edba0ad.jpeg','image/jpeg',30344),(22,'COMe-bSC2.jpeg','52319846bf7bb.jpeg','image/jpeg',30344),(25,'conga-BAF.jpeg','523199549733e.jpeg','image/jpeg',67618),(26,'woodpecker-z510.jpg','52319ae52487a.jpeg','image/jpeg',82299),(27,'woodpecker-z530.jpg','52319b724e6f9.jpeg','image/jpeg',81650),(30,'Sirius_Netzteil.wrl','5232f7ae12bc2.wrl','model/vrml',2778),(31,'Sirius_Netzteil.stl','5232f7b265c31.txt','text/plain',25280),(38,'Container.wrl','523b1097642fc.wrl','model/vrml',1004),(39,'Container.stl','523b109c88476.txt','text/plain',6659),(40,'RECS20_Case_A.stl','523bf2239e8a1.txt','text/plain',31241306),(41,'RECS20_Case_A.stl','523bf5a0d5c13.txt','text/plain',31241306),(42,'RECS20_Case_A.stl','523bf5b0de534.txt','text/plain',31241306),(43,'RECS20_Case_A.wrl','523c568c1427b.wrl','model/vrml',3987996),(44,'RECS20_Case_A.wrl','523c56ba3612c.wrl','model/vrml',3987996),(45,'RECS20_Case_A.wrl','523c56c3a20bf.wrl','model/vrml',3987996),(57,'conga-CCA.jpeg','524954c662108.jpeg','image/jpeg',52608),(70,'CoolEmAll_Testbed.zip','5253be5ced4a3.zip','application/zip',186),(83,'logo-icon.png','5257f4517aa46.png','image/png',1540),(88,'RECS v2.0 (Sirius).png','52738d0f83045.png','image/png',263109),(93,'Exynos render.png','52738e14ce2f8.png','image/png',331286),(104,'RECS v2.0 (Sirius).png','5277517593b77.png','image/png',263109),(109,'Exynos fertig neue Teile.png','527758894cbeb.png','image/png',14187081),(110,'Exynos fertig.jpg','52775be96d0ad.jpeg','image/jpeg',366536),(116,'AMD_board_00.stl','5278b3f7b243c.txt','text/plain',1358924),(117,'AMD_board_00.wrl','5278b3f8324a4.wrl','model/vrml',172927),(118,'AMD_board_00.stl','5278b412ed477.txt','text/plain',1358924),(120,'AMD_board_00.stl','5278b435692c0.txt','text/plain',1358924),(122,'Intel_Atom_00.stl','5278b4934c70a.txt','text/plain',726931),(124,'Intel_Atom_00.stl','5278b4a72a0fc.txt','text/plain',726931),(126,'Intel_I7_00.stl','5278b4c8891cb.txt','text/plain',1738395),(128,'Intel_I7_00.stl','5278b4e31c1fe.txt','text/plain',1738395),(138,'Intel_Atom_Heatspreader_00.stl','5278b6d552509.txt','text/plain',11965),(140,'AMD_heatsink_00.stl','5278b702dd38f.txt','text/plain',114847),(142,'Intel_I7_heatsink_00.stl','5278b7162c923.txt','text/plain',580470),(144,'Intel_Core2Duo_00_[m].stl','5278ce2596c35.txt','text/plain',1130159),(145,'Intel_Core2Duo_00_[m].wrl','5278ce260d835.wrl','model/vrml',147690),(146,'Intel_Core2Duo_heatsink_00_[m].stl','5278ce4ad9fd8.txt','text/plain',117310),(147,'Intel_Core2Duo_heatsink_00_[m].wrl','5278ce4b25c96.wrl','model/vrml',14409),(148,'Sirius_Netzteil_[m].stl','5278cff39db60.txt','text/plain',24506),(149,'Sirius_Netzteil_[m].wrl','5278cff3d5998.wrl','model/vrml',3282),(150,'Sirius_Netzteil_Node_[m].stl','5278d025188dd.txt','text/plain',3208),(151,'Sirius_Netzteil_Node_[m].wrl','5278d0254cc79.wrl','model/vrml',984),(152,'Schrank_2m_hoch_[m].stl','5278d0f4bdf21.txt','text/plain',19107),(153,'Schrank_2m_hoch_[m].wrl','5278d0f4f0380.wrl','model/vrml',2394),(160,'Apalis_Heatsink_[m].stl','5278dcb540f13.txt','text/plain',60912),(162,'Apalis_Modul_[m].stl','5278dce268504.txt','text/plain',186907),(180,'RECS_20_Case_A_Cover_open_[m]-90.wrl','527b4cdae39e1.wrl','model/vrml',3065586),(182,'Intel_Atom_Heatspreader_00_[m]-90.wrl','527b5296eed3c.wrl','model/vrml',2201),(183,'AMD_heatsink_00_[m]-90.wrl','527b52b5141f2.wrl','model/vrml',14933),(184,'Intel_I7_heatsink_00_[m]-90.wrl','527b52c99198a.wrl','model/vrml',103095),(185,'Intel_Atom_00_[m]-90.wrl','527b530f1f820.wrl','model/vrml',102595),(186,'AMD_board_00_[m]-90.wrl','527b5326ca19d.wrl','model/vrml',249095),(187,'Intel_Atom_00_[m]-90.wrl','527b566b9ea38.wrl','model/vrml',102595),(188,'Intel_Atom_00_[m]-90.wrl','527b5706d00c3.wrl','model/vrml',102595),(189,'Intel_I7_00_[m]-90.wrl','527b571c80908.wrl','model/vrml',251986),(190,'Intel_I7_00_[m]-90.wrl','527b57475def9.wrl','model/vrml',251986),(194,'Schrank_2m_hoch_[m].stl','527b74681a48d.txt','text/plain',19107),(195,'Schrank_2m_hoch_[m].wrl','527b746851320.wrl','model/vrml',2394),(196,'Schrank_00_[m].stl','527b7dc3e873b.txt','text/plain',19099),(198,'X197_Schrank_00_[m].wrl','527ba39e8bda9.wrl','model/vrml',3515),(199,'Schrank_00_[m]-90.wrl','527ba3c00ba43.wrl','model/vrml',3515),(201,'Apalis_Heatsink_[m]-90.wrl','527ba822900f2.wrl','model/vrml',8864),(202,'Apalis_Modul_[m]-90.wrl','527ba836bb4b2.wrl','model/vrml',27497),(203,'Luefter_40x40x28.stl','527bbde2c0a1a.txt','text/plain',83779),(204,'Luefter_40x40x28.stl','527bbe1752602.txt','text/plain',84103),(205,'RECS_20_Case_A_[m].stl','527bd915d8889.txt','text/plain',24271777),(206,'RECS_30_Case_[m].stl','527cbdc777a3c.txt','text/plain',70680091),(207,'RECS_30_Case_[m]2.wrl','527cbe186b41b.wrl','model/vrml',10718036),(208,'RECS_30_Case_Cover_open_[m].wrl','527cbfa7c183b.wrl','model/vrml',9789030),(213,'Luefter_40x40x28_detail_[m].wrl','527cf55a6b79f.wrl','model/vrml',360734),(214,'Luefter_40x40x28_detail_[m].wrl','527cf5768fe1c.wrl','model/vrml',360734),(229,'X154_Schrank_Kuehlung_[m].stl','528deba385373.txt','text/plain',8499),(230,'X155_Schrank_Kuehlung_[m].wrl','528deba3c0082.wrl','model/vrml',1430),(242,'container_40_dry_[m].stl','528e0b5c3af9d.txt','text/plain',1988862),(247,'container_40_dry_[m].stl','528e16a6ad222.txt','text/plain',1988862),(248,'container_40_dry_[m].wrl','528e16aea9ec8.wrl','model/vrml',852683),(261,'hp_proliant.png','52a5cc7d01188.png','image/png',172332),(262,'hp_proliant.png','52a5ccf0159be.png','image/png',84417),(263,'empty.png','52a5cdf855965.png','image/png',596),(264,'CDU_[m].stl','52c67e2b36ab9.txt','text/plain',2600185),(265,'CDU_[m].wrl','52c67e2f7c4df.wrl','model/vrml',353049),(266,'PDU_[m].stl','52c67e69b0cdc.txt','text/plain',1853927),(267,'PDU_[m].wrl','52c67e6cefb9b.wrl','model/vrml',243592),(272,'Network_[m].stl','52c693ba616fb.txt','text/plain',859207),(273,'Network_[m].wrl','52c693bb95cf1.wrl','model/vrml',110582),(274,'Container_[m].stl','52c696f9e46d5.txt','text/plain',470366),(275,'Container_[m].wrl','52c696faabf40.wrl','model/vrml',57722),(276,'Rack_[m].stl','52cbf0ce81a52.txt','text/plain',9784692),(277,'Rack_[m].wrl','52cbf0d8b9876.wrl','model/vrml',1314211),(278,'Sidecooler_[m].stl','52cbf2d4cb949.txt','text/plain',50749285),(279,'Sidecooler_[m].wrl','52cbf30a86f17.wrl','model/vrml',7127162),(282,'Schrank_00_[m].stl','52ce7a675b006.txt','text/plain',19099),(283,'Schrank_00_[m]-90.wrl','52ce7a678864e.wrl','model/vrml',3515),(284,'X196_Schrank_00_[m].stl','52cfe6cc7e41f.txt','text/plain',19099),(285,'X199_Schrank_00_[m]-90.wrl','52cfe6ccba4b5.wrl','model/vrml',3515);
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
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
INSERT INTO `flow_profile` VALUES (2,NULL,'AVC DB04028B12U Flow',NULL),(5,NULL,'Christmann Cooler Air',NULL),(6,NULL,'Christmann Cooler Water',NULL),(7,NULL,'Christmann Cooler Power',NULL);
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
  `flow` decimal(18,9) DEFAULT NULL,
  `power_usage` decimal(18,9) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flowProfile_id` int(11) DEFAULT NULL,
  `efficiency` decimal(18,9) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
INSERT INTO `flow_state` VALUES (2,0.000000000,0.000000000,'off',2,NULL,''),(3,0.011200000,6.600000000,'on 100%',2,NULL,''),(8,0.000000000,0.000000000,NULL,5,NULL,''),(9,10.000000000,20.000000000,NULL,5,NULL,''),(10,20.000000000,40.000000000,NULL,5,NULL,''),(11,0.000000000,0.000000000,NULL,6,NULL,''),(12,10.000000000,10.000000000,NULL,6,NULL,''),(13,20.000000000,20.000000000,NULL,6,NULL,''),(14,0.000000000,0.000000000,NULL,7,NULL,''),(15,1.000000000,100.000000000,NULL,7,NULL,''),(16,2.000000000,200.000000000,NULL,7,NULL,'');
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
  `posx` int(11) DEFAULT NULL,
  `posy` int(11) DEFAULT NULL,
  `posz` int(11) DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  `custom_pos_x` decimal(18,9) DEFAULT NULL,
  `custom_pos_y` decimal(18,9) DEFAULT NULL,
  `custom_pos_z` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7D7C88A719689C8E` (`flowpump_id`),
  KEY `IDX_7D7C88A763EE729` (`chassis_id`),
  CONSTRAINT `FK_7D7C88A719689C8E` FOREIGN KEY (`flowpump_id`) REFERENCES `flow_pump` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_7D7C88A763EE729` FOREIGN KEY (`chassis_id`) REFERENCES `chassis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flowpumptochassis`
--

LOCK TABLES `flowpumptochassis` WRITE;
/*!40000 ALTER TABLE `flowpumptochassis` DISABLE KEYS */;
INSERT INTO `flowpumptochassis` VALUES (8,9,7,NULL,10,50,0,NULL,NULL,NULL,NULL),(11,16,1,NULL,0,950,0,270,0.001000000,0.993500000,0.002500000),(12,16,1,NULL,0,850,0,270,0.001000000,0.888500000,0.002500000),(13,16,1,NULL,0,740,0,270,0.001000000,0.783500000,0.002500000),(14,16,1,NULL,0,630,0,270,0.001000000,0.678500000,0.002500000),(15,16,1,NULL,0,530,0,270,0.001000000,0.573500000,0.002500000),(16,16,1,NULL,0,430,0,270,0.001000000,0.468500000,0.002500000),(17,16,1,NULL,0,320,0,270,0.001000000,0.363500000,0.002500000),(18,16,1,NULL,0,220,0,270,0.001000000,0.258500000,0.002500000),(19,16,1,NULL,0,110,0,270,0.001000000,0.153500000,0.002500000),(20,9,1,NULL,400,960,0,270,0.395000000,0.993500000,0.002500000),(21,9,1,NULL,400,850,0,270,0.395000000,0.888500000,0.002500000),(22,9,1,NULL,400,750,0,270,0.395000000,0.783500000,0.002500000),(23,9,1,NULL,400,640,0,270,0.395000000,0.678500000,0.002500000),(24,9,1,NULL,400,540,0,270,0.395000000,0.573500000,0.002500000),(25,9,1,NULL,400,430,0,270,0.395000000,0.468500000,0.002500000),(26,9,1,NULL,400,330,0,270,0.395000000,0.363500000,0.002500000),(27,9,1,NULL,400,220,0,270,0.395000000,0.258500000,0.002500000),(28,16,7,NULL,150,50,0,NULL,NULL,NULL,NULL),(39,9,1,NULL,400,120,0,270,0.395000000,0.153500000,0.002500000),(69,16,12,NULL,0,230,0,270,0.001000000,0.268000000,0.003000000),(70,16,12,NULL,0,120,0,270,0.001000000,0.158000000,0.003000000),(71,16,12,NULL,0,340,0,270,0.001000000,0.378000000,0.003000000),(72,16,12,NULL,0,450,0,270,0.001000000,0.488000000,0.003000000),(73,16,12,NULL,0,560,0,270,0.001000000,0.598000000,0.003000000),(74,16,12,NULL,0,670,0,270,0.001000000,0.708000000,0.003000000),(75,16,12,NULL,0,780,0,270,0.001000000,0.818000000,0.003000000),(76,16,12,NULL,0,890,0,270,0.001000000,0.928000000,0.003000000),(77,16,12,NULL,0,1000,0,270,0.001000000,1.038000000,0.003000000),(78,9,12,NULL,420,1000,0,270,0.411000000,1.038000000,0.003000000),(79,9,12,NULL,420,120,0,270,0.411000000,0.158000000,0.003000000),(80,9,12,NULL,420,230,0,270,0.411000000,0.268000000,0.003000000),(81,9,12,NULL,420,340,0,270,0.411000000,0.378000000,0.003000000),(82,9,12,NULL,420,450,0,270,0.411000000,0.488000000,0.003000000),(83,9,12,NULL,420,560,0,270,0.411000000,0.598000000,0.003000000),(84,9,12,NULL,420,670,0,270,0.411000000,0.708000000,0.003000000),(85,9,12,NULL,420,780,0,270,0.411000000,0.818000000,0.003000000),(86,9,12,NULL,420,890,0,270,0.411000000,0.928000000,0.003000000),(87,9,15,NULL,530,240,0,0,NULL,NULL,NULL),(88,16,15,NULL,330,240,0,0,NULL,NULL,NULL);
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
  `posx` int(11) DEFAULT NULL,
  `posy` int(11) DEFAULT NULL,
  `posz` int(11) DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  `custom_pos_x` decimal(18,9) DEFAULT NULL,
  `custom_pos_y` decimal(18,9) DEFAULT NULL,
  `custom_pos_z` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8FC32D7B19689C8E` (`flowpump_id`),
  KEY `IDX_8FC32D7B54177093` (`room_id`),
  CONSTRAINT `FK_8FC32D7B19689C8E` FOREIGN KEY (`flowpump_id`) REFERENCES `flow_pump` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8FC32D7B54177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flowpumptoroom`
--

LOCK TABLES `flowpumptoroom` WRITE;
/*!40000 ALTER TABLE `flowpumptoroom` DISABLE KEYS */;
INSERT INTO `flowpumptoroom` VALUES (2,10,2,NULL,30,0,1,0,NULL,NULL,NULL),(3,11,2,NULL,30,510,2200,0,NULL,NULL,NULL),(4,11,3,NULL,190,160,2200,0,NULL,NULL,NULL),(5,10,3,NULL,10,160,0,0,NULL,NULL,NULL),(6,10,1,NULL,10,150,0,0,NULL,NULL,NULL),(7,11,1,NULL,120,150,2500,0,NULL,NULL,NULL),(11,10,8,NULL,240,580,0,0,NULL,NULL,NULL),(16,11,8,NULL,460,580,0,0,NULL,NULL,NULL);
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
INSERT INTO `heatsink` VALUES (1,NULL),(2,NULL),(3,NULL),(4,NULL),(5,NULL),(6,NULL),(7,NULL),(8,NULL),(14,NULL),(15,NULL),(25,NULL);
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
  `capacity` int(11) NOT NULL,
  `interface` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EA6D3435A76ED395` (`user_id`),
  KEY `IDX_EA6D3435FADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_EA6D3435A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_EA6D3435FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memory`
--

LOCK TABLES `memory` WRITE;
/*!40000 ALTER TABLE `memory` DISABLE KEYS */;
INSERT INTO `memory` VALUES (1,NULL,NULL,NULL,'Kingston','ValueRAM',NULL,'KVR800D2S6/2G',NULL,2048,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,'Kingston','ValueRAM',NULL,'KVR800D2S6/4G',NULL,4096,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,'Samsung','SO-DIMM',NULL,'GreenRAM',NULL,8192,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,'Samsung','DDR3',NULL,'K4B8G1646B-MYK0',NULL,1024,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
  `interface` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `technology` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `max_bandwidth` int(11) DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_608487BCA76ED395` (`user_id`),
  KEY `IDX_608487BCFADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_608487BCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_608487BCFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `network`
--

LOCK TABLES `network` WRITE;
/*!40000 ALTER TABLE `network` DISABLE KEYS */;
INSERT INTO `network` VALUES (1,NULL,NULL,NULL,'Generic','100MBit',NULL,NULL,NULL,'eth0','Ethernet',100000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_857FE845A76ED395` (`user_id`),
  KEY `IDX_857FE845FADE768C` (`powerUsageProfile_id`),
  KEY `IDX_857FE8453DA5256D` (`image_id`),
  CONSTRAINT `FK_857FE8453DA5256D` FOREIGN KEY (`image_id`) REFERENCES `file` (`id`),
  CONSTRAINT `FK_857FE845A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_857FE845FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;
INSERT INTO `node` VALUES (1,NULL,3,NULL,NULL,'Block','Power Supply',NULL,'PS',NULL,0.055,0.17,0.188,0,0,0,0,0,0,NULL,'1 1 1','1 1 1',NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,10,NULL,NULL,'Congatec','conga-BAF - T40N',NULL,'CXP2',NULL,0.125,0.01,0.095,0,0,0,0,0,0,NULL,'1 1 1','1 1 1','amdf_0_',NULL,NULL,NULL,NULL,NULL),(3,NULL,25,NULL,NULL,'Congatec','conga-BAF - T56N',NULL,'CXP2',NULL,0.125,0.01,0.095,0,0,0,0,0,0,NULL,'1 1 1','1 1 1',NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,15,NULL,NULL,'Congatec','conga-BM45',NULL,'CXP2',NULL,0.125,0.01,0.095,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,16,NULL,NULL,'Congatec','conga-CCA - N2600',NULL,'CXP2',NULL,0.095,0.01,0.095,0,0,0,0,0,0,NULL,NULL,NULL,'atom64_0_',NULL,NULL,NULL,NULL,NULL),(6,NULL,21,NULL,NULL,'Kontron','COMe-bSC2 - 3615QE',NULL,'CXP2',NULL,0.125,0.01,0.125,0,0,0,0,0,0,NULL,NULL,NULL,'i7_0_',NULL,NULL,NULL,NULL,NULL),(7,NULL,22,NULL,NULL,'Kontron','COMe-bSC2 - 2715QE',NULL,'CXP2',NULL,0.125,0.01,0.095,0,0,0,0,0,0,NULL,NULL,NULL,'i7_0_',NULL,NULL,NULL,NULL,NULL),(8,NULL,26,NULL,NULL,'Toradex','Woodpecker',NULL,'CXP2',NULL,0.095,0.01,0.095,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,NULL,27,NULL,NULL,'Toradex','Woodpecker',NULL,'CXP2',NULL,0.095,0.01,0.095,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,NULL,57,NULL,NULL,'Congatec','conga-CCA - D510',NULL,'CXP2',NULL,0.095,0.01,0.095,0,0,0,0,0,0,NULL,NULL,NULL,'atom64_0_',NULL,NULL,NULL,NULL,NULL),(17,NULL,110,NULL,NULL,'Christmann','Apalis Exynos 5250',NULL,'CXP2',NULL,0.08,0,0.04,0,0,0,0,0,0,NULL,NULL,NULL,'arm_0_',NULL,NULL,NULL,NULL,NULL);
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
INSERT INTO `node_file` VALUES (1,150),(1,151),(2,118),(2,185),(3,120),(3,186),(4,144),(4,145),(5,124),(5,188),(6,128),(6,190),(7,126),(7,189),(14,122),(14,187),(17,162),(17,202);
/*!40000 ALTER TABLE `node_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node_network`
--

DROP TABLE IF EXISTS `node_network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node_network` (
  `node_id` int(11) NOT NULL,
  `network_id` int(11) NOT NULL,
  PRIMARY KEY (`node_id`,`network_id`),
  KEY `IDX_C68CC2CE460D9FD7` (`node_id`),
  KEY `IDX_C68CC2CE34128B91` (`network_id`),
  CONSTRAINT `FK_C68CC2CE34128B91` FOREIGN KEY (`network_id`) REFERENCES `network` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C68CC2CE460D9FD7` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_network`
--

LOCK TABLES `node_network` WRITE;
/*!40000 ALTER TABLE `node_network` DISABLE KEYS */;
INSERT INTO `node_network` VALUES (2,1),(5,1),(6,1),(7,1),(8,1),(14,1);
/*!40000 ALTER TABLE `node_network` ENABLE KEYS */;
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
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F741B948A76ED395` (`user_id`),
  KEY `IDX_F741B948FADE768C` (`powerUsageProfile_id`),
  KEY `IDX_F741B948E2F3C5D1` (`draft_id`),
  CONSTRAINT `FK_F741B948A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F741B948E2F3C5D1` FOREIGN KEY (`draft_id`) REFERENCES `chassis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_F741B948FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodegroup`
--

LOCK TABLES `nodegroup` WRITE;
/*!40000 ALTER TABLE `nodegroup` DISABLE KEYS */;
INSERT INTO `nodegroup` VALUES (1,NULL,1,NULL,NULL,'Christmann','RECS | Box Compute Unit 2.0 AMD',NULL,'AMD Fusion T40N',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'100 100 50','0.01 0.01 0.01','recs',NULL,NULL,NULL,NULL,NULL),(2,NULL,1,NULL,NULL,'Christmann','RECS | Box Compute Unit 2.0 Atom',NULL,'Intel Atom N2600',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'100 100 50','0.01 0.01 0.01','recs',NULL,NULL,NULL,NULL,NULL),(3,NULL,1,NULL,NULL,'Christmann','RECS | Box Compute Unit 2.0 I7',NULL,'Intel i7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'50 150 5','0.01 0.01 0.01','recs',NULL,NULL,NULL,NULL,NULL),(4,NULL,2,NULL,NULL,'Christmann','RECS | Box Power Unit 2.0',NULL,'Sirius',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,NULL,1,NULL,NULL,'Test','InletOutletTest',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,NULL,12,NULL,NULL,'Christmann','RECS | Box Compute Unit 3.0 Exynos',NULL,'Apalis Exynos 5250',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'100 100 50',NULL,'recs3',NULL,NULL,NULL,NULL,NULL),(20,NULL,1,NULL,NULL,'Christmann','RECS | Box Compute Unit 2.0 Mix',NULL,'Mix',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'50 150 5','0.01 0.01 0.01','recs',NULL,NULL,NULL,NULL,NULL),(21,NULL,15,NULL,NULL,'PCSS','Box Compute Unit i7',NULL,NULL,300,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,NULL,1,NULL,NULL,NULL,'test_D2.5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
-- Table structure for table `nodegroup_network`
--

DROP TABLE IF EXISTS `nodegroup_network`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodegroup_network` (
  `nodegroup_id` int(11) NOT NULL,
  `network_id` int(11) NOT NULL,
  PRIMARY KEY (`nodegroup_id`,`network_id`),
  KEY `IDX_6549E06E2C147D48` (`nodegroup_id`),
  KEY `IDX_6549E06E34128B91` (`network_id`),
  CONSTRAINT `FK_6549E06E34128B91` FOREIGN KEY (`network_id`) REFERENCES `network` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6549E06E2C147D48` FOREIGN KEY (`nodegroup_id`) REFERENCES `nodegroup` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodegroup_network`
--

LOCK TABLES `nodegroup_network` WRITE;
/*!40000 ALTER TABLE `nodegroup_network` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodegroup_network` ENABLE KEYS */;
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
  `posx` int(11) DEFAULT NULL,
  `posy` int(11) DEFAULT NULL,
  `posz` int(11) DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B7FFF352C147D48` (`nodegroup_id`),
  KEY `IDX_4B7FFF358E86A33E` (`rack_id`),
  CONSTRAINT `FK_4B7FFF352C147D48` FOREIGN KEY (`nodegroup_id`) REFERENCES `nodegroup` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4B7FFF358E86A33E` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodegrouptorack`
--

LOCK TABLES `nodegrouptorack` WRITE;
/*!40000 ALTER TABLE `nodegrouptorack` DISABLE KEYS */;
INSERT INTO `nodegrouptorack` VALUES (1,NULL,NULL,29,0,0,NULL,NULL),(2,3,1,19,0,0,NULL,NULL),(3,NULL,1,18,0,0,NULL,NULL),(4,NULL,1,17,0,0,NULL,NULL),(5,NULL,1,16,0,0,NULL,NULL),(6,NULL,1,15,0,0,NULL,NULL),(7,2,1,14,0,0,NULL,NULL),(8,NULL,1,13,0,0,NULL,NULL),(9,NULL,1,12,0,0,NULL,NULL),(10,NULL,1,11,0,0,NULL,NULL),(11,NULL,1,10,0,0,NULL,NULL),(12,1,1,9,0,0,NULL,NULL),(13,NULL,1,8,0,0,NULL,NULL),(14,NULL,1,7,0,0,NULL,NULL),(15,NULL,1,6,0,0,NULL,NULL),(16,NULL,1,5,0,0,NULL,NULL),(17,NULL,1,4,0,0,NULL,NULL),(18,NULL,1,3,0,0,NULL,NULL),(19,NULL,1,2,0,0,NULL,NULL),(20,NULL,1,1,0,0,NULL,NULL),(21,NULL,1,0,0,0,NULL,NULL),(32,NULL,NULL,41,0,0,NULL,NULL),(33,NULL,2,41,0,0,NULL,NULL),(34,1,2,40,0,0,NULL,NULL),(35,1,2,39,0,0,NULL,NULL),(36,1,2,38,0,0,NULL,NULL),(37,1,2,37,0,0,NULL,NULL),(38,4,2,36,0,0,NULL,NULL),(39,NULL,2,35,0,0,NULL,NULL),(40,NULL,2,34,0,0,NULL,NULL),(41,NULL,2,33,0,0,NULL,NULL),(42,NULL,2,32,0,0,NULL,NULL),(43,NULL,2,31,0,0,NULL,NULL),(44,2,2,30,0,0,NULL,NULL),(45,2,2,29,0,0,NULL,NULL),(46,2,2,28,0,0,NULL,NULL),(47,2,2,27,0,0,NULL,NULL),(48,4,2,26,0,0,NULL,NULL),(49,NULL,2,25,0,0,NULL,NULL),(50,NULL,2,24,0,0,NULL,NULL),(51,NULL,2,23,0,0,NULL,NULL),(52,NULL,2,22,0,0,NULL,NULL),(53,NULL,2,21,0,0,NULL,NULL),(54,3,2,20,0,0,NULL,NULL),(55,3,2,19,0,0,NULL,NULL),(56,3,2,18,0,0,NULL,NULL),(57,3,2,17,0,0,NULL,NULL),(58,4,2,16,0,0,NULL,NULL),(59,NULL,2,15,0,0,NULL,NULL),(60,NULL,2,14,0,0,NULL,NULL),(61,NULL,2,13,0,0,NULL,NULL),(62,NULL,2,12,0,0,NULL,NULL),(63,NULL,2,11,0,0,NULL,NULL),(64,NULL,2,10,0,0,NULL,NULL),(65,NULL,2,9,0,0,NULL,NULL),(66,NULL,2,8,0,0,NULL,NULL),(67,18,2,7,0,0,NULL,NULL),(68,18,2,6,0,0,NULL,NULL),(69,NULL,2,5,0,0,NULL,NULL),(70,NULL,2,4,0,0,NULL,NULL),(71,NULL,2,3,0,0,NULL,NULL),(72,NULL,2,2,0,0,NULL,NULL),(73,NULL,2,1,0,0,NULL,NULL),(74,NULL,2,0,0,0,NULL,NULL),(75,NULL,NULL,0,0,0,NULL,NULL),(76,NULL,3,0,0,0,NULL,NULL),(77,NULL,NULL,19,0,0,NULL,NULL),(97,1,NULL,14,0,0,NULL,NULL),(118,NULL,NULL,24,0,0,NULL,NULL),(119,NULL,6,24,0,0,NULL,NULL),(120,1,6,23,0,0,NULL,NULL),(121,NULL,6,22,0,0,NULL,NULL),(122,NULL,6,21,0,0,NULL,NULL),(123,1,6,20,0,0,NULL,NULL),(124,NULL,6,19,0,0,NULL,NULL),(125,NULL,6,18,0,0,NULL,NULL),(126,1,6,17,0,0,NULL,NULL),(127,NULL,6,16,0,0,NULL,NULL),(128,NULL,6,15,0,0,NULL,NULL),(129,NULL,6,14,0,0,NULL,NULL),(130,NULL,6,13,0,0,NULL,NULL),(131,4,6,12,0,0,NULL,NULL),(132,NULL,6,11,0,0,NULL,NULL),(133,NULL,6,10,0,0,NULL,NULL),(134,NULL,6,9,0,0,NULL,NULL),(135,NULL,6,8,0,0,NULL,NULL),(136,NULL,6,7,0,0,NULL,NULL),(137,NULL,6,6,0,0,NULL,NULL),(138,NULL,6,5,0,0,NULL,NULL),(139,NULL,6,4,0,0,NULL,NULL),(140,NULL,6,3,0,0,NULL,NULL),(141,NULL,6,2,0,0,NULL,NULL),(142,NULL,6,1,0,0,NULL,NULL),(143,NULL,6,0,0,0,NULL,NULL),(144,NULL,NULL,41,NULL,NULL,NULL,NULL),(145,NULL,7,41,NULL,NULL,NULL,NULL),(146,3,7,40,NULL,NULL,NULL,NULL),(147,NULL,7,39,NULL,NULL,NULL,NULL),(148,NULL,7,38,NULL,NULL,NULL,NULL),(149,NULL,7,37,NULL,NULL,NULL,NULL),(150,NULL,7,36,NULL,NULL,NULL,NULL),(151,NULL,7,35,NULL,NULL,NULL,NULL),(152,NULL,7,34,NULL,NULL,NULL,NULL),(153,NULL,7,33,NULL,NULL,NULL,NULL),(154,NULL,7,32,NULL,NULL,NULL,NULL),(155,NULL,7,31,NULL,NULL,NULL,NULL),(156,NULL,7,30,NULL,NULL,NULL,NULL),(157,NULL,7,29,NULL,NULL,NULL,NULL),(158,NULL,7,28,NULL,NULL,NULL,NULL),(159,NULL,7,27,NULL,NULL,NULL,NULL),(160,NULL,7,26,NULL,NULL,NULL,NULL),(161,NULL,7,25,NULL,NULL,NULL,NULL),(162,NULL,7,24,NULL,NULL,NULL,NULL),(163,2,7,23,NULL,NULL,NULL,NULL),(164,NULL,7,22,NULL,NULL,NULL,NULL),(165,NULL,7,21,NULL,NULL,NULL,NULL),(166,NULL,7,20,NULL,NULL,NULL,NULL),(167,NULL,7,19,NULL,NULL,NULL,NULL),(168,NULL,7,18,NULL,NULL,NULL,NULL),(169,NULL,7,17,NULL,NULL,NULL,NULL),(170,NULL,7,16,NULL,NULL,NULL,NULL),(171,NULL,7,15,NULL,NULL,NULL,NULL),(172,NULL,7,14,NULL,NULL,NULL,NULL),(173,NULL,7,13,NULL,NULL,NULL,NULL),(174,NULL,7,12,NULL,NULL,NULL,NULL),(175,NULL,7,11,NULL,NULL,NULL,NULL),(176,NULL,7,10,NULL,NULL,NULL,NULL),(177,NULL,7,9,NULL,NULL,NULL,NULL),(178,NULL,7,8,NULL,NULL,NULL,NULL),(179,NULL,7,7,NULL,NULL,NULL,NULL),(180,NULL,7,6,NULL,NULL,NULL,NULL),(181,NULL,7,5,NULL,NULL,NULL,NULL),(182,NULL,7,4,NULL,NULL,NULL,NULL),(183,NULL,7,3,NULL,NULL,NULL,NULL),(184,NULL,7,2,NULL,NULL,NULL,NULL),(185,NULL,7,1,NULL,NULL,NULL,NULL),(186,1,7,0,NULL,NULL,NULL,NULL),(187,NULL,NULL,41,NULL,NULL,NULL,NULL),(188,NULL,8,41,NULL,NULL,NULL,NULL),(189,NULL,8,40,NULL,NULL,NULL,NULL),(190,NULL,8,39,NULL,NULL,NULL,NULL),(191,NULL,8,38,NULL,NULL,NULL,NULL),(192,NULL,8,37,NULL,NULL,NULL,NULL),(193,NULL,8,36,NULL,NULL,NULL,NULL),(194,NULL,8,35,NULL,NULL,NULL,NULL),(195,NULL,8,34,NULL,NULL,NULL,NULL),(196,NULL,8,33,NULL,NULL,NULL,NULL),(197,NULL,8,32,NULL,NULL,NULL,NULL),(198,NULL,8,31,NULL,NULL,NULL,NULL),(199,NULL,8,30,NULL,NULL,NULL,NULL),(200,NULL,8,29,NULL,NULL,NULL,NULL),(201,NULL,8,28,NULL,NULL,NULL,NULL),(202,NULL,8,27,NULL,NULL,NULL,NULL),(203,NULL,8,26,NULL,NULL,NULL,NULL),(204,NULL,8,25,NULL,NULL,NULL,NULL),(205,NULL,8,24,NULL,NULL,NULL,NULL),(206,NULL,8,23,NULL,NULL,NULL,NULL),(207,NULL,8,22,NULL,NULL,NULL,NULL),(208,NULL,8,21,NULL,NULL,NULL,NULL),(209,NULL,8,20,NULL,NULL,NULL,NULL),(210,NULL,8,19,NULL,NULL,NULL,NULL),(211,NULL,8,18,NULL,NULL,NULL,NULL),(212,NULL,8,17,NULL,NULL,NULL,NULL),(213,NULL,8,16,NULL,NULL,NULL,NULL),(214,NULL,8,15,NULL,NULL,NULL,NULL),(215,NULL,8,14,NULL,NULL,NULL,NULL),(216,NULL,8,13,NULL,NULL,NULL,NULL),(217,NULL,8,12,NULL,NULL,NULL,NULL),(218,NULL,8,11,NULL,NULL,NULL,NULL),(219,NULL,8,10,NULL,NULL,NULL,NULL),(220,NULL,8,9,NULL,NULL,NULL,NULL),(221,NULL,8,8,NULL,NULL,NULL,NULL),(222,NULL,8,7,NULL,NULL,NULL,NULL),(223,NULL,8,6,NULL,NULL,NULL,NULL),(224,NULL,8,5,NULL,NULL,NULL,NULL),(225,NULL,8,4,NULL,NULL,NULL,NULL),(226,NULL,8,3,NULL,NULL,NULL,NULL),(227,NULL,8,2,NULL,NULL,NULL,NULL),(228,NULL,8,1,NULL,NULL,NULL,NULL),(229,NULL,8,0,NULL,NULL,NULL,NULL),(230,NULL,NULL,0,NULL,NULL,NULL,NULL),(231,NULL,NULL,0,NULL,NULL,NULL,NULL),(232,NULL,NULL,0,NULL,NULL,NULL,NULL),(233,NULL,9,0,NULL,NULL,NULL,NULL),(234,NULL,10,0,NULL,NULL,NULL,NULL),(235,NULL,11,0,NULL,NULL,NULL,NULL),(236,NULL,NULL,0,NULL,NULL,NULL,NULL),(237,NULL,12,0,NULL,NULL,NULL,NULL),(238,21,NULL,40,NULL,NULL,NULL,NULL),(239,21,13,41,NULL,NULL,NULL,NULL),(240,21,13,40,NULL,NULL,NULL,NULL),(241,21,13,39,NULL,NULL,NULL,NULL),(242,21,13,38,NULL,NULL,NULL,NULL),(243,21,13,37,NULL,NULL,NULL,NULL),(244,21,13,36,NULL,NULL,NULL,NULL),(245,21,13,35,NULL,NULL,NULL,NULL),(246,21,13,34,NULL,NULL,NULL,NULL),(247,21,13,33,NULL,NULL,NULL,NULL),(248,21,13,32,NULL,NULL,NULL,NULL),(249,21,13,31,NULL,NULL,NULL,NULL),(250,21,13,30,NULL,NULL,NULL,NULL),(251,21,13,29,NULL,NULL,NULL,NULL),(252,21,13,28,NULL,NULL,NULL,NULL),(253,21,13,27,NULL,NULL,NULL,NULL),(254,21,13,26,NULL,NULL,NULL,NULL),(255,21,13,25,NULL,NULL,NULL,NULL),(256,21,13,24,NULL,NULL,NULL,NULL),(257,21,13,23,NULL,NULL,NULL,NULL),(258,21,13,22,NULL,NULL,NULL,NULL),(259,21,13,21,NULL,NULL,NULL,NULL),(260,21,13,20,NULL,NULL,NULL,NULL),(261,21,13,19,NULL,NULL,NULL,NULL),(262,21,13,18,NULL,NULL,NULL,NULL),(263,21,13,17,NULL,NULL,NULL,NULL),(264,21,13,16,NULL,NULL,NULL,NULL),(265,21,13,15,NULL,NULL,NULL,NULL),(266,21,13,14,NULL,NULL,NULL,NULL),(267,21,13,13,NULL,NULL,NULL,NULL),(268,21,13,12,NULL,NULL,NULL,NULL),(269,21,13,11,NULL,NULL,NULL,NULL),(270,21,13,10,NULL,NULL,NULL,NULL),(271,21,13,9,NULL,NULL,NULL,NULL),(272,21,13,8,NULL,NULL,NULL,NULL),(273,21,13,7,NULL,NULL,NULL,NULL),(274,21,13,6,NULL,NULL,NULL,NULL),(275,21,13,5,NULL,NULL,NULL,NULL),(276,21,13,4,NULL,NULL,NULL,NULL),(277,21,13,3,NULL,NULL,NULL,NULL),(278,21,13,2,NULL,NULL,NULL,NULL),(279,NULL,13,1,NULL,NULL,NULL,NULL),(280,NULL,13,0,NULL,NULL,NULL,NULL),(281,NULL,NULL,41,NULL,NULL,NULL,NULL),(282,NULL,14,19,NULL,NULL,NULL,NULL),(283,NULL,14,18,NULL,NULL,NULL,NULL),(284,NULL,14,17,NULL,NULL,NULL,NULL),(285,NULL,14,16,NULL,NULL,NULL,NULL),(286,NULL,14,15,NULL,NULL,NULL,NULL),(287,NULL,14,14,NULL,NULL,NULL,NULL),(288,NULL,14,13,NULL,NULL,NULL,NULL),(289,NULL,14,12,NULL,NULL,NULL,NULL),(290,NULL,14,11,NULL,NULL,NULL,NULL),(291,NULL,14,10,NULL,NULL,NULL,NULL),(292,22,14,9,NULL,NULL,NULL,NULL),(293,NULL,14,8,NULL,NULL,NULL,NULL),(294,NULL,14,7,NULL,NULL,NULL,NULL),(295,NULL,14,6,NULL,NULL,NULL,NULL),(296,NULL,14,5,NULL,NULL,NULL,NULL),(297,NULL,14,4,NULL,NULL,NULL,NULL),(298,NULL,14,3,NULL,NULL,NULL,NULL),(299,NULL,14,2,NULL,NULL,NULL,NULL),(300,NULL,14,1,NULL,NULL,NULL,NULL),(301,NULL,14,0,NULL,NULL,NULL,NULL);
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
  `posx` int(11) DEFAULT NULL,
  `posy` int(11) DEFAULT NULL,
  `posz` int(11) DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A3331D14460D9FD7` (`node_id`),
  KEY `IDX_A3331D142C147D48` (`nodegroup_id`),
  CONSTRAINT `FK_A3331D142C147D48` FOREIGN KEY (`nodegroup_id`) REFERENCES `nodegroup` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A3331D14460D9FD7` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodetonodegroup`
--

LOCK TABLES `nodetonodegroup` WRITE;
/*!40000 ALTER TABLE `nodetonodegroup` DISABLE KEYS */;
INSERT INTO `nodetonodegroup` VALUES (1,2,1,17,0,0,NULL,NULL),(2,2,1,16,0,0,NULL,NULL),(3,2,1,15,0,0,NULL,NULL),(4,2,1,14,0,0,NULL,NULL),(5,2,1,13,0,0,NULL,NULL),(6,2,1,12,0,0,NULL,NULL),(7,2,1,11,0,0,NULL,NULL),(8,2,1,10,0,0,NULL,NULL),(9,2,1,9,0,0,NULL,NULL),(10,2,1,8,0,0,NULL,NULL),(11,2,1,7,0,0,NULL,NULL),(12,2,1,6,0,0,NULL,NULL),(13,2,1,5,0,0,NULL,NULL),(14,2,1,4,0,0,NULL,NULL),(15,2,1,3,0,0,NULL,NULL),(16,2,1,2,0,0,NULL,NULL),(17,2,1,1,0,0,NULL,NULL),(18,2,1,0,0,0,NULL,NULL),(21,1,4,4,0,0,NULL,NULL),(22,1,4,3,0,0,NULL,NULL),(23,1,4,2,0,0,NULL,NULL),(24,1,4,1,0,0,NULL,NULL),(25,1,4,0,0,0,NULL,NULL),(26,14,2,17,0,0,NULL,NULL),(27,5,2,16,0,0,NULL,NULL),(28,5,2,15,0,0,NULL,NULL),(29,5,2,14,0,0,NULL,NULL),(30,5,2,13,0,0,NULL,NULL),(31,14,2,12,0,0,NULL,NULL),(32,14,2,11,0,0,NULL,NULL),(33,5,2,10,0,0,NULL,NULL),(34,5,2,9,0,0,NULL,NULL),(35,5,2,8,0,0,NULL,NULL),(36,5,2,7,0,0,NULL,NULL),(37,5,2,6,0,0,NULL,NULL),(38,5,2,5,0,0,NULL,NULL),(39,5,2,4,0,0,NULL,NULL),(40,5,2,3,0,0,NULL,NULL),(41,5,2,2,0,0,NULL,NULL),(42,5,2,1,0,0,NULL,NULL),(43,14,2,0,0,0,NULL,NULL),(46,7,3,17,0,0,NULL,NULL),(47,6,3,16,0,0,NULL,NULL),(48,6,3,15,0,0,NULL,NULL),(49,6,3,14,0,0,NULL,NULL),(50,6,3,13,0,0,NULL,NULL),(51,7,3,12,0,0,NULL,NULL),(52,7,3,11,0,0,NULL,NULL),(53,6,3,10,0,0,NULL,NULL),(54,6,3,9,0,0,NULL,NULL),(55,6,3,8,0,0,NULL,NULL),(56,6,3,7,0,0,NULL,NULL),(57,6,3,6,0,0,NULL,NULL),(58,6,3,5,0,0,NULL,NULL),(59,6,3,4,0,0,NULL,NULL),(60,6,3,3,0,0,NULL,NULL),(61,6,3,2,0,0,NULL,NULL),(62,6,3,1,0,0,NULL,NULL),(63,7,3,0,0,0,NULL,NULL),(92,8,10,17,0,0,NULL,NULL),(96,NULL,10,16,0,0,NULL,NULL),(97,2,10,15,0,0,NULL,NULL),(98,6,10,14,0,0,NULL,NULL),(99,NULL,10,13,0,0,NULL,NULL),(100,NULL,10,12,0,0,NULL,NULL),(101,NULL,10,11,0,0,NULL,NULL),(102,7,10,10,0,0,NULL,NULL),(103,NULL,10,9,0,0,NULL,NULL),(104,NULL,10,8,0,0,NULL,NULL),(105,NULL,10,7,0,0,NULL,NULL),(106,NULL,10,6,0,0,NULL,NULL),(107,NULL,10,5,0,0,NULL,NULL),(108,NULL,10,4,0,0,NULL,NULL),(109,NULL,10,3,0,0,NULL,NULL),(110,NULL,10,2,0,0,NULL,NULL),(111,NULL,10,1,0,0,NULL,NULL),(112,NULL,10,0,0,0,NULL,NULL),(113,17,18,71,NULL,NULL,NULL,NULL),(115,17,18,70,NULL,NULL,NULL,NULL),(116,17,18,69,NULL,NULL,NULL,NULL),(117,17,18,68,NULL,NULL,NULL,NULL),(118,17,18,67,NULL,NULL,NULL,NULL),(119,17,18,66,NULL,NULL,NULL,NULL),(120,17,18,65,NULL,NULL,NULL,NULL),(121,17,18,64,NULL,NULL,NULL,NULL),(122,17,18,63,NULL,NULL,NULL,NULL),(123,17,18,62,NULL,NULL,NULL,NULL),(124,17,18,61,NULL,NULL,NULL,NULL),(125,17,18,60,NULL,NULL,NULL,NULL),(126,17,18,59,NULL,NULL,NULL,NULL),(127,17,18,58,NULL,NULL,NULL,NULL),(128,17,18,57,NULL,NULL,NULL,NULL),(129,17,18,56,NULL,NULL,NULL,NULL),(130,17,18,55,NULL,NULL,NULL,NULL),(131,17,18,54,NULL,NULL,NULL,NULL),(132,17,18,53,NULL,NULL,NULL,NULL),(133,17,18,52,NULL,NULL,NULL,NULL),(134,17,18,51,NULL,NULL,NULL,NULL),(135,17,18,50,NULL,NULL,NULL,NULL),(136,17,18,49,NULL,NULL,NULL,NULL),(137,17,18,48,NULL,NULL,NULL,NULL),(138,17,18,47,NULL,NULL,NULL,NULL),(139,17,18,46,NULL,NULL,NULL,NULL),(140,17,18,45,NULL,NULL,NULL,NULL),(141,17,18,44,NULL,NULL,NULL,NULL),(142,17,18,43,NULL,NULL,NULL,NULL),(143,17,18,42,NULL,NULL,NULL,NULL),(144,17,18,41,NULL,NULL,NULL,NULL),(145,17,18,40,NULL,NULL,NULL,NULL),(146,17,18,39,NULL,NULL,NULL,NULL),(147,17,18,38,NULL,NULL,NULL,NULL),(148,17,18,37,NULL,NULL,NULL,NULL),(149,17,18,36,NULL,NULL,NULL,NULL),(150,17,18,35,NULL,NULL,NULL,NULL),(151,17,18,34,NULL,NULL,NULL,NULL),(152,17,18,33,NULL,NULL,NULL,NULL),(153,17,18,32,NULL,NULL,NULL,NULL),(154,17,18,31,NULL,NULL,NULL,NULL),(155,17,18,30,NULL,NULL,NULL,NULL),(156,17,18,29,NULL,NULL,NULL,NULL),(157,17,18,28,NULL,NULL,NULL,NULL),(158,17,18,27,NULL,NULL,NULL,NULL),(159,17,18,26,NULL,NULL,NULL,NULL),(160,17,18,25,NULL,NULL,NULL,NULL),(161,17,18,24,NULL,NULL,NULL,NULL),(162,17,18,23,NULL,NULL,NULL,NULL),(163,17,18,22,NULL,NULL,NULL,NULL),(164,17,18,21,NULL,NULL,NULL,NULL),(165,17,18,20,NULL,NULL,NULL,NULL),(166,17,18,19,NULL,NULL,NULL,NULL),(167,17,18,18,NULL,NULL,NULL,NULL),(168,17,18,17,NULL,NULL,NULL,NULL),(169,17,18,16,NULL,NULL,NULL,NULL),(170,17,18,15,NULL,NULL,NULL,NULL),(171,17,18,14,NULL,NULL,NULL,NULL),(172,17,18,13,NULL,NULL,NULL,NULL),(173,17,18,12,NULL,NULL,NULL,NULL),(174,17,18,11,NULL,NULL,NULL,NULL),(175,17,18,10,NULL,NULL,NULL,NULL),(176,17,18,9,NULL,NULL,NULL,NULL),(177,17,18,8,NULL,NULL,NULL,NULL),(178,17,18,7,NULL,NULL,NULL,NULL),(179,17,18,6,NULL,NULL,NULL,NULL),(180,17,18,5,NULL,NULL,NULL,NULL),(181,17,18,4,NULL,NULL,NULL,NULL),(182,17,18,3,NULL,NULL,NULL,NULL),(183,17,18,2,NULL,NULL,NULL,NULL),(184,17,18,1,NULL,NULL,NULL,NULL),(185,17,18,0,NULL,NULL,NULL,NULL),(186,7,20,17,NULL,NULL,NULL,NULL),(187,2,20,16,NULL,NULL,NULL,NULL),(188,6,20,15,NULL,NULL,NULL,NULL),(189,2,20,14,NULL,NULL,NULL,NULL),(190,2,20,13,NULL,NULL,NULL,NULL),(191,2,20,12,NULL,NULL,NULL,NULL),(192,7,20,11,NULL,NULL,NULL,NULL),(193,6,20,10,NULL,NULL,NULL,NULL),(194,2,20,9,NULL,NULL,NULL,NULL),(195,6,20,8,NULL,NULL,NULL,NULL),(196,6,20,7,NULL,NULL,NULL,NULL),(197,2,20,6,NULL,NULL,NULL,NULL),(198,2,20,5,NULL,NULL,NULL,NULL),(199,7,20,4,NULL,NULL,NULL,NULL),(200,7,20,3,NULL,NULL,NULL,NULL),(201,2,20,2,NULL,NULL,NULL,NULL),(202,2,20,1,NULL,NULL,NULL,NULL),(203,2,20,0,NULL,NULL,NULL,NULL),(204,6,21,0,NULL,NULL,NULL,NULL),(205,NULL,22,17,NULL,NULL,NULL,NULL),(206,NULL,22,16,NULL,NULL,NULL,NULL),(207,NULL,22,15,NULL,NULL,NULL,NULL),(208,NULL,22,14,NULL,NULL,NULL,NULL),(209,NULL,22,13,NULL,NULL,NULL,NULL),(210,NULL,22,12,NULL,NULL,NULL,NULL),(211,6,22,11,NULL,NULL,NULL,NULL),(212,NULL,22,10,NULL,NULL,NULL,NULL),(213,NULL,22,9,NULL,NULL,NULL,NULL),(214,NULL,22,8,NULL,NULL,NULL,NULL),(215,NULL,22,7,NULL,NULL,NULL,NULL),(216,NULL,22,6,NULL,NULL,NULL,NULL),(217,NULL,22,5,NULL,NULL,NULL,NULL),(218,NULL,22,4,NULL,NULL,NULL,NULL),(219,NULL,22,3,NULL,NULL,NULL,NULL),(220,NULL,22,2,NULL,NULL,NULL,NULL),(221,NULL,22,1,NULL,NULL,NULL,NULL),(222,NULL,22,0,NULL,NULL,NULL,NULL);
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
  `class` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `total_output_power` decimal(18,9) NOT NULL,
  `efficiency` int(11) NOT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `powerProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
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
INSERT INTO `powersupply` VALUES (1,NULL,NULL,NULL,'BLOCK','Power Supply',NULL,'PVSE 230/12-15',NULL,'PSU',180.000000000,87,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
  `max_clock_speed` int(11) NOT NULL,
  `cores` int(11) DEFAULT NULL,
  `tdp` decimal(18,9) DEFAULT NULL,
  `powerUsageProfile_id` int(11) DEFAULT NULL,
  `xml_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vcores_per_core` int(11) DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29C04650A76ED395` (`user_id`),
  KEY `IDX_29C04650FADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_29C04650A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_29C04650FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processor`
--

LOCK TABLES `processor` WRITE;
/*!40000 ALTER TABLE `processor` DISABLE KEYS */;
INSERT INTO `processor` VALUES (1,NULL,NULL,NULL,'AMD','Fusion G - T40N',NULL,'T40N',NULL,1000,2,14.000000000,NULL,NULL,NULL,NULL,NULL,NULL,235.000000000,14.000000000),(2,NULL,NULL,NULL,'AMD','Fusion G - T56N',NULL,'T56N',NULL,1600,2,18.000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,'Intel','Atom - D510',NULL,'D510',NULL,1666,2,14.000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,'Intel','Atom - N2600',NULL,'N2600',18,1600,2,16.000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,'Intel','Atom - Z510',NULL,'Z510',NULL,1100,1,2.000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,'Intel','Atom Z530',NULL,'Z530',NULL,1600,1,2.000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,'Intel','Core 2 Duo',NULL,'P8400',NULL,2267,2,25.000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,NULL,NULL,'Intel','Core i7 - 2715QE',NULL,'2715QE',60,3000,4,40.000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,NULL,NULL,NULL,'Intel','Core i7 - 3615QE',NULL,'3615QE',NULL,3300,4,45.000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,NULL,NULL,NULL,'Samsung','Exynos 5250',NULL,'5250',NULL,1700,2,10.000000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
  `frequency` decimal(18,9) NOT NULL,
  `voltage` decimal(18,9) NOT NULL,
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
INSERT INTO `pstate` VALUES (5,1,800.000000000,1.000000000),(24,1,1000.000000000,1.000000000),(73,4,600.000000000,1.000000000),(74,4,800.000000000,1.000000000),(75,4,1000.000000000,1.000000000),(76,4,1200.000000000,1.000000000),(77,4,1400.000000000,1.000000000),(78,4,1600.000000000,1.000000000),(143,3,208.000000000,1.000000000),(144,3,416.000000000,1.000000000),(145,3,625.000000000,1.000000000),(146,3,833.000000000,1.000000000),(147,3,1041.000000000,1.000000000),(148,3,1250.000000000,1.000000000),(149,3,1458.000000000,1.000000000),(150,3,1666.000000000,1.000000000),(160,2,1000.000000000,1.000000000),(161,2,800.000000000,1.000000000),(387,8,800.000000000,1.000000000),(388,8,900.000000000,1.000000000),(389,8,1000.000000000,1.000000000),(390,8,1100.000000000,1.000000000),(391,8,1200.000000000,1.000000000),(392,8,1300.000000000,1.000000000),(393,8,1400.000000000,1.000000000),(394,8,1500.000000000,1.000000000),(395,8,1600.000000000,1.000000000),(396,8,1700.000000000,1.000000000),(397,8,1800.000000000,1.000000000),(398,8,1900.000000000,1.000000000),(399,8,2000.000000000,1.000000000),(400,8,2100.000000000,1.000000000),(401,8,2101.000000000,1.000000000),(584,9,1200.000000000,1.000000000),(585,9,1300.000000000,1.000000000),(586,9,1400.000000000,1.000000000),(587,9,1500.000000000,1.000000000),(588,9,1600.000000000,1.000000000),(589,9,1700.000000000,1.000000000),(590,9,1800.000000000,1.000000000),(591,9,1900.000000000,1.000000000),(592,9,2000.000000000,1.000000000),(593,9,2100.000000000,1.000000000),(594,9,2200.000000000,1.000000000),(595,9,2300.000000000,1.000000000),(596,9,2301.000000000,1.000000000);
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
  `l_load` double NOT NULL,
  `powerUsage` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_93B582E4765034D3` (`pstate_id`),
  CONSTRAINT `FK_93B582E4765034D3` FOREIGN KEY (`pstate_id`) REFERENCES `pstate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1139 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pstate_load_power_usage`
--

LOCK TABLES `pstate_load_power_usage` WRITE;
/*!40000 ALTER TABLE `pstate_load_power_usage` DISABLE KEYS */;
INSERT INTO `pstate_load_power_usage` VALUES (3,5,100,13.5),(72,5,50,13),(73,5,25,13),(74,24,50,13.5),(75,24,100,13.75),(76,24,25,13),(140,73,25,11.75),(141,73,50,12),(142,73,100,11.75),(143,74,25,12),(144,74,50,11.25),(145,74,100,11.5),(146,75,25,12),(147,75,50,11.75),(148,75,100,11.25),(149,76,25,12.25),(150,76,50,11.75),(151,76,100,11.5),(152,77,25,11.75),(153,77,50,11.5),(154,77,100,11.75),(155,78,25,12),(156,78,50,11.25),(157,78,100,12),(242,143,25,16.06),(243,143,50,16.13),(244,143,100,16.19),(245,144,25,16.5),(246,144,50,16.44),(247,144,100,16.38),(248,145,25,16.5),(249,145,50,16.5),(250,145,100,16.5),(251,146,25,16.44),(252,146,50,16.5),(253,146,100,16.5),(254,147,25,16.44),(255,147,50,16.5),(256,147,100,16.5),(257,148,25,16.5),(258,148,50,16.5),(259,148,100,16.5),(260,149,25,16.5),(261,149,50,16.5),(262,149,100,16.5),(263,150,25,16.5),(264,150,50,16.44),(265,150,100,16.5),(285,160,25,16.69),(286,160,50,16.5),(287,160,100,16.88),(288,161,25,15.94),(289,161,50,16.06),(290,161,100,16.25),(711,387,25,13.75),(712,387,50,15),(713,387,12.5,12.25),(714,387,100,17.75),(715,388,25,13.75),(716,388,50,17.25),(717,388,12.5,12),(718,388,100,19),(719,389,25,14.25),(720,389,50,16),(721,389,12.5,12.5),(722,389,100,20.5),(723,390,25,14.75),(724,390,50,17.25),(725,390,12.5,12.25),(726,390,100,20.5),(727,391,25,15.25),(728,391,50,17.5),(729,391,12.5,13.5),(730,391,100,21.75),(731,392,25,15.5),(732,392,50,17.75),(733,392,12.5,12.25),(734,392,100,24.25),(735,393,25,16),(736,393,50,21.75),(737,393,12.5,12.25),(738,393,100,24),(739,394,25,15.5),(740,394,50,14.75),(741,394,12.5,12),(742,394,100,26.5),(743,395,25,20.75),(744,395,50,23.75),(745,395,12.5,12.75),(746,395,100,28.25),(747,396,25,16.5),(748,396,50,21.5),(749,396,12.5,16.25),(750,396,100,28),(751,397,25,21.5),(752,397,50,31.5),(753,397,12.5,12.25),(754,397,100,31.25),(755,398,25,23.25),(756,398,50,31),(757,398,12.5,12),(758,398,100,34.25),(759,399,25,30.5),(760,399,50,29),(761,399,12.5,25),(762,399,100,34),(763,400,25,20.5),(764,400,50,23.5),(765,400,12.5,12.25),(766,400,100,38),(767,401,25,35.5),(768,401,50,48.75),(769,401,12.5,25.5),(770,401,100,61.5),(1083,584,25,11.25),(1084,584,50,14.75),(1086,584,100,18.5),(1087,585,25,14.25),(1088,585,50,14.5),(1089,585,12.5,9.75),(1090,585,100,20.5),(1091,586,25,12.5),(1092,586,50,12.5),(1093,586,12.5,9.75),(1094,586,100,21.5),(1095,587,25,10.25),(1096,587,50,15),(1097,587,12.5,12.75),(1098,587,100,20.75),(1099,588,25,12.75),(1100,588,50,16),(1101,588,12.5,14.25),(1102,588,100,22.5),(1103,589,25,14),(1104,589,50,15.25),(1105,589,12.5,13.5),(1106,589,100,24.5),(1107,590,25,10.5),(1108,590,50,20.25),(1109,590,12.5,10.75),(1110,590,100,23.5),(1111,591,25,16.5),(1112,591,50,21.75),(1113,591,12.5,15.5),(1114,591,100,24.5),(1115,592,25,17.75),(1116,592,50,21.25),(1117,592,12.5,9.75),(1118,592,100,26.5),(1119,593,25,14.5),(1120,593,50,17.5),(1121,593,12.5,9.5),(1122,593,100,25.75),(1123,594,25,14.5),(1124,594,50,18.75),(1125,594,12.5,13.5),(1126,594,100,26.75),(1127,595,25,14.5),(1128,595,50,25.5),(1129,595,12.5,12.5),(1130,595,100,30),(1131,596,25,22.5),(1132,596,50,32.5),(1133,596,12.5,19.25),(1134,596,100,50),(1138,584,12.5,10);
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
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DD796A8A76ED395` (`user_id`),
  KEY `IDX_3DD796A8FADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_3DD796A8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_3DD796A8FADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rack`
--

LOCK TABLES `rack` WRITE;
/*!40000 ALTER TABLE `rack` DISABLE KEYS */;
INSERT INTO `rack` VALUES (1,NULL,NULL,NULL,'Christmann','Testbed_Rack',NULL,'PSNC',NULL,0.5,1.7,1.15,0.037,0,0,0.2,0,0,20,NULL,NULL,NULL,'rack',NULL,NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,'Christmann','Rack_2Meter',NULL,NULL,NULL,0.8,2,1.2,0.117,0,0,0.067,0,0,42,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,'Christmann','SideCooler',NULL,NULL,NULL,0.2,2,1.2,0,0,0,0.06,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,'Christmann','ExportTestRack',NULL,NULL,NULL,0,0,0,0,0,0,0,0,0,25,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,'TEST','TEST',NULL,NULL,NULL,0.8,2,1.2,0.117,0,0,0.067,0,0,42,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,NULL,NULL,'Christmann','SideCooler Rack',NULL,NULL,NULL,0.8,2,1.2,0.186,0,0,0.074,0.034,0,42,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,NULL,NULL,NULL,'Christmann','CDU',NULL,NULL,NULL,1,1.9,0.6,0,0,0,0,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,NULL,NULL,NULL,'Christmann','PDU',NULL,NULL,NULL,1.5,2,0.5,0,0,0,0,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,NULL,NULL,NULL,'Christmann','Central Network Switch',NULL,NULL,NULL,0.6,2,0.6,0,0,0,0,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,NULL,NULL,NULL,'Christmann','SideCooler_2',NULL,NULL,NULL,0.2,2,1.2,0,0,0,0,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8423.000000000,732.000000000),(13,NULL,NULL,NULL,'PCSS','Rack',NULL,NULL,NULL,0.6,1.9,0.9,0,0,0,0,0,0,42,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,NULL,NULL,NULL,NULL,'test_D2.5',NULL,NULL,NULL,0.5,1.7,1.15,0.037,0,0,0.2,0,0,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
INSERT INTO `rack_file` VALUES (1,196),(1,199),(2,152),(2,153),(3,229),(3,230),(7,194),(7,195),(8,276),(8,277),(9,264),(9,265),(10,266),(10,267),(11,272),(11,273),(12,278),(12,279),(13,284),(13,285),(14,282),(14,283);
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
  `posx` int(11) DEFAULT NULL,
  `posy` int(11) DEFAULT NULL,
  `posz` int(11) DEFAULT NULL,
  `rotation` double DEFAULT NULL,
  `custom_pos_x` decimal(18,9) DEFAULT NULL,
  `custom_pos_y` decimal(18,9) DEFAULT NULL,
  `custom_pos_z` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_55F136BF8E86A33E` (`rack_id`),
  KEY `IDX_55F136BF54177093` (`room_id`),
  CONSTRAINT `FK_55F136BF54177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_55F136BF8E86A33E` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `racktoroom`
--

LOCK TABLES `racktoroom` WRITE;
/*!40000 ALTER TABLE `racktoroom` DISABLE KEYS */;
INSERT INTO `racktoroom` VALUES (4,1,1,NULL,70,130,0,0,NULL,NULL,NULL),(10,2,2,NULL,0,30,0,270,NULL,NULL,NULL),(11,2,2,NULL,0,130,0,270,NULL,NULL,NULL),(12,2,2,NULL,0,330,0,270,NULL,NULL,NULL),(13,2,2,NULL,0,230,0,270,NULL,NULL,NULL),(19,3,2,NULL,0,110,0,270,NULL,NULL,NULL),(21,3,2,NULL,0,210,0,270,NULL,NULL,NULL),(23,3,2,NULL,0,310,0,270,NULL,NULL,NULL),(24,3,2,NULL,0,410,0,270,NULL,NULL,NULL),(25,2,2,NULL,0,430,0,270,NULL,NULL,NULL),(26,3,2,NULL,0,510,0,270,NULL,NULL,NULL),(27,3,3,NULL,80,130,0,0,NULL,NULL,NULL),(28,2,3,NULL,100,130,0,0,NULL,NULL,NULL),(30,9,4,NULL,0,1110,0,90,0.006000000,12.142000000,NULL),(31,11,4,NULL,70,1140,0,90,0.608000000,11.987000000,NULL),(32,10,4,NULL,190,1060,0,90,1.846000000,12.142000000,NULL),(33,8,4,NULL,0,50,0,270,1.200000000,0.450000000,0.013000000),(34,12,4,NULL,0,130,0,270,1.200000000,1.250000000,0.013000000),(35,8,4,NULL,0,150,0,270,1.200000000,1.450000000,0.013000000),(36,12,4,NULL,0,230,0,270,1.200000000,2.250000000,0.013000000),(37,8,4,NULL,0,250,0,270,1.200000000,2.450000000,0.013000000),(38,12,4,NULL,0,330,0,270,1.200000000,3.250000000,0.013000000),(39,8,4,NULL,0,350,0,270,1.200000000,3.450000000,0.013000000),(41,8,4,NULL,0,450,0,270,1.200000000,4.450000000,0.013000000),(42,12,4,NULL,0,430,0,270,1.200000000,4.250000000,0.013000000),(43,8,4,NULL,0,550,0,270,1.200000000,5.450000000,0.013000000),(44,12,4,NULL,0,530,0,270,1.200000000,5.250000000,0.013000000),(45,8,4,NULL,0,650,0,270,1.200000000,6.450000000,0.013000000),(46,12,4,NULL,0,630,0,270,1.200000000,6.250000000,0.013000000),(47,8,4,NULL,0,750,0,270,1.200000000,7.450000000,0.013000000),(48,12,4,NULL,0,730,0,270,1.200000000,7.250000000,0.013000000),(49,8,4,NULL,0,850,0,270,1.200000000,8.450000000,0.013000000),(51,8,4,NULL,0,950,0,270,1.200000000,9.450000000,0.013000000),(52,12,4,NULL,0,830,0,270,1.200000000,8.250000000,0.013000000),(53,12,4,NULL,0,930,0,270,1.200000000,9.250000000,0.013000000),(55,12,4,NULL,0,1030,0,270,1.200000000,10.250000000,0.013000000),(56,8,5,NULL,170,310,0,0,NULL,NULL,NULL),(57,12,5,NULL,150,310,0,0,NULL,NULL,NULL),(58,8,5,NULL,150,430,0,90,NULL,NULL,NULL),(59,12,5,NULL,150,510,0,90,NULL,NULL,NULL),(60,8,5,NULL,270,450,0,270,NULL,NULL,NULL),(61,12,5,NULL,270,430,0,270,NULL,NULL,NULL),(62,8,5,NULL,250,310,0,180,NULL,NULL,NULL),(63,12,5,NULL,330,310,0,180,NULL,NULL,NULL),(67,14,6,NULL,150,150,0,NULL,NULL,NULL,NULL),(70,13,7,NULL,220,1010,0,NULL,NULL,NULL,NULL),(71,13,7,NULL,420,1010,0,NULL,NULL,NULL,NULL),(72,13,7,NULL,320,1010,0,NULL,NULL,NULL,NULL),(73,13,7,NULL,520,1010,0,NULL,NULL,NULL,NULL),(74,13,7,NULL,520,910,0,NULL,NULL,NULL,NULL),(75,13,7,NULL,420,910,0,NULL,NULL,NULL,NULL),(76,13,7,NULL,320,910,0,NULL,NULL,NULL,NULL),(77,13,7,NULL,220,910,0,NULL,NULL,NULL,NULL),(78,13,7,NULL,320,810,0,NULL,NULL,NULL,NULL),(79,13,7,NULL,420,810,0,NULL,NULL,NULL,NULL),(80,13,7,NULL,520,810,0,NULL,NULL,NULL,NULL),(81,13,7,NULL,220,810,0,NULL,NULL,NULL,NULL),(82,13,7,NULL,320,710,0,NULL,NULL,NULL,NULL),(83,13,7,NULL,420,710,0,NULL,NULL,NULL,NULL),(84,13,7,NULL,520,710,0,NULL,NULL,NULL,NULL),(85,13,7,NULL,220,710,0,NULL,NULL,NULL,NULL),(86,13,7,NULL,320,610,0,NULL,NULL,NULL,NULL),(87,13,7,NULL,420,610,0,NULL,NULL,NULL,NULL),(88,13,7,NULL,520,610,0,NULL,NULL,NULL,NULL),(89,13,7,NULL,220,610,0,NULL,NULL,NULL,NULL),(90,13,7,NULL,520,110,0,NULL,NULL,NULL,NULL),(91,13,7,NULL,320,510,0,NULL,NULL,NULL,NULL),(92,13,7,NULL,420,510,0,NULL,NULL,NULL,NULL),(93,13,7,NULL,520,510,0,NULL,NULL,NULL,NULL),(94,13,7,NULL,220,410,0,NULL,NULL,NULL,NULL),(95,13,7,NULL,320,410,0,NULL,NULL,NULL,NULL),(96,13,7,NULL,420,410,0,NULL,NULL,NULL,NULL),(97,13,7,NULL,520,410,0,NULL,NULL,NULL,NULL),(98,13,7,NULL,220,310,0,NULL,NULL,NULL,NULL),(99,13,7,NULL,320,310,0,NULL,NULL,NULL,NULL),(100,13,7,NULL,420,310,0,NULL,NULL,NULL,NULL),(101,13,7,NULL,520,310,0,NULL,NULL,NULL,NULL),(102,13,7,NULL,220,210,0,NULL,NULL,NULL,NULL),(103,13,7,NULL,320,210,0,NULL,NULL,NULL,NULL),(104,13,7,NULL,420,210,0,NULL,NULL,NULL,NULL),(105,13,7,NULL,520,210,0,NULL,NULL,NULL,NULL),(106,13,7,NULL,220,110,0,NULL,NULL,NULL,NULL),(107,13,7,NULL,320,110,0,NULL,NULL,NULL,NULL),(108,13,7,NULL,420,110,0,NULL,NULL,NULL,NULL),(109,13,7,NULL,220,510,0,NULL,NULL,NULL,NULL),(110,13,8,NULL,300,560,0,0,NULL,NULL,NULL),(115,13,8,NULL,400,560,0,0,NULL,NULL,NULL);
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
  `part_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schema_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costs_eur` decimal(18,9) DEFAULT NULL,
  `costs_env` decimal(18,9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_729F519BA76ED395` (`user_id`),
  KEY `IDX_729F519BFADE768C` (`powerUsageProfile_id`),
  CONSTRAINT `FK_729F519BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_729F519BFADE768C` FOREIGN KEY (`powerUsageProfile_id`) REFERENCES `flow_profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,NULL,NULL,NULL,NULL,'PSNC - Little Server Room',NULL,NULL,NULL,200,2.5,300,0,0,0,0,0,0,'PSNC','Little Server Room',NULL,'100 50 10','0.003 0.003 0.003','room',NULL,NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,NULL,'for D3.5 - ComputeBox2 Blueprint',NULL,NULL,NULL,240,2.385,570,0,0,0,0,0,0,'for D3.5','ComputeBox2 Blueprint',NULL,'100 50 10','0.003 0.003 0.003',NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,NULL,'TEST',NULL,NULL,NULL,319.76666,2.2,299.76666,0,0,0,0,0,0,NULL,'TEST',NULL,'100 50 10','0.003 0.003 0.003',NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,NULL,'ComputeBox 40Fuss - Christmann',NULL,NULL,NULL,240,2.385,1210,0,0,0,0,0,0,'ComputeBox 40Fuss','Christmann',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,NULL,'test',NULL,NULL,NULL,0,0,0,0,0,0,0,0,0,NULL,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,NULL,'test_D2.5',NULL,NULL,NULL,300,0,300,0,0,0,0,0,0,NULL,'test_D2.5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,NULL,'Room - PCSS',NULL,NULL,NULL,800,0,1200,0,0,0,0,0,0,'Room','PCSS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,NULL,NULL,NULL,NULL,'WojtussServerRoom',NULL,NULL,NULL,0,0,0,0,0,0,0,0,0,NULL,'WojtussServerRoom',NULL,NULL,NULL,'room',NULL,NULL,NULL,NULL,NULL);
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
INSERT INTO `room_coolingdevice` VALUES (1,20),(8,20);
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
INSERT INTO `room_file` VALUES (2,38),(2,39),(4,274),(4,275);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'lsiso','lsiso','lsiso@irec.cat','lsiso@irec.cat',1,'nezjzslrdeogocgck88okwskgc0wks0','8EmJ4dVmgXOMFQyF4DfU/yxBzExBh/bYXskvx4h3aKISlckdaHHda3SrI491v7a4naf2GdWfipm4ovuDT2sxJg==','2013-10-14 12:57:06',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),(2,'bup','bup','patrick.bussmann@christmann.info','patrick.bussmann@christmann.info',1,'52c6bmbyoao04sksck0w80gw4gggcw8','k1w+mdP43bV03GFR39tg1RhkABhLY2EGwR7c7sXU0K60Li7PEMIkXuoICIsKNRS43r2P+g1RLq2yljzfnLikFg==','2013-10-16 13:32:32',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL);
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

-- Dump completed on 2014-01-11  0:00:02
