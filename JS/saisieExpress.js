focus = true;

var baseNumFiche = 1;

function initPage() {
    if (theId != "") {
        x_return_oneFiche(theId, display_ficheN);
    }
    x_return_num_max_fiches(display_num_max_fiches);

    // creation des listes des choix type
    x_return_enum('bav_objet', 'obj_type', display_list_type);

    // chargement de la liste des client par mel
    // x_return_listClientByMel(display_listVendeur);

    // chargement de la liste des client par mel
    x_return_listClientByName(display_listVendeurName);

    // recuperation de la liste des marques
    x_return_list_marques(display_list_marques)

    document.searchFormFiche.numeroFiche.focus();
    getElement("divscroll").style.height = (document.body.offsetHeight - getElement("divscroll").offsetTop + 30);

}

var maxFiche = 0;
var classeur = 50;

function display_num_max_fiches(val) {
    maxFiche = val;
    getElement("pageFiche").innerHTML = "Navigation dans les classeurs [" + val + "]&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;";
    for (var i = 1; i < val; i += classeur) {
        getElement("pageFiche").innerHTML += "<span class='link' id='cla_" + i + "' onclick='baseNumFiche=" + i + ";x_return_fiches_express(" + i + ", display_fichesExpress)'>" + i + "</span>&nbsp;&nbsp;"
    }
    x_return_fiches_express(baseNumFiche, display_fichesExpress);
}

function searchFicheExpress(num) {

    if (num > maxFiche) {
        x_return_num_max_fiches(display_num_max_fiches);
    }
    if (num) {
        baseNumFiche = parseInt((parseInt((parseInt(num) - 1) / parseInt(classeur))) * parseInt(classeur) + 1);
        // console.log("On est sur la base de " + baseNumFiche + "  via " + num + " pour max " + classeur);
        x_return_fiches_express(baseNumFiche, display_fichesExpress);
        setTimeout('x_return_oneFicheByCode(' + num + ', display_ficheN)', 100);

    }
}

function display_list_marques(val) {
    var list = getElement("listMarques");
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}
/*
 * affichage de la liste de type possible
 */
function display_list_type(val) {
    display_list_select(val, 'obj_type', document.formSaisieExpress);
}
/***
 * liste des vendeurs
 */
