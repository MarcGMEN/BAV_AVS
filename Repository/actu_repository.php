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
    $obj['act_date']=date("Y-m-d H:i:s", time());
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
        $requete2 .= " or act_text like '%$selection%' )" ;
    }
    $requete2 .= " and act_type = '$type' " ;
    if ($approved != null) {
        $requete2 .= " and act_active = $approved ";
    }
    $requete2 .= " order by act_numero_bav desc, act_date desc";
    
    //echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getActus' [$requete2]".mysqli_error($GLOBALS['mysqli']));
    }
    return $tab;
}

function actusRecente($type = "FAQ")
{
    $todayN=mktime(0, 0, 00, date('n',time()), date('j',time())-10, date('Y',time()));
    $today=date('Y-m-d', $todayN);
    $requete2 = "SELECT * from bav_actu where 1 = 1 ";
    $requete2 .= " and act_type = '$type' " ;
    $requete2 .= " and act_active = 1";
    $requete2 .= " and act_date > '$today' ";
    
    $retour="";

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        if ($row = $result->fetch_assoc()) {
            $retour=$row;
        }
        $result->close();
    } else {
        print_r(mysqli_error($GLOBALS['mysqli']));
        throw new Exception("getActus' [$requete2]".mysqli_error($result));
    }
    return $retour;
}
