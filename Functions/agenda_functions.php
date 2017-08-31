<?php
function return_evt($id) {
	$requete2 = " SELECT ".CFG_PREFIXE_TABLE."calendrier.*, ".CFG_PREFIXE_TABLE."rubrique.* from ".CFG_PREFIXE_TABLE."calendrier, ".CFG_PREFIXE_TABLE."rubrique ";
	$requete2 .= " where cal_id = ".$id;
	$requete2 .= " and rub_id = cal_id_rub ";
	$resultat = mysql_query($requete2);
	$i=0;
	$row = mysql_fetch_array($resultat, MYSQL_ASSOC);

	return $row;

}

function return_evtByDateForUser($date1, $date2, $idUser) {
  $tabReturn=array();
  $requete2 = " SELECT ".CFG_PREFIXE_TABLE."calendrier.*, ".CFG_PREFIXE_TABLE."rubrique.rub_libelle ";
  $requete2 .= " from ".CFG_PREFIXE_TABLE."calendrier, ".CFG_PREFIXE_TABLE."rubrique ";
  $requete2 .= " where cal_date between '".date('Y-m-d',$date1)."' and '".date('Y-m-d',$date2)."' ";
  $requete2 .= " and rub_id = cal_id_rub ";
  $requete2 .= " order by cal_date  ";
  $resultat = mysql_query($requete2);
  $i=0;
  
  $leUser=null;
  if ($idUser != "") {
    $leUser=return_user($idUser);
  }
  
  while ($row = mysql_fetch_array($resultat, MYSQL_ASSOC)) {
    $rubMedia=return_rubrique($row['cal_id_rub']);
    if (droitUDMedia($rubMedia, $leUser,$row['cal_id_usr']) && $leUser!= null) {
      $row['droit']=true;
    }
    else {
      $row['droit']=false;
    }
    $tabReturn[$i++] = $row;
  }

return $tabReturn;

}
?>