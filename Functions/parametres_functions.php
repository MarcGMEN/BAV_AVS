<?php
function return_taux_commision() {
	$requete2 = " SELECT * from parametre ";
	$resultat = mysql_query ( $requete2 );
	$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );

	$tabTaux[1]=$row["par_taux_1"];
	$tabTaux[2]=$row["par_taux_2"];
	$tabTaux[3]=$row["par_taux_3"];
	
	return $tabTaux; 
}

function return_prix_depot() {
	$requete2 = " SELECT * from parametre ";
	$resultat = mysql_query ( $requete2 );
	$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );

	$tabTaux[1]=$row["par_prix_depot_1"];
	$tabTaux[2]=$row["par_prix_depot_2"];
	$tabTaux[3]=$row["par_prix_depot_3"];

	return $tabTaux;
}

function get_numero_bav() {
	$requete2 = " SELECT par_numero_bav from parametre ";
	$requete2 .= " where par_date < '".date("Y-m-d")."'";
	$requete2 .= " order by  par_date  desc ";
	
	//echo $requete2 ;
	$resultat = mysql_query ( $requete2 );
	$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );

	return $row['par_numero_bav'];
}

function get_numeros_bav() {
	$requete2 = " SELECT par_numero_bav from parametre ";
	$requete2 .= " where par_date < '".date("Y-m-d")."'";
	$requete2 .= " order by par_date  desc ";
	
	//echo $requete2 ;
	$resultat = mysql_query ( $requete2 );
	$index=0;
	while ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) {
		$tab[$index++]=$row['par_numero_bav'];
	}

	return $tab;
}


 /* function return_evtByDateForUser($date1, $date2, $idUser) { $tabReturn=array(); $requete2 = " SELECT ".CFG_PREFIXE_TABLE."calendrier.*, ".CFG_PREFIXE_TABLE."rubrique.rub_libelle "; $requete2 .= " from ".CFG_PREFIXE_TABLE."calendrier, ".CFG_PREFIXE_TABLE."rubrique "; $requete2 .= " where cal_date between '".date('Y-m-d',$date1)."' and '".date('Y-m-d',$date2)."' "; $requete2 .= " and rub_id = cal_id_rub "; $requete2 .= " order by cal_date "; $resultat = mysql_query($requete2); $i=0; $leUser=null; if ($idUser != "") { $leUser=return_user($idUser); } while ($row = mysql_fetch_array($resultat, MYSQL_ASSOC)) { $rubMedia=return_rubrique($row['cal_id_rub']); if (droitUDMedia($rubMedia, $leUser,$row['cal_id_usr']) && $leUser!= null) { $row['droit']=true; } else { $row['droit']=false; } $tabReturn[$i++] = $row; } return $tabReturn; }
 */
?>