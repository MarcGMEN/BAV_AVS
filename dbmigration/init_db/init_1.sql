-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Hôte : db5009115771.hosting-data.io
-- Généré le : jeu. 23 oct. 2025 à 09:12
-- Version du serveur : 5.7.42-log
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db326893785`
--

-- --------------------------------------------------------

--
-- Structure de la table `bav_counter_access`
--

CREATE TABLE `bav_counter_access` (
  `cas_id` int(11) NOT NULL,
  `cas_page` varchar(30) DEFAULT NULL,
  `cas_mode_page` varchar(50) DEFAULT NULL,
  `cas_type` varchar(20) DEFAULT NULL,
  `cas_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cas_numero_bav` varchar(10) NOT NULL,
  `cas_navigateur` varchar(20) DEFAULT NULL,
  `cas_os` varchar(20) DEFAULT NULL,
  `cas_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bav_counter_access`
--
ALTER TABLE `bav_counter_access`
  ADD PRIMARY KEY (`cas_id`),
  ADD KEY `bac_counter_access_cas_libelle_IDX` (`cas_page`) USING BTREE,
  ADD KEY `bav_counter_access_cas_numero_bav_IDX` (`cas_numero_bav`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bav_counter_access`
--
ALTER TABLE `bav_counter_access`
  MODIFY `cas_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE `bav_accessoire` (
  `acc_id` int NOT NULL,
  `acc_numero` int NOT NULL,
  `acc_numero_bav` int NOT NULL,
  `acc_commentaire` text NOT NULL,
  `acc_etat` enum('Déposé','A restituer','Restituer') NOT NULL DEFAULT 'Déposé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bav_accessoire`
--
ALTER TABLE `bav_accessoire`
  ADD PRIMARY KEY (`acc_id`),
  ADD UNIQUE KEY `acc_numero` (`acc_numero`,`acc_numero_bav`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bav_accessoire`
--
ALTER TABLE `bav_accessoire`
  MODIFY `acc_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

