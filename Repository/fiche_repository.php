<?php
/**
 * retourne les marques dans la liste des object
 */

function getAllFiche()
{
    return getAll("bav_objet", "obj_id");
}

function getOneFiche($id)
{
    return getOne($id, "bav_objet", "obj_id");
}

function get_modelesByMarques($marque)
{
    $tab=array();
            
    if ($marque) {
        $requete2 = "SELECT distinct(obj_modele) modele from bav_objet where obj_marque = '".$marque."'";
        if ($result = $GLOBALS['mysqli']->query($requete2)) {
            $index=0;
            while ($row = $result->fetch_assoc()) {
                $tab[$index++] = $row['modele'];
            }
            $result->close();
        } else {
            throw new Exception("get_modelesByMarques' [$requete2]".mysqli_error($result));
        }
    }
    return $tab;
}
function getAllFichesAcheteur($idAcheteur)
{
    if ($idAcheteur) {
        $requete2 = "SELECT * from bav_objet where obj_numero_bav = ".$_COOKIE['NUMERO_BAV'];
        $requete2 .= " and obj_id_acheteur = $idAcheteur ";
        if ($result = $GLOBALS['mysqli']->query($requete2)) {
            $tab=array();
            $index=0;
            while ($row = $result->fetch_assoc()) {
                $tab[$row['obj_etat']]+=1;
            }
            $result->close();
        } else {
            throw new Exception("getAllFichesAcheteur' [$requete2]".mysqli_error($result));
        }
    }
    return $tab;
}

function getAllFichesVendeur($idVendeur)
{
    if ($idVendeur) {
        $requete2 = "SELECT * from bav_objet where obj_numero_bav = ".$_COOKIE['NUMERO_BAV'];
        $requete2 .= " and obj_id_vendeur = $idVendeur ";
        if ($result = $GLOBALS['mysqli']->query($requete2)) {
            $tab=array();
            $index=0;
            while ($row = $result->fetch_assoc()) {
                $tab[$row['obj_etat']] = $row['count(*)'];
            }
            $result->close();
        } else {
            throw new Exception("getAllFichesVendeur' [$requete2]".mysqli_error($result));
        }
    }
    return $tab;
}


function countByEtat($idVendeur = null)
{
    $requete2 = "SELECT count(*), obj_etat from bav_objet where obj_numero_bav = ".
        $_COOKIE['NUMERO_BAV'];
    if ($idVendeur) {
        $requete2 .= " and obj_id_vendeur = $idVendeur";
    }
    $requete2 .= " group by obj_etat ";
    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            $tab[$row['obj_etat']] = $row['count(*)'];
        }
        $result->close();
    } else {
        throw new Exception("countByEtat' [$requete2]".mysqli_error($result));
    }
    return $tab;
}

function makeNumeroFiche($base, &$objet)
{
    $objet['obj_numero']=getFicheLibre($base);
    // creation de idmodif
    $objet['obj_id_modif']=substr(hash_hmac('md5', $objet['obj_numero'], 'avs44'+$_COOKIE['NUMERO_BAV']), 0, 5);
}

function getFicheLibre($base)
{
    $row = null;
    $query = " SELECT obj_numero from bav_objet where obj_numero >= $base and obj_numero_bav = ".
        $_COOKIE['NUMERO_BAV']." order by obj_numero";
    if ($result = $GLOBALS['mysqli']->query($query)) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            if ($row['obj_numero'] != $base) {
                break;
            }
            $base++;
        }
        $result->close();
    } else {
        throw new Exception("Pb getFicheLibre' [$query]".mysqli_error($result));
    }
    return $base;
}

function lastFiche($base) {
    $row = null;
    $query = " SELECT max(obj_numero) from bav_objet where obj_numero >= $base and obj_numero_bav = ".
        $_COOKIE['NUMERO_BAV'];
    if ($result = $GLOBALS['mysqli']->query($query)) {
        $row = $result->fetch_assoc();
        $result->close();
    } else {
        throw new Exception("Pb lastFicheInfo' [$query]".mysqli_error($result));
    }
    return $row;
}


/**
 * recherche de la fiche par code
 */
function getOneFicheByCode($id, $numeroBAV)
{
    $row = null;
    if (isset($id)) {
        $requete2 = " SELECT * from bav_objet ";
        $requete2 .= " where obj_numero = '" . $id."'";
        $requete2 .= " and  obj_numero_bav = '" . $numeroBAV."'";
        $row=$GLOBALS['mysqli']->query($requete2)->fetch_assoc();
    }
    return $row;
}

function getFiches($order, $sens, $tabSel)
{
    $requete2 = "SELECT bav_objet.*, ve.*, ve.cli_nom vendeur_nom, ac.cli_nom acheteur_nom from bav_objet ";
    $requete2 .= "  left outer join bav_client as ve on obj_id_vendeur = ve.cli_id ";
    $requete2 .= "  left outer join bav_client as ac on obj_id_acheteur = ac.cli_id ";
    $requete2 .= " where obj_numero_bav = ".$_COOKIE['NUMERO_BAV'];
    //echo $requete2;
    foreach ($tabSel as $key => $val) {
        if ($key && $val != "*") {
            $requete2 .= " and $key = '$val' ";
        }
    }

    if ($order != null) {
        $requete2 .= " order by $order $sens";
    }
    $result = $GLOBALS['mysqli']->query($requete2);
    //echo $result;
    if ($result) {
        $tab=array();
        $index=0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getFiches' [$requete2] ".$GLOBALS['mysqli']->error);
    }
    return $tab;
}

function getFichesExpress()
{
    return  getFiches('obj_numero', "asc",  []);
}

/**
 * recherche de la fiche par code
 */
function getOneFicheByIdModif($id)
{
    return getOne($id, "bav_objet", "obj_id_modif");
}


function updateFiche($obj)
{
    return update('bav_objet', $obj, "obj_id");
}

function insertFiche($obj)
{
    return insert('bav_objet', $obj);
}

function deleteFiche($id)
{
    return delete('bav_objet', $id, "obj_id");
}
