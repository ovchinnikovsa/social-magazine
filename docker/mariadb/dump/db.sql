-- MariaDB dump 10.19  Distrib 10.9.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: soc_db
-- ------------------------------------------------------
-- Server version	10.9.8-MariaDB-1:10.9.8+maria~ubu2204

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `precategory_ru` varchar(16) NOT NULL,
  `category_ru` varchar(16) NOT NULL,
  `subcategory_ru` varchar(16) NOT NULL,
  `delete` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'games','games','games',0),
(2,'food','streetfood','pizza',1),
(3,'king','gunslinger','gunslinger',1),
(4,'king','gunslinger','train',1),
(5,'music','metal','archspire',1),
(6,'music','rock','soad',1),
(7,'games','strategy','heroes',1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf`
--

DROP TABLE IF EXISTS `conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf`
--

LOCK TABLES `conf` WRITE;
/*!40000 ALTER TABLE `conf` DISABLE KEYS */;
INSERT INTO `conf` VALUES
(1,'adm_login','admin'),
(2,'adm_password','admin123');
/*!40000 ALTER TABLE `conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `characteristics` text NOT NULL,
  `description` text NOT NULL,
  `text` text NOT NULL,
  `seo` text NOT NULL,
  `image` varchar(256) NOT NULL,
  `price` decimal(18,8) unsigned NOT NULL,
  `status` int(11) NOT NULL,
  `delete` int(11) NOT NULL,
  `category_id` int(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(1,'SOAD','{\"one\":\"two\"}','Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века.','Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).    ','{\"one\":\"one\",\"\\u041a\\u043e\\u0444\\u0435\\u0432\\u0430\\u0440\\u043a\\u0430\":\"\\u041a\\u043e\\u0444\\u0435\\u0432\\u0430\\u0440\\u043a\\u0430\"}','/downloads/soad.png',123.00000000,1,1,6),
(2,'AUM','{\"AUM\":\"AUM\"}','Lorem Ipsum - это текст-\\\"рыба\\\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \\\"рыбой\\\" для текстов на латинице с начала XVI века.','Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века.Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века.Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. ','{\"AUM\":\"AUM\"}','/downloads/aum.png',999.00000000,1,1,5),
(3,'SOAD','{\"SOAD\":\"SOAD\",\"steal\":\"steal\",\"cool\":\"100%\"}','Lorem Ipsum - это текст-\\\"рыба\\\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \\\"рыбой\\\" для текстов на латинице с начала XVI века.','Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века.Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. ','{\"soad\":\"soad\"}','/downloads/soad.png',1.00000000,1,1,6),
(4,'Pizza','{\"\\u044d\\u0442\\u0430\\u0436\\u0438\":\"\\u043c\\u043d\\u043e\\u0433\\u043e\",\"\\u0432\\u043a\\u0443\\u0441\":\"10\\/10\"}','Многоэтажная пицца','Многоэтажная пицца из бу продуктов ','{\"\\u043f\\u0438\\u0446\\u0446\\u0430\":\"\\u043f\\u0438\\u0446\\u0446\\u0430\"}','/downloads/pizza.png',2000.00000000,1,1,2),
(5,'Герои','{\"Heroes\":\"Heroes\"}','Герои 3','HeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroesHeroes ','{\"Heroes\":\"Heroes\"}','/downloads/heroes.png',3.00000000,1,1,7),
(6,'Стрелок','{\"\\u0421\\u0442\\u0440\\u0435\\u043b\\u043e\\u043a\":\"\\u0421\\u0442\\u0440\\u0435\\u043b\\u043e\\u043a\"}','Стрелок','Стрелок ','{\"\\u0421\\u0442\\u0440\\u0435\\u043b\\u043e\\u043a\":\"\\u0421\\u0442\\u0440\\u0435\\u043b\\u043e\\u043a\"}','/downloads/gunslinger.jpg',100.00000000,1,1,3),
(7,'Поезд','{\"\\u041f\\u043e\\u0435\\u0437\\u0434\":\"\\u041f\\u043e\\u0435\\u0437\\u0434\"}','Поезд','ПоездПоездПоездПоезд ','{\"\\u041f\\u043e\\u0435\\u0437\\u0434\":\"\\u041f\\u043e\\u0435\\u0437\\u0434\"}','/downloads/badlands.jpeg',1000.00000000,1,1,4);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-08 13:23:50
