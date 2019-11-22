-
CREATE TABLE `bav_client` (
  `cli_id` bigint(20) UNSIGNED NOT NULL,
  `cli_id_modif` varchar(35) NOT NULL,
  `cli_nom` varchar(100) NOT NULL,
  `cli_emel` varchar(100) DEFAULT NULL,
  `cli_adresse` varchar(100) DEFAULT NULL,
  `cli_adresse1` varchar(100) DEFAULT NULL,
  `cli_code_postal` varchar(10) DEFAULT NULL,
  `cli_ville` varchar(100) DEFAULT NULL,
  `cli_telephone` varchar(15) DEFAULT NULL,
  `cli_telephone_bis` varchar(15) DEFAULT NULL,
  `cli_taux_com` decimal(10,2) NOT NULL,
  `cli_prix_depot` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Index pour la table `bav_client`
--
ALTER TABLE `bav_client`
  ADD PRIMARY KEY (`cli_id`),
  ADD UNIQUE KEY `cli_id` (`cli_id`),
  ADD KEY `cli_nom` (`cli_nom`),
  ADD KEY `cli_id_2` (`cli_emel`) USING BTREE;


