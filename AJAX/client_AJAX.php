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

function return_oneClientByMel($mel)
{
    if (strlen($mel) > 0) {
        return getOneClientByMel($mel);
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
        $tab[$key]['achat']=sizeof(getAllFichesAcheteur($val['cli_id']));
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
    updateClient($tab);

    return true;
}

function action_insertClient($obj)
{
    $tab =string2Tab($obj);
    insertClient($tab);
    return true;
}

function makeClient(&$tabCli)
{
    if ($tabCli['cli_id'] != null) {
       	updateClient($tabCli);
	} else {
		$tabCli['cli_id']=0;
		$tabCli['cli_id_modif']=substr(hash_hmac('md5', rand(0, 10000), 'avs44'), 0, 8);
       	$tabCli['cli_id']=insertClient($tabCli);
	}
    return $tabCli;
}
