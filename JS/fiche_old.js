// mode de fonctionnement de la page
// create  : creation d'une fiche CLIENT
// consult : modification par le client avec numero de fiche
// 

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

    // chargement des taux
    x_return_tauxBAV(display_list_taux_com);
    // chargement des depot
    x_return_depotsBAV(display_list_prix_depot);

    document.ficheForm.obj_type.focus();

    if (ADMIN) {
        // chargement de la liste des client par mel
        x_return_listClientByMel(display_listVendeur);
        // chargement de la liste des client par nom
        x_return_listClientByName(display_listVendeurBis);

        console.log("mode " + ADMIN);
        // en mode create de table, le mail n'est pas obligatoire
        document.ficheForm.cli_emel.required = false;

        // pas de CGU pour la ADMIN

        document.ficheForm.checkCGU.required = false;
        // pas la peine de voir les CGU
        getElement("tdCGU").style.display = 'none';

        // champ au nom aleatoir pour contrer google 
        document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).required = false;

        // pas de couleur obligatoire
        document.ficheForm.obj_couleur.required = false;

        // prix de depot oblogatoire
        document.ficheForm.obj_prix_depot.required = true;

        // affichage de la section TAUX-CAM
        getElement("trTauxCom").style.display = 'block';

        // affchage de la section PRIX
        getElement("divPrix").style.display = 'block';

        // affichage des boutons 
        getElement("tdBtnEtat").style.display = 'block';

        // sinon si pas de CLIENT possible
    } else if (!CLIENT) {
        alertModalInfo("La saisie n'est pas encore ouverte.");
        setTimeout(function() { goTo() }, 2000);
    }

    // si on passe un d de fiche alors pn affiche
    if (idFiche) {
        x_return_oneFiche(idFiche, display_fiche);
    } else {
        // on doit être en create, sinon index.
        if (modePage != "create") {
            goTo();
        }
        // en creation une fiche est INIT pour le futur etat
        document.ficheForm.obj_etat_new.value = "INIT";
    }
}

