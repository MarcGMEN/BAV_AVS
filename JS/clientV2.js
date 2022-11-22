/*
 * action lors du chargement de la page
 */
function initPage() {
    if (idClient) {
        // recherche du client
        x_return_oneClientByIdModif(idClient, display_client);
    } else {
        goTo();
    }
}

function display_parametres(val) {
    var select = getElement("annee_stat");
    select.options[select.options.length] = new Option("Choix", "*");
    for (index in val) {
        select.options[select.options.length] = new Option(val[index]['obj_numero_bav'], val[index]['obj_numero_bav']);
        if (anneeBav == index) {
            select.options[select.options.length - 1].selected = true;
        }
    }
}

// que faire en cas de changement de saisie
function pageSaisie() {
    if (startSaisie) {
        document.clientForm.buttonValideFiche.disabled = false;
    } else {
        document.clientForm.buttonValideFiche.disabled = true;
    }
}


/*
 * action lors du derchargement de la page
 */
function unloadPage() {}
/**
 * 
 */
function display_client(val) {
    // console.log(val);
    if (val instanceof Object) {

        display_formulaire(val, document.clientForm);

        cli_id = val['cli_id'];

        var tabSel = {
            "obj_id_vendeur": val['cli_id']
        };
        x_return_fiches(tri, sens, tabToString(tabSel), display_fiches_depot);

        var tabSelA = {
            "obj_id_acheteur": val['cli_id']
        };
        x_return_fiches(tri, sens, tabToString(tabSelA), display_fiches_achat);

        adress = "";
        virgule = "";
        if (val['cli_adresse'] != "") {
            adress += val['cli_adresse'];
            virgule = ", ";
        }
        if (val['cli_adresse1'] != "") {
            adress += virgule + val['cli_adresse1'];
            virgule = ", ";
        }
        if (val['cli_code_postal'] != "") {
            adress += virgule + val['cli_code_postal'];
            virgule = ", ";
        }
        if (val['cli_ville'] != "") {
            adress += virgule + val['cli_ville'];
            virgule = ", ";
        }
    } else {
        goTo(null, null, null, "Client inconnue.");
    }
}

function unloadPage() {}

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
    } else {}
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
    } else {}
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

function display_fiches_depot(val) {

    var total = display_fiches(val, 'fiches');

    if (sens == "asc") {
        classSort = "sortUp";
    } else {
        classSort = "sortDown";
    }
    var triS = tri.replace("obj_", "tri_");
    getElement(triS).className = classSort;
}

function display_fiches_achat(val) {
    display_fiches(val, 'fichesA');
}

function display_fiches(val, idElement) {

    // console.log(val);
    var total = 0;
    var repr = "<table width='100%'>";
    for (index in val) {
        if (!isNaN(index)) {
            if (val[index]['obj_numero'] < 5000) {
                repr += "<tr class='tabl0' >";
                repr += "<td width=10% align=center>";
                repr += val[index]['obj_numero'];
                repr += "</td>";
                repr += "<td class='maskmobile' width=20%>";
                repr += val[index]['obj_type'];
                repr += "</td>";
                repr += "<td class='maskmobile' width=20% >";
                repr += val[index]['obj_public'];
                repr += "</td>";
                repr += "<td width=10% >";
                repr += val[index]['obj_marque'];
                repr += "</td>";
                repr += "<td width=10% >";
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
                switch (val[index]['obj_etat']) {
                    case "CONFIRME":
                        repr += "En attente de dépôt";
                        break;
                    case "STOCK":
                        repr += "Présent sur le parc";
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
                repr += "</td>";
                repr += "<td width=5% style='text-align:center' >";
                if (val[index]['obj_etat'] == 'CONFIRME' && idElement == "fiches") {
                    repr += "<span title='Modifier'  onclick='modifierFiche(" + val[index]['obj_id'] + "," + val[index]['obj_numero'] + ")' class='link'>✏</span>";
                    repr += "<span title='Supprimer' onclick='supprimerFiche(" + val[index]['obj_id'] + "," + val[index]['obj_numero'] + ")' class='link'>❌</span>";
                    repr += "<span title='Imprimer' onclick='imprimeFiche(" + val[index]['obj_id'] + "," + val[index]['obj_numero'] + ")' class='link'> 📇</span>";
                }
                repr += "</td>";
                repr += "</tr>";
            }
            total = total + 1;
        }
    }
    repr += "</table>";
    // console.log(idElement);
    getElement(idElement).innerHTML = repr;

    // getElement('total' + idElement).innerHTML = total;

    // console.log('total'+idElement);
    return total;
}

function imprimeFiche(id, numero) {

    alertModalInfo("Génération de la fiche " + numero + " au format PDF <img src='Images/spinner_white_tiny.gif' />");
    x_action_makePDF(id, display_openPDF);
}

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
    } else if (plus == "Close") {
        closeModal();
        goTo();
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
    if (val == 1 || val == "" || val instanceof Object) {
        var tabSel = {
            "obj_id_vendeur": document.clientForm.cli_id.value
        };
        x_return_fiches(tri, sens, tabToString(tabSel), display_fiches_depot);
    } else {
        alertModalError(val);
    }
}

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
    console.log(val);
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
    list.innerHTML = "";
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}