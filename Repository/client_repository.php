<?php

/**
 * retour d'un client
 */
function getOneClient($id)
{
    return getOne($id, "bav_client", "cli_id");
}

/**
 * retour d'un client
 */
function getOneClientByMel($id)
{
    return getOne($id, "bav_client", "cli_emel");
}

/**
 * retour d'un client
 */
function getOneClientByName($id)
{
    return getOne($id, "bav_client", "cli_nom", "cli_emel");
}

/**
 * recherche des clients avec une selection, pour une BAV ou pas
 */
function getClientsRecap($order, $sens, $tabSel, $all = false)
{
    extract($GLOBALS);

    $requete2 = "select *,";
    $requete2 .= "(select count(*) from bav_objet objC where objC.obj_id_vendeur = cli_id and objC.obj_etat in ('CONFIRME') ";
    $requete2 .= " and objC.obj_numero_bav =" . $INFO_APPLI['numero_bav'] . ") CONFIRME, ";
    $requete2 .= "(select count(*) from bav_objet objS where objS.obj_id_vendeur = cli_id and objS.obj_etat in ('STOCK') ";
    $requete2 .= " and objS.obj_numero_bav =" . $INFO_APPLI['numero_bav'] . ") STOCK, ";
    $requete2 .= "(select count(*) from bav_objet objV where objV.obj_id_vendeur = cli_id and objV.obj_etat in ('VENDU') ";
    $requete2 .= " and objV.obj_numero_bav =" . $INFO_APPLI['numero_bav'] . ") VENDU, ";
    $requete2 .= "(select count(*) from bav_objet objR where objR.obj_id_vendeur = cli_id and objR.obj_etat in ('RENDU') ";
    $requete2 .= " and objR.obj_numero_bav =" . $INFO_APPLI['numero_bav'] . ") RENDU, ";
    $requete2 .= "(select count(*) from bav_objet objP where objP.obj_id_vendeur = cli_id and objP.obj_etat in ('PAYE') ";
    $requete2 .= " and objP.obj_numero_bav =" . $INFO_APPLI['numero_bav'] . ") PAYE, ";
    $requete2 .= "(select count(*) from bav_objet objA where objA.obj_id_acheteur = cli_id ";
    $requete2 .= " and objA.obj_numero_bav =" . $INFO_APPLI['numero_bav'] . ") ACHAT ";

    $requete2 .= " FROM bav_client WHERE 1 = 1  ";
    foreach ($tabSel as $key => $val) {
        if ($val != "*") {
            // sur le nom on passe en mode like
            if ($key == 'cli_nom') {
                $requete2 .= " and $key like '%$val%' ";
            } else {
                $requete2 .= " and $key = '$val' ";
            }
        }
    }

    // si tous on recherche tous le clients
    if (!$all) {
        $requete2 .= " and exists (select obj_id from bav_objet where (obj_id_vendeur = cli_id OR obj_id_acheteur = cli_id) ";
        $requete2 .= " and obj_numero_bav = " . $INFO_APPLI['numero_bav'] . ") ";
    }

    $requete2 .= " group by cli_id";
    if ($order != null) {
        $requete2 .= " order by $order $sens";
    }

    //echo $requete2;

    if ($result = $GLOBALS['mysqli']->query($requete2)) {
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        echo $requete2;
        throw new Exception("getClientsRecap' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

/**
 * recherche des clients pour une BAV ou pas
 */
function getClients($order, $sens, $tabSel, $all = false)
{
    $requete2 = "SELECT * from bav_client ";
    $requete2 .= " where 1 = 1 ";
    if (!$all) {
        $requete2 .= " and exists (select obj_id from bav_objet where (obj_id_vendeur = cli_id OR obj_id_acheteur = cli_id) ";
        $requete2 .= " and obj_numero_bav = " . $GLOBALS['INFO_APPLI']['numero_bav'] . ") ";
    }
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
        $tab = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $tab[$index++] = $row;
        }
        $result->close();
    } else {
        throw new Exception("getClients' [$requete2]" . $GLOBALS['mysqli']->error);
    }
    return $tab;
}

/**
 * mise a jour du client
 */
function updateClient($obj)
{
    if ($obj == "") { 
        return "update impossible sans id";
    } else {
        return update("bav_client", $obj, "cli_id");
    }
}

/**
 * insertion d'un client
 */
function insertClient($obj)
{
    return insert("bav_client", $obj);
}

/**
 * suppression d'un client
 */
function deleteClient($id)
{
    if ($id == "") {
        return "Suppression impossible sans id";
    } else {
        return delete("bav_client", $id, "cli_id");
    }
}
