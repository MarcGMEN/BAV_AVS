var idText = "";

function initPage() {
    if (ADMIN) {
        x_return_fichesModif('data', display_modifData);
        x_return_fichesModif('vendeur', display_modifVendeur);

    } else {
        goTo();
    }
}

function unloadPage() {}

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
    getElement('edition').style.display = 'block';
    getElement('tableHTML').style.display = 'none';
}

function unloadPage() {}


function saveEditor(id, data) {
    console.log(data);
    alertModalInfo(data);
    x_save_html(id, data, display_fin_save);
    //cancelEditor(id);
}

function display_fin_save(val) {
    //alertModalInfoTimeout("save OK " + val, 1);
    //location.reload();
}

function cancelEditor(id) {
    getElement('edition').style.display = 'none';
    CKEDITOR.instances.editor_html_file.destroy();
    getElement('tableHTML').style.display = 'table';

}

function imprimeEtiquettes(eti0, eti1) {
    console.log("Impression des etiquettes de " + eti0.value + " a " + eti1.value);
    document.body.style.cursor = 'progress';
    x_action_makeA4Etiquettes(eti0.value, eti1.value, display_openPDF);
}

function imprimeFiches(eti0, eti1) {
    console.log("Impression des fiches de " + eti0.value + " a " + eti1.value);
    document.body.style.cursor = 'progress';
    x_action_makeA4Fiches(eti0.value, eti1.value, display_openPDF);
}