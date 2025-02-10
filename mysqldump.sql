-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: tests
-- ------------------------------------------------------
-- Server version       8.0.41

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
-- Table structure for table `answer_logs`
--

DROP TABLE IF EXISTS `answer_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answer_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `test_id` bigint unsigned NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `answer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `test_id` (`test_id`),
  KEY `question_id` (`question_id`),
  KEY `answer_id` (`answer_id`),
  KEY `user_id_2` (`user_id`,`test_id`,`question_id`,`answer_id`),
  CONSTRAINT `answer_logs_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `answer_logs_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `answer_logs_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `answer_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer_logs`
--

LOCK TABLES `answer_logs` WRITE;
/*!40000 ALTER TABLE `answer_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `answer_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `number` bigint unsigned NOT NULL,
  `text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question_id` (`question_id`,`number`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,1,1,'0','2025-02-09 18:14:19','2025-02-09 18:14:19',NULL),(2,1,2,'2','2025-02-09 18:14:29','2025-02-09 18:14:29',NULL),(3,1,3,'4','2025-02-09 18:14:35','2025-02-09 18:14:35',NULL),(4,1,4,'17','2025-02-09 18:14:42','2025-02-09 18:14:42',NULL),(5,1,5,'-1','2025-02-09 18:14:50','2025-02-09 18:14:50',NULL),(6,1,6,'3.1415...','2025-02-09 18:24:58','2025-02-09 18:24:58',NULL),(7,2,1,'Jā','2025-02-09 18:38:24','2025-02-09 18:38:24',NULL),(8,2,2,'Nē','2025-02-09 18:38:24','2025-02-09 18:38:24',NULL),(9,2,3,'Varbūt','2025-02-09 18:39:40','2025-02-09 18:39:40',NULL),(10,2,4,'Šaubos','2025-02-09 18:39:40','2025-02-09 18:39:40',NULL),(11,3,1,'2∞','2025-02-09 19:09:33','2025-02-09 19:09:33',NULL),(12,3,2,'∞^2','2025-02-09 19:09:33','2025-02-09 19:09:33',NULL),(13,3,3,'∞','2025-02-09 19:09:52','2025-02-09 19:09:52',NULL),(14,4,1,'Kāju','2025-02-09 19:43:24','2025-02-09 19:43:24',NULL),(15,4,2,'Acu','2025-02-09 19:43:24','2025-02-09 19:43:24',NULL),(16,5,1,'6','2025-02-09 19:43:56','2025-02-09 19:43:56',NULL),(17,5,2,'5','2025-02-09 19:43:56','2025-02-09 19:43:56',NULL),(18,5,3,'7','2025-02-09 19:44:39','2025-02-09 19:44:39',NULL),(19,5,4,'8','2025-02-09 19:44:39','2025-02-09 19:44:39',NULL),(20,6,1,'Jā, pilnigi noteikti. To ir pierādījis A. Einšteins.','2025-02-09 23:32:59','2025-02-09 23:32:59',NULL),(21,6,2,'Pēdējie petījumi rāda, ka īstenībā E = 42!','2025-02-09 23:38:38','2025-02-09 23:38:38',NULL);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `test_id` bigint unsigned NOT NULL,
  `number` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_id` (`test_id`,`number`),
  KEY `test_id_2` (`test_id`),
  CONSTRAINT `questions_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'Cik būs 2 x 2?',1,1,'2025-02-09 14:16:35','2025-02-09 14:16:35',NULL),(2,'Vai 0 var būt negatīvs skaitlis?',1,2,'2025-02-09 14:17:49','2025-02-09 14:17:49',NULL),(3,'Cik būs ∞ x ∞?',1,3,'2025-02-09 14:19:25','2025-02-09 14:19:25',NULL),(4,'Čuskām nav...',2,1,'2025-02-09 19:37:45','2025-02-09 19:37:45',NULL),(5,'Cik zirneklim ir veselu kāju, ja viena saluza un otru nokoda govs?',2,2,'2025-02-09 19:37:45','2025-02-09 19:37:45',NULL),(6,'Vai E = mc^2?',3,1,'2025-02-09 23:31:05','2025-02-09 23:31:05',NULL);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `right_answers`
--

DROP TABLE IF EXISTS `right_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `right_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `answer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `right_answers_question_id_answer_id_unique` (`question_id`,`answer_id`),
  KEY `right_answers_answer_id_foreign` (`answer_id`),
  KEY `question_id` (`question_id`,`answer_id`),
  CONSTRAINT `right_answers_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `right_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `right_answers`
--

LOCK TABLES `right_answers` WRITE;
/*!40000 ALTER TABLE `right_answers` DISABLE KEYS */;
INSERT INTO `right_answers` VALUES (1,1,3,'2025-02-09 19:29:40','2025-02-09 19:29:40',NULL),(2,2,8,'2025-02-09 19:29:40','2025-02-09 19:29:40',NULL),(3,3,13,'2025-02-09 19:29:59','2025-02-09 19:29:59',NULL),(4,4,14,'2025-02-09 19:45:13','2025-02-09 19:45:13',NULL),(5,5,16,'2025-02-09 19:45:13','2025-02-09 19:45:13',NULL),(6,6,20,'2025-02-09 23:34:00','2025-02-09 23:34:00',NULL);
/*!40000 ALTER TABLE `right_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_results`
--

DROP TABLE IF EXISTS `test_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `test_id` bigint unsigned NOT NULL,
  `right_answers` bigint NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `test_id` (`test_id`),
  KEY `user_id_2` (`user_id`,`test_id`,`right_answers`),
  KEY `user_id_3` (`user_id`),
  KEY `test_id_2` (`test_id`),
  CONSTRAINT `test_results_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `test_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_results`
--

LOCK TABLES `test_results` WRITE;
/*!40000 ALTER TABLE `test_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` tinyint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`enabled`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (1,'Matemātika',1,'2025-02-09 14:01:32','2025-02-09 14:01:32',NULL),(2,'Bioloģija',1,'2025-02-09 14:01:32','2025-02-09 14:01:32',NULL),(3,'Fizika',1,'2025-02-09 14:01:51','2025-02-09 14:01:51',NULL),(4,'Astronomija',0,'2025-02-10 01:27:21','2025-02-10 01:27:21',NULL);
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_2` (`name`),
  KEY `id` (`id`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2025-02-10  1:51:56