<?php

$module="agenda";
require "../Functions/".$module."_functions.php";

/**************************************/
/**************************************/
/* AGENDA */
/**************************************/
/**************************************/

function return_evtByDateForUser_ajax($date1, $date2, $idUser) {
  $tab = return_evtByDateForUser($date1, $date2, $idUser);
  foreach ($tab as $key => $val) {
    $tab[$key]['cal_lieu']=utf8Encode($tab[$key]['cal_lieu']);
    $tab[$key]['cal_titre']=utf8Encode($tab[$key]['cal_titre']);
    //$tab[$key]['cal_commentaire']=utf8Encode(nl2br($tab[$key]['cal_commentaire']));
    $tab[$key]['cal_commentaire']=utf8Encode($tab[$key]['cal_commentaire']);
    $tab[$key]['rub_libelle']=utf8Encode($tab[$key]['rub_libelle']);
  }
  return $tab;
}

function return_evt_ajax($id) {
  $row= return_evt($id);
  $row['cal_lieu']=utf8Encode($row['cal_lieu']);
  $row['cal_titre']=utf8Encode($row['cal_titre']);
  $row['cal_commentaire']=utf8Encode($row['cal_commentaire']);
  
  $rub=return_rubrique($row['cal_id_rub']);
  $rub['rub_libelle']=utf8Encode($rub['rub_libelle']);
  
  $row['rub']=$rub;
  return $row;
}


function update_LatLng($idEvt, $lat, $lng) {
  $requete1 = " update ".CFG_PREFIXE_TABLE."calendrier ";
  $requete1 .= " set cal_latitude = $lat ";
  $requete1 .= " , cal_longitude = $lng ";
  $requete1 .= " where cal_id = $idEvt ";
  if (!$resultat1 = mysql_query($requete1)) {
    echo "erreur sur $requete1 ".mysql_error()."<br/>";
     
  }
}

function return_evts($delai) {
  $today=date('Y-m-d');
  $dateTmp=mktime(0,0,0,date('m')+$delai,date('d'), date('Y'));
  $unMois=date('Y-m-d',$dateTmp);

  $requete1 = "select cal_date, cal_lieu, cal_commentaire, cal_titre, rub_libelle ";
  $requete1 .= " from ".CFG_PREFIXE_TABLE."calendrier, ".CFG_PREFIXE_TABLE."rubrique where cal_date >= '".$today."' ";
  $requete1 .= " and cal_date <= '".$unMois."'";
  //$requete1 .= " and (cal_id_rub = ".$GET_rub;
  //$requete1 .= " or rub_id_rub = ".$GET_rub.")";
  $requete1 .= " and cal_id_rub = rub_id ";
  $requete1 .= " order by cal_date asc";
  $resultat1 = mysql_query($requete1);

  $tabRetour=array();
  $index=0;
  while (($row1 = mysql_fetch_array($resultat1, MYSQL_ASSOC))) {
     
    $row1['cal_lieu']=utf8Encode($row1['cal_lieu']);
    $row1['cal_titre']=utf8Encode($row1['cal_titre']);
    $row1['cal_commentaire']=utf8Encode($row1['cal_commentaire']);
    $row1['rub_libelle']=utf8Encode($row1['rub_libelle']);
    $tabRetour[$index++]=$row1;
  }

  return  $tabRetour;
}
?>