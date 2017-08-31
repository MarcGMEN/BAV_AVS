-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Dim 21 Décembre 2014 à 21:01
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bav`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `cli_nom` varchar(100) NOT NULL,
  `cli_prenom` varchar(100) NOT NULL,
  `cli_adresse` text,
  `cli_codePostal` int(11) DEFAULT NULL,
  `cli_ville` varchar(100) DEFAULT NULL,
  `cli_telephone` varchar(10) DEFAULT NULL,
  `cli_emel` varchar(100) DEFAULT NULL,
  `cli_emel_bis` varchar(100) DEFAULT NULL,
  `cli_piece_indetite` varchar(50) DEFAULT NULL,
  `cli_type_piece` enum('carte identité','permis de conduire','autre') NOT NULL,
  `cli_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cli_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cli_taux_com` enum('1','2','3') NOT NULL DEFAULT '1',
  `cli_prix_depot` enum('1','2','3') NOT NULL DEFAULT '1',
  PRIMARY KEY (`cli_id`),
  UNIQUE KEY `cli_id` (`cli_id`),
  UNIQUE KEY `cli_id_2` (`cli_id`),
  KEY `cli_nom` (`cli_nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`cli_nom`, `cli_prenom`, `cli_adresse`, `cli_codePostal`, `cli_ville`, `cli_telephone`, `cli_emel`, `cli_emel_bis`, `cli_piece_indetite`, `cli_type_piece`, `cli_date`, `cli_id`, `cli_taux_com`, `cli_prix_depot`) VALUES
('Tarreau', 'Giovanni', '21, rue des boulaaux', 44600, 'Saint Nazaire', '0627887354', 'pounet7@gmail.com', NULL, '031044300017', 'carte identité', '2014-12-20 20:00:13', 1, '1', '1');

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE IF NOT EXISTS `objet` (
  `obj_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `obj_numero` int(11) NOT NULL,
  `obj_type` enum('Route','VTT','VTC','Tamden','Autre') NOT NULL DEFAULT 'VTT',
  `obj_public` enum('homme','femme','enfant','mixte','Autre') NOT NULL,
  `obj_marque` varchar(100) DEFAULT NULL,
  `obj_modelle` varchar(100) DEFAULT NULL,
  `obj_description` text,
  `obj_couleur` varchar(20) DEFAULT NULL,
  `obj_prix_1` decimal(10,2) NOT NULL,
  `obj_prix_2` decimal(10,2) DEFAULT NULL,
  `ob_prix_3` decimal(10,2) DEFAULT NULL,
  `obj_id_vendeur` int(11) NOT NULL,
  `obj_id_acheteur` int(11) DEFAULT NULL,
  `obj_date_depot` datetime NOT NULL,
  `obj_date_vente` datetime DEFAULT NULL,
  `obj_date_retour` datetime DEFAULT NULL,
  `obj_prix_vente` decimal(10,2) NOT NULL,
  `obj_comission` decimal(10,2) NOT NULL,
  `obj_prix_depot` decimal(10,2) NOT NULL,
  PRIMARY KEY (`obj_id`),
  UNIQUE KEY `obj_id` (`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

CREATE TABLE IF NOT EXISTS `parametre` (
  `par_numero_bav` varchar(10) NOT NULL,
  `par_taux_1` int(11) NOT NULL,
  `par_taux_2` int(11) NOT NULL,
  `par_taux_3` int(11) NOT NULL,
  `par_prix_depot_1` decimal(10,2) NOT NULL,
  `par_prix_depot_2` decimal(10,2) NOT NULL,
  `par_prix_depot_3` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
