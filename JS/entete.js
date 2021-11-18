function initEntete() {
    console.log("CLIENT:" + CLIENT + " ADMIN:" + ADMIN + "");

    // affichage du comptage que pour ADMIN
    if (ADMIN) {
        getElement('connex').innerHTML = 'ADMIN';
        if (getElement('tabStat')) {
            getElement('tabStat').className = 'tabStatShow';
            x_return_countByEtat(display_counter);
            x_return_allDemandeActive(display_counter2)
        }
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

/**
 * affichage des compteurs
 * @param val 
 */
function display_counter(val) {
    if (val instanceof Object) {
        for (key in val) {
            if (getElement(key)) {
                getElement(key).innerHTML = val[key];
            }
        }
        var total = 0;
        var totalVente = 0
        if (val['STOCK']) {
            total += parseInt(val['STOCK']);
        }
        if (val['VENDU']) {
            total += parseInt(val['VENDU']);
            totalVente += parseInt(val['VENDU']);
        }
        if (val['RENDU']) {
            total += parseInt(val['RENDU']);
        }
        if (val['PAYE']) {
            total += parseInt(val['PAYE']);
            totalVente += parseInt(val['PAYE']);
        }

        getElement('TOTAL').innerHTML = total;

        getElement('statVendu').innerHTML = parseInt((totalVente / total) * 100) + "%";
        getElement('VENDU').innerHTML = totalVente;
        if (val['RENDU']) {
            getElement('statRendu').innerHTML = parseInt((parseInt(val['RENDU']) / total) * 100) + "%";
        } else {
            getElement('statRendu').innerHTML = "";
        }

        // refresh toutes les 5 minutes
        setTimeout('x_return_countByEtat(display_counter)', 5 * 60 * 1000);
    }
}

function display_counter2(val) {
    if (val instanceof Object) {
        getElement('countModifPrix').innerHTML = "<span style='background-color:DARKRED; color:white'>&nbsp;" + sizeof(val) + "&nbsp;</span>";
    }
    setTimeout('x_return_allDemandeActive(display_counter2)', 5 * 60 * 1000);
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