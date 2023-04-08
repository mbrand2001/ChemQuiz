-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: student_app
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Announcement_Entry`
--

DROP TABLE IF EXISTS `Announcement_Entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Announcement_Entry` (
  `Entry_id` int NOT NULL AUTO_INCREMENT,
  `Class_id` int NOT NULL,
  `Calender_date` datetime DEFAULT NULL,
  `Text_entry` varchar(500) NOT NULL,
  PRIMARY KEY (`Entry_id`),
  KEY `Class_id` (`Class_id`),
  CONSTRAINT `Announcement_Entry_ibfk_1` FOREIGN KEY (`Class_id`) REFERENCES `Class` (`Class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Announcement_Entry`
--

LOCK TABLES `Announcement_Entry` WRITE;
/*!40000 ALTER TABLE `Announcement_Entry` DISABLE KEYS */;
INSERT INTO `Announcement_Entry` VALUES (1,1,'2023-01-30 13:34:40','HI!'),(2,1,'2023-01-28 00:00:00','test!'),(9,1,'2023-01-28 19:27:48','AAAA'),(12,1,'2023-01-28 19:28:26','AAAA'),(14,1,'2023-01-28 19:30:47','lmaoaa'),(15,1,'2023-01-29 18:08:39','lmao'),(16,1,'2023-01-29 18:08:49','lmao');
/*!40000 ALTER TABLE `Announcement_Entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Assignment_Question_List`
--

DROP TABLE IF EXISTS `Assignment_Question_List`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Assignment_Question_List` (
  `Entry_id` int NOT NULL AUTO_INCREMENT,
  `Assignment_id` int NOT NULL,
  `Question_id` int NOT NULL,
  PRIMARY KEY (`Entry_id`),
  KEY `Assignment_id` (`Assignment_id`),
  KEY `Question_id` (`Question_id`),
  CONSTRAINT `Assignment_Question_List_ibfk_1` FOREIGN KEY (`Assignment_id`) REFERENCES `Assignments` (`Assignment_id`),
  CONSTRAINT `Assignment_Question_List_ibfk_2` FOREIGN KEY (`Question_id`) REFERENCES `Questions` (`Question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Assignment_Question_List`
--

LOCK TABLES `Assignment_Question_List` WRITE;
/*!40000 ALTER TABLE `Assignment_Question_List` DISABLE KEYS */;
INSERT INTO `Assignment_Question_List` VALUES (1,1,1),(11,1,8),(12,1,2),(13,1,3),(14,1,5);
/*!40000 ALTER TABLE `Assignment_Question_List` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Assignments`
--

DROP TABLE IF EXISTS `Assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Assignments` (
  `Assignment_id` int NOT NULL AUTO_INCREMENT,
  `Class_id` int NOT NULL,
  `Assignment_name` varchar(200) NOT NULL,
  `Assignment_type` varchar(100) NOT NULL,
  `Due_date` datetime NOT NULL,
  `No_of_attempts` int NOT NULL,
  `Is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Assignment_id`),
  KEY `Class_id` (`Class_id`),
  CONSTRAINT `Assignments_ibfk_1` FOREIGN KEY (`Class_id`) REFERENCES `Class` (`Class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Assignments`
--

LOCK TABLES `Assignments` WRITE;
/*!40000 ALTER TABLE `Assignments` DISABLE KEYS */;
INSERT INTO `Assignments` VALUES (1,1,'blah','blah','2023-03-16 00:04:00',2,1),(3,1,'e','e','2023-02-07 15:23:00',3,1),(5,2,'hi','text','2024-10-06 10:00:00',3,1),(6,3,'hi','text','2024-10-06 10:00:00',3,1);
/*!40000 ALTER TABLE `Assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Attempts`
--

DROP TABLE IF EXISTS `Attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Attempts` (
  `Attempt_id` int NOT NULL AUTO_INCREMENT,
  `Assignment_id` int NOT NULL,
  `User_id` int DEFAULT NULL,
  `Grade` int DEFAULT NULL,
  `Feedback` varchar(1000) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Attempt_id`),
  KEY `User_id` (`User_id`),
  KEY `Assignment_id` (`Assignment_id`),
  CONSTRAINT `Attempts_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `Users` (`User_ID`),
  CONSTRAINT `Attempts_ibfk_2` FOREIGN KEY (`Assignment_id`) REFERENCES `Assignments` (`Assignment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Attempts`
--

LOCK TABLES `Attempts` WRITE;
/*!40000 ALTER TABLE `Attempts` DISABLE KEYS */;
INSERT INTO `Attempts` VALUES (1,1,1,97,'lol',NULL),(2,1,1,97,'lol',NULL),(3,1,1,97,'lol','2023-02-15 15:50:32'),(4,1,1,NULL,NULL,'2023-02-19 21:51:30'),(5,1,1,NULL,NULL,'2023-02-19 21:56:01'),(6,1,1,NULL,NULL,'2023-02-19 21:56:20'),(7,1,1,NULL,NULL,'2023-02-19 21:57:02'),(8,1,1,NULL,NULL,'2023-02-19 21:58:01'),(9,1,1,NULL,NULL,'2023-02-19 21:59:19'),(10,1,1,NULL,NULL,'2023-02-22 10:39:31'),(11,1,1,NULL,NULL,'2023-02-22 10:39:43'),(12,1,1,NULL,NULL,'2023-02-22 10:40:20'),(13,1,1,NULL,NULL,'2023-02-22 10:54:35'),(14,1,1,NULL,NULL,'2023-02-22 10:56:16'),(15,1,1,NULL,NULL,'2023-02-22 10:57:04'),(16,1,1,NULL,NULL,'2023-02-22 10:58:08'),(17,1,1,NULL,NULL,'2023-02-22 10:58:40'),(18,1,1,NULL,NULL,'2023-02-22 10:59:12'),(19,1,1,NULL,NULL,'2023-02-22 10:59:27'),(20,1,1,NULL,NULL,'2023-02-22 10:59:43'),(21,1,1,NULL,NULL,'2023-02-22 15:53:19'),(22,1,1,NULL,NULL,'2023-02-22 15:53:27'),(23,1,1,NULL,NULL,'2023-02-22 15:53:35'),(24,1,1,NULL,NULL,'2023-02-22 15:53:52'),(25,1,1,NULL,NULL,'2023-02-22 15:54:09'),(26,1,1,NULL,NULL,'2023-02-22 15:55:58'),(27,1,1,NULL,NULL,'2023-02-22 15:58:23'),(28,1,1,NULL,NULL,'2023-02-22 15:58:32'),(29,1,1,NULL,NULL,'2023-02-23 09:03:53'),(30,1,1,NULL,NULL,'2023-02-23 09:04:01'),(31,1,1,NULL,NULL,'2023-02-23 09:04:22'),(32,1,1,NULL,NULL,'2023-02-23 09:04:30'),(33,1,1,NULL,NULL,'2023-02-23 09:05:11'),(34,1,1,NULL,NULL,'2023-02-23 09:09:10'),(35,1,1,NULL,NULL,'2023-02-23 09:12:55'),(36,1,1,NULL,NULL,'2023-02-23 09:15:03'),(37,1,1,NULL,NULL,'2023-02-23 12:53:19'),(38,1,1,NULL,NULL,'2023-02-23 13:00:32'),(39,1,1,NULL,NULL,'2023-02-23 13:01:29'),(40,1,1,NULL,NULL,'2023-02-23 13:02:03'),(41,1,1,67,NULL,'2023-02-23 13:12:29'),(42,1,1,NULL,NULL,'2023-03-04 16:30:04'),(43,1,1,NULL,NULL,'2023-03-04 16:31:37'),(44,1,1,NULL,NULL,'2023-03-04 16:31:55'),(45,1,1,NULL,NULL,'2023-03-04 16:43:57'),(46,1,1,NULL,NULL,'2023-03-04 16:46:17'),(47,1,1,NULL,NULL,'2023-03-04 16:54:09'),(48,1,1,NULL,NULL,'2023-03-04 16:57:17'),(49,1,1,NULL,NULL,'2023-03-04 16:59:18'),(50,1,1,NULL,NULL,'2023-03-06 16:42:54'),(51,1,1,NULL,NULL,'2023-03-06 16:43:38'),(52,1,1,NULL,NULL,'2023-03-06 16:44:18'),(53,1,1,40,NULL,'2023-03-06 16:47:12'),(54,1,1,NULL,NULL,'2023-03-06 16:49:30'),(55,1,1,NULL,NULL,'2023-03-22 11:59:51'),(56,1,1,NULL,NULL,'2023-03-22 12:10:41'),(57,1,2,NULL,NULL,'2023-03-22 15:50:14'),(58,1,2,NULL,NULL,'2023-03-22 16:00:19'),(59,1,2,NULL,NULL,'2023-03-22 16:01:42'),(60,1,2,NULL,NULL,'2023-03-24 10:34:17');
/*!40000 ALTER TABLE `Attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Calender_Entry`
--

DROP TABLE IF EXISTS `Calender_Entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Calender_Entry` (
  `Entry_id` int NOT NULL AUTO_INCREMENT,
  `Class_id` int NOT NULL,
  `Calender_date` date NOT NULL,
  `Text_entry` varchar(500) NOT NULL,
  PRIMARY KEY (`Entry_id`),
  KEY `Class_id` (`Class_id`),
  CONSTRAINT `Calender_Entry_ibfk_1` FOREIGN KEY (`Class_id`) REFERENCES `Class` (`Class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Calender_Entry`
--

LOCK TABLES `Calender_Entry` WRITE;
/*!40000 ALTER TABLE `Calender_Entry` DISABLE KEYS */;
INSERT INTO `Calender_Entry` VALUES (1,1,'2023-03-24','goodbye'),(2,3,'2023-01-26','asdsadasdasdsdadsds');
/*!40000 ALTER TABLE `Calender_Entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Class`
--

DROP TABLE IF EXISTS `Class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Class` (
  `Class_id` int NOT NULL AUTO_INCREMENT,
  `Class_name` varchar(50) NOT NULL,
  `Professor_id` int NOT NULL,
  `Code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Class_id`),
  KEY `Professor_id` (`Professor_id`),
  CONSTRAINT `Class_ibfk_1` FOREIGN KEY (`Professor_id`) REFERENCES `Users` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Class`
--

LOCK TABLES `Class` WRITE;
/*!40000 ALTER TABLE `Class` DISABLE KEYS */;
INSERT INTO `Class` VALUES (1,'abc',1,NULL),(2,'test',1,NULL),(3,'test',1,NULL),(5,'lolbert',1,'gbxWwEvwMf'),(6,'a',1,'mgJqLcaRXC');
/*!40000 ALTER TABLE `Class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Elements`
--

DROP TABLE IF EXISTS `Elements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Elements` (
  `element_id` int NOT NULL AUTO_INCREMENT,
  `group` varchar(3) DEFAULT NULL,
  `period` tinyint DEFAULT NULL,
  `atomic_number` tinyint NOT NULL,
  `atomic_mass` decimal(20,15) NOT NULL,
  `symbol` varchar(3) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`element_id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Elements`
--

LOCK TABLES `Elements` WRITE;
/*!40000 ALTER TABLE `Elements` DISABLE KEYS */;
INSERT INTO `Elements` VALUES (1,'1',1,1,1.007940000000000,'H','Hydrogen'),(2,'18',1,2,4.002602000000000,'He','Helium'),(3,'1',2,3,6.941000000000000,'Li','Lithium'),(4,'2',2,4,9.012182000000000,'Be','Beryllium'),(5,'13',2,5,10.811000000000000,'B','Boron'),(6,'14',2,6,12.010700000000000,'C','Carbon'),(7,'15',2,7,14.006700000000000,'N','Nitrogen'),(8,'16',2,8,15.999400000000000,'O','Oxygen'),(9,'17',2,9,18.998403200000000,'F','Flourine'),(10,'18',2,10,20.179700000000000,'Ne','Neon'),(11,'1',3,11,22.989770000000000,'Na','Sodium'),(12,'2',3,12,24.305000000000000,'Mg','Magnesium'),(13,'13',3,13,26.981538000000000,'Al','Aliminum'),(14,'14',3,14,28.085500000000000,'Si','Silicon'),(15,'15',3,15,30.973761000000000,'P','Phophorus'),(16,'16',3,16,32.065000000000000,'S','Sulfur'),(17,'17',3,17,35.453000000000000,'Cl','Chlorine'),(18,'18',3,18,39.948000000000000,'Ar','Argon'),(19,'1',4,19,39.098000000000000,'K','Potassium'),(20,'2',4,20,40.078000000000000,'Ca','Calcium'),(21,'3',4,21,44.955910000000000,'Sc','Scandium'),(22,'4',4,22,47.867000000000000,'Ti','Titanium'),(23,'5',4,23,50.941500000000000,'V','Vanadium'),(24,'6',4,24,51.996100000000000,'Cr','Chromium'),(25,'7',4,25,54.938049000000000,'Mn','Manganese'),(26,'8',4,26,55.845000000000000,'Fe','Iron'),(27,'9',4,27,58.933200000000000,'Co','Cobalt'),(28,'10',4,28,58.693400000000000,'Ni','Nickel'),(29,'11',4,29,63.546000000000000,'Cu','Copper'),(30,'12',4,30,65.409000000000000,'Zn','Zinc'),(31,'13',4,31,69.723000000000000,'Ga','Galium'),(32,'14',4,32,72.640000000000000,'Ge','Germanium'),(33,'15',4,33,74.921600000000000,'As','Arsenic'),(34,'16',4,34,78.960000000000000,'Se','Selenium'),(35,'17',4,35,79.904000000000000,'Br','Bromine'),(36,'18',4,36,83.798000000000000,'Kr','Krypton'),(37,'1',5,37,85.467800000000000,'Rb','Rubidium'),(38,'2',5,38,87.620000000000000,'Sr','Strontium'),(39,'3',5,39,88.905850000000000,'Y','Yttrium'),(40,'4',5,40,91.224000000000000,'Zr','Zirconium'),(41,'5',5,41,92.906380000000000,'Nb','Niobium'),(42,'6',5,42,95.940000000000000,'Mo','Molybdenum'),(43,'7',5,43,99.000000000000000,'Tc','Technetium'),(44,'8',5,44,101.070000000000000,'Ru','Ruthenium'),(45,'9',5,45,102.905500000000000,'Rh','Rhodium'),(46,'10',5,46,106.420000000000000,'Pd','Palladium'),(47,'11',5,47,107.868200000000000,'Ag','Silver'),(48,'12',5,48,112.411000000000000,'Cd','Cadmium'),(49,'13',5,49,114.813000000000000,'In','Indium'),(50,'14',5,50,118.710000000000000,'Sn','Tin'),(51,'15',5,51,121.760000000000000,'Sb','Antimony'),(52,'16',5,52,127.600000000000000,'Te','Tellurium'),(53,'17',5,53,126.904470000000000,'I','Iodine'),(54,'18',5,54,131.293000000000000,'Xe','Xenon'),(55,'1',6,55,132.905450000000000,'Cs','Cesium'),(56,'2',6,56,137.327000000000000,'Ba','Barium'),(57,'',6,57,138.905500000000000,'La','Lanthanum'),(58,'',6,58,140.116000000000000,'Ce','Cerium'),(59,'',6,59,140.907650000000000,'Pr','Praseodymium'),(60,'',6,60,144.240000000000000,'Nd','Neodymium'),(61,'',6,61,145.000000000000000,'Pm','Promethium'),(62,'',6,62,150.360000000000000,'Sm','Samarium'),(63,'',6,63,151.964000000000000,'Eu','Europium'),(64,'',6,64,157.250000000000000,'Gd','Gadollnium'),(65,'',6,65,158.925340000000000,'Tb','Terbium'),(66,'',6,66,162.500000000000000,'Dy','Dysprosium'),(67,'',6,67,164.930320000000000,'Ho','Holmium'),(68,'',6,68,167.259000000000000,'Er','Erbium'),(69,'',6,69,168.934210000000000,'Tm','Thulium'),(70,'',6,70,173.040000000000000,'Yb','Ytterbium'),(71,'3',6,71,174.967000000000000,'Lu','Luteium'),(72,'4',6,72,178.490000000000000,'Hf','Hafnium'),(73,'5',6,73,180.947000000000000,'Ta','Tantalum'),(74,'6',6,74,183.840000000000000,'W','Tungsten'),(75,'7',6,75,186.207000000000000,'Re','Rhenium'),(76,'8',6,76,190.230000000000000,'Os','Osmium'),(77,'9',6,77,192.217000000000000,'Ir','Iridium'),(78,'10',6,78,195.078000000000000,'Pt','Platinum'),(79,'11',6,79,196.966550000000000,'Au','Gold'),(80,'12',6,80,200.590000000000000,'Hg','Mercury'),(81,'13',6,81,204.383300000000000,'Tl','Thallium'),(82,'14',6,82,207.200000000000000,'Pb','Lead'),(83,'15',6,83,208.980380000000000,'Bi','Bismuth'),(84,'16',6,84,210.000000000000000,'Po','Polonium'),(85,'17',6,85,210.000000000000000,'At','Astatine'),(86,'18',6,86,222.000000000000000,'Rn','Radon'),(87,'1',7,87,223.000000000000000,'Fr','Francium'),(88,'2',7,88,226.000000000000000,'Ra','Radium'),(89,'',7,89,227.000000000000000,'Ac','Actinium'),(90,'',7,90,232.038100000000000,'Th','Thorium'),(91,'',7,91,231.035880000000000,'Pa','Protactinium'),(92,'',7,92,238.028910000000000,'U','Uranium'),(93,'',7,93,237.000000000000000,'Np','Neptunium'),(94,'',7,94,244.000000000000000,'Pu','Plutonium'),(95,'',7,95,243.000000000000000,'Am','Americium'),(96,'',7,96,247.000000000000000,'Cm','Curium'),(97,'',7,97,247.000000000000000,'Bk','Berkelium'),(98,'',7,98,251.000000000000000,'Cf','Californium'),(99,'',7,99,254.000000000000000,'Es','Einsteinium'),(100,'',7,100,257.000000000000000,'Fm','Fermium'),(101,'',7,101,260.000000000000000,'Md','Mendelevium'),(102,'',7,102,259.000000000000000,'No','Nobelium'),(103,'3',7,103,262.000000000000000,'Lr','Lawrencium'),(104,'4',7,104,261.000000000000000,'Rf','Rutherfordium'),(105,'5',7,105,262.000000000000000,'Db','Dubnium'),(106,'6',7,106,266.000000000000000,'Sg','Seaborgium'),(107,'7',7,107,262.000000000000000,'Bh','Bohrium'),(108,'8',7,108,265.000000000000000,'Hs','Hassium'),(109,'9',7,109,266.000000000000000,'Mt','Meitnerium'),(110,'10',7,110,281.000000000000000,'Ds','Darmstadtium'),(111,'11',7,111,272.000000000000000,'Rg','Roentgenium'),(112,'12',7,112,285.000000000000000,'Cn','Copernicium'),(113,'13',7,113,284.000000000000000,'Uut','Ununtrium'),(114,'14',7,114,289.000000000000000,'Fl','Flerovium'),(115,'15',7,115,288.000000000000000,'Uup','Ununpentium'),(116,'16',7,116,293.000000000000000,'Lv','Livermorium'),(117,'17',7,117,294.000000000000000,'Uus','Ununseptium'),(118,'18',7,118,294.000000000000000,'Uuo','Ununoctium');
/*!40000 ALTER TABLE `Elements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Questions`
--

DROP TABLE IF EXISTS `Questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Questions` (
  `Question_id` int NOT NULL AUTO_INCREMENT,
  `Class_id` int NOT NULL,
  `Question_type` varchar(100) NOT NULL,
  `Question_text` varchar(3000) NOT NULL,
  `Question_answers` varchar(500) NOT NULL,
  `Question_tag` varchar(200) NOT NULL,
  `Question_diagram_url` varchar(500) NOT NULL,
  `Step_1` varchar(2000) NOT NULL,
  `Step_2` varchar(2000) NOT NULL,
  `Step_3` varchar(2000) NOT NULL,
  `Step_4` varchar(2000) NOT NULL,
  `Step_1_answers` varchar(500) NOT NULL,
  `Step_2_answers` varchar(500) NOT NULL,
  `Step_3_answers` varchar(500) NOT NULL,
  `Step_4_answers` varchar(500) NOT NULL,
  `formula` varchar(1000) NOT NULL,
  PRIMARY KEY (`Question_id`),
  KEY `Class_id` (`Class_id`),
  CONSTRAINT `Questions_ibfk_1` FOREIGN KEY (`Class_id`) REFERENCES `Class` (`Class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Questions`
--

LOCK TABLES `Questions` WRITE;
/*!40000 ALTER TABLE `Questions` DISABLE KEYS */;
INSERT INTO `Questions` VALUES (1,1,'Bonds','How many bonds does this particle have?','25,25.0,25.00','Bonds','63fbe3a243f77.png','How many bonds can Hydrogen form?','How many bonds can Oxygen form?','How many bonds can Sulfur form?','What is the sum of all these','1,1.0','2,2.0','6,6.0','25,25.0,25.00','a'),(2,1,'sdasdas','Enter Question Text Here!','Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00','Enter Tags Here In Comma Seperated Format ex: introductory,isotopes,elements','dasdda','Enter Question Step Text Here!','Enter Question Step Text Here!','Enter Question Step Text Here!','Enter Question Step Text Here!','Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00','Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00','Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00','Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00','Enter Formula To Use Here'),(3,1,'adsda','daasd','dads','dadsads','sdadsa','dsasd','sadasddas','saddas','asdsadaad','dsadsd','sdadasd','sadadsds','dssadda','SDasdasd'),(4,1,'adsda','daasd','dads','dadsads','sdadsa','dsasd','sadasddas','saddas','asdsadaad','dsadsd','sdadasd','sadadsds','dssadda','SDasdasd'),(5,1,'adsda','daasd','dads','dadsads','sdadsa','dsasd','sadasddas','saddas','asdsadaad','dsadsd','sdadasd','sadadsds','dssadda','SDasdasd'),(6,1,'adsda','daasd','dads','dadsads','sdadsa','dsasd','sadasddas','saddas','asdsadaad','dsadsd','sdadasd','sadadsds','dssadda','SDasdasd'),(8,1,'text','Please find the Molar Mass of Hydrogen','1,1.0,1.00,01,01.0','elements','n/a','Look at the table of elements\r\n\r\ntype yes in the box below when you have done so','Look at the table of elements\r\n\r\ntype yes in the box below when you have done so','Look at the table of elements\r\n\r\ntype yes in the box below when you have done so','Enter Question Step Text Here!','yes','yes','yes','Look at the table of elements\r\n\r\ntype yes in the box below when you have done so','yes');
/*!40000 ALTER TABLE `Questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Responses`
--

DROP TABLE IF EXISTS `Responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Responses` (
  `Entry_id` int NOT NULL AUTO_INCREMENT,
  `Question_list_id` int NOT NULL,
  `Attempt_id` int DEFAULT NULL,
  `Response` varchar(5000) NOT NULL,
  `Correct` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Entry_id`),
  KEY `Question_list_id` (`Question_list_id`),
  KEY `Attempt_id` (`Attempt_id`),
  CONSTRAINT `Responses_ibfk_2` FOREIGN KEY (`Attempt_id`) REFERENCES `Attempts` (`Attempt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Responses`
--

LOCK TABLES `Responses` WRITE;
/*!40000 ALTER TABLE `Responses` DISABLE KEYS */;
INSERT INTO `Responses` VALUES (1,1,1,'hi',1),(2,2,1,'hi',1),(3,3,1,'hi',0),(4,8,35,'1',1),(5,8,36,'2',0),(6,8,36,'2',0),(7,8,37,'2',0),(8,8,37,'1',1),(9,8,37,'1',1),(10,8,37,'2',0),(11,8,37,'1',1),(12,8,37,'1',1),(13,8,38,'2',0),(14,8,38,'1',1),(15,8,38,'1',1),(16,8,38,'2',0),(17,8,38,'1',1),(18,8,38,'1',1),(19,8,39,'2',0),(20,8,39,'1',1),(21,8,39,'1',1),(22,8,39,'2',0),(23,8,39,'1',1),(24,8,39,'1',1),(25,8,40,'2',0),(26,8,40,'1',1),(27,8,40,'1',1),(28,8,40,'2',0),(29,8,40,'1',1),(30,8,40,'1',1),(31,8,41,'2',0),(32,8,41,'1',1),(33,8,41,'1',1),(34,8,41,'2',0),(35,8,41,'1',1),(36,8,41,'1',1),(37,1,42,'',0),(38,1,43,'',0),(39,1,44,'',0),(40,1,45,'',0),(41,1,46,'',0),(42,1,46,'25',1),(43,1,47,'',0),(44,1,48,'',0),(45,1,49,'',0),(46,8,49,'',0),(47,1,50,'',0),(48,1,51,'',0),(49,1,51,'',0),(50,1,51,'',0),(51,1,51,'',0),(52,1,51,'',0),(53,1,51,'',0),(54,1,51,'',0),(55,1,51,'25',1),(56,8,51,'1',1),(57,1,53,'',0),(58,1,53,'25',1),(59,8,53,'',0),(60,8,53,'',0),(61,8,53,'1',1),(62,1,54,'',0),(63,3,54,'',0),(64,1,55,'',0),(65,1,55,'23',0),(66,1,55,'23',0),(67,1,55,'23',0),(68,1,55,'23',0),(69,1,55,'23',0),(70,1,55,'23',0),(71,1,55,'23',0),(72,1,59,'',0),(73,1,60,'',0);
/*!40000 ALTER TABLE `Responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(70) NOT NULL,
  `Last_Name` varchar(100) DEFAULT NULL,
  `Email` varchar(70) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Class_1` varchar(100) DEFAULT NULL,
  `Class_2` varchar(100) DEFAULT NULL,
  `Class_3` varchar(100) DEFAULT NULL,
  `Class_4` varchar(100) DEFAULT NULL,
  `Class_5` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'admin','admin','admin@gmail.com','$2y$10$rjtpRl1tFhDzPvirZk6t8uH.gArSAe0XIx0qtjiIyWOlTLV.hDqVa','admin','1','2','3','4','5'),(2,'student','student','student@gmail.com','$2y$10$gT4ZREhgXmA/rA2EWk2naOaMGYBpOZiI1I7U.ZoTPRM6Z6BCu5VOW','student','1','2','3','4','5'),(3,'professor','professor','professor@gmail.com','$2y$10$.jeZfKBoO5vgE.dTgWAZ4OqllhRxRuG92ckfN9Jg97cDoRAHXgD6e','professor',NULL,NULL,NULL,NULL,NULL),(4,'loltest','loltest','loltest','$2y$10$Qn9pHPiPMlLrZBoFOFGZxeH.1KqRTDoX6omeXny.9xsXJNkMvZ0pu','loltest',NULL,NULL,NULL,NULL,NULL),(5,'student2','student2','student2@gmail.com','$2y$10$lFMrkETz7aLr6jryxD.wie/ApibMk.WzLQvQul0MyihK1TJwyo8Xu','student','5','6',NULL,NULL,NULL),(6,'lol','lol','lol','$2y$10$MS4bnagAt.X3mS3wR6XxX.QG5UNjbHNq6dcyVRZr/is0exkTsGMzq','lol',NULL,NULL,NULL,NULL,NULL),(7,'lol','lol','lol','$2y$10$1uqGyuaAIm.dT15ORU990ewZU8FxvyNZ9IgbMAA5jVN4Ci54vKXsm','lol',NULL,NULL,NULL,NULL,NULL),(8,'lol','lol','lol','$2y$10$RCUBX9UOHddeFnzYtcfRuuJhTdUso4ObXojdYCGhpMnUnc2zgfUei','lol',NULL,NULL,NULL,NULL,NULL),(9,'lol','lol','lol','$2y$10$J88.K0EHvJ3KXUSyU7.50u778PddjBQ822slIPFTPrplDYCMkIZEe','lol',NULL,NULL,NULL,NULL,NULL),(10,'lol','lol','lol','$2y$10$uWFtqYqcCJAjOe2lOasZcOEnxW/HktjndNQj.7fqy7kS5.S6hnOwy','lol',NULL,NULL,NULL,NULL,NULL),(11,'lol','lol','lol','$2y$10$f1XmdWfC//WOzbyTFulyRus1TZecFnp.DB4B6tw6QVNafGro0j5p2','lol',NULL,NULL,NULL,NULL,NULL),(12,'lol','lol','lol','$2y$10$H6FD398anB9W6VFcxUNQ4.Im26jb/2CK8IZg2AGyWCDuclR1fNzDu','lol',NULL,NULL,NULL,NULL,NULL),(13,'lol','lol','lol','$2y$10$DzJryjQ1XieqTHTg.7i8yuqkeMbQvMgC7kmlZi8w4leKC/slZK/MC','lol',NULL,NULL,NULL,NULL,NULL),(14,'lol','lol','lol','$2y$10$QW9UtL3O.ZVEZhKjVRU.duqWX.j3gYkOae0oNSIIsUKM29NpjpCR.','lol',NULL,NULL,NULL,NULL,NULL),(15,'lol','lol','lol','$2y$10$w/Ou37mAI1jkQUp2EBVfleXJZ0POTOkh1TzjqXNMehTdjSj0HsS4W','lol',NULL,NULL,NULL,NULL,NULL),(16,'lol','lol','lol','$2y$10$kGfQ7hIxyAzqxaW8vS8D7u/JHd7KENO3350g6PjoLz5HooNpyd9w.','lol',NULL,NULL,NULL,NULL,NULL),(17,'lol','lol','lol','$2y$10$aSq2m4og/.lFTEASmzS.S.uYnKBHgMNEEpqxDnB/NY8UdPbNVLu3O','lol',NULL,NULL,NULL,NULL,NULL),(18,'aaa','lolaaa','lolaaa','$2y$10$8Nd6RPbgTApdrGM.GUaMxeIOdVxGdhyIK1Py/bqknyOKa5nErH8Hq','lolaa',NULL,NULL,NULL,NULL,NULL),(19,'aaaa','lolaaaaa','lolaaaaa','$2y$10$C93BCRRhdxtmr36bvbgYnuSiIM2GZ569ZPBWH5XDlAU9WM5/vVDr.','lolaab',NULL,NULL,NULL,NULL,NULL),(20,'c','c','c','$2y$10$39k2UWHOdbBXEF2mK69HWuPqXIhgYm2p1cpvoV52MwtRS4gkFxmW6','c',NULL,NULL,NULL,NULL,NULL),(21,'c','c','c','$2y$10$lpp/XXy0hrQhY59oJtCcGOq4BqVe1jJEo9orJ/hHxCrozStEs3wti','c',NULL,NULL,NULL,NULL,NULL),(22,'c','c','c','$2y$10$UEapuqhj0hbvYIPcLjesTedpD0UwlXY1A7Cuhzo9oqPDv/RQDmk3W','c',NULL,NULL,NULL,NULL,NULL),(23,'c','c','c','$2y$10$Y/Gz87DBDwZwJLl/m0FzXuUUHQWYkqMq/ZsP0KYtpYhw8wvBvn.76','c',NULL,NULL,NULL,NULL,NULL),(24,'c','c','c','$2y$10$H52DGBwMNXPb5Rvqgc0hpuL1pLzTZ0d0EOZpceWn9ahgBb.zkNUK2','c',NULL,NULL,NULL,NULL,NULL),(25,'c','c','c','$2y$10$pKd7H53BDazZ/3kl/FormuOppcZUbbzC06ELMUvxCBEOXs7p5j02a','c',NULL,NULL,NULL,NULL,NULL),(26,'c','c','c','$2y$10$TGZiW2kz3P6v.ZrS/P7OK.nbuHbu3WCGX0T6dNU9.hNnLFbZS9Y0S','c',NULL,NULL,NULL,NULL,NULL),(27,'b','c','c','$2y$10$qVIuOtUJDeLBaEiCaGiTK.bechQlmpCh2jGI3X1fnmay3MoWMhkJu','c',NULL,NULL,NULL,NULL,NULL),(28,'b','c','c','$2y$10$BehRGef6x1sD0xeCOUfmhuECxG8rhPKJSjn3Mug6Q0ognmPUsQ72G','c',NULL,NULL,NULL,NULL,NULL),(29,'b','c','c','$2y$10$tWYq1xLvDmwhJ6Ar26ZeDO3aFTBeCaECH4cKEMjVawp5CVXQQU7au','c',NULL,NULL,NULL,NULL,NULL),(31,'loltest','loltest','loltest','$2y$10$Nsg3vwf4ImfQ6CFnA0GG6ONgmAHMtVmC/6liOwwj7xytWeZzDPj/S','loltest',NULL,NULL,NULL,NULL,NULL),(32,'loltest','loltest','loltest','$2y$10$mEhul.O89hkMXeByiEZ0EeElHE9kciGWWCPYmH0map1ZpFHeOMbcC','loltest',NULL,NULL,NULL,NULL,NULL),(33,'a','a','a','a','student','1',NULL,NULL,NULL,NULL),(34,'a','a','a','a','student','1',NULL,NULL,NULL,NULL),(35,'a','a','a','a','student',NULL,'2',NULL,NULL,NULL),(36,'a','a','a','a','student',NULL,NULL,'3',NULL,NULL),(37,'a','a','a','a','student',NULL,NULL,NULL,'4',NULL),(38,'a','a','a','a','student',NULL,NULL,NULL,NULL,'5'),(40,'Michael','Brand','mbrand@boog.com','$2y$10$LpOTO2LXBtvpJA8jYTUg3OyeHQjhfkVyc7nJY/Ugi5Pf1ddwr.KIy','student',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-02 19:06:56
