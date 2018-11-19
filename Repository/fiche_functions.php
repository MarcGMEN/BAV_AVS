<?php

function get_fiche($id) {
	$row = null;
	if (isset ( $id )) {
		$requete2 = " SELECT * from objet ";
		$requete2 .= " where obj_id = " . $id;
		// echo $requete2;
		$resultat = mysql_query ( $requete2 );
		$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );
	}
	return $row;
}
function get_fiche_with_numero($numero,$numbav) {
	$requete2 = " SELECT * from objet ";
	$requete2 .= " where obj_numero = " . $numero;
	$requete2 .= " and obj_numero_bav = " . $numbav;
	
	$resultat = mysql_query ( $requete2 );
	$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );
	return $row;
}

function get_nb_fiche_from_bav($numBav) {
	$requete2 = " SELECT count(*) from objet ";
	$requete2 .= " where obj_numero_bav = " . $numBav;
	
	$resultat = mysql_query ( $requete2 );
	$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );
	return $row['count(*)'];
}

function get_nb_vendu($numBav) {
	$requete2 = " SELECT count(*) from objet ";
	$requete2 .= " where obj_numero_bav = " . $numBav;
	$requete2 .= " and obj_id_acheteur is not null and obj_id_acheteur != 0";
	
	$resultat = mysql_query ( $requete2 );
	$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );
	
	return $row['count(*)'];
}
function get_nb_retour($numBav) {
	$requete2 = " SELECT count(*) from objet ";
	$requete2 .= " where obj_numero_bav = " . $numBav;
	$requete2 .= " and obj_id_vendeur is not null and obj_id_vendeur != 0";
	$requete2 .= " and obj_date_retour is not null ";
	
	$resultat = mysql_query ( $requete2 );
	$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );
	
	return $row['count(*)'];
}
function get_nb_stock($numBav) {
	$requete2 = " SELECT count(*) from objet ";
	$requete2 .= " where obj_numero_bav = " . $numBav;
	$requete2 .= " and obj_id_vendeur is not null and obj_id_vendeur != 0";
	$requete2 .= " and obj_date_retour is null ";
 	$requete2 .= " and obj_date_vente is null ";
 	
	$resultat = mysql_query ( $requete2 );
	$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );
	
	return $row['count(*)'];
}


function get_nb_vendeur_from_bav($numBav) {
	$requete2 = " SELECT obj_id_vendeur from objet ";
	$requete2 .= " where obj_numero_bav = " . $numBav;
	$requete2 .= " and obj_id_vendeur is not null and obj_id_vendeur != 0";
	$requete2 .= " group by obj_id_vendeur";
	
	$resultat = mysql_query ( $requete2 );
	$nb=0;
	while ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) { $nb++; }
	
	return $nb;
}
function get_nb_acheteur_from_bav($numBav) {
	$requete2 = " SELECT obj_id_acheteur from objet ";
	$requete2 .= " where obj_numero_bav = " . $numBav;
	$requete2 .= " and obj_id_acheteur is not null and obj_id_acheteur != 0";
	$requete2 .= " group by obj_id_acheteur";
	
	$resultat = mysql_query ( $requete2 );
	$nb=0;
	while ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) { $nb++; }
	
	return $nb;
}

function get_fiches($numBav,$ordre="obj_numero",$sens="asc",$mask,$cli_id) {
	$requete2 = " SELECT * from objet ";
	$requete2 .= " where obj_numero_bav = " . $numBav;
	
	if (isset($cli_id) && $cli_id != 0) {
		$requete2 .= " and (obj_id_vendeur=$cli_id or obj_id_acheteur=$cli_id) ";
	}
	$tabMask=array('obj_type','obj_public');
	foreach ($mask as $key => $val) {
		if ($val != "*") {
			$requete2 .= " and ".$tabMask[$key]."= '$val'";
		}
	}
	$requete2 .= " order by $ordre $sens";
	if ($ordre!="obj_numero") { 
		$requete2 .= ", obj_numero";
	}
	
	//echo $requete2; 
	$resultat = mysql_query ( $requete2 );
	while ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) {
		$row['obj_prix_vente']=$row['obj_prix_3'] == 0 ? $row['obj_prix_2'] == 0 ? $row['obj_prix_1'] : $row['obj_prix_2'] : $row['obj_prix_3'];   
		$row['obj_etat']=$row['obj_id_acheteur'] == 0 ? $row['obj_date_retour'] != null ? "Retour" : "Stock" : "Vendu";
		// pour un client etat = vente ou achat
		if (isset($cli_id) && $cli_id != 0 && $row['obj_id_acheteur'] == $cli_id) {
			$row['obj_etat']= "Achat";
		}
		else {
			
		}
		$tab[$row['obj_numero']]=$row;
	}
	
	return $tab;
}
 /* function return_evtByDateForUser($date1, $date2, $idUser) { $tabReturn=array(); $requete2 = " SELECT ".CFG_PREFIXE_TABLE."calendrier.*, ".CFG_PREFIXE_TABLE."rubrique.rub_libelle "; $requete2 .= " from ".CFG_PREFIXE_TABLE."calendrier, ".CFG_PREFIXE_TABLE."rubrique "; $requete2 .= " where cal_date between '".date('Y-m-d',$date1)."' and '".date('Y-m-d',$date2)."' "; $requete2 .= " and rub_id = cal_id_rub "; $requete2 .= " order by cal_date "; $resultat = mysql_query($requete2); $i=0; $leUser=null; if ($idUser != "") { $leUser=return_user($idUser); } while ($row = mysql_fetch_array($resultat, MYSQL_ASSOC)) { $rubMedia=return_rubrique($row['cal_id_rub']); if (droitUDMedia($rubMedia, $leUser,$row['cal_id_usr']) && $leUser!= null) { $row['droit']=true; } else { $row['droit']=false; } $tabReturn[$i++] = $row; } return $tabReturn; }
 */
?>
