<?php

/**************************************/
/**************************************/
/* CLIENT */
/**************************************/
/**************************************/

/**
 * retourne la liste des mels des clienrts pour une selection
 */
function return_listClientByMel($mel = null)
{
    $tabRet = listUnique("bav_client", "cli_emel", $mel);
    return $tabRet;
}

/**
 * retourne la liste de nom des clients
 */
function return_listClientByName($nom = null)
{
    return getClients("cli_nom", "asc", ['cli_nom' => $nom], "tous");
}


/**
 * retourne la liste de nom des clients
 */
function return_countClient($all)
{
    return countClient($all);
}

/**
 * retourne un client via son mel
 */
function return_oneClientByMel($mel)
{
    if (strlen($mel) > 0) {
        return getOne($mel, "bav_client", "cli_emel");
    }
}

/**
 * retourne un client via son mel
 */
function connect_client($mel, $code)
{
    if (strlen($mel) > 0) {
        return connectClient($mel, $code);
    }
}


/**
 * retourne un client via son mel
 */
function return_isClientByMel($mel)
{
    if (return_oneClientByMel($mel)) {
        return true;
    } else {
        return false;
    }
}

/**
 * retourne un client via son mel
 */
function return_oneClientByName($mel)
{
    if (strlen($mel) > 0) {
        return getOne(utf8_encode($mel), "bav_client", "cli_nom");
    }
}

/**
 * retourne un client via son id
 */
function return_oneClientByIdModif($mid)
{
    return getOne($mid, "bav_client", "cli_id_modif");
}


/**
 * retourne tous les clients 
 */
function return_clients($tri, $sens, $selection, $all = "")
{
    $tab = getClients($tri, $sens, string2Tab($selection), $all);
    return $tab;
}

/**
 * retourne les clients avec les infos de confirme, stock, vente, paye, rendu et achat
 */
function return_clientsRecap($tri, $sens, $selection, $all = "false")
{
    $tab = getClientsRecap($tri, $sens, string2Tab($selection), $all);
    return $tab;
}

function return_bavsClient($id)
{
    return  getBavsClient($id);
}

/**
 * retourne un client via son id
 */
function return_oneClient($id)
{
    $row = getOneClient($id);
    if ($row) {
    }
    return $row;
}

/**
 * modifcation d'un client
 */
function action_updateClient($obj)
{
    $tab = string2Tab($obj);
    // // TODO : test cohérence object
    try {
        // on verifie que le mel n'est pas utilisé
        if ($tab['cli_id'] && !$tab['cli_emel'] && !$tab['cli_nom'])   { 
        }
        else if ($tab['cli_emel']) {
            $climel = getOneClientByMel($tab['cli_emel']);
            if ($climel['cli_id'] &&  $climel['cli_id'] != $tab['cli_id']) {
                return "Mel déja utilisé pour " . $climel['cli_nom'];
            }
        } else {
            $climel = getOneClientByName($tab['cli_nom']);
            if ($climel['cli_id'] && $climel['cli_id'] != $tab['cli_id']) {
                return "Nom déja utilisé pour " . $climel['cli_id_modif'];
            }
        }
        updateClient($tab);
        return $tab;
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}

/**
 * 
 * suppression d'un client
 * impossible s'i reste une fiche pour cet agent
 */
function action_deleteClient($id)
{
    $tabFiche = getFiches("obj_id", "asc", array("obj_id_vendeur" => $id));
    if (sizeof($tabFiche) == 0) {
        $tabFiche = getFiches("obj_id", "asc", array("obj_id_acheteur" => $id));
        if (sizeof($tabFiche) == 0) {
            return deleteClient($id);
        } else {
            return "Suppresion impossible, il reste des fiches achats reliées à ce client.";
        }
    } else {
        return "Suppresion impossible, il reste des fiches ventes reliées à ce client.";
    }
}

/**
 * creation d'un client
 */
function action_makeClient($data, $mail = true)
{
    extract($GLOBALS);
    $numBAV = $INFO_APPLI['numero_bav'];
    $par = return_oneParametre($numBAV);

    $tabCli = tabToObject(string2Tab($data), "cli");
    $tabCli = makeClient($tabCli);

    $tabCli['cli_taux_com'] = $par['par_taux_3'];
    $tabCli['cli_prix_depot'] = $par['par_prix_depot_3'];
    // mise a jour des taux
    updateClient($tabCli);

    if ($mail == true) {
        // TODO : envoi du mail
        $titreMel = "Pré enregistrement à la " . $INFO_APPLI['titre'];

        $tabCli['cli_code'] = substr($tabCli['cli_id_modif'], 0, 6);
        $tabCli['titre'] = $INFO_APPLI['titre'];
        $tabCli['URL'] = $CFG_URL;
        // creation du message avec le template
        $message = makeMessage($titreMel, array_merge($tabCli), "mel_pre-enregistrement.html");

        // envoi du mel
        sendMail($titreMel, $tabCli['cli_emel'], $message);
    }
    return $tabCli;
}

function action_redonneCode($mel)
{
    extract($GLOBALS);

    $tabCli = return_oneClientByMel($mel);
    // TODO : envoi du mail
    $titreMel = "Code d'accès à la " . $INFO_APPLI['titre'];

    $tabCli['cli_code'] = substr($tabCli['cli_id_modif'], 0, 6);
    $tabCli['titre'] = $INFO_APPLI['titre'];
    $tabCli['URL'] = $CFG_URL;
        // creation du message avec le template
    $message = makeMessage($titreMel, array_merge($tabCli), "mel_code_access.html");

    // envoi du mel
    sendMail($titreMel, $tabCli['cli_emel'], $message);
}


/**
 * creation d'un client
 * Si presence d'un mel => recherche => si OK on retourne l'id
 * Si presence d'un nom => recherche => si OK on retourne l'id
 * Sinon on crée...  
 */
function makeClient($tabCli)
{

    extract($GLOBALS);
    $numBAV = $INFO_APPLI['numero_bav'];
    $par = return_oneParametre($numBAV);
    if ($tabCli['cli_id'] != null) {
        //echo "makeClient => recherche par mel";
        $clientSearch =  getOne($tabCli['cli_id'], "bav_client", "cli_id");
    }
    if ($clientSearch == null && $tabCli['cli_emel'] != null) {
        //echo "makeClient => recherche par mel";
        $clientSearch =  getOne($tabCli['cli_emel'], "bav_client", "cli_emel");
    }
    if ($clientSearch == null && $tabCli['cli_nom'] != null) {
        //echo "makeClient => recherche par nom";
        $clientSearch =  getOne($tabCli['cli_nom'], "bav_client", "cli_nom");
    }
    if ($clientSearch == null) {
        //echo "makeClient => inconnu, alors creation";
        $tabCli['cli_id'] = 0;
        $tabCli['cli_id_modif'] = hash_hmac('md5', $tabCli['cli_nom'] . rand(0, 200000), 'avs44');
        if (!$tabCli['cli_taux_com']) {
            $tabCli['cli_taux_com'] = $par['par_taux_1'];
        }
        if (!$tabCli['cli_prix_depot']) {
            $tabCli['cli_prix_depot'] = $par['par_prix_depot_1'];
        }
        $tabCli['cli_id'] = insertClient($tabCli);

        $clientSearch = $tabCli;
    }

    return $clientSearch;
}