function display_listVendeur(val) {
    var list = getElement("listVendeur");
    list.innerHTML = "";
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

/**
 * Affichage de toutes les fiches dans la bonne ligne
 * @param  val 
 */
function display_fichesExpress(val) {
    //console.log(val);

    for (var num = baseNumFiche; num <= (parseInt(classeur) + parseInt(baseNumFiche)); num++) {
        //console.log(num, baseNumFiche, (parseInt(maxFiche) + parseInt(baseNumFiche)));
        if (val[num]) {
            afficheLigne(val[num]);
        } else {
            resetLigne(num - baseNumFiche + 1);
        }
    }
    for (var i = 1; i < maxFiche; i += classeur) {
        getElement("cla_" + i).className = 'link';
    }
    getElement("cla_" + baseNumFiche).className = 'navigation navigationSel';
}
/**
 * affichage d'un ligne
 * @param  val 
 */
function afficheLigne(val) {
    // on dispose de ligne de 1 a maxFiche (50);
    // donc le 1 = numero fiche  -  base
    var index = parseInt(val['obj_numero']) - baseNumFiche + 1;
    if (getElement("numero_" + index)) {
        getElement("tr_" + index).style = "";
        getElement("numero_" + index).innerHTML = val['obj_numero'];
        getElement("type_" + index).innerHTML = val['obj_type'];

        getElement("vendeur_" + index).innerHTML = "<span class='link' onclick='goTo(\"client.php\",\"consult\"," + val['cli_id'] + ")'>" + val['vendeur_nom'] + "</span>";
        if (val['cli_emel']) {
            getElement("vendeur_" + index).innerHTML += " [" + val['cli_emel'] + "]";
        }
        if (val['acheteur_nom']) {
            getElement("vendeur_" + index).innerHTML += " => Vendu à " + val['acheteur_nom'];
        }
        getElement("etat_" + index).innerHTML = val['obj_etat'];

        getElement("zoom_" + index).innerHTML = "<i class='link fas fa-search' onclick='goTo(\"ficheAdmin.php\",\"modif\"," + val['obj_id'] + ")'></i>";
        getElement("numero_" + index).className += " link";

        getElement("tr_" + index).className = "tabl0 " + val['obj_etat'];

        getElement("prix_vente_" + index).innerHTML = val['obj_prix_vente'];

        getElement("action_" + index).innerHTML = "";
        // creation du bouton adapté
        // pour le retour, saisir la fiche

        var action = "<span title='Imprimer' onclick='imprimeFiche(" + val['obj_id'] + "," + val['obj_numero'] + ")' class='link'>📇</span>";
        var new_etat = "";
        getElement("action_" + index).className = "";

        if (val['obj_etat'] == "CONFIRME") {
            new_etat = "STOCK";
            new_libelle = "Stocker";
            var thePrix = val['obj_prix_depot'];
            var actionPrix = "<input type='number' name='obj_prix_vente_" + index + "' min=1 step='0.1' value='" + thePrix + "' />";
            getElement("prix_vente_" + index).innerHTML = actionPrix;

            action += "<span title='Supprimer' onclick='supprimerFiche(" + val['obj_id'] + "," + val['obj_numero'] + ")' class='link' >❌</span>";
            action += "<input type='button' value='" + new_libelle + "' onclick='changeEtatLigne(" + val['obj_id'] + ",\"" + val['obj_etat'] + "\",\"" + new_etat + "\",document.formTabSaisie.obj_prix_vente_" + index + ".value," + val['obj_numero'] + ")' />";
        } else if (val['obj_etat'] == "STOCK") {
            new_etat = "RENDU";
            new_libelle = "Rendre";
            action += "<input type='button' value='" + new_libelle + "' onclick='changeEtatLigne(" + val['obj_id'] + ",\"" + val['obj_etat'] + "\",\"" + new_etat + "\"," + val['obj_prix_vente'] + "," + val['obj_numero'] + ")' />";
            new_etat = "VENDU";
            new_libelle = "Vendre";
            action += "<input type='button' value='" + new_libelle + "' onclick='changeEtatLigne(" + val['obj_id'] + ",\"" + val['obj_etat'] + "\",\"" + new_etat + "\"," + val['obj_prix_vente'] + "," + val['obj_numero'] + ")' />";

        } else if (val['obj_etat'] == "VENDU") {
            new_etat = "PAYE";
            new_libelle = "Payer";
            action += "<input type='button' value='" + new_libelle + "' onclick='changeEtatLigne(" + val['obj_id'] + ",\"" + val['obj_etat'] + "\",\"" + new_etat + "\"," + val['obj_prix_vente'] + "," + val['obj_numero'] + ")' />";

        }
        getElement("action_" + index).innerHTML = action;

    } else {
        // console.log("pas d'element [numero_" + index + "]");
    }

}

function supprimerFiche(id, numero) {
    var tabObj = []
    tabObj['obj_id'] = id;
    tabObj['obj_numero'] = numero;

    // creation du message de confirmation de la suppression
    x_get_publiHtml(tabToString(Object.assign({}, tabObj)), 'modal_confirm_supp.html', display_messageConfirmSupp);
    return false;
}

function display_messageConfirmSupp(mess) {
    alertModalConfirm(mess, 'Supp', "Suppression du depot");
}

/** impression de la fiche */
function imprimeFiche(id, numero) {

    alertModalInfo("Génération de la fiche " + numero + " au format PDF <img src='Images/spinner_white_tiny.gif' />");
    x_action_makePDF(id, display_openPDF);
}

function resetLigne(index) {
    // on dispose de ligne de 1 a maxFiche (50);
    // donc le 1 = numero fiche  -  base
    if (getElement("numero_" + index)) {
        getElement("tr_" + index).style = "";
        getElement("tr_" + index).className = "tabl0 "
        getElement("numero_" + index).innerHTML = parseInt(index) + parseInt(baseNumFiche) - 1;
        getElement("type_" + index).innerHTML = "";
        getElement("vendeur_" + index).innerHTML = "";
        getElement("etat_" + index).innerHTML = "";
        getElement("zoom_" + index).innerHTML = "";
        getElement("prix_vente_" + index).innerHTML = "";
        getElement("action_" + index).innerHTML = "";
    }
}

function display_ficheN(val) {
    if (val['obj_numero']) {
        var index = val['obj_numero'] - baseNumFiche + 1;
        if (getElement("tr_" + index)) {
            getElement("tr_" + index).scrollIntoViewIfNeeded(true);
            display_fiche(val);
            // getElement("tr_" + index).style = "background-color:GREY";
        } else {
            alertModalWarn("Numéro plus grand que le max de fiche prévu [" + maxFiche + "]");
        }
    }
}

function display_fiche(val) {
    getElement("but_action").disabled = false;

    // on revient sur le numero de fiche en focus
    document.searchFormFiche.numeroFiche.value = "";
    //console.log("#tr_"+val['obj_numero']);
    //getElement("tableFiches").location="#tr_"+val['obj_numero'];
    //console.log(window.find("#tr_"+val['obj_numero']));

    getElement("but_actionAno").style.display = 'none';
    getElement("but_action2").style.display = 'none';
    getElement("but_action").style.display = 'table-cell';

    if (val['obj_etat']) {
        afficheLigne(val);

        document.formSaisieExpress.obj_type.disabled = true;
        document.formSaisieExpress.obj_prix_vente.disabled = true;
        document.formSaisieExpress.obj_couleur.disabled = true;
        document.formSaisieExpress.elements.namedItem('obj_marque_' + idRamdom).disabled = true;
        //document.formSaisieExpress.cli_emel.disabled = true;
        document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).disabled = true;
        document.formSaisieExpress.cli_code_postal.disabled = true;

        if (focus == 1) {
            getElement("but_action").focus();
        }
        focus = true;
        if (val['obj_etat'] == "INIT") {
            getElement("but_action").innerHTML = "Confirmer";
            val['obj_etat_new'] = "CONFIRME";
        } else if (val['obj_etat'] == "CONFIRME") {
            getElement("but_action").innerHTML = "Mettre en stock";
            val['obj_etat_new'] = "STOCK";

            document.formSaisieExpress.obj_prix_vente.disabled = false;
            document.formSaisieExpress.obj_prix_vente.focus();
            val['obj_prix_vente'] = val['obj_prix_depot'];
        } else if (val['obj_etat'] == "STOCK") {
            getElement("but_action").innerHTML = "Vendre";

            getElement("but_action2").style.display = 'table-cell';
            getElement("but_action2").innerHTML = "Rendre";
            getElement("but_actionAno").style.display = 'table-cell';
            getElement("but_actionAno").innerHTML = "De-stocker";

            val['obj_etat_new'] = "VENDU";
            val['obj_etat_new2'] = "RENDU";
            val['obj_etat_newAno'] = "DESTOCK";
        } else if (val['obj_etat'] == "VENDU") {
            getElement("but_action").innerHTML = "Payer";
            getElement("but_actionAno").style.display = 'table-cell';
            getElement("but_actionAno").innerHTML = "De-vendre";
            val['obj_etat_new'] = "PAYE";
            val['obj_etat_newAno'] = "DEVENDRE";

        } else if (val['obj_etat'] == "PAYE") {
            getElement("but_action").disabled = true;
            getElement("but_action").innerHTML = "Clos";
            document.searchFormFiche.numeroFiche.focus();

            getElement("but_actionAno").style.display = 'table-cell';
            getElement("but_actionAno").innerHTML = "De-payer";
            val['obj_etat_newAno'] = "DEPAYER";

            val['obj_etat_new'] = "";
        } else if (val['obj_etat'] == "RENDU") {
            getElement("but_action").disabled = true;
            getElement("but_action").innerHTML = "Clos";
            document.searchFormFiche.numeroFiche.focus();

            getElement("but_actionAno").style.display = 'table-cell';
            getElement("but_actionAno").innerHTML = "Remettre en stock";
            val['obj_etat_newAno'] = "DERENDRE";

            val['obj_etat_new'] = "";
        }
        val['obj_marque_' + idRamdom] = val['obj_marque'];

        display_formulaire(val, document.formSaisieExpress);

        x_return_oneClient(val['obj_id_vendeur'], display_infoClientVendeur);
    } else {
        val['obj_type'] = "Autre";
        val['obj_prix_vente'] = "";
        val['obj_etat_new'] = "STOCK";
        val['obj_etat'] = "INIT";
        val['obj_id'] = "";
        val['obj_couleur'] = "";

        document.formSaisieExpress.cli_id.value = "";
        document.formSaisieExpress.cli_code_postal = "";
        document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).value = "";

        display_formulaire(val, document.formSaisieExpress);

        document.formSaisieExpress.obj_type.disabled = false;
        document.formSaisieExpress.obj_type.focus();
        document.formSaisieExpress.obj_prix_vente.disabled = false;
        document.formSaisieExpress.obj_couleur.disabled = false;
        document.formSaisieExpress.elements.namedItem('obj_marque_' + idRamdom).disabled = false;
        document.formSaisieExpress.elements.namedItem('obj_marque_' + idRamdom).value = "";

        //document.formSaisieExpress.cli_emel.disabled = false;
        document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).disabled = false;
        document.formSaisieExpress.cli_code_postal.disabled = false;
        getElement("but_actionAno").style.display = 'none';
        getElement("but_action2").style.display = 'none';
        getElement("but_action").style.display = 'block';
        getElement("but_action").innerHTML = "Créer";
    }
}

