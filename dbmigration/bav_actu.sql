-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 04 fév. 2019 à 14:50
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
-- Structure de la table `bav_actu`
--

CREATE TABLE `bav_actu` (
  `act_id` int(11) NOT NULL,
  `act_titre` text NOT NULL,
  `act_blob` blob,
  `act_numero_bav` int(11) NOT NULL,
  `act_type` enum('ANIM','FAQ','PRESSE') NOT NULL DEFAULT 'ANIM',
  `act_active` tinyint(1) NOT NULL DEFAULT '0',
  `act_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_mail` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bav_actu`
--

INSERT INTO `bav_actu` (`act_id`, `act_titre`, `act_blob`, `act_numero_bav`, `act_type`, `act_active`, `act_date`, `act_mail`) VALUES
(13, 'ESTUAIRE HEBDO - OCTOBRE 2017', '', 2019, 'PRESSE', 1, '2019-01-28 15:39:25', NULL),
(14, '', '', 2018, 'PRESSE', 0, '2019-02-01 10:39:36', NULL),
(15, '', 0x3c696d6720616c743d2222206865696768743d2233303022207372633d22687474703a2f2f6c6f63616c686f73742f4241562f636b656469746f722f706c7567696e732f696d61676575706c6f616465722f75706c6f6164732f333932376566342e6a7067222077696474683d2234303022202f3e, 2019, 'PRESSE', 0, '2019-02-04 12:34:11', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bav_actu`
--
ALTER TABLE `bav_actu`
  ADD UNIQUE KEY `act_id` (`act_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bav_actu`
--
ALTER TABLE `bav_actu`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
