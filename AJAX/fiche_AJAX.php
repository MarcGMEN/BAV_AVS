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
    asort($tabRetour);
    return $tabRetour ;
}

function return_oneFicheByCode($id)
{
    $row = getOneFicheByCode($id);
    if ($row) {
        //$row['obj_date'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date'], true));
    }
    return $row;
}

function return_oneFicheByIdModif($id)
{
    $row = getOneFicheByIdModif($id);
    if ($row) {
        //$row['obj_date'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date'], true));
    }
    return $row;
}

function return_oneFiche($id)
{
    $row = getOneFiche($id);
    if ($row) {
        $row['obj_date'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date'], true));
    }
    return $row;
}


function action_createFiche($objStr, $cliStr)
{
	try {
		// creation du client, avec test si pas deja connu
		$tabCli=string2Tab(utf8_encode($cliStr));
    	$cliLu = getOneClientByMel($tabCli['cli_emel']);
		if ($cliLu) {
			$tabCli['cli_id']=$cliLu['cli_id'];
        	updateClient($tabCli);
		} else {
	        $tabCli['cli_id']=0;
        	$tabCli['cli_id']=insertClient($tabCli);
		}
		$tabObj=string2Tab(utf8_encode($objStr));
		$tabObj['obj_id_vendeur']=$tabCli['cli_id'];
	
		// TODO : insert fiche
		$tabObj['obj_id']=0;

		// creation du numero
		echo getCountFiche();
		$tabObj['obj_numero']=5000+getCountFiche();
		// creation de idmodif
		$tabObj['obj_id_modif']=substr(hash_hmac('md5', $tabObj['obj_numero'], 'avs44'), 0, 5);

    	$tabObj['obj_id']=insertFiche($tabObj);

		$objNew= getOneFiche($tabObj['obj_id']);
	
		echo $objNew['obj_id_modif'];

		// TODO : creation du mel

	} catch (Exception $e) {
        print_r($e);
	}
	// mel

	// retour OK
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