/**
 * recherche par nim si pas encore trouve
 * @param {} value 
 */
function searchByName(value) {
    // console.log("searchByName " + value);
    if (value != "") {
        x_return_oneClientByName(value, display_infoClientVendeurName);
    }
}

/**
 * recherche par mail
 * @param {} value 
 */
function searchByMel(value) {
    if (value != "") {
        x_return_oneClientByMel(value, display_infoClientVendeurMel);

        // si le trouve ou pas on interdit la recherche par nom
        var list = getElement("listVendeurName");
        list.innerHTML = "";
    } else {
        // chargement de la liste des client par nom
        x_return_listClientByName(display_listVendeurName);
    }
}

function display_infoClientVendeurMel(val) {
    display_infoClientVendeur(val, "emel");
}

function display_infoClientVendeurName(val) {
    display_infoClientVendeur(val, "nom");
}

function display_infoClientVendeur(val, base) {
    //console.log(val);
    if (val instanceof Object) {
        val['cli_nom_' + idRamdom] = val['cli_nom'];
        // si mel on force la liste des vendeur Name a vide
        // if (val['cli_emel'] != "") {
        //     var list = getElement("listVendeurName");
        //     list.innerHTML = "";
        // } else {
        // chargement de la liste des client par mel
        //x_return_listClientByName(display_listVendeurName);
        // }
        display_formulaire(val, document.formSaisieExpress);
        document.formSaisieExpress.cli_code_postal.disabled = true;
    } else {
        // reset des champs cli
        // saug cli_emel pour ne pas le perdre
        val = [];
        val['cli_id'] = "";
        if (base == 'emel') {
            val['cli_nom'] = "";
            val['cli_nom_' + idRamdom] = "";
        } else if (base == 'nom') {
            //val['cli_emel'] = "";
        } else {
            val['cli_nom_' + idRamdom] = "";
            // val['cli_emel'] = "";
        }
        val['cli_code_postal'] = "";

        // nouveau client

        display_formulaire(val, document.formSaisieExpress);
    }
}



