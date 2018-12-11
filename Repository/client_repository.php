<?php
/**
 * retourne les marques dans la liste des object
 */
function getListClientByMel($mel)
{
    $query = "SELECT cli_emel from bav_client where cli_emel like '%".$mel."%' group by cli_emel order by cli_emel ";
    $tab=array();
    if ($result = $GLOBALS['mysqli']->query($query)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++]=$row['cli_emel'];
        }
        $result->close();
    } else {
        throw new Exception("Pb select' [$query]".mysqli_error());
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
