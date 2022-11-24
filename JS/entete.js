function initEntete() {
    // console.log("CLIENT:" + CLIENT + " ADMIN:" + ADMIN + "");

    // affichage du comptage que pour ADMIN
    if (ADMIN) {
        getElement('connex').innerHTML = 'ADMIN';
        //if (getElement('tabStat')) {
        //getElement('tabStat').className = 'tabStatShow';
        x_return_countByEtat(display_counter);
        x_return_fichesModif('stock', display_modifStockE);
        x_return_fichesModif('data', display_modifDataE);
        x_return_fichesModif('vendeur', display_modifVendeurE);

        //}
        getElement('tdSearch').style.display = "table-cell";

    } else if (CLIENT) {
        //getElement('tdSearch').style.display = "table-cell";
    }
    return_restant();
}

/**
 * compte a rebours avant la prochaine edition
 */
function return_restant() {
    // avec 17h de plus
    var diff = ((DATE_J1 + "000") - Date.now() + 17 * 3600000) / 1000;
    //var diff = ((DATE_J2 + "000") - Date.now()) / 1000;

    if (diff > 0) {
        var jour = parseInt(diff / (3600 * 24));
        var heures = parseInt(diff / 3600) % 24;
        var minutes = parseInt((diff % 3600) / 60);
        var secondes = parseInt(((diff % 3600) % 60));
        var jourTxt = jour > 0 ? jour + 'j et' : '';
        if (secondes < 10) { secondes = "0" + secondes }
        if (minutes < 10) { minutes = "0" + minutes }
        getElement('timeRestant').innerHTML = jourTxt + " " + heures + ":" + minutes + ":" + secondes;
        setTimeout('return_restant()', 1000);
    } else {
        getElement('timeRestant').innerHTML = "";
    }
}

function display_modifStockE(val) {
    getElement('countModifStock').innerHTML = sizeof(val) + " coupon S" + (sizeof(val) > 1 ? "s" : "");
}

function display_modifDataE(val) {
    getElement('countModifData').innerHTML = sizeof(val) + " étiquette" + (sizeof(val) > 1 ? "s" : "");
}

function display_modifVendeurE(val) {
    getElement('countModifVendeur').innerHTML = sizeof(val) + " coupon D" + (sizeof(val) > 1 ? "s" : "");
}

/**
 * affichage des compteurs
 * @param val 
 */
var totalFiche = 0;

function display_counter(val) {
    if (val instanceof Object) {
        for (key in val) {
            if (getElement(key)) {
                getElement(key).innerHTML = val[key];
            }
        }

        var totalVente = 0
        totalFiche = 0;
        if (val['STOCK']) {
            totalFiche += parseInt(val['STOCK']);
        }
        if (val['VENDU']) {
            totalFiche += parseInt(val['VENDU']);
            totalVente += parseInt(val['VENDU']);
        }
        if (val['RENDU']) {
            totalFiche += parseInt(val['RENDU']);
        }
        if (val['PAYE']) {
            totalFiche += parseInt(val['PAYE']);
            totalVente += parseInt(val['PAYE']);
        }

        getElement('TOTAL').innerHTML = totalFiche;

        getElement('statVendu').innerHTML = parseInt((totalVente / totalFiche) * 100) + "%";
        getElement('VENDU').innerHTML = totalVente;
        if (val['RENDU']) {
            getElement('statRendu').innerHTML = parseInt((parseInt(val['RENDU']) / totalFiche) * 100) + "%";
        } else {
            getElement('statRendu').innerHTML = "";
        }

        // refresh toutes les 5 minutes
        setTimeout('x_return_countByEtat(display_counter)', 1 * 60 * 1000);
    }
}

function display_counter2(val) {
    if (val instanceof Object) {
        getElement('countModifPrix').innerHTML = "<span style='background-color:DARKRED; color:white'>&nbsp;" + sizeof(val) + "&nbsp;</span>";
    }
}

function enteteSaisie() {
    getElement('inputSearch').disabled = startSaisie;
}

/**
 * connexion
 */
function confirmPass() {
    x_whatYourName(document.modalForm.pass.value, displayhello);
}

/**
 * apres connexion
 * @param  val 
 */
function displayhello(val) {
    SetCookie("AADD", val);
    goTo("bav.php");
}