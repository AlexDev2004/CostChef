-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cost_chef
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adresse` (
  `id_adresse` int NOT NULL AUTO_INCREMENT,
  `rue_adresse` varchar(100) NOT NULL,
  `numero_adresse` int NOT NULL,
  `code_postal_adresse` int NOT NULL,
  `id_ville` int NOT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `fk_adresse_ville` (`id_ville`),
  CONSTRAINT `fk_adresse_ville` FOREIGN KEY (`id_ville`) REFERENCES `ville` (`id_ville`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `etape`
--

DROP TABLE IF EXISTS `etape`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etape` (
  `id_etape` int NOT NULL AUTO_INCREMENT,
  `texte_etape` text NOT NULL,
  `id_recette` int NOT NULL,
  PRIMARY KEY (`id_etape`),
  KEY `fk_etape_recette` (`id_recette`),
  CONSTRAINT `fk_etape_recette` FOREIGN KEY (`id_recette`) REFERENCES `recette` (`id_recette`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pays`
--

DROP TABLE IF EXISTS `pays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pays` (
  `id_pays` int NOT NULL AUTO_INCREMENT,
  `nom_pays` varchar(60) NOT NULL,
  PRIMARY KEY (`id_pays`),
  UNIQUE KEY `nom_pays` (`nom_pays`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produit` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(50) NOT NULL,
  `prix_produit` decimal(10,2) NOT NULL,
  `stock_produit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `id_restaurant` int NOT NULL,
  `id_unite_produit` int NOT NULL,
  `id_type_produit` int NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `fk_produit_restaurant` (`id_restaurant`),
  KEY `fk_produit_type` (`id_type_produit`),
  KEY `fk_produit_unite` (`id_unite_produit`),
  CONSTRAINT `fk_produit_restaurant` FOREIGN KEY (`id_restaurant`) REFERENCES `restaurant` (`id_restaurant`) ON DELETE CASCADE,
  CONSTRAINT `fk_produit_type` FOREIGN KEY (`id_type_produit`) REFERENCES `type_produit` (`id_type_produit`),
  CONSTRAINT `fk_produit_unite` FOREIGN KEY (`id_unite_produit`) REFERENCES `unite_produit` (`id_unite_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `produit_recette`
--

DROP TABLE IF EXISTS `produit_recette`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produit_recette` (
  `id_produit` int NOT NULL,
  `id_recette` int NOT NULL,
  PRIMARY KEY (`id_produit`,`id_recette`),
  KEY `fk_produit_recette_recette` (`id_recette`),
  CONSTRAINT `fk_produit_recette_produit` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE,
  CONSTRAINT `fk_produit_recette_recette` FOREIGN KEY (`id_recette`) REFERENCES `recette` (`id_recette`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recette`
--

DROP TABLE IF EXISTS `recette`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recette` (
  `id_recette` int NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(50) NOT NULL,
  `image_recette` varchar(255) NOT NULL,
  `description_recette` text NOT NULL,
  `id_restaurant` int NOT NULL,
  `id_unite_recette` int NOT NULL,
  `id_type_recette` int NOT NULL,
  PRIMARY KEY (`id_recette`),
  KEY `fk_recette_restaurant` (`id_restaurant`),
  KEY `fk_recette_type` (`id_type_recette`),
  KEY `fk_recette_unite` (`id_unite_recette`),
  CONSTRAINT `fk_recette_restaurant` FOREIGN KEY (`id_restaurant`) REFERENCES `restaurant` (`id_restaurant`) ON DELETE CASCADE,
  CONSTRAINT `fk_recette_type` FOREIGN KEY (`id_type_recette`) REFERENCES `type_recette` (`id_type_recette`),
  CONSTRAINT `fk_recette_unite` FOREIGN KEY (`id_unite_recette`) REFERENCES `unite_recette` (`id_unite_recette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restaurant` (
  `id_restaurant` int NOT NULL AUTO_INCREMENT,
  `nom_restaurant` varchar(255) NOT NULL,
  `logo_restaurant` varchar(255) NOT NULL,
  `email_restaurant` varchar(100) NOT NULL,
  `telephone_restaurant` varchar(30) NOT NULL,
  `code_restaurant` int NOT NULL,
  `mdp_restaurant` varchar(100) NOT NULL,
  `id_adresse` int NOT NULL,
  PRIMARY KEY (`id_restaurant`),
  UNIQUE KEY `email_restaurant` (`email_restaurant`),
  UNIQUE KEY `telephone_restaurant` (`telephone_restaurant`),
  KEY `fk_restaurant_adresse` (`id_adresse`),
  CONSTRAINT `fk_restaurant_adresse` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `type_produit`
--

DROP TABLE IF EXISTS `type_produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_produit` (
  `id_type_produit` int NOT NULL AUTO_INCREMENT,
  `nom_type_produit` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type_produit`),
  UNIQUE KEY `nom_type_produit` (`nom_type_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `type_recette`
--

DROP TABLE IF EXISTS `type_recette`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_recette` (
  `id_type_recette` int NOT NULL AUTO_INCREMENT,
  `nom_type_recette` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type_recette`),
  UNIQUE KEY `nom_type_recette` (`nom_type_recette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `unite_produit`
--

DROP TABLE IF EXISTS `unite_produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unite_produit` (
  `id_unite_produit` int NOT NULL AUTO_INCREMENT,
  `nom_unite_produit` varchar(50) NOT NULL,
  PRIMARY KEY (`id_unite_produit`),
  UNIQUE KEY `nom_unite_produit` (`nom_unite_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `unite_recette`
--

DROP TABLE IF EXISTS `unite_recette`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unite_recette` (
  `id_unite_recette` int NOT NULL AUTO_INCREMENT,
  `nom_unite_recette` varchar(50) NOT NULL,
  PRIMARY KEY (`id_unite_recette`),
  UNIQUE KEY `nom_unite_recette` (`nom_unite_recette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ville`
--

DROP TABLE IF EXISTS `ville`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ville` (
  `id_ville` int NOT NULL AUTO_INCREMENT,
  `nom_ville` varchar(60) NOT NULL,
  `id_pays` int NOT NULL,
  PRIMARY KEY (`id_ville`),
  KEY `fk_ville_pays` (`id_pays`),
  CONSTRAINT `fk_ville_pays` FOREIGN KEY (`id_pays`) REFERENCES `pays` (`id_pays`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-06 11:13:53
