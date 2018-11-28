-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 28 nov. 2018 à 17:16
-- Version du serveur :  10.1.30-MariaDB-0ubuntu0.17.10.1
-- Version de PHP :  7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bav`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `cli_id` bigint(20) UNSIGNED NOT NULL,
  `cli_id_modif` varchar(8) NOT NULL,
  `cli_nom` varchar(100) NOT NULL,
  `cli_emel` varchar(100) DEFAULT NULL,
  `cli_adresse` varchar(100) DEFAULT NULL,
  `cli_adresse1` varchar(100) DEFAULT NULL,
  `cli_code_postal` varchar(10) DEFAULT NULL,
  `cli_ville` varchar(100) DEFAULT NULL,
  `cli_telephone` varchar(15) DEFAULT NULL,
  `cli_telephone_bis` varchar(15) DEFAULT NULL,
  `cli_taux_com` smallint(6) NOT NULL,
  `cli_prix_depot` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`cli_id`, `cli_id_modif`, `cli_nom`, `cli_emel`, `cli_adresse`, `cli_adresse1`, `cli_code_postal`, `cli_ville`, `cli_telephone`, `cli_telephone_bis`, `cli_taux_com`, `cli_prix_depot`) VALUES
(12, '7e3299ab', 'Garces Marc', 'marc.garces@free.fr', '2, rue des judelles', '', '44117', 'SAINT ANDRÉ DES EAUX', '0681629671', '', 10, 3),
(13, '43c37962', 'sfsdfsfsdf', 'sfsdf@sfsd.fsd', '', '', '', '', '', '', 10, 0),
(14, 'a7b65785', 'sfsdf', 'sfdfsd@xn--sdfs-9ga', '', '', '', '', '', '', 10, 3),
(15, '17ac7d38', 'sdfsdfsd', 'sfsdfsdfsd@sdfsdfs', '', '', '', '', '', '', 10, 3);

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE `objet` (
  `obj_id` bigint(20) NOT NULL,
  `obj_numero` int(11) NOT NULL,
  `obj_id_modif` varchar(5) NOT NULL,
  `obj_numero_bav` int(11) NOT NULL,
  `obj_type` enum('Autre','Route','Demi-Course','VTT','VTC','Ville','Tamden','BMX') DEFAULT 'Autre',
  `obj_public` enum('Autre','Homme','Femme','Mixte','Enfant','Garçon','Fille') DEFAULT 'Autre',
  `obj_pratique` enum('Autre','Loisir','Sportif','Compétition') DEFAULT 'Autre',
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
  `obj_etat` varchar(10) NOT NULL DEFAULT 'INIT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `objet`
--

INSERT INTO `objet` (`obj_id`, `obj_numero`, `obj_id_modif`, `obj_numero_bav`, `obj_type`, `obj_public`, `obj_pratique`, `obj_marque`, `obj_modele`, `obj_couleur`, `obj_description`, `obj_prix_depot`, `obj_date_depot`, `obj_prix_vente`, `obj_date_vente`, `obj_prix_modif`, `obj_id_vendeur`, `obj_id_acheteur`, `obj_date_retour`, `obj_etat`) VALUES
(85, 700, '74ce7', 2019, 'VTT', 'Homme', 'Sportif', 'TREK', 'superfly 100', 'Maron', 'taille 21.5\nDate achat 2014\nprix achat 2500 %u20AC éçà_(-é\"_çà&(-', '950.00', '2018-11-27 12:44:42', '0.00', '0000-00-00 00:00:00', '0.00', 12, 0, '0000-00-00 00:00:00', 'INIT'),
(86, 5000, 'd5471', 2019, 'Autre', 'Autre', 'Autre', 'sfsdf', '', 'sfsdfs', '', '0.00', '2018-11-28 15:36:49', '0.00', NULL, NULL, 13, NULL, NULL, 'INIT'),
(87, 5001, '81253', 2019, 'Autre', 'Autre', 'Autre', 'sfsdf', '', 'sfsdf', '', '0.00', '2018-11-28 15:43:28', '0.00', NULL, NULL, 14, NULL, NULL, 'INIT'),
(88, 5002, '38076', 2019, 'Autre', 'Autre', 'Autre', 'sfsdf', '', 'sfsdf', '', '0.00', '2018-11-28 15:43:30', '0.00', NULL, NULL, 14, NULL, NULL, 'INIT'),
(89, 5003, 'f3bea', 2019, 'Autre', 'Autre', 'Autre', 'sfsdf', '', 'sfsdf', '', '0.00', '2018-11-28 15:44:27', '0.00', NULL, NULL, 14, NULL, NULL, 'INIT'),
(90, 5004, 'e922c', 2019, 'Autre', 'Autre', 'Autre', 'sfsdf', '', 'sfsdf', '', '0.00', '2018-11-28 15:44:50', '0.00', NULL, NULL, 14, NULL, NULL, 'INIT'),
(91, 5005, '91bcf', 2019, 'Autre', 'Autre', 'Autre', 'sfsdf', '', 'sfsdf', '', '0.00', '2018-11-28 15:45:39', '0.00', NULL, NULL, 13, NULL, NULL, 'INIT'),
(92, 5006, 'b2ce8', 2019, 'Autre', 'Autre', 'Autre', 'sqfsdfsd', '', 'sdfsdfsd', '', '0.00', '2018-11-28 15:45:59', '0.00', NULL, NULL, 15, NULL, NULL, 'INIT');

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

CREATE TABLE `parametre` (
  `par_numero_bav` varchar(10) NOT NULL,
  `par_taux_1` int(11) NOT NULL DEFAULT '0',
  `par_taux_2` int(11) NOT NULL DEFAULT '0',
  `par_taux_3` int(11) NOT NULL DEFAULT '0',
  `par_prix_depot_1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_prix_depot_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_prix_depot_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `par_client_date_debut` date NOT NULL,
  `par_client_date_fin` date NOT NULL,
  `par_table_date_debut` date NOT NULL,
  `par_table_date_fin` date NOT NULL,
  `par_table_id_mac` varchar(600) DEFAULT NULL,
  `par_admin_id_mac` varchar(600) DEFAULT NULL,
  `par_titre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parametre`
