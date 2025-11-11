var objTable = {};

function display_getFicheTable(val) {
    console.log("FicheTable");
    console.log(val);

    objTable = val;
    Gtype = "Etiquette";

    switch (val['obj_etat']) {
        case 'CONFIRME':
            break;
        case 'STOCK':
            x_get_publiHtml(tabToString(val), 'modal_confirm_vendre.html', display_messageConfirmChangeEtatForm);
            break;
        case 'VENDU':
            val['obj_etat_new'] = "PAYE";
            alertModalConfirm('Le vélo est vendu ' + val['obj_prix_vente'] + '&euro;,<br/> confirmez vous le paiement au vendeur et la récuperation de ' + val['cli_com'] + '&euro; de com ?', "vendu2paye");
            break;
        case 'PAYE':
            alertModalWarnTimeout("Vélo payé au vendeur, plus rien à faire", 2);
            break;
        case 'RENDU':
            alertModalWarnTimeout("Vélo rendu au vendeur, rien à faire", 2);
            break;
        default:
            break;
    }
}

function display_fiche_vente(val) {
    val['random'] = idRamdom;
    x_get_publiHtml(tabToString(val), 'modal_confirm_vendre.html', display_messageConfirmChangeEtatForm);
}

function display_messageConfirmChangeEtatForm(val) {
    alertModalConfirm(val);
    document.modalForm.obj_prix_vente.focus();

    // chargement de la liste des client par mel
    //x_return_listClientByMel(display_listAcheteur);
    // chargement de la liste des client par mel
    x_return_listClientByName(display_listAcheteurBis);
}

function display_listAcheteurBis(val) {
    var list = getElement("listAcheteurBis");
    list.innerHTML = "";
    for (index in val) {
        list.appendChild(new Option(val[index]['cli_emel'] + " - " + val[index]['cli_code_postal'], val[index]['cli_nom']));
    }
}

function confirmModal(plus) {
    console.log("confirmModal" + plus);
    if (plus == "vendu2paye") {
        modifEtat(objTable, {});
        // x_return_oneFicheByIdModif(objTable['obj_id_mmodif'], display_getFicheTable);
    }
}

function modifEtat(tabObj) {

    if (tabObj['obj_etat'] != '') {
        // avec un etat confirme, on bascule le prix de vente en prix depot pour l'update
        if (tabObj['obj_etat'] == 'CONFIRME') {
            tabObj['obj_prix_depot'] = tabObj['obj_prix_vente']
        }
        // console.log("avec change etat fiche");
        //console.log(tabObj);
        x_action_changeEtatFiche(tabToString(tabObj), display_fin_create);
    }
}

function display_fin_create(val) {
    console.log(val);

    x_return_oneFicheByIdModif(val['obj_id_modif'], display_getFicheConsult);
}