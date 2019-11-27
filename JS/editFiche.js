var idText = "";

function initPage() {
    if (ADMIN) {
        x_return_fichesModif('data', display_modifData);
        x_return_fichesModif('vendeur', display_modifVendeur);

    } else {
        goTo();
    }
}

function unloadPage() { }

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

function display_html_file(val) {
    CKEDITOR.replace('editor_html_file');
    CKEDITOR.instances.editor_html_file.setData(val);
    //getElement('editor_html_file').innerHTML = val;
    getElement('edition').style.display = 'block';
    getElement('tableHTML').style.display = 'none';
}

function unloadPage() { }

var idTextSAved = ""
function saveEditor(id, data) {
    console.log(data);
    alertModalInfoTimeout(data, 1);
    idTextSAved = id;
    x_save_html(id, data, display_fin_save);
    CKEDITOR.instances.editor_html_file.destroy();
    //cancelEditor(id);
}

function viewOnPdf(idText, format) {
    alertModalInfo("Génération de " + idText + " au format PDF <img src='Images/spinner_white_tiny.gif' />");
    x_action_makePDF(new Array(), idText + ".html", true, format, display_openHTML);
}
function display_fin_save(val) {
    x_return_html(idTextSAved, display_html_file);
    //alertModalInfoTimeout("save OK " + val, 1);
    //location.reload();
}

function cancelEditor(id) {
    getElement('edition').style.display = 'none';
    CKEDITOR.instances.editor_html_file.destroy();
    getElement('tableHTML').style.display = 'table';

}

function viewPdf(idtext, format) {
    alertModalInfo("Génération de '"+idtext+"' au format PDF <img src='Images/spinner_white_tiny.gif' />");
    x_action_makePDF(new Array(), idtext+".html",true,format, display_openPDF);
}

function imprimeEtiquettes(eti0, eti1, test) {
    if (eti0 != "" && eti1 != "") {
        alertModalInfo("Génération des étiquettes de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Etiquettes(eti0, eti1, test, display_openHTML);
    }
    else {
        alertModalWarn("Numero de fiche début et fin obligatoire");
    }
}

function imprimeEtiquettesPage(force, test) {
    alertModalInfo("Génération des étiquettes par page [" + force + "] au format HTML <img src='Images/spinner_white_tiny.gif' />");
    x_action_makeA4Etiquettes(0, force, test, display_openHTML);
}

function imprimeCoupons(eti0, eti1, test) {
    if (eti0 != "" && eti1 != "") {
        alertModalInfo("Génération des coupons de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Coupons(eti0, eti1, test, display_openHTML);
    }
    else {
        alertModalWarn("Numero de fiche début et fin obligatoire");
    }
}

function imprimeCouponsPage(force, test) {
    alertModalInfo("Génération des coupons par page [" + force + "] au format HTML <img src='Images/spinner_white_tiny.gif' />");
    x_action_makeA4Coupons(0, force, test, display_openHTML);
}

function imprimeFiches(eti0, eti1) {
    if (eti0 != "" && eti1 != "") {
        alertModalInfo("Génération des fiches de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Fiches(eti0, eti1, display_openHTML);
    }
    else {
        alertModalWarn("Numero de fiche début et fin obligatoire");
    }
}

function display_openHTML(val) {
    closeModal();
    document.body.style.cursor = 'default';
    window.open(val, '_blank');
    setTimeout(function(){x_action_menage(val, display_rien)}, 100);
    initPage();
}