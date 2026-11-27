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

function action_createAccessoire($dataAccessoire)
{

    extract($GLOBALS);
    try {

        $tab = string2Tab($dataAccessoire);

        $row = getOneAccessoireByNumero($tab['acc_numero']);

        if ($row) {
            if ($row['acc_etat'] != 'Déposé') {
                $row['acc_etat'] ='Déposé';
            }
            else {
                $row['acc_commentaire'] = $tab['acc_commentaire'];
            }
            $tabObj = tabToObject($row, "acc");
            $tabObj = updateAccessoire($tabObj);
            return $tabObj;
        } else {
            $tab['acc_numero_bav'] = $INFO_APPLI['numero_bav'];
            // $tab['acc_commentaire'] = $tab['acc_commentaire'];

            $tabObj = tabToObject($tab, "acc");
            $tabObj = insertAccessoire($tabObj);
            return $tabObj;
        }
    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}



function action_chgtEtatAccessoire($num, $etat)
{

    $row = getOneAccessoireByNumero($num);
    $row['acc_etat'] = utf8_encode($etat);
    // print_r($row);
    try {
        $tabObj = tabToObject($row, "acc");
        $tabObj = updateAccessoire($tabObj);
        return $tabObj;

    } catch (Exception $e) {
        return "ERREUR " . $e->getMessage();
    }
}

/**
 * supresion d'une fiche
 */
function action_deleteAccessoire($num)
{
    $row = getOneAccessoireByNumero($num);
    if ($row) {
        return deleteAccessoire($row['acc_id']);
    }
    return null;
}


function return_allAccessoires()
{
    return getAllAccessoires();
}