function submitForm() {
    // console.log("submit form");
    var tabObj = recup_formulaire(document.formSaisieExpress, 'obj');
    var tabCli = recup_formulaire(document.formSaisieExpress, 'cli');
    tabCli['cli_nom'] = document.formSaisieExpress.elements.namedItem('cli_nom_' + idRamdom).value;
    delete tabCli['cli_nom_' + idRamdom];

    if (tabCli['cli_nom'] == "") {
        alert("Nom Obligatoire");
    }

    // console.log(tabObj);

    // console.log("etat =>" + document.formSaisieExpress.action.value + " " + tabObj['obj_etat_' + document.formSaisieExpress.action.value]);

    tabObj['obj_etat_new'] = tabObj['obj_etat_' + document.formSaisieExpress.action.value];
    tabObj['obj_marque'] = tabObj['obj_marque_' + idRamdom];
    delete tabObj['obj_marque_' + idRamdom];
    delete tabObj['obj_etat_new2'];
    delete tabObj['obj_etat_newAno'];
    // console.log(tabObj);

    modifEtat(tabObj, tabCli);

    return false;
}

function changeEtatLigne(id, etat, etat_new, prix_vente, numero) {
    var tabObj = {};
    tabObj['obj_numero'] = numero;
    tabObj['obj_etat'] = etat;
    tabObj['obj_etat_new'] = etat_new;
    tabObj['obj_id'] = id;
    tabObj['obj_prix_vente'] = prix_vente;

    if (prix_vente == 0) {
        alertModalWarn("Le prix doit être supérieur a zéro..");
    } else {
        modifEtat(tabObj, {});
    }


}

