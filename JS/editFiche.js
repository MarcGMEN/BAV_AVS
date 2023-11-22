var idText = "";

function initPage() {
    if (ADMIN) {
        x_return_fichesModif('data', display_modifData);
        x_return_fichesModif('vendeur', display_modifVendeur);
        x_return_fichesModif('stock', display_modifStock);
        x_return_fichesModif('accessoire', display_modifEtiquetteAccessoire);

        x_return_num_max_fiches(display_num_max_fichesEF);
    } else {
        goTo();
    }
}

function unloadPage() { }

// affichage des la repartition des impression pour les data de la fiche
function display_modifData(val) {

    getElement('nb_fiche_eti').innerHTML = sizeof(val);
    var nbAImprimer = parseInt(parseInt(sizeof(val)) / parseInt(nb_eti_page));
    getElement('nbAImprimer').innerHTML = (nbAImprimer == 0 ? "" : "<b>") + nbAImprimer + " page" + (nbAImprimer == 1 ? "" : "s") + (nbAImprimer == 0 ? "" : "</b>");
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

function display_modifEtiquetteAccessoire(val) {

    getElement('nb_ea_eti').innerHTML = sizeof(val);
    var nbAImprimer = parseInt(parseInt(sizeof(val)) / parseInt(nb_eti_page));
    getElement('nbEAaImprimer').innerHTML = (nbAImprimer == 0 ? "" : "<b>") + nbAImprimer + " page" + (nbAImprimer == 1 ? "" : "s") + (nbAImprimer == 0 ? "" : "</b>");
    if (nbAImprimer > 0) {
        getElement('btnImprimeEAsPage').disabled = false;
    }
    var nbModif = 0;
    var nbNew = 0
    for (i in val) {
        if (val[i]['obj_modif_accessoire'] == 1) {
            nbNew++;
        }
        if (val[i]['obj_modif_accessoire'] == 2) {
            nbModif++;
        }
    }
    getElement('nb_ea_modif').innerHTML = nbModif;
    getElement('nb_ea_new').innerHTML = nbNew;
}

// affichage des la repartition des impression pour les data de la fiche et du coupon vendeur
function display_modifVendeur(val) {
    getElement('nb_fiche_coupon').innerHTML = sizeof(val);
    var nbAImprimer = parseInt(parseInt(sizeof(val)) / parseInt(nb_coupon_page));
    getElement('nbCouponAImprimer').innerHTML = (nbAImprimer == 0 ? "" : "<b>") + nbAImprimer + " page" + (nbAImprimer == 1 ? "" : "s") + (nbAImprimer == 0 ? "" : "</b>");
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
    getElement('nbCouponAImprimerA').innerHTML = (nbAImprimer == 0 ? "" : "<b>") + nbAImprimer + " page" + (nbAImprimer == 1 ? "" : "s") + (nbAImprimer == 0 ? "" : "</b>");
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

function imprimeEtiquettes(eti0, eti1, test, nameEti) {
    if (eti0 != "" && eti1 != "") {
        alertModalInfo("Génération des étiquettes (" + nameEti + ") de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Etiquettes(eti0, eti1, test, nameEti, display_openHTML);
    } else {
        alertModalWarn("Numero de fiche début et fin obligatoire");
    }
}

function imprimeEtiquettesPage(force, test, nameEti) {
    alertModalInfo("Génération des étiquettes (" + nameEti + ") par page [" + force + "] au format HTML <img src='Images/spinner_white_tiny.gif' />");
    x_action_makeA4Etiquettes(0, force, test, nameEti, display_openHTML);
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
    // console.log(val);
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

var classeur = NB_MODIF;

function display_num_max_fichesEF(val) {
    for (var i = 1; i <= val; i += NB_MODIF) {
        x_return_nb_fiche_by_place(i, i + classeur - 1, display_detailpageFicheEF);
    }
}
var nbClasseurPret = 0;
function display_detailpageFicheEF(val) {
    var selectCla = getElement('classeurs');
    var nbfiche = 0;
    // if (val[1] && sizeof(val[1]) > 0) {
    for (index in val[1]) {
        nbfiche += parseInt(val[1][index]);
    }
    var option = document.createElement("option");
    option.text = val[0] + "-> " + nbfiche;
    if (val[1] && sizeof(val[1]) > 0) {
        option.text += " *";
    }
    option.value = val[0];
    selectCla.appendChild(option);
    var items = selectCla.childNodes;
    var itemsArr = [];
    for (var i in items) {
        if (items[i].nodeType == 1) { // get rid of the whitespace text nodes
            itemsArr.push(items[i]);
        }
    }

    itemsArr.sort(function (a, b) {
        return parseInt(a.value) == parseInt(b.value)
            ? 0
            : (parseInt(a.value) > parseInt(b.value) ? 1 : -1);
    });
    selectCla.childNodes = new Array();
    for (i = 0; i < itemsArr.length; ++i) {
        selectCla.appendChild(itemsArr[i]);
    }
    nbClasseurPret += 1;
    getElement('nbClasseurPret').innerHTML = nbClasseurPret;
    // }

}
var fichesNego = new Map();
function imprimePreCheck(debutClasseur) {
    fichesNego = new Map();
    var fin = parseInt(debutClasseur) + parseInt(NB_MODIF) - 1;
    console.log(debutClasseur + " -> " + fin);
    // recherche des fiches du classeur
    for (var i = debutClasseur; i <= fin; i++) {
        // console.log("x_return_oneFicheByCode de " + i);
        x_return_oneFicheByCode(i, display_fichePC);
    }

    setTimeout('finFiches()', 1000);
}
function finFiches() {
    while (fichesNego.length < NB_MODIF) {
        console.log(fichesNego.length + " en cours");
    }
    // fichesNego.sort(function (a, b) {
    //     return parseInt(a) == parseInt(b)
    //         ? 0
    //         : (parseInt(a) > parseInt(b) ? 1 : -1);
    // });
    // console.log(fichesNego);
    var map1 = new Map([...fichesNego.entries()].sort((function (a, b) {
        return parseInt(a) == parseInt(b)
            ? 0
            : (parseInt(a) > parseInt(b) ? 1 : -1);
    })));
    // console.log(map1);


    const [firstKey] = map1.keys();
    var repr = "<html><head>";
    repr += "</head><body>";
    repr += "<h3 style='background-color:grey; text-align:center'>Check classeur " + firstKey + " -> " + ((NB_MODIF) + parseInt(firstKey) - 1) + "</h3>";
    repr += "<table border=1 style='border:2px black solid; width:100%'>";
    repr += "<tr><th width=10%>Numéro</th><th width=10%>Prix</th><th width=10%>Table</th><th width=10%>Info</th><th width=10%>Prix négo</th>";
    repr += "<th width=10%>Numéro</th><th width=10%>Prix</th><th width=10%>Table</th><th width=10%>Info</th><th width=10%>Prix négo</th></tr>";

    // console.log(firstKey, ((NB_MODIF / 2) + parseInt(firstKey)));
    for (var i = firstKey; i < ((NB_MODIF / 2) + parseInt(firstKey)); i++) {
        repr += "<tr style='border:2px black solid;'><td style='background-color:grey; text-align:center'>";
        repr += i
        repr += "</td><td>";
        var prix = map1.get(i)[0]
        repr += prix == undefined ? "" : prix == "0.00" ? "" : prix;
        repr += "</td><td>";
        repr += "</td><td>";
        repr += "</td><td>";
        repr += map1.get(i)[1] == undefined ? "" : map1.get(i)[1];
        repr += "</td>";
        repr += "<td style='background-color:grey; text-align:center'>";
        var j = parseInt(parseInt(i) + (NB_MODIF / 2));
        repr += j;
        repr += "</td><td>";
        prix = map1.get(j)[0]
        repr += prix == undefined ? "" : prix == "0.00" ? "" : prix;
        repr += "</td><td>";
        repr += "</td><td>";
        repr += "</td><td>";
        repr += map1.get(j)[1] == undefined ? "" : map1.get(j)[1];
        repr += "</td></tr>";
    }
    repr += "</table>";
    repr += "</body></html>";

    var newWindow = window.open("", "Fiches du check", "width=1200,height=600,scrollbars=1,resizable=1")
    newWindow.document.open()
    newWindow.document.write(repr)
    newWindow.document.close()
}

function display_fichePC(val) {
    fichesNego.set(parseInt(val['obj_numero']), [val['obj_prix_depot'], val['obj_prix_nego']]);
}