--

INSERT INTO `parametre` (`par_numero_bav`, `par_taux_1`, `par_taux_2`, `par_taux_3`, `par_prix_depot_1`, `par_prix_depot_2`, `par_prix_depot_3`, `par_client_date_debut`, `par_client_date_fin`, `par_table_date_debut`, `par_table_date_fin`, `par_table_id_mac`, `par_admin_id_mac`, `par_titre`) VALUES
('2019', 10, 5, 0, '3.00', '1.00', '0.00', '2019-10-01', '2019-11-11', '2018-11-26', '2019-11-11', 'localhost, 127.0.0.1', 'localhost, 127.0.0.1, ::1', '16eme. La bourse au 1200 velos'),
('2020', 10, 5, 0, '3.00', '2.00', '1.00', '2020-01-01', '2020-01-01', '2020-01-01', '2020-01-01', 'localhost, 127:0:0:1, ::1', 'localhost, 127:0:0:1, ::1', 'la bav 2020');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cli_id`),
  ADD UNIQUE KEY `cli_id` (`cli_id`),
  ADD UNIQUE KEY `cli_id_2` (`cli_emel`),
  ADD KEY `cli_nom` (`cli_nom`);

--
-- Index pour la table `objet`
--
ALTER TABLE `objet`
  ADD PRIMARY KEY (`obj_id`),
  ADD UNIQUE KEY `obj_id` (`obj_id`),
  ADD UNIQUE KEY `obj_id_2` (`obj_id_modif`),
  ADD UNIQUE KEY `obj_numero` (`obj_numero`,`obj_numero_bav`),
  ADD KEY `obj_marque` (`obj_marque`);

--
-- Index pour la table `parametre`
--
ALTER TABLE `parametre`
  ADD PRIMARY KEY (`par_numero_bav`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `cli_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `objet`
--
ALTER TABLE `objet`
  MODIFY `obj_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
