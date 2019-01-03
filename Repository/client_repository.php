<?php

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

function getClients($order, $sens, $tabSel)
{
    $requete2 = "SELECT * from bav_client ";
    $requete2 .= " where exists (select obj_id from bav_objet where (obj_id_vendeur = cli_id OR obj_id_acheteur = cli_id) ";
    $requete2 .= " and obj_numero_bav = ".$_COOKIE['NUMERO_BAV'].") " ;
    foreach ($tabSel as $key => $val) {
        if ($val != "*") {
            if ($key == 'cli_nom') {
                $requete2 .= " and $key like '%$val%' ";
            } else {
                $requete2 .= " and $key = '$val' ";
            }
        }
    }
    if ($order != null) {
        $requete2 .= " order by $order $sens";
    }
    //echo $requete2;
    
    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getClients' [$requete2]".mysqli_error());
    }
    return $tab;
}

function updateClient($obj)
{
    return update("bav_client", $obj, "cli_id");
}

function insertClient($obj)
{
    return insert("bav_client", $obj);
}
