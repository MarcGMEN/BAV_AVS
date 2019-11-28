<?php

function return_modifPrixFromFiche($idFiche) {
    return getModifPrixFromFiche($idFiche);
}

/**
 * Retourne toutes les demandes active
 */
function return_allDemandeActive() {
    return getAllModifActivePrixFromFiche();

}

/**
 * ajout d'une demande
 */
function action_addDemande($mop) {

}

/**
 * confirmation de la demande
 * avec envoi d'un mail au demandeur (vendeur)
 */
function action_ConfirmDemande($mop) {

}

function action_removeDemande($id) {
    $mop = getOneModifPrix($id);

    if ($mop['mop_date_validation'] == null) {
        return "Suppression impossible d'une demande non validé";
    }
    else {
        return deleteModifPrix($id);
    }
}