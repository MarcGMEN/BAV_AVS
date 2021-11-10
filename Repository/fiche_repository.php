<?php

/**
 * retourne toutes les marques connues
 * sans limite de numero de BAV
 */
function get_modelesByMarques($marque)
{
    $tab = array();

    if ($marque) {
        $requete2 = "SELECT distinct(obj_modele) modele from bav_objet where obj_marque = '" . $marque . "'";
        if ($result = $GLOBALS['mysqli']->query($requete2)) {
            $index = 0;
            while ($row = $result->fetch_assoc()) {
                $tab[$index++] = $row['modele'];
            }
            $result->close();
        } else {
            throw new Exception("get_modelesByMarques' [$requete2]" . mysqli_error($result));
        }
    }
    return $tab;
}

/**
 * comptage des fiches d'un BAV par etat
 */
function countByEtat($idVendeur = null)
{
    $requete2 = "SELECT count(*), obj_etat from bav_objet where obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    if ($idVendeur) {
        $requete2 .= " and obj_id_vendeur = $idVendeur";
    }
    $requete2 .= " group by obj_etat ";
    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$row['obj_etat']] = $row['count(*)'];
        }
        $result->close();
    } else {
        throw new Exception("countByEtat' [$requete2]" . mysqli_error($result));
    }
    return $tab;
}

/**
 * comptage des fiches d'une BAV en fonction d'un critere
 */
function countBy($tabSel, $selS, $search = "=", $valS, $etats = "'STOCK','RENDU'")
{
    $requete2 = "SELECT count(*) from bav_objet ";
    $requete2 .= "where obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and obj_etat in ($etats)";
    foreach ($tabSel as $key => $val) {
        if ($key == "obj_search") {
            $requete2 .= " and (obj_modele like '%$val%' or obj_description like '%$val%' or obj_couleur like '%$val%') ";
        } elseif ($key && $val != "*") {
            $requete2 .= " and $key = '$val' ";
        }
    }
    if ($selS && $valS != "*") {
        $requete2 .= " and $selS $search $valS ";
    }
    error_log($requete2);
    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $row = $result->fetch_assoc();
        $count = $row['count(*)'];
        $result->close();
    } else {
        throw new Exception("countBy' [$requete2]" . mysqli_error($result));
    }
    return $count;
}

/**
 * creation d'un numero de fiche
 * recherche de la place libre
 * creation d'une clef md5 pour les appels REST
 */
function makeNumeroFiche($base, &$objet)
{
    $objet['obj_numero'] = getFicheLibre($base);
    // creation de idmodif

    $objet['obj_id_modif'] = hash_hmac(
        'md5',
        $objet['obj_numero'] . $GLOBALS['INFO_APPLI']['numero_bav'],
        'avs44'
    );
    error_log("creation de " . $objet['obj_numero'] . " => " . $objet['obj_id_modif']);
}

/**
 * retourne la commission pour une fiche
 */


/**
 * recherche des fiches libres pour une BAV a partri d'une base
 */
function getFicheLibre($base)
{
    $row = null;
    $query = " SELECT obj_numero from bav_objet where obj_numero >= $base and obj_numero_bav = '" .
        $GLOBALS['INFO_APPLI']['numero_bav'] . "' order by obj_numero";
    error_log($query);
    if ($result = $GLOBALS['mysqli']->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if ($row['obj_numero'] != $base) {
                break;
            }
            $base++;
        }
        $result->close();
    } else {
        throw new Exception("Pb getFicheLibre' [$query]" . mysqli_error($result));
    }
    return $base;
}

/**
 * recherche de la fiche par numero pour une BAV
 */
