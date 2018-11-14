-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Version du serveur: 5.5.40-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de donnÃ©es: BAV
--

-- --------------------------------------------------------

--
-- Structure de la table client
--
CREATE TABLE IF NOT EXISTS client (
  cli_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  cli_nom varchar(100) NOT NULL,
  cli_adresse text,
  cli_telephone varchar(15) DEFAULT NULL,
  cli_emel varchar(100) DEFAULT NULL,
  cli_taux_com enum('1','2','3') NOT NULL DEFAULT '1',
  cli_prix_depot enum('1','2','3') NOT NULL DEFAULT '1'
  PRIMARY KEY (cli_id),
  UNIQUE KEY cli_id (cli_id),
  UNIQUE KEY cli_id_2 (cli_id),
  KEY cli_nom (cli_nom)
) 

-- --------------------------------------------------------

--
-- Structure de la table objet
--

CREATE TABLE IF NOT EXISTS 'objet' (
  obj_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  obj_numero int(11) NOT NULL,
  obj_id_modif varchar(5) NOT NULL,
  obj_numero_bav int(11) NOT NULL,
  obj_type enum('Route','VTT','VTC','Tamden','BMX','Ville','Demi-Course','Autre') NOT NULL DEFAULT 'Autre',
  obj_public enum('homme','femme','mixte','enfant','gar�on','fille','Autre') NOT NULL DEFAULT 'Autre',
  obj_marque varchar(50) NOT NULL,
  obj_modele varchar(50) DEFAULT NULL,
  obj_couleur varchar(30) NOT NULL,
  obj_description text,
  obj_prix_depot decimal(10,2) NULL,
  obj_date_depot timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  obj_prix_vente decimal(10,2) ,
  obj_date_vente datetime,
  obj_prix_modif decimal(10,2) ,
  obj_id_vendeur int(11) NOT NULL,
  obj_id_acheteur int(11),
  obj_prix_vente decimal(10,2) NOT NULL DEFAULT 0.00,
  obj_date_retour datetime
  PRIMARY KEY (obj_id),
  UNIQUE KEY obj_id (obj_id),
  UNIQUE KEY obj_numero (obj_numero,obj_numero_bav)
) 

CREATE TABLE IF NOT EXISTS parametre (
  par_numero_bav varchar(10) NOT NULL,
  par_taux_1 int(11) NOT NULL  DEFAULT 0.00,
  par_taux_2 int(11) NOT NULL  DEFAULT 0.00,
  par_taux_3 int(11) NOT NULL  DEFAULT 0.00,
  par_prix_depot_1 decimal(10,2) NOT NULL  DEFAULT 0.00,
  par_prix_depot_2 decimal(10,2) NOT NULL DEFAULT 0.00,
  par_prix_depot_3 decimal(10,2) NOT NULL DEFAULT 0.00,
  par_date_debut date NOT NULL,
  par_date_bourse date NOT NULL,
  PRIMARY KEY (par_numero_bav)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table parametre
--

INSERT INTO parametre  VALUES
('2019', 10, 5, 0, 3.00, 1.00, 0.00, '2019-10-01','2019-11-08'),
('2018', 10, 5, 0, 3.00, 1.00, 0.00, '2018-10-01','2018-11-09'),