// que faire en cas de changement de saisie
function pageSaisie() {
    if (startSaisie) {
        document.ficheForm.buttonValideFiche.disabled = false;
        document.ficheForm.buttonValideFiche.title = "Valider vos modifications";
        document.ficheForm.buttonPDFFiche.disabled = true;
        document.ficheForm.buttonPDFFiche.title = "Valider les modifications avant d'imprimer";
        if (document.ficheForm.buttonPDFEtiquette) {
            document.ficheForm.buttonPDFEtiquette.disabled = true;
            document.ficheForm.buttonPDFEtiquette.title = "Valider les modifications avant d'imprimer";
        }
    } else {
        document.ficheForm.buttonValideFiche.disabled = true;
        document.ficheForm.buttonValideFiche.title = "Rien de changé";
        document.ficheForm.buttonPDFFiche.disabled = false;
        document.ficheForm.buttonPDFFiche.title = "Impression en PDF";
        if (document.ficheForm.buttonPDFEtiquette) {
            document.ficheForm.buttonPDFEtiquette.disabled = false;
            document.ficheForm.buttonPDFEtiquette.title = "Impression en PDF";
        }
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

function display_list_taux_com(val) {
    display_list_select(val, 'cli_taux_com', document.ficheForm);
}

function display_list_prix_depot(val) {
    display_list_select(val, 'cli_prix_depot', document.ficheForm);
    affectPrix();
}

function display_list_marques(val) {
    var list = getElement("listMarques");
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}

function display_list_modeles(val) {
    var list = getElement("listModeles");
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
function display_listVendeurBis(val) {
    var list = getElement("listVendeurBis");
    list.innerHTML = "";;
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}

/************************************************************************ */
/************************************************************************ */
/************************************************************************ */
/************************************************************************ */
/************************************************************************ */
/************************************************************************ */
/************************************************************************ */
/************************************************************************ */

/**
 * recherche par nim si pas encore trouve
 * @param {} value 
 */
function searchByName(value) {
    if (document.ficheForm.cli_id == null && document.ficheForm.cli_emel == "") {
        x_return_oneClientByNom(value, display_infoClientVendeurBis);
    }
}

/**
 * 
 */
function display_fiche(val) {
    if (val instanceof Object) {
        val['obj_marque_' + idRamdom] = val['obj_marque'];
        console.log(val);
        x_return_oneClient(val['obj_id_vendeur'], display_infoClientVendeur);
        getElement("trTitreFiche").style.display = 'block';
        // TODO : en fonction de l'etat, on propose les btn
        // etat INIT
        if (val['obj_etat'] == "INIT") {
            getElement("tdBtnSup").style.display = 'block';
            document.ficheForm.buttonValideFiche.innerHTML = "Modifier";
            document.ficheForm.buttonEtatFiche.value = "Confirmer";
            document.ficheForm.obj_etat_new.value = "CONFIRME";
            val['obj_etat_libelle'] = "Demande initiée par le vendeur le [" + formatDate(val['obj_date_depot'], true) + "]";
            document.ficheForm.obj_prix_vente.disabled = true

            if (ADMIN) {
                getElement("tdBtnEmel").style.display = 'block';
            }
        }
        // etat CONFIRME
        if (val['obj_etat'] == "CONFIRME") {
            getElement("tdBtnPdf").style.display = 'block';
            getElement("tdBtnSup").style.display = 'block';
            getElement("divPrix").style.display = 'block';
            document.ficheForm.buttonValideFiche.innerHTML = "Modifier";

            document.ficheForm.cli_emel.disabled = true;
            // pas de CGU pour la ADMIN
            document.ficheForm.checkCGU.required = false;
            // pas la peine de voir les CGU
            getElement("tdCGU").style.display = 'none';
            if (getElement("obj_prix_vente")) {
                getElement("obj_prix_vente").innerHTML = val['obj_prix_depot'];
            }
            document.ficheForm.obj_prix_vente.value = val['obj_prix_depot'];
            document.ficheForm.obj_prix_vente.disabled = true

            if (!ADMIN) {
                document.ficheForm.obj_prix_depot.min = 1;
            }
            document.ficheForm.buttonEtatFiche.value = "Mettre en stock";
            document.ficheForm.obj_etat_new.value = "STOCK";
            val['obj_etat_libelle'] = "Demande confirmée le [" + formatDate(val['obj_date_depot'], true) + "]";
        }
        // etat STOCK
        if (val['obj_etat'] == "STOCK") {
            getElement("divPrix").style.display = 'block';
            getElement("tdBtnPdf").style.display = 'block';
            document.ficheForm.buttonValideFiche.innerHTML = "Modifier";

            // pas de CGU pour la ADMIN
            document.ficheForm.checkCGU.required = false;
            // pas la peine de voir les CGU
            getElement("tdCGU").style.display = 'none';
            getElement("tdBtnSup").style.display = 'none';

            // TODO : blocage de la fiche, sauf admin
            document.ficheForm.obj_prix_depot.disabled = true;
            if (!ADMIN) {
                document.ficheForm.cli_prix_depot.disabled = true;
            }
            document.ficheForm.buttonEtatFiche.value = "Vendre";
            document.ficheForm.obj_etat_new.value = "VENDU";
            val['obj_etat_libelle'] = "Présent sur le parc";
            document.ficheForm.buttonEtatFicheBis.style.display = 'inline';
            document.ficheForm.buttonEtatFicheBis.value = 'Rendre';
            document.ficheForm.obj_prix_vente.disabled = false
            document.ficheForm.buttonEtatFicheBis.onclick = function() { changeEtatFiche('RENDU') };
            if (!ADMIN) {
                disable_formulaire(document.ficheForm, "cli");
            }

            getElement("fieldSetAcheteur").style.display = 'none';
        }
        if (val['obj_etat'] == "VENDU") {
            getElement("divPrix").style.display = 'block';

            // pas de CGU pour la ADMIN
            document.ficheForm.checkCGU.required = false;
            // pas la peine de voir les CGU
            getElement("tdCGU").style.display = 'none';
            getElement("tdBtnSup").style.display = 'none';

            if (!ADMIN) {
                disable_formulaire(document.ficheForm, "obj");
                disable_formulaire(document.ficheForm, "cli");
                getElement("tdBtnAction").style.display = 'none';
            }

            document.ficheForm.buttonEtatFiche.value = "A payer";
            document.ficheForm.obj_etat_new.value = "PAYE";
            val['obj_etat_libelle'] = "Vendu le [" + formatDate(val['obj_date_vente']) + "]";
            /*            if (!ADMIN) {
                            document.ficheForm.buttonEtatFicheBis.style.display = 'none';
                            document.ficheForm.buttonEtatFicheBis.value = '';
                        }
                        else {*/
            document.ficheForm.buttonEtatFicheBis.style.display = 'inline';
            document.ficheForm.buttonEtatFicheBis.value = 'Remettre en Stock';

            document.ficheForm.buttonEtatFicheBis.onclick = function() { changeEtatFiche('RESTOCK') };
            //}

            if (ADMIN) {
                document.ficheForm.obj_prix_vente.disabled = false

                getElement("tdBtnPdf").style.display = 'block';

                getElement("fieldSetAcheteur").style.display = 'block';
                x_return_oneClient(val['obj_id_acheteur'], display_infoClientAcheteurFiche);
            }
        }

        if (val['obj_etat'] == "RENDU" || val['obj_etat'] == "PAYE") {
            getElement("divPrix").style.display = 'block';
            if (TABLE) {
                getElement("tdBtnPdf").style.display = 'block';
            } else if (ADMIN) {
                getElement("tdBtnPdf").style.display = 'block';
                getElement("tdBtnSup").style.display = 'block';
            } else {
                disable_formulaire(document.ficheForm, "obj");
                disable_formulaire(document.ficheForm, "cli");
                getElement("tdBtnAction").style.display = 'none';
            }
            // pas de CGU pour la TABLE et ADMIN
            document.ficheForm.checkCGU.required = false;
            // pas la peine de voir les CGU
            getElement("tdCGU").style.display = 'none';
            document.ficheForm.buttonEtatFicheBis.style.display = 'none';
            document.ficheForm.buttonEtatFicheBis.value = '';

            if (val['obj_etat'] == "RENDU") {
                val['obj_etat_libelle'] = "Rendu au vendeur le [" + formatDate(val['obj_date_retour']) + "]";
                document.ficheForm.buttonEtatFiche.value = "Remettre en stock";
                document.ficheForm.obj_etat_new.value = "RESTOCK";

            } else {
                val['obj_etat_libelle'] = "Payé au vendeur le [" + formatDate(val['obj_date_retour']) + "]";
                if (ADMIN) {
                    document.ficheForm.buttonEtatFiche.value = "Remettre en stock";
                    document.ficheForm.obj_etat_new.value = "RESTOCK";
                } else {
                    getElement("tdBtnEtat").style.display = 'none';
                }
                getElement("fieldSetAcheteur").style.display = 'block';
                x_return_oneClient(val['obj_id_acheteur'], display_infoClientAcheteurFiche);

            }
        }
        display_formulaire(val, document.ficheForm);
    } else {
        console.log("Fiche inconnue.");
        //goTo(null, null, null, "Fiche inconnue.");
    }
}

// recuperation des donnees de la BAV
function setParamVal(val) {

}

function keyUpMel() {
    setStartSaisie(true);
    if (ADMIN) {
        x_return_listClientByMel(document.ficheForm.cli_emel.value, display_listVendeur);
    }
}

function keyUpNom() {
    setStartSaisie(true);
    if (ADMIN) {
        x_return_listClientByName(document.ficheForm.cli_nom.value, display_listVendeurBis);
    }
}





function affectPrix() {

    if (document.ficheForm.cli_taux_com.value == 5) {
        document.ficheForm.cli_prix_depot.value = '0.00';
    }

    getElement("depot_calc").innerHTML = document.ficheForm.cli_prix_depot.selectedOptions[0].value;

    if (!document.ficheForm.obj_prix_vente.disabled) {
        var com = Number(document.ficheForm.obj_prix_vente.value * (document.ficheForm.cli_taux_com.value / 100)).toFixed(2);
        if (com > 100) {
            com = 100;
        }
        getElement("comission_calc").innerHTML = com;
    } else {
        getElement("comission_calc").innerHTML = "****";
    }

}

/**
 * Action en submit de form si valide
 */
function submitForm() {
    if (modePage == 'create') {
        enregisterFiche();
    } else if (modePage == 'modif' && document.ficheForm.obj_etat_new.value == "") {
        modifFiche();
    }
    return false;
}

// validation de la fiche en creation
function enregisterFiche() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    var tabCli = recup_formulaire(document.ficheForm, 'cli');
    tabObj['obj_marque'] = document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).value;
    delete tabObj['obj_marque_' + idRamdom];

    if (tabObj['obj_prix_depot']) {
        tabObj['obj_prix_depot'] += " &#8364;";
    } else {
        tabObj['obj_prix_depot'] = "A renseigner le jour du dépôt au plus tard.";
    }
    if (tabCli['cli_code_postal']) {
        tabCli['cli_code_postal'] = " [" + tabCli['cli_code_postal'] + "]";
    }
    var tabData = Object.assign({}, tabObj, tabCli);
    x_get_publiHtml(tabToString(tabData), 'modal_confirm_create.html', display_messageConfirm);
    return false;
}

function display_messageConfirm(mess) {
    alertModalConfirm(mess, "Fiche");
}
/**click sur btn cofirm de modalFiche */
function confirmModalFiche() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    var tabCli = recup_formulaire(document.ficheForm, 'cli');
    tabObj['obj_marque'] = document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).value;
    delete tabObj['obj_marque_' + idRamdom];

    var tabData = Object.assign({}, tabObj, tabCli);
    x_action_createFiche(tabToString(tabData), display_fin_create);
}

