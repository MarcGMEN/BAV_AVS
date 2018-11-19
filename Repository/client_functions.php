<?php
function get_client_from_nom($nom) {
	$requete2 = " SELECT * from client where cli_nom like '%$nom%' ";
	$resultat = mysql_query ($requete2);
	while ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) {
		$tabClient[$row['cli_id']]=$row;
	}
	return $tabClient;
}

function get_client($id) {
	$requete2 = " SELECT * from client where cli_id = $id ";
	$resultat = mysql_query ( $requete2 );
	return mysql_fetch_array ( $resultat, MYSQL_ASSOC );
}

function get_nb_clients() {
	$requete2 = " SELECT count(*) from client ";
	$resultat = mysql_query ( $requete2 );
	$row = mysql_fetch_array ( $resultat, MYSQL_ASSOC );

	return $row['count(*)'];
}

function get_clients($numBav="*",$ordre="cli_nom",$sens="asc",$mask) {
		$requete2 = " SELECT client.*, obj_date_vente, obj_id_vendeur, obj_id_acheteur, cli_id , 0 cli_vente, 0 cli_achat, 0 cli_depot from client, objet ";
	$requete2 .= " where 1=1 ";
	if ($mask != "*" && ltrim($mask) != "") {
		$requete2 .= " and ( cli_nom like '%$mask%' or cli_prenom like '%$mask%' )";
	}
	$requete2 .= " and (obj_id_vendeur = cli_id or  obj_id_acheteur = cli_id)  ";
	if ($numBav != "*" && ltrim($numBav) != "") {
		$requete2 .= " and obj_numero_bav = $numBav ";
	}
	
	//$requete2 .= " group by cli_id ";
	$requete2 .= " order by $ordre $sens";
	if ($ordre!="cli_nom") {
		$requete2 .= ", cli_nom";
	}


	if (!$resultat = mysql_query ( $requete2 )) {
		echo "erreur sur $requete ".mysql_error()."<br/>";
	}
	else {
		$cliOld=0;
		$tab=array();
		while ($row = mysql_fetch_array ( $resultat, MYSQL_ASSOC )) {
			if ($cliOld != $row['cli_id'] && $cliOld!=0) {
				$tab[$cliOld]=$rowSvg;
				$rowSvg=$row;
			}

			if ($row['obj_id_vendeur'] == $row['cli_id']) {
				$row["cli_depot"]=$rowSvg["cli_depot"]+1;
				if ($row['obj_date_vente'] != null) {
					$row["cli_vente"]=$rowSvg["cli_vente"]+1;
				}
				else {
					$row["cli_vente"]=$rowSvg["cli_vente"];
				}
			}
			else {
				$row["cli_depot"]=$rowSvg["cli_depot"];
				$row["cli_vente"]=$rowSvg["cli_vente"];
			}
			if ($row['obj_id_acheteur'] == $row['cli_id']) {
				$row["cli_achat"]=$rowSvg["cli_achat"]+1;
			}
			else {
				$row["cli_acheteur"]=$rowSvg["cli_acheteur"];
			}
			
			$rowSvg=$row;
			$cliOld=$row['cli_id'];
		}
		if ($cliOld!=0) {
			$tab[$cliOld]=$rowSvg;
		}
		else {
			$tab=array();
		}
		
	}
	return $tab;
}

/* function return_evtByDateForUser($date1, $date2, $idUser) { $tabReturn=array(); $requete2 = " SELECT ".CFG_PREFIXE_TABLE."calendrier.*, ".CFG_PREFIXE_TABLE."rubrique.rub_libelle "; $requete2 .= " from ".CFG_PREFIXE_TABLE."calendrier, ".CFG_PREFIXE_TABLE."rubrique "; $requete2 .= " where cal_date between '".date('Y-m-d',$date1)."' and '".date('Y-m-d',$date2)."' "; $requete2 .= " and rub_id = cal_id_rub "; $requete2 .= " order by cal_date "; $resultat = mysql_query($requete2); $i=0; $leUser=null; if ($idUser != "") { $leUser=return_user($idUser); } while ($row = mysql_fetch_array($resultat, MYSQL_ASSOC)) { $rubMedia=return_rubrique($row['cal_id_rub']); if (droitUDMedia($rubMedia, $leUser,$row['cal_id_usr']) && $leUser!= null) { $row['droit']=true; } else { $row['droit']=false; } $tabReturn[$i++] = $row; } return $tabReturn; }
 */
?>