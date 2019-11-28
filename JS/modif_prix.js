
var formMop;
var theFiche;

function initModifPrix(fiche, theForm) {
    formMop = theForm;
    theFiche = fiche;

    var mop = [];
    if (ADMIN) {
        // getElement('divActionModifPrix').style.display='none';
    }
    getElement('divModifPrix').style.display = 'block';
    mop['mop_prix_demande'] = fiche['obj_prix_vente'];
    mop['mop_id_obj'] = fiche['obj_id'];

    //x_return_modifPrixFromFiche(val['obj_id'], display_modifPrix);

    display_formulaire(mop, formMop);
}


function display_modifPrix(val) {
    console.log(val);

    var maxDemande = $GLOBALS['INFO_APPLI']['NB_MODIF'];
    var nbDemande = 0;
    var demandeEnAttente = false;
    var repr = "";
    if (val instanceof Object) {
        for (index in val) {
            if (!isNaN(index)) {
                // if demande sans date de validation OU arrive au max des demandes ...
                // alors on bloque la saisie d'un nouvelle demane
                nbDemande++;
                if (val[index]['mop_date_validation'] == null) {
                    demandeEnAttente = true;
                }
                repr += "";

            }
        }
        if (nbDemande >= maxDemande || demandeEnAttente) {
            getElement('divModifPrix').style.display = 'none';
        }
        else {
            getElement('divModifPrix').style.display = 'block';
        }
    }
    else {
        alertModalWarn(val);
    }
}

function confirmModalMop(plus) {
    var tabMop = recup_formulaire(formMop, 'mop');
    x_action_addDemande(tabToString(tabMop), display_fin_demande);
}

function addDemande() {
    var tabMop = recup_formulaire(formMop, 'mop');
    var tabData = Object.assign({}, tabMop, theFiche);
    x_get_publiHtml(tabToString(tabData), 'modal_confirm_Cmop.html', display_messageConfirmMop);

    return false;

}

/**
 * affchage du modal de suppression avec attente de confirmation
 * la confirmation est géré par ConfirmModal optoin Supp
 * @param  mess 
 */
function display_messageConfirmMop(mess) {
    alertModalConfirm(mess, "CMop");
}

function display_fin_demande(val) {
    alertModalInfo("Votre demande va être prise en compte dans les plus bref délais.");
    initModifPrix(theFiche, formMop);
}