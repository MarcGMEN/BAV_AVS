<?php
/**
 * retourne les marques dans la liste des object
 */
function get_emel()
{
    $query = "SELECT cli_emel from bav_client group by cli_emel";
    $tab=array();
    if ($result = $GLOBALS['MYSQLI']->query($query)) {
        $tab=array();
        $index=0;
        while ($row = $resultat->fetch_assoc()) {
            $tab[$index++]=strtoupper($row);
        }
        $result->close();
    }
    
    return $tab;
}
function getAllClient()
{
	return getAll("bav_client", "cli_id");
}

function getOneClient($id)
{
    return getOne($id, "bav_client", "cli_id");
}

function getOneClientByMel($id)
{
    return getOne($id, "bav_client", "cli_emel");
}


function updateClient($obj)
{
    return update("bav_client", $obj, "cli_id");
}

function insertClient($obj)
{
    return insert("bav_client", $obj);
}
