
-- recherche des clients sans fiche
SELECT cli_nom, cli_emel FROM `bav_client` 
where not exists (select obj_id_vendeur from bav_objet where obj_id_vendeur = cli_id OR obj_id_acheteur = cli_id );

-- suppression des clients sans fiche
delete from  `bav_client` 
where not exists (select obj_id_vendeur from bav_objet where obj_id_vendeur = cli_id OR obj_id_acheteur = cli_id )


update bav_objet set obj_type = 'Route' where obj_type  ='Demi-course';  
update bav_objet set obj_type = 'Autre' where obj_type  ='Velo';
update bav_objet set obj_public = 'Mixte' where obj_public  ='Enfant';

ALTER TABLE bav.bav_objet MODIFY COLUMN obj_type enum('Autre','Route','Gravel','Enfant','VTT','VTC','Ville','Tamden','BMX','VAE','Draisiene') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Autre' NULL;
ALTER TABLE bav.bav_objet MODIFY COLUMN obj_public enum('Autre','Homme','Femme','Mixte','Garçon','Fille') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Autre' NULL;



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
update bav_objet 
set obj_id_acheteur = 5 
where obj_numero_bav = '2022' 
and (obj_id_acheteur is not null or obj_id_acheteur = 0 or obj_etat in ('PAYE','VENDU') ) ;

update bav_objet 
set obj_id_vendeur = 6
where obj_numero_bav = '2022' 
