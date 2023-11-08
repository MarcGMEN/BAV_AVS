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
            $requete2 .= " and (obj_modele like '%" . addslashes($val) . "%' ";
            $requete2 .= " or obj_description like '%" . addslashes($val) . "%' ";
            $requete2 .= " or obj_couleur like '%" . addslashes($val) . "%') ";
        } elseif ($key && $val != "*") {
            $requete2 .= " and $key = '" . addslashes($val) . "' ";
        }
    }
    if ($selS && $valS != "*") {
        $requete2 .= " and $selS $search $valS ";
    }
    // error_log($requete2);
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
function makeNumeroFiche($base, &$objet, $avecRandom = false)
{
    $objet['obj_numero'] = getFicheLibre($base);
    // creation de idmodif
    makeIdModif($objet, $avecRandom);
}

function makeIdModif(&$objet, $avecRandom = false)
{
    $random = "";
    if ($avecRandom) {
        $random = rand($objet['obj_numero'], $objet['obj_numero'] + 2000);
    }

    $objet['obj_id_modif'] = hash_hmac(
        'md5',
        $objet['obj_numero'] . $GLOBALS['INFO_APPLI']['numero_bav'] . $random,
        'avs44'
    );
}
/**
 * retourne la commission pour une fiche
 */

 /**
 * recherche des fiches libres pour une BAV a partri d'une base
 */
function getNumMaxFiche()
{
    $row = null;
    $query = " SELECT max(obj_numero) from bav_objet where obj_numero_bav = '" .$GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $query .= " and obj_numero < 5000";
    // error_log($query);
    if ($result = $GLOBALS['mysqli']->query($query)) {
        $row = $result->fetch_assoc();
        $result->close();
    } else {
        throw new Exception("Pb getNumMaxFiche' [$query]" . mysqli_error($result));
    }
    return $row['max(obj_numero)'];
}

function getNbFicheByPlage($min, $max)
{
    $row = null;
    $query = " SELECT count(*), obj_etat from bav_objet where obj_numero_bav = '" .$GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $query .= " and obj_numero >= $min and obj_numero <= $max";
    $query .= " group by obj_etat";
    // error_log($query);
    $tabretour=array();
    $result = $GLOBALS['mysqli']->query($query);
    while ($row = $result->fetch_assoc()) {
        $tabretour[$row['obj_etat']] = $row['count(*)'];
    }
    $result->close();
    return $tabretour;
}


/**
 * recherche des fiches libres pour une BAV a partri d'une base
 */
function getFicheLibre($base)
{
    $row = null;
    $query = " SELECT obj_numero from bav_objet where obj_numero >= $base and obj_numero_bav = '" .
        $GLOBALS['INFO_APPLI']['numero_bav'] . "' order by obj_numero";
    // error_log($query);
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
            if ($row = $result->fetch_assoc()) {
                $row['obj_date_achat_FR'] = formateDateMYSQLtoFR($row['obj_date_achat'], false);
            }
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
    $requete2 = "SELECT bav_objet.*, ve.*, ve.cli_nom vendeur_nom, ac.cli_nom acheteur_nom from bav_objet ";
    $requete2 .= "  left outer join bav_client as ve on obj_id_vendeur = ve.cli_id ";
    $requete2 .= "  left outer join bav_client as ac on obj_id_acheteur = ac.cli_id ";
    //$requete2 .= "  left outer join bav_modif_prix as mop on mop_id_obj = obj_id and mop_date_validation is null ";
    $requete2 .= " where obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    foreach ($tabSel as $key => $val) {
        if ($key == "obj_search") {
            $requete2 .= " and (obj_modele like '%" . addslashes($val) . "%' ";
            $requete2 .= " or obj_description like '%" . addslashes($val) . "%' ";
            $requete2 .= " or obj_marque like '%" . addslashes($val) . "%' ";
            $requete2 .= " or obj_couleur like '%" . addslashes($val) . "%' ";
            $requete2 .= " or obj_prix_depot like '" . addslashes($val) . "%' ";
            $requete2 .= " or obj_prix_vente like '" . addslashes($val) . "%' ";
            // $requete2 .= " or obj_taille like '" . addslashes($val) . "%') ";
        } elseif ($key && $val != "*") {
            $requete2 .= " and $key = '" . addslashes($val) . "' ";
        }
    }
    if ($order != null) {
        if ($order == "obj_prix_vente") {
            $requete2 .= " order by $order $sens, obj_prix_depot $sens";
        } else {
            $requete2 .= " order by $order $sens";
        }
    }
    // error_log("[getFiches] $requete2");

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

