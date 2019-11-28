<?php

function getModifPrixFromFiche($idFiche) {
    $requete2 = "SELECT * from bav_modif_prix where mop_id_obj = $idFiche";
    $requete2 .= " order by mop_date_demande ";

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getModifPrixFromFiche' [$requete2]" . mysqli_error($result));
    }
    return $tab;
}

function getAllModifActivePrixFromFiche() {
    $requete2 = "SELECT * from bav_modif_prix, bav_objet where mop_id_obj = obj_id ";
    $requete2 .= " and obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and  mop_date_validation is null ";
    $requete2 .= " order by mop_date_demande ";
    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getAllModifPrixFromFiche' [$requete2]" . mysqli_error($result));
    }
    return $tab;
}


function getOneModifPrix($id) {
    return getOne($id, "bav_modif_prix", "mop_id");
}
/**
 * mise a jour d'une fiche
 */
function updateModifPrix($obj)
{
    if ($obj == "") {
        return "update impossible sans id";
    } else {
        return update('bav_modif_prix', $obj, "mop_id");
    }
}

/**
 * insertion d'une fiche
 */
function insertModifPrix($obj)
{
    return insert('bav_modif_prix', $obj);
}

/**
 * suppression d'une fiche
 */
function deleteModifPrix($id)
{
    if ($id == "") {
        return "delete impossible sans id";
    } else {
        return delete('bav_modif_prix', $id, "mop_id");
    }
}
