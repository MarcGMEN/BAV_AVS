<?php
/**
 * retourne les marques dans la liste des object
 */

function getAllActu()
{
    return getAll("bav_actu", "act_id");
}

function getOneActu($id)
{
    return getOne($id, "bav_actu", "act_id");
}

function updateActu($obj)
{
    return update("bav_actu", $obj, "act_id");
}

function insertActu($obj)
{
    return insert("bav_actu", $obj);
}

function deleteActu($id)
{
    return delete("bav_actu", $id, "act_id");
}

function getActus($selection, $approved = null, $type = "FAQ")
{
    $requete2 = "SELECT * from bav_actu where 1 = 1 ";
    if ($selection && $selection != "") {
        $requete2 .= " and (act_titre like '%$selection%' " ;
        $requete2 .= " or act_blob like '%$selection%' )" ;
    }
    $requete2 .= " and act_type = '$type' " ;
    if ($approved != null) {
        $requete2 .= " and act_active = $approved ";
    }
    $requete2 .= " order by act_numero_bav desc, act_date asc";
    
    //echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getActus' [$requete2]".mysqli_error());
    }
    return $tab;
}
