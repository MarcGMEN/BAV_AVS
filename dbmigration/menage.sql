
-- recherche des clients sans fiche
SELECT cli_nom, cli_emel FROM `bav_client` 
where not exists (select obj_id_vendeur from bav_objet where obj_id_vendeur = cli_id OR obj_id_acheteur = cli_id )
and cli_id > 10

-- suppression des clients sans fiche
delete from  `bav_client` 
where not exists (select obj_id_vendeur from bav_objet where obj_id_vendeur = cli_id OR obj_id_acheteur = cli_id )
and cli_id > 10;


update bav_objet set obj_type = 'Route' where obj_type  ='Demi-course';  
update bav_objet set obj_type = 'Autre' where obj_type  ='Velo';
update bav_objet set obj_public = 'Mixte' where obj_public  ='Enfant';

ALTER TABLE bav.bav_objet MODIFY COLUMN obj_type enum('Autre','Route','Gravel','Enfant','VTT','VTC','Ville','Tamden','BMX','VAE','Draisiene') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Autre' NULL;
ALTER TABLE bav.bav_objet MODIFY COLUMN obj_public enum('Autre','Homme','Femme','Mixte','Garçon','Fille') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Autre' NULL;


INSERT INTO bav_client (cli_id, cli_id_modif, cli_nom, cli_emel, cli_adresse, cli_adresse1, cli_code_postal, cli_ville, cli_telephone, cli_telephone_bis, cli_taux_com, cli_prix_depot) VALUES(1, '4040e35284bdf5405cb3070134d900a7', 'Vendeur 2019', 'bourseauxvelosV2019@avs.com', '', '', '', '', '', '', 10.00, 3.00);
INSERT INTO bav_client (cli_id, cli_id_modif, cli_nom, cli_emel, cli_adresse, cli_adresse1, cli_code_postal, cli_ville, cli_telephone, cli_telephone_bis, cli_taux_com, cli_prix_depot) VALUES(2, '2eef1be7ce272b7089400619618b1637', 'Acheteur 2019', 'bourseauxvelosA2019@avs.com', '', '', '', '', '', '', 10.00, 3.00);
INSERT INTO bav_client (cli_id, cli_id_modif, cli_nom, cli_emel, cli_adresse, cli_adresse1, cli_code_postal, cli_ville, cli_telephone, cli_telephone_bis, cli_taux_com, cli_prix_depot) VALUES(3, '52df4bc606eaddf149390506ab8cd73f', 'Vendeur 2021', 'bourseauxvelosV2021@avs.com', '', '', '', '', '', '', 10.00, 3.00);
INSERT INTO bav_client (cli_id, cli_id_modif, cli_nom, cli_emel, cli_adresse, cli_adresse1, cli_code_postal, cli_ville, cli_telephone, cli_telephone_bis, cli_taux_com, cli_prix_depot) VALUES(4, '0b894c49a867df1b790d8d8c37bdf16e', 'Acheteur 2021', 'bourseauxvelosA2021@avs.com', '', '', '', '', '', '', 10.00, 3.00);
INSERT INTO bav_client (cli_id, cli_id_modif, cli_nom, cli_emel, cli_adresse, cli_adresse1, cli_code_postal, cli_ville, cli_telephone, cli_telephone_bis, cli_taux_com, cli_prix_depot) VALUES(5, '1d9dc5d01174efa146031b68a38761aa', 'Vendeur 2022', 'bourseauxvelosV2022@avs.com', '', '', '', '', '', '', 10.00, 3.00);
INSERT INTO bav_client (cli_id, cli_id_modif, cli_nom, cli_emel, cli_adresse, cli_adresse1, cli_code_postal, cli_ville, cli_telephone, cli_telephone_bis, cli_taux_com, cli_prix_depot) VALUES(6, 'a1ca58ffe9a3f0118dc85ec596229079', 'Acheteur 2022', 'bourseauxvelosA2022@avs.com', '', '', '', '', '', '', 10.00, 3.00);
-- => OK le 24/11/2022 

INSERT INTO bav_client (cli_id, cli_id_modif, cli_nom, cli_emel, cli_adresse, cli_adresse1, cli_code_postal, cli_ville, cli_telephone, cli_telephone_bis, cli_taux_com, cli_prix_depot) VALUES(7 '1d9dc5d01174efa148031b68a38761ab', 'Vendeur 2023', 'bourseauxvelosV2023@avs.com', '', '', '', '', '', '', 10.00, 3.00);
INSERT INTO bav_client (cli_id, cli_id_modif, cli_nom, cli_emel, cli_adresse, cli_adresse1, cli_code_postal, cli_ville, cli_telephone, cli_telephone_bis, cli_taux_com, cli_prix_depot) VALUES(8, 'a1ca58ffe9a3f0117dc85ec59622907b', 'Acheteur 2023', 'bourseauxvelosA2023@avs.com', '', '', '', '', '', '', 10.00, 3.00);

-- purge des clients 2019 : OK le 24/11/2022
update bav_objet 
set obj_id_vendeur = 1
where obj_numero_bav = '2019' 

update bav_objet 
set obj_id_acheteur = 2 
where obj_numero_bav = '2019' 
and (obj_id_acheteur is not null or obj_id_acheteur = 0 or obj_etat in ('PAYE','VENDU') ) ;

-- purge des clients 2021 : OK le 24/11/2022
update bav_objet 
set obj_id_vendeur = 3
where obj_numero_bav = '2021' 

update bav_objet 
set obj_id_acheteur = 4 
where obj_numero_bav = '2021' 
and (obj_id_acheteur is not null or obj_id_acheteur = 0 or obj_etat in ('PAYE','VENDU') ) ;

-- purge des clients 2022 : OK le 
select  count(*) from bav_objet 
where obj_numero_bav = '2022';
--1293

select  count(*) from bav_objet 
where obj_numero_bav = '2022'
and (obj_id_acheteur is not null or obj_id_acheteur != 0) and obj_etat in ('PAYE','VENDU')  ;
-- 793

update bav_objet 
set obj_id_vendeur = 6
where obj_numero_bav = '2022';

update bav_objet 
set obj_id_acheteur = 5 
where obj_numero_bav = '2022' 
and (obj_id_acheteur is not null or obj_id_acheteur != 0) and obj_etat in ('PAYE','VENDU')  ;

-- purge des clients 2023 : OK le 
select  count(*) from bav_objet 
where obj_numero_bav = '2023';
--1293

select  count(*) from bav_objet 
where obj_numero_bav = '2023'
and (obj_id_acheteur is not null or obj_id_acheteur != 0) and obj_etat in ('PAYE','VENDU')  ;
-- 793

update bav_objet 
set obj_id_vendeur = 7
where obj_numero_bav = '2023';

update bav_objet 
set obj_id_acheteur = 8 
where obj_numero_bav = '2023' 
and (obj_id_acheteur is not null or obj_id_acheteur != 0) and obj_etat in ('PAYE','VENDU')  ;

