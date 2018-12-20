function search(value) {
    console.log(value.length);
    console.log(!isNaN(Number(value)));
    if (!isNaN(Number(value)) && value < 9999) {
        console.log("consult fiche");
        x_return_oneFicheByCode(value, display_getFicheConsult);
    }
    else if (value.length == 5) {
        console.log("modif fiche "+value);
        x_return_oneFicheByIdModif(value, display_getFicheModif);
    }
    else if (value.length == 8) {
        console.log("consule client "+value);
        x_return_oneClientByIdModif(value, display_getClient);
    }
    else {
        alertModalWarnTimeout("Format incorrect (N° fiche, code fiche, code client)",2);
    }
    // si numerique < 10000 alors fiche en consult
    // si 5 caracteres => modif fiche
    // si 8 caracteres => consult client
}

function display_getFicheConsult(val) {
    if (val instanceof Object) {
        if (TABLE || ADMIN) {
            goTo("fiche.php","modif",val['obj_id']);
        }
        else if (val['obj_numero'] < 5000) {
            goTo("consult.php","consult",val['obj_id']);
        }
        else {
            alertModalWarnTimeout("Format incorrect (N° fiche, code fiche, code client)",2);
        }
    }
    else {
        alertModalWarnTimeout("Fiche inconnue",2);
    }
}

function display_getFicheModif(val) {
    if (val instanceof Object) {
        goTo("fiche.php","modif",val['obj_id']);
    }
    else {
        alertModalWarnTimeout("Code incorrect",2);
    }
    
}

function display_getClient(val) {
    if (val instanceof Object) {
        goTo("client.php","consult",val['cli_id']);
    }
    else {
        alertModalWarnTimeout("Code incorrect",2);
    }

}