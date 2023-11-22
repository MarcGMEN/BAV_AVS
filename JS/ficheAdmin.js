// mode de fonctionnement de la page
// create  : creation d'une fiche CLIENT
// consult : modification par le client avec numero de fiche
// 

texteDescription = "";

/*
 * action lors du chargement de la page
 */
function initPage() {
    // creation des listes des choix type, public et patiqye
    x_return_enum('bav_objet', 'obj_type', display_list_type);
    x_return_enum('bav_objet', 'obj_public', display_list_public);
    x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

    // recuperation de la liste des marques
    x_return_list_marques(display_list_marques)
    x_return_list_tailles(display_list_tailles)

    document.ficheForm.obj_type.focus();
    document.ficheForm.obj_description.value = texteDescription;

    // chargement de la liste des client par mel
    x_return_listClientByMel(display_listVendeur);

    // chargement de la liste des client par mel
    x_return_listClientByName(display_listVendeurName);

    // en mode create de table, le mail n'est pas obligatoire
    document.ficheForm.cli_emel.required = false;

    // champ au nom aleatoir pour contrer google 
    document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).required = true;

    // pas de couleur obligatoire
    document.ficheForm.obj_couleur.required = true;

    // prix de depot obligatoire
    document.ficheForm.obj_prix_depot.required = true;

    // si on passe un d de fiche alors pn affiche
    if (idFiche) {
        x_return_oneFiche(idFiche, display_fiche);
    } else {
        // on doit être en create, sinon index.
        if (modePage != "create") {
            goTo();
        }
    }
}

// que faire en cas de changement de saisie
function pageSaisie() {
    if (startSaisie) {
        document.ficheForm.buttonValideFiche.disabled = false;
        document.ficheForm.buttonValideFiche.title = "Valider vos modifications";
        document.ficheForm.buttonPDFFiche.disabled = true;
        document.ficheForm.buttonPDFFiche.title = "Valider les modifications avant d'imprimer";
    } else {
        document.ficheForm.buttonValideFiche.disabled = true;
        document.ficheForm.buttonValideFiche.title = "Rien de changé";
        document.ficheForm.buttonPDFFiche.disabled = false;
        document.ficheForm.buttonPDFFiche.title = "Impression en PDF";
    }
}

/*
 * action lors du derchargement de la page
 */
function unloadPage() {

}

/************************************************************************ */
/************************************************************************ */
/************************************************************************ */
/*****************Creation des listes *********************************** */
/************************************************************************ */
/************************************************************************ */
/************************************************************************ */
/*
 * affichage de la liste de type possible
 */
function display_list_type(val) {
    display_list_select(val, 'obj_type', document.ficheForm);
}
/*
 * affichage de la liste de pratique possible
 */
function display_list_pratique(val) {
    display_list_select(val, 'obj_pratique', document.ficheForm);
}
/*
 * affichage de la liste de public possible
 */
function display_list_public(val) {
    display_list_select(val, 'obj_public', document.ficheForm);
}

function display_list_marques(val) {
    var list = getElement("listMarques");
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}

function display_list_tailles(val) {
    var list = getElement("listTailles");
    list.innerHTML = "";
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}

function display_list_modeles(val) {
    list.innerHTML = "";
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}

/**
 * liste des vendeurs par mel
 * @param  val 
 */
function display_listVendeur(val) {
    var list = getElement("listVendeur");
    list.innerHTML = "";;
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}

/**
 * liste des vendeurs par nom
 * @param  val 
 */
function display_listVendeurName(val) {
    var list = getElement("listVendeurName");
    list.innerHTML = "";
    for (index in val) {
        list.appendChild(new Option(val[index]['cli_emel'] + " - " + val[index]['cli_code_postal'], val[index]['cli_nom']));
    }
}

/************************************************************************ */
/************************************************************************ */
/************************************************************************ */
/*****************gesttion du CLIENT ************************************ */
/************************************************************************ */
/************************************************************************ */
/************************************************************************ */
/************************************************************************ */

/**
 * recherche par nim si pas encore trouve
 * @param {} value 
 */
function searchByName(value) {
    if (value != "" && document.ficheForm.cli_emel.value == "") {
        x_return_oneClientByName(value, display_infoClientVendeurName);
    }
}

function searchByMel(value) {
    if (value != "") {
        x_return_oneClientByMel(value, display_infoClientVendeurMel);
    }
}

function display_infoClientVendeurMel(val) {
    display_infoClientVendeur(val, "emel");
}

function display_infoClientVendeurName(val) {
    display_infoClientVendeur(val, "nom");
}

function display_infoClientVendeur(val, base) {
    if (val instanceof Object) {
        display_formulaire(val, document.ficheForm);
    } else {
        // reset des champs cli
        // saug cli_emel pour ne pas le perdre
        val = [];
        val['cli_id'] = "NEW";
        if (base == 'emel') {
            val['cli_nom'] = "";
        } else if (base == 'nom') {
            val['cli_emel'] = "";
        } else {
            val['cli_nom'] = "";
            val['cli_emel'] = "";
        }
        getElement('legendVendeur').title = "";
        display_formulaire(val, document.ficheForm);
    }
}

