<?php
/**************************************/
/**************************************/
/* FICHE */
/**************************************/
/**************************************/

$data = array(
    'date1' => date('d', $INFO_APPLI['date_j1']),
    'date2' => date('d', $INFO_APPLI['date_j2']),
    'date3' => date('d', $INFO_APPLI['date_j3']),
    'annee' => date('Y', $INFO_APPLI['date_j2']),
    'titre' => $INFO_APPLI['titre'],
    'URL' => $CFG_URL,
    'numero_bav' => $INFO_APPLI['numero_bav'],
    'today' => date('d/m/Y')
);


/**
 * Recherche d'une fiche avec son ID
 */
function return_oneAccessoire($id)
{
    $row = getOneAccessoire($id);
    return $row;
}

/**
 * Recherche d'une fiche avec son ID
 */
function return_oneAccessoireByNumero($num)
{
    $row = getOneAccessoireByNumero($num);
    return $row;
}


/**
 * creation d'une fiche, complete
 * on doit retrouve le client et la fiche
 * en mode ADMIN :  creation directe et mise en STOCK
 * en mode CLIENT : creation en INIT avec un numero dans le 5000 et envoi d'un mail pour confirmer la creation
 */
function action_createAccessoire($dataAccessoire)
{
    extract($GLOBALS);
    $ADMIN = $INFO_APPLI['ADMIN'];

    $retour = [];
    try {
        $tabObj = tabToObject(string2Tab($dataAccessoire), "obj");
        $tabCli = tabToObject(string2Tab($dataAccessoire), "cli");

        $tabObj['obj_id'] = insertAccessoire($tabObj);

        $tabObj['modif_fiche'] = 1;

        return $tabObj;
       
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
    return $retour;
}

function action_chgtEtatAccessoire($num, $etat) {

}

/**
 * supresion d'une fiche
 */
function action_deleteAccessoire($id)
{
    return deleteAccessoire($id);
}
