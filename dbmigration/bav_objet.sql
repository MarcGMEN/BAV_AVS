
--
-- Structure de la table `bav_objet`
--


CREATE TABLE `bav_objet` (
  `obj_id` bigint(20) NOT NULL,
  `obj_numero` int(11) NOT NULL,
  `obj_id_modif` varchar(35) NOT NULL,
  `obj_numero_bav` int(11) NOT NULL,
  `obj_type` enum('Autre','Route','Demi-course','VTT','VTC','Ville','Tamden','BMX','VAE','Draisiene','Velo') DEFAULT 'Autre',
  `obj_public` enum('Autre','Homme','Femme','Mixte','Enfant','GarÃ§on','Fille') DEFAULT 'Autre',
  `obj_pratique` enum('Autre','Loisir','Sportif','CompÃ©tition') DEFAULT 'Autre',
  `obj_marque` varchar(50) DEFAULT NULL,
  `obj_modele` varchar(50) DEFAULT NULL,
  `obj_couleur` varchar(30) DEFAULT NULL,
  `obj_description` text,
  `obj_prix_depot` decimal(10,2) DEFAULT NULL,
  `obj_date_depot` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obj_prix_vente` decimal(10,2) DEFAULT '0.00',
  `obj_date_vente` datetime DEFAULT NULL,
  `obj_prix_modif` decimal(10,2) DEFAULT NULL,
  `obj_id_vendeur` int(11) NOT NULL,
  `obj_id_acheteur` int(11) DEFAULT NULL,
  `obj_date_retour` datetime DEFAULT NULL,
  `obj_etat` varchar(10) NOT NULL DEFAULT 'INIT',
  `obj_accessoire` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour la table `bav_objet`
--
ALTER TABLE `bav_objet`
  ADD PRIMARY KEY (`obj_id`),
  ADD UNIQUE KEY `ui_numero` (`obj_numero`,`obj_numero_bav`),
  ADD UNIQUE KEY `ui_pk_id` (`obj_id`) USING BTREE,
  ADD KEY `idx__vendeur` (`obj_id_vendeur`,`obj_etat`,`obj_numero_bav`),
  ADD KEY `idx_acheteur` (`obj_id_acheteur`,`obj_etat`,`obj_numero_bav`);
