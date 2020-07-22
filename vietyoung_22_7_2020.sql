-- MySQL dump 10.14  Distrib 5.5.60-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: vietyoung
-- ------------------------------------------------------
-- Server version	5.5.60-MariaDB

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
-- Table structure for table `editor`
--

DROP TABLE IF EXISTS `editor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_User` int(11) NOT NULL,
  `Type` int(11) NOT NULL DEFAULT '0',
  `Chuyen_Nganh` varchar(100) NOT NULL,
  `File_Info_Editor` varchar(100) DEFAULT NULL,
  `Status` varchar(50) DEFAULT '0',
  `Completed_order` int(11) NOT NULL DEFAULT '0',
  `Order_Process` int(11) NOT NULL DEFAULT '0',
  `Score` int(11) NOT NULL DEFAULT '0',
  `Rating` double(10,1) NOT NULL DEFAULT '0.0',
  `Status_Active` int(11) DEFAULT '0',
  `Salary` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_User` (`Id_User`),
  CONSTRAINT `FK_IdUser` FOREIGN KEY (`Id_User`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editor`
--

LOCK TABLES `editor` WRITE;
/*!40000 ALTER TABLE `editor` DISABLE KEYS */;
INSERT INTO `editor` VALUES (1,21,0,'7','ROoCZlzfoRhNhR5oq7TP.docx','0',1,0,10,10.0,2,59.5);
/*!40000 ALTER TABLE `editor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `Id_Order` int(11) NOT NULL,
  `Feedbacks` varchar(1000) DEFAULT NULL,
  `Date_Time` datetime NOT NULL,
  `Rate` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id_Order`),
  CONSTRAINT `FK_IDORDER_IDPOST` FOREIGN KEY (`Id_Order`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,NULL,'2019-02-25 00:30:59',5);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Author` int(11) NOT NULL,
  `Type_of_services` varchar(50) NOT NULL,
  `Type_of_paper` varchar(50) NOT NULL,
  `Subject_area` varchar(50) NOT NULL,
  `Type_of_currency` varchar(50) NOT NULL DEFAULT '30',
  `Writer_Level` int(11) DEFAULT NULL,
  `Customer_Service` int(11) DEFAULT NULL,
  `File_Name` varchar(50) NOT NULL,
  `Topic` varchar(1000) DEFAULT NULL,
  `PageNumbers` int(11) NOT NULL,
  `Date_Create` datetime NOT NULL,
  `Day` int(11) NOT NULL DEFAULT '0',
  `Deadline` datetime NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'New',
  `Token_Order` varchar(50) NOT NULL,
  `Order_Code` varchar(50) NOT NULL,
  `Status_Order` varchar(50) NOT NULL,
  `Payment_Method` varchar(50) NOT NULL,
  `Id_Editor` int(11) DEFAULT '0',
  `Decription` varchar(1000) DEFAULT NULL,
  `Date_Edit` datetime DEFAULT NULL,
  `Date_Finish` datetime DEFAULT NULL,
  `File_Editor_Completed` varchar(100) DEFAULT NULL,
  `Price` double DEFAULT '0',
  `Status_Sort` int(11) NOT NULL DEFAULT '3',
  `Status_Salary_Editor` varchar(5) NOT NULL DEFAULT 'No',
  `Date_Salary_Editor` datetime DEFAULT NULL,
  `Money_Editor` double DEFAULT '0',
  `Status_Rewrite` varchar(50) DEFAULT NULL,
  `Id_Old_Post` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_IdUserCreatePost` (`Id_Author`),
  KEY `FK_IdEditor` (`Id_Editor`),
  CONSTRAINT `FK_IdUserCreatePost` FOREIGN KEY (`Id_Author`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,22,'1','7','13','30',26,23,'W2uJo24LMwwkSUMG6IMY.docx','asefasef',9,'2019-02-25 00:29:01',14,'2019-03-11 00:29:01','Completed','23958607-876d034a195f29e73c2923704db4f2ee','0.67853200 1551029340','Paided','NGAN LUONG',1,'asefasef','2019-02-25 00:29:58','2019-02-25 00:30:25','reKoysdf2Ng5GLEM_hge.docx',85,3,'Yes','2019-02-25 00:33:28',59.5,NULL,NULL);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rewrite`
--

DROP TABLE IF EXISTS `rewrite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rewrite` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Order` int(11) NOT NULL,
  `File_Rewrite_Author` varchar(50) DEFAULT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Rewrite',
  `Description` varchar(1000) DEFAULT NULL,
  `Date_Rewrite_Author` datetime DEFAULT NULL,
  `File_Editor_Reup` varchar(50) DEFAULT NULL,
  `Date_Editor_Reup` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`,`Id_Order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rewrite`
--

LOCK TABLES `rewrite` WRITE;
/*!40000 ALTER TABLE `rewrite` DISABLE KEYS */;
/*!40000 ALTER TABLE `rewrite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'superadmin'),(2,'admin'),(3,'editor'),(4,'register'),(5,'IT');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name_Service` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'Type Of Service'),(2,'Type Of Paper'),(3,'Subject Area'),(4,'Type Of Payment'),(5,'Writer level'),(6,'Customer service'),(7,'Urgency'),(8,'Writer level'),(9,'Customer service'),(10,'Price of Page'),(11,'Currency');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_price`
--

DROP TABLE IF EXISTS `service_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_price` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name_Service_Price` varchar(50) NOT NULL,
  `Id_Service` int(11) NOT NULL,
  `Price_USA` double NOT NULL,
  `Price_VN` double NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_IDSERVICE_SERVICEID` (`Id_Service`),
  CONSTRAINT `FK_IDSERVICE_SERVICEID` FOREIGN KEY (`Id_Service`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_price`
--

LOCK TABLES `service_price` WRITE;
/*!40000 ALTER TABLE `service_price` DISABLE KEYS */;
INSERT INTO `service_price` VALUES (1,'Math/Physic/Economic/Statistic Problems',1,10,10000),(2,'Rewriting',1,10,10000),(3,'Proofreading',1,10,10000),(4,'Editing',1,10,10000),(5,'Copywriting',1,10,10000),(6,'Admission Services',1,10,10000),(7,'Essay',2,10,10000),(8,'Term Paper',2,10,10000),(9,'Research Paper',2,10,10000),(10,'Coursework',2,10,10000),(11,'Book report',2,10,10000),(12,'Book review',2,10,10000),(13,'Architecture',3,10,10000),(14,'Movies',3,10,10000),(15,'Music',3,10,10000),(16,'Paintings',3,10,10000),(17,'14',7,10,10000),(18,'10',7,12,15000),(19,'7',7,15,20000),(20,'5',7,17,22000),(21,'3',7,20,25000),(23,'Free',9,0,0),(24,'+$5.99% ADVANCED',9,5.99,5.99),(25,'+$9.99% PREMIUM',9,9.99,9.99),(26,'Free BASIC',8,0,0),(27,'+25% Premium',8,25,25),(28,'+30% Top 10',8,30,30),(29,'Prices Of Page',10,5,10000),(30,'USD',4,10,10),(31,'VND',4,0,0),(32,'VND',11,1,23155);
/*!40000 ALTER TABLE `service_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_writer`
--

DROP TABLE IF EXISTS `skill_writer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill_writer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `NameSkill` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_writer`
--

LOCK TABLES `skill_writer` WRITE;
/*!40000 ALTER TABLE `skill_writer` DISABLE KEYS */;
INSERT INTO `skill_writer` VALUES (1,'Art'),(2,'Business'),(3,'Communications&Media'),(4,'Economics'),(5,'Engineering'),(6,'English'),(7,'Healthcare&Medicine'),(8,'History'),(9,'IT & Technology'),(10,'Law'),(11,'Literature'),(12,'Management'),(13,'Marketing'),(14,'Mathematics'),(15,'Natural Science'),(16,'Pedagogy'),(17,'Philosophy'),(18,'Political Science'),(19,'Psychology'),(20,'Sociology'),(21,'Statistics'),(22,'Education');
/*!40000 ALTER TABLE `skill_writer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_editor`
--

DROP TABLE IF EXISTS `status_editor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_editor` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Status_Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_editor`
--

LOCK TABLES `status_editor` WRITE;
/*!40000 ALTER TABLE `status_editor` DISABLE KEYS */;
INSERT INTO `status_editor` VALUES (1,0,'Searching for orders'),(2,1,'Open to suggestions');
/*!40000 ALTER TABLE `status_editor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp_post`
--

DROP TABLE IF EXISTS `tmp_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_post` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Author` int(11) NOT NULL,
  `Token_Order` varchar(50) DEFAULT NULL,
  `Order_Code` varchar(50) DEFAULT NULL,
  `Type_of_services` varchar(50) NOT NULL,
  `Type_of_paper` varchar(50) NOT NULL,
  `Subject_area` varchar(50) NOT NULL,
  `Type_of_currency` varchar(50) NOT NULL DEFAULT '30',
  `Writer_Level` int(11) DEFAULT NULL,
  `Customer_Service` int(11) DEFAULT NULL,
  `File_Name` varchar(50) NOT NULL,
  `Topic` varchar(1000) NOT NULL,
  `PageNumbers` int(11) NOT NULL,
  `Date_Create` datetime NOT NULL,
  `Day` int(11) DEFAULT '0',
  `Deadline` datetime NOT NULL,
  `Id_Editor` int(11) DEFAULT '0',
  `Decription` varchar(1000) DEFAULT NULL,
  `Price` double NOT NULL,
  `Status` varchar(20) DEFAULT 'New',
  `Payment_Method` varchar(50) DEFAULT NULL,
  `Status_Order` varchar(50) NOT NULL DEFAULT 'No Payment',
  `Status_Rewrite` varchar(50) DEFAULT NULL,
  `Id_Old_Post` int(11) DEFAULT NULL,
  `Token_Rewrite` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp_post`
--

LOCK TABLES `tmp_post` WRITE;
/*!40000 ALTER TABLE `tmp_post` DISABLE KEYS */;
INSERT INTO `tmp_post` VALUES (1,22,'23958607-876d034a195f29e73c2923704db4f2ee','0.67853200 1551029340','1','7','13','30',26,23,'W2uJo24LMwwkSUMG6IMY.docx','asefasef',9,'2019-02-25 00:29:01',14,'2019-03-11 00:29:01',1,'asefasef',85,'New','NGAN LUONG','No Payment',NULL,NULL,NULL),(2,22,'23958701-91c0af4410aae94b61fe312d798b6f88','0.82920300 1551029539','1','7','13','30',NULL,NULL,'Of2Ils5VVcczQWhShTjk.docx','asefasef',9,'2019-02-25 00:31:56',14,'2019-03-11 00:31:56',1,'asefasef',85,'New','NGAN LUONG','No Payment','1',1,'6IxV0SGEAeph82nvgBCR');
/*!40000 ALTER TABLE `tmp_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EmailID` varchar(50) NOT NULL,
  `Phone_Number` varchar(15) DEFAULT NULL,
  `Password_hash` varchar(255) NOT NULL,
  `IsEmailVerified` int(1) NOT NULL DEFAULT '0',
  `Auth_key` varchar(255) NOT NULL,
  `Password_reset_token` varchar(255) DEFAULT NULL,
  `Image` varchar(50) DEFAULT NULL,
  `Date_Create` datetime NOT NULL,
  `Status` varchar(20) DEFAULT '1',
  `Role` int(2) NOT NULL,
  `Request_Editor` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `EmailID` (`EmailID`),
  KEY `Password_reset_token` (`Password_reset_token`),
  KEY `FK_User_Role` (`Role`),
  CONSTRAINT `FK_User_Role` FOREIGN KEY (`Role`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Trần','Xuân Thời','xuanthoiqn144@gmail.com','+84706190956','$2y$13$rfgy8OeYKGCYI0TFsXpAd.auT1dzvMhBDcwPPuZLCxmtMHs8Am/1K',1,'','','','2018-07-04 00:00:00','1',3,0),(17,'tran ','Xuan Thoi','xuanthoiqn97@gmail.com','+84706190956','$2y$13$sLMD2.hZj0MKeSoEamwQceMAKbdEBzzhvtW9bU7xCIILRlgjQRDIK',1,'ApoagS8USdfpNZsZhJsY7ETJ-bsHJjDA_1547218700',NULL,'_GeuSkcByH5qzCf7YEGf.png','2019-01-11 21:58:20','1',1,0),(21,'tran Xuan','Thoi','xuanthoiqn1997@gmail.com','123456789','$2y$13$PsH4GvpSXgiaEjwSnbNCRe7.xTkLAj4p0Irg0ahsen2Ai.z2x0EgO',1,'S-OdWqWOGgaB6wCD2fFAYoe3SM96A33-_1548176539',NULL,'LdQNm0AonWMLhOIxTzL8.png','2019-01-23 00:02:19','1',3,0),(22,'nguyen ','Xuan','xuanthoiqn44@gmail.com','+847061892612','$2y$13$4O38lSjmFH1M24to5QbLou6YpN7m6YjfVpPZrp71ow1l9WI9IkUsi',1,'uXxTQUWj8JTuf8GhMqkWsUWmN3qfazJQ_1549639201',NULL,'wIcm_iu2gcq6nb99x2yI.png','2019-02-08 22:20:01','1',4,0),(30,'fasef','asefasef','xasef@gmail.com','67123471234','$2y$13$6GZ5NVKKVM9vSSFqOEfjBuMQHZ7tISuNkS0OhkDHX4aH/50uLlnz6',0,'S2IgCWzABvUDTjKRgwOsiEyhj_nw-dgS_1550073759',NULL,NULL,'2019-02-13 23:02:39','1',3,0),(31,'asefasef','asefasef','asefase@gmail.com','72834928347','$2y$13$orQ14qLO77VxlrAvpjDuyO9R504KraGOz8Hkx08pjz575gqSEJSh.',0,'CouRVDLHBTTb7uMTYRy4Y3spYFtS9B50_1550073784',NULL,NULL,'2019-02-13 23:03:04','0',4,0),(32,'áefasef','áefasef','aaa@gmail.com','+84123123123123','$2y$13$HjMx6qCjtBn4.YVvvajfR.Sd.Ue8APVN/GMTce9gYqM54CCoDSsNu',0,'j9scPcSr60MuwdTQ9R8zysYnVuuLkfD2_1554454275',NULL,NULL,'2019-04-05 15:51:15','1',4,0);
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

-- Dump completed on 2020-07-22  7:26:11
