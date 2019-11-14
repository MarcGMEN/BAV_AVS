function setStartSaisie(cStartSaisie) {
    startSaisie = cStartSaisie;
    enteteSaisie();
    pageSaisie();
}

// recuperation des donnees de la BAV
function setParamValIndex(val) {
    getElement("mode").innerHTML = modePage + "-" + CLIENT + "-" + ADMIN +
        "; id=<?=$GET_id?>";
}

function setParamVal(val) {
    setParamValIndex(val);
}

function display_retour_test(val) {
    alert(val);
    console.log(val);
}

function confirmModalTest() {
    setTimeout(function() {
        closeModal();
    }, 1000);
}


function display_openPDF(val) {
    console.log(val);
    document.body.style.cursor = 'default';
    window.open(val, '_blank');
}

function goTo(page = 'bav.php', modePage = '', id = null, message = '') {
    document.formNavigation.page.value = page
    document.formNavigation.modePage.value = modePage;
    document.formNavigation.id.value = id;
    document.formNavigation.message.value = message;
    document.formNavigation.submit();
}

function search(value) {
    if (!isNaN(Number(value)) && value < 9999) {
        console.log("consult fiche");
        x_return_oneFicheByCode(value, display_getFicheConsult);
    }
    else if (value.length == 5 || value.length == 6) {
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
    return false;
    // si numerique < 10000 alors fiche en consult
    // si 5 caracteres => modif fiche
    // si 8 caracteres => consult client
}

function display_getFicheConsult(val) {
    console.log(val);
    if (val instanceof Object && val['obj_id'] != undefined) {
        if (ADMIN) {
            console.log("fiche.php&id="+val['obj_id']);
            goTo("fiche.php","modif",val['obj_id']);
        }
        else if (val['obj_numero'] < 5000) {
            console.log("consult.php&id="+val['obj_id']);
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