/**
 * 
 */
function display_fiche(val) {
    if (val instanceof Object) {
        getElement('obj_etat_libelle').className = val['obj_etat'];
        getElement('BtnSaisieExpress').style.display = 'inline';

        val['obj_marque_' + idRamdom] = val['obj_marque'];
        
        x_return_oneClient(val['obj_id_vendeur'], display_infoClientVendeur);

        getElement("trTitreFiche").style.display = 'block';
        // TODO : en fonction de l'etat, on propose les btn
        // etat INIT
        getElement("tdBtnEmel").style.display = 'none';

        console.log(val['obj_etat']);

        if (val['obj_etat'] == "INIT") {
            getElement("tdBtnSup").style.display = 'block';
            document.ficheForm.buttonValideFiche.innerHTML = "Modifier";
            val['obj_etat_libelle'] = "Demande initiée par le vendeur <br/>le [" + formatDate(val['obj_date_depot'], true) + "]";
            document.ficheForm.obj_prix_vente.disabled = true
            getElement("tdBtnEmel").style.display = 'block';
        }
        // etat CONFIRME
        if (val['obj_etat'] == "CONFIRME") {
            getElement("tdBtnPdf").style.display = 'block';
            getElement("tdBtnSup").style.display = 'block';
            document.ficheForm.buttonValideFiche.innerHTML = "Modifier";

            document.ficheForm.cli_emel.disabled = true;
            if (getElement("obj_prix_vente")) {
                getElement("obj_prix_vente").innerHTML = val['obj_prix_depot'];
            }
            document.ficheForm.obj_prix_vente.value = val['obj_prix_depot'];
            document.ficheForm.obj_prix_vente.disabled = true

            val['obj_etat_libelle'] = "Demande confirmée<br/>le [" + formatDate(val['obj_date_depot'], true) + "]";
        }
        // etat STOCK
        if (val['obj_etat'] == "STOCK") {

            disable_formulaire(document.ficheForm, "cli");
            disable_formulaire(document.ficheForm, "obj");
            
            getElement("tdBtnPdf").style.display = 'block';
            document.ficheForm.buttonValideFiche.innerHTML = "Modifier";

            getElement("tdBtnSup").style.display = 'none';

            // TODO : blocage de la fiche, sauf admin
            document.ficheForm.obj_prix_depot.disabled = false;
            document.ficheForm.obj_prix_nego.disabled = false;
            document.ficheForm.buttonValideFiche.disabled = false;
            document.ficheForm.obj_accessoire.disabled = false;
            // document.ficheForm.obj_modif_accessoire.disabled = false;

            val['obj_etat_libelle'] = "Présent sur le parc";
            // document.ficheForm.obj_prix_vente.disabled = true

            // getElement("tdBtnAction").style.display = 'none';
            getElement("fieldSetAcheteur").style.display = 'none';
        }
        if (val['obj_etat'] == "VENDU") {
            getElement("tdBtnSup").style.display = 'none';

            disable_formulaire(document.ficheForm, "obj");
            disable_formulaire(document.ficheForm, "cli");

            getElement("tdBtnAction").style.display = 'none';

            val['obj_etat_libelle'] = "Vendu le [" + formatDate(val['obj_date_vente']) + "]";

            document.ficheForm.obj_prix_vente.disabled = false


            getElement("tdBtnPdf").style.display = 'block';

            getElement("fieldSetAcheteur").style.display = 'block';
            document.ficheForm.ach_nom.required = false;
            // document.ficheForm.obj_prix_depot.disabled = true;
            x_return_oneClient(val['obj_id_acheteur'], display_infoClientAcheteur);
            x_return_listClientByName(display_listAcheteurName);
        }

        if (val['obj_etat'] == "RENDU" || val['obj_etat'] == "PAYE") {

            disable_formulaire(document.ficheForm, "obj");

            getElement("tdBtnPdf").style.display = 'block';
            getElement("tdBtnSup").style.display = 'block';

            // document.ficheForm.obj_prix_depot.disabled = true;
            document.ficheForm.obj_prix_vente.disabled = false

            if (val['obj_etat'] == "RENDU") {
                val['obj_etat_libelle'] = "Rendu au vendeur<br/>le [" + formatDate(val['obj_date_retour']) + "]";
            } else {
                val['obj_etat_libelle'] = "Payé au vendeur<br/>le [" + formatDate(val['obj_date_retour']) + "]";

                getElement("fieldSetAcheteur").style.display = 'block';

                document.ficheForm.ach_nom.required = false;
                x_return_oneClient(val['obj_id_acheteur'], display_infoClientAcheteur);
                x_return_listClientByName(display_listAcheteurName);
            }
        }
        display_formulaire(val, document.ficheForm);
    } else {
        // console.log("Fiche inconnue.");
        //goTo(null, null, null, "Fiche inconnue.");
    }
}
/**
 * Action en submit de form si valide
 */
