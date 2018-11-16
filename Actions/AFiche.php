<?
require "../Functions/commun_functions.php";
// require "../Commun/connect.php";
// require "../Commun/mail.php";
// require "../Functions/fiche_functions.php";

$page_src = "location:../index.php?1=1";
$date = date("Y-m-d H:i:s");
$message="";
echo "<pre>";
print_r($_POST);
echo "</pre>";
error_reporting(E_ALL);

/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "") {
	$page_src = "location:../index.php";
}

/**
 * enregistrement d'un fiche sans numero
 */
if (isset($_POST['lAction']) && $_POST['lAction'] == "enregister") {
	// creation du vendeur si pas id vendeur
	if ($_POST['cli_id'] == "") {
		// creation 
		$requete2 = " insert into client (cli_nom, cli_adresse, cli_codePostal, cli_ville,";
		$requete2 .= "cli_telephone, cli_emel) values ";
		$requete2 .= " ('".addslashes($_POST['cli_nom'])."','".addslashes($_POST['cli_adresse'])."',";
		$requete2 .= " '".addslashes($_POST['cli_codePostal'])."','".addslashes($_POST['cli_ville'])."',";
		$requete2 .= " '".addslashes($_POST['cli_telephone'])."', '".addslashes($_POST['cli_emel'])."')";

		if ($resultat = mysql_query($requete2)) {
			$idVendeur = mysql_id_insert();
		}
		else {
			$page_src .= "location:../index.php?page=Erreur&message=Gros problème....";
		}
	}
	else {
		$idVendeur = $_POST['cli_id'];
	}

	// creation de la fichier a l'etat 00-INIT par defaut
	// calcul d'un ID tempo
	$IDTempo = substr(hash_hmac('md5', rand(0,5000), $_POST['obj_numero_bav']),0,5);

	$requete2 = " insert into objet (obj_id_modif, obj_numero_bav,obj_type, obj_public, obj_pratique, obj_id_vendeur ";
	$requete2 .= " obj_marque, obj_marque, obj_modele, ";
	$requete2 .= " obj_couleur, obj_description, obj_prix_depot) values ";
	$requete2 .= " ('$$IDTempo', ".$_POST['obj_numero_bav'].", '".$_POST['obj_type']."', '".$_POST['obj_public']."',";
	$requete2 .= " '".$_POST['obj_pratique']."', $idVendeur";
	$requete2 .=  "'".addslashes($_POST['obj_marque'])."', '".addslashes($_POST['obj_modele'])."',";
	$requete2 .= " '".addslashes($_POST['obj_couleur'])."', '".addslashes($_POST['obj_description'])."', '".$_POST['obj_prix_depot']."') ";

	if ($resultat = mysql_query($requete2)) {
		$page_src .= "&page=EnregOk&ID=$IDTempo";
	}
	else {
		$page_src.="&page=create.php&message=Problème de création, resaisisez..";
	}
}

/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "visu") {

	$requete2 = " update objet set obj_type = '".$_POST['obj_type']."',";
	$requete2 .= " obj_public = '".$_POST['obj_public']."',";
	$requete2 .= " obj_taille = '".addslashes($_POST['obj_taille'])."',";
	$requete2 .= " obj_marque = '".addslashes($_POST['obj_marque'])."',";
	$requete2 .= " obj_modele = '".addslashes($_POST['obj_modele'])."',";
	$requete2 .= " obj_couleur = '".addslashes($_POST['obj_couleur'])."',";
	$requete2 .= " obj_description = '".addslashes($_POST['obj_description'])."',";
	$requete2 .= " obj_prix_1 = '".$_POST['obj_prix_1']."'";
	if (isset($_POST['obj_prix_2'])) $requete2 .= ", obj_prix_2 = '".$_POST['obj_prix_2']."'";
	if (isset($_POST['obj_prix_3'])) $requete2 .= ", obj_prix_3 = '".$_POST['obj_prix_3']."' ";
	if (isset($_POST['obj_prix_depot'])) $requete2 .= ", obj_prix_depot = '".$_POST['obj_prix_depot']."' ";
	if (isset($_POST['obj_comission'])) $requete2 .= ", obj_comission = '".$_POST['obj_comission']."' ";
	$requete2 .= " where obj_numero =".$_POST['obj_numero']." and obj_numero_bav=".$_POST['obj_numero_bav'];

	if (!$resultat = mysql_query($requete2)) {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero']."&message=erreur sur $requete2 ".mysql_error();
	}
	else {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero'];
	}
}

/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "ficheSupprimer") {

	$req = "DELETE FROM  objet ";
	$req .= " where obj_numero =".$_POST['obj_numero']." and obj_numero_bav=".$_POST['obj_numero_bav'];

	if (!$resultat = mysql_query($req)) {
		$page_src.="&page=accueil.php&message=erreur sur $req ".mysql_error();
	}
	$page_src.="&page=accueil.php&message=Fiche supprimée.";
	
}

