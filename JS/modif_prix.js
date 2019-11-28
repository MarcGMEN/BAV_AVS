
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

                repr += "<div class='tabl0 col-md-12'><span class='col-md-4'>"
                repr += val[index]['mop_prix_demande'];
                repr += "</span><span class='tittab col-md-4'>";
                repr += val[index]['mop_date_demande_FR'];
                repr += "</span><span class='tittab col-md-4'>";
                if (val[index]['mop_date_validation'] == null) {
                    demandeEnAttente = true;
                    // Btn ADMIN de validation
                    if (ADMIN) {
                        repr += "<input type=button value='Valider' onclick='confirmDemande(" + val[index]['mop_id'] + ")' >&nbps;";
                    }
                    repr += "En cours de validation<br/><input type=button value='Supprimer' onclick='removeDemande(" + val[index]['mop_id'] + ")' >";
                }
                else {
                    repr += val[index]['mop_date_validation_FR'];
                }
                repr += "</span></div>";
            }
        }
        if (nbDemande >= maxDemande || demandeEnAttente) {
            getElement('divModifPrix').style.display = 'none';
        }
        else {
            getElement('divModifPrix').style.display = 'block';
        }

        getElement("tabModifPrix").innerHTML = repr;
    }
    else {
        alertModalWarn(val);
    }
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
/**
 * retour OK de confirm
 * @param {*} plus 
 */
function confirmModalMop(plus) {
    if (plus == "CMop") {
        var tabMop = recup_formulaire(formMop, 'mop');
        x_action_addDemande(tabToString(tabMop), display_fin_demande);
    }
    else if (plus == "SMop") {
        var tabMop = recup_formulaire(formMop, 'mop');
        x_action_removeDemande(tabMod['mop_id'], display_fin_removeMop);
    }

}

/**
 * fin de add demande
 * @param {*} val 
 */
function display_fin_demande(val) {
    alertModalInfo("Votre demande va être prise en compte dans les plus bref délais.");
    initModifPrix(theFiche, formMop);
}

function display_fin_removeMop(val) {
    initModifPrix(theFiche, formMop);
}

/**
 * confirmation de la demande par ADMIN
 * @param {*} id 
 */
function confirmDemande(id) {
    x_action_confirmDemande(id, display_fin_confirmMop);
}

/**
 * fin confirme , on recharge
 * @param {} val 
 */
function display_fin_confirmMop(val) {
    alertModalInfo("Modification OK, le vendeur va recevoir un mail.");
    initModifPrix(theFiche, formMop);
}


function removeDemande(id) {
    x_get_publiHtml("", 'modal_confirm_Smop.html', display_messageConfirmSuppMop);
    return false;
}
/**
 * @param  mess 
 */
function display_messageConfirmSuppMop(mess) {
    alertModalConfirm(mess, "SMop");
}