function submitForm() {
    if (modePage == 'modif') {
        modifFiche();
    }
    return false;
}

/**click sur btn cofirm de modalFiche */
function confirmModal(plus) {
    if (plus == "Close") {
        closeModal();
        goTo();
    } else if (plus == "Supp") {
        var tabObj = recup_formulaire(document.ficheForm, 'obj');
        x_action_deleteFiche(tabObj['obj_id'], display_fin_supp);
    } else if (plus == "CMop" || plus == "SMop") {
        confirmModalMop(plus)
    }
}


function confirmeFiche() {

    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    if (tabObj['obj_etat'] == 'INIT' && tabObj['obj_etat_new'] == "CONFIRME") {
        tabObj['obj_etat'] = 'CONFIRME'
        x_action_changeEtatFiche(tabToString(tabObj), display_fin_modif);
    } else {
        alertModalInfoTimeout("what you do ?????", 0.5);
    }
}

function display_fin_supp(val) {
    goTo();
}

// validation de la fiche en creation
function modifFiche() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    var tabCli = recup_formulaire(document.ficheForm, 'cli');
    var tabAch;
    if (getElement("fieldSetAcheteur").style.display == 'block') {
        tabAch = recup_formulaire(document.ficheForm, 'ach');
    }
    tabObj['obj_marque'] = document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).value;
    delete tabObj['obj_marque_' + idRamdom];

    var tabData = Object.assign({}, tabObj, tabCli, tabAch);
    console.log(tabData);
    x_action_updateFiche(tabToString(tabData), display_fin_modif);
    return false;

}

function display_fin_modif(val) {
    if (val instanceof Object) {
        setStartSaisie(false);
        x_return_countByEtat(display_counter);
        x_return_oneFiche(val['obj_id'], display_fiche);
        alertModalInfoTimeout("Fiche " + val['obj_numero'] + " modifié.", 0.5);
    } else {
        alertModalWarn(val);
    }
}

/**
 * Suppression d'une fiche
 */
function supprimerFiche() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    // creation du message de confirmation de la suppression
    x_get_publiHtml(tabToString(tabObj), 'modal_confirm_supp.html', display_messageConfirmSupp);
    return false;
}
/**
 * affchage du modal de suppression avec attente de confirmation
 * la confirmation est géré par ConfirmModal option Supp
 * @param  mess 
 */
function display_messageConfirmSupp(mess) {
    alertModalConfirm(mess, "Supp");
}

function imprimeFiche() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    alertModalInfo("Génération de la fiche " + tabObj['obj_numero'] + " au format PDF <img src='Images/spinner_white_tiny.gif' />");
    x_action_makePDF(tabObj['obj_id'], display_openPDF);
}

// bouton ANNULER
function fermerCRUD(LaForm) {
    suite = true;
    if (startSaisie) {
        alertModalConfirm("<br/><br/><center>Vous avez des modifications en cours<center>", "Close")
    } else {
        confirmModal("Close");
    }
}

/**
 * recherche par nim si pas encore trouve
 * @param {} value 
 */
function searchAchByName(value) {
    if (value != "") {
        x_return_oneClientByName(value, display_infoClientAcheteurName);
    }
}

/**
 * recherche par mail
 * @param {} value 
 */
function searchAchByMel(value) {
    if (value != "") {
        x_return_oneClientByMel(value, display_infoClientAcheteur);
    }
}


function display_infoClientAcheteur(val) {
    display_infoClientAcheteur(val, "emel");
}

function display_infoClientAcheteurName(val) {
    display_infoClientAcheteur(val, "nom");
}

function display_infoClientAcheteur(val, base) {
    if (val instanceof Object) {
        // remplacement du trigramme cli par ach
        for (i in val) {
            newKey = i.replace("cli_", "ach_");
            val[newKey] = val[i];
            delete val[i];
        }
    } else {
        // reset des champs cli
        val = [];
        val['ach_id'] = "NEW";
        if (base == 'emel') {
            val['ach_nom'] = "";
        }
        if (base == 'nom') {
            //val['ach_emel'] = "";
        }
        val['ach_code_postal'] = "";
    }
    display_formulaire(val, document.ficheForm);
}

function display_listAcheteurName(val) {
    var list = getElement("listAcheteurName");
    list.innerHTML = "";
    for (index in val) {
        list.appendChild(new Option(val[index]['cli_emel'] + " - " + val[index]['cli_code_postal'], val[index]['cli_nom']));
    }
}


function action_descript_plus() {

    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    tabObj['obj_marque'] = document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).value;
    delete tabObj['obj_marque_' + idRamdom];

    var tabData = Object.assign({}, tabObj);
    x_get_publiHtml(tabToString(tabData), 'modal_description_plus.html', display_messageDescript);

}

function display_messageDescript(val) {
    alertModalConfirm(val, "DescPlus", "Description plus");
}