function getFichesExpress($base)
{
    $requete2 = "SELECT bav_objet.*, ve.*, ve.cli_nom vendeur_nom, ac.cli_nom acheteur_nom from bav_objet ";
    $requete2 .= "  left outer join bav_client as ve on obj_id_vendeur = ve.cli_id ";
    $requete2 .= "  left outer join bav_client as ac on obj_id_acheteur = ac.cli_id ";
    //$requete2 .= "  left outer join bav_modif_prix as mop on mop_id_obj = obj_id and mop_date_validation is null ";
    $requete2 .= " where obj_numero_bav = '" . $GLOBALS['INFO_APPLI']['numero_bav'] . "'";
    $requete2 .= " and obj_numero >= $base ";
    $requete2 .= " order by obj_numero";
    $requete2 .= " limit 0,50 ";
    
    $result = $GLOBALS['mysqli']->query($requete2);
    if ($result) {
        $tab = array();
        while ($row = $result->fetch_assoc()) {
            $tab[$row['obj_numero']] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getFichesExpress' [$requete2] " . $GLOBALS['mysqli']->error);
    }
    return $tab;
}


function getNbFichesByDay($numeroBav)
{
    $tab = array();
    if ($numeroBav) {
        $paramBav = getOneParemetre($numeroBav);

        $paramBav['par_date_debut_depot'];
        $paramBav['par_date_debut_vente'];
        $paramBav['par_date_fin_bav'];
        $dateTmp = strtotime($paramBav['par_date_fin_bav']);
        $datesJ = array(date("Y-m-d", strtotime($paramBav['par_date_debut_depot'])), date("Y-m-d", strtotime($paramBav['par_date_debut_vente'])), date("Y-m-d", strtotime($paramBav['par_date_fin_bav'])));

        $finplus1 = mktime(0, 0, 0, date('m', $dateTmp), date('d', $dateTmp) + 1, date('Y', $dateTmp));

        $tabSearch = array('DEPOT' => 'obj_date_depot', 'VENTE' => 'obj_date_vente', 'RESTI' => 'obj_date_retour');



        foreach ($tabSearch as $key => $value) {

            $keyRow = $key . "_" . $numeroBav;
            $requete2 = "SELECT count(*),$value as $keyRow ";
            //$requete2 = "SELECT count(*),DATE_FORMAT($value,\"%Y-%m-%d %H\") as $key ";
            $requete2 .= "from bav_objet ";
            $requete2 .= "where obj_numero_bav = '$numeroBav' ";
            $requete2 .= " and obj_etat IN ('STOCK','VENDU','PAYE','RENDU') ";
            $requete2 .= " and $value between '" . $paramBav['par_date_debut_depot'] . "' and '" . date('Y-m-d', $finplus1) . "' ";
            // $requete2 .= " and $value >= '" . $paramBav['par_date_debut_depot'] . "' ";
            $requete2 .= "group by 2 ";
            // error_log($requete2);


            $result = $GLOBALS['mysqli']->query($requete2);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $keyTab = array_search(date("Y-m-d", strtotime($row[$keyRow])), $datesJ) . " " . date("H", strtotime($row[$keyRow]));
                    $tab[$keyTab][$keyRow] += $row['count(*)'];
                }
                $result->close();
            } else {
                throw new Exception("getNbFichesByDay' [$requete2] " . $GLOBALS['mysqli']->error);
            }
        }
    }
    return $tab;
}

function getNbFichesByDayAvantBAV($numeroBav)
{
    $tab = array();
    if ($numeroBav) {
        $paramBav = getOneParemetre($numeroBav);

        $paramBav['par_date_debut_depot'];
        $paramBav['par_date_debut_vente'];
        $paramBav['par_date_fin_bav'];


        $keyRow = "PRE_DEPOT_" . $numeroBav;
        $requete2 = "SELECT count(*),obj_date_depot as '$keyRow' ";
        //$requete2 = "SELECT count(*),DATE_FORMAT($value,\"%Y-%m-%d %H\") as $key ";
        $requete2 .= "from bav_objet ";
        $requete2 .= "where obj_numero_bav = '$numeroBav' ";
        $requete2 .= " and obj_etat IN ('CONFIRME') ";
        $requete2 .= " and obj_date_depot <= '" . $paramBav['par_date_debut_vente'] . "'";
        $requete2 .= " group by 2 ";
        error_log($requete2);

        $result = $GLOBALS['mysqli']->query($requete2);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $keyTab = date("Y-m-d", strtotime($row[$keyRow]));
                error_log($row[$keyRow]);
                $tab[$keyTab][$keyRow] += $row['count(*)'];
            }
            $result->close();
        } else {
            throw new Exception("getNbFichesByDayAvantBAV' [$requete2] " . $GLOBALS['mysqli']->error);
        }
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
