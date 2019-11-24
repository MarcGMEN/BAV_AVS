// initialitation de la page s
function initPage() {
    if (ADMIN) {
        x_return_allParametre(display_parametres);
        getElement("par_numero_bav").focus();
        modePage = "select";
    } else {
        goTo();
    }
}

// action a faire lorsque la page est en mode saisie
function pageSaisie() {

}

/**
 * display des parametres au format table
 */
function display_parametres(val) {
    var repr = "<table width='100%'><tr >";
    repr += "<td class='tittab' width=5% >No BAV</td>";
    repr += "<td class='tittab' width=45% >Titre</td>";
    repr += "<td class='tittab' width=5% >Actif</td>";
    repr += "<td class='tittab' width=10% >Debut client</td>";
    repr += "<td class='tittab' width=25% >Dates</td>";
    for (index in val) {
        repr += "<tr class='tabl0 link' onclick=\"getOne(\'" + val[index]['par_numero_bav'] + "\')\">";
        repr += "<td  width=5% >";
        repr += val[index]['par_numero_bav'];
        repr += "</td>";
        repr += "<td   width=45% >";
        repr += val[index]['par_titre'];
        repr += "</td>";
        repr += "<td width=10% style='text-align:center'>";
        repr += val[index]['par_actif'];
        repr += "</td>";
        repr += "<td   width=10% style='text-align:center'>";
        repr += val[index]['par_client_date_debut_FR'];
        repr += "</td>";
        repr += "<td   width=25% style='text-align:center'>";
        repr += val[index]['par_date_debut_depot_FR'];
        repr += " au ";
        repr += val[index]['par_date_fin_bav_FR'];
        repr += "</tr>";
    }
    repr += "</table>";

    getElement('tab_parametres').innerHTML = repr;
}

/**
 * recherche d'un parametre retour sous 'display_parametre'
 */
function getOne(id) {
    x_return_oneParametre(id, display_parametre);
}


/**
 * affichage d'un parametre
 */
function display_parametre(val) {

    // reset des champ du formulaire
    document.parametreForm.reset();

    // affichage du formulaier
    display_formulaire(val, document.parametreForm);

    // on cache la table
    disableDisplay('parametres');

    // on affiche le formulaire
    enableDisplay('parametre');

    // si on est actif on coche le checkbox
    document.parametreForm.par_actif.value=1
    document.parametreForm.par_actif.checked=false;
    if (val['par_actif'] == 1) {
        document.parametreForm.par_actif.checked=true;	
    }
    
    // on position le mode de la page
    modePage = "modification";

    // on bloque la saisie du numero de BAV
    document.parametreForm.par_numero_bav.disabled = true;

    // on ecrit le mode de la page dans le titre
    getElement('modeParametre').innerHTML = modePage;
}

/* acces en creation */
function modeCreation() {
    // reset des champ du formulaire
    document.parametreForm.reset();

    // on cache la table
    disableDisplay('parametres');

    // on affiche le formulaire
    enableDisplay('parametre');

    // on position le mode de la page
    modePage = "creation";

    // on est pas actif par defaut, mais la valeur en cas de ckech c'est 1
    document.parametreForm.par_actif.value=1
    document.parametreForm.par_actif.checked=false;

    // on debloque la saisie du numero de BAV
    document.parametreForm.par_numero_bav.disabled = false;

    // on ecrit le mode de la page dans le titre
    getElement('modeParametre').innerHTML = modePage;
}

/* fermeture du CRUD */
function fermerCRUD() {
    suite = true;
    if (startSaisie) {
        alertModalConfirm("<br/><br/><center>Vous avez des modifications en cours<center>", "Param");
    } else {
        disableDisplay('parametre');
        enableDisplay('parametres');
        modePage = "select";
    }
}

function confirmModalParam() {
    closeModal();
    disableDisplay('parametre');
    enableDisplay('parametres');
    setStartSaisie(false);
    modePage = "select";
}


// validation de la fiche
function valider(laForm) {
    // console.log("modePage : "+modePage);
    // comparaison date
    var debClient = laForm.par_client_date_debut.value;
    var finClient = laForm.par_client_date_fin.value;

    if ((new Date(debClient).getTime() > new Date(finClient).getTime())) {
        laForm.par_client_date_debut.setCustomValidity("Date de début doit être avant la date de fin");
        return false;
    }

    // creation d'un tableau de style object javacript
    par = recup_formulaire(laForm, 'par');

    if (modePage == 'modification') {
        x_action_updateParametre(tabToString(par), display_update);
    }
    if (modePage == 'creation') {
        x_action_insertParametre(tabToString(par), display_update);
    }

    return false;
}

/**
 * retour pour update et delete
 */
function display_update(val) {
    if (val == 1) {
        x_return_allParametre(display_parametres);
        setStartSaisie(false);
        fermerCRUD();
    } else {
        alertModalError(val);
    }
}

/**
 * suppresion d'un BAV, avec retour dans le display_update
 */
function supprimer() {
    if (document.parametreForm.par_actif.checked)
    if (confirm('Suppression de parametre')) {
        x_action_supprimeParametre(document.parametreForm.par_numero_bav.value, display_update);
    }
}