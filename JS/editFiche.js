var idText = "";

function initPage() {
    if (ADMIN) {
        x_return_fichesModif('data', display_modifData);
        x_return_fichesModif('vendeur', display_modifVendeur);
        x_return_fichesModif('stock', display_modifStock);
        // x_return_fichesModif('accessoire', display_modifEtiquetteAccessoire);

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
        //getElement('forceEtiquette').disabled = true;
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
    var nbAImprimer = parseInt(parseInt(sizeof(val)) / parseInt(nb_coupon_page));
    getElement('nbEAaImprimer').innerHTML = (nbAImprimer == 0 ? "" : "<b>") + nbAImprimer + " page" + (nbAImprimer == 1 ? "" : "s") + (nbAImprimer == 0 ? "" : "</b>");
    if (nbAImprimer > 0) {
        getElement('btnImprimeEAsPage').disabled = false;
        // getElement('forceAccessoire').disabled = true;
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
        // getElement('forceCoupon').disabled = true;
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
        // getElement('forceCouponA').disabled = true;
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

function imprimeEtiquettes(eti0, eti1, test, nameEti,tri) {
    if (eti0 != "") {
        alertModalInfo("Génération des étiquettes (" + nameEti + ") de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Etiquettes(eti0, eti1, test, nameEti, tri, display_openHTML);
    } else {
        alertModalWarn("Numero de fiche début et fin obligatoire");
    }
}

function imprimeEtiquettesPage(force, test, nameEti,tri) {
    alertModalInfo("Génération des étiquettes (" + nameEti + ") par page [" + force + "] au format HTML <img src='Images/spinner_white_tiny.gif' />");
    x_action_makeA4Etiquettes(0, force, test, nameEti, tri, display_openHTML);
}



function imprimeCoupons(eti0, eti1, test, nameCoupon,tri) {
    if (eti0 != "") {
        alertModalInfo("Génération des " + nameCoupon + " de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Coupons(eti0, eti1, test, nameCoupon, tri,display_openHTML);
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

function imprimeCouponsPage(force, test, nameCoupon,tri) {
    alertModalInfo("Génération des coupons par page [" + force + "] au format HTML <img src='Images/spinner_white_tiny.gif' />");
    x_action_makeA4Coupons(0, force, test, nameCoupon,tri, display_openHTML);
}

function imprimeFiches(eti0, eti1, piece) {
    if (eti0 != "") {
        alertModalInfo("Génération des fiches de " + eti0 + " a " + eti1 + " au format HTML <img src='Images/spinner_white_tiny.gif' />");
        x_action_makeA4Fiches(eti0, eti1,piece, display_openHTML);
    } else {
        alertModalWarn("Numero de fiche début.");
    }
}

function imprimeFiche() {
    alertModalInfo("Génération d'une fiche vierge au format PDF <img src='Images/spinner_white_tiny.gif' />");
    x_action_makePDF("", display_openPDF);
}

function display_openHTML(val) {
    closeModal();
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
        nbClasseurPret += 1;
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

    getElement('nbClasseurPret').innerHTML = nbClasseurPret;
    // }

}
var fichesNego = new Map();
function imprimePreCheck(options) {
    // console.log(options)

    var classeurs = [];
    var index = 0;
    for (i in options) {
        if (options[i].selected) {
            classeurs[index++] = options[i].value;
        }
    }
    // console.log(classeurs);
    fichesNego = new Map();

    // console.log(debutClasseur + " -> " + fin);
    // recherche des fiches du classeur
    for (var j in classeurs) {
        var debutClasseur = classeurs[j];
        var fin = parseInt(debutClasseur) + parseInt(NB_MODIF) - 1;
        for (var i = debutClasseur; i <= fin; i++) {
            // console.log("x_return_oneFicheByCode de " + i);
            x_return_oneFicheByCode(i, display_fichePC);
        }
    }
    // console.log(classeurs.length);
    var delai = 2 * classeurs.length;
    setTimeout(' finFiches();',delai*1000);
    alertModalInfoTimeout('Attente de ' + delai + " secondes....", delai);
   
}
function finFiches() {
    
    // var index = lectureTaleFichesNego();
    // console.log(index + " < " + NB_MODIF);
    // while (index < NB_MODIF) {
    //     index = lectureTaleFichesNego();
    //     console.log(index+" en cours");
    // }
    // fichesNego.sort(function (a, b) {
    //     return parseInt(a) == parseInt(b)
    //         ? 0
    //         : (parseInt(a) > parseInt(b) ? 1 : -1);
    // });
    var map1 = new Map([...fichesNego.entries()].sort((function (a, b) {
        return parseInt(a) == parseInt(b)
            ? 0
            : (parseInt(a) > parseInt(b) ? 1 : -1);
    })));
    // console.log(map1);

    var repr = "<html><head>";
    repr += "</head><body>";

    // console.log("modulo " + map1.size / NB_MODIF)
    const theKeys = map1.keys()
    var [nextKey] = theKeys;
    for (var page = 0; page < map1.size / NB_MODIF; page++) {
        firstKey = nextKey;
        console.log(firstKey);
        repr += "<h3 style='background-color:grey; text-align:center'>Check classeur " + firstKey + " -> " + ((NB_MODIF) + parseInt(firstKey) - 1) + "</h3>";
        repr += "<table style='border:2px black solid; width:100%'>";
        repr += "<tr style='background-color:lightgrey;'><th width=10%>Numéro</th>";
        if (firstKey >= base_info) {
            repr += "<th width=10%> Prix</th > ";
        }
        repr += "<th width=10%> Prix négo</th > ";
        // if (firstKey >= base_info) {
        repr += "<th width=5%> Table</th > <th width=5%> Info</th > ";
        if (firstKey >= base_info) {
            repr += "<th width=10 %> Creneau</th > ";
        }
        // }
        repr += "<th width=10%>Numéro</th>";
        if (firstKey >= base_info) {
            repr += "<th width=10%> Prix</th > ";
        }
        repr += "<th width=10%> Prix négo</th >";
        // if (firstKey >= base_info) {
        repr += "<th width=5%> Table</th > <th width=5%> Info</th > ";
        if (firstKey >= base_info) {
            repr += "<th width=10 %> Creneau</th > ";
        }
        // }
        repr += "</tr>";

        // console.log(firstKey, ((NB_MODIF / 2) + parseInt(firstKey)));
        for (var i = firstKey; i < ((NB_MODIF / 2) + parseInt(firstKey)); i++) {
            repr += "<tr style='border:2px black solid;'><td style='background-color:grey; text-align:center'>";
            repr += i
            repr += "</td><td style='text-align:left;border-bottom:1px black solid;border-right:1px grey solid'>";
            if (firstKey >= base_info) {
                var prix = map1.get(i)[0];
                repr += prix == undefined ? "" : prix == "0.00" ? "" : prix + " &euro;";
                repr += "</td><td  style='text-align:left;border-bottom:1px black solid'>";
            }
            repr += map1.get(i)[1] == undefined ? "" : map1.get(i)[1] == "0.00" ? "" : map1.get(i)[1] + " &euro;";
            // if (firstKey >= base_info) {
            var etat = map1.get(i)[2];
            repr += "</td><td style='text-align:center;border-bottom:1px black solid;border-left:1px grey solid'>";
            repr += etat == undefined ? "" : etat != "CONFIRME" ? "V" : "";
            repr += "</td><td style='text-align:center;border-bottom:1px black solid;border-left:1px grey solid'>";
            repr += etat == undefined ? "" : etat != "CONFIRME" ? etat : "";
            // }
            repr += "</td>";
            if (firstKey >= base_info) {
                repr += "<td style='text-align:center;border-bottom:1px black solid;border-left:1px grey solid'>";
                repr += map1.get(i)[3] == undefined ? "" : map1.get(i)[3] == "" ? "" : map1.get(i)[3];
                repr += "</td>";
            }
            theKeys.next().value;

            repr += "<td style='background-color:grey; text-align:center'>";
            var j = parseInt(parseInt(i) + (NB_MODIF / 2));
            repr += j;
            repr += "</td><td style='text-align:left;border-bottom:1px black solid;border-right:1px grey solid'>";
            if (firstKey >= base_info) {
                prix = map1.get(j)[0]
                repr += prix == undefined ? "" : prix == "0.00" ? "" : prix + " &euro;";
                repr += "</td><td style='text-align:left;border-bottom:1px black solid'>";
            }
            repr += map1.get(j)[1] == undefined ? "" : map1.get(j)[1] == "0.00" ? "" : map1.get(j)[1] + " &euro;";
            // if (firstKey >= base_info) {
            etat = map1.get(j)[2]
            repr += "</td><td style='text-align:center;border-bottom:1px black solid;border-left:1px grey solid'>";
            repr += etat == undefined ? "" : etat != "CONFIRME" ? "V" : "";
            repr += "</td><td style='text-align:center;border-bottom:1px black solid;border-left:1px grey solid'>";
            repr += etat == undefined ? "" : etat != "CONFIRME" ? etat : "";
            // }
            repr += "</td>";
            if (firstKey >= base_info) {
                repr += "<td style='text-align:center;border-bottom:1px black solid;border-left:1px grey solid'>";
                repr += map1.get(j)[3] == undefined ? "" : map1.get(j)[3] == "" ? "" : map1.get(j)[3];
                repr += "</td>";
            }
            repr +="</tr > ";
            nextKey = theKeys.next().value;
        }
        repr += "</table>";
        repr += "<div style='page-break-after:always; clear:both;font-size:10pt;height:10pt'>..........</div>";

    }
    repr += "</body></html>";

    var newWindow = window.open("", "Fiches du check", "width=1200,height=600,scrollbars=1,resizable=1")
    newWindow.document.open()
    newWindow.document.write(repr)
    newWindow.document.close()
}

function display_fichePC(val) {
    // console.log(val);
    var creneau = "";
    if (val['cre_debut']) {
        var dateLu = new Date(val['cre_debut']);
        // creneau = getJourDate(dateLu) + " " + dateLu.getDate() + "<br/>à " + val['cre_debut'].substr(11, 5);
        creneau = "Le "+dateLu.getDate() + " à " + val['cre_debut'].substr(11, 5);
    }
    fichesNego.set(parseInt(val['obj_numero']), [val['obj_prix_depot'], val['obj_prix_nego'], val['obj_etat'], creneau]);

}

function lectureTaleFichesNego() {
    return fichesNego.size;
}