function display_fin_create(val) {
    // retour sur la fiche en mode Page actuel
    setStartSaisie(false);
    if (ADMIN) {
        if (val instanceof Object) {
            goTo('fiche.php', 'modif', val['id'], val['message']);
        } else {
            alertModalInfo(val);
        }
    } else {
        goTo('fiche.php', modePage, null, "Merci. Vous allez recevoir un mail de confirmation.");
    }
}

// validation de la fiche en creation
function modifFiche() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    var tabCli = recup_formulaire(document.ficheForm, 'cli');
    tabObj['obj_marque'] = document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).value;
    delete tabObj['obj_marque_' + idRamdom];
    delete tabObj['obj_etat_new'];
    console.log(tabObj);
    var tabData = Object.assign({}, tabObj, tabCli);
    x_action_updateFiche(tabToString(tabData), display_fin_modif);
    return false;

}

function display_fin_modif(val) {
    if (val instanceof Object) {
        setStartSaisie(false);
        x_return_countByEtat(display_counter);
        x_return_oneFiche(val['obj_id'], display_fiche);
        alertModalInfoTimeout("Fiche modifié.", 0.5);
    } else {
        alertModalWarn(val);
    }
}

/**
 * Suppression d'une fiche
 */
function supprimerFiche() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    x_get_publiHtml(tabToString(tabObj), 'modal_confirm_supp.html', display_messageConfirmSupp);
    return false;
}

