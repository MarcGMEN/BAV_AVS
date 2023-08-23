/*
 * action lors du chargement de la page
 */
function initPage() {
    if (!CLIENT && !ADMIN && !BAV_ENCOURS && modePage != 'createTEST') {
        alertModalInfo("Page non accessible. "+BAV_ENCOURS+"-"+CLIENT+"-"+modePage);
        setTimeout(function () { goTo() }, 2000);
    }

    if (idClient) {
        // recherche du client
        x_return_oneClientByIdModif(idClient, display_client);
    } else {
        goTo();
    }
}

/*
 * action lors du derchargement de la page
 */
function unloadPage() { }

/**
 *  affichage des infos client
 */
function display_client(val) {
    // console.log(val);
    if (val instanceof Object) {

        // formulaire et span
        display_formulaire(val, document.clientForm);

        cli_id = val['cli_id'];

        // recherche des fiches de dépots
        var tabSel = {
            "obj_id_vendeur": val['cli_id']
        };
        x_return_fiches(tri, sens, tabToString(tabSel), display_fiches_depot);

        // recherche des fiches achats
        var tabSelA = {
            "obj_id_acheteur": val['cli_id']
        };
        x_return_fiches(tri, sens, tabToString(tabSelA), display_fiches_achat);
    } else {
        goTo(null, null, null, "Client inconnue.");
    }
}

function unloadPage() { }

// que faire en cas de changement de saisie
function pageSaisie() {
    if (startSaisie) {
        document.clientForm.buttonValideFiche.disabled = false;
    } else {
        document.clientForm.buttonValideFiche.disabled = true;
    }
}

// ***********************************************************
// ***********************************************************
// *****CLIENT
// ***********************************************************
// ***********************************************************
/**
 * Action en submit de form si valide
 */
function submitFormClient() {
    if (modePage == 'modif') {
        var tabCli = recup_formulaire(document.clientForm, 'cli');
        x_action_updateClient(tabToString(tabCli), display_fin_modif);
    }
    return false;
}

// fin de modif, on relance la page
function display_fin_modif(val) {
    setStartSaisie(false);
    if (val instanceof Object) {
        goToPOST("clientV2.php", "", val['cli_id_modif'], "");
    } else if (val) {
        alertModalWarnTimeout(val, 2);
    }
}

/**
 * lors de la sortie du champ mel, on recherche si le mel existe
 * s'il existe avec un autre id, on le marque...
 */
function display_infoClientVendeur(val) {
    // console.log(val);
    if (val && val['cli_id'] != document.clientForm.cli_id.value) {
        alertModalWarn("Mel deja connu pour :" + val['cli_nom']);
        x_return_oneClient(document.clientForm.cli_id.value, display_client);
    } else { }
}

/**
 * retour verification, si id !=, message erreur et recharge de la fiche d'origine
 * @param  val 
 */
function display_infoClientVendeurName(val) {
    // console.log("display_infoClientVendeurName ");
    // console.log(val);
    if (val['cli_id'] && val['cli_id'] != document.clientForm.cli_id.value) {
        alertModalWarn("Nom deja connu [" + val['cli_id_modif'] + "].");
        x_return_oneClient(document.clientForm.cli_id.value, display_client);
    } else { }
}

// ***********************************************************
// ***********************************************************
// *****FiCHES
// ***********************************************************
// ***********************************************************
var tri = "obj_numero";
var sens = "asc";
var selection = "*";
var tabSel = new Array();

// affichage des fiche de depot
function display_fiches_depot(val) {

    var total = display_fiches(val, 'fiches');

    if (total > 0) {
        getElement('aideImpression').style.display = 'block';
    }

    if (sens == "asc") {
        classSort = "sortUp";
    } else {
        classSort = "sortDown";
    }
    var triS = tri.replace("obj_", "tri_");
    getElement(triS).className = classSort;
}

// affichage de fiche achats
function display_fiches_achat(val) {
    display_fiches(val, 'fichesA');
}

