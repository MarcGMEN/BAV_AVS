// mode de fonctionnement de la page
// create  : creation d'une fiche CLIENT
// modif   : modification par le client avec ID_FICHE,
// consult : modification par le client avec numero de fiche
// 

/*
 * action lors du chargement de la page
 */

function initPage() {
    if (ADMIN) {
        console.log(ADMIN);
        // chargement des taux
        x_return_tauxBAV(display_list_taux_com);
        // chargement des depot
        x_return_depotsBAV(display_list_prix_depot);

        pageSaisie();

        if (cli_id != '') {
            x_return_oneClient(cli_id, display_infoClientVendeur);
        }
    } else {
        goTo();
    }
}

/*
 * action lors du derchargement de la page
 */
function unloadPage() {

}
// que faire en cas de changement de saisie
function pageSaisie() {
    if (startSaisie) {
        document.clientForm.buttonValideFiche.disabled = false;
        document.clientForm.buttonValideFiche.title = "Valider vos modifications";
        document.clientForm.buttonResetClient.disabled = false;
    } else {
        document.clientForm.buttonValideFiche.disabled = true;
        document.clientForm.buttonValideFiche.title = "Rien de changé";
        document.clientForm.buttonResetClient.disabled = true;
    }
}

function keyUpMel() {
    x_return_listClientByMel(document.clientForm.cli_emel.value, display_listVendeur);
}

function keyUpNom() {
    x_return_listClientByName(document.clientForm.cli_nom.value, display_listVendeurBis);
}

function display_list_taux_com(val) {
    display_list_select(val, 'cli_taux_com', document.clientForm);
}

function display_list_prix_depot(val) {
    display_list_select(val, 'cli_prix_depot', document.clientForm);
}

/**
 * Action en submit de form si valide
 */
function submitForm() {
    var tabCli = recup_formulaire(document.clientForm, 'cli');
    x_action_makeClient(tabToString(tabCli), false, display_fin_client);
    return false;
}

function display_infoClientVendeurMel(val) {
    display_infoClientVendeur(val, "emel");
}

function display_infoClientVendeurBis(val) {
    display_infoClientVendeur(val, "nom");
}

function display_infoClientVendeur(val, base) {
    if (val instanceof Object) {
        getElement('legendVendeur').innerHTML = "[" + val['cli_id_modif'] + "]";
    } else {
        // reset des champs cli
        // saug cli_emel pour ne pas le perdre
        val = [];
        val['cli_id'] = "";
        if (base == 'emel') {
            val['cli_nom'] = "";
        }
        if (base == 'nom') {
            //val['cli_emel'] = "";
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
    display_formulaire(val, document.clientForm);
    display_formulaire(val, document.fileForm);
}

function display_listVendeur(val) {
    var list = getElement("listVendeur");
    list.innerHTML = "";;
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}

function display_listVendeurBis(val) {
    var list = getElement("listVendeurBis");
    list.innerHTML = "";;
    for (index in val) {
        list.appendChild(new Option(val[index], val[index]));
    }
}

function display_fin_client(val) {
    if (val instanceof Object) {
        getElement('legendVendeur').innerHTML = "[" + val['cli_id_modif'] + "]";
        display_formulaire(val, document.clientForm);
        display_formulaire(val, document.fileForm);
    } else {
        alertModalWarnTimeout(val, 2);
    }
}