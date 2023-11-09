SELECT obj_prix_depot, obj_prix_vente ,  (1-obj_prix_vente/obj_prix_depot)*100
from bav_objet 
where obj_numero_bav = '2022' 
and obj_prix_depot  != obj_prix_vente 
and obj_prix_vente  > 0
order by 3