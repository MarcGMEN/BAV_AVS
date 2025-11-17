-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Hôte : db5009115771.hosting-data.io
-- Généré le : Dim 09 nov. 2025 à 20:53
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
-- Structure de la vue `v_marque`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`bav` SQL SECURITY DEFINER VIEW `v_marque`  AS SELECT DISTINCT `bo`.`obj_marque` AS `obj_marque`, `bo`.`obj_numero_bav` AS `obj_numero_bav` FROM `bav_objet` AS `bo`;

--
-- VIEW  `v_marque`
-- Données : Aucun(e)
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
