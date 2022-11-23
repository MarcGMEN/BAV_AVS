var idText = "";

function initPage() {
    if (ADMIN) {
        x_return_fichesModif('data', display_modifData);
        x_return_fichesModif('vendeur', display_modifVendeur);

        x_return_fichesModif('stock', display_modifStock);

    } else {
        goTo();
    }
}

function unloadPage() {}

// affichage des la repartition des impression pour les data de la fiche
function display_modifData(val) {

    getElement('nb_fiche_eti').innerHTML = sizeof(val);
    var nbAImprimer = parseInt(parseInt(sizeof(val)) / parseInt(nb_eti_page));
    getElement('nbAImprimer').innerHTML = nbAImprimer + " page";
    if (nbAImprimer > 1) {
        getElement('nbAImprimer').innerHTML = nbAImprimer + " pages";
    }
    if (nbAImprimer > 0) {
        getElement('btnImprimeEtiquettesPage').disabled = false;
    }
    var nbModif = 0;
    var nbNew = 0
    for (i in val) {
        if (val[i]['obj_modif_data'] == 1) {
            nbNew++;
        }
        if (val[i]['obj_modif_data'] == 2) {
            nbModif++;
        }
    }
    getElement('nb_fiche_modif').innerHTML = nbModif;
    getElement('nb_fiche_new').innerHTML = nbNew;
}

// affichage des la repartition des impression pour les data de la fiche et du coupon vendeur
function display_modifVendeur(val) {
    getElement('nb_fiche_coupon').innerHTML = sizeof(val);
    var nbAImprimer = parseInt(parseInt(sizeof(val)) / parseInt(nb_coupon_page));
    getElement('nbCouponAImprimer').innerHTML = nbAImprimer + " page";
    if (nbAImprimer > 1) {
        getElement('nbCouponAImprimer').innerHTML = nbAImprimer + " pages";
    }
    if (nbAImprimer > 0) {
        getElement('btnImprimeCouponsPage').disabled = false;
    }
    var nbModif = 0;
    var nbNew = 0
    for (i in val) {
        if (val[i]['obj_modif_vendeur'] == 1) {
            nbNew++;
        }
        if (val[i]['obj_modif_vendeur'] == 2) {
            nbModif++;
        }
    }
    getElement('nb_fiche_modif_coupon').innerHTML = nbModif;
    getElement('nb_fiche_new_coupon').innerHTML = nbNew;
}

// affichage des la repartition des impression pour les datas du coupon de sorties
function display_modifStock(val) {
    getElement('nb_fiche_couponA').innerHTML = sizeof(val);
    var nbAImprimer = parseInt(parseInt(sizeof(val)) / parseInt(nb_coupon_page));
    getElement('nbCouponAImprimerA').innerHTML = nbAImprimer + " page";
    if (nbAImprimer > 1) {
        getElement('nbCouponAImprimerA').innerHTML = nbAImprimer + " pages";
    }
    if (nbAImprimer > 0) {
        getElement('btnImprimeCouponsPageA').disabled = false;
    }
    var nbModif = 0;
    var nbNew = 0
    for (i in val) {
        if (val[i]['obj_modif_stock'] == 1) {
            nbNew++;
        }
    }
}




var idTextSAved = ""

/**
 * sauvegarde des editions
 * @param {s} id 
 * @param {*} data 
 */
function saveEditor(id, data) {
    //console.log(data);
    alertModalInfoTimeout(data, 1);
    idTextSAved = id;
    x_save_html(id, data, display_fin_save);
}

function viewOnPdf(idText, format) {
    alertModalInfo("Génération de " + idText + " au format PDF <img src='Images/spinner_white_tiny.gif' />");
    x_action_makePDF(new Array(), idText + ".html", true, format, display_openHTML);
}

function viewOnHtml(idText) {
    alertModalInfo("Génération de " + idText + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
    x_action_makeHtml(new Array(), idText + ".html", true, display_viewHTML);
}

function display_fin_save(val) {
    x_return_html(idTextSAved, display_html_file);
}

function cancelEditor(id) {
    getElement('edition').style.display = 'none';
    getElement('visu_html').innerHTML = '';

    // CKEDITOR.instances.editor_html_file.destroy();
    getElement('tableHTML').style.display = 'table';

}

function viewPdf(idtext, format) {
    alertModalInfo("Génération de '" + idtext + "' au format PDF <img src='Images/spinner_white_tiny.gif' />");
    x_action_makePDF(new Array(), idtext + ".html", true, format, display_openPDF);
}

function imprimeEtiquettes(eti0, eti1, test) {
    if (eti0 != "" && eti1 != "") {
        alertModalInfo("Génération des étiquettes de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Etiquettes(eti0, eti1, test, display_openHTML);
    } else {
        alertModalWarn("Numero de fiche début et fin obligatoire");
    }
}

function imprimeEtiquettesPage(force, test) {
    alertModalInfo("Génération des étiquettes par page [" + force + "] au format HTML <img src='Images/spinner_white_tiny.gif' />");
    x_action_makeA4Etiquettes(0, force, test, display_openHTML);
}



function imprimeCoupons(eti0, eti1, test, nameCoupon) {
    if (eti0 != "" && eti1 != "") {
        alertModalInfo("Génération des " + nameCoupon + " de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Coupons(eti0, eti1, test, nameCoupon, display_openHTML);
    } else {
        alertModalWarn("Numero de fiche début et fin obligatoire");
    }
}



function imprimeLibreFiche(eti, nameFdp) {
    if (eti != "") {
        alertModalInfo("Génération de " + nameFdp + " pour " + eti + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeLibreFiche(eti, nameFdp, display_openHTML);
    } else {
        alertModalWarn("Numero de fiche obligatoire");
    }
}

function imprimeCouponsPage(force, test, nameCoupon) {
    alertModalInfo("Génération des coupons par page [" + force + "] au format HTML <img src='Images/spinner_white_tiny.gif' />");
    x_action_makeA4Coupons(0, force, test, nameCoupon, display_openHTML);
}

function imprimeFiches(eti0, eti1) {
    if (eti0 != "" && eti1 != "") {
        alertModalInfo("Génération des fiches de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Fiches(eti0, eti1, display_openHTML);
    } else {
        alertModalWarn("Numero de fiche début et fin obligatoire");
    }
}

function imprimeFiche() {
    alertModalInfo("Génération d'une fiche vierge au format PDF <img src='Images/spinner_white_tiny.gif' />");
    x_action_makePDF("", display_openPDF);
}

function display_openHTML(val) {
    closeModal();
    console.log(val);
    if (isValidUrl(val)) {
        document.body.style.cursor = 'default';
        window.open(val, '_blank');
        //setTimeout(function() { x_action_menage(val, display_rien) }, 100);
        initPage();
    } else {
        alertModalWarn(val);
    }
}

function display_viewHTML(val) {
    closeModal();
    alertModalInfo(val);
}

function display_html_file(val) {
    getElement('edition').style.display = 'block';
    getElement('editing').value = val;
    update(val);
    getElement('visu_html').innerHTML = val;
    getElement('tableHTML').style.display = 'none';
}