function display_messageConfirmSupp(mess) {
    alertModalConfirm(mess, "Supp");
}
/**click sur btn cofirm de modalFiche */
function confirmModalSupp() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    x_action_deleteFiche(tabObj['obj_id'], goTo);
}

function imprimeFiche() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    x_action_makePDF(tabObj['obj_id'], display_openPDF);
}

function imprimeEtiquette() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    x_action_makePDF(tabObj['obj_id'], 'etiquette.html', display_openPDF);
}

var gNewEtat = null;

function changeEtatFiche(newEtat = null) {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    var tabCli = recup_formulaire(document.ficheForm, 'cli');
    tabObj['obj_marque'] = document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).value;
    delete tabObj['obj_marque_' + idRamdom];

    tabObj['obj_desciption'] = nl2br(tabObj['obj_desciption']);

    if (newEtat) {
        etat = newEtat;
        gNewEtat = etat;
    } else {
        etat = tabObj['obj_etat_new'];
        gNewEtat = '';
    }

    //console.log("nw etat "+etat);
    if (etat == 'CONFIRME') {
        // => confirme
        x_action_changeEtatFiche(tabToString(tabObj), display_fin_modif);
    } else if (etat == 'STOCK') {
        // => stock
        var tabData = Object.assign({}, tabObj, tabCli);
        x_get_publiHtml(tabToString(tabData), 'modal_confirm_confirme.html', display_messageConfirmChangeEtat);
    } else if (etat == 'VENDU') {
        // vendu
        // ecran confirm avec saisie de l'acheteur
        x_get_publiHtml(tabToString(tabObj), 'modal_confirm_vendre.html', display_messageConfirmChangeEtatForm);
    } else if (etat == 'RENDU') {
        // => cloturé 
        x_get_publiHtml(tabToString(tabObj), 'modal_confirm_rendre.html', display_messageConfirmChangeEtat);
    } else if (etat == 'RESTOCK') {
        x_get_publiHtml(tabToString(tabObj), 'modal_confirm_restock.html', display_messageConfirmChangeEtat);
    } else if (etat == 'PAYE') {
        // => cloturé
        // TODO : confirm
        tabObj['commission'] = getElement("comission_calc").innerHTML;
        x_get_publiHtml(tabToString(tabObj), 'modal_confirm_paye.html', display_messageConfirmChangeEtat);
    }

    return false;
}

