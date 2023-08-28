// mode de fonctionnement de la page
// create  : creation d'une fiche CLIENT
// consult : modification par le client avec numero de fiche
// 

texteDescription = "";
test = "";

/*
 * action lors du chargement de la page
 */
function initPage() {
    // creation des listes des choix type, public et patiqye
    // x_return_enum('bav_objet', 'obj_type', display_list_type);
    // x_return_enum('bav_objet', 'obj_public', display_list_public);
    // x_return_enum('bav_objet', 'obj_pratique', display_list_pratique);

    // // recuperation de la liste des marques
    // x_return_list_marques(display_list_marques)
    // x_return_list_tailles(display_list_tailles)

    if (modePage == "createTEST") {
        BAV_ENCOURS = 1;
        CLIENT = 1;
        test = "createTEST";
    }
    
        if (!CLIENT && !ADMIN && !BAV_ENCOURS) {
        alertModalInfo("Page non accessible.");
        setTimeout(function() { goTo() }, 2000);
    }

    // if (modePage != "create") {
    //     goTo();
    // }
}



// PRE ENREGISTREMENT
// PRE ENREGISTREMENT
// PRE ENREGISTREMENT
// PRE ENREGISTREMENT
function submitFormFA(laForm) {
    try {
        // console.log(laForm);

        x_return_isClientByMel(laForm.new_email_depot.value, display_verif_mail);
        return false;
    } catch (error) {
        alertModalInfo(error);
        return false;
    }

}

function display_verif_mail(val) {
    if (val) {
        alertModalInfo("Votre e-mail est déjà identifié. Si vous ne disposez plus de code d'accès cliquer sur \"Code d'accès oublié.\".");
    } else {
        getElement('connexions').style.display = 'none';
        getElement('input_first_connexion').style.display = 'block';
        var val = [];
        val['cli_emel'] = document.firstAccesForm.new_email_depot.value;
        val['cli_nom'] = "";
        val['cli_adresse'] = "";
        val['cli_adresse1'] = "";
        val['cli_code_postal'] = "";
        val['cli_ville'] = "";
        val['cli_telephone'] = "";
        val['cli_telephone_bis'] = "";

        display_formulaire(val, document.formPreSaisie);
    }
}

function submitPreSaisie(laForm) {
    var tabCli = recup_formulaire(laForm, 'cli');
    x_action_makeClient(tabToString(tabCli), display_preEnregistrement);
    return false;
}

function display_preEnregistrement(val) {
    alertModalInfo("Votre code vous a étés envoyé par mail " + document.firstAccesForm.new_email_depot.value +  
    "<br/><i>En cas de non réception de ce mail merci de nous contacter  : bourse1000velos@avs44.com</i>");
    fermer_PreSaisie();
}

function fermer_PreSaisie() {
    getElement('connexions').style.display = 'block';
    getElement('input_first_connexion').style.display = 'none';
}




// CONNEXION
// CONNEXION
// CONNEXION
// CONNEXION

function renvoiCode(laForm) {
    if (laForm.email_depot.value == "") {
        alertModalWarn("Le e-mail doit être renseigné.");
    } else {
        x_return_isClientByMel(laForm.email_depot.value, display_verif_mail_oublie);
    }
}

function display_verif_mail_oublie(val) {
    if (val) {
        alertModalInfo("On vous envoi le code sur " + document.accesForm.email_depot.value + ".");
        x_action_redonneCode(document.accesForm.email_depot.value, fermer_PreSaisie);
    } else {
        alertModalInfo("Votre e-mail n'est pas connu.");
    }
}

function submitFormConnex(laForm) {
    try {
        x_connect_client(laForm.email_depot.value, laForm.pass_depot.value, display_connexion);
        return false;
    } catch (error) {
        alertModalInfo(error);
        return false;
    }
}

function display_connexion(val) {
    if (val instanceof Object) {
        goToPOST("clientV2.php", test, val['cli_id_modif'], "");
    } else {
        alertModalWarn("E-mail et/ou code accès incorrect.");
    }
}