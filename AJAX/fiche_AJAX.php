<?php

$module="fiche";

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

function return_fiche_AJAX($id) {
	$row = get_fiche($id);
	
	$row['obj_date_retour_FR']=utf8_encode(formateDateMYSQLtoFR($row['obj_date_retour'], true));
	$row['obj_date_vente_FR']=utf8_encode(formateDateMYSQLtoFR($row['obj_date_vente'], true));
	return $row;
	
}
function verifNumeroFiche($numero) {
	$numBav=$_COOKIE["NUMERO_BAV"];
	$fiche = get_fiche_with_numero($numero,$numBav);

	if (is_array($fiche)) {

		$fiche['obj_date_depot_FR']=utf8_encode(formateDateMYSQLtoFR($fiche['obj_date_depot'], true));
		$fiche['obj_date_retour_FR']=utf8_encode(formateDateMYSQLtoFR($fiche['obj_date_retour'], true));
		$fiche['obj_date_vente_FR']=utf8_encode(formateDateMYSQLtoFR($fiche['obj_date_vente'], true));
		$fiche['obj_description']=utf8_encode($fiche['obj_description']);
		$fiche['obj_marque']=utf8_encode($fiche['obj_marque']);
		$fiche['obj_modele']=utf8_encode($fiche['obj_modele']);
		$fiche['obj_couleur']=utf8_encode($fiche['obj_couleur']);
		$fiche['obj_type_achat']=utf8_encode($fiche['obj_type_achat']);
	}
	return $fiche;
}
function return_list_type() {
	return recupEnumToArray('objet','obj_type');
}

function return_list_typeAchat() {
	$list = recupEnumToArray('objet','obj_type_achat');
	foreach ($list as $key => $val) {
		$list[$key]=utf8_encode($val);
	}
	return $list;
	
}

function return_list_public() {
	return recupEnumToArray('objet','obj_public');
}


function chercheMarque($search) {
	if (strlen(trim($search) > 3)) {
		return recupValToArray('objet','obj_marque',$search);
	}
	else {
		return null;
	}
}

function cmp_etat_asc($a, $b)
{
    $cmp = strcmp($a['obj_etat'], $b['obj_etat']);
    if ($cmp ==0) {
    	
    	if ($a['obj_numero'] == $b['obj_numero']) {
        	$cmp=0;
    	}
    	else {        
        	$cmp = ($a['obj_numero'] > $b['obj_numero']) ? -1 : 1;
    	}
    }
    return $cmp;
	
}
function cmp_etat_desc($a, $b)
{
    $cmp = strcmp($a['obj_etat'], $b['obj_etat'])*-1;
    if ($cmp ==0) {
    	
    	if ($a['obj_numero'] == $b['obj_numero']) {
        	$cmp=0;
    	}
    	else {        
        	$cmp = ($a['obj_numero'] < $b['obj_numero']) ? -1 : 1;
    	}
    }
    return $cmp;
	
}

function return_fiches($tri,$sens,$mask,$cli_id=0) {
	$numBav=$_COOKIE["NUMERO_BAV"];
	
	if ($tri == "obj_prix_vente") {
		$tri="CASE WHEN obj_prix_3 !=0  THEN obj_prix_3  WHEN obj_prix_2 !=0  THEN obj_prix_2 WHEN obj_prix_1 !=0 THEN obj_prix_1 END";
	}
	
	$triBase=$tri;
	if ($tri == "obj_etat") {
		$tri="obj_numero";
	}
	
	$tabTmp = get_fiches($numBav,$tri,$sens,$mask,$cli_id);
	
	$index=0;
	
	foreach ($tabTmp as $id => $row) {
		foreach ($row as $key => $val) {
				$row[$key]=utf8_encode($val);
		}
		$tabFiche[$index++]=$row;
	}
	//print_r($tabFiche);
	if ($triBase == "obj_etat") {
		if ($sens == "asc") {
			usort($tabFiche, "cmp_etat_asc");
		}
		else {
			usort($tabFiche, "cmp_etat_desc");
		}
	}
	//print_r($tabFiche);
	return $tabFiche;
}

//VENDEUR

function return_client_completion($nom) {
	$tab=array();
	if (strlen(trim($nom)) > 2) {
		$tab = get_client_from_nom($nom);

		foreach ($tab as $id=> $row) {
			foreach ($row as $key => $val) {
				$row[$key]=utf8_encode($val);
			}
			$tab[$id]=$row;
		}
	}

	return $tab;
}

function return_client($id) {
	$client = get_client($id);

	foreach ($client as $key => $val) {
		$client[$key]=utf8_encode($val);
	}

	return $client;
}


function return_list_typePiece() {
	$tab= recupEnumToArray('client','cli_type_piece');

	foreach ($tab as $key => $val) {
		$tab[$key]=utf8_encode($val);
	}

	return $tab;
}

function return_list_taux_commision() {
	return return_taux_commision();
}

function return_list_prix_depot() {
	return return_prix_depot();
}


/*function return_evt_ajax($id) {
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
 }*/
?>