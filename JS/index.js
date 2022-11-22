function setStartSaisie(cStartSaisie) {
    startSaisie = cStartSaisie;
    enteteSaisie();
    pageSaisie();
}

// recuperation des donnees de la BAV
function setParamValIndex(val) {
    getElement("mode").innerHTML = modePage + "-" + CLIENT + "-" + ADMIN + "; id=<?=$GET_id?>";
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

function display_rien(val) {
    // console.log("display_rien", val);
}

function display_openPDF(val) {
    console.log(val);
    closeModal();
    document.body.style.cursor = 'default';
    window.open(val, '_blank');
}

function openPDF(val) {
    if (!ADMIN) {
        x_add_counter_action("open Link", val, "", display_rien);
    }
    window.open(val, '_blank');

}

function loadReglement(where, code) {
    document.body.style.cursor = 'wait';
    if (!ADMIN) {
        x_add_counter_action("open Link", "reglement" + code + ".pdf", where, display_rien);
    }
    x_action_makePDFFromHtml(tabToString(data2PDF), "reglement" + code + ".html", display_openPDF);
}

function goToPOST(page = 'bav.php', modePage = '', id = null, message = '') {
    document.formNavigation.page.value = page
    document.formNavigation.modePage.value = modePage;
    document.formNavigation.id.value = id;
    document.formNavigation.message.value = message;
    document.formNavigation.method = 'POST';
    document.formNavigation.submit();
}

function goTo(page = 'bav.php', modePage = '', id = null, message = '') {
    document.formNavigation.page.value = page
    document.formNavigation.modePage.value = modePage;
    document.formNavigation.id.value = id;
    document.formNavigation.message.value = message;
    //document.formNavigation.method = 'POST';
    document.formNavigation.submit();
}
var Gtype = '';

function searchSuiteRest(value, modePage = "", type = "") {
    Gtype = type;
    console.log("searchSuiteRest " + value + "; " + modePage + "; " + type);
    if (modePage == "restF") {
        x_return_oneFicheByIdModif(value, display_getFicheModif);
    } else if (modePage == "restC") {
        x_return_oneClientByIdModif(value, display_getClient);
    } else if (modePage == "restV") {
        x_return_oneFicheByIdModif(value, display_getFicheConsult);
    } else if (!isNaN(Number(value)) && value < 9999) {
        x_return_oneFicheByCode(value, display_getFicheConsult);
    } else {
        alertModalWarnTimeout("Demande incorrecte", 2);
    }
    return false;
    // si numerique < 10000 alors fiche en consult
    // si 5 caracteres => modif fiche
    // si 8 caracteres => consult client
}

function searchFiche(code) {
    console.log("searchFiche " + code);
    x_return_oneFicheByCode(code, display_getFicheModif);
    return false;
}

function display_getFicheConsult(val) {
    console.log(val);
    if (val instanceof Object && val['obj_id'] != undefined) {
        /*  if (ADMIN) {
              console.log("fiche.php&id=" + val['obj_id']);
              goTo("fiche.php", "modif", val['obj_id']);
          } else */
        if (val['obj_numero'] < 5000) {
            console.log("consult.php&id=" + val['obj_id']);
            goTo("consult.php", Gtype, val['obj_id']);
        } else {
            alertModalWarnTimeout("Format incorrect (N° fiche, code fiche, code client)", 2);
        }
    } else {
        alertModalWarnTimeout("Fiche inconnue", 2);
    }
}

function display_getFicheModif(val) {
    if (val instanceof Object) {
        goTo("ficheAdmin.php", "modif", val['obj_id']);
    } else {
        alertModalWarnTimeout("Fiche inconnue", 2);
    }

}

function display_getClient(val) {
    if (val instanceof Object) {
        goTo("client.php", "consult", val['cli_id']);
    } else {
        alertModalWarnTimeout("Client inconnu", 2);
    }

}