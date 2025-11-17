<?php
function getAllAvisForBav($withBAV=false,$note=null)
{
    extract($GLOBALS);
    $requete2 = "SELECT * from bav_avis ";
    $requete2 .= " where avs_commentaire != '' ";
    // echo $withBAV; 
    if ($withBAV == true) {
        $requete2 .= " and avs_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] ."'";
    }
    if ($note) {
        $requete2 .= " and avs_note = $note ";
    }
    
    $requete2 .= " order by avs_numero_bav desc, avs_date desc limit 50";
    //echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getBavsClient' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

function getCountByNote($withBAV=false)
{
    extract($GLOBALS);
    $requete2 = "SELECT count(*) cpt, avs_note from bav_avis ";
    $requete2 .= " where 1=1";
    if ($withBAV == true) {
        $requete2 .= " and avs_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] ."'";
    }
    $requete2 .= " group by avs_note";
    //echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$row['avs_note']] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getBavsClient' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}


function getOneAvis($id)
{
    return getOne($id, "bav_avis", "avs_id");
}

function insertAvis($obj)
{
    return insert("bav_avis", $obj);
}

function deleteAvis($id)
{
    return delete("bav_avis", $id,"avs_id");
}