function modifEtat(tabObj, tabCli) {

    if (tabObj['obj_etat'] == 'INIT' && tabObj['obj_etat_new'] == "STOCK") {
        tabObj['obj_etat'] = 'STOCK'
        var tabData = Object.assign({}, tabObj, tabCli);
        // console.log("demande de creation express");
        tabData['obj_modif_stock'] = 1
        x_action_createFicheExpress(tabToString(tabData), display_fin_create);
    } else if (tabObj['obj_etat_new'] == 'VENDU') {
        x_return_oneFiche(tabObj['obj_id'], display_fiche_vente);
    } else if (tabObj['obj_etat'] != '') {
        // avec un etat confirme, on bascule le prix de vente en prix depot pour l'update
        if (tabObj['obj_etat'] == 'CONFIRME') {
            tabObj['obj_prix_depot'] = tabObj['obj_prix_vente']
        }
        // console.log("avec change etat fiche");
        //console.log(tabObj);
        x_action_changeEtatFiche(tabToString(tabObj), display_fin_create);
    } else {

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

/**click sur btn cofirm de modalEtatForm */
function confirmModal(plus) {
    if (plus == "Supp") {
        var tabObj = recup_formulaire(document.modalForm, 'obj');
        x_action_deleteFiche(tabObj['obj_id'], display_fin_delete);
    } else {
        var tabAch = recup_formulaire(document.modalForm, 'ach');
        tabAch['ach_nom'] = document.modalForm.elements.namedItem('ach_nom_' + idRamdom).value;
        delete tabAch['ach_nom_' + idRamdom];
        for (i in tabAch) {
            newKey = i.replace("ach_", "cli_");
            tabAch[newKey] = tabAch[i];
            delete tabAch[i];
        }
        var tabObjModal = recup_formulaire(document.modalForm, 'obj');
        //var tabObj = recup_formulaire(document.formSaisieExpress, 'obj');

        // tabObj['obj_prix_vente'] = tabObjModal['obj_prix_vente'];
        tabObjModal['obj_etat_new'] = "VENDU";
        tabObjModal['obj_etat'] = "STOCK";
        var tabData = Object.assign({}, tabObjModal, tabAch);
        //console.log(tabData);
        getElement("but_action").innerHTML = 'Mise en vente <img src="Images/refresh_icon_active.gif" height=10px />';
        getElement("but_action").disabled = true;
        getElement("but_actionAno").style.display = 'none';
        getElement("but_action2").style.display = 'none';

        x_action_vendFiche(tabToString(tabData), display_fin_vente);
    }
}

function display_fin_vente(val) {
    display_fin_create(val);
}

function display_fin_delete(val) {
    x_return_fiches_express(baseNumFiche, display_fichesExpress);
}


function display_fin_create(val) {
    if (val instanceof Object) {
        // if (document.formSaisieExpress.cli_id.value != '') {
        //     x_return_oneClient(document.formSaisieExpress.cli_id.value, display_infoClientVendeur);
        // }
        getElement("but_action2").style.display = 'none';
        getElement("but_action").style.display = 'none';
        getElement("but_action").innerHTML = "";
        // recharge de la fiche dans le bloc de saisie
        focus = false;
        searchFicheExpress(val['obj_numero']);

        // on revient sur le numero de fiche en focus
        document.searchFormFiche.numeroFiche.focus();

    } else {
        alertModalWarn(val);
    }
}

function unloadPage() {}


/**
 * recherche par nim si pas encore trouve
 * @param {} value 
 */
function searchAchByName(value) {
    // console.log("searchAchByName " + value);
    if (value != "") {
        x_return_oneClientByName(value, display_infoClientAcheteurBis);
    }
}

/**
 * recherche par mail
 * @param {} value 
 */
function searchAchByMel(value) {
    if (value != "") {
        x_return_oneClientByMel(value, display_infoClientAcheteur);

        // si le trouve ou pas on interdit la recherche par nom
        var list = getElement("listAcheteurBis");
        list.innerHTML = "";
    } else {
        // chargement de la liste des client par nom
        x_return_listClientByName(display_listAcheteurBis);
    }
}


function display_infoClientAcheteur(val) {
    display_infoClientAcheteur(val, "emel");
}

function display_infoClientAcheteurBis(val) {
    display_infoClientAcheteur(val, "nom");
}

function display_infoClientAcheteur(val, base) {
    // console.log(val);
    if (val instanceof Object) {
        // remplacement du trigramme cli par ach
        for (i in val) {
            newKey = i.replace("cli_", "ach_");
            val[newKey] = val[i];
            delete val[i];
        }

        // si mel on force la liste des vendeur Name a vide
        if (val['ach_emel'] != "") {
            var list = getElement("listAcheteurBis");
            list.innerHTML = "";
        } else {
            // chargement de la liste des client par mel
            x_return_listClientByName(display_listAcheteurBis);
        }
        display_formulaire(val, document.modalForm);
    } else {
        // reset des champs cli
        val = [];
        val['ach_id'] = "";
        if (base == 'emel') {
            val['ach_nom'] = "";
        }
        if (base == 'nom') {
            //val['ach_emel'] = "";
        }
        val['ach_code_postal'] = "";
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
    list.innerHTML = "";
    for (index in val) {
        list.appendChild(new Option(val[index]['cli_emel'] + " - " + val[index]['cli_code_postal'], val[index]['cli_nom']));
    }
}