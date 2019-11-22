-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  db2463.1and1.fr
-- Généré le :  Ven 22 Novembre 2019 à 17:24
-- Version du serveur :  5.5.60-0+deb7u1-log
-- Version de PHP :  7.0.33-0+deb9u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db326893785`
--

-- --------------------------------------------------------

--
-- Structure de la table `bav_actu`
--

CREATE TABLE `bav_actu` (
  `act_id` int(11) NOT NULL,
  `act_titre` text NOT NULL,
  `act_text` text,
  `act_numero_bav` int(11) NOT NULL,
  `act_type` enum('ANIM','FAQ','PRESSE') NOT NULL DEFAULT 'ANIM',
  `act_active` tinyint(1) NOT NULL DEFAULT '0',
  `act_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act_mail` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;