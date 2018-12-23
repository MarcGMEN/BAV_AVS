-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 21 déc. 2018 à 14:31
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
-- Structure de la table `bav_client`
--

CREATE TABLE `bav_client` (
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
  `cli_taux_com` decimal(10,2) NOT NULL,
  `cli_prix_depot` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_client`
--

INSERT INTO `bav_client` (`cli_id`, `cli_id_modif`, `cli_nom`, `cli_emel`, `cli_adresse`, `cli_adresse1`, `cli_code_postal`, `cli_ville`, `cli_telephone`, `cli_telephone_bis`, `cli_taux_com`, `cli_prix_depot`) VALUES
(12, '7e3299ab', 'marc Braillou', 'braillou@gmail.com', '2, rue des judelles', '', '44117', 'SAINT ANDRE DES EAUX', '0681629671', '', '10.00', '3.00'),
(17, 'c407c04e', 'Garcès Marc', 'marc.garces@free.fr', '2, rue des judelles', '', '44117', 'SAINT ANDRÉ DES EAUX', '0681629671', '', '5.00', '0.00'),
(18, 'dd23bd52', 'Corduan Olivier', 'olivier.corduan@orange.fr', '', '', '44600', 'Saint Nazaire', '', '', '10.00', '3.00');

-- --------------------------------------------------------

--
-- Structure de la table `bav_objet`
--

CREATE TABLE `bav_objet` (
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
-- Déchargement des données de la table `bav_objet`
--

INSERT INTO `bav_objet` (`obj_id`, `obj_numero`, `obj_id_modif`, `obj_numero_bav`, `obj_type`, `obj_public`, `obj_pratique`, `obj_marque`, `obj_modele`, `obj_couleur`, `obj_description`, `obj_prix_depot`, `obj_date_depot`, `obj_prix_vente`, `obj_date_vente`, `obj_prix_modif`, `obj_id_vendeur`, `obj_id_acheteur`, `obj_date_retour`, `obj_etat`) VALUES
(94, 700, 'b7e75', 2019, 'Autre', 'Autre', 'Autre', 'fsdfsdfs', '', 'sfsdf', 'Taille :d\nPrix d\'achat : \nAnnée d\'achat : \n.....', '150.00', '2018-11-30 08:15:18', '150.00', NULL, NULL, 14, NULL, '2018-12-06 04:12:00', 'RENDU'),
(95, 5009, '83fd4', 2018, 'Route', 'Homme', 'Autre', 'TREK', 'SUPERFLY 100', 'noire', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '1200.00', '2018-12-06 03:12:03', '1200.00', '2018-12-06 04:12:56', NULL, 12, 18, '2018-12-11 11:12:05', 'PAYE'),
(97, 701, 'aec8d', 2018, 'Autre', 'Autre', 'Autre', 'sdf', '', 'sfs', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '10.00', '2018-12-03 08:31:54', '0.00', NULL, NULL, 14, NULL, NULL, 'CONFIRME'),
(98, 713, '2d23d', 2018, 'VTT', 'Homme', 'Sportif', 'trek', 'SUPERFLY 100', 'noir', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '1200.00', '2018-12-03 08:42:54', '1200.00', NULL, NULL, 12, NULL, NULL, 'CONFIRME'),
(101, 5013, '71819', 2018, 'Autre', 'Autre', 'Autre', 'BIANCHI', '', 'dgdf', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '0.00', '2018-12-03 09:37:42', '0.00', NULL, NULL, 12, NULL, NULL, 'INIT'),
(102, 5014, '9769c', 2018, 'Autre', 'Autre', 'Autre', 'BTWIN', '', 'dgdf', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '0.00', '2018-12-03 09:41:36', '0.00', NULL, NULL, 12, NULL, NULL, 'INIT'),
(103, 5015, '15bdc', 2018, 'Autre', 'Autre', 'Autre', 'test', '', 'test', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '0.00', '2018-12-03 09:44:16', '0.00', NULL, NULL, 12, NULL, NULL, 'INIT'),
(104, 5016, '6243e', 2018, 'Autre', 'Autre', 'Autre', 'sd', '', 'sfd', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '0.00', '2018-12-03 09:45:28', '0.00', NULL, NULL, 12, NULL, NULL, 'INIT'),
(111, 706, '3db16', 2018, 'Autre', 'Autre', 'Autre', 'MARIN', '', 'VERT', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '1500.00', '2018-12-03 15:09:56', '1200.00', NULL, NULL, 16, NULL, NULL, 'STOCK'),
(112, 707, 'bdaf0', 2018, 'Autre', 'Autre', 'Autre', 'sfsd', '', 'sfsdf', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '150.00', '2018-12-03 15:10:17', '150.00', NULL, NULL, 16, NULL, '2018-12-10 04:12:45', 'RENDU'),
(115, 710, 'd1fa8', 2018, 'Autre', 'Autre', 'Autre', 'sfdf', '', 'sfsf', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '1200.00', '2018-12-03 16:16:42', '1200.00', NULL, NULL, 14, NULL, '2018-12-10 04:12:00', 'RENDU'),
(116, 711, 'e8611', 2018, 'Autre', 'Autre', 'Autre', 'qfsdf', '', 'sfsd', 'Taille :\nPrix d\'achat : \nAnnée d\'achat :', '120.00', '2018-12-03 16:18:01', '120.00', NULL, NULL, 12, 18, NULL, 'VENDU'),
(118, 700, '31e74', 2018, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, NULL, '2018-12-06 16:18:59', '0.00', NULL, NULL, 23, NULL, NULL, 'STOCK'),
(119, 702, 'd0f78', 2018, 'Autre', 'Autre', 'Autre', NULL, NULL, NULL, NULL, NULL, '2018-12-06 16:20:20', '0.00', NULL, NULL, 16, NULL, NULL, 'STOCK'),
(120, 703, 'fd1d6', 2018, 'Autre', 'Autre', 'Autre', 'sfs', '', 'sfsd', '', '0.00', '2018-12-10 08:54:41', '0.00', NULL, NULL, 16, NULL, NULL, 'STOCK'),
(122, 704, '2ed65', 2018, 'Autre', 'Autre', 'Autre', 'sfsd', '', 'sfsd', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '120.00', '2018-12-10 12:37:31', '0.00', NULL, NULL, 18, NULL, '2018-12-21 02:12:41', 'RENDU'),
(124, 705, 'c9e21', 2018, 'VTT', 'Homme', 'Sportif', 'ORBEA', '', 'NOIR CARBONNE', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '120.00', '2018-12-10 01:12:21', '120.00', NULL, NULL, 18, NULL, NULL, 'STOCK'),
(127, 708, 'a6c1f', 2018, 'Autre', 'Autre', 'Autre', 'BMC', 'dfsdf', 'sfsd', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '0.00', '2018-12-20 00:12:30', '0.00', NULL, NULL, 12, NULL, NULL, 'STOCK'),
(128, 712, '927cf', 2018, 'VTT', 'Homme', 'Sportif', 'BIANCHI', 'tour de france', 'VERT', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '120.00', '2018-12-21 08:12:43', '120.00', NULL, NULL, 17, NULL, NULL, 'STOCK'),
(131, 714, '8e9e4', 2018, 'Autre', 'Autre', 'Autre', 'TREk', 'SUPERFLY 100', 'MARRON', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '2010.00', '2018-12-21 12:23:21', '0.00', '0000-00-00 00:00:00', '0.00', 17, 0, '0000-00-00 00:00:00', 'CONFIRME'),
(132, 5004, '0f943', 2018, 'Route', 'Homme', 'Loisir', 'BTWIN', '', 'bleu', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '155.00', '2018-12-21 12:38:59', '0.00', NULL, NULL, 18, NULL, NULL, 'INIT'),
(133, 5005, 'ca57e', 2018, 'Autre', 'Autre', 'Autre', 'fsd', '', 'fsf', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '0.00', '2018-12-21 12:53:29', '0.00', NULL, NULL, 26, NULL, NULL, 'INIT'),
(134, 5006, '0c97d', 2018, 'Autre', 'Autre', 'Autre', 'qdqsd', '', 'qdqs', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '0.00', '2018-12-21 12:54:33', '0.00', NULL, NULL, 26, NULL, NULL, 'INIT'),
(135, 5007, '5bd17', 2018, 'Autre', 'Autre', 'Autre', 'sfsdf', '', 'sdfsdf', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '0.00', '2018-12-21 12:57:21', '0.00', NULL, NULL, 17, NULL, NULL, 'INIT'),
(136, 5008, '39a4d', 2018, 'Autre', 'Autre', 'Autre', 'qdqsdq', '', 'qdqsd', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '115.00', '2018-12-21 12:58:54', '0.00', NULL, NULL, 18, NULL, NULL, 'INIT'),
(137, 709, '63f9a', 2018, 'Autre', 'Autre', 'Autre', 'qdqs', '', 'qdq', 'Taille :\nPrix d\'achat : \nAnnée d\'achat : \n.....', '120.00', '2018-12-21 01:12:58', '100.00', '2018-12-21 02:12:32', '0.00', 17, 18, '2018-12-21 02:12:46', 'PAYE');

-- --------------------------------------------------------

--
-- Structure de la table `bav_parametre`
--

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
  `par_table_date_debut` date NOT NULL,
  `par_table_date_fin` date NOT NULL,
  `par_table_id_mac` varchar(600) DEFAULT NULL,
  `par_admin_id_mac` varchar(600) DEFAULT NULL,
  `par_titre` varchar(100) DEFAULT NULL,
  `par_nb_modif` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_parametre`
--

INSERT INTO `bav_parametre` (`par_numero_bav`, `par_taux_1`, `par_taux_2`, `par_taux_3`, `par_prix_depot_1`, `par_prix_depot_2`, `par_prix_depot_3`, `par_client_date_debut`, `par_client_date_fin`, `par_table_date_debut`, `par_table_date_fin`, `par_table_id_mac`, `par_admin_id_mac`, `par_titre`, `par_nb_modif`) VALUES
('2018', '10.00', '5.00', '0.00', '3.00', '1.00', '0.00', '2018-10-01', '2019-06-10', '2018-11-10', '2019-06-10', 'rien', '::1', '15eme bourse aux velos', 5),
('2019', '10.00', '5.00', '0.00', '3.00', '1.00', '0.00', '2019-10-01', '2019-11-11', '2018-11-26', '2019-11-11', 'localhost, 127.0.0.1', 'localhost, 127.0.0.1, ::1', '16eme. La bourse au 1200 velos', 0),
('2020', '10.00', '5.00', '0.00', '3.00', '2.00', '1.00', '2020-01-01', '2020-01-01', '2020-01-01', '2020-01-01', 'localhost, 127:0:0:1, ::1', 'localhost, 127:0:0:1, ::1', 'la bav 2020', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bav_client`
--
ALTER TABLE `bav_client`
  ADD PRIMARY KEY (`cli_id`),
  ADD UNIQUE KEY `cli_id` (`cli_id`),
  ADD KEY `cli_nom` (`cli_nom`),
  ADD KEY `cli_id_2` (`cli_emel`) USING BTREE;

--
-- Index pour la table `bav_objet`
--
ALTER TABLE `bav_objet`
  ADD PRIMARY KEY (`obj_id`),
  ADD UNIQUE KEY `obj_id` (`obj_id`),
  ADD UNIQUE KEY `obj_id_2` (`obj_id_modif`),
  ADD UNIQUE KEY `obj_numero` (`obj_numero`,`obj_numero_bav`),
  ADD KEY `obj_marque` (`obj_marque`);

--
-- Index pour la table `bav_parametre`
--
ALTER TABLE `bav_parametre`
  ADD PRIMARY KEY (`par_numero_bav`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bav_client`
--
ALTER TABLE `bav_client`
  MODIFY `cli_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `bav_objet`
--
ALTER TABLE `bav_objet`
  MODIFY `obj_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