/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && ($_POST['lAction'] == "vendeur" ||  $_POST['lAction'] == "acheteur")) {
	
	// si cli_id present => modif sinon insert
	echo "cli_id = ".$_POST['cli_id'];
	if (!isset($_POST['cli_id']) || $_POST['cli_id'] == "") {
		// insert
		$requete2 = " insert into client (cli_nom, cli_prenom, cli_adresse, cli_codePostal, cli_ville,";
		$requete2 .= "cli_telephone, cli_emel, cli_piece_indetite, cli_type_piece,cli_taux_com, cli_prix_depot) values ";
		$requete2 .= " ('".addslashes($_POST['cli_nom'])."','".addslashes($_POST['cli_prenom'])."','".addslashes($_POST['cli_adresse'])."',";
		$requete2 .= " '".addslashes($_POST['cli_codePostal'])."','".addslashes($_POST['cli_ville'])."',";
		$requete2 .= " '".addslashes($_POST['cli_telephone'])."', '".addslashes($_POST['cli_emel'])."', ";
		$requete2 .= " '".$_POST['cli_piece_indetite']."','".$_POST['cli_type_piece']."', ";
		$requete2 .= " '".$_POST['cli_taux_com']."','".$_POST['cli_prix_depot']."') ";
		if (!$resultat = mysql_query($requete2)) {
			$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero']."&message=erreur sur $requete2 ".mysql_error();
		}
		else {

			$cli_id=mysql_insert_id();
			if ($_POST['lAction'] == "vendeur") {
				$requete2 = " update objet set obj_id_vendeur = $cli_id ";
			}
			else {
				$requete2 = " update objet set obj_id_acheteur = $cli_id ";
				$requete2 .= " ,obj_date_vente = '".date('Y-m-d')."'";
				$requete2 .= " ,obj_type_achat = '".$_POST['obj_type_achat']."'";
			}
			$requete2 .= " where obj_numero =".$_POST['obj_numero']." and obj_numero_bav=".$_POST['obj_numero_bav'];
			if (!$resultat = mysql_query($requete2)) {
				$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero']."&message=erreur sur $requete2 ".mysql_error();
			}
			else {
				$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero'];
			}
		}
	}
	else {
		//update client
		$requete2 = " update client set cli_nom = '".addslashes($_POST['cli_nom'])."',";
		$requete2 .= " cli_prenom ='".addslashes($_POST['cli_prenom'])."',";
		$requete2 .= " cli_adresse ='".addslashes($_POST['cli_adresse'])."',";
		$requete2 .= " cli_codePostal = '".addslashes($_POST['cli_codePostal'])."',";
		$requete2 .= " cli_ville = '".addslashes($_POST['cli_ville'])."',";
		$requete2 .= " cli_telephone = '".addslashes($_POST['cli_telephone'])."',";
		$requete2 .= " cli_emel= '".addslashes($_POST['cli_emel'])."', ";
		$requete2 .= " cli_piece_indetite = '".$_POST['cli_piece_indetite']."',";
		$requete2 .= " cli_type_piece = '".$_POST['cli_type_piece']."'";
		if (isset($_POST['cli_taux_com'])) {
			$requete2 .= ", cli_taux_com ='".$_POST['cli_taux_com']."'";
		}
		if (isset($_POST['cli_prix_depot'])) {
			$requete2 .= ", cli_prix_depot = '".$_POST['cli_prix_depot']."' ";
		}
		$requete2 .= " where cli_id = ".$_POST['cli_id'];
		if (!$resultat = mysql_query($requete2)) {
			$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero']."&message=erreur sur $requete2 ".mysql_error();
		}
		else {
		
			if ($_POST['lAction'] == "vendeur") {
				$requete2 = " update objet set obj_id_vendeur = ".$_POST['cli_id'];
			}
			else {
				$requete2 = " update objet set obj_id_acheteur = ".$_POST['cli_id'];
				$requete2 .= " ,obj_date_vente = '".date('Y-m-d H:i:s')."'";
				$requete2 .= " ,obj_type_achat = '".$_POST['obj_type_achat']."'";
				
			}
			$requete2 .= " where obj_numero =".$_POST['obj_numero']." and obj_numero_bav=".$_POST['obj_numero_bav'];
			if (!$resultat = mysql_query($requete2)) {
				$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero']."&message=erreur sur $requete2 ".mysql_error();
			}
			else {
				$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero'];
			}
		}

	}
}


/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "changeVendeur") {

	$requete2 = " update objet set obj_id_vendeur =0, obj_date_retour = null  ";
	$requete2 .= " where obj_numero =".$_POST['obj_numero']." and obj_numero_bav=".$_POST['obj_numero_bav'];
	if (!$resultat = mysql_query($requete2)) {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero']."&message=erreur sur $requete2 ".mysql_error();
	}
	else {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero'];
	}
}

/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "changeAcheteur") {

	$requete2 = " update objet set obj_id_acheteur =0 , obj_date_vente = null ";
	$requete2 .= " where obj_numero =".$_POST['obj_numero']." and obj_numero_bav=".$_POST['obj_numero_bav'];
	if (!$resultat = mysql_query($requete2)) {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero']."&message=erreur sur $requete2 ".mysql_error();
	}
	else {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero'];
	}
}
/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "retourVendeur") {

	$requete2 = " update objet set obj_date_retour = '".date('Y-m-d H:i:s')."'";
	$requete2 .= " ,obj_comission = 0 ";
	$requete2 .= " where obj_numero =".$_POST['obj_numero']." and obj_numero_bav=".$_POST['obj_numero_bav'];
	if (!$resultat = mysql_query($requete2)) {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero']."&message=erreur sur $requete2 ".mysql_error();
	}
	else {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero'];
	}
}

/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['lAction']) && $_POST['lAction'] == "resetRetourVendeur") {

	$requete2 = " update objet set obj_date_retour = null ";
	$requete2 .= " where obj_numero =".$_POST['obj_numero']." and obj_numero_bav=".$_POST['obj_numero_bav'];
	if (!$resultat = mysql_query($requete2)) {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero']."&message=erreur sur $requete2 ".mysql_error();
	}
	else {
		$page_src.="&lAction=visu&numeroFiche=".$_POST['obj_numero'];
	}
}

/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['llAction']) && $_POST['llAction'] == "email") {

	$requete = "select *, usr_nom from  ".CFG_PREFIXE_TABLE."calendrier, ".CFG_PREFIXE_TABLE."user ";
	$requete .= " where cal_id = ".$GET_cal_id;
	$requete .= " and cal_id_usr = usr_id ";
	if (!$resultat = mysql_query($requete)) {
		echo "erreur sur $requete ".mysql_error()."<br/>";
	}
	else {
		$actu = mysql_fetch_array($resultat, MYSQL_ASSOC);

		$requete = "select new_email, new_id from ".CFG_PREFIXE_TABLE."newsletter, ";
		$requete .= CFG_PREFIXE_TABLE."news_rubrique ";
		$requete .= " where new_id = ner_id_news ";
		$requete .= " and ner_id_rub = ".$actu['cal_id_rub'];
		if (!$resultat = mysql_query($requete)) {
			echo "erreur sur $requete ".mysql_error()."<br/>";
		}
		else {

			$cpt = 0;

			$erreur="";

			while ($row= mysql_fetch_array($resultat, MYSQL_ASSOC)) {

				$cpt++;

				$sujet = $actu['cal_titre'];
				//$texte = nl2br($actu['cal_commentaire']);
				$texte = $actu['cal_commentaire'];
				if ($actu['cal_latitude'] && $actu['cal_latitude'] != 0 &&
				$actu['cal_longitude'] && $actu['cal_longitude'] != 0) {
					$addr=$actu['cal_latitude'].","+$actu['cal_longitude'];
				} else {
					$addr=$actu['cal_lieu'].", france";
				}

				$sujet.=" à <A HREF='http://maps.google.fr/maps?f=d&source=s_d&saddr=$agenda_LIEU_EVT&daddr=".$addr."' target='_new'> ";
				$sujet.=$actu['cal_lieu'];
				$sujet.="</A>";

				$tab_date = explode(' ',$actu['cal_date']);
				$tab_date1 = explode('-',$tab_date[0]);
				$dateMessage=$tab_date1[2]."/".$tab_date1[1]."/".$tab_date1[0];


				$tabData = array();
				$tabData['--SUJET--']="[".$CFG_NOM."]".$actu['cal_titre'];
				$tabData['--SUJET_RDV--']=$sujet;
				$tabData['--TEXTE_RDV--']=$texte;
				$tabData['--DATE_RDV--']=$dateMessage;

				sendMail($row['new_email'], $tabData, "agenda.html",$row['new_id']);
			}

			if ($cpt > 0) {
				$req = "UPDATE `".CFG_PREFIXE_TABLE."calendrier` set  cal_date_envoi = '".date('Y-m-d')."'";
				$req .= " WHERE cal_id = ".$GET_cal_id;
				if (!$resultat = mysql_query($req)) {
					echo "erreur sur $req ".mysql_error()."<br/>";
				}
			}

			$page_src .= "&message=Envoi de la newsletter a ".$cpt." adhérents. ".$erreur;
		}
	}
}

/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['llAction']) && $_POST['llAction'] == "DepuisLe") {
	$tabTmp=explode("/",$GET_dt);
	$dt=mktime(0,0,0,$tabTmp[1],$tabTmp[0],$tabTmp[2]);
	$page_src = "location:../".makeURL_GET($_POST,"dt=$dt&dtSel=$GET_dt");
}

/*****************************************************/
/*****************************************************/
/*****************************************************/
if (isset($_POST['llAction']) && $_POST['llAction'] == "nextMonth") {
	$page_src = "location:../".makeURL_GET($_POST,"dt=$GET_dt&lastDay=$GET_lastDay");
}


//mysql_close($id_db);

//header($page_src);