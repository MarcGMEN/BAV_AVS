SELECT date(obj_date_depot), count(*) FROM `bav_objet`
where obj_numero_bav = '2022'
and obj_etat = 'CONFIRME'
group by 1