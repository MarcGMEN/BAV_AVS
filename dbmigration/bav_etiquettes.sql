
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