-- --------------------------------------------------------

--
-- Structure de la table client
--
CREATE TABLE IF NOT EXISTS client (
  cli_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  cli_nom varchar(100) NOT NULL,
  cli_emel varchar(100) DEFAULT NULL,
  cli_adresse varchar(100),
  cli_adresse1 varchar(100),
  cli_code_postal varchar(10),
  cli_ville varchar(100),
  cli_telephone varchar(15) DEFAULT NULL,
  cli_taux_com enum('1','2','3') NOT NULL DEFAULT '1',
  cli_prix_depot enum('1','2','3') NOT NULL DEFAULT '1',
  PRIMARY KEY (cli_id),
  UNIQUE KEY cli_id (cli_id),
  UNIQUE KEY cli_id_2 (cli_emel),
  KEY cli_nom (cli_nom)
) ;

-- --------------------------------------------------------

--
-- Structure de la table objet
--

CREATE TABLE IF NOT EXISTS objet (
  obj_id bigint(20) NOT NULL AUTO_INCREMENT,
  obj_numero int(11) NOT NULL,
  obj_id_modif varchar(5) NOT NULL,
  obj_numero_bav int(11) NOT NULL,
  obj_type enum('Route','VTT','VTC','Tamden','BMX','Ville','Demi-Course','Autre') NOT NULL DEFAULT 'Autre',
  obj_public enum('homme','femme','mixte','enfant','garçon','fille','Autre') NOT NULL DEFAULT 'Autre',
  obj_marque varchar(50),
  obj_modele varchar(50),
  obj_couleur varchar(30),
  obj_description text,
  obj_prix_depot decimal(10,2) NULL,
  obj_date_depot timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  obj_prix_vente decimal(10,2) NOT NULL DEFAULT 0.00,
  obj_date_vente datetime,
  obj_prix_modif decimal(10,2) ,
  obj_id_vendeur int(11) NOT NULL,
  obj_id_acheteur int(11),
  obj_date_retour datetime,
  PRIMARY KEY (obj_id),
  UNIQUE KEY obj_id (obj_id),
  UNIQUE KEY obj_id_2 (obj_id_modif),
  UNIQUE KEY obj_numero (obj_numero, obj_numero_bav),
  KEY obj_marque (obj_marque)
) ;

CREATE TABLE IF NOT EXISTS parametre (
  par_numero_bav varchar(10) NOT NULL,
  par_taux_1 int(11) NOT NULL  DEFAULT 0.00,
  par_taux_2 int(11) NOT NULL  DEFAULT 0.00,
  par_taux_3 int(11) NOT NULL  DEFAULT 0.00,
  par_prix_depot_1 decimal(10,2) NOT NULL  DEFAULT 0.00,
  par_prix_depot_2 decimal(10,2) NOT NULL DEFAULT 0.00,
  par_prix_depot_3 decimal(10,2) NOT NULL DEFAULT 0.00,
  par_client_date_debut date NOT NULL,
  par_client_date_fin date NOT NULL,
  par_table_date_debut date NOT NULL,
  par_table_date_fin date NOT NULL,
  par_table_id_mac varchar(600),
  par_titre varchar(100),
  PRIMARY KEY (par_numero_bav)
) ;
--
-- Contenu de la table parametre
--

INSERT INTO parametre  VALUES
('2019', 10, 5, 0, 3.00, 1.00, 0.00, '2019-10-01','2019-11-11','2019-11-08','2019-11-11','','16eme. La bourse au 1200 velos');