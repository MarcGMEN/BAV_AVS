<?php

function return_modifPrixFromFiche($idFiche) {
    $tabMop= getModifPrixFromFiche($idFiche);

    foreach($tabMop as $key => $val) {
        $tabMop[$key]['mop_date_demande_FR'] = formateDateMYSQLtoFR($val['mop_date_demande'], true);
        $tabMop[$key]['mop_date_validation_FR'] = formateDateMYSQLtoFR($val['mop_date_validation'], true);
    }

    return $tabMop;
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
    return insertModifPrix($mop);
}

/**
 * confirmation de la demande
 * avec envoi d'un mail au demandeur (vendeur)
 */
function action_confirmDemande($idMop) {
    $mop['mop_id']=$idMop;
    $mop['mop_date_validation']=date('y-m-d H:i:s');
    $mopModif=updateModifPrix($mop);

    $fiche=getOneFiche($mopModif['mop_id_obj']);
    $fiche['obj_prix_vente']=$mopModif|['obj_prix_demande'];
    updateFiche($fiche);

    $cliVend = getOneClient($fiche['obj_id_vendeur']);

    // si le client a un mel on envoi un mel
    if ($cliVend['cli_emel'] != "") {
        
        // TODO : envoi du mail
        $titreMel = "BAV #" . $fiche['obj_numero'] . ", Modification du prix  .";

        // creation du message avec le template
        // html/mel_vendu.html
        $message = makeMessage($titreMel, array_merge($fiche, $cliVend), "mel_modif.html");

        // envoi du mel
        sendMail($titreMel, $cliVend['cli_emel'], $message);
    }
    return true;
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