// affichage tableau
function display_fiches(val, idElement) {
    // console.log(val);
    var total = 0;
    var repr = "<table width='100%' spacing=0>";
    for (index in val) {
        if (!isNaN(index)) {
            if (val[index]['obj_numero'] < 5000) {
                repr += "<tr class='tabl0' >";
                repr += "<td width=7% align=center>";
                repr += val[index]['obj_numero'];
                repr += "</td>";
                repr += "<td class='maskmobile' width=10%>";
                repr += val[index]['obj_type'];
                repr += "</td>";
                repr += "<td class='maskmobile' width=10% >";
                repr += val[index]['obj_public'];
                repr += "</td>";
                repr += "<td width=30% >";
                repr += val[index]['obj_marque'] + " " + val[index]['obj_modele'];
                repr += "</td>";
                repr += "<td class='maskmobile'  width=10% >";
                repr += val[index]['obj_couleur'];
                repr += "</td>";
                repr += "<td width=10% >";
                if (val[index]['obj_prix_vente'] == 0) {
                    repr += "<span style='color:orange'>" + val[index]['obj_prix_depot'] + "</span>";
                } else {
                    repr += val[index]['obj_prix_vente'];
                }
                repr += "</td>";
                repr += "<td width=15% >";
                if (idElement == "fiches") {
                    switch (val[index]['obj_etat']) {
                        case "CONFIRME":
                            repr += "A déposer";
                            break;
                        case "STOCK":
                            repr += "Non vendu";
                            break;
                        case "VENDU":
                            repr += "Vendu";
                            break;
                        case "RENDU":
                            repr += "Restitué";
                            break;
                        case "PAYE":
                            repr += "Vendu et argent remis";
                            break;
                    }
                } else {

                }
                repr += "</td>";
                repr += "<td width=8% style='text-align:center' >";
                if (val[index]['obj_etat'] == 'CONFIRME' && idElement == "fiches") {
                    repr += "<span title='Modifier'  onclick='modifierFiche(" + val[index]['obj_id'] + "," + val[index]['obj_numero'] + ")' class='link' style='font-size:1.5em'>&nbsp;<i class='link fas fa-edit'></i></span > ";
                    repr += "<span title='Supprimer' onclick='supprimerFiche(" + val[index]['obj_id'] + "," + val[index]['obj_numero'] + ")' class='link' style='font-size:1.5em'>&nbsp;❌</span>";
                    repr += "<span title='Imprimer' onclick='imprimeFiche(" + val[index]['obj_id'] + "," + val[index]['obj_numero'] + ")' class='link' style='font-size:1.5em'>&nbsp;📇</span>";
                }
                repr += "</td>";
                repr += "</tr>";
                total = total + 1;
            }
        }
    }
    repr += "</table>";
    getElement(idElement).innerHTML = repr;
    return total;
}

/** impression de la fiche */
function imprimeFiche(id, numero) {

    alertModalInfo("Génération de la fiche " + numero + " au format PDF  <b>pour l'imprimer</b> <img src='Images/spinner_white_tiny.gif' />.");
    x_action_makePDF(id, display_openPDF);
}

/**
 * tri des colonnes */

function triColonne(col) {
    if (col == tri) {
        if (sens == "asc") {
            sens = "desc";
        } else {
            sens = "asc";
        }
    } else {
        sens = "asc";
    }

    var triS = col.replace("obj_", "tri_");
    getElement(triS).className = "sortable";
    tri = col

    var tabSel = {
        "obj_id_vendeur": document.clientForm.cli_id.value
    };

    //console.log("appel fiches vente", tabSel);
    x_return_fiches(tri, sens, tabToString(tabSel), display_fiches_depot);

    var tabSelA = {
        "obj_id_acheteur": document.clientForm.cli_id.value
    };
    //console.log("appel fiches achat ", tabSelA);
    x_return_fiches(tri, sens, tabToString(tabSelA), display_fiches_achat);


}

/**
 * Ajout d'un depot
 * @param  cli_id_mod 
 */
function addDepot(cli_id_mod) {
    var tabData = {
        "cli_id_modif": cli_id_mod,
        'obj_numero': ""
    };
    x_get_publiHtml(tabToString(tabData), 'modal_create_fiche.html', display_messageConfirm);
}

