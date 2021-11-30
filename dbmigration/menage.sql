
SELECT cli_nom, cli_emel FROM `bav_client` 
where not exists (select obj_id_vendeur from bav_objet where obj_id_vendeur = cli_id OR obj_id_acheteur = cli_id );
delete from  `bav_client` 
where not exists (select obj_id_vendeur from bav_objet where obj_id_vendeur = cli_id OR obj_id_acheteur = cli_id )