function display_messageConfirmChangeEtatForm(val) {
    alertModalConfirmForm(val);
}
/**click sur btn cofirm de modalEtatForm */
function confirmModalForm() {
    var tabAch = recup_formulaire(document.modalForm, 'ach');
    for (i in tabAch) {
        newKey = i.replace("ach_", "cli_");
        tabAch[newKey] = tabAch[i];
        delete tabAch[i];
    }
    var tabObjModal = recup_formulaire(document.modalForm, 'obj');

    var tabObj = recup_formulaire(document.ficheForm, 'obj');
    tabObj['obj_marque'] = document.ficheForm.elements.namedItem('obj_marque_' + idRamdom).value;
    delete tabObj['obj_marque_' + idRamdom];

    tabObj['obj_prix_vente'] = tabObjModal['obj_prix_vente'];

    var tabData = Object.assign({}, tabObj, tabAch);
    closeModal();

    x_action_vendFiche(tabToString(tabData), display_fin_modif);
}


function display_messageConfirmChangeEtat(val) {
    alertModalConfirm(val, "Etat");
}
/**click sur btn cofirm de modalEtat */
function confirmModalEtat() {
    var tabObj = recup_formulaire(document.ficheForm, 'obj');

    if (gNewEtat) {
        tabObj['obj_etat_new'] = gNewEtat;
    }

    // console.log("ok pour chg etat:"+tabObj['obj_etat_new'])
    x_action_changeEtatFiche(tabToString(tabObj), display_fin_modif);
}

// bouton ANNULER
function fermerCRUD(LaForm) {
    suite = true;
    if (startSaisie) {
        alertModalConfirm("<br/><br/><center>Vous avez des modifications en cours<center>", "Close")
    } else {
        confirmModalClose();
    }
}

// click de le bouton confirm de modalClose;
function confirmModalClose() {
    closeModal();
    goTo();
}

function display_infoClientVendeurMel(val) {
    display_infoClientVendeur(val, "emel");
}

function display_infoClientVendeurBis(val) {
    display_infoClientVendeur(val, "nom");
}

function display_infoClientVendeur(val, base) {
    console.log(val);
    if (val instanceof Object) {
        //getElement('legendVendeur').title = val['cli_id_modif']
    } else {
        // reset des champs cli
        // saug cli_emel pour ne pas le perdre
        val = [];
        val['cli_id'] = "";
        if (base == 'emel') {
            val['cli_nom'] = "";
        } else if (base == 'nom') {
            //val['cli_emel'] = "";
        } else {
            val['cli_nom'] = "";
            val['cli_emel'] = "";
        }
        val['cli_adresse'] = "";
        val['cli_adresse1'] = "";
        val['cli_code_postal'] = "";
        val['cli_ville'] = "";
        val['cli_telephone'] = "";
        val['cli_telephone_bis'] = "";
        val['cli_taux_com'] = "";
        val['cli_prix_depot'] = "";
        getElement('legendVendeur').title = "";

        x_return_tauxBAV(display_list_taux_com);
        // chargement des depot
        x_return_depotsBAV(display_list_prix_depot);
    }
    display_formulaire(val, document.ficheForm);
    affectPrix();
}

function display_infoClientAcheteurFiche(val) {
    if (val instanceof Object) {
        // remplacement du trigramme cli par ach
        for (i in val) {
            newKey = i.replace("cli_", "ach_");
            val[newKey] = val[i];
            delete val[i];
        }
    }
    display_formulaire(val, document.ficheForm);
}

function display_infoClientAcheteur(val) {
    display_infoClientAcheteur(val, "emel");
}

function display_infoClientAcheteurBis(val) {
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
        val['ach_id'] = "";
        if (base == 'emel') {
            val['ach_nom'] = "";
        }
        if (base == 'nom') {
            val['ach_emel'] = "";
        }

        val['ach_adresse'] = "";
        val['ach_adresse1'] = "";
        val['ach_code_postal'] = "";
        val['ach_ville'] = "";
        val['ach_telephone'] = "";
        val['ach_telephone_bis'] = "";
    }
    display_formulaire(val, document.modalForm);
}

function display_listAcheteur(val) {
    var list = getElement("listAcheteur");
    list.innerHTML = "";;
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}

function display_listAcheteurBis(val) {
    var list = getElement("listAcheteurBis");
    list.innerHTML = "";;
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}