function supprimerFiche(id, numero) {
    var tabObj = []
    tabObj['obj_id'] = id;
    tabObj['obj_numero'] = numero;

    // creation du message de confirmation de la suppression
    x_get_publiHtml(tabToString(Object.assign({}, tabObj)), 'modal_confirm_supp.html', display_messageConfirmSupp);
    return false;
}
/**
 * affchage du modal de suppression avec attente de confirmation
 * la confirmation est géré par ConfirmModal option Supp
 * @param  mess 
 */
function display_messageConfirmSupp(mess) {
    alertModalConfirm(mess, 'Supp', "Suppression du depot");
}

function modifierFiche(id, numero) {
    var tabObj = []
    tabObj['obj_id'] = id;
    tabObj['obj_numero'] = numero;
    x_get_publiHtml(tabToString(Object.assign({}, tabObj)), 'modal_create_fiche.html', display_messageConfirmModif);
    setTimeout('x_return_oneFiche(' + id + ', modalModifFiche)', 200);
}

function modalModifFiche(val) {
    // creation du message de confirmation de la suppression
    display_formulaire(val, document.modalForm);
    return false;
}

/**
 * affchage du modal de suppression avec attente de confirmation
 * la confirmation est géré par ConfirmModal option Supp
 * @param  mess 
 */
function display_messageConfirmModif(mess) {
    alertModalConfirm(mess, 'Modif', "Modification du depot");
}

// confimr ajout
function display_messageConfirm(mess) {
    alertModalConfirm(mess, 'Fiche', "Votre depot.");
}

/**click sur btn cofirm de modalFiche */
function confirmModal(plus) {
    if (plus == "Fiche") {
        var tabObj = recup_formulaire(document.modalForm, 'obj');
        // tabObj['obj_marque'] = document.modalForm.elements.namedItem('obj_marque_' + idRamdom).value;
        // delete tabObj['obj_marque_' + idRamdom];
        var tabCli = [];
        tabCli['cli_id'] = document.clientForm.cli_id.value;
        var tabData = Object.assign({}, tabObj, tabCli);
        x_action_createFiche(tabToString(tabData), display_fin_create);
    } else if (plus == "Supp") {
        var tabObj = recup_formulaire(document.modalForm, 'obj');
        x_action_deleteFiche(tabObj['obj_id'], display_fin_create);
    } else if (plus == "Modif") {
        var tabObj = recup_formulaire(document.modalForm, 'obj');
        var tabData = Object.assign({}, tabObj);
        x_action_updateFiche(tabToString(tabData), display_fin_create);
    }
}

function display_fin_create(val) {
    if (val == 1 || val instanceof Object) {
        if (val instanceof Object) {
            if (val['modif_fiche'] == 1) {
                imprimeFiche(val['obj_id'], val['obj_numero']);
            }
        }
        var tabSel = {
            "obj_id_vendeur": document.clientForm.cli_id.value
        };
        x_return_fiches(tri, sens, tabToString(tabSel), display_fiches_depot);
    } else {
        alertModalError(val);
    }
}
/** MODAL */
/** MODAL */
/** MODAL */
function initModal(plus) {
    if (plus == "Fiche" || plus == "Modif") {
        // creation des listes des choix type, public et patiqye
        x_return_enum('bav_objet', 'obj_type', display_list_type);
        x_return_enum('bav_objet', 'obj_public', display_list_public);
        x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

        // recuperation de la liste des marques
        x_return_list_marques(display_list_marques);
        x_return_list_tailles(display_list_tailles);
    }
}

function display_list_type(val) {
    display_list_select(val, 'obj_type', document.modalForm);
}
/*
 * affichage de la liste de pratique possible
 */
function display_list_pratique(val) {
    display_list_select(val, 'obj_pratique', document.modalForm);
}
/*
 * affichage de la liste de public possible
 */
function display_list_public(val) {
    display_list_select(val, 'obj_public', document.modalForm);
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
    var list = getElement("listModeles");
    list.innerHTML = "";
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}