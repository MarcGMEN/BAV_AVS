-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: BAV
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

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
-- Table structure for table `bav_parametre`
--

DROP TABLE IF EXISTS `bav_parametre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bav_parametre` (
  `par_numero_bav` varchar(10) NOT NULL,
  `par_taux_1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_taux_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_taux_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_prix_depot_1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_prix_depot_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_prix_depot_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_client_date_debut` date NOT NULL,
  `par_client_date_fin` date NOT NULL,
  `par_admin_id_mac` varchar(600) DEFAULT NULL,
  `par_titre` varchar(100) DEFAULT NULL,
  `par_nb_modif` int(11) NOT NULL DEFAULT '0',
  `par_date_debut_depot` date NOT NULL,
  `par_date_debut_vente` date NOT NULL,
  `par_date_fin_bav` date NOT NULL,
  `par_actif` tinyint(1) NOT NULL DEFAULT '0',
  `par_vue_parc` tinyint(1) NOT NULL DEFAULT '0',
  `par_nb_eti_page` int(11) NOT NULL,
  `par_numero_base_info` int(11) NOT NULL,
  PRIMARY KEY (`par_numero_bav`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `bav_etiquettes`
--

DROP TABLE IF EXISTS `bav_etiquettes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bav_etiquettes` (
  `eti_id` int(11) NOT NULL AUTO_INCREMENT,
  `eti_id_obj` int(11) NOT NULL,
  `eti_numero` int(11) NOT NULL,
  `eti_numero_bav` int(11) NOT NULL,
  `eti_date_impression` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eti_obj_modele` varchar(50) NOT NULL,
  `eto_obj_marque` varchar(50) NOT NULL,
  `eti_obj_description` text NOT NULL,
  `eti_obj_prix` decimal(10,0) NOT NULL,
  PRIMARY KEY (`eti_id`),
  KEY `id_obj` (`eti_id_obj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bav_etiquettes`
--

LOCK TABLES `bav_etiquettes` WRITE;
/*!40000 ALTER TABLE `bav_etiquettes` DISABLE KEYS */;
/*!40000 ALTER TABLE `bav_etiquettes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-22 10:41:36
