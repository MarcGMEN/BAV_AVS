<?php

/**************************************/
/**************************************/
/* CLIENT */
/**************************************/
/**************************************/
function return_listClientByMel($mel)
{
    return listUnique("bav_client", "cli_emel", $mel);
}

function return_listClientByName($nom)
{
    return listUnique("bav_client", "cli_nom", utf8_encode($nom));
}

function return_oneClientByMel($mel)
{
    if (strlen($mel) > 0) {
        return getOne($mel, "bav_client", "cli_emel");
    }
}
function return_oneClientByName($mel)
{
    if (strlen($mel) > 0) {
        return getOne(utf8_encode($mel), "bav_client", "cli_nom");
    }
}
function return_oneClientByIdModif($mid)
{
    return getOne($mid, "bav_client", "cli_id_modif");
}


function return_clients($tri, $sens, $selection)
{
    $tab = getClients($tri, $sens, string2Tab($selection));

    foreach ($tab as $key => $val) {
        $tab[$key]['vente']=countByEtat($val['cli_id']);
        $tab[$key]['achat']=0;
        foreach (getAllFichesAcheteur($val['cli_id']) as $val) {
            $tab[$key]['achat']+=$val;
        }
        
    }
    return $tab;
}

function return_oneClient($id)
{
    $row = getOneClient($id);
    if ($row) {
    }
    return $row;
}

function action_updateClient($obj)
{
    $tab =string2Tab($obj);
    // // TODO : test cohérence object
    try {
        updateClient($tab);
        return $tab;
    } catch (Exception $e) {
        return "ERREUR ".$e->getMessage();
    }
}

function action_insertClient($obj)
{
    $tab =string2Tab($obj);
    return insertClient($tab);
}

function makeClient(&$tabCli)
{
    if ($tabCli['cli_id'] != null) {
       	updateClient($tabCli);
	} else {
		$tabCli['cli_id']=0;
        $tabCli['cli_id_modif']=substr(hash_hmac('md5', rand(0, 10000), 'avs44'), 0, 8);
        if (!$tabCli['cli_taux_com']) {
            $tabCli['cli_taux_com']=0;
        }
        if (!$tabCli['cli_prix_depot']) {
            $tabCli['cli_prix_depot']=0;
        }
        $tabCli['cli_id']=insertClient($tabCli);
           
	}
    return $tabCli;
}
