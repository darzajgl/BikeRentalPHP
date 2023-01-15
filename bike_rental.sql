-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bike_rental
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (2,'administrator@example.com','administrator','$2y$10$kQwq4C1sXr/OBLb2qETv8.MShw2MStLeQtmLz2kBBEeZcaTat5jiK');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bikes`
--

DROP TABLE IF EXISTS `bikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bikes` (
  `bike_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`bike_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bikes`
--

LOCK TABLES `bikes` WRITE;
/*!40000 ALTER TABLE `bikes` DISABLE KEYS */;
INSERT INTO `bikes` VALUES (1,'Rower górski','Rower górski z wysokiej jakości komponentami',22.00,'images/mtb1.jpg'),(2,'Rower szosowy','Rower z lekką ramą i oponami typu slick',25.00,'images/road1.jpg'),(3,'Rower miejski','Rower miejski z wygodnym siodełkiem i koszem',18.00,'images/city1.jpg'),(4,'Rower elektryczny','Rower elektryczny z silnikiem o mocy 500 W',35.00,'images/electric1.jpg'),(5,'Rower gravel','Do wszechstronnych zastosowań',28.00,'images/gravel1.jpg'),(11,'Rowerek dziecięcy','Dla najmłodszych',12.00,'images/dog.jpg'),(13,'Rower towarowy','Do transportu ładunku',40.00,'images/Towarowy1.jpg');
/*!40000 ALTER TABLE `bikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rentals`
--

DROP TABLE IF EXISTS `rentals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bike_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`rental_id`),
  KEY `user_id` (`user_id`),
  KEY `bike_id` (`bike_id`),
  CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`bike_id`) REFERENCES `bikes` (`bike_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rentals`
--

LOCK TABLES `rentals` WRITE;
/*!40000 ALTER TABLE `rentals` DISABLE KEYS */;
INSERT INTO `rentals` VALUES (82,1,5,'2023-09-03','2023-11-05'),(85,9,13,'2023-01-12','2023-01-15'),(86,7,5,'2023-05-05','2023-05-25'),(87,8,11,'2023-01-12','2023-01-15'),(88,7,4,'2023-02-04','2023-02-26'),(89,7,4,'2023-01-29','2023-03-22'),(94,9,4,'2023-02-05','2023-04-14'),(95,9,4,'2023-02-05','2023-04-14'),(98,10,13,'2023-01-13','2023-01-21'),(99,10,1,'2023-01-13','2023-01-21'),(100,7,11,'2023-01-20','2023-01-26'),(101,7,11,'2023-01-14','2023-01-29'),(102,7,13,'2023-01-26','2023-02-05'),(104,7,3,'2023-01-26','2023-03-31'),(105,7,5,'2023-01-14','2023-01-27'),(106,13,11,'2023-01-13','2023-02-05'),(107,7,3,'2023-01-26','2023-01-28'),(108,7,3,'2023-01-15','2023-01-26'),(109,7,11,'2023-01-16','2023-01-22'),(110,1,1,'2023-01-19','2023-01-28'),(111,13,5,'2023-01-10','2023-02-05');
/*!40000 ALTER TABLE `rentals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house_number` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jan','Kowalski','jkowalski','abc123','jkowalski@gmail.com','ul. Krakowska','15','31-123','Kraków'),(7,'Arkadiusz','Kowal','arek','$2y$10$pxtw06M9Vd6105xRIs6JT.gYwlIcjfpQZtzySUpJuf7m/SgX61bpu','darzajgl@gmail.com','Fabryczna','11/23','00-002','Piła'),(8,'Pan','Administrator','administrator','$2y$10$kQwq4C1sXr/OBLb2qETv8.MShw2MStLeQtmLz2kBBEeZcaTat5jiK','pandarius1515@gmail.com','Bakaliowa','33/88','00-212','Sopot'),(9,'Zygmunt','Bobrowski','boberek','$2y$10$vIlbHy8v6ifMgOL9yNdxSOoNJ0AsOIob0Mu9CrQJP3rCpaQaf2Ur.','boberek@boberek.com','Bobrowska','11/33','33-222','Grudziądz'),(10,'Klaudiusz','Puchalski','puchatek','$2y$10$erHunj5ilis9LgJaG0JxSO1ch0cQstiHZunQagsddjtyOWlsEboea','puchatek@puchatek.com','Puchacka','9/2','99-111','Wałbrzych'),(11,'Jakub','Strączyński','straczek','$2y$10$pWg2S/9Y4i91FDH4izVNvOU3eLOM7FyjETwp1PwbsmdxoQNKU3mHW','straczek@straczek.com','Sieradzka','2','22-311','Sieradz'),(12,'Jeremiasz','Pawłowski','pawelek','$2y$10$gbVK41O9D3rtAZ27Cf504eWwNYIutPNYR/Hik3ywBaNE9MaJ/gVW2','pawelek@pawelek.com','Pawłowska','8','88-001','Kłodzko'),(13,'Ireneusz','Mazowiecki','mazgajek','$2y$10$c1rZwV2GqH0wxethWVcPce8rVNNGYB8BwaaaMc8II9A5v/0MbhjXq','mazgaj@mazgaj.com','Mleczarska','7','22-991','Mrągowo'),(14,'Kazimierz','Kaczmarski','kaczor','$2y$10$fP3sVUDVM..Gsk/u1sqPLucOe49gCwdJZSEVwkmcp1fzxGFK0uRdG','kaczor@kaczor.com','Kaczkowska','22/1','55-123','Rybnik');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-15 14:22:55