function getOneFicheByCode($id)
{
    $row = null;
    if (isset($id)) {
        $requete2 = "SELECT bav_objet.*, ve.*, ve.cli_nom vendeur_nom, ac.cli_nom acheteur_nom from bav_objet ";
        $requete2 .= "  left outer join bav_client as ve on obj_id_vendeur = ve.cli_id ";
        $requete2 .= "  left outer join bav_client as ac on obj_id_acheteur = ac.cli_id ";
        $requete2 .= " where obj_numero = '" . $id . "'";
        $requete2 .= " and  obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
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
 * recherche des fiches pour une selection et un ordre
 * avec un lien outer sur le vendeur et l'acheteur
 * on retourne que le nom de l'acheteur
 *
 * si "obj_search" dans le tableau de selection, alors recherche en like sur modele et desciription
 */
function getFiches($order, $sens, $tabSel)
{
    $requete2 = "SELECT bav_objet.*, ve.*, ve.cli_nom vendeur_nom, ac.cli_nom acheteur_nom, mop_id from bav_objet ";
    $requete2 .= "  left outer join bav_client as ve on obj_id_vendeur = ve.cli_id ";
    $requete2 .= "  left outer join bav_client as ac on obj_id_acheteur = ac.cli_id ";
    $requete2 .= "  left outer join bav_modif_prix as mop on mop_id_obj = obj_id and mop_date_validation is null ";
    $requete2 .= " where obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    //  error_log("[getFiches] $requete2");
    foreach ($tabSel as $key => $val) {
        if ($key == "obj_search") {
            $requete2 .= " and (obj_modele like '%$val%' or obj_description like '%$val%' or obj_couleur like '%$val%') ";
        } elseif ($key && $val != "*") {
            $requete2 .= " and $key = '$val' ";
        }
    }
    if ($order != null) {
        if ($order == "obj_prix_vente") {
            $requete2 .= " order by $order $sens, obj_prix_depot $sens";
        } else {
            $requete2 .= " order by $order $sens";
        }
    }
    $result = $GLOBALS['mysqli']->query($requete2);
    if ($result) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getFiches' [$requete2] " . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

function getFichesModif($type = "data")
{
    $requete2 = "SELECT bav_objet.* from bav_objet ";
    $requete2 .= " where obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and obj_modif_$type != 0";
    $requete2 .= "  order by obj_numero ";

    $result = $GLOBALS['mysqli']->query($requete2);
    if ($result) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getFichesModif' [$requete2] " . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

/**
 * recherche de la fiche par clef hash, utilisé pour les acces REST
 */
function getOneFicheByIdModif($id)
{
    return getOne($id, "bav_objet", "obj_id_modif");
}

/**
 * retourne les marques dans la liste des object
 */
function getAllFiche()
{
    return getAll("bav_objet", "obj_id");
}

/**
 * recherche un fiche avec son ID
 */
function getOneFiche($id)
{
    $requete2 = "SELECT bav_objet.*, ve.*, ve.cli_nom vendeur_nom, ac.cli_nom acheteur_nom from bav_objet ";
    $requete2 .= "  left outer join bav_client as ve on obj_id_vendeur = ve.cli_id ";
    $requete2 .= "  left outer join bav_client as ac on obj_id_acheteur = ac.cli_id ";
    $requete2 .= " where obj_id  = $id";

    $result = $GLOBALS['mysqli']->query($requete2);
    if ($result) {
        $row = $result->fetch_assoc();
        $result->close();
    } else {
        throw new Exception("getFiches' [$requete2] " . $GLOBALS['mysqli']->error);
    }
    return $row;
    // return getOne($id, "bav_objet", "obj_id");
}


/**
 * mise a jour d'une fiche
 */
function updateFiche($obj)
{
    if ($obj == "") {
        return "update impossible sans id";
    } else {
        return update('bav_objet', $obj, "obj_id");
    }
}

/**
 * insertion d'une fiche
 */
function insertFiche($obj)
{
    return insert('bav_objet', $obj);
}

/**
 * suppression d'une fiche
 */
function deleteFiche($id)
{
    if ($id == "") {
        return "delete impossible sans id";
    } else {
        return delete('bav_objet', $id, "obj_id");
    }
}
