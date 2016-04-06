-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: DermDash
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'micah','mkc@aol.com','Hebrews136','2016-04-05 15:48:56','2016-04-05 19:47:26'),(5,'kobebryant24','blackmamba@lakers.org','Hebrews136','2016-04-05 16:42:20','2016-04-05 20:06:26'),(6,'chefcurry','chefcurrywiththepot@warriors.tv','asddfgh12','2016-04-05 16:45:25','2016-04-05 16:45:25'),(7,'asdfas','qwerq','123','2016-04-05 17:53:16','2016-04-05 17:53:16'),(8,'jones','jones@indiana.com','hebrews136','2016-04-05 18:30:53','2016-04-05 18:30:53'),(9,'asdf','asdf@asdfa.com','asdfgh123','2016-04-05 18:31:23','2016-04-05 18:31:23'),(10,'bob','bob@bob.com','hebrews136','2016-04-05 18:40:58','2016-04-05 18:40:58'),(11,'dwade','dwade3@heat.com','asdfgh12','2016-04-05 20:14:04','2016-04-05 20:14:04'),(12,'asdfasdf','asdfa@kapoina.com','asdfgh12','2016-04-05 20:23:44','2016-04-05 20:23:44'),(13,'luke','luke@skywalker.com','asdfgh12','2016-04-05 20:24:55','2016-04-05 20:24:55'),(14,'tom','tommy@aol.com','hebrews136','2016-04-05 20:31:05','2016-04-05 20:31:05'),(15,'jo','joe@johnson.com','hebrews136','2016-04-05 20:31:58','2016-04-05 20:31:58'),(16,'lo','lobcity@clippers.com','asdfgh12','2016-04-05 20:42:51','2016-04-05 20:42:51'),(17,'he','hee@tee.com','Asdfgh12','2016-04-05 20:44:56','2016-04-05 20:44:56'),(18,'yoyo','yoyo@ma.com','Asdfgh12','2016-04-05 20:45:15','2016-04-05 20:45:15'),(19,'jenna','sportsgirl98@yahoo.com','Asdfgh12','2016-04-05 20:49:49','2016-04-05 20:49:49'),(20,'Barnabas','barnabasfink@gmail.com','JohnDoe1','2016-04-05 20:51:26','2016-04-05 20:51:26');
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

-- Dump completed on 2016-04-05 20:56:41
