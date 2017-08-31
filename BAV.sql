-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 21 Janvier 2015 à 08:56
-- Version du serveur: 5.5.40-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `BAV`
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
  `cli_type_piece` enum('carte identité','permis de conduire','Autre','Pas de pièce') NOT NULL,
  `cli_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cli_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cli_taux_com` enum('1','2','3') NOT NULL DEFAULT '1',
  `cli_prix_depot` enum('1','2','3') NOT NULL DEFAULT '1',
  PRIMARY KEY (`cli_id`),
  UNIQUE KEY `cli_id` (`cli_id`),
  UNIQUE KEY `cli_id_2` (`cli_id`),
  KEY `cli_nom` (`cli_nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`cli_nom`, `cli_prenom`, `cli_adresse`, `cli_codePostal`, `cli_ville`, `cli_telephone`, `cli_emel`, `cli_emel_bis`, `cli_piece_indetite`, `cli_type_piece`, `cli_date`, `cli_id`, `cli_taux_com`, `cli_prix_depot`) VALUES
('Tarreau', 'Giovanni', '21, rue des bouleaux', 44600, 'Saint Nazaire', '0627887354', 'pounet7@gmail.com', NULL, '031044300017', 'carte identité', '2014-12-20 20:00:13', 1, '1', '1'),
('Garcès', 'Marc', '2, rue des judelles', 44117, 'Saint André des Eaux', '0681629671', 'marc.garces@free.fr', NULL, '090544300093', 'carte identité', '2015-01-09 12:51:16', 2, '2', '3'),
('Cosson', 'Stéphane', '10, rue émile Péhant', 44350, 'Guérande', '0668708636', 'stephane.cosson@orange.fr', NULL, '131244300581', 'carte identité', '2015-01-13 14:00:35', 4, '1', '1'),
('Begaud', 'Laurence', '3, rue du corps de gardes\r\n', 44600, 'Saint Nazaire', '0647366304', '', NULL, '130544301735', 'carte identité', '2015-01-14 07:40:03', 5, '1', '1'),
('Houssaye', 'Jean Jacques', '28, rue baptiste Manet', 44600, 'Saint Nazaire', '0240902320', '', NULL, '080144300144', 'carte identité', '2015-01-14 07:41:03', 6, '', ''),
('Chaleil', 'Gilbert', '2, chemin du Rocher du Lion', 44600, 'Saint Nazaire', '0672323764', 'gchaleil@yahoo.fr', NULL, '140344300623', 'carte identité', '2015-01-14 07:43:53', 7, '1', '1'),
('Vrignaud', 'Edouard', '20 chemin de ma Tournelle', 44350, 'Guérande', '0676252930', 'edouard44350@msm.com', NULL, '1211443012098E', 'carte identité', '2015-01-14 07:47:31', 8, '1', '1'),
('Saveli', 'Christophe', '27 la Moinerie', 44320, 'Frossay', '0624590196', '', NULL, '', 'carte identité', '2015-01-14 07:48:43', 9, '', ''),
('Le Glaud', 'Cécile', '113, rue Jean Gutemberg', 44600, 'Saint Nazaire', '0652961919', '', NULL, '070644300387', 'carte identité', '2015-01-14 08:17:47', 10, '', ''),
('Richard', 'Arnaud', '2, chemin de la Garnerie', 44600, 'Saint Nazaire', '0609874499', 'arnaud.richard_iutsn@yahoo.fr', NULL, '', 'Pas de pièce', '2015-01-14 08:19:34', 11, '1', '1'),
('Mihaila', 'Christian', '13 ter rue de F. Madiot', 44600, 'Saint Nazaire', '0783086702', '', NULL, '', 'Pas de pièce', '2015-01-14 08:20:30', 12, '1', '1'),
('Guyonard', 'Fabienne', '2, allée des Vignes du clos\r\nSt Marc sur mer', 44600, 'Saint Nazaire', '0624891016', 'guyomard_fabienne@sfr.fr', NULL, '021244300782', 'carte identité', '2015-01-14 08:22:48', 13, '1', '1'),
('Leroux', 'Manuel', '7 allée des Renomeuls', 44600, 'Saint Nazaire', '0646472176', '', NULL, '', 'Pas de pièce', '2015-01-14 08:23:50', 14, '', ''),
('Briand', 'Yann', '52 rue de la Rougée', 44420, 'Quimiac en Mesquer', '0626247626', '', NULL, '080944300717', 'carte identité', '2015-01-14 08:26:37', 15, '1', '1'),
('Dien', 'Myriam', '42 route de la villes Blais', 44380, 'Pornichet', '0240152127', '', NULL, '100844302097', 'carte identité', '2015-01-14 08:27:28', 16, '', ''),
('Grandjean', 'Sylvie', '', 0, 'Montoir de Bretagne', '000000000', '', NULL, '', 'Pas de pièce', '2015-01-14 08:29:51', 17, '2', '2'),
('Marshall', 'Reg', '8 rue de la Dalonneire', 44730, 'Tharon PLage', '0659009497', 'reg_marshall@hotmail.com', NULL, '707496474 (UK)', 'Autre', '2015-01-14 08:31:05', 18, '', ''),
('Gourmaud', 'Géneviève', '5 allée de la Noê Blanche', 44380, 'Pornichet', '0240612911', '', NULL, '120844300058', 'carte identité', '2015-01-14 11:02:11', 19, '', ''),
('Aubron', 'Stéphane', '20, rue pierre de Marivaux', 44600, 'Saint Nazaire', '0628036804', 'vir44@orange.fr', NULL, '', 'Pas de pièce', '2015-01-14 14:11:03', 20, '2', '3'),
('Lefranc', 'Jean', '19 rue de la Vallée', 44250, 'Saint Brévin', '0240274477', '', NULL, '110344300014', 'carte identité', '2015-01-14 14:11:51', 21, '', ''),
('Le Brin', 'Georges', '1 place henri Poincairé', 44600, 'Saint Nazaire', '0240221684', '', NULL, '', 'Pas de pièce', '2015-01-14 14:13:39', 22, '2', '3'),
('Auger', 'Thierry', 'Lotissement des chênes\r\n69, rue de la gare', 44320, 'Saint Père en Retz', '0684371446', 'thiaug@sfr.fr', NULL, '080544300616', 'carte identité', '2015-01-14 14:14:45', 23, '', ''),
('Soubry', 'Coline', '1, la croix Bayone', 44860, 'Pont Saint martin', '0000000000', '', NULL, '08AP13078', 'Autre', '2015-01-14 16:03:27', 24, '', ''),
('Ollivier', 'Jean-Yves', '21 routes de Landettes', 44600, 'Saint Nazaire', '0647420584', 'jyor@orange.fr', NULL, '', 'Pas de pièce', '2015-01-14 16:05:15', 25, '1', '3'),
('Dauce', 'Christiane', '39 rue Francois Marceau', 44600, 'Saint Nazaire', '0682374521', 'dauce.jean-paul@orange.fr', NULL, '', 'Pas de pièce', '2015-01-14 16:06:14', 26, '', ''),
('Gaudin', 'Marc', '29 rue des Fauvettes', 44600, 'Saint Nazaire', '0660650129', 'marc_gaudin@hotmail.fr', NULL, '890944300135', 'permis de conduire', '2015-01-14 16:08:40', 27, '1', '1'),
('Belliot Fauchou', 'Paulette', '102 rue de Caudurant', 44600, 'Saint Nazaire', '0240662261', '', NULL, '', 'Pas de pièce', '2015-01-16 10:10:56', 28, '2', '3'),
('Pierre', 'Erwan', '8 impasse du Bélot', 44117, 'Saint André des Eaux', '0687316135', 'san.erw.pierre@orange.fr', NULL, '111135304617', 'carte identité', '2015-01-19 14:02:17', 29, '1', '3'),
('Arnoud', 'Nicolas', '18 hameau au Beaulieu', 44350, 'Guérande', '0631236320', 'nicolas.arnoud@orange.fr', NULL, '021126300481', 'carte identité', '2015-01-19 14:03:22', 30, '1', '1'),
('Bossard', 'Analia', '27, lieu dit Le Pavillon', 44480, 'Donges', '0605150623', 'gaka2009@live.fr', NULL, '100744300163', 'carte identité', '2015-01-19 14:05:22', 31, '', ''),
('Girard', 'Soizick', '12 rue des Hibiscus', 44600, 'Saint Nazaire', '0699093143', 'soaziggirard@hotmail.com', NULL, '041277102200', 'carte identité', '2015-01-19 14:07:14', 32, '', ''),
('Le Reun', 'Yann', '3, rue Luc de Vauguenargues', 44600, 'Saint Nazaire', '0619583265', 'melinn@free.fr', NULL, '070975300294', 'carte identité', '2015-01-19 14:09:07', 33, '', ''),
('Frary', 'Philip', '4 clos des vieux chênes', 44260, 'Savenay', '0684097201', 'phil.frary@sparksource.fr', NULL, '101044300203', 'permis de conduire', '2015-01-19 14:11:13', 34, '2', '3'),
('Corduan', 'Olivier', '53 avenue Francois Miterrand', 44600, 'Saint Nazaire', '', 'olivier.corduan@free.fr', NULL, '', 'carte identité', '2015-01-19 14:12:59', 35, '2', '3'),
('Champy', 'Bernard', '10, rue de Jussieu', 44600, 'Saint Nazaire', '0240706680', '', NULL, '', 'carte identité', '2015-01-19 14:13:31', 36, '', ''),
('Moutel', 'Benjamin', '103 av guy de la Maunaudis', 44500, 'La Baule', '0674763365', 'moutelbenjamin@gmail.com', NULL, '049044204283', 'carte identité', '2015-01-19 14:15:14', 37, '', ''),
('Corlabe', 'Aurélie', '11, allée Alexander Fleming', 44600, 'Saint Nazaire', '0621525467', 'kongmaud@free.fr', NULL, '071144301297', 'carte identité', '2015-01-19 14:17:23', 38, '', ''),
('Violet', 'Viviane', '24 allée de la méjamerie', 44600, 'Saint Nazaire', '0761163794', 'alvitiloma@wanadoo.fr', NULL, 'AN91980', 'permis de conduire', '2015-01-19 14:19:19', 39, '', ''),
('Caux', 'Michel', '3 allée de l''Avel Kreisteil', 44600, 'Saint Nazaire', '0610643398', 'michel.caux@free.fr', NULL, '090844301936', 'carte identité', '2015-01-19 14:20:42', 40, '2', '3'),
('Guine', 'Karen', '12 rue Gabriel Fauré', 44600, 'Saint Nazaire', '0608727057', 'kalougui]yahoo.fr', NULL, '14014430288', 'carte identité', '2015-01-19 14:21:23', 41, '', ''),
('Halgand', 'Jean Yves', '108 allée des Archidées', 44600, 'Saint Nazaire', '0674447514', '', NULL, '091144301583', 'carte identité', '2015-01-20 12:28:55', 42, '2', '3'),
('Claro', 'Serge', '23, rue du Verger de Pradel', 44350, 'Guérande', '0626769522', '', NULL, '030194202170', 'carte identité', '2015-01-20 12:30:10', 43, '', ''),
('Barro', 'Jean marc', '67, route de Certe', 44600, 'Trignac', '0272274692', '', NULL, '120844301579', 'carte identité', '2015-01-20 12:31:57', 44, '', ''),
('Hatté', 'Francoise', '43, avenue Géo André', 44600, 'St Nazaire', '0240537787', '', NULL, '860444300210', 'carte identité', '2015-01-20 12:48:39', 45, '', ''),
('Daniel', 'Jean-Marc', '1, allée du chasse-marée', 44600, 'Saint Nazaire', '0240457419', 'jeanmarc.daniel@yahoo.fr', NULL, '120244302199', 'carte identité', '2015-01-20 12:50:14', 46, '', ''),
('Bazile', 'Brigitte', '31 chemin de Batz Sur Mer', 44260, 'Savenay', '0240583323', 'roger.bazile@sfr.fr', NULL, '070644300435', 'carte identité', '2015-01-20 12:52:07', 47, '', ''),
('Legal', 'emma', '21, rue etienne Lemerle', 44400, 'Reze', '0671639954', '', NULL, '140444300934', 'carte identité', '2015-01-20 12:54:07', 48, '', ''),
('Paboeuf', 'Eric', '', 44600, 'Saint Nazaire', '00000000', '', NULL, '', 'Pas de pièce', '2015-01-20 12:55:11', 49, '2', '3'),
('Blanchet', 'Charles Pierre', '34 C avenue du séquoia', 44300, 'Nantes', '0659420150', 'blanchet.charlespierre@laposte.net', NULL, '', 'Pas de pièce', '2015-01-20 12:56:33', 50, '', ''),
('Pierre', 'Jimmy', '19, rue des amazones', 44350, 'Bouguenais', '0672753558', '', NULL, '', 'Pas de pièce', '2015-01-20 12:58:26', 51, '1', '1'),
('Joalland', 'Bruno', '10, la Claie Rondeau', 44160, 'Pontchateau', '0605291270', '', NULL, '05444300231', 'carte identité', '2015-01-20 12:59:31', 52, '', ''),
('Ducoin', 'Irene', '43, rue Jules Mausard', 44600, 'Saint Nazaire', '0787129082', 'Prirene.ducoin@orange.fr', NULL, '090844301695', 'carte identité', '2015-01-20 15:01:57', 53, '2', '3'),
('Bachelier', 'Laurent', '41 avenue de Bretagne', 44500, 'La Baule', '0670619488', 'l.bachelier@hotmail.com', NULL, '130844301324', 'carte identité', '2015-01-20 15:02:50', 54, '', ''),
('Marceteau', 'Cyril', '37, av Egazel', 44250, 'Saint Brévin', '0000000000', '', NULL, '071044301466', 'carte identité', '2015-01-20 15:04:29', 55, '', ''),
('Ouvrard', 'Bertrand', '74, rue de la vecquerie', 44600, 'Saint Nazaire', '0786119118', 'jossine.ouvrard327@orange.fr', NULL, '', 'Pas de pièce', '2015-01-20 15:06:05', 56, '2', '3'),
('Barazer', 'Fabrice', '8, allée le trident', 44500, 'La Baule', '0272272144', 'barazer.perrin@hotmail.fr', NULL, '061244300339', 'carte identité', '2015-01-20 15:07:06', 57, '', ''),
('Leray', 'Jean-Claude', '1 chemin de la Cannerie', 44600, 'Saint Nazaire', '0620472678', '', NULL, '', 'Pas de pièce', '2015-01-20 15:08:49', 58, '2', '3'),
('Audouin-Joubier', 'Cécile', '25 rue Georges Cuvier', 44600, 'Saint Nazaire', '0240530172', '', NULL, '130444300809', 'carte identité', '2015-01-20 15:09:36', 59, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE IF NOT EXISTS `objet` (
  `obj_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `obj_numero` int(11) NOT NULL,
  `obj_numero_bav` varchar(10) NOT NULL,
  `obj_type` enum('Route','VTT','VTC','Tamden','BMX','Ville','Demi-Course','Autre') NOT NULL DEFAULT 'VTT',
  `obj_public` enum('homme','femme','enfant','mixte','Autre') NOT NULL,
  `obj_marque` varchar(100) DEFAULT NULL,
  `obj_modele` varchar(100) DEFAULT NULL,
  `obj_description` text,
  `obj_couleur` varchar(20) DEFAULT NULL,
  `obj_prix_1` decimal(10,2) NOT NULL,
  `obj_prix_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `obj_prix_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `obj_id_vendeur` int(11) NOT NULL,
  `obj_id_acheteur` int(11) DEFAULT NULL,
  `obj_date_depot` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obj_date_vente` datetime DEFAULT NULL,
  `obj_date_retour` datetime DEFAULT NULL,
  `obj_prix_vente` decimal(10,2) NOT NULL,
  `obj_comission` decimal(10,2) NOT NULL,
  `obj_prix_depot` decimal(10,2) NOT NULL,
  `obj_type_achat` enum('Espèce','Chèque') NOT NULL DEFAULT 'Espèce',
  `obj_taille` varchar(20) NOT NULL,
  PRIMARY KEY (`obj_id`),
  UNIQUE KEY `obj_id` (`obj_id`),
  UNIQUE KEY `obj_numero` (`obj_numero`,`obj_numero_bav`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `objet`
--

INSERT INTO `objet` (`obj_id`, `obj_numero`, `obj_numero_bav`, `obj_type`, `obj_public`, `obj_marque`, `obj_modele`, `obj_description`, `obj_couleur`, `obj_prix_1`, `obj_prix_2`, `obj_prix_3`, `obj_id_vendeur`, `obj_id_acheteur`, `obj_date_depot`, `obj_date_vente`, `obj_date_retour`, `obj_prix_vente`, `obj_comission`, `obj_prix_depot`, `obj_type_achat`, `obj_taille`) VALUES
(10, 846, '2014', 'Route', 'homme', 'Décathlon', 'Cobra 560', '', 'Bleu', 150.00, 0.00, 0.00, 1, NULL, '2015-01-14 07:38:19', NULL, '2015-01-14 08:38:45', 0.00, 0.00, 0.00, 'Espèce', ''),
(11, 209, '2014', 'VTT', 'homme', 'Dynamic', '', 'Neuf', 'Rouge', 95.00, 0.00, 0.00, 5, 6, '2015-01-14 07:39:23', '2015-01-14 09:12:27', NULL, 0.00, 0.00, 0.00, 'Chèque', 'L'),
(12, 655, '2014', 'Route', 'homme', 'Look', 'Carbone 2006', 'Vélo de compétition équipe Crédit Agricole Tour 2006 avec patrice Halgand (taille 1.80)', 'Blanc', 2800.00, 2100.00, 0.00, 7, NULL, '2015-01-14 07:43:00', NULL, '2015-01-14 08:44:00', 0.00, 0.00, 0.00, 'Espèce', ''),
(13, 688, '2014', 'Route', 'enfant', 'Décathlon', 'Planet Fun', 'Vélo enfant 7-11 ans idéal triathlon ou FFC', 'Bleu', 165.00, 0.00, 0.00, 4, NULL, '2015-01-14 07:44:58', NULL, '2015-01-14 08:45:56', 0.00, 0.00, 0.00, 'Espèce', ''),
(14, 168, '2014', 'VTT', 'homme', 'EXS', '', 'année 2012', 'Noir', 59.00, 0.00, 0.00, 8, 9, '2015-01-14 07:46:36', '2015-01-14 09:03:18', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(15, 750, '2014', 'BMX', 'mixte', 'Stalemax', '', '2002 -', 'Gis-noir', 49.00, 0.00, 0.00, 8, 10, '2015-01-14 08:16:30', '2015-01-14 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(16, 372, '2014', 'VTT', 'homme', 'Gitane', 'Oxius', 'Pneu neuf', 'Blanc', 60.00, 0.00, 0.00, 11, 12, '2015-01-14 08:18:35', '2015-01-14 00:00:00', NULL, 0.00, 0.00, 0.00, 'Espèce', 'L'),
(17, 465, '2014', 'VTT', 'enfant', 'Décathlon', '', '', 'Rouge et noir', 50.00, 0.00, 0.00, 13, 14, '2015-01-14 08:21:31', '2015-01-14 00:00:00', NULL, 0.00, 0.00, 0.00, 'Espèce', '14 pouces'),
(18, 885, '2014', 'Ville', 'femme', 'Topbike', 'city', '5 vitesses TBE', 'Noir', 110.00, 0.00, 0.00, 15, 16, '2015-01-14 08:25:18', '2015-01-14 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(19, 2, '2014', 'VTT', 'homme', 'RockRider', '320', '', 'gris', 60.00, 50.00, 0.00, 17, 18, '2015-01-14 08:28:50', '2015-01-14 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(20, 3, '2014', 'VTT', 'homme', 'Mariner', 'Suspension', 'Slooping', 'Bleu-Gris metalisé', 50.00, 0.00, 0.00, 17, 19, '2015-01-14 11:01:06', '2015-01-14 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(21, 4, '2014', 'VTC', 'femme', 'Raleigh', 'Edition limitée  "ORIAN"', '2 ans TBE', 'Blanc et marron', 190.00, 0.00, 0.00, 20, 21, '2015-01-14 14:09:53', '2015-01-14 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(22, 5, '2014', 'Autre', 'enfant', 'Sans marque', 'Spiderman', '', 'Bleu et Rouge', 15.00, 0.00, 0.00, 22, 20, '2015-01-14 14:12:47', '2015-01-20 11:52:27', NULL, 0.00, 0.75, 0.00, 'Espèce', ''),
(23, 6, '2014', 'Autre', 'enfant', 'Sans marque', '', 'Roulettes', '', 15.00, 0.00, 0.00, 22, NULL, '2015-01-14 14:15:27', NULL, '2015-01-14 15:15:46', 0.00, 0.00, 0.00, 'Espèce', ''),
(24, 7, '2014', 'Autre', 'enfant', 'Sans marque', 'Micro', '', 'Vet et rose', 25.00, 0.00, 0.00, 22, NULL, '2015-01-14 16:01:03', NULL, '2015-01-14 17:01:19', 0.00, 0.00, 0.00, 'Espèce', ''),
(25, 8, '2014', 'Autre', 'enfant', 'MBK', '', '', 'Vert et blanc', 30.00, 0.00, 0.00, 22, NULL, '2015-01-14 16:01:56', NULL, '2015-01-20 11:58:05', 0.00, 0.00, 0.00, 'Espèce', ''),
(26, 9, '2014', 'Route', 'homme', 'Gitane', '', '', 'Vert', 30.00, 0.00, 0.00, 22, 24, '2015-01-14 16:02:40', '2015-01-20 12:03:33', NULL, 0.00, 1.50, 0.00, 'Espèce', ''),
(27, 10, '2014', 'Ville', 'femme', 'MGI', 'Alternative', '', 'noir', 90.00, 80.00, 0.00, 25, 26, '2015-01-14 16:04:04', '2015-01-14 17:06:44', NULL, 0.00, 0.00, 0.00, 'Espèce', ''),
(28, 11, '2014', 'Route', 'homme', 'AQUA', '1014', 'Achat le 01/02/2014 - 1000 km', 'Noir Bleu', 990.00, 0.00, 0.00, 27, NULL, '2015-01-14 16:07:44', NULL, '2015-01-14 17:08:43', 0.00, 0.00, 0.00, 'Espèce', '54'),
(29, 12, '2014', 'VTC', 'femme', 'Décathlon', '', '', 'maron', 100.00, 0.00, 0.00, 28, 15, '2015-01-16 10:10:14', '2015-01-19 15:00:10', NULL, 0.00, 0.00, 0.00, 'Espèce', ''),
(30, 13, '2014', 'Autre', 'enfant', 'jockey', 'Tricycle', '', 'Bordeaux', 10.00, 0.00, 0.00, 29, 30, '2015-01-19 14:01:04', '2015-01-20 12:26:29', NULL, 0.00, 1.00, 0.00, 'Espèce', ''),
(31, 14, '2014', 'Autre', 'enfant', 'Btwin', '', '', 'Rose', 20.00, 0.00, 0.00, 29, 31, '2015-01-19 14:03:56', '2015-01-20 12:26:55', NULL, 0.00, 2.00, 0.00, 'Espèce', ''),
(32, 15, '2014', 'Route', 'enfant', 'Peugeot', '', '', 'Vert', 25.00, 0.00, 0.00, 29, 32, '2015-01-19 14:05:53', '2015-01-20 12:27:21', NULL, 0.00, 2.50, 0.00, 'Espèce', ''),
(33, 16, '2014', 'Autre', 'Autre', 'Hamax', 'Siège vélo', '', 'Gris', 50.00, 30.00, 0.00, 29, 33, '2015-01-19 14:07:57', '2015-01-20 12:27:53', NULL, 0.00, 3.00, 0.00, 'Espèce', ''),
(34, 17, '2014', 'Autre', 'enfant', 'Raleigh', 'Filles-Daisy', '', 'Rose/violet', 35.00, 28.00, 0.00, 34, NULL, '2015-01-19 14:10:03', NULL, '2015-01-19 15:11:19', 0.00, 0.00, 0.00, 'Espèce', '14 pouces'),
(35, 18, '2014', 'VTT', 'homme', 'Nakamura', '', 'Année 1998', 'Rouge', 90.00, 0.00, 0.00, 35, 36, '2015-01-19 14:12:19', '2015-01-19 00:00:00', NULL, 0.00, 0.00, 0.00, 'Espèce', 'M/44'),
(36, 19, '2014', 'VTT', 'homme', 'Voodoo', '', '', 'Cuivre', 390.00, 0.00, 0.00, 35, 37, '2015-01-19 14:14:11', '2015-01-19 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', 'M/17'),
(37, 20, '2014', 'VTT', 'enfant', 'Lapierre', '', '', 'Alu et rouge', 140.00, 90.00, 0.00, 35, 38, '2015-01-19 14:16:07', '2015-01-19 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', '24 pouces'),
(38, 23, '2014', 'Autre', 'Autre', 'Mottez', '4 places', '', 'gris', 100.00, 0.00, 0.00, 2, 39, '2015-01-19 14:17:51', '2015-01-19 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(39, 24, '2014', 'VTC', 'femme', 'Sans marque', '', '', 'noir', 100.00, 0.00, 0.00, 40, 41, '2015-01-19 14:19:53', '2015-01-19 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', '58'),
(40, 21, '2014', 'VTT', 'homme', 'Sunn', '', '', 'Blanc', 340.00, 0.00, 0.00, 42, 43, '2015-01-20 12:27:59', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(41, 22, '2014', 'VTT', 'enfant', 'Bike Sprint', '18 vitesses', '', 'Rouge', 60.00, 0.00, 0.00, 42, 44, '2015-01-20 12:30:53', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(42, 25, '2014', 'VTT', 'femme', 'Sans marque', '', '', 'balnc', 50.00, 0.00, 0.00, 40, 45, '2015-01-20 12:32:29', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(43, 26, '2014', 'VTC', 'homme', 'Sans marque', '', '', 'gris', 90.00, 0.00, 0.00, 40, 46, '2015-01-20 12:49:16', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', '54'),
(44, 27, '2014', 'VTC', 'femme', 'Sans marque', '', '', 'Rouge', 70.00, 0.00, 0.00, 40, 47, '2015-01-20 12:50:50', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', '54'),
(45, 28, '2014', 'VTC', 'homme', 'Giant', 'GSR 700c', '', 'Gris Bleu', 180.00, 0.00, 0.00, 40, 48, '2015-01-20 12:53:24', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', '54'),
(46, 29, '2014', 'Route', 'homme', 'Colombus', '', '', 'Bleu et gris', 245.00, 0.00, 0.00, 49, 50, '2015-01-20 12:54:33', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Espèce', '58'),
(47, 30, '2014', 'Route', 'homme', 'Scott', 'Speedster', '', 'rouge, blanc noir', 560.00, 0.00, 0.00, 51, 52, '2015-01-20 12:57:19', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', '56'),
(48, 31, '2014', 'Autre', 'enfant', 'Oxelo', 'Trortinette', '', 'Noire', 40.00, 0.00, 0.00, 53, 54, '2015-01-20 15:00:55', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(49, 32, '2014', 'VTT', 'enfant', 'Décathlon', '', '', 'Jaune', 65.00, 0.00, 0.00, 53, 55, '2015-01-20 15:03:27', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', ''),
(50, 33, '2014', 'Route', 'homme', 'Vitus', '', '', 'Bleu', 150.00, 0.00, 0.00, 56, 57, '2015-01-20 15:05:06', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', '52/54'),
(51, 34, '2014', 'Route', 'homme', 'Scott', 'TS', '', 'Gris', 490.00, 0.00, 0.00, 58, 59, '2015-01-20 15:08:02', '2015-01-20 00:00:00', NULL, 0.00, 0.00, 0.00, 'Chèque', 'L');

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
  `par_prix_depot_3` decimal(10,2) NOT NULL,
  `par_date` date NOT NULL,
  PRIMARY KEY (`par_numero_bav`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `parametre`
--

INSERT INTO `parametre` (`par_numero_bav`, `par_taux_1`, `par_taux_2`, `par_taux_3`, `par_prix_depot_1`, `par_prix_depot_2`, `par_prix_depot_3`, `par_date`) VALUES
('2013', 10, 5, 0, 3.00, 1.00, 0.00, '2013-08-11'),
('2014', 10, 5, 0, 3.00, 0.00, 0.00, '2014-11-01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
