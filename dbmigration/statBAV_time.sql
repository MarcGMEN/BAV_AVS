select laDate , sum(depot) "depot", sum(vente) "vente" , sum(retour) "retour" 
from (
select DATE_FORMAT(bo.obj_date_depot, "%Y%m%d%H") laDate, count(*) "depot", 0 "vente"  , 0 "retour"
from bav_objet bo 
where bo.obj_numero_bav ='2021'
and bo.obj_date_depot is not null
group by 1
union
select DATE_FORMAT(bo1.obj_date_vente, "%Y%m%d%H") laDate, 0 "depot" ,   count(*) "vente", 0 "retour"
from bav_objet bo1 
where bo1.obj_numero_bav ='2021'
and bo1.obj_date_vente is not null
group by 1
union
select DATE_FORMAT(bo2.obj_date_retour, "%Y%m%d%H") laDate, 0 "depot" , 0 "vente" , count(*) "retour"  
from bav_objet bo2 
where bo2.obj_numero_bav ='2021'
and bo2.obj_date_retour is not null
group by 1
) as tmpTap
where laDate > "2021111912"
group by 1
order by 1