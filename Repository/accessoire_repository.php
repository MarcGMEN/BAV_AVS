<?php

/**
 * retourne les marques dans la liste des object
 */
function getAllAccessoire()
{
    return getAll("bav_accessoire", "acc_id");
}

/**
 * recherche un fiche avec son ID
 */
function getOneAccessoire($id)
{
    return getOne("bav_accessoire", "acc_id", $id);
}

/**
 * recherche un fiche avec son ID
 */
function getOneAccessoireByNumero($num)
{
    $row = null;
    if (isset($num)) {
        $requete2 = "SELECT * from bav_accessoire ";
        $requete2 .= " where acc_numero = '" . $num . "'";
        $requete2 .= " and  acc_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
        // print_r($requete2);
        $result = $GLOBALS['mysqli']->query($requete2);
        if ($result) {
            $row = $result->fetch_assoc();
            $result->close();
        } else {
            throw new Exception("getFiches' [$requete2] " . $GLOBALS['mysqli']->error);
        }
    }
    return $row;
}


/**
 * mise a jour d'une fiche
 */
function updateAccessoire($obj)
{
    if ($obj == "") {
        return "update impossible sans id";
    } else {
        return update('bav_accessoire', $obj, "acc_id");
    }
}

/**
 * insertion d'une fiche
 */
function insertAccessoire($obj)
{
    return insert('bav_accessoire', $obj);
}

/**
 * suppression d'une fiche
 */
function deleteAccessoire($id)
{
    if ($id == "") {
        return "delete impossible sans id";
    } else {
        return delete('bav_accessoire', $id, "acc_id");
    }
}
