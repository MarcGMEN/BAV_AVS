-- BAV.bav_counter_access definition

CREATE TABLE `bav_counter_access` (
  `cas_id` int NOT NULL AUTO_INCREMENT,
  `cas_page` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cas_mode_page` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cas_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cas_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cas_numero_bav` varchar(10) NOT NULL,
  `cas_navigateur` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cas_os` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cas_admin` int DEFAULT NULL,
  PRIMARY KEY (`cas_id`),
  KEY `bac_counter_access_cas_libelle_IDX` (`cas_page`) USING BTREE,
  KEY `bav_counter_access_cas_numero_bav_IDX` (`cas_numero_bav`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb3;