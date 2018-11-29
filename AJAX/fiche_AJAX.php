<?php

/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/
function return_list_marques()
{
	$tabMarques = ['TREK','SCOTT','CANNONDALE','GITANE','PEUGEOT','MERCIER','SUNN','GT','EXS','CERVELO','BIANCHI',
		'COLNAGO','KUOTA','BH','BMC','BTWIN','DECATHLON','CANYON','CKT','COMMENCAL','DIAMONDBACK','GIANT','KONA',
		'KTM','MBK','MERIDA','ORBEA','PINARELLO','RIDLEY','SPECIALIZED','TIME','WILLIER','LOOK'];

    $tabRetour = array_merge($tabMarques, get_marques());
    sort($tabRetour);
    return $tabRetour ;
}

function return_oneFicheByCode($id)
{
    $row = getOneFicheByCode($id);
    if ($row) {
        $row['obj_date_depot_FR'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date_depot'], true));
    }
    return $row;
}

function return_oneFicheByIdModif($id)
{
    $row = getOneFicheByIdModif($id);
    if ($row) {
        $row['obj_date_depot_FR'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date_depot'], true));
    }
    return $row;
}

function return_oneFiche($id)
{
    $row = getOneFiche($id);
    if ($row) {
        $row['obj_date_depot_FR'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date_depot'], true));
    }
    return $row;
}


function action_createFiche($objStr, $cliStr)
{
	extract($GLOBALS);
	$retour="";
	try {
		// creation du client, avec test si pas deja connu
		$tabCli=string2Tab(utf8_encode($cliStr));
		$cliLu = getOneClientByMel($tabCli['cli_emel']);
		if ($cliLu) {
			$tabCli['cli_id']=$cliLu['cli_id'];
        	updateClient($tabCli);
		} else {
			$tabCli['cli_id']=0;
			$tabCli['cli_id_modif']=substr(hash_hmac('md5', rand(0, 10000), 'avs44'), 0, 8);
        	$tabCli['cli_id']=insertClient($tabCli);
		}
		$tabObj=string2Tab(utf8_encode($objStr));
		
		$tabObj['obj_id_vendeur']=$tabCli['cli_id'];
	
		// TODO : insert fiche
		$tabObj['obj_id']=0;

		// creation du numero
		// TODO : recherche des place libre apres 5000
		$tabObj['obj_numero']=getFicheLibre(5000);
		// creation de idmodif
		$tabObj['obj_id_modif']=substr(hash_hmac('md5', $tabObj['obj_numero'], 'avs44'), 0, 5);

        $tabObj['obj_numero_bav']=$_COOKIE['NUMERO_BAV'];
    	$tabObj['obj_id']=insertFiche($tabObj);

		$objNew= getOneFiche($tabObj['obj_id']);
	
		//echo $objNew['obj_id_modif'];
		$tabObj['lien_confirm']=$CFG_URL."/Actions/rest.php?a=C&id=".$tabObj['obj_id_modif'];
		
		if ($tabObj['obj_prix_depot'] == "") {
            $tabObj['obj_prix_depot']='____.__';
		}
		$message = makeMessage("Confirmation du dépôt", array_merge($tabObj, $tabCli), "mel_enregistrement.html");
		
		$retour = sendMail($tabCli['cli_emel'], $message, $_COOKIE['NUMERO_BAV']);
	} catch (Exception $e) {
        return $e->getMessage();
	}

    return $retour;
}

function action_updateFiche($obj)
{
    $tab =string2Tab($obj);
    // // TODO : test cohérence object
    updateFiche($tab);

    return true;
}

function action_insertFiche($obj)
{
    $tab =string2Tab($obj);
    insertFiche($tab);
    return true;
}
