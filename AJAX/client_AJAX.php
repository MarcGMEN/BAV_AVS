<?php

/**************************************/
/**************************************/
/* CLIENT */
/**************************************/
/**************************************/
function return_listClientByMel($mel)
{
    return getListClientByMel($mel);
}

function return_oneClientByMel($id)
{
    return getOneClientByMel($id);
}



function return_oneClient($id)
{
    $row = getOneClient($id);
    if ($row) {
        //$row['obj_date'] = utf8_encode(formateDateMYSQLtoFR($row['obj_date'